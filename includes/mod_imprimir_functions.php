<?php
/* En este módulo se van a generar los .pdf para ver cada uno de los reportes de acuerdo al módulo que están definidos por las variables $_GET.  

/****** ((00)) VARIABLES $_GET[''] *****/ 

/************************
 Primer nivel:   Refieren al tipo de informe de acuerdo al módulo.
              (1) MÓDULO REGISTRO BANCARIO: rb=1  (Consulta por mes/año)
                                            rb=2  (Ver registros del mes actual)

/************************
 Segundo nivel:  Refieren a los elementos que son necesarios para hacer la cosulta.      
              (1) optionrb=new_in                                   	  
			  (2) optionrb=consulta
			  (3) optionrb=actual

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_imprimir   *****/

//01 (private) return_mes_actual()   --> Función que devuelve el mes actual o el mes seleccionado.
//02 header_imprimir()      --> Función que me permite de acuerdo a la variable $_GET saber el Título, el código y el valor del subtítulo del Reporte. 
//03 data_empresa_values()  --> Función que lee de la tabla data_empresa los datos de la EMPRESA. 


//01 (private)
  function return_mes($mes)
  {
	  // Función que devuelve el mes actual o el mes seleccionado.
      
	  switch($mes)
	  {
		  case '0':
		     //01 MOSTRAR EL MES ACTUAL
             $fecha = gmdate('d-m-Y', time() - 18000 );    // Variable de la fecha.
	         settype($fecha, "string");
	         $mes_reporte = substr($fecha,3,2);            // Busco el valor del mes actual.
	         settype($mes_reporte, "int");
		  break;
		  default:
		     $mes_reporte = $mes;
			 settype($mes_reporte, "int");                 // Este es el mes seleccionado.
		  break; 
	  } // Fin del switch($mes)
	  	  
	  switch($mes_reporte)
	  {
		 case 1:
	          $mes = "Enero";
		      break;
		 case 2:
		      $mes = "Febrero";
		      break; 
		 case 3:
	          $mes = "Marzo";
		      break;
		 case 4:
		      $mes = "Abril";
		      break; 
		 case 5:
	          $mes = "Mayo";
		      break;
		 case 6:
		      $mes = "Junio";
		      break; 
		 case 7:
	          $mes = "Julio";
		      break;
		 case 8:
		      $mes = "Agosto";
		      break;
		 case 9:
	          $mes = "Septiembre";
		      break;
		 case 10:
		      $mes = "Octubre";
		      break; 
		 case 11:
	          $mes = "Noviembre";
		      break;
		 case 12:
		      $mes = "Diciembre";
		      break;
	  }  // Fin del switch

       return $mes;

  } // Fin de la función return_mes_actual()

//02  
  function header_imprimir()
  {
	   // Función que me permite de acuerdo a la variable $_GET tener la CABECERA (el Título, el código y el valor del subtítulo del Reporte). 
	   
	   
	   $fecha = gmdate('d-m-Y', time() - 18000 );    // Variable de la fecha para sacar el año actual.
	   settype($fecha, "string");
	
	
	   /***************************************************************************************************************************
	                                           1. HEADER DEL ARCHIVO. Depende de $_GET
	   ***************************************************************************************************************************/	
	    
	    // CASO 1: MÓDULO REGISTRO BANCARIO. 
        if ( isset($_GET['rb']) && $_GET['rb'] == "2" )  {
           //a) Imprimir reporte de los Registros Bancarios del mes actual.
		   $info_reporte['codigo'] = "RB-2"; 	                               // Este es el código del informe.
           $info_reporte['nombre'] = "Registros Bancarios del mes actual.";    // Este es el Título del informe.
		   $info_reporte['nombre_subtitulo1'] = "MES: ";                       // Este es el nombre del subtítulo.  
		   $mes_actual = return_mes(0); 
		   $ano_actual = substr($fecha,-4);                                    // Busco el valor del año actual.
		   $info_reporte['subtitulo1'] = $mes_actual." ".$ano_actual;          // Este es el subtítulo como tal.  
		  	  
		   return $info_reporte;
      
	   } else if ( isset($_GET['rb']) && $_GET['rb'] == "1" )   {
		  //b) Imprimir reporte de los Registros Bancarios del mes seleccionado.
		  $info_reporte['codigo'] = "RB-1"; 	                                  // Este es el código del informe.
          $info_reporte['nombre'] = "Registros Bancarios del mes seleccionado.";  // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "MES/A&Ntilde;O: ";                         // Este es el nombre del subtítulo.  
		  $mes_reporte = return_mes($_GET['mes']);           
		  $info_reporte['subtitulo1'] = $mes_reporte." ".$_GET['y'] ;             // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	     
	  }	
	     // CASO 2: MÓDULO CUENTAS X COBRAR.
         else if ( isset($_GET['cxc']) && $_GET['cxc'] == "2" )  {
           //c) Imprimir Cuentas X Cobrar del mes actual.
		   $info_reporte['codigo'] = "CXC-2"; 	                             // Este es el código del informe.
           $info_reporte['nombre'] = "Cuentas por Cobrar del mes actual.";   // Este es el Título del informe.
		   $info_reporte['nombre_subtitulo1'] = "MES: ";                     // Este es el nombre del subtítulo.  
		   $mes_actual = return_mes(0);           
		   $ano_actual = substr($fecha,-4);   
		   $info_reporte['subtitulo1'] = $mes_actual." ".$ano_actual;        // Este es el subtítulo como tal.  
		  	  
		   return $info_reporte;
	
	  } else if ( isset($_GET['cxc']) && $_GET['cxc'] == "1" )   {
		  //d) Imprimir reporte de Cuentas X Cobrar del mes seleccionado.
		  $info_reporte['codigo'] = "CXC-1"; 	                                  // Este es el código del informe.
          $info_reporte['nombre'] = "Cuentas por Cobrar del mes seleccionado.";   // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "MES/A&Ntilde;O: ";                // Este es el nombre del subtítulo.  
		  $mes_reporte = return_mes($_GET['mes']);           
		  $info_reporte['subtitulo1'] = $mes_reporte." ".$_GET['y'];              // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	     
	  }  
	    // CASO 3: MÓDULO CUENTAS X PAGAR.
        else if ( isset($_GET['cxp']) && $_GET['cxp'] == "2" )  {
          //e) Imprimir Cuentas X Pagar del mes actual.
		  $info_reporte['codigo'] = "CXP-2"; 	                            // Este es el código del informe.
          $info_reporte['nombre'] = "Cuentas por Pagar del mes actual.";    // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "MES: ";                     // Este es el nombre del subtítulo.  
		  $mes_actual = return_mes(0);           
		  $ano_actual = substr($fecha,-4);  
		  $info_reporte['subtitulo1'] = $mes_actual." ".$ano_actual;        // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
      
	  } else if ( isset($_GET['cxp']) && $_GET['cxp'] == "1" )  {
          //f) Imprimir Cuentas X Pagar del mes actual.
		  $info_reporte['codigo'] = "CXP-1"; 	                                  // Este es el código del informe.
          $info_reporte['nombre'] = "Cuentas por Pagar del mes seleccionado.";    // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "MES/A&Ntilde;O: ";                  // Este es el nombre del subtítulo.  
		  $mes_reporte = return_mes($_GET['mes']);        
		  $info_reporte['subtitulo1'] = $mes_reporte." ".$_GET['y'] ;             // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
      
	  }
	  // CASO 4: MÓDULO PROVEEDORES.
        else if ( isset($_GET['pro']) && $_GET['pro'] == "1" )  {
          //g) Imprimir todos los Proveedores de la BD.
		  $info_reporte['codigo'] = "PRO-1"; 	                            // Este es el código del informe.
          $info_reporte['nombre'] = "Proveedores.";                         // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "";                          // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = ""        ;                         // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
      
	  } else if ( isset($_GET['pro']) && $_GET['pro'] == "2" )  {
          //h) Imprimir los datos del Proveedor seleccionado en la BD.
		  $info_reporte['codigo'] = "PRO-2"; 	                            // Este es el código del informe.
          $info_reporte['nombre'] = "Informe del Proveedor seleccionado.";  // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "";                          // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = ""        ;                         // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	
	  }
	  // CASO 5: MÓDULO CLIENTES.
        else if ( isset($_GET['cli']) && $_GET['cli'] == "1" )  {
          //i) Imprimir todos los Clientes de la BD.
		  $info_reporte['codigo'] = "CLI-1"; 	                            // Este es el código del informe.
          $info_reporte['nombre'] = "Clientes.";                            // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "";                          // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = "";                                 // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
      
	  } else if ( isset($_GET['cli']) && $_GET['cli'] == "2" )  {
          //j) Imprimir los datos del Proveedor seleccionado en la BD.
		  $info_reporte['codigo'] = "CLI-2"; 	                            // Este es el código del informe.
          $info_reporte['nombre'] = "Informe del Cliente seleccionado.";    // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "";                          // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = "";                                 // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	
	  } 
	    // CASO 6: MÓDULO COMPRAS.
	    else if ( isset($_GET['cmp']) && $_GET['cmp'] == "1" )  {
          //j) Imprimir los datos del Reporte de Resumen de Compras entre dos fechas Seleccionadas
		  $info_reporte['codigo'] = "CMP-1"; 	                              // Este es el código del informe.
          $info_reporte['nombre'] = "Informe de Resumen de Compras";          // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "FECHA INICIAL/FECHA FINAL: ";   // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = $_GET['fi']."/".$_GET['ff'];          // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	
	  } else if ( isset($_GET['cmp']) && $_GET['cmp'] == "2" )  {
          //k) Imprimir todas las Compras realizadas a un proveedor.
		  $info_reporte['codigo'] = "CMP-2"; 	                                                      // Este es el código del informe.
          $info_reporte['nombre'] = "Informe de Resumen de Compras para un Proveedor Seleccionado";   // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "PROVEEDOR: ";                                         // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = $_GET['name'];                                                // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	
	  } 
	    // CASO 7: MÓDULO CAJA.
	    else if ( isset($_GET['caj']) && $_GET['caj'] == "2" )  {
          //l) Imprimir los datos del Reporte de Cajas Anteriores.
		  $info_reporte['codigo'] = "CAJ-2"; 	                                // Este es el código del informe.
          $info_reporte['nombre'] = "Informe de Cajas Anteriores";              // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "FECHA INICIAL/FECHA FINAL: ";   // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = $_GET['fi']."/".$_GET['ff'];            // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	
	  } else if ( isset($_GET['caj']) && $_GET['caj'] == "1" )  {
          //m) Imprimir los datos del Reporte de la Caja Actual.
		  $info_reporte['codigo'] = "CAJ-1"; 	                                // Este es el código del informe.
          $info_reporte['nombre'] = "Informe de Cajas Actual";                  // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "FECHA: ";                       // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = $fecha;                                 // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	  }
	    // CASO 8: MÓDULO INVENTARIO.
	    else if ( isset($_GET['inv']) && $_GET['inv'] == "1" )  {
          //n) Imprimir los datos de todos los artículos del Inventario.
		  $info_reporte['codigo'] = "INV-1"; 	                                       // Este es el código del informe.
          $info_reporte['nombre'] = "Informe de Art&iacute;culos de Inventario";       // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "";                                     // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = "";                                            // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	
	  } else if ( isset($_GET['inv']) && $_GET['inv'] == "2" )  {
          //ñ) Imprimir los datos del Reporte de Kardex para un artículo.
		  $info_reporte['codigo'] = "INV-2"; 	                                       // Este es el código del informe.
          $info_reporte['nombre'] = "Informe de Kardex de un art&iacute;culo";         // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "";                                     // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = "";                                            // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	  
	  } else if ( isset($_GET['inv']) && $_GET['inv'] == "3" )  {
          //o) Imprimir los datos del Reporte del Resumen del Movimiento de Inventario.
		  $info_reporte['codigo'] = "INV-3"; 	                                             // Este es el código del informe.
          $info_reporte['nombre'] = "Informe del Resumen de Movimiento de Inventarios";      // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "";                                           // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = "";                                                  // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	  
	  } else if ( isset($_GET['inv']) && $_GET['inv'] == "4" )  {
          //p) Imprimir los datos del Reporte del Stock en cualquier Local.
		  $info_reporte['codigo'] = "INV-4"; 	                                             // Este es el código del informe.
          $info_reporte['nombre'] = "Informe de Stock";                                      // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "LOCAL/FECHA";                                // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = $_GET['name']."/".$fecha;                            // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	  }
	    // CASO 9: MÓDULO VENTAS.
	    else if ( isset($_GET['vnt']) && $_GET['vnt'] == "1" )  {
          //q) Imprimir los datos del Resumen de Ventas.
		  $info_reporte['codigo'] = "VNT-1"; 	                                       // Este es el código del informe.
          $info_reporte['nombre'] = "Informe de Resumen de Ventas";                    // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "";                                     // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = "";                                            // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	
	  } else if ( isset($_GET['vnt']) && $_GET['vnt'] == "2" )  {
          //r) Imprimir los datos de las Ventas por Cliente.
		  $info_reporte['codigo'] = "VNT-2"; 	                                       // Este es el código del informe.
          $info_reporte['nombre'] = "Informe de Ventas por Cliente";                   // Este es el Título del informe.
		  $info_reporte['nombre_subtitulo1'] = "";                                     // Este es el nombre del subtítulo.  
		  $info_reporte['subtitulo1'] = "";                                            // Este es el subtítulo como tal.  
		  	  
		  return $info_reporte;
	  }
	
	  
  } // Fin de la función header_imprimir()







//03
 function data_empresa_values_1()
  {
	  // Función que lee de la tabla data_empresa los datos de la empresa. 
	  $query01 = "SELECT * FROM data_empresa";
	  $query01 = @mysql_query($query01) or die(mysql_error());
	  $num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  //1. Se leyeron bien los datos de la BD y los guardo en un array.  
		  $elements = mysql_fetch_assoc($query01); 
	      //2. Chequeo si el elemento elements['nombre_empresa'] != "" 
	      if ( $elements['nombre_empresa'] == "" )  {
			    
			  $elements['nombre_empresa'] = "";
			  $elements['direccion_empresa'] = "";
			  $elements['telefono_empresa'] = "";
			  $elements['ruc_empresa'] = "";
			  $elements['moneda_informes'] = "";
			  return $elements;
		  } else {
			  return $elements;  
		  }
	  }
  }  // Fin de la función data_empresa_values()






?>