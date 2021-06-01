<?php

namespace App\Http\Controllers;

use App\Models\product_reviews;
use App\Models\response;
use App\Models\products;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;

class ProductReviewsController extends Controller
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
     * @param  \App\Models\product_reviews  $product_reviews
     * @return \Illuminate\Http\Response
     */
    public function show(product_reviews $product_reviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product_reviews  $product_reviews
     * @return \Illuminate\Http\Response
     */
    public function edit(product_reviews $product_reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product_reviews  $product_reviews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product_reviews $product_reviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product_reviews  $product_reviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(product_reviews $product_reviews)
    {
        //
    }
    public function response(Request $request, $id){
        $userid = $request->user_id;
        return view('admin.response.add',compact('userid'))->with('review', product_reviews::where('id', $id)->first());
    }

    public function addResponse(Request $request, $id){
        $this->validate($request,[
            'content' => 'required'
        ]);

        $review = product_reviews::where('id', $id)->first();
        $product_id = $review->product_id;
        $product = products::where('id', $product_id)->first();
        

        $response = new response;
        $response->review_id = $review->id;
        $response->admin_id = auth()->user()->id;
        $response->content = $request->content;
        $response->save();
        
        $userid = $request->userid;
        $slug = products::select('slug')->where('id',$product_id)->first();
        $slugid = $slug->slug;
        $user = User::find($userid);
        $user->notify(new UserNotification("<a href ='/users/home/product/".$slugid."'>Review pada product id ".$slugid." telah dibalas</a>"));

        return redirect()->action('App\Http\Controllers\ProductsController@show', [$product->slug])->with('message', 'Response successfully added');
    }

}
