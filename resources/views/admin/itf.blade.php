@extends('layouts.admin')

@section('title', 'ITF Agents')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                <!-- <div class="card-header border-warning bg-othe-color">
                    <h5 class="mt-2">{{ __('Dashboard') }}</h5>
                </div> -->

                <div class="card-body p-3">
                    <h3 class="text-primary">ITF Agents</h3>
                
                </div>
                @if(!empty($itfs))
                        <div class="table-responsive">
                            <table id="myTable" class="table " style="width:100%">
                                <thead>
                                    <tr>
                                        {{-- <th>Last Name</th> --}}
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itfs as $itf)
                                        <tr>
                                            <td>{{$itf->user->name()}}</td>
                                            <td>{{$itf->state_location}}</td>
                                            <td>
                                                <a href="admin/setup/itf/{{$itf->id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> View</a>
                                                <a  class='btn btn-sm btn-outline-primary'><i class="fa fa-list"></i> Edit</a>
                                                <button type='button' class='btn btn-sm btn-outline-danger delete'><i class="fa fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="h5 p-3 m-4 text-center">No ITF Agent Registered Yet!</p>
                    @endif
                
            </div>
        </div>
    </div>
@endsection