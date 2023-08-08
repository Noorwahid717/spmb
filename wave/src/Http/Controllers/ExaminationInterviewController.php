<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\ExamSchedules;
use App\Models\ExamInterview;
use App\Models\ExamInterviewMember;
use App\Models\ExamInterviewMemberResult;
use App\Models\InterviewQuestion;
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
use DateTime;

class ExaminationInterviewController extends Controller
{
    public function index($id)
    {
        $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $examInt = ExamInterview::where('id',$id)->first();

        $date_now = new DateTime();
        $date_start    = new DateTime($examInt->tanggal.' '.$examInt->waktu);  
        $soal = null;
        $is_time_now = false;
        if ($date_now >= $date_start) {
            $is_time_now = true;            
            $examIntMem = ExamInterviewMember::where('id_exam_interview',$examInt->id)->first();
            $soal = ExamInterviewMemberResult::where('id_exam_interview_member',$examIntMem->id)
            ->get();
            // ->each(function ($items) {
            //     $items->makeHidden(['getBankSoal']);            
            // });
            $peserta = ExamInterviewMember::where('id_exam_interview',$id)
            ->withCount(['getExamInterviewMemberResult'=>function($q){
                return $q->where('jawaban_interviewer','!=',null);
            }])
            ->with(['getCamabaDataPokok'])
            ->get()
            ->each(function ($items) {
                $items->makeHidden(['getPilihanProdi','getUsers','getInfoLunas','getInfoAdm']);            
            }); 
            // dd($peserta);                       
        }

        if(!auth()->guest() && auth()->user()->role_id==10){
            return view('theme::penguji.pengujian.examination-interview.index',array(
                'ta'=>self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap"),
                'soal'=>$soal,
                'is_time_now'=>$is_time_now,
                'peserta'=>$peserta,
                'id_exam_interview'=>$id,
            ));
        }else{
            return abort(404);
        }
    }

    public function updateListMember(Request $req)
    {
        $res['error']=false;
        $res['member']=array();
        $res['soal']=array();
        $res['is_time_now']=false;
        $res['message']="";

        try{
            $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
            $examInt = ExamInterview::where('id',$req->id)->first();

            $date_now = new DateTime();
            $date_start    = new DateTime($examInt->tanggal.' '.$examInt->waktu);  
            $soal = null;
            $is_time_now = false;
            if ($date_now >= $date_start) {
                $is_time_now = true;            
                // $examIntMem = ExamInterviewMember::where('id_exam_interview',$examInt->id)->first();
                // $soal = ExamInterviewMemberResult::where('id_exam_interview_member',$examIntMem->id)
                // ->get();
                // ->each(function ($items) {
                //     $items->makeHidden(['getBankSoal']);            
                // });
                $peserta = ExamInterviewMember::where('id_exam_interview',$req->id)
                ->withCount(['getExamInterviewMemberResult'=>function($q){
                    return $q->where('jawaban_interviewer','!=',null);
                }])
                ->with(['getCamabaDataPokok'])
                ->get()
                ->each(function ($items) {
                    $items->makeHidden(['getPilihanProdi','getUsers','getInfoLunas','getInfoAdm']);            
                }); 
            }
            $res['member']=$peserta;
            $res['soal']=$soal;
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