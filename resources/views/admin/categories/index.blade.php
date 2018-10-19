@extends('layouts.admin')


@section('content')

    <h1> Categories </h1>

    <div class="col-sm-6">

    {!! Form::open (['method' => 'POST', 'action'=> 'AdminCategoryController@store']) !!}

        <div class="form-group">
                {!! Form::label('name','Title:')!!}
                {!! Form::text('name',null,['class'=>'form-control'])!!}
        </div>


        <div class="form-group">
        {!! Form:: submit('Create Category',['class'=>'btn btn-success'])!!}
        </div>

        {!! Form::close() !!}


    </div>

    <div class="col-sm-6">

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
            </tr>
            </thead>
            <tbody>
            @if($categories)
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td><a href="{{route('admin.categories.edit',$category->id)}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans(): 'no Date'}}</td>
                        <td>{{$category->updated_at ? $category->updated_at->diffForHumans(): 'no Date'}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>




    </div>


@stop