@extends('layouts.admin')

@section('title', 'Staffs')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning">
                
                <div class="card-body p-3">
                    <h3 class="text-primary">Department Coodinators</h3>
                    <div class="float-right mb-3">
                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addstaffModal"><i class="fas fa-user-plus"></i> Add</button>
                    </div>
                    
                    @if(!empty($staff))
                        <div class="table-responsive">
                            <table id="staffTable" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        {{-- <th>S/N</th> --}}
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Visting Students</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staffs as $staff)
                                        <tr>
                                            {{-- <td>{{$loop->index + 1}}</td> --}}
                                            <td><a href="mailto:{{$staff->user->email}}">{{$staff->user->name()}}</a></td>
                                            <td>{{$staff->department}}</td>
                                            <td>{{$staff->assignedStudentCount()}}</td>
                                            <td style="display: inline-flex">
                                                <a class='m-1 btn btn-sm btn-outline-dark' data-toggle="modal" data-target="#viewstaffModal" onclick="get_staff({{$staff->id}})"><i class="far fa-eye"></i> View</a>
                                                <a class='m-1 btn btn-sm btn-outline-primary' data-toggle="modal" data-target="#editstaffModal" onclick="get_staff({{$staff->id}})"><i class="fa fa-edit"></i> Edit</a>
                                                {{-- <a class='m-1 btn btn-sm btn-outline-dark' data-toggle="modal" data-target="#viewAssignedModal" onclick="assigned_student({{$staff->id}})"><i class="fa fa-eye"></i> Students</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="h5 p-3 m-4 text-center">No Staff Registered!</p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>

{{-- MODALS --}}
    
{{-- Add STAFF User Modal --}}
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addstaffModal" tabindex="-1" role="dialog" aria-labelledby="addstaffmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addstaffmodalLabel"><b><i class="fas fa-user-plus"></i> Add Department Coordinator </b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                                        
                <div class="m-3 p-2">
                    <form method="POST" action="/register/school" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="role_id" value="2">

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="email" class="col-form-label">E-Mail Address <small class="text-danger">*</small></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="staff_id" class="col-form-label">Staff ID</label>
                                <input id="staff_id" type="text" class="form-control @error('staff_id') is-invalid @enderror" name="staff_id" value="{{ old('staff_id') }}">
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
                            <div class="col-lg-6">
                                <label for="faculty" class="col-form-label">{{ __('Faculty') }} <small class="text-danger">*</small></label>
                                <select name="faculty" id="faculty" value="{{ old('faculty') }}" class="form-control @error('faculty') is-invalid @enderror" data-dependant='department' required>
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

                            <div class="col-lg-6">
                                <label for="department" class="col-form-label">{{ __('Department') }} <small class="text-danger">*</small></label>
                                <select class="form-control @error('department') is-invalid @enderror" name="department" id="department" value="{{ old('department') }}" required>
                                    <option value="" disabled selected hidden>Select Department</option>
                                </select>

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

                                <input type="file" class="form-control-file @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic" accept="image/png, image/jpeg">
                                @error('profile_pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="gender" class="col-form-label">Gender <small class="text-danger">*</small></label>
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
                                <label for="contact_no" class="col-form-label">Contact Number <small class="text-danger">*</small></label>
                                <input id="contact_no" type="tel" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" required placeholder="08012345678" pattern="[0-9]{11}" title="must be 11 digits">
                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label"  for="signature">Signature</label>

                                <input type="file" class="form-control-file @error('signature') is-invalid @enderror" id="signature" name="signature" accept="image/png, image/jpeg">
                                @error('signature')
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

{{-- View Staff  --}}
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="viewstaffModal" tabindex="-1" role="dialog" aria-labelledby="viewstaffmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewstaffmodalLabel"><b><i class="fas fa-user"></i> View <span id="staff"></span></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                                        
                <div class="m-3 p-2">
                    <p>Name: <b id="staff_name"></b></p>
                    <p>Identification Number: <b id="staff_ide"></b></p>
                    <p>Email: <b id="staff_email"></b></p>
                    <P>Contact Number: <b id="staff_contact_no"></b></P>
                    <p>Faculty: <b id="staff_faculty"></b></p>
                    <p>Department: <b id="staff_department"></b></p>
                    <p>Student(s)</p>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Matric Number</th>
                                    <th>Organization</th>
                                    <th>Department</th>
                                    <th>Contact Info</th>
                                </tr>
                            </thead>
                            <tbody id="students_body">

                            </tbody>
                        </table>
                </div>
                
            </div>
        </div>
    </div>
    </div>  

{{-- Edit STAFF User Modal --}}
    {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div> --}}
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="editstaffModal" tabindex="-1" role="dialog" aria-labelledby="editstaffModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editstaffmodalLabel"><b><i class="fas fa-edit"></i> Edit <span id='edit_name'></span> </b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                                        
                <div class="modal-body">
                    <form method="POST" action="/admin/staff/update" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" id="edit_id">

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="email" class="col-form-label">E-Mail Address <small class="text-danger">*</small></label>
                                <input id="edit_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" disabled>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="staff_id" class="col-form-label">Staff ID</label>
                                <input id="edit_staff_id" type="text" class="form-control @error('staff_id') is-invalid @enderror" name="staff_id" value="{{ old('staff_id') }}">
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
                                <input id="edit_last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="first_name" class="col-form-label">First Name <small class="text-danger">*</small></label>
                                <input id="edit_first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="middle_name" class="col-form-label">Middle Name</label>
                                <input id="edit_middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}">
                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="faculty" class="col-form-label">{{ __('Faculty') }} <small class="text-danger">*</small></label>
                                <select name="faculty" id="edit_faculty" value="{{ old('faculty') }}" class="form-control @error('faculty') is-invalid @enderror" data-dependant='department' required>
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

                            <div class="col-lg-6">
                                <label for="department" class="col-form-label">{{ __('Department') }} <small class="text-danger">*</small></label>
                                <select class="form-control @error('department') is-invalid @enderror" name="department" id="edit_department" value="{{ old('department') }}" required>
                                    <option value="" disabled selected hidden>Select Department</option>
                                    @foreach ($depts as $d)
                                    <option value="{{ $d->department }}">{{ $d->department }}</option>
                                    @endforeach
                                </select>

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

                                <input type="file" class="form-control-file @error('profile_pic') is-invalid @enderror" id="edit_profile_pic" name="profile_pic" accept="image/png, image/jpeg">
                                @error('profile_pic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="gender" class="col-form-label">Gender <small class="text-danger">*</small></label>
                                <br>
                                <div class="@error('gender') is-invalid @enderror">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="edit_female" value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="edit_male" value="Male">
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
                                <label for="contact_no" class="col-form-label">Contact Number <small class="text-danger">*</small></label>
                                <input id="edit_contact_no" type="tel" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" disabled>
                                @error('contact_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label"  for="signature">Signature</label>

                                <input type="file" class="form-control-file @error('signature') is-invalid @enderror" id="edit_signature" name="signature" accept="image/png, image/jpeg">
                                @error('signature')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

@endsection

@section('scripts')
    <script  type="text/javascript">
        new DataTable('#staffTable');
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
                            $('#department').html(result);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        
        function get_staff(id){
            $.get('/admin/staffs/'+id, function(data)
            {
                console.log(data);
                $('#staff').html(data.staff.user.last_name + " " + data.staff.user.first_name);
                $('#staff_name').html(data.staff.user.last_name + " " + data.staff.user.first_name + " " + data.staff.user.middle_name);
                $('#staff_ide').html(data.staff.staff_id);
                $('#staff_contact_no').html('0'+data.staff.user.contact_no);
                $('#staff_email').html(data.staff.user.email);
                $('#staff_faculty').html(data.staff.faculty);
                $('#staff_department').html(data.staff.department);
                $('#edit_name').html(data.staff.user.last_name + " " + data.staff.user.first_name);

                $('#edit_id').val(data.staff.user.id);
                $('#edit_first_name').val(data.staff.user.first_name);
                $('#edit_last_name').val(data.staff.user.last_name);
                $('#edit_middle_name').val(data.staff.user.middle_name);
                $('#edit_staff_id').val(data.staff.staff_id);
                $('#edit_contact_no').val('0'+data.staff.user.contact_no);
                $('#edit_email').val(data.staff.user.email);
                $('#edit_faculty').val(data.staff.faculty);
                $('#edit_department').val(data.staff.department);
                if (data.staff.user.gender == 'Male') {
                    $('#edit_male').attr('checked', 'checked');
                } else if (data.staff.user.gender == 'Female') {
                    $('#edit_female').attr('checked', 'checked');
                };
                $('#students_body').html(" ");

                $.each(data.students, function(index, val)
                {
                    $('#students_body').append(`
                        <tr>
                            <td>${val.user.last_name}`+ " " +` ${val.user.first_name}</td>
                            <td>${val.student.matric_no}</td>
                            <td>${val.org.name}</td>
                            <td>${val.student.department}</td>
                            <td>0${val.user.contact_no}</td>
                        </tr>
                    `);
                });

                // $.each(data.students, function(index, val)
                // {
                    
                //     $('#student_body').append(`
                //         <tr>
                //             <td>${val.user.last_name}`+ " " +` ${val.user.first_name}</td>
                //             <td>${val.matric_no}</td>
                //             <td>${val.department}</td>
                //         </tr>
                //     `);
                // });
            })
        };
    </script>
@endsection