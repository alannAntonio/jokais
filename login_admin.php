<?php
   include("conexion.php");
   @session_start();
   session_destroy();
   if(isset($_POST["username"])) {
      // Usamos el nombre de usuario enviado de nuestroformulario
      $myusername = $mysqli->real_escape_string($_POST['username']);
      $mypassword = $mysqli->real_escape_string($_POST['password']); 
      
      $sql = "SELECT * FROM cpanel WHERE rut = '$myusername' and passcode = '$mypassword'";
      $result = $mysqli->query($sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row["credencial"];
      $nombrelog = ucwords($row["nombre"].' '.$row["apellido"]);
      
      $count = mysqli_num_rows($result);
      		
      if($count == 1) {
               session_start();
               $_SESSION["administrador"] = TRUE;
               $_SESSION["nombre"] = $nombrelog;
               $_SESSION["credencial"] = $active;               
               echo "true"; 
               include("ingresos_usuarios.php");
               ingresar_usuario($myusername,$active);            
      }else{
         echo "Usuario y/o Password inválidos";
      }
   }else{
      header("location: index.php");
   }
?>