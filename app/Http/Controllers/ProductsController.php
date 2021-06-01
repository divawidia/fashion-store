<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\product_images;
use App\Models\product_categories;
use App\Models\discounts;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index')->with('product_data', products::orderby('created_at', 'ASC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = product_categories::all();
        return view('admin.product.add', compact('categories'));
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
            'product_name' => ['required'],
            'price' => ['required', 'numeric', 'gte:1000'],
            'description' => ['required'],
            'category' => ['required'],
            'stock' => ['required', 'gte:1'],
            'weight' => ['required', 'gte:100'],
            'imageFile' => ['required'],
            'imageFile.*' => ['mimes:jpg,png,jpeg', 'max:2048']
        ]);
        /*
        $product = new \App\Product;
        $product->product_name = $request->product_name;
        $product->price= $request->price;
        $product->description= $request->description;
        $product->product_rate= $request->product_rate;
        $product->stock= $request->stock;
        $product->weight= $request->weight;
        $product->deleted_at=null;
        $product->save();

        $product = DB::table('products')->where('product_name','=', $request->product_name)->first();
        return redirect('/product')->with('success','Product added successfully:)');

        
        $request->validate([
            'product_name'=> 'required',
            'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'description'=>'required',
            'product_rate'=>'required|max:1',
            'stock'=>'required',
            'weight'=>'required',
            'product_mage' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);
        
        if($request->hasFile('product_images')){
            $product = new App\Models\products;
            $product->product_name = $request->product_name;
            $product->price= $request->price;
            $product->description= $request->description;
            $product->product_rate= $request->product_rate;
            $product->stock= $request->stock;
            $product->weight= $request->weight;
            $product->deleted_at=null;
            $product->save();

            $product = DB::table('products')->where('product_name','=', $request->product_name)->first();
            foreach($request->file('product_images') as $file){
                $name = time().'_.'.$file->extension();
                $file->move(public_path('images'), $name);
                $product_image = new App\Models\product_images;
                $product_image->product_id = $product->id;
                $product_image->image_name=$name;
                $product_image->save();
            }
            return redirect('/product')->with('success','Product added successfully:)');
        }
        return redirect()->back()-withInput($request->only('product_name','price','description','product_rate','stock','weight'))->with('success','periksa lagi, TOlong)');
        */
        $slug = SlugService::createSlug(products::class, 'slug', $request->product_name);

        if ($request->hasFile('imageFile')) {
            $product = new products;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->slug = $slug;
            $product->deleted_at = null;
            $product->save();
            $product->categories()->attach($request->category);

            foreach ($request->file('imageFile') as $image) {
                $productImage = new product_images;
                $name = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('product-images'), $name);
                $productImage->products_id = $product->id;
                $productImage->image_name = $name;
                $productImage->save();
            }
            return redirect('/admin/product')->with('message', 'Product added successfully');
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $productsZ
     * @param  string $slug
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('admin.product.productdetail')->with('product', products::where('slug', $slug)->first());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = product_categories::all();
        return view('admin.product.edit', compact('categories'))->with('product', products::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'product_name' => ['required'],
            'price' => ['required', 'numeric', 'gte:1000'],
            'description' => ['required'],
            'category' => ['required'],
            'stock' => ['required', 'numeric', 'gte:1'],
            'weight' => ['required', 'numeric', 'gte:100'],
        ]);

        $product = products::where('slug', $slug)->first();

        $product_data = [
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'slug' => Str::slug($request->product_name)
            //'slug'=>SlugService::createSlug(products::class, 'slug', $request->product_name)
        ];

        $product->categories()->sync($request->category);
        $product->update($product_data);

        return redirect()->action('App\Http\Controllers\ProductsController@show', [$product->slug])->with('message', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete($id)
    {
        $product = products::find($id);
        $product->delete();
        return redirect('/admin/product')->with('message', 'Product deleted successfully');
    }

    public function image($slug)
    {
        /*$products = products::find($slug);
        $where = array('products.id' => $id);
        $images= DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.products_id')
            ->select('product_images.*')
            ->where($where)
            ->get();*/
        return view('admin.product.image')->with('product', products::where('slug', $slug)->first());;
    }

    public function upload($slug)
    {
        return view('admin.product.addImage')->with('product', products::where('slug', $slug)->first());
    }

    public function upload_image(Request $request, $slug)
    {

        $this->validate($request, [
            'imageFile' => ['required'],
            'imageFile.*' => ['mimes:jpg,png,jpeg', 'max:2048']
        ]);
        $product = products::where('slug', $slug)->first();
        /*$files = [];
        if($request->hasFile('imageFile')) {
            foreach ($request->file('imageFile') as $image) {
                $name = time().'-'.$image->getClientOriginalName();
                $image->move(public_path('product-images'), $name);
                $files[] = [
                    'products_id' => $product->id,
                    'image_name' => $name,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ];
            }
        }*/
        if ($request->hasFile('imageFile')) {
            foreach ($request->file('imageFile') as $image) {
                $productImage = new product_images;
                $name = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('product-images'), $name);
                $productImage->products_id = $product->id;
                $productImage->image_name = $name;
                $productImage->save();
            }
            return redirect()->action('App\Http\Controllers\ProductsController@show', [$product->slug])->with('message', 'Product image added successfully');
        }
    }

    public function discount($slug)
    {
        return view('admin.discount.add')->with('product', products::where('slug', $slug)->first());
    }

    public function createDiscount(Request $request, $slug)
    {
        $this->validate($request, [
            'percentage' => 'required|numeric',
            'start' => 'required|date|after:today',
            'end' => 'required|date|after:start'
        ]);

        $product = products::where('slug', $slug)->first();

        $discount = new discounts;
        $discount->products_id = $product->id;
        $discount->percentage = $request->percentage;
        $discount->start = $request->start;
        $discount->end = $request->end;
        $discount->save();

        return redirect()->action('App\Http\Controllers\ProductsController@show', [$product->slug])->with('message', 'Discount added successfully');
    }

    public function editDiscount($slug)
    {
        return view('admin.discount.edit')->with('product', products::where('slug', $slug)->first());
    }

    public function updateDiscount(Request $request, $slug)
    {
        $this->validate($request, [
            'percentage' => 'required|numeric',
            'start' => 'required|date|after:today',
            'end' => 'required|date|after:start'
        ]);
        $product = products::where('slug', $slug)->first();
        $id = $product->id;
        discounts::where('id', $id)
            ->update([
                'percentage' => $request->input('percentage'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
            ]);
        return redirect('/product')->with('message', 'Discount updated successfully');
    }

    public function deleteDiscount($slug)
    {
        $product = products::where('slug', $slug)->first();
        $id = $product->id;
        $discount = discounts::find($id);
        if ($discount != null) {
            $discount->delete();
            return redirect()->back()->with('message', 'Discount deleted successfully');
        }
        return redirect()->back()->with('message', 'Wrong ID!');
    }

    // public function createResponse($id){
    //     return view('admin.response.add')
    // }



}
