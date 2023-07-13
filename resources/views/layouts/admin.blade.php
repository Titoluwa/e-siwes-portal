@extends('layouts.app')

@section('homelink', '/admin')

@section('nav')
    <a class="nav-link"> Industrial Training Coordinating Unit ICTU</a>
@endsection


@section('content')
    
    <div class="row">
        <div class="bg-othe-color othe-color shadow-sm" style="width: 20%;">
            <div class="m-2">
                <h6 class="mt-3 text-center" style="font-size:17px; font-weight: 700;"><a href="/admin" class="no-deco oth-color"><i class="fa fa-shield-alt"></i> Admin (ICTU)</a></h6>
                <hr>
                <ul class="nav flex-column mb-auto">
                    <li class="text-primary">
                       <i><small>Session: {{$current_session->year}}</small></i>
                    </li>
                    <li>
                        <a href="/admin/setup" class="nav-link">
                        <i class="fa fa-id-badge"></i> Setup Session
                        </a>
                    </li>
                    <li>
                        <a href="/admin/students" class="nav-link">
                        <i class="fa fa-building"></i> Students
                        </a>
                    </li>
                    <li>
                        <a href="/admin/staffs" class="nav-link">
                        <i class="fa fa-book"></i> Staffs
                        </a>
                    </li>
                    <li>
                        <a href="/admin/organizations" class="nav-link">
                        <i class="fa fa-id-badge"></i> Organizations
                        </a>
                    </li>
                    <li>
                        <a href="/admin/itf-agents" class="nav-link">
                        <i class="fa fa-user-tie"></i> ITF Agents
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="p-5" style="width: 80%;">
            @yield('admincontent') 
        </div>
    </div>
@endsection
