/* Archivo donde pondré todos los llamados jquery y las funciones del sistema */ 


head.ready(function () {               // Esto me dice que cargue esto cuando ya estén listos en caché los archivos .js
  $(document).ready(function() {
	 	  
	  /******************************************************************************************
	                               0. -- GENERALES --
	  ******************************************************************************************/
	  	  
	  //(00) Todos los titles van con este TIP   
	  $("[title]").tooltip();
	  
	  //(01) Encripto la contraseña para enviarla a la BD.
	  $('#f_login').submit(function() {
	    cryptsubmit(); //(01) Función que encripta el valor de la variable pass para enviarla encriptada al servidor.
	  });
	 
      //(02) De esta manera muestro todos los tabs
       
	  $(function() {       
	    $( "#tabs" ).tabs().show();
		$(".mov_image").hide();     // Esconde la img de cargando para mostrar el contenido principal
      });
      
      //(03) Muestra EL MÓDULO mod_compras_details para ver los detalles de una compra een particular usando colorbox
	  $("a.colorbox").colorbox({ iframe:true, width:"90%", height:"90%", transition:"elastic" });	  

      //(04) Muestra EL MÓDULO mod_ventas_details para ver los detalles de una venta en particular usando colorbox
	  $("a.colorbox_ventas").colorbox({ iframe:true, width:"90%", height:"90%", transition:"elastic" });
	  
	  //(05) Muestra el SUBMÓDULO mod_add_article para poder añadir artículos al inventario desde la COMPRA.
	  $("a.new_article_from_compras").colorbox({ iframe:true, width:"90%", height:"90%", transition:"elastic" });	

	  /******************************************************************************************
	                               1. -- Barra de seleccion de cada módulo --
	  ******************************************************************************************/
	  
	  /***** MÓDULO REGISTRO BANCARIO  ****/
	  //(021) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_rb" ).buttonset();
	  });
	       
		   //(021-1) De esta manera hago que aparezca el formulario de NUEVO REGISTRO
		   $('#radio-1').click(function () {
		      document.location.href = 'index.php?mod=mod_registro_bancario&optionrb=new_in#tabs-5';
		   });
			 
	       // REPORTES
		   //(021-2) De esta manera hago que aparezcan los reportes del un MES SELECCIONADO.
		   $('#radio-2').click( function () {
		      document.location.href = 'index.php?mod=mod_registro_bancario&optionrb=consulta#tabs-5';
		   });
		   
		   //(021-3) De esta manera hago que aparezcan los reportes del MES ACTUAL.
		   $('#radio-3').click( function () {
		      document.location.href = 'index.php?mod=mod_registro_bancario&optionrb=actual#tabs-5';
		   });
		    
	  /***** MÓDULO CUENTAS X PAGAR *****/
	  //(022) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_cxp" ).buttonset();
	  });
	       //(022-1) De esta manera hago que se muestre el formulario de NUEVO REGISTRO
		   $('#radio_1').click( function (){
		      document.location.href = 'index.php?mod=mod_cuentas_x_pagar&optioncxp=new_in#tabs-3';
		   });
		   		   
		   // REPORTES 
		   //(022-2) De esta manera hago que se muestren los datos para la consulta de cuentas por pagar en un mes-año
		   $('#radio_2').click( function (){
		     document.location.href = 'index.php?mod=mod_cuentas_x_pagar&optioncxp=consulta#tabs-3';
	       });
		   //(022-3) De esta manera hago que se muestren los datos para la consulta de cuentas por pagar SOLO EN EL MES ACTUAL.
		   $('#radio_3').click( function (){
		      document.location.href = 'index.php?mod=mod_cuentas_x_pagar&optioncxp=actual#tabs-3';
		   });
			  
	  /***** MÓDULO CUENTAS X COBRAR *****/
	  //(023) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_cxc" ).buttonset();
	  });
	       //(023-1) De esta manera hago que se muestre el formulario de NUEVO REGISTRO
		   $('#radio1').click( function (){
		      document.location.href = 'index.php?mod=mod_cuentas_x_cobrar&optioncxc=new_in#tabs-4';
		   });
		   
		   // REPORTES
		   //(023-2) De esta manera hago que se muestren los datos para la consulta de cuentas por pagar en un mes-año
		   $('#radio2').click( function (){
		      document.location.href = 'index.php?mod=mod_cuentas_x_cobrar&optioncxc=consulta#tabs-4';
		   });
		   //(023-3) De esta manera hago que se muestren los datos para la consulta de cuentas por pagar SOLO EN EL MES ACTUAL.
		   $('#radio3').click( function (){
		      document.location.href = 'index.php?mod=mod_cuentas_x_cobrar&optioncxc=actual#tabs-4';
		   });
		    
	  /***** MÓDULO PROVEEDORES *****/
	  //(024) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_p" ).buttonset();
	  });
	       //(024-1) De esta manera hago que aparezca el formulario de NUEVO REGISTRO
		   $('#radio_p1').click( function (){
		      $('#nuevo_registro_cxc').fadeIn(2000);  
		     
	       });
	  	  
	  /***** MÓDULO CLIENTES *****/
	  //(025) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_c" ).buttonset();
	  });
	       //(025-1) De esta manera hago que aparezca el formulario de CREAR/ACTUALIZAR
		   $('#radio_c1').click( function (){
		      $('#nuevo_registro_cxc').fadeIn(2000);  
		     
	       });
	  	  
	  /***** MÓDULO EMPRESA *****/
	  //(026) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_em" ).buttonset();
	  });
	       //(026-1) De esta manera hago que aparezca el formulario de NUEVO REGISTRO Y desaparezca la información
		   $('#radioe_1').click( function (){
		      $('#form_empresa').fadeIn(2000);  
		      $('#data_empresa').fadeOut(2000);
	          $('#message_new_empresa').fadeOut(2000);
		   });
	  
	  /***** MÓDULO USUARIOS *****/
	  //(027) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_users" ).buttonset();
	  });
	       //(027-1) De esta manera hago que aparezca el formulario de NUEVO USUARIO
		   $('#radio_users1').click( function (){
		     document.location.href = 'index.php?mod=mod_users&optionusers=new#tabs-2';
	       });
	  
	  	   //(027-2) De esta manera hago que aparezca el formulario de CAMBIAR CONTRASEÑA
		   $('#radio_users2').click( function (){
		     document.location.href = 'index.php?mod=mod_users&optionusers=ch_pass#tabs-2';
	       });	  
	    
	  /***** MÓDULO COMPRAS *****/
	  //(028) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_cyg" ).buttonset();
	  });
	       	  
	       //(028-1) De esta manera hago que aparezca el formulario de CREAR NUEVA COMPRA
		   $('#radio_cyg1').click( function (){
		     document.location.href = 'index.php?mod=mod_compras&optioncomp=nueva_compra#tabs-4';
	       });
		   
		   //(028-2) De esta manera hago que aparezca el formulario para seleccionar el proveedor y ver su historial de COMPRAS.
		   $('#radio_cyg2').click( function (){
		     document.location.href = 'index.php?mod=mod_compras&optioncomp=comp_x_proveedor#tabs-4';
	       });
		   
		   //(028-3) De esta manera hago que aparezca el formulario para seleccionar las fechas y ver todas sus COMPRAS.
		   $('#radio_cyg3').click( function (){
		     document.location.href = 'index.php?mod=mod_compras&optioncomp=res_compras#tabs-4';
	       });
	    
	  /***** MÓDULO INVENTARIO *****/
	  //(029) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_inv" ).buttonset();
	  });
	       //(029-1) De esta manera hago que aparezca el formulario de ADMINISTRAR LOCALES
		   $('#radio_inv1').click( function (){
		     document.location.href = 'index.php?mod=mod_inventario&optioninv=administrar#tabs-3';
	       });
	  
	  	   //(029-2) De esta manera hago que aparezca el formulario de MOVIMIENTOS DE INVENTARIOS
		   $('#radio_inv2').click( function (){
		     document.location.href = 'index.php?mod=mod_inventario&optioninv=mov#tabs-3';
	       });
		   
		   //(029-3) De esta manera hago que aparezca el formulario REPORTES de MOVIMIENTOS DE KARDEX DE UNA ARTÍCULO
		   $('#radio_inv3').click( function (){
		     document.location.href = 'index.php?mod=mod_inventario&optioninv=kardex#tabs-3';
	       });
		   
		   //(029-4) De esta manera hago que aparezca el formulario REPORTES de STOCK DE UN LOCAL CON ARTÍCULOS
		   $('#radio_inv4').click( function (){
		     document.location.href = 'index.php?mod=mod_inventario&optioninv=stock#tabs-3';
	       });
	  
	       //(029-5) De esta manera hago que aparezca el formulario REPORTES de STOCK DE RESUMEN MOV. DE INVENTARIOS
		   $('#radio_inv5').click( function (){
		     document.location.href = 'index.php?mod=mod_inventario&optioninv=mov_invres#tabs-3';
	       });
	    
	  /***** MÓDULO VENTAS *****/
	  //(0210) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_ventas" ).buttonset();
	  });
	       //(0210-1) De esta manera hago que aparezca el formulario de ADMINISTRAR LOCALES
		   $('#radio_v1').click( function (){
		     document.location.href = 'index.php?mod=mod_ventas&optionv=nueva_venta#tabs-1';
	       });
	  
	       // REPORTES //
	  	   //(0210-2) De esta manera hago que aparezca el formulario de PARA VER EL RESUMEN DE VENTAS
		   $('#radio_v2').click( function (){
		     document.location.href = 'index.php?mod=mod_ventas&optionv=res_ventas#tabs-1';
	       });
		 
		   //(0210-3) De esta manera hago que aparezca el formulario de PARA VER LAS VENTAS POR CLIENTE.
		   $('#radio_v3').click( function (){
		     document.location.href = 'index.php?mod=mod_ventas&optionv=ventas_x_clientes#tabs-1';
	       });
		 	  
	  /***** MÓDULO CAJA *****/
	  //(0211) De esta manera muestro los botones de seleccion de acciones.  
	  $(function() {
		$( "#radiobar_cajas" ).buttonset();
	  });
	       //(0211-1) De esta manera hago que aparezca el formulario de crear un INGRESO DE CAJA.
		   $('#radio_cajas1').click( function (){
		     document.location.href = 'index.php?mod=mod_caja&optioncaja=new_in#tabs-2';
	       });
	  
	       //(0211-2) De esta manera hago que aparezca el formulario de ver las cajas de los almacenes de HOY.
		   $('#radio_cajas2').click( function (){
		     document.location.href = 'index.php?mod=mod_caja&optioncaja=actual#tabs-2';
	       });		   
		   
		   //(0211-3) De esta manera hago que aparezca el formulario de ver un reporte de CAJAS ANTERIORES.
		   $('#radio_cajas3').click( function (){
		     document.location.href = 'index.php?mod=mod_caja&optioncaja=otras_cajas#tabs-2';
	       });
	  	  
	  /************************************-- 2. datepicker  --**********************************************/
	    
	  //(03) Este es el datepicker para el campo fecha del módulo REGISTRO BANCARIO
      $("#campofecha").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });  
      //(03.2) Este es el datepicker para el campo fecha COMPRA del módulo CUENTAS POR PAGAR.
	  $("#fecha_pagar").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });   
	  //(03.3) Este es el datepicker para el campo fecha VENCIMIENTO del módulo CUENTAS POR PAGAR.
	  $("#fecha_vencimiento").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  }); 
	  //(03.4) Este es el datepicker para el campo fecha ACTUALIZACION del módulo CUENTAS POR PAGAR.
	  $("#fecha_actualizacion").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.5) Este es el datepicker para el campo fecha REGISTRO del módulo CUENTAS POR COBRAR.
	  $("#fecha_registro_cxc").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.6) Este es el datepicker para el campo fecha VENCIMIENTO del módulo CUENTAS POR COBRAR.
	  $("#fecha_vencimiento_cxc").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.7) Este es el datepicker para el campo fecha COMPRA del módulo CUENTAS POR COBRAR.
	  $("#fecha_cobrar").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });   
	  //(03.8) Este es el datepicker para el campo fecha ACTUALIZACION del módulo CUENTAS POR COBRAR.
	  $("#fecha_actualizacion_cxc").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.9) Este es el datepicker para el campo fecha de REGISTRO del módulo PROVEEDORES.
	  $("#fecha_proveedor").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
      //(03.10) Este es el datepicker para el campo fecha de REGISTRO del módulo CLIENTES.
	  $("#fecha_cliente").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.11) Este es el datepicker para el campo fecha de REGISTRO del módulo COMPRAS.
	  $("#fecha_compra").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.12) Este es el datepicker para el campo fecha INICIAL en el RESUMEN DE COMPRAS del módulo COMPRAS.
	  $("#fecha_inicialrescompras").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.13) Este es el datepicker para el campo fecha FINAL en el RESUMEN DE COMPRAS del módulo COMPRAS.
	  $("#fecha_finalrescompras").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.14) Este es el datepicker para el campo fecha de REGISTRO DE MOVIMIENTO del módulo INVENTARIO.
	  $("#fecha_movimiento").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.15) Este es el datepicker para el campo fecha de FECHA INICIAL del módulo INVENTARIO -> kardex.
	  $("#fecha_inicialk").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.16) Este es el datepicker para el campo fecha de FECHA FINAL del módulo INVENTARIO -> kardex.
	  $("#fecha_finalk").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.17) Este es el datepicker para el campo fecha de FECHA INICIAL del módulo INVENTARIO -> res. mov. inv..
	  $("#fecha_inicialres").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.18) Este es el datepicker para el campo fecha de FECHA FINAL del módulo INVENTARIO -> res. mov. inv..
	  $("#fecha_finalres").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.19) Este es el datepicker para el campo FECHA DE PAGO 1 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago1").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.20) Este es el datepicker para el campo FECHA DE PAGO 2 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago2").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.21) Este es el datepicker para el campo FECHA DE PAGO 3 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago3").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.22) Este es el datepicker para el campo FECHA DE PAGO 4 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago4").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.23) Este es el datepicker para el campo FECHA DE PAGO 5 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago5").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.24) Este es el datepicker para el campo FECHA DE PAGO 6 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago6").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.25) Este es el datepicker para el campo FECHA DE PAGO 7 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago7").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.26) Este es el datepicker para el campo FECHA DE PAGO 8 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago8").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.27) Este es el datepicker para el campo FECHA DE PAGO 9 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago9").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.28) Este es el datepicker para el campo FECHA DE PAGO 10 del módulo COMPRAS -> Nueva Compra -> Cant. de Pagos.
	  $("#fecha_pago10").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.29) Este es el datepicker para el campo FECHA DE TRANSACCIÓN del módulo CAJA -> Nueva Transacción.
	  $("#fecha_transaccion").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.30) Este es el datepicker para el campo FECHA DE INICIO del módulo CAJA -> Ver Cajas Anteriores.
	  $("#fecha_inicio_ant").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.31) Este es el datepicker para el campo FECHA FINAL del módulo CAJA -> Ver Cajas Anteriores.
	  $("#fecha_final_ant").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.32) Este es el datepicker para el campo FECHA del módulo VENTAS -> Nueva Venta.
	  $("#fecha_venta").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.33) Este es el datepicker para el campo FECHA del módulo VENTAS -> Nueva Venta -> Cantidad de Pagos.
	  $("#fecha_pago1_ventas").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.34) Este es el datepicker para el campo FECHA del módulo VENTAS -> Nueva Venta -> Cantidad de Pagos.
	  $("#fecha_pago2_ventas").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.35) Este es el datepicker para el campo FECHA del módulo VENTAS -> Nueva Venta -> Cantidad de Pagos.
	  $("#fecha_pago3_ventas").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.36) Este es el datepicker para el campo FECHA del módulo VENTAS -> Nueva Venta -> Cantidad de Pagos.
	  $("#fecha_pago4_ventas").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.37) Este es el datepicker para el campo FECHA del módulo VENTAS -> Nueva Venta -> Cantidad de Pagos.
	  $("#fecha_pago5_ventas").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.38) Este es el datepicker para el campo FECHA INICIAL del módulo VENTAS -> Ver Resumen de Ventas -> Campo Fecha.
	  $("#fecha_inicialresventas").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	  //(03.39) Este es el datepicker para el campo FECHA FINAL del módulo VENTAS -> Ver Resumen de Ventas -> Campo Fecha.
	  $("#fecha_finalresventas").datepicker({  
		dateFormat: "yy-mm-dd",
		dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"], 
		monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"] 
	  });
	    
	/*********************************-- 3. PAGINATION   --********************************/
	  
	  //(03.1) Para la paginación de la tabla de los REGISTROS BANCARIOS.
	  $("#table_form_pagination").tablePagination({   
		currPage : 1,                          // Esta es la página en la que se inicia la paginación.
        optionsForRows : [5,10,30,50,100,500], // Opciones de cantidad de páginas a mostrar en la paginación.
        rowsPerPage : 30,                      // Muestra la cantidad de páginas en el inicio.
        topNav : false                         // Mustra la paginación abajo de la tabla.
      });  
       
	 //(03.2) Para la paginación de la tabla de las CUENTAS POR PAGAR.
	  $("#table_form_pagination_cxp").tablePagination({   
		currPage : 1,                          // Esta es la página en la que se inicia la paginación.
        optionsForRows : [5,10,30,50,100,500], // Opciones de cantidad de páginas a mostrar en la paginación.
        rowsPerPage : 30,                      // Muestra la cantidad de páginas en el inicio.
        topNav : false                         // Mustra la paginación abajo de la tabla.
      });   
	  
	  //(03.3) Para la paginación de la tabla de los PROVEEDORES.
	  $("#table_pagination_proveedores").tablePagination({   
		currPage : 1,                          // Esta es la página en la que se inicia la paginación.
        optionsForRows : [5,10,30,50,100,500], // Opciones de cantidad de páginas a mostrar en la paginación.
        rowsPerPage : 30,                      // Muestra la cantidad de páginas en el inicio.
        topNav : false                         // Mustra la paginación abajo de la tabla.
      }); 
	  
	  //(03.4) Para la paginación de la tabla de los CLIENTES.
	  $("#table_pagination_clientes").tablePagination({   
		currPage : 1,                          // Esta es la página en la que se inicia la paginación.
        optionsForRows : [5,10,30,50,100,500], // Opciones de cantidad de páginas a mostrar en la paginación.
        rowsPerPage : 30,                      // Muestra la cantidad de páginas en el inicio.
        topNav : false                         // Mustra la paginación abajo de la tabla.
      }); 
	  
	  //(03.5) Para la paginación de la tabla de las CUENTAS POR COBRAR.
	  $("#table_form_pagination_cxc").tablePagination({   
		currPage : 1,                          // Esta es la página en la que se inicia la paginación.
        optionsForRows : [5,10,30,50,100,500], // Opciones de cantidad de páginas a mostrar en la paginación.
        rowsPerPage : 30,                      // Muestra la cantidad de páginas en el inicio.
        topNav : false                         // Mustra la paginación abajo de la tabla.
      });  
	  
	  //(03.6) Para la paginación de la tabla de las ARTÍCULOS DE INVENTARIO.
	  $("#table_pagination_inventario").tablePagination({   
		currPage : 1,                          // Esta es la página en la que se inicia la paginación.
        optionsForRows : [5,10,30,50,100,500], // Opciones de cantidad de páginas a mostrar en la paginación.
        rowsPerPage : 30,                      // Muestra la cantidad de páginas en el inicio.
        topNav : false                         // Mustra la paginación abajo de la tabla.
      }); 
	  
	  //(03.7) Para la paginación de la tabla del KARDEX de artículos de INVENTARIO -> REPORTE.
	  $("#table_pagination_kardex").tablePagination({   
		currPage : 1,                          // Esta es la página en la que se inicia la paginación.
        optionsForRows : [5,10,30,50,100,500], // Opciones de cantidad de páginas a mostrar en la paginación.
        rowsPerPage : 30,                      // Muestra la cantidad de páginas en el inicio.
        topNav : false                         // Mustra la paginación abajo de la tabla.
      }); 
	  
	  //(03.8) Para la paginación de la tabla de los registros de las COMPRAS.
	  $("#table_pagination_compras").tablePagination({   
		currPage : 1,                          // Esta es la página en la que se inicia la paginación.
        optionsForRows : [5,10,30,50,100,500], // Opciones de cantidad de páginas a mostrar en la paginación.
        rowsPerPage : 30,                      // Muestra la cantidad de páginas en el inicio.
        topNav : false                         // Mustra la paginación abajo de la tabla.
      });
	  	  
	  /*********************************-- 4. ausu-suggest ( autocomplete ) --********************************/
	  
	  //(04.1) Para el autocompletado de los registros de proveedores en el módulo CUANTAS X PAGAR.
      $.fn.autosugguest ({  
           className: 'ausu-suggest',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/data_proveedor.php',
	  });
	    
      //(04.2) Para el autocompletado de los registros de clientes en el módulo CUANTAS X COBRAR.
	  $.fn.autosugguest ({  
           className: 'autocomplete_cxc',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/data_clientes.php',
	  });
	   
	  //(04.3) Para el autocompletado de los registros de la descripción de los artículos del módulo INVENTARIO -> MOVIMIENTO
      $.fn.autosugguest ({  
           className: 'autocomplete_descrip',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/data_select_descrip_articulo.php',
	  });
	 
	  //(04.4) Para el autocompletado de los registros de la descripción de los artículos del módulo INVENTARIO -> KARDEX
      $.fn.autosugguest ({  
           className: 'autocomplete_kardex',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/data_select_descrip_articulo.php',
	  });
	 
	  //(04.5) Para el autocompletado del proveedor cuando voy a insertar nuevos artículos del módulo INVENTARIO -> Nuevo Artículo
      $.fn.autosugguest ({  
           className: 'autocomplete_proveedor_articulo',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/data_proveedor.php',
	  });
	 
	  //(04.6) Para el autocompletado del módulo usuarios al cual quiero cambiarle la contraseña desde el administrador
      $.fn.autosugguest ({  
           className: 'autocomplete_change_pass',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/data_users_change_pass.php',
	  });
	  
	  //(04.7) Para el autocompletado del módulo compras -> Nueva Compra -> Para seleccionar el proveedor.
      $.fn.autosugguest ({  
           className: 'autocomplete_proveedor_ruc',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/data_proveedor_ruc.php',
	  });
	 
	  //(04.8) Para el autocompletado del módulo compras -> Ver Compras por Proveedor -> Para seleccionar el proveedor.
      $.fn.autosugguest ({  
           className: 'autocomplete_proveedor_compras_reporte',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/data_proveedor.php',
	  });
	 
	  //(04.9) Para el autocompletado del módulo ventas -> Nueva Venta -> Para seleccionar el cliente de la venta.
      $.fn.autosugguest ({  
           className: 'autocomplete_cliente_venta',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/ventas_data_cliente.php',
	  });
	  
	  //(04.10) Para el autocompletado del módulo ventas -> Ver Ventas por Cliente -> Para seleccionar el cliente del reporte de la venta 
      $.fn.autosugguest ({  
           className: 'autocomplete_cliente_ventas_reporte',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'ajax/ventas_data_cliente.php',
	  });
	  
	 /************************************************************************************************
	                                          5.   MÓDULO PROVEEDORES
	 **************************************************************************************************/
  
      //(05) El botón de añadir nuevo contacto en el módulo de 'proveedores'
      $('#add_contact_button').click( function (){
		$('#new_contact').fadeIn(3000);  
		$('#add_contact').fadeOut(2000); 
	  });
        	  
	  /************************** PETICIÓN AJAX DE PROVEEDORES *******************************/
	  /****** PRIMERA PETICIÓN ******/
	  //(05.1) El link de editar contacto mediante AJAX del módulo de 'proveedores'
	  $('.edit_contact').click( function(){
		//(1) Desvanezco el formulario de "Editar los Datos del Proveedor y "Añadir contacto" y aparezco el de "new contact"
		  $('#add_proveedor').fadeOut(1200);
		  $('#add_contact').fadeOut(1200); 
		  $('#edit_contact').fadeIn(3000);
		
		//(2) Selecciono el value del radio botón que marqué en (id_edit).   
		  for ( i=0; i < document.form_delete_contactos.elements.length; i++ ) 
	      {
	          if ( document.form_delete_contactos.elements[i].type == "radio")	 {
			      if (document.form_delete_contactos.elements[i].checked == 1 )  {
				      var id_edit = document.form_delete_contactos.elements[i].value;
				      break;   
			      } else {
			          continue;
			      }
		      } else {
				  continue;  
			  }
	      }  // Fin del FOR
		  
		//(3) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/edit_contact.php?edit=' + id_edit,  //url que procesa la petición (archivo php).
			 async:       true,          // Petición asincrónica al servidor.
			 success:     show_campos,   // Función que se llama cuando la petición se ha completado de forma correcta. 
			 beforeSend:  inicio_envio,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message,  // Función que se ejecuta cuando hay un error en la petición.   
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  
	  });
      
	  // Funciones para esta petición AJAX ( Sólo falta show_campos que está en sytem_function.js )
	  function inicio_envio()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $("#cargando").css("display", "inline");  
	  }
     
	  function stop_cargando()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $("#cargando").css("display", "none");
	  }
	  
	  function show_error_message()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     $("#server_error").css("display", "inline");
		 
      }
	    
	  /******* SEGUNDA PETICIÓN  *******/
	  /*(5.2)************************* PETICIÓN AJAX PARA CARGAR UN MENSAJE SI YA EL RUC EXISTE EN LA BD *******************************/
	  // Selecciono un blur al terminar la escritura del RUC 
	  $('#ruc_proveedor').blur(function(){
	 	 
	     //(01) Gaurdo el RUC del proveedor en una variable para pasar en la consulta AJAX.
		 var ruc_proveedor = document.form_proveedor.ruc_proveedor.value
	     //(02) Aquí pongo el código de la llamada ajax     
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/confirm_ruc.php?ruc=' + ruc_proveedor,  
			 async:       true,          
			 success:     show_message_ruc,   
			 beforeSend:  inicio_check_ruc,  // Función que se llama al realizar la petición.
			 complete:    stop_check_ruc,    // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_ruc,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	  
	  function show_message_ruc(data)
	  {
		  data = eval(data);  
	       	  
		  if ( data.ruc == 'true' )  {	  
		     // Esto significa que el RUC se puede escribir en la BD. No existe.
		     //01 Mensaje de OK.
			 document.getElementById('show_message_ruc').innerHTML = '<b style=\'color:green;\'>RUC permitido</b>';
		     //02 Igualo el valor del campo oculto hidden_ruc a 1
			 document.form_proveedor.hidden_ruc.value = 1;
			 //03 Chequeo si el campo hidden_cedula está en 0.
			 if ( document.form_proveedor.hidden_cedula.value == 0 ) {
				 // Significa que el número de cédula ya está en la base de datos y se DEBE MANTENER el submit INHABILITADO. 
				 $('#cp_submit').attr('disabled','disabled');
             } else {
				 $('#cp_submit').removeAttr('disabled');
             }  
		  		  
		  } else if ( data.ruc == 'false') {
			 // Esto significa que el RUC ya existe en la BD. MENSAJE DE ERROR. 
		     //04 Mensaje de Error.
			 document.getElementById('show_message_ruc').innerHTML = '<b style=\'color:red;\'>Ya existe este RUC en la Base de Datos</b>';
		     //05 Igualo el valor del campo oculto hidden_ruc a 0
			 document.form_proveedor.hidden_ruc.value = 0;
			 //06 Deshabilito el botón SUBMIT.
			 $('#cp_submit').attr('disabled','disabled');
          }  
	  }  // Fin de la función show_message_ruc(data)
	  
	  function inicio_check_ruc()
	  {
		$("#charging").css("display", "inline"); 
	  }
	  
	  function stop_check_ruc()
	  {
		$("#charging").css("display", "none");  
	  }
	  
	  function show_error_message_ruc()
	  {
	     $("#server_error_charging").css("display", "inline");
	  }
	   	  
	  /******* TERCERA PETICIÓN  *******/
	  /*(5.3)************************* PETICIÓN AJAX PARA CARGAR UN MENSAJE SI YA LA CÉDULA EXISTE EN LA BD *************************/
	  // Selecciono un blur al terminar la escritura del RUC 
	  $('#cedula_proveedor').blur(function(){
	 	 
	     //(01) Gaurdo la CÉDULA del proveedor en una variable para pasar en la consulta AJAX.
		 var cedula_proveedor = document.form_proveedor.cedula_proveedor.value
	     //(02) Aquí pongo el código de la llamada ajax     
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/confirm_cedula.php?cedula=' + cedula_proveedor,  
			 async:       true,          
			 success:     show_message_cedula,   
			 beforeSend:  inicio_check_cedula,  // Función que se llama al realizar la petición.
			 complete:    stop_check_cedula,    // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_cedula,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	  
	  function show_message_cedula(data)
	  {
		  data = eval(data);  
	       	  
		  if ( data.cedula == 'true' )  {	  
		     // Esto significa que la CÉDULA se puede escribir en la BD. No existe.
		     //01 Mensaje de ok.
			 document.getElementById('show_message_cedula').innerHTML = '<b style=\'color:green;\'>C&Eacute;DULA permitida</b>';
		     //02 Igualo el valor del campo oculto hidden cédula a 1
			 document.form_proveedor.hidden_cedula.value = 1;
			 //03 Chequeo si el campo hidden_ruc está en 0.
			 if ( document.form_proveedor.hidden_ruc.value == 0 ) {
				 // Significa que el número de RUC ya está en la base de datos y se DEBE MANTENER el submit INHABILITADO. 
				 $('#cp_submit').attr('disabled','disabled');
             } else {
				 $('#cp_submit').removeAttr('disabled');
             } 
		  } else if ( data.cedula == 'false') {
			 // Esto significa que el número de cédula ya existe en la BD. MENSAJE DE ERROR. 
		     //04 Mensaje de Error.
			 document.getElementById('show_message_cedula').innerHTML = '<b style=\'color:red;\'>Ya existe esta C&Eacute;DULA en la Base de Datos</b>';
		     //05 Igualo el valor del campo oculto hidden_cedula a 0
			 document.form_proveedor.hidden_cedula.value = 0;
			 //06 Deshabilito el botón SUBMIT.
			 $('#cp_submit').attr('disabled','disabled');
		  }  
	  }  // Fin de la función show_message_cedula(data)
	  	  
	  function inicio_check_cedula()
	  {
		$("#carging").css("display", "inline"); 
	  }
	  
	  function stop_check_cedula()
	  {
		$("#carging").css("display", "none");  
	  }
	  
	  function show_error_message_cedula()
	  {
	     $("#server_error_carging").css("display", "inline");
	  }
	   	  
	  /************************** FIN DE LA PETICIÓN AJAX DE PROVEEDORES  *******************************/
	  
	 /************************************************************************************************
	                                          6.   MÓDULO CLIENTES
	 **************************************************************************************************/
	 
	 //(06) El botón de añadir nuevo contacto en el módulo de 'clientes'
      $('#add_contact_button_clientes').click( function (){
		$('#new_contact_cliente').fadeIn(3000);  
		$('#add_contact_cliente').fadeOut(2000); 
	  });
	 	 
	 /************************** PETICIÓN AJAX DE CLIENTES  *******************************/
	  /*** PRIMERA PETICIÓN AJAX ***/
	  //(06.1) El link de editar contacto mediante AJAX del módulo de 'clientes'
	  $('.edit_contact_cliente').click( function(){
		//(1) Desvanezco el formulario de "Editar los Datos del Proveedor y "Añadir contacto" y aparezco el de "new contact"
		  $('#add_cliente').fadeOut(1200);
		  $('#add_contact_cliente').fadeOut(1200); 
		  $('#edit_contact_cliente').fadeIn(3000);
		
		//(2) Selecciono el value del radio botón que marqué en (id_edit).   
		  for ( i=0; i < document.form_delete_contactos_clientes.elements.length; i++ ) 
	      {
	          if ( document.form_delete_contactos_clientes.elements[i].type == "radio")	 {
			      if (document.form_delete_contactos_clientes.elements[i].checked == 1 )  {
				      var id_edit = document.form_delete_contactos_clientes.elements[i].value;
				      break;   
			      } else {
			          continue;
			      }
		      } else {
				  continue;  
			  }
	      }  // Fin del FOR
		  
		//(3) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/edit_contact.php?edit=' + id_edit,  //url que procesa la petición (archivo php).
			 async:       true,          // Petición asincrónica al servidor.
			 success:     show_campos_clientes,   // Función que se llama cuando la petición se ha completado de forma correcta. 
			 beforeSend:  inicio_envio_clientes,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_clientes, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_clientes,  // Función que se ejecuta cuando hay un error en la petición.   
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
      
	  // Funciones para esta petición AJAX ( Sólo falta show_campos que está en sytem_function.js )
	  function inicio_envio_clientes()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $("#cargando_gif").css("display", "inline");  
	  }
     
	  function stop_cargando_clientes()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $("#cargando_gif").css("display", "none");
	  }
	  
	  function show_error_message_clientes()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     $("#server_error_gif").css("display", "inline");
	  }
	  	  
	  /*** SEGUNDA PETICIÓN AJAX ***/
	  /*(6.2)************************* PETICIÓN AJAX PARA CARGAR UN MENSAJE SI YA EL RUC EXISTE EN LA BD *******************************/
	  // Selecciono un blur al terminar la escritura del RUC 
	  $('#ruc_cliente').blur(function(){
	 	 
	     //(01) Gaurdo el RUC del proveedor en una variable para pasar en la consulta AJAX.
		 var ruc_cliente = document.form_cliente.ruc_cliente.value
	     //(02) Aquí pongo el código de la llamada ajax     
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/confirm_ruc.php?ruc=' + ruc_cliente,  
			 async:       true,          
			 success:     show_cliente_message_ruc,   
			 beforeSend:  inicio_cliente_check_ruc,  // Función que se llama al realizar la petición.
			 complete:    stop_cliente_check_ruc,    // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_cliente_ruc,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	  
	  function show_cliente_message_ruc(data)
	  {
		  data = eval(data);  
	       	  
		  if ( data.ruc == 'true' )  {	  
		     // Esto significa que el RUC se puede escribir en la BD. No existe.
		     //01 Mensaje de OK.
			 document.getElementById('show_cliente_message_ruc').innerHTML = '<b style=\'color:green;\'>RUC permitido</b>';
		     //02 Igualo el valor del campo oculto hidden_ruc a 1
			 document.form_cliente.hidden_ruc.value = 1;
			 //03 Chequeo si el campo hidden_cedula está en 0.
			 if ( document.form_cliente.hidden_cedula.value == 0 ) {
				 // Significa que el número de cédula ya está en la base de datos y se DEBE MANTENER el submit INHABILITADO. 
				 $('#c_submit').attr('disabled','disabled');
             } else {
				 $('#c_submit').removeAttr('disabled');
             }  
		  } else if ( data.ruc == 'false') {
			 // Esto significa que el RUC ya existe en la BD. MENSAJE DE ERROR. 
		     //04 Mensaje de Error.
			 document.getElementById('show_cliente_message_ruc').innerHTML = '<b style=\'color:red;\'>Ya existe este RUC en la Base de Datos</b>';
		     //05 Igualo el valor del campo oculto hidden_ruc a 0
			 document.form_cliente.hidden_ruc.value = 0;
			 //06 Deshabilito el botón SUBMIT.
			 $('#c_submit').attr('disabled','disabled');
          }  
	  }  // Fin de la función show_message_ruc(data)
	  
	  function inicio_cliente_check_ruc()
	  {
		$("#c_charging").css("display", "inline"); 
	  }
	  
	  function stop_cliente_check_ruc()
	  {
		$("#c_charging").css("display", "none");  
	  }
	  
	  function show_error_message_cliente_ruc()
	  {
	     $("#c_server_error_charging").css("display", "inline");
	  }
	  	  
	  /******* TERCERA PETICIÓN  *******/
	  /*(6.3)************************* PETICIÓN AJAX PARA CARGAR UN MENSAJE SI YA LA CÉDULA EXISTE EN LA BD **********************/
	  // Selecciono un blur al terminar la escritura del RUC 
	  $('#cedula_cliente').blur(function(){
	 	 
	     //(01) Gaurdo la CÉDULA del cliente en una variable para pasar en la consulta AJAX.
		 var cedula_cliente = document.form_cliente.cedula_cliente.value
	     //(02) Aquí pongo el código de la llamada ajax     
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/confirm_cedula.php?cedula=' + cedula_cliente,  
			 async:       true,          
			 success:     show_cliente_message_cedula,   
			 beforeSend:  inicio_cliente_check_cedula,  // Función que se llama al realizar la petición.
			 complete:    stop_cliente_check_cedula,    // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_cliente_error_message_cedula,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	  
	  function show_cliente_message_cedula(data)
	  {
		  data = eval(data);  
	       	  
		  if ( data.cedula == 'true' )  {	  
		     // Esto significa que la CÉDULA se puede escribir en la BD. No existe.
		     //01 Mensaje de ok.
			 document.getElementById('show_cliente_message_cedula').innerHTML = '<b style=\'color:green;\'>C&Eacute;DULA permitida</b>';
		     //02 Igualo el valor del campo oculto hidden cédula a 1
			 document.form_cliente.hidden_cedula.value = 1;
			 //03 Chequeo si el campo hidden_ruc está en 0.
			 if ( document.form_cliente.hidden_ruc.value == 0 ) {
				 // Significa que el número de RUC ya está en la base de datos y se DEBE MANTENER el submit INHABILITADO. 
				 $('#c_submit').attr('disabled','disabled');
             } else {
				 $('#c_submit').removeAttr('disabled');
             } 
		  } else if ( data.cedula == 'false') {
			 // Esto significa que el número de cédula ya existe en la BD. MENSAJE DE ERROR. 
		     //04 Mensaje de Error.
			 document.getElementById('show_cliente_message_cedula').innerHTML = '<b style=\'color:red;\'>Ya existe esta C&Eacute;DULA en la Base de Datos</b>';
		     //05 Igualo el valor del campo oculto hidden_cedula a 0
			 document.form_cliente.hidden_cedula.value = 0;
			 //06 Deshabilito el botón SUBMIT.
			 $('#c_submit').attr('disabled','disabled');
		  }  
	  }  // Fin de la función show_cliente_message_cedula(data)
	  	  
	  function inicio_cliente_check_cedula()
	  {
		$("#c_carging").css("display", "inline"); 
	  }
	  
	  function stop_cliente_check_cedula()
	  {
		$("#c_carging").css("display", "none");  
	  }
	  
	  function show_cliente_error_message_cedula()
	  {
	     $("#c_server_error_carging").css("display", "inline");
	  }
	     
	  /************************** FIN DE LA PETICIÓN AJAX DE CLIENTES *******************************/
	 	 	 
	 /************************************************************************************************
	                                           7.  MÓDULO INVENTARIO
	 **************************************************************************************************/
	 
	  /**** PRIMERA PETICIÓN AJAX ****/
	  /************************** PETICIÓN AJAX DE EDICIÓN DE LOCALES DE INVENTARIOS *******************************/
	  //(07.1) El link de editar LOCAL mediante AJAX del módulo de 'inventario'
	  $('.edit_local_inv').click( function(){
			
		//(2) Selecciono el value del radio botón que marqué.   
		  for ( i=0; i < document.numero_locales.elements.length; i++ ) 
	      {
	          if ( document.numero_locales.elements[i].type == "radio")	 {
			      if (document.numero_locales.elements[i].checked == 1 )  {
				      var id_local_edit = document.numero_locales.elements[i].value;
				      break;   
			      } else {
			          continue;
			      }
		      } else {
				  continue;  
			  }
	      }  // Fin del FOR
		  
		//(3) Aquí pongo el código de la llamada ajax     --> <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/edit_local_inventario.php?edit=' + id_local_edit,  //url que procesa la petición (archivo php).
			 async:       true,          // Petición asincrónica al servidor.
			 success:     show_campos_local,   // Función que se llama cuando la petición se ha completado de forma correcta. 
			 beforeSend:  inicio_envio_local,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_local, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_local,  // Función que se ejecuta cuando hay un error en la petición.   
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
      
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_local()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $("#cargando_local").css("display", "inline");  
	  }
     
	  function stop_cargando_local()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $("#cargando_local").css("display", "none");
	  }
	  
	  function show_error_message_local()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     $("#server_error_local").css("display", "inline");
	  }
	  
	  /************************** FIN DE LA PETICIÓN AJAX DE LOCALES DE INVENTARIOS  *******************************/
	 	 
	 /**** SEGUNDA PETICIÓN AJAX ****/
	 /*(7.2)************************* PETICIÓN AJAX PARA CARGAR EL STOCK ACTUAL DEL ARTÍCULO EN EL ORIGEN ******************/
	  //(0n) SELECCIONO un LOCAL ORIGEN y al salir de ahí me busca por ajax la cantidad de artículos en el stock que hay en ese local.
	  $('#origen_mov').change(function(){
	 	 
	     //(01) Busco el Nombre de la tabla donde voy a buscar el CÓDIGO DEL ARTÍCULO a través del id del LOCAL.
		 var id_local = document.form_nuevo_mov.origen_mov.value
	     //(02) Busco el CÓDIGO DEL ARTÍCULO DEL CAMPO Código del Artículo
		 if ( document.getElementById('type_descripcion').checked == 1 )  { 
		    // CASO 1. CAMPO HIDDEN CON EL VALOR DEL CÓDIGO DEL ARTÍCULO
		    var cod_articulo = document.form_nuevo_mov.codigo_articulo.value; 
		
		 } else if ( document.getElementById('type_codigo').checked == 1 )  {
			// CASO 2. CAMPO HIDDEN CON EL VALOR DEL CÓDIGO DEL ARTÍCULO
		     var cod_articulo = document.form_nuevo_mov.codigo_articulo2.value; 
		 }
		 	 				 
		 //(03) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_stock_origen.php?code=' + cod_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     show_stock_origen,   
			 beforeSend:  inicio_envio_stock,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_stock, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_stock,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	 
	  function show_stock_origen(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra el valor del stock actual, de la respuesta en json de la peticion ajax a search_articulo_stock_origen.php
	       document.form_nuevo_mov.stock_origen.value = data.stock_actual; 
	  }   // Fin de la función stock_origen(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_stock()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $("#cargando_stock").css("display", "inline");  
	  }
     
	  function stop_cargando_stock()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $("#cargando_stock").css("display", "none");
	  }
	  
	  function show_error_message_stock()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     $("#server_error_stock").css("display", "inline");
	  }
	
	 /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR EL STOCK ACTUAL DEL ARTÍCULO EN EL ORIGEN *********************/
	
	/**** TERCERA PETICIÓN AJAX ****/
	/*(7.3)************************* PETICIÓN AJAX PARA CARGAR EL STOCK ACTUAL DEL ARTÍCULO EN EL DESTINO *******************************/
	  //(0n) SELECCIONO un LOCAL DESTINO y al salir de ahí me busca por ajax la cantidad de artículos en el stock que hay en ese local.
	  $('#destino_mov').change(function(){
	 	 
		 //(01) Busco el Nombre de la tabla donde voy a buscar el CÓDIGO DEL ARTÍCULO a través del id del LOCAL.
		 var id_local = document.form_nuevo_mov.destino_mov.value;
	     //(02) Busco el CÓDIGO DEL ARTÍCULO DEL CAMPO Código del Artículo
		 if ( document.getElementById('type_descripcion').checked == 1 )  { 
		    // CASO 1. CAMPO HIDDEN CON EL VALOR DEL CÓDIGO DEL ARTÍCULO
		    var cod_articulo = document.form_nuevo_mov.codigo_articulo.value; 
		
		 } else if ( document.getElementById('type_codigo').checked == 1 )  {
			// CASO 2. CAMPO HIDDEN CON EL VALOR DEL CÓDIGO DEL ARTÍCULO
		     var cod_articulo = document.form_nuevo_mov.codigo_articulo2.value; 
		 }
		 			 
		 //(03) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_stock_destino.php?code=' + cod_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     show_stock_destino,   
			 beforeSend:  inicio_send_stock,  // Función que se llama al realizar la petición.
			 complete:    stop_charging_stock, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_Error_message_stock,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	 
	  function show_stock_destino(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra el valor del stock actual, de la respuesta en json de la peticion ajax a search_articulo_stock_origen.php
	       document.form_nuevo_mov.stock_destino.value = data.stock_actual; 
	  }   // Fin de la función stock_origen(data)
	 
	  // Funciones para esta petición AJAX 
	  function inicio_send_stock()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $("#cargando_stock").css("display", "inline");  
	  }
     
	  function stop_charging_stock()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $("#cargando_stock").css("display", "none");
	  }
	  
	  function show_Error_message_stock()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     $("#server_error_stock").css("display", "inline");
	  }
	 	  
	 /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR EL STOCK ACTUAL DEL ARTÍCULO EN EL DESTINO *********************/
		
	  /******* CUARTA PETICIÓN AJAX *******/
	  /*(7.4)************************* PETICIÓN AJAX PARA VERIFICAR SI EXISTE EL CÓDIGO DEL ARTÍCULO EN LA BD *******************************/
	  // Selecciono un blur al terminar la escritura del CÓDIGO DEL ARTÍCULO. 
	  // INVENTARIO -> NUEVO ARTÍCULO.
	  $('#codigo_articulo').blur(function(){
	 	 
	     //(01) Gaurdo el CÓDIGO DEL ARTÍCULO en una variable para pasar en la consulta AJAX.
		 var codigo_articulo = document.form_nuevo_articulo.codigo_art.value
	     //(02) Aquí pongo el código de la llamada ajax     
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/confirm_codigo.php?codigo_art=' + codigo_articulo,  
			 async:       true,          
			 success:     show_message_cod,   
			 beforeSend:  inicio_check_cod,  // Función que se llama al realizar la petición.
			 complete:    stop_check_cod,    // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_cod,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	  
	  function show_message_cod(data)
	  {
		  data = eval(data);  
	       	  
		  if ( data.codigo_art == 'true' )  {	  
		     // Esto significa que el CÓDIGO se puede escribir en la BD. No existe.
		     //01 Mensaje de OK.
			 document.getElementById('show_message_codigo_art').innerHTML = '<b style=\'color:green;\'>C\xF3digo del art\xEDculo disponible</b>';
		     //02 Igualo el valor del campo oculto hidden_codigo_art a 1
			 document.form_nuevo_articulo.hidden_codigo_art.value = 1;
			 //03 Chequeo si el campo hidden_codigo_art está en 0.
			 if ( document.form_nuevo_articulo.hidden_codigo_art.value == 0 ) {
				 // Significa que el número de cédula ya está en la base de datos y se DEBE MANTENER el submit INHABILITADO. 
				 $('#submit_new_art').attr('disabled','disabled');
             } else {
				 $('#submit_new_art').removeAttr('disabled');
             }  
		  } else if ( data.codigo_art == 'false') {
			 // Esto significa que el CÓDIGO DEL artículo ya existe en la BD. MENSAJE DE ERROR. 
		     //04 Mensaje de Error.
			 document.getElementById('show_message_codigo_art').innerHTML = '<b style=\'color:red;\'>Ya existe este C\xF3digo en la Base de Datos</b>';
		     //05 Igualo el valor del campo oculto hidden_codigo_art a 0
			 document.form_nuevo_articulo.hidden_codigo_art.value = 0;
			 //06 Deshabilito el botón SUBMIT.
			 $('#submit_new_art').attr('disabled','disabled');
          }  
	  }  // Fin de la función show_message_cod(data)
	  
	  function inicio_check_cod()
	  {
		$("#charging_aj").css("display", "inline"); 
	  }
	  
	  function stop_check_cod()
	  {
		$("#charging_aj").css("display", "none");  
	  }
	  
	  function show_error_message_cod()
	  {
	     $("#server_error_charging_aj").css("display", "inline");
	  }
	    
	 /***************** FIN DE LA PETICIÓN AJAX PARA VERIFICAR SI EXISTE EL CÓDIGO DEL ARTÍCULO EN LA BD (NUEVO ARTÍCULO)*********************/
		
	  /******* QUINTA PETICIÓN AJAX *******/
	  /*(7.5)************************* PETICIÓN AJAX PARA VERIFICAR SI EXISTE EL CÓDIGO DEL ARTÍCULO EN LA BD *******************************/
	  // INVENTARIO -> EDITAR ARTÍCULO.
	  // Selecciono un blur al terminar la escritura del CÓDIGO DEL ARTÍCULO. 
	  $('#codigo_articulo_edit').blur(function(){
	 	 
	     //(01) Gaurdo el CÓDIGO DEL ARTÍCULO en una variable para pasar en la consulta AJAX.
		 var codigo_articulo = document.form_nuevo_articulo.codigo_art.value
	     //(02) Aquí pongo el código de la llamada ajax     
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/confirm_codigo.php?codigo_art=' + codigo_articulo,  
			 async:       true,          
			 success:     show_message_cod_edit,   
			 beforeSend:  inicio_check_cod_edit,  // Función que se llama al realizar la petición.
			 complete:    stop_check_cod_edit,    // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_cod_edit,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	  
	  function show_message_cod_edit(data)
	  {
		  data = eval(data);  
	       	  
		  if ( data.codigo_art == 'true' )  {	  
		     // Esto significa que el CÓDIGO se puede escribir en la BD. No existe.
		     //01 Mensaje de OK.
			 document.getElementById('show_message_codigo_art_edit').innerHTML = '<b style=\'color:green;\'>C\xF3digo del art\xEDculo disponible</b>';
		     //02 Igualo el valor del campo oculto hidden_codigo_art a 1
			 document.form_nuevo_articulo.hidden_codigo_art.value = 1;
			 //03 Chequeo si el campo hidden_codigo_art está en 0.
			 if ( document.form_nuevo_articulo.hidden_codigo_art.value == 0 ) {
				 // Significa que el número de cédula ya está en la base de datos y se DEBE MANTENER el submit INHABILITADO. 
				 $('#submit_edit_art').attr('disabled','disabled');
             } else {
				 $('#submit_edit_art').removeAttr('disabled');
             }  
		  } else if ( data.codigo_art == 'false') {
			 // Esto significa que el CÓDIGO DEL artículo ya existe en la BD. Puede ser: 1.MENSAJE DE ERROR ó 2.ES EL CÓDIGO ORIGINAL. 
		     
			 //04 COMPARO SI EL QUE TENGO ESCRITO ES EL ACTUAL CON EL QUE SE TRATÓ DE EDITAR PARA ENVIAR LOS MENSAJES.
			 if ( document.getElementById('codigo_articulo_edit').value == document.getElementById('comprobar_codigo_art').value )  {
			     //CASO 1: Es el mismo que tenía al principio cuando lo empecé a EDITAR. 	 
				 //04.1 Mensaje de código aceptado.
			     document.getElementById('show_message_codigo_art_edit').innerHTML = '<b style=\'color:green;\'>C\xF3digo del art\xEDculo idem.</b>';
		         //04.2 Igualo el valor del campo oculto hidden_codigo_art a 0
			     document.form_nuevo_articulo.hidden_codigo_art.value = 1;
			     //04.3 Deshabilito el botón SUBMIT.
			     $('#submit_edit_art').removeAttr('disabled');
			 } else {
			     //05.1 Mensaje de Error.
			     document.getElementById('show_message_codigo_art_edit').innerHTML = '<b style=\'color:red;\'>Ya existe este C\xF3digo en la Base de Datos</b>';
		         //05.2 Igualo el valor del campo oculto hidden_codigo_art a 0
			     document.form_nuevo_articulo.hidden_codigo_art.value = 0;
			     //05.3 Deshabilito el botón SUBMIT.
			     $('#submit_edit_art').attr('disabled','disabled');
             }  
		  } // Fin del if ( data.codigo_art == 'true' )  {
	  }  // Fin de la función show_message_cod(data)
	  
	  function inicio_check_cod_edit()
	  {
		$("#charging_aj_edit").css("display", "inline"); 
	  }
	  
	  function stop_check_cod_edit()
	  {
		$("#charging_aj_edit").css("display", "none");  
	  }
	  
	  function show_error_message_cod_edit()
	  {
	     $("#server_error_charging_aj_edit").css("display", "inline");
	  }
	    
	 /***************** FIN DE LA PETICIÓN AJAX PARA VERIFICAR SI EXISTE EL CÓDIGO DEL ARTÍCULO EN LA BD (EDITAR ARTICULO)*********************/
	 
	 /**** SEXTA PETICIÓN AJAX ****/
	 /*(7.6)*********** PETICIÓN AJAX PARA CARGAR LA DESCRIPCIÓN DEL ARTÍCULO EN EL CAMPO <text> A TRAVÉS DEL CÓDIGO EN MOV DE INV *********/
	  //(0n) SELECCIONO un CÓDIGO DE ARTÍCULO y al salir de ahí me busca por ajax la Descripción del Artículo.
	  $('#valor_codigo2').blur(function(){
	 	 
	     //(01) GUARDO EL CÓDIGO DEL ARTÍCULO ESCRITO EN UNA VARIABLE.
		 var codigo_articulo2 = document.form_nuevo_mov.codigo_articulo2.value
	     //(02) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_descrip_articulo_by_code.php?code=' + codigo_articulo2,  
			 async:       true,          
			 success:     show_referencia_art,   
			 beforeSend:  inicio_envio_cod_art,  // Función que se llama al realizar la petición(CASO STOCK).
			 complete:    stop_cargando_referencia_art, // Función que se ejecuta cuando la petición se ha completado(CASO STOCK).
		     error:       show_error_Message_stock,  // Función que se ejecuta cuando hay un error en la petición(CASO STOCK).  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	 
	  function show_referencia_art(data)
	  {
           // Función que muestra la REFERECIA DEL ARTÍCULO en el campo <text> desabilitado.	  
 	       data = eval(data);  
	       //01 Chequeo si se obtuvieron resultados positivos en la lectura del código del artículo
		   if ( data.resultado_query == "ok" )  {
			   // CASO 1: CONSULTA REALIZADA CON ÉXITO ( SE ENCONTRÓ EL ARTÍCULO ).
		       //01.1 Me muestra el valor de la referencia del artículo, de la respuesta en json de la peticion ajax a search_descrip_articulo_by_code.php
	           document.form_nuevo_mov.descripcion_articulo2.value = data.referencia_art; 
		       //01.2 Inicializa si está escrito algún mensaje si anteriormente se escribió un código erróneo.
		       document.getElementById('error_message_search_ref_art').innerHTML = "";
		   } else if ( data.resultado_query == "noitisnt" )  {
			   // CASO 2: CONSULTA NO REALIZADA CON ÉXITO ( NO SE ENCONTRÓ EL ARTÍCULO ).
		       //01.4 Me muestra el valor de la referencia del artículo, que en este caso es ''.
	           document.form_nuevo_mov.descripcion_articulo2.value = data.referencia_art; 
		       //01.5 Escribe mensaje de código código erróneo.
		       document.getElementById('error_message_search_ref_art').innerHTML = "Art&iacute;culo no encontrado en la Base de Datos. <br />Por favor introduzca los datos nuevamente.";
		   }
	  }   // Fin de la función show_referencia_art(data)
	   
	  // Funciones para esta petición AJAX 
	  function inicio_envio_cod_art()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $("#cargando_stock").css("display", "inline");  
	  }
     
	  function stop_cargando_referencia_art()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $("#cargando_stock").css("display", "none");
	  }
	  
	  function show_error_Message_stock()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     $("#server_error_stock").css("display", "inline");
	  }
	 
	 /********* FIN DE LA PETICIÓN AJAX PARA CARGAR LA DESCRIPCIÓN DEL ARTÍCULO EN EL CAMPO <text> A TRAVÉS DEL CÓDIGO EN MOV DE INV ************/
		
	 /*(7.7)*/
	 // INVENTARIO -> MOVIMIENTO.
	 // Selecciono un blur al terminar la escritura de la descripción del artículo.
	 $('#valor_descripcion').blur( function() {
	    // INICIALIZO TODO.
	    reset_all_camps_in_mov();
	 }); 
	 
	 /*(7.8)*/
	 // INVENTARIO -> MOVIMIENTO.
	 // Selecciono un blur al terminar la escritura del código del artículo.
	 $('#valor_codigo2').blur( function() {
	    // INICIALIZO TODO.
	    reset_all_camps_in_mov();
	 }); 
	
     /**** SÉPTIMA PETICIÓN AJAX ****/
	 /*(7.9)***************** PETICIÓN AJAX PARA CARGAR LA DESCRIPCIÓN DEL ARTÍCULO EN EL CAMPO <text> A TRAVÉS DEL CÓDIGO EN KARDEX******************/
	  //(0n) SELECCIONO un CÓDIGO DE ARTÍCULO y al salir de ahí me busca por ajax la Descripción del Artículo.
	  $('#valor_codigok2').blur(function(){
	 	 
	     //(01) GUARDO EL CÓDIGO DEL ARTÍCULO ESCRITO EN UNA VARIABLE.
		 var codigo_articulo2 = document.form_kardex_art.codigo_articulo2.value
	     //(02) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_descrip_articulo_by_code.php?code=' + codigo_articulo2,  
			 async:       true,          
			 success:     show_referencia_art_kardex,   
			 beforeSend:  inicio_envio_cod_art_kardex,  // Función que se llama al realizar la petición(CASO STOCK).
			 complete:    stop_cargando_referencia_art_kardex, // Función que se ejecuta cuando la petición se ha completado(CASO STOCK).
		     error:       show_error_Message_kardex,  // Función que se ejecuta cuando hay un error en la petición(CASO STOCK).  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	 
	  function show_referencia_art_kardex(data)
	  {
           // Función que muestra la REFERECIA DEL ARTÍCULO en el campo <text> desabilitado.	  
 	       data = eval(data);  
	       //01 Chequeo si se obtuvieron resultados positivos en la lectura del código del artículo
		   if ( data.resultado_query == "ok" )  {
			   // CASO 1: CONSULTA REALIZADA CON ÉXITO ( SE ENCONTRÓ EL ARTÍCULO ).
		       //01.1 Me muestra el valor de la referencia del artículo, de la respuesta en json de la peticion ajax a search_descrip_articulo_by_code.php
	           document.form_kardex_art.descripcion_articulo2.value = data.referencia_art; 
		       //01.2 Inicializa si está escrito algún mensaje si anteriormente se escribió un código erróneo.
		       document.getElementById('error_message_search_ref_art_kardex').innerHTML = "";
		   } else if ( data.resultado_query == "noitisnt" )  {
			   // CASO 2: CONSULTA NO REALIZADA CON ÉXITO ( NO SE ENCONTRÓ EL ARTÍCULO ).
		       //01.4 Me muestra el valor de la referencia del artículo, que en este caso es ''.
	           document.form_kardex_art.descripcion_articulo2.value = data.referencia_art; 
		       //01.5 Escribe mensaje de código código erróneo.
		       document.getElementById('error_message_search_ref_art_kardex').innerHTML = "Art&iacute;culo no encontrado en la Base de Datos. <br />Por favor introduzca los datos nuevamente.";
		   }
	  }   // Fin de la función show_referencia_art_kardex(data)
	   
	  // Funciones para esta petición AJAX 
	  function inicio_envio_cod_art_kardex()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $("#cargando_art_by_code").css("display", "inline");  
	  }
     
	  function stop_cargando_referencia_art_kardex()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $("#cargando_art_by_code").css("display", "none");
	  }
	  
	  function show_error_Message_kardex()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     $("#server_error_kardex").css("display", "inline");
	  }
	 
	 /************ FIN DE LA PETICIÓN AJAX PARA CARGAR LA DESCRIPCIÓN DEL ARTÍCULO EN EL CAMPO <text> A TRAVÉS DEL CÓDIGO EN KARDEX ***************/
	 	 
	 /************************************************************************************************
	                                          8.   MÓDULO USUARIOS
	 **************************************************************************************************/
	
	 //8.1 Configuramos la validación de los distintos campos del formulario para ingresar un nuevo usuario.
	 $("#form_new_user").validate({
	 
	   // Empezamos por las reglas
       rules: {
	         /*01*/ nombre_apellidos: "required",      // Para el campo Nombre y Apellidos pedimos que sea requerido.
	         /*02*/ nombre_usuario: {                  // Para el campo Nombre de Usuario
				                      required: true,     // pedimos que sea requerido.
									  minlength: 2        // Tiene que tener un tamaño mayor o igual a 2 caracteres
			                        },
	         /*03*/ contrasena:  {                     // Para el campo Contraseña.
				                     required: true,      // es requerido   
	                                 minlength: 5         // Tiene que tener un tamaño mayor o igual a 5 caracteres
			                     },
	         /*04*/ confirm_contrasena:  {                     // Para el campo Confirmar Contraseña.
				                           required: true,         // es requerido   
	                                       minlength: 5,           // Tiene que tener un tamaño mayor o igual a 5 caracteres
										   equalTo: "#contrasena"  // Tiene que ser igual que el campo contrasena ( indicamos su id)
			                             },
	   },
	   
	   // La segunda parte es configurar los mensajes, por lo que tengo que ir indicando para cada campo y cada regla el mensaje que quiero mostrar si no se cumple.
	   messages: { 
	         /*01*/ nombre_apellidos: "<span id='error01' class='error_user'>Por favor, introduzca su Nombre y Apellidos</span>",
	         /*02*/ nombre_usuario: {
				                     required:"<span id='error02' class='error_user'>Por favor, introduzca su Nombre de Usuario</span>",
 	                                 minlength:"<span id='error02' class='error_user'>El Nombre de Usuario debe tener al menos 2 caracteres</span>"
			                        },
	   
	         /*03*/ contrasena:     {
				                     required:"<span id='error03' class='error_user'>Por favor, introduzca su Contrase&ntilde;a</span>",
 	                                 minlength:"<span id='error03' class='error_user'>Su Contrase&ntilde;a debe tener al menos 5 caracteres</span>"
			                        },
	   
	         /*04*/ confirm_contrasena:     {
				                     required:"<span id='error04' class='error_user'>Por favor, confirme su Contrase&ntilde;a</span>",
 	                                 minlength:"<span id='error04' class='error_user'>Su Contrase&ntilde;a debe tener al menos 5 caracteres</span>",
			                         equalTo:"<span id='error04' class='error_user'>Las contrase&ntilde;as introducidas no son iguales</span>"
									
									
									}, 
	   }
	 });  // Fin del $("#form_new_user").validate({
	
	//08.2 Esto es para que me aparezca el <div> con el <select> para asignar un local ALMACÉN a un vendedor. 
	$('#tipo_usuario').change(function(){
	    
		var tipo_usuario = document.form_new_user.tipo_usuario.value
		
		if ( tipo_usuario == 'v' )  {
		    $('#div_almacen').show();   // Muestro el <div> con el <select> para seleccionar cual es el almacén del vendedor.
		} else {
		    $('#div_almacen').hide();   // Escondo el <div> con el <select> que selecciona cual es el almacén del vendedor.	
		}
	}); // Fin del 02
		
	/**** PRIMERA PETICIÓN AJAX ****/
	/*(08.3)************** PETICIÓN AJAX PARA CARGAR LOS DATOS DEL USUARIO SELECCIONADO PARA CAMBIARLE EL PASS ***********************/
	  //(0n) LUEGO DE SELECCIONAR EL USUARIO CARGO LOS DATOS DE ESTE A VER SI ES EL SELECCIONADO.
	  $('#search_cliente_to_change_pass').click(function(){
	  
	  	 //(01) Busco los Datos del usuario(Nombre Completo, tipo usuario, id_local, habilitado¿?) a través del id del USUARIO....y
		 var id_usuario = document.form_change_pass.id_usuario.value
	     //(02) Busco los Datos del usuario(Nombre Completo, tipo usuario, id_local, habilitado¿?) a través del USUARIO.
		 var usuario = document.form_change_pass.change_pass_usuario.value
		 
		 //(03) Aquí pongo el código de la llamada ajax     --> //alert(id_usuario); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_usuario_change_pass.php?id_usuario=' + id_usuario + '&usuario=' + usuario,  
			 async:       true,          
			 success:     show_user,   
			 beforeSend:  inicio_envio_user,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_user, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_user,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	 
	  function show_user(data)
	  {
           // Función que muestra los datos del usuario seleccionado para cambiarle la contraseña.	  
 	       data = eval(data);  
	       //01 Chequeo si no se encontró ningun usuario con el nombre de usuario escrito
		   if ( typeof data.usuario == "undefined")  {
			   
			   document.getElementById('error_user_mesage').innerHTML = '<b style=\'color:white;\'>' + data.error + '</b>';
		       // Muestro el mensaje de error en la pantalla y oculto los otros con los datos de los usuarios 
		       $("#error_user_mesage").css("display", "inline");    // error
		       $("#div_user").css("display", "none");               // data usuarios 
	           $("#change_pass_table").css("display", "none");      // campos de contraseña
		   } else {
		       //02 Guardo todos los datos seleccionados en una tabla para despues continuar.
		       document.getElementById('push_user_name').innerHTML = '<b style=\'color:black;\'>' + data.usuario + '</b>';
		       document.getElementById('push_full_name').innerHTML = '<b style=\'color:black;\'>' + data.nombre_completo + '</b>';
		       document.getElementById('push_user_type').innerHTML = '<b style=\'color:black;\'>' + data.tipo_usuario + ' ' + data.nombre_local + '</b>';
		       document.getElementById('push_state').innerHTML = '<b style=\'color:' + data.color +';\'>' + data.habilitar + '</b>';
		   
		        //(03) Muestro el <div> con los datos de la llamada AJAX y la tabla para cambiar la contraseña y escondo el ERROR.
	            $("#div_user").css("display", "inline");            // data usuarios
	            $("#change_pass_table").css("display", "inline");   // campos de contraseña
		        $("#error_user_mesage").css("display", "none");     // error
		   }
	  }   // Fin de la función show_user(data)
	 
	  function inicio_envio_user()
	  {  
	      // Función que se llama al realizar la petición.
	      $("#cargando_user").css("display", "inline");    
	  }   // Fin de la función inicio_envio_user()
	 
	  function stop_cargando_user()
	  {
		   // Función que se ejecuta cuando la petición se ha completado.
	       $("#cargando_user").css("display", "none");  
	  }
	 
	  function show_error_message_user()
	  {
		   // Función que se ejecuta cuando hay un error en la petición.
	       $("#server_error_user").css("display", "inline");  
	  }  // fin de la función show_error_message_user()
	 
	 /*********** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL USUARIO SELECCIONADO PARA CAMBIARLE EL PASS ******************/
	
	 /******* SEGUNDA PETICIÓN  *******/
	  /*(8.4)************************* PETICIÓN AJAX PARA VERIFICAR SI EXISTE EL NOMBRE DE USUARIO EN LA BD *******************************/
	  // Selecciono un blur al terminar la escritura del NOMBRE DE USUARIO. 
	  // USUARIOS -> NUEVO USUARIO.
	  $('#nombre_usuario').blur(function(){
	     
	     //(01) Guardo el NOMBRE DE USUARIO en una variable para pasar en la consulta AJAX.
		 var nombre_usuario = document.getElementById('nombre_usuario').value;
	     //(02) Aquí pongo el código de la llamada ajax     
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/user_name_confirm.php?user_name=' + nombre_usuario,  
			 async:       true,          
			 success:     show_message_user,   
			 beforeSend:  inicio_check_user,  // Función que se llama al realizar la petición.
			 complete:    stop_check_user,    // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_user,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	  
	  function show_message_user(data)
	  {
		  data = eval(data);  
	       	  
		  if ( data.usuario == 'true' )  {	  
		     // Esto significa que el NOMBRE DE USUARIO se puede escribir en la BD. No existe.
		     //01 Mensaje de OK.
			 document.getElementById('show_message_user_name').innerHTML = '<b style=\'color:green;\'> Usuario disponible </b>';
		     //02 Igualo el valor del campo oculto hidden_user_name a 1
			 document.getElementById('hidden_user_name').value = 1;
			 //03 Chequeo si el campo hidden_user_name está en 0.
			 if ( document.getElementById('hidden_user_name').value == 0 ) {
				 // Significa que el nombre de usuario ya está en la base de datos y se DEBE MANTENER el submit INHABILITADO. 
				 $('#submit_new_user').attr('disabled','disabled');
             } else {
				 $('#submit_new_user').removeAttr('disabled');
             }  
		  } else if ( data.usuario == 'false') {
			 // Esto significa que el NOMBRE DE USUARIO ya existe en la BD. MENSAJE DE ERROR. 
		     //04 Mensaje de Error.
			 document.getElementById('show_message_user_name').innerHTML = '<b style=\'color:red;\'>Ya existe este Usuario en la Base de Datos</b>';
		     //05 Igualo el valor del campo oculto hidden_user_name a 0
			 document.getElementById('hidden_user_name').value = 0;
			 //06 Deshabilito el botón SUBMIT.
			 $('#submit_new_user').attr('disabled','disabled');
          }  
	  }  // Fin de la función show_message_user(data)
	  
	  function inicio_check_user()
	  {
		$("#charging_user_name").css("display", "inline"); 
	  }
	  
	  function stop_check_user()
	  {
		$("#charging_user_name").css("display", "none");  
	  }
	  
	  function show_error_message_user()
	  {
	     $("#server_error_charging_user_name").css("display", "inline");
	  }
	    
	 /***************** FIN DE LA PETICIÓN AJAX PARA VERIFICAR SI EXISTE EL NOMBRE DE USUARIO EN LA BD (NUEVO USUARIO)*********************/
	 
	//8.5 Configuramos la validación de los campos contraseña del formulario para cambiar la contraseña.
	 $("#form_change_pass").validate({
	 
	   // Empezamos por las reglas
       rules: {
	         /*01*/ contrasena_chp:  {                     // Para el campo Contraseña.
				                     required: true,      // es requerido   
	                                 minlength: 5         // Tiene que tener un tamaño mayor o igual a 5 caracteres
			                         },
	         /*02*/ confirm_contrasena_chp:  {                     // Para el campo Confirmar Contraseña.
				                     required: true,         // es requerido   
	                                 minlength: 5,           // Tiene que tener un tamaño mayor o igual a 5 caracteres
									 equalTo: "#contrasena_chp"  // Tiene que ser igual que el campo contrasena ( indicamos su id)
			                                 },
	   },
	   // La segunda parte es configurar los mensajes, por lo que tengo que ir indicando para cada campo y cada regla el mensaje que quiero mostrar si no se cumple.
	   messages: { 
	         /*01*/ contrasena_chp: {
				                     required:"<span id='error01_chp' class='error_user'>Por favor, introduzca su Contrase&ntilde;a</span>",
 	                                 minlength:"<span id='error01_chp' class='error_user'>Su Contrase&ntilde;a debe tener al menos 5 caracteres</span>"
			                        },
	   
	         /*02*/ confirm_contrasena_chp:   {
				                     required:"<span id='error02_chp' class='error_user'>Por favor, confirme su Contrase&ntilde;a</span>",
 	                                 minlength:"<span id='error02_chp' class='error_user'>Su Contrase&ntilde;a debe tener al menos 5 caracteres</span>",
			                         equalTo:"<span id='error02_chp' class='error_user'>Las contrase&ntilde;as introducidas no son iguales</span>"
									
									          }, 
	   }
	 });  // Fin del $("#form_change_pass").validate({
		
	 /************************************************************************************************
	                                          9.   MÓDULO COMPRAS
	 **************************************************************************************************/
	/*
	 - A partir del Módulo 2.DETALLE DE LA COMPRA aparecerán todas estan funciones que mediante ajax cargarán los datos de cada uno de los artículos de cada compra. Estas funciones y llamados de jQuery estarán en el archivo  js/compras_row.js y js/charge_articles.js
	 I)   compras_row(): jQuery para añadir filas y seleccionar artículos en el módulo 2. DETALLE DE COMPRA -> compras_row.js
	 II)  charge_articleN(): Funciones que cargan mediante ajax los datos da cada artículo en el módulo 2. DETALLE DE COMPRA -> charge_articles.js 
	 III) keyup_cantidad(): Función que contiene todos los jQuery con la instrucciones a la hora poner la cantidad de artículos de la compra(31 instrucciones) y se suma en el valor totol -> charge_articles.js
	 IV)  delete_filas(): Función que contiene todos los jQuery con la instrucciones a la hora de borrar una fila de la nueva compra (30 instrucciones) -> js/charge_article.js. 
	 V)   show_valor_total(): Función que suma los saldos totales de los artículos de esta compra y los suma al SALDO TOTAL -> js/charge_article.js. 
	*/
	
	//9.00) muestro solamente en el <select> de artículos los articulos que pertenecen a ese proveedor en 2. DETALLE DE COMPRA.
	$('#button_show_detalle_compra').click(function(){
	  
	   // Selecciono es id del proveedor que serán los valores de la clase en los <option> del select de 2. DETALLE DE COMPRA. 
	   var class_id_proveedor = document.getElementById('id_proveedor_compra').value;
	   $('.' + class_id_proveedor).css("display","block");
	});
	//9.01) con los 31 clicks posibles cuando voy a insertar una nueva fila de artículos en al COMPRA.
	compras_row();          // Función que está en el archivo js/compras_row.js
	//9.02)
	charge_article1();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 1
	charge_article2();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 2
    charge_article3();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 3
	charge_article4();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 4
	charge_article5();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 5
	charge_article6();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 6
	charge_article7();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 7
	charge_article8();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 8
	charge_article9();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 9
	charge_article10();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 10
	charge_article11();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 11
	charge_article12();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 12
	charge_article13();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 13
	charge_article14();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 14
	charge_article15();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 15
	charge_article16();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 16
	charge_article17();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 17
	charge_article18();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 18
	charge_article19();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 19
	charge_article20();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 20
	charge_article21();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 21
	charge_article22();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 22
	charge_article23();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 23
	charge_article24();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 24
	charge_article25();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 25
	charge_article26();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 26
	charge_article27();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 27
	charge_article28();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 28
	charge_article29();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 29
	charge_article30();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 30 
	charge_article31();       // Función que está en el archivo ajax/charge_article.js para cargar el artículo 31 
	
	// Función que contiene todos los jQuery con la instrucciones a la hora poner la cantidad de artículos de la compra(31 instrucciones) y está en el archivo ajax/charge_article.js. 
	// 9.03)
	keyup_cantidad();
		
	// Función que contiene todos los jQuery con la instrucciones a la hora de borrar una fila de la nueva compra (30 instrucciones) y está en le archivo ajax/charge_article.js. 
	// 9.04)	
	delete_filas();
		
	// Función que suma los saldos totales de los artículos de esta compra y los suma al SALDO TOTAL y está en el archivo ajax/charge_article.js. 
	// 9.05)
	//show_valor_total_sumatoria_articulos();  //*** AQUÍ NO TENGO QUE DEFINIRLA ***
	
	// 9.06) // Mediante esto escondo el <div> de añadir detalle y muestro el <div> del detalle de pago. 
	$('#anadir_pago_button').click(function(){
		
		  /**** Pongo los datos del VALOR TOTAL -> DETALLE DE COMPRA EN VALOR TOTAL-> DETALLE DE PAGO y SALDO -> DETALLE DE PAGO****/
		  Resultado = $('#total_compras_valor').text(); //Pongo el resultado en VALOR TOTAL(html)
		  Resultado = parseFloat(Resultado);
		  		  
		  // De esta forma permito que SIEMPRE sea diferente de 0 el valor de la compra.
		  if ( Resultado == 0 )  {
			  alert('Por favor introduzca valores de art\xEDculos en la compra.GRACIAS' + '\n' + 'El VALOR TOTAL es 0' );
			  return(false);  
		  }
		
		  $('#anadir_detalle_pago').hide();  // Escondo el <div> contenedor de este botón.
	      $('#detalle_pago').show();         // Muestro el <div> del detalle de pago.
	      
		  document.getElementById('monto_total_a_pagar').value = Resultado.toFixed(2); // TOTAL A PAGAR
		  document.getElementById('saldo_dinero').value = Resultado.toFixed(2); // SALDO
		  
		  /**** Escondo todos los <div> del interior del 'DETALLE DE PAGO' e inicializo variables ****/
	      reset_forma_de_pago_down();
		  document.getElementById('descuento_general').value = 0;
			
	});
	
	/*********************** DETALLE DE PAGO ( ESTA SECCIÓN ES LA QUE VA MOSTRANDO LOS <div> A MEDIDA QUE VOY DANDO CLICK ) ***/
	/****_________________________________________________________________________________________________****/
	// 9.07.1) // Mediante esto voy cambiando los valores del 'SALDO DEL CRÉDITO' y del 'PAGO AL CONTADO' SI CAMBIA EL DESCUENTO. 
	$('#descuento_general').keyup(function(){ 
				 
		var valor_total             = document.getElementById('monto_total_a_pagar').value;       // Valor total de la compra.
		var descuento_general       = document.getElementById('descuento_general').value;         // Valor del DESCUENTO GENERAL DE LA COMPRA.		
			
		//01 Escondo e inicializo todos los detalles del pago si ya los llené.
		reset_forma_de_pago_down();
						    
		if ( descuento_general == '' || descuento_general == null || isNaN(descuento_general) || valor_total == '' || valor_total == null || isNaN(valor_total) || valor_total == 0 )  {
		   //02 Verifico que el 'valor total de la compra' y el 'descuento general' tienen un valor numeral.
		   $('#monto_total_a_pagar').css('background-color','#F9BEBD');       // VALOR TOTAL DE LA COMPRA.
		   $('#descuento_general').css('background-color','#F9BEBD');         // DESCUENTO GENERAL.
		} else {
			//02 LLevo a cabo la resta para saber el valor real de la COMPRA. 
			valor_total = parseFloat(valor_total);
			descuento_general = parseFloat(descuento_general);
						
			//02.1 Este es el VALOR REAL DE LA COMPRA CAMPO HIDDEN.
			valor_real_de_la_compra = valor_total - descuento_general;
						
			//03 Verifico que valor_real_de_la_compra > 0
			if ( valor_real_de_la_compra < 0 )  {
			    alert('Alerta!! No va a pagar la compra. Por favor chequee los datos.GRACIAS');
				$('#monto_total_a_pagar').css('background-color','#F9BEBD');       // VALOR TOTAL DE LA COMPRA.
			    $('#descuento_general').css('background-color','#F9BEBD');         // DESCUENTO GENERAL.
			    return(false);		
			} else {
			    $('#monto_total_a_pagar').css('background-color','#FFF');       // VALOR TOTAL DE LA COMPRA.
			    $('#descuento_general').css('background-color','#FFF');         // DESCUENTO GENERAL.
			}
		}
	});   	
	
	/****_________________________________________________________________________________________________****/
	// 9.07.2) // Mediante esto selecciono el radiobotón para hacer el pago al CONTADO. 
	$('#forma_pago_contado').click(function(){
		
		//01 Escondo e inicializo todos los detalles del pago si ya los llené.
		reset_forma_de_pago_down();
		
		//02 LLevo a cabo la resta para saber el valor real de la COMPRA. 
		var valor_total             = document.getElementById('monto_total_a_pagar').value;       // Valor total de la compra.
		var descuento_general       = document.getElementById('descuento_general').value;         // Valor del DESCUENTO GENERAL DE LA COMPRA.
		
		valor_total = parseFloat(valor_total);
		descuento_general = parseFloat(descuento_general);
						
		//02.1 Este es el VALOR REAL DE LA COMPRA CAMPO HIDDEN.
		valor_real_de_la_compra = valor_total - descuento_general;
					
		//03 GUARDO EL VALOR REAL DE LA COMPRA EN EL CAMPO <hidden> y en el campo <text> disabled.
		document.getElementById('valor_real_de_la_compra').value = valor_real_de_la_compra.toFixed(2);
		document.getElementById('input_valor_real_del_pago').value = valor_real_de_la_compra.toFixed(2);
			
		//04 zona de <div> que muestro.
		document.getElementById('forma_pago_contado').checked = 1;    // MUESTRO EL checked DEL RADIOBOTÓN DE LA FORMA DE PAGO. 
		$('#div_valor_real_de_la_compra').show();                     // MUESTRO EL VALOR REAL DE LA COMPRA.
		$('#div_origen_pago').show();                                 // MUESTRO EL ORIGEN DEL PAGO porque es al CONTADO.
	});
	
	// 9.07.3) // Mediante esto selecciono el radiobotón para hacer el pago a CRÉDITO. 
	$('#forma_pago_credito').click(function(){
		
		//01 Escondo e inicializo todos los detalles del pago si ya los llené.
		reset_forma_de_pago_down();
				
		//02 LLevo a cabo la resta para saber el valor real de la COMPRA. 
		var valor_total             = document.getElementById('monto_total_a_pagar').value;       // Valor total de la compra.
		var descuento_general       = document.getElementById('descuento_general').value;         // Valor del DESCUENTO GENERAL DE LA COMPRA.
		
		valor_total = parseFloat(valor_total);
		descuento_general = parseFloat(descuento_general);
						
		//02.1 Este es el VALOR REAL DE LA COMPRA CAMPO HIDDEN.
		valor_real_de_la_compra = valor_total - descuento_general;
					
		//03 GUARDO EL VALOR REAL DE LA COMPRA EN EL CAMPO <hidden> y en el campo <text> disabled.
		document.getElementById('valor_real_de_la_compra').value = valor_real_de_la_compra.toFixed(2);
		document.getElementById('input_valor_real_del_pago').value = valor_real_de_la_compra.toFixed(2);
		
		//04 PONGO EL 'ANTICIPO DEL CRÉDITO' EN 0 Y EL 'SALDO DEL CRÉDITO' CON EL VALOR REAL DE LA COMPRA.
		document.getElementById('input_entrada_forma_pago').value = 0; 
		document.getElementById('saldo_dinero').value = valor_real_de_la_compra.toFixed(2);
		
		/* zona de <div> que muestro */
		document.getElementById('forma_pago_credito').checked = 1;    // MUESTRO EL checked DEL RADIOBOTÓN DE LA FORMA DE PAGO.
		$('#div_valor_real_de_la_compra').show();         // MUESTRO EL VALOR REAL DE LA COMPRA.
		$('#div_entrada_origen_pago').show();             // Muestro la entrada de dinero porque es a CRÉDITO.
	    $('#div_saldo_origen_pago').show();               // Muestro el saldo del dinero para pagar el CRÉDITO.
		$('#div_cant_pagos_origen_pago').show();          // Muestro la cantidad de pagos que voy a hacer para pagar el CRÉDITO.
	});
	
	/******__________________________________________________________________________________________________******/
	// 9.08.1) // Mediante esto muestro los radiobotones para seleccionar la forma de pago: BANCO, CAJA Ó BANCO Y CAJA. 
	$('#input_entrada_forma_pago').blur(function(){
		
		var entrada_dinero = document.getElementById('input_entrada_forma_pago').value;
		//01 Chequeo si el valor introducido no es null, ni 0, ni algo que no sea un número.		
	    if ( entrada_dinero == null || entrada_dinero == "" || isNaN(entrada_dinero) )  {
		    alert('Por favor seleccione un valor num\xE9rico para el Monto del Anticipo.GRACIAS');
			document.form_nueva_compra.entrada_dinero.focus();
			return(false);	
		} else if ( entrada_dinero == 0 ) {
			$('#div_origen_pago').hide();   // Muestro el <div> con el origen de pago: BANCO, CAJA Ó BANCO Y CAJA..
		    $('#div_detalle_origen_pago_1').hide();   // Escondo el <div> con la descripción del origen del pago para BANCO o CAJA.
		    $('#div_detalle_origen_pago_2').hide();   // Escondo el <div> con la descripción del origen del pago para BANCO y CAJA.
		} else {
			$('#div_origen_pago').show();   // Muestro el <div> con el origen de pago: BANCO, CAJA Ó BANCO Y CAJA..
		}
	});
			
	/******__________________________________________________________________________________________________******/
	// 9.08.2) // Mediante esto selecciono el radiobotón para seleccionar la forma de pago: BANCO, CAJA Ó BANCO Y CAJA. 
	$('#forma_de_pago_banco').click(function(){
		
		show_button_guardar(); // Muestra o no el botón Guardar....
		
		$('#div_detalle_origen_pago_2').hide();   // Escondo la descripción del pago para el origen pago de los dos 
	    $('#div_detalle_origen_pago_1').show();   // Muestro el <div> con la descripción del origen del pago para BANCO.
	});
	
	// 9.08.2) // Mediante esto selecciono el radiobotón para seleccionar la forma de pago: BANCO, CAJA Ó BANCO Y CAJA. 
	$('#forma_de_pago_caja').click(function(){
		
		show_button_guardar(); // Muestra o no el botón Guardar....
		
		$('#div_detalle_origen_pago_2').hide();   // Escondo la descripción del pago para el origen pago de los dos
	    $('#div_detalle_origen_pago_1').show();   // Muestro el <div> con la descripción del origen del pago para CAJA.
	});
	
	// 9.08.3) // Mediante esto selecciono el radiobotón para seleccionar la forma de pago: BANCO, CAJA Ó BANCO Y CAJA. 
	$('#forma_de_pago_banco_y_caja').click(function(){
		
		show_button_guardar(); // Muestra o no el botón Guardar....
		
		$('#div_detalle_origen_pago_1').hide();   // Escondo la descripción del pago para el origen pago de CAJA ó BANCO.
	    $('#div_detalle_origen_pago_2').show();   // Muestro el <div> con la descripción del origen del pago para CAJA Y BANCO.
	});
		
	function show_button_guardar()
	{
		if ( document.getElementById('forma_pago_contado').checked == 1 )  {
			 // Escondo el <div> con el botón de GUARDAR DATOS DE LA COMPRA 
			$('#guardar_nueva_compra').show();  
		} else if ( document.getElementById('forma_pago_credito').checked == 1 ) {
			$('#guardar_nueva_compra').hide();
		}
	} 
		
	/******__________________________________________________________________________________________________******/
	// 9.09.1) // Mediante esto selecciono la cantidad de pagos de voy a hacer y muestros sus respectivos campos.
	$('#cantidad_de_pagos_credito').change(function(){
			  
	  //01 Chequeo si está seleccionada alguna de las 3 opciones del Origen del Pago:
	  var origenpago1 = document.getElementById('forma_de_pago_banco').checked;
	  var origenpago2 = document.getElementById('forma_de_pago_caja').checked;
	  var origenpago3 = document.getElementById('forma_de_pago_banco_y_caja').checked;
	  var entrada_value = document.getElementById('input_entrada_forma_pago').value;
	  
	  if ( entrada_value == 0 || origenpago1 == 1 || origenpago2 == 1 || origenpago3 == 1 )  {
		  //02 
		  $('#guardar_nueva_compra').show();  // Muestro el <div> con el botón de GUARDAR DATOS DE LA COMPRA  
		  //03 SELECCIONO LOS CAMPOS PARA PONER LA CANTIDAD.
	      cantidad = document.getElementById('cantidad_de_pagos_credito').value;
	  
	      switch(cantidad)
	      {
		     case "0":  
		       $('#div_descripcion_cantidad_pago').hide();
			   $('#guardar_nueva_compra').hide();
		     break; 
		     case "1":  
		       $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').hide();
		       $('#fila_pago3').hide();
		       $('#fila_pago4').hide();
		       $('#fila_pago5').hide();
			   $('#fila_pago6').hide();
			   $('#fila_pago7').hide();
			   $('#fila_pago8').hide();
			   $('#fila_pago9').hide();
			   $('#fila_pago10').hide();
		     break; 
		     case "2":  
		       $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').show();
		       $('#fila_pago3').hide();
		       $('#fila_pago4').hide();
		       $('#fila_pago5').hide();
			   $('#fila_pago6').hide();
			   $('#fila_pago7').hide();
			   $('#fila_pago8').hide();
			   $('#fila_pago9').hide();
			   $('#fila_pago10').hide();
		     break; 
		     case "3":  
		       $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').show();
		       $('#fila_pago3').show();
		       $('#fila_pago4').hide();
		       $('#fila_pago5').hide();
			   $('#fila_pago6').hide();
			   $('#fila_pago7').hide();
			   $('#fila_pago8').hide();
			   $('#fila_pago9').hide();
			   $('#fila_pago10').hide();
		     break; 
		     case "4":  
		       $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').show();
		       $('#fila_pago3').show();
		       $('#fila_pago4').show();
		       $('#fila_pago5').hide();
			   $('#fila_pago6').hide();
			   $('#fila_pago7').hide();
			   $('#fila_pago8').hide();
			   $('#fila_pago9').hide();
			   $('#fila_pago10').hide();
		     break; 
		     case "5":  
               $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').show();
		       $('#fila_pago3').show();
		       $('#fila_pago4').show();
		       $('#fila_pago5').show();
			   $('#fila_pago6').hide();
			   $('#fila_pago7').hide();
			   $('#fila_pago8').hide();
			   $('#fila_pago9').hide();
			   $('#fila_pago10').hide();
 		     break; 
			 case "6":  
               $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').show();
		       $('#fila_pago3').show();
		       $('#fila_pago4').show();
		       $('#fila_pago5').show();
			   $('#fila_pago6').show();
			   $('#fila_pago7').hide();
			   $('#fila_pago8').hide();
			   $('#fila_pago9').hide();
			   $('#fila_pago10').hide();
 		     break; 
			 case "7":  
               $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').show();
		       $('#fila_pago3').show();
		       $('#fila_pago4').show();
		       $('#fila_pago5').show();
			   $('#fila_pago6').show();
			   $('#fila_pago7').show();
			   $('#fila_pago8').hide();
			   $('#fila_pago9').hide();
			   $('#fila_pago10').hide();
 		     break; 
			 case "8":  
               $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').show();
		       $('#fila_pago3').show();
		       $('#fila_pago4').show();
		       $('#fila_pago5').show();
			   $('#fila_pago6').show();
			   $('#fila_pago7').show();
			   $('#fila_pago8').show();
			   $('#fila_pago9').hide();
			   $('#fila_pago10').hide();
 		     break; 
			 case "9":  
               $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').show();
		       $('#fila_pago3').show();
		       $('#fila_pago4').show();
		       $('#fila_pago5').show();
			   $('#fila_pago6').show();
			   $('#fila_pago7').show();
			   $('#fila_pago8').show();
			   $('#fila_pago9').show();
			   $('#fila_pago10').hide();
 		     break; 
			 case "10":  
               $('#div_descripcion_cantidad_pago').show();
		       $('#fila_pago1').show();
		       $('#fila_pago2').show();
		       $('#fila_pago3').show();
		       $('#fila_pago4').show();
		       $('#fila_pago5').show();
			   $('#fila_pago6').show();
			   $('#fila_pago7').show();
			   $('#fila_pago8').show();
			   $('#fila_pago9').show();
			   $('#fila_pago10').show();
 		     break; 
		  }
	  } else {
		 alert ('Por favor seleccione un Origen del Pago.GRACIAS'); 
		 document.getElementById('cantidad_de_pagos_credito').value = "0";
		 return(false); 
	  }
	});
	
	/******__________________________________________________________________________________________________******/
	// 9.10) // Mediante esto voy cambiando el valor del dinero del ANTICIPO para el crédito.
    $('input#input_entrada_forma_pago').keyup(function(){ 
				 
		var valor_real_pago = document.getElementById("valor_real_de_la_compra").value;   // Valor real de la compra.		
		var valor_entrada   = document.getElementById("input_entrada_forma_pago").value;  // Valor de la ENTRADA de dinero.  
		var saldo_dinero    = document.getElementById("saldo_dinero").value;              // Valor del SALDO del dinero para el crédito.
				    
		if ( valor_real_pago == "" || valor_real_pago == null || isNaN(valor_real_pago) || valor_real_pago == 0 || valor_entrada == "" || valor_entrada == null || isNaN(valor_entrada) || saldo_dinero == "" || saldo_dinero == null || isNaN(saldo_dinero) || saldo_dinero == 0 )  {
		   // Verifico que el anticipo tiene un valor numeral.
			$("#input_entrada_forma_pago").css("background-color","#F9BEBD");
									
		} else {
			valor_real_pago = parseFloat(valor_real_pago);
			valor_entrada   = parseFloat(valor_entrada);
			saldo_dinero    = parseFloat(saldo_dinero);
				   
			saldo_dinero = valor_real_pago - valor_entrada; 
			
			// Verifico que saldo_dinero > 0
			if ( saldo_dinero < 0 )  {
			    
				alert('Va a pagar un Anticipo para el Crédito mayor que el valor de la Compra. Por favor chequee los datos.GRACIAS');
				document.getElementById("saldo_dinero").value = saldo_dinero.toFixed(2);
				$("#input_entrada_forma_pago").css("background-color","#F9BEBD");
			    $("#saldo_dinero").css("background-color","#F9BEBD");
				return(false);		
			} else {
			    
				document.getElementById("saldo_dinero").value = saldo_dinero.toFixed(2);
			    $("#input_entrada_forma_pago").css("background-color","#FFF");
			    $("#saldo_dinero").css("background-color","#FFF");
			}
		}
	});   
		
	/******__________________________________________________________________________________________________******/
	// 9.11) // Mediante esto voy cambiando el valor del SALDO DEL CRÉDITO para el crédito.
    $('input#saldo_dinero').keyup(function(){ 
				 
		var valor_real_pago = document.getElementById("valor_real_de_la_compra").value;   // Valor real de la compra.		
		var valor_entrada   = document.getElementById("input_entrada_forma_pago").value;  // Valor de la ENTRADA de dinero.  
		var saldo_dinero    = document.getElementById("saldo_dinero").value;              // Valor del SALDO del dinero para el crédito.
				    
		if ( valor_real_pago == "" || valor_real_pago == null || isNaN(valor_real_pago) || valor_real_pago == 0 || valor_entrada == "" || valor_entrada == null || isNaN(valor_entrada) || saldo_dinero == "" || saldo_dinero == null || isNaN(saldo_dinero) || saldo_dinero == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			$("#input_entrada_forma_pago").css("background-color","#F9BEBD");
			$("#saldo_dinero").css("background-color","#F9BEBD");
		} else {
			valor_real_pago   = parseFloat(valor_real_pago);
			valor_entrada = parseFloat(valor_entrada);
			saldo_dinero  = parseFloat(saldo_dinero);
				   
			valor_entrada = valor_real_pago - saldo_dinero; 
			
			// Verifico que valor_entrada > 0
			if ( valor_entrada < 0 )  {
			    
				alert('Va a pagar un Cr\xE9dito mayor que el valor de la compra. Por favor chequee los datos.GRACIAS');
				document.getElementById("input_entrada_forma_pago").value = valor_entrada.toFixed(2);
				$("#input_entrada_forma_pago").css("background-color","#F9BEBD");
			    $("#saldo_dinero").css("background-color","#F9BEBD");
				return(false);		
			} else {
			    document.getElementById("input_entrada_forma_pago").value = valor_entrada.toFixed(2);
			    $("#input_entrada_forma_pago").css("background-color","#FFF");
			    $("#saldo_dinero").css("background-color","#FFF");
			}
		}
	}); 
	
	/******__________________________________________________________________________________________________******/
	// 9.12) // Mediante esto muestro los radiobotones del origen del pago si el ANTICIPO > 0.
    $('input#saldo_dinero').blur(function(){ 
	
	  var valor_entrada   = document.getElementById("input_entrada_forma_pago").value;  // Valor de la ENTRADA de dinero.  
	  valor_entrada = parseFloat(valor_entrada);
	  
	  //01 VERIFICO QUE EL EL VALOR DEL ANTICIPO SEA MAYOR QUE 0 PARA MOSTRAR LOS RADIOBOTONES.
	  if ( valor_entrada > 0 )  {
		 $('#div_origen_pago').show();
	  } else {
		  $('#div_origen_pago').hide(); 
	  }
	});
	
	/******__________________________________________________________________________________________________******/
	// 9.13) //  Mediante esto chequeo si el número del monto de la venta(sup. der) es un numero....
    $('input#monto_total_a_pagar').keyup(function(){ 
				 
	  var valor_total  = document.getElementById("monto_total_a_pagar").value;       // Valor total de la venta.
	  
	  //01 Reinicio y oculto todo en la sección 3: DETALLE DE PAGO E INICIALIZO EL CAMPO DESCUENTO TOTAL DE LA EVNTA.
	  reset_forma_de_pago_down();
	  document.getElementById('descuento_general').value = 0;
	
	  //02 VERIFICO QUE SEA UN NÚMERO LO QUE ESTOY PONIENDO.
	  if ( valor_total == "" || valor_total == null || isNaN(valor_total) || valor_total == 0 )  {
		  // Verifico que la cantidad tiene un valor numeral.
			$("#monto_total_a_pagar").css("background-color","#F9BEBD");
		} else {
			$("#monto_total_a_pagar").css("background-color","#FFFFFF");
		}
	});
	
	/******__________________________________________________________________________________________________******/
	// 9.13) // Mediante esto:
	//a)  pongo en cero todos los campos debajo de la Forma de Pago.
	//b)  escondo todos los <divs> debajo de la forma de pago.
	function reset_forma_de_pago_down()
	{
	    /* zona de esconder todos los <div> */
		$('#div_valor_real_de_la_compra').hide(); // Escondo el <div> con el <text> del valor real de la compra..
		$('#div_entrada_origen_pago').hide();     // Escondo el <div> con el valor del anticipo de la compra.
		$('#div_origen_pago').hide();             // Escondo el <div> con los radio botones del origen del pago.
	    $('#div_detalle_origen_pago_1').hide();   // Escondo el <div> con la descripción del origen del pago para BANCO ó CAJA.
		$('#div_detalle_origen_pago_2').hide();   // Escondo el <div> con la descripción del origen del pago para BANCO y CAJA.
		
		$('#div_saldo_origen_pago').hide();       // Escondo el saldo del dinero para pagar el CRÉDITO.
		$('#div_cant_pagos_origen_pago').hide();  // Escondo la cantidad de pagos que voy a hacer para pagar el CRÉDITO.
		$('#div_descripcion_cantidad_pago').hide();  // Escondo la tabla con los detalles de la cantidad de pagos que voy a hacer para pagar el CRÉDITO.
		$('#guardar_nueva_compra').hide();        // Escondo el <div> con el botón de GUARDAR DATOS DE LA COMPRA  
	
	    /* zona de inicialización de variables a 0 */
	    document.getElementById('valor_real_de_la_compra').value = "";
		document.getElementById('input_valor_real_del_pago').value = "";
				
		document.getElementById('forma_pago_contado').checked = 0;
		document.getElementById('forma_pago_credito').checked = 0;
		
		document.getElementById('input_entrada_forma_pago').value = 0;
		document.getElementById('saldo_dinero').value = "";
	    
		document.getElementById('forma_de_pago_banco').checked = 0;
		document.getElementById('forma_de_pago_caja').checked = 0;
	    document.getElementById('forma_de_pago_banco_y_caja').checked = 0;
	    
		document.getElementById('descripcion_origen_pago').value = "";
		document.getElementById('monto_pago_caja').value = "";
		document.getElementById('descripcion_pago_caja').value = "";
		document.getElementById('monto_pago_banco').value = "";
		document.getElementById('descripcion_pago_banco').value = "";
			
		document.getElementById('cantidad_de_pagos_credito').value = "0";  // <select> con la cantidad de pagos. 
	    /*1*/  
	    document.getElementById('monto_total_pago1').value = "";    // input.text con el monto del pago a crédito 1.
	    document.getElementById('fecha_pago1').value = "";          // input.text con la fecha del pago a crédito 1.
	    document.getElementById('descripcion_pago1').value = "";    // input.text con la descripción del pago a crédito 1.
	     /*2*/  
	    document.getElementById('monto_total_pago2').value = "";    // input.text con el monto del pago a crédito 2.
	    document.getElementById('fecha_pago2').value = "";          // input.text con la fecha del pago a crédito 2.
	    document.getElementById('descripcion_pago2').value = "";    // input.text con la descripción del pago a crédito 2.
	    /*3*/  
	    document.getElementById('monto_total_pago3').value = "";    // input.text con el monto del pago a crédito 3.
	    document.getElementById('fecha_pago3').value = "";          // input.text con la fecha del pago a crédito 3.
	    document.getElementById('descripcion_pago3').value = "";    // input.text con la descripción del pago a crédito 3.
	     /*4*/  
	    document.getElementById('monto_total_pago4').value = "";    // input.text con el monto del pago a crédito 4.
	    document.getElementById('fecha_pago4').value = "";          // input.text con la fecha del pago a crédito 4.
	    document.getElementById('descripcion_pago4').value = "";    // input.text con la descripción del pago a crédito 4.
	     /*5*/  
	    document.getElementById('monto_total_pago5').value = "";    // input.text con el monto del pago a crédito 5.
	    document.getElementById('fecha_pago5').value = "";          // input.text con la fecha del pago a crédito 5.
	    document.getElementById('descripcion_pago5').value = "";    // input.text con la descripción del pago a crédito 5. 
	     /*6*/  
	    document.getElementById('monto_total_pago6').value = "";    // input.text con el monto del pago a crédito 6.
	    document.getElementById('fecha_pago6').value = "";          // input.text con la fecha del pago a crédito 6.
	    document.getElementById('descripcion_pago6').value = "";    // input.text con la descripción del pago a crédito 6. 
	     /*7*/  
	    document.getElementById('monto_total_pago7').value = "";    // input.text con el monto del pago a crédito 7.
	    document.getElementById('fecha_pago7').value = "";          // input.text con la fecha del pago a crédito 7.
	    document.getElementById('descripcion_pago7').value = "";    // input.text con la descripción del pago a crédito 7. 
	     /*8*/  
	    document.getElementById('monto_total_pago8').value = "";    // input.text con el monto del pago a crédito 8.
	    document.getElementById('fecha_pago8').value = "";          // input.text con la fecha del pago a crédito 8.
	    document.getElementById('descripcion_pago8').value = "";    // input.text con la descripción del pago a crédito 8.
	     /*9*/  
	    document.getElementById('monto_total_pago9').value = "";    // input.text con el monto del pago a crédito 9.
	    document.getElementById('fecha_pago9').value = "";          // input.text con la fecha del pago a crédito 9.
	    document.getElementById('descripcion_pago9').value = "";    // input.text con la descripción del pago a crédito 9.
		 /*10*/  
	    document.getElementById('monto_total_pago10').value = "";    // input.text con el monto del pago a crédito 10.
	    document.getElementById('fecha_pago10').value = "";          // input.text con la fecha del pago a crédito 10.
	    document.getElementById('descripcion_pago10').value = "";    // input.text con la descripción del pago a crédito 10.
	
	} // Fin de la función reset_forma_de_pago_down() 
		
	/************************************************************************************************
	                                          10.   MÓDULO CAJA
	 **************************************************************************************************/
		
	/**** PRIMERA PETICIÓN AJAX ****/
	 /*(10.1)************************* PETICIÓN AJAX PARA CARGAR EL SALDO DE LA CAJA EN EL ORIGEN ******************/
	  //(0n) SELECCIONO una CAJA en el LOCAL ORIGEN y al salir de ahí busca por ajax el saldo de dinero que hay en esa Caja.
	  $('#origen_transaccion').change(function(){
	 
	     //(01) Busco el Nombre de la tabla donde voy a buscar el SALDO DE LA CAJA a través del id del LOCAL.
		 var id_local = document.form_transaccion_caja.origen_transaccion.value
	     
		  //() Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_saldo_caja_origen.php?id_local=' + id_local,  
			 async:       true,          
			 success:     show_saldo_origen,   
			 beforeSend:  inicio_envio_saldo,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_saldo, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_saldo,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	 
	  function show_saldo_origen(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra el valor del saldo actual, de la respuesta en json de la peticion ajax a search_saldo_caja_origen.php
	       document.form_transaccion_caja.saldo_en_caja.value = data.saldo; 
		   document.form_transaccion_caja.saldo_en_caja_hidden.value = data.saldo; 
	  }   // Fin de la función stock_saldo_origen(data)
	 
	
	  // Funciones para esta petición AJAX 
	  function inicio_envio_saldo()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $("#cargando_saldo").css("display", "inline");  
	  }
     
	  function stop_cargando_saldo()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $("#cargando_saldo").css("display", "none");
	  }
	  
	  function show_error_message_saldo()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     $("#server_error_saldo").css("display", "inline");
	  }
	
	 /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR EL SALDO ACTUAL DE LA CAJA EN EL ORIGEN *********************/
		
	           /************************************************************************************************
	                                                 11.   MÓDULO VENTAS
	            **************************************************************************************************/
	/******__________________________________________________________________________________________________******/
	// 11.01) // Mediante esto voy poniendo los <text> para seleccionar el cliente de acuerdo al radio <> nombre.
	$('#c1').click( function(){
	  
	  reset_all_the_ventas_camps();         // Esta función me pone todo a "" a la vez que cambio a otro radiobotón.
	  
	  $('#cliente_x_nombre').css("display","inline");          // Muestro el <div> de la búsqueda por NOMBRE. 
	  $('#div_search_cliente_by_name').css("display","inline");    // Muestro el <div> del botón de la búsqueda por NOMBRE. 
	  $('#cliente_x_num_cedula').css("display","none");        // Escondo el <div> de la búsqueda por # DE CÉDULA.
	  $('#cliente_x_ruc').css("display","none");               // Escondo el <div> de la búsqueda por RUC.
	  $('#cliente_x_nuevo').css("display","none");             // Escondo el <div> de CREAR UN NUEVO CLIENTE.
      
	  $('#div_data_clientes').css("display","none");            // Escondo el <div> con los DATOS DEL CLIENTE.
	  $("#error_cliente_message").css("display", "none");       //  Mensaje de Error de algun cliente que no se haya encontrado.
	  $("#anadir_articulos").css("display", "none");            //  botón añadir artículos
	});
	
	/******__________________________________________________________________________________________________******/
	// 11.02) // Mediante esto voy poniendo los <text> para seleccionar el cliente de acuerdo al radio <> # de cédula.
	$('#c2').click( function(){
	   
	   reset_all_the_ventas_camps();         // Esta función me pone todo a "" a la vez que cambio a otro radiobotón.
	   
	   $('#cliente_x_nombre').css("display","none");          // Escondo el <div> de la búsqueda por nombre. 
	   $('#div_search_cliente_by_name').css("display","none");    // Escondo el <div> del botón de la búsqueda por nombre. 
	   $('#cliente_x_num_cedula').css("display","inline");    // Muestro el <div> de la búsqueda por #de cédula. 
	   $('#cliente_x_ruc').css("display","none");             // Escondo el <div> de la búsqueda por RUC.
	   $('#cliente_x_nuevo').css("display","none");           // Escondo el <div> de CREAR UN NUEVO CLIENTE.
		
	   $('#div_data_clientes').css("display","none");         // Escondo el <div> con los DATOS DEL CLIENTE.
	   $("#error_cliente_message").css("display", "none");       //  Mensaje de Error de algun cliente que no se haya encontrado.	
       $("#anadir_articulos").css("display", "none");         //  botón añadir artículos
	});
	
	/******__________________________________________________________________________________________________******/
	// 11.03) // Mediante esto voy poniendo los <text> para seleccionar el cliente de acuerdo al radio <> RUC.
	$('#c3').click( function(){
	   
	   reset_all_the_ventas_camps();         // Esta función me pone todo a "" a la vez que cambio a otro radiobotón.
	   
	   $('#cliente_x_nombre').css("display","none");          // Escondo el <div> de la búsqueda por nombre. 
	   $('#div_search_cliente_by_name').css("display","none");    // Escondo el <div> del botón de la búsqueda por nombre. 
	   $('#cliente_x_num_cedula').css("display","none");      // Escondo el <div> de la búsqueda por #de cédula. 
	   $('#cliente_x_ruc').css("display","inline");           // Muestro el <div> de la búsqueda por RUC.
	   $('#cliente_x_nuevo').css("display","none");           // Escondo el <div> de CREAR UN NUEVO CLIENTE.
		
       $('#div_data_clientes').css("display","none");         // Escondo el <div> con los DATOS DEL CLIENTE.
	   $("#error_cliente_message").css("display", "none");       //  Mensaje de Error de algun cliente que no se haya encontrado.
	   $("#anadir_articulos").css("display", "none");         //  botón añadir artículos
	});
		 
    /******__________________________________________________________________________________________________******/
	// 11.04) // Mediante esto voy poniendo los <text> para seleccionar el cliente de acuerdo al radio <> Nuevo Cliente.
    $('#c4').click( function(){
	   
	   reset_all_the_ventas_camps();         // Esta función me pone todo a "" a la vez que cambio a otro radiobotón.
	   
	   $('#cliente_x_nombre').css("display","none");          // Escondo el <div> de la búsqueda por nombre. 
	   $('#div_search_cliente_by_name').css("display","none");    // Escondo el <div> del botón de la búsqueda por nombre. 
	   $('#cliente_x_num_cedula').css("display","none");      // Escondo el <div> de la búsqueda por #de cédula. 
	   $('#cliente_x_ruc').css("display","none");             // Escondo el <div> de la búsqueda por RUC.
	   $('#cliente_x_nuevo').css("display","inline");         // Muestro el <div> de CREAR UN NUEVO CLIENTE.
		
       $('#div_data_clientes').css("display","none");         // Escondo el <div> con los DATOS DEL CLIENTE.
	   $("#error_cliente_message").css("display", "none");       //  Mensaje de Error de algun cliente que no se haya encontrado.
	   $("#anadir_articulos").css("display", "inline");       //  botón añadir artículos
	});
	             
	/******__________________________________________________________________________________________________******/
	// 11.05) // Mediante esto voy poniendo los <text> para seleccionar el cliente de acuerdo al radio <> Sin Determinar.
	$('#c5').click( function(){
	   
	   reset_all_the_ventas_camps();         // Esta función me pone todo a "" a la vez que cambio a otro radiobotón.
	   
	   $('#cliente_x_nombre').css("display","none");              // Escondo el <div> de la búsqueda por nombre. 
	   $('#div_search_cliente_by_name').css("display","none");    // Escondo el <div> del botón de la búsqueda por nombre. 
	   $('#cliente_x_num_cedula').css("display","none");          // Escondo el <div> de la búsqueda por #de cédula.  
	   $('#cliente_x_ruc').css("display","none");                 // Escondo el <div> de la búsqueda por RUC.
	   $('#cliente_x_nuevo').css("display","none");               // Escondo el <div> de CREAR UN NUEVO CLIENTE.	
		
       $('#div_data_clientes').css("display","none");             // Escondo el <div> con los DATOS DEL CLIENTE.
	   $("#error_cliente_message").css("display", "none");       //  Mensaje de Error de algun cliente que no se haya encontrado.
	   $("#anadir_articulos").css("display", "inline");           //  botón añadir artículos
	});
	
	// 11.06)
	function reset_all_the_ventas_camps()
	{
		 // Esta función me pone todo a "" cada vez que cambio a otro radiobotón.
	     document.form_nueva_venta.cliente_venta.value = "";                        /*01 busqueda del cliente por NOMBRE */
	     document.form_nueva_venta.id_cliente_venta.value = "";
	     document.form_nueva_venta.cliente_venta_hidden.value = "";
	     document.form_nueva_venta.num_cedula_venta.value = "";                     /*02 busqueda del cliente por # DE CÉDULA */
	     document.form_nueva_venta.ruc_venta.value = "";                            /*03 busqueda del cliente por RUC */
	     document.form_nueva_venta.nuevo_cliente_nombre_venta.value = "";           /*04 NUEVO CLIENTE  */
	     document.form_nueva_venta.nuevo_cliente_num_cedula_venta.value = "";
	     document.form_nueva_venta.nuevo_cliente_ruc_venta.value = "";
	} // fin de la función reset_all_ventas_camps()
		
	/**** PRIMERA PETICIÓN AJAX ****/
	 /*(11.07)************************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL CLIENTE DE ACUERDO AL NOMBRE ******************/
	  //() SELECCIONO DE ACUERDO AL NOMBRE DEL CLIENTE LOS DATOS DE ESTE.
	  $('#search_cliente_by_name').click(function(){
	  
	  	 //(01) Busco los Datos del cliente(Nombre Completo, # de cédula, RUC, Teléfono) a través del id del CLIENTE.
		 var id_cliente = document.form_nueva_venta.id_cliente_venta.value;
	     //(02) Aquí pongo el código de la llamada ajax     --> //alert(id_cliente); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_cliente_x_nombre.php?id_cliente=' + id_cliente,  
			 async:       true,          
			 success:     show_cliente,   
			 beforeSend:  inicio_envio_cliente,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_cliente, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_cliente,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	 
	  function show_cliente(data)
	  {
           // Función que muestra los datos del usuario seleccionado para cambiarle la contraseña.	  
 	       data = eval(data);  
	       //01 Chequeo si no se encontró ningun usuario con el nombre de usuario escrito
		   if ( typeof data.nombre == "undefined")  {
			   
			   document.getElementById('error_cliente_message').innerHTML = '<b style=\'color:white;\'>' + data.error + '</b>';
		       // Muestro el mensaje de error en la pantalla y oculto los otros con los datos del cliente.
		       $("#error_cliente_message").css("display", "inline");    // error
		       $("#div_data_clientes").css("display", "none");          // data de clientes 
	           $("#anadir_articulos").css("display", "none");           //  botón añadir artículos
		   } else {
		       //02 Guardo todos los datos seleccionados en una tabla para despues continuar.
		       document.getElementById('push_cliente_full_name').innerHTML = '<b id="full_name_cliente" style=\'color:black;\'>' + data.nombre + '</b>';
		       document.getElementById('push_cliente_num_ced').innerHTML = '<b style=\'color:black;\'>' + data.cedula + '</b>';
		       document.getElementById('push_cliente_ruc').innerHTML = '<b style=\'color:black;\'>' + data.ruc + '</b>';
		       document.getElementById('push_cliente_telef').innerHTML = '<b style=\'color:black;\'>' + data.telefono + '</b>';
			   document.form_nueva_venta.id_del_cliente_venta.value = data.id;
		   
		        //(03) Muestro el <div> con los datos de la llamada AJAX con los datos del cliente y escondo el ERROR.
	            $("#div_data_clientes").css("display", "inline");     // data clientes
	            $("#error_cliente_message").css("display", "none");   // error
		        $("#anadir_articulos").css("display", "inline");     //  botón añadir artículos
		   }
	  }   // Fin de la función show_user(data)
	 	
	  function inicio_envio_cliente()
	  {  
	      // Función que se llama al realizar la petición.
	      $("#cargando_cliente").css("display", "inline");    
	  }   // Fin de la función inicio_envio_cliente()
	 
	  function stop_cargando_cliente()
	  {
		   // Función que se ejecuta cuando la petición se ha completado.
	       $("#cargando_cliente").css("display", "none");  
	  }
	 
	  function show_error_message_cliente()
	  {
		   // Función que se ejecuta cuando hay un error en la petición.
	       $("#server_error_cliente").css("display", "inline");  
	  }  // fin de la función show_error_message_cliente()
	 
	 /*********** FIN DE LA PETICIÓN AJAX PARA SELECCIONAR DE ACUERDO AL NOMBRE DEL CLIENTE LOS DATOS DE ESTE. ******************/
		
	 /**** SEGUNDA PETICIÓN AJAX ****/
	 /*(11.08)************************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL CLIENTE DE ACUERDO AL # DE CÉDULA ******************/
	  //() SELECCIONO DE ACUERDO AL # de cédula  DEL CLIENTE LOS DATOS DE ESTE.
	  $('#num_cedula_venta').blur(function(){
	  
	  	 //(01) Busco los Datos del cliente(Nombre Completo, # de cédula, RUC, Teléfono) a través del # de cédula del CLIENTE.
		 var num_cedula_cliente = document.form_nueva_venta.num_cedula_venta.value;
	     //(02) Aquí pongo el código de la llamada ajax     --> //alert(id_cliente); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_cliente_x_num_cedula.php?num_cedula_cliente=' + num_cedula_cliente,  
			 async:       true,          
			 success:     show_cliente_num_ced,   
			 beforeSend:  inicio_envio_cliente,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_cliente, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_cliente,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	 
	  function show_cliente_num_ced(data)
	  {
           // Función que muestra los datos del usuario seleccionado para cambiarle la contraseña.	  
 	       data = eval(data);  
	       //01 Chequeo si no se encontró ningun usuario con el nombre de usuario escrito
		   if ( typeof data.nombre == "undefined")  {
			   
			   document.getElementById('error_cliente_message').innerHTML = '<b style=\'color:white;\'>' + data.error + '</b>';
		       // Muestro el mensaje de error en la pantalla y oculto los otros con los datos del cliente.
		       $("#error_cliente_message").css("display", "inline");    // error
		       $("#div_data_clientes").css("display", "none");          // data de clientes 
	           $("#anadir_articulos").css("display", "none");         //  botón añadir artículos
		   } else {
		       //02 Guardo todos los datos seleccionados en una tabla para despues continuar.
		       document.getElementById('push_cliente_full_name').innerHTML = '<b id="full_name_cliente" style=\'color:black;\'>' + data.nombre + '</b>';
		       document.getElementById('push_cliente_num_ced').innerHTML = '<b style=\'color:black;\'>' + data.cedula + '</b>';
		       document.getElementById('push_cliente_ruc').innerHTML = '<b style=\'color:black;\'>' + data.ruc + '</b>';
		       document.getElementById('push_cliente_telef').innerHTML = '<b style=\'color:black;\'>' + data.telefono + '</b>';
			   document.form_nueva_venta.id_del_cliente_venta.value = data.id;
		        //(03) Muestro el <div> con los datos de la llamada AJAX con los datos del cliente y escondo el ERROR.
	            $("#div_data_clientes").css("display", "inline");     // data clientes
	            $("#error_cliente_message").css("display", "none");   // error
		        $("#anadir_articulos").css("display", "inline");     //  botón añadir artículos
		   }
	  }   // Fin de la función show_user(data)
	  
	 /*********** FIN DE LA PETICIÓN AJAX PARA SELECCIONAR EL CLIENTE DE ACUERDO AL # DE CÉDULA DE ESTE. ******************/
		
	 /****  TERCERA PETICIÓN AJAX ****/
	 /*(11.09)************************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL CLIENTE DE ACUERDO AL RUC ******************/
	  //() SELECCIONO DE ACUERDO AL ruc DEL CLIENTE LOS DATOS DE ESTE.
	  $('#ruc_venta').blur(function(){
	  
	  	 //(01) Busco los Datos del cliente(Nombre Completo, # de cédula, RUC, Teléfono) a través del ruc del CLIENTE.
		 var ruc_cliente = document.form_nueva_venta.ruc_venta.value;
	     //(02) Aquí pongo el código de la llamada ajax     --> //alert(id_cliente); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_cliente_x_ruc.php?ruc_cliente=' + ruc_cliente,  
			 async:       true,          
			 success:     show_cliente_ruc,   
			 beforeSend:  inicio_envio_cliente,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_cliente, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_cliente,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
	 
	  function show_cliente_ruc(data)
	  {
           // Función que muestra los datos del usuario seleccionado para cambiarle la contraseña.	  
 	       data = eval(data);  
	       //01 Chequeo si no se encontró ningun usuario con el nombre de usuario escrito
		   if ( typeof data.nombre == "undefined")  {
			   
			   document.getElementById('error_cliente_message').innerHTML = '<b style=\'color:white;\'>' + data.error + '</b>';
		       // Muestro el mensaje de error en la pantalla y oculto los otros con los datos del cliente.
		       $("#error_cliente_message").css("display", "inline");    // error
		       $("#div_data_clientes").css("display", "none");          // data de clientes 
	           $("#anadir_articulos").css("display", "none");     //  botón añadir artículos
		   } else {
		       //02 Guardo todos los datos seleccionados en una tabla para despues continuar.
		       document.getElementById('push_cliente_full_name').innerHTML = '<b id="full_name_cliente" style=\'color:black;\'>' + data.nombre + '</b>';
		       document.getElementById('push_cliente_num_ced').innerHTML = '<b style=\'color:black;\'>' + data.cedula + '</b>';
		       document.getElementById('push_cliente_ruc').innerHTML = '<b style=\'color:black;\'>' + data.ruc + '</b>';
		       document.getElementById('push_cliente_telef').innerHTML = '<b style=\'color:black;\'>' + data.telefono + '</b>';
			   document.form_nueva_venta.id_del_cliente_venta.value = data.id;
		        //(03) Muestro el <div> con los datos de la llamada AJAX con los datos del cliente y escondo el ERROR.
	            $("#div_data_clientes").css("display", "inline");     // data clientes
	            $("#error_cliente_message").css("display", "none");   // error
		        $("#anadir_articulos").css("display", "inline");      //  botón añadir artículos
		   }
	  }   // Fin de la función show_user(data)
	  
	 /*********** FIN DE LA PETICIÓN AJAX PARA SELECCIONAR EL CLIENTE DE ACUERDO AL RUC DE ESTE. ******************/
	
	//11.10) Función con los 31 clicks posibles cuando voy a insertar una nueva fila de artículos en al COMPRA.
	ventas_row();   // Función que está en el archivo js/ventas_row.js
	//11.11)
	ventas_charge_article1();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 1
	ventas_charge_article2();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 2
    ventas_charge_article3();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 3
	ventas_charge_article4();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 4
	ventas_charge_article5();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 5
	ventas_charge_article6();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 6
	ventas_charge_article7();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 7
	ventas_charge_article8();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 8
	ventas_charge_article9();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 9
	ventas_charge_article10();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 10
	ventas_charge_article11();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 11
	ventas_charge_article12();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 12
	ventas_charge_article13();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 13
	ventas_charge_article14();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 14
	ventas_charge_article15();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 15
	ventas_charge_article16();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 16
	ventas_charge_article17();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 17
	ventas_charge_article18();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 18
	ventas_charge_article19();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 19
	ventas_charge_article20();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 20
	ventas_charge_article21();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 21
	ventas_charge_article22();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 22
	ventas_charge_article23();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 23
	ventas_charge_article24();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 24
	ventas_charge_article25();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 25
	ventas_charge_article26();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 26
	ventas_charge_article27();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 27
	ventas_charge_article28();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 28
	ventas_charge_article29();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 29
	ventas_charge_article30();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 30 
	ventas_charge_article31();       // Función que está en el archivo ajax/ventas_charge_article.js para cargar el artículo 31 
	
	// Función que contiene todos los jQuery con la instrucciones a la hora poner la cantidad de artículos de la VENTA(31 instrucciones) y está en el archivo ajax/ventas_charge_article.js. 
	// 11.12)
	ventas_keyup_cantidad();
	
	// Función que contiene todos los jQuery con la instrucciones a la hora de borrar una fila de la nueva compra (30 instrucciones) y está en le archivo ajax/ventas_charge_article.js. 
	// 11.13)	
	ventas_delete_filas();
	
	// Función que suma los saldos totales de los artículos de esta venta y los suma al SALDO TOTAL y está en el archivo ajax/ventas_charge_article.js. 
	// 11.14)
	//show_valor_total_sumatoria_articulos_de_la_venta();  //*** AQUÍ NO TENGO QUE DEFINIRLA ***
	
	// 11.15) 
	//hide_detalle_de_pago_ventas();  //*** AQUÍ NO TENGO QUE DEFINIRLA ***
	
	// 11.16) // Mediante esto escondo el <div> del botón de añadir detalle y muestro el <div> del detalle de pago. 
	$('#anadir_pago_button_ventas').click(function(){
		
		  /**** Pongo los datos del VALOR TOTAL -> DETALLE DE VENTA EN VALOR TOTAL -> DETALLE DE PAGO y SALDO -> DETALLE DE PAGO****/
		  Resultado = $('#total_ventas_valor').text(); //Pongo el resultado en VALOR TOTAL(html)
		  Resultado = parseFloat(Resultado);
		  		  
		  // De esta forma permito que SIEMPRE sea diferente de 0 el valor de la compra.
		  if ( Resultado == 0 )  {
			  alert('Por favor introduzca valores de art\xEDculos en la venta.GRACIAS' + '\n' + 'El VALOR TOTAL es 0' );
			  return(false);  
		  }
		
		  $('#anadir_detalle_pago_ventas').hide();  // Escondo el <div> contenedor de este botón.
		  $('#detalle_pago_ventas').show();         // Muestro el <div> del detalle de pago de la venta.
	      
		  document.getElementById('monto_total_a_pagar_ventas').value = Resultado.toFixed(2);  // TOTAL A PAGAR EN LA VENTA.
		  		  		  
		  /**** Escondo todos los <div> del interior del 'DETALLE DE PAGO' e inicializo variables ****/
	      reset_forma_de_pago_down_ventas();
		  document.getElementById('descuento_general_venta').value = 0;
	});
		
	/*********************** DETALLE DE PAGO ( ESTA SECCIÓN ES LA QUE VA MOSTRANDO LOS <div> A MEDIDA QUE VOY DANDO CLICK ) ***/
	/****_________________________________________________________________________________________________****/
	// 11.17) // // Mediante esto voy cambiando los valores del 'SALDO DEL CRÉDITO' y del 'PAGO AL CONTADO' SI CAMBIA EL DESCUENTO. 
	$('#descuento_general_venta').keyup(function(){ 
				 
		var valor_total             = document.getElementById('monto_total_a_pagar_ventas').value;   // Valor total de la VENTA.
		var descuento_general       = document.getElementById('descuento_general_venta').value;      // Valor del DESCUENTO GENERAL DE LA VENTA.		
			
		//01 Escondo e inicializo todos los detalles del pago si ya los llené.
		reset_forma_de_pago_down_ventas();
						    
		if ( descuento_general == '' || descuento_general == null || isNaN(descuento_general) || valor_total == '' || valor_total == null || isNaN(valor_total) || valor_total == 0 )  {
		   //02 Verifico que el 'valor total de la venta' y el 'descuento general' tienen un valor numeral.
		   $('#monto_total_a_pagar_ventas').css('background-color','#F9BEBD');       // VALOR TOTAL DE LA VENTA.
		   $('#descuento_general_venta').css('background-color','#F9BEBD');          // DESCUENTO GENERAL.
		} else {
			//02 LLevo a cabo la resta para saber el valor real de la COMPRA. 
			valor_total = parseFloat(valor_total);
			descuento_general = parseFloat(descuento_general);
			//02.1 Este es el VALOR REAL DE LA VENTA CAMPO HIDDEN.
			valor_real_de_la_venta = valor_total - descuento_general;
			//03 Verifico que valor_real_de_la_venta > 0
			if ( valor_real_de_la_venta < 0 )  {
			    alert('Alerta!! No va a cobrar el dinero de la venta. Por favor chequee los datos.GRACIAS');
				$('#monto_total_a_pagar_ventas').css('background-color','#F9BEBD');       // VALOR TOTAL DE LA VENTA.
			    $('#descuento_general_venta').css('background-color','#F9BEBD');          // DESCUENTO GENERAL.
			    return(false);		
			} else {
			    $('#monto_total_a_pagar_ventas').css('background-color','#FFF');       // VALOR TOTAL DE LA VENTA.
			    $('#descuento_general_venta').css('background-color','#FFF');          // DESCUENTO GENERAL.
			}
		}
	});   	
		
	/****_________________________________________________________________________________________________****/
	// 11.18) // Mediante esto selecciono el radiobotón para hacer el pago al CONTADO. 
	$('#forma_pago_contado_ventas').click(function(){
		
		//01 Escondo e inicializo todos los detalles del pago si ya los llené.
		reset_forma_de_pago_down_ventas();
		//02 LLevo a cabo la resta para saber el valor real de la VENTA. 
		var valor_total             = document.getElementById('monto_total_a_pagar_ventas').value;   // Valor total de la VENTA.
		var descuento_general       = document.getElementById('descuento_general_venta').value;      // Valor del DESCUENTO GENERAL DE LA VENTA.
		
		valor_total = parseFloat(valor_total);
		descuento_general = parseFloat(descuento_general);
						
		//02.1 Este es el VALOR REAL DE LA VENTA EN EL CAMPO HIDDEN.
		valor_real_de_la_venta = valor_total - descuento_general;
		
		//03 GUARDO EL VALOR REAL DE LA VENTA EN EL CAMPO <hidden> y en el campo <text> disabled.
		document.getElementById('valor_real_de_la_venta').value = valor_real_de_la_venta.toFixed(2);
		document.getElementById('input_monto_a_pagar_ventas').value = valor_real_de_la_venta.toFixed(2);
		
		//04 zona de <div> que muestro.
		document.getElementById('forma_pago_contado_ventas').checked = 1;   // MUESTRO EL checked DEL RADIOBOTÓN DE LA FORMA DE PAGO. 
		$('#div_monto_a_pagar_real_ventas').show();                         // MUESTRO EL VALOR REAL DE LA VENTA.
		$('#div_pago_cliente_contado_ventas').show();                       // MUESTRO el <div> si la venta se paga al contado(CASO CONTADO).
	});
	
	// 11.19) // Mediante esto selecciono el radiobotón para hacer el pago a CRÉDITO. 
	$('#forma_pago_credito_ventas').click(function(){
		
		//01 Escondo e inicializo todos los detalles del pago si ya los llené.
		reset_forma_de_pago_down_ventas();
		//02 LLevo a cabo la resta para saber el valor real de la VENTA. 
		var valor_total             = document.getElementById('monto_total_a_pagar_ventas').value;   // Valor total de la VENTA.
		var descuento_general       = document.getElementById('descuento_general_venta').value;      // Valor del DESCUENTO GENERAL DE LA VENTA.
		
		valor_total = parseFloat(valor_total);
		descuento_general = parseFloat(descuento_general);
		
		//02.1 Este es el VALOR REAL DE LA VENTA EN EL CAMPO HIDDEN.
		valor_real_de_la_venta = valor_total - descuento_general;
		
		//03 GUARDO EL VALOR REAL DE LA VENTA EN EL CAMPO <hidden> y en el campo <text> disabled.
		document.getElementById('valor_real_de_la_venta').value = valor_real_de_la_venta.toFixed(2);
		document.getElementById('input_monto_a_pagar_ventas').value = valor_real_de_la_venta.toFixed(2);
		
		//04 PONGO EL 'ANTICIPO DEL CRÉDITO' EN 0 Y EL 'SALDO DEL CRÉDITO' CON EL VALOR REAL DE LA VENTA.
		document.getElementById('input_anticipo_forma_pago').value = 0; 
		document.getElementById('saldo_dinero_ventas').value = valor_real_de_la_venta.toFixed(2);
		
		/* zona de <div> que muestro */
		document.getElementById('forma_pago_credito_ventas').checked = 1;   // MUESTRO EL checked DEL RADIOBOTÓN DE LA FORMA DE PAGO.
		$('#div_monto_a_pagar_real_ventas').show();       // MUESTRO EL VALOR REAL DE LA COMPRA.
		$('#div_anticipo_origen_pago_ventas').show();     // Muestro el anticipo de dinero porque es a CRÉDITO.
	    $('#div_saldo_credito_ventas').show();            // Muestro el saldo del dinero para pagar el CRÉDITO.
		$('#div_cant_pagos_origen_pago_ventas').show();   // Muestro la cantidad de pagos que voy a hacer para pagar el CRÉDITO.
	});
	
	/******__________________________________________________________________________________________________******/
	// 11.20) // Mediante esto muestro el valor del vuelto que debo de darle al cliente + Botón Guardar.
	$('#input_pago_cliente_contado').blur(function(){
		
		var costo_compra = document.getElementById('valor_real_de_la_venta').value;       // Valor de la Venta.
		var pago_efectivo = document.getElementById('input_pago_cliente_contado').value;  // Pago del Cliente.
		// Chequeo si el valor introducido no es null, ni 0, ni algo que no sea un número.		
	    if ( pago_efectivo == null || pago_efectivo == "" || isNaN(pago_efectivo) )  {
		    alert('Por favor seleccione un valor num\xE9rico para el Pago que ha hecho el Cliente.GRACIAS');
			document.form_nueva_venta.pago_cliente_contado.focus();
			return(false);	
		} else  {
			// Esto significa que es un número y tengo que mostrar el vuelto de la COMPRA.
		    var PagoEfectivo = parseFloat(pago_efectivo);
		    var CostoCompra = parseFloat(costo_compra);
		    
			var Vuelto = PagoEfectivo - CostoCompra; 
				    			
			document.getElementById('push_vuelto_valor').innerHTML = Vuelto.toFixed(2);  // Pongo el Valor del Vuelto debajo en ROJO.
		    $('#div_vuelto_contado_ventas').show();    // Muestro los detalles del vuelto.
			$('#guardar_nueva_venta').show();          // Muestro el botón de salvar
		}
	});
	
	/******__________________________________________________________________________________________________******/
	// 11.21) // Mediante esto selecciono la cantidad de pagos de voy a hacer y muestros sus respectivos campos.
	$('#cantidad_de_pagos_credito_ventas').change(function(){
		
	  //01 Muestro el <div> con el botón de GUARDAR DATOS DE LA COMPRA.  
	  $('#guardar_nueva_compra').show();  // 
	  //02 SELECCIONO LOS CAMPOS PARA PONER LA CANTIDAD.
	  cantidad = document.getElementById('cantidad_de_pagos_credito_ventas').value;
	  
	  switch(cantidad)
	  {
		 case "0":  
		      $('#div_descripcion_cantidad_pago_ventas').hide();
			  $('#guardar_nueva_venta').hide();   // Escondo el botón de Guardar Datos.
		 break; 
		 case "1":  
		      $('#div_descripcion_cantidad_pago_ventas').show();
		      $('#fila_pago1_ventas').show();
		      $('#fila_pago2_ventas').hide();
		      $('#fila_pago3_ventas').hide();
		      $('#fila_pago4_ventas').hide();
		      $('#fila_pago5_ventas').hide();
			  $('#guardar_nueva_venta').show();   // Muestro el botón de Guardar Datos.
		 break; 
		 case "2":  
		      $('#div_descripcion_cantidad_pago_ventas').show();
		      $('#fila_pago1_ventas').show();
		      $('#fila_pago2_ventas').show();
		      $('#fila_pago3_ventas').hide();
		      $('#fila_pago4_ventas').hide();
		      $('#fila_pago5_ventas').hide();
			  $('#guardar_nueva_venta').show();   // Muestro el botón de Guardar Datos.
		 break; 
		 case "3":  
		      $('#div_descripcion_cantidad_pago_ventas').show();
		      $('#fila_pago1_ventas').show();
		      $('#fila_pago2_ventas').show();
		      $('#fila_pago3_ventas').show();
		      $('#fila_pago4_ventas').hide();
		      $('#fila_pago5_ventas').hide();
			  $('#guardar_nueva_venta').show();   // Muestro el botón de Guardar Datos.
		 break; 
		 case "4":  
		      $('#div_descripcion_cantidad_pago_ventas').show();
		      $('#fila_pago1_ventas').show();
		      $('#fila_pago2_ventas').show();
		      $('#fila_pago3_ventas').show();
		      $('#fila_pago4_ventas').show();
		      $('#fila_pago5_ventas').hide();
			  $('#guardar_nueva_venta').show();   // Muestro el botón de Guardar Datos.
		 break; 
		 case "5":  
              $('#div_descripcion_cantidad_pago_ventas').show();
		      $('#fila_pago1_ventas').show();
		      $('#fila_pago2_ventas').show();
		      $('#fila_pago3_ventas').show();
		      $('#fila_pago4_ventas').show();
		      $('#fila_pago5_ventas').show();
 		      $('#guardar_nueva_venta').show();   // Muestro el botón de Guardar Datos.
		 break; 
	  }
	});
		
	/******__________________________________________________________________________________________________******/
	// 11.22) // Mediante esto voy cambiando el valor del dinero del ANTICIPO para el crédito.
    $('input#input_anticipo_forma_pago').keyup(function(){ 
				 
		var valor_total    = document.getElementById("valor_real_de_la_venta").value;      // Valor total de la venta.		
		var valor_anticipo = document.getElementById("input_anticipo_forma_pago").value;   // Valor de la ENTRADA de dinero.  
		var saldo_dinero   = document.getElementById("saldo_dinero_ventas").value;         // Valor del SALDO del dinero para el crédito.
				    
		if ( valor_total == "" || valor_total == null || isNaN(valor_total) || valor_total == 0 || valor_anticipo == "" || valor_anticipo == null || isNaN(valor_anticipo) || saldo_dinero == "" || saldo_dinero == null || isNaN(saldo_dinero) || saldo_dinero == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			$("#input_anticipo_forma_pago").css("background-color","#F9BEBD");
		} else {
			valor_total    = parseFloat(valor_total);
			valor_anticipo = parseFloat(valor_anticipo);
			saldo_dinero   = parseFloat(saldo_dinero);
				   
			saldo_dinero = valor_total - valor_anticipo; 
			
			// Verifico que saldo_dinero > 0
			if ( saldo_dinero.toFixed(2) < 0 )  {
			    alert('Va a pagar un Anticipo para el crédito mayor que el valor de la venta. Por favor chequee los datos.GRACIAS');
				document.getElementById("saldo_dinero_ventas").value = saldo_dinero.toFixed(2);
				$("#input_anticipo_forma_pago").css("background-color","#F9BEBD");
			    $("#saldo_dinero_ventas").css("background-color","#F9BEBD");
				return(false);		
			} else {
			    document.getElementById("saldo_dinero_ventas").value = saldo_dinero.toFixed(2);
			    $("#input_anticipo_forma_pago").css("background-color","#FFF");
			    $("#saldo_dinero_ventas").css("background-color","#FFF");
			}
		}
	});   
		
	/******__________________________________________________________________________________________________******/
	//11.23) // Mediante esto voy cambiando el valor del SALDO DEL CRÉDITO para el crédito.
    $('input#saldo_dinero_ventas').keyup(function(){ 
				 
		var valor_total    = document.getElementById("valor_real_de_la_venta").value;       // Valor total de la compra.		
		var valor_anticipo = document.getElementById("input_anticipo_forma_pago").value;    // Valor de la ENTRADA de dinero.  
		var saldo_dinero   = document.getElementById("saldo_dinero_ventas").value;          // Valor del SALDO del dinero para el crédito.
				    
		if ( valor_total == "" || valor_total == null || isNaN(valor_total) || valor_total == 0 || valor_anticipo == "" || valor_anticipo == null || isNaN(valor_anticipo) || saldo_dinero == "" || saldo_dinero == null || isNaN(saldo_dinero) || saldo_dinero == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
		   $("#input_anticipo_forma_pago").css("background-color","#F9BEBD");
		   $("#saldo_dinero_ventas").css("background-color","#F9BEBD");
		} else {
						     
			valor_total   = parseFloat(valor_total);
			valor_anticipo = parseFloat(valor_anticipo);
			saldo_dinero  = parseFloat(saldo_dinero);
				   
			valor_anticipo = valor_total - saldo_dinero; 
			
			// Verifico que valor_entrada > 0
			if ( valor_anticipo.toFixed(2) < 0 )  {
			    alert('Se va a cobrar un Cr\xE9dito mayor que el valor de la venta. Por favor chequee los datos.GRACIAS');
				document.getElementById("input_anticipo_forma_pago").value = valor_anticipo.toFloat(2);
				$("#input_anticipo_forma_pago").css("background-color","#F9BEBD");
			    $("#saldo_dinero_ventas").css("background-color","#F9BEBD");
				return(false);		
			} else {
			    document.getElementById("input_entrada_forma_pago").value = valor_entrada;
			    $("#input_anticipo_forma_pago").css("background-color","#FFF");
			    $("#saldo_dinero_ventas").css("background-color","#FFF");
			}
		}
	}); 
		
	/******__________________________________________________________________________________________________******/
	// 11.24)// Mediante esto chequeo si el número del monto de la venta(sup. der) es un numero....
    $('input#monto_total_a_pagar_ventas').keyup(function(){ 
		   
		var valor_total  = document.getElementById("monto_total_a_pagar_ventas").value;       // Valor total de la venta.		
		
		//01 Reinicio y oculto todo en la sección 3: DETALLE DE PAGO E INICIALIZO EL CAMPO DESCUENTO TOTAL DE LA EVNTA.
		reset_forma_de_pago_down_ventas();
		document.getElementById('descuento_general_venta').value = 0;
						
		//02 VERIFICO QUE SEA UN NÚMERO LO QUE ESTOY PONIENDO.
		if ( valor_total == "" || valor_total == null || isNaN(valor_total) || valor_total == 0 )  {
		    // Verifico que la cantidad tiene un valor numeral.
			$("#monto_total_a_pagar_ventas").css("background-color","#F9BEBD");
		} else {
			$("#monto_total_a_pagar_ventas").css("background-color","#FFFFFF");
		}
	});
	
	/******__________________________________________________________________________________________________******/
	//11.26) // Mediante esto actualizo la página con el objetivo de que se cargen todos los artículos del almacén seleccionado.
	$('#select_local_para_venta').change( function (){ 
	  
	  var id_local_venta = document.form_nueva_venta.select_local.value;
	  // ACTUALIZO LA PÁGINA PARA OBTENER LOS DATOS DEL LOCAL DE LA VENTA.
	  if ( id_local_venta == "seleccione" )  {
	      // CASO 1: SELECCIONO 'seleccione'
	      document.location.href = 'index.php?mod=mod_ventas&optionv=nueva_venta#tabs-1';
	  } else {
		  // CASO 2: SELECCIONO UN LOCAL. 
		  document.location.href = 'index.php?mod=mod_ventas&optionv=nueva_venta&localid=' + id_local_venta + '#tabs-1';
	  }
	});
	
	/******__________________________________________________________________________________________________******/
	// 11.27) // Mediante esto:
	//a)  pongo en cero todos los campos debajo de la Forma de Pago.
	//b)  escondo todos los <divs> debajo de la forma de pago.
	function reset_forma_de_pago_down_ventas()
	{
	   
	     $('#div_monto_a_pagar_real_ventas').hide();    // Escondo el <div> del monto a pagar si la venta se paga al contado (CASO CONTADO y CRÉDITO).
		 $('#div_anticipo_origen_pago_ventas').hide();  // Escondo el <div> del anticipo de dinero (CASO CRÉDITO).
	     $('#div_pago_cliente_contado_ventas').hide();  // Escondo el <div> del pago del cliente si este paga al contado (CASO CONTADO).
		 $('#div_vuelto_contado_ventas').hide();        // Escondo el <div> del vuelto de la venta si esta se paga al contado (CASO CONTADO).
		 $('#div_saldo_credito_ventas').hide();         // Escondo el <div> con el saldo del dinero para pagar el CRÉDITO. 
		 $('#div_cant_pagos_origen_pago_ventas').hide(); // Escondo el <div> con q selecciono la cant. de pagos que voy a hacer para pagar el CRÉDITO. 
		 $('#div_descripcion_cantidad_pago_ventas ').hide(); // Escondo la tabla con los detalles de la cantidad de pagos que voy a hacer para pagar el CRÉDITO.
		 $('#guardar_nueva_venta').hide();              // Escondo el <div> con el botón de GUARDAR DATOS DE LA VENTA
		  
		 /* zona de inicialización de variables a 0 */
	     document.getElementById('valor_real_de_la_venta').value = "";      // hidden valor real de la venta.
		 document.getElementById('input_monto_a_pagar_ventas').value = "";  // <text> con el valor real de la venta disabled.
		 
		 document.getElementById('forma_pago_contado_ventas').checked = 0;  // radiobotón con la Forma de Pago Contado.
		 document.getElementById('forma_pago_credito_ventas').checked = 0;  // radiobotón con la Forma de Pago Crédito.
		 
		 document.getElementById('input_pago_cliente_contado').value = 0;   // <text> para cuando el Pago del Cliente es al Contado.
		 document.getElementById('push_vuelto_valor').innerHTML = "";       // Se muestra el vuelto cuando el Pago del Cliente es al Contado.
		 
		 document.getElementById('input_anticipo_forma_pago').value = 0;    // <text> con el valor del anticipo cuando la venta es a Crédito.  
		 document.getElementById('saldo_dinero_ventas').value = "";         // <text> con el Saldo de dinero de la Venta para el caso Crédito.
		 
		 document.getElementById('cantidad_de_pagos_credito_ventas').value = "0";  // <select> con la cantidad de pagos. 
	     /*1*/  
	     document.getElementById('monto_total_pago1_ventas').value = "";    // input.text con el monto del pago a crédito 1.
	     document.getElementById('fecha_pago1_ventas').value = "";          // input.text con la fecha del pago a crédito 1.
	     document.getElementById('descripcion_pago1_ventas').value = "";    // input.text con la descripción del pago a crédito 1.
	     /*2*/  
	     document.getElementById('monto_total_pago2_ventas').value = "";    // input.text con el monto del pago a crédito 2.
	     document.getElementById('fecha_pago2_ventas').value = "";          // input.text con la fecha del pago a crédito 2.
	     document.getElementById('descripcion_pago2_ventas').value = "";    // input.text con la descripción del pago a crédito 2.
	     /*3*/  
	     document.getElementById('monto_total_pago3_ventas').value = "";    // input.text con el monto del pago a crédito 3.
	     document.getElementById('fecha_pago3_ventas').value = "";          // input.text con la fecha del pago a crédito 3.
	     document.getElementById('descripcion_pago3_ventas').value = "";    // input.text con la descripción del pago a crédito 3.
	     /*4*/  
	     document.getElementById('monto_total_pago4_ventas').value = "";    // input.text con el monto del pago a crédito 4.
	     document.getElementById('fecha_pago4_ventas').value = "";          // input.text con la fecha del pago a crédito 4.
	     document.getElementById('descripcion_pago4_ventas').value = "";    // input.text con la descripción del pago a crédito 4.
	     /*5*/  
	     document.getElementById('monto_total_pago5_ventas').value = "";    // input.text con el monto del pago a crédito 5.
	     document.getElementById('fecha_pago5_ventas').value = "";          // input.text con la fecha del pago a crédito 5.
	     document.getElementById('descripcion_pago5_ventas').value = "";    // input.text con la descripción del pago a crédito 5.  
	}     // Fin de la función reset_forma_de_pago_down_ventas() 
  });     // Fin del $(document).ready(function() {
})        // Fin del head.ready(function () {