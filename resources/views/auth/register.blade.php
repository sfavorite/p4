@extends('layouts.master')

@section('content')

    <p class="text-center">Already have an account? <a href='/signup'>Login here...</a></p>

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


                <form method='POST' action='/email-signup'>
                    {!! csrf_field() !!}
                    <div class='form-group'>
                        <label for='name'>First Name</label>
                        <input class="form-control" type='text' name='first' id='first' value='{{ old('first') }}'>
                        <span class="help-block">Optional</span>

                    </div>
                    <div class='form-group'>
                        <label for='name'>Last Name</label>
                        <input class="form-control" type='text' name='last' id='last' value='{{ old('last') }}'>
                        <span class="help-block">Optional</span>
                    </div>
                    <div class='form-group'>
                        <label for='name'>City</label>
                        <input class="form-control" type='text' name='city' id='city' value='{{ old('city') }}'>
                        <span class="help-block">Optional</span>
                    </div>
                    <div class='form-group'>
                        <label for='name'>Country</label>
                        <input class="form-control" type='text' name='country' id='country' value='{{ old('country') }}'>
                        <span class="help-block">Optional</span>

                    </div>

                    <div class='form-group'>
                        <label for='name'>Name</label>
                        <input class="form-control" type='text' name='name' id='name' value='{{ old('name') }}'>
                        <span class="help-block">This is the name displayed to other users</span>
                    </div>

                    <div class='form-group'>
                        <label for='name'>Image</label>
                        <input class="form-control" type='text' name='image' id='image' value='{{ old('image') }}'>
                        <span class="help-block">Up load a picture or avatar for your profile</span>
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
                </div>
            </div>

        <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>

        <script>
        $(document).ready(function() {

            /*
            var latitude = "";
            var longitude = "";
            if (navigator.geolocation) {
                   navigator.geolocation.getCurrentPosition(function(position) {
                       latitude = position.coords.latitude;
                       longitude = position.coords.longitude;

                        $("#location").html("latitude: " + position.coords.latitude + "<br>longitude: " +  position.coords.longitude);
                        console.log(position.coords.latitude);
                    }, showError);
             }
             */
             console.log(geoplugin_request());
        	var country = geoplugin_countryName();
            $("#country").val(country);
        	var zone = geoplugin_region();
        	var district = geoplugin_city();
        	$("#city").val(district);
        });

        function showError() {
            console.log('Location error');
        }



        </script>
@stop
