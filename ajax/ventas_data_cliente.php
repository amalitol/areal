<?php
/*
 * AUSU jQuery-Ajax Autosuggest v1.0
 * Demo of a simple server-side request handler
 * Note: This is a very cumbersome code and should only be used as an example
 */
/* Archivo que permite mediante AJAX el autocompletado del módulo ventas -> Nueva Venta -> Para seleccionar el cliente de la venta. */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE LOS DATOS DE LA TABLA proveedores_clientes Y SE PASAN DINAMICAMENTE AL CAMPO TEXT DEL BUSCADOR */

# Assign local variables
$id     =   @$_POST['id'];          // The id of the input that submitted the request.
$data   =   @$_POST['data'];        // The value of the textbox.
 
if ($id && $data)
{
    if ($id == 'search_cliente_ventas')
    {
        // Se usa utf8_decode pues el envío de información desde javascript se hace en utf-8 (Para eliminar problemas con las ñ,í,á)
		$query  = "SELECT id, nombre
                  FROM proveedores_clientes
                  WHERE active_cliente=1 AND nombre LIKE '%".utf8_decode($data)."%'
                  LIMIT 9";
 
        $result = mysql_query($query);
 
        $dataList = array();
 
        while ($row = mysql_fetch_array($result))
        {
            $toReturn   = $row['nombre'];
            $dataList[] = '<li id="' .$row['id']. '"><a href="#tabs-1">' . htmlentities($toReturn, ENT_QUOTES , "ISO-8859-1") . '</a></li>';
        }
 
        if (count($dataList)>=1)
        {
            $dataOutput = join("\r\n", $dataList);
            echo $dataOutput;
        }
        else
        {
            echo '<li><a href="#tabs-1"> No hay resultado para esa entrada </a></li>';
        }
    }

}
else
{
    echo 'Request Error';
}
?>