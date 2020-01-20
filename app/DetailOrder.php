<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
	protected $table = 'detail_order';
    protected $fillable = [
    	'order_id',
    	'product_id',
    	'quantity_product',
    	'price'
    ];

    public function products()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
    public function orders()
    {
    	return $this->belongsTo('App\Order', 'order_id');
    }
}
