<?php
/*
* Este es el LAYOUT con los tabs de  (1)Ventas (2)Cajas Chicas, (3)Inventarios, (4)Compras.
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
*/
// no direct access
defined('VALID_VAR') or die;
?>
<!-- BARRA DE INFORMACIÓN SUPERIOR  -->
<div class="container_infobar">
                <div class="box_info_dir">
               		 	<div class="normal">Bienvenido</div>
               		    <div class="green"><?php echo $_SESSION['nombre_completo'];?></div>       
                        <div class="separator"></div>  
                        <div class="normal">Usuario</div>
                		<div class="green"><?php echo $_SESSION['usuario'];?></div>
                </div>
        		<div class="aux_link" >
                   <!-- <div class="aux_box_link">  -->
                	 <!--01 link salir de la aplicaión -->            
                     <a onclick="javascript: return logout();" class="ax1_link" title="Salir de la aplicaci&oacute;n">Salir</a>
                     <!--02 link salir de cambiar la contraseña --> 
                     <a onclick="javascript: return mi_perfil();" class="ax1_link" title="Cambiar contrase&ntilde;a">Mi perfil</a>                 
                     <?php   
                        if( $_SESSION['tipo_usuario'] == "a" )  {
	                    // ESTE LINK SÓLO PUEDE VERLO EL ADMINISTRADOR.
                     ?> 
                     <!--03 link de Administrar -->
                     <a onclick="javascript: return admin_users();" class="ax1_link" title="Administrar los datos de la Empresa y sus usuarios">Administrar </a>
                     <span class="span_link">
                     <img width="25" height="20" border="0" src="images/boton_admin.png"/>
                     </span>		
                     <?php
						}
					 ?>	
                     <!--04 link salir de Administrar --> 
                     <a onclick="javascript: return pagina_principal();" class="ax1_link" title="Ir a la p&aacute;gina de Inicio">P&aacute;gina Principal</a>
                     <span class="span_link" style="margin-top:-6px; margin-right:3px;">
                     <img width="21" height="21" border="0" src="images/boton_inicio.png"/>
                     </span>
                  <!-- </div>  -->
                </div>
        </div>
<!-- CONTENEDOR DE LOS MÓDULOS -->
<div class="main_content">
  <!-- img que muestra el cargando en los que se carga la página principal  -->
  <center class="mov_image" style="margin-top:170px;"> 
    <img border="0" width="32" height="32" src="images/ajax-loader.gif"  /> 
  </center>
  <div id="tabs" style="float: left; display:none;">
     <ul>
         <li><a href="#tabs-1">Ventas</a></li>
         <li><a href="#tabs-2">Cajas Chicas</a></li>
         <li><a href="#tabs-3">Inventarios</a></li>
         <!-- SOLO PARA EL USUARIO ADMINISTRADOR -->
		 <?php   
         if( $_SESSION['tipo_usuario'] == "a" )  {
	          // ESTE TAB SÓLO PUEDE VERLO EL ADMINISTRADOR.
         ?> 
              <li><a href="#tabs-4">Compras</a></li>
         <?php
		 }
         ?>
     </ul>
    <div id="tabs-1">  
<?php
       include_once('modules/ventas.php');
?>
    </div>
	<div id="tabs-2">
<?php      
       include_once('modules/caja.php');
?>    
    </div> 
    <div id="tabs-3">
<?php		
       include_once('modules/inventario.php');
?>	
    </div> 
    <!-- SÓLO PARA EL USUARIO ADMINISTRADOR -->
<?php   
      if( $_SESSION['tipo_usuario'] == "a" )  {
	     // ESTE TAB SÓLO PUEDE VERLO EL ADMINISTRADOR.
?> 
         <div id="tabs-4">
<?php		
             include_once('modules/compras.php');
?>	
         </div> 
<?php
	  }
?>	  
  </div>    <!-- FIN DEL <div id="tabs" style="float: left;">  -->
</div>  <!-- Fin del <div class="main_content">   --> 