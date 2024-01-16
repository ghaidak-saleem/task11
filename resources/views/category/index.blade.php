@extends('layout.app1')
@section('title','index_category')
@section('content')

<div style="width: 1150px">
<h3>Categories page:</h3>
<a href="{{route('category.create')}}" class="btn btn-primary">Add category</a>
    <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th scope="col">category</th>
            <th scope="col">name</th>
            <th scope="col">image</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
         @forelse ($categories as $category)
          <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->name}}</td>
            <td>
            @if($category->image)
                <img src="{{asset('storage/categories_images/'.basename($category->image))}}"  width="80" height="80" class="rounded-circle" alt="no image for this post">
                @endif
            </td>
            <td>
                <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary">Edit</a>
                <a href="{{route('category.show',$category->id)}}" class="btn btn-warning" style="display: inline">Show</a>
                <form action="{{route('category.delete',$category->id)}}" method="POST" style="display: inline">
                    @csrf
                  @method('DELETE')
                  <input type="submit" value="Delete" class="btn btn-danger"
                   onclick="return confirm('Are you sure you want to delete this category?')">
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
