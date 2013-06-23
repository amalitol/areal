<?php

/* 
* Archivo de configuración para la aplicación modularizada
* Se definen los valores por defecto y los datos para cada uno de nuestros módulos

*/

//01 Este es el módulo que se carga si no se indicó ninguno ( pantalla de login )
define ('MODULO_DEFECTO', 'mod_login');

//02 Este es el layout por defecto de los módulos ( Es el layout para el usuario y la contraseña )
define('LAYOUT_DEFECTO', 'layout_ssc.php');

//03 Este es el layout por defecto de los módulos ( Es el layout para la pantalla de inicio )
define('LAYOUT_INICIO', 'layout_inicio.php');


//04 Este es el layout por defecto del módulo 1( (1)Clientes, (2)Proveedores, (3)Cuentas por Pagar, (4)Cuentas por Cobrar )
define('LAYOUT_TABS', 'layout_tabs.php');


//05 Este es el layout por defecto del módulo 2( (1)Registro B., (2)Caja, (3)Inventario, (4)Compras y Gastos, (5)Ventas )
define('LAYOUT_TABS2', 'layout_tabs2.php');


//06 Este es el layout por defecto de los módulos DEL ADMINISTRADOR ( (1)Empresa, (2)Usuarios )
define('LAYOUT_TABS_ADMIN', 'layout_tabs_admin.php');


//07 Este es el layout por defecto del colorbox que se muestra para ver:
/*  1. el detalle de una compra ( MÓDULO COMPRAS -> link VER )
    2. el detalle de una venta  ( MÓDULO VENTAS -> link VER )
	3. agregar un nuevo artículo desde el módulo Compras ( MÓDULO COMPRAS -> link Nuevo )  
*/
define('LAYOUT_COLORBOX', 'layout_colorbox.php');

//08 Este es el layout por defecto del módulo imprimir
define('LAYOUT_IMPRIMIR', 'layout_imprimir.php');




//01 Directorio en el cual están los archivos de los módulos del sistema
define('MODULES_PATH', realpath('./modules/'));

//02 Directorio en el cual están los archivos de los layout o las vistas 
define('LAYOUTS_PATH', realpath('./layouts/'));


/* GUARDO EL LISTADO DE LOS MÓDULOS EN UN ARRAY ASOCIATIVO
* MÓDULOS DE MI APLICACIÓN:
   
   01 mod_login              : módulo que muestra la pantala de inicio.
   02 mod_inicio             : módulo de la pantalla de inicio de la aplicación una vez introducidos el user y el pass.
   
   03 mod_mi_perfil          : módulo para cambiar la contraseña del usuario.
   04 mod_logout             : módulo que te permite salir de la aplicación.
   05 mod_administrator      : módulo del administrador para añadir usuarios.
   06 mod_error              : módulo para mostrar el mensaje de ERROR.
   
   // LAYOUT_TABS2 
   07 mod_registro_bancario  : módulo de la pestaña registro bancario.
   08 mod_ccentral           : módulo de la pestaña de Caja Central.
   09 mod_inventario         : módulo de la pestaña de inventarios.
   10 mod_compras_y_gastos   : módulo de la pestaña de compras y gastos.
   11 mod_ventas             : módulo de la pestaña Ventas.
   
   // LAYOUT_TABS
   12 mod_clientes           : módulo de la pestaña CLIENTES del administrador. 
   13 mod_proveedores        : módulo de la pestaña PROVEEDORES del administrador. 
   14 mod_cuentas_x_pagar    : módulo de la pestaña de cuentas por pagar.
   15 mod_cuentas_x_cobrar   : módulo de la pestaña de cuentas por cobrar.
   
   //LAYOUT_TABS_ADMIN
   16 mod_empresa            : módulo de la pestaña EMPRESA del addministrador.
   17 mod_users              : módulo de la pestaña USUARIOS del administrador.
   
   
   //LAYOUT_IMPRIMIR
   
   
*/ 
//01
$conf['mod_login'] = array(
                            'archivo' => 'login.php',     // nombre del archivo que vamos a incluír.
                            'layout'  => LAYOUT_DEFECTO,  // nombre del archivo que contiene el diseño base de la aplicación.
							'title'   => 'Login'          // Título del módulo.
                          );

//02
$conf['mod_inicio'] = array(
                             'archivo' => 'inicio.php',
							 'layout'  => LAYOUT_INICIO,
							 'title'   => 'Inicio' 
                           );

//02
$conf['mod_mi_perfil'] = array(
                             'archivo' => 'mi_perfil.php',
							 'layout'  => LAYOUT_INICIO,
							 'title'   => 'Mi Perfil' 
                           );

//04
$conf['mod_logout'] = array(
                             'archivo' => 'logout.php',
							 
                            );

//05
$conf['mod_administrator'] = array(
                             'archivo' => 'users.php',
							 'layout'  => LAYOUT_TABS_ADMIN,
							 'title'   => 'Administrar Usuarios'
                            );
//06
$conf['mod_error'] = array(
                             'archivo' => 'error_message.php',
							 'title'   => 'ERROR'
							);

                                /*********  LAYOUT_TABS2   *********/

//17
$conf['mod_ventas'] = array(
                             'archivo' => 'ventas.php', 
							 'layout'  => LAYOUT_TABS2,
							 'title'   => 'Ventas'     
                           );
//08
$conf['mod_caja']   = array(
                             'archivo' => 'caja.php', 
							 'layout'  => LAYOUT_TABS2,     
                             'title'   => 'Cajas Chicas'             
						   );
//09
$conf['mod_inventario'] = array(
                                'archivo' => 'inventario.php', 
							    'layout'  => LAYOUT_TABS2,
								'title'   => 'Inventario'     
                                );
//10
$conf['mod_compras'] = array(
                                'archivo' => 'compras.php', 
							    'layout'  => LAYOUT_TABS2,
								'title'   => 'Compras'     
                                );

                                /*********  LAYOUT_TABS   *********/
//11 
$conf['mod_clientes'] = array(
                            'archivo' => 'clientes.php',
							'layout'  => LAYOUT_TABS,
							'title'   => 'Clientes'
                            );        

//12 
$conf['mod_proveedores'] = array(
                            'archivo' => 'proveedores.php',
							'layout'  => LAYOUT_TABS,
							'title'   => 'Proveedores'
                            );       
//13
$conf['mod_cuentas_x_cobrar'] = array(
                                'archivo' => 'cuentas_x_cobrar.php', 
							    'layout'  => LAYOUT_TABS,
								'title'   => 'Cuentas por Cobrar'     
                                );   
//14
$conf['mod_cuentas_x_pagar'] = array(
                                'archivo' => 'cuentas_x_pagar.php', 
							    'layout'  => LAYOUT_TABS,
								'title'   => 'Cuentas por Pagar'     
                                );

//15
$conf['mod_registro_bancario'] = array(
                                       'archivo' => 'registro_bancario.php', 
									   'layout'  => LAYOUT_TABS,
									   'title'   => 'Registro Bancario'      
                                       );
							 
									 /*********  LAYOUT_TABS_ADMIN   *********/

//16 
$conf['mod_empresa'] = array(
                            'archivo' => 'empresa.php',
							'layout'  => LAYOUT_TABS_ADMIN,
							'title'   => 'Datos Empresa'
                            );      
//17 
$conf['mod_users'] = array(
                            'archivo' => 'users.php',
							'layout'  => LAYOUT_TABS_ADMIN,
							'title'   => 'Administrar Usuarios' 
                            );      

                                    /*********  LAYOUT_COLORBOX   *********/
//18 
$conf['mod_compras_details'] = array(
                                      'archivo' => 'compras_details.php',
							          'layout'  => LAYOUT_COLORBOX,
									  'title'   => 'Detalle de Compra'
                                     );      

                                   
//19 
$conf['mod_ventas_details'] = array(
                                     'archivo' => 'ventas_details.php',
							         'layout'  => LAYOUT_COLORBOX,
									 'title'   => 'Detalle de Venta'
                                    );      

                                   
//20 
$conf['mod_add_article'] = array(
                                  'archivo' => 'add_article.php',
							      'layout'  => LAYOUT_COLORBOX,
								  'title'   => 'Añadir Artículo'
                                 ); 
								 
								  /*********  LAYOUT_IMPRIMIR   *********/
//21
$conf['mod_imprimir'] = array(
                                  'archivo' => 'imprimir.php',
                                  'layout'  => LAYOUT_IMPRIMIR,
								  'title'   => 'Imprimir'
							  );								 


?>