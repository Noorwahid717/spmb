<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedules extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_schedules';
    protected $appends = ['jml_wawancara','jml_baca_quran','jml_baca_shalawat','jml_academic'];

    public function getExamInterview()
    {
        return $this->hasMany('App\Models\ExamInterview','id_exam_schedule', 'id');
    }

    public function getJmlWawancaraAttribute()
    {
        return count($this->getExamInterview);    
    }

    public function getExamReadQuran()
    {
        return $this->hasMany('App\Models\ExamReadQuran','id_exam_schedule', 'id');
    }

    public function getJmlBacaQuranAttribute()
    {
        return count($this->getExamReadQuran);    
    }

    public function getExamReadShalawat()
    {
        return $this->hasMany('App\Models\ExamReadShalawat','id_exam_schedule', 'id');
    }

    public function getJmlBacaShalawatAttribute()
    {
        return count($this->getExamReadShalawat);    
    }

    public function getExamAcademic()
    {
        return $this->hasMany('App\Models\ExamAcademic','id_exam_schedule', 'id');
    }

    public function getJmlAcademicAttribute()
    {
        return count($this->getExamAcademic);    
    }
    
}
