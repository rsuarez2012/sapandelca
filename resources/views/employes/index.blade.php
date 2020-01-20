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
                	<button type="button" class="btn btn-round btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"title="Nuevo Empleado"><i class="fa fa-file-o"></i></button>
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
								<th style="text-align: center;">Telefono</th>
								<th style="text-align: center;">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@php $id = 1; @endphp	
						@foreach($employes as $employe)					
							<tr class="employe_id{{ $employe->id }}">
								<td align="center">{{ $id++ }}</td>
								<td align="center">{{ $employe->name }}</td> 
                <td align="center">{{ $employe->last_name }}</td> 
                <td align="center">{{ $employe->dni }}</td>               
                <td align="center">{{ $employe->cellphone }}</td> 							
								<td align="center">						
									<!--<button type="button" class="btn btn-success btn-sm edit-modal" data-toggle="modal"  data-id="{{-- $employe->id --}}">Editar</button>-->

									<button type="button" class="btn btn-round btn-danger btn-sm delete-employe" id="delete-employe" data-id="{{ $employe->id }}" title="Eliminar empleado"><i class="fa fa-trash-o"></i></button>
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
          <h4 class="modal-title" id="myModalLabel">Registrar empleado</h4>
        </div>
        <div class="modal-body">

            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
            <form action="{{Route('empleados.store')}}" class="row" method="POST">
            	{!! csrf_field() !!}
                <!--<input type="hidden" id='people_id' name="people_id" value="{{-- $person->id --}}">-->
                @include('employes.partials.form')
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
    		url:'/employees/'+id+'/edit',
    		dataType: 'json',

    		success:function(data){
    			console.log(data);
    			$('#editemploye').modal('show');
	    		$(".modal-title").html("Editar employee");
	    		$('.modal-body #id').val(id);
          $('.modal-body #first_name').val(data.first_name);
          $('.modal-body #last_name').val(data.last_name);
          $('.modal-body #dni').val(data.dni);
          $('.modal-body #employe_type').val(data.employe_type);
          $('.modal-body #address').val(data.address);
	    		$('.modal-body #telephone').val(data.telephone);
	    		
    		},
    	})

    });*/

    $('.delete-employe').on('click', function(){
    	
    	var id = $(this).attr('data-id');
    	confirm("Esta seguro de eliminar?");
	    	$.ajax({
	    		type:'DELETE',
	    		url:'/employees/'+id,
	    		success: function(data, msg){
	    			$('#exito').delay(500).fadeIn('slow');
	    			$('.employe_id'+id).remove();

	    		},
	    		error:function(data){
	    			console.log('Error:', data);
	    		}
	    	})
    	
    });

	
});
</script>
@endsection