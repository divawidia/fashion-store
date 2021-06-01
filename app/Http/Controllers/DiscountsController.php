<?php

namespace App\Http\Controllers;

use App\Models\discounts;
use App\Models\products;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.discount.index')->with('discount_data', discounts::orderby('created_at', 'ASC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_data = products::all();
        return view('admin.discount.add', compact('product_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'percentage' => 'required|numeric',
            'product_id' => 'required',
            'start' => 'required|date|after:tomorrow',
            'end' => 'required|date|after:start'
        ]);

        discounts::create([
            'percentage' => $request->input('percentage'),
            'product_id' => $request->input('product_id'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
        ]);

        return redirect('/admin/discount')->with('message', 'Discount added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\discounts  $discounts
     * @return \Illuminate\Http\Response
     */
    public function show(discounts $discounts)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.discount.edit')->with('discounts', discounts::where('id', $id)->first());;
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
        $this->validate($request, [
            'percentage' => 'required|numeric',
            'start' => 'required|date|after:today',
            'end' => 'required|date|after:start'
        ]);
        $discount = discounts::where('id', $id)->first();
        $productId = $discount->products_id;
        $product = products::find($productId);
        discounts::where('id', $id)
            ->update([
                'percentage' => $request->input('percentage'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
            ]);

        return redirect()->action('App\Http\Controllers\ProductsController@show', [$product->slug])->with('message', 'Discount edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = discounts::find($id);
        $discount->delete();
        return redirect()->back()->with('message', 'Discount deleted successfully');
    }
}
