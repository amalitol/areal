<?php
/*
* Este es el módulo que muestra el formulario de entrada de datos para entrar en la aplicación.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*/

// no direct access
defined('VALID_VAR') or die;

?>



               <div class="left_box_form left">
            		<div class="top_form">
                       <center class="h_login"> 
                          <span>
                            <img width="25" height="27" border="0" src="images/key.png" /> Acceso al sistema
                          </span>
                       </center>
                    </div>
                    
				   <?php if (isset($_GET['bad'] ) && $_GET['bad'] == "1" )  {  ?>
    		       <center class="error_message"> Usuario o Contrase&ntilde;a incorrectos. Rectif&iacute;quelos </center> <br />
                   
				   <?php }  else if (isset($_GET['bad'] ) && $_GET['bad'] == "2" )  {  ?>
                   <center class="error_message"> Usuario deshabilitado </center> <br />
                   <?php  }   ?>
                        		
                    <!-- <form> de login  -->
                    
                    <form id="f_login" class="form_login" action="#" method="post" name="form_login">
                    		
                            <div class="n1">Usuario</div>
                            <input class="input_login" name="usuario" type="text" value="" placeholder="Escriba su usuario" autofocus required />
                            <div class="n1">Contrase&ntilde;a</div>
                            <input class="input_login" name="pass" id="pass" value="" type="password" placeholder="Escriba su contrase&ntilde;a" /> 
                            
                            <!-- CAMPO HIDDEN CON CON EL PASSWORD QUE VOY A ENCRIPTAR PARA PROCESAR -->
                            <input type="hidden" name="pass_hidden" value="" />
                           
                            <br />
                            <a id="log_in" class="normal_buttom right" onclick="javascript: return cryptsubmit();" style="cursor:pointer;"> Iniciar sesi&oacute;n </a>
                    	
                    </form>
            </div>
      
            <div class="right_box_container_notes">
            
               <h3> Bienvenido al SSC </h3>
            
               <p style="text-align:justify; text-indent:10px;"> Bienvenido usuario, mediante este sistema usted podr&aacute; llevar un control detallado de las principales operaciones que se realizan en su peque&ntilde;a o mediana empresa. El mismo le facilitar&aacute; la integraci&oacute;n de las distintas &aacute;reas funcionales, permiti&eacute;ndole realizar una gesti&oacute;n de stock e inventario, de compras, ventas, clientes, proveedores, cuentas por pagar y por cobrar, as&iacute; como el chequeo de su registros bancarios. Adem&aacute;s le ser&aacute; posible analizar mediante reportes de status generados en cada m&oacute;dulo, la actividad de su negocio seg&uacute;n sea su inter&eacute;s. </p>
               
              <p style="text-align:justify; text-indent:10px;"> Este programa multiusuario ha sido dise&ntilde;ado bajo una interfaz sencilla e intuitiva con el prop&oacute;sito de facilitarle el trabajo al m&aacute;ximo, permiti&eacute;ndole llevar todas sus operaciones y registros de una manera eficiente, confiable y r&aacute;pida. </p>
                        
            </div>
   