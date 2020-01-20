@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		
		<div class="col-md-12 col-md-offset-0">
			
			<div id="exito" class="alert alert-success" style="display: none;">
				<i class="fa fa-check"></i>losto eliminado con exito!.

			</div>
            <div class="panel panel-default">
            	

                <div class="panel-heading">
                	@php $path = explode('/',Request::path()) @endphp 
                	<b class="sub-header">{{ strtoupper(title_case($path[0])) }}</b>
                	<a href="{{ url()->previous() }}" type="button" class="btn btn-round btn-warning btn-sm pull-right" title="Regresar"><i class="fa fa-arrow-circle-o-left fa-2x"></i> </a>
                  <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                	
            		<table class="table">
						<thead>
							<tr>
								<th style="text-align: center;">Id</th>
                <th style="text-align: center;">Producto</th>
                <th style="text-align: center;">Total producción</th>
								<th style="text-align: center;">Total Perdida</th>
                <th style="text-align: center;">Fecha producción</th>
							</tr>
						</thead>
						<tbody>
						@php $id = 1; @endphp	
						@foreach($losts as $lost)					
							<tr class="lost_id{{ $lost->id }}">
								<td align="center">{{ $id++ }}</td>
                <td align="center">{{ $lost->product->product }}</td> 
								<td align="center">{{ $lost->quantity_in }}</td> 
                <td align="center">{{ $lost->lost }}</td> 
                <td align="center">{{ Carbon\Carbon::parse($lost->production_date)->format('d/m/Y') }}</td> 
							</tr>
						@endforeach							
						</tbody>
						
					</table>						
                </div>
				
			</div>

		</div>


	</div>
				

</div>
@endsection