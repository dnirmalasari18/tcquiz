<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

        protected $table = 'users';

    protected $fillable = [
        'username', 'name', 'email', 'password', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pics() {
        return $this->hasOne('App\Pic', 'idPIC', 'username');
    }

    public function kuis() {
        return $this->hasMany('App\Quiz', 'dosen_id', 'id');
    }

    public function kehadiran() {
        return $this->hasMany('App\Kehadiran', 'idUser', 'username');
    }

    public function paketujian() {
        return $this->hasMany('App\MahasiswaPacket', 'user_id', 'id');
    }
}
