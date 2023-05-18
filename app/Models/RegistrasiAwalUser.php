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
}
