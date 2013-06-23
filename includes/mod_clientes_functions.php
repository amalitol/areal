<?php
include_once('connection.php');

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_clientes   *****/

//..01 clientes_del_sistema()            --> Función que muestra todos los clientes que están actualmente en la BD.
//..02 process_new_cliente()             --> Función que procesa el formulario para agregar un NUEVO cliente.
//..03 ver_cliente($a)                     --> Función que devuelve los datos del cliente a VER seleccionado por el usuario.
//..04 ver_contactos_cliente()           --> Función que devuelve los contactos del cliente selecionado en EDITAR
//..05 process_edit_cliente()            --> Función que procesa el formulario para EDITAR el cliente seleccionado.
//..06 process_new_contacto_cliente()    --> Función que procesa el formulario de NUEVO contacto para un cliente.
//..07 process_delete_cliente()          --> Función que borra el cliente seleccionado.
//..08 process_delete_contacto_cliente() --> Función que borrar de la BD los contactos seleccionados para un cliente.
//..09 process_edit_contacto_cliente()   --> Función que procesa el formulario para EDITAR el contacto seleccionado.


/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_clientes  *****/

/************************************************************************************************************/

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_clientes   *****/
//01
  function clientes_del_sistema()
  {
	  // Función que muestra todos los clientes que están actualmente en la BD.
	  
	  //01 Selecciono todos los clientes que estén en la BD 
	  $query01 = "SELECT * FROM proveedores_clientes WHERE active_cliente=1 ORDER BY nombre ASC";
	  $query01 = mysql_query($query01);
	  $num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  
		  // Esto significa que hay proveedores en la tabla de BD los guardo en un array para devolverlos
		  for ( $i=0; $i < $num_rows_query01; $i++ )
		  {
		      $registro_clientes[$i] = mysql_fetch_assoc($query01);
		  }
	  
	  
	  } else {
		 //02 Si no hay proveedores devuelvo un valor nulo. 
		 return "null";
		   
	  }
	  
	  //03 Si hay proveedores en la base de datos devuelvo los regsitros de estos.  
	  return $registro_clientes;
		  
  }  // Fin de la función clientes_del_sistema()
   
//02 
   function process_new_cliente()
   {
	   // Función que procesa el formulario para agregar un nuevo cliente.
      //01 RECIBO LAS VARIABLES $_POST
      $fecha_registro_cliente  = addslashes($_POST['fecha_registro_cliente']);
	  $nombre_cliente          = addslashes($_POST['nombre_cliente']);
	  $direccion_cliente       = addslashes($_POST['direccion_cliente']);
	  $ruc_cliente             = addslashes($_POST['ruc_cliente']);
	  $telefono_cliente        = addslashes($_POST['telefono_cliente']);
	  $fax_cliente             = addslashes($_POST['fax_cliente']);
	  $email_cliente           = addslashes($_POST['email_cliente']);
      $cedula_cliente          = addslashes($_POST['cedula_cliente']);
	  $descripcion_cliente     = addslashes($_POST['descripcion_cliente']);
   
      if ( isset($_POST['proveedor_select']) )  {          // Este es el checkbox para saber si el cliente. es proveedor too.
		  $proveedor_select = $_POST['proveedor_select'];  
	  } else {
		  $proveedor_select = "off";  
	  }
	  
	  //1.1 Este es el valor a insertar en el penúltimo campo de la tabla proveedores_clientes de acuerdo al valor de $proveedor_select
	  if ( $proveedor_select == "off" )  {
		  $proveedor = 0;
	  }  else  {
		  $proveedor = 1; 	  
	  }
	    
	  //02 INSERTO EN LA BD proveedores_clientes.
	  $query02 = "INSERT INTO proveedores_clientes (fecha_registro, nombre, direccion, ruc, descripcion, telefono, fax, email, cedula, active_proveedor, active_cliente) VALUES('".$fecha_registro_cliente."', '".$nombre_cliente."', '".$direccion_cliente."', '".$ruc_cliente."', '".$descripcion_cliente."', '".$telefono_cliente."', '".$fax_cliente."', '".$email_cliente."', '".$cedula_cliente."', ".$proveedor.", 1)"; 
	  $query02 = mysql_query($query02);
	  $num_rows_query02 = mysql_affected_rows();
	  if ( $num_rows_query02 == 1 )   {
		 // 03 Verifico si se insertó bien en la bd mando el header.  
		 		   
	      header('Location: ../index.php?mod=mod_clientes#tabs-1');
	  
	  }  else  {  echo mysql_error();  }
	  
   }   // Fin de la function process_new_cliente()
 
//03 
   function ver_cliente($id)
   {
	  //  Función que devuelve los datos del proveedor a VER seleccionado por el usuario.  
         
	  $query03 = "SELECT * FROM proveedores_clientes WHERE id='".$id."' AND active_cliente=1";
      $query03 = mysql_query($query03);
	  $num_rows_query03 = mysql_num_rows($query03);
      if ( $num_rows_query03 == 1 )  {
		  
		  $registro_cliente = mysql_fetch_assoc($query03);  
		  return $registro_cliente;
		  
	  } else { echo mysql_error(); }
   
   }  // Fin de la function ver_proveedor()
 
//04 
   function ver_contactos_cliente()
   {
	   // Función que devuelve los contactos del cliente selecionado en EDITAR  
      $id = $_GET['id'];
	  
	  $query04 = "SELECT * FROM proveedores_clientes_contactos WHERE id_proveedor_cliente='".$id."' AND active_cliente=1";
      $query04 = mysql_query($query04);
	  $num_rows_query04 = mysql_num_rows($query04);
      if ( $num_rows_query04 > 0 )  {
		  // Guardo estos valores en un array para devolverlos  
		  for ( $i=0; $i < $num_rows_query04; $i++ )
		  {
		       $registro_contactos[$i] = mysql_fetch_assoc($query04);  
		  }
		  
		  return $registro_contactos;
		  
	  } else { 
	  
	      return "null";
	  }
        
   }  // fin de la function ver_contactos_cliente()
 
//05
   function process_edit_cliente()
   {
	   //  Función que procesa el formulario para EDITAR el cliente seleccionado.  
      //01 RECIBO LAS VARIABLES $_POST
      $fecha_registro_cliente  = addslashes($_POST['fecha_registro_cliente']);
	  $nombre_cliente          = addslashes($_POST['nombre_cliente']);
	  $direccion_cliente       = addslashes($_POST['direccion_cliente']);
	  $ruc_cliente             = addslashes($_POST['ruc_cliente']);
	  $telefono_cliente        = addslashes($_POST['telefono_cliente']);
	  $fax_cliente             = addslashes($_POST['fax_cliente']);
	  $email_cliente           = addslashes($_POST['email_cliente']);
      $cedula_cliente          = addslashes($_POST['cedula_cliente']);
	  $descripcion_cliente     = addslashes($_POST['descripcion_cliente']);
      $id_c                      = $_POST['id_c'];   // hidden con el id que voy a editar
   
      if ( isset($_POST['proveedor_select']) )  {
		  $proveedor_select = $_POST['proveedor_select'];  
	  } else {
		  $proveedor_select = "off";  
	  }
	  
	  //1.1 Este es el valor a insertar en el peúltimo campo de la tabla proveedores_clientes de acuerdo al valor de $proveedor_select
	  if ( $proveedor_select == "off" )  {
		  $proveedor = 0;
	  }  else  {
		  $proveedor = 1; 	  
	  }
	    
	  //02 UPDATE EN LA BD proveedores_clientes.
	  $query05 = "UPDATE proveedores_clientes SET fecha_registro='".$fecha_registro_cliente."', nombre='".$nombre_cliente."', direccion='".$direccion_cliente."', ruc='".$ruc_cliente."', descripcion='".$descripcion_cliente."', telefono='".$telefono_cliente."', fax='".$fax_cliente."', email='".$email_cliente."', cedula='".$cedula_cliente."', active_proveedor=".$proveedor.", active_cliente=1 WHERE id='".$id_c."'";
	  $query05 = mysql_query($query05);
	  // 03 VERIFICO SI ESTÁ SELECCIONADA LA CASILLA PROVEEDORES Y SI ES ASÍ ACTUALIZO TODOS LOS CONTACTOS.  
	  if ( $proveedor_select == "on" )   {
	     
	     $query051 = "UPDATE proveedores_clientes_contactos SET active_proveedor=1, active_cliente=1 WHERE id_proveedor_cliente='".$id_c."'";
		 $query051 = mysql_query($query051);
	     //05 Si se insertó correctamente entonces devuelvo un header  
		 header('Location: ../index.php?mod=mod_clientes#tabs-1');
			  
		 
	  
	  } else {
		 
		 $query052 = "UPDATE proveedores_clientes_contactos SET active_proveedor=0, active_cliente=1 WHERE id_proveedor_cliente='".$id_c."'";
	     $query052 = mysql_query($query052);
	     //06 Si se insertó correctamente entonces devuelvo un header  	  
		 header('Location: ../index.php?mod=mod_clientes#tabs-1');
		 
	  }  
	    
   }  // fin de la function process_edit_cliente()
  
//06 
   function process_new_contacto_cliente()
   { 
       //  Función que procesa el formulario de NUEVO contacto para un cliente.  
       //01 RECIBO LAS VARIABLES $_POST
      $nombre_contacto     = addslashes($_POST['nombre_contacto']);
	  $telefono_contacto   = addslashes($_POST['telefono_contacto']);
	  $cell_contacto       = addslashes($_POST['cell_contacto']);
	  $fax_contacto        = addslashes($_POST['fax_contacto']);
	  $email_contacto      = addslashes($_POST['email_contacto']);
	  $cedula_contacto     = addslashes($_POST['cedula_contacto']);
	  $id_c                = $_POST['id_c'];   // hidden con el id que voy a agregar del cliente
   
      //02 Busco en la tabla proveedores_clientes si ese id es también PROVEEDOR
      $query06 = "SELECT active_proveedor FROM proveedores_clientes WHERE id='".$id_c."'";
      $query06 = mysql_query($query06);
      $num_rows_query06 = mysql_num_rows($query06);
	  if ( $num_rows_query06 == 1 )  {
		  // Esto significa que la consulta fue correcta extraigo el valor de active_proveedor ( 0 o 1 )
		  $active_proveedor = mysql_fetch_assoc($query06); 
		  
		  //03 Introduzco el valor del nuevo contacto en la BD.
		  $query061 = "INSERT INTO proveedores_clientes_contactos ( id_proveedor_cliente, active_proveedor, active_cliente, nombre_contacto, telefono_contacto, cell_contacto, fax_contacto, email_contacto, cedula_contacto ) VALUES ( '".$id_c."', ".$active_proveedor['active_proveedor'].", 1, '".$nombre_contacto."','".$telefono_contacto."', '".$cell_contacto."', '".$fax_contacto."', '".$email_contacto."', '".$cedula_contacto."' )";
	      $query061 = mysql_query($query061);
		  $num_rows_query061 = mysql_affected_rows(); 
	      if ( $num_rows_query061 == 1 )   {
			  // Esto significa que se realizó correctamente la consulta envío un header.
		      header('Location: ../index.php?mod=mod_clientes&opt=editar&id='.$id_c.'#tabs-1'); 
		  		  
		  }
	  	  
	  } else { echo mysql_error(); } 
     
   }   // fin de la function process_new_contacto()
   
//07
   function process_delete_cliente()  
   {
	   // Función que borra el cliente seleccionado.  
       //01 RECIBO LA VARIABLE $_POST['cliente_id'] con el id del cliente que voy a BORRAR.
	   $cliente_id = $_POST['cliente_id']; 
   
       //02 BORRO EL REGISTRO SELECCIONADO DE LA BD proveedores_clientes
	   $query07 = "DELETE FROM proveedores_clientes WHERE id='".$cliente_id."'";
       $query07 = mysql_query($query07);
	   $num_rows_query07 = mysql_affected_rows();
       if ( $num_rows_query07 > 0 )   {
		   // Esto significa que se borró bien de la BD. 
		   //03 AHORA BORRO LOS REGISTROS DE LA TABLA proveedores_clientes_contactos
		   $query071 = "DELETE FROM proveedores_clientes_contactos WHERE id_proveedor_cliente='".$cliente_id."'";
           $query071 = mysql_query($query071);
	       
		   header('Location:../index.php?mod=mod_clientes&opt=delete#tabs-1');
		  	   
	   } else { echo mysql_error(); }
     
   }   // Fin de la function process_delete_proveedor()
   
//08 
    function process_delete_contacto_cliente()
	{
		// Función que borrar de la BD los contactos seleccionados para un proveedor.  
        //01 INICIALIZACIÓN DE VARIABLES
	   $num_filas = 0;
	   
	   //02 RECIBO LAS VARIABLES $_POST DE LOS PROVEEDORES QUE VOY A BORRAR.
	   foreach($_POST as $key => $value) 
       {
		  if($key == "id_cliente") {   // Campo hidden con el id que voy a devolver en el header
			  continue;
		  } else {
		      settype($key,"integer");
		      $query07 = "DELETE FROM proveedores_clientes_contactos WHERE id='".$key."'";
	          $query07 = mysql_query($query07);
	          $num_rows_query07 = mysql_affected_rows();
	          if ( $num_rows_query07 > 0 )  {
		          // Esto significa que se borró bien de la BD.
			      $num_filas++;         
		   
		      } else { echo mysql_error(); } 
		  	 
		  }
		   
	   }  // FIN DEL foreach
      
	  //03 AL TERMINAR DEVUELVO EL HEADER CON LA INFORMACIÓN DE CONTACTOS BORRADOS
      header('Location: ../index.php?mod=mod_clientes&opt=editar&id='.$_POST['id_cliente'].'&del='.$num_filas.'#tabs-1');
  
	}  // Fin de la function process_delete_contacto()
   
//09 
   function process_edit_contacto_cliente()
   { 
       // Función que procesa el formulario para EDITAR el contacto seleccionado.  
       //01 RECIBO LAS VARIABLES $_POST
      $nombre_contacto     = addslashes($_POST['nombre_contacto']);
	  $telefono_contacto   = addslashes($_POST['telefono_contacto']);
	  $cell_contacto       = addslashes($_POST['cell_contacto']);
	  $fax_contacto        = addslashes($_POST['fax_contacto']);
	  $email_contacto      = addslashes($_POST['email_contacto']);
	  $cedula_contacto     = addslashes($_POST['cedula_contacto']);
	  $id_contacto         = $_POST['id_contacto']; // hidden con el id que voy a editar de la tabla proveedores_clientes_contactos
      $id_c                = $_POST['id_c'];   // hidden con el id del cliente que voy a editar       
	  
	  //02 UPDATE EN LA BD proveedores_clientes_contactos.
	  $query09 = "UPDATE proveedores_clientes_contactos SET nombre_contacto='".$nombre_contacto."', telefono_contacto='".$telefono_contacto."', cell_contacto='".$cell_contacto."', fax_contacto='".$fax_contacto."', email_contacto='".$email_contacto."', cedula_contacto='".$cedula_contacto."' WHERE id='".$id_contacto."'";
	  $query09 = mysql_query($query09);
	  
	     //05 Si se insertó correctamente entonces devuelvo un header  
		 header('Location: ../index.php?mod=mod_clientes&opt=editar&id='.$id_c.'#tabs-1');
		
   }  // Fin de la function process_edit_contacto_cliente()
   
  
  /*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_clientes  *****/
  
  if ( isset($_GET['data']) && $_GET['data'] == "new" )   {
	  // Esto es para procesar los datos para insertar nuevos clientes   
	  process_new_cliente();
  } else if ( isset($_GET['data']) && $_GET['data'] == "editar" )   {
	  // Esto es para procesar los datos para editar el cliente seleccionado   
	  process_edit_cliente();
  } else if ( isset($_GET['contacto']) && $_GET['contacto'] == "new" )   {
	  // Esto es para procesar los datos para insertar nuevos contactos    
	  process_new_contacto_cliente();
  } else if ( isset($_GET['delete']))   {
	  // Esto es para borrar el cliente seleccionado  
	  process_delete_cliente();
  }  else if ( isset($_GET['contacto']) && $_GET['contacto'] == "delete" )   {
	  // Esto es para borrar los contactos seleccionados en el checkbox  
	  process_delete_contacto_cliente();
  }  else if ( isset($_GET['contacto']) && $_GET['contacto'] == "edit" )   {
	  // Esto es para actualizar el contacto seleccionado en el radio botón.  
	  process_edit_contacto_cliente();
  }

?>