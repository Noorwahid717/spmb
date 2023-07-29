<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Wave\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'name',
        'email',
        'username',
        'no_hp_camaba',
        'no_hp_ortu',
        'password',
        'bukti_pembayaran',
        'status_pembayaran',
        'verification_code',
        'verified',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        
    ];

    protected $appends = ['role_name'];

    public function getProdiFakultas()
    {
        return $this->belongsTo('App\Models\Roles','role_id', 'id');
    }

    public function getRoleNameAttribute()
    {
        return $this->getProdiFakultas->display_name;
    }
}
