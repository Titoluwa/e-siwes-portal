@extends('layouts.app')

@section('homelink', '/admin')

@section('nav')
    <a class="nav-link"> Industrial Training Coordinating Unit ICTU</a>
@endsection

@section('content')
    <div class="container">
        <div class="justify-content-center p-4">
            @yield('admincontent') 
        </div>
    </div>
@endsection