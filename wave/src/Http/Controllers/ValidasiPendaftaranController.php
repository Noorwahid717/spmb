<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\ProdiFakultas;
use App\Models\CamabaDataPokok;
use App\Models\CamabaDataAlamat;
use App\Models\CamabaDataOrtu;
use App\Models\CamabaDataWaliPs;
use App\Models\CamabaDataDokumen;
use App\Models\CamabaDataPernyataan;
use App\Models\CamabaDataProgramStudi;
use App\Models\CamabaDataRiwayatPendidikan;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Arr;
use Str;

class ValidasiPendaftaranController extends Controller
{
    public function index()
    {        
        $prodi = ProdiFakultas::all();

        if(!auth()->guest() && auth()->user()->role_id==8){
            return view('theme::pendaftaran.validasi-pendaftaran.index',array(
                'prodi'=>$prodi,
            ));
        }else{
            return abort(404);
        }
    }

    public function getList(Request $req)
    {
        $is_lunas = $req->is_lunas;       
        $is_valid = $req->is_valid;       
        $is_pernyataan = $req->is_pernyataan;       
        $is_prodi1 = $req->is_prodi;       
        $ta_aktif = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        if($is_prodi1=="null"){
            $reg_awal_data = RegistrasiAwalUser::with('getUser')
            ->with('getCamabaDataPokok')
            ->with('getCamabaDataAlamat')
            ->with('getCamabaDataOrtu')
            ->with('getCamabaDataWaliPs')
            ->with('getCamabaDataRiwayatPendidikan')
            ->with('getCamabaDataDokumen')
            ->with('getCamabaDataPernyataan')
            ->where('tahun_akademik_registrasi',$ta_aktif)        
            // ->with('getUserSpmbStep')
            ->withWhereHas('getUserSpmbStep',function ($query) use(&$is_lunas) {
                if($is_lunas=="all"){
                    return $query;
                }else{
                    return $query->where('step_2', '=', $is_lunas);
                }
            })
            ->withWhereHas('getUserSpmbStep',function ($query) use(&$is_valid) {            
                if($is_valid=="all"){
                    return $query;
                }else{
                    return $query->where('step_5', '=', $is_valid);
                }
            })
            ->withWhereHas('getUserSpmbStep',function ($query) use(&$is_pernyataan) {            
                if($is_pernyataan=="all"){
                    return $query;
                }else{
                    return $query->where('step_6', '=', $is_pernyataan);
                }
            })
            ->with('getCamabaDataProgramStudi')
            ->doesntHave('getCamabaDataProgramStudi')
            ->get();
        }else{
            $reg_awal_data = RegistrasiAwalUser::with('getUser')
            ->with('getCamabaDataPokok')
            ->with('getCamabaDataAlamat')
            ->with('getCamabaDataOrtu')
            ->with('getCamabaDataWaliPs')
            ->with('getCamabaDataRiwayatPendidikan')
            ->with('getCamabaDataDokumen')
            ->with('getCamabaDataPernyataan')
            ->where('tahun_akademik_registrasi',$ta_aktif)        
            // ->with('getUserSpmbStep')
            ->withWhereHas('getUserSpmbStep',function ($query) use(&$is_lunas) {
                if($is_lunas=="all"){
                    return $query;
                }else{
                    return $query->where('step_2', '=', $is_lunas);
                }
            })
            ->withWhereHas('getUserSpmbStep',function ($query) use(&$is_valid) {            
                if($is_valid=="all"){
                    return $query;
                }else{
                    return $query->where('step_5', '=', $is_valid);
                }
            })
            ->withWhereHas('getUserSpmbStep',function ($query) use(&$is_pernyataan) {            
                if($is_pernyataan=="all"){
                    return $query;
                }else{
                    return $query->where('step_6', '=', $is_pernyataan);
                }
            })
            ->with('getCamabaDataProgramStudi')
            ->withWhereHas('getCamabaDataProgramStudi', function($query) use(&$is_prodi1){
                if($is_prodi1=="all"){
                    return $query;
                }else{
                    return $query->where('id_program_studi_1', '=', $is_prodi1);
                }
            })
            ->get();
        }
        
        // dd($reg_awal_data);
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
                    '<a target="_blank" href="'.route('wave.validasi-pendaftaran-detail',[$row->id_user,$row->tahun_akademik_registrasi]).'" '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md"'.                    
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
                ->editColumn('get_user_spmb_step.updated_at',function($row){                    
                    return $row->getUserSpmbStep->updated_at->diffForHumans();
                })
                ->editColumn('get_camaba_data_program_studi.get_prodi_fakultas1.nama_program_studi',function($row){
                    if($row->getCamabaDataProgramStudi==null){
                        return 'belum memilih';
                    }else{
                        return $row->getCamabaDataProgramStudi->program_studi_1;
                    }
                })
                ->editColumn('get_camaba_data_program_studi.get_prodi_fakultas2.nama_program_studi',function($row){
                    if($row->getCamabaDataProgramStudi==null){
                        return 'belum memilih';
                    }else{
                        return $row->getCamabaDataProgramStudi->program_studi_2;
                    }
                })
                ->editColumn('tahun_akademik_registrasi',function($row){
                    $ta = $row->tahun_akademik_registrasi;
                    $ta = self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap");;
                    return $ta;
                })
                ->addColumn('is_lunas', function($row){                    
                    if($row->getUserSpmbStep->step_2==0){
                        return "Menunggu";
                    }else if($row->getUserSpmbStep->step_2==1){
                        return "Lunas";
                    }else{
                        return "Belum Lunas";
                    }
                })   
                ->addColumn('is_data_valid', function($row){                    
                    if($row->getUserSpmbStep->step_5==0){
                        return "Menunggu";
                    }else if($row->getUserSpmbStep->step_5==1){
                        return "Valid";
                    }else{
                        return "Belum Valid";
                    }
                })         
                ->addColumn('is_pernyataan_valid', function($row){                    
                    if($row->getUserSpmbStep->step_6==0){
                        return "Menunggu";
                    }else if($row->getUserSpmbStep->step_6==1){
                        return "Valid";
                    }else{
                        return "Belum Valid";
                    }
                })         
                ->rawColumns(['act','is_lunas','is_data_valid','is_pernyataan_valid'])
                ->make(true);
        }
    }

    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }

    public function detailValidasiPendaftaran($id_user,$ta)
    {
        // $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $ta = self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap");
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-agama');
        $agama = $response->json();
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-pendidikan');
        $pendidikan = $response->json();
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-pekerjaan');
        $pekerjaan = $response->json();
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-penghasilan');
        $penghasilan = $response->json();
        $prodi = ProdiFakultas::all();

        $step_1 = CamabaDataPokok::where('id_user',$id_user)->first();
        $step_2 = CamabaDataAlamat::where('id_user',$id_user)->first();
        $step_3 = CamabaDataOrtu::where('id_user',$id_user)->first();
        $step_4 = CamabaDataWaliPs::where('id_user',$id_user)->first();
        $step_5 = CamabaDataRiwayatPendidikan::where('id_user',$id_user)->first();
        $step_6 = CamabaDataProgramStudi::where('id_user',$id_user)->first();
        $step_7 = CamabaDataDokumen::where('id_user',$id_user)->first();
        $step_8 = CamabaDataPernyataan::where('id_user',$id_user)->first();

        if(!auth()->guest() && auth()->user()->role_id==8){
            return view('theme::pendaftaran.validasi-pendaftaran.detail.index',array(
                'tahun_ajaran'=>$ta,
                'agama'=>$agama,
                'pendidikan'=>$pendidikan,
                'pekerjaan'=>$pekerjaan,
                'penghasilan'=>$penghasilan,
                'prodi'=>$prodi,
                'step_1'=>$step_1,
                'step_2'=>$step_2,
                'step_3'=>$step_3,
                'step_4'=>$step_4,
                'step_5'=>$step_5,
                'step_6'=>$step_6,
                'step_7'=>$step_7,
                'step_8'=>$step_8,
            ));
        }else{
            return abort(404);
        }
    }
}
