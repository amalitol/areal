<?php
/*
* Este es el módulo que muestra los detalles de las VENTAS DEL NEGOCIO POR ALMACÉN.
*
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
* 
*/
/*
**************************** VISTAS DEL MÓDULO QUE SE MUESTRAN EN EN UN COLORBOX ( $_GET['optid'] Y $_GET['localv'] ) **********************
*-----------------------------------------------------------------------------------------------------------------------------
*
*VISTA1(ÚNICA): VISTA QUE MUESTRA EL REPORTE DE LA VENTA DE ACUERDO AL id DE LA VENTA Y EL ALMACÉN  
* ------------ ( $_GET['optid  = 1,2,..3,4,...'] ) 
* ------------ ( $_GET['localv = 1,2,..3,4,...'] )
*
*/
?>
         
 <!--************************************************  VISTA 1 (ÚNICA) *************************************************+-->                     

<div class="menu-box">

<?php

   if ( isset($_GET['optid']) && isset($_GET['localv']) )  {
        // Esta vista sólo se muestra si existe la variable $_GET['optid']

        $optid = $_GET['optid'];
		$localv = $_GET['localv'];
        
        /*00*/ $moneda_informes = charge_moneda();  // MUESTRO LA MONEDA DE LOS INFORMES (módulo Compras).
		/*01*/ $show_ventas_details = show_ventas_details($optid, $localv);  // MUESTRO 'DETALLES DE LA VENTA' 
		 
		       $tipo_pago = $show_ventas_details['forma_de_pago'];     // Esto es para poder seleccionar los demás detalles de la venta.
        
		/*02*/ $show_ventas_details_articulos = show_ventas_details_articulos($optid, $localv);  // MUESTRO 'DETALLES ARTICULOS DE LA VENTA'

        /*03*/ $show_ventas_details_pagos = show_ventas_details_pagos($optid, $localv, $tipo_pago);    // MUESTRO 'DETALLES PAGOS DE LA VENTA'

        /*04*/ if ( $tipo_pago == "credito" )  {
			       // Busco los datos de los PAGOS A CRÉDITO en la tabla de CUENTAS X COBRAR -> cuentas_x_cobrar
		       
			       $detalles_cant_pagos = show_detalles_cant_pagos_venta($optid, $localv);
			   			   
			   }  // Fin del if ( $tipo_pago == "credito" )  {

?>   
	   <!-- ************************************************************************************************************* 
                                                 1. MUESTRA LOS DATOS GENERALES DE LA VENTA
            *************************************************************************************************************-->
     
     <div class="message_ok" style="margin:10px 0px 10px 0; width:98.5%;"> 
         
          1. DATOS GENERALES 
     
     </div> 
     
     <div id="data_venta_general" style="width:100%; background-color:#FFF;">   
        <!-- TABLA CON LOS DATOS GENERALES DE LA COMPRA -->
        <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
          <!-- FILA 1 -->
          <tr>    
            <td style="width:25%; color:#2C73A5; text-align:right;"> N&uacute;mero de Venta </td>
            <td style="width:75%;"> <?php echo $show_ventas_details['id_venta']; ?> </td>
          </tr>
          <!-- FILA 2 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Fecha de la Compra </td>
            <td> <?php echo stripslashes($show_ventas_details['fecha_venta_detail']); ?> </td>
          </tr>
          <!-- FILA 3 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> N&uacute;mero de Factura </td>
            <td> <?php echo stripslashes($show_ventas_details['numero_factura']); ?> </td>
          </tr>
          <!-- FILA 4 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Nombre del Cliente </td>
            <td> <?php echo stripslashes($show_ventas_details['nombre']); ?> </td>
          </tr>
          <!-- FILA 5 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Cantidad de Art&iacute;culos </td>
            <td> <?php echo stripslashes($show_ventas_details['cantidad_articulos']); ?> </td>
          </tr>
          <!-- FILA 6 -->
<?php          
          switch($show_ventas_details['forma_de_pago'])
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
            <td style="color:#2C73A5; text-align:right;"> Monto de la Venta </td>
            <td> <?php echo stripslashes($show_ventas_details['monto_de_la_venta'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
          </tr>
          <!-- FILA 8 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Descuento </td>
            <td> <?php echo stripslashes($show_ventas_details['descuento'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
          </tr>
          <!-- FILA 8 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Valor Real de la Venta </td>
            <td> <?php echo stripslashes($show_ventas_details['valor_de_la_venta_real'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
          </tr>
          <!-- FILA 10 -->
          <tr>    
            <td style="color:#2C73A5; text-align:right;"> Usuario que hizo la Venta </td>
            <td> <?php echo $show_ventas_details['persona_q_hace_la_venta']; ?> </td>
          </tr>
        </table>
          
     </div>   <!-- Fin del <div> id=data_venta_general  --> 
     
     
     <!-- ************************************************************************************************************* 
                                                 2. MUESTRA EL DETALLE DE LA VENTA
            *************************************************************************************************************-->
     
     <div class="message_ok" style="margin:10px 0px 10px 0; width:98.5%;"> 
         
          2. DETALLE DE LA VENTA 
     
     </div> 


     <div id="data_compra_articulos" style="width:100%; background-color:#FFF; margin-top:20px;">   
        <!-- TABLA CON LOS DATOS GENERALES DE LA COMPRA -->
        <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
          <tr style="border-bottom: 1px solid #F2F2F2;">    
            <th style="width:50%;"> NOMBRE ART&Iacute;CULO </th>
            <th style="width:19%;"> C&Oacute;DIGO </th>
            <!-- <th style="width:12%;"> PRECIO VENTA </th> -->
            <th style="width:19%;"> CANTIDAD </th>
            <!-- <th style="width:12%;"> VALOR TOTAL </th> -->
          </tr>
<?php          
     for ( $i=0; $i < count($show_ventas_details_articulos); $i++ )        
     {     
   
?>          
          <!-- FILA N -->
          <tr>    
            <td style="color:#2C73A5; text-align:center;"> <?php echo stripslashes($show_ventas_details_articulos[$i]['referencia_art']); ?> </td>
            <td style="text-align:center;"> <?php echo stripslashes($show_ventas_details_articulos[$i]['codigo_art']); ?> </td>
            <!-- <td style="text-align:center;"> <?php //echo $show_ventas_details_articulos[$i]['precio_costo_art']; ?> </td> -->
            <td style="text-align:center;"> <?php echo stripslashes($show_ventas_details_articulos[$i]['cantidad_movimiento']); ?> </td>
            <!-- <td style="text-align:center;"> <?php //echo $show_ventas_details_articulos[$i]['valor_total_articulo']; ?> </td> -->
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
	    
      <div style="width:100%; background-color:#FFF;">   
         <!-- TABLA CON LOS DATOS GENERALES DE LA COMPRA -->
          <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
            <!-- FILA 1 -->
            <tr>    
              <td style="width:25%; color:#2C73A5; text-align:right; background-color:#F2F2F2; border:1px solid #D2D2D2;"> Pago al Contado </td>
              <td style="width:75%;"> <?php echo stripslashes($show_ventas_details_pagos['valor_de_la_venta_real'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
            </tr>
          </table>
       </div>   <!-- Fin del <div> id=data_compra_pagos1  -->    

<?php   
   break;
   case "credito":  // CASO 2: PAGO A CRÉDITO.
?>	   
	   <div style="width:100%; background-color:#FFF;">   
         <!-- TABLA CON LOS DATOS GENERALES DE LA COMPRA -->
          <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
            <!-- FILA 1 -->
            <tr>    
              <td style="width:25%; color:#2C73A5; text-align:right; background-color:#F2F2F2; border:1px solid #D2D2D2;"> Monto del Anticipo </td>
              <td style="width:75%;"> <?php echo stripslashes($show_ventas_details_pagos['saldo_inicial'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
            </tr>
          </table>
       </div>   <!-- Fin del <div> -->    
            
       
       <div style="width:100%; background-color:#FFF; float:left; margin-top:20px;">   
         <!-- TABLA CON LOS DATOS DEL SALDO DEL CRÉDITO -->
          <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
            <!-- FILA 1 -->
            <tr>    
              <td style="width:25%; color:#2C73A5; text-align:right; background-color:#F2F2F2; border:1px solid #D2D2D2;"> Saldo del Cr&eacute;dito </td>
              <td style="width:75%;"> <?php echo stripslashes($show_ventas_details_pagos['saldo_del_credito'])." ".stripslashes($moneda_informes['moneda_informes']); ?> </td>
            </tr>
          </table>
       </div>   <!-- Fin del <div> id=data_compra_pagos2  -->       
      
       
       <div id="data_compra_cxp" style="width:100%; background-color:#FFF; margin-top:30px;">   
         <!-- TABLA CON LOS DATOS DE LOS REGISTROS DEL CRÉDITO -->
          <table class="table_info_compras_details" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
            <tr style="border-bottom: 1px solid #F2F2F2;">    
              <th style="width:3%;"> # </th>
              <th style="width:17%;"> FECHA VENCIMIENTO </th>
              <th style="width:33%;"> DETALLE </th>
              <th style="width:10%;"> VALOR DEUDA </th>
              <th style="width:17%;"> VALOR INGRESADO </th>
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
              <td style="text-align:center;"> <?php echo stripslashes($detalles_cant_pagos[$i]['valor_deuda']); ?> </td>
              <td style="text-align:center;"> <?php echo stripslashes($detalles_cant_pagos[$i]['valor_ingresado']); ?> </td>
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

	}  // Fin del if ( isset($_GET['optid']) && )  {

?>
</div>  <!-- Fin del <div class="menu-box"> -->          