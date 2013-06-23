<?php
/**
 * Plugin  : Autocompletar con jQuery
 *   Autor : Lucas Forchino
 * WebSite : http://www.tutorialjquery.com
 * version : 1.0
 * Licencia: Pueden usar libremenete este código siempre y cuando no sea para 
 *           publicarlo como ejemplo de autocompletar en otro sitio.
 */
/* Archivo que permite mediante AJAX la devolución de los datos de los códigos de los artículos del módulo INVENTARIO -> MOV */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE LOS DATOS DE LA TABLA articulos_inventario Y SE PASAN DINAMICAMENTE AL CAMPO TEXT DEL BUSCADOR DE ARTÍCULOS POR CÓDIGO  */

//01 Limpio la palabra que se busca que envío por el método POST
$codigo_articulo = $_GET['search'];   // cliente

//02 Busco la palabra en la BD 
$result= search($codigo_articulo);

//03 Seteo la cabecera como json
header('Content-type: application/json; charset=utf-8');

//04 Imprimo el resultado como un json
echo json_encode($result);

/**
 *  Funcion que busca en los datos un resultado  que tenga que ver
 *  con la busqueda, si los datos vinieran de base no seria necesario esto
 *  ya que lo podriamos resolver directamente por sql
 */

function search($searchWord) 
{    
	$query = "SELECT codigo_art
              FROM articulos_inventario
              WHERE  codigo_art LIKE '%$searchWord%'
              LIMIT 5";
 
     $query = mysql_query($query);
	 $num_rows_query = mysql_num_rows($query);
	 
	 for ( $i=0; $i < $num_rows_query; $i++ )
	 {
		 
	      $data[$i] = mysql_fetch_assoc($query);
	 
	 }
		 	
	 for ( $i=0; $i < $num_rows_query; $i++ )
	 {
	      //01 obtengo el tamaño de la palabra que se busca.
          $searchWordSize = strlen($searchWord);
	      //return $searchWordSize;
		  //02 corto la palabra que viene del array de la consulta a la BD y la dejo del mismo tamaño que la que se busca para poder comparar.
          $word = $data[$i]['codigo_art']; 
		  $tmpWord = substr($word, 0,$searchWordSize);
	      
		   $tmpWord;
		  
		   // si son iguales la guardo para devolverla
          if (strtolower($tmpWord) == strtolower($searchWord))
          {
            // guardo la palabra original sin cortar.
            $tmpArray[] = $word;
          }
	 
	 }
	 
	 return $tmpArray;

}
?>