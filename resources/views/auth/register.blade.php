@extends('layouts.master')

@section('content')

    <p class="text-center">Already have an account? <a href='/login'>Login here...</a></p>

    <h1 class="text-center">Register</h1>

    @if(count($errors) > 0)
        <ul class='errors'>
            @foreach ($errors->all() as $error)
                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
            @endforeach
        </ul>
    @endif

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form method='POST' action='/register'>
                    {!! csrf_field() !!}
                    <div class='form-group'>
                        <label for='name'>First Name</label>
                        <input class="form-control" type='text' name='first' id='first' value='{{ old('first') }}'>
                        <span class="help-block">Optional and kept private</span>

                    </div>
                    <div class='form-group'>
                        <label for='name'>Last Name</label>
                        <input class="form-control" type='text' name='last' id='last' value='{{ old('last') }}'>
                        <span class="help-block">Optional</span>
                    </div>
                    <div class='form-group'>
                        <label for='name'>City</label>
                        <input class="form-control" type='text' name='city' id='city' value='{{ old('city') }}'>
                        <span class="help-block">Optional and kept private</span>
                    </div>
                    <div class='form-group'>
                        <label for='name'>Country</label>
                        <input class="form-control" type='text' name='city' id='country' value='{{ old('country') }}'>
                        <span class="help-block">Optional and kept private</span>

                    </div>
                    <div class='form-group'>
                        <label for='name'>Name</label>
                        <input class="form-control" type='text' name='name' id='name' value='{{ old('name') }}'>
                        <span class="help-block">This is the name displayed to other users</span>
                    </div>

                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input class="form-control" type='text' name='email' id='email' value='{{ old('email') }}'>
                        <span class="help-block">Your email is private and used only to login.</span>
                    </div>
                    <div class='form-group'>
                        <label for='password'>Password</label>
                        <input class="form-control" type='password' name='password' id='password'>
                    </div>
                    <div class='form-group'>
                        <label for='password_confirmation'>Confirm Password</label>
                        <input class="form-control" type='password' name='password_confirmation' id='password_confirmation'>
                    </div>
                    <button type='submit' class='btn btn-primary'>Register</button>
                </form>
                    <form method='link' action="{{ url('/github/authorize') }}" >
                    <div>
                        <p> Or </p>
                        <button class='btn btn-primary'>Login with Github <input<i class="fa fa-github"></i></a>
                    </div>

                </form>
            </div>
        </div>


@stop
