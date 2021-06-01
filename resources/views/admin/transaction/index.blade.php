@extends('layout-admin.index')
@section('title', 'Transaction')
@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Transaction</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onclick="location.href='{{ url('discount-add') }}'"><i
                            class="fas fa-plus"></i></button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width:10%;">No</th>
                            <th style="width:10%;">Timeout</th>
                            <th style="width:10%">Address</th>
                            <th style="width:10%">Regency</th>
                            <th style="width:10%">Province</th>
                            <th style="width:10%">Total</th>
                            <th style="width:10%">Shipping Cost</th>
                            <th style="width:10%">Sub Total</th>
                            <th style="width:10%">Proof</th>
                            <th style="width:10%">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction as $transaksi)
                        <input type="hidden" name="user_id" value="{{ $transaksi->id}}">
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$transaksi->timeout}}</td>
                            <td>{{$transaksi->address}}</td>
                            <td>{{$transaksi->regency}}</td>
                            <td>{{$transaksi->province}}</td>
                            <td>{{$transaksi->total}}</td>
                            <td>{{$transaksi->shipping_cost}}</td>
                            <td>{{$transaksi->sub_total}}</td>
                            <td>{{$transaksi->proof_of_payment}}</td>
                            <td>{{$transaksi->status}}</td>
                            <td class="table-action">
                                @if($transaksi->status == "expired" || $transaksi->status == "canceled" ||
                                $transaksi->status == "delivered" || $transaksi->status == "success")
                                <i class="align-middle" data-feather="edit-2"></i>
                                @endif
                                @if($transaksi->status == "unverified" || $transaksi->status == "verified")
                                <a href="/admin/transaksi/detail/{{$transaksi->id}}"><i class="align-middle"
                                        data-feather="edit-2"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@stop
