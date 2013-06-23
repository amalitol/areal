<?php
include_once('connection.php');
@session_start();

/****** ((00)) VARIABLES  *****/ #tabs-3
/************************
 Primer nivel:   Refieren al módulo en cuestion 
              mod=mod_cuentas_x_pagar 

/************************
 Segundo nivel:  Refieren a los elementos del menu superior        Refieren a la edición de un registro de cuentas x pagar cualquiera de la BD.  
              (1) optioncxp=new_in                                   (1) edit_cxp=1,2,3...(id)	  
			  (2) optioncxp=consulta
			  (3) optioncxp=actual
			 
/***********************
  Tercer nivel(I):  Refieren a los elementos que voy a mostrar dentro de un elemento del menu superior				 
          De (1) mesanocxp= (send) <- Envia Consulta de datos de CUENTAS X PAGAR de un mes determinado. Pertenece a 2 del Segundo Nivel.
 
 /*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_cuentas_x_pagar   *****/

//01 process_form_cuentas_x_pagar()   --> Función que procesa el formulario de los registros de las cuentas x pagar
//02 cuentas_x_pagar_mes_actual()     --> Función que devuelve el valor total de las cuentas por pagar de este mes.
//03 registro_values($a)              --> Función que devuelve los datos actuales del registro que quiero EDITAR.
//04 process_edit_cuentas_x_pagar()   --> Función que procesa el formulario para editar un registro de las CUENTAS X PAGAR.
//05 process_form_mesano_cxp($a,$b)   --> Función que muestra los de acuerdo al mes/año seleccionado las cuentas respectivas.
//06 select_cuentas_x_pagar()         --> Función que muestra todos los registros de cuentas x pagar de la BD.
//07 select_registros_cxp()           --> Función que muestra todos los registros de pago de una cuenta x pagar en particular.

/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_cuentas_x_pagar   *****/

/************************************************************************************************************/


/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_cuentas_x_pagar   *****/
//01
  function process_form_cuentas_x_pagar()
  {
	// Función que procesa el formulario de los registros de las cuentas x pagar.
	//01 Recibo las variables $_POST
	$fecha_registro     = addslashes($_POST['fecha_registro']);
	$proveedor          = addslashes($_POST['proveedor']);
	$id_proveedor       = $_POST['proveedor_id'];   // Campo hidden que tiene el id del proveedor.
	$valor_abono        = addslashes($_POST['valor_abono']);
	$detalle_registro   = addslashes($_POST['detalle_registro']);      
    $fecha_vencimiento  = addslashes($_POST['fecha_vencimiento']);
	   
	//02 Inserto los valores del registro en la BD en la tabla cuentas_x_pagar
    $query01 = "INSERT INTO cuentas_x_pagar ( fecha_registro, fecha_vencimiento, proveedor, detalle_registro, valor_abono, valor_abonado, saldo, fin_registro ) VALUES( '".$fecha_registro."', '".$fecha_vencimiento."', '".$id_proveedor."', '".$detalle_registro."', '".$valor_abono."', '0', '".$valor_abono."', 0 )";
    $query01 = mysql_query($query01);
    $last_id = mysql_insert_id();
	$num_rows_affected = mysql_affected_rows();
	if ( $num_rows_affected == 1 )  {   // El insert se llevó a cabo con éxito.
	  	
	    //03 Se Muestra la tabla con todos los registros 
		header('Location: ../index.php?mod=mod_cuentas_x_pagar#tabs-3');
	
	} else { echo mysql_error(); }
     
   
  }    // Fin de la función process_form_cuentas_x_pagar()....

//02
  function cuentas_x_pagar_mes_actual()
  {
	 // Función que devuelve el valor total de las cuentas por pagar de este mes.
	$contador = 0;   // Contador para el monto que hay que pagar en el mes actual.
	
	// tengo la fecha actual
	$fecha = gmdate('d-m-Y', time() - 18000 );    // Variable de la fecha.
	settype($fecha, "string");
			
	//01 Busco el valor del mes actual con el año respectivo
	$mes_actual = substr($fecha,3,2); // Primero busco el valor del mes actual
	settype($mes_actual, "int");
	$ano_actual = substr($fecha,6,4); // Despues busco el valor del año actual
	settype($ano_actual, "int");
	
	//02 Hago la consulta para ver la sumtoria de todos los registros de este mes.
	$query02 = "SELECT cuentas_x_pagar.id, cuentas_x_pagar.fecha_registro, cuentas_x_pagar.fecha_vencimiento, cuentas_x_pagar.no_orden_de_compra, proveedores_clientes.nombre, cuentas_x_pagar.detalle_registro, cuentas_x_pagar.valor_abono, cuentas_x_pagar.valor_abonado, cuentas_x_pagar.saldo, cuentas_x_pagar.fin_registro FROM cuentas_x_pagar, proveedores_clientes WHERE MONTH(fecha_vencimiento)= ".$mes_actual." AND YEAR(fecha_vencimiento)= ".$ano_actual." AND cuentas_x_pagar.proveedor=proveedores_clientes.id ORDER BY fecha_vencimiento ASC";
	$query02 = mysql_query($query02);
	$num_rows_query02 = mysql_num_rows($query02);
	if ( $num_rows_query02 > 0 )  {
	    // Existen registros de cuentas por pagar para el mes actual	
		
		//03 Guardo todos los registros en un array
		for ( $i=0; $i < $num_rows_query02; $i++ )
		{
		    $registros_mes_actual[($i+1)] = mysql_fetch_assoc($query02);	
		    
			//04 Ahora por cada registro hago la sumatoria de acuerdo a los valores de los campos del saldo y retorno 
		    $temp = $registros_mes_actual[($i+1)]['saldo'];
			settype($temp, "float");
			$contador = $contador + $temp;
		}
		
		$registros_mes_actual[0]['exist'] = "si";   // Me indica que hay CUENTAS POR PAGAR EN LA BD.
		$registros_mes_actual[0]['contador'] = $contador;
	    
    } else {
	    // No existen registros de cuentas por pagar para el mes actual
		$registros_mes_actual[0]['exist'] = "no";   // Me indica que NO hay CUENTAS POR PAGAR EN LA BD.
		$registros_mes_actual[0]['contador'] = "0.00";
			
	}
	  
	return $registros_mes_actual;  
  
  }  // fin de la function cuentas_x_pagar_mes_actual()

//03 
  function registro_values($id_register)
  {
	  //  Función que devuelve los datos actuales del registro que quiero EDITAR.
 
      //01 Selecciono los datos para ese registro. 
      $query03 = "SELECT cuentas_x_pagar.id, cuentas_x_pagar.fecha_registro, cuentas_x_pagar.fecha_vencimiento, cuentas_x_pagar.no_orden_de_compra, proveedores_clientes.nombre, cuentas_x_pagar.proveedor, cuentas_x_pagar.detalle_registro, cuentas_x_pagar.valor_abono, cuentas_x_pagar.valor_abonado, cuentas_x_pagar.saldo, cuentas_x_pagar.fin_registro FROM cuentas_x_pagar, proveedores_clientes WHERE cuentas_x_pagar.id='".$id_register."' AND cuentas_x_pagar.proveedor=proveedores_clientes.id";
      $query03 = mysql_query($query03);
      $num_rows_query03 = mysql_num_rows($query03);
      if ( $num_rows_query03 == 1 ) {
		  // Esto significa que la consulta fue satisfactoria  
		  	  
		  $register_edit = mysql_fetch_assoc($query03);
		  return $register_edit;
		  
	  } else {
		  
	     echo mysql_error();
	  
	  }
          
  }  // fin de la función registro_values()

  //04 
  function process_edit_cuentas_x_pagar()   
  {
	 // Función que procesa el formulario para editar un registro de las CUENTAS X PAGAR.
     //01 Recibo las variables $_POST
	$fecha_registro     = addslashes($_POST['fecha_registro']);
	$proveedor_id       = $_POST['proveedor_id'];   // hidden
	$proveedor          = addslashes($_POST['proveedor']);
	$valor_abono        = addslashes($_POST['valor_abono']);
	$detalle_registro   = addslashes($_POST['detalle_registro']);      
    $fecha_vencimiento  = addslashes($_POST['fecha_vencimiento']);
	$no_orden_de_compra = $_POST['no_orden_de_compra'];   // Campo hidden
	
	$fecha_actualizacion = addslashes($_POST['fecha_actualizacion']);
	$abonar = $_POST['abonar'];
	if ( $abonar == "una_parte" )  {
	    // entonces recibo la variable del campo text	
		$valor_act_abono = addslashes($_POST['valor_act_abono']);
    
	} else if ( $abonar == "todo" ) {
	    // Si voy a pagar toda la deuda entonces la actualizacion es igual al saldo	
	    $valor_act_abono = $_POST['saldo'];
	}
	
	$origen_pago = $_POST['origen_pago'];  // Valor del <select>
	$detalle_edit = addslashes($_POST['detalle_edit']);
	$id                 = $_POST['id'];               // Campo hidden
    $valor_abonado      = $_POST['valor_abonado'];    // Campo hidden  (Total de lo abonado hasta la fecha)  
	$saldo              = $_POST['saldo'];            // Campo hidden  (Total del saldo que falta por abonar hasta la fecha)            
		
	//02 LLEVO A CABO LAS OPERACIONES PERTINENTES PARA INSERTAR LOS DATOS DE valor abonado, saldo
	settype($valor_abono, "float");
	settype($valor_act_abono, "float");
	settype($valor_abonado, "float");
	settype($saldo, "float");
	
	// CAMPO "valor abonado"
	$valor_abonado_final = $valor_abonado + $valor_act_abono;
	
	// CAMPO "saldo"
	$saldo_final = $valor_abono - $valor_abonado_final;
	
	//CAMPO "fin_registro"
	if ( $abonar == "todo" )  {
		// Se marca el radio botón de cierre de la cuenta.
		$fin_registro = 1;
	} else if ( $saldo_final == 0 )  {
		// Ya no queda saldo por pagar
		$fin_registro = 1;
	} else {
	   // Cualquier otra cosa
	   $fin_registro = 0;
	}
		
	//03 ACTUALIZO LA BD cuentas_x_pagar con los primeros 5 valores
    $query04 = "UPDATE cuentas_x_pagar SET fecha_registro='".$fecha_registro."', fecha_vencimiento='".$fecha_vencimiento."', proveedor='".$proveedor_id."', detalle_registro='".$detalle_registro."', valor_abono='".$valor_abono."', valor_abonado='".$valor_abonado_final."', saldo='".$saldo_final."', fin_registro=".$fin_registro."  WHERE id='".$id."'";
    $query04 = mysql_query($query04);
	$num_rows_query04 = mysql_affected_rows();
		
		//04 Inserto el NUEVO REGISTRO de actualización en la BD cuentas_x_pagar_details.
		$query041 = "INSERT INTO cuentas_x_pagar_details (id_cxp, fecha_actualizacion, detalle_edit, origen_pago, valor_abono, valor_act_abono, saldo) VALUES ('".$id."', '".$fecha_actualizacion."', '".$detalle_edit."', '".$origen_pago."', '".$valor_abono."', '".$valor_act_abono."', '".$saldo_final."' )";
		$query041 = mysql_query($query041);
		$id_reg = mysql_insert_id();         // Esto es para PONER EN LAS TABLAS registro_bancario ó cajacentral_1 
		$num_rows_query041 = mysql_affected_rows();
		if ( $num_rows_query041 == 1 )   {
		    // Esto significa que se insertaron los registros correctamente en la BD.	
			
			//05 De acuerdo al valor de 'origen_pago' inserto EL REGISTRO EN LA CAJA CENTRAL O EN EL BANCO.
		    switch($origen_pago)
		    {
		        case "banco":  // Pago con un Cheque Bancario.
		            //a) Inserto el valor en la tabla registro_bancario
	                // PRIMERO TENGO QUE BUSCAR EL VALOR DEL SALDO ACTUAL DEL REGISTRO BANCARIO.
					$query042 = "SELECT saldos FROM registro_bancario ORDER BY id DESC LIMIT 1";
					$query042 = mysql_query($query042);
	                $num_row_query042 = mysql_num_rows($query042);
	                if ( $num_row_query042 == 1 )  {
	 	                // Se hizo bien la consulta en la BD. 
						$last_saldo = mysql_fetch_assoc($query042);
	                    $old_saldo = $last_saldo['saldos'];
	                    settype($old_saldo, 'float');
	                    
						$saldo_final_cxp = $old_saldo - $valor_act_abono; 
					
					    $query043 = "INSERT INTO registro_bancario ( fecha, no_orden_de_compra, id_origen_pago_cxp, no_venta, id_origen_cobro_cxc, descripcion, debitos, creditos, saldos, reajustar_error ) VALUES ( '".$fecha_actualizacion."', '0', '".$id_reg."', '0', '0', '".$detalle_edit."', '".$valor_act_abono."', '', '".$saldo_final_cxp."', 0 )";
				        $query043 = mysql_query($query043);
				        $num_rows_query043 = mysql_affected_rows();
				        if ( $num_rows_query043 > 0 )  {
					       // Esto significa que se insertó bien en la BD.
					       header('Location: ../index.php?mod=mod_cuentas_x_pagar&edit_cxp='.$id.'#tabs-3');
				
			  	        } else { echo mysql_error(); }	   
  							
					} else { echo mysql_error(); }
							
				break;
		        case "caja":   // Pago con una ntransacción de la Caja Central.
		            //b) 
		            //01 BUSCO EL SALDO DE LA ÚLTIMA TRANSACCIÓN DE LA CAJA.
                    $query044 = "SELECT saldo FROM cajacentral_1 ORDER BY id DESC LIMIT 1";
	                $query044 = @mysql_query($query044) or die(mysql_error());  
	                $num_rows_query044 = mysql_num_rows($query044);
	                if ( $num_rows_query044 > 0 )  {
					    // Esto significa que hay al menos un registro en la BD. (  )
	                    $resultado = mysql_fetch_assoc($query044);
	                    $old_saldo_en_caja  = $resultado['saldo'];
	                    settype($old_saldo_en_caja, "float");       
		                
		                $saldo_caja_final = $old_saldo_en_caja - $valor_act_abono;  // Esto es saldo final en la CAJA CENTRAL en el ORIGEN
	  
	                    //02 INSERTO LA TRANSACIÓN DIRECTAMENTE EN LA TABLA cajacentral_1
                        $query045 = "INSERT INTO cajacentral_1 ( fecha_transaccion, no_orden_de_compra, id_origen_pago_cxp, id_origen_cobro_cxc, tipo_transaccion, origen_transaccion, destino_transaccion, cantidad_transaccion, observaciones, persona_q_hace_transaccion, recibido, saldo) VALUES ( '".$fecha_actualizacion."', '0', '".$id_reg."', '0', 'Retiro de Caja', '', '".$proveedor."', '".$valor_act_abono."', '".$detalle_edit."', '".$_SESSION['nombre_completo']."', 1, '".$saldo_caja_final."' )"; 
	                    $query045 = mysql_query($query045);
	                    $num_rows_query045 = mysql_affected_rows();
	                    if ( $num_rows_query045 > 0 )  {
		                   // Esto significa que se insertarion bien los datos en BD.
		                   // Esto significa que se insertó bien en la BD.
					       header('Location: ../index.php?mod=mod_cuentas_x_pagar&edit_cxp='.$id.'#tabs-3');
						     
	                    } else { echo mysql_error(); }
				     } else {
		                 // Esto significa que NO hay al menos un registro en la BD. ( TABLA VACÍA ) 
		                 //03 RESTO 0 DEL VALOR DE LA CAJA 
		                 $saldo_caja_final = 0 - $valor_act_abono;  // Esto es saldo final en la CAJA CENTRAL en el ORIGEN
		  
		                 //04 INSERTO LA TRANSACIÓN DIRECTAMENTE EN LA TABLA cajacentral_1 pero pongo como el saldo final la var. $debitos
                         $query046 = "INSERT INTO cajacentral_1 ( fecha_transaccion, no_orden_de_compra, id_origen_pago_cxp, id_origen_cobro_cxc, tipo_transaccion, origen_transaccion, destino_transaccion, cantidad_transaccion, observaciones, persona_q_hace_transaccion, recibido, saldo) VALUES ( '".$fecha_actualizacion."', '0', '".$id_reg."', '0', 'Retiro de Caja', '', '".$proveedor."', '".$valor_act_abono."', '".$detalle_edit."', '".$_SESSION['nombre_completo']."', 1, '".$saldo_caja_final."' )"; 
	                     $query046 = mysql_query($query046);
	                     $num_rows_query046 = mysql_affected_rows();
	                     if ( $num_rows_query046 > 0 )  {
		                     // Esto significa que se insertarion bien los datos en BD.
		                     // Esto significa que se insertó bien en la BD.
					       header('Location: ../index.php?mod=mod_cuentas_x_pagar&edit_cxp='.$id.'#tabs-3');
						   
	                     } else { echo mysql_error(); }
		  
	                 }  // Fin del if ( $num_rows_query044 > 0 )  {
  
		   
		        break;	
		        case "otros":   // Pago de otra forma (NO PASA NADA)
		            //c)
		            // Como no saco de ningún lugar sólo envío el header. 
					header('Location: ../index.php?mod=mod_cuentas_x_pagar&edit_cxp='.$id.'#tabs-3');
		        break;	
			
	         } // Fin del switch.
					
		} else { echo mysql_error(); }
	  
  }  // fin de la función process_edit_cuentas_x_pagar()

  //05
  function process_form_mesano_cxp($mes_consulta_cxpagar,$ano_consulta_cxpagar) 
  {
	 // Función que muestra los de acuerdo al mes/año seleccionado las cuentas respectivas.
     $saldo_mes_seleccionado = 0;  // Variable q me guarda el valor de la sumatoria de los saldos pendientes 	 
	 
	 settype($mes_consulta_cxpagar, "int");
	 settype($ano_consulta_cxpagar, "int");
	 
	 //02 BUSCO EL MES DEL AÑO EN PALABRAS PARA ENVIARLO A LA VISTA.
	 switch($mes_consulta_cxpagar)
	    {
		case 1:
	         $mes = "enero";
		     break;
		case 2:
		     $mes = "febrero";
		     break; 
		case 3:
	         $mes = "marzo";
		     break;
		case 4:
		     $mes = "abril";
		     break; 
		case 5:
	         $mes = "mayo";
		     break;
		case 6:
		     $mes = "junio";
		     break; 
		case 7:
	         $mes = "julio";
		     break;
		case 8:
		     $mes = "agosto";
		     break;
		case 9:
	         $mes = "septiembre";
		     break;
		case 10:
		     $mes = "octubre";
		     break; 
		case 11:
	         $mes = "noviembre";
		     break;
		case 12:
		     $mes = "diciembre";
		     break;
			
		}
   
        //03 Busco todos los registros del mes/año que quiero buscar con una consulta a la BD. 
	   $query05 = "SELECT cuentas_x_pagar.id, cuentas_x_pagar.fecha_registro, cuentas_x_pagar.fecha_vencimiento, cuentas_x_pagar.no_orden_de_compra, proveedores_clientes.nombre, cuentas_x_pagar.detalle_registro, cuentas_x_pagar.valor_abono, cuentas_x_pagar.valor_abonado, cuentas_x_pagar.saldo, cuentas_x_pagar.fin_registro FROM cuentas_x_pagar, proveedores_clientes WHERE MONTH(cuentas_x_pagar.fecha_vencimiento)=".$mes_consulta_cxpagar." AND YEAR(cuentas_x_pagar.fecha_vencimiento)=".$ano_consulta_cxpagar." AND cuentas_x_pagar.proveedor=proveedores_clientes.id ORDER BY cuentas_x_pagar.fecha_vencimiento ASC";
	   $query05 = mysql_query($query05);
	   $num_rows_query05 = mysql_num_rows($query05);
	   
	   if ( $num_rows_query05 > 0 )   {
	      // Esto significa que se obtuvieron datos de regsitros para ese mes.	 
		  for ( $i=0; $i < $num_rows_query05; $i++  )
		  {
		     // Guardo todos los datos en una array	 
		     $mes_seleccionado[($i+3)] = mysql_fetch_assoc($query05);	 
		 		    
			 // Busco la sumatoria total de los saldos de ese mes para ver el SALDO FINAL pendientes de ese mes.
		     $saldo_registro_actual = $mes_seleccionado[($i+3)]['saldo']; 
		     settype($saldo_registro_actual, "float");
		 
		     $saldo_mes_seleccionado = $saldo_mes_seleccionado + $saldo_registro_actual;
		   	 
		  }
		 
	      //04 PONGO EL MES Y EL AÑO EN LOS PRIMEROS VALORES DEL ARREGLO QUE VOY A DEVOLVER
          $mes_seleccionado[0] = $mes;
	      $mes_seleccionado[1] = $ano_consulta_cxpagar;
	      $mes_seleccionado[2] = $saldo_mes_seleccionado; 
	      return $mes_seleccionado;
     
	   } else {
		   // Devuelvo para poner el mensaje de SALIDA con ningun registro pues la consulta fue de 0 REGISTROS
		 
		   $mes_seleccionado[0] = $mes;
	       $mes_seleccionado[1] = $ano_consulta_cxpagar;
		   $mes_seleccionado[2] = "ningun_registro";     // Esto cuando es dá registros en la consulta es un valor numérico
	       return $mes_seleccionado;   
	 
	   } 
   
  }  // Fin de la function process_form_mesano_cxp() 

  //06 
  function select_cuentas_x_pagar()
  {
	  // Función que muestra todos los registros de cuentas x pagar de la BD.
      
	  //01 CONSULTA PARA MOSTRAR TODOS LOS MESES
      $query06 = "SELECT cuentas_x_pagar.id, cuentas_x_pagar.fecha_registro, cuentas_x_pagar.fecha_vencimiento, cuentas_x_pagar.no_orden_de_compra, proveedores_clientes.nombre, cuentas_x_pagar.detalle_registro, cuentas_x_pagar.valor_abono, cuentas_x_pagar.valor_abonado, cuentas_x_pagar.saldo, cuentas_x_pagar.fin_registro FROM cuentas_x_pagar, proveedores_clientes WHERE cuentas_x_pagar.proveedor=proveedores_clientes.id ORDER BY cuentas_x_pagar.id DESC";
      $query06 = mysql_query($query06);
	  $num_rows_query06 = mysql_num_rows($query06);
	  if ( $num_rows_query06 > 0 )  {
		  
		  for ( $i=0; $i < $num_rows_query06; $i++ )
	      {
		       $cuentas_x_pagar_register[$i] = mysql_fetch_assoc($query06); 	
	      }
	  
	      return $cuentas_x_pagar_register;
	  } else { 
		  return "null";  
	  }
	  
	
  
  }  // Fin de la función select_cuentas_x_pagar()


  //07 
  function select_registros_cxp()
  {
	  // Función que muestra todos los registros de pago de una cuenta x pagar en particular.
  
      //01 CONSULTA PARA MOSTRAR LOS DATALLES DE ESTE REGISTRO EN PARTICULAR
      $query_details_cxp = "SELECT * FROM cuentas_x_pagar_details WHERE id_cxp='".$_GET['edit_cxp']."' ORDER BY id DESC";
	  $query_details_cxp = mysql_query($query_details_cxp);
	  $num_rows_query_details_cxp = mysql_num_rows($query_details_cxp);
	  if ( $num_rows_query_details_cxp > 0 )  {
			     
		 for ( $i=0; $i < $num_rows_query_details_cxp; $i++ )
		 {
		      $cxp_register[$i] = mysql_fetch_assoc($query_details_cxp); 	
		 }
	  } else {
	          $cxp_register = "null";
	  }
  
      return $cxp_register;
  
  }  // Fin de la función select_registros_cxp()














/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_cuentas_x_pagar   *****/

  if ( isset($_GET['data']) && $_GET['data'] == "send" )  {
	  // Esto es cuando se envía el formulario de entrada de datos para crear registros de CUENTAS POR PAGAR.
	  process_form_cuentas_x_pagar();
  } else if ( isset($_GET['data']) && $_GET['data'] == "edit" )  {
	  // Esto es cuando se envía el formulario de entrada de datos para editar un registro de CUENTAS POR PAGAR.
	  process_edit_cuentas_x_pagar(); 
  }




?>