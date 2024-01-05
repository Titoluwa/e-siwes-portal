@extends('layouts.app')

@section('home', '(Department Coordinator)')
{{-- @section('nav')
    <a href="/school" class="nav-link"> Department Coordinator</a>
@endsection --}}

@section('content')
    <div class="container">
        <div class="justify-content-center p-2">
            @if (\Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <strong>
                        {!! \Session::get('success') !!}
                        <a class="float-right text-success" onclick="hide_alert()" style="text-decoration: none; cursor: default; justify-content:center;">&times;</a>
                    </strong>
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    <strong>
                        {!! \Session::get('error') !!}
                        {{-- Deletion Done!! --}}
                        <a class="float-right text-danger" onclick="hide_alert()" style="text-decoration: none; cursor: default; justify-content:center;">&times;</a>
                    </strong>
                </div>
            @endif
            @yield('schoolcontent') 
        </div>
    </div>
@endsection