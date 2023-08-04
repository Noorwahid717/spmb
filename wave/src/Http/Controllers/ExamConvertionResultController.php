<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ExamConvertionResult;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\User;
use App\Models\InterviewQuestion;
use App\Models\ProdiFakultas;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Arr;
use Str;

class ExamConvertionResultController extends Controller
{
    public function index()
    {
        $prodi = ProdiFakultas::all();

        if(!auth()->guest() && auth()->user()->role_id==9){
            return view('theme::seleksi.exam_convertion_result.index',array(
                'prodi'=>$prodi,
            ));
        }else{
            return abort(404);
        }
    }

    public function getList(Request $req)
    {      
        $ecr = ExamConvertionResult::all();

        if ($req->ajax()) {
            return DataTables::of($ecr)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row){   
                    $actionBtn =                    
                    '<a '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="editModalClick(
                        \''.$row->id.'\',
                        \''.$row->range_nilai_awal.'\',
                        \''.$row->range_nilai_akhir.'\',
                        \''.$row->status.'\',
                        \''.$row->keterangan.'\');"'.
                        'data-modal="#editExamConvertionResultModal" rel="modal:open" href="#editExamConvertionResultModal">'.
                    '<img src="'.asset('/themes/tailwind/images/pen.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>'.
                    '<button '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="deleteModalClick(
                        \''.$row->id.'\',
                        \''.$row->range_nilai_awal.'\',
                        \''.$row->range_nilai_akhir.'\',
                        \''.$row->status.'\',
                        \''.$row->keterangan.'\');">'.  
                    '<img src="'.asset('/themes/tailwind/images/delete.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</button>';
                    return $actionBtn;
                })              
                ->editColumn('updated_at',function($row){                    
                    return $row->updated_at->diffForHumans();
                })
                ->addColumn('status_cust',function($row){
                    return $row->status==-1?'Tidak Lulus':'Lulus';
                })
                ->rawColumns(['act','status_cust'])
                ->make(true);
        }
    }
    
    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }

    public function addExamConvertionResult(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = new ExamConvertionResult();
            $data->range_nilai_awal = $req->range_nilai_awal;
            $data->range_nilai_akhir = $req->range_nilai_akhir;
            $data->status = $req->status;
            $data->keterangan = $req->keterangan;

            if($data->save()){
                $res['message']="Data konversi nilai potensi berhasil disimpan.";
            }else{
                $res['error']=true;
                $res['message']="Data konversi nilai potensi gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function deleteExamConvertionResult(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = ExamConvertionResult::where('id',$req->id)->first();
            if($data->delete()){
                $res['message']="Data konversi nilai potensi akademik berhasil dihapus.";
            }else{
                $res['error']=true;
                $res['message']="Data konversi nilai potensi akademik gagal dihapus!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    // public function updateExamConvertionResult(Request $req)
    // {
    //     $res['error']=false;
    //     $res['data']=array();
    //     $res['message']="";

    //     try {
    //         $data = ExamConvertionResult::where('id',$req->id)->first();
    // $data->range_nilai_awal = $req->range_nilai_awal;
    //         $data->range_nilai_akhir = $req->range_nilai_akhir;
    //         $data->status = $req->status;
    //         $data->keterangan = $req->keterangan;

    //         if($data->save()){
    //             $res['message']="Data konversi nilai potensi akademik berhasil diupdate.";
    //         }else{
    //             $res['error']=true;
    //             $res['message']="Data konversi nilai potensi akademik gagal diupdate!";
    //         }                    
    //     } catch (\Exception $e) {
    //         $res['error']=true;
    //         $res['message']=$e->getMessage();
    //       }

    //     return response()->json($res);
    // }
}