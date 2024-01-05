@extends('layouts.app')

@section('home', '(ITCU)')
{{-- @section('nav')
    <a  class="nav-link">ITCU</a>
@endsection --}}

@section('style')
    <style>
        body{
            background-image: url('images/oau-view-3.webp') !important;
        }

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="sidebar bg-othe-color othe-color shadow-sm">
            <div class="m-2">
                <h6 class="mt-3 text-center" style="font-size:17px; font-weight: 700;"><a href="/admin" class="no-deco oth-color"><i class="fa fa-home"></i> Home</a></h6>
                <hr>
                <ul class="nav flex-column mb-auto">
                    <li class="text-primary">
                       {{-- <i><small>Current Session: {{$current_session->year}}</small></i> --}}
                    </li>
                    <li>
                        <a href="/admin/setup" class="nav-link">
                        <i class="fa fa-cogs"></i> Session
                        </a>
                    </li>
                    <li>
                        <a href="/admin/departments" class="nav-link">
                        <i class="fa fa-university"></i> Departments
                        </a>
                    </li>
                    <li>
                        <a href="/admin/students" class="nav-link">
                        <i class="fas fa-users"></i> Students
                        </a>
                    </li>
                    <li>
                        <a href="/admin/staffs" class="nav-link">
                        <i class="fas fa-user-friends"></i> Department Coodinators
                        </a>
                    </li>
                    <li>
                        <a href="/admin/organizations" class="nav-link">
                        <i class="fas fa-industry"></i> Industry 
                        </a>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-list"></i> SWEP 200 List
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($sessions as $session)
                                    <a class="dropdown-item" href="/admin/placement/swep-200/{{$session->id}}">{{$session->year}}</a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-list"></i> SIWES 300 List
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($sessions as $session)
                                    <a class="dropdown-item" href="/admin/placement/siwes-300/{{$session->id}}">{{$session->year}}</a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-list"></i> SIWES 400 List
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($sessions as $session)
                                    <a class="dropdown-item" href="/admin/placement/siwes-400/{{$session->id}}">{{$session->year}}</a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="/admin/assign-students/siwes-400" class="nav-link">
                        <i class="fas fa-link"></i> Assign Students (SIWES 400)
                        </a>
                    </li>
                    {{-- <li>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-link"></i> Assign Students
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="admin/assign-students/siwes-300">SIWES 300</a>
                              <a class="dropdown-item" href="admin/assign-students/siwes-400">SIWES 400</a>
                            </div>
                        </div>
                    </li> --}}
                    <li>
                        <a href="/admin/materials" class="nav-link">
                            <i class="fa fa-copy"></i> Materials
                        </a>
                    </li>
                    <li>
                        <a href="/admin/announce" class="nav-link">
                            <i class="fa fa-chalkboard"></i> Notice Board
                        </a>
                    </li>
                    <li>
                        <a href="/admin/contacts" class="nav-link">
                            <i class="fa fa-users"></i> All Users
                        </a>
                    </li>
                    {{-- <li>
                        <a href="/admin/itf-agents" class="nav-link">
                        <i class="fa fa-user-tie"></i> ITF Agents
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
        <div class="p-5 otherside">
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
                        {{-- Deletion Done!! --}}
                        <a class="float-right text-danger" onclick="hide_alert()" style="text-decoration: none; cursor: default; justify-content:center;">&times;</a>
                    </strong>
                </div>
            @endif
            @yield('admincontent') 
        </div>
    </div>
@endsection

@section('scripts')
    
@endsection