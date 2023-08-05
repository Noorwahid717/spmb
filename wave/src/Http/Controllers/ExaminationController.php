<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\User;
use App\Models\BankSoal;
use App\Models\ProdiFakultas;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Arr;
use Str;

class ExaminationController extends Controller
{
    public function index()
    {
        $prodi = ProdiFakultas::all();

        if(!auth()->guest() && auth()->user()->role_id==10){
            return view('theme::penguji.pengujian.index',array(
                'prodi'=>$prodi,
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