<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserSpmbStep;
use App\Models\SpmbConfig;
use App\Models\Fakultas;
use App\Models\ProdiFakultas;
use App\Models\PoinPernyataan;
use App\Models\CamabaDataPokok;
use App\Models\CamabaDataAlamat;
use App\Models\CamabaDataOrtu;
use App\Models\CamabaDataWaliPs;
use App\Models\CamabaDataDokumen;
use App\Models\CamabaDataPernyataan;
use App\Models\CamabaDataProgramStudi;
use App\Models\CamabaDataRiwayatPendidikan;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use PDF;
use Str;
use Image;

class BiodataController extends Controller
{
    public function index()
    {
        $ta = SpmbConfig::where('id',1)->first()->tahun_ajaran_aktif;
        $ta = self::left($ta,4)."/".((int)self::left($ta,4)+1).(self::right($ta,1)=="1"?" Ganjil":" Genap");
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-agama');
        $agama = $response->json();
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-pendidikan');
        $pendidikan = $response->json();
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-pekerjaan');
        $pekerjaan = $response->json();
        $response = Http::get('sia-uniwa.ddns.net:3000/api/cari-penghasilan');
        $penghasilan = $response->json();
        $prodi = ProdiFakultas::all();

        $step_1 = CamabaDataPokok::where('id_user',auth()->user()->id)->first();
        $step_2 = CamabaDataAlamat::where('id_user',auth()->user()->id)->first();
        $step_3 = CamabaDataOrtu::where('id_user',auth()->user()->id)->first();
        $step_4 = CamabaDataWaliPs::where('id_user',auth()->user()->id)->first();
        $step_5 = CamabaDataRiwayatPendidikan::where('id_user',auth()->user()->id)->first();
        $step_6 = CamabaDataProgramStudi::where('id_user',auth()->user()->id)->first();
        $step_7 = CamabaDataDokumen::where('id_user',auth()->user()->id)->first();
        $step_8 = CamabaDataPernyataan::where('id_user',auth()->user()->id)->first();
        if(!auth()->guest() && auth()->user()->role_id==3){
            if(UserSpmbStep::where('user_id',auth()->user()->id)->first()->step_2==1){
                return view('theme::camaba.biodata.index',array(
                    'tahun_ajaran'=>$ta,
                    'agama'=>$agama,
                    'pendidikan'=>$pendidikan,
                    'pekerjaan'=>$pekerjaan,
                    'penghasilan'=>$penghasilan,
                    'prodi'=>$prodi,
                    'step_1'=>$step_1,
                    'step_2'=>$step_2,
                    'step_3'=>$step_3,
                    'step_4'=>$step_4,
                    'step_5'=>$step_5,
                    'step_6'=>$step_6,
                    'step_7'=>$step_7,
                    'step_8'=>$step_8,
                ));
            }else{
            return abort(404);
            }
        }else{
            return abort(404);
        }
    }

    public function cariKewarganegaraan(Request $req)
    {
        if ($req->has('query')) {
            $cari = $req->get('query');
            $response = Http::post('sia-uniwa.ddns.net:3000/api/cari-negara',[
                "nama_negara" => $cari
            ]);
            $citizenship = $response->json();
            return response()->json($citizenship);
        }
    }

    public function cariWilayah(Request $req)
    {
        if ($req->has('query')) {
            $cari = $req->get('query');
            $response = Http::post('sia-uniwa.ddns.net:3000/api/cari-wilayah',[
                "nama_wilayah" => $cari
            ]);
            $wilayah = $response->json();
            return response()->json($wilayah);
        }
    }

    static function left($str, $length) {
        return substr($str, 0, $length);
    }
    
    static function right($str, $length) {
        return substr($str, -$length);
    }

    public function updateDataPokok(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = CamabaDataPokok::where('id_user','=',auth()->user()->id)->first();
            if($data==null){
                $data = new CamabaDataPokok();
                $data->id_user = auth()->user()->id;           
            }
            $data->nkk = $req->nkk;
            $data->nik = $req->nik;
            $data->nama = strtoupper($req->nama);
            $data->gender = $req->gender;
            $data->tempat_lahir = strtoupper($req->tempat_lahir);
            $data->tanggal_lahir = $req->tanggal_lahir;
            $data->id_agama = $req->id_agama;
            $data->agama = $req->agama;
            $data->id_negara = $req->id_negara;
            $data->negara = $req->negara;
            if($data->note!=null&&$data->note!=""){
                $data->last_note = $data->note;
                $data->note = null;
            }

            if($data->save()){
                $res['message']="Data pokok berhasil disimpan.";
                // update data user
                $user = User::where('id',auth()->user()->id)->first();
                $user->name = $data->nama; 
                $user->nik = $data->nik;
                $user->save(); 
            }else{
                $res['error']=true;
                $res['message']="Data pokok gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updateDataAlamat(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = CamabaDataAlamat::where('id_user','=',auth()->user()->id)->first();
            if($data==null){
                $data = new CamabaDataAlamat();
                $data->id_user = auth()->user()->id;           
            }
            $data->jalan = $req->jalan;
            $data->dusun = strtoupper($req->dusun);
            $data->rt = $req->rt;
            $data->rw = $req->rw;
            $data->kelurahan = strtoupper($req->kelurahan);
            $data->kodepos = $req->kodepos;
            $data->id_wilayah = $req->id_wilayah;
            $data->kecamatan = $req->kecamatan;
            $data->kota_kabupaten = $req->kota_kabupaten;
            $data->provinsi = $req->provinsi;
            $data->email = $req->email;
            $data->no_hp_camaba = $req->wa_camaba;
            $data->no_hp_ortu = $req->wa_wali;
            if($data->note!=null&&$data->note!=""){
                $data->last_note = $data->note;
                $data->note = null;
            }

            if($data->save()){
                $res['message']="Data alamat berhasil disimpan.";
                // update data user
                $user = User::where('id',auth()->user()->id)->first();
                $user->no_hp_camaba = $data->no_hp_camaba; 
                $user->no_hp_ortu = $data->no_hp_ortu;
                $user->save();
            }else{
                $res['error']=true;
                $res['message']="Data alamat gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updateDataOrtu(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = CamabaDataOrtu::where('id_user','=',auth()->user()->id)->first();
            if($data==null){
                $data = new CamabaDataOrtu();
                $data->id_user = auth()->user()->id;           
            }
            $data->kondisi_ayah = strtoupper($req->kondisi_ayah);
            $data->nik_ayah = $req->nik_ayah;
            $data->nama_ayah = strtoupper($req->nama_ayah);
            $data->tanggal_lahir_ayah = $req->tanggal_lahir_ayah;
            $data->id_jenjang_pendidikan_ayah = $req->id_jenjang_pendidikan_ayah;
            $data->pendidikan_ayah = $req->pendidikan_ayah;
            $data->id_pekerjaan_ayah = $req->id_pekerjaan_ayah;
            $data->pekerjaan_ayah = $req->pekerjaan_ayah;
            $data->id_penghasilan_ayah = $req->id_penghasilan_ayah;
            $data->penghasilan_ayah = $req->penghasilan_ayah;
            $data->kondisi_ibu = strtoupper($req->kondisi_ibu);
            $data->nik_ibu = $req->nik_ibu;
            $data->nama_ibu = strtoupper($req->nama_ibu);
            $data->tanggal_lahir_ibu = $req->tanggal_lahir_ibu;
            $data->id_jenjang_pendidikan_ibu = $req->id_jenjang_pendidikan_ibu;
            $data->pendidikan_ibu = $req->pendidikan_ibu;
            $data->id_pekerjaan_ibu = $req->id_pekerjaan_ibu;
            $data->pekerjaan_ibu = $req->pekerjaan_ibu;
            $data->id_penghasilan_ibu = $req->id_penghasilan_ibu;
            $data->penghasilan_ibu = $req->penghasilan_ibu;
            if($data->note!=null&&$data->note!=""){
                $data->last_note = $data->note;
                $data->note = null;
            }

            if($data->save()){
                $res['message']="Data orang tua berhasil disimpan.";
            }else{
                $res['error']=true;
                $res['message']="Data orang tua gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updateDataWaliPs(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = CamabaDataWaliPs::where('id_user','=',auth()->user()->id)->first();
            if($data==null){
                $data = new CamabaDataWaliPs();
                $data->id_user = auth()->user()->id;           
            }
            $data->opsi_wali = $req->opsi_wali;
            $data->nik_wali = $req->nik_wali;
            $data->nama_wali = strtoupper($req->nama_wali);
            $data->tanggal_lahir_wali = $req->tanggal_lahir_wali;
            $data->id_jenjang_pendidikan_wali = $req->id_jenjang_pendidikan_wali;
            $data->pendidikan_wali = $req->pendidikan_wali;
            $data->id_pekerjaan_wali = $req->id_pekerjaan_wali;
            $data->pekerjaan_wali = $req->pekerjaan_wali;
            $data->id_penghasilan_wali = $req->id_penghasilan_wali;
            $data->penghasilan_wali = $req->penghasilan_wali;
            $data->is_kps = $req->is_kps;
            $data->no_kps = $req->no_kps;   
            if($data->note!=null&&$data->note!=""){
                $data->last_note = $data->note;
                $data->note = null;
            }

            if($data->save()){
                $res['message']="Data wali & perlindungan sosial berhasil disimpan.";
            }else{
                $res['error']=true;
                $res['message']="Data wali & perlindungan sosial gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public function updateDataRiwayatPendidikan(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = CamabaDataRiwayatPendidikan::where('id_user','=',auth()->user()->id)->first();
            if($data==null){
                $data = new CamabaDataRiwayatPendidikan();
                $data->id_user = auth()->user()->id;           
            }
            $data->is_alumni = $req->is_alumni;
            $data->pendidikan_asal = $req->pendidikan_asal;
            $data->jenis_pendidikan_asal = $req->jenis_pendidikan_asal;
            $data->nama_pendidikan_asal = strtoupper($req->nama_pendidikan_asal);
            $data->nisn = $req->nisn;
            $data->alamat_pendidikan_asal = $req->alamat_pendidikan_asal;
            if($data->note!=null&&$data->note!=""){
                $data->last_note = $data->note;
                $data->note = null;
            }

            if($data->save()){
                $res['message']="Data riwayat pendidikan berhasil disimpan.";
            }else{
                $res['error']=true;
                $res['message']="Data riwayat pendidikan gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }  
    
    public function updateDataProgramStudi(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = CamabaDataProgramStudi::where('id_user','=',auth()->user()->id)->first();
            if($data==null){
                $data = new CamabaDataProgramStudi();
                $data->id_user = auth()->user()->id;           
            }           
            $data->tahun_akademik_registrasi = $req->tahun_akademik_registrasi;
            $data->id_program_studi_1 = $req->id_program_studi_1;
            $data->id_program_studi_2 = $req->id_program_studi_2;
            if($data->note!=null&&$data->note!=""){
                $data->last_note = $data->note;
                $data->note = null;
            }

            if($data->save()){
                $res['message']="Data program studi berhasil disimpan.";
            }else{
                $res['error']=true;
                $res['message']="Data program studi gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }      

    public function updateDataDokumen(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = CamabaDataDokumen::where('id_user','=',auth()->user()->id)->first();
            $dataImageKTPCamaba = self::UploadDokumenToStorage($req->dok_ktp_camaba,"ktp_camaba","ktp_camaba",$data);
            $dataImagePasFotoCamaba = self::UploadDokumenToStorage($req->dok_pas_foto_camaba,"foto_camaba","foto_camaba",$data);
            $dataImageKTPAyah = self::UploadDokumenToStorage($req->dok_ktp_ayah,"ktp_ayah","ktp_ayah",$data);
            $dataImageKTPIbu = self::UploadDokumenToStorage($req->dok_ktp_ibu,"ktp_ibu","ktp_ibu",$data);
            $dataImageKK = self::UploadDokumenToStorage($req->dok_kk,"kartu_keluarga","kartu_keluarga",$data);
            $dataImageKTPWali = self::UploadDokumenToStorage($req->dok_ktp_wali,"ktp_wali","ktp_wali",$data);
            $dataImageAkta = self::UploadDokumenToStorage($req->dok_akta,"akta_kelahiran","akta_kelahiran",$data);
            $dataImageIjasah = self::UploadDokumenToStorage($req->dok_ijasah,"ijasah","ijasah",$data);
            $dataImageNilaiUjianSekolah = self::UploadDokumenToStorage($req->dok_nilai_ujian_sekolah,"nilai_ujian_sekolah","nilai_ujian_sekolah",$data);
            $dataImageNilaiRapor = self::UploadDokumenToStorage($req->dok_nilai_rapor,"nilai_rapor","nilai_rapor",$data);            

            if($data==null){
                $data = new CamabaDataDokumen();
                $data->id_user = auth()->user()->id;           
            }           
            $oldDokKTPCamaba = $data!=null?$data->url_ktp:"";
            if($dataImageKTPCamaba!=null||$dataImageKTPCamaba!=""){
                $data->url_ktp = 'ktp_camaba/'.$dataImageKTPCamaba;
            }
            $oldDokFotoCamaba = $data!=null?$data->url_foto:"";
            if($dataImagePasFotoCamaba!=null||$dataImagePasFotoCamaba!=""){
                $data->url_foto = 'foto_camaba/'.$dataImagePasFotoCamaba;
            }
            $oldDokKTPAyah = $data!=null?$data->url_ktp_ayah:"";
            if($dataImageKTPAyah!=null||$dataImageKTPAyah!=""){
                $data->url_ktp_ayah = 'ktp_ayah/'.$dataImageKTPAyah;
            }
            $oldDokKTPIbu = $data!=null?$data->url_ktp_ibu:"";
            if($dataImageKTPIbu!=null||$dataImageKTPIbu!=""){
                $data->url_ktp_ibu = 'ktp_ibu/'.$dataImageKTPIbu;
            }
            $oldDokKTPWali = $data!=null?$data->url_ktp_wali:"";
            if($dataImageKTPWali!=null||$dataImageKTPWali!=""){
                $data->url_ktp_wali = 'ktp_wali/'.$dataImageKTPWali;
            }
            $oldDokKK = $data!=null?$data->url_kk:"";
            if($dataImageKK!=null||$dataImageKK!=""){
                $data->url_kk = 'kartu_keluarga/'.$dataImageKK;
            }
            $oldDokAkta = $data!=null?$data->url_akta:"";
            if($dataImageAkta!=null||$dataImageAkta!=""){
                $data->url_akta = 'akta_kelahiran/'.$dataImageAkta;
            }
            $oldDokIjasah = $data!=null?$data->url_ijasah:"";
            if($dataImageIjasah!=null||$dataImageIjasah!=""){
                $data->url_ijasah = 'ijasah/'.$dataImageIjasah;
            }
            $oldDokNilaiUjianSekolah = $data!=null?$data->url_nilai_ujian_sekolah:"";
            if($dataImageNilaiUjianSekolah!=null||$dataImageNilaiUjianSekolah!=""){
                $data->url_nilai_ujian_sekolah = 'nilai_ujian_sekolah/'.$dataImageNilaiUjianSekolah;
            }
            $oldDokNilaiRapor = $data!=null?$data->url_nilai_rapor:"";
            if($dataImageNilaiRapor!=null||$dataImageNilaiRapor!=""){
                $data->url_nilai_rapor = 'nilai_rapor/'.$dataImageNilaiRapor;
            }                       
            if($data->note!=null&&$data->note!=""){
                $data->last_note = $data->note;
                $data->note = null;
            }

            if($data->save()){
                $res['message']="Data dokumen berhasil disimpan.";
                $fpKTPCamaba = public_path().'/storage/'.$oldDokKTPCamaba;
                if($dataImageKTPCamaba!=null||$dataImageKTPCamaba!=""){
                    if($oldDokKTPCamaba!=""){
                        unlink($fpKTPCamaba);
                    }
                }                
                $fpFotoCamaba = public_path().'/storage/'.$oldDokFotoCamaba;
                if($dataImagePasFotoCamaba!=null||$dataImagePasFotoCamaba!=""){
                    if($oldDokFotoCamaba!=""){
                        unlink($fpFotoCamaba);
                    }
                }
                $fpKTPAyah = public_path().'/storage/'.$oldDokKTPAyah;
                if($dataImageKTPAyah!=null||$dataImageKTPAyah!=""){                
                    if($oldDokKTPAyah!=""){
                        unlink($fpKTPAyah);
                    }
                }
                $fpKTPIbu = public_path().'/storage/'.$oldDokKTPIbu;
                if($dataImageKTPIbu!=null||$dataImageKTPIbu!=""){
                    if($oldDokKTPIbu!=""){
                        unlink($fpKTPIbu);
                    }
                }
                $fpKK = public_path().'/storage/'.$oldDokKK;
                if($dataImageKK!=null||$dataImageKK!=""){
                    if($oldDokKK!=""){
                        unlink($fpKK);
                    }
                }
                $fpKTPWali = public_path().'/storage/'.$oldDokKTPWali;
                if($dataImageKTPWali!=null||$dataImageKTPWali!=""){
                    if($oldDokKTPWali!=""){
                        unlink($fpKTPWali);
                    }
                }
                $fpAkta = public_path().'/storage/'.$oldDokAkta;
                if($dataImageAkta!=null||$dataImageAkta!=""){
                    if($oldDokAkta!=""){
                        unlink($fpAkta);
                    }
                }
                $fpIjasah = public_path().'/storage/'.$oldDokIjasah;
                if($dataImageIjasah!=null||$dataImageIjasah!=""){
                    if($oldDokIjasah!=""){
                        unlink($fpIjasah);
                    }
                }
                $fpNilaiUjianSekolah = public_path().'/storage/'.$oldDokNilaiUjianSekolah;
                if($dataImageNilaiUjianSekolah!=null||$dataImageNilaiUjianSekolah!=""){
                    if($oldDokNilaiUjianSekolah!=""){
                        unlink($fpNilaiUjianSekolah);
                    }
                }
                $fpNilaiRapor = public_path().'/storage/'.$oldDokNilaiRapor;
                if($dataImageNilaiRapor!=null||$dataImageNilaiRapor!=""){
                    if($oldDokNilaiRapor!=""){
                        unlink($fpNilaiRapor);
                    }
                }
            }else{
                $res['error']=true;
                $res['message']="Data dokumen gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }

    public static function UploadDokumenToStorage($imageData,$location,$type,$data)
    {
        // $initialization = CamabaDataDokumen::where('id_user','=',auth()->user()->id)->first();
        $jpegExtDataImage = 'data:image/jpeg;base64,';
        $pngExtDataImage = 'data:image/png;base64,';
        $pdfExtDataImage = 'data:application/pdf;base64,';
        $ext=null;
        if (str_contains($imageData, $jpegExtDataImage)) {
            $ext='png';
        }else if (str_contains($imageData, $pngExtDataImage)) {
            $ext='png';
        }else if (str_contains($imageData, $pdfExtDataImage)) {
            $ext='pdf';
        }else{
            $ext='png';
        }
        $url = null;       
        switch ($type) {
            case 'pernyataan':
                $url = $data!=null?$data->url_surat_pernyataan:null;
                break;
            case 'ktp_camaba':
                $url = $data!=null?$data->url_ktp:null;
                break;
            case 'foto_camaba':
                $url = $data!=null?$data->url_foto:null;
                break;
            case 'ktp_ayah':
                $url = $data!=null?$data->url_ktp_ayah:null;
                break;
            case 'ktp_ibu':
                $url = $data!=null?$data->url_ktp_ibu:null;
                break;
            case 'kartu_keluarga':
                $url = $data!=null?$data->url_kk:null;
                break;
            case 'ktp_wali':
                $url = $data!=null?$data->url_ktp_wali:null;
                break;
            case 'akta_kelahiran':
                $url = $data!=null?$data->url_akta:null;
                break;
            case 'ijasah':
                $url = $data!=null?$data->url_ijasah:null;
                break;
            case 'nilai_ujian_sekolah':
                $url = $data!=null?$data->url_nilai_ujian_sekolah:null;
                break;
            case 'nilai_rapor':
                $url = $data!=null?$data->url_nilai_rapor:null;
                break;            
            default:
                $url = null;
                break;
        }
        $old_thumbnail = null;
        if($url!=null){
            $path = 'storage/'.$url;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            if($type=="pdf"){
                $base64 = 'data:application/' . $type . ';base64,' . base64_encode($data);
            }else{
                $data = Image::make($data)->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream('jpg', 100);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
            $old_thumbnail = $base64;  
        }
        $imageName = null;
        if($old_thumbnail!=$imageData){
            if($imageData){
                $image = $imageData; 
                $image = str_replace($jpegExtDataImage, '', $image);
                $image = str_replace($pngExtDataImage, '', $image);
                $image = str_replace($pdfExtDataImage, '', $image);            
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(50).'.'.$ext;
                \File::put(storage_path(). '/app/public/'.$location.'/' . $imageName, base64_decode($image));
            }
        }
        return $imageName;
    }

    public function updateDataPernyataan(Request $req)
    {
        $res['error']=false;
        $res['data']=array();
        $res['message']="";

        try {
            $data = CamabaDataPernyataan::where('id_user','=',auth()->user()->id)->first();
            $dataImagePernyataan = self::UploadDokumenToStorage($req->dok_pernyataan,"surat_pernyataan",'pernyataan',$data);

            if($data==null){
                $data = new CamabaDataPernyataan();
                $data->id_user = auth()->user()->id;           
            }           
            $oldDokPernyataan = $data->url_surat_pernyataan;
            if($dataImagePernyataan!=null||$dataImagePernyataan!=""){
                $data->url_surat_pernyataan = 'surat_pernyataan/'.$dataImagePernyataan;
            }
            $data->nomor_surat = auth()->user()->id;
            $data->sanggup_mondok = $req->sanggup_mondok;
            $data->sanggup_tidak_menikah = $req->sanggup_tidak_menikah;   
            if($data->note!=null&&$data->note!=""){
                $data->last_note = $data->note;
                $data->note = null;
            }

            if($data->save()){
                $res['message']="Data program studi berhasil disimpan.";
                $fpPeryataan = public_path().'/storage/'.$oldDokPernyataan;
                if($dataImagePernyataan!=null||$dataImagePernyataan!=""){
                    if($oldDokPernyataan!=""){
                        unlink($fpPeryataan);
                    }
                } 
            }else{
                $res['error']=true;
                $res['message']="Data program studi gagal disimpan!";
            }                    
        } catch (\Exception $e) {
            $res['error']=true;
            $res['message']=$e->getMessage();
          }

        return response()->json($res);
    }  

    public function downloadSuratPernyataan(Request $req)
    {
        $poin_pernyataan = PoinPernyataan::where('is_active','1')->get();
        $data_wali = CamabaDataWaliPs::where('id_user',auth()->user()->id)->first();
        $data_pokok = CamabaDataPokok ::where('id_user',auth()->user()->id)->first();
        $data_alamat = CamabaDataAlamat ::where('id_user',auth()->user()->id)->first();
        $data_prodi = CamabaDataProgramStudi ::where('id_user',auth()->user()->id)->first();
        $data_fakultas = Fakultas ::where('id',$data_prodi->getProdiFakultas1->id_fakultas)->first();
        $data_pernyataan = CamabaDataPernyataan ::where('id_user',auth()->user()->id)->first();
        $is_mondok = $data_pernyataan->sanggup_mondok==0?false:true;
        // $krs=ProfilMhsHelper::getKRSMahasiswa($k,$kk);

        //Get Penanda Tangan
        // $ttd = PejabatTtd::where('id_prodi','=',json_decode($user->data_mahasiswa,true)['id_prodi'])->first();
        // $data =$krs;
        // $qrcode = null;
        $sign_date = \Carbon\Carbon::now();

        // $val_krs = ValidasiKRS::where('id_registrasi_mahasiswa',$k)->where('id_semester',$kk)->first();
        // if($val_krs!=null){            
        //     $krs_signature = KRSSignature::where('id_validasi_krs',$val_krs->id)->first();
        //     if($krs_signature!=null){
        //         $qrcode = SignatureHelper::getKRSDigitalSignatureQRCode($krs_signature->digital_signature);
        //         $sign_date = $krs_signature->updated_at;
        //     }
        // }

        $pdf = PDF::loadview('theme::camaba.biodata.pernyataan.surat-pernyataan',[
            'poin_pernyataan'=>$poin_pernyataan,
            'sign_date'=>$sign_date,
            'mondok'=>$is_mondok,
            'wali'=>$data_wali,
            'pokok'=>$data_pokok,
            'alamat'=>$data_alamat,
            'pernyataan'=>$data_pernyataan,
            'prodi'=>$data_prodi,
            'fakultas'=>$data_fakultas,
            // 'jenjang'=>substr(json_decode($user->data_mahasiswa,true)['nama_program_studi'],0,2),
            // 'prodi'=>substr(json_decode($user->data_mahasiswa,true)['nama_program_studi'],3),
            // 'ta'=>$k.'/'.strval((int)$k+1),
            // 'sm'=>$kk==1?"Ganjil":"Genap",
            // 'pj'=>$ttd->nama_pejabat,
            // 'ldate'=>CustomFormat::tgl_indo($keyy),
        ])->setPaper(array(0,0,609.4488,935.433), 'portrait');
        return $pdf->stream();
    }
}
