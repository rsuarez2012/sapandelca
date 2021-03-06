@extends('layouts.app')
@section('content')
<form action="{{route('productos.update', $product->id)}}" class="row" method="POST">
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <input type="hidden" id="id" name="id" value="{{$product->id}}">
<div class="form-group col-md-4">
	<input type="text" name="cod" class="form-control" id="cod" value="{{$product->cod}}" placeholder="Codigo del Producto"  pattern="[0-9]{0,15}">
    <small id="nameHelp" class="form-text text-muted">Codigo</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="product" class="form-control" id="product" value="{{$product->product}}" placeholder="Nombre del Producto" >
    <small id="nameHelp" class="form-text text-muted">Producto</small>
</div>
<div class="form-group col-md-4 pull-right">
	<input type="number" name="cost" class="form-control" id="cost" value="{{$product->buy}}" placeholder="Precio del Producto" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
    <small id="nameHelp" class="form-text text-muted">Precio</small>
</div>


<div class="form-group col-md-4">
		<select class="form-control" name="presentation" id="presentation">
			<option selected="" disabled="">Presentacion</option>
			<option value="1" {{ $product->presentation == 1 ? 'selected' : '' }}>Paquetes</option>
			<option value="2" {{ $product->presentation == 2 ? 'selected' : '' }}>Unidades</option>
		</select>
	    <small id="nameHelp" class="form-text text-muted">Presentacion del Producto</small>
	</div>
<div class="form-group col-md-4" id="packages">
		<input type="number" name="package" class="form-control" id="package" value="{{$product->package}}">
	    <small id="nameHelp" class="form-text text-muted">Paquetes</small>
	</div>
<div class="form-group col-md-4 pull-right">
		<select class="form-control" name="exent_iva" id="exent_iva">
			<option selected="" disabled="">Excento</option>
			<option value="0">NO</option>
			<option value="1">SI</option>
		</select>
	    <small id="nameHelp" class="form-text text-muted">Exento de Iva</small>
	</div>
<input type="hidden" name="buy" id="buy" value="{{$product->buy}}">
<input type="hidden" name="iv" id="iv" value="{{$product->iva}}">
<input type="hidden" name="stock" value="{{$product->stock}}">
<hr />
<div class="form-group col-md-12">
	<button type="button" class="btn btn-default" >Cancelar</button>
	<button type="submit" class="btn btn-primary pull-right" id="agregar">Editar</button>
</div>
</form>
@section('scripts')
<script type="text/javascript">
	$(document).ready(function() {

		var iva = 16;
		$("#presentation").on('change', function(){
        	var presentation = $(this).val();
        	//alert(presentation);
        	
	         if(presentation != 1){

	           $("#packages").hide();

	         }else{
	              
	           $("#packages").show();
	         }
     
    	});
    	$('#exent_iva').on('change', function () {
    		var excent = $(this).val();
    		if(excent != 1){
    			precio = $('#cost').val();
    			bi = precio - precio*iva/100;
    			iv = precio*iva/100;
    			$('#buy').val(bi);
    			$('#iv').val(iv);
    			console.log(iv);
    			console.log(bi);
    		}else{
    			precio = $('#cost').val();
    			bi = precio;
    			$('#buy').val(bi);
    		}
    	});

	});
</script>
@endsection
@endsection