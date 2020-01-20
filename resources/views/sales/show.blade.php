@extends('layouts.app')
@section('content')


<div class="container">
    <div class="panel" style="background: #EDEDED;">
      <div class="panel-heading">
{{--dd($sale[0]->num_fac)--}}
            <span class="col-md-9">
                <h3>Razón Social: {{$sale[0]->client->first_name.' '.$sale[0]->client->last_name}}</h2>
                <h3>C.I/R.I.F.:{{$sale[0]->client->dni}}</h3>
            </span>


            <span class="col-md-3 pull-right">                
                <h4>FACTURA: {{ str_pad ($sale[0]->num_fac, 7, '0', STR_PAD_LEFT) }}</h4>
                <h4>FECHA: {{ Carbon\Carbon::parse($sale[0]->date_created)->format('d/m/Y')}}</h4>
                <h4>HORA: {{ Carbon\Carbon::parse($sale[0]->date_created)->format('H:i')}}</h4>
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
                                <td></td>
                                <td>SUBTOTAL</td>
                                <td>{{$subtotal}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>EXENTOS (E)</td>
                                <td>{{$excent}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>BI (G)</td>
                                <td>{{$no_excent}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>IVA</td>
                                <td>{{$iva}}</td>
                            </tr>       
                            <tr>
                                <td></td>
                                <td>TOTAL</td>
                                <td>{{$total}}</td>
                            </tr>         
                    </tbody>

                    <tfooter>
                        <tr>
                            <td colspan="7">
                                <a href="{{ url()->previous() }}" class="btn btn-round btn-warning" title="Regresar"><i class="fa fa-arrow-circle-o-left fa-2x"></i></i></a>
                                @php
                                    //$empleado = $sale->employe->name.' '.$sale[0]->employe->last_name;
                                @endphp
                                <p class="pull-right">
                                    Despachado por: {{$sale[0]->employe['name'].' '.$sale[0]->employe['last_name']}}
                                </p>
                            </td>
                            
                        </tr>
                    </tfooter>
                </thead>
            </table>


            
               
                <span>{{-- $detailsale->name --}}</span>
            
        
        <!--<a href="{{---- route('titulares.beneficiarios', $person->id) ----}}" class="btn btn-warning btn-sm">Ver Carga Familiar</a>-->
        <!--<a class="btn btn-primary btn-sm pull-right" href="{{------ route('nuevo_beneficiario', [$person->id]) ------}}">Nuevo Beneficiario</a>-->
        <!--<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">Nuevo Beneficiario</button>-->
      </div>
    </div>

</div>

@endsection