@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent clearfix">

                    <div class="float-left mt-2">
                        <h4 style="font-weight: 600;">{{ __("Edit Student Organization Particular") }}</h4>
                    </div>
                    <div class="float-right mt-1">
                        <a href="/student/profile" class="btn bg-oth-color nav-text-color">
                            BACK
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="/student/profile/other/update" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf 

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Student Name</label>
                            <input type="hidden" id="id" name="id" value="{{$student->id}}">
                            <div class="col-md-5">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->last_name}} {{Auth::user()->first_name}}" disabled>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="org_name" class="col-md-3 col-form-label">Organization Name</label>
                            <div class="col-md-5">
                                <select class="form-control  @error('org_name') is-invalid @enderror" name="org_name" id="org_name">
                                    <option value="" disabled selected>Select from  database</option>
                                    @foreach($orgs as $org)
                                        <option value="{{$org->id}}" {{$student->org_id == $org->id  ? 'selected' : ''}}>{{$org->name}}</option>
                                    @endforeach
                                </select>
                                @error('org_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->
                        <!-- <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label">E-Mail Address</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}" disabled>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="matric_no" class="col-md-2 col-form-label">Matric Number</label>

                            <div class="col-md-4">
                                <input id="matric_no" type="text" class="form-control @error('matric_no') is-invalid @enderror" name="matric_no" value="{{Auth::user()->matric_no}}" disabled>

                                @error('matric_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->
                        <!-- <div class="form-group row">
                            <label for="address_of_training" class="col-md-3 col-form-label">Address of Training</label>
                            <div class="col-md-5">
                                <textarea name="address_of_training" id="address_of_training" cols="40" rows="1" disabled>{{$student->org->full_address}}</textarea>
                                @error('address_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="year_of_training" class="col-md-3 col-form-label">Year of Training</label>
                            <div class="col-md-5">
                                
                                <select class="form-control  @error('year_of_training') is-invalid @enderror" name="year_of_training" id="year_of_training">
                                    <option value="" disabled>Select Year</option>
                                    <option value="2021" {{$student->year_of_training == '2021' ? 'selected' : ''}}>2021</option>
                                    <option value="2022" {{$student->year_of_training == '2022' ? 'selected' : ''}}>2022</option>
                                    <option value="2023" {{$student->year_of_training == '2023' ? 'selected' : ''}}>2023</option>
                                    <option value="2024" {{$student->year_of_training == '2024' ? 'selected' : ''}}>2024</option>
                                </select>    
                                @error('year_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                         
                        </div>
                        <div class="form-group row">
                            <label for="duration_of_training" class="col-md-3 col-form-label">Duration of Training</label>
                            <div class="col-md-5">
                                <select class="form-control  @error('duration_of_training') is-invalid @enderror" name="duration_of_training" id="duration_of_training">
                                    <option value="" disabled >Select Duration</option>
                                    <option value="3 weeks" {{$student->duration_of_training == '3 weeks' ? 'selected' : ''}}>3 weeks</option>
                                    <option value="6 weeks" {{$student->duration_of_training == '6 weeks' ? 'selected' : ''}}>6 weeks</option>
                                    <option value="3 months" {{$student->duration_of_training == '3 months' ? 'selected' : ''}}>3 months</option>
                                    <option value="6 months" {{$student->duration_of_training == '6 months' ? 'selected' : ''}}>6 months</option>
                                </select>
                                @error('duration_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3" for="signature">Signature</label>
                            <div class="col-md-5">
                            <img src="{{asset('storage/'. $student->signature)}}" alt="{{$student->signature}}" width="180" height="30">
                                <input type="file" class="@error('signature') is-invalid @enderror" id="signature" name="signature">
                                @error('signature')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row py-2">
                            <div class="offset-md-10">
                                <button type="submit" class="btn bg-oth-color nav-text-color">
                                <i class="fas fa-edit"></i>SAVE
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection