@extends('layout.app')
@section('title','create_tag')
@section('content')
<h1>create category: </h1>
<form action="{{route('tag.store')}}" method="POST"  style="margin: 33px">
    @csrf
    <div class="form-group">
      <label for="c_t" class="form-label">tag name:</label>
      <input type="text" class="form-control" id="c_t" name="name">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
