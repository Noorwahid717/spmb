<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExamCategories;
use App\Models\ExamAcademic;
use App\Models\ExamAcademicMember;
use App\Models\ExamAcademicMemberResult;
use App\Models\ExamInterview;
use App\Models\ExamInterviewMember;
use App\Models\ExamReadQuran;
use App\Models\ExamReadQuranMember;
use App\Models\ExamReadShalawat;
use App\Models\ExamReadShalawatMember;
use App\Models\CamabaDataProgramStudi;
use App\Models\SpmbConfig;

use DateTime;

class SeleksiController extends Controller
{
    public function index()
    {
        if(!auth()->guest() && auth()->user()->role_id==3){
            $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
            $examCat = ExamCategories::all();
            // $prodi = CamabaDataProgramStudi::where('id_user',auth()->user()->id)->first()
            // ->makeHidden(['getProdiFakultas1','getProdiFakultas2','getFakultas']);

            $examAcaMem = ExamAcademicMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();
            $examAca = $examAcaMem==null?null:ExamAcademic::where('id',$examAcaMem->id_exam_academic)->first();
            $examAcaMemResAll = $examAcaMem==null?null:ExamAcademicMemberResult::where('id_exam_academic_member',$examAcaMem->id)->get();
            $examAcaMemRes = $examAcaMem==null?null:ExamAcademicMemberResult::where('id_exam_academic_member',$examAcaMem->id)
            ->where('selected_answer',1)->get();
            $examAcaMemResNull = $examAcaMem==null?null:ExamAcademicMemberResult::where('id_exam_academic_member',$examAcaMem->id)
            ->where('selected_answer',null)->get();
            // jumlah benar
            $total_question = $examAcaMem==null?0:count($examAcaMemResAll);
            $correct = $examAcaMem==null?0:count($examAcaMemRes);
            $tak_jawab = $examAcaMem==null?0:count($examAcaMemResNull);
            $incorrect = $total_question-$correct-$tak_jawab;
            // jumlah benar * poin pengali
            $total_poin = 0;
            if($examAcaMem!=null){
                foreach ($examAcaMemRes as $key => $value) {
                    $total_poin += $value->poin;  
                }
            }

            $is_startable = true;
            $date_now = new DateTime();
            $date_start    = $examAcaMem==null?null:new DateTime($examAca->tanggal.' '.$examAca->waktu_mulai);  
            $date_end    = $examAcaMem==null?null:new DateTime($examAca->tanggal.' '.$examAca->waktu_selesai);    
            if ($date_end < $date_now ) {
                $is_startable = false;
            }

            $examIntMem = ExamInterviewMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();
            $examInt = $examIntMem==null?null:ExamInterview::where('id',$examIntMem->id_exam_interview)->first();
            
            $examRQMem = ExamReadQuranMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();            
            $examRQMem = $examRQMem==null?null:$examRQMem->makeHidden(['getNilaiKelancaran','getNilaiTajwid','getNilaiMakhraj']);
            $examRQ = $examRQMem==null?null:ExamReadQuran::where('id',$examRQMem->id_exam_read_quran)->first();

            $examRSMem = ExamReadShalawatMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();
            $examRSMem = $examRSMem==null?null:$examRSMem->makeHidden(['getNilaiKelancaran','getNilaiTajwid','getNilaiMakhraj']);
            $examRS = $examRSMem==null?null:ExamReadShalawat::where('id',$examRSMem->id_exam_read_shalawat)->first();

            

            return view('theme::camaba.seleksi.index',array(
                'examCat'=>$examCat,
                'examAcaMem'=>$examAcaMem,
                'examAca'=>$examAca,
                'examIntMem'=>$examIntMem,
                'examInt'=>$examInt,
                'examRQMem'=>$examRQMem,
                'examRQ'=>$examRQ,
                'examRSMem'=>$examRSMem,
                'examRS'=>$examRS,
                // 'prodi'=>$prodi,
                'is_startable'=>$is_startable,
                'total_question'=>$total_question,
                'total_poin'=>$total_poin,
                'correct'=>$correct,
                'incorrect'=>$incorrect,
                'tak_jawab'=>$tak_jawab,
            ));
        }else{
            return abort(404);
        }
    }
}
