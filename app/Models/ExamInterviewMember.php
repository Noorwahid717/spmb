<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamInterviewMember extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_interview_members';
    protected $appends = ['nama','prodi','lunas','adm'];

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

    public function getExamInterviewMemberResult()
    {
        return $this->hasMany('App\Models\ExamInterviewMemberResult','id_exam_interview_member', 'id');
    }

    public function getCamabaDataPokok()
    {
        return $this->hasOne('App\Models\CamabaDataPokok','id_user', 'id_camaba');
    }

    // public function getRoleUser(){
    // return $this->belongsTo('App\Models\RoleUsers', 'id','user_id');    
    // }

    // public function getRole(){
    // return $this->belongsTo('App\Models\Roles', 'role_id');    
    // }

    // public function getNamaRoleAttribute()
    // {
    //     return $this->getRoleUser->getRole->name;
    // }

    // public function getExamInterviewMember()
    // {
    //     return $this->hasMany('App\Models\ExamInterviewMember','id_exam_interview', 'id');
    // }

}
