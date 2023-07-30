@extends('app')
@section('content')
    <div class="d-flex justify-content-center">
        <form class="w-50" method="POST" action="{{ route('category.update' , $category) }}" >
            {{-- @csrf => This token is then validated on the server-side when the form is submitted,
                 ensuring that the request is coming from a trusted source. The CSRF token 
                 is generated automatically by Laravel and is included in the form as a hidden field. 
            --}}
            @csrf
            @method('PUT')
            <a href="{{ route('category.index') }}" class="btn btn-sm btn-danger mb-3">go Back</a>
            <div class="form-group mb-3">
                <label for="exampleFormControlSelect1">Select Parent Category</label>
                <select class="form-control" id="exampleFormControlSelect1" name='parent_category'>
                  <option value="">Select Category</option>
                  
                  @foreach($parent_categories as $parent_category)
                     <option @if($category->parent_category === $parent_category->id) selected @endif value="{{ $parent_category->id }}">{{ $parent_category->name }}</option>
                  @endforeach

                </select>
                @error('parent_category')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group mb-3">
              <label for="exampleInputEmail1">Category Name (*)</label>
              <input type="text" name="name" class="form-control" value="{{ $category->name }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Product Name">
              @error('name')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
          </form>
    </div>
@endsection
