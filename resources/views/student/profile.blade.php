@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-oth-color"><h3 class="text-center">{{ __('Particulars') }}</h3></div>

                <div class="card-body">
                    <img class="rounded float-right img-thumbnail" src="{{asset('storage/'. Auth::user()->profile_pic)}}" alt="profile image" srcset="" width="150" height="150">
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
                        <p>
                            Year of Industrial Training: <b></b>
                        </p>
                        <p>
                            Address During Industrial Training: <b>no info yet</b> 
                        </p> 
                        <p>
                            Signature:
                            <img src="" alt="upload signature" width="150" height="30">
                        </p>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn bg-oth-color nav-text-color">
                            EDIT
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection