<?php
function isValidePatch(string $patch) {
  if (stristr($patch, "../") || stristr($patch, "..\\") || strstr($patch, "*") || strstr($patch, "?")) {
    return false;
  } else if (strstr($patch, "\"") || strstr($patch, "<") ||strstr($patch, ">") || strstr($patch, "|")) {
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

function hasChildrenFolder(string $patch) {

}

function isValideName(string $name) {
  if (strstr($name, "\\") && strstr($name, "/") && strstr($name, ":") && strstr($name, "*") && strstr($name, "?")) {
    return false;
  } else if (strstr($name, "\"") && strstr($name, "<") && strstr($name, ">") && strstr($name, "|")) {
    return false;
  } else {
    return true;
  }
}
