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
<link href='https://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.2/css/bootcards-desktop.css' type='text/css' rel='stylesheet'>


@stop


@section('content')

                <div class="panel panel-default bootcards-summary">
                  <div class="panel-heading">
                    <h3 class="panel-title">{{ $profile->user->name }}</h3>
                  </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form class="form-inline" role="form" action="/dashboard" method='POST'>
                                    {{ csrf_field() }}
                                </form>
                                    <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-4">
                                                    <a class="bootcards-summary-item" href="/questions/any">
                                                        <i class="fa fa-3x fa-users aria-hidden=true"></i>
                                                        <h4>All <span id="0" class="label label-info">{{ $category_count[0] }}</span></h4>
                                                    </a>
                                                </div>

                                                @foreach($categories as $key => $category)
                                                    <div class="col-xs-6 col-sm-4">
                                                        <a class="bootcards-summary-item" href="/questions/{{ $category->type }}">
                                                            <i class="{{ $category->font }} aria-hidden=true"></i>
                                                            <h4> {{ $category->type }} <span id="{{ $key + 1 }}" class="label label-info">{{ $category_count[$key+1] }}</span></h4>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>

                                    </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="panel-body">
                                        <div class="text-center" style="background:rgb(159, 162, 170)">
                                            <p>Ten most recent questions.</p>
                                        </div>
                                    </div>
                            </div>

                        </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <small>Questions</small>
                  </div>
@stop

{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
<script>


    // Once the page is fully loaded start a timer to check
    // for new questions every 1 minute
    $(document).ready(function () {
        setInterval(getQuestionCount, 20000);
    });

    // Get the count of questions by category
    function getQuestionCount() {
        try {
            $.ajax({
                type: 'GET',
                //data: {equality: select.value},
                url: 'http://p4.scotfavorite.loc/questionCount/',
                cache: false,
                dataType: 'json',
                success: function(data) {
                    for (var i = 0; i < data.length; ++i) {
                        $('#' + i).text(data[i]);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        } catch(e) {
            console.log('Ajax get failed');
        }
    }


</script>
@stop
