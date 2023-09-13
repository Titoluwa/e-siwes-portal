@extends('layouts.school')

@section('title', 'Department Coordinator')


@section('schoolcontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header bg-oth-color">
                    <a class="blue-text" style="text-decoration-line: none" onclick="show_assigned()"><i class="fas fa-clipboard"></i> Dashboard</a>
                    <div class="float-right">
                        <a href="" data-toggle="modal" data-target="#getStudentModal" class="blue-text" style="text-decoration-line: none"><i class="fas fa-user-friends"></i> All Students</a>
                    </div>
                </div>

                <div class="card-body my-5">
                    <div id="dashboard" class="text-center">
                       <b><h3>Welcome, {{Auth::user()->name()}}</h3></b>
                        {{ __('You are logged in!') }}
                    </div>

                    {{-- <div id="assigned_students" class="m-3" style="display: none;"> --}}
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
                                                <td><a href="/school/student/{{$siwes->user_id}}">{{$siwes->user->name()}} <small>({{$siwes->siwes_type->name}})</small></a></td>
                                                <td>{{$siwes->student->matric_no}} </td>
                                                <td>{{$siwes->student->department}} </td>
                                                <td><a href="" data-toggle="modal" data-target="#vieworgModal" onclick="get_orgdetails({{$siwes->org_id}})">{{$siwes->org->name}}</a></td>
                                                <td>
                                                    <a href="/school/siwes/{{$siwes->siwes_type->code_name}}/{{$siwes->user_id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
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

            </div>
        </div>
    </div>
</div>
<div>
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="vieworgModal" tabindex="-1" role="dialog" aria-labelledby="vieworgmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title blue-text" id="vieworgmodalLabel"><b><i class="fas fa-building"></i> <span id="org_name"> </span></b></h5>
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
                
                    <hr>
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
                    </div>
                </div>
                
            </div>
        </div>
    </div>
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
</div>
@endsection
@section('scripts')
    {{-- <script>
        let url = "www.someurl.com?";
        let length = url.length;
        if(url.charAt(length-1)==='?')
        url=url.slice(0,length-1);
        console.log(url);
    </script> --}}
    <script>
        function show_assigned(){
            document.getElementById("assigned_students").style.display = "block";
        }
        function filter_student() {
            // document.getElementById("all_students").style.display = "block";
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
    </script>
@endsection
{{-- @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif --}}