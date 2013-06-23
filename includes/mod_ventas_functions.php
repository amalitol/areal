<?php
@session_start();

include_once('connection.php');

/****** ((00)) VARIABLES  *****/ #tabs-1
/************************
 Primer nivel:   Refieren al módulo en cuestion 
              mod=mod_ventas 
/************************
 Segundo nivel:  Refieren a los elementos del menu superior     
             (1) optionv=nueva_venta     
			 (2) optionv=res_ventas          REPORTES
			 (3) optionv=ventas_x_clientes   REPORTES                               
			 
/************************
  Tercer nivel(I):  Refieren a los elementos que voy a mostrar dentro de un elemento del menu superior				 
             De (1) localid= (1,2,3,....) -> Pretenece a nueva venta del menu superior-caso administrador.
			 De (2) resv=ver -> Viene con variables $_POST para ver el resultado de la consulta de RESUMEN DE VENTAS
			 De (3) cl=ver -> Viene con variables $_POST para ver el resultado de la consulta de VENTAS X CLIENTE.


/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_ventas   *****/

//01 show_almacenes()  --> Función que muestra todos los almacenes que están actualmente en la BD.
//02 charges_articles_for_sell($id_local) --> Función que carga los artículos para la VENTA del almacén en cuestión de acuerdo al id del local. 
//03 process_contado_ventas() --> Función que procesa la nueva VENTA cuando el pago es al CONTADO.  
//04 process_creditoentradaXpagosY_ventas($x,$y)  -> Función que procesa los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada=(0,1) -> Cant. Pagos=(1,2,3,4,5)

//05 (private) process_12datos_y_detalle_ventas() -> Función que procesa la sección de: 1. DATOS GENERALES Y 2. DETALLE DE VENTA.
//06 (private) process_num_pagos_ventas($a,$b,$c,$d) -> Función que procesa el número de PAGOS (1,2,3,4 ó 5) del CRÉDITO. 
//07 (private) process_1_pago_ventas($a,$b,$c,$d,$e) -> Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 1.
//08 (private) process_2_pago_ventas($a,$b,$c,$d,$e) -> Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 2.
//09 (private) process_3_pago_ventas($a,$b,$c,$d,$e) -> Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 3.
//10 (private) process_4_pago_ventas($a,$b,$c,$d,$e) -> Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 4.
//11 (private) process_5_pago_ventas($a,$b,$c,$d,$e) -> Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 5.
//12 show_resumen_ventas_today() -> Funcíon que muestra todos lo relacionado con los datos del RESUMEN DE VENTAS DEL DÍA (caso vendedor).
//13 show_resumen_ventas_today_almacenes() -> Función que muestra el # de todas las ventas del día de todos los almacenes(caso administrador).
//14 venta_cliente() -> Función que muestra las ventas de un cliente en un almacén determinado por el usuario.
//15 resumen_ventas() -> Función que muestra el resumen de ventas en un local determinado. 

/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_ventas  *****/

/************************************************************************************************************/

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_ventas   *****/
//01 
  function show_almacenes($tipo_usuario)
  {
	  // Función que muestra todos los almacenes que están actualmente en la BD.
  
      switch($tipo_usuario)
	  {
		 case "a":  // CASO ADMINISTRADOR.
		     
			  //01 Selecciono todos los ALMACENES que estén en la BD. 
	          $query01 = "SELECT * FROM locales_inventarios WHERE id!=1 ORDER BY id ASC";
	  		 
		 break;
		 case "v":  // CASO VENDEDOR.
		 
		      //01 Selecciono todos los ALMACENES que estén en la BD. 
	          $query01 = "SELECT * FROM locales_inventarios WHERE id='".$_SESSION['id_local']."'";
		 
		 break;  
	  }
	  	 
	  $query01 = mysql_query($query01);
	  $num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  
		  // Esto significa que hay ALAMECENES en la tabla de BD y los guardo en un array para devolverlos
		  for ( $i=0; $i < $num_rows_query01; $i++ )
		  {
		      $registro_almacenes[$i] = mysql_fetch_assoc($query01);
		  }
	  	  
	  } else {
		 //02 Si no hay ALMACENES devuelvo un valor nulo. 
		 return "null";
		   
	  }
	  
	  //03 Si hay ALMACENES en la base de datos devuelvo los registros de estos.  
	  return $registro_almacenes;  
  
  }   // Fin de la función show_almacenes()
  
//02
  function charges_articles_for_sell($id_local)
  {
	 // Función que carga los artículos para la VENTA del almacén en cuestión de acuerdo al id del local. 
	 
	 $query02 = "SELECT newalmacen_".$id_local.".id, newalmacen_".$id_local.".id_codigo_art, articulos_inventario.referencia_art FROM newalmacen_".$id_local.", articulos_inventario WHERE newalmacen_".$id_local.".id_codigo_art=articulos_inventario.id ORDER BY articulos_inventario.referencia_art ASC";
     $query02 = mysql_query($query02);
	 $num_rows_query02 = mysql_num_rows($query02);
	 if ( $num_rows_query02 > 0 )  {
		 // Esto significa que existen artículos en la BD.   
		   
		 for ( $i=0; $i < $num_rows_query02; $i++ ) 
		 {
			  $articles[$i] = mysql_fetch_assoc($query02);
		 }
		  
		 return $articles;
		  
	  } else { return "null"; }  
	  
  }  // Fin de la función charges_articles_for_sell($id_local)
    
//03 
   function process_contado_ventas()
   {
	   // Función que procesa la nueva VENTA cuando el pago es al CONTADO.    
       // Recibo las variables $_POST 
	   $arr = $_POST;
	   $fecha = $arr['fecha_venta'];                    // Esta es la fecha de la venta.
	   
	   //01 Inserto en la Base de datos los datos del módulo 1. DATOS GENERALES y 2. DETALLE DE COMPRA.
	   $datos_generales_y_detalle_compra = process_12datos_y_detalle_ventas();   // Esta variable debe ser 'ok'.  
       
	   $ok = $datos_generales_y_detalle_compra[0];
	   
	   // 02 ENVÍO MENSAJE DE REGRESO DE QUE LOS DATOS DE LA VENTA SE INSERTARON OK EN LA BD.
	   if ( $ok == "ok" )  {
		   // Todo ok envío un header(Location: ....)
		   header('Location: ../index.php?mod=mod_ventas#tabs-1');   
	   }
	     
   }  // Fin de la función process_contado_ventas()
    
//04 
   function process_creditoentradaXpagosY_ventas($x, $y)
   {
	   // Función que procesa los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada=(0,1) -> Cant. Pagos=(1,2,3,4,5) 
   
       // Recibo las variables $_POST 
	   $arr = $_POST;
	   $fecha = $arr['fecha_venta'];                    // Esta es la fecha de la venta.
	   
	   //01 Inserto en la Base de datos los datos del módulo 1. DATOS GENERALES y 2. DETALLE DE COMPRA.
	   $datos_generales_y_detalle_compra = process_12datos_y_detalle_ventas();   // Esta variable debe ser 'ok'.  
       
	   $ok               = $datos_generales_y_detalle_compra[0];  // mensaje de ok
	   $id_cliente_venta = $datos_generales_y_detalle_compra[1];  // id del cliente de la venta.
	   $id_venta         = $datos_generales_y_detalle_compra[2];  // id de la venta.
	   	   
	   //02 Inserto en la tabla cuentas_x_cobrar los datos de los pagos a CRÉDITO.
	   $num_pagos_cxc = process_num_pagos_ventas($y, $arr, $id_cliente_venta, $id_venta); 
	   	   
	   //03 Verifico que todo esté ok y mando el header(...)
	   if ( $ok  == "ok" && $num_pagos_cxc == "ok" )   {
		      
		   // Esto significa que se insertaron bien los datos en la BD.
		   header('Location: ../index.php?mod=mod_ventas#tabs-1');  
					 		   
	   } //02 Fin del if ( $ok  == "ok" && $num_pagos_cxc == "ok" )   {
	     
   }  // Fin de la función process_creditoentradaXpagosY_ventas(x, y)
    
//05 (private) 
   function process_12datos_y_detalle_ventas()
   {
	   // Función que procesa la sección de: 1. DATOS GENERALES Y 2. DETALLE DE VENTA.
	   /*
	       1. SI ES NUEVO CLIENTE INSERTA LOS DATOS EN LA TABLA proveedores_clientes ( nombre, ruc, # de cédula ).
		   2. INSERTA EN LA TABLA ventasalmacen_(id) CON LOS DATOS GENERALES DE LA COMPRA Y EL PAGO.
		   3. SELECT el saldo de la CAJA del almacén donde se efectuó la compra (cajaalmacen_(id)) e INSERTO los nuevos datos de la compra a la CAJA.
		   4. SELECT el stock_actual DEL INVENTARIO (newalmacen_(id)) Y UPDATE ESTA E INSERTO MOVIMIENTO EN movalmacen_(id) 
	   */ 
   
       $articulos_seleccionados = 0;  // Aquí van la cantidad de artículos seleccionados en la venta.
       
	   //01 Recibo las variables $_POST
       $arr = $_POST;
   
       if ( isset($arr) )  {
		  
		  //02 Busco la CANTIDAD DE ARTÍCULOS de la venta y guardo los valores de los DATOS seleccionados en un ARRAY.
		  foreach ( $_POST as $key => $value )
          {
          /*1*/if ( substr($key,0,16) == "descripcion_art_" && $value != ""  )  {
	              // DE ESTA MANERA SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO ---->>>> DESCRIPCIÓN DEL ARTÍCULO.
		          $num = substr($key, 16);                      // Numero del orden del array.
		          $array[$num]['descripcion_art_'] = $value;    // valor de la descripción.
		
		          $numero_indice_final = substr($key, 16);  // ESTO LO VOY A USAR PARA EL for($i... a la hora de insertar los datos en la base de datos...este es el número del ultimo registro con contenido )
		       } else {
		      /*2*/if ( substr($key,0,7) == "codigo_" && ( $value != "" || substr($key, 7) == @$numero_indice_final ) )  {
	                  // DE ESTA MANERA SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO --->>>>> CÓDIGO
		              $num = substr($key, 7);
		              if ( $value == "" )  {      // <<<<--- Esto no debe suceder pues todo artículo está asociado a un código.
				          $array[$num]['codigo_'] = 0;
			          } else {
				          $array[$num]['codigo_'] = $value;
			          }
			       } else {
				  /*3*/if ( substr($key,0,7) == "precio_" && ( $value != "0" || substr($key, 7) == @$numero_indice_final ) )  {
	                      // SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO --->>>>> PRECIO
		                  $num = substr($key, 7);
		                  if ( $value == "" )  {   // <<<<--- Esto no debe suceder pues todo artículo está asociado a un PRECIO.
				             $array[$num]['precio_'] = 0;
			              } else {
				             $array[$num]['precio_'] = $value;
			              }
				       } else {	  
					  /*4*/if ( substr($key,0,9) == "cantidad_" && ( $value != "0" || substr($key, 9) == @$numero_indice_final ) )  {
	                          // SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO --->>>>> CANTIDAD
		                      $num = substr($key, 9);
		                      if ( $value == "" )  {   // <<<<--- Esto no debe suceder pues todo artículo está asociado a un COSTO.
				                 $array[$num]['cantidad_'] = 0;
			                  } else {
				                 $array[$num]['cantidad_'] = $value;
			                  }
				           } else {
					      /*5*/if ( substr($key,0,12) == "valor_total_" && ( $value != "0" || substr($key, 12) == @$numero_indice_final ) )  {
	                              // SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO --->>>>> VALOR TOTAL
		                         $num = substr($key, 12);
		                         if ( $value == "" )  {   // <<<<--- Esto no debe suceder pues todo artículo está asociado a un VALOR TOTAL.
				                    $array[$num]['valor_total_'] = 0;
			                     } else {
				                    $array[$num]['valor_total_'] = $value;
			                     }
				               }  // Fin del if ( substr($key,0,12) == "valor_total_" && ( $value != "" || .... /*5*/
					       }  // Fin del if /*4*/
					   } // Fin del if /*3*/
				   }  // Fin del if /*2*/
		       } // Fin del if /*1*/
		  
		  } // Fin del foreach ( $_POST as $key => $value )
		  		  
	      //03.1 ESTO SÓLO PARA SABER LA CANTIDAD DE ARTÍCULOS SELECCIONADOS EN LA COMPRA para el 03.3.
          for ( $i=1; $i <= $numero_indice_final; $i++ )
          {
               if ( isset($array[$i]['descripcion_art_']) )  {
   
                   $articulos_seleccionados++;   // Para obtener la cantidad de artículos.
			   }
		  } // Fin del for
		  
		  
		  //03.2 CHEQUEO SI EL CLIENTE ES UN NUEVO CLIENTE O NO ( SI ES UN NUEVO CLIENTE LO INSERTO EN LA TABLA proveedores_clientes )
		  if ( $arr['seleccionar_cliente_por'] == "nuevo_cliente"  )  {
			  // Esto significa que es un NUEVO CLIENTE A INSERTA EN LA TABLA proveedores_clientes .
			  $query05 = "INSERT INTO proveedores_clientes ( fecha_registro, nombre, direccion, ruc, descripcion, telefono, fax, email, cedula, active_proveedor, active_cliente ) VALUES ( '".addslashes($arr['fecha_venta'])."', '".addslashes($arr['nuevo_cliente_nombre_venta'])."', '', '".addslashes($arr['nuevo_cliente_ruc_venta'])."', '', '', '', '', '".addslashes($arr['nuevo_cliente_num_cedula_venta'])."', 0, 1 )";
			  $query05 = @mysql_query($query05) or die(mysql_error());  
		      $id_cliente = mysql_insert_id();   // Aquí está el id del cliente de la BD proveedores_clientes. 
		      
		  }
		  
		  //03.3 BUSCO EL VALOR QUE VOY A PONER EN EL CAMPO saldo_inicial
		  switch($arr['forma_pago'])
		  {
			 case "contado": // PAGO AL CONTADO.
			      $saldo_inicial_venta = $arr['valor_real_de_la_venta'];
			 break;
			 case "credito": // PAGO A CRÉDITO. 
			       $saldo_inicial_venta = $arr['entrada_dinero'];
			 break;
			    
		  }  // Fin del switch.
		  
		  //03.4 BUSCO EL VALOR QUE VOY A PONER EN EL CAMPO saldo_del_credito
		  switch($arr['forma_pago'])
		  {
			 case "contado": // PAGO AL CONTADO.
			      $saldo_del_credito_venta = 0;
			 break;
			 case "credito": // PAGO A CRÉDITO. 
			       $saldo_del_credito_venta = $arr['saldo_dinero'];
			 break;
			    
		  }  // Fin del switch.
		  
		  //03.5 BUSCO EL id DEL CLIENTE QUE HIZO LA COMPRA.
		  switch($arr['seleccionar_cliente_por'])
		  {    
			   case "nuevo_cliente":
				  // Nombre del NUEVO CLIENTE.
				  $id_cliente_mc = $id_cliente;
			   break;
			   case "sin_determinar":
				  // No hay nombre para el CLIENTE.
				  $id_cliente_mc = "0";
			   break;
			   default:
				  // Nombre del campo hidden del cliente selecionado.
				  $id_cliente_mc = $arr['id_del_cliente_venta'];
			   break;   
			  		   
		   }  // Fin del switch
		  		  		  
		  //03.6 INSERT LA TABLA ventas_almacen_(local_id) con los DATOS GENERALES DE LA VENTA Y EL PAGO.
		  $querym = "INSERT INTO ventasalmacen_".$arr['select_local']." ( fecha_venta, numero_factura, id_cliente_venta, cantidad_articulos, forma_de_pago, monto_de_la_venta, descuento, valor_de_la_venta_real, observaciones, persona_q_hace_la_venta, saldo_inicial, saldo_del_credito, cantidad_de_pagos ) VALUES ( '".addslashes($arr['fecha_venta'])."', '".addslashes($arr['input_no_factura_ventas'])."', '".$id_cliente_mc."', '".$articulos_seleccionados."', '".$arr['forma_pago']."', '".addslashes($arr['monto_total'])."', '".addslashes($arr['descuento_general_venta'])."', '".addslashes($arr['valor_real_de_la_venta'])."', '', '".addslashes($_SESSION['nombre_completo'])."', '".$saldo_inicial_venta."', '".$saldo_del_credito_venta."', '".$arr['cantidad_de_pagos_credito']."' )"; 
          $querym = @mysql_query($querym) or die(mysql_error());
		  $id_venta = mysql_insert_id();         // Para tener el id de la venta.
		  $num_rows_querym = mysql_affected_rows();
          if ( $num_rows_querym > 0 )  {
			  
			  //03.7 INTRODUZCO EL DINERO DEL PAGO: --  1. AL CONTADO. --  2. ANTICIPO DEL CRÉDITO.
			  if ( $arr['forma_pago'] == "credito" && $saldo_inicial_venta == "0" )  {
				  // ESTO SIGNIFICA QUE NO HAY ADELANTO EN EL CRÉDITO, POR TANTO NO VA NADA A LA CAJA.
				  // -- NO PASA NADA --  
			  } else {
				  //A) BUSCO EL SALDO DE LA CAJA EN CUESTION PARA LUEGO SUMARLE EL VALOR DE LA VENTA.
			      $query051 = "SELECT saldo FROM cajaalmacen_".$arr['select_local']." ORDER BY id DESC";
			      $query051 = @mysql_query($query051) or die($mysql_error());
			      $num_query051 = mysql_num_rows($query051);
			      if ( $num_query051 > 0 )  {
				      // Significa que la caja tiene al menos una entrada. 
				      $saldo =  mysql_fetch_assoc($query051); 
			          $saldo_en_caja = $saldo['saldo']; 
			      } else {
				      // Significa que la caja está en 0. Nunca se ha entrado ningun valor.
				      $saldo_en_caja = "0";
			      }
			  
			      //B) INTRODUZCO EL DINERO DE LA VENTA EN LA CAJA DEL ALMACÉN EN CUESTIÓN.
			      settype($saldo_en_caja, "float");         // Saldo en Caja.
			      settype($saldo_inicial_venta, "float");   // DINERO DE LA VENTA Ó ANTICIPO.
			      $saldo_final_en_caja = $saldo_en_caja + $saldo_inicial_venta;
			      
				  $query052 = "INSERT INTO cajaalmacen_".$arr['select_local']." ( fecha_transaccion, tipo_transaccion, origen_transaccion, destino_transaccion, cantidad_transaccion, observaciones, no_venta, persona_q_hace_transaccion, recibido, saldo ) VALUES ( '".addslashes($arr['fecha_venta'])."', 'Ingreso de Caja', 'Venta no. ".$id_venta."', '', '".$saldo_inicial_venta."', '', '".$id_venta."', '".addslashes($_SESSION['nombre_completo'])."', 1, '".$saldo_final_en_caja."' ) ";
			      $query052 = @mysql_query($query052) or die (mysql_error());
			   			  
			  }  // Fin del if ( $arr['forma_pago'] == "credito" && $saldo_inicial_venta == "0" )  {
			  
			  //03.8 ACTUALIZO LAS TABLAS newalmacen_(idlocal) y movalmacen_(idlocal) CON LOS ARTÍCULOS DE LA COMPRA.
              for ( $i=1; $i <= $numero_indice_final; $i++ )
              {
                   if ( isset($array[$i]['descripcion_art_']) )  {
   
                       //$articulos_seleccionados_again++;   // Para obtener la cantidad de artículos.
	   
	                   //A) VERIFICO EL NOMBRE DEL CLIENTE.
					   switch($arr['seleccionar_cliente_por'])
					   {
						  case "nuevo_cliente":
						      // Nombre del NUEVO CLIENTE.
							  $nombre_cliente = addslashes($arr['nuevo_cliente_nombre_venta']);
						  
						  break;
						  case "sin_determinar":
						      // No hay nombre para el CLIENTE.
						      $nombre_cliente = "";
						  break;
						  default:
						      // Nombre del campo hidden del cliente selecionado.
						      $nombre_cliente = addslashes($arr['nombre_del_cliente_venta']);
						  break;   
					   
					   }  // Fin del switch
	                       
					   //B) BUSCO EL STOCK ACTUAL DEL ARTÍCULO DE LA VENTA PARA ACTUALIZARLO.
					   $query053 = "SELECT stock_actual FROM newalmacen_".$arr['select_local']." WHERE id_codigo_art='".$array[$i]['descripcion_art_']."'  ";
					   $query053 = @mysql_query($query053) or die(mysql_error());
					   $num_rows_query053 = mysql_num_rows($query053);
					   if ( $num_rows_query053 > 0 )  {
						   // Esto significa que se encontró el stock_actual.
						   $stock_actual_review = mysql_fetch_assoc($query053);
						   $stock_actual_final = $stock_actual_review['stock_actual'];
										   
					   } // Fin del if ( $num_rows_query053 > 0 )  {
					   
					   //C) LLEVO A CABO LAS OPERACIONES PARA OBTENER EL STOCK FINAL.
					   settype($stock_actual_final, "float");                             // Stock actual
					   $cantidad_de_articulos_de_la_venta = $array[$i]['cantidad_'];
					   settype($cantidad_de_articulos_de_la_venta, "float");             // cantidad de artículos de la venta
					   
					   $stock_articulos_final = $stock_actual_final - $cantidad_de_articulos_de_la_venta;
					   
					   //D) INSERTO EN LA TABLA movalmacen_(idlocal) LOS DATOS DE LOS ARTÍCULOS COMPRADOS (movimiento).
				       $query054 = "INSERT INTO movalmacen_".$arr['select_local']." ( fecha_movimiento, id_codigo_articulo_mov, tipo_mov, concepto_mov, origen_mov_proveedor, destino_mov_cliente, cantidad_movimiento, observaciones_mov, no_venta, persona_q_hace_mov, recibido, saldo ) VALUES ( '".addslashes($arr['fecha_venta'])."', '".$array[$i]['descripcion_art_']."', 'Salida', 'Venta no. ".$id_venta."', '', '".$nombre_cliente."', '".$array[$i]['cantidad_']."', '', '".$id_venta."', '".addslashes($_SESSION['nombre_completo'])."', 1, '".$stock_articulos_final."' )";
				       $query054 = @mysql_query($query054) or die(mysql_error());
				       
				      //E) UPDATE EN LA TABLA newalmacen_(idlocal) LOS DATOS DEL NUEVO STOCK.
					  $query055 = "UPDATE newalmacen_".$arr['select_local']." SET stock_actual='".$stock_articulos_final."' WHERE id_codigo_art='".$array[$i]['descripcion_art_']."'";
					  $query055 = @mysql_query($query055) or die(mysql_error());
				   
				 } else {
	               continue;   
                 }
		      }  // Fin del for ( $i=1; $i <= $numero_indice_final; $i++ )
	   			  
			  // Esto significa que todo está bien entonces envío de retorno:
			  /*
			      return[0] - mensaje de ok ('ok').
				  return[1] - id del cliente de la venta(1,2,3,4...).
				  return[2] - id de la venta (1,2,3,4....). 
			  */
			  $return[0] = "ok";
			  $return[1] = $id_cliente_mc;
			  $return[2] = $id_venta;
			  
			  return $return;
			  			  
		  }  // Fin del if ( $num_rows_querym > 0 )  {
	   
	   } // Fin del if ( isset($arr) )  {
         
   }  // Fin de la función process_12datos_y_detalle_ventas()
  
//06 (private) 
   function process_num_pagos_ventas($y, $arr, $id_cliente_venta, $id_venta) 
   {
	   // Función que procesa el número de PAGOS (1,2,3,4 ó 5) del CRÉDITO. 
   
       // Convierto las variables que necesito.
	   $fecha = $arr['fecha_venta'];                          // Esta es la fecha de la compra.
	   $cantidad_de_pagos_credito = $arr['cantidad_de_pagos_credito'];  // Cantidad de Pagos
	   $select_local = $arr['select_local'];  // id del Local de la venta  
	  
	   $monto_cxc1 = $arr['monto_total_pago1'];                    // Monto Total de la Cuenta por Pagar(PAGO 1).       
	   $fecha_cxc1 = addslashes($arr['fecha_pago1']);              // Fecha de la Cuenta por Pagar (PAGO 1)
	   $descripcion_cxc1 = addslashes($arr['descripcion_pago1']);  // Descripción de la Cuenta X Pagar(PAGO 1)
	   $monto_cxc2 = $arr['monto_total_pago2'];                    // Monto Total de la Cuenta por Pagar(PAGO 2).       
	   $fecha_cxc2 = addslashes($arr['fecha_pago2']);              // Fecha de la Cuenta por Pagar (PAGO 2)
	   $descripcion_cxc2 = addslashes($arr['descripcion_pago2']);  // Descripción de la Cuenta X Pagar(PAGO 2)
	   $monto_cxc3 = $arr['monto_total_pago3'];                    // Monto Total de la Cuenta por Pagar(PAGO 3).       
	   $fecha_cxc3 = addslashes($arr['fecha_pago3']);              // Fecha de la Cuenta por Pagar (PAGO 3)
	   $descripcion_cxc3 = addslashes($arr['descripcion_pago3']);  // Descripción de la Cuenta X Pagar(PAGO 3)
	   $monto_cxc4 = $arr['monto_total_pago4'];                    // Monto Total de la Cuenta por Pagar(PAGO 4).       
	   $fecha_cxc4 = addslashes($arr['fecha_pago4']);              // Fecha de la Cuenta por Pagar (PAGO 4)
	   $descripcion_cxc4 = addslashes($arr['descripcion_pago4']);  // Descripción de la Cuenta X Pagar(PAGO 4)
	   $monto_cxc5 = $arr['monto_total_pago5'];                    // Monto Total de la Cuenta por Pagar(PAGO 5).       
	   $fecha_cxc5 = addslashes($arr['fecha_pago5']);              // Fecha de la Cuenta por Pagar (PAGO 5)
	   $descripcion_cxc5 = addslashes($arr['descripcion_pago5']);  // Descripción de la Cuenta X Pagar(PAGO 5)
   
       //01 SELECCIONO LOS CASOS DE ACUERDO A LA CANTIDAD DE PAGOS EN EL CRÉDITO.
	  switch($y)
	  {
		 case 1:  // 1 PAGO.
					
			 // Introduzco en la BD 1 pago en la CUENTAS X COBRAR.		
			 $process_1_pago = process_1_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc1, $descripcion_cxc1, $fecha_cxc1 );		
		 	 if ( $process_1_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_cobrar
				 return "ok";	 
			 } 
					
		 break;
		 case 2:  // 2 PAGOS
					
			 // Introduzco en la BD. 2 pagos en las CUENTAS X COBRAR		
			 $process_1_pago = process_1_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc1, $descripcion_cxc1, $fecha_cxc1 );			
			 $process_2_pago = process_2_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc2, $descripcion_cxc2, $fecha_cxc2 );			
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_cobrar
				 return "ok";	 
			 } 
						
		 break;
		 case 3:  // 3 PAGOS
					
			 // Introduzco en la BD. 3 pagos en las CUENTAS X COBRAR			
			 $process_1_pago = process_1_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc1, $descripcion_cxc1, $fecha_cxc1 );			
			 $process_2_pago = process_2_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc2, $descripcion_cxc2, $fecha_cxc2 );			
			 $process_3_pago = process_3_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc3, $descripcion_cxc3, $fecha_cxc3 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_cobrar
				 return "ok";	 
			 } 		
						
		 break;
		 case 4:  // 4 PAGOS
					
			 // Introduzco en la BD. 4 pagos en las CUENTAS X COBRAR			
			 $process_1_pago = process_1_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc1, $descripcion_cxc1, $fecha_cxc1 );			
			 $process_2_pago = process_2_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc2, $descripcion_cxc2, $fecha_cxc2 );			
			 $process_3_pago = process_3_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc3, $descripcion_cxc3, $fecha_cxc3 );
			 $process_4_pago = process_4_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc4, $descripcion_cxc4, $fecha_cxc4 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" && $process_4_pago == "ok"  )  {
			     // Se insertó bien en la tabla cuentas_x_cobrar
				 return "ok";	 
			 } 				
						
		 break;
		 case 5:  // 5 PAGOS
					
			 // Introduzco en la BD. 5 pagos en las CUENTAS X COBRAR		
			 $process_1_pago = process_1_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc1, $descripcion_cxc1, $fecha_cxc1 );			
			 $process_2_pago = process_2_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc2, $descripcion_cxc2, $fecha_cxc2 );			
			 $process_3_pago = process_3_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc3, $descripcion_cxc3, $fecha_cxc3 );
			 $process_4_pago = process_4_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc4, $descripcion_cxc4, $fecha_cxc4 );
			 $process_5_pago = process_5_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc5, $descripcion_cxc5, $fecha_cxc5 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" && $process_4_pago == "ok" && $process_5_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_cobrar
				 return "ok";	 
			 } 					
					
		 break; 
							 
	  }  // Fin del switch($y)
     
   }  // Fin de la función process_num_pagos_ventas()
  
//07 (private) 
   function process_1_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc1, $descripcion_cxc1, $fecha_cxc1)
   {
	   // Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 1.  
       
	   //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR COBRAR.
      $query12 = "INSERT INTO cuentas_x_cobrar ( fecha_registro, fecha_vencimiento, no_venta, local_venta, cliente, detalle_registro, valor_deuda, valor_ingresado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxc1."', '".$id_venta."', '".$select_local."', '".$id_cliente_venta."', '".$descripcion_cxc1."', '".$monto_cxc1."', '0', '".$monto_cxc1."', 0 )";
      $query12 = mysql_query($query12);
	  $num_rows_query12 = mysql_affected_rows();
	  if ( $num_rows_query12 > 0 ) {
		  // Se insertaron correctamente los datos en la BD.
		  return "ok";
		  
	  } else { echo mysql_error(); } 
  
   }  // Fin de la función process_1_pago_ventas($a,$b,$c,$d,$e)
  
//08 (private) 
   function process_2_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc2, $descripcion_cxc2, $fecha_cxc2)
   {
	   // Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 2.  
   
       //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR COBRAR.
      $query12 = "INSERT INTO cuentas_x_cobrar ( fecha_registro, fecha_vencimiento, no_venta, local_venta, cliente, detalle_registro, valor_deuda, valor_ingresado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxc2."', '".$id_venta."', '".$select_local."', '".$id_cliente_venta."', '".$descripcion_cxc2."', '".$monto_cxc2."', '0', '".$monto_cxc2."', 0 )";
      $query12 = mysql_query($query12);
	  $num_rows_query12 = mysql_affected_rows();
	  if ( $num_rows_query12 > 0 ) {
		  // Se insertaron correctamente los datos en la BD.
		  return "ok";
		  
	  } else { echo mysql_error(); } 
    
   }  // Fin de la función process_2_pago_ventas($a,$b,$c,$d,$e)
      
//09 (private) 
   function process_3_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc3, $descripcion_cxc3, $fecha_cxc3)
   {
	   // Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 3.  
  
       //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR COBRAR.
      $query12 = "INSERT INTO cuentas_x_cobrar ( fecha_registro, fecha_vencimiento, no_venta, local_venta, cliente, detalle_registro, valor_deuda, valor_ingresado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxc3."', '".$id_venta."', '".$select_local."', '".$id_cliente_venta."', '".$descripcion_cxc3."', '".$monto_cxc3."', '0', '".$monto_cxc3."', 0 )";
      $query12 = mysql_query($query12);
	  $num_rows_query12 = mysql_affected_rows();
	  if ( $num_rows_query12 > 0 ) {
		  // Se insertaron correctamente los datos en la BD.
		  return "ok";
		  
	  } else { echo mysql_error(); } 
	  
   }  // Fin de la función process_3_pago_ventas($a,$b,$c,$d,$e)
    
//10 (private) 
   function process_4_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc4, $descripcion_cxc4, $fecha_cxc4)
   {
	   // Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 4.  
       
	   //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR COBRAR.
      $query12 = "INSERT INTO cuentas_x_cobrar ( fecha_registro, fecha_vencimiento, no_venta, local_venta, cliente, detalle_registro, valor_deuda, valor_ingresado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxc4."', '".$id_venta."', '".$select_local."', '".$id_cliente_venta."', '".$descripcion_cxc4."', '".$monto_cxc4."', '0', '".$monto_cxc4."', 0 )";
      $query12 = mysql_query($query12);
	  $num_rows_query12 = mysql_affected_rows();
	  if ( $num_rows_query12 > 0 ) {
		  // Se insertaron correctamente los datos en la BD.
		  return "ok";
		  
	  } else { echo mysql_error(); } 
  
   }  // Fin de la función process_4_pago_ventas($a,$b,$c,$d,$e)
    
//11 (private) 
   function process_5_pago_ventas($fecha, $id_cliente_venta, $id_venta, $select_local, $monto_cxc5, $descripcion_cxc5, $fecha_cxc5)
   {
	   // Función que procesa la entrada de la venta a crédito a las CUENTAS X COBRAR para el PAGO 5.  
       
	   //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR COBRAR.
      $query12 = "INSERT INTO cuentas_x_cobrar ( fecha_registro, fecha_vencimiento, no_venta, local_venta, cliente, detalle_registro, valor_deuda, valor_ingresado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxc5."', '".$id_venta."', '".$select_local."', '".$id_cliente_venta."', '".$descripcion_cxc5."', '".$monto_cxc5."', '0', '".$monto_cxc5."', 0 )";
      $query12 = mysql_query($query12);
	  $num_rows_query12 = mysql_affected_rows();
	  if ( $num_rows_query12 > 0 ) {
		  // Se insertaron correctamente los datos en la BD.
		  return "ok";
		  
	  } else { echo mysql_error(); } 
  
   }  // Fin de la función process_5_pago_ventas($a,$b,$c,$d,$e)
    
//12 
   function show_resumen_ventas_today() 
   {
	   // Funcíon que muestra todos lo relacionado con los datos del RESUMEN DE VENTAS DEL DÍA.  
   
       $local_stock = $_SESSION['id_local'];
	   $fecha = gmdate('Y-m-d', time() - 18000 );
   
      //01 Defino el contador para ver las ventas del dia de HOY....
	  $num_ventas_totales = 0; 
   
      //02 SELECCIONO LAS VENTAS DEL DÍA DE HOY DE ACUERDO A LA VARIABLE $fecha.
	  $query12v = "SELECT * FROM ventasalmacen_".$_SESSION['id_local']." WHERE fecha_venta='".$fecha."' ORDER BY id_venta DESC";
	  $query12v = @mysql_query($query12v) or die(mysql_error());
	  $num_rows_query12v = mysql_num_rows($query12v);
	  if ( $num_rows_query12v > 0 )  {
		  // CASO 1: Esto significa que hay ventas en el día de HOY.	  
		  for ( $i=1; $i <= $num_rows_query12v; $i++ )
		  {
			   $ventas[$i] = mysql_fetch_assoc($query12v);		   
		  
		       //03 VERIFICO SI TIENE UN id_cliente_venta VÁLIDO DIFERENTE DE 0 ( caso 0 es cuando la venta es a un cualquiera ) 
		       if ( $ventas[$i]['id_cliente_venta']  != "0" )  {
				
				   $query12v1 = "SELECT nombre FROM proveedores_clientes WHERE id=".$ventas[$i]['id_cliente_venta']."";
				   $query12v1 = @mysql_query($query12v1) or die (mysql_error());
				   $num_rows_query12v1 = mysql_num_rows($query12v1);
				   if ( $num_rows_query12v1 > 0 )  {
					   // Se realizó bien la consulta.    
				       $nombre_usuario = mysql_fetch_assoc($query12v1);
				       $ventas[$i]['nombre'] = $nombre_usuario['nombre'];
				   }
								   
			   } else {
				   
				   $ventas[$i]['nombre'] = "Sin Detalle";  
				   
			   }  // Fin del if //3
		  		  
		  }  // Fin del for
			   
	      $ventas[0]['num_ventas'] = $num_rows_query12v; 		   
		  return $ventas;
			  
	  } else {
		  // CASO 2: Esto significa que no hay ventas en el día de HOY.  	
		  $ventas[0]['num_ventas'] = 0;
		  return  $ventas;
			 
	  }
	    
   }  // Fin de la función show_resumen_ventas_today()
  
//13 
   function show_resumen_ventas_today_almacenes() 
   {
	   // Función que muestra el # de todas las ventas del día de todos los almacenes(caso Administrador).
       
	   $fecha = gmdate('Y-m-d', time() - 18000 );
	   
	   //01 BUSCO LA CANTIDAD DE ALMACENES QUE HAY EN EL NEGOCIO
       $query13 = "SELECT id, nombre_local, tipo_local FROM locales_inventarios"; 
	   $query13 = @mysql_query($query13) or die(mysql_error());
       $num_rows_query13 = mysql_num_rows($query13);                                                                       
       if ( $num_rows_query13 > 0 )  {
		   // Esto significa que están ya introducidos los locales en la BD.   
		   for ( $i=0; $i < $num_rows_query13; $i++ )
		   {
			   
			    $locales[$i] = mysql_fetch_assoc($query13); 
			   
		   }  // Fin del for
	   
	   } else {
		   // Esto significa que no hay ningun local introducido en la BD.   
	       return "null";
	    
	   }
      
       //02 BUSCO LA CANTIDAD DE VENTAS DE ESE DÍA DE CADA ALMACÉN.
	   for ( $i=0; $i < $num_rows_query13; $i++ )
	   {
		   
		   //03 BUSCO LAS VENTAS DEL DÍA DE HOY.
		   switch($locales[$i]['id'])
		   {
			   case "1":  // CASO BODEGA.
			        // NO PASA NADA PUES EN LA BODEGA NO HAY VENTAS.
			   break;
			   default:   // CASO ALMACENES.
			        
					$query131 = "SELECT id_venta FROM ventasalmacen_".$locales[$i]['id']." WHERE fecha_venta='".$fecha."'";
					$query131 = @mysql_query($query131) or die(mysql_error());
					$num_rows_query131 = mysql_num_rows($query131);
					
					$locales[$i]['num_ventas'] = $num_rows_query131;
			   break;    
		   } // Fin del switch($locales[$i]['id'])
		  	   
	   }  // FIN DEL for ( $i=0; $i < $num_rows_query13; $i++ )
      
       return $locales;  
      
   } // Fin de la función show_resumen_ventas_today_almacenes()
  
//14 
   function venta_cliente() 
   {
	   // Función que muestra las ventas de un cliente en un almacén determinado por el usuario.
       
	   // Recibo las variables $_POST[] ó $_GET[]
       if ( isset($_GET['vnt']) && $_GET['vnt'] == 2 )  {
		   // CASO 1: VISTA DE IMPRESIÓN.   
	       $arr['venta_cliente_local']        = "check";                           // = check.
		   $arr['local_stock']                = $_GET['id'];                       // id del Local.
		   $arr['id_cliente_ventas_reporte']  = $_GET['idc'];                      // id del cliente
			   
	   } else {
		   // CASO 2: VISTA DE LA WEB.
		   $arr = $_POST;   
	   }
	     
	   if ( isset($arr['venta_cliente_local']) && $arr['venta_cliente_local'] == "check" )  {
		   //CASO 1. Esto es para para cuando se mandó el $_POST con los datos.
		   $query14 = "SELECT ventasalmacen_".$arr['local_stock'].".*, proveedores_clientes.nombre FROM ventasalmacen_".$arr['local_stock'].",  proveedores_clientes WHERE ventasalmacen_".$arr['local_stock'].".id_cliente_venta=proveedores_clientes.id AND ventasalmacen_".$arr['local_stock'].".id_cliente_venta='".$arr['id_cliente_ventas_reporte']."'";
		   $query14 = @mysql_query($query14) or die(mysql_error());
		   $num_rows_query14 = mysql_num_rows($query14);
		   if ( $num_rows_query14 > 0 )  {
		      // Esto significa que hay VENTAS en ese cliente para la BD.
			  for ( $i=0; $i < $num_rows_query14; $i++ )
			  {
				  
				   $ventas_clientes[$i] = mysql_fetch_assoc($query14);			  
				  
			  } // Fin del for  	      
		     
		      return $ventas_clientes;
		   
		   } else {
			    // No hay ventas registradas en la BD.
		        return "vacio";   
		   }
				   
	   } else {
		   //CASO 2. No SE HAN ENVIADO VARIABLES $_POST.
		   return "error"; 
	   }
		   
   }  // Fin de la función process_venta_cliente() 

//15 
   function resumen_ventas()
   {
	   // Función que muestra el resumen de ventas en un local determinado. 
   
       // Verifico las variables $_POST[] ó $_GET[]
	   if ( isset($_GET['vnt']) && $_GET['vnt'] == "1" )  {
		   // CASO 1: Para la vista de impresión del Resumen de Ventas.   
           $arr['local_resventas']        = $_GET['id'];      // Id del Local.              
           $arr['fecha_inicial']          = $_GET['fi'];      // Fecha Inicial.
		   $arr['fecha_final']            = $_GET['ff'];      // Fecha Final.
		   $arr['nombre_local_resventas'] = $_GET['name'];    // Nombre del Local de las Ventas.
			   
	   } else {
		   // CASO 2: Para la vista de la Web del Sistema.
		   $arr = $_POST;   
	   }
	   
	   if ( isset($arr['nombre_local_resventas']) && $arr['nombre_local_resventas'] != "" )  {
           //01. Esto es para para cuando se mandó el $_POST con los datos.
		   
		   $query15 = "SELECT * FROM ventasalmacen_".$arr['local_resventas']." WHERE fecha_venta BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."'";
	       $query15 = @mysql_query($query15) or die(mysql_error());
	       $num_rows_query15 = mysql_num_rows($query15);
	       if ( $num_rows_query15 > 0 )  {
		      // CASO 1: Esto significa que hay ventas en el día de HOY.	  
		      for ( $i=0; $i < $num_rows_query15; $i++ )
		      {
			
			       $ventas_almacen[$i] = mysql_fetch_assoc($query15);		   
			       
				   //02 VERIFICO SI TIENE UN id_cliente_venta VÁLIDO DIFERENTE DE 0 ( caso 0 es cuando la venta es a un cualquiera ) 
		           if ( $ventas_almacen[$i]['id_cliente_venta']  != "0" )  {
				
				       $query151 = "SELECT nombre FROM proveedores_clientes WHERE id='".$ventas_almacen[$i]['id_cliente_venta']."'";
				       $query151 = @mysql_query($query151) or die (mysql_error());
				       $num_rows_query151 = mysql_num_rows($query151);
				       if ( $num_rows_query151 > 0 )  {
					       // Se realizó bien la consulta.    
				           $nombre_usuario = mysql_fetch_assoc($query151);
				           $ventas_almacen[$i]['nombre'] = $nombre_usuario['nombre'];
				       }
				
				    } else {
				   
				        $ventas_almacen[$i]['nombre'] = "Sin Detalle";  
				   
			        }  // Fin del if //3
		  		  
		        }  // Fin del for
			   	           
		      return $ventas_almacen;
		   
		   } else {
			    // No hay ventas registradas en la BD.
		        return "vacio";   
		   }
		     
       } else {
		   //CASO 2. No SE HAN ENVIADO VARIABLES $_POST.
		   return "error"; 
	   }
        
   }   // Fin de la función resumen_ventas()

  
/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_ventas   *****/

  if ( isset($_GET['data']) && $_GET['data'] == "contado" )  {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CONTADO.
	  process_contado_ventas();
  } else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pago1" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pago=1
	  process_creditoentradaXpagosY_ventas(0, 1);
  } else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pagos2" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pagos=2
	  process_creditoentradaXpagosY_ventas(0, 2);
  } else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pagos3" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pagos=3
	  process_creditoentradaXpagosY_ventas(0, 3);
  } else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pagos4" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pagos=4
	  process_creditoentradaXpagosY_ventas(0, 4);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pagos5" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pagos=5
	  process_creditoentradaXpagosY_ventas(0, 5);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pago1" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada!= 0 -> Cant. Pagos=1
	  process_creditoentradaXpagosY_ventas(1, 1);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos2" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=2
	  process_creditoentradaXpagosY_ventas(1, 2);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos3" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=3
	  process_creditoentradaXpagosY_ventas(1, 3);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos4" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=4
	  process_creditoentradaXpagosY_ventas(1, 4);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos5" )   {
	  // Esto es para procesar los datos cuando en la Nueva Venta se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=4
	  process_creditoentradaXpagosY_ventas(1, 5);
  }  
  
?>  