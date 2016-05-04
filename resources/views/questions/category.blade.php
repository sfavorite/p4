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
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link href='https://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.2/css/bootcards-desktop.css' type='text/css' rel='stylesheet'>


@stop


@section('content')


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 id="header" class="panel-title">Topic {{ $questions[0]->category->type }}</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
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


    <div id='myModal' class="modal fade in" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <form class="form-horizontal">

            <div class="modal-header">
              <div class="btn-group pull-left">
                <button class="btn btn-danger" data-dismiss="modal">
                  Cancel
                </button>
              </div>
              <div class="btn-group pull-right">
                <button type="submit" class="btn btn-success" onclick="postAnswer()">
                  Vote
                </button>
              </div>

              <h3 id="question" class="modal-title">New Company</h3>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <label  class="col-xs-3 control-label">Question</label>
                <div class="col-xs-9">
                  <input type="text" name="name" class="form-control" placeholder="Company" value="">
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-3 control-label">Type</label>
                <div class="col-xs-9">
                  <select name="type" class="form-control" value="">
                    <option value="" selected="">Select a Type...</option>
                    <option value="Prospect">Prospect</option>
                    <option value="Customer">Customer</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-xs-3 control-label">Location</label>
                <div class="col-xs-9">
                   <input type="text" name="location" class="form-control" placeholder="Location" value="">
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <small class="pull-left">Built with Bootcards - Form Card</small>
              <a href="#" class="btn btn-link btn-xs pull-right">View Source</a>
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

    function showModal(clicked_id) {
        getQuestion(clicked_id);
        jQuery.noConflict();
        $('#myModal').modal('show');
        return false;
    }

    function getQuestion(clicked_id) {
        try {
            $.ajax({
                async: false,
                type: 'GET',
                data: {id: clicked_id},
                url: 'http://p4.scotfavorite.loc/question/',
                cache: false,
                dataType: 'json',

                success: function(data) {
                    if (data['id'] === 'Record not found') {
                        $('#question').text(data['id']);
                    } else {
                        $('#question').text(data['question'])
                    }

                },
                error: function(data) {
                    console.log(data);
                }
            });
        } catch(e) {
            console.log('Something is wrong');
        }

        //$.get('http://p4.scotfavorite.loc/question/2', letMeKnow());
    }

    function letMeKnow() {
        alert('here');
    }

    function postAnswer() {
        try {
            $.ajax({
                async: false,
                type: 'POST',
                url: 'http://p4.scotfavorite.loc/postAnswer/',
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#myModal').modal('hide');
                },
                complete: function() {

                },
                success: function(data) {
                   event.preventDefault();
                    $('#header').text(data);
                },
                error: function(data) {
                    console.log('Error: ', data);
                }
            });
        } catch(e) {
            console.log('Something is wrong');
        }
        return false;
    }


</script>
@stop
