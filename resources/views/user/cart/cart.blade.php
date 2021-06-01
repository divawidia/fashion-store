@extends('layout-user.index')
@section('title', 'Checkout Page')
@section('content')

<a href="#" class="single-icon"><i class="ti-bag"></i> 
    <span class="total-count">{{$count}}</span></a>
        <div class="shopping-item">
            <div class="dropdown-cart-header">
                <span>{{$count}}Items</span>
                <a href="/users/detailcart">View Cart</a>
            </div>
            <ul class="shopping-list list-cart">
            @foreach ($carts as $cart)
                @foreach ($products as $product)
                    @if($product->id == $cart->product_id)
                        <li id="{{$cart->id}}">
                        <a class="remove delete-cart" title="Remove this item"><i class="fa fa-remove"></i></a>
                        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a>
                        <h4><a href="#">{{$product->product_name}}</a></h4>
                        <p class="quantity">{{$cart->qty}}</p>
                        </li>
                    @endif
                @endforeach
            @endforeach                
            </ul>
            <div class="bottom">
                <div class="total">
                    <span>Total</span>
                    <span class="total-amount">Rp. {{$total_price}}</span>
                </div>
                <a href="/users/checkout" class="btn animate">Checkout</a>
            </div>
@endsection