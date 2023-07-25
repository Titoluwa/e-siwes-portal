@extends('layouts.admin')

@section('title', 'Organizations')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <!-- <div class="card-header border-warning bg-othe-color">
                    <h5 class="mt-2">Dashboard</h5>
                </div> -->

                <div class="card-body p-3">
                    <h3 class="text-primary">Organizations</h3>
                    <div class="float-right">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="addindustryModal" disabled>Add</button>
                    </div>

                    @if(!empty($orgs))
                        <div class="table-responsive">
                            <table id="myTable" class="table " style="width:100%">
                                <thead>
                                    <tr>
                                        {{-- <th>Last Name</th> --}}
                                        <th>Name</th>
                                        <th>Staff Name</th>
                                        <th>Location</th>
                                        <th>Office Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($organizations as $org)
                                        <tr>
                                            <td>{{$org->name}}</td>
                                            <td><a href="mailto:{{$org->user->email}}">{{$org->user->name()}}</a></td>
                                            <td>{{$org->full_address}}</td>
                                            <td><a href="mailto:{{$org->postal_address}}">{{$org->postal_address}}</a></td>
                                            <td>
                                                <button onclick="get_orgdetails({{$org->id}})" class='btn btn-sm btn-outline-primary' data-toggle="modal" data-target="#viewOrgModal">Details</button>
                                                {{-- <a href="" class='btn btn-sm btn-outline-primary'><i class="fa fa-list"></i> Edit</a> --}}
                                                <button type='button' class='btn btn-sm btn-outline-danger delete' disabled><i class="fa fa-unlink"></i> Deactivate</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="h5 p-3 m-4 text-center">No Organization Registered Yet!</p>
                    @endif
                
                </div>
                
            </div>
        </div>
    </div>

    <!-- MODALS -->
    <!-- View Organization Details Modal -->
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="viewOrgModal" tabindex="-1" role="dialog" aria-labelledby="vieworgmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vieworgmodalLabel"><b><i class="far fa-building"></i> Organisation Details</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                                        
                <div class="m-3 p-2">
                    <h4 class="text-primary" id="org_name" style="font-weight: 900"></h4>
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
                    <hr>
                    <h5><b> Student(s) </b></h5>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-dark" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Registration Number</th>
                                        <th>Department</th>
                                    </tr>
                                </thead>
                                <tbody id="student_body">

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
                $('#student_body').html(" ");

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

                $.each(data.students, function(index, val)
                {
                    
                    $('#student_body').append(`
                        <tr>
                            <td>${val.user.last_name}`+ " " +` ${val.user.first_name}</td>
                            <td>${val.matric_no}</td>
                            <td>${val.department}</td>
                        </tr>
                    `);
                });
            })
        };
    </script>
@endsection