@extends('layouts.admin')



@section('content')

    <h1> Edit User</h1>

    <div class="row">
            <div class="col-sm-2">


                <img height="60" src="{{$user->photo ? $user->photo->path : '/images/avatar-male.jpg' }}" alt=""  class="img-rounded img-responsive">
            </div>

            <div class="col-sm-9">

            {!! Form::model ($user,['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}


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
                {!! Form::select('is_active',array(1=>'Active', 0=>'Inactive'),$user->is_active,['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
                {!! Form::label('role_id','Role:')!!}
                {!! Form::select('role_id',$roles,$user->role_id,['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
                {!! Form::label('file','Image:')!!}
                {!! Form::file('photo_id',null,['class'=>'form-control form-control-file'])!!}
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
                {!! Form:: submit('Update User',['class'=>'btn btn-primary'])!!}
            </div>

            {!! Form::close() !!}

            </div>
    </div>
        <div class="row">
                            <div class="col-sm-6 col-lg-offset-3">
                                @include('includes.errorReporting')
                            </div>

        </div>
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