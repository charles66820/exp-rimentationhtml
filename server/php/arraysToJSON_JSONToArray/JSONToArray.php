<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>JSONToArray</title>
  </head>
  <body>
    <?php
    echo $_POST['fruitsJSON'];
    $arr = json_decode($_POST['fruitsJSON'], true);
    echo $arr[3];
    echo json_encode($arr, true)."<br>";
    array_splice($arr, 2, 1);
    echo json_encode($arr, true)."<br>";
    ?>
  </body>
</html>
