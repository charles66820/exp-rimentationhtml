<?php
include 'exploreurFunction.php';

$list = ["test", "//127.0.0.1/", "//10.0.43.4/toto/"];

if (isset($_GET["patch"])) {
  $patch = $_GET["patch"];
  if (!isValidePatch($patch)) {
    echo "erreur chars <br>";
    echo $patch.'<br>';
  } else {
    echo $patch.'<br>';
    if (isAuthorizedPatch($patch, (array)$list)) {
    } else {
      echo "not autorized";
    }
  }
}
?>
<form action="" method="get">
  <input type="text" name="patch" value="<?php echo isset($_GET["patch"])?$patch:"" ?>">
  <input type="submit" name="" value="valider">
</form>
<br>
