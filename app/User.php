<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'dni', 
        'email', 
        'user', 
        'password',
        'address', 
        'telephone', 
        'cellphone', 
        'status', 
        'rol_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',//'password', 
    ];
    //Relacion con rol 
    public function rol()
    {
        # code...
        return $this->belongsTo('App\Rol');
    }
}
