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
    ?>
  </body>
</html>
