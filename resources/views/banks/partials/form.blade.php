<div class="form-group col-md-4">
	<input type="text" name="titular" class="form-control" id="titular" value="" placeholder="Titular de Banco" required>
    <small id="nameHelp" class="form-text text-muted">Titular del Banco</small>
</div>
<div class="form-group col-md-4">
	<select class="form-control" name="banco" id="banco">
		<option>Bancos</option>
		<option value="BANESCO">BANESCO</option>
		<option value="BDV">BANCO DE VENEZUELA</option>
		<option value="BICENTENARIO">BICENTENARIO</option>
		<option value="PROVINCIAL">PROVINCIAL</option>
		<option value="MERCANTIL">MERCANTIL</option>
		<option value="BOD">BOD</option>
		<option value="BANCARIBE">BANCARIBE</option>
		<option value="BNC">BNC</option>
		<option value="BFC">BFC</option>
		<option value="VENEZOLANO">VENEZOLANO DE CREDITO</option>
		<option value="CARONI">CARONI</option>
		<option value="BANCO">100% BANCO</option>
	</select>
    <small id="nameHelp" class="form-text text-muted">Bancos</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="number" class="form-control" id="number" value="" placeholder="Numero de cuenta" required="">
    <small id="nameHelp" class="form-text text-muted">Numero de cuenta</small>
</div>
<hr />
<div class="form-group col-md-12">
	<button type="submit" class="btn btn-sm btn-primary pull-right">Registrar</button>
	
	<a class="btn btn-danger btn-sm" onclick="javascript:history.back();"><i class=""></i>Cancelar</a>
</div>