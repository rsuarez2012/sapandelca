<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'banks';

	protected $fillable = [
			'name_bank',
			'number',
			'dni',
			'title',
	];
	public function Sale()
    {
        return $this->hasMany('App\Sale');
    }
	public function getClientNameAttribute()
	{
		return $this->dni.'-'.$this->first_name.' '.$this->last_name;
	}
}
