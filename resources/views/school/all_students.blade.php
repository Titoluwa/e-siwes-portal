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
                    </div>

                    <div class="card-body">
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
                                                        <a href="" data-toggle="modal" data-target="#editScoreModal" class="editscore blue-text" style="text-decoration-line: none"><i class="fa fa-edit"></i></a>
                                                    </td>
                                                    <td>{{count($siwes->swep_attendance)}} &nbsp;&nbsp;
                                                        @if ($siwes->swep_attendance[count($siwes->swep_attendance)-1] != $today)
                                                            <input class="siwes_val" type="hidden" value="{{$siwes->id}}">
                                                            <a class="attendance btn btn-sm btn-outline-secondary"> + </a>
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>
                                                    <a target="_blank" href="/school/student/{{$siwes->siwes_type->code_name}}/{{$siwes->user_id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                            
                                    </tbody>
                                </table>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modals --}}
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
                                <input type="number" name="score" id="edit_score" value="{{ old('score') }}" required class="form-control @error('score') is-invalid @enderror">
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
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="far fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF'
                },
                'colvis'
            ]
        } );
    </script>
    <script>
        $('.editscore').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('td').find('.score_id').val();
            $.get('/school/swep-200/'+id, function(data)
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
                        url: "/school/swep_attendance/"+ siwes_id,
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