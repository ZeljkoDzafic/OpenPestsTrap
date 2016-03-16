@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">

                    <ul class="nav  nav-tabs ">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">
                                <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                                Show traps</a>
                        </li>

                        <li>
                            <a href="#tab3" data-toggle="tab">
                                <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                Diagram of insects</a>
                        </li>

                    </ul>

                    <div  class="tab-content mar-top">
                        <div id="tab1" class="tab-pane fade active in">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div id="gmap" style="height: 250px;"></div>
                                        </div>


                                        <div class="panel-body">




                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Add</h4>
                                                        </div>
                                                        {!! Form::open( array('route'=>['change_plate', $trap->id],'method' => 'post', 'name'=>'directoryForm') )
                                                        !!}
                                                        <div class="modal-body">
                                                            <label for="pageContent">
                                                                Do you want to change a plate?
                                                            </label>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button id="cancelIdButton" type="button" class="btn btn-default" data-dismiss="modal">No
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Yes</button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" style="width: 95%; margin: auto; margin-top:5%">
                                                <table id="table"  class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td><b>Plate number</b></td>
                                                        <td><b>Number of pests</b></td>
                                                    </tr>

                                                    </thead>
                                                    <tbody>
                                                    @foreach($images as $image)
                                                        <tr>
                                                            <td><a style="cursor: pointer" onclick="showImage('{{$image->image }}')"> {!! $image->image !!}</a></td>
                                                            <td>{!!$image->plate_number!!}</td>
                                                            <td>{!!$image->number_of_pests!!}</td>
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

                        <div id="tab3" class="tab-pane fade">
                            <div style="width: 50%">
                                <canvas id="canvas" height="450" width="600"></canvas>
                            </div>
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
    </div>

    <div class="modal fade" id="modal_image" tabindex="-1" role="dialog"
         aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <img alt="Image principale" id="image" src=""/>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/Chart.js') }}"></script>
    <script src="//maps.google.com/maps/api/js"></script>
    <script src="{{ asset('js/gmaps.js')  }}"></script>
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var gmaps = new GMaps({
                div: '#gmap',
                lat: {{$trap->latitude }},
                lng: {{ $trap->longitude }}
    });
            gmaps.addMarker({
                lat: {{$trap->latitude }},
                lng: {{$trap->longitude }},
                draggable: true,
                dragend: function(e) {
                    $('input[name="latitude"]').val(e.latLng.lat());
                    $('input[name="longitude"]').val(e.latLng.lng());
                }
            });
            $('.select2').select2({
                tags: true,
                tokenSeparators: [",", " "]
            }).on("change", function(e) {
                var isNew = $(this).find('[data-select2-tag="true"]');
                if(isNew.length){
                    isNew.replaceWith('<option selected value="'+isNew.val()+'">'+isNew.val()+'</option>');
                }
            });
        });
    </script>
    <script>
        $(function() {
            $('#table').DataTable({
                "paging": false,
                "searching": false,
                "ordering": false,
                "info": false
            });
        });

        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
        var lineChartData = {
            labels : [<?php foreach($images as $image)
                        {
                            echo '"'.$image->created_at.'",';
                        }

        ?>],
            datasets : [
                {
                    label: "Insects in trap",
                    fillColor : "rgba(151,187,205,0.2)",
                    strokeColor : "rgba(151,187,205,1)",
                    pointColor : "rgba(151,187,205,1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(151,187,205,1)",
                    data : [<?php foreach($images as $image)
                        {
                            echo '"'.$image->number_of_pests.'",';
                        }

        ?>]
                }
            ]

        }

        window.onload = function(){
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx).Line(lineChartData, {
                responsive: true
            });
        }



    </script>

    <script>
        function showImage(id){
            $("#modal_image").modal('show');
            $("#image").attr("src","{{asset('uploads/images/'.$trap->user_id)}}"+"/"+id);
        }
    </script>


@endsection