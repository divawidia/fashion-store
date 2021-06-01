<?php

namespace App\Http\Controllers;

use App\Models\response;
use App\Models\product_reviews;
use App\Models\products;
use Illuminate\Http\Request;

class ResponseController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.response.edit')->with('response', response::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'content' => 'required'
        ]);

        $response = response::where('id', $id)->first();
        $review_id = $response->review_id;
        $review = product_reviews::where('id', $review_id)->first();
        $product_id = $review->product_id;
        $product = products::where('id', $product_id)->first();

        response::where('id', $id)
            ->update([
            'content'=>$request->input('content')
        ]);
        
        return redirect()->action('App\Http\Controllers\ProductsController@show', [$product->slug])->with('message', 'Response successfully added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = response::where('id', $id);
        $response->delete();
        return redirect()->back()->with('message', 'Response deleted');
    }
}
