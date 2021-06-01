<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\carts;
use App\Models\products;
use App\Models\product_categories;
use App\Models\Cities;
use App\Models\couriers;
use App\Models\Provinces;
use App\Models\transactions;
use App\Models\product_reviews;
use App\Models\transaction_details;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;
use \App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Str;
use File;
use App\loginUser;
use App\loginAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insertcheckout(Request $request){
        //dd($request->kota);
        $getkota = $request->kota;
        $kota = Cities::where('city_id', $getkota)->first();
        $getprovinsi = $request->provinsi;
        $provinsi = Provinces::where('province_id', $getprovinsi)->first();
        $getcourier = $request->courier;
        $courier = couriers::where('id',$getcourier)->first();
        $id_user = auth()->user()->id;
        $cart = carts::where('user_id', $id_user)->get();
        $products = products::all();
        $total_price = $this->gettotalprice();
        $service = $request->ongkir;
        $total =  $request->totharga;
        $insert = transactions::create([
            'timeout' => now()->addDays(1),
            'address' => $request->address,
            'regency' => $kota->id,
            'province' => $provinsi->id,
            'total' => $total_price + $service,
            'shipping_cost' => $service,
            'sub_total' => $total_price,
            'user_id' => $id_user,
            'courier_id' => $courier->id,
            'status' => "unverified",
            'proof_of_payment' => "Belum Dibayar"
        ]);

        $transaction = transactions::orderby('id','DESC')->get()->first();
        // notif
        $admin = admin::find(1);
        $notif = "<a class='dropdown-item' href='/admin/transaksi/detail/".$transaction->id."'>".
                "<div class='item-content flex-grow'>".
                  "<h6 class='ellipsis font-weight-normal'>".Auth::user()->name."</h6>".
                  "<p class='font-weight-light small-text text-muted mb-0'>Ada Transaksi Baru".
                  "</p>".
                "</div>".
              "</a>";
        $admin->notify(new AdminNotification($notif));
        $discount_price = $request->diskon_price;
        
        //notif
        if($insert->exists){
            //Move Cart ke Detail
            foreach ($cart as $cart) {
                foreach ($products as $product) {
                    
                    $discount = $product->discounts;
                    $price = $product->price;
                    $discount_price = HomeController::diskon($discount, $price);
                    if($cart->product_id === $product->id){
                        $oldproduct = products::find($cart->product_id);
                        $newqty = $oldproduct->stock - $cart->qty;
                        $discount = $product->discounts;
                        $price = $product->price;
                        $discount_price = HomeController::diskon($discount, $price);
                        if($newqty < 0){
                            return back()->with(['status'=>'Product out of stock','type'=>'warning']);
                        }else{
                            $cekproduct = products::where('id', $cart->product_id)->update([
                                'stock' => $newqty
                            ]);
                        }
                        $idpro = $product->id;
                        
                        if($cekproduct > 0){
                            $discount_percentage = DB::table('discounts')
                                                    ->select('products_id as p_id','percentage')
                                                    ->where('products_id',$idpro)
                                                    ->orderBy('id','desc')
                                                    ->first();
                            $discount_p = $discount_percentage->percentage;
                            //dd($discount_p);
                            //var_dump($discount_p);exit;
                            $detail_insert = transaction_details::create([
                                'transaction_id' => $insert->id,
                                'product_id' => $cart->product_id,
                                'qty' => $cart->qty,
                                'discount' => $discount_p,
                                'selling_price' => $discount_price
                            ]);
                        }
                    }
                }
            }
            //Delete Cart
            $delete_cart = carts::where('user_id', $id_user)->delete();
            if($delete_cart > 0){
                return redirect('/users/viewpayment/'.$insert->id)->with(['status'=>'Berhasil Memesan, Silahkan Upload Bukti Pembayaran dalam 24 Jam','type'=>'success']);
            }else{
                return back()->with(['status'=>'Gagal Memasukan Detail Pemesanan','type'=>'danger']);
            }
        }else{
            return back()->with(['status'=>'Gagal Memasukan Data Pemesan','type'=>'danger']);
        }
    }
    public function getOngkir(Request $request){
        $kurir = couriers::where('id','=',$request->courier)->first();
        $tujuan = $request->destination;
        $berat = $request->weight;
        $courier =  $request->courier;
        $regency = $request->prov;
         // if(is_null($request->destination)){
        //     $city = City::where('province_id','=',$request->prov)->first();
        //     $request->destination = $city->city_id;
        // }
        $cost = RajaOngkir::ongkosKirim([
            'origin' => 114,
            'destination' => 17,
            'weight' => 200,
            'courier' => 'jne',
        ])->get();

        $hasil = $cost;
        

        
        return response()->json(['success' => 'terkirim', 'hasil' => $hasil]);
    }

    public function getService(Request $request){
        $cost = RajaOngkir::ongkosKirim([
            'origin'    => 114,
            'destination' => $request->city_id,
            'weight' => $request->weight,
            'courier' => $request->courier
        ])->get();
        $msg = $cost[0]['costs'];
        return response()->json(['ongkir'=>$msg]);
    }

    public function buynow($id){
        $id_user = auth()->user()->id;
        $insert = carts::create([
        'user_id' => $id_user,
        'product_id' => $id,
        'qty' => 1
        ]);
        if($insert !== null){
            return redirect('/users/detailcart');
        }
    }

    public function getKota($id){
        $city = Cities::where('province_id','=',$id)->pluck('name','city_id');
        return json_encode($city);
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
    protected function gettotalweight(){
        $products = products::get();
        $carts = carts::where('user_id',auth()->user()->id)->get();
        $total_weight = 0;
        foreach($carts as $cart){
            foreach($products as $product){
                if($product->id === $cart->product_id){
                    $total_weight += ($product->weight * $cart->qty);
                }
            }
        }
        return $total_weight;
    }
    public function checkout(Request $request){
        $id = auth()->user()->id;
        $discount_price = $request->diskon_price;
        $total_price = $this->gettotalprice();
        $categories = product_categories::all();
        $dataprovinsi = Provinces::all();
        $datakota = Cities::all();
        $datacart = carts::where('user_id',auth()->user()->id)->get();
        $products = products::all();
        $kurir = couriers::all();
        $total_weight = $this->gettotalweight();
        return view('user.checkout.checkout',compact('datacart','products','dataprovinsi','datakota', 'id', 'total_price', 'categories','kurir', 'total_weight','discount_price'));
    }

    public function invoice($id){
        $user = auth()->user()->id;
        $transactions = transactions::where('user_id', $user)->orderby('id', 'desc')->paginate(10);
        return view('user.checkout.invoice', compact('transactions'));
    }

    public function getInvoice($id){
        $transactions = transactions::where('id', $id)->first();
        $products = DB::table('transaction_details')->join('products', 'products.id', '=', 'transaction_details.product_id')
                    ->select('transaction_details.*', 'products.weight', 'products.product_name')
                    ->where('transaction_details.transaction_id', '=', $transactions->id)->get();
        $reviews = DB::table('product_reviews')->select('product_reviews.*')->where('product_reviews.transaction_id', '=', $id)->get();
        return view('user.checkout.invoice_detail', compact('transactions', 'products', 'reviews'));
    }

    public function confirmation($id){
        $transaction = transactions::find($id);
        $transaction->status = "success";
        $transaction->save();
        return redirect()->back()->with(['notif' => "Terima Kasih Telah Berbelanja"]);
    }


    public function cancel_transaction($id){
        $transaction = transactions::find($id);
        $transaction->status = "canceled";
        $transaction->save();
        return redirect()->back()->with(['notif' => "Transaksi telah dibatalkan"]);
    }

    public function uploadPOP(Request $request, $id){
        $image = $request->proof_of_payment;
        $nama_image = time()."_".$image->getClientOriginalName();
        $folder = 'image/proof_of_payments';
        $image->move($folder,$nama_image);
        $transaction = transactions::find($id);
        $transaction->proof_of_payment = $nama_image;
        $transaction->save();

        // notif
        $admin = admin::find(1);
        $notif = "<a class='dropdown-item' href='/admin/transaksi/detail/".$transaction->id."'>".
                "<div class='item-content flex-grow'>".
                  "<h6 class='ellipsis font-weight-normal'>".Auth::user()->name."</h6>".
                  "<p class='font-weight-light small-text text-muted mb-0'>Bukti Pembayaran Telah Diupload".
                  "</p>".
                "</div>".
              "</a>";
        $admin->notify(new AdminNotification($notif));
        //notif

        return redirect()->back()->with(['notif' => "Bukti Pembayaran telah Diupload"]);
    }

    public function review(Request $request){
        $productid = $request->productid;
        $slug1 = products::select('slug')->where('id',$productid)->first();
        $slug = $slug1->slug;
        $user_id = Auth::user()->id;
        $transid= $request->transaction_id;
        $revrate = $request->rate;
        $revcontent = $request->content;

        $insert = product_reviews::create([
            'product_id' => $productid,
            'user_id' => $user_id,
            'transaction_id' => $transid,
            'rate' => $revrate,
            'content' => $revcontent,
        ]);
        $insert->save();
        
        // notif
        $admin = admin::find(1);
        $notif = "<a class='dropdown-item' href='/admin/product/".$slug."'>".
                "<div class='item-content flex-grow'>".
                  "<h6 class='ellipsis font-weight-normal'>".Auth::user()->name."</h6>".
                  "<p class='font-weight-light small-text text-muted mb-0'>Ada Review Baru".
                  "</p>".
                "</div>".
              "</a>";
        $admin->notify(new AdminNotification($notif));
        //notif
        
        $rating = DB::table('product_reviews')->where('product_reviews.product_id', '=', $productid)->avg('product_reviews.rate');
        $product = products::find($productid);
        $product->product_rate = $rating;
        $product->save();
        $transactions = transactions::where('user_id', $user_id)->orderby('id', 'desc')->paginate(10);
        return view('user.checkout.invoice', compact('transactions'));
    }

    public function reviewedit(Request $request){
        $prodid = $request->productid;
        
        $user_id = Auth::user()->id;
        #$review->transaction_id = $request->transaction_id;
        $revrate = $request->rate;
        $revcontent = $request->content;
        $revid = $request->reviewid;

        $review = product_reviews::find($revid);

        $review->product_id = $prodid;
        $review->user_id = $user_id;
        $review->content = $revcontent;
        $review->rate = $revrate;
        $review->save();
        
        $rating = DB::table('product_reviews')->where('product_reviews.product_id', '=', $prodid)->avg('product_reviews.rate');
        $product = products::find($prodid);
        $product->product_rate = $rating;
        $product->save();
        return redirect('/users/home');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = transactions::all();
        //dd($transaction);
        return view('admin.transaction.index', compact('transaction'));
    }

    public function TransactionDetail($id){
        $transaction = DB::table('transactions')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->select('transactions.*', 'users.name')
        ->where('transactions.id', '=', $id)->first();
        return view('admin.transaction.detail', compact('transaction'));
    }

    public function TransactionUpdate(Request $request, $id){
        $transaction = transactions::find($id);
        $transaction->status = $request->status;
        $transaction->save();
        $user = User::find($transaction->user_id);
        $user->notify(new UserNotification("<a href ='/users/invoice/".$transaction->id."'>Status Transaksimu dengan id ".$transaction->id." telah diupdate</a>"));
        return redirect()->back();
    }
    public function reviewpage(Request $request){

        $prodid = $request->product_id;
        $transid = $request->transaction_id;
        $prodname = $request->product_name;
        return view('user.checkout.newreview', compact('prodid', 'transid', 'prodname'));
    }

    public function revieweditpage(Request $request){

        $prodid = $request->productid;
        $prodname = $request->product_name;
        $revid = $request->reviewid;
        $review = product_reviews::find($revid);

        return view('user.checkout.editreview', compact('prodid', 'prodname', 'review'));
    }

    public function storeReview(Request $request)
    {
        
        $review = new product_reviews;
        $review->product_id = $request->product_id;
        $review->user_id = Auth::user()->id;
        $review->transaction_id = $request->transaction_id;
        $review->rate = $request->rate;
        $review->content = $request->content;
        $review->save();

        
        
        $rating = DB::table('product_reviews')->where('product_reviews.product_id', '=', $request->product_id)->avg('product_reviews.rate');
        $product = products::find($request->product_id);
        $product->product_rate = $rating;
        $product->save();
        return redirect()->back()->with(['success'=>'Review product berhasil!!']);
    }

    public function timeout(Request $request)
    {
        $id_transaksi = $request->idtransaksi;
        $transaction = transactions::find($id_transaksi);
        if($transaction == "unverified"){
            $transaction->status = "expired";
            $transaction->save(); 
        }
        
        return response()->json(['success' => 'tersimpan']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function image()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(transactions $transactions)
    {
        //
    }
}
