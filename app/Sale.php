<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
    	'client_id',
    	'date_created',
    	'num_fac',
        'format_buy',
        'iva',
        'user_id',
    ];
    public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function client()
	{
		return $this->belongsTo('App\Client');
	}
    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
	public function detailsale()
	{
		return $this->hasMany('App\DetailSale');
	}
    public function detailsaleThisDay()
    {
        return $this->hasMany('App\DetailSale')->whereDay('detail_sale.created_at', date('d'));
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');//, 'detailsale')->withPivot('product_id');
    }
    public function credit()
    {
        return $this->hasMany('App\Credit');
    }
}
