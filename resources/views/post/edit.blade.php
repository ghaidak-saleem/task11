@extends('layout.app1')
@section('title','edit')
@section('content')
<h1>update page </h1>
<form action="{{route('post.update',$post->id)}}" method="POST" enctype="multipart/form-data" style="width: 35rem;">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="p_t" class="form-label">post title:</label>
      <input type="text" class="form-control" id="p_t" name="title" value="{{$post->title}}">
      @error('title')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="p_d" class="form-label">post description:</label>
      <textarea name="description" id="p_d" class="form-control" >{{$post->description}} </textarea>
      @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
        <label class="form-label">post category:</label><br>
       <select name="select" >
        @foreach ($categories as $cat)
        <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
       </select>
        @error('select')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="p_image" class="form-label">post image:</label><br>
        <input type="file" name="image" class="form-control-file" id="p-image" ><br>
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

         @if($post->image)
        <img src="{{asset('storage/posts_images/'.basename($post->image))}}" alt="no image" width="300px" >
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
@endsection
