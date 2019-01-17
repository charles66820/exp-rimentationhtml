<?php
session_start();

if(!empty($_POST['name']) && isset($_POST['name'])){
    $_SESSION['name'] = $_POST['name'];
}
?>

<form method="POST">
    <input name="name" placeholder="name">
    <input type="submit">
</form>
<?= $_SESSION['name']?? 'null' ?>
