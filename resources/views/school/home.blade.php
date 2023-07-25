@extends('layouts.app')

@section('nav')
    <a class="nav-link"> Institution Supervisor</a>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12 mt-5">
            <div class="card mt-5">
                <div class="card-header bg-oth-color">
                    <a class="blue-text" style="text-decoration-line: none"><i class="fas fa-clipboard"></i> Dashboard</a>
                    <div class="float-right">
                        <a class="blue-text" style="text-decoration-line: none"><i class="fas fa-user-friends"></i> Students</a>
                    </div>
                </div>

                <div class="card-body text-center my-5 py-5">
                    <div id="dashboard">
                       <b><h3>Welcome, {{Auth::user()->name()}}</h3></b>
                        {{ __('You are logged in!') }}
                    </div>

                    <div class="m-3" id="students">
                        @if(!empty($studs))
                                <div class="table-responsive">
                                    <table id="myTable" class="table " style="width:100%">
                                        <thead>
                                            <tr>
                                                {{-- <th>Last Name</th> --}}
                                                <th>Name</th>
                                                <th>Matric Number</th>
                                                <th>Organization</th>
                                                <th>Email</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                    {{-- <td></td> --}}
                                                    <td><a href="/school/student/{{$student->user_id}}">{{$student->user->last_name}} {{$student->user->first_name}}</a></td>
                                                    <td>{{$student->matric_no}} </td>
                                                    <td><a href="" data-toggle="modal" data-target="#vieworgModal" onclick="get_orgdetails({{$student->org_id}})">{{$student->org->name}}</a></td>
                                                    <td>{{$student->user->email}} </td>
                                                    <td>
                                                        <a href="/school/student/log/{{$student->user->id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                                                        <button href="" class='btn btn-sm btn-outline-primary' disabled><i class="fa fa-list"></i> Forms</button>
                                                        <button type='button' class='btn btn-sm btn-outline-danger delete'><i class="fa fa-trash-alt"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="h5 p-3 m-4 text-center">No Assigned Student Yet!</p>
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
</div>
@endsection
@section('scripts')
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