@extends('layout.app')
@section('title','edit_tag')
@section('content')
<h1>update category: </h1>
<form action="{{route('tag.update',$tag->id)}}" method="POST"  style="margin: 33px">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="c_t" class="form-label">tag name:</label>
      <input type="text" class="form-control" id="c_t" name="name" value="{{$tag->name}}">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">update</button>
    </form>
@endsection
