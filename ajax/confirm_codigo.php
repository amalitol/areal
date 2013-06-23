<?php
/*
 * $.ajax() 
 */

/* Archivo que permite mediante AJAX busca si existe un duplicado del CÓDIGO del artículo que estoy introcuciendo en el sistema 
   módulo INVENTARIO -> nuevo Artículo  */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DEL CAMPO codigo_art DE LA TABLA articulos_inventario Y SE DETERMINA SI YA EXISTE EL CÓDIGO INTRODUCIDO EN LA BD */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $codigo_art =  $_GET['codigo_art'];        //  CÓDIGO DEL ARTÍCULO QUE VOY A CHEQUEAR SI ESTÁ O NO EN EL SISTEMA.

//02 REALIZO LA CONSULTA EN LA BASE DE DATOS PARA SABER SI EL RUC QUE ESTOY INTRODUCIENDO YA ESTÁ EN EL SISTEMA ¿?
     
	 $query1 = "SELECT id FROM articulos_inventario WHERE codigo_art='".$codigo_art."' AND codigo_art!=''";
	 $query1 = mysql_query($query1);
	 $num_rows_query1 = mysql_num_rows($query1);
	 if ( $num_rows_query1 > 0 )  {
		 // Esto significa que ya existe el RUC en la BD. DEBE SER ERROR.
		 $jsondata_return = array (
	                                 'codigo_art' => 'false'
									 );	 
     
	 } else {
		 // Esto significa que NO existe el RUC en la BD. MENSAJE DE OK  
         $jsondata_return = array (
	                                 'codigo_art' => 'true'
									 );	
	}
	 
	echo json_encode($jsondata_return);
		
?>