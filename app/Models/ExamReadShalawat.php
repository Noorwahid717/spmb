<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamReadShalawat extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_read_shalawat';
    protected $appends = ['nama_penguji','jumlah_peserta','nama_schedule'
];

    public function getUsers()
    {
        return $this->belongsTo('App\Models\User','id_penguji', 'id');
    }

    public function getExamReadShalawatMember()
    {
        return $this->hasMany('App\Models\ExamReadShalawatMember','id_exam_read_shalawat', 'id');
    }

    public function getNamaPengujiAttribute()
    {
        return $this->getUsers->name;    
    }

    public function getJumlahPesertaAttribute()
    {
        $camaba = count($this->getExamReadShalawatMember);
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
