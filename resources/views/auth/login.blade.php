@extends('auth.contenido')

@section('login')
    <a class="hiddenanchor" id="signup"></a>

        
            <form method="POST" action="{{ route('login') }}">
                  <h1>Login Form</h1>
                  {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
                        <!--ojo si es user cambiar el type a text y el name-->
                        <input placeholder="Usuario" required="" id="user" type="text" class="form-control" name="user" autocomplete="off" value="{{-- old('email') --}}" required autofocus/>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <!--<input type="password" class="form-control" placeholder="Password" required="" />-->
                        <input id="password" type="password" class="form-control" name="password" placeholder="Clave" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                  <div>
                    <button class="btn btn-default" type="submit">Ingresar</button>
                    <!--a class="reset_pass" href="#">Lost your password?</a>-->
                  </div>

                  <div class="clearfix"></div>

                  <div class="separator">
                    <!--<p class="change_link">New to site?
                      <a href="#signup" class="to_register"> Create Account </a>
                    </p>-->

                        <div class="clearfix"></div>
                        <br />

                        <div>
                          <h1><i class="fa fa-paw"></i> Pandelca!</h1>
                          <p>©2019 Todos Los Derechos Reservados. Sistema administrativo de Gestion y Control.</p>
                        </div>
                  </div>
            </form>
          

{{--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}
@endsection
