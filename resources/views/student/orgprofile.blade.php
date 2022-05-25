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
                        <a href="/student/orgprofile/edit">
                            <i class="fas fa-edit"></i>EDIT
                        </a>
                    </div>
                    
                </div>

                <div class="card-body">
                    <div>
                        <p>
                            Student Name: <b>{{Auth::user()->last_name}}, {{Auth::user()->first_name}} {{Auth::user()->middle_name}}</b>
                        </p>
                        <p>
                            Organization Name: <b>no info</b>
                        </p>
                        <p>
                            Year of establishment: <b>no info</b>
                        </p>  
                        <p>
                            Postal Address: <b>no info</b>
                        </p> 
                        <p>
                            Area of Specialization: <b>no info</b>
                        </p> 
                        <p>
                            Address During Industrial Training: <b>no info</b> 
                        </p>
                        <p>
                            Year of Industrial Training: <b>no info</b>
                        </p>
                        <p>
                            Duration of Industrial Training: <b>no info</b>
                        </p> 
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

@endsection