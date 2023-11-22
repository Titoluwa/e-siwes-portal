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
                @if ($siwes400 != null)
                    <input type="hidden" name="siwes_id" value="{{$siwes400->id}}">
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
                @if ($siwes400 != null)
                    <input type="hidden" name="siwes_id" value="{{$siwes400->id}}">
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
                @if ($siwes400 != null)
                    <input type="hidden" name="siwes_id" value="{{$siwes400->id}}">
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
                
<!-- Fill Form 8 -->
<div class="modal fade" id="fill_form8_modal" tabindex="-1" role="dialog" aria-labelledby="fill_form8" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fill_form8"><b> Fill your END-OF-PROGRAMME REPORT SHEET (Form 8) </b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                </button>
            </div>
            <form id="Form8" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="siwes_id" id="form8_siwes_id" value="{{$siwes400->id}}">
                    <div class="row form-group">
                        <div class="col-lg-4">
                            <label for="name" class="col-form-label"><b>Fullname</b></label>
                            <input type="text" class="form-control" value="{{ $siwes400->user->name() }} {{ $siwes400->user->middle_name }}" disabled>
                        </div>
                        <div class="col-lg-4">
                            <label for="matric_no" class="col-form-label"><b>Matric Number</b></label>
                            <input type="text" class="form-control" value="{{ $siwes400->student->matric_no }}" disabled>
                        </div>
                        <div class="col-lg-4">
                            <label for="course_of_study" class="col-form-label"><b>Course of Study</b></label>
                            <input type="text" class="form-control" value="{{ $siwes400->student->course_of_study }}" disabled>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4">
                            <label for="year_of_study" class="col-form-label"><b>Year of Study</b></label>
                            <input type="text" class="form-control" value="{{ $siwes400->year_of_training }}" disabled>
                        </div>
                        <div class="col-lg-4">
                            <label for="org" class="col-form-label"><b>Organization of Attachment</b></label>
                            <input type="text" class="form-control" value="{{ $siwes400->org->name }}" disabled>
                        </div>
                        <div class="col-lg-4">
                            <label for="depts_at_org" class="col-form-label"><b>Departments</b> <small style="color:red;">(comma separated)</small></label>
                            <input type="text" class="form-control" name="depts_at_org" >
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4">
                            <label for="periods" class="col-form-label"><b>Period of Attachment</b></label>
                            {{-- <input type="text" class="form-control" value="{{ $siwes400->duration_of_training }}" disabled> --}}
                            <input type="text" class="form-control" value="24 weeks" disabled>
                        </div>
                        <div class="col-lg-4">
                            <label for="start_date" class="col-form-label"><b>From </b></label>
                            <input type="text" class="form-control" value="{{ $siwes400->resumption_date }}" disabled>
                        </div>
                        <div class="col-lg-4">
                            <label for="end_date" class="col-form-label"><b>To </b></label>
                            <input type="text" class="form-control" value="{{ $siwes400->ending_date }}" disabled>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-5">
                            <label for="total_allowance" class="col-form-label"><b>Total Allowance Received</b></label>
                            <input type="text" class="form-control" name="total_allowance">
                        </div>
                        <div class="col-lg-7">
                            <label for="experience_outline" class="col-form-label"><b>Brief outline of experience/relevance of training provided: </b></label>
                            <textarea name="experience_outline" id="experience_outline" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-5">
                            <label for="weeks_engaged" class="col-form-label"><b>Total number of <span style="color:red;">weeks</span> engaged on industrial attachment</b></label>
                            <input type="text" class="form-control" name="weeks_engaged" value="24 weeks">
                        </div>
                        <div class="col-lg-5">
                            <label for="pervious_attachment" class="col-form-label"><b>Where were you attached last (if applicable):</b></label>
                            <input type="text" class="form-control" name="pervious_attachment">
                        </div>
                        <div class="col-lg-2">
                            <label for="student_filled" class="col-form-label"><b>Submission Date</b></label>
                            <input type="date" class="form-control" name="student_filled_disabled" value="{{$currentdate}}" disabled>
                            <input type="hidden" name="student_filled" id="student_filled" value="{{$currentdate}}" >
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