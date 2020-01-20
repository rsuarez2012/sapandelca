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

                  <div class="clearfix"></div>

                </div>
                <div class="panel-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Id</th>
                                <th style="text-align: center;">Pedido #</th>
                                <th style="text-align: center;">Cliente</th>
                                <th style="text-align: center;">Fecha Entrega</th>
                                <th style="text-align: center;">Pago #</th>
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
                                <td align="center">{{ $order->num_buy }}</td>
                                <td align="center">
                                    <a href="{{ route('pedidos.show', $order->id) }}" class="btn btn-round btn-info btn-sm" title="Detalles Pedido"><i class="fa fa-file-text"></i> </a>
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
@endsection