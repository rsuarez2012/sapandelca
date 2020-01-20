@extends('layouts.app')

@section('content')
<form action="{{Route('produccion_guardar')}}" class="row" method="POST">
	{{ csrf_field() }}
	<input type="hidden" name="departament_id" id="departament_id" value="{{ $production->id }}">
	<div class="form-group col-md-6">
		<select class="form-control" name="product_id" id="product_id">
			<option selected="" disabled>Productos</option>
			@foreach($products as $product)
				<option value="{{ $product->id }}">{{ $product->cod.'-'.$product->product }}</option>
			@endforeach
		</select>
	    <small id="nameHelp" class="form-text text-muted">Nombre del Producto</small>
	</div>
	
	<div class="form-group col-md-6">
		<input type="number" name="quantity_in" class="form-control" id="quantity_in">
	    <small id="nameHelp" class="form-text text-muted">Cantidad Producto</small>
	</div>
	<div class="form-group col-md-6">
		<input type="date" name="production_date" class="form-control" id="production_date">
	    <small id="nameHelp" class="form-text text-muted">Fecha Produccion</small>
	</div>	


	
	<div class="form-group col-md-6 pull-right">
		<input type="number" name="lost" class="form-control" id="lost">
	    <small id="nameHelp" class="form-text text-muted">Perdida</small>
	</div>
	<div class="form-group col-md-12">
		<input type="text" name="observation" class="form-control" id="observation">
	    <small id="nameHelp" class="form-text text-muted">Observacions</small>
	</div>
	
	<div class="form-group col-md-12">
		<button type="submit" class="btn btn-sm btn-primary pull-right">Registrar</button>
		
		<a class="btn btn-danger btn-sm" onclick="javascript:history.back();"><i class=""></i>Cancelar</a>
	</div>
</form>

@endsection