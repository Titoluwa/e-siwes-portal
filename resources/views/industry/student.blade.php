@extends('layouts.app')

@section('homelink', '/industry')

@section('nav')
    @if (!empty($org))
        <a class="nav-link" href="/industry/org/edit">Edit Organisation</a>
    @else
        <a class="nav-link" href="/industry/org">Register Organisation</a>
    @endif
    <a class="nav-link" href="/industry/student">Manage Students</a>
@endsection

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card border-warning">

            <div class="card-header border-warning bg-transparent">
                <h4 class="mt-2 text-center">{{ __('Manage student') }}</h4>
            </div>

            <div class="card-body border-warning">
                <div class="p-2">
                    <h5>Students under your organisation</h5>
                    <ul>
                        <li>Tolani</li>
                        <li>Ife</li>
                    </ul>
                </div>
                <div class="p-4 text-center oth-color">
                    <a class="px-2 h5" href="">Add Student</a>
                    <a class="px-2 h5" href="">Check LogBook</a>
                    <a class="px-2 h5" href="">Form 8 (Final form)</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection