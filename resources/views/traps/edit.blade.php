@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
        <div class="panel-heading">Edit trap</div>
                                <div class="panel-body">




                                            {!! Form::model($trap,['route' => ['traps.update',$trap->id],'method'=>'PATCH' ,'class'=>'form-horizontal']) !!}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name *</label>
                                            <div class="col-sm-10">
                                                <input name="name" type="text" class="form-control"  value="{{ $trap->name }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Pests Network *</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('pests_network_id', $trap->network,$trap->pests_network_id, ['class' => "form-control"]) !!}
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Start date *</label>
                                            <div class="col-sm-10">
                                                <input name="start_date" type="text" class="form-control"  value="{{ $trap->start_date }}">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-10">
                                                <input name="description" type="text" class="form-control"  value="{{ $trap->description }}">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Position</label>
                                            <div class="col-sm-10">
                                                <div id="gmap" style="height: 250px;"></div>
                                                <input name="latitude" type="hidden" value=" {{$trap->latitude }}" />
                                                <input name="longitude" type="hidden" value=" {{$trap->longitude }}" />
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">

                                                {!! Form::checkbox('status', 1,$trap->status)
                                                !!}
                                                Active
                                            </label>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">

                                                {!! Form::checkbox('is_public', 1,$trap->is_public)
                                                !!}
                                                Is_public
                                            </label>
                                        </div>



                                    </div>
                                    <div class="box-footer">
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <a href="" class="btn btn-default">Back</a>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>

                                            {!! Form::close() !!}
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




    </div>

@endsection
@section('scripts')
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
    function openNotification(id){
        $.ajax({
            url:'{{{ route('notification.read') }}}',
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