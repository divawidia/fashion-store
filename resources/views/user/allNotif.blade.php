@extends('layout-user.index')
@section('title', 'Invoice')
@section('content')
    <div class="breadcumb_area bg-img" style="background-image: url(assets/user/img/bg-img/breadcumb.jpg); margin-top: 5%">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>All My Notifications</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="checkout_area section-padding-100">
        <div class="container">
            <div class="row">
    		<div class="col-12 col-md-6 col-lg-12 ml-lg-center">
    			<div class="table-responsive">
                    <div class="card-header">
                        <button class="btn btn-success" onclick="location.href='/users/markreaduser'"><i class="fas fa-check"></i> Read All Notification</button>
                    </div>
                    <table class="table table-bordered">
                    	<thead>
                    		<tr>
                                <th>Notification</th>
                                <th>Status</th>

                    		</tr>
                    		<tbody>
                    			@foreach($user->notifications as $notification)
                                    {{-- <input type="hidden" name="user_id" value="{{ $transaksi->id}}"> --}}
                                    <tr>
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
                    	</thead>
                    </table>
                    </div>
                </div>
               </div>
              </div>
             </div>
@endsection