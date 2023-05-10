<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SpmbConfig;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class BiodataController extends Controller
{
    public function index()
    {
        $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-agama');
        $agama = $response->json();
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-pendidikan');
        $pendidikan = $response->json();
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-pekerjaan');
        $pekerjaan = $response->json();
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-penghasilan');
        $penghasilan = $response->json();
        if(!auth()->guest() && auth()->user()->role_id==3){
            return view('theme::biodata.index',array(
                'tahun_ajaran'=>$ta,
                'agama'=>$agama,
                'pendidikan'=>$pendidikan,
                'pekerjaan'=>$pekerjaan,
                'penghasilan'=>$penghasilan,
            ));
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
}
