@extends('layouts.app')
@section('content')
<style type="text/css">
  th, td{
    text-align: center;
  }
</style>
<div class="x_content">
    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
      <div class="profile_img">
        <div id="crop-avatar">
          <!-- Current avatar -->
          <img class="img-responsive avatar-view" src="{{asset('images/team-1.jpg') }}" alt="Avatar" title="Change the avatar">
        </div>
      </div>
      <h3>{{ $credit[0]->sale->client->first_name.' '.$credit[0]->sale->client->last_name }}</h3>

      <ul class="list-unstyled user_data">
      	<li>
          <i class="fa fa-credit-card user-profile-icon"></i> {{ $credit[0]->sale->client->dni }}
        </li>
        <li>
          <i class="fa fa-mobile user-profile-icon"></i> {{ $credit[0]->sale->client->telephone }}
        </li>
        <li>
          <i class="fa fa-exchange user-profile-icon"></i> 
			@if($credit[0]->sale->client->client_type != '1')
				{{ "Persona Juridica" }}
			@else
				{{ "Persona Natural" }}
			@endif
        </li>
        <li><i class="fa fa-map-marker user-profile-icon"></i> {{ $credit[0]->sale->client->address }}
        </li>
      </ul>
      @if($credit[0]->status == 0)  
      @else
        <button type="button" class="btn btn-round btn-success btn-sm edit-modal" data-toggle="modal"  data-id="{{ $credit[0]->id }}" title="Procesar Pago"><i class="fa fa-edit m-right-xs fa-2x" ></i> </button>
      @endif
        @if($credit[0]->status == 1)
            <button type="button" class="btn btn-round btn-danger btn-sm" id="proccess" data-toggle="modal"  data-id="{{ $credit[0]->id }}" title="Solventar Credito"><i class="fa fa-edit m-right-xs fa-2x"></i> </button><!--data-target=".bs-example-modal-sm"-->
        @else
            <button type="button" class="btn btn-round btn-info btn-sm" data-toggle="modal" title="Solvente" disabled><i class="fa fa-check m-right-xs fa-2x"></i> </button>
        @endif               
        <a href="{{ url()->previous() }}" class="btn btn-round btn-warning btn-sm" title="Regresar">
        	<i class="fa fa-arrow-circle-o-left fa-2x"></i>
        </a>
                               
      <br />
  	</div>
  	<div class="col-md-9 col-sm-9 col-xs-12">
      <table class="table">
        <thead>
          <tr>
            <th>Por Cobrar</th>
            <th>Tipo Pago</th>
            <th>Banco</th>
            <th>Referencia</th>
            <th>Monto</th>
            <th>Resta</th>
            <th>Fecha de pago</th>
          </tr>
        </thead>
        <tbody>
          @foreach($credit as $item)
            @foreach($item->detailcredit as $detail)
            <tr>
              <td><p class="badge bg-red"> {{ $detail->total }}</p></td>
              <td>{{ $detail->payment_types }}</td>
              <td>{{ $detail->bank }}</td>
              <td>{{ $detail->reference }}</td>
              <td>{{ $detail->rode }}</td>
              <td>{{ $detail->subtraction }}</td>
              <td>{{ Carbon\Carbon::parse($detail->created_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
          @endforeach
        </tbody>
      </table>
	</div>
</div>
<!--modal Editar-->
<div class="x_content">

  <!-- modals -->
  <!-- Large modal -->
  

  <div class="modal fade" id="editclient"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">prueba</h4>
        </div>
        <div class="modal-body">

            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
            <form action="{{route('cuenta_por_cobrar', 'test')}}" class="row" method="POST">
            	{{ csrf_field() }}
            	{{-- method_field('patch') --}}
                <input type="hidden" id='id' name="id" value="">
                @foreach($credit as $credi)
                  @foreach($credi->detailcredit as $item)
                  @endforeach
                @endforeach
                <input type="hidden" name="total" id="total" value="{{$item->total}}">
                <input type="hidden" name="sub" id="sub" value="{{$las->subtraction}}{{--$item->subtraction--}}">
                <input type="hidden" name="s" id="s" value="">
                @include('credits.partials.payment')
			</form>
        </div>
      </div>
    </div>
  </div>
</div>

{{--<div class="modal fade bs-example-modal-sm" id="processOrder" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Procesar pago de orden</h4>
        </div>
        <div class="modal-body">
            <form action="{{Route('creditos.update', 'test')}}" class="row" method="POST">
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
</div>--}}
@endsection
@section('scripts')
<script type="text/javascript">
//alert("hola");
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

    $('.edit-modal').on('click', function() {
    	//var id = e.target.value;
    	//var id = $(this).data('id');
    	var id = $(this).attr('data-id');
      var total = $('#total').val();
      //var res = $('#subtraction').val(tota)
      
    	console.log(id);
      

    	$.ajax({
    		type:'GET',
    		//data:{id:id},
    		//url:'/clientes/'+id+'/edit',
    		//dataType: 'json',

    		success:function(data){
    			console.log(data);
    			$('#editclient').modal('show');
	    		$(".modal-title").html("Agregar Abono");
	    		$('.modal-body #id').val(id);
    		},
    	})

    });	
    /*$('#proccess').on('click', function() {
        var id = $(this).attr('data-id');
        console.log(id);

        $.ajax({
            type:'GET',
            //data:{id:id},
            //url:'/creditos/'+id+'/edit',
            url:'{{--route('creditos.update', 'id')--}}',
            //dataType: 'json',

            success:function(data){
                console.log(data);
                /*$('#processOrder').modal('show');
                $(".modal-title").html("Procesar Pedido");
                $('.modal-body #id').val(id);
                $('.modal-body #num_buy').val();*/
                /*Swal.fire({
                        type: 'success',
                        //title: 'Oops...',
                        text: 'Credito Solvente.!',
                
                    })
                
            },
        })

    });*/
    $('#proccess').on('click', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        confirm("Seguro de querer solventar.?");
            $.ajax({
                type:'DELETE',
                url:'/creditos/'+id,
                cache:false,
                success: function(data, msg){
                    var route = "http://localhost:8000/creditos/"+id;
                    $('#exito').delay(500).fadeIn('slow');
                    //$('.refre').load(route);
                    ////////////////$('.container').load(route);
                    //confirm("Venta Anulada con exito.!");
                    /*if(!data.success){
                      Swal.fire({
                        type: 'error',
                        //title: 'Oops...',
                        text: 'Este Credito no esta Solvente.!',
                
                      });
                    }
                    else{*/

                      Swal.fire({
                          type: 'success',
                          //title: 'Oops...',
                          text: 'Credito Solvente.!',

                      });
                      $('.container').load(route);
                    //}

                },
                error:function(data){
                    Swal.fire({
                        type: 'error',
                        //title: 'Oops...',
                        text: 'Este Credito no esta Solvente.!',
                
                    });
                    console.log('Error:', data);
                }
            })
        
    });
    $('#reference').click(function(){
      rest();
    });
    function rest(){
      var rode = $('#rode').val();
      var sub = $('#sub').val();
      if(parseInt(rode) > parseInt(sub))
        Swal.fire({
          type: 'error',
          //title: 'Oops...',
          text: 'El Monto es superior a la deuda.!',
    
        });
      var tota = sub - rode;
      $('#subtraction').val(tota);
      $('#s').val(tota);
      console.log("rode: "+rode);
      console.log("resta: "+sub);
      console.log(tota);
    }
});
</script>
@endsection