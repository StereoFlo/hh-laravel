<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Starter Template for Bootstrap</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.0/examples/starter-template/starter-template.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role === 'admin')
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin_index') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('admin_user_list') }}" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Users</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="{{ route('admin_user_list') }}">List</a>
                    <a class="dropdown-item" href="{{ route('admin_user_form') }}">Create new</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('admin_weather_list') }}" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cities</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="{{ route('admin_weather_list') }}">List</a>
                    <a class="dropdown-item" href="{{ route('admin_weather_add_city') }}">Create new</a>
                    <a class="dropdown-item" href="{{ route('admin_weather_schedule_list') }}">Schedule list</a>
                    <a class="dropdown-item" href="{{ route('admin_weather_schedule_form') }}">Create schedule</a>
                </div>
            </li>
            @endif
        </ul>
    </div>
</nav>

<main role="main" class="container">
    <div id="app" class="starter-template">
        @yield('content')
    </div>
</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
