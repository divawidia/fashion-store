@extends('layout-admin.index')
@section('title', 'Edit | Courier')
@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Edit Courier</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                <form action="/admin/courier/{{$courier->slug}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="courier" class="control-label">Courier Name</label>
                            <input type="text" name="courier" class="form-control @error('courier') is-invalid @enderror" id="courier" placeholder="Courier Name" aria-describedby="courier" aria-invalid="true" value="{{ $courier->courier }}" required>
                            @error('courier')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Submit Edit" onclick="return confirm('Are you sure you want to edit this courier?')">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
