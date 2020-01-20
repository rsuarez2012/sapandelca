@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		
		<div class="col-md-12 col-md-offset-0">
			
			<div id="exito" class="alert alert-success" style="display: none;">
				<i class="fa fa-check"></i>departamento eliminado con exito!.

			</div>
            <div class="panel panel-default">
            	

                <div class="panel-heading">
                	@php $path = explode('/',Request::path()) @endphp 
                	<b class="sub-header">{{-- strtoupper(title_case($path[0])) --}}</b>
                	<button type="button" class="btn btn-round btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg" title="Registrar Departamento"><i class="fa fa-file-o"></i> </button>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                	
            		<table class="table">
						<thead>
							<tr>
								<th style="text-align: center;">Id</th>
								<th style="text-align: center;">Departamento</th>
								<th style="text-align: center;">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@php $id = 1; @endphp	
						@foreach($departaments as $departament)					
							<tr class="departament_id{{ $departament->id }}">
								<td align="center">{{ $id++ }}</td>
								<td align="center">{{ $departament->departament }}</td> 
								
								
								<td align="center">
                                    <a href="{{ route('departamentos.show', $departament->id)}}" class="btn btn-round btn-info btn-sm" title="Ver"><i class="fa fa-eye"></i> </a>

									<button type="button" class="btn btn-round btn-success btn-sm edit-modal" data-toggle="modal"  data-id="{{ $departament->id }}"><i class="fa fa-edit"></i></button>

									<button type="button" class="btn btn-danger btn-round btn-sm delete-departament" id="delete-departament" data-id="{{ $departament->id }}" title="Eliminar Departamento"><i class="fa fa-trash-o"></i> </button>
                                    @if($departament->id != 1)

                                    @else
                                        <a href="{{ route('produccion', $departament->id) }}" type="button" class="btn btn-round btn-warning btn-sm" id="" title="Producción"><i class="fa fa-cubes"></i></a>
                                        <a href="{{ route('perdida', $departament->id) }}" type="button" class="btn btn-round btn-danger btn-sm" id="" title="Ver Perdida"><i class="fa fa-cubes"></i></a>
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
          <h4 class="modal-title" id="myModalLabel">Registrar Departamento</h4>
        </div>
        <div class="modal-body">

            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
            <form action="{{Route('departamentos.store')}}" class="row" method="POST">
            	{!! csrf_field() !!}
                <!--<input type="hidden" id='people_id' name="people_id" value="{{-- $person->id --}}">-->
                @include('departaments.partials.form')
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
  

  <div class="modal fade" id="editDepartament"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">prueba</h4>
        </div>
        <div class="modal-body">

            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
            <form action="{{Route('departamentos.update', 'test')}}" class="row" method="POST">
            	{{ csrf_field() }}
            	{{ method_field('patch') }}
                <input type="hidden" id='id' name="id" value="">
                @include('departaments.partials.form')
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
    $('.edit-modal').on('click', function() {
    	//var id = e.target.value;
    	//var id = $(this).data('id');
    	var id = $(this).attr('data-id');
    	console.log(id);

    	$.ajax({
    		type:'GET',
    		//data:{id:id},
    		url:'/departamentos/'+id+'/edit',
    		dataType: 'json',

    		success:function(data){
    			console.log(data);
    			$('#editDepartament').modal('show');
	    		$(".modal-title").html("Editar Departamento");
	    		$('.modal-body #id').val(id);
	    		$('.modal-body #departament').val(data.departament);
	    		
    		},
    	})

    });

    $('.delete-departament').on('click', function(){
    	
    	var id = $(this).attr('data-id');
    	confirm("Esta seguro de eliminar?");
	    	$.ajax({
	    		type:'DELETE',
	    		url:'/departamentos/'+id,
	    		success: function(data, msg){
	    			$('#exito').delay(500).fadeIn('slow');
	    			$('.departament_id'+id).remove();

	    		},
	    		error:function(data){
	    			console.log('Error:', data);
	    		}
	    	})
    	
    });

	
});
</script>
@endsection