<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use Str;
use DataTables;
use File;
use Storage;
use Illuminate\Support\Arr;

class TagihanCamabaController extends Controller
{
    public function index()
    {
        $ta_aktif = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $reg_awal_data = RegistrasiAwalUser::with('getUser')
        ->where('tahun_akademik_registrasi',$ta_aktif)
        ->where('id_user',auth()->user()->id)
        ->first();
        if(!auth()->guest() && auth()->user()->role_id==3){
            return view('theme::camaba.tagihan.index',array(
                'reg_awal'=>$reg_awal_data
            ));
        }else{
            return abort(404);
        }
    }

    public function updateSlipPendaftaran(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $image = $req->url_bukti_bayar;  // your base64 encoded
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(50).'.'.'png';
            \File::put(storage_path(). '/app/public/tempat_bukti_pembayaran/' . $imageName, base64_decode($image));
            
            $data = RegistrasiAwalUser::where('id_user','=',$req->id_user)
            ->where('tahun_akademik_registrasi','=',$req->ta_registrasi)
            ->first();
            $old_foto = $data->url_bukti_bayar;
            $data->url_bukti_bayar = 'tempat_bukti_pembayaran/'.$imageName;
            if($data->save()){
                $res['message']="Upload bukti pembayaran berhasil.";
                $file_path = public_path().'/storage/'.$old_foto;
                if($old_foto!=""){
                    unlink($file_path);
                }
                // update data user
                $user = User::where('id',$req->id_user)->first();
                $user->bukti_pembayaran = $data->url_bukti_bayar; 
                $user->save();                             
            }else{
                $res['error']=true;
                $res['message']="Upload bukti pembayaran gagal!";
            }
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }
    
    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }
}
