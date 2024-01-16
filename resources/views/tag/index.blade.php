@extends('layout.app1')
@section('title','index_tag')
@section('content')

<div style="width: 1150px">
<h3>Tags page:</h3>
<a href="{{route('tag.create')}}" class="btn btn-primary">Add tag</a>

    <table class="table table-dark table-striped">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <thead>
          <tr>
            <th scope="col">Tag</th>
            <th scope="col">name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
         @forelse ($tags as $tag)
          <tr>
            <th scope="row">{{$tag->id}}</th>
            <td>{{$tag->name}}</td>
            <td> <a href="{{route('tag.edit',$tag->id)}}" class="btn btn-primary">Edit</a>
                <a href="{{route('tag.show',$tag->id)}}" class="btn btn-warning" style="display: inline">Show</a>
                <form action="{{route('tag.delete',$tag->id)}}" method="POST" style="display: inline">
                    @csrf
                  @method('DELETE')
                  <input type="submit" value="Delete" class="btn btn-danger"
                   onclick="return confirm('Are you sure you want to delete this tag?')">
                </form>
            </td>
          </tr>
          @empty
          <h2>no tags</h2>
    @endforelse
        </tbody>
      </table>

    </div>
@endsection
