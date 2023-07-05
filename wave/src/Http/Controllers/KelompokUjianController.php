<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
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

class KelompokUjianController extends Controller
{
    public function index()
    {
        $prodi = ProdiFakultas::all();

        if(!auth()->guest() && auth()->user()->role_id==9){
            return view('theme::seleksi.kelompok_ujian.index',array(
                'prodi'=>$prodi,
            ));
        }else{
            return abort(404);
        }
    }

    public function getList(Request $req)
    {
        $filter_prodi = $req->filter_prodi;       
        $bank_soal = BankSoal::where(function ($query) use(&$filter_prodi) {
            if($filter_prodi=="all"){
                return $query;
            }else{
                return $query->where('id_prodi', '=', $filter_prodi);
            }
        })
        ->get();

        if ($req->ajax()) {
            return DataTables::of($bank_soal)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row){   
                    $actionBtn =                    
                    '<a '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="detailModalClick(
                        \''.$row->id.'\',
                        \''.$row->id_prodi.'\',
                        \''.$row->pertanyaan.'\',
                        \''.$row->kunci_jawaban.'\',
                        \''.$row->jawaban_pelengkap_1.'\',
                        \''.$row->jawaban_pelengkap_2.'\',
                        \''.$row->jawaban_pelengkap_3.'\',
                        \''.$row->jawaban_pelengkap_4.'\',
                        \''.$row->status.'\');"'.  
                    'data-modal="#detailBankSoalModal" rel="modal:open" href="#detailBankSoalModal"> '.
                    '<img src="'.asset('/themes/tailwind/images/search.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>'.
                    '<a '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="editModalClick(
                        \''.$row->id.'\',
                        \''.$row->id_prodi.'\',
                        \''.$row->pertanyaan.'\',
                        \''.$row->kunci_jawaban.'\',
                        \''.$row->jawaban_pelengkap_1.'\',
                        \''.$row->jawaban_pelengkap_2.'\',
                        \''.$row->jawaban_pelengkap_3.'\',
                        \''.$row->jawaban_pelengkap_4.'\',
                        \''.$row->status.'\');"'.
                        'data-modal="#editBankSoalModal" rel="modal:open" href="#editBankSoalModal">'.
                    '<img src="'.asset('/themes/tailwind/images/pen.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>'.
                    '<button '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="deleteModalClick(
                        \''.$row->id.'\',
                        \''.$row->id_prodi.'\',
                        \''.$row->pertanyaan.'\',
                        \''.$row->kunci_jawaban.'\',
                        \''.$row->jawaban_pelengkap_1.'\',
                        \''.$row->jawaban_pelengkap_2.'\',
                        \''.$row->jawaban_pelengkap_3.'\',
                        \''.$row->jawaban_pelengkap_4.'\',
                        \''.$row->status.'\');">'.  
                    '<img src="'.asset('/themes/tailwind/images/delete.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</button>';
                    return $actionBtn;
                })              
                ->editColumn('updated_at',function($row){                    
                    return $row->updated_at->diffForHumans();
                })
                ->editColumn('status',function($row){                    
                    return $row->status==1?"Aktif":"Tidak Aktif";
                })
                ->editColumn('kunci_jawaban',function($row){
                    $split = explode(" ",$row->kunci_jawaban);
                    if(count($split)>3){
                        $split = $split[0]." ".$split[1]."...";             
                    }else{
                        $split = $row->kunci_jawaban;             
                    }
                    return $split;
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

    public function addBankSoal(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = new BankSoal();
            $data->id_prodi = $req->id_prodi;
            $data->pertanyaan = $req->deskripsi_pertanyaan;
            $data->kunci_jawaban = $req->kunci_jawaban;
            $data->jawaban_pelengkap_1 = $req->jawaban_pelengkap_1;
            $data->jawaban_pelengkap_2 = $req->jawaban_pelengkap_2;
            $data->jawaban_pelengkap_3 = $req->jawaban_pelengkap_3;
            $data->jawaban_pelengkap_4 = $req->jawaban_pelengkap_4;
            $data->status = $req->status_soal;

            if($data->save()){
                $res['message']="Data soal berhasil disimpan.";
            }else{
                $res['error']=true;
                $res['message']="Data soal gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function deleteBankSoal(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = BankSoal::where('id',$req->id)->first();
            if($data->delete()){
                $res['message']="Data soal berhasil dihapus.";
            }else{
                $res['error']=true;
                $res['message']="Data soal gagal dihapus!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updateBankSoal(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = BankSoal::where('id',$req->id)->first();
            $data->id_prodi = $req->id_prodi;
            $data->pertanyaan = $req->deskripsi_pertanyaan;
            $data->kunci_jawaban = $req->kunci_jawaban;
            $data->jawaban_pelengkap_1 = $req->jawaban_pelengkap_1;
            $data->jawaban_pelengkap_2 = $req->jawaban_pelengkap_2;
            $data->jawaban_pelengkap_3 = $req->jawaban_pelengkap_3;
            $data->jawaban_pelengkap_4 = $req->jawaban_pelengkap_4;
            $data->status = $req->status_soal;

            if($data->save()){
                $res['message']="Data soal berhasil diupdate.";
            }else{
                $res['error']=true;
                $res['message']="Data soal gagal diupdate!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }
}