@extends('layouts.app')

@section('homelink', '/student')

@section('content')
    <div class="row">
        <div class="col-md-2 bg-othe-color othe-color shadow-sm">
        <div class="m-2">
                <h6 class="mt-3 text-center" style="font-size:17px; font-weight: 700;"><a href="/student" class="no-deco oth-color"> Student </a></h6>
                <hr>
                <ul class="nav flex-column mb-auto">
                    <li>
                        <a href="/student/profile" class="nav-link">
                        <i class="fa fa-users"></i> Your Profile
                        </a>
                    </li>
                    <li>
                        <a href="/student/org" class="nav-link">
                        <i class="fa fa-sliders-h"></i> Organization Profile
                        </a>
                    </li>
                    <li>
                        <a href="/student/log" class="nav-link">
                        <i class="fa fa-user-friends"></i> Daily Record of Activities
                        </a>
                    </li>
                    <li>
                        <a href="" class="nav-link">
                        <i class="fa fa-user-tie"></i> Form 8
                        </a>
                    </li>
                    <!-- <li>
                        <a href="" class="nav-link">
                        <i class="fa fa-poll"></i> Letter from Company
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="col-md-10 p-5">
            @yield('studentcontent') 
        </div>
    </div>
@endsection