<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    {{--Design StyleSheet--}}
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link href="{{ asset('assets/css/pagination.css') }}" rel="stylesheet">

    <script type="text/javascript">
        function MM_jumpMenu(targ,selObj,restore){ //v3.0
            eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
            if (restore) selObj.selectedIndex=0;
        }
    </script>
    <noscript><link rel="stylesheet" href="{{ asset('assets/css/noscript.css') }}" /></noscript>

</head>
<body class="is-preload landing">
<div id="page-wrapper">

    <!-- Header -->
    <header id="header">
        <a class="navbar-brand" style="border: none" href="{{ url('/') }}">
            <img src="{{ asset('image/logo.png') }}">
        </a>
        <nav id="nav">
            <ul>
            @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                @role('admin')
                <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                @endrole
                {{--<li><a href="{{ route('roles.index') }}">Manage Role</a></li>--}}
                {{--<li><a href="{{ route('products.index') }}">Manage Product</a></li>--}}
                <li>
                    <a href="#" role="button">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('home.editProfile') }}">My Profile</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
            </ul>
        </nav>
    </header>

    <!-- Content -->

    <section id="banner">
        <div class="content">
        @yield('content')
        </div>
    </section>
</div>
</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrolly.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dropotron.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollex.min.js') }}"></script>
<script src="{{ asset('assets/js/browser.min.js') }}"></script>
<script src="{{ asset('assets/js/breakpoints.min.js') }}"></script>
<script src="{{ asset('assets/js/util.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</html>
