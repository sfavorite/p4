@extends('layouts.master')

@section('content')

    <div class="text-center">

        <h2>Already a member. Login and get started!<br>
            <div class="button-spacer"></div>
        </h2>

        <a href="/login" class="btn btn-lg btn-block btn-social btn-primary"><i class="fa fa-envelope"></i>Login with Email</a>

        <a href="/github/authorize" class="btn btn-lg btn-block btn-social btn-github"><i class="fa fa-github"></i>Login with GitHub</a>

        <div class="spacer"></div>

        <h2>Wait...what? You aren't a member yet?</br>
            <div class="button-spacer"></div>
            Sign up now and join us!
        </h2>
        <a href="/email-signup" class="btn btn-lg btn-block btn-social btn-primary"><i class="fa fa-envelope"></i>Sign up with Email</a>
        <a href="/github/authorize" class="btn btn-lg btn-block btn-social btn-github active" title="This is your last signin method"><i class="fa fa-github"></i>Sign up with GitHub</a>
        <hr>
    </div>
@stop
