@extends('layouts.app')

@section('title', 'Student Register')

@section('content')
<div class="py-5 container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-othe-color">
                <div class="bg-othe-color nav-text-color card-header text-center display-7" style="font-weight: 600;">Student Registration</div>

                <div class="card-body">
                    <form method="POST" action="/studentreg">
                        @csrf

                        <input type="hidden" name="role_id" value="0">
                        <input type="hidden" name="staff_id" value="null">
                        

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label">E-Mail Address</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="matric_no" class="col-md-2 col-form-label">Matric Number</label>

                            <div class="col-md-4">
                                <input id="matric_no" type="text" class="form-control @error('matric_no') is-invalid @enderror" name="matric_no" value="{{ old('matric_no') }}" required autocomplete="matric_no" autofocus>

                                @error('matric_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-2 col-form-label">Last Name</label>
                            <div class="col-md-4">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="first_name" class="col-md-2 col-form-label">First Name</label>
                            <div class="col-md-4">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

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
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="middle_name" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="gender" class="col-md-2 col-form-label">Gender</label>
                            <div class="pl-3 form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="faculty" class="col-md-2 col-form-label">Faculty</label>
                            <div class="col-md-4">
                                <input id="faculty" type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" value="{{ old('faculty') }}" required autocomplete="faculty" autofocus>

                                @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="department" class="col-md-2 col-form-label">Department</label>
                            <div class="col-md-4">
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required autocomplete="department" autofocus>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="course_of_study" class="col-md-2 col-form-label">Course of Study</label>
                            <div class="col-md-4">
                                <input id="course_of_study" type="text" class="form-control @error('course_of_study') is-invalid @enderror" name="course_of_study" value="{{ old('course_of_study') }}" required autocomplete="course_of_study" autofocus>

                                @error('course_of_study')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="contact_no" class="col-md-2 col-form-label">Contact Number</label>
                            <div class="col-md-3">
                                <input id="contact_no" type="number" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" required autocomplete="contact_no" autofocus>

                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label">Password</label>
                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="password-confirm" class="col-md-2 col-form-label">Confirm Password</label>
                            <div class="col-md-4">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row py-2">
                            <div class="offset-md-10">
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
