@extends('layouts.app')


@section('title', 'Verify')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="flex-center position-ref full-height">  
                <div class="p-2 content oth-color">
                    <div class="px-5 py-3">
                        <h1 class="display-5 font-weight-bold">Verify your email address on the Portal</h1>
                        <h5 style="color: white">A token was sent to you email. Input the token sent to your email to verify your account</h5>
                        <h5 style="color: white">Didn't get a mail? &nbsp; &nbsp;<button data-toggle="modal" data-target="#ResendToken" class="btn btn-sm btn-outline-warning">Resend Token</button></h5>
                        {{-- <div class="col-lg-3"></div> --}}
                        <div class="pt-3">
                            @if (\Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    <strong>
                                        {!! \Session::get('success') !!}
                                        <a class="float-right text-success" onclick="hide_alert()" style="text-decoration: none; cursor: default; justify-content:center;">&times;</a>
                                    </strong>
                                </div>
                            @endif
                            @if (\Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    <strong>
                                        {!! \Session::get('error') !!}
                                        {{-- <button data-toggle="modal" data-target="#ResendToken" class="btn btn-sm btn-outline-primary">Resend Token</button> --}}
                                        <a class="float-right text-danger" onclick="hide_alert()" style="text-decoration: none; cursor: default; justify-content:center;">&times;</a>
                                    </strong>
                                </div>
                            @endif
                        </div>
                        {{-- <div class="col-lg-3"></div> --}}
                        <form action="/verification" method="POST">
                            @csrf
                            <div class="justify-content-center m-3">
                                <div class="row form-group">
                                    <div class="col-lg-6">
                                        <label for="email" class="col-form-label">Email </label>
                                        <input class="form-control" type="email" name="email" id="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="token" class="col-form-label">Token </label>
                                        <input class="form-control" type="text" name="token" id="token" value="ESP-">
                                        @error('token')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                {{-- <br> --}}
                                <button class="m-1 btn btn-warning">Verify</button>
                            </div> 
                        </form>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Daily Activity Modal -->
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="ResendToken" tabindex="-1" role="dialog" aria-labelledby="dailyModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div >
            <button type="button" class="p-3 close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><b>&times;</b></span>
            </button>
        </div>
        <form action="/resend-verification" method="POST">
            @csrf
            <div class="modal-body">

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="email">Enter your email used to resgister</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email">
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="p-3 float-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection