<?php
session_start();
if (isset($_GET["logout"])){
  session_destroy();
  echo 'name : '.$_SESSION['name'];
}
if (isset($_POST["username"])){
  $conn = mysqli_connect('localhost', 'usertest', '123456', 'karpdata');
  if (mysqli_connect_error()){
    echo '<div class="notif notif_error">Failed to connect to MySQL: '.mysqli_connect_error().'</div>';
  }
  $sql = "SELECT * FROM users WHERE uid='".$_POST['username']."' AND pwd='".$_POST['password']."'";
  $result = mysqli_query($conn, $sql);
  if (!$row = mysqli_fetch_assoc($result)){
    echo '<div class="notif notif_error">utilisateur mots de passe incorrect</div>';
  } else {
    $_SESSION['name'] = $row['uid'];
  }

  echo ' name : '.$_SESSION['name'];
}
?>
