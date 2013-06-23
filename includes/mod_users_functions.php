<?php
@session_start();
include_once('connection.php');

/****** ((00)) VARIABLES  *****/ #tabs-2
/************************
 Primer nivel:   Refieren al módulo en cuestion 
              mod=mod_users 
/************************
 Segundo nivel:  Refieren a los elementos del menu superior        
             (1) optionusers=new                                      
			 (2) optionusers=ch_pass                                              
              
/************************
  Tercer nivel(I):  Refieren a los elementos que voy a mostrar dentro de un elemento del menu superior				 
             De (1) etype= (error_bodega_ok) (true_new_almacen) (error_bodega_no) (true_new_bodega) (success) 
             De (2) movtype= (ok)
             De (3) karart= (ver)  --> No lleva header... <--
             De (4) stockl= (ver)  --> No lleva header... <-- 
			 De (5) resmov= (ver)  --> No lleva header... <--

  Tercer nivel(II):  Refieren a al cantidad de movimientos pendientes seleccionados e insertados en sus respectivas TABLAS				 
             De (4) stockins= (#)  --> 1, 2, 3, 4 <--  
/************************			 
  Cuarto nivel:  Refieren al id del artículo del cual voy a ver los detalles.			 
             De (8) id= (#)  --> 1, 2, 3, 4 <--  

				 
/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_users   *****/

//01 general_users()   --> Función que muestra los resultados del resumen de USUARIOS.
//02 users_system()    --> Función que muestra todos los usuarios que están actualmente en la BD.
//03 process_accion_user($a,$b) --> Función que permite habilitar o inhabilitar a un usuario en la BD.
//04 process_new_user() --> Función que procesa los datos que introducen un nuevo USUARIO en la BD. 
//05 process_change_pass() --> Función que procesa los datos que introducen una nueva CONTRASEÑA al usuario seleccionado en la BD. 
	  

/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_users  *****/

/************************************************************************************************************/


/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_users  *****/
  
//01 
  function general_users()
  {
	  // Función que muestra los resultados del resumen de USUARIOS.
  
      $habilitados = 0;
  
      $query01 = "SELECT * FROM data_usuarios";
	  $query01 = mysql_query($query01);
	  $num_rows_query01 = mysql_num_rows($query01);
      if ( $num_rows_query01 > 0 )  {
		  // Esto significa que existe al menos una fila de usuarios en la BD.  
		  for ( $i=0; $i < $num_rows_query01; $i++ )
		  {
			  $users[$i] = mysql_fetch_assoc($query01);  
		  }
		
	      for ( $i=0; $i < $num_rows_query01; $i++ )
		  {
			  // Ahora busco los datos que voy a devolver
			  if ( $users[$i]['habilitar'] == 1 )  {
				  $habilitados++;  
			  } else {
				  continue;  
			  }
		  } 
		      
		  $result[0] = $num_rows_query01;
		  $result[1] = $habilitados;
		  $result[2] = $num_rows_query01 - $habilitados;
		  return $result;
	  
	  } else { echo mysql_error(); }
   
  }  // Fin de la función general_users()
  
//02 
  function users_system()
  {
	  // Función que muestra todos los usuarios que están actualmente en la BD.
  
      $query02 = "SELECT data_usuarios.id_usuario, data_usuarios.usuario, data_usuarios.nombre_completo, data_usuarios.tipo_usuario, locales_inventarios.nombre_local, data_usuarios.habilitar FROM data_usuarios, locales_inventarios WHERE data_usuarios.id_local=locales_inventarios.id ORDER BY data_usuarios.habilitar=0, data_usuarios.id_usuario ASC";
	  $query02 = mysql_query($query02);
	  $num_rows_query02 = mysql_num_rows($query02);
      if ( $num_rows_query02 > 0 )  {
		  // Esto significa que existe al menos una fila de usuarios en la BD.  
		  for ( $i=0; $i < $num_rows_query02; $i++ )
		  {
			  $users[$i] = mysql_fetch_assoc($query02);  
		  }
		  
	  return $users;
	  
	  } else { echo mysql_error(); }
     
  }  // Fin de la función users_system()
	  
//03 
  function process_accion_user($acc, $num)
  {
	  //  Función que permite habilitar o inhabilitar a un usuario en la BD.	  
  
      //01
      $query03 = "UPDATE data_usuarios SET habilitar=".$acc." WHERE id_usuario='".$num."'";
	  $query03 = mysql_query($query03);
      $num_rows_query03 = mysql_affected_rows();
	  if ( $num_rows_query03 > 0 )   {
		  // Esto significa que se UPDATE bien en la BD.  
		  
		  header('Location: ../index.php?mod=mod_users#tabs-2');
	   	    
	  } else { echo mysql_error(); }
    
  }   // Fin de la función accion_users()
	  
//04
  function process_new_user() 
  {
	  // Función que procesa los datos que introducen un nuevo USUARIO en la BD. 	  
  
      // Recibo las variables $_POST
	  $arr = $_POST;
	  
	  switch($arr['tipo_usuario'])
	  {
	       // CASO 1 -> ADMINISTRADOR
	       case "a":
		       $query041 = "INSERT INTO data_usuarios (usuario, contrasena, nombre_completo, tipo_usuario, id_local, habilitar) VALUES('".addslashes($arr['nombre_usuario'])."', '".$arr['contrasena_hidden']."', '".addslashes($arr['nombre_apellidos'])."', '".$arr['tipo_usuario']."', '1', 1 )"; 
			   $query041 = mysql_query($query041);
			   $num_rows_query041 = mysql_affected_rows();
		       if ( $num_rows_query041 > 0 )  {
				   // ESto significa que se insertó bien el usuario en la BD.
				   
				   header('Location: ../index.php?mod=mod_users&atype=ok#tabs-2');
				   
			   } else { echo mysql_error(); } 
		   break;
		   // CASO 2 -> VENDEDOR
		   case "v":
	            $query042 = "INSERT INTO data_usuarios (usuario, contrasena, nombre_completo, tipo_usuario, id_local, habilitar) VALUES('".addslashes($arr['nombre_usuario'])."', '".$arr['contrasena_hidden']."', '".addslashes($arr['nombre_apellidos'])."', '".$arr['tipo_usuario']."', '".$arr['id_almacen']."', 1 )"; 
			   $query042 = mysql_query($query042);
			   $num_rows_query042 = mysql_affected_rows();
		       if ( $num_rows_query042 > 0 )  {
				   // ESto significa que se insertó bien el usuario en la BD.
				   
				   header('Location: ../index.php?mod=mod_users&atype=ok#tabs-2');
				   
			   } else { echo mysql_error(); } 
	       break;
	    
	  }  // Fin del switch
    
  }  // Fin de la función process_new_user()
		  
  //05 
  function process_change_pass()
  {
	  // Función que procesa los datos que introducen una nueva CONTRASEÑA al usuario seleccionado en la BD. 
      
	  //01 Recibo las variables $_POST
	  $arr = $_POST;
      
	  //02 Hago el UPDATE de la consulta en la BD.
      $query05 = "UPDATE data_usuarios SET contrasena='".$arr['contrasena_chp_hidden']."' WHERE id_usuario='".$arr['id_usuario']."'";
	  $query05 = mysql_query($query05);
      $num_rows_query05 = mysql_affected_rows();
      
	     header('Location: ../index.php?mod=mod_users&atype=chp#tabs-2');
   
  }   // Fin de la función process_change_pass()
	  
	  	  
  /*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_users  *****/
  
  if ( isset($_GET['acc']) && isset($_GET['num']) )   {
	  // Esto es para procesar los datos que me indican HABILITAR-DESHABILITAR un usuario en la BD.
	  process_accion_user($_GET['acc'], $_GET['num']);
  
  } else if ( isset($_GET['data']) && $_GET['data'] == "new_user" )   {
	  // Esto es para procesar los datos que introducen un nuevo USUARIO en la BD. 
	  process_new_user();
  } else if ( isset($_GET['data']) && $_GET['data'] == "change_pass" )   {
	  // Esto es para procesar los datos que introducen una nueva CONTRASEÑA al usuario seleccionado en la BD. 
	  process_change_pass();
  } 
  
?>	  