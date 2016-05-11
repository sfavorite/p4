@extends('layouts.master')


@section('title')
    DBF
@stop

{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific stylesheets.
--}}
@section('head')

<link href="css/profiles.css" rel="stylesheet">

@stop

@section('content')

<div class="container">
    <div class="content">

        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="list-group">
                                        <div>
                                          <div class="panel panel-default">
                                            <div class="list-group">
                                                @foreach($profiles as $profile)
                                                  <a class="list-group-item" href="#" id="{{ $profile->user->id }}">
                                                    <h4 class="list-group-item-heading">
                                                        {{ $profile->user->name  }}</h4>
                                                  </a>
                                                @endforeach
                                            </div>
                                          </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-7 hiddex-xs">
                    <div id="contactCard">
                        <div class="panel panel-default">
                            <div class="list-group">
                                <h2>Musketeer Contact Information</h2>
                                <div class="demo-card">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="img-responsive" id="userName">{{ $profile->first . ' ' . $profile->last  }}</h4>
                                        </div>
                                        <img class="card-img-top profile" src="{{ $profile->image }}" id="largePicture" alt="Users Picture">
                                        <div class="card-block" id="users">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><p class="list-group-item-heading">Email</p>
                                                    <h4 id="email">{{ $profile->user->email }}</h4>
                                                </li>

                                                <li class="list-group-item"><p class="list-group-item-heading">City</p>
                                                    <h4 id="city">{{ $profile->city->city }}</h4>
                                                </li>
                                                <li class="list-group-item"><p class="list-group-item-heading">Home Country</p>
                                                    <h4 id="country">{{ $profile->country->country }}</h4>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script type="text/javascript">var userInfo = <?php if (isset($profiles)) echo json_encode($profiles); ?></script>
<script src="js/profiles.js"></script>

@stop
