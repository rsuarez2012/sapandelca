@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		
		<div class="col-md-12 col-md-offset-0">
			
			<div id="exito" class="alert alert-success" style="display: none;">
				<i class="fa fa-check"></i>Cliente eliminado con exito!.

			</div>
            <div class="panel panel-default">
            	

                <div class="panel-heading">
                	@php $path = explode('/',Request::path()) @endphp 
                	<b class="sub-header">{{ strtoupper(title_case($path[0])) }}</b>
                	<button type="button" class="btn btn-round btn-primary btn-sm pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"title="Nuevo Empleado"><i class="fa fa-file-o"></i></button>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                	
            		<table class="table">
						<thead>
							<tr>
								<th style="text-align: center;">Id</th>
                <th style="text-align: center;">Titular</th>
                <th style="text-align: center;">Banco</th>
                <th style="text-align: center;">Numero de Cuenta</th>
							  <th style="text-align: center;">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@php $id = 1; @endphp	
						@foreach($banks as $bank)					
							<tr class="bank_id{{ $bank->id }}">
								<td align="center">{{ $id++ }}</td>
								<td align="center">{{ $bank->title }}</td> 
                <td align="center">{{ $bank->name_bank }}</td> 
                <td align="center">{{ $bank->number }}</td>               
								<td align="center">	

									<button type="button" class="btn btn-round btn-danger btn-sm delete-bank" id="delete-bank" data-id="{{ $bank->id }}" title="Eliminar banco"><i class="fa fa-trash-o"></i></button>
								</td>
							</tr>
						@endforeach							
						</tbody>
						
					</table>						
                </div>
				
			</div>

		</div>


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
          <h4 class="modal-title" id="myModalLabel">Registrar Banco</h4>
        </div>
        <div class="modal-body">
            <form action="{{Route('bancos.store')}}" class="row" method="POST">
            	{!! csrf_field() !!}
                
                @include('banks.partials.form')
			</form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
//alert("hola");
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

    $('.delete-bank').on('click', function(){
    	
    	var id = $(this).attr('data-id');
    	confirm("Esta seguro de eliminar?");
	    	$.ajax({
	    		type:'DELETE',
	    		url:'/bankes/'+id,
	    		success: function(data, msg){
	    			$('#exito').delay(500).fadeIn('slow');
	    			$('.bank_id'+id).remove();

	    		},
	    		error:function(data){
	    			console.log('Error:', data);
	    		}
	    	})
    	
    });

	
});
</script>
@endsection