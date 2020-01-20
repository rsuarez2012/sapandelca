@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		
		<div class="col-md-12 col-md-offset-0">
			
			<div id="exito" class="alert alert-success" style="display: none;">
				<i class="fa fa-check"></i>Cliente eliminado con exito!.

			</div>
            <div class="panel panel-default">
            	

                <div class="panel-heading">
                	@php $path = explode('/',Request::path()) @endphp 
                	<b class="sub-header">{{ strtoupper(title_case($path[0])) }}</b>
                	<button type="button" class="btn btn-round btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"title="Nuevo Cliente"><i class="fa fa-file-o"></i></button>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                	
            		<table class="table">
						<thead>
							<tr>
								<th style="text-align: center;">Id</th>
                <th style="text-align: center;">Nombres</th>
                <th style="text-align: center;">Apellidos</th>
								<th style="text-align: center;">Cedula</th>
								<th style="text-align: center;">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@php $id = 1; @endphp	
						@foreach($clients as $client)					
							<tr class="client_id{{ $client->id }}">
								<td align="center">{{ $id++ }}</td>
								<td align="center">{{ $client->first_name }}</td> 
                <td align="center">{{ $client->last_name }}</td> 
                <td align="center">{{ $client->dni }}</td> 							
								<td align="center">	
                  <a href="{{ route('clientes.show', $client->id) }}" class="btn btn-round btn-info btn-sm"title="Ver Cliente"><i class="fa fa-eye"></i></a>					
									<!--<button type="button" class="btn btn-success btn-sm edit-modal" data-toggle="modal"  data-id="{{-- $client->id --}}">Editar</button>-->

									<button type="button" class="btn btn-round btn-danger btn-sm delete-client" id="delete-client" data-id="{{ $client->id }}" title="Eliminar Cliente"><i class="fa fa-trash-o"></i></button>
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
<!--modal-->
<div class="x_content">

  <!-- modals -->
  <!-- Large modal -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Registrar cliente</h4>
        </div>
        <div class="modal-body">

            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
            <form action="{{Route('clientes.store')}}" class="row" method="POST">
            	{!! csrf_field() !!}
                <!--<input type="hidden" id='people_id' name="people_id" value="{{-- $person->id --}}">-->
                @include('clients.partials.form')
			</form>
        </div>
      </div>
    </div>
  </div>
</div>

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
    /*$('.edit-modal').on('click', function() {
    	//var id = e.target.value;
    	//var id = $(this).data('id');
    	var id = $(this).attr('data-id');
    	console.log(id);

    	$.ajax({
    		type:'GET',
    		//data:{id:id},
    		url:'/clientes/'+id+'/edit',
    		dataType: 'json',

    		success:function(data){
    			console.log(data);
    			$('#editclient').modal('show');
	    		$(".modal-title").html("Editar cliente");
	    		$('.modal-body #id').val(id);
          $('.modal-body #first_name').val(data.first_name);
          $('.modal-body #last_name').val(data.last_name);
          $('.modal-body #dni').val(data.dni);
          $('.modal-body #client_type').val(data.client_type);
          $('.modal-body #address').val(data.address);
	    		$('.modal-body #telephone').val(data.telephone);
	    		
    		},
    	})

    });*/

    $('.delete-client').on('click', function(){
    	
    	var id = $(this).attr('data-id');
    	confirm("Esta seguro de eliminar?");
	    	$.ajax({
	    		type:'POST',
	    		url:'/clientes/status/'+id,
	    		success: function(data, msg){
	    			$('#exito').delay(500).fadeIn('slow');
	    			$('.client_id'+id).remove();

	    		},
	    		error:function(data){
	    			console.log('Error:', data);
	    		}
	    	})
    	
    });

	
});
</script>
@endsection