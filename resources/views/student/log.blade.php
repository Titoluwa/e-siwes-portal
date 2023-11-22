@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <div class="card-header border-warning bg-othe-color">
                    <div class="float-left blue-text">
                        <h3 style="font-weight: 700;">SIWES 400 LogBook</h3>
                        <small>Fill in your daily activities after each day of training</small>
                    </div>
                    <div class="float-right">

                    </div>
                </div>

                <div class="card-body border-warning m-4 p-2">
                    @if ($siwes400 != null)
                        <div class="row">
                            <div class="col-lg-9">
                                <p class="">Your duration of training at <b>{{$siwes400->org->name}}</b> is <b>{{$siwes400->duration_of_training}}</b> in <b>{{$siwes400->year_of_training}}</b>.</p>
                                <p class="mb-4">You are to fill your Logbook with each day's activities.</p>
                            </div>
                            <div class="col-lg-3 mb-4">
                                <div class="dropdown">
                                    <a class="btn btn-primary dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-file"></i> SIWES 400
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a target="_blank" class="dropdown-item" href="/form/sp3/{{$siwes400->id}}">SP.3</a>
                                        <a target="_blank" class="dropdown-item" href="/form/scaf/{{$siwes400->id}}">SCAF</a>
                                        @if($form8 != null)
                                            <a target="_blank" class="dropdown-item" href="/form/form8/{{$siwes400->id}}">Form 8</a>
                                        @else
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" data-toggle="modal" data-target="#fill_form8_modal">Fill Form 8</a>
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
                        <h5 class="text-center pb-3"><b>Fill this form to start your SIWES 400</b></h5>
                        <form method="POST" action="/student/log/initiate" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="siwes_type_id" value="3">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

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
                                <label class="col-md-4 col-form-label" for="level">Level: </label>
                                <div class="col-md-6">
                                    <select class="form-control  @error('level') is-invalid @enderror" name="level" id="level">
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="400" selected>400</option>
                                        <option value="500">500</option>
                                        <option value="extra">Extra</option>
                                    </select>
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="resumption_date" class="col-md-4 col-form-label">Resumption Date</label>
                                <div class="col-md-6">
                                    <input class="form-control  @error('resumption_date') is-invalid @enderror" type="date" name="resumption_date" id="resumption_date" value="{{ old('resumption_date') }} ">
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
                                    <input class="form-control  @error('ending_date') is-invalid @enderror" type="date" name="ending_date" id="ending_date" value="{{old('ending_date')}}" >
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

                @include('student.log_modals')

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
                        url: "/student/log/form8",
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
