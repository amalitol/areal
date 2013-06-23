<?php
/**
 * Plugin  : Autocompletar con jQuery
 *   Autor : Lucas Forchino
 * WebSite : http://www.tutorialjquery.com
 * version : 1.0
 * Licencia: Pueden usar libremenete este código siempre y cuando no sea para 
 *           publicarlo como ejemplo de autocompletar en otro sitio.
 */

/* Archivo que permite mediante AJAX la devolución de los datos de los clientes al módulo CUANTAS X COBRAR */


include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE LOS DATOS DE LA TABLA proveedores_clientes Y SE PASAN DINAMICAMENTE AL CAMPO TEXT DEL BUSCADOR DE CLIENTES */

//01 Limpio la palabra que se busca que envío por el método POST
$cliente = $_GET['search'];

//02 Busco la palabra en la BD 
$result= search($cliente);

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
	$query = "SELECT nombre
              FROM proveedores_clientes
              WHERE active_cliente=1 AND nombre LIKE '%$searchWord%'
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
          $word = $data[$i]['nombre']; 
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









