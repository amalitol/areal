<?php 
/*
* Este es el LAYOUT de la ventana de IMPRIMIR del sistema.
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
*/
// no direct access
defined('VALID_VAR') or die;

  /************************************************************************************************************************
                                                  VARIABLES PARA GUARDAR LOS DATOS
   ************************************************************************************************************************/												    
  $datos_empresa = data_empresa_values();    // En esta variable guardo los datos de la empresa.
  $header = header_imprimir();               // Muestro la función que muestra el header de la página de imprimir de acuerdo a $_GETs.
  $fecha = gmdate('Y-m-d', time() - 18000 ); // Fecha de hoy

?>  
  
  <div style="float:left; min-width:80%; font-size:0.8em;">
     EMPRESA: <?php echo $datos_empresa['nombre_empresa']; ?> 
     <br class="header_span" />   
     DIRECCI&Oacute;N: <?php echo $datos_empresa['direccion_empresa']; ?>
     <br class="header_span" />   
     FECHA: <?php echo $fecha; ?>
     <br />
     TEL&Eacute;FONO: <?php echo $datos_empresa['telefono_empresa'];  ?>
     <br class="header_span" />
     RUC:  <?php echo $datos_empresa['ruc_empresa'];  ?>
     <br class="header_span" />
     MONEDA: <?php echo $datos_empresa['moneda_informes'];  ?>
     <br class="header_span" />
     INFORME: <?php echo $header['nombre']; ?>
     <br class="header_span" />
     <?php echo $header['nombre_subtitulo1']; ?> <?php echo $header['subtitulo1'];  ?> 
  </div>
  <div style="float:right; font-size:0.8em;">
     C&Oacute;DIGO: <span style="font-weight:bold;"> <?php echo $header['codigo'];  ?> </span>
  </div> 
  
   
<div style="float:left; width:100%; margin-top:20px;">
<?php
      if (file_exists($path_modulo))  {
		  include_once($path_modulo);  
	  } else {
		  die('Error al cargar el módulo <b>'.$modulo.'</b>.  No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>' );
	  }
?> 
</div>



































 

