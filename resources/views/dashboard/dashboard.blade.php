@extends('layouts.app')
@section('content')
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count">{{ $clients }}</div>
                {{--@if($people != 1)
                    <h3><a href="{{ route('titulares.index') }}">Titulares</a></h3>
                @else
                    <h3><a href="{{ route('titulares.index') }}">Titular</a></h3>
                @endif--}}
                
                <h3><a href="{{ route('clientes.index') }}">Clientes</a></h3>
                  <p>Clientes Registrados.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-money"></i></div>
                  <div class="count">{{ $sales }}</div>
                  <h3><a href="{{ route('ventas.index') }}">Ventas</a></h3>
                  <p>Ventas Registrados.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-edit"></i></div>
                <div class="count">{{ count($orders) }}</div>
                <h3><a href="{{ route('pedidos.index') }}">Pedidos</a></h3>
                <p>Pedidos registradas.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-send"></i></div>
                <div class="count">{{ count($order_ens) }}</div>
                <h3>Entregados</h3>
                <p>Pedidos Entregados.</p>
            </div>
        </div>
    </div>

            <div class="row">
              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pedidos <small>Sessions</small></h2>
                    <!--<h2>Ultimos <small>Pedidos</small></h2>-->
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
                    {{--dd($orders)--}}
                  <div class="x_content">
                    <article class="media event">
                        @if($orders->count() == 0)
                            <div class="media-body">
                                
                                <p>
                                    <span class="badge bg-red">
                                        No hay Pedidos pendientes
                                    </span>
                                </p>
                               
                               
                            </div>
                        @else
                            @foreach($orders as $order)
                                @php 
                                $date = $order->date_order; 
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
                               @endphp
                               
                                    <a class="pull-left date">
                                       <p class="month">{{$mont}}</p>
                                       <p class="day">{{$day}}</p>
                                    </a>
                                    <div class="media-body">
                                        
                                        <a class="title" href="#">{{$order->client->first_name.' '.$order->client->last_name }}</a>
                                        <p>
                                            Fecha de Entrega:<span class="badge bg-red">{{Carbon\Carbon::parse($order->date_delivery)->format('d/m/Y') }}</span>
                                            {{--@if(isset($appointment->beneficiary->full_name))
                                                {{ ($appointment->beneficiary->full_name) }}
                                            @else
                                                {{ "N/B" }}
                                            @endif--}}
                                        </p>
                                       <p>{{-- $appointment->user->full_specialist --}}</p>
                                       
                                    </div>
                                    <hr>
                            @endforeach
                        @endif
                    </article>
                    {{$orders->render()}}
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ped. Entrgados <small>Sessions</small></h2>
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
                    <article class="media event">
                        @if($order_ens->count() == 0)
                            <div class="media-body">
                                
                                <p>
                                    <span class="badge bg-red">
                                        No hay Pedidos entregados
                                    </span>
                                </p>
                               
                               
                            </div>
                        @else
                            @foreach($order_ens as $order)
                                @php 
                                $date = $order->date_order; 
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
                               @endphp
                               
                                    <a class="pull-left date">
                                       <p class="month">{{$mont}}</p>
                                       <p class="day">{{$day}}</p>
                                    </a>
                                    <div class="media-body">
                                        
                                        <a class="title" href="#">{{$order->client->first_name.' '.$order->client->last_name }}</a>
                                        <p>
                                            Fecha de Entrega:<span class="badge bg-green">{{Carbon\Carbon::parse($order->date_delivery)->format('d/m/Y') }}</span>
                                            {{--@if(isset($appointment->beneficiary->full_name))
                                                {{ ($appointment->beneficiary->full_name) }}
                                            @else
                                                {{ "N/B" }}
                                            @endif--}}
                                        </p>
                                       <p>{{-- $appointment->user->full_specialist --}}</p>
                                       
                                    </div>
                                    <hr>
                            @endforeach
                        @endif
                    </article>
                    {{$orders->render()}}
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ventas <small>Sessions</small></h2>
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
                    <article class="media event">
                        @if($sales_outs->count() == 0)
                            <div class="media-body">
                                
                                <p>
                                    <span class="badge bg-red">
                                        No hay Ventas Realizadas.
                                    </span>
                                </p>
                               
                               
                            </div>
                        @else
                            @foreach($sales_outs as $sales_out)
                                @php 
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
                               @endphp
                               
                                    <a class="pull-left date">
                                       <p class="month">{{$mont}}</p>
                                       <p class="day">{{$day}}</p>
                                    </a>
                                    <div class="media-body">
                                        
                                        <a class="title" href="#">{{$sales_out->client->first_name.' '.$sales_out->client->last_name }}</a>
                                        <p>
                                            Fecha de venta:<span class="badge bg-green">{{Carbon\Carbon::parse($sales_out->date_created)->format('d/m/Y') }}</span>
                                            {{--@if(isset($appointment->beneficiary->full_name))
                                                {{ ($appointment->beneficiary->full_name) }}
                                            @else
                                                {{ "N/B" }}
                                            @endif--}}
                                        </p>
                                       <p>{{-- $appointment->user->full_specialist --}}</p>
                                       
                                    </div>
                                    <hr>
                            @endforeach
                        @endif
                    </article>
                    {{$sales_outs->render()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection