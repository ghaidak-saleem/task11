@extends('layout.app')
@section('title','create')
@section('content')
<h1>Register: </h1>
<form action="{{route('register')}}" method="POST" enctype="multipart/form-data"  style="margin: auto;">
    @csrf
    <div class="form-group">
      <label for="p_t" class="form-label">name:</label>
      <input type="text" class="form-control" id="p_t" name="name">
      @error('name')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="p_d" class="form-label">email:</label>
     <input type="email" class="form-control" id="p_d" name="email">
      @error('email')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
    <label for="p_image" class="form-label">image:</label><br>
    <input type="file" class="form-control-file" id="p-image" name="image">
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div id="passwordHelpBlock" class="form-group">
    <label for="Password5" class="form-label">Password:</label>
    <input type="password" id="Password5" class="form-control" aria-describedby="passwordHelpBlock" name="password" >
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div id="passwordHelpBlock" class="form-group">
    <label for="inputPassword" class="form-label">confirmed Password:</label>
    <input type="password" id="inputPassword" class="form-control" aria-describedby="passwordHelpBlock" name="password_confirmation" required>
    @error('password_confirmation')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <p>you have account already? <a href="{{route('showlogin')}}">login</a></p>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
@endsection
