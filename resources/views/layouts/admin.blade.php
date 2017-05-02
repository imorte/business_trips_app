<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} solutions 😎
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ '/' }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Административный раздел</div>
                    @include('partials._notify')
                    <div class="panel-body">
                        <ul class="nav nav-pills">
                            @if(Auth::user()->role->id == 1)
                                <li role="presentation" class="{{ Request::is(getUri(route('companies.index'))) ? 'active' : '' }}">
                                    <a href="{{ route('companies.index') }}">Организации</a>
                                </li>
                                <li role="presentation" class="{{ Request::is(getUri(route('departments.index'))) ? 'active' : '' }}">
                                    <a href="{{ route('departments.index') }}">Отделы</a>
                                </li>
                                <li role="presentation" class="{{ Request::is(getUri(route('cities.index'))) ? 'active' : '' }}">
                                    <a href="{{ route('cities.index') }}">Города</a>
                                </li>
                                <li role="presentation" class="{{ Request::is(getUri(route('employees.index'))) ? 'active' : '' }}">
                                    <a href="{{ route('employees.index') }}">Сотрудники</a>
                                </li>
                            @endif
                            <li role="presentation" class="{{ Request::is(getUri(route('trips.index'))) ? 'active' : '' }}">
                                <a href="{{ route('trips.index') }}">Командировки</a>
                            </li>

                        </ul>
                    </div>
                    <hr>
                    <div class="panel-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
