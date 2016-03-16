@extends('layouts.backend')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-body">

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($notification, ['method' => 'PATCH', 'action' => ['NotificationsController@update', $notification->id]]) !!}


                    <div class="form-group">
                        {!! Form::label('title', 'Title: ') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}

                    </div>

                    <div class="form-group">
                        {!! Form::label('content', 'Content: ') !!}
                        {!! Form::text('content', null, ['class' => 'form-control']) !!}

                    </div>
                    <div class="form-group">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
