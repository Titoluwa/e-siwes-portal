@extends('layouts.industry')

@section('title', 'Industry Supervisor')

@section('industrycontent')
    <div class="row">
        <div class="col-lg-5 col-sm-12  p-4">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent blue-text clearfix mt-2 ">
                    <div class="float-left">
                        <h4 class=""><b>{{ __('Profile') }}</b> </h4>
                    </div>
                    <div class="float-right">
                        <a class="h4" href="/industry/profile"><i class="fas fa-edit"></i></a>
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
                            <div class="float-left">
                                <p class=""><b>Details</b></p>
                                <p>{{$org->name}}</p>
                                <p>{{$org->full_address}}</p>
                                <p>{{$org->postal_address}}</p>
                            </div>
                            <div class="float-right">
                                <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. $org->logo)}}" alt="profile image" srcset="" width="150" height="150">
                            </div>
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
                        <!-- <a class="h4" href="/industry"><i class="fas fa-eye"></i></a> -->
                    </div>
                </div>

                <div class="card-body border-warning">
                    <div class="p-2">
                        @if (!empty($org))
                            <!-- <h5 class="pt-2">Students under your organisation</h5> -->
                            @if(!empty($studs))
                                <div class="table-responsive">
                                    <table id="myTable" class="table " style="width:100%">
                                        <thead>
                                            <tr>
                                                {{-- <th>Last Name</th> --}}
                                                <th>Name</th>
                                                <th>Matric Number</th>
                                                <th>Email</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                    {{-- <td></td> --}}
                                                    <td><a href="/industry/student/{{$student->user_id}}">{{$student->user->last_name}} {{$student->user->first_name}}</a></td>
                                                    <td>{{$student->user->matric_no}} </td>
                                                    <td>{{$student->user->email}} </td>
                                                    <td>
                                                        <a href="/industry/student/log/{{$student->user->id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                                                        <a href="" class='btn btn-sm btn-outline-primary'><i class="fa fa-list"></i> Forms</a>
                                                        <button type='button' class='btn btn-sm btn-outline-danger delete'><i class="fa fa-trash-alt"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="h5 p-3 m-4 text-center">No Registered Student Yet!</p>
                            @endif
                        @else
                            <p class="h5 p-3 m-4 text-center">Register Your Organisation</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
