@extends('layout.app')
@section('title','index')
@section('content')


    @forelse ($data as $post)
    <div class="card" style="width: 18rem;">
        @if($post->image)
        <img src="{{asset('images/'.$post->image)}}" class="card-img-top" alt="no image for this post">
        @endif
        <div class="card-body">
          <h5 class="card-title"> {{ $post->title }}</h5>
          <p class="card-text"> {{$post->description}}</p>
          @if(auth()->check()&& auth()->user()->can('update',$post))
          <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary">Edit</a>
          @endif

          @if(auth()->check()&& auth()->user()->can('view',$post))
          <a href="{{route('post.show',[$post->id,$post->user_id])}}" class="btn btn-warning">Show</a>
          @endif
          @if(auth()->check()&& auth()->user()->can('delete',$post))
          <form action="{{route('post.delete',$post->id)}}" method="POST" style="display: inline">
            @csrf
          @method('DELETE')
          <input type="submit" value="Delete" class="btn btn-danger"
           onclick="return confirm('Are you sure you want to delete this post?')">
        </form>
        @endif
        </div>
      </div>
      @empty
        <h2>no posts</h2>
  @endforelse
@endsection
