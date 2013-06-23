<?php
/*
* Este es el módulo que muestra los CLIENTES.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*
* VISTA1: VISTA QUE MUESTRA EL FORMULARIO CUANDO QUIERO INSERTAR UN NUEVO CLIENTE  ( $_GET['opt'] == new )
*
*
* VISTA2: VISTA QUE MUESTRA EL FORMULARIO CUANDO QUIERO VER ALGUN CLIENTE  ( $_GET['opt'] == ver )
*
*
* VISTA3: VISTA QUE MUESTRA EL FORMULARIO CUANDO QUIERO EDITAR ALGUN CLIENTE  ( $_GET['opt'] == editar )
*
*
* VISTA4: VISTA QUE MUESTRA CUANDO LE DOY DELETE AL BOTÓN "BORRAR"   ( $_GET['opt'] == delete )
*
*
* VISTA5: VISTA QUE MUESTRA LA TABLA CON TODOS LOS CLIENTES (default)
*
*
*/

// no direct access
defined('VALID_VAR') or die;

?>

<p> Bienvenido Administrador al m&oacute;dulo de Clientes donde usted podr&aacute; crear, ver y actualizar los datos de todos los Clientes de su negocio. Por favor utilice el formulario para introducir datos. GRACIAS</p>
              
         <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES  
            *************************************************************************************************************-->
     
      <!--
      <div id="radiobar_c" class="buttons_bar_full"> 
        <form>
	       
		      <input type="radio" id="radio_c1" name="radio" /><label for="radio_c1">Compra Detallada por Cliente</label>
		      <input type="radio" id="radio_c2" name="radio" /><label for="radio_c2">Reportes</label>
		      <input type="radio" id="radio_c3" name="radio" /><label for="radio_c3">Choice 3</label>
	       
        </form>
      </div> -->
        
<!---------------**********************************  VISTA1 ****************************************---------------->

<?php
     if ( isset($_GET['opt']) && $_GET['opt'] == "new" )    {
	    // Esto es cuando le doy al botón NUEVO
?>
        
        <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
        
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Clientes" href="javascript:void(0)" onclick="submitboton('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
       
            <!-- *******************************************************************************************
                        FORMULARIO de entrada de DATOS DE REGISTROS DE NUEVO CLIENTE
            *********************************************************************************************  --> 
      
       <div class="include_form">
                
         <form action="" method="post" name="form_cliente">
           <fieldset class="fieldset_form">   
            <legend> Insertar Nuevo Cliente </legend>
            
            <!--  PRIMER CONTENEDOR <div>  -->
            <div class="inline_line">
               <!-- 1ER CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width: 100%;">
                
                 <!-- 01 <div>  Fecha de registro del cliente:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> Fecha de Registro: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="fecha_registro_cliente" value="" id="fecha_cliente" maxlength="11" placeholder="Fecha r." style="width: 70px; margin-right:30px;"/> 
                    </p>
                   </div>
               
                 <!-- 02  <div>  Nombre del Cliente:   --> 
                   <div style="margin-right:6px;"> 
                     <span style="float: left;"> Nombre del Cliente: </span>
                     <br style="line-height:1.0em;" />
                     <input class="text_form" type="text" name="nombre_cliente" value="" maxlength="50" placeholder="Nombre del Cliente" autocomplete="off" style="width: 300px;" /> 
                   </div> 
                                  
                <!-- checkbox para clientes o proveedores --->
                  <div style="margin-right:6px; margin-top: 13px;">      
                    <label> <input type="checkbox" name="cliente_select" value="on" checked="checked" disabled="disabled"/>Cliente</label> 
                    <br />
                    <label> <input type="checkbox" name="proveedor_select" value="on" />Proveedor</label> 
                    <br />
                  </div>                 
                                          
               </div>   <!-- fin del -- 1ER CONTENEDOR PARA LOS CAMPOS <input> -->
                           
              <!-- 2DO CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
                   
                  <!-- 01 <div>  Dirección del cliente:  -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Direcci&oacute;n del Cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="direccion_cliente" value="" maxlength="70" placeholder="Direcci&oacute;n del Cliente" style="width: 428px; margin-right:10px;"/> 
                     </p>
                   </div>    
            
               </div>   <!--FIN DEL 2DO CONTENEDOR PARA LOS CAMPOS <input> -->
                      
             <!-- 3ER CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
          
                  <!-- 01  <div>  Fax del cliente:   -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Fax del Cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="fax_cliente" value="" maxlength="20" placeholder="Fax" style="width: 120px; margin-right:2px;"/> 
                     </p>
                   </div>   
            
                   <!-- 02  <div>  Teléfono del cliente:   -->
                    <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Tel&eacute;fono del Cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="telefono_cliente" value="" maxlength="20" placeholder="Tel&eacute;fono" style="width: 120px; margin-right:20px;"/> 
                     </p>
                   </div>
                 
                 <!-- 03 <div>  RUC del cliente:  -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> RUC del Cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" id="ruc_cliente"  type="text" name="ruc_cliente" value="" maxlength="20" placeholder="RUC" style="width: 120px; margin-right:20px;"/> 
                     </p>
                   </div>    
                 
                       <!-- <div> que me dice si el RUC EXISTE O NO -> funciona con AJAX <- -->   
                       <div id="show_cliente_message_ruc" style="color:blue; margin-top:30px;"> </div>
                       <!-- <hidden> que me dice si el RUC está en la BD(1) o no(0) -> funciona con AJAX <- -->   
                       <input type="hidden" name="hidden_ruc" value="" />
               
                       <!-- ********************************************************************************************
                                 DIV DEL CARGANDO QUE SE MUESTRA CUANDO VOY A EDITAR ALGUN CONTACTO  (ajax)
                        ******************************************************************************************* --> 
                        <div id="c_charging" style="display: none; float:left; margin-top:30px">
                          <center>
                               <img src='images/fieldset_ajax_loader.gif' border='0' />
                          </center>
                        </div> 
      
      
                      <!-- ********************************************************************************************
                                 DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
                           ******************************************************************************************* --> 
                        <div id="c_server_error_charging" style="display:none; float:left; margin-top:25px;">
           
                             <img src='images/fieldset_ajax_loader.gif' border='0' style="vertical-align: middle;;" /> 
                             <span class="ajax_error_box">Problema en el servidor.Intente m&aacute;s tarde.Gracias </span>
           
                        </div> 
                                 
               </div>  <!-- fin del 3ER CONTENEDOR PARA LOS CAMPOS <input> -->
                         
               <!-- 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
              <div style="width:100%; margin-top: 10px; float:left;">   
           
                <!-- 01 <div>  email del cliente:   -->
                  <div>
                    <p style="height: auto;">       
                      <span style="float: left;"> email del Cliente: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="email_cliente" value="" maxlength="50" placeholder="email" style="width: 274px; margin-right:20px;"/> 
                    </p>
                  </div>
                              
                  <!-- 02 <div> cédula del cliente:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> c&eacute;dula del Cliente: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" id="cedula_cliente" type="text" name="cedula_cliente" value="" maxlength="20" placeholder="c&eacute;dula" style="width: 120px; margin-right:20px;"/>  
                    </p>
                  </div>
                             
                      <!-- ****************************************** AJAX ***************************************************-->
                       <!-- <div> que me dice si la CÉDULA EXISTE O NO -> funciona con AJAX <- -->   
                       <div id="show_cliente_message_cedula" style="color:blue; margin-top:30px;"> </div>
                      <!-- <hidden> que me dice si la CÉDULA está en la BD(1) o no(0) -> funciona con AJAX <- -->   
                       <input type="hidden" name="hidden_cedula" value="" />
                             
                       <!-- ********************************************************************************************
                            DIV DEL CARGANDO QUE SE MUESTRA CUANDO ESTÁ BUSCANDO SI EXISTE O NO LA CÉDULA  (ajax)
                        ******************************************************************************************* --> 
                        <div id="c_carging" style="display: none; float:left; margin-top:30px">
                          <center>
                               <img src='images/fieldset_ajax_loader.gif' border='0' />
                          </center>
                        </div> 
           
                      <!-- ********************************************************************************************
                                 DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
                           ******************************************************************************************* --> 
                        <div id="c_server_error_carging" style="display:none; float:left; margin-top:25px;">
           
                             <img src='images/fieldset_ajax_loader.gif' border='0' style="vertical-align: middle;;" /> 
                             <span class="ajax_error_box">Problema en el servidor.Intente m&aacute;s tarde.Gracias </span>
           
                        </div> 
                      
               <!-- *************************************************************************************************************-->
             
              </div>   <!-- fin del 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
            
              <!-- 5TO CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
                
                 <!-- 01 <div>  Detalle:   -->   
                  <div style="margin-right: 10px;">
                    <p>
                      <span style="float: left; width: 80%; "> Descripci&oacute;n del Cliente: </span>
                      <br style="line-height:1.5em;" />
                      <textarea class="textarea_form" style="width: 435px; height: 80px;" name="descripcion_cliente"></textarea>
                    </p>
                  </div>
            
               </div>   <!-- fin del 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
         
        <!--  SEGUNDO <div>  -->
         <div class="inline_line" style="min-height:40px;">
                     
            <p>
            <input type="submit" id="c_submit" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return send_clientes();" />
            <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
            </p> 
                   
         </div>  <!-- fin del div class="inline_line"   -->
           
         </fieldset>
       </form>   
     </div>    <!--   <div class="include_form">  -->

<?php
	 } else if ( isset($_GET['opt']) && $_GET['opt'] == "ver" )    { 
          // Esto es cuando le doy al botón VER

          //01 Selecciono los datos del cliente que quiero VER de acuerdo a la variable $_GET['id']
          $ver_cliente = ver_cliente($_GET['id']);             // DEVUELVE LOS DATOS DEL CLIENTE.
          $ver_contactos_cliente = ver_contactos_cliente();    // DEVUELVE LOS CONTACTOS DE ESE CLIENTE.
?>
<!---------------**********************************  VISTA2 ***************************************---------------->

   <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                 
        <!-- Botón de IMPRIMIR -->  
         <div class="cabecera_botton">
            <a title="Imprimir reporte de un Cliente." href="index.php?mod=mod_imprimir&cli=2&id=<?php echo $_GET['id']; ?>" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div>  
        
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Clientes" href="javascript:void(0)" onclick="submitboton('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>

        <!-- Botón de NUEVO  -->
         <div class="cabecera_botton">
            <a title="Agregar Nuevo Cliente a la Base de Datos"  href="javascript:void(0)" onclick="return submitboton('new');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_new.png" class="img_botton">
              <br>
              Nuevo
            </a>
         </div>
  
    <!-- ********************************************************************************************
                     AQUÍ COMIENZA EL FORMULARIO CON LOS DATOS DEL CLIENTE QUE QUIERO VER
          ******************************************************************************************* -->
   <div class="include_form">
                
         <form action="" method="post" name="form_cliente">
           <fieldset class="fieldset_form">   
            <legend>Ver Datos del Cliente <?php echo stripslashes($ver_cliente['nombre']);   ?> </legend>
            
            <!--  PRIMER CONTENEDOR <div>  -->
            <div class="inline_line">
               <!-- 1ER CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width: 100%;">
                
                 <!-- 01 <div>  Fecha de registro del cliente:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> Fecha de Registro: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="fecha_registro_cliente" value="<?php echo stripslashes($ver_cliente['fecha_registro']);   ?>" id="fecha_cliente" maxlength="11" style="width: 70px; margin-right:30px; color:#000;" disabled="disabled"  /> 
                    </p>
                   </div>
               
                 <!-- 02  <div>  Nombre del Cliente:   --> 
                   <div style="margin-right:6px;"> 
                     <span style="float: left;"> Nombre del Cliente: </span>
                     <br style="line-height:1.0em;" />
                     <input class="text_form" type="text" name="nombre_cliente" value="<?php echo stripslashes($ver_cliente['nombre']);   ?>" maxlength="40" style="width: 300px; color: #000;" disabled="disabled" /> 
                   </div> 
                                  
                <!-- checkbox para clientes o proveedores --->
                  <div style="margin-right:6px; margin-top: 13px;">      
                    <label> <input type="checkbox" name="cliente_select" value="on" checked="checked" disabled="disabled"/>Cliente</label> 
                    <br />
                    <label> <input type="checkbox" name="proveedor_select" value="on" <?php if ( $ver_cliente['active_proveedor'] == 1 ) { echo "checked=\"checked\""; } ?> disabled="disabled" />Proveedor</label> 
                    <br />
                  </div>                 
                                     
               </div>   <!-- fin del -- 1ER CONTENEDOR PARA LOS CAMPOS <input> -->
                                        
              <!-- 2DO CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
                   
                  <!-- 01 <div>  Dirección del cliente:  -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Direcci&oacute;n del cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="direccion_cliente" value="<?php echo stripslashes($ver_cliente['direccion']);   ?>" maxlength="70" style="width: 428px; margin-right:10px; color:#000;" disabled="disabled" /> 
                     </p>
                   </div>    
            
               </div>   <!--FIN DEL 2DO CONTENEDOR PARA LOS CAMPOS <input> -->
                      
             <!-- 3ER CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
          
                   <!-- 01  <div>  Fax del cliente:   -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Fax del Cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="fax_cliente" value="<?php echo stripslashes($ver_cliente['fax']);   ?>" maxlength="20"  style="width: 120px; margin-right:2px; color:#000;" disabled="disabled" /> 
                     </p>
                   </div>  
            
                   <!-- 02  <div>  Teléfono del cliente:   -->
                    <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Tel&eacute;fono del Cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="telefono_cliente" value="<?php echo stripslashes($ver_cliente['telefono']);   ?>" maxlength="20" style="width: 120px; margin-right:20px; color: #000;" disabled="disabled" /> 
                     </p>
                   </div>
                    
                 <!-- 03 <div>  RUC del cliente:  -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> RUC del Cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="ruc_cliente" value="<?php echo stripslashes($ver_cliente['ruc']);   ?>" maxlength="20"  style="width: 120px; margin-right:20px; color:#000;" disabled="disabled" /> 
                     </p>
                   </div> 
                                      
               </div>  <!-- fin del 3ER CONTENEDOR PARA LOS CAMPOS <input> -->
                           
               <!-- 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
              <div style="width:100%; margin-top: 10px; float:left;">   
           
                <!-- 01 <div>  email del cliente:   -->
                  <div>
                    <p style="height: auto;">       
                      <span style="float: left;"> email del Cliente: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="email_cliente" value="<?php echo stripslashes($ver_cliente['email']);   ?>" maxlength="50" style="width: 274px; margin-right:20px; color:#000;" disabled="disabled" /> 
                    </p>
                  </div>
                                  
                  <!-- 02 <div> cédula del cliente:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> c&eacute;dula del Cliente: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="cedula_cliente" value="<?php echo stripslashes($ver_cliente['cedula']);   ?>" maxlength="20" style="width: 120px; margin-right:20px; color:#000;" disabled="disabled" />  
                    </p>
                  </div>
                                
              </div>   <!-- fin del 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
            
              <!-- 5TO CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
                
                 <!-- 01 <div>  Detalle:   -->   
                  <div style="margin-right: 10px;">
                    <p>
                      <span style="float: left; width: 80%; "> Descripci&oacute;n del Cliente: </span>
                      <br style="line-height:1.5em;" />
                      <textarea class="textarea_form" style="width: 435px; height: 80px; color:#000;" name="descripcion_cliente" disabled="disabled"><?php echo stripslashes($ver_cliente['descripcion']);   ?></textarea>
                    </p>
                  </div>
            
               </div>   <!-- fin del 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
                   
         </fieldset>
       </form>   
     </div>    <!--   <div class="include_form">  -->
    
     <!-- ********************************************************************************************
                 CHEQUEO SI EXISTEN CONTACTOS Y SI NO MUESTRO UN MENSAJE 
       ******************************************************************************************* --> 
<?php
    if ( $ver_contactos_cliente == "null" )   {
        // ESTO SIGNIFICA QUE NO EXISTEN CONTACTOS PARA ESE CLIENTE
?>		
      <div class="message_ok" style="margin:20px 0px 10px 0; width:99.4%;"> No existen CONTACTOS para este CLIENTE en la Base de Datos </div> 
<?php
    }  else  {     
       // APARECE LA TABLA CUANDO HAY CONTACTOS
?>      <!-- ********************************************************************************************
                 TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS CONTACTOS DE LOS CLIENTES" 
       ******************************************************************************************* -->
  
         <!-- TABLA CON LOS REGISTROS DE LOS CLIENTES  -->
        <div style="width:100%; margin-top:20px;">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
             <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE CONTACTOS </th>
           </tr>
           <tr >
              <th style="width: 3%;"> # </th>
              <th style="width: 32%; font-size: 0.9em; min-width:240px;"> NOMBRE DEL CONTACTO </th>
              <th style="width: 10%; font-size: 0.9em; min-width:90px;"> TEL&Eacute;FONO </th>
              <th style="width: 10%; font-size: 0.9em; min-width:90px;"> CELULAR </th>
              <th style="width: 10%; font-size: 0.9em; min-width:90px;"> FAX </th>
              <th style="width: 25%; font-size: 0.9em; min-width:130px;"> EMAIL </th>
              <th style="width: 10%; font-size: 0.9em; min-width:90px;"> C&Eacute;DULA </th>
           </tr>
         </table> 
       
        <form name="clientes_radios" action="" method="post"  >
         <table class="table_form" id="table_pagination_clientes" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($ver_contactos_cliente); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			 echo "<tr>";
			 echo "<td style=\"width: 3%;\">".($i+1)."</td>"; 
			 echo "<td style=\"width: 32%; text-align: justify; font-size: 0.9em; min-width:240px; \" >".stripslashes($ver_contactos_cliente[$i]['nombre_contacto'])."</td>";
		     echo "<td style=\"width: 10%; font-size: 0.9em; min-width:90px; \" >".stripslashes($ver_contactos_cliente[$i]['telefono_contacto'])."</td>";
			 echo "<td style=\"width: 10%; font-size: 0.9em; min-width:90px;  \">".stripslashes($ver_contactos_cliente[$i]['cell_contacto'])."</td>";
		     echo "<td style=\"width: 10%; font-size: 0.9em; min-width:90px;  \">".stripslashes($ver_contactos_cliente[$i]['fax_contacto'])."</td>";
			 echo "<td style=\"width: 25%; font-size: 0.9em; min-width:130px;  \">".stripslashes($ver_contactos_cliente[$i]['email_contacto'])."</td>";
		     echo "<td style=\"width: 10%; font-size: 0.9em; min-width:90px;  \">".stripslashes($ver_contactos_cliente[$i]['cedula_contacto'])."</td>";
			 echo "</tr>";
		 }
            
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->

<?php
	} // fin del else del if ( $ver_contactos_cliente == "null" )   {
?>

<?php
	 } else if ( isset($_GET['opt']) && $_GET['opt'] == "editar" )   {
          // Esto es cuando le doy al botón EDITAR
     
	 //01 Selecciono los datos del cliente que quiero EDITAR de acuerdo a la variable $_GET['id']
      $ver_cliente = ver_cliente($_GET['id']);             // DEVUELVE LOS DATOS DEL CLIENTE.
      $ver_contactos_cliente = ver_contactos_cliente();    // DEVUELVE LOS CONTACTOS DE ESE CLIENTE.
	 
?>
<!---------------**********************************  VISTA3 ***************************************---------------->
   
    <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                  
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Clientes" href="javascript:void(0)" onclick="submitboton('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>

        <!-- Botón de NUEVO  -->
         <div class="cabecera_botton">
            <a title="Agregar Nuevo Cliente a la Base de Datos"  href="javascript:void(0)" onclick="return submitboton('new');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_new.png" class="img_botton">
              <br>
              Nuevo
            </a>
         </div>
     
    <!-- ********************************************************************************************
                     AQUÍ COMIENZA EL FORMULARIO CON LOS DATOS DEL CLIENTE A EDITAR 
          ******************************************************************************************* -->
     
   <div class="include_form" id="add_cliente">
                
         <form action="" method="post" name="form_cliente">
           <fieldset class="fieldset_form">   
            <legend> Editar Datos del Cliente <?php echo stripslashes($ver_cliente['nombre']);   ?> </legend>
            
            <!--  PRIMER CONTENEDOR <div>  -->
            <div class="inline_line">
               <!-- 1ER CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width: 100%;">
                
                 <!-- 01 <div>  Fecha de registro del cliente:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> Fecha de Registro: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="fecha_registro_cliente" value="<?php echo stripslashes($ver_cliente['fecha_registro']);   ?>" id="fecha_cliente" maxlength="11" placeholder="Fecha r." style="width: 70px; margin-right:30px;"  /> 
                    </p>
                   </div>
               
                 <!-- 02  <div>  Nombre del Cliente:   --> 
                   <div style="margin-right:6px;"> 
                     <span style="float: left;"> Nombre del Cliente: </span>
                     <br style="line-height:1.0em;" />
                     <input class="text_form" type="text" name="nombre_cliente" value="<?php echo stripslashes($ver_cliente['nombre']);   ?>" maxlength="40" placeholder="Nombre del Cliente" autocomplete="off" style="width: 300px;" /> 
                   </div> 
                                  
                <!-- checkbox para clientes o proveedores --->
                  <div style="margin-right:6px; margin-top: 13px;">      
                    <label> <input type="checkbox" name="cliente_select" value="on" checked="checked" disabled="disabled"/> Cliente </label> 
                    <br />
                    <label> <input type="checkbox" name="proveedor_select" value="on" <?php if ( $ver_cliente['active_proveedor'] == 1 ) { echo "checked=\"checked\""; } ?> />Proveedor</label> 
                    <br />
                  </div>                 
                             
               </div>   <!-- fin del -- 1ER CONTENEDOR PARA LOS CAMPOS <input> -->
                        
              <!-- 2DO CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
                   
                  <!-- 01 <div>  Dirección del cliente:  -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Direcci&oacute;n del cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="direccion_cliente" value="<?php echo stripslashes($ver_cliente['direccion']);   ?>" maxlength="70" placeholder="Direcci&oacute;n del Cliente" style="width: 428px; margin-right:10px;"/> 
                     </p>
                   </div>    
            
               </div>   <!--FIN DEL 2DO CONTENEDOR PARA LOS CAMPOS <input> -->
                       
             <!-- 3ER CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
          
                   <!-- 01  <div>  Fax del cliente:   -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Fax del Cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="fax_cliente" value="<?php echo stripslashes($ver_cliente['fax']);   ?>" maxlength="20" placeholder="Fax" style="width: 120px; margin-right:2px;"/> 
                     </p>
                   </div>  
            
                   <!-- 02  <div>  Teléfono del cliente:   -->
                    <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Tel&eacute;fono del Cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="telefono_cliente" value="<?php echo stripslashes($ver_cliente['telefono']);   ?>" maxlength="20" placeholder="Tel&eacute;fono" style="width: 120px; margin-right:20px;"/> 
                     </p>
                   </div>
                    
                 <!-- 03 <div>  RUC del cliente:  -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> RUC del cliente: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="ruc_cliente" value="<?php echo stripslashes($ver_cliente['ruc']);   ?>" maxlength="20" placeholder="RUC" style="width: 120px; margin-right:20px;"/> 
                     </p>
                   </div> 
                 
                      
               </div>  <!-- fin del 3ER CONTENEDOR PARA LOS CAMPOS <input> -->
           
                
               <!-- 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
              <div style="width:100%; margin-top: 10px; float:left;">   
           
                <!-- 01 <div>  email del cliente:   -->
                  <div>
                    <p style="height: auto;">       
                      <span style="float: left;"> email del Cliente: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="email_cliente" value="<?php echo stripslashes($ver_cliente['email']);   ?>" maxlength="50" placeholder="email" style="width: 274px; margin-right:20px;"/> 
                    </p>
                  </div>
                              
                  <!-- 02 <div> cédula del cliente:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> c&eacute;dula del Cliente: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="cedula_cliente" value="<?php echo stripslashes($ver_cliente['cedula']);   ?>" maxlength="20" placeholder="c&eacute;dula" style="width: 120px; margin-right:20px;"/>  
                    </p>
                  </div>
                     
              </div>   <!-- fin del 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
            
              <!-- 5TO CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
                
                 <!-- 01 <div>  Detalle:   -->   
                  <div style="margin-right: 10px;">
                    <p>
                      <span style="float: left; width: 80%; "> Descripci&oacute;n del Cliente: </span>
                      <br style="line-height:1.5em;" />
                      <textarea class="textarea_form" style="width: 435px; height: 80px;" name="descripcion_cliente"><?php echo stripslashes($ver_cliente['descripcion']);   ?></textarea>
                    </p>
                  </div>
            
               </div>   <!-- fin del 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
                   
         <input type="hidden" name="id_c" value="<?php echo $_GET['id']; ?>"  />
                  
         </div>  <!-- fin del PRIMER CONTENEDOR div class="inline_line"   -->
         
         <!--  SEGUNDO <div>  -->
         <div class="inline_line" style="min-height:40px;">
                     
            <p>
            <input type="submit" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return edit_clientes();" />
            <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
            </p> 
                   
         </div>  <!-- fin del div class="inline_line"   -->
                   
         </fieldset>
       </form>   
     </div>    <!--   <div class="include_form">  -->
      
      <!-- ********************************************************************************************
                                BOTÓN DE AÑADIR CONTACTO A ESTE CLIENTE
          ******************************************************************************************* -->

      <br />
      <div id="add_contact_cliente" style="width:100%; float: left;">
        
        <a id="add_contact_button_clientes" class="normal_buttom" style="cursor:pointer; float:left;"> A&ntilde;adir Contacto </a>
        
        <a class="normal_buttom" style="cursor:pointer; float:right; margin-right:0px;" onclick="return eliminar_contactos_clientes();"> Eliminar Contacto </a>
      
      </div>
      <br />
            
     <!-- *******************************************************************************************
                 (1)       FORMULARIO de entrada de DATOS DE REGISTROS DE '''NUEVOS''' CONTACTOS            *********************************************************************************************  --> 
         
     <!--*************************************** DETALLES DEL CONTACTO  ************************************-->           
         <div id="new_contact_cliente" style="width:100%; margin-top: 10px; height:auto; display:none;">   
          <form name="add_contacto_cliente" action="" method="post">
           <fieldset class="fieldset_form">   
             <legend> Detalles del Contacto </legend>
                     
             <!-- 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
                       
                 <!-- 01 <div>  Nombre de contacto:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                     <span style="float: left;"> Nombre de contacto </span>
                     <br style="line-height:1.2em;" />
                     <input class="text_form" type="text" name="nombre_contacto" value="" maxlength="50" placeholder="Nombre de Contacto" style="width: 283px; margin-right:40px;"/> 
                    </p>
                  </div>
                       
                </div>    <!-- fin del 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
                           
             <!-- 5TO CONTENEDOR PARA LOS CAMPOS <input> -->
                <div style="width:100%; margin-top: 10px; float:left;">   
           
                  <!-- 01  <div>  Teléfono del contacto:   -->
                    <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Tel&eacute;fono del Contacto: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="telefono_contacto" value="" maxlength="20" placeholder="Tel&eacute;fono" style="width: 120px; margin-right:20px;"/> 
                     </p>
                   </div>
                    
                 <!-- 02  <div>  Celular del contacto:   -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Celular del Contacto: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="cell_contacto" value="" maxlength="20" placeholder="Celular" style="width: 120px; margin-right:20px;"/> 
                     </p>
                   </div>
               
                <!-- 03 <div> Fax del contacto:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> Fax del Contacto: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="fax_contacto" value="" maxlength="20" placeholder="Fax" style="width: 120px; margin-right:20px;"/> 
                    </p>
                  </div>
               
              </div>   <!-- fin del 5TO CONTENEDOR PARA LOS CAMPOS <input> -->
                        
            <!-- 6TO CONTENEDOR PARA LOS CAMPOS <input> -->
              <div style="width:100%; margin-top: 10px; float:left;">   
           
                <!-- 01 <div>  email del contacto:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> email del Contacto: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="email_contacto" value="" maxlength="50" placeholder="email" style="width: 283px; margin-right:20px;"/> 
                    </p>
                  </div>
              
                <!-- 02 <div> Cédula del contacto:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> C&eacute;dula del Contacto: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="cedula_contacto" value="" maxlength="20" placeholder="# c&eacute;dula" style="width: 120px; margin-right:20px;"/> 
                    </p>
                  </div>
              
              </div>   <!-- fin del 6TO CONTENEDOR PARA LOS CAMPOS <input> -->
            
              <input type="hidden" name="id_c" value="<?php echo $_GET['id']; ?>"  />
                                               
            <!--  SEGUNDO CONTENEDOR <div>  -->
            <div class="inline_line" style="min-height:40px;">
                <p>
                <input type="submit" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return send_contacto_cliente();" />
                <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
                </p> 
            </div>  <!-- fin del div class="inline_line"   -->
                           
             </fieldset>
            </form>
           </div> <!-- Fin del <div> contenedor del <fieldset>  -->
                      
          <!-- *******************************************************************************************
                  (2)      FORMULARIO de entrada de DATOS DE REGISTROS DE '''EDITAR''' LOS CONTACTOS                           *********************************************************************************************  --> 
         
     <!--*************************************** DETALLES DEL CONTACTO A EDITAR ************************************-->           
         <div id="edit_contact_cliente" style="width:100%; margin-top: 10px; height:auto; display:none;">   
          <form name="edit_contacto_cliente" action="" method="post">
           <fieldset class="fieldset_form">   
             <legend> Detalles del Contacto a Editar </legend>
                     
             <!-- 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
               <div style="width:100%; margin-top: 10px;">   
                       
                 <!-- 01 <div>  Nombre de contacto:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                     <span style="float: left;"> Nombre de contacto </span>
                     <br style="line-height:1.2em;" />
                     <input class="text_form" type="text" name="nombre_contacto" value="" maxlength="50" placeholder="Nombre de Contacto" style="width: 283px; margin-right:40px;"/> 
                    </p>
                  </div>
                       
                </div>    <!-- fin del 4TO CONTENEDOR PARA LOS CAMPOS <input> -->
                            
             <!-- 5TO CONTENEDOR PARA LOS CAMPOS <input> -->
                <div style="width:100%; margin-top: 10px; float:left;">   
           
                  <!-- 01  <div>  Teléfono del contacto:   -->
                    <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Tel&eacute;fono del Contacto: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="telefono_contacto" value="" maxlength="20" placeholder="Tel&eacute;fono" style="width: 120px; margin-right:20px;"/> 
                     </p>
                   </div>
                    
                 <!-- 02  <div>  Celular del contacto:   -->
                   <div style="margin-right:10px;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Celular del Contacto: </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="cell_contacto" value="" maxlength="20" placeholder="Celular" style="width: 120px; margin-right:20px;"/> 
                     </p>
                   </div>
               
                <!-- 03 <div> Fax del contacto:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> Fax del Contacto: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="fax_contacto" value="" maxlength="20" placeholder="Fax" style="width: 120px; margin-right:20px;"/> 
                    </p>
                  </div>
               
              </div>   <!-- fin del 5TO CONTENEDOR PARA LOS CAMPOS <input> -->
                       
            <!-- 6TO CONTENEDOR PARA LOS CAMPOS <input> -->
              <div style="width:100%; margin-top: 10px; float:left;">   
           
                <!-- 01 <div>  email del contacto:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> email del Contacto: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="email_contacto" value="" maxlength="50" placeholder="email" style="width: 283px; margin-right:20px;"/> 
                    </p>
                  </div>
              
                <!-- 02 <div> Cédula del contacto:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> C&eacute;dula del Contacto: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="cedula_contacto" value="" maxlength="20" placeholder="# c&eacute;dula" style="width: 120px; margin-right:20px;"/> 
                    </p>
                  </div>
              
              </div>   <!-- fin del 6TO CONTENEDOR PARA LOS CAMPOS <input> -->
            
              <!-- AQUÍ EL VALOR DEL CAMPO HIDDEN LO TOMA DEL LA CONSULTA AJAX AL SERVIDOR (valor del id) -->
              <input type="hidden" name="id_contacto" value=""  />
              <!-- AQUÍ EL VALOR DEL CAMPO HIDDEN LO TOMA PARA PODER HACER LA DEVOLUCIÓN ( EL header ) -->
              <input type="hidden" name="id_c" value="<?php echo $_GET['id']; ?>"  />
                        
            <!--  SEGUNDO <div>  -->
            <div class="inline_line" style="min-height:40px;">
                <p>
                <input type="submit" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return  editar_contacto_cliente();" />
                <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
                </p> 
            </div>  <!-- fin del div class="inline_line"   -->
                    
             </fieldset>
            </form>
           </div> <!-- Fin del <div> contenedor del <fieldset>  -->
                
      <!-- ********************************************************************************************
                 DIV DEL CARGANDO QUE SE MUESTRA CUANDO VOY A EDITAR ALGUN CONTACTO  (ajax)
       ******************************************************************************************* --> 
       <div id="cargando_gif" style="display:none; float:right; margin:0 20px 10px 0;">
           <center>
               <img src='images/ajax-loader.gif' border='0' />
           </center>
       </div> 
      
      
      <!-- ********************************************************************************************
                 DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
       ******************************************************************************************* --> 
       <div id="server_error_gif" style="display:none; float:right; margin:0 20px 10px 0;">
           
               <img src='images/ajax-loader.gif' border='0' style="vertical-align: middle;;" /> 
               <span class="ajax_error_box">Problema en el servidor. Intente m&aacute;s tarde. Gracias </span>
           
       </div> 
          
      <!-- ********************************************************************************************
                 MENSAJE DE CONTACTO BORRADO EXITOSAMENTE 
       ******************************************************************************************* --> 

<?php     
    if ( isset($_GET['del']) && $_GET['del'] == "1" )  {
	    // Esto es para mostrar un mensaje de que fueron borrados correctamente los contactos de la BD.	 ( CASO = 1 )  
?>
       <div class="message_ok" style="margin:10px 0 0 0; width:99%;"> Borrado el Contacto exitosamente de la Base de Datos </div>
    
<?php		  
    } else if ( isset($_GET['del']) && $_GET['del'] != "1" )  {
?>     
     
     <div class="message_ok" style="margin:10px 0 0 0; width:99%;"> Borrados los Contactos exitosamente de la Base de Datos </div>
     
<?php		  
    } 
?>     
             
      <!-- ********************************************************************************************
                 CHEQUEO SI EXISTEN CONTACTOS Y SI NO MUESTRO UN MENSAJE 
       ******************************************************************************************* --> 
<?php
    if ( $ver_contactos_cliente == "null" )   {
        // ESTO SIGNIFICA QUE NO EXISTEN CONTACTOS PARA ESE CLIENTE
?>		

      <div class="message_ok" style="margin:15px 0px 10px 0px;"> No existen CONTACTOS para este CLIENTE en la Base de Datos </div> 

<?php
    }  else  {     
       // APARECE LA TABLA CUANDO HAY CONTACTOS
?>      <!-- ********************************************************************************************
                 TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS CONTACTOS DE LOS CLIENTES" 
       ******************************************************************************************* -->
       
         <!-- TABLA CON LOS REGISTROS DE LOS CLIENTES  -->
        <div style="width:100%; margin:15px 0 0 0;">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
             <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE CONTACTOS </th>
           </tr>
           <tr >
              <th style="width: 3%;"> # </th>
              <th style="width: 4%; font-size: 0.9em; min-width:45px;"> EDITAR </th>
              <th style="width: 30%; font-size: 0.9em; min-width:60px;"> NOMBRE DEL CONTACTO </th>
              <th style="width: 10%; font-size: 0.9em; min-width:60px;"> TEL&Eacute;FONO </th>
              <th style="width: 10%; font-size: 0.9em; min-width:60px;"> CELULAR </th>
              <th style="width: 10%; font-size: 0.9em; min-width:60px;"> FAX </th>
              <th style="width: 19%; font-size: 0.9em; min-width:120px;"> EMAIL </th>
              <th style="width: 10%; font-size: 0.9em; min-width:60px;"> C&Eacute;DULA </th>
              <th style="width: 4%; min-width:55px;"> BORRAR </th>
           </tr>
         </table> 
       
        <form name="form_delete_contactos_clientes" action="" method="post"  >
         <table class="table_form" id="table_pagination_clientes" cellspacing="0" cellpadding="0"> 

<?php
        for ( $i=0; $i < count($ver_contactos_cliente); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			 echo "<tr>";
			 echo "<td style=\"width: 3%;\">".($i+1)."</td>"; 
			 echo "<td style=\"width: 4%; font-size: 0.9em; min-width:45px; \"> <input class=\"edit_contact_cliente\" type=\"radio\" name=\"id_contacto\" value=\"".$ver_contactos_cliente[$i]['id']."\"  /> </td>"; 
			 echo "<td style=\"width: 30%; text-align: justify; font-size: 0.9em; min-width:60px; \" >".stripslashes($ver_contactos_cliente[$i]['nombre_contacto'])."</td>";
		     echo "<td style=\"width: 10%; font-size: 0.9em; min-width:60px; \" >".stripslashes($ver_contactos_cliente[$i]['telefono_contacto'])."</td>";
			 echo "<td style=\"width: 10%; font-size: 0.9em; min-width:60px;  \">".stripslashes($ver_contactos_cliente[$i]['cell_contacto'])."</td>";
		     echo "<td style=\"width: 10%; font-size: 0.9em; min-width:60px;  \">".stripslashes($ver_contactos_cliente[$i]['fax_contacto'])."</td>";
			 echo "<td style=\"width: 19%; font-size: 0.9em; min-width:120px;  \">".stripslashes($ver_contactos_cliente[$i]['email_contacto'])."</td>";
		     echo "<td style=\"width: 10%; font-size: 0.9em; min-width:60px;  \">".stripslashes($ver_contactos_cliente[$i]['cedula_contacto'])."</td>";
			 echo "<td style=\"width: 4%; min-width:55px;\"> <input type=\"checkbox\" name=\"".$ver_contactos_cliente[$i]['id']."\" value=\"on\"  /> </td>"; 
			 echo "</tr>";
		 }
            
?>         
        </table>
       
       <input type="hidden" name="id_cliente" value="<?php echo $_GET['id']; ?>"   /> 
       
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->

<?php
	
	}  // fin del else del if ( $ver_contactos_cliente == "null" )   {

?>

<?php
	 } else if ( isset($_GET['opt']) && $_GET['opt'] == "delete" )    {
          // Esto es cuando le doy al botón BORRAR
?>
<!---------------**********************************  VISTA4 ***************************************---------------->

      <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
        
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Clientes" href="javascript:void(0)" onclick="submitboton('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>

        <!-- Botón de NUEVO  -->
         <div class="cabecera_botton">
            <a title="Agregar Nuevo Cliente a la Base de Datos"  href="javascript:void(0)" onclick="return submitboton('new');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_new.png" class="img_botton">
              <br>
              Nuevo
            </a>
         </div>

       <!-- *******************************************************************************************
                        MENSAJE DE REGISTRO BORRADO EXITOSAMENTE DE LA BD
            *********************************************************************************************  -->       
       
        <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> Registro de Cliente Borrado exitosamente de la Base de Datos </div> 

<?php
     //01 BUSCO LOS DATOS DE TODOS LOS CLIENTES
     $clientes_ds = clientes_del_sistema(); 

?>

       <!-- *******************************************************************************************
                        MENSAJE DE ALERTA CUANDO NO EXISTEN CLIENTES EN LA TABLA proveedores_clientes
            *********************************************************************************************  --> 
       
<?php
     if ( $clientes_ds == "null" )  {
		 
?>		 
 
         <div class="message_ok" style="margin-top:0px;"> No existen CLIENTES en la Base de Datos </div> 
  
<?php	 
	 }  else  {// Fin del  if ( $clientes_ds == "null" )  {
?>       
       
       <!-- ********************************************************************************************
          TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS CLIENTES" 
          ******************************************************************************************* -->

       
         <!-- TABLA CON LOS REGISTROS DE LOS CLIENTES  -->
        <div style="width:100%;">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
            
              <th style="width: 3%;">  </th>
              <th style="width: 8%; font-size: 0.9em; min-width:80px;"> FECHA REG. </th>
              <th style="width: 20%; font-size: 0.9em; min-width:100px;"> NOMBRE DEL CLIENTE </th>
              <th style="width: 25%; font-size: 0.9em; min-width:120px;"> DIRECCI&Oacute;N DEL CLIENTE </th>
              <th style="width: 9%; font-size: 0.9em; min-width:85px;"> RUC </th>
              <th style="width: 35%; font-size: 0.9em; min-width:200px;"> DESCRIPCI&Oacute;N </th>
              
           </tr>
         </table> 
       
        <form name="clientes_radios" action="" method="post"  >
         <table class="table_form" id="table_pagination_clientes" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($clientes_ds); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			echo "<td style=\"width: 3%;\"> <input type=\"radio\" name=\"cliente_id\" value=\"".$clientes_ds[$i]['id']."\" /> </td>"; 
			 echo "<td style=\"width: 8%; font-size: 0.9em; min-width:80px; \"> ".stripslashes($clientes_ds[$i]['fecha_registro'])."</td>"; 
			 echo "<td style=\"width: 20%; text-align: justify; font-size: 0.9em; min-width:100px; \" >".stripslashes($clientes_ds[$i]['nombre'])."</td>";
		     echo "<td style=\"width: 25%; text-align: justify; font-size: 0.9em; min-width:120px; \" >".stripslashes($clientes_ds[$i]['direccion'])."</td>";
			 echo "<td style=\"width: 9%; font-size: 0.9em; min-width:85px;  \">".stripslashes($clientes_ds[$i]['ruc'])."</td>";
		     echo "<td style=\"width: 35%; text-align: justify; font-size: 0.9em; min-width:200px;  \">".stripslashes($clientes_ds[$i]['descripcion'])."</td>";
		     echo "</tr>";
		 }
            
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
 
<?php	 
	 }  // Fin del  if ( $clientes_ds == "null" )  {
?>

<?php
	 } else if( empty($_GET['opt']) )  {  
          // Esto es cuando no existe la variable $_GET['option']  PANTALLA POR DEFECTO
		  
?>
<!---------------**********************************  VISTA5 **************************+*************---------------->

         <!-- Botón de IMPRIMIR -->  
         <div class="cabecera_botton">
            <a title="Imprimir reporte de Clientes." href="index.php?mod=mod_imprimir&cli=1" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div>   
         
         <!-- Botón de EDITAR  -->
         <div class="cabecera_botton">
            <a title="Editar datos del Cliente seleccionado." href="javascript:void(0)" onclick="submitboton('editar');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_edit.png" class="img_botton">
              <br>
              Editar
            </a>
         </div>
         
         <!-- Botón de NUEVO  -->
         <div class="cabecera_botton">
            <a title="Agregar Nuevo Cliente a la Base de Datos."  href="javascript:void(0)" onclick="return submitboton('new');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_new.png" class="img_botton">
              <br>
              Nuevo
            </a>
         </div>
         
         <!-- Botón de VER  -->
         <div class="cabecera_botton">
            <a title="Ver datos del Cliente seleccionado."  href="javascript:void(0)" onclick="return submitboton('ver');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_apply.png" class="img_botton">
              <br>
              Ver
            </a>
         </div>

<?php
     //01 BUSCO LOS DATOS DE TODOS LOS CLIENTES 
     $clientes_ds = clientes_del_sistema(); 

?>

 <!-- *******************************************************************************************
                        MENSAJE DE ALERTA CUANDO NO EXISTEN CLIENTES EN LA TABLA proveedores_clientes
            *********************************************************************************************  --> 
       
<?php
     if ( $clientes_ds == "null" )  {
?>		 
         <div class="message_wrong" style="margin-top:0px;"> No existen CLIENTES en la Base de Datos </div> 
<?php	 
	 }  else  {// Fin del  if ( $clientes_ds == "null" )  {
?>     
       <!-- ********************************************************************************************
          TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS CLIENTES" 
          ******************************************************************************************* -->
      
         <!-- TABLA CON LOS REGISTROS DE LOS CLIENTES  -->
        <div style="width:100%;">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
               <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="6"> TABLA DE CLIENTES </th>
           </tr>      
           <tr >
              <th style="width: 3%;">  </th>
              <th style="width: 8%; font-size: 0.9em; min-width:80px;"> FECHA REG. </th>
              <th style="width: 20%; font-size: 0.9em; min-width:100px;"> NOMBRE DEL CLIENTE </th>
              <th style="width: 25%; font-size: 0.9em; min-width:120px;"> DIRECCI&Oacute;N DEL CLIENTE </th>
              <th style="width: 9%; font-size: 0.9em; min-width:85px;"> TELE&Eacute;FONO </th>
              <th style="width: 35%; font-size: 0.9em; min-width:200px;"> DESCRIPCI&Oacute;N </th>
           </tr>
         </table> 
       
        <form name="clientes_radios" action="" method="post"  >
         <table class="table_form" id="table_pagination_clientes" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($clientes_ds); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			  echo "<td style=\"width: 3%;\"> <input type=\"radio\" name=\"cliente_id\" value=\"".$clientes_ds[$i]['id']."\" /> </td>"; 
			  echo "<td style=\"width: 8%; font-size: 0.9em; min-width:80px; \"> ".stripslashes($clientes_ds[$i]['fecha_registro'])."</td>"; 
			  echo "<td style=\"width: 20%; text-align: justify; font-size: 0.9em; min-width:100px; \" >".stripslashes($clientes_ds[$i]['nombre'])."</td>";
		      echo "<td style=\"width: 25%; text-align: justify; font-size: 0.9em; min-width:120px; \" >".stripslashes($clientes_ds[$i]['direccion'])."</td>";
			  echo "<td style=\"width: 9%; font-size: 0.9em; min-width:85px;  \">".stripslashes($clientes_ds[$i]['telefono'])."</td>";
		      echo "<td style=\"width: 35%; text-align: justify; font-size: 0.9em; min-width:200px;  \">".stripslashes($clientes_ds[$i]['descripcion'])."</td>";
		    echo "</tr>";
		 }
            
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
	 
<?php	 
	 }  // Fin del  if ( $clientes_ds == "null" )  {
?>
    
<?php
	 }   // fIN DEL IF REFERIDO A LA VARIABLE option ( ES LA QUE ME DÁ LAS VISTAS )
   
?>        
