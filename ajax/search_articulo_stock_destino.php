<?php
/*
 * $.ajax() 
 */
/* Archivo que permite mediante AJAX buscar la cantidad de artículos que hay en el stock del LOCAL DESTINO Y ME LO MUESTRA EN EL CAMPO text Stock Destino ..... del módulo INVENTARIO -> MOVIMIENTOS */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DEL CAMPO stock_actual DE LA TABLA DINÁMICA newalmacen_(id) ó newbodega_1 Y SE PASA DINAMICAMENTE AL CAMPO TEXT DEL FORMULARIO DE ENTRADA DE DATOS DE ---- CREAR MOVIEMINTO DE ARTÍCULOS---- */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $id_cod_articulo =  $_GET['code'];        //  CÓDIGO DEL ARTÍCULO QUE VOY A BUSCAR PARA MOSTRAR LA CANTIDAD.
	 $id_local     =  $_GET['id_local'];    // id DEL LOCAL PARA AVERIGUAR LA TABLA DONDE VOY A BUSCAR LA VARIABLE $cod_articulo

//02 REALIZO LA CONSULTA EN LA BASE DE DATOS PARA OBTENER LOS DATOS DEL REGISTRO QUE VOY A EDITAR 
     switch($id_local)
	 {
	  // CASO 1
	  case "1":
	    // CASO BODEGA QUE ES UNA SOLA
	    $query1 = "SELECT newbodega_1.stock_actual FROM newbodega_1, articulos_inventario WHERE newbodega_1.id_codigo_art=articulos_inventario.id AND articulos_inventario.codigo_art='".$id_cod_articulo."'";
	
        $query1 = mysql_query($query1);
	    $num_rows_query1 = mysql_num_rows($query1); 
        if ( $num_rows_query1 == 1 )  {
	        // La consulta se llevó a cabo con exito o existe el artículo en LA BODEGA.	 
		    $jsondata = mysql_fetch_assoc($query1);
	        
		    $jsondata_return = array (
	                                 'stock_actual' => $jsondata['stock_actual']
									 );
		} else { 
		    // Esto significa que no se encontró el artículo en esa bodega.
			$jsondata_return = array (
			                         'stock_actual' => "0" 
			                          );
		}
	  break;
	 
	  // CASO 2
	  case "seleccione":
	       // SI SELECCIONO LA OPCIÓN "Seleccione"
		   $jsondata_return = array (
			                         'stock_actual' => "no" 
			                          );
	  break;
	  
	  // CASO 3
	  case "otros":
	       // SI SELECCIONO LA OPCIÓN "Otros"
	       $jsondata_return = array (
			                         'stock_actual' => "no" 
			                          );    
	  break;
	 
	  // CASO 4      
	  default:	 
        // CASO ALMACÉN QUE PUEDEN SER UNOS CUANTOS
	    $query2 = "SELECT newalmacen_".$id_local.".stock_actual FROM newalmacen_".$id_local.", articulos_inventario WHERE newalmacen_".$id_local.".id_codigo_art=articulos_inventario.id AND articulos_inventario.codigo_art='".$id_cod_articulo."'";
        $query2 = mysql_query($query2);
	    $num_rows_query2 = mysql_num_rows($query2); 
        if ( $num_rows_query2 == 1 )  {
	        // La consulta se llevó a cabo con exito o existe el artículo en LA BODEGA.	 
		    $jsondata = mysql_fetch_assoc($query2);
	        
		    $jsondata_return = array (
	                                 'stock_actual' => $jsondata['stock_actual']
									 );
		} else { 
		    // Esto significa que no se encontró el artículo en esa bodega.
			$jsondata_return = array (
			                         'stock_actual' => "0" 
			                          );
		}
	 
	  break;
  
	 }  // Fin del switch

      echo json_encode($jsondata_return);
	
?>