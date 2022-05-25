@extends('layouts.app')

@section('homelink', '/industry')

@section('nav')
    <a class="nav-link" href="/industry/org">Register Organization</a>
    <a class="nav-link" href="/industry/student">Manage Students</a>
@endsection

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card border-warning">

            <div class="card-header border-warning bg-transparent">
                <h4 class="mt-2 text-center">{{ __('Register Your Organization') }}</h4>
            </div>

            <div class="card-body border-warning">
                <form method="POST" action="/industry/orgreg" enctype="multipart/form-data">
                    @csrf                      

                    <div class="form-group row">
                        <label for="staff_id" class="col-md-2 col-form-label">Supervisor Name</label>

                        <div class="col-md-4">
                            <input type="hidden" name="staff_id" value="{{Auth::user()->id}}">
                            <input id="super_name" type="integer" class="form-control @error('super_name') is-invalid @enderror" name="super_name" placeholder="{{Auth::user()->last_name}} {{Auth::user()->first_name}}" disabled>

                            @error('staff_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="name" class="col-md-2 col-form-label"> Organization Name</label>
                        <div class="col-md-4">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required>    
                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="full_address" class="col-md-2 col-form-label">Address</label>
                        <div class="col-md-4">
                            <input id="full_address" type="text" class="form-control @error('full_address') is-invalid @enderror" name="full_address" value="{{old('full_address')}}" required>

                            @error('full_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="postal_address" class="col-md-2 col-form-label">Postal Address</label>
                        <div class="col-md-4">
                            <input id="postal_address" type="text" class="form-control @error('postal_address') is-invalid @enderror" name="postal_address" value="{{old('postal_address')}}" required>

                            @error('postal_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                                            
                    <div class="form-group row">
                        <label for="year_of_est" class="col-md-2 col-form-label">Year of establishment</label>
                        <div class="col-md-4">
                            <input id="year_of_est" type="month" class="form-control @error('year_of_est') is-invalid @enderror" name="year_of_est" value="{{old('year_of_est')}}" required >

                            @error('year_of_est')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="nature" class="col-md-2 col-form-label">Nature of Business</label>
                        <div class="col-md-4">
                            <input id="nature" type="text" class="form-control @error('nature') is-invalid @enderror" name="nature" value="{{old('nature')}}" required >

                            @error('nature')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                                            
                    </div>

                    <div class="form-group row">
                        <label for="specialization" class="col-md-2 col-form-label">Area of Specialization</label>
                        <div class="col-md-4">
                            <input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{old('specialization')}}" required >

                            @error('specialization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label class="col-form-label col-md-2" for="plant_capacity">Plant Capacity</label>
                        <div class="col-md-4">
                            <input id="plant_capacity" type="text" class="form-control @error('plant_capacity') is-invalid @enderror" name="plant_capacity" value="{{old('plant_capacity')}}" required >
                            @error('plant_capacity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                    </div>
                    <div class="form-group row">
                        <label for="other_info" class="col-md-2 col-form-label">Other Infornmation</label>
                        <div class="col-md-4">
                            <input id="other_info" type="text" class="form-control @error('other_info') is-invalid @enderror" name="other_info" value="{{old('other_info')}}" required >

                            @error('other_info')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label class="col-form-label col-md-2" for="logo">Logo</label>
                        <div class="col-md-4">
                            <input type="file" class="@error('logo') is-invalid @enderror" id="logo" name="logo">
                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                    </div>

                    <div class="row py-2">
                        <div class="offset-md-10">
                            <button type="submit" class="btn bg-oth-color nav-text-color">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection