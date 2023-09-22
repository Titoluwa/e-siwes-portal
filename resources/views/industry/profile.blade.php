@extends('layouts.industry')

@section('title', 'Edit Profile')

@section('industrycontent')
<div class="col-md-12">
        <div class="card border-warning">

            <div class="card-header border-warning bg-transparent blue-text clearfix mt-2">
                <div class="float-left pt-1">
                    <h4 class=""><b>{{ __('Edit Profile') }}</b> </h4>
                </div>
                <div class="float-right pb-2">
                    <a class="btn btn-outline-warning blue-text" href="/industry"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>

            <div class="card-body border-warning">
                <form method="POST" action="/industry/profile/update" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="id" value="{{Auth::user()->id}}">
                    <!-- <input type="hidden" name="matric_no" id="matric_no" value="NULL">
                    <input type="hidden" name="faculty" id="faculty" value="NULL">
                    <input type="hidden" name="course_of_study" id="course_of_study" value="NULL"> -->

                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">E-Mail Address</label>

                        <div class="col-md-4">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}" disabled>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="staff_id" class="col-md-2 col-form-label">Staff ID</label>
                        <div class="col-md-4">
                            <input id="staff_id" type="text" class="form-control @error('staff_id') is-invalid @enderror" name="staff_id" value="{{$orgsup->staff_id}}">

                            @error('staff_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="form-group row">
                        <label for="last_name" class="col-md-2 col-form-label">Last Name</label>
                        <div class="col-md-4">
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{Auth::user()->last_name}}">

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="first_name" class="col-md-2 col-form-label">First Name</label>
                        <div class="col-md-4">
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{Auth::user()->first_name}}">

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                                            
                    <div class="form-group row">
                        <label for="middle_name" class="col-md-2 col-form-label">Middle Name</label>
                        <div class="col-md-4">
                            <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{Auth::user()->middle_name}}">

                            @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="gender" class="col-md-2 col-form-label">Gender</label>
                        <div class="pl-3 form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="Male" value="Female" {{ (Auth::user()->gender=="Female")? "checked" : "" }}>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" {{ (Auth::user()->gender=="Male")? "checked" : "" }}>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="department" class="col-md-2 col-form-label">Department</label>
                        <div class="col-md-4">
                            <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{$orgsup->department}}">

                            @error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="contact_no" class="col-md-2 col-form-label">Contact Number</label>
                        <div class="col-md-4">
                            <input id="contact_no" type="number" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{Auth::user()->contact_no}}">

                            @error('contact_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2" for="profile_pic">Profile Picture</label>
                        <div class="col-md-4">
                            <img src="{{asset('storage/'. Auth::user()->profile_pic)}}" alt="" width="60" height="60">
                            <input type="file" class="form-control-file @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                            @error('profile_pic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                      

                    <div class="row py-2">
                        <div class="offset-md-10">
                            <button type="submit" class="btn bg-oth-color nav-text-color">
                                UPDATE
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
                