<?php
   include("conexion.php");
   @session_start();
   session_destroy();
      // Usamos el nombre de usuario enviado de nuestroformulario
      $myusername = $mysqli->real_escape_string($_POST['username']);
      $mypassword = $mysqli->real_escape_string($_POST['password']);

      $sql = "SELECT * FROM clientes WHERE rut = '$myusername' and passcode = '$mypassword' and credencial = 'usuario'";
      $result = $mysqli->query($sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row["credencial"];
      $modificacion = $row["modificacion_password"];

      $count = mysqli_num_rows($result);

      if($count == 1) {
                  $sql = "SELECT * FROM clientes WHERE rut = '$myusername'";
                  $result = $mysqli->query($sql);
                  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                  session_start();
                  $_SESSION["usuario"] = TRUE;
                  $_SESSION["nombre"] = ucwords($row["nombre"]." ".$row["apellidopat"]);
                  $_SESSION["rut"] = $_POST['username'];
                  $_SESSION["tiempo"]=time();
                  $_SESSION["modificacion"] = $modificacion;
                  echo "true";
                  include("ingresos_usuarios.php");
                  ingresar_usuario($myusername,"cliente");
      }else{
         echo "false";
      }
?>