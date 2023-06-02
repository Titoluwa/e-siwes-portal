@extends('layouts.admin')

@section('title', 'Students')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <!-- <div class="card-header border-warning bg-othe-color">
                    <h5 class="mt-2">{{ __('Dashboard') }}</h5>
                </div> -->

                <div class="card-body p-3">
                    <h3 class="text-primary">Students</h3>

                    
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
                
                </div>
                
            </div>
        </div>
    </div>
@endsection