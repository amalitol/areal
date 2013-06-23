<?php
include_once('connection.php');

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_proveedores   *****/

//01 proveedores_del_sistema()   --> Función que muestra todos los proveedores que están actualmente en la BD.
//02 process_new_proveedor()     --> Función que procesa el formulario para agregar un NUEVO proveedor.
//03 ver_proveedor($a)           --> Función que devuelve los datos del proveedor a VER seleccionado por el usuario.
//04 ver_contactos_proveedor()   --> Función que devuelve los contactos del proveedor selecionado en EDITAR
//05 process_edit_proveedor()    --> Función que procesa el formulario para EDITAR el proveedor seleccionado.
//06 process_new_contacto()      --> Función que procesa el formulario de NUEVO contacto para un proveedor.
//07 process_delete_proveedor()  --> Función que borra el proveedor seleccionado.
//08 process_delete_contacto()   --> Función que borrar de la BD los contactos seleccionados para un proveedor.
//09 process_edit_contacto()     --> Función que procesa el formulario para EDITAR el contacto seleccionado.

/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_proveedores  *****/

/************************************************************************************************************/

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_proveedores   *****/
//01
  function proveedores_del_sistema()
  {
	  // Función que muestra todos los proveedores que están actualmente en la BD.
	  
	  //01 Selecciono todos los proveedores que estén en la BD 
	  $query01 = "SELECT * FROM proveedores_clientes WHERE active_proveedor=1 ORDER BY nombre ASC";
	  $query01 = mysql_query($query01);
	  $num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  
		  // Esto significa que hay proveedores en la tabla de BD los guardo en un array para devolverlos
		  for ( $i=0; $i < $num_rows_query01; $i++ )
		  {
		      $registro_proveedores[$i] = mysql_fetch_assoc($query01);
		  }
	  	  
	  } else {
		 //02 Si no hay proveedores devuelvo un valor nulo. 
		 return "null";
		   
	  }
	  
	  //03 Si hay proveedores en la base de datos devuelvo los regsitros de estos.  
	  return $registro_proveedores;
		  
  }  // Fin de la función proveedores_del_sistema()
   
//02 
   function process_new_proveedor()
   {
	   // Función que procesa el formulario para agregar un nuevo proveedor.
      //01 RECIBO LAS VARIABLES $_POST
      $fecha_registro_proveedor  = addslashes($_POST['fecha_registro_proveedor']);
	  $nombre_proveedor          = addslashes($_POST['nombre_proveedor']);
	  $direccion_proveedor       = addslashes($_POST['direccion_proveedor']);
	  $ruc_proveedor             = addslashes($_POST['ruc_proveedor']);
	  $telefono_proveedor        = addslashes($_POST['telefono_proveedor']);
	  $fax_proveedor             = addslashes($_POST['fax_proveedor']);
	  $email_proveedor           = addslashes($_POST['email_proveedor']);
      $cedula_proveedor          = addslashes($_POST['cedula_proveedor']);
	  $descripcion_proveedor     = addslashes($_POST['descripcion_proveedor']);
   
      if ( isset($_POST['cliente_select']) )  {          // Este es el checkbox para saber si el prov. es cliente too.
		  $cliente_select = $_POST['cliente_select'];  
	  } else {
		  $cliente_select = "off";  
	  }
	  
	  //1.1 Este es el valor a insertar en el último campo de la tabla proveedores de acuerdo al valor de $cliente_select
	  if ( $cliente_select == "off" )  {
		  $cliente = 0;
	  }  else  {
		  $cliente = 1; 	  
	  }
	    
	  //02 INSERTO EN LA BD proveedores.
	  $query02 = "INSERT INTO proveedores_clientes (fecha_registro, nombre, direccion, ruc, descripcion, telefono, fax, email, cedula,  active_proveedor, active_cliente) VALUES('".$fecha_registro_proveedor."', '".$nombre_proveedor."', '".$direccion_proveedor."', '".$ruc_proveedor."', '".$descripcion_proveedor."', '".$telefono_proveedor."', '".$fax_proveedor."', '".$email_proveedor."', '".$cedula_proveedor."', 1, ".$cliente.")"; 
	  $query02 = mysql_query($query02);
	  $num_rows_query02 = mysql_affected_rows();
	  if ( $num_rows_query02 == 1 )   {
		 // 03 Verifico si se insertó bien en la bd mando el header.  
		 		   
	      header('Location: ../index.php?mod=mod_proveedores#tabs-2');
	  
	  }  else  {  echo mysql_error();  }
	   
   }   // Fin de la function process_new_proveedor()
 
//03 
   function ver_proveedor($id)
   {
	   //  Función que devuelve los datos del proveedor a VER seleccionado por el usuario.  
      	  
	  $query03 = "SELECT * FROM proveedores_clientes WHERE id='".$id."' AND active_proveedor=1";
      $query03 = mysql_query($query03);
	  $num_rows_query03 = mysql_num_rows($query03);
      if ( $num_rows_query03 == 1 )  {
		  
		  $registro_proveedor = mysql_fetch_assoc($query03);  
		  return $registro_proveedor;
		  
	  } else { echo mysql_error(); }
   
   }  // Fin de la function ver_proveedor()
 
//04 
   function ver_contactos_proveedor()
   {
	   // Función que devuelve los contactos del proveedor selecionado en EDITAR  
      $id = $_GET['id'];
	  
	  $query04 = "SELECT * FROM proveedores_clientes_contactos WHERE id_proveedor_cliente='".$id."' AND active_proveedor=1";
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
        
   }  // fin de la function ver_contactos_proveedor()
  
//05
   function process_edit_proveedor()
   {
	   //  Función que procesa el formulario para EDITAR el proveedor seleccionado.  
      //01 RECIBO LAS VARIABLES $_POST
      $fecha_registro_proveedor  = addslashes($_POST['fecha_registro_proveedor']);
	  $nombre_proveedor          = addslashes($_POST['nombre_proveedor']);
	  $direccion_proveedor       = addslashes($_POST['direccion_proveedor']);
	  $ruc_proveedor             = addslashes($_POST['ruc_proveedor']);
	  $telefono_proveedor        = addslashes($_POST['telefono_proveedor']);
	  $fax_proveedor             = addslashes($_POST['fax_proveedor']);
	  $email_proveedor           = addslashes($_POST['email_proveedor']);
      $cedula_proveedor          = addslashes($_POST['cedula_proveedor']);
	  $descripcion_proveedor     = addslashes($_POST['descripcion_proveedor']);
      $id_p                      = $_POST['id_p'];   // hidden con el id que voy a editar
   
      if ( isset($_POST['cliente_select']) )  {
		  $cliente_select = $_POST['cliente_select'];  
	  } else {
		  $cliente_select = "off";  
	  }
	  
	  //1.1 Este es el valor a insertar en el último campo de la tabla proveedores de acuerdo al valor de $cliente_select
	  if ( $cliente_select == "off" )  {
		  $cliente = 0;
	  }  else  {
		  $cliente = 1; 	  
	  }
	    
	  //02 UPDATE EN LA BD proveedores_clientes.
	  $query05 = "UPDATE proveedores_clientes SET fecha_registro='".$fecha_registro_proveedor."', nombre='".$nombre_proveedor."', direccion='".$direccion_proveedor."', ruc='".$ruc_proveedor."', descripcion='".$descripcion_proveedor."', telefono='".$telefono_proveedor."', fax='".$fax_proveedor."', email='".$email_proveedor."', cedula='".$cedula_proveedor."', active_proveedor=1, active_cliente=".$cliente." WHERE id='".$id_p."'";
	  $query05 = mysql_query($query05);
	  // 03 VERIFICO SI ESTÁ SELECCIONADA LA CASILLA CLIENTES Y SI ES ASÍ ACTUALIZO TODOS LOS CONTACTOS.  
	  if ( $cliente_select == "on" )   {
	     
	     $query051 = "UPDATE proveedores_clientes_contactos SET active_proveedor=1, active_cliente=1 WHERE id_proveedor_cliente='".$id_p."'";
		 $query051 = mysql_query($query051);
	     //05 Si se insertó correctamente entonces devuelvo un header  
		 header('Location: ../index.php?mod=mod_proveedores#tabs-2');
		
	  } else {
		 
		 $query052 = "UPDATE proveedores_clientes_contactos SET active_proveedor=1, active_cliente=0 WHERE id_proveedor_cliente='".$id_p."'";
	     $query052 = mysql_query($query052);
	     //06 Si se insertó correctamente entonces devuelvo un header  	  
		 header('Location: ../index.php?mod=mod_proveedores#tabs-2');
		 
	  }  
	  
   }  // fin de la function process_edit_proveedor()
    
//06 
   function process_new_contacto()
   { 
       //  Función que procesa el formulario de NUEVO contacto para un proveedor.  
       //01 RECIBO LAS VARIABLES $_POST
      $nombre_contacto     = addslashes($_POST['nombre_contacto']);
	  $telefono_contacto   = addslashes($_POST['telefono_contacto']);
	  $cell_contacto       = addslashes($_POST['cell_contacto']);
	  $fax_contacto        = addslashes($_POST['fax_contacto']);
	  $email_contacto      = addslashes($_POST['email_contacto']);
	  $cedula_contacto     = addslashes($_POST['cedula_contacto']);
	  $id_p                = $_POST['id_p'];   // hidden con el id que voy a agregar
   
      //02 Busco en la tabla proveedores_clientes si ese id es también CLIENTE
      $query06 = "SELECT active_cliente FROM proveedores_clientes WHERE id='".$id_p."'";
      $query06 = mysql_query($query06);
      $num_rows_query06 = mysql_num_rows($query06);
	  if ( $num_rows_query06 == 1 )  {
		  // Esto significa que la consulta fue correcta extraigo el valor de active_cliente ( 0 o 1 )
		  $active_cliente = mysql_fetch_assoc($query06); 
		  
		  //03 Introduzco el valor del nuevo contacto en la BD.
		  $query061 = "INSERT INTO proveedores_clientes_contactos ( id_proveedor_cliente, active_proveedor, active_cliente, nombre_contacto, telefono_contacto, cell_contacto, fax_contacto, email_contacto, cedula_contacto ) VALUES ( '".$id_p."', 1, ".$active_cliente['active_cliente'].", '".$nombre_contacto."','".$telefono_contacto."', '".$cell_contacto."', '".$fax_contacto."', '".$email_contacto."', '".$cedula_contacto."' )";
	      $query061 = mysql_query($query061);
		  $num_rows_query061 = mysql_affected_rows(); 
	      if ( $num_rows_query061 == 1 )   {
			  // Esto significa que se realizó correctamente la consulta envío un header.
		      header('Location: ../index.php?mod=mod_proveedores&option=edit&id='.$id_p.'#tabs-2'); 
		  		  
		  }
	    
	  } else { echo mysql_error(); } 
   
   }   // fin de la function process_new_contacto()
   
//07
   function process_delete_proveedor()  
   {
	   // Función que borra el proveedor seleccionado.  
       //01 RECIBO LA VARIABLE $_POST['proveedor_id'] con el id del proveedor que voy a BORRAR.
	   $proveedor_id = $_POST['proveedor_id']; 
   
       //02 BORRO EL REGISTRO SELECCIONADO DE LA BD proveedores_clientes
	   $query07 = "DELETE FROM proveedores_clientes WHERE id='".$proveedor_id."'";
       $query07 = mysql_query($query07);
	   $num_rows_query07 = mysql_affected_rows();
       if ( $num_rows_query07 > 0 )   {
		   // Esto significa que se borró bien de la BD. 
		   //03 AHORA BORRO LOS REGISTROS DE LA TABLA proveedores_clientes_contactos
		   $query071 = "DELETE FROM proveedores_clientes_contactos WHERE id_proveedor_cliente='".$proveedor_id."'";
           $query071 = mysql_query($query071);
	       
		   header('Location:../index.php?mod=mod_proveedores&option=delete#tabs-2');
		  		   
	   } else { echo mysql_error(); }
     
   }   // Fin de la function process_delete_proveedor()
   
//08 
    function process_delete_contacto()
	{
		// Función que borrar de la BD los contactos seleccionados para un proveedor.  
        //01 INICIALIZACIÓN DE VARIABLES
	   $num_filas = 0;
	   
	   //02 RECIBO LAS VARIABLES $_POST DE LOS PROVEEDORES QUE VOY A BORRAR.
	   foreach($_POST as $key => $value) 
       {
		  if($key == "id_proveedor") {   // Campo hidden con el id que voy a devolver en el header
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
      header('Location: ../index.php?mod=mod_proveedores&option=edit&id='.$_POST['id_proveedor'].'&del='.$num_filas.'#tabs-2');
  
	}  // Fin de la function process_delete_contacto()
   
//09 
   function process_edit_contacto()
   { 
       // Función que procesa el formulario para EDITAR el contacto seleccionado.  
       //01 RECIBO LAS VARIABLES $_POST
      $nombre_contacto     = addslashes($_POST['nombre_contacto']);
	  $telefono_contacto   = addslashes($_POST['telefono_contacto']);
	  $cell_contacto       = addslashes($_POST['cell_contacto']);
	  $fax_contacto        = addslashes($_POST['fax_contacto']);
	  $email_contacto      = addslashes($_POST['email_contacto']);
	  $cedula_contacto     = addslashes($_POST['cedula_contacto']);
	  $id_c                = $_POST['id_c'];   // hidden con el id que voy a editar de la tabla proveedores_clientes_contactos
      $id_p                = $_POST['id_p'];   // hidden con el id del proveedor que voy a editar       
	  
	  //02 UPDATE EN LA BD proveedores_clientes_contactos.
	  $query09 = "UPDATE proveedores_clientes_contactos SET nombre_contacto='".$nombre_contacto."', telefono_contacto='".$telefono_contacto."', cell_contacto='".$cell_contacto."', fax_contacto='".$fax_contacto."', email_contacto='".$email_contacto."', cedula_contacto='".$cedula_contacto."' WHERE id='".$id_c."'";
	  $query09 = mysql_query($query09);
	  
	     //05 Si se insertó correctamente entonces devuelvo un header  
		 header('Location: ../index.php?mod=mod_proveedores&option=edit&id='.$id_p.'#tabs-2');
		
   }  // Fin de la function process_edit_contacto()
  
    
  /*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_proveedores  *****/
  
  if ( isset($_GET['data']) && $_GET['data'] == "new" )   {
	  // Esto es para procesar los datos para insertar nuevos proveedores   
	  process_new_proveedor();
  } else if ( isset($_GET['data']) && $_GET['data'] == "edit" )   {
	  // Esto es para procesar los datos para editar el proveedor seleccionado   
	  process_edit_proveedor();
  } else if ( isset($_GET['contacto']) && $_GET['contacto'] == "new" )   {
	  // Esto es para procesar los datos para insertar nuevos contactos    
	  process_new_contacto();
  } else if ( isset($_GET['delete']))   {
	  // Esto es para borrar el proveedor seleccionado  
	  process_delete_proveedor();
  }  else if ( isset($_GET['contacto']) && $_GET['contacto'] == "delete" )   {
	  // Esto es para borrar los contactos seleccionados en el checkbox  
	  process_delete_contacto();
  }  else if ( isset($_GET['contacto']) && $_GET['contacto'] == "edit" )   {
	  // Esto es para actualizar el contacto seleccionado en el radio botón.  
	  process_edit_contacto();
  }
