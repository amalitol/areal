<?php
@ session_start();
include_once('connection.php');

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_mi_perfil  *****/

//01 process_form_mi_perfil()  --> Función que procesa los datos de entrada para que el usuario cambie la contraseña


/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_registro_bancario   *****/

/************************************************************************************************************/

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_mi_perfil   *****/

//01 
  function process_form_mi_perfil()
  {
	  // Función que procesa los datos de entrada para que el usuario cambie la contraseña
	  //01 Recibo las variables $_POST
	  $old_pass = addslashes($_POST['old_pass_hidden']);
	  $new_pass = addslashes($_POST['new_pass_hidden']);
      $new_pass_confirm = addslashes($_POST['new_pass_confirm']);

	  //02 Recibo la contraseña actual del usuario de la BD data_usuarios
	  $query01 = "SELECT * FROM data_usuarios WHERE usuario='".$_SESSION['usuario']."'";
	  $query01 = mysql_query($query01);
	  $num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  // Esto significa que se hayó un usuario con ese user. ( Esto debe ser siempre > 0 )   
		  $registro_db = mysql_fetch_assoc($query01);
		  
		  //03 Comparo la contraseña de la BD con la contraseña del $_POST
		  if ( $old_pass != $registro_db['contrasena'] )  {
			  // De esta forma me envía un mensaje de error diciendo que esa no es la contraseña antigua.   
			  header('Location: ../index.php?mod=mod_mi_perfil&send=bad1');
		  
		  } else {
			  // La contraseña actual es correcta, tengo que cambiar la de la BD.
			  $query012 = "UPDATE data_usuarios SET contrasena='".$new_pass."' WHERE usuario='".$_SESSION['usuario']."'";
			  $query012 = mysql_query($query012);
			  $num_rows_affected_query012 = mysql_affected_rows();
			  if ( $num_rows_affected_query012 > 0 ) {
				  // Eso significa que la BD se actualizó bien.  
				  header('Location: ../index.php?mod=mod_mi_perfil&send=ok');				  
			  }
			   
		  }
		  
	  } else { echo mysql_error(); }
	  
  }  // Fin de la función process_form_mi_perfil()

/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_registro_bancario   *****/

  //01
  if ( isset($_GET['data']) && $_GET['data'] == "send" )  {
	  // ESTO ES PARA PROCESAR LAS LAS VARIABLES $_POST del envío del formulario
	  process_form_mi_perfil();
  }

?>