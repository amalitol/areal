<?php
/*
*  Archivo que me permite procesar la salida del usuario a la página principal.
*  
*
*/
session_start();   
 
  function log_out()
  {
      // Función que me permite borrar la variable de sesión y darle salida al usuario a la página principal enviando un mensaje.
 
      if ( isset($_SESSION['usuario']))         { unset($_SESSION['usuario']); }
	  if ( isset($_SESSION['nombre_completo'])) { unset($_SESSION['nombre_completo']); }
	  if ( isset($_SESSION['tipo_usuario'])) { unset($_SESSION['tipo_usuario']); }
	  if ( isset($_SESSION['id_local'])) { unset($_SESSION['id_local']); }
	                       	
      session_destroy();
      //  mysql_close($conn);
  	    
	  header('location:../index.php');
  }

if (isset($_SESSION['usuario']) && isset($_SESSION['nombre_completo']) && isset($_SESSION['tipo_usuario']) && isset($_SESSION['id_local'])) {
		
	log_out();

} else {
		
	$message =  "<span> Usted necesita autentificaci&oacute;n para ver esta p&aacute;gina.</span>";
	echo $message."<br />";
	echo "<a href='../index.php'> <span> Ir a la p&aacute;gina de inicio </span></a>";

}

?>