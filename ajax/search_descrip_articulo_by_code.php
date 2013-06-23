<?php
/*
 * $.ajax() 
 */
/* Archivo que permite mediante AJAX buscar la descripción del artículo que ha seleccionado el usuario de acuerdo a su CÓDIGO ..... del módulo INVENTARIO-> MOVIMIENTO */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE LOS CAMPOS referencia_art DE LA TABLA articulos_inventario Y SE PASA DINAMICAMENTE AL CAMPO TEXT donde se debe mostrar la descripción */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $codigo_articulo =  $_GET['code'];  //  CÓDIGO DEL ARTÍCULO QUE QUIERO VER LA REFERENCIA.
	 
     $query1 = "SELECT referencia_art FROM articulos_inventario WHERE codigo_art='".$codigo_articulo."'";
     $query1 = mysql_query($query1);
     $num_rows_query1 = mysql_num_rows($query1);
	 if ( $num_rows_query1 > 0 )   {
		 // Esto significa que el artículo está bien seleccionado
          $jsondata = mysql_fetch_assoc($query1);
	        
		  $jsondata_return = array (
	                                 'referencia_art' => $jsondata['referencia_art'],
								     'resultado_query' => "ok",
									 
									);
	 
	 } else { 
	 
	      $jsondata_return = array (
			                         'referencia_art' => "",
									 'resultado_query' => "noitisnt" 
			                        );
	 
	 }

     echo json_encode($jsondata_return);

?>