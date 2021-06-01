@extends('layout-admin.index')
@section('title', 'Add | Product')

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
            <h3><strong>Add Product</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <form action="/admin/product" method="POST" id="registervalidation" enctype="multipart/form-data" class="form">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="product_name" class="control-label">Product Name</label>
                            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="product_name" placeholder="Product Name" aria-describedby="product_name" aria-invalid="true" value="{{ old('product_name')}}" required>
                            @error('product_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" >
                            <label for="price" class="control-label">Price</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Price" aria-describedby="price" aria-invalid="true" value="{{ old('price')}}" step='100' min='1000' required>
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" >
                            <label for="description" class="control-label">Description</label>
                            <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Description" aria-describedby="description" aria-invalid="true" required rows="5" cols="40">{{ old('description')}}</textarea >
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

                        <div class="form-group" >
                            <label for="stock" class="control-label">Stock</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" id="stock" placeholder="Stock" aria-describedby="stock" aria-invalid="true" value="{{ old('stock')}}" step='1' , min='1' required>
                            @error('stock')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" >
                            <label for="weight" class="control-label" >Weight (gram)</label>
                            <input type="number" name="weight" class="form-control  @error('weight') is-invalid @enderror" id="weight" placeholder="Weight" aria-describedby="weight" aria-invalid="true" value="{{ old('weight')}}" step="1" min="100" required>
                            @error('weight')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" >
                            <label for="image" class="control-label" >Product Image</label>
                            <div class="user-image mb-3 text-center">
                                <div class="imgPreview"> </div>
                            </div>            
                            <div class="custom-file">
                                <input type="file" name="imageFile[]" class="custom-file-input @error('imageFile.*') is-invalid @enderror" id="images" multiple="multiple" required accept=".jpeg, .jpg, .png"> 
                                <label class="custom-file-label" for="images">Choose image</label>
                            </div>
                            @if ($errors->has('imageFile'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('imageFile') }}   
                                </div>
                            @endif
                            @if ($errors->has('imageFile.*'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('imageFile.*') }}   
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Submit Product" onclick="return confirm('Are you sure you want to add this product?')">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.category').select2();
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
<script>
$("#images").fileinput({
    showUpload: false,
    showRemove: true,
    required: true,
    allowedFileExtensions: ["jpg", "png", "jpeg"]
});
$(".btn").on("click", function() {
    $("#images").fileinput('upload');
});
</script>
@endsection
