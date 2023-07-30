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
                    <h2> All categories belongs to product : <b>{{ $product->name }}</b> </h2>
                </div>
                <div class="form-group col-sm-4 ">
                    {{-- you can attach a category to product by this form --}}
                    <form action="{{ route('product.attch-category-to-product' , $product) }}" method="POST" class='d-flex'>
                        @csrf
                        <select class="form-control w-50" id="exampleFormControlSelect1" name='category'>
                      <option value="">Select Category</option>
                      @foreach($items as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                    <button class="btn btn-sm btn-primary w-25">Add to product</button>
                </form>
                    
                </div>
                {{-- this link i use it to go to product.index --}}
                <div class="col-sm-1">
                    <a href="{{ route('product.index') }}" class="btn btn-sm btn-danger">go Back</a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- maping on data categories belongs to product to show information each category --}}
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>@if($category->parentCategory) {{ $category->parentCategory->name }}@endif</td>
                        <td>
                            {{-- you can detach a category from product by this form --}}
                            <form onsubmit="return confirm('Are you sure ?')" class="d-inline" action="{{ route('product.detach-category' , [ 'product_id' => $product , 'category_id' => $category ]) }}" method="POST">
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
</div>
@endsection