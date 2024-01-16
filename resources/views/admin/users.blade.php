@extends('layout.app1')
@section('title','index_category')
@section('content')

<div style="width: 1150px">
<h3>users page:</h3>
<a href="{{route('admin.createUser')}}" class="btn btn-primary">Add User</a>
    <table class="table table-dark table-striped">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                 {{ session('success') }}
             </div>
        @endif
        <thead>
          <tr>
            <th scope="col">user</th>
            <th scope="col">name</th>
            <th scope="col">image</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
         @forelse ($users as $user)
          <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>
            @if($user->image)
                <img src="{{asset('storage/users_images/'.basename($user->image))}}"  width="80" height="80" class="rounded-circle" alt="no image for this user">
                @endif
            </td>
            <td>
                @if($user->blocked)
                    <form action="{{ route('admin.unblock', $user) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="submit" class="btn btn-primary" value="unblock">
                    </form>
                @else
                    <form action="{{ route('admin.block', $user) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-danger">Block</button>
                    </form>
                @endif
            </td>

          </tr>
          @empty
          <h2>no users</h2>
    @endforelse
        </tbody>
      </table>

    </div>
@endsection
