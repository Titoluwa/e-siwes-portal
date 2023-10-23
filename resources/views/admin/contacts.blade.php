@extends('layouts.admin')

@section('title', 'All Contacts')

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
                                    <th>Active</th>
                                    <th>Verified</th>
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
                                            @if ($user->logged == 1)
                                                <span class="text-success">Active</span>
                                                <br>
                                                {{-- <a class="" href="/logging-out"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logging-out-form').submit();" @disabled(true)>
                                                    Logout
                                                </a>
                                                <form id="logging-out-form" action="/logging-out" method="POST" class="d-none">
                                                    @csrf
                                                </form> --}}
                                            @else
                                                <span class="text-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->verified_token != null)
                                            <span class="text-success">Verifed</span>
                                            @else
                                                <span class="text-danger">Unverified</span>
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