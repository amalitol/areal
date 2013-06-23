<?php
/*
 * $.ajax() 
 */
/* Archivo que permite mediante AJAX buscar los datos del artículo que ha seleccionado el usuario a la hora de agregar estos a la COMPRA ..... del módulo COMPRAS -> NUEVA COMPRA */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE LOS CAMPOS codigo_art, precio_costo_art, unidad_medida DE LA TABLA articulos_inventario Y SE PASA DINAMICAMENTE A LOS CAMPOS TEXT DE LA FILA DEL ARTÍCULO QUE HE SELECCIONADO EN LA COMPRA */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $id_articulo =  $_GET['id_articulo'];  //  id DEL ARTÍCULO CON LOS DATOS QUE VOY A CARGAR EN ESA FILA.
	 $proveedor   =  $_GET['proveedor'];    //  NOMBRE DEL PROVEEDOR AL CUAL VOY A BUSCARLE EL ARTICULO

     $query1 = "SELECT codigo_art, proveedor_art, precio_costo_art, unidad_medida FROM articulos_inventario WHERE id='".$id_articulo."' AND proveedor_art='".$proveedor."'";
     $query1 = mysql_query($query1);
     $num_rows_query1 = mysql_num_rows($query1);
	 if ( $num_rows_query1 > 0 )   {
		 // Esto significa que el artículo está bien seleccionado
          $jsondata = mysql_fetch_assoc($query1);
	        
		  $jsondata_return = array (
	                                 'codigo_art' => $jsondata['codigo_art'],
								     'unidad_medida' => $jsondata['unidad_medida'],
									 'precio_costo_art' => $jsondata['precio_costo_art']
									);
	 
	 } else { 
	 
	      $jsondata_return = array (
			                         'codigo_art' => "noitisnt" 
			                        );
	 
	 }

     echo json_encode($jsondata_return);

?>