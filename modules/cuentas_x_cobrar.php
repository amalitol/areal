<?php
/*
* Este es el módulo que muestra las CUENTAS POR COBRAR DEL USUARIO.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
* 
* COMÚN: MUESTRA LO QUE ES COMÚN PARA TODAS LAS VISTAS.
*
*
* VISTA1: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --NUEVO REGISTRO--  ( $_GET['optioncxc == 'new_in'] )
*
*
* VISTA2: VISTA CORRESPONDIENTE AL FORMULARIO DE EDITAR CUALQUIER REGISTRO PARA ACTUALIZAR LOS DATOS DE ESE REGISTRO Y ADEMÁS MUESTRA LA TABLA CON TODAS LAS ACTUALIZACIONES DE ESE REGISTRO   ( $_GET['edit_cxc == 1,2,3...(id)] ) 
*
*-----------------------------------------------------> REPORTES
*
*
* VISTA3: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --CONSULTA POR MES/AÑO--  ( $_GET['optioncxc == 'consulta'] )
*
*
* VISTA4: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --VER MES ACTUAL--  ( $_GET['optioncxc == 'actual'] )
*
*
*------------------------------------------------------> DEFAULT
*
* VISTA5: VISTA CORRESPONDIENTE A LA TABLA CON TODOS LOS REGISTROS INSERTADOS POR EL USUARIO.(default)
*
*
*/
// no direct access
defined('VALID_VAR') or die;
?>
      <!-------------****************************************** COMÚN *****************************************--------------------->

 <p> Bienvenido usuario al m&oacute;dulo de Cuentas por Cobrar donde usted podr&aacute; actualizar y ver los registros de sus Cuentas por Cobrar en el SSC. Por favor utilice el formulario para introducir datos. GRACIAS</p>
    
     <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES  Y REPORTES
   *************************************************************************************************************-->
    
    <div id="radiobar_cxc" class="buttons_bar_full">  
      
         <form>
	          <input type="radio" id="radio1" name="radio" <?php if (isset($_GET['optioncxc']) && $_GET['optioncxc'] == "new_in" ) { echo "checked=\"checked\""; }  ?> /><label for="radio1" title="Crear nuevo registro de cuenta por cobrar."> Nuevo Registro </label>
           
      <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE REPORTES 
      *************************************************************************************************************-->
                     
          <span style="float:right; margin-right:4px;"> 
	          <input type="radio" id="radio2" name="radio" <?php if (isset($_GET['optioncxc']) && $_GET['optioncxc'] == "consulta" ) { echo "checked=\"checked\""; }  ?> /><label for="radio2" title="Ver todos los registros de cuentas por cobrar del mes/a&ntilde;o seleccionado."> Consulta por mes/a&ntilde;o </label>
		      <input type="radio" id="radio3" name="radio" <?php if (isset($_GET['optioncxc']) && $_GET['optioncxc'] == "actual" ) { echo "checked=\"checked\""; }  ?> /><label for="radio3" title="Ver todos los registros de cuentas por cobrar del mes actual."> Ver mes actual </label>
         
          </span>  	       
          <span style="font-size:1.2em; float:right; margin:8px 15px 0 0;"> REPORTES  </span>  
        </form>
             
    </div>  
     
        <!----------------**********************************  VISTA1 *********************************---------------------->
<?php
   
   if( isset($_GET['optioncxc']) && $_GET['optioncxc'] == "new_in" )  {
	   // Esto es cuando le doy al botón NUEVO REGISTRO DE LA BARRA DE BOTONES.
  
?>   
      <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
              
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Cuentas por Cobrar" href="javascript:void(0)" onclick="inicio_cxc_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
  
      <!-- *******************************************************************************************
                        FORMULARIO de entrada de DATOS DE REGISTROS DE CUENTAS POR COBRAR
            *********************************************************************************************  --> 
             
       <div class="include_form" id="nuevo_registro_cxc">
                
         <form action="" method="post" name="form_cuentas_x_cobrar">
           <fieldset class="fieldset_form">   
            <legend> Crear Nuevo Registro </legend>
            
            <!--  PRIMER CONTENEDOR <div>  -->
            <div class="inline_line">
               <!-- 01 <div> CONTENEDOR DE LOS CAMPOS QUE ESTÁN ARRIBA EN LA PARTE SUPERIOR-->
               <div style="width: 100%;">
                
                 <!-- 01 PRIMER <div>  Fecha de compra:   -->
                  <div style="margin-right:10px; float:left;">
                    <p style="height: auto;">       
                      <span style="float: left;"> Fecha de Registro: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="fecha_registro_cxc" value="" id="fecha_cobrar" maxlength="20" placeholder="Fecha r." style="width: 70px; margin-right:30px;"/> 
                    </p>
                   </div>
               
                <!-- 02 SEGUNDO <div>  Cliente:   --> 
                 
                   <div class="autocomplete_cxc"> 
                     
                     <span style="float: left;"> Cliente: </span>
                     <br style="line-height:1.0em;" />
                     <input class="text_form" type="text" name="cliente" value="" id="search_cliente" maxlength="50" placeholder="Cliente" autocomplete="off" style="width: 300px;" /> 
                     
                     <!-- Campo hidden con el id del cliente que se guarda en la BD. -->
                     <input type="hidden" name="cliente_id" value="" />
                                
                   </div> 
                   
                   <!-- 03 TERCER <div>  Valor a Cobrar($):  -->
                   <div style="margin-right:10px; position:absolute; top:0px; left:455px;">
                      <p style="height: auto;">       
                        <span style="float: left;"> Valor del Cobro($): </span>
                        <br style="line-height:1.2em;" />
                        <input class="text_form" type="text" name="valor_cobro" value="" maxlength="20" placeholder="Valor a Cobrar" style="width: 90px; margin-right:40px;"/> 
                     </p>
                   </div>
               </div>
              
         <!-- CONTENEDOR DE LOS CAMPOS QUE ESTÁN DEBAJO DE LOS DE LA PARTE SUPERIOR-->  
           <div style="width:100%; margin-top: 20px; display:block;">   
          
          <!-- 01 PRIMER <div>  Detalle:   -->   
              <div style="margin-right:10px; position:absolute;">
                 <p>
                   <span style="float:left; width:50%;"> Detalle del Registro: </span>
                   <br style="line-height:1.5em;" />
                   <textarea class="textarea_form" style="width: 300px; height: 80px;" name="detalle_registro"> </textarea>
                </p>
              </div>
            
           <!-- 02 SEGUNDO0 <div>  Fecha de vencimiento:   -->
               <div style="margin-right:10px; position:absolute; left: 320px;">
                   <p style="height: auto;">       
                     <span style="float: left;"> Fecha de vencimiento: </span>
                     <br style="line-height:1.2em;" />
                     <input class="text_form" type="text" name="fecha_vencimiento" value="" id="fecha_vencimiento_cxc" maxlength="20" placeholder="Fecha v." style="width: 70px; margin-right:40px;"/> 
                   </p>
                </div>
               </div> 
            
               <div style="min-height:40px; position:absolute; top:180px; left:5px;">
                     
                   <p>
                   <input type="submit" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return send_mes_cuentas_x_cobrar();" />
                   <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
                   </p> 
                   
               </div>  <!-- fin del div -->
                  
            </div>  <!-- fin del div class="inline_line"   -->
          
           </fieldset>
         </form>   
     </div>    <!--   <div class="include_form">  -->
           
     
     <!---------------**********************************  VISTA2 *********************************---------------->

<?php
   }  else if( isset($_GET['edit_cxc']) )  {
	  // Esto es para cuando quiero mostrar el fomulario de Edición de algún registro y muestro la tabla con todos los registros.
?>    
    <!-- *******************************************************************************************
                        FORMULARIO de entrada de DATOS PARA UN EDIT DE UN REGISTRO DE CUENTAS POR COBRAR
            *********************************************************************************************  --> 
<?php
       // Función que devuelve los datos actuales del registro que quiero EDITAR
       $registro_values_cxc = registro_values_cxc();
	   $cxc_register = select_registros_cxc();        // Devuelve los registros de los pagos de una CXC.
?>       
       <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
           
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Cuentas por Cobrar" href="javascript:void(0)" onclick="inicio_cxc_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
     
         <!-- *******************************************************************************************
                        FORMULARIO de entrada de DATOS PARA UN EDIT DE UN REGISTRO DE CUENTAS POR COBRAR
            *********************************************************************************************  --> 
      
       <div class="include_form">
                
         <form action="" method="post" name="form_edit_cuentas_x_cobrar" >
           <fieldset class="fieldset_form">   
           <?php 
           if ( $registro_values_cxc['fin_registro'] == "1" )  {
			   // ESTO SIGNIFICA QUE YA TERMINÓ DE PAGARSE LA CUENTA.
			   $apt_cxc = "Ver";   
		       $min_height_cxc = "200px;";
		   } else {
			   // ESTO SIGNIFICA QUE NO SE HA PAGADO LA CUENTA.   
		       $apt_cxc = "Editar";
			   $min_height_cxc = "535px;";
		   } 
           ?> 
                     
            <legend> <?php echo $apt_cxc; ?> el Registro <?php echo $_GET['edit_cxc'];  ?></legend>
            
            <!--  PRIMER CONTENEDOR <div>  -->
            <div class="inline_line" style="min-height:<?php echo $min_height_cxc; ?> width: 100%;">
               <!-- CONTENEDOR DE LOS CAMPOS QUE ESTÁN ARRIBA EN LA PARTE SUPERIOR-->
               <div style="width: 100%;">
                
                 <!-- 01 PRIMER <div>  Fecha de compra:   -->
                  <div style="margin-right:10px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> Fecha de Registro: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="fecha_registro" value="<?php echo stripslashes($registro_values_cxc['fecha_registro']);  ?>" id="fecha_cobrar" maxlength="20" placeholder="Fecha r." style="width: 70px; margin-right:30px;"/> 
                    </p>
                   </div>
                               
                   <!-- 02 SEGUNDO <div>  Cliente:   --> 
                   <div class="autocomplete_cxc"> 
                                          
                     <span style="float: left;"> Cliente: </span>
                     <br style="line-height:1.0em;" />
                     <input class="text_form" type="text" name="cliente" value="<?php echo stripslashes($registro_values_cxc['nombre']);  ?>" id="search_cliente" maxlength="50" placeholder="Cliente" autocomplete="off" style="width: 300px;" /> 
                     
                     <!-- Campo hidden con el id del cliente que se guarda en la BD. -->
                     <input type="hidden" name="cliente_id" value="<?php echo stripslashes($registro_values_cxc['cliente']);  ?>" />
                                
                   </div> 
                               
                <div style="float:left; width:200px; position:absolute; left: 480px;">
                 <!-- 03 TERCER <div>  Valor a Pagar($):  -->
                   <div style="margin-right:10px; float:left;">
                    <p style="height: auto;">       
                     <span style="float: left;"> Valor Total del Cobro($): </span>
                     <br style="line-height:1.2em;" />
                     <input class="text_form" type="text" name="valor_cobro" value="<?php echo stripslashes($registro_values_cxc['valor_deuda']);  ?>" maxlength="20" placeholder="Valor a Cobrar" style="width: 90px; margin-right:40px;"/> 
                    </p>
                   </div>
           
                   <!-- 06 SEXTO <div>  Valor INGRESADO($):  -->
                   <div style="margin: 10px 0 0 0; float:left;">
                     <p style="height: auto;">       
                       <span style="float: left;"> Valor Ingresado($): </span>
                       <br style="line-height:1.2em;" />
                       <input class="text_form" type="text" name="valor_ingresado" value="<?php echo stripslashes($registro_values_cxc['valor_ingresado']);  ?>" maxlength="20" placeholder="Valor Ingresado" disabled="disabled" style="width: 90px; margin-right:40px; color:#00F;"/> 
                    </p>
                  </div>
                   
              <!-- 07 SEPTIMO <div>  SALDO($):  -->
                 <div style="margin: 10px 0 0 0; float:left;">
                  <p style="height: auto;">       
                    <span style="float: left;"> Saldo($): </span>
                    <br style="line-height:1.2em;" />
                    <input class="text_form" type="text" name="valor_saldo" value="<?php echo stripslashes($registro_values_cxc['saldo']);  ?>" maxlength="20" disabled="disabled" style="width: 90px; margin-right:40px; color:#D40000;"/> 
                 </p>
               </div>
              
              </div> 
           
           </div>
                 
         <!-- CONTENEDOR DE LOS CAMPOS QUE ESTÁN DEBAJO DE LOS DE LA PARTE SUPERIOR-->  
           <div style="width:100%; margin-top: 20px;">   
          
          <!-- 01 PRIMER <div>  Detalle:   -->   
              <div style="margin-right: 10px; position:absolute;">
                 <p>
                   <span style="float: left; width: 50%; "> Detalle: </span>
                   <br style="line-height:1.5em;" />
                   <textarea class="textarea_form" style="width: 300px; height: 80px;" name="detalle_registro"><?php echo stripslashes($registro_values_cxc['detalle_registro']); ?></textarea>
                </p>
              </div>
            
           <!-- 02 SEGUNDO0 <div>  Fecha de vencimiento:   -->
               <div style="margin-right:10px; position:absolute; left: 320px;">
                    <p style="height: auto;">       
                      <span style="float: left;"> Fecha de vencimiento: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="fecha_vencimiento" value="<?php echo stripslashes($registro_values_cxc['fecha_vencimiento']); ?>" id="fecha_vencimiento" maxlength="20" placeholder="Fecha v." style="width: 70px; margin-right:40px;"/> 
                    </p>
                   </div>
           </div> 
<?php           
      if ( $registro_values_cxc['fin_registro'] == "0" )   {       
          // ESTO SIGNIFICA QUE PUEDO EDITAR EL REGISTRO PUES NO SE HA TERMINADO.
?>             
           
           <!-- CONTENEDOR DE LOS CAMPOS QUE ESTÁN EN EL TERCER ESCALÓN HACIA ABAJO ( LOS NUEVOS DE ENTRADA DE DATOS ) -->  
           <div style="width:100%; margin-top: 10px; position:absolute; top:190px; left:0px;">    
            <fieldset class="fieldset_form">   
               <legend> Actualizar el Registro <?php echo $_GET['edit_cxc'];  ?> </legend>
            
              <!-- CONTENEDOR DE LOS CAMPOS QUE ESTÁN DEBAJO DE LOS DE LA PARTE SUPERIOR ( TERCER ESCALÓN )-->  
              <div style="width:100%; margin-top: 10px; float:left;"> 
               <!-- 01 PRIMER <div>  Fecha de actualización:   -->
                  <div style="margin-right:10px; float:left;">
                    <p style="height: auto;">       
                      <span style="float: left;"> Fecha: </span>
                      <br style="line-height:1.2em;" />
                      <input class="text_form" type="text" name="fecha_actualizacion" value="" id="fecha_actualizacion_cxc" maxlength="20" placeholder="Fecha act." style="width: 70px; margin-right:30px;"/> 
                    </p>
                   </div>
                         
               <!-- 02 SEGUNDO <div>  Radio botones de selección:  -->
                 <div style="margin: 15px 10px 0 0; float:left;" >
                  <p style="height: auto;">       
                    <label> <input type="radio" id="radio_ingresar_todo" name="ingresar" value="todo" onchange="return disable_valor_ingresar();" onfocus="return disable_valor_ingresar();" /> Ingresar todo ( Cerrar el registro )  </label> 
                   <br />
                   <label> <input type="radio" id="radio_ingresar_parte" name="ingresar" value="una_parte" onchange="return able_valor_ingresar();" onfocus="return able_valor_ingresar();" /> Ingresar s&oacute;lo una parte del total </label> 
                   <br />
                  </p>
                 </div>
               
              <!-- 03 TERCER <div>  Valor a abonar($):  -->
                 <div style="margin-right:10px; float:left;" >
                  <p style="height: auto;">       
                    <span style="float: left;"> Valor a Ingresar($): </span>
                    <br style="line-height:1.2em;" />
                    <input class="text_form" type="text" name="valor_act_ingreso" value="" maxlength="20" placeholder="Valor a Ingresar" style="width:100px; margin-right:40px;" id="valor_act_ingreso"  disabled="disabled" /> 
                 </p>
                </div>
            
             </div>
            
             <!-- CONTENEDOR DE LOS CAMPOS QUE ESTÁN DEBAJO DE LOS DE LA PARTE SUPERIOR ( TERCER ESCALÓN )-->  
             <div style="width:100%; margin-top: 10px; float:left;"> 
              <!-- 01 PRIMERO <div>  SELECT EL ORIGEN DEL PAGO:   -->   
              <div style="margin-right: 10px;">
                 <p>
                   <span style="float: left; width: 80%; "> Destino del Cobro: </span>
                   <!-- <br style="line-height:1.5em;" />  -->
                         <select name="origen_cobro_cxc" id="origen_cobro_cxc" class="text_form" style="width: 90%; padding-right:2px; padding-left:2px;" disabled="disabled">                            
                            <option value="seleccione"> Seleccione </option>    
                            <option value="banco"> Cheque a la Cuenta de Banco </option> 
                            <option value="caja"> Efectivo a la Caja Central </option>
                            <option value="otros"> Otros </option>
                        </select>
                 </p>
               </div>
             </div>
                 
             <!-- CONTENEDOR DE LOS CAMPOS QUE ESTÁN DEBAJO DE LOS DE LA PARTE SUPERIOR ( CUARTO ESCALÓN ESCALÓN )-->  
             <div style="width:100%; margin-top: 10px; float:left;"> 
              <!-- 01 PRIMERO <div>  Detalle:   -->   
              <div style="margin-right: 10px;">
                 <p>
                   <span style="float: left; width: 80%; "> Detalle de actualizaci&oacute;n: </span>
                   <br style="line-height:1.5em;" />
                   <textarea class="textarea_form" style="width: 300px; height: 80px;" name="detalle_edit"></textarea>
                </p>
              </div>
             </div>
                
            </fieldset>
           
           <!-- CAMPO hidden CON EL NÚMERO DE LA VENTA -->
           <input type="hidden" name="no_venta" value="<?php echo $registro_values_cxc['no_venta'];  ?>" />
               
           </div>   <!-- Fin del tercer  <div style="width:100%; margin-top: 10px;">     -->
           
            <!--  TERCER <div>  -->
              <div style="min-height:40px; position:absolute; top:484px; left:5px;">
                     
                <p>
                <input type="submit" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return send_edit_mes_cuentas_x_cobrar();" />
                <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
                </p> 
                    
              </div>  <!-- fin del div  -->  

<?php
 
   } // Fin del if ( $registro_values_cxc['fin_registro'] == "0" )   {

?>              
           
           </div>  <!-- fin del div class="inline_line"   -->
                   
          <!--01 Con esto tengo el id del registro  -->        
          <input type="hidden" name="id" value="<?php echo $_GET['edit_cxc']; ?>"  /> 
          <!--02 Con esto tengo valor abonado hasta la fecha de ese registro  -->        
          <input type="hidden" name="valor_ingresado" value="<?php echo stripslashes($registro_values_cxc['valor_ingresado']);  ?>"  /> 
          <!--03 Con esto tengo el saldo que queda hasta la fecha en ese registro  -->        
          <input type="hidden" name="saldo" value="<?php echo stripslashes($registro_values_cxc['saldo']);  ?>"  /> 
        
           </fieldset>
         </form>   
     </div>    <!--   <div class="include_form">  -->
      
     <!-- **********************************************************************************************
                                 TABLA CON EL REGISTRO PRINCIPAL DE LOS DATOS DE ESTE REGISTRO 
         ********************************************************************************************** -->

<?php
     
	//02 AHORA MUESTRO LA TABLA SI HAY ACTUALIZACIONES EN LOS REGISTROS, SINO NO LA MUESTRO 
    if ( $cxc_register != "null" )  {   
         	
?>         
     
     <div style="margin:10px 0 15px 0px; width:100%;">
       <table class="table_form" cellspacing="0" cellpadding="0">
         <tr >
            
            <th style="width: 3%;"> # </th>
            <th style="width: 8%; font-size: 0.9em; min-width:80px;"> FECHA ACT. </th>
            <th style="width: 60%;"> DETALLE </th>
            <th style="width: 9%; font-size: 0.9em; min-width:85px;"> VALOR TOTAL </th>
            <th style="width: 12%; font-size: 0.9em; min-width:85px;"> VALOR INGRESADO </th>
            <th style="width: 8%; font-size: 0.9em; min-width:80px;"> SALDO </th>
             
        </tr>
       </table> 
     
       <table class="table_form" cellspacing="0" cellpadding="0"> 

<?php         
         for ( $i=0; $i < count($cxc_register); $i++ )
		 {
			 //02 MUESTRO LA TABLA CON LAS ACTUALIZACIONES DE LAS CONSULTAS PARA ESE REGISTRO
			 echo "<tr>";
			 echo "<td style=\"width: 3%;\" >".($i+1)."</td>"; 
			 echo "<td style=\"width: 8%; font-size: 0.9em; min-width:80px; \">".stripslashes($cxc_register[$i]['fecha_actualizacion'])."</td>"; 
			 echo "<td style=\"width: 60%; text-align:left; \" >".stripslashes($cxc_register[$i]['detalle_edit'])."</td>";
		     echo "<td style=\"width: 9%; font-size: 0.9em; min-width:85px;\" >".stripslashes($cxc_register[$i]['valor_abono'])."</td>";
			 echo "<td style=\"width: 12%; font-size: 0.9em; min-width:85px;\" >".stripslashes($cxc_register[$i]['valor_act_abono'])."</td>";
			 echo "<td style=\"width: 8%; font-size: 0.9em; min-width:80px;\" >".stripslashes($cxc_register[$i]['saldo'])."</td>";
			 echo "</tr>";
		 }
            
?>           
        </table>
   
     </div>

<?php

   } else {
	  // SINO HAY NUNGUNA ACTUALIZACIÓN DEL REGISTRO QUE NO ME MUESTRE NADA   
	   
   } 

?>   
 
<!----------------**********************************  VISTA3 *********************************---------------------->
<?php
   
   } else if( isset($_GET['optioncxc']) && $_GET['optioncxc'] == "consulta" )  {
	   // Esto es cuando le doy al botón CONSULTA POR MES/AÑO DE LA BARRA DE BOTONES.
       if ( isset($_GET['mesanocxc']) && $_GET['mesanocxc'] == "send" ) {
	   
	        $mes_ano_cxcobrar = process_form_mesano_cxc($_POST['mes_consulta_cxcobrar'],$_POST['ano_consulta_cxcobrar']);
	  
	   }
?>

   <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
       
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Cuentas por Cobrar" href="javascript:void(0)" onclick="inicio_cxc_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
 
<?php   
   if ( isset($_GET['mesanocxc']) && $_GET['mesanocxc'] == "send" ) {
?>	   
      <!-- Botón de IMPRIMIR  -->  
         <div class="cabecera_botton">
            <a title="Imprimir reporte." href="index.php?mod=mod_imprimir&cxc=1&mes=<?php echo $_POST['mes_consulta_cxcobrar']; ?>&y=<?php echo $_POST['ano_consulta_cxcobrar']; ?>" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div>   
<?php 
   }
?>     
    <!-- ******************************************************************************************************** 
                  TABLA DE CONSULTAS DE REGISTROS DE LAS CUENTAS POR COBRAR DE UN MES A SELECCIONAR  
   *************************************************************************************************************-->
    
    <div class="form_superior"> 
      
      <div style="float:left; margin-top:3px;">
       <form action="#" method="post" name="form_mes_cxcobrar">
        <span style="text-shadow: #A4A4A4 1.5px 1.5px 1px;"> Consultar las Cuentas por Cobrar del mes/a&ntilde;o: </span>        
            <select name="mes_consulta_cxcobrar" style="width:100px; border:1px solid #A2A2A2; margin-left:5px;"> 
              <option value="01"> Enero </option> 
              <option value="02"> Febrero </option>
              <option value="03"> Marzo </option>
              <option value="04"> Abril </option>
              <option value="05"> Mayo </option>
              <option value="06"> Junio </option>
              <option value="07"> Julio </option>
              <option value="08"> Agosto </option>
              <option value="09"> Septiembre </option>
              <option value="10"> Octubre </option>
              <option value="11"> Noviembre </option>
              <option value="12"> Diciembre </option>
            </select>
                             
            <select name="ano_consulta_cxcobrar" style="width:65px;  border:1px solid #A2A2A2; margin-left:5px;"> 
              <option value="2012"> 2012 </option> 
              <option value="2013"> 2013 </option>  
              <option value="2014"> 2014 </option> 
              <option value="2015"> 2015 </option>  
              <option value="2016"> 2016 </option> 
              <option value="2017"> 2017 </option>  
              <option value="2018"> 2018 </option> 
              <option value="2019"> 2019 </option>  
              <option value="2020"> 2020 </option> 
              <option value="2021"> 2021 </option>  
              <option value="2022"> 2022 </option> 
              <option value="2023"> 2023 </option>  
              <option value="2024"> 2024 </option> 
              <option value="2025"> 2025 </option>  
              <option value="2026"> 2026 </option> 
              <option value="2027"> 2027 </option>  
              <option value="2028"> 2028 </option> 
              <option value="2029"> 2029 </option>
              <option value="2030"> 2030 </option> 
            </select>   
         
           <input type="submit" value="Aceptar" style="width:70px; padding:1px 7px; margin-left:10px;" onclick="return send_mesano_cuentas_x_cobrar();" />
        
       </form>  
      </div>
     </div> 
  
<?php
    if ( isset($_GET['mesanocxc']) && $_GET['mesanocxc'] == "send" )  {
	   // Esto es para cuando mando el formulario que me envía el mes y el año que quiero saber sus registros.
     
	   // MUESTRO EL MES Y EL AÑO DEL QUE QUIERO SABER EL REGISTRO. 
	   echo "<div style=\"clear:both; font-size:1.1em;\">".$mes_ano_cxcobrar[0]." ".$mes_ano_cxcobrar[1]."</div>";  
	   echo "<br />";
	
	    // COMPRUEBO PARA CUANDO NO EXISTEN REGISTROS DEL MES SOLICITADO 
	    if ( $mes_ano_cxcobrar[2] === "ningun_registro" )  {
               
?>	      
            <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> NO EXISTEN REGISTROS PARA EL MES SOLICITADO. GRACIAS </div>
<?php		  
	
	    } else {
           // EN ESTE CASO EXISTEN REGISTROS DEL MES SOLICITADO 
?>  
	        <!-- TABLA CON EL SALDO DEL MES ANTERIOR AL SOLICITADO -->
            <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:55%;">
             <tr>    
               <td style="width: 80%; color: white; background-color:#056AA8;">  Total del valor pendiente en el mes de <?php echo $mes_ano_cxcobrar[0]; ?> del a&ntilde;o <?php echo $mes_ano_cxcobrar[1]; ?> </td>
               <td style="width: 20%;"> <?php echo $mes_ano_cxcobrar[2]; ?>  </td>
             </tr>
           </table>

         <!-- TABLA CON LOS REGISTROS DEL MES SOLICITADO  -->
          <div style="margin-top: 20px; width:100%;">
           <table class="table_form" cellspacing="0" cellpadding="0">
             <tr >
                <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE REGISTROS DE CUENTAS POR COBRAR    </th>
             </tr>
             <tr >
               <th style="width: 3%; font-size: 0.9em; min-width:30px;"> id </th>
               <th style="width: 4%; font-size: 0.9em; min-width:40px;"> Editar </th>
               <th style="width: 8%; font-size: 0.9em; min-width:80px;"> FECHA REG. </th>
               <th style="width: 8%; font-size: 0.9em; min-width:80px;"> FECHA VENC. </th>
               <th style="width: 5%; font-size: 0.9em; min-width:60px;"> # VENTA </th>
               <th style="width: 3%; font-size: 0.9em; min-width:33px;"> idL </th>
               <th style="width: 22%;"> CLIENTE </th>
               <th style="width: 22%;"> DETALLE </th>
               <th style="width: 9%; font-size: 0.9em; min-width:70px;"> VALOR TOTAL </th>
               <th style="width: 9%; font-size: 0.9em; min-width:75px;"> VALOR COBRADO </th>
               <th style="width: 7%; font-size: 0.9em; min-width:70px;"> SALDO </th>
              </tr>
            </table> 

            <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
              for ( $i=3; $i < count($mes_ano_cxcobrar); $i++ )
		      {
			      // Esto es para marcar en ROJO los que hayan sido afectados 
			      if ( $mes_ano_cxcobrar[$i]['fin_registro'] == "1" )  {
				      $style = "color: blue;";
					  $action = "Ver";
			      } else {
			          $style = "";
					  $action = "Editar";	 
			      }
			 
			      //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			      echo "<tr>";
			        echo "<td style=\"width:3%; font-size: 0.9em; min-width:30px; ".$style." \" >".$mes_ano_cxcobrar[$i]['id']."</td>"; 
			        echo "<td style=\"width:3%; font-size: 0.9em; min-width:40px; ".$style." \"> <a style=\"".$style."\" href=\"index.php?mod=mod_cuentas_x_cobrar&edit_cxc=".$mes_ano_cxcobrar[$i]['id']."#tabs-4\" >".$action."</a> </td>"; 
			        echo "<td style=\"width:8%; font-size: 0.9em; min-width:80px; ".$style." \" >".stripslashes($mes_ano_cxcobrar[$i]['fecha_registro'])."</td>";
		            echo "<td style=\"width:8%; font-size: 0.9em; min-width:80px; ".$style." \" >".stripslashes($mes_ano_cxcobrar[$i]['fecha_vencimiento'])."</td>";
			        // Esto es para que no se muestre el número de venta si este es 0 (Se ha entrado por formulario) 
			            if ( $mes_ano_cxcobrar[$i]['no_venta'] == "0" )  {
			                $no_venta = "";
			            } else {
			                $no_venta = $mes_ano_cxcobrar[$i]['no_venta'];
			            }
					echo "<td style=\"width:5%; font-size:0.9em; min-width:55px; ".$style." text-align: center; \">".$no_venta."</td>";
			        // Esto es para que no se muestre el local si este es 1 (Se ha entrado por formulario) 
			            if ( $mes_ano_cxcobrar[$i]['local_venta'] == "1" )  {
			                $local_venta = "";
			            } else {
			                $local_venta = $mes_ano_cxcobrar[$i]['local_venta'];
			            } 
					echo "<td style=\"width:3%; font-size:0.9em; min-width:33px; ".$style." text-align: center; \" title=\"Almac&eacute;n ".stripslashes($mes_ano_cxcobrar[$i]['nombre_local']).".\">".$local_venta."</td>";
					echo "<td style=\"width:22%; font-size: 0.9em; text-align: justify; ".$style." \">".stripslashes($mes_ano_cxcobrar[$i]['nombre'])."</td>";
		            echo "<td style=\"width:22%; font-size: 0.9em; text-align: justify; ".$style." \">".stripslashes($mes_ano_cxcobrar[$i]['detalle_registro'])."</td>";
			        echo "<td style=\"width:9%; font-size: 0.9em; min-width:70px; ".$style." \">".stripslashes($mes_ano_cxcobrar[$i]['valor_deuda'])."</td>";
			        echo "<td style=\"width:9%; font-size: 0.9em; min-width:75px; ".$style." \" >".stripslashes($mes_ano_cxcobrar[$i]['valor_ingresado'])."</td>";
			        echo "<td style=\"width:7%; font-size: 0.9em; min-width:70px; ".$style." \">".stripslashes($mes_ano_cxcobrar[$i]['saldo'])."</td>";
		          echo "</tr>";
		       }  // Fin del for
            
?>               
             </table>
           </div>  <!-- FIN DEL <div style="margin-top: 20px; width:100%;">  -->
 
<?php
	   }  // Fin del if ( $mes_ano_cxcobrar[2] == "ningun_registro" )  {

   }  // Fin del if ( isset($_GET['mesanocxc']) && $_GET['mesanocxc'] == "send" ) {
?>	 

   
 <!----------------**********************************  VISTA4 *********************************---------------------->
<?php
   
   } else if( isset($_GET['optioncxc']) && $_GET['optioncxc'] == "actual" )  {
	   // Esto es cuando le doy al botón VER MES ACTUAL DE LA BARRA DE BOTONES.
 
       $cuentas_x_cobrar_register = cuentas_x_cobrar_mes_actual();  // Registros de las cuentas por cobrar del mes actual.
       $fecha = gmdate('Y-m-d', time() - 18000 );    // Variable de la fecha para colorear las CUENTAS POR COBRAR.
?>
   <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                  
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Cuentas por Cobrar" href="javascript:void(0)" onclick="inicio_cxc_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>  
   
         <!-- Botón de IMPRIMIR   -->   
         <div class="cabecera_botton">
            <a title="Imprimir reporte." href="index.php?mod=mod_imprimir&cxc=2" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div>  
          
          
          <!-- ************************************************************************************************
                     TABLA QUE MUESTRA EL TOTAL DEL VALOR A COBRAR EN EL MES ACTUAL (SUM. DE TODOS LOS SALDOS)
                ************************************************************************************************ -->
                
         <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:45%; clear:both; margin-bottom:20px;">
           <tr>    
              <td style="width: 70%; color: white; background-color:#056AA8;">  Total del valor a cobrar en el mes actual </td>
              <td style="width: 30%;"> <?php echo $cuentas_x_cobrar_register[0]['contador']; ?>  </td>
           </tr>
         </table>
     
    <!-- *******************************************************************************************
                        MENSAJE DE ALERTA CUANDO NO EXISTEN CUENTAS POR COBRAR EN LA TABLA cuentas_x_cobrar EN EL MES ACTUAL
           *********************************************************************************************  --> 
<?php
     if ( $cuentas_x_cobrar_register[0]['exist'] == "no" )  {
?>		 
         <div class="message_wrong" style="margin-top:0px; width:99%;"> No existen CUENTAS POR COBRAR en la Base de Datos para el mes actual</div> 
<?php	 
	 }  else  {   
?>                              
                 <!-- **********************************************************************************************
                                   TABLA CON TODOS LOS REGISTROS/LOS REGISTROS DE ESTE MES 
                     ********************************************************************************************** -->
       
       <table class="table_form" cellspacing="0" cellpadding="0">
         <tr >
            <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE REGISTROS DE CUENTAS POR COBRAR    </th>
         <tr >
         <tr>   
            <th style="width: 3%; font-size: 0.9em; min-width:30px;"> id </th>
            <th style="width: 4%; font-size: 0.9em; min-width:40px;"> Editar </th>
            <th style="width: 8%; font-size: 0.9em; min-width:80px;"> FECHA REG. </th>
            <th style="width: 8%; font-size: 0.9em; min-width:80px;"> FECHA VENC. </th>
            <th style="width: 5%; font-size: 0.9em; min-width:60px;"> # VENTA </th>
            <th style="width: 3%; font-size: 0.9em; min-width:33px;"> idL </th>
            <th style="width: 22%;"> CLIENTE </th>
            <th style="width: 22%;"> DETALLE </th>
            <th style="width: 9%; font-size: 0.9em; min-width:70px;"> VALOR TOTAL </th>
            <th style="width: 9%; font-size: 0.9em; min-width:75px;"> VALOR COBRADO </th>
            <th style="width: 7%; font-size: 0.9em; min-width:70px;"> SALDO </th>
          </tr>
       </table> 
    
       <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php	
	
	    for ( $i=1; $i < count($cuentas_x_cobrar_register); $i++ )
	    {
			// Esto es para marcar en ROJO los que hayan sido afectados 
			if ( $cuentas_x_cobrar_register[$i]['fin_registro'] == "1" )  {
			   $style = "color: blue; ";
			   $action = "Ver";
			} else {
			   $style = "";	
			   $action = "Editar"; 
			}
					 						 
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			 echo "<td style=\"width: 3%; font-size: 0.9em; min-width:30px;".$style." \" >".$cuentas_x_cobrar_register[$i]['id']."</td>"; 
			 echo "<td style=\"width: 4%; font-size: 0.9em; min-width:40px;".$style."\"> <a style=\"".$style."\" href=\"index.php?mod=mod_cuentas_x_cobrar&edit_cxc=".$cuentas_x_cobrar_register[$i]['id']."#tabs-4\">".$action."</a> </td>"; 
			 echo "<td style=\"width: 8%; font-size: 0.9em; min-width:80px;".$style."\">".stripslashes($cuentas_x_cobrar_register[$i]['fecha_registro'])."</td>";		     
			 $fecha_actual = stripslashes($cuentas_x_cobrar_register[$i]['fecha_vencimiento']);
			 			 
			 if ( $fecha_actual == $fecha && (stripslashes($cuentas_x_cobrar_register[$i]['saldo']) != "0.00")  )  {
			     // Esto es para colorear de AZUL la fecha de vencimiento si se vence HOY.	 
				 $style_today = "color: #D40000; text-decoration: blink underline; ";
		         $mensaje_usuario = "title=\"Cancele este registro que tiene como fecha de vencimiento el d&iacute;a de HOY. GRACIAS\"";
			 } else {
				 // No lo pone de ningun color.
				 $style_today = "";
				 $mensaje_usuario = "";
		     }
			 		 
			 echo "<td ".$mensaje_usuario." style=\"width: 8%; font-size: 0.9em; min-width:80px; ".$style_today." ".$style." \" >".stripslashes($cuentas_x_cobrar_register[$i]['fecha_vencimiento'])."</td>";
			  // Esto es para que no se muestre el número de venta si este es 0 (Se ha entrado por formulario) 
			            if ( $cuentas_x_cobrar_register[$i]['no_venta'] == "0" )  {
			                $no_venta = "";
			            } else {
			                $no_venta = $cuentas_x_cobrar_register[$i]['no_venta'];
			            }
			 echo "<td style=\"width: 5%; text-align: center; font-size: 0.9em; min-width:55px; ".$style." \" >".$no_venta."</td>";
			 // Esto es para que no se muestre el local si este es 1 (Se ha entrado por formulario) 
			            if ( $cuentas_x_cobrar_register[$i]['local_venta'] == "1" )  {
			                $local_venta = "";
			            } else {
			                $local_venta = $cuentas_x_cobrar_register[$i]['local_venta'];
			            } 
			 echo "<td style=\"width:3%; font-size:0.9em; min-width:33px; ".$style." text-align: center; \" title=\"Almac&eacute;n ".stripslashes($cuentas_x_cobrar_register[$i]['nombre_local']).".\">".$local_venta."</td>";
			 echo "<td style=\"width: 22%; text-align: justify; font-size:0.9em; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['nombre'])."</td>";
		     echo "<td style=\"width: 22%; text-align: justify; font-size:0.9em; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['detalle_registro'])."</td>";
			 echo "<td style=\"width: 9%; font-size: 0.9em; min-width:75px; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['valor_deuda'])."</td>";
			 echo "<td style=\"width: 9%; font-size: 0.9em; min-width:70px; ".$style." \" >".stripslashes($cuentas_x_cobrar_register[$i]['valor_ingresado'])."</td>";
			 echo "<td style=\"width: 7%; font-size: 0.9em; min-width:75px; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['saldo'])."</td>";
		    echo "</tr>";
		 }  // Fin del for
?>           
        </table>
<?php   
     } // Fin del if ( $cuentas_x_cobrar_register[0]['exist'] == "no" )  {
?>   
  
  <!----------------**********************************  VISTA5 (DEFAULT) *********************************---------------------->
<?php
   
   } else if( empty($_GET['optioncxc']) && empty($_GET['optioncxc']) )  {
	   // Esta es la vista por defecto, la que se muestra al principio
       
	   $cuentas_x_cobrar_register = select_cuentas_x_cobrar();
?>
   
   <!-- *******************************************************************************************
                 MENSAJE DE ALERTA CUANDO NO EXISTEN CUENTAS POR COBRAR EN LA TABLA cuentas_x_cobrar
           *********************************************************************************************  --> 
<?php
     if ( $cuentas_x_cobrar_register == "null" )  {
?>		 
 
         <div class="message_wrong" style="margin-top:0px; width:99%;"> No existen CUENTAS POR COBRAR en la Base de Datos </div> 

<?php	 
	 }  else  {// Fin del  if ( $num_rows_query_cuentas_x_cobrar == 0 )  {
?>       
    
       <!-- **********************************************************************************************
                                 TABLA CON TODOS LOS REGISTROS 
         ********************************************************************************************** -->
             
       <table class="table_form" cellspacing="0" cellpadding="0">
         <tr >
            <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE REGISTROS DE CUENTAS POR COBRAR    </th>
         </tr>
        
         <tr>
            <th style="width: 3%; font-size: 0.9em; min-width:30px;"> id </th>
            <th style="width: 4%; font-size: 0.9em; min-width:40px;"> Editar </th>
            <th style="width: 8%; font-size: 0.9em; min-width:80px;"> FECHA REG. </th>
            <th style="width: 8%; font-size: 0.9em; min-width:80px;"> FECHA VENC. </th>
            <th style="width: 5%; font-size: 0.9em; min-width:60px;"> # VENTA </th>
            <th style="width: 3%; font-size: 0.9em; min-width:33px;"> idL </th>
            <th style="width: 22%;"> CLIENTE </th>
            <th style="width: 22%;"> DETALLE </th>
            <th style="width: 9%; font-size: 0.9em; min-width:70px;"> VALOR TOTAL </th>
            <th style="width: 9%; font-size: 0.9em; min-width:75px;"> VALOR COBRADO </th>
            <th style="width: 7%; font-size: 0.9em; min-width:70px;"> SALDO </th>
         </tr>
       </table> 
       
       <table class="table_form" id="table_form_pagination_cxc" cellspacing="0" cellpadding="0">  
<?php        
		
        for ( $i=0; $i < count($cuentas_x_cobrar_register); $i++ )
		{
			 // Esto es para marcar en ROJO los que hayan sido afectados 
			 if ( $cuentas_x_cobrar_register[$i]['fin_registro'] == "1" )  {
			     $style  = "color: blue;";
			     $action = "Ver";
			 } else {
			     $style  = "";
				 $action = "Editar";	 
			 }
			 
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			 echo "<td style=\"width:3%; font-size:0.9em; min-width:30px; ".$style." \">".$cuentas_x_cobrar_register[$i]['id']."</td>"; 
			 echo "<td style=\"width:4%; font-size:0.9em; min-width:40px; ".$style." \"> <a style=\"".$style."\" href=\"index.php?mod=mod_cuentas_x_cobrar&edit_cxc=".$cuentas_x_cobrar_register[$i]['id']."#tabs-4\" > ".$action." </a> </td>"; 
			 echo "<td style=\"width:8%; font-size:0.9em; min-width:80px; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['fecha_registro'])."</td>";
		     echo "<td style=\"width:8%; font-size:0.9em; min-width:80px; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['fecha_vencimiento'])."</td>";
			 // Esto es para que no se muestre el número de venta si este es 0 (Se ha entrado por formulario) 
			            if ( $cuentas_x_cobrar_register[$i]['no_venta'] == "0" )  {
			                $no_venta = "";
			            } else {
			                $no_venta = $cuentas_x_cobrar_register[$i]['no_venta'];
			            }
			 echo "<td style=\"width:5%; font-size:0.9em; min-width:55px; ".$style." text-align: center; \">".$no_venta."</td>";
			 // Esto es para que no se muestre el local si este es 1 (Se ha entrado por formulario) 
			            if ( $cuentas_x_cobrar_register[$i]['local_venta'] == "1" )  {
			                $local_venta = "";
			            } else {
			                $local_venta = $cuentas_x_cobrar_register[$i]['local_venta'];
			            } 
			 echo "<td style=\"width:3%; font-size:0.9em; min-width:33px; ".$style." text-align: center; \" title=\"Almac&eacute;n ".stripslashes($cuentas_x_cobrar_register[$i]['nombre_local']).".\">".$local_venta."</td>";
			 echo "<td style=\"width:22%; font-size:0.9em; text-align: justify; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['nombre'])."</td>";
		     echo "<td style=\"width:22%; font-size:0.9em; text-align: justify; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['detalle_registro'])."</td>";
			 echo "<td style=\"width:9%; font-size:0.9em; min-width:70px; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['valor_deuda'])."</td>";
			 echo "<td style=\"width:9%; font-size:0.9em; min-width:75px; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['valor_ingresado'])."</td>";
			 echo "<td style=\"width:7%; font-size:0.9em; min-width:70px; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['saldo'])."</td>";
		    echo "</tr>";
		 }
            
?>           
      </table>
   
       
<?php       
       } // Fin del if ( $cuentas_x_cobrar_register == "null" )  {

   } // Fin  del if (isset($_GET['optioncxc'] or  isset($_GET['edit_cxc'] .....)  FINAL

?>     
