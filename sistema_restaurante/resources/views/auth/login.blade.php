@extends('layouts.app')
@section('content')

<div class="login-box ">
    <!-- <div class="login-logo">
        <div class="login-logo">
            <a href="#">
                {{ trans('panel.site_title') }}
            </a>
        </div>
    </div> -->
    <div class="card">
        <div class="card-body login-card-body ">
           <!-- <p class="login-box-msg">Ingresa para iniciar tu sesión</p> -->
           <div class="fondo-login"></div>
        
            @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
            @endif
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.login_username') }}" name="username" value="{{ old('username', null) }}">
                    @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}" name="password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>


                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ trans('global.remember_me') }}</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('global.login') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



{{--            <p class="mb-1">--}}
{{--                <a class="" href="{{ route('password.request') }}">--}}
{{--                    {{ trans('global.forgot_password') }}--}}
{{--                </a>--}}
{{--            </p>--}}
            <p class="mb-0">

            </p>
            <p class="mb-1">

            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection
