<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPurchase extends Model
{
    protected $table = 'detail_purchase';
    protected $fillable = [
    	'departament_id',
    	'product_id',
    	'product_production_id',
    	'user_id',
    	'quantity'
    ];

    public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function departament()
	{
		return $this->belongsTo('App\Departament');
	}
	public function warehouse()
	{
		return $this->belongsTo('App\Warehouse', 'product_id');
	}
	public function product()
	{
		return $this->belongsTo('App\Product', 'product_production_id');
	}
}
