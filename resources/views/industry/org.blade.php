@extends('layouts.app')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card border-warning">

            <div class="card-header border-warning bg-transparent">
                <h5 class="mt-2 text-center">{{ __('Register Your Organisation') }}</h5>
            </div>

            <div class="card-body border-warning">
                <form method="POST" action="/" enctype="multipart/form-data">
                    @csrf                      

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Supervisor Name</label>

                        <div class="col-md-4">
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->last_name}} {{Auth::user()->first_name}}" disabled>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="org_name" class="col-md-2 col-form-label">Organization Name</label>
                        <div class="col-md-4">
                            <input id="org_name" type="text" class="form-control @error('org_name') is-invalid @enderror" name="org_name" value="{{old('org_name')}}" required>    
                            
                            @error('org_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="org_address" class="col-md-2 col-form-label">Address</label>
                        <div class="col-md-4">
                            <input id="org_address" type="text" class="form-control @error('org_address') is-invalid @enderror" name="org_address" value="{{old('org_name')}}" required>

                            @error('org_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                                            
                    <div class="form-group row">
                        <label for="year_of_add" class="col-md-2 col-form-label">Year of establishment</label>
                        <div class="col-md-4">
                            <input id="year_of_add" type="text" class="form-control @error('year_of_add') is-invalid @enderror" name="year_of_add" value="{{old('year_of_add')}}" required >

                            @error('year_of_add')
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
                        <label for="specialization" class="col-md-2 col-form-label">Area of Specialization</label>
                        <div class="col-md-4">
                            <input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{old('specialization')}}" required >

                            @error('specialization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label class="col-form-label col-md-2" for="logo">Organisation Logo</label>
                        <div class="col-md-4">
                            <!-- <img src="{{asset('storage/'. Auth::user()->logo)}}" alt="" width="60" height="60"> -->
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
                            Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection