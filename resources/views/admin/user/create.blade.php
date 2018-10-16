@extends('layouts.admin')



@section('content')

    <h1> Create User</h1>

    {!! Form::open (['method'=>'POST','action'=>'AdminUsersController@store','files'=>true]) !!}


        <div class="form-group">
                {!! Form::label('name','Name:')!!}
                {!! Form::text('name',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
                {!! Form::label('email','Email:')!!}
                {!! Form::email('email',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
                {!! Form::label('is_active','Status:')!!}
                {!! Form::select('is_active',array(1=>'Active', 0=>'Inactive'),0,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
                {!! Form::label('role_id','Role:')!!}
                {!! Form::select('role_id',[''=>'Select Role']+$roles,null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('file','Image:')!!}
            {!! Form::file('file',null,['class'=>'form-control form-control-file'])!!}
        </div>


        <div class="form-group">
            {!! Form::label('password','Password:')!!}
            {!! Form::password('password',['class'=>'form-control .awesome'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation','Confirm Password:')!!}
            {!! Form::password('password_confirmation',['class'=>'form-control'])!!}
        </div>


        <div class="form-group">
        {!! Form:: submit('Create User',['class'=>'btn btn-primary'])!!}
        </div>

        {!! Form::close() !!}





        @include('includes.errorReporting')
    {{--one way of doing error reporting is below other is include--}}
        {{--@if(count($errors)>0)--}}

            {{--<div class="alert alert-danger">--}}

                {{--<ul>--}}
                    {{--@foreach($errors->all() as $error)--}}

                        {{--<li>{{$error}}</li>--}}

                    {{--@endforeach--}}

                {{--</ul>--}}

            {{--</div>--}}

        {{--@endif--}}


@stop