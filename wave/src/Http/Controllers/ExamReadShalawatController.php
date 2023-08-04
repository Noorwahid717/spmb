<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\User;
use App\Models\ExamSchedules;
use App\Models\ExamReadShalawat;
use App\Models\ExamReadShalawatMember;
use App\Models\ProdiFakultas;
use App\Models\CamabaDataProgramStudi;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Arr;
use Str;

class ExamReadShalawatController extends Controller
{
    public function index($id)
    {
        $schedule = ExamSchedules::where('id',$id)->first();
        $ta_aktif = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;     
        $penguji = User::where('role_id',10)->get();   
        if(!auth()->guest() && auth()->user()->role_id==9){
            return view('theme::seleksi.exam_read_shalawat.index',array(
                'schedule'=>$schedule,
                'ta_long'=>self::left($schedule->tahun_akademik,4)."/".((int)self::left($schedule->tahun_akademik,4)+1).(self::right($schedule->tahun_akademik,1)=="1"?" Ganjil":" Genap"),
                'ta_aktif'=>self::left($ta_aktif,4)."/".((int)self::left($ta_aktif,4)+1).(self::right($ta_aktif,1)=="1"?" Ganjil":" Genap"),
                'penguji'=>$penguji
            ));
        }else{
            return abort(404);
        }
    }

    public function getList(Request $req)
    {      
        $read_shalawat = ExamReadShalawat::where('id_exam_schedule',$req->id_exam_schedule)
        ->withCount(['getExamReadShalawatMember' => function($q){
            return $q->where('status_lolos',1);
        }])->get()
        ->each(function ($items) {
            $items->makeHidden(['getExamReadShalawatMember','getUsers']);            
        });         
        if ($req->ajax()) {
            return DataTables::of($read_shalawat)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row)use(&$req){   
                    $actionBtn =                    
                    '<a '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="editModalClick(
                        \''.$row->id.'\',
                        \''.$row->id_penguji.'\',
                        \''.$row->nama_sesi.'\',
                        \''.$row->tanggal.'\',
                        \''.$row->waktu.'\',
                        \''.$row->tempat.'\');"'.
                        'data-modal="#editExamReadShalawatModal" rel="modal:open" href="#editExamReadShalawatModal">'.
                    '<img src="'.asset('/themes/tailwind/images/pen.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>'.
                    '<button '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="deleteModalClick(
                        \''.$row->id.'\',
                        \''.$row->id_penguji.'\',
                        \''.$row->nama_sesi.'\',
                        \''.$row->nama_penguji.'\',
                        \''.$req->ta_long.'\',
                        \''.$req->keterangan.'\');">'.  
                    '<img src="'.asset('/themes/tailwind/images/delete.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</button>';
                    return $actionBtn;
                })              
                ->editColumn('updated_at',function($row){                    
                    return $row->updated_at->diffForHumans();
                })
                ->addColumn('waktu_custom',function($row){                    
                    return '<div style="display:flex;align-items: center;margin-top:1px">'.self::left($row->waktu,5).
                    '<img title=" Tempat: '.$row->tempat.' "'.
                    'src="'.asset('/themes/tailwind/images/info.png').'" class="w-4 h-4 rounded ml-2"></div>';
                })
                ->addColumn('jumlah_peserta_custom',function($row){ 
                    return '<a onClick="setIdExamReadShalawatModal(\''.$row->id.'\',
                    \''.$row->tanggal.'\',
                    \''.self::left($row->waktu,5).'\',
                    \''.$row->tempat.'\',
                    \''.$row->nama_penguji.'\',
                    \''.$row->nama_sesi.'\')" style="display:flex;align-items: center;margin-top:1px" data-modal="#detailExamReadShalawatMemberModal" rel="modal:open" href="#detailExamReadShalawatMemberModal">'.$row->jumlah_peserta.
                    '<img title=" Detail Peserta "'.
                    'src="'.asset('/themes/tailwind/images/info.png').'" class="w-4 h-4 rounded ml-2"></a>';
                })              
                ->addColumn('jumlah_lolos',function($row){
                    return $row->get_exam_read_shalawat_member_count.' Camaba';
                })  
                ->rawColumns(['act','waktu_custom','jumlah_peserta_custom','jumlah_lolos'])
                ->make(true);
        }
    }

    public function getListAvailable(Request $req)
    {
        $ta_aktif = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;        
        $joined = ExamReadShalawatMember::where('tahun_akademik_seleksi',$ta_aktif)->where('status_lolos','<>','-1')->pluck('id_camaba')->toArray();
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
                        \''.$req->id_exam_read_shalawat.'\',
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

    public function addExamReadShalawat(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {            
            if(ExamReadShalawat::where('id_exam_schedule',$req->id_exam_schedule)
            ->where('id_penguji',$req->id_penguji)->where('nama_sesi',$req->session_name)->first()!=null){
                $res['error']=true;
                $res['message']="Data ujian hafalan shalawat wahidiyah gagal disimpan, sudah ada ujian hafalan shalawat wahidiyah, dengan penguji, nama sesi, dan penjadwalan ujian pada tahun akademik yang sama!";
            }else{
                $data = new ExamReadShalawat();
                $data->id_exam_schedule = $req->id_exam_schedule;
                $data->id_penguji = $req->id_penguji;
                $data->nama_sesi = $req->session_name;
                $data->tanggal = $req->tanggal_read_shalawat;
                $data->waktu = $req->waktu_read_shalawat;
                $data->tempat = $req->tempat_read_shalawat;

                if($data->save()){
                    $res['message']="Data ujian hafalan shalawat wahidiyah berhasil disimpan.";
                }else{
                    $res['error']=true;
                    $res['message']="Data ujian hafalan shalawat wahidiyah gagal disimpan!";
                }                    
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updateExamReadShalawat(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            if($req->old_session_name==$req->session_name){
                $data = ExamReadShalawat::where('id',$req->id)->first();
                $data->id_penguji = $req->id_penguji;
                $data->tanggal = $req->tanggal_read_shalawat;
                $data->waktu = $req->waktu_read_shalawat;
                $data->tempat = $req->tempat_read_shalawat;

                if($data->save()){
                    $res['message']="Data ujian hafalan shalawat wahidiyah berhasil diupdate.";
                }else{
                    $res['error']=true;
                    $res['message']="Data ujian hafalan shalawat wahidiyah gagal diupdate!";
                } 
            }else{              
                if(ExamReadShalawat::where('id_exam_schedule',$req->id_exam_schedule)
                ->where('id_penguji',$req->id_penguji)->where('nama_sesi',$req->session_name)->first()!=null){
                    $res['error']=true;
                    $res['message']="Data ujian hafalan shalawat wahidiyah gagal diupdate, sudah ada ujian hafalan shalawat wahidiyah, dengan penguji, nama sesi, dan penjadwalan ujian pada tahun akademik yang sama!";
                }else{
                    $data = ExamReadShalawat::where('id',$req->id)->first();
                    $data->id_penguji = $req->id_penguji;
                    $data->nama_sesi = $req->session_name;
                    $data->tanggal = $req->tanggal_read_shalawat;
                    $data->waktu = $req->waktu_read_shalawat;
                    $data->tempat = $req->tempat_read_shalawat;

                    if($data->save()){
                        $res['message']="Data ujian hafalan shalawat wahidiyah berhasil diupdate.";
                    }else{
                        $res['error']=true;
                        $res['message']="Data ujian hafalan shalawat wahidiyah gagal diupdate!";
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
            if(CamabaDataProgramStudi::where('id_user',$req->id_camaba)->first()==null){
                $res['error']=true;
                $res['message']="Gagal menambah peserta hafalan shalawat wahidiyah, peserta belum memilih program studi!";
            }else{
                $data = new ExamReadShalawatMember();
                $data->id_exam_read_shalawat = $req->id_exam_read_shalawat;
                $data->id_camaba = $req->id_camaba;
                $data->tahun_akademik_seleksi = $req->ta_seleksi;
    
                if($data->save()){
                    $res['message']="Peserta hafalan shalawat wahidiyah berhasil disimpan.";
                }else{
                    $res['error']=true;
                    $res['message']="Peserta hafalan shalawat wahidiyah gagal disimpan!";
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
        $joined = ExamReadShalawatMember::where('id_exam_read_shalawat',$req->id_exam_read_shalawat)
        ->get()
        ->each(function ($items) {
            $items->makeHidden(['getInfoAdm','getInfoLunas','getPilihanProdi','getUsers','getNilaiKelancaran','getNilaiTajwid','getNilaiMakhraj']);            
        });        
        if ($req->ajax()) {
            return DataTables::of($joined)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row)use(&$req){   
                    $actionBtn =                                        
                    '<button title="Hapus Peserta"'.
                    'class="inline-flex self-start items-center" '.
                    'onClick="deleteMemberClick(
                        \''.$req->id_exam_read_shalawat.'\',
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
            $data = ExamReadShalawatMember::where('id_exam_read_shalawat',$req->id_exam_read_shalawat)
            ->where('id_camaba',$req->id_camaba)->where('tahun_akademik_seleksi',$req->ta_seleksi)->first();

            if($data->id_nilai_kelancaran!=null||
            $data->id_nilai_tajwid!=null||
            $data->id_nilai_makhraj!=null){
                $res['error']=true;
                $res['message']="Data peserta hafalan shalawat wahidiyah gagal dihapus, sudah terdapat hasil ujian pada peserta ini!";
            }else{
                if($data->delete()){
                    $res['message']="Peserta hafalan shalawat wahidiyah berhasil dihapus.";
                }else{
                    $res['error']=true;
                    $res['message']="Peserta hafalan shalawat wahidiyah gagal dihapus!";
                }                     
            }                     
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function deleteExamReadShalawat(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $member = ExamReadShalawatMember::where('id_exam_read_shalawat',$req->id)
            ->get();
                        
            if(count($member)!=0){
                $res['error']=true;
                $res['message']="Data ujian hafalan shalawat wahidiyah gagal dihapus, terdapat peserta yang sudah terjadwal pada ujian ini!";
            }else{
                $data = ExamReadShalawat::where('id',$req->id)->first();
                if($data->delete()){
                    $res['message']="Data ujian hafalan shalawat wahidiyah berhasil dihapus.";
                }else{
                    $res['error']=true;
                    $res['message']="Data ujian hafalan shalawat wahidiyah gagal dihapus!";
                }                    
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