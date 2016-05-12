<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        {{-- Yield the title if it exists, otherwise default to 'DBF' --}}
        @yield('title','AnswerMe')
    </title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- JQuery & JQueryUI library -->
    <script src="http://code.jquery.com/jquery-1.12.3.min.js"   integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="   crossorigin="anonymous"></script>
    <script async src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="   crossorigin="anonymous"></script>

    <!-- Get Bootstrap files from CDN -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">


    <link href='https://cdnjs.cloudflare.com/ajax/libs/bootcards/1.1.2/css/bootcards-desktop.css' type='text/css' rel='stylesheet'>

    <!-- Master Blade CSS -->
    <link rel="stylesheet" href="/css/master.css">

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

</head>
<body>

    <!-- fixed top navbar -->
      <div id="navbar" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand no-break-out" title="Customers" href="/">AnswerMe</a>
          </div>
          <button type="button" class="btn btn-default btn-back pull-left hidden" onclick="history.back()">
            <i class="fa fa-lg fa-chevron-left"></i><span>Back</span>
          </button>
          <!-- menu button to show/ hide the off canvas slider -->
          <button type="button" class="btn btn-default btn-menu pull-left offCanvasToggle" data-toggle="offcanvas">
            <i class="fa fa-lg fa-bars"></i><span>Menu</span>
          </button>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if (Auth::guest())
                    <li >
                      <a href="{{ url('/signup') }}">
                        <i class="fa fa-bolt"></i>
                        Get Started
                      </a>
                    </li>


                @else
                  <li class="{{ Route::currentRouteNamed('dashboard') ? 'active' : ''}}">
                    <a href="/dashboard"
                      <i class="fa fa-dashboard"></i>
                      Dashboard
                    </a>
                  </li>
                  <li class="{{ Route::currentRouteNamed('newquestion') ? 'active' : ''}}">
                    <a href="/newquestion">
                      <i class="fa fa-building-o"></i>
                      New Question
                    </a>
                  </li>
                  <li class="{{ Route::currentRouteNamed('myquestons') ? 'active' : ''}}">
                    <a href="/myquestions">
                      <i class="fa fa-folder-open"></i>
                      Your Posts
                    </a>
                  </li>
                  <li class="{{ Route::currentRouteNamed('usersprofiles') ? 'active' : ''}}">
                    <a href="/usersprofiles">
                      <i class="fa fa-clipboard"></i>
                      Users
                    </a>
                </li class="{{ Route::currentRouteNamed('profile') ? 'active' : ''}}">
                  <li>
                    <a href="/profile">
                      <i class="fa fa-cog"></i>
                      Profile
                    </a>
                  </li>
                  <li class="{{ Route::currentRouteNamed('logout') ? 'active' : ''}}">
                    <a href="/logout">
                      <i class="fa fa-sign-out"></i>
                      Logout
                    </a>
                  </li>
              @endif
            </ul>
          </div>
        </div>
    </div>


        <!-- This will be where our content is pulled in on a per page basis -->
        <section>
            <div class="container">
            {{-- Main page content will be yielded here --}}

            @yield('content')
            </div>
        </section>



    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')

</body>


</html>
