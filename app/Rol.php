<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'roles';
    protected $fillable = [
        'name', 
        'condition',  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    //Relacion con user 
    public function users()
    {
        # code...
        return $this->hasMany('App\User');
    }
}
