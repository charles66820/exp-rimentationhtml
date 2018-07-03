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

function isValidePath(string $path) {
  if (stristr($path, "../") || stristr($path, "..\\") || strstr($path, "*") || strstr($path, "?")) {
    return false;
  } elseif (strstr($path, "\"") || strstr($path, "<") ||strstr($path, ">") || strstr($path, "|")) {
    return false;
  } else {
    return true;
  }
}

function isAuthorizedPath(string $path, array $homePaths) {
  $path = str_replace('\\', '/', $path);
  foreach ($homePaths as $homePath) {
    $homePath = str_replace('\\', '/', $homePath);
    $homePath = preg_replace('/\//i', '\\/', $homePath);
    if (preg_match('/^'.$homePath.'(.*)$/', $path)) {
      return true;
    }
  }
  return false;
}

function showFolders(string $path) {
  $open = opendir($path);
  $directories = [];
  while (($directory = readdir($open)) !== false){
    if (is_dir($path.$directory) && $directory != "." && $directory != ".."){
      array_push($directories, $directory);
    }
  }
  closedir($open);
  if (!empty($directories)){
    sort($directories);
    reset($directories);
  }
  return $directories;
}

function showFiles(string $path) {
  $open = opendir($path);
  $files = [];
  while (($file = readdir($open)) !== false){
    if (is_file($path.$file) && $file != "." && $file != ".."){
      array_push($files, $file);
    }
  }
  closedir($open);
  if (!empty($files)){
    sort($files);
    reset($files);
  }
  return $files;
}
