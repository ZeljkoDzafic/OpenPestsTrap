@extends('layouts.backend')
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h1 class="box-title">Notifications</h1>
            </div>

            <div class="form-group" style="margin-top: 2%;margin-bottom: 2%">
                <a href="{{ route('notifications.create') }}">
                    <button type="button" class="btn btn-primary" style="margin-left: 2%">
                        Add new notification
                    </button>
                </a>
            </div>
            <div style="width: 95%; margin: auto">

            <table id="table" class="table  table-hover">
                <thead>
                <tr class="filters">
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($notifications as $notification)
                <tr>
                    <td><a href="{{ route('notifications.show',$notification->id) }}" title="Read notification"> {{ $notification->title }}</a></td>
                    <td>
                        <a href="{{ route('notifications.edit',$notification->id) }}"><button class="fa fa-pencil-square-o" title="Edit notification"></button></a>
                        <a href="#" ><button onclick="showModal({{{ $notification->id }}})" class="fa fa-trash" type="submit" title="Delete notification"></button></a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<div data-id="123" class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="delete_notification" aria-hidden="true">

    <div data-id="123" class="modal-dialog" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirm</h4>
            </div>
            <div class="modal-body">
                <p>Delete notification?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="delete_notification()">Delete notification</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endsection
@section('scripts')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function() {
            $('#table').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>

<script>
    function showModal(id)
    {
        $('#deleteModal').modal('show');
        $('#deleteModal').data('data-id' , id);
    }

    function delete_notification(){
        $.ajax({
            url: '{{{ route('notification.delete') }}}',
            type: 'GET',
            data:{"id":$('#deleteModal').data('data-id')},
        success: function () {
            $("#success-alert").show();
            $("#deleteModal").modal('hide');
            location.reload();
        }
    });
    }
</script>
@endsection