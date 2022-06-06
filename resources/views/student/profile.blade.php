@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent clearfix">

                    <div class="float-left mt-2 blue-text">
                        <h3 style="font-weight: 700;">{{ __("STUDENT PARTICULAR") }}</h3>
                    </div>                    
                </div>

                <div class="card-body">
                    <div class="float-left">
                        <h5><b> Persanal Information </b></h5>
                    </div>
                    <div class="float-right">
                        <a href="/student/profile/edit">
                            <i class="fas fa-edit"></i>EDIT
                        </a>
                    </div>
                    <br>
                    <div class="mt-3">
                        <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. Auth::user()->profile_pic)}}" alt="profile image" srcset="" width="150" height="150">
                    
                        <div>
                            <p>
                                Registration Number: <b>{{Auth::user()->matric_no}}</b>
                            </p>
                            <p>
                                Surname: <b>{{Auth::user()->last_name}}</b>
                            </p>  
                            <p>
                                Other Names: <b>{{Auth::user()->first_name}} {{Auth::user()->middle_name}}</b>
                            </p> 
                            <p>
                                Faculty: <b>{{Auth::user()->faculty}}</b>
                            </p> 
                            <p>
                                Department: <b>{{Auth::user()->department}}</b>
                            </p>
                            <p>
                                Course of study: <b>{{Auth::user()->course_of_study}}</b>
                            </p> 
                        </div>
                    </div>
                        <hr>
                        <div class="float-left">
                            <h5><b> Other Information </b></h5>
                        </div>
                        <div class="float-right">
                            @if (!empty($student))
                                <a href="/student/profile/org/edit">
                                    <i class="fas fa-edit"></i> EDIT
                                </a>
                            @else
                                <a href="/student/profile/org/add">
                                    <i class="fas fa-edit"></i> ADD
                                </a>
                            @endif
                        </div>
                        <br>
                        <div class="mt-3">
                            @if (!empty($student))
                                <p>
                                    Year of Industrial Training: <b> {{$student->year_of_training}}</b>
                                </p>
                                <p>
                                    Duration of Industrial Training: <b>{{$student->duration_of_training}}</b>
                                </p> 
                                <p>
                                    Signature:
                                    <img src="" alt="{{$student->signature}}" width="180" height="30">
                                </p>
                            @else
                                <p>
                                    Address During Industrial Training: <b>No info</b> 
                                </p>
                                <p>
                                    Year of Industrial Training: <b>No info</b>
                                </p>
                                <p>
                                    Duration of Industrial Training: <b>No info</b>
                                </p> 
                                <p>
                                    Signature:
                                    <img src="" alt="no signature" width="180" height="30">
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection