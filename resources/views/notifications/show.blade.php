@extends('layouts.backend')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-body">

                    <h1>{{ $notification->title }}</h1>

                    <h4>{{ $notification->content }}</h4>

                    <a href="{{ route('notifications.index') }}"><button class="btn btn-primary">Back</button> </a>

                </div>
            </div>
        </div>
    </div>

@endsection
