<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamGroups extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'exam_groups';
    // protected $appends = ['program_studi'];

    // public function getProdiFakultas()
    // {
    //     return $this->belongsTo('App\Models\ProdiFakultas','id_prodi', 'id_prodi');
    // }

    // public function getProgramStudiAttribute()
    // {
    //     return $this->getProdiFakultas->nama_program_studi;    
    // }
}
