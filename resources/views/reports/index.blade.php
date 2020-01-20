@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ventas <small>del Dia</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  	</li>
                  	<li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    	<ul class="dropdown-menu" role="menu">
                      		<li><a href="#">Settings 1</a>
                      		</li>
                      		<li><a href="#">Settings 2</a>
                      		</li>
                    	</ul>
                  	</li>
                  	<li><a class="close-link"><i class="fa fa-close"></i></a>
                  	</li>
                </ul>
                <div class="clearfix"></div>
            </div>
          	<div class="x_content">
                <div class="media-body">
                	<form action="{{ route('venta_del_dia') }}" method="GET">
						<div class="checkbox">
                            <label class="">
                              <div class="" style="position: relative;">
                              	<input type="checkbox" class="flat" name="tp" value="1">T-D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              	<input type="checkbox" class="flat" name="tp" value="2">EFECTIVO.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              	<input type="checkbox" class="flat" name="tp" value="3">TDC.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              	<input type="checkbox" class="flat" name="tp" value="4">TRANSF.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              	<input type="checkbox" class="flat" name="tp" value="5">P-M&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              	<input type="checkbox" class="flat" name="tp" value="6">($).&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              	<input type="checkbox" class="flat" name="tp" value="7">DONA.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" class="flat" name="tp" value="8">CREDITO.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              </div>


                            </label>
                          </div>
	                	<input type="hidden" name="to_day" id="to_day" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
	                	{{--dd(Carbon\Carbon::now())--}}
	                   <button type="submit" class="btn btn-round btn-default col-md-12">Consultar
	                   </button>
                	</form>
                </div>
	                                {{--@php 
	                                $date = $sales_out->date_created; 
	                                $des = preg_split("/[\s-]/",$date);
	                                $day = $des[2];
	                                $month = $des[1];
	                                
	                                switch ($month) {
	                                    case '1':
	                                        $mont = "Enero";
	                                        break;
	                                    case '2':
	                                        $mont = "Febrero";
	                                        break;
	                                    case '3':
	                                        $mont = "Marzo";
	                                        break;
	                                    case '4':
	                                        $mont = "Abril";
	                                        break;
	                                    case '5':
	                                        $mont = "Mayo";
	                                        break;
	                                    case '6':
	                                        $mont = "Junio";
	                                        break;
	                                    case '7':
	                                        $mont = "Julio";
	                                        break;
	                                    case '8':
	                                        $mont = "Agosto";
	                                        break;
	                                    case '9':
	                                        $mont = "Septiembre";
	                                        break;
	                                    case '10':
	                                        $mont = "Octubre";
	                                        break;
	                                    case '11':
	                                        $mont = "Noviembre";
	                                        break;
	                                    
	                                    case '12':
	                                        $mont = "Diciembre";
	                                        break;
	                                }                        
	                               @endphp--}}
	                               
	                                    
	                                    <!--<div class="media-body">
	                                        
	                                        <a class="title" href="#"></a>
	                                        <p>
	                                            
	                                        </p>
	                                       	<p>
	                                       	
	                                       	</p>
	                                       
	                                    </div>-->
	            <hr>
	        </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pedidos <small>del Dia</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  	</li>
                  	<li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    	<ul class="dropdown-menu" role="menu">
                      		<li><a href="#">Settings 1</a>
                      		</li>
                      		<li><a href="#">Settings 2</a>
                      		</li>
                    	</ul>
                  	</li>
                  	<li><a class="close-link"><i class="fa fa-close"></i></a>
                  	</li>
                </ul>
                <div class="clearfix"></div>
            </div>
          	<div class="x_content">
                <div class="media-body">
               	<form action="{{ route('pedidos_del_dia') }}" method="GET">
               		<input type="hidden" name="to_day" id="to_day" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                   	<button type="submit" class="btn btn-round btn-default col-md-12">Consultar
                   	
                   </button>
               </form>
                </div>
	            <hr>
	        </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Ventas <small>Por fechas</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  	</li>
                  	<li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    	<ul class="dropdown-menu" role="menu">
                      		<li><a href="#">Settings 1</a>
                      		</li>
                      		<li><a href="#">Settings 2</a>
                      		</li>
                    	</ul>
                  	</li>
                  	<li><a class="close-link"><i class="fa fa-close"></i></a>
                  	</li>
                </ul>
                <div class="clearfix"></div>
            </div>
          	<div class="x_content">
                <div class="media-body">
                <form action="{{ url('ventas_fechas/start/end') }}" method="POST" role="search">	

					{{ csrf_field() }} 
					<div class="checkbox">
                        <label class="">
                          	<div class="" style="position: relative;">
	                          	<input type="checkbox" class="flat" name="tp" value="1">T-D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                          	<input type="checkbox" class="flat" name="tp" value="2">EFECTIVO.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                          	<input type="checkbox" class="flat" name="tp" value="3">TDC.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                          	<input type="checkbox" class="flat" name="tp" value="4">TRANSF.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                          	<input type="checkbox" class="flat" name="tp" value="5">P-M&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                          	<input type="checkbox" class="flat" name="tp" value="6">($).&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                          	<input type="checkbox" class="flat" name="tp" value="7">DONA.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="checkbox" class="flat" name="tp" value="8">CREDITO.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          	</div>


                        </label>
                    </div>
                	<div class="form-group col-md-6">
	                    <label>
	                       	Desde:
	                    </label>
	                    <input type="date" name="start" id="start" class="form-control" value="start">
                	</div>
                	<div class="form-group col-md-6">
	                    <label>
	                       	Hasta:
	                    </label>
	                    <input type="date" name="end" id="end" class="form-control" value="end">
                	</div>
                    <div class="clearfix"></div>
                    <br>
                    <button class="btn btn-round btn-default col-md-12">Consultar
                   	
                   </button>
               </form>
                </div>
	            <hr>
	        </div>
        </div>
    </div>
	<div class="col-md-6">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pedidos <small>Por fechas</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  	</li>
                  	<li class="dropdown">
                    	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    	<ul class="dropdown-menu" role="menu">
                      		<li><a href="#">Settings 1</a>
                      		</li>
                      		<li><a href="#">Settings 2</a>
                      		</li>
                    	</ul>
                  	</li>
                  	<li><a class="close-link"><i class="fa fa-close"></i></a>
                  	</li>
                </ul>
                <div class="clearfix"></div>
            </div>
          	<div class="x_content">
                <div class="media-body">
                	<form action="{{ url('pedidos_fechas/start/end') }}" method="POST" role="search">	

					{{ csrf_field() }} 
	                	<div class="form-group col-md-6">
		                    <label>
		                       	Desde:
		                    </label>
		                    <input type="date" name="start" id="start" class="form-control">
	                	</div>
	                	<div class="form-group col-md-6">
		                    <label>
		                       	Hasta:
		                    </label>
		                    <input type="date" name="end" id="end" class="form-control">
	                	</div>
	                    <div class="clearfix"></div>
	                    <br>
	                    <button type="submit" class="btn btn-round btn-default col-md-12">Consultar
	                   	
	                   </button>
	               </form>
                </div>
	            <hr>
	        </div>
        </div>
    </div>
</div>
@endsection