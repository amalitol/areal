<?php
/*
* Este es el LAYOUT de la ventana de INICIO del sistema y de MI PERFIL.
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
                     <!-- SI mod=mod_mi_perfil NO SE MUESTRA EL LINK DE 'Mi Perfil'    -->
                     <?php
					 if ( (isset($_GET['mod']) && $_GET['mod'] != "mod_mi_perfil") || ( empty($_GET['mod']) ) )  {  
					 ?>
                         <!--02 link salir de cambiar la contraseña --> 
                         <a onclick="javascript: return mi_perfil();" class="ax1_link" title="Cambiar contrase&ntilde;a">Mi perfil</a>                 
                      <?php
					  }
                      ?>
                     <!-- SOLO PARA EL USUARIO ADMINISTRADOR -->
		             <?php   
                          if( $_SESSION['tipo_usuario'] == "a" )  {
	                      // ESTE LINK SÓLO PUEDE VERLO EL ADMINISTRADOR.
                     ?> 
                     <!--03 link de Administrar -->
                     <a onclick="javascript: return admin_users();" class="ax1_link" title="Administrar los datos de la Empresa y sus usuarios"> Administrar </a>
                     <span class="span_link">
                     <img width="25" height="20" border="0" src="images/boton_admin.png"/>
                     </span>		
                     <?php
						  }
					 ?>
                     <!--04 link Página de Inicio --> 
                     <a onclick="javascript: return pagina_principal();" class="ax1_link" title="Ir a la p&aacute;gina de Inicio"> P&aacute;gina Principal</a>
                     <span class="span_link" style="margin-top:-6px; margin-right:3px;">
                     <img width="21" height="21" border="0" src="images/boton_inicio.png"/>
                     </span>
                 <!-- </div>  -->
                </div>
        </div>
<!-- CONTENEDOR DE LOS MÓDULOS -->
<div class="main_content">
<?php
      if (file_exists($path_modulo))  {
		  include_once($path_modulo);  
	  } else {
		  die('Error al cargar el módulo <b>'.$modulo.'</b>.  No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>' );
	  }
?> 
</div>  <!-- Fin del <div class="main_content">   --> 