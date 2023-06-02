@extends('layouts.admin')

@section('title', 'Setup')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <!-- <div class="card-header border-warning bg-othe-color">
                    <h5 class="mt-2">{{ __('Dashboard') }}</h5>
                </div> -->

                <div class="card-body p-5">
                    <h3 class="text-center text-primary">Setup Session</h3>

                    <div class="">
                        <p class="h6"><b> Add Session Year</b></p>

                        <form class="form row" action="" method="POST">
                            @csrf
                            
                            @if(session()->has("message"))
                                <div class="alert alert-primary" role='alert'>
                                    <strong> {{session()->get('message')}} </strong>
                                </div>
                            @endif
                            <div class="form-group col-lg-4">
                                <label class="form-label" for="year">Session: </label>
                                <input class="col-lg-12 form-control" required type="text" name="year" id="year" placeholder="XXXX/XXXX" autocomplete="off">
                            </div>

                            <div class="form-group col-lg-4">
                                <label class="form-label" for="start_date">Session Start Date </label>
                                <input class="col-lg-12 form-control" required type="date" name="start_date" id="start_date">
                            </div>

                            <div class="form-group col-lg-4">
                                <label class="form-label" for="end_date">Session End Date </label>
                                <input class="col-lg-12 form-control" required type="date" name="end_date" id="end_date">
                            </div>
                            
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <br>
                    <br>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-lg-4">Session</th>
                                        <th class="col">Period</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sessions as $session)
                                    <tr>
                                        <td>{{$session->year}}</td>
                                        @if ($session->status == 0)
                                            <td class="text-danger">
                                            <b>Session year is closed!</b>
                                            Started: {{ $session->start_date }}, Ended: {{ $session->end_date }}   
                                            </td>
                                        @else
                                            <td class="text-primary">
                                            Starts: {{ $session->start_date }}, Ends: {{ $session->end_date}} 
                                            &nbsp;<a class="btn btn-sm btn-outline-dark" href=" "><i class="fa fa-edit"></i></a>
                                            
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    {{-- <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card border-primary shadow-sm">
                <div class="card-header">
                   <i class="far fa-calendar"></i> Election Year
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Voting Period</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($election_year as $setup)
                                <tr>
                                    <td>{{$setup->year}}</td>
                                    @if ($setup->status == 0)
                                        <td class="text-danger">
                                        <b>Election year is closed!</b>
                                        Started: {{ $setup->start_date->format('d/m/Y') }}, Ended: {{ $setup->end_date->format('d/m/Y') }}   
                                        </td>
                                    @else
                                        <td class="text-primary">
                                        Starts: {{ $setup->start_date->format('d/m/Y h:i A') }}, Ends: {{ $setup->end_date->format('d/m/Y h:i A') }} 
                                        &nbsp;<a class="btn btn-sm btn-outline-dark" href="{{ route('setup.edit',['setup'=>$setup]) }}"><i class="fa fa-edit"></i></a>
                                        
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 card border-primary mt-5 shadow-sm">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
        
    </div> --}}

@endsection
