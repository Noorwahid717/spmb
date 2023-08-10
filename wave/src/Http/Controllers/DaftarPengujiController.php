<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistrasiAwalUser;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\User;
use App\Models\BankSoal;
use App\Models\ProdiFakultas;
use App\Models\ExamGroups;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use DataTables;
use Illuminate\Support\Arr;
use Str;

class DaftarPengujiController extends Controller
{
    public function index()
    {
        $prodi = ProdiFakultas::all();

        if(!auth()->guest() && auth()->user()->role_id==9){
            return view('theme::seleksi.daftar_penguji.index',array(
                'prodi'=>$prodi,
            ));
        }else{
            return abort(404);
        }
    }

    public function getList(Request $req)
    {
        $filter_prodi = $req->filter_prodi;       
        $bank_soal = User::where('role_id',10)
        ->get();

        if ($req->ajax()) {
            return DataTables::of($bank_soal)
                ->addIndexColumn()                                 
                ->addColumn('act', function($row){   
                    $actionBtn ='<a '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="editModalClick(
                        \''.$row->id.'\',
                        \''.$row->role_name.'\',
                        \''.str_replace("'","\'",$row->name).'\',
                        \''.$row->email.'\',
                        \''.$row->username.'\',
                        \''.$row->status.'\');"'. 
                    'data-modal="#editDaftarPengujiModal" rel="modal:open" href="#editDaftarPengujiModal">'.
                    '<img src="'.asset('/themes/tailwind/images/pen.png').'" class="w-6 rounded sm:mx-auto"> '.
                    '</a>'.
                    '<button '.
                    'class="mr-2 inline-flex self-start items-center px-2 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md" '.
                    'onClick="deleteModalClick(
                        \''.$row->id.'\',
                        \''.$row->role_name.'\',
                        \''.str_replace("'","\'",$row->name).'\',
                        \''.$row->email.'\',
                        \''.$row->username.'\',
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

    public function addDaftarPenguji(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = new User();
            $data->role_id = 10;
            $data->name = $req->nama_penguji;
            $data->email = $req->email;
            $data->username = $req->email;
            $data->password = bcrypt($req->password);
            $data->status = $req->status_penguji;

            if($data->save()){
                $res['message']="Data penguji berhasil disimpan.";
            }else{
                $res['error']=true;
                $res['message']="Data penguji gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function deleteDaftarPenguji(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $exist = ExamGroups::where('id_penguji',$req->id)->first();
            if(!$exist){
                $data = User::where('id',$req->id)->first();
                if($data->delete()){
                    $res['message']="Data penguji berhasil dihapus.";
                }else{
                    $res['error']=true;
                    $res['message']="Data penguji gagal dihapus!";
                }                    
            }else{
                $res['error']=true;
                $res['message']="Data penguji gagal dihapus, data penguji terkoneksi pada ujian seleksi sebelumnya!";
            }
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updateDaftarPenguji(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = User::where('id',$req->id_penguji)->first();
            $data->name = $req->nama_penguji;
            $data->email = $req->email;
            $data->username = $req->email;
            $data->password = bcrypt($req->password);
            $data->status = $req->status_penguji;            

            if($data->save()){
                $res['message']="Data penguji berhasil diupdate.";
            }else{
                $res['error']=true;
                $res['message']="Data penguji gagal diupdate!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }
}