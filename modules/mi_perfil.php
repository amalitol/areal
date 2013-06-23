<?php
/*
* Este es el módulo que muestra los datos del perfil del usuario y le permite cambiar la contraseña.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*/

// no direct access
defined('VALID_VAR') or die;

?>

<center class="mi_perfil">
 <div class="top_form" style="width:99.5%; "> 
   
   <center class="h_login" style="margin-top: 18px;">
     <span> Cambiar Contrase&ntilde;a </span> 
   </center>
   
 </div>
   
      <?php if (isset($_GET['bad'] ) && $_GET['bad'] == "1" )  {  ?>
    	        <center class="error_message"> Usuario o Contrase&ntilde;a incorrectos. Rectif&iacute;quelos </center> <br />
                   
	  <?php }  else if (isset($_GET['bad'] ) && $_GET['bad'] == "2" )  {  ?>
                <center class="error_message"> Usuario deshabilitado </center> <br />
      <?php  }   ?>
   
     <center class="change_pass">
       <form class="form_change_pass" action="#" method="post" name="form_change_pass">
         
<?php      if (isset($_GET['send'] ) && $_GET['send'] == "bad1" )     {  ?>
    		   <center class="error_message"> Contrase&ntilde;a actual erronea. Vuelva a introducir los datos. </center> 

<?php      }  else if (isset($_GET['send'] ) && $_GET['send'] == "ok" )  {  ?>
               <center class="error_message" style="background-color:#06F;"> Su nueva contrase&ntilde;a se ha actualizado correctamente </center> 

<?php      }   ?>
         
         <div class="n1_pass" style="color: gray;">Introduzca su contrase&ntilde;a actual</div>
         <input class="input_login" name="old_pass" type="password" id="old_pass" value="" placeholder="Escriba su contrase&ntilde;a actual" autofocus required />
         
         <!-- CAMPO HIDDEN CON EL VALOR DE LA CONTRASEÑA ANTIGUA ENCRIPTADO -->
         <input type="hidden" name="old_pass_hidden" value="" />
         
         <div class="n1_pass">Introduzca la nueva contrase&ntilde;a</div>
         <input class="input_login" name="new_pass" type="password" id="new_pass" value="" placeholder="Escriba su nueva contrase&ntilde;a" autofocus required />
          
         <!-- CAMPO HIDDEN CON EL VALOR DE LA CONTRASEÑA ACTUAL ENCRIPTADO -->
         <input type="hidden" name="new_pass_hidden" value="" /> 
                            
         <div class="n1_pass">Vuelva a introducir la nueva contrase&ntilde;a</div>
         <input class="input_login" name="new_pass_confirm" value="" type="password" placeholder="Vuelva a escribir su nueva contrase&ntilde;a" required  /> 
             
         <br />
         <a id="log_in" class="normal_buttom" onclick="javascript: return change_pass();" style="cursor:pointer; margin-right:42px;"> Aceptar </a>
                    	
       </form>
     </center>

          <div class="box_link_inicio">
                   <a href="index.php" title="Inicio"> Ir a la p&aacute;gina de inicio </a>
          </div>
        
</center>