@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <div class="card-header border-warning bg-othe-color">
                    <div class="mt-2">
                        <h3 style="font-weight: 700;">{{ __("LogBook") }}</h3>
                        <p >Fill in your daily activities after each day of training</p>
                    </div>
                </div>

                <div class="card-body border-warning">
                    <h5 class=""><b>{{$student->user->last_name}} {{$student->user->first_name}}</b></h5>
                    <p>dummy text</p>
                    <p>Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

                        - [Simple, fast routing engine](https://laravel.com/docs/routing).
                        - [Powerful dependency injection container](https://laravel.com/docs/container).
                        - Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
                        - Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
                        - Database agnostic [schema migrations](https://laravel.com/docs/migrations).
                        - [Robust background job processing](https://laravel.com/docs/queues).
                        - [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

                        Laravel is accessible, powerful, and provides tools required for large, robust applications.
                    </p>
                    <p>Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

                        - [Simple, fast routing engine](https://laravel.com/docs/routing).
                        - [Powerful dependency injection container](https://laravel.com/docs/container).
                        - Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
                        - Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
                        - Database agnostic [schema migrations](https://laravel.com/docs/migrations).
                        - [Robust background job processing](https://laravel.com/docs/queues).
                        - [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

                        Laravel is accessible, powerful, and provides tools required for large, robust applications.
                    </p>
                </div>
                
            </div>
        </div>
    </div>

@endsection