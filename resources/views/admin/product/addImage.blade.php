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
            <h3><strong>Add Product Images</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <form action="/admin/product/{{ $product->slug }}/add-image" method="POST"  enctype="multipart/form-data" class="form">
                        @csrf
                        <div class="form-group" >
                            <label for="image" class="control-label" >Product Image</label>
                            <div class="user-image mb-3 text-center">
                                <div class="imgPreview"> </div>
                            </div>            
                            <div class="custom-file">
                                <input type="file" name="imageFile[]" class="custom-file-input @error('imageFile.*') is-invalid @enderror" id="images" multiple="multiple" required accept=".jpg, .png, .jpeg">
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
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Submit Image" onclick="return confirm('Are you sure you want to add this image?')">Submit</button>
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
@endsection
