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

<!-- Modal -->

<div style="background-color: grey;">

        <p>Welcome to AnswerMe where you can ask questions and give your opinion.</p>
</div>


@stop

{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
