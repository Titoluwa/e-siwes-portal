@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-lg-8 mb-4">
            <div class="card border-warning">

                <div class="card-body p-5">
                    <h3 class="text-center">Welcome, <b>{{Auth::user()->last_name}}!</b></h3>
                    <p class="text-center">You're logged in</p>

                    <div class="text-center p-3 row">
                        <div class="col-lg-3 mb-2">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle btn btn-sm bg-oth-color nav-text-color" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-book"></i> Materials
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach ($materials as $material)
                                        <a class="dropdown-item" href="/download/{{$material->id}}">{{$material->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-2">
                            <button type="submit" class="btn bg-oth-color nav-text-color" onclick="swep200Display()">
                                SWEP 200
                            </button>
                        </div>
                        <div class="col-lg-3 mb-2">
                            <button type="submit" class="btn bg-oth-color nav-text-color" onclick="siwes300Display()">
                                SIWES 300
                            </button>
                        </div>
                        <div class="col-lg-3 mb-2">
                            <button type="submit" class="btn bg-oth-color nav-text-color" onclick="siwes400Display()">
                                SIWES 400
                            </button>
                        </div>
                    </div>

                    <div id="swep-200" style="display: none">
                       
                        <p class="text-center">SWEP 200 held at Amphi Theatre</p>
                        @if ($siwes200 != null)
                            <div class="text-center">
                                <a href="/student/log200" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                            </div>
                        @else
                            <hr>
                            <p class="text-center p-3"><b>Fill this form to start your SWEP 200</b></p>
                            <form method="POST" action="/student/log/initiate" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="siwes_type_id" value="1">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="student_id" value="{{$student->id}}">

                                <div class="form-group row">
                                    <label for="session_id" class="col-md-4 col-form-label">Session for SWEP 200</label>
                                    <div class="col-md-6">
                                        <select class="form-control  @error('session_id') is-invalid @enderror" name="session_id" id="session_id">
                                            <option value="" disabled selected>Select Session</option>
                                            @foreach($sessions as $session)
                                                <option value="{{$session->id}}">{{$session->year}}</option>
                                            @endforeach
                                        </select>
                                        @error('session_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="resumption_date" class="col-md-4 col-form-label">Resumption Date</label>
                                    <div class="col-md-6">
                                        <input class="form-control  @error('resumption_date') is-invalid @enderror" type="date" name="resumption_date" id="resumption_date">
                                        @error('resumption_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ending_date" class="col-md-4 col-form-label">Ending Date</label>
                                    <div class="col-md-6">
                                        <input class="form-control  @error('ending_date') is-invalid @enderror" type="date" name="ending_date" id="ending_date">
                                        @error('ending_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="offset-md-9">
                                        <button type="submit" class="btn bg-oth-color nav-text-color">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        
                    </div>
                    
                    <div id="siwes-300" style="display: none;">
                        @if ($siwes300 != null)
                            <p class="text-center">SIWES 300 training at <b>{{$siwes300->org->name}}</b></p>
                            <div class="text-center">
                                <a href="/student/log300" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                            </div>  
                        @else
                            <hr>
                            <p class="text-center"><b>Fill this form to start your SIWES 300</b></p>
                            <form method="POST" action="/student/log/initiate" enctype="multipart/form-data">
                                @csrf                      
                                <input type="hidden" name="siwes_type_id" value="2">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="student_id" value="{{$student->id}}">


                                <div class="form-group row">
                                    <label for="session_id" class="col-md-4 col-form-label">Session for SIWES 300</label>
                                    <div class="col-md-6">
                                        <select class="form-control  @error('session_id') is-invalid @enderror" name="session_id" id="session_id">
                                            <option value="" disabled selected>Select Session</option>
                                            @foreach($sessions as $session)
                                                <option value="{{$session->id}}">{{$session->year}}</option>
                                            @endforeach
                                        </select>
                                        @error('session_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="resumption_date" class="col-md-4 col-form-label">Resumption Date</label>
                                    <div class="col-md-6">
                                        <input class="form-control  @error('resumption_date') is-invalid @enderror" type="date" name="resumption_date" id="resumption_date">
                                        @error('resumption_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ending_date" class="col-md-4 col-form-label">Ending Date</label>
                                    <div class="col-md-6">
                                        <input class="form-control  @error('ending_date') is-invalid @enderror" type="date" name="ending_date" id="ending_date">
                                        @error('ending_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="org_id" class="col-md-4 col-form-label">Organization Name</label>
                                    <div class="col-md-6">
                                        <select class="form-control  @error('org_id') is-invalid @enderror" name="org_id" id="org_id">
                                            <option value="" disabled selected>Select from database</option>
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
                                    <label for="year_of_training" class="col-md-4 col-form-label">Year of SIWES</label>
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
                                    <label for="duration_of_training" class="col-md-4 col-form-label">Duration of SIWES</label>
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
                                {{-- <div class="form-group row">
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
                                </div> --}}

                                <div class="row">
                                    <div class="offset-md-10">
                                        <button type="submit" class="btn bg-oth-color nav-text-color">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        
                        @endif 
                    </div>
                    
                    <div id="siwes-400" style="display: none;">
                        @if ($siwes400 != null)
                            <p class="text-center">SIWES 400 training at <b>{{$siwes400->org->name}}</b></p>  
                            <div class="text-center">
                                <a href="/student/log" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                            </div>
                        @else
                            <hr>
                            <p class="text-center"><b>Fill this form to start your SIWES 400</b></p>
                            <form method="POST" action="/student/log/initiate" enctype="multipart/form-data">
                                @csrf                      
                                <input type="hidden" name="siwes_type_id" value="3">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="student_id" value="{{$student->id}}">

                                <div class="form-group row">
                                    <label for="session_id" class="col-md-4 col-form-label">Session for SIWES 400</label>
                                    <div class="col-md-6">
                                        <select class="form-control  @error('session_id') is-invalid @enderror" name="session_id" id="session_id">
                                            <option value="" disabled selected>Select Session</option>
                                            @foreach($sessions as $session)
                                                <option value="{{$session->id}}">{{$session->year}}</option>
                                            @endforeach
                                        </select>
                                        @error('session_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="resumption_date" class="col-md-4 col-form-label">Resumption Date</label>
                                    <div class="col-md-6">
                                        <input class="form-control  @error('resumption_date') is-invalid @enderror" type="date" name="resumption_date" id="resumption_date">
                                        @error('resumption_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ending_date" class="col-md-4 col-form-label">Ending Date</label>
                                    <div class="col-md-6">
                                        <input class="form-control  @error('ending_date') is-invalid @enderror" type="date" name="ending_date" id="ending_date">
                                        @error('ending_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="org_id" class="col-md-4 col-form-label">Organization Name</label>
                                    <div class="col-md-6">
                                        <select class="form-control  @error('org_id') is-invalid @enderror" name="org_id" id="org_id" required >
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
                                {{-- <div class="form-group row">
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
                                </div> --}}

                                <div class="row">
                                    <div class="offset-md-10">
                                        <button type="submit" class="btn bg-oth-color nav-text-color">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        
                        @endif 
                    </div>
                    

                </div>
             
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card border-warning">
                <div class="card-header border-warning blue-text bg-othe-color">
                   <h5 class="text-center mt-2"><i class="fa fa-chalkboard"></i> <b>Notice Board</b></h5>
                </div>
                <div class="card-body p-3">
                    @if (empty($announcement))
                        <h5 class="text-center">NO Notice has been posted!</h5>
                    @endif
                    @foreach ($announcements as $announce)
                        <div class="col-12 card border-warning mb-3 bg-othe-color">
                            <div class="card-body">
                                <div style="display: inline-flex">
                                    <img class="logo rounded" src="{{ asset('images/OAU-Logo.png') }}" width="30" height="30" alt="" srcset="">
                                    <p class="card-title"><b> &nbsp;{{$announce->title}}</b></p>
                                </div>
                                <p class="card-text">{{$announce->content}}</p>
                                <div style="align-text: left" class="float-right text-muted">
                                    <small class=""><i>For {{$announce->department}}</i></small>
                                    <br>
                                    <small class=""><i>Posted by: {{$announce->user->last_name}}</i></small>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function swep200Display() {
            document.getElementById("swep-200").style.display = "block";
            document.getElementById("siwes-300").style.display = "none";
            document.getElementById("siwes-400").style.display = "none";
        }
        function siwes300Display() {
            document.getElementById("swep-200").style.display = "none";
            document.getElementById("siwes-300").style.display = "block";
            document.getElementById("siwes-400").style.display = "none";
        }
        function siwes400Display() {
            document.getElementById("swep-200").style.display = "none";
            document.getElementById("siwes-300").style.display = "none";
            document.getElementById("siwes-400").style.display = "block";
        }
    </script>
@endsection