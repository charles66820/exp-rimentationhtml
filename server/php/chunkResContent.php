<?php
header('Content-Type: text/plain'); //done le type du contenu de la requet
header('Connection: Keep-Alive');
header('X-Content-Type-Options: nosniff'); //permet d'envoyer les donner par chunk

$i = 1000;
while ($i-- > 0) {
  ob_end_flush();
  //file_put_contents('/dev/stdout', connection_status()); //écrit dans la console
  echo "msg\n";
  //flush();
  ob_start();
  usleep(25000);
}
