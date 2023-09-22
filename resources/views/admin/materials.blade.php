@extends('layouts.admin')

@section('title', 'Materials')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning">
                
                <div class="card-body p-3">
                    <div class="text-center p-3 ">
                        @if(session()->has("message"))
                            <div class="alert alert-warning" role='alert'>
                                <strong> {{session()->get('message')}} </strong>
                            </div>
                        @endif
                        <h4 class="text-primary"><i class="fa fa-copy"></i> SIWES Lecture Notes</h4>
                        {{-- <br> --}}
                        <button data-toggle="modal" data-target="#addMaterialModal" class="m-2 btn btn-sm btn-outline-primary"><i class="fa fa-upload"></i> Upload New Material</button>
                    </div>
                    
                    <br>
                    <div class="table-responsive">
                        <table id="materialsTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>SIWES type</th>
                                    <th>Uploaded by</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materials as $material)
                                    <tr>
                                        <td>{{$material->name}}</td>
                                        <td>{{$material->description}}</td>
                                        
                                        <td>
                                            @if ($material->siwes_type_id == 0)
                                                All
                                            @else
                                                {{$material->siwes_type->name}}
                                            @endif
                                            
                                        </td>
                                        <td>
                                            {{$material->user->last_name}}
                                        </td>
                                        <td style="display: inline-flex; width: 100%;">
                                            <a href="/download/{{$material->id}}" class="m-1" ><i class="fa fa-download"></i> </a>
                                            @if ($material->uploaded_by == Auth()->user()->id)
                                                    <a href="/admin/material/delete/{{$material->id}}" class="m-1 btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i></a>
                                                @endif
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
       <!-- MODALS -->
        <!-- Add New Material Modal -->
            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addMaterialModal" tabindex="-1" role="dialog" aria-labelledby="addMaterialModal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addMaterialModalLabel"><b><i class="fa fa-upload"></i> Upload New Material</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form row" action="/admin/material/store" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                <div class="form-group col-lg-4">
                                    <label class="form-label" for="file">File: </label>
                                    <input class="col-lg-12 form-control-file" type="file" name="file" id="file_name" required>
                                    <input type="hidden" name="name" value="Document 1">
                                </div>
                        
                                <div class="form-group col-lg-4">
                                    <label class="form-label" for="description">Description: </label>
                                    <input class="col-lg-12 form-control" type="text" name="description" id="description">
                                </div>
                        
                                <div class="form-group col-lg-4">
                                    <label class="form-label" for="end_date">SIWES type</label>
                                    <select class="col-lg-12 form-control" name="siwes_type_id" id="siwes_type_id" required>
                                        <option value="0" selected>All</option>
                                        @foreach ($siwes_types as $siwes )
                                            <option value="{{$siwes->id}}">{{$siwes->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="uploaded_by" value="{{Auth::user()->id}}">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-outline-primary">
                                        Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
@endsection

@section('scripts')
    <script  type="text/javascript">
        new DataTable('#materialsTable');
        // $('#usersTable').DataTable( {
        //     dom: 'Bfrtip',
        //     stateSave: true,
        //     buttons: [
        //         {
        //             extend:    'copyHtml5',
        //             text:      '<i class="far fa-copy"></i> Copy',
        //             titleAttr: 'Copy'
        //         },
        //         {
        //             extend:    'excelHtml5',
        //             text:      '<i class="far fa-file-excel"></i> Excel',
        //             titleAttr: 'Excel'
        //         },
        //         'colvis'
        //     ]
        // } );
    </script>
@endsection