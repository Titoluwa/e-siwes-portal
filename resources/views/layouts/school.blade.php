@extends('layouts.app')

@section('home', '(Department Coordinator)')
{{-- @section('nav')
    <a href="/school" class="nav-link"> Department Coordinator</a>
@endsection --}}

@section('content')
    <div class="container">
        <div class="justify-content-center p-2">
            @yield('schoolcontent') 
        </div>
    </div>
@endsection