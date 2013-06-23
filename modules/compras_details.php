<?php
/*
* Este es el módulo que muestra los detalles de las COMPRAS DEL NEGOCIO.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*/
/*
**************************** VISTAS DEL MÓDULO QUE SE MUESTRAN EN EUN COLORBOX ( var $_GET['optionid']) **********************
*-----------------------------------------------------------------------------------------------------------------------------
*
*VISTA1(ÚNICA): VISTA QUE MUESTRA EL REPORTE DE LA COMPRA DE ACUERDO AL id DE LA COMPRA ( $_GET['optionid == 1,2,..3,4,...'] )  
*
*
*/

?>
  
    <!--************************************************  VISTA 1 (ÚNICA) *************************************************+-->                     

<div class="menu-box">

<?php

 if ( $_SESSION['tipo_usuario'] == "a" )  {
	// ESTA VISTA SÓLO PUEDE VERLA EL ADMINISTRADOR.

    if ( isset($_GET['optionid']) )  {
        // Esta vsita sólo se muestra si existe la variable $_GET['optionid']

        $optionid = $_GET['optionid'];
        
        /*00*/ $moneda_informes = charge_moneda();  // MUESTRO LA MONEDA DE LOS INFORMES (módulo Compras).
		/*01*/ $show_compras_details = show_compras_details($optionid);  // MUESTRO 'DETALLES DE LA COMPRA' 
		 
		       $no_compra = $show_compras_details['numero_compra'];     // Esto es para poder seleccionar los demás detalles de la compra.
			   $tipo_pago = $show_compras_details['forma_de_pago'];     // Esto es para poder seleccionar los demás detalles de la compra
        
		/*02*/ $show_compras_details_articulos = show_compras_details_articulos($no_compra);  // MUESTRO 'DETALLES ARTICULOS DE LA COMPRA'

        /*03*/ $show_compras_details_pagos = show_compras_details_pagos($no_compra, $tipo_pago);    // MUESTRO 'DETALLES PAGOS DE LA COMPRA'

        /*04*/ if ( $tipo_pago == "credito" )  {
			       // Busco los datos de los PAGOS A CRÉDITO en la tabla de CUENTAS X PAGAR -> cuentas_x_pagar
		       
			       $detalles_cant_pagos = show_detalles_cant_pagos($no_compra);
			   	   
			   
			   }  // Fin del if ( $tipo_pago == "credito" )  {

?>   
	

     <!-- ************************************************************************************************************* 
                                                 1. MUESTRA LOS DATOS GENERALES DE LA COMPRA
            *************************************************************************************************************-->
     
     <div class="message_ok" style="margin:10px 0px 10px 0; width:98.5%;"> 
         
          1. DATOS GENERALES 
     
     </div> 
     
     <div id="data_compra_general" style="width:100%; background-color:#FFF;">   
        <!-- TABLA CON LOS DATOS GENERALES DE LA COMPRA -->
        <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
          <!-- FILA 1 -->
          <tr>    
            <td style="width:25%; color:#2C73A5; text-align:right;"> N&uacute;mero de Orden de Compra </td>
            <td style="width:75%;"> <?php echo $show_compras_details['numero_compra']; ?> </td>
          </tr>
          <!-- FILA 2 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Fecha de la Compra </td>
            <td> <?php echo stripslashes($show_compras_details['fecha_compra_detail']); ?> </td>
          </tr>
          <!-- FILA 3 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> N&uacute;mero de Factura </td>
            <td> <?php echo stripslashes($show_compras_details['numero_factura']); ?> </td>
          </tr>
          <!-- FILA 4 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Nombre del Proveedor </td>
            <td> <?php echo stripslashes($show_compras_details['nombre']); ?> </td>
          </tr>
          <!-- FILA 5 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Cantidad de Art&iacute;culos </td>
            <td> <?php echo stripslashes($show_compras_details['cantidad_articulos']); ?> </td>
          </tr>
          <!-- FILA 6 -->
<?php          
          switch($show_compras_details['forma_de_pago'])
		  {
             case "credito":
			     
				 $formadpago = "Cr&eacute;dito";
			 
			 break;
			 case "contado":
			 
			     $formadpago = "Contado";
			 
			 break;
          
		  }  // Fin del switch()
?>          
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Forma de Pago </td>
            <td> <?php echo $formadpago; ?> </td>
          </tr>
          <!-- FILA 7 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Monto de la Compra </td>
            <td> <?php echo stripslashes($show_compras_details['monto_de_la_compra'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
          </tr>
          <!-- FILA 7 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Descuento </td>
            <td> <?php echo stripslashes($show_compras_details['descuento'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
          </tr>
          <!-- FILA 8 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Valor Pagado </td>
            <td> <?php echo stripslashes($show_compras_details['valor_pagado_real'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
          </tr>
          <!-- FILA 9 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Usuario que hizo la Compra </td>
            <td> <?php echo $show_compras_details['usuario']; ?> </td>
          </tr>
        </table>
          
     </div>   <!-- Fin del <div> id=data_compra_general  --> 
          
     <!-- ************************************************************************************************************* 
                                                 2. MUESTRA EL DETALLE DE LA COMPRA
            *************************************************************************************************************-->
     
     <div class="message_ok" style="margin:10px 0px 10px 0; width:98.5%;"> 
         
          2. DETALLE DE LA COMPRA 
     
     </div> 

     <div id="data_compra_articulos" style="width:100%; background-color:#FFF; margin-top:20px;">   
        <!-- TABLA CON LOS DATOS GENERALES DE LA COMPRA -->
        <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
          <tr style="border-bottom: 1px solid #F2F2F2;">    
            <th style="width:40%;"> NOMBRE ART&Iacute;CULO </th>
            <th style="width:12%;"> C&Oacute;DIGO </th>
            <th style="width:12%;"> PRECIO COSTO </th>
            <th style="width:12%;"> CANTIDAD </th>
            <th style="width:12%;"> VALOR TOTAL </th>
          </tr>
<?php          
     for ( $i=0; $i < count($show_compras_details_articulos); $i++ )        
     {     
   
?>          
          <!-- FILA N -->
          <tr>    
            <td style="color:#2C73A5; text-align:center;"> <?php echo stripslashes($show_compras_details_articulos[$i]['referencia_art']); ?> </td>
            <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_articulos[$i]['codigo_art']); ?> </td>
            <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_articulos[$i]['precio_costo_art']); ?> </td>
            <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_articulos[$i]['cantidad_articulo']); ?> </td>
            <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_articulos[$i]['valor_total_articulo']); ?> </td>
          </tr>

<?php
     
	 }  // Fin del for

?>   
      </table>
          
     </div>   <!-- Fin del <div> id=data_compra_articulos  --> 

     <!-- ************************************************************************************************************* 
                                                 3. MUESTRA EL DETALLE DE PAGO
            *************************************************************************************************************-->
     
     <div class="message_ok" style="margin:10px 0px 10px 0; width:98.5%;"> 
         
          3. DETALLE DE PAGO 
     
     </div> 

<?php
  switch($tipo_pago)
  {
	 case "contado":  // CASO 1: PAGO AL CONTADO.
?>	   
	    
      <div id="data_compra_full_detail" style="width:100%; background-color:#FFF; margin-top:10px;">   
        <!-- TABLA CON LOS DATOS DEL ORIGEN DE PAGO CONTADO -->
         <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
           <tr style="border-bottom: 1px solid #F2F2F2;">    
              <th style="width:40%;"> ORIGEN PAGO </th>
              <th style="width:18%;"> MONTO DEL PAGO</th>
              <th style="width:42%;"> OBSERVACIONES </th>
           </tr>
<?php
        switch($show_compras_details_pagos['origen_del_pago'])
		{
		    case "banco":
				 $origen_del_pago_well = "Banco";  // CASO A) BANCO
?>		   
			<tr>    
              <td style="color:#2C73A5; text-align:center;"> <?php echo $origen_del_pago_well; ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_pagos['saldo_inicial']); ?> </td>
              <td style="text-align:left;"> <?php echo stripslashes($show_compras_details_pagos['descripcion1']); ?> </td>
            </tr>
<?php		   
			break;
			case "caja_central":
				 $origen_del_pago_well = "Caja Central";  // CASO B) CAJA CENTRAL
?>		   
			<tr>    
              <td style="color:#2C73A5; text-align:center;"> <?php echo $origen_del_pago_well; ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_pagos['saldo_inicial']); ?> </td>
              <td style="text-align:left;"> <?php echo stripslashes($show_compras_details_pagos['descripcion1']); ?> </td>
            </tr> 	   
<?php		   
		    break;
			case "caja_central_banco":
				 $origen_del_pago_well = "Banco y Caja Central";  // CASO C) BANCO Y CAJA CENTRAL
?>		
			<tr>    
              <td style="color:#2C73A5; text-align:center;"> <?php echo "Banco"; ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_pagos['monto_banco']); ?> </td>
              <td style="text-align:left;"> <?php echo stripslashes($show_compras_details_pagos['descripcion_banco']); ?> </td>
            </tr>	
			<tr>    
              <td style="color:#2C73A5; text-align:center;"> <?php echo "Caja Central"; ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_pagos['monto_caja_central']); ?> </td>
              <td style="text-align:left;"> <?php echo stripslashes($show_compras_details_pagos['descripcion_caja_central']); ?> </td>
            </tr>	
<?php
			break;
				 		     
	      }   // Fin del switch($show_compras_details_pagos['origen_del_pago'])       
               
?>       
         </table>
       </div>   <!-- Fin del <div> id=data_compra_full_detail  --> 

<?php	   
   break;
   case "credito":  // CASO 2: PAGO A CRÉDITO.
?>	   
	   <div id="data_compra_pagos1" style="width:100%; background-color:#FFF;">   
         <!-- TABLA CON LOS DATOS GENERALES DE LA COMPRA -->
          <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
            <!-- FILA 1 -->
            <tr>    
              <td style="width:25%; color:#2C73A5; text-align:right; background-color:#F2F2F2; border:1px solid #D2D2D2;"> Monto del Anticipo </td>
              <td style="width:75%;"> <?php echo stripslashes($show_compras_details_pagos['saldo_inicial'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
            </tr>
          </table>
       </div>   <!-- Fin del <div> id=data_compra_pagos1  -->    
          
<?php       
         
	   if ( $show_compras_details_pagos['saldo_inicial'] != "0" )  {
           // ESTO SIGNIFICA QUE QUE HUBO UN ANTICIPO.
?>		   
	       <div id="data_compra_full_detail" style="width:100%; background-color:#FFF; margin-top:10px;">   
            <!-- TABLA CON LOS DATOS DEL ORIGEN DE PAGO CONTADO -->
             <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
               <tr style="border-bottom: 1px solid #F2F2F2;">    
                 <th style="width:40%;"> ORIGEN PAGO </th>
                 <th style="width:18%;"> MONTO DEL PAGO</th>
                 <th style="width:42%;"> OBSERVACIONES </th>
               </tr>
<?php
               switch($show_compras_details_pagos['origen_del_pago'])
		       {
		           case "banco":
				       $origen_del_pago_well = "Banco";  // CASO A) BANCO
?>		   
			   <tr>    
                 <td style="color:#2C73A5; text-align:center;"> <?php echo $origen_del_pago_well; ?> </td>
                 <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_pagos['saldo_inicial']); ?> </td>
                 <td style="text-align:left;"> <?php echo stripslashes($show_compras_details_pagos['descripcion1']); ?> </td>
               </tr>
<?php		   
			       break;
			       case "caja_central":
				        $origen_del_pago_well = "Caja Central";  // CASO B) CAJA CENTRAL
?>		   
			   <tr>    
                 <td style="color:#2C73A5; text-align:center;"> <?php echo $origen_del_pago_well; ?> </td>
                 <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_pagos['saldo_inicial']); ?> </td>
                 <td style="text-align:left;"> <?php echo stripslashes($show_compras_details_pagos['descripcion1']); ?> </td>
               </tr> 	   
<?php		   
		           break;
			       case "caja_central_banco":
				        $origen_del_pago_well = "Banco y Caja Central";  // CASO C) BANCO Y CAJA CENTRAL
?>		
			   <tr>    
                 <td style="color:#2C73A5; text-align:center;"> <?php echo "Banco"; ?> </td>
                 <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_pagos['monto_banco']); ?> </td>
                 <td style="text-align:left;"> <?php echo stripslashes($show_compras_details_pagos['descripcion_banco']); ?> </td>
               </tr>	
			   <tr>    
                 <td style="color:#2C73A5; text-align:center;"> <?php echo "Caja Central"; ?> </td>
                 <td style="text-align:center;"> <?php echo stripslashes($show_compras_details_pagos['monto_caja_central']); ?> </td>
                 <td style="text-align:left;"> <?php echo stripslashes($show_compras_details_pagos['descripcion_caja_central']); ?> </td>
               </tr>	
<?php
			       break;
				 		     
	           }   // Fin del switch($show_compras_details_pagos['origen_del_pago'])       
               
?>       
             </table>
           </div>   <!-- Fin del <div> id=data_compra_full_detail  --> 
	   
<?php	   
	   }  // Fin del if ( $show_compras_details_pagos['saldo_inicial'] != 0 )  {
             
?>
      
       <div id="data_compra_pagos2" style="width:100%; background-color:#FFF; float:left; margin-top:20px;">   
         <!-- TABLA CON LOS DATOS DEL SALDO DEL CRÉDITO -->
          <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
            <!-- FILA 1 -->
            <tr>    
              <td style="width:25%; color:#2C73A5; text-align:right; background-color:#F2F2F2; border:1px solid #D2D2D2;"> Saldo del Cr&eacute;dito </td>
              <td style="width:75%;"> <?php echo stripslashes($show_compras_details_pagos['saldo_del_credito'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
            </tr>
          </table>
       </div>   <!-- Fin del <div> id=data_compra_pagos2  -->       
      
       
       <div id="data_compra_cxp" style="width:100%; background-color:#FFF; margin-top:30px;">   
         <!-- TABLA CON LOS DATOS DE LOS REGISTROS DEL CRÉDITO -->
          <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
            <tr style="border-bottom: 1px solid #F2F2F2;">    
              <th style="width:3%;"> # </th>
              <th style="width:17%;"> FECHA VENCIMIENTO </th>
              <th style="width:38%;"> DETALLE </th>
              <th style="width:10%;"> VALOR ABONO </th>
              <th style="width:12%;"> VALOR ABONADO </th>
              <th style="width:10%;"> SALDO </th>
              <th style="width:10%;"> ESTADO </th>
            </tr>
            
<?php          
         for ( $i=0; $i < count($detalles_cant_pagos); $i++ )        
         {     
?>          
            <!-- FILA N -->
            <tr>    
              <td style="color:#2C73A5; text-align:center;"> <?php echo ($i+1); ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($detalles_cant_pagos[$i]['fecha_vencimiento']); ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($detalles_cant_pagos[$i]['detalle_registro']); ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($detalles_cant_pagos[$i]['valor_abono']); ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($detalles_cant_pagos[$i]['valor_abonado']); ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($detalles_cant_pagos[$i]['saldo']); ?> </td>
              <?php
                 if ( $detalles_cant_pagos[$i]['fin_registro'] == 0 )  {
				     // Esto significa que el REGISTRO DE CUENTA POR PAGAR no ha finalizado.	 
				     $info = "PENDIENTE";
					 $color_backg = "color: #D40000; text-decoration:blink;";
				 } else {
					 // Esto significa que el REGISTRO DE CUENTA POR PAGAR ya finalizó.	 
				     $info = "FINALIZADO";
					 $color_backg = "color: blue;";
				 }			  
			  ?>
              <td style="text-align:center; <?php echo $color_backg; ?>"> <?php echo $info; ?> </td>
            </tr>
<?php
          }  // Fin del for
?>
        </table>
          
      </div>   <!-- Fin del <div> id=data_compra_cxp  --> 

<?php	   
    break;
  }  // Fin de switch($tipo_pago)
?>  

<?php

	}  // Fin del if ( isset($_GET['optionid']) && )  {
  
 }   // Fin del if ( $_SESSION['tipo_usuario'] == "a" )  {

?>
</div>  <!-- Fin del <div class="menu-box"> -->