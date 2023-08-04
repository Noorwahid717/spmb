<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamConvertionResult extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_convertion_results';
    // protected $appends = ['jumlah_peserta','jumlah_ikut_ujian'];
}
