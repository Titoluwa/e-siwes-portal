@extends('layouts.admin')

@section('title', 'Staffs')

@section('admincontent')
    <div class="row">
        <div class="col-md-12 card border-warning shadow-sm">

            <div class="card-body">
                <div class="mb-4" style="display: inline-flex">
                    <h3 class="text-primary"><i class="fa fa-university"></i> Departments</h3>
                </div>
                <div class="float-right">
                    <a  class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#AddDepartmemt"> <i class="fa fa-plus"></i> Add </a>
                </div>
                <div class="table-responsive mt-3">
                    <table id="departmentsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Department</th>
                                <th>Faculty</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dept as $d)
                            <tr>
                                <td>{{$d->course_study}}</td>
                                <td>{{$d->department}}</td>
                                <td>{{$d->faculty}}</td>
                                {{-- <td>
                                    <button type="button" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#editDepartment"><i class="fa fa-edit"></i></button>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALS -->
        <!-- Add Department Modal -->
        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="AddDepartmemt" tabindex="-1" role="dialog" aria-labelledby="AddDepartmemt" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddDepartmemtLabel"><p class="h4 text-primary text-center">Add Department/Program</p></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                <form class="form m-4" action="{{ route('dept.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="course_study">Course/Program</label>
                        <input class="col-md-12 form-control" required type="text" name="course_study" id="course_study">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="department">Department</label>
                        <input class="col-md-12 form-control" required type="text" name="department" id="department">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="faculty">Faculty</label>
                        <input class="col-md-12 form-control" required type="text" name="faculty" id="faculty">
                    </div>
                    <div class="float-right">
                    <button type="submit" class="btn btn-outline-primary">
                        {{ __('Add') }}
                    </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
@endsection   

@section('scripts')
    <script  type="text/javascript">
        $('#departmentsTable').DataTable( {
            stateSave: true,
        } );
    </script>
@endsection