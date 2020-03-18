@extends('layouts.app')

@section('content')

<section class="content">
    <div class="login-box">
        <div class="login-logo" style="color: #51d855">
            <b style="color:#000">WELL</b>POS
        </div>
        <div class="login-box-body" style="border-top :4px solid #51d855;border-bottom :3px solid #51d855">
            <p class="login-box-msg">SIGN IN </p>

            <form class="form-vertical" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <!-- <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div> -->

                <!-- <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                   <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Username" autofocus="" autocomplete="off">
                   <span class="glyphicon glyphicon-user form-control-feedback"></span>

                   @if ($errors->has('email'))
                      <span class="help-block">
                         <strong>{{ $errors->first('email') }}</strong>
                      </span>
                   @endif
                </div> -->

                <div class="form-group has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
                   <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" autofocus="" autocomplete="off">
                   <span class="glyphicon glyphicon-user form-control-feedback"></span>

                   @if ($errors->has('username'))
                      <span class="help-block">
                         <strong>{{ $errors->first('username') }}</strong>
                      </span>
                   @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <!-- <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div> -->
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>

        </div><br>
        <div style="text-align:center;color:#000">
            <small>&copy; Copyright 2019 WELLPOS.</small>
        </div>
    </div>
</section>


<!-- <div class="container" style="padding-top: 100px;">
    <div class="row">
        <div class="login-logo">
            <a href="#"><b>SION</b>CELL</a>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-vertical" method="POST" action="{{ route('login') }}">
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
</div> -->

@endsection
