
    /****************************************************************************************************************
    
	(( 11.11 ))    - Funciones que cargan los datos de los artículos que quiero introducir en la nueva venta.
	
	01 function ventas_charge_article1()
	02 function ventas_charge_article2()
	.......
	.......
	31 function ventas_charge_article31()
	
	(( 11.12 ))    - Función que contiene todos los jQuery con las instrucciones a la hora poner la cantidad de artículos de la compra(31 instrucciones) y hace la sumatoria en la fila y en el valor total. 
	
	32-62  function ventas_keyup_cantidad();
	
	-- falta --
	
	(( 11.13 ))    - Función que contiene todos los jQuery con la instrucciones a la hora de borrar una fila de la nueva compra (30 instrucciones). 
	
	63-92 function delete_filas()
	
	(( 11.14 ))  - Función que suman los contenidos de los artículos seleccionados y se obtiene el valor total.
	
	93 function show_valor_total_sumatoria_articulos_de_la_venta()
	
	(( 11.15 ))  - Función que se ejecuta al hacer cualquier el DETALLE DE LA COMPRA para esconder todo lo de DETALLE DE PAGO.
   
    94 function hide_detalle_de_pago_ventas()
  
	*****************************************************************************************************************/

    /******************************************** (( 11.11 )) *******************************************************/
   
   /****PRIMERA PETICIÓN AJAX ****/
   /*(11.11.01)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 1) *****************/
  
  function ventas_charge_article1()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_1').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_1.value;
		 //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
	     //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article1_ventas,   
			 beforeSend:  inicio_envio_article1_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article1_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article1_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article1   
	    
	  function charge_data_article1_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_1').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_1.value = "";
			   document.form_nueva_venta.codigo_1.value = "";
			   document.getElementById('ventas_unidad_medida_1').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_1.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_1.value = "";	
		       document.form_nueva_venta.cantidad_1.value = 0;
		       document.form_nueva_venta.valor_total_1.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_1.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_1').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_1.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_1').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
		   	   document.form_nueva_venta.stock_actual_almac_hidden_1.value = data.stock_actual;	
			   document.form_nueva_venta.cantidad_1.value = 0;
		       document.form_nueva_venta.valor_total_1.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article1_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article1_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article1_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article1_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/**************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 1*********************/
	  
   /****SEGUNDA PETICIÓN AJAX ****/
   /*(11.11.02)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 2) *****************/
  
  function ventas_charge_article2()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_2').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_2.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article2_ventas,   
			 beforeSend:  inicio_envio_article2_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article2_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article2_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article2   
	    
	  function charge_data_article2_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_2').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_2.value = "";
			   document.form_nueva_venta.codigo_2.value = "";
			   document.getElementById('ventas_unidad_medida_2').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_2.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_2.value = "";	
		       document.form_nueva_venta.cantidad_2.value = 0;
		       document.form_nueva_venta.valor_total_2.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_2.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_2').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_2.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_2').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
		   	   document.form_nueva_venta.stock_actual_almac_hidden_2.value = data.stock_actual;		
			   document.form_nueva_venta.cantidad_2.value = 0;
		       document.form_nueva_venta.valor_total_2.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article2_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article2_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article2_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article2_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 2*********************/
	    /****TERCERA PETICIÓN AJAX ****/
   /*(11.11.03)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 3) *****************/
  
  function ventas_charge_article3()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_3').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_3.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article3_ventas,   
			 beforeSend:  inicio_envio_article3_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article3_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article3_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article3   
	    
	  function charge_data_article3_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_3').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_3.value = "";
			   document.form_nueva_venta.codigo_3.value = "";
			   document.getElementById('ventas_unidad_medida_3').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_3.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_3.value = "";	
		       document.form_nueva_venta.cantidad_3.value = 0;
		       document.form_nueva_venta.valor_total_3.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_3.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_3').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_3.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_3').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_3.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_3.value = 0;
		       document.form_nueva_venta.valor_total_3.value = 0;
	       }
	  }   // Fin de la función charge_data_article3_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article3_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article3_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article3_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 3*********************/
		    
    /****CUARTA PETICIÓN AJAX ****/
   /*(11.11.04)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 4) *****************/
  
  function ventas_charge_article4()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_4').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_4.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article4_ventas,   
			 beforeSend:  inicio_envio_article4_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article4_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article4_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article4   
	   
	  function charge_data_article4_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_4').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_4.value = "";
			   document.form_nueva_venta.codigo_4.value = "";
			   document.getElementById('ventas_unidad_medida_4').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_4.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_4.value = "";	
		       document.form_nueva_venta.cantidad_4.value = 0;
		       document.form_nueva_venta.valor_total_4.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_4.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_4').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_4.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_4').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_4.value = data.stock_actual;	
		       document.form_nueva_venta.cantidad_4.value = 0;
		       document.form_nueva_venta.valor_total_4.value = 0;
	       }
	  }   // Fin de la función charge_data_article4_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article4_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article4_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article4_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/**************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 4*********************/
		    
    /****QUINTA PETICIÓN AJAX ****/
   /*(11.11.05)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 5) *****************/
  
  function ventas_charge_article5()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_5').change(function(){
	 	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_5.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article5_ventas,   
			 beforeSend:  inicio_envio_article5_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article5_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article5_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article5   
	  	  
	  function charge_data_article5_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_5').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_5.value = "";
			   document.form_nueva_venta.codigo_5.value = "";
			   document.getElementById('ventas_unidad_medida_5').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_5.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_5.value = "";	
		       document.form_nueva_venta.cantidad_5.value = 0;
		       document.form_nueva_venta.valor_total_5.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_5.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_5').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_5.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_5').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_5.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_5.value = 0;
		       document.form_nueva_venta.valor_total_5.value = 0;
	       }
	  }   // Fin de la función charge_data_article5_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article5_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article5_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article5_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 5*********************/
	   
    /****SEXTA PETICIÓN AJAX ****/
   /*(11.11.06)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 6) *****************/
  
  function ventas_charge_article6()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_6').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_6.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article6_ventas,   
			 beforeSend:  inicio_envio_article6_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article6_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article6_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article6   
	    
	  function charge_data_article6_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_6').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_6.value = "";
			   document.form_nueva_venta.codigo_6.value = "";
			   document.getElementById('ventas_unidad_medida_6').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_6.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_6.value = "";	
		       document.form_nueva_venta.cantidad_6.value = 0;
		       document.form_nueva_venta.valor_total_6.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_6.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_6').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_6.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_6').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_6.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_6.value = 0;
		       document.form_nueva_venta.valor_total_6.value = 0;
	       }
	  }   // Fin de la función charge_data_article6_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article6_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article6_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article6_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 6*********************/
	   
     /****SEPTIMA PETICIÓN AJAX ****/
   /*(11.11.07)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 7) *****************/
  
  function ventas_charge_article7()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_7').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_7.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article7_ventas,   
			 beforeSend:  inicio_envio_article7_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article7_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article7_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article7   
	  
	  function charge_data_article7_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_7').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_7.value = "";
			   document.form_nueva_venta.codigo_7.value = "";
			   document.getElementById('ventas_unidad_medida_7').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_7.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_7.value = "";	
		       document.form_nueva_venta.cantidad_7.value = 0;
		       document.form_nueva_venta.valor_total_7.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_7.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_7').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_7.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_7').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_7.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_7.value = 0;
		       document.form_nueva_venta.valor_total_7.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article7_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article7_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article7_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article7_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 7*********************/
	     
     /****OCTAVA PETICIÓN AJAX ****/
   /*(11.11.08)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 8) *****************/
  
  function ventas_charge_article8()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_8').change(function(){
	 	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_8.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article8_ventas,   
			 beforeSend:  inicio_envio_article8_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article8_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article8_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article8   
	  	  
	  function charge_data_article8_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_8').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_8.value = "";
			   document.form_nueva_venta.codigo_8.value = "";
			   document.getElementById('ventas_unidad_medida_8').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_8.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_8.value = "";	
		       document.form_nueva_venta.cantidad_8.value = 0;
		       document.form_nueva_venta.valor_total_8.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_8.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_8').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_8.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_8').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_8.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_8.value = 0;
		       document.form_nueva_venta.valor_total_8.value = 0;
	       }
	  }   // Fin de la función charge_data_article8_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article8_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article8_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article8_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
      }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 8 *********************/
     
   /****NOVENA PETICIÓN AJAX ****/
   /*(11.11.09)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 9) *****************/
  
  function ventas_charge_article9()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_9').change(function(){
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_9.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article9_ventas,   
			 beforeSend:  inicio_envio_article9_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article9_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article9_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article9   
	 	  
	  function charge_data_article9_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_9').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_9.value = "";
			   document.form_nueva_venta.codigo_9.value = "";
			   document.getElementById('ventas_unidad_medida_9').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_9.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_9.value = "";	
		       document.form_nueva_venta.cantidad_9.value = 0;
		       document.form_nueva_venta.valor_total_9.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_9.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_9').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_9.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_9').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_9.value = data.stock_actual;	
		       document.form_nueva_venta.cantidad_9.value = 0;
		       document.form_nueva_venta.valor_total_9.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article9_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article9_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article9_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article9_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 9 *********************/
      
   /****DÉCIMA PETICIÓN AJAX ****/
   /*(11.11.10)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 10) *****************/
  
  function ventas_charge_article10()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_10').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_10.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article10_ventas,   
			 beforeSend:  inicio_envio_article10_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article10_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article10_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article10   
	  	  
	  function charge_data_article10_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_10').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_10.value = "";
			   document.form_nueva_venta.codigo_10.value = "";
			   document.getElementById('ventas_unidad_medida_10').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_10.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_10.value = "";	
		       document.form_nueva_venta.cantidad_10.value = 0;
		       document.form_nueva_venta.valor_total_10.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_10.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_10').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_10.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_10').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_10.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_10.value = 0;
		       document.form_nueva_venta.valor_total_10.value = 0;
	       }
	  }   // Fin de la función charge_data_article10_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article10_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article10_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article10_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 10 *********************/
      
    /****ONCENA PETICIÓN AJAX ****/
   /*(11.11.11)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 11) *****************/
  
  function ventas_charge_article11()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_11').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_11.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article11_ventas,   
			 beforeSend:  inicio_envio_article11_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article11_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article11_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article11   
	   
	  function charge_data_article11_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_11').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_11.value = "";
			   document.form_nueva_venta.codigo_11.value = "";
			   document.getElementById('ventas_unidad_medida_11').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_11.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_11.value = "";	
		       document.form_nueva_venta.cantidad_11.value = 0;
		       document.form_nueva_venta.valor_total_11.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_11.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_11').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_11.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_11').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_11.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_11.value = 0;
		       document.form_nueva_venta.valor_total_11.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article11_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article11_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article11_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article11_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 11 *********************/
     
   /****DUODÉCIMA PETICIÓN AJAX ****/
   /*(11.11.12)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 12) *****************/
  
  function ventas_charge_article12()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_12').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_12.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article12_ventas,   
			 beforeSend:  inicio_envio_article12_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article12_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article12_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article12   
	    
	  function charge_data_article12_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_12').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_12.value = "";
			   document.form_nueva_venta.codigo_12.value = "";
			   document.getElementById('ventas_unidad_medida_12').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_12.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_12.value = "";	
		       document.form_nueva_venta.cantidad_12.value = 0;
		       document.form_nueva_venta.valor_total_12.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_12.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_12').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_12.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_12').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_12.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_12.value = 0;
		       document.form_nueva_venta.valor_total_12.value = 0;
	       }
	  }   // Fin de la función charge_data_article12_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article12_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article12_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article12_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 12 *********************/
    
     /****TRIGÉCIMA PETICIÓN AJAX ****/
   /*(11.11.13)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 13) *****************/
  
  function ventas_charge_article13()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_13').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_13.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article13_ventas,   
			 beforeSend:  inicio_envio_article13_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article13_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article13_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article13   
	    
	  function charge_data_article13_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_13').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_13.value = "";
			   document.form_nueva_venta.codigo_13.value = "";
			   document.getElementById('ventas_unidad_medida_13').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_13.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_13.value = "";	
		       document.form_nueva_venta.cantidad_13.value = 0;
		       document.form_nueva_venta.valor_total_13.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_13.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_13').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_13.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_13').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_13.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_13.value = 0;
		       document.form_nueva_venta.valor_total_13.value = 0;
	       }
	  }   // Fin de la función charge_data_article13_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article13_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article13_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article13_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/*************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 13 *********************/
     
   /****DÉCIMO CUARTA PETICIÓN AJAX ****/
   /*(11.11.14)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 14) *****************/
  
  function ventas_charge_article14()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_14').change(function(){
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_14.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article14_ventas,   
			 beforeSend:  inicio_envio_article14_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article14_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article14_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article14   
	 	  
	  function charge_data_article14_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_14').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_14.value = "";
			   document.form_nueva_venta.codigo_14.value = "";
			   document.getElementById('ventas_unidad_medida_14').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_14.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_14.value = "";	
		       document.form_nueva_venta.cantidad_14.value = 0;
		       document.form_nueva_venta.valor_total_14.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_14.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_14').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_14.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_14').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_14.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_14.value = 0;
		       document.form_nueva_venta.valor_total_14.value = 0;
	       }
	  }   // Fin de la función charge_data_article14_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article14_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article14_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article14_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 14 *********************/
     
   /****DÉCIMO QUINTA PETICIÓN AJAX ****/
   /*(11.11.15)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 15) *****************/
  
  function ventas_charge_article15()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_15').change(function(){
	 	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_15.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article15_ventas,   
			 beforeSend:  inicio_envio_article15_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article15_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article15_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article15   
	  
	  function charge_data_article15_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_15').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_15.value = "";
			   document.form_nueva_venta.codigo_15.value = "";
			   document.getElementById('ventas_unidad_medida_15').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_15.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_15.value = "";	
		        document.form_nueva_venta.cantidad_15.value = 0;
		       document.form_nueva_venta.valor_total_15.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_15.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_15').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_15.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_15').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_15.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_15.value = 0;
		       document.form_nueva_venta.valor_total_15.value = 0;
	       }
	  }   // Fin de la función charge_data_article15_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article15_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article15_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article15_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 15 *********************/
      
	/****DÉCIMO SEXTA PETICIÓN AJAX ****/
   /*(11.11.16)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 16) *****************/
  
  function ventas_charge_article16()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_16').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_16.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article16_ventas,   
			 beforeSend:  inicio_envio_article16_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article16_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article16_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article16   
		  
	  function charge_data_article16_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_16').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_16.value = "";
			   document.form_nueva_venta.codigo_16.value = "";
			   document.getElementById('ventas_unidad_medida_16').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_16.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_16.value = "";	
		       document.form_nueva_venta.cantidad_16.value = 0;
		       document.form_nueva_venta.valor_total_16.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_16.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_16').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_16.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_16').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_16.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_16.value = 0;
		       document.form_nueva_venta.valor_total_16.value = 0;
	       }
	  }   // Fin de la función charge_data_article16_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article16_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article16_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article16_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 16 *********************/
     
   /****DÉCIMO SEPTIMA PETICIÓN AJAX ****/
   /*(11.11.17)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 17) *****************/
  
  function ventas_charge_article17()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_17').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_17.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article17_ventas,   
			 beforeSend:  inicio_envio_article17_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article17_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article17_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article17   
	  
	  function charge_data_article17_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_17').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_17.value = "";
			   document.form_nueva_venta.codigo_17.value = "";
			   document.getElementById('ventas_unidad_medida_17').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_17.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_17.value = "";	
		       document.form_nueva_venta.cantidad_17.value = 0;
		       document.form_nueva_venta.valor_total_17.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_17.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_17').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_17.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_17').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_17.value = data.stock_actual;	
		       document.form_nueva_venta.cantidad_17.value = 0;
		       document.form_nueva_venta.valor_total_17.value = 0;
	       }
	  }   // Fin de la función charge_data_article17_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article17_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article17_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article17_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 17 *********************/
     
    /****DÉCIMO OCTAVA PETICIÓN AJAX ****/
   /*(11.11.18)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 18) *****************/
  
  function ventas_charge_article18()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_18').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_18.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
	     //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article18_ventas,   
			 beforeSend:  inicio_envio_article18_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article18_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article18_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article18   
	    
	  function charge_data_article18_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_18').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_18.value = "";
			   document.form_nueva_venta.codigo_18.value = "";
			   document.getElementById('ventas_unidad_medida_18').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_18.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_18.value = "";	
		       document.form_nueva_venta.cantidad_18.value = 0;
		       document.form_nueva_venta.valor_total_18.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_18.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_18').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_18.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_18').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_18.value = data.stock_actual;	
		       document.form_nueva_venta.cantidad_18.value = 0;
		       document.form_nueva_venta.valor_total_18.value = 0;
	       }
	  }   // Fin de la función charge_data_article18_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article18_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article18_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article18_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 18 *********************/
      
   /****DÉCIMO NOVENA PETICIÓN AJAX ****/
   /*(11.11.19)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 19) *****************/
  
  function ventas_charge_article19()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_19').change(function(){
	 	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_19.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article19_ventas,   
			 beforeSend:  inicio_envio_article19_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article19_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article19_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article19   
	  
	  function charge_data_article19_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_19').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_19.value = "";
			   document.form_nueva_venta.codigo_19.value = "";
			   document.getElementById('ventas_unidad_medida_19').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_19.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_19.value = "";	
		       document.form_nueva_venta.cantidad_19.value = 0;
		       document.form_nueva_venta.valor_total_19.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_19.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_19').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_19.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_19').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_19.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_19.value = 0;
		       document.form_nueva_venta.valor_total_19.value = 0;
	       }
	  }   // Fin de la función charge_data_article19_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article19_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article19_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article19_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 19 *********************/
      
   /****VIGÉSIMA PETICIÓN AJAX ****/
   /*(11.11.20)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 20) *****************/
  
  function ventas_charge_article20()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_20').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_20.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
	     //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article20_ventas,   
			 beforeSend:  inicio_envio_article20_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article20_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article20_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article20   
	  
	  function charge_data_article20_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_20').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_20.value = "";
			   document.form_nueva_venta.codigo_20.value = "";
			   document.getElementById('ventas_unidad_medida_20').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_20.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_20.value = "";	
		       document.form_nueva_venta.cantidad_20.value = 0;
		       document.form_nueva_venta.valor_total_20.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_20.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_20').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_20.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_20').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_20.value = data.stock_actual;	
		       document.form_nueva_venta.cantidad_20.value = 0;
		       document.form_nueva_venta.valor_total_20.value = 0;
	       }
	  }   // Fin de la función charge_data_article20_ventas(data)
	 
	   // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article20_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article20_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article20_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 20 *********************/
     
    /****VIGÉSIMO PRIMERA PETICIÓN AJAX ****/
   /*(11.11.21)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 21) *****************/
  
  function ventas_charge_article21()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_21').change(function()  {
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_21.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article21_ventas,   
			 beforeSend:  inicio_envio_article21_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article21_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article21_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article21   
	  	  
	  function charge_data_article21_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_21').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_21.value = "";
			   document.form_nueva_venta.codigo_21.value = "";
			   document.getElementById('ventas_unidad_medida_21').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_21.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_21.value = "";	
		       document.form_nueva_venta.cantidad_21.value = 0;
		       document.form_nueva_venta.valor_total_21.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_21.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_21').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_21.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_21').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_21.value = data.stock_actual;	
		       document.form_nueva_venta.cantidad_21.value = 0;
		       document.form_nueva_venta.valor_total_21.value = 0;
	       }
	  }   // Fin de la función charge_data_article21_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article21_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article21_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article21_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 21 *********************/
     
   /****VIGÉSIMO SEGUNDA PETICIÓN AJAX ****/
   /*(11.11.22)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 22) *****************/
  
  function ventas_charge_article22()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_22').change(function()  {
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_22.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article22_ventas,   
			 beforeSend:  inicio_envio_article22_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article22_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article22_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article22   
	    
	  function charge_data_article22_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_22').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_22.value = "";
			   document.form_nueva_venta.codigo_22.value = "";
			   document.getElementById('ventas_unidad_medida_22').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_22.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_22.value = "";	
		       document.form_nueva_venta.cantidad_22.value = 0;
		       document.form_nueva_venta.valor_total_22.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_22.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_22').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_22.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_22').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_22.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_22.value = 0;
		       document.form_nueva_venta.valor_total_22.value = 0;
	       }
	  }   // Fin de la función charge_data_article22_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article22_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article22_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article22_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 22 *********************/
      
     /****VIGÉSIMO TERCERA PETICIÓN AJAX ****/
   /*(11.11.23)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 23) *****************/
  
  function ventas_charge_article23()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_23').change(function()  {
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_23.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
	     //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article23_ventas,   
			 beforeSend:  inicio_envio_article23_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article23_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article23_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article23   
	  
	  function charge_data_article23_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_23').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_23.value = "";
			   document.form_nueva_venta.codigo_23.value = "";
			   document.getElementById('ventas_unidad_medida_23').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_23.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_23.value = "";	
		       document.form_nueva_venta.cantidad_23.value = 0;
		       document.form_nueva_venta.valor_total_23.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_23.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_23').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_23.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_23').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_23.value = data.stock_actual;	
		       document.form_nueva_venta.cantidad_23.value = 0;
		       document.form_nueva_venta.valor_total_23.value = 0;
	       }
	  }   // Fin de la función charge_data_article23_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article23_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article23_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article23_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 23 *********************/
     
   /****VIGÉSIMO CUARTA PETICIÓN AJAX ****/
   /*(11.11.24)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 24) *****************/
  
  function ventas_charge_article24()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_24').change(function()  {
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_24.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article24_ventas,   
			 beforeSend:  inicio_envio_article24_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article24_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article24_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article24   
	    
	  function charge_data_article24_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_24').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_24.value = "";
			   document.form_nueva_venta.codigo_24.value = "";
			   document.getElementById('ventas_unidad_medida_24').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_24.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_24.value = "";	
		       document.form_nueva_venta.cantidad_24.value = 0;
		       document.form_nueva_venta.valor_total_24.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_24.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_24').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_24.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_24').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_24.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_24.value = 0;
		       document.form_nueva_venta.valor_total_24.value = 0;
	       }
	  }   // Fin de la función charge_data_article24_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article24_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article24_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article24_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 24 *********************/
      
	/****VIGÉSIMO QUINTA PETICIÓN AJAX ****/
   /*(11.11.25)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 25) *****************/
  
  function ventas_charge_article25()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_25').change(function()  {
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_25.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article25_ventas,   
			 beforeSend:  inicio_envio_article25_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article25_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article25_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article25   
	 
	  function charge_data_article25_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_25').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_25.value = "";
			   document.form_nueva_venta.codigo_25.value = "";
			   document.getElementById('ventas_unidad_medida_25').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_25.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_25.value = "";	
		       document.form_nueva_venta.cantidad_25.value = 0;
		       document.form_nueva_venta.valor_total_25.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_25.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_25').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_25.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_25').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_25.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_25.value = 0;
		       document.form_nueva_venta.valor_total_25.value = 0;
	       }
	  }   // Fin de la función charge_data_article25_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article25_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article25_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article25_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 25 *********************/
           
	/****VIGÉSIMO SEXTA PETICIÓN AJAX ****/
   /*(11.11.26)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 26) *****************/
  
  function ventas_charge_article26()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_26').change(function()  {
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_26.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article26_ventas,   
			 beforeSend:  inicio_envio_article26_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article26_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article26_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article26   
	  
	  function charge_data_article26_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_26').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_26.value = "";
			   document.form_nueva_venta.codigo_26.value = "";
			   document.getElementById('ventas_unidad_medida_26').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_26.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_26.value = "";	
		       document.form_nueva_venta.cantidad_26.value = 0;
		       document.form_nueva_venta.valor_total_26.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_26.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_26').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_26.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_26').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_26.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_26.value = 0;
		       document.form_nueva_venta.valor_total_26.value = 0;
	       }
	  }   // Fin de la función charge_data_article26_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article26_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article26_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article26_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 26 *********************/
      
   /****VIGÉSIMO SEPTIMA PETICIÓN AJAX ****/
   /*(11.11.27)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 27) *****************/
  
  function ventas_charge_article27()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_27').change(function()  {
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_27.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article27_ventas,   
			 beforeSend:  inicio_envio_article27_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article27_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article27_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article27   
	    
	  function charge_data_article27_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_27').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_27.value = "";
			   document.form_nueva_venta.codigo_27.value = "";
			   document.getElementById('ventas_unidad_medida_27').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_27.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_27.value = "";	
		       document.form_nueva_venta.cantidad_27.value = 0;
		       document.form_nueva_venta.valor_total_27.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_27.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_27').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_27.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_27').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_27.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_27.value = 0;
		       document.form_nueva_venta.valor_total_27.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article27_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article27_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article27_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article27_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 27 *********************/
    
    /****VIGÉSIMO OCTAVA PETICIÓN AJAX ****/
   /*(11.11.28)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 28) *****************/
  
  function ventas_charge_article28()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_28').change(function()  {
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_28.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article28_ventas,   
			 beforeSend:  inicio_envio_article28_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article28_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article28_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article28   
	  
	  function charge_data_article28_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_28').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_28.value = "";
			   document.form_nueva_venta.codigo_28.value = "";
			   document.getElementById('ventas_unidad_medida_28').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_28.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_28.value = "";	
		       document.form_nueva_venta.cantidad_28.value = 0;
		       document.form_nueva_venta.valor_total_28.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_28.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_28').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_28.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_28').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_28.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_28.value = 0;
		       document.form_nueva_venta.valor_total_28.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article28_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article28_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article28_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article28_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 28 *********************/
      
    /****VIGÉSIMO NOVENA PETICIÓN AJAX ****/
   /*(11.11.29)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 29) *****************/
  
  function ventas_charge_article29()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_29').change(function()  {
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_29.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article29_ventas,   
			 beforeSend:  inicio_envio_article29_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article29_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article29_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article29   
	  
	  function charge_data_article29_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_29').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_29.value = "";
			   document.form_nueva_venta.codigo_29.value = "";
			   document.getElementById('ventas_unidad_medida_29').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_29.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_29.value = "";	
		       document.form_nueva_venta.cantidad_29.value = 0;
		       document.form_nueva_venta.valor_total_29.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_29.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_29').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_29.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_29').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_29.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_29.value = 0;
		       document.form_nueva_venta.valor_total_29.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article29_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article29_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article29_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article29_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 29 *********************/
   
	/****TRIGÉSIMA PETICIÓN AJAX ****/
   /*(11.11.30)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 30) *****************/
  
  function ventas_charge_article30()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_30').change(function()  {
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_30.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article30_ventas,   
			 beforeSend:  inicio_envio_article30_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article30_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article30_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article30   
	    
	  function charge_data_article30_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_30').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_30.value = "";
			   document.form_nueva_venta.codigo_30.value = "";
			   document.getElementById('ventas_unidad_medida_30').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_30.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_30.value = "";	
		       document.form_nueva_venta.cantidad_30.value = 0;
		       document.form_nueva_venta.valor_total_30.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_30.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_30').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_30.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_30').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_30.value = data.stock_actual;	
		   	   document.form_nueva_venta.cantidad_30.value = 0;
		       document.form_nueva_venta.valor_total_30.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article30_ventas(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article30_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article30_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article30_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 30 *********************/
     
   /****TRIGÉSIMO PRIMERA PETICIÓN AJAX ****/
   /*(11.11.31)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA (FILA 31) *****************/
  
  function ventas_charge_article31()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#ventas_descripcion_art_31').change(function()  {
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_venta.descripcion_art_31.value;
	     //(02) Tengo el id del local donde voy a hacer la venta (Para sacar la cantidad en ese momento y ponerlo en el <title> )
		 var id_local = document.form_nueva_venta.select_local.value; 
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago_ventas(1);
	     //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/ventas_search_articulo_data.php?id_articulo=' + id_articulo + '&id_local=' + id_local,  
			 async:       true,          
			 success:     charge_data_article31_ventas,   
			 beforeSend:  inicio_envio_article31_ventas,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article31_ventas, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article31_ventas,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
  }  // Fin de la función charge_article31   
	  	  
	  function charge_data_article31_ventas(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a ventas_search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   // CASO 1. CUANDO EL change ES CON EL VALOR "Seleccione".
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('ventas_valor_total_31').value; 
			   var total = document.getElementById('total_ventas_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_ventas_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_venta.descripcion_art_31.value = "";
			   document.form_nueva_venta.codigo_31.value = "";
			   document.getElementById('ventas_unidad_medida_31').innerHTML = "unidad medida";
			   document.form_nueva_venta.precio_31.value = 0;
			   document.form_nueva_venta.stock_actual_almac_hidden_31.value = "";	
		       document.form_nueva_venta.cantidad_31.value = 0;
		       document.form_nueva_venta.valor_total_31.value = 0;
		   } else {  
		       // CASO 2: CUANDO EL change EL ALGÚN ARTÍCULO. 
		       document.form_nueva_venta.codigo_31.value = data.codigo_art; 
		       document.getElementById('ventas_unidad_medida_31').innerHTML = data.unidad_medida;
		       document.form_nueva_venta.precio_31.value = data.precio_venta1; 
	           document.getElementById('ventas_precio_31').title = "precio 2: " + data.precio_venta2 + ", " + "precio 3: " + data.precio_venta3 + "\nStock Actual: " + data.stock_actual;
			   document.form_nueva_venta.stock_actual_almac_hidden_31.value = data.stock_actual;	
		       document.form_nueva_venta.cantidad_31.value = 0;
		       document.form_nueva_venta.valor_total_31.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article31_ventas(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article31_ventas()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#ventas_loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article31_ventas()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#ventas_loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article31_ventas()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA VENTA 31 *********************/
    
   /******************************************** (( 11.12 )) *******************************************************/
  
  function ventas_keyup_cantidad()
  {
    //(11.12.32) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_1').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad        = document.getElementById("ventas_cantidad_1").value;
		var precio_unitario = document.getElementById("ventas_precio_1").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_1.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_1").value = 0;
			$("#ventas_cantidad_1").css("background-color","#F9BEBD");
			$("#ventas_precio_1").css("background-color","#F9BEBD");
			$("#ventas_valor_total_1").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_1").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_1").css("background-color","#FFF");
			$("#ventas_cantidad_1").css("background-color","#FFF");
			$("#ventas_precio_1").css("background-color","#FFF");
		}
	});   
			
    //(11.12.33) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_2').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_2").value;
		var precio_unitario = document.getElementById("ventas_precio_2").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_2.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_2").value = 0;
			$("#ventas_cantidad_2").css("background-color","#F9BEBD");
			$("#ventas_precio_2").css("background-color","#F9BEBD");
			$("#ventas_valor_total_2").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_2").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_2").css("background-color","#FFF");
			$("#ventas_cantidad_2").css("background-color","#FFF");
			$("#ventas_precio_2").css("background-color","#FFF");
		}
	});   
	  
    //(11.12.34) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_3').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_3").value;
		var precio_unitario = document.getElementById("ventas_precio_3").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_3.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_3").value = 0;
			$("#ventas_cantidad_3").css("background-color","#F9BEBD");
			$("#ventas_precio_3").css("background-color","#F9BEBD");
			$("#ventas_valor_total_3").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_3").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_3").css("background-color","#FFF");
			$("#ventas_cantidad_3").css("background-color","#FFF");
			$("#ventas_precio_3").css("background-color","#FFF");
		}
	}); 
			
    //(11.12.35) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_4').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_4").value;
		var precio_unitario = document.getElementById("ventas_precio_4").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_4.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_4").value = 0;
			$("#ventas_cantidad_4").css("background-color","#F9BEBD");
			$("#ventas_precio_4").css("background-color","#F9BEBD");
			$("#ventas_valor_total_4").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_4").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_4").css("background-color","#FFF");
			$("#ventas_cantidad_4").css("background-color","#FFF");
			$("#ventas_precio_4").css("background-color","#FFF");
		}
	}); 
      
	//(11.12.36) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_5').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_5").value;
		var precio_unitario = document.getElementById("ventas_precio_5").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_5.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_5").value = 0;
			$("#ventas_cantidad_5").css("background-color","#F9BEBD");
			$("#ventas_precio_5").css("background-color","#F9BEBD");
			$("#ventas_valor_total_5").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_5").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_5").css("background-color","#FFF");
			$("#ventas_cantidad_5").css("background-color","#FFF");
			$("#ventas_precio_5").css("background-color","#FFF");
		}
	}); 
    
    //(11.12.37) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_6').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_6").value;
		var precio_unitario = document.getElementById("ventas_precio_6").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_6.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("ventas_valor_total_6").value = 0;
			$("#ventas_cantidad_6").css("background-color","#F9BEBD");
			$("#ventas_precio_6").css("background-color","#F9BEBD");
			$("#ventas_valor_total_6").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_6").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_6").css("background-color","#FFF");
			$("#ventas_cantidad_6").css("background-color","#FFF");
			$("#ventas_precio_6").css("background-color","#FFF");
		}
	}); 
    
    //(11.12.38) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_7').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_7").value;
		var precio_unitario = document.getElementById("ventas_precio_7").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_7.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_7").value = 0;
			$("#ventas_cantidad_7").css("background-color","#F9BEBD");
			$("#ventas_precio_7").css("background-color","#F9BEBD");
			$("#ventas_valor_total_7").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_7").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_7").css("background-color","#FFF");
			$("#ventas_cantidad_7").css("background-color","#FFF");
			$("#ventas_precio_7").css("background-color","#FFF");
		}
	});
    
    //(11.12.39) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_8').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_8").value;
		var precio_unitario = document.getElementById("ventas_precio_8").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_8.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock de almacén.
			document.getElementById("ventas_valor_total_8").value = 0;
			$("#ventas_cantidad_8").css("background-color","#F9BEBD");
			$("#ventas_precio_8").css("background-color","#F9BEBD");
			$("#ventas_valor_total_8").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_8").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_8").css("background-color","#FFF");
			$("#ventas_cantidad_8").css("background-color","#FFF");
			$("#ventas_precio_8").css("background-color","#FFF");
		}
	});
  
    //(11.12.40) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_9').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_9").value;
		var precio_unitario = document.getElementById("ventas_precio_9").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_9.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock de almacén.
			document.getElementById("ventas_valor_total_9").value = 0;
			$("#ventas_cantidad_9").css("background-color","#F9BEBD");
			$("#ventas_precio_9").css("background-color","#F9BEBD");
			$("#ventas_valor_total_9").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_9").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_9").css("background-color","#FFF");
			$("#ventas_cantidad_9").css("background-color","#FFF");
			$("#ventas_precio_9").css("background-color","#FFF");
		}
	});
    
    //(11.12.41) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
   $('input#ventas_cantidad_10').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_10").value;
		var precio_unitario = document.getElementById("ventas_precio_10").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_10.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_10").value = 0;
			$("#ventas_cantidad_10").css("background-color","#F9BEBD");
			$("#ventas_precio_10").css("background-color","#F9BEBD");
			$("#ventas_valor_total_10").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_10").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_10").css("background-color","#FFF");
			$("#ventas_cantidad_10").css("background-color","#FFF");
			$("#ventas_precio_10").css("background-color","#FFF");
		}
	});
    
    //(11.12.42) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_11').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_11").value;
		var precio_unitario = document.getElementById("ventas_precio_11").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_11.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_11").value = 0;
			$("#ventas_cantidad_11").css("background-color","#F9BEBD");
			$("#ventas_precio_11").css("background-color","#F9BEBD");
			$("#ventas_valor_total_11").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_11").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_11").css("background-color","#FFF");
			$("#ventas_cantidad_11").css("background-color","#FFF");
			$("#ventas_precio_11").css("background-color","#FFF");
		}
	});
    
    //(11.12.43) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_12').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_12").value;
		var precio_unitario = document.getElementById("ventas_precio_12").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_12.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_12").value = 0;
			$("#ventas_cantidad_12").css("background-color","#F9BEBD");
			$("#ventas_precio_12").css("background-color","#F9BEBD");
			$("#ventas_valor_total_12").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_12").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_12").css("background-color","#FFF");
			$("#ventas_cantidad_12").css("background-color","#FFF");
			$("#ventas_precio_12").css("background-color","#FFF");
		}
	});
    
    //(11.12.44) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_13').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_13").value;
		var precio_unitario = document.getElementById("ventas_precio_13").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_13.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_13").value = 0;
			$("#ventas_cantidad_13").css("background-color","#F9BEBD");
			$("#ventas_precio_13").css("background-color","#F9BEBD");
			$("#ventas_valor_total_13").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_13").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_13").css("background-color","#FFF");
			$("#ventas_cantidad_13").css("background-color","#FFF");
			$("#ventas_precio_13").css("background-color","#FFF");
		}
	});
   
    //(11.12.45) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_14').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_14").value;
		var precio_unitario = document.getElementById("ventas_precio_14").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_14.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_14").value = 0;
			$("#ventas_cantidad_14").css("background-color","#F9BEBD");
			$("#ventas_precio_14").css("background-color","#F9BEBD");
			$("#ventas_valor_total_14").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_14").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_14").css("background-color","#FFF");
			$("#ventas_cantidad_14").css("background-color","#FFF");
			$("#ventas_precio_14").css("background-color","#FFF");
		}
	});
	  
    //(11.12.46) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_15').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_15").value;
		var precio_unitario = document.getElementById("ventas_precio_15").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_15.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_15").value = 0;
			$("#ventas_cantidad_15").css("background-color","#F9BEBD");
			$("#ventas_precio_15").css("background-color","#F9BEBD");
			$("#ventas_valor_total_15").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_15").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_15").css("background-color","#FFF");
			$("#ventas_cantidad_15").css("background-color","#FFF");
			$("#ventas_precio_15").css("background-color","#FFF");
		}
	});
  
    //(11.12.47) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_16').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_16").value;
		var precio_unitario = document.getElementById("ventas_precio_16").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_16.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_16").value = 0;
			$("#ventas_cantidad_16").css("background-color","#F9BEBD");
			$("#ventas_precio_16").css("background-color","#F9BEBD");
			$("#ventas_valor_total_16").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_16").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_16").css("background-color","#FFF");
			$("#ventas_cantidad_16").css("background-color","#FFF");
			$("#ventas_precio_16").css("background-color","#FFF");
		}
	});
    
    //(11.12.48) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_17').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_17").value;
		var precio_unitario = document.getElementById("ventas_precio_17").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_17.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock de almacén.
			document.getElementById("ventas_valor_total_17").value = 0;
			$("#ventas_cantidad_17").css("background-color","#F9BEBD");
			$("#ventas_precio_17").css("background-color","#F9BEBD");
			$("#ventas_valor_total_17").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_17").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_17").css("background-color","#FFF");
			$("#ventas_cantidad_17").css("background-color","#FFF");
			$("#ventas_precio_17").css("background-color","#FFF");
		}
	});
    
    //(11.12.49) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_18').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_18").value;
		var precio_unitario = document.getElementById("ventas_precio_18").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_18.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock de almacén.
			document.getElementById("ventas_valor_total_18").value = 0;
			$("#ventas_cantidad_18").css("background-color","#F9BEBD");
			$("#ventas_precio_18").css("background-color","#F9BEBD");
			$("#ventas_valor_total_18").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_18").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_18").css("background-color","#FFF");
			$("#ventas_cantidad_18").css("background-color","#FFF");
			$("#ventas_precio_18").css("background-color","#FFF");
		}
	});
    
    //(11.12.50) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_19').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_19").value;
		var precio_unitario = document.getElementById("ventas_precio_19").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_19.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_19").value = 0;
			$("#ventas_cantidad_19").css("background-color","#F9BEBD");
			$("#ventas_precio_19").css("background-color","#F9BEBD");
			$("#ventas_valor_total_19").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_19").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_19").css("background-color","#FFF");
			$("#ventas_cantidad_19").css("background-color","#FFF");
			$("#ventas_precio_19").css("background-color","#FFF");
		}
	});
    
    //(11.12.51) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_20').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_20").value;
		var precio_unitario = document.getElementById("ventas_precio_20").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_20.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock de almacén.
			document.getElementById("ventas_valor_total_20").value = 0;
			$("#ventas_cantidad_20").css("background-color","#F9BEBD");
			$("#ventas_precio_20").css("background-color","#F9BEBD");
			$("#ventas_valor_total_20").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_20").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_20").css("background-color","#FFF");
			$("#ventas_cantidad_20").css("background-color","#FFF");
			$("#ventas_precio_20").css("background-color","#FFF");
		}
	});
    
    //(11.12.52) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_21').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_21").value;
		var precio_unitario = document.getElementById("ventas_precio_21").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_21.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock de almacén.
			document.getElementById("ventas_valor_total_21").value = 0;
			$("#ventas_cantidad_21").css("background-color","#F9BEBD");
			$("#ventas_precio_21").css("background-color","#F9BEBD");
			$("#ventas_valor_total_21").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_21").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_21").css("background-color","#FFF");
			$("#ventas_cantidad_21").css("background-color","#FFF");
			$("#ventas_precio_21").css("background-color","#FFF");
		}
	});
    
    //(11.12.53) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_22').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_22").value;
		var precio_unitario = document.getElementById("ventas_precio_22").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_22.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_22").value = 0;
			$("#ventas_cantidad_22").css("background-color","#F9BEBD");
			$("#ventas_precio_22").css("background-color","#F9BEBD");
			$("#ventas_valor_total_22").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_22").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_22").css("background-color","#FFF");
			$("#ventas_cantidad_22").css("background-color","#FFF");
			$("#ventas_precio_22").css("background-color","#FFF");
		}
	});
    
    //(11.12.54) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_23').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_23").value;
		var precio_unitario = document.getElementById("ventas_precio_23").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_23.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_23").value = 0;
			$("#ventas_cantidad_23").css("background-color","#F9BEBD");
			$("#ventas_precio_23").css("background-color","#F9BEBD");
			$("#ventas_valor_total_23").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_23").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_23").css("background-color","#FFF");
			$("#ventas_cantidad_23").css("background-color","#FFF");
			$("#ventas_precio_23").css("background-color","#FFF");
		}
	});
    
    //(11.12.55) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_24').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_24").value;
		var precio_unitario = document.getElementById("ventas_precio_24").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_24.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_24").value = 0;
			$("#ventas_cantidad_24").css("background-color","#F9BEBD");
			$("#ventas_precio_24").css("background-color","#F9BEBD");
			$("#ventas_valor_total_24").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_24").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_24").css("background-color","#FFF");
			$("#ventas_cantidad_24").css("background-color","#FFF");
			$("#ventas_precio_24").css("background-color","#FFF");
		}
	});
    
    //(11.12.56) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_25').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_25").value;
		var precio_unitario = document.getElementById("ventas_precio_25").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_25.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_25").value = 0;
			$("#ventas_cantidad_25").css("background-color","#F9BEBD");
			$("#ventas_precio_25").css("background-color","#F9BEBD");
			$("#ventas_valor_total_25").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_25").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_25").css("background-color","#FFF");
			$("#ventas_cantidad_25").css("background-color","#FFF");
			$("#ventas_precio_25").css("background-color","#FFF");
		}
	});
    
    //(11.12.57) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_26').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_26").value;
		var precio_unitario = document.getElementById("ventas_precio_26").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_26.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor quye el stock del almacén.
			document.getElementById("ventas_valor_total_26").value = 0;
			$("#ventas_cantidad_26").css("background-color","#F9BEBD");
			$("#ventas_precio_26").css("background-color","#F9BEBD");
			$("#ventas_valor_total_26").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_26").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_26").css("background-color","#FFF");
			$("#ventas_cantidad_26").css("background-color","#FFF");
			$("#ventas_precio_26").css("background-color","#FFF");
		}
	});
    
    //(11.12.58) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_27').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_27").value;
		var precio_unitario = document.getElementById("ventas_precio_27").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_27.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que stock del almacén.
			document.getElementById("ventas_valor_total_27").value = 0;
			$("#ventas_cantidad_27").css("background-color","#F9BEBD");
			$("#ventas_precio_27").css("background-color","#F9BEBD");
			$("#ventas_valor_total_27").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_27").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_27").css("background-color","#FFF");
			$("#ventas_cantidad_27").css("background-color","#FFF");
			$("#ventas_precio_27").css("background-color","#FFF");
		}
	});
    
    //(11.12.59) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_28').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_28").value;
		var precio_unitario = document.getElementById("ventas_precio_28").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_28.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_28").value = 0;
			$("#ventas_cantidad_28").css("background-color","#F9BEBD");
			$("#ventas_precio_28").css("background-color","#F9BEBD");
			$("#ventas_valor_total_28").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_28").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_28").css("background-color","#FFF");
			$("#ventas_cantidad_28").css("background-color","#FFF");
			$("#ventas_precio_28").css("background-color","#FFF");
		}
	});
	  
    //(11.12.60) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_29').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_29").value;
		var precio_unitario = document.getElementById("ventas_precio_29").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_29.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_29").value = 0;
			$("#ventas_cantidad_29").css("background-color","#F9BEBD");
			$("#ventas_precio_29").css("background-color","#F9BEBD");
			$("#ventas_valor_total_29").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_29").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_29").css("background-color","#FFF");
			$("#ventas_cantidad_29").css("background-color","#FFF");
			$("#ventas_precio_29").css("background-color","#FFF");
		}
	});
      
    //(11.12.61) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_30').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_30").value;
		var precio_unitario = document.getElementById("ventas_precio_30").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_30.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);	
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_30").value = 0;
			$("#ventas_cantidad_30").css("background-color","#F9BEBD");
			$("#ventas_precio_30").css("background-color","#F9BEBD");
			$("#ventas_valor_total_30").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_30").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_30").css("background-color","#FFF");
			$("#ventas_cantidad_30").css("background-color","#FFF");
			$("#ventas_precio_30").css("background-color","#FFF");
		}
	});
    
    //(11.12.62) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#ventas_cantidad_31').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago_ventas(1);
		
		var cantidad       = document.getElementById("ventas_cantidad_31").value;
		var precio_unitario = document.getElementById("ventas_precio_31").value;
		var stock_almacen   = document.form_nueva_venta.stock_actual_almac_hidden_31.value;
		
		cantidad = parseFloat(cantidad);
		precio_unitario = parseFloat(precio_unitario);
		stock_almacen = parseFloat(stock_almacen);
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || precio_unitario == "" || precio_unitario == null || isNaN(precio_unitario) || precio_unitario == 0 || cantidad > stock_almacen )  {
		   // Verifico que la cantidad tiene un valor numeral y no sea mayor que el stock del almacén.
			document.getElementById("ventas_valor_total_31").value = 0;
			$("#ventas_cantidad_31").css("background-color","#F9BEBD");
			$("#ventas_precio_31").css("background-color","#F9BEBD");
			$("#ventas_valor_total_31").css("background-color","#F9BEBD");
		} else {
						     
			valor_total = cantidad*precio_unitario; 
					
			document.getElementById("ventas_valor_total_31").value = valor_total.toFixed(2);
 			$("#ventas_valor_total_31").css("background-color","#FFF");
			$("#ventas_cantidad_31").css("background-color","#FFF");
			$("#ventas_precio_31").css("background-color","#FFF");
		}
	});
  } // Fin de la función ventas_keyup_cantidad()
    
  /******************************************** (( 11.13 )) *******************************************************/
  
  /*(11.13.32)******************* INSTRUCCIONES JQUERY PARA BORRAR ALGUNA FILA DE LA NUEVA VENTA  *****************/
  
  function ventas_delete_filas()
  {
     //11.13.63 PARA BORRAR LA FILA 2 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_2').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_2').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	
	//11.13.64 PARA BORRAR LA FILA 3 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_3').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_3').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	
	//11.13.65 PARA BORRAR LA FILA 4 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_4').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_4').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	
	//11.13.66 PARA BORRAR LA FILA 5 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_5').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_5').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	
	//11.13.67 PARA BORRAR LA FILA 6 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_6').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_6').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	
	//11.13.68 PARA BORRAR LA FILA 7 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_7').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_7').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
		
	//11.13.69 PARA BORRAR LA FILA 8 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_8').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_8').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	
	//11.13.70 PARA BORRAR LA FILA 9 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_9').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_9').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
		
	//11.13.71 PARA BORRAR LA FILA 10 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_10').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_10').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	
	//11.13.72 PARA BORRAR LA FILA 11 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_11').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_11').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.73 PARA BORRAR LA FILA 12 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_12').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_12').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	    
	//11.13.74 PARA BORRAR LA FILA 13 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_13').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_13').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	   
	//11.13.75 PARA BORRAR LA FILA 14 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_14').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_14').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.76 PARA BORRAR LA FILA 15 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_15').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_15').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.77 PARA BORRAR LA FILA 16 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_16').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_16').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.78 PARA BORRAR LA FILA 17 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_17').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_17').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.79 PARA BORRAR LA FILA 18 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_18').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_18').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			

			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	
    //11.13.80 PARA BORRAR LA FILA 19 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_19').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_19').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	 
    //11.13.81 PARA BORRAR LA FILA 20 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_20').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_20').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.82 PARA BORRAR LA FILA 51 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_21').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_21').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	 
    //11.13.83 PARA BORRAR LA FILA 22 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_22').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_22').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	 
    //11.13.84 PARA BORRAR LA FILA 23 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_23').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_23').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	 
     //11.13.85 PARA BORRAR LA FILA 24 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_24').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_24').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.86 PARA BORRAR LA FILA 25 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_25').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_25').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.87 PARA BORRAR LA FILA 26 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_26').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_26').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.88 PARA BORRAR LA FILA 27 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_27').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_27').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
				
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.89 PARA BORRAR LA FILA 28 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_28').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_28').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
		 	});
		} else {
		   return false;	
		}
	});
	  
    //11.13.90 PARA BORRAR LA FILA 29 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_29').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_29').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.91 PARA BORRAR LA FILA 30 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_30').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_30').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
					
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	  
    //11.13.92 PARA BORRAR LA FILA 31 DE COMPRAS QUE QUIERO BORRAR.
	$('a#ventas_delete_31').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago_ventas(1);
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('ventas_valor_total_31').value; 
			var total = document.getElementById('total_ventas_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_ventas_valor').innerHTML = Resultado.toFixed(2);
						
			e.preventDefault();
			var parent = $(this).parent();
			$.ajax({
				type: 'get',
				url: 'index.php',
				data: 'ajax=1&delete=' + parent.attr('id').replace('record-',''),
				beforeSend: function() {
					parent.animate({'backgroundColor':'#fb6c6c'},300);
				},
				success: function() {
					parent.slideUp(300,function() {
						parent.remove();
					});
				}
			});
		} else {
		   return false;	
		}
	});
	 
  }  // Fin de la función ventas_delete_filas()
  
  
  /******************************************** (( 11.14 )) *******************************************************/
  
   //11.14.93 PARA SUMAR EL VALOR DE TODOS LOS ARTÍCULOS DE CADA FILA. 
  function show_valor_total_sumatoria_articulos_de_la_venta()
  {
	  // Función que se ejecuta al hacer un blur sobre el campo cantidad de artículos de cada compra.
      var SumatoriaValoresArticulos = 0;
	  var numero_elementos_venta = document.form_nueva_venta.elements.length;
	  
	   for ( var j=0; j < numero_elementos_venta; j++ ) 
	   {
	       var name = document.form_nueva_venta.elements[j].name;
		   
		   if ( name == "valor_total_1" || name == "valor_total_2" || name == "valor_total_3" || name == "valor_total_4" || name == "valor_total_5" || name == "valor_total_6" || name == "valor_total_7" || name == "valor_total_8" || name == "valor_total_9" || name == "valor_total_10" || name == "valor_total_11" || name == "valor_total_12" || name == "valor_total_13" || name == "valor_total_14" || name == "valor_total_15" || name == "valor_total_16" || name == "valor_total_17" || name == "valor_total_18" || name == "valor_total_19" || name == "valor_total_20" || name == "valor_total_21" || name == "valor_total_22" || name == "valor_total_23" || name == "valor_total_24"|| name == "valor_total_25" || name == "valor_total_26" || name == "valor_total_27" || name == "valor_total_28" || name == "valor_total_29" || name == "valor_total_30" || name == "valor_total_31" )	 {
		   	   
			   var Valor = document.form_nueva_venta.elements[j].value;
			   Valor = parseFloat(Valor);
			   SumatoriaValoresArticulos = SumatoriaValoresArticulos + Valor;
			   
		   } else {
			  continue;   
		   }
	   } 
	  
	   document.getElementById('total_ventas_valor').innerHTML = SumatoriaValoresArticulos.toFixed(2); 
	     
   } // Fin de la función show_valor_total_sumatoria_articulos_de_la_venta()
     
    /******************************************** (( 11.15 )) *******************************************************/
  
   //9.94 INICIALIZA TODOS LOS VALORES DEL "DETALLE DE PAGO" A '0' Y LOS ESCONDE 
  function hide_detalle_de_pago_ventas(TipoCaso)
  {
	  // Función que se ejecuta al hacer cualquier el DETALLE DE LA COMPRA.
	  // CASO 1: LO QUITO TODO Y LO INICIALIZO TODOS. 
	  if ( TipoCaso == 1 )  {
	       // Escondo el <div> id="detalle_pago" y muestro el <div> id="anadir_detalle_pago"
		  $('#anadir_detalle_pago_ventas').show();
		  $('#detalle_pago_ventas').hide();
		  		  
		  document.getElementById('input_no_factura_ventas').value = "";
	  
	  } else if ( TipoCaso == 2 ) {
	  // CASO 2: INICIALIZO LA SECCIÓN 3:DETALLE DE PAGO.
	      // NO HAGO NADA. TODO ESTÁ ABAJO
	  }
	       
	  //a) Escondo tdos los <div> de la sección 3: DETALLE DE PAGO. 
		$('#div_monto_a_pagar_real_ventas').hide();
		$('#div_pago_cliente_contado_ventas').hide();
		$('#div_vuelto_contado_ventas').hide();
		$('#div_anticipo_origen_pago_ventas').hide();
		$('#div_saldo_credito_ventas').hide();
		$('#div_cant_pagos_origen_pago_ventas').hide();
		$('#div_descripcion_cantidad_pago_ventas').hide();
		$('#guardar_nueva_venta').hide();
	  
	  //b) Reiniciar valores de todos los campos <text>, <radio>, <select> de la sección 3: DETALLE DE PAGO 				    
		document.getElementById('forma_pago_contado_ventas').checked = "";  
		document.getElementById('forma_pago_credito_ventas').checked = "";
		document.getElementById('input_monto_a_pagar_ventas').value = 0;
		document.getElementById('input_pago_cliente_contado').value = 0;
		document.getElementById('input_anticipo_forma_pago').value = 0;
		document.getElementById('saldo_dinero_ventas').value = 0;
		document.getElementById('cantidad_de_pagos_credito_ventas').value = 0;
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
		  
  }  // Fin de la función hide_detalle_de_pago()