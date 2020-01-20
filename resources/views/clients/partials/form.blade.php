<div class="form-group col-md-4">
	<input type="text" name="first_name" class="form-control" id="first_name" value="" placeholder="Nombre del Cliente" required>
    <small id="nameHelp" class="form-text text-muted">Nombres</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="last_name" class="form-control" id="last_name" value="" placeholder="Apellido del Cliente" required="">
    <small id="nameHelp" class="form-text text-muted">Apellidos</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="dni" class="form-control" id="dni" value="" placeholder="Cedula del Cliente">
    <small id="nameHelp" class="form-text text-muted">Cedula</small>
</div>
<div class="form-group col-md-4">
	<select class="form-control" name="client_type" id="client_type">
		<option>Tipo de Cliente</option>
		<option value="1">Persona Natural</option>
		<option value="2">Persona Juridica</option>
	</select>
    <small id="nameHelp" class="form-text text-muted">Tipo de Cliente</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="telephone" class="form-control" id="telephone" value="" placeholder="Telefono del Cliente">
    <small id="nameHelp" class="form-text text-muted">Telefono</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="address" class="form-control" id="address" value="" placeholder="Dirección del Cliente">
    <small id="nameHelp" class="form-text text-muted">Dirección</small>
</div>
<hr />
<div class="form-group col-md-12">
	<button type="submit" class="btn btn-sm btn-primary pull-right">Registrar</button>
	
	<a class="btn btn-danger btn-sm" onclick="javascript:history.back();"><i class=""></i>Cancelar</a>
</div>