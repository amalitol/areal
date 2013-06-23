<?php
/*
 * $.ajax() 
 -> Archivo que permite mediante AJAX buscar si existe un duplicado del RUC del proveedor - cliente que estoy introcuciendo en el sistema 
   módulo PROVEEDORES -> nuevo Proveedor 
   módulo CLIENTES -> nuevo Cliente */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DEL CAMPO id DE LA TABLA proveedores_clientes Y SE DETERMINA SI YA EXISTE EL RUC INTRODUCIDO EN LA BD */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $ruc_proveedor =  $_GET['ruc'];        //  RUC DEL PROVEEDOR - CLIENTE QUE VOY A CHEQUEAR SI ESTÁ O NO EN EL SISTEMA.
	 
//02 REALIZO LA CONSULTA EN LA BASE DE DATOS PARA SABER SI EL RUC QUE ESTOY INTRODUCIENDO YA ESTÁ EN EL SISTEMA ¿?
     
	 $query1 = "SELECT id FROM proveedores_clientes WHERE ruc='".$ruc_proveedor."' AND ruc!=''";
	 $query1 = mysql_query($query1);
	 $num_rows_query1 = mysql_num_rows($query1);
	 if ( $num_rows_query1 > 0 )  {
		 // Esto significa que ya existe el RUC en la BD. DEBE SER ERROR.
		 $jsondata_return = array (
	                               'ruc' => 'false'
								  );	 
     
	 } else {
		 // Esto significa que NO existe el RUC en la BD. MENSAJE DE OK  
         $jsondata_return = array (
	                               'ruc' => 'true'
								  );	
	 }
	 
	 echo json_encode($jsondata_return);
	
?>