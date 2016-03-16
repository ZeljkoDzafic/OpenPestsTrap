@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
    </style>
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
                                        <a href="#tab2" data-toggle="tab">
                                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                            Error log</a>
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

                                            </div>


                <div class="panel-body">

            <div class="form-group">







                                                {!! Form::open( array('route'=>['upload-image',$trap->id],'method' => 'post', 'class'=>'form',
                                                'files'=>'true','name'=>'uploadFileForm') ) !!}
                <span class="btn btn-primary btn-file">
                    Browse <input id="fileupload" type="file" onchange="this.form.submit()" name="file">
                </span>

                <a type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#myModal" style="margin-left: 2%">
                    Change plate
                </a>

                                               {!! Form::close() !!}

</div>



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
                    <td><b>Image name</b></td>
                    <td><b>Plate number</b></td>
                    <td><b>Number of pests</b></td>
                </tr>

                </thead>
                <tbody>
                @foreach($images as $image)
                <tr>
                    <td><a title="Edit image" href="{{ route('edit_image',$image->id) }}"> <i class="fa fa-picture-o fa-2x"></i></a></td>
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

                    <div id="tab2" class="tab-pane fade">


                    <table id="table"  class="table table-hover">
                     <thead>
                                    <tr>
                                        <td><b>Key</b></td>
                                        <td><b>Value</b></td>
                                    </tr>

                                    </thead>

                                    <tbody>
                                                    @foreach($error_logs as $error_log)
                                                        <tr>
                                                        <td>{{ $error_log->key }}</td>
                                                        <td>{{ $error_log->value }}</td>
                                                    </tr>
                                                   @endforeach

                                                    </tbody>

                    </table>

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
                <div class="panel-heading">Notifications</div>

                <div class="panel-body">
                </div>
            </div>
        </div>

    </div>

    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/Chart.js') }}"></script>
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




@endsection