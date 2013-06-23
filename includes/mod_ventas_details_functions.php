<?php
include_once('connection.php');

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_ventas_details   *****/

//01 show_ventas_details($a,$b)    --> Función que carga los detalles de la compra de la TABLA registro_compras.
//02 (private) process_fecha_venta($a) --> Función que devuelve la fecha bien estructurada con palabras en los meses.
//03 show_ventas_details_articulos($a,$b) --> Función que devuelve los artículos de la venta de la TABLA movalmacen_($id).
//04 show_ventas_details_pagos($a,$b,$c)  --> Función que devuelve los detalles de PAGO de la venta de la tabla ventasalmacen_($id)
//05 show_detalles_cant_pagos_venta($a, $b); --> Función que devuelve el detalle de las cuentas x cobrar SELECCIONADA A CRÉDITO..

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_compras_details   *****/
//01
  function show_ventas_details($optid, $localv)
  {
	  // Función que carga los detalles de la venta de la TABLA 
	  
	  //01 Busco los datos Generales de la venta y chequeo si el cliente no está registrado. 
	  $query01 = "SELECT * FROM ventasalmacen_".$localv." WHERE ventasalmacen_".$localv.".id_venta='".$optid."'";
	  $query01 = @mysql_query($query01) or die(mysql_error());
	  $num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  // CASO 1: Esto significa que hay ventas en el día de HOY.	  
		  $data_venta = mysql_fetch_assoc($query01);
		  
		  //02 VERIFICO SI TIENE UN id_cliente_venta VÁLIDO DIFERENTE DE 0 ( caso 0 es cuando la venta es a un cualquiera ) 
		       if ( $data_venta['id_cliente_venta']  != "0" )  {
				
				   $query011 = "SELECT nombre FROM proveedores_clientes WHERE id=".$data_venta['id_cliente_venta']."";
				   $query011 = @mysql_query($query011) or die (mysql_error());
				   $num_rows_query011 = mysql_num_rows($query011);
				   if ( $num_rows_query011 > 0 )  {
					   // Se realizó bien la consulta.    
				       $nombre_usuario = mysql_fetch_assoc($query011);
				       $data_venta['nombre'] = $nombre_usuario['nombre'];
				   }
								   
			   } else {
				   
				   $data_venta['nombre'] = "Sin Detalle";  
				   
			   }  // Fin del if //02
		  
		  $fecha_venta = $data_venta['fecha_venta'];
		  $fecha_final = process_fecha_venta($fecha_venta);
		  
		  $data_venta['fecha_venta_detail'] = $fecha_final; 
		  	  
		  return $data_venta;   
	  	  
	  } // Fin del  if ( $num_rows_query01 > 0 )  { 
			  
  }  // Fin de la función show_ventas_details($optid, $localv)
    
//02 (private) 
  function process_fecha_venta($fecha_venta)
  {
	  // Función que devuelve la fecha bien estructurada con palabras en los meses.
      
	  settype($fecha_venta, "string");
	  $ano = substr($fecha_venta, 0, 4);
	  $mes = substr($fecha_venta, 5, 2);
	  $dia = substr($fecha_venta, 8, 2);
      
      //01 Busco el mes de la fecha de la compra.
	  switch($mes)
	  {
		  case "01":
		    $nombre_mes = "enero";
		  break;
		  case "02":
		    $nombre_mes = "febrero";
		  break; 
		  case "03":
		    $nombre_mes = "marzo";
		  break;
		  case "04":
		    $nombre_mes = "abril";
		  break;
		  case "05":
		    $nombre_mes = "mayo";
		  break; 
		  case "06":
		    $nombre_mes = "junio";
		  break;
		  case "07":
		    $nombre_mes = "julio";
		  break;
		  case "08":
		    $nombre_mes = "agosto";
		  break; 
		  case "09":
		    $nombre_mes = "septiembre";
		  break;
		  case "10":
		    $nombre_mes = "octubre";
		  break;
		  case "11":
		    $nombre_mes = "noviembre";
		  break; 
		  case "12":
		    $nombre_mes = "diciembre";
		  break;
		  
	  } // Fin del switch($mes)
       
	 $fecha_final = $dia." de ".$nombre_mes." de ".$ano."";
  
     return $fecha_final;
  
  }   // Fin de la función process_fecha_venta()
    
//03 
  function show_ventas_details_articulos($optid, $localv)
  { 
       // Función que devuelve los artículos de la venta de la TABLA movalmacen_($id). 
  
       //01 BUSCO TODOS LOS ARTÍCULOS DE LA COMPRA DE ACUERDO A SU 'NO DE COMPRA'.
	  $query03 = "SELECT movalmacen_".$localv.".*, articulos_inventario.referencia_art, articulos_inventario.codigo_art, movalmacen_".$localv.".cantidad_movimiento FROM movalmacen_".$localv.", articulos_inventario, ventasalmacen_".$localv." WHERE movalmacen_".$localv.".no_venta='".$optid."' AND articulos_inventario.id=movalmacen_".$localv.".id_codigo_articulo_mov AND ventasalmacen_".$localv.".id_venta=movalmacen_".$localv.".no_venta";
      $query03 = @mysql_query($query03) or die(mysql_error());
      $num_rows_query03 = mysql_num_rows($query03);
	  if ( $num_rows_query03 > 0 )  {
		  // Guado todos los artículos en un array.
		  for ( $i=0; $i < $num_rows_query03; $i++ )
		  {
			   $articulos[$i] = mysql_fetch_assoc($query03); 
		  } 
		  
		  return $articulos;
		   		  
	  }
     
  } // Fin de la función show_ventas_details_articulos($optid, $localv)
  
//04 
  function show_ventas_details_pagos($optid, $localv, $tipo_pago)
  {
	  //  Función que devuelve los detalles de PAGO de la venta de la tabla ventasalmacen_($id)
  
      //01 LEO DE LA TABLA ventasalmacen_(id) LO REFERENTE A LA VENTA EN CUESTIÓN.
	  $query04 = "SELECT * FROM ventasalmacen_".$localv." WHERE id_venta='".$optid."'";
	  $query04 = @mysql_query($query04) or die (mysql_error());
	  $num_rows_query04 = mysql_num_rows($query04);
	  if ( $num_rows_query04 > 0 )  {
		  // Esto significa que hay una fila en la BD y lo guardo todo en un array. 
	      $pagos = mysql_fetch_assoc($query04);
		  
	  } 
  
      //02 HAGO UN switch PARA VER QUE VARIABLES SON LAS QUE ENVÍO Y MUESTRO EN EL MÓDULO.
	  switch($tipo_pago)
      {
			case "contado":  // CASO 1: PAGO AL CONTADO.
		   
			     return $pagos;   // Todo lo que necesito para mostrar está en la TABLA ventas_detalles_pagos 
		     
            break;
			case "credito":  // CASO 2: PAGO A CRÉDITO.
			   
			     return $pagos;
						
			break;
			   
      }  // Fin de switch($tipo_pago)
	  
  }  // Fin de la función show_ventas_details_pagos($optid, $localv)
  
//05 
  function show_detalles_cant_pagos_venta($optid, $localv)
  {
	  // Función que devuelve el detalle de las cuentas x cobrar SELECCIONADA A CRÉDITO..
        
      //01 BUSCO LOS DATOS DE LOS DETALLES DE LAS CUENTAS X PAGAR REFERIDAS A ESTA COMPRA.
      $query05 = "SELECT * FROM cuentas_x_cobrar WHERE no_venta='".$optid."' AND local_venta='".$localv."'";
	  $query05 = @mysql_query($query05) or die(mysql_error());
	  $num_rows_query05 = mysql_num_rows($query05);
	  if ( $num_rows_query05 > 0 )  {
		  
		  for($i=0; $i < $num_rows_query05; $i++ )
		  {
		      $detalles_de_cxc[$i] = mysql_fetch_assoc($query05);
		  
		      $fecha_data = process_fecha($detalles_de_cxc[$i]['fecha_vencimiento']);
		      $detalles_de_cxc[$i]['fecha_vencimiento'] = $fecha_data;
		  
		  
		  } // Fin del for
		  
		  return $detalles_de_cxc;
		  
	  }  // Fin del  if ( $num_rows_query05 > 0 )  {
     
  } // Fin de la función show_detalles_cant_pagos_venta($optid, $localv)
     
?>  