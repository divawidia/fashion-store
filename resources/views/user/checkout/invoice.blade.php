@extends('layout-user.index')
@section('title', 'Invoice')
@section('content')

<style>
    .container{
        font-size:15px;
    }
    
    .table th{
        font-size:15px;
        font-weight:bold;
    }

    .table td{
        font-size:15px;
    }

    h2{
        margin-bottom:20px;
    }

    .btn{
        font-size:15px;
    }
</style>
    <div class="breadcumb_area bg-img" style="background-image: url(assets/user/img/bg-img/breadcumb.jpg); margin-top: 5%">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Invoice</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="checkout_area section-padding-100">
        <div class="container mb-5">
            <div class="row">
    		<div class="col-12 col-md-6 col-lg-12 ml-lg-center">
    			<div class="table-responsive">
                    <table class="table table-bordered">
                    	<thead>
                    		<tr>
                    			<th>No</th>
                    			<th>Tanggal Memesan</th>
                    			<th>Status Pesanan</th>
                                <th>Action</th>

                    		</tr>
                    		<tbody>
                    			@foreach($transactions as $transaction)
                    			<tr>
                    				<td>{{$loop->iteration}}</td>
                    				<td>{{$transaction->created_at}}</td>
                                    <td>{{$transaction->status}}</td>
                    				<td><a href="/users/invoice/{{$transaction->id}}" class="btn btn-info">Cek</a></td>
                    			</tr>
                    			@endforeach
                    		</tbody>
                    	</thead>
                    </table>
                    {!! $transactions->links() !!}
                    </div>
                </div>
               </div>
              </div>
             </div>
@endsection