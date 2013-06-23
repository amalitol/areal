<?php
/*
 * $.ajax() 
 */
/* Archivo que permite mediante AJAX la devolución de los datos del contacto que se quiere editar del módulo PROVEEDORES */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE LOS DATOS DE LA TABLA proveedores_clientes_contactos Y SE PASAN DINAMICAMENTE A LOS CAMPOS TEXT DEL FORMULARIO DE ENTRADA DE DATOS DE NUEVOS CONTACTOS */

//01 RECIBO LA VARIABLE $_GET DEL CONTACTO QUE VOY A EDITAR.
     
	 $edit =  $_GET['edit'];

//02 REALIZO LA CONSULTA EN LA BAS DE DATOS PARA OBTENER LOS DATOS DEL REGISTRO QUE VOY A EDITAR 
     $query = "SELECT * FROM proveedores_clientes_contactos WHERE id='".$edit."'";
     $query = mysql_query($query);
	 $num_rows_query = mysql_num_rows($query); 
     if ( $num_rows_query > 0 )  {
	     // La consulta se llevó a cabo con exito	 
		 $jsondata = mysql_fetch_assoc($query); 
	 
	 } else { $jsondata['mensaje'] = "mensaje de error"; }
    
/*03********* PHP toma de manera predeterminada que la cadena de origen está en UTF-8, por lo que, si trabajamos con archivos en ISO-8859-1, tendremos que convertirlos antes a UTF-8 para que aparezcan las tildes. Esto se soluciona convirtiendo antes las cadenas a UTF-8, al menos las que tienen caracteres distintos del alfabeto inglés.

    AHORA PARA QUE ME APAREZCAN LAS TILDES A LA HORA DE DEVOLVER LOS DATOS DE LOS RESULTADOS Y NO ME SALGA null CONVIERTO LOS VALORES DEL ARRAY ASOCIATIVO jsondata A CADENAS utf_8	 */
	 
	 $jsondata_utf8 = array(
	                        'id'                => $jsondata['id'],
							'nombre_contacto'   => utf8_encode($jsondata['nombre_contacto']),
	                        'telefono_contacto' => utf8_encode($jsondata['telefono_contacto']),
							'cell_contacto'     => utf8_encode($jsondata['cell_contacto']),
							'fax_contacto'      => utf8_encode($jsondata['fax_contacto']),
							'email_contacto'    => utf8_encode($jsondata['email_contacto']),
							'cedula_contacto'   => utf8_encode($jsondata['cedula_contacto'])
							);
	 
	 echo json_encode($jsondata_utf8);
		
?>