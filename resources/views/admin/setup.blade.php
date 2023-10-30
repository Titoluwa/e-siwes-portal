@extends('layouts.admin')

@section('title', 'Setup')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-warning">

                @if(session()->has("message"))
                    <div class="alert alert-warning" role='alert'>
                        <strong> {{session()->get('message')}} </strong>
                    </div>
                @endif
                <div class="card-body p-5">
                    <h3 class="text-center text-primary">Setup Session</h3>

                    <div class="">
                        <p class="h6"><b> Add Session Year</b></p>

                        <form class="form row" action="/admin/setup/store" method="POST">
                            @csrf
                        
                            <div class="form-group col-lg-4">
                                <label class="form-label" for="year">Session: </label>
                                <input class="col-lg-12 form-control" required type="text" name="year" id="year" placeholder="XXXX/XXXX" autocomplete="off">
                            </div>

                            <div class="form-group col-lg-4">
                                <label class="form-label" for="start_date">Session Start Date </label>
                                <input class="col-lg-12 form-control" required type="date" name="start_date" id="start_date">
                            </div>

                            <div class="form-group col-lg-4">
                                <label class="form-label" for="end_date">Session End Date </label>
                                <input class="col-lg-12 form-control" required type="date" name="end_date" id="end_date">
                            </div>
                            
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <br>
                    <br>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="col-2">Session</th>
                                        <th class="col">Period</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sessions as $session)
                                    <tr>
                                        <td>{{$session->year}}</td>
                                        @if ($session->status == 0)
                                            <td class="text-danger">
                                                <b>Session year is closed!</b>
                                                Started: {{ $session->start_date }}, Ended: {{ $session->end_date }}  
                                                {{-- <button class="btn btn-sm btn-outline-success">Activivate</button>  --}}
                                            </td>
                                        @else
                                            <td class="text-success">
                                                <b>Current year: </b>
                                                Starts: {{ $session->start_date }}, Ends: {{ $session->end_date}} 
                                                &nbsp;
                                                {{-- <a class="btn btn-sm btn-outline-dark" href="/admin/setup/edit/{{$session->id}}"><i class="fa fa-edit"></i></a> --}}
                                                <a class="btn btn-sm btn-outline-dark" onclick="get_session({{$session->id}})" data-toggle="modal" data-target="#editSession"><i class="fa fa-edit"></i></a>
                                            </td>
                                        @endif
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

    <!-- MODALS -->
        <!-- Edit Session Modal -->
        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="editSession" tabindex="-1" role="dialog" aria-labelledby="editSession" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="editSessionLabel">Edit <span id="year_name"></span> Session</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><b>&times;</b></span>
                    </button>
                </div>
                    <form class="form m-3" action="/admin/setup/update" method="POST">
                        @method("PUT")
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="year">Year: </label>
                            <input class="col-md-12 form-control" type="text" name="year" id="edit_year" value="" required>
                        </div>
    
                        <div class="form-group">
                            <label class="form-label" for="start_date">Session's Start Date </label>
                            <input class="col-md-12 form-control" type="date" name="start_date" id="edit_start_date" value="" required>
                        </div>
    
                        <div class="form-group">
                            <label class="form-label" for="end_date">Session's End Date </label>
                            <input class="col-md-12 form-control" type="date" name="end_date" id="edit_end_date"  value="" required>
                        </div>
                        
                        <div class="float-right">
                        <button type="submit" class="btn btn-outline-primary">
                            {{ __('Update') }}
                        </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    
@endsection

@section('scripts')
    <script>
        function get_session(id){
            $.get('/admin/setup/edit/'+id, function(data)
            {
                console.log(data);
                $('#year_name').html(data.year);
                $('#edit_year').val(data.year);
                $('#edit_start_date').val(data.start_date);
                $('#edit_end_date').val(data.end_date);
            });
        }
    </script>        
@endsection
