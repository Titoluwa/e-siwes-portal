@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning">
                <div class="card-header border-warning bg-transparent clearfix">

                    <div class="float-left mt-2">
                        <h4 style="font-weight: 600;">{{ __("Edit Organization Profile") }}</h4>
                    </div>
                    <div class="float-right mt-1">
                        <a href="/student/orgprofile" class="btn bg-oth-color nav-text-color">
                            BACK
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    <form method="POST" action="/" enctype="multipart/form-data">
                        @csrf                      

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Student Name</label>

                            <div class="col-md-5">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->last_name}} {{Auth::user()->first_name}}" disabled>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="org_name" class="col-md-3 col-form-label">Organization Name</label>
                            <div class="col-md-5">
                                <select class="form-control  @error('org_name') is-invalid @enderror" name="org_name" id="org_name">
                                    <option value="" disabled selected>Select from  database</option>
                                    <option value="">Cavidel</option>
                                    <option value="">Opolo</option>
                                    <option value="">Randall Ltd</option>
                                    <option value="">Eastwind Labs</option>
                                </select>
                                @error('org_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- <label for="org_address" class="col-md-2 col-form-label">Organization Address</label>
                            <div class="col-md-4">
                                <input id="org_address" type="text" class="form-control @error('org_address') is-invalid @enderror" name="org_address" value="{{old('org_name')}}" required>

                                @error('org_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> -->
                        </div>
                                                
                        <!-- <div class="form-group row">
                            <label for="middle_name" class="col-md-2 col-form-label">Year of establishment</label>
                            <div class="col-md-4">
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{Auth::user()->middle_name}}" required autocomplete="middle_name" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                        </div>

                        <div class="form-group row">
                            <label for="faculty" class="col-md-2 col-form-label">Area of Specialization</label>
                            <div class="col-md-4">
                                <input id="faculty" type="text" class="form-control @error('faculty') is-invalid @enderror" name="faculty" value="{{Auth::user()->faculty}}" required autocomplete="faculty" autofocus>

                                @error('faculty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="department" class="col-md-2 col-form-label">Postal Address</label>
                            <div class="col-md-4">
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{Auth::user()->department}}" required autocomplete="department" autofocus>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="row py-2">
                            <div class="offset-md-10">
                                <button type="submit" class="btn btn-lg bg-oth-color nav-text-color">
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