 @extends('layout.default')
  @section('content')
  <p>{{{ $user->email or 'default value' }}}</p>
  @stop

  @section('sidebar')
  @parent
    <p> <a href="#">Some Links</a> </p>
    <p> <a href="#">Some Links</a> </p>
    <p> <a href="#">Some Links</a> </p>

    @stop