@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <div id="gmap" style="height: 250px;"></div>
                        <div class="form-group" style="width: 95%; margin: auto; margin-top:5%">

                            <table id="table"  class="table table-hover">
                                <tbody>
                                @foreach($traps as $t)
                                        <tr><td ><a href="{{ route('public_show', $t->id)}}">{{$t->name}}</a></td>

                                            @if($t->battery>0 && $t->battery<=20)
                                                <td ><i class="fa fa-battery-empty" title="{{ $t->battery }}%"></i></td>

                                            @elseif($t->battery>20 && $t->battery<=40)
                                                <td ><i class="fa fa-battery-quarter" title="{{ $t->battery }}%"></i></td>

                                            @elseif($t->battery>40 && $t->battery<=60)
                                                <td ><i class="fa fa-battery-half" title="{{ $t->battery }}%"></i></td>

                                            @elseif($t->battery>60 && $t->battery<=80)
                                                <td ><i class="fa fa-battery-three-quarters" title="{{ $t->battery }}%"></i></td>

                                            @elseif($t->battery>80)
                                                <td ><i class="fa fa-battery-full" title="{{ $t->battery }}%"></i></td>
                                            @endif

                                        </tr>


                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Account</div>

                    <div class="panel-body">
                        @if(request()->user())
                            <a href="/backend" class="btn btn-primary">
                                <i class="fa fa-btn fa-tachometer"></i>Backend
                            </a>
                            <a href="/logout" class="btn btn-default">
                                <i class="fa fa-btn fa-arrow-circle-right"></i>Logout
                            </a>
                        @else
                            {!! Form::open(['route' => 'login_post' ,'class'=>'form']) !!}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-12 control-label">E-Mail Address</label>

                                    <div class="col-md-12">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="col-md-12 control-label">Password</label>

                                    <div class="col-md-12">
                                        <input type="password" class="form-control" name="password">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i>Login
                                        </button>
                                        <a href="{{route('register')}}" class="btn btn-default">
                                            <i class="fa fa-btn fa-user"></i>Register
                                        </a>

                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="//maps.google.com/maps/api/js"></script>
    <script src="{{ asset('js/gmaps.js')  }}"></script>
    <script type="text/javascript">
        $(function() {
            var _id = {{ config('aero.default_marker') }};
            var gmaps = new GMaps({
                div: '#gmap',
                lat: {{ config('aero.lat') }},
                lng: {{ config('aero.lng') }},
                zoom: {{ config('aero.zoom_level') }}
            });
            @foreach($traps as $trap)
            gmaps.addMarker({
                        id: {{ $trap->id }},
                        lat: {{ $trap->latitude }},
                        lng: {{ $trap->longitude }},
                        click: function(e) {
                            _id = e.id;
                            updateData();
                        }
                    });
            @endforeach
});
    </script>
@endsection