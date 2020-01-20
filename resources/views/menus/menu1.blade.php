<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="index.html" class="site_title">
            <i class="fa fa-cubes"></i> 
            <span>{{ config('app.name', 'Pandelca') }}!</span>
        </a>
    </div>
    <div class="clearfix"></div>
    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="{{ asset('images/team-1.jpg') }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Bienvenido,</span>
            <h2>{{ Auth::user()->user }}</h2>
        </div>
    </div>
    <!-- /menu profile quick info -->
    <br>
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>Menu</h3>
            <ul class="nav side-menu">
                <li>
                    <a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i> 
                        Dashboard                             
                    </a>
                    
                </li>
                <!--Estructura para el control de usuario-->
                @if(auth()->check())
                    @if(auth()->user()->rol_id === 1)
                        <li>
                            <a href="{{ route('ventas.index') }}">
                            <i class="fa fa-money"></i>Ventas</a>
                        </li>
                        <li>
                            <a href="{{ route('clientes.index') }}">
                            <i class="fa fa-users"></i> Clientes</a>
                        </li>
                        <li>
                            <a href="{{ route('creditos.index') }}">
                            <i class="fa fa-edit"></i> Creditos</a>
                        </li>
                        <li>
                            <a href="{{ route('despachos') }}">
                            <i class="fa fa-send"></i>Despachos</a>
                        </li>
                        <!--empleados-->
                        <!--<li>
                            <a>
                                <i class="fa fa-users"></i> Empleados<span class="fa fa-chevron-down"></span>
                            </a>
                        </li>-->
                        <li>
                            <a href="{{ route('pedidos.index') }}">
                            <i class="fa fa-pencil-square-o"></i>Pedidos</a>
                        </li>
                        <li>
                            <a href="{{ route('productos.index') }}">
                            <i class="fa fa-shopping-cart"></i>Productos</a>
                        </li>
                        <li>
                            <a>
                                <i class="fa fa-lock"></i>Administración
                                <span class="fa fa-chevron-down"></span>

                            </a>
                            <ul class="nav child_menu">
                                <li>
                                    <a href="{{ route('almacen.index') }}">Almacen</a>
                                </li>
                                <li>
                                    <a href="{{ route('departamentos.index') }}">Departamentos</a>
                                </li>
                                <li>
                                    <a href="{{ route('empleados.index') }}">Empleados</a>
                                </li>
                                <li>
                                    <a href="{{ route('reportes.index') }}">Reportes</a>
                                </li>
                                <li>
                                    <a href="{{ route('usuarios.index') }}">Usuarios</a>
                                </li>
                            </ul>
                        </li> 
                    @elseif(auth()->user()->rol_id === 2)
                        <li>
                            <a href="{{ route('pedidos.index') }}">
                            <i class="fa fa-pencil-square-o"></i>Pedidos</a>
                        </li>
                        <li>
                            <a href="{{ route('productos.index') }}">
                            <i class="fa fa-shopping-cart"></i>Productos</a>
                        </li>
                        <li>
                            <a>
                                <i class="fa fa-lock"></i>Administración
                                <span class="fa fa-chevron-down"></span>

                            </a>
                            <ul class="nav child_menu">
                                <li>
                                    <a href="{{ route('almacen.index') }}">Almacen</a>
                                </li>
                                <li>
                                    <a href="{{ route('departamentos.index') }}">Departamentos</a>
                                </li>
                            </ul>
                        </li>
                    @elseif(auth()->user()->rol_id === 3)
                        <li>
                            <a href="{{ route('ventas.index') }}">
                            <i class="fa fa-money"></i>Ventas</a>
                        </li>
                        <li>
                            <a href="{{ route('pedidos.index') }}">
                            <i class="fa fa-pencil-square-o"></i>Pedidos</a>
                        </li>
                        <li>
                            <a href="{{ route('clientes.index') }}">
                            <i class="fa fa-users"></i> Clientes</a>
                        </li>
                        <li>
                            <a href="{{ route('creditos.index') }}">
                            <i class="fa fa-edit"></i> Creditos</a>
                        </li>
                        <li>
                            <a href="{{ route('productos.index') }}">
                            <i class="fa fa-shopping-cart"></i>Productos</a>
                        </li>
                    @elseif(auth()->user()->rol_id === 4)
                        <li>
                            <a>
                                <i class="fa fa-lock"></i>Administración
                                <span class="fa fa-chevron-down"></span>

                            </a>
                            <ul class="nav child_menu">
                                <li>
                                    <a href="{{ route('reportes.index') }}">Reportes</a>
                                </li>
                            </ul>
                        </li>
                    @else

                    @endif
                @endif  
            </ul>
        </div>

        
    </div>
        <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              
            </div>
            <!-- /menu footer buttons -->

    
</div>
 