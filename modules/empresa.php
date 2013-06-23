<?php
/*
* Este es el módulo que muestra LOS DATOS DE LA EMPRESA (PRIMERO A LLENAR)
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*/
/*
* VISTA1: MUESTRA EL FORMULARIO PARA LLENAR CON LOS DATOS A LLENAR CON LOS DATOS DE LA EMPRESA.
*
*
* VISTA2: MUESTRA LOS DATOS DE LA EMPRESA PARA QUE EL ADMINISTRADOR LOS PUEDA VER.
*
*
*  ***** EL PASO DE VISTA2 A VISTA1 SE HACE A TRAVÉS DE jQUERY. ********
*/

// no direct access
defined('VALID_VAR') or die;

?>
        <!--  ************************************** COMÚN **************************************** --------------->

<p> Bienvenido usuario al m&oacute;dulo EMPRESA donde usted podr&aacute; Crear y actualizar los datos de su Empresa. Por favor utilice el formulario para introducir datos de la misma. GRACIAS</p>
  
   <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES  
   *************************************************************************************************************-->
             
      <div id="radiobar_em" class="buttons_bar_full"> 
        <form>
	       
		      <input type="radio" id="radioe_1" name="radio" /><label for="radioe_1" title="Crear/Actualizar los datos generales de la Empresa.">Crear/actualizar datos</label>
		      	       
        </form>
      </div>

    <!--  ************************************** VISTA 1 **************************************** ---------------> 
<?php
         
		 $data_empresa = data_empresa_values();

?>
      
      <!-- ******************************************************************************************************** 
                                        FORMULARIO DE ENTRADA DE DATOS DE LA EMPRESA
      *************************************************************************************************************-->

      <div class="include_form" id="form_empresa" style="display:none; margin-top:20px;">
                
         <form action="#" method="post" name="form_empresa">
           <fieldset class="fieldset_form">   
            <legend>Crear/actualizar datos de la Empresa</legend>
            
            <!--  PRIMER <div>  -->
                       
            <div class="inline_line" style="min-width:550px; min-height:340px;">
                     
              <table style="width:100%;" cellpadding="0" cellspacing="0">   
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:30%; padding:3px;"><label class="label_form"> Nombre de la Empresa </label></td>
                   <td style="width:70%; padding:3px;"><input class="text_form" type="text" name="nombre_empresa" value="<?php echo stripslashes($data_empresa['nombre_empresa']); ?>" maxlength="80" placeholder="Nombre de la Empresa" style="width:99%; padding-right:0px;"/></td> 
                 </tr>
                 <!-- FILA 2 -->
                 <tr>  
                    <td style="padding:3px;"><label class="label_form" style="margin-right:64px;"> Raz&oacute;n Social: </label></td>
                    <td style="padding:3px;"><textarea class="textarea_form" style="width:99.9%; height: 80px; padding-right:0px;" name="razon_social" ><?php echo stripslashes($data_empresa['razon_social']);  ?></textarea></td>
                 </tr>             
                 <!-- FILA 3 -->
                 <tr>
                   <td style="width:30%; padding:3px;"><label class="label_form"> Direcci&oacute;n de la Empresa</label></td>
                   <td style="width:70%; padding:3px;"><input class="text_form" type="text" name="direccion_empresa" value="<?php echo stripslashes($data_empresa['direccion_empresa']);  ?>" maxlength="120" placeholder="Direcci&oacute;n de la Empresa" style="width:99%; padding-right:0px;"/></td> 
                 </tr>
                 <tr> 
                 <!-- FILA 4 -->
                 <tr>
                   <td style="width:30%; padding:3px;"><label class="label_form"> Tel&eacute;fono de la Empresa</label></td>
                   <td style="width:70%; padding:3px;"><input class="text_form" type="text" name="telefono_empresa" value="<?php echo stripslashes($data_empresa['telefono_empresa']);  ?>" maxlength="100" placeholder="Tel&eacute;fono de la Empresa" style="width:50%; padding-right:0px;"/></td> 
                 </tr>
                 <tr> 
                 <!-- FILA 5 -->
                 <tr>
                   <td style="width:30%; padding:3px;"><label class="label_form"> RUC de la Empresa</label></td>
                   <td style="width:70%; padding:3px;"><input class="text_form" type="text" name="ruc_empresa" value="<?php echo stripslashes($data_empresa['ruc_empresa']);  ?>" maxlength="20" placeholder="RUC de la Empresa" style="width:50%; padding-right:0px;"/></td> 
                 </tr>
                 <tr>                
                 <!-- FILA 6 -->
                 <tr>
                   <td style="width:30%; padding:3px;"><label class="label_form">Moneda de los Informes</label></td>
                   <td style="width:70%; padding:3px;"><input class="text_form" type="text" name="moneda_informes" value="<?php echo stripslashes($data_empresa['moneda_informes']);  ?>" maxlength="20" placeholder="Moneda de los informes" style="width:50%; padding-right:0px;"/></td> 
                 </tr>
                 <tr>
                     
              </table>   
                              
              <!--  TERCER <div> contendor de los botones Reset y Guardar  -->
             <div style="margin-top: 10px; position:absolute; top:278px; left: 16px;"> 
                <p>
                <input type="submit" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return send_empresaform();" />
                <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
                </p> 
             </div> 
                          
           </div>  <!-- fin del div class="inline_line"   -->
                   
           </fieldset>
         </form>   
     </div>     <!-- Fin del <div> include_form  -->
              
     <!--  ************************************** VISTA 2 **************************************** --------------->    
        
<?php 
  
    if ( $data_empresa['id'] == "0" )  {
	   // Esto significa que no se ha creado la empresa en el sistema	
		
?>		
     		
     <div class="message_ok" id="message_new_empresa">Usted no ha creado su empresa en el sistema. Por favor introduzca los datos. GRACIAS</div> 

<?php		
    
	}  else  {
     
?>     

     <!-- ******************************************************************************************************** 
                                        MUESTRA DE LOS DATOS DE LA EMPRESA
      *************************************************************************************************************-->
          
     <div id="data_empresa" style="width:100%;">   
     <!-- TABLA CON EL SALDO DEL MES ANTERIOR AL SOLICITADO -->
    <table class="table_info_empresa" cellspacing="0" cellpadding="0">
      <!-- FILA 1 -->
      <tr>    
        <td style="width:25%; color:#2C73A5; background-color:#EEEEEE; text-align:right;">Nombre de la Empresa</td>
        <td style="width:75%;"> <?php echo stripslashes($data_empresa['nombre_empresa']); ?> </td>
      </tr>
      <!-- FILA 2 -->
      <tr>    
        <td style="width:25%; color:#2C73A5; background-color:#EEEEEE; text-align:right;">Raz&oacute;n Social</td>
        <td style="width:75%;"> <?php echo stripslashes($data_empresa['razon_social']); ?></td>
      </tr>
      <!-- FILA 3 -->
      <tr>    
        <td style="width:25%; color:#2C73A5; background-color:#EEEEEE; text-align:right;">Direcci&oacute;n de la Empresa</td>
        <td style="width:75%;"> <?php echo stripslashes($data_empresa['direccion_empresa']); ?></td>
      </tr>
      <!-- FILA 4 -->
      <tr>    
        <td style="width:25%; color:#2C73A5; background-color:EEEEEE; text-align:right;">Tel&eacute;fono de la Empresa</td>
        <td style="width:75%;"> <?php echo stripslashes($data_empresa['telefono_empresa']); ?> </td>
      </tr>
      <!-- FILA 5 -->
      <tr>    
        <td style="width:25%; color:#2C73A5; background-color:#EEEEEE; text-align:right;">RUC de la Empresa</td>
        <td style="width:75%;"> <?php echo stripslashes($data_empresa['ruc_empresa']); ?> </td>
      </tr>
      <!-- FILA 6 -->
      <tr>    
        <td style="width:25%; color:#2C73A5; background-color:#EEEEEE; text-align:right;">Moneda de los Informes</td>
        <td style="width:75%;"><?php echo stripslashes($data_empresa['moneda_informes']); ?> </td>
      </tr>
    </table>
           
     </div>   <!-- Fin del <div> id=data_empresa  --> 
        
<?php		
    
	}  
     
?>        