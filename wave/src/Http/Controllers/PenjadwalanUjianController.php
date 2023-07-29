<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\PeriodeAkademik;
use App\Models\User;
use App\Models\ExamSchedules;
use App\Models\ProdiFakultas;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Arr;
use Str;

class PenjadwalanUjianController extends Controller
{
    public function index()
    {
        $prodi = ProdiFakultas::all();
        $periode = PeriodeAkademik::all();

        if(!auth()->guest() && auth()->user()->role_id==9){
            return view('theme::seleksi.penjadwalan_ujian.index',array(
                'prodi'=>$prodi,
                'periode'=>$periode,
            ));
        }else{
            return abort(404);
        }
    }

    public function getList(Request $req)
    {
        $filter_periode = $req->filter_periode;       
        $exams = ExamSchedules::where(function ($query) use(&$filter_periode) {
            if($filter_periode=="all"){
                return $query;
            }else{
                return $query->where('tahun_akademik', '=', $filter_periode);
            }
        })
        ->get()
        ->each(function ($items) {
            $items->makeHidden(['getExamInterview','getExamReadQuran','getExamReadShalawat','getExamAcademic']);            
        });

        if ($req->ajax()) {
            return DataTables::of($exams)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row){   
                    $actionBtn =                    
                    // '<a '.
                    // 'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    // 'onClick="detailModalClick(
                    //     \''.$row->id.'\',
                    //     \''.$row->tahun_akademik.'\',
                    //     \''.$row->keterangan.'\',
                    //     \''.$row->start_date.'\',
                    //     \''.$row->end_date.'\');"'.  
                    // 'data-modal="#detailBankSoalModal" rel="modal:open" href="#detailBankSoalModal"> '.
                    // '<img src="'.asset('/themes/tailwind/images/search.png').'" class="w-6 rounded sm:mx-auto"> '.
                    // '</a>'.
                    '<a '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="editModalClick(
                        \''.$row->id.'\',
                        \''.$row->tahun_akademik.'\',
                        \''.$row->keterangan.'\',
                        \''.$row->start_date.'\',
                        \''.$row->end_date.'\');"'.
                        'data-modal="#editPenjadwalanUjianModal" rel="modal:open" href="#editPenjadwalanUjianModal">'.
                    '<img src="'.asset('/themes/tailwind/images/pen.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>'.
                    '<button '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="deleteModalClick(
                        \''.$row->id.'\',
                        \''.self::left($row->tahun_akademik,4)."/".((int)self::left($row->tahun_akademik,4)+1).(self::right($row->tahun_akademik,1)=="1"?" Ganjil":" Genap").'\',
                        \''.$row->keterangan.'\');">'.  
                    '<img src="'.asset('/themes/tailwind/images/delete.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</button>';
                    return $actionBtn;
                })              
                ->editColumn('updated_at',function($row){                    
                    return $row->updated_at->diffForHumans();
                })
                ->addColumn('status',function($row){      
                    $start = $row->start_date; 
                    $end = $row->end_date;
                    $now = now()->format('Y-m-d');
                    if($now<$start){
                        $status = 
                        '<span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Not Started</span>';    
                    } else if($now>$end){
                        $status = 
                        '<span class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Finished</span>';    
                    }else{
                        $status =                     
                        '<span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Running</span>';
                    }
                    
                    return $status;
                })
                ->addColumn('exams',function($row){                   
                    $exams = 
                    '<a href="'.url('exam-academic/'.$row->id).'" title="Seleksi Akademik"'.
                    'class="mr-3 inline-flex self-start items-center" '.
                    '>'.  
                    '<img src="'.asset('/themes/tailwind/images/cap.png').'" class="w-10 rounded sm:mx-auto"> '.
                    '<span class="cusbadges items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full">'.$row->jml_academic.'</span>'.
                    '</a>'.
                    '<a href="'.url('exam-interview/'.$row->id).'" title="Seleksi Wawancara"'.
                    'class="mr-3 inline-flex self-start items-center" '.
                    '>'.  
                    '<img src="'.asset('/themes/tailwind/images/interview.png').'" class="w-10 rounded sm:mx-auto"> '.                    
                    '<span class="cusbadges items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full">'.$row->jml_wawancara.'</span>'.
                    '</a>'.
                    '<a href="'.url('exam-read-quran/'.$row->id).'" title="Seleksi Baca Al-Qur\'an"'.
                    'class="mr-3 inline-flex self-start items-center" '.
                    '>'.  
                    '<img src="'.asset('/themes/tailwind/images/quran.png').'" class="w-10 rounded sm:mx-auto"> '.
                    '<span class="cusbadges items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full">'.$row->jml_baca_quran.'</span>'.
                    '</a>'.
                    '<a href="'.url('exam-read-shalawat/'.$row->id).'" title="Seleksi Hafalan Sholawat Wahidiyah"'.
                    'class="mr-2 inline-flex self-start items-center" '.
                    '>'.  
                    '<img src="'.asset('/themes/tailwind/images/praise.png').'" class="w-10 rounded sm:mx-auto"> '.
                    '<span class="cusbadges items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full">'.$row->jml_baca_shalawat.'</span>'.
                    '</a>';                    
                    return $exams;
                })
                ->editColumn('tahun_akademik',function($row){
                    $ta = $row->tahun_akademik;
                    $ta = self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap");;
                    return $ta;
                })
                ->rawColumns(['act','status','exams'])
                ->make(true);
        }
    }
    
    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }

    public function addPenjadwalanUjian(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = new ExamSchedules();
            $data->tahun_akademik = $req->tahun_akademik;
            $data->keterangan = $req->keterangan;
            $data->start_date = $req->tanggal_mulai;
            $data->end_date = $req->tanggal_selesai;

            if($data->save()){
                $res['message']="Data penjadwalan ujian berhasil disimpan.";
            }else{
                $res['error']=true;
                $res['message']="Data penjadwalan ujian gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function deletePenjadwalanUjian(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = ExamSchedules::where('id',$req->id)->first();
            if($data->delete()){
                $res['message']="Data penjadwalan ujian berhasil dihapus.";
            }else{
                $res['error']=true;
                $res['message']="Data penjadwalan ujian gagal dihapus!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updatePenjadwalanUjian(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            if($req->old_keterangan==$req->keterangan){
                $data = ExamSchedules::where('id',$req->id)->first();
                $data->tahun_akademik = $req->tahun_akademik;
                $data->start_date = $req->tanggal_mulai;
                $data->end_date = $req->tanggal_selesai;

                if($data->save()){
                    $res['message']="Data ujian baca al-quran berhasil diupdate.";
                }else{
                    $res['error']=true;
                    $res['message']="Data ujian baca al-quran gagal diupdate!";
                } 
            }else{ 
                if(ExamSchedules::where('tahun_akademik',$req->tahun_akademik)
                    ->where('keterangan',$req->keterangan)->first()!=null){
                        $res['error']=true;
                        $res['message']="Data penjadwalan ujian gagal diupdate, sudah ada penjadwalan ujian, dengan keterangan dan tahun akademik yang sama!";
                }else{
                    $data = ExamSchedules::where('id',$req->id)->first();
                    $data->tahun_akademik = $req->tahun_akademik;
                    $data->keterangan = $req->keterangan;
                    $data->start_date = $req->tanggal_mulai;
                    $data->end_date = $req->tanggal_selesai;

                    if($data->save()){
                        $res['message']="Data penjadwalan ujian berhasil diupdate.";
                    }else{
                        $res['error']=true;
                        $res['message']="Data penjadwalan ujian gagal diupdate!";
                    }                    
                }                    
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }
}