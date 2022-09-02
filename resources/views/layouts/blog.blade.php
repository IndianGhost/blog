<!DOCTYPE html>
<html lang="{{ app() -> getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet"/>

    <link href="{{ asset('css/style.css?v=4') }}" rel="stylesheet"/>
    @yield('style')
</head>

<body>

<div class="blog-masthead">
    <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item active" href="{{ route('home') }}">Home</a>
            <a class="blog-nav-item" href="#">News</a>
            <a class="blog-nav-item" href="#">Sport</a>
            <a class="blog-nav-item" href="#">Art</a>
            <a class="blog-nav-item" href="#">Politics</a>
            <a class="blog-nav-item" href="#">Science &amp; Technology</a>
            <a class="blog-nav-item" href="#">Members</a>
            <a class="blog-nav-item" href="#">About</a>
            <a class="blog-nav-item pull-right" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                Logout
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </a>
            <a class="blog-nav-item pull-right" href="{{ route('my-profile') }}">{{ Auth::user()->name }}</a>
            <a class="blog-nav-item pull-right" href="{{ route('messages') }}">Inbox</a>
        </nav>
    </div>
</div>

@if (session('status'))
<div class="container">
    <div class="alert alert-success alert-status">
        Lorem ipsum dolor sit amet !
        {{ session('status') }}
    </div>
</div>
@endif

@yield('content')

<footer class="blog-footer">
    <p>© Copyright 2018 | <a href="{{ route('home') }}">{{ config('app.name', '') }}</a> by <a href="https://github.com/IndianGhost" target="_blank">IndianGhost</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        {{--var currentRoute = '{{ $currentRoute }}';--}}
//        alert(currentRoute);
    });
</script>
@yield('javascript')
</body>
</html>