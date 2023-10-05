@extends('layouts.admin')

@section('title', 'Notice Board')

@section('admincontent')
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning">
                
                <div class="card-body p-3">
                    <div class="text-center p-3">
                        @if(session()->has("message"))
                            <div class="alert alert-primary" role='alert'>
                                <strong> {{session()->get('message')}} </strong>
                                <b class="blue-text"> New Notice Uploaded </b>
                            </div>
                        @endif
                        <h4><i class="fas fa-chalkboard"></i></i> Notice Board</h4>
                        <button data-toggle="modal" data-target="#addAnnouncementModal" class="m-2 btn bg-oth-color nav-text-color"><i class="fas fa-paper-plane"></i> Post New Notice</button>
                    </div>

                    <div class="card-body p-3">
                        @if (empty($announcement))
                            <h5 class="text-center">NO Notice has been posted!</h5>
                        @endif
                        @foreach ($announcements as $announce)
                            <div class="col-12 card border-warning mb-3 bg-othe-color">
                                <div class="card-body">
                                    <div style="display: inline-flex">
                                        <img class="logo rounded" src="{{ asset('images/OAU-Logo.png') }}" width="30" height="30" alt="" srcset="">
                                        <p class="card-title"><b> &nbsp;{{$announce->title}}</b></p>
                                    </div>
                                    <p class="text-muted card-subtitle"><i>Post for {{$announce->department}}</i></p>
                                    <p class="card-text">{{$announce->content}}</p>
                                    @if ($announce->uploaded_by == Auth::user()->id)
                                        <div class="float-left">
                                            <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-edit"></i> Edit</button>
                                            <button class="ml-2 btn btn-sm btn-outline-danger"><i class="fa fa-trash-alt"></i> Delete </button>
                                        </div>
                                    @endif
                                    <p class="float-right text-muted"><i>{{$announce->user->last_name}}</i></p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
       <!-- MODALS -->
        <!-- Add New Annnounce Modal -->
            <div class="modal fade" data-keyboard="false" data-backdrop="static" id="addAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="addAnnouncementModal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAnnouncementModalLabel"><b><i class="fa fa-paper-plane"></i> Post New Notice</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="/admin/announce/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label class="form-label" for="file">Title: </label>
                                        <input class="col-lg-12 form-control" type="text" name="title" id="title">
                                        
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label class="form-label" for="department">Department: </label>
                                        <select class="col-lg-12 form-control" name="department" id="department" required>
                                            <option value="All Students" selected>All Students</option>
                                            <option value="Department Coordinator">Department Coordinators</option>
                                            @foreach ($departments as $d )
                                                <option value="{{$d->department}}">{{$d->department}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="content">Content: </label>
                                    <textarea class="col-lg-12 form-control" name="content" id="" cols="50" rows="1"></textarea>
                                </div>
                                <input type="hidden" name="uploaded_by" value="{{Auth::user()->id}}">

                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-outline-primary">
                                       <i class="far fa-paper-plane"></i> Post
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
    </script>
@endsection