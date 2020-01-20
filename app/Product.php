<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
    	'cod',
    	'product',
    	'buy',
        'presentation',
        'package',
        'exent_iva',
    	'stock',
    	'condition'
    ];
    public function Productproduction()
    {
        return $this->hasMany('App\ProductProduction');
    }
    public function Historyproduction()
    {
        return $this->hasMany('App\ProductProduction');
    }
    public function DetailPurchase()
    {
        return $this->hasMany('App\DetailPurchase');
    }
    public function sales()
    {
        return $this->belongsToMany('App\Sale');//, 'detailsale')->withPivot('product_id');
    }
    /*public function productDetail()
    {
        return $this->belongsToMany('App\detailsale');
    }*/
    public function getPresentationTypeAttribute($value='')
    {
        switch($this->presentation)
        {
            //1=madre,2=padre,3=hijo(a),4=conyuge,5=otro,
            case 1:
                return 'PAQUETES';
                break;
            
            case 2:
                return 'UNIDADES';
                break;
        }

    }
    public function getPackageNameAttribute($value='')
    {
        if($this->package != '')
            return $this->package;
        else
            return ' ';




    }
}
