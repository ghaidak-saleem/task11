@extends('layout.app')
@section('title','login')
@section('content')
<h2>login: </h2>
<form action="{{route('login')}}" method="POST">
    @csrf
<div class="form-group">
    <label for="exampleFormControlInput1" class="form-label">Email address:</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com" required>
  </div>
  <div class="form-group">
    <label for="inputPassword5" class="form-label">Password</label>
    <input type="password" id="inputPassword5" name="password" class="form-control" aria-describedby="passwordHelpBlock" required>
  </div>
  <p>you don't have account ? <a href="{{route('showregister')}}">Register</a></p>
  <button type="submit" class="btn btn-primary">login</button>
</form>
@endsection
