@extends('layout-admin.index')
@section('title', 'Transaction')
@section('content')
<div style="margin-top:50px ">
    <div class="container">
        <div class="row align-items-centre">
            <div class="col-lg-2">
            </div>
            <div class="col-md-8">
                <div class="component">
                    <div class="card">
                        <form class="form-signin" action="/admin/transaksi/update/{{$transaction->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                        <div class="card-header">
                            <center>
                                <span>Detail Transaksi Pembayaran</span>
                            </center>
                        </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Pemesan</label>
                            <input type="text" class="form-control" placeholder="Nama Produk" value="{{ $transaction->name }}" aria-label="Nama Produk" aria-describedby="basic-addon1" name="name" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pemesanan</label>
                            <input type="datetime" class="form-control" placeholder="Harga Satuan" value="{{ $transaction->created_at }}" aria-label="Harga Satuan" aria-describedby="basic-addon1" name="date_order" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Sub Total</label>
                            <input type="text" class="form-control" placeholder="Deskripsi Produk" value="{{ $transaction->sub_total }}"  aria-label="Deskripsi Produk" aria-describedby="basic-addon1" name="sub_total" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Ongkos Kirim</label>
                            <input type="text" class="form-control" placeholder="Stock" aria-label="Stock" value="{{ $transaction->shipping_cost }}" aria-describedby="basic-addon1" name="ongkir" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Total</label>
                            <input type="text" class="form-control" placeholder="Berat Produk" aria-label="Berat Produk" value="{{ $transaction->total }}"  aria-describedby="basic-addon1" name="total" readonly="">
                        </div>
                        @if($transaction->status == 'expired' || $transaction->status == 'canceled' || $transaction->status == 'unverified' || $transaction->status == 'verified' || $transaction->status == 'delivered' )
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" class="form-control" placeholder="Berat Produk" aria-label="Berat Produk" value="{{ $transaction->status }}"  aria-describedby="basic-addon1" name="ketStatus" readonly="">
                        </div>
                        
                        @endif
                    </div>
                        <div class="card-footer">
                            @if ($transaction->status == "unverified")
                                <input type="hidden" name="status" value="verified">
                                <span><button class="btn btn-md btn-success" type="submit"  onclick="return confirm('Apa yakin ingin mengubah status pembayaran?')" style="margin-right: 20px;">Verifikasi</button></span>
                            @endif
                            @if ($transaction->status === 'verified')
                                <input type="hidden" name="status" value="delivered">
                                <span><button class="btn btn-md btn-success" type="submit" style="margin-right: 20px;">Deliver Products</button></span>
                            @endif
                            
                            <span><h2>Bukti Pembayaran</h2></span>
                            @if($transaction->proof_of_payment == 'Belum Dibayar')
                                <span><h1>User Belum Upload Bukti Pembayaran</h1></span>           

                            @else
                                <img src="{{asset('/image/proof_of_payments/'.$transaction->proof_of_payment)}}" alt="Bukti">
                            @endif
                        </div>
                        </form>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
