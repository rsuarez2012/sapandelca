<div class="form-group col-md-4">
	<input type="text" name="first_name" class="form-control" id="first_name" value="" placeholder="Nombre del Usuario" required>
    <small id="nameHelp" class="form-text text-muted">Nombres</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="last_name" class="form-control" id="last_name" value="" placeholder="Apellido del Usuario" required="">
    <small id="nameHelp" class="form-text text-muted">Apellidos</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="dni" class="form-control" id="dni" value="" placeholder="Cedula del Usuario">
    <small id="nameHelp" class="form-text text-muted">Cedula</small>
</div>
<div class="form-group col-md-4">
	<input type="email" name="email" class="form-control" id="email" value="" placeholder="Email del Usuario">
    <small id="nameHelp" class="form-text text-muted">Email</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="user" class="form-control" id="user" value="" placeholder="Usuario" autocomplete="off">
    <small id="nameHelp" class="form-text text-muted">Usuario</small>
</div>
<div class="form-group col-md-4">
	<input type="password" name="password" class="form-control" id="password" value="" placeholder="Clave del Usuario" autocomplete="off">
    <small id="nameHelp" class="form-text text-muted">Clave</small>
</div>
<div class="form-group col-md-4">
	<select class="form-control" name="rol_id" id="rol_id">
		<option>Rol del Usuario</option>
		@foreach($roles as $rol)
			<option value="{{ $rol->id }}">{{ $rol->name }}</option>
		@endforeach()
	</select>
    <small id="nameHelp" class="form-text text-muted">Rol de Usuario</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="telephone" class="form-control" id="telephone" value="" placeholder="Telefono del Usuario">
    <small id="nameHelp" class="form-text text-muted">Telefono Local</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="cellphone" class="form-control" id="cellphone" value="" placeholder="Celular del Usuario">
    <small id="nameHelp" class="form-text text-muted">Telefono Celular</small>
</div>
<div class="form-group col-md-12">
	<input type="text" name="address" class="form-control" id="address" value="" placeholder="Dirección del Usuario">
    <small id="nameHelp" class="form-text text-muted">Dirección</small>
</div>
<hr />
<div class="form-group col-md-12">
	<button type="submit" class="btn btn-sm btn-primary pull-right">Registrar</button>
	
	<a class="btn btn-danger btn-sm" onclick="javascript:history.back();"><i class=""></i>Cancelar</a>
</div>