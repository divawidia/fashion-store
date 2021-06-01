@extends('layout-admin.index')
@section('title', 'Edit | Product')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
        .imgPreview img {
            padding: 8px;
            max-width: 100px;
        } 
    </style>
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Edit Product</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <form action="/admin/product/{{$product->slug}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="product_name" class="control-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="product_name" placeholder="Product Name" aria-describedby="product_name" aria-invalid="true" value="{{ $product->product_name }}" required>
                            @error('product_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" >
                            <label for="price" class="control-label">Price</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="price" aria-describedby="price" aria-invalid="true" value="{{ $product->price }}" step='100' min='1000' required>
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" >
                            <label for="description" class="control-label">Description</label>
                            <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="description" required rows="5" cols="40">{{ $product->description }}</textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control category @error('category') is-invalid @enderror" multiple="multiple" name="category[]" id="category-dropdown" required>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group {{ $errors->has('stock') ? 'has-error' : '' }} " >
                            <label for="stock" class="control-label">Stock</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" id="stock" placeholder="Stock" aria-describedby="stock" aria-invalid="true" value="{{ $product->stock }}" step="1" min="1" required>
                            @error('stock')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group  {{ $errors->has('weight') ? 'has-error' : '' }} " >
                            <label for="weight" class="control-label" >Weight(g)</label>
                            <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight" placeholder="Weight(g)" aria-describedby="weight" aria-invalid="true" value="{{ $product->weight }}" step="1" min="100" required>
                            @error('weight')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
        
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Submit Edit" onclick="return confirm('Are you sure you want to edit this product?')">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@php
    $category_id = [];
@endphp

@foreach($product->categories as $category)
    @php
        array_push($category_id, $category->id);
    @endphp
@endforeach

<script>
    $(document).ready(function() {
        $('.category').select2();
        data = [];
        data = <?php echo json_encode($category_id); ?>;
        $('.category').val(data).trigger('change');
    });
</script>
<script>
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });    
    </script>
@endsection
