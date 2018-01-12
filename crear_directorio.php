<?php

$hoy = date("Y-m-d");
$hoy = explode("-", $hoy);
$carpeta = ($_SERVER['DOCUMENT_ROOT'] . '/archivo/'.$hoy[0].'/'.$hoy[1]);
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}
?>