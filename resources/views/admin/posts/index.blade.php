@extends('layouts.admin')

@section('content')
  @if(Session::has('deleted_user'))
    <p class="bg-danger text-center">{{session('deleted_user')}}</p>

  @elseif(Session::has('updated_user'))
    <p class="bg-primary">{{session('updated_user')}}</p>
  @elseif(Session::has('created_user'))
    <p class="bg-success">{{session('created_user')}}</p>
  @endif
<h1 class="text-center">Posts</h1>

    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Photo</th>
          <th scope="col">Owner</th>
            <th scope="col">Category</th>

            <th scope="col">Title</th>
            <th scope="col">Content</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
        </tr>
      </thead>
      <tbody>

      @if($posts)

           @foreach($posts as $post)
        <tr>
          <th scope="row">{{$post->id}}</th>
          <td><img height="60" src="{{$post->photo ? $post->photo->path : '/images/avatar-male.jpg' }}" alt="" >  </td>
          <td>{{$post->user->name}}</td>
            <td>{{ $post->category ? $post->category->name : 'Uncategorized'}}</td>

          <td>{{$post->title}}</td>
          <td>{{$post->body}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
        </tr>
             @endforeach
        @endif

      </tbody>
    </table>
@stop


