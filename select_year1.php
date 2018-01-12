<?php
$hoy = date("m,d,Y");
$year = explode(",", $hoy);
$year = $year[2];
echo $year;
?>