<?php

/*
base:
	mayainkadb

usuario
	mayainkauserdb
	1003090212
mysql_connect('mysql_host', 'mysql_user', 'mysql_password')
*/

echo "SI";
$enlace =  mysql_connect('localhost','root', 'sasa');
if (!$enlace) {
    die('No pudo conectarse: ' . mysql_error());
}else{
echo 'Conectado satisfactoriamente';
}
mysql_close($enlace);

?>