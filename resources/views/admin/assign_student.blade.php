@extends('layouts.admin')

@section('title', 'Assign Students')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning">
 
                <div class="card-body p-3">
                    <div class="mb-4" style="display: inline-flex">
                        <h4 class="text-primary">Students registered for SIWES 400 in {{$current_session->year}} session</h4>
                    </div>

                    @if(!empty($s_siwes))
                        <div class="table-responsive">
                            <form id="assignForm" method="POST" action="/admin/assign-student" enctype="multipart/form-data">
                                @csrf
                                <table id="siwesTable" class="table " style="width:100%">
                                    <thead>
                                        <tr>
                                            {{-- <th>S/N</th> --}}
                                            <th>Name</th>
                                            <th>Matric Number</th>
                                            <th>Department</th>
                                            <th>Assigned Supervisor</th>
                                            <th>State</th>
                                            <th>Area</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siwes as $student)
                                            <tr>
                                                {{-- <td>{{$loop->index+1}}</td> --}}
                                                <td><a href="/admin/students/{{$student->user_id}}">{{$student->user->name()}}</a></td> {{-- Link to View  --}}
                                                <td>{{$student->student->matric_no}} </td>
                                                <td>{{$student->student->department}} </td>
                                                @if($student->assigned_staff_id==null)
                                                    <td class="text-danger">NIL</td>
                                                @else
                                                    <td>{{$student->assigned_staff->user->name()}}</td>
                                                @endif
                                                <td>{{$student->org->state}}</td>
                                                <td>{{$student->org->area}}</td>
                                                
                                                <td style="display: inline-flex">
                                                    <input type="checkbox" name="siwes_id[]" value="{{$student->id}}" id="{{$student->id}}">
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <label for="staff">Assign to: </label>
                                <select required name="staff_id" id="staff" value="{{ old('staff') }}" class="col-5 form-control @error('staff') is-invalid @enderror" data-dependant='department' >
                                    <option value="" disabled selected>Select Department Coordinator</option>
                                    @foreach($staffs as $staff)
                                        <option value="{{ $staff->id }}">{{ $staff->user->name() }}</option>
                                    @endforeach
                                </select>
                                <div class="float-right">
                                    <button id="submit_assign" class='justify-content-right btn btn-primary'><i class="fa fa-link"></i> Assign</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <p class="h5 p-3 m-4 text-center">No Registered Student Yet!</p>
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
        </div>
    </div>
@endsection

@section('scripts')
    <script  type="text/javascript">
        new DataTable('#siwesTable');

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#submit_assign').click(function(e) 
            {
                e.preventDefault();
                var form = $("#assignForm");
                swal({
                    title: "Assign Student(s)",
                    text: "Are you sure you want to assign these student?",
                    icon: "warning",
                    buttons: "Yes",
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "/admin/assign-student",
                            data: form.serialize(),
                            success: function (response){
                                swal(response.status, {
                                    icon: "success",
                                    buttons: "OK",
                                })
                                .then((result)=>{
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection