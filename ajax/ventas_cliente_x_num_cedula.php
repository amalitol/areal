<?php
/*
 * $.ajax() 
 */
/* Archivo que permite mediante AJAX buscar los datos del cliente al cual voy a hacerle la nueva venta de acuerdo a su NÚMERO DE CÉDULA y los muestro en un <div> para poder continuar .... del módulo VENTAS -> NUEVA VENTA */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE TODOS LOS CAMPOS DE LA TABLA proveedores_clientes Y SE PASA DINAMICAMENTE A LOS <div> QUE ME APARECERÁN CON LOS DATOS DEL MISMO  */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $num_cedula_cliente    =  $_GET['num_cedula_cliente'];    // número de cédula DEL CLIENTE PARA BUSCAR LOS DATOS EN LA TABLA. 

//02 REALIZO LA CONSULTA EN LA BASE DE DATOS PARA OBTENER LOS DATOS
     
	    $query1 = "SELECT * FROM proveedores_clientes WHERE active_cliente=1 AND cedula='".$num_cedula_cliente."' AND cedula!='' ";
        $query1 = mysql_query($query1);
	    $num_rows_query1 = mysql_num_rows($query1); 
        if ( $num_rows_query1 == 1 )  {
	        // La consulta se llevó a cabo con exito y existe el usuario en la BD.	 
		    $jsondata = mysql_fetch_assoc($query1);
	        
		    //03 TENGO QUE VOLVER TODA LA INFORMACIÓN A CÓDIGO UTF_8 PARA QUE LOS ACENTOS Y LAS ñ PUEDAN SER ENVIADOS CORRECTAMENTE MEDIANTE JSON
			$jsondata['nombre'] = utf8_encode($jsondata['nombre']);
			$jsondata['cedula'] = utf8_encode($jsondata['cedula']);
			$jsondata['ruc'] = utf8_encode($jsondata['ruc']);
			$jsondata['telefono'] = utf8_encode($jsondata['telefono']);
		
			//04 GUARDO LOS RESULTADOS EN UNA ARRAY PARA CONVERTIRLO A JSON
			$jsondata_return = array (
	                                 'nombre' => $jsondata['nombre'],
									 'cedula' => $jsondata['cedula'],
									 'ruc' => $jsondata['ruc'],
									 'telefono' => $jsondata['telefono'],
									 'id' => $jsondata['id']          
									 );
		} else { 
		    // Esto significa que no se encontró el artículo en esa bodega.
			$jsondata_return = array (
			                         'error' => "No se encuentra el cliente en la Base de Datos. Seleccione nuevamente.GRACIAS" 
			                          );
		}

	 echo json_encode($jsondata_return);

?>