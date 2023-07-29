<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExamCategories;
use App\Models\ExamAcademic;
use App\Models\ExamAcademicMember;
use App\Models\ExamInterview;
use App\Models\ExamInterviewMember;
use App\Models\ExamReadQuran;
use App\Models\ExamReadQuranMember;
use App\Models\ExamReadShalawat;
use App\Models\ExamReadShalawatMember;
use App\Models\SpmbConfig;


class SeleksiController extends Controller
{
    public function index()
    {
        if(!auth()->guest() && auth()->user()->role_id==3){
            $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
            $examCat = ExamCategories::all();

            $examAcaMem = ExamAcademicMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();
            $examAca = $examAcaMem==null?null:ExamAcademic::where('id',$examAcaMem->id_exam_academic)->first();

            $examIntMem = ExamInterviewMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();
            $examInt = $examIntMem==null?null:ExamInterview::where('id',$examIntMem->id_exam_interview)->first();

            $examRQMem = ExamReadQuranMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();
            $examRQ = $examRQMem==null?null:ExamReadQuran::where('id',$examRQMem->id_exam_read_quran)->first();

            $examRSMem = ExamReadShalawatMember::where('id_camaba',auth()->user()->id)->where('tahun_akademik_seleksi',$ta)->first();
            $examRS = $examRSMem==null?null:ExamReadShalawat::where('id',$examRSMem->id_exam_read_shalawat)->first();

            return view('theme::camaba.seleksi.index',array(
                'examCat'=>$examCat,
                'examAca'=>$examAca,
                'examInt'=>$examInt,
                'examRQ'=>$examRQ,
                'examRS'=>$examRS,
            ));
        }else{
            return abort(404);
        }
    }
}
