@extends('layouts.backend')
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Users</h3>
                </div>
                <table id="table" class="table  table-hover">
                    <tbody>
                    <tr>
                        <td>Email</td>
                        <td>Change group</td>
                    </tr>
                    @foreach($users as $user)
                        @if(\Illuminate\Support\Facades\Auth::user()['id']==1)<td colspan="2">@else<td>@endif<b>{{$user->email}}</b></td>
                        @if(!\Illuminate\Support\Facades\Auth::user()['admin'])<td><a href="{{ route('users.admin',$user->id) }}" class="fa fa-check fa-2x" title="Add to admin group"></a> <a style="margin-left: 2%;" href="{{ route('users.edit',$user->id) }}" class="fa fa-pencil-square-o fa-2x" title="Edit user informations"></a></td>@endif
                        @if(\Illuminate\Support\Facades\Auth::user()['admin'] && \Illuminate\Support\Facades\Auth::user()['id']!=1)<td><a href="{{ route('users.user',$user->id) }}" class="fa fa-user fa-2x" title="Add to user group"></a> <a style="margin-left: 2%;" href="{{ route('users.edit',$user->id) }}" class="fa fa-pencil-square-o fa-2x" title="Edit user informations"></a></td>@endif

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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

@endsection