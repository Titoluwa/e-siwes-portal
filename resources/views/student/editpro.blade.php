@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent clearfix">

                    <div class="float-left mt-2">
                        <h4 style="font-weight: 600;">{{ __("Edit Student Particular") }}</h4>
                    </div>
                    <div class="float-right mt-1">
                        <a href="/student/profile" class="btn bg-oth-color nav-text-color">
                            BACK
                        </a>
                    </div>

                    
                    
                </div>

                <div class="card-body">
                    <form method="POST" action="/" enctype="multipart/form-data">
                        @csrf                      

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label">E-Mail Address</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$student->user->email}}" disabled>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="matric_no" class="col-md-2 col-form-label">Matric Number</label>

                            <div class="col-md-4">
                                <input id="matric_no" type="text" class="form-control @error('matric_no') is-invalid @enderror" name="matric_no" value="{{$student->user->matric_no}}" disabled>

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
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{$student->user->last_name}}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="first_name" class="col-md-2 col-form-label">First Name</label>
                            <div class="col-md-4">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{$student->user->first_name}}" required autocomplete="first_name" autofocus>

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
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{$student->user->middle_name}}" required autocomplete="middle_name" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="gender" class="col-md-2 col-form-label @error('gender') is-invalid @enderror">Gender</label>
                                <div class="pl-3 form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>

                        <div class="form-group row">
                            <label for="faculty" class="col-md-2 col-form-label">Faculty</label>
                            <div class="col-md-4">
                                <input id="faculty" type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" value="{{$student->user->faculty}}" required autocomplete="faculty" autofocus>

                                @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="department" class="col-md-2 col-form-label">Department</label>
                            <div class="col-md-4">
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{$student->user->department}}" required autocomplete="department" autofocus>

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
                                <input id="course_of_study" type="text" class="form-control @error('course_of_study') is-invalid @enderror" name="course_of_study" value="{{$student->user->course_of_study}}" required autocomplete="course_of_study" autofocus>

                                @error('course_of_study')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="contact_no" class="col-md-2 col-form-label">Contact Number</label>
                            <div class="col-md-4">
                                <input id="contact_no" type="number" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{$student->user->contact_no}}" required autocomplete="contact_no" autofocus>

                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address_of_training" class="col-md-2 col-form-label">Address of IT</label>
                            <div class="col-md-4">
                                <textarea name="address_of_training" id="address_of_training" cols="29" rows="2">{{$student->org->full_address}}</textarea>
                                <!-- <input id="address_of_training" type="text" class="form-control @error('address_of_training') is-invalid @enderror" name="address_of_training" value="{{$student->user->address_of_training}}" required autocomplete="address_of_training" autofocus> -->

                                @error('address_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="year_of_training" class="col-md-2 col-form-label">Year of IT</label>
                            <div class="col-md-4">
                                <!-- <input id="year_of_training" type="number" class="form-control @error('year_of_training') is-invalid @enderror" name="year_of_training" value="" required autocomplete="year_of_training" autofocus> -->
                                <select class="form-control  @error('year_of_training') is-invalid @enderror" name="year_of_training" id="year_of_training">
                                    <option value="" disabled selected>Select Year</option>
                                    <option value="">2021</option>
                                    <option value="">2022</option>
                                    <option value="">2023</option>
                                    <option value="">2024</option>
                                </select>    
                                @error('year_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                         
                        </div>
                        <div class="form-group row">
                            <label for="duration_of_training" class="col-md-2 col-form-label">Duration of IT</label>
                            <div class="col-md-4">
                                <select class="form-control  @error('duration_of_training') is-invalid @enderror" name="duration_of_training" id="duration_of_training">
                                    <option value="" disabled selected>Select Duration</option>
                                    <option value="">3 weeks</option>
                                    <option value="">6 weeks</option>
                                    <option value="">3 months</option>
                                    <option value="">6 months</option>
                                </select>
                                <!-- <input id="duration_of_training" type="number" class="form-control @error('duration_of_training') is-invalid @enderror" name="duration_of_training" value="{{$student->user->duration_of_training}}" required autocomplete="duration_of_training" autofocus> -->

                                @error('duration_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label class="col-form-label col-md-2" for="profile_pic">Profile Picture</label>
                            <div class="col-md-4">
                                <img src="{{asset('storage/'. $student->user->profile_pic)}}" alt="" width="60" height="60">
                                <input type="file" class="@error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                                @error('profile_pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-form-label col-md-2" for="signature">Signature</label>
                            <div class="col-md-4">
                                <!-- <img src="{{asset('storage/'. $student->user->signature)}}" alt="" width="60" height="60"> -->
                                <input type="file" class="@error('signature') is-invalid @enderror" id="signature" name="signature">
                                @error('signature')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        

                        <div class="row py-2">
                            <div class="offset-md-10">
                                <button type="submit" class="btn btn-lg bg-oth-color nav-text-color">
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