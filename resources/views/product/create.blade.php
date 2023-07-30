@extends('app')
@section('content')
    <div class="d-flex justify-content-center">
        <form class="w-50" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            {{-- @csrf => This token is then validated on the server-side when the form is submitted,
                 ensuring that the request is coming from a trusted source. The CSRF token 
                 is generated automatically by Laravel and is included in the form as a hidden field. 
            --}}
            @csrf
            <a href="{{ route('product.index') }}" class="btn btn-sm btn-danger mb-3">go Back</a>
            <div class="form-group mb-3">
                <label for="exampleFormControlSelect1">Select Category</label>
                <select class="form-control" id="exampleFormControlSelect1" name='category'>
                  <option value="">Select Category</option>
                  @foreach($categories as $category)
                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                @error('category')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group mb-3">
              <label for="exampleInputEmail1">Product Name (*)</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Product Name">
              @error('name')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="exampleFormControlTextarea1">Product Description (*)</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group mb-3">
              <label for="exampleInputPassword1">Product Price (*)</label>
              <input name="price" value="{{ old('price') }}" type="number" class="form-control" id="exampleInputPassword1" placeholder="Product Price">
              @error('price')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label">image (*)</label><br>
                <label class="col" for="logo">
                    <div class="imgfile">
                            <img src="{{ asset('assets/img/defaultImgProduct.jpg') }}" alt="img"
                                width="150" height="150" >
                        <input type="file" hidden name="img"
                            class="form-control" value="{{ old('img') }}"
                            id="logo" onchange="loadFile(this.previousElementSibling,event);" />
                    </div>
                </label>
                @error('img')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
          </form>
    </div>
@endsection
