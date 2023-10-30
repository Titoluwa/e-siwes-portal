@extends('layouts.admin')

@section('title', 'Students')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning">

                <div class="card-body p-3">
                    <div class="mb-5">
                        @if(!empty($s_siwes))
                            <h4 class="text-primary">Placement List for {{$s_siwes->siwes_type->name}} <span id="session_name" >({{$current_session->year}})</span></h4>
                        @endif
                        @if ($s_siwes->siwes_type->name == "SWEP 200")

                        <form class="float-right" action="" method="post">
                            <p>Upload ITCU result</p>
                            <input type="file" name="result" id="result_file" class="form-control-file" accept=".csv, application/excel">
                            <button type="submit" class="float-right btn btn-sm btn-warning">Submit</button>
                        </form>
                    @endif
                    </div>
                    
                    @if(!empty($s_siwes))
                        <div class="table-responsive">
                            <table id="placementTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        {{-- <th>S/N</th> --}}
                                        <th>Name</th>
                                        <th>Matric Number</th>
                                        <th>Department</th>
                                        @if ($s_siwes->siwes_type_id != 1)
                                            <th>Organization</th>
                                            <th>Address</th>
                                        @else
                                            <th>Dept Score (/50)</th>
                                            <th>ITCU Score (/50)</th>
                                            <th>Total Score (/100)</th>
                                        @endif
                                        
                                    </tr>
                                </thead>
                                <tbody id="siwes_table">
                                    @foreach($siwes as $student)
                                        <tr>
                                            {{-- <td>{{$loop->index+1}}</td> --}}
                                            {{-- <td>{{$student->user->name()}}</td> --}}
                                            <td><a target="_blank" href="/admin/students/{{$student->user_id}}">{{$student->user->name()}}</a></td> {{-- Link to View  --}}
                                            <td>{{$student->student->matric_no}} </td>
                                            <td>{{$student->student->department}} </td>
                                            @if ($student->org_id != null)
                                                <td>{{$student->org->name}}</td>
                                                <td>{{$student->org->full_address}}</td>
                                            @else
                                                <td>{{$student->swep_score}}</td>
                                                <td>
                                                    {{$student->itcu_score}}
                                                    <input class="score_id" type="hidden" value="{{$student->id}}">
                                                    <a href="" data-toggle="modal" data-target="#editScoreModal" class="editscore blue-text" style="text-decoration-line: none"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td>{{$student->total_score()}}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="h4 p-3 m-4 text-center">No Registered Student Yet! ({{$current_session->year}})</p>
                    @endif
                
                </div>
                
            </div>

               <!-- MODALS -->

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
                                    {{-- <img src="{{asset('storage/'. $student->signature)}}" alt="{{$student->signature}}" width="180" height="30"> --}}
                                </p> 
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            {{-- Edit Score Modals --}}
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
                            <form class="form" method="POST" action="/admin/student/edit-itcu-score">
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
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.editscore').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('td').find('.score_id').val();
            // alert(id);
            $.get('/admin/student-200/'+id, function(data)
            {
                // alert(data);
                $('#score_name').html(data.user.last_name + " " + data.user.first_name);
                $('#edit_score').val(data.itcu_score);
                $('#swep_id').val(data.id);
            })
        });
        // new DataTable('#placementTable');
        $('#placementTable').DataTable( {
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

        $('#search_btn').click(function(e) 
        {
            e.preventDefault();
            var session_id = $('#session_id').val();
            var siwes_type = $('#siwes_name').val();
            $.get('/admin/placement/'+siwes_type+'/'+session_id, function(data)
            {                
                console.log(data);
                $('#session_name').html(data.session.year);
                $('#siwes_table').html(' ');

                $.each(data.siwes, function(index, val)
                {
        
                    $('#siwes_table').append(`
                        <tr>
                            <td>${val.user.last_name} ${val.user.first_name}</td>
                            <td>${val.student.matric_no}</td>
                            <td>${val.student.department}</td>
                            <td>${val.org.name}</td>
                            <td>${val.org.full_address}</td>
                        </tr>
                    `);
                }); 
                
            });
        }) 
    </script>
@endsection