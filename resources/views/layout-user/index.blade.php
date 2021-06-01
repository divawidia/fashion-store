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


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<link href="{{asset('assets/css/mdb.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('assets/User/styles/bootstrap4/bootstrap.min.css')}}">
<link href="{{ asset('assets/User/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/User/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/User/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/User/plugins/OwlCarousel2-2.2.1/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/User/styles/product.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/User/styles/product_responsive.css')}}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .notifForm button a{
            pointer-events: none;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        hello.fashi@gmail.com
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        +65 11.188.888
                    </div>
                </div>
                <div class="ht-right">
                    <a href="{{ url('dashboard')}}" class="login-panel"></a>
                    {{-- <a href="{{ url('login') }}" class="login-panel"><i class="fa fa-user"></i>Login</a> --}}
                    
                    <div class="login-panel">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a style="font-size:15px;" class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="./index.html">
                                <img src="{{ asset('/assets-user/img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <input type="text" placeholder="What do you need?">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <?php 
                                    	$id = Auth::user()->id;
                                    	$notif_count = Auth()->user()->unreadNotifications->count();
                                    	$notifications = DB::table('user_notifications')->where('notifiable_id',$id)->where('read_at',NULL)->orderBy('created_at','desc')->get();
                            		?>
                                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                                    <i class="icon_comment_alt"></i>
                                    <!-- Notification -->
                                    <span>{{$notif_count}}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
                                <div class="notification_header">
                                    <h3>You have {{$notif_count}} new notification</h3>
                                </div>
                                <div class="list-group">
                                    @foreach($notifications as $notif)
                                    <form class="notifForm" action="/users/userSpesificNotif" id="{{$notif->id}}" method="POST">
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
                                    <a href="/users/showAllNotif" class="text-muted">Show All Notifications</a>
                                </div>
                            </div>
                            </li>
                            <li class="cart-icon">
                                <a href="/users/detailcart">
                                    <i class="icon_bag_alt"></i>
                                    <!-- Cart Total -->
                                    <span>0</span>
                                </a>
                            </li>
                            <li class="cart-price">$0</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            <li class="active"><a href="#">Women’s Clothing</a></li>
                            <li><a href="#">Men’s Clothing</a></li>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="{{ (request()->is('home*')) ? 'active' : '' }}"><a href="/users/home">Home</a></li>
                        <li class="{{ (request()->is('shop*')) ? 'active' : '' }}"><a href="/users/shop">Shop</a></li>
                        <!-- <li><a href="#">Collection</a>
                            <ul class="dropdown">
                                <li><a href="#">Men's</a></li>
                                <li><a href="#">Women's</a></li>
                                <li><a href="#">Kid's</a></li>
                            </ul>
                        </li> -->
                        <li class="{{ (request()->is('contact*')) ? 'active' : '' }}"><a href="{{ url('users/contact') }}">Contact</a></li>
                        <li class="{{ (request()->is('order*')) ? 'active' : '' }}"><a href="{{ url('users/viewpayment/{{auth()->user()->id')}}">Your Order</a></li>
                        <!-- <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./blog-details.html">Blog Details</a></li>
                                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="./check-out.html">Checkout</a></li>
                                <li><a href="./faq.html">Faq</a></li>
                                <li><a href="./register.html">Register</a></li>
                                <li><a href="./login.html">Login</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="{{ asset('/assets-user/img/footer-logo.png') }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello.fashi@gmail.com</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Services</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                            <li><a href="#">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="{{ asset('/assets-user/img/payment-method.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
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
    <script>
                                    $('.notifForm').submit(function(e){
                                        var tes=$(this).find('button').find('a').attr('href');
                                        $(this).find('input[name="url"]').val(tes);
                                        
                                        
                                        
                                    });
                                </script>
</body>

</html>