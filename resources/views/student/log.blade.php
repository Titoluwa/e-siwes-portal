@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <div class="card-header border-warning bg-othe-color">
                    <div class="mt-2">
                       
                    </div>
                    <div class="float-left">
                        <h4 style="font-weight: 700;">LogBook</h4>
                        <small>Fill in your daily activities after each day of training</small>
                    </div>
                    <div class="float-right">
                        <!-- Button trigger for Add Daily Activity modal -->
                        <div class="py-1">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#dailyactivityModal">
                            <i class="fa fa-book-open"></i> Add Daily Activity
                        </button>
                        </div>
                    </div>
                </div>

                <div class="card-body border-warning">
                    <p>Your duration of training at <b>{{$student->org->name}}</b> is <b>{{$student->duration_of_training}}</b> for <b>{{$student->year_of_training}}</b>.</p> 
                    <p>You are to fill your Logbook of each day's activities.</p>
                    <div class="mb-3">
                        <!-- Button trigger for Add Weekly Activity modal -->
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#weekactivityModal">
                            <i class="fa fa-book"></i> Add Weekly Activity
                        </button>
                    </div>
                    @if(!empty($records))
                        <div class="row row-cols-1 row-cols-xl-3 g-4">
                            @foreach($records as $rec)
                            <div class="col mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$rec->day}}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{$rec->date}}</h6>
                                        <p class="card-text">{{$rec->description_of_work}}</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="/student/log/edit/{{$rec->id}}" class="card-link"><i class="fas fa-edit"></i>Edit</a>
                                        <!-- <a href="#" class="card-link">Another link</a> -->
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <h5 class="text-center p-2">
                           No Records Yet
                        </h5>
                    @endif
                    
                                           
                </div>
                

                <!-- Add Daily Activity Modal -->
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="dailyactivityModal" tabindex="-1" role="dialog" aria-labelledby="activityModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="activityModalLabel"><b>Daily Activity</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form class="" action="/student/log" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
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

                <!-- Add Weekly Activity Modal -->
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="weekactivityModal" tabindex="-1" role="dialog" aria-labelledby="activityModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="activityModalLabel"><b>Weekly Activity</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <form class="" action="/student/log/week" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="name" class="col-form-label"><b>Name Week</b></label>
                                        <select class="form-control  @error('name') is-invalid @enderror" name="name" id="name">
                                            <option value="" disabled selected>Week</option>
                                            <option value="Week 1">Week 1</option>
                                            <option value="Week 2">Week 2</option>
                                            <option value="Week 3">Week 3</option>
                                            <option value="Week 4">Week 4</option>
                                        </select>    
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
                                        @foreach($records as $rec)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{$rec->id}}" id="{{$rec->date}}">
                                                <label class="form-check-label" for="{{$rec->date}}">
                                                    <b>{{$rec->date}}</b> ({{$rec->day}})
                                                </label>
                                            </div>
                                        @endforeach
                                    
                                        @error('daily_records')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="description_of_week" class="col-form-label"><b>Description of Week</b></label>
                                        <textarea class="form-control @error('description_of_week') is-invalid @enderror" id="description_of_week" name="description_of_week" rows="5"></textarea>
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

            </div>
        </div>
    </div>

@endsection