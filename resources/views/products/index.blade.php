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
                	<button type="button" class="btn btn-round btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg" title="Registrar Producto"><i class="fa fa-file-o"></i></button>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                	
            		<table class="table">
						<thead>
							<tr>
								<th style="text-align: center;">Id</th>
                <th style="text-align: center;">Codigo</th>
								<th style="text-align: center;">Nombre Producto</th>
                <th style="text-align: center;">Precio Bs.</th>
                <th style="text-align: center;">Stock</th>
								<th style="text-align: center;">Acciones</th>
                <th></th>
							</tr>
						</thead>
						<tbody>
						@php $id = 1; @endphp	
						@foreach($products as $product)
							<tr class="product_id{{ $product->id }}">
                <td align="center">{{ $id++ }}</td>
								<td align="center">{{ $product->cod }}</td>
								<td align="center">{{ $product->product }}</td> 
                <td align="center">{{ ($product->buy+$product->iva) }}</td>
                <td align="center">
                  @if($product->stock <= '20')
                    <span class="badge bg-red">
                      {{ $product->stock }}
                    </span>
                  @else
                    <span class="badge bg-green">
                      {{ $product->stock }}
                    </span>
                  @endif
                </td>
								<td align="center">
                  <a href="{{ route('productos.show', $product->id)}}" class="btn btn-round btn-info btn-sm" title="Ver Producto"><i class="fa fa-eye"></i> </a>

                  @if(auth()->user()->rol_id === 1)						
                  <a href="{{ route('productos.edit', $product->id) }}" class="btn btn-round btn-success btn-sm" id="prueba" title="Ver Producto"><i class="fa fa-edit"></i> </a>
                  @endif
                </td>
                <td>
                  @if(auth()->user()->rol_id === 1)           
  									{{--<button type="button" class="btn btn-round btn-success btn-sm" id="edit-modal"  data-toggle="modal" data-target="#editDepartament"  data-id="{{ $product->id }}" title="Editar Producto"><i class="fa fa-edit"></i> </button>--}}
                    @include('products.partials.delete')
                    {{--<a href="{{ route('eliminar_producto', $product->id)}}" class="btn btn-round btn-danger btn-sm delete-product"  title="Eliminar Producto"><i class="fa fa-trash-o"></i> </a>--}}


  									{{--<button type="button" class="btn btn-round btn-danger btn-sm delete-product" id="delete-product" data-id="{{ $product->id }}" title="Eliminar Producto"><i class="fa fa-trash-o"></i>&nbsp; </button>--}}
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
          <h4 class="modal-title" id="myModalLabel">Registrar Producto</h4>
        </div>
        <div class="modal-body">
            <form action="{{Route('productos.store')}}" class="row" method="POST">
            	{!! csrf_field() !!}
                <!--<input type="hidden" id='people_id' name="people_id" value="{{-- $person->id --}}">-->
                @include('products.partials.form')
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
          <h4 class="modal-title" id="myModalLabel">Editar Producto</h4>
        </div>
        <div class="modal-body">

            {{--{!! Form::open(['route' => ['beneficiarios.store'], 'files' => true]) !!}--}}
            <form action="{{Route('productos.update', 'test')}}" class="row" method="POST">
            	{{ csrf_field() }}
            	{{ method_field('patch') }}
                <input type="hidden" id="id" name="id" value="">
                @include('products.partials.form')
			</form>
        </div>
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    console.log("hola");
  });
</script>
@endsection
@endsection
@section('scripts')
{{--<script type="text/javascript">
//alert("hola");
$(document).ready(function(){
  /*var protocol = $(location).attr('protocol');
    var url = $(location).attr('host');
    var full_url = protocol + '//' + url;
    /*** allow ajax requests  ***/
    /*$.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });*/
    $('.edit-modal').on('click', function() {
      //alert("Hola");
      //var id = e.target.value;
      //var id = $(this).data('id');
      alert(id);
      var id = $(this).attr('data-id');
      console.log(id);

      $.ajax({
        type:'GET',
        //data:{id:id},
        url:'/productos/'+id+'/edit',
        dataType: 'json',

        success:function(data){
          console.log(data);
          $('#editDepartament').modal('show');
          $(".modal-title").html("Editar Departamento");
          $('.modal-body #id').val(id);
          $('.modal-body #product').val(data.product);
          $('.modal-body #cod').val(data.cod);
        },
      })

    });

    $('.delete-product').on('click', function(){
      
      var id = $(this).attr('data-id');
      confirm("Esta seguro de eliminar?");
        $.ajax({
          type:'DELETE',
          url:'/productos/'+id,
          success: function(data, msg){
            $('#exito').delay(500).fadeIn('slow');
            $('.product_id'+id).remove();

          },
          error:function(data){
            console.log('Error:', data);
          }
        })
      
    });

  
});
</script>--}}
<script type="text/javascript">
alert("hola");
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
    $('#prueba').click(function() {
      alert("hola");
    })
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

    $('#delete-product').on('click', function(){
      
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