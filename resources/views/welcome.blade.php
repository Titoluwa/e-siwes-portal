<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-image: url('images/E.webp');
                position: relative;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                width:100%;
                height:100vh;
                font-family: 'Poppins', sans-serif;
                font-weight: 200;
                margin: 0;
            }
            .nav-color{
                background: #0B2D78;
            }
            .oth-color{
                color:#F9C920;
            }
            .othe-color{
                color: #F4F0E8;
            }
            .display-5{
                font-size: 45px;
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                background: rgba(62, 165, 219, 0.8);
                /* background: rgba(244, 240, 232, 0.8); */
                /* border-radius: 10px; */
                /* background-color: #3EA5DB; */
                text-align: center;
            }
            /* .logo{
                width: 20px;
                height: 20px;
            } */
            
            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark nav-color">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" width="75" height="75" src="{{ asset('images/OAU-Logo.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-brand navbar-nav ml-auto text-uppercase font-weight-bolder">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            <!-- @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif -->
        </nav>
        <div class="flex-center position-ref full-height">  

            <div class="p-3 content oth-color">
                <div class="px-5 py-3">
                    <h1 class="display-3 font-weight-bold">OAU e-SIWES Portal</h1>
                    <h3 class="display-5 text-uppercase font-weight-bold">Welcome</h3>
                </div>    
                <div class="p-4">
                    <a class="px-2 h5 othe-color" href="http://">Register as a STUDENT</a>
                    <a class="px-2 h5 othe-color" href="http://">Register as a SCHOOL SUPERVISOR</a>
                    <a class="px-2 h5 othe-color" href="http://">Register as a INDUSTRY BASED SUPERVISOR</a>
                </div>
            </div>
        </div>
    </body>
</html>
