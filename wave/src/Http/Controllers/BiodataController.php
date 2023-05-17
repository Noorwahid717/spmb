<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SpmbConfig;
use App\Models\UserSpmbStep;
use App\Models\ProdiFakultas;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class BiodataController extends Controller
{
    public function index()
    {
        $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
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
        if(!auth()->guest() && auth()->user()->role_id==3){
            if(UserSpmbStep::where('user_id',auth()->user()->id)->first()->step_2==1){
                return view('theme::biodata.index',array(
                    'tahun_ajaran'=>$ta,
                    'agama'=>$agama,
                    'pendidikan'=>$pendidikan,
                    'pekerjaan'=>$pekerjaan,
                    'penghasilan'=>$penghasilan,
                    'prodi'=>$prodi,
                ));
            }else{
            return abort(404);
            }
        }else{
            return abort(404);
        }
    }

    public function cariKewarganegaraan(Request $req)
    {
        if ($req->has('query')) {
            $cari = $req->get('query');
            $response = Http::post('sia-uniwa.ddns.net:3000/api/cari-negara',[
                "nama_negara" => $cari
            ]);
            $citizenship = $response->json();
            return response()->json($citizenship);
        }
    }

    public function cariWilayah(Request $req)
    {
        if ($req->has('query')) {
            $cari = $req->get('query');
            $response = Http::post('sia-uniwa.ddns.net:3000/api/cari-wilayah',[
                "nama_wilayah" => $cari
            ]);
            $wilayah = $response->json();
            return response()->json($wilayah);
        }
    }

    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }
}
