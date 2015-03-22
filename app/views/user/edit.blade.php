@extends('layout.default')

@section('content')

    {{ Form::model($user, array('route' => array('user.update',$user->id),'method'=>'put')) }}

    <li>
        {{ Form::label('email', 'your email')}}
        {{ Form::email('email') }}
        {{ $errors->first('email') }}
    </li>
    <li>
        {{ Form::label('password', 'your password')}}
        {{ Form::password('password') }}
        {{ $errors->first('password') }}
    </li>
    <li>
            {{ Form::label('active', 'Active ?')}}
            {{ Form::checkbox('active') }}
            {{ $errors->first('active') }}
        </li>
    <li>
        {{ Form::label('permission', 'your permission')}}
        {{ Form::select('permission',array('1'=>'webmaster','2'=>'Editor','3'=>'Member')) }}
        {{ $errors->first('permission') }}
    </li>
    <li>
        {{ Form::Submit('Save')}}

    </li>
    {{ Form::close() }}
@stop