@extends('layouts.app')

@section('title', 'Students')


@section('schoolcontent')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card my-5">
                    <div class="card-header bg-oth-color">
                        <h4 class=""><i class="fas fa-user-friends"></i> Students for {{$siwes_type->name}} in {{$session->year}} session</h4>
                        <small>({{$staff->department}})</small>
                    </div>

                    <div class="card-body">
                        <div class="m-3">
                            {{-- <div class="m-3">
                                <h4 class="blue-text">List of Students for {{$siwes_type->name}} in {{$session->year}} session</h4>
                            </div> --}} 
                            <div class="table-responsive">
                                <table id="myTable" class="table " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Matric Number</th>
                                            @if($siwes_type->id != 1)
                                                <th>Placement</th>
                                            @endif
                                            <th>Resumption Date</th>
                                            <th>Ending Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="result-table-body">
                                        @foreach ($filtered as $siwes)
                                            <tr>
                                                <td>{{$loop->index + 1}}</td>
                                                <td>{{$siwes->user->name()}}</td>
                                                <td>{{$siwes->student->matric_no}}</td>
                                                @if($siwes->org_id == null)
                                                @else
                                                <td>{{$siwes->org->name}}</td>
                                                @endif
                                                <td>{{$siwes->resumption_date}}</td>
                                                <td>{{$siwes->ending_date}}</td>
                                                <td>
                                                    <a target="_blank" href="/school/student/{{$siwes->siwes_type->code_name}}/{{$siwes->user_id}}" class='btn btn-sm btn-outline-primary'><i class="fa fa-book"></i> Logbook</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                            
                                    </tbody>
                                </table>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
    
    </script>

@endsection