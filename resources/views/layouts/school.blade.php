@extends('layouts.app')

@section('homelink', '/school')

@section('nav')
    <a class="nav-link">Department Coodinator</a>
@endsection

@section('content')
    <div class="container">
        <div class="justify-content-center p-4">
            @yield('schoolcontent') 
        </div>
    </div>
@endsection