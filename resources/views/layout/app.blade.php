<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>@yield('title','Home')</title>
    <style>
        div{
            padding: 15px;
            margin:auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <ul class="nav nav-tabs">
        <li class="nav-item ">
          <a class="nav-link active" aria-current="page" > TASK 11</a>
        </li>
        @if(auth()->user())
        <li class="nav-item">
            <a class="nav-link" >{{auth()->user()->name}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="{{route('post.index')}}">HOME</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('post.create')}}">Create post</a>
        </li>
        @if(auth()->user()->is_admin)
        <li class="nav-item">
            <a class="nav-link"  href="{{route('category.index')}}">categories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="{{route('tag.index')}}">tags</a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">logout</a>
        </li>
        @endif
        @if(!auth()->user())
        <li class="nav-item">
            <a class="nav-link" href="{{route('showregister')}}">Register</a>
        </li>
        @endif

      </ul>

    @yield('content')
</body>
</html>
