<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('/assets-user/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets-user/css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        
        
        <div class="nav-item">
            <div class="container">
                <!-- <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            <li class="active"><a href="#">Women’s Clothing</a></li>
                            <li><a href="#">Men’s Clothing</a></li>
                        </ul>
                    </div>
                </div> -->
                <!-- <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="{{ (request()->is('home*')) ? 'active' : '' }}"><a href="{{ url('home') }}">Home</a></li>
                        <li class="{{ (request()->is('shop*')) ? 'active' : '' }}"><a href="{{ url('shop') }}">Shop</a></li>
                        
                        <li class="{{ (request()->is('contact*')) ? 'active' : '' }}"><a href="{{ url('contact') }}">Contact</a></li>
                        
                    </ul>
                </nav> -->
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    @yield('content')

    <!-- Footer Section Begin -->
    
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('/assets-user/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/assets-user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets-user/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/assets-user/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('/assets-user/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('/assets-user/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('/assets-user/js/jquery.dd.min.js') }}"></script>
    <script src="{{ asset('/assets-user/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('/assets-user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/assets-user/js/main.js') }}"></script>
</body>

</html>