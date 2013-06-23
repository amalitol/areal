<?php
/*
 * $.ajax() 
 -> Archivo que permite mediante AJAX buscar si existe un duplicado del Nombre de Usuario - usuario que estoy introcuciendo en el sistema 
   módulo USUARIOS -> nuevo USUARIO */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DEL CAMPO id_usuario DE LA TABLA data_usuarios Y SE DETERMINA SI YA EXISTE EL USUARIO EN LA BD */

//01 RECIBO LAS VARIABLES $_GET.
     
	 $user_name = $_GET['user_name'];        //  NOMBRE DE USUARIO QUE VOY A CHEQUEAR SI ESTÁ O NO EN EL SISTEMA.
	 
//02 REALIZO LA CONSULTA EN LA BASE DE DATOS PARA SABER SI EL NOMBRE DE USUARIO QUE ESTOY INTRODUCIENDO YA ESTÁ EN EL SISTEMA ¿?
     
	 $query1 = "SELECT id_usuario FROM data_usuarios WHERE usuario='".$user_name."' AND usuario!=''";
	 $query1 = mysql_query($query1);
	 $num_rows_query1 = mysql_num_rows($query1);
	 if ( $num_rows_query1 > 0 )  {
		 // Esto significa que ya existe el USUARIO en la BD. DEBE SER ERROR.
		 $jsondata_return = array (
	                               'usuario' => 'false'
								  );	 
     
	 } else {
		 // Esto significa que NO existe el USUARIO en la BD. MENSAJE DE OK  
         $jsondata_return = array (
	                               'usuario' => 'true'
								  );	
	 }
	 
	 echo json_encode($jsondata_return);
	
?>