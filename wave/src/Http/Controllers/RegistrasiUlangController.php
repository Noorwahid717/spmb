<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Arr;

class RegistrasiUlangController extends Controller
{
    public function index()
    {
        if(!auth()->guest() && auth()->user()->role_id==7){
            return view('theme::bendahara.registrasi_ulang.index',array(
                // 'tahun_ajaran'=>$ta,
            ));
        }else{
            return abort(404);
        }
    }
    
    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }
}
