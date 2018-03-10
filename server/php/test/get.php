<?php
$categorie = '';

if (isset($_GET['categorie'])) {
  $categorie = "categorie=".$_GET['categorie']."&";
}else {
  $categorie = '';
}
?>
<a href="get.php?categorie=pop">star1</a>
<a href="get.php?categorie=poulpe">star1</a>
<br>
<br>
<a href="get.php?<?php echo $categorie ?>star=1">star1</a>
<a href="get.php?<?php echo $categorie ?>star=2">star2</a>
<a href="get.php?<?php echo $categorie ?>star=3">star3</a>
<a href="get.php?<?php echo $categorie ?>star=4">star4</a>
