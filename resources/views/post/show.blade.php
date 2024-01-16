@extends('layout.app1')
@section('title','show')
@section('content')

    <div class="card" style="width: 35rem;">
        <h3 style="color: blue">post image:</h3>
        <img src="{{asset('storage/posts_images/'.basename($post->image))}}" class="card-img-top" alt="no image for this post" width="200px" height="250px">
        <div class="card-body">
          <h3 style="color: blue">post title:</h3>
          <h5 class="card-title"> {{ $post->title }}</h5>
          <h3 style="color: blue">post content:</h3>
          <h5 class="card-title"> {{ $post->description }}</h5>
          <h3 style="color: blue">post publisher:</h3>
          <h5 class="card-title"> {{ $post->user->name }}</h5>
          <img src="{{asset('images/'.$post->user->image)}}" class="img-thumbnail" alt="no image for this user" width="150px" height="150px" >
          <h3 style="color: blue">post category:</h3>
          <p class="card-text"> {{$post->category->name}}</p>
          <h3 style="color: blue">post description:</h3>
          <p class="card-text"> {{$post->description}}</p>
          <h3 style="color: blue">created_at:</h3>
          <p class="card-text">{{$post->created_at}}</p>
          <h3 style="color: blue">updated_at:</h3>
          <p class="card-text">{{$post->updated_at}}</p><br>

          @if ($post->tags->count() > 0)
          <h3 style="color: blue">tags:</h3>
         <ul>
         @foreach ($post->tags as $tag)
         <li>{{ $tag->name }}</li>
         @endforeach
         </ul>
         @else
         <p>No tags associated with this post.</p>
         @endif
          <h3 style="color: blue">All comments:</h3>
          @forelse ($post->comments as $comment )
          <hr>
          <h5 style="color: blue">{{$comment->user->name}}</h5>
          <img src="{{asset('storage/users_images/'.basename($comment->user->image))}}" width="75px" height="75px">
          <p class="card-text">{{$comment->content}}</p>
          @if(auth()->check()&& auth()->user()->can('update',$comment))
          <a href="{{route('comment.edit',[$post->id,$comment->id])}}" class="btn btn-primary">edit comment</a>
          @endif

          @if(auth()->check()&& auth()->user()->can('delete',$comment))
          <form action="{{route('comment.delete',[$post->id,$comment->id])}}" method="POST" style="display: inline">
            @csrf
          @method('DELETE')
          <input type="submit" value="Delete" class="btn btn-danger"
           onclick="return confirm('Are you sure you want to delete this comment?')">
        </form>
        @endif

          @empty
          @php echo('no comments yet')
          @endphp
          @endforelse
          <hr>
          @if(auth()->check())
          <br><br><a href="{{route('comment.add',$post->id)}}" class="btn btn-primary">Add comment</a>
          @endif
        </form>
        </div>
      </div>
  @endsection
