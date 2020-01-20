<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse';

	protected $fillable = [
			'nombre_producto', 
			'presentacion', 
			'cantidad_entrada', 
			'responsable', 
			'condicion'
		];

	public function getPresentacionNombreAttribute()
	{
		switch($this->presentacion)
		{
			//1=madre,2=padre,3=hijo(a),4=conyuge,5=otro,
			case 1:
				return 'Kgrs';
				break;
			
			case 2:
				return 'Mls';
				break;
			case 3:
				return 'Unds';
				break;
					
		}

		
	}
	public function details()
	{
		return $this->hasMany('App\DetailPurchase', 'product_id');
	}
}
