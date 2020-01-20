<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<style type="text/css">
		.head, .client{
			margin-left: 40px;
		}
		.table{
            border:1px solid #000;
            width: 100%;
            margin-left: 40px;
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
        /*.row{
            padding-top: 280px;
        }*/
	</style>
</head>
<body>
	<div class="row">
		<div class="col-md-12 head">
			<span>
			
				<img src="{{asset('images/pandelcaLogo_2.jpg')}}" alt="..." class="img-circle profile_img pull-left" height="200" width="200">
			<h4 class="pull-right"><b>NOTA DE ENTREGA N°:</b> {{ str_pad ($sale[0]->num_fac, 7, '0', STR_PAD_LEFT) }}</h4>
			<br>
			<br>
				<table class="pull-right" border="1">
					<tr>
						
						<th>&nbsp;LUGAR DE EMISIÓN&nbsp;</th>
						<th colspan="3">&nbsp;DIA MES AÑO&nbsp;</th>
					</tr>
					<tr>
						
					
						<td style="text-align: center"><b>Valencia</b></td>
						<td>{{ Carbon\Carbon::now()->format('d')}}</td>
						<td>{{ Carbon\Carbon::now()->format('m')}}</td>
						<td>{{ Carbon\Carbon::now()->format('Y')}}</td>
					</tr>
					<tr>
						<td colspan="4"><b>Hora:</b> {{ Carbon\Carbon::now()->format('H:i')}}</td>
					</tr>
				</table>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<b>RIF.: J-316284484</b><br>
				<b>Av. Urdaneta Local 99-6 N°.2 Sector Santa Rosa</b><br>
				<b>Valencia Estado Carabobo / Zona Postal 2001</b><br>
				<b>(58)241 835-77-93</b>
				
			</span>			
		</div>
	</div>
	<hr>
	<div class="client">
	<h4><b>Razón Social: </b> {{$sale[0]->client->first_name.' '.$sale[0]->client->last_name}}</h4>
	<h4><b>C.I/R.I.F.: </b> {{$sale[0]->client->dni}}</h4>
	<h4><b>DIRECCIÓN:</b> {{$sale[0]->client->address}}</h4>
	<h4><b>TELEFONO:</b> {{$sale[0]->client->telephone}}</h4>
		
	</div>

	<br>
		
	<table class="table">
		<thead>
			<th>CANTIDAD</th>
			<th>CONCEPTO O DESCRIPCIÓN</th>
			<th>PRECIO UNITARIO Bs</th>
			<th>TOTAL</th>
		</thead>
		<tbody>
			@foreach($sale as $item)
				@foreach($item->detailsale as $prod)
			<tr>
			{{--$prod--}}
			{{--$prod->products--}}
			<td>{{$prod->quantity_product}}</td>
			<td>{{$prod->products->product}}</td>
			<td>
				{{--$prod->products->buy--}}
				@if(empty($prod->products))
					{{$prod->products->buy}}
				@else	
					{{($prod->products->buy + $prod->products->iva)}}
				@endif
				</td>
			<td>
				{{--($prod->quantity_product*$prod->products->buy)--}}
				@if(empty($prod->products))
					{{($prod->quantity_product*$prod->products->buy)}}
				@else	
					{{($prod->products->buy + $prod->products->iva)*$prod->quantity_product}}
				@endif
			</td>
				
			</tr>
				@endforeach
			@endforeach
			<tr>
				<td colspan="4"><b class="">Sin Derecho a Crédito Fiscal.</b></td>
			</tr>
			<tr>
				<td colspan="4"><b>ESTE DOCUMENTO VA SIN TACHADURAS NI ENMENDADURAS</b></td>
			</tr>
		</tbody>
	</table>
	
<hr>
</body>
</html>
