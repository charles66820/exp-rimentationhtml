<?php
session_start();

//test si l'utilisateur est connectée ou pas pour afficher al page.
if (isset($_SESSION['id'])) {
  echo "connecté";
}else {
  //formulaire
  echo '<form action="login.html" method="post">
    		<input type="text" name="user" value="" placeholder="Utilisateur">
    		<input type="password" name="password" value="" placeholder="Mots de passe">
    		<input type="submit" name="submit" value="Connexion">	
  		</form>
    	<br>
		<form method="POST" action="login.php">
    		<input type="text" name="user" placeholder="Utilisateur"><br>
     		<input type="text" name="password" placeholder="mots de passe"><br>
     		<input type="submit" name="submit" value="signIn"/>
		</form>
		<br>
		<form method="POST" action="login.php">
    		<input type="submit" name="submit" value="signOut"/>
		</form>
		';
}


//connection a la base de donnée.
$conn = mysqli_connect('localhost', 'usertest', '123456', 'webdata');

if (!$conn){ 
	die("connection à la db imposible! erreur: ".mysqli_connect_error());
}

//login
if($_POST['submit'] = 'login'){
	$uid = $_POST['username'];
	$pwd = $_POST['password'];

	$sql = "SELECT * FROM user WHERE uid='$uid' AND pwd='$pwd'";
	$result = mysqli_query($conn, $sql);

	if (!$row = mysqli_fetch_assoc($result)){
    	echo "utilisateur mots de passe incorrect";
	} else {
    	$_SESSION['id'] = $row['id'];
	}
}

//sign
if($_POST['submit'] = 'signIn'){
	$uid = $_POST['username'];
	$pwd = $_POST['password'];

	$sql = "INSERT INTO user (uid, pwd) VALUES ('$uid', '$pwd')";
	$result = mysqli_query($conn, $sql);
}

//deconnexion
if($_POST['submit'] = 'signOut'){
	session_destroy();
}
?>