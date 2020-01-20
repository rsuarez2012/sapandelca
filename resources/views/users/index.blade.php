@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		
		<div class="col-md-12 col-md-offset-0">
			
			<div id="exito" class="alert alert-success" style="display: none;">
				<i class="fa fa-check"></i>Usuario eliminado con exito!.

			</div>
            <div class="panel panel-default">
            	

                <div class="panel-heading">
                	@php $path = explode('/',Request::path()) @endphp 
                	<b class="sub-header">{{-- strtoupper(title_case($path[0])) --}}</b>
                	<button type="button" class="btn btn-round btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg" title="Registrar Usuario"><i class="fa fa-file-o"></i></button>
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
						@foreach($users as $user)					
							<tr class="user_id{{ $user->id }}">
								<td align="center">{{ $id++ }}</td>
								<td align="center">{{ $user->first_name }}</td> 
                <td align="center">{{ $user->last_name }}</td> 
                <td align="center">{{ $user->dni }}</td> 							
								<td align="center">	
                  {{--<a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-round btn-info btn-sm">Ver</a>--}}					
									<button type="button" class="btn btn-round btn-success btn-sm edit-modal" data-toggle="modal"  data-id="{{ $user->id }}" title="Editar"><i class="fa fa-edit"></i></button>
                  
                  {{--@if($user->status)
					 				  <button type="button" class="btn btn-danger btn-sm delete-user" id="delete-client" data-id="{{ $user->id }}" >Desactivar</button>
                  @else
                    <button type="button" class="btn btn-warning btn-sm delete-user" id="delete-client" data-id="{{ $user->id }}" >Activar</button>
                  @endif--}}


                  @if($user->status)

                    <button type="button" class="btn btn-round btn-danger btn-sm" data-id="{{$user->id}}" data-toggle="modal" data-target="#cambiarEstado" title="Desactivar">
                        <i class="fa fa-times"></i> </button>

                   @else

                     <button type="button" class="btn btn-round btn-warning btn-sm" data-id="{{$user->id}}" data-toggle="modal" data-target="#cambiarEstado" title="Activar">
                        <i class="fa fa-success"></i> </button>

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
          <h4 class="modal-title" id="myModalLabel">Registrar usuario</h4>
        </div>
        <div class="modal-body">

            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
            <form action="{{Route('usuarios.store')}}" class="row" method="POST">
            	{!! csrf_field() !!}
                <!--<input type="hidden" id='people_id' name="people_id" value="{{-- $person->id --}}">-->
                @include('users.partials.form')
			</form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--modal Editar-->
<div class="x_content">

  <!-- modals -->
  <!-- Large modal -->
  

  <div class="modal fade" id="editUser"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="modal-body">

            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
            <form action="{{Route('usuarios.update', 'test')}}" class="row" method="POST">
            	{{ csrf_field() }}
            	{{ method_field('patch') }}
                <input type="hidden" id='id' name="id" value="">
                @include('users.partials.form')
			</form>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Inicio del modal Cambiar Estado del usuario -->
             <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado del Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{url('/usuarios',$user->id)}}" method="POST">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="id" name="id" value="">

                                <p>Estas seguro de cambiar el estado?</p>
        

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i>Cerrar</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-lock fa-2x"></i>Aceptar</button>
                            </div>

                         </form>
                    </div>
                    <!-- /.modal-content -->
                   </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- Fin del modal Eliminar -->
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
    	console.log(id);

    	$.ajax({
    		type:'GET',
    		//data:{id:id},
    		url:'/usuarios/'+id+'/edit',
    		dataType: 'json',

    		success:function(data){
    			console.log(data);
    			$('#editUser').modal('show');
	    		$(".modal-title").html("Editar usuario");
	    		$('.modal-body #id').val(id);
          $('.modal-body #first_name').val(data.first_name);
          $('.modal-body #last_name').val(data.last_name);
          $('.modal-body #dni').val(data.dni);
          $('.modal-body #rol_id').val(data.rol_id);
          $('.modal-body #address').val(data.address);
          $('.modal-body #telephone').val(data.telephone);
	    		$('.modal-body #cellphone').val(data.cellphone);
          $('.modal-body #email').val(data.email);
          $('.modal-body #user').val(data.user);
          $('.modal-body #password').val(data.password);
	    		
    		},
    	})

    });

    $('.delete-user').on('click', function(){
    	
    	var id = $(this).attr('data-id');
    	confirm("Esta seguro de eliminar?");
	    	$.ajax({
	    		type:'DELETE',
	    		url:'/usuarios/'+id,
	    		success: function(data, msg){
	    			$('#exito').delay(500).fadeIn('slow');
	    			//$('.user_id'+id).remove();

	    		},
	    		error:function(data){
	    			console.log('Error:', data);
	    		}
	    	})
    	
    });
    $('#cambiarEstado').on('show.bs.modal', function (event) {
        
        //console.log('modal abierto');
        
        var button = $(event.relatedTarget) 
        var id = button.data('id')
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        
        modal.find('.modal-body #id').val(id);
        })
	
});
</script>
@endsection