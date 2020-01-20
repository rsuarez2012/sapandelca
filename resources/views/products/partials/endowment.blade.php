<div class="form-group col-md-4">
	<select name="products" class="form-control warehouse" id="products" data-live-search="true">
		<option value="0" selected>Seleccione el producto</option>
		@foreach($products as $product)
			<option value="{{ $product->id }}_{{$product->cantidad_entrada}}">{{ $product->nombre_producto }}</option>
		@endforeach
	</select>
    <small id="nameHelp" class="form-text text-muted">Productos</small>
</div>
<div class="form-group col-md-4">
	<input type="number" disabled id="cantidad" name="cantidad" class="form-control" placeholder="" pattern="[0-9]{0,15}">
	<!--<input type="text" name="departament" class="form-control" id="departament" value="" placeholder="Stock">-->
    <small id="nameHelp" class="form-text text-muted">Cantidad en Almacen</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="quantity" class="form-control" id="quantity" value="" placeholder="Cantidad">
    <small id="nameHelp" class="form-text text-muted">Cantidad a asignar</small>
</div>
<!--<button type="button" id="agregar" class="btn btn-primary"><i class="fa fa-plus fa-2x"></i> Agregar detalle</button>-->

<hr />
<div class="form-group col-md-12">
	<div class="modal-footer">
		
		<!--<a class="btn btn-danger btn-sm" onclick="javascript:history.back();"><i class=""></i>Cancelar</a>-->

		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary pull-right" id="agregar">Registrar</button>
	    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
	</div>
</div>