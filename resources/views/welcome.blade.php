@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="flex-center position-ref full-height">  
                <div class="p-2 content oth-color">
                    <div class="px-5 py-3">
                        <h1 class="display-3 font-weight-bold">OAU e-SIWES Portal</h1>
                        <h3 class="display-5 text-uppercase font-weight-bold">Welcome</h3>
                    </div>    
                    <div class="p-4">
                        <a class="px-2 h5 othe-color" href="{{ route('studentform') }}">STUDENT</a>
                        <a class="px-2 h5 othe-color" href="{{ route('schoolform') }}">INSTITUTION SUPERVISOR</a>
                        <a class="px-2 h5 othe-color" href="{{ route('industryform') }}">INDUSTRY BASED SUPERVISOR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection