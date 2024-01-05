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
                            You are to View and Assess this student weekly and monthly activities at your Organization
                        </p>
                    </div>
                    <div class="float-right mb-4">
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-file"></i> Forms
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if($form8 != null && $form8->student_filled != null && $form8->employer_filled == null) 
                                    <a class="dropdown-item" data-toggle="modal" data-target="#fill_form8_modal">Fill Form 8</a>
                                @elseif ($form8 != null && $form8->employer_filled != null)
                                    @if ($siwes->printed('form8') == 1)
                                        <a class="dropdown-item text-muted">Form8 <sup>Printed</sup></a>
                                    @else
                                        <a class="dropdown-item" data-toggle="modal" data-target="#fill_form8_modal">Edit Form 8</a>  
                                    @endif
                                @endif
                                @if (!empty($org_assessment))
                                    @if ($siwes->printed('siar') == 1)
                                        <a class="dropdown-item text-muted">Assessment <sup>Printed</sup></a>
                                    @else
                                        <a class="dropdown-item" data-toggle="modal" data-toggle="modal" data-target="#supervisionForm">Edit Assessment</a>  
                                    @endif    
                                @else
                                    <a class="dropdown-item" data-toggle="modal" data-toggle="modal" data-target="#supervisionForm">Assessment</a>
                                @endif
                            </div>
                        </div>
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
                                    <div class="col-lg-6">
                                        <label class="col-form-label" for="student">Name of Student: </label>
                                        <input class="form-control" type="text" name="student" id="student" disabled value="{{$siwes->user->name()}}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-form-label" for="reg_no">Registration Number: </label>
                                        <input class="form-control" type="text" name="reg_no" id="reg_no" disabled value="{{$siwes->student->matric_no}}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-form-label" for="org_name">Name of Industry: </label>
                                        <input class="form-control" type="text" name="org_name" id="org_name" disabled value="{{$siwes->org->name}}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-form-label" for="sup_name">Industry Supervisor </label>
                                        <input class="form-control" type="text" name="sup_name" id="sup_name" disabled value="{{Auth::user()->name()}}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-form-label" for="date_resumption">Date of Resumption: </label>
                                        <input class="form-control" type="text" name="date_resumption" id="date_resumption" disabled value="{{$siwes->resumption_date}}">
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6">
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
                                    <div class="col-lg-6">
                                        <label class="col-form-label" for="qualitative_score">Score <b>(/20)</b></label>
                                        @if ($org_assessment)
                                            <input class="form-control" type="number" name="qualitative_score" id="qualitative_score" min="0" max="20" value="{{$org_assessment->qualitative_score}}">
                                        @else
                                            <input class="form-control" type="number" name="qualitative_score" id="qualitative_score" min="0" max="20" value="{{old('qualitative_score')}}">
                                        @endif
                                    </div>                                
                                </div>
                                <br>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Fill Form 8 -->
            @if ($form8 != null)
                <div class="modal fade" id="fill_form8_modal" tabindex="-1" role="dialog" aria-labelledby="fill_form8" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fill_form8"><b> END-OF-PROGRAMME REPORT SHEET (Form 8) </b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><b>&times;</b></span>
                                </button>
                            </div>
                            <form id="Form8" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="siwes_id" id="form8_siwes_id" value="{{$siwes->id}}">
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label for="name" class="col-form-label"><b>Student Fullname</b></label>
                                            <input type="text" class="form-control" value="{{ $siwes->user->name() }} {{ $siwes->user->middle_name }}" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="matric_no" class="col-form-label"><b>Matric Number</b></label>
                                            <input type="text" class="form-control" value="{{ $siwes->student->matric_no }}" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="course_of_study" class="col-form-label"><b>Course of Study</b></label>
                                            <input type="text" class="form-control" value="{{ $siwes->student->course_of_study }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label for="" class="col-form-label"><b>Reporting Officer</b></label>
                                            <input type="text" class="form-control" value="{{ Auth()->user()->name()}}" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="org" class="col-form-label"><b>Organization of Attachment</b></label>
                                            <input type="text" class="form-control" value="{{ $siwes->org->name }}" disabled>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="employer_rank" class="col-form-label"><b>Rank</b></label>
                                            <input type="text" class="form-control" name="employer_rank" value="{{$form8->employer_rank}}" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-8">
                                            <label for="experience_outline" class="col-form-label"><b>Brief outline of experience/relevance of training provided (by student) </b></label>
                                            <textarea name="experience_outline" id="experience_outline" class="form-control" rows="2" disabled>{{$form8->experience_outline}}</textarea>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="total_allowance" class="col-form-label"><b>Total Allowance Received (by student)</b></label>
                                            <input type="text" class="form-control" name="total_allowance" value="{{$form8->total_allowance}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label for="employer_agree_3" class="col-form-label"><b>Do you agree with what the student filled above?</b></label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="employer_agree_3" id="yes" value="1" {{ ($form8->employer_agree_3 == "1")? "checked" : "" }}>
                                                <label class="form-check-label" for="yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="employer_agree_3" id="no" value="0" {{ ($form8->employer_agree_3 == "0")? "checked" : "" }}>
                                                <label class="form-check-label" for="no">No</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="employer_total_allowance" class="col-form-label"><b>Total amount paid to student as ITF allowance </b></label>
                                            <input type="number" class="form-control" name="employer_total_allowance" value="{{$form8->employer_total_allowance}}">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label for="employer_assessment" class="col-form-label"><b> Assess the student's overall performance </b></label>
                                            <input type="text" class="form-control" name="employer_assessment" required value="{{$form8->employer_assessment}}">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="accept_student" class="col-form-label"><b>Will you accept the student in any future attachment?</b></label>
                                            <input type="text" class="form-control" name="accept_student" value="{{$form8->accept_student}}">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-12">
                                            <label for="future_position" class="col-form-label"><b>Is your Company/Establishment in a position to offer this student a job in the future?</b></label>
                                            {{-- <textarea name="future_position" class="form-control" rows="1"></textarea> --}}
                                            <input type="text" class="form-control" name="future_position" value="{{ $form8->future_position}}">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4">
                                            <label for="employer_filled" class="col-form-label"><b>Submission Date</b></label>
                                            <input type="date" class="form-control" name="employer_filled_disabled" value="{{$currentdate}}" disabled>
                                            <input type="hidden" name="employer_filled" id="employer_filled" value="{{$currentdate}}" >
                                        </div>
                                    </div>
                        
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" id="form8_submission" class="btn btn-warning">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
                
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
    {{-- Form 8 Submit Script  --}}
    <script>
        $('#form8_submission').click(function(e) {
            e.preventDefault();
            var form = $("#Form8");
            swal({
                title: "Submit Form 8?",
                text: "You will not be able to edit this form after Submission",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "/industry/log/form8",
                        data: form.serialize(),
                        success: function (response){
                            swal(response.status, {
                                icon: "success",
                                buttons: "OK",
                            })
                            .then((result)=>{
                                location.reload();
                            });
                        }
                    });
                }
            });
        });
    </script>

@endsection
