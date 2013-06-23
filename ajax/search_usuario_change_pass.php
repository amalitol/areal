<?php
/*
 * $.ajax() 
 */
/* Archivo que permite mediante AJAX buscar los datos del usuario al cual voy a cambiarle la contraseña y los muestras en un <div> para poder continuar .... del módulo USUARIOS -> CAMBIAR CONTRASEÑA */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE TODOS LOS CAMPOS DE LA TABLA data_usuarios Y SE PASA DINAMICAMENTE A LOS <div> QUE ME APARECERÁN CON LOS DATOS DEL MISMO  */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $id_usuario    =  $_GET['id_usuario'];    // id DEL USUARIO PARA BUSCAR LOS DATOS EN LA TABLA 
	 $usuario       =  $_GET['usuario'];       // USUARIO PARA BUSCAR LOS DATOS EN LA TABLA.

//02 REALIZO LA CONSULTA EN LA BASE DE DATOS PARA OBTENER LOS DATOS
     
	    $query1 = "SELECT data_usuarios.usuario, data_usuarios.nombre_completo, data_usuarios.tipo_usuario, data_usuarios.id_local, data_usuarios.habilitar, locales_inventarios.nombre_local FROM data_usuarios, locales_inventarios WHERE data_usuarios.id_local=locales_inventarios.id AND data_usuarios.id_usuario='".$id_usuario."' AND data_usuarios.usuario='".$usuario."'";
        $query1 = mysql_query($query1);
	    $num_rows_query1 = mysql_num_rows($query1); 
        if ( $num_rows_query1 == 1 )  {
	        // La consulta se llevó a cabo con exito y existe el usuario en la BD.	 
		    $jsondata = mysql_fetch_assoc($query1);
	        
		    //03 AHORA BUSCO PONER EL NOMBRE DEL TIPO DE USUARIO (VENDEDOR O ADMINISTRADOR)
			if ( $jsondata['tipo_usuario']  == "a" )   {  
			    // Usuario ADMINISTRADOR 
			    $jsondata['tipo_usuario']  = "Administrador Bodega";
			} else if ( $jsondata['tipo_usuario']  == "v" )  {
				// Usuario VENDEDOR
			    $jsondata['tipo_usuario']  = "Vendedor Almac&eacute;n";
			
			}
			
			//04 AHORA BUSCO PONER SI EL USUARIO ESTÁ HABILITADO O INHABILITADO
			if ( $jsondata['habilitar']  == "1" )   {  
			    // Usuario HABILITADO 
			    $jsondata['habilitar']  = "Habilitado";
				$jsondata['color'] = "green";
			} else if ( $jsondata['habilitar']  == "0" )  {
				// Usuario INHABILITADO
			    $jsondata['habilitar']  = "Inhabilitado";
				$jsondata['color'] = "red";
			
			}
			
			//05 TENGO QUE VOLVER TODA LA INFORMACIÓN A CÓDIGO UTF_8 PARA QUE LOS ACENTOS Y LAS ñ PUEDAN SER ENVIADOS CORRECTAMENTE MEDIANTE JSON
			$jsondata['usuario'] = utf8_encode($jsondata['usuario']);
			$jsondata['nombre_completo'] = utf8_encode($jsondata['nombre_completo']);
			$jsondata['nombre_local'] = utf8_encode($jsondata['nombre_local']);
		
			//06 GUARDO LOS RESULTADOS EN UNA RRAY PARA CONVERTIRLO A JSON
			$jsondata_return = array (
	                                 'usuario' => $jsondata['usuario'],
									 'nombre_completo' => $jsondata['nombre_completo'],
									 'tipo_usuario' => $jsondata['tipo_usuario'],
									 'habilitar' => $jsondata['habilitar'],
									 'nombre_local' => $jsondata['nombre_local'],
									 'color' => $jsondata['color']
									 );
		} else { 
		    // Esto significa que no se encontró el artículo en esa bodega.
			$jsondata_return = array (
			                         'error' => "No se encuentra el usuario en la Base de Datos. Seleccione nuevamente.GRACIAS" 
			                          );
		}

	 echo json_encode($jsondata_return);
	
?>