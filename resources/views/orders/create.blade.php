@extends('layouts.app')

@section('content')
<div class="container">
    <div class="x_content">
        <form action="{{ route('pedidos.store') }}" class="row" method="POST">
            {{csrf_field()}}
            <section class="content invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12 invoice-header">
                    <h1>
                        <i class="fa fa-inbox"></i> 
                            Nuevo Pedido.                        
                        <small class="pull-right">
                          
                          Facha: {{ Carbon\Carbon::now()->format('d/m/Y')}}
                          <br>
                          Hora: {{ Carbon\Carbon::now()->format('H:i')}}
                        </small>
                    </h1>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row clients-->
              <div class="row invoice-info col-md-12">
                <div class="row">
                    <div class="invoice-col">
                        <div class="form-group col-md-6">
                            <h4>Buscar Cliente</h4>
                            <input type="text" name="client" id="client" class="form-control" placeholder="Buscar Cliente" autocomplete="">
                            <input type="hidden" name="client_id" id="client_id">
                        </div>
                        <div class="form-group col-md-3">
                            <h4>Fecha de Entrega</h4>
                                <input type="date" class="form-control" name="date_delivery" id="date_delivery">
                              <br>
                        </div>
                        <div class="form-group col-md-3">
                                <br>
                                <br>
                              <b>Pedido # <input type="hidden" name="num_fac" id="num_fac" value="{{ !empty($orders->id) ? $orders->id: '0' }}">{{ str_pad (!empty($orders->id) ? $orders->id: '1', 7, '0', STR_PAD_LEFT) }}</b>
                              <br>
                        </div>       
                        <!-- /.col -->
                    </div>
                </div>
                <div class="row">
                    <div class="invoice-col">
                        <div class="form-group col-md-3">
                            <input type="text" name="cliente" id="cliente" disabled placeholder="Cliente" class="form-control" value="{{-- is_null($clients->first_name)? '':$clients->first_name.' '.$clients->last_name --}}">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" name="dni" id="dni" disabled placeholder="Cedula" class="form-control" value="{{-- $clients->dni --}}">
                        </div>
                    </div>
                </div>                           

              </div>
              <!-- /.row -->
              <!-- info row products-->
              <div class="row invoice-info col-md-12">
                <div class="invoice-col">
                        <h4>Buscar producto</h4>
                    <div class="form-group col-md-2">
                        <select class="form-control" id="selectPro">
                                <option selected>Codigo Producto</option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}_{{$product->product}}_{{$product->buy}}_{{$product->stock}}_{{$product->presentation_type.' '.$product->package}}_{{$product->exent_iva}}_{{$product->iva}}">{{ $product->cod}}</option>
                                
                            @endforeach
                        </select>
                        <input type="hidden" name="description" id="description" value="">
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" name="piva" id="piva">
                        
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="product" id="product" disabled placeholder="Producto" class="form-control" value="">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="stock" id="stock" disabled placeholder="Stock" class="form-control" value="">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="number"  disabled name="buy" id="buy" placeholder="Precio" class=" form-control col-md-2">                     
                    </div>     
                    <div class="form-group col-md-2">
                        <input type="text" name="quantity" id="quantity" class="form-control col-md-2" placeholder="Cantidad" autocomplete="off">
                        <input type="hidden" name="exent_iva" id="exent_iva">
                    </div>
                    <div class="form-group col-md-2">
                        <button type="button" id="add" class="btn btn-default"><i class="fa fa-plus"></i> Agregar detalle</button>
                    </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12">
                  <table class="table-striped" id="details" style="width: 100%; border: 1px;">
                    <thead>
                      <tr style=" background-color: #eee; font-size: 15px;">
                        <th style="text-align: center;">Codigo</th>
                        <th style="text-align: center;">Producto</th>
                        <th style="text-align: center;">Descripción</th>
                        <th style="text-align: center;">Cant.</th>
                        <th style="text-align: center;">Precio</th>
                        <th style="text-align: center;">Eliminar</th>
                        <!--<th style="text-align: center;  border-top-right-radius: 20px;">Total</th>-->
                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            <div class="clearfix"></div>
                <div class="row">
                    <div class="col-xs-4">
                        
                    </div>
                </div>
            <div class="clearfix"></div>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                        <p class="lead">Metodo de Pago:</p>
                            <select class="form-control" id="format_buy" name="format_buy">
                                <option value="" selected disabled>Forma Pago</option>
                                <option value="1">TARJETA DEBITO</option>
                                <option value="2">EFECTIVO</option>
                                <option value="3">TDC</option>
                                <option value="4">TRANSFERENCIA</option>
                                <option value="5">PAGO MOVIL</option>
                                <option value="6">MONEDA EXTRANJERA ($)</option>
                                <option value="7">DONACIONES</option>     
                            </select>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                  <p class="lead">Total a Cancelar</p>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th style="width:50%">SUBTOTAL:</th>
                          <td id="sub-total"></td>
                        </tr>
                        <tr>
                          <th>EXENTO (E):</th>
                          <td id="total_exento"></td>
                        </tr>
                        <tr>
                          <th>BI (G):</th>
                          <td id="base_impo"></td>
                        </tr>
                        <tr>
                          <th>I.V.A (16%):</th>
                          <td id="total_iva"></td>
                        </tr>
                        <tr>
                          <th>TOTAL:</th>
                          <td id="total_pagar"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.col -->

              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-xs-12" id="guardar">
                  <!--<button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>-->
                  <button type="submit" class="btn btn-success pull-right" ><i class="fa fa-credit-card"></i> Registrar Pedido</button>
                  <!--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                </div>
              </div>
            </section>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('js/jquery-ui-autocomplete.js') }}"></script>
<script type="text/javascript">
//alert("hola");
$(document).ready(function(){
    var protocol = $(location).attr('protocol');
    var url = $(location).attr('host');
    var full_url = protocol + '//' + url;
    iva = 16;
    exent = $('#exent_iva').val();
    /*** allow ajax requests  ***/
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('.edit-modal').on('click', function() {
        //var id = e.target.value;
        //var id = $(this).data('id');
        var id = $(this).attr('data-id');
        console.log(id);
        /*$.get('/almacen/'+id+'/edit', function(data){
                console.log(data);
                //alert(data.nombre_producto);
                $('.modal-body #id').val(data.id);
                $('.bs-example-modal-lg-editar').modal();
                $('#nombre_producto').val(data.nombre_producto);


        });*/
        $.ajax({
            type:'GET',
            //data:{id:id},
            url:'/almacen/'+id+'/edit',
            dataType: 'json',

            success:function(data){
                console.log(data.nombre_producto);
                $('#editProduct').modal('show');
                $(".modal-title").html("Editar Producto");
                $('.modal-body #id').val(id);
                $('.modal-body #nombre_producto').val(data.nombre_producto);
                $('.modal-body #presentacion').val(data.presentacion);
                $('.modal-body #entrada').val(data.cantidad_entrada);
                $('.modal-body #responsable').val(data.responsable);
            },
        })
        /*.done(function(data){
            //console.log(data.nombre_producto);
            $('#editProduct').modal('show');
            $(".modal-title").html("Editar Producto");
            $('#id').val(id); 
            $('#nombre_producto').val(data.nombre_producto);
        })*/

    });

    $('.delete-product').on('click', function(){
        
        var id = $(this).attr('data-id');
        confirm("Esta seguro de eliminar?");
            $.ajax({
                type:'DELETE',
                url:'/almacen/'+id,
                success: function(data, msg){
                    //$('.product_id' + id).remove();
                    //$('.alert .alert-success').append('Registro eliminado con exito.!');
                    $('#exito').delay(500).fadeIn('slow');
                    $('.product_id'+id).remove();

                    //location.reload(true);
                },
                error:function(data){
                    console.log('Error:', data);
                }
            })
        
    });

    $('#select2').select2();
      $('#selectPro').select2();
    $('#selectPro').on('change', function(){
        var val_product = $(this).val();
        console.log(val_product);
        var separador = "_";
        product = val_product.split(separador);
        //alert(product[1])
        //console.log(product[0]);
        
       
        //Aqui debe ir el valor del id del producto que falta
        $('#product_id').val(product[0]);
        $('#product').val(product[1]);
        $('#buy').val(product[2]);
        $('#stock').val(product[3]);
        $('#description').val(product[4]);
        $('#exent_iva').val(product[5]);
        //de prueba para el iva
        $('#piva').val(product[6]);
        console.log(product[6]);
    });
    $(".clients").on('change', function(){
        var valores = $(this).val(); 
        //alert(valores);
        var name = $('.clients option:selected').text();//este evalua solo el text
       
        var separador = "/";  
        id = valores.split(separador); 
        client_name = valores.split(separador);
        
         $('#dni').val(name);
         $('#client').val(client_name[1]);

    });
    
    $('#add').click(function(){
        add();
    });
    cont = 0;
    total = 0;
    subtotalIva = 0;
    totalEx = 0;
    totalBi = 0;
    //subToEx = 0;
    //subToBi = 0;
    //subtotal=[];
    //subtot=0;
    subToEx = [];
    subToBi = [];

    subtot=[];
    subtotiva=[];
    exent;
    //funcion de agregar elemento
    
    function add(){
        stock = $('#stock').val();
        product_id = $('#product_id').val();
        //product_id = $('#product_id').val();
        quantity = $('#quantity').val();
        buy = $('#buy').val();
        description = $('#description').val();
        cod = $('#selectPro option:selected').text();
        exent = $('#exent_iva').val();
        subtoiva = $('#piva').val();
        //ex =  if(exent!=0){"(G)"}else{"(E)"};
        console.log(stock +" " + product_id +" " +quantity+" "+buy);
        if(product_id !="" && quantity !="" && quantity>0){
            //if(parseInt(stock) >= parseInt(quantity)){
                    if(exent == 1){
                        subToEx[cont] = (quantity*buy);
                        totalEx = totalEx + subToEx[cont];
                        console.log(totalEx);
                        var fila= '<tr class="selected" id="fila'+cont+'" style="text-align:center;"><td id="exent" value="'+exent+'"><input type="hidden" id="exent_iva" name="exent_iva" value="'+exent+'">'+cod+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product[1]+'</td><td>'+description+'</td><td><input type="hidden" name="quantity_product[]" value="'+quantity+'" class="">'+ quantity +'</td><td><input type="number" name="buy[]" value="'+parseFloat(buy).toFixed(2)+'"> </td><td><button type="button" class="btn btn-round btn-default btn-sm" onclick="return eliminarFila('+cont+');"><i class="fa fa-trash fa-2x"></i></button></td></tr>';
                            //subtot[cont] = quantity * buy;
                            //<td>Bs.'+parseFloat(subtot[cont]).toFixed(2)+'</td>
                            //console.log("probando el sub iva: " + subtotalIva);
                            //subto[cont] = (quantity*buy)-(quantity*buy*iva/100);
                            cont++;
                            limpiar();
                            totales();
                            evaluar();
                            $('#details').append(fila);
                    }else{
                        subToBi[cont] = (quantity*buy);
                        totalBi = totalBi + subToBi[cont];
                        subtotiva[cont] = (quantity*subtoiva);
                        subtotalIva = subtotalIva + subtotiva[cont];
                        console.log(subtotalIva);
                        console.log(totalBi);
                        var fila= '<tr class="selected" id="fila'+cont+'" style="text-align:center;"><td id="exent" value="'+exent+'"><input type="hidden" id="exent_iva" name="exent_iva" value="'+exent+'">'+cod+'</td><td><input type="hidden" name="product_id[]" value="'+product_id+'">'+product[1]+'</td><td>'+description+'</td><td><input type="hidden" name="quantity_product[]" value="'+quantity+'" class="">'+ quantity +'</td><td><input type="number" name="buy[]" value="'+parseFloat(buy).toFixed(2)+'"> </td><td><button type="button" class="btn btn-round btn-default btn-sm" onclick="return eliminarFila('+cont+');"><i class="fa fa-trash fa-2x"></i></button></td></tr>';
                            //subtot[cont] = quantity * buy;
                            //<td>Bs.'+parseFloat(subtot[cont]).toFixed(2)+'</td>
                            //console.log("probando el sub iva: " + subtotalIva);
                            //subto[cont] = (quantity*buy)-(quantity*buy*iva/100);
                            cont++;
                            limpiar();
                            totales();
                            evaluar();
                            $('#details').append(fila);
                    }
            //} else{
            //        alert("La cantidad del producto supera al stock");
                        
            //}
        }else{
            alert("Debe ingresar una cantidad");
        }
    }
    exen = exent;
    function totales(){
        subTotal = totalEx + totalBi;//################################
        total_iva = subtotalIva;//#####################################
        //bi = totalBi;//##############################################
        total_pagar = totalEx + totalBi + total_iva;//#################
        $("#sub-total").html("Bs. " + subTotal.toFixed(2));//##########
        $("#total_exento").html("Bs. " + totalEx.toFixed(2));//########
        $('#base_impo').html('Bs. ' + totalBi.toFixed(2));//###########
        $('#total_iva').html('Bs. ' + total_iva.toFixed(2));//#########
        $('#total_pagar').html('Bs. ' + total_pagar.toFixed(2));//#####
        //#############################################################
    }
    function limpiar(){
        
        $("#quantity").val("");
        $("#buy").val("Bs.0");
        $("#stock").val("");
        $("#product").val("");
    }
});
function evaluar(){

        console.log(total_pagar);
         if(total_pagar>0){
           $("#guardar").show();
         } else{
           $("#guardar").hide();             
         }
    };
function eliminarFila(index,exe){

    subTotal = totalEx + totalBi;//################################
    subTotalEx = totalEx - subToEx[index];//################################
    subtotalIva = subtotalIva;
    console.log("iva "+subtotalIva);
    total_iva = subtotalIva;
    console.log("restando el index del subtotal ex: "+ subTotalEx);
    subTotalBi = totalBi - subToBi[index];//################################
    console.log("restando el index del subtotal bi: "+ subTotalBi);
    if(isNaN(subTotalEx)){
        respuesta = subTotal - totalBi;
        iva = subtotalIva - subtotalIva;
        totalPagar = respuesta - iva;
        console.log("esta es larespuesta Gravable: "+respuesta);
        $("#sub-total").html("Bs. " + respuesta.toFixed(2));
        $('#base_impo').html('Bs. ' + parseInt(subTotalBi).toFixed(2));
        $('#total_iva').html('Bs. ' + iva.toFixed(2));//#########

    }else{
        respuesta = subTotal - totalEx;
        iva = subtotalIva;
        totalPagar = respuesta + iva;
        console.log("esta es larespuesta Excento: "+respuesta);
        $("#sub-total").html("Bs. " + respuesta.toFixed(2));
        $('#total_exento').html('Bs. ' + parseInt(subTotalEx).toFixed(2));
    }
        $('#total_pagar').html('Bs. ' + parseInt(totalPagar).toFixed(2));
    console.log("el subtotal 1:"+ (subTotal));
    $("#fila" + index).remove();
    evaluar();
  }

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
if($('#client').length){
    $( "#client" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url:"{{route('clients.getClients')}}",
            type: 'post',
            dataType: "json",
            data: {
               _token: CSRF_TOKEN,
               client: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
         //source: "{{ route('clients.getClients') }}",
        minLength: 4,
        select: function (event, ui) {
            //var item = ui.item;

           // Set selection
           $('#client_id').val(ui.item.value); // display the selected text valor del id
           $('#cliente').val(ui.item.label); // save selected id to input nombres del cliente
           $('#dni').val(ui.item.dni);
           //$('#client').val(ui.item.id);
           //$('#cliente').val(ui.item.first_name);
           return false;
            }
    });
    
   

}
</script>
@endsection