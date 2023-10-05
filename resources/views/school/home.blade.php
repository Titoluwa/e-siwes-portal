@extends('layouts.school')

@section('title', 'Department Coordinator')


@section('schoolcontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header bg-oth-color">
                    <a class="blue-text" style="text-decoration-line: none" onclick="dashboard()"><i class="fas fa-clipboard"></i> Dashboard</a>
                    <a class="blue-text ml-3" style="text-decoration-line: none" onclick="materials()"><i class="fa fa-copy"></i> Lecture Notes</a>
                    <a class="blue-text ml-3" style="text-decoration-line: none" onclick="board()"><i class="fa fa-chalkboard"></i> Notice Board</a>
                    {{-- <a class="blue-text ml-3"  data-toggle="modal" data-target="#getStudentModal" style="text-decoration-line: none"><i class="fas fa-user-friends"></i> All Students</a> --}}
                    <div class="float-right">
                        <a href="" data-toggle="modal" data-target="#getStudentModal" class="blue-text" style="text-decoration-line: none"><i class="fas fa-user-friends"></i> All Students</a>
                    </div>
                </div>

                <div class="card-body my-5">
                    <div id="dashboard" style="display: block;">
                        <div class="text-center">
                            <b><h3>Welcome, {{Auth::user()->name()}}</h3></b>
                            You are logged in!
                        </div>
                        <div class="m-3">
                            @if(!empty($single_siwes))
                                <div class="m-3">
                                    <h5 class="blue-text mt-1">Assigned Students <small>({{$current_session->year}})</small></h5>
                                    {{-- <small class="col-2">
                                        <select id="session_id" value="{{ old('session') }}" required class="form-control @error('session') is-invalid @enderror">
                                            <option value="" disabled selected>Select Session</option>
                                            @foreach($sessions as $s)
                                                <option value="{{ $s->id }}">{{ $s->year }}</option>
                                            @endforeach
                                        </select>
                                    </small> --}}
                                </div>
                                <div class="table-responsive">
                                    <table id="myTable" class="table " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Matric Number</th>
                                                <th>Department</th>
                                                <th>Attachement</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($siwes as $siwes)
                                                <tr>
                                                    <td>{{$loop->index + 1}}</td>
                                                    <td><a href="" data-toggle="modal" data-target="#viewstudentModal" onclick="get_student({{$siwes->user_id}})">{{$siwes->user->name()}} <small>({{$siwes->siwes_type->name}})</small></a></td>
                                                    {{-- <td><a href="/school/student/{{$siwes->user_id}}">{{$siwes->user->name()}} <small>({{$siwes->siwes_type->name}})</small></a></td> --}}
                                                    <td>{{$siwes->student->matric_no}} </td>
                                                    <td>{{$siwes->student->department}} </td>
                                                    <td><a href="" data-toggle="modal" data-target="#vieworgModal" onclick="get_orgdetails({{$siwes->org_id}})">{{$siwes->org->name}}</a></td>
                                                    <td>
                                                        <a target="_blank" href="/school/{{$siwes->siwes_type->code_name}}/{{$siwes->user_id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                                                        {{-- <button href="" class='btn btn-sm btn-outline-primary' disabled><i class="fa fa-list"></i> Forms</button> --}}
                                                        {{-- <button type='button' class='btn btn-sm btn-outline-danger delete'><i class="fa fa-trash-alt"></i></button> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="h5 m-3">No Assigned Student Yet! <small>({{$current_session->year}})</small></p>
                            @endif
                        </div>
                    </div>

                    <div id="materials" style="display: none;">
                        <div class="text-center">
                            <h4 class="text-primary"><i class="fa fa-copy"></i> Department Lecture Notes</h4>
                            <button data-toggle="modal" data-target="#addMaterialModal" class="m-2 btn btn-sm btn-outline-primary"><i class="fa fa-upload"></i> Upload New Material</button>
                        </div>
                        <div class="table-responsive">
                            <table id="materialsTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>SIWES type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materials as $material)
                                        <tr>
                                            <td>{{$material->name}}</td>
                                            <td>{{$material->description}}</td>
                                            
                                            <td>
                                                @if ($material->siwes_type_id == 0)
                                                    All
                                                @else
                                                    {{$material->siwes_type->name}}
                                                @endif
                                                
                                            </td>
                                            <td style="display: inline-flex; width: 100%;">
                                                <a href="/download/{{$material->id}}" class="m-1" ><i class="fa fa-download"></i> </a>
                                                @if ($material->uploaded_by == Auth()->user()->id)
                                                    <a href="/admin/material/delete/{{$material->id}}" class="m-1 btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div id="board" style="display: none;">
                        <div class="text-center">
                            <h4><i class="fas fa-chalkboard"></i></i> Notice Board</h4>
                            <button data-toggle="modal" data-target="#addAnnouncementModal" class="m-2 btn bg-oth-color nav-text-color"><i class="fas fa-paper-plane"></i> Post New Notice</button>
                        </div>
                        
                        <div class="card-body p-3">
                            @if (empty($announcement))
                                <h5 class="text-center">NO Notice has been posted!</h5>
                            @endif
                            @foreach ($announcements as $announce)
                                <div class="col-12 card border-warning mb-3 bg-othe-color">
                                    <div class="card-body">
                                        <div style="display: inline-flex">
                                            <img class="logo rounded" src="{{ asset('images/OAU-Logo.png') }}" width="30" height="30" alt="" srcset="">
                                            <p class="card-title"><b> &nbsp;{{$announce->title}}</b></p>
                                        </div>
                                        <p class="text-muted card-subtitle"><i>Post for {{$announce->department}}</i></p>
                                        <p class="card-text">{{$announce->content}}</p>
                                        @if ($announce->uploaded_by == Auth::user()->id)
                                            <div class="float-left">
                                                <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i> Edit</button>
                                                <button class="ml-2 btn btn-sm btn-outline-danger"><i class="fa fa-trash-alt"></i> Delete </button>
                                            </div>
                                        @endif
                                        <p class="float-right text-muted"><i>{{$announce->user->last_name}}</i></p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                            
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
{{-- MODALS --}}
<div>
    {{-- View Organization --}}
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="vieworgModal" tabindex="-1" role="dialog" aria-labelledby="vieworgmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title blue-text" id="vieworgmodalLabel"><b> <i class="fas fa-building"></i>  <span id="org_name"> </span></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                                        
                <div class="m-3 p-2">
                    {{-- <h4 class="text-primary" id="org_name" style="font-weight: 900"></h4> --}}
                    <p>
                        Year of establishment: <b id="year_of_est"></b>
                    </p>
                    <p>
                        Postal Address: <b id="postal"></b>
                    </p>
                    <p>
                        Nature of Business: <b id="nature"></b>
                    </p>
                    <p>
                        Area of Specialization: <b id="area"></b>
                    </p>
                    <p>
                        Office Address: <b id="address"></b>
                    </p>
                    <p>
                       Plant Capacity: <b id="plant"></b> 
                    </p>
                    <p>
                        Other Information: <b id="others"></b>
                    </p>
                
                    {{-- <hr>
                    <h5><b> Staff(s)</b></h5>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-borderless" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Staff ID</th>
                                    <th>Department</th>
                                    <th>Contact Info</th>
                                </tr>
                            </thead>
                            <tbody id="staff_body">

                            </tbody>
                        </table>
                    </div> --}}
                </div>
                
            </div>
        </div>
    </div>
    {{-- View Student --}}
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="viewstudentModal" tabindex="-1" role="dialog" aria-labelledby="viewstudentmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title blue-text" id="viewstudentmodalLabel"><b><i class="fa fa-user"></i>  <span id="student_name"> </span></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                                        
                <div class="mt-3">
                    <div class="col-md-3 float-right">
                        {{-- <img class="rounded border-warning img-thumbnail float-right" src="{{asset('storage/'. $student->user->profile_pic)}}" alt="profile image" srcset="" width="150" height="150"> --}}
                        <span id="profile_pic">

                        </span>
                        {{-- @if ($student->user->profile_pic != null)
                        <span id="profile_pic">
                            <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. $student->user->profile_pic)}}" alt="profile image" srcset="" width="150" height="150">
                        </span>
                        @else
                            <img class="rounded border-warning float-right img-thumbnail" src="{{asset('images/user_default.png')}}" alt="profile image" srcset="" width="150" height="150">
                        @endif --}}
                    </div>

                    <div class="col-md-9">
                        <p>
                            Registration Number: <b id="matric_no"></b>
                        </p>
                        <p>
                            Surname: <b id="last_name"></b>
                        </p>
                        <p>
                            Other Names: <b id='other_names'></b>
                        </p>
                        <p>
                            Faculty: <b id="s_faculty"></b>
                        </p>
                        <p>
                            Department: <b id="s_department"></b>
                        </p>
                        <p>
                            Course of study: <b id="s_course"></b>
                        </p>
                        <hr>
                        <p>
                            Address during of Industrial Training: <b id="org_address"> </b>
                        </p>
                        <p>
                            Year of Industrial Training: <b id="training_y"> </b>
                        </p>
                        <p>
                            Duration of Industrial Training: <b id="training_d"></b>
                        </p>
                        <p>
                            Signature:
                            <span id="signature">

                            </span>
                            {{-- <img src="{{asset('storage/'. $student->signature)}}" alt="{{$student->signature}}" width="180" height="30"> --}}
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    {{-- Select/Filter Student --}}
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="getStudentModal" tabindex="-1" role="dialog" aria-labelledby="getStudentModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h5 class="modal-title blue-text" id="getStudentModalLabel"><b> Students in {{$staff->department}} </b></h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                                        
                <div class="m-3">
                    <form onsubmit="filter_student()" class="form">
                        <div id="select_bar" class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                <select id="session_id" value="{{ old('session') }}" required class="form-control @error('session') is-invalid @enderror">
                                    <option value="" disabled selected>Select Session</option>
                                    @foreach($sessions as $s)
                                        <option value="{{ $s->id }}">{{ $s->year }}</option>
                                    @endforeach
                                </select>
                                @error('session')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <select id="siwes_id" value="{{ old('siwes_id') }}" required class="form-control @error('siwes_id') is-invalid @enderror">
                                    <option value="" disabled selected>Select SIWES</option>
                                    @foreach($siwes_types as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                                @error('siwes_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col lg-1"></div>
                            <div class="col-md-2 mt-1">
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Add New Material Modal -->
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addMaterialModal" tabindex="-1" role="dialog" aria-labelledby="addMaterialModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMaterialModalLabel"><b><i class="fa fa-upload"></i> Upload New Material</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form row" action="/school/material/store" method="POST" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="form-group col-lg-4">
                            <label class="form-label" for="file">File: </label>
                            <input class="col-lg-12 form-control-file" type="file" name="file" id="file_name" required>
                            <input type="hidden" name="name" value="Document 1">
                        </div>
                
                        <div class="form-group col-lg-4">
                            <label class="form-label" for="description">Description: </label>
                            <input class="col-lg-12 form-control" type="text" name="description" id="description">
                        </div>
                
                        <div class="form-group col-lg-4">
                            <label class="form-label" for="end_date">SIWES type</label>
                            <select class="col-lg-12 form-control" name="siwes_type_id" id="siwes_type_id" required>
                                <option value="0" selected>All</option>
                                @foreach ($siwes_types as $siwes )
                                    <option value="{{$siwes->id}}">{{$siwes->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="uploaded_by" value="{{Auth::user()->id}}">
                        <input type="hidden" name="department" value="{{$staff->department}}">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-outline-primary">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Add New Notice Modal -->
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAnnouncementModalLabel"><b><i class="fa fa-paper-plane"></i> Post New Notice</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" action="/admin/announce/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="form-label" for="file">Title: </label>
                                <input class="col-lg-12 form-control" type="text" name="title" id="title">
                                
                            </div>
                            {{-- <div class="form-group col-lg-6">
                                <label class="form-label" for="department">Department: </label>
                                <select class="col-lg-12 form-control" name="department" id="department" required>
                                    <option value="All" selected>All</option>
                                    <option value="Department C" selected>All</option>
                                    @foreach ($departments as $d )
                                        <option value="{{$d->department}}">{{$d->department}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="content">Content: </label>
                            <textarea class="col-lg-12 form-control" name="content" id="" cols="50" rows="1"></textarea>
                        </div>
                        <input type="hidden" name="uploaded_by" value="{{Auth::user()->id}}">
                        <input type="hidden" name="department" value="{{$staff->department}}">

                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-outline-primary">
                               <i class="far fa-paper-plane"></i> Post
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        new DataTable('#materialsTable');
        function dashboard(){
            document.getElementById("dashboard").style.display = "block";
            document.getElementById("materials").style.display = "none";
            document.getElementById("board").style.display = "none";
        }
        function materials(){
            document.getElementById("dashboard").style.display = "none";
            document.getElementById("materials").style.display = "block";
            document.getElementById("board").style.display = "none";
        }
        function board(){
            document.getElementById("dashboard").style.display = "none";
            document.getElementById("materials").style.display = "none";
            document.getElementById("board").style.display = "block";
        }
        function filter_student() {
            var session_id = $('#session_id').val();
            var siwes_type_id = $('#siwes_id').val();
            window.open('/school/students/'+session_id+'/'+siwes_type_id, '_blank');
        }
    </script>
    <script>
        function get_orgdetails(id){
            $.get('/admin/organizations/'+id, function(data)
            {
                console.log(data);
                $('#staff_body').html(" ");

                $('#org_name').html(data.org.name);
                $('#year_of_est').html(data.org.year_of_est);
                $('#postal').html(data.org.postal_address);
                $('#nature').html(data.org.nature);
                $('#area').html(data.org.specialization);
                $('#address').html(data.org.full_address);
                $('#plant').html(data.org.plant_capacity);
                $('#others').html(data.org.other_info);
                $.each(data.staff, function(index, val)
                {
                    $('#staff_body').append(`
                        <tr>
                            <td>${val.user.last_name}`+ " " +` ${val.user.first_name}</td>
                            <td>${val.staff_id}</td>
                            <td>${val.department}</td>
                            <td>${val.user.contact_no}</td>
                        </tr>
                    `);
                });
            })
        };
        function get_student(id){
            $.get('/school/student/'+id, function(data)
            {
                console.log(data);
                $('#student_name').html(`${data.user.last_name}`+ " " +` ${data.user.first_name}`);
                if (data.user.profile_pic == null) {
                    $('#profile_pic').html(` <img class="rounded border-warning float-right img-thumbnail" src="/images/user_default.png" alt="profile image" srcset="" width="150" height="150">`);
                } else {
                    $('#profile_pic').html(`<img class="rounded border-warning float-right img-thumbnail" src="/storage/${data.user.profile_pic}" alt="profile image" srcset="" width="150" height="150"> `);
                };
                $('#matric_no').html(data.student.matric_no);
                $('#last_name').html(data.user.last_name);
                $('#other_names').html(`${data.user.first_name}`+ " " +` ${data.user.middle_name}`);
                $('#s_faculty').html(data.student.faculty);
                $('#s_department').html(data.student.department);
                $('#s_course').html(data.student.course_of_study);
                $('#org_address').html(data.org.full_address);
                $('#training_y').html(data.year_of_training);
                $('#training_d').html(data.duration_of_training);
                $('#signature').html(`<img src="/storage/${data.student.signature}" alt="signature" width="180" height="30">`);
            })
        };
    </script>
@endsection