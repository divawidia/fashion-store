@extends('layout-admin.index')
@section('title', 'Courier')
@section('content')
<style>
    .icon-white {
        color: white;
      }
</style>
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Courier</strong></h3>
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
                    <button class="btn btn-success" onclick="location.href='{{ url('admin/courier/create') }}'" data-toggle="tooltip" data-placement="bottom" title="Add Courier"><i class="fas fa-plus"></i> Add Courier</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width:10%;">Id</th>
                            <th style="width:60%;">Courier Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($courier_data as $courier)
                        <tr>
                            <td>{{$courier->id}}</td>
                            <td>{{$courier->courier}}</td>
                            <td class="table-action">
                                <a class="btn btn-primary" href="/admin/courier/{{ $courier->slug }}/edit" role="button" data-toggle="tooltip" data-placement="bottom" title="Edit Courier" onclick="return confirm('Are you sure you want to edit this courier?')"><i class="align-middle icon-white" data-feather="edit-2" data-toggle="tooltip" data-placement="bottom" title="Edit Courier" onclick="return confirm('Are you sure you want to edit this courier?')"></i></a>
                                <form action="/admin/courier/{{$courier->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit"  onclick="return confirm('Are you sure you want to delete this courier?')" data-toggle="tooltip" data-placement="bottom" title="Delete Courier">
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
