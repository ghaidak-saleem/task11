@extends('layout.app1')
@section('title','edit_category')
@section('content')
<h1>update category: </h1>
<form action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data" style="margin: 33px">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="c_t" class="form-label">category name:</label>
      <input type="text" class="form-control" id="c_t" name="name" value="{{$category->name}}">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
    <label for="p_image" class="form-label">category image:</label><br>
    <input type="file" class="form-control-file" id="p-image" name="image">
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    @if($category->image)
        <img src="{{asset('storage/categories_images/'.basename($category->image))}}" alt="no image" width="300px" >
    @endif
    </div>
    <button type="submit" class="btn btn-primary">update</button>
    </form>
@endsection
