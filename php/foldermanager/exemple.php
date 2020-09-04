<?php
if (isset($_GET["path"])){
  if (stristr($_GET["path"], "../") || stristr($_GET["path"], "..\\")){

  }else{
    $path = urldecode($_GET["path"]);
  }
}

//config
$home_directory = "/testbox/";

//active
if (isset($_GET["scanfolder"])) {
  if ($open = @opendir($home_directory.$path)){
    for($i=0;($directory = readdir($open)) != FALSE;$i++){
      if (is_dir($home_directory.$path.$directory) && $directory != "." && $directory != "..")
      $directories[$i] = array($directory,$directory);
      closedir($open);
      if (isset($directories)){
        sort($directories);
        reset($directories);
      }
    }
  }
  print '<br>'.rawurlencode(dirname($path)).'<br>';
  if (isset($directories))
    foreach($directories as $directory) {
    print $directory[0] .'<br>';
  }
}

// if (isset($_GET["rename"])&&isset($_GET["path"])&&isset($_GET["newname"])){
//   if ($_SESSION['name']=="charles"){
//     $newname = $_GET["newname"];
//     if (!is_valid_name(substr($newname, 0, -1))){
//       print '<div class="notif notif_error">le nom du dossier ne dois pas contenir les sybole suivant : / : ? * \ < > | </div>';
//     } else if (@file_exists($home_directory.dirname($path).$newname)){
//       print '<div class="notif notif_error">un dossier avec le même nom existe déjà</div>';
//     } else if (@rename($home_directory.$path, $home_directory.dirname($path)."/".$newname)){
//       print '<div class="notif notif_success">le dossier a été renommé avec succès</div>';
//     } else {
//       print '<div class="notif notif_error">rename fail</div>';
//     }
//   } else {
//     print '<div class="notif notif_error"> vous n\'avait pas le droit de renommé ce dossier/fichier</div>';
//   }
// }

// function remove_directory($directory){
//   $list_sub = array();
//   $list_files = array();
//
//   if (!($open = opendir($directory."/"))){
//     return FALSE;
//   }
//
//   while(($index = readdir($open)) != FALSE){
//     if (is_dir($directory."/".$index) && $index != "." && $index != ".."){
//       $list_sub[] = $index."/";
//     } else if (is_file($directory."/".$index)){
//       $list_files[] = $index;
//     }
//   }
//
//   closedir($open);
//
//   foreach($list_files as $file) {
//     if (!unlink($directory."/".$file)){
//       return FALSE;
//     }
//   }
//
//   foreach($list_sub as $sub){
//     remove_directory($directory."/".$sub);
//     if (!rmdir($directory."/".$sub)){
//       return FALSE;
//     }
//   }
//   return TRUE;
// }
?>
