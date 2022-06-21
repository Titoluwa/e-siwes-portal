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
                        <!-- Button trigger for Add Activity modal -->
                        <div class="py-1">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#activityModal">
                            <i class="fa fa-book-open"></i> Add Daily Activity
                        </button>
                        </div>
                    </div>
                </div>

                <div class="card-body border-warning">
                    <p>Your duration of training at <b>{{$student->org->name}}</b> is <b>{{$student->duration_of_training}}</b> for <b>{{$student->year_of_training}}</b>.</p> 
                    <p>You are to fill your Logbook of each day's activities.</p>
                    @if(empty($records))
                        <h5 class="text-center p-2"> 
                            <a href="#" class="card-link">Week 1</a>
                        </h5>
                        
                        <div class="row mb-3">
                            <div class="col-lg-4 themed-grid-col mb-3 card-group">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title">Monday</h5>
                                    <p class="card-text"> This content is a little bit longer. This content is a little bit longer. This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="card-link"><i class="fas fa-edit"></i>Edit</a>
                                        <!-- <a href="#" class="card-link">Another link</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <h5 class="text-center p-2">
                           No Records Yet
                        </h5>
                    @endif
                    
                                           
                </div>
                

                <!-- Add Activity Modal -->
                <div class="modal fade" data-keyboard="false" data-backdrop="static" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="activityModalLabel" aria-hidden="true">
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
                                <!-- <div class="row form-group">
                                
                                    <div class="col-md-12">
                                        <label for="week" class="col-form-label">Select Week</label>
                                        <select class="form-control  @error('week') is-invalid @enderror" name="week" id="week">
                                            <option value="" disabled selected>Week</option>
                                            <option value="1">Week 1</option>
                                            <option value="2">Week 2</option>
                                            <option value="3">Week 3</option>
                                        </select>    
                                        @error('week')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                
                                </div> -->
                                <div class="row form-group">
                                    <input type="hidden" name="user_id" value="0">
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
                                
                                <!-- <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="department" class="col-form-label">Department</label>
                                        <input type="text" name="depatment" id="department" class="form-control @error('department') is-invalid @enderror">   
                                        @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> -->
                                <div class="row form-group">
                                
                                    <div class="col-md-12">
                                        <label for="description_of_work" class="col-form-label">Description of work</label>
                                        <textarea class="form-control @error('description_of_work') is-invalid @enderror" name="description_of_work" rows="5"></textarea>
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
            </div>
        </div>
    </div>

@endsection