@extends('layouts.admin')

@section('title', 'View Student')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                
                <div class="card-header border-warning bg-othe-color clearfix">

                    <div class="float-left mt-2 blue-text">
                        <h3 style="font-weight: 700;">{{ $student->user->name() }}</h3> <small><i>({{$current_session->year}})</i></small>
                    </div>
                
                    <div class="float-right">
                        <a href="" data-toggle="modal" data-target="#editStudentModal">
                            <i class="fas fa-edit"></i>EDIT
                        </a>
                        <br>
                        <div class="m-2"><a href="/admin/students" class="btn btn-sm btn-warning">Back</a></div>
                    </div>
                                      
                </div>
                <div class="card-body">
                    <div class="float-left">
                        <h5><b> Personal Information </b></h5>
                    </div>
                    <br>
                    <div class="mt-2">
                        {{-- <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. $student->user->profile_pic)}}" alt="profile image" srcset="" width="150" height="150"> --}}
                        @if ($student->user->profile_pic != null)
                            <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. $student->user->profile_pic)}}" alt="profile image" srcset="" width="150" height="150">
                        @else
                            <img class="rounded border-warning float-right img-thumbnail" src="{{asset('images/user_default.png')}}" alt="profile image" srcset="" width="150" height="150">
                        @endif
                        <div>
                            <p>
                                Registration Number: <b>{{$student->matric_no}}</b>
                            </p>
                            <p>
                                Surname: <b>{{$student->user->last_name}}</b>
                            </p>  
                            <p>
                                Other Names: <b>{{$student->user->first_name}} {{$student->user->middle_name}}</b>
                            </p> 
                            <p>
                                Faculty: <b>{{$student->faculty}}</b>
                            </p> 
                            <p>
                                Department: <b>{{$student->department}}</b>
                            </p>
                            <p>
                                Course of study: <b>{{$student->course_of_study}}</b>
                            </p> 
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h5><b> Other Information </b></h5>
                    @if ($student->org_id == NULL)
                        <div class="text-center blue-text">
                            <h5>This student is not attached to any organization</h5>
                        </div>
                    @else
                       <div class="mt-3">
                            <p>
                                Address during of Industrial Training: <b> {{$student->org->full_address}}</b>
                            </p>
                            <p>
                                Year of Industrial Training: <b> {{$student->year_of_training}}</b>
                            </p>
                            <p>
                                Duration of Industrial Training: <b>{{$student->duration_of_training}}</b>
                            </p> 
                            <p>
                                Signature:
                                <img src="{{asset('storage/'. $student->signature)}}" alt="{{$student->signature}}" width="180" height="30">
                            </p>
                        </div> 
                    @endif
                    
                </div>
                
            </div>

               <!-- MODALS -->
            <!-- Edit Student Modal -->
            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStudentModalLabel"><b><i class="fas fa-edit"></i> Edit Details</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form method="POST" action="" enctype="multipart/form-data" class="m-4">
                            @csrf
           
                            <input type="hidden" name="role_id" value="1">

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label for="email" class="col-form-label">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$student->user->email }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                <label for="matric_no" class="col-form-label">Matric Number</label>
                                    <input id="matric_no" type="text" class="form-control @error('matric_no') is-invalid @enderror" name="matric_no" value="{{ $student->matric_no }}" disabled>

                                    @error('matric_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="last_name" class="col-form-label">Last Name</label>

                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{$student->user->last_name }}">

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label for="first_name" class="col-form-label">First Name</label>
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $student->user->first_name }}">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label for="middle_name" class="col-form-label">Middle Name</label>
                                    <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ $student->user->middle_name }}">
                                    @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="faculty" class="col-form-label">{{ __('Faculty') }}</label>
                                    <select name="faculty" id="faculty" value="{{ $student->faculty }}" class="form-control @error('faculty') is-invalid @enderror" data-dependant='department' >
                                        <option value="" disabled selected hidden>Select Faculty</option>
                                        @foreach($faculty as $f)
                                        <option value="{{ $f->faculty }}">{{ $f->faculty }}</option>
                                        @endforeach
                                    </select>
                                    @error('faculty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label for="department" class="col-form-label">{{ __('Department') }}</label>
                                    <select class="form-control @error('department') is-invalid @enderror" name="department" id="department" data-dependant='course_of_study' value="{{ old('department') }}">
                                        <option value="{{$student->department}}" disabled selected hidden>Select Department</option>
                                    </select>

                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label for="course_of_study" class="col-form-label">Course of Study</label>
                                    <select  id="course_of_study" value="{{$student->course_of_study}}" class="form-control @error('course_of_study') is-invalid @enderror" name="course_of_study" value="{{ old('course_of_study') }}">
                                        <option value="" disabled selected hidden>Select Course</option>
                                    </select>

                                    @error('course_of_study')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="gender" class="col-form-label @error('gender') is-invalid @enderror">Gender</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" selected>
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
                                    <label for="contact_no" class="col-form-label">Contact Number</label>
                                    <input id="contact_no" type="tel" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ $student->user->contact_no }}">
                                    @error('contact_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <div class="col-lg-6">
                                    <label for="password" class="col-form-label">Password</label>
                                    <input id="password" value="{{$student->user->password}}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" disabled>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                <label for="password-confirm" class="col-form-label">Confirm Password</label>
                                    <input id="password-confirm" value="{{$student->user->password}}" type="password" class="form-control" name="password_confirmation" disabled>
                                </div>
                            </div> --}}

                            <div class="clearfix">
                                <div class="float-right">
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
    </div>
@endsection

@section('scripts')
    <script  type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#faculty').change(function(){
                if($(this).val()!= ''){
                    var value = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    console.log(value);
                    $.ajax({
                        url:"{{ route('dept.fetch') }}",
                        method:'POST',
                        data: {value:value, _token:_token},
                        success: function (result)
                        {
                            $('#course_of_study').html('');
                            $('#department').html(result);
                        }
                    });
                }
            });
            $('#department').change(function(){
                if($(this).val()!= ''){
                    var value = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    console.log(value);
                    $.ajax({
                        url:"{{ route('course.fetch') }}",
                        method:'POST',
                        data: {value:value, _token:_token},
                        success: function (result)
                        {
                            $('#course_of_study').html(result);
                        }
                    });
                }
            });
        });
    </script>
@endsection