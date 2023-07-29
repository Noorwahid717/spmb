<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAcademic extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_academics';
    protected $appends = ['jumlah_peserta','jumlah_ikut_ujian'];

    public function getUsers()
    {
        return $this->belongsTo('App\Models\User','id_penguji', 'id');
    }

    public function getExamAcademicMember()
    {
        return $this->hasMany('App\Models\ExamAcademicMember','id_exam_academic', 'id');
    }

    public function getJumlahPesertaAttribute()
    {
        $camaba = count($this->getExamAcademicMember);
        return $camaba.' Camaba';    
    }

    public function getExamAcademicMemberResult()
    {
        return $this->hasMany('App\Models\ExamAcademicMemberResult','id_exam_academic_member', 'id');
    }

    public function getJumlahIkutUjianAttribute()
    {
        $camaba = $this->getExamAcademicMemberResult()->distinct()->count('id_exam_academic_member');
        return $camaba.' Camaba';    
    }
}
