<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamInterview extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_interviews';
    protected $appends = ['nama_penguji','jumlah_peserta',
    'jumlah_ikut_ujian'
];

    public function getUsers()
    {
        return $this->belongsTo('App\Models\User','id_penguji', 'id');
    }

    public function getExamInterviewMember()
    {
        return $this->hasMany('App\Models\ExamInterviewMember','id_exam_interview', 'id');
    }

    public function getNamaPengujiAttribute()
    {
        return $this->getUsers->name;    
    }

    public function getJumlahPesertaAttribute()
    {
        $camaba = count($this->getExamInterviewMember);
        return $camaba.' Camaba';    
    }

    public function getExamInterviewMemberResult()
    {
        return $this->hasMany('App\Models\ExamInterviewMemberResult','id_exam_interview_member', 'id');
    }

    public function getJumlahIkutUjianAttribute()
    {
        $camaba = $this->getExamInterviewMemberResult()->distinct()->count('id_exam_interview_member');
        return $camaba.' Camaba';    
    }
}
