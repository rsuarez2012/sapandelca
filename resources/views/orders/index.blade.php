@extends('layouts.app')

@section('content')
<div class="container">
     
    <div class="row">
        
        <div class="col-md-12 col-md-offset-0">
            
            <div id="exito" class="alert alert-success" style="display: none;">
                <i class="fa fa-check"></i>Pedido Anulado con exito!.

            </div>
            <div class="panel panel-default">
                

                <div class="panel-heading">
                    @php $path = explode('/',Request::path()) @endphp 
                    <b class="sub-header">{{ strtoupper(title_case($path[0])) }}</b>
                    
                    <a href="{{route('pedidos.create') }}" class="btn btn-round btn-primary btn-sm pull-right" title="Registrar Pedido"><i class="fa fa-file-o"></i></a>
                  <div class="clearfix"></div>

                </div>
                <div class="panel-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Id</th>
                                <th style="text-align: center;">Pedido #</th>
                                <th style="text-align: center;">Cliente</th>
                                <th style="text-align: center;">Fecha</th>
                                <th style="text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $id = 1; @endphp   
                        @foreach($orders as $order)
                            <tr>
                                <td align="center">{{ $id++ }}</td>
                                <td align="center">{{ str_pad (!empty($order->num_order) ? $order->num_order: '1', 7, '0', STR_PAD_LEFT) }}</td> 
                                <td align="center">{{ $order->client->client_name }}</td>
                                <td align="center">{{ Carbon\Carbon::parse($order->date_order)->format('d/m/Y') }}</td>
                                <td align="center">
                                    <a href="{{ route('pedidos.show', $order->id) }}" class="btn btn-round btn-info btn-sm" title="Detalles Pedido"><i class="fa fa-file-text"></i> </a>
                                    @if($order->status == '0')
                                        <button type="button" class="btn btn-round btn-danger btn-sm null-sale" id="null-sale" data-id="{{ $order->id }}" title="Eliminar"><i class="fa fa-remove"></i></button>
                                    @else
                                        @if($order->status == '2')
                                            <button type="button" class="btn btn-round btn-warning btn-sm null-sale" id="null-sale" data-id="{{ $order->id }}" title="Anulada" disabled><i class="fa fa-remove"></i></button>
                                            @endif

                                        
                                    @endif

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
        confirm("Esta seguro de Eliminar?");
            $.ajax({
                type:'DELETE',
                url:'/pedidos/'+id,
                success: function(data, msg){
                    var route = "http://localhost:8000/pedidos";
                    $('#exito').delay(500).fadeIn('slow');
                    //$('.refre').load(route);
                    $('.container').load(route);
                    //confirm("Venta Anulada con exito.!");
                    Swal.fire({
                        type: 'success',
                        //title: 'Oops...',
                        text: 'El pedido fue anulada con exito.!',
                
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