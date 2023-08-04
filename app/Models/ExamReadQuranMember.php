<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamReadQuranMember extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_read_quran_members';
    protected $appends = ['nama','prodi','lunas','adm','nilai_lancar','nilai_tajwid','nilai_makhraj'];

    public function getUsers()
    {
        return $this->belongsTo('App\Models\User','id_camaba', 'id');
    }

    public function getNamaAttribute()
    {
        return $this->getUsers->name;    
    }

    public function getPilihanProdi()
    {
        return $this->belongsTo('App\Models\CamabaDataProgramStudi','id_camaba', 'id_user');
    }

    public function getProdiAttribute()
    {
        return ($this->getPilihanProdi==null?"Belum Memilih":$this->getPilihanProdi->program_studi_1);
    }

    public function getInfoLunas()
    {
        return $this->belongsTo('App\Models\RegistrasiAwalUser','id_camaba', 'id_user');
    }

    public function getLunasAttribute()
    {
        return ($this->getInfoLunas==null?"Unpaid":($this->getInfoLunas->is_lunas==1?"Paid":"Unpaid"));
    }

    public function getInfoAdm()
    {
        return $this->belongsTo('App\Models\CamabaDataDokumen','id_camaba', 'id_user');
    }

    public function getAdmAttribute()
    {
        return ($this->getInfoAdm==null?"Invalid":($this->getInfoAdm->status_step==1?"Valid":"Invalid"));
    }

    public function getNilaiKelancaran()
    {
        return $this->belongsTo('App\Models\ExamAssessmentInstrument','id_nilai_kelancaran', 'id');
    }

    public function getNilaiLancarAttribute()
    {
        return $this->getNilaiKelancaran==null?"belum dirilis.":$this->getNilaiKelancaran->deskripsi;
    }

    public function getNilaiTajwid()
    {
        return $this->belongsTo('App\Models\ExamAssessmentInstrument','id_nilai_tajwid', 'id');
    }

    public function getNilaiTajwidAttribute()
    {
        return $this->getNilaiTajwid==null?"belum dirilis.":$this->getNilaiTajwid->deskripsi;
    }

    public function getNilaiMakhraj()
    {
        return $this->belongsTo('App\Models\ExamAssessmentInstrument','id_nilai_makhraj', 'id');
    }

    public function getNilaiMakhrajAttribute()
    {
        return $this->getNilaiMakhraj==null?"belum dirilis.":$this->getNilaiMakhraj->deskripsi;
    }
}
