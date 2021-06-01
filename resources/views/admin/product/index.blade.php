@extends('layout-admin.index')
@section('title', 'Product')
@section('content')
<style>
    .icon-white {
        color: white;
      }
</style>
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Product</strong></h3>
        </div>
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('message')}}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" onclick="location.href='{{ url('/admin/product/create') }}'" data-toggle="tooltip" data-placement="bottom" title="Add Product"><i class="fas fa-plus"></i> Add Product</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%;">ID</th>
                            <th style="width:30%;">Product Name</th>
                            <th style="width:20%;">Price</th>
                            <th style="width:20%;">Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($product_data as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{"Rp. "}}{{$product->price}}</td>
                             <!-- <td>
                                <a href="/product/{{$product->slug}}/image" class="btn btn-secondary btn-sm">
                                    See Image
                                </a>
                            </td>
                            <td>@foreach($product->images as $image)
                                <img src="/product-images/{{$image->image_name}}" class="img-thumbnail">
                                @endforeach
                            </td> -->
                            <td>@foreach($product->categories as $category)
                                    <li>{{$category->category_name}}</li>
                                @endforeach
                            </td>
                            <td class="table-action">
                                <a class="btn btn-info" href="/admin/product/{{ $product->slug }}" role="button" data-toggle="tooltip" data-placement="bottom" title="See Product Detail"><i class="align-middle icon-white" data-feather="eye"></i></a>
                                <a class="btn btn-primary" href="/admin/product/{{ $product->slug }}/edit" role="button" data-toggle="tooltip" data-placement="bottom" title="Edit Product" onclick="return confirm('Are you sure you want to edit this product?')"><i class="align-middle icon-white" data-feather="edit-2"></i></a>
                                <a class="btn btn-danger" href="/admin/product/{{ $product->id }}/delete" role="button" data-toggle="tooltip" data-placement="bottom" title="Delete Product" onclick="return confirm('Are you sure you want to delete this product?')"><i class="align-middle icon-white" data-feather="trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
