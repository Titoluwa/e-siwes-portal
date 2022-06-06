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
                    <form method="POST" action="/" enctype="multipart/form-data">
                        @csrf                      

                        <div class="form-group row">
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
                        </div>
                        <div class="form-group row">
                            <label for="address_of_training" class="col-md-2 col-form-label">Address of IT</label>
                            <div class="col-md-4">
                                <textarea name="address_of_training" id="address_of_training" cols="29" rows="2"></textarea>
                                @error('address_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="year_of_training" class="col-md-2 col-form-label">Year of IT</label>
                            <div class="col-md-4">
                                
                                <select class="form-control  @error('year_of_training') is-invalid @enderror" name="year_of_training" id="year_of_training">
                                    <option value="" disabled selected>Select Year</option>
                                    <option value="">2021</option>
                                    <option value="">2022</option>
                                    <option value="">2023</option>
                                    <option value="">2024</option>
                                </select>    
                                @error('year_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                         
                        </div>
                        <div class="form-group row">
                            <label for="duration_of_training" class="col-md-2 col-form-label">Duration of IT</label>
                            <div class="col-md-4">
                                <select class="form-control  @error('duration_of_training') is-invalid @enderror" name="duration_of_training" id="duration_of_training">
                                    <option value="" disabled selected>Select Duration</option>
                                    <option value="">3 weeks</option>
                                    <option value="">6 weeks</option>
                                    <option value="">3 months</option>
                                    <option value="">6 months</option>
                                </select>
                                @error('duration_of_training')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label class="col-form-label col-md-2" for="signature">Signature</label>
                            <div class="col-md-4">
                                <!-- <img src="{{asset('storage/')}}" alt="" width="60" height="60"> -->
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