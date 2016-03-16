@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">

                    <div class="form-group">

                        {!! Form::model($user,['route' => ['user.update',$user->id],'method'=>'POST' ,'class'=>'form-horizontal']) !!}

                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name', $user->name) }}">
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input name="email" type="text" disabled class="form-control" placeholder="Email" value="{{ old('email', $user->email) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input name="password" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password Confirmation</label>
                                <div class="col-sm-10">
                                    <input name="password_confirmation" type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <a href="{{route('users.index')}}" class="btn btn-default">Back</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}
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
</div>
@endsection

@section('scripts')
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