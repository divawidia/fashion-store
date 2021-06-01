@extends('layout-admin.index')
@section('title', 'Edit | Discount')
@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Edit Discount</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <form action="/admin/discount/{{ $discounts->id }}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group" >
                            <label for="percentage" class="control-label">Percentage(%)</label>
                            <input type="number" name="percentage" class="form-control @error('percentage') is-invalid @enderror" id="percentage" placeholder="percentage" aria-describedby="percentage" aria-invalid="true" value="{{$discounts->percentage}}"  step="1" min="1" max="100" required>
                            @error('percentage')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="form-group" >
                            <label for="start" class="control-label">Start</label>
                            <input type="date" name="start" class="form-control @error('start') is-invalid @enderror" id="start" aria-describedby="start" aria-invalid="true" value="{{ $discounts->start }}" required>
                            @error('start')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group" >
                            <label for="end" class="control-label">End</label>
                            <input type="date" name="end" class="form-control @error('end') is-invalid @enderror" id="end" aria-describedby="end" aria-invalid="true" value="{{ $discounts->end }}" required>
                            @error('end')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Submit Edit" onclick="return confirm('Are you sure you want to edit this discount?')">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
