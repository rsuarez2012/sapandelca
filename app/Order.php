<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
    	'num_order',
    	'date_order',
    	'date_delivery',
    	'client_id',
    	'format_buy',
    	'status',
    	'num_buy'
    ];

    public function client()
    {
    	return $this->belongsTo('App\Client');
    }
    public function detailorder()
    {
        return $this->hasMany('App\DetailOrder');
    }
}
