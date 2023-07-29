<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrasiAwalUser extends Model
{
    use HasFactory;
    protected $fillable = [''];
    protected $table = 'registrasi_awal_user';

    public function getUser(){
        return $this->belongsTo('App\Models\User', 'id_user','id');    
    }

    public function getCamabaDataPokok(){
        return $this->belongsTo('App\Models\CamabaDataPokok', 'id_user','id_user');    
    }

    public function getCamabaDataAlamat(){
        return $this->belongsTo('App\Models\CamabaDataAlamat', 'id_user','id_user');    
    }

    public function getCamabaDataOrtu(){
        return $this->belongsTo('App\Models\CamabaDataOrtu', 'id_user','id_user');    
    }

    public function getCamabaDataWaliPs(){
        return $this->belongsTo('App\Models\CamabaDataWaliPs', 'id_user','id_user');    
    }

    public function getCamabaDataRiwayatPendidikan(){
        return $this->belongsTo('App\Models\CamabaDataRiwayatPendidikan', 'id_user','id_user');    
    }

    public function getCamabaDataProgramStudi(){
        return $this->belongsTo('App\Models\CamabaDataProgramStudi', 'id_user','id_user');    
    }

    public function getCamabaDataDokumen(){
        return $this->belongsTo('App\Models\CamabaDataDokumen', 'id_user','id_user');    
    }

    public function getCamabaDataPernyataan(){
        return $this->belongsTo('App\Models\CamabaDataPernyataan', 'id_user','id_user');    
    }

    public function getUserSpmbStep(){
        return $this->belongsTo('App\Models\UserSpmbStep','id_user', 'user_id');    
    }



    // available-member
    protected $appends = ['nama','prodi','lunas','adm'];

    public function getNamaAttribute()
    {
        return $this->getUser->name;    
    }

    public function getProdiAttribute()
    {
        return ($this->getCamabaDataProgramStudi==null?"Belum Memilih":$this->getCamabaDataProgramStudi->program_studi_1);
    }

    public function getLunasAttribute()
    {
        return ($this->is_lunas==null?"Unpaid":($this->is_lunas==1?"Paid":"Unpaid"));
    }

    public function getAdmAttribute()
    {
        return ($this->getCamabaDataDokumen==null?"Invalid":($this->getCamabaDataDokumen->status_step==1?"Valid":"Invalid"));
    }
}
