<!--This is a blade template that goes in email message to site administrator-->
<?php
//get the first name
$name = Input::get('con-fullname');
$email = Input::get ('con-email');
$subject = Input::get ('con-subject');
$message = Input::get ('con-message');
date_default_timezone_set('UTC');
$date_time = date("d-m-o, h:i:s");

$userIpAddress = Request::getClientIp();
?> 

<h1>We been contacted by.... </h1> </br>

<h4> Name : {{ $name }} </h4> </br>
<h4> Email address : {{ $email }} </h4> </br>
<h4> Subject : {{ $subject }} </h4> </br>

<h4> Message: </h4>
<p> {{ $message }} </p>

<h4> Date: {{ $date_time }} </h4> </br>
<h4> User IP address: {{ $userIpAddress }} </h4>