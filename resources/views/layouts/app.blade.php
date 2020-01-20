<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pandelca') }}</title>
    


    <!-- Styles -->
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" media="print">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- FullCalendar -->
    <link href="{{ asset('css/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fullcalendar/dist/fullcalendar.print.css') }}" rel="stylesheet" media="print">

    
</head>
<!--<body>-->
<body class="nav-md footer_fixed">
  <div class="container body">
    <div class="main_container">
      <!--menu izquierdo-->
      <div class="col-md-3 left_col menu-fixed">
        @include('menus.menu1')
      </div>
      <!--fin menu-->
      <!--top nav-->
      <div class="top_nav">
        @include('menus.navmenu')
      </div>
      <!--fin top nav-->
      <!--columnas derechas-->
      <div class="right_col" role="main" style="min-height: 779.117px;"><div class="row">
          <div class="col-md-12">
            <div class="x_panel">
              <div class="x_title">
                @php $path = explode('/',Request::path()) @endphp 
                <h2>{{ strtoupper(title_case($path[0])) }}</h2> 
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

                <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="row">
                          <div class="col-md-12 col-md-offset-0">
                              @if(session('info'))
                                  <div class="alert alert-success">
                                    <i class="fa fa-check"></i>
                                      {{ session('info') }}
                                  </div>
                              @endif 
                              @if(session('error'))
                                  <div class="alert alert-danger">
                                    <i class="fa fa-check"></i>
                                      {{ session('error') }}
                                  </div>
                              @endif                    
                          </div>
                          @if(count($errors))
                              <div class="col-md-12 col-md-offset-0">
                                  <div class="alert alert-danger">
                                     
                                      <ul>
                                          @foreach($errors->all() as $error)
                                          <li><i class="fa fa-exclamation-circle"></i> {{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              </div>
                          @endif
                      </div>
                      @yield('content')
                </div>
              </div>
            </div>
        <!-- footer content -->
      <footer>
        @include('menus.footer')
      </footer>
      <!-- /footer content -->
          </div>
        </div>
      </div>
      <!--fin columnas derechas-->
      
      
      
    </div>
  </div><!--Container body-->
    
            

    
    

    <!-- Scripts -->
    <!--<script src="http://code.jquery.com/jquery-3.3.1.js"
              integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
              crossorigin="anonymous"></script>-->
    <script src="{{ asset('js/jquery-2.0.3.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    

    @yield('scripts')


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{-- asset('js/jquery.js') --}}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/actions.js') }}"></script>
    <!-- FullCalendar -->
    <script src="{{-- asset('js/moment/min/moment.min.js') --}}"></script>
    <script src="{{-- asset('js/fullcalendar/dist/fullcalendar.min.js ') --}}"></script>
    <script src="{{ asset('js/fullcalendar/es.js ') }}"></script>


    
    <script src="{{-- asset('js/jquery/dist/jquery.min.js') --}}"></script>
    <script src="{{-- asset('js/bootstrap/dist/js/bootstrap.min.js') --}}"></script>
    <script src="{{ asset('js/fastclick/lib/fastclick.js') }}"></script>
    
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.js ') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{-- asset('js/custom.min.js') --}}"></script>
    <!--sweet alert-->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script type="text/javascript">
      $('.bs-example-modal-lg-editar').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('id')
        //console.log(id);
        var nombre_producto = button.data('nombre_producto')
        var presentacion    = button.data('presentacion')
        var entrada         = button.data('entrada')
        var fecha_registro  = button.data('fecha_registro')
        var responsable     = button.data('responsable')

        var modal = $(this);

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #nombre_producto').val(nombre_producto);
        modal.find('.modal-body #presentacion').val(presentacion);
        modal.find('.modal-body #entrada').val(entrada);
        modal.find('.modal-body #fecha_registro').val(fecha_registro);
        modal.find('.modal-body #responsable').val(responsable);
      });
    </script>
   
</body>
</html>
