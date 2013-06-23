<?php 
/*
* Este es el módulo que muestra los todos los elementos del sistema que se pueden imprimir.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*  CASO 1. MÓDULO REGISTRO BANCARIO. ( $_GET['rb'] = 1 ó 2 )  187
*
*  CASO 2. MÓDULO CUENTAS X COBRAR.  ( $_GET['cxc'] = 1 ó 2 ) 367
*
*  CASO 3. MÓDULO CUENTAS X PAGAR.   ( $_GET['cxp'] = 1 ó 2 ) 520
*
*  CASO 4. MÓDULO PROVEEDORES.       ( $_GET['pro'] = 1 ó 2 ) 678
*
*  CASO 5. MÓDULO CLIENTES.          ( $_GET['cli'] = 1 ó 2 ) 
*
*  CASO 6. MÓDULO COMPRAS.           ( $_GET['cmp'] = 1 ó 2 ) 
*
*  CASO 7. MÓDULO CAJA               ( $_GET['caj'] = 1 ó 2 )
*
*  CASO 8. MÓDULO INVENTARIO         ( $_GET['inv'] = 1, 2, 3 ó 4 ) 
*
*  CASO 9. MÓDULO VENTAS             ( $_GET['vnt'] = 1 ó 2 )
*/

// no direct access
defined('VALID_VAR') or die; 
 
 if ( isset($_SESSION['usuario']) && isset($_SESSION['nombre_completo']) && isset($_SESSION['tipo_usuario']) && isset($_SESSION['id_local']))  {
     //01 Verifico que sólo pueda abrir este archivo la persona que está logueada en el sistema.
       
	   /***************************************************************************************************************************
	                                           1. Header y Cuerpo de la TABLA. Depende de $_GET
	    ***************************************************************************************************************************/	
	      
	   /***************************************************
	   *        CASO 1. MÓDULO REGISTRO BANCARIO.         *
	   ****************************************************/
	   if ( isset($_GET['rb']) && $_GET['rb'] == 2 )  {
	       /****************************************************
		   *  a) imprimir Registros Bancarios del mes actual.  *
		   *****************************************************/
		   $bank_register_actual = process_bank_register_mes_actual();                   // Datos de la TABLA que voy a mostrar.
	   
           if ( $bank_register_actual == "null" )  {
		      // Esto significa que no hay registros en el mes actual  
?>	         
	 	      <div class="message_wrong_print"> No existen REGISTROS BANCARIOS en la Base de Datos para el mes actual</div> 
<?php	 
	       }  else  {   
?>              
                 <!-- ********************************************************************************************
                                              TABLA CON LOS REGISTROS DEL MES ACTUAL
                      ******************************************************************************************** -->
                
                <!-- TABLA CON LOS REGISTROS DE ESTE MES  -->
                <table class="print_table" cellspacing="0" cellpadding="0">
                 <tr >
                  <th style="width:100%; color:#585858; background-color:#F2F2F2;" colspan="100"> TABLA DE REGISTROS BANCARIOS </th>
                 </tr>
                 <tr >
                  <th style="width: 4%;"> # </th>
                  <th style="width: 4%;"> id </th>
                  <th style="width: 8%; min-width:65px;"> FECHA </th>
                  <th style="width: 59%;"> DESCRIPCI&Oacute;N </th>
                  <th style="width: 8%; min-width:70px;"> D&Eacute;BITOS </th>
                  <th style="width: 8%; min-width:70px;"> CR&Eacute;DITOS </th>
                  <th style="width: 9%; min-width:70px;"> SALDOS </th>  
                 </tr>
               </table> 
     
               <table class="print_table" style="margin-bottom:20px;" cellspacing="0" cellpadding="0"> 
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
			          echo "<td style=\"width: 8%; min-width:65px; ".$style." \" >".stripslashes($bank_register_actual[$i]['fecha'])."</td>";
		              echo "<td style=\"width: 59%; text-align: justify; ".$style." \">".stripslashes($bank_register_actual[$i]['descripcion'])."</td>";
		     
			          if ( stripslashes($bank_register_actual[$i]['debitos']) == 0 )  {
				         $bank_register_actual[$i]['debitos'] = ""; 
			          }
			          if ( stripslashes($bank_register_actual[$i]['creditos']) == 0 )  {
				         $bank_register_actual[$i]['creditos'] = ""; 
			          }
			 
			          echo "<td style=\"width: 8%; min-width:70px; ".$style." \" >".stripslashes($bank_register_actual[$i]['debitos'])."</td>";
			          echo "<td style=\"width: 8%; min-width:70px; ".$style." \">".stripslashes($bank_register_actual[$i]['creditos'])."</td>";
		              echo "<td style=\"width: 9%; min-width:70px;\">".stripslashes($bank_register_actual[$i]['saldos'])."</td>";
		            echo "</tr>";
		        }  // Fin del for
?>           
      </table>
<?php
         }// Fin del if ( $bank_register_actual == "null" )  {
	  
	   } else if ( isset($_GET['rb']) && $_GET['rb'] == 1 )  {
		  /**********************************************************
		  *  b) Imprimir Registros Bancarios de un mes solicitado.  *
		  ***********************************************************/
		  
	      $mes_ano_saldo = process_form_mes($_GET['mes'],$_GET['y']);
		  $bank_register = process_bank_register_mes($_GET['idf'],$_GET['idi']) ;     // Datos de la TABLA a mostrar.
	      
		  if ( $_GET['idf'] == "0" && $_GET['idi'] == "0"  )  {
?>	    	
              <div class="message_wrong_print"> No existen REGISTROS BANCARIOS en la Base de Datos para el mes solicitado </div> 
<?php		  
	      } else {
              // EN ESTE CASO EXISTEN REGISTROS DEL MES SOLICITADO 
?>        
   
              <!-- TABLA CON EL SALDO DEL MES ANTERIOR AL SOLICITADO -->
              <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="min-width:300px;">
               <tr>    
                 <td style="width: 70%; color: white; background-color:#056AA8; font-size:0.8em;">  Saldo del mes anterior  </td>
                 <td style="width: 30%; font-size:0.8em;"> <?php echo $mes_ano_saldo[2]; ?>  </td>
               </tr>
              </table>
   
              <!-- TABLA CON LOS REGISTROS DEL MES SOLICITADO  -->
              <div style="margin-top: 20px; width:100%;">
               <table class="print_table" cellspacing="0" cellpadding="0">
                <tr >
                  <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="7"> TABLA DE REGISTROS BANCARIOS </th>
                </tr>
                <tr >
                  <th style="width: 4%;"> # </th>
                  <th style="width: 4%;"> id </th>
                  <th style="width: 8%; min-width:70px;"> FECHA </th>
                  <th style="width: 59%;"> DESCRIPCI&Oacute;N </th>
                  <th style="width: 8%; min-width:70px;"> D&Eacute;BITOS </th>
                  <th style="width: 8%; min-width:70px;"> CR&Eacute;DITOS </th>
                  <th style="width: 9%; min-width:70px;"> SALDOS </th>  
                </tr>
               </table> 
       
               <table class="print_table" cellspacing="0" cellpadding="0"> 
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
			          echo "<td style=\"width: 8%; min-width:70px; ".$style." \" >".stripslashes($bank_register[$i]['fecha'])."</td>";
		              echo "<td style=\"width: 59%; text-align: justify; ".$style." \">".stripslashes($bank_register[$i]['descripcion'])."</td>";
		     
			          if ( stripslashes($bank_register[$i]['debitos']) == 0 )  {
				          $bank_register[$i]['debitos'] = ""; 
			          }
			          if ( stripslashes($bank_register[$i]['creditos']) == 0 )  {
				          $bank_register[$i]['creditos'] = ""; 
			          }
			 
			          echo "<td style=\"width: 8%; min-width:70px; ".$style." \" >".stripslashes($bank_register[$i]['debitos'])."</td>";
			          echo "<td style=\"width: 8%; min-width:70px; ".$style." \">".stripslashes($bank_register[$i]['creditos'])."</td>";
		              echo "<td style=\"width: 9%; min-width:70px;\">".stripslashes($bank_register[$i]['saldos'])."</td>";
		             echo "</tr>";
		          }  // Fin del for
?>           
               </table>
             </div>
<?php  
          }  // Fin del if ( $mes_ano_saldo[3] == "0" && $$mes_ano_saldo[4] == "0"  )  { 
	    
	   }
	   /****************************************************
	   *        CASO 2. MÓDULO CUENTAS X COBRAR.           *
	   *****************************************************/
	     else if ( isset($_GET['cxc']) && $_GET['cxc'] == 2 )  {
		   /**************************************************
		    *  c) Imprimir Cuentas X Cobrar del mes actual.  *         
		    **************************************************/
		    $cuentas_x_cobrar_register = cuentas_x_cobrar_mes_actual();   // Datos de la TABLA a mostrar.
	        if ( $cuentas_x_cobrar_register[0]['exist'] == "no" )  {
?>		 
                <div class="message_wrong_print"> No existen CUENTAS POR COBRAR en la Base de Datos para el mes actual</div> 
<?php	 
			}  else  {   
?>                              
                 <!-- **********************************************************************************************
                                   TABLA CON TODOS LOS REGISTROS/LOS REGISTROS DE ESTE MES 
                     ********************************************************************************************** -->
       
                <table class="print_table" cellspacing="0" cellpadding="0">
                 <tr >
                   <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE REGISTROS DE CUENTAS POR COBRAR    </th>
                 </tr >
                 <tr>   
                   <th style="width: 4%; min-width:30px;"> id </th>
                   <th style="width: 8%; min-width:70px;"> FECHA REG. </th>
                   <th style="width: 9%; min-width:75px;"> FECHA VENC. </th>
                   <th style="width: 4%; min-width:33px;"> # VTA. </th>
                   <th style="width: 4%; min-width:32px;"> idL </th>
                   <th style="width: 22%;"> CLIENTE </th>
                   <th style="width: 22%;"> DETALLE </th>
                   <th style="width: 9%; min-width:70px;"> TOTAL </th>
                   <th style="width: 9%; min-width:70px;"> COBRADO </th>
                   <th style="width: 9%; min-width:70px;"> SALDO </th>
                 </tr>
                </table> 
    
                <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php	
	               for ( $i=1; $i < count($cuentas_x_cobrar_register); $i++ )
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
			            echo "<td style=\"width: 4%; min-width:30px; ".$style." \" >".$cuentas_x_cobrar_register[$i]['id']."</td>"; 
			            echo "<td style=\"width: 8%; min-width:65px; ".$style."\">".stripslashes($cuentas_x_cobrar_register[$i]['fecha_registro'])."</td>";		     
			            $fecha_actual = stripslashes($cuentas_x_cobrar_register[$i]['fecha_vencimiento']);
			 			 
			            if ( $fecha_actual == $fecha && (stripslashes($cuentas_x_cobrar_register[$i]['saldo']) != "0.00")  )  {
			                // Esto es para colorear de AZUL la fecha de vencimiento si se vence HOY.	 
				            $style_today = "color: #D40000; text-decoration: blink underline; ";
		                    $mensaje_usuario = "title=\"Por cancele este registro que tiene como fecha de vencimiento el d&iacute;a de HOY. GRACIAS\"";
			            } else {
				            // No lo pone de ningun color.
				            $style_today = "";
				            $mensaje_usuario = "";
		                }
			 		 
			            echo "<td ".$mensaje_usuario." style=\"width: 9%; min-width:70px; ".$style_today." ".$style." \" >".stripslashes($cuentas_x_cobrar_register[$i]['fecha_vencimiento'])."</td>";
			            // Esto es para que no se muestre el número de venta si este es 0 (Se ha entrado por formulario) 
			            if ( $cuentas_x_cobrar_register[$i]['no_venta'] == "0" )  {
			                $no_venta = "";
			            } else {
			                $no_venta = $cuentas_x_cobrar_register[$i]['no_venta'];
			            }
						echo "<td style=\"width: 4%; text-align: center; min-width:30px; ".$style." \" >".$no_venta."</td>";
			            // Esto es para que no se muestre el local si este es 1 (Se ha entrado por formulario) 
			            if ( $cuentas_x_cobrar_register[$i]['local_venta'] == "1" )  {
			                $local_venta = "";
			            } else {
			                $local_venta = $cuentas_x_cobrar_register[$i]['local_venta'];
			            }
						echo "<td style=\"width:4%; min-width:30px; ".$style." text-align: center; \" title=\"Almac&eacute;n ".stripslashes($cuentas_x_cobrar_register[$i]['nombre_local']).".\">".$local_venta."</td>";
			            echo "<td style=\"width: 22%; text-align: left; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['nombre'])."</td>";
		                echo "<td style=\"width: 22%; text-align: left; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['detalle_registro'])."</td>";
			            echo "<td style=\"width: 9%; min-width:65px; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['valor_deuda'])."</td>";
			            echo "<td style=\"width: 9%; min-width:65px; ".$style." \" >".stripslashes($cuentas_x_cobrar_register[$i]['valor_ingresado'])."</td>";
			            echo "<td style=\"width: 9%; min-width:65px; ".$style." \">".stripslashes($cuentas_x_cobrar_register[$i]['saldo'])."</td>";
		               echo "</tr>";
		           }  // Fin del for
?>           
               </table>
<?php   
           } // Fin del if ( $cuentas_x_cobrar_register[0]['exist'] == "no" )  {
     
	   } else if ( isset($_GET['cxc']) && $_GET['cxc'] == 1 )  {
		   /*********************************************************
		    *  d) Imprimir Cuentas X Cobrar de un mes seleccionado. *         
		    *********************************************************/
		    $mes_ano_cxcobrar = process_form_mesano_cxc($_GET['mes'],$_GET['y']);   // Datos de la TABLA a mostrar.
	        // COMPRUEBO PARA CUANDO NO EXISTEN REGISTROS DEL MES SOLICITADO 
	        if ( $mes_ano_cxcobrar[2] === "ningun_registro" )  {
               
?>	      
                <div class="message_wrong_print"> NO EXISTEN REGISTROS PARA EL MES SOLICITADO. GRACIAS </div>
<?php		  
	
	        } else {
               // EN ESTE CASO EXISTEN REGISTROS DEL MES SOLICITADO 
?>  
	           <!-- TABLA CON EL SALDO DEL MES ANTERIOR AL SOLICITADO -->
               <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:70%;">
                <tr>    
                  <td style="width: 80%; color: white; background-color:#056AA8; font-size:0.8em;">  Total del valor pendiente en el mes de <?php echo $mes_ano_cxcobrar[0]; ?> del a&ntilde;o <?php echo $mes_ano_cxcobrar[1]; ?> </td>
                  <td style="width: 20%; font-size:0.8em;"> <?php echo $mes_ano_cxcobrar[2]; ?>  </td>
                </tr>
              </table>

              <!-- TABLA CON LOS REGISTROS DEL MES SOLICITADO  -->
              <div style="margin-top: 20px; width:100%;">
              <table class="print_table" cellspacing="0" cellpadding="0">
                <tr >
                  <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE REGISTROS DE CUENTAS POR COBRAR    </th>
                </tr>
                <tr >
                  <th style="width: 4%; min-width:30px;"> id </th>
                  <th style="width: 8%; min-width:70px;"> FECHA REG. </th>
                  <th style="width: 9%; min-width:75px;"> FECHA VENC. </th>
                  <th style="width: 4%; min-width:33px;"> # VTA. </th>
                  <th style="width: 4%; min-width:32px;"> idL </th>
                  <th style="width: 22%;"> CLIENTE </th>
                  <th style="width: 22%;"> DETALLE </th>
                  <th style="width: 9%; min-width:70px;"> TOTAL </th>
                  <th style="width: 9%; min-width:70px;"> COBRADO </th>
                  <th style="width: 9%; min-width:70px;"> SALDO </th>
                </tr>
               </table> 

               <table class="print_table" cellspacing="0" cellpadding="0"> 
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
			           echo "<td style=\"width:4%; min-width:30px; ".$style." \" >".$mes_ano_cxcobrar[$i]['id']."</td>"; 
			           echo "<td style=\"width:8%; min-width:65px; ".$style." \" >".stripslashes($mes_ano_cxcobrar[$i]['fecha_registro'])."</td>";
		               echo "<td style=\"width:9%; min-width:70px; ".$style." \" >".stripslashes($mes_ano_cxcobrar[$i]['fecha_vencimiento'])."</td>";
			           // Esto es para que no se muestre el número de venta si este es 0 (Se ha entrado por formulario) 
			               if ( $mes_ano_cxcobrar[$i]['no_venta'] == "0" )  {
			                   $no_venta = "";
			               } else {
			                   $no_venta = $mes_ano_cxcobrar[$i]['no_venta'];
			               }
					   echo "<td style=\"width:4%; min-width:30px; ".$style." text-align: center; \">".$no_venta."</td>";
			           // Esto es para que no se muestre el local si este es 1 (Se ha entrado por formulario) 
			               if ( $mes_ano_cxcobrar[$i]['local_venta'] == "1" )  {
			                   $local_venta = "";
			               } else {
			                   $local_venta = $mes_ano_cxcobrar[$i]['local_venta'];
			               } 
					   echo "<td style=\"width:4%; font-size:0.9em; min-width:30px; ".$style." text-align: center; \" title=\"Almac&eacute;n ".stripslashes($mes_ano_cxcobrar[$i]['nombre_local']).".\">".$local_venta."</td>";
					   echo "<td style=\"width:22%; text-align: left; ".$style." \">".stripslashes($mes_ano_cxcobrar[$i]['nombre'])."</td>";
		               echo "<td style=\"width:22%; text-align: left; ".$style." \">".stripslashes($mes_ano_cxcobrar[$i]['detalle_registro'])."</td>";
			           echo "<td style=\"width:9%; min-width:65px; ".$style." \">".stripslashes($mes_ano_cxcobrar[$i]['valor_deuda'])."</td>";
			           echo "<td style=\"width:9%; min-width:65px; ".$style." \" >".stripslashes($mes_ano_cxcobrar[$i]['valor_ingresado'])."</td>";
			           echo "<td style=\"width:9%; min-width:65px; ".$style." \">".stripslashes($mes_ano_cxcobrar[$i]['saldo'])."</td>";
		             echo "</tr>";
		          }  // Fin del for
?>               
                </table>
              </div>  <!-- FIN DEL <div style="margin-top: 20px; width:100%;">  -->
<?php
	       }  // Fin del if ( $mes_ano_cxcobrar[2] == "ningun_registro" )  {
	     
	   }
	     /*****************************************************
	      *        CASO 3. MÓDULO CUENTAS X PAGAR.            *
	      *****************************************************/
	      else if ( isset($_GET['cxp']) && $_GET['cxp'] == 2 )  {
		    /*****************************************************
		    *  e) Imprimir Cuentas X Pagar del mes actual.       *         
		    ******************************************************/
		    $cuentas_x_pagar_register = cuentas_x_pagar_mes_actual();   // Datos de la TABLA a mostrar.
	        if ( $cuentas_x_pagar_register[0]['exist'] == "no" )  {
?>		 
                <div class="message_wrong_print"> No existen CUENTAS POR PAGAR en la Base de Datos para el mes actual</div> 
<?php	 
	        }  else  {   
?>                      
                        <!-- **********************************************************************************************
                                            TABLA CON TODOS LOS REGISTROS/LOS REGISTROS DE ESTE MES 
                             ********************************************************************************************** -->
             
                  <table class="print_table" cellspacing="0" cellpadding="0">
                   <tr >
                     <th style="width:100%; color:gray; background-color:#F2F2F2; font-size:0.7em;" colspan="100"> TABLA DE REGISTROS DE CUENTAS POR PAGAR</th>
                  </tr>
                  <tr >
                     <th style="width: 3%;"> id </th>
                     <th style="width: 8%; min-width:70px;"> FECHA REG. </th>
                     <th style="width: 8%; min-width:75px;"> FECHA VENC. </th>
                     <th style="width: 6%; min-width:33px;"> # CMP. </th>
                     <th style="width: 23%;"> PROVEEDOR </th>
                     <th style="width: 23%;"> DETALLE </th>
                     <th style="width: 10%; min-width:70px;"> TOTAL </th>
                     <th style="width: 10%; min-width:70px;"> ABONADO </th>
                     <th style="width: 9%; min-width:70px;"> SALDO </th>
                  </tr>
                 </table> 
               
                 <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php	
	
 	             for ( $i=1; $i < count($cuentas_x_pagar_register); $i++ )
	             {
			          // Esto es para marcar en ROJO los que hayan sido afectados 
			          if ( $cuentas_x_pagar_register[$i]['fin_registro'] == "1" )  {
			             $style = "color: blue; text-decoration: none;";
				         $accion = "Ver";
			          } else {
			             $style = "";
				         $accion = "Editar";	 
			          }
			 					 
			          //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			          echo "<tr>";
			            echo "<td style=\"width: 3%; ".$style." \" >".$cuentas_x_pagar_register[$i]['id']."</td>"; 
			            echo "<td style=\"width: 8%; min-width:65px; ".$style." \" >".stripslashes($cuentas_x_pagar_register[$i]['fecha_registro'])."</td>";
		                $fecha_actual = stripslashes($cuentas_x_pagar_register[$i]['fecha_vencimiento']);
			 			 
			            if ( $fecha_actual == $fecha && stripslashes($cuentas_x_pagar_register[$i]['saldo']) != "0.00" )  {
			                // Esto es para colorear de AZUL la fecha de vencimiento si se vence HOY.	 
				            $style_today = "color: #D40000; text-decoration: blink underline; ";
		                    $mensaje_usuario = "title=\"Por cancele este registro que tiene como fecha de vencimiento el d&iacute;a de HOY. GRACIAS\"";
			            } else {
				            // No lo pone de ningun color.
				            $style_today = "";
				            $mensaje_usuario = "";
		                }
			 
			            echo "<td ". $mensaje_usuario." style=\"width: 8%; min-width:70px; ".$style_today." ".$style." \" >".stripslashes($cuentas_x_pagar_register[$i]['fecha_vencimiento'])."</td>";
			            echo "<td style=\"width: 6%; text-align: center; min-width:30px; ".$style." \" >".$cuentas_x_pagar_register[$i]['no_orden_de_compra']."</td>";
			            echo "<td style=\"width: 23%; text-align: left; ".$style." \">".stripslashes($cuentas_x_pagar_register[$i]['nombre'])."</td>";
		                echo "<td style=\"width: 23%; text-align: left; ".$style." \">".stripslashes($cuentas_x_pagar_register[$i]['detalle_registro'])."</td>";
			            echo "<td style=\"width: 10%; min-width:65px; ".$style." \">".stripslashes($cuentas_x_pagar_register[$i]['valor_abono'])."</td>";
			            echo "<td style=\"width: 10%; min-width:65px; ".$style." \" >".stripslashes($cuentas_x_pagar_register[$i]['valor_abonado'])."</td>";
			            echo "<td style=\"width: 9%; min-width:65px; ".$style." \">".stripslashes($cuentas_x_pagar_register[$i]['saldo'])."</td>";
		              echo "</tr>";
		         }  // Fin del for
?>           
                 </table>
<?php   
              } // Fin del if ( $cuentas_x_pagar_register[0]['exist'] == "no" )  {
	   
	  
	   
	   } else if ( isset($_GET['cxp']) && $_GET['cxp'] == 1 )  {
		   //f) Imprimir Cuentas X Pagar de un mes seleccionado.
	       
	       $mes_ano_cxpagar = process_form_mesano_cxp($_GET['mes'],$_GET['y']);   // Datos de la TABLA a mostrar.
	       // COMPRUEBO PARA CUANDO NO EXISTEN REGISTROS DEL MES SOLICITADO 
	       if ( $mes_ano_cxpagar[2] === "ningun_registro" )  {
?>	      
               <div class="message_wrong_print"> NO EXISTEN REGISTROS PARA EL MES SOLICITADO. GRACIAS </div>
<?php		  
	       } else {
                // EN ESTE CASO EXISTEN REGISTROS DEL MES SOLICITADO 
?>        
                <!-- TABLA CON EL SALDO DEL MES ANTERIOR AL SOLICITADO -->
                <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:70%;">
                 <tr>    
                   <td style="width: 80%; color: white; background-color:#056AA8; font-size:0.8em;">  Total del valor pendiente en el mes de <?php echo $mes_ano_cxpagar[0]; ?> del a&ntilde;o <?php echo $mes_ano_cxpagar[1]; ?> </td>
                   <td style="width: 20%; font-size:0.8em;"> <?php echo $mes_ano_cxpagar[2]; ?>  </td>
                 </tr>
                </table>

                <!-- TABLA CON LOS REGISTROS DEL MES SOLICITADO  -->
                <div style="margin-top: 20px; width:100%;">
                <table class="print_table" cellspacing="0" cellpadding="0">
                  <tr >
                    <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="10"> TABLA DE REGISTROS DE CUENTAS POR PAGAR    </th>
                  </tr>
                  <tr >
                    <th style="width: 3%;"> id </th>
                    <th style="width: 8%; min-width:70px;"> FECHA REG. </th>
                    <th style="width: 8%; min-width:75px;"> FECHA VENC. </th>
                    <th style="width: 6%; min-width:33px;"> # CMP. </th>
                    <th style="width: 23%;"> PROVEEDOR </th>
                    <th style="width: 23%;"> DETALLE </th>
                    <th style="width: 10%; min-width:70px;"> TOTAL </th>
                    <th style="width: 10%; min-width:70px;"> ABONADO </th>
                    <th style="width: 9%; min-width:70px;"> SALDO </th>
                  </tr>
                </table> 
 
                <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                for ( $i=3; $i < count($mes_ano_cxpagar); $i++ )
		        {
			         // Esto es para marcar en ROJO los que hayan sido afectados 
			         if ( $mes_ano_cxpagar[$i]['fin_registro'] == "1" )  {
			             $style = "color: blue;";
					     $accion = "Ver";
			         } else {
			             $style = "";
					     $accion = "Editar";	 
			         }
			 
			      //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			      echo "<tr>";
			         echo "<td style=\"width: 3%; ".$style." \" >".$mes_ano_cxpagar[$i]['id']."</td>"; 
			         echo "<td style=\"width: 8%; min-width:65px; ".$style." \" >".stripslashes($mes_ano_cxpagar[$i]['fecha_registro'])."</td>";
		             echo "<td style=\"width: 8%; text-align: center; min-width:70px; ".$style." \" >".stripslashes($mes_ano_cxpagar[$i]['fecha_vencimiento'])."</td>";
			         echo "<td style=\"width: 6%; text-align: center; min-width:30px; ".$style." \" >".$mes_ano_cxpagar[$i]['no_orden_de_compra']."</td>";
					 echo "<td style=\"width: 23%; text-align: left; ".$style." \">".stripslashes($mes_ano_cxpagar[$i]['nombre'])."</td>";
		             echo "<td style=\"width: 23%; text-align: left; ".$style." \">".stripslashes($mes_ano_cxpagar[$i]['detalle_registro'])."</td>";
			         echo "<td style=\"width: 10%; min-width:65px; ".$style." \">".stripslashes($mes_ano_cxpagar[$i]['valor_abono'])."</td>";
			         echo "<td style=\"width: 10%; min-width:65px; ".$style." \" >".stripslashes($mes_ano_cxpagar[$i]['valor_abonado'])."</td>";
			         echo "<td style=\"width: 8%; min-width:65px; ".$style." \">".stripslashes($mes_ano_cxpagar[$i]['saldo'])."</td>";
		             echo "</tr>";
		      } // Fin del for
?>           
            </table>
           </div>  <!-- FIN DEL <div style="margin-top: 20px; width:100%;">  -->
<?php
	     }  // Fin del if ( $mes_ano_cxpagar[2] == "ningun_registro" )  {
	     
	   }
        /************************************************
	     *        CASO 4. MÓDULO PROVEEDORES.           *
	     ************************************************/
	     else if ( isset($_GET['pro']) && $_GET['pro'] == 1 )  {
		   /******************************************************
		    *  g) Imprimir todos los Proveedores de la BD.       *         
		    ******************************************************/
			//01 BUSCO LOS DATOS DE TODOS LOS PROVEEDORES DEL CLIENTE
            $proveedores_ds = proveedores_del_sistema(); 
	        if ( $proveedores_ds == "null" )  {
?>		 
                <div class="message_wrong_print"> No existen PROVEEDORES en la Base de Datos </div> 
<?php	 
	        }  else  { 
?>       
             <!-- ********************************************************************************************
                          TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS PROVEEDORES" 
                  ******************************************************************************************* -->
      
             <!-- TABLA CON LOS REGISTROS DE LOS PROVEEDORES  -->
             <div style="width:100%;">
              <table class="print_table" cellspacing="0" cellpadding="0">
               <tr >
                  <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="6"> TABLA DE PROVEEDORES </th>
               </tr>
               <tr >
                  <th style="width: 3%;"> # </th>
                  <th style="width: 8%; min-width:70px;"> FECHA REG. </th>
                  <th style="width: 20%; min-width:100px;"> NOMBRE </th>
                  <th style="width: 25%; min-width:120px;"> DIRECCI&Oacute;N </th>
                  <th style="width: 9%; min-width:70px;"> TELE&Eacute;FONO </th>
                  <th style="width: 35%;"> DESCRIPCI&Oacute;N </th>
                </tr>
               </table> 
       
              <form name="proveedores_radios" action="" method="post"  >
               <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                 for ( $i=0; $i < count($proveedores_ds); $i++ )
		         {
			            //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			         echo "<tr>";
			           echo "<td style=\"width: 3%;\">".($i + 1)."</td>"; 
			           echo "<td style=\"width: 8%; min-width:65px; \"> ".stripslashes($proveedores_ds[$i]['fecha_registro'])."</td>"; 
			           echo "<td style=\"width: 20%; text-align: left; min-width:100px; \" >".stripslashes($proveedores_ds[$i]['nombre'])."</td>";
		               echo "<td style=\"width: 25%; text-align: left; min-width:120px; \" >".stripslashes($proveedores_ds[$i]['direccion'])."</td>";
			           echo "<td style=\"width: 9%; min-width:70px;  \">".stripslashes($proveedores_ds[$i]['telefono'])."</td>";
		               echo "<td style=\"width: 35%; text-align: left;\">".stripslashes($proveedores_ds[$i]['descripcion'])."</td>";
		             echo "</tr>";
		         }
?>         
               </table>
              </form>     
            </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS PROVEEDORES  -->
<?php	 
	        }  // Fin del  if ( $proveedores_ds == "null" )  {

	  } else if ( isset($_GET['pro']) && $_GET['pro'] == 2 )  {
		 /*****************************************************************
		  *  h) Imprimir los datos del Proveedor seleccionado en la BD.   *         
		  *****************************************************************/
          $ver_proveedor = ver_proveedor($_GET['id']);                        // DEVUELVE LOS DATOS DEL PROVEEDOR.
          $ver_contactos_proveedor = ver_contactos_proveedor();               // DEVUELVE LOS CONTACTOS DE ESE PROVEEDOR.
?>	      
		  <!-- TABLA CON EL SALDO DEL MES ANTERIOR AL SOLICITADO -->
               <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:100%; float:left;">
                 <tr>    
                   <td style="width:20%; color:white; background-color:#056AA8; font-size:0.8em;"> Nombre del Proveedor </td>
                   <td style="width:80%; font-size:0.8em; text-align:left; background-color:#FFF;"> <?php echo stripslashes($ver_proveedor['nombre']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  Fecha de Registro </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_proveedor['fecha_registro']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  Direcci&oacute;n </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_proveedor['direccion']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  Fax </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_proveedor['fax']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  Tel&eacute;fono </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_proveedor['telefono']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  RUC </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_proveedor['ruc']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  C&eacute;dula </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_proveedor['cedula']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;"> Email </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_proveedor['email']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;"> Descripci&oacute;n</td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_proveedor['descripcion']); ?> </td>
                 </tr>
               </table>
<?php	 	 
	            /********* CONTACTOS DEL PROVEEDOR *********/
				if ( $ver_contactos_proveedor == "null" )   {
                    // ESTO SIGNIFICA QUE NO EXISTEN CONTACTOS PARA ESE PROVEEDOR
?>		
                    <div class="message_wrong_print"> No existen CONTACTOS para este PROVEEDOR en la Base de Datos </div> 
<?php
                }  else  {     
                     // APARECE LA TABLA CUANDO HAY CONTACTOS
?>                   <!-- ********************************************************************************************
                            TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS CONTACTOS DE LOS PROVEEDORES" 
                           ******************************************************************************************* -->
       
                     <!-- TABLA CON LOS REGISTROS DE LOS PROVEEDORES  -->
                     <div style="width:100%; margin-top:20px;">
                     <table class="print_table" cellspacing="0" cellpadding="0">
                       <tr >
                          <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="7"> TABLA DE CONTACTOS </th>
                       </tr> 
                       <tr >
                         <th style="width: 3%;"> # </th>
                         <th style="width: 32%;"> NOMBRE </th>
                         <th style="width: 10%; min-width:70px;"> TEL&Eacute;FONO </th>
                         <th style="width: 10%; min-width:70px;"> CELULAR </th>
                         <th style="width: 10%; min-width:70px;"> FAX </th>
                         <th style="width: 25%; min-width:100px;"> EMAIL </th>
                         <th style="width: 10%; min-width:70px;"> C&Eacute;DULA </th>
                       </tr>
                     </table> 
       
                     <form name="proveedores_radios" action="" method="post"  >
                     <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                        for ( $i=0; $i < count($ver_contactos_proveedor); $i++ )
		                {
			                  //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			                echo "<tr>";
			                  echo "<td style=\"width: 3%;\">".($i+1)."</td>"; 
			                  echo "<td style=\"width: 32%; text-align: left;\" >".stripslashes($ver_contactos_proveedor[$i]['nombre_contacto'])."</td>";
		                      echo "<td style=\"width: 10%; min-width:70px; \" >".stripslashes($ver_contactos_proveedor[$i]['telefono_contacto'])."</td>";
			                  echo "<td style=\"width: 10%; min-width:70px;  \">".stripslashes($ver_contactos_proveedor[$i]['cell_contacto'])."</td>";
		                      echo "<td style=\"width: 10%; min-width:70px;  \">".stripslashes($ver_contactos_proveedor[$i]['fax_contacto'])."</td>";
			                  echo "<td style=\"width: 25%; min-width:100px;  \">".stripslashes($ver_contactos_proveedor[$i]['email_contacto'])."</td>";
		                      echo "<td style=\"width: 10%; min-width:70px;  \">".stripslashes($ver_contactos_proveedor[$i]['cedula_contacto'])."</td>";
			                echo "</tr>";
		                 }
?>         
                      </table>
                      </form>     
                      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS PROVEEDORES  -->
<?php
	
	              }  // fin del else del if ( $ver_contactos_proveedor == "null" )   {

	   }
	    /************************************************
	     *        CASO 5. MÓDULO CLIENTES.           *
	     ************************************************/
	     else if ( isset($_GET['cli']) && $_GET['cli'] == 1 )  {
		   /******************************************************
		    *  i) Imprimir todos los Clientes de la BD.       *         
		    ******************************************************/
			//01 BUSCO LOS DATOS DE TODOS LOS CLIENTES DEL CLIENTE
            $clientes_ds = clientes_del_sistema(); 
	        if ( $clientes_ds == "null" )  {
?>		 
                <div class="message_wrong_print"> No existen CLIENTES en la Base de Datos </div> 
<?php	 
	        }  else  {
?>     
                 <!-- ********************************************************************************************
                               TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS CLIENTES" 
                      ******************************************************************************************* -->
      
                 <!-- TABLA CON LOS REGISTROS DE LOS CLIENTES  -->
                 <div style="width:100%;">
                 <table class="print_table" cellspacing="0" cellpadding="0">
                  <tr >
                     <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="6"> TABLA DE CLIENTES </th>
                  </tr>      
                  <tr >
                    <th style="width: 3%;"> # </th>
                      <th style="width: 8%; min-width:70px;"> FECHA REG. </th>
                      <th style="width: 20% min-width:100px;;"> NOMBRE </th>
                      <th style="width: 25%; min-width:120px;"> DIRECCI&Oacute;N </th>
                      <th style="width: 9%; min-width:70px;"> TELE&Eacute;FONO </th>
                      <th style="width: 35%;"> DESCRIPCI&Oacute;N </th>
                    </tr>
                 </table> 
                 <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                   for ( $i=0; $i < count($clientes_ds); $i++ )
		           {
			             //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			            echo "<tr>";
			              echo "<td style=\"width: 3%;\">".($i + 1)."</td>"; 
			              echo "<td style=\"width: 8%; min-width:65px; \"> ".stripslashes($clientes_ds[$i]['fecha_registro'])."</td>"; 
			              echo "<td style=\"width: 20%; min-width:100px; text-align: left; \" >".stripslashes($clientes_ds[$i]['nombre'])."</td>";
		                  echo "<td style=\"width: 25%; min-width:120px; text-align: left;\" >".stripslashes($clientes_ds[$i]['direccion'])."</td>";
			              echo "<td style=\"width: 9%; min-width:70px;  \">".stripslashes($clientes_ds[$i]['telefono'])."</td>";
		                  echo "<td style=\"width: 35%; text-align: left; \">".stripslashes($clientes_ds[$i]['descripcion'])."</td>";
		                echo "</tr>";
		           }
?>         
                 </table>
                 </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
<?php	 
	          }  // Fin del  if ( $clientes_ds == "null" )  {
	  
	  } else if ( isset($_GET['cli']) && $_GET['cli'] == 2 )  {
		 /*****************************************************************
		  *  j) Imprimir los datos del Cliente seleccionado en la BD.   *         
		  *****************************************************************/
	      $ver_cliente = ver_cliente($_GET['id']);             // DEVUELVE LOS DATOS DEL CLIENTE.
          $ver_contactos_cliente = ver_contactos_cliente();    // DEVUELVE LOS CONTACTOS DE ESE CLIENTE.
?>	      
		  <!-- TABLA CON LOS DATOS DEL CLIENTE -->
               <table class="table_mes_anterior" cellspacing="0" cellpadding="0" style="width:100%; float:left;">
                 <tr>    
                   <td style="width:20%; color:white; background-color:#056AA8; font-size:0.8em;"> Nombre del Cliente </td>
                   <td style="width:80%; font-size:0.8em; text-align:left; background-color:#FFF;"> <?php echo stripslashes($ver_cliente['nombre']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  Fecha de Registro </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_cliente['fecha_registro']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  Direcci&oacute;n </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_cliente['direccion']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  Fax </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_cliente['fax']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  Tel&eacute;fono </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_cliente['telefono']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  RUC </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_cliente['ruc']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;">  C&eacute;dula </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_cliente['cedula']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;"> Email </td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_cliente['email']); ?> </td>
                 </tr>
                 <tr>    
                   <td style="width: 20%; color: white; background-color:#056AA8; font-size:0.8em;"> Descripci&oacute;n</td>
                   <td style="width: 80%; background-color:#FFF; font-size:0.8em; text-align:left;"> <?php echo stripslashes($ver_cliente['descripcion']); ?> </td>
                 </tr>
               </table>
<?php	 	 
	         /********* CONTACTOS DEL CLIENTE *********/
			 if ( $ver_contactos_cliente == "null" )   {
                 // ESTO SIGNIFICA QUE NO EXISTEN CONTACTOS PARA ESE PROVEEDOR
?>		
                 <div class="message_wrong_print"> No existen CONTACTOS para este PROVEEDOR en la Base de Datos </div> 
<?php
             }  else  {     
                     // APARECE LA TABLA CUANDO HAY CONTACTOS
?>                   <!-- ********************************************************************************************
                            TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS CONTACTOS DE LOS CLIENTES" 
                           ******************************************************************************************* -->
       
                  <!-- TABLA CON LOS REGISTROS DE LOS CONTACTOS DEL CLIENTE  -->
                  <div style="width:100%; margin-top:20px;">
                  <table class="print_table" cellspacing="0" cellpadding="0">
                    <tr >
                       <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="7"> TABLA DE CONTACTOS </th>
                    </tr> 
                    <tr >
                      <th style="width: 3%;"> # </th>
                      <th style="width: 32%;"> NOMBRE </th>
                      <th style="width: 10%; min-width:70px;"> TEL&Eacute;FONO </th>
                      <th style="width: 10%; min-width:70px;"> CELULAR </th>
                      <th style="width: 10%; min-width:70px;"> FAX </th>
                      <th style="width: 25%; min-width:100px;"> EMAIL </th>
                      <th style="width: 10%; min-width:70px;"> C&Eacute;DULA </th>
                    </tr>
                   </table> 
                   <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                     for ( $i=0; $i < count($ver_contactos_cliente); $i++ )
		             {
			             //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			             echo "<tr>";
			               echo "<td style=\"width: 3%;\">".($i+1)."</td>"; 
			               echo "<td style=\"width: 32%; text-align: left;\" >".stripslashes($ver_contactos_cliente[$i]['nombre_contacto'])."</td>";
		                   echo "<td style=\"width: 10%; min-width:70px; \" >".stripslashes($ver_contactos_cliente[$i]['telefono_contacto'])."</td>";
			               echo "<td style=\"width: 10%; min-width:70px;  \">".stripslashes($ver_contactos_cliente[$i]['cell_contacto'])."</td>";
		                   echo "<td style=\"width: 10%; min-width:70px;  \">".stripslashes($ver_contactos_cliente[$i]['fax_contacto'])."</td>";
			               echo "<td style=\"width: 25%; min-width:100px;  \">".stripslashes($ver_contactos_cliente[$i]['email_contacto'])."</td>";
		                   echo "<td style=\"width: 10%; min-width:70px;  \">".stripslashes($ver_contactos_cliente[$i]['cedula_contacto'])."</td>";
			             echo "</tr>";
		             }
?>         
                   </table>
                   </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS PROVEEDORES  -->
<?php
	          }  // fin del else del if ( $ver_contactos_proveedor == "null" )   {
	  
	   }
	    /************************************************
	     *        CASO 6. MÓDULO COMPRAS.               *
	     ************************************************/
	     else if ( isset($_GET['cmp']) && $_GET['cmp'] == 1 )  {
		   /****************************************************************
		    *  j) Imprimir todas las Compras entre 2 fechas determinadas.  *         
		    ****************************************************************/
			//01 BUSCO LOS DATOS PRINCIPALES DE TODAS LAS COMPRAS ENTRE ESAS DOS FECHAS	  
	        $resumen_compras = charge_compras(-1);
	  	  
	         /******************************************************************************************************** 
                                                 TABLA DE LISTADO DE COMPRAS E/ 2 FECHAS
             *******************************************************************************************************/
            if ( $resumen_compras == "vacio" )  {
	              // Esto es cuando no existe ninguna compra registrada en las Bases de Datos.
?>	      
                  <div class="message_wrong_print" style="margin:10px 0px 10px 0; width:99.4%;"> En la Base de Datos no hay registrada ninguna Compra entre las dos fechas. </div> 
  
<?php   
            } else {
                  // Hay compras registradas en la BD entre esas dos fechas.
?>                       
	              <div style="margin-top: 20px; width:100%;"> <!-- div DE LA TABLA LISTADO DE COMPRAS  -->
                  <table class="print_table" cellspacing="0" cellpadding="0">
                    <tr >
                      <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE COMPRAS </th>
                    </tr>
                    <tr >
                      <th title="N&uacute;mero de Compra"  style="width: 4%; min-width:21px;"> # </th>
                      <th style="width: 9%; min-width:50px;"> FECHA </th>
                      <th style="width: 27%; min-width:110px;"> PROVEEDOR </th>
                      <th style="width: 10%; min-width:80px;"> No. de FACTURA </th>
                      <th style="width: 10%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
                      <th style="width: 10%; min-width:80px;"> FORMA DE PAGO </th>
                      <th style="width: 10%; min-width:80px;"> MONTO </th> 
                      <th style="width: 10%; min-width:80px;"> DESCUENTO </th>
                      <th style="width: 10%; min-width:80px;"> PAGADO </th>   
                   </tr>
                 </table>  
	             
                  <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                   for ( $i=0; $i < count($resumen_compras); $i++ )
		           {
			           //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		               echo "<tr>";
			             echo "<td style=\"width: 4%; min-width:21px; \">".$resumen_compras[$i]['numero_compra']."</td>"; 
			             echo "<td style=\"width:9%; min-width:50px; font-size: 0.9em;\"> ".stripslashes($resumen_compras[$i]['fecha_compra'])."</td>"; 
			 		 
			             echo "<td style=\"width: 27%; min-width:110px; text-align: left; font-size: 0.9em;\" >".stripslashes($resumen_compras[$i]['nombre'])."</td>";
		     
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \" >".stripslashes($resumen_compras[$i]['numero_factura'])."</td>";
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['cantidad_articulos'])."</td>";
		     		 
			             if ( $resumen_compras[$i]['forma_de_pago'] == "contado" )  {
				             $forma_pago = "Contado";
			             } else if ( $resumen_compras[$i]['forma_de_pago'] == "credito" )  {
			                 $forma_pago = "Cr&eacute;dito"; 
			             }
			 
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".$forma_pago."</td>";
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['monto_de_la_compra'])."</td>";
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['descuento'])."</td>";
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['valor_pagado_real'])."</td>";
			           echo "</tr>";
		            }
?>         
                    </table>
               </div>  <!-- Fin del div de la tabla listado de compras -->
	   
<?php      
		    }  // Fin del if ( $resumen_compras == "vacio" )  {  
	    
	   }
	      else if ( isset($_GET['cmp']) && $_GET['cmp'] == 2 )  {
		   /****************************************************************
		    *  k) Imprimir todas las Compras realizadas a un proveedor.    *         
		    ****************************************************************/
			//01 BUSCO LOS DATOS PRINCIPALES DE TODAS LAS COMPRAS ENTRE ESAS DOS FECHAS	  
	        $resumen_compras = charge_compras($_GET['id']);
	  	  
	         /******************************************************************************************************** 
                                           TABLA DE LISTADO DE COMPRAS A UN PROVEEDOR
             *******************************************************************************************************/

		    if ( $resumen_compras == "vacio" )  {
	            // Esto es cuando no existe ninguna compra registrada en las Bases de Datos del Proveedor Seleccionado.
?> 
                <div class="message_wrong_print" style="margin:10px 0px 10px 0; width:99.4%;"> En la Base de Datos no hay registrada ninguna Compra para el Proveedor Seleccionado. </div> 
  
<?php   
            } else {
                // Hay compras registradas en la BD para ese proveedor.
?> 	   
	            <div style="margin-top: 20px; width:100%;"> <!-- div DE LA TABLA LISTADO DE COMPRAS  -->
                  <table class="print_table" cellspacing="0" cellpadding="0">
                    <tr >
                      <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE COMPRAS </th>
                    </tr>
                    <tr >
                      <th title="N&uacute;mero de Compra"  style="width: 4%; min-width:21px;"> # </th>
                      <th style="width: 9%; min-width:50px;"> FECHA </th>
                      <th style="width: 27%; min-width:110px;"> PROVEEDOR </th>
                      <th style="width: 10%; min-width:80px;"> No. de FACTURA </th>
                      <th style="width: 10%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
                      <th style="width: 10%; min-width:80px;"> FORMA DE PAGO </th>
                      <th style="width: 10%; min-width:80px;"> MONTO </th> 
                      <th style="width: 10%; min-width:80px;"> DESCUENTO </th>
                      <th style="width: 10%; min-width:80px;"> PAGADO </th>   
                   </tr>
                 </table>  
	             
                  <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                   for ( $i=0; $i < count($resumen_compras); $i++ )
		           {
			           //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		               echo "<tr>";
			             echo "<td style=\"width: 4%; min-width:21px; \">".$resumen_compras[$i]['numero_compra']."</td>"; 
			             echo "<td style=\"width:9%; min-width:50px; font-size: 0.9em;\"> ".stripslashes($resumen_compras[$i]['fecha_compra'])."</td>"; 
			 		 
			             echo "<td style=\"width: 27%; min-width:110px; text-align: left; font-size: 0.9em;\" >".stripslashes($resumen_compras[$i]['nombre'])."</td>";
		     
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \" >".stripslashes($resumen_compras[$i]['numero_factura'])."</td>";
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['cantidad_articulos'])."</td>";
		     		 
			             if ( $resumen_compras[$i]['forma_de_pago'] == "contado" )  {
				             $forma_pago = "Contado";
			             } else if ( $resumen_compras[$i]['forma_de_pago'] == "credito" )  {
			                 $forma_pago = "Cr&eacute;dito"; 
			             }
			 
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".$forma_pago."</td>";
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['monto_de_la_compra'])."</td>";
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['descuento'])."</td>";
			             echo "<td style=\"width: 10%; min-width:80px; text-align: center; font-size: 0.9em; \">".stripslashes($resumen_compras[$i]['valor_pagado_real'])."</td>";
			           echo "</tr>";
		            }
?>         
                    </table>
               </div>  <!-- Fin del div de la tabla listado de compras -->
	   
<?php      
		    }  // Fin del if ( $resumen_compras == "vacio" )  {             
	   
	   }
	      /************************************************
	       *        CASO 7. MÓDULO CAJA.                  *
	       ************************************************/
	     else if ( isset($_GET['caj']) && $_GET['caj'] == 2 )  {
		   /****************************************************************
		    *    l) Imprimir las Cajas entre dos fechas seleccionadas.     *         
		    ****************************************************************/
			//01 BUSCO LOS DATOS PRINCIPALES DE TODOS LOS MOVIMIENTOS DE CAJA ENTRE ESAS DOS FECHAS.	  
	        $cajant = process_caja_anterior();   // Este me dá los detalles de las transacciones entre 2 fechas seleccionadas.
	  	    
	   
	        if ( isset($cajant))  {
		        // ESTO SIGNIFICA QUE SE ENVIARON LOS DATOS DE LA CONSULTA DEL FORMULARIO.
			
		        if ( $cajant == "null" )   {
			        //CASO 1. Esto significa que en el local seleccionado para ver la CAJA entre los días seleccionados no existe ningun registro.
?> 
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
                     <!-- ********************************************************************************************************************
                                  TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA DE LOS DÍAS SELECCIONADOS
                          ******************************************************************************************^*********************** -->
        
                     <div style="width:100%;">
                         <table class="print_table" cellspacing="0" cellpadding="0">
                           <tr >
                              <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="100"> TABLA DE CAJAS ANTERIORES </th>
                           </tr> 
                           <tr >
                              <th style="width: 4%; min-width: 24px;"> # </th>
                              <th style="width: 6%; min-width: 40px;"> FECHA </th>
                              <th style="width: 11%; min-width: 60px;"> TIPO TRANSACCI&Oacute;N </th>
                              <th style="width: 18%; min-width:80px;"> ORIGEN </th>
                              <th style="width: 18%; min-width:80px;"> DESTINO </th>
                              <th style="width: 18%; min-width:80px;"> OBSERVACIONES </th>
                              <th style="width: 6%; min-width:80px;"> 
                              <?php
			                     // Este campo depende de si el usuario es 'administrador' o 'vendedor'
			                     switch($_GET['id'])
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
                              <th style="width: 13%; min-width:80px;"> USUARIO </th>
                              <th style="width: 6%; min-width:60px;"> CANTIDAD </th>
                           </tr>
                        </table> 
       
                        <form name="caja_diaria" action="" method="post"  >
                        <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                           for ( $i=0; $i < count($cajant); $i++ )
		                   {
			                   //03 MUESTRO LA TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY 
                               echo "<tr>";
			                      echo "<td style=\"width: 4%; min-width: 24px;\">".($i+1)." <input type=\"hidden\" name=\"caja_id\" value=\"".$cajant[$i]['id']."\" /> </td>"; 
			                      echo "<td style=\"width: 6%; min-width:40px; \"> ".stripslashes($cajant[$i]['fecha_transaccion'])."</td>"; 
			                      echo "<td style=\"width: 11%; min-width:60px; \"> ".stripslashes($cajant[$i]['tipo_transaccion'])."</td>"; 
			                      echo "<td style=\"width: 18%; text-align: justify; min-width:80px; \" >".stripslashes($cajant[$i]['origen_transaccion'])."</td>";
		                          echo "<td style=\"width: 18%; text-align: justify; min-width:80px; \" >".stripslashes($cajant[$i]['destino_transaccion'])."</td>";
			                      echo "<td style=\"width: 18%; text-align: justify; min-width:80px; \" >".stripslashes($cajant[$i]['observaciones'])."</td>";
			                      // Este campo depende de si el usuario es 'administrador' o 'vendedor'
			                      switch($_GET['id'])
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
			                      echo "<td style=\"width: 6%; min-width:80px;  \">".$tipo_trans."</td>";
		                          echo "<td style=\"width: 13%; text-align: center; min-width:80px;  \">".stripslashes($cajant[$i]['persona_q_hace_transaccion'])."</td>";
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
			  	                  echo "<td style=\"width:6%; text-align:center; min-width:60px; color:".$color."\">".$cajant[$i]['cantidad_transaccion']."</td>";
			                   echo "</tr>";
		                 }  // Fin del for
?>         
                      </table>
                      </form>     
                   </div>  <!-- fin del <div> de la TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY -->
<?php
  		      }   // Fin del if ( $cajant == "null" )   {
           }   // Fin del if ( isset($cajant))  {
         	   
	   }
	      else if ( isset($_GET['caj']) && $_GET['caj'] == 1 )  {
		   /****************************************************************
		    *  m) Imprimir la Caja de Hoy.    *         
		    ****************************************************************/
			//01 BUSCO LOS DATOS DE LA CAJA DE HOY
	        $moneda_informes = charge_moneda();         // Cargo la moneda de los informes.
			
			if ( isset($_GET['view']) && $_GET['view'] == "princ" )  {
		         // CASO 1: PARA EL BOTÓN IMPRESIÓN DEL INICIO DEL MÓDULO.
			     $transacciones_caja = show_transacciones_caja(0);        // Muestra las transacciones que han habido en la caja el día de HOY.
	             $resumen_caja = show_resumen_caja(0);                    // Muestra todos lo relacionado con los datos del RESUMEN DE CAJA DEL DÍA.
            		
			} else if ( isset($_GET['view']) && $_GET['view'] == "sec" )  {
			     // CASO 2: PARA EL BOTÓN DE OMPRESIÓN EN EL BOTÓN DE CONSULTA "Caja Actual".
				 $transacciones_caja = show_transacciones_caja($_GET['id']);   // Muestra las transacciones que han habido en la caja el día de HOY.
	             $resumen_caja = show_resumen_caja($_GET['id']);               // Muestra todos lo relacionado con los datos del RESUMEN DE CAJA DEL DÍA.
			}
		     	 
			 /***************************************************************************************************** 
		                                   TABLA DEL RESUMEN DE CAJA
	          *****************************************************************************************************/
?>			  
            <table class="print_table" style="margin-bottom: 15px; width:50%;" cellspacing="0" cellpadding="0">
      
              <?php
                 				 
				 switch($_SESSION['tipo_usuario'])  // Esto es para poner "CAJA CENTRAL" ó "CAJA ALMACÉN"
		         {
		   	         case "a":  // CASO ADMINISTRADOR. 
			             if ( isset($_GET['view']) && $_GET['view'] == "princ" )  {
			                 // Si GET['view'] = sec no se pueden mostrar las compras pues en los almacenes no hay COMPRAS.  
				             $nombre_caja = "CAJA CENTRAL ";
			             } else if ( isset($_GET['view']) && $_GET['view'] == "sec" )  {
				             $nombre_caja = "CAJA ALMAC&Eacute;N ".$_GET['name']; 
			             }
			         break;
			         case "v":  // CASO VENDEDOR.
			             $nombre_caja = "CAJA ALMAC&Eacute;N "; 
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
			             if ( isset($_GET['view']) && $_GET['view'] == "princ" )  {
			                 // Si GET['view'] = sec no se pueden mostrar las compras pues en los almacenes no hay COMPRAS.  
				             $tipo_accion = "TOTAL COMPRAS";
			                 $num_tipo_accion = stripslashes($resumen_caja['num_compras_totales']);
			                 $efectivo_tipo_accion = stripslashes($resumen_caja['efectivo_compras_totales']);
			             } else if ( isset($_GET['view']) && $_GET['view'] == "sec" )  {
				             $tipo_accion = "VENTAS TOTALES"; 
			                 $num_tipo_accion = stripslashes($resumen_caja['num_ventas_totales']);
			                 $efectivo_tipo_accion = stripslashes($resumen_caja['efectivo_ventas_totales']);  
			             }
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
                  <td>&nbsp;  </td>
                  <td> <?php echo $saldo_caja_anterior; ?>  </td>
              </tr>
              <tr>    
                  <td style="color: white; background-color:#056AA8;"> TOTAL CAJA  </td>
                  <td>&nbsp;  </td>
                  <td> <?php echo stripslashes($resumen_caja['total_caja']); ?> </td>
              </tr>
           </table>
			             
<?php			 
			 /******************************************************************************************************** 
                                                      TABLA DE LA CAJA DE HOY
             *******************************************************************************************************/
           if ( $resumen_caja['existe'] == "null" )  {
?>		 
                <!-- *************************************************************************************************************
                                     MENSAJE DE CUANDO NO SE HA INTRODUCIDO NINGUNA TRANSACCIÓN EN LA CAJA EL DÍA ACTUAL
                     ****************************************************************************************************************  --> 
         
               <div class="message_wrong" style="margin-top:0px;"> No existen TRANSACCIONES EN LA CAJA el d&iacute;a de HOY </div> 
<?php	 
	       }  else  {    // Fin del  if ( $transacciones_caja == "null" )  {
              			   
                 switch($_SESSION['tipo_usuario'])  // Esto es para poner "VENTAS TOTALES" ó "TOTAL DE COMPRAS"
		         {
		   	         case "a":  // CASO ADMINISTRADOR. 
			             if ( isset($_GET['view']) && $_GET['view'] == "princ" )  {
			                 // Si GET['view'] = sec no se pueden mostrar las compras pues en los almacenes no hay COMPRAS.  
				             $no_accion = "No. COMPRA";
			             } else if ( isset($_GET['view']) && $_GET['view'] == "sec" )  {
				             $no_accion = "No. VENTA"; 
			             }
			         break;
			         case "v":  // CASO VENDEDOR.
			             $no_accion = "No. VENTA"; 
			         break; 
		         }  // Fin del switch
              ?>
    
               <!-- ********************************************************************************************
                       TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY 
                  ******************************************************************************************* -->
        
               <div style="width:100%;">
                 <table class="print_table" cellspacing="0" cellpadding="0">
                   <tr >
                     <th style="width: 4%; min-width: 24px;"> # </th>
                     <th style="width: 13%; min-width: 60px;"> TIPO TRANSACCI&Oacute;N </th>
                     <th style="width: 17%; min-width:90px;"> ORIGEN </th>
                     <th style="width: 17%; min-width:90px;"> DESTINO </th>
                     <th style="width: 18%; min-width:90px;"> OBSERVACIONES </th>
                     <th style="width: 8%; min-width:80px;"> 
                     <?php
			            // Este campo depende de si el usuario es 'administrador' o 'vendedor'
			            echo $no_accion;
				     ?>   
                     </th>
                     <th style="width: 15%; min-width:80px;"> USUARIO </th>
                     <th style="width: 8%; min-width:60px;"> CANTIDAD </th>
                   </tr>
                 </table> 
                 
                 <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                   for ( $i=0; $i < count($transacciones_caja); $i++ )
		           {
			           //03 MUESTRO LA TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY 
                       echo "<tr>";
			              echo "<td style=\"width: 4%; min-width: 24px;\">".($i+1)." <input type=\"hidden\" name=\"caja_id\" value=\"".$transacciones_caja[$i]['id']."\" /> </td>"; 
			              echo "<td style=\"width: 13%; min-width:60px; \"> ".$transacciones_caja[$i]['tipo_transaccion']."</td>"; 
			              echo "<td style=\"width: 17%; text-align: justify; min-width:90px; \" >".$transacciones_caja[$i]['origen_transaccion']."</td>";
		                  echo "<td style=\"width: 17%; text-align: justify; min-width:90px; \" >".$transacciones_caja[$i]['destino_transaccion']."</td>";
			              echo "<td style=\"width: 18%; text-align: justify; min-width:90px; \" >".stripslashes($transacciones_caja[$i]['observaciones'])."</td>";
			 
			              // Este campo depende de si el usuario es 'administrador' o 'vendedor'
			              switch($_SESSION['tipo_usuario'])
			              {
				              case "a":  // CASO ADMINISTRADOR. 
			                      if ( isset($_GET['view']) && $_GET['view'] == "princ" )  {
			                          // Si GET['view'] = sec no se pueden mostrar las compras pues en los almacenes no hay COMPRAS.  
				                      $tipo_trans = $transacciones_caja[$i]['no_orden_de_compra'];
				                      if ( $tipo_trans == 0 )  {
						                  $tipo_trans = "";
					                  }
			                      } else if ( isset($_GET['view']) && $_GET['view'] == "sec" )  {
				                      $tipo_trans = $transacciones_caja[$i]['no_venta'];
				                      if ( $tipo_trans == 0 )  {
						                  $tipo_trans = "";
					                  }
			                      }
			                  break;
			                  case "v":  // CASO VENDEDOR.
			                      $tipo_trans = $transacciones_caja[$i]['no_venta'];
				                  if ( $tipo_trans == 0 )  {
						              $tipo_trans = "";
					              }
			                  break; 
						  }  // Fin del switch  
				 			 
			              echo "<td style=\"width: 8%; min-width:80px;  \">".$tipo_trans."</td>";
		                  echo "<td style=\"width: 15%; text-align: center; min-width:80px;  \">".stripslashes($transacciones_caja[$i]['persona_q_hace_transaccion'])."</td>";
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
			  	  
			              echo "<td style=\"width:8%; text-align:center; min-width:60px; color:".$color."\">".stripslashes($transacciones_caja[$i]['cantidad_transaccion'])."</td>";
			           echo "</tr>";
		           }   // Fin del for
?>         
                </table>
              </div>  <!-- fin del <div> de la TABLA QUE TIENE EN SU INTERIOR TODAS LAS TRANSACCIONES EN LA CAJA EL DÍA DE HOY -->
<?php	 
	        }  // Fin del  if ( $transacciones_caja == "null" )  {
 
	   } 
	      /************************************************
	       *        CASO 8. MÓDULO INVENTARIO.            *
	       ************************************************/
	     else if ( isset($_GET['inv']) && $_GET['inv'] == 1 )  {
		   /****************************************************************
		    *    n) Imprimir los artículos del inventario.                 *         
		    ****************************************************************/
			//01 BUSCO LOS ARTÍCULOS DEL INVENTARIO DEL LA BD.	  
	        $articulos_inv = articulos_inventario(); 

            if ( $articulos_inv == "null" )  {
		  
?>		 
                <!-- ******************************************************************************************************
                        MENSAJE DE ALERTA CUANDO NO EXISTEN ARTÍCULOS EN LA TABLA articulos_inventario ( ADMINISTRADOR )
                     ******************************************************************************************************  --> 
                <div class="message_wrong" style="margin-top:0px;" id="show_inv1"> No existen ART&Iacute;CULOS en el Inventario </div> 
<?php	 
	        }  else  {   // Fin del  if ( $articulos_inv == "null" )  {
?>           
                   <!-- ********************************************************************************************
                           TABLA QUE TIENE EN SU INTERIOR TODOS LOS REGISTROS DE LOS ARTÍCULOS DEL INVENTARIO" 
                         ******************************************************************************************* -->
      
                 <!-- TABLA CON LOS REGISTROS DE LOS ARTÍCULOS DE INVENTARIO  -->
                 <div style="width:100%;">
                  <table class="print_table" cellspacing="0" cellpadding="0">
                    <tr >
                      <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="12"> TABLA DE ART&Iacute;CULOS </th>
                    </tr>
                    <tr >
                      <th style="width: 3%; min-width: 24px;">  </th>
                      <th style="width: 3%; min-width: 24px;"> # </th>
                      <th style="width: 6%; min-width:40px;"> C&Oacute;DIGO </th>
                      <th style="width: 20%; min-width:80px;"> REFERENCIA </th>
                      <th style="width: 15%; min-width:65px;"> DETALLE </th>
                      <th style="width: 15%; min-width:73px;"> PROVEEDOR </th>
                      <th style="width: 6%; min-width:40px;"> STOCK M&Iacute;N. </th>
                      <th style="width: 6%; min-width:40px;"> COSTO </th>
                      <th style="width: 6%; min-width:40px;"> V1 </th>
                      <th style="width: 6%; min-width:40px;"> V2 </th>
                      <th style="width: 6%; min-width:40px;"> V3 </th>
                      <th style="width: 8%; min-width:55px;"> UNIDAD MEDIDA </th>
                    </tr>
                  </table> 
       
                  <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                     for ( $i=0; $i < count($articulos_inv); $i++ )
		             {
			             //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		  	             echo "<tr>";
			               echo "<td style=\"width: 3%; min-width:21px; \"> <input type=\"radio\" name=\"articulos_inv\" value=\"".$articulos_inv[$i]['id']."\" /> </td>"; 
			               echo "<td style=\"width: 3%; min-width:21px; color:#056AA8;\">".($i+1)."</td>";
			               echo "<td style=\"width: 6%; min-width:40px; \"> ".stripslashes($articulos_inv[$i]['codigo_art'])."</td>"; 
			               echo "<td style=\"width: 20%; text-align: left; min-width:90px;\" >".stripslashes($articulos_inv[$i]['referencia_art'])."</td>";
		                   echo "<td style=\"width: 15%; text-align: left; min-width:65px; \" >".stripslashes($articulos_inv[$i]['detalle_art'])."</td>";
			               echo "<td style=\"width: 15%; text-align: left; min-width:73px;  \">".stripslashes($articulos_inv[$i]['nombre'])."</td>";
		                   echo "<td style=\"width: 6%; text-align: center; min-width:40px;  \">".stripslashes($articulos_inv[$i]['stock_minimo'])."</td>";
			               echo "<td style=\"width: 6%; text-align: center; min-width:40px;  \">".stripslashes($articulos_inv[$i]['precio_costo_art'])."</td>";
			               echo "<td style=\"width: 6%; text-align: center; min-width:40px;  \">".stripslashes($articulos_inv[$i]['precio_venta1'])."</td>";
			               echo "<td style=\"width: 6%; text-align: center; min-width:40px;  \">".stripslashes($articulos_inv[$i]['precio_venta2'])."</td>";
			               echo "<td style=\"width: 6%; text-align: center; min-width:40px;  \">".stripslashes($articulos_inv[$i]['precio_venta3'])."</td>";
			               echo "<td style=\"width: 8%; text-align: left; min-width:55px;  \">".stripslashes($articulos_inv[$i]['unidad_medida'])."</td>";
		               echo "</tr>";
		             } // Fin del for
?>         
                </table>
             </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
<?php	 
	      }  // Fin del  if ( $clientes_ds == "null" )  {
         
       } 
	     else if ( isset($_GET['inv']) && $_GET['inv'] == 2 )  {
		   /****************************************************************
		    *    ñ) Imprimir el Kardex de un artículo.                     *         
		    ****************************************************************/
			// Esto es para que se me muestre el kardex del artículo seleccionado. 	 
		    $kardex = process_kardex();
?>  
            <!-- ************************************************************************************************
                          TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
         ************************************************************************************************ -->
        
            <table class="print_table" cellspacing="0" cellpadding="0" style="width:40%;">
               <!-- FILA 1 -->
               <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Descripci&oacute;n del art&iacute;culo </td>
                  <td style="width: 60%;"> <?php echo $_GET['desc']; ?>  </td>
               </tr>
           
               <!-- FILA 2 -->
               <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> C&oacute;digo del art&iacute;culo </td>
                  <td style="width: 60%;"> <?php echo $_GET['cod']; ?>  </td>
               </tr>
        
               <!-- FILA 3 -->
               <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Inicial de la Consulta </td>
                  <td style="width: 60%;"> <?php  echo $_GET['fi']; ?>  </td>
               </tr>
           
               <!-- FILA 4 -->
               <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Final de la Consulta </td>
                  <td style="width: 60%;"> <?php  echo $_GET['ff']; ?>  </td>
               </tr>
           
               <!-- FILA 5-->
               <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local de la Consulta </td>
                  <td style="width: 60%;"> <?php echo $_GET['name']; ?>  </td>
               </tr>
        
            </table>         
  
<?php    
             if ( isset($kardex))  {
		 
		         if ( $kardex == "null" )   {
			         //CASO 1. Esto significa que en el local seleccionado para ver el Kardex no existe el artículo seleccionado
?>                         
        	         <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> No existe ning&uacute;n movimiento del Art&iacute;culo Seleccionado en el Local <?php echo $_GET['name']; ?> para los d&iacute;as seleccionados. </div>
                 
<?php
			     } else if ( $kardex == "error" )   {
			          //CASO 2. Esto significa que se ha escrito en la barra de direcciones del navegador sin enviar las var. $_POST
?>        
                     <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Error de Env&iacute;o de Datos</div>
<?php
			     } else  {
			          //CASO 3. Esto significa que TODO ESTÁ BIEN Y VOY A MOSTRAR LOS DATOS
			
?>   	  
	             <!-- ********************************************************************************************
                                 MUESTRO LA TABLA CON LOS DATOS DEL KARDEX DEL ARTÍCULO SELECCIONADO
                      *********************************************************************************************  -->  
             
                      <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
                     <div style="width:100%; margin-top:15px;" id="show_kardex">
                     <table class="print_table" cellspacing="0" cellpadding="0">
                      <tr >
                        <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="11"> TABLA KARDEX PARA UN ART&Iacute;CULO EN UN LOCAL DETERMINADO </th>
                      </tr>
                      <tr >
                        <th style="width: 3%; min-width: 24px;"> # </th>
                        <th style="width: 6%; min-width:40px;"> FECHA </th>
                        <th style="width: 6%; min-width:40px;"> MOV. </th>
                        <th style="width: 10%; min-width:60px;"> CONCEPTO </th>
                        <th style="width: 15%; min-width:73px;"> PROVEEDOR </th>
                        <th style="width: 15%; min-width:40px;"> CLIENTE </th>
                        <th style="width: 15%; min-width:80px;"> OBSERVACIONES </th>
                        <th style="width: 12%; min-width:70px;"> PERSONA </th>
                        <th style="width: 6%; min-width:40px;"> ENTRADA </th>
                        <th style="width: 6%; min-width:40px;"> SALIDA </th>
                        <th style="width: 6%; min-width:40px;"> STOCK </th>
                      </tr>
                    </table> 
             
                    <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                      for ( $i=0; $i < count($kardex); $i++ )
		              {
			              //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			              echo "<tr>";
			                echo "<td style=\"width: 3%; min-width:21px; \">".($i+1)."</td>"; 
			                echo "<td style=\"width: 6%; min-width:40px; \">".stripslashes($kardex[$i]['fecha_movimiento'])."</td>"; 
		 	                echo "<td style=\"width: 6%; min-width:40px; \"> ".$kardex[$i]['tipo_mov']."</td>"; 
			                echo "<td style=\"width: 10%; text-align: left; min-width:60px; \" >".$kardex[$i]['concepto_mov']."</td>";
		                    echo "<td style=\"width: 15%; text-align: left; min-width:65px; \" >".stripslashes($kardex[$i]['origen_mov_proveedor'])."</td>";
			                echo "<td style=\"width: 15%; text-align: left; min-width:73px;  \">".stripslashes($kardex[$i]['destino_mov_cliente'])."</td>";
		                    echo "<td style=\"width: 15%; text-align: left; min-width:80px;  \">".stripslashes($kardex[$i]['observaciones_mov'])."</td>"; 		
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
		
			                echo "<td style=\"width: 12%; text-align: center; min-width:70px;  \">".$persona."</td>";
			 
			                switch($kardex[$i]['tipo_mov']) 
			                {
			                     // Para saber el tipo de movimiento si es de ENTRADA o de SALIDA y poner en el campo ENTRDA-SALIDA respectivamente 	
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
			 		 
			                echo "<td style=\"width: 6%; text-align: center; min-width:40px;  \">".$cantidad_entrada."</td>";
			                echo "<td style=\"width: 6%; text-align: center; min-width:40px;  \">".$cantidad_salida."</td>";
			                echo "<td style=\"width: 6%; text-align: center; min-width:30px;  \">".stripslashes($kardex[$i]['saldo'])."</td>";
			 		  	 echo "</tr>";
		              }
?>         
                   </table>
                 </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
<?php
   	           }   // Fin del if ( $kardex ==  .... )
		     }  // Fin del if ( isset($kardex))
     
	   } 
	      else if ( isset($_GET['inv']) && $_GET['inv'] == 3 )  {
		      /****************************************************************
		       *    o) Imprimir el Resumen de mov. de Inventario            *         
		       ****************************************************************/
			   // Esto es para que se me muestre el Resumen del movimiento de inventario para el local seleccionado. 	 
		       $res_mov_inv = process_resumen_mov_inv(); 
?>	  
	               <!-- ************************************************************************************************
                                      TABLA QUE SE MUESTRA SÓLO CUANDO no es ERROR DE ENTRADA DE DATOS
                        ************************************************************************************************ -->
        
               <table class="print_table" cellspacing="0" cellpadding="0" style="width:40%;">
                   
                <!-- FILA 1 -->
                <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Inicial de la Consulta </td>
                  <td style="width: 60%;"> <?php  echo $_GET['fi']; ?>  </td>
               </tr>
           
               <!-- FILA 2 -->
               <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Final de la Consulta </td>
                  <td style="width: 60%;"> <?php  echo $_GET['ff']; ?>  </td>
               </tr>
           
               <!-- FILA 3 -->
               <tr>    
                 <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local de la Consulta </td>
                 <td style="width: 60%;"> <?php echo $_GET['name']; ?>  </td>
              </tr>
           
              <!-- FILA 4 -->
              <tr>    
                 <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Ver s&oacute;lo </td>
                 <?php
			        if ( $_GET['son'] == "entradas" )  {
					    $ver_solamente = "Entradas"; 
					} else if ( $_GET['son'] == "salidas"  )  {
					    $ver_solamente = "Salidas";
				    } else if ( $_GET['son'] == "ambos" )  {
					    $ver_solamente = "Entradas y Salidas";
				    }
			  	 ?>
                 <td style="width: 60%;"> <?php echo $ver_solamente; ?>  </td>
               </tr>
             </table>  
<?php	  
             if ( isset($res_mov_inv))  {
		 
		         if ( $res_mov_inv == "null" )   {
			         //CASO 1. Esto significa que en el local seleccionado para ver el Kardex no existe eel artículo seleccionado
?> 	
	                 <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> No existe ha habido ning&uacute;n movimiento en el Local <?php echo $_GET['name']; ?> para los d&iacute;as seleccionados. </div>
                  
<?php
			     } else if ( $res_mov_inv == "error" )   {
			          //CASO 2. Esto significa que se ha escrito en la barra de direcciones del navegador sin enviar las var. $_POST
?>        
                      <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> Error de Env&iacute;o de Datos</div>
<?php
			     } else  {
			          //CASO 3. Esto significa que TODO ESTÁ BIEN Y VOY A MOSTRAR LOS DATOS
?>    
	
	                 <!-- *******************************************************************************************
                                    MUESTRO LA TABLA CON LOS DATOS DEL KARDEX DEL ARTÍCULO SELECCIONADO
                        *********************************************************************************************  -->  
             
                  <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
                  <div style="width:100%; margin-top:15px;" id="show_kardex">
                  <table class="print_table" cellspacing="0" cellpadding="0">
                   <tr >
                     <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="12"> TABLA DE MOVIMIENTOS DE INVENTARIO DE UN LOCAL DETERMINADO </th>
                   </tr>
                   <tr >
                     <th style="width: 3%; min-width: 24px;"> # </th>
                     <th style="width: 6%; min-width:40px;"> FECHA </th>
                     <th style="width: 4%; min-width:40px;"> CODIGO </th>
                     <th style="width: 5%; min-width:40px;"> MOVIMIENTO </th>
                     <th style="width: 12%; min-width:60px;"> CONCEPTO </th>
                     <th style="width: 13%; min-width:73px;"> PROVEEDOR </th>
                     <th style="width: 13%; min-width:40px;"> CLIENTE </th>
                     <th style="width: 15%; min-width:80px;"> OBSERVACIONES </th>
                     <th style="width: 12%; min-width:70px;"> PERSONA </th>
                     <th style="width: 4%; min-width:40px;"> ENTRADA </th>
                     <th style="width: 4%; min-width:40px;"> SALIDA </th>
                     <th style="width: 4%; min-width:40px;"> STOCK </th>
                   </tr>
                 </table> 
                
                 <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                   for ( $i=0; $i < count($res_mov_inv); $i++ )
		           {
			           //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
			           echo "<tr>";
			             echo "<td style=\"width: 3%; min-width:21px; \">".($i+1)."</td>"; 
			             echo "<td style=\"width: 6%; min-width:40px; \">".stripslashes($res_mov_inv[$i]['fecha_movimiento'])."</td>"; 
			             echo "<td style=\"width: 4%; min-width:40px; cursor:pointer; \" title=\"".stripslashes($res_mov_inv[$i]['referencia_art'])."\" >".stripslashes($res_mov_inv[$i]['codigo_art'])."</td>"; 
			             echo "<td style=\"width: 5%; min-width:40px; \"> ".$res_mov_inv[$i]['tipo_mov']."</td>"; 
			             echo "<td style=\"width: 12%; text-align: left; min-width:60px; \" >".stripslashes($res_mov_inv[$i]['concepto_mov'])."</td>";
		                 echo "<td style=\"width: 13%; text-align: left; min-width:65px; \" >".stripslashes($res_mov_inv[$i]['origen_mov_proveedor'])."</td>";
			             echo "<td style=\"width: 13%; text-align: left; min-width:73px;  \">".stripslashes($res_mov_inv[$i]['destino_mov_cliente'])."</td>";
		                 echo "<td style=\"width: 15%; text-align: left; min-width:80px;  \">".stripslashes($res_mov_inv[$i]['observaciones_mov'])."</td>"; 
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
						
			             echo "<td style=\"width: 12%; text-align: center; min-width:70px;  \">".$persona."</td>";
			 
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
						 
			             echo "<td style=\"width: 4%; text-align: center; min-width:40px;  \">".$cantidad_entrada."</td>";
			             echo "<td style=\"width: 4%; text-align: center; min-width:40px;  \">".$cantidad_salida."</td>";
			             echo "<td style=\"width: 4%; text-align: center; min-width:30px;  \">".stripslashes($res_mov_inv[$i]['saldo'])."</td>";
			           echo "</tr>";
		           }
?>         
                </table>
              </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
<?php
   	          }   // Fin del if ( $kardex ==  .... )
		    }  // Fin del if ( isset($kardex))
         
		}
	       else if ( isset($_GET['inv']) && $_GET['inv'] == 4 )  {
		      /****************************************************************
		       *    p) Imprimir el Stock de cualquier Local                   *         
		       ****************************************************************/
			   //01 Esto es para que se me muestre el Stock del local seleccionado de acuerdo al usuario. 	 
		       if ( $_SESSION['tipo_usuario'] == "a" )  {
			       $show_stock = process_stock('a');
			   } else if ( $_SESSION['tipo_usuario'] == "v" ) {
				   $show_stock = process_stock('v');
			   }
		
		       if ( isset($show_stock))  {
		 
		           if ( $show_stock == "null" )   {
			           //CASO 1. Esto significa que en el local seleccionado para ver el Kardex no existe eel artículo seleccionado
?>            
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
                   <!-- *******************************************************************************************
                                              MUESTRO LA TABLA CON LOS DATOS DEL STOCK
                        *********************************************************************************************  -->  
             
                        <!-- TABLA CON LOS REGISTROS DEL KARDEX DEL ARTICULO Y EL LOCAL SELECCIONADO   -->
                       <div style="width:100%; margin-top:15px;">
                        <table class="print_table" cellspacing="0" cellpadding="0">
                         <tr >
                          <th style="width:100%; color:gray; background-color:#F2F2F2;" colspan="4"> TABLA DE STOCK DEL LOCAL SELECCIONADO </th>
                         </tr>
                         <tr >
                          <th style="width: 3%; min-width: 24px;"> # </th>
                          <th style="width: 15%; min-width:50px;"> CODIGO </th>
                          <th style="width: 67%; min-width:80px;"> REFERENCIA </th>
                          <th style="width: 15%; min-width:40px;"> STOCK </th>
                         </tr>
                        </table> 
       
                        <table class="print_table" cellspacing="0" cellpadding="0"> 
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
		                  }  // Fin del for
?>         
                        </table>
                      </div>  <!-- fin del <div> de las TABLAS CON LOS REGISTROS DE LOS CLIENTES  -->
<?php
   	               }   // Fin del if ( $show_stock ==  .... )
		         }  // Fin del if ( isset($show_stock))
		
		
		
		
		
		
			   
			   
		}
		   /************************************************
	        *        CASO 9. MÓDULO VENTAS.                *
	        ************************************************/
	        else if ( isset($_GET['vnt']) && $_GET['vnt'] == 1 )  {
		      /****************************************************************
		       *    q) Imprimir los datos del Resumen de Ventas.                 *         
		       ****************************************************************/
                $resumen_ventas = resumen_ventas(); 
?>
			     <!-- ************************************************************************************************
                                     TABLA QUE SE MUESTRA CON LOS DATOS DE LA CONSULTA
                    ************************************************************************************************ -->
        
                <table class="print_table" cellspacing="0" cellpadding="0" style="width:40%;">
                   
                  <!-- FILA 1 -->
                  <tr>    
                    <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Inicial </td>
                    <td style="width: 60%;"> <?php  echo $_GET['fi']; ?>  </td>
                  </tr>
           
                  <!-- FILA 2 -->
                  <tr>    
                    <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Fecha Final </td>
                    <td style="width: 60%;"> <?php  echo $_GET['ff']; ?>  </td>
                  </tr>
                
                  <!-- FILA 3 -->
                  <tr>    
                    <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local </td>
                    <td style="width: 60%;"> <?php  echo $_GET['name']; ?>  </td>
                 </tr>
              
               </table> 	  
<?php		  	    
               //b) Hay variables $_GET  
               if ( $resumen_ventas == "vacio" )  {
	               // Esto es cuando no existe ninguna VENTA registrada en las Bases de Datos entre las fechas seleccionadas.
?>	                 
                   <div class="message_wrong" style="margin:10px 0px 10px 0; width:99.4%;"> En la Base de Datos no hay registrada ninguna Venta entre las fechas Seleccionadas. </div> 
  
<?php   
               } else {
                  // Hay ventas registradas en la BD.
?> 
               <div style="margin-top: 20px; width:100%;"> <!-- div DE LA TABLA LISTADO DE VENTAS  -->
                  <table class="print_table" cellspacing="0" cellpadding="0">
                   <tr >
                     <th style="width:99.8%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE VENTAS </th>
                   </tr>
                   <tr >
                     <th title="N&uacute;mero de Venta" style="width: 4%; min-width:21px;"> # </th>
                     <th style="width: 10%; min-width:50px;"> FECHA </th>
                     <th style="width: 26%; min-width:120px;"> CLIENTE </th>
                     <th style="width: 10%; min-width:80px;"> No. de FACTURA </th>
                     <th style="width: 10%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
                     <th style="width: 10%; min-width:80px;"> FORMA DE PAGO </th>
                     <th style="width: 10%; min-width:80px;"> MONTO </th> 
                     <th style="width: 10%; min-width:80px;"> DESCUENTO </th> 
                     <th style="width: 10%; min-width:80px;"> VALOR REAL </th>
                   </tr>
                  </table> 
            
                  <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                     for ( $i=0; $i < count($resumen_ventas); $i++ )
		             {
			              //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		                 echo "<tr>";
			               echo "<td style=\"width: 4%; min-width:21px; \">".$resumen_ventas[$i]['id_venta']."</td>"; 
			               echo "<td style=\"width:10%; min-width:50px;\"> ".stripslashes($resumen_ventas[$i]['fecha_venta'])."</td>"; 
			 		       echo "<td style=\"width:26%; min-width:120px; text-align: left;\"> ".stripslashes($resumen_ventas[$i]['nombre'])."</td>";  
			         
					       echo "<td style=\"width: 10%; min-width:80px; text-align: center;\" >".stripslashes($resumen_ventas[$i]['numero_factura'])."</td>";
			               echo "<td style=\"width: 10%; min-width:80px; text-align: center;\">".stripslashes($resumen_ventas[$i]['cantidad_articulos'])."</td>";
		     		       /*** if para vponer crédito y contado con tildes ***/ 
			               if ( $resumen_ventas[$i]['forma_de_pago'] == "credito" ) {
					           $forma_pago = "Cr&eacute;dito";	 
				           } else if ( $resumen_ventas[$i]['forma_de_pago'] == "contado" )  {
					           $forma_pago = "Contado";		 
				           }
					 
					       echo "<td style=\"width: 10%; min-width:80px; text-align: center; \">".$forma_pago."</td>";
			               echo "<td style=\"width: 10%; min-width:80px; text-align: center; \">".stripslashes($resumen_ventas[$i]['monto_de_la_venta'])."</td>";
			               echo "<td style=\"width: 10%; min-width:80px; text-align: center; \">".stripslashes($resumen_ventas[$i]['descuento'])."</td>";
			               echo "<td style=\"width: 10%; min-width:80px; text-align: center; \">".stripslashes($resumen_ventas[$i]['valor_de_la_venta_real'])."</td>";
			            echo "</tr>";
		             }  // Fin del for
?>         
                  </table>
                </div>  <!-- Fin del div de la tabla listado de ventas para el cliente seleccionado -->
<?php   
	         }  // Fin del if ( $$resumen_ventas == "vacio" )  {	   
	   
	   }
		  else if ( isset($_GET['vnt']) && $_GET['vnt'] == 2 )  {
		      /****************************************************************
		       *    r) Imprimir los datos de Ventas por Cliente.              *         
		       ****************************************************************/
               $venta_cliente = venta_cliente();  
?>	   
	           <!-- ************************************************************************************************
                                     TABLA QUE SE MUESTRA CON LOS DATOS DE LA CONSULTA
                  ************************************************************************************************ -->
               <table class="print_table" cellspacing="0" cellpadding="0" style="width:40%;">
                <!-- FILA 1 -->
                <tr>    
                  <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Local </td>
                  <td style="width: 60%;"> <?php  echo $_GET['name']; ?>  </td>
                </tr>
                <!-- FILA 2 -->
                <tr>    
                   <td style="width: 40%; color: white; background-color:#056AA8; text-align:right;"> Nombre del Cliente </td>
                   <td style="width: 60%;"> <?php  echo $_GET['cliente']; ?>  </td>
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
                    <table class="print_table" cellspacing="0" cellpadding="0">
                     <tr >
                      <th style="width:99.8%; color:gray; background-color:#F2F2F2;" colspan="100"> LISTADO DE VENTAS </th>
                     </tr>
                     <tr >
                      <th title="N&uacute;mero de Venta" style="width: 4%; min-width:21px;"> # </th>
                      <th style="width: 10%; min-width:50px;"> FECHA </th>
                      <th style="width: 20%; min-width:80px;"> No. de FACTURA </th>
                      <th style="width: 12%; min-width:80px;"> CANT. ART&Iacute;CULOS </th>
                      <th style="width: 18%; min-width:80px;"> FORMA DE PAGO </th>
                      <th style="width: 12%; min-width:80px;"> MONTO </th>
                      <th style="width: 12%; min-width:80px;"> DESCUENTO </th> 
                      <th style="width: 12%; min-width:80px;"> VALOR REAL </th>  
                    </tr>
                  </table> 
            
                  <table class="print_table" cellspacing="0" cellpadding="0"> 
<?php
                     for ( $i=0; $i < count($venta_cliente); $i++ )
		             {
			              //03 MUESTRO LA TABLA CON LOS REGISTROS DE LAS CONSULTAS A: mes actual/mes anterior
		                 echo "<tr>";
			                echo "<td style=\"width: 4%; min-width:21px; \">".$venta_cliente[$i]['id_venta']."</td>"; 
			                echo "<td style=\"width:10%; min-width:50px; \"> ".stripslashes($venta_cliente[$i]['fecha_venta'])."</td>"; 
			 		 
			                echo "<td style=\"width: 20%; min-width:80px; text-align: center; \" >".stripslashes($venta_cliente[$i]['numero_factura'])."</td>";
			                echo "<td style=\"width: 12%; min-width:80px; text-align: center; \">".stripslashes($venta_cliente[$i]['cantidad_articulos'])."</td>";
		     		        /*** if para vponer crédito y contado con tildes ***/ 
			                if ( $venta_cliente[$i]['forma_de_pago'] == "credito" ) {
					            $forma_pago = "Cr&eacute;dito";	 
				            } else if ( $venta_cliente[$i]['forma_de_pago'] == "contado" )  {
					            $forma_pago = "Contado";		 
				            }
					 
					        echo "<td style=\"width: 18%; min-width:80px; text-align: center; \">".$forma_pago."</td>";
			                echo "<td style=\"width: 12%; min-width:80px; text-align: center; \">".stripslashes($venta_cliente[$i]['monto_de_la_venta'])."</td>";
			                echo "<td style=\"width: 12%; min-width:80px; text-align: center; \">".stripslashes($venta_cliente[$i]['descuento'])."</td>";
					        echo "<td style=\"width: 12%; min-width:80px; text-align: center; \">".stripslashes($venta_cliente[$i]['valor_de_la_venta_real'])."</td>";
			             echo "</tr>";
		               }  // Fin del for
?>         
                    </table>
                 <div>  <!-- Fin del div de la tabla listado de ventas para el cliente seleccionado -->
<?php   
	          }  // Fin del if ( $venta_cliente == "vacio" )  {	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	     
	   
	   } // Fin del if $_GET['rb'].....
 
 	 
	  
	      
		   
	  
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	  
	 
 
 } else {
	
	$message =  "<span> Usted necesita autentificaci&oacute;n para ver esta p&aacute;gina.</span>";
	echo $message."<br />";
	echo "<a href='../index.php'> <span> Ir a la p&aacute;gina de inicio </span></a>";
 
 } // Fin del //01
 
 
?> 