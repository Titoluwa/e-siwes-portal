@extends('layouts.admin')

@section('title', 'Student Logbook')

@section('admincontent')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning">

                <div class="card-header border-warning bg-othe-color">
                    <div class="float-left blue-text">
                        <h3 style="font-weight: 700;">{{$student->user->name()}}'s LogBook for {{$siwes_type->name}}</h3>
                    </div>
                    @if (!empty($siwes))
                        @if ($siwes->siwes_type_id == 1)
                            <div class="float-right">
                                <div class="dropdown">
                                    <a class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-file"></i> SWEP 200
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        {{-- <a class="dropdown-item" href="/student/sp3">SP. 3</a>
                                        <a class="dropdown-item" href="/student/form8">Form 8</a>
                                        <a class="dropdown-item" href="/student/scaf">SCAF</a> --}}
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Assessment</a>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="float-right">
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-file"></i> Form
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/student/sp3">SP. 3</a>
                                    <a class="dropdown-item" href="/student/form8">Form 8</a>
                                    <a class="dropdown-item" href="/student/scaf">SCAF</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Assessment</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>

                <div class="card-body border-warning m-4 p-2">
                    @if (!empty($siwes))
                        @if ($siwes->siwes_type_id == 1)
                            <p>Details of activties done at SWEP classes</p>
                        @else
                            <p class="">The duration of training at <b>{{$siwes->org->name}}</b> is <b>{{$siwes->duration_of_training}}</b> for <b>{{$siwes->year_of_training}}</b>.</p>
                        @endif

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
                                                            <h6 class="card-subtitle mb-2 text-muted">{{$weekrec->department}}</h6>
                                                            <p class="card-text">{{$weekrec->description_of_week}}</p>
                                                        </div>
                                                        <div class="card-footer clearfix">
                                                            <div class="d-flex">
                                                                
                                                                <div class="">
                                                                    <a data-toggle="modal" data-target="#view_weekly_modal" onclick="get_weeklyrecord({{$weekrec->id}})" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i>View</a>
                                                                </div>
                                                                <div class="ml-auto">
                                                                    @if ($weekrec->org_sup_approval == 0)
                                                                       <small class="oth-color">Pending</small> 
                                                                    @else
                                                                        <small class="text-success">Seen by Industry-based supervisor <i class="fas fa-check-circle"></i></small>
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
                                                                
                                                                <div class="">
                                                                    <a data-toggle="modal" data-target="#view_monthly_modal" onclick="get_monthlyrecord({{$month->id}})" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i>View</a>
                                                                </div>
                                                                <div class="ml-auto">
                                                                    @if (empty($month->org_sup_comment))
                                                                        <small class="oth-color">Pending</small>
                                                                    @else
                                                                        <small class="text-success">Assessed by Industry-based Supervisor <i class="fas fa-check-circle"></i></small>
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
                        <h5 class="text-center pb-3"><b>Student has NOT registered for {{$siwes_type->name}}</b></h5>
                        
                    @endif
                </div>

                <!-- MODALS -->
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
    <!-- Get Scripts -->

    <script  type="text/javascript">
        function get_weeklyrecord(id){
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
