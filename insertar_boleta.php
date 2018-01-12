<?php
require('conexion.php');
$cNumeroBoleta = $_POST["cNumeroBoleta"];
$cMedidor = $_POST["cMedidor"];
$id = substr($cNumeroBoleta, -4)+0;
$cEmision = date("Y-m-d");
$cVencimiento = $_POST["cVencimiento"];
$cVencimiento = explode("-", $cVencimiento);
$cVencimiento = $cVencimiento[2]."/".$cVencimiento[1]."/".$cVencimiento[0];
$cLecActual = $_POST["cLecActual"];
$cLecAnterior = $_POST["cLecAnterior"];
$cValorKw = $_POST["cValorKw"];
$cConsumoKw = $_POST["cConsumoKw"];
$cConsumoDinero = $_POST["cConsumoDinero"];
$cCargoFijo = $_POST["cCargoFijo"];
$cRut = $_POST["cRut"];
$cSaldoAnterior = $_POST["cSaldoAnterior"];
$cSaldoFavor = $_POST["cSaldoFavor"];
$cCorteRep = $_POST["cCorteRep"];
$cGastosOp = $_POST["cGastosOp"];
$cIntereses = $_POST["cIntereses"];
$cTotal = $_POST["cTotal"];
$cUltimoMonto = $_POST["cUltimoMonto"];
$cUltimaFecha = $_POST["cUltimaFecha"];
$cUltimaFecha = explode("-", $cUltimaFecha);
$cUltimaFecha = $cUltimaFecha[2]."/".$cUltimaFecha[1]."/".$cUltimaFecha[0];
$cUltimoMetodo = $_POST["cUltimoMetodo"];
$cUltimoCodigo = $_POST["cUltimoCodigo"];
/*





$consulta = "INSERT INTO boletas VALUES ('$id', '$cNumeroBoleta', '$cEmision', '$cVencimiento','$cLecActual','$cLecAnterior','$cValorKw','$cConsumoKw','$cConsumoDinero',$cCargoFijo','$cRut','$cSaldoAnterior','$cSaldoFavor','$cCorteRep','$cGastosOp','$cIntereses','$cTotal','$cUltimoMonto','$cUltimaFecha','$cUltimoMetodo','$cUltimoCodigo')";
	$mysqli->query($consulta);*/
$consulta = "INSERT INTO boletas VALUES ('$id', '$cNumeroBoleta','$cMedidor', '$cEmision', '$cVencimiento','$cLecActual','$cLecAnterior','$cValorKw','$cConsumoKw','$cConsumoDinero','$cCargoFijo','$cRut','$cSaldoAnterior','$cSaldoFavor','$cCorteRep','$cGastosOp','$cIntereses','$cTotal','$cUltimoMonto','$cUltimaFecha','$cUltimoMetodo','$cUltimoCodigo')";
$mysqli->query($consulta);

$consulta = "SELECT * FROM clientes	WHERE rut = '$cRut'";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		
		if ($count > 0) {
			if($cTotal>0){
				$q = "UPDATE clientes SET deuda='$cTotal',saldo_favor='0' WHERE rut='$cRut'";
			}elseif($cTotal=="0"){
				$q = "UPDATE clientes SET deuda='0',saldo_favor='0' WHERE rut='$cRut'";
			}elseif($cTotal<0){
				$d = $cTotal*-1;
				$q = "UPDATE clientes SET deuda='0',saldo_favor='$d' WHERE rut='$cRut'";
			}
			$mysqli->query($q);
		}


?>	