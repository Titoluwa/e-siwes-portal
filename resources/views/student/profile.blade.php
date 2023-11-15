@extends('layouts.student')

@section('studentcontent')

    <div class="row justify-content-center">
        <div class="col-lg-8 mb-4">
            <div class="card border-warning">
                <div class="card-header border-warning bg-othe-color clearfix">

                    <div class="float-left mt-2 blue-text">
                        <h4 style="font-weight: 700;">{{ __("Student Profile") }}</h4>
                    </div>
                    <div class="float-right mt-2">
                        <a href="/student/profile/edit">
                            <i class="fas fa-edit"></i>EDIT
                        </a>
                    </div>                    
                </div>

                <div class="card-body">
                    <div class="m-2">
                        @if ($student->user->profile_pic != null)
                            <img class="rounded border-warning float-right img-thumbnail" src="{{asset('storage/'. $student->user->profile_pic)}}" alt="profile image" srcset="" width="150">
                        @else
                            <img class="rounded border-warning float-right img-thumbnail" src="{{asset('images/user_default.png')}}" alt="profile image" srcset="" width="150">
                        @endif
                        <div>
                            <p>
                                Registration Number: <b>{{$student->matric_no}}</b>
                            </p>
                            <p>
                                Surname: <b>{{$student->user->last_name}}</b>
                            </p>  
                            <p>
                                Other Names: <b>{{$student->user->first_name}} {{$student->user->middle_name}}</b>
                            </p> 
                            <p>
                                Faculty: <b>{{$student->faculty}}</b>
                            </p> 
                            <p>
                                Department: <b>{{$student->department}}</b>
                            </p>
                            <p>
                                Course of study: <b>{{$student->course_of_study}}</b>
                            </p>
                            <p>
                                E-mail Address: <b>{{$student->user->email}}</b>
                            </p> 
                            <p>
                                Signature:
                                <img src="{{asset('storage/'. $student->signature)}}" alt="{{$student->signature}}" width="100">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card border-warning">
                <div class="card-header border-warning bg-othe-color">
                    <h5 class="blue-text">
                        Bank Details &nbsp;
                        @if (!empty($bank))
                            <a onclick="show_details()"><i class="fa fa-eye"></i></a>
                        @endif
                    </h5>
                </div>
                <div class="card-body p-2 m-2">
                    @if (empty($bank))
                        <div class="text-center">
                            <p>Please fill your bank details here</p>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addBankDetails">Bank Details</button>
                        </div>
                    @else
                        <p>Bank Name: <b>{{$bank->bank_name}}</b></p>
                        <p>Bank Sort Code: <b id="view_sortcode" class="hide">{{$bank->sort_code}}</b></p>
                        <p>Account Number: <b id="view_account" class="hide">{{$bank->account_number}}</b></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- MODALS -->
        <!-- Add Bank Details Modal -->
        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addBankDetails" tabindex="-1" role="dialog" aria-labelledby="addbankdetails" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addbankdetailsLabel"><b class="blue-text"> Add Bank Details</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                <form class="" action="/student/bank-details/store" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="bank_name" class="col-form-label">Bank Name</label>
                                <select class="form-control  @error('bank_name') is-invalid @enderror" name="bank_name" id="bank_name" required>
                                    <option value="" disabled selected>Bank Name</option>

                                    @foreach($banks['data'] as $bank)
                                        <option value="{{$bank['name']}}" id="{{$bank['code']}}">{{$bank['name']}}</option>
                                    @endforeach
                    
                                </select>
                                @error('bank_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="sort_code" class="col-form-label">Sort Code</label>
                                <input type="sort_code" name="sort_code" id="sort_code" value="" class="form-control @error('sort_code') is-invalid @enderror" data-dependant='bank_name' required>
                                @error('sort_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-md-8">
                                <label for="account_number" class="col-form-label">Account Number</label>
                                <input class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" required>
                                @error('account_number')
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

@endsection

@section('scripts')
    <script>
        function show_details() {
            $('#view_sortcode').toggleClass('hide');
            $('#view_account').toggleClass('hide');
        }
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#bank_name').change(function(){
                if($(this).val()!= ''){
                    var value = $(this).val();
                    var sortCode = $(this).attr('id');
                    // var _token = $('input[name="_token"]').val();
                    // $('#sort_code').val(sortCode);
                }
            });
        });
    </script>
@endsection