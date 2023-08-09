<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\ExamSchedules;
use App\Models\ExamInterview;
use App\Models\ExamReadQuran;
use App\Models\ExamReadQuranMember;
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
use DateTime;

class ExaminationQuranController extends Controller
{
    public function index($id)
    {
        $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $examInt = ExamReadQuran::where('id',$id)->first();

        $date_now = new DateTime();
        $date_start    = new DateTime($examInt->tanggal.' '.$examInt->waktu);  
        $soal = null;
        $is_time_now = false;
        if ($date_now >= $date_start) {
            $is_time_now = true;            
            
            $peserta = ExamReadQuranMember::where('id_exam_read_quran',$id)
            ->with(['getCamabaDataPokok'])
            ->get()
            ->each(function ($items) {
                $items->makeHidden(['getPilihanProdi','getUsers','getInfoLunas','getInfoAdm']);            
            }); 
        }

        
        
        if(!auth()->guest() && auth()->user()->role_id==10){
            return view('theme::penguji.pengujian.examination-quran.index',array(                
                'ta'=>self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap"),
                'is_time_now'=>$is_time_now,
                'peserta'=>$peserta,
                'id_exam_read_quran'=>$id,
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