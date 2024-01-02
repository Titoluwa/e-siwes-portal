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
                        <div class="col-lg-7">
                            <label for="email" class="col-form-label">E-Mail Address <small class="text-danger">*</small></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" disabled>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-5">
                            <label for="staff_id" class="col-form-label">Staff ID <small class="text-danger">*</small></label>
                            <input id="staff_id" type="text" class="form-control @error('staff_id') is-invalid @enderror" name="staff_id" value="{{ $orgsup->staff_id }}" required>
                            @error('staff_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="last_name" class="col-form-label">Last Name <small class="text-danger">*</small></label>
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ Auth::user()->last_name }}" required>
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label for="first_name" class="col-form-label">First Name <small class="text-danger">*</small></label>
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ Auth::user()->first_name }}" required>
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label for="middle_name" class="col-form-label">Middle Name</label>
                            <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ Auth::user()->middle_name }}">
                            @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-lg-5">
                            <label for="department" class="col-form-label">Department <small class="text-danger">*</small></label>
                            <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ $orgsup->department }}" required>
                            @error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="rank" class="col-form-label">Rank/Position</label>
                            <input id="rank" type="text" class="form-control @error('rank') is-invalid @enderror" name="rank" value="{{ $orgsup->rank }}">
                            @error('rank')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="gender" class="col-form-label">Gender <small class="text-danger">*</small></label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" {{ (Auth::user()->gender=="Female")? "checked" : "" }}>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" {{ (Auth::user()->gender=="Male")? "checked" : "" }}>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label class="col-form-label" for="profile_pic">Profile Picture </label>
                            <img src="{{asset('storage/'. Auth::user()->profile_pic)}}" alt="" width="60" height="60">
                            <input type="file" class="form-control-file @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                            @error('profile_pic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label class="col-form-label"  for="signature">Signature</label>
                            <img src="{{asset('storage/'. $orgsup->signature)}}" alt="" width="70" height="40">
                            <input type="file" class="form-control-file @error('signature') is-invalid @enderror" id="signature" name="signature">
                            @error('signature')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label for="contact_no" class="col-form-label">Contact Number <small class="text-danger">(must be 11 digits)*</small></label>
                            <input id="contact_no" type="tel" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="0{{ Auth::user()->contact_no }}" required>
                            @error('contact_no')
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
                