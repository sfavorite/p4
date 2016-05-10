@extends('layouts.master')

@section('content')

    <div class="text-center">
        <p>Don't have an account? <a href='/signup'>Signup here.</a></p>

        <h1>Login</h1>

        @if(count($errors) > 0)
            <ul class='errors'>
                @foreach ($errors->all() as $error)
                    <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form method='POST' action='/login'>

                    {!! csrf_field() !!}

                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input type='text' class="form-control" name='email' id='email' value='{{ old('email') }}'>
                    </div>

                    <div class='form-group'>
                        <label for='password'>Password</label>
                        <input type='password' class="form-control" name='password' id='password' value='{{ old('password') }}'>
                    </div>

                    <div class='form-group'>
                        <label class=checkbox-inline>
                        <input type='checkbox' class="checkbox" name='remember' id='remember'>Remember me</label>
                    </div>

                    <button type='submit' class='btn btn-primary'>Login</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@stop
