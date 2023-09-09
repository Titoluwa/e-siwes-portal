@extends('layouts.app')

@section('homelink', '/industry')
@section('home', '(Industry Supervisor)')
{{-- @section('nav')
    <a href="" class="nav-link">ITCU</a>
@endsection --}}

@section('nav')
    <a class="nav-link">Industry Supervisor Dashboard</a>
    <!-- @if (!empty($org))
        <a class="nav-link" href="/industry/org/edit">Edit Organisation</a>
    @else
        <a class="nav-link" href="/industry/org">Register Organisation</a>
    @endif
    <a class="nav-link" href="/industry/student">Manage Students</a>
    <a class="nav-link" href="">Edit Profile</a> -->
@endsection

@section('content')
    <div class="container">
        <div class="justify-content-center p-4">
            @yield('industrycontent') 
        </div>
    </div>
@endsection