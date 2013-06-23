<?php
/******************************************************************
 Este es el header de todas las p�ginas del sistema:
 - En esta p�gina tambi�n se gestiona el <title> y las <head> de todos los documentos 
-------------------------------------------------------------------------------------------------
0.  --- GENERALES ---
1.  -- Barra de seleccion de cada m�dulo -- ( Barra superior )
2.  --  datepicker  --                      ( Todos los datepicker del sistema )
3.  --  PAGINATION   --                     ( Todas las paginaciones del sistema )
4.  ausu-suggest ( autocomplete )           ( Aqu� van todos los autocomplete del sistema )
5.   M�DULO PROVEEDORES                     ( Todo lo referente al m�dulo PROVEEDORES )
	    PETICIONES AJAX DE PROVEEDORES
6.   M�DULO CLIENTES                        ( Todo lo referente al m�dulo CLIENTES )
	    PETICIONES AJAX DE CLIENTES
7.   M�DULO INVENTARIO                      ( Todo lo referente al m�dulo INVENTARIO )
	    PETICIONES AJAX DE INVENTARIO
8.   M�DULO USUARIOS                        ( Todo lo referente al m�dulo USUARIOS.Ej. validaci�n del form)
9.   M�DULO COMPRAS                         ( Todo lo referente a COMPRAS)
10.  M�DULO CAJA                            ( Todo lo referente al m�dulo CAJA )
11.  M�DULO VENTAS                          ( Todo lo referente al m�dulo VENTAS )

*******************************************************************/
?>
<!doctype html>
<html lang="es">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">  <!-- charset=iso-8859-1" -->
<meta name="description" content="Sistema de control de inventarios y cuentas para peque�os negocios.SSC" />
<!-- Para limpiar la cach� -->
<!--<meta http-equiv="Expires" content="0"> 
<!--<meta http-equiv="Pragma" content="no-cache">

<!-- favicon -->
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

<!-- ARCHIVOS CSS  -->
<link href="css/reset.css" rel="stylesheet" type="text/css" />  <!-- Aqu� se resetean todos los navegadores  -->
<link href="css/style_doc.css" rel="stylesheet" type="text/css" />  <!-- css de general, header, login, footer -->
<link href="css/inside.css" rel="stylesheet" type="text/css" /> <!-- css del interior de la aplicaci�n -->
<link href="css/administrator.css" rel="stylesheet" type="text/css" /> <!-- css del interior de la zona de administraci�n -->
<link href="css/colorbox.css" rel="stylesheet" type="text/css" /> <!-- css del plugin colorbox.jquery -->

<!-- css del plugin de jQuery ausu-autosuggest.js -->
<link href="css/style.css" rel="stylesheet" type="text/css" /> 

<!-- CSS del jquery UI  -->
<link type="text/css" rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" media="screen" />

<title> SSC <?php echo $title_page; ?> </title>

<!-- ARCHIVOS JAVASCRIPT -->
<!-- PARA LA SUBIDA DE ARCHIVOS JAVASCRIPT VAMOS A HACERLO A TRAV�S DE LA API head.load.min.js para aumentar la veloc de carga -->
<!-- plugin jQuery para subir los archivos js en paralelo que me permite una mayor rapidez a la hora de cargar la p�gina -->
<script language="javascript" type="text/javascript" src="js/head.load.min.js"></script>

<script type="text/javascript">
// files are loaded in parallel and executed in order they arrive.
<!-- (1) jQuery -->
head.js("js/jquery-1.7.2.min.js");  
<!--(2) jQuery UI -->
head.js("js/jquery-ui-1.8.21.custom.min.js"); 
<!--(3) plugin jQuery para encriptar los passwords en el navegador   -->
head.js("js/jquery.crypt.js");
<!--(4) plugin jQuery para paginaci�n de tablas   ----  http://neoalchemy.org/tablePagination.html  -->
head.js("js/jquery.tablePagination.0.5.js");
<!--(5) plugin jQuery para autocompletado de un campo text --> 
head.js("js/jquery.ausu-autosuggest.js");
<!--(6) suite de 7 plugins jQuery para muchas cosas (jSlider, jTabs, jPaginate, jSpotlight, jTip, jPlaceholder, y jCollapse) -->
head.js("js/vanity_full_0.3.js");
<!--(7) plugin jQuery para VALIDACI�N DE USUARIOS en un formulario -->
head.js("js/jquery.validate.js");
<!--(8) plugin jQuery para efecto de color a la hora de ELIMINAR una fila en el m�dulo COMPRAS -> Nueva Compra  -->
head.js("js/jquery.color.js");
<!--(9) plugin jQuery para crear el tip para todos los <title> -
head.js("js/jquery.tools.min.js");
<!--(10) plugin jQuery para crear un colorbox  -->
head.js("js/jquery.colorbox-min.js");

<!--(11) Llamados jquery y funciones del header  -->
head.js("js/header.js");  
<!--(12) aqu� pongo todas las funciones hechas por m� que voy a utilizar en el sistema -->  
head.js("js/system_function.js");
<!--(13) aqu� pongo la funci�n compras_row() que es la encargada de a�adir filas al M�DULO COMPRAS -> Nueva Compra -->
head.js("js/compras_row.js");
<!--(14) aqu� pongo la funci�n charge_article() que es la encargada de cargar los articulos en el M�DULO COMPRAS -> Nueva Compra -->
head.js("js/charge_articles.js");
<!--(15) aqu� pongo la funci�n ventas_row() que es la encargada de a�adir filas al M�DULO VENTAS -> Nueva Venta -->
head.js("js/ventas_row.js");
<!--(16) aqu� pongo la funci�n charge_article_ventas() que es la encargada de cargar los articulos en el M�DULO VENTAS -> Nueva Venta -->
head.js("js/ventas_charge_articles.js");

</script>

<script type="text/javascript" language="javascript"> 
//  Condicional para desactivar el bot�n atr�s del navegador
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
     // header del sistema que se muestra cuando no es el M�DULO IMPRIMIR.
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
              var dayarray=new Array("Domingo,","Lunes,","Martes,","Mi�rcoles,","Jueves,","Viernes,","S�bado,")
              var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
              document.write("Hoy es " +dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year) 
     </script>
     </span>
     <br />
     <span style="margin-top:3px;"> �ltima actualizaci�n de la p&aacute;g: <?php echo gmdate('h:i a', time() - 18000 ); ?> </span>
   </div>
 </header>
 
 
<?php
 } // Fin del if ( empty($_GET['mod']) || ( isset($_GET['mod']) && $_GET['mod'] != "mod_imprimir" ))  {    
?> 