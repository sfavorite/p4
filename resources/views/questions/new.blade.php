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

    <form role="form" method="POST" action="/newquestion">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="question">Post your question:</label>
                <textarea class="form-control" rows="4" id="question" name="question">{{ old('question') }}</textarea>
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
<script>


        // Add additional possibilities
        $('#add').click(function (event) {
            event.preventDefault();
            // How many textboxes have been added.
            var n = $('.text').length + 1;

            // If this is the first added input put a <br>
            if (n == 1) {
                $('#possibility').append('<br>');

            }
            // Add a new input
            $('#possibility').append('<div><input class="form-control" type="text" name="possibility[]" placeholder="Enter a voting possibility..."><button class="delete btn btn-danger">Delete</button></div><br>');

            // How many boxes do we have...5 should be the max.
            // If so disable the Add possibility button
            if (n > 2) {
                $('#add').attr('disabled', 'disabled');
            };
        });

        $('body').on('click', '.delete', function(event) {
            // Remove the selected input box
            $(this.parent).prev('br').remove();
            $(this.parent).next('br').remove();

            $(this).parent('div').remove();

            // Make sure the Add possibility button is not disabled.
            $('#add').removeAttr('disabled');
            return false;
        });


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



</script>
@stop
