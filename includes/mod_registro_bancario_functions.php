<?php
include_once('connection.php');

/****** ((00)) VARIABLES  *****/ #tabs-5
/************************
 Primer nivel:   Refieren al módulo en cuestion 
              mod=mod_registro_bancario

/************************
 Segundo nivel:  Refieren a los elementos del menu superior       
              (1) optionrb=new_in                                   	  
			  (2) optionrb=consulta
			  (3) optionrb=actual


/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_registro_bancario   *****/

//01 process_form_bank()   --> Función que procesa el formulario del registro bancario
//02 saldo_mes_anterior()  --> Función que devuelve el saldo que quedó en la cuenta el mes anterior.
//03 process_form_mes()    --> Función que devuelve los registros del mes y el año seleccionados por el usuario.
//04 process_bank_register_mes($a,$b) --> Función que devuelve los datos de los registros en el mes seleccionado.
//05 process_bank_register()  --> Función que devuelve todos los registros de la base de datos.
//06 process_bank_register_mes_actual()  --> Función que devuelve todos los registros bancarios del mes actual.






/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_registro_bancario   *****/

/************************************************************************************************************/




/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_registro_bancario   *****/
//01
  function process_form_bank()
  {
	//01 Recibo las variables $_POST
	$fecha           = addslashes($_POST['fecha']);
	$tipo_deposito   = addslashes($_POST['tipo_deposito']);
	$descripcion     = addslashes($_POST['descripcion']);
	
	if (isset($_POST['valor_pago']))  {
	    $valor_pago = addslashes($_POST['valor_pago']);	
	} else {
	    $valor_pago = "no";	
	}
	
	if (isset($_POST['valor_deposito']))  {
	    $valor_deposito = addslashes($_POST['valor_deposito']);	
	} else {
	    $valor_deposito = "no";	
	}
	
	if (isset($_POST['reajustar_error']))  {
	    $reajustar_error = addslashes($_POST['reajustar_error']);	
	} else {
	    $reajustar_error = "no";	
	}
	
	
	//02 SELECCIONO EL VALOR DEL CAMPO saldos DEL ÚLTIMO REGISTRO INTRODUCIDO.  
	
	$query1 = "SELECT saldos FROM registro_bancario ORDER BY id DESC LIMIT 1";
	$query1 = mysql_query($query1);
	$num_row = mysql_num_rows($query1);
	if ( $num_row == 1 )  {
		$last_saldo = mysql_fetch_assoc($query1);
	} else {
	    echo mysql_error();	
	}
	
	 //03 SUMO O RESTO O OBTENGO EL VALOR QUE VOY A INTRODUCIR EN EL CAMPO saldos
	$old_saldo = stripslashes($last_saldo['saldos']);
	settype($old_saldo, 'float');
	settype($valor_pago, 'float');
	settype($valor_deposito, 'float');
	
	if ( $valor_deposito == "no" )   {
	    // significa que hubo un DÉBITO ( TENGO QUE RESTAR - )
	    $saldo_total = $old_saldo - $valor_pago;
	} else if ( $valor_deposito != "no" )  {
		// significa que hubo un CRÉDITO ( TENGO QUE SUMAR + )
	    $saldo_total = $old_saldo + $valor_deposito;
	}
	
	
	
	//04 INTRODUZCO LOS VALORES DEL FORMULARIO EN LA TABLA registro_bancario teniendo en cuenta el ** AJUSTAR ERROR **
	
	if ( $reajustar_error == "on" )  {
	    $query2 = "INSERT INTO registro_bancario ( fecha, descripcion, debitos, creditos, saldos, reajustar_error ) VALUES ('".$fecha."', '".$descripcion."', '".$valor_pago."', '".$valor_deposito."', '".$saldo_total."', 1)";
	} else if ( $reajustar_error = "no" )  {
		$query2 = "INSERT INTO registro_bancario ( fecha, descripcion, debitos, creditos, saldos, reajustar_error ) VALUES ('".$fecha."', '".$descripcion."', '".$valor_pago."', '".$valor_deposito."', '".$saldo_total."', 0)";
		
	}
	$query2 = mysql_query($query2);
	$num_rows_affected = mysql_affected_rows();
	if ( $num_rows_affected > 0 )  {
	    // Esto significa que se insertaron bien los datos en la BD. Envío un header con la información correcta 	
        
		header('Location: ../index.php?mod=mod_registro_bancario#tabs-5');
	
	} else { echo mysql_error(); }	
	
  
  }  // FIN DE LA FUNCIÓN process_form_bank()

//02
  function saldo_mes_anterior()
  {
	//Función que devuelve el saldo que quedó en la cuenta el mes anterior.
	// tengo la fecha actual
	$fecha = gmdate('d-m-Y', time() - 18000 );    // Variable de la fecha.
	$hora = gmdate('h:i a', time() - 18000 );     // Variable de la hora.
	settype($fecha, "string");
	settype($hora, "string");
	
	//01 Busco el valor del mes anterior con el año respectivo
	$mes_actual = substr($fecha,3,2); // Primero busco el valor del mes actual
	settype($mes_actual, "int");
	$ano_actual = substr($fecha,6,4); // Despues busco el valor del año actual
	settype($ano_actual, "int");
	
	if ( $mes_actual == 1 )  {
	    // Esto significa que estamos en enero y por lo tanto el mes anterior debe ser diciembre (12)
		$mes_anterior = 12;	
		$ano_anterior = $ano_actual - 1;
	} else {
	    // le resto 1 para saber el mes anterior
	    $mes_anterior = $mes_actual - 1;
		$ano_anterior = $ano_actual;
	}
	
	
	//02 Selecciono los registros que pertenecen al mes anterior.
	$query02 = "SELECT id, saldos FROM registro_bancario WHERE MONTH(fecha)= ".$mes_anterior." AND YEAR(fecha)=".$ano_anterior." ORDER BY id DESC LIMIT 1";
	$query02 = mysql_query($query02);
	$num_rows_query02 = mysql_num_rows($query02);  // <--- Estos son la cantidad de registros del mes anterior
	
	//03 Ahora debo buscar el último registro del mes anterior para ponerlo en el saldo del mes anterior. 
	if ($num_rows_query02 == 0 ) {
	   /* Esto significa que el mes anterior fue el anterior a comenzar a llevar los registros ( 0 registros )	
	      no puede suceder que no haya ningún movimiento bancario en un mes */
	   return "0.00";
	
	} else {
	   // Ahora busco el último id de los registros antes buscados y eso es el saldo.
	   $saldo_mes_anterior = mysql_fetch_assoc($query02);
	   
	   return $saldo_mes_anterior['saldos'];
	
	}
	
		  
  }
 
//03
  function  process_form_mes($mes_search,$ano_search) 
  {
	 // Función que devuelve los registros del mes y el año seleccionados por el usuario.
	 //01 Recibo las variables $_POST 
	 settype($mes_search, "int");
	 settype($ano_search, "int");
	 
	 //02 BUSCO EL MES DEL AÑO EN PALABRAS PARA ENVIARLO A LA VISTA.
	 switch($mes_search)
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
	 
	 //03 Busco el último registro (id) del mes/año que quiero buscar con una consulta a la BD. 
	 $query03 = "SELECT id FROM registro_bancario WHERE MONTH(fecha)=".$mes_search." AND YEAR(fecha)=".$ano_search." ORDER BY id DESC LIMIT 1";
	 $query03 = mysql_query($query03);
	 $num_rows_query03 = mysql_num_rows($query03);
	 if ( $num_rows_query03 == 1 ) {
	    // Esto significa que la consulta fue ok	 
	    $id_final = mysql_fetch_assoc($query03); // Este es el valor del id final del mes que quiero
	 
	 } else {
		 
	    $id_final['id'] = "0";
	    	 
	 }
	 
	 //04 Busco el primer registro (id) del mes/año que quiero buscar con una consulta a la BD.
	 $query031 = "SELECT id FROM registro_bancario WHERE MONTH(fecha)=".$mes_search." AND YEAR(fecha)=".$ano_search." ORDER BY id ASC LIMIT 1";
	 $query031 = mysql_query($query031);
	 $num_rows_query031 = mysql_num_rows($query031);
	 if ( $num_rows_query031 == 1 ) {
	    // Esto significa que la consulta fue ok	 
	    $id_inicial = mysql_fetch_assoc($query031); // Este es el valor del id final del mes que quiero
	 
	 } else {
		 
	    $id_inicial['id'] = "0";
	    	 
	 }
	 
	 //05 Busco el valor del saldo del mes anterior q estoy buscando. ( SIMILAR A LA FUNCIÓN 02 )
	 if ( $mes_search == 1 )  {
	    // Esto significa que estamos en enero y por lo tanto el mes anterior debe ser diciembre (12)
		$mes_anterior_search = 12;	
		$ano_anterior_search = $ano_search - 1;
	} else {
	    // le resto 1 para saber el mes anterior
	    $mes_anterior_search = $mes_search - 1;
		$ano_anterior_search = $ano_search;
	}
	 
	 $query032 = "SELECT id, saldos FROM registro_bancario WHERE MONTH(fecha)=".$mes_anterior_search." AND YEAR(fecha)=".$ano_anterior_search." ORDER BY id DESC LIMIT 1";
	 $query032 = mysql_query($query032);
	 $num_rows_query032 = mysql_num_rows($query032);
	 if ( $num_rows_query032 == 1 ) {
	    // Esto significa que la consulta fue ok	 
	    $saldo_search_mes_anterior = mysql_fetch_assoc($query032); // Este es el valor del id final del mes que quiero
	 
	 } else {
		 
	    $saldo_search_mes_anterior['saldos'] = "0.00";
	    	 
	 }
	
	 //06 devuelvo en un ARRAY los valores de $id_final, $id_inicial, $saldo_search_mes_anterior
	 $mes_ano_saldo[0] = $mes;
	 $mes_ano_saldo[1] = $ano_search;
	 $mes_ano_saldo[2] = stripslashes($saldo_search_mes_anterior['saldos']);
	 $mes_ano_saldo[3] = $id_final['id'];
	 $mes_ano_saldo[4] = $id_inicial['id'];
	 	 
	 return $mes_ano_saldo;
	   
  }  // fin de la función process_form_mes()
  
  //04 
  function process_bank_register_mes($id_final,$id_inicial) 
  {
	  // Función que devuelve los datos de los registros en el mes seleccionado.
      
	  //01 CONSULTA PARA SELECCIONAR TODOS LOS REGISTROS DEL MES SOLICITADO
	   $query_form_mes = "SELECT * FROM registro_bancario WHERE id >= ".$id_inicial." AND id <= ".$id_final." ORDER BY id DESC";
	   $query_form_mes = mysql_query($query_form_mes);
	   $num_rows_query_form_mes = mysql_num_rows($query_form_mes);
	   if ( $num_rows_query_form_mes > 0 )  {
	      for ( $i=0; $i < $num_rows_query_form_mes; $i++ )
	      {
		       $bank_register[$i] = mysql_fetch_assoc($query_form_mes); 	
	      }
	   
	      return $bank_register;
		  
	   } else { 
	      
		  return "null";
	   
	   }
   
  }  // Fin de la función process_bank_register_mes($a,$b)
 
  //05 
  function process_bank_register()
  {
	  // Función que devuelve todos los registros de la base de datos.
  
       //01 CONSULTA PARA MOSTRAR TODOS LOS MESES
       $query_form_bank = "SELECT * FROM registro_bancario ORDER BY id DESC";
	   $query_form_bank = mysql_query($query_form_bank);
	   $num_rows_query_form_bank = mysql_num_rows($query_form_bank);
	   if ( $num_rows_query_form_bank > 0 )  {
		   // Esto significa que hay registros en la BD.
	       for ( $i=0; $i < $num_rows_query_form_bank; $i++ )
	       {
		        $bank_register[$i] = mysql_fetch_assoc($query_form_bank); 	
	       }

           return $bank_register;
	      
	   } else {
		   
		   return "null";   
	   }
	   
  
  }  // Fin de la función process_bank_register()

  //06 
  function process_bank_register_mes_actual()
  {
	  // Función que devuelve todos los registros bancarios del mes actual.			    	 	
	 	
      //01 CONSULTA PARA MOSTRAR EL MES ACTUAL
      $fecha = gmdate('d-m-Y', time() - 18000 );    // Variable de la fecha.
	  settype($fecha, "string");
	  $mes_actual = substr($fecha,3,2);             // Busco el valor del mes actual
	  settype($mes_actual, "int");
	  
	  $query_form_bank = "SELECT * FROM registro_bancario WHERE MONTH(fecha)= ".$mes_actual." ORDER BY id DESC";
	  $query_form_bank = mysql_query($query_form_bank);
	  $num_rows_query_form_bank = mysql_num_rows($query_form_bank);
	  if ( $num_rows_query_form_bank > 0 )  {
		  
		  for ( $i=0; $i < $num_rows_query_form_bank; $i++ )
	      {
		       $bank_register[$i] = mysql_fetch_assoc($query_form_bank); 	
	      }
         
		  return $bank_register;
		   
	  } else {
		  
		  return "null";  
	  }
	 
  }  // Fin de la función process_bank_register_mes_actual()
  
   
/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_registro_bancario   *****/

  if ( isset($_GET['data']) && $_GET['data'] == "send" )  {
	  // Esto es cuando se envía el formulario de entrada de datos con los valores de las cuentas de banco.
	  process_form_bank();
  } 

?>