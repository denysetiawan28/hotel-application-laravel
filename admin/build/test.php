<?php
use Aura\Http\Message\Request;
$request->setUrl('http://example.com/submit.php');
$request->setMethod(Request::METHOD_POST);
$request->setContent(json_encode(['hello' => 'world']));
$request->headers->set('Content-Type', 'application/json');
$stack = $http->send($request);
print_r($request);
?>