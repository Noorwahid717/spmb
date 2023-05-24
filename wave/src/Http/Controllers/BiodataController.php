<?php

namespace Wave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SpmbConfig;
use App\Models\UserSpmbStep;
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
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use PDF;

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
            if($data->save()){
                $res['message']="Data pokok berhasil disimpan.";
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
            if($data->save()){
                $res['message']="Data alamat berhasil disimpan.";
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

    public function downloadSuratPernyataan()
    {
        $poin_pernyataan = PoinPernyataan::where('is_active','1')->get();
        $is_mondok = false;
        // $data =json_decode($user->data_mahasiswa,true);
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
            // 'nama'=>json_decode($user->data_mahasiswa,true)['nama_mahasiswa'],
            // 'nim'=>$user->username,
            // 'angkatan'=>substr(json_decode($user->data_mahasiswa,true)['id_periode'],0,-1),
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
