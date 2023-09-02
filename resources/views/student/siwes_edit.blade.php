@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent clearfix">

                    <div class="float-left mt-2">
                        <h4 style="font-weight: 600;">Edit {{$siwes->siwes_type->name}} Details</h4>
                    </div>
                    <div class="float-right mt-1">
                        <a href="/student/org" class="btn bg-oth-color nav-text-color">
                            Back
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    <form class="form" method="POST" action="/student/siwes/update">
                        @method('PUT') 
                        @csrf                      
                        {{-- <input type="hidden" id="id" name="id" value="{{$student->id}}"> --}}
                        <input type="hidden" name="siwes_id" value="{{$siwes->id}}">
                        

                        <div class="form-group row">
                            <label for="org_id" class="col-md-4 col-form-label">Organization Name</label>
                            <div class="col-md-6">
                                <select class="form-control  @error('org_id') is-invalid @enderror" name="org_id" id="org_id">
                                    <option value="" disabled selected>Select from  database</option>
                                    @foreach($orgs as $org)
                                        <option value="{{$org->id}}" {{$siwes->org_id == $org->id  ? 'selected' : ''}}>{{$org->name}}</option>
                                    @endforeach
                                </select>
                                @error('org_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="session_id" class="col-md-4 col-form-label">Session for {{$siwes->siwes_type->name}}</label>
                            <div class="col-md-6">
                                <select class="form-control  @error('session_id') is-invalid @enderror" name="session_id" id="session_id">
                                    <option value="" disabled selected>Select Session</option>
                                    @foreach($sessions as $session)
                                        <option value="{{$session->id}}" {{$siwes->session_id == $session->id  ? 'selected' : ''}}>{{$session->year}}</option>
                                    @endforeach
                                </select>
                                @error('session_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="resumption_date" class="col-md-4 col-form-label">Resumption Date</label>
                            <div class="col-md-6">
                                <input class="form-control @error('resumption_date') is-invalid @enderror" type="date" value="{{$siwes->resumption_date}}" name="resumption_date" id="resumption_date">
                                @error('resumption_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ending_date" class="col-md-4 col-form-label">Ending Date</label>
                            <div class="col-md-6">
                                <input class="form-control  @error('ending_date') is-invalid @enderror" value="{{$siwes->ending_date}}" type="date" name="ending_date" id="ending_date">
                                @error('ending_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="year_of_training" class="col-md-4 col-form-label">Year of SIWES</label>
                            <div class="col-md-6">
                                
                                <select class="form-control  @error('year_of_training') is-invalid @enderror" name="year_of_training" id="year_of_training">
                                    <option value="" disabled selected>Select Year</option>
                                    <option value="2021" {{$siwes->year_of_training == 2021  ? 'selected' : ''}} >2021</option>
                                    <option value="2022" {{$siwes->year_of_training == 2022  ? 'selected' : ''}} >2022</option>
                                    <option value="2023" {{$siwes->year_of_training == 2023  ? 'selected' : ''}} >2023</option>
                                    <option value="2024" {{$siwes->year_of_training == 2024  ? 'selected' : ''}} >2024</option>
                                </select>    
                                @error('year_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                         
                        </div>
                        <div class="form-group row">
                            <label for="duration_of_training" class="col-md-4 col-form-label">Duration of SIWES</label>
                            <div class="col-md-6">
                                <select class="form-control  @error('duration_of_training') is-invalid @enderror" name="duration_of_training" id="duration_of_training">
                                    <option value="" disabled selected>Select Duration</option>
                                    <option value="3 weeks" {{$siwes->duration_of_training == '3 weeks'  ? 'selected' : ''}} >3 weeks</option>
                                    <option value="6 weeks" {{$siwes->duration_of_training == '6 weeks'  ? 'selected' : ''}} >6 weeks</option>
                                    <option value="3 months" {{$siwes->duration_of_training == '3 months'  ? 'selected' : ''}} >3 months</option>
                                    <option value="6 months" {{$siwes->duration_of_training == '6 months'  ? 'selected' : ''}} >6 months</option>
                                </select>
                                @error('duration_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="offset-md-10">
                                <button type="submit" class="btn bg-oth-color nav-text-color">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection