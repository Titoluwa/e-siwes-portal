@extends('layouts.school')

@section('title', 'Students')


@section('schoolcontent')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card my-5">
                    <div class="card-header bg-oth-color">
                        <h4 class=""><i class="fas fa-user-friends"></i> Students for {{$siwes_type->name}} in {{$session->year}} session</h4>
                        <small>({{$staff->department}})</small>
                        @if($s_swep->siwes_type_id == 3)
                            <div class="float-right">
                                <button onclick="show_bank_details()" class="btn btn-sm btn-outline-primary">View Bank Details</button>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div id="student_list">
                            @if ($s_swep->siwes_type->name == "SWEP 200")
                                <form class="float-right" action="/school/upload-swep" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <p>Upload SWEP result</p>
                                    <input type="file" name="file" id="result_file" class="form-control-file" accept=".csv" required>
                                    <button type="submit" class="float-right btn btn-sm btn-warning">Submit</button>
                                </form>
                            @endif
                            <div class="m-3">
                                {{-- <div class="m-3">
                                    <h4 class="blue-text">List of Students for {{$siwes_type->name}} in {{$session->year}} session</h4>
                                </div> --}} 
                                <div class="table-responsive">
                                    <table id="studentsTable" class="table table-bordered table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                {{-- <th>S/N</th> --}}
                                                <th>Name</th>
                                                <th>Matric Number</th>
                                                @if($siwes_type->id != 1)
                                                    <th>Placement</th>
                                                    <th>Resumption Date</th>
                                                    <th>Ending Date</th>
                                                @else
                                                    <th>Course</th>
                                                    <th>Score (/50)</th>
                                                    <th>Attendance</th>
                                                @endif

                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="result-table-body">
                                            @foreach ($filtered as $siwes)
                                                <tr>
                                                    {{-- <td>{{$loop->index + 1}}</td> --}}
                                                    <td>{{$siwes->user->name()}}</td>
                                                    <td>{{$siwes->student->matric_no}}</td>
                                                    @if($siwes->org_id != null)
                                                        <td>{{$siwes->org->name}}</td>
                                                        <td>{{$siwes->resumption_date}}</td>
                                                        <td>{{$siwes->ending_date}}</td>
                                                    @else
                                                        <td>{{$siwes->student->course_of_study}}</td>
                                                        <td>
                                                            {{$siwes->swep_score}}
                                                            <input class="score_id" type="hidden" value="{{$siwes->id}}">
                                                            <a data-toggle="modal" data-target="#editScoreModal" class="editscore blue-text" style="text-decoration-line: none"><i class="fa fa-edit"></i></a>
                                                        </td>
                                                        <td>
                                                            @if ($siwes->swep_attendance == null)
                                                                0 &nbsp;&nbsp;
                                                                <input class="siwes_val" type="hidden" value="{{$siwes->id}}">
                                                                <a class="attendance btn btn-sm btn-outline-secondary"> + </a>
                                                            @else
                                                                {{count($siwes->swep_attendance)}} &nbsp;&nbsp;
                                                                @if ($siwes->swep_attendance[count($siwes->swep_attendance)-1] != $today)
                                                                    <input class="siwes_val" type="hidden" value="{{$siwes->id}}">
                                                                    <a class="attendance btn btn-sm btn-outline-secondary"> + </a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a target="_blank" href="/school/{{$siwes->siwes_type->code_name}}/{{$siwes->user_id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if($s_swep->siwes_type_id == 3)
                            <div id="bank_details_list" class="hide">
                                <div class="m-3">
                                    <div class="table-responsive">
                                        <table id="bankDetailsTable" class="table table-bordered table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Matric Number</th>
                                                    @if($siwes_type->id != 1)
                                                        <th>Placement</th>
                                                    @endif
                                                    <th>Bank Name</th>
                                                    <th>Sort Code</th>
                                                    <th>Account Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($filtered as $siwes)
                                                    <tr>
                                                        <td>{{$siwes->user->name()}}</td>
                                                        <td>{{$siwes->student->matric_no}}</td>
                                                        <td>
                                                            @if($siwes->org_id != null)
                                                                {{$siwes->org->name}}
                                                            @else
                                                                <span class="text-danger"> Nil</span>
                                                            @endif
                                                        </td>
                                                        @if ($siwes->bank_details == null)
                                                            <td class="text-danger"> not found</td>
                                                            <td class="text-danger"> not found</td>
                                                            <td class="text-danger"> not found</td>
                                                        @else
                                                            <td>{{$siwes->bank_details->bank_name}}</td>
                                                            <td>{{$siwes->bank_details->sort_code}}</td>
                                                            <td>{{$siwes->bank_details->account_number}}</td>
                                                        @endif
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}
    {{-- Edit Score Modal --}}
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="editScoreModal" tabindex="-1" role="dialog" aria-labelledby="editScoreModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h5 class="modal-title blue-text" id="editScoreModalLabel"><b> Edit <span id="score_name">name</span>'s score</b></h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                                        
                <div class="m-3">
                    <form class="form" method="POST" action="/school/student/edit-swep-score">
                        @csrf
                        <div id="score_bar" class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                <input type="hidden" name="swep_id" id='swep_id'>
                                <input type="number" name="swep_score" id="edit_score" value="{{ old('score') }}" required class="form-control @error('score') is-invalid @enderror">
                                @error('score')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2 mt-1">
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit"></i> save</button>
                            </div>
                            <div class="col-md-5"></div>

                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
    $('#studentsTable').DataTable( {
        dom: 'Bfrtip',
        stateSave: true,
        lengthChange: true,
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="far fa-copy"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="far fa-file-excel"></i> Excel',
                titleAttr: 'Excel'
            },
            'colvis'
        ]
    });
    </script>
    <script>
        $('#bankDetailsTable').DataTable( {
            dom: 'Bfrtip',
            stateSave: true,
            lengthChange: true,
            buttons: [
                {
                    extend:    'copyHtml5',
                    text:      '<i class="far fa-copy"></i> Copy',
                    titleAttr: 'Copy'
                },
                {
                    extend:    'excelHtml5',
                    text:      '<i class="far fa-file-excel"></i> Excel',
                    titleAttr: 'Excel'
                },
                'colvis'
            ]
        });
            
    </script>
    <script>
        function show_bank_details() 
        {
            $('#student_list').toggleClass('hide');
            $('#bank_details_list').toggleClass('hide');  
        }   

        $('.editscore').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('td').find('.score_id').val();
            // alert(id);
            $.get('/school/swep-200/edit/'+id, function(data)
            {
                $('#score_name').html(data.user.last_name + " " + data.user.first_name);
                $('#edit_score').val(data.swep_score);
                $('#swep_id').val(data.id);
            })
        });

        $('.attendance').click(function(e) {
            e.preventDefault();
            var siwes_id = $(this).closest('td').find('.siwes_val').val();
            swal({
                title: "Mark Present?",
                text: "Are you sure you want to mark this student present",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    var data = {
                        "_token": $('input[name=_token]').val(),
                        "id": siwes_id,
                    }
                    $.ajax({
                        type: "POST",
                        url: "/school/swep-attendance/"+ siwes_id,
                        data: data,
                        success: function (response){
                            swal(response.status, {
                                icon: "success",
                            })
                            .then((result)=>{
                                location.reload();
                            });
                        }
                    });
                }
            });
        });
    </script>

@endsection