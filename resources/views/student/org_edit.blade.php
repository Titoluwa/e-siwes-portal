@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent clearfix">

                    <div class="float-left mt-2">
                        <h4 style="font-weight: 600;">{{ __("Edit Organization Profile") }}</h4>
                    </div>
                    <div class="float-right mt-1">
                        <a href="/student/org" class="btn bg-oth-color nav-text-color">
                            BACK
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    <form class="form" method="POST" action="/student/org/update">
                        @method('PUT') 
                        @csrf                      

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Student Name</label>
                            <input type="hidden" id="id" name="id" value="{{$student->id}}">
                            <div class="col-md-5">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name()}}" disabled>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="org_name" class="col-md-3 col-form-label">Organization Name</label>
                            <div class="col-md-5">
                                <select class="form-control  @error('org_name') is-invalid @enderror" name="org_name" id="org_name">
                                    <option value="" disabled selected>Select from  database</option>
                                    @foreach($orgs as $org)
                                        <option value="{{$org->id}}" {{$student->org_id == $org->id  ? 'selected' : ''}}>{{$org->name}}</option>
                                    @endforeach
                                </select>
                                @error('org_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="offset-md-10">
                                <button type="submit" class="btn bg-oth-color nav-text-color">
                                <i class="fas fa-edit"></i>SAVE
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection