@extends('layouts.app')

@section('title', 'Supervisor Register')

@section('content')
<div class="py-5 container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">
                <div class="card-header border-warning">
                    <h3 class="nav-text-color text-center pt-2" style="font-weight: 700;">Industry-based Supervisor Registration</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/register/industry" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="role_id" value="3">
                        
                        <div class="form-group row">
                            <div class="col-lg-7">
                                <label for="email" class="col-form-label">E-Mail Address <small class="text-danger">*</small></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-5">
                                <label for="staff_id" class="col-form-label">Staff ID <small class="text-danger">*</small></label>
                                <input id="staff_id" type="text" class="form-control @error('staff_id') is-invalid @enderror" name="staff_id" value="{{ old('staff_id') }}" required>
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
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="first_name" class="col-form-label">First Name <small class="text-danger">*</small></label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="middle_name" class="col-form-label">Middle Name</label>
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}">
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
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required>
                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="rank" class="col-form-label">Rank/Position</label>
                                <input id="rank" type="text" class="form-control @error('rank') is-invalid @enderror" name="rank" value="{{ old('rank') }}">
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
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="col-form-label" for="profile_pic">Profile Picture </label>
                                <input type="file" class="form-control-file @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                                @error('profile_pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label class="col-form-label"  for="signature">Signature</label>

                                <input type="file" class="form-control-file @error('signature') is-invalid @enderror" id="signature" name="signature">
                                @error('signature')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="contact_no" class="col-form-label">Contact Number <small class="text-danger">(must be 11 digits)*</small></label>
                                <input id="contact_no" type="tel" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" required placeholder="09012345678">
                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="password" class="col-form-label">Password <small class="text-danger">*</small></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="password-confirm" class="col-form-label">Confirm Password <small class="text-danger">*</small></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row col-lg-6">
                            <p class="text-danger">* Required</p>
                        </div>

                        <div class="clearfix">
                            <div class="float-right">
                                <button type="submit" class="btn bg-oth-color nav-text-color">
                                   Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
