@extends('layouts.industry')
@section('title', 'Student Logbook')
@section('industrycontent')

    <div class="col-md-12">
        <div class="card border-warning">

            {{-- <div class="card-header border-warning" style="display: inline-flex">
                <div class="float-left"></div>
            </div> --}}
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
                        <div class="dropdown mb-4">
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
