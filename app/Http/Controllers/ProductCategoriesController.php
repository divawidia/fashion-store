<?php

namespace App\Http\Controllers;

use App\Models\product_categories;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index')->with('category_data', product_categories::orderby('created_at', 'ASC')->get());;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
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
            'category_name' => ['required', 'alpha']
        ]);

        $slug = SlugService::createSlug(product_categories::class, 'slug', $request->category_name);

        product_categories::create([
            'category_name' => $request->input('category_name'),
            'slug' => $slug
        ]);

        return redirect('/admin/category')->with('message', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product_categories  $product_categories
     * @return \Illuminate\Http\Response
     */
    public function show(product_categories $product_categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('admin.category.edit')->with('category', product_categories::where('slug', $slug)->first());
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
            'category_name' => ['required', 'alpha']
        ]);

        product_categories::where('slug', $slug)
            ->update([
                'category_name' => $request->input('category_name'),
                'slug' => SlugService::createSlug(product_categories::class, 'slug', $request->category_name)
            ]);

        return redirect('/admin/category')->with('message', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function destroy($id)
    {
        $category = product_categories::find($id);
        $category->delete();
        return redirect('/admin/category')->with('message', 'Category deleted successfully');
    }
}
