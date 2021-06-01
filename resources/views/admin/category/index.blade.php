@extends('layout-admin.index')
@section('title', 'Category')
@section('content')
<style>
    .icon-white {
        color: white;
      }
</style>
<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Category</strong></h3>
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
                <button class="btn btn-success" onclick="location.href='{{ url('/admin/category/create') }}'"><i class="fas fa-plus" data-toggle="tooltip" data-placement="bottom" title="Add Category"></i> Add Category</button>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width:10%;">Id</th>
                            <th style="width:60%;">Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($category_data as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td class="table-action">
                                <a class="btn btn-primary" href="/admin/category/{{ $category->slug }}/edit" role="button" onclick="return confirm('Are you sure you want to edit this category?')" data-toggle="tooltip" data-placement="bottom" title="Edit Category"><i class="align-middle icon-white" data-feather="edit-2"></i></a>
                                <form action="/admin/category/{{$category->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this category?')" data-toggle="tooltip" data-placement="bottom" title="Delete Category">
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
@endsection
