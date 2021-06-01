<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\product_images;
use App\Models\product_categories;
use App\Models\discounts;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = products::all();
        // $discounts = discounts::all();
        // $images = product_images::all();
        // $categories = product_categories::all();
        $categories = product_categories::with('product')->get();
        $products = products::with('images', 'categories', 'discounts')->get();
        return view('user.index', ['products' => $products, 'categories' => $categories]);
        //return view('user.index', compact('products','discounts','images','categories'));
    }

    public static function diskon($discount, $price)
    {
        if ($discount->count()) {
            $dsk = $discount->sortByDesc('id');
            foreach ($dsk as $d) {
                $persen = $d;
                break;
            }

            if ($persen->end >= date('Y-m-d')) {
                return $price = $price - ($price * $persen->percentage / 100);
            } else {
                return $price = 0;
            }
        } else {
            return $price = 0;
        }
    }
    public static function tampildiskon($discount)
    {
        if ($discount->count()) {
            $dsk = $discount->sortByDesc('id');
            foreach ($dsk as $d) {
                $persen = $d;
                break;
            }
            if ($persen->end >= date('Y-m-d')) {
                return $disc = $persen->percentage;
            } else {
                return $disc = 0;
            }
        } else {
            return $disc = 0;
        }
    }

    public function shop()
    {
        $products = products::all();
        $discounts = discounts::all();
        $images = product_images::all();
        $categories = product_categories::all();
        return view('user.shop.index', compact('products', 'discounts', 'images', 'categories'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = products::with('images', 'categories', 'discounts')
            ->where('slug', '=', $slug)->first();

        return view('user.productdetail', ['products' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
