@extends('layouts.industry')

@section('title', 'Student Logbook')

@section('style')
    <style>
    datalist {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        writing-mode: horizontal-tb;
        width: 100%;
    }
/* 
    option {
        padding: 0;
    }

    input[type="range"] {
        width: 200px;
        margin: 0;
    } */

    </style>

@endsection

@section('industrycontent')

    <div class="col-md-12">
        <div class="card border-warning">

            <div class="card-header border-warning clearfix mt-2 ">
                <div class="float-left">
                    <h4 class="mt-2 blue-text"><b>{{$siwes->user->name()}}'s LogBook for {{$siwes->siwes_type->name}}</b></h4>
                </div>
                <div class="float-right">
                    {{-- <a class="btn btn-warning" href="/industry"><i class="fas fa-arrow-left"></i> Back</a> --}}
                </div>
            </div>

            <div class="card-body border-warning bg-light">
                <div class="clearfix mt-1 ">
                    <div class="float-left">
                        <p class="blue-text mb-2">
                            You are to View and Assess this student weekly and monthly activitites at your Organization
                        </p>
                    </div>
                    <div class="float-right">
                        @if (!empty($org_assessment))
                            <button class="mb-4 btn btn-outline-secondary" data-toggle="modal" data-target="#supervisionForm">Edit Assessment</button>
                        @else
                            <button class="mb-4 btn btn-outline-secondary" data-toggle="modal" data-target="#supervisionForm">Assessment</button>
                        @endif
                        {{-- <div class="dropdown mb-4">
                            <a class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-file"></i> Forms
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/student/sp3">SP. 3</a>
                                <a class="dropdown-item" href="/student/form8">Form 8</a>
                                <a class="dropdown-item" href="/student/scaf">SCAF</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Assessment</a>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div id="Records">
                    <div class="card border-primary">
                        <div class="card-header border-primary bg-othe-color " id="Daily_heading">
                            <h4 class="mb-0 clearfix">
                                <div class="float-left">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#DailyRecord" aria-expanded="true" aria-controls="DailyRecord">
                                        Daily Records
                                    </button>
                                </div>
                            </h4>
                        </div>

                        <div id="DailyRecord" class="collapse show" aria-labelledby="Daily_heading" data-parent="#Records">
                            <div class="card-body">
                                @if(!empty($dailyrecords))
                                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-2">
                                        @foreach($dailyrecords as $rec)
                                        <div class="col mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <b class="card-title">{{$rec->day}}</b>
                                                    <small class="card-subtitle mb-2 text-muted">({{$rec->date}})</small>
                                                    <p class="card-text">{{$rec->description_of_work}}</p>
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
                            </h4>
                        </div>

                        <div id="WeeklyRecord" class="collapse" aria-labelledby="Weekly_heading" data-parent="#Records">
                            <div class="card-body">
                                @if(!empty($weeklyrecords))
                                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 g-4">
                                        @foreach($weeklyrecords as $weekrec)
                                        <div class="col mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h6 class="card-title"><b>{{$weekrec->name}}</b></h6>
                                                    <h6 class="card-subtitle mb-2 text-muted">Department/Section: {{$weekrec->department}}</h6>
                                                    <p class="card-text">{{$weekrec->description_of_week}}</p>
                                                </div>
                                                <div class="card-footer clearfix">
                                                    <div class="d-flex">
                                                        <div class="px-2">
                                                            <a data-toggle="modal" data-target="#view_weekly_modal" onclick="get_weeklyrecord({{$weekrec->id}})" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i>View</a>
                                                        </div>
                                                        
                                                        <div class="ml-auto">
                                                            @if ($weekrec->org_sup_approval == 0)
                                                                <small class="oth-color">Pending</small>
                                                                <input class="week_val" type="hidden" value="{{$weekrec->id}}">
                                                                <a class="approve-week btn btn-sm btn-outline-success">
                                                                    <i class="far fa-check-circle"></i> Mark as seen
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
                                                        <div class="px-2">
                                                            <a data-toggle="modal" data-target="#view_monthly_modal" onclick="get_monthlyrecord({{$month->id}})" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i>View</a>
                                                        </div>
                                                        
                                                        <div class="ml-auto">
                                                            @if (empty($month->org_sup_comment))
                                                                <small class="oth-color">Pending</small>
                                                                <a data-toggle="modal" data-target="#approve_month" onclick="get_monthlyrecord({{$month->id}})" class="btn btn-sm btn-outline-success"><i class="far fa-edit"></i> Add Assessment</a>
                                                            @else
                                                                <i class="text-success">Assessed <i class="fas fa-check-circle"></i></i>
                                                                <a data-toggle="modal" data-target="#approve_month" onclick="get_monthlyrecord({{$month->id}})" class="btn btn-sm btn-outline-primary"><i class="far fa-edit"></i> Edit Assessment</a>
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

            </div> 
                
<!-- MODALS -->

{{-- WEEKLY --}}
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

{{-- MONTHLY --}}
            <!-- Comment on Monthly Activity Modal -->
            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="approve_month" tabindex="-1" role="dialog" aria-labelledby="approve_monthlyModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approve_monthlyModal"><b><i class="fa fa-calendar-week"></i> Assess Monthly Activity  </b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><b>&times;</b></span>
                        </button>
                    </div>
                    <form action="/industry/log/monthly/update" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="e_month_id" >
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="name" class="col-form-label"><b>Name of Month</b></label>
                                    <input id="e_month_name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" disabled>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="description_of_month" class="col-form-label"><b>Description of Month</b></label>
                                    <textarea disabled class="form-control @error('description_of_month') is-invalid @enderror" id="e_description_of_month" name="description_of_month" rows="5">{{old('description_of_month')}}</textarea>
                                    @error('description_of_month')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="org_sup_comment" class="col-form-label"><b>Add your assessment here</b></label>
                                    <textarea class="form-control @error('org_sup_comment') is-invalid @enderror" id="e_org_sup_comment" name="org_sup_comment" rows="7">{{old('org_sup_comment')}}</textarea>
                                    @error('org_sup_comment')
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
                                <div class="p-2">
                                    <h6>
                                        <b>Description of Month: </b> 
                                        <p class="p-2" id="month_dow"></p>
                                    </h6>
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
{{-- ASSESSMENT --}}
            {{-- Supervision Form --}}
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="supervisionForm" tabindex="-1" role="dialog" aria-labelledby="supervisionFormModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center blue-text" id="supervisionFormModalLabel"><b style="font-weight:900"> @if (!empty($org_assessment)) <i class="fa fa-edit"></i> Edit @endif SIWES Assessment Report </b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><b>&times;</b></span>
                                </button>
                            </div>
                            @if (!empty($org_assessment))
                                <form action="/industry/supervision/update/{{$org_assessment->id}}" method="POST">
                                    @method('PUT')
                            @else
                                <form action="/industry/supervision/store" method="POST">
                            @endif
                                @csrf
                                <input type="hidden" name="siwes_id" value="{{$siwes->id}}">
                                <input type="hidden" name="supervisor_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="student_id" value="{{$siwes->student_id}}">
                                <div class="modal-body">
                                    <div class="row m-2">
                                        <div class="col-6 p-2">
                                            <label class="col-form-label" for="student">Name of Student: </label>
                                            <input class="form-control" type="text" name="student" id="student" disabled value="{{$siwes->user->name()}}">
                                        </div>
                                        <div class="col-6 p-2">
                                            <label class="col-form-label" for="reg_no">Registration Number: </label>
                                            <input class="form-control" type="text" name="reg_no" id="reg_no" disabled value="{{$siwes->student->matric_no}}">
                                        </div>
                                        <div class="col-6 p-2">
                                            <label class="col-form-label" for="org_name">Name of Industry: </label>
                                            <input class="form-control" type="text" name="org_name" id="org_name" disabled value="{{$siwes->org->name}}">
                                        </div>
                                        <div class="col-6 p-2">
                                            <label class="col-form-label" for="sup_name">Industry Supervisor </label>
                                            <input class="form-control" type="text" name="sup_name" id="sup_name" disabled value="{{Auth::user()->name()}}">
                                        </div>
                                        <div class="col-6 p-2">
                                            <label class="col-form-label" for="date_resumption">Date of Resumption: </label>
                                            <input class="form-control" type="text" name="date_resumption" id="date_resumption" disabled value="{{$siwes->resumption_date}}">
                                        </div>
                                        <div class="col-6 p-2">

                                        </div>
                                        <div class="col-6 p-2">
                                            <label class="col-form-label" for="qualitative"> General Qualitative Assessment:</label>
                                            <select name="qualitative" id="qualitative" class="form-control">
                                                @if (!empty($org_assessment))
                                                    <option value="" disabled>Select</option>
                                                    <option value="Poor" {{ ($org_assessment->qualitative == "Poor")? "selected" : "" }}>Poor</option>
                                                    <option value="Fair" {{ ($org_assessment->qualitative == "Fair")? "selected" : "" }}>Fair</option>
                                                    <option value="Good" {{ ($org_assessment->qualitative == "Good")? "selected" : "" }}>Good</option>
                                                    <option value="Very Good" {{ ($org_assessment->qualitative == "Very Good")? "selected" : "" }}>Very Good</option>
                                                    <option value="Excellent" {{ ($org_assessment->qualitative == "Excellent")? "selected" : "" }}>Excellent</option>
                                                @else
                                                    <option value="" selected disabled>Select</option>
                                                    <option value="Poor">Poor</option>
                                                    <option value="Fair">Fair</option>
                                                    <option value="Good">Good</option>
                                                    <option value="Very Good">Very Good</option>
                                                    <option value="Excellent">Excellent</option>
                                                @endif
                                                
                                            </select>
                                            {{-- <input class="form-control-range" type="range" id="qualitative" name="qualitative" list="values">
                                            <datalist id="values">
                                                <option value="Poor" label="Poor"></option>
                                                <option value="Fair" label="Fair"></option>
                                                <option value="Good" label="Good"></option>
                                                <option value="Very Good" label="Very Good"></option>
                                                <option value="Excellent" label="Excellent"></option>
                                            </datalist> --}}
                                        </div>
                                        <div class="col-lg-6 p-2">
                                            <label class="col-form-label" for="qualitative_score">Score <b>(/20)</b></label>
                                            @if ($org_assessment)
                                                <input class="form-control" type="number" name="qualitative_score" id="qualitative_score" min="0" max="20" value="{{$org_assessment->qualitative_score}}">
                                            @else
                                                <input class="form-control" type="number" name="qualitative_score" id="qualitative_score" min="0" max="20" value="{{old('qualitative_score')}}">
                                            @endif
                                        </div>                                
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- @endif --}}
            {{-- Edit Supervision Form --}}
            {{-- @if (!empty($assessment))
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="edit_supervisionForm" tabindex="-1" role="dialog" aria-labelledby="edit_supervisionFormModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center blue-text" id="edit_supervisionFormModalLabel"><b style="font-weight:900">Edit SIWES Supervision Form </b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form action="/school/supervision/update/{{$assessment->id}}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="siwes_id" value="{{$siwes->id}}">
                            <input type="hidden" name="user_id" value="{{$siwes->user_id}}">
                            <input type="hidden" name="student_id" value="{{$siwes->student_id}}">
                            <div class="modal-body">
                                <div class="row m-2">
                                    <div class="col-6 p-2">
                                        <label class="col-form-label" for="student">Name of Student: </label>
                                        <input class="form-control" type="text" name="student" id="student" disabled value="{{$student->user->name()}}">
                                    </div>
                                    <div class="col-6 p-2">
                                        <label class="col-form-label" for="reg_no">Registration Number: </label>
                                        <input class="form-control" type="text" name="reg_no" id="reg_no" disabled value="{{$student->matric_no}}">
                                    </div>
                                    <div class="col-8 p-2">
                                        <label class="col-form-label" for="course">Course: </label>
                                        <input class="form-control" type="text" name="course" id="course" disabled value="{{$student->course_of_study}}">
                                    </div>
                                    <div class="col-4 p-2">
                                        <label class="col-form-label" for="level">Level: </label>
                                        <select class="form-control" name="level" id="level" disabled>
                                            <option value="100" {{ ($siwes->level == "100")? "selected" : "" }}>100</option>
                                            <option value="200" {{ ($siwes->level == "200")? "selected" : "" }}>200</option>
                                            <option value="300" {{ ($siwes->level == "300")? "selected" : "" }}>300</option>
                                            <option value="400" {{ ($siwes->level == "400")? "selected" : "" }}>400</option>
                                            <option value="500" {{ ($siwes->level == "500")? "selected" : "" }}>500</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 p-2">
                                        <label class="col-form-label" for="industry_supervisor">Name of Industry based supervisor</label>
                                        <input class="form-control" type="text" name="industry_supervisor" id="industry_supervisor" disabled value="{{$siwes->org->name}}">
                                    </div>
                                    <div class="col-6 p-2">
                                        <label class="col-form-label" for="org_name">Name of Industry</label>
                                        <input class="form-control" type="text" name="org_name" id="org_name" disabled value="{{$siwes->org->name}}">
                                    </div>
                                    <div class="col-12 p-2">
                                        <label class="col-form-label" for="org_address">Address of Industry</label>
                                        <input class="form-control" type="text" name="org_address" id="org_address" disabled value="{{$siwes->org->full_address}}">
                                    </div>
                                    <div class="col-lg-4 p-2">
                                        <label class="col-form-label" for="visitation_date">Date of Visit:</label>
                                        <input class="form-control" type="date" name="visitation_date" id="visitation_date" value="{{$assessment->visitation_date }}" disabled>
                                    </div>
                                    <div class="col-8 p-2">
                                        
                                    </div>
                                    <div class="col-6 p-2">
                                        <label for="available_at_visit" class="col-form-label @error('available_at_visit') is-invalid @enderror">Is the student in the industry at the time of the visit <small class="text-danger">*</small></label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="available_at_visit" id="yes" value="1" {{ ($assessment->available_at_visit == "1")? "checked" : "" }}>
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="available_at_visit" id="no" value="0" {{ ($assessment->available_at_visit == "0")? "checked" : "" }}>
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                    <div class="col-6 p-2">
                                        <label class="col-form-label" for="why_not_available">If No, Why? </label>
                                        <input class="form-control" type="text" name="why_not_available" id="why_not_available" value="{{ $assessment->why_not_available }}"> 
                                    </div>
                                    <div class="col-6 p-2">
                    
                                        <label for="logbook_seen" class="col-form-label @error('logbook_seen') is-invalid @enderror">Is the Logbook sighted during the visit <small class="text-danger">*</small></label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="logbook_seen" id="yes" value="1" {{ ($assessment->logbook_seen == "1")? "checked" : "" }}>
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="logbook_seen" id="no" value="0" {{ ($assessment->logbook_seen == "0")? "checked" : "" }}>
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6 p-2">
                                        <label for="logbook_completed" class="col-form-label @error('logbook_completed') is-invalid @enderror">Is the Logbook up-to-date at the time of the visit <small class="text-danger">*</small></label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="logbook_completed" id="yes" value="1" {{ ($assessment->logbook_completed == "1")? "checked" : "" }}>
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="logbook_completed" id="no" value="0" {{ ($assessment->logbook_completed == "0")? "checked" : "" }}>
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                    <div class="col-6 p-2">
                                        <label for="logbook_appropriate" class="col-form-label @error('logbook_appropriate') is-invalid @enderror">Is the Logbook appropriately completed <small class="text-danger">*</small></label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="logbook_appropriate" id="yes" value="1" {{ ($assessment->logbook_appropriate == "1")? "checked" : "" }}>
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="logbook_appropriate" id="no" value="0" {{ ($assessment->logbook_appropriate == "0")? "checked" : "" }}>
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                    </div>
                                    <div class="col-6 p-2">
                                        <label class="col-form-label" for="why_not_appropriate">If No, state the deficiencies? </label>
                                        <textarea class="form-control" name="why_not_appropriate" id="why_not_appropriate" rows="2">{{ $assessment->why_not_appropriate }}</textarea>
                                    </div>
                                    <div class="col-12 p-2">
                                        <label class="col-form-label" for="attitude_student"> Attitude of the student to training</label>
                                        <input class="form-control" type="text" name="attitude_student" id="attitude_student" value="{{ $assessment->attitude_student }}">
                                    </div>
                                    <div class="col-12 p-2">
                                        <label class="col-form-label" for="challenges"> Any major challenge(s) requiring immediate attetion of the SIWES office ? Please specify</label>
                                        <textarea class="form-control" name="challenges" id="challenges" rows="2">{{ $assessment->challenges }}</textarea>
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
            @endif --}}
        </div>
    </div>

@endsection

@section('scripts')

    <script  type="text/javascript">
        //  Get Scripts
        function get_weeklyrecord(id)
        {
            $.get('/student/log/weekly/'+id, function(data)
            {
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
        
        function get_monthlyrecord(id)
        {
            $.get('/student/log/monthly/'+id, function(data)
            {
                $('#e_month_id').val(data.record.id);
                $('#e_month_name').val(data.record.name);
                $('#e_description_of_month').val(data.record.description_of_month);
                $('#e_org_sup_comment').val(data.record.org_sup_comment);
                

                $('#monthname').html(data.record.name);
                $('#month_dow').html(data.record.description_of_month);
                $('#org_comment').html(data.record.org_sup_comment);
                $('#weeks').html(' ');
                $('.wrecord').removeAttr('checked', 'checked');

                $.each(data.weeks, function(index, val)
                {
                    var id = val.id;
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
        };

        // To approve Week Activities 
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.approve-week').click(function(e) {
                e.preventDefault();
                var week_id = $(this).closest('div').find('.week_val').val();
                swal({
                    title: "Approve Week Record?",
                    text: "Are you sure you want to APPROVE this week's record",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                // Not DELETING.. it is for approving the weeks' activity.
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": week_id,
                        }
                        $.ajax({
                            type: "POST",
                            url: "/industry/weekly/approve/"+ week_id,
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

@endsection
