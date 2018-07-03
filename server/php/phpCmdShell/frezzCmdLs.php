<?php
$connection = ssh2_connect('192.168.1.87', 22);
ssh2_auth_password($connection, 'charles', '123456');

$strCommand = 'ls';
$sshStream = ssh2_shell($connection, 'xterm', null, 120, 24, SSH2_TERM_UNIT_CHARS);
fwrite($sshStream, $strCommand . PHP_EOL);
sleep(1);
stream_set_blocking($sshStream, true);
$sshUntarRetval = 0;

while ($buf = fgets($sshStream,4096)) {
  flush();
  $sshUntarRetval += 1;
  if ($sshUntarRetval >= 2000/*strpos($buf, 'tar -C') !== false*/){
    break;
  }
  echo $buf."<br>";
}
fclose($sshStream);
//echo $_SERVER['REQUEST_METHOD'];  
?>
