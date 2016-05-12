@extends('layouts.master')

@section('content')

    <div class="text-center">
        <p>Don't have an account? <a href='/signup'>Signup here.</a></p>

        <h1>Login</h1>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                @if($errors)
                    <div>
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>

                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method='POST' action='/login'>

                    {!! csrf_field() !!}

                    <div class='form-group @if ($errors->has('email')) has-error @endif'>
                        <label for='email'>Email</label>
                        <input type='text' class="form-control" name='email' id='email' value='{{ old('email') }}'>
                    </div>

                    <div class='form-group @if ($errors->has('password')) has-error @endif'>
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
