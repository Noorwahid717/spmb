<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamReadQuran extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_read_qurans';
    protected $appends = ['nama_penguji','jumlah_peserta','nama_schedule' 
];

    public function getUsers()
    {
        return $this->belongsTo('App\Models\User','id_penguji', 'id');
    }

    public function getExamReadQuranMember()
    {
        return $this->hasMany('App\Models\ExamReadQuranMember','id_exam_read_quran', 'id');
    }

    public function getNamaPengujiAttribute()
    {
        return $this->getUsers->name;    
    }

    public function getJumlahPesertaAttribute()
    {
        $camaba = count($this->getExamReadQuranMember);
        return $camaba.' Camaba';    
    }

    public function ExamSchedules()
    {
        return $this->hasOne('App\Models\ExamSchedules', 'id','id_exam_schedule');
    }

    public function getNamaScheduleAttribute()
    {
        return $this->ExamSchedules->keterangan;
    }

}
