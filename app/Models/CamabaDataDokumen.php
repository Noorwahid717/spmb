<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamabaDataDokumen extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'camaba_data_dokumen';
    protected $appends = array(
        'url_ktp_b64',
        'url_foto_b64',
        'url_ktp_ayah_b64',
        'url_ktp_ibu_b64',
        'url_ktp_wali_b64',
        'url_kk_b64',
        'url_akta_b64',
        'url_ijasah_b64',
        'url_nilai_ujian_sekolah_b64',
        'url_nilai_rapor_b64'
    );

    public function getUrlNilaiRaporB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_nilai_rapor;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        if($type=="pdf"){
            $base64 = 'data:application/' . $type . ';base64,' . base64_encode($data);
        }else{
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return $base64;  
    }

    public function getUrlNilaiUjianSekolahB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_nilai_ujian_sekolah;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        if($type=="pdf"){
            $base64 = 'data:application/' . $type . ';base64,' . base64_encode($data);
        }else{
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return $base64;  
    }

    public function getUrlIjasahB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_ijasah;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;  
    }

    public function getUrlAktaB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_akta;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;  
    }

    public function getUrlKkB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_kk;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;  
    }

    public function getUrlKtpWaliB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_ktp_wali;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;  
    }

    public function getUrlKtpIbuB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_ktp_ibu;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;  
    }

    public function getUrlKtpAyahB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_ktp_ayah;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;  
    }
    
    public function getUrlFotoB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_foto;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;  
    }

    public function getUrlKtpB64Attribute()
    {
        // asset("storage").
        $path = 'storage/'.$this->url_ktp;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;  
    }
}
