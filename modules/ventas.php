<?php
/*
* Este es el módulo que muestra las VENTAS DEL NEGOCIO.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*
**************************** VISTAS DE SELECCIÓN DE LA BARRA SUPERIOR ( var $_GET['optionv']) ********************
*-------------------------------------------------------------------------------------------------------------------
*
* COMÚN: MUESTRA LO QUE ES COMÚN PARA TODAS LAS VISTAS.
*
*
* VISTA1: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --NUEVA VENTA--  ( $_GET['optionv == nueva_venta'] )  
*
*
*--------------------------------------------> REPORTES
* VISTA2: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --RESUMEN DE VENTAS--  ( $_GET['optionv == res_ventas'] )
*
*
* VISTA3: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --VER VENTAS POR CLIENTES--  ( $_GET['optionv == ventas_x_clientes'] )
*
* 
* ************************************************* VISTA DEFAULT **************************************************++
*-------------------------------------------------------------------------------------------------------------------
*
*
* VISTA4: VISTA QUE MUESTRA LA TABLA CON TODAS LAS VENTAS.
*
* 
*/
// no direct access
defined('VALID_VAR') or die;

$fecha = gmdate('Y-m-d', time() - 18000 );

?>
<!-------------****************************** COMÚN ************************************--------------------->

 <p> Bienvenido usuario al m&oacute;dulo de Ventas donde usted podr&aacute; crear los registros de todas sus ventas y posteriormente visualizarlos. Por favor utilice el formulario para introducir datos. GRACIAS</p>
         
  <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES  Y REPORTES
   *************************************************************************************************************-->
           
    <div id="radiobar_ventas" class="buttons_bar_full">  
      
         <form>
	          <input type="radio" id="radio_v1" name="radio" <?php if (isset($_GET['optionv']) && $_GET['optionv'] == "nueva_venta" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_v1" title="Crear una nueva Venta de art&iacute;culos."> Nueva Venta </label>
		      
      <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE REPORTES 
      *************************************************************************************************************-->
                     
          <span style="float:right; margin-right:4px;"> 
	          <input type="radio" id="radio_v2" name="radio" <?php if (isset($_GET['optionv']) && $_GET['optionv'] == "res_ventas" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_v2" title="Ver todas las ventas realizadas en un rango espec&iacute;fico de fechas." > Resumen de Ventas </label>
		      <input type="radio" id="radio_v3" name="radio" <?php if (isset($_GET['optionv']) && $_GET['optionv'] == "ventas_x_clientes" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_v3" title="Ver todas las ventas realizadas a un cliente."> Ver Ventas por Clientes </label>
		  </span>  	       
          <span style="font-size:1.2em; float:right; margin:8px 15px 0 0;"> REPORTES  </span>  
        </form>
             
    </div>  
     
          <!--************************************************  VISTA1 *************************************************+-->     

<?php
     if ( isset($_GET['optionv']) && $_GET['optionv'] == "nueva_venta" )    {
	    // Esto es cuando le doy al botón NUEVA COMPRA DE LA BARRA SUPERIOR.
        
		$almacenes = show_almacenes($_SESSION['tipo_usuario']);  // Aquí recibo los nombres de los almacenes que hay en la Base de Datos. 
        $moneda = charge_moneda();                               // Carga la moneda de los INFORMES DE LA EMPRESA. ( módulo COMPRAS ) 
        if ( $_SESSION['tipo_usuario'] == "v" )  {
		   // Si el usuario es VENDEDOR selecciono los artículos de acuerdo al id del almacén  	
		   // Aquí cargo todos los artículos DEL ALMACÉN SELECCIONADO PARA PONERLOS EN LOS <select>.
		   $charge_articles = charges_articles_for_sell($_SESSION['id_local']);     
		
		} else if ( $_SESSION['tipo_usuario'] == "a" )  {
		    // Si el usuario es ADMINISTRADOR selecciono los artículos de acuerdo al id del almacén cuando hago un change en el <select>  	
			if ( isset($_GET['localid']) )  {
			   // Aquí cargo todos los artículos DEL ALMACÉN SELECCIONADO PARA PONERLOS EN LOS <select>.	
		       $charge_articles = charges_articles_for_sell($_GET['localid']);    
			
			}			 
				
		}
?>          
        <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                  
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Ventas" href="javascript:void(0)" onclick="inicio_ventas_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
                
       <!--***************************************************************************************************************
           ***************************************************************************************************************
                               1. <div> FORMULARIO DE BÚSQUEDA DEL CLIENTE DE LA VENTA
           ***************************************************************************************************************
           ***************************************************************************************************************-->        
               
     <div class="include_form" id="nueva_venta">
                
         <form action="" method="post" name="form_nueva_venta" id="form_nueva_venta">
           <fieldset class="fieldset_form">   
            <legend> Formulario de Entrada de Datos de la Venta </legend>
            
            <!--  PRIMER <div> DE DATOS GENERALES Y BUSQUEDA DEL CLIENTE DE LA VENTA  -->
            <div class="inline_line" id="contenedor_datos_generales_ventas" style="min-width:700px; width:99%; min-height:215px; height:auto; border:1px solid gray; border-radius:5px 5px; padding:0px 5px;" >
              
              <span class="intro_modulos" style="float:left; display:block; width:90%;"> 1. DATOS GENERALES Y BUSQUEDA DEL CLIENTE </span>
              
               <!--  PRIMER contendor <div> PARA INDICAR EN CUÁL ALMACÉN ESTOY HACIENDO LA VENTA -->
              <div style="margin: 30px 0px 0px 10px;  position:absolute; top:15px; left: 5px; border:1px solid gray; min-height:35px; width:628px; border-radius:5px 5px; padding:2px 0px 0px 0px;">     
                <!-- CASO 1 usuario: ADMINISTRADOR --> 
<?php                
                if ( $_SESSION['tipo_usuario'] == "a" )  {   

?>	            
                    <span class="intro_modulos" style="float: left; margin-right:8px;"> Seleccione el almac&eacute;n para realizar la Venta </span>
                    <select name="select_local" class="text_form" id="select_local_para_venta" style="width: 43%; padding-right:2px; padding-left:2px;">                          <option value="seleccione"> Seleccione </option>    
                   <?php        
                       	   
					   if ( $almacenes != "null" )  {    
						  // Si $mov_locales == null significa que no se ha introducido ningún local tipo almacén.   
						  for ( $i=0; $i < count($almacenes); $i++ )
						  {
						       
							  if ( isset($_GET['localid']) )  {
								  // VERIFICO SI ESTÁ SELECCIONADO ALGUN ALMACÉN PARA HACER LA VENTA MEDIANTE $_GET['localid'].  
							      if ( $_GET['localid'] == $almacenes[$i]['id'] )  {
									  // ESTO SIGNIFICA QUE TENGO SELECCIONADO EL ALMACÉN ESTE.  
									  $selected = "selected=selected";   
								  } else {
									  // EN ESTE CASO NO ESTÁ SELECCIONADO EL ALMACÉN EN CUESTIÓN.
									  $selected = "";
								  }
							  
							  }
							  
							  echo "<option value=\"".$almacenes[$i]['id']."\" ".$selected."> Almac&eacute;n ".$almacenes[$i]['nombre_local']."</option>";	
						  }
					   }
				       
				   ?>        
                   </select>
               
<?php                
				} else if ( $_SESSION['tipo_usuario'] == "v" )  {
?>                
                <!-- CASO 2 usuario: VENDEDOR  -->

                    <span class="intro_modulos" style="float: left; margin-right:8px;"> Nueva Venta del almac&eacute;n <?php echo $almacenes[0]['nombre_local'] ; ?></span>

                    <input type="hidden" name="select_local" value="<?php echo $_SESSION['id_local']; ?>" />
            
<?php
				} // Fin del if ( $_SESSION['tipo_usuario'] == "a" )  {  
?>                
                
              </div>  <!-- Fin del  <!--  PRIMER contendor <div>  --> 
              
                   
              <!--  SEGUNDO CONTENEDOR contendor <div> PARA DATOS GENERALES Y DATOS DEL CLIENTE -->
              <div id="div_fecha_venta" style="margin:60px 0px 70px 0px; float:left; width:100%;">
               
               <table class="table_fieldset" style="float:left; width:240px;">    
                
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:80px;"> Fecha </td>  
                   <td> <input class="text_form" type="text" name="fecha_venta" value="" id="fecha_venta" maxlength="11" placeholder="Fecha" style="width: 70px;" /> </td>
                 </tr>
                        
               </table> 
                              
               <!--****************************************************************************************
                            <span> PARA LOS RADIOS DE SELECCIONAR AL CLIENTE
                 ****************************************************************************************--> 
                 <span id="span_select_cliente" style="position:absolute; top: 140px; left: 200px;"> Seleccionar Cliente </span>
                                  
               <!--********************************************************************************************************
                            <div> PARA LOS RADIOS DE SELECCIONAR LOS <div> DE SELECCIONAR AL CLIENTE O NUEVO CLIENTE
                 **********************************************************************************************************--> 
                 <div id="ventas_radio" style="position:absolute; top:100px; left: 330px;"> 
                 
                    <!-- 01 --> 
                    <input id="c1" type="radio" name="seleccionar_cliente_por" value="nombre" /> <label for="c1" title="B&uacute;squeda del Cliente por Nombre."> Por Nombre </label>
                    <br style="line-height:1.3em;" />
                    <!-- 02 --> 
                    <input id="c2" type="radio" name="seleccionar_cliente_por" value="num_cedula" /> <label for="c2" title="B&uacute;squeda del Cliente por N&uacute;mero de C&eacute;dula."> Por # de C&eacute;dula </label>
                    <br style="line-height:1.3em;" />
                    <!-- 03 --> 
                    <input id="c3" type="radio" name="seleccionar_cliente_por" value="ruc" /> <label for="c3" title="B&uacute;squeda del Cliente por RUC."> Por RUC </label>
                    <br style="line-height:1.3em;" />
                    <!-- 04 --> 
                    <input id="c4" type="radio" name="seleccionar_cliente_por" value="nuevo_cliente" /> <label for="c4" style="color: blue;" title="Crear Nuevo Cliente."> Nuevo Cliente </label>
                    <br style="line-height:1.3em;" />
                    <!-- 05 --> 
                    <input id="c5" type="radio" name="seleccionar_cliente_por" value="sin_determinar" /> <label for="c5" style="color: #D40000;" title="Cliente sin Detalle."> Sin Detalle </label>
                 
                 </div> <!-- Fin del  <div style="position:absolute; top: 30px; left: 300px;">   -->
                     
               <!--****************************************************************************************
                                   div DE LOS CAMPOS PARA BUSCAR AL CLIENTE DE ACUERDO A:
                                   1. Nombre.
                                   2. Número de Cédula.
                                   3. RUC.
                                   4. Nuevo Cliente.
                                   5. Sin Determinar.   
                   ****************************************************************************************--> 
              
              <!--****************************************************************************************
                                                         1. Nombre.
                  ****************************************************************************************--> 
                  
                  <div class="autocomplete_cliente_venta" id="cliente_x_nombre" style="display:none;"> 
                      <span> Introduzca el Nombre del Cliente. </span> 
                      <input class="text_form" type="text" id="search_cliente_ventas" name="cliente_venta" value="" maxlength="100" style="width: 300px;" placeholder="Seleccione" /> 
                      <input type="hidden" id="id_cliente_venta" name="id_cliente_venta" value="" />
                                               
                  </div> 
                  
                  <!-- <div> del botón para buscar al cliente por el Nombre -->
                  <div id="div_search_cliente_by_name" style="display:none; position:absolute; top:123px; left:810px; z-index:999;">
                       <input type="button" value="Buscar" id="search_cliente_by_name" style="padding:3px 7px;" />
                  </div>
                  
                  <!-- Esta variable es la que se manda con el nombre del CLIENTE -->
                  <input type="hidden" name="cliente_venta_hidden" value="" /> 
                                    
                <!--****************************************************************************************
                                                        2. Número de Cédula.
                  ****************************************************************************************--> 
                  
                  <div class="search_cliente_venta" id="cliente_x_num_cedula"> 
                  
                      <span style="display:block;"> Introduzca el N&uacute;mero de C&eacute;dula. </span> 
                      <input id="num_cedula_venta" class="text_form" type="text" style="width: 120px; float:left;" placeholder="# de C&eacute;dula" maxlength="20" value="" name="num_cedula_venta">
                  
                  </div>
                                       
                <!--****************************************************************************************
                                                        3. RUC.
                  ****************************************************************************************-->  
                 
                  <div class="search_cliente_venta" id="cliente_x_ruc"> 
                  
                      <span style="display:block;"> Introduzca el RUC. </span> 
                      <input id="ruc_venta" class="text_form" type="text" style="width: 120px; float:left;" placeholder="RUC" maxlength="20" value="" name="ruc_venta">
                  
                  </div>
                                    
               <!--****************************************************************************************
                                                        4. Nuevo Cliente.
                  ****************************************************************************************-->  
               
                   <div class="search_cliente_venta" id="cliente_x_nuevo" style="top:90px; float:left;"> 
                  
                      <span style="display:block;"> Introduzca el Nombre. </span>  
                      <input class="text_form" type="text" style="width: 200px; float:left;" placeholder="Nombre y Apellidos" maxlength="50" value="" name="nuevo_cliente_nombre_venta">
                      
                      <div style="width:70%; margin-top:5px; float:left;">
                        <div style="width:50%; float:left;">
                          <span style="display:block;"> # de C&eacute;dula. </span> 
                          <input class="text_form" type="text" style="width: 120px; float:left;" placeholder="# de C&eacute;dula" maxlength="12" value="" name="nuevo_cliente_num_cedula_venta">
                        </div>  
                        <div style="width:50%; float:left;"> 
                          <span style="display:block;"> RUC. </span>
                          <input class="text_form" type="text" style="width: 120px; float:left;" placeholder="RUC" maxlength="13" value="" name="nuevo_cliente_ruc_venta">
                        </div>
                      </div>
                  
                  </div>
                     
               <!--****************************************************************************************
                                                        5. Sin Determinar.   
                  ****************************************************************************************-->  
               
               <!-- NO MUESTRA NADA -->
                      
          </div>  <!-- Fin del <div> SEGUNDO CONTENEDOR -->     
               
               <!--*****************************************************************************************************
                          CONTENEDOR <div> DEL MENSAJE DE ERROR CUANDO NO SE ENCUENTRA EL USUARIO 
                  ****************************************************************************************************-->
            <div class="message_wrong" id="error_cliente_message" style="display:none; margin:20px 0px 10px 10px; width:65%;"> </div>     
                           
              <!--*****************************************************************************************************
                          CONTENEDOR <div> DEL MENSAJE CUANDO ES UN CLIENTE SIN DETERMINAR
                  ****************************************************************************************************-->
            <div class="message_ok" id="cliente_sin_determinar" style="display:none; margin:5px 0px 10px 10px; width:51%;"> Cliente sin Detalle </div>         
                <!--*****************************************************************************************************
                                           CONTENEDOR <div> DATOS DEL CLIENTE RECUPERADOS POR ajax
                  ****************************************************************************************************-->
         <div id="div_data_clientes" style="display:none; min-width:430px; min-height:80px; float:left; margin:0px 0px 10px 10px;">
              <fieldset class="fieldset_form" style="padding:6px 2px 8px 6px;">   
                <legend> Datos del Cliente </legend> 
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:35%; padding:4px;"> Nombre y Apellidos: </td>
                   <td style="width:65%; padding:4px; text-align:left;" id="push_cliente_full_name">      </td>
                 </tr> 
                 <!-- FILA 2 -->
                 <tr>
                  <td style="padding:4px;"> N&uacute;mero de C&eacute;dula: </td>
                  <td style="padding:4px; text-align:left;" id="push_cliente_num_ced">      </td>
                 </tr> 
                 <!-- FILA 3 -->
                 <tr>
                  <td style="padding:4px;"> RUC: </td>
                  <td style="padding:4px; text-align:left;" id="push_cliente_ruc">      </td>
                 </tr>
                 <!-- FILA 4 -->
                 <tr>
                  <td style="padding:4px;"> Tel&eacute;fono: </td>
                  <td style="padding:4px; text-align:left;" id="push_cliente_telef">      </td>
                 </tr> 
                                      
               </table> 
              
              <!-- AQUÍ PONGO EL NOMBRE DEL CLIENTE PARA PONERLO EN LA TABLA movalmacen_(idlocal) por ajax-->
              <input type="hidden" name="nombre_del_cliente_venta" value="" />
              
              <!-- AQUÍ PONGO EL id DEL CLIENTE PARA PONERLO EN LA TABLA ventasalmacen_(idlocal) por ajax-->
              <input type="hidden" name="id_del_cliente_venta" value="" />
              
              </fieldset>
         </div>    
            
             <!-- ********************************************************************************************
                                   DIV DEL CARGANDO QUE SE MUESTRA CUANDO VOY A BUSCAR ALGUN CLIENTE (ajax)
                     ******************************************************************************************* --> 
                         <div id="cargando_cliente" style="display:none; float:right; margin:10px 20px 10px 50px;">
                            <center>
                               <img src='images/ajax-loader.gif' border='0' />
                            </center>
                         </div> 
            
                    <!-- ********************************************************************************************
                                     DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
                         ******************************************************************************************* --> 
                         <div id="server_error_cliente" style="display:none; float:right; margin:10px 20px 10px 0;">
           
                             <img src='images/ajax-loader.gif' border='0' style="vertical-align: middle;;" /> 
                             <span class="ajax_error_box">Problema en el servidor. Intente m&aacute;s tarde. Gracias </span>
           
                         </div> 
             
            </div>  <!-- fin del div class="inline_line"   -->
               
           <!--****************************************************************************************
                                       2. <div> INTERMEDIO DE AÑADIR DETALLE DE LA COMPRA 
               ****************************************************************************************-->
           <div id="anadir_articulos" class="compras_anadir" style="display:none; float:left; margin-top:10px;">
           
                <input type="button" id="button_show_articulos_venta" value="A&ntilde;adir Art&iacute;culos a la Venta" onclick="return detalle_venta();"  />
                <img src="images/bullet_down.png" />
                          
           </div>       
 
           <!----********* LOADING ********------->
           <div style="margin: 4px; width:17px; height:17px; float:right;">
               <div id="ventas_loader_gif" style="width:16px; height:16px; display:none;">
                    <img src="images/fieldset_ajax_loader.gif" />
               </div>
           </div>
                     
          <!--**********************************************************************************************************
              **********************************************************************************************************
                                                     2. <div> DETALLE DE LA VENTA
              **********************************************************************************************************
              **********************************************************************************************************-->
      
      <div id="detalle_venta" class="inline_line" style="min-width:710px; width:99%; border: 1px solid gray; border-radius:5px 5px; min-height:160px; display: none; padding:0px 5px; float:left; margin-top:16px;">
              
         <span class="intro_modulos" style="float: left;"> 2. DETALLE DE LA VENTA </span>
              
         <span class="intro_modulos" style="float: right; margin-right:20px;"> VALOR TOTAL: <span id="total_ventas_valor"> 0 </span> </span>
              
         <br style="line-height:20px;" />
 
         <!--  ZONA SUPERIOR DE LA DONDE VOY A PONER LOS DETALLES DE LAS COMPRAS -->
         <div style="width:100%; min-width:895px; height:auto; float:left; border:1px solid gray; "> 
            <div style="width:3%;" class="up_compras_table_sup"> <span style="font-weight:bold;"> # </span> </div>
            <div style="width:34%;" class="up_compras_table_sup"> <span style="font-weight:bold;"> Descripci&oacute;n del art&iacute;culo </span> </div>
            <div style="width:9%;" class="up_compras_table_sup">  <span style="font-weight:bold;"> C&oacute;digo </span></div>
            <div style="width:13%;" class="up_compras_table_sup">  <span style="font-weight:bold;"> Unidad Medida  </span></div>
            <div style="width:10%;" class="up_compras_table_sup">  <span style="font-weight:bold;"> Precio Unitario </span></div>
            <div style="width:8%;" class="up_compras_table_sup">   <span style="font-weight:bold;"> Cantidad </span></div>
            <div style="width:20%;" class="up_compras_table_sup">  <span style="font-weight:bold;"> Valor Total en <?php echo stripslashes($moneda['moneda_informes']);  ?>  </span> </div>
         </div>  
               
         <!--  ZONA DETALLES DE LAS COMPRAS PARA LA PRIMERA COMPRA --> 
         <div id="ventasrow_1" style="width:100%; min-width:895px; float:left; padding:2px 0px; ">
         <!-- 01 --> <div style="width:3%;" class="up_compras_table"> 
                         <span style="float:left; margin:6px 0px 0px 8px;"> 1 </span> 
                     </div>
                      
         <!-- 02 --> <div style="width:34%;" class="up_compras_table"> 
                           <select name="descripcion_art_1" id="ventas_descripcion_art_1" class="select_compras_form" style="width:94%;" >
                                 <option value="" selected="selected"> Seleccione </option> 
                           <?php 
						   if ( isset($charge_articles) && $charge_articles != "null" )  {      
                               
							   for ( $i=0; $i < count($charge_articles); $i++ )
							   {
								    echo "<option value=\"".stripslashes($charge_articles[$i]['id_codigo_art'])."\">".stripslashes($charge_articles[$i]['referencia_art'])."</option>";
							   }   
						   
						   } 
						   ?>      
                               
                            </select> 
                     </div>  
                  
         <!-- 03 --> <div style="width:9%;" class="up_compras_table">
                            
                            <input type="text" class="text_compras_form" style="width:80%;" maxlength="20" name="codigo_1" value=""   />
                     
                     </div>
         <!-- 04 --> <div style="width:13%; text-align:center; padding-top:6px; min-height:20px;" class="up_compras_table"> 
                            
                            <span id="ventas_unidad_medida_1"> unidad medida </span> 
                     
                     </div>
         
         <!-- 05 --> <div style="width:10%;" class="up_compras_table"> 
         
                            <input type="text" id="ventas_precio_1" class="text_compras_form" style="width:80%;" name="precio_1" value="0" /> 
                     
                     </div>
         <!-- 06 --> <div style="width:8%;" class="up_compras_table"> 
         
                            <input type="text" id="ventas_cantidad_1" class="text_compras_form" style="width:80%;" name="cantidad_1" value="0" onblur="show_valor_total_sumatoria_articulos_de_la_venta();" /> 
                            
                            <!-- CAMPO hidden CON EL STOCK ACTUAL QUE HAY EN EL ALMACÉN PARA HACER LA COMPARACIÓN-->
                            <input type="hidden" name="stock_actual_almac_hidden_1" value=""  /> 
                     
                     </div>
         
         <!-- 07 --> <div style="width:20%;" class="up_compras_table"> 
         
                            <input type="text" id="ventas_valor_total_1" class="text_compras_form" style="width:45%;" name="valor_total_1" value="0" /> 
                     
                     </div>
                 </div>

               <!--  ZONA DE AÑADIR LA SEGUNDA COMPRA --> 
                 <div id="ventaslink_2" style="width:100%; min-width:859px; height:20px; float:left; padding:3px 0px 2px 4px;">
                     <a id="ventasshow_2" class="anadir_venta"> A&ntilde;adir </a>
                 </div>

              <br />
                         
        <?php 
        for ( $j=2; $j < 32; $j++ )
        { 
        ?>    
              <div id="ventascontainer_<?php echo $j; ?>" style="display:none; float:left; width:100%; min-width:895px;"> 
                 <div id="ventasrow_<?php echo $j; ?>" style="width:100%; min-width:895px; height:auto; float:left; padding:2px 0px;">
         <!-- 01 --> <div style="width:3%;" class="up_compras_table"> <!-- La clase es la misma del módulo compras -->
                         <span style="float:left; margin:6px 0px 0px 8px;"> <?php echo $j; ?> </span> 
                     </div>
                      
         <!-- 02 --> <div style="width:34%;" class="up_compras_table"> 
                           <select id="ventas_descripcion_art_<?php echo $j; ?>" name="descripcion_art_<?php echo $j; ?>" class="select_compras_form" style="width:94%;" >
                                 <option value="" selected="selected"> Seleccione </option> 
                           <?php 
						   if ( isset($charge_articles) && $charge_articles != "null" )  {      
                               
							   for ( $h=0; $h < count($charge_articles); $h++ )
							   {
								    echo "<option value=\"".$charge_articles[$h]['id_codigo_art']."\">".stripslashes($charge_articles[$h]['referencia_art'])."</option>";
							   }   
						   
						   } 
						   ?>  
                            </select> 
                     </div>  
         
         <!-- 03 --> <div style="width:9%;" class="up_compras_table">
                            
                            <input type="text" class="text_compras_form" style="width:80%;" maxlength="20" name="codigo_<?php echo $j; ?>" value=""   />
                     
                     </div>
         <!-- 04 --> <div style="width:13%; text-align:center; padding-top:6px; min-height:20px;" class="up_compras_table"> 
                            
                            <span id="ventas_unidad_medida_<?php echo $j; ?>"> unidad medida </span> 
                     
                     </div>
         
         <!-- 05 --> <div style="width:10%;" class="up_compras_table"> 
         
                            <input type="text" id="ventas_precio_<?php echo $j; ?>" class="text_compras_form" style="width:80%;" name="precio_<?php echo $j; ?>" value="0" /> 
                     
                     </div>
         <!-- 06 --> <div style="width:8%;" class="up_compras_table"> 
         
                            <input type="text" id="ventas_cantidad_<?php echo $j; ?>" class="text_compras_form" style="width:80%;" name="cantidad_<?php echo $j; ?>" value="0" onblur="show_valor_total_sumatoria_articulos_de_la_venta();" /> 
                     
                            <!-- CAMPO hidden CON EL STOCK ACTUAL QUE HAY EN EL ALMACÉN PARA HACER LA COMPARACIÓN-->
                            <input type="hidden" name="stock_actual_almac_hidden_<?php echo $j; ?>" value=""  />
                     
                     </div>
         
         <!-- 07 --> <div style="width:20%;" class="up_compras_table"> 
         
                         <input type="text" id="ventas_valor_total_<?php echo $j; ?>" class="text_compras_form" style="width:45%;" name="valor_total_<?php echo $j; ?>" value="0" />                                       
                     </div>
                 
         <!-- 08 --> <a class="delete" id="ventas_delete_<?php echo $j; ?>" href=""><img src="images/delete.png" border=0 style="float:left; margin:6px 0px 0px 6px; height:20px;"/></a>        
                 </div>

               <!--  ZONA DE AÑADIR LA SEGUNDA COMPRA --> 
                 <div id="ventaslink_<?php echo ($j+1); ?>" style="width:100%; min-width:859px; height:20px; float:left; padding:3px 0px 2px 4px;  ">
                     <a id="ventasshow_<?php echo ($j+1); ?>" class="anadir_venta"> A&ntilde;adir </a>
                 
                 </div>
    
     </div> 
         
	   <?php   
       }
       ?>   
   
      </div>  <!-- Fin del <div id="detalle_venta" class="inline_line".... -->
              <!-- FIN DEL SEGUNDO <div> DEL DETALLE DE LA VENTA -->   
       
           <!--****************************************************************************************
                                       4. <div> INTERMEDIO DE AÑADIR DETALLE DE PAGO 
               ****************************************************************************************-->
           
           <div id="anadir_detalle_pago_ventas" class="compras_anadir" style="float:left; display:none; margin:10px 0px;">
           
                <input type="button" id="anadir_pago_button_ventas" value="A&ntilde;adir Detalle de Pago" />
                <img src="images/bullet_down.png" />
                <!--  <a title="A&ntilde;adir Detalle de la Compra" href="javascript:void(0)" onclick="detalle_compra();"> A&ntilde;adir Detalle de la Compra </a>  -->
           
           </div>
 
           <!--********************************************************************************************************
               ********************************************************************************************************
                                                     5. <div> DETALLE DE PAGO DE LA VENTA
               ********************************************************************************************************
               ******************************************************************************************************-->
         
          <div id="detalle_pago_ventas" class="inline_line" style="min-width:710px; width:99%; border: 1px solid gray; border-radius:5px 5px; min-height:55px; height:auto; display:none; padding:0px 5px 10px 5px; margin-top:30px;">
              
              <span class="intro_modulos" style="float: left;"> 3. DETALLE DE PAGO </span>
              
              <span class="intro_modulos" style="float: right; margin-right:20px;"> VALOR TOTAL DE LA VENTA: <input type="text" id="monto_total_a_pagar_ventas" class="text_compras_form" style="width:80px;" name="monto_total" value="0" /> </span>
              
              <br style="line-height:50px;" />
              
              <span class="intro_modulos" style="float:right; margin-right:20px;"> DESCUENTO GENERAL DE LA VENTA: <input type="text" id="descuento_general_venta" class="text_compras_form" style="width:80px;" name="descuento_general_venta" value="0" /> </span>
              
              <!-- hidden que poner el valor real de la venta( VALOR TOTAL - DESCUENTO )  -->
              <input type="hidden" id="valor_real_de_la_venta" name="valor_real_de_la_venta" value="" />
                                         
              <br style="line-height:20px;" />
 
              <!-- TABLA 1: NO DE LA FACTURA DE LA VENTA Ó S/F -->
              <div id="div_no_factura_ventas" style="float:left; margin-top:20px; width:50%;">
              <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px;"> No. Factura </td>
                  <td style="float:left;"> <input type="text" id="input_no_factura_ventas" class="text_compras_form" style="width:80px;" name="input_no_factura_ventas" value="" placeholder="S/F" /> </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div>  
                           
              <!-- TABLA 2: FORMA DE PAGO -->
              <div id="div_forma_de_pago_ventas" style="float:left; margin-top:20px; width:100%;">
              <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px;"> Forma de Pago </td>
                  <td style="width:80px;"> <input type="radio" id="forma_pago_contado_ventas" name="forma_pago" value="contado" /> Contado </td>
                  <td style="width:80px;"> <input type="radio" id="forma_pago_credito_ventas" name="forma_pago" value="credito" /> Cr&eacute;dito </td>
                  <td>&nbsp;  </td>
                </tr>
              </table> 
              </div>
              
              <!-- TABLA 3: MONTO REAL A PAGAR ( CONTADO Y CRÉDITO ) -->
              <div id="div_monto_a_pagar_real_ventas" style="display: none; float:left; margin-top:20px; width:100%;">
              <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px; color:blue;"> Monto a Pagar ($) </td>
                  <td style="float:left;"> <input type="text" id="input_monto_a_pagar_ventas" class="text_compras_form" style="width:80px;" name="monto_a_pagar_ventas" value="0" disabled="disabled" /> <?php echo stripslashes($moneda['moneda_informes']);  ?> </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div>  
              
              <!-- TABLA 4: MONTO A PAGAR ( SÓLO PARA CONTADO ) -->
              <div id="div_pago_cliente_contado_ventas" style="display: none; float:left; margin-top:20px; width:100%;">
              <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px; color:green;"> Pago del Cliente ($) </td>
                  <td style="float:left;"> <input type="text" id="input_pago_cliente_contado" class="text_compras_form" style="width:80px;" name="pago_cliente_contado" value="0" /> <?php echo stripslashes($moneda['moneda_informes']);  ?> </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div>  
              
              <!-- TABLA 5: VUELTO ( SÓLO PARA CONTADO ) -->
              <div id="div_vuelto_contado_ventas" style="display: none; float:left; margin-top:20px; width:100%;">
              <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px; color:red;"> A devolver ($) </td>
                  <td style="float:left; color:red;"> <span id="push_vuelto_valor">   </span> <?php echo stripslashes($moneda['moneda_informes']);  ?></td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div>  
                           
              <!-- TABLA 6: ANTICIPO ( SÓLO PARA CRÉDITOS ) -->
              <div id="div_anticipo_origen_pago_ventas" style="display: none; float:left; margin-top:20px; width:100%;">
              <table id="tabla_origen_pago" class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px; color:green;"> Valor del Anticipo ($) </td>
                  <td style="float:left;"> <input type="text" id="input_anticipo_forma_pago" class="text_compras_form" style="width:80px;" name="entrada_dinero" value="0" /> <?php echo stripslashes($moneda['moneda_informes']); ?> </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div>  
              
              <!-- TABLA 7: SALDO DEL CRÉDITO ( SÓLO PARA CRÉDITOS ) -->
              <div id="div_saldo_credito_ventas" style="display:none; float:left; margin-top:10px; width:100%;">
              <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px; color:#D40000;"> Saldo del Cr&eacute;dito($) </td>
                  <td style="float:left;"> <input type="text" class="text_compras_form" id="saldo_dinero_ventas" style="width:80px;" name="saldo_dinero" value="0" /> <?php echo stripslashes($moneda['moneda_informes']); ?> </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div> 
                        
              <!-- TABLA 8: CANTIDAD DE PAGOS ( SÓLO PARA CRÉDITOS ) -->
              <div id="div_cant_pagos_origen_pago_ventas" style="display:none; float:left; margin-top:10px; width:100%; padding-bottom:5px;">
              <table class="table_fieldset" style="float:left;">    
                 <!-- FILA 1 -->
                 <tr>
                  <td style="width:150px;"> Cantidad de Pagos </td>
                  <td style="float:left;"> 
                    <select name="cantidad_de_pagos_credito" id="cantidad_de_pagos_credito_ventas" class="select_compras_form" style="width:90px;" >
                      <optgroup label="Seleccione la cantidad de pagos">   
                        <option value="0"> 0 </option>
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option> 
                        <option value="3"> 3 </option> 
                        <option value="4"> 4 </option> 
                        <option value="5"> 5 </option>   
                      </optgroup>
                    </select>
                  </td>
                  <td>&nbsp;  </td>
                </tr>
              </table>
              </div> 
                        
              <!-- TABLA 9: DESCRIPCIÓN DE LA CANTIDAD DE PAGOS ( CRÉDITO ) -->
              <div id="div_descripcion_cantidad_pago_ventas" style="display:none; float:left; margin-top:2px; min-width:480px; border-radius:5px 5px; min-height:70px; padding:5px;">
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
                  <tr id="fila_pago1_ventas"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 1 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago1_ventas" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago1" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago1_ventas" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago1" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago1_ventas" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago1" value="" /> </td>
                  </tr>

                  <!-- FILA 3 -->
                  <tr id="fila_pago2_ventas"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 2 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago2_ventas" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago2" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago2_ventas" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago2" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago2_ventas" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago2" value="" /> </td>
                  </tr>  
                  
                    <!-- FILA 4 -->
                  <tr id="fila_pago3_ventas"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 3 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago3_ventas" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago3" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago3_ventas" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago3" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago3_ventas" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago3" value="" /> </td>
                  </tr>

                  <!-- FILA 5 -->
                  <tr id="fila_pago4_ventas"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 4 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago4_ventas" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago4" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago4_ventas" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago4" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago4_ventas" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago4" value="" /> </td>
                  </tr> 
                
                  <!-- FILA 6 -->
                  <tr id="fila_pago5_ventas"> 
                    <td style="float:left; padding:8px 3px 3px 3px; width:150px;"> Pago 5 </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="monto_total_pago5_ventas" maxlength="10" class="text_compras_form" style="width:80px;" name="monto_total_pago5" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="fecha_pago5_ventas" maxlength="11" class="text_compras_form" style="width:70px;" name="fecha_pago5" value="" /> </td>
                    <td style="float:left; padding:3px;"> <input type="text" id="descripcion_pago5_ventas" maxlength="200" class="text_compras_form" style="width:280px;" name="descripcion_pago5" value="" /> </td>
                  </tr>
                           
                </table> 
              </div>
              
          </div>  <!-- Fin del  <div id="detalle_pago_ventas" class="inline_line"..... -->
  
           <!--********************************************************************************************************
               ********************************************************************************************************
                                                     6. <div> BOTÓN GUARDAR
               ********************************************************************************************************
               ******************************************************************************************************-->
          
          <div id="guardar_nueva_venta" style="display:none; text-align:center; width:98%; height:50px; padding:10px; margin-top:20px; float:left;">
              <center> 
                <a id="log_in" class="normal_buttom" onclick="javascript: return send_new_venta();" style="cursor:pointer; float:none; margin:0px; "> Guardar Datos de la Venta </a>  
              </center>
          </div>  
            
       </fieldset>    <!-- Fin del <fieldset class="fieldset_form">  -->
     </form>          <!-- Fin del <form action="" method="post" name="form_nueva_venta" id="form_nueva_venta"> -->
    </div>            <!-- Fin del  <div class="include_form" id="nueva_venta"> --> 
 
 
     <!--************************************************  VISTA2 *************************************************+-->     

<?php
	 } else if ( isset($_GET['optionv']) && $_GET['optionv'] == "res_ventas" )    {
	     // Esto es cuando le doy al botón RESUMEN DE VENTAS DE LA BARRA SUPERIOR.
                
        $mov_locales = show_locales();	         //01 carga en esta variable todos los locales de la BD.
	    
		if ( isset($_POST['nombre_local_resventas']) && $_POST['nombre_local_resventas'] != "" )  {
		  
		    $resumen_ventas = resumen_ventas(); 
		  
	    }
				
?>                
        <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
         ******************************************************************************************* -->
<?php                  
        if ( isset($_POST['nombre_local_resventas']) && $_POST['nombre_local_resventas'] != "" )  {
?>
            <!-- Botón de IMPRIMIR  -->
            <div class="cabecera_botton">
              <a title="Imprimir Resumen de Ventas." href="index.php?mod=mod_imprimir&vnt=1&id=<?php echo $_POST['local_resventas']; ?>&fi=<?php echo $_POST['fecha_inicial']; ?>&ff=<?php echo $_POST['fecha_final']; ?>&name=<?php echo $_POST['nombre_local_resventas']; ?>" target="_blank">
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
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Ventas" href="javascript:void(0)" onclick="inicio_ventas_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
               
            <!-- *******************************************************************************************
                   1. FORMULARIO DE ENTRADA DE DATOS PARA VER EL RESUMEN DE VENTAS DEL LOCAL SELECCIONADO
            *********************************************************************************************  --> 
       <div class="include_form">
       
         <form action="" method="post" name="form_resventas">
           <fieldset class="fieldset_form">   
            <legend> Ver Resumen de Ventas </legend>
            
            <!--  PRIMER <div> PARA LOS DATOS A INTRODUCIR  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; ver el Resumen de Ventas en cualquiera de sus almacenes. Por favor llene los campos del formulario para ver los datos. GRACIAS. </span>
            <div class="inline_line" style="min-width:500px; margin-top:5px; margin-right:5px; min-height:100px;">
                             
               <table class="table_fieldset" style="width:450px;">    
                 
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:40%;"> Fecha inicial </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_inicialresventas" name="fecha_inicial" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td style="width:40%;"> Fecha final </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_finalresventas" name="fecha_final" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 <!-- FILA 3 -->
                 <tr>  
                   <td> Seleccione Local </td>
                   <td> <select name="local_resventas" class="text_form" id="local_resventas" style="width: 70%; padding-right:2px; padding-left:2px;">                          <option value="seleccione"> Seleccione </option>    
                   
                   <!-- SI EL USUARIO ES VENDEDOR SOLO PUEDE VER SU LOCAL   -->    
					   
				   <?php        
                      if ( $_SESSION['tipo_usuario'] == "v" )  {
					      // USUARIO VENDEDOR
						  
						  for ( $i=0; $i < count($mov_locales); $i++ )
						  {
						       // Busco solamente el local del usuario VENDEDOR.
							   if ( $mov_locales[$i]['id'] == $_SESSION['id_local'] )  {
							       $id_local = $mov_locales[$i]['id'];                               // id del local en cuestión.
							       $nombre_local = stripslashes($mov_locales[$i]['nombre_local']);   // Nombre del local en cuestión.
								   $tipo_local = $mov_locales[$i]['tipo_local'];                     // Tipo de local en cuestión.
							   
							   } else { continue; }
						  }
						  
						  echo "<option value=\"".$id_local."\"> ".$nombre_local." &nbsp;(".$tipo_local.") </option>";
					  
					  } else {
					     // USUARIO ADMINISTRADOR.       
                       
					      if ( $mov_locales != "null" )  {    
						     // Si $mov_locales == null significa que no se ha introducido ningún local.  
						  
						     for ( $i=0; $i < count($mov_locales); $i++ )
						     {
						       
							   if ( $mov_locales[$i]['id'] == "1" )  {
							       // VERIFICO QUE NO SALGA LA BODEGA PARA VER EL RESUMEN DE VENTAS.
							       continue;
							   }
							   
							   echo "<option value=\"".$mov_locales[$i]['id']."\"> ".stripslashes($mov_locales[$i]['nombre_local'])." &nbsp;(".$mov_locales[$i]['tipo_local'].") </option>";	
						     }
					      }
                   				   
					  }
				   						   
				   ?>        
                        </select>
                   
                        <!-- ESTE ES EL NOMBRE DEL LOCAL QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="nombre_local_resventas" value=""  />
                   
                   </td>           
                </tr>   
                                
            </table> 
                         
         <!--  <div> CON LOS BOTONES DE SUBMIT  -->
         <div style="min-height:40px; float:left; min-width:365px;">
           <p>
             <input type="submit" value="Ver Resumen" style="float:right; margin:15px 0px 5px 0; padding:3px 7px;" onclick="return send_resventas();" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
  
     <!-- ************************************************************************************************************* 
                                    2. TABLA DEL RESUMEN DE VENTAS DEL ALMACÉN SELECCIONADO
          *************************************************************************************************************--> 
         
<?php
   if ( isset($_POST['nombre_local_resventas']) && $_POST['nombre_local_resventas'] != "" )  {
   
       if ( $resumen_ventas == "error" )  {
	      //a) No hay variables $_POST 
	   
	      // NO PASA NADA.
	 
       } else {
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
                
                <!-- FILA 3 -->
                <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local </td>
                  <td style="width: 60%;"> <?php  echo $_POST['nombre_local_resventas']; ?>  </td>
               </tr>
              
             </table> 	  
		  	  
<?php		  
		  //b) Hay variables $_POST  
          if ( $resumen_ventas == "vacio" )  {
	          // Esto es cuando no existe ninguna VENTA registrada en las Bases de Datos entre las fechas seleccionadas.
?>	                 
             <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> En la Base de Datos no hay registrada ninguna Venta entre las fechas Seleccionadas. </div> 
  
<?php   
          } else {
             // Hay ventas registradas en la BD.
?> 
           <div style="margin-top: 20px; width:100%;"> <!-- div DE LA TABLA LISTADO DE VENTAS  -->
             <table class="table_form" cellspacing="0" cellpadding="0">
               <tr >
                 <th style="width:99.8%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE VENTAS </th>
               </tr>
               <tr >
                 <th title="N&uacute;mero de Venta" style="width: 4%; min-width:21px;"> # </th>
                 <th style="width: 8%; min-width:50px;"> FECHA </th>
                 <th style="width: 26%; min-width:120px;"> CLIENTE </th>
                 <th style="width: 10%; min-width:80px;"> No. de FACTURA </th>
                 <th style="width: 10%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
                 <th style="width: 10%; min-width:80px;"> FORMA DE PAGO </th>
                 <th style="width: 8%; min-width:80px;"> MONTO </th> 
                 <th style="width: 8%; min-width:80px;"> DESCUENTO </th> 
                 <th style="width: 8%; min-width:80px;"> VALOR REAL </th>
                 <th title="Ver Detalles de la Venta" style="width: 8%; min-width:80px;"> DETALLE </th> <!-- esto tiene que ver con la id de la compra --> 
               </tr>
            </table> 
            
            <form name="detalle_ventas" action="" method="post"  >
              <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
              for ( $i=0; $i < count($resumen_ventas); $i++ )
		      {
			       //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		           echo "<tr>";
			         echo "<td style=\"width: 4%; min-width:21px; \">".$resumen_ventas[$i]['id_venta']."</td>"; 
			         echo "<td style=\"width:8%; min-width:50px; font-size: 0.9em;\"> ".stripslashes($resumen_ventas[$i]['fecha_venta'])."</td>"; 
			 		 echo "<td style=\"width:26%; min-width:120px; font-size: 0.9em; text-align: left;\"> ".stripslashes($resumen_ventas[$i]['nombre'])."</td>";  
			         
					 echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \" >".stripslashes($resumen_ventas[$i]['numero_factura'])."</td>";
			         echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_ventas[$i]['cantidad_articulos'])."</td>";
		     		 /*** if para vponer crédito y contado con tildes ***/ 
			         if ( $resumen_ventas[$i]['forma_de_pago'] == "credito" ) {
					      $forma_pago = "Cr&eacute;dito";	 
				     } else if ( $resumen_ventas[$i]['forma_de_pago'] == "contado" )  {
					      $forma_pago = "Contado";		 
				     }
					 
					 echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".$forma_pago."</td>";
			         echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_ventas[$i]['monto_de_la_venta'])."</td>";
			         echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_ventas[$i]['descuento'])."</td>";
			         echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_ventas[$i]['valor_de_la_venta_real'])."</td>";
			 
			         echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \"> <a href=\"index.php?mod=mod_ventas_details&optid=".$resumen_ventas[$i]['id_venta']."&localv=".$_POST['local_resventas']."\" class=\"colorbox_ventas\" style=\"color: blue;\"> Ver </a> </td>";
		           echo "</tr>";
		      }  // Fin del for
            
?>         
             </table>
           </form>    
           
     </div>  <!-- Fin del div de la tabla listado de ventas para el cliente seleccionado -->

<?php   
	      }  // Fin del if ( $$resumen_ventas == "vacio" )  {

       } // Fin del if ( $$resumen_ventas == "error" )  {
	   
  }  // Fin del if ( isset($_POST['nombre_local_resventas']) && $_POST['nombre_local_resventas'] != "" )  {
 
?> 
 
 
  
  <!--************************************************  VISTA3 *************************************************+-->     

<?php
	 } else if ( isset($_GET['optionv']) && $_GET['optionv'] == "ventas_x_clientes" )  {
	    // Esto es cuando le doy al botón VENTAS POR CLIENTES DE LA BARRA SUPERIOR.

        $mov_locales = show_locales();	      //01 carga en esta variable todos los locales de la BD.
        
		if ( isset($_POST['venta_cliente_local']) && $_POST['venta_cliente_local'] == "check" )  {
		  
		    $venta_cliente = venta_cliente(); 
		  
	    }
	     
?>              
        <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
        
<?php                  
        if ( isset($_POST['venta_cliente_local']) && $_POST['venta_cliente_local'] == "check" )  {
?>
            <!-- Botón de IMPRIMIR  -->
            <div class="cabecera_botton">
              <a title="Imprimir Ventas a un Cliente." href="index.php?mod=mod_imprimir&vnt=2&id=<?php echo $_POST['local_stock']; ?>&idc=<?php echo $_POST['id_cliente_ventas_reporte']; ?>&name=<?php echo $_POST['venta_cliente_local_nombre']; ?>&cliente=<?php  echo $_POST['cliente_ventas_reporte']; ?>" target="_blank">
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
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Ventas" href="javascript:void(0)" onclick="inicio_ventas_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
        
         <!-- *******************************************************************************************
               1. FORMULARIO DE ENTRADA DE DATOS PARA VER LAS VENTAS A UN CLIENTE EN UN LOCAL DETERMINADO
            *********************************************************************************************  --> 
       <div class="include_form">
       
         <form action="" method="post" name="form_reporte_venta_cliente">
           <fieldset class="fieldset_form">   
            <legend> Seleccione el Cliente </legend>
            
            <!--  PRIMER <div> PARA LOS DATOS A INTRODUCIR  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; ver los registros de las ventas realizadas a un Cliente Determinado en un almac&eacute;n. Por favor seleccione el nombre del Cliente y el almac&eacute;n para ver los datos. GRACIAS. </span>
            <div class="inline_line" style="min-width:500px; margin-top:5px; margin-right:5px; min-height:100px;">
                             
               <table class="table_fieldset" style="width:560px; margin-top:5px;">    
                 <!-- FILA 1 -->
                 <tr>  
                   <td>&nbsp;  </td>
                   <td>&nbsp;  </td>
                 </tr>  
                 
                 <!-- FILA 2 -->
                 <tr>  
                   <td> Almac&eacute;n </td>
                   <td>            
                      <div style="position: absolute; width:400px; top: 9px; left: 155px; z-index: 999; overflow:visible;"> 
                       <select name="local_stock" class="text_form" id="local_stock" style="width: 70%; padding-right:2px; padding-left:2px;">                          <option value="seleccione"> Seleccione </option>    
                    
                          <!-- SI EL USUARIO ES VENDEDOR SOLO PUEDE VER SU LOCAL   -->    
					   <?php        
                         if ( $_SESSION['tipo_usuario'] == "v" )  {
					        // USUARIO VENDEDOR
						    for ( $i=0; $i < count($mov_locales); $i++ )
						    {
						        // Busco solamente el local del usuario VENDEDOR.
							    if ( $mov_locales[$i]['id'] == $_SESSION['id_local'] )  {
							        $id_local = $mov_locales[$i]['id'];                               // id del local en cuestión.
							        $nombre_local = stripslashes($mov_locales[$i]['nombre_local']);   // Nombre del local en cuestión.
								    $tipo_local = $mov_locales[$i]['tipo_local'];                     // Tipo de local en cuestión.
							   
							    } else { continue; }
						    }
						  
						    echo "<option value=\"".$id_local."\"> ".$nombre_local." &nbsp;(".$tipo_local.") </option>";
					  
					     } else {
					        // USUARIO ADMINISTRADOR.
					        if ( $mov_locales != "null" )  {    
						       // Si $mov_locales == null significa que no se ha introducido ningún local.
						       for ( $i=0; $i < count($mov_locales); $i++ )
						       {
						           if ( $mov_locales[$i]['id'] == "1" )  {
									   // Esto es para cuando es una BODEGA ( no hay ventas )
									   continue;   
								   }
								   
								   echo "<option value=\"".$mov_locales[$i]['id']."\"> ".$mov_locales[$i]['nombre_local']." &nbsp;(".$mov_locales[$i]['tipo_local'].") </option>";	
						       } // Fin del for
                   
					        }
				   
					     }
				   			   
				   ?>        
                        </select>
                     </div>
                     
                     <!-- ESTA VARIABLE LA USO ARRIBA PARA RECONOCER SI SE ENVIARON LOS DATOS DE LA CONSULTA  -->
                     <input type="hidden" name="venta_cliente_local" value="check"  /> 
                     
                     <!-- ESTA VARIABLE ES IGUAL AL NOMBRE DEL LOCAL QUE VOY A HACER LA CONSULTA ( Por javascript )  -->
                     <input type="hidden" name="venta_cliente_local_nombre" value=""  />                 
                    
                   </td>
                 </tr>
                 
                 <!-- FILA 3 -->
                 <tr>  
                   <td>&nbsp;  </td>
                   <td>&nbsp;  </td>
                 </tr>  
                 
                 
                 <!-- FILA 4 -->
                 <tr>  
                   <td style="width:25%;"> Cliente </td>
                   <td style="width:75%; height:40px;">   
                      <div class="autocomplete_cliente_ventas_reporte">  
                          <input class="text_form" type="text" name="cliente_ventas_reporte" value="" maxlength="100" style="width: 93%;" placeholder="Nombre del Cliente" id="search_cliente_ventas" />
                          <!-- CAMPO HIDDEN CON EL id DEL CLIENTE QUE VOY A GUARDAR EN LA BASE DE DATOS --> 
                          <input type="hidden" name="id_cliente_ventas_reporte" value="" /> 
                      
                      </div>
                   </td>           
                 </tr>
                             
               </table> 
                                        
         <!--  <div> CON LOS BOTONES DE SUBMIT -->
         <div style="min-height:40px; float:left; min-width:365px;">
           <p>
             <input type="submit" value="Ver Ventas" style="float:left; margin:15px 0px 5px 50px; padding:2px 4px;" onclick="return send_reporte_cliente_ventas();" />
                          
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
                         
     <!-- ************************************************************************************************************* 
                                    2. TABLA DE LISTADO DE VENTAS DEL CLIENTE SELECCIONADO
          *************************************************************************************************************--> 
         
<?php
   if ( isset($_POST['venta_cliente_local']) && $_POST['venta_cliente_local'] == "check" )  {
   
       if ( $venta_cliente == "error" )  {
	      //a) No hay variables $_POST 
	   
	      // NO PASA NADA.
	 
       } else {
	      //b) Hay variables $_POST  
?>          
		  
	       <!-- ************************************************************************************************
                                     TABLA QUE SE MUESTRA CON LOS DATOS DE LA CONSULTA
                   ************************************************************************************************ -->
        
              <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
                   
                <!-- FILA 1 -->
                <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local </td>
                  <td style="width: 60%;"> <?php  echo $_POST['venta_cliente_local_nombre']; ?>  </td>
                </tr>
           
                <!-- FILA 2 -->
                <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Nombre del Cliente </td>
                  <td style="width: 60%;"> <?php  echo $_POST['cliente_ventas_reporte']; ?>  </td>
               </tr>
              
             </table> 	  
<?php		  
		  if ( $venta_cliente == "vacio" )  {
	          // Esto es cuando no existe ninguna VENTA registrada en las Bases de Datos del Cliente Seleccionado.
?>	         
             <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> En la Base de Datos no hay registrada ninguna Venta para el Cliente Seleccionado. </div> 
  
<?php   
          } else {
             // Hay ventas registradas en la BD.
?>  
             <div style="margin-top: 20px; width:100%;"> <!-- div DE LA TABLA LISTADO DE VENTAS  -->
             <table class="table_form" cellspacing="0" cellpadding="0">
               <tr >
                 <th style="width:99.8%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE VENTAS </th>
               </tr>
               <tr >
            
                 <th title="N&uacute;mero de Venta" style="width: 4%; min-width:21px;"> # </th>
                 <th style="width: 8%; min-width:50px;"> FECHA </th>
                 <th style="width: 20%; min-width:80px;"> No. de FACTURA </th>
                 <th style="width: 10%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
                 <th style="width: 18%; min-width:80px;"> FORMA DE PAGO </th>
                 <th style="width: 10%; min-width:80px;"> MONTO </th>
                 <th style="width: 10%; min-width:80px;"> DESCUENTO </th> 
                 <th style="width: 10%; min-width:80px;"> VALOR REAL </th>  
                 <th title="Ver Detalles de la Venta" style="width: 10%; min-width:80px;"> DETALLE </th> <!-- esto tiene que ver con la id de la compra --> 
               </tr>
            </table> 
            
            <form name="detalle_ventas" action="" method="post"  >
              <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
              for ( $i=0; $i < count($venta_cliente); $i++ )
		      {
			       //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		           echo "<tr>";
			         echo "<td style=\"width: 4%; min-width:21px; \">".$venta_cliente[$i]['id_venta']."</td>"; 
			         echo "<td style=\"width:8%; min-width:50px; font-size: 0.9em;\"> ".stripslashes($venta_cliente[$i]['fecha_venta'])."</td>"; 
			 		 
			         echo "<td style=\"width: 20%; min-width:80px; text-align: center; font-size: 0.9em; \" >".stripslashes($venta_cliente[$i]['numero_factura'])."</td>";
			         echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($venta_cliente[$i]['cantidad_articulos'])."</td>";
		     		 /*** if para vponer crédito y contado con tildes ***/ 
			         if ( $venta_cliente[$i]['forma_de_pago'] == "credito" ) {
					      $forma_pago = "Cr&eacute;dito";	 
				     } else if ( $venta_cliente[$i]['forma_de_pago'] == "contado" )  {
					      $forma_pago = "Contado";		 
				     }
					 
					 echo "<td style=\"width: 18%; min-width:80px; text-align: center; font-size: 0.9em; \">".$forma_pago."</td>";
			         echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($venta_cliente[$i]['monto_de_la_venta'])."</td>";
			         echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($venta_cliente[$i]['descuento'])."</td>";
					 echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($venta_cliente[$i]['valor_de_la_venta_real'])."</td>";
			         echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \"> <a href=\"index.php?mod=mod_ventas_details&optid=".$venta_cliente[$i]['id_venta']."&localv=".$_POST['local_stock']."\" class=\"colorbox_ventas\" style=\"color: blue;\"> Ver </a> </td>";
		           echo "</tr>";
		      }  // Fin del for
            
?>         
             </table>
           </form>    
           
     </div>  <!-- Fin del div de la tabla listado de ventas para el cliente seleccionado -->

<?php   
	   
	       }  // Fin del if ( $venta_cliente == "vacio" )  {

       } // Fin del if ( $venta_cliente == "error" )  {
	   
  }  // Fin del if ( isset($_POST['venta_cliente_local']) && $_POST['venta_cliente_local'] == "check" )  {

?> 
  
 <!--************************************************  VISTA4 *************************************************+--> 
 
<?php

	} else if ( empty($_GET['optionv']) )   {  
       // Esto es cuando no existe la variable $_GET['optionv']  PANTALLA POR DEFECTO

       //$show_pendientes = show_ingresos_de_caja_pendientes();  // Muestra las transacciones pendientes de entrada en la caja.
	   //$transacciones_caja = show_transacciones_caja();        // Muestra las transacciones que han habido en la caja el día de HOY.
	   if ( $_SESSION['tipo_usuario'] == "v" )  {
	       // CASO VENDEDOR.
	       $resumen_ventas_today = show_resumen_ventas_today();      // Muestra todos lo relacionado con los datos del RESUMEN DE VENTAS DEL DÍA.
       
	   } else if ( $_SESSION['tipo_usuario']  == "a" )  {
		   // CASO ADMINISTRADOR
		   $resumen_ventas_today_almacenes = show_resumen_ventas_today_almacenes();  // Cant. de ventas del día de todos los almacenes. 
	   }
?> 
      <!--***********************************************************************************************************************
                                            TABLA CON LOS DATOS GENERALES DE LAS VENTAS EN EL DÍA (ALMACÉN) 
                                            1. caso VENDEDOR.
                                            2. caso ADMINISTRADOR.
      *************************************************************************************************************************++ 
                                              1. caso VENDEDOR.
      *************************************************************************************************************************-->
<?php     
     if ( $_SESSION['tipo_usuario'] == "v" )  {            			     
?>      
         <table class="vista_caja" style="margin-bottom: 15px;" cellspacing="0" cellpadding="0">
           
           <tr >
             <th style="width:100%; color:gray; background-color:#F2F2F2; padding:5px 0px;" colspan="100"> RESUMEN VENTAS ALMAC&Eacute;N D&Iacute;A <?php echo $fecha; ?> </th>
           </tr>
            	  
           <tr>    
             <td style="width: 60%; color: white; background-color:#056AA8;"> TOTAL DE VENTAS  </td>
             <td style="width: 40%; border-right:1px solid #F7F7F7;"> <?php echo $resumen_ventas_today[0]['num_ventas']; ?> </td>
           </tr>
       
         </table>

                <!-- ******************************************************************************************************** 
                                                 TABLA DE LISTADO DE LAS VENTAS DEL DÍA DE HOY
                 *************************************************************************************************************--> 
         
<?php
            if ( $resumen_ventas_today[0]['num_ventas'] == "0" )  {
	           // Esto es cuando no existe ninguna VENTA registrada en las Bases de Datos EN EL DÍA DE HOY.
?>	   
   
               <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> En la Base de Datos no hay registrada ninguna Venta en el d&iacute;a de hoy. </div> 
  
<?php   
            } else {
               // Hay VENTAS registradas en la BD en el día de HOY.
?> 
     
               <div style="margin-top: 20px; width:100%;"> <!-- div DE LA TABLA LISTADO DE COMPRAS  -->
               <table class="table_form" cellspacing="0" cellpadding="0">
                 <tr >
                   <th style="width:99.8%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE VENTAS </th>
                  </tr>
                 
                 <tr >
                   <th title="N&uacute;mero de Venta" style="width: 4%; min-width:21px;"> # </th>
                   <th style="width: 8%; min-width:50px;"> FECHA </th>
                   <th style="width: 26%; min-width:110px;"> CLIENTE </th>
                   <th style="width: 10%; min-width:80px;"> No. de FACTURA </th>
                   <th style="width: 10%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
                   <th style="width: 10%; min-width:80px;"> FORMA DE PAGO </th>
                   <th style="width: 8%; min-width:80px;"> MONTO </th>
                   <th style="width: 8%; min-width:80px;"> DESCUENTO </th>
                   <th style="width: 8%; min-width:80px;"> VALOR REAL </th>  
                   <th title="Ver Detalles de la Venta" style="width: 8%; min-width:80px;"> DETALLE </th> <!-- esto tiene que ver con la id de la venta -->
                 </tr>
               </table> 
     
               <form name="detalle_venta" action="" method="post"  >
               <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
               for ( $i=1; $i < count($resumen_ventas_today); $i++ )
		       {
		  	        //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS VENTAS DE ESTE MES.
		            echo "<tr>";
			           echo "<td style=\"width: 4%; min-width:21px; \">".$resumen_ventas_today[$i]['id_venta']."</td>"; 
			           echo "<td style=\"width:8%; min-width:50px; font-size: 0.9em;\"> ".stripslashes($resumen_ventas_today[$i]['fecha_venta'])."</td>"; 
			 		   echo "<td style=\"width: 26%; min-width:110px; text-align: left; font-size: 0.9em;\" >".stripslashes($resumen_ventas_today[$i]['nombre'])."</td>";
		               echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \" >".stripslashes($resumen_ventas_today[$i]['numero_factura'])."</td>";
			           echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_ventas_today[$i]['cantidad_articulos'])."</td>";
		     		 
					   /*** if para vponer crédito y contado con tildes ***/ 
			           if ( $resumen_ventas_today[$i]['forma_de_pago'] == "credito" ) {
					       $forma_pago_r = "Cr&eacute;dito";	 
				       } else if ( $resumen_ventas_today[$i]['forma_de_pago'] == "contado" )  {
					       $forma_pago_r = "Contado";		 
				       }
					 
			           echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".$forma_pago_r."</td>";
			           echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_ventas_today[$i]['monto_de_la_venta'])."</td>";
			           echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_ventas_today[$i]['descuento'])."</td>";
			           echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_ventas_today[$i]['valor_de_la_venta_real'])."</td>";
			 
			           if ( $_SESSION['tipo_usuario'] == "v" )  {
						   // usuario vendedor.   
						   $id_local_stock = $_SESSION['id_local'];
					   }    
					   
					   echo "<td style=\"width: 8%; min-width:80px; text-align: center; font-size: 0.9em; \"> <a href=\"index.php?mod=mod_ventas_details&&optid=".$resumen_ventas_today[$i]['id_venta']."&localv=".$id_local_stock."\" class=\"colorbox_ventas\" style=\"color: blue;\"> Ver </a> </td>";
		            echo "</tr>";
		       }  // FIN DEL FOR
            
?>         
               </table>
               </form>    
               </div>  <!-- Fin del div de la tabla listado de las VENTAS en el día de HOY -->
         
<?php
   }  // Fin del if ( $charge_compras == "vacio" )  {
?>     

<?php 

	 } else if ( $_SESSION['tipo_usuario'] == "a" )  { 
 
?> 
                                   
      <!--*************************************************************************************************************************++ 
                                              2. caso ADMINISTRADOR.
      *************************************************************************************************************************-->
<?php
          if ( $resumen_ventas_today_almacenes == "null" )   { 
              // CASO 1. NO PASA NADA PUES NO HAY ALMACENES EN LA BD.
 
		  } else {
              // CASO 2. CASO EN QUE HAY ALMACENES EN LA BD.
              for ( $i=0; $i < count($resumen_ventas_today_almacenes); $i++ )
			  {
			       switch($resumen_ventas_today_almacenes[$i]['id'])
			       { 
                       case "1":  // CASO BODEGA. ( NO PASA NADA )
					   break;
					   default:   // CASO ALMACENES (  )
?>						
		               <table class="vista_caja" style="margin-bottom: 15px;" cellspacing="0" cellpadding="0">
           
                          <tr >
                             <th style="width:100%; color:gray; background-color:#F2F2F2; padding:5px 0px;" colspan="100"> RESUMEN VENTAS ALMAC&Eacute;N <?php echo $resumen_ventas_today_almacenes[$i]['nombre_local'];  ?> D&Iacute;A <?php echo $fecha; ?> </th>
                          </tr>
            	  
                          <tr>    
                             <td style="width: 60%; color: white; background-color:#056AA8;"> TOTAL DE VENTAS  </td>
                             <td style="width: 40%; border-right:1px solid #F7F7F7;"> <?php echo $resumen_ventas_today_almacenes[$i]['num_ventas']; ?>  </td>
                          </tr>
       
                       </table>			
	    				
                       <br style="line-height:140px;" /> 	
						
<?php						
						break; 
                   } // Fin del switch($resumen_ventas_today_almacenes[$i]['id'])
			  }  // Fin del for ( $i=0; $i < count($resumen_ventas_today_almacenes); $i++ )
		  }  // Fin del if ( $resumen_ventas_today_almacenes == "null" )   { 
	 }   // Fin del if ( $_SESSION['tipo_usuario'] == "v" )  { 
?> 
        
<?php

   }  //  Fin del if ( isset($_GET['optionv']) && $_GET['optionv'] == "nueva_venta" )    { FINAL

?>