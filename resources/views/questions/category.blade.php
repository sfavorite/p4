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

    @if($questions->first())
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 id="header" class="panel-title">Topic {{ $questions[0]->category->type }}</h3>
            </div>
            <div class="table-responsive">
                <table id="quesitonTable" class="table table-hover">
                    <thead>
                        <tr class="active"><th>Asked by</th><th>Question</th></tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)

                            <tr id="{{ $question->id }}" onclick="showModal(this.id)">
                                <td style="background-color:rgb(56, 49, 131); color: white">{{ $question->user[0]->name }}</td><td>{{ $question->question }}</td>
                            <tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <small>{{ $questions->count() }} unanswered {{ $questions[0]->category->type }} questions</small>
            </div>
        </div>
    @else
        You have answered all the current questions in this category.
    @endif


    <div id='questionModal' class="modal fade in" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" id="voteForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 id="question" class="modal-title"></h3>
                </div>

                <form role="form">

                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Options</label>
                            <div class="col-xs-9">
                                <select id="options" name="type" class="form-control" value="">
                                    <option value="" selected="">Give your opinion...</option>
                                </select>
                            </div>
                        </br>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="btn-group">
                                <button id="vote" type="submit" action="" class="btn btn-success btn-block">Vote</button>

                                <button id="cancel" data-dismiss="modal" class="btn btn-info btn-block">Cancel</button>

                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <div id='successModal' class="modal fade in" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" id="voteForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 id="question" class="modal-title"></h3>
                </div>


                    <div class="modal-body">
                        <h2 class="text-center">Success your vote was counted!</h2>

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
@stop



{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
<script src="../js/catquestion.js"></script>
@stop
