@extends('layouts.app')
@section('content')


<div class="container">
    <div class="panel panel-info">
      <div class="panel-heading col-sm-12">
            <div class="col-sm-12">
                
                <h3 align="center">PRODUCTO: {{ $product->product }}</h3>
            </div>
      </div>

        <table class="table table-bordered">
                
        	<tr>
            	<th colspan="7" class="success" style="text-align: center;">Datos del Producto</th>
            </tr>
            <tr>
                <th style="text-align: center;">CODIGO</th>
				<th style="text-align: center;">STOCK</th>
                <th style="text-align: center;">PRESENTACIÓN</th> 
                <th style="text-align: center;">PAQUETE</th>
				<th style="text-align: center;">PRECIO</th>
                <th style="text-align: center;">EXENTO IVA</th>
                <th style="text-align: center;">IVA</th>
            </tr>
                
            <tr>
                <td style="text-align: center;">{{ $product->cod }}</td>
				<td style="text-align: center;">{{ $product->stock }}</td>
                <td style="text-align: center;">{{ ($product->presentation == 2)?"UNIDADES":"PAQUETES" }}</td>
                <td style="text-align: center;">{{ is_null($product->package) ? "-" : $product->package }}</td>
				<td style="text-align: center;">{{ $product->buy }}</td>
                <td style="text-align: center;">{{ ($product->exent_iva == 1) ? "SI" : "NO" }}</td>
                <td style="text-align: center;">{{ is_null($product->iva) ? "0" : "$product->iva" }}</td>
            </tr>
            <tfooter>
                <tr>
                    <td colspan="7">
                        <a href="{{ url()->previous() }}" class="btn btn-round btn-warning" title="Regresar"><i class="fa fa-arrow-circle-o-left fa-2x"></i></i></a>
                    </td>
                </tr>
            </tfooter>
        </table>
    </div>

<div class="panel">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align: center;">FECHA PRODUCCIÓN</th>
                <th style="text-align: center;">CANTIDAD</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td style="text-align: center;">
                    {{Carbon\Carbon::parse($product->production_date)->format('d-m-Y')}}
                </td>
                <td style="text-align: center;">
                    {{$product->quantity_in}}                
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                {{$products->render()}}
                </td>
            </tr>
        </tfoot>
    </table>
    
</div>


</div>

@endsection