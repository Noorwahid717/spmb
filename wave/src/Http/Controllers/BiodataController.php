<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Models\SpmbStep;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class BiodataController extends Controller
{
    public function index()
    {
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-agama');
        $agama = $response->json();
        if(!auth()->guest() && auth()->user()->role_id==3){
            return view('theme::biodata.index',array(
                'agama'=>$agama,
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
}
