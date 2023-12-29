@extends('layout.app')
@section('title','index_category')
@section('content')

<h3>Categories page:</h3>
<a href="{{route('category.create')}}" class="btn btn-primary">Add category</a>

    @forelse ($data as $category)
    <div class="card" style="width: 18rem;">
        @if($category->image)
        <img src="{{asset('images/'.$category->image)}}" class="card-img-top" alt="no image for this post">
        @endif
        <div class="card-body">
          <h5 class="card-title"> category details:</h5>
          <p class="card-text">category name : {{$category->name}}</p>
          <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary">Edit</a>

          <form action="{{route('category.delete',$category->id)}}" method="POST" style="display: inline">
            @csrf
          @method('DELETE')
          <input type="submit" value="Delete" class="btn btn-danger"
           onclick="return confirm('Are you sure you want to delete this category?')">
        </form>
         
        </div>
      </div>
      @empty
        <h2>no categories</h2>
  @endforelse
@endsection
