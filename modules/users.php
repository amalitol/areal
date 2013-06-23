<?php
/*
* Este es el módulo que muestra LOS USUARIOS QUE VAN A ESTAR REGISTRADOS EN EL SISTEMA (PRIMERO A LLENAR)
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*/
/*
* COMÚN: MUESTRA LO QUE ES COMÚN PARA TODAS LAS VISTAS.
*
* VISTA1: VISTA QUE MUESTRA EL FORMULARIO CUANDO QUIERO INSERTAR UN NUEVO USUARIO  ( $_GET['optionusers'] == new )
*
*
* VISTA2: VISTA QUE MUESTRA EL FORMULARIO CUANDO QUIERO CAMBIAR LA CONTRASEÑA DE UN USUARIO  ( $_GET['optionusers'] == ch_pass )
*
*
* VISTA3: VISTA QUE MUESTRA LAS TABLAS CON TODOS LOS USUARIOS (default) ( empthy($_GET['optionusers']) || isset($_GET['acc']
*
*/

// no direct access
defined('VALID_VAR') or die;

?>
        <!--  ********************************************** COMÚN ******************************************** --------------->

<p> Bienvenido usuario al m&oacute;dulo USUARIOS donde usted podr&aacute; Crear y Actualizar los datos de todos los usuarios del sistema.GRACIAS</p>
   
   <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES  
   *************************************************************************************************************-->
                
      <div id="radiobar_users" class="buttons_bar_full"> 
        <form>
	       
		      <input type="radio" id="radio_users1" name="radio" <?php if (isset($_GET['optionusers']) && $_GET['optionusers'] == "new" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_users1" title="Crear nuevo usuario del sistema.">Nuevo Usuario</label>
              <input type="radio" id="radio_users2" name="radio" <?php if (isset($_GET['optionusers']) && $_GET['optionusers'] == "ch_pass" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_users2" title="Modificar la contrase&ntilde;a de un usuario seleccionado.">Cambiar Contrase&ntilde;a</label>
		      	       
        </form>
      </div>
 
          
 <!---------------**********************************  VISTA1 **************************+*************---------------->
 
<?php
     if ( isset($_GET['optionusers']) && $_GET['optionusers'] == "new" )    {
	    // Esto es cuando le doy al botón NUEVO USUARIO

         $locales_vendedor = show_locales();  // Para mostrar los locales ALMACÉN a los que se puede asignar un VENDEDOR.
                                              // Función del módulo INVENTARIO
?>
   
   <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                 
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Usuarios" href="javascript:void(0)" onclick="goinicio_users('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
      
         <!-- *******************************************************************************************
                                       1. FORMULARIO DE ENTRADA/EDICIÓN DE DATOS
            *********************************************************************************************  --> 
       <div class="include_form" id="new_user">
       
         <form action="" method="post" name="form_new_user" id="form_new_user">
           <fieldset class="fieldset_form">   
            <legend> Nuevo Usuario </legend>
            
            <!--  PRIMER <div> PARA LOS DATOS DE INVENTARIO  -->
            
           <span"> &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; a&ntilde;adir todos los usuarios que usted necesite en el sistema. Por favor llene los campos del formulario. GRACIAS</span>
            <div class="inline_line" style="min-width:800px; margin-top:10px;">
                             
               <table class="table_fieldset" style="min-width:350px; width:40%;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="min-width:140px;"> Nombre y Apellidos </td>
                  <td style="min-width:210px"> <div> <input class="text_form" type="text" name="nombre_apellidos" id="nombre_apellidos" value="" maxlength="100" style="width: 93%;" placeholder="Nombre y Apellidos" /> </div> </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td> Nombre de Usuario </td>  
                   <td> <input class="text_form" type="text" name="nombre_usuario" id="nombre_usuario" value="" maxlength="100" style="width: 93%;" placeholder="Usuario" /> </td>
                 </tr>
                 
                 <!-- Aquí pongo el campo hidden para saber si es 'true' ó 'false' que el usuario existe o no¿?  -->
                 <input type="hidden" id="hidden_user_name" name="hidden_user_name" value="" />
                   
                 <!-- FILA 3 -->
                 <tr>
                   <td> Contrase&ntilde;a </td>  
                   <td> <input class="text_form" type="password" name="contrasena" id="contrasena" value="" maxlength="100" style="width: 93%;" placeholder="Contrase&ntilde;a" /> </td>
                 </tr>
                 
                 <!-- CAMPO HIDDEN CON EL VALOR DE LA CONTRASEÑA DEL NUEVO USUARIO ENCRIPTADA -->
                 <input type="hidden" name="contrasena_hidden" value="" />
                  
                 <!-- FILA 4 -->
                 <tr>
                   <td> Confirme Contrase&ntilde;a </td>  
                   <td> <input class="text_form" type="password" name="confirm_contrasena" id="confirm_contrasena" value="" maxlength="100" style="width: 93%;" placeholder="Contrase&ntilde;a" /> </td>
                 </tr>
                 
                 <!-- FILA 5 -->
                 <tr>  
                   <td> Tipo de Usuario </td>
                   <td> <select name="tipo_usuario" id="tipo_usuario" class="text_form" style="width: 98.6%; padding-right:2px; padding-left:2px;">                             <option value="s" style="font-weight:800;"> Seleccione </option>
                             <option value="a"> Administrador </option>
                             <option value="v"> Vendedor </option>   
                        </select>
                   </td>           
                  </tr>
                            
               </table> 
                                  
                <!-- CONTENEDOR <div> DATOS DEL LOCAL PARA EL USUARIO VENDEDOR -->
              <div id="div_almacen" style="display:none; margin-top: 10px; min-width:362px; min-height:80px; float:left; padding:0px;">
              <fieldset class="fieldset_form" style="padding:6px 2px 15px 6px;">   
                <legend> Local para el Usuario </legend> 
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:40%;"> Seleccione el Local </td>
                  <td style="width:60%;"> 
                       <select name="id_almacen" id="id_almacen" class="text_form" style="width: 98.2%; padding-right:2px; padding-left:2px;">                          <option value="s" style="font-weight:800;"> Seleccione </option>
                    <?php        
                          if ( $locales_vendedor != "null" )  {    
						  // Si $locales_vendedor == null significa que no se ha introducido ningún local.   
						      for ( $i=0; $i < count($locales_vendedor); $i++ )
						      {
						         switch($locales_vendedor[$i]['id'])
								 {
								 case "1":
								       continue;
								 default:
								        echo "<option value=\"".$locales_vendedor[$i]['id']."\"> ".stripslashes($locales_vendedor[$i]['nombre_local'])." &nbsp;(".$locales_vendedor[$i]['tipo_local'].") </option>";	
								 }
							  }
					      }
				   ?> 
                       </select>
                  </td>
                 </tr> 
                                      
               </table> 
              </fieldset>
             </div>    
                               
         <br style="line-height:20px;"/>         
              
              <!--  <div> CON LOS BOTONES DE SUBMIT -->
         <div style="min-height:40px; float:left; min-width:345px; padding-left:255px;">
           <p>
           <input type="hidden" name="id_user" value="" /> <!-- Esto me dá el id del usuario cuando lo voy a editar, sino 'nuevo'   -->
           
           <input type="submit" id="submit_new_user" value="Crear Usuario" style="float:left; margin:5px 0px; padding:3px 7px;" onclick="return send_user();" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
       
           <!-- ****************************************** AJAX ***************************************************-->
                 <!-- 04 <div> que me dice si el NOMBRE DE USUARIO EXISTE O NO -> funciona con AJAX <- -->   
                 <div id="show_message_user_name" style="color:blue; position:absolute; top:310px; left:420px; min-height:20px;"> </div>
                                                    
                 <!-- ********************************************************************************************
                           DIV DEL CARGANDO QUE SE MUESTRA CUANDO HAGO EL blur EN EL CÓDIGO DEL ARTÍCULO (ajax)
                 ******************************************************************************************* --> 
                 <div id="charging_user_name" style="display: none; position:absolute; top:263px; left:700px;">
                    <center>
                        <img src='images/fieldset_ajax_loader.gif' border='0' />
                    </center>
                 </div> 
            
                 <!-- ********************************************************************************************
                            DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
                 ******************************************************************************************* --> 
                 <div id="server_error_charging_user_name" style="display:none; position:absolute; top:263px; left:500px; width:455px;">
           
                      <img src='images/fieldset_ajax_loader.gif' border='0' style="vertical-align: middle;;" /> 
                      <span class="ajax_error_box">Problema al comprobar el c&oacute;digo.Intente m&aacute;s tarde.Gracias </span>
           
                 </div> 
                      
          <!-- *************************************************************************************************************-->
                  
             <!---------------**********************************  VISTA2 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['optionusers']) && $_GET['optionusers'] == "ch_pass" )    {
	    // Esto es cuando le doy al botón CAMBIAR CONTRASEÑA
?>
      
   <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                 
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Usuarios" href="javascript:void(0)" onclick="goinicio_users('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
         
        <!-- *******************************************************************************************
                                       1. FORMULARIO DE ENTRADA/EDICIÓN DE DATOS
            *********************************************************************************************  --> 
       <div class="include_form" id="new_user">
       
         <form action="" method="post" name="form_change_pass" id="form_change_pass">
           <fieldset class="fieldset_form">   
            <legend>Cambiar Contrase&ntilde;a</legend>
            
            <!--  PRIMER <div> PARA CAMBIAR LA CONTRASEÑA  -->
            
           <span"> &nbsp; Estimado usuario usted en esta pesta&ntilde;a usted podr&aacute; cambiar la contrase&ntilde;a de cualquiera de los usuarios del sistema.GRACIAS</span>
            <div class="inline_line" style="min-width:800px; margin-top:10px;">
                     
               <table class="table_fieldset" style="min-width:350px; width:40%; margin-top:20px;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:53%; text-align:right;"> Seleccione el Usuario </td>
                  <td style="width:47%;"> 
                                            
                      <!--****************************************************************************************
                             div DONDE VOY A PONER EL USUARIO QUE QUIERO CAMBIAR LA CONTRASEÑA
                          ****************************************************************************************--> 
                         <div class="autocomplete_change_pass"> 
                             <input class="text_form" type="text" id="change_pass_usuario" name="change_pass_usuario" value="" maxlength="100" style="width: 225px;" placeholder="Seleccione el usuario" /> 
                                            
                             <!-- ESTE ES EL id DEL USUARIO PARA GAURDAR ACTUALIZAR LA CONTRASEÑA EN LA BD  -->
                             <input type="hidden" name="id_usuario" value=""  /> 
                         </div>
                  
                         <!-- <div> del botón para buscar al usuario por el Nombre -->
                         <div id="div_search_cliente" style="position:absolute; top:12px; left:444px;">
                             <input type="button" value="Buscar" id="search_cliente_to_change_pass" style="padding:3px 7px;" />
                         </div>
                                   
                  </td>
                 </tr> 
                                      
               </table> 
                   
                    <!-- ********************************************************************************************
                                   DIV DEL CARGANDO QUE SE MUESTRA CUANDO VOY A EDITAR ALGUN USUARIO (ajax)
                         ******************************************************************************************* --> 
                         <div id="cargando_user" style="display:none; float:right; margin:10px 20px 10px 0;">
                            <center>
                               <img src='images/ajax-loader.gif' border='0' />
                            </center>
                         </div> 
            
                    <!-- ********************************************************************************************
                                     DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
                         ******************************************************************************************* --> 
                         <div id="server_error_user" style="display:none; float:right; margin:10px 20px 10px 0;">
           
                             <img src='images/ajax-loader.gif' border='0' style="vertical-align: middle;;" /> 
                             <span class="ajax_error_box">Problema en el servidor. Intente m&aacute;s tarde. Gracias </span>
           
                         </div> 
                              
              <!--*****************************************************************************************************
                          CONTENEDOR <div> DEL MENSAJE DE ERROR CUANDO NO SE ENCUENTRA EL USUARIO 
                  ****************************************************************************************************-->
            <div class="message_wrong" id="error_user_mesage" style="display:none; margin:20px 0px 10px 0; width:80%;">  </div>     
                            
              <!--*****************************************************************************************************
                                           CONTENEDOR <div> DATOS DEL LOCAL PARA EL USUARIO VENDEDOR 
                  ****************************************************************************************************-->
         <div id="div_user" style="display:none; margin-top: 20px; min-width:430px; min-height:80px; float:left; padding:0px;">
              <fieldset class="fieldset_form" style="padding:6px 2px 15px 6px;">   
                <legend> Datos del Usuario </legend> 
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:35%; padding:4px;"> Nombre de Usuario: </td>
                   <td style="width:65%; padding:4px; text-align:left;" id="push_user_name">      </td>
                 </tr> 
                 <!-- FILA 2 -->
                 <tr>
                  <td style="padding:4px;"> Nombre y Apellidos: </td>
                  <td style="padding:4px; text-align:left;" id="push_full_name">      </td>
                 </tr> 
                 <!-- FILA 3 -->
                 <tr>
                  <td style="padding:4px;"> Tipo de Usuario: </td>
                  <td style="padding:4px; text-align:left;" id="push_user_type">      </td>
                 </tr>
                 <!-- FILA 4 -->
                 <tr>
                  <td style="padding:4px;"> Estado: </td>
                  <td style="padding:4px; text-align:left;" id="push_state">      </td>
                 </tr> 
                                      
               </table> 
              </fieldset>
         </div>    
                  
             <br style="line-height:150px;"/>  
                            
             <!-- ******************************************************************************************************
                                 TABLA DE PARA CAMBIAR LA CONTRASEÑA
                  *************************************************************************************************-->
            <div id="change_pass_table" style="display:none;">             
             <table class="table_fieldset" style="min-width:435px; width:40%;">    
                  
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:70%;"> Nueva Contrase&ntilde;a </td>  
                   <td style="width:30%;"> <input class="text_form" type="password" name="contrasena_chp" id="contrasena_chp" value="" maxlength="100" style="width:225px;" placeholder="Contrase&ntilde;a" /> </td>
                 </tr>
                 
                 <!-- CAMPO HIDDEN CON LA CONTRASEÑA NUEVA CAMBIADA ENCRIPTADA -->
                 <input type="hidden" name="contrasena_chp_hidden" value="" />
                                 
                 <!-- FILA 2 -->
                 <tr>
                   <td> Confirme Nueva Contrase&ntilde;a </td>  
                   <td> <input class="text_form" type="password" name="confirm_contrasena_chp" id="confirm_contrasena_chp" value="" maxlength="100" style="width:225px;" placeholder="Contrase&ntilde;a" /> </td>
                 </tr>
                                                              
               </table> 
                       
         <br style="line-height:10px;"/>         
              
              <!--  <div> CON LOS BOTONES DE SUBMIT -->
         <div style="min-height:40px; float:left; min-width:345px; padding-left:285px;">
           <p>
           <input type="hidden" name="id_user" value="" /> <!-- Esto me dá el id del usuario cuando lo voy a editar, sino 'nuevo'   -->
           
           <input type="submit" value="Cambiar Contrase&ntilde;a" style="float:left; margin:5px 0px; padding:3px 5px;" onclick="return change_userpass();" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
        <div>  <!-- FIN DEL div id="change_pass_table"  -->                    
              
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
                
       
              <!---------------**********************************  VISTA3(DEFAULT) **************************+*************---------------->       
       
<?php
	 } else if ( empty($_GET['optionusers']))    {
	    // Esto es cuando no está seleccionado ningún boton de la barra de botones.

       $general_users = general_users();        // Tabla que muestra los datos generales de los usuarios del sistema.
	   $usuarios_del_sistema = users_system();  // Tabla que me muestra todos los usuarios del sistema

?>
     
       <!-- ********************************************************************************************
               2.  TABLA QUE TIENE LA INFORMACIÓN GENERAL DE USUARIOS DEL SISTEMA 
          ******************************************************************************************* -->

       
         <!-- TABLA CON LOS REGISTROS DE LOS USUARIOS DEL SISTEMA  -->
        <div style="width:30%; float:right;" id="show_users_general">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
             <th style="width:100%; color:gray; background-color:#F2F2F2; min-width:150px;" colspan="8">INFORMACI&Oacute;N GENERAL DE USUARIOS DEL SISTEMA</th>
           </tr>
           
           <!-- FILA 1 -->
           <tr >
              <td style="width: 70%; font-size: 0.9em; min-width:100px; background-color:#056AA8; color:#FFFFFF;"> TOTAL DE USUARIOS </td>
              <td style="width: 40%; font-size: 0.9em; min-width:50px;"> <?php echo $general_users[0];  ?> </td>
           </tr>
           
           <!-- FILA 2 -->
           <tr> 
              <td style="font-size: 0.9em; min-width:100px; background-color:#056AA8; color:#FFFFFF;"> USUARIOS ACTIVOS </td>
              <td style="font-size: 0.9em; min-width:50px;"> <?php echo $general_users[1];  ?> </td>
           </tr>
           
           <!-- FILA 3 -->
           <tr>
              <td style="font-size: 0.9em; min-width:100px; background-color:#056AA8; color:#FFFFFF;"> USUARIOS INACTIVOS </td>
              <td style="font-size: 0.9em; min-width:50px;"> <?php echo $general_users[2];  ?> </td>
           </tr>   
         
         </table> 
       </div>
             
        <!-- *******************************************************************************************
                                        MENSAJES DE INSERCIÓN DE USUARIOS A LA BD 
            *********************************************************************************************  -->       
<?php 
         if ( isset($_GET['atype']))  {
		 
		     if ( $_GET['atype'] == "ok" )   {
			 //CASO 1. Esto significa que se INSERTÓ correctamente el usuario en la BD.       
?>        
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> Usuario insertado correctamente a la Base de Datos. GRACIAS </div> 


<?php 
			 } else if ( $_GET['atype'] == "chp" )   {
			 //CASO 2. Esto significa que se UPDATE correctamente la NUEVA CONTRASEÑA en la BD.       
?>        
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> Contrase&ntilde;a actualizada correctamente a la Base de Datos. GRACIAS </div>

<?php
		     }
		 }
            
?>       
     <!-- ********************************************************************************************
               2.  TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS USUARIOS DEL SISTEMA 
          ******************************************************************************************* -->

<?php
      if ( count($usuarios_del_sistema) == 0 )   {
		  // Esta verificación es para que no me salga la tabla VACÍA al inicio cuando no he creado ninguna BODEGA.
	  } else {
 
?>       
         <!-- TABLA CON LOS REGISTROS DE LOS USUARIOS DEL SISTEMA  -->
        <div style="width:100%; margin-top:15px;" id="show_users">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="8"> INFORMACI&Oacute;N DE USUARIOS DEL SISTEMA </th>
           </tr>
           
           <tr >
              <th style="width: 4%; min-width: 24px;"> # </th>
              <th style="width: 10%; font-size: 0.9em; min-width:40px;"> DESHABILITAR </th>
              <th style="width: 25%; font-size: 0.9em; min-width:80px;"> USUARIO </th>
              <th style="width: 26%; font-size: 0.9em; min-width:80px;"> NOMBRE Y APELLIDOS </th>
              <th style="width: 25%; font-size: 0.9em; min-width:50px;"> TIPO DE USUARIO </th>
              <th style="width: 10%; font-size: 0.9em; min-width:40px;"> ESTADO </th>
           </tr>
         </table> 
       
        <form name="data_users" action="" method="post"  >
         <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($usuarios_del_sistema); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			  echo "<td style=\"width: 4%; min-width:24px; \">".($i + 1)."</td>"; 
			  			  
			  /*********** 1. Compruebo si no sea el id=1 (NO SE DESHABILITA) **********/
			  if ( $usuarios_del_sistema[$i]['id_usuario'] == 1 )  {
			      // EL PRIMER USUARIO 'ADMINISTRADOR' NO SE PUEDE DESHABILITAR
			      $accion = "";
				  $accion_state = "1"; 
			  } else {
			       /*********** 2. Compruebo si el usuario está habilitado o deshabilitado **********/
			       if ( $usuarios_del_sistema[$i]['habilitar'] == 1 )  {
        		      // Esto es cuando el usuario está HABILITADO.
				      $accion = "deshabilitar";    
			          $accion_state = "0";
			       } else if ( $usuarios_del_sistema[$i]['habilitar'] == 0 )  {
			          // Esto es un usuario está DESHABILITADO
				      $accion = "habilitar";
				      $accion_state = "1";
			       }
			  }
				  		  
			  echo "<td style=\"width:10%; font-size: 0.9em; min-width:40px; \"> <a style=\"color:blue; \" href=\"javascript:void(0)\" onclick=\"accion_users('".$usuarios_del_sistema[$i]['id_usuario']."','".$accion_state."')\">".$accion." </a>
			  
			  <input type=\"hidden\" name=\"id_usuario\" value=\"".$usuarios_del_sistema[$i]['id_usuario']."\" />
			  
			  </td>"; 
			  
			  echo "<td style=\"width:25%; text-align:left; font-size:0.9em; min-width:80px; \" >".stripslashes($usuarios_del_sistema[$i]['usuario'])."</td>";
		      echo "<td style=\"width:26%; text-align:left; font-size:0.9em; min-width:80px; \" >".stripslashes($usuarios_del_sistema[$i]['nombre_completo'])."</td>";
			  
			  /*********** 2. Compruebo si es administrador o vendedor **********/
			  if ( $usuarios_del_sistema[$i]['tipo_usuario'] == "a" )  {
        		  // Esto es cuando el usuario es ADMINISTRADOR.
				  $tipo_local = "Administrador Bodega";    
			  } else if ( $usuarios_del_sistema[$i]['tipo_usuario'] == "v" )  {
			      // Esto es un usuario VENDEDOR
				  $tipo_local = "Vendedor Almac&eacute;n";
			  }
			  			  
			  echo "<td style=\"width: 25%; text-align: left;font-size: 0.9em; min-width:50px;\">".$tipo_local." ".$usuarios_del_sistema[$i]['nombre_local']."</td>";
		      
			  /*********** 3. Compruebo si el usuario está habilitado en 1 ó 0 **********/
			  if ( $usuarios_del_sistema[$i]['habilitar'] == 1 )  {
				  // Esto significa que el usuario está HABILITADO.  
			      $estado = "habilitado";
			      $color = "green";
			  } else if ( $usuarios_del_sistema[$i]['habilitar'] == 0 )  {
			      // Esto significa que el usuario está DESHABILITADO.
		          $estado = "deshabilitado";
			      $color = "red";
			  }
			  			  
			  echo "<td style=\"width:10%; text-align:center; font-size: 0.9em; min-width:40px; color:".$color."\">".$estado."</td>";
			echo "</tr>";
		 }
            
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
	 
<?php  
	
	}  // Fin del if ( count($usuarios_del_sistema) == 0 )   {

?>
<?php
	 } // Fin de los if($_GET['optionusers'])....
?>
         