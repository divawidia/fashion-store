@extends('layout-user.index')
@section('title', 'Checkout Page')
@section('content')
@php
    use \App\Http\Controllers\HomeController;
    $total_harga = 0;
@endphp

<style>
    .container{
        font-size:15px;
    }
    .col-2{
        font-size:15px;
    }

    .col-3{
        font-size:15px;
    }

    .btn {
        font-size:15px;
        margin-left:-2px;
        margin-top:30px;
    }
</style>
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <!-- <li><a href="index.php">Home</a></li>
                        <li class="active"><a href="/users/checkout">Checkout</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3 mb-5">
        <table class="my-3 table shopping-summery">
            <thead>
                <tr class="d-flex">
                    <th class="col-2">Product Name</th>
                    <th class="col-2">QTY</th>
                    <th class="col-3">Price</th>
                    <th class="col-3">Total</th>
                    <th class="col-2">Setting</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datacart as $cart)
                <tr id="cart-{{$cart->id}}" class="d-flex text-center">
                    <td class="col-2">
                    @foreach($products as $product)
                        @if($product->id == $cart->product_id) {{$product->product_name}} @endif
                        @endforeach
                    </td>
                    <td class="col-2" id="{{$cart->id}}">
                        <button class="btn px-2 py-1 m-1 qty-dec">-</button>
                        <span class="qtyprd">{{$cart->qty}}</span>
                        <button class="btn px-2 py-1 m-1 qty-inc">+</button>
                    </td>
                    <td class="col-3 price-prd">
                    @foreach($products as $product)
                        @if($product->id == $cart->product_id) 
                            @php
                                $discount = $product->discounts;
                                $price = $product->price;
                                $harga_diskon = HomeController::diskon($discount, $price);
                            @endphp
                            @if ($harga_diskon != 0)
                                <div class="details_discount" style="text-decoration:line-through;">Rp.{{number_format($product->price)}}</div>
                                <div class="details_price" style="font-weight:bold;color:black;">Rp.{{number_format($harga_diskon)}}</div>
                            @else
                                <div class="details_price" style="font-weight:bold;color:black;">Rp.{{number_format($product->price)}}</div>
                            @endif
                        @endif
                        @endforeach
                    </td>
                    <td class="col-3 total-prd">
                    @foreach($products as $product)
                        @if($product->id == $cart->product_id) 
                            @if ($harga_diskon != 0)
                                Rp.{{number_format($harga_diskon * $cart->qty)}}
                            @else
                                Rp.{{number_format($product->price * $cart->qty)}}
                            @endif
                        @endif
                    @endforeach
                    </td>
                    <td class="col-2" data-id="{{$cart->id}}">
                        <button class="btn px-2 py-1 m-1 btn-remove-prd"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="col-12 ml-auto mr-0">
            <span class="total-amount">Total = Rp. {{number_format($total_price)}}</span>
            <form action="/users/checkout" method="POST">
                @csrf
                <input type="hidden" name="diskon_price" value="{{$harga_diskon}}">
                <button class="btn btn-success" type="submit">
                    Check Out
                </button>
            </form>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
@endsection