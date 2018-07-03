<?php
session_start();
if (isset($_GET["logout"])){
  session_destroy();
  echo '<div class="notif notif_success">vous êtes bien déconnecter</div>';
}
if (isset($_POST["username"])){
  $conn = mysqli_connect('localhost', 'usertest', '123456', 'karpdata');
  if (mysqli_connect_error()){
    echo '<div class="notif notif_error">Failed to connect to MySQL: '.mysqli_connect_error().'</div>';
  }
  $sql = "SELECT * FROM users WHERE uid='".$_POST['username']."' AND pwd='".$_POST['password']."'";
  $result = mysqli_query($conn, $sql);
  if (!$row = mysqli_fetch_assoc($result)){
    echo '<div class="notif notif_error">l\'utilisateur ou le mots de passe est incorrect</div>';
  } else {
    $_SESSION['name'] = $row['uid'];
    echo '<div class="notif notif_success">vous êtes connecté '.$_SESSION["name"].'</div>';
  }
}
if (isset($_GET["logstatue"])){
  if ($_SESSION["name"]) {
    echo TRUE;
  }
}
if (!isset($_SESSION["name"])){
  if (isset($_GET["scanfolder"])||$_GET["scanfile"]){
    echo "you are not conected";
  }
}else {
  if (isset($_GET["path"])){
    if (stristr($_GET["path"], "../") || stristr($_GET["path"], "..\\")){
    }else{
      $path = urldecode($_GET["path"]);
    }
  }
  //config
  $ViewableFiles = "jpeg jpe jpg gif png bmp";
  $EditableFiles = "txt  json cfg html js java log php xml";
  $home_directory = "/testbox/";

  $IconArray = array(
      "text.gif"       => "txt ini xml xsl ini inf cfg log nfo",
      "layout.gif"     => "html htm shtml htm pdf",
      "script.gif"     => "php php4 php3 phtml phps conf sh shar csh ksh tcl cgi pl js",
      "image.gif"      => "jpeg jpe jpg gif png bmp",
      "compressed.gif" => "zip tar gz tgz z ace rar arj cab bz2",
      "sound.gif"      => "wav mp1 mp2 mp3 mid",
      "movie.gif"      => "mpeg mpg mov avi rm",
      "binary.gif"     => "exe com dll bin dat rpm deb",
    );


//active
if (isset($_GET["scanfolder"])) {
  if ($open = @opendir($home_directory.$path)){
    for($i=0;($directory = readdir($open)) != FALSE;$i++)
      if (is_dir($home_directory.$path.$directory) && $directory != "." && $directory != "..")
        $directories[$i] = array($directory,$directory);
        closedir($open);
      if (isset($directories)){
        sort($directories);
        reset($directories);
      }
  }
  print '<div class="elm"><div class="chit" b_folder=" " name="'.htmlentities(rawurlencode(dirname($path))).'"></div><img src="assets/icon/folder.gif" class="icon"><p class="elm_t">..</p></div>';
  if (isset($directories)) foreach($directories as $directory){
    print '<div class="elm"><div class="chit chit_folder" folder=" " name="'.htmlentities($directory[0]).'"></div><img src="assets/icon/folder.gif" class="icon"><p class="elm_t">'.htmlentities($directory[0]).'</p></div>';
  }
}

if (isset($_GET["scanfile"])) {
  if ($open = @opendir($home_directory.$path)){
    for($i=0;($file = readdir($open)) != FALSE;$i++)
    if (is_file($home_directory.$path.$file)){
      $icon = get_icon($file);
      $filesize = filesize($home_directory.$path.$file);
      $permissions = decoct(fileperms($home_directory.$path.$file)%01000);
      $modified = filemtime($home_directory.$path.$file);
      $extension = pathinfo($home_directory.$path.$file)['extension'];
      $files[$i] = array(
                         "icon"        => $icon,
                         "filename"    => $file,
                         "filesize"    => $filesize,
                         "permissions" => $permissions,
                         "modified"    => $modified,
                         "extension"   => $extension,
                       );
    }
   closedir($open);

   if (isset($files)){
    sort($files);
    reset($files);
   }
  }
  if (isset($files)) foreach($files as $file){
    /*$file['modified'] = date("H:i m-d-Y", $file['modified']);
    $file['filesize'] = $file['filesize']."o";
    //add this : ' : '.$file['filesize'].' : '.$file['permissions'].' : '.$file['modified'].*/
    print '<div class="elm"><div class="chit chit_file" name="'.htmlentities($file['filename']).'"></div><img src="assets/icon/'.$file['icon'].'" class="icon"><p class="elm_t">'.htmlentities($file['filename']).'</p></div>';
  }
}
if (isset($_GET["rename"])&&isset($_GET["path"])&&isset($_GET["newname"])) {
  if ($_SESSION['name']=="charles") {
    $newname = $_GET["newname"];
    if (!is_valid_name(substr($newname, 0, -1)))
    print '<div class="notif notif_error">le nom du dossier ne dois pas contenir les sybole suivant : / : ? * \ < > | </div>';
    else if (@file_exists($home_directory.dirname($path).$newname))
    print '<div class="notif notif_error">un dossier avec le même nom existe déjà</div>';
    else if (@rename($home_directory.$path, $home_directory.dirname($path)."/".$newname))
    print '<div class="notif notif_success">le dossier a été renommé avec succès</div>';
    else{
      print '<div class="notif notif_error">rename fail</div>';
    }
  }else {
    print '<div class="notif notif_error"> vous n\'avait pas le droit de renommé ce dossier/fichier</div>';
  }
}
if (isset($_GET["create"])&&isset($_GET["path"])&&isset($_GET["create_name"])) {
  $create_name = $_GET["create_name"];
  if (!is_valid_name(substr($create_name, 0, -1)))
  print '<div class="notif notif_error">le nom du dossier ne dois pas contenir les sybole suivant : / : ? * \ < > | </div>';
  else if (@file_exists($home_directory.dirname($path)."/".$create_name))
   print '<div class="notif notif_error">un dossier avec le même nom existe déjà</div>';
  else if (@mkdir($home_directory.$path.$create_name))
   print '<div class="notif notif_success">le dossier a été créer avec succès</div>';
  else{
   print '<div class="notif notif_error">create folder fail</div>';
  }
}
if (isset($_GET["delete"]) && isset($_GET["path"])){
  if ($_SESSION['name']=="charles") {
    if ($_GET["path"] == "../" || ($_GET["path"] == "./"))
      print '<div class="notif notif_error">le nome du dossier a supprimer est invalide</div>';
    else if (!file_exists($home_directory.$path))
      print '<div class="notif notif_error">le dossier a supprimer n\'a pas était trouver</div>';
    else if (remove_directory($home_directory.$path) && @rmdir($home_directory.$path))
      print '<div class="notif notif_success">le dossier a été supprimer avec succès</div>';
    else{
      print '<div class="notif notif_error">remove fail</div>';
    }
  }else {
    print '<div class="notif notif_error"> vous n\'avait pas le droit de supprimer le dossier</div>';
  }
}
if (isset($_GET["download"]) && isset($_GET["path"])) {
  $filename = urldecode($_GET['fpath']);
  header("Content-Type: ".get_mimetype($filename));
  header("Content-Length: ".filesize($home_directory.$path));
  if ($_GET['download']==null){
   header("Content-Disposition: attachment; filename=$filename");
   readfile($home_directory.$path);
 }
}
if (isset($_GET["create_f"])&&isset($_GET["path"])&&isset($_GET["create_name"])) {
  $create_name = $_GET["create_name"];
  if (!is_valid_name(substr($create_name, 0, -1)))
  print '<div class="notif notif_error">le nom du fichier ne dois pas contenir les sybole suivant : / : ? * \ < > | </div>';
  else if (@file_exists($home_directory.$path.$create_name))
   print '<div class="notif notif_error">un fichier avec le même nom existe déjà</div>';
  else if (@fopen($home_directory.$path.$create_name, "w+"))
   echo '<div class="notif notif_success">le fichier a été créer avec succès</div>';
  else{
   print '<div class="notif notif_error">create file fail</div>';
  }
}
if (isset($_GET["delete_f"]) && isset($_GET["path"])){
  if ($_SESSION['name']=="charles") {
    if ($_GET["path"] == "../" || ($_GET["path"] == "./"))
    print '<div class="notif notif_error">le nome du fichier a supprimer est invalide</div>';
    else if (!file_exists($home_directory.$path))
    print '<div class="notif notif_error">le fichier a supprimer n\'a pas était trouver</div>';
    else if (@unlink($home_directory.$path))
    print '<div class="notif notif_success">le fichier a été supprimer avec succès</div>';
    else{
      print '<div class="notif notif_error">remove fail</div>';
    }
  }else {
    print '<div class="notif notif_error"> vous n\'avait pas le droit de supprimer le fichier</div>';
  }
}
if (isset($_GET["property"]) && isset($_GET["path"])){
  $filesize = filesize($home_directory.$path);
  $permissions = decoct(fileperms($home_directory.$path)%01000);
  $modified = filemtime($home_directory.$path);
  $extension = pathinfo($home_directory.$path)['extension'];
print '<div class="p_elm p_name">name : '.$path.'</div><div class="p_elm p_size">size : '.$filesize.'o</div><div class="p_elm p_date">last modified date : '.date("H:i m-d-Y", $modified).'</div><div class="p_elm p_permissions">permissions : '.$permissions.'</div>';
}
if (isset($_GET["open"]) && isset($_GET["path"])) {
  if (is_file($home_directory.$path.urldecode($_GET["tname"])) && viewable_file($_GET["tname"])){
    print '<div id="modali">
      <div id="submodal">
        <img onload="zoom()" id="openimg" src="assets/MSFF.php?img&path='.$_GET["path"].'&tname='.$_GET["tname"].'">
      </div>
      <h2 id="h2">x</h2>
      <img id="dli" src="assets/icon/dlicon.svg"></img>
      <div id="zoom">
        <div id="zoomIn" class="btnz">zoomIn</div>
        <div id="zoomOut" class="btnz">zoomOut</div>
        <input id="zoomval" class="btnz" type="number" value="">
      </div>
      <div id="gre1"></div>
    </div>
    <script>
    var size;
    $("#dli").on("click", function() {
      $("#dl").attr("src", "assets/MSFF.php?download&path="+path+tname+"&fpath="+tname);
    });
    $("#zoomIn").on("click", function() {
      zoomIn();
    });
    $("#zoomOut").on("click", function() {
      zoomOut();
    });
    $("#h2").on("click", function() {
      $("#modali").hide();
    });
    function zoom() {
      if (document.getElementById("openimg").naturalWidth>1000||document.getElementById("openimg").naturalHeight>650) {
        size = 55;
      }else if (document.getElementById("openimg").naturalWidth>500||document.getElementById("openimg").naturalHeight>325) {
        size = 80;
      }else if (document.getElementById("openimg").naturalWidth<500||document.getElementById("openimg").naturalHeight<325) {
        size = 100;
      }
      zoomr();
      zoomval();
    }
    function zoomIn() {
      size = Number(size);
      size-=10;
      zoomr();
      zoomval();
    }
    function zoomOut() {
      size = Number(size);
      size+=10;
      zoomr();
      zoomval();
    }
    function zoomval(){
      $("#zoomval").val(size);
    }
    $("#zoomval").on ("keydown", function(e) {
      if(e.keyCode == 13) {
        size = this.value;
        zoomr();
        zoomval();
      }
    });
    function zoomr(){
      document.getElementById("openimg").width = document.getElementById("openimg").naturalWidth*size/100;
      document.getElementById("openimg").height = document.getElementById("openimg").naturalHeight*size/100;
    }
    </script>';
  }else if (is_file($home_directory.$path.urldecode($_GET["tname"])) && editable_file($_GET["tname"])) {
    print '<div id="modali">
      <div id="submodal">
        <textarea id="fedit" cols=110 rows=100></textarea>
      </div>
      <img onload="op()" id="dli" src="assets/icon/dlicon.svg"></img>
      <div id="save">save</div>
      <div id="gre1"></div>
    </div>
    <script>
    function op(){
      $("#fedit").load("assets/MSFF.php?edit&path="+path+tname);
      $("#modali").show();
    }
    var text;
    $("#save").on ("click", function() {
      text = encodeURIComponent($("#fedit").val());
      $("#notif").load("assets/MSFF.php?save&path="+path+tname+"&text="+text);
      $("#modali").hide();
    });
    $("#dli").onclick = function() {
      $("#dl").attr("src", "assets/MSFF.php?download&path="+path+tname+"&fpath="+tname);
    }
    </script>';
  }else {
    echo '<script>window.open("assets/MSFF.php?openf&path='.$_GET["path"].'&tname='.$_GET["tname"].'");</script>';
  }
}
if (isset($_GET["img"]) && isset($_GET["path"])) {
  $filename = $_GET['tname'];
  header("Content-Type: ".get_mimetype($filename));
  header("Content-Length: ".filesize($home_directory.$path.$filename));
   readfile($home_directory.$path.$filename);
}
if (isset($_GET["openf"]) && isset($_GET["path"])) {
  $filename = urldecode($_GET['tname']);
  header("Content-Type: ".get_mimetype($filename));
  header("Content-Length: ".filesize($home_directory.$path.$filename));
  readfile($home_directory.$path.$filename);
}
if (isset($_GET["upload"]) && isset($_GET["path"])) {
  $target_file = $home_directory.$path . basename($_FILES["file"]["name"]);
  $uploadOk = 1;
  if (file_exists($target_file)) {
    echo '<div class="notif notif_error">Sorry, file already exists.'.basename($_FILES["file"]["name"]).'</div>';
    $uploadOk = 0;
  }
  if ($_FILES["file"]["size"] > 50000000000) {
    echo '<div class="notif notif_error">Sorry, your file is too large.</div>';
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    echo '<div class="notif notif_error">Sorry, your file was not uploaded.</div>';
  } else if (@move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo '<div class="notif notif_success">The file '. basename( $_FILES["file"]["name"]).' has been uploaded.</div>';
  } else {
    echo '<div class="notif notif_error">Sorry, there was an error uploading your file. error code :'.$_FILES["file"]["error"].'</div>';
  }
}
if (isset($_GET["edit"]) && isset($_GET["path"])){
  if ($fp = @fopen($home_directory.$path, "rb")){
    print htmlentities(fread($fp, filesize($home_directory.$path)));
    fclose ($fp);
  }else {
    echo '<div class="notif notif_error">edit fail</div>';
    }
  }
  if (isset($_GET["save"]) && isset($_GET["path"]) && isset($_GET["text"])){
  $text = $_GET['text'];
  if ($fp = @fopen ($home_directory.$path, "wb")){
    fwrite($fp, $text);
    fclose($fp);
    echo '<div class="notif notif_success">save succéce</div>';
  }else {
    echo '<div class="notif notif_error">error to save</div>';
    }
  }
}
//function
function get_icon($filename){
 global $IconArray;

 reset($IconArray);

 $extension = strtolower(substr(strrchr($filename, "."),1));

 if ($extension == "")
  return "unknown.gif";

 while (list($icon, $types) = each($IconArray))
  foreach (explode(" ", $types) as $type)
   if ($extension == $type)
    return $icon;

 return "unknown.gif";
}
function is_valid_name($input){
 if (strstr($input, "\\"))
  return FALSE;
 else if (strstr($input, "/"))
  return FALSE;
 else if (strstr($input, ":"))
  return FALSE;
 else if (strstr($input, "?"))
  return FALSE;
 else if (strstr($input, "*"))
  return FALSE;
 else if (strstr($input, "\""))
  return FALSE;
 else if (strstr($input, "<"))
  return FALSE;
 else if (strstr($input, ">"))
  return FALSE;
 else if (strstr($input, "|"))
  return FALSE;
 else
  return TRUE;
}
function remove_directory($directory){
 $list_sub = array();
 $list_files = array();

 if (!($open = opendir($directory."/")))
  return FALSE;

 while(($index = readdir($open)) != FALSE){
  if (is_dir($directory."/".$index) && $index != "." && $index != "..")
   $list_sub[] = $index."/";
  else if (is_file($directory."/".$index))
   $list_files[] = $index;
 }

 closedir($open);

 foreach($list_files as $file)
  if (!unlink($directory."/".$file))
   return FALSE;

 foreach($list_sub as $sub){
  remove_directory($directory."/".$sub);
  if (!rmdir($directory."/".$sub))
   return FALSE;
 }
 return TRUE;
}
function viewable_file($filename){
 global $ViewableFiles;
 $extension = strtolower(substr(strrchr($filename, "."),1));
 foreach(explode(" ", $ViewableFiles) as $type)
  if ($extension == $type)
   return TRUE;
 return FALSE;
}
function editable_file($filename){
 global $EditableFiles;
 $extension = strtolower(substr(strrchr($filename, "."),1));
 foreach(explode(" ", $EditableFiles) as $type)
  if ($extension == $type)
   return TRUE;
 return FALSE;
}
function get_mimetype($filename){
 reset($MIMEtypes);

 $extension = strtolower(substr(strrchr($filename, "."),1));

 if ($extension == "")
  return "Unknown/Unknown";

 while (list($mimetype, $file_extensions) = each($MIMEtypes))
  foreach (explode(" ", $file_extensions) as $file_extension)
   if ($extension == $file_extension)
    return $mimetype;

 return "Unknown/Unknown";
}
$MIMEtypes = array(
     "application/andrew-inset"       => "ez",
     "application/mac-binhex40"       => "hqx",
     "application/mac-compactpro"     => "cpt",
     "application/msword"             => "doc",
     "application/octet-stream"       => "bin dms lha lzh exe class so dll",
     "application/oda"                => "oda",
     "application/pdf"                => "pdf",
     "application/postscript"         => "ai eps ps",
     "application/smil"               => "smi smil",
     "application/vnd.ms-excel"       => "xls",
     "application/vnd.ms-powerpoint"  => "ppt",
     "application/vnd.wap.wbxml"      => "wbxml",
     "application/vnd.wap.wmlc"       => "wmlc",
     "application/vnd.wap.wmlscriptc" => "wmlsc",
     "application/x-bcpio"            => "bcpio",
     "application/x-cdlink"           => "vcd",
     "application/x-chess-pgn"        => "pgn",
     "application/x-cpio"             => "cpio",
     "application/x-csh"              => "csh",
     "application/x-director"         => "dcr dir dxr",
     "application/x-dvi"              => "dvi",
     "application/x-futuresplash"     => "spl",
     "application/x-gtar"             => "gtar",
     "application/x-hdf"              => "hdf",
     "application/x-javascript"       => "js",
     "application/x-koan"             => "skp skd skt skm",
     "application/x-latex"            => "latex",
     "application/x-netcdf"           => "nc cdf",
     "application/x-sh"               => "sh",
     "application/x-shar"             => "shar",
     "application/x-shockwave-flash"  => "swf",
     "application/x-stuffit"          => "sit",
     "application/x-sv4cpio"          => "sv4cpio",
     "application/x-sv4crc"           => "sv4crc",
     "application/x-tar"              => "tar",
     "application/x-tcl"              => "tcl",
     "application/x-tex"              => "tex",
     "application/x-texinfo"          => "texinfo texi",
     "application/x-troff"            => "t tr roff",
     "application/x-troff-man"        => "man",
     "application/x-troff-me"         => "me",
     "application/x-troff-ms"         => "ms",
     "application/x-ustar"            => "ustar",
     "application/x-wais-source"      => "src",
     "application/zip"                => "zip",
     "audio/basic"                    => "au snd",
     "audio/midi"                     => "mid midi kar",
     "audio/mpeg"                     => "mpga mp2 mp3",
     "audio/x-aiff"                   => "aif aiff aifc",
     "audio/x-mpegurl"                => "m3u",
     "audio/x-pn-realaudio"           => "ram rm",
     "audio/x-pn-realaudio-plugin"    => "rpm",
     "audio/x-realaudio"              => "ra",
     "audio/x-wav"                    => "wav",
     "chemical/x-pdb"                 => "pdb",
     "chemical/x-xyz"                 => "xyz",
     "image/bmp"                      => "bmp",
     "image/gif"                      => "gif",
     "image/ief"                      => "ief",
     "image/jpeg"                     => "jpeg jpg jpe",
     "image/png"                      => "png",
     "image/tiff"                     => "tiff tif",
     "image/vnd.wap.wbmp"             => "wbmp",
     "image/x-cmu-raster"             => "ras",
     "image/x-portable-anymap"        => "pnm",
     "image/x-portable-bitmap"        => "pbm",
     "image/x-portable-graymap"       => "pgm",
     "image/x-portable-pixmap"        => "ppm",
     "image/x-rgb"                    => "rgb",
     "image/x-xbitmap"                => "xbm",
     "image/x-xpixmap"                => "xpm",
     "image/x-xwindowdump"            => "xwd",
     "model/iges"                     => "igs iges",
     "model/mesh"                     => "msh mesh silo",
     "model/vrml"                     => "wrl vrml",
     "text/css"                       => "css",
     "text/html"                      => "html htm",
     "text/plain"                     => "asc txt",
     "text/richtext"                  => "rtx",
     "text/rtf"                       => "rtf",
     "text/sgml"                      => "sgml sgm",
     "text/tab-separated-values"      => "tsv",
     "text/vnd.wap.wml"               => "wml",
     "text/vnd.wap.wmlscript"         => "wmls",
     "text/x-setext"                  => "etx",
     "text/xml"                       => "xml xsl",
     "video/mpeg"                     => "mpeg mpg mpe",
     "video/quicktime"                => "qt mov",
     "video/vnd.mpegurl"              => "mxu",
     "video/x-msvideo"                => "avi",
     "video/x-sgi-movie"              => "movie",
     "x-conference/x-cooltalk"        => "ice",
);
?>
