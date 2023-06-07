<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamabaDataProgramStudi extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'camaba_data_program_studi';
    protected $appends = ['program_studi_1','program_studi_2'];

    public function getProdiFakultas1()
    {
        return $this->belongsTo('App\Models\ProdiFakultas','id_program_studi_1', 'id_prodi');
    }

    public function getFakultas1()
    {
        return $this->belongsTo('App\Models\Fakultas','id_fakultas');
    }
    
    public function getProdiFakultas2()
    {
        return $this->belongsTo('App\Models\ProdiFakultas','id_program_studi_2', 'id_prodi');
    }

    public function getProgramStudi1Attribute()
    {
        return $this->getProdiFakultas1->nama_program_studi;    
    }

    public function getProgramStudi2Attribute()
    {
        return $this->getProdiFakultas2->nama_program_studi;    
    }
}
