<?php
$connection = ssh2_connect('192.168.1.87', 22);
ssh2_auth_password($connection, 'charles', '123456');

$cmd2="ls";
$stream = ssh2_exec($connection, $cmd2);

stream_set_blocking($stream, true);
while($o=fgets($stream)){
echo $o.'<br>';
}

echo '<br>';
echo "hello";
?>
