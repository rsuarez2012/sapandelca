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
			width: auto;
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


    @if($orders->count() > '0')

            <span class="col-md-3 pull-right">                
                <!--<h4>FACTURA: {{-- str_pad ($order[0]->num_fac, 7, '0', STR_PAD_LEFT) --}}</h4>-->
                <h4>FECHA: {{ Carbon\Carbon::parse($today)->format('d/m/Y') }}</h4>
                <h4>HORA: {{ Carbon\Carbon::parse($today)->format('H:i') }}</h4>
            </span>
            
        <table>
                    <thead>
                        <tr>
                            <th colspan="7">
                                <h3 align="center">PEDIDOS DEL DIA </h3>
                            </th>
                        </tr>
                        <tr>
                        	<th style="text-align: center;">ORDEN</th>
                            <th style="text-align: center;">FECHA PEDIDO</th>
                            <th style="text-align: center;">FECHA ENTREGA</th>
                            <th style="text-align: center;">CLIENTE</th>
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
                        @foreach($orders as $order)
							@foreach($order->detailorder as $detail)
                            <tr>
                            	<td style="text-align: center;">{{str_pad ($order->num_order, 7, '0', STR_PAD_LEFT)  }}</td>
                                <td>{{ Carbon\Carbon::parse($order->date_order)->format('d/m/Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($order->date_delivery)->format('d/m/Y') }}</td>
                                <td>{{ $order->client->client_name }}</td>
                                <td style="text-align: center;">{{ $detail->products->product }}</td>
                                <td style="text-align: center;">{{ $detail->quantity_product }}</td>
                                @php
                                    $subtotal +=($detail->quantity_product*$detail->price);
                                    $iva += ($detail->quantity_product*$detail->products->iva);
                                    $total += $detail->quantity_product*($detail->price + $detail->products->iva);
                                @endphp
                                <td style="text-align: center;">{{ ($detail->quantity_product*$detail->price) }}</td>
                            </tr> 
	                            @if($detail->products->exent_iva == 1)
	                                @php
	                                    $excent += $detail->quantity_product*$detail->price;
	                                @endphp
	                            @else
	                                @php
	                                    $no_excent += $detail->quantity_product*$detail->price;
	                                @endphp
	                            @endif
                            @endforeach
                        @endforeach       

                            <tr>
                            	<td colspan="5" rowspan="5"></td>
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
    		
			<h2>No hay pedidos registrados para el dia ({{Carbon\Carbon::parse($today)->format('d-m-Y')}}).! </h2>
	        <a href="{{ url()->previous() }}" class="btn btn-round btn-warning" title="Regresar"><i class="fa fa-arrow-circle-o-left fa-2x"></i></i>VOLVER</a>
    	</span>
    	
    </div>
    @endif
</body>
</html>