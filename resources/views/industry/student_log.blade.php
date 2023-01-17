@extends('layouts.industry')

@section('industrycontent')

    <div class="col-md-12">
        <div class="card border-warning">

            <div class="card-header border-warning ">
                <h4 class="mt-2 blue-text"><b>{{$student->user->last_name}} {{$student->user->first_name}}</b></h4>
            </div>

            <div class="card-body border-warning bg-light">

            </div>
        </div>
    </div>

@endsection
