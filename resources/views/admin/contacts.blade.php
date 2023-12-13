@extends('layouts.admin')

@section('title', 'All Users')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning">
                
                <div class="card-body p-3">
                    <h4 class="text-primary"><i class="fa fa-users"></i> All Users</h4>
                    
                    <br>
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Role</th>
                                    <th>Verified</th>
                                    <th>Log</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name()}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>0{{$user->contact_no}}</td>
                                        <td>
                                            @if ($user->role_id == 1)
                                                Student
                                            @elseif($user->role_id == 2)
                                                Department Coordinator
                                            @elseif ($user->role_id == 3)
                                                Industry Supervisor
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->verified_token != null)
                                            <span class="text-success">Verifed</span>
                                            @else
                                                <span class="text-danger">Unverified</span>
                                            @endif 
                                        </td>
                                        <td>
                                            @if ($user->logged == 1)
                                                <input class="logout_val" type="hidden" value="{{$user->id}}">
                                                <span class="text-success logout"><a >IN</a></span>
                                            @else
                                                <span class="text-danger">Out</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->status == 1)
                                                <input class="deactivate_val" type="hidden" value="{{$user->id}}">
                                                <button type='button' class='m-1 btn btn-sm btn-outline-danger deactivate'><i class="fa fa-unlink"></i></button>
                                            @else
                                                <input class="activate_val" type="hidden" value="{{$user->id}}">
                                                <button type='button' class='m-1 btn btn-sm btn-outline-success activate'><i class="fa fa-link"></i></button>
                                            @endif 
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
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.deactivate').click(function(e) {
                e.preventDefault();
                var deactivate_id = $(this).closest('td').find('.deactivate_val').val();
                // alert(deactivate_id);
                swal({
                    title: "Deactivate User?",
                    text: "The user will not be able to login into the portal anymore",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": deactivate_id,
                        }
                        $.ajax({
                            type: "DELETE",
                            url: "/admin/user/deactivate/"+ deactivate_id,
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

            $('.activate').click(function(e) {
                e.preventDefault();
                var activate_id = $(this).closest('td').find('.activate_val').val();
                // alert(activate_id);
                swal({
                    title: "Activate User?",
                    text: "Are you sure you want to activate this user",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": activate_id,
                        }
                        $.ajax({
                            type: "DELETE",
                            url: "/admin/user/activate/"+ activate_id,
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

            $('.logout').click(function(e) {
                e.preventDefault();
                var logout_id = $(this).closest('td').find('.logout_val').val();
                // alert(logout_id);
                swal({
                    title: "Logout User?",
                    text: "Are you sure you want to logout this user",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": logout_id,
                        }
                        $.ajax({
                            type: "DELETE",
                            url: "/admin/user/logout/"+ logout_id,
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
        });
    </script>
    <script  type="text/javascript">
        // new DataTable('#usersTable');
        $('#usersTable').DataTable( {
            dom: 'lBfrtip',
            stateSave: true,
            buttons: [
                // {
                //     extend:    'copyHtml5',
                //     text:      '<i class="far fa-copy"></i> Copy',
                //     titleAttr: 'Copy'
                // },
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
@endsection