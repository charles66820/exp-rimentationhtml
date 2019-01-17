<?php
ignore_user_abort(true); //sésactive la mort du script si le client quite la page
set_time_limit(0); //désactive le time out

header('Content-Type: text/plain'); //done le type du contenu de la requet
header('Connection: Keep-Alive');
header('X-Content-Type-Options: nosniff'); //permet d'envoyer les donner par chunk

$i = 1000;
while ($i-- > 0) {
  ob_end_flush();
  file_put_contents('/dev/stdout', connection_status());
  //ob_flush();
  flush();
  ob_start();
  usleep(25000);
}
