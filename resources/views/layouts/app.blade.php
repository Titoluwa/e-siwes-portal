<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','OAU e-SIWES Portal')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <link href="/DataTables/datatables.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
    <style>
        body {
            background-image: url('/images/oau-view-3.webp') !important;
            background-color: white;
            position: relative;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            width:100%;
            height:100vh;
            font-family: 'Poppins', sans-serif;
            font-weight: 200;
            margin: 0;
        }
        .show{
            display: inline;
        }
        .hide{
            display: none;
        }
        .sidebar-color{
            background-color: #3EA5DB;
        }
        .nav-color{
            background: #0B2D78;
        }
        .nav-text-color{
            color: #0B2D78;
        }
        .oth-color{
            color: #F9C920;
        }
        .bg-oth-color{
            background: #F9C920;
        }
        .blue-text{
            color: #0B2D78;
        }
        .othe-color{
            color: #F4F0E8;
        }
        .bg-othe-color{
            background: #F4F0E8;
        }
        .display-5{
            font-size: 45px;
        }
        .display-7{
            font-size: 25px;
        }
        .full-height {
            height: 90vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .content {
            background: rgba(62, 165, 219, 0.8);
            border-radius: 5px;
            text-align: center;
        }
        .navv{
            color: white;
            padding: 0 25px;
            font-size: 16px;
            font-weight: 700;
            /* letter-spacing: .1rem; */
            text-decoration: none;
        }
        b{
            font-weight: bold;
        }
        .no-deco:hover{
            text-decoration: none;
        }

        footer{
            background-color: #F4F0E8;
            color: black;
            font-weight: 900;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark nav-color">
            <div class="container navv">
                {{-- @yield('homelink') --}}
                <a class="navbar-brand" href="/">
                    <img class="logo" width="50" height="50"src="{{ asset('images/OAU-Logo.png') }}" alt="">
                </a>
                <a class="navbar-brand" href="{{ url('/') }}">
                    OAU e-SIWES @yield('home','')
                </a>
                @yield('nav')
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto" style="font-weight: 600; color: white;">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Register
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('studentform') }}">
                                            Register as a Student
                                        </a>
                                        <a class="dropdown-item" href="{{ route('schoolform') }}">
                                            Register as a Department Coordinator
                                        </a>
                                        <a class="dropdown-item" href="{{ route('industryform') }}">
                                            Register as an Industry based Supervisor
                                        </a>
                                    </div>
                                </li>
                            @endif
                        @else
                            <li>
                                @if(Auth::user()->profile_pic == NULL)
                                    <img class="logo" name="profile_picture" height="50" src="{{asset('images/user_default.png')}}" alt="profile_img">
                                @else
                                    <img class="logo" name="profile_picture" height="50" src="{{asset('storage/'. Auth::user()->profile_pic)}}" alt="">
                                @endif
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a> --}}
                                    <a class="dropdown-item" href="/logging-out"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logging-out-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logging-out-form" action="/logging-out" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form> --}}
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid">
            @yield('content')
        </main>

        <footer class="fixed-bottom text-center p-2">
            <b>Copyright &copy; 2023 <a href="mailto:titoluwaranti@gmail.com" style="text-decoration: none;">Toluwani&#8482;.</a> All rights reserved.</b>
            {{-- <small>(2023)</small> --}}
        </footer>
    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/js/all.min.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    
    <script src="/DataTables/datatables.min.js"></script>
    <script>
        function hide_alert(){
            $('.alert').addClass('hide');
        }
    </script>

    @yield('scripts')
</body>
</html>
