@extends('layouts.admin')


@section('content')
<h1> USERS</h1>

    <table class="table">
      <thead class=".thead-dark">
        <tr>
          <th scope="col">#</th>
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
            <td>{{$user->name}}</td>
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