<?php
function isValideName(string $name) {
  if (strstr($name, "\\") && strstr($name, "/") && strstr($name, ":") && strstr($name, "*") && strstr($name, "?")) {
    return false;
  } else if (strstr($name, "\"") && strstr($name, "<") && strstr($name, ">") && strstr($name, "|")) {
    return false;
  } else {
    return true;
  }
}

function isValidePatch(string $patch) {
  if (stristr($patch, "../") || stristr($patch, "..\\") || strstr($patch, "*") || strstr($patch, "?")) {
    return false;
  } elseif (strstr($patch, "\"") || strstr($patch, "<") ||strstr($patch, ">") || strstr($patch, "|")) {
    return false;
  } else {
    return true;
  }
}

function isAuthorizedPatch(string $patch, array $homePatchs) {
  foreach ($homePatchs as $homePatch) {
    $patch = str_replace('\\', '/', $patch);
    $homePatch = str_replace('\\', '/', $homePatch);
    $homePatch = preg_replace('/\//i', '\\/', $homePatch);
    if (preg_match('/^'.$homePatch.'(.*)$/', $patch)) {
      return true;
    }
  }
  return false;
}

function showFolders(string $patch) {
  $open = opendir($patch);
  $directories = [];
  while (($directory = readdir($open)) !== false){
    if (is_dir($patch.$directory) && $directory != "." && $directory != ".."){
      array_push($directories, $directory);
    }
  }
  closedir($open);
  if (!empty($directories)){
    sort($directories);
    reset($directories);
    return $directories;
  } else {
    return false;
  }
}

function showFiles(string $patch) {
  $open = opendir($patch);
  $files = [];
  while (($file = readdir($open)) !== false){
    if (is_file($patch.$file) && $file != "." && $file != ".."){
      array_push($files, $file);
    }
  }
  closedir($open);
  if (!empty($files)){
    sort($files);
    reset($files);
    return $files;
  } else {
    return false;
  }
}
