@extends('layout-admin.index')
@section('title', 'All Notifications')
@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>All Notifications</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onclick="location.href='/admin/markreadadmin'"><i class="fas fa-check"></i> Read All Notification</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width:10%;">Id</th>
                            <th style="width:10%;">Notification</th>
                            <th style="width:10%;">Status</th>
                            {{-- <th style="width:10%;">Timeout</th>
                            <th style="width:10%">Address</th>
                            <th style="width:10%">Regency</th>
                            <th style="width:10%">Province</th>
                            <th style="width:10%">Total</th>
                            <th style="width:10%">Shipping Cost</th>
                            <th style="width:10%">Sub Total</th>
                            <th style="width:10%">Proof</th>
                            <th style="width:10%">Status</th>
                            <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($admin->notifications as $notification)
                        {{-- <input type="hidden" name="user_id" value="{{ $transaksi->id}}"> --}}
                        <tr>
                            <td>{{ $notification->id }}</td>
                            <td>{!! $notification->data !!}</td>
                            @if($notification->read_at == NULL)
                                <td>Unread</td>
                            @endif
                            @if($notification->read_at != NULL)
                                <td>Readed</td>
                            @endif
                            {{-- <td class="table-action">
                                <a href="/admin/transaksi/detail/{{$transaksi->id}}"><i class="align-middle" data-feather="edit-2"></i></a>
                            </td> --}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@stop
