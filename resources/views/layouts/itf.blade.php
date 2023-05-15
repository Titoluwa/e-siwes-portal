@extends('layouts.app')

@section('homelink', '/itfagent')

@section('nav')
    <a class="nav-link"> Industrial Training Fund (ITF) Agent</a>
@endsection

@section('content')
    <div class="container">
        <div class="justify-content-center p-4">
            @yield('itfcontent') 
        </div>
    </div>
@endsection