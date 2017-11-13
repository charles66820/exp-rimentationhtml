<?php
if (isset($_GET["upload"])) {
  $name = $_FILES["file"]["name"];
  $path = "./";
  $uploadOk = 1;
  while (file_exists($path.$name)) {
    $name = $name+"1";
  }
  if ($_FILES["file"]["size"] > 5000000) {
    echo 'error';
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    echo 'error';
  } else if (@move_uploaded_file($_FILES["file"]["tmp_name"], $path.$name)) {
    echo basename($name);
  } else {
    echo 'error';
  }
}
?>
