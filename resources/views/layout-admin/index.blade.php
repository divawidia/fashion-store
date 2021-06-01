<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">

    <link rel="shortcut icon" href="icons/icon-48x48.png" />

    <title>@yield('title')</title>

    <link href="{{ URL::asset('/assets-admin/css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />
    @yield('styles')
    <style>
        .notifForm button a {
            pointer-events: none;
        }

    </style>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">Fashi.</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item {{ (request()->is('dashboard*')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/dashboard">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ (request()->is('product*')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/product">
                            <i class="align-middle" data-feather="box"></i> <span class="align-middle">Product</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ (request()->is('courier*')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/courier">
                            <i class="align-middle" data-feather="truck"></i> <span class="align-middle">Courier</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ (request()->is('category*')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/category">
                            <i class="align-middle" data-feather="tag"></i> <span class="align-middle">Category</span>
                        </a>
                    </li>

                    <!-- <li class="sidebar-item {{ (request()->is('discount*')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ url('discount') }}">
                            <i class="align-middle" data-feather="percent"></i> <span class="align-middle">Discount</span>
                        </a>
                    </li> -->

                    <li class="sidebar-item {{ (request()->is('transaction*')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/transaction">
                            <i class="align-middle" data-feather="credit-card"></i> <span
                                class="align-middle">Transaction</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ (request()->is('reports*')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="/admin/reports">
                            <i class="align-middle" data-feather="clipboard"></i> <span
                                class="align-middle">Reports</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <form class="form-inline d-none d-sm-inline-block">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" placeholder="Search…" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn" type="button">
                                <i class="align-middle" data-feather="search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <?php 
                                $id = 1;
                                $admin = App\Models\admin::find(1);
                                $notif_count = $admin->unreadNotifications->count();
                                $notifications = DB::table('admin_notifications')->where('notifiable_id',$id)->where('read_at',NULL)->orderBy('created_at','desc')->get();
                            ?>

                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indikator">{{$notif_count}}</span>
                                </div>
                            </a>
                            {{--                             
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell-o"></i><span class="badge">{{$notif_count}}</span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="notification_header">
                                        <h3>You have {{$notif_count}} new notification</h3>
                                    </div>
                                </li>
                                <li>
                                    @foreach($notifications as $notif)
                                    {!!$notif->data!!}
                                    @endforeach
                                </li>
                                <li>
                                    <div class="notification_bottom">
                                        <a class="btn btn-block" href="/admin/marknotifadmin">Mark as Read</a>
                                    </div>
                                </li>
                                <div class="clearfix"></div>
                            </ul> --}}
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="notification_header">
                                    <h3>You have {{$notif_count}} new notification</h3>
                                </div>
                                <div class="list-group">

                                    @foreach($notifications as $notif)
                                    <form class="notifForm" action="/admin/readSpesificNotif" id="{{$notif->id}}"
                                        method="POST">
                                        @csrf
                                        <input name="notifId" type="hidden" value="{{$notif->id}}">
                                        <input type="hidden" name="url">
                                        <button type="submit">
                                            {!! json_decode($notif->data, JSON_UNESCAPED_SLASHES) !!}
                                        </button>
                                    </form>
                                    @endforeach
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="/admin/showAllNotif" class="text-muted">Show All Notifications</a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-toggle="dropdown">
                                <img src="{{ asset('/assets-admin/img/avatars/avatar.jpg')}}"
                                    class="avatar img-fluid rounded mr-1" alt="Admin" /> <span
                                    class="text-dark">Admin</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">

                                <a class="dropdown-item" href="/logout">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Content Wrapper. Contains page content -->
            <main class="content">


                <!-- Content Header (Page header) -->
                <br />
                <!-- /.content-header -->
                <div class="container">
                    @yield('content')
                </div>
                <!-- /.card-body -->
            </main>

            <!-- /.content-wrapper -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-left">
                            <p class="mb-0">
                                <a href="index.html" class="text-muted"><strong>Fashi.</strong></a> &copy;
                            </p>
                        </div>

                    </div>
                </div>
            </footer>
        </div>
    </div>


        <script src="{{ asset('/assets-admin/js/app.js')}}"></script>



        <script src="{{ asset('assets/Admin/js/jquery.nicescroll.js')}}"></script>
        <script src="{{ asset('assets/Admin/js/scripts.js')}}"></script>
        <!--//scrolling js-->
        <script src="{{ asset('assets/Admin/js/bootstrap.js')}}"> </script>
        <script>
            $('#tombol').click(function (e) {
                e.preventDefault();
                $('#modalContactForm').modal();
            });

        </script>
        <script>
            $(document).ready(function (e) {
                $(".status").click(function (e) {
                    var index = $(".status").index(this);
                    var myStatus = '';
                    console.log(index);
                    switch (index) {
                        case 0:
                            myStatus = 'all';
                            break;
                        case 1:
                            myStatus = 'unverified';
                            break;
                        case 2:
                            myStatus = 'waiting';
                            break;
                        case 3:
                            myStatus = 'verified';
                            break;
                        case 4:
                            myStatus = 'delivered';
                            break;
                        case 5:
                            myStatus = 'success';
                            break;
                        case 6:
                            myStatus = 'canceled';
                            break;

                    }

                    console.log(myStatus);
                    jQuery.ajax({
                        url: "{{url('/admin/transaksi/sort')}}",
                        method: 'post',
                        data: {
                            _token: $('#signup-token').val(),
                            status: myStatus,
                        },
                        success: function (result) {
                            $('.ganti').html(result.hasil);
                        }
                    });
                });
            });

        </script>


        <script>
            function formatRupiah(angka, prefix) {
                var number_string = angka.toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
            }

            function creteChart(tahun, ttlTahun, judul = '') {
                var options = {
                    axisX: {
                        interval: 1,
                        labelMaxWidth: 180,
                        labelAngle: -45,
                        labelFontFamily: "Times New Roman"
                    },
                    title: {
                        text: "Grafik Jumlah Transaksi " + judul + " Perbulan " + ttlTahun
                    },
                    data: [{
                        type: "column",
                        dataPoints: [{
                                label: "Januari",
                                y: tahun[1]
                            },
                            {
                                label: "Februari",
                                y: tahun[2]
                            },
                            {
                                label: "Maret",
                                y: tahun[3]
                            },
                            {
                                label: "April",
                                y: tahun[4]
                            },
                            {
                                label: "Mei",
                                y: tahun[5]
                            },
                            {
                                label: "Juni",
                                y: tahun[6]
                            },
                            {
                                label: "Juli",
                                y: tahun[7]
                            },
                            {
                                label: "Agustus",
                                y: tahun[8]
                            },
                            {
                                label: "September",
                                y: tahun[9]
                            },
                            {
                                label: "Oktober",
                                y: tahun[10]
                            },
                            {
                                label: "November",
                                y: tahun[11]
                            },
                            {
                                label: "Desember",
                                y: tahun[12]
                            },

                        ]
                    }]
                };

                $("#chartContainer").CanvasJSChart(options);
            }
            jQuery(document).ready(function (e) {
                console.log($('#bulan1').val())
                jQuery('#bulan').change(function (e) {
                    jQuery.ajax({
                        url: "{{url('/report-bulan')}}",
                        method: 'post',
                        data: {
                            _token: $('#signup-token').val(),
                            bulan: $('#bulan').val(),
                            tahun: $('#tahun').val(),
                        },
                        success: function (result) {
                            $('#total').text(result.data['total']);
                            $('#unverified').text(result.data['unverified']);
                            $('#expired').text(result.data['expired']);
                            $('#canceled').text(result.data['canceled']);
                            $('#verified').text(result.data['verified']);
                            $('#delivered').text(result.data['delivered']);
                            $('#success').text(result.data['success']);
                            var uang = formatRupiah(result.data['harga'], 'Rp ');
                            $('#harga').text(uang);
                        }
                    });
                });

                jQuery('#tahun').change(function (e) {
                    jQuery.ajax({
                        url: "{{url('/report-tahun')}}",
                        method: 'post',
                        data: {
                            _token: $('#signup-token').val(),
                            bulan: $('#bulan').val(),
                            tahun: $('#tahun').val(),
                        },
                        success: function (result) {
                            $('#total').text(result.data_bulan['total']);
                            $('#unverified').text(result.data_bulan['unverified']);
                            $('#expired').text(result.data_bulan['expired']);
                            $('#canceled').text(result.data_bulan['canceled']);
                            $('#verified').text(result.data_bulan['verified']);
                            $('#delivered').text(result.data_bulan['delivered']);
                            $('#success').text(result.data_bulan['success']);
                            var uang = formatRupiah(result.data_bulan['harga'], 'Rp ');
                            $('#harga').text(uang);

                            $('#total-tahun').text(result.data['total']);
                            $('#unverified-tahun').text(result.data['unverified']);
                            $('#expired-tahun').text(result.data['expired']);
                            $('#canceled-tahun').text(result.data['canceled']);
                            $('#verified-tahun').text(result.data['verified']);
                            $('#delivered-tahun').text(result.data['delivered']);
                            $('#success-tahun').text(result.data['success']);
                            var uang_tahun = formatRupiah(result.data['harga'], 'Rp ');
                            $('#harga-tahun').text(uang_tahun);

                            creteChart(result.tahun, $('#tahun').val());
                        }

                    });
                });

                $(".status").click(function (e) {
                    var index = $(".status").index(this);
                    var myStatus = '';
                    switch (index) {
                        case 0:
                            myStatus = 'all';
                            break;
                        case 1:
                            myStatus = 'unverified';
                            break;
                        case 2:
                            myStatus = 'expired';
                            break;
                        case 3:
                            myStatus = 'verified';
                            break;
                        case 4:
                            myStatus = 'delivered';
                            break;
                        case 5:
                            myStatus = 'success';
                            break;
                        case 6:
                            myStatus = 'canceled';
                            break;

                    }
                    jQuery.ajax({
                        url: "{{url('/grafik')}}",
                        method: 'post',
                        data: {
                            _token: $('#signup-token').val(),
                            status: myStatus,
                            tahun: $('#tahun').val(),
                        },
                        success: function (result) {
                            creteChart(result.grafik, $('#tahun').val(), myStatus);
                        }
                    });
                });
            });

        </script>
        <script>
            $('.notifForm').submit(function (e) {
                var tes = $(this).find('button').find('a').attr('href');
                $(this).find('input[name="url"]').val(tes);

            });

        </script>
        @yield('scripts')

</body>

</html>
