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

class ExaminationController extends Controller
{
    public function index()
    {
        $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $prodi = ProdiFakultas::all();
        $schedule = ExamSchedules::where('tahun_akademik',$ta)->pluck('id');
        
        $interview = ExamInterview::whereIn('id_exam_schedule',$schedule)
        ->where('id_penguji',auth()->user()->id)->withCount(['getExamInterviewMember'=>function($q){
            return $q->where('status_lolos','!=',0);
        }])->get();
        
        $quran = ExamReadQuran::whereIn('id_exam_schedule',$schedule)
        ->where('id_penguji',auth()->user()->id)->withCount(['getExamReadQuranMember'=>function($q){
            return $q->where('status_lolos','!=',0);
        }])->get();

        $shalawat = ExamReadShalawat::whereIn('id_exam_schedule',$schedule)
        ->where('id_penguji',auth()->user()->id)->withCount(['getExamReadShalawatMember'=>function($q){
            return $q->where('status_lolos','!=',0);
        }])->get();
        
        
        if(!auth()->guest() && auth()->user()->role_id==10){
            return view('theme::penguji.pengujian.index',array(
                'ta_aktif'=>self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap"),
                'prodi'=>$prodi,
                'interview'=>$interview,
                'quran'=>$quran,
                'shalawat'=>$shalawat,
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