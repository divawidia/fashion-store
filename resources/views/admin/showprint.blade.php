<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi Tahunan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
 
	<div class="container">
		<center>
			<h4>Laporan Transaksi Toko Baju 10</h4>
			<h5><a>{{$tahun}}</a></h5>
		</center>
		<br/>
        <form action="/admin/pdf" method="POST">
            @csrf
            <input type="hidden" name="tahun" value="{{$tahun}}">
                <button type="submit" class="btn btn-primary">
                    CETAK PDF
                </button>
        </form>
        <br>
        <form action="/admin/dashboard" method="get">
            @csrf
                <button type="submit" class="btn btn-primary">
                    DASHBOARD
                </button>
        </form>
        <br>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Id Transaksi</th>
					<th>Nama Produk</th>
					<th>Status</th>
					<th>Tanggal/Waktu</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($transaksi as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$p->id_transaksi}}</td>
					<td>{{$p->nama_produk}}</td>
					<td>{{$p->status}}</td>
					<td>{{$p->datetime}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
        <h4>Banyak Transaksi: {{$jumlah}}</h4>
        <h4>Total Transaksi: Rp {{number_format($total,0,',','.')}},-</h4>
	</div>
 
</body>
</html>