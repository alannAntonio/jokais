<?php
include("conexion.php");
include("rescatar_saldo.php");
$rut = $_SESSION["rut"];
$sql = "SELECT * FROM boletas WHERE cliente = '$rut' order by fecha_emision desc limit 1";
$result = $mysqli->query($sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);      
$count = mysqli_num_rows($result);
	
if($count == 1) {
      $fecha = $row["fecha_emision"];
      $fecha = explode("-", $fecha);
      $numero_boleta = $row["numero_boleta"];
      $saldo = rescatar_saldo($rut);

      $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $fecha_emision_ultima = $row["fecha_emision"];
      $mesHoy = $fecha_emision_ultima;
      $mesHoy = explode("-", $mesHoy);
      $mesHoy = $mesHoy[1]-1;
      $mesHoy = $mes[$mesHoy];
      echo
      '<div class="boleta">
            <div id="titulo">
                  <h2>Última boleta</h2><h2>Mes: '.$mesHoy.'</h2>
            </div>
            <a href="archivo/'.$fecha[0].'/'.$fecha[1].'/'.$numero_boleta.'.pdf" target="_blank">
                  <div id="boleta">
                        <img src="images/003-ojo.png">
                  </div>
            </a>
            <div class="saldo">
                  <div id="saldo">
                        Saldo Pendiente:
                        <p>'.$saldo.'</p>
                  </div>
            </div>
      </div>

      <div class="listado">
            <h2>Boletas anteriores</h2>
      ';

      $consulta = "SELECT * FROM boletas WHERE cliente = '$rut' AND fecha_emision < '$fecha_emision_ultima' ORDER BY fecha_emision desc limit 7";
      $result = $mysqli->query($consulta);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);

      if($result = $mysqli->query($consulta)){            
          while($fila = $result->fetch_row()){
            $fecha_emision = $fila[3];
            $numero_boleta_anterior = $fila[1];
            $fecha_emision = explode("-", $fecha_emision);
            echo '
                  <a href="archivo/'.$fecha_emision[0].'/'.$fecha_emision[1].'/'.$numero_boleta_anterior.'.pdf" target="_blank">
                        <div id="opcion">
                              <p>'.$mes[($fecha_emision[1]-1)].' '.$fecha_emision[0].'</p>
                        </div>
                  </a>
                        ';                        
          };
          
          $result->close();
      }else{
            echo '
                  <div id="opcion">
                        <p>No hay boletas anteriores</p>
                  </div>
                  ';
      }

      echo '</div>';
                                                
}else{
	echo
      '<div class="boleta">
            <div id="titulo">
                  <h2>No posee boletas</h2>
            </div>
            <a>
                  <div id="boleta">
                        <img src="images/003-ojo.png">
                  </div>
            </a>
            <div class="saldo">
                  <div id="saldo">
                        Saldo Pendiente:
                        <p>$0</p>
                  </div>
            </div>
      </div>
      <div class="listado">
            <h2>Boletas anteriores</h2>
            <div id="opcion">
                  <p>No hay boletas anteriores</p>
            </div>                  
      </div>';
}
?>