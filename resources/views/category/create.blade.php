@extends('layout.app')
@section('title','create_category')
@section('content')
<h1>create category: </h1>
<form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" style="margin: 33px">
    @csrf
    <div class="form-group">
      <label for="c_t" class="form-label">category name:</label>
      <input type="text" class="form-control" id="c_t" name="name">
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
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
