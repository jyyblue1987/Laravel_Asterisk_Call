<?php

$socket = fsockopen("127.0.0.1","5038", $errno, $errstr);
fputs($socket, "Action: Login\r\n");
fputs($socket, "UserName: calls\r\n");
fputs($socket, "Secret: 212215842\r\n\r\n");

fputs($socket, "Action: Command\r\n");
fputs($socket, "Command: reload\r\n\r\n");
$wrets=fgets($socket,128);

?>
