@extends('layouts.master')

@section('content')


    <h1 class="text-center">Profile</h1>

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


                <form method='POST' action='/profile'>
                    {!! csrf_field() !!}
                    <div class='form-group'>
                        <label for='name'>Name</label>
                        <input class="form-control" type='text' name='name' id='name' value='{{ $profile->user->name }}'>
                        <span class="help-block">This is the name displayed to other users</span>
                    </div>

                    <div class='form-group'>
                        <label for='name'>First Name</label>
                        <input class="form-control" type='text' name='first' id='first' value='{{ $profile->first }}'>
                        <span class="help-block">Optional</span>

                    </div>
                    <div class='form-group'>
                        <label for='name'>Last Name</label>
                        <input class="form-control" type='text' name='last' id='last' value='{{ $profile->last }}'>
                        <span class="help-block">Optional</span>
                    </div>

                    <div class='form-group ui-widget'>
                        <label for='name'>Country</label>
                        <input class="form-control" type='text' autocorrect="off" name='country' id='country' value='{{ $profile->country->country }}'>
                        <span class="help-block">Optional</span>

                    </div>

                    <div class='form-group ui-widget'>
                        <label for='name'>City</label>
                        <input class="form-control" type='text' autocorrect="off" name='city' id='city' value='{{ $profile->city->city }}'>
                        <span class="help-block">Optional</span>
                    </div>
                    <div class='form-group'>
                        <label for='email'>Email</label>
                        <input class="form-control" type='text' name='email' id='email' value='{{ $profile->user->email }}'>
                        <span class="help-block">Your email is private and used only to login.</span>
                    </div>
                    <button type='submit' class='btn btn-primary'>Update Profile</button>
                </div>
            </div>


        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="../js/bootstrap.file-input.js"></script>
        <script src="../js/citycountry.js" type="text/javascript"></script>

        <script src="../js/profile.js" type="text/javascript"></script>

@stop
