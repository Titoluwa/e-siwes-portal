@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-warning">
                <div class="card-header border-warning bg-othe-color clearfix">

                    <div class="float-left mt-2 blue-text">
                        <h3 style="font-weight: 700;">{{ __("Organization Profile") }}</h3>
                        <p>This is information about your organization of Training</p>
                    </div>
                    @if (!empty($student))
                    <div class="float-right mt-4">
                        <a href="/student/org/edit">
                            <i class="fas fa-edit"></i>EDIT
                        </a>
                    </div>
                    @endif

                </div>

                <div class="card-body">
                    @if (!empty($student))
                        <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. $student->org->logo)}}" alt="organization logo" srcset="" width="150" height="150">
                        <div>
                            <p>
                                Student Name: <b>{{$student->user->last_name}}, {{$student->user->first_name}} {{$student->user->middle_name}}</b>
                            </p>
                            <p>
                                Organization Name: <b>{{$student->org->name}}</b>
                            </p>
                            <p>
                                Year of establishment: <b>{{$student->org->year_of_est}}</b>
                            </p>
                            <p>
                                Postal Address: <b>{{$student->org->postal_address}}</b>
                            </p>
                            <p>
                                Area of Specialization: <b>{{$student->org->specialization}}</b>
                            </p>
                            <p>
                                Address During Industrial Training: <b>{{$student->org->full_address}}</b>
                            </p>
                            <p>
                                Year of Industrial Training: <b>{{$student->year_of_training}}</b>
                            </p>
                            <p>
                                Duration of Industrial Training: <b>{{$student->duration_of_training}}</b>
                            </p>
                        </div>

                    @else
                        <p class=""><b>Add Organization to your profile</b></p>
                        <form method="POST" action="/student/org/add" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="org_id" class="col-md-4 col-form-label">Organization Name</label>
                                <div class="col-md-6">
                                    <select class="form-control  @error('org_id') is-invalid @enderror" name="org_id" id="org_id">
                                        <option value="" disabled selected>Select from  database</option>
                                        @foreach($orgs as $org)
                                            <option value="{{$org->id}}">{{$org->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('org_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="year_of_training" class="col-md-4 col-form-label">Year of IT</label>
                                <div class="col-md-6">

                                    <select class="form-control  @error('year_of_training') is-invalid @enderror" name="year_of_training" id="year_of_training">
                                        <option value="" disabled selected>Select Year</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                    @error('year_of_training')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="duration_of_training" class="col-md-4 col-form-label">Duration of IT</label>
                                <div class="col-md-6">
                                    <select class="form-control  @error('duration_of_training') is-invalid @enderror" name="duration_of_training" id="duration_of_training">
                                        <option value="" disabled selected>Select Duration</option>
                                        <option value="3 weeks">3 weeks</option>
                                        <option value="6 weeks">6 weeks</option>
                                        <option value="3 months">3 months</option>
                                        <option value="6 months">6 months</option>
                                    </select>
                                    @error('duration_of_training')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-4" for="signature">Signature</label>
                                <div class="col-md-6">
                                    <!-- <img src="{{asset('storage/')}}" alt="" width="60" height="60"> -->
                                    <input type="file" class="@error('signature') is-invalid @enderror" id="signature" name="signature">
                                    @error('signature')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="offset-md-10">
                                    <button type="submit" class="btn bg-oth-color nav-text-color">
                                    ADD
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- <p class="text-center"><b>Add Organization to profile</b></p>

                        <form class="form" action="/student/org/add" method="POST">
                            @csrf

                            <div class="form-group row justify-content-center">
                                <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <label for="org_id" class="text-center col-form-label">Organization Name</label>
                                        <div class="">
                                            <select class="form-control  @error('org_id') is-invalid @enderror" name="org_id" id="org_id">
                                                <option value="" disabled selected>Select from  database</option>
                                                @foreach($orgs as $org)
                                                    <option value="{{$org->id}}">{{$org->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('org_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn bg-oth-color nav-text-color">ADD</button>
                                </div>
                            </div>
                        </form> -->
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
