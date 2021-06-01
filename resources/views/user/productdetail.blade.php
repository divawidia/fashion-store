@extends('layout-user.index')
@section('title', 'Home')
@section('content')
<style>
    .icon-blue {
        color: blue;
      }
</style>
@php
    use \App\Http\Controllers\HomeController;
@endphp
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="product_details">
                    <div class="container">
                        <div class="row details_row">

                            <!-- Product Image -->
                            <div class="col-lg-6">
                                <div class="details_image">
                                    @foreach ($products->images as $image)
                                        @if($loop->iteration == 1)
                                            <div class="details_image_large"><img src="/product-images/{{$image->image_name}}" alt="">
                                            </div>
                                            <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                                        @else
                                            <div class="details_image_thumbnail active" data-image="/product-images/{{$image->image_name}}"><img src="/product-images/{{$image->image_name}}" alt=""></div>
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Product Content -->
                            <div class="col-lg-6">
                                <div class="details_content">
                                    @php
                                        $discount = $products->discounts;
                                        $disc = HomeController::tampildiskon($discount);
                                    @endphp
                                    @if($disc!=0)
                                        <div style="background-color:red;font-weight:bold; color:white; width:120px; padding:5px 5px; margin-bottom:5px;">Sales -{{$disc}}%</div>
                                    @endif
                                    <div class="details_name" style="font-weight:bold;color:black; font-size: 30px;" >{{$products->product_name}}</div>
                                    @php
                                        $price = $products->price;
                                        $harga = HomeController::diskon($discount, $price);
                                    @endphp
                                    @if ($harga != 0)
                                        <div class="details_discount" style="text-decoration:line-through;">Rp.{{number_format($products->price)}}</div>
                                        <div class="details_price" style="font-weight:bold;color:black;">Rp.{{number_format($harga)}}</div>
                                    @else
                                        <div class="details_price" style="font-weight:bold;color:black;">Rp.{{number_format($products->price)}}</div>
                                    @endif
                                    <!-- In Stock -->
                                    <div class="in_stock_container">
                                        <div class="availability">Availability:</div>
                                        @if ($products->stock <= 0)
                                            <span style="color:red;">Out of Stock!</span>
                                        @else
                                            @if ($products->stock <= 5) 
                                                <span style="color:red;">Hurry Up!</span>
                                                <p style="color:black;">Only {{$products->stock}} left!</p>
                                            @else
                                                <span>In Stock</span>
                                                <p style="color:black;">{{$products->stock}} left</p>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="details_text">
                                        <p>{{$products->description}}</p>
                                    </div>
                                    <!-- Product Quantity -->
                                    <div class="product_quantity_container">
                                        @if (is_null(Auth::user()))
                                            @if ($products->stock<1)
                                                <li class="quick-view"><a href="/users/buynow/{{ $products->id }}"><i class="icon_">Purchase</a></li>
                                                <li class="quick-view"><a href="/users/addcart/{{ $products->id }} "><i class="icon_">Add to cart</i></a></li>
                                            @else
                                                <li class="quick-view"><a href="/users/buynow/{{ $products->id }}"><i class="icon_">Purchase</a></li>
                                                <li class="quick-view"><a href="/users/addcart/{{ $products->id }} "><i class="icon_">Add to cart</i></a></li>
                                            @endif
                                        @else
                                            @if ($products->stock<1)
                                                <li class="quick-view"><a href="/users/buynow/{{ $products->id }}"><i class="icon_">Purchase</a></li>
                                                <li class="quick-view"><a href="/users/addcart/{{ $products->id }} "><i class="icon_">Add to cart</i></a></li>
                                            @else
                                            <table>
                                            <td>
                                            
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$products->id}}" id="product_id">
                                                @if ($harga != 0)
                                                    <input type="hidden" name="subtotal" id="subtotal" value="{{$harga}}">
                                                @else
                                                    <input type="hidden" name="subtotal" id="subtotal" value="{{$products->price}}">
                                                @endif
                                                <input type="hidden" name="weight" value="{{$products->weight}}">
                                                <input type="hidden" name="qty" class="qty" value="1" readonly>
                                                <li class="btn btn-primary btn-success"><a href="/users/buynow/{{ $products->id }}" style="text-decoration:none;color:white;">Purchase</a></li>
                                            
                                            </td>
                                            <td>
                                                    <input type="hidden" value="{{$products->id}}" id="product_id">
                                                    <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                                                    <li class="btn btn-primary btn-warning"><a href="/users/addcart/{{ $products->id }}" style="text-decoration:none;color:white;">Add to cart</i></a></li>
                                            </td>
                                            </table>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Reviews -->
			            <section id="reviews" class="pb-5 mt-4">

                            <hr>

                            <h4 class="h4-responsive dark-grey-text font-weight-bold my-5 text-center">

                            <strong>Product Reviews</strong>

                            </h4>

                            <hr class="mb-5">

                            <!-- Main wrapper -->
                            <div class="comments-list text-center text-md-left">
                            @if (!$products->review->count())
                                <div class="d-flex justify-content-center">    
                                <div class="row mb-5">
                                    <p><strong>Belum ada review produk.</strong></p> 
                                </div>
                                </div>
                            @else
                                @foreach ($products->review as $item)
                                <!-- First row -->
                                <div class="row mb-5">
                                    
                                    <!-- Image column -->
                                    <div class="col-sm-2 col-12 mb-3">
                                    
                                    <img src="{{asset('/uploads/avatars/avatar1.png')}}" alt="sample image" class="avatar rounded-circle z-depth-1-half">

                                    </div>
                                    <!-- Image column -->

                                    <!-- Content column -->
                                    <div class="col-sm-10 col-12">

                                    <a>
                                        {{-- @php
                                            dd(Auth::user()->id);
                                        @endphp --}}
                                        <h5 style="color:#333333" class="user-name font-weight-bold">{{$item->user->name}} 
                                        </h5>

                                    </a>

                                    <!-- Rating -->
                                    <ul class="rating">
                                        @for ($i = 0; $i < $item->rate; $i++) 
                                        
                                            <li>
                                                <i class="fas fa-star blue-text"></i>
                                            </li>
                                        
                                        @endfor
                                        @if($item->rate < 5)
                                            @for ($i = 0; $i < 5 - $item->rate; $i++)
                                            <li>
                                                <i class="fa fa-star grey-text"></i>
                                            </li>
                                            @endfor
                                        @endif
                                    </ul>
                                    <input type="hidden" class="rate{{$loop->iteration-1}}" value="{{$item->rate}}">
                                    <input type="hidden" class="content{{$loop->iteration-1}}" value="{{$item->content}}">
                                    <input type="hidden" class="review_id{{$loop->iteration-1}}" value="{{$item->id}}">
                                    <div class="card-data">
                                        <ul class="list-unstyled mb-1">
                                        <li class="comment-date font-small grey-text">
                                            <i class="fa fa-clock-o"></i> {{$item->created_at}}</li>
                                        </ul>
                                    </div>

                                    <p class="dark-grey-text article">{{$item->content}}</p>

                                    </div>
                                    @if($item->user_id == auth()->user()->id)
                                    <form method="post" action="/users/editreview">
                                        @csrf
                                        <input type="hidden" name="product_name" value="{{$products->product_name}}" readonly="" class="form-control">
                                        <input type="hidden" name="productid" value="{{$products->id}}">
                                        <input type="hidden" name="reviewid" class="review_id{{$loop->iteration-1}}" value="{{$item->id}}">

                                        <button type="submit" class="btn btn-primary btn-lg" >Edit Review Barang</button>
                                    </form>
                                    @endif     
                                    <!-- Content column -->

                                </div>
                                <!-- First row -->
                                    @if ($item->response->count())
                                        <!-- Balasan -->
                                        @foreach ($item->response as $balasan)
                                        <div class="row mb-5" style="margin-left: 5%">
                                        
                                        <!-- Image column -->
                                        <div class="col-sm-2 col-12 mb-3">

                                            <img src="{{asset('/uploads/avatars/avatar1.png')}}" alt="sample image" class="avatar rounded-circle z-depth-1-half">

                                        </div>
                                        <!-- Image column -->

                                        <!-- Content column -->
                                        <div class="col-sm-10 col-12">

                                            <a>

                                            <h5 style="color: #333333" class="user-name font-weight-bold"><span style="margin-right:5px;" class="badge success-color">Admin</span>{{$balasan->admin->name}}</h5>

                                            </a>
                                            <!-- Rating -->
                                            <div class="card-data">
                                            <ul class="list-unstyled mb-1">
                                                <li class="comment-date font-small grey-text">
                                                <i class="fa fa-clock-o"></i> {{$balasan->created_at}}</li>
                                            </ul>
                                            </div>

                                            <p class="dark-grey-text article">{{$balasan->content}}</p>

                                        </div>
                                        <!-- Content column -->

                                        </div>

                                        @endforeach
                                        <!-- Balasan -->

                                    @endif

                                @endforeach

                            @endif

                            </div>
                            <!-- Main wrapper -->

                        </section>
                        <!-- Product Reviews -->
                        
                    </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->
<script>
    jQuery(document).ready(function(e){
        jQuery('#ajaxSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{url('/tambah_cart')}}",
                method: 'post',
                data: {
                    product_id: jQuery('#product_id').val(),
                    user_id: jQuery('#user_id').val(),
                },
                success: function(result){
                    jQuery('#jumlahcart').text(result.jumlah);
                }
            });
        });

        jQuery('.tombol1').click(function(e){
                e.preventDefault();
                alert('Silakan login terlebih dahulu!');
                window.location = "{{url('/login')}}"
        });
    });
</script>
@stop