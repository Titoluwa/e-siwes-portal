@extends('layouts.app')

@section('home', '(Industry Supervisor)')
{{-- @section('nav')
    <a class="nav-link">Industry Supervisor Dashboard</a>
@endsection --}}

@section('content')
    <div class="container">
        <div class="justify-content-center p-4">
            @if (\Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <strong>
                        {!! \Session::get('success') !!}
                        <a class="float-right text-success" onclick="hide_alert()" style="text-decoration: none; cursor: default; justify-content:center;">&times;</a>
                    </strong>
                </div>
            @endif
            @if (\Session::has('deleted'))
                <div class="alert alert-danger" role="alert">
                    <strong>
                        {!! \Session::get('deleted') !!}
                        {{-- Deletion Done!! --}}
                        <a class="float-right text-danger" onclick="hide_alert()" style="text-decoration: none; cursor: default; justify-content:center;">&times;</a>
                    </strong>
                </div>
            @endif
            @yield('industrycontent') 
        </div>
    </div>
@endsection