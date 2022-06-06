@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent clearfix">

                    <div class="float-left mt-2">
                        <h3 style="font-weight: 700;">{{ __("STUDENT PARTICULAR") }}</h3>
                    </div>
                    <div class="float-right mt-4">
                        <a href="/student/profile/edit">
                            <i class="fas fa-edit"></i>EDIT
                        </a>
                    </div>
                    
                </div>

                <div class="card-body">
                    <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. Auth::user()->profile_pic)}}" alt="profile image" srcset="" width="170" height="170">
                    <div>
                        <p>
                            Registration Number: <b>{{$student->user->matric_no}}</b>
                        </p>
                        <p>
                            Surname: <b>{{$student->user->last_name}}</b>
                        </p>  
                        <p>
                            Other Names: <b>{{$student->user->first_name}} {{$student->user->middle_name}}</b>
                        </p> 
                        <p>
                            Faculty: <b>{{$student->user->faculty}}</b>
                        </p> 
                        <p>
                            Department: <b>{{$student->user->department}}</b>
                        </p>
                        <p>
                            Course of study: <b>{{$student->user->course_of_study}}</b>
                        </p> 
                        
                        <p>
                            Address During Industrial Training: <b>{{$student->org->full_address}}</b> 
                        </p>
                        <p>
                            Year of Industrial Training: <b> {{$student->year_of_training}}</b>
                        </p>
                        <p>
                            Duration of Industrial Training: <b>{{$student->duration_of_training}}</b>
                        </p> 
                        <p>
                            Signature:
                            <img src="" alt="upload signature" width="180" height="30">
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

@endsection