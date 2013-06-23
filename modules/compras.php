<?php
/*
* Este es el módulo que muestra las COMPRAS DEL NEGOCIO.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
**************************** VISTAS DE SELECCIÓN DE LA BARRA SUPERIOR ( var $_GET['optioncomp']) ********************
*-------------------------------------------------------------------------------------------------------------------
*
* VISTA1: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --NUEVA COMPRA--  ( $_GET['optioncomp == nueva_compra'] )  
*
*
* --------------------------------------------> REPORTES
*
*
* VISTA2: VISTA QUE MUESTRA LOS REFERIDO AL CLICK EN EL BOTÓN DE LA BARRA --COMPRAS POR PROVEEDOR--  ( $_GET['optioncomp == comp_x_proveedor'] ) 
*
*
* VISTA3: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTÓN DE LA BARRA --RESUMEN DE COMPRAS-- ( $_GET['optioncomp == res_compras'] )
*  
*
* ************************************************* VISTA DEFAULT **************************************************++
*-------------------------------------------------------------------------------------------------------------------
*
*
* VISTA4: VISTA QUE MUESTRA LA TABLA CON TODAS LAS COMPRAS 
*
*
*/
// no direct access
defined('VALID_VAR') or die;

?>
<!-------------****************************** COMÚN ************************************--------------------->

 <p> Bienvenido usuario al m&oacute;dulo de Compras donde usted podr&aacute; crear los registros de todas sus Compras en el SSC y posteriormente visualizarlos. Por favor utilice el formulario para introducir datos. GRACIAS</p>
       
  <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES  Y REPORTES
   *************************************************************************************************************-->
         
    <div id="radiobar_cyg" class="buttons_bar_full">  
      
         <form>
	          
               <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE ACCIÓN
          *************************************************************************************************************-->  
			 			 
			 <?php   
                 if( $_SESSION['tipo_usuario'] == "a" )  {
	                // ESTE BOTON SÓLO PUEDE VERLO EL ADMINISTRADOR.
             ?>
                     
              <input type="radio" id="radio_cyg1" name="radio" <?php if (isset($_GET['optioncomp']) && $_GET['optioncomp'] == "nueva_compra" ) { echo "checked=\"checked\""; }  ?> /> <label for="radio_cyg1" title="Crear nueva compra de art&iacute;culos."> Nueva Compra </label>
		                                  
                   <!-- ******************************************************************************************************** 
                                                            BARRA DE BOTONES DE REPORTES 
                    *************************************************************************************************************-->
                     
          <span style="float:right; margin-right:4px;"> 
	          <input type="radio" id="radio_cyg2" name="radio" <?php if (isset($_GET['optioncomp']) && $_GET['optioncomp'] == "comp_x_proveedor" ) { echo "checked=\"checked\""; }  ?> />  <label for="radio_cyg2" title="Ver las compras realizadas a un proveedor."> Ver Compras por Proveedor </label>
		      <input type="radio" id="radio_cyg3" name="radio" <?php if (isset($_GET['optioncomp']) && $_GET['optioncomp'] == "res_compras" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_cyg3" title="Ver todas las compras realizadas en un rango espec&iacute;fico de fechas." > Resumen de Compras </label>
		     
          </span>  	       
          <span style="font-size:1.2em; float:right; margin:8px 15px 0 0;"> REPORTES  </span>  
        </form>
             
              <?php
				 }   // Fin del if( $_SESSION['tipo_usuario'] == "a" )  {
              ?>
    
    </div>  
       
     <!--************************************************  VISTA1 *************************************************+-->     

<?php
     if ( isset($_GET['optioncomp']) && $_GET['optioncomp'] == "nueva_compra" )    {
	    // Esto es cuando le doy al botón NUEVA COMPRA DE LA BARRA SUPERIOR.

      $numero_compra = numero_de_compra();   // Aquí recibo el número de compra para ponerlo en el text y en el hidden
	  $charge_articles = charges_articles(); // Aquí cargo todos los artículos para ponerlos en el select <select> del 2.   
      $moneda = charge_moneda();             // Carga la moneda de los INFORMES DE LA EMPRESA 
?>          
        <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                  
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Compras" href="javascript:void(0)" onclick="inicio_compras_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
       
        <!-- Botón de NUEVO ARTÍCULO -->
         <div class="cabecera_botton">
            <a class="new_article_from_compras" title="Crear Nuevo Art&iacute;culo en la Base de Datos desde el m&oacute;dulo de Compras"  href="index.php?mod=mod_add_article&articulo=new">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_new.png" class="img_botton">
              <br>
              Nuevo
            </a>
         </div>
             
       <!--***************************************************************************************************************
           ***************************************************************************************************************
                                           1. <div> FORMULARIO DE DATOS GENERALES DE LA COMPRA
           ***************************************************************************************************************
           ***************************************************************************************************************-->        
          
     <div class="include_form" id="nueva_compra_cyg">
                
         <form action="" method="post" name="form_nueva_compra" id="form_nueva_compra">
           <fieldset class="fieldset_form">   
            <legend>Formulario de Entrada de Datos de la Compra</legend>
            
            <!--  PRIMER <div> DE DATOS GENERALES DE LA COMPRA  -->
                       
            <div class="inline_line" style="min-width:710px; width:99%; border: 1px solid gray; border-radius:5px 5px; min-height:160px;  padding:0px 5px;margin-right:0px;" >
                           
              <span class="intro_modulos" style="float: left;"> 1. DATOS GENERALES </span>
              <!--  PRIMER contendor <div>  -->
              <div style="margin-top: 10px; position:absolute; top:20px; left: 0px; width:100%;">
                           
               <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px;"> Orden de Compra </td>
                  <td> <input class="text_form" type="text" name="num_compra" value="<?php echo $numero_compra; ?>" maxlength="20" style="width: 70px;" disabled="disabled" /> <input type="hidden" name="orden_compra" value="<?php echo $numero_compra; ?>" />  </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td> Fecha </td>  
                   <td> <input class="text_form" type="text" name="fecha_compra" value="" id="fecha_compra" maxlength="11" placeholder="Fecha" style="width: 70px;" /> </td>
                 </tr>
                 
                 <!-- FILA 3 -->
                 <tr>
                   <td> No. Factura </td>
                   <td> <input class="text_form" type="text" name="no_factura_compra" value="" maxlength="20" style="width: 120px;" placeholder="S/F" id="no_factura_compra"/> </td>
                 </tr>
                 
                 <!-- FILA 4 -->
                 <tr>
                   <td>&nbsp;  </td>
                   <td>&nbsp;  </td>
                 </tr>
               
               </table> 
                              
               <!--****************************************************************************************
                            <span> DE LOS CAMPOS PARA BUSCAR AL PROVEEDOR Y SU RESPECTIVO RUC 
                 ****************************************************************************************--> 
                 <span style="position:absolute; top: 45px; left: 355px;"> Proveedor </span>
                 
                <!-- <span style="position:absolute; top: 82px; left: 395px;"> RUC </span> -->
                              
               <!--****************************************************************************************
                             div DE LOS CAMPOS PARA BUSCAR AL PROVEEDOR Y SU RESPECTIVO RUC 
                 ****************************************************************************************--> 
             <div class="autocomplete_proveedor_ruc"> 
                 
                 <input class="text_form" type="text" id="proveedor_compra" name="proveedor_compra" value="" maxlength="100" style="width: 300px;" placeholder="Seleccione" /> 
                 
                 <input type="hidden" id="id_proveedor_compra" name="id_proveedor_compra" value="" />
                 
                <!-- <input class="text_form" type="text" id="ruc_proveedor_compra" name="ruc_proveedor_compra" value="" maxlength="100" style="width: 120px;"  placeholder="RUC" />  --> 
                                           
             </div> 
                
                  <!-- Esta variable es la que se manda con el nombre del PROVEEDOR -->
                <input type="hidden" name="proveedor_compra_hidden" value="" /> 
                               
             </div>  
                
            </div>  <!-- fin del div class="inline_line"   -->
                  
           <br style="line-height:170px;" />
                           
           <!--****************************************************************************************
                                       2. <div> INTERMEDIO DE AÑADIR DETALLE DE LA COMPRA 
               ****************************************************************************************-->
           <div id="anadir_detalle" class="compras_anadir" style="float:left;">
           
                <input type="button" id="button_show_detalle_compra" value="A&ntilde;adir Detalle de la Compra" onclick="return detalle_compra();"  />
                <img src="images/bullet_down.png" />
                <!--  <a title="A&ntilde;adir Detalle de la Compra" href="javascript:void(0)" onclick="detalle_compra();"> A&ntilde;adir Detalle de la Compra </a>  -->
           
           </div>
           
           <!----********* LOADING ********------->
           <div style="margin: 4px; width:17px; height:17px; float:right;">
               <div id="loader_gif" style="width:16px; height:16px; display:none;">
                    <img src="images/fieldset_ajax_loader.gif" />
               </div>
           </div>
                
          
      <!--**********************************************************************************************************
          **********************************************************************************************************
                                                     3. <div> DETALLE DE LA COMPRA
          **********************************************************************************************************
          **********************************************************************************************************-->
         
          <div id="detalle_compra" class="inline_line" style="min-width:710px; width:99%; border: 1px solid gray; border-radius:5px 5px; min-height:160px; display: none; padding:0px 5px;">
              
              <span class="intro_modulos" style="float: left;"> 2. DETALLE DE LA COMPRA </span>
              
              <span class="intro_modulos" style="float: right; margin-right:20px;"> VALOR TOTAL: <span id="total_compras_valor"> 0 </span> </span>
              
              <br style="line-height:20px;" />
                                    
               
               <!--  ZONA SUPERIOR DE LA DONDE VOY A PONER LOS DETALLES DE LAS COMPRAS -->
                 <div style="width:100%; min-width:895px; height:auto; float:left; border:1px solid gray; "> 
                     <div style="width:3%;" class="up_compras_table_sup"> <span style="font-weight:bold;"> # </span> </div>
                     <div style="width:34%;" class="up_compras_table_sup"> <span style="font-weight:bold;"> Descripci&oacute;n del art&iacute;culo </span> </div>
                     <div style="width:9%;" class="up_compras_table_sup">  <span style="font-weight:bold;"> C&oacute;digo </span></div>
                     <div style="width:13%;" class="up_compras_table_sup">  <span style="font-weight:bold;"> Unidad Medida  </span></div>
                     <div style="width:10%;" class="up_compras_table_sup">  <span style="font-weight:bold;"> Costo Unitario </span></div>
                     <div style="width:8%;" class="up_compras_table_sup">   <span style="font-weight:bold;"> Cantidad </span></div>
                     <div style="width:20%;" class="up_compras_table_sup">  <span style="font-weight:bold;"> Valor Total en <?php echo stripslashes($moneda['moneda_informes']);  ?>  </span> </div>
                 </div> 
                  
                <!--  ZONA DETALLES DE LAS COMPRAS PARA LA PRIMERA COMPRA --> 
                  <div id="comprasrow_1" style="width:100%; min-width:895px; float:left; padding:2px 0px; ">
         <!-- 01 --> <div style="width:3%;" class="up_compras_table"> 
                         <span style="float:left; margin:6px 0px 0px 8px;"> 1 </span> 
                     </div>
                      
         <!-- 02 --> <div style="width:34%;" class="up_compras_table"> 
                           <select name="descripcion_art_1" id="descripcion_art_1" class="select_compras_form" style="width:94%;" >
                                 <option value="" selected="selected"> Seleccione </option> 
                           <?php 
						   if ( isset($charge_articles) && $charge_articles != "null" )  {      
                               
							   for ( $i=0; $i < count($charge_articles); $i++ )
							   {
								    echo "<option class=\"".stripslashes($charge_articles[$i]['proveedor_art'])."\" style=\"display:none;\" value=\"".$charge_articles[$i]['id']."\">".stripslashes($charge_articles[$i]['referencia_art'])."</option>";
							   }   
						   
						   } 
						   ?>      
                               
                            </select> 
                     </div>  
         <!-- 03 --> <div style="width:9%;" class="up_compras_table">
                            
                            <input type="text" class="text_compras_form" style="width:80%;" maxlength="20" name="codigo_1" value=""   />
                     
                     </div>
         <!-- 04 --> <div style="width:13%; text-align:center; padding-top:6px; min-height:20px;" class="up_compras_table"> 
                            
                            <span id="unidad_medida_1"> unidad medida </span> 
                     
                     </div>
         
         <!-- 05 --> <div style="width:10%;" class="up_compras_table"> 
         
                            <input type="text" id="costo_1" class="text_compras_form" style="width:80%;" name="costo_1" value="0" /> 
                     
                     </div>
         <!-- 06 --> <div style="width:8%;" class="up_compras_table"> 
         
                            <input type="text" id="cantidad_1" class="text_compras_form" style="width:80%;" name="cantidad_1" value="0" onblur="show_valor_total_sumatoria_articulos()" /> 
                     
                     </div>
         
         <!-- 07 --> <div style="width:20%;" class="up_compras_table"> 
         
                            <input type="text" id="valor_total_1" class="text_compras_form" style="width:45%;" name="valor_total_1" value="0" /> 
                     
                     </div>
                 </div>

               <!--  ZONA DE AÑADIR LA SEGUNDA COMPRA --> 
                 <div id="compraslink_2" style="width:100%; min-width:859px; height:20px; float:left; padding:3px 0px 2px 4px;">
                     <a id="comprasshow_2" class="anadir_compra"> A&ntilde;adir </a>
                 </div>

              <br />
                         
        <?php 
        for ( $j=2; $j < 32; $j++ )
        { 
        ?>    
              <div id="comprascontainer_<?php echo $j; ?>" style="display:none; float:left; width:100%; min-width:895px;"> 
                 <div id="comprasrow_<?php echo $j; ?>" style="width:100%; min-width:895px; height:auto; float:left; padding:2px 0px;">
         <!-- 01 --> <div style="width:3%;" class="up_compras_table"> 
                         <span style="float:left; margin:6px 0px 0px 8px;"> <?php echo $j; ?> </span> 
                     </div>
                      
         <!-- 02 --> <div style="width:34%;" class="up_compras_table"> 
                           <select id="descripcion_art_<?php echo $j; ?>" name="descripcion_art_<?php echo $j; ?>" class="select_compras_form" style="width:94%;" >
                                 <option value="" selected="selected">Seleccione</option> 
                           <?php 
						   if ( isset($charge_articles) && $charge_articles != "null" )  {      
                               
							   for ( $h=0; $h < count($charge_articles); $h++ )
							   {
								    echo "<option class=\"".stripslashes($charge_articles[$h]['proveedor_art'])."\" style=\"display:none;\" value=\"".$charge_articles[$h]['id']."\">".stripslashes($charge_articles[$h]['referencia_art'])."</option>";
							   }   
						   
						   } 
						   ?>  
                            </select> 
                     </div>  
         <!-- 03 --> <div style="width:9%;" class="up_compras_table">
                            
                            <input type="text" class="text_compras_form" style="width:80%;" maxlength="20" name="codigo_<?php echo $j; ?>" value=""   />
                     
                     </div>
         <!-- 04 --> <div style="width:13%; text-align:center; padding-top:6px; min-height:20px;" class="up_compras_table"> 
                            
                            <span id="unidad_medida_<?php echo $j; ?>"> unidad medida </span> 
                     
                     </div>
         
         <!-- 05 --> <div style="width:10%;" class="up_compras_table"> 
         
                            <input type="text" id="costo_<?php echo $j; ?>" class="text_compras_form" style="width:80%;" name="costo_<?php echo $j; ?>" value="0" /> 
                     
                     </div>
         <!-- 06 --> <div style="width:8%;" class="up_compras_table"> 
         
                            <input type="text" id="cantidad_<?php echo $j; ?>" class="text_compras_form" style="width:80%;" name="cantidad_<?php echo $j; ?>" value="0" onblur="show_valor_total_sumatoria_articulos()" /> 
                     
                     </div>
         
         <!-- 07 --> <div style="width:20%;" class="up_compras_table"> 
         
                         <input type="text" id="valor_total_<?php echo $j; ?>" class="text_compras_form" style="width:45%;" name="valor_total_<?php echo $j; ?>" value="0" />                                       
                     </div>
                 
         <!-- 08 --> <a class="delete" id="delete_<?php echo $j; ?>" href=""><img src="images/delete.png" border=0 style="float:left; margin:6px 0px 0px 6px; height:20px;"/></a>        
                 </div>

               <!--  ZONA DE AÑADIR LA SEGUNDA COMPRA --> 
                 <div id="compraslink_<?php echo ($j+1); ?>" style="width:100%; min-width:859px; height:20px; float:left; padding:3px 0px 2px 4px;  ">
                     <a id="comprasshow_<?php echo ($j+1); ?>" class="anadir_compra"> A&ntilde;adir </a>
                 
                 </div>
    
     </div> 
         
	   <?php   
       }
       ?>   
               
  </div>  <!-- fin del div class="inline_line" id="detalle de compra"  -->
          <!-- FIN DEL SEGUNDO <div> DE DATALLE DE LA COMPRA   --> 
    
              
              <!--****************************************************************************************
                                       4. <div> INTERMEDIO DE AÑADIR DETALLE DE PAGO 
               ****************************************************************************************-->
           
           <div id="anadir_detalle_pago" class="compras_anadir" style="float:left; display:none; margin:10px 0px;">
           
                <input type="button" id="anadir_pago_button" value="A&ntilde;adir Detalle de Pago" />
                <img src="images/bullet_down.png" />
                <!--  <a title="A&ntilde;adir Detalle de la Compra" href="javascript:void(0)" onclick="detalle_compra();"> A&ntilde;adir Detalle de la Compra </a>  -->
           
           </div>
           
           <!--<br style="line-height:20px; float:left;" />-->
                        
           <!--********************************************************************************************************
               ********************************************************************************************************
                                                     5. <div> DETALLE DE PAGO
               ********************************************************************************************************
               ******************************************************************************************************-->
         
          <div id="detalle_pago" class="inline_line" style="min-width:710px; width:99%; border: 1px solid gray; border-radius:5px 5px; min-height:55px; height:auto; display:none; padding:0px 5px 10px 5px; margin-top:30px;">
              
              <span class="intro_modulos" style="float: left;"> 3. DETALLE DE PAGO </span>
              
              <span class="intro_modulos" style="float: right; margin-right:20px;"> VALOR TOTAL A PAGAR: <input type="text" id="monto_total_a_pagar" class="text_compras_form" style="width:80px;" name="monto_total" value="0" /> </span>
              
              <br style="line-height:50px;" />
              
              <span class="intro_modulos" style="float:right; margin-right:20px;"> DESCUENTO GENERAL: <input type="text" id="descuento_general" class="text_compras_form" style="width:80px;" name="descuento_general" value="0" /> </span>
              
              <!-- hidden que poner el valor real de la compra ( VALOR TOTAL - DESCUENTO )  -->
              <input type="hidden" id="valor_real_de_la_compra" name="valor_real_de_la_compra" value="" />
              
              <br style="line-height:20px;" />
                 
              <!-- TABLA 1: FORMA DE PAGO -->
              <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px;"> Forma de Pago </td>
                  <td style="width:80px;"> <input type="radio" id="forma_pago_contado" name="forma_pago" value="contado" /> Contado </td>
                  <td style="width:80px;"> <input type="radio" id="forma_pago_credito" name="forma_pago" value="credito" /> Cr&eacute;dito </td>
                  <td>&nbsp;  </td>
                </tr>
              </table> 
               
              <!-- TABLA 2.1: VALOR REAL DE LA COMPRA que es igual al valor del hidden de arriba id='valor_real_de_la_compra' -->
              <!-- MUESTRA EL VALOR REAL DE LA COMPRA PARA 'CRÉDITO' Y 'DÉBITO' desabilitado -->
              <div id="div_valor_real_de_la_compra" style="display: none; float:left; margin-top:20px; width:100%;">
              <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px;"> Valor Real del Pago ($) </td>
                  <td style="float:left;"> <input type="text" id="input_valor_real_del_pago" class="text_compras_form" style="width:80px;" name="input_valor_real_del_pago" value="" disabled="disabled" /> <?php echo stripslashes($moneda['moneda_informes']); ?> </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div>  
                            
              <!-- TABLA 2.2: ENTRADA ( SÓLO PARA CRÉDITOS ) -->
              <div id="div_entrada_origen_pago" style="display: none; float:left; margin-top:20px; width:100%;">
              <table id="tabla_origen_pago" class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px; color:green;"> Valor del Anticipo ($) </td>
                  <td style="float:left;"> <input type="text" id="input_entrada_forma_pago" class="text_compras_form" style="width:80px;" name="entrada_dinero" value="0" /> <?php echo stripslashes($moneda['moneda_informes']); ?> </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div>  
                        
              <!-- TABLA 3: ORIGEN DEL PAGO -->
              <div id="div_origen_pago" style="display:none; float:left; margin-top:20px; min-width:290px;">
              <table id="tabla_origen_pago" class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px;">&nbsp;  </td>
                  <td style="float:left;"> <input type="radio" id="forma_de_pago_banco" name="origen_pago" value="banco" /> Banco </td>
                  <td>&nbsp;  </td>
                </tr>
                
                <!-- FILA 2 -->
                 <tr>
                  <td> Origen del Pago </td>
                  <td style="float:left;"> <input type="radio" id="forma_de_pago_caja" name="origen_pago" value="caja_central" /> Caja Central </td>
                  <td>&nbsp;  </td>
                </tr>
                
                <!-- FILA 3 -->
                 <tr>
                  <td>&nbsp;  </td>
                  <td style="float:left;"> <input type="radio" id="forma_de_pago_banco_y_caja" name="origen_pago" value="caja_central_banco" /> Ambos </td>
                  <td>&nbsp;  </td>
                 </tr>
                           
              </table> 
              </div>
                    
              <!-- OBJETO 3.1: DESCRIPCIÓN DEL ORIGEN DEL PAGO 1-->
              <div id="div_detalle_origen_pago_1" style="display:none; float:left; margin-top:14px; min-width:320px; border: 1px solid gray; border-radius:5px 5px; min-height:55px; padding:5px;">
                  <!--DESCRIPCIÓN 1-->
                <table id="tabla_origen_pago" class="table_fieldset" style="float:left;">    
                  <!-- FILA 1 -->
                  <tr>
                    <td style="float:left; padding:3px;"> Descripci&oacute;n  </td>
                  </tr>
                  <tr> 
                    <td style="float:left;"> <input type="text" id="descripcion_origen_pago" maxlength="50" class="text_compras_form" style="width:310px;" name="descripcion_origen_pago" value="" /> </td>
                  </tr>

                </table> 
              </div>
                        
              <!-- OBJETO 3.2: DESCRIPCIÓN DEL ORIGEN DEL PAGO 2-->
              <div id="div_detalle_origen_pago_2" style="display:none; float:left; margin-top:7px; min-width:480px; border: 1px solid gray; border-radius:5px 5px; min-height:70px; padding:5px;">
                  <!--DESCRIPCIÓN 2-->
                <table id="tabla_origen_pago" class="table_fieldset" style="float:left;">    
                  <!-- FILA 1 -->
                  <tr>
                    <td style="float:left; padding:3px; width:80px; ">&nbsp;   </td>
                    <td style="float:left; width:80px; text-align:center;"> Monto  </td>
                    <td style="float:left; width:300px; text-align:center;"> Descripci&oacute;n  </td>
                  </tr>
                  
                  <!-- FILA 2 -->
                  <tr> 
                    <td style="float:left; padding:8px 3px 3px 3px;"> Caja Central </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_pago_caja" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_pago_caja" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago_caja" maxlength="50" class="text_compras_form" style="width:280px;" name="descripcion_pago_caja" value="" /> </td>
                  </tr>

                  <!-- FILA 3 -->
                  <tr> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:76px;"> Banco </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_pago_banco" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_pago_banco" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago_banco" maxlength="50" class="text_compras_form" style="width:280px;" name="descripcion_pago_banco" value="" /> </td>
                  
                  </tr>
              
                </table> 
              </div>
          
              <!-- TABLA 4: SALDO ( SÓLO PARA CRÉDITOS ) -->
              <div id="div_saldo_origen_pago" style="display:none; float:left; margin-top:10px; width:100%;">
              <table id="tabla_origen_pago" class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px; color:#D40000;"> Saldo del Cr&eacute;dito($) </td>
                  <td style="float:left;"> <input type="text" class="text_compras_form" id="saldo_dinero" style="width:80px;" name="saldo_dinero" value="0" /> <?php echo stripslashes($moneda['moneda_informes']); ?> </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div> 
          
              <!-- TABLA 5: CANTIDAD DE PAGOS ( SÓLO PARA CRÉDITOS ) -->
              <div id="div_cant_pagos_origen_pago" style="display:none; float:left; margin-top:10px; width:100%; padding-bottom:5px;">
              <table id="tabla_origen_pago" class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px;"> Cantidad de Pagos </td>
                  <td style="float:left;"> 
                    <select name="cantidad_de_pagos_credito" id="cantidad_de_pagos_credito" class="select_compras_form" style="width:90px;" >
                      <optgroup label="Seleccione la cantidad de pagos">   
                        <option value="0"> 0 </option>
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option> 
                        <option value="3"> 3 </option> 
                        <option value="4"> 4 </option> 
                        <option value="5"> 5 </option>
                        <option value="6"> 6 </option>
                        <option value="7"> 7 </option>
                        <option value="8"> 8 </option>
                        <option value="9"> 9 </option>
                        <option value="10"> 10 </option>   
                      </optgroup>
                    </select>
                  </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div> 
          
              <!-- TABLA 6: DESCRIPCIÓN DE LA CANTIDAD DE PAGOS -->
              <div id="div_descripcion_cantidad_pago" style="display:none; float:left; margin-top:2px; min-width:480px; border-radius:5px 5px; min-height:70px; padding:5px;">
                  <!--DESCRIPCIÓN 2-->
                <table id="tabla_origen_pago" class="table_fieldset" style="float:left;">    
                  <!-- FILA 1 -->
                  <tr>
                    <td style="float:left; padding:3px; width:150px; ">&nbsp;   </td>
                    <td style="float:left; width:80px; text-align:center;"> Monto  </td>
                    <td style="float:left; width:80px; text-align:center;"> Fecha  </td>
                    <td style="float:left; width:300px; text-align:center;"> Descripci&oacute;n  </td>
                  </tr>
                  
                  <!-- FILA 2 -->
                  <tr id="fila_pago1"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 1 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago1" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago1" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago1" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago1" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago1" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago1" value="" /> </td>
                  </tr>

                  <!-- FILA 3 -->
                  <tr id="fila_pago2"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 2 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago2" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago2" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago2" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago2" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago2" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago2" value="" /> </td>
                  </tr>  
                  
                    <!-- FILA 4 -->
                  <tr id="fila_pago3"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 3 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago3" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago3" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago3" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago3" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago3" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago3" value="" /> </td>
                  </tr>

                  <!-- FILA 5 -->
                  <tr id="fila_pago4"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 4 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago4" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago4" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago4" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago4" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago4" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago4" value="" /> </td>
                  </tr> 
                
                  <!-- FILA 6 -->
                  <tr id="fila_pago5"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 5 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago5" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago5" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago5" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago5" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago5" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago5" value="" /> </td>
                  </tr>
                           
                  <!-- FILA 7 -->
                  <tr id="fila_pago6"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 6 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago6" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago6" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago6" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago6" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago6" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago6" value="" /> </td>
                  </tr>
                  
                  <!-- FILA 8 -->
                  <tr id="fila_pago7"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 7 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago7" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago7" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago7" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago7" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago7" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago7" value="" /> </td>
                  </tr>
                  
                  <!-- FILA 9 -->
                  <tr id="fila_pago8"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 8 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago8" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago8" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago8" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago8" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago8" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago8" value="" /> </td>
                  </tr>
                  
                  <!-- FILA 10 -->
                  <tr id="fila_pago9"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 9 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago9" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago9" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago9" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago9" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago9" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago9" value="" /> </td>
                  </tr>
                  
                  <!-- FILA 11 -->
                  <tr id="fila_pago10"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 10 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago10" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago10" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago10" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago10" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago10" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago10" value="" /> </td>
                  </tr>
                        
                </table> 
              </div>
          
          </div>  <!-- Fin del <div id="detalle_pago" -->
                    
            <!--********************************************************************************************************
               ********************************************************************************************************
                                                     6. <div> BOTÓN GUARDAR
               ********************************************************************************************************
               ******************************************************************************************************-->
          <div id="guardar_nueva_compra" style="display:none; text-align:center; width:98%; height:50px; padding:10px; margin-top:20px; float:left;">
              <center> 
                <a id="log_in" class="normal_buttom" onclick="javascript: return send_new_compra();" style="cursor:pointer; float:none; margin:0px; "> Guardar Datos de la Compra </a>  
              </center>
          </div>  
             
           </fieldset>
         </form>   
     </div>   
         
      <!--************************************************  VISTA2 *************************************************+--> 
<?php

	} else if (isset($_GET['optioncomp']) && $_GET['optioncomp'] == "comp_x_proveedor" )  {  
      // Esto es cuando quiero ver las compras que he realizado a un proveedor.
  
      if ( isset($_POST['id_proveedor_compras_reporte']) )  {
		  
		  $charge_compras_x_proveedor = charge_compras($_POST['id_proveedor_compras_reporte']); 
		  
	  }
?>     
          
     <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
         ********************************************************************************************* -->
<?php                  
        if ( isset($_POST['id_proveedor_compras_reporte']) )  {
?>		  
		 <!-- Botón de IMPRIMIR -->  
         <div class="cabecera_botton">
            <a title="Imprimir reporte de Resumen de Compras por Proveedor." href="index.php?mod=mod_imprimir&cmp=2&id=<?php echo $_POST['id_proveedor_compras_reporte']; ?>&name=<?php echo $_POST['proveedor_compras_reporte'];  ?>" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div>   
<?php    	  
	  }
?>       
       <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Compras" href="javascript:void(0)" onclick="inicio_compras_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
     
     <!-- *******************************************************************************************
               1. FORMULARIO DE ENTRADA DE DATOS PARA VER LAS COMPRAS DEL PROVEEDOR SELECCIONADO
            *********************************************************************************************  --> 
       <div class="include_form" id="stock_art">
       
         <form action="" method="post" name="form_reporte_proveedor_compra">
           <fieldset class="fieldset_form">   
            <legend> Seleccione el Proveedor </legend>
            
            <!--  PRIMER <div> PARA LOS DATOS A INTRODUCIR  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; ver los registros de las compras realizadas a un Proveedor determinado. Por favor seleccione el Proveedor para ver los datos. GRACIAS. </span>
            <div class="inline_line" style="min-width:500px; margin-top:5px; margin-right:5px; min-height:100px;">
                             
               <table class="table_fieldset" style="width:560px; margin-top:5px;">    
                 <!-- FILA 1 -->
                 <tr>  
                   <td style="width:25%;"> Proveedor </td>
                   <td style="width:75%; height:40px;">   
                      <div class="autocomplete_proveedor_compras_reporte">  
                          <input class="text_form" type="text" name="proveedor_compras_reporte" value="" maxlength="100" style="width: 93%;" placeholder="Proveedor" id="proveedor" />
                          <!-- CAMPO HIDDEN CON EL id DEL PROVEEDOR QUE VOY A GUARDAR EN LA BASE DE DATOS --> 
                          <input type="hidden" name="id_proveedor_compras_reporte" value="" /> 
                      
                      </div>
                   </td>           
                 </tr>
               </table> 
                               
         <!--  <div> CON LOS BOTONES DE SUBMIT -->
         <div style="min-height:40px; float:left; min-width:365px;">
           <p>
             <input type="submit" value="Ver Compras" style="float:left; margin:15px 0px 5px 50px; padding:2px 4px;" onclick="return send_reporte_proveedor_compras();" />
                          
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
     
         <!-- *******************************************************************************************
                   2. SE SE LLEVO A CABO LA CONSULTA DE UN PROVEEDOR MUESTRO LA TABLA CON LOS DATOS
              *********************************************************************************************  --> 
<?php    
     if ( isset($_POST['id_proveedor_compras_reporte']) )  {
?>		  
              <!-- ************************************************************************************************
                                     TABLA QUE SE MUESTRA CON LOS DATOS DE LA CONSULTA
                   ************************************************************************************************ -->
        
              <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
                   
                <!-- FILA 1 -->
                <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Nombre del Proveedor </td>
                  <td style="width: 60%;"> <?php  echo $_POST['proveedor_compras_reporte']; ?>  </td>
               </tr>
              
             </table>        
		 
<?php		 
		 if ( $charge_compras_x_proveedor == "vacio" )  {
	        // Esto es cuando no existe ninguna compra registrada en las Bases de Datos del Proveedor Seleccionado.
?> 

     <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> En la Base de Datos no hay registrada ninguna Compra para el Proveedor Seleccionado. </div> 
  
<?php   
   } else {
       // Hay compras registradas en la BD.
?> 
     <!-- ******************************************************************************************************** 
                                    TABLA DE LISTADO DE COMPRAS DEL PROVEEDOR SELECCIONADO
   *************************************************************************************************************--> 
          
     <div style="margin-top: 20px; width:100%;"> <!-- div DE LA TABLA LISTADO DE COMPRAS  -->
       <table class="table_form" cellspacing="0" cellpadding="0">
         <tr >
            <th style="width:99.8%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE COMPRAS </th>
         </tr>
         <tr >
            
            <th title="N&uacute;mero de Compra" style="width: 4%; min-width:21px;"> # </th>
            <th style="width: 8%; min-width:50px;"> FECHA </th>
            <th style="width: 27%; min-width:110px;"> PROVEEDOR </th>
            <th style="width: 10%; min-width:80px;"> No. de FACTURA </th>
            <th style="width: 10%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
            <th style="width: 10%; min-width:80px;"> FORMA DE PAGO </th>
            <th style="width: 8%; min-width:80px;"> MONTO </th> 
            <th style="width: 8%; min-width:80px;"> DESCUENTO </th> 
            <th style="width: 8%; min-width:80px;"> PAGADO </th>  
            <th title="Ver Detalles de la Compra" style="width: 8%; min-width:80px;"> DETALLE </th> <!-- esto tiene que ver con la id de la compra -->
      
        </tr>
       </table> 
          
       <form name="detalle_compras" action="" method="post"  >
         <table class="table_form" id="table_pagination_compras" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($charge_compras_x_proveedor); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		   echo "<tr>";
			 echo "<td style=\"width: 4%; min-width:21px; \">".$charge_compras_x_proveedor[$i]['numero_compra']."</td>"; 
			 echo "<td style=\"width:8%; min-width:50px; font-size: 0.9em;\"> ".stripslashes($charge_compras_x_proveedor[$i]['fecha_compra'])."</td>"; 
			 		 
			 echo "<td style=\"width: 27%; min-width:110px; text-align: left; font-size: 0.9em;\" >".stripslashes($charge_compras_x_proveedor[$i]['nombre'])."</td>";
		     
			 echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \" >".stripslashes($charge_compras_x_proveedor[$i]['numero_factura'])."</td>";
			 echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($charge_compras_x_proveedor[$i]['cantidad_articulos'])."</td>";
		     		 
			 echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".$charge_compras_x_proveedor[$i]['forma_de_pago']."</td>";
			 echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($charge_compras_x_proveedor[$i]['monto_de_la_compra'])."</td>";
			 echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($charge_compras_x_proveedor[$i]['descuento'])."</td>";
			 echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($charge_compras_x_proveedor[$i]['valor_pagado_real'])."</td>";
			 
			 echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \"> <a href=\"index.php?mod=mod_compras_details&optionid=".$charge_compras_x_proveedor[$i]['id']."\" class=\"colorbox\" style=\"color: blue;\"> Ver </a> </td>";
		   echo "</tr>";
		 }
            
?>         

        </table>
       </form>    
           
     </div>  <!-- Fin del div de la tabla listado de compras para el proveedor seleccionado -->
          
<?php
     }  // Fin del if ( $charge_compras_x_proveedor == "vacio" )  {
 
  }  // Fin del if ( isset($_POST['id_proveedor_compras_reporte']) )  {
?>     

<!--************************************************  VISTA3 *************************************************+--> 
 
<?php

	} else if ( isset($_GET['optioncomp']) && $_GET['optioncomp'] == "res_compras" )  {  
      // Esto es cuando quiero ver las compras que se han realizado en un rango de fechas.
      
	  if ( isset($_GET['resc']) && $_GET['resc'] == "ver" )  {
		  if ( isset( $_POST['fecha_final'] ) && isset( $_POST['fecha_inicial'] ) )  {
		      // Busco las compras entre las 2 fechas seleccionadas.
			  $resumen_compras = charge_compras(-1);
	      }
	  }
?> 
    
	  <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
         ********************************************************************************************* -->
<?php      
      if ( isset( $_POST['fecha_final'] ) && isset( $_POST['fecha_inicial'] ) )  {
		      // Busco las compras entre las 2 fechas seleccionadas.  
?>        
        <!-- Botón de IMPRIMIR -->  
         <div class="cabecera_botton">
            <a title="Imprimir reporte de Resumen de Compras." href="index.php?mod=mod_imprimir&cmp=1&fi=<?php echo $_POST['fecha_inicial']; ?>&ff=<?php echo $_POST['fecha_final'];  ?>" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div>   

<?php
	  }
?>                
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Compras" href="javascript:void(0)" onclick="inicio_compras_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
	
         
          <!-- *******************************************************************************************
                   1. FORMULARIO DE ENTRADA DE DATOS PARA VER EL RESUMEN DE COMPRAS ENTRE DOS FECHAS   
               *********************************************************************************************  --> 
       <div class="include_form">
       
         <form action="" method="post" name="form_rescompras">
           <fieldset class="fieldset_form">   
            <legend> Ver Resumen de Compras </legend>
            
            <!--  PRIMER <div> PARA LOS DATOS A INTRODUCIR  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; ver el Resumen de Compras entre dos fechas seleccionadas. Por favor llene los campos del formulario para ver los datos. GRACIAS. </span>
            <div class="inline_line" style="min-width:500px; margin-top:5px; margin-right:5px; min-height:100px;">
                             
               <table class="table_fieldset" style="width:450px;">    
                 
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:40%;"> Fecha inicial </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_inicialrescompras" name="fecha_inicial" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td style="width:40%;"> Fecha final </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_finalrescompras" name="fecha_final" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                                                
            </table> 
                         
         <!--  <div> CON LOS BOTONES DE SUBMIT  -->
         <div style="min-height:40px; float:left; min-width:365px;">
           <p>
             <input type="submit" value="Ver Resumen" style="float:right; margin:15px 95px 5px 0; padding:3px 7px;" onclick="return send_rescompras();" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form"  -->
    

<?php
	      
	  if ( isset($_GET['resc']) && $_GET['resc'] == "ver" )  {
		  if ( isset( $_POST['fecha_final'] ) && isset( $_POST['fecha_inicial'] ) )  {

?>		     		  
            <!-- ************************************************************************************************
                                     TABLA QUE SE MUESTRA CON LOS DATOS DE LA CONSULTA
                   ************************************************************************************************ -->
        
              <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
                   
                <!-- FILA 1 -->
                <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Inicial </td>
                  <td style="width: 60%;"> <?php  echo $_POST['fecha_inicial']; ?>  </td>
                </tr>
           
                <!-- FILA 2 -->
                <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Final </td>
                  <td style="width: 60%;"> <?php  echo $_POST['fecha_final']; ?>  </td>
                </tr>
                  
             </table>   
                                
              <!-- ******************************************************************************************************** 
                                                 TABLA DE LISTADO DE COMPRAS E/ 2 FECHAS
                    *******************************************************************************************************--> 
<?php
              if ( $resumen_compras == "vacio" )  {
	              // Esto es cuando no existe ninguna compra registrada en las Bases de Datos.
?>	   
   
                  <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> En la Base de Datos no hay registrada ninguna Compra entre las dos fechas. </div> 
  
<?php   
             } else {
                  // Hay compras registradas en la BD.
?> 
     
     
                 <div style="margin-top: 20px; width:100%;"> <!-- div DE LA TABLA LISTADO DE COMPRAS  -->
                  <table class="table_form" cellspacing="0" cellpadding="0">
                    <tr >
                      <th style="width:99.8%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE COMPRAS </th>
                    </tr>
                    <tr >
                      <th title="N&uacute;mero de Compra"  style="width: 4%; min-width:21px;"> # </th>
                      <th style="width: 8%; min-width:50px;"> FECHA </th>
                      <th style="width: 27%; min-width:110px;"> PROVEEDOR </th>
                      <th style="width: 10%; min-width:80px;"> No. de FACTURA </th>
                      <th style="width: 10%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
                      <th style="width: 10%; min-width:80px;"> FORMA DE PAGO </th>
                      <th style="width: 8%; min-width:80px;"> MONTO </th> 
                      <th style="width: 8%; min-width:80px;"> DESCUENTO </th>
                      <th style="width: 8%; min-width:80px;"> PAGADO </th>   
                      <th title="Ver Detalles de la Compra" style="width: 7%; min-width:80px;"> DETALLE </th> <!-- esto tiene que ver con la id de la compra -->
                   </tr>
                 </table> 
            
                <form name="detalle_compras" action="" method="post"  >
                   <table class="table_form" id="table_pagination_compras" cellspacing="0" cellpadding="0"> 
<?php
                   for ( $i=0; $i < count($resumen_compras); $i++ )
		           {
			           //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		               echo "<tr>";
			             echo "<td style=\"width: 4%; min-width:21px; \">".$resumen_compras[$i]['numero_compra']."</td>"; 
			             echo "<td style=\"width:8%; min-width:50px; font-size: 0.9em;\"> ".stripslashes($resumen_compras[$i]['fecha_compra'])."</td>"; 
			 		 
			             echo "<td style=\"width: 27%; min-width:110px; text-align: left; font-size: 0.9em;\" >".stripslashes($resumen_compras[$i]['nombre'])."</td>";
		     
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \" >".stripslashes($resumen_compras[$i]['numero_factura'])."</td>";
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['cantidad_articulos'])."</td>";
		     		 
			             if ( $resumen_compras[$i]['forma_de_pago'] == "contado" )  {
				             $forma_pago = "Contado";
			             } else if ( $resumen_compras[$i]['forma_de_pago'] == "credito" )  {
			                 $forma_pago = "Cr&eacute;dito"; 
			             }
			 
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".$forma_pago."</td>";
			             echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['monto_de_la_compra'])."</td>";
			             echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['descuento'])."</td>";
			             echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['valor_pagado_real'])."</td>";
			             echo "<td style=\"width: 7%; min-width:80px; text-align: center; font-size: 0.9em; \"> <a href=\"index.php?mod=mod_compras_details&optionid=".$resumen_compras[$i]['id']."\" class=\"colorbox\" style=\"color: blue;\"> Ver </a> </td>";
		               echo "</tr>";
		            }
?>         
                    </table>
                  </form>    
    
               </div>  <!-- Fin del div de la tabla listado de compras -->
    
<?php
             }  // Fin del if ( $charge_compras == "vacio" )  {
	  
	      }  // Fin del  if ( isset( $_POST['fecha_final'] ) && isset( $_POST['fecha_inicial'] ) )  {
	  }  // Fin del if ( isset($_GET['resc']) && $_GET['resc'] == "ver" )  {
?> 



     <!--************************************************  VISTA4 *************************************************+--> 
 
<?php

	} else if ( empty($_GET['optioncomp']))  {  
      // Esto es cuando no existe la variable $_GET['optioncomp']  PANTALLA POR DEFECTO

      $charge_compras = charge_compras(0);

?>     
          
     <!-- ******************************************************************************************************** 
                                                 TABLA DE LISTADO DE COMPRAS
   *************************************************************************************************************--> 
         
<?php
   if ( $charge_compras == "vacio" )  {
	   // Esto es cuando no existe ninguna compra registrada en las Bases de Datos.
?>	   
   
       <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> En la Base de Datos no hay registrada ninguna Compra. </div> 
  
<?php   
   } else {
       // Hay compras registradas en la BD.
?> 
     
     
     <div style="margin-top: 20px; width:100%;"> <!-- div DE LA TABLA LISTADO DE COMPRAS  -->
       <table class="table_form" cellspacing="0" cellpadding="0">
         <tr >
            <th style="width:99.8%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE COMPRAS </th>
         </tr>
         <tr >
            
            <th title="N&uacute;mero de Compra"  style="width: 4%; min-width:21px;"> # </th>
            <th style="width: 8%; min-width:50px;"> FECHA </th>
            <th style="width: 27%; min-width:110px;"> PROVEEDOR </th>
            <th style="width: 10%; min-width:80px;"> No. de FACTURA </th>
            <th style="width: 10%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
            <th style="width: 10%; min-width:80px;"> FORMA DE PAGO </th>
            <th style="width: 8%; min-width:80px;"> MONTO </th> 
            <th style="width: 8%; min-width:80px;"> DESCUENTO </th>
            <th style="width: 8%; min-width:80px;"> PAGADO </th>   
            <th title="Ver Detalles de la Compra" style="width: 7%; min-width:80px;"> DETALLE </th> <!-- esto tiene que ver con la id de la compra -->
      
        </tr>
       </table> 
            
       <form name="detalle_compras" action="" method="post"  >
         <table class="table_form" id="table_pagination_compras" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($charge_compras); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		    echo "<tr>";
			 echo "<td style=\"width: 4%; min-width:21px; \">".$charge_compras[$i]['numero_compra']."</td>"; 
			 echo "<td style=\"width:8%; min-width:50px; font-size: 0.9em;\"> ".stripslashes($charge_compras[$i]['fecha_compra'])."</td>"; 
			 		 
			 echo "<td style=\"width: 27%; min-width:110px; text-align: left; font-size: 0.9em;\" >".stripslashes($charge_compras[$i]['nombre'])."</td>";
		     
			 echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \" >".stripslashes($charge_compras[$i]['numero_factura'])."</td>";
			 echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($charge_compras[$i]['cantidad_articulos'])."</td>";
		     		 
			 if ( $charge_compras[$i]['forma_de_pago'] == "contado" )  {
				 $forma_pago = "Contado";
			 } else if ( $charge_compras[$i]['forma_de_pago'] == "credito" )  {
			     $forma_pago = "Cr&eacute;dito"; 
			 }
			 
			 echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".$forma_pago."</td>";
			 echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($charge_compras[$i]['monto_de_la_compra'])."</td>";
			 echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($charge_compras[$i]['descuento'])."</td>";
			 echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($charge_compras[$i]['valor_pagado_real'])."</td>";
			 
			 echo "<td style=\"width: 7%; min-width:80px; text-align: center; font-size: 0.9em; \"> <a href=\"index.php?mod=mod_compras_details&optionid=".$charge_compras[$i]['id']."\" class=\"colorbox\" style=\"color: blue;\"> Ver </a> </td>";
		   echo "</tr>";
		 }
            
?>         
        </table>
       </form>    
    
     </div>  <!-- Fin del div de la tabla listado de compras -->
    
<?php
   }  // Fin del if ( $charge_compras == "vacio" )  {
?>     
    
<?php

	} // Fin del if $_GET['optioncomp'] PANTALLAS DE ESTE MÓDULO

?>     
          