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
<link href='https://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.2/css/bootcards-desktop.css' type='text/css' rel='stylesheet'>


@stop


@section('content')

@foreach($questions as $question)
    <div class="bootcards-list">
      <div class="panel panel-default">
        <div class="list-group">
          <a class="list-group-item" href="#">
            <img src="https://randomuser.me/api/portraits/women/76.jpg" class="img-rounded pull-left"/>
            <h4 class="list-group-item-heading">{{ $question->user[0]->name }}</h4>
            <p class="list-group-item-text">{{ $question->question }}</p>
          </a>
        </div>
      </div>
    </div>
@endforeach

@stop

{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
