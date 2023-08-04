<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\User;
use App\Models\BankSoal;
use App\Models\InterviewQuestion;
use App\Models\ExamSchedules;
use App\Models\ExamAcademic;
use App\Models\ExamAcademicMember;
use App\Models\ExamAcademicMemberResult;
use App\Models\ProdiFakultas;
use App\Models\ExamConvertionResult;
use App\Models\CamabaDataProgramStudi;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use DateTime;
use Illuminate\Support\Arr;
use Str;

class ExamAcademicController extends Controller
{
    public function index($id)
    {
        $schedule = ExamSchedules::where('id',$id)->first();
        $ta_aktif = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;     
        if(!auth()->guest() && auth()->user()->role_id==9){
            return view('theme::seleksi.exam_academic.index',array(
                'schedule'=>$schedule,
                'ta_long'=>self::left($schedule->tahun_akademik,4)."/".((int)self::left($schedule->tahun_akademik,4)+1).(self::right($schedule->tahun_akademik,1)=="1"?" Ganjil":" Genap"),
                'ta_aktif'=>self::left($ta_aktif,4)."/".((int)self::left($ta_aktif,4)+1).(self::right($ta_aktif,1)=="1"?" Ganjil":" Genap"),
            ));
        }else{
            return abort(404);
        }
    }

    public function getList(Request $req)
    {      
        $academic = ExamAcademic::where('id_exam_schedule',$req->id_exam_schedule)
        ->withCount(['getExamAcademicMember'=>function($q){
            return $q->where('status_lolos',1);
        }])
        ->get()
        ->each(function ($items) {
            $items->makeHidden(['getExamAcademicMember','getUsers']);            
        });
        // return($academic);
        if ($req->ajax()) {
            return DataTables::of($academic)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row)use(&$req){   
                    $actionBtn =                    
                    '<a '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="editModalClick(
                        \''.$row->id.'\',
                        \''.$row->nama_sesi.'\',
                        \''.$row->tanggal.'\',
                        \''.self::left($row->waktu_mulai,5).'\',
                        \''.self::left($row->waktu_selesai,5).'\');"'.
                        'data-modal="#editExamAcademicModal" rel="modal:open" href="#editExamAcademicModal">'.
                    '<img src="'.asset('/themes/tailwind/images/pen.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>'.
                    '<button '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="deleteModalClick(
                        \''.$row->id.'\',
                        \''.$row->nama_sesi.'\',
                        \''.$req->ta_long.'\',
                        \''.$req->keterangan.'\');">'.  
                    '<img src="'.asset('/themes/tailwind/images/delete.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</button>'.
                    '<button '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="validateExamModalClick(
                        \''.$row->id.'\',
                        \''.$row->nama_sesi.'\',
                        \''.$req->ta_long.'\',
                        \''.$req->keterangan.'\');">'.  
                    '<img src="'.asset('/themes/tailwind/images/horn.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</button>';
                    return $actionBtn;
                })              
                ->editColumn('updated_at',function($row){                    
                    return $row->updated_at->diffForHumans();
                })
                ->addColumn('waktu_mulai_custom',function($row){                    
                    return '<div style="display:flex;align-items: center;margin-top:1px">'.self::left($row->waktu_mulai,5).
                    '</div>';
                })
                ->addColumn('waktu_selesai_custom',function($row){                    
                    return '<div style="display:flex;align-items: center;margin-top:1px">'.self::left($row->waktu_selesai,5).
                    '</div>';
                })
                ->addColumn('jumlah_peserta_custom',function($row){ 
                    return '<a onClick="setIdExamAcademicModal(\''.$row->id.'\',
                    \''.$row->tanggal.'\',
                    \''.self::left($row->waktu_mulai,5).' s.d. '.self::left($row->waktu_selesai,5).'\',
                    \''.$row->nama_sesi.'\')" style="display:flex;align-items: center;margin-top:1px" data-modal="#detailExamAcademicMemberModal" rel="modal:open" href="#detailExamAcademicMemberModal">'.$row->jumlah_peserta.
                    '<img title=" Detail Peserta "'.
                    'src="'.asset('/themes/tailwind/images/info.png').'" class="w-4 h-4 rounded ml-2"></a>';
                })                
                ->addColumn('jumlah_lolos_ujian',function($row){ 
                    return $row->get_exam_academic_member_count.' Camaba';                    
                })                
                ->rawColumns(['act','waktu_selesai_custom','waktu_mulai_custom','jumlah_peserta_custom','jumlah_lolos_ujian'])
                ->make(true);
        }
    }

    public function getListAvailable(Request $req)
    {
        $ta_aktif = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;        
        $joined = ExamAcademicMember::where('tahun_akademik_seleksi',$ta_aktif)->where('status_lolos','<>','-1')->pluck('id_camaba')->toArray();
        $available = RegistrasiAwalUser::where('tahun_akademik_registrasi',$ta_aktif)
        ->whereNotIn('id_user',$joined)
        ->get()
        ->each(function ($items) {
            $items->makeHidden(['getCamabaDataProgramStudi','getCamabaDataDokumen','getUser']);            
        });
        // $available = $available->whereNotIn('id_user',$joined);
        if ($req->ajax()) {
            return DataTables::of($available)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row)use(&$req){   
                    $actionBtn =                                        
                    '<button title="Tambah Peserta"'.
                    'class="inline-flex self-start items-center" '.
                    'onClick="addMemberClick(
                        \''.$req->id_exam_academic.'\',
                        \''.$row->id_user.'\',
                        \''.$req->ta_seleksi.'\');">'.  
                    '<img src="'.asset('/themes/tailwind/images/rewind-right.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</button>';
                    return $actionBtn;
                })              
                ->editColumn('updated_at',function($row){                    
                    return $row->updated_at->diffForHumans();
                })          
                ->addColumn('custom_adm',function($row){
                    return 
                    $row->adm == "Invalid"?
                    '<span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">'.
                    $row->adm.
                    '</span>'
                    :
                    '<span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">'
                    .$row->adm
                    .'</span>'
                    ;
                })
                ->addColumn('custom_lunas',function($row){
                    return 
                    $row->lunas == "Unpaid"?
                    '<span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">'.
                    $row->lunas.
                    '</span>'
                    :
                    '<span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">'
                    .$row->lunas
                    .'</span>'
                    ;
                })
                ->rawColumns(['act','custom_adm','custom_lunas'])
                ->make(true);
        }
    }

    public function addExamAcademic(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {            
            if(ExamAcademic::where('id_exam_schedule',$req->id_exam_schedule)
            ->where('nama_sesi',$req->session_name)->first()!=null){
                $res['error']=true;
                $res['message']="Data ujian akademik gagal disimpan, sudah ada ujian akademik, dengan nama sesi, dan penjadwalan ujian pada tahun akademik yang sama!";
            }else{
                $data = new ExamAcademic();
                $data->id_exam_schedule = $req->id_exam_schedule;
                $data->nama_sesi = $req->session_name;
                $data->tanggal = $req->tanggal_academic;
                $data->waktu_mulai = $req->waktu_mulai_academic;
                $data->waktu_selesai = $req->waktu_selesai_academic;

                if($data->save()){
                    $res['message']="Data ujian akademik berhasil disimpan.";
                }else{
                    $res['error']=true;
                    $res['message']="Data ujian akademik gagal disimpan!";
                }                    
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updateExamAcademic(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            if($req->old_session_name==$req->session_name){
                $data = ExamAcademic::where('id',$req->id)->first();
                $data->tanggal = $req->tanggal_academic;
                $data->waktu_mulai = $req->waktu_mulai_academic;
                $data->waktu_selesai = $req->waktu_selesai_academic;

                if($data->save()){
                    $res['message']="Data ujian akademik berhasil diupdate.";
                }else{
                    $res['error']=true;
                    $res['message']="Data ujian akademik gagal diupdate!";
                } 
            }else{              
                if(ExamAcademic::where('id_exam_schedule',$req->id_exam_schedule)
                ->where('nama_sesi',$req->session_name)->first()!=null){
                    $res['error']=true;
                    $res['message']="Data ujian akademik gagal diupdate, sudah ada ujian akademik, dengan nama sesi, dan penjadwalan ujian pada tahun akademik yang sama!";
                }else{
                    $data = ExamAcademic::where('id',$req->id)->first();
                    $data->nama_sesi = $req->session_name;
                    $data->tanggal = $req->tanggal_academic;
                    $data->waktu_mulai = $req->waktu_mulai_academic;
                    $data->waktu_selesai = $req->waktu_selesai_academic;

                    if($data->save()){
                        $res['message']="Data ujian akademik berhasil diupdate.";
                    }else{
                        $res['error']=true;
                        $res['message']="Data ujian akademik gagal diupdate!";
                    }                    
                }                    
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function addMember(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $camaba_prodi = CamabaDataProgramStudi::where('id_user',$req->id_camaba)->first();
            if($camaba_prodi==null){
                $res['error']=true;
                $res['message']="Gagal menambah peserta ujian akademik, peserta belum memilih program studi!";
            }else{
                $data = new ExamAcademicMember();
                $data->id_exam_academic = $req->id_exam_academic;
                $data->id_camaba = $req->id_camaba;
                $data->tahun_akademik_seleksi = $req->ta_seleksi;
    
                if($data->save()){
                    $res['message']="Peserta ujian akademik berhasil disimpan.";
                    $soal = BankSoal::where("id_prodi",$camaba_prodi->id_program_studi_1)
                    ->inRandomOrder()
                            ->limit(50)
                            ->get();
                    foreach ($soal as $key => $value) {
                        $plot = new ExamAcademicMemberResult();
                        $plot->id_exam_academic_member = $data->id;
                        $plot->id_bank_soal = $value->id;
                        $idx_ans = array(1,2,3,4,5);
                        shuffle($idx_ans);
                        $plot->rand_idx_ans_a = $idx_ans[0];
                        $plot->rand_idx_ans_b = $idx_ans[1];
                        $plot->rand_idx_ans_c = $idx_ans[2];
                        $plot->rand_idx_ans_d = $idx_ans[3];
                        $plot->rand_idx_ans_e = $idx_ans[4];
                        $plot->save();
                    }
                    // self::addRandomExamAcademicMemberResult($data->id,$camaba_prodi->id_program_studi_1);
                }else{
                    $res['error']=true;
                    $res['message']="Peserta ujian akademik gagal disimpan!";
                }                    
            }
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

   

    public function getListJoined(Request $req)
    {
        $joined = ExamAcademicMember::where('id_exam_academic',$req->id_exam_academic)
        ->get()
        ->each(function ($items) {
            $items->makeHidden(['getInfoAdm','getInfoLunas','getPilihanProdi','getUsers']);            
        });
        if ($req->ajax()) {
            return DataTables::of($joined)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row)use(&$req){   
                    $actionBtn =                                        
                    '<button title="Hapus Peserta"'.
                    'class="inline-flex self-start items-center" '.
                    'onClick="deleteMemberClick(
                        \''.$req->id_exam_academic.'\',
                        \''.$row->id_camaba.'\',
                        \''.$req->ta_seleksi.'\');">'.  
                    '<img src="'.asset('/themes/tailwind/images/rewind.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</button>';
                    return $actionBtn;
                })              
                ->editColumn('updated_at',function($row){                    
                    return $row->updated_at->diffForHumans();
                })          
                ->addColumn('custom_adm',function($row){
                    return 
                    $row->adm == "Invalid"?
                    '<span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">'.
                    $row->adm.
                    '</span>'
                    :
                    '<span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">'
                    .$row->adm
                    .'</span>'
                    ;
                })
                ->addColumn('custom_lunas',function($row){
                    return 
                    $row->lunas == "Unpaid"?
                    '<span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">'.
                    $row->lunas.
                    '</span>'
                    :
                    '<span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">'
                    .$row->lunas
                    .'</span>'
                    ;
                })
                ->rawColumns(['act','custom_adm','custom_lunas'])
                ->make(true);
        }
    }

    public function deleteMember(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = ExamAcademicMember::where('id_exam_academic',$req->id_exam_academic)
                ->where('id_camaba',$req->id_camaba)->where('tahun_akademik_seleksi',$req->ta_seleksi)->first();
            $id_del = $data->id;
            $memberResult = ExamAcademicMemberResult::where('id_exam_academic_member',$data->id)->whereNotNull('selected_answer')
            ->get();
                        
            if(count($memberResult)!=0){
                $res['error']=true;
                $res['message']="Data peserta ujian akademik gagal dihapus, sudah terdapat hasil ujian pada peserta ini!";
            }else{               
                if($data->delete()){
                    $res['message']="Peserta ujian akademik berhasil dihapus.";
                    $del = ExamAcademicMemberResult::where('id_exam_academic_member',$id_del)->get();
                    foreach ($del as $key => $value) {
                        $value->delete();
                    }
                }else{
                    $res['error']=true;
                    $res['message']="Peserta ujian akademik gagal dihapus!";
                }                     
            }                     
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function deleteExamAcademic(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $member = ExamAcademicMember::where('id_exam_academic',$req->id)
            ->get();
                        
            if(count($member)!=0){
                $res['error']=true;
                $res['message']="Data ujian akademik gagal dihapus, terdapat peserta yang sudah terjadwal pada ujian ini!";
            }else{
                $data = ExamAcademic::where('id',$req->id)->first();
                if($data->delete()){
                    $res['message']="Data ujian akademik berhasil dihapus.";
                }else{
                    $res['error']=true;
                    $res['message']="Data ujian akademik gagal dihapus!";
                }                    
            }
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function validateExamAcademic(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $examAca = ExamAcademic::where('id',$req->id)->first();
            $examAcaMem = ExamAcademicMember::where('id_exam_academic',$examAca->id)->get();
            $date_now = new DateTime();
            $date_end    = new DateTime($examAca->tanggal.' '.$examAca->waktu_selesai);    
            if ($date_end < $date_now ) {
                foreach ($examAcaMem as $key => $value) {
                    $examAcaMemRes = ExamAcademicMemberResult::where('id_exam_academic_member',$value->id)
                    ->where('selected_answer',1)->get();
                    
                    $total_poin = 0;
                    foreach ($examAcaMemRes as $key => $val) {
                        $total_poin += $val->poin;  
                    }
                    
                    $convertion = ExamConvertionResult::all();
                    $matched_convertion = null;
                    foreach ($convertion as $key => $v) {
                        if($total_poin >= $v->range_nilai_awal&&$total_poin <= $v->range_nilai_akhir){
                            $matched_convertion = $v;
                        }
                    }

                    $examAcaMem = ExamAcademicMember::where('id',$value->id)->first();
                    $examAcaMem->catatan = $matched_convertion->keterangan;
                    $examAcaMem->status_lolos = $matched_convertion->status;
                    $examAcaMem->save();
                }
                $res['message']="Berhasil memvalidasi semua jawaban ujian akademik!";
            }else{
                $res['error']=true;
                $res['message']="Gagal memvalidasi semua jawaban ujian akademik, waktu ujian belum dimulai/masih berlangsung!";
            }
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    static function left($str, $length) 
    {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) 
    {
        return substr($str, -$length);
    }
}