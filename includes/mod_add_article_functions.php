<?php
@session_start();
include_once('connection.php');

/****** ((00)) VARIABLES  *****/ #tabs-1
/************************
 Primer nivel:   Refieren al módulo en cuestion 
              mod=mod_add_article 
/************************
 Segundo nivel:  Refieren a si es:
                (1) Formulario de entrada de datos para ingresar un nuevo artículo ( articulo=new ) 
				(2) Mensaje de datos introducidos correctamente en la BD.          ( articulo=info ) 
 
*************************/ 

/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_add_article   *****/

//01   process_new_article_from_compras()  --> Función que procesa los datos para introducir nuevos artículos en la BD.

/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_inventario  *****/

/************************************************************************************************************/


/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_inventario  *****/
//01
  function process_new_article_from_compras()
  {
      // Función que procesa los datos para introducir nuevos artículos en la BD. 
	  
	  $fecha = gmdate('Y-m-d', time() - 18000 );
	  $nombre_completo = $_SESSION['nombre_completo'];
	  
	  //01 RECIBO LAS VARIABLES $_POST
      $codigo_art           = addslashes($_POST['codigo_art']);
	  $unidad_medida        = addslashes($_POST['unidad_medida']);
	  $referencia_art       = addslashes($_POST['referencia_art']);
	  $detalle_art          = addslashes($_POST['detalle_art']);
	  $proveedor_art        = addslashes($_POST['proveedor_art']);
	  $id_proveedor_art     = addslashes($_POST['id_proveedor_art']);
	  
	  $stock_actual         = "0";
	  $stock_minimo         = addslashes($_POST['stock_minimo']);
      
	  $precio_costo_art     = addslashes($_POST['precio_costo_art']);
      $precio_venta1        = addslashes($_POST['precio_venta1']);
	  $precio_venta2        = addslashes($_POST['precio_venta2']);
	  $precio_venta3        = addslashes($_POST['precio_venta3']);
      
	  //02 INSERTO LOS VALORES DE LAS VARIABLES POST EN LA TABLA articulos_inventario
      $query01 = "INSERT INTO articulos_inventario (codigo_art, referencia_art, detalle_art, proveedor_art, stock_minimo, precio_costo_art, precio_venta1, precio_venta2, precio_venta3, unidad_medida) VALUES ('".$codigo_art."', '".$referencia_art."', '".$detalle_art."', '".$id_proveedor_art."', '".$stock_minimo."', '".$precio_costo_art."', '".$precio_venta1."', '".$precio_venta2."', '".$precio_venta3."', '".$unidad_medida."')";
      $query01 = mysql_query($query01);
	  $id = mysql_insert_id();
      $num_row_query01 = mysql_affected_rows();
      if ( $num_row_query01 > 0 )  {
		  // Esto significa que se insertaron correctamete los datos en la BD.
		  
		  /*03 INSERTO EL STOCK ACTUAL=0 EN LA TABLA newbodega_1 que es la que me va a llevar el stock de los artículos de la BODEGA Y 
		       SIEMPRE AL INSERTAR UN NUEVO ARTÍCULO LA CANTIDAD ACTUAL VA AHÍ. */
		       $query012 = "INSERT INTO newbodega_1(id_codigo_art, stock_actual) VALUES('".$id."', '".$stock_actual."')";
		       $query012 = mysql_query($query012);
			   $num_row_query012 = mysql_affected_rows();
		       if ( $num_row_query012 > 0 )  {
				   // Esto significa que se insertó bien en la Base de Datos   
				   
				   /*04 INSERTO EL PRIMER MOVIMIENTO DE ESE ARTÍCULO EN LA BD COMO 'Primera entrada de artículo'  */
				        $query013 = "INSERT INTO movbodega_1(fecha_movimiento, id_codigo_articulo_mov, tipo_mov, concepto_mov, origen_mov_proveedor, destino_mov_cliente, cantidad_movimiento, observaciones_mov, persona_q_hace_mov, recibido, saldo ) VALUES('".$fecha."', '".$id."', 'Entrada', 'Primera entrada a la Bodega', '".$proveedor_art."', '', '".$stock_actual."', ' ', '".$nombre_completo."', 1 , '".$stock_actual."')";
		                $query013 = mysql_query($query013);
		                $num_row_query013 = mysql_affected_rows();
				        if ( $num_row_query013 > 0 )  {
						    // Esto significa que se insertó bien en la BD.	
														 
							 header('Location: ../index.php?mod=mod_add_article&articulo=info#tabs-1');
																		
						} else { echo mysql_error(); }
				   			   
			    } else { echo mysql_error(); }       
		  
	   } else { echo mysql_error(); }
  
  }  // Fin de la función process_new_article_from_compras


/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_add_article  *****/
  
  if ( isset($_GET['data']) && $_GET['data'] == "send" )   {
	  // Esto es para procesar los datos para insertar nuevos artículos  
	  process_new_article_from_compras();
  }
 
?> 