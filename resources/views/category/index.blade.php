@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
@endif
@if(session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
  </div>
@endif
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-10">
                    <h2>Category</h2>
                </div>
                <div class="col-sm-2">
                    <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">Add Category</a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th style="width: 200px">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- maping on data products to show information each product --}}
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>@if($category->parentCategory) {{ $category->parentCategory->name }}@endif</td>
                        <td>
                            {{-- show more information about this product like all categories belongsTo and also you can detach or attach category  --}}
                            <a href="{{ route('category.show' , $category) }}" class="view" title="View" data-toggle="tooltip"><i
                                class="material-icons">&#xE417;</i></a>

                            {{-- for update information of product --}}    
                            <a href="{{ route('category.edit' ,$category) }}" class="edit" title="Edit" data-toggle="tooltip"><i
                                class="material-icons">&#xE254;</i></a>

                            {{-- delete product --}}
                            <form onsubmit="return confirm('Are you sure ?')" class="d-inline" action="{{ route('category.destroy' , $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="delete" style="border: 0 ; background-color: transparent; color: red;" title="Delete" ><i
                                        class="material-icons">&#xE872;</i></button>
                                
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- pagination check if instanceof Pagination class to use it --}}
    @if($categories instanceof \Illuminate\Pagination\LengthAwarePaginator )

        {{ $categories->links('pagination::bootstrap-5') }}

    @endif
</div>
@endsection