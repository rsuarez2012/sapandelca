<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employes';
    protected $fillable = [
    	'name',
    	'last_name',
    	'dni',
    	'cellphone'
    ];

    public function sale()
    {
    	return $this->hasMany('App\Sale');
    }
    public function getEmployeAttribute()
    {
    	return $this->name.' '.$this->last_name;
    }
}
