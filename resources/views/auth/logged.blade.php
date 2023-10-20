<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login</title>


        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                font-family: 'Poppins', sans-serif;
                /* font-weight: 200; */
                
            }
            .imgg{
                padding: 0px;
            }
            .bg-imgg{
                background-image: url('images/view-oau.jpg');
                position: relative;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                width:100%;
                height:100vh;
            }
            .logo{
                width: 140px;
                height: 140px;
            }
        .bg-othe-color{
            background: #F4F0E8;
        }
            /* color:#F9C920; */
            /* color:#0B2D78; */

        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-5 imgg">
                    <div class="bg-imgg"></div>
                    <!-- <img class="img-fluid" src="{{ asset('images/ES.webp') }}" alt="login image"> -->
                </div>
                <div class="col-lg-5 col-md-6 col-sm-7 bg-othe-color pt-5">
                    <div class="text-center pt-5">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img class="logo" src="{{ asset('images/OAU-Logo.png') }}" alt="">
                        </a>
                    </div>
                    <div class="text-center">
                        <h4 class="pt-3 font-weight-bolder" style="color:#0B2D78;">OBAFEMI AWOLOWO UNIVERSITY</h4>
                        <h5 class="font-weight-bold" style="color:#F9C920;">e-SIWES Portal</h5>
                    </div>
                    <div class="text-center p-3">
                        <div class="alert alert-danger" role='alert'>
                            <b class=""> Already Logged in!! </b>
                        </div>
                    </div>
                    <div class="pt-3 text-center">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                                <div class="form-group row">
                                    <div class="col-md-2"></div>
                                    <div class="text-center col-md-8">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="E-mail Address">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>

                                <div class="form-group row pt-2">
                                    <div class="col-md-2"></div>
                                    <div class="text-center col-md-8">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">

                                        <!-- <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Password"> -->

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 pt-2">
                                        <button type="submit" class="btn btn-warning">
                                            Login
                                        </button>
                                    </div>

                                    <div class="col-md-12 pt-3">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                               <em>Forgot Your Password?</em>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>