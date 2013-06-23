<?php
include_once('connection.php');

// DECLARACIÓN DE FUNCIONES DEL mod_login


//01
if ( isset($_GET['data']) && $_GET['data'] == "send" )  {
	// ESTO ES PARA PROCESAR LAS LAS VARIABLES $_POST del envío del formulario
	
    $usuario = addslashes($_POST['usuario']);
    $contrasena = addslashes($_POST['pass_hidden']);

    //(1) Verifico que el usuario esté en la BD.
	$query1 = "SELECT * FROM data_usuarios WHERE usuario='".$usuario."' AND contrasena='".$contrasena."'";
    $query1 = mysql_query($query1 , $con);
    $num_rows_query1 = mysql_num_rows($query1);
	
	if ( $num_rows_query1 > 0 )    {   // Esto me dice que el usuario existe en la BD... 
	        
		//(2) CHEQUEO SI EL USUARIO ES IDENTICAMENTE IGUAL 
		$user_db = mysql_fetch_assoc($query1);
		$usuario_db = $user_db['usuario'];
		
		if ( $usuario_db === $usuario )   {
	        // Esto significa que no hay diferencias entre las mayusculas y las minúsculas del usuario 		
			
	        //(3) CHEQUEO SI EL USUARIO ESTÁ HABILITADO
		    $queryh = "SELECT * FROM data_usuarios WHERE usuario='".$usuario."' AND contrasena='".$contrasena."' AND habilitar=1";
            $resulth = mysql_query($queryh, $con);
            $num_rows_resulth = mysql_num_rows($resulth);
	        if ( !$num_rows_resulth )   {     // SIGNIFICA QUE EL USUARIO ESTÁ DESABILITADO
		   
		        header('location:../index.php?bad=2');   // <- Devuelve mensaje de error en la pantalla de inicio
	     
	        } else {
		
		        $row = mysql_fetch_assoc($resulth);
                // Guardo el contenido de los campos (usuario), (nombre_completo), (tipo_usuario), (id_local) de la BD en variables...
		        $nombre = $row['usuario'];
		        $nombre_completo = $row['nombre_completo'];
                $tipo_usuario = $row['tipo_usuario'];
				$id_local = $row['id_local'];
	       
		        session_start();
                /****************************************************************************/
	            // Verifico que ya no esté el usuario con una ventana abierta en el navegador 
		 
		             if (isset($_SESSION['usuario']) && isset($_SESSION['nombre_completo'])) {
			            // (¿POR QUÉ PUEDE PASAR ESTO?)Si 1.- Hay alguna ventana abierta EN EL NAVEGADOR 
					    //                                2.- El usuario tocó el botón SALIR y cerró la pestaña 
			             header('Location:error_user.php');
			    
		             } else {
		   
		                 $_SESSION['usuario'] = $nombre;                       // a   
                         $_SESSION['nombre_completo'] = $nombre_completo;      // Alberto Pérez
						 $_SESSION['tipo_usuario'] = $tipo_usuario;            // a ó v
						 $_SESSION['id_local'] = $id_local;                    // 1, 2, 3, 4 ......
		  
		                 header('Location:../index.php');
		   
			       	 }
	      
	   }

       } else {
		  // Esto sigifica que hubo un error a la hora de poner las mayúsculas y/o minúsculas en el campo usuario
		header('Location:../index.php?bad=1');   // <- Devuelve mensaje de error en la pantalla de inicio 
		   
	   }   // fin del if ( $usuario_db === $usuario )   {
	
	} else {
		// Esto sigifica que no existe el usuario
		header('Location:../index.php?bad=1');   // <- Devuelve mensaje de error en la pantalla de inicio
		
	}
	

}

?>