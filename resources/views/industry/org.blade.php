@extends('layouts.industry')

@section('title', 'Add Organisation')
 
@section('industrycontent')

    <div class="col-lg-12">
        <div class="card border-warning">

            <div class="card-header border-warning bg-transparent blue-text clearfix mt-2 ">
                <div class="float-left">
                    <h4 class=""><b>{{ __('Register Your Organization') }}</b> </h4>
                </div>
                <div class="float-right">
                    <a class="btn btn-warning" href="/industry"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>

            <div class="card-body border-warning">
                <form method="POST" action="/industry/org" enctype="multipart/form-data">
                    @csrf                      

                    <div class="form-group row p-1">
                        <input type="hidden" id='user_id' name="user_id" value="{{Auth::user()->id}}">

                        <div class="col-lg-4">
                            <label for="super_name" class="col-form-label">Supervisor Name</label>
                            <input id="super_name" type="integer" class="form-control @error('super_name') is-invalid @enderror" name="super_name" placeholder="{{Auth::user()->name()}}" disabled>

                            @error('super_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label for="name" class="col-form-label"> Organization Name<small class="text-danger">*</small></label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required>    
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label class="col-form-label " for="logo">Logo</label>
                            <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo">
                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row p-1">
                        <div class="col-lg-3">
                            <label for="state" class="col-form-label">State<small class="text-danger">*</small></label>
                            <select name="state" id="state" value="{{ old('state') }}" class="form-control @error('state') is-invalid @enderror" data-dependant='area' required>
                                <option value="" selected disabled>Select State</option>
                                <option value="Lagos">Lagos</option>
                                <option value="Osun">Osun</option>
                                <option value="Abuja">Abuja</option>
                                <option value="Oyo">Oyo</option>
                                <option value="Ondo">Ondo</option>
                                <option value="Ogun">Ogun</option>
                                <option value="Kwara">Kwara</option>
                                <option value="Kogi">Kogi</option>
                                <option value="Ekiti">Ekiti</option>
                                <option value="Enugu">Enugu</option>
                                <option value="Edo">Edo</option>
                                <option value="Plateau">Plateau</option>
                            </select>
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-3">
                            <label for="area" class=" col-form-label">Area<small class="text-danger">*</small></label>
                            <select name="area" id="area" value="{{ old('area') }}" class="form-control @error('area') is-invalid @enderror" required>
                                <option value="" selected disabled>Select Area</option>
                                <option value="Ketu">Ketu</option>
                                <option value="Ile-Ife">Ile-Ife</option>
                                <option value="Lokogoma">Lokogoma</option>
                                <option value="Ibadan">Ibadan</option>
                                <option value="Ikeja">Ikeja</option>
                                <option value="Abeokuta">Abeokuta</option>
                                <option value="Ogbomosho">Ogbomosho</option>
                                <option value="Osogbo">Osogbo</option>
                                <option value="Port-harcourt">Port-harcourt</option>
                                <option value="Benin">Benin</option>
                                <option value="Lokoja">Lokoja</option>
                                <option value="Jos">Jos</option>
                            </select>
                            @error('area')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label for="full_address" class=" col-form-label">Full Address<small class="text-danger">*</small></label>

                            <input id="full_address" type="text" class="form-control @error('full_address') is-invalid @enderror" name="full_address" value="{{old('full_address')}}" required>

                            @error('full_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row p-1">
                        <div class="col-lg-4">
                            <label for="postal_address" class=" col-form-label">Postal Address<small class="text-danger">*</small> <small>(company email)</small></label>

                            <input id="postal_address" type="email" class="form-control @error('postal_address') is-invalid @enderror" name="postal_address" value="{{old('postal_address')}}" required>

                            @error('postal_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-3">
                            <label for="year_of_est" class=" col-form-label">Year of establishment<small class="text-danger">*</small></label>
                            <input id="year_of_est" type="date" class="form-control @error('year_of_est') is-invalid @enderror" name="year_of_est" value="{{old('year_of_est')}}" required >

                            @error('year_of_est')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-5">
                            <label for="nature" class=" col-form-label">Nature of Business<small class="text-danger">*</small></label>
                            <input id="nature" type="text" class="form-control @error('nature') is-invalid @enderror" name="nature" value="{{old('nature')}}" required >

                            @error('nature')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row p-1">
                        <div class="col-lg-4">
                            <label class="col-form-label " for="stamp">Office Stamp<small class="text-danger">*</small></label>
                            <input type="file" class="form-control-file @error('stamp') is-invalid @enderror" id="stamp" name="stamp">
                            @error('stamp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label for="specialization" class=" col-form-label">Area of Specialization<small class="text-danger">*</small></label>
                            <input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{old('specialization')}}" required >

                            @error('specialization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                        <label class="col-form-label " for="plant_capacity">Plant Capacity</label>
                            <input id="plant_capacity" type="text" class="form-control @error('plant_capacity') is-invalid @enderror" name="plant_capacity" value="{{old('plant_capacity')}}">
                            @error('plant_capacity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                    </div>
                    <div class="form-group row p-1">
                        <div class="col-lg-12">
                            <label for="other_info" class=" col-form-label">Other Information</label>
                            <textarea class="form-control" name="other_info" id="other_info" cols="30" rows="2">{{old('other_info')}}</textarea>
                            {{-- <input id="other_info" type="text" class="form-control @error('other_info') is-invalid @enderror" name="other_info" value="{{old('other_info')}}"> --}}

                            @error('other_info')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row col-lg-6">
                        <p class="text-danger">* Required</p>
                    </div>
                    <div class="row py-3">
                        <div class="offset-sm-5 offset-lg-10">
                            <button type="submit" class="btn bg-oth-color nav-text-color">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection