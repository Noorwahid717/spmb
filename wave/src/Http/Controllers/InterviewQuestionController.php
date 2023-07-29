<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
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

class InterviewQuestionController extends Controller
{
    public function index()
    {
        $prodi = ProdiFakultas::all();

        if(!auth()->guest() && auth()->user()->role_id==9){
            return view('theme::seleksi.interview_soal.index',array(
                'prodi'=>$prodi,
            ));
        }else{
            return abort(404);
        }
    }

    public function getList(Request $req)
    {      
        $interview_question = InterviewQuestion::all();

        if ($req->ajax()) {
            return DataTables::of($interview_question)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row){   
                    $actionBtn =                    
                    '<a '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="editModalClick(
                        \''.$row->id.'\',
                        \''.$row->question.'\');"'.
                        'data-modal="#editInterviewQuestionModal" rel="modal:open" href="#editInterviewQuestionModal">'.
                    '<img src="'.asset('/themes/tailwind/images/pen.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>'.
                    '<button '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="deleteModalClick(
                        \''.$row->id.'\',
                        \''.$row->question.'\');">'.  
                    '<img src="'.asset('/themes/tailwind/images/delete.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</button>';
                    return $actionBtn;
                })              
                ->editColumn('updated_at',function($row){                    
                    return $row->updated_at->diffForHumans();
                })
                ->rawColumns(['act'])
                ->make(true);
        }
    }
    
    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }

    public function addInterviewQuestion(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = new InterviewQuestion();
            $data->question = $req->deskripsi_pertanyaan;

            if($data->save()){
                $res['message']="Data soal interview berhasil disimpan.";
            }else{
                $res['error']=true;
                $res['message']="Data soal interview gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function deleteInterviewQuestion(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = InterviewQuestion::where('id',$req->id)->first();
            if($data->delete()){
                $res['message']="Data soal interview berhasil dihapus.";
            }else{
                $res['error']=true;
                $res['message']="Data soal interview gagal dihapus!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updateInterviewQuestion(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = InterviewQuestion::where('id',$req->id)->first();
            $data->question = $req->deskripsi_pertanyaan;

            if($data->save()){
                $res['message']="Data soal interview berhasil diupdate.";
            }else{
                $res['error']=true;
                $res['message']="Data soal interview gagal diupdate!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }
}