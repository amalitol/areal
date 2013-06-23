<?php
/******************************************************************
 Este es el header de todas las páginas del sistema:
 - En esta página también se gestiona el <title> y las <head> de todos los documentos 
-------------------------------------------------------------------------------------------------
0.  --- GENERALES ---
1.  -- Barra de seleccion de cada módulo -- ( Barra superior )
2.  --  datepicker  --                      ( Todos los datepicker del sistema )
3.  --  PAGINATION   --                     ( Todas las paginaciones del sistema )
4.  ausu-suggest ( autocomplete )           ( Aquí van todos los autocomplete del sistema )
5.   MÓDULO PROVEEDORES                     ( Todo lo referente al módulo PROVEEDORES )
	    PETICIONES AJAX DE PROVEEDORES
6.   MÓDULO CLIENTES                        ( Todo lo referente al módulo CLIENTES )
	    PETICIONES AJAX DE CLIENTES
7.   MÓDULO INVENTARIO                      ( Todo lo referente al módulo INVENTARIO )
	    PETICIONES AJAX DE INVENTARIO
8.   MÓDULO USUARIOS                        ( Todo lo referente al módulo USUARIOS.Ej. validación del form)
9.   MÓDULO COMPRAS                         ( Todo lo referente a COMPRAS)
10.  MÓDULO CAJA                            ( Todo lo referente al módulo CAJA )
11.  MÓDULO VENTAS                          ( Todo lo referente al módulo VENTAS )

*******************************************************************/
?>
<!doctype html>
<html lang="es">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">  <!-- charset=iso-8859-1" -->
<meta name="description" content="Sistema de control de inventarios y cuentas para pequeños negocios.SSC" />
<!-- Para limpiar la caché -->
<!--<meta http-equiv="Expires" content="0"> 
<!--<meta http-equiv="Pragma" content="no-cache">

<!-- favicon -->
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

<!-- ARCHIVOS CSS  -->
<link href="css/reset.css" rel="stylesheet" type="text/css" />  <!-- Aquí se resetean todos los navegadores  -->
<link href="css/style_doc.css" rel="stylesheet" type="text/css" />  <!-- css de general, header, login, footer -->
<link href="css/inside.css" rel="stylesheet" type="text/css" /> <!-- css del interior de la aplicación -->
<link href="css/administrator.css" rel="stylesheet" type="text/css" /> <!-- css del interior de la zona de administración -->
<link href="css/colorbox.css" rel="stylesheet" type="text/css" /> <!-- css del plugin colorbox.jquery -->

<!-- css del plugin de jQuery ausu-autosuggest.js -->
<link href="css/style.css" rel="stylesheet" type="text/css" /> 

<!-- CSS del jquery UI  -->
<link type="text/css" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" media="screen" />

<title> SSC <?php echo $title_page; ?> </title>

<!-- ARCHIVOS JAVASCRIPT -->
<!-- PARA LA SUBIDA DE ARCHIVOS JAVASCRIPT VAMOS A HACERLO A TRAVÉS DE LA API head.load.min.js para aumentar la veloc de carga -->
<!-- plugin jQuery para subir los archivos js en paralelo que me permite una mayor rapidez a la hora de cargar la página -->
<script language="javascript" type="text/javascript" src="js/head.load.min.js"></script>

<script type="text/javascript">
// files are loaded in parallel and executed in order they arrive.
<!-- (1) jQuery -->
head.js("js/jquery-1.7.2.min.js");  
<!--(2) jQuery UI -->
head.js("js/jquery-ui-1.8.21.custom.min.js"); 
<!--(3) plugin jQuery para encriptar los passwords en el navegador   -->
head.js("js/jquery.crypt.js");
<!--(4) plugin jQuery para paginación de tablas   ----  http://neoalchemy.org/tablePagination.html  -->
head.js("js/jquery.tablePagination.0.5.js");
<!--(5) plugin jQuery para autocompletado de un campo text --> 
head.js("js/jquery.ausu-autosuggest.js");
<!--(6) suite de 7 plugins jQuery para muchas cosas (jSlider, jTabs, jPaginate, jSpotlight, jTip, jPlaceholder, y jCollapse) -->
head.js("js/vanity_full_0.3.js");
<!--(7) plugin jQuery para VALIDACIÓN DE USUARIOS en un formulario -->
head.js("js/jquery.validate.js");
<!--(8) plugin jQuery para efecto de color a la hora de ELIMINAR una fila en el módulo COMPRAS -> Nueva Compra  -->
head.js("js/jquery.color.js");
<!--(9) plugin jQuery para crear el tip para todos los <title> -
head.js("js/jquery.tools.min.js");
<!--(10) plugin jQuery para crear un colorbox  -->
head.js("js/jquery.colorbox-min.js");

<!--(11) Llamados jquery y funciones del header  -->
head.js("js/header.js");  
<!--(12) aquí pongo todas las funciones hechas por mí que voy a utilizar en el sistema -->  
head.js("js/system_function.js");
<!--(13) aquí pongo la función compras_row() que es la encargada de añadir filas al MÓDULO COMPRAS -> Nueva Compra -->
head.js("js/compras_row.js");
<!--(14) aquí pongo la función charge_article() que es la encargada de cargar los articulos en el MÓDULO COMPRAS -> Nueva Compra -->
head.js("js/charge_articles.js");
<!--(15) aquí pongo la función ventas_row() que es la encargada de añadir filas al MÓDULO VENTAS -> Nueva Venta -->
head.js("js/ventas_row.js");
<!--(16) aquí pongo la función charge_article_ventas() que es la encargada de cargar los articulos en el MÓDULO VENTAS -> Nueva Venta -->
head.js("js/ventas_charge_articles.js");

</script>

<script type="text/javascript" language="javascript"> 
//  Condicional para desactivar el botón atrás del navegador
    if (window.history) {
        function noBack(){window.history.forward()}
        noBack();
        window.onload = noBack;
        window.onpageshow = function(evt){if(evt.persisted)noBack()}
        window.onunload = function(){void(0)}
	}
</script>

</head>
<body <?php if (isset($_GET['mod']) && $_GET['mod'] == "mod_imprimir") echo "class=\"body_background\""; ?> > 
 
<?php 
 if ( empty($_GET['mod']) || ( isset($_GET['mod']) && $_GET['mod'] != "mod_imprimir" ))  {      
     // header del sistema que se muestra cuando no es el MÓDULO IMPRIMIR.
?>	  
	  <?php if ( defined('VALID_LOGIN_VAR') )  { // ESTO ES PARA EL index.php ?>
	            onLoad="document.form_login.usuario.focus();" 
	  <?php } ?>  
 
   <header>
     <!--div del banner  -->
     <div class="banner">
    
     </div>  
     <!-- div de la fecha y la hora -->
     <div style="float: right; color: #4F909E; margin: 5px; padding: 5px; font-family:Tahoma, Geneva, sans-serif;">
     <span>
	 <script languaje="JavaScript"> 
       var mydate=new Date() 
       var year=mydate.getYear() 
       if (year < 1000) 
           year+=1900 
           var day=mydate.getDay() 
           var month=mydate.getMonth() 
           var daym=mydate.getDate() 
           if (daym<10) 
              daym="0"+daym 
              var dayarray=new Array("Domingo,","Lunes,","Martes,","Miércoles,","Jueves,","Viernes,","Sábado,")
              var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
              document.write("Hoy es " +dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year) 
     </script>
     </span>
     <br />
     <span style="margin-top:3px;"> Última actualización de la p&aacute;g: <?php echo gmdate('h:i a', time() - 18000 ); ?> </span>
   </div>
 </header>
 
 
<?php
 } // Fin del if ( empty($_GET['mod']) || ( isset($_GET['mod']) && $_GET['mod'] != "mod_imprimir" ))  {    
?> 