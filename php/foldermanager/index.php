<?php
include 'exploreurFunction.php';

$list = ["C://", "/mnt/", "/"];

if (isset($_GET["path"])) {
  $path = $_GET["path"];
  if (!isValidePath($path)) {
    echo "erreur chars <br>";
    echo $path.'<br>';
  } else {
    $path = str_replace('\\', '/', $path);
    echo $path.'<br>';
    if (isAuthorizedPath($path, (array)$list)) {
      if (file_exists($path)) {
        $folders = showFolders($path);
        if ($folders) {
          foreach ($folders as $folder) {
            echo $folder.'<br>';
          }
        } else {
          echo "folder not containe folders<br>";
        }
        $files = showFiles($path);
        if ($files) {
          foreach ($files as $file) {
            echo $file.'<br>';
          }
        } else {
          echo "folder not containe files<br>";
        }
      } else {
        echo "folder not exists<br>";
      }
    } else {
      echo "not autorized<br>";
    }
  }
}
?>
<form action="" method="get">
  <input type="text" name="path" value="<?php echo isset($_GET["path"])?$path:"" ?>">
  <input type="submit" name="" value="valider">
</form>
<br>
