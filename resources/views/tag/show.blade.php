@extends('layout.app1')
@section('title','show')
@section('content')

    <div class="card" style="width: 35rem;">
          <h3 style="color: blue">tag name:</h3>
          <h5 class="card-title"> {{ $tag->name }}</h5>
          <h3 style="color: blue">created_at:</h3>
          <p class="card-text">{{$tag->created_at}}</p>
          <h3 style="color: blue">updated_at:</h3>
          <p class="card-text">{{$tag->updated_at}}</p><br>
        </div>
    </div>
@endsection
