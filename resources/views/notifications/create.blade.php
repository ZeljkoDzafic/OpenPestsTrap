@extends('layouts.backend')
@section('styles')
    <link rel="stylesheet" type="text/css" media="all"  href="{{ asset('css/jquery.dataTables.min.css') }}" >

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="livicon" data-name="plus-alt" data-size="16" data-loop="true"
                                               data-c="#fff" data-hc="white"></i>
                        Create notification
                    </h4>
                </div>
                <div class="panel-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['route' => 'notifications.store']) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title: ') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}

                    </div>

                    <div class="form-group">
                        {!! Form::label('content', 'Content: ') !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control']) !!}

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-4">
                            <a class="btn btn-danger" href="{{ route('notifications.index') }}">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
