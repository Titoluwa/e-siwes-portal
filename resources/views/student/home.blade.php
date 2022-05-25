@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning">

                <div class="card-header border-warning bg-oth-color">
                    <h5 class="mt-2">{{ __('Dashboard') }}</h5>
                </div>

                <div class="card-body">
                    <h3 class="text-center">Welcome, <b>{{Auth::user()->last_name}}!</b></h3>
                    <p class="text-center">You're logged in</p>  
                </div>
                
            </div>
        </div>
    </div>

@endsection