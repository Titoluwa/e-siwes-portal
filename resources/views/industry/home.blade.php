@extends('layouts.industry')

@section('industrycontent')
    <div class="row">
        <div class="col-lg-5 col-sm-12  p-4">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent blue-text">
                    <h4 class="mt-2"><b>{{ __('Profile') }}</b></h4>
                </div>

                <div class="card-body border-warning text-center">
                    <h5 class="">Welcome, <b>{{Auth::user()->first_name}}!</b></h5>
                    <p class="">You're logged in</p>  
                </div>

                <div class="p-2 text-center">
                   <p>Employee at <b>{{$org->name}}</b> </p>
                   <p>{{Auth::user()->department}} Department</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-12  p-4">
            <div class="card border-warning">

                <div class="card-header border-warning bg-transparent blue-text clearfix mt-2 ">
                    <div class="float-left">
                        <h4 class=""><b>{{ __('Organisation') }}</b> </h4>
                    </div>
                    <div class="float-right">
                        @if (!empty($org))
                            <a class="h4" href="/industry/org/edit"> <h4><i class="fas fa-edit"></i></h4></a>
                        @else
                            <a class="h4" href="/industry/org"><i class="fas fa-edit"></i>Register</a>
                        @endif
                    </div>
                    
                </div>

                <div class="card-body border-warning">
                    <div class="p-2">
                        <p class=""><b>Details</b></p>
                        <p>{{$org->name}}</p>
                        <p>{{$org->full_address}}</p>
                        <p>{{$org->postal_address}}</p>
                        
                    </div>
                </div>  
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 p-4">
            <div class="card border-warning">

                <div class="card-header border-warning bg-transparent blue-text">
                    <h4 class="mt-2"><b>{{ __('Manage Student') }}</b> </h4>
                </div>

                <div class="card-body border-warning">
                    <div class="p-2">
                        <div class="">
                            <a class="pr-3" href="">Add Student</a>
                            <a class="pr-3" href="">Check LogBook</a>
                            <a class="pr-3" href="">Form 8 (Final form)</a>
                        </div>

                        <h5 class="pt-2">Students under your organisation</h5>
                            <ul>
                                <li>Tolani</li>
                                <li>Ife</li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row p-4">
        <div class="col-md-12">
            <div class="card border-warning">

                <div class="card-header border-warning bg-transparent">
                    <h5 class="mt-2">{{ __('Manage Student') }}</h5>
                </div>

                <div class="card-body border-warning">
                    <div class="p-2">
                        <div class="">
                            <a class="pr-3" href="">Add Student</a>
                            <a class="pr-3" href="">Check LogBook</a>
                            <a class="pr-3" href="">Form 8 (Final form)</a>
                        </div>

                        <h5 class="pt-2">Students under your organisation</h5>
                            <ul>
                                <li>Tolani</li>
                                <li>Ife</li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    

@endsection