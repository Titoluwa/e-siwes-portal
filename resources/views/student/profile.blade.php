@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning">
                <div class="card-header border-warning bg-othe-color clearfix">

                    <div class="float-left mt-2 blue-text">
                        <h4 style="font-weight: 700;">{{ __("Student Profile") }}</h4>
                    </div>
                    <div class="float-right mt-2">
                        <a href="/student/profile/edit">
                            <i class="fas fa-edit"></i>EDIT
                        </a>
                    </div>                    
                </div>

                <div class="card-body">
                    <div class="m-2">
                        @if ($student->user->profile_pic != null)
                            <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. $student->user->profile_pic)}}" alt="profile image" srcset="" width="150" height="150">
                        @else
                            <img class="rounded border-warning float-right img-thumbnail" src="{{asset('images/user_default.png')}}" alt="profile image" srcset="" width="150" height="150">
                        @endif
                        <div>
                            <p>
                                Registration Number: <b>{{$student->matric_no}}</b>
                            </p>
                            <p>
                                Surname: <b>{{$student->user->last_name}}</b>
                            </p>  
                            <p>
                                Other Names: <b>{{$student->user->first_name}} {{$student->user->middle_name}}</b>
                            </p> 
                            <p>
                                Faculty: <b>{{$student->faculty}}</b>
                            </p> 
                            <p>
                                Department: <b>{{$student->department}}</b>
                            </p>
                            <p>
                                Course of study: <b>{{$student->course_of_study}}</b>
                            </p>
                            <p>
                                E-mail Address: <b>{{$student->user->email}}</b>
                            </p> 
                            <p>
                                Signature:
                                <img src="{{asset('storage/'. $student->signature)}}" alt="{{$student->signature}}" width="180" height="30">
                            </p>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection