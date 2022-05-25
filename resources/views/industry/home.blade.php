@extends('layouts.app')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card border-warning">

            <div class="card-header border-warning bg-transparent">
                <h5 class="mt-2">{{ __('Dashboard') }}</h5>
            </div>

            <div class="card-body border-warning text-center">
                <h3 class="">Welcome, <b>{{Auth::user()->first_name}}!</b></h3>
                <p class="">You're logged in</p>  
            </div>
            
            
            <div class="p-5 text-center">
                <a class="px-2 h5 oth-color" href="/industry/org">Register Organisation</a>
                <a class="px-2 h5 oth-color" href="/industry/student">Manage Students</a>
            </div>
        </div>
    </div>
</div>
@endsection