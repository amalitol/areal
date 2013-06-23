<?php
@session_start();
include_once('connection.php');

/****** ((00)) VARIABLES  *****/ #tabs-3
/************************
 Primer nivel:   Refieren al módulo en cuestion 
              mod=mod_inventario 
/************************
 Segundo nivel:  Refieren a los elementos del menu superior     Refieren a las acciones a realizar a un artículo
             (1) optioninv=administrar                                      (6) art=new
			 (2) optioninv=mov                                              (7) art=edit
             (3) optioninv=kardex                                           (8) art=detalle
			 (4) optioninv=stock   
		     (5) optioninv=mov_invres 
/************************
  Tercer nivel(I):  Refieren a los elementos que voy a mostrar dentro de un elemento del menu superior				 
             De (1) etype= (error_bodega_ok) (true_new_almacen) (error_bodega_no) (true_new_bodega) (success) 
             De (2) movtype= (ok)
             De (3) karart= (ver)  --> No lleva header... <--
             De (4) stockl= (ver)  --> No lleva header... <-- 
			 De (5) resmov= (ver)  --> No lleva header... <--

  Tercer nivel(II):  Refieren a al cantidad de movimientos pendientes seleccionados e insertados en sus respectivas TABLAS				 
             De (4) stockins= (#)  --> 1, 2, 3, 4 <--  
/************************			 
  Cuarto nivel:  Refieren al id del artículo del cual voy a ver los detalles.			 
             De (8) id= (#)  --> 1, 2, 3, 4 <--  

				 
/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_inventario   *****/

//01 articulos_inventario()            --> Función que muestra todos los artículos que están actualmente en la BD.
//02 process_new_article()             --> Función que procesa el formulario para agregar un NUEVO artículo.
//03 ver_articulo()                    --> Función que devuelve los datos del artículo a EDITAR seleccionado por el usuario.
//04 process_edit_articulo()           --> Función que procesa el formulario para EDITAR el articulo seleccionado.
//05 show_locales()                    --> Función que muestra todos los locales que están actualmente en la BD.
//06 process_new_local()               --> Función que procesa el formulario de NUEVO/EDITAR local para los inventarios.
//07 process_new_mov()                 --> Función que procesa el formulario de NUEVO movimiento para un artículo.
//08 private salida_bodega($a, $b)     --> Función que inserta y actualiza los datos de la SALIDA de artículos de la BODEGA.
//09 private entrada_pendientes($a)    --> Función que inserta y actualiza los datos de la ENTRADA  de artículos al ALMACÉN seleccionado.
//10 show_pendientes()                 --> Función que muestra todos los MOVIMIENTOS pendientes DEL LOCAL SELECCIONADO.
//11 private entrada_bodega($a)        --> Función que inserta y actualiza los datos de la ENTRADA de artículos en la BODEGA.
//12 private salida_almacen($a, $b)    --> Función que inserta y actualiza los datos de la SALIDA de artículos del ALMACÉN seleccionado.
//13 process_kardex()                  --> Función que procesa los datos del REPORTE del Kardex de un artículo en en un local determinado 
//14 process_resumen_mov_inv()         --> Función que muestra el Resumen del movimiento de inventario para el local seleccionado. 	 
//15 process_stock($a)                   --> Función que muestra el Stock del local seleccionado. 	 
//16 process_art_pendientes()          --> Función que procesa los datos para insertar nuevas ENTRADAS en la tabla del local selecc. 
//17 private check_stock_almacen($a,$b)--> Función que chequea si existe el artículo seleccionado en el stock del almacén.
//18 private check_stock_bodega($a,$b) --> Función que devuelve la cantidad de artículos del stock de la BODEGA. 
//19 private insert_mov_almacen($a,$b,$c)--> Función que inserta el movimiento de ENTRADA al ALMACÉN. 
//20 private insert_mov_bodega($a,$b,$c)-->  Función que inserta el movimiento de ENTRADA a la BODEGA. 
//21 detalle_articulo()                --> Función que devuelve los detalles de la tabla articulos_inventario del artículo seleccionado
//22 stocks_articulo()                 --> Función que devuelve la cantidad de artículos en stock de cada LOCAL para el art. seleccionado
//23 show_local_name($a)                 --> Función que muesttra el nombre de un local de acuerdo a si id ( pantalla princ. usuario VENDEDOR ).
//24 show_bodega_or_not()   --> Función q carga si se puede o no poner el valor de la BODEGA en el <select> a la hora de insertar un nuevo LOCAL. 


/*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_inventario  *****/

/************************************************************************************************************/


/*****((01)) DECLARACIÓN DE FUNCIONES DEL mod_inventario  *****/
//01
  function articulos_inventario()
  {
	  // Función que muestra todos los artículos que están actualmente en la BD.
	 //01 Selecciono todos los artículos que estén en la BD 
	  $query01 = "SELECT articulos_inventario.id, articulos_inventario.codigo_art, articulos_inventario.referencia_art, articulos_inventario.detalle_art, proveedores_clientes.nombre, articulos_inventario.stock_minimo, articulos_inventario.precio_costo_art, articulos_inventario.precio_venta1, articulos_inventario.precio_venta2, articulos_inventario.precio_venta3, articulos_inventario.unidad_medida, articulos_inventario.deshabilitar, newbodega_1.stock_actual FROM articulos_inventario, proveedores_clientes, newbodega_1 WHERE articulos_inventario.proveedor_art=proveedores_clientes.id   AND articulos_inventario.id=newbodega_1.id_codigo_art ORDER BY articulos_inventario.referencia_art ASC";
	  $query01 = mysql_query($query01);
	  @$num_rows_query01 = mysql_num_rows($query01);
	  if ( $num_rows_query01 > 0 )  {
		  
		  // Esto significa que hay artículos en la tabla de BD y los guardo en un array para devolverlos
		  for ( $i=0; $i < $num_rows_query01; $i++ )
		  {
		      $registro_articulos[$i] = mysql_fetch_assoc($query01);
		  }
	  	  
	  } else {
		 //02 Si no hay proveedores devuelvo un valor nulo. 
		 return "null";
		   
	  }
	  
	  //03 Si hay artículos en la base de datos devuelvo los regsitros de estos.  
	  return $registro_articulos;
		  	  
  }  // Fin de la función articulos_inventario()

//02 
  function process_new_article() 
  {
	  // Función que procesa el formulario para agregar un NUEVO artículo.
	  
      $fecha = gmdate('Y-m-d', time() - 18000 );
	  $nombre_completo = addslashes($_SESSION['nombre_completo']);
	  
	  //01 RECIBO LAS VARIABLES $_POST
      $codigo_art           = addslashes($_POST['codigo_art']);
	  $unidad_medida        = addslashes($_POST['unidad_medida']);
	  $referencia_art       = addslashes($_POST['referencia_art']);
	  $detalle_art          = addslashes($_POST['detalle_art']);
	  $proveedor_art        = addslashes($_POST['proveedor_art']);
	  $id_proveedor_art     = addslashes($_POST['id_proveedor_art']);
	  
	  $stock_actual         = addslashes($_POST['stock_actual']);
	  $stock_minimo         = addslashes($_POST['stock_minimo']);
      
	  $precio_costo_art     = addslashes($_POST['precio_costo_art']);
      $precio_venta1        = addslashes($_POST['precio_venta1']);
	  $precio_venta2        = addslashes($_POST['precio_venta2']);
	  $precio_venta3        = addslashes($_POST['precio_venta3']);
      
	  //02 INSERTO LOS VALORES DE LAS VARIABLES POST EN LA TABLA articulos_inventario
      $query02 = "INSERT INTO articulos_inventario (codigo_art, referencia_art, detalle_art, proveedor_art, stock_minimo, precio_costo_art, precio_venta1, precio_venta2, precio_venta3, unidad_medida) VALUES ('".$codigo_art."', '".$referencia_art."', '".$detalle_art."', '".$id_proveedor_art."', '".$stock_minimo."', '".$precio_costo_art."', '".$precio_venta1."', '".$precio_venta2."', '".$precio_venta3."', '".$unidad_medida."')";
      $query02 = mysql_query($query02);
      $id = mysql_insert_id();
	  $num_row_query02 = mysql_affected_rows();
      if ( $num_row_query02 > 0 )  {
		  // Esto significa que se insertaron correctamete los datos en la BD.
		  
		  /*03 INSERTO EL STOCK ACTUAL EN LA TABLA newbodega_1 que es la que me va a llevar el stock de los artículos de la BODEGA Y 
		       SIEMPRE AL INSERTAR UN NUEVO ARTÍCULO LA CANTIDAD ACTUAL VA AHÍ. */
		       $query021 = "INSERT INTO newbodega_1(id_codigo_art, stock_actual) VALUES('".$id."', '".$stock_actual."')";
		       $query021 = mysql_query($query021);
		       $num_row_query021 = mysql_affected_rows();
		       if ( $num_row_query021 > 0 )  {
				   // Esto significa que se insertó bien en la Base de Datos   
				   
				   /*04 INSERTO EL PRIMER MOVIMIENTO DE ESE ARTÍCULO EN LA BD COMO 'Primera entrada de artículo'  */
				        $query022 = "INSERT INTO movbodega_1(fecha_movimiento, id_codigo_articulo_mov, tipo_mov, concepto_mov, origen_mov_proveedor, destino_mov_cliente, cantidad_movimiento, observaciones_mov, persona_q_hace_mov, recibido, saldo ) VALUES('".$fecha."', '".$id."', 'Entrada', 'Primera entrada a la Bodega', '".$proveedor_art."', '', '".$stock_actual."', ' ', '".$nombre_completo."', 1 , '".$stock_actual."')";
		                $query022 = mysql_query($query022);
		                $num_row_query022 = mysql_affected_rows();
				        if ( $num_row_query022 > 0 )  {
						    // Esto significa que se insertó bien en la BD.	
							
							 header('Location: ../index.php?mod=mod_inventario#tabs-3');
												
						} else { echo mysql_error(); }
				   			   
			   } else { echo mysql_error(); }       
		  
	  } else { echo mysql_error(); }
   
  }  // Fin de la función process_new_article()   
 
//03
  function ver_articulo()
  {
	  // Función que devuelve los datos del artículo a EDITAR seleccionado por el usuario.
   
      $id = $_GET['id'];
	  
	  $query03 = "SELECT articulos_inventario.*, proveedores_clientes.nombre FROM articulos_inventario, proveedores_clientes WHERE articulos_inventario.id='".$id."' AND proveedores_clientes.id=articulos_inventario.proveedor_art";
      $query03 = mysql_query($query03);
	  $num_rows_query03 = mysql_num_rows($query03);
      if ( $num_rows_query03 == 1 )  {
		  
		  $registro_articulo = mysql_fetch_assoc($query03);  
		  return $registro_articulo;
		  
	  } else { echo mysql_error(); }
   
  }  // Fin de la función ver_articulo()
  
//04 
  function process_edit_articulo()
  {
	  // Función que procesa el formulario para EDITAR el articulo seleccionado.
      //01 RECIBO LAS VARIABLES $_POST
      $codigo_art           = addslashes($_POST['codigo_art']);
	  $unidad_medida        = addslashes($_POST['unidad_medida']);
	  $referencia_art       = addslashes($_POST['referencia_art']);
	  $detalle_art          = addslashes($_POST['detalle_art']);
	  $stock_minimo         = addslashes($_POST['stock_minimo']);
      $precio_costo_art     = addslashes($_POST['precio_costo_art']);
      $precio_venta1        = addslashes($_POST['precio_venta1']);
	  $precio_venta2        = addslashes($_POST['precio_venta2']);
	  $precio_venta3        = addslashes($_POST['precio_venta3']);
  
      $id_articulo          = $_POST['id_articulo'];    // campo hidden con el id del articulo que voy a UPDATE
  
      //02 UPDATE EN LA BD articulos_inventario.
	  $query04 = "UPDATE articulos_inventario SET codigo_art='".$codigo_art."', referencia_art='".$referencia_art."', detalle_art='".$detalle_art."', stock_minimo='".$stock_minimo."', precio_costo_art='".$precio_costo_art."', precio_venta1='".$precio_venta1."', precio_venta2='".$precio_venta2."', precio_venta3='".$precio_venta3."', unidad_medida='".$unidad_medida."' WHERE id='".$id_articulo."'";
	  $query04 = @mysql_query($query04) or die(mysql_error());
	  
	     //05 Si se insertó correctamente entonces devuelvo un header  
		 header('Location: ../index.php?mod=mod_inventario#tabs-3');
		   
  }    // Fin de la función process_edit_articulo()
    
//05 
  function show_locales()
  {
	  // Función que muestra todos los locales que están actualmente en la BD.
  
      //01 Selecciono todos los locales (BODEGA Y ALMACENES) que estén en la BD 
	  $query05 = "SELECT * FROM locales_inventarios ORDER BY id ASC";
	  $query05 = mysql_query($query05);
	  $num_rows_query05 = mysql_num_rows($query05);
	  if ( $num_rows_query05 > 0 )  {
		  
		  // Esto significa que hay LOCALES en la tabla de BD y los guardo en un array para devolverlos
		  for ( $i=0; $i < $num_rows_query05; $i++ )
		  {
		      $registro_locales[$i] = mysql_fetch_assoc($query05);
		  }
	  	  
	  } else {
		 //02 Si no hay LOCALES devuelvo un valor nulo. 
		 return "null";
		   
	  }
	  
	  //03 Si hay LOCALES en la base de datos devuelvo los regsitros de estos.  
	  return $registro_locales;  
  
  }   // Fin de la función show_locales()
    
//06 
  function process_new_local()
  {
	  //  Función que procesa el formulario de NUEVO/EDITAR local para los inventarios.
      //01 RECIBO LAS VARIABLES $_POST
      $nombre_local           = addslashes($_POST['nombre_local']);
	  $direccion_local        = addslashes($_POST['direccion_local']);
	  $telefono_local         = addslashes($_POST['telefono_local']);
	  $tipo_local             = addslashes($_POST['tipo_local']);
	  	  
	  $nombre_responsable     = addslashes($_POST['nombre_responsable']);
	  $telefono_responsable   = addslashes($_POST['telefono_responsable']);
	  $cell_responsable       = addslashes($_POST['cell_responsable']);
      $email_responsable      = addslashes($_POST['email_responsable']);
	    
      $id_local               = $_POST['id_local'];    // campo hidden con el id del local que voy a UPDATE
                                                       // sino voy a editar el valor es "nuevo"
 
       //02 VERIFICO QUE SEA UNA INSERCIÓN NUEVA
	  switch($id_local)
	  {
		  case "nuevo":
		    // 02.1 Cuando voy a insertar un nuevo local.
		    		
			$query1 = "SELECT id FROM locales_inventarios WHERE tipo_local='bodega'";
		    $query1 = mysql_query($query1);
		    $num_row_query1 = mysql_num_rows($query1);
			// CASO 1
			if ( $num_row_query1 > 0 )  {
			    // Esto significa que ya hay un local del tipo bodega en BD( y sólo puede haber 1 )	
			    //02.10 Busco el valor del campo tipo_local
				if ( $tipo_local == "bodega" )  {
				    // Esto significa que el usuario quiere insertar otra BODEGA en el sistema ( ERROR )	
				    // y solo puede haber una BODEGA		   
				   	header('Location: ../index.php?mod=mod_inventario&optioninv=administrar&etype=error_bodega_ok#tabs-3');
						   
				} else if ( $tipo_local == "almacen" ) {
					// Esto significa que voy a insertar un local tipo ALMACÉN( puedo hacerlo pues ya hay una BODEGA)  
				    $query2 = "INSERT INTO locales_inventarios( nombre_local, direccion_local, telefono_local, tipo_local, nombre_responsable, telefono_responsable, cell_responsable, email_responsable ) VALUES ( '".$nombre_local."', '".$direccion_local."', '".$telefono_local."', '".$tipo_local."', '".$nombre_responsable."', '".$telefono_responsable."', '".$cell_responsable."', '".$email_responsable."')";
                    $query2 = mysql_query($query2);
                    $id = mysql_insert_id();                   /* Para el nombre de la tabla ALAMCEN */
					$num_rows_query2 = mysql_affected_rows();
                    if ( $num_rows_query2 == 1 )  {
                        // Insertado correctamente en la BD
						
						//Primero CREO LA TABLA DE DATOS PARA EL STOCK DE ESTE ALMACÉN que va a tener el formato de nombre de newalmacen_(id)
					    $query21 = "CREATE TABLE newalmacen_".$id." ( 
	                                id                   int unsigned NOT NULL PRIMARY KEY auto_increment, 
                                    id_codigo_art        int NOT NULL,
									stock_actual         float(9,2),
									index(id_codigo_art)
									);";
                        $query21 = @mysql_query($query21) or die(mysql_error()); 
					
						//Segundo CREO LA TABLA PARA LOS MOVIMIENTOS DE ESTE ALMACÉN que va atener el formato de movalmacen_(id)
						$query22 = "CREATE TABLE movalmacen_".$id." ( 
	                                id                        int unsigned NOT NULL PRIMARY KEY auto_increment, 
                                    fecha_movimiento          date,
                                    id_codigo_articulo_mov    int NOT NULL,
                                    tipo_mov                  varchar(15), 
                                    concepto_mov              varchar(30),
                                    origen_mov_proveedor      varchar(100),   
									destino_mov_cliente       varchar(100),    
									cantidad_movimiento       float(9,2),   
									observaciones_mov         varchar(500),
									no_venta                  int,
									persona_q_hace_mov        varchar(100),
									recibido                  bit,
									saldo                     float(9,2)
									                          
                                    );";
                        $query22 = @mysql_query($query22) or die(mysql_error());  
						
						//Tercero CREO LA TABLA PARA LOS MOVIMIENTOS DE CAJA DE ESTE ALMACÉN con el formato de cajaalmacen_(id)
						$query23 = "CREATE TABLE cajaalmacen_".$id." ( 
	                                id                          int unsigned NOT NULL PRIMARY KEY auto_increment, 
                                    fecha_transaccion           date,
                                    tipo_transaccion            varchar(20),
									origen_transaccion          varchar(100),
									destino_transaccion         varchar(100),
									cantidad_transaccion        float(9,2),
									observaciones               varchar(500),   
									no_venta                    int,
									persona_q_hace_transaccion  varchar(100),
									recibido                    bit,
									saldo                       float(9,2) 
																                          
                                    );";
                        $query23 = @mysql_query($query23) or die(mysql_error());  
						
						//Cuarto CREO LA TABLA PARA LOS DATOS GENERALES Y PAGOS DE LAS VENTAS DE ESTE ALMACÉN con el formato de ventasalmacen_(id)
						$query24 = "CREATE TABLE ventasalmacen_".$id." ( 
	                                id_venta                    int unsigned NOT NULL PRIMARY KEY auto_increment, 
                                    fecha_venta                 date,
                                    numero_factura              varchar(20),
									id_cliente_venta            int,
									cantidad_articulos          float(9,2),
									forma_de_pago               varchar(15),
									monto_de_la_venta           float(9,2),
									descuento                   float(9,2),
									valor_de_la_venta_real      float(9,2),
									observaciones               varchar(500),
									persona_q_hace_la_venta     varchar(100),
									saldo_inicial               float(9,2),
                                    saldo_del_credito           float(9,2),
                                    cantidad_de_pagos           int
                                    																					                          
                                    );";
                        $query24 = @mysql_query($query24) or die(mysql_error());  
																					 
							 /****** mensaje de OK *******/
						     header('Location: ../index.php?mod=mod_inventario&optioninv=administrar&etype=true_new_almacen#tabs-3');
						
					} else {
	                    echo mysql_error();
						
                    }
						
				}
					
		    // CASO 2
			} else if ( $num_row_query1 == 0 )  {
			    // Esto significa que no existe ninguna bodega 	
				if ( $tipo_local == "almacen" ) {
				    // Esto significa que se quiere insertar un ALMACÉN en el sistema(ERROR PUES PRIMERO DEBE HABER UNA BODEGA)	
				   header('Location: ../index.php?mod=mod_inventario&optioninv=administrar&etype=error_bodega_no#tabs-3');
				   			   
				}  else if ( $tipo_local == "bodega" )  {
				    // Esto significa que voy a insertar un local tipo BODEGA( puedo hacerlo pues ya no hay una BODEGA)  
				    $query3 = "INSERT INTO locales_inventarios( nombre_local, direccion_local, telefono_local, tipo_local, nombre_responsable, telefono_responsable, cell_responsable, email_responsable ) VALUES ( '".$nombre_local."', '".$direccion_local."', '".$telefono_local."', '".$tipo_local."', '".$nombre_responsable."', '".$telefono_responsable."', '".$cell_responsable."', '".$email_responsable."')";
                    $query3 = mysql_query($query3);
                    $idb = mysql_insert_id();      /* 	PARA EL NOMBRE DE LA TABLA BODEGA */
					$num_rows_query3 = mysql_affected_rows();
                    if ( $num_rows_query3 == 1 )  {
                        // Insertado correctamente en la BD
						
						//Primero CREO LA TABLA DE DATOS PARA EL STOCK DE ESTA BODEGA que va a tener el formato de nombre de newbodega_(id)
					    $query31 = "CREATE TABLE newbodega_".$idb." ( 
	                                id                   int unsigned NOT NULL PRIMARY KEY auto_increment, 
                                    id_codigo_art        int NOT NULL,
									stock_actual         float(9,2),
									index(id_codigo_art)
									);";
                        $query31 = @mysql_query($query31) or die(mysql_error()); 
					
						//Segundo CREO LA BASE DE DATOS PARA LOS MOVIMIENTOS DE ESTA BODEGA que va atener el formato de movbodega_(id)
						$query32 = "CREATE TABLE movbodega_".$idb." ( 
	                                id                        int unsigned NOT NULL PRIMARY KEY auto_increment, 
                                    fecha_movimiento          date,
                                    id_codigo_articulo_mov    int NOT NULL,
                                    tipo_mov                  varchar(15), 
                                    no_orden_de_compra        int,
									concepto_mov              varchar(30),
                                    origen_mov_proveedor      varchar(100),   
									destino_mov_cliente       varchar(100),    
									cantidad_movimiento       float(9,2),   
									observaciones_mov         varchar(500),
									persona_q_hace_mov        varchar(100),
									recibido                  bit,
									saldo                     float(9,2) 
                                    );";
                        $query32 = @mysql_query($query32) or die(mysql_error());  
												
						     /****** mensaje de OK *******/
						     header('Location: ../index.php?mod=mod_inventario&optioninv=administrar&etype=true_new_bodega#tabs-3');
						
                    } else {
	                    echo mysql_error();
						
                    }
								
				}
				
			}
		  		  
		  break;
	 	  default: 
	         //02.2 Cuando voy a editar un local seleccionado (LOS VALORES SON 1,2,3,4,5,6....). 	  
   		     $query4 = "UPDATE locales_inventarios SET nombre_local='".$nombre_local."', direccion_local='".$direccion_local."', telefono_local='".$telefono_local."', nombre_responsable='".$nombre_responsable."', telefono_responsable='".$telefono_responsable."', cell_responsable='".$cell_responsable."', email_responsable='".$email_responsable."' WHERE id='".$id_local."'";
             $query4 = mysql_query($query4);
              // UPDATE correctamente en la BD
			 header('Location: ../index.php?mod=mod_inventario&optioninv=administrar&etype=success#tabs-3');
		   break;
	  }   // Fin del switch($id_local)
       
  }   // Fin de la función process_new_local()
 
//07 
  function process_new_mov()
  {
	  // Función que procesa el formulario de NUEVO movimiento para un artículo.
  
      $nombre_completo = $_SESSION['nombre_completo'];
	  
	  //01 RECIBO LAS VARIABLES POST
      $arr = $_POST;
	  /******* VARIABLES QUE SE RECIBEN  ********/
	  $fecha_movimiento       = addslashes($_POST['fecha_movimiento']);
	  $select_type            = $_POST['select_type'];              // Este es el valor del radiobotón -->  'por_descripcion'
	  $descripcion_articulo   = addslashes($_POST['descripcion_articulo']);
	  
	  $codigo_articulo_mov    = addslashes($_POST['codigo_articulo_mov']);    // CAMPO HIDDEN CON EL VALOR DEL CÓDIGO DEL ARTÍCULO.
	  $stock_origen_hidden    = $_POST['stock_origen_hidden'];    // CAMPO HIDDEN CON EL VALOR DEL STOCK ACTUAL DEL ORIGEN.
	  $stock_destino_hidden   = $_POST['stock_destino_hidden'];  // CAMPO HIDDEN CON EL VALOR DEL STOCK ACTUAL DEL DESTINO.
	  $nombre_local_origen    = addslashes($_POST['nombre_local_origen']);  // CAMPO HIDDEN CON EL VALOR DEL NOMBRE DEL LOCAL EN EL ORIGEN
	  $nombre_local_destino   = addslashes($_POST['nombre_local_destino']); // CAMPO HIDEN CON EL VALOR DEL NOMBRE DEL LOCAL EN EL DESTINO
	  
	  $concepto_mov           = $_POST['concepto_mov']; // VALORES: seleccione, movimiento_inv, ajuste_inv, otros
	  $concepto_mov_letras    = $_POST['concepto_mov_letras']; // CAMPO HIDDEN CON EL VALOR DEL CONCEPTO DE MOVIMIENTO EN LETRAS
	  
	  $origen_mov             = $_POST['origen_mov'];   // VALORES: seleccione, 1, 2, 3, 4, ....., otros
	  $destino_mov            = $_POST['destino_mov'];  // VALORES: seleccione, 1, 2, 3, 4, ....., otros
	  
	  $cantidad_movimiento    = addslashes($_POST['cantidad_movimiento']);
      $observaciones_mov      = addslashes($_POST['observaciones_mov']);
	     
	   //02 INTRODUZCO LOS VALORES DEL MOVIMIENTO EN CADA UNA DA LA TABLAS 
	    /*  I)   INSERT un movimiento de Salida en la tabla ORIGEN.
		            CASO bodega => function salida_bodega;  
			II)  INSERT un movimiento de Entrada en la tabla DESTINO.
		    III) UPDATE el stock en la tabla de stock como una Salida (ORIGEN).
		    IV)  UPDATE el stock en la tabla de stock como una Entrada (DESTINO).
		 */    
      
	   //02.1 HAGO UN SWITCH PARA SABER EL SALDO DEL ARTÍCULO EN SU RESPECTIVO LOCAL EN EL ORIGEN
	        switch($origen_mov)
			{
			   case "1":
			   // CASO DE QUE EL ORIGEN SEA LA BODEGA
			      
				  				  
				  // Llamo a esta función que me introduce los datos de SALIDA en la TABLA STOCK(newbodega_1) y MOVIMIENTO(movbodega_1)
				  $salida_bodega = salida_bodega($arr, $nombre_completo); 
				  if ( $salida_bodega == "true" )  {
					  // Esto significa que se insertaron bien los DATOS EN LAS 2 TABLAS.   
				      /************************************************************************************************
						    Ahora busco insertar los datos en las tablas de DESTINO 
					   ***********************************************************************************************
					   HAGO UN SWITCH PARA VER LAS POSIBLES OPCIONES DE INSERCIÓN DEL ARTÍCULO EN SU RESPECTIVO LOCAL EN EL DESTINO */
	                   switch($destino_mov)
			           {
			              case "1":
			              //A) CASO DE QUE EL DESTINO SEA LA BODEGA ( BODEGA -> BODEGA no puede ser )
			              /******** ESTO NO PUEDE SUCEDER *******/
		        	      break;
			              case "otros":
			              //B) CASO DE QUE EL DESTINO SEA OTRO LOCAL NO PERTENECIENTE AL NEGOCIO 
			              /******** AQUÍ NO SUCEDE NADA PUES EL MOVIMIENTO ES HACIA UN LUGAR QUE NO ESTÁ EN EL NEGOCIO *****/
						        header('Location: ../index.php?mod=mod_inventario&optioninv=mov&movtype=ok#tabs-3'); 
						  break;
			              default:
			              //C) CASO DE QUE EL DESTINO SEA UN ALMACÉN
					            $entrada_almacen = entrada_pendientes($arr);
                                if ( $entrada_almacen == "true" )  {
								    // Esto significa que se insertaron bien los DATOS EN LAS 2 TABLAS.   
									header('Location: ../index.php?mod=mod_inventario&optioninv=mov&movtype=ok#tabs-3'); 
														
								} 	// Fin del if ( $entrada_almacen == "true" )  {					       
					      break;
					   }  // Fin del switch($destino_mov)
				  
				  }  // Fin del if ( $salida_bodega == "true" )  {
				
			   break;  
			   case "otros":
			        // CASO DE QUE EL ORIGEN SEA OTRO LOCAL NO PERTENECIENTE AL NEGOCIO ( switch($origen_mov) ) 
				    /*************************************************************************************************************
				                 EN ESTE CASO NO TENGO QUE HACER NINGUN MOVIMIENTO DE SALIDA 
				    *************************************************************************************************************/
			        // HAGO UN SWITCH PARA VER LAS POSIBLES OPCIONES DE INSERCIÓN DEL ARTÍCULO EN SU RESPECTIVO LOCAL EN EL DESTINO */
	                switch($destino_mov)
			        {
			           case "1":
			                //A) CASO DE QUE EL DESTINO SEA LA BODEGA 
			                /**************************************************************************************************************
					        TENIENDO EN CUENTA QUE TODOS LOS ARTÍCULOS UNA VEZ CREADOS DEBEN APARECER EN LA BODEGA NO HACEMOS EL CHEQUEO
					        DE SI EXISTE EL STOCK DE ESE ARTÍCULO EN LA BODEGA Y PASAMOS DIRECTAMENTE AL INSERT(movbodega_1) y al UPDATE(new)
					        ***************************************************************************************************************/
					        $entrada_bodega = entrada_pendientes($arr);
					        if ( $entrada_bodega == "true" )  {
							    // Esto significa que se insertaron bien los DATOS EN LAS 2 TABLAS.   
							    header('Location: ../index.php?mod=mod_inventario&optioninv=mov&movtype=ok#tabs-3');  
							 	
							}
					   				   
					   break;
					   case "otros":
			               //B) CASO DE QUE EL DESTINO SEA OTRO LOCAL NO PERTENECIENTE AL NEGOCIO ( OTROS -> OTROS no puede ser )
			               /******** ESTO NO PUEDE SUCEDER  *****/
					         
					   break;
					   default:
			               //C) CASO DE QUE EL DESTINO SEA UN ALMACÉN
					       $entrada_almacen = entrada_pendientes($arr);
                           if ( $entrada_almacen == "true" )  {
							   // Esto significa que se insertaron bien los DATOS EN LAS 2 TABLAS.   
							   header('Location: ../index.php?mod=mod_inventario&optioninv=mov&movtype=ok#tabs-3'); 
														
						   } 	// Fin del if ( $entrada_almacen == "true" )  {			
			           break;
				    } // Fin del switch($destino_mov)
			   
			     break;
			     default:
			        // CASO DE QUE EL ORIGEN SEA UN ALMACÉN  ( switch($origen_mov) )
			        // Llamo a esta función que introduce los datos de SALIDA en la TABLA STOCK(newalamcen_(id))y MOVIMIENTO(movalmacen_(id))
				    $salida_almacen = salida_almacen($arr, $nombre_completo); 
				    if ( $salida_almacen == "true" )  {
					   // Esto significa que se insertaron bien los DATOS EN LAS 2 TABLAS.   
				       /************************************************************************************************
						          Ahora busco insertar los datos en las tablas de DESTINO 
					   ***********************************************************************************************
					   HAGO UN SWITCH PARA VER LAS POSIBLES OPCIONES DE INSERCIÓN DEL ARTÍCULO EN SU RESPECTIVO LOCAL EN EL DESTINO */
	                   switch($destino_mov)
				       {
			           case "1":
			                //A) CASO DE QUE EL DESTINO SEA LA BODEGA 
			                /**************************************************************************************************************
					        TENIENDO EN CUENTA QUE TODOS LOS ARTÍCULOS UNA VEZ CREADOS DEBEN APARECER EN LA BODEGA NO HACEMOS EL CHEQUEO
					        DE SI EXISTE EL STOCK DE ESE ARTÍCULO EN LA BODEGA Y PASAMOS DIRECTAMENTE AL INSERT(movbodega_1) y al UPDATE(new)
					        ***************************************************************************************************************/
					        $entrada_bodega = entrada_pendientes($arr);
					        if ( $entrada_bodega == "true" )  {
							    // Esto significa que se insertaron bien los DATOS EN LAS 2 TABLAS.   
							    header('Location: ../index.php?mod=mod_inventario&optioninv=mov&movtype=ok#tabs-3');  
							 	
							}
					   				   
					   break;
				       case "otros":
			                //B) CASO DE QUE EL DESTINO SEA OTRO LOCAL NO PERTENECIENTE AL NEGOCIO 
			                /******** AQUÍ NO SUCEDE NADA PUES EL MOVIMIENTO ES HACIA UN LUGAR QUE NO ESTÁ EN EL NEGOCIO *****/
					        header('Location: ../index.php?mod=mod_inventario&optioninv=mov&movtype=ok#tabs-3');  
					   break;
				       default:
			               //C) CASO DE QUE EL DESTINO SEA UN ALMACÉN
					       $entrada_almacen = entrada_pendientes($arr);
                           if ( $entrada_almacen == "true" )  {
							   // Esto significa que se insertaron bien los DATOS EN LAS 2 TABLAS.   
							   header('Location: ../index.php?mod=mod_inventario&optioninv=mov&movtype=ok#tabs-3'); 
														
						   } 	// Fin del if ( $entrada_almacen == "true" )  {			
			           break;
					   }   // Fin del switch($destino_mov)
				   
				  }   // Fin del if ( $salida_almacen == "true" )  {
				  break;
			}  // Fin del switch($origen_mov)
	 
  }   // Fin de la función process_new_mov()
   
//08 private                      -> Sólo se llama en la función //07  <-
  function salida_bodega($arr, $nombre_completo)
  {
	  // Función que inserta y actualiza los datos de la SALIDA de artículos de la BODEGA.
          
		  // RECIBO LAS VARIABLES $_POST y las llevo a float para hacer las operaciones.
		  $stock_origen_hidden  = $arr['stock_origen_hidden'];
		  settype($stock_origen_hidden, "float");     // saldo de la tabla newbodega_1 (de la BD)
    	  
		  $cantidad_movimiento  = $arr['cantidad_movimiento'];
		  settype($cantidad_movimiento, "float");     // Cantidad de artículos a MOVER
				   
		  $saldo_origen_final = $stock_origen_hidden - $cantidad_movimiento;  // Esto es saldo final en el ORIGEN
			  
	      //01 Busco el id del artículo q voy a hacer el movimiento PARA INSERTARLO EN movbodega_1.
	      $query8 = "SELECT id FROM articulos_inventario WHERE codigo_art='".addslashes($arr['codigo_articulo_mov'])."'";
	      $query8 = mysql_query($query8);
		  $num_rows_query8 = mysql_num_rows($query8);
	      if ( $num_rows_query8 > 0 )  {
			  // Esto significa que la seleccion fue correcta y lo guardo en un ARRAY.
			  $id = mysql_fetch_assoc($query8);
			  
		  } else { echo mysql_error(); }
		     
	   // I) INSERT un movimiento de Salida en la tabla ORIGEN. 
		  $query81 = "INSERT INTO movbodega_".$arr['origen_mov']."(fecha_movimiento, id_codigo_articulo_mov, tipo_mov, concepto_mov, origen_mov_proveedor, destino_mov_cliente, cantidad_movimiento, observaciones_mov, persona_q_hace_mov, recibido, saldo) VALUES('".addslashes($arr['fecha_movimiento'])."', '".$id['id']."', 'Salida', '".addslashes($arr['concepto_mov_letras'])."', '', '".addslashes($arr['nombre_local_destino'])."', ".$cantidad_movimiento.", '".addslashes($arr['observaciones_mov'])."', '".$nombre_completo."', 1, ".$saldo_origen_final.")";
		  $query81 = mysql_query($query81); 
		  $num_rows_query81 = mysql_affected_rows();
		  if ( $num_rows_query81 > 0 )  {
			  // Esto significa que se insertó correctamente la fila en la BD   
			  // III) UPDATE el stock en la tabla de stock como una Salida (ORIGEN).
			  $query82 = "UPDATE newbodega_".$arr['origen_mov']." SET stock_actual=".$saldo_origen_final." WHERE id_codigo_art='".$id['id']."'";
			  $query82 = mysql_query($query82); 
			  $num_rows_query82 = mysql_affected_rows();
			  if ( $num_rows_query82 > 0 )   {
			      
				  return "true";
			  
			  } else { echo mysql_error(); }   // Esto es un ERROR de inserción en la BD.  
			  					   
		  } else  { echo mysql_error(); }      // Esto es un ERROR de inserción en la BD.
	  
  }   // Fin de la función private salida_bodega() 
  
//09 private 
  function entrada_pendientes($arr)
  {  
       // Función que inserta y actualiza los datos de la ENTRADA  de artículos al ALMACÉN seleccionado.       
       
	   // RECIBO LAS VARIABLES $_POST y las llevo a float para hacer las operaciones.
	   $stock_destino_hidden  = $arr['stock_destino_hidden'];
	   settype($stock_destino_hidden, "float");         //saldo de la tabla newalmacen_(id)
    	  
	   $cantidad_movimiento  = $arr['cantidad_movimiento'];
	   settype($cantidad_movimiento, "float");          // Cantidad de artículos a MOVER
				   
	   $saldo_destino_final = $stock_destino_hidden + $cantidad_movimiento;   // Esto es saldo final en el DESTINO
				   
	   $destino_mov = addslashes($arr['destino_mov']);                     // para enviar a la function check_stock_almacen()
	   $codigo_articulo_mov = addslashes($arr['codigo_articulo_mov']);     // para enviar a la function check_stock_almacen()
	      
	   //01 Busco el id del artículo q voy a hacer el movimiento PARA INSERTARLO EN movalmacen_(id).
	   $query8 = "SELECT id FROM articulos_inventario WHERE codigo_art='".addslashes($arr['codigo_articulo_mov'])."'";
	   $query8 = mysql_query($query8);
	   $num_rows_query8 = mysql_num_rows($query8);
	   if ( $num_rows_query8 > 0 )  {
		  // Esto significa que la seleccion fue correcta y lo guardo en un ARRAY.
		  $id = mysql_fetch_assoc($query8);
			  
	   } else { echo mysql_error(); }
		      
	   // II)  INSERT un movimiento de Entrada en la tabla DESTINO. 
	   $query91 = "INSERT INTO articulos_pendientes_de_entrada (id_local, id_codigo_articulo_mov, fecha_salida, concepto_mov, origen_mov_proveedor, cantidad_movimiento, observaciones_mov, recibido) VALUES('".$arr['destino_mov']."', '".$id['id']."', '".addslashes($arr['fecha_movimiento'])."', '".addslashes($arr['concepto_mov_letras'])."', '".addslashes($arr['nombre_local_origen'])."', ".$cantidad_movimiento.", '".addslashes($arr['observaciones_mov'])."', 0)"; 
	   $query91 = mysql_query($query91);
	   $num_rows_query91 = mysql_affected_rows();
	   if ( $num_rows_query91 > 0 )  {
	   	  // Esto significa que se insertó correctamente la fila en la TABLA movalmacen_(id)   
           return "true";
	   } else { echo mysql_error(); }   // fin del if ( $num_rows_query91 > 0 )  {
 	  
   }  // Fin de la función entrada_almacen($arr)
  
//10.
   function show_pendientes($tipo_usuario)
   {
	  // Función que muestra todos los MOVIMIENTOS pendientes DEL LOCAL SELECCIONADO.
     
	  //01 HAGO UN switch PARA SELECCIONAR EL TIPO DE USUARIO QUE VOY A VER PARA HACER LA CONSULTA PUES:
	  /*
	     usuario 'a' -> El administrador sólo puede ver esto en la PESTAÑA STOCK.
		 usuario 'v' -> El vendedor lo vé en su pantalla principal de INVENTARIO.
	  */
	  switch($tipo_usuario) 
	  {   
	     case "a":    // CASO ADMINISTRADOR.
	        //02 Recibo las variables $_POST
	       $arr = $_POST;
           $stock_selected = $arr['local_stock'];    // CASO 1. En este caso el stock lo hago por consulta
		 
		 break;
	     case "v":     // CASO VENDEDOR.
	       //03 Verifico la variable de SESSIÓN.
	       $stock_selected = $_SESSION['id_local'];  // CASO 2. En este caso el stcok aparece en la primera pantalla.
	   
	     break;  
	  
	  
	  }  // Fin del switCh
	   
	       if( isset($stock_selected) )  {
              // Esto es para que introduzca un error si no se envían variables $_POST
          
		      //03 Hago la consulta con los artículos que están pendientes de ser vistos en le STOCK
	          $query16 = "SELECT articulos_pendientes_de_entrada.id, articulos_pendientes_de_entrada.id_codigo_articulo_mov, articulos_pendientes_de_entrada.fecha_salida,  articulos_inventario.codigo_art, articulos_inventario.referencia_art, articulos_pendientes_de_entrada.concepto_mov, articulos_pendientes_de_entrada.origen_mov_proveedor, articulos_pendientes_de_entrada.cantidad_movimiento, articulos_pendientes_de_entrada.observaciones_mov FROM articulos_pendientes_de_entrada, articulos_inventario WHERE articulos_pendientes_de_entrada.id_codigo_articulo_mov=articulos_inventario.id AND articulos_pendientes_de_entrada.id_local='".$stock_selected."' AND articulos_pendientes_de_entrada.recibido=0 ORDER BY articulos_pendientes_de_entrada.id ASC";
		      $query16 = mysql_query($query16);
		      $num_rows_query16 = mysql_num_rows($query16);
	          if ( $num_rows_query16 > 0 )  {
		          // Esto significa que ARTÍCULOS EN EL STOCK DE LA BODEGA y los guardo en un array para devolverlos
		              				
			      for ( $i=0; $i < $num_rows_query16; $i++ )
		          {
		              $entradas_pendientes[$i] = mysql_fetch_assoc($query16);
		          }
   
                  return $entradas_pendientes;
		      } else {
					  
				  return "null";  
		      }
			 
	   }   // Fin del if( isset($arr['local_stock']) )  {
	     
   }  // Fin de la función show_pendientes()  
    
//11 private 
   function entrada_bodega($arr)
   {
	   // Función que inserta y actualiza los datos de la ENTRADA de artículos en la BODEGA.
       
	   // RECIBO LAS VARIABLES $_POST y las llevo a float para hacer las operaciones.
	   $stock_destino_hidden  = $arr['stock_destino_hidden'];
	   settype($stock_destino_hidden, "float");         //saldo de la tabla newalmacen_(id)
    	  
	   $cantidad_movimiento  = $arr['cantidad_movimiento'];
	   settype($cantidad_movimiento, "float");          // Cantidad de artículos a MOVER
				   
	   $saldo_destino_final = $stock_destino_hidden + $cantidad_movimiento;   // Esto es saldo final en el DESTINO
				   
	   $destino_mov = addslashes($arr['destino_mov']);                     // para enviar a la function check_stock_almacen()
	   $codigo_articulo_mov = addslashes($arr['codigo_articulo_mov']);     // para enviar a la function check_stock_almacen()
	     
       //01 Busco el id del artículo q voy a hacer el movimiento PARA INSERTARLO EN movalmacen_(id).
	   $query8 = "SELECT id FROM articulos_inventario WHERE codigo_art='".addslashes($arr['codigo_articulo_mov'])."'";
	   $query8 = mysql_query($query8);
	   $num_rows_query8 = mysql_num_rows($query8);
	   if ( $num_rows_query8 > 0 )  {
		  // Esto significa que la seleccion fue correcta y lo guardo en un ARRAY.
		  $id = mysql_fetch_assoc($query8);
			  
	   } else { echo mysql_error(); }
	     
	   // II)  INSERT un movimiento de Entrada en la tabla DESTINO. 
	   $query11 = "INSERT INTO movbodega_".$arr['destino_mov']."(fecha_movimiento, id_codigo_articulo_mov, tipo_mov, concepto_mov, origen_mov_proveedor, destino_mov_cliente, cantidad_movimiento, observaciones_mov, persona_q_hace_mov, recibido, saldo) VALUES('".addslashes($arr['fecha_movimiento'])."', '".$id['id']."', 'Entrada', '".$arr['concepto_mov_letras']."', '".addslashes($arr['nombre_local_origen'])."', '', '".$cantidad_movimiento."', '".addslashes($arr['observaciones_mov'])."', '', 0, '".$stock_destino_hidden."')";
       $query11 = mysql_query($query11); 
	   $num_rows_query11 = mysql_affected_rows();
	   if ( $num_rows_query11 > 0 )  {
		  // Esto significa que se insertó correctamente la fila en la BD   
		  return "true";
			  
	   } else { echo mysql_error(); }  //  Fin del if ( $num_rows_query11 > 0 )  {	          
		   
   }  // Fin de la función entrada_bodega()
  
//12 private 
   function salida_almacen($arr, $nombre_completo)
   {
	   // Función que inserta y actualiza los datos de la SALIDA de artículos del ALMACÉN seleccionado.
       $stock_origen_hidden  = $arr['stock_origen_hidden'];
	   settype($stock_origen_hidden, "float");     // saldo de la tabla newbodega_1 (de la BD)
    	  
	   $cantidad_movimiento  = $arr['cantidad_movimiento'];
	   settype($cantidad_movimiento, "float");     // Cantidad de artículos a MOVER
				   
	   $saldo_origen_final = $stock_origen_hidden - $cantidad_movimiento;  // Esto es saldo final en el ORIGEN
  	   
	   //01 Busco el id del artículo q voy a hacer el movimiento PARA INSERTARLO EN movalmacen_(id).
	   $query8 = "SELECT id FROM articulos_inventario WHERE codigo_art='".addslashes($arr['codigo_articulo_mov'])."'";
	   $query8 = mysql_query($query8);
	   $num_rows_query8 = mysql_num_rows($query8);
	   if ( $num_rows_query8 > 0 )  {
		  // Esto significa que la seleccion fue correcta y lo guardo en un ARRAY.
		  $id = mysql_fetch_assoc($query8);
			  
	   } else { echo mysql_error(); }	   
	      
	   // I) INSERT un movimiento de Salida en la tabla ORIGEN. 
	   $query12 = "INSERT INTO movalmacen_".$arr['origen_mov']."(fecha_movimiento, id_codigo_articulo_mov, tipo_mov, concepto_mov, origen_mov_proveedor, destino_mov_cliente, cantidad_movimiento, observaciones_mov, persona_q_hace_mov, recibido, saldo) VALUES('".addslashes($arr['fecha_movimiento'])."', '".$id['id']."', 'Salida', '".$arr['concepto_mov_letras']."', '', '".addslashes($arr['nombre_local_destino'])."', '".$cantidad_movimiento."', '".addslashes($arr['observaciones_mov'])."', '".$nombre_completo."', 1, '".$saldo_origen_final."')";
	   $query12 = mysql_query($query12); 
	   $num_rows_query12 = mysql_affected_rows();
	   if ( $num_rows_query12 > 0 )  {
		   // Esto significa que se insertó correctamente la fila en la BD   
		   // III) UPDATE el stock en la tabla de stock como una Salida (ORIGEN).
		   $query121 = "UPDATE newalmacen_".$arr['origen_mov']." SET stock_actual='".$saldo_origen_final."' WHERE id_codigo_art='".$id['id']."'";
		   $query121 = mysql_query($query121); 
		   $num_rows_query121 = mysql_affected_rows();
		   if ( $num_rows_query121 > 0 )  {
			  /* Esto significa que se INSERTÓ correctamente la TABLA 
			  ENVÍO MENSAJE DE INSERTADO CORRECTAMENTE   */		         
			  return "true";					 
		
		   } else {  echo mysql_error();  }  // Esto es un ERROR de inserción en la BD.
			  
	   } else { echo mysql_error(); }  //  Fin del if ( $num_rows_query11 > 0 )  {	          
		 
   }  // Fin de la función salida_almacen($arr, $nombre_completo)
        
//13 
   function process_kardex()
   {
	   // Función que procesa los datos del REPORTE del Kardex de un artículo en en un local determinado 
   
       //01 Recibo las variables $_POST[] ó $_GET[]
	   if ( isset($_GET['inv']) && $_GET['inv'] == "2" )  {
		   // CASO 1: PARA IMPRESIÓN.    
		   $arr['local_kardex']                      = $_GET['id'];       // id del Local.
		   $arr['referencia_articulo_kardex_hidden'] = $_GET['desc'];     // Referencia artículo.
		   $arr['codigo_articulo_kardex']            = $_GET['cod'];      // Código del artículo.
		   $arr['fecha_inicial']                     = $_GET['fi'];       // Fecha Inicial.
		   $arr['fecha_final']                       = $_GET['ff'];       // Fecha Final.
		   $arr['nombre_local_kardex']               = $_GET['name'];     // Nombre del Local.
		   
	   } else {
		   // CASO 2: PARA EL TRABAJO CON EL SISTEMA.
	       $arr = $_POST;
	   
	   }
	        
	  if( isset($arr['local_kardex']) )  {
         // Esto es para que introduzca un error si no se envían variables $_POST
			
		 //02 Busco el id del artículo q voy a hacer el movimiento PARA INSERTARLO EN movalmacen_(id).
	     $query8 = "SELECT id FROM articulos_inventario WHERE codigo_art='".addslashes($arr['codigo_articulo_kardex'])."'";
	     $query8 = mysql_query($query8);
	     $num_rows_query8 = mysql_num_rows($query8);
	     if ( $num_rows_query8 > 0 )  {
		    // Esto significa que la seleccion fue correcta y lo guardo en un ARRAY.
		    $id = mysql_fetch_assoc($query8);
			  
	     } else { echo mysql_error(); }
			    
	   //03 Hago la consulta de acuerdo los datos introducidos en el formulario
       switch($arr['local_kardex'])
	   {
	       case "1":
	            // Esto es para el caso de que el local seleccioando sea la BODEGA
			    $query13 = "SELECT * FROM movbodega_1 WHERE id_codigo_articulo_mov='".$id['id']."' AND fecha_movimiento BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY id DESC";
                $query13 = mysql_query($query13);
		        $num_rows_query13 = mysql_num_rows($query13);
				if ( $num_rows_query13 > 0 )  {
		            // Esto significa que hay MOV. DE ESE ARTÍCULO y los guardo en un array para devolverlos
		            // LOS PRIMEROS ELEMENTOS DEL ARRAY SON LOS DATOS QUE ENVIÉ PARA LA CONSULTA
					//$kardex_articulo[0]['fecha_movimiento'] = $arr['descripcion_articulo'];   // Descripción del artículo
										
					for ( $i=0; $i < $num_rows_query13; $i++ )
		            {
		                 $kardex_articulo[$i] = mysql_fetch_assoc($query13);
		            }
	            
				    return $kardex_articulo;
				} else {
		            //02 Si no hay ARTÍCULOS EN ESTE LOCAL devuelvo un valor nulo. 
		            				
					return "null";
		        }
						   
		   break;
		   default:
		        // Esto es para el caso de que el local seleccionado sea un ALMACÉN.
		        $query131 = "SELECT * FROM movalmacen_".$arr['local_kardex']." WHERE id_codigo_articulo_mov='".$id['id']."' AND fecha_movimiento BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY id DESC";
                $query131 = mysql_query($query131);
		        $num_rows_query131 = mysql_num_rows($query131);
				if ( $num_rows_query131 > 0 )  {
		            // Esto significa que hay MOV. DE ESE ARTÍCULO y los guardo en un array para devolverlos
		            for ( $i=0; $i < $num_rows_query131; $i++ )
		            {
		                 $kardex_articulo[$i] = mysql_fetch_assoc($query131);
		            }
	            
				    return $kardex_articulo;
				} else {
		            //02 Si no hay ARTÍCULOS EN ESTE LOCAL devuelvo un valor nulo. 
		            return "null";
		        }
		   
		   break;
	   }  // Fin  del switch()
   
	  } else {
		
		  return "error";  
		  
	  }// Fin del if( isset($_ass) )  {
   
   }   // Fin de la función process_kardex()
  
//14
   function process_resumen_mov_inv()
   {
	   // Función que muestra el Resumen del movimiento de inventario para el local seleccionado. 	
   
       //01 Recibo las variables $_POST[] ó $_GET[]
       if ( isset($_GET['inv']) && $_GET['inv'] == "3" )  {
		   // CASO 1: VISTA DE IMPRESIÓN DE LOS DATOS.
	       $arr['local_resmov']  = $_GET['id'];     // id del Local.
	       $arr['fecha_inicial'] = $_GET['fi'];     // Fecha Inicial.
		   $arr['fecha_final']   = $_GET['ff'];     // Fecha Final.
		   $arr['ver_solo'] = $_GET['son'];        // Ver sólo Entradas, Salidas o Entradas y Salidas.
	     
	   } else {
		   // CASO 2: PONER DATOS EN LA WEB.
		   $arr = $_POST; 
	   } 
	  
	  
	  
	 
      if( isset($arr['local_resmov']) )  {
         // Esto es para que introduzca un error si no se envían variables $_POST
		    
	   //02 Hago la consulta de acuerdo los datos introducidos en el formulario
       switch($arr['local_resmov'])
	   {
	       case "1":
	            // CASO 1
				// Esto es para el caso de que el local seleccioando sea la BODEGA
			    switch($arr['ver_solo'])
				{
				   case "entradas":
				        //A)
						$query141 = "SELECT movbodega_1.id, movbodega_1.fecha_movimiento, articulos_inventario.codigo_art, articulos_inventario.referencia_art, movbodega_1.tipo_mov, movbodega_1.concepto_mov, movbodega_1.origen_mov_proveedor, movbodega_1.destino_mov_cliente, movbodega_1.cantidad_movimiento, movbodega_1.observaciones_mov, movbodega_1.persona_q_hace_mov, movbodega_1.recibido, movbodega_1.saldo FROM movbodega_1, articulos_inventario WHERE tipo_mov='Entrada' AND movbodega_1.id_codigo_articulo_mov=articulos_inventario.id AND movbodega_1.fecha_movimiento BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY movbodega_1.id DESC";
                        $query141 = mysql_query($query141);
		                $num_rows_query141 = mysql_num_rows($query141);
				        if ( $num_rows_query141 > 0 )  {
		                    // Esto significa que hay MOV. DE ESE ARTÍCULO y los guardo en un array para devolverlos
		            				
					        for ( $i=0; $i < $num_rows_query141; $i++ )
		                    {
		                         $res_movinv[$i] = mysql_fetch_assoc($query141);
		                    }
	            
				            return $res_movinv;
				        } else {
		                     //02 Si no hay ARTÍCULOS EN ESTE LOCAL devuelvo un valor nulo. 
		            				
					         return "null";
		                }
				   
				   break;
				   case "salidas":
				        //B)
				        $query142 = "SELECT movbodega_1.id, movbodega_1.fecha_movimiento, articulos_inventario.codigo_art, articulos_inventario.referencia_art, movbodega_1.tipo_mov, movbodega_1.concepto_mov, movbodega_1.origen_mov_proveedor, movbodega_1.destino_mov_cliente, movbodega_1.cantidad_movimiento, movbodega_1.observaciones_mov, movbodega_1.persona_q_hace_mov, movbodega_1.recibido, movbodega_1.saldo FROM movbodega_1, articulos_inventario WHERE tipo_mov='Salida' AND movbodega_1.id_codigo_articulo_mov=articulos_inventario.id AND movbodega_1.fecha_movimiento BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY movbodega_1.id DESC";
											
						$query142 = mysql_query($query142);
		                $num_rows_query142 = mysql_num_rows($query142);
				        if ( $num_rows_query142 > 0 )  {
		                    // Esto significa que hay MOV. DE ESE ARTÍCULO y los guardo en un array para devolverlos
		            				
					        for ( $i=0; $i < $num_rows_query142; $i++ )
		                    {
		                         $res_movinv[$i] = mysql_fetch_assoc($query142);
		                    }
	            
				            return $res_movinv;
				        } else {
		                     //02 Si no hay ARTÍCULOS EN ESTE LOCAL devuelvo un valor nulo. 
		            				
					         return "null";
		                }
				   break;
				   case "ambos":
				        //C)
				        $query143 = "SELECT movbodega_1.id, movbodega_1.fecha_movimiento, articulos_inventario.codigo_art, articulos_inventario.referencia_art, movbodega_1.tipo_mov, movbodega_1.concepto_mov, movbodega_1.origen_mov_proveedor, movbodega_1.destino_mov_cliente, movbodega_1.cantidad_movimiento, movbodega_1.observaciones_mov, movbodega_1.persona_q_hace_mov, movbodega_1.recibido, movbodega_1.saldo FROM movbodega_1, articulos_inventario WHERE movbodega_1.id_codigo_articulo_mov=articulos_inventario.id AND movbodega_1.fecha_movimiento BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY movbodega_1.id DESC";
                        $query143 = mysql_query($query143);
		                $num_rows_query143 = mysql_num_rows($query143);
				        if ( $num_rows_query143 > 0 )  {
		                    // Esto significa que hay MOV. DE ESE ARTÍCULO y los guardo en un array para devolverlos
		            				
					        for ( $i=0; $i < $num_rows_query143; $i++ )
		                    {
		                         $res_movinv[$i] = mysql_fetch_assoc($query143);
		                    }
	            
				            						
							return $res_movinv;
				        } else {
		                     //02 Si no hay ARTÍCULOS EN ESTE LOCAL devuelvo un valor nulo. 
		            				
					         return "null";
		                }
				
			       break;
						
				}   // Fin del switch($arr['ver_solo'])
			
		   break;
		   default:
		        // CASO 2 (final)
				// Esto es para el caso de que el local seleccionado sea un ALMACÉN.
		        switch($arr['ver_solo'])
				{
				   case "entradas":
				        //A)
				        $query144 = "SELECT movalmacen_".$arr['local_resmov'].".id, movalmacen_".$arr['local_resmov'].".fecha_movimiento, articulos_inventario.codigo_art, articulos_inventario.referencia_art, movalmacen_".$arr['local_resmov'].".tipo_mov, movalmacen_".$arr['local_resmov'].".concepto_mov, movalmacen_".$arr['local_resmov'].".origen_mov_proveedor, movalmacen_".$arr['local_resmov'].".destino_mov_cliente, movalmacen_".$arr['local_resmov'].".cantidad_movimiento, movalmacen_".$arr['local_resmov'].".observaciones_mov, movalmacen_".$arr['local_resmov'].".persona_q_hace_mov, movalmacen_".$arr['local_resmov'].".recibido, movalmacen_".$arr['local_resmov'].".saldo FROM movalmacen_".$arr['local_resmov'].", articulos_inventario WHERE tipo_mov='Entrada' AND movalmacen_".$arr['local_resmov'].".id_codigo_articulo_mov=articulos_inventario.id AND movalmacen_".$arr['local_resmov'].".fecha_movimiento BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY movalmacen_".$arr['local_resmov'].".id DESC";
                        					
						$query144 = mysql_query($query144);
		                $num_rows_query144 = mysql_num_rows($query144);
				        if ( $num_rows_query144 > 0 )  {
		                    // Esto significa que hay MOV. DE ESE ARTÍCULO y los guardo en un array para devolverlos
		                for ( $i=0; $i < $num_rows_query144; $i++ )
		                {
		                     $res_movinv[$i] = mysql_fetch_assoc($query144);
		                }
	            
				        return $res_movinv;
				        } else {
		                     //02 Si no hay MOVIMIENTOS EN ESTE LOCAL devuelvo un valor nulo. 
		                    return "null";
		                }
				   
				   break;
				   case "salidas":
				        //B)
						$query145 = "SELECT movalmacen_".$arr['local_resmov'].".id, movalmacen_".$arr['local_resmov'].".fecha_movimiento, articulos_inventario.codigo_art, articulos_inventario.referencia_art, movalmacen_".$arr['local_resmov'].".tipo_mov, movalmacen_".$arr['local_resmov'].".concepto_mov, movalmacen_".$arr['local_resmov'].".origen_mov_proveedor, movalmacen_".$arr['local_resmov'].".destino_mov_cliente, movalmacen_".$arr['local_resmov'].".cantidad_movimiento, movalmacen_".$arr['local_resmov'].".observaciones_mov, movalmacen_".$arr['local_resmov'].".persona_q_hace_mov, movalmacen_".$arr['local_resmov'].".recibido, movalmacen_".$arr['local_resmov'].".saldo FROM movalmacen_".$arr['local_resmov'].", articulos_inventario WHERE tipo_mov='Salida' AND movalmacen_".$arr['local_resmov'].".id_codigo_articulo_mov=articulos_inventario.id AND movalmacen_".$arr['local_resmov'].".fecha_movimiento BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY movalmacen_".$arr['local_resmov'].".id DESC";
                        					
						$query145 = mysql_query($query145);
		                $num_rows_query145 = mysql_num_rows($query145);
				        if ( $num_rows_query145 > 0 )  {
		                    // Esto significa que hay MOV. DE ESE ARTÍCULO y los guardo en un array para devolverlos
		                for ( $i=0; $i < $num_rows_query145; $i++ )
		                {
		                     $res_movinv[$i] = mysql_fetch_assoc($query145);
		                }
	            
				        return $res_movinv;
				        } else {
		                     //02 Si no hay MOVIMIENTOS EN ESTE LOCAL devuelvo un valor nulo. 
		                    return "null";
		                }
						
				   break;
				   case "ambos":
				        //C)
				        $query146 = "SELECT movalmacen_".$arr['local_resmov'].".id, movalmacen_".$arr['local_resmov'].".fecha_movimiento, articulos_inventario.codigo_art, articulos_inventario.referencia_art, movalmacen_".$arr['local_resmov'].".tipo_mov, movalmacen_".$arr['local_resmov'].".concepto_mov, movalmacen_".$arr['local_resmov'].".origen_mov_proveedor, movalmacen_".$arr['local_resmov'].".destino_mov_cliente, movalmacen_".$arr['local_resmov'].".cantidad_movimiento, movalmacen_".$arr['local_resmov'].".observaciones_mov, movalmacen_".$arr['local_resmov'].".persona_q_hace_mov, movalmacen_".$arr['local_resmov'].".recibido, movalmacen_".$arr['local_resmov'].".saldo FROM movalmacen_".$arr['local_resmov'].", articulos_inventario WHERE movalmacen_".$arr['local_resmov'].".id_codigo_articulo_mov=articulos_inventario.id AND movalmacen_".$arr['local_resmov'].".fecha_movimiento BETWEEN '".addslashes($arr['fecha_inicial'])."' AND '".addslashes($arr['fecha_final'])."' ORDER BY movalmacen_".$arr['local_resmov'].".id DESC";
                        					
						$query146 = mysql_query($query146);
		                $num_rows_query146 = mysql_num_rows($query146);
				        if ( $num_rows_query146 > 0 )  {
		                    // Esto significa que hay MOV. DE ESE ARTÍCULO y los guardo en un array para devolverlos
		                for ( $i=0; $i < $num_rows_query146; $i++ )
		                {
		                     $res_movinv[$i] = mysql_fetch_assoc($query146);
		                }
	            
				        return $res_movinv;
				        } else {
		                     //02 Si no hay MOVIMIENTOS EN ESTE LOCAL devuelvo un valor nulo. 
		                    return "null";
		                }
				   break;
				   
				}  // Fin del switch($arr['ver_solo'])
			   
		   break;
	   }  // Fin  del switch()
   
	  } else {
		
		  return "error";  
		  
	  } // Fin del if( isset($_ass) )  {
     
   }    // Fin de la función process_resumen_mov_inv()
  
//15 
   function process_stock($tipo_usuario)
   {
	   // Función que muestra el Stock del local seleccionado. 	
      
	   //01 HAGO UN switch PARA SELECCIONAR EL TIPO DE USUARIO QUE VOY A VER PARA HACER LA CONSULTA PUES:
	   /*
	      usuario 'a' -> El administrador sólo puede ver esto en la PESTAÑA STOCK.
		  usuario 'v' -> El vendedor lo vé en su pantalla principal de INVENTARIO.
	   */
	   switch($tipo_usuario) 
	   {   
	     case "a":    // CASO ADMINISTRADOR.
	        //02 Recibo las variables $_POST ó $_GET[]
	        if ( isset($_GET['inv']) && $_GET['inv'] == "4" )  {
				// CASO 1: VISTA DE IMPRESIÓN.
				$arr['local_stock'] = $_GET['id'];     // id del local.
						
		    } else {
			    // CASO 2: VISTA DE LA WEB.
				$arr = $_POST;	
			}
		   	   
           $stock_selected = $arr['local_stock'];    // CASO 1. En este caso el stock lo hago por consulta
		 
		 break;
	     case "v":     // CASO VENDEDOR.
	       //03 Verifico la variable de SESSIÓN.
	       $stock_selected = $_SESSION['id_local'];  // CASO 2. En este caso el stcok aparece en la primera pantalla.
	   
	     break;  
	   	  
	   }  // Fin del swicth 
	   
	   if( isset($stock_selected) )  {
          // Esto es para que introduzca un error si no se envían variables $_POST
          		     	  
		  //02 Hago la consulta de acuerdo los datos introducidos en el formulario
          switch($stock_selected)
	      {
	         case "1":
	              // CASO 1
				  // Esto es para el caso de que el local seleccionado sea la BODEGA.
	              $query15 = "SELECT newbodega_1.id, articulos_inventario.codigo_art, articulos_inventario.referencia_art, newbodega_1.stock_actual FROM newbodega_1, articulos_inventario WHERE newbodega_1.id_codigo_art=articulos_inventario.id ORDER BY articulos_inventario.referencia_art ASC";
				  $query15 = mysql_query($query15);
		          $num_rows_query15 = mysql_num_rows($query15);
				  if ( $num_rows_query15 > 0 )  {
		              // Esto significa que ARTÍCULOS EN EL STOCK DE LA BODEGA y los guardo en un array para devolverlos
		              				
					  for ( $i=0; $i < $num_rows_query15; $i++ )
		              {
		                   $stock_articulo[$i] = mysql_fetch_assoc($query15);
		              }
	            
				      return $stock_articulo;
				  } else {
		               //02 Si no hay ARTÍCULOS EN ESTE LOCAL devuelvo un valor nulo. 
		            				
					  return "null";
		          }
			      	 
			 break;
			 default:
			      // CASO 2
				  // Esto es para el caso de que el local seleccionado sea un ALMACÉN.
			      $query152 = "SELECT newalmacen_".$stock_selected.".id, articulos_inventario.codigo_art, articulos_inventario.referencia_art, newalmacen_".$stock_selected.".stock_actual FROM newalmacen_".$stock_selected.", articulos_inventario WHERE newalmacen_".$stock_selected.".id_codigo_art=articulos_inventario.id ORDER BY articulos_inventario.referencia_art ASC";
				  $query152 = mysql_query($query152);
		          $num_rows_query152 = mysql_num_rows($query152);
				  if ( $num_rows_query152 > 0 )  {
		              // Esto significa que ARTÍCULOS EN EL STOCK DE LA BODEGA y los guardo en un array para devolverlos
		              				
					  for ( $i=0; $i < $num_rows_query152; $i++ )
		              {
		                   $stock_articulo[$i] = mysql_fetch_assoc($query152);
		              }
	            
				      return $stock_articulo;
				  } else {
		               //02 Si no hay ARTÍCULOS EN ESTE LOCAL devuelvo un valor nulo. 
		            				
					  return "null";
		          }
			 			 
			 break;
		  }    // Fin del switch($arr['local_stock'])
	         
	   } else {
		   
	       return "error";  
	   
	   } // Fin del if( isset($arr['local_stock']) )  {
       
   }   // Fin de la función process_stock()
    
//16
   function process_art_pendientes() 
   {
	   // Función que procesa los datos para insertar nuevas ENTRADAS en la tabla del local seleccionado.  
   
       $contador = 0;   // contador para almacenar todas los movimientos insertados correctamente.
	   $fecha = gmdate('Y-m-d', time() - 18000 );
	   $nombre_completo = addslashes($_SESSION['nombre_completo']);
	   $arr = $_POST;
	         
	   //01 HAGO UN switch PARA SELECCIONAR EL TIPO DE USUARIO QUE VOY A VER PARA HACER LA CONSULTA PUES:
	   /*
	      usuario 'a' -> El administrador sólo puede ver esto en la PESTAÑA STOCK.
		  usuario 'v' -> El vendedor lo vé en su pantalla principal de INVENTARIO.
	   */
	   switch($_SESSION['tipo_usuario']) 
	   {   
	      case "a":    // CASO ADMINISTRADOR.
	         //02 Recibo las variables $_POST
	         $local_stock = $arr['local_stock'];    // CASO 1. En este caso ENTRO EL STOCK COMO ADMINISTRADOR A UN LOCAL.
		 
		  break;
	      case "v":     // CASO VENDEDOR.
	         //03 Verifico la variable de SESSIÓN.
	         $local_stock = $_SESSION['id_local'];  // CASO 2. En este caso ENTRO EL STOCK COMO VENDEDOR.
	   
	      break;  
	   }  // Fin del switCh
	      
	   //04 Hago un switch de acuerdo a si la entrada será en la BODEGA o algún ALMACÉN
       switch($local_stock)
	   {
		  case "1":
		       // CASO BODEGA
		       /******* BUSCO TODOS LOS id DE ARTÍCULOS DE LAS VARIABLES $_POST********/
			   foreach($_POST as $key => $value)
	           {
				  if( substr($key,0,12) == "id_pendiente") {
			         // Con esto tengo el id del artículo en la TABLA articulos_pendientes_de_entrada que voy a mover. 
				      
					 $id_pendiente = substr($key,12);  // Esto es 1, 2, 3....
					 settype($id_pendiente, "integer");  //a) tengo el id convertido en int.
				     
					 // PASO 1: pongo valor 1 en el recibido de la TABLA articulos_pendientes_de_entrada 
					 $query190 = "UPDATE articulos_pendientes_de_entrada SET recibido=1 WHERE id=".$id_pendiente.""; 
					 $query190 = mysql_query($query190);
					 $num_rows_query190 = mysql_affected_rows();
					 if ( $num_rows_query190 > 0 )  {
				         // PASO 2: select todos los campos que necesito para hacer el INSERT del movimiento.
					     $query1901 = "SELECT id_codigo_articulo_mov, concepto_mov, origen_mov_proveedor, cantidad_movimiento, observaciones_mov FROM articulos_pendientes_de_entrada WHERE id='".$id_pendiente."'";
						 $query1901 = mysql_query($query1901);
						 $num_rows_query1901 = mysql_num_rows($query1901);
						 if ( $num_rows_query1901 > 0 )  {
							// Guardo los valores de los DATOS.
							$articulo = mysql_fetch_assoc($query1901);
							// PASO 3: UPDATE en la tabla new_bodega(id) la ENTRADA del artículo   
				            /***** AHORA VERIFICO EL STOCK DEL ARTÍCULO QUE HAY EN LA BODEGA ***/
	                         $stock = check_stock_bodega($local_stock, $articulo); 
							  
							/***** AHORA HAGO LA SUMA DEL STOCK *****/
							 $saldo_anterior = $stock;
							 settype( $saldo_anterior, "float");
							  
							 $cantidad_movimiento = $articulo['cantidad_movimiento'];
							 settype( $cantidad_movimiento, "float");
							  
							/* SALDO FINAL */ $saldo_final = $saldo_anterior + $cantidad_movimiento;   
						    // IV)  UPDATE el stock en la tabla de stock como una Entrada (DESTINO).
				                      $query1902 = "UPDATE newbodega_".$local_stock." SET stock_actual=".$saldo_final." WHERE id_codigo_art='".$articulo['id_codigo_articulo_mov']."'";
				                      $query1902 = mysql_query($query1902); 
				                      $num_rows_query1902 = mysql_affected_rows(); 
				                      if ( $num_rows_query1902 > 0 )  {
					                      /* Esto significa que se UPDATE correctamente la TABLA */
					                      // PASO 4: INSERT en la tabla mov_bodega(id) la ENTRADA del artículo  
										  $insert_mov = insert_mov_bodega($local_stock, $saldo_final, $articulo);
										  if ( $insert_mov == "true" )  {
										      /* ALMACENO EN UN CONTADOR  */
					                          $contador++;
										  }
																			  
									  } else { echo mysql_error(); }   // mensaje de ERROR
						 					 
						 } else { echo mysql_error(); }  // Fin del if ( $num_rows_query1901 > 0 )  {
					 				 
					 } else { echo mysql_error(); }  // Fin del if ( $num_rows_query190 > 0 )  {
				   			   
				  } else {  continue;  }   // Fin del if( substr($key,0,12) == "id_pendiente") {
			   		   
			   }  // Fin del foreach($_POST as $key => $value)
		   
		  break;
		  default:
		       // CASO ALMACÉN
		       /******* BUSCO TODOS LOS id DE ARTÍCULOS DE LAS VARIABLES $_POST********/
			   foreach($_POST as $key => $value)
	           {
				   if( substr($key,0,12) == "id_pendiente") {
			          // Con esto tengo el id del artículo en la TABLA articulos_pendientes_de_entrada que voy a mover. 
				      
					  $id_pendiente = substr($key,12);  // Esto es 1, 2, 3....
					  settype($id_pendiente, "integer");  //a) tengo el id convertido en int.
				      
					  // PASO 1: pongo valor 1 en el recibido de la TABLA articulos_pendientes_de_entrada 
					  $query19 = "UPDATE articulos_pendientes_de_entrada SET recibido=1 WHERE id=".$id_pendiente.""; 
					  $query19 = mysql_query($query19);
					  $num_rows_query19 = mysql_affected_rows();
					  if ( $num_rows_query19 > 0 )  {
						  // PASO 2: select todos los campos que necesito para hacer el INSERT del movimiento.
					      $query191 = "SELECT id_codigo_articulo_mov, concepto_mov, origen_mov_proveedor, cantidad_movimiento, observaciones_mov FROM articulos_pendientes_de_entrada WHERE id='".$id_pendiente."'";
						  $query191 = mysql_query($query191);
						  $num_rows_query191 = mysql_num_rows($query191);
						  if ( $num_rows_query191 > 0 )  {
							  // Guardo los valores de los DATOS.
							  $articulo = mysql_fetch_assoc($query191);
							  // PASO 3: INSERT o UPDATE en la tabla new_almacen(id) la ENTRADA del artículo   
						      /***** AHORA VERIFICO QUE EN EL DESTINO EXISTA ESE ARTÍCULO EN EL STOCK ***/
	                          $stock = check_stock_almacen($local_stock, $articulo); 
							  
							  /***** AHORA HAGO LA SUMA DEL STOCK *****/
							  $saldo_anterior = $stock[1];
							  settype( $saldo_anterior, "float");
							  
							  $cantidad_movimiento = $articulo['cantidad_movimiento'];
							  settype( $cantidad_movimiento, "float");
							  
							  /* SALDO FINAL */ $saldo_final = $saldo_anterior + $cantidad_movimiento;   
							  
							  switch($stock[0])
		                      {
		                         case "update":
				                      // IV)  UPDATE el stock en la tabla de stock como una Entrada (DESTINO).
				                      $query192 = "UPDATE newalmacen_".$local_stock." SET stock_actual=".$saldo_final." WHERE id_codigo_art='".$articulo['id_codigo_articulo_mov']."'";
				                      $query192 = mysql_query($query192); 
				                      $num_rows_query192 = mysql_affected_rows(); 
				                      if ( $num_rows_query192 > 0 )  {
					                      /* Esto significa que se UPDATE correctamente la TABLA */
					                      // PASO 4: INSERT en la tabla mov_almacen(id) la ENTRADA del artículo  
										  $insert_mov = insert_mov_almacen($local_stock, $saldo_final, $articulo);
										  if ( $insert_mov == "true" )  {
										      /* ALMACENO EN UN CONTADOR  */
					                          $contador++;
										  }
												
				                      } else { echo mysql_error(); }   // mensaje de ERROR
			  						 
			                      break;
			                      case "insert": 
				                       // IV)  INSERT el stock en la tabla de stock como una Entrada Nueva (DESTINO).
				                       $query193 = "INSERT INTO newalmacen_".$local_stock." (id_codigo_art, stock_actual) VALUES ('".$articulo['id_codigo_articulo_mov']."', ".$cantidad_movimiento.")";
				                       $query193 = mysql_query($query193); 
				                       $num_rows_query193 = mysql_affected_rows(); 
				                       if ( $num_rows_query193 > 0 )  {
					                       /* Esto significa que se UPDATE correctamente la TABLA */
					                      // PASO 4: INSERT en la tabla mov_almacen(id) la ENTRADA del artículo  
										  $insert_mov = insert_mov_almacen($local_stock, $saldo_final, $articulo);
										  if ( $insert_mov == "true" )  {
										      /* ALMACENO EN UN CONTADOR  */
					                          $contador++;
										  }					
												
				                       }  else { echo mysql_error(); }   // mensaje de ERROR
	  
	                               break;
		                      } // Fin del switch
		  
						  } else { echo mysql_error(); }  // Fin del if ( $num_rows_query191 > 0 )  {
						  
					  } else { echo mysql_error(); }  // Fin del if ( $num_rows_query19 > 0 )  {
					  
				   } else {  continue;  }   // Fin del if( substr($key,0,12) == "id_pendiente") {
			   		   
			   }  // Fin del foreach($_POST as $key => $value)
		 	   
		  break;
		  	   
	   }   // Fin del switch($local_stock)
      
	   //05 HAGO UN switch PARA SELECCIONAR DE ACUERDO AL TIPO DE USUARIO LO QUE VOY A DEVOLVER EN EL header():
	   /*
	      usuario 'a' -> El administrador sólo puede ver esto en la PESTAÑA STOCK.
		  usuario 'v' -> El vendedor lo vé en su pantalla principal de INVENTARIO.
	   */
	   switch($_SESSION['tipo_usuario']) 
	   {   
	      case "a":    // CASO ADMINISTRADOR.
	          /* AL FINAL DEVUELVO EL MENSAJE DE OK */
	          header('Location: ../index.php?mod=mod_inventario&optioninv=stock&stockins='.$contador.'#tabs-3');
	      
		  break;
	      case "v":     // CASO VENDEDOR.
	          /* AL FINAL DEVUELVO EL MENSAJE DE OK */
	          header('Location: ../index.php?mod=mod_inventario&stockins='.$contador.'#tabs-3');
	      break;  
	   }  // Fin del switCh
	   
   }   // Fin de la función process_art_pendientes()
    
//17 private 
   function check_stock_almacen($destino_mov, $articulo)     
   { 
        // Función que chequea si existe el artículo seleccionado en el stock del almacén.
  
        $query17 = "SELECT * FROM newalmacen_".$destino_mov." WHERE id_codigo_art='".$articulo['id_codigo_articulo_mov']."'";
		$query17 = mysql_query($query17);
		$num_rows_query17 = mysql_num_rows($query17);
		if ( $num_rows_query17 == 1 )  {
			// Esto significa que ya ese artículo esta en el stock de esa TABLA y debo hacer un UPDATE.
             $rta = mysql_fetch_assoc($query17); 
			 
			 $return[0] = "update";
			 $return[1] = $rta['stock_actual'];
			 return $return;						
						
		} else {
			// Esto significa que ese artículo todavía no se ha incluído en el stock de esa TABLA y debo hacer un INSERT.	
			 
			 $return[0] = "insert";
			 $return[1] = "0";
			 return $return;
		
		}
    
   }   // Fin de la función check_stock_almacen($destino_mov, $codigo_articulo_mov)
   
//18 private 
  function check_stock_bodega($local_stock, $articulo) 
  {  
       // Función que devuelve la cantidad de artículos del stock de la BODEGA. 
        $query18 = "SELECT * FROM newbodega_".$local_stock." WHERE id_codigo_art='".$articulo['id_codigo_articulo_mov']."'";
		$query18 = mysql_query($query18);
		$num_rows_query18 = mysql_num_rows($query18);
		if ( $num_rows_query18 == 1 )  {
			// Esto significa que está correcto ese artículo esta en el stock de la tabla newbodega_1 y debo hacer un UPDATE.
            $rta = mysql_fetch_assoc($query18); 
			
			$return = $rta['stock_actual'];
			return $return;	
       
		} // Fin del if ( $num_rows_query18 == 1 )  {
  
  
  }   // Fin de la función check_stock_bodega($local_stock, $articulo) 
   
//19 private 
  function insert_mov_almacen($local_stock, $saldo_final, $articulo)
  {
	  // Función que inserta el movimiento de ENTRADA al almacén. 
  
       $fecha = gmdate('Y-m-d', time() - 18000 );
	   $nombre_completo = addslashes($_SESSION['nombre_completo']);
   
      $query194 = "INSERT INTO movalmacen_".$local_stock." ( fecha_movimiento, id_codigo_articulo_mov, tipo_mov, concepto_mov, origen_mov_proveedor, cantidad_movimiento, observaciones_mov, persona_q_hace_mov, recibido, saldo ) VALUES ('".$fecha."', '".$articulo['id_codigo_articulo_mov']."', 'Entrada', '".$articulo['concepto_mov']."', '".$articulo['origen_mov_proveedor']."', '".$articulo['cantidad_movimiento']."', '".$articulo['observaciones_mov']."', '".$nombre_completo."', 1, '".$saldo_final."')";
	  $query194 = mysql_query($query194);
	  $num_rows_query194 = mysql_affected_rows();
	  if ( $num_rows_query194 > 0 )  {
		   // ESTO SIGNIFICA QUE SE INSERTÓ CORRECTAMENTE EN LA BASE DE DATOS  
		   return "true";					  
	  } else { echo mysql_error(); }
    
  } // Fin de la función insert_mov_almacen($a...)
  
//20 private 
  function insert_mov_bodega($local_stock, $saldo_final, $articulo)
  {
	  // Función que inserta el movimiento de ENTRADA a la BODEGA. 
	  $fecha = gmdate('Y-m-d', time() - 18000 );
	  $nombre_completo = addslashes($_SESSION['nombre_completo']);
   
      $query20 = "INSERT INTO movbodega_".$local_stock." ( fecha_movimiento, id_codigo_articulo_mov, tipo_mov, concepto_mov, origen_mov_proveedor, cantidad_movimiento, observaciones_mov, persona_q_hace_mov, recibido, saldo ) VALUES ('".$fecha."', '".$articulo['id_codigo_articulo_mov']."', 'Entrada', '".$articulo['concepto_mov']."', '".$articulo['origen_mov_proveedor']."', '".$articulo['cantidad_movimiento']."', '".$articulo['observaciones_mov']."', '".$nombre_completo."', 1, '".$saldo_final."' )";
	  $query20 = mysql_query($query20);
	  $num_rows_query20 = mysql_affected_rows();
	  if ( $num_rows_query20 > 0 )  {
		   // ESTO SIGNIFICA QUE SE INSERTÓ CORRECTAMENTE EN LA BASE DE DATOS  
		   return "true";					  
	  } else { echo mysql_error(); }
		  
  }  // Fin de la función insert_mov_bodega($local_stock, $saldo_final, $articulo) 
   
//21 
  function detalle_articulo()
  {
	  // Función que devuelve los detalles de la tabla articulos_inventario del artículo seleccionado
      
	  //01 Recibo las variables $_POST
	   $arr = $_POST;
       if( isset($arr['articulos_inv']) )  {
          // Esto es para que introduzca un error si no se envían variables $_POST
		  
		  $query21 = "SELECT articulos_inventario.*, proveedores_clientes.nombre FROM articulos_inventario, proveedores_clientes WHERE articulos_inventario.id='".$arr['articulos_inv']."' AND articulos_inventario.proveedor_art=proveedores_clientes.id";
		  $query21 = mysql_query($query21);
		  $num_rows_query21 = mysql_num_rows($query21);
		  if ( $num_rows_query21 > 0 )  {
			  // Esto significa que se llevó a cabo bien la consulta
			  $result = mysql_fetch_assoc($query21);   
			  return $result; 
		 
		  } else { echo mysql_error(); }
		  
	   } else { return "error"; } 	  
  
  }  // FIN DE LA FUNCIÓN detalle_articulo()
  
//22 
  function stocks_articulo()
  {
	  // Función que devuelve la cantidad de artículos en stock de cada LOCAL para el art. seleccionado 
  
      //01 Recibo las variables $_POST
	   $arr = $_POST;
       if( isset($arr['articulos_inv']) )  {
          // Esto es para que introduzca un error si no se envían variables $_POST
		  
		  // PASO 1: SELECCIONAR TODOS LOS LOCALES QUE EXISTEN EN EL NEGOCIO
		  $query22 = "SELECT id, nombre_local, tipo_local FROM locales_inventarios";
		  $query22 = mysql_query($query22);
		  $num_rows_query22 = mysql_num_rows($query22);
		  if ( $num_rows_query22 > 0 )  {
			  // Esto significa que se llevó a cabo bien la consulta
			  for ($i=0; $i < $num_rows_query22; $i++)
			  {
			       $result_locales[$i] = mysql_fetch_assoc($query22);   
			  }
			  
			  // PASO 2: SELECCIONAR LOS STOCKS QUE EXISTEN ACTUALMENTE EN CADA UNO DE LOS LOCALES
			  for ($i=0; $i < $num_rows_query22; $i++)
			  {
			      switch($result_locales[$i]['id'])
				  {
					 case "1":
					     // CASO BODEGA
					     $query221 = "SELECT stock_actual FROM newbodega_1 WHERE id_codigo_art='".$arr['articulos_inv']."'";
						 $query221 = mysql_query($query221);
					     $num_rows_query221 = mysql_num_rows($query221);
						 if ( $num_rows_query221 > 0 )  {
						     // Se obtuvieron bien los datos	 
							  $result = mysql_fetch_assoc($query221);
							  $result_locales[$i]['stock_actual'] = $result['stock_actual'];
							  
					     } else {
						      
							  $result_locales[$i]['stock_actual'] = "0";	 
						 }
					 
					 break;
					 default:
					    // CASO ALMACENES
					     $query222 = "SELECT stock_actual FROM newalmacen_".$result_locales[$i]['id']." WHERE id_codigo_art='".$arr['articulos_inv']."'";
						 $query222 = mysql_query($query222);
					     $num_rows_query222 = mysql_num_rows($query222);
						 if ( $num_rows_query222 > 0 )  {
						     // Se obtuvieron bien los datos	 
							  $result = mysql_fetch_assoc($query222);
							  $result_locales[$i]['stock_actual'] = $result['stock_actual'];
							  
					     } else {
						      
							  $result_locales[$i]['stock_actual'] = "0";	 
						 }
					 				 
					 break;   
					  
				  }
			     		  
			  } // Fin del for ($i=0; $i < $num_rows_query22; $i++)
			  		  
			 return $result_locales;
			  	 
		  } else { echo mysql_error(); }
		  
	   } else { return "error"; } 	  
   
  }  // Fin de la función stocks_articulo()
   
//23 
   function show_local_name($id_local)
   {
	   // Función que muesttra el nombre de un local de acuerdo a si id ( pantalla princ. usuario VENDEDOR )   
   
       //01 Selecciono el local (ALMACÉN) del cual voy a buscar su datos. 
	  $query23 = "SELECT * FROM locales_inventarios WHERE id='".$id_local."'";
	  $query23 = @mysql_query($query23) or die(mysql_error());
	  $num_rows_query23 = mysql_num_rows($query23);
	  if ( $num_rows_query23 > 0 )  {
		  // Esto significa que existe el local en la BD y guardo sus datos en un array para devolverlos
		  
		      $registro_locales = mysql_fetch_assoc($query23);
		  
	  } else {
		 //02 Si no hay LOCALES devuelvo un valor nulo. 
		 return "null";
		   
	  }
	  
	  //03 Si hay LOCALES en la base de datos devuelvo los regsitros de estos.  
	  return $registro_locales;  
     
   }  // Fin de la función show_local_name($id_local)
  
//24 
   function show_bodega_or_not()
   {
	   // Función q carga si se puede o no poner el valor de la BODEGA en el <select> a la hora de insertar un nuevo LOCAL.    
       $query24 = "SELECT id FROM locales_inventarios WHERE tipo_local='bodega'";
       $query24 = @mysql_query($query24) or die(mysql_error());
       $num_rows_query24 = mysql_num_rows($query24);
	   if ( $num_rows_query24 > 0 )  {
		   // ESTO SIGNIFICA QUE EXISTE YA UNA BODEGA EN LA BD.
		   return "true";  
	   
	   } else {
		   // ESTO SIGNIFICA QUE NO EXISTE NINGUNA BODEGA EN LA BD.
		   return "false";   
		   
	   }
   
   }  // Fin de la función show_bodega_or_not()
    
   /*****((02)) SECCIÓN DEL PROCESAMIENTO DE ACUERDO A LAS VARIABLES $_GET del mod_inventario  *****/
  
  if ( isset($_GET['data']) && $_GET['data'] == "send" )   {
	  // Esto es para procesar los datos para insertar nuevos artículos  
	  process_new_article();
  } else if ( isset($_GET['data']) && $_GET['data'] == "editar" )   {
	  // Esto es para procesar los datos para editar el artículo seleccionado   
	  process_edit_articulo();
  } else if ( isset($_GET['data']) && $_GET['data'] == "send_new_local" )   {
	  // Esto es para procesar los datos para insertar nuevos locales.  
	  process_new_local();
  } else if ( isset($_GET['data']) && $_GET['data'] == "send_new_mov" )   {
	  // Esto es para procesar los datos para insertar nuevos movimientos de inventarios.  
	  process_new_mov();
  } else if ( isset($_GET['data']) && $_GET['data'] == "send_art_pendientes" )   {
	  // Esto es para procesar los datos para insertar nuevas ENTRADAS en la tabla del local seleccionado.  
	  process_art_pendientes();
  } 
 
?>