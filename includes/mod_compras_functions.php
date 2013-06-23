<?php
@session_start();

include_once('connection.php');

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_compras_y_gastos   *****/

//01 numero_de_compra()  --> Función que muestra el número de la compra actual que voy a efectuar (id tabla 11 compras).
//02 charges_articles()  --> Función que carga todos los artículos para ponerlos en el select <select> del 2.DETALLE DE LA COMPRA
//03 charge_moneda()     --> Función que carga la MONEDA DE LOS INFORMES DE LA EMPRESA.   
//04 process_contado1()  --> Función que procesa los datos cuando en la Nueva Compra se selecciona: CONTADO -> Origen del Pago -> Banco ó Caja.
//05 process_contado2()  --> Función que procesa los datos cuando en la Nueva Compra se selecciona: CONTADO -> Origen del Pago -> Banco y Caja.
//06 process_creditoentradaXpagoY($x, $y) -> Función que procesa los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada=(0,1) -> Cant. Pagos=(1,2,3,4,5)

//07  (private) process_12datos_y_detalle() -> Función que procesa la sección de: 1. DATOS GENERALES Y 2. DETALLE DE COMPRA.
//08  (private) process_detalle_pago() -> Función que va a dirigir todo lo referente a: 2. DETALLE DE PAGO.
//09  (private) insert_registro_bancario($a,$b,$c,$d)  -> Función que inserta datos en la tabla registro_bancario cuando se paga algo al contado.
//10 (private) insert_caja_central($a)	-> Función que inserta datos en la tabla caja_central cuando la compra se paga con dinero de la caja. 
//11 (private) process_num_pagos($a, $b) -> Función que procesa el número de PAGOS (1,2,3,4 ó 5) del CRÉDITO. 
//12 (private) process_1_pago($a,$b,$c,$d,$e,$f) -> Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 1.
//13 (private) process_2_pago($a,$b,$c,$d,$e,$f) -> Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 2.
//14 (private) process_3_pago($a,$b,$c,$d,$e,$f) -> Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 3.
//15 (private) process_4_pago($a,$b,$c,$d,$e,$f) -> Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 4.
//16 (private) process_5_pago($a,$b,$c,$d,$e,$f) -> Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 5.
//17 charge_compras() -> Función que carga los datos de todas las compras para mostrar en la vista principal.
//18 resumen_compras($a,$b) -> Función que muestra el resumen de compras entre dos fechas determinadas. 


/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_compras  *****/

/************************************************************************************************************/


/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_compras   *****/
//01
  function numero_de_compra()
  {
	  // Función que muestra el número de la compra actual que voy a efectuar (id tabla 11 compras).
	    
	  //01 Busco si hay algun registro en la tabla.
	  $query01 = "SELECT COUNT(id) FROM registro_compras"; 
	  $query01 = mysql_query($query01);
	  $total  = mysql_result($query01, 0);
	  if ( $total == 0 )  {
		    
		  return "1";  // Esto significa que la tabla está vacía
		  
	  } else {
	  /* 02 Busco el último id de la tabla para sumarle 1 y enviarlo de retorno si no tiene una casilla vacía, por eso:
	        
	    ******* DEBO CHEQUEAR SI EXISTE ALGUN CAMPO DE LA TABLA registro_compras VACÍO ******
	  
	  */
	      $query011 = "SELECT id, numero_compra, test FROM registro_compras ORDER BY id DESC LIMIT 1";
	      $query011 = mysql_query($query011);
	      $num_rows_query011 = mysql_num_rows($query011);	  
	      if ( $num_rows_query011 > 0 )  {
		      //03 Guardo el id y el test en un arreglo para ver si test tiene algun valor
		      $resultado = mysql_fetch_assoc($query011);
			  
			  //04 Reviso si hay algo en el campo test
			  $id         = $resultado['id'];
			  $num_compra = $resultado['numero_compra'];
			  $test       = $resultado['test'];
			  if ( $test == "" )  {
				  // Esto significa que no he completado de llenar todos los campos de la tabla...No se completó la compra.  
				  // Borro la compra esa incompleta.
				  $query012 = "DELETE FROM registro_compras WHERE id='".$id."'";
				  $query012 = mysql_query($query012);
				  $num_row_query012 = mysql_affected_rows();
				  if ( $num_row_query012 > 0 )  {
					  // Esto significa que se borró bien la consulta
					   settype($num_compra, "int");
					   $enviar = $num_compra;
			           if ( $enviar == 0 )  {
						   // Esto para cuando no quedan registros en la BD.   
					       return "1";
					   } else {
						   return $enviar;
					   }
									      
			      } else { echo mysql_error(); }
				  
			  } else {
				  // Esto significa que sí tengo la compra completada.  
			      settype($num_compra, "int");
				  $enviar = $num_compra + 1;
			      return $enviar;
			  
			  }
					   	  
	      } else { echo mysql_error();  }
		  
	  }
	 	  
  } // Fin de la función numero_de_compra()
  
//02 
  function charges_articles()
  {
	  //  Función que carga todos los artículos para ponerlos en el select <select> del 2.DETALLE DE LA COMPRA
  
      $query02 = "SELECT id, referencia_art, proveedor_art FROM articulos_inventario ORDER BY referencia_art ASC";
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
    
  }   // Fin de la función charges_articles()
  
//03
  function charge_moneda()
  {
	  // Función que carga la MONEDA DE LOS INFORMES DE LA EMPRESA.  
  
      $query03 = "SELECT moneda_informes FROM data_empresa";
      $query03 = mysql_query($query03);
	  $num_rows_query03 = mysql_num_rows($query03);
	  if ( $num_rows_query03 > 0 )  {
		    
		  $moneda = mysql_fetch_assoc($query03);
		  return $moneda;
		  
	  }  
  
  }  // Fin de la función charge_modeda()
  
//04 
  function process_contado1()
  {
	 // Función que procesa los datos cuando en la Nueva Compra se selecciona: CONTADO -> Origen del Pago -> Banco ó Caja.
	 
	 // Recibo las variables $_POST 
	 $arr = $_POST;
	 $fecha = addslashes($arr['fecha_compra']);                    // Esta es la fecha de la compra.
	 $no_orden_de_compra = $arr['orden_compra'];                   // No. de orden de compra.
	 $descripcion = addslashes($arr['descripcion_origen_pago']);   // Descripción de la Compra.
	 $debitos = addslashes($arr['valor_real_de_la_compra']);       // A bonar en el DÉBITO de la cuenta de banco
	 
	 //01 Inserto en la Base de datos los datos del módulo 1. DATOS GENERALES y 2. DETALLE DE COMPRA.
	 $datos_generales_y_detalle_compra = process_12datos_y_detalle();   // Esta variable debe ser 'ok'.  
	 
	 //02 Llamo a la función detalle pago que es la que me va a dirigir todo lo referente a: 2. DETALLE DE PAGO.
	 $detalle_pago = process_detalle_pago();
	 
	 if ( $datos_generales_y_detalle_compra == "ok" && $detalle_pago == "ok" )  {
	      //03 LLAMO A LAS FUNCIONES PARA HACER LOS INSERT EN LAS RESPECTIVAS TABLAS:
		  /*
			 registro_bancario  (si)
		     cuentas_x_pagar    (no)
		     caja_central       (si)
			   */
          if ( $arr['origen_pago'] == "banco"  )  {
	          //CASO 1: Se paga con un cheque para cobrar al momento QUE VA A registro bancario.
		      $actualizacion = insert_registro_bancario($fecha, $no_orden_de_compra, $descripcion, $debitos);	  
		      if ( $actualizacion == "ok" )  {
			      // Todo ok ENVÍO UN header(Location: ....)
			      header('Location: ../index.php?mod=mod_compras#tabs-4');
			  }	  
			  
	       } else if ( $arr['origen_pago'] == "caja_central" ) {
		       // CASO 2: Se paga sacando dinero de la Caja Central.
		       $actualizacion = insert_caja_central($fecha, $no_orden_de_compra, $descripcion, $debitos);
			   if ( $actualizacion == "ok" )  {
				   // Todo ok envío un header(Location: ....)
				   header('Location: ../index.php?mod=mod_compras#tabs-4');
			   }
	       	   
		   }  // Fin del if ( $arr['origen_pago']
	 
	 } // Fin del if ( $datos_generales_y_detalle_compra == "ok" && $detalle_pago == "ok" )  {
	  
  }  // Fin de la función process_contado1
  
//05 
  function process_contado2()  
  {
	  // Función que procesa los datos cuando en la Nueva Compra se selecciona: CONTADO -> Origen del Pago -> Banco y Caja.
  
     //00 Recibo las variables $_POST 
	 $arr = $_POST;
	 $fecha = addslashes($arr['fecha_compra']);                          // Esta es la fecha de la compra.
	 $no_orden_de_compra = $arr['orden_compra'];                         // No. de orden de compra.
	 $debitos = addslashes($arr['monto_pago_banco']);                    // Monto de pago en BANCO.       
	 $descripcion_banco = addslashes($arr['descripcion_pago_banco']);    // Descripción del pago al BANCO de la Compra.
	 $pago_caja = addslashes($arr['monto_pago_caja']);                   // Monto del Pago en CAJA.
	 $descripcion_caja = addslashes($arr['descripcion_pago_caja']);      // Descrpción del Pago con el dinero de la CAJA.
	 
     //01 Inserto en la Base de datos los datos del módulo 1. DATOS GENERALES y 2. DETALLE DE COMPRA.
	 $datos_generales_y_detalle_compra = process_12datos_y_detalle();   // Esta variable debe ser 'ok'.  
	 
	 //02 Llamo a la función detalle pago que es la que me va a dirigir todo lo referente a: 2. DETALLE DE PAGO.
	 $detalle_pago = process_detalle_pago();
	 
	  if ( $datos_generales_y_detalle_compra == "ok" && $detalle_pago == "ok" )  {
	      
		  // LLAMO A LAS FUNCIONES PARA HACER LOS INSERT EN LAS RESPECTIVAS TABLAS:
		  /*
			 registro_bancario (si)
		     cuentas_x_pagar   (no)
		     caja_central      (si)
			   */
		  //03 INSERTO LOS VALORES DEL PAGO A CONTADO EN EL BANCO.
	      $actualizacion_banco = insert_registro_bancario($fecha, $no_orden_de_compra, $descripcion_banco, $debitos);
          //04 INSERTO LOS VALORES DEL PAGO EN LA CAJA.
          $actualizacion_caja = insert_caja_central($fecha, $no_orden_de_compra, $descripcion_caja, $pago_caja);
		  //05 COMPRUEBO QUE TODO ESTÉ BIEN Y MANDO UN HEADER. 
	      if ( $actualizacion_banco == "ok" && $actualizacion_caja == "ok" )  {
			  // Todo ok envío un header(Location: ....)
			  header('Location: ../index.php?mod=mod_compras#tabs-4');
			  
		  }
	 
	 } else { echo mysql_error(); }
      
  }  // Fin de la función process_contado2
  
//06 
  function process_creditoentradaXpagosY($x, $y) 
  {
	  // Función que procesa los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada= (0 ó 1) -> Cant. Pagos=(1,2,3,4,5)
  
     //00 Recibo las variables $_POST 
	 $arr = $_POST;
	 
	 $fecha = addslashes($arr['fecha_compra']);                    // Esta es la fecha de la compra.
	 $no_orden_de_compra = $arr['orden_compra'];                   // No. de orden de compra.
	 $descripcion = addslashes($arr['descripcion_origen_pago']);   // Descripción de la Compra.
	 $debitos = addslashes($arr['entrada_dinero']);                // A bonar en el DÉBITO de la cuenta de banco
	
	 $descripcion_banco = addslashes($arr['descripcion_pago_banco']);
	 $debitos_banco = addslashes($arr['monto_pago_banco']);
	 $descripcion_caja = addslashes($arr['descripcion_pago_caja']);
	 $pago_caja = addslashes($arr['monto_pago_caja']);
	 
	 $origen_pago = $arr['origen_pago'];                                          // Esto me dice si fue 'banco' 'caja' ó 'banco y caja'	 
	 $cantidad_de_pagos_credito = addslashes($arr['cantidad_de_pagos_credito']);  // Cantidad de Pagos.
	 
	 //01 Inserto en la Base de datos los datos del módulo 1. DATOS GENERALES y 2. DETALLE DE COMPRA.
	 $datos_generales_y_detalle_compra = process_12datos_y_detalle();   // Esta variable debe ser 'ok'.  
	 
	 //02 Llamo a la función detalle pago que es la que me va a dirigir todo lo referente a: 2. DETALLE DE PAGO.
	 $detalle_pago = process_detalle_pago();
	 
	  if ( $datos_generales_y_detalle_compra == "ok" && $detalle_pago == "ok" )  {
	      
	      //03 SELECCIONO DE ACUERDO A SI HAY 'ADELANTO'(1) O 'NO'(0)  
	      switch($x)
		  {
			  case 0:  // CASO 1: NO HAY ADELANTO.
			      //04 INSERTO LOS VALORES DEL PAGO A CRÉDITO EN LAS CUENTAS POR PAGAR.
		          /*
			         registro_bancario (no)
		             cuentas_x_pagar   (si)
		             caja_central      (no)
		          */
				  //a) COMO LA ENTRADA ES 0 SÓLO PROCESAR LOS DATOS DE ACUERDO AL NÚMERO DE PAGOS.
				  $num_pagos = process_num_pagos($y, $arr); 
				  if ( $num_pagos == "ok" )  {
					  // Esto significa que se insertaron bien los datos en la BD.
					  header('Location: ../index.php?mod=mod_compras#tabs-4');  
					  
				  }  
			  		  
			  break;
			  case 1:  // CASO 2: HAY ADELANTO.
			     //05 INSERTO LOS VALORES DEL PAGO A CRÉDITO EN LAS CUENTAS POR PAGAR.
			      /*
			         registro_bancario (si)
		             cuentas_x_pagar   (si)
		             caja_central      (si)
		          */
			      switch($origen_pago)
				  {
					  case "banco":                 
					       //CASO 1: Se paga con un cheque para cobrar al momento QUE VA A registro bancario.
		                   $actualizacion = insert_registro_bancario($fecha, $no_orden_de_compra, $descripcion, $debitos);	  
		                   if ( $actualizacion == "ok" )  {
			                   $num_pagos_credito = process_num_pagos($y, $arr); 
				               if ( $num_pagos_credito == "ok" )  {
					               // Esto significa que se insertaron bien los datos en la BD.
					               header('Location: ../index.php?mod=mod_compras#tabs-4');  
					  
				               }   
						   }	
					  
					  break;
					  case "caja_central":          //B) CASO PAGO DE LA CAJA.
					      // CASO 2: Se paga sacando dinero de la Caja Central.
		                  $actualizacion = insert_caja_central($fecha, $no_orden_de_compra, $descripcion, $debitos);
			              if ( $actualizacion == "ok" )  {
				              $num_pagos_credito = process_num_pagos($y, $arr); 
				              if ( $num_pagos_credito == "ok" )  {
					               // Esto significa que se insertaron bien los datos en la BD.
					               header('Location: ../index.php?mod=mod_compras#tabs-4');  
					  
				              }  
			              }
					  
					  break;
					  case "caja_central_banco":    //C) CASO PAGO DEL BANCO Y LA CAJA.
                          // CASO 03 INSERTO LOS VALORES DEL PAGO A CONTADO EN EL BANCO.
	                      $actualizacion_banco = insert_registro_bancario($fecha, $no_orden_de_compra, $descripcion_banco, $debitos_banco);
                          // CASO 04 INSERTO LOS VALORES DEL PAGO EN LA CAJA.
                          $actualizacion_caja = insert_caja_central($fecha, $no_orden_de_compra, $descripcion_caja, $pago_caja);
		                  //05 COMPRUEBO QUE TODO ESTÉ BIEN Y MANDO UN HEADER. 
	                      if ( $actualizacion_banco == "ok" && $actualizacion_caja == "ok" )  {
			                  $num_pagos_credito = process_num_pagos($y, $arr); 
				              if ( $num_pagos_credito == "ok" )  {
					               // Esto significa que se insertaron bien los datos en la BD.
					               header('Location: ../index.php?mod=mod_compras#tabs-4');  
					  
				              }  
		                  }

					  break;
					 				  
				  }  // Fin del switch($origen_pago)
			  		  
			  break;
			  
		  } // Fin del switch($x)
		  	  
	  } // Fin del if ( $datos_generales_y_detalle_compra == "ok" && $detalle_pago == "ok" )  {
	  
  }    // Fin de la función process_creditoentradaXpagoY()
  
//7 (private) 
  function process_12datos_y_detalle() 
  {
	  // Función que procesa la sección de: 1. DATOS GENERALES Y 2. DETALLE DE COMPRA.
  
      $articulos_seleccionados = 0;  // Aquí van la cantidad de artículos seleccionados en la compra.
	    
	  //01 Recibo las variables $_POST
      $arr = $_POST;
	  
	  if ( isset($arr) )  {
		  
		  //02 Busco la CANTIDAD DE ARTÍCULOS de la compra y guardo los valores de los DATOS seleccionados en un ARRAY.
		  foreach ( $_POST as $key => $value )
          {
         /*1*/if ( substr($key,0,16) == "descripcion_art_" && $value != ""  )  {
	            // DE ESTA MANERA SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO ---->>>> DESCRIPCIÓN DEL ARTÍCULO.
		        $num = substr($key, 16);                      // Numero del orden del array.
		        $array[$num]['descripcion_art_'] = $value;    // valor de la descripción.
		
		        $numero_indice_final = substr($key, 16);  // ESTO LO VOY A USAR PARA EL for($i... a la hora de insertar los datos en la base de datos...este es el número del ultimo registro con contenido )
		        /*echo $key."-".$value;
	            echo "<br />"; */ 
	          } else {
		    /*2*/if ( substr($key,0,7) == "codigo_" && ( $value != "" || substr($key, 7) == @$numero_indice_final ) )  {
	                // DE ESTA MANERA SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO --->>>>> CÓDIGO
		            $num = substr($key, 7);
		            if ( $value == "" )  {      // <<<<--- Esto no debe suceder pues todo artículo está asociado a un código.
				       $array[$num]['codigo_'] = 0;
			        } else {
				       $array[$num]['codigo_'] = $value;
			        }
			      
				     /*echo $key."-".$value;
	                 echo "<br />";*/ 
		         } else {
			   /*3*/if ( substr($key,0,6) == "costo_" && ( $value != "0" || substr($key, 6) == @$numero_indice_final ) )  {
	                   // SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO --->>>>> COSTO
		               $num = substr($key, 6);
		               if ( $value == "" )  {   // <<<<--- Esto no debe suceder pues todo artículo está asociado a un COSTO.
				           $array[$num]['costo_'] = 0;
			           } else {
				           $array[$num]['costo_'] = $value;
			           }
				       /*echo $key."-".$value;
	                   echo "<br />";*/ 
		            } else {
			      /*4*/if ( substr($key,0,9) == "cantidad_" && ( $value != "0" || substr($key, 9) == @$numero_indice_final ) )  {
	                      // SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO --->>>>> CANTIDAD
		                  $num = substr($key, 9);
		                  if ( $value == "" )  {   // <<<<--- Esto no debe suceder pues todo artículo está asociado a un COSTO.
				             $array[$num]['cantidad_'] = 0;
			              } else {
				             $array[$num]['cantidad_'] = $value;
			              }
				          /*echo $key."-".$value;
	                      echo "<br />";*/ 
				       } else {
					 /*5*/if ( substr($key,0,12) == "valor_total_" && ( $value != "0" || substr($key, 12) == @$numero_indice_final ) )  {
	                         // SÓLO ME QUEDO CON LAS VARIABLES QUE TIENEN VALORES EN EL CAMPO --->>>>> VALOR TOTAL
		                     $num = substr($key, 12);
		                     if ( $value == "" )  {   // <<<<--- Esto no debe suceder pues todo artículo está asociado a un VALOR TOTAL.
				                 $array[$num]['valor_total_'] = 0;
			                 } else {
				                 $array[$num]['valor_total_'] = $value;
			                 }
				             /*echo $key."-".$value;
	                         echo "<br />";*/ 
				          }  // Fin del if ( substr($key,0,12) == "valor_total_" && ( $value != "" || ....
				      
					   }  // Fin del if ( substr($key,0,9) == "cantidad_" && ( $value != "" || subst....
									
					}  // Fin del if ( substr($key,0,6) == "costo_" && ( $value != "" || ......
				 			 
				 }   // Fin del if ( substr($key,0,7) == "codigo_" && ( $value != "" || substr($key, 7) == @.....
			  		  
			  }  // Fin del if ( substr($key,0,16) == "descripcion_art_" && $value != ""  )  {
		  		  
		  }  // Fin del foreach
		       
          //03 Introduzco en la Base de Datos los datos q faltan en: 1. DATOS GENERALES y 2. DETALLE DE COMPRAS.
          for ( $i=1; $i <= $numero_indice_final; $i++ )
          {
               if ( isset($array[$i]['descripcion_art_']) )  {
   
                   $articulos_seleccionados++;   // Para obtener la cantidad de artículos.
	   
	               //03.1.0 INSERTO EN LA TABLA compras_detalles_articulos LOS DATOS DE LOS ARTÍCULOS COMPRADOS.
				   $queryn = "INSERT INTO compras_detalles_articulos ( numero_compra, id_referencia_art, codigo_art, precio_costo_art, cantidad_articulo, valor_total_articulo )  VALUES  ( '".$arr['orden_compra']."', '".$array[$i]['descripcion_art_']."', '".$array[$i]['codigo_']."', '".$array[$i]['costo_']."', '".$array[$i]['cantidad_']."', '".$array[$i]['valor_total_']."' )";
				   $queryn = mysql_query($queryn);
    			   $num_rows_queryn = mysql_affected_rows();
				   if ( $num_rows_queryn > 0 )  {
					   //03.1.1 Creo artículos pendientes DE UN MOV DE ENTRADA.
					   $query_pendientes = "INSERT INTO articulos_pendientes_de_entrada ( id_local, id_codigo_articulo_mov, fecha_salida, concepto_mov, origen_mov_proveedor, cantidad_movimiento, observaciones_mov, recibido ) VALUES ( '1', '".$array[$i]['descripcion_art_']."', '".addslashes($arr['fecha_compra'])."', 'Orden de Compra no. ".$arr['orden_compra']."', '".$arr['proveedor_compra_hidden']."', '".$array[$i]['cantidad_']."', '', 0 )";
				 	   $query_pendientes = mysql_query($query_pendientes);
					   $num_rows_query_pendientes = mysql_affected_rows();
					   if ( $num_rows_query_pendientes > 0 )  {
						   continue;
					   } else { echo mysql_error();   }
									   
				   } else { echo mysql_error(); }		   
				/*   echo $array[$i]['codigo_'];
                   echo ",";
	               echo $array[$i]['costo_'];
                   echo ",";
                   echo $array[$i]['cantidad_'];
                   echo ",";	
                   echo $array[$i]['valor_total_'];
                   echo "<br />";   */
   
                } else {
	               continue;   
                }
		  }  // Fin del for ( $i=1; $i <= $numero_indice_final; $i++ )
          	  
		  //3.2 UPDATE LA TABLA registro_compras con los datos que me faltan.
		  $querym = "UPDATE registro_compras SET cantidad_articulos='".$articulos_seleccionados."', forma_de_pago='".$arr['forma_pago']."', monto_de_la_compra='".addslashes($arr['monto_total'])."', descuento='".addslashes($arr['descuento_general'])."', valor_pagado_real='".addslashes($arr['valor_real_de_la_compra'])."', usuario='".addslashes($_SESSION['nombre_completo'])."', test='1' WHERE numero_compra='".$arr['orden_compra']."'"; 
          $querym = mysql_query($querym);
		  $num_rows_querym = mysql_affected_rows();
          if ( $num_rows_querym > 0 )  {
			  // Esto significa que se update bien en la tabla...  
			  return "ok";
			  			  
		  } else { echo mysql_error(); }
	  	  
	  }   // Fin del  if ( isset($arr) )  {
       
  }  // Fin de la función process_1datos_generales()
  
//8  (private) 
  function process_detalle_pago()
  {
	  // Función que va a dirigir todo lo referente a: 2. DETALLE DE PAGO.
      /*
	      En esta función de acuerdo a los valores de algunas variables, será el resultado final de la query.
	  */ 
    
      //01 Recibo las variables $_POST
      $arr = $_POST;
	  $numero_compra = $arr['orden_compra'];
	  
	  if ( isset($arr) )  {
		   
          //02 Ahora hago un switch en base a si es UN CRÉDITO o UN DÉBITO.
		  switch($arr['forma_pago'])
		  {
			 case "contado":
			      //a) Saldo Inicial.
				  $saldo_inicial = addslashes($arr['valor_real_de_la_compra']);   // En este caso el saldo inicial es el valor de la compra en sí. 
			      //b) Origen del Pago.
				  $origen_del_pago = $arr['origen_pago'];            // El origen del pago puede ser banco, caja o ambos.
			      //c) Descripciones
				  if ( $origen_del_pago == "banco" || $origen_del_pago == "caja_central" )  {
			       
				      $descripcion1 = addslashes($arr['descripcion_origen_pago']);  // Es la descripción del Pago.
				      $monto_caja_central = "0";
					  $monto_banco = "0";
					  $descripcion_caja_central = "";
					  $descripcion_banco = "";
					  $saldo_del_credito = "0";
					  $cantidad_de_pagos = "0";
					  
		          } else if ( $origen_del_pago == "caja_central_banco" )  {
					  
					  $descripcion1 = "";
					  $monto_caja_central = $arr['monto_pago_caja'];
					  $monto_banco = $arr['monto_pago_banco'];
					  $descripcion_caja_central = addslashes($arr['descripcion_pago_caja']);
					  $descripcion_banco = addslashes($arr['descripcion_pago_banco']);
					  $saldo_del_credito = "0";
					  $cantidad_de_pagos = "0";
					  
				  }
					 
			 break;
			 case "credito":
			      //a) Saldo Inicial.
				  $saldo_inicial = $arr['entrada_dinero'];  // Es la entrada de dinero que doy.
				  //b) Origen del Pago.
			      if ( $saldo_inicial == "0" )  {
					  $origen_del_pago = "";      // Esto significa que no hay anticipo en el crédito.
				      $descripcion1 = "";
					  $monto_caja_central = "0";
					  $monto_banco = "0";
					  $descripcion_caja_central = "";
					  $descripcion_banco = "";
					  					  
				  } else {
					  $origen_del_pago = $arr['origen_pago'];            // El origen del pago puede ser banco, caja o ambos.
				      //c) Descripciones
				      if ( $origen_del_pago == "banco" || $origen_del_pago == "caja_central" )  {
			       
				         $descripcion1 = addslashes($arr['descripcion_origen_pago']);  // Es la descripción del Pago.
				         $monto_caja_central = "0";
					     $monto_banco = "0";
					     $descripcion_caja_central = "";
					     $descripcion_banco = "";
					     $saldo_del_credito = "0";
					     $cantidad_de_pagos = "0";
					  
		              } else if ( $origen_del_pago == "caja_central_banco" )  {
					  
					     $descripcion1 = "";
					     $monto_caja_central = $arr['monto_pago_caja'];
					     $monto_banco = $arr['monto_pago_banco'];
					     $descripcion_caja_central = addslashes($arr['descripcion_pago_caja']);
					     $descripcion_banco = addslashes($arr['descripcion_pago_banco']);
					     $saldo_del_credito = "0";
					     $cantidad_de_pagos = "0";
					  
					  }
				  			  
				  }  // Fin del if ( $saldo_inicial == "0" )  {
				  
				  //d) Saldo del Crédito. 
				  $saldo_del_credito = addslashes($arr['saldo_dinero']);
				  //e) Cantidad de Pagos.
				  $cantidad_de_pagos = addslashes($arr['cantidad_de_pagos_credito']);
				 
			 break;
			  				  
		  }  // Fin del switch($arr['forma_pago'])
		  
		  // Inserto en la tabla compras_detalles_pagos los valores de lo concerniente a los pagos.
          $query_pago = "INSERT INTO compras_detalles_pagos ( numero_compra, saldo_inicial, origen_del_pago, descripcion1, monto_caja_central, monto_banco, descripcion_caja_central, descripcion_banco, saldo_del_credito, cantidad_de_pagos ) VALUES( '".$numero_compra."', '".$saldo_inicial."', '".$origen_del_pago."', '".$descripcion1."', '".$monto_caja_central."', '".$monto_banco."', '".$descripcion_caja_central."', '".$descripcion_banco."', '".$saldo_del_credito."', '".$cantidad_de_pagos."' )";
          $query_pago = mysql_query($query_pago);
		  $num_rows_query_pago = mysql_affected_rows();
		  if ( $num_rows_query_pago > 0 )  {
			  // Se insertó bien en la base de datos.
			  return "ok";
		  } else { echo mysql_error(); }
	     
	  }  // Fin del if ( isset($arr) )  {
  
  }   // Fin de la función process_detalle_pago() 
    
//9 (private) 
  function insert_registro_bancario( $fecha, $no_orden_de_compra, $descripcion, $valor_pago ) 
  {
	  // Función que inserta datos en la tabla registro_bancario cuando el pago de la compra es al contado.
  
      //01 SELECCIONO EL VALOR DEL CAMPO saldos DEL ÚLTIMO REGISTRO INTRODUCIDO.  
	  $query1 = "SELECT saldos FROM registro_bancario ORDER BY id DESC LIMIT 1";
	  $query1 = mysql_query($query1);
	  $num_row = mysql_num_rows($query1);
	  if ( $num_row == 1 )  {
		 $last_saldo = mysql_fetch_assoc($query1);
	  } else {
	     echo mysql_error();	
	  }
    
	  $old_saldo = $last_saldo['saldos'];
	  settype($old_saldo, 'float');
	  settype($valor_pago, 'float');
  
      $saldo_total = $old_saldo - $valor_pago;
  
      $query_rb = "INSERT INTO registro_bancario( fecha, no_orden_de_compra, descripcion, debitos, creditos, saldos, reajustar_error ) VALUES ( '".$fecha."', '".$no_orden_de_compra."', '".$descripcion." ( Compra no. ".$no_orden_de_compra." )', '".$valor_pago."', 'no', '".$saldo_total."', 0 )"; 
      $query_rb = mysql_query($query_rb);
	  $num_rows_affected = mysql_affected_rows();
	  if ( $num_rows_affected > 0 )  {
	     /* Esto significa que se insertaron bien los datos en la BD. return ok */
	     return "ok";
				  
	  } else { echo mysql_error(); }
    
  }  // Fin de la función insert_registro_bancario()
  
  //10 (private) 
  function insert_caja_central($fecha, $no_orden_de_compra, $descripcion, $debitos)
  {
	  // Función que inserta datos en la tabla caja_central cuando la compra se paga con dinero de la caja.  
  
      //01 BUSCO EL SALDO DE LA ÚLTIMA TRANSACCIÓN DE LA CAJA.
      $query_cc1 = "SELECT saldo FROM cajacentral_1 ORDER BY id DESC LIMIT 1";
	  $query_cc1 = @mysql_query($query_cc1) or die(mysql_error());  
	  $num_rows_query_cc1 = mysql_num_rows($query_cc1);
	  if ( $num_rows_query_cc1 > 0 )  {
		  // Esto significa que hay al menos un registro en la BD. (  )
	      $resultado = mysql_fetch_assoc($query_cc1);
	      $old_saldo_en_caja  = $resultado['saldo'];
	      settype($old_saldo_en_caja, "float");       
		  settype($debitos, "float");
		  
		  $saldo_caja_final = $old_saldo_en_caja - $debitos;  // Esto es saldo final en la CAJA CENTRAL en el ORIGEN
	  
	      $compra = "Compra de Art&iacute;culos";
	      //02 INSERTO LA TRANSACIÓN DIRECTAMENTE EN LA TABLA cajacentral_1
          $query_cc2 = "INSERT INTO cajacentral_1 ( fecha_transaccion, tipo_transaccion, origen_transaccion,	destino_transaccion, cantidad_transaccion, observaciones, no_orden_de_compra, persona_q_hace_transaccion, recibido, saldo) VALUES ( '".$fecha."', 'Retiro de Caja', '', '".$compra."', '".$debitos."', '".$descripcion."', '".$no_orden_de_compra."', '".addslashes($_SESSION['nombre_completo'])."', 1, '".$saldo_caja_final."' )"; 
	      $query_cc2 = mysql_query($query_cc2);
	      $num_rows_query_cc2 = mysql_affected_rows();
	      if ( $num_rows_query_cc2 > 0 )  {
		      // Esto significa que se insertarion bien los datos en BD.
		      return "ok";  
	      } else { echo mysql_error(); }
	  } else {
		 // Esto significa que NO hay al menos un registro en la BD. ( TABLA VACÍA ) 
		  //03 RESTO 0 DEL VALOR DE LA CAJA 
		   $saldo_caja_final = 0 - $debitos;  // Esto es saldo final en la CAJA CENTRAL en el ORIGEN
		 
		  $compra = "Compra de Art&iacute;culos";
		  //04 INSERTO LA TRANSACIÓN DIRECTAMENTE EN LA TABLA cajacentral_1 pero pongo como el saldo final la var. $debitos
          $query_cc3 = "INSERT INTO cajacentral_1 ( fecha_transaccion, tipo_transaccion, origen_transaccion,	destino_transaccion, cantidad_transaccion, observaciones, no_orden_de_compra, persona_q_hace_transaccion, recibido, saldo) VALUES ( '".$fecha."', 'Retiro de Caja', '', '".$compra."', '".$debitos."', '".$descripcion."', '".$no_orden_de_compra."', '".addslashes($_SESSION['nombre_completo'])."', 1, '".$saldo_caja_final."' )"; 
	      $query_cc3 = mysql_query($query_cc3);
	      $num_rows_query_cc3 = mysql_affected_rows();
	      if ( $num_rows_query_cc3 > 0 )  {
		      // Esto significa que se insertarion bien los datos en BD.
		      return "ok";  
	      } else { echo mysql_error(); }
		  
	  }  // Fin del if ( $num_rows_query_cc1 > 0 )  {
  
  
  }  // Fin de la función insert_caja_central()
 
//11 (private) 
  function process_num_pagos($y, $arr) 
  {
	  // Función que procesa el número de PAGOS (1,2,3,4 ó 5) del CRÉDITO. 
  
      // Convierto las variables que necesito.
	  $fecha = addslashes($arr['fecha_compra']);                          // Esta es la fecha de la compra.
	  $id_proveedor_compra = $arr['id_proveedor_compra'];     // id_del proveedor.
	  $no_orden_de_compra = $arr['orden_compra'];             // No. de orden de compra.
	  $cantidad_de_pagos_credito = $arr['cantidad_de_pagos_credito'];  // Cantidad de Pagos
	  
	  $monto_cxp1 = $arr['monto_total_pago1'];                            // Monto Total de la Cuenta por Pagar(PAGO 1).       
	  $fecha_cxp1 = addslashes($arr['fecha_pago1']);                      // Fecha de la Cuenta por Pagar (PAGO 1)
	  $descripcion_cxp1 = addslashes($arr['descripcion_pago1']);          // Descripción de la Cuenta X Pagar(PAGO 1)
	  $monto_cxp2 = $arr['monto_total_pago2'];                            // Monto Total de la Cuenta por Pagar(PAGO 2).       
	  $fecha_cxp2 = addslashes($arr['fecha_pago2']);                      // Fecha de la Cuenta por Pagar (PAGO 2)
	  $descripcion_cxp2 = addslashes($arr['descripcion_pago2']);          // Descripción de la Cuenta X Pagar(PAGO 2)
	  $monto_cxp3 = $arr['monto_total_pago3'];                            // Monto Total de la Cuenta por Pagar(PAGO 3).       
	  $fecha_cxp3 = addslashes($arr['fecha_pago3']);                      // Fecha de la Cuenta por Pagar (PAGO 3)
	  $descripcion_cxp3 = addslashes($arr['descripcion_pago3']);          // Descripción de la Cuenta X Pagar(PAGO 3)
	  $monto_cxp4 = $arr['monto_total_pago4'];                            // Monto Total de la Cuenta por Pagar(PAGO 4).       
	  $fecha_cxp4 = addslashes($arr['fecha_pago4']);                      // Fecha de la Cuenta por Pagar (PAGO 4)
	  $descripcion_cxp4 = addslashes($arr['descripcion_pago4']);          // Descripción de la Cuenta X Pagar(PAGO 4)
	  $monto_cxp5 = $arr['monto_total_pago5'];                            // Monto Total de la Cuenta por Pagar(PAGO 5).       
	  $fecha_cxp5 = addslashes($arr['fecha_pago5']);                      // Fecha de la Cuenta por Pagar (PAGO 5)
	  $descripcion_cxp5 = addslashes($arr['descripcion_pago5']);          // Descripción de la Cuenta X Pagar(PAGO 5)
	  $monto_cxp6 = $arr['monto_total_pago6'];                            // Monto Total de la Cuenta por Pagar(PAGO 6).       
	  $fecha_cxp6 = addslashes($arr['fecha_pago6']);                      // Fecha de la Cuenta por Pagar (PAGO 6)
	  $descripcion_cxp6 = addslashes($arr['descripcion_pago6']);          // Descripción de la Cuenta X Pagar(PAGO 6)
	  $monto_cxp7 = $arr['monto_total_pago7'];                            // Monto Total de la Cuenta por Pagar(PAGO 7).       
	  $fecha_cxp7 = addslashes($arr['fecha_pago7']);                      // Fecha de la Cuenta por Pagar (PAGO 7)
	  $descripcion_cxp7 = addslashes($arr['descripcion_pago7']);          // Descripción de la Cuenta X Pagar(PAGO 7)
	  $monto_cxp8 = $arr['monto_total_pago8'];                            // Monto Total de la Cuenta por Pagar(PAGO 8).       
	  $fecha_cxp8 = addslashes($arr['fecha_pago8']);                      // Fecha de la Cuenta por Pagar (PAGO 8)
	  $descripcion_cxp8 = addslashes($arr['descripcion_pago8']);          // Descripción de la Cuenta X Pagar(PAGO 8)	
	  $monto_cxp9 = $arr['monto_total_pago9'];                            // Monto Total de la Cuenta por Pagar(PAGO 9).       
	  $fecha_cxp9 = addslashes($arr['fecha_pago9']);                      // Fecha de la Cuenta por Pagar (PAGO 9)
	  $descripcion_cxp9 = addslashes($arr['descripcion_pago9']);          // Descripción de la Cuenta X Pagar(PAGO 9)	  
	  $monto_cxp10 = $arr['monto_total_pago10'];                          // Monto Total de la Cuenta por Pagar(PAGO 10).       
      $fecha_cxp10 = addslashes($arr['fecha_pago10']);                    // Fecha de la Cuenta por Pagar (PAGO 10)
	  $descripcion_cxp10 = addslashes($arr['descripcion_pago10']);        // Descripción de la Cuenta X Pagar(PAGO 10)	  
	  	  
	  //01 SELECCIONO LOS CASOS DE ACUERDO A LA CANTIDAD DE PAGOS EN EL CRÉDITO.
	  switch($y)
	  {
		 case 1:  // 1 PAGO.
					
			 // Introduzco en la BD 1 pago en la CUENTAS X PAGAR.		
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );		
		 	 if ( $process_1_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 
					
		 break;
		 case 2:  // 2 PAGOS
					
			 // Introduzco en la BD. 2 pagos en las CUENTAS X PAGAR		
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );			
			 $process_2_pago = process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 );			
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 
						
		 break;
		 case 3:  // 3 PAGOS
					
			 // Introduzco en la BD. 3 pagos en las CUENTAS X PAGAR			
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );			
			 $process_2_pago = process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 );			
			 $process_3_pago = process_3_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp3, $descripcion_cxp3, $fecha_cxp3 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 		
						
		 break;
		 case 4:  // 4 PAGOS
					
			 // Introduzco en la BD. 4 pagos en las CUENTAS X PAGAR			
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );			
			 $process_2_pago = process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 );			
			 $process_3_pago = process_3_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp3, $descripcion_cxp3, $fecha_cxp3 );
			 $process_4_pago = process_4_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp4, $descripcion_cxp4, $fecha_cxp4 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" && $process_4_pago == "ok"  )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 				
						
		 break;
		 case 5:  // 5 PAGOS
					
			 // Introduzco en la BD. 5 pagos en las CUENTAS X PAGAR			
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );			
			 $process_2_pago = process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 );			
			 $process_3_pago = process_3_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp3, $descripcion_cxp3, $fecha_cxp3 );
			 $process_4_pago = process_4_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp4, $descripcion_cxp4, $fecha_cxp4 );
			 $process_5_pago = process_5_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp5, $descripcion_cxp5, $fecha_cxp5 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" && $process_4_pago == "ok" && $process_5_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 					
								
		 break; 
		 case 6:  // 6 PAGOS
					
			 // Introduzco en la BD. 6 pagos en las CUENTAS X PAGAR			
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );			
			 $process_2_pago = process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 );			
			 $process_3_pago = process_3_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp3, $descripcion_cxp3, $fecha_cxp3 );
			 $process_4_pago = process_4_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp4, $descripcion_cxp4, $fecha_cxp4 );
			 $process_5_pago = process_5_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp5, $descripcion_cxp5, $fecha_cxp5 );
			 $process_6_pago = process_6_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp6, $descripcion_cxp6, $fecha_cxp6 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" && $process_4_pago == "ok" && $process_5_pago == "ok" && $process_6_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 					
								
		 break; 
		 case 7:  // 7 PAGOS
					
			 // Introduzco en la BD. 7 pagos en las CUENTAS X PAGAR			
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );			
			 $process_2_pago = process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 );			
			 $process_3_pago = process_3_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp3, $descripcion_cxp3, $fecha_cxp3 );
			 $process_4_pago = process_4_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp4, $descripcion_cxp4, $fecha_cxp4 );
			 $process_5_pago = process_5_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp5, $descripcion_cxp5, $fecha_cxp5 );
			 $process_6_pago = process_6_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp6, $descripcion_cxp6, $fecha_cxp6 );
			 $process_7_pago = process_7_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp7, $descripcion_cxp7, $fecha_cxp7 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" && $process_4_pago == "ok" && $process_5_pago == "ok" && $process_6_pago == "ok" && $process_7_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 					
								
		 break;
		 case 8:  // 8 PAGOS
					
			 // Introduzco en la BD. 8 pagos en las CUENTAS X PAGAR			
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );			
			 $process_2_pago = process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 );			
			 $process_3_pago = process_3_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp3, $descripcion_cxp3, $fecha_cxp3 );
			 $process_4_pago = process_4_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp4, $descripcion_cxp4, $fecha_cxp4 );
			 $process_5_pago = process_5_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp5, $descripcion_cxp5, $fecha_cxp5 );
			 $process_6_pago = process_6_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp6, $descripcion_cxp6, $fecha_cxp6 );
			 $process_7_pago = process_7_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp7, $descripcion_cxp7, $fecha_cxp7 );
			 $process_8_pago = process_8_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp8, $descripcion_cxp8, $fecha_cxp8 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" && $process_4_pago == "ok" && $process_5_pago == "ok" && $process_6_pago == "ok" && $process_7_pago == "ok" && $process_8_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 					
								
		 break;  
		 case 9:  // 9 PAGOS
					
			 // Introduzco en la BD. 9 pagos en las CUENTAS X PAGAR			
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );			
			 $process_2_pago = process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 );			
			 $process_3_pago = process_3_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp3, $descripcion_cxp3, $fecha_cxp3 );
			 $process_4_pago = process_4_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp4, $descripcion_cxp4, $fecha_cxp4 );
			 $process_5_pago = process_5_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp5, $descripcion_cxp5, $fecha_cxp5 );
			 $process_6_pago = process_6_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp6, $descripcion_cxp6, $fecha_cxp6 );
			 $process_7_pago = process_7_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp7, $descripcion_cxp7, $fecha_cxp7 );
			 $process_8_pago = process_8_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp8, $descripcion_cxp8, $fecha_cxp8 );
			 $process_9_pago = process_9_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp9, $descripcion_cxp9, $fecha_cxp9 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" && $process_4_pago == "ok" && $process_5_pago == "ok" && $process_6_pago == "ok" && $process_7_pago == "ok" && $process_8_pago == "ok" && $process_9_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 					
								
		 break; 
		 case 10:  // 10 PAGOS
					
			 // Introduzco en la BD. 10 pagos en las CUENTAS X PAGAR			
			 $process_1_pago = process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 );			
			 $process_2_pago = process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 );			
			 $process_3_pago = process_3_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp3, $descripcion_cxp3, $fecha_cxp3 );
			 $process_4_pago = process_4_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp4, $descripcion_cxp4, $fecha_cxp4 );
			 $process_5_pago = process_5_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp5, $descripcion_cxp5, $fecha_cxp5 );
			 $process_6_pago = process_6_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp6, $descripcion_cxp6, $fecha_cxp6 );
			 $process_7_pago = process_7_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp7, $descripcion_cxp7, $fecha_cxp7 );
			 $process_8_pago = process_8_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp8, $descripcion_cxp8, $fecha_cxp8 );
			 $process_9_pago = process_9_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp9, $descripcion_cxp9, $fecha_cxp9 );
			 $process_10_pago = process_10_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp10, $descripcion_cxp10, $fecha_cxp10 );
			 if ( $process_1_pago == "ok" && $process_2_pago == "ok" && $process_3_pago == "ok" && $process_4_pago == "ok" && $process_5_pago == "ok" && $process_6_pago == "ok" && $process_7_pago == "ok" && $process_8_pago == "ok" && $process_9_pago == "ok" && $process_10_pago == "ok" )  {
			     // Se insertó bien en la tabla cuentas_x_pagar
				 return "ok";	 
			 } 					
								
		 break;  
							 
	  }  // Fin del switch($y)
    
  }  // Fin de la función process_num_pagos($a, $arr)
    
//12 (private) 
  function process_1_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp1, $descripcion_cxp1, $fecha_cxp1 ) 
  {
	  //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 1.
  
      //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
      $query12 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp1."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp1."', '".$monto_cxp1."', '0', '".$monto_cxp1."', 0 )";
      $query12 = mysql_query($query12);
	  $num_rows_query12 = mysql_affected_rows();
	  if ( $num_rows_query12 > 0 ) {
		  // Se insertaron correctamente los datos en la BD.
		  return "ok";
		  
	  } else { echo mysql_error(); } 
     
  } // Fin de la función process_1_pago($a,$b,$c,$d,$d,$e) 
    
//13 (private)
  function process_2_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp2, $descripcion_cxp2, $fecha_cxp2 )
  {
	 //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 2.  
	
	 //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
     $query13 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp2."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp2."', '".$monto_cxp2."', '0', '".$monto_cxp2."', 0 )";
     $query13 = mysql_query($query13);
	 $num_rows_query13 = mysql_affected_rows();
	 if ( $num_rows_query13 > 0 ) {
		 // Se insertaron correctamente los datos en la BD.
		 return "ok";
		  
	 } else { echo mysql_error(); } 
  	  
  }  // Fin de la función process_2_pago($a,$b,$c,$d,$e,$f)
  
//14 (private)
  function process_3_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp3, $descripcion_cxp3, $fecha_cxp3 )
  {
	 //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 3.  
	
	 //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
     $query14 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp3."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp3."', '".$monto_cxp3."', '0', '".$monto_cxp3."', 0 )";
     $query14 = mysql_query($query14);
	 $num_rows_query14 = mysql_affected_rows();
	 if ( $num_rows_query14 > 0 ) {
		 // Se insertaron correctamente los datos en la BD.
		 return "ok";
		  
	 } else { echo mysql_error(); } 
  	  
  }  // Fin de la función process_3_pago($a,$b,$c,$d,$e,$f)
  
//15 (private)
  function process_4_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp4, $descripcion_cxp4, $fecha_cxp4 )
  {
	 //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 4.  
	
	 //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
     $query15 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp4."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp4."', '".$monto_cxp4."', '0', '".$monto_cxp4."', 0 )";
     $query15 = mysql_query($query15);
	 $num_rows_query15 = mysql_affected_rows();
	 if ( $num_rows_query15 > 0 ) {
		 // Se insertaron correctamente los datos en la BD.
		 return "ok";
		  
	 } else { echo mysql_error(); } 
  	  
  }  // Fin de la función process_4_pago($a,$b,$c,$d,$e,$f)
    
//16 (private)
  function process_5_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp5, $descripcion_cxp5, $fecha_cxp5 )
  {
	 //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 5.  
	
	 //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
     $query16 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp5."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp5."', '".$monto_cxp5."', '0', '".$monto_cxp5."', 0 )";
     $query16 = mysql_query($query16);
	 $num_rows_query16 = mysql_affected_rows();
	 if ( $num_rows_query16 > 0 ) {
		 // Se insertaron correctamente los datos en la BD.
		 return "ok";
		  
	 } else { echo mysql_error(); } 
  	  
  }  // Fin de la función process_5_pago($a,$b,$c,$d,$e,$f)
  
//17 (private)
  function process_6_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp6, $descripcion_cxp6, $fecha_cxp6 )
  {
	 //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 6.  
	
	 //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
     $query17 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp6."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp6."', '".$monto_cxp6."', '0', '".$monto_cxp6."', 0 )";
     $query17 = mysql_query($query17);
	 $num_rows_query17 = mysql_affected_rows();
	 if ( $num_rows_query17 > 0 ) {
		 // Se insertaron correctamente los datos en la BD.
		 return "ok";
		  
	 } else { echo mysql_error(); } 
  	  
  }  // Fin de la función process_6_pago($a,$b,$c,$d,$e,$f)  
  
//18 (private)
  function process_7_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp7, $descripcion_cxp7, $fecha_cxp7 )
  {
	 //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 7.  
	
	 //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
     $query18 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp7."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp7."', '".$monto_cxp7."', '0', '".$monto_cxp7."', 0 )";
     $query18 = mysql_query($query18);
	 $num_rows_query18 = mysql_affected_rows();
	 if ( $num_rows_query18 > 0 ) {
		 // Se insertaron correctamente los datos en la BD.
		 return "ok";
		  
	 } else { echo mysql_error(); } 
  	  
  }  // Fin de la función process_7_pago($a,$b,$c,$d,$e,$f)

//19 (private)
  function process_8_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp8, $descripcion_cxp8, $fecha_cxp8 )
  {
	 //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 8.  
	
	 //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
     $query19 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp8."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp8."', '".$monto_cxp8."', '0', '".$monto_cxp8."', 0 )";
     $query19 = mysql_query($query19);
	 $num_rows_query19 = mysql_affected_rows();
	 if ( $num_rows_query19 > 0 ) {
		 // Se insertaron correctamente los datos en la BD.
		 return "ok";
		  
	 } else { echo mysql_error(); } 
  	  
  }  // Fin de la función process_8_pago($a,$b,$c,$d,$e,$f)
  
//20 (private)
  function process_9_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp9, $descripcion_cxp9, $fecha_cxp9 )
  {
	 //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 9.  
	
	 //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
     $query20 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp9."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp9."', '".$monto_cxp9."', '0', '".$monto_cxp9."', 0 )";
     $query20 = mysql_query($query20);
	 $num_rows_query20 = mysql_affected_rows();
	 if ( $num_rows_query20 > 0 ) {
		 // Se insertaron correctamente los datos en la BD.
		 return "ok";
		  
	 } else { echo mysql_error(); } 
  	  
  }  // Fin de la función process_9_pago($a,$b,$c,$d,$e,$f)        
   
//21 (private)
  function process_10_pago($fecha, $id_proveedor_compra, $no_orden_de_compra, $monto_cxp10, $descripcion_cxp10, $fecha_cxp10 )
  {
	 //  Función que procesa la entrada del crédito a las cuentas x pagar para el PAGO 10.  
	
	 //01 INSERTO LOS VALORES DE LOS DATOS EN LA TABLA DE CUANTAS POR PAGAR.
     $query21 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, no_orden_de_compra, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha."', '".$fecha_cxp10."', '".$no_orden_de_compra."', '".$id_proveedor_compra."', '".$descripcion_cxp10."', '".$monto_cxp10."', '0', '".$monto_cxp10."', 0 )";
     $query21 = mysql_query($query21);
	 $num_rows_query21 = mysql_affected_rows();
	 if ( $num_rows_query21 > 0 ) {
		 // Se insertaron correctamente los datos en la BD.
		 return "ok";
		  
	 } else { echo mysql_error(); } 
  	  
  }  // Fin de la función process_10_pago($a,$b,$c,$d,$e,$f)        
      
//22 
  function charge_compras($id_proveedor) 
  {
	  // Función que carga los datos de todas las compras para mostrar en la vista principal.
  
      if ( $id_proveedor == 0 )  {
	      // CASO 1: Muestra todos los registros. 
		  $queryz = "SELECT registro_compras.id, registro_compras.numero_compra, registro_compras.fecha_compra, proveedores_clientes.nombre,  registro_compras.numero_factura, registro_compras.cantidad_articulos, registro_compras.forma_de_pago, registro_compras.monto_de_la_compra, registro_compras.descuento, registro_compras.valor_pagado_real, registro_compras.usuario FROM registro_compras, proveedores_clientes WHERE registro_compras.test='1' AND registro_compras.id_proveedor_compra=proveedores_clientes.id ORDER BY registro_compras.id DESC";
	  } else if ( $id_proveedor < 0 )  {
	      // CASO 2: Muestra sólo los registros correspondientes a las compras entre 2 fechas determinadas.
	      
		  if ( isset($_POST['fecha_inicial']) && isset($_POST['fecha_final']) )  {
			  // Esto es para el reporte de Resumen de Compras del módulo Compras.     
              $fecha_inicial_rep = addslashes($_POST['fecha_inicial']);
			  $fecha_final_rep   = addslashes($_POST['fecha_final']);		  
		  } else if ( isset($_GET['fi']) && isset($_GET['ff']) )  {
			  // Esto es para la vista de impresión del Reporte de Resumen de Compras.
			  $fecha_inicial_rep = addslashes($_GET['fi']);
			  $fecha_final_rep   = addslashes($_GET['ff']);	 
		  }
		    
		  $queryz = "SELECT registro_compras.id, registro_compras.numero_compra, registro_compras.fecha_compra, proveedores_clientes.nombre,  registro_compras.numero_factura, registro_compras.cantidad_articulos, registro_compras.forma_de_pago, registro_compras.monto_de_la_compra, registro_compras.descuento, registro_compras.valor_pagado_real, registro_compras.usuario FROM registro_compras, proveedores_clientes WHERE registro_compras.fecha_compra BETWEEN '".$fecha_inicial_rep."' AND '".$fecha_final_rep."' AND   registro_compras.test='1' AND registro_compras.id_proveedor_compra=proveedores_clientes.id ORDER BY registro_compras.id DESC";
	  } else {
		  // CASO 3: Muestra sólo los registros correspondientes a un Proveedor en particular.
	      $queryz = "SELECT registro_compras.id, registro_compras.numero_compra, registro_compras.fecha_compra, proveedores_clientes.nombre,  registro_compras.numero_factura, registro_compras.cantidad_articulos, registro_compras.forma_de_pago, registro_compras.monto_de_la_compra, registro_compras.descuento, registro_compras.valor_pagado_real, registro_compras.usuario FROM registro_compras, proveedores_clientes WHERE registro_compras.test='1' AND registro_compras.id_proveedor_compra='".$id_proveedor."' AND registro_compras.id_proveedor_compra=proveedores_clientes.id ORDER BY registro_compras.id DESC";
	  } 
	    
	  $queryz = mysql_query($queryz);
	  $num_rows_queryz = mysql_num_rows($queryz);
	  if ( $num_rows_queryz > 0 )  {
		  // Hay compras registradas en la BD.
		  for ( $i=0; $i < $num_rows_queryz; $i++ )
		  {
		       
			   $registro_compras[$i] = mysql_fetch_assoc($queryz);
		    
		  }
		  
		  return $registro_compras;
		    
	  } else {
		  // No hay compras registradas en la BD.
		  return "vacio"; 
	  }
   
  }  // Fin de la función charge_compras()
   
//18 
   function resumen_compras($fecha_final,$fecha_inicial)
   {
	   // Función que muestra el resumen de compras entre dos fechas determinadas. 
        		   
	   $query18 = "SELECT * FROM ventasalmacen_".$_POST['local_resventas']." WHERE fecha_venta BETWEEN '".addslashes($_POST['fecha_inicial'])."' AND '".addslashes($_POST['fecha_final'])."'";
	       
		   
		   
		   
		   
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
		     
       
        
   }   // Fin de la función resumen_compras()  
  
  
  /*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_compras  *****/
  
  if ( isset($_GET['data']) && $_GET['data'] == "contado1" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CONTADO -> Origen del Pago -> Banco ó Caja.
	  process_contado1();
  } else if ( isset($_GET['data']) && $_GET['data'] == "contado2" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CONTADO -> Origen del Pago -> Banco y Caja.
	  process_contado2();
  } else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pago1" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pago=1
	  process_creditoentradaXpagosY(0, 1);
  } else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pagos2" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pagos=2
	  process_creditoentradaXpagosY(0, 2);
  } else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pagos3" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pagos=3
	  process_creditoentradaXpagosY(0, 3);
  } else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pagos4" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pagos=4
	  process_creditoentradaXpagosY(0, 4);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada0pagos5" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada=0 -> Cant. Pagos=5
	  process_creditoentradaXpagosY(0, 5);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pago1" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!= 0 -> Cant. Pagos=1
	  process_creditoentradaXpagosY(1, 1);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos2" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=2
	  process_creditoentradaXpagosY(1, 2);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos3" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=3
	  process_creditoentradaXpagosY(1, 3);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos4" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=4
	  process_creditoentradaXpagosY(1, 4);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos5" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=5
	  process_creditoentradaXpagosY(1, 5);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos6" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=6
	  process_creditoentradaXpagosY(1, 6);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos7" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=7
	  process_creditoentradaXpagosY(1, 7);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos8" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=8
	  process_creditoentradaXpagosY(1, 8);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos9" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=9
	  process_creditoentradaXpagosY(1, 9);
  }  else if ( isset($_GET['data']) && $_GET['data'] == "creditoentrada1pagos10" )   {
	  // Esto es para procesar los datos cuando en la Nueva Compra se selecciona: CRÉDITO -> Valor de Entrada!=0 -> Cant. Pagos=10
	  process_creditoentradaXpagosY(1, 10);
  }  
  
?>