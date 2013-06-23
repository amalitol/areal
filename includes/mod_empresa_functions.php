<?php
include_once('connection.php');

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_registro_bancario   *****/

//01 data_empresa_values()   --> Función que lee de la tabla data_empresa los datos de la empresa 
//02 process_form_empresa()  --> Función que procesa los elentos del formulario de datos de la empresa.

/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_empresa   *****/

/************************************************************************************************************/

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_registro_bancario   *****/
//01
  function data_empresa_values()
  {
	  // Función que lee de la tabla data_empresa los datos de la empresa 
	  $query01 = "SELECT * FROM data_empresa";
	  $query01 = mysql_query($query01);
	  $num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  //1. Se leyeron bien los datos de la BD y los guardo en un array.  
		  $elements = mysql_fetch_assoc($query01); 
	      
		  //2. Chequeo si el elemento elements['nombre_empresa'] != "" 
	      if ( $elements['nombre_empresa'] == "" )  {
			    
			  $elements['id'] = "0";
			  return $elements;
			  
		  } else {
			  
			  return $elements;  
		  }
	    
	  }
	  
  }  // Fin de la función data_empresa_values()
    
//02 
  function process_form_empresa()
  {
	  // Función que procesa los elentos del formulario de datos de la empresa.
  
      //01 Recibo las variables $_POST
	  $nombre_empresa     = addslashes($_POST['nombre_empresa']);
	  $razon_social       = addslashes($_POST['razon_social']);
	  $direccion_empresa  = addslashes($_POST['direccion_empresa']);
	  $telefono_empresa   = addslashes($_POST['telefono_empresa']);      
      $ruc_empresa        = addslashes($_POST['ruc_empresa']);
	  $moneda_informes    = addslashes($_POST['moneda_informes']);   
  
      //02 Hago un UPDATE en la BD data_empresa
	  $query02 = "UPDATE data_empresa SET nombre_empresa='".$nombre_empresa."', razon_social='".$razon_social."', direccion_empresa='".$direccion_empresa."', telefono_empresa='".$telefono_empresa."', ruc_empresa='".$ruc_empresa."', moneda_informes='".$moneda_informes."'";
      $query02 = mysql_query($query02);
	  
	  //03 Envío un header con los datos actualizados de la BD. 
		    header('Location: ../index.php?mod=mod_empresa#tabs-1');
	  
  }  // Fin de la función process_form_empresa()
    
  
  /*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_empresa   *****/
    
  if ( isset($_GET['data']) && $_GET['data'] == "send" )  {
	  // Esto es cuando se envía el formulario con los datos de la EMPRESA.
	  process_form_empresa();
  } 
  
?>  