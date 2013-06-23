    /****************************************************************************************************************
    
	(( 9.02 ))    - Funciones que cargan los datos de los artículos que quiero introducir en la nueva compra.
	
	01 function charge_article1()
	02 function charge_article2()
	.......
	.......
	31 function charge_article31()
	
	(( 9.03 ))    - Función que contiene todos los jQuery con las instrucciones a la hora poner la cantidad de artículos de la compra(31 instrucciones) y hace la sumatoria en la fila y en el valor total. 
	
	32-62  function keyup_cantidad();
	
	(( 9.04 ))    - Función que contiene todos los jQuery con la instrucciones a la hora de borrar una fila de la nueva compra (30 instrucciones). 
	
	63-92 function delete_filas()
	
	(( 9.05 ))  - Función que suman los contenidos de los artículos seleccionados y se obtiene el valor total.
	
	93 function show_valor_total()
	
	(( 9.06 ))  - Función que se ejecuta al hacer cualquier el DETALLE DE LA COMPRA para esconder todo lo de DETALLE DE PAGO.
   
    94 function hide_detalle_de_pago()
  
  	*****************************************************************************************************************/
 
    /******************************************** (( 9.02 )) *******************************************************/

   /****PRIMERA PETICIÓN AJAX ****/
   /*(9.01)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 1 *****************/
  
  function charge_article1()
  {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_1').change(function(){
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_1.value;
	     //(02) Tengo el id del Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
	 	 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article1,   
			 beforeSend:  inicio_envio_article1,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article1, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article1,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  
	  });
	 
  }  // Fin de la función charge_article1   
	    
	  function charge_data_article1(data)
	  {
           // Función que muestra los datos del artículo seleccionado en los input correspondientes.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   
		   	   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_1').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   		   
			   // Inicializó todos los campos de esa fila a 0
			   document.form_nueva_compra.descripcion_art_1.value = "";
			   document.form_nueva_compra.codigo_1.value = "";
			   document.getElementById('unidad_medida_1').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_1.value = 0;
		       document.form_nueva_compra.cantidad_1.value = 0;
		       document.form_nueva_compra.valor_total_1.value = 0;
		   } else {  
		   
		       document.form_nueva_compra.codigo_1.value = data.codigo_art; 
		       document.getElementById('unidad_medida_1').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_1.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_1.value = 0;
		       document.form_nueva_compra.valor_total_1.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article1(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article1()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article1()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article1()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
	
	/***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 1*********************/
	   
   /****SEGUNDA PETICIÓN AJAX ****/
   /*(9.02)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article2()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_2').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_2.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();	 		 
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article2,   
			 beforeSend:  inicio_envio_article2,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article2, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article2,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article()
      
      function charge_data_article2(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   		   
		   	   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_2').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;  //Pongo el resultado en VALOR TOTAL(html)
			   // Inicializo los campos a 0.
			   document.form_nueva_compra.descripcion_art_2.value = "";
			   document.form_nueva_compra.codigo_2.value = "";
			   document.getElementById('unidad_medida_2').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_2.value = 0;
		       document.form_nueva_compra.cantidad_2.value = 0;
		       document.form_nueva_compra.valor_total_2.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_2.value = data.codigo_art; 
		       document.getElementById('unidad_medida_2').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_2.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_2.value = 0;
		       document.form_nueva_compra.valor_total_2.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article2()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article2()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article2()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 2*********************/
	 
   /****TERCERA PETICIÓN AJAX ****/
   /*(9.03)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article3()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_3').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_3.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article3,   
			 beforeSend:  inicio_envio_article3,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article3, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article3,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article()
      
      function charge_data_article3(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_3').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
			   document.form_nueva_compra.descripcion_art_3.value = "";
			   document.form_nueva_compra.codigo_3.value = "";
			   document.getElementById('unidad_medida_3').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_3.value = 0;
		       document.form_nueva_compra.cantidad_3.value = 0;
		       document.form_nueva_compra.valor_total_3.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_3.value = data.codigo_art; 
		       document.getElementById('unidad_medida_3').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_3.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_3.value = 0;
		       document.form_nueva_compra.valor_total_3.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article3()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article3()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article3()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 3*********************/ 
      
  /****CUARTA PETICIÓN AJAX ****/
   /*(9.04)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article4()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_4').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_4.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article4,   
			 beforeSend:  inicio_envio_article4,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article4, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article4,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article4()
     
      function charge_data_article4(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_4').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_4.value = "";
			   document.form_nueva_compra.codigo_4.value = "";
			   document.getElementById('unidad_medida_4').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_4.value = 0;
		       document.form_nueva_compra.cantidad_4.value = 0;
		       document.form_nueva_compra.valor_total_4.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_4.value = data.codigo_art; 
		       document.getElementById('unidad_medida_4').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_4.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_4.value = 0;
		       document.form_nueva_compra.valor_total_4.value = 0;
	       }
	  }   // Fin de la función charge_data_article4(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article4()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article4()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article4()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 4*********************/ 
    
   /****QUINTA PETICIÓN AJAX ****/
   /*(9.05)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article5()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_5').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_5.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article5,   
			 beforeSend:  inicio_envio_article5,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article5, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article5,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article5()
     
      function charge_data_article5(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_5').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			    // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_5.value = "";
			   document.form_nueva_compra.codigo_5.value = "";
			   document.getElementById('unidad_medida_5').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_5.value = 0;
		       document.form_nueva_compra.cantidad_5.value = 0;
		       document.form_nueva_compra.valor_total_5.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_5.value = data.codigo_art; 
		       document.getElementById('unidad_medida_5').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_5.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_5.value = 0;
		       document.form_nueva_compra.valor_total_5.value = 0;
	       }
	  }   // Fin de la función charge_data_article5(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article5()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article5()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article5()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
     
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 5*********************/ 
    
   /****SEXTA PETICIÓN AJAX ****/
   /*(9.06)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article6()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_6').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_6.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article6,   
			 beforeSend:  inicio_envio_article6,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article6, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article6,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article6()
     
      function charge_data_article6(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_6').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_6.value = "";
			   document.form_nueva_compra.codigo_6.value = "";
			   document.getElementById('unidad_medida_6').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_6.value = 0;
		       document.form_nueva_compra.cantidad_6.value = 0;
		       document.form_nueva_compra.valor_total_6.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_6.value = data.codigo_art; 
		       document.getElementById('unidad_medida_6').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_6.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_6.value = 0;
		       document.form_nueva_compra.valor_total_6.value = 0;
	       }
	  }   // Fin de la función charge_data_article6(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article6()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article6()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article6()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
     
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 6*********************/ 
    
  /****SÉPTIMA PETICIÓN AJAX ****/
   /*(9.07)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article7()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_7').change(function(){
	 	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_7.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article7,   
			 beforeSend:  inicio_envio_article7,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article7, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article7,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article7()
     
      function charge_data_article7(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_7').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_7.value = "";
			   document.form_nueva_compra.codigo_7.value = "";
			   document.getElementById('unidad_medida_7').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_7.value = 0;
		       document.form_nueva_compra.cantidad_7.value = 0;
		       document.form_nueva_compra.valor_total_7.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_7.value = data.codigo_art; 
		       document.getElementById('unidad_medida_7').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_7.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_7.value = 0;
		       document.form_nueva_compra.valor_total_7.value = 0;
	       }
	  }   // Fin de la función charge_data_article7(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article7()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article7()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article7()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 7*********************/ 
   
  /****OCTAVA PETICIÓN AJAX ****/
   /*(9.08)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article8()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_8').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_8.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article8,   
			 beforeSend:  inicio_envio_article8,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article8, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article8,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article8()
     
      function charge_data_article8(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_8').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_8.value = "";
			   document.form_nueva_compra.codigo_8.value = "";
			   document.getElementById('unidad_medida_8').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_8.value = 0;
		       document.form_nueva_compra.cantidad_8.value = 0;
		       document.form_nueva_compra.valor_total_8.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_8.value = data.codigo_art; 
		       document.getElementById('unidad_medida_8').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_8.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_8.value = 0;
		       document.form_nueva_compra.valor_total_8.value = 0;
	       }
	  }   // Fin de la función charge_data_article8(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article8()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article8()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article8()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 8*********************/ 
   
  /****NOVENA PETICIÓN AJAX ****/
   /*(9.09)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article9()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_9').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_9.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article9,   
			 beforeSend:  inicio_envio_article9,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article9, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article9,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article9()
     
      function charge_data_article9(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_9').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_9.value = "";
			   document.form_nueva_compra.codigo_9.value = "";
			   document.getElementById('unidad_medida_9').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_9.value = 0;
		       document.form_nueva_compra.cantidad_9.value = 0;
		       document.form_nueva_compra.valor_total_9.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_9.value = data.codigo_art; 
		       document.getElementById('unidad_medida_9').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_9.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_9.value = 0;
		       document.form_nueva_compra.valor_total_9.value = 0;
	       }
	  }   // Fin de la función charge_data_article5(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article9()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article9()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article9()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
     
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 9*********************/ 
   
  /****DÉCIMA PETICIÓN AJAX ****/
   /*(9.10)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article10()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_10').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_10.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article10,   
			 beforeSend:  inicio_envio_article10,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article10, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article10,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article10()
     
      function charge_data_article10(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_10').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_10.value = "";
			   document.form_nueva_compra.codigo_10.value = "";
			   document.getElementById('unidad_medida_10').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_10.value = 0;
		       document.form_nueva_compra.cantidad_10.value = 0;
		       document.form_nueva_compra.valor_total_10.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_10.value = data.codigo_art; 
		       document.getElementById('unidad_medida_10').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_10.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_10.value = 0;
		       document.form_nueva_compra.valor_total_10.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article10(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article10()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article10()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article10()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 10*********************/ 
    
  /****ONCENA PETICIÓN AJAX ****/
   /*(9.11)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article11()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_11').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_11.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article11,   
			 beforeSend:  inicio_envio_article11,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article11, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article11,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article11()
     
      function charge_data_article11(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_11').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_11.value = "";
			   document.form_nueva_compra.codigo_11.value = "";
			   document.getElementById('unidad_medida_11').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_11.value = 0;
		       document.form_nueva_compra.cantidad_11.value = 0;
		       document.form_nueva_compra.valor_total_11.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_11.value = data.codigo_art; 
		       document.getElementById('unidad_medida_11').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_11.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_11.value = 0;
		       document.form_nueva_compra.valor_total_11.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article11(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article11()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article11()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article11()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 11*********************/ 
    
  /****DUODÉCIMA PETICIÓN AJAX ****/
   /*(9.12)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article12()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_12').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_12.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article12,   
			 beforeSend:  inicio_envio_article12,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article12, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article12,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article12()
     
      function charge_data_article12(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_12').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_12.value = "";
			   document.form_nueva_compra.codigo_12.value = "";
			   document.getElementById('unidad_medida_12').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_12.value = 0;
		       document.form_nueva_compra.cantidad_12.value = 0;
		       document.form_nueva_compra.valor_total_12.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_12.value = data.codigo_art; 
		       document.getElementById('unidad_medida_12').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_12.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_12.value = 0;
		       document.form_nueva_compra.valor_total_12.value = 0;
	       }
	  }   // Fin de la función charge_data_article12(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article12()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article12()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article12()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
   
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 12*********************/
   
  /****TRIGÉSIMA PETICIÓN AJAX ****/
   /*(9.13)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article13()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_13').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_13.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article13,   
			 beforeSend:  inicio_envio_article13,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article13, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article13,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article13()
     
      function charge_data_article13(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_13').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_13.value = "";
			   document.form_nueva_compra.codigo_13.value = "";
			   document.getElementById('unidad_medida_13').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_13.value = 0;
		       document.form_nueva_compra.cantidad_13.value = 0;
		       document.form_nueva_compra.valor_total_13.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_13.value = data.codigo_art; 
		       document.getElementById('unidad_medida_13').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_13.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_13.value = 0;
		       document.form_nueva_compra.valor_total_13.value = 0;
	       }
	  }   // Fin de la función charge_data_article13(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article13()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article13()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article13()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
     
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 13*********************/  
  
  /****DÉCIMO CUARTA PETICIÓN AJAX ****/
   /*(9.14)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article14()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_14').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_14.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article14,   
			 beforeSend:  inicio_envio_article14,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article14, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article14,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article14()
     
      function charge_data_article14(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_14').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_14.value = "";
			   document.form_nueva_compra.codigo_14.value = "";
			   document.getElementById('unidad_medida_14').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_14.value = 0;
		       document.form_nueva_compra.cantidad_14.value = 0;
		       document.form_nueva_compra.valor_total_14.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_14.value = data.codigo_art; 
		       document.getElementById('unidad_medida_14').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_14.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_14.value = 0;
		       document.form_nueva_compra.valor_total_14.value = 0;
	       }
	  }   // Fin de la función charge_data_article14(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article14()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article14()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article14()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 14*********************/ 
   
  /****DÉCIMO QUINTA PETICIÓN AJAX ****/
   /*(9.15)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article15()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_15').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_15.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article15,   
			 beforeSend:  inicio_envio_article15,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article15, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article15,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article15()
      
      function charge_data_article15(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_15').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_15.value = "";
			   document.form_nueva_compra.codigo_15.value = "";
			   document.getElementById('unidad_medida_15').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_15.value = 0;
		       document.form_nueva_compra.cantidad_15.value = 0;
		       document.form_nueva_compra.valor_total_15.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_15.value = data.codigo_art; 
		       document.getElementById('unidad_medida_15').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_15.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_15.value = 0;
		       document.form_nueva_compra.valor_total_15.value = 0;
	       }
	  }   // Fin de la función charge_data_article15(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article15()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article15()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article15()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 15*********************/ 
   
  /****DÉCIMO SEXTA PETICIÓN AJAX ****/
   /*(9.16)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article16()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_16').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_16.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article16,   
			 beforeSend:  inicio_envio_article16,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article16, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article16,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article16()
     
      function charge_data_article16(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_16').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_16.value = "";
			   document.form_nueva_compra.codigo_16.value = "";
			   document.getElementById('unidad_medida_16').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_16.value = 0;
		       document.form_nueva_compra.cantidad_16.value = 0;
		       document.form_nueva_compra.valor_total_16.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_16.value = data.codigo_art; 
		       document.getElementById('unidad_medida_16').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_16.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_16.value = 0;
		       document.form_nueva_compra.valor_total_16.value = 0;
	       }
	  }   // Fin de la función charge_data_article16(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article16()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article16()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article16()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
     
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 16*********************/ 
   
  /****DÉCIMO SÉPTIMA PETICIÓN AJAX ****/
   /*(9.17)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article17()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_17').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_17.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article17,   
			 beforeSend:  inicio_envio_article17,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article17, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article17,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article17()
      
      function charge_data_article17(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_17').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_17.value = "";
			   document.form_nueva_compra.codigo_17.value = "";
			   document.getElementById('unidad_medida_17').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_17.value = 0;
		       document.form_nueva_compra.cantidad_17.value = 0;
		       document.form_nueva_compra.valor_total_17.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_17.value = data.codigo_art; 
		       document.getElementById('unidad_medida_17').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_17.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_17.value = 0;
		       document.form_nueva_compra.valor_total_17.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article17(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article17()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article17()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article17()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
     
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 17*********************/ 
   
  /****DÉCIMO OCTAVA PETICIÓN AJAX ****/
   /*(9.18)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article18()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_18').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_18.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article18,   
			 beforeSend:  inicio_envio_article18,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article18, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article18,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article18()
     
      function charge_data_article18(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_18').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_18.value = "";
			   document.form_nueva_compra.codigo_18.value = "";
			   document.getElementById('unidad_medida_18').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_18.value = 0;
		       document.form_nueva_compra.cantidad_18.value = 0;
		       document.form_nueva_compra.valor_total_18.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_18.value = data.codigo_art; 
		       document.getElementById('unidad_medida_18').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_18.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_18.value = 0;
		       document.form_nueva_compra.valor_total_18.value = 0;
	       }
	  }   // Fin de la función charge_data_article18(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article18()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article18()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article18()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 18*********************/ 
   
  /****DÉCIMO NOVENA PETICIÓN AJAX ****/
   /*(9.19)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article19()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_19').change(function(){
	     
		 //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_19.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article19,   
			 beforeSend:  inicio_envio_article19,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article19, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article19,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article19()
     
      function charge_data_article19(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_19').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_19.value = "";
			   document.form_nueva_compra.codigo_19.value = "";
			   document.getElementById('unidad_medida_19').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_19.value = 0;
		       document.form_nueva_compra.cantidad_19.value = 0;
		       document.form_nueva_compra.valor_total_19.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_19.value = data.codigo_art; 
		       document.getElementById('unidad_medida_19').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_19.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_19.value = 0;
		       document.form_nueva_compra.valor_total_19.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article19(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article19()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article19()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article19()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 19*********************/ 
   
  /****VIGÉSIMA PETICIÓN AJAX ****/
   /*(9.20)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article20()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_20').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_20.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article20,   
			 beforeSend:  inicio_envio_article20,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article20, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article20,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article20()
     
      function charge_data_article20(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_20').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_20.value = "";
			   document.form_nueva_compra.codigo_20.value = "";
			   document.getElementById('unidad_medida_20').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_20.value = 0;
		       document.form_nueva_compra.cantidad_20.value = 0;
		       document.form_nueva_compra.valor_total_20.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_20.value = data.codigo_art; 
		       document.getElementById('unidad_medida_20').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_20.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_20.value = 0;
		       document.form_nueva_compra.valor_total_20.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article20(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article20()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article20()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article20()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 20*********************/ 
    
  /****VIGÉSIMO PRIMERA PETICIÓN AJAX ****/
   /*(9.21)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article21()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_21').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_21.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article21,   
			 beforeSend:  inicio_envio_article21,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article21, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article21,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article21()
     
      function charge_data_article21(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_21').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_21.value = "";
			   document.form_nueva_compra.codigo_21.value = "";
			   document.getElementById('unidad_medida_21').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_21.value = 0;
		       document.form_nueva_compra.cantidad_21.value = 0;
		       document.form_nueva_compra.valor_total_21.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_21.value = data.codigo_art; 
		       document.getElementById('unidad_medida_21').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_21.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_21.value = 0;
		       document.form_nueva_compra.valor_total_21.value = 0;
	       }
	  }   // Fin de la función charge_data_article21(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article21()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article21()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article21()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 21*********************/
   
  /****VIGÉSIMA SEGUNDA PETICIÓN AJAX ****/
   /*(9.22)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article22()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_22').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_22.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article22,   
			 beforeSend:  inicio_envio_article22,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article22, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article22,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article22()
     
      function charge_data_article22(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_22').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_22.value = "";
			   document.form_nueva_compra.codigo_22.value = "";
			   document.getElementById('unidad_medida_22').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_22.value = 0;
		       document.form_nueva_compra.cantidad_22.value = 0;
		       document.form_nueva_compra.valor_total_22.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_22.value = data.codigo_art; 
		       document.getElementById('unidad_medida_22').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_22.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_22.value = 0;
		       document.form_nueva_compra.valor_total_22.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article22(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article22()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article22()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article22()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 22*********************/  
   
  /****VIGÉSIMO TERCERA PETICIÓN AJAX ****/
   /*(9.23)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article23()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_23').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_23.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article23,   
			 beforeSend:  inicio_envio_article23,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article23, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article23,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article23()
     
      function charge_data_article23(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_23').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_23.value = "";
			   document.form_nueva_compra.codigo_23.value = "";
			   document.getElementById('unidad_medida_23').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_23.value = 0;
		       document.form_nueva_compra.cantidad_23.value = 0;
		       document.form_nueva_compra.valor_total_23.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_23.value = data.codigo_art; 
		       document.getElementById('unidad_medida_23').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_23.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_23.value = 0;
		       document.form_nueva_compra.valor_total_23.value = 0;
	       }
	  }   // Fin de la función charge_data_article23(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article23()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article23()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article23()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /**************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 23*********************/ 
   
  /****VIGÉSIMO CUARTA PETICIÓN AJAX ****/
   /*(9.24)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article24()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_24').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_24.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article24,   
			 beforeSend:  inicio_envio_article24,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article24, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article24,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article24()
      
      function charge_data_article24(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_24').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_24.value = "";
			   document.form_nueva_compra.codigo_24.value = "";
			   document.getElementById('unidad_medida_24').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_24.value = 0;
		       document.form_nueva_compra.cantidad_24.value = 0;
		       document.form_nueva_compra.valor_total_24.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_24.value = data.codigo_art; 
		       document.getElementById('unidad_medida_24').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_24.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_24.value = 0;
		       document.form_nueva_compra.valor_total_24.value = 0;
	       }
	  }   // Fin de la función charge_data_article24(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article24()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article24()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article24()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 24*********************/ 
   
  /****VEGÉSIMO QUINTA PETICIÓN AJAX ****/
   /*(9.25)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article25()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_25').change(function(){
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_25.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article25,   
			 beforeSend:  inicio_envio_article25,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article25, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article25,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article25()
      
      function charge_data_article25(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_25').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_25.value = "";
			   document.form_nueva_compra.codigo_25.value = "";
			   document.getElementById('unidad_medida_25').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_25.value = 0;
		       document.form_nueva_compra.cantidad_25.value = 0;
		       document.form_nueva_compra.valor_total_25.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_25.value = data.codigo_art; 
		       document.getElementById('unidad_medida_25').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_25.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_25.value = 0;
		       document.form_nueva_compra.valor_total_25.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article25(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article25()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article25()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article25()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /**************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 25*********************/ 
   
  /****VIGÉSIMA SEXTA PETICIÓN AJAX ****/
   /*(9.26)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article26()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_26').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_26.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article26,   
			 beforeSend:  inicio_envio_article26,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article26, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article26,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article26()
     
      function charge_data_article26(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_26').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_26.value = "";
			   document.form_nueva_compra.codigo_26.value = "";
			   document.getElementById('unidad_medida_26').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_26.value = 0;
		       document.form_nueva_compra.cantidad_26.value = 0;
		       document.form_nueva_compra.valor_total_26.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_26.value = data.codigo_art; 
		       document.getElementById('unidad_medida_26').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_26.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_26.value = 0;
		       document.form_nueva_compra.valor_total_26.value = 0;
	  	   }
	  }   // Fin de la función charge_data_article26(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article26()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article26()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article26()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
     
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 26*********************/ 
   
  /****VIGÉSIMO SEPTIMA PETICIÓN AJAX ****/
   /*(9.27)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article27()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_27').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_27.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article27,   
			 beforeSend:  inicio_envio_article27,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article27, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article27,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article27()
     
      function charge_data_article27(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_27').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_27.value = "";
			   document.form_nueva_compra.codigo_27.value = "";
			   document.getElementById('unidad_medida_27').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_27.value = 0;
		       document.form_nueva_compra.cantidad_27.value = 0;
		       document.form_nueva_compra.valor_total_27.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_27.value = data.codigo_art; 
		       document.getElementById('unidad_medida_27').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_27.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_27.value = 0;
		       document.form_nueva_compra.valor_total_27.value = 0;
	       }
	  }   // Fin de la función charge_data_article27(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article27()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article27()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article27()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
     
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 27*********************/ 
   
  /****VIGÉSIMO OCTAVA PETICIÓN AJAX ****/
   /*(9.28)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article28()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_28').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_28.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article28,   
			 beforeSend:  inicio_envio_article28,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article28, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article28,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article28()
     
      function charge_data_article28(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_28').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_28.value = "";
			   document.form_nueva_compra.codigo_28.value = "";
			   document.getElementById('unidad_medida_28').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_28.value = 0;
		       document.form_nueva_compra.cantidad_28.value = 0;
		       document.form_nueva_compra.valor_total_28.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_28.value = data.codigo_art; 
		       document.getElementById('unidad_medida_28').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_28.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_28.value = 0;
		       document.form_nueva_compra.valor_total_28.value = 0;
	       }
	  }   // Fin de la función charge_data_article28(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article28()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article28()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article28()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 28*********************/ 
    
  /****VIGÉSIMO NOVENA PETICIÓN AJAX ****/
   /*(9.29)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article29()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_29').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_29.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article29,   
			 beforeSend:  inicio_envio_article29,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article29, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article29,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article29()
     
      function charge_data_article29(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_29').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_29.value = "";
			   document.form_nueva_compra.codigo_29.value = "";
			   document.getElementById('unidad_medida_29').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_29.value = 0;
		       document.form_nueva_compra.cantidad_29.value = 0;
		       document.form_nueva_compra.valor_total_29.value = 0;
		   } else {  
		   
		       document.form_nueva_compra.codigo_29.value = data.codigo_art; 
		       document.getElementById('unidad_medida_29').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_29.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_29.value = 0;
		       document.form_nueva_compra.valor_total_29.value = 0;
	       }
	  }  // Fin de la función charge_data_article29(data)
	 	
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article29()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article29()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article29()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
    
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 29*********************/ 
    
  /****TRIGÉSIMA PETICIÓN AJAX ****/
   /*(9.30)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article30()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_30').change(function(){
	 
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_30.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article30,   
			 beforeSend:  inicio_envio_article30,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article30, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article30,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article30()
     
      function charge_data_article30(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_30').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_30.value = "";
			   document.form_nueva_compra.codigo_30.value = "";
			   document.getElementById('unidad_medida_30').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_30.value = 0;
		       document.form_nueva_compra.cantidad_30.value = 0;
		       document.form_nueva_compra.valor_total_30.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_30.value = data.codigo_art; 
		       document.getElementById('unidad_medida_30').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_30.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_30.value = 0;
		       document.form_nueva_compra.valor_total_30.value = 0;
	       }
	  }   // Fin de la función charge_data_article30(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article30()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article30()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article30()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
      
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 30*********************/ 
    
  /****TRIGÉSIMO PRIMERA PETICIÓN AJAX ****/
   /*(9.31)******************* PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA  *****************/
   function charge_article31()
   {
	  //(0n) SELECCIONO EL ARTÍCULO y al salir de ahí me busca por ajax la los datos de ese artículo que voy a cargar.
	  $('#descripcion_art_31').change(function(){
	  
	     //(01) Tengo el id del artículo al cual le voy a buscar los datos del <select>.
		 var id_articulo = document.form_nueva_compra.descripcion_art_31.value;
	     //(02) Tengo el Proveedor del artículo seleccionado
		 var proveedor = document.form_nueva_compra.id_proveedor_compra.value;
		 //(03) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		 hide_detalle_de_pago();
		 //(04) Aquí pongo el código de la llamada ajax     --> //alert(id_edit); <--
	      $.ajax({
			 type:        'GET',         // Tipo de petición que se realiza.
			 dataType:    'json',        // Tipo de dato que se espera como respuesta.
			 url:         'ajax/search_articulo_data.php?id_articulo=' + id_articulo + '&proveedor=' + proveedor,  
			 async:       true,          
			 success:     charge_data_article31,   
			 beforeSend:  inicio_envio_article31,  // Función que se llama al realizar la petición.
			 complete:    stop_cargando_article31, // Función que se ejecuta cuando la petición se ha completado.
		     error:       show_error_message_article31,  // Función que se ejecuta cuando hay un error en la petición.  
		     timeout:     4000,    //Tiempo máx que la petición espera la respuesta del servidor antes de anularla (mseg)
		  }); 
	  });
   }   // Fin de la función charge_article31()
      
      function charge_data_article31(data)
	  {
           // Función que muestra el stock actual de una artículo en la TABLA seleccionada.	  
 	       data = eval(data);  
	       //01 Me muestra los datos del artículo, de la respuesta en json de la peticion ajax a search_articulo_data.php
	       if ( data.codigo_art == "noitisnt" )  {
			   
			   alert('Error. Es posible que el art\xEDculo no pertenezca al proveedor seleccionado. Por favor chequee el art\xEDculo.GRACIAS');
			   // Resto del valor total que tengo en la parte superior al valor que tengo en esta fila.
			   var resta = document.getElementById('valor_total_31').value; 
			   var total = document.getElementById('total_compras_valor').innerHTML;
			
			   var Resta = parseFloat(resta);
			   var Total = parseFloat(total);
			
			   var Resultado = Total - Resta; 
			   document.getElementById('total_compras_valor').innerHTML = Resultado;
			   // Inicializo los campos a 0.
		   	   document.form_nueva_compra.descripcion_art_31.value = "";
			   document.form_nueva_compra.codigo_31.value = "";
			   document.getElementById('unidad_medida_31').innerHTML = "unidad medida";
			   document.form_nueva_compra.costo_31.value = 0;
		       document.form_nueva_compra.cantidad_31.value = 0;
		       document.form_nueva_compra.valor_total_31.value = 0;
		   } else {  
		       document.form_nueva_compra.codigo_31.value = data.codigo_art; 
		       document.getElementById('unidad_medida_31').innerHTML = data.unidad_medida;
		       document.form_nueva_compra.costo_31.value = data.precio_costo_art; 
	           document.form_nueva_compra.cantidad_31.value = 0;
		       document.form_nueva_compra.valor_total_31.value = 0;
	       }
	  }   // Fin de la función charge_data_article31(data)
	 
	  // Funciones para esta petición AJAX ( Sólo falta show_campos_local que está en sytem_function.js )
	  function inicio_envio_article31()  // Al iniciar la petición pone el .gif de cargando.
      {
	     $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
	  }
     
	  function stop_cargando_article31()   // Al completarse la petición pone display:none para quitar el cargando. 
      {
	     $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
	  }
	  
	  function show_error_message_article31()  // Función que se ejecuta cuando hay un error en la petición.
	  {
	     alert('ERROR.Intente nuevamente');
         return(false);
	  }
     
  /***************** FIN DE LA PETICIÓN AJAX PARA CARGAR LOS DATOS DEL ARTÍCULO SELECCIONADO EN LA COMPRA 31*********************/ 
   
   /******************************************** (( 9.03 )) *******************************************************/
  
  function keyup_cantidad()
  {
  
   //(9.32) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_1').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
		
		var cantidad       = document.getElementById("cantidad_1").value;
		var costo_unitario = document.getElementById("costo_1").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_1").value = 0;
			$("#cantidad_1").css("background-color","#F9BEBD");
			$("#costo_1").css("background-color","#F9BEBD");
			$("#valor_total_1").css("background-color","#F9BEBD");
		} else {
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_1").value = valor_total.toFixed(2);
 			$("#valor_total_1").css("background-color","#FFF");
			$("#cantidad_1").css("background-color","#FFF");
			$("#costo_1").css("background-color","#FFF");
		}
	});   
			
    //(9.33) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_2').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
		
		var cantidad       = document.getElementById("cantidad_2").value;
		var costo_unitario = document.getElementById("costo_2").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_2").value = 0;
			$("#cantidad_2").css("background-color","#F9BEBD");
			$("#costo_2").css("background-color","#F9BEBD");
			$("#valor_total_2").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_2").value = valor_total.toFixed(2);
 			$("#valor_total_2").css("background-color","#FFF");
			$("#cantidad_2").css("background-color","#FFF");
			$("#costo_2").css("background-color","#FFF");
		}
	});   
	 
    //(9.34) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_3').keyup(function(){ 
				 
		var cantidad       = document.getElementById("cantidad_3").value;
		var costo_unitario = document.getElementById("costo_3").value;
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_3").value = 0;
			$("#cantidad_3").css("background-color","#F9BEBD");
			$("#costo_3").css("background-color","#F9BEBD");
			$("#valor_total_3").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_3").value = valor_total.toFixed(2);
 			$("#valor_total_3").css("background-color","#FFF");
			$("#cantidad_3").css("background-color","#FFF");
			$("#costo_3").css("background-color","#FFF");
		}
	});   
			
    //(9.35) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_4').keyup(function(){ 
	
	    //(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_4").value;
		var costo_unitario = document.getElementById("costo_4").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_4").value = 0;
			$("#cantidad_4").css("background-color","#F9BEBD");
			$("#costo_4").css("background-color","#F9BEBD");
			$("#valor_total_4").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_4").value = valor_total.toFixed(2);
 			$("#valor_total_4").css("background-color","#FFF");
			$("#cantidad_4").css("background-color","#FFF");
			$("#costo_4").css("background-color","#FFF");
		}
	});
      
	//(9.36) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_5').keyup(function(){ 
				 
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
		
		var cantidad       = document.getElementById("cantidad_5").value;
		var costo_unitario = document.getElementById("costo_5").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_5").value = 0;
			$("#cantidad_5").css("background-color","#F9BEBD");
			$("#costo_5").css("background-color","#F9BEBD");
			$("#valor_total_5").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_5").value = valor_total.toFixed(2);
 			$("#valor_total_5").css("background-color","#FFF");
			$("#cantidad_5").css("background-color","#FFF");
			$("#costo_5").css("background-color","#FFF");
		}
	});
    
    //(9.37) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_6').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_6").value;
		var costo_unitario = document.getElementById("costo_6").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_6").value = 0;
			$("#cantidad_6").css("background-color","#F9BEBD");
			$("#costo_6").css("background-color","#F9BEBD");
			$("#valor_total_6").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_6").value = valor_total.toFixed(2);
 			$("#valor_total_6").css("background-color","#FFF");
			$("#cantidad_6").css("background-color","#FFF");
			$("#costo_6").css("background-color","#FFF");
		}
	});
    
    //(9.38) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_7').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_7").value;
		var costo_unitario = document.getElementById("costo_7").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_7").value = 0;
			$("#cantidad_7").css("background-color","#F9BEBD");
			$("#costo_7").css("background-color","#F9BEBD");
			$("#valor_total_7").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_7").value = valor_total.toFixed(2);
 			$("#valor_total_7").css("background-color","#FFF");
			$("#cantidad_7").css("background-color","#FFF");
			$("#costo_7").css("background-color","#FFF");
		}
	});
   
    //(9.39) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_8').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_8").value;
		var costo_unitario = document.getElementById("costo_8").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_8").value = 0;
			$("#cantidad_8").css("background-color","#F9BEBD");
			$("#costo_8").css("background-color","#F9BEBD");
			$("#valor_total_8").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
			
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_8").value = valor_total.toFixed(2);
 			$("#valor_total_8").css("background-color","#FFF");
			$("#cantidad_8").css("background-color","#FFF");
			$("#costo_8").css("background-color","#FFF");
		}
	});
   
    //(9.40) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_9').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_9").value;
		var costo_unitario = document.getElementById("costo_9").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_9").value = 0;
			$("#cantidad_9").css("background-color","#F9BEBD");
			$("#costo_9").css("background-color","#F9BEBD");
			$("#valor_total_9").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_9").value = valor_total.toFixed(2);
 			$("#valor_total_9").css("background-color","#FFF");
			$("#cantidad_9").css("background-color","#FFF");
			$("#costo_9").css("background-color","#FFF");
		}
	});
    
    //(9.41) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_10').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_10").value;
		var costo_unitario = document.getElementById("costo_10").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_10").value = 0;
			$("#cantidad_10").css("background-color","#F9BEBD");
			$("#costo_10").css("background-color","#F9BEBD");
			$("#valor_total_10").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_10").value = valor_total.toFixed(2);
 			$("#valor_total_10").css("background-color","#FFF");
			$("#cantidad_10").css("background-color","#FFF");
			$("#costo_10").css("background-color","#FFF");
		}
	});
    
    //(9.42) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_11').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_11").value;
		var costo_unitario = document.getElementById("costo_11").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_11").value = 0;
			$("#cantidad_11").css("background-color","#F9BEBD");
			$("#costo_11").css("background-color","#F9BEBD");
			$("#valor_total_11").css("background-color","#F9BEBD");
		} else {
					     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_11").value = valor_total.toFixed(2);
 			$("#valor_total_11").css("background-color","#FFF");
			$("#cantidad_11").css("background-color","#FFF");
			$("#costo_11").css("background-color","#FFF");
		}
	});
    
    //(9.43) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_12').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_12").value;
		var costo_unitario = document.getElementById("costo_12").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_12").value = 0;
			$("#cantidad_12").css("background-color","#F9BEBD");
			$("#costo_12").css("background-color","#F9BEBD");
			$("#valor_total_12").css("background-color","#F9BEBD");
						
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_12").value = valor_total.toFixed(2);
 			$("#valor_total_12").css("background-color","#FFF");
			$("#cantidad_12").css("background-color","#FFF");
			$("#costo_12").css("background-color","#FFF");
		}
	});
    
    //(9.44) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_13').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_13").value;
		var costo_unitario = document.getElementById("costo_13").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_13").value = 0;
			$("#cantidad_13").css("background-color","#F9BEBD");
			$("#costo_13").css("background-color","#F9BEBD");
			$("#valor_total_13").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
			
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_13").value = valor_total.toFixed(2);
 			$("#valor_total_13").css("background-color","#FFF");
			$("#cantidad_13").css("background-color","#FFF");
			$("#costo_13").css("background-color","#FFF");
		}
	});
    
    //(9.45) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_14').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_14").value;
		var costo_unitario = document.getElementById("costo_14").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_14").value = 0;
			$("#cantidad_14").css("background-color","#F9BEBD");
			$("#costo_14").css("background-color","#F9BEBD");
			$("#valor_total_14").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_14").value = valor_total.toFixed(2);
 			$("#valor_total_14").css("background-color","#FFF");
			$("#cantidad_14").css("background-color","#FFF");
			$("#costo_14").css("background-color","#FFF");
		}
	});
    
    //(9.46) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_15').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_15").value;
		var costo_unitario = document.getElementById("costo_15").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_15").value = 0;
			$("#cantidad_15").css("background-color","#F9BEBD");
			$("#costo_15").css("background-color","#F9BEBD");
			$("#valor_total_15").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_15").value = valor_total.toFixed(2);
 			$("#valor_total_15").css("background-color","#FFF");
			$("#cantidad_15").css("background-color","#FFF");
			$("#costo_15").css("background-color","#FFF");
		}
	});
    
    //(9.47) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_16').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_16").value;
		var costo_unitario = document.getElementById("costo_16").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_16").value = 0;
			$("#cantidad_16").css("background-color","#F9BEBD");
			$("#costo_16").css("background-color","#F9BEBD");
			$("#valor_total_16").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_16").value = valor_total.toFixed(2);
 			$("#valor_total_16").css("background-color","#FFF");
			$("#cantidad_16").css("background-color","#FFF");
			$("#costo_16").css("background-color","#FFF");
		}
	});
    
    //(9.48) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_17').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_17").value;
		var costo_unitario = document.getElementById("costo_17").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_17").value = 0;
			$("#cantidad_17").css("background-color","#F9BEBD");
			$("#costo_17").css("background-color","#F9BEBD");
			$("#valor_total_17").css("background-color","#F9BEBD");
						
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_17").value = valor_total.toFixed(2);
 			$("#valor_total_17").css("background-color","#FFF");
			$("#cantidad_17").css("background-color","#FFF");
			$("#costo_17").css("background-color","#FFF");
		}
	});
    
    //(9.49) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_18').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_18").value;
		var costo_unitario = document.getElementById("costo_18").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_18").value = 0;
			$("#cantidad_18").css("background-color","#F9BEBD");
			$("#costo_18").css("background-color","#F9BEBD");
			$("#valor_total_18").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
			
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_18").value = valor_total.toFixed(2);
 			$("#valor_total_18").css("background-color","#FFF");
			$("#cantidad_18").css("background-color","#FFF");
			$("#costo_18").css("background-color","#FFF");
		}
	});
   
    //(9.50) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_19').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_19").value;
		var costo_unitario = document.getElementById("costo_19").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_19").value = 0;
			$("#cantidad_19").css("background-color","#F9BEBD");
			$("#costo_19").css("background-color","#F9BEBD");
			$("#valor_total_19").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
						   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_19").value = valor_total.toFixed(2);
 			$("#valor_total_19").css("background-color","#FFF");
			$("#cantidad_19").css("background-color","#FFF");
			$("#costo_19").css("background-color","#FFF");
		}
	});
    
    //(9.51) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_20').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_20").value;
		var costo_unitario = document.getElementById("costo_20").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_20").value = 0;
			$("#cantidad_20").css("background-color","#F9BEBD");
			$("#costo_20").css("background-color","#F9BEBD");
			$("#valor_total_20").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_20").value = valor_total.toFixed(2);
 			$("#valor_total_20").css("background-color","#FFF");
			$("#cantidad_20").css("background-color","#FFF");
			$("#costo_20").css("background-color","#FFF");
		}
	});
    
    //(9.52) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_21').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_21").value;
		var costo_unitario = document.getElementById("costo_21").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_21").value = 0;
			$("#cantidad_21").css("background-color","#F9BEBD");
			$("#costo_21").css("background-color","#F9BEBD");
			$("#valor_total_21").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_21").value = valor_total.toFixed(2);
 			$("#valor_total_21").css("background-color","#FFF");
			$("#cantidad_21").css("background-color","#FFF");
			$("#costo_21").css("background-color","#FFF");
		}
	});
    
    //(9.53) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_22').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_22").value;
		var costo_unitario = document.getElementById("costo_22").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_22").value = 0;
			$("#cantidad_22").css("background-color","#F9BEBD");
			$("#costo_22").css("background-color","#F9BEBD");
			$("#valor_total_22").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_22").value = valor_total.toFixed(2);
 			$("#valor_total_22").css("background-color","#FFF");
			$("#cantidad_22").css("background-color","#FFF");
			$("#costo_22").css("background-color","#FFF");
		}
	});
    
    //(9.54) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_23').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_23").value;
		var costo_unitario = document.getElementById("costo_23").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_23").value = 0;
			$("#cantidad_23").css("background-color","#F9BEBD");
			$("#costo_23").css("background-color","#F9BEBD");
			$("#valor_total_23").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_23").value = valor_total.toFixed(2);
 			$("#valor_total_23").css("background-color","#FFF");
			$("#cantidad_23").css("background-color","#FFF");
			$("#costo_23").css("background-color","#FFF");
		}
	});
    
    //(9.55) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_24').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_24").value;
		var costo_unitario = document.getElementById("costo_24").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_24").value = 0;
			$("#cantidad_24").css("background-color","#F9BEBD");
			$("#costo_24").css("background-color","#F9BEBD");
			$("#valor_total_24").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_24").value = valor_total.toFixed(2);
 			$("#valor_total_24").css("background-color","#FFF");
			$("#cantidad_24").css("background-color","#FFF");
			$("#costo_24").css("background-color","#FFF");
		}
	});
    
    //(9.56) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_25').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_25").value;
		var costo_unitario = document.getElementById("costo_25").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_25").value = 0;
			$("#cantidad_25").css("background-color","#F9BEBD");
			$("#costo_25").css("background-color","#F9BEBD");
			$("#valor_total_25").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_25").value = valor_total.toFixed(2);
 			$("#valor_total_25").css("background-color","#FFF");
			$("#cantidad_25").css("background-color","#FFF");
			$("#costo_25").css("background-color","#FFF");
		}
	});
    
    //(9.57) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_26').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_26").value;
		var costo_unitario = document.getElementById("costo_26").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_26").value = 0;
			$("#cantidad_26").css("background-color","#F9BEBD");
			$("#costo_26").css("background-color","#F9BEBD");
			$("#valor_total_26").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_26").value = valor_total.toFixed(2);
 			$("#valor_total_26").css("background-color","#FFF");
			$("#cantidad_26").css("background-color","#FFF");
			$("#costo_26").css("background-color","#FFF");
		}
	});
    
    //(9.58) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_27').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_27").value;
		var costo_unitario = document.getElementById("costo_27").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_27").value = 0;
			$("#cantidad_27").css("background-color","#F9BEBD");
			$("#costo_27").css("background-color","#F9BEBD");
			$("#valor_total_27").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
						   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_27").value = valor_total.toFixed(2);
 			$("#valor_total_27").css("background-color","#FFF");
			$("#cantidad_27").css("background-color","#FFF");
			$("#costo_27").css("background-color","#FFF");
		}
	});
    
    //(9.59) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_28').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_28").value;
		var costo_unitario = document.getElementById("costo_28").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_28").value = 0;
			$("#cantidad_28").css("background-color","#F9BEBD");
			$("#costo_28").css("background-color","#F9BEBD");
			$("#valor_total_28").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_28").value = valor_total.toFixed(2);
 			$("#valor_total_28").css("background-color","#FFF");
			$("#cantidad_28").css("background-color","#FFF");
			$("#costo_28").css("background-color","#FFF");
		}
	});
    
    //(9.60) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_29').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_29").value;
		var costo_unitario = document.getElementById("costo_29").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_29").value = 0;
			$("#cantidad_29").css("background-color","#F9BEBD");
			$("#costo_29").css("background-color","#F9BEBD");
			$("#valor_total_29").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_29").value = valor_total.toFixed(2);
 			$("#valor_total_29").css("background-color","#FFF");
			$("#cantidad_29").css("background-color","#FFF");
			$("#costo_29").css("background-color","#FFF");
		}
	});
     
    //(9.61) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_30').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_30").value;
		var costo_unitario = document.getElementById("costo_30").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_30").value = 0;
			$("#cantidad_30").css("background-color","#F9BEBD");
			$("#costo_30").css("background-color","#F9BEBD");
			$("#valor_total_30").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_30").value = valor_total.toFixed(2);
 			$("#valor_total_30").css("background-color","#FFF");
			$("#cantidad_30").css("background-color","#FFF");
			$("#costo_30").css("background-color","#FFF");
		}
	});
    
    //(9.62) Con esto voy poniendo en el valor total del artículo el COSTO TOTAL a medida que escribo en la Cantidad
    $('input#cantidad_31').keyup(function(){ 
		
		//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		hide_detalle_de_pago();
				 
		var cantidad       = document.getElementById("cantidad_31").value;
		var costo_unitario = document.getElementById("costo_31").value;
				    
		if ( cantidad == "" || cantidad == null || isNaN(cantidad) || cantidad == 0 || costo_unitario == "" || costo_unitario == null || isNaN(costo_unitario) || costo_unitario == 0 )  {
		   // Verifico que la cantidad tiene un valor numeral.
			document.getElementById("valor_total_31").value = 0;
			$("#cantidad_31").css("background-color","#F9BEBD");
			$("#costo_31").css("background-color","#F9BEBD");
			$("#valor_total_31").css("background-color","#F9BEBD");
		} else {
						     
			cantidad = parseFloat(cantidad);
			costo_unitario = parseFloat(costo_unitario);
							   
			valor_total = cantidad*costo_unitario; 
					
			document.getElementById("valor_total_31").value = valor_total.toFixed(2);
 			$("#valor_total_31").css("background-color","#FFF");
			$("#cantidad_31").css("background-color","#FFF");
			$("#costo_31").css("background-color","#FFF");
		}
	});
   
  } // Fin de la función keyup_cantidad()
  
  /******************************************** (( 9.04 )) *******************************************************/
  
  /*(9.32)******************* INSTRUCCIONES JQUERY PARA BORRAR ALGUNA FILA DE LA NUEVA COMPRA  *****************/
  
  function delete_filas()
  {
   
    //9.63 PARA BORRAR LA FILA 2 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_2').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_2').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
		
	//9.64 PARA BORRAR LA FILA 3 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_3').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_3').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
		
	//9.65 PARA BORRAR LA FILA 4 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_4').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_4').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	
	//9.66 PARA BORRAR LA FILA 5 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_5').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_5').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	
	//9.67 PARA BORRAR LA FILA 6 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_6').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_6').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	
	//9.68 PARA BORRAR LA FILA 7 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_7').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_7').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
		
	//9.69 PARA BORRAR LA FILA 8 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_8').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_8').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	
	//9.70 PARA BORRAR LA FILA 9 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_9').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_9').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	
	//9.71 PARA BORRAR LA FILA 10 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_10').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_10').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
					
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
	
	//9.72 PARA BORRAR LA FILA 11 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_11').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_11').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	 
    //9.73 PARA BORRAR LA FILA 12 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_12').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_12').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	    
	//9.74 PARA BORRAR LA FILA 13 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_13').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_13').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
					
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
	    
	//9.75 PARA BORRAR LA FILA 14 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_14').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_14').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	 
    //9.76 PARA BORRAR LA FILA 15 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_15').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_15').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
					
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
	  
    //9.77 PARA BORRAR LA FILA 16 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_16').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_16').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	  
    //9.78 PARA BORRAR LA FILA 17 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_17').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_17').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	 
    //9.79 PARA BORRAR LA FILA 18 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_18').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_18').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
					
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
	
    //9.80 PARA BORRAR LA FILA 19 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_19').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_19').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
					
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
	 
    //9.81 PARA BORRAR LA FILA 20 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_20').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_20').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
					
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
	  
    //9.82 PARA BORRAR LA FILA 51 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_21').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_21').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
					
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
	 
    //9.83 PARA BORRAR LA FILA 22 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_22').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_22').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	 
    //9.84 PARA BORRAR LA FILA 23 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_23').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_23').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	 
     //9.85 PARA BORRAR LA FILA 24 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_24').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_24').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	
    //9.86 PARA BORRAR LA FILA 25 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_25').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_25').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	
    //9.87 PARA BORRAR LA FILA 26 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_26').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_26').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	 
    //9.88 PARA BORRAR LA FILA 27 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_27').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_27').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	 
    //9.89 PARA BORRAR LA FILA 28 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_28').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_28').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
					
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
	 
    //9.90 PARA BORRAR LA FILA 29 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_29').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_29').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
					
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
	 
    //9.91 PARA BORRAR LA FILA 30 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_30').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_30').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	  
    //9.92 PARA BORRAR LA FILA 31 DE COMPRAS QUE QUIERO BORRAR.
	$('a#delete_31').click(function(e) {
		if(confirm('\xBFEst\xE1 Seguro de Eliminar este Registro?')){
			
			//(01) Inicializo todo lo referente a 3. DETALLE DE PAGO.
		    hide_detalle_de_pago();
			// De esta forma resto el valor de los artículos seleccionados.
			var resta = document.getElementById('valor_total_31').value; 
			var total = document.getElementById('total_compras_valor').innerHTML;
			
			var Resta = parseFloat(resta);
			var Total = parseFloat(total);
			
			var Resultado = Total - Resta; 
			document.getElementById('total_compras_valor').innerHTML = Resultado.toFixed(2);
						
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
	 
  }  // Fin de la función delete_filas()
    
  /******************************************** (( 9.05 )) *******************************************************/
  
   //9.93 PARA SUMAR EL VALOR DE TODOS LOS ARTÍCULOS DE CADA FILA. 
  function show_valor_total_sumatoria_articulos()
  {
	  // Función que se ejecuta al hacer un blur sobre el campo cantidad de artículos de cada compra.
      var SumatoriaValoresArticulos = 0;
	  var numero_elementos_compra = document.form_nueva_compra.elements.length;
	  
	   for ( var j=0; j < numero_elementos_compra; j++ ) 
	   {
	       
		   var name = document.form_nueva_compra.elements[j].name;
		   
		   if ( name == "valor_total_1" || name == "valor_total_2" || name == "valor_total_3" || name == "valor_total_4" || name == "valor_total_5" || name == "valor_total_6" || name == "valor_total_7" || name == "valor_total_8" || name == "valor_total_9" || name == "valor_total_10" || name == "valor_total_11" || name == "valor_total_12" || name == "valor_total_13" || name == "valor_total_14" || name == "valor_total_15" || name == "valor_total_16" || name == "valor_total_17" || name == "valor_total_18" || name == "valor_total_19" || name == "valor_total_20" || name == "valor_total_21" || name == "valor_total_22" || name == "valor_total_23" || name == "valor_total_24"|| name == "valor_total_25" || name == "valor_total_26" || name == "valor_total_27" || name == "valor_total_28" || name == "valor_total_29" || name == "valor_total_30" || name == "valor_total_31" )	 {
		   	   
			   var Valor = document.form_nueva_compra.elements[j].value;
			   Valor = parseFloat(Valor);
			   SumatoriaValoresArticulos = SumatoriaValoresArticulos + Valor;
			  
		   } else {
			  continue;   
		   }
	   } 
	  
	   document.getElementById('total_compras_valor').innerHTML = SumatoriaValoresArticulos.toFixed(2); 
	     
   } // Fin de la función show_valor_total()
    
    /******************************************** (( 9.06 )) *******************************************************/
  
   //9.94 INICIALIZA TODOS LOS VALORES DEL "DETALLE DE PAGO" A '0' Y LOS ESCONDE 
  function hide_detalle_de_pago()
  {
	  // Función que se ejecuta al hacer cualquier el DETALLE DE LA COMPRA.
      
	  //01 Escondo el <div> id="detalle_pago", el <div> id="guardar_nueva_compra" y muestro el <div> id="anadir_detalle_pago"
      $('#anadir_detalle_pago').show();
	  $('#detalle_pago').hide();
	  $('#guardar_nueva_compra').hide();
	  
	  // Inicializo todas las variables del DETALLE DE PAGO a 0.
	  document.getElementById('monto_total_a_pagar').value = 0;             // input.text con el valor total a pagar(derecha-sup).    
	  
	  document.getElementById('forma_pago_contado').checked = 0;  // radioboton de 'TIPO DE PAGO' contado. 
      document.getElementById('forma_pago_credito').checked = 0;  // radioboton de 'TIPO DE PAGO' crédito.
	  
	  document.getElementById('input_entrada_forma_pago').value = 0;        // input.text con el valor de la ENTRDA del 'crédito'   
	  
	  document.getElementById('forma_de_pago_banco').checked = 0;         // radioboton de 'TIPO DE PAGO' de BANCO. 
      document.getElementById('forma_de_pago_caja').checked = 0;       // radioboton de 'TIPO DE PAGO' de CAJA.
	  document.getElementById('forma_de_pago_banco_y_caja').checked = 0;  // radioboton de 'TIPO DE PAGO' de BANCO y CAJA. 
      
	  document.getElementById('descripcion_origen_pago').value = "";  // input.text con la descripcion del tipo de pago(BANCO ó CAJA).
	  document.getElementById('monto_pago_caja').value = "";          // input.text con el monto del tipo de pago 2 (SÓLO CAJA).
	  document.getElementById('descripcion_pago_caja').value = "";    // input.text con la descripcion del tipo de pago 2(SÓLO CAJA).
	  document.getElementById('monto_pago_banco').value = "";          // input.text con el monto del tipo de pago 2 (SÓLO BANCO).
	  document.getElementById('descripcion_pago_banco').value = "";    // input.text con la descripcion del tipo de pago 2(SÓLO BANCO).
	  
	  document.getElementById('saldo_dinero').value = 0;    // input.text con el valor del SALDO del 'crédito'. 
	  
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
    
  }  // Fin de la función hide_detalle_de_pago()