@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		
		<div class="col-md-12 col-md-offset-0">
			
			<div id="exito" class="alert alert-success" style="display: none;">
				<i class="fa fa-check"></i>Producto eliminado con exito!.

			</div>
            <div class="panel panel-default">
            	

                <div class="panel-heading">
                	@php $path = explode('/',Request::path()) @endphp 
                	<b class="sub-header">{{ strtoupper(title_case($path[0])) }}</b>
                	<button type="button" class="btn btn-round btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg" title="Registrar Suministro"><i class="fa fa-file-o"></i> </button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                	
            		<table class="table">
						<thead>
							<tr>
								<th style="text-align: center;">Id</th>
								<th style="text-align: center;">Producto</th>
								<th style="text-align: center;">Stock</th>
								<th style="text-align: center;">Presentacion</th>
                                <th style="text-align: center;">Entrada</th>
								<!--<th style="text-align: center;">Actualización</th>-->
								<th style="text-align: center;">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@php $id = 1; @endphp	
						@foreach($products as $product)					
							<tr class="product_id{{ $product->id }}"">
								<td align="center">{{ $id++ }}</td>
								<td align="center">{{ $product->nombre_producto }}</td>
                                <td align="center">{{ $product->cantidad_entrada }}</td>
								<td align="center">{{ $product->presentacion_nombre }}</td>
                                <td>{{ Carbon\Carbon::parse($product->created_at)->format('d/m/Y') }}</td>
								<!--<td>{{-- Carbon\Carbon::parse($product->updated_at)->format('d/m/Y') --}}</td>-->
								{{--<td align="center">
									@if(empty($product->cantidad_restante))
										{{ "No Hay Salida" }}
									@else
										{{ $product->cantidad_restante }}
									@endif
								</td>--}}
								<td>
									<a href="{{ route('almacen.show', $product->id) }}" class="btn btn-round btn-info btn-sm" title="Ver"><i class="fa fa-eye"></i> </a>
									<!--<a href="{{-- route('almacen.edit', $product->id) --}}" class="btn btn-success btn-sm">Editar</a>-->
									{{--<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg-editar" data-id="{{ $product->id }}" data-nombre_producto="{{ $product->nombre_producto }}" data-presentacion="{{ $product->presentacion}}" data-entrada="{{ $product->cantidad }}" data-fecha_registro="{{ $product->fecha_registro }}" data-responsable="{{ $product->responsable }}">Editar</button>--}}
									
									<!--<input type="button" id="bt" value="{{-- $product->id --}}" />-->
									<button type="button" class="btn btn-round btn-success btn-sm edit-modal" data-toggle="modal"  data-id="{{ $product->id }}" title="Editar"><i class="fa fa-edit"></i> </button>




									<button type="button" class="btn btn-round btn-danger btn-sm delete-product" id="delete-product" data-id="{{ $product->id }}" title="Eliminar"><i class="fa fa-trash-o"></i> </button>
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
                          <h4 class="modal-title" id="myModalLabel">Registrar en Almacen</h4>
                        </div>
                        <div class="modal-body">

                            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
                            <form action="{{Route('almacen.store')}}" class="row" method="POST">
                            	{!! csrf_field() !!}
                                <!--<input type="hidden" id='people_id' name="people_id" value="{{-- $person->id --}}">-->
                                @include('warehouse.partials.form')
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
                  

                  <div class="modal fade" id="editProduct"  role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">

                            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
                            <form action="{{Route('almacen.update', 'test')}}" class="row" method="POST">
                            	{!! csrf_field() !!}
                            	{{ method_field('patch') }}
                                <input type="hidden" id='id' name="id" value="">
                                @include('warehouse.partials.form')
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
    	/*$.get('/almacen/'+id+'/edit', function(data){
    		 	console.log(data);
	         	//alert(data.nombre_producto);
	         	$('.modal-body #id').val(data.id);
    		 	$('.bs-example-modal-lg-editar').modal();
	         	$('#nombre_producto').val(data.nombre_producto);


    	});*/
    	$.ajax({
    		type:'GET',
    		//data:{id:id},
    		url:'/almacen/'+id+'/edit',
    		dataType: 'json',

    		success:function(data){
    			console.log(data.nombre_producto);
    			$('#editProduct').modal('show');
	    		$(".modal-title").html("Editar Producto");
	    		$('.modal-body #id').val(id);
	    		$('.modal-body #nombre_producto').val(data.nombre_producto);
	    		$('.modal-body #presentacion').val(data.presentacion);
	    		$('.modal-body #entrada').val(data.cantidad_entrada);
	    		$('.modal-body #responsable').val(data.responsable);
    		},
    	})
    	/*.done(function(data){
    		//console.log(data.nombre_producto);
    		$('#editProduct').modal('show');
    		$(".modal-title").html("Editar Producto");
    		$('#id').val(id); 
    		$('#nombre_producto').val(data.nombre_producto);
    	})*/

    });

    $('.delete-product').on('click', function(){
    	
    	var id = $(this).attr('data-id');
    	confirm("Esta seguro de eliminar?");
	    	$.ajax({
	    		type:'DELETE',
	    		url:'/almacen/'+id,
	    		success: function(data, msg){
	    			//$('.product_id' + id).remove();
	    			//$('.alert .alert-success').append('Registro eliminado con exito.!');
	    			$('#exito').delay(500).fadeIn('slow');
	    			$('.product_id'+id).remove();

	    			//location.reload(true);
	    		},
	    		error:function(data){
	    			console.log('Error:', data);
	    		}
	    	})
    	
    });

	
});
</script>
@endsection