<?php
session_start();

$name = $_SESSION['name']??'null';
$c = $_SESSION['c']??0;
echo $name.'<br>'.$c;
