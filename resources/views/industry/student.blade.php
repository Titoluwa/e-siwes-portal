@extends('layouts.industry')

@section('industrycontent')

    <div class="col-md-12">
        <div class="card border-warning">

            <div class="card-header border-warning ">
                <h4 class="mt-2 text-center blue-text"><b>{{$student->user->name()}}</b></h4>
            </div>

            <div class="card-body border-warning bg-light">
                <div class="mt-3">
                    <div class="col-md-3 float-right">
                        <img class="rounded border-warning img-thumbnail float-right" src="{{asset('storage/'. $student->user->profile_pic)}}" alt="profile image" srcset="" width="150" height="150">
                    </div>

                    <div class="col-md-9">
                        <p>
                            Registration Number: <b>{{$student->matric_no}}</b>
                        </p>
                        <hr>
                        <p>
                            Surname: <b>{{$student->user->last_name}}</b>
                        </p>
                        <hr>
                        <p>
                            Other Names: <b>{{$student->user->first_name}} {{$student->user->middle_name}}</b>
                        </p>
                        <hr>
                        <p>
                            Faculty: <b>{{$student->faculty}}</b>
                        </p>
                        <hr>
                        <p>
                            Department: <b>{{$student->department}}</b>
                        </p>
                        <hr>
                        <p>
                            Course of study: <b>{{$student->course_of_study}}</b>
                        </p>
                        <hr>
                        <p>
                            Address during of Industrial Training: <b> {{$student->org->full_address}}</b>
                        </p>
                        <hr>
                        <p>
                            Year of Industrial Training: <b> {{$student->year_of_training}}</b>
                        </p>
                        <hr>
                        <p>
                            Duration of Industrial Training: <b>{{$student->duration_of_training}}</b>
                        </p>
                        <hr>
                        <p>
                            Signature:
                            <img src="{{asset('storage/'. $student->signature)}}" alt="{{$student->signature}}" width="180" height="30">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
