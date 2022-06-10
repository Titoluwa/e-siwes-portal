@extends('layouts.industry')

@section('industrycontent')
    <div class="row">
        <div class="col-lg-5 col-sm-12  p-4">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent blue-text clearfix mt-2 ">
                    <div class="float-left">
                        <h4 class=""><b>{{ __('Profile') }}</b> </h4>
                    </div>
                    <div class="float-right">
                        <a class="h4" href="/industry"><i class="fas fa-edit"></i></a>
                    </div>
                </div>

                <div class="card-body border-warning text-center">
                    <h5 class="">Welcome, <b>{{Auth::user()->first_name}}!</b></h5>
                    <p class="">You're logged in</p>  
                </div>

                <div class="p-2 text-center">
                    @if (!empty($org))
                        <p>Employee at <b>{{$org->name}}</b> </p>
                        <p>{{Auth::user()->department}} Department</p>
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
                            <p class=""><b>Details</b></p>
                            <p>{{$org->name}}</p>
                            <p>{{$org->full_address}}</p>
                            <p>{{$org->postal_address}}</p>
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
                        <h4 class=""><b>{{ __('Manage Student') }}</b> </h4>
                    </div>
                    <div class="float-right">
                        <a class="h4" href="/industry"><i class="fas fa-eye"></i></a>
                    </div>
                </div>

                <div class="card-body border-warning">
                    <div class="p-2">

                        <!-- <h5 class="pt-2">Students under your organisation</h5> -->
                        <div class="table-responsive">
                            <table id="myTable" class="table " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Matric Number</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <!-- <tfoot>
                                    <tr>
                                        <th>Matric Number</th>
                                        <th>Email</th>
                                        <th>Last Name</th>
                                        <th>Faculty</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot> -->
                                <tbody>
                                  
                                    <tr>
                                        <td>Eample</td>
                                        <td>exaam </td>
                                        <td>lastname </td>
                                        <td>someht </td>
                                        <td>
                                            <a href="" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                                            <a href="" class='btn btn-sm btn-outline-primary'><i class="fa fa-list"></i> Forms</a>
                                            <button type='button' class='btn btn-sm btn-outline-danger delete'><i class="fa fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

@endsection