@extends('layouts.app')

@section('content')
<div class="container">
     
    <div class="row">
        
        <div class="col-md-12 col-md-offset-0">
            
            <div id="exito" class="alert alert-success" style="display: none;">
                <i class="fa fa-check"></i>Venta Anulada con exito!.

            </div>
            <div class="panel panel-default">
                

                <div class="panel-heading">
                    @php $path = explode('/',Request::path()) @endphp 
                    <b class="sub-header">{{ strtoupper(title_case($path[0])) }}</b>
                    
                    <a href="{{route('ventas.create')}}" class="btn btn-round btn-primary btn-sm pull-right" title="Registrar Venta"><i class="fa fa-file-o"></i></a>
                  <div class="clearfix"></div>

                </div>
                <div class="panel-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Id</th>
                                <th style="text-align: center;">Factura</th>
                                <th style="text-align: center;">Fecha Factura</th>
                                <th style="text-align: center;">Cliente</th>
                                <th style="text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $id = 1; @endphp   
                        @foreach($sales as $sale)
                            <tr>
                                <td align="center">{{ $id++ }}</td>
                                <td align="center">{{ str_pad (!empty($sale->num_fac) ? $sale->num_fac: '1', 7, '0', STR_PAD_LEFT) }}</td> 
                                <td align="center">{{ $sale->date_created }}</td>
                                <td align="center">{{ $sale->client->client_name }}</td>
                                <td align="center">
                                    <a href="{{ route('ventas.show', $sale->id) }}" class="btn btn-round btn-info btn-sm" title="Detalles Venta" data-toggle="tooltip"><i class="fa fa-file-text"></i> </a>
                                    @if($sale->status == '1')
                                        <button type="button" class="btn btn-round btn-warning btn-sm null-sale" id="null-sale" data-id="{{ $sale->id }}" title="Anular" data-toggle="tooltip"><i class="fa fa-remove"></i></button>
                                    @else
                                        <button  type="button" class="btn btn-round btn-danger btn-sm" title="Anulada" id="anulado" disabled data-toggle="tooltip"><i class="fa fa-minus-square"></i></button>
                                    @endif

                                    <a href="{{ route('fact_venta', $sale->id) }}" target="_blank" class="btn btn-round btn-success btn-sm" title="Factura de la compra" data-toggle="tooltip"><i class="fa fa-file-text"></i> </a>

                                    <a href="{{ route('nota_de_entrega', $sale->id) }}" target="_blank" class="btn btn-round btn-default btn-sm" title="Nota de Entrega" data-toggle="tooltip"><i class="fa fa-edit"></i> </a>

                                </td>
                            </tr>
                        @endforeach                         
                        </tbody>                        
                    </table>                        
                </div>
                
            </div>

        </div>


    </div>
                

</div>
@section('scripts')
<script type="text/javascript">
    
$(document).ready(function(){
    var protocol = $(location).attr('protocol');
    var url = $(location).attr('host');
    var full_url = protocol + '//' + url;
    /*** allow ajax requests  ***/
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.null-sale').on('click', function(){
        var id = $(this).attr('data-id');
        confirm("Esta seguro de anular?");
            $.ajax({
                type:'DELETE',
                url:'/ventas/'+id,
                success: function(data, msg){
                    var route = "http://localhost:8000/ventas";
                    $('#exito').delay(500).fadeIn('slow');
                    //$('.refre').load(route);
                    $('.container').load(route);
                    //confirm("Venta Anulada con exito.!");
                    Swal.fire({
                        type: 'success',
                        //title: 'Oops...',
                        text: 'La Venta fue anulada con exito.!',
                
                    })

                },
                error:function(data){
                    console.log('Error:', data);
                }
            })
        
    });
});
</script>
@endsection
@endsection