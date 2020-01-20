<div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{-- route('register') --}}">Register</a></li>
                @else
                    <li class="">
                      <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      
                      <img src="{{ asset('images/team-1.jpg') }}{{--asset('/expedientes/usuarios/'.Auth::user()->image)--}}" alt="">  {{ Auth::user()->name }}
                        <span class=" fa fa-angle-down"></span>
                      </a>
                      <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <!--<li><a href="javascript:;"> Profile</a></li>--> 
                        <li>
                            
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out pull-right"></i>Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>                   
                    @endguest
                  </ul>
                </li>

            </ul>
          </nav>
        </div>