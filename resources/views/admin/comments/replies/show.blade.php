@extends('layouts.admin')

@section('content')




    @if(count($replies)>0)
        <h1>Replies</h1>

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Author</th>
                <th scope="col">Email</th>
                <th scope="col">Body</th>
                <th scope="col">Post</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <th scope="row">{{$reply->id}}</th>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td><a href="{{route('home.posts',$reply->comment->post->id)}}">View post</a></td>

                    <td>

                        @if($reply->is_active==1)


                            {!! Form::open (['method' => 'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="0">


                            <div class="form-group">
                                {!! Form:: submit('Decline',['class'=>'btn btn-info'])!!}
                            </div>

                            {!! Form::close() !!}

                        @else


                            {!! Form::open (['method' => 'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="1">


                            <div class="form-group">
                                {!! Form:: submit('Approve',['class'=>'btn btn-success'])!!}
                            </div>

                            {!! Form::close() !!}
                        @endif


                    </td>
                    <td>




                        {!! Form::open (['method' => 'DELETE', 'action'=> ['CommentRepliesController@destroy', $reply->id]]) !!}




                        <div class="form-group">
                            {!! Form:: submit('Delete',['class'=>'btn btn-danger'])!!}
                        </div>

                        {!! Form::close() !!}


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3 class="text-center">No replies</h3>
    @endif
@stop