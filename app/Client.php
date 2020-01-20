<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

	protected $fillable = [
			'first_name',
			'last_name',
			'dni',
			'client_type',
			'telephone',
			'address'
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
