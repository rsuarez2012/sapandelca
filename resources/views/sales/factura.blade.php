<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="panel" style="background: #EDEDED;">
      <div class="panel-heading">
{{--dd($sale[0]->num_fac)--}}
			
			
            <span class="col-md-12">                
				<img src="{{asset('images/pandelcaLogo_2.jpg')}}" alt="..." class="img-circle profile_img pull-left" height="200" width="200">
                <h4 class="pull-right"><b>FACTURA: </b>{{ str_pad ($sale[0]->num_fac, 7, '0', STR_PAD_LEFT) }}</h4>
                <br>
                <br>
                <h4 class="pull-right"><b>N° CONTROL: </b></h4>
                <br>
                <br>
                <h4 class="pull-right"><b>FECHA: </b>{{ Carbon\Carbon::parse($sale[0]->date_created)->format('d/m/Y')}}</h4>
                <br>
                <br>
                <h4 class="pull-right"><b>HORA: </b>{{ Carbon\Carbon::parse($sale[0]->date_created)->format('H:i')}}</h4>
                <br>

            </span>
            <br>
            <br>
            <h4><b>RIF.: J-316284484</b></h4>
			<h4><b>Av. Urdaneta Local 99-6 N°.2 Sector Santa Rosa</b></h4>
			<h4><b>Valencia Estado Carabobo / Zona Postal 2001</b></h4>
			<h4><b>(58)241 835-77-93</b></h4>
			<hr>
            <span class="col-md-9">

                <h3><b>Cliente o Razón Social.:</b> {{$sale[0]->client->first_name.' '.$sale[0]->client->last_name}}</h3>
                <h3><b>C.I/R.I.F.:</b> {{$sale[0]->client->dni}}</h3>
            </span>


            

            <table class="table table-bordered table-striped">
                <thead>
                    <thead>
                        <tr>
                            <th colspan="3">
                                <h3 align="center">DETALLE VENTA </h3>
                            </th>
                        </tr>
                        <tr>
                            <th>PRODUCTO</th>
                            <th>CANTIDAD</th>
                            <th>SUBTOTAL</th>
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
                        @foreach($detailsales as $detailsale)
                            <tr>
                                <td>{{ $detailsale->products->product }}</td>
                                <td>{{ $detailsale->quantity_product}}</td>
                                @php
                                    $subtotal +=($detailsale->quantity_product*$detailsale->total);
                                    $iva += ($detailsale->quantity_product*$detailsale->products->iva);
                                    $total += $detailsale->quantity_product*($detailsale->total + $detailsale->products->iva);
                                @endphp
                                <td>{{ ($detailsale->quantity_product*$detailsale->total)}}</td>
                            </tr> 
                            @if($detailsale->products->exent_iva == 1)
                                @php
                                    $excent += $detailsale->quantity_product*$detailsale->total;
                                @endphp
                            @else
                                @php
                                    $no_excent += $detailsale->quantity_product*$detailsale->total;
                                @endphp
                            @endif
                        @endforeach       

                            <tr>
                                
                                <td colspan="2"><b class="pull-right">SUBTOTAL</b></td>
                                <td>{{$subtotal}}</td>
                            </tr>
                            <tr>
                                
                                <td colspan="2"><b class="pull-right">EXENTOS (E)</b></td>
                                <td>{{$excent}}</td>
                            </tr>
                            <tr>
                                
                                <td colspan="2"><b class="pull-right">BI (G)</b></td>
                                <td>{{$no_excent}}</td>
                            </tr>
                            <tr>
                                
                                <td colspan="2"><b class="pull-right">IVA</b></td>
                                <td>{{$iva}}</td>
                            </tr>       
                            <tr>
                                
                                <td colspan="2"><b class="pull-right">TOTAL</b></td>
                                <td>{{$total}}</td>
                            </tr>         
                    </tbody>
                </thead>
            </table>


            
               
                <span>{{-- $detailsale->name --}}</span>
            
        
        <!--<a href="{{---- route('titulares.beneficiarios', $person->id) ----}}" class="btn btn-warning btn-sm">Ver Carga Familiar</a>-->
        <!--<a class="btn btn-primary btn-sm pull-right" href="{{------ route('nuevo_beneficiario', [$person->id]) ------}}">Nuevo Beneficiario</a>-->
        <!--<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">Nuevo Beneficiario</button>-->
      </div>
    </div>

</div>

</body>
</html>