<?php
/*
 * $.ajax() 
 */

/* Archivo que permite mediante AJAX busca si existe un duplicado de la CÉDULA del proveedor-cliente que estoy introcuciendo en el sistema 
   módulo PROVEEDORES -> nuevo Proveedor
   módulo CLIENTES -> nuevo Cliente */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DEL CAMPO id DE LA TABLA proveedores_clientes Y SE DETERMINA SI YA EXISTE LA CÉDULA INTRODUCIDA EN LA BD */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $cedula_proveedor =  $_GET['cedula'];        //  CÉDULA DEL PROVEEDOR QUE VOY A CHEQUEAR SI ESTÁ O NO EN EL SISTEMA.

//02 REALIZO LA CONSULTA EN LA BASE DE DATOS PARA SABER SI LA CÉDULA QUE ESTOY INTRODUCIENDO YA ESTÁ EN EL SISTEMA ¿?
     
	 $query1 = "SELECT id FROM proveedores_clientes WHERE cedula='".$cedula_proveedor."' AND cedula!=''";
	 $query1 = mysql_query($query1);
	 $num_rows_query1 = mysql_num_rows($query1);
	 if ( $num_rows_query1 > 0 )  {
		 // Esto significa que ya existe el RUC en la BD. DEBE SER ERROR.
		 $jsondata_return = array (
	                                 'cedula' => 'false'
									 );	 
     
	 } else {
		 // Esto significa que NO existe el RUC en la BD. MENSAJE DE OK  
         $jsondata_return = array (
	                                 'cedula' => 'true'
									 );	
	}
	
	echo json_encode($jsondata_return);
		
?>