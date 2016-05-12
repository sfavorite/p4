@extends('layouts.master')

@section('content')

    <div class="text-center">

        <h3>Already a member. Login and get started!<br>
        </h3>
        <div class="button-spacer"></div>

        <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div>
                        <a href="/login" class="btn btn-lg btn-block btn-social btn-primary"><i class="fa fa-envelope"></i>Login with Email</a>

                        <a href="/github/authorize" class="btn btn-lg btn-block btn-social btn-github"><i class="fa fa-github"></i>Login with GitHub</a>
                    </div>
                </div>
            <div class="col-md-3"></div>
        </div>

        <div class="spacer"></div>

        <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-6">

                    <h3>Wait...what? You aren't a member yet?</h3></br>
                        <div class="button-spacer"></div>
                        Sign up now and join us!
                    </h3>
                    <a href="/email-signup" class="btn btn-lg btn-block btn-social btn-primary"><i class="fa fa-envelope"></i>Sign up with Email</a>
                    <a href="/github/authorize" class="btn btn-lg btn-block btn-social btn-github active" title="This is your last signin method"><i class="fa fa-github"></i>Sign up with GitHub</a>
                </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@stop
