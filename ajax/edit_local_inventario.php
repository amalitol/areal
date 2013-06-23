<?php
/*
 * $.ajax() 
 */
/* Archivo que permite mediante AJAX la devolución de los datos del LOCAL que se quiere editar del módulo INVENTARIO */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE LOS DATOS DE LA TABLA locales_inventarios Y SE PASAN DINAMICAMENTE A LOS CAMPOS TEXT DEL FORMULARIO DE ENTRADA DE DATOS DE NUEVOS LOCALES */

//01 RECIBO LA VARIABLE $_GET DEL CONTACTO QUE VOY A EDITAR.
     
	 $edit =  $_GET['edit'];

//02 REALIZO LA CONSULTA EN LA BAS DE DATOS PARA OBTENER LOS DATOS DEL REGISTRO QUE VOY A EDITAR 
     $query = "SELECT * FROM locales_inventarios WHERE id='".$edit."'";
     $query = mysql_query($query);
	 $num_rows_query = mysql_num_rows($query); 
     if ( $num_rows_query > 0 )  {
	     // La consulta se llevó a cabo con exito	 
		 $jsondata = mysql_fetch_assoc($query); 
	 
	     /*03********* PHP toma de manera predeterminada que la cadena de origen está en UTF-8, por lo que, si trabajamos con archivos en ISO-8859-1, tendremos que convertirlos antes a UTF-8 para que aparezcan las tildes. Esto se soluciona convirtiendo antes las cadenas a UTF-8, al menos las que tienen caracteres distintos del alfabeto inglés.

    AHORA PARA QUE ME APAREZCAN LAS TILDES A LA HORA DE DEVOLVER LOS DATOS DE LOS RESULTADOS Y NO ME SALGA null CONVIERTO LOS VALORES DEL ARRAY ASOCIATIVO jsondata A CADENAS utf_8	 */
	 
	   $jsondata_utf8 = array(
	                        // Campo hidden para que su valor no sea 'nuevo'
							'id_local'          => $jsondata['id'],
							
							'nombre_local'      => utf8_encode($jsondata['nombre_local']),
	                        'direccion_local'   => utf8_encode($jsondata['direccion_local']),
							'telefono_local'    => utf8_encode($jsondata['telefono_local']),
							'tipo_local'        => utf8_encode($jsondata['tipo_local']),
							
							'nombre_responsable'    => utf8_encode($jsondata['nombre_responsable']),
							'telefono_responsable'  => utf8_encode($jsondata['telefono_responsable']),
							'cell_responsable'      => utf8_encode($jsondata['cell_responsable']),
							'email_responsable'     => utf8_encode($jsondata['email_responsable'])
							);
	 
	 } else { $jsondata_utf8['mensaje'] = "Mensaje de Error"; }
	 
	 echo json_encode($jsondata_utf8);
		
?>