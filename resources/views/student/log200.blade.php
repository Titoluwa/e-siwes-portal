@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <div class="card-header border-warning bg-othe-color">
                    <div class="float-left blue-text">
                        <h3 style="font-weight: 700;">SWEP 200 LogBook</h3>
                        <small>Fill in your daily activities after each day of your SWEP classes </small>
                    </div>
                    <div class="float-right">

                    </div>
                </div>

                <div class="card-body border-warning m-4 p-2">
                    @if ($siwes200 != null)
                        <p class="text-center mb-4">You are to fill your Logbook with each day's activities.</p>

                        <div id="Records">
                            <div class="card border-primary">
                                <div class="card-header border-primary bg-othe-color " id="Daily_heading">
                                    <h4 class="mb-0 clearfix">
                                        <div class="float-left">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#DailyRecord" aria-expanded="true" aria-controls="DailyRecord">
                                                Daily Records
                                            </button>
                                        </div>

                                        <!-- Button trigger for Add Daily Activity modal -->
                                        <div class="float-right pt-1">
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#dailyactivityModal">
                                                <i class="fa fa-calendar-day"></i> Add
                                            </button>
                                        </div>
                                    </h4>
                                </div>

                                <div id="DailyRecord" class="collapse show" aria-labelledby="Daily_heading" data-parent="#Records">
                                    <div class="card-body">
                                        @if(!empty($all_dailys))
                                            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-2">
                                                @foreach($all_dailys as $rec)
                                                <div class="col mb-3">
                                                    <div class="card h-100">
                                                        <div class="card-body">
                                                            <b class="card-title">{{$rec->day}}</b>
                                                            <small class="card-subtitle mb-2 text-muted">({{$rec->date}})</small>
                                                            <p class="card-text">{{$rec->description_of_work}}</p>
                                                        </div>
                                                        <div class="card-footer clearfix">
                                                            @if($rec->weeked==0)
                                                                <a data-toggle="modal" data-target="#edit_daily_modal" onclick="get_dailyrecord({{$rec->id}})" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                                            
                                                                <div class="float-right">
                                                                    <input class="delete_val" type="hidden" value="{{$rec->id}}">
                                                                    <a class="delete btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </div>
                                                            @else
                                                            <div class="mt-4"></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <h5 class="text-center p-2">
                                                No Daily Record
                                            </h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card border-primary">
                                <div class="card-header border-primary bg-othe-color" id="Weekly_heading">
                                    <h4 class="mb-0 clearfix">
                                        <div class="float-left">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#WeeklyRecord" aria-expanded="false" aria-controls="WeeklyRecord">
                                                Weekly Records
                                            </button>
                                        </div>
                                        <!-- Button trigger for Add Weekly Activity modal -->
                                        <div class="float-right pt-1">
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#weekactivityModal">
                                                <i class="fa fa-calendar-week"></i> Add
                                            </button>
                                        </div>
                                    </h4>
                                </div>

                                <div id="WeeklyRecord" class="collapse" aria-labelledby="Weekly_heading" data-parent="#Records">
                                    <div class="card-body">
                                        @if(!empty($all_weeks))
                                            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 g-4">
                                                @foreach($all_weeks as $weekrec)
                                                <div class="col mb-3">
                                                    <div class="card h-100">
                                                        <div class="card-body">
                                                            <h6 class="card-title"><b>{{$weekrec->name}}</b></h6>
                                                            <h6 class="card-subtitle mb-2 text-muted">Department/Section: {{$weekrec->department}}</h6>
                                                            <p class="card-text">{{$weekrec->description_of_week}}</p>
                                                        </div>
                                                        <div class="card-footer clearfix">
                                                            <div class="d-flex">
                                                                <div class="">
                                                                    @if ($weekrec->org_sup_approval == 0)
                                                                        <a data-toggle="modal" data-target="#edit_weekly_modal" onclick="get_weeklyrecord({{$weekrec->id}})" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                                                    @endif
                                                                    </div>
                                                                <div class="px-2">
                                                                    <a data-toggle="modal" data-target="#view_weekly_modal" onclick="get_weeklyrecord({{$weekrec->id}})" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i>View</a>
                                                                </div>
                                                                <div class="ml-auto">
                                                                    @if ($weekrec->org_sup_approval == 0)
                                                                        <small class="oth-color">Pending</small>
                                                                        <input class="delete_val" type="hidden" value="{{$weekrec->id}}">
                                                                        <a class="delete-week btn btn-sm btn-danger">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </a>
                                                                    @else
                                                                        <i class="text-success">Seen <i class="fas fa-check-circle"></i></i>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <h5 class="text-center p-2">
                                            No Weekly Record
                                            </h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card border-primary">
                                <div class="card-header border-primary bg-othe-color" id="Monthly_heading">
                                    <h4 class="mb-0 clearfix">
                                        <div class="float-left">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#MonthlyRecord" aria-expanded="false" aria-controls="MonthlyRecord">
                                                Monthly Records
                                            </button>
                                        </div>

                                        <!-- Button trigger for Add Monthly Activity modal -->
                                        <div class="float-right pt-1">
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#monthlyactivityModal">
                                                <i class="fa fa-calendar-alt"></i> Add
                                            </button>
                                        </div>
                                    </h4>
                                </div>

                                <div id="MonthlyRecord" class="collapse" aria-labelledby="Monthly_heading" data-parent="#Records">
                                    <div class="card-body">
                                        @if(!empty($monthlyrecords))
                                            <div class="row row-cols-1 g-4">
                                                @foreach($monthlyrecords as $month)
                                                <div class="col mb-3">
                                                    <div class="card h-100">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><b>{{$month->name}}</b></h5>
                                                            
                                                            <p class="card-text">{{$month->description_of_month}}</p>
                                                        </div>
                                                        <div class="card-footer clearfix">
                                                            <div class="d-flex">
                                                                <div class="">
                                                                    @if (empty($month->org_sup_comment))
                                                                        <a data-toggle="modal" data-target="#edit_monthly_modal" onclick="get_monthlyrecord({{$month->id}})" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>Edit</a>
                                                                    @endif
                                                                </div>
                                                                <div class="px-2">
                                                                    <a data-toggle="modal" data-target="#view_monthly_modal" onclick="get_monthlyrecord({{$month->id}})" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i>View</a>
                                                                </div>
                                                                <div class="ml-auto">
                                                                    @if (empty($month->org_sup_comment))
                                                                        <small class="oth-color">Pending</small>
                                                                        <input class="delete_val" type="hidden" value="{{$month->id}}">
                                                                        <a class="delete-month btn btn-sm btn-danger">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </a>
                                                                    @else
                                                                        <i class="text-success">Assessed <i class="fas fa-check-circle"></i></i>
                                                                    @endif
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <h5 class="text-center p-2">
                                            No Montly Record
                                            </h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                    @else
                        <h5 class="text-center pb-3"><b>Fill this form to start your SWEP 200 here</b></h5>
                        <form method="POST" action="/student/log/initiate" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="siwes_type_id" value="1">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                            <div class="form-group row">
                                <label for="session_id" class="col-md-4 col-form-label">Session for SWEP 200</label>
                                <div class="col-md-6">
                                    <select class="form-control  @error('session_id') is-invalid @enderror" name="session_id" id="session_id">
                                        <option value="" disabled selected>Select from  database</option>
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
                            {{--<div class="form-group row">
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
                        <!-- MODALS -->
                <!-- Add Daily Activity Modal -->
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="dailyactivityModal" tabindex="-1" role="dialog" aria-labelledby="dailyModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dailyModalLabel"><b><i class="fa fa-calendar-day"></i> Daily Activity</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form class="" action="/student/log/daily" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                @if ($siwes200 != null)
                                    <input type="hidden" name="siwes_id" value="{{$siwes200->id}}">
                                @endif
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="day" class="col-form-label">Pick Day</label>
                                        <select class="form-control  @error('day') is-invalid @enderror" name="day" id="day">
                                            <option value="" disabled selected>Day</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                        </select>
                                        @error('day')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date" class="col-form-label">Date</label>
                                        <input type="date" name="date" id="date" value="{{$currentdate}}" class="form-control @error('date') is-invalid @enderror">
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="description_of_work" class="col-form-label">Description of work</label>
                                        <textarea class="form-control @error('description_of_work') is-invalid @enderror" id="description_of_work" name="description_of_work" rows="5"></textarea>
                                        @error('description_of_work')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Daily Activity Modal -->
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="edit_daily_modal" tabindex="-1" role="dialog" aria-labelledby="edit_dailyModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_dailyModalLabel"><b>Edit Daily Activity</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form class="" action="/student/log/daily/update" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" id="edit_id">
                                        <label for="day" class="col-form-label">Pick Day</label>
                                        <select class="form-control  @error('day') is-invalid @enderror" name="day" id="edit_day">
                                            <option value="" disabled selected>Day</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                        </select>
                                        @error('day')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date" class="col-form-label">Date</label>
                                        <input type="date" name="date" id="edit_date" value="" class="form-control @error('date') is-invalid @enderror">
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="description_of_work" class="col-form-label">Description of work</label>
                                        <textarea class="form-control @error('description_of_work') is-invalid @enderror" id="edit_description_of_work" name="description_of_work" rows="5"></textarea>
                                        @error('description_of_work')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- Add Weekly Activity Modal -->
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="weekactivityModal" tabindex="-1" role="dialog" aria-labelledby="weeklyModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="weeklyModalLabel"><b><i class="fa fa-calendar-week"></i> Weekly Activity  </b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form class="" action="/student/log/weekly" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                @if ($siwes200 != null)
                                    <input type="hidden" name="siwes_id" value="{{$siwes200->id}}">
                                @endif

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="col-form-label"><b>Name Week</b></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                        <!-- <select class="form-control  @error('name') is-invalid @enderror" name="name" id="name">
                                            <option value="" disabled selected>Week</option>
                                            <option value="Week 1">Week 1</option>
                                            <option value="Week 2">Week 2</option>
                                            <option value="Week 3">Week 3</option>
                                            <option value="Week 4">Week 4</option>
                                        </select>     -->
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="daily_records" class="col-form-label"><b>Pick Days</b></label>
                                        @if(!empty($dailyrecords))
                                            @foreach($dailyrecords as $rec)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="daily_records[]" value="{{$rec->id}}" id="{{$rec->date}}">
                                                    <label class="form-check-label" for="{{$rec->date}}">
                                                        <b>{{$rec->date}}</b> ({{$rec->day}})
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-check">
                                               <p>No Daily Record</p>
                                            </div>
                                        @endif

                                        @error('daily_records')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="department" class="col-form-label"><b>Department/Section</b></label>
                                        <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}">

                                        @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="description_of_week" class="col-form-label"><b>Description of Week</b></label>
                                        <textarea class="form-control @error('description_of_week') is-invalid @enderror" id="description_of_week" name="description_of_week" rows="5">{{old('description_of_week')}}</textarea>
                                        @error('description_of_week')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Weekly Activity Modal -->
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="edit_weekly_modal" tabindex="-1" role="dialog" aria-labelledby="edit_weeklyModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_weeklyModalLabel"><b><i class="fa fa-calendar-week"></i> Edit Weekly Activity  </b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form action="/student/log/weekly/update" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="id" id="edit_w_id" value="">
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="col-form-label"><b>Name Week</b></label>
                                        <!-- <select class="form-control  @error('name') is-invalid @enderror" name="name" id="edit_w_name">
                                            <option value="" disabled selected>Week</option>
                                            <option value="Week 1">Week 1</option>
                                            <option value="Week 2">Week 2</option>
                                            <option value="Week 3">Week 3</option>
                                            <option value="Week 4">Week 4</option>
                                        </select>     -->
                                        <input id="edit_w_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="daily_records" class="col-form-label"><b>Pick Days</b></label>

                                        @if(!empty($all_dailys))
                                            @foreach($all_dailys as $rec)
                                                <div class="form-check">
                                                    <input class="drecord form-check-input" type="checkbox" name="daily_records[]" value="{{$rec->id}}" id="{{$rec->id}}">
                                                    <label class="form-check-label" for="{{$rec->id}}">
                                                        <b>{{$rec->date}}</b> ({{$rec->day}})
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-check">
                                               <p>No Daily Record</p>
                                            </div>
                                        @endif

                                        @error('daily_records')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="department" class="col-form-label"><b>Department/Section</b></label>
                                        <input id="edit_w_department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}">

                                        @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="description_of_week" class="col-form-label"><b>Description of Week</b></label>
                                        <textarea class="form-control @error('description_of_week') is-invalid @enderror" id="edit_description_of_week" name="description_of_week" rows="5"></textarea>
                                        @error('description_of_week')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- View Weekly Activity Modal -->
                <div class="modal fade" id="view_weekly_modal" tabindex="-1" role="dialog" aria-labelledby="view_weekly" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="view_weekly"><b><i class="fa fa-calendar-week"></i> <span id="weekname">Week</span></b></h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="">
                                    <div class="p-2"><h6>
                                        <b>Department: </b> <span id="week_dept"></span></h6>
                                    </div>
                                    <div class="p-2"><h6>
                                        <b>Description of Week: </b> <span id="week_dow"></span></h6>
                                    </div>
                                    <div class="p-2">
                                        <h6><b>Days in week: </b> </h6>
                                        <div class="">
                                            <table id="myTable" class="table table-bordered table-hover" style="width:100%">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="col-2">Day</th>
                                                        <th class="col-2">Date</th>
                                                        <th class="col-8">Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="week_days">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Monthly Activity Modal -->
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="monthlyactivityModal" tabindex="-1" role="dialog" aria-labelledby="monthlyModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="monthlyModal"><b><i class="fa fa-calendar-alt"></i> Monthly Activity</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form class="" action="/student/log/monthly" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                @if ($siwes200 != null)
                                    <input type="hidden" name="siwes_id" value="{{$siwes200->id}}">
                                @endif

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="col-form-label"><b>Name of Month</b></label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="daily_records" class="col-form-label"><b>Pick Weeks</b></label>
                                        @if(!empty($weeklyrecords))
                                            @foreach($weeklyrecords as $rec)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="weekly_records[]" value="{{$rec->id}}" id="{{$rec->name}}">
                                                    <label class="form-check-label" for="{{$rec->name}}">
                                                        <b>{{$rec->name}}</b> ({{$rec->department}})
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-check">
                                               <p>No Weekly Record</p>
                                            </div>
                                        @endif

                                        @error('daily_records')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="description_of_month" class="col-form-label"><b>Description of Month</b></label>
                                        <textarea class="form-control @error('description_of_month') is-invalid @enderror" id="description_of_month" name="description_of_month" rows="8">{{old('description_of_month')}}</textarea>
                                        @error('description_of_month')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="sketch" class="col-form-label"><b>Any Sketch or Image Description</b></label>
                                        <input type="file" name="sketch" id="sketch" class="form-control-file @error('sketch') is-invalid @enderror" value="{{ old('sketch') }}">
                                        @error('sketch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Monthly Activity Modal -->
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="edit_monthly_modal" tabindex="-1" role="dialog" aria-labelledby="edit_monthlyModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit_monthlyModal"><b><i class="fa fa-calendar-week"></i> Edit Monthly Activity  </b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form action="/student/log/monthly/update" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="e_month_id" >
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="col-form-label"><b>Name of Month</b></label>
                                        <input id="e_month_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="weekly_records" class="col-form-label"><b>Pick Weeks</b></label>
                                        @if(!empty($all_weeks))
                                            @foreach($all_weeks as $rec)
                                                <div class="form-check">
                                                    <input class="wrecord form-check-input" type="checkbox" name="weekly_records[]" value="{{$rec->id}}" id="{{$rec->id}}">
                                                    <label class="form-check-label" for="{{$rec->id}}">
                                                        <b>{{$rec->name}}</b> ({{$rec->department}})
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-check">
                                               <p>No Weekly Record</p>
                                            </div>
                                        @endif

                                        @error('weekly_records')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="description_of_month" class="col-form-label"><b>Description of Month</b></label>
                                        <textarea class="form-control @error('description_of_month') is-invalid @enderror" id="e_description_of_month" name="description_of_month" rows="8">{{old('description_of_month')}}</textarea>
                                        @error('description_of_month')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="sketch" class="col-form-label"><b>Any Sketch or Image Description</b></label>
                                        <input type="file" name="sketch" id="e_sketch" class="form-control-file @error('sketch') is-invalid @enderror" value="{{ old('sketch') }}">
                                        @error('sketch')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <!-- View Monthly Activity Modal -->
                <div class="modal fade" id="view_monthly_modal" tabindex="-1" role="dialog" aria-labelledby="view_monthly" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="view_monthly"><b><i class="fa fa-calendar-alt"></i> <span id="monthname">Week</span></b></h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="">
                                    <!-- <div class="p-2"><h6>
                                        <b>Department: </b> <span id="week_dept"></span></h6>
                                    </div> -->
                                    <div class="p-2"><h6>
                                        <b>Description of Month: </b> <p class="p-2" id="month_dow"></p></h6>
                                    </div>
                                    <div class="p-2">
                                        <h6><b>Weeks in this Month: </b> </h6>
                                        <div class="">
                                            <table id="myTable" class="table table-bordered table-hover" style="width:100%">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="col-2">Week</th>
                                                        <th class="col-2">Department</th>
                                                        <th class="col-8">Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="weeks">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <h6>
                                            <b>Industry-based Supervisor Assessment: </b> 
                                            <p class="p-2" id="org_comment"></p>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!-- Delete Scripts  -->
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete').click(function(e) {
                e.preventDefault();
                var delete_id = $(this).closest('div').find('.delete_val').val();
                // alert(delete_id);
                swal({
                    title: "Delete Day Record?",
                    text: "You will not be able to recover this day's record",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": delete_id,
                        }
                        $.ajax({
                            type: "DELETE",
                            url: "/student/log/daily/"+ delete_id,
                            data: data,
                            success: function (response){
                                swal(response.status, {
                                    icon: "success",
                                })
                                .then((result)=>{
                                    location.reload();
                                });
                            }
                        });
                    }
                });

            });
            $('.delete-week').click(function(e) {
                e.preventDefault();
                var delete_id = $(this).closest('div').find('.delete_val').val();
                swal({
                    title: "Delete Week Record?",
                    text: "You will not be able to recover this week's record",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": delete_id,
                        }
                        $.ajax({
                            type: "DELETE",
                            url: "/student/log/weekly/"+ delete_id,
                            data: data,
                            success: function (response){
                                swal(response.status, {
                                    icon: "success",
                                })
                                .then((result)=>{
                                    location.reload();
                                });
                            }
                        });
                    }
                });

            });
            $('.delete-month').click(function(e) {
                e.preventDefault();
                var delete_id = $(this).closest('div').find('.delete_val').val();
                swal({
                    title: "Delete Month Record?",
                    text: "You will not be able to recover this month's record",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": delete_id,
                        }
                        $.ajax({
                            type: "DELETE",
                            url: "/student/log/monthly/"+ delete_id,
                            data: data,
                            success: function (response){
                                swal(response.status, {
                                    icon: "success",
                                })
                                .then((result)=>{
                                    location.reload();
                                });
                            }
                        });
                    }
                });

            });
        });
    </script>

    <!-- Get Scripts -->
    <script  type="text/javascript">
        function get_dailyrecord(id){
            $.get('/student/log/daily/'+id, function(data){
                $('#edit_id').val(data.id);
                $('#edit_day').val(data.day);
                $('#edit_date').val(data.date);
                $('#edit_description_of_work').val(data.description_of_work);
            })
        };
        function get_weeklyrecord(id){
            $.get('/student/log/weekly/'+id, function(data)
            {
                console.log(data);
                $('#edit_w_id').val(data.record.id);
                $('#edit_w_name').val(data.record.name);
                $('#edit_w_department').val(data.record.department);
                $('#edit_description_of_week').val(data.record.description_of_week);
                $('#weekname').html(data.record.name);
                $('#week_dept').html(data.record.department);
                $('#week_dow').html(data.record.description_of_week);
                $('#week_days').html(' ');
                $('.drecord').removeAttr('checked', 'checked');
                $.each(data.days, function(index, val)
                {
                    var id = val.id;
                    if(id){
                        $('#'+id).attr('checked', 'checked');
                    }
                    $('#week_days').append(`
                        <tr>
                            <td>${val.day}</td>
                            <td>${val.date}</td>
                            <td>${val.description_of_work}</td>
                        </tr>
                    `);
                });
            })
        };
        function get_monthlyrecord(id){
            $.get('/student/log/monthly/'+id, function(data)
            {
                $('#e_month_id').val(data.record.id);
                $('#e_month_name').val(data.record.name);
                $('#e_description_of_month').val(data.record.description_of_month);

                $('#monthname').html(data.record.name);
                $('#month_dow').html(data.record.description_of_month);
                $('#org_comment').html(data.record.org_sup_comment);
                $('#weeks').html(' ');
                $('.wrecord').removeAttr('checked', 'checked');

                $.each(data.weeks, function(index, val)
                {
                    var id = val.id;
                    console.log(data.weeks);
                    if(id){
                        $('#'+id).attr('checked', 'checked');
                    }
                    $('#weeks').append(`
                        <tr>
                            <td>${val.name}</td>
                            <td>${val.department}</td>
                            <td>${val.description_of_week}</td>

                        </tr>
                    `);
                });
            })
        }
    </script>
@endsection
