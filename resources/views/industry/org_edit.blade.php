@extends('layouts.industry')

@section('title', 'Edit Organisation')

@section('industrycontent')

    <div class="col-md-12">
        <div class="card border-warning">
            <div class="card-header border-warning bg-transparent blue-text clearfix mt-2 ">
                <div class="float-left">
                    <h4 class=""><b>{{ __('Edit Organization') }}</b> </h4>
                </div>
                <div class="float-right">
                    <a class="btn btn-warning" href="/industry"><i class="fas fa-arrow-left"></i> Back</a>
                </div>
            </div>

            <div class="card-body border-warning">
                <form method="POST" action="/industry/org/update" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf                      
                    <input type="hidden" id='id' name="id" value="{{$org->id}}">

                    <div class="form-group row p-1">

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

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $org->name }}" required>    
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label class="col-form-label " for="logo">Logo</label>
                            <img src="{{asset('storage/'. $org->logo)}}" alt="" width="70" height="40">
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
                                <option value="" disabled>Select State</option>
                                <option value="Lagos" {{ ($org->state == "Lagos")? "selected" : "" }}>Lagos</option>
                                <option value="Osun" {{ ($org->state == "Osun")? "selected" : "" }}>Osun</option>
                                <option value="Abuja" {{ ($org->state == "Abuja")? "selected" : "" }}>Abuja</option>
                                <option value="Oyo"  {{ ($org->state == "Oyo")? "selected" : "" }}>Oyo</option>
                                <option value="Ondo" {{ ($org->state == "Ondo")? "selected" : "" }}>Ondo</option>
                                <option value="Ogun" {{ ($org->state == "Ogun")? "selected" : "" }}>Ogun</option>
                                <option value="Kwara" {{ ($org->state == "Kwara")? "selected" : "" }}>Kwara</option>
                                <option value="Kogi" {{ ($org->state == "Kogi")? "selected" : "" }}>Kogi</option>
                                <option value="Ekiti" {{ ($org->state == "Ekiti")? "selected" : "" }}>Ekiti</option>
                                <option value="Enugu" {{ ($org->state == "Enugu")? "selected" : "" }}>Enugu</option>
                                <option value="Edo" {{ ($org->state == "Edo")? "selected" : "" }}>Edo</option>
                                <option value="Plateau" {{ ($org->state == "Plateau")? "selected" : "" }}>Plateau</option>
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
                                <option value="" disabled>Select Area</option>
                                <option value="Ketu" {{ ($org->area == "Ketu")? "selected" : "" }}>Ketu</option>
                                <option value="Ile-Ife"{{ ($org->area == "Ile-Ife")? "selected" : "" }}>Ile-Ife</option>
                                <option value="Lokogoma" {{ ($org->area == "Lokogoma")? "selected" : "" }}>Lokogoma</option>
                                <option value="Ibadan" {{ ($org->area == "Ibadan")? "selected" : "" }}>Ibadan</option>
                                <option value="Ikeja" {{ ($org->area == "Ikeja")? "selected" : "" }}>Ikeja</option>
                                <option value="Abeokuta" {{ ($org->area == "Abeokuta")? "selected" : "" }}>Abeokuta</option>
                                <option value="Ogbomosho" {{ ($org->area == "Ogbomosho")? "selected" : "" }}>Ogbomosho</option>
                                <option value="Osogbo" {{ ($org->area == "Osogbo")? "selected" : "" }}>Osogbo</option>
                                <option value="Port-harcourt" {{ ($org->area == "Port-harcourt")? "selected" : "" }}>Port-harcourt</option>
                                <option value="Benin" {{ ($org->area == "Benin")? "selected" : "" }}>Benin</option>
                                <option value="Lokoja" {{ ($org->area == "Lokoja")? "selected" : "" }}>Lokoja</option>
                                <option value="Jos" {{ ($org->area == "Jos")? "selected" : "" }}>Jos</option>
                            </select>
                            @error('area')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label for="full_address" class=" col-form-label">Full Address<small class="text-danger">*</small></label>

                            <input id="full_address" type="text" class="form-control @error('full_address') is-invalid @enderror" name="full_address" value="{{ $org->full_address }}" required>

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

                            <input id="postal_address" type="email" class="form-control @error('postal_address') is-invalid @enderror" name="postal_address" value="{{ $org->postal_address }}" required>

                            @error('postal_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-3">
                            <label for="year_of_est" class=" col-form-label">Year of establishment<small class="text-danger">*</small></label>
                            <input id="year_of_est" type="date" class="form-control @error('year_of_est') is-invalid @enderror" name="year_of_est" value="{{$org->year_of_est}}" required >

                            @error('year_of_est')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-5">
                            <label for="nature" class=" col-form-label">Nature of Business<small class="text-danger">*</small></label>
                            <input id="nature" type="text" class="form-control @error('nature') is-invalid @enderror" name="nature" value="{{$org->nature}}" required >

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
                            <img src="{{asset('storage/'. $org->stamp)}}" alt="" width="70" height="40">
                            <input type="file" class="form-control-file @error('stamp') is-invalid @enderror" id="stamp" name="stamp">
                            @error('stamp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label for="specialization" class=" col-form-label">Area of Specialization<small class="text-danger">*</small></label>
                            <input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{$org->specialization}}" required >

                            @error('specialization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                        <label class="col-form-label " for="plant_capacity">Plant Capacity</label>
                            <input id="plant_capacity" type="text" class="form-control @error('plant_capacity') is-invalid @enderror" name="plant_capacity" value="{{$org->plant_capacity}}">
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
                            <textarea class="form-control" name="other_info" id="other_info" cols="30" rows="2">{{$org->other_info}}</textarea>
                            {{-- <input id="other_info" type="text" class="form-control @error('other_info') is-invalid @enderror" name="other_info" value="{{old('other_info')}}"> --}}

                            @error('other_info')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="offset-md-10">
                            <button type="submit" class="btn bg-oth-color nav-text-color">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection