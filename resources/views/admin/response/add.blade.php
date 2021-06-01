@extends('layout-admin.index')
@section('title', 'Add | Courier')
@section('content')
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Add response to review</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-body">
                <form action="/admin/review/{{$review->id}}/add-response" method="POST"  enctype="multipart/form-data" class="form">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="review" class="control-label">Review</label>
                            <input type="text" name="" readonly="" value="{{$review->content}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="response" class="control-label">Response</label>
                            <textarea type="text" name="content" class="form-control @error('content') is-invalid @enderror" id="content" placeholder="Add your response" aria-describedby="content" aria-invalid="true" required rows="5" cols="40">{{ old('description')}}</textarea >
                            @error('content')
                                <div class="alert alert-danger">{{ $content }}</div>
                            @enderror
                        </div>
                        <input name="userid" type="hidden" value="{{$userid}}">
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Submit Response" onclick="return confirm('Are you sure you want to add this response?')">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection