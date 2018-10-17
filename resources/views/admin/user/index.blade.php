@extends('layouts.admin')


@section('content')

    @if(Session::has('deleted_user'))
        <p class="bg-danger">{{session('deleted_user')}}</p>

        @elseif(Session::has('updated_user'))
        <p class="bg-primary">{{session('updated_user')}}</p>
        @elseif(Session::has('created_user'))
        <p class="bg-success">{{session('created_user')}}</p>
    @endif
<h1> USERS</h1>

    <table class="table">
      <thead class=".thead-dark">
        <tr>
          <th scope="col">#</th>
            <th scope="col">Photo</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Status</th>
          <th scope="col">Date Created</th>
          <th scope="col">Updated</th>

          {{--<th scope="col">Handle</th>--}}
        </tr>
      </thead>
      <tbody>

      @if($users)

          @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td><img height="60" src="{{$user->photo ? $user->photo->path : '/images/avatar-male.jpg' }}" alt="" >  </td>
            <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>
                {{$user->is_active ==1 ? 'Active': 'Inactive'}}

                {{--this is another way of displaying the user status--}}
                {{--@if($user->is_active ==1)--}}
                {{--Active--}}
                {{--@else--}}
                {{--Inactive--}}

                {{--@endif--}}



            </td>
            {{--diffForHumans is used to get time as 20 hours ago etc--}}
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>

        </tr>
        @endforeach
          @endif
      </tbody>
    </table>


@stop