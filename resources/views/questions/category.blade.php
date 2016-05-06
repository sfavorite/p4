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

<link href='https://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.2/css/bootcards-desktop.css' type='text/css' rel='stylesheet'>


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
                        <tr class="active"><th>Asked by</th><th>Question</th><th>Votes</th></tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $question)

                            <tr id="{{ $question->id }}" onclick="showModal(this.id)">
                                <td>{{ $question->user[0]->name }}</td><td>{{ $question->question }}</td><td>29393</td>
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

    <div id='myModal' class="modal fade in" role="dialog">
      <div class="modal-dialog">

        <div id="voteForm" class="modal-content">
          <form class="form-horizontal">

            <div class="modal-header">
        {{--      <div class="btn-group pull-left">
                <button class="btn btn-danger" data-dismiss="modal">
                  Cancel
                </button>
              </div>
             --}}
              <div class="btn-group pull-right">
                <button id="vote" type="submit" action="" class="btn btn-success">
                  Vote
                </button>
              </div>

              <h3 id="question" class="modal-title">New Company</h3>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <label class="col-xs-3 control-label">Options</label>
                <div class="col-xs-9">
                  <select id="options" name="type" class="form-control" value="">
                    <option value="" selected="">Give your opinion...</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="modal-footer">
              <small class="pull-left">Built with Bootcards - Form Card</small>
              <a href="/home" class="btn btn-link btn-xs pull-right">Dash board</a>
            </div>

          </form>
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
<script>

    // We will use the question_id when posting an answer so save globally.
    var question_id;

    // For now a place holder
    $(document).ready(function () {

    });

    // Show the 'voting' box as a modal
    function showModal(clicked_id) {
        // We have the 'clicked_id' which is the question_id so save to global
        question_id = clicked_id;
        getQuestion(clicked_id);
        jQuery.noConflict();
        $('#myModal').modal('show');
        return false;
    }

    // Get the question the user clicked on
    function getQuestion(clicked_id) {
        try {
            $.ajax({
                type: 'GET',
                data: {id: clicked_id},
                url: 'http://p4.scotfavorite.loc/question/',
                cache: false,
                dataType: 'json',

                success: function(data) {
                    // If the record wasn't found show the error.
                    if (data['id'] === 'Record not found') {
                        $('#question').text(data['id']);
                    // No error so show the question and options.
                    } else {
                        // Remove any options already in the select and put the fisrt one back.
                        var select = $('#options');
                        select.empty().append('<option value="">Give your opinion...</option>');
                        $('#question').text(data['question'])
                        for (i = 0; i < data.possibility.length; ++i) {
                            var these_options = '<option value="' + data.possibility[i].id + '">' + data.possibility[i].instance + '</option>';
                            $(these_options).appendTo('#options');
                        }
                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });
        } catch(e) {
            console.log('Try ajax get failed');
        }
    }

    // Post the answer the user choose.
    $('#vote').click(function(event) {

        event.preventDefault();

        // Use the global quesiton_id, the option the user choose and our csrf token
        var usersData = { question_id: question_id,
                        possibility_id: $('#options option:selected').val(),
                        '_token': $('meta[name="csrf-token"]').attr('content') };

        try {
            $.ajax({
                type: "POST",
                url: 'http://p4.scotfavorite.loc/answer',
                data: usersData,
                dataType: 'json',
                cache: false,
                success: function(data) {
                    return false;
                },
                error: function(data) {
                    console.log('Error: ', data);
                }
            });
        } catch(e) {
            console.log('Something is wrong');
        }

    });


</script>
@stop
