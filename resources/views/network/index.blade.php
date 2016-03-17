@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Networks</div>

                <div class="panel-body">

                    <div id="gmap" style="height: 250px;"></div>

            <div class="form-group">
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#myModal" style="margin-left: 2%">
                    Add network
                </button>
                <a href="{{route('traps.create')}}"> <button type="button" class="btn btn-primary"
                         style="margin-left: 2%">
                    Add trap
                </button></a>
            </div>



            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add</h4>
                        </div>
                        {!! Form::open( array('route'=>'network.store','method' => 'post', 'name'=>'directoryForm') )
                        !!}
                        <div class="modal-body">
                            <label for="pageContent">
                                Name
                            </label>

                            <div class="form-group">
                                {!! Form::text('name','',array('class' =>'form-control')) !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="cancelIdButton" type="button" class="btn btn-default" data-dismiss="modal">Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>


                <div class="form-group" style="width: 95%; margin: auto; margin-top:5%">

            <table id="table"  class="table table-hover">
                <tbody>
                @foreach($networks as $network)
                    <tr>
                <td colspan="5" ><b>{{ $network['name']}}</b></td>
                    </tr>
                    @foreach($traps as $t)
                        @if($t->pests_network_id == $network['id'])
                            <tr><td ><a href="{{ route('traps.show', $t->id)}}">{{$t->name}}</a></td>

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



                                <td ><a href="#"><i  class="fa fa-camera-retro"></i></a></td>

                                <td><a href="{{ route('traps.edit', $t->id)}}"><i class="fa fa-pencil-square-o"></i> </a></td>
                                <td>
                                    <a href="{{ route('delete_trap', $t->id)}}"><i class="fa fa-trash"></i> </a>
                                </td>
                            </tr>
                        @endif

                @endforeach

                @endforeach
                </tbody>
                </table>
                    </div>

        </div>
    </div>




        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Notifications</div>
                <div class="panel-body">
                    <table id="table"  class="table table-hover">
                        <tbody>
                        @foreach($notifications as $notification)
                            <tr><td><a style="cursor: pointer;" onclick="openNotification({{ $notification->id }})">{{ $notification['title']  }}</a></td></tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade" tabindex="-1" role="dialog" id="notification">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <p id="content"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
</div>
@endsection


    @section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="//maps.google.com/maps/api/js"></script>
        <script src="{{ asset('js/gmaps.js')  }}"></script>
        <script>
            $(document).ready(function () {

                var _id = {{ config('aero.default_marker') }};
                var gmaps = new GMaps({
                    div: '#gmap',
                    lat: {{ config('aero.lat') }},
                    lng: {{ config('aero.lng') }},
                    zoom: {{ config('aero.zoom_level') }}
            });
                @foreach($traps as $t)
                gmaps.addMarker({
                            id: {{ $t->id }},
                            lat: {{ $t->latitude }},
                            lng: {{ $t->longitude }},
                            click: function(e) {
                                _id = e.id;
                                updateData();
                            }
                        });
                @endforeach
            });
        </script>

        <script>
            function openNotification(id){
                $.ajax({
                    url:'{{ route('notification.read') }}',
                    type: 'GET',
                    data:{"id":id},
                    success: function (response){
                        var res = $.parseJSON(response);
                        $("#title").text(res[0].title);
                        $("#content").text(res[0].content);
                        $("#notification").modal('show');
                    }
                });

            }
        </script>

    @endsection