<?php
/*
* Este es el LAYOUT DEL colorbox PARA MOSTRAR:

       1. SÓLO LOS DETALLES DE LAS COMPRAS        -> MÓDULO COMPRAS -> link Ver 
	   2. SÓLO LOS DETALLES DE LAS VENTAS         -> MÓDULO VENTAS  -> link Ver 
	   3. AGREGAR UN NUEVO ARTÍCULO DESDE COMPRAS -> MÓDULO COMPRAS -> link Nuevo 
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*/
// no direct access
defined('VALID_VAR') or die;

?>
   
<!-- CONTENEDOR DE LOS MÓDULOS ( Sólo se muestra el módulo de compras_details )-->
<div class="main_content">

<?php 
    
	if ( isset($_GET['mod']) && $_GET['mod'] == "mod_compras_details" )  {
	    // VOY AL MÓDULO DE DETALLE DE LA COMPRA (mod_compras_details)
	    
		include_once('modules/compras_details.php'); 

	} else if ( isset($_GET['mod']) && $_GET['mod'] == "mod_ventas_details" )  {
	    // VOY AL MÓDULO DE DETALLE DE LA VENTA (mod_ventas_details)
	    
		include_once('modules/ventas_details.php'); 

    } else if ( isset($_GET['mod']) && $_GET['mod'] == "mod_add_article" )  {
	    // VOY AL MÓDULO QUE ME PERMITE AGREGAR UN ARTÍCULO A LA BD DESDE EL MÓDULO COMPRAS (mod_add_article)
?>	    
		
	   <div id="tabs" style="float: left;">
         <ul>
            <li><a href="#tabs-1"> Nuevo Art&iacute;culo </a></li>
         </ul>

         <div id="tabs-1">  
         <?php
            include_once('modules/add_article.php');
	     ?>
         </div>	
	   </div>

<?php		
       
	}
?>

</div>   <!-- fin del <div class="main_content"> -->