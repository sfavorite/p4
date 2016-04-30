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
    <script   src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"   integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="   crossorigin="anonymous"></script>

    <!-- Get Bootstrap files from CDN -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- Master Blade CSS -->
    <link rel="stylesheet" href="/css/master.css">

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

</head>
<body>

    <!-- Navigation Bar -->

<!--
        <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="{{ Route::currentRouteNamed('home') ? 'active' : ''}}"><a href="/">Home</a></li>
                    <li class="{{ Route::currentRouteNamed('text') ? 'active' : ''}}"><a href="/text">Text</a></li>
                    <li class="{{ Route::currentRouteNamed('faker') ? 'active' : ''}}"><a href="/faker">Faker</a></li>
                    <li class="{{ Route::currentRouteNamed('profile') ? 'active' : ''}}"><a href="/profile">Profile</a></li>
                    <li class="{{ Route::currentRouteNamed('demo') ? 'active' : ''}}"><a href="/demo">Demo</a></li>
                    <li class="{{ Route::currentRouteNamed('nowhere') ? 'active' : ''}}"><a href="/nowhere">No Where</a></li>

                </ul>
            </div>
        </div>
    </nav>
-->
        <!-- This will be where our content is pulled in on a per page basis -->
        <section>
            {{-- Main page content will be yielded here --}}
            @yield('content')
        </section>


        <footer>
            Scot Favorite &copy; {{ date('Y') }}
        </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')

</body>
</html>
