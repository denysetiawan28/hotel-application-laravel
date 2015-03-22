@extends('layout.default')

@section('content')
    @if(count($users))
      @foreach($users as $user)
      <p><strong>{{{ $user->title }}}</strong> by {{{ $user->email }}}</p>
      @endforeach
    @endif
@stop