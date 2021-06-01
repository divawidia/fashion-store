<?php

namespace App\Http\Controllers;

use App\Models\couriers;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CouriersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.courier.index')->with('courier_data', couriers::orderby('created_at', 'ASC')->get());;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courier.add');
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
            'courier' => ['required', 'alpha']
        ]);

        $slug = SlugService::createSlug(couriers::class, 'slug', $request->courier);

        couriers::create([
            'courier' => $request->input('courier'),
            'slug' => $slug
        ]);

        return redirect('/admin/courier')->with('message', 'Courier added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\couriers  $couriers
     * @return \Illuminate\Http\Response
     */
    public function show(couriers $couriers)
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
        return view('admin.courier.edit')->with('courier', couriers::where('slug', $slug)->first());
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
            'courier' => ['required', 'alpha']
        ]);

        couriers::where('slug', $slug)
            ->update([
                'courier' => $request->input('courier'),
                'slug' => SlugService::createSlug(couriers::class, 'slug', $request->courier)
            ]);

        return redirect('/admin/courier')->with('message', 'Courier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $couriers = couriers::find($id);
        $couriers->delete();
        return redirect('/admin/courier')->with('message', 'Courier deleted successfully');
    }
}
