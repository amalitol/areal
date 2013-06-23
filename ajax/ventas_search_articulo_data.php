<?php
/*
 * $.ajax() 
/* Archivo que permite mediante AJAX buscar los datos del artículo que ha seleccionado el usuario a la hora de agregar estos a la VENTA ..... del módulo VENTAS -> NUEVA VENTA */
include_once('../includes/connection.php'); 
/* AQUI SE REALIZA LA LECTURA DE LOS CAMPOS codigo_art, precio_venta1, precio_venta2, precio_venta3, unidad_medida DE LA TABLA articulos_inventario Y SE PASA DINAMICAMENTE A LOS CAMPOS TEXT DE LA FILA DEL ARTÍCULO QUE HE SELECCIONADO EN LA COMPRA */
//01 RECIBO LAS VARIABLES $_GET.
     $id_articulo =  $_GET['id_articulo'];  //  id DEL ARTÍCULO CON LOS DATOS QUE VOY A CARGAR EN ESA FILA.
	 $id_local =  $_GET['id_local'];        //  id DEL LOCAL PARA PONER LA CANTIDAD DE ARTÍCULOS QUE HAY EN INVENTARIO EN ESE LOCAL Y PONERLO EN EL title.
	 
	 $query1 = "SELECT articulos_inventario.codigo_art, articulos_inventario.precio_venta1, articulos_inventario.precio_venta2, articulos_inventario.precio_venta3, articulos_inventario.unidad_medida, newalmacen_".$id_local.".stock_actual FROM articulos_inventario, newalmacen_".$id_local."  WHERE articulos_inventario.id='".$id_articulo."' AND newalmacen_".$id_local.".id_codigo_art='".$id_articulo."'";
 
	 $query1 = mysql_query($query1);
     $num_rows_query1 = mysql_num_rows($query1);
	 if ( $num_rows_query1 > 0 )   {
		 // Esto significa que el artículo está bien seleccionado
          $jsondata = mysql_fetch_assoc($query1);
	        
		  $jsondata_return = array (
	                                 'codigo_art' => $jsondata['codigo_art'],
								     'unidad_medida' => $jsondata['unidad_medida'],
									 'precio_venta1' => $jsondata['precio_venta1'],
									 'precio_venta2' => $jsondata['precio_venta2'],
									 'precio_venta3' => $jsondata['precio_venta3'],
									 'stock_actual' => $jsondata['stock_actual']
									);
	 } else { 
	 
	      $jsondata_return = array (
			                         'codigo_art' => "noitisnt" 
			                        );
	 
	 }
     echo json_encode($jsondata_return);
?>