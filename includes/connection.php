<?php
//$con = mysql_pconnect("localhost","admin","admin123");
$con = @ mysql_pconnect("localhost","ssc_sistema","password");
if (!$con)  {
  die('Could not connect: ' . mysql_error());
}

// $db_selected = mysql_select_db("orellana", $con);
 $db_selected = mysql_select_db("ssc_sistema", $con);
if (!$db_selected) {
    die ('Imposible establecer conexión :' . mysql_error());
}
   
?>
