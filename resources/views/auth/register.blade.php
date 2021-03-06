@extends('layouts.master')

@section('content')
    <link href="css/placeholder.css" rel="stylesheet">

    <p class="text-center">Already have an account? <a href='/signup'>Login here...</a></p>

    <h1 class="text-center">Register</h1>




        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                @if($errors)
                    <div>
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>

                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method='POST' action='/email-signup'>
                    {!! csrf_field() !!}
                    <div class='form-group @if ($errors->has('name')) has-error @endif'>
                        <label for='name'>Name</label>
                        <input class="form-control" type='text' name='name' id='name' value='{{ old('name') }}'>
                        <span class="help-block">This is the name displayed to other users</span>
                    </div>

                    <div class='form-group'>
                        <label for='name'>First Name</label>
                        <input class="form-control" type='text' name='first' id='first' value='{{ old('first') }}'>

                    </div>
                    <div class='form-group'>
                        <label for='name'>Last Name</label>
                        <input class="form-control" type='text' name='last' id='last' value='{{ old('last') }}'>
                    </div>

                    <div class='form-group ui-widget'>
                        <label for='name'>Country</label>
                        <input class="form-control" type='text' autocorrect="off" name='country' id='country' value='{{ old('country') }}'>
                        <span class="help-block">Optional (just type Private)</span>

                    </div>

                    <div class='form-group ui-widget'>
                        <label for='name'>City</label>
                        <input class="form-control" type='text' autocorrect="off" name='city' id='city' value='{{ old('city') }}'>
                        <span class="help-block">Optional (just type Private)</span>
                    </div>

                    <div class='form-group @if ($errors->has('email')) has-error @endif'>
                        <label for='email'>Email</label>
                        <input class="form-control" type='text' name='email' id='email' value='{{ old('email') }}' placeholder="John Doe">
                        <span class="help-block">Your email is private and used only to login.</span>
                    </div>
                    <div class='form-group @if ($errors->has('password')) has-error @endif'>
                        <label for='password'>Password</label>
                        <input class="form-control" type='password' name='password' id='password'>
                    </div>
                    <div class='form-group @if ($errors->has('password')) has-error @endif'>
                        <label for='password_confirmation'>Confirm Password</label>
                        <input class="form-control" type='password' name='password_confirmation' id='password_confirmation'>
                    </div>
                    <button type='submit' class='btn btn-primary'>Register</button>
                </div>
                <div class="col-md-3">
                    <div class="arrow_box">
                        <h1 class="">css arrow please!</h1>
                    </div>
                </div>

            </div>


        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="../css/left_arrow.css">
        <script src="../js/citycountry.js" type="text/javascript"></script>

        <script src="../js/register.js" type="text/javascript"></script>


@stop
