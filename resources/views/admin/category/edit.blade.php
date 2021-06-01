@extends('layout-admin.index')
@section('title', 'Edit| Category')
@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Edit Category</strong></h3>
        </div>
    </div>
    <div class="row">
    <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <form action="/admin/category/{{$category->slug}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="category_name" class="control-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="category_name" placeholder="Category Name" aria-describedby="category_name" aria-invalid="true" value="{{ $category->category_name }}" required>
                            @error('category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Submit Edit" onclick="return confirm('Are you sure you want to edit this category?')">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
