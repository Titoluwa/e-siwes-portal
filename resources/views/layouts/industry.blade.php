@extends('layouts.app')

@section('home', '(Industry Supervisor)')
{{-- @section('nav')
    <a class="nav-link">Industry Supervisor Dashboard</a>
@endsection --}}

@section('content')
    <div class="container">
        <div class="justify-content-center p-4">
            @yield('industrycontent') 
        </div>
    </div>
@endsection