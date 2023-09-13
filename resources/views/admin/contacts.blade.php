@extends('layouts.admin')

@section('title', 'Staffs')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning">
                
                <div class="card-body p-3">
                    <h4 class="text-primary"><i class="fa fa-phone"></i> All Users' Contact</h4>
                    
                    <br>
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name()}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->contact_no}}</td>
                                        <td>
                                            @if ($user->role_id == 1)
                                                Student
                                            @elseif($user->role_id == 2)
                                                Department Coordinator
                                            @elseif ($user->role_id == 3)
                                                Industry Supervisor
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
    <script  type="text/javascript">
        // new DataTable('#usersTable');
        $('#usersTable').DataTable( {
            dom: 'Bfrtip',
            stateSave: true,
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
                // {
                //     extend:    'pdfHtml5',
                //     text:      '<i class="far fa-file-pdf"></i> PDF',
                //     titleAttr: 'PDF'
                // },
                'colvis'
            ]
        } );
        
    </script>
@endsection