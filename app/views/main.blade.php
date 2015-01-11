<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tracker</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
</head>
<body>

<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{{ url('/') }}}">Tracker</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{{ url('torrents') }}}">Torrents</a></li>
                    <li><a href="{{{ url('upload') }}}">Upload</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{{ url('login') }}}">Login</a></li>
                    <li><a href="{{{ url('register') }}}">Register</a></li>
                @else
                    <li><a href="{{{ url('user', array('id' => Auth::user()->id)) }}}">Profile</a></li>
                    <li><a href="{{{ url('logout') }}}">Logout</a></li>
                @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('alert'))
    <div class="alert alert-info" role="alert">
        {{ Session::get('alert') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('error') }}
    </div>
@endif

<div class="content">
    @yield('content')
</div>

<footer>
    <p>&copy; Ieva</p>
    <p><a href="{{{ url ('torrents/rss') }}}">RSS</a></p>
</footer>

<script src="{{ asset('jquery/jquery-2.1.3.js') }}"></script>
<script src="{{ asset('scripts.js') }}"></script>

</body>
</html>