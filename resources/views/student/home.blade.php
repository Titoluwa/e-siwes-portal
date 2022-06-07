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
                    @if (!empty($student))
                        <p class="text-center">Working at <b>{{$student->org->name}}</b></p>  
                    @else
                        <p class="text-center"><b>Add Organization to profile</b></p>

                        <form class="form" action="/student/org/add" method="POST">
                            @csrf

                            <div class="form-group row justify-content-center">
                                <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <label for="org_id" class="text-center col-form-label">Organization Name</label>
                                        <div class="">
                                            <select class="form-control  @error('org_id') is-invalid @enderror" name="org_id" id="org_id">
                                                <option value="" disabled selected>Select from  database</option>
                                                @foreach($orgs as $org)
                                                    <option value="{{$org->id}}">{{$org->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('org_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn bg-oth-color nav-text-color">ADD</button>
                                </div>
                            </div>
                        </form>
                    @endif 

                </div>
                
            </div>
        </div>
    </div>

@endsection