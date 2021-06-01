@extends('layout-admin.index')
@section('title', 'Dashboard')
@section('content')

<style>
    .form-control{
        margin-top:20px;
        margin-bottom : 20px;
    }

    .btn{
        margin-left:-15px;
    }
</style>

<div class="container-fluid p-0">
    <div class="card">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <div class="panel-heading mt-5">Transaction Data of <?php echo date("Y"); ?></div>
                    <br>
                    <div class="panel-body mb-5">
                        {{-- <button onclick="location.href='/admin/reports2021'">2021 Reports</button> --}}
                        <canvas id="canvas1" height="280" width="600"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid p-3">
{{-- ======================================================================================================================= --}}
<form action="/admin/cekReport" method="POST">
    @csrf
    <div class="row">
        <div class="card flex-fill w-40 mr-2">
            <div class="col-md-6 market-update-right">
                <div class="market-update-block clr-block-3">
                    <div class="card-body">
                        <h4 class="font-weight-normal">Transaksi Bulan
                            
                            <select class="form-control" name="bulan" id="bulan">
                                <option value="01" style="color:black" @if ($bulan==1) selected @endif>Januari</option>
                                <option value="02" style="color:black" @if ($bulan==2) selected @endif>Februari</option>
                                <option value="03" style="color:black" @if ($bulan==3) selected @endif>Maret</option>
                                <option value="04" style="color:black" @if ($bulan==4) selected @endif>April</option>
                                <option value="05" style="color:black" @if ($bulan==5) selected @endif>Mei</option>
                                <option value="06" style="color:black" @if ($bulan==6) selected @endif>Juni</option>
                                <option value="07" style="color:black" @if ($bulan==7) selected @endif>Juli</option>
                                <option value="08" style="color:black" @if ($bulan==8) selected @endif>Agustus</option>
                                <option value="09" style="color:black" @if ($bulan==9) selected @endif>September
                                </option>
                                <option value="10" style="color:black" @if ($bulan==10) selected @endif>Oktober</option>
                                <option value="11" style="color:black" @if ($bulan==11) selected @endif>November
                                </option>
                                <option value="12" style="color:black" @if ($bulan==12) selected @endif>Desember
                                </option>
                            </select>
                        </h4>
                        <h4 class="mb-2">Jumlah Transaksi: <span><strong id="total">{{$transaksi1}}</strong></span></h4>
                        <p>Unverified Transaction <span> <strong id="unverified">{{$unverified1}}</strong></span></p>
                        <p>Expired Transaction <span><strong id="expired">{{$expired1}}</strong></span></p>
                        <p>Canceled Transaction <span><strong id="canceled">{{$canceled1}}</strong></span></p>
                        <p>Verified Transaction <span><strong id="verified">{{$verified1}}</strong></span></p>
                        <p>Delivered Transaction <span><strong id="delivered">{{$delivered1}}</strong></span></p>
                        <p>Success Transaction <span><strong id="success">{{$success1}}</strong></span></p>
                        <h5>Total Penghasilan <span><strong id="harga">Rp
                                    {{number_format($jumlah,0,',','.')}},-</strong></span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="card flex-fill w-40">
            <div class="col-md-6 market-update-gd">
                <div class="market-update-block clr-block-3">
                    <div class="card-body">
                        <h4 class="font-weight-normal mb-3">Transaksi Tahun
                        <select class="form-control" onchange="myFunction()" name="tahun" id="mySelect">
                                @for ($i = 2019; $i <= date('Y'); $i++) <option name="tahun" value="{{$i}}" @if ($i==$tahun)
                                    selected @endif style="color:black">{{$i}}</option>
                                    @endfor
                            </select> <i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h4 class="mb-2">Jumlah Transaksi: <span><strong
                                    id="total-tahun">{{$tahun_transaksi1}}</strong></span></h4>
                        <p>Unverified Transaction <span> <strong
                                    id="unverified-tahun">{{$tahun_unverified1}}</strong></span></p>
                        <p>Expired Transaction <span><strong id="expired-tahun">{{$tahun_expired1}}</strong></span></p>
                        <p>Canceled Transaction <span><strong id="canceled-tahun">{{$tahun_canceled1}}</strong></span>
                        </p>
                        <p>Verified Transaction <span><strong id="verified-tahun">{{$tahun_verified1}}</strong></span>
                        </p>
                        <p>Delivered Transaction <span><strong id="delivered-tahun">{{$tahun_delivered1}}</strong></span>
                        </p>
                        <p>Success Transaction <span><strong id="success-tahun">{{$tahun_success1}}</strong></span></p>
                        <h5>Total Penghasilan <span><strong id="harga-tahun">Rp
                                    {{number_format($tahun_jumlah,0,',','.')}},-</strong></span></h5>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <button class="btn btn-success">
        Cek Report
    </button>
</form>
    <form action="/admin/viewpdf" method="POST">
    @csrf
    <input id="passingTahun" type="hidden" name="tahun">
        <button type="submit" class="btn btn-success">
            View Cetak Laporan
        </button>
    </form>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>


<script>
    var month = @php echo $month @endphp;
    var transaksi = @php echo $transaksi @endphp;
    var success = @php echo $success @endphp;
    var unverified = @php echo $unverified @endphp;
    var canceled = @php echo $canceled @endphp;
    var expired = @php echo $expired @endphp;
    var verified = @php echo $verified @endphp;
    var delivered = @php echo $delivered @endphp;

    var barChartData = {
        labels: month,
        datasets: [{
                label: 'Transaksi',
                backgroundColor: "blue",
                data: transaksi
            },
            {
                label: 'Success',
                backgroundColor: "green",
                data: success
            },
            {
                label: 'Unverified',
                backgroundColor: "orange",
                data: unverified
            },
            {
                label: 'Canceled',
                backgroundColor: "red",
                data: canceled
            },
            {
                label: 'Expired',
                backgroundColor: "black",
                data: expired
            },
            {
                label: 'Verified',
                backgroundColor: "yellow",
                data: verified
            },
            {
                label: 'Delivered',
                backgroundColor: "purple",
                data: delivered
            }
        ]
    };

    window.onload = function () {
        var ctx = document.getElementById("canvas1").getContext("2d");
        window.myBar =
            new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Data Transaksi dan Penjualan'
                    }
                }


            });

    };

</script>
<script>
    function myFunction() {
      var x = document.getElementById("mySelect").value;
      document.getElementById("passingTahun").value = x;
    }
</script>


@endsection
