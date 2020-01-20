<div class="form-group col-md-4">
	<select class="form-control" name="payment_type" id="payment_type" required>
		<option value="" selected disabled>Forma Pago</option>
        <option value="1">TARJETA DEBITO</option>
        <option value="2">EFECTIVO</option>
        <option value="3">TDC</option>
        <option value="4">TRANSFERENCIA</option>
        <option value="5">PAGO MOVIL</option>
        <option value="6">MONEDA EXTRANJERA ($)</option>
	</select>
    <small id="nameHelp" class="form-text text-muted">Forma de pago.</small>
</div>

<div class="form-group col-md-4">
	<select class="form-control" name="bank" id="bank" required>
		<option value="" selected disabled>Banco</option>
		<option value="Banesco">Banesco</option>
		<option value="BDV">Banco de Venezuela</option>
		<option value="Bicentenario">Banco Bicentenario</option>
		<option value="Mercantil">Banco Mercantil</option>
		<option value="BNC">Banco Nacional de Credito</option>
		<option value="Venezolano">Venezolano de Credito</option>
		<option value="Provincial">Banco Provincial</option>
		<option value="BFC">Banco Fondo Común</option>
		<option value="Caribe">Bancaribe</option>
		<option value="Caroni">Banco Caroni</option>
		<option value="Otro">Otro</option>
	</select>
    <small id="nameHelp" class="form-text text-muted">Banco donde emite el pago.</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="tot" class="form-control" id="tot" value="{{ $las->subtraction }}" placeholder="Cuenta por Cobrar" disabled>
    <small id="nameHelp" class="form-text text-muted">Cuenta por Cobrar.</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="rode" class="form-control" id="rode" value="" placeholder="Monto del pago" required="">
    <small id="nameHelp" class="form-text text-muted">Monto del pago.</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="reference" class="form-control" id="reference" value="" placeholder="Referencia" required="">
    <small id="nameHelp" class="form-text text-muted">Numero de referencia.</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="subtraction" class="form-control" id="subtraction" value="" placeholder="Resta" disabled="">
    <small id="nameHelp" class="form-text text-muted">Total a pagar del credito.</small>
</div>
<hr />
<div class="form-group col-md-12">
	<button type="submit" class="btn btn-sm btn-primary pull-right">Registrar</button>
	
	<a class="btn btn-danger btn-sm" onclick="javascript:history.back();"><i class=""></i>Cancelar</a>
</div>