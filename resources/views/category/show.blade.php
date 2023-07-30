@extends('app')
@section('content')
{{-- check if session has a success message --}}
@if(session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
  </div>
@endif

{{-- check if session has a warning message --}}
@if(session('warning'))
<div class="alert alert-warning" role="alert">
    {{ session('warning') }}
</div>
@endif

{{-- check if session has a error message --}}
@if(session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-7">
                    <h2>All products belongs to category : <b>{{ $category->name }}</b></h2>
                </div>
                <div class="form-group col-sm-4 ">
                    {{-- you can attach a category to product by this form --}}
                    <form action="{{ route('category.attch-product-to-category' , $category) }}" method="POST" class='d-flex'>
                        @csrf
                        <select class="form-control w-50" id="exampleFormControlSelect1" name='product'>
                      <option value="">Select Product</option>
                      @foreach($items as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                    <button class="btn btn-sm btn-primary w-25">Add to category</button>
                </form>
                    
                </div>
                {{-- this link i use it to go to product.index --}}
                <div class="col-sm-1">
                    <a href="{{ route('category.index') }}" class="btn btn-sm btn-danger">go Back</a>
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
                            {{-- you can detach a product from category by this form --}}
                            <form onsubmit="return confirm('Are you sure ?')" class="d-inline" action="{{ route('category.detach-product' , [ 'product_id' => $product , 'category_id' => $category ]) }}" method="POST">
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