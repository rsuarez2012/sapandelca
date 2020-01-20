<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<link href="{{-- asset('css/custom.css') --}}" rel="stylesheet">
	<style type="text/css">
		table{
			border:1px solid #000;
			width: 100%;
		}
		tr:nth-child(odd) {
		    background-color:#f2f2f2;
		}
		tr:nth-child(even) {
		    background-color:#fbfbfb;
		}
		th, td{
			width: 25%;
			text-align:center;
			vertical-align: top;
			border: 1px solid #000;/*OJO QUITAR*/
		}
		.row{
			padding-top: 280px;
		}
	</style>
</head>
<body>


    @if($sales->count() > '0')

            <span class="col-md-3 pull-right">                
                <!--<h4>FACTURA: {{-- str_pad ($sale[0]->num_fac, 7, '0', STR_PAD_LEFT) --}}</h4>-->
                <h4>DESDE: {{ Carbon\Carbon::parse($start)->format('d/m/Y') }}</h4>
                <h4>HASTA: {{ Carbon\Carbon::parse($end)->format('d/m/Y') }}</h4>
            </span>
            
        <table>
                    <thead>
                        <tr>
                            <th colspan="4">
                                <h3 align="center">VENTAS REGISTRADAS </h3>
                            </th>
                        </tr>
                        <tr>
                        	<th style="text-align: center;">NUMERO DE FACTURA</th>
                            <th style="text-align: center;">PRODUCTO</th>
                            <th style="text-align: center;">CANTIDAD</th>
                            <th style="text-align: center;">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $subtotal = 0;
                            $iva = 0;
                            $total = 0;
                            $excent = 0;
                            $no_excent = 0;

                        @endphp
                        @foreach($sales as $sale)
							@foreach($sale->detailsale as $detail)
                            <tr>
                            	<td style="text-align: center;">{{str_pad ($sale->num_fac, 7, '0', STR_PAD_LEFT)  }}</td>
                                <td style="text-align: center;">{{ $detail->products->product }}</td>
                                <td style="text-align: center;">{{ $detail->quantity_product }}</td>
                                @php
                                    $subtotal +=($detail->quantity_product*$detail->total);
                                    $iva += ($detail->quantity_product*$detail->products->iva);
                                    $total += $detail->quantity_product*($detail->total + $detail->products->iva);
                                @endphp
                                <td style="text-align: center;">{{ ($detail->quantity_product*$detail->total) }}</td>
                            </tr> 
	                            @if($detail->products->exent_iva == 1)
	                                @php
	                                    $excent += $detail->quantity_product*$detail->total;
	                                @endphp
	                            @else
	                                @php
	                                    $no_excent += $detail->quantity_product*$detail->total;
	                                @endphp
	                            @endif
                            @endforeach
                        @endforeach       

                            <tr>
                            	<td colspan="2" rowspan="5"></td>
                                <td><b>SUBTOTAL</b></td>
                                <td><b>{{ $subtotal }}</b></td>
                            </tr>
                            <tr>
                                <td><b>EXENTOS (E)</b></td>
                                <td><b>{{ $excent }}</b></td>
                            </tr>
                            <tr>
                                <td><b>BI (G)</b></td>
                                <td><b>{{ $no_excent }}</b></td>
                            </tr>
                            <tr>
                                <td><b>IVA</b></td>
                                <td><b>{{ $iva }}</b></td>
                            </tr>       
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td><b>{{ $total }}</b></td>
                            </tr>         
                    </tbody>
        </table>
    @else
    <div class="row" align="center">
    	<span class="badge bg-red">
    		
			<h2>No hay ventas registradas entre el ({{Carbon\Carbon::parse($start)->format('d-m-Y')}}) y el ({{Carbon\Carbon::parse($end)->format('d-m-Y')}}).!</h2>
	        <a href="{{ url()->previous() }}" class="btn btn-round btn-warning" title="Regresar"><i class="fa fa-arrow-circle-o-left fa-2x"></i></i>VOLVER</a>
    	</span>
    	
    </div>
    @endif
</body>
</html>