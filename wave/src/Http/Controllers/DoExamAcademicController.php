<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\User;
use App\Models\BankSoal;
use App\Models\ProdiFakultas;
use App\Models\ExamAcademic;
use App\Models\ExamAcademicMember;
use App\Models\ExamAcademicMemberResult;
use App\Models\CamabaDataProgramStudi;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Arr;
use Str;
use DateTime;

class DoExamAcademicController extends Controller
{
    public function index()
    {
        $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $examAcaMem = ExamAcademicMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();
        $examAca = ExamAcademic::where('id',$examAcaMem->id_exam_academic)->first();
        $ta = self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap");
        $prodi = CamabaDataProgramStudi::where('id_user',auth()->user()->id)->first();

        $date_now = new DateTime();
        $date_start    = new DateTime($examAca->tanggal.' '.$examAca->waktu_mulai);    
        $date_end    = new DateTime($examAca->tanggal.' '.$examAca->waktu_selesai);    
        
        $soal = null;
        $is_time_now = false;
        $is_editable = false;
        if ($date_now >= $date_start) {
            $is_time_now = true;            
            $soal = ExamAcademicMemberResult::where('id_exam_academic_member',$examAcaMem->id)->get()
            ->each(function ($items) {
                $items->makeHidden(['getBankSoal']);            
            });
        }

        if ($date_start <= $date_now && $date_end >= $date_now ) {
            $is_editable = true;
        }
        
        if(!auth()->guest() && auth()->user()->role_id==3){
            return view('theme::camaba.seleksi.do_exam_academic.index',array(
                'ta'=>$ta,
                'prodi'=>$prodi,
                'tanggal'=>$examAca->tanggal,
                'waktu_selesai'=>$examAca->waktu_selesai,
                'soal'=>$soal,
                'is_time_now'=>$is_time_now,
                'is_editable'=>$is_editable
            ));
        }else{
            return abort(404);
        }
    }
    
    public function updateList(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['is_time_now']=false;
        $res['message']="";

        $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $examAcaMem = ExamAcademicMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();
        $examAca = ExamAcademic::where('id',$examAcaMem->id_exam_academic)->first();
        $ta = self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap");
        $prodi = CamabaDataProgramStudi::where('id_user',auth()->user()->id)->first();

        $date_now = new DateTime();
        $date_start    = new DateTime($examAca->tanggal.' '.$examAca->waktu_mulai);  
        $date_end    = new DateTime($examAca->tanggal.' '.$examAca->waktu_selesai);    
        
        try {
            $soal = null;
            $is_time_now = false;
            $is_editable = false;
            if ($date_start <= $date_now && $date_end >= $date_now ) {
                $is_editable = true;
            }

            if($is_editable){
                $jawaban = ExamAcademicMemberResult::where('id',$req->id_exam_academic_member_result)->first();
                // dd($jawaban);
                $selected_answer=null;
                switch ($req->selected_answer) {
                    case 1:
                        $selected_answer=$jawaban->rand_idx_ans_a;
                        break;
                        case 2:
                            $selected_answer=$jawaban->rand_idx_ans_b;
                            break;
                            case 3:
                                $selected_answer=$jawaban->rand_idx_ans_c;
                                break;
                                case 4:
                                    $selected_answer=$jawaban->rand_idx_ans_d;
                                    break;
                                    case 5:
                                        $selected_answer=$jawaban->rand_idx_ans_e;
                                        break;
                    default:
                    $selected_answer=null;
                        break;
                }
                $jawaban->selected_answer = $req->selected_answer;
                $jawaban->save();
            }

            if ($date_now >= $date_start) {
                $is_time_now = true;
                $soal = ExamAcademicMemberResult::where('id_exam_academic_member',$examAcaMem->id)->get();
                $res['data']=$soal;
            }
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
        }
        
        $res['is_editable']=$is_editable;
        return response()->json($res);
    }

    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }


}