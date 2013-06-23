<?php
// Incluímos el archivo de configuración
include_once('conf.php');
session_start();

/********************************** SECCIÓN 1 *******************************************+
*   - Aquí colocamos todo lo necesario que se debe repetir en cada recarga.
*   EX. 01 Inicialización de variables.
        02 Archivo de conexión a la BASE DE DATOS.
        03 Lectura de archivos de funciones o configuración.
*/
//01 Inicialización de variables.
// (1) defino variable para COMPROBAR que estoy en esta página de index.php
define( 'VALID_VAR', 1 );

//02 Conexión a la BD.
include_once('includes/connection.php');

//03 Archivos de funciones y otros de configuración.
include_once('includes/mod_login_functions.php');
include_once('includes/mod_mi_perfil_functions.php');

//04 Tabs 1
include_once('includes/mod_ventas_functions.php');
include_once('includes/mod_caja_functions.php');
include_once('includes/mod_inventario_functions.php');
include_once('includes/mod_compras_functions.php');

//05 Tabs 2
include_once('includes/mod_proveedores_functions.php');
include_once('includes/mod_clientes_functions.php');
include_once('includes/mod_cuentas_x_pagar_functions.php');
include_once('includes/mod_cuentas_x_cobrar_functions.php');
include_once('includes/mod_registro_bancario_functions.php');

// ADMINISTRADOR
include_once('includes/mod_empresa_functions.php');
include_once('includes/mod_users_functions.php');

// DETALLE DE COMPRAS
include_once('includes/mod_compras_details_functions.php');

// DETALLE DE VENTAS
include_once('includes/mod_ventas_details_functions.php');

// ADD ARTÍCULO DESDE EL MÓDULO DE COMPRAS
include_once('includes/mod_add_article_functions.php');

// IMPRIMIR REPORTE
include_once('includes/mod_imprimir_functions.php');

/********************************** SECCIÓN 2 ************************************************
*   - Ahora verificamos que se haya escogido un módulo, sino se ha escogido podemos tomar el valor por defecto en la 
*   configuración o enviar un mensaje de ERROR.
*/
  if ( !empty($_GET['mod']) )  {
      // Esto me dice que se ha enviado un módulo 	
      if ( isset($_SESSION['usuario']) && isset($_SESSION['nombre_completo']) && isset($_SESSION['tipo_usuario']) && isset($_SESSION['id_local']))  {
	      // Esto es para que me muestre el módulo que he seleccionado.
		  $modulo = $_GET['mod'];
	  } else { 
	      // Esto es para que me muestre el formulario de login
		  $modulo = MODULO_DEFECTO;
	  }
	  
  } else {
	  if ( isset($_SESSION['usuario']) && isset($_SESSION['nombre_completo']) && isset($_SESSION['tipo_usuario']) && isset($_SESSION['id_local']))  {
	      // Esto es para que me muestre la ventana de inicio una vez logueado
		  $modulo = "mod_inicio";
	  } else { 
	      // Esto es para que me muestre el formulario de login
		  $modulo = MODULO_DEFECTO;
	  }
  }

/*
*   - También debemos verificar que el valor que nos pasaron corresponde a un módulo existente.Sino envía mensaje de ERROR.
*/
  if ( empty($conf[$modulo]) )  {
	  $modulo = 'mod_error';    
  }

/********************************** SECCIÓN 3 ************************************************
*   - Ahora cargamos el archivo de LAYOUT que a su vez se encargará de incluír al módulo propiamente dicho. 
*   - Si el archivo no existiera, cargamos directamente el módulo.
*   - También es un buen lugar para cargar headers y footers comunes.
*/

 $path_layout = LAYOUTS_PATH.'/'.$conf[$modulo]['layout'];       // Layout asociado al módulo.
 $path_modulo = MODULES_PATH.'/'.$conf[$modulo]['archivo'];      // Módulo que se carga.
 $title_page  = $conf[$modulo]['title'];                         // Título de cada página.

	include_once('includes/header.php');
 
    if ( file_exists($path_layout) )  {

       include_once($path_layout); 
   	 
    } else {
	 
       if ( file_exists($path_modulo) )  {
	       
		   include_once($path_modulo);	 
		 
	   } else {
		 
	       die('Error al cargar el m&oacute;dulo <b>'.$modulo.'</b>.  No existe el archivo <b>'.$conf[$modulo]['archivo'].'</b>' );
	   }
    }
   
	include_once('includes/footer.php'); 
	
	

 
 

?>