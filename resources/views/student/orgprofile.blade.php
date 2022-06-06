@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent clearfix">

                    <div class="float-left mt-2">
                        <h3 style="font-weight: 700;">{{ __("Organization Profile") }}</h3>
                        <p>This is information about your organization of Training</p>
                    </div>
                    <div class="float-right mt-4">
                        <a href="/student/org/edit">
                            <i class="fas fa-edit"></i>EDIT
                        </a>
                    </div>
                    
                </div>

                <div class="card-body">
                    <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. $student->org->logo)}}" alt="organization logo" srcset="" width="150" height="150">
                    <div>
                        <p>
                            Student Name: <b>{{$student->user->first_name}}, {{$student->user->first_name}} {{$student->user->middle_name}}</b>
                        </p>
                        <p>
                            Organization Name: <b>{{$student->org->name}}</b>
                        </p>
                        <p>
                            Year of establishment: <b>{{$student->org->year_of_est}}</b>
                        </p>  
                        <p>
                            Postal Address: <b>{{$student->org->postal_address}}</b>
                        </p> 
                        <p>
                            Area of Specialization: <b>{{$student->org->specialization}}</b>
                        </p> 
                        <p>
                            Address During Industrial Training: <b>{{$student->org->full_address}}</b> 
                        </p>
                        <p>
                            Year of Industrial Training: <b>{{$student->year_of_training}}</b>
                        </p>
                        <p>
                            Duration of Industrial Training: <b>{{$student->duration_of_training}}</b>
                        </p> 
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection