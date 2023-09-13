@extends('layouts.admin')

@section('title', 'Setup')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                @if(session()->has("message"))
                    <div class="alert alert-warning" role='alert'>
                        <strong> {{session()->get('message')}} </strong>
                    </div>
                @endif
                <div class="card-body p-5">
                    <h3 class="text-center text-primary">Setup Session</h3>

                    <div class="">
                        <p class="h6"><b> Add Session Year</b></p>

                        <form class="form row" action="/admin/setup/store" method="POST">
                            @csrf
                        
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
                                        <th class="col-2">Session</th>
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
                                            <td class="text-success">
                                                <b>Current year: </b>
                                                Starts: {{ $session->start_date }}, Ends: {{ $session->end_date}} 
                                            &nbsp;<a class="btn btn-sm btn-outline-dark" href="/admin/setup/edit/{{$session->id}}"><i class="fa fa-edit"></i></a>
                                            
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
    
@endsection
