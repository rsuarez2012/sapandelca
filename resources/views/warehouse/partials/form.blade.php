<div class="form-group col-md-4">
	<input type="text" name="nombre_producto" class="form-control" id="nombre_producto" value="">
    <small id="nameHelp" class="form-text text-muted">Nombre del Producto</small>
</div>
<div class="form-group col-md-4">
	<select class="form-control" name="presentacion" id="presentacion">
		<option>Presentacion</option>
		<option value="1">Kgrs</option>
		<option value="2">Mls</option>
		<option value="3">Unds</option>
	</select>
    <small id="nameHelp" class="form-text text-muted">Presentacion del Producto</small>
</div>
<div class="form-group col-md-4">
	<input type="number" name="cantidad_entrada" class="form-control" id="entrada">
    <small id="nameHelp" class="form-text text-muted">Entrada</small>
</div>
<div class="form-group col-md-6">
	<input type="text" name="responsable" class="form-control" id="responsable">
    <small id="nameHelp" class="form-text text-muted">Responsable</small>
</div>
<hr />
<div class="form-group col-md-12">
	<button type="submit" class="btn btn-sm btn-primary pull-right">Registrar</button>
	
	<a class="btn btn-danger btn-sm" onclick="javascript:history.back();"><i class=""></i>Cancelar</a>
</div>