@extends('layouts.app')
@section('content')
<style type="text/css">
    th, td{
        text-align: center;
    }
</style>

<div class="container">
    <div class="panel panel-info">
      <div class="panel-heading col-sm-12">
            <div class="col-sm-8">
                
                <h3>Departamento: {{ strtoupper($departament->departament) }}</h3>
            </div>
            <button type="button" class="btn btn-round btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg">Asignar Material</button>
      </div>
            <table>
                <tr>
                    <h4 colspan="4"  class="alert-success" style="text-align: center;">Datos de Entrada</h4>
                </tr>
                <tr>                    
                    <table class="table">
                        <thead>
                            
                            <tr>
                                <th>PRODUCTO</th>
                                <th>MATERIA PRIMA</th>
                                <th>CANTIDAD</th> 
                                <th>PRESENTACIÓN</th>
                                <th>FECHA DE ENTREGA</th>
                                <th>ENTREGADO POR</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($details as $detail[0])
                            <tr>
                                <td>
                                     @if(isset($detail[0]->product->product))
                                        {{ $detail[0]->product->product }}
                                    @endif
                                    {{-- $chofer->location->nombre --}}
                                </td>
                                <td>{{ $detail[0]->warehouse->nombre_producto }}</td>
                                <td>{{ $detail[0]->quantity }}</td>
                                <td>{{ $detail[0]->warehouse->presentacion_nombre }}</td>
                                <td>{{ Carbon\Carbon::parse($detail[0]->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $detail[0]->user->user }}</td>
                            </tr>       
                            @endforeach
                        </tbody>
                    </table>
                </tr>
                <tr>
                    <h4 colspan="5" class="alert-danger" style="text-align: center;">Datos de Salida</h4> 
                </tr>
                <tr>
                    <table class="table">
                            <thead>
                                <th>PRODUCTOS</th>
                                <th>CANTIDAD</th> 
                                <th>PRESENTACIÓN</th>
                                <th>PAQUETE</th>
                                <th>FECHA PRODUCCION</th>
                                <th>ACCIONES</th>
                            </thead>
                            <tbody>
                                @foreach($productions as $production)
                                <tr>
                                    <td align="center">{{ $production->product->product }}</td>
                                    <td align="center">{{ $production->quantity_in }}</td>
                                    <td align="center">{{ $production->product->presentation_type }}</td>
                                    <td align="center">{{  is_null($production->product->package)?'-': $production->product->package }}</td>
                                    <td align="center">{{ Carbon\Carbon::parse($production->production_date)->format('d-m-Y') }}</td>
                                    <td>
                                        @if($production->status == '1')
                                            <button type="button" class="btn btn-round btn-warning btn-sm changeStatus" data-id="{{ $production->id }}"data-toggle="modal" data-target=".bs-example-modal-lg-change" title="Anular"><i class="fa fa-remove"></i> </button>
                                        @else
                                            <button type="button" class="btn btn-round btn-danger btn-sm" disabled title="Anulado"><i class="fa fa-minus-square"></i> </button>
                                        @endif
                                        <a href="{{ route('perdida_produccion', $production->id) }}" type="button" class="btn btn-round btn-info btn-sm" id="" title="Producción"><i class="fa fa-cubes"></i></a>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>                        
                        </table>                    
                </tr>
            </table>
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
                          <h4 class="modal-title" id="myModalLabel">Asignación de Material</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{Route('assigment', 'test')}}" class="row" method="POST">
                                {!! csrf_field() !!}
                                <input type="hidden" id='departament_id' name="departament_id" value="{{ $departament->id }}">
                                <input type="hidden" id='user_id' name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" id='product_id' name="product_id" value="">
                                <input type="hidden" id='rest' name="rest" value="">
                                @include('departaments.partials.endowment')
                            </form>
                        </div>
                        
                        

                      </div>
                    </div>
                  </div>
</div>

<div class="x_content">

                  <!-- modals -->
                  <!-- Large modal -->
                  

                  <div class="modal fade bs-example-modal-lg-change" id="change_status" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Anular Produccion</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{Route('cambiar_estatus', 'test')}}" class="row" method="POST">
                                {{ csrf_field() }}
                                
                                <input type="hidden" id='production_id' name="production_id" value="">
                                
                                <h3>Esta seguro que quiere anular esta producción?</h3>
                                <div class="form-group col-md-12">
                                    <input type="mediumText" name="observation" class="form-control" id="observation" value="" placeholder="Motivo de anulación">
                                    <small id="nameHelp" class="form-text text-muted">Motivo</small>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary pull-right">Anular</button>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        

                      </div>
                    </div>
                  </div>
</div>
@section('scripts')
<script type="text/javascript">
        //var inStock = $('#cantidad').val(cantidad2[1]);
        //var outStock = $('#quantity').val();
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
    $('.warehouse').click(function() {
        // Act on the event 
        /*var product = $(this).val();
        var separador = "_";  
        stock = product.split(separador); 
        product_id = product.split(separador);

        console.log(product_id[0]);
        console.log(stock[1]);*/

        $('#product_id').val(product_id[0]);
        $('#cantidad').val(stock[1]);

        //var inStock = $('#cantidad').val(cantidad2[1]);
        //var outStock = $('#quantity').val();
    });
    $("#products").on('change', function(){
        var valores = $(this).val(); //se evalua los parametros pasados por el value "{{--$product->id--}}_{{--$product->cantidad--}}"       
        //var geographical_area = $('select[id=products]').val(); //se evalua los parametros pasados por el value "{{--$product->id--}}_{{--$product->cantidad--}}"
        //var name = $('#products option:selected').text();//este evalua solo el text
        //  
        //console.log(val)
        //console.log(geographical_area)
        //console.log(order_type);
        //console.log(valores);
        var separador = "_";  
        stock = valores.split(separador); 
        product_id = valores.split(separador);
        //$('#cantidad').val(stock[1]);
        console.log(product_id[0]);

    });
    $('#agregar').click(function() {

        var quantity = $('#quantity').val();
        var stock2 = $('#cantidad').val();
        var result = parseInt(stock2) - parseInt(quantity);
        if(parseInt(quantity)>=parseInt(stock2)){
            alert("La cantidad es mayor a la existencia en almacen.!");
        }
        else{
            console.log("puede agregar");
        }

        console.log(result);
        $('#rest').val(result);
        $('#product_id').val(product_id[0]);


    });
    $('.changeStatus').on('click', function() {
        
        var id = $(this).attr('data-id');
        
        $('#production_id').val(id);
    });

 });
</script>
@endsection
@endsection