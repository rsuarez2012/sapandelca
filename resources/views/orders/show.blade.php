@extends('layouts.app')
@section('content')
<div class="x_content">
    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
      <div class="profile_img">
        <div id="crop-avatar">
          <!-- Current avatar -->
          <img class="img-responsive avatar-view" src="{{asset('images/team-1.jpg') }}" alt="Avatar" title="Change the avatar">
        </div>
      </div>
      <h4><b>Cliente:</b><br /> {{ $order->client->first_name.' '.$order->client->last_name }}</h4>

      <ul class="list-unstyled user_data">
        <li>
          <i class="fa fa-credit-card user-profile-icon"></i> {{ $order->client->dni }}
        </li>
        <li>
          <i class="fa fa-mobile user-profile-icon"></i> {{ $order->client->telephone }}
        </li>
        <li>
          <i class="fa fa-exchange user-profile-icon"></i> 
            @if($order->client->client_type != '1')
                {{ "Persona Juridica" }}
            @else
                {{ "Persona Natural" }}
            @endif
        </li>
        <li><i class="fa fa-map-marker user-profile-icon"></i> {{ $order->client->address }}
        </li>
      </ul>
        <a href="{{ url()->previous() }}" class="btn btn-round btn-warning btn-sm" title="Regresar">
            <i class="fa fa-arrow-circle-o-left"></i>
        </a>
      <!--<button type="button" class="btn btn-round btn-success btn-sm edit-order" data-toggle="modal"  data-id="{{-- $order->id --}}" title="Editar Perfil"><i class="fa fa-edit m-right-xs"></i> </button>-->
               
        @if($order->status == 0)
            <button type="button" class="btn btn-round btn-danger btn-sm" id="proccess" data-toggle="modal"  data-id="{{ $order->id }}" title="Procesar Pedido"><i class="fa fa-edit m-right-xs"></i> </button><!--data-target=".bs-example-modal-sm"-->
        @else
            <button type="button" class="btn btn-round btn-info btn-sm" data-toggle="modal" title="Pedido Procesado" disabled><i class="fa fa-check m-right-xs"></i> </button>
        @endif
      <br />
    </div>
    <div class="col-md-9 col-sm-9 col-xs-12">

      <div class="profile_title">
        <div class="col-md-12">
          <h3 style="text-align: center;">Detalles del Pedido</h3>
          @if($order->status != 0)
            <h5 style="text-align:center;">
                <span class="badge bg-green">
                    Datos del Pago: {{ $order->num_buy }}
                </span>
            </h5>
          @else

          @endif

        </div>
      </div>
      <!-- start of user-activity-graph -->
        <div id="graph_bar" style="width:100%; height:auto;">
            <table class="table table-striped">
                <tr>
                <th>Orden</th>
                <th>Solicitud</th>
                <th>Entrega</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total</th>
                </tr>
            {{--$detailorders--}}
                @php
                $subtotal = 0;
                $iva = 0;
                $total = 0;
                $excent = 0;
                $no_excent = 0;

                @endphp
                @foreach($detailorders as $detailorder)
                <tr>
                    <td>
                        {{ str_pad ($detailorder->orders->num_order, 7, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($detailorder->orders->date_order)->format('d/m/Y') }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($detailorder->orders->date_delivery)->format('d/m/Y') }}
                    </td>
                    <td>
                        {{ $detailorder->products->product }}
                    </td>
                    <td>
                        {{ $detailorder->quantity_product }}
                    </td>
                    <td>
                        {{ ($detailorder->quantity_product*$detailorder->price) }}
                    </td>
                    @php
                        $subtotal +=($detailorder->quantity_product*$detailorder->price);
                        $iva += ($detailorder->quantity_product*$detailorder->products->iva);
                        $total += $detailorder->quantity_product*($detailorder->price + $detailorder->products->iva);
                    @endphp
                    @if($detailorder->products->exent_iva == 1)
                        @php
                            $excent += $detailorder->quantity_product*$detailorder->price;
                        @endphp
                    @else
                        @php
                            $no_excent += $detailorder->quantity_product*$detailorder->price;
                        @endphp
                    @endif
                </tr>
                @endforeach
            </table>
            <table class="table">
                <tr>
                    <td colspan="6"></td>
                    <td><b  class="pull-right">SUBTOTAL:</b></td>
                    <td><p class="pull-right">{{$subtotal}}</p></td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <td><b class="pull-right">EXENTOS (E):</b></td>
                    <td><p class="pull-right">{{$excent}}</p></td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <td><b class="pull-right">BI (G):</b></td>
                    <td><p class="pull-right">{{$no_excent}}</p></td>
                </tr>
                <tr>
                    <td colspan="6"></td>
                    <td><b class="pull-right">TOTAL:</b></td>
                    <td><p class="pull-right">{{$total}}</p></td>
                </tr>
            </table>
        </div>
      <!-- end of user-activity-graph -->
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="processOrder" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Procesar pago de orden</h4>
        </div>
        <div class="modal-body">
            <form action="{{Route('pedidos.update', 'test')}}" class="row" method="POST">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input type="hidden" id='id' name="id" value="">
                <div class="form-group col-md-12">
                        <input type="text" name="num_buy" id="num_buy" class="form-control col-md-2" placeholder="Referencia del Pago" autocomplete="off">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Procesar</button>
        </div>
            </form>

      </div>
    </div>
</div>

                  <!-- /modals -->
{{--<div class="modal fade bs-example-modal-sm in" id="processOrder"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">prueba</h4>
        </div>
        <div class="modal-body">
            <form action="{{Route('pedidos.update', 'test')}}" class="row" method="POST">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input type="hidden" id='id' name="id" value="">
                <div class="form-group col-md-10">
                        <input type="text" name="num_buy" id="num_buy" class="form-control col-md-2" placeholder="Numero de Referencia del Pago" autocomplete="off">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
--}}
{{--<div class="modal fade" id="editOrder"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">prueba</h4>
        </div>
        <div class="modal-body">
            <form action="{{Route('pedidos.update', 'test')}}" class="row" method="POST">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input type="hidden" id='id' name="id" value="">
                @include('orders.partials.form')
            </form>
        </div>
      </div>
    </div>
  </div>--}}

@endsection
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
    $('#proccess').on('click', function() {
        var id = $(this).attr('data-id');
        console.log(id);

        $.ajax({
            type:'GET',
            //data:{id:id},
            url:'/clientes/'+id+'/edit',
            dataType: 'json',

            success:function(data){
                console.log(data);
                $('#processOrder').modal('show');
                $(".modal-title").html("Procesar Pedido");
                $('.modal-body #id').val(id);
                $('.modal-body #num_buy').val();
                
            },
        })

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