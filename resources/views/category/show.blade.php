@extends('layout.app1')
@section('title','show')
@section('content')

    <div class="card" style="width: 35rem;">
        <h3 style="color: blue">category image:</h3>
        <img src="{{asset('storage/categories_images/'.basename($category->image))}}" class="card-img-top" alt="no image for this post" width="200px" height="250px">
        <div class="card-body">
          <h3 style="color: blue">category name:</h3>
          <h5 class="card-title"> {{ $category->name }}</h5>
        </div>
    </div>
@endsection
