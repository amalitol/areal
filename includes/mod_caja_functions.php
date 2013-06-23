<?php
@session_start();

include_once('connection.php');

/****** ((00)) VARIABLES  *****/ #tabs-2
/************************
 Primer nivel:   Refieren al módulo en cuestion 
              mod=mod_caja 
/************************
 Segundo nivel:  Refieren a los elementos del menu superior        
             (1) optioncaja=new_in                                     
			 (2) optioncaja=otras_cajas                                           
		 
/************************
  Tercer nivel(I):  Refieren a los elementos que voy a mostrar dentro de un elemento del menu superior				 
          De (1) ttype= (ok) <- Envia mensaje de ok cuando la transacción se hizo con éxito.
          De (2) cajant= (ver)  --> No lleva header... <-- Ver reporte de Cajas Anteriores
	  
/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_caja   *****/

//01 show_cajas_locales() --> Función que carga todas las cajas chicas de los locales de la BD. Idem a show_locales() del módulo INVENTARIO.   
//02 process_new_transaccion()   --> Función que procesa el formulario para hacer una nueva TRANSACCIÓN.
//03 (private) salida_caja_central($a,$b) -> Función que introduce la transacciónd e SALIDA en la tabla cajacentral_1.
//04 (private) entrada_caja_pendientes($a)-> Function que introduce los datos de la ENTRADA de la transacción en PENDIENTES en la CAJA del ALMACÉN seleccionado. 	
//05 (private) salida_caja_almacen($a, $b)-> Función que inserta y actualiza los datos de la SALIDA de efectivo de la Caja del ALMACÉN seleccionado.
//06 show_ingresos_de_caja_pendientes() -> Función que muestra el efectivo pendiente de entrada en cada caja del sistema.  
//07 process_efectivo_pendiente() -> Función que procesa cuando voy a añadir efectivo pendiente a la caja seleccionada.
//08 show_transacciones_caja()  -> Función que muestra las transacciones que han habido en la caja el día de HOY.
//09 show_resumen_caja() -> Función que muestra todos lo relacionado con los datos del RESUMEN DE CAJA DEL DÍA.
//10 (private) entrada_registro_bancario($a) -> Función  que introduce el registro de la transacción en la tabla registro_bancario. 
//11 process_caja_anterior() -> Función que procesa el REPORTE solicitado para ver los datos de la caja entre 2 fechas seleccionadas.
//12 search_data_caja_anterior () -> Función que resume y muestra los datos de la consulta de //11.
//13 show_ingresos_de_caja_pendientes_reporte() -> Función que muestra el efectivo pendiente de entrada en cada caja del sistema pero como una CONSULTA. de CAJA -> Ver Cajas Anteriores  


/***((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_caja  *****/

/************************************************************************************************************/


/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_caja  *****/
//01 
  function show_cajas_locales() 
  {
	  // Función que carga todas las cajas chicas de los locales de la BD. Idem a show_locales() del módulo INVENTARIO. 
  
       //01 Selecciono todos los locales (BODEGA Y ALMACENES) que estén en la BD 
	  $query01 = "SELECT * FROM locales_inventarios ORDER BY id ASC";
	  $query01 = mysql_query($query01);
	  $num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  
		  // Esto significa que hay LOCALES en la tabla de BD y los guardo en un array para devolverlos
		  for ( $i=0; $i < $num_rows_query01; $i++ )
		  {
		      $registro_locales[$i] = mysql_fetch_assoc($query01);
		  }
	    
	  } else {
		 //02 Si no hay LOCALES devuelvo un valor nulo. 
		 return "null";
	  }
	  
	  //03 Si hay LOCALES en la base de datos devuelvo los registros de estos.  
	  return $registro_locales;  
     
  }  // Fin de la función show_cajas_locales()

//02 
  function process_new_transaccion()
  {
	  // Función que procesa el formulario para hacer una nueva TRANSACCIÓN.
  
      $nombre_completo = $_SESSION['nombre_completo'];
  
      //01 RECIBO LAS VARIABLES POST
      $arr = $_POST;
	  /******* VARIABLES QUE SE RECIBEN  ********/
	  $fecha_transaccion           = addslashes($_POST['fecha_transaccion']);
	  
	  $saldo_en_caja_hidden        = $_POST['saldo_en_caja_hidden'];     // CAMPO HIDDEN CON EL VALOR DEL SALDO DE LA CAJA EN EL ORIGEN.
	  $nombre_caja_local_origen    = $_POST['nombre_caja_local_origen']; // CAMPO HIDDEN CON EL VALOR DEL NOMBRE DE LA CAJA DEL LOCAL EN EL ORIGEN
	  $nombre_caja_local_destino   = $_POST['nombre_caja_local_destino'];// CAMPO HIDEN CON EL VALOR DEL NOMBRE DE LA CAJA DEL LOCAL EN EL DESTINO
	  
	  $origen_transaccion          = $_POST['origen_transaccion'];   // VALORES: seleccione, 1, 2, 3, 4, ....., otros
	  $destino_transaccion         = $_POST['destino_transaccion'];  // VALORES: seleccione, 1, 2, 3, 4, ....., otros
	  
	  $cantidad_transaccion        = addslashes($_POST['cantidad_transaccion']);
      $observaciones_transaccion   = addslashes($_POST['observaciones_transaccion']);
	     
      //02 INTRODUZCO LOS VALORES DE LA TRANSACCIÓN EN CADA UNA DA LA TABLAS 
	    /*  I)   INSERT una transacción de Salida en la tabla ORIGEN.
		            CASO Caja Central => function salida_caja_central();  
			II)  INSERT una transacción de Entrada en la tabla DESTINO.
		    III) UPDATE la Caja en la tabla de stock como una Salida (ORIGEN).
		    IV)  UPDATE el stock en la tabla de stock como una Entrada (DESTINO).
		 */   
  
      //02.1 HAGO UN SWITCH PARA SABER EL SALDO DE LA CAJA EN SU RESPECTIVO LOCAL EN EL ORIGEN.
      switch($origen_transaccion)
	  {
		  case "1":
		  // CASO DE QUE EL ORIGEN SEA LA BODEGA
			      
		  // Llamo a esta función que me introduce los datos de la transacción de SALIDA en la TABLA CAJA(cajacentral_1).
		  $salida_caja_central = salida_caja_central($arr, $nombre_completo); 	 
	     
		  if ( $salida_caja_central == "true" )  {
		     // Esto significa que se insertaron bien los DATOS EN LA TABLA.   
		     /************************************************************************************************
						    Ahora busco insertar los datos en la tabla de DESTINO 
			  ***********************************************************************************************
			  HAGO UN SWITCH PARA VER LAS POSIBLES OPCIONES DE TRANSACCIÓN EN SU RESPECTIVA CAJA EN EL LOCAL DESTINO */
	          switch($destino_transaccion)
			  {
			       case "1":
			       //A) CASO DE QUE EL DESTINO SEA LA CAJA DE LA BODEGA ( BODEGA -> BODEGA no puede ser )
			       /******** ESTO NO PUEDE SUCEDER *******/
		           break;
			       case "otros":
			       //B) CASO DE QUE EL DESTINO NO SEA NINGUNA CAJA DEL NEGOCIO.
			       /******** AQUÍ NO SUCEDE NADA PUES EL MOVIMIENTO ES HACIA UN LUGAR QUE NO ESTÁ EN EL NEGOCIO *****/
						header('Location: ../index.php?mod=mod_caja&ttype=ok#tabs-2'); 
				   break;
			       //C) CASO DE QUE EL DESTINO SEA UN DEPÓSITO BANCARIO.
				   /******** EN ESTE CASO DEBO CREAR UN REGISTRO BANCARIO (crédito) EN LA TABLA registro_bancario ********/
				   case "banco":
				        $entrada_registro_bancario = entrada_registro_bancario($arr);
				        if ( $entrada_registro_bancario == "ok" )   {
						    // Esto significa que se insertaron correctamente los DATOS EN LA TABLA registro_bancario.	
					        header('Location: ../index.php?mod=mod_caja&ttype=ok#tabs-2');
						}
				   break;
				   default:
			       //D) CASO DE QUE EL DESTINO SEA UNA CAJA DE UN ALMACÉN
				        $entrada_caja_almacen = entrada_caja_pendientes($arr);
                        if ( $entrada_caja_almacen == "true" )  {
					        // Esto significa que se insertaron bien los DATOS EN LA TABLA.   
							header('Location: ../index.php?mod=mod_caja&ttype=ok#tabs-2'); 
														
						} 	// Fin del if ( $entrada_caja_almacen == "true" )  {					       
				   break;
			   }  // Fin del switch($destino_transaccion)
				  
		    }  // Fin del if ( $salida_caja_central == "true" )  {
				
		  break;  
		  case "otros":
			   // CASO DE QUE EL ORIGEN SEA ALGO NO PERTENECIENTE AL NEGOCIO ( switch($origen_transaccion) ) 
			   /*************************************************************************************************************
				                 EN ESTE CASO NO TENGO QUE HACER NINGUN MOVIMIENTO DE RETIRO DE CAJA 
			   *************************************************************************************************************/
			   // HAGO UN SWITCH PARA VER LAS POSIBLES OPCIONES DE INSERCIÓN DEL EFECTIVO EN SU RESPECTIVA CAJA DEL LOCAL EN EL DESTINO */
	           switch($destino_transaccion)
			   {
			        case "1":
	                //A) CASO DE QUE EL DESTINO SEA LA BODEGA 
			        /**************************************************************************************************************
					 COMO ES UN DINERO QUE VOY A DEPOSITAR QUE VIENE DIRECTAMENTE DE OTRO LUGAR FUERA DEL NEGOCIO, LO DEPOSITO EN LA TABLA 
					 DE PENDIENTES cajaefectivos_pendientes_de_entrada.   
					***************************************************************************************************************/
					    $entrada_caja_central = entrada_caja_pendientes($arr);
					    if ( $entrada_caja_central == "true" )  {
					        // Esto significa que se insertaron bien los DATOS EN LA TABLA PENDIENTES.   
					        header('Location: ../index.php?mod=mod_caja&ttype=ok#tabs-2'); 
							 	
				        }
					   				   
					break;
					case "otros":
			        //B) CASO DE QUE EL DESTINO SEA OTRA CAJA NO PERTENECIENTE AL NEGOCIO ( OTROS -> OTROS no puede ser )
			        /******** ESTO NO PUEDE SUCEDER  *****/
					         
					break;
					default:
			        //C) CASO DE QUE EL DESTINO SEA UN ALMACÉN
					    $entrada_caja_almacen = entrada_caja_pendientes($arr);
                        if ( $entrada_caja_almacen == "true" )  {
						   // Esto significa que se insertaron bien los DATOS EN LA TABLA.   
						   header('Location: ../index.php?mod=mod_caja&ttype=ok#tabs-2'); 
														
						} 	// Fin del if ( $entrada_caja_almacen == "true" )  {			
			        break;
				} // Fin del switch($destino_transaccion)
			   
			break;
	        default:
			     // CASO DE QUE EL ORIGEN SEA UN ALMACÉN  ( switch($origen_transaccion) )
			     // Llamo a esta función que introduce los datos de Retiro de Caja en la TABLA cajaalmacen_$id
				 $salida_caja_almacen = salida_caja_almacen($arr, $nombre_completo); 
				 if ( $salida_caja_almacen == "true" )  {
					 // Esto significa que se insertaron bien los DATOS EN LA TABLA.   
				     /************************************************************************************************
						          Ahora busco insertar los datos en las tabla de DESTINO 
					 ***********************************************************************************************
					 HAGO UN SWITCH PARA VER LAS POSIBLES OPCIONES DE INSERCIÓN DE LA TRANSACCIÓN EN LA RESPECTIVA CAJA DEL LOCAL EN EL DESTINO */
	                 switch($destino_transaccion)
				     {
			            case "1":
	                       //A) CASO DE QUE EL DESTINO SEA LA BODEGA 
			               $entrada_caja_bodega = entrada_caja_pendientes($arr);
					       if ( $entrada_caja_bodega == "true" )  {
							   // Esto significa que se insertaron bien los DATOS EN LAS 2 TABLAS.   
							   header('Location: ../index.php?mod=mod_caja&ttype=ok#tabs-2'); 
							 	
						   }
					   				   
					   break;
				       case "otros":
			                //B) CASO DE QUE EL DESTINO SEA OTRO LUGAR NO PERTENECIENTE AL NEGOCIO 
			                /******** AQUÍ NO SUCEDE NADA PUES EL MOVIMIENTO ES HACIA UN LUGAR QUE NO ESTÁ EN EL NEGOCIO *****/
					        header('Location: ../index.php?mod=mod_caja&ttype=ok#tabs-2');  
					   break;
				       default:
			               //C) CASO DE QUE EL DESTINO SEA UN ALMACÉN
					       $entrada_caja_almacen = entrada_caja_pendientes($arr);
                           if ( $entrada_caja_almacen == "true" )  {
							   // Esto significa que se insertaron bien los DATOS EN LA TABLA PENDIENTES.   
							   header('Location: ../index.php?mod=mod_caja&ttype=ok#tabs-2');  
														
						   } 	// Fin del if ( $entrada_caja_almacen == "true" )  {			
			           break;
					 }   // Fin del switch($destino_transaccion)
				   
				  }   // Fin del if ( $salida_caja_almacen == "true" )  {
			 break;
					 
	 }  // Fin del switch($origen_transaccion)
  
  
  
  
  
  
  }  // Fin de la función  process_new_transaccion()

//03 (private) 
  function salida_caja_central($arr,$nombre_completo) 
  {
	  // Función que introduce la transacción de SALIDA en la tabla cajacentral_1 	
  
      // RECIBO LAS VARIABLES $_POST y las llevo a float para hacer las operaciones.
	  $saldo_en_caja_hidden  = addslashes($arr['saldo_en_caja_hidden']);
	  settype($saldo_en_caja_hidden, "float");     // saldo de la tabla cajacentral_1 (de la BD)
    	  
	  $cantidad_transaccion  = addslashes($arr['cantidad_transaccion']);
	  settype($cantidad_transaccion, "float");     // Cantidad de efectivo a MOVER
				   
	  $saldo_origen_final = $saldo_en_caja_hidden - $cantidad_transaccion;  // Esto es saldo final en la CAJA CENTRAL en el ORIGEN
		
	  // I) INSERT un Retiro de Caja en la tabla ORIGEN. 		   
	  $query3 = "INSERT INTO cajacentral_".$arr['origen_transaccion']." ( fecha_transaccion, tipo_transaccion, origen_transaccion, destino_transaccion, cantidad_transaccion, observaciones, persona_q_hace_transaccion, recibido, saldo ) VALUES ( '".addslashes($arr['fecha_transaccion'])."', 'Retiro de Caja', '', '".addslashes($arr['nombre_caja_local_destino'])."', '".addslashes($arr['cantidad_transaccion'])."', '".addslashes($arr['observaciones_transaccion'])."', '".$nombre_completo."', 1, '".$saldo_origen_final."' )";
	 $query3 = mysql_query($query3);
	 $num_rows_query3 = mysql_affected_rows();
	 if ( $num_rows_query3 > 0 )  {
		 // Esto significa que se insertó correctamente la fila en la BD.
		 return "true";
		    
	 } else { echo mysql_error(); }   // Error de inserción en la BD.
 
  
  }   // Fin de la función salida_caja_central($a, $b)
   
//04 (private) 
  function entrada_caja_pendientes($arr)
  {
	  // Function que introduce los datos de la ENTRADA de la transacción en PENDIENTES en la CAJA del ALMACÉN seleccionado.
  
      // II)  INSERT una transacción de Entrada en la tabla pendientes (DESTINO). 
	  $query4 = "INSERT INTO cajaefectivos_pendientes_de_entrada ( id_local, fecha_transaccion, nombre_caja_local_origen, cantidad_transaccion, observaciones_transaccion, recibido ) VALUES('".$arr['destino_transaccion']."', '".addslashes($arr['fecha_transaccion'])."', '".addslashes($arr['nombre_caja_local_origen'])."', ".addslashes($arr['cantidad_transaccion']).", '".addslashes($arr['observaciones_transaccion'])."', 0)"; 
	  $query4 = mysql_query($query4);
	  $num_rows_query4 = mysql_affected_rows();
	  if ( $num_rows_query4 > 0 )  {
	   	  // Esto significa que se insertó correctamente la fila en la TABLA cajaefectivos_pendientes_de_entrada   
          return "true";
	  } else { echo mysql_error(); }   // fin del if ( $num_rows_query4 > 0 )  {
   
  }   // Fin de la función entrada_caja_pendientes($a)

//05 (private) 
  function salida_caja_almacen($arr, $nombre_completo)
  {
	  // Función que inserta y actualiza los datos de la SALIDA de efectivo de la Caja del ALMACÉN seleccionado.
  
      // RECIBO LAS VARIABLES $_POST y las llevo a float para hacer las operaciones.
	  $saldo_en_caja_hidden  = addslashes($arr['saldo_en_caja_hidden']);
	  settype($saldo_en_caja_hidden, "float");     // saldo de la tabla cajaalmacen_(id) (de la BD)
    	  
	  $cantidad_transaccion  = addslashes($arr['cantidad_transaccion']);
	  settype($cantidad_transaccion, "float");     // Cantidad de efectivo a MOVER
				   
	  $saldo_origen_final = $saldo_en_caja_hidden - $cantidad_transaccion;  // Esto es saldo final en la CAJA CENTRAL en el ORIGEN
	  
	     
	   	   
	   // I) INSERT un movimiento de Salida en la tabla ORIGEN. 
	   $query5 = "INSERT INTO cajaalmacen_".$arr['origen_transaccion']." ( fecha_transaccion, tipo_transaccion, origen_transaccion, destino_transaccion, cantidad_transaccion, observaciones, persona_q_hace_transaccion, recibido, saldo ) VALUES( '".addslashes($arr['fecha_transaccion'])."', 'Retiro de Caja', '', '".addslashes($arr['nombre_caja_local_destino'])."', '".addslashes($arr['cantidad_transaccion'])."', '".addslashes($arr['observaciones_transaccion'])."', '".$nombre_completo."', 1, '".$saldo_origen_final."' )";
	   $query5 = mysql_query($query5); 
	   $num_rows_query5 = mysql_affected_rows();
	   if ( $num_rows_query5 > 0 )  {
		   // Esto significa que se insertó correctamente la fila en la BD   
		   return "true";					 
		
	   } else { echo mysql_error(); }  //  Fin del if ( $num_rows_query5 > 0 )  {	          
  
  }  // Fin de la función salida_caja_almacen($a,$b)

//06 
  function show_ingresos_de_caja_pendientes($local) 
  {
	  // Función que muestra el efectivo pendiente de entrada en cada caja del sistema.  
      switch($local)
	  {
		  case 0:  // <- Esto es cuando quiero ver la caja de acuerdo al usuario (a ó v) y tipo de local(1,2,3..) DEFAULT
	        $id_local = $_SESSION['id_local'];
		  break;
		  default: // <- Esto es cuando el Administrador quiere ver la caja de un local determinado de acuerdo a su id_local
		    $id_local = $local;
		  break;
	  } // Fin del switch()
	    
	  //01 BUSCO LOS PENDIENTES DE ACUERDO AL VALOR DE LAS VARIABLES $_SESSION['tipo_usuario'](a ó v) y $_SESSION['id_local'](1, 2, 3...)
      $query6 = "SELECT * FROM cajaefectivos_pendientes_de_entrada WHERE recibido=0 AND id_local='".$id_local."'";
	  $query6 = mysql_query($query6);
	  $num_rows_query6 = mysql_num_rows($query6);
	  if ( $num_rows_query6 > 0 )  {
		  // Esto significa que hay pendientes por entrar a la caja del local seleccionado.  
		  for ( $i=0; $i < $num_rows_query6; $i++ )
		  {
			 $resultado[$i] = mysql_fetch_assoc($query6);    
		  }
	      return $resultado;
	  } else {
		  // Esto significa que no hay ningun pendiente de entrada en ese LOCAL.
		  return "null";
	  }
  }  // Función show_ingresos_de_caja_pendientes()

//07  
  function process_efectivo_pendiente()
  {
	  // Función que procesa cuando voy a añadir efectivo pendiente a la caja seleccionada.
  
      $contador = 0;   // contador para almacenar todas los movimientos insertados correctamente.
	  $fecha = gmdate('Y-m-d', time() - 18000 );
	   
	  //01 Recibo las variables $_POST
	  $arr = $_POST;
      
	  //02 Selecciono el id_local para saber si en cual local estoy trabajando.
	  	  
	  $local_stock = $arr['id_local_stock'];  // Número del local que voy a hacer el ENTRADA de artículos. 
       
	  //03 Hago un switch de acuerdo a si la entrada será en la BODEGA o algún ALMACÉN
      switch($local_stock)
	   {
		  case "1":
		       // CASO CAJA CENTRAL (BODEGA)
		       /******* BUSCO TODOS LOS id DE PENDIENTES DE ENTRADA DE ACUERDO A LAS VARIABLES $_POST********/
			   foreach($_POST as $key => $value)
	           {
                  if( substr($key,0,12) == "id_pendiente" ) {
			         // Con esto tengo el id del efectivo PENDIENTE de la TABLA cajaefectivos_pendientes_de_entrada que voy a ingresar en CAJA. 
				      
					 $id_pendiente = substr($key,12);    // Esto es 1, 2, 3....(id)
					 settype($id_pendiente, "integer");  //a) tengo el id convertido en int.
				     
					 // PASO 1: pongo valor 1 en el recibido de la TABLA cajaefectivos_pendientes_de_entrada 
					 $query70 = "UPDATE cajaefectivos_pendientes_de_entrada SET recibido=1 WHERE id=".$id_pendiente.""; 
					 $query70 = mysql_query($query70);
					 $num_rows_query70 = mysql_affected_rows();
					 if ( $num_rows_query70 > 0 )  {
				         // PASO 2: select todos los campos que necesito para hacer el INSERT del INGRESO DE CAJA.
					     $query701 = "SELECT * FROM cajaefectivos_pendientes_de_entrada WHERE id='".$id_pendiente."'";
						 $query701 = mysql_query($query701);
						 $num_rows_query701 = mysql_num_rows($query701);
						 if ( $num_rows_query701 > 0 )  {
							// Guardo los valores de los DATOS.
							$ingreso_de_caja = mysql_fetch_assoc($query701);
							// PASO 3: INSERT en la tabla cajacentral_(id) el INGRESO DE EFECTIVO A LA CAJA
				            /***** AHORA BUSCO EL SALDO QUE EXISTE EN LA CAJA CENTRAL EN ESTOS MOMENTOS ***/
							$query702 = "SELECT saldo FROM cajacentral_1 ORDER BY id DESC LIMIT 1";
							$query702 = @mysql_query($query702) or die(mysql_error());
							$num_rows_query702 = mysql_num_rows($query702);
							if ( $num_rows_query702 == 1 )  {
								// Esto significa que hay algun registro en la BD.
						        $last_saldo = mysql_fetch_assoc($query702);
							    
								$old_saldo = $last_saldo['saldo'];
	                            settype($old_saldo, 'float');
	                            $efectivo_a_ingresar = $ingreso_de_caja['cantidad_transaccion'];
								settype($efectivo_a_ingresar, 'float');
								
								$new_saldo = $old_saldo + $efectivo_a_ingresar;
								
								$query7031 = "INSERT INTO cajacentral_1( fecha_transaccion, no_orden_de_compra, id_origen_pago_cxp, id_origen_cobro_cxc, tipo_transaccion, origen_transaccion, destino_transaccion, cantidad_transaccion, observaciones, persona_q_hace_transaccion, recibido, saldo ) VALUES ( '".$fecha."', '0', '0', '0', 'Ingreso de Caja', '".$ingreso_de_caja['nombre_caja_local_origen']."', '', '".$efectivo_a_ingresar."', '".$ingreso_de_caja['observaciones_transaccion']."', '".$_SESSION['nombre_completo']."', 1, '".$new_saldo."' )";
								$query7031 = mysql_query($query7031);
								$num_rows_query7031 = mysql_affected_rows();
								if ( $num_rows_query7031 > 0 )   {
									// Se insertó correctamente en la BD.
									/* ALMACENO EN UN CONTADOR  */
									$contador++;
									
							    } else { echo mysql_error(); }   // Fin del if ( $num_rows_query703 > 0 )  {
													
							} else { 
							    // Esto significa que no hay ningún registro en la BD. (TABLA VACÍA)
							    $old_saldo = 0;
							    $efectivo_a_ingresar = $ingreso_de_caja['cantidad_transaccion'];
								settype($efectivo_a_ingresar, 'float');
								
								$new_saldo = $old_saldo + $efectivo_a_ingresar;
								
								$query7032 = "INSERT INTO cajacentral_".$local_stock."( fecha_transaccion, no_orden_de_compra, id_origen_pago_cxp, id_origen_cobro_cxc, tipo_transaccion, origen_transaccion, destino_transaccion, cantidad_transaccion, observaciones, persona_q_hace_transaccion, recibido, saldo ) VALUES ( '".$fecha."', '0', '0', '0', 'Ingreso de Caja', '".$ingreso_de_caja['nombre_caja_local_origen']."', '', '".$efectivo_a_ingresar."', '".$ingreso_de_caja['observaciones_transaccion']."', '".$_SESSION['nombre_completo']."', 1, '".$new_saldo."' )";
								$query7032 = mysql_query($query7032);
								$num_rows_query7032 = mysql_affected_rows();
								if ( $num_rows_query7032 > 0 )   {
									// Se insertó correctamente en la BD.
									/* ALMACENO EN UN CONTADOR  */
									$contador++;
									
							    } else { echo mysql_error(); }   // Fin del if ( $num_rows_query703(1 y 2) > 0 )  {
						    						
							}     // Fin del if ( $num_rows_query702 > 0 )  {
													 
						 } else { echo mysql_error(); }  // Fin del if ( $num_rows_query701 > 0 )  {
					 				 
					 } else { echo mysql_error(); }  // Fin del if ( $num_rows_query70 > 0 )  {
				   			   
				  } else {  continue;  }   // Fin del if( substr($key,0,12) == "id_pendiente") {
			   
			   	   
			   }  // Fin del foreach($_POST as $key => $value)
		  	  
		  break;
          default:
		       // CASO CAJA DE ALGÚN ALMACÉN
		       /******* BUSCO TODOS LOS id DE ARTÍCULOS DE LAS VARIABLES $_POST********/
			   foreach($_POST as $key => $value)
	           {
				   if( substr($key,0,12) == "id_pendiente") {
			          // Con esto tengo el id del efectivo PENDIENTE de la TABLA cajaefectivos_pendientes_de_entrada que voy a ingresar en CAJA. 
				      
					  $id_pendiente = substr($key,12);  // Esto es 1, 2, 3....
					  settype($id_pendiente, "integer");  //a) tengo el id convertido en int.
				      
					  // PASO 1: pongo valor 1 en el recibido de la TABLA cajaefectivos_pendientes_de_entrada 
					  $query71 = "UPDATE cajaefectivos_pendientes_de_entrada SET recibido=1 WHERE id='".$id_pendiente."'"; 
					  $query71 = mysql_query($query71);
					  $num_rows_query71 = mysql_affected_rows();
					  if ( $num_rows_query71 > 0 )  {
						  // PASO 2: select todos los campos que necesito para hacer el INSERT del INGRESO DE CAJA.
					     $query711 = "SELECT * FROM cajaefectivos_pendientes_de_entrada WHERE id='".$id_pendiente."'";
						 $query711 = mysql_query($query711);
						 $num_rows_query711 = mysql_num_rows($query711);
						 if ( $num_rows_query711 > 0 )  {
							// Guardo los valores de los DATOS.
						    $ingreso_de_caja = mysql_fetch_assoc($query711);
							// PASO 3: INSERT en la tabla cajaalmacen_(id) el INGRESO DE EFECTIVO A LA CAJA
				            /***** AHORA BUSCO EL SALDO QUE EXISTE EN LA CAJA DEL ALMACEN EN ESTOS MOMENTOS ***/
							$query712 = "SELECT saldo FROM cajaalmacen_".$local_stock." ORDER BY id DESC LIMIT 1";
							$query712 = @mysql_query($query712) or die(mysql_error());
							$num_rows_query712 = mysql_num_rows($query712);
							if ( $num_rows_query712 == 1 )  {
								// Esto significa que hay algun registro en la BD.
						        $last_saldo = mysql_fetch_assoc($query712);
							    					
								$old_saldo = $last_saldo['saldo'];
	                            settype($old_saldo, 'float');
	                            $efectivo_a_ingresar = $ingreso_de_caja['cantidad_transaccion'];
								settype($efectivo_a_ingresar, 'float');
								
								$new_saldo = $old_saldo + $efectivo_a_ingresar;
								
								$query7131 = "INSERT INTO cajaalmacen_".$local_stock."( fecha_transaccion, tipo_transaccion, origen_transaccion, destino_transaccion, cantidad_transaccion, observaciones, no_venta, persona_q_hace_transaccion, recibido, saldo ) VALUES ( '".$fecha."', 'Ingreso de Caja', '".$ingreso_de_caja['nombre_caja_local_origen']."', '', '".$efectivo_a_ingresar."', '".$ingreso_de_caja['observaciones_transaccion']."', '', '".$_SESSION['nombre_completo']."', 1, '".$new_saldo."' )";
								$query7131 = mysql_query($query7131);
								$num_rows_query7131 = mysql_affected_rows();
								if ( $num_rows_query7131 > 0 )   {
									// Se insertó correctamente en la BD.
									/* ALMACENO EN UN CONTADOR  */
									$contador++;
									
							    } else { echo mysql_error(); }   // Fin del if ( $num_rows_query713 > 0 )  {
													
							} else { 
							    // Esto significa que no hay ningún registro en la BD. (TABLA VACÍA)
							    $old_saldo = 0;
							    $efectivo_a_ingresar = $ingreso_de_caja['cantidad_transaccion'];
								settype($efectivo_a_ingresar, 'float');
								
								$new_saldo = $old_saldo + $efectivo_a_ingresar;
								
								$query7132 = "INSERT INTO cajaalmacen_".$local_stock."( fecha_transaccion, tipo_transaccion, origen_transaccion, destino_transaccion, cantidad_transaccion, observaciones, no_venta, persona_q_hace_transaccion, recibido, saldo ) VALUES ( '".$fecha."', 'Ingreso de Caja', '".$ingreso_de_caja['nombre_caja_local_origen']."', '', '".$efectivo_a_ingresar."', '".$ingreso_de_caja['observaciones_transaccion']."', '', '".$_SESSION['nombre_completo']."', 1, '".$new_saldo."' )";
								$query7132 = mysql_query($query7132);
								$num_rows_query7132 = mysql_affected_rows();
								if ( $num_rows_query7132 > 0 )   {
									// Se insertó correctamente en la BD.
									/* ALMACENO EN UN CONTADOR  */
									$contador++;
									
							    } else { echo mysql_error(); }   // Fin del if ( $num_rows_query713(1 y 2) > 0 )  {
						    								
							}     // Fin del if ( $num_rows_query712 > 0 )  {
													 
						 } else { echo mysql_error(); }  // Fin del if ( $num_rows_query711 > 0 )  {
					 				 
					 } else { echo mysql_error(); }  // Fin del if ( $num_rows_query71 > 0 )  {
				   			   
				  } else {  continue;  }   // Fin del if( substr($key,0,12) == "id_pendiente") {
			   			   	   
			   }  // Fin del foreach($_POST as $key => $value)
		  	  
		  break;
		  		   
	   }   // Fin del switch($local_stock)
    
	   /* AL FINAL DEVUELVO EL MENSAJE DE OK */
	   header('Location: ../index.php?mod=mod_caja&ttype='.$contador.'#tabs-2');
	   
  }   // process_efectivo_pendiente()

//08 
  function show_transacciones_caja($id_local_ask) 
  {
	  // Función que muestra las transacciones que han habido en la caja el día de HOY.
      $fecha = gmdate('Y-m-d', time() - 18000 );
	  $local_stock = $_SESSION['id_local'];  // Número del local que voy a hacer el ENTRADA de artículos. 
	  
	  switch($id_local_ask)
	  {
		 case 0:  //a) <- Esto es cuando quiero ver la caja de acuerdo al usuario (a ó v) y tipo de local(1,2,3..) DEFAULT
	       
		   //01 HAGO UN switch para ver el caso de CAJA CENTRAL (1) o las otras CAJAS DE ALMACENES (2, 3, 4, 5,.....) 
	       switch($_SESSION['tipo_usuario'])
	       {
		       case "a":     // CASO ADMINISTRADOR.
		         $query081 = "SELECT * FROM cajacentral_".$local_stock." WHERE fecha_transaccion='".$fecha."' ORDER BY id DESC"; 
		         $query081 = mysql_query($query081);
			     $num_rows_query081 = mysql_num_rows($query081);
			     if ( $num_rows_query081 > 0 )  {
				     // Esto significa que hay registros de transacción para el día de HOY.
				     for ( $i=0; $i < $num_rows_query081; $i++ )
				     {
					     $transacciones[$i] = mysql_fetch_assoc($query081); 
				
				     } // Fin del for
				
			         return $transacciones;
			
			     } else {
			         // Esto significa que no hay ningun registro para ese día.
				     return "null";	
			     }
		       break;
		       case "v":     // CASO VENDEDOR
		         $query082 = "SELECT * FROM cajaalmacen_".$_SESSION['id_local']." WHERE fecha_transaccion='".$fecha."' ORDER BY id DESC"; 
		         $query082 = mysql_query($query082);
			     $num_rows_query082 = mysql_num_rows($query082);
			     if ( $num_rows_query082 > 0 )  {
				     // Esto significa que hay registros de transacción para el día de HOY.
				     for ( $i=0; $i < $num_rows_query082; $i++ )
				     {
					     $transacciones[$i] = mysql_fetch_assoc($query082); 
				     }  // Fin del for
				
			         return $transacciones;
			
			     } else {
			         // Esto significa que no hay ningun registro para ese día.
				     return "null";	
			     }             
		  	   break; 
	    
	       }  // Fin del switch($_SESSION['tipo_usuario'])
		 break;
		 
		 default: //b) <- Esto es cuando el Administrador quiere ver la caja de un local determinado de acuerdo a su id_local
		    $query083 = "SELECT * FROM cajaalmacen_".$id_local_ask." WHERE fecha_transaccion='".$fecha."' ORDER BY id DESC"; 
		    $query083 = mysql_query($query083);
			     $num_rows_query083 = mysql_num_rows($query083);
			     if ( $num_rows_query083 > 0 )  {
				     // Esto significa que hay registros de transacción para el día de HOY.
				     for ( $i=0; $i < $num_rows_query083; $i++ )
				     {
					     $transacc[$i] = mysql_fetch_assoc($query083); 
				     }  // Fin del for
				
			         return $transacc;
			
			     } else {
			         // Esto significa que no hay ningun registro para ese día.
				     return "null";	
			     }             
		 break;
	  } // Fin del switch($id_local_ask)
	  
  }  // Fin de la función show_transacciones_caja()
  
//09 
  function show_resumen_caja($id_local_ask)
  {
	  // Función que muestra todos lo relacionado con los datos del RESUMEN DE CAJA DEL DÍA.
      
	  $local_stock = $_SESSION['id_local'];
	  $fecha = gmdate('Y-m-d', time() - 18000 );
	  
	  //01 Defino los contadores para ver las transacciones de caja del dia de HOY....
	  $num_ventas_totales = 0;         //a)
	  $num_compras_totales = 0;        //a)
	  $efectivo_ventas_totales = 0;    //b)
	  $efectivo_compras_totales = 0;   //b)
	  $num_retiros = 0;                //c)ya
	  $efectivo_retiros = 0;           //d)ya
	  $num_ingresos = 0;               //e)ya
	  $efectivo_ingresos = 0;          //f)ya
	  
	  //02 VERIFICO QUE LA CONSULTA SEA PARA: a) Página principal del módulo Caja b) Por la consulta del adminsitrador para ver la Caja del almacén.
	  if ( $id_local_ask == 0 )  { 
	  
	      //03 HAGO UN switch para ver el caso de CAJA CENTRAL (1) o las otras CAJAS DE ALMACENES (2, 3, 4, 5,.....) 
	      switch($_SESSION['tipo_usuario'])
	      {
		      case "a":     // CASO ADMINISTRADOR.
	              $query091 = "SELECT saldo FROM cajacentral_1 ORDER BY id DESC LIMIT 1";
			      $query091 = @mysql_query($query091) or die(mysql_error());  
			      $num_rows_query091 = mysql_num_rows($query091);
			      if ( $num_rows_query091 > 0 )  {
				      // Esto significa que hay al menos un registro en la BD. (  )
				      $resultado = mysql_fetch_assoc($query091);
				      /*(o)*/ $resumen_caja['total_caja'] = $resultado['saldo'];
				 
				      $query0911 = "SELECT * FROM cajacentral_".$local_stock." WHERE fecha_transaccion='".$fecha."' ORDER BY id DESC"; 
		              $query0911 = @mysql_query($query0911) or die( mysql_error() ); 
			          $num_rows_query0911 = mysql_num_rows($query0911);
			          if ( $num_rows_query0911 > 0 )  {
				          // Esto significa que hay registros de transacción para el día de HOY.
					      /*(o)*/ $resumen_caja['existe'] = "no_null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)  
				          for ( $i=0; $i < $num_rows_query0911; $i++ )
				          {
					           $transacciones[$i] = mysql_fetch_assoc($query0911); 
				
				               switch($transacciones[$i]['tipo_transaccion'])
						       { 
							       case "Ingreso de Caja":  // Para el caso de un ingreso de Caja.
							          //e) Aumento en 1 la cantidad de INGRESOS.
								      $num_ingresos++;
							          //f) Sumo la cantidad de EFECTIVO del INGRESO.
								      $cantidad_del_ingreso = stripslashes($transacciones[$i]['cantidad_transaccion']);
								      settype($cantidad_del_ingreso, "float");
							          $efectivo_ingresos = $efectivo_ingresos + $cantidad_del_ingreso;
							       break;
							       case "Retiro de Caja":   // Para el caso de un Retiro de Caja.
							          //a) y b)
								      if ( $transacciones[$i]['no_orden_de_compra'] != 0 )   {
									      // VERIFICO QUE EXISTA ALGUNA COMPRA (SI ES != 0 ENTONCES SIGNIFICA QUE HUBO UNA COMPRA)
									      $num_compras_totales++;
								          $efectivo_compra = stripslashes($transacciones[$i]['cantidad_transaccion']);
								          settype($efectivo_compra, "float");
								  
								          $efectivo_compras_totales = $efectivo_compras_totales + $efectivo_compra;
								      }
								      //c) Aumento en 1 la cantidad de RETIROS.
								      $num_retiros++;       
							          //d) Sumo la cantidad de EFECTIVO del RETIRO. 
							          $cantidad_del_retiro = stripslashes($transacciones[$i]['cantidad_transaccion']);
								      settype($cantidad_del_retiro, "float");
							          $efectivo_retiros = $efectivo_retiros + $cantidad_del_retiro;
							       break;
						   					   
						       } // Fin del switch($transacciones[$i]['tipo_transaccion'])
					  
					     } // Fin del for
				         /*(o)*/$resumen_caja['existe'] = "no_null";    // Me indica si existe o no algun registro el día de HOY(MENSAJE)
					     /*a)*/$resumen_caja['num_compras_totales'] = $num_compras_totales; 
					     /*b)*/$resumen_caja['efectivo_compras_totales'] = $efectivo_compras_totales; 
			             /*c)*/$resumen_caja['num_retiros'] = $num_retiros;   
				         /*d)*/$resumen_caja['efectivo_retiros'] = $efectivo_retiros;
				         /*e)*/$resumen_caja['num_ingresos'] = $num_ingresos;
					     /*f)*/$resumen_caja['efectivo_ingresos'] = $efectivo_ingresos;
				  
				      } else {
			              // Esto significa que no hay ningun registro para ese día.
				          $resumen_caja['existe'] = "null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)
					      $resumen_caja['num_compras_totales'] = 0;
				          $resumen_caja['efectivo_compras_totales'] = 0;
				          $resumen_caja['num_retiros'] = 0;
				          $resumen_caja['efectivo_retiros'] = 0;
				          $resumen_caja['num_ingresos'] = 0;
				          $resumen_caja['efectivo_ingresos'] = 0;
					  
					      return $resumen_caja;	
			          }
				  
				      return $resumen_caja;
				   
			          } else {
				          // Esto significa que no hay ningun registro en la BD (inicio de las operaciones).
				      $resumen_caja['existe'] = "null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)
				      $resumen_caja['total_caja'] = 0;
				      $resumen_caja['num_compras_totales'] = 0;
				      $resumen_caja['efectivo_compras_totales'] = 0;
				      $resumen_caja['num_retiros'] = 0;
				      $resumen_caja['efectivo_retiros'] = 0;
				      $resumen_caja['num_ingresos'] = 0;
				      $resumen_caja['efectivo_ingresos'] = 0;
				  			  
				      return $resumen_caja;
				  
			      }
           
		      break;
		      case "v":
		          $query092 = "SELECT saldo FROM cajaalmacen_".$_SESSION['id_local']." ORDER BY id DESC LIMIT 1";
			      $query092 = @mysql_query($query092) or die(mysql_error());  
			      $num_rows_query092 = mysql_num_rows($query092);
			      if ( $num_rows_query092 > 0 )  {
				      // Esto significa que hay al menos un registro en la BD.
				      $resultado = mysql_fetch_assoc($query092);
				      /*(o)*/$resumen_caja['total_caja'] = $resultado['saldo'];
				  
				      $query0921 = "SELECT * FROM cajaalmacen_".$local_stock." WHERE fecha_transaccion='".$fecha."' ORDER BY id DESC"; 
		              $query0921 = @mysql_query($query0921) or die( mysql_error() ); 
			          $num_rows_query0921 = mysql_num_rows($query0921);
			          if ( $num_rows_query0921 > 0 )  {
				          // Esto significa que hay registros de transacción para el día de HOY.
				          /*(o)*/ $resumen_caja['existe'] = "no_null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)  
					      for ( $i=0; $i < $num_rows_query0921; $i++ )
				          {
					           $transacciones[$i] = mysql_fetch_assoc($query0921); 
				
				               switch($transacciones[$i]['tipo_transaccion'])
						       { 
							       case "Ingreso de Caja":  // Para el caso de un ingreso de Caja.
							          //a) y b)
								      if ( $transacciones[$i]['no_venta'] != 0 )   {
									      // VERIFICO QUE EXISTA ALGUNA COMPRA (SI ES != 0 ENTONCES SIGNIFICA QUE HUBO UNA COMPRA)
									      $num_ventas_totales++;
								          $efectivo_venta = $transacciones[$i]['cantidad_transaccion'];
								          settype($efectivo_venta, "float");
								  
								          $efectivo_ventas_totales = $efectivo_ventas_totales + $efectivo_venta;
								      }
								      //e) Aumento en 1 la cantidad de INGRESOS.
								      $num_ingresos++;
							          //f) Sumo la cantidad de EFECTIVO del INGRESO.
								      $cantidad_del_ingreso = $transacciones[$i]['cantidad_transaccion'];
								      settype($cantidad_del_ingreso, "float");
							          $efectivo_ingresos = $efectivo_ingresos + $cantidad_del_ingreso;
							       break;
							       case "Retiro de Caja":   // Para el caso de un Retiro de Caja.
							      
								      //c) Aumento en 1 la cantidad de RETIROS.
								      $num_retiros++;       
							          //d) Sumo la cantidad de EFECTIVO del RETIRO. 
							          $cantidad_del_retiro = $transacciones[$i]['cantidad_transaccion'];
								      settype($cantidad_del_retiro, "float");
							          $efectivo_retiros = $efectivo_retiros + $cantidad_del_retiro;
							       break;
						   						   
						       } // Fin del switch($transacciones[$i]['tipo_transaccion'])
					  
					     } // Fin del for
				               $resumen_caja['existe'] = "not_null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)  
					     /*a)*/$resumen_caja['num_ventas_totales'] = $num_ventas_totales; 
					     /*b)*/$resumen_caja['efectivo_ventas_totales'] = $efectivo_ventas_totales; 
			             /*c)*/$resumen_caja['num_retiros'] = $num_retiros;   
				         /*d)*/$resumen_caja['efectivo_retiros'] = $efectivo_retiros;
				         /*e)*/$resumen_caja['num_ingresos'] = $num_ingresos;
					     /*f)*/$resumen_caja['efectivo_ingresos'] = $efectivo_ingresos;
				      } else {
			              // Esto significa que no hay ningun registro para ese día.
				          $resumen_caja['existe'] = "null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)
					      $resumen_caja['num_ventas_totales'] = 0;
				          $resumen_caja['efectivo_ventas_totales'] = 0;
				          $resumen_caja['num_retiros'] = 0;
				          $resumen_caja['efectivo_retiros'] = 0;
				          $resumen_caja['num_ingresos'] = 0;
				          $resumen_caja['efectivo_ingresos'] = 0;
					  
					      return $resumen_caja;		
			          }
				      return $resumen_caja;
				  } else {
				      // Esto significa que no hay ningun registro en la BD.
				      $resumen_caja['existe'] = "null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)
				      $resumen_caja['total_caja'] = 0;
				      $resumen_caja['num_ventas_totales'] = 0;
				      $resumen_caja['efectivo_ventas_totales'] = 0;
				      $resumen_caja['num_retiros'] = 0;
				      $resumen_caja['efectivo_retiros'] = 0;
				      $resumen_caja['num_ingresos'] = 0;
				      $resumen_caja['efectivo_ingresos'] = 0;
				  				  
				      return $resumen_caja;
				  }
		  	  break;
          }  // Fin del switch
	  
	  } else {   //02 VERIFICO QUE LA CONSULTA SEA PARA: CASO b) Por la consulta del adminsitrador para ver la Caja del almacén.
          $query093 = "SELECT saldo FROM cajaalmacen_".$id_local_ask." ORDER BY id DESC LIMIT 1";
	      $query093 = @mysql_query($query093) or die(mysql_error());  
		  $num_rows_query093 = mysql_num_rows($query093);
		  if ( $num_rows_query093 > 0 )  {
		      // Esto significa que hay al menos un registro en la BD.
		      $resultado = mysql_fetch_assoc($query093);
			  /*(o)*/$resumen_caja['total_caja'] = $resultado['saldo'];
				  
			  $query0931 = "SELECT * FROM cajaalmacen_".$id_local_ask." WHERE fecha_transaccion='".$fecha."' ORDER BY id DESC"; 
		      $query0931 = @mysql_query($query0931) or die( mysql_error() ); 
			  $num_rows_query0931 = mysql_num_rows($query0931);
			  if ( $num_rows_query0931 > 0 )  {
				  // Esto significa que hay registros de transacción para el día de HOY.
				  /*(o)*/ $resumen_caja['existe'] = "no_null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)  
			      for ( $i=0; $i < $num_rows_query0931; $i++ )
				  {
					   $transacciones[$i] = mysql_fetch_assoc($query0931); 
				
				       switch($transacciones[$i]['tipo_transaccion'])
					   { 
							  case "Ingreso de Caja":  // Para el caso de un ingreso de Caja.
							       //a) y b)
							       if ( $transacciones[$i]['no_venta'] != 0 )   {
							           // VERIFICO QUE EXISTA ALGUNA COMPRA (SI ES != 0 ENTONCES SIGNIFICA QUE HUBO UNA COMPRA)
								       $num_ventas_totales++;
								       $efectivo_venta = $transacciones[$i]['cantidad_transaccion'];
								       settype($efectivo_venta, "float");
								  
								       $efectivo_ventas_totales = $efectivo_ventas_totales + $efectivo_venta;
						           }
						           //e) Aumento en 1 la cantidad de INGRESOS.
							       $num_ingresos++;
							       //f) Sumo la cantidad de EFECTIVO del INGRESO.
						           $cantidad_del_ingreso = $transacciones[$i]['cantidad_transaccion'];
							       settype($cantidad_del_ingreso, "float");
							       $efectivo_ingresos = $efectivo_ingresos + $cantidad_del_ingreso;
							  break;
							  case "Retiro de Caja":   // Para el caso de un Retiro de Caja.
							      
								    //c) Aumento en 1 la cantidad de RETIROS.
								    $num_retiros++;       
							        //d) Sumo la cantidad de EFECTIVO del RETIRO. 
							        $cantidad_del_retiro = $transacciones[$i]['cantidad_transaccion'];
								    settype($cantidad_del_retiro, "float");
							        $efectivo_retiros = $efectivo_retiros + $cantidad_del_retiro;
							  break;
						   						   
					   } // Fin del switch($transacciones[$i]['tipo_transaccion'])
					  
				  } // Fin del for
				  $resumen_caja['existe'] = "not_null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)  
				  /*a)*/$resumen_caja['num_ventas_totales'] = $num_ventas_totales; 
				  /*b)*/$resumen_caja['efectivo_ventas_totales'] = $efectivo_ventas_totales; 
			      /*c)*/$resumen_caja['num_retiros'] = $num_retiros;   
				  /*d)*/$resumen_caja['efectivo_retiros'] = $efectivo_retiros;
				  /*e)*/$resumen_caja['num_ingresos'] = $num_ingresos;
				  /*f)*/$resumen_caja['efectivo_ingresos'] = $efectivo_ingresos;
			   } else {
			      // Esto significa que no hay ningun registro para ese día.
				  $resumen_caja['existe'] = "null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)
				  $resumen_caja['num_ventas_totales'] = 0;
				  $resumen_caja['efectivo_ventas_totales'] = 0;
				  $resumen_caja['num_retiros'] = 0;
				  $resumen_caja['efectivo_retiros'] = 0;
				  $resumen_caja['num_ingresos'] = 0;
				  $resumen_caja['efectivo_ingresos'] = 0;
					  
				  return $resumen_caja;		
			   }
				      return $resumen_caja;
		  } else {
			   // Esto significa que no hay ningun registro en la BD.
			   $resumen_caja['existe'] = "null";      // Me indica si existe o no algun registro el día de HOY(MENSAJE)
			   $resumen_caja['total_caja'] = 0;
			   $resumen_caja['num_ventas_totales'] = 0;
			   $resumen_caja['efectivo_ventas_totales'] = 0;
			   $resumen_caja['num_retiros'] = 0;
			   $resumen_caja['efectivo_retiros'] = 0;
			   $resumen_caja['num_ingresos'] = 0;
			   $resumen_caja['efectivo_ingresos'] = 0;
				  				  
			   return $resumen_caja;
		   }
	    
	  }  // Fin del if ( //02 )
  }  // Fin de la función show_total_caja()

//10 (private) 
  function entrada_registro_bancario($arr) 
  { 
      // Función  que introduce el registro de la transacción en la tabla registro_bancario.
  
      //01 SELECCIONO EL VALOR DEL CAMPO saldos DEL ÚLTIMO REGISTRO INTRODUCIDO en la TABLA .  
	  $query10 = "SELECT saldos FROM registro_bancario ORDER BY id DESC LIMIT 1";
	  $query10 = mysql_query($query10);
	  $num_row_query10 = mysql_num_rows($query10);
	  if ( $num_row_query10 == 1 )  {
		  $last_saldo = mysql_fetch_assoc($query10);
	  } else { echo mysql_error(); }
	  
	  //02 SUMO Y OBTENGO EL VALOR QUE VOY A INTRODUCIR EN EL CAMPO saldos
	  $old_saldo = $last_saldo['saldos'];
	  settype($old_saldo, 'float');
	  $valor_deposito = $arr['cantidad_transaccion']; 
	  settype($valor_deposito, 'float');
	  
	   $saldo_total = $old_saldo + $valor_deposito;
  
      //03 INSERTO LOS VALORES EN LA BD.
	  $query101 = "INSERT INTO registro_bancario ( fecha, descripcion, debitos, creditos, saldos, reajustar_error ) VALUES ('".addslashes($arr['fecha_transaccion'])."', '".addslashes($arr['observaciones_transaccion'])."', '0', '".$valor_deposito."', '".$saldo_total."', 0)";
	  $query101 = mysql_query($query101);
	  $num_rows_affected = mysql_affected_rows();
	  if ( $num_rows_affected > 0 )  {
          // Esto significa que se insertó bien en la BD.
	      return "ok";
	   
	  } else { echo mysql_error(); }
   
  }  // Fin de la función entrada_registro_bancario($arr) 

//11
  function process_caja_anterior() 
  {
	  // Función que procesa el REPORTE solicitado para ver los datos de la caja entre 2 fechas seleccionadas. 
  
      //01 Recibo las variables $_POST[] o las variables $_GET[] si el caso es de impresión.
      if ( isset($_POST['local_caja_anterior']) )  {
		  // CASO 1: PARA MOSTRARLO EN LA WEB. 
		  $arr = $_POST;  
	  } else if ( isset($_GET['caj']) && isset($_GET['id']) && isset($_GET['fi']) && isset($_GET['ff']) )  {
		  // CASO 2: PARA LA IMPRESIÓN.
	      $arr['local_caja_anterior'] = $_GET['id'];
		  $arr['fecha_inicial']       = $_GET['fi'];
		  $arr['fecha_final']         = $_GET['ff'];
	  }
	       
	  if( isset($arr['local_caja_anterior']) )  {
         // Esto es para que introduzca un error si no se envían variables $_POST
  
         //02 Hago la consulta de acuerdo los datos introducidos en el formulario
         switch($arr['local_caja_anterior'])
	     {
	         case "1":
	             // Esto es para el caso de que el local seleccioando sea la CAJA CENTRAL ( BODEGA )
			    $query111 = "SELECT * FROM cajacentral_1 WHERE fecha_transaccion BETWEEN '".$arr['fecha_inicial']."' AND '".$arr['fecha_final']."' ORDER BY id DESC";
                $query111 = mysql_query($query111);
		        $num_rows_query111 = mysql_num_rows($query111);
				if ( $num_rows_query111 > 0 )  {
		            // Esto significa que hay TRANSACCIONES EN LA CAJA y los guardo en un array para devolverlos
		            for ( $i=0; $i < $num_rows_query111; $i++ )
		            {
		                 $caja_anterior[$i] = mysql_fetch_assoc($query111);
		            }
	            
				    return $caja_anterior;
			 
				} else {
					return "null";
			    } 
			 	 		 
			 break;
			 default:
			    // Esto es para el caso de que el local seleccioando sea la CAJA ALMACÉN ( ALMACÉN )
			    $query112 = "SELECT * FROM cajaalmacen_".$arr['local_caja_anterior']." WHERE fecha_transaccion BETWEEN '".$arr['fecha_inicial']."' AND '".$arr['fecha_final']."' ORDER BY id DESC";
                $query112 = mysql_query($query112);
		        $num_rows_query112 = mysql_num_rows($query112);
				if ( $num_rows_query112 > 0 )  {
		            // Esto significa que hay TRANSACCIONES EN LA CAJA y los guardo en un array para devolverlos
		            for ( $i=0; $i < $num_rows_query112; $i++ )
		            {
		                 $caja_anterior[$i] = mysql_fetch_assoc($query112);
		            }
	            
				    return $caja_anterior;
			 
				} else {
					return "null";
			    } 
			 break;
	  
		 } // Fin del switch($arr['local_caja_anterior'])
	  
	  } else {
		  
		 return "error"; 
		  
	  } // Fin del if( isset($arr['local_caja_anterior']) )  {
     
  } // Fin de la función process_caja_anterior()
  
//12 
  function search_data_caja_anterior()
  {
	  // Función que resume y muestra los datos de la consulta de //11.
  
      //01 Recibo las variables $_POST[]
      $arr = $_POST;
      $fecha = gmdate('Y-m-d', time() - 18000 );
	  
	  //01 Defino los contadores para ver las transacciones de caja de los dias Seleccionados....
	  $num_ventas_totales = 0;         //a)
	  $num_compras_totales = 0;        //a)
	  $efectivo_ventas_totales = 0;    //b)
	  $efectivo_compras_totales = 0;   //b)
	  $num_retiros = 0;                //c)
	  $efectivo_retiros = 0;           //d)
	  $num_ingresos = 0;               //e)
	  $efectivo_ingresos = 0;          //f)
	  
	  if( isset($arr['local_caja_anterior']) )  {
         // Esto es para que introduzca un error si no se envían variables $_POST
  
	     //02 Hago la consulta de acuerdo los datos introducidos en el formulario.
         switch($arr['local_caja_anterior'])
	     {
	         case "1":
	             // Esto es para el caso de que el local seleccioando sea la CAJA CENTRAL ( BODEGA )
			    $query121 = "SELECT * FROM cajacentral_1 WHERE fecha_transaccion BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY id DESC";
                $query121 = mysql_query($query121);
		        $num_rows_query121 = mysql_num_rows($query121);
				if ( $num_rows_query121 > 0 )  {
		            // Esto significa que hay TRANSACCIONES EN LA CAJA y los guardo en un array para devolverlos
		            for ( $i=0; $i < $num_rows_query121; $i++ )
		            {
		                 $caja_anterior[$i] = mysql_fetch_assoc($query121);
		            
					     switch($caja_anterior[$i]['tipo_transaccion'])
						 { 
							 case "Ingreso de Caja":  // Para el caso de un ingreso de Caja.
							      //e) Aumento en 1 la cantidad de INGRESOS.
								  $num_ingresos++;
							      //f) Sumo la cantidad de EFECTIVO del INGRESO.
								  $cantidad_del_ingreso = $caja_anterior[$i]['cantidad_transaccion'];
								  settype($cantidad_del_ingreso, "float");
							      $efectivo_ingresos = $efectivo_ingresos + $cantidad_del_ingreso;
							 break;
							 case "Retiro de Caja":   // Para el caso de un Retiro de Caja.
							      //a) y b)
								  if ( $caja_anterior[$i]['no_orden_de_compra'] != 0 || $caja_anterior[$i]['no_orden_de_compra'] == "null")   {
									  // VERIFICO QUE EXISTA ALGUNA COMPRA (SI ES != 0 ENTONCES SIGNIFICA QUE HUBO UNA COMPRA)
									  $num_compras_totales++;
								      $efectivo_compra = $caja_anterior[$i]['cantidad_transaccion'];
								      settype($efectivo_compra, "float");
								  
								      $efectivo_compras_totales = $efectivo_compras_totales + $efectivo_compra;
							      }
								  //c) Aumento en 1 la cantidad de RETIROS.
								  $num_retiros++;       
							      //d) Sumo la cantidad de EFECTIVO del RETIRO. 
							      $cantidad_del_retiro = $caja_anterior[$i]['cantidad_transaccion'];
								  settype($cantidad_del_retiro, "float");
							      $efectivo_retiros = $efectivo_retiros + $cantidad_del_retiro;
							  break;
						  }  // Fin del switch...
					  }  // Fin del for...
				      /*a)*/$resumen_caja['num_compras_totales'] = $num_compras_totales; 
					  /*b)*/$resumen_caja['efectivo_compras_totales'] = $efectivo_compras_totales; 
			          /*c)*/$resumen_caja['num_retiros'] = $num_retiros;   
				      /*d)*/$resumen_caja['efectivo_retiros'] = $efectivo_retiros;
				      /*e)*/$resumen_caja['num_ingresos'] = $num_ingresos;
					  /*f)*/$resumen_caja['efectivo_ingresos'] = $efectivo_ingresos;
				      
					  return $resumen_caja;
						
				}   // No existe un else pues ya este está en la función //11.
              			  
			  break; 		 
		      default:
			    $query122 = "SELECT * FROM cajaalmacen_".$arr['local_caja_anterior']." WHERE fecha_transaccion BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY id DESC";
				$query122 = @mysql_query($query122) or die( mysql_error() ); 
			    $num_rows_query122 = mysql_num_rows($query122);
			    if ( $num_rows_query122 > 0 )  {
				    // Esto significa que hay registros de transacción para el día de HOY.
				    // Esto significa que hay TRANSACCIONES EN LA CAJA y los guardo en un array para devolverlos
		            for ( $i=0; $i < $num_rows_query122; $i++ )
		            {
		                 $caja_anterior[$i] = mysql_fetch_assoc($query122);
		            
					     switch($caja_anterior[$i]['tipo_transaccion'])
						 { 
							 case "Ingreso de Caja":  // Para el caso de un ingreso de Caja.
							      //a) y b)
								  if ( $caja_anterior[$i]['no_venta'] != 0 || $caja_anterior[$i]['no_venta'] == "null" )   {
									  // VERIFICO QUE EXISTA ALGUNA COMPRA (SI ES != 0 ENTONCES SIGNIFICA QUE HUBO UNA COMPRA)
									  $num_ventas_totales++;
								      $efectivo_venta = stripslashes($caja_anterior[$i]['cantidad_transaccion']);
								      settype($efectivo_venta, "float");
								  
								      $efectivo_ventas_totales = $efectivo_ventas_totales + $efectivo_venta;
							      }
								  //e) Aumento en 1 la cantidad de INGRESOS.
								  $num_ingresos++;
							      //f) Sumo la cantidad de EFECTIVO del INGRESO.
								  $cantidad_del_ingreso = stripslashes($caja_anterior[$i]['cantidad_transaccion']);
								  settype($cantidad_del_ingreso, "float");
							      $efectivo_ingresos = $efectivo_ingresos + $cantidad_del_ingreso;
							 break;
							 case "Retiro de Caja":   // Para el caso de un Retiro de Caja.
							      //c) Aumento en 1 la cantidad de RETIROS.
								  $num_retiros++;       
							      //d) Sumo la cantidad de EFECTIVO del RETIRO. 
							      $cantidad_del_retiro = stripslashes($caja_anterior[$i]['cantidad_transaccion']);
								  settype($cantidad_del_retiro, "float");
							      $efectivo_retiros = $efectivo_retiros + $cantidad_del_retiro;
							  break;
						  }  // Fin del switch...
					  }  // Fin del for...
				      /*a)*/$resumen_caja['num_ventas_totales'] = $num_ventas_totales; 
					  /*b)*/$resumen_caja['efectivo_ventas_totales'] = $efectivo_ventas_totales; 
			          /*c)*/$resumen_caja['num_retiros'] = $num_retiros;   
				      /*d)*/$resumen_caja['efectivo_retiros'] = $efectivo_retiros;
				      /*e)*/$resumen_caja['num_ingresos'] = $num_ingresos;
					  /*f)*/$resumen_caja['efectivo_ingresos'] = $efectivo_ingresos;
				      
					  return $resumen_caja;
						 					 
				}  // No existe un else pues ya está en la función //11
			   break;		 
		 } // Fin del switch($arr['local_caja_anterior'])
     
	  } // Fin del if( isset($arr['local_caja_anterior']) )  {  -> No existe un else pues ya este está en la función //11.		 
	  
  }  // Fin de la función search_data_caja_anterior()

//13 
  function show_ingresos_de_caja_pendientes_reporte() 
  {
	  // Función que muestra el efectivo pendiente de entrada en cada caja del sistema pero como una CONSULTA. de CAJA->Ver Cajas Anteriores  
           
	  //01 BUSCO LOS PENDIENTES DE ACUERDO AL VALOR DE LAS VARIABLES $_SESSION['tipo_usuario'](a ó v) y $_SESSION['id_local'](1, 2, 3...)
      $query6 = "SELECT * FROM cajaefectivos_pendientes_de_entrada WHERE recibido=0 AND id_local='".$_POST['local_caja_anterior']."'";
	  $query6 = mysql_query($query6);
	  $num_rows_query6 = mysql_num_rows($query6);
	  if ( $num_rows_query6 > 0 )  {
		  // Esto significa que hay pendientes por entrar a la caja del local seleccionado.  
		  for ( $i=0; $i < $num_rows_query6; $i++ )
		  {
			 
			 $resultado[$i] = mysql_fetch_assoc($query6);    
		  
		  }
	    
		  return $resultado;
	  
	  } else {
		  // Esto significa que no hay ningun pendiente de entrada en ese LOCAL.
		  return "null";
	  }
      
  }  // Función show_ingresos_de_caja_pendientes_reporte()






   /*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_caja  *****/
  
  if ( isset($_GET['data']) && $_GET['data'] == "send_new_transaccion" )   {
	  // Esto es para procesar los datos para insertar una nueva transacción.  
	  process_new_transaccion();
  } else if ( isset($_GET['data']) && $_GET['data'] == "send_efectivo_pendiente" )  {
	  // Esto es para procesar cuando voy a añadir efectivo pendiente a la caja seleccionada.
	  process_efectivo_pendiente();  
  
  }

?>