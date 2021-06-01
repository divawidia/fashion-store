@extends('login.homelogin')
@section('title', 'Home')
@section('content')
@php
    use \App\Http\Controllers\HomeController;
@endphp
<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        <div class="single-hero-items set-bg" data-setbg="{{ asset('/assets-user/img/hero-1.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <span>Bag,Woman</span>
                        <h1>Black friday</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore</p>
                        <a href="{{ url('login') }}" class="primary-btn">Shop Now</a>
                    </div>
                </div>
                <div class="off-card">
                    <h2>Sale <span>50%</span></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<div class="banner-section spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="single-banner">
                    <img src="{{ asset('/assets-user/img/banner-1.jpg') }}" alt="">
                    <div class="inner-text">
                        <h4>Men’s</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-banner">
                    <img src="{{ asset('/assets-user/img/banner-2.jpg') }}" alt="">
                    <div class="inner-text">
                        <h4>Women’s</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Section End -->

<!-- Women Banner Section Begin -->
<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-large set-bg" data-setbg="{{ asset('/assets-user/img/products/women-large.jpg') }}">
                    <h2>Women’s</h2>
                    <a href="{{ url('login') }}">Discover More</a>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <div class="filter-control">
                    <ul>
                        @foreach($categories as $category)
                        <!-- <li class="active">{{ $category->category_name }}</li> -->
                        <li>{{ $category->category_name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                    @foreach($products as $product)
                        <div class="product-item">
                            <div class="pi-pic">
                                @foreach($product->images as $image)
                                    <img src="/product-images/{{$image->image_name}}" alt="">
                                    @break
                                @endforeach
                                @php
                                    $discount = $product->discounts;
                                    $disc = HomeController::tampildiskon($discount);
                                @endphp
                                @if($disc!=0)
                                <div style="background-color:#e7ab3c;font-weight:bold; color:white;" class="product_extra product_new">Sales -{{$disc}}%</div>
                                @endif
                                <div class="icon">
                                    <i class="icon_heart_alt"></i>
                                </div>
                                <ul>
                                    <li class="w-icon active"><a href="{{ url('login') }}"><i class="icon_bag_alt"></i></a></li>
                                    <li class="quick-view"><a href="{{ url('login') }}">+ Quick View</a></li>
                                    <li class="w-icon"><a href="{{ url('login') }}"><i class="fa fa-random"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                @foreach($product->categories as $category)
                                    <div class="catagory-name">{{$category->category_name}}</div>
                                @endforeach
                                <a href="#">
                                    <h5>{{$product->product_name}}</h5>
                                </a>
                                <div class="product-price">
                                    {{"Rp "}}{{$product->price}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Women Banner Section End -->

<!-- Deal Of The Week Section Begin-->
<!-- <section class="deal-of-week set-bg spad" data-setbg="{{ asset('/assets-user/img/time-bg.jpg') }}">
    <div class="container">
        <div class="col-lg-6 text-center">
            <div class="section-title">
                <h2>Countdown Pembayaran</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br /> do ipsum dolor sit amet,
                    consectetur adipisicing elit </p>
                <div class="product-price">
                    $35.00
                    <span>/ HanBag</span>
                </div>
            </div>
            <div class="countdown-timer" id="countdown">
                <div class="cd-item">
                    <span>56</span>
                    <p>Days</p>
                </div>
                <div class="cd-item">
                    <span>12</span>
                    <p>Hrs</p>
                </div>
                <div class="cd-item">
                    <span>40</span>
                    <p>Mins</p>
                </div>
                <div class="cd-item">
                    <span>52</span>
                    <p>Secs</p>
                </div>
            </div>
            <a href="#" class="primary-btn">Shop Now</a>
        </div>
    </div>
</section> -->
<!-- Deal Of The Week Section End -->

<!-- Man Banner Section Begin -->
<section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="filter-control">
                    <ul>
                        @foreach($categories as $category)
                        <!-- <li class="active">{{ $category->category_name }}</li> -->
                        <li>{{ $category->category_name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="product-slider owl-carousel">
                    @foreach($products as $product)
                    <div class="product-item">
                        <div class="pi-pic">
                            @foreach($product->images as $image)
                                <img src="/product-images/{{$image->image_name}}" alt="">
                                @break
                            @endforeach
                            @php
                                $discount = $product->discounts;
                            	$disc = HomeController::tampildiskon($discount);
							@endphp
							@if($disc!=0)
                            <div style="background-color:#e7ab3c;font-weight:bold; color:white;" class="product_extra product_new">Sales -{{$disc}}%</div>
							@endif
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="{{ url('login') }}"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="{{ url('login') }}">+ Quick View</a></li>
                                <li class="w-icon"><a href="{{ url('login') }}"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            @foreach($product->categories as $category)
                                <div class="catagory-name">{{$category->category_name}}</div>
                            @endforeach
                            <a href="/home/product/{{$product->slug}}">
                                <h5>{{$product->product_name}}</h5>
                            </a>
                            @php
                                    $price = $product->price;
                                    $harga = HomeController::diskon($discount, $price);
                            @endphp
                            @if ($harga != 0)	   
                                <div style="text-decoration:line-through;" class="product_price">Rp. {{number_format($product->price)}}</div>
                                <div style="font-weight:bold;color:black;" class="product_price">Rp. {{number_format($harga)}}</div>
                            @else
                                <div class="product_price">Rp. {{number_format($product->price)}}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="product-large set-bg m-large"
                    data-setbg="{{ asset('/assets-user/img/products/man-large.jpg') }}">
                    <h2>Men’s</h2>
                    <a href="{{ url('login') }}">Discover More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Man Banner Section End -->

<!-- Instagram Section Begin -->
<div class="instagram-photo">
    <div class="insta-item set-bg" data-setbg="{{ asset('/assets-user/img/insta-1.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="{{ url('login') }}">fashi_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('/assets-user/img/insta-2.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="{{ url('login') }}">fashi_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('/assets-user/img/insta-3.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="{{ url('login') }}">fashi_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('/assets-user/img/insta-4.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="{{ url('login') }}">fashi_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('/assets-user/img/insta-5.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="{{ url('login') }}">fashi_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{ asset('/assets-user/img/insta-6.jpg') }}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="{{ url('login') }}">fashi_Collection</a></h5>
        </div>
    </div>
</div>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<section class="latest-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ asset('/assets-user/img/latest-1.jpg') }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                May 4,2019
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                5
                            </div>
                        </div>
                        <a href="{{ url('login') }}">
                            <h4>The Best Street Style From London Fashion Week</h4>
                        </a>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ asset('/assets-user/img/latest-2.jpg') }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                May 4,2019
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                5
                            </div>
                        </div>
                        <a href="{{ url('login') }}">
                            <h4>Vogue's Ultimate Guide To Autumn/Winter 2019 Shoes</h4>
                        </a>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-latest-blog">
                    <img src="{{ asset('/assets-user/img/latest-3.jpg') }}" alt="">
                    <div class="latest-text">
                        <div class="tag-list">
                            <div class="tag-item">
                                <i class="fa fa-calendar-o"></i>
                                May 4,2019
                            </div>
                            <div class="tag-item">
                                <i class="fa fa-comment-o"></i>
                                5
                            </div>
                        </div>
                        <a href="{{ url('login') }}">
                            <h4>How To Brighten Your Wardrobe With A Dash Of Lime</h4>
                        </a>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="benefit-items">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{ asset('/assets-user/img/icon-1.png') }}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Free Shipping</h6>
                            <p>For all order over 99$</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{ asset('/assets-user/img/icon-2.png') }}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Delivery On Time</h6>
                            <p>If good have prolems</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{ asset('/assets-user/img/icon-1.png') }}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Secure Payment</h6>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->

<!-- Partner Logo Section Begin -->
<div class="partner-logo">
    <div class="container">
        <div class="logo-carousel owl-carousel">
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{ asset('/assets-user/img/logo-carousel/logo-1.png') }}" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{ asset('/assets-user/img/logo-carousel/logo-2.png') }}" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{ asset('/assets-user/img/logo-carousel/logo-3.png') }}" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{ asset('/assets-user/img/logo-carousel/logo-4.png') }}" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{ asset('/assets-user/img/logo-carousel/logo-4.png') }}" alt="">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Partner Logo Section End -->
@stop