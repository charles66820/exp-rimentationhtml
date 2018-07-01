<?php
function requestpost($url, $data){
  $body = http_build_query($data);
  $opts = [
    'http' =>
    [
      'method'  => 'POST',
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n"."Content-Length: " . strlen($body) . "\r\n",
      'content' => $body,
      'timeout' => 60
    ]
  ];

  return file_get_contents($url, false, stream_context_create($opts), -1, 40000);
}



$url = "http://192.168.1.87/testpost.php";

echo requestpost($url, ["test" => "truc"]);
echo requestpost($url, ["test" => "yolo"]);
