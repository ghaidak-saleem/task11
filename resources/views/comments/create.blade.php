@extends('layout.app')
@section('title','create_comment')
@section('content')
<h1>add comment: </h1>
<h3 style="color: blue">previous comments:</h3>
@forelse ($post->comments as $comment )
<h5 style="color: blue">{{$comment->user->name}}</h5>
<img src="{{asset('images/'.$comment->user->image)}}" width="75px" height="75px">
<p class="card-text">{{$comment->content}}</p>
@empty
@php
echo('no comments yet')
@endphp
@endforelse
<form action="{{route('comment.store',$post->id)}}" method="POST"  style="margin: 33px">
    @csrf
<div class="form-group">
    <label for="p_d" class="form-label">comment content:</label>
    <textarea name="content" id="p_d" class="form-control" > </textarea>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">add comment</button>
@endsection
