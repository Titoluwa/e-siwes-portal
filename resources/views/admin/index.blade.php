@extends('layouts.admin')

@section('title', 'ITCU')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <div class="card-body p-5">
                    <h2 class="text-center">Welcome!</h2>
                    <p class="text-center">You're logged in!</p>
                    <p class="text-center">Current Session: <b>{{$current_session->year}}</b></p>
                </div>
                
            </div>
        </div>
    </div>
@endsection
