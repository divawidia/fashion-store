<?php

namespace App\Http\Controllers;

use App\Models\discounts;
use App\Models\products;
use App\Models\product_categories;
use App\Models\product_images;
use App\Models\User;
use App\Models\user_notifications;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        return view('user.index');
    }

    public function shop()
    {
        $products = products::all();
        $discounts = discounts::all();
        $images = product_images::all();
        $categories = product_categories::all();
        return view('user.shop.index', compact('products','discounts','images','categories'));
    }

    public function contact()
    {
        return view('user.contact.index');
    }

    public function cart()
    {
        return view('user.cart.index');
    }

    public function checkout()
    {
        return view('user.checkout.index');
    }

    public function markReadUser(){
        $user = User::find(1);
        $user->unreadNotifications()->update(['read_at' => now()]);
        return redirect()->back();
    }

    public function showAllNotif(){
        $user = user::find(1);
        return view('user.allNotif', compact(['user']));
    }

    public function userSpesificNotif(Request $request)
    {
        $id = $request->notifId;
        $url = $request->url;
        $notif = user_notifications::find($id);
        $notif->update(['read_at' => now()]);
        //dd($url);
        return redirect()->to($url);
    }
}
