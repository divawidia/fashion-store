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
            <h3><strong>Product Images</strong></h3>
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
                    <a class="btn btn-success" href="{{ url('/product/'. $product->slug .'/image/add') }}"><i class="fas fa-plus"></i> Add Image</a>
                </div>
                <table class="table table-striped">
                    <tbody>
                        <div class="table">
                            <div class="row">
                            @foreach($product->images as $image)
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img class="img-fluid-left img-thumbnail" src="/product-images/{{$image->image_name}}" alt="light">
                                        <form method="POST" action="{{ route('product-image.destroy', $image->id) }}">
                                            @csrf
                                            @method('delete')
                                            <div class="wrapper cemter">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this image?')">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                    Delete Image
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
