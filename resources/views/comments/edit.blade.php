@extends('layout.app')
@section('title','edit_comment')
@section('content')
<h1>edit comment: </h1>
<form action="{{route('comment.update',[$post->id,$comment->id])}}" method="POST"  style="margin: 33px">
    @csrf
    @method('PUT')
<div class="form-group">
    <label for="p_d" class="form-label">comment content:</label>
    <textarea name="content" id="p_d" class="form-control" >{{$comment->content}} </textarea>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">edit comment</button>
@endsection
