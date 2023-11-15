@extends('layouts.industry')

@section('title', 'Industry Supervisor')

@section('industrycontent')
    <div class="row">
        <div class="col-lg-5 col-sm-12  p-4">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent blue-text clearfix mt-2 ">
                    <div class="float-left">
                        <h4 class=""><b>{{ __('Profile') }}</b> </h4>
                    </div>
                    <div class="float-right">
                        <a class="h4" href="/industry/profile"><i class="fas fa-edit"></i></a>
                    </div>
                </div>

                <div class="card-body border-warning text-center">
                    <h5 class="">Welcome, <b>{{Auth::user()->first_name}}!</b></h5>
                    <p class="">You're logged in</p>
                </div>

                <div class="p-2 text-center">
                    @if (!empty($org))
                        <p>Employee at <b>{{$org->name}}</b> </p>
                        <p>{{$orgsup->department}} Department</p>
                    @else
                        <p>Provide the information of your organization.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-12  p-4">
            <div class="card border-warning">

                <div class="card-header border-warning bg-transparent blue-text clearfix mt-2 ">
                    <div class="float-left">
                        <h4 class=""><b>{{ __('Organisation') }}</b> </h4>
                    </div>
                    <div class="float-right">
                        @if (!empty($org))
                            <a class="h4" href="/industry/org/edit"> <h4><i class="fas fa-edit"></i></h4></a>
                        @else
                            <a class="h4" href="/industry/org"><i class="fas fa-plus"></i></a>
                        @endif
                    </div>

                </div>

                <div class="card-body border-warning">
                    <div class="p-2">
                        @if (!empty($org))
                            <div class="float-left">
                                <p class=""><b>Details</b></p>
                                <p>{{$org->name}}</p>
                                <p>{{$org->full_address}}</p>
                                <p>{{$org->postal_address}}</p>
                            </div>
                            <div class="float-right">
                                <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. $org->logo)}}" alt="profile image" srcset="" width="150" height="150">
                            </div>
                        @else
                            <p class="h5 p-3 m-4 text-center">Register Your Organisation</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 p-4">
            <div class="card border-warning">

                <div class="card-header border-warning bg-transparent blue-text clearfix mt-2 ">
                    <div class="float-left">
                        <h4 class=""><b>{{ __('Manage Student(s)') }}</b> </h4>
                    </div>
                    <div class="float-right">
                        <!-- <a class="h4" href="/industry"><i class="fas fa-eye"></i></a> -->
                    </div>
                </div>

                <div class="card-body border-warning">
                    <div class="p-2">
                        @if (!empty($org))
                            <!-- <h5 class="pt-2">Students under your organisation</h5> -->
                            @if(!empty($s_siwes))
                                <div class="table-responsive">
                                    <table id="myTable" class="table " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Email</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($siwes as $student)
                                                <tr>
                                                    <td>{{$loop->index + 1}}</td>
                                                    <td><a onclick="studentDetails({{$student->id}})"  data-toggle="modal" data-target="#viewStudent">{{$student->user->name()}} ({{$student->siwes_type->name}})</a></td>
                                                    {{-- <td><a href="/industry/student/{{$student->user_id}}">{{$student->user->name()}} ({{$student->siwes_type->name}})</a></td> --}}
                                                    <td>{{$student->student->matric_no}} </td>
                                                    <td>{{$student->student->department}} </td>
                                                    <td>
                                                        <a target="_blank" href="/industry/logbook/{{$student->id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                                                        {{-- <a  class='btn btn-sm btn-outline-primary'><i class="fa fa-list"></i> Forms</a> --}}
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
                        @else
                            <p class="h5 p-3 m-4 text-center">Register Your Organisation</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="viewStudent" tabindex="-1" role="dialog" aria-labelledby="viewStudentModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStudentModal"><b><i class="fa fa-id-badge"></i> <span id="student_name"></span></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><b>&times;</b></span>
                </button>
            </div>
            <div class="card-body border-warning bg-light">
                <div class="mt-3">
                    <div class="col-md-3 float-right">
                        <span id="profile_pic">
                            <img class="rounded border-warning img-thumbnail float-right" src="{{asset('images/user_default.png')}}" alt="profile image" srcset="" width="150" height="150">
                        </span>
                        
                    </div>

                    <div class="col-md-9">
                        <p>
                            Registration Number: <b id="matric_no"></b>
                        </p>
                        <p>
                            Surname: <b id="last_name"></b>
                        </p>
                        <p>
                            Other Names: <b id="other_names"></b>
                        </p>
                        <p>
                            Faculty: <b id="faculty"></b>
                        </p>
                        <p>
                            Department: <b id="department"></b>
                        </p>
                        <p>
                            Course of study: <b id="course"></b>
                        </p>
                        <hr>
                        <p>
                            Address during of Industrial Training: <b id="address"></b>
                        </p>
                        <p>
                            Year of Industrial Training: <b id="y_training"> </b>
                        </p>
                        <p>
                            Duration of Industrial Training: <b id="d_training"></b>
                        </p>
                        <p>
                            Signature: <span id="signature"> </span>
                        </p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function studentDetails(id)
        {
            $.get('/industry/siwes-student/'+id, function(data)
            {
                $('#student_name').html(`${data.user.last_name} ${data.user.first_name}`);
                if (data.user.profile_pic == null) {
                    $('#profile_pic').html(` <img class="rounded border-warning img-thumbnail float-right" src="images/user_default.png" alt="profile image" srcset="" width="150" height="150">`);
                } else {
                    $('#profile_pic').html(`<img class="rounded border-warning img-thumbnail float-right" src="storage/${data.user.profile_pic}" alt="profile image" srcset="" width="150" height="150">`);
                }
                $('#matric_no').html(data.student.matric_no);
                $('#last_name').html(data.user.last_name);
                $('#other_names').html(`${data.user.first_name} ${data.user.middle_name}`);
                $('#faculty').html(data.student.faculty);
                $('#department').html(data.student.department);
                $('#course').html(data.student.course_of_study);
                $('#y_training').html(data.year_of_training);
                $('#d_training').html(data.duration_of_training);
                $('#signature').html(`<img src="storage/${data.student.signature}" alt="signature" width="180" height="30">`);                
            })
        }; 
    </script>
@endsection
