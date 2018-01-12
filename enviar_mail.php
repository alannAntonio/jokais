<?php
    $destinatarioEmail = $_POST["cCorreo"];
    $numeroBoleta = $_POST["cNumeroBoleta"];
    $nombreCliente = $_POST["cNombre"];
    $numeroCliente = $_POST["cRut"];
    $fechaEmision = $_POST["cEmision"];
    $fechaArray = explode("-", $fechaEmision);
    $fechaVencimiento = $_POST["cVencimiento"];
    $montoPagar = $_POST["cTotal"];
    $montoPagar = number_format($montoPagar,0,",",".");

    $rutaBoleta = $fechaArray[2]."/".$fechaArray[1]."/".$numeroBoleta;
    $asuntoEmail = "Boleta Jokais ".$numeroBoleta;
    include("correo.php");  
	$headers =  'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'From: Jokais <noresponder@jokais.cl>' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
	$headers .= 'Content-type: text/html; charset=utf-8';
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
    
    if($destinatarioEmail != ""){
        if (mail($destinatarioEmail, $asuntoEmail, $mensaje, $headers)) {
            echo 'El archivo fue enviado correctamente';
        } else {
            echo 'Error, no se pudo enviar el email';
        }    
        exit();
    }     
?>