<?php
/*
* Este es el módulo que muestra el el formulario para poder agregar un artículo nuevo al sistema desde la vista de Compras.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*/
/*
*
****************************** VISTAS DEL FORMULARIO ( var $_GET['articulo'] )  *******************************************
--------------------------------------------------------------------------------------------------------------------------
*VISTA1: VISTA QUE MUESTRA EL FORMULARIO CUANDO QUIERO INSERTAR UN NUEVO ARTÍCULO  ( $_GET['articulo'] == new )
*
*
*VISTA2: VISTA QUE MUESTRA EL SI SE INSERTARON BIEN LOS DATOS EN LA BD   ( $_GET['articulo'] == info )
*
*
*/

// no direct access
defined('VALID_VAR') or die;

?>
           
 <!---------------**********************************  VISTA1 **************************+*************---------------->
 
<?php
     if ( isset($_GET['articulo']) && $_GET['articulo'] == "new" )    {
	    // Esto es cuando le doy al botón NUEVO
?>          
                   
         <!-- *******************************************************************************************
                        FORMULARIO de entrada de DATOS DE REGISTROS DE NUEVO ARTÍCULO
            *********************************************************************************************  --> 
               
      <div class="include_form">
                
         <form action="" method="post" name="form_nuevo_articulo">
           <fieldset class="fieldset_form">   
            <legend> Formulario de Entrada de Datos para el Nuevo Art&iacute;culo </legend>
            
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
              <div style="margin-top: 10px; min-width:200px; border: 1px solid gray; border-radius:5px 5px; min-height:40px; float:left; padding:0px; position:absolute; left:0px; top: 150px;">
                             
               <table class="table_fieldset">    
                                 
                 <!-- FILA 1 --> 
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
         <div style="min-height:40px; float:left; position:absolute; top:255px; left:15px;">
           <p>
           <input type="submit" id="submit_new_art" value="Guardar" style="float:right; margin:15px 120px 5px 0;" onclick="return send_articulo_from_compras();" />
           <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0;" />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                  
            </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
     </div>
     
               <!-- ****************************************** AJAX ***************************************************-->
                       <!-- 04 <div> que me dice si el CÓDIGO EXISTE O NO -> funciona con AJAX <- -->   
                       <div id="show_message_codigo_art" style="color:blue; position:absolute; top:106px; left:490px; min-height:20px;"> </div>
                                                    
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
                             <span class="ajax_error_box"> Problema al comprobar el c&oacute;digo.Intente m&aacute;s tarde.Gracias </span>
           
                        </div> 
                      
               <!-- *************************************************************************************************************-->
               
               
                         
 <!---------------**********************************  VISTA2 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['articulo']) && $_GET['articulo'] == "info" )    {
	    // Esto es cuando aparece si se han introducido los datos correctamente en la BD.
?>          
          
               
       <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> ART&Iacute;CULO insertado correctamente en la Base de Datos. Ahora puede volver al m&oacute;dulo Compras. GRACIAS </div>    
        
          
<?php
	 } // Fin del if ( isset($_GET['articulo']) && $_GET['articulo'] == "new" )  {
?>          
