@extends('layouts.app')
@section('content')


<div class="container">
    <div class="panel panel-info">
      <div class="panel-heading">
            
            <h3>Producto: {{ $product->nombre_producto }}</h3>
      </div>
        <table>
            <tr>
                <h4 colspan="6" class="alert-success" style="text-align: center;">Datos de Entrada</t4>
            </tr>
            <tr>
                <table class="table table-striped">
                    <thead>
                        
                        <tr>
                            <th style="text-align: center;">Entrada</th>
                            <th style="text-align: center;">Restante</th> 
                            <th style="text-align: center;">Presentación</th>
                            <th style="text-align: center;">Fecha de Entrada</th>
                            <th style="text-align: center;">Fecha de Actulización</th>
                            <th style="text-align: center;">Resonsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr style="text-align: center;">
                            <td>{{ $product->cantidad_entrada }}</td>
                            <td>{{ $product->cantidad_saliente }}</td>
                            <td>{{ $product->presentacion_nombre }}{{-- Carbon\Carbon::parse($person->birthdate)->format('d-m-Y') --}}</td>
                            <td>{{ Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($product->updated_at)->format('d-m-Y') }}</td>
                            <td>{{ $product->responsable }}</td>
                        </tr>   
                    </tbody>
                </table>
            </tr>
            <tr>
                <h4 colspan="5" class="alert-danger" style="text-align: center;">Datos de Salida</h4> 
            </tr>
            
            <tr>

                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Cantidad</th>
                            <th style="text-align: center;">Presentación</th>
                            <th style="text-align: center;">Fecha de Salida</th>
                            <th style="text-align: center;">Departamento</th>
                        </tr>
                    </thead> 
                    <tbody>
                        
                        @foreach($details as $detail)
                        <tr style="text-align: center;">

                            <td>
                                {{ $detail->quantity }}
                            </td>
                            <td>{{ $detail->warehouse->presentacion_nombre }}</td>
                            <td>{{ Carbon\Carbon::parse($detail->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $detail->departament->departament }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4">
                            <!--<a href="{{-- route('titulares.edit', $person->id) --}}" class="btn btn-success btn-sm">Editar</a>-->
                            <a href="{{ url()->previous() }}" class="btn btn-round btn-warning btn-sm" title="Regresar">
                                <i class="fa fa-arrow-circle-o-left fa-2x"></i>
                            </a>
                        </td>
                      </tr>
                    </tfoot>
                </table>
            </tr>

        </table>
        
    </div>

</div>

@endsection