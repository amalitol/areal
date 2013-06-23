<?php
include_once('connection.php');

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_compras_details   *****/

//01 show_compras_details($a)    --> Función que carga los detalles de la compra de la TABLA registro_compras.
//02 (private) process_fecha($a) --> Función que devuelve la fecha bien estructurada con palabras en los meses.
//03 show_compras_details_articulos($a) --> Función que devuelve los artículos de la compra de la TABLA compras_detalles_articulos.
//04 show_compras_details_pagos($a,$b)  --> Función que devuelve los detalles de PAGO de la compra de la tabla compras_detalles_pagos y otras...
//05 show_detalles_cant_pagos($a)  --> Función que devuelve los detalles de las cuentas por pagar de la compra seleccionada a CRÉDITO.

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_compras_details   *****/
//01
  function show_compras_details($optionid)
  {
	  // Función que carga los detalles de la compra de la TABLA 
  
      //01 Busco los Datos Gnerales de la Compra que quiero ver el reporte. 
      $query01 = "SELECT * FROM registro_compras, proveedores_clientes WHERE registro_compras.id='".$optionid."' AND registro_compras.id_proveedor_compra=proveedores_clientes.id";
	  $query01 = @mysql_query($query01) or die(mysql_error());
	  $num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  
		  $data_compra = mysql_fetch_assoc($query01);
		  
		  $fecha_compra = $data_compra['fecha_compra'];
		  $fecha_final = process_fecha($fecha_compra);
		  
		  $data_compra['fecha_compra_detail'] = $fecha_final; 
		    
		  return $data_compra;   
		  
	  }
  
  }  // Fin de la función show_compras_details()

  //02 (private) 
  function process_fecha($fecha_compra)
  {
	  // Función que devuelve la fecha bien estructurada con palabras en los meses.
      
	  settype($fecha_compra, "string");
	  $ano = substr($fecha_compra, 0, 4);
	  $mes = substr($fecha_compra, 5, 2);
	  $dia = substr($fecha_compra, 8, 2);
      
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
  
  }   // Fin de la función process_fecha()
  
//03 
  function show_compras_details_articulos($no_compra) 
  {
	  // Función que devuelve los artículos de la compra de la TABLA compras_detalles_articulos.
      
	  //01 bUSCO TODOS LOS ARTÍCULOS DE LA COMPRA DE ACUERDO A SU 'NO DE COMPRA'.
	  $query03 = "SELECT compras_detalles_articulos.numero_compra, compras_detalles_articulos.id_referencia_art, articulos_inventario.referencia_art, compras_detalles_articulos.codigo_art, compras_detalles_articulos.precio_costo_art, compras_detalles_articulos.cantidad_articulo, compras_detalles_articulos.valor_total_articulo FROM compras_detalles_articulos, articulos_inventario WHERE compras_detalles_articulos.numero_compra='".$no_compra."' AND articulos_inventario.id=compras_detalles_articulos.id_referencia_art";
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
   
  }  // Fin de la función show_compras_details_articulos($no_compra)

//04 
  function show_compras_details_pagos($no_compra, $tipo_pago)
  {
	  // Función que devuelve el detalles de PAGO de la compra de la tabla compras_detalles_pagos y otras.....
      
	  //01 LEO DE LA TABLA compras_detalles_pagos LO REFERENTE A LA COMPRA EN CUESTIÓN.
	  $query04 = "SELECT * FROM compras_detalles_pagos WHERE numero_compra='".$no_compra."'";
	  $query04 = @mysql_query($query04) or die (mysql_error());
	  $num_rows_query04 = mysql_num_rows($query04);
	  if ( $num_rows_query04 > 0 )  {
		  // Esto significa que hay una fila en la BD y lo guardo todo en un array. 
	      $pagos = mysql_fetch_assoc($query04);
		  
	  } 
  
      //02 HAGO UN switch PARA VER QUE VARIABLES SON LAS QUE ENVÍO Y MUESTTRO EN EL MÓDULO.
	  switch($tipo_pago)
      {
			case "contado":  // CASO 1: PAGO AL CONTADO.
		   
			     return $pagos;   // Todo lo que necesito para mostrar está en la TABLA compras_detalles_pagos 
		     
            break;
			case "credito":  // CASO 2: PAGO A CRÉDITO.
			   
			     return $pagos;
						
			break;
			   
      }  // Fin de switch($tipo_pago)
	 	 
  }   // Fin de la función show_compras_details_pagos($no_compra) 

//05 
  function show_detalles_cant_pagos($no_compra)
  {
	  // Función que devuelve los detalles de las cuentas por pagar de la compra seleccionada a CRÉDITO.
  
      //01 BUSCO LOS DATOS DE LOS DETALLES DE LAS CUENTAS X PAGAR REFERIDAS A ESTA COMPRA.
      $query05 = "SELECT * FROM cuentas_x_pagar WHERE no_orden_de_compra='".$no_compra."'";
	  $query05 = @mysql_query($query05) or die(mysql_error());
	  $num_rows_query05 = mysql_num_rows($query05);
	  if ( $num_rows_query05 > 0 )  {
		  
		  for($i=0; $i < $num_rows_query05; $i++ )
		  {
		      $detalles_de_cxp[$i] = mysql_fetch_assoc($query05);
		  
		      $fecha_data = process_fecha($detalles_de_cxp[$i]['fecha_vencimiento']);
		      $detalles_de_cxp[$i]['fecha_vencimiento'] = $fecha_data;
		  		  
		  } // Fin del for
		  
		  return $detalles_de_cxp;
		  
	  }  // Fin del  if ( $num_rows_query05 > 0 )  {
   
  }   // Fin de la función show_detalles_cant_pagos($no_compra)
 
?>