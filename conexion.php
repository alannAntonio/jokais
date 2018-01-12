<?php
$servidor =//'servidor'; // 
$usuario = //'usuario'; // 
$clave =//'clave'; // 
$db=//'u510949006_jok'; // 
$mysqli = new mysqli($servidor,$usuario,$clave,$db);
$mysqli->set_charset('utf8');
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
?>