<?php
session_start();

ignore_user_abort(true); //sésactive la mort du script si le client quite la page
set_time_limit(0); //désactive le time out

if (!isset($_SESSION['c']) || empty($_SESSION['c'])) $_SESSION['c'] = 0;

$i = 10;
while ($i-- > 0) {
  $_SESSION['c'] += 1;
  usleep(2500000);
}

echo $_SESSION['c'].'<br>'.$_SESSION['name']??'null';
