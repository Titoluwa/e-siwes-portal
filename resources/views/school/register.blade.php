@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="py-5 container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">
                <div class="card-header border-warning">
                    <h3 class="nav-text-color text-center pt-2" style="font-weight: 700;">School Supervisor Registration</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/register/school" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="role_id" value="1">
                        <input type="hidden" name="matric_no" id="matric_no" value="null">
                        <input type="hidden" name="course_of_study" id="course_of_study" value="null">

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="email" class="col-form-label">E-Mail Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="staff_id" class="col-form-label">Staff ID</label>
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
                                <label for="last_name" class="col-form-label">Last Name</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="first_name" class="col-form-label">First Name</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="middle_name" class="col-form-label">Middle Name</label>
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required>
                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="faculty" class="col-form-label">Faculty</label>

                                <input id="faculty" type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" value="{{ old('faculty') }}" required>

                                @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="department" class="col-form-label">Department</label>

                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                 
                        <div class="form-group row"> 
                            <div class="col-lg-4">
                                <label class="col-form-label"  for="profile_pic">Profile Picture</label>

                                <input type="file" class="form-control-file @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                                @error('profile_pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="gender" class="col-form-label">Gender</label>
                                <br>
                                <div class="@error('gender') is-invalid @enderror">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                </div>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="contact_no" class="col-form-label">Contact Number</label>
                                <input id="contact_no" type="tel" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" required>
                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="password" class="col-form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="password-confirm" class="col-form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
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
