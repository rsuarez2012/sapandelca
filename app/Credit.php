<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = 'credit';

	protected $fillable = [
			'sale_id',
			'total',
			'status',
			'num_fac'
	];
	public function sale()
    {
        return $this->belongsTo('App\Sale');
    }
    public function detailcredit()
    {
        return $this->hasMany('App\DetailCredit');
    }
	/*public function getClientNameAttribute()
	{
		return $this->dni.'-'.$this->first_name.' '.$this->last_name;
	}*/
}
