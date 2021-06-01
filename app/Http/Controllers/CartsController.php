<?php

namespace App\Http\Controllers;

use App\Models\carts;
use App\Models\products;
use App\Models\product_categories;
use \App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function addcart($id){
        $cart = carts::where('user_id', auth()->user()->id)->get();
        $dataproduct = products::find($id);
        $check = count($cart);

        foreach($cart as $checkcart){
            if($checkcart->product_id == $id){
                $qty = $checkcart->qty;
                $update = carts::where('product_id',$id)->update(['qty' => $qty + 1,]);
                if($update > 0){
                    $data_html = $this->getupdatedcart();
                    return $this->getupdatedcart();
                }
            }else{
                if($check > 0){
                    $check -= 1;
                }else{
                    break;
                }
            }
        }
        if($check == 0){
            $insert = carts::create([
                'user_id' => auth()->user()->id,
                'product_id' => $dataproduct->id,
                'qty' => 1,
                'status' => 'notyet'
            ]);
            $data_html = $this->getupdatedcart();
            return $this->getupdatedcart();
        }
    }
    public function deletecart($id){
        $cart = Carts::find($id);
        if($cart->exists){
            Carts::where('id',$id)->delete();
            // return redirect()->back();
            $total = $this->gettotalprice();
            return response()->json(['success' => $total]);
        }else{
            return response()->json("fail");
        }
    }

    public function detailcart(){
        
        $products = products::get();
        $datacart = carts::where('user_id', auth()->user()->id)->get();
        $total_price = 0;
        $categories = product_categories::all();
        foreach($datacart as $cart){
            foreach($products as $product){
                $discount = $product->discounts;
                $price = $product->price;
                $discount_price = HomeController::diskon($discount, $price);
                if($product->id === $cart->product_id){
                    if ($discount_price != 0){
                        $total_price += ($discount_price * $cart->qty);
                    }
                    else{
                        $total_price += ($product->price * $cart->qty);
                    }
                }
            }
        }
        return view('user.cart.detail_cart',compact('products','datacart', 'total_price', 'categories'));
    }

    public function updatedetailcart($id, Request $request){
        $iduser = auth()->user()->id;
        $qty = $request->qty;
        $update = carts::where([
            'user_id' => $iduser,
            'id' => $id
        ])->update([
            'qty' => $qty
        ]);
        if($update > 0){
            $total = $this->gettotalprice();
            return response()->json(['success' => $total]);
        }else{
            return response()->json('failed');
        }
    }

    protected function gettotalprice(){
        $products = products::get();
        $carts = carts::where('user_id',auth()->user()->id)->get();
        $total_price = 0;
        foreach($carts as $cart){
            foreach($products as $product){
                $discount = $product->discounts;
                $price = $product->price;
                $discount_price = HomeController::diskon($discount, $price);
                if($product->id === $cart->product_id){
                    if ($discount_price != 0){
                        $total_price += ($discount_price * $cart->qty);
                    }
                    else{
                        $total_price += ($product->price * $cart->qty);
                    }
                }
            }
        }
        return $total_price;
    }

    protected function getupdatedcart(){

        $products = products::all();
        $carts = carts::where('user_id', auth()->user()->id);
        $count = count(array($carts));
        $total_price = $this->gettotalprice();
        
        return view('user.cart.cart', compact('products','carts','count','total_price'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function show(carts $carts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function edit(carts $carts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, carts $carts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy(carts $carts)
    {
        //
    }
}
