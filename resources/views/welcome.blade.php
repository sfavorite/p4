@extends('layouts.master')


@section('title')
    AnswerMe
@stop

{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific stylesheets.
--}}
@section('head')

<script src='/js/welcome.js'></script>
<link href='/css/welcome.css' type='text/css' rel='stylesheet'>

@stop


@section('content')
<!-- Give the application name -->
<div class="container">

    <div class="container">
            <p class="answer">AnswerMe</p>
    </div>

</div>
<!-- Intro Header -->

@stop

{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
