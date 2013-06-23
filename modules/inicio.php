<?php
/*
* Este es el módulo que muestra los BOTONES CON TODAS LAS OPCIONES DEL SISTEMA (VENTANA DE INICIO).
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*/


// no direct access
defined('VALID_VAR') or die;


?>




<div class="menu-box">
   
   <!--  BOTÓN 1 superior  -->
   
   <div id="button_5" class="menu-content"> 
     <a href="index.php?mod=mod_ventas#tabs-1"> 
        <center>
         <p>
           
           <img width="64" height="64" title="Bot&oacute;n de Gesti&oacute;n de las Ventas" src="images/logo_ventas.png" />
          
         </p>
         <span> Ventas </span>
       </center>
     </a> 
   </div>
      
   <!--  BOTÓN 2 superior  -->
   
   <div id="button_2" class="menu-content"> 
     <a href="index.php?mod=mod_caja#tabs-2">   <!-- mod=mod_ccentral  -->
        <center>
         <p>
           
           <img width="64" height="64" title="Bot&oacute;n de Gesti&oacute;n de las Cajas" src="images/logo_caja_central.png" />
          
         </p>
         <span> Cajas Chicas </span>
       </center>
     </a> 
   </div>
   
   <!--  BOTÓN 3 superior  -->
   
   <div id="button_3" class="menu-content"> 
     <a href="index.php?mod=mod_inventario#tabs-3">    <!-- mod=mod_inventario  -->
        <center>
         <p>
           
           <img width="64" height="64" title="Bot&oacute;n de Gesti&oacute;n del Inventario" src="images/logo_inventario.png" />
          
         </p>
         <span> Inventarios </span>
       </center>
     </a> 
   </div>
   

<?php   
   if( $_SESSION['tipo_usuario'] == "a" )  {
	   // ESTOS BOTONES SÓLO PUEDE VERLO EL ADMINISTRADOR.
?>   
   
   <!--  BOTÓN 4 superior  -->
   
   <div id="button_4" class="menu-content"> 
     <a href="index.php?mod=mod_compras#tabs-4"> 
        <center>
         <p>
           
           <img width="64" height="64" title="Bot&oacute;n de Gesti&oacute;n de las Compras" src="images/logo_compras.png" />
          
         </p>
         <span> Compras </span>
       </center>
     </a> 
   </div>
   
   
   
  
   <br style="line-height:142px;" />
  
   
   <!--  BOTÓN 5 inferior   -->
   
   <div id="button_6" class="menu-content"> 
     <a href="index.php?mod=mod_clientes#tabs-1"> 
        <center>
         <p>
           
           <img width="64" height="64" title="Bot&oacute;n de Gesti&oacute;n de Clientes" src="images/logo_clientes.png" />
          
         </p>
         <span> Clientes </span>
       </center>
     </a> 
   </div>
   
   
    <!--  BOTÓN 6 inferior   -->
   
   <div id="button_7" class="menu-content"> 
     <a href="index.php?mod=mod_proveedores#tabs-2"> 
        <center>
         <p>
           
           <img width="64" height="64" title="Bot&oacute;n de Gesti&oacute;n de Proveedores" src="images/logo_proveedores.png" />
          
         </p>
         <span> Proveedores </span>
       </center>
     </a> 
   </div>
   
   
   
   
   
   
   <!--  BOTÓN 7 inferior   -->
   
   <div id="button_8" class="menu-content"> 
     <a href="index.php?mod=mod_cuentas_x_pagar#tabs-3"> 
        <center>
         <p>
           
           <img width="64" height="64" title="Bot&oacute;n de Gesti&oacute;n de las Cuentas por Pagar" src="images/logo_cuentas_por_pagar.png" />
          
         </p>
         <span> Cuentas por Pagar </span>
       </center>
     </a> 
   </div>
   
   
   
   <!--  BOTÓN 8 inferior   -->
   
   <div id="button_9" class="menu-content"> 
     <a href="index.php?mod=mod_cuentas_x_cobrar#tabs-4"> 
        <center>
         <p>
           
           <img width="64" height="64" title="Bot&oacute;n de Gesti&oacute;n de las Cuentas por Cobrar" src="images/logo_cuentas_por_cobrar.png" />
          
         </p>
         <span> Cuentas por Cobrar </span>
       </center>
     </a> 
   </div>
   
   <!--  BOTÓN 9 inferior   -->
   
   <div id="button_1" class="menu-content"> 
     <a href="index.php?mod=mod_registro_bancario#tabs-5">    <!-- mod=mod_registro_bancario  -->
       <center>
         <p>
           
           <img width="64" height="64" title="Bot&oacute;n de Gesti&oacute;n de los Registros Bancarios" src="images/logo_bank.png" />
          
         </p>
         <span> Registro Bancario </span>
       </center>
     </a> 
   </div>  

<?php
   }
?>


</div>    <!--- fin del <div class="menu-box">   -->


