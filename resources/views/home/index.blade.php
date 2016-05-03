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

<div class="panel panel-default bootcards-summary">
  <div class="panel-heading">
    <h3 class="panel-title">Unread answered questions by topic</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-xs-6 col-sm-4">
            <a class="bootcards-summary-item" href="#">
                <i class="fa fa-3x fa-users"></i>
                <h4>All <span class="label label-info">{{ end($category_count) }}</span></h4>
            </a>
        </div>

        @foreach($categories as $key => $category)
            <div class="col-xs-6 col-sm-4">
                <a class="bootcards-summary-item" href="#">
                    <i class="{{ $category->font }}"></i>
                    <h4> {{ $category->type }} <span class="label label-info">{{ $category_count[$key] }}</span></h4>
                </a>
            </div>
        @endforeach
    </div>
  </div>
  <div class="panel-footer">
    <small>Questions</small>
  </div>
</div>

@stop

{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')

@stop
