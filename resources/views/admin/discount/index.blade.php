@extends('layout-admin.index')
@section('title', 'Discount')
@section('content')
<style>
    .icon-white {
        color: white;
      }
</style>
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Discount</strong></h3>
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
                    <button class="btn btn-success" onclick="location.href='{{ url('admin/discount/create') }}'"><i class="fas fa-plus"></i></button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width:10%;">Id</th>
                            <th style="width:40%;">Product</th>
                            <th style="width:10%;">Percentage</th>
                            <th style="width:20%">Start</th>
                            <th class="d-none d-md-table-cell" style="width:20%">End</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($discount_data as $discount)
                            <tr>
                                <td>{{$discount->id}}</td>
                                <td>{{$discount->products_id}}</td>
                                <td>{{$discount->percentage}}{{"%"}}</td>
                                <td>{{$discount->start}}</td>
                                <td>{{$discount->end}}</td>
                                <td class="table-action">
                                    <a class="btn btn-primary" href="/admin/discount/{{ $discount->id }}/edit" role="button"><i class="align-middle icon-white" data-feather="edit-2"></i></a>
                                    <form action="/admin/discount/{{$discount->id}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">
                                            <i class="align-middle" data-feather="trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@stop
