<div class="form-group col-md-4">
	<select class="form-control" name="sale_id" id="sale_id" required>
		<option>Factura</option>
		@foreach($sales as $sale)
		<option value="{{$sale->id}}">{{ $sale->num_fac.' '.str_pad($sale->num_fac, 7, '0', STR_PAD_LEFT) }}</option>
		@endforeach
	</select>
    <small id="nameHelp" class="form-text text-muted">Factura</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="num_fac" class="form-control" id="num_fac" value="" placeholder="Numero de Factura" required="">
    <small id="nameHelp" class="form-text text-muted">Numero de factura.</small>
</div>
<div class="form-group col-md-4">
	<input type="text" name="total" class="form-control" id="total" value="" placeholder="Total de la venta" required="">
    <small id="nameHelp" class="form-text text-muted">Total de la factura.</small>
</div>
<hr />
<div class="form-group col-md-12">
	<button type="submit" class="btn btn-sm btn-primary pull-right">Registrar</button>
	
	<a class="btn btn-danger btn-sm" onclick="javascript:history.back();"><i class=""></i>Cancelar</a>
</div>