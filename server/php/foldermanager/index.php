<?php
include 'exploreurFunction.php';

$list = ["C://", "/mnt/", "/"];

if (isset($_GET["patch"])) {
  $patch = $_GET["patch"];
  if (!isValidePatch($patch)) {
    echo "erreur chars <br>";
    echo $patch.'<br>';
  } else {
    echo $patch.'<br>';
    if (isAuthorizedPatch($patch, (array)$list)) {
      if (file_exists($patch)) {
        $folders = showFolders($patch);
        if ($folders) {
          foreach ($folders as $folder) {
            echo $folder.'<br>';
          }
        } else {
          echo "folder not containe folders<br>";
        }
        $files = showFiles($patch);
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
  <input type="text" name="patch" value="<?php echo isset($_GET["patch"])?$patch:"" ?>">
  <input type="submit" name="" value="valider">
</form>
<br>
