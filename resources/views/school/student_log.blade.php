@extends('layouts.school')

@section('title', 'Student Logbook')

@section('schoolcontent')

    <div class="col-md-12 m-4">
        <div class="card border-warning">

            <div class="card-header border-warning ">
                <div class="float-left blue-text">
                    <h4 class="m-2 blue-text"><b>{{$student->user->name()}}</b>'s logbook for <span>{{$siwes->siwes_type->name}}</span></h4>
                </div>
                
                <div class="float-right">
                    @if (!empty($siwes))
                        @if ($siwes->siwes_type_id == 1)
                            <div class="dropdown">
                                <a class="btn btn-sm btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-file"></i> SWEP 200
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" disabled>Assessment</a>
                                </div>
                            </div>
                        @elseif ($siwes->siwes_type_id == 2)
                            <div class="dropdown">
                                <a class="btn btn-sm btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-file"></i> Forms
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#SP3previewmodal">SP.3</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#Scafpreviewmodal">SCAF</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#ssfpreviewmodal">Supervision Form<</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#siarpreviewmodal">Industry Assessment Report</a>
                                </div>
                            </div>
                        @elseif ($siwes->siwes_type_id == 3)
                            <div class="dropdown">
                                <a class="btn btn-sm btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-file"></i> Form
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#SP3previewmodal">SP.3</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#Scafpreviewmodal">SCAF</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#siarpreviewmodal">Industry Assessment Report</a>
                                    @if (empty($assessment) && ($siwes->assigned_staff->user->id == Auth()->user()->id ))
                                        <a class="dropdown-item" data-toggle="modal" data-toggle="modal" data-target="#supervisionForm">Fill Supervision Form</a>
                                    @else
                                        <a class="dropdown-item" data-toggle="modal" data-target="#ssfpreviewmodal">Supervision Form</a>
                                    @endif
                                    @if ($siwes->assigned_staff->user->id == Auth()->user()->id )
                                        @if($form8 != null && $form8->student_filled != null && $form8->employer_filled != null && $form8->staff_filled == null)  
                                            <a class="dropdown-item" data-toggle="modal" data-target="#fill_form8_modal">Fill Form 8</a>
                                        @elseif ($form8 != null && $form8->staff_filled != null)
                                            <a class="dropdown-item" data-toggle="modal" data-target="#fill_form8_modal">Edit Form 8</a>
                                        @endif
                                    @endif
                                    <a class="dropdown-item" data-toggle="modal" data-target="#Form8previewmodal">Form 8</a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <div class="card-body border-warning bg-light">

                <p class="text-center blue-text mb-2">
                    View and Assess on this student's weekly and monthly activities at their Organization of attachment
                </p>
                <p class="text-center blue-text mb-2">
                    Assigned to <b>{{$siwes->assigned_staff->user->name()}} - (0{{$siwes->assigned_staff->user->contact_no}} / {{$siwes->assigned_staff->department}})</b>
                </p>
                @if (!empty($assessment) && ($siwes->assigned_staff->user->id == Auth()->user()->id ))
                    <p class="text-center">
                        <b class="text-success">Visitation Supervision Assessment has been submitted. </b> <a  data-toggle="modal" data-target="#edit_supervisionForm" ><i class="fa fa-edit"></i> Edit</a>
                    </p>
                @endif
                <div id="Records" class="mt-4">
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
                                                                {{-- <input class="week_val" type="hidden" value="{{$weekrec->id}}">
                                                                <a class="approve-week btn btn-sm btn-outline-success">
                                                                    <i class="far fa-check-circle"></i> Mark as seen
                                                                </a> --}}
                                                            @else
                                                                <small class="text-success">Seen by Industry Supervisor <i class="fas fa-check-circle"></i></small>
                                                               
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
                                                                {{-- <a data-toggle="modal" data-target="#approve_month" onclick="get_monthlyrecord({{$month->id}})" class="btn btn-sm btn-outline-success"><i class="far fa-edit"></i> Add Assessment</a> --}}
                                                            @else
                                                                <small class="text-success">Assessed by Industry Supervisor <i class="fas fa-check-circle"></i></small>
                                                                {{-- <a data-toggle="modal" data-target="#approve_month" onclick="get_monthlyrecord({{$month->id}})" class="btn btn-sm btn-outline-primary"><i class="far fa-edit"></i> Edit Assessment</a> --}}
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

        {{-- Supervision Form --}}
        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="supervisionForm" tabindex="-1" role="dialog" aria-labelledby="supervisionFormModal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center blue-text" id="supervisionFormModalLabel"><b style="font-weight:900"> SIWES Supervision Form </b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                <form action="/school/supervision/store" method="POST">
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
                            {{-- <hr> --}}
                            <div class="col-lg-4 p-2">
                                <label class="col-form-label" for="visitation_date">Date of Visit:</label>
                                <input class="form-control" type="date" name="visitation_date" id="visitation_date" value="{{ old('visistation_date') }}" required>
                            </div>
                            <div class="col-8 p-2">
                                
                            </div>
                            <div class="col-6 p-2">
                                <label for="available_at_visit" class="col-form-label @error('available_at_visit') is-invalid @enderror">Is the student in the industry at the time of the visit <small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="available_at_visit" id="yes" value="1" >
                                    <label class="form-check-label" for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="available_at_visit" id="no" value="0">
                                    <label class="form-check-label" for="no">No</label>
                                </div>
                            </div>
                            <div class="col-6 p-2" id="not_avail" style="display: none">
                                <label class="col-form-label" for="why_not_available">If No, Why? </label>
                                <input class="form-control" type="text" name="why_not_available" id="why_not_available" value="{{ old('why_not_available') }}"> 
                            </div>
                            <div class="col-6 p-2">
            
                                <label for="logbook_seen" class="col-form-label @error('logbook_seen') is-invalid @enderror">Is the Logbook sighted during the visit <small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="logbook_seen" id="yes" value="1">
                                    <label class="form-check-label" for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="logbook_seen" id="no" value="0">
                                    <label class="form-check-label" for="no">No</label>
                                </div>
                            </div>
                            
                            <div class="col-6 p-2">
                                <label for="logbook_completed" class="col-form-label @error('logbook_completed') is-invalid @enderror">Is the Logbook up-to-date at the time of the visit <small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="logbook_completed" id="yes" value="1">
                                    <label class="form-check-label" for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="logbook_completed" id="no" value="0">
                                    <label class="form-check-label" for="no">No</label>
                                </div>
                            </div>
                            <div class="col-6 p-2">
                                <label for="logbook_appropriate" class="col-form-label @error('logbook_appropriate') is-invalid @enderror">Is the Logbook appropriately completed <small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="logbook_appropriate" id="yes" value="1">
                                    <label class="form-check-label" for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="logbook_appropriate" id="no" value="0">
                                    <label class="form-check-label" for="no">No</label>
                                </div>
                            </div>
                            <div class="col-6 p-2" id="not_app" style="display: none">
                                <label class="col-form-label" for="why_not_appropriate">If No, state the deficiencies? </label>
                                <textarea class="form-control" name="why_not_appropriate" id="why_not_appropriate" rows="2">{{ old('why_not_appropriate') }}</textarea>
                            </div>
                            <div class="col-12 p-2">
                                <label class="col-form-label" for="attitude_student"> Attitude of the student to training</label>
                                <input class="form-control" type="text" name="attitude_student" id="attitude_student" value="{{ old('attitude_student') }}">
                            </div>
                            <div class="col-12 p-2">
                                <label class="col-form-label" for="challenges"> Any major challenge(s) requiring immediate attention of the SIWES office ? Please specify</label>
                                <textarea class="form-control" name="challenges" id="challenges" rows="2">{{ old('challenges') }}</textarea>
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

        {{-- Edit Supervision Form --}}
        @if (!empty($assessment))
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
                            {{-- <hr> --}}
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
                                <label class="col-form-label" for="challenges"> Any major challenge(s) requiring immediate attention of the SIWES office ? Please specify</label>
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
        @endif

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
                                    <label for="" class="col-form-label"><b>Visting Supervisor Name</b></label>
                                    <input type="text" class="form-control" value="{{ Auth()->user()->name()}}" disabled>
                                </div>
                                <div class="col-lg-4">
                                    <label for="org" class="col-form-label"><b>Department</b></label>
                                    <input type="text" class="form-control" value="{{ $staff->department }}" disabled>
                                </div>
                                <div class="col-lg-4">
                                    <label for="staff_rank" class="col-form-label"><b>Rank</b></label>
                                    <input type="text" class="form-control" name="staff_rank" value="{{$form8->staff_rank}}" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label for="no_of_visits" class="col-form-label"><b>Number of Visits</b></label>
                                    <input type="number" class="form-control" name="no_of_visits" value="{{$form8->no_of_visits}}">
                                </div>
                                <div class="col-lg-8">
                                    <label for="assess_facilties" class="col-form-label"><b>Assessment of facilities provided by Company during visit(s) </b></label>
                                    <input type="text" name="assess_facilties" id="assess_facilties" class="form-control" value="{{$form8->assess_facilties}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6">
                                    <label for="student_impression" class="col-form-label"><b>Impression of the Student's involvement in training</b></label>
                                    <input type="text" class="form-control" name="student_impression" required value="{{$form8->student_impression}}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="assess_student_grade" class="col-form-label"><b>Assessment of student's performance (Grading)</b></label>
                                    <input type="text" class="form-control" name="assess_student_grade" value="{{$form8->assess_student_grade}}">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-4">
                                    <label for="staff_filled" class="col-form-label"><b>Submission Date</b></label>
                                    <input type="date" class="form-control" name="staff_filled_disabled" value="{{$currentdate}}" disabled>
                                    <input type="hidden" name="staff_filled" id="staff_filled" value="{{$currentdate}}" >
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

        @if (!empty($siwes))
            @if ($siwes->siwes_type_id == 3 || $siwes->siwes_type_id == 2)
                @include('_templates.preview_modals')
            @endif 
        @endif

        {{-- End OF MODALS --}}
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="available_at_visit"]').click(function() {
                var inputValue = $(this).attr("value");
                if (inputValue == 0) {
                    $("#not_avail").show();
                }else{
                    $("#not_avail").hide();
                }
            });
        });
        $(document).ready(function() {
            $('input[name="logbook_appropriate"]').click(function() {
                var inputValue = $(this).attr("value");
                if (inputValue == 0) {
                    $("#not_app").show();
                }else{
                    $("#not_app").hide();
                }
            });
        });

    </script>
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
                        url: "/school/log/form8",
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
