<?php
/**
 *
 *  -> Con este archivo inserto los 3 primero registros de la compra que voy a hacer.
 *
 */
/* Archivo que permite mediante AJAX insertar en la tabla registro_compras LOS DATOS DE ESTA. */

include_once('../includes/connection.php'); 

//01 Recibo las variables $_GET.
$orden_compra = $_GET['oc'];    // Orden de la Compra.
$fecha_compra = $_GET['fc'];    // Fecha de la Compra.
$no_factura_compra = $_GET['nfc'];   // No. Factura Compra. 
$id_proveedor_compra = $_GET['ipc'];   // id del Proveedor de la Compra.

/**** VARIABLES QUE SE RECIBEN ****/
// 1 - orden_compra         --> Campo hidden con el orden de compra ( Muetra el campo numero de compra ). 
// 2 - no_factura_compra    --> Campo que se inserta en la tabla ( Muestra la factura de la compra ). 
// 3 - fecha_compra         --> Campo que se inserta en la tabla ( Muestra la fecha de la compra ).
// 4 - proveedor_compra     --> Campo de donde voy a hacer una consulta para sacar el id de ese proveedor 
// 5 - ruc_proveedor_compra --> Campo que me puede servir para lo de arriba pues al final es un complemento.

//03 Hago la consulta de INSERT EN LA bd.
   // Se usa utf8_decode pues el envío de información desde javascript se hace en utf-8
   $query = "INSERT INTO registro_compras( numero_compra, fecha_compra, numero_factura, id_proveedor_compra) VALUES ( '".utf8_decode($orden_compra)."', '".utf8_decode($fecha_compra)."', '".utf8_decode($no_factura_compra)."', '".utf8_decode($id_proveedor_compra)."')";
   $query = mysql_query($query);
   $num_rows_query = mysql_affected_rows();
   if ( $num_rows_query == 1 )  {
       echo "true"; 
   } else {
	   echo mysql_error();
   }

?>