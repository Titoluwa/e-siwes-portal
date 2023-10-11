@extends('layouts.admin')

@section('title', 'ITCU')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <div class="card-body p-5">
                    {{-- <img class="logo" name="oau" width="50" height="50" src="{{asset('storage/'. Auth::user()->profile_pic)}}" alt=""> --}}
                    <div class="text-center">
                        <img class="logo" name="oau" width="60" height="60" src="{{ asset('images/OAU-Logo.png') }}" alt="">
                        <img class="logo" name="itf" width="60" height="60" src="{{ asset('images/itf_logo_large.png') }}" alt="">
                    </div>
                    <br>
                    <h2 class="text-center">Welcome {{Auth::user()->first_name}}!</h2>
                    <p class="text-center">You're logged in!</p>
                    <p class="text-center">Current Session: <b>{{$current_session->year}}</b></p>
                </div>
                
            </div>
        </div>
    </div>
@endsection
