<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryProduction extends Model
{
     protected $table = 'history_production';
    protected $fillable = [
    	'product_id',
    	'quantity_in',
    	'production_date'
    ];

    public function product()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}

	
}
