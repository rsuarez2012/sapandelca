<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    //
    protected $table = 'detail_sale';
    protected $fillable = [
    	'sale_id',
    	'product_id',
    	'total',
    	'quantity_product'
    ];
    public function products()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }
    public function sales()
    {
    	return $this->belongsTo('App\Sale', 'sale_id');
    }
}
