@extends('layouts.admin')

@section('content')

<h1>Media</h1>


@if($photos)

    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
             <th scope="col">Photo</th>
            <th scope="col">Created</th>
          <th scope="col">Updated</th>
        </tr>
      </thead>
      <tbody>
      @foreach($photos as $photo)

        <tr>
          <th scope="row">{{$photo->id}}</th>
          <td>{{$photo->path}}</td>
            <td><img height="60" src="{{$photo ? $photo->path : '/images/avatar-male.jpg' }}" alt="" ></td>
            <td>{{$photo->created_at->diffForHumans()}}</td>
          <td>{{$photo->updated_at->diffForHumans()}}</td>
          <td>


            {!! Form::open (['method' => 'DELETE', 'action'=> ['AdminMediaController@destroy',$photo->id]]) !!}

                <div class="form-group">
                {!! Form:: submit('Delete',['class'=>'btn btn-danger'])!!}
                </div>

                {!! Form::close() !!}



          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    @endif
@stop