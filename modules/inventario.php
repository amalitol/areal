<?php
/*
* Este es el módulo que muestra el inventario del negocio.
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
*/
/*
*
*COMÚN: MUESTRA LO QUE ES COMÚN PARA TODAS LAS VISTAS.
*
****************************** VISTAS DE ARTÍCULOS ( var $_GET['art'] )  *******************************************
--------------------------------------------------------------------------------------------------------------------
*VISTA1: VISTA QUE MUESTRA EL FORMULARIO CUANDO QUIERO INSERTAR UN NUEVO ARTÍCULO  ( $_GET['art'] == new )
*
*
*VISTA2: VISTA QUE MUESTRA EL FORMULARIO CUANDO QUIERO VER ALGUN CLIENTE  ( $_GET['art'] == detalle )
*
*
*VISTA3: VISTA QUE MUESTRA EL FORMULARIO CUANDO QUIERO EDITAR ALGUN CLIENTE  ( $_GET['art'] == editar )
*
*
**************************** VISTAS DE SELECCIÓN DE LA BARRA SUPERIOR ( var $_GET['optioninv']) ********************
*-------------------------------------------------------------------------------------------------------------------
*
*VISTA4: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --ADMINISTRAR--  ( $_GET['optioninv == administrar'] )  
*
*
*VISTA5: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --MOVIMIENTO--  ( $_GET['optioninv == mov'] )
*
*
* --------------------------------------------> REPORTES
*
*
*VISTA6: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTÓN DE LA BARRA --KARDEX--   ( $_GET['optioninv == kardex'] )
*
*
*VISTA7: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTÓN DE LA BARRA --STOCK--   ( $_GET['optioninv == stock'] )
*
*
*VISTA8: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTÓN DE LA BARRA --RESUMEN MOV. INVENTARIO--  ( $_GET['optioninv == mov_invres'] )
*
*
************************************************** VISTA DEFAULT **************************************************++
*-------------------------------------------------------------------------------------------------------------------
*
*VISTA9: VISTA QUE MUESTRA LA TABLA CON TODOS LOS ARTÍCULOS (default)
*
*
*/
// no direct access
defined('VALID_VAR') or die;
?>
<!-------------****************************** COMÚN ************************************--------------------->

 <p> Bienvenido usuario al m&oacute;dulo de INVENTARIOS donde usted podr&aacute; crear los art&iacute;culos de su inventario en el SSC y ver todos los datos de los mismos. Por favor utilice el formulario para introducir datos. GRACIAS</p>
           
  <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE ACCIÓN Y REPORTES
   *************************************************************************************************************-->
           
    <div id="radiobar_inv" class="buttons_bar_full">  
      
         <form>
	          
     <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE ACCIÓN
          *************************************************************************************************************-->  
					 
			 <?php   
                 if ( $_SESSION['tipo_usuario'] == "a" )  {
	                // ESTE BOTON SÓLO PUEDE VERLO EL ADMINISTRADOR.
             ?>
                     
              <input type="radio" id="radio_inv1" name="radio" <?php if (isset($_GET['optioninv']) && $_GET['optioninv'] == "administrar" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_inv1" title="Crear y Editar locales tipo BODEGA y ALMAC&Eacute;N."> Administrar </label>
		      
              <input type="radio" id="radio_inv2" name="radio" <?php if (isset($_GET['optioninv']) && $_GET['optioninv'] == "mov" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_inv2" title="Trasladar art&iacute;culos de inventario.">Movimientos</label>
		            
              <?php
				 }
              ?>
      <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE REPORTES 
      *************************************************************************************************************-->
                     
          <span style="float:right; margin-right:4px;"> 
	          <input type="radio" id="radio_inv3" name="radio" <?php if (isset($_GET['optioninv']) && $_GET['optioninv'] == "kardex" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_inv3" title="Ver Kardex del art&iacute;culo seleccionado en un rango espec&iacute;fico de fechas.">Kardex</label>
		      
             <?php   
                 if ( $_SESSION['tipo_usuario'] == "a" )  {
	                 // ESTE BOTON SÓLO PUEDE VERLO EL ADMINISTRADOR.
             ?>
                            
              <input type="radio" id="radio_inv4" name="radio" <?php if (isset($_GET['optioninv']) && $_GET['optioninv'] == "stock" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_inv4" title="Ver Stock de todos los art&iacute;culos en un Local seleccionado.">Stock</label>
		      
             <?php
				 }
              ?> 
              
              <input type="radio" id="radio_inv5" name="radio" <?php if (isset($_GET['optioninv']) && $_GET['optioninv'] == "mov_invres" ) { echo "checked=\"checked\""; }  ?>/><label for="radio_inv5" title="Ver resumen de mov. de inventarios de un Local en un rango espec&iacute;fico de fechas.">Resumen Mov. de Inventario </label>
          </span>  	       
          <span style="font-size:1.2em; float:right; margin:8px 15px 0 0;"> REPORTES  </span>  
        </form>
             
    </div>  
       
 <!---------------**********************************  VISTA1 **************************+*************---------------->
 
<?php
     if ( isset($_GET['art']) && $_GET['art'] == "new" )    {
	    // Esto es cuando le doy al botón NUEVO
?>                
      <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                  
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Inventario." href="javascript:void(0)" onclick="submitinv('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
         
            <!-- *******************************************************************************************
                        FORMULARIO de entrada de DATOS DE REGISTROS DE NUEVO ARTÍCULO
            *********************************************************************************************  --> 
            
      <div class="include_form" id="nuevo_articulo_inv">
                
         <form action="" method="post" name="form_nuevo_articulo" id="form_inventario">
           <fieldset class="fieldset_form">   
            <legend>Formulario de Entrada de Datos para el Nuevo Art&iacute;culo</legend>
            
            <!--  PRIMER <div> PARA LOS DATOS DE INVENTARIO  -->
                       
            <div class="inline_line" style="min-width:450px; min-height:320px;">
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                  <td> C&oacute;digo </td>
                  <td> <input class="text_form" id="codigo_articulo" type="text" name="codigo_art" value="" maxlength="20" style="width: 70px;" /> </td>
                  
                       <!-- <hidden> que me dice si el CÓDIGO está en la BD(1) o no(0) -> funciona con AJAX <- -->   
                       <input type="hidden" name="hidden_codigo_art" value="" />
                      
                  <td> Unidad de Medida </td>
                  <td> <input class="text_form" type="text" name="unidad_medida" value="" maxlength="20" style="width: 90px;" /> </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td> Referencia</td>  
                   <td colspan="3"> <input class="text_form" type="text" name="referencia_art" value="" maxlength="100" style="width: 93%;" /> </td>
                 </tr>
                   
                 <!-- FILA 3 -->
                 <tr>
                   <td> Detalles </td>  
                   <td colspan="3"> <input class="text_form" type="text" name="detalle_art" value="" maxlength="100" style="width: 93%;" /> </td>
                 </tr>
                 
                  <!-- FILA 4 -->
                 <tr>  
                   <td> Proveedor </td>
                   <td colspan="3" style="height:40px;">   
                      <div class="autocomplete_proveedor_articulo">  
                          <input class="text_form" type="text" name="proveedor_art" value="" maxlength="100" style="width: 93%;" placeholder="Proveedor" id="proveedor" />
                      
                          <!-- CAMPO HIDDEN CON EL id DEL PROVEEDOR QUE VOY A GUARDAR EN LA BASE DE DATOS --> 
                          <input type="hidden" name="id_proveedor_art" value="" /> 
                      
                      </div>
                   </td>           
                 
                 </tr>
                            
               </table> 
                                     
                <!-- CONTENEDOR <div> DE STOCK  -->
              <div style="margin-top: 10px; min-width:200px; border: 1px solid gray; border-radius:5px 5px; min-height:80px; float:left; padding:0px; position:absolute; left:0px; top: 150px;">
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                  <td> Stock Actual </td>
                  <td> <input class="text_form" type="text" name="stock_actual" value="" maxlength="20" style="width: 70px;" /> </td>
                 </tr> 
                  
                 <!-- FILA 2 --> 
                 <tr> 
                  <td> Stock M&iacute;nimo </td>
                  <td> <input class="text_form" type="text" name="stock_minimo" value="" maxlength="20" style="width: 70px;" /> </td>
                 </tr>
                        
               </table> 
             </div>    
                 
                 <!--  CONTENEDOR <div> DE COSTOS Y VENTAS  -->
              <div style="margin: 10px 0px 0px 6px; min-width:200px; border: 1px solid gray; border-radius:5px 5px; min-height:80px; float:left; padding:0px 2px 5px 2px; position:absolute; left:204px; top: 150px;">
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                  <td> Costo Unitario </td>
                  <td> <input class="text_form" type="text" name="precio_costo_art" value="" maxlength="20" style="width: 70px;" /> </td>
                 </tr> 
                  
                 <!-- FILA 2 --> 
                 <tr> 
                  <td> Precio de Venta 1</td>
                  <td> <input class="text_form" type="text" name="precio_venta1" value="" maxlength="20" style="width: 70px;" placeholder="Solo tela" /> </td>
                 </tr>
                        
                 <!-- FILA 3 --> 
                 <tr> 
                  <td> Precio de Venta 2</td>
                  <td> <input class="text_form" type="text" name="precio_venta2" value="" maxlength="20" style="width: 70px;" placeholder="P.T." /> </td>
                 </tr>
                       
                 <!-- FILA 4 --> 
                 <tr> 
                  <td> Precio de Venta 3</td>
                  <td> <input class="text_form" type="text" name="precio_venta3" value="" maxlength="20" style="width: 70px;" /> </td>
                 </tr>
                                 
               </table> 
             </div>         
                  
              <!--  <div> CON LOS BOTONES DE SUBMIT Y RESET  -->
         <div style="min-height:40px; float:left; position:absolute; top:250px; left:15px;">
           <p>
           <input type="submit" id="submit_new_art" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return send_articulo();" />
           <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                             
            </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
     </div>

     <!-- ****************************************** AJAX ***************************************************-->
                       <!-- 04 <div> que me dice si el CÓDIGO EXISTE O NO -> funciona con AJAX <- -->   
                       <div id="show_message_codigo_art" style="color:blue; position:absolute; top:266px; left:490px; min-height:20px;"> </div>
                                                    
                       <!-- ********************************************************************************************
                                 DIV DEL CARGANDO QUE SE MUESTRA CUANDO HAGO EL blur EN EL CÓDIGO DEL ARTÍCULO (ajax)
                        ******************************************************************************************* --> 
                        <div id="charging_aj" style="display: none; position:absolute; top:263px; left:700px;">
                          <center>
                               <img src='images/fieldset_ajax_loader.gif' border='0' />
                          </center>
                        </div> 
            
                      <!-- ********************************************************************************************
                                 DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
                           ******************************************************************************************* --> 
                        <div id="server_error_charging_aj" style="display:none; position:absolute; top:263px; left:500px; width:455px;">
           
                             <img src='images/fieldset_ajax_loader.gif' border='0' style="vertical-align: middle;;" /> 
                             <span class="ajax_error_box">Problema al comprobar el c&oacute;digo.Intente m&aacute;s tarde.Gracias </span>
           
                        </div> 
                      
               <!-- *************************************************************************************************************-->
                
               <!---------------**********************************  VISTA2 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['art']) && $_GET['art'] == "detalle" )    { 
          // Esto es cuando le doy al botón datalle en los artículos
          //01 Selecciono los datos del artículo que quiero VER de acuerdo a la variable $_GET['id']
          $detalle_articulo = detalle_articulo();                 // DEVUELVE LOS DATOS DEL ARTÍCULO SELECCIONADO DE LA TABLA .
          $stocks = stocks_articulo();   // DEVUELVE LOS STOCKS DEL ARTÍCULO SELECCIONADO EN CADA LOCAL.	     
?>  
      <!-- ********************************************************************************************
                               1. ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                           
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Inventario." href="javascript:void(0)" onclick="submitinv('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
        
        <!-- Botón de NUEVO  -->
         <div class="cabecera_botton">
            <a title="Crear Nuevo Art&iacute;culo en la Base de Datos."  href="javascript:void(0)" onclick="return submitinv('new');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_new.png" class="img_botton">
              <br>
              Nuevo
            </a>
         </div>
   
    <!-- ********************************************************************************************
                         2. AQUÍ MUESTRO LOS DETALLES DEL ARTÍCULO SELECCIONADO
          ******************************************************************************************* -->
 
    <div style="width:100%;">   
     <!-- TABLA CON LOS DATOS DE LOS DETALLES DEL ARTÍCULO SELECCIONADO -->
        
    <table class="table_detalle_articulo" cellspacing="0" cellpadding="0">
      <!-- FILA 0-->
      <tr>    
        <td colspan="2" style="width:100%; color:#2C73A5; background-color:#EEEEEE; text-align:right; min-width:120px; text-align:center; text-decoration: underline;">Datos del Art&iacute;culo</td>
      </tr>
      <!-- FILA 1 -->
      <tr>    
        <td style="width:30%; color:#2C73A5; background-color:#EEEEEE; text-align:right; min-width:120px;">C&oacute;digo</td>
        <td style="width:70%;"> <?php echo stripslashes($detalle_articulo['codigo_art']); ?> </td>
      </tr>
      <!-- FILA 2 -->
      <tr>    
        <td style="color:#2C73A5; background-color:#EEEEEE; text-align:right;">Unidad de Medida</td>
        <td> <?php echo stripslashes($detalle_articulo['unidad_medida']); ?></td>
      </tr>
      <!-- FILA 3 -->
      <tr>    
        <td style="color:#2C73A5; background-color:#EEEEEE; text-align:right;">Referencia</td>
        <td> <?php echo stripslashes($detalle_articulo['referencia_art']); ?></td>
      </tr>
      <!-- FILA 4 -->
      <tr>    
        <td style="color:#2C73A5; background-color:EEEEEE; text-align:right;">Detalle</td>
        <td> <?php echo stripslashes($detalle_articulo['detalle_art']); ?> </td>
      </tr>
      <!-- FILA 5 -->
      <tr>    
        <td style="color:#2C73A5; background-color:#EEEEEE; text-align:right;">Proveedor</td>
        <td> <?php echo stripslashes($detalle_articulo['nombre']); ?> </td>
      </tr>
      <!-- FILA 6 -->
      <tr>    
        <td style="color:#2C73A5; background-color:#EEEEEE; text-align:right;">Stock Actual</td>
        
<?php        
       // BUSCO EL STOCK GENERAL QUE EXITE EN EL NEGOCIO PARA PONERLO EN LA BD.
	   $stock_actual_general = 0;
	   for( $i=0; $i <  count($stocks); $i++ )
       { 
	       $suma = stripslashes($stocks[$i]['stock_actual']);
		   settype($suma, "float"); 
		      
		   $stock_actual_general = $stock_actual_general + $suma;
	   	   
	   }
?>                
        <td><?php echo $stock_actual_general; ?> </td>
      </tr>
      <!-- FILA 7-->
      <tr>    
        <td style="color:#2C73A5; background-color:#EEEEEE; text-align:right;">Stock M&iacute;nimo</td>
        <td><?php echo stripslashes($detalle_articulo['stock_minimo']); ?> </td>
      </tr>
      <!-- FILA 8-->
      <tr>    
        <td style="color:#2C73A5; background-color:#EEEEEE; text-align:right;">Precio de Costo</td>
        <td><?php echo stripslashes($detalle_articulo['precio_costo_art']); ?> </td>
      </tr>
      <!-- FILA 9-->
      <tr>    
        <td style="color:#2C73A5; background-color:#EEEEEE; text-align:right;">Precio de Venta 1</td>
        <td><?php echo stripslashes($detalle_articulo['precio_venta1']); ?> </td>
      </tr>
      <!-- FILA 10-->
      <tr>    
        <td style="color:#2C73A5; background-color:#EEEEEE; text-align:right;">Precio de Venta 2</td>
        <td><?php echo stripslashes($detalle_articulo['precio_venta2']); ?> </td>
      </tr>
      <!-- FILA 11-->
      <tr>    
        <td style="color:#2C73A5; background-color:#EEEEEE; text-align:right;">Precio de Venta 3</td>
        <td><?php echo stripslashes($detalle_articulo['precio_venta3']); ?> </td>
      </tr>
    </table>
          
      <div style="height:100%; float:left; width:350px;"  >
<?php
       for( $i=0; $i <  count($stocks); $i++ )
       {

             if ( $stocks[$i]['tipo_local'] == "bodega" )  {
			    // Chequeo si es una BODEGA o un ALMACÉN	 
			    $stocks[$i]['tipo_local'] = "BODEGA";
			 
			 } else if ( $stocks[$i]['tipo_local'] == "almacen" )  {
			   	$stocks[$i]['tipo_local'] = "ALMAC&Eacute;N";
			 
			 }

?>		 
             <div class="stock_actual_div"> 
                <p style="text-decoration: underline;"> <?php echo $stocks[$i]['tipo_local']." ".stripslashes($stocks[$i]['nombre_local']);   ?>  </p>
                <p style="text-indent:10px;"> Stock Actual: <span><?php echo stripslashes($stocks[$i]['stock_actual']);   ?> </span> </p> 
             </div>
<?php	   
	   }   // Fin del for( $i=0; $i <  count($stocks); $i++ )
?>              
      </div>  
          
     </div>   <!-- Fin del <div>  --> 
 
 <!---------------**********************************  VISTA3 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['art']) && $_GET['art'] == "editar" )   {
          // Esto es cuando le doy al botón EDITAR
     
	 //01 Selecciono los datos del artículo que quiero EDITAR de acuerdo a la variable $_GET['id']
      $ver_articulo = ver_articulo();                        // DEVUELVE LOS DATOS DEL ARTÍCULO.
      
?> 
     <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                          
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Inventario." href="javascript:void(0)" onclick="submitinv('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>

        <!-- Botón de NUEVO  -->
         <div class="cabecera_botton">
            <a title="Crear Nuevo Art&iacute;culo en la Base de Datos."  href="javascript:void(0)" onclick="return submitinv('new');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_new.png" class="img_botton">
              <br>
              Nuevo
            </a>
         </div>
         
     <!-- ********************************************************************************************
                     AQUÍ COMIENZA EL FORMULARIO CON LOS DATOS DEL ARTÍCULO A EDITAR 
          ******************************************************************************************* -->
    
     <div class="include_form" id="nuevo_articulo_inv">
                
         <form action="" method="post" name="form_nuevo_articulo" id="form_nueva_compra">
           <fieldset class="fieldset_form">   
            <legend> Editar del Art&iacute;culo </legend>
            
            <!--  PRIMER <div> PARA LOS DATOS DE INVENTARIO  -->
                      
            <div class="inline_line" style="min-width:450px;">
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                  <td> C&oacute;digo </td>
                  <td> <input class="text_form" id="codigo_articulo_edit" type="text" name="codigo_art" value="<?php echo stripslashes($ver_articulo['codigo_art']); ?>" maxlength="20" style="width: 70px;" /> </td>
                  
                       <!-- <hidden> para verificar que este es el código del artículo original -->   
                       <input type="hidden" id="comprobar_codigo_art" name="codigo_del articulo_verificar" value="<?php echo stripslashes($ver_articulo['codigo_art']); ?>" />
                       
                       <!-- <hidden> que me dice si el CÓDIGO está en la BD(1) o no(0) o es el original(2) -> funciona con AJAX <- -->   
                       <input type="hidden" name="hidden_codigo_art" value="" />
                                  
                  <td> Unidad de Medida </td>
                  <td> <input class="text_form" type="text" name="unidad_medida" value="<?php echo stripslashes($ver_articulo['unidad_medida']); ?>" maxlength="20" style="width: 90px;" /> </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td> Referencia</td>  
                   <td colspan="3"> <input class="text_form" type="text" name="referencia_art" value="<?php echo stripslashes($ver_articulo['referencia_art']); ?>" maxlength="100" style="width: 93%;" /> </td>
                 </tr>
                   
                 <!-- FILA 3 -->
                 <tr>
                   <td> Detalles </td>  
                   <td colspan="3"> <input class="text_form" type="text" name="detalle_art" value="<?php echo stripslashes($ver_articulo['detalle_art']); ?>" maxlength="100" style="width: 93%;" /> </td>
                 </tr>
                 
                  <!-- FILA 4 -->
                 <tr>  
                   <td> Proveedor </td>
                   <td colspan="3"> <input class="text_form" type="text" name="proveedor_art" value="<?php echo stripslashes($ver_articulo['nombre']); ?>" maxlength="100" style="width: 93%;" placeholder="Proveedor" disabled="disabled" /> </td>           
                 
                 </tr>
                            
               </table> 
                                 
                <!-- CONTENEDOR <div> DE STOCK  -->
              <div style="margin-top: 10px; min-width:200px; border: 1px solid gray; border-radius:5px 5px; min-height:40px; float:left; padding:0px;">
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 
                 <tr>
                  <td> Stock Actual </td>
                  <td> <input class="text_form" type="text" name="stock_actual" value="" maxlength="20" style="width: 70px;" disabled="disabled" /> </td>
                 </tr> -->
                  
                 <!-- FILA 2 --> 
                 <tr> 
                  <td> Stock M&iacute;nimo </td>
                  <td> <input class="text_form" type="text" name="stock_minimo" value="<?php echo stripslashes($ver_articulo['stock_minimo']); ?>" maxlength="20" style="width: 70px;" /> </td>
                 </tr>
                        
               </table> 
             </div>    
                 
                 <!--  CONTENEDOR <div> DE COSTOS Y VENTAS  -->
              <div style="margin: 10px 0px 0px 6px; min-width:200px; border: 1px solid gray; border-radius:5px 5px; min-height:80px; float:left; padding:0px 2px 5px 2px;">
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                  <td> Costo Unitario </td>
                  <td> <input class="text_form" type="text" name="precio_costo_art" value="<?php echo stripslashes($ver_articulo['precio_costo_art']); ?>" maxlength="20" style="width: 70px;" /> </td>
                 </tr> 
                  
                 <!-- FILA 2 --> 
                 <tr> 
                  <td> Precio de Venta 1</td>
                  <td> <input class="text_form" type="text" name="precio_venta1" value="<?php echo stripslashes($ver_articulo['precio_venta1']); ?>" maxlength="20" style="width: 70px;" placeholder="Solo tela" /> </td>
                 </tr>
                        
                 <!-- FILA 3 --> 
                 <tr> 
                  <td> Precio de Venta 2</td>
                  <td> <input class="text_form" type="text" name="precio_venta2" value="<?php echo stripslashes($ver_articulo['precio_venta2']); ?>" maxlength="20" style="width: 70px;" placeholder="P.T." /> </td>
                 </tr>
                       
                 <!-- FILA 4 --> 
                 <tr> 
                  <td> Precio de Venta 3</td>
                  <td> <input class="text_form" type="text" name="precio_venta3" value="<?php echo stripslashes($ver_articulo['precio_venta3']); ?>" maxlength="20" style="width: 70px;" /> </td>
                 </tr>
                                 
               </table> 
             </div>         
                  
              <!--  <div> CON LOS BOTONES DE SUBMIT Y RESET  -->
         <div style="min-height:40px; float:left; position:absolute; top:245px; left:15px;">
           <p>
           <input type="hidden" name="id_articulo" value="<?php echo $_GET['id']; ?>" />
           
           <input type="submit" id="submit_edit_art" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return edit_articulo();" />
           <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                         
            </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
     </div>

         <!-- ****************************************** AJAX ***************************************************-->
         <!-- 04 <div> que me dice si el CÓDIGO EXISTE O NO -> funciona con AJAX <- -->   
         <div id="show_message_codigo_art_edit" style="color:blue; position:absolute; top:264px; left:500px; min-height:20px;"> </div>
                                                    
         <!-- ********************************************************************************************
                   DIV DEL CARGANDO QUE SE MUESTRA CUANDO HAGO EL blur EN EL CÓDIGO DEL ARTÍCULO (ajax)
         ******************************************************************************************* --> 
         <div id="charging_aj_edit" style="display: none; position:absolute; top:263px; left:700px;">
            <center>
                <img src='images/fieldset_ajax_loader.gif' border='0' />
            </center>
         </div> 
           
         <!-- ********************************************************************************************
                          DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
         ******************************************************************************************* --> 
         <div id="server_error_charging_aj_edit" style="display:none; position:absolute; top:263px; left:500px; width:455px;">
           
               <img src='images/fieldset_ajax_loader.gif' border='0' style="vertical-align: middle;;" /> 
               <span class="ajax_error_box">Problema al comprobar el c&oacute;digo.Intente m&aacute;s tarde.Gracias </span>
           
         </div> 
                      
         <!-- *************************************************************************************************************-->
            
    <!---------------**********************************  VISTA4 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['optioninv']) && $_GET['optioninv'] == "administrar" )    {
	    // Esto es cuando le doy al botón ADMINISTAR DE LA BARRA SUPERIOR

     $num_locales = show_locales();	               //01 carga en esta variable todos los locales de la BD.
	 $show_bodega_or_not = show_bodega_or_not();   //02 carga en esta variable si se puede o no poner o no el valor de la BODEGA en el <select>  
                                                   // DEVUELVE 'true' or 'false'.
?>  
         <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
 
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Inventario." href="javascript:void(0)" onclick="submitinv('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
     
     <!-- *******************************************************************************************
                                        MENSAJES DE INSERCIÓN/ERRROR DE LOCALES 
            *********************************************************************************************  -->       
<?php 
         if ( isset($_GET['etype']))  {
		 
		     if ( $_GET['etype'] == "error_bodega_ok" )   {
			 //CASO 1. Esto significa que ya existe una bodega en la BD        
?>        
                 <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Disculpe usuario pero en la Base de Datos s&oacute;lo puede haber una BODEGA. Por favor inserte el local tipo ALMAC&Eacute;N. GRACIAS </div> 

<?php
		     } else if ( $_GET['etype'] == "true_new_almacen" )  {
             // CASO 2. Esto significa que se insertó correctamente el almacén en la BD
?>     
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> ALMAC&Eacute;N insertado correctamente en la Base de Datos. GRACIAS </div> 
 
<?php
		     } else if ( $_GET['etype'] == "error_bodega_no" )  {
             // CASO 3. Esto significa que se insertó correctamente el almacén en la BD
?>     
                 <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Estimado Usuario, primero debe crear una BODEGA. GRACIAS </div><?php
		     } else if ( $_GET['etype'] == "true_new_bodega" )  {
             // CASO 4. Esto significa que se insertó correctamente la bodega en la BD
?>     
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> BODEGA insertada correctamente en la Base de Datos. GRACIAS </div>
<?php
		     } else if ( $_GET['etype'] == "success" )  {
             // CASO 5. Esto significa que se UPDATE correctamente el local en la BD
?>     
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> EDICI&Oacute;N CORRECTA </div>
<?php
		     }   // Fin del if ( $_GET['etype'] ==  .... )
		 }  // Fin del if ( isset($_GET['etype']))
?>          
     
     <!-- *******************************************************************************************
                                       1. FORMULARIO DE ENTRADA/EDICIÓN DE DATOS
            *********************************************************************************************  --> 
       <div class="include_form" id="administrar_inv">
       
         <form action="" method="post" name="form_nuevo_local" id="form_nuevo_local">
           <fieldset class="fieldset_form">   
            <legend>Administrar Locales</legend>
            
            <!--  PRIMER <div> PARA LOS DATOS DE INVENTARIO  -->
            
           <span"> &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; introducir todos los locales de su negocio con el objetivo de definir los inventarios y los movimientos en cada unos de ellos. Es importante que primero cree un local tipo <b>BODEGA</b> para poder centralizar todas sus entradas al inventario por compras a proveedores. GRACIAS</span>
            <div class="inline_line" style="min-width:450px; margin-top:10px;">
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                  <td> Nombre del Local </td>
                  <td> <input class="text_form" type="text" name="nombre_local" value="" maxlength="100" style="width: 93%;" placeholder="Nombre" /> </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td> Direcci&oacute;n del Local</td>  
                   <td> <input class="text_form" type="text" name="direccion_local" value="" maxlength="100" style="width: 93%;" placeholder="Direcci&oacute;n" /> </td>
                 </tr>
                   
                 <!-- FILA 3 -->
                 <tr>
                   <td> Tel&eacute;fono del Local </td>  
                   <td> <input class="text_form" type="text" name="telefono_local" value="" maxlength="100" style="width: 93%;" placeholder="Tel&eacute;fono" /> </td>
                 </tr>
                 
                  <!-- FILA 4 -->
                 <tr>  
                   <td> Tipo de Local </td>
                   <td> <select name="tipo_local" class="text_form" style="width: 98.2%; padding-right:2px; padding-left:2px;">                           <?php if ( $show_bodega_or_not == "false" )  {  
							     // Esto significa que NO hay ninguna bodega en la BD ?>
                            <optgroup label="seleccione">
                              <option value="bodega"> Bodega </option>
                              <option value="almacen"> Almac&eacute;n </option>   
                            </optgroup>  
							<?php } else if ( $show_bodega_or_not == "true" )  {  
							      // Esto significa que EXISTE ninguna bodega en la BD ?>
                              <option value="almacen" id="tipo_local_to_edit_almacen"> Almac&eacute;n </option>  
                              <option value="bodega" id="tipo_local_to_edit_bodega" style="display:none;"> Bodega </option>
							<?php } ?>
                        </select>
                   </td>           
                  </tr>
                            
               </table> 
                                 
                <!-- CONTENEDOR <div> DATOS DEL RESPONSABLE  -->
              <div style="margin-top: 10px; min-width:440px; min-height:80px; float:left; padding:0px;">
              <fieldset class="fieldset_form">   
                <legend> Datos del Responsable </legend> 
                             
               <table class="table_fieldset">    
                 <!-- FILA 1 -->
                 <tr>
                  <td> Nombre del Responsable </td>
                  <td> <input class="text_form" type="text" name="nombre_responsable" value="" maxlength="100" style="width: 93%;" placeholder="Nombre" /> </td>
                 </tr> 
                  
                 <!-- FILA 2 --> 
                 <tr> 
                  <td> Tel&eacute;fono </td>
                  <td> <input class="text_form" type="text" name="telefono_responsable" value="" maxlength="100" style="width:93%;" placeholder="Tel&eacute;fono" /> </td>
                 </tr>
                        
                 <!-- FILA 3 -->
                 <tr>
                  <td> Celular </td>
                  <td> <input class="text_form" type="text" name="cell_responsable" value="" maxlength="100" style="width: 93%;" placeholder="Celular" /> </td>
                 </tr> 
                  
                 <!-- FILA 4 --> 
                 <tr> 
                  <td> Email </td>
                  <td> <input class="text_form" type="text" name="email_responsable" value="" maxlength="100" style="width:93%;" placeholder="email" /> </td>
                 </tr>
                      
               </table> 
              </fieldset>
             </div>    
                
         <br style="line-height:100px;"/>         
              
              <!--  <div> CON LOS BOTONES DE SUBMIT Y RESET  -->
         <div style="min-height:40px; float:left; min-width:440px;">
           <p>
           <input type="hidden" name="id_local" value="nuevo" /> <!-- Esto me dá el id del local cuando lo voy a editar, sino 'nuevo'   -->
           
           <input type="submit" value="Guardar" style="float:right; margin:15px 0px 5px 0; padding:3px 7px;" onclick="return send_local();" />
           <input type="button" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" onclick="inicio_form_nuevo_local();" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
       
   <!-- ********************************************************************************************
                 DIV DEL CARGANDO QUE SE MUESTRA CUANDO VOY A EDITAR ALGUN LOCAL (ajax)
       ******************************************************************************************* --> 
       <div id="cargando_local" style="display:none; float:right; margin:10px 20px 10px 0;">
           <center>
               <img src='images/ajax-loader.gif' border='0' />
           </center>
       </div> 
           
      <!-- ********************************************************************************************
                 DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
       ******************************************************************************************* --> 
       <div id="server_error_local" style="display:none; float:right; margin:10px 20px 10px 0;">
           
               <img src='images/ajax-loader.gif' border='0' style="vertical-align: middle;;" /> 
               <span class="ajax_error_box">Problema en el servidor. Intente m&aacute;s tarde. Gracias </span>
           
       </div> 
<?php       
   
   if (  $num_locales == "null" ) {
	   //1 Si el valor de la variable es false es porque no hay ningún local creado
   
       // NO PASA NADA
   
   }  else  {
       //2 muestro la tabla con los datos 
?>       
    <!-- ********************************************************************************************
          TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS LOCALES" 
          ******************************************************************************************* -->
       
         <!-- TABLA CON LOS REGISTROS DE LOS LOCALES  -->
        <div style="width:100%; margin-top:15px;" id="show_locales">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="8"> TABLA DE LOCALES DE INVENTARIO </th>
           </tr>
           <tr >
              <th style="width: 3%; min-width: 24px;"> # </th>
              <th style="width: 5%; font-size: 0.8em; min-width:35px;"> EDITAR /VER</th>
              <th style="width: 20%; font-size: 0.9em; min-width:75px;"> NOMBRE </th>
              <th style="width: 25%; font-size: 0.9em; min-width:75px;"> DIRECCI&Oacute;N </th>
              <th style="width: 7%; font-size: 0.9em; min-width:40px;"> TEL&Eacute;FONO </th>
              <th style="width: 5%; font-size: 0.9em; min-width:30px;"> TIPO </th>
              <th style="width: 16%; font-size: 0.9em; min-width:75px;"> NOMBRE DEL RESPONSABLE </th>
              <th style="width: 7%; font-size: 0.9em; min-width:40px;"> CELULAR </th>
           </tr>
         </table> 
       
        <form name="numero_locales" action="" method="post"  >
         <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($num_locales); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			echo "<td style=\"width: 3%; min-width:24px; \">".($i+1)."</td>";
			echo "<td style=\"width: 5%; min-width:35px; \"> <input type=\"radio\" class=\"edit_local_inv\" name=\"id_local\" value=\"".$num_locales[$i]['id']."\" /> </td>"; 
			echo "<td style=\"width: 20%; font-size: 0.9em; min-width:75px; text-align:left; \"> ".stripslashes($num_locales[$i]['nombre_local'])."</td>"; 
			echo "<td style=\"width: 25%; text-align: left; font-size: 0.9em; min-width:60px; \" >".stripslashes($num_locales[$i]['direccion_local'])."</td>";
		    echo "<td style=\"width: 7%; font-size: 0.9em; min-width:40px; \" >".stripslashes($num_locales[$i]['telefono_local'])."</td>";
			 
			switch( $num_locales[$i]['tipo_local'] )
			{
			   case "bodega":
			      $tipo_local = "Bodega";
			   break;
			   case "almacen":
			      $tipo_local = "Almac&eacute;n";
			   break;
				
		    } // Fin del switch 
				 
			echo "<td style=\"width: 5%; font-size: 0.9em; min-width:30px;  \">".$tipo_local."</td>";
		     		 
			echo "<td style=\"width: 16%; text-align: left; font-size: 0.9em; min-width:75px;  \">".stripslashes($num_locales[$i]['nombre_responsable'])."</td>";
		    echo "<td style=\"width: 7%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($num_locales[$i]['cell_responsable'])."</td>";
			echo "</tr>";
		 }
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS LOCALES  -->
<?php
   
   }    // Fin del if ( $num_locales == "null" )
  
?>             
 <!---------------**********************************  VISTA5 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['optioninv']) && $_GET['optioninv'] == "mov" )    {
	    // Esto es cuando le doy al botón MOVIMIENTOS DE LA BARRA SUPERIOR

     $mov_locales = show_locales();	      //01 carga en esta variable todos los locales de la BD.

?>  
         <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
 
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Inventario." href="javascript:void(0)" onclick="submitinv('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
        
        <!-- *******************************************************************************************
                                        MENSAJES DE INSERCIÓN/ERRROR DE LOCALES 
            *********************************************************************************************  -->       
<?php 
         if ( isset($_GET['movtype']))  {
		 
		     if ( $_GET['movtype'] == "ok" )   {
			 //CASO 1. Esto significa que no concuerdan los saldos origen de la TABLA STOCK y la TABLA MOVIMIENTOS
			 // **************** ESTO ESPERO QUE NUNCA SUCEDA Y SÓLO SALE CUANDO NO ES UN AJUSTE DE INVENTARIO **************** //
?>        
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> Movimientos introducidos correctamente en la BD </div>
<?php
   	         }   // Fin del if ( $_GET['movtype'] ==  .... )
		 }  // Fin del if ( isset($_GET['movtype']))
?>             
        
        <!-- *******************************************************************************************
                  1. FORMULARIO DE ENTRADA/EDICIÓN DE DATOS PARA CREAR LOS MOVIMIENTOS DE ARTÍCULO
            *********************************************************************************************  --> 
       <div class="include_form" id="administrar_inv">
       
         <form action="" method="post" name="form_nuevo_mov">
           <fieldset class="fieldset_form">   
            <legend> Crear Movimiento de Art&iacute;culo </legend>
            
            <!--  PRIMER <div> PARA LOS DATOS DE INVENTARIO  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; crear los movimientos de sus art&iacute;culos de inventario. Para ver reportes de los movimientos de art&iacute;culos, por favor seleccione la pesta&ntilde;a  'Resumen Mov. de Inventario'. GRACIAS</span>
            <div class="inline_line" style="min-width:700px; margin-top:5px; margin-right:5px;">
                             
               <table class="table_fieldset" style="width:450px;">    
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:40%;"> Fecha </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_movimiento" name="fecha_movimiento" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td> Seleccione el Art&iacute;culo </td>  
                   <td style="text-align:left;"> <input type="radio" name="select_type" id="type_descripcion" value="por_descripcion" onchange="return able_descripcion();" onfocus="return able_descripcion();" style="margin:10px 0px 10px 5px;" /> Por Descripci&oacute;n </td>
                 </tr>  
                 
                 <!-- FILA 3 -->
                 <tr>
                    <td>&nbsp;  </td>  
                    <td style="text-align:left;"> <input type="radio" name="select_type" id="type_codigo" value="por_codigo" onchange="return able_codigo();" onfocus="return able_codigo();" style="margin:10px 0px 10px 5px;" />  Por C&oacute;digo del Art&iacute;culo </td>
                 </tr>                         
                 
                 <!-- FILA 4 -->
                 <tr>  
                   <td> Concepto del Movimiento </td>
                   <td> <select name="concepto_mov" id="concepto_mov" class="text_form" style="width: 70%; padding-right:2px; padding-left:2px;">                            <option value="seleccione"> Seleccione </option>    
                            <option value="movimiento_inv"> Mov. de Inventario </option> 
                            <option value="ajuste_inv"> Ajuste de Inventario </option>
                            <option value="otros"> Otros </option>
                        </select>
                        
                        <!-- ESTE ES EL CONCEPTO DEL MOVIMIENTO QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="concepto_mov_letras" id="concepto_mov_letras" value=""  />
                                      
                   </td>           
                 </tr>
                            
                 <!-- FILA 5 -->
                 <tr>  
                   <td> Origen </td>
                   <td> <select name="origen_mov" class="text_form" id="origen_mov" style="width: 70%; padding-right:2px; padding-left:2px;">                          <option value="seleccione"> Seleccione </option>    
                   <?php        
                       	   
					   if ( $mov_locales != "null" )  {    
						  // Si $mov_locales == null significa que no se ha introducido ningún local.   
						  for ( $i=0; $i < count($mov_locales); $i++ )
						  {
						    echo "<option value=\"".$mov_locales[$i]['id']."\"> ".stripslashes($mov_locales[$i]['nombre_local'])." &nbsp;(".$mov_locales[$i]['tipo_local'].") </option>";	
						  }
					   }
				       
				   ?>        
                           <option value="otros"> Otros </option>                     
                        </select>
                   
                        <!-- ESTE ES EL NOMBRE DEL LOCAL QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="nombre_local_origen" id="nombre_local_origen" value=""  />
                   
                   </td>           
                </tr>   
                           
                 <!-- FILA 6 -->
                 <tr>  
                   <td> Destino </td>
                   <td> <select name="destino_mov" class="text_form" id="destino_mov" style="width: 70%; padding-right:2px; padding-left:2px;">                           <option value="seleccione"> Seleccione </option>    
                   <?php        
                       if ( $mov_locales != "null" )  {    
						  // Si $mov_locales == null significa que no se ha introducido ningún local.     
						  for ( $i=0; $i < count($mov_locales); $i++ )
						  {
						    echo "<option value=\"".$mov_locales[$i]['id']."\"> ".stripslashes($mov_locales[$i]['nombre_local'])." &nbsp;(".$mov_locales[$i]['tipo_local'].") </option>";	
						  }
					   }
				   ?>    
                           <option value="otros"> Otros </option>  
                        </select>
                   
                        <!-- ESTE ES EL NOMBRE DEL LOCAL QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="nombre_local_destino" id="nombre_local_destino" value=""  />
                                    
                   </td>           
                </tr>
                
                <!-- FILA 7 -->
                <tr>
                  <td> Cantidad ( S&oacute;lo n&uacute;mero ) </td>
                  <td> <input class="text_form" type="text" name="cantidad_movimiento" id="cantidad_movimiento_mov" value="" maxlength="20" style="width: 70px;" placeholder="Cantidad" /> </td>
                </tr>
                  
            </table> 
                 
             <!--****************************************************************************************
                             div DE LOS CAMPOS PARA INSERTAR EL CÓDIGO Y O LA DESCRIPCIÓN  
                                  -> CASO 1. DESCRIPCIÓN 
                 ****************************************************************************************--> 
             <div class="autocomplete_descrip"> 
                 <input class="text_form" type="text" id="valor_descripcion" name="descripcion_articulo" value="" maxlength="100" style="width: 280px;" placeholder="Escriba la Descripci&oacute;n" disabled="disabled" /> 
                 
                 <input class="text_form" type="text" id="valor_codigo" name="codigo_articulo" value="" maxlength="20" style="width: 280px;" disabled="disabled" /> 
                       
             </div> 
              
              <!--****************************************************************************************
                             div DE LOS CAMPOS PARA INSERTAR EL CÓDIGO Y O LA DESCRIPCIÓN  
                                  -> CASO 2. CÓDIGO 
                 ****************************************************************************************-->  
              <div class="autocomplete_codigo"> 
                  <input class="text_form" type="text" id="valor_codigo2" name="codigo_articulo2" value="" maxlength="100" style="width: 280px;" placeholder="Seleccione el C&oacute;digo" disabled="disabled" /> 
                  <input class="text_form" type="text" id="valor_descripcion2" name="descripcion_articulo2" value="" maxlength="100" style="width: 280px;" disabled="disabled" /> 
                 <span id="error_message_search_ref_art" style="color:#D40000; text-decoration:blink; font-size:0.8em;">  </span>
                                                 
             </div> 
              
              <!-- ESTE ES EL CÓDIGO QUE GUARDO EN LA BD  -->
              <input type="hidden" name="codigo_articulo_mov" value=""  /> 
              <!-- ESTA ES LA REFERENCIA QUE ME SIRVE PARA MOSTRAR EL ACEPTAR EL ENVÍO DEL ARTÍCULO (sólo javascript)   -->
              <input type="hidden" name="referencia_articulo_mov_hidden" value=""  />         
              
             <!--*******************************************************************************************
                                        div DEL LOS STOCK ORIGEN Y DESTINO 
                 *******************************************************************************************---> 
              <div style="position: absolute; top: 135px; left: 380px; height:30px; width:250px; padding-top:10px;">    
                 <label style="float: left;"> Stock Origen  </label> 
                 <input class="text_form" type="text" name="stock_origen" id="stock_origen_mov" value="" maxlength="10" style="width: 70px; float:left; margin-left:16px; margin-top:-7px;" disabled="disabled" />              
                 
                 <!-- AQUÍ GUARDO EL VALOR DEL STOCK ORIGEN PUES ARRIBA ESTÁ DESABILITADO -->
                 <input type="hidden" name="stock_origen_hidden" id="stock_origen_hidden_mov" value=""  />
              
              </div>
              <div style="position: absolute; top: 167px; left: 380px; height:30px; width:250px; padding-top:10px;">    
                 <label style="float: left;"> Stock Destino </label>
                 <input class="text_form" type="text" name="stock_destino" id="stock_destino_mov" value="" maxlength="10" style="width: 70px; float:left; margin-left:8px; margin-top:-7px;" disabled="disabled" />
              
                 <!-- AQUÍ GUARDO EL VALOR DEL STOCK DESTINO PUES ARRIBA ESTÁ DESABILITADO -->
                 <input type="hidden" name="stock_destino_hidden" id="stock_destino_hidden_mov" value=""  />
              
              </div>         
                            
               <!-- ********************************************************************************************
                             DIV DEL CARGANDO QUE SE MUESTRA CUANDO VOY A EDITAR ALGUN LOCAL (ajax)
                    ******************************************************************************************* --> 
       <div id="cargando_stock" style="display:none; float:right; margin:10px 20px 10px 0;">
           <center>
               <img src='images/ajax-loader.gif' border='0' />
           </center>
       </div> 
          
              <!-- ********************************************************************************************
                         DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
                   ******************************************************************************************* --> 
       <div id="server_error_stock" style="display:none; float:right; margin:10px 20px 10px 0;">
           
               <img src='images/ajax-loader.gif' border='0' style="vertical-align: middle;;" /> 
               <span class="ajax_error_box">Problema en el servidor. Intente m&aacute;s tarde. Gracias </span>
           
       </div> 
               
              <!-- CONTENEDOR <div> OBSERVACIONES  -->
              <div style="margin-top: 10px; min-width:670px; min-height:80px; float:left; padding:0px;">
              <fieldset class="fieldset_form">   
                <legend> Observaciones </legend> 
                
                <textarea name="observaciones_mov" id="observaciones_mov" class="textarea_form" style="width:100%;"></textarea>              
                
              </fieldset>
             </div>    
                                 
         <br style="line-height:100px;"/>         
              
              <!--  <div> CON LOS BOTONES DE SUBMIT Y RESET  -->
         <div style="min-height:40px; float:left; min-width:650px;">
           <p>
           <input type="submit" id="guardar_mov" value="Guardar" style="float:right; margin:15px 0px 5px 0; padding:3px 7px;" onclick="return send_mov();" />
           <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;"  />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
           
<!---------------**********************************  VISTA6 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['optioninv']) && $_GET['optioninv'] == "kardex" )    {
	    // Esto es cuando le doy al botón KARDEX DE LA BARRA SUPERIOR (REPORTES)

         $mov_locales = show_locales();	      //01 carga en esta variable todos los locales de la BD.

         if ( isset($_GET['karart']) && $_GET['karart'] == "ver" )  {
		     // Esto es para que se me muestre el kardex del artículo seleccionado. 	 
		     $kardex = process_kardex();
			 
		 }
     
?>               <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
                    ******************************************************************************************* -->
<?php
      if ( isset($_GET['karart']) && $_GET['karart'] == "ver" )  {
?> 
         <!-- Botón de IMPRIMIR  -->
         <div class="cabecera_botton">
            <a title="Imprimir Kardex." href="index.php?mod=mod_imprimir&inv=2&id=<?php echo $_POST['local_kardex']; ?>&desc=<?php echo $_POST['referencia_articulo_kardex_hidden']; ?>&cod=<?php echo $_POST['codigo_articulo_kardex']; ?>&fi=<?php echo $_POST['fecha_inicial']; ?>&ff=<?php echo $_POST['fecha_final']; ?>&name=<?php echo $_POST['nombre_local_kardex']; ?>" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div> 
<?php
	  }   // Fin del if
?>         
         
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Inventario." href="javascript:void(0)" onclick="submitinv('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>

            <!-- *******************************************************************************************
                   1. FORMULARIO DE ENTRADA/EDICIÓN DE DATOS PARA VER EL KARDEX DE UN ARTÍCULO SELECCIONADO
                 *********************************************************************************************  --> 
       <div class="include_form" id="kardex_art">
       
         <form action="" method="post" name="form_kardex_art">
           <fieldset class="fieldset_form">   
            <legend>Kardex de Art&iacute;culo</legend>
            
            <!--  PRIMER <div> PARA LOS DATOS A INTRODUCIR  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; ver el Kardex de cualquier art&iacute;culo registrado en su negocio. Por favor incluya los datos en el formulario para ver el reporte. GRACIAS</span>
            <div class="inline_line" style="min-width:700px; margin-top:5px; margin-right:5px;">
                             
               <table class="table_fieldset" style="width:450px;">    
                 
                 <!-- FILA 1 -->
                 <tr>
                   <td> Seleccione el Art&iacute;culo </td>  
                   <td style="text-align:left;"> <input type="radio" name="select_type" id="type_descripcionk" value="por_descripcion" onchange="return able_descripcion_kardex();" onfocus="return able_descripcion_kardex();" style="margin:10px 0px 10px 5px;" /> Por Descripci&oacute;n </td>
                 </tr>  
                 
                 <!-- FILA 2 -->
                 <tr>
                    <td>&nbsp;  </td>  
                    <td style="text-align:left;"> <input type="radio" name="select_type" id="type_codigok" value="por_codigo" onchange="return able_codigo_kardex();" onfocus="return able_codigo_kardex();" style="margin:10px 0px 10px 5px;" /> Por C&oacute;digo del Art&iacute;culo </td>
                 </tr>   
                 
                 <!-- FILA 3 -->
                 <tr>
                   <td style="width:40%;"> Fecha inicial </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_inicialk" name="fecha_inicial" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 
                 <!-- FILA 4 -->
                 <tr>
                   <td style="width:40%;"> Fecha final </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_finalk" name="fecha_final" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 
                 
                 <!-- FILA 5 -->
                 <tr>  
                   <td> Seleccione Local </td>
                   <td> <select name="local_kardex" class="text_form" id="local_kardex" style="width: 70%; padding-right:2px; padding-left:2px;">                          <option value="seleccione"> Seleccione </option>    
                   			   
                   <!-- SI EL USUARIO ES VENDEDOR SOLO PUEDE VER SU LOCAL   -->
				   <?php        
                      if ( $_SESSION['tipo_usuario'] == "v" )  {
					      // USUARIO VENDEDOR
						  
						  for ( $i=0; $i < count($mov_locales); $i++ )
						  {
						       // Busco solamente el local del usuario VENDEDOR.
							   if ( $mov_locales[$i]['id'] == $_SESSION['id_local'] )  {
							       $id_local = $mov_locales[$i]['id'];                 // id del local en cuestión.
							       $nombre_local = stripslashes($mov_locales[$i]['nombre_local']);   // Nombre del local en cuestión.
								   $tipo_local = $mov_locales[$i]['tipo_local'];       // Tipo de local en cuestión.
							   
							   } else { continue; }
						  }
						  
						  echo "<option value=\"".$id_local."\"> ".$nombre_local." &nbsp;(".$tipo_local.") </option>";
					  
					  } else {
					     // USUARIO ADMINISTRADOR.
					     
					      if ( $mov_locales != "null" )  {    
						      // Si $mov_locales == null significa que no se ha introducido ningún local.
						     for ( $i=0; $i < count($mov_locales); $i++ )
						     {
						          echo "<option value=\"".$mov_locales[$i]['id']."\"> ".stripslashes($mov_locales[$i]['nombre_local'])." &nbsp;(".$mov_locales[$i]['tipo_local'].") </option>";	
						     }
					      }
				   
					  }
				   
				   ?>        
                        </select>
                   
                        <!-- ESTE ES EL NOMBRE DEL LOCAL QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="nombre_local_kardex" value=""  />
                   
                   </td>           
                </tr>   
                      
            </table> 
                 
             <!--****************************************************************************************
                             div DE LOS CAMPOS PARA INSERTAR: 1. EL CÓDIGO 2. LA DESCRIPCIÓN 
                                    CASO 1. Por descripción del artículo.  
                 ****************************************************************************************--> 
             <div class="autocomplete_kardex"> 
                 <input class="text_form" type="text" id="valor_descripcionk" name="descripcion_articulo" value="" maxlength="100" style="width: 280px;" placeholder="Escriba la descripci&oacute;n" disabled="disabled" /> 
                 <input class="text_form" type="text" id="valor_codigok" name="codigo_articulo" value="" maxlength="100" style="width: 280px;" disabled="disabled" /> 
                                
             </div> 
              
             <!--****************************************************************************************
                             div DE LOS CAMPOS PARA INSERTAR: 1. EL CÓDIGO 2. LA DESCRIPCIÓN 
                                    CASO 2. Por código del artículo.  
                 ****************************************************************************************--> 
             <div class="autocomplete_kardex_codigo"> 
                 <input class="text_form" type="text" id="valor_codigok2" name="codigo_articulo2" value="" maxlength="100" style="width: 280px;" placeholder="Seleccione el C&oacute;digo" disabled="disabled" /> 
                 <input class="text_form" type="text" id="valor_descripcionk2" name="descripcion_articulo2" value="" maxlength="100" style="width: 280px;" disabled="disabled" /> 
                 <span id="error_message_search_ref_art_kardex" style="color:#D40000; text-decoration:blink; font-size:0.8em;">  </span>
                                            
             </div>  
                          
             <!-- ESTE ES EL CÓDIGO QUE GUARDO EN LA BD  -->
             <input type="hidden" name="codigo_articulo_kardex" value=""  />  
             <!-- ESTA ES LA REFERENCIA QUE ME SIRVE PARA MOSTRAR EL ACEPTAR EL ENVÍO DEL ARTÍCULO (sólo javascript)   -->
             <input type="hidden" name="referencia_articulo_kardex_hidden" value=""  /> 
                                         
              <!-- ********************************************************************************************
                       DIV DEL CARGANDO QUE SE MUESTRA CUANDO VOY A SELECCIONAR EL ARTÍCULO POR CÓDIGO (ajax)
                    ******************************************************************************************* --> 
                    <div id="cargando_art_by_code" style="display:none; float:right; margin:10px 20px 10px 0;">
                      <center>
                          <img src='images/ajax-loader.gif' border='0' />
                      </center>
                   </div> 
          
              <!-- ********************************************************************************************
                         DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
                   ******************************************************************************************* --> 
                   <div id="server_error_kardex" style="display:none; float:right; margin:10px 20px 10px 0;">
                       <img src='images/ajax-loader.gif' border='0' style="vertical-align: middle;;" /> 
                       <span class="ajax_error_box">Problema en el servidor. Intente m&aacute;s tarde. Gracias </span>
                   </div> 
                       
              <!--  <div> CON LOS BOTONES DE SUBMIT Y RESET  -->
         <div style="min-height:40px; float:left; min-width:180px;">
           <p>
           <input type="submit" value="Ver Kardex" style="float:right; margin:15px 0px 5px 0; padding:3px 7px;" onclick="return send_art_kardex();" />
           <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;"  />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
      
       <!-- *******************************************************************************************
                                   MENSAJES DE INSERCIÓN/ERRROR DE KARDEX DE ARTÍCULOS 
            *********************************************************************************************  -->  
<?php
         if ( isset($kardex))  {
		 
		     if ( $kardex == "null" )   {
			 //CASO 1. Esto significa que en el local seleccionado para ver el Kardex no existe el artículo seleccionado
?>                         
                 <!-- ************************************************************************************************
                          TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
         ************************************************************************************************ -->
        
        <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
           <!-- FILA 1 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Descripci&oacute;n del art&iacute;culo </td>
              <td style="width: 60%;"> <?php echo $_POST['referencia_articulo_kardex_hidden']; ?>  </td>
           </tr>
           
           <!-- FILA 2 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> C&oacute;digo del art&iacute;culo </td>
              <td style="width: 60%;"> <?php echo $_POST['codigo_articulo_kardex']; ?>  </td>
           </tr>
        
           <!-- FILA 3 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Inicial de la Consulta </td>
              <td style="width: 60%;"> <?php  echo $_POST['fecha_inicial']; ?>  </td>
           </tr>
           
           <!-- FILA 4 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Final de la Consulta </td>
              <td style="width: 60%;"> <?php  echo $_POST['fecha_final']; ?>  </td>
           </tr>
           
           <!-- FILA 5-->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local de la Consulta </td>
              <td style="width: 60%;"> <?php echo $_POST['nombre_local_kardex']; ?>  </td>
           </tr>
        
        </table>

        <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> No existe ning&uacute;n movimiento del Art&iacute;culo Seleccionado en el Local <?php echo $_POST['nombre_local_kardex']; ?> para los d&iacute;as seleccionados. </div>
                 
<?php
			 } else if ( $kardex == "error" )   {
			 //CASO 2. Esto significa que se ha escrito en la barra de direcciones del navegador sin enviar las var. $_POST
?>        
                 <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Error de Env&iacute;o de Datos</div>
<?php
			 } else  {
			 //CASO 3. Esto significa que TODO ESTÁ BIEN Y VOY A MOSTRAR LOS DATOS
			
?>     <!-- ************************************************************************************************
                          TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
         ************************************************************************************************ -->
        
        <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
           <!-- FILA 1 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Descripci&oacute;n del art&iacute;culo </td>
              <td style="width: 60%;"> <?php echo $_POST['referencia_articulo_kardex_hidden']; ?>  </td>
           </tr>
           
           <!-- FILA 2 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> C&oacute;digo del art&iacute;culo </td>
              <td style="width: 60%;"> <?php echo $_POST['codigo_articulo_kardex']; ?>  </td>
           </tr>
        
           <!-- FILA 3 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Inicial de la Consulta </td>
              <td style="width: 60%;"> <?php  echo $_POST['fecha_inicial']; ?>  </td>
           </tr>
           
           <!-- FILA 4 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Final de la Consulta </td>
              <td style="width: 60%;"> <?php  echo $_POST['fecha_final']; ?>  </td>
           </tr>
           
           <!-- FILA 5-->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local de la Consulta </td>
              <td style="width: 60%;"> <?php echo $_POST['nombre_local_kardex']; ?>  </td>
           </tr>
        
        </table>
       
        <!-- *******************************************************************************************
                          MUESTRO LA TABLA CON LOS DATOS DEL KARDEX DEL ARTÍCULO SELECCIONADO
             *********************************************************************************************  -->  
             
         <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
        <div style="width:100%; margin-top:15px;" id="show_kardex">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="11"> TABLA KARDEX PARA UN ART&Iacute;CULO EN UN LOCAL DETERMINADO </th>
           </tr>
           <tr >
              <th style="width: 3%; min-width: 24px;"> # </th>
              <th style="width: 6%; font-size: 0.9em; min-width:40px;"> FECHA </th>
              <th style="width: 6%; font-size: 0.9em; min-width:40px;"> MOV. </th>
              <th style="width: 10%; font-size: 0.9em; min-width:60px;"> CONCEPTO </th>
              <th style="width: 15%; font-size: 0.9em; min-width:73px;"> PROVEEDOR </th>
              <th style="width: 15%; font-size: 0.9em; min-width:40px;"> CLIENTE </th>
              <th style="width: 15%; font-size: 0.9em; min-width:80px;"> OBSERVACIONES </th>
              <th style="width: 12%; font-size: 0.9em; min-width:70px;"> PERSONA </th>
              <th style="width: 6%; font-size: 0.8em; min-width:40px;"> ENTRADA </th>
              <th style="width: 6%; font-size: 0.8em; min-width:40px;"> SALIDA </th>
              <th style="width: 6%; font-size: 0.8em; min-width:40px;"> STOCK </th>
           </tr>
         </table> 
       
        <form name="kardex_art" action="" method="post"  >
         <table class="table_form" id="table_pagination_kardex" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($kardex); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			echo "<td style=\"width: 3%; min-width:21px; \">".($i+1)."</td>"; 
			echo "<td style=\"width: 6%; min-width:40px; \">".stripslashes($kardex[$i]['fecha_movimiento'])."</td>"; 
			echo "<td style=\"width: 6%; font-size: 0.9em; min-width:40px; \"> ".$kardex[$i]['tipo_mov']."</td>"; 
			echo "<td style=\"width: 10%; text-align: left; font-size: 0.9em; min-width:60px; \" >".$kardex[$i]['concepto_mov']."</td>";
		    echo "<td style=\"width: 15%; text-align: left; font-size: 0.9em; min-width:65px; \" >".stripslashes($kardex[$i]['origen_mov_proveedor'])."</td>";
			echo "<td style=\"width: 15%; text-align: left;font-size: 0.9em; min-width:73px;  \">".stripslashes($kardex[$i]['destino_mov_cliente'])."</td>";
		    echo "<td style=\"width: 15%; text-align: left; font-size: 0.9em; min-width:80px;  \">".stripslashes($kardex[$i]['observaciones_mov'])."</td>"; 		
			switch($kardex[$i]['recibido']) 
			{
			   // Esto es para saber el tipo de movimiento si es de ENTRADA o de SALIDA y poner en el campo ENTRDA-SALIDA respectivamente 	
			   case "1":
			        // CASO DE QUE LA OPERACIÓN HAYA SIDO UNA ENTRDA DE ARTÍCULOS
					$persona = stripslashes($kardex[$i]['persona_q_hace_mov']);
			   break;
			   case "0":
			        // CASO DE QUE LA OPERACIÓN HAYA SIDO UNA SALIDA DE ARTÍCULOS
					$persona  = "<span style=\"color:#D40000;\"> pendiente </span>";
			   break;
			
			}     // Fin del switch($kardex[$i]['tipo_mov']) 
		
			echo "<td style=\"width: 12%; text-align: center; font-size: 0.9em; min-width:70px;  \">".$persona."</td>";
			 
			switch($kardex[$i]['tipo_mov']) 
			{
			   // Esto es para saber el tipo de movimiento si es de ENTRADA o de SALIDA y poner en el campo ENTRDA-SALIDA respectivamente 	
			   case "Entrada":
			        // CASO DE QUE LA OPERACIÓN HAYA SIDO UNA ENTRDA DE ARTÍCULOS
					$cantidad_entrada = stripslashes($kardex[$i]['cantidad_movimiento']);
					$cantidad_salida  = "";
			   break;
			   case "Salida":
			        // CASO DE QUE LA OPERACIÓN HAYA SIDO UNA SALIDA DE ARTÍCULOS
					$cantidad_entrada = "";
					$cantidad_salida  = stripslashes($kardex[$i]['cantidad_movimiento']);
			   break;
			
			}     // Fin del switch($kardex[$i]['tipo_mov']) 
			 		 
			echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".$cantidad_entrada."</td>";
			echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".$cantidad_salida."</td>";
			echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:30px;  \">".stripslashes($kardex[$i]['saldo'])."</td>";
			 				 
			 echo "</tr>";
		 }
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
<?php
   	         }   // Fin del if ( $kardex ==  .... )
		 }  // Fin del if ( isset($kardex))
?>     
  
<!---------------**********************************  VISTA7 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['optioninv']) && $_GET['optioninv'] == "stock" )    {
	    // Esto es cuando le doy al botón STOCK DE LA BARRA SUPERIOR (REPORTES)

     $mov_locales = show_locales();	      //01 carga en esta variable todos los locales de la BD.

     if ( isset($_GET['stockl']) && $_GET['stockl'] == "ver" )  {
		     //01 Esto es para que se me muestre el Stock del local seleccionado. 	 
		     $show_stock = process_stock('a');
			 //02 Esto es para que se me muetren todos los MOVIMIENTOS pendientes DEL LOCAL SELECCIONADO 
             $show_pendientes = show_pendientes('a');
	 }
?>   
    <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
 
<?php 
         if ( isset($_GET['stockl']) && $_GET['stockl'] == "ver" )  {
		     // Esto es para que se me muestre el STOCK en el local seleccionado. 	         
?>  
             <!-- Botón de IMPRIMIR  -->
            <div class="cabecera_botton">
              <a title="Imprimir Stock." href="index.php?mod=mod_imprimir&inv=4&id=<?php echo $_POST['local_stock']; ?>&name=<?php echo $_POST['nombre_local_stock']; ?>" target="_blank">
               <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
               <br>
               Imprimir
              </a>
            </div>     
<?php         
		 }   // Fin del if ( $_GET['stockl'] )
?>     
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Inventario." href="javascript:void(0)" onclick="submitinv('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
    
        <!-- *******************************************************************************************
                               MENSAJES DE INSERCIÓN CORRECTA DE MOVIMIENTOS PENDIENTES A LA BD 
            *********************************************************************************************  -->       
<?php 
         if ( isset($_GET['stockins']))  {
		 
		     settype($_GET['stockins'], "integer");
			 switch($_GET['stockins'])
			 {
				case 1:
				   $message = "Se ha introducido 1 movimiento pendiente";
				break;
				default:
				   $message = "Se han introduciddos ".$_GET['stockins']." movimientos pendientes";
				break; 
		     }
			 		 
			 if ( $_GET['stockins'] != 0 )   {
			     // Esto significa que se han INSERTADO correctamente el movimiento en la TABLA de la BD y devuelve un número.
			 
?>        
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> <?php echo $message;  ?> correctamente en la Base de Datos </div>
<?php
			 } else {
				 // Esto significa que se ha escrito alguna variable $_GET que no es un número y por tanto debe dar un error.
?>				  
	             <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Error. </div>
                		 
<?php			 
			 }   // Fin del if ( $_GET['stockins'] ==  .... )
		 }  // Fin del if ( isset($_GET['stockins']))
?>         
            
         <!-- *******************************************************************************************
               1. FORMULARIO DE ENTRADA DE DATOS PARA VER EL STOCK DEL LOCAL SELECCIONADO
            *********************************************************************************************  --> 
       <div class="include_form" id="stock_art">
       
         <form action="" method="post" name="form_stock">
           <fieldset class="fieldset_form">   
            <legend>Stock</legend>
            
            <!--  PRIMER <div> PARA LOS DATOS A INTRODUCIR  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; ver el Stock de todos los art&iacute;culos de cualquiera de sus locales, as&iacute; como todas las entradas pendientes de ser recibidas. Por favor seleccione el local para ver los datos. GRACIAS. </span>
            <div class="inline_line" style="min-width:500px; margin-top:5px; margin-right:5px; min-height:100px;">
                             
               <table class="table_fieldset" style="width:450px;">    
                 
                 <!-- FILA 1 -->
                 <tr>  
                   <td> Seleccione Local </td>
                   <td> <select name="local_stock" class="text_form" id="local_stock" style="width: 70%; padding-right:2px; padding-left:2px;">                          <option value="seleccione"> Seleccione </option>    
                    
                   <!-- SI EL USUARIO ES VENDEDOR SOLO PUEDE VER SU LOCAL   -->    
					   
				   <?php        
                      if ( $_SESSION['tipo_usuario'] == "v" )  {
					      // USUARIO VENDEDOR
						  
						  for ( $i=0; $i < count($mov_locales); $i++ )
						  {
						       // Busco solamente el local del usuario VENDEDOR.
							   if ( $mov_locales[$i]['id'] == $_SESSION['id_local'] )  {
							       $id_local = $mov_locales[$i]['id'];                 // id del local en cuestión.
							       $nombre_local = stripslashes($mov_locales[$i]['nombre_local']);   // Nombre del local en cuestión.
								   $tipo_local = $mov_locales[$i]['tipo_local'];       // Tipo de local en cuestión.
							   
							   } else { continue; }
						  }
						  
						  echo "<option value=\"".$id_local."\"> ".$nombre_local." &nbsp;(".$tipo_local.") </option>";
					  
					  } else {
					     // USUARIO ADMINISTRADOR.
					   
					     if ( $mov_locales != "null" )  {    
						    // Si $mov_locales == null significa que no se ha introducido ningún local.
						  
						    for ( $i=0; $i < count($mov_locales); $i++ )
						    {
						         echo "<option value=\"".$mov_locales[$i]['id']."\"> ".stripslashes($mov_locales[$i]['nombre_local'])." &nbsp;(".$mov_locales[$i]['tipo_local'].") </option>";	
						    }
                   
					     }
				   
					  }
				   			   
				   ?>        
                        </select>
                   
                        <!-- ESTE ES EL NOMBRE DEL LOCAL QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="nombre_local_stock" value=""  />
                   
                   </td>           
                </tr>   
                      
            </table> 
                                   
         <!--  <div> CON LOS BOTONES DE SUBMIT -->
         <div style="min-height:40px; float:left; min-width:365px;">
           <p>
             <input type="submit" value="Ver Stock" style="float:right; margin:15px 0px 5px 0; padding:3px 7px;" onclick="return send_stock();" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
      
    <!-- *******************************************************************************************
                                   MUESTRO LOS ARTÍCULOS QUE ESTÁN PENDIENTES DE ENTRADA A ESE ALMACÉN
             *********************************************************************************************  -->  
<?php        
        if ( isset($show_pendientes))  {
		 
		     if ( $show_pendientes == "null" )   {
			 //CASO 1. Esto significa que en el local seleccionado no hay ningun artículo pendiente de ENTRADA.
             
			 // NO PASA NADA 
    		 } else {
             // CASO 2. Esto signfica que en el Local Seleccionado hay artículos pendientes de ENTRADA -> MUESTRO LA TABLA  <-. 
?>          
        <!-- *******************************************************************************************
                          MUESTRO LA TABLA CON LOS DATOS DE LOS ARTICULOS PENDIENTES DE ENTRADA 
             *********************************************************************************************  -->  
             
         <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
        <div style="width:100%; margin:15px 0px 30px 0px;; background-color:#999; padding:3px; border-radius:5px 5px;" id="show_pendientes">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="9"> TABLA DE ART&Iacute;CULOS PENDIENTES DE ENTRADA AL LOCAL </th>
           </tr>
           <tr >
              <th style="width: 3%; min-width: 24px;"> # </th>
              <th style="width: 5%; min-width: 30px;"> Entrada </th>
              <th style="width: 6%; font-size: 0.9em; min-width:40px;"> FECHA </th>
              <th style="width: 5%; font-size: 0.9em; min-width:40px;"> C&Oacute;DIGO </th>
              <th style="width: 25%; font-size: 0.9em; min-width:80px;"> REFERENCIA </th>
              <th style="width: 14%; font-size: 0.9em; min-width:60px;"> CONCEPTO </th>
              <th style="width: 17%; font-size: 0.9em; min-width:73px;"> PROVEEDOR </th>
              <th style="width: 20%; font-size: 0.9em; min-width:80px;"> OBSERVACIONES </th>
              <th style="width: 5%; font-size: 0.8em; min-width:40px;"> CANTIDAD </th>
           </tr>
         </table> 
       
        <form name="pendientes_entrada" action="" method="post"  >
         <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($show_pendientes); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			   echo "<td style=\"width: 3%; min-width:24px; \">".($i+1)."</td>"; 
			   echo "<td style=\"width: 5%; min-width: 30px;\"> <input type=\"checkbox\" name=\"id_pendiente".$show_pendientes[$i]['id']."\" value=\"on\"  </td>";
			   echo "<td style=\"width: 6%; min-width:40px; \">".stripslashes($show_pendientes[$i]['fecha_salida'])."</td>";
			   echo "<td style=\"width: 5%; min-width:40px; \">".stripslashes($show_pendientes[$i]['codigo_art'])."</td>"; 
			   echo "<td style=\"width: 25%; text-align: left; min-width:80px; \">".stripslashes($show_pendientes[$i]['referencia_art'])."</td>"; 
			   echo "<td style=\"width: 14%; text-align: left; font-size: 0.9em; min-width:60px; \" >".stripslashes($show_pendientes[$i]['concepto_mov'])."</td>";
		       echo "<td style=\"width: 17%; text-align: left; font-size: 0.9em; min-width:65px; \" >".stripslashes($show_pendientes[$i]['origen_mov_proveedor'])."</td>"; 
			   echo "<td style=\"width: 20%; text-align: left; font-size: 0.9em; min-width:80px;  \">".stripslashes($show_pendientes[$i]['observaciones_mov'])."</td>"; 
			   echo "<td style=\"width: 5%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($show_pendientes[$i]['cantidad_movimiento'])."</td>";
            echo "</tr>";

		 
		 }
?>
<!-- id del local para poder hacer las ENTRADAS en la TABLA CORRESPONDIENTE  -->
<input type="hidden" name="local_stock" value="<?php echo $_POST['local_stock']; ?>" />

<?php        
		    echo "<tr>";
		       echo "<td style=\"width: 100%; text-align: center; font-size: 0.9em; padding-left: 30px;\" colspan=\"10\"> <input type=\"submit\" value=\"A&ntilde;adir\" style=\"width:70px;\" onclick=\"return add_pendiente();\" /> </td>";
		    echo "</tr>";
				    
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
   
<?php
			 }  // Fin del if ( $show_pendientes == "null" )   {
		}  // Fin del if ( isset($show_pendientes))  {

?>        
      <!-- *******************************************************************************************
                   MENSAJES DE LECTURA CORRECTA/ERRROR DE RESUMEN MOVIMIENTO DE INVENTARIOS
            *********************************************************************************************  -->  
<?php
         if ( isset($show_stock))  {
		 
		     if ( $show_stock == "null" )   {
			 //CASO 1. Esto significa que en el local seleccionado para ver el Kardex no existe eel artículo seleccionado
?>                  
       <!-- ************************************************************************************************
                          TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
            ************************************************************************************************ -->
        
        <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
                   
           <!-- FILA 1 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Stock del Local </td>
              <td style="width: 60%;"> <?php echo $_POST['nombre_local_stock']; ?>  </td>
           </tr>
           
           <!-- FILA 2 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha </td>
              <td style="width: 60%;"> <?php echo gmdate('Y-m-d', time() - 18000 ); ?>  </td>
           </tr>
           
        </table>
                
        <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> No existe Stock en el Local Seleccioando. </div>
<?php
			 } else if ( $show_stock == "error" )   {
			 //CASO 2. Esto significa que se ha escrito en la barra de direcciones del navegador sin enviar las var. $_POST
?>        
                 <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Error de Env&iacute;o de Datos</div>
<?php
			 } else  {
			 //CASO 3. Esto significa que TODO ESTÁ BIEN Y VOY A MOSTRAR LOS DATOS
?>
      <!-- ************************************************************************************************
                          TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
         ************************************************************************************************ -->
        
        <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
                   
           <!-- FILA 1 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local para ver el Stock </td>
              <td style="width: 60%;"> <?php echo $_POST['nombre_local_stock']; ?>  </td>
           </tr>
           
           <!-- FILA 2 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha </td>
              <td style="width: 60%;"> <?php echo gmdate('Y-m-d', time() - 18000 ); ?>  </td>
           </tr>
           
        </table>
            
        <!-- *******************************************************************************************
                                      MUESTRO LA TABLA CON LOS DATOS DEL STOCK
             *********************************************************************************************  -->  
             
         <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
        <div style="width:100%; margin-top:15px;" id="show_kardex">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="4"> TABLA DE STOCK DEL LOCAL SELECCIONADO </th>
           </tr>
           <tr >
              <th style="width: 3%; min-width: 24px;"> # </th>
              <th style="width: 15%; font-size: 0.9em; min-width:50px;"> CODIGO </th>
              <th style="width: 67%; font-size: 0.9em; min-width:80px;"> REFERENCIA </th>
              <th style="width: 15%; font-size: 0.9em; min-width:40px;"> STOCK </th>
           </tr>
         </table> 
       
        <form name="local_stock" action="" method="post"  >
         <table class="table_form" id="table_pagination_stock" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($show_stock); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			   echo "<td style=\"width: 3%; min-width:24px; \">".($i+1)."</td>"; 
			   echo "<td style=\"width: 15%; min-width:50px; \">".stripslashes($show_stock[$i]['codigo_art'])."</td>"; 
			   echo "<td style=\"width: 67%; text-align: left; min-width:80px; \">".stripslashes($show_stock[$i]['referencia_art'])."</td>"; 
			   echo "<td style=\"width: 15%; font-size: 0.9em; min-width:40px; \"> ".stripslashes($show_stock[$i]['stock_actual'])."</td>"; 
            echo "</tr>";
		 }
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->

<?php
   	         }   // Fin del if ( $show_stock ==  .... )
		 }  // Fin del if ( isset($show_stock))
?>     
      
<!---------------**********************************  VISTA8 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['optioninv']) && $_GET['optioninv'] == "mov_invres" )    {
	    // Esto es cuando le doy al botón RESUMEN MOV INVENTARIO  DE LA BARRA SUPERIOR (REPORTES)

     $mov_locales = show_locales();	      //01 carga en esta variable todos los locales de la BD.

     if ( isset($_GET['resmov']) && $_GET['resmov'] == "ver" )  {
		     // Esto es para que se me muestre el Resumen del movimiento de inventario para el local seleccionado. 	 
		     $res_mov_inv = process_resumen_mov_inv();
			 
     }
?>
 <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->

<?php 
         if ( isset($_GET['resmov']) && $_GET['resmov'] == "ver" )  {
		     // Esto es para que se me muestre el Resumen del movimiento de inventario para el local seleccionado. 	         
?>  
             <!-- Botón de IMPRIMIR  -->
            <div class="cabecera_botton">
              <a title="Imprimir Resumen de Movimiento de Inventario." href="index.php?mod=mod_imprimir&inv=3&id=<?php echo $_POST['local_resmov']; ?>&fi=<?php  echo $_POST['fecha_inicial']; ?>&ff=<?php  echo $_POST['fecha_final']; ?>&son=<?php echo $_POST['ver_solo']; ?>&name=<?php echo $_POST['nombre_local_resmov']; ?>" target="_blank">
               <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
               <br>
               Imprimir
              </a>
            </div>     
<?php         
		 }   // Fin del if ( $_GET['resmov'] )
?>         
         
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Inventario." href="javascript:void(0)" onclick="submitinv('inicio');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
          
 <!-- *******************************************************************************************
               1. FORMULARIO DE ENTRADA DE DATOS PARA VER EL RESUMEN DE MOV DEL LOCAL SELECCIONADO
            *********************************************************************************************  --> 
       <div class="include_form" id="stock_art">
       
         <form action="" method="post" name="form_resmov">
           <fieldset class="fieldset_form">   
            <legend> Ver Resumen de Movimientos </legend>
            
            <!--  PRIMER <div> PARA LOS DATOS A INTRODUCIR  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; ver el Resumen de Movimientos de Inventario de todos los art&iacute;culos en cualquiera de sus locales. Por favor llene los campos del formulario para ver los datos. GRACIAS. </span>
            <div class="inline_line" style="min-width:500px; margin-top:5px; margin-right:5px; min-height:100px;">
                             
               <table class="table_fieldset" style="width:450px;">    
                 
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:40%;"> Fecha inicial </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_inicialres" name="fecha_inicial" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td style="width:40%;"> Fecha final </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_finalres" name="fecha_final" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 <!-- FILA 3 -->
                 <tr>  
                   <td> Seleccione Local </td>
                   <td> <select name="local_resmov" class="text_form" id="local_resmov" style="width: 70%; padding-right:2px; padding-left:2px;">                          <option value="seleccione"> Seleccione </option>    
                   <!-- SI EL USUARIO ES VENDEDOR SOLO PUEDE VER SU LOCAL   -->    
					   
				   <?php        
                      if ( $_SESSION['tipo_usuario'] == "v" )  {
					      // USUARIO VENDEDOR
						  
						  for ( $i=0; $i < count($mov_locales); $i++ )
						  {
						       // Busco solamente el local del usuario VENDEDOR.
							   if ( $mov_locales[$i]['id'] == $_SESSION['id_local'] )  {
							       $id_local = $mov_locales[$i]['id'];                 // id del local en cuestión.
							       $nombre_local = stripslashes($mov_locales[$i]['nombre_local']);   // Nombre del local en cuestión.
								   $tipo_local = stripslashes($mov_locales[$i]['tipo_local']);       // Tipo de local en cuestión.
							   
							   } else { continue; }
						  }
						  
						  echo "<option value=\"".$id_local."\"> ".$nombre_local." &nbsp;(".$tipo_local.") </option>";
					  
					  } else {
					     // USUARIO ADMINISTRADOR.       
                       
					      if ( $mov_locales != "null" )  {    
						     // Si $mov_locales == null significa que no se ha introducido ningún local.  
						  
						     for ( $i=0; $i < count($mov_locales); $i++ )
						     {
						       echo "<option value=\"".$mov_locales[$i]['id']."\"> ".stripslashes($mov_locales[$i]['nombre_local'])." &nbsp;(".stripslashes($mov_locales[$i]['tipo_local']).") </option>";	
						     }
					      }
                   				   
					  }
						   
				   ?>        
                        </select>
                   
                        <!-- ESTE ES EL NOMBRE DEL LOCAL QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="nombre_local_resmov" value=""  />
                   
                   </td>           
                </tr>   
                
                <!-- FILA 4 -->
                <tr>  
                   <td> Ver Solamente </td>
                   <td> <select name="ver_solo" class="text_form" id="ver_solo" style="width: 70%; padding-right:2px; padding-left:2px;">                          <option value="seleccione"> Seleccione </option>         
                          <option value="entradas"> Entradas </option>   
                          <option value="salidas"> Salidas </option>
                          <option value="ambos"> Ambos </option>
                        </select>
                   </td>     
            </table> 
                        
         <!--  <div> CON LOS BOTONES DE SUBMIT  -->
         <div style="min-height:40px; float:left; min-width:365px;">
           <p>
             <input type="submit" value="Ver Resumen" style="float:right; margin:15px 0px 5px 0; padding:3px 7px;" onclick="return send_resmov();" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="administrar_inv"  -->
 
      <!-- *******************************************************************************************
                   MENSAJES DE LECTURA CORRECTA/ERRROR DE RESUMEN MOVIMIENTO DE INVENTARIOS
            *********************************************************************************************  -->  
<?php
         if ( isset($res_mov_inv))  {
		 
		     if ( $res_mov_inv == "null" )   {
			 //CASO 1. Esto significa que en el local seleccionado para ver el Kardex no existe eel artículo seleccionado
?>             
                 <!-- ************************************************************************************************
                          TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
         ************************************************************************************************ -->
        
        <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
                   
           <!-- FILA 1 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Inicial de la Consulta </td>
              <td style="width: 60%;"> <?php  echo $_POST['fecha_inicial']; ?>  </td>
           </tr>
           
           <!-- FILA 2 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Final de la Consulta </td>
              <td style="width: 60%;"> <?php  echo $_POST['fecha_final']; ?>  </td>
           </tr>
           
           <!-- FILA 3 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local de la Consulta </td>
              <td style="width: 60%;"> <?php echo $_POST['nombre_local_resmov']; ?>  </td>
           </tr>
           
           <!-- FILA 4 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Ver s&oacute;lo </td>
              <?php
			     if ( $_POST['ver_solo'] == "entradas" )  {
					 
					 $ver_solamente = "Entradas"; 
				  	 
				 } else if ( $_POST['ver_solo'] == "salidas"  )  {
					 
					 $ver_solamente = "Salidas";
				   
				 } else if ( $_POST['ver_solo'] == "ambos" )  {
					 
				     $ver_solamente = "Entradas y Salidas";
				 }
			  		  
			  ?>
              <td style="width: 60%;"> <?php echo $ver_solamente; ?>  </td>
           </tr>
        
        </table>

        <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> No existe ha habido ning&uacute;n movimiento en el Local <?php echo $_POST['nombre_local_resmov']; ?> para los d&iacute;as seleccionados. </div>
                  
<?php
			 } else if ( $res_mov_inv == "error" )   {
			 //CASO 2. Esto significa que se ha escrito en la barra de direcciones del navegador sin enviar las var. $_POST
?>        
                 <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Error de Env&iacute;o de Datos</div>
<?php
			 } else  {
			 //CASO 3. Esto significa que TODO ESTÁ BIEN Y VOY A MOSTRAR LOS DATOS
?>    
         <!-- ************************************************************************************************
                          TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
         ************************************************************************************************ -->
        
        <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
                   
           <!-- FILA 1 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Inicial de la Consulta </td>
              <td style="width: 60%;"> <?php  echo $_POST['fecha_inicial']; ?>  </td>
           </tr>
           
           <!-- FILA 2 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Final de la Consulta </td>
              <td style="width: 60%;"> <?php  echo $_POST['fecha_final']; ?>  </td>
           </tr>
           
           <!-- FILA 3 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local de la Consulta </td>
              <td style="width: 60%;"> <?php echo $_POST['nombre_local_resmov']; ?>  </td>
           </tr>
           
           <!-- FILA 4 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Ver s&oacute;lo </td>
              <?php
			     if ( $_POST['ver_solo'] == "entradas" )  {
					 
					 $ver_solamente = "Entradas"; 
				  	 
				 } else if ( $_POST['ver_solo'] == "salidas"  )  {
					 
					 $ver_solamente = "Salidas";
				   
				 } else if ( $_POST['ver_solo'] == "ambos" )  {
					 
				     $ver_solamente = "Entradas y Salidas";
				 }
			  ?>
              <td style="width: 60%;"> <?php echo $ver_solamente; ?>  </td>
           </tr>
           
        </table>
       
        <!-- *******************************************************************************************
                          MUESTRO LA TABLA CON LOS DATOS DEL KARDEX DEL ARTÍCULO SELECCIONADO
             *********************************************************************************************  -->  
             
         <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
        <div style="width:100%; margin-top:15px;" id="show_kardex">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="12"> TABLA DE MOVIMIENTOS DE INVENTARIO DE UN LOCAL DETERMINADO </th>
           </tr>
           <tr >
              <th style="width: 3%; min-width: 24px;"> # </th>
              <th style="width: 6%; font-size: 0.9em; min-width:40px;"> FECHA </th>
              <th style="width: 4%; font-size: 0.8em; min-width:40px;"> CODIGO </th>
              <th style="width: 5%; font-size: 0.8em; min-width:40px;"> MOVIMIENTO </th>
              <th style="width: 12%; font-size: 0.9em; min-width:60px;"> CONCEPTO </th>
              <th style="width: 13%; font-size: 0.9em; min-width:73px;"> PROVEEDOR </th>
              <th style="width: 13%; font-size: 0.9em; min-width:40px;"> CLIENTE </th>
              <th style="width: 15%; font-size: 0.9em; min-width:80px;"> OBSERVACIONES </th>
              <th style="width: 12%; font-size: 0.9em; min-width:70px;"> PERSONA </th>
              <th style="width: 4%; font-size: 0.8em; min-width:40px;"> ENTRADA </th>
              <th style="width: 4%; font-size: 0.8em; min-width:40px;"> SALIDA </th>
              <th style="width: 4%; font-size: 0.8em; min-width:40px;"> STOCK </th>
           </tr>
         </table> 
       
        <form name="kardex_art" action="" method="post"  >
         <table class="table_form" id="table_pagination_kardex" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($res_mov_inv); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			 echo "<td style=\"width: 3%; min-width:21px; \">".($i+1)."</td>"; 
			 echo "<td style=\"width: 6%; min-width:40px; \">".stripslashes($res_mov_inv[$i]['fecha_movimiento'])."</td>"; 
			 echo "<td style=\"width: 4%; min-width:40px; cursor:pointer; \" title=\"".stripslashes($res_mov_inv[$i]['referencia_art'])."\" >".stripslashes($res_mov_inv[$i]['codigo_art'])."</td>"; 
			 echo "<td style=\"width: 5%; font-size: 0.9em; min-width:40px; \"> ".$res_mov_inv[$i]['tipo_mov']."</td>"; 
			 echo "<td style=\"width: 12%; text-align: left; font-size: 0.9em; min-width:60px; \" >".stripslashes($res_mov_inv[$i]['concepto_mov'])."</td>";
		     echo "<td style=\"width: 13%; text-align: left; font-size: 0.9em; min-width:65px; \" >".stripslashes($res_mov_inv[$i]['origen_mov_proveedor'])."</td>";
			 echo "<td style=\"width: 13%; text-align: left;font-size: 0.9em; min-width:73px;  \">".stripslashes($res_mov_inv[$i]['destino_mov_cliente'])."</td>";
		     echo "<td style=\"width: 15%; text-align: left; font-size: 0.9em; min-width:80px;  \">".stripslashes($res_mov_inv[$i]['observaciones_mov'])."</td>"; 
		    switch($res_mov_inv[$i]['recibido']) 
			{
			   // Esto es para saber el tipo de movimiento si es de ENTRADA o de SALIDA y poner en el campo ENTRDA-SALIDA respectivamente 	
			   case "1":
			        // CASO DE QUE LA OPERACIÓN HAYA SIDO UNA ENTRDA DE ARTÍCULOS
					$persona = stripslashes($res_mov_inv[$i]['persona_q_hace_mov']);
			   break;
			   case "0":
			        // CASO DE QUE LA OPERACIÓN HAYA SIDO UNA SALIDA DE ARTÍCULOS
					$persona  = "<span style=\"color:#D40000;\"> pendiente </span>";
			   break;
			}  // Fin del switch($kardex[$i]['tipo_mov']) 
						
			echo "<td style=\"width: 12%; text-align: center; font-size: 0.9em; min-width:70px;  \">".$persona."</td>";
			 
			switch($res_mov_inv[$i]['tipo_mov']) 
			{
			   // Esto es para saber el tipo de movimiento si es de ENTRADA o de SALIDA y poner en el campo ENTRDA-SALIDA respectivamente 	
			   case "Entrada":
			        // CASO DE QUE LA OPERACIÓN HAYA SIDO UNA ENTRDA DE ARTÍCULOS
					$cantidad_entrada = stripslashes($res_mov_inv[$i]['cantidad_movimiento']);
					$cantidad_salida  = "";
			   break;
			   case "Salida":
			        // CASO DE QUE LA OPERACIÓN HAYA SIDO UNA SALIDA DE ARTÍCULOS
					$cantidad_entrada = "";
					$cantidad_salida  = stripslashes($res_mov_inv[$i]['cantidad_movimiento']);
			   break;
			}  // Fin del switch($kardex[$i]['tipo_mov']) 
						 
			 echo "<td style=\"width: 4%; text-align: center; font-size: 0.9em; min-width:40px;  \">".$cantidad_entrada."</td>";
			 echo "<td style=\"width: 4%; text-align: center; font-size: 0.9em; min-width:40px;  \">".$cantidad_salida."</td>";
			 echo "<td style=\"width: 4%; text-align: center; font-size: 0.9em; min-width:30px;  \">".stripslashes($res_mov_inv[$i]['saldo'])."</td>";
			echo "</tr>";
		 }
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
<?php
   	         }   // Fin del if ( $kardex ==  .... )
		 }  // Fin del if ( isset($kardex))
?>         
    <!---------------**********************************  VISTA9 **************************+*************---------------->

<?php
	 } else if ( empty($_GET['art']) && empty($_GET['optioninv']) )  {  
          // Esto es cuando no existe la variable $_GET['art']  PANTALLA POR DEFECTO
		      
	      if ( $_SESSION['tipo_usuario'] == "a" )  {
			  
			   $articulos_inv = articulos_inventario(); //01 BUSCO LOS DATOS DE TODOS LOS ARTÍCULOS DE LA BD.
		  
		  } else  if ( $_SESSION['tipo_usuario'] == "v" )  {
			  // CASO 2. VENDEDOR /* Sólo muestro los artículos en stock y los pendientes de entrada al alamacén */   
		      
			  //01 Esto es para que me muestre el stock actual del ALMACÉN seleccionado.
			  $show_stock = process_stock('v');
			  //02 Esto es para que se me muetren todos los MOVIMIENTOS pendientes DEL ALMACÉN SELECCIONADO 
              $show_pendientes = show_pendientes('v');
			  //03 Esto es para que se muestre el nombre del local asignado al vendedor.  
			  $show_local_name = show_local_name($_SESSION['id_local']);
		    
		   } 
?>
     <!--*******************************************************************************************************************
                                        1. ESTO ES SOLO PARA EL USUARIO ADMINISTRADOR 
          *******************************************************************************************************************-->
     <?php
       if ( $_SESSION['tipo_usuario'] == "a"  )   {       
	 ?>
         <!-- Botón de IMPRIMIR  -->
         <div class="cabecera_botton">
            <a title="Imprimir art&iacute;culos del inventario." href="index.php?mod=mod_imprimir&inv=1" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div>    
                   
         <!-- Botón de DETALLE -->
         <div class="cabecera_botton">
            <a title="Detalle del Art&iacute;culo Seleccionado."  href="javascript:void(0)" onclick="return submitinv('detalle');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_apply.png" class="img_botton">
              <br>
              Detalle
            </a>
         </div>
        
         <!-- Botón de EDITAR  -->
         <div class="cabecera_botton">
            <a title="Editar el Art&iacute;culo Seleccionado." href="javascript:void(0)" onclick="submitinv('editar');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_edit.png" class="img_botton">
              <br>
              Editar
            </a>
         </div>
         
         <!-- Botón de NUEVO  -->
         <div class="cabecera_botton">
            <a title="Crear Nuevo Art&iacute;culo en la Base de Datos."  href="javascript:void(0)" onclick="return submitinv('new');">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_new.png" class="img_botton">
              <br>
              Nuevo
            </a>
         </div>
                
      <!-- *******************************************************************************************
                        MENSAJE DE ALERTA CUANDO NO EXISTEN ARTÍCULOS EN LA TABLA articulos_inventario ( ADMINISTRADOR )
            *********************************************************************************************  --> 
<?php
     if ( $articulos_inv == "null" )  {
		 
?>		 
         <div class="message_wrong" style="margin-top:0px;" id="show_inv1"> No existen ART&Iacute;CULOS en el Inventario </div> 
<?php	 
	 }  else  {   // Fin del  if ( $articulos_inv == "null" )  {
?>       
       
       <!-- ********************************************************************************************
          TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS ARTÍCULOS DEL INVENTARIO" 
          ******************************************************************************************* -->
      
         <!-- TABLA CON LOS REGISTROS DE LOS ARTÍCULOS DE INVENTARIO  -->
        <div style="width:100%;" id="show_inv2">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="12"> TABLA DE ART&Iacute;CULOS </th>
           </tr>
           <tr >
              <th style="width: 3%; min-width: 24px;">  </th>
              <th style="width: 3%; min-width: 24px;"> # </th>
              <th style="width: 6%; font-size: 0.8em; min-width:40px;"> C&Oacute;DIGO </th>
              <th style="width: 20%; font-size: 0.9em; min-width:80px;"> REFERENCIA </th>
              <th style="width: 15%; font-size: 0.9em; min-width:65px;"> DETALLE </th>
              <th style="width: 15%; font-size: 0.9em; min-width:73px;"> PROVEEDOR </th>
              <th style="width: 6%; font-size: 0.7em; min-width:40px;"> STOCK M&Iacute;N. </th>
              <th style="width: 6%; font-size: 0.8em; min-width:40px;"> COSTO </th>
              <th style="width: 6%; font-size: 0.8em; min-width:40px;"> V1 </th>
              <th style="width: 6%; font-size: 0.8em; min-width:40px;"> V2 </th>
              <th style="width: 6%; font-size: 0.8em; min-width:40px;"> V3 </th>
              <th style="width: 8%; font-size: 0.7em; min-width:55px;"> UNIDAD DE MEDIDA </th>
            </tr>
         </table> 
       
        <form name="articulos_radios" action="" method="post"  >
         <table class="table_form" id="table_pagination_inventario" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($articulos_inv); $i++ )
		{
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			 
			 echo "<td style=\"width: 3%; min-width:21px; \"> <input type=\"radio\" name=\"articulos_inv\" value=\"".$articulos_inv[$i]['id']."\" /> </td>"; 
			 echo "<td style=\"width: 3%; min-width:21px; color:#056AA8;\">".($i+1)."</td>";
			 echo "<td style=\"width: 6%; font-size: 0.9em; min-width:40px; \"> ".stripslashes($articulos_inv[$i]['codigo_art'])."</td>"; 
			 
			 $stock_act = stripslashes($articulos_inv[$i]['stock_actual']);  // Este es el valor del Stock Actual en la Bodega.
			 settype($stock_act, "float");
			 $stock_min_bodega = stripslashes($articulos_inv[$i]['stock_minimo']);       // Este es el valor del Stock Mínimo en la Bodega. 
			 settype($stock_min_bodega, "float");
			
			 if ( $stock_act <= $stock_min_bodega )  {
				 //a) Esto es para que me dé una alerta si el stock actual es menor a 25 (unidades de medida)	
		         $style_stock = "color: blue; text-decoration: blink underline;";
			     $title_stock = "title=\"Alerta!!.Tiene en BODEGA menos de la cantidad del Stock M&iacute;nimo.\"";
			 } else {
			     //b) NO pasa nada.	 	
			     $style_stock = "";
			     $title_stock = "";
			 }
			 	 
			 echo "<td ".$title_stock." style=\"width: 20%; text-align: left; font-size: 0.9em; min-width:90px; ".$style_stock." \" >".stripslashes($articulos_inv[$i]['referencia_art'])."</td>";
		     echo "<td style=\"width: 15%; text-align: left; font-size: 0.9em; min-width:65px; \" >".stripslashes($articulos_inv[$i]['detalle_art'])."</td>";
			 echo "<td style=\"width: 15%; text-align: left;font-size: 0.9em; min-width:73px;  \">".stripslashes($articulos_inv[$i]['nombre'])."</td>";
		     		 
			 echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($articulos_inv[$i]['stock_minimo'])."</td>";
			 echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($articulos_inv[$i]['precio_costo_art'])."</td>";
			 echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($articulos_inv[$i]['precio_venta1'])."</td>";
			 echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($articulos_inv[$i]['precio_venta2'])."</td>";
			 echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($articulos_inv[$i]['precio_venta3'])."</td>";
			 echo "<td style=\"width: 8%; text-align: left; font-size: 0.9em; min-width:55px;  \">".stripslashes($articulos_inv[$i]['unidad_medida'])."</td>";
		   echo "</tr>";
		 }
            
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->

<?php	 
	 }  // Fin del  if ( $clientes_ds == "null" )  {
?>         
     
          <!--*******************************************************************************************************************
                                        2. ESTO ES SOLO PARA EL USUARIO VENDEDOR ( MUESTRA EL STOCK )
          *******************************************************************************************************************-->   
<?php
   } else if ( $_SESSION['tipo_usuario'] == "v" )  { 
   
?>
           <!-- Botón de IMPRIMIR  -->
            <div class="cabecera_botton" style="margin-left:80%;">
              <a title="Imprimir Stock." href="index.php?mod=mod_imprimir&inv=4&id=<?php echo $_SESSION['id_local']; ?>&name=<?php echo stripslashes($show_local_name['nombre_local']) ?>" target="_blank">
               <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
               <br>
               Imprimir
              </a>
            </div>    

    <!-- *******************************************************************************************
                               MENSAJES DE INSERCIÓN CORRECTA DE MOVIMIENTOS PENDIENTES A LA BD 
            *********************************************************************************************  -->       
<?php 
         if ( isset($_GET['stockins']))  {
		 
		     settype($_GET['stockins'], "integer");
			 switch($_GET['stockins'])
			 {
				case 1:
				   $message = "Se ha introducido 1 movimiento pendiente";
				break;
				default:
				   $message = "Se han introduciddos ".$_GET['stockins']." movimientos pendientes";
				break; 
		     }
			 		 
			 if ( $_GET['stockins'] != 0 )   {
			     // Esto significa que se han INSERTADO correctamente el movimiento en la TABLA de la BD y devuelve un número.
			 
?>        
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> <?php echo $message;  ?> correctamente en la Base de Datos </div>
<?php
			 } else {
				 // Esto significa que se ha escrito alguna variable $_GET que no es un número y por tanto debe dar un error.
?>				  
	             <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Error. </div>
                		 
<?php			 
			 }   // Fin del if ( $_GET['stockins'] ==  .... )
		  }  // Fin del if ( isset($_GET['stockins']))
?>        
    
            <!-- *******************************************************************************************
                                   MUESTRO LOS ARTÍCULOS QUE ESTÁN PENDIENTES DE ENTRADA A ESE ALMACÉN
                 *********************************************************************************************  -->  

<?php        
          if ( isset($show_pendientes))  {
		 
		       if ( $show_pendientes == "null" )   {
			       //CASO 1. Esto significa que en el local seleccionado no hay ningun artículo pendiente de ENTRADA.
             
			       // NO PASA NADA 

			   } else {
                   // CASO 2. Esto signfica que en el Local Seleccionado hay artículos pendientes de ENTRADA -> MUESTRO LA TABLA  <-. 
?>                   
  
            <!-- *******************************************************************************************
                              MUESTRO LA TABLA CON LOS DATOS DE LOS ARTICULOS PENDIENTES DE ENTRADA 
                 *********************************************************************************************  -->  
             
          <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
          <div style="width:100%; margin:15px 0px 30px 0px;; background-color:#999; padding:3px; border-radius:5px 5px;" id="show_pendientes">
           <table class="table_form" cellspacing="0" cellpadding="0">
            <tr >
               <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="9"> TABLA DE ART&Iacute;CULOS PENDIENTES DE ENTRADA AL LOCAL </th>
            </tr>
            
            <tr >
               <th style="width: 3%; min-width: 24px;"> # </th>
               <th style="width: 5%; min-width: 30px;"> Entrada </th>
               <th style="width: 6%; font-size: 0.9em; min-width:40px;"> FECHA </th>
               <th style="width: 5%; font-size: 0.9em; min-width:40px;"> C&Oacute;DIGO </th>
               <th style="width: 25%; font-size: 0.9em; min-width:80px;"> REFERENCIA </th>
               <th style="width: 14%; font-size: 0.9em; min-width:60px;"> CONCEPTO </th>
               <th style="width: 17%; font-size: 0.9em; min-width:73px;"> PROVEEDOR </th>
               <th style="width: 20%; font-size: 0.9em; min-width:80px;"> OBSERVACIONES </th>
               <th style="width: 5%; font-size: 0.8em; min-width:40px;"> CANTIDAD </th>
             </tr>
            </table> 
       
            <form name="pendientes_entrada" action="" method="post"  >
            <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
         for ( $i=0; $i < count($show_pendientes); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			   echo "<td style=\"width: 3%; min-width:24px; \">".($i+1)."</td>"; 
			   echo "<td style=\"width: 5%; min-width: 30px;\"> <input type=\"checkbox\" name=\"id_pendiente".stripslashes($show_pendientes[$i]['id'])."\" value=\"on\"  </td>";
			   echo "<td style=\"width: 6%; min-width:40px; \">".stripslashes($show_pendientes[$i]['fecha_salida'])."</td>";
			   echo "<td style=\"width: 5%; min-width:40px; \">".stripslashes($show_pendientes[$i]['codigo_art'])."</td>"; 
			   echo "<td style=\"width: 25%; text-align: left; min-width:80px; \">".stripslashes($show_pendientes[$i]['referencia_art'])."</td>"; 
			   echo "<td style=\"width: 14%; text-align: left; font-size: 0.9em; min-width:60px; \" >".stripslashes($show_pendientes[$i]['concepto_mov'])."</td>";
		       echo "<td style=\"width: 17%; text-align: left; font-size: 0.9em; min-width:65px; \" >".stripslashes($show_pendientes[$i]['origen_mov_proveedor'])."</td>";
			   echo "<td style=\"width: 20%; text-align: left; font-size: 0.9em; min-width:80px;  \">".stripslashes($show_pendientes[$i]['observaciones_mov'])."</td>"; 
			   echo "<td style=\"width: 5%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($show_pendientes[$i]['cantidad_movimiento'])."</td>";
            echo "</tr>";
   	     } // Fin del for(
?>

<!-- id del local para poder hacer las ENTRADAS en la TABLA CORRESPONDIENTE  -->
<input type="hidden" name="local_stock" value="<?php echo $_POST['local_stock']; ?>" />
 
<?php
        
		    echo "<tr>";
		       echo "<td style=\"width: 100%; text-align: center; font-size: 0.9em; padding-left: 30px;\" colspan=\"10\"> <input type=\"submit\" value=\"A&ntilde;adir\" style=\"width:70px;\" onclick=\"return add_pendiente();\" /> </td>";
		    echo "</tr>";
			    
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
  
<?php
  		   }  // Fin del if ( $show_pendientes == "null" )   {
		}  // Fin del if ( isset($show_pendientes))  {
?>        
                 
      <!-- *******************************************************************************************
                   MENSAJES DE LECTURA CORRECTA/ERRROR DE RESUMEN MOVIMIENTO DE INVENTARIOS
            *********************************************************************************************  -->  
   
<?php
         if ( isset($show_stock))  {
		 
		     if ( $show_stock == "null" )   {
			 //CASO 1. Esto significa que en el local seleccionado para ver el Kardex no existe eel artículo seleccionado
?>        
                 
                 <!-- ************************************************************************************************
                          TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
         ************************************************************************************************ -->
        
        <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
                   
           <!-- FILA 1 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local para ver el Stock </td>
              <td style="width: 60%;"> <?php echo stripslashes($show_local_name['nombre_local']); ?>  </td>
           </tr>
           
           <!-- FILA 2 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha </td>
              <td style="width: 60%;"> <?php echo gmdate('Y-m-d', time() - 18000 ); ?>  </td>
           </tr>
           
        </table>
                 
        <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> No existe Stock en el Local Seleccioando. </div>
                         
<?php
			 } else if ( $show_stock == "error" )   {
			 //CASO 2. Esto significa que se ha escrito en la barra de direcciones del navegador sin enviar las var. $_POST
			
?>        
                 <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Error de Env&iacute;o de Datos</div>

<?php
			 } else  {
			 //CASO 3. Esto significa que TODO ESTÁ BIEN Y VOY A MOSTRAR LOS DATOS
			
?>    

         <!-- ************************************************************************************************
                          TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
         ************************************************************************************************ -->
        
        <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:40%;">
                   
           <!-- FILA 1 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local para ver el Stock </td>
              <td style="width: 60%;"> <?php echo stripslashes($show_local_name['nombre_local']); ?>  </td>
           </tr>
           
           <!-- FILA 2 -->
           <tr>    
              <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha </td>
              <td style="width: 60%;"> <?php echo gmdate('Y-m-d', time() - 18000 ); ?>  </td>
           </tr>
           
        </table>
             
        <!-- *******************************************************************************************
                          MUESTRO LA TABLA CON LOS DATOS DEL KARDEX DEL ARTÍCULO SELECCIONADO
             *********************************************************************************************  -->  
             
         <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
        <div style="width:100%; margin-top:15px;" id="show_kardex">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="4"> TABLA DEL STOCK DEL ALMAC&Eacute;N <?php echo stripslashes($show_local_name['nombre_local']);  ?> </th>
           </tr>
                      
           <tr >
            
              <th style="width: 3%; min-width: 24px;"> # </th>
              <th style="width: 15%; font-size: 0.9em; min-width:50px;"> CODIGO </th>
              <th style="width: 67%; font-size: 0.9em; min-width:80px;"> REFERENCIA </th>
              <th style="width: 15%; font-size: 0.9em; min-width:40px;"> STOCK </th>
              
           </tr>
         </table> 
       
        <form name="local_stock" action="" method="post"  >
         <table class="table_form" id="table_pagination_stock" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($show_stock); $i++ )
		 {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			   echo "<td style=\"width: 3%; min-width:24px; \">".($i+1)."</td>"; 
			   echo "<td style=\"width: 15%; min-width:50px; \">".stripslashes($show_stock[$i]['codigo_art'])."</td>"; 
			   echo "<td style=\"width: 67%; text-align: left; min-width:80px; \">".stripslashes($show_stock[$i]['referencia_art'])."</td>"; 
			   echo "<td style=\"width: 15%; font-size: 0.9em; min-width:40px; \"> ".stripslashes($show_stock[$i]['stock_actual'])."</td>"; 
            echo "</tr>";
		 }
            
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->

<?php
   	         }   // Fin del if ( $show_stock ==  .... )
		 }  // Fin del if ( isset($show_stock))

   }   // Fin del if ( $_SESSION['tipo_usuario'] == "a"  )   {  
?> 
 
<?php

}   // Fin del if (isset($_GET['art'])) 

?> 