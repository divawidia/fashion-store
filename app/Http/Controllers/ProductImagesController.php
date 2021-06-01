<?php

namespace App\Http\Controllers;

use App\Models\product_images;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
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
     * @param  \App\Models\product_images  $product_images
     * @return \Illuminate\Http\Response
     */
    public function show(product_images $product_images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product_images  $product_images
     * @return \Illuminate\Http\Response
     */
    public function edit(product_images $product_images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product_images  $product_images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product_images $product_images)
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
        $image = product_images::where('id', $id)->first();
        unlink("product-images/".$image->image_name);
        product_images::where('id', $id)->delete();
        return redirect()
        ->back()
        ->with('message','Product Image Deleted Successfully'); 
    }
}
