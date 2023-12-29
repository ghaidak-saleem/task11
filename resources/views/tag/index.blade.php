@extends('layout.app')
@section('title','index_tag')
@section('content')

<h3>Tags page:</h3>
<a href="{{route('tag.create')}}" class="btn btn-primary">Add tag</a>

    @forelse ($data as $tag)
    <div class="card" style="width: 18rem;">
          <h5 class="card-title"> tag details:</h5>
          <p class="card-text">tag name : {{$tag->name}}</p>
          <a href="{{route('tag.edit',$tag->id)}}" class="btn btn-primary">Edit</a>

          <form action="{{route('tag.delete',$tag->id)}}" method="POST" style="display: inline">
            @csrf
          @method('DELETE')
          <input type="submit" value="Delete" class="btn btn-danger"
           onclick="return confirm('Are you sure you want to delete this tag?')">
        </form>

        </div>
      </div>
      @empty
        <h2>no tags</h2>
  @endforelse
@endsection
