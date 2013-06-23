<?php
/*
 * $.ajax() 
 */
/* Archivo que permite mediante AJAX buscar el saldo de la CAJA que hay en el LOCAL ORIGEN Y ME LO MUESTRA EN EL CAMPO text Saldo en Caja ..... del módulo CAJA -> CREAR TRANSACCIÓN */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DEL CAMPO saldo DE LA TABLA DINÁMICA cajaalmacen_(id) ó cajacentral_1 Y SE PASA DINAMICAMENTE AL CAMPO TEXT DEL FORMULARIO DE ENTRADA DE DATOS DE ---- CREAR TRANSACCIÓN ---- */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $id_local     =  $_GET['id_local'];    // id DEL LOCAL PARA AVERIGUAR LA TABLA DONDE VOY A BUSCAR EL SALDO.

//02 REALIZO LA CONSULTA EN LA BASE DE DATOS PARA OBTENER LOS DATOS DEL SALDO.
     switch($id_local)
	 {
	  // CASO 1
	  case "1":
	    // CASO CAJA CENTRAL (BODEGA) QUE ES UNA SOLA
	    $query1 = "SELECT saldo FROM cajacentral_1 ORDER BY id DESC LIMIT 1";
		$query1 = mysql_query($query1);
		$num_rows_query1 = mysql_num_rows($query1); 
        if ( $num_rows_query1 == 1 )  {
	        // La consulta se llevó a cabo con exito o existe SALDO en la CAJA CENTRAL.	 
		    $jsondata = mysql_fetch_assoc($query1);
			
		    $jsondata_return = array (
	                                 'saldo' => $jsondata['saldo']
									 );
	
		} else { 
		    // Esto significa que no se encontró SALDO en la CAJA CENTRAL.
			$jsondata_return = array (
			                         'saldo' => "0" 
			                          );
		}
	  
	  break;
	  
	  // CASO 2
	  case "seleccione":
	       // SI SELECCIONO LA OPCIÓN "Seleccione"
		   $jsondata_return = array (
			                         'saldo' => "no" 
			                          );
	  break;
	  
	  // CASO 3
	  case "otros":
	       // SI SELECCIONO LA OPCIÓN "Otros"
	       $jsondata_return = array (
			                         'saldo' => "no" 
			                          );    
	  break;
	    
	  // CASO 4
	  default:	 
        // CASO CAJA DEL ALMACÉN QUE PUEDEN SER UNOS CUANTOS
	    $query2 = "SELECT saldo FROM cajaalmacen_".$id_local." ORDER BY id DESC LIMIT 1";
		$query2 = mysql_query($query2);
	    $num_rows_query2 = mysql_num_rows($query2); 
        if ( $num_rows_query2 == 1 )  {
	        // La consulta se llevó a cabo con exito o existe SALDO en la CAJA DEL ALMACÉN SELECCIONADO.	 
		    $jsondata = mysql_fetch_assoc($query2);
	        
		    $jsondata_return = array (
	                                 'saldo' => $jsondata['saldo']
									 );
		} else { 
		    // Esto significa que no se encontró el artículo en esa bodega.
			$jsondata_return = array (
			                         'saldo' => "0" 
			                          );
		}
 
	  break;
  
	 }  // Fin del switch

      echo json_encode($jsondata_return);
		
?>