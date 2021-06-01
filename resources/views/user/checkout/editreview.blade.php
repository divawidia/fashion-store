@extends('layout-user.index')
@section('title', 'Invoices')
@section('content')

<style>
    .form-control{
        font-size:15px;
    }
</style>

<div style="margin-top:50px ">
    <div class="container">
        <div class="row align-items-centre">
            <div class="col-lg-2">
            </div>
            <div class="col-md-8">
                <div class="component">
                    <div class="card mb-5">
                        <form class="form-signin" action="/users/review/edit" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="card-header">
                                <center>
                                    <span style="font-size:15px;">Review Produk</span>
                                </center>
                            </div>
                            <div class="card-body" style="font-size:15px;">
                                <div class="form-group">
                                    <label>Produk</label>
                                    <input type="text" name="" value="{{$prodname}}" readonly="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Review</label>
                                    <input type="text" name="content" placeholder=""  placeclass="form-control" style="width: 80%; margin-right: 20px;" placeholder="review produk">
                                    <input type="hidden" name="productid" value="{{$prodid}}">
                                    
                                    <input type="hidden" name="reviewid" value="{{$review->id}}">
                                </div>
                                <div class="form-group">
                                    <label>Rating</label>
                                    <div class="form-group">
                                        <select name="rate">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop