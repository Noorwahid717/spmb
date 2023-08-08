<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\ExamSchedules;
use App\Models\ExamInterview;
use App\Models\ExamReadQuran;
use App\Models\ExamReadShalawat;
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

class ExaminationQuranController extends Controller
{
    public function index()
    {
                
        if(!auth()->guest() && auth()->user()->role_id==10){
            return view('theme::penguji.pengujian.examination-quran.index',array(
                
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