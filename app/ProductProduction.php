<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductProduction extends Model
{
     protected $table = 'product_production';
    protected $fillable = [
    	'product_id',
    	'departament_id',
    	'user_id',
    	'quantity_in',
    	'lost',
    	'observation',
    	'production_date'
    ];

    public function product()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}

	
}
