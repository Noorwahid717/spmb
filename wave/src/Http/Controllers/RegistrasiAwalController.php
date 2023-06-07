<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Arr;
use Str;

class RegistrasiAwalController extends Controller
{
    public function index()
    {
        // $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        // $ta = self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap");
        // $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-agama');
        // $agama = $response->json();
        // $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-pendidikan');
        // $pendidikan = $response->json();
        // $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-pekerjaan');
        // $pekerjaan = $response->json();
        // $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-penghasilan');
        // $penghasilan = $response->json();
        // $prodi = ProdiFakultas::all();
        if(!auth()->guest() && auth()->user()->role_id==7){
            return view('theme::bendahara.registrasi_awal.index',array(
                // 'tahun_ajaran'=>$ta,
                // 'agama'=>$agama,
                // 'pendidikan'=>$pendidikan,
                // 'pekerjaan'=>$pekerjaan,
                // 'penghasilan'=>$penghasilan,
                // 'prodi'=>$prodi,
            ));
        }else{
            return abort(404);
        }
    }

    public function getList(Request $req)
    {
        $is_lunas = $req->is_lunas;       
        $ta_aktif = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $reg_awal_data = RegistrasiAwalUser::with('getUser')
        ->where('tahun_akademik_registrasi',$ta_aktif)
        ->where(function ($query) use(&$is_lunas) {
            if($is_lunas=="all"){
                return $query;
            }else{
                return $query->where('is_lunas', '=', $is_lunas);
            }
        })
        ->get();
        // $value = Arr::add($value, "globalInfo", $globalInfo);                

        if ($req->ajax()) {
            return DataTables::of($reg_awal_data)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row){   
                    $split = explode('8', $row->getUser->no_hp_camaba,2);
                    $hp_camaba = '628'.$split[1];
                    $nama = str_replace("'","\'",$row->getUser->name);
                    $keterangan = str_replace("'","\'",$row->keterangan);
                    $actionBtn =
                    '<a href="https://wa.me/'.$hp_camaba.'" id="link_wa_da" target="_blank" '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md"> '.
                    '<img src="'.asset('/themes/tailwind/images/whatsapp.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>'.
                    '<a href="#registrasi-awal-modal" rel="modal:open" data-modal="#registrasi-awal-modal"'.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md"'.
                    'onClick="modalClik(
                        \''.$row->id_user.'\',
                        \''.$nama.'\',
                        \''.$hp_camaba.'\',
                        \''.$row->getUser->email.'\',
                        \''.$row->is_lunas.'\',
                        \''.$row->nominal.'\',
                        \''.$row->url_bukti_bayar.'\',
                        \''.$row->tanggal_bayar.'\',
                        \''.$keterangan.'\',
                        \''.$row->tahun_akademik_registrasi.'\');"'.                
                    '>'.
                    '<img src="'.asset('/themes/tailwind/images/pen.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>';
                    return $actionBtn;
                })         
                ->editColumn('get_user.no_hp_camaba',function($row){
                    $split = explode('8', $row->getUser->no_hp_camaba,2);
                    $hp_camaba = '628'.$split[1];
                    return $hp_camaba;
                })
                ->editColumn('updated_at',function($row){                    
                    return $row->updated_at->diffForHumans();
                })
                ->editColumn('nominal',function($row){
                    $number = $row->nominal;
                    if($number!=null||$number!=""){
                        $number = number_format($number,0,",",".");
                        return "Rp. ".$number;
                    }else{
                        return;
                    }
                })
                ->editColumn('tahun_akademik_registrasi',function($row){
                    $ta = $row->tahun_akademik_registrasi;
                    $ta = self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap");;
                    return $ta;
                })
                ->editColumn('is_lunas', function($row){                    
                    if($row->is_lunas==0){
                        return "Menunggu";
                    }else if($row->is_lunas==1){
                        return "Lunas";
                    }else{
                        return "Belum Lunas";
                    }
                })    
                ->addColumn('slip', function($row){                    
                    if($row->url_bukti_bayar!=""){
                        return '<img src="'.asset('/themes/tailwind/images/checked.png').'" class="w-6 rounded sm:mx-auto">';
                    }else{
                        return '<img src="'.asset('/themes/tailwind/images/close.png').'" class="w-6 rounded sm:mx-auto">';
                    }
                })            
                ->rawColumns(['act','slip'])
                ->make(true);
        }
    }
    
    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }

    public function updateStatus(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $imageName = null;
            if($req->url_bukti_bayar){
                $image = $req->url_bukti_bayar;  // your base64 encoded
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(50).'.'.'png';
                \File::put(storage_path(). '/app/public/tempat_bukti_pembayaran/' . $imageName, base64_decode($image));
            }
            $data = RegistrasiAwalUser::where('id_user','=',$req->id_user)
                                ->where('tahun_akademik_registrasi','=',$req->ta_registrasi)
                                ->first();           
            $old_foto = $data->url_bukti_bayar;
            if($imageName!=null||$imageName!=""){
                $data->url_bukti_bayar = 'tempat_bukti_pembayaran/'.$imageName;
            }
            $data->keterangan = $req->keterangan;
            $data->is_lunas = $req->status_bayar;
            $data->nominal = $req->nominal;
            $data->tanggal_bayar = $req->tanggal_bayar;
            $data->id_user_admin = auth()->user()->id;
            if($data->save()){
                $step = UserSpmbStep::where('user_id',$req->id_user)->first();
                $step->step_2 = $req->status_bayar==-1?"0":$req->status_bayar;
                $step->save();
                $res['message']="Validasi Pembayaran berhasil diubah.";
                $file_path = public_path().'/storage/'.$old_foto;
                if($imageName!=null||$imageName!=""){
                    if($old_foto!=""){
                        unlink($file_path);
                    }
                    // update data user
                    $user = User::where('id',$req->id_user)->first();
                    $user->bukti_pembayaran = $data->url_bukti_bayar; 
                    $user->save();  
                }
            }else{
                $res['error']=true;
                $res['message']="Validasi Pembayaran gagal diubah!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }
}
