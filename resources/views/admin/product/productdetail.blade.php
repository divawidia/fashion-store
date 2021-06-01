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
            <h3><strong>{{$product->product_name}}</strong></h3>
        </div>
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('message')}}
        </div>
    @endif
    <h1 class="card-title"><strong>Product Image</strong></h1>
    <div class="card">
        <div class="card-header">
            <a class="btn btn-success" href="/admin/product/{{ $product->slug }}/add-image" data-toggle="tooltip" data-placement="bottom" title="Add Image">
                <i class="fas fa-plus"></i>
                Add Image
            </a>
        </div>
        <table class="table table-striped">
            <tbody>
                    <div class="row">
                        @forelse($product->images as $image)
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <img class="img-fluid-left img-thumbnail" src="/product-images/{{$image->image_name}}" alt="light">
                                <form method="POST" action="{{ route('product-image.destroy', $image->id) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="wrapper cemter">
                                        <button type="submit" class="btn btn-danger"data-toggle="tooltip" data-placement="bottom" title="Delete Image" onclick="return confirm('Are you sure you want to delete this image?')">
                                            <i class="align-middle" data-feather="trash"></i>
                                            Delete Image
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @empty
                            <h6 class="text-center">No Image Upploaded</h6>
                        @endforelse
                    </div>
            </tbody>
        </table>
    </div>
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="/admin/product/{{ $product->slug }}/edit" role="button" data-toggle="tooltip" data-placement="bottom" title="Edit Product" onclick="return confirm('Are you sure you want to edit this product?')">
                <i class="align-middle icon-white" data-feather="edit-2"></i>
                Edit Product
            </a>
        </div>
        <div class="table">
            <table class="table table-striped table-bordered center">
                <tbody>
                    <tr>
                        <th style="width:25%;">Product Name</th>
                        <td>{{ $product->product_name }}</td>
                    </tr>
                    <tr>
                        <th>Product Rate</th>
                        <td>{{ $product->product_rate }}</td>
                    </tr>
                    <tr>
                        <th>Stock</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th>Berat</th>
                        <td>{{ $product->weight }}{{"g"}}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>{{"Rp. "}}{{$product->price}}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>
                            @foreach($product->categories as $category)
                                <li>{{ $category->category_name }}</li>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <h1 class="card-title"><strong>Product Discount</strong></h1>
    <div class="card">
        <div class="table">
            <table class="table table-striped table-bordered center">
                <tbody>
                @forelse($product->discounts as $discount)
                    <tr>
                        <th style="width:25%;">Discount Precentage</th>
                        <td>{{ $discount->percentage }}{{"%"}}</td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td>{{ $discount->start }}</td>
                    </tr>
                    <tr>
                        <th>End Date</th>
                        <td>{{ $discount->end }}</td>
                    </tr>
                    <tr>
                        <th>Action</th>
                        <td>
                            <a class="btn btn-primary" href="/admin/discount/{{ $discount->id }}/edit" role="button" data-toggle="tooltip" data-placement="bottom" title="Edit Discount" onclick="return confirm('Are you sure you want to edit this discount?')">
                                <i class="align-middle icon-white" data-feather="edit-2"></i>
                            </a>
                            <form action="{{ route('discount.destroy', $discount->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete Discount" onclick="return confirm('Are you sure you want to delete this discount?')">
                                    <i class="align-middle" data-feather="trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <div class="col text-center">
                            <h6 class="text-center">No Discount Added</h6>
                            <button class="btn btn-success" onclick="location.href='/admin/product/{{ $product->slug }}/add-discount'" data-toggle="tooltip" data-placement="bottom" title="Add Product">
                                <i class="fas fa-plus"></i>
                                Add Discount
                            </button>
                        </div>
                        
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <h1 class="card-title"><strong>Product Review</strong></h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%;">No</th>
                            <th style="width:15%;">ID User</th>
                            <th style="width:5%;">Rate</th>
                            <th style="width:40%;">Review</th>
                            <th style="width:40%;">Responses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->review as $review)
						<tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $review->user_id }}</td>
                            <td>{{ $review->rate }}</td>
                            <td>{{ $review->content }}</td>
                            <td>
                                @if(isset($review->response1['content']))
                                    {{ $review->response1['content'] }}
                                    <!-- <form action=""> -->
                                    <a class="btn btn-primary" href="/admin/response/{{ $review->response1->id }}/edit" role="button" data-toggle="tooltip" data-placement="bottom" title="Edit Response" onclick="return confirm('Are you sure you want to edit this response?')"><i class="align-middle icon-white" data-feather="edit-2"></i></a>
                                    <a class="btn btn-danger" href="/admin/response/{{ $review->response1->id }}/delete" role="button" data-toggle="tooltip" data-placement="bottom" title="Edit Response" onclick="return confirm('Are you sure you want to delete this response?')"><i class="align-middle icon-white" data-feather="trash"></i></a>
                                    <button class="btn btn-success" onclick="location.href='/admin/review/{{ $review->id }}/add-response'" data-toggle="tooltip" data-placement="bottom" title="Add Response" disabled>
                                        <i class="align-middle icon-white" data-feather="edit"></i>
                                    </button>
                                @else
                                <form action="/admin/review/{{ $review->id }}/add-responses" method="POST">
                                @csrf
                                    <input name="user_id" type="hidden" value="{{ $review->user_id }}">
                                    <button class="btn btn-success" type="submit" data-toggle="tooltip" data-placement="bottom" title="Add Response">
                                        <i class="align-middle icon-white" data-feather="edit"></i>
                                    </button>
                                </form>
                                @endif
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