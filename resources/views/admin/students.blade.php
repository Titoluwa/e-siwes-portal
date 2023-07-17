@extends('layouts.admin')

@section('title', 'Students')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <!-- <div class="card-header border-warning bg-othe-color">
                    <h5 class="mt-2">{{ __('Dashboard') }}</h5>
                </div> -->

                <div class="card-body p-3">
                    <h3 class="text-primary">Students <small><i>({{$current_session->year}})</i></small></h3>
                    <div class="float-right">
                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addStudentModal">Add</button>
                    </div>
                    
                    @if(!empty($studs))
                        <div class="table-responsive">
                            <table id="myTable" class="table " style="width:100%">
                                <thead>
                                    <tr>
                                        {{-- <th>Last Name</th> --}}
                                        <th>Name</th>
                                        <th>Matric Number</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Attachment</th>
                                        <th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            {{-- <td></td> --}}
                                            <td><a href="/admin/students/{{$student->user_id}}">{{$student->user->name()}}</a></td> {{-- Link to View  --}}
                                            <td>{{$student->matric_no}} </td>
                                            <td>{{$student->user->email}} </td>
                                            @if ($student->status == 1)
                                                <td class="text-success">Active</td>
                                            @else
                                                <td class="text-danger">Inactive</td>
                                            @endif
                                            @if ($student->org_id == 0)
                                                <td class="oth-color">not attached</td>
                                            @else
                                                <td >{{$student->org->name}}</td>
                                            @endif
                                            
                                            <td>
                                                @if ($student->org_id == 0)
                                                    <button href="/admin/students/log/{{$student->user->id}}" class='btn btn-sm btn-outline-primary' disabled><i class="fa fa-book"></i> Logbook</button>
                                                @else
                                                    <a href="/admin/students/log/{{$student->user->id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a> 
                                                @endif
                                                <a href="" class='btn btn-sm btn-outline-primary'><i class="fa fa-list"></i> Forms</a>
                                                <button type='button' class='btn btn-sm btn-outline-danger delete'><i class="fa fa-trash-alt"></i></button>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="h5 p-3 m-4 text-center">No Registered Student Yet!</p>
                    @endif
                
                </div>
                
            </div>

               <!-- MODALS -->
            <!-- Add Students Modal -->
            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStudentModalLabel"><b><i class="fa fa-plus"></i> Register New Student</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form method="POST" action="/register/student" enctype="multipart/form-data" class="m-4">
                            @csrf
           
                            <input type="hidden" name="role_id" value="1">

                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label for="email" class="col-form-label">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                <label for="matric_no" class="col-form-label">Matric Number</label>
                                    <input id="matric_no" type="text" class="form-control @error('matric_no') is-invalid @enderror" name="matric_no" value="{{ old('matric_no') }}">

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

                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}">

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label for="first_name" class="col-form-label">First Name</label>
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}">
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
                                <div class="col-lg-4">
                                    <label for="faculty" class="col-form-label">{{ __('Faculty') }}</label>
                                    <select name="faculty" id="faculty" value="{{ old('faculty') }}" class="form-control @error('faculty') is-invalid @enderror" data-dependant='department' >
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
                                        <option value="" disabled selected hidden>Select Department</option>
                                    </select>

                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-4">
                                    <label for="course_of_study" class="col-form-label">Course of Study</label>
                                    <select  id="course_of_study" value="{{ old('course_of_study') }}" class="form-control @error('course_of_study') is-invalid @enderror" name="course_of_study" value="{{ old('course_of_study') }}">
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
                                    <input id="contact_no" type="tel" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}">
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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                <label for="password-confirm" class="col-form-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
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

            <!-- View Student Detail Modal -->
            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="viewStudModal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewStudModalLabel"><b><i class="fa fa-id-badge"></i> Student Detail</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                                                
                        <div class="mr-3">
                            <h5><b> Personal Information </b></h5>
                            <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. Auth::user()->profile_pic)}}" alt="profile image" srcset="" width="150" height="150">
                            <div>
                                <p>
                                    Registration Number: <b></b>
                                </p>
                                <p>
                                    Surname: <b></b>
                                </p>  
                                <p>
                                    Other Names: <b></b>
                                </p> 
                                <p>
                                    Faculty: <b></b>
                                </p> 
                                <p>
                                    Department: <b></b>
                                </p>
                                <p>
                                    Course of study: <b></b>
                                </p>
                                <hr>
                                <h5><b> Other Information </b></h5>
                                <p>
                                    Address during of Industrial Training: <b> </b>
                                </p>
                                <p>
                                    Year of Industrial Training: <b> </b>
                                </p>
                                <p>
                                    Duration of Industrial Training: <b></b>
                                </p> 
                                <p>
                                    Signature:
                                    <img src="{{asset('storage/'. $student->signature)}}" alt="{{$student->signature}}" width="180" height="30">
                                </p> 
                            </div>
                        </div>
                        
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