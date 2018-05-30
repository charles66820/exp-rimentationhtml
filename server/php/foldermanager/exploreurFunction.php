<?php
function isValidePatch(string $patch) {
  if (stristr($patch, "../") || stristr($patch, "..\\") || strstr($patch, "*") || strstr($patch, "?")) {
    return FALSE;
  } else if (strstr($patch, "\"") || strstr($patch, "<") ||strstr($patch, ">") || strstr($patch, "|")) {
    return FALSE;
  } else {
    return TRUE;
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
  if (strstr($name, "\\")) {
    return FALSE;
  } else if (strstr($name, "/")) {
    return FALSE;
  } else if (strstr($name, ":")) {
    return FALSE;
  } else if (strstr($name, "*")) {
     return FALSE;
   } else if (strstr($name, "?")) {
    return FALSE;
  } else if (strstr($name, "\"")) {
     return FALSE;
   } else if (strstr($name, "<")) {
    return FALSE;
  } else if (strstr($name, ">")) {
    return FALSE;
  } else if (strstr($name, "|")) {
    return FALSE;
  } else {
    return TRUE;
  }
}
