<?php
/*
 * AUSU jQuery-Ajax Autosuggest v1.0
 * Demo of a simple server-side request handler
 * Note: This is a very cumbersome code and should only be used as an example
 */
/* Archivo que permite mediante AJAX la devolución de los datos de los nombres de usuarios al módulo USERS */

include_once('../includes/connection.php'); 

/* AQUI SE REALIZA LA LECTURA DE LOS DATOS DE LA TABLA data_usuarios Y SE PASAN DINAMICAMENTE AL CAMPO TEXT DEL BUSCADOR */

# Assign local variables
$id     =   @$_POST['id'];          // The id of the input that submitted the request.
$data   =   @$_POST['data'];        // The value of the textbox.
 
if ($id && $data)
{
    if ($id == 'change_pass_usuario')
    {
        // Se usa utf8_decode pues el envío de información desde javascript se hace en utf-8 (Para eliminar problemas con las ñ,í,á)
		$query  = "SELECT id_usuario, usuario
                  FROM data_usuarios
                  WHERE usuario LIKE '%".utf8_decode($data)."%'
                  LIMIT 5";
 
        $result = mysql_query($query);
 
        $dataList = array();
 
        while ($row = mysql_fetch_array($result))
        {
            $toReturn   = $row['usuario'];
            $dataList[] = '<li id="' .$row['id_usuario'] . '"><a href="#tabs-2">' . htmlentities($toReturn, ENT_QUOTES , "ISO-8859-1") . '</a></li>';
        }
 
        if (count($dataList)>=1)
        {
            $dataOutput = join("\r\n", $dataList);
            echo $dataOutput;
        }
        else
        {
            echo '<li><a href="#tabs-2">No hay resultado para esa entrada</a></li>';
        }
    }
 
}
else
{
    echo 'Request Error';
}
?>