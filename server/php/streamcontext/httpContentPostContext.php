<?php

$data = ["test" => "truc"];

$body = http_build_query ($data);

$opts = array('http' =>
  array(
    'method'  => 'POST',
    'header'  => "Content-type: application/x-www-form-urlencoded\r\n"
	. "Content-Length: " . strlen($body) . "\r\n",
    'content' => $body,
    'timeout' => 60
  )
);

$context  = stream_context_create($opts);
$url = "http://192.168.1.87/testpost.php";
$result = file_get_contents($url, false, $context, -1, 40000);

echo $result;
