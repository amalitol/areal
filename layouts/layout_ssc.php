<?php
/*
* Este es el LAYOUT de la ventana de LOGIN o sea la ventana de LOGIN del sistema antes de registrarse.
* @copyright	Copyright (C) 2012 Solutip Cía.Ltda. All rights reserved.
*/
// no direct access
defined('VALID_VAR') or die;
?>
<div class="main_content">
<?php
      if (file_exists($path_modulo))  {
		  include_once($path_modulo);  
	  } else {
		  die('Error al cargar el módulo <b>'.$modulo.'</b>.  No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>' );
	  }
?> 
</div>