@extends('layouts.admin')

@section('title', 'Setup')

@section('admincontent')
<div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="col-md-8 card border-primary p-4 shadow-sm">
                <div class="card-body">
                    <p class="h4 text-primary text-center"> Date for the <b>{{ $setup->year }}</b> session</p>
                        @if(session()->has("message"))
                        <div class="alert alert-primary" role='alert'>
                            <strong> {{session()->get('message')}} </strong>
                        </div>
                        @endif
                        @if(! session()->has("message"))
                        <form class="form" action="/admin/setup/update" method="POST">
                            @method("PUT")
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="year">Year: </label>
                                <input class="col-md-12 form-control" type="text" name="year" id="year" value="{{ $setup->year }}">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="start_date">Session Start Date </label>
                                <input class="col-md-12 form-control" type="date" name="start_date" id="start_date" value="{{ $setup->start_date}}">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="end_date">Session End Date </label>
                                <input class="col-md-12 form-control" type="date" name="end_date" id="end_date"  value="{{ $setup->end_date}}">
                            </div>
                            
                            <div class="float-right">
                            <button type="submit" class="btn btn-outline-primary">
                                {{ __('Change') }}
                            </button>
                            </div>
                            
                        </form>
                        @endif
                </div>
            </div>
        </div>
        
    </div>
@endsection 