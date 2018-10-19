@extends('layouts.admin')


@section('content')

    <h1> Edit Categories </h1>
    <div class="row">


    <div class="col-sm-6">

        {!! Form::model ($category,['method' => 'PATCH', 'action'=> ['AdminCategoryController@update',$category->id]]) !!}

        <div class="form-group">
        {!! Form::label('name','Title:')!!}
        {!! Form::text('name',null,['class'=>'form-control'])!!}
    </div>


    <div class="form-group">
        {!! Form:: submit('update Category',['class'=>'btn btn-primary col-sm-3'])!!}
    </div>

    {!! Form::close() !!}



        {!! Form::open (['method' => 'DELETE', 'action'=> ['AdminCategoryController@destroy',$category->id], 'class'=>'pull-right']) !!}

        <div class="form-group">
            {!! Form:: submit('Delete User',['class'=>'btn btn-danger col-sm-12'])!!}
        </div>

        {!! Form::close() !!}


    </div>



    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-offset-3">
            @include('includes.errorReporting')
        </div>

    </div>

@stop