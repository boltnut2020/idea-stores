<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Idea Stores') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script async src="https://cdn.ampproject.org/v0.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Idea Stores') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 order-sm-12 order-12 order-md-1">
                        <div class="list-group">
                            <clock-component></clock-component>
                        </div>
                        <div class="list-group mt-1">
                          <a href="/home" class="list-group-item list-group-item-action {{ (Request::segment(1) == "home") ? "active" : "" }}">
                            Home
                          </a>
                        </div>
                        <div class="list-group mt-1">
                          @hasanyrole('admin|writer')
                          <a href="/memos" class="list-group-item list-group-item-action {{ (Request::segment(1) == "memos") ? "active" : "" }}">Memos</a>
                          <a href="/tags" class="list-group-item list-group-item-action {{ (Request::segment(1) == "tags") ? "active" : "" }}">Tags</a>
                          <!--
                          <a href="/articles" class="list-group-item list-group-item-action {{ (Request::segment(1) == "articles") ? "active" : "" }}">Articles</a>
                          <a href="/categories" class="list-group-item list-group-item-action {{ (Request::segment(1) == "categories") ? "active" : "" }}">Categories</a>
                          -->
                          @endrole
                        </div>

                        @role('admin')
                        <div class="list-group mt-1">
                          <a href="/users" class="list-group-item list-group-item-action {{ (Request::segment(1) == "users") ? "active" : "" }}">Users</a>
                          <a href="/roles" class="list-group-item list-group-item-action {{ (Request::segment(1) == "roles") ? "active" : "" }}">Roles</a>
                        </div>
                        @endrole

                        <div class="list-group mt-1">
                          <a class="list-group-item list-group-item-action" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                               {{ __('Logout') }}
                          </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-6 order-sm-1 order-1 order-md-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
