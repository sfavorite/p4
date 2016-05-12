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
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src='/js/welcome.js'></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


@stop


@section('content')


<div>

    <ul class="error">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    @if(Session::get('message') != null)
        <script src="../js/sessionModal" type="text/javascript"></script>
    @endif


        <div id='sessionModal' class="modal fade in" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" id="voteForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="sessionModal">&times;</button>
                        <h3 id="question" class="modal-title"></h3>
                    </div>


                        <div class="modal-body">
                            <h2 class="text-center">{{ Session::get('message') }}</h2>

                        </div>

                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="btn-group">
                                    <button id="cancel" data-dismiss="modal" class="btn btn-info btn-block">Cancel</button>

                                </div>
                            </div>
                        </div>

                </div>

            </div>
        </div>

    <form role="form" method="POST" action="/newquestion">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="question">Post your question:</label>
                <textarea class="form-control" rows="4" id="question" name="question">{{ old('question') }}</textarea>
            </div>
            <div class="form-group">
                    <select id="options" name="type" class="form-control" value="">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->type }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="form-group">
                    <div id="possibility">
                        <label>Possibilities (max is 5)</label>
                        <div>
                            <input class="form-control" type="text" name="possibility[]" placeholder="Enter a voting possibility...">
                        </div>
                        <label></label>
                        <div>
                            <input class="form-control" type="text" name="possibility[]" placeholder="Enter a voting possibility...">
                        </div>
                    </div>
            </div>

            <a id="add" class="btn btn-info" href="#">Add possibility</a>
            <button id="postQuestion" class="btn btn-primary" type="submit">Submit Question</button>
    </form>

</div>

@stop



{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
<script src="../js/new.js"></script>
@stop
