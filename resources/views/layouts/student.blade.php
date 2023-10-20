@extends('layouts.app')

@section('home', '(Student)')
{{-- @section('nav')
    <a href="/student" class="nav-link">Student</a>
@endsection --}}

@section('style')
    <style>
        .sidebar{
            /* background-attachment: fixed;
            background-color:
            height: 100%; */
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="bg-othe-color othe-color shadow-sm sidebar" style="width: 20%;">
            <div class="m-2">
                <h6 class="mt-3 text-center" style="font-size:17px; font-weight: 700;"><a href="/student" class="no-deco oth-color"> <i class="fa fa-home"></i> Home</a></h6>
                <hr>
                <ul class="nav flex-column mb-auto">
                    <li>
                        <a href="/student/profile" class="nav-link">
                        <i class="fa fa-id-badge"></i> Your Profile
                        </a>
                    </li>
                    <li>
                        <a href="/student/org" class="nav-link">
                        <i class="fa fa-building"></i> Organization Profiles
                        </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-book"></i> Logbook
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="/student/log200">SWEP 200</a>
                              <a class="dropdown-item" href="/student/log300">SIWES 300</a>
                              <a class="dropdown-item" href="/student/log">SIWES 400</a>
                            </div>
                        </div>
                    </li>
                    {{-- <li>
                        <a href="/student/log" class="nav-link">
                        <i class="fa fa-book"></i> Logbooks*
                        </a>
                    </li> --}}
                    {{-- <li>
                        <a href="" class="nav-link">
                        <i class="fa fa-user-tie"></i> Forms*
                        </a>
                    </li> --}}
                    <li>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    </li>
                    <!-- <li>
                        <a href="" class="nav-link">
                        <i class="fa fa-poll"></i> Letter from Company
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="p-5" style="width: 80%;">
            @if (\Session::has('success'))
                <div class="alert alert-success" role="alert">
                    <strong>
                        {!! \Session::get('success') !!}
                        <a class="float-right text-success" onclick="hide_alert()" style="text-decoration: none; cursor: default; justify-content:center;">&times;</a>
                    </strong>
                </div>
            @endif
            @if (\Session::has('deleted'))
                <div class="alert alert-danger" role="alert">
                    <strong>
                        {!! \Session::get('deleted') !!}
                        {{-- Deletion Done!! --}}
                        <a class="float-right text-danger" onclick="hide_alert()" style="text-decoration: none; cursor: default; justify-content:center;">&times;</a>
                    </strong>
                </div>
            @endif
            @yield('studentcontent') 
        </div>
    </div>
@endsection