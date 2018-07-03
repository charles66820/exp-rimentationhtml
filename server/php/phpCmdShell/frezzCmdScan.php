<?php
$connection = ssh2_connect('192.168.1.87', 22);
ssh2_auth_password($connection, 'charles', '123456');
$stream = ssh2_exec($connection, 'hp-scan -o "/scan/test1234.pdf"'/* > /dev/tty1 2>&1'/*> /dev/pts/0 2>&1'*/);

stream_set_blocking($stream, true);
while($line=fgets($stream)) {
  echo $line.'<br>';
}
?>
