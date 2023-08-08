@extends('app')
@section('content')
    <div class="d-flex justify-content-center">
        <form class="w-50" method="POST" action="{{ route('product.update' , $product) }}" enctype="multipart/form-data">
            {{-- @csrf => This token is then validated on the server-side when the form is submitted,
                 ensuring that the request is coming from a trusted source. The CSRF token 
                 is generated automatically by Laravel and is included in the form as a hidden field. 
            --}}
            @csrf
            {{-- @method('PUT') => HTML forms can only submit data using the GET or POST methods. To get around this limitation,
                 Laravel provides the @method directive which generates a hidden input field with the name _method and the value PUT.
            --}}
            @method('PUT')
            <a href="{{ route('product.index') }}" class="btn btn-sm btn-danger mb-3">go Back</a>
            <div class="form-group mb-3">
              <label for="exampleInputEmail1">Product Name</label>
              <input type="text" value="{{ $product->name }}" name="name" class="form-control" value="" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Product Name">
              @error('name')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1">Product Description</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $product->description }}</textarea>
                @error('description')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group mb-3">
              <label for="exampleInputPassword1">Product Price</label>
              <input name="price" value="{{ $product->price }}" type="number" class="form-control" id="exampleInputPassword1" placeholder="Product Price">
                @error('price')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label">image</label><br>
                <label class="col" for="logo">
                    <div class="imgfile">
                            <img src="{{ asset('images/product/'. $product->image) }}" alt="img"
                                width="150" height="150" >
                        <input type="file" hidden name="image"
                            class="form-control" 
                            id="logo" onchange="loadFile(this.previousElementSibling,event);" />
                    </div>
                </label>
                @error('image')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
          </form>
    </div>
@endsection
