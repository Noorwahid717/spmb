<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCategories extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_categories';
    // protected $appends = ['jumlah_peserta','jumlah_ikut_ujian'];
}
