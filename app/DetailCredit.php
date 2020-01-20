<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailCredit extends Model
{
    protected $table = 'detailcredit';

	protected $fillable = [
			'credit_id',
			'total',
			'payment_type',
			'bank',
			'reference',
			'rode',
			'subtraction'
	];
	public function credit()
    {
        return $this->belongsTo('App\Credit');
    }
    public function getPaymentTypesAttribute($value='')
    {
        switch($this->payment_type)
        {
            //1=madre,2=padre,3=hijo(a),4=conyuge,5=otro,
            case 1:
                return 'TARJETA DEBITO';
                break;
            
            case 2:
                return 'EFECTIVO';
                break;
            case 3:
            	return 'TDC';
            	break;
            case 4:
            	return 'TRANSFERENCIA';
            	break;
            case 5:
            	return 'PAGO MOVIL';
            	break;
            case 6:
            	return 'MONEDA EXTRANJERA $';
            	break;
        }

    }
}
