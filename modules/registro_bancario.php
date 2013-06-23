<?php
/*
* Este es el módulo que muestra el REGISTRO BANCARIO DE LA EMPRESA.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*
* COMÚN: MUESTRA LO QUE ES COMÚN PARA TODAS LAS VISTAS.
*
*
* VISTA1: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --NUEVO REGISTRO--  ( $_GET['optionrb == 'new_in'] )
*
*
*-----------------------------------------------------> REPORTES
*
*
* VISTA2: VISTA QUE MUESTRA LO REFERIDO AL CLICK EN EL BOTON DE LA BARRA --CONSULTA POR MES/AÑO--  ( $_GET['optionrb == 'consulta'] )
*
*
* VISTA3: VISTA QUE MUESTRA LA TABLA DEL LOS REGISTROS BANCARIOS DEL MES SELECCIONADO. --VER MES ACTUAL--  ( $_GET['optionrb == 'actual'] )
*         
*
*------------------------------------------------------> DEFAULT
*
* VISTA4: VISTA CORRESPONDIENTE A LA TABLA CON TODOS LOS REGISTROS INSERTADOS POR EL USUARIO.(default) 
*
*/

// no direct access
defined('VALID_VAR') or die;


?>
                   <!--  *************************************** COMÚN *********************************** --------------->

<p> Bienvenido usuario al m&oacute;dulo de Registro Bancario donde usted podr&aacute; actualizar el registro de la Cuenta de Banco de su negocio en el SSC y ver todos los datos del mismo. Por favor utilice el formulario para introducir datos. GRACIAS</p>
         
    <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES  Y REPORTES
   *************************************************************************************************************-->
            
    <div id="radiobar_rb" class="buttons_bar_full">  
      
         <form>
	          <input type="radio" id="radio-1" name="radio" <?php if (isset($_GET['optionrb']) && $_GET['optionrb'] == "new_in" ) { echo "checked=\"checked\""; }  ?> /><label for="radio-1" title="Crear nuevo registro bancario."> Nuevo Registro </label>
		                  
      <!-- ******************************************************************************************************** 
                                                 BARRA DE BOTONES DE REPORTES 
      *************************************************************************************************************-->
                     
          <span style="float:right; margin-right:4px;"> 
	          <input type="radio" id="radio-2" name="radio" <?php if (isset($_GET['optionrb']) && $_GET['optionrb'] == "consulta" ) { echo "checked=\"checked\""; } ?> /><label for="radio-2" title="Ver todos los registros bancarios de un mes/a&ntilde;o seleccionado."> Consulta por mes/a&ntilde;o </label>
              <input type="radio" id="radio-3" name="radio" <?php if (isset($_GET['optionrb']) && $_GET['optionrb'] == "actual" ) { echo "checked=\"checked\""; } ?> /><label for="radio-3" title="Ver los registros bancarios del mes actual y el saldo del mes anterior."> Ver mes actual </label>              
		      
		  </span>  	       
          <span style="font-size:1.2em; float:right; margin:8px 15px 0 0;"> REPORTES  </span>  
        </form>
             
    </div>  
      
 
     <!----------------**********************************  VISTA1 *********************************---------------------->
<?php
   
   if( isset($_GET['optionrb']) && $_GET['optionrb'] == "new_in" )  {
	   // Esto es cuando le doy al botón NUEVO REGISTRO DE LA BARRA DE BOTONES.
 
  
?>   
      <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
              
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Registro Bancario." href="javascript:void(0)" onclick="inicio_rb_button('inicio');">
              <img width="32" border="0" height="32" alt="Botón Inicio" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
         
        <div class="include_form" id="nuevo_registro_rb">
                
         <form action="#" method="post" name="form_bank">
           <fieldset class="fieldset_form">   
            <legend>Formulario de Entrada de Datos</legend>
            
            <!--  PRIMER <div>  -->
            <div class="inline_line" >
               <p>       
                   <input class="text_form" type="text" name="fecha" value="" id="campofecha" maxlength="11" placeholder="Fecha" style="width: 70px;"/> 
                        
                   <label> <input type="radio" id="radio_debito" name="tipo_deposito" value="debito" onchange="return able_debito();" onfocus="return able_debito();" /> D&eacute;bito  </label> 
                   <br />
                   <label> <input type="radio" id="radio_credito" name="tipo_deposito" value="credito" onchange="return able_credito();" onfocus="return able_credito();" /> Cr&eacute;dito </label> 
                   <br />
                   <label style="color:red;"> <input type="checkbox" id="checkbox_1" name="reajustar_error" value="on" /> Reajustar error </label> 
              
              </p>
                 
              <p>
                   <span style="float: left; "> Descripci&oacute;n: </span>
                   <br style="line-height:1.5em;" />
                   <textarea class="textarea_form" style="width: 280px; height: 80px;" name="descripcion" > </textarea>
              </p>
                          
                 <!--  SEGUNDO contendor de los campos DÉBITO Y CRÉDITO <div>  -->
              <div style="margin-top: 10px; position:absolute; top:-10px; left: 300px;">
            
                <p style="width:150px;">
                <span style="float:left;"> &nbsp; &nbsp; &nbsp; &nbsp; Valor de Pago: </span>  
                <input class="text_form" type="text" name="valor_pago" value="" id="valor_pago" maxlength="20" placeholder="D&eacute;bito" style="width: 120px;" disabled="disabled" style="" /> 
                </p>        
                <p style="width:150px;">
                <span style="float: left; margin: 6px 0 0 0; "> Valor del Dep&oacute;sito: </span>  
                <input class="text_form" type="text" name="valor_deposito" value="" id="valor_deposito" maxlength="20" placeholder="Cr&eacute;dito" style="width: 120px;" disabled="disabled" /> 
                </p>  
               
             </div> <!--  fin  del segundo CONTENEDOR DE LOS CAMPOS div --> 
            
              <!--  TERCER contendor de los botones Reset y Guardar  -->
             <div style="margin-top: 10px; position:absolute; top:110px; left: 300px;"> 
                <p>
                <input type="submit" value="Guardar" style="float:right; margin:15px 120px 5px 0; padding:3px 7px;" onclick="return send_bankform();" />
                <input type="reset" value="Reset" style="float:right; margin:15px 20px 5px 0; padding:3px 7px;" />
                </p> 
             </div> 
                           
           </div>  <!-- fin del div class="inline_line"   -->
                                
          <?php  if ( empty($_GET['mes'] ))  {        
          // ESTO ES PARA QUE ME ENVÍE UNA VARIABLE $_POST DIF. SI ESTOY EN LA VISTA DEL MES ACTUAL/TODOS LOS REGISTTROS ?>  
                 
                 <input type="hidden" name="mes" value="todo" />
            
          <?php  } else if ( isset($_GET['mes']) && $_GET['mes'] == "actual" )  { ?>        
          
                 <input type="hidden" name="mes" value="actual" />  
            
          <?php  }  ?>  
          
           </fieldset>
         </form>   
     </div>   
            
     
    <!----------------**********************************  VISTA2 *********************************---------------------->
<?php
   
   } else if( isset($_GET['optionrb']) && $_GET['optionrb'] == "consulta" )  {
	   // Esto es cuando le doy al botón de REPORTES Ver mes actual DE LA BARRA DE BOTONES.
       
	   if ( isset($_GET['mesano']) && $_GET['mesano'] == "send" ) {
	   
           $mes_ano_saldo = process_form_mes($_POST['mes_consulta'],$_POST['ano_consulta']);
		   $id_final = $mes_ano_saldo[3];
		   $id_inicial = $mes_ano_saldo[4];
		   $bank_register = process_bank_register_mes( $id_final, $id_inicial );
	   }
	   
?>        
     <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
              
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Registro Bancario." href="javascript:void(0)" onclick="inicio_rb_button('inicio');">
              <img width="32" border="0" height="32" alt="Botón Inicio" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
        
<?php   
   if ( isset($_GET['mesano']) && $_GET['mesano'] == "send" ) {
?>	   
      <!-- Botón de IMPRIMIR  -->
         <div class="cabecera_botton">
            <a title="Imprimir reporte." href="index.php?mod=mod_imprimir&rb=1&mes=<?php echo $_POST['mes_consulta']; ?>&y=<?php echo $_POST['ano_consulta']; ?>&idf=<?php echo $id_final; ?>&idi=<?php echo $id_inicial; ?>" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div>     
<?php 
   }
?>        
             
        <!--**********************************************************************************************
                              TABLA DE CONSULTAS DE REGISTROS DE UN MES A SELECCIONAR  
          **********************************************************************************************-->
      
   <div class="form_superior">  
                 
    <div style="float:left; margin-top:3px;">
     <form action="#" method="post" name="form_mes">
       <span style="text-shadow: #A4A4A4 1.5px 1.5px 1px;"> Consultar Estado de Cuentas del mes/a&ntilde;o: </span>        
            <select name="mes_consulta" style="width:100px; border:1px solid #A2A2A2; margin-left:5px;"> 
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
                             
            <select name="ano_consulta" style="width:65px;  border:1px solid #A2A2A2; margin-left:5px;"> 
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
         
           <input type="submit" value="Aceptar" style="width:70px; padding:2px 7px; margin-left:10px;" onclick="return send_mesform();" />
         
       </form>  
      </div> 
    </div> 
     
          <!--**********************************************************************************************
                                  TABLA QUE MUESTRA LOS DATOS DEL MES SELECCIONADO
              **********************************************************************************************-->
<?php   
    // COMPRUEBO PARA CUANDO NO EXISTEN REGISTROS DEL MES SOLICITADO 
	if ( isset($_GET['mesano']) && $_GET['mesano'] == "send" ) {
	
	    // MUESTRO EL MES Y EL AÑO DEL QUE QUIERO SABER EL REGISTRO. 
	    echo "<div style=\"clear:both; font-size:1.1em;\">".$mes_ano_saldo[0]." ".$mes_ano_saldo[1]."</div>";  
		echo "<br />";
	
	    if ( $mes_ano_saldo[3] == "0" && $mes_ano_saldo[4] == "0"  )  {
    
?>	    	
            <div class="message_wrong" style="margin-top:15px; width:99%;"> No existen REGISTROS BANCARIOS en la Base de Datos para el mes solicitado</div> 
<?php		  
	    } else {
        // EN ESTE CASO EXISTEN REGISTROS DEL MES SOLICITADO 
?>        
   
            <!-- TABLA CON EL SALDO DEL MES ANTERIOR AL SOLICITADO -->
             <table class="table_mes_anterior" cellspacing="0" cellpadding="0">
               <tr>    
                 <td style="width: 70%; color: white; background-color:#056AA8;">  Saldo del mes anterior  </td>
                 <td style="width: 30%;"> <?php echo $mes_ano_saldo[2]; ?>  </td>
              </tr>
             </table>
   
           <!-- TABLA CON LOS REGISTROS DEL MES SOLICITADO  -->
           <div style="margin-top: 20px; width:100%;">
             <table class="table_form" cellspacing="0" cellpadding="0">
               <tr >
                   <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="7"> TABLA DE REGISTROS BANCARIOS </th>
               </tr>
               <tr >
                 <th style="width: 4%;"> # </th>
                 <th style="width: 4%;"> id </th>
                 <th style="width: 8%; min-width:80px;"> FECHA </th>
                 <th style="width: 59%;"> DESCRIPCI&Oacute;N </th>
                 <th style="width: 8%; min-width:80px;"> D&Eacute;BITOS </th>
                 <th style="width: 8%; min-width:80px;"> CR&Eacute;DITOS </th>
                 <th style="width: 9%; min-width:80px;"> SALDOS </th>  
               </tr>
             </table> 
       
             <table class="table_form" cellspacing="0" cellpadding="0"> 

<?php            
		         for ( $i=0; $i < count($bank_register); $i++ )
		         {
			          // Esto es para marcar en ROJO los que hayan sido afectados 
			          if ( $bank_register[$i]['reajustar_error'] == "1" )  {
				         $style = "color: #D40000;";
			          } else {
			             $style = "";	 
			          }
			 
			       //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			       echo "<tr>";
			          echo "<td style=\"width: 4%;\">". ($i+1) ."</td>"; 
		              echo "<td style=\"width: 4%; ".$style." \" >".$bank_register[$i]['id']."</td>"; 
			          echo "<td style=\"width: 8%; min-width:80px; ".$style." \" >".stripslashes($bank_register[$i]['fecha'])."</td>";
		              echo "<td style=\"width: 59%; text-align: justify; ".$style." \">".stripslashes($bank_register[$i]['descripcion'])."</td>";
		     
			          if ( stripslashes($bank_register[$i]['debitos']) == 0 )  {
				          $bank_register[$i]['debitos'] = ""; 
			          }
			          if ( stripslashes($bank_register[$i]['creditos']) == 0 )  {
				          $bank_register[$i]['creditos'] = ""; 
			          }
			 
			          echo "<td style=\"width: 8%; min-width:80px; ".$style." \" >".stripslashes($bank_register[$i]['debitos'])."</td>";
			          echo "<td style=\"width: 8%; min-width:80px; ".$style." \">".stripslashes($bank_register[$i]['creditos'])."</td>";
		              echo "<td style=\"width: 8%; min-width:80px;\">".stripslashes($bank_register[$i]['saldos'])."</td>";
		            echo "</tr>";
		         }  // Fin del for
            
?>           
             </table>
        </div>


<?php  
  
     }  // Fin del if ( $mes_ano_saldo[3] == "0" && $$mes_ano_saldo[4] == "0"  )  { 
 
  }  // fin del if ( isset($_GET['mesanocxp']) && $_GET['mesanocxp'] == "send" ) {

?>        
   <!----------------**********************************  VISTA3 *********************************---------------------->
<?php
   
   } else if( isset($_GET['optionrb']) && $_GET['optionrb'] == "actual" )  {
	   // Esto es cuando le doy al botón de REPORTES Ver mes actual DE LA BARRA DE BOTONES.

      $saldo_mes_anterior = saldo_mes_anterior();  // Muestra el saldo al cierre del mes anterior.
      $bank_register_actual = process_bank_register_mes_actual();
?>        
     <!-- ********************************************************************************************
                                ÁREA DE BOTONES PARA HACER ACCIONES EN ESTE MISMO MÓDULO
          ******************************************************************************************* -->
              
        <!-- Botón de ir a INICIO  -->
         <div class="cabecera_botton">
            <a title="Ir a la p&aacute;gina de Inicio del M&oacute;dulo Registro Bancario." href="javascript:void(0)" onclick="inicio_rb_button('inicio');">
              <img width="32" border="0" height="32" alt="Botón Inicio" src="images/button_inicio.png" class="img_botton">
              <br>
              Inicio
            </a>
         </div>
         
         <!-- Botón de IMPRIMIR  -->
         <div class="cabecera_botton">
            <a title="Imprimir reporte." href="index.php?mod=mod_imprimir&rb=2" target="_blank">
              <img width="32" border="0" height="32" alt="Botón Imprimir" src="images/button_print.png" class="img_botton">
              <br>
              Imprimir
            </a>
         </div>    
           
       <!-- ********************************************************************************************
                                    TABLA CON EL SALDO DEL MES ANTERIOR
          ******************************************************************************************* -->
           
       <!-- TABLA CON EL SALDO DEL MES ANTERIOR -->
       <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:35%; clear:both; margin-bottom:20px;">
         <tr>    
           <td style="width: 70%; color: white; background-color:#056AA8;">  Saldo del mes anterior  </td>
           <td style="width: 30%;"> <?php echo $saldo_mes_anterior; ?>  </td>
         </tr>
      </table>  
       
<?php      
      if ( $bank_register_actual == "null" )  {
		  // Esto significa que no hay registros en el mes actual  
?>	         
	 	  <div class="message_wrong" style="margin-top:0px; width:99%;"> No existen REGISTROS BANCARIOS en la Base de Datos para el mes actual</div> 
<?php	 
	  }  else  {   
?>              
       <!-- ********************************************************************************************
                                       TABLA CON LOS REGISTROS DEL MES ACTUAL
          ******************************************************************************************* -->
                
      <!-- TABLA CON LOS REGISTROS DE ESTE MES  -->
      <div style="margin-top: 20px; width:100%;">
       <table class="table_form" cellspacing="0" cellpadding="0">
         <tr >
            <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE REGISTROS BANCARIOS </th>
         </tr>
         <tr >
            <th style="width: 4%;"> # </th>
            <th style="width: 4%;"> id </th>
            <th style="width: 8%; min-width:80px;"> FECHA </th>
            <th style="width: 59%;"> DESCRIPCI&Oacute;N </th>
            <th style="width: 8%; min-width:80px;"> D&Eacute;BITOS </th>
            <th style="width: 8%; min-width:80px;"> CR&Eacute;DITOS </th>
            <th style="width: 9%; min-width:80px;"> SALDOS </th>  
        </tr>
       </table> 
     
       <table class="table_form" cellspacing="0" cellpadding="0"> 
 <?php         
          for ( $i=0; $i < count($bank_register_actual); $i++ )
		  {
			  // Esto es para marcar en ROJO los que hayan sido afectados 
			  if ( $bank_register_actual[$i]['reajustar_error'] == "1" )  {
				  $style = "color: #D40000;";
			  } else {
			      $style = "";	 
			  }
			 
			  //01 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			  echo "<tr>";
			     echo "<td style=\"width: 4%;\">". ($i+1) ."</td>"; 
		         echo "<td style=\"width: 4%; ".$style." \" >".$bank_register_actual[$i]['id']."</td>"; 
			     echo "<td style=\"width: 8%; min-width:80px; ".$style." \" >".stripslashes($bank_register_actual[$i]['fecha'])."</td>";
		         echo "<td style=\"width: 59%; text-align: justify; ".$style." \">".stripslashes($bank_register_actual[$i]['descripcion'])."</td>";
		     
			     if ( stripslashes($bank_register_actual[$i]['debitos']) == 0 )  {
				    $bank_register_actual[$i]['debitos'] = ""; 
			     }
			     if ( stripslashes($bank_register_actual[$i]['creditos']) == 0 )  {
				    $bank_register_actual[$i]['creditos'] = ""; 
			     }
			 
			     echo "<td style=\"width: 8%; min-width:80px; ".$style." \" >".stripslashes($bank_register_actual[$i]['debitos'])."</td>";
			     echo "<td style=\"width: 8%; min-width:80px; ".$style." \">".stripslashes($bank_register_actual[$i]['creditos'])."</td>";
		         echo "<td style=\"width: 8%; min-width:80px;\">".stripslashes($bank_register_actual[$i]['saldos'])."</td>";
		       echo "</tr>";
		   }  // Fin del for
            
?>           
      </table>
    </div>
       
<?php
	
	}   // Fin del if ( $bank_register_actual == "null" )  {

?>	
     
<!----------------****************************************  VISTA4 (DEFAULT)****************************************---------------------->
<?php
   
   } else if( empty($_GET['optionrb']))  {
	   // Esta es la vista por defecto del MÓDULO.
  
     $saldo_mes_anterior = saldo_mes_anterior();  // Muestra el saldo al cierre del mes anterior.
	 $bank_register = process_bank_register();    // Muestra todos los registros.

?>         
         
   <!-- TABLA CON EL SALDO DEL MES ANTERIOR -->
    <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:35%;">
      <tr>    
         <td style="width: 70%; color: white; background-color:#056AA8;">  Saldo del mes anterior  </td>
         <td style="width: 30%;"> <?php echo $saldo_mes_anterior; ?>  </td>
      </tr>
    </table>    
 
 
<?php      
      if ( $bank_register == "null" )  {
		  // Esto significa que no hay registros en el mes actual  
?>	         
	 	  <div class="message_wrong" style="margin-top:0px; width:99%;"> No existen REGISTROS BANCARIOS en la Base de Datos.</div> 
<?php	 
	  }  else  {   
?>   
     
   <!-- TABLA CON LOS REGISTROS DE ESTE MES  -->
    <div style="margin-top: 20px; width:100%;">
       <table class="table_form" cellspacing="0" cellpadding="0">
         <tr >
            <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE REGISTROS BANCARIOS </th>
         </tr>
         <tr >
            
            <th style="width: 4%;"> # </th>
            <th style="width: 4%;"> id </th>
            <th style="width: 8%; min-width:80px;"> FECHA </th>
            <th style="width: 59%;"> DESCRIPCI&Oacute;N </th>
            <th style="width: 8%; min-width:75px;"> D&Eacute;BITOS </th>
            <th style="width: 8%; min-width:75px;"> CR&Eacute;DITOS </th>
            <th style="width: 9%; min-width:78px;"> SALDOS </th>  
      
        </tr>
       </table> 
 
       <table class="table_form" id="table_form_pagination" cellspacing="0" cellpadding="0">  
<?php
           for ( $i=0; $i < count($bank_register); $i++ )
		   {
			    // Esto es para marcar en ROJO los que hayan sido afectados 
			    if ( $bank_register[$i]['reajustar_error'] == "1" )  {
				    $style = "color: #D40000;";
			    } else {
			        $style = "";	 
			    }
			 
			    //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			    echo "<tr>";
			      echo "<td style=\"width: 4%;\">". ($i+1) ."</td>"; 
		          echo "<td style=\"width: 4%; ".$style." \" >".$bank_register[$i]['id']."</td>"; 
			      echo "<td style=\"width: 8%; min-width:80px; ".$style." \" >".stripslashes($bank_register[$i]['fecha'])."</td>";
		          echo "<td style=\"width: 59%; text-align: justify; ".$style." \">".stripslashes($bank_register[$i]['descripcion'])."</td>";
		     
			      if ( stripslashes($bank_register[$i]['debitos']) == 0 )  {
				      $bank_register[$i]['debitos'] = ""; 
			      }
			      if ( stripslashes($bank_register[$i]['creditos']) == 0 )  {
				      $bank_register[$i]['creditos'] = ""; 
			      }
			 
			      echo "<td style=\"width: 8%; min-width:75px; ".$style." \" >".stripslashes($bank_register[$i]['debitos'])."</td>";
			      echo "<td style=\"width: 8%; min-width:75px; ".$style." \">".stripslashes($bank_register[$i]['creditos'])."</td>";
		          echo "<td style=\"width: 9%; min-width:78px;\">".stripslashes($bank_register[$i]['saldos'])."</td>";
		        echo "</tr>";
		   } // Fin del for
?>           
      </table>
    </div>

<?php

   }  // FIN DEL if ( $bank_register == "null" )  {

?>
    
<?php
   
  } // Fin del if( isset($_GET['optionrb']) && $_GET['optionrb'] == "actual" )  {   FINAL
  
?>       
