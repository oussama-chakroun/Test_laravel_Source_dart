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
                <div class="col-sm-6">
                    <h2>Product</h2>
                </div>
                <div class="col-sm-3">
                    <form action="" class="d-flex">
                        <div class="form-check">
                            <input name="name" class="form-check-input" type="checkbox" value="true" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                name &nbsp;
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="price" class="form-check-input" type="checkbox" value="true" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">
                                price &nbsp;
                            </label>
                        </div>
                        <button class="btn btn-sm btn-primary">sort</button>
                    </form>
                </div>
                <div class="form-group col-sm-2 ">
                    <form action="" class='d-flex'>
                        <select class="form-control" id="exampleFormControlSelect1" name='category'>
                      <option value="">Select Category</option>
                      @foreach($categories as $category)
                         <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                    <button class="btn btn-sm btn-success">filter</button>
                    </form>
                    
                </div>

                <div class="col-sm-1">
                    <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Add Product</a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name <i class="fa fa-sort"></i></th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>image</th>
                    <th style="width: 200px">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- maping on data products to show information each product --}}
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td><img height="50px" src="{{ asset('images/product/'.$product->image) }}" /></td>
                        <td>
                            {{-- show more information about this product like all categories belongsTo and also you can detach or attach category  --}}
                            <a href="{{ route('product.show' , $product) }}" class="view" title="View" data-toggle="tooltip"><i
                                class="material-icons">&#xE417;</i></a>

                            {{-- for update information of product --}}    
                            <a href="{{ route('product.edit' ,$product) }}" class="edit" title="Edit" data-toggle="tooltip"><i
                                class="material-icons">&#xE254;</i></a>

                            {{-- delete product --}}
                            <form onsubmit="return confirm('Are you sure ?')" class="d-inline" action="{{ route('product.destroy' , $product) }}" method="POST">
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
    @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator )

        {{ $products->links('pagination::bootstrap-5') }}

    @endif
</div>
@endsection