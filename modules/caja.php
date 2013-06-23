<?php
/*
* Este es el módulo que muestra las cajas del negocio.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*
*COMÚN: MUESTRA LO QUE ES COMÚN PARA TODAS LAS VISTAS.
*
*
*VISTA1: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --INGRESO DE CAJA--  ( $_GET['optioncaja == 'new_in'] )
*
*
*-----------------------------------------------------> REPORTES
*
*
**VISTA2:  VISTA (SÓLO ADMINISTRADOR) PARA VER LAS CAJAS DEL DÍA DE CUALQUIERA DE LOS ALMACENES. ( $_GET['optioncaja == 'actual'] )
*
*
*VISTA3: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --VER CAJAS ANTERIORES--  ( $_GET['optioncaja == 'otras_cajas'] ) 
*
*
*------------------------------------------------------> DEFAULT
*
*
*VISTA4: VISTA QUE MUESTRA LOS REGISTROS DE LA CAJA EN EL DÍA Y LOS SALDOS DE LA MISMA (default)
*
*
*/
// no direct access
defined('VALID_VAR') or die;

$fecha = gmdate('Y-m-d', time() - 18000 );

?>

<!-------------****************************** COMÚN ************************************--------------------->

 <p> Bienvenido usuario al m&oacute;dulo de CAJAS donde usted podr&aacute; crear las CAJAS de su sistema y ver todas las transacciones que se efect&uacute;en. Por favor utilice el formulario para introducir datos. GRACIAS </p>
 
   <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE ACCIÓN Y REPORTES
   *************************************************************************************************************-->
          
    <div id="radiobar_cajas" class="buttons_bar_full">  
      
         <form>
	          
     <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE ACCIÓN
          *************************************************************************************************************-->  
			 		                     
              <input type="radio" id="radio_cajas1" name="radio" <?php if (isset($_GET['optioncaja']) && $_GET['optioncaja'] == "new_in" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_cajas1" title="Crear transacci&oacute;n de efectivo entre Cajas del negocio."> Crear Transacci&oacute;n </label>
            
		            
      <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE REPORTES 
      *************************************************************************************************************-->
                     
          
          <span style="float:right; margin-right:4px;"> 
	      <?php if ( $_SESSION['tipo_usuario'] == "a" )  {  ?>
              <input type="radio" id="radio_cajas2" name="radio" <?php if (isset($_GET['optioncaja']) && $_GET['optioncaja'] == "actual" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_cajas2" title="Ver la Caja de cualquier almac&eacute;n el d&iacute;a de HOY."> Cajas de Hoy </label>
          <?php } ?>     
              
              <input type="radio" id="radio_cajas3" name="radio" <?php if (isset($_GET['optioncaja']) && $_GET['optioncaja'] == "otras_cajas" ) { echo "checked=\"checked\""; }  ?> /><label for="radio_cajas3" title="Ver todas las transacciones de cualquier Caja en un rango espec&iacute;fico de fechas."> Ver Cajas Anteriores </label>
		      
          </span>  	       
          <span style="font-size:1.2em; float:right; margin:8px 15px 0 0;"> REPORTES  </span>  
        </form>
             
    </div>  
       
      <!---------------**********************************  VISTA1 **************************+*************---------------->
<?php
     if ( isset($_GET['optioncaja']) && $_GET['optioncaja'] == "new_in" )    {
	    // Esto es cuando le doy al botón INGRESO DE CAJA DE LA BARRA DE BOTONES.

     $cajas_locales = show_cajas_locales();	      //01 carga en esta variable todas las cajas de los locales de la BD.
?>                
      <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
                  
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Caja" href="javascript:void(0)" onclick="inicio_caja_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
         
            <!-- *******************************************************************************************
                        FORMULARIO de entrada de DATOS DE REGISTROS DE INGRESO DE CAJA.
            *********************************************************************************************  --> 
             
       <div class="include_form" id="transaccion_caja">
                
         <form action="" method="post" name="form_transaccion_caja" id="form_transaccion_caja">
           <fieldset class="fieldset_form">   
            <legend>Formulario de Entrada de Datos para hacer un Ingreso o un Retiro de Caja</legend>

              <!--  PRIMER <div> PARA LOS DATOS DE LA TRANSACCIÓN  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; crear las transacciones de Cajas de su negocio. GRACIAS</span>
            <div class="inline_line" style="min-width:700px; margin-top:5px; margin-right:5px;">
                             
               <table class="table_fieldset" style="width:450px;">    
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:40%;"> Fecha </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_transaccion" name="fecha_transaccion" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 
                 <!-- FILA 5 -->
                 <tr>  
                   <td> Origen </td>
                   <td> <select name="origen_transaccion" class="text_form" id="origen_transaccion" style="width: 99%; padding-right:2px; padding-left:2px;">                          
                             <option value="seleccione"> Seleccione </option>    
                   <?php        
                       	   
					   if ( $cajas_locales != "null" )  {    
						  // Si $cajas_locales == null significa que no se ha introducido ningún local.   
						  if ( $_SESSION['tipo_usuario'] == "v" )  {
					          // USUARIO VENDEDOR
						      for ( $i=0; $i < count($cajas_locales); $i++ )
						      {
						           // Busco solamente el local del usuario VENDEDOR.
							       if ( $cajas_locales[$i]['id'] == $_SESSION['id_local'] )  {
							          $id_local = $cajas_locales[$i]['id'];                 // id del local en cuestión.
							          $nombre_local = stripslashes($cajas_locales[$i]['nombre_local']);   // Nombre del local en cuestión.
								      $tipo_local = $cajas_locales[$i]['tipo_local'];       // Tipo de local en cuestión.
							          $tipo_caja = "Caja";
							       
								   } else { continue; }
								  								  
							   }
							   echo "<option value=\"".$id_local."\">".$tipo_caja." ".$nombre_local." &nbsp;(".$tipo_local.") </option>";	
						  } else if ( $_SESSION['tipo_usuario'] == "a" ) {
						        // USUARIO ADMINISTRADOR.
						        for ( $i=0; $i < count($cajas_locales); $i++ )
						        {
								    switch($cajas_locales[$i]['id'])
							        {
								        // Esto es para poner el nombre de Caja Central Ó Caja.
								        case "1":
								            $tipo_caja = "Caja Central";
								        break;
								        default:
								            $tipo_caja = "Caja";
								        break;
								
									}
									echo "<option value=\"".$cajas_locales[$i]['id']."\">".$tipo_caja." ".$cajas_locales[$i]['nombre_local']." &nbsp;(".$cajas_locales[$i]['tipo_local'].") </option>";	
								} // Fin del for
						        					  				   
						   } // Fin del if ( $_SESSION['tipo_usuario'] == "v" )  {
						 
					   } // Fin del if ( $cajas_locales != "null" )  {   
				       
				   ?>        
                           <option value="otros"> Otros </option>                     
                        </select>
                   
                        <!-- ESTE ES EL NOMBRE DE LA CAJA DEL LOCAL QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="nombre_caja_local_origen" value=""  />
                   
                   </td>           
                </tr>   
                             
                 <!-- FILA 6 -->
                 <tr>  
                   <td> Destino </td>
                   <td> <select name="destino_transaccion" class="text_form" id="destino_transaccion" style="width: 99%; padding-right:2px; padding-left:2px;">                           
                                <option value="seleccione"> Seleccione </option>    
                   <?php        
                       if ( $mov_locales != "null" )  {    
						  // Si $mov_locales == null significa que no se ha introducido ningún local.     
						  for ( $i=0; $i < count($cajas_locales); $i++ )
						  {
						     switch($cajas_locales[$i]['id'])
							 {
								   // Esto es para poner el nombre de Caja Central Ó Caja.
								   case "1":
								      $tipo_caja = "Caja Central";
								   break;
								   default:
								      $tipo_caja = "Caja";
								   break;
								     
							 }
							 echo "<option value=\"".$cajas_locales[$i]['id']."\">".$tipo_caja." ".$cajas_locales[$i]['nombre_local']." &nbsp;(".$cajas_locales[$i]['tipo_local'].") </option>";	
						  }
					   }
				   ?>    
                   <?php         
                       if ( $_SESSION['tipo_usuario'] == "a" )  { 
				           // ESTO VA DIRECTO AL REGISTRO BANCARIO.
				   ?>    
                           <option value="banco"> Registro Bancario </option>
                   <?php
					   }
				   ?>	   
                           <option value="otros"> Otros </option>  
                        
                        </select>
                   
                        <!-- ESTE ES EL NOMBRE DE LA CAJA DEL LOCAL QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="nombre_caja_local_destino" value=""  />
                               
                   </td>           
                </tr>
                
                <!-- FILA 7 -->
                <tr>
                  <td> Cantidad ( S&oacute;lo n&uacute;mero ) </td>
                  <td> <input class="text_form" type="text" name="cantidad_transaccion" value="" maxlength="20" style="width: 70px;" placeholder="Cantidad" /> </td>
                </tr>
                  
            </table> 
   
             <!--*******************************************************************************************
                                 div QUE MUESTRA LA CANTIDAD DE DINERO EN LA CAJA SELECCIONADA 
                 *******************************************************************************************---> 
              <div style="position: absolute; top: 40px; left: 470px; height:30px; width:250px; padding-top:10px;">    
                 <label style="float: left;"> Saldo en Caja  </label> 
                 <input class="text_form" type="text" name="saldo_en_caja" value="" maxlength="10" style="width: 70px; float:left; margin-left:16px; margin-top:-7px;" disabled="disabled" />              
                 
                 <!-- AQUÍ GUARDO EL VALOR DEL SALDO DE DINERO EN LA CAJA PUES ARRIBA ESTÁ DESABILITADO -->
                 <input type="hidden" name="saldo_en_caja_hidden" value=""  />
              
              </div>
                              
             <!-- ********************************************************************************************
                 DIV DEL CARGANDO QUE SE MUESTRA CUANDO VOY A CARGAR EL SALDO DE LA CAJA ORIGEN (ajax)
              ******************************************************************************************* --> 
       <div id="cargando_saldo" style="display:none; float:right; margin:10px 20px 10px 0;">
           <center>
               <img src='images/ajax-loader.gif' border='0' />
           </center>
       </div> 
            
      <!-- ********************************************************************************************
                 DIV DE "PROBLEMA EN EL SERVIDOR" CUANDO DÁ UN ERROR DE CONEXIÓN   (ajax)
             ******************************************************************************************* --> 
       <div id="server_error_saldo" style="display:none; float:right; margin:10px 20px 10px 0;">
           
               <img src='images/ajax-loader.gif' border='0' style="vertical-align: middle;;" /> 
               <span class="ajax_error_box">Problema en el servidor. Intente m&aacute;s tarde. Gracias </span>
           
       </div> 
              
            <!-- CONTENEDOR <div> OBSERVACIONES  -->
              <div style="margin-top: 10px; min-width:670px; min-height:80px; float:left; padding:0px;">
              <fieldset class="fieldset_form">   
                <legend> Observaciones </legend> 
                
                <textarea name="observaciones_transaccion" class="textarea_form" style="width:100%;"></textarea>              
                
              </fieldset>
             </div>    
                         
         <br style="line-height:100px;"/>         
              
              <!--  <div> CON LOS BOTONES DE SUBMIT Y RESET  -->
         <div style="min-height:40px; float:left; min-width:650px;">
           <p>
           <input type="submit" value="Guardar" style="float:right; margin:15px 0px 5px 0; padding:3px 7px;" onclick="return send_transaccion();" />
           <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;"  />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
                       
           </fieldset>
         </form>   
       </div>   <!-- Fin del <div> id="ingreso_caja" -->
      
         <!---------------**********************************  VISTA2 **************************+*************---------------->
 
<?php
	 } else if ( isset($_GET['optioncaja']) && $_GET['optioncaja'] == "actual" )    {
	    // Esto es cuando le doy al botón CAJAS DE HOY DE LA BARRA DE BOTONES.

        $almacenes = show_almacenes($_SESSION['tipo_usuario']);  // Aquí recibo los nombres de los almacenes que hay en la Base de Datos.
		                                                         // ESTA FUNCIÓN ES DEL MÓDULO VENTAS.
			
		if ( isset($_GET['optioncaja']) && $_GET['optioncaja'] == "actual" )  {
		     // Esto es para que se me muestre la Caja de HOY del local seleccionado.
			 if ( isset($_POST['select_local']) )  {
			     $show_pendientes = show_ingresos_de_caja_pendientes($_POST['select_local']);  // Muestra transacciones pendientes de entrada en la caja.
	             $transacciones_caja = show_transacciones_caja($_POST['select_local']); // Muestra transacciones que han habido en la caja el día de HOY.
	             $resumen_caja = show_resumen_caja($_POST['select_local']);     // Muestra lo relacionado con los datos del RESUMEN DE CAJA DEL DÍA.
                 $moneda_informes = charge_moneda(); // Cargo la moneda de los informes.
			 }
		}
?>         
        <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
  
<?php
            if ( isset($_GET['optioncaja']) && $_GET['optioncaja'] == "actual" && isset($_POST['select_local']) )  {
		        // PARTE 1: IMPRIMIR LA CAJA DE ALGÚN ALMACÉN. 
                // Busco el nombre del LOCAL de acuerdo al id DEL LOCAL DE LA CONSULTA.
                for ( $i=0; $i < count($almacenes); $i++ )
		        {
			        if ( $_POST['select_local'] == $almacenes[$i]['id'] )  {
				        // VERIFICO SI ESTÁ SELECCIONADO ALGUN ALMACÉN PARA HACER LA VENTA MEDIANTE $_GET['localid'].  
				        $nombre_almacen = $almacenes[$i]['nombre_local'];			  
			        } else {
				        continue;  
			        }
						   	
		        } // Fin del for
?>		
		        <!-- Botón de IMPRIMIR -->  
                <div class="cabecera_botton">
                 <a title="Imprimir reporte de Caja Actual." href="index.php?mod=mod_imprimir&caj=1&view=sec&id=<?php echo $_POST['select_local']; ?>&name=<?php echo $nombre_almacen; ?>" target="_blank">
                   <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
                   <br>
                   Imprimir
                 </a>
                </div> 
<?php			
		    } // Fin del if ( isset($_GET['optioncaja']).... )		
?>		  
		          
         <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Caja" href="javascript:void(0)" onclick="inicio_caja_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
                    
     <!-- *******************************************************************************************
               1. FORMULARIO DE ENTRADA DE DATOS PARA VER LA CAJA DEL ALAMCÉN SELECCIONADO
            *********************************************************************************************  --> 
       <div class="include_form">
       
         <form action="" method="post" name="form_reporte_proveedor_compra">
           <fieldset class="fieldset_form">   
            <legend> Seleccione el Almac&eacute;n </legend>
            
            <!--  PRIMER <div> PARA LOS DATOS A INTRODUCIR  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; ver los datos de la Caja en un Almac&eacute;n seleccionado. Por favor introduzca los datos. GRACIAS. </span>
            <div class="inline_line" style="min-width:500px; margin-top:5px; margin-right:5px; min-height:100px;">
                             
<?php                
            if ( $_SESSION['tipo_usuario'] == "a" )  {   
?>	            
               <span class="intro_modulos" style="float: left; margin:10px 8px 0 10px; font-size:1.0em;"> Seleccione el almac&eacute;n </span>
                 <select name="select_local" class="text_form" id="select_local_para_venta" style="margin-top: 10px; width: 36%; padding-right:2px; padding-left:2px;">                          <option value="seleccione"> Seleccione </option>    
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
		    } 
?>               
         <!--  <div> CON LOS BOTONES DE SUBMIT -->
         <div style="min-height:40px; float:left; min-width:450px;">
           <p>
             <input type="submit" value="Ver Caja" style="float:right; margin:15px 0px 5px 50px; padding:2px 4px;" onclick="return send_reporte_caja_almacen_hoy();" />
                          
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form"  -->  
           
<?php      
       if ( isset($_POST['select_local']) )  {  
           // Verifico que la consulta se haya hecho a través del <select> del formulario.  
         
		 if ( isset($_GET['ttype']))  {
		 
		     if ( $_GET['ttype'] == "ok" )   {
			 //CASO 1. Esto significa que se insertaron bien las transacciones en la BD.
?>        
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> Transacciones introducidas correctamente en la BD </div>
<?php 
			 } else if ( $_GET['ttype'] != "ok" )   {
			 //CASO 2. Esto significa que se agregaron transacciones pendientes en la BD.
                 switch($_GET['ttype'])
				 {
				    case "1":
					   // A) Se ha seleccionado una transacción PENDIENTE para introducir en la BD.
					   $message = "Introducida 1 transacci&oacute;n ";
					break;
					default:
					   // B) Se han introducido más de 1 transacción PENDIENTE para introducir en la BD. 
					   $message = "Introducidas ".$_GET['ttype']." transacciones ";
					break;
				 }
?>        
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> <?php echo $message ?> correctamente en la BD </div>
<?php
   	         }   // Fin del if ( $_GET['ttype'] ==  .... )
		 }  // Fin del if ( isset($_GET['ttype']))
?>     

         <!-- *******************************************************************************************
                          MUESTRO EL EFECTIVO PENDIENTE DE ENTRADA A LA CAJA DE ESE ALMACÉN
             *********************************************************************************************  -->  
<?php        
        if ( isset($show_pendientes))  {
		 
		     if ( $show_pendientes == "null" )   {
			 //CASO 1. Esto significa que en el local seleccionado no hay ningun EFECTIVO pendiente de ENTRADA EN CAJA.
             
			     // NO PASA NADA 

			 } else {
             // CASO 2. Esto signfica que en el Local Seleccionado hay EFECTIVO pendiente de ENTRADA -> MUESTRO LA TABLA  <-. 

?>          
        <!-- *******************************************************************************************
                          MUESTRO LA TABLA CON LOS DATOS DEL EFECTIVO PENDIENTE DE ENTRADA 
             *********************************************************************************************  -->  
             
         <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
        <div style="width:100%; margin:15px 0px 10px 0px;; background-color:#999; padding:3px; border-radius:5px 5px;" id="show_pendientes">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="6"> TABLA DE INGRESOS PENDIENTES DE ENTRADA A LA CAJA DEL LOCAL </th>
           </tr>
           <tr >
              <th style="width: 3%; font-size: 0.9em; min-width: 24px;"> # </th>
              <th style="width: 5%; font-size: 0.9em; min-width: 30px;"> Entrada </th>
              <th style="width: 6%; font-size: 0.9em; min-width:40px;"> FECHA </th>
              <th style="width: 35%; font-size: 0.9em; min-width:73px;"> PROVEEDOR DEL INGRESO DE CAJA </th>
              <th style="width: 45%; font-size: 0.9em; min-width:80px;"> OBSERVACIONES </th>
              <th style="width: 6%; font-size: 0.9em; min-width:40px;"> CANTIDAD </th>
           </tr>
         </table> 
       
        <form name="efectivo_pendientes_entrada" action="" method="post"  >
         <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($show_pendientes); $i++ )
	    {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			   echo "<td style=\"width: 3%; min-width: 24px; \">".($i+1)."</td>"; 
			   echo "<td style=\"width: 5%; min-width: 30px; \"> <input type=\"checkbox\" name=\"id_pendiente".$show_pendientes[$i]['id']."\" value=\"on\"  </td>";
			   echo "<td style=\"width: 6%; min-width:40px; \">".stripslashes($show_pendientes[$i]['fecha_transaccion'])."</td>";
			   echo "<td style=\"width: 35%; text-align: left; font-size: 0.9em; min-width:73px; \" >".stripslashes($show_pendientes[$i]['nombre_caja_local_origen'])."</td>";
			   echo "<td style=\"width: 45%; text-align: left; font-size: 0.9em; min-width:80px;  \">".stripslashes($show_pendientes[$i]['observaciones_transaccion'])."</td>"; 
			   echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($show_pendientes[$i]['cantidad_transaccion'])."</td>";
            echo "</tr>";

   	    }
?>
<!-- id del local para poder hacer las ENTRADAS en la TABLA CORRESPONDIENTE  -->
<input type="hidden" name="id_local_stock" value="<?php echo $_POST['select_local']; ?>"  />

<?php
            echo "<tr>";
		       echo "<td style=\"width: 100%; text-align: center; font-size: 0.9em; padding-left: 30px;\" colspan=\"10\"> <input type=\"submit\" value=\"A&ntilde;adir\" style=\"width:70px;\" onclick=\"return add_efectivo_pendiente();\" /> </td>";
		    echo "</tr>";
?>         
        </table>
       </form>     
      </div>  <!-- Fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
  
<?php
   	     }  // Fin del if ( $show_pendientes == "null" )   {
	 }  // Fin del if ( isset($show_pendientes))  {
?>        
      <!--***********************************************************************************************************************
                                            TABLA CON LOS DATOS DE LA CAJA EN ESE DÍA 
      *************************************************************************************************************************++ -->
   <table class="vista_caja" style="margin-bottom: 15px;" cellspacing="0" cellpadding="0">
          
      <?php
         // Busco el nombre del LOCAL de acuerdo al id DEL LOCAL DE LA CONSULTA.
         for ( $i=0; $i < count($almacenes); $i++ )
		 {
			  if ( $_POST['select_local'] == $almacenes[$i]['id'] )  {
				  // VERIFICO SI ESTÁ SELECCIONADO ALGUN ALMACÉN PARA HACER LA VENTA MEDIANTE $_GET['localid'].  
				   $nombre_almacen = $almacenes[$i]['nombre_local'];			  
			  } else {
				  continue;  
			  }
						   	
		 } // Fin del for
	  ?>
      <tr >
         <th style="width:100%; color:#5D5D5D; background-color:#F2F2F2; padding:5px 0px;" colspan="100"> RESUMEN <?php echo "CAJA ALMAC&Eacute;N ".$nombre_almacen ;  ?> D&Iacute;A <?php echo $fecha; ?> </th>
      </tr>
      <tr>    
         <td style="color:#5D5D5D; background-color:#F2F2F2; padding:5px 0px;">&nbsp;   </td>
         <td style="color:#5D5D5D; background-color:#F2F2F2; padding:5px 0px;"> CANTIDAD </td>
         <td style="color:#5D5D5D; background-color:#F2F2F2; padding:5px 0px;"> <?php echo stripslashes($moneda_informes['moneda_informes']); ?> </td>
      </tr>
    	  
	  <?php
         $tipo_accion = "VENTAS TOTALES"; 
		 $num_tipo_accion = stripslashes($resumen_caja['num_ventas_totales']);
		 $efectivo_tipo_accion = stripslashes($resumen_caja['efectivo_ventas_totales']);
	  ?>
	  
      <tr>    
         <td style="width: 40%;color: white; background-color:#056AA8;"> <?php echo $tipo_accion; ?>  </td>
         <td style="width: 25%; color:#066AA8;"> <?php echo $num_tipo_accion; ?>  </td>
         <td style="width: 35%; color:#066AA8;"> <?php echo $efectivo_tipo_accion; ?>  </td>
      </tr>
    
     <tr>    
         <td style="color: white; background-color:#056AA8;"> RETIROS  </td>
         <td> <?php echo stripslashes($resumen_caja['num_retiros']); ?>  </td>
         <td> <?php echo stripslashes($resumen_caja['efectivo_retiros']); ?>  </td>
      </tr>
    
     <tr>    
         <td style="color: white; background-color:#056AA8;"> INGRESOS  </td>
         <td> <?php echo stripslashes($resumen_caja['num_ingresos']); ?>  </td>
         <td> <?php echo stripslashes($resumen_caja['efectivo_ingresos']); ?>  </td>
     </tr>
     
     <?php
        // BUSCO EL SALDO DE LA CAJA ANTERIOR ( DEL DÍA ANTERIOR ) 
		$total_caja_right_now = stripslashes($resumen_caja['total_caja']);
		$ingresos_right_now   = stripslashes($resumen_caja['efectivo_ingresos']); 
		$retiros_right_now    = stripslashes($resumen_caja['efectivo_retiros']);
		
		settype($total_caja_right_now, "float");
		settype($ingresos_right_now, "float");
		settype($retiros_right_now, "float"); 
		
		$saldo_caja_anterior = $total_caja_right_now - ( $ingresos_right_now - $retiros_right_now ) ;              
		 
      ?>    
     
     <tr>    
         <td style="color: white; background-color:#056AA8;"> CAJA ANTERIOR </td>
         <td>&nbsp;    </td>
         <td> <?php echo $saldo_caja_anterior; ?>  </td>
     </tr>
     
     <tr>    
         <td style="color: white; background-color:#056AA8;"> TOTAL CAJA  </td>
         <td>&nbsp;  </td>
         <td> <?php echo stripslashes($resumen_caja['total_caja']); ?> </td>
      </tr>
    
    </table>
     
           <!-- *************************************************************************************************************
                             MENSAJE DE CUANDO NO SE HA INTRODUCIDO NINGUNA TRANSACCIÓN EN LA CAJA EL DÍA ACTUAL
            ****************************************************************************************************************  --> 
<?php
     if ( $resumen_caja['existe'] == "null" )  {
?>		 
         <div class="message_wrong" style="margin-top:0px;"> No existen TRANSACCIONES EN LA CAJA el d&iacute;a de HOY </div> 
<?php	 
	 }  else  {    // Fin del  if ( $transacciones_caja == "null" )  {
?>       
     
             <!-- ********************************************************************************************
                       TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY 
                  ******************************************************************************************* -->
        
        <div style="width:100%;">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="11"> CAJA </th>
           </tr>
           <tr >
              <th style="width: 4%; font-size: 0.9em; min-width: 24px;"> # </th>
              <th style="width: 13%; font-size: 0.9em; min-width: 60px;"> TIPO TRANSACCI&Oacute;N </th>
              <th style="width: 17%; font-size: 0.9em; min-width:90px;"> ORIGEN </th>
              <th style="width: 17%; font-size: 0.9em; min-width:90px;"> DESTINO </th>
              <th style="width: 18%; font-size: 0.9em; min-width:90px;"> OBSERVACIONES </th>
              <th style="width: 8%; font-size: 0.9em; min-width:80px;"> 
                  <?php
			         // Este campo depende de si el usuario es 'administrador' o 'vendedor'
			         echo "No. VENTA";
				  ?>   
              </th>
              <th style="width: 15%; font-size: 0.9em; min-width:80px;"> USUARIO </th>
              <th style="width: 8%; font-size: 0.9em; min-width:60px;"> CANTIDAD </th>
            <!--  <th style="width: 6%; font-size: 0.9em; min-width:40px;"> SALDO </th> -->
             
           </tr>
         </table> 
       
        <form name="caja_diaria" action="" method="post"  >
         <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($transacciones_caja); $i++ )
		 {
			//03 MUESTRO LA TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY 
            echo "<tr>";
			   
			  echo "<td style=\"width: 4%; min-width: 24px;\">".($i+1)." <input type=\"hidden\" name=\"caja_id\" value=\"".$transacciones_caja[$i]['id']."\" /> </td>"; 
			  echo "<td style=\"width: 13%; font-size: 0.9em; min-width:60px; \"> ".$transacciones_caja[$i]['tipo_transaccion']."</td>"; 
			  echo "<td style=\"width: 17%; text-align: justify; font-size: 0.9em; min-width:90px; \" >".$transacciones_caja[$i]['origen_transaccion']."</td>";
		      echo "<td style=\"width: 17%; text-align: justify; font-size: 0.9em; min-width:90px; \" >".$transacciones_caja[$i]['destino_transaccion']."</td>";
			  echo "<td style=\"width: 18%; text-align: justify; font-size: 0.9em; min-width:90px; \" >".stripslashes($transacciones_caja[$i]['observaciones'])."</td>";
			 
			  $tipo_trans = $transacciones_caja[$i]['no_venta'];
			  if ( $tipo_trans == 0 )  {
				  $tipo_trans = "";
			  }
				 			 
			  echo "<td style=\"width: 8%; font-size: 0.9em; min-width:80px;  \">".$tipo_trans."</td>";
		      echo "<td style=\"width: 15%; text-align: center; font-size: 0.9em; min-width:80px;  \">".stripslashes($transacciones_caja[$i]['persona_q_hace_transaccion'])."</td>";
		      switch($transacciones_caja[$i]['tipo_transaccion'])
			  {
				  // Si es un Retiro de Caja pongo la cantidad en rojo.
				  case "Ingreso de Caja":
				       $color = "#464646;";  
				  break;
				  case "Retiro de Caja":
				       $color = "#D40000;";  
				  break;
			  } 
			  	  
			  echo "<td style=\"width:8%; text-align:center; font-size: 0.9em; min-width:60px; color:".$color."\">".stripslashes($transacciones_caja[$i]['cantidad_transaccion'])."</td>";
			  //echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".$transacciones_caja[$i]['saldo']."</td>";
			
		    echo "</tr>";
		 }
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de la TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY -->
<?php	 
	 }  // Fin del  if ( $transacciones_caja == "null" )  {
   }    // Fin del if ( isset($_POST['select_local']) )  {    
?>          
       
        <!---------------**********************************  VISTA3 **************************+*************---------------->
<?php
	 } else if ( isset($_GET['optioncaja']) && $_GET['optioncaja'] == "otras_cajas" )    {
	    // Esto es cuando le doy al botón RETIRO DE CAJA DE LA BARRA DE BOTONES.

        $mov_locales = show_locales();   // Esta función es del módulo inventarios....
			
		if ( isset($_GET['cajant']) && $_GET['cajant'] == "ver" )  {
		     // Esto es para que se me muestre la Caja Anterior del local seleccionado.
			 $show_pendientes = show_ingresos_de_caja_pendientes_reporte();  // Muestra las transacciones pendientes de entrada en la caja. 	 
		     $cajant = process_caja_anterior();   // Este me dá los detalles de las transacciones entre 2 fechas seleccionadas.
			 $data_cajaant = search_data_caja_anterior (); // Esto me dá el resumen de los datos de la consulta de arriba.
		}
?>    
          
     <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
        
<?php                  
      if ( isset($_GET['cajant']) && $_GET['cajant'] == "ver" )  {
?>		  
		 <!-- Botón de IMPRIMIR -->  
         <div class="cabecera_botton">
            <a title="Imprimir reporte de Cajas Anteriores." href="index.php?mod=mod_imprimir&caj=2&id=<?php echo $_POST['local_caja_anterior']; ?>&fi=<?php echo $_POST['fecha_inicial'];  ?>&ff=<?php echo $_POST['fecha_final']; ?>&name=<?php echo $_POST['nombre_local_caja_anterior']; ?>" target="_blank">
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
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Caja" href="javascript:void(0)" onclick="inicio_caja_button();">
              <img width="32" border="0" height="32" alt="Botón Nuevo" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
     
         <!-- *******************************************************************************************
               1. FORMULARIO DE ENTRADA/EDICIÓN DE DATOS PARA VER EL KARDEX DE UN ARTÍCULO SELECCIONADO
            *********************************************************************************************  --> 
            
       <div class="include_form" id="cajas_anteriores">
       
         <form action="" method="post" name="form_cajas_anteriores">
           <fieldset class="fieldset_form">   
            <legend>Cajas Anteriores</legend>
            
            <!--  PRIMER <div> PARA LOS DATOS A INTRODUCIR  -->
            
           <span style="float: left;"> &nbsp; &nbsp; Estimado usuario usted en esta pesta&ntilde;a podr&aacute; ver las Cajas de d&iacute;as anteriores  registradas en su negocio. Por favor incluya los datos en el formulario para ver el reporte. GRACIAS</span>
            
            <div class="inline_line" style="min-width:700px; margin-top:20px; margin-right:5px;">
               <table class="table_fieldset" style="width:450px;">    
                 
                 <!-- FILA 1 -->
                 <tr>
                   <td style="width:40%;"> Fecha inicial </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_inicio_ant" name="fecha_inicial" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                 
                 <!-- FILA 2 -->
                 <tr>
                   <td style="width:40%;"> Fecha final </td>
                   <td style="width:60%;"> <input class="text_form" type="text" id="fecha_final_ant" name="fecha_final" value="" maxlength="11" style="width: 70px; margin-bottom:5px;" placeholder="Fecha" /> </td>
                 </tr>
                                  
                 <!-- FILA 3 -->
                 <tr>  
                   <td> Seleccione Local </td>
                   <td> <select name="local_caja_anterior" class="text_form" id="local_caja_anterior" style="width: 70%; padding-right:2px; padding-left:2px;">                       <option value="seleccione"> Seleccione </option>    
                   
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
						          echo "<option value=\"".$mov_locales[$i]['id']."\"> ".$mov_locales[$i]['nombre_local']." &nbsp;(".$mov_locales[$i]['tipo_local'].") </option>";	
						     }
					      }
				      }
				   ?>        
                        </select>
                   
                        <!-- ESTE ES EL NOMBRE DEL LOCAL QUE GUARDO EN LA BD (El valor se obtiene mediante JavaScript) -->
                        <input type="hidden" name="nombre_local_caja_anterior" value=""  />
                   
                   </td>           
                </tr>   
                      
            </table> 
                        
         <!--  <div> CON LOS BOTONES DE SUBMIT Y RESET  -->
         <div style="min-height:40px; float:left; min-width:180px; margin-top:10px;">
           <p>
           <input type="submit" value="Ver Caja" style="float:right; margin:15px 0px 5px 0; padding:3px 7px;" onclick="return send_caja_anterior();" />
           <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;"  />
           </p> 
         </div>  <!-- fin del div class="inline_line"   -->
                            
        </div>  <!-- fin del div class="inline_line"   -->
 
        </fieldset>
       </form>
      </div>  <!-- FIN DEL div class="include_form" id="cajas_anteriores"  -->
         
<?php
    if ( isset($cajant))  {
		// ESTO SIGNIFICA QUE SE ENVIARON LOS DATOS DE LA CONSULTA DEL FORMULARIO.
			
		if ( $cajant == "null" )   {
			 //CASO 1. Esto significa que en el local seleccionado para ver la CAJA entre los días seleccionados no existe ningun registro.
?> 
         <!--***********************************************************************************************************************
                                            TABLA CON LOS DATOS DE LA CAJA ENTRE LOS DÍAS SELECCIONADOS 
      *************************************************************************************************************************++ -->
        
    <table class="vista_caja" style="margin-bottom: 15px;" cellspacing="0" cellpadding="0">
      
      <?php
         switch($_POST['local_caja_anterior'])  // Esto es para poner "CAJA CENTRAL" ó "CAJA ALMACÉN"
		 {
		   	case "1":
			   $nombre_caja = "CAJA CENTRAL";
			break;
			default:
			   $nombre_caja = "CAJA ALMAC&Eacute;N"; 
			break; 
		 }
      ?>
      
      <tr >
         <th style="width:100%; color:gray; background-color:#F2F2F2; padding:5px 0px;" colspan="100">RESUMEN <?php echo $nombre_caja; ?> <?php echo $_POST['nombre_local_caja_anterior']; ?> </th>
      </tr>
      
      <?php
         switch($_POST['local_caja_anterior'])  // Esto es para poner "VENTAS TOTALES" ó "TOTAL DE COMPRAS"
		 {
		   	case "1":  // CASO ADMINISTRADOR. 
			   $tipo_accion = "TOTAL COMPRAS";
			break;
			default:  // CASO VENDEDOR.
			   $tipo_accion = "VENTAS TOTALES"; 
			break; 
		 }
      ?>
	  
      <!-- FILA 1 -->      
      <tr>    
         <td style="color: white; background-color:#056AA8;"> FECHA INICIAL  </td>
         <td style="border-right:1px solid #F7F7F7;">&nbsp;  </td>
         <td> <?php echo $_POST['fecha_inicial']; ?> </td>
      </tr>
      <!-- FILA 2 -->
      <tr>    
         <td style="color: white; background-color:#056AA8;"> FECHA FINAL  </td>
         <td style="border-right:1px solid #F7F7F7;">&nbsp;  </td>
         <td> <?php echo $_POST['fecha_final']; ?> </td>
      </tr>
      <!-- FILA 3 -->
      <tr>    
         <td style="width: 40%; color: white; background-color:#056AA8;"> <?php echo $tipo_accion; ?>  </td>
         <td style="width: 25%; border-right:1px solid #F7F7F7;"> 0 </td>
         <td style="width: 35%;"> 0 </td>
      </tr>
     <!-- FILA 4 -->
     <tr>    
         <td style="color: white; background-color:#056AA8;"> RETIROS  </td>
         <td> 0  </td>
         <td> 0  </td>
      </tr>
     <!-- FILA 5 -->
     <tr>    
         <td style="color: white; background-color:#056AA8;"> INGRESOS  </td>
         <td> 0 </td>
         <td> 0  </td>
     </tr>
        
    </table>
              
    <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> No existe ning&uacute;na transacci&oacute;n de Caja en el Local <?php echo $_POST['nombre_local_caja_anterior']; ?> para los d&iacute;as seleccionados. </div>
                 
<?php
	
	} else if ( $cajant == "error" )   {
	    //CASO 2. Esto significa que se ha escrito en la barra de direcciones del navegador sin enviar las var. $_POST
?>        
        <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Error de Env&iacute;o de Datos</div>
<?php
	
	} else  {
			 //CASO 3. Esto significa que TODO ESTÁ BIEN Y VOY A MOSTRAR LOS DATOS
?>          
      <!--***********************************************************************************************************************
                                            TABLA CON LOS DATOS DE LA CAJA ENTRE LOS DÍAS SELECCIONADOS 
      *************************************************************************************************************************++ -->
   <table class="vista_caja" style="margin-bottom: 15px;" cellspacing="0" cellpadding="0">
      
      <?php
         switch($_POST['local_caja_anterior'])  // Esto es para poner "CAJA CENTRAL" ó "CAJA ALMACÉN"
		 {
		   	case "1":
			   $nombre_caja = "CAJA CENTRAL";
			break;
			default:
			   $nombre_caja = "CAJA ALMAC&Eacute;N"; 
			break; 
		 }
      ?>
      
      <tr >
         <th style="width:100%; color:gray; background-color:#F2F2F2; padding:5px 0px;" colspan="100">RESUMEN <?php echo $nombre_caja; ?> <?php echo $_POST['nombre_local_caja_anterior']; ?> </th>
      </tr>
      
      <?php
         switch($_POST['local_caja_anterior'])  // Esto es para poner "VENTAS TOTALES" ó "TOTAL DE COMPRAS"
		 {
		   	case "1":  // CASO ADMINISTRADOR. 
			   $tipo_accion = "TOTAL COMPRAS";
			   $num_tipo_accion = stripslashes($data_cajaant['num_compras_totales']);
			   $efectivo_tipo_accion = stripslashes($data_cajaant['efectivo_compras_totales']);
			break;
			default:  // CASO VENDEDOR.
			   $tipo_accion = "VENTAS TOTALES"; 
			   $num_tipo_accion = stripslashes($data_cajaant['num_ventas_totales']);
			   $efectivo_tipo_accion = stripslashes($data_cajaant['efectivo_ventas_totales']);
			break; 
		 }
      ?>
	  
      <!-- FILA 1 -->      
      <tr>    
         <td style="color: white; background-color:#056AA8;"> FECHA INICIAL  </td>
         <td style="border-right:1px solid #F7F7F7;">&nbsp;  </td>
         <td> <?php echo $_POST['fecha_inicial']; ?> </td>
      </tr>
      <!-- FILA 2 -->
      <tr>    
         <td style="color: white; background-color:#056AA8;"> FECHA FINAL  </td>
         <td style="border-right:1px solid #F7F7F7;">&nbsp;  </td>
         <td> <?php echo $_POST['fecha_final']; ?> </td>
      </tr>
      <!-- FILA 3 -->
      <tr>    
         <td style="width: 40%; color: white; background-color:#056AA8;"> <?php echo $tipo_accion; ?>  </td>
         <td style="width: 25%; border-right:1px solid #F7F7F7;"> <?php echo $num_tipo_accion; ?>  </td>
         <td style="width: 35%;"> <?php echo $efectivo_tipo_accion; ?>  </td>
      </tr>
     <!-- FILA 4 -->
     <tr>    
         <td style="color: white; background-color:#056AA8;"> RETIROS  </td>
         <td> <?php echo stripslashes($data_cajaant['num_retiros']); ?>  </td>
         <td> <?php echo stripslashes($data_cajaant['efectivo_retiros']); ?>  </td>
      </tr>
     <!-- FILA 5 -->
     <tr>    
         <td style="color: white; background-color:#056AA8;"> INGRESOS  </td>
         <td> <?php echo stripslashes($data_cajaant['num_ingresos']); ?>  </td>
         <td> <?php echo stripslashes($data_cajaant['efectivo_ingresos']); ?>  </td>
     </tr>
        
    </table>
       
   <!-- ********************************************************************************************************************
                       TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA DE LOS DÍAS SELECCIONADOS
          ******************************************************************************************^*********************** -->
        
        <div style="width:100%;">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
             <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE CAJAS ANTERIORES </th>
           </tr> 
           <tr >
              <th style="width: 4%; font-size: 0.9em; min-width: 24px;"> # </th>
              <th style="width: 6%; font-size: 0.9em; min-width: 40px;"> FECHA </th>
              <th style="width: 11%; font-size: 0.9em; min-width: 60px;"> TIPO TRANSACCI&Oacute;N </th>
              <th style="width: 18%; font-size: 0.9em; min-width:80px;"> ORIGEN </th>
              <th style="width: 18%; font-size: 0.9em; min-width:80px;"> DESTINO </th>
              <th style="width: 18%; font-size: 0.9em; min-width:80px;"> OBSERVACIONES </th>
              <th style="width: 6%; font-size: 0.9em; min-width:80px;"> 
                  <?php
			         // Este campo depende de si el usuario es 'administrador' o 'vendedor'
			         switch($_POST['local_caja_anterior'])
					 {
						case "1":   // administrador
					         echo "No. COMPRA";
					    break;
						default:   // vendedor
						     echo "No. VENTA";
						break;
					 }
			      ?>   
              </th>
              <th style="width: 13%; font-size: 0.9em; min-width:80px;"> USUARIO </th>
              <th style="width: 6%; font-size: 0.9em; min-width:60px;"> CANTIDAD </th>
            <!--  <th style="width: 6%; font-size: 0.9em; min-width:40px;"> SALDO </th> -->
             
           </tr>
         </table> 
       
        <form name="caja_diaria" action="" method="post"  >
         <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($cajant); $i++ )
		{
			//03 MUESTRO LA TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY 
            echo "<tr>";
			   
			  echo "<td style=\"width: 4%; min-width: 24px;\">".($i+1)." <input type=\"hidden\" name=\"caja_id\" value=\"".$cajant[$i]['id']."\" /> </td>"; 
			  echo "<td style=\"width: 6%; font-size: 0.9em; min-width:40px; \"> ".stripslashes($cajant[$i]['fecha_transaccion'])."</td>"; 
			  echo "<td style=\"width: 11%; font-size: 0.9em; min-width:60px; \"> ".stripslashes($cajant[$i]['tipo_transaccion'])."</td>"; 
			  echo "<td style=\"width: 18%; text-align: justify; font-size: 0.9em; min-width:80px; \" >".stripslashes($cajant[$i]['origen_transaccion'])."</td>";
		      echo "<td style=\"width: 18%; text-align: justify; font-size: 0.9em; min-width:80px; \" >".stripslashes($cajant[$i]['destino_transaccion'])."</td>";
			  echo "<td style=\"width: 18%; text-align: justify; font-size: 0.9em; min-width:80px; \" >".stripslashes($cajant[$i]['observaciones'])."</td>";
			 
			  // Este campo depende de si el usuario es 'administrador' o 'vendedor'
			  switch($_POST['local_caja_anterior'])
			  {
				 case "1":   // administrador
				     $tipo_trans = $cajant[$i]['no_orden_de_compra'];
				     if ( $tipo_trans == 0 ||$tipo_trans == "null" )  {
						 $tipo_trans = "";
					 }
				 break;
				 default:   // vendedor
				     $tipo_trans = $cajant[$i]['no_venta'];
				     if ( $tipo_trans == 0||$tipo_trans == "null" )  {
						 $tipo_trans = "";
					 }
				 break;
			  }   
			 
			  echo "<td style=\"width: 6%; font-size: 0.9em; min-width:80px;  \">".$tipo_trans."</td>";
		      echo "<td style=\"width: 13%; text-align: center; font-size: 0.9em; min-width:80px;  \">".stripslashes($cajant[$i]['persona_q_hace_transaccion'])."</td>";
		      switch($cajant[$i]['tipo_transaccion'])
			  {
				  // Si es un Retiro de Caja pongo la cantidad en rojo.
				  case "Ingreso de Caja":
				       $color = "#464646;";  
				  break;
				  case "Retiro de Caja":
				       $color = "#D40000;";  
				  break;
				   
			  } 
			  	  
			  echo "<td style=\"width:6%; text-align:center; font-size: 0.9em; min-width:60px; color:".$color."\">".$cajant[$i]['cantidad_transaccion']."</td>";
			  //echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".$transacciones_caja[$i]['saldo']."</td>";
			
		    echo "</tr>";
		 }
            
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de la TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY -->
 
<?php
		}   // Fin del if ( $cajant == "null" )   {
    }   // Fin del if ( isset($cajant))  {
?>


 <!--************************************************  VISTA4 *************************************************+--> 
 
<?php

	} else if ( empty($_GET['optioncaja']) )  {  
      // Esto es cuando no existe la variable $_GET['optioncaja']  PANTALLA POR DEFECTO

    $show_pendientes = show_ingresos_de_caja_pendientes(0);  // Muestra las transacciones pendientes de entrada en la caja.
	$transacciones_caja = show_transacciones_caja(0);        // Muestra las transacciones que han habido en la caja el día de HOY.
	$resumen_caja = show_resumen_caja(0);                    // Muestra todos lo relacionado con los datos del RESUMEN DE CAJA DEL DÍA.
    $moneda_informes = charge_moneda();                      // Cargo la moneda de los informes.
?>     

<!-- *******************************************************************************************
                                        MENSAJES DE INSERCIÓN/ERRROR DE TRANSACCIONES 
            *********************************************************************************************  -->       
<?php
    if ( $transacciones_caja == "error_de_local" )   {
		// ESTO ES PARA CUANDO NO HAY NINGIUN LOCAL EN LA BASE DE DATOS.
?>		
       <div class="message_error" style="margin:10px 0px 10px 0; width:99.4%;"> NO SE HA CREADO NINUN LOCAL. POR FAVOR VAYA A LA PESTA&Ntilde;A INVENTARIOS Y CREE LOS LOCALES DE SU NEGOCIO. GRACIAS </div>

<?php		
    }
?>
<?php 
         if ( isset($_GET['ttype']))  {
		 
		     if ( $_GET['ttype'] == "ok" )   {
			 //CASO 1. Esto significa que se insertaron bien las transacciones en la BD.
?>        
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> Transacciones introducidas correctamente en la BD </div>
<?php 
			 } else if ( $_GET['ttype'] != "ok" )   {
			 //CASO 2. Esto significa que se agregaron transacciones pendientes en la BD.
                 switch($_GET['ttype'])
				 {
				    case "1":
					   // A) Se ha seleccionado una transacción PENDIENTE para introducir en la BD.
					   $message = "Introducida 1 transacci&oacute;n ";
					break;
					default:
					   // B) Se han introducido más de 1 transacción PENDIENTE para introducir en la BD. 
					   $message = "Introducidas ".$_GET['ttype']." transacciones ";
					break;
					 
				 }
?>        
                 <div class="message_ok" style="margin:10px 0px 10px 0; width:99.4%;"> <?php echo $message ?> correctamente en la BD </div>
<?php
   	         }   // Fin del if ( $_GET['ttype'] ==  .... )
		 }  // Fin del if ( isset($_GET['ttype']))
?>     

         <!-- *******************************************************************************************
                                   MUESTRO LOS ARTÍCULOS QUE ESTÁN PENDIENTES DE ENTRADA A ESE ALMACÉN
             *********************************************************************************************  -->  
<?php        
        if ( isset($show_pendientes))  {
		 
		     if ( $show_pendientes == "null" )   {
			 //CASO 1. Esto significa que en el local seleccionado no hay ningun EFECTIVO pendiente de ENTRADA EN CAJA.
             
			     // NO PASA NADA 

			 } else {
             // CASO 2. Esto signfica que en el Local Seleccionado hay EFECTIVO pendiente de ENTRADA -> MUESTRO LA TABLA  <-. 

?>      <!-- *******************************************************************************************
                          MUESTRO LA TABLA CON LOS DATOS DEL EFECTIVO PENDIENTE DE ENTRADA 
             *********************************************************************************************  -->  
             
         <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
        <div style="width:100%; margin:15px 0px 10px 0px;; background-color:#999; padding:3px; border-radius:5px 5px;" id="show_pendientes">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="6"> TABLA DE INGRESOS PENDIENTES DE ENTRADA A LA CAJA DEL LOCAL </th>
           </tr>
           <tr >
              <th style="width: 3%; font-size: 0.9em; min-width: 24px;"> # </th>
              <th style="width: 5%; font-size: 0.9em; min-width: 30px;"> Entrada </th>
              <th style="width: 6%; font-size: 0.9em; min-width:40px;"> FECHA </th>
              <th style="width: 35%; font-size: 0.9em; min-width:73px;"> PROVEEDOR DEL INGRESO DE CAJA </th>
              <th style="width: 45%; font-size: 0.9em; min-width:80px;"> OBSERVACIONES </th>
              <th style="width: 6%; font-size: 0.9em; min-width:40px;"> CANTIDAD </th>
           </tr>
         </table> 
       
        <form name="efectivo_pendientes_entrada" action="" method="post"  >
         <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($show_pendientes); $i++ )
	    {
			//03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			echo "<tr>";
			   echo "<td style=\"width: 3%; min-width: 24px; \">".($i+1)."</td>"; 
			   echo "<td style=\"width: 5%; min-width: 30px; \"> <input type=\"checkbox\" name=\"id_pendiente".$show_pendientes[$i]['id']."\" value=\"on\"  </td>";
			   echo "<td style=\"width: 6%; min-width:40px; \">".stripslashes($show_pendientes[$i]['fecha_transaccion'])."</td>";
			   echo "<td style=\"width: 35%; text-align: left; font-size: 0.9em; min-width:73px; \" >".stripslashes($show_pendientes[$i]['nombre_caja_local_origen'])."</td>";
			   echo "<td style=\"width: 45%; text-align: left; font-size: 0.9em; min-width:80px;  \">".stripslashes($show_pendientes[$i]['observaciones_transaccion'])."</td>"; 
			   echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".stripslashes($show_pendientes[$i]['cantidad_transaccion'])."</td>";
            echo "</tr>";

   	    }
?>
<!-- id del local para poder hacer las ENTRADAS en la TABLA CORRESPONDIENTE  -->
<input type="hidden" name="id_local_stock" value="<?php echo $_SESSION['id_local']; ?>"  />

<?php
        
		    echo "<tr>";
		       echo "<td style=\"width: 100%; text-align: center; font-size: 0.9em; padding-left: 30px;\" colspan=\"10\"> <input type=\"submit\" value=\"A&ntilde;adir\" style=\"width:70px;\" onclick=\"return add_efectivo_pendiente();\" /> </td>";
		    echo "</tr>";
				    
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
<?php
   	     }  // Fin del if ( $show_pendientes == "null" )   {
	 }  // Fin del if ( isset($show_pendientes))  {
?>        
      
           <!-- Botón de IMPRIMIR -->  
            <div class="cabecera_botton" style="margin-left:90%;">
             <a title="Imprimir reporte de Caja Actual." href="index.php?mod=mod_imprimir&caj=1&view=princ&id=<?php echo $_SESSION['id_local']; ?>" target="_blank">
                <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
                <br>
                Imprimir
              </a>
            </div>     
      
      <!--***********************************************************************************************************************
                                            TABLA CON LOS DATOS DE LA CAJA EN ESE DÍA 
      *************************************************************************************************************************++ -->
   <table class="vista_caja" style="margin-bottom: 15px;" cellspacing="0" cellpadding="0">
      
      <?php
         switch($_SESSION['tipo_usuario'])  // Esto es para poner "CAJA CENTRAL" ó "CAJA ALMACÉN"
		 {
		   	case "a":
			   $nombre_caja = "CAJA CENTRAL";
			break;
			case "v":
			   $nombre_caja = "CAJA ALMAC&Eacute;N"; 
			break; 
		 }
      ?>
      
      <tr >
         <th style="width:100%; color:#5D5D5D; background-color:#F2F2F2; padding:5px 0px;" colspan="100"> RESUMEN <?php echo $nombre_caja; ?> D&Iacute;A <?php echo $fecha; ?> </th>
      </tr>
      
      <tr>    
         <td style="color:#5D5D5D; background-color:#F2F2F2; padding:5px 0px;">&nbsp;   </td>
         <td style="color:#5D5D5D; background-color:#F2F2F2; padding:5px 0px;"> CANTIDAD </td>
         <td style="color:#5D5D5D; background-color:#F2F2F2; padding:5px 0px;"> <?php echo stripslashes($moneda_informes['moneda_informes']); ?> </td>
      </tr>
    	  
	  <?php
         switch($_SESSION['tipo_usuario'])  // Esto es para poner "VENTAS TOTALES" ó "TOTAL DE COMPRAS"
		 {
		   	case "a":  // CASO ADMINISTRADOR. 
			   $tipo_accion = "TOTAL COMPRAS";
			   $num_tipo_accion = stripslashes($resumen_caja['num_compras_totales']);
			   $efectivo_tipo_accion = stripslashes($resumen_caja['efectivo_compras_totales']);
			break;
			case "v":  // CASO VENDEDOR.
			   $tipo_accion = "VENTAS TOTALES"; 
			   $num_tipo_accion = stripslashes($resumen_caja['num_ventas_totales']);
			   $efectivo_tipo_accion = stripslashes($resumen_caja['efectivo_ventas_totales']);
			break; 
		 }
      ?>
	  
      <tr>    
         <td style="width: 40%;color: white; background-color:#056AA8;"> <?php echo $tipo_accion; ?>  </td>
         <td style="width: 25%; color:#066AA8;"> <?php echo $num_tipo_accion; ?>  </td>
         <td style="width: 35%; color:#066AA8;"> <?php echo $efectivo_tipo_accion; ?>  </td>
      </tr>
    
     <tr>    
         <td style="color: white; background-color:#056AA8;"> RETIROS  </td>
         <td> <?php echo stripslashes($resumen_caja['num_retiros']); ?>  </td>
         <td> <?php echo stripslashes($resumen_caja['efectivo_retiros']); ?>  </td>
      </tr>
    
     <tr>    
         <td style="color: white; background-color:#056AA8;"> INGRESOS  </td>
         <td> <?php echo stripslashes($resumen_caja['num_ingresos']); ?>  </td>
         <td> <?php echo stripslashes($resumen_caja['efectivo_ingresos']); ?>  </td>
     </tr>
     
     <?php
        // BUSCO EL SALDO DE LA CAJA ANTERIOR ( DEL DÍA ANTERIOR ) 
		$total_caja_right_now = stripslashes($resumen_caja['total_caja']);
		$ingresos_right_now   = stripslashes($resumen_caja['efectivo_ingresos']); 
		$retiros_right_now    = stripslashes($resumen_caja['efectivo_retiros']);
		
		settype($total_caja_right_now, "float");
		settype($ingresos_right_now, "float");
		settype($retiros_right_now, "float"); 
		
		$saldo_caja_anterior = $total_caja_right_now - ( $ingresos_right_now - $retiros_right_now ) ;              
		 
      ?>    
     
     <tr>    
         <td style="color: white; background-color:#056AA8;"> CAJA ANTERIOR </td>
         <td>&nbsp;    </td>
         <td> <?php echo $saldo_caja_anterior; ?>  </td>
     </tr>
     
     <tr>    
         <td style="color: white; background-color:#056AA8;"> TOTAL CAJA  </td>
         <td>&nbsp;  </td>
         <td> <?php echo stripslashes($resumen_caja['total_caja']); ?> </td>
      </tr>
    
    </table>
   
    
           <!-- *************************************************************************************************************
                             MENSAJE DE CUANDO NO SE HA INTRODUCIDO NINGUNA TRANSACCIÓN EN LA CAJA EL DÍA ACTUAL
            ****************************************************************************************************************  --> 
       
<?php
     if ( $resumen_caja['existe'] == "null" )  {
		 
?>		 
         <div class="message_wrong" style="margin-top:0px;"> No existen TRANSACCIONES EN LA CAJA el d&iacute;a de HOY </div> 
<?php	 
	 }  else  {// Fin del  if ( $transacciones_caja == "null" )  {
?>       
     
             <!-- ********************************************************************************************
                       TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY 
                  ******************************************************************************************* -->
        
        <div style="width:100%;">
         <table class="table_form" cellspacing="0" cellpadding="0">
           <tr >
              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="11"> CAJA </th>
           </tr>
           <tr >
              <th style="width: 4%; font-size: 0.9em; min-width: 24px;"> # </th>
              <th style="width: 13%; font-size: 0.9em; min-width: 60px;"> TIPO TRANSACCI&Oacute;N </th>
              <th style="width: 17%; font-size: 0.9em; min-width:90px;"> ORIGEN </th>
              <th style="width: 17%; font-size: 0.9em; min-width:90px;"> DESTINO </th>
              <th style="width: 18%; font-size: 0.9em; min-width:90px;"> OBSERVACIONES </th>
              <th style="width: 8%; font-size: 0.9em; min-width:80px;"> 
                  <?php
			         // Este campo depende de si el usuario es 'administrador' o 'vendedor'
			         switch($_SESSION['tipo_usuario'])
					 {
						case "a":   // administrador
					         echo "No. COMPRA";
					    break;
						case "v":   // vendedor
						     echo "No. VENTA";
						break;
					 }
			      ?>   
              </th>
              <th style="width: 15%; font-size: 0.9em; min-width:80px;"> USUARIO </th>
              <th style="width: 8%; font-size: 0.9em; min-width:60px;"> CANTIDAD </th>
            <!--  <th style="width: 6%; font-size: 0.9em; min-width:40px;"> SALDO </th> -->
             
           </tr>
         </table> 
       
        <form name="caja_diaria" action="" method="post"  >
         <table class="table_form" cellspacing="0" cellpadding="0"> 
<?php
        for ( $i=0; $i < count($transacciones_caja); $i++ )
		 {
			//03 MUESTRO LA TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY 
            echo "<tr>";
			   
			  echo "<td style=\"width: 4%; min-width: 24px;\">".($i+1)." <input type=\"hidden\" name=\"caja_id\" value=\"".$transacciones_caja[$i]['id']."\" /> </td>"; 
			  echo "<td style=\"width: 13%; font-size: 0.9em; min-width:60px; \"> ".$transacciones_caja[$i]['tipo_transaccion']."</td>"; 
			  echo "<td style=\"width: 17%; text-align: justify; font-size: 0.9em; min-width:90px; \" >".$transacciones_caja[$i]['origen_transaccion']."</td>";
		      echo "<td style=\"width: 17%; text-align: justify; font-size: 0.9em; min-width:90px; \" >".$transacciones_caja[$i]['destino_transaccion']."</td>";
			  echo "<td style=\"width: 18%; text-align: justify; font-size: 0.9em; min-width:90px; \" >".stripslashes($transacciones_caja[$i]['observaciones'])."</td>";
			 
			  // Este campo depende de si el usuario es 'administrador' o 'vendedor'
			  switch($_SESSION['tipo_usuario'])
			  {
				 case "a":   // administrador
				     $tipo_trans = $transacciones_caja[$i]['no_orden_de_compra'];
				     if ( $tipo_trans == 0 )  {
						 $tipo_trans = "";
					 }
				 break;
				 case "v":   // vendedor
				     $tipo_trans = $transacciones_caja[$i]['no_venta'];
				     if ( $tipo_trans == 0 )  {
						 $tipo_trans = "";
					 }
				 break;
			  }   
			 
			  echo "<td style=\"width: 8%; font-size: 0.9em; min-width:80px;  \">".$tipo_trans."</td>";
		      echo "<td style=\"width: 15%; text-align: center; font-size: 0.9em; min-width:80px;  \">".stripslashes($transacciones_caja[$i]['persona_q_hace_transaccion'])."</td>";
		      switch($transacciones_caja[$i]['tipo_transaccion'])
			  {
				  // Si es un Retiro de Caja pongo la cantidad en rojo.
				  case "Ingreso de Caja":
				       $color = "#464646;";  
				  break;
				  case "Retiro de Caja":
				       $color = "#D40000;";  
				  break;
				   
			  } 
			  	  
			  echo "<td style=\"width:8%; text-align:center; font-size: 0.9em; min-width:60px; color:".$color."\">".stripslashes($transacciones_caja[$i]['cantidad_transaccion'])."</td>";
			  //echo "<td style=\"width: 6%; text-align: center; font-size: 0.9em; min-width:40px;  \">".$transacciones_caja[$i]['saldo']."</td>";
			
		    echo "</tr>";
		 }
            
?>         
        </table>
       </form>     
      </div>  <!-- fin del <div> de la TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY -->
 
<?php	 
	 }  // Fin del  if ( $transacciones_caja == "null" )  {
?>

<?php
	 }
?>