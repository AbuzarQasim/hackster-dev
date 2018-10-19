@extends('layouts.admin')

@section('content')

    <h1 class="text-center">Edit Post</h1>

    <div class="row center-block">
        <div class="col-sm-6 col-lg-offset-4">


            <img height="70" src="{{$post->photo ? $post->photo->path : '/images/placeholder.jpg' }}" alt=""  class="img-rounded img-responsive">
        </div>
    </div>
    <div class="row" style="padding-top: 5%">

        <div class="col-sm-9 col-sm-offset-2">

            {!! Form::model ($post,['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id],'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('title','Title:')!!}
            {!! Form::text('title',null,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id','Category:')!!}
            {!! Form::select('category_id',$categories,$post->category_id,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id','Image:')!!}
            {!! Form::file('photo_id',['class'=>'form-control-file'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('body','Description:')!!}
            {!! Form::textarea('body',null,['class'=>'form-control', 'rows'=>10])!!}
        </div>


            <div class="form-group">
                {!! Form:: submit('Update User',['class'=>'btn btn-primary col-sm-2'])!!}
            </div>

            {!! Form::close() !!}





            {!! Form::open (['method' => 'DELETE', 'action'=> ['AdminPostsController@destroy',$post->id], 'class'=>'pull-right']) !!}

            <div class="form-group">
                {!! Form:: submit('Delete User',['class'=>'btn btn-danger col-sm-12'])!!}
            </div>

            {!! Form::close() !!}

    </div>
    <div class="row">
        @include('includes.errorReporting')
    </div>
@stop
