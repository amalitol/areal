/* Archivo donde pondré todas las funciones del sistema creadas por mí
  
01. cryptsubmit()      -> Función que encripta el valor de la variable pass para enviarla encriptada al servidor.....
02. pagina_principal() -> Función que va al link a la página principal o Panel de Control.

  ---- módulo mi perfil ---
03. mi_perfil()    -> Función que llama al archivo mi_perfil.php para cambiar los datos de contraseña.
04. change_pass()  -> Función que cambia la contraseña del usuario en la BD ( encriptada ).

  ---- módulo log out ----
03. logout()       -> Función que llama al archivo logout.php y elimina las variables de sesión y vuelve a la pag. Princ.

  ---- módulo administrar   ----
06. admin_users()  -> Función que llama al archivo  --------------- para agregar los usuarios y otras tareas de administración

  ----- módulo registro bancario ----- 
07. able_debito()  -> Función que habilita los campos text para llenar el debito  ( modulo Registro Bancario )
08. able_credito() -> Función que habilita los campos text para llenar el credito ( modulo Registro Bancario )
09. send_bankform() -> Función que habilita los diferentes campos <text> según el caso y envía el formulario del banco 
10. send_mesform() -> Función que envía el formulario que selecciona el mes y el año del cual quiero ver los registros.
11. inicio_rb_button() -> Función del botón de ir al inicio del Módulo.

  ----- módulo cuentas x pagar ------
12. send_mes_cuentas_x_pagar() -> Función que envía el formulario que selecciona mes y año para ver las cuentas x pagar.
13. able_valor_abonar()        -> Función que activa la casilla de valor a abonar de un registro (cuentas x pagar)
14. disable_valor_abonar()     -> Función que desactiva la casilla de valor a abonar de un registro (cuentas x pagar)
15. send_edit_mes_cuentas_x_pagar() -> Función que envía el formulario de edición de los datos de un registro.
16. send_mesano_cuentas_x_pagar()   -> Función que envía el formulario que selecciona el mes y el año del cual quiero ver los registros de las cuentas por pagar. 
17. inicio_cxp_button() -> Función del botón de ir al inicio del Módulo.    

  ----- módulo proveedores -----
18. send_proveedores() -> Función que procesa los datos del proveedor enviado por el usuario.
19. edit_proveedores() -> función que envía a procesar un proveedor cuando se va a EDITAR.
20. submitbutton('variable') -> Función que me muesttra una acción diferente de acuerdo al valor del la variable 'var'.
21. send_contacto() -> Función que envía a procesar una contacto de un proveedor.
22. eliminar_contactos()  -> Función elimina los contactos seleccionados en el checkbos por el usuario
   ---- ajax ----
23. show_campos(data) -> Función que se llama cuando la petición ajax se ha completado correctamente    
   --------------
24. editar_contacto() -> Función que permite un UPDATE en la BD del contacto seleccionado. 

  ----- módulo clientes -----
25. send_clientes() -> Función que procesa los datos del cliente enviado por el usuario.
26. edit_clientes() -> Función que envía a procesar un cliente cuando se va a EDITAR.
27. submitboton('variable') -> Función que me muestra una acción diferente de acuerdo al valor del la variable 'var'.
28. send_contacto_cliente() -> Función que envía a procesar una contacto de un proveedor.
29. eliminar_contactos_clientes()  -> Función elimina los contactos seleccionados en el checkbos por el usuario.
   ---- ajax ----
30. show_campos_cliente(data) -> Función que se llama cuando la petición ajax se ha completado correctamente    
   --------------
31. editar_contacto_cliente() -> Función que permite un UPDATE en la BD del contacto seleccionado. 

 ----- módulo cuentas x cobrar ------
32. send_mes_cuentas_x_cobrar() -> Función que envía el formulario que selecciona mes y año para ver las cuentas x cobrar.
33. able_valor_ingresar()        -> Función que activa la casilla de valor a abonar de un registro (cuentas x cobrar)
34. disable_valor_ingresar()     -> Función que desactiva la casilla de valor a abonar de un registro (cuentas x cobrar)
35. send_edit_mes_cuentas_x_cobrar() -> Función que envía el formulario de edición de los datos de un registro.
36. send_mesano_cuentas_x_cobrar()   -> Función que envía el formulario que selecciona el mes y el año del cual quiero ver los registros de las cuentas por cobrar.
37. inicio_cxc_button() -> Función del botón de ir al inicio del Módulo.  

 ----- módulo empresa -----
38. send_empresaform()    --> Función que envía el formulario con los datos de la empresa (Administrador)

 ----- módulo compras -----
39. detalle_compra()      --> Función que pasa a mostrar el SEGUNDO div del detalle de las compras.  
40. MostrarLoader()       --> Función que muestra el gif animado loader.gif
41. EsconderLoader()      --> Función que esconde el gif animado loader.gif
42. show_error_message_clientes()  --> Función que muestra un error en la petición.
43. send_new_compra() --> Función que envía la nueva compra a la base de datos.
44.(private) chequeo_d_pagos(entrada) -> Función que chequea todos los pagos y los envía a procesar al PHP, se usa 3 veces...
45.(private) check_cantidad_de_pagos() -> Función que chequea todos los campos de acuerdo a la cantidad de pagos de la Nueva Compra.
46.(private) chack_pago1() -> Función que chequea los valores del PRIMER PAGO de la nueva compra.
47.(private) chack_pago2() -> Función que chequea los valores del SEGUNDO PAGO de la nueva compra. 
48.(private) chack_pago3() -> Función que chequea los valores del TERCER PAGO de la nueva compra. 
49.(private) chack_pago4() -> Función que chequea los valores del CUARTO PAGO de la nueva compra.
50.(private) chack_pago5() -> Función que chequea los valores del QUINTO PAGO de la nueva compra.
51.(private) chack_pago6() -> Función que chequea los valores del SEXTO PAGO de la nueva compra.
52.(private) chack_pago7() -> Función que chequea los valores del SÉPTIMO PAGO de la nueva compra.
53.(private) chack_pago8() -> Función que chequea los valores del OCTAVO PAGO de la nueva compra.
54.(private) chack_pago9() -> Función que chequea los valores del NOVENO PAGO de la nueva compra.
55.(private) chack_pago10() -> Función que chequea los valores del DÉCIMO PAGO de la nueva compra.
56. inicio_compras_button() -> Función que pone al inicio el módulo COMPRAS. 
57. send_reporte_proveedor_compras() -> Función que envía el proveedor y muestra los datos del reporte de Compras del mismo. 
58. send_rescompras() -> Función que envía el formulario de RESUMEN DE COMPRAS entre 2 fechas determinadas.

 ---- Módulo inventario -----
59. submitinv('variable') -> Función que me muestra una acción diferente de acuerdo al valor del la variable 'var' para
                              insertar nuevos artículos. 
60. send_articulo()       -> Función que rectifica los datos introducidos en los campos para ser enviados a insertar los 
                              nuevos artículos en la BD.
61. edit_articulo()       -> Función que envía el formulario de edición de los datos de un artículo
62. send_local()          -> Función que envia los datos al crear un nuevo local en el inventario 
 ---- ajax ----
63. show_campos_local()   -> Función que se llama cuando la petición ajax para la edición de locales se ha completado.  
 --------------
64. inicio_form_nuevo_local()  -> Función que inicializa todos los campos a 0
65. able_descripcion()    -> Función que habilita el campo text para seleccionar el artículo por DESCRIPCIÓN
66. able_codigo()  	      -> Función que habilita el campo text para seleccionar el artículo por CÓDIGO.		
67. reset_all_camps_in_mov() -> Función que inicializa todos los campos del formulario si: 1. cambio el valor del artículo que quiero mover.
	    2. Toco cualquiera de los 2 radiobotones para seleccionar el artículo por: 1. Referencia 2. Código
68. able_description_kardex()  -> Función que habilita el campo text para seleccionar el artículo por DESCRIPCIÓN.
69. able_description_kardex()  -> Función que habilita el campo text para seleccionar el artículo por CÓDIGO.
70. send_mov()            -> Función que envía el formulario de movimientos de inventarios a la base de datos 
71. send_art_kardex()     -> Función que envía el formulario de KARDEX de un artículo y un local a consultar en la base de datos.
72. send_resmov()         -> Función que envía el formulario de RESUMEN MOV. ARTÍCULOS de un local en específico.
73. send_stock()          -> Función que envía el formulario de STOCK de un local en específico.
74. add_pendiente()       -> Función que envía el radio botón seleccionado como artículo PENDIENTE al LOCAL (ENTRADA) 
 
 --- Módulo Usuarios -----
75. goinicio_users('inicio') -> Función que envía al inicio ddel módulo a los usuarios que están en las vistas internas.
76. accion_users('#,acc')     -> Función que envía el submit para poder habilitar-inhabilitar usuarios.
77. send_user()            -> Función que procesa la entrada de nuevos usuarios a la BD.
78. change_userpass()      -> Función que procesa el cambio de la contraseña del usuario.
 
 --- Módulo Caja ----
79. inicio_caja_button()  -> Función del botón de ir al inicio del Módulo. 
80. send_transaccion()   -> Función que envía el formulario de insertar nueva transacción.
81. add_efectivo_pendiente() -> Función que envía el checkbox seleccionado como efectivo PENDIENTE a la CAJA DEL  LOCAL (ENTRADA).
82. send_caja_anterior() -> Función que envía el formulario de VER CAJA ANTERIOR de un local a consultar en la base de datos.
83. send_reporte_caja_almacen_hoy() -> Función que envía el <select> con el almacén para ver si la caja del almacén seleccionado.
   
 --- Modulo Ventas ---
84. inicio_ventas_button() -> Función que va al inicio de módulo Ventas. 
85. detalle_venta()   -> Función que pasa a mostrar el SEGUNDO div de artículos de la venta.
86. send_new_venta() -> Función que envía la nueva venta a la base de datos.
87. (private) chequeo_d_pagos_ventas(entrada) ->  Función que chequea todos los pagos y los envía a procesar al PHP, se usa 2 veces...
88. (private) check_cantidad_de_pagos_ventas(entrada) -> Función que chequea todos los campos de acuerdo a la cantidad de pagos de la Nueva VENTA. 
89. (private) check_pago1_ventas() -> Función que chequea los valores del PRIMER PAGO de la nueva venta. 
90. (private) check_pago2_ventas() -> Función que chequea los valores del SEGUNDO PAGO de la nueva venta.
91. (private) check_pago3_ventas() -> Función que chequea los valores del TERCER PAGO de la nueva venta.
92. (private) check_pago4_ventas() -> Función que chequea los valores del CUARTO PAGO de la nueva venta.
93. (private) check_pago5_ventas() -> Función que chequea los valores del QUINTO PAGO de la nueva venta.
94. send_reporte_cliente_ventas()  -> Función que envía los datos del cliente y el almacén que quiero ver en el REPORTE.
95. send_resventas()  --> Función que envía el formulario de RESUMEN DE VENTAS de un local en específico.
       
 --- Módulo Add Artículo ---
96. send_articulo_from_compras()  --> Función que envía el formulario del nuevo artículo desde el módulo Compras.
	
*/

// 01
  function cryptsubmit()
  {
	 // Función que encripta el valor de la variable pass para enviarla encriptada al servidor.....
	  
	 if ( document.form_login.usuario.value != "" )   {
	     //(1) Compruebo que el usuario haya escrito su usuario 
	 
	     if ( document.form_login.pass.value != "" )   {
	         //(2) Compruebo que el usuario haya escrito su contraseña
	         
			 var md5 = $().crypt({method:"md5", source:$("#pass").val()});
	         // alert(md5);
	         document.form_login.pass_hidden.value = md5;
			 document.form_login.action = "includes/mod_login_functions.php?data=send";
			 document.form_login.submit();
			 
		 } else {
		 
	         alert('Por favor escriba su contrase\xF1a.GRACIAS');
			 document.form_login.pass.focus();
			 return false;
	 
	     }
		
     } else {
	  
	  alert('Por favor escriba su usuario.GRACIAS');
	  document.form_login.usuario.focus();
	  return false;
	   
     }
		  
  }  // Fin de la función cryptsubmit()

//02
  function pagina_principal()
  {
	  // Función que va a la página principal.
	  document.location.href = 'index.php';
	  
  }  // Fin de la función pagina_principal()

                                                 /*******---- módulo mi perfil ---*******/
//03
  function mi_perfil()
  {
	  // Función que llama al archivo perfil_user.php para cambiar los datos de contraseña.
	  document.location.href = 'index.php?mod=mod_mi_perfil';
	  
  }  // Fin de la función mi_perfil()

//04  
  function change_pass()
  {
	  // Función que cambia la contraseña del usuario en la BD ( encriptada ).
	  //1 Compruebo que esté lleno el campo con la contraseña actual
	  if ( document.form_change_pass.old_pass.value == "" )   { 
	      alert('Por favor llene el campo de la contrase\xF1a actual');
	      document.form_change_pass.old_pass.focus();
		  return (false);
	  } 
	    
	  //2 Compruebo que esté lleno el campo con la contraseña nueva
	  if ( document.form_change_pass.new_pass.value == "" )   { 
	      alert('Por favor llene el campo de nueva contrase\xF1a');
	      document.form_change_pass.new_pass.focus();
		  return (false);
	  }
	  //3 Compruebo que esté lleno el campo con la confirmación de la nueva contraseña
	  if ( document.form_change_pass.new_pass_confirm.value == "" )   { 
	      alert('Por favor llene el campo de confirmaci\xF3n de la nueva contrase\xF1a');
	      document.form_change_pass.new_pass_confirm.focus();
		  return (false);
	  }
	  //4 Compruebo que los campos de la conttraseña y la confirmación de la nueva contraseña sean iguales
	  if ( document.form_change_pass.new_pass.value != document.form_change_pass.new_pass_confirm.value )   { 
	      alert('Las contrase\xF1as no concuerdan. Por favor verifique.');
	      document.form_change_pass.new_pass.value = "";
		  document.form_change_pass.new_pass_confirm.value = "";
		  document.form_change_pass.new_pass.focus();
		  return (false);
	  }
	  
	  //5 Encripto la contraseña actual en md5 en el campo hidden.
      var old_md5 = $().crypt({method:"md5", source:$("#old_pass").val()});
	         document.form_change_pass.old_pass_hidden.value = old_md5;
	  	  
	  //6 Encripto la contraseña nueva en md5 en el campo hidden
      var new_md5 = $().crypt({method:"md5", source:$("#new_pass").val()});
	         document.form_change_pass.new_pass_hidden.value = new_md5;
			 
	 //07 LLevo a cabo el submit del formulario		 
			 document.form_change_pass.action = "includes/mod_mi_perfil_functions.php?data=send";
			 document.form_change_pass.submit();
	    
  }  // fin de la function change_pass()

                                                       /*******---- módulo log out---*******/
//05
  function logout()
  {
	// Función que llama al archivo logout.php y elimina las variables de sesión y vuelve a la pag. Princ.  
	document.location.href = 'modules/logout.php';
	  
  }
                                                       /*******---- módulo administrar---*******/
//06
  function admin_users()
  {
	  // Función que llama al archivo admin_user.php para mostrar la vista del administrador.
	  document.location.href = 'index.php?mod=mod_empresa#tabs-1';
	    
  }
                                                       /*******---- módulo registro bancario---*******/
//07   
  function able_debito()
  {
	 // Función que habilita los campos text para llenar el debito  ( modulo Registro Bancario )			  			
	 //var num_cheque = document.getElementById('num_cheque');
	 var valor_pago = document.getElementById('valor_pago');
	 //var num_deposito   = document.getElementById('num_deposito');
	 var valor_deposito = document.getElementById('valor_deposito');  
					
	 //num_cheque.value = "";
	 valor_pago.value = "";
	 //num_deposito.value = "";
	 valor_deposito.value = ""; 
					
	 //num_cheque.disabled = "";
	 valor_pago.disabled = "";
	 //num_deposito.disabled = "disabled";
	 valor_deposito.disabled = "disabled";  
					
	 document.form_bank.valor_pago.focus();
			   
  }  
			   
//08
  function able_credito()
  {
	 // Función que habilita los campos text para llenar el credito ( modulo Registro Bancario )			 
	 //var num_deposito   = document.getElementById('num_deposito');
	 var valor_deposito = document.getElementById('valor_deposito');
	 //var num_cheque = document.getElementById('num_cheque');
	 var valor_pago = document.getElementById('valor_pago');  
					
	 //num_deposito.value = "";
	 valor_deposito.value = "";
	 //num_cheque.value = "";
	 valor_pago.value = ""; 
	 
	 //num_deposito.disabled = "";
	 valor_deposito.disabled = ""; 
	 //num_cheque.disabled = "disabled";
	 valor_pago.disabled = "disabled"; 
			   
	 document.form_bank.valor_deposito.focus();
			   
  }  
    
//09
  function send_bankform()
  {
	// Función que habilita los diferentes campos <text> según el caso y envía el formulario del banco
	var contador = 0;  // Contador de los radio botones vacíos
	var tipo_transaccion;  // Define el tipo de transacción para ver si es DÉBITO o CRÉDITO 
			  
	//(1) VERIFICO QUE EXISTA AL MENOS UN RADIO BOTÓN SELECCIONADO 
	for ( i=0; i < document.form_bank.elements.length; i++ ) 
	{
	     if ( document.form_bank.elements[i].type == "radio")	 {
			 if (document.form_bank.elements[i].checked == 0 )  {
				 contador++;
				 continue;  
			 } else {
			     break;  
			 }
		 }
	}
			  
	if ( contador == 2 )  {
	    alert('Usted debe seleccionar el tipo de transacci\xF3n que desea introducir. GRACIAS');
		return (false);   
    } 
			  
	//(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA
	if ( document.form_bank.fecha.value == "" )  {
	    alert('Por favor introduzca la fecha. GRACIAS');
		document.form_bank.fecha.focus();
		return(false);   
    }   
			  
	//(3) VERIFICO QUE LO INTRODUCIDO EN LOS CAMPOS DE LOS CRÉDITOS Y LOS DÉBITOS NO ESTÉN VACÍOS Y SEAN NÚMEROS
	// CASO 1 -> BOTÓN DÉBITO SELECCIONADO:
	if ( document.getElementById('radio_debito').checked == 1 )  {
	    tipo_transaccion = 'debito';
	    if ( document.form_bank.valor_pago.value == "" )  {
		    alert('Por favor introduzca el valor del D\xE9bito. GRACIAS');
			document.form_bank.valor_pago.focus();
			return(false);
	    } else if ( isNaN(document.form_bank.valor_pago.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el D\xE9bito. GRACIAS');
			 document.form_bank.valor_pago.focus();
			 return(false);
		}
	
	}  // CASO 2 -> BOTÓN CRÉDITO SELECCIONADO:
	  else if ( document.getElementById('radio_credito').checked == 1  )  {
			   tipo_transaccion = 'credito';
			   if ( document.form_bank.valor_deposito.value == "" )  {
				   alert('Por favor introduzca el valor del Cr\xE9dito. GRACIAS');
				   document.form_bank.valor_deposito.focus();
				   return(false);
			   } else if ( isNaN(document.form_bank.valor_deposito.value) )  { 
				   alert('Por favor introduzca un valor num\xE9rico en el Cr\xE9dito. GRACIAS');
				   document.form_bank.valor_deposito.focus();
				   return(false);
			   }
	}
			  
	//(4) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	if ( tipo_transaccion == 'debito' )  {
				  
		if (confirm("Si son correctos los datos, por favor acepte \n\n" + "Fecha:  " + document.form_bank.fecha.value + "\n" + "Valor de pago (D\xE9bito):  " + document.form_bank.valor_pago.value + "\n" + "Descripci\xF3n: " + document.form_bank.descripcion.value ))  {
		    document.form_bank.action = "includes/mod_registro_bancario_functions.php?data=send";
		    document.form_bank.submit();
		} else {
			return (false);  
		}  
				  
	} else if ( tipo_transaccion == 'credito' ) {  
			  
			   if (confirm("Si son correctos los datos, por favor acepte \n\n" + "Fecha:  " + document.form_bank.fecha.value + "\n" + "Valor del dep\xF3sito (Cr\xE9dito):  " + document.form_bank.valor_deposito.value + "\n" + "Descripci\xF3n: " + document.form_bank.descripcion.value ))  {
		           document.form_bank.action = "includes/mod_registro_bancario_functions.php?data=send";
		           document.form_bank.submit();
		       } else {
				    return (false);  
			   }  
			 	  
	 }
			   
   }  // Fin de la función send_bankform()
     
//10
   function send_mesform()
   {
	   // Función que envía el formulario que selecciona el mes y el año del cual quiero ver los registros.
	   document.form_mes.action = "index.php?mod=mod_registro_bancario&optionrb=consulta&mesano=send#tabs-5";
	   document.form_mes.submit();
	   
   }  // Fin de la función send_mesform()        
		 	   
//11 
   function inicio_rb_button(tipo_var) 
   {
	   // Función del botón de ir al inicio del Módulo y al botón imprimir.
       switch(tipo_var)
	   {
		  case 'inicio': 
	         document.location.href = 'index.php?mod=mod_registro_bancario#tabs-5';
          break;
	   } // Fin del switch.
   }  // Fin de la función inicio_rb_button()
                                                         /*******---- módulo cuentas x pagar---*******/
//12
   function send_mes_cuentas_x_pagar()
   {
	 // Función que envía el formulario que selecciona mes y año para ver las cuentas x pagar.  
	 
	 //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE COMPRA.
	 if ( document.form_cuentas_x_pagar.fecha_registro.value == "" )  {
	     alert('Por favor introduzca la Fecha del Registro. GRACIAS');
		 document.form_cuentas_x_pagar.fecha_registro.focus();
		 return(false);   
     } 
	 
	 //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DE PROVEEDOR.
	 if ( document.form_cuentas_x_pagar.proveedor.value == "" || document.form_cuentas_x_pagar.proveedor.value == "No hay resultado para esa entrada" )  {
	     alert('Por favor introduzca el PROVEEDOR para el registro que desea insertar. GRACIAS');
		 document.form_cuentas_x_pagar.proveedor.focus();
		 return(false);   
     } 
	   
	 //(3) VERIFICO QUE EL PROVEEDOR SELECCIONADO SEA UNO DE LOS QUE ESTÁ EN LA BD.
	 if ( document.form_cuentas_x_pagar.proveedor_id.value == "" )  {
	     alert('Por favor introduzca el PROVEEDOR PERMITIDO para el registro que desea insertar. GRACIAS');
		 document.form_cuentas_x_pagar.proveedor.focus();
		 return(false);   
     }
	 
	 //(4) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL VALOR QUE DEBO PAGAR Y VERIFICO QUE SEA NÚMERO.
	 if ( document.form_cuentas_x_pagar.valor_abono.value == "" )  {
		    alert('Por favor introduzca el valor del ABONO que tendrá en su Registro. GRACIAS');
			document.form_cuentas_x_pagar.valor_abono.focus();
			return(false);
	 } else if ( isNaN(document.form_cuentas_x_pagar.valor_abono.value) )  { 
			alert('Por favor introduzca un valor num\xE9rico en el campo Valor de Abono($). GRACIAS');
			document.form_cuentas_x_pagar.valor_abono.focus(); 
			return(false);
	 }
	
	 //(5) VERIFICO QUE EXISTA ALGO EN EL CAMPO DE DETALLE DEL REGISTRO.
	 if ( document.form_cuentas_x_pagar.detalle_registro.value == " " )  {
	     alert('Por favor introduzca el DETALLE para el registro que desea insertar. GRACIAS');
		 document.form_cuentas_x_pagar.detalle_registro.focus();
		 return(false);   
     } 
	
	 //(6) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE VENCIMIENTO.
	 if ( document.form_cuentas_x_pagar.fecha_vencimiento.value == "" )  {
	     alert('Por favor introduzca la Fecha de vencimiento del Registro que desea insertar. GRACIAS');
		 document.form_cuentas_x_pagar.fecha_vencimiento.focus();
		 return(false);   
     }
	
	 //(7) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	 if (confirm("Si son correctos los datos, por favor acepte \n\n" + "Fecha de Registro: " + document.form_cuentas_x_pagar.fecha_registro.value + "\n" + "Proveedor: " + document.form_cuentas_x_pagar.proveedor.value + "\n" + "Valor del Abono: " + document.form_cuentas_x_pagar.valor_abono.value + "\n" + "Detalle: " + document.form_cuentas_x_pagar.detalle_registro.value + "\n" + "Fecha de vencimiento: " + document.form_cuentas_x_pagar.fecha_vencimiento.value ))  {
		    document.form_cuentas_x_pagar.action = "includes/mod_cuentas_x_pagar_functions.php?data=send";
		    document.form_cuentas_x_pagar.submit();
	 } else {
			return (false);  
	 }  
			
	}   // fin de la function send_mes_cuentas_x_pagar()
    
//13.
   function able_valor_abonar()
   {
	   // Función que activa la casilla de valor a abonar de un registro (cuentas x pagar)
	  
	 var valor_a_abonar = document.getElementById('valor_act_abono');
	 var origen_de_pago = document.getElementById('origen_pago_cxp');
	 
	 origen_de_pago.disabled = "";
	 
	 valor_a_abonar.value = "";
	 valor_a_abonar.disabled = "";
						
	 document.form_edit_cuentas_x_pagar.valor_act_abono.focus();  
	  
   }  // fin de la function able_valor_abonar()
     
//14
   function disable_valor_abonar()
   {
	   // Función que desactiva la casilla de valor a abonar de un registro (cuentas x pagar)
	  
	 var valor_a_abonar = document.getElementById('valor_act_abono');
	 var origen_de_pago = document.getElementById('origen_pago_cxp');
	 
	 origen_de_pago.disabled = "";
	 
	 valor_a_abonar.value = "";
	 valor_a_abonar.disabled = "disabled";
					
	 return(false);
	    
   }  // fin de la function able_valor_abonar()
      
//15
   function send_edit_mes_cuentas_x_pagar() 
   {
	   // Función que envía el formulario de edición de los datos de un registro (verifica los campos).
	  	  
	    /* Lo mismo de la función send_mes_cuentas_x_pagar hasta el //(5) */ 
	 //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE COMPRA.
	 if ( document.form_edit_cuentas_x_pagar.fecha_registro.value == "" )  {
	     alert('Por favor introduzca la Fecha del Registro. GRACIAS');
		 document.form_edit_cuentas_x_pagar.fecha_registro.focus();
		 return(false);   
     } 
	 
	 //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DE PROVEEDOR.
	 if ( document.form_edit_cuentas_x_pagar.proveedor.value == "" || document.form_edit_cuentas_x_pagar.proveedor.value == "No hay resultado para esa entrada" )  {
	     alert('Por favor introduzca el PROVEEDOR para el registro que desea editar. GRACIAS');
		 document.form_cuentas_x_pagar.proveedor.focus();
		 return(false);   
     } 
	 
	 //(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO proveedor_id QUE ME CONFIRMA QUE EL PROVEEDOR ES DE LA BD.
	 if ( document.form_edit_cuentas_x_pagar.proveedor_id.value == "" )  {
	     alert('Por favor introduzca un PROVEEDOR que exista en la Base de Datos. GRACIAS');
		 document.form_edit_cuentas_x_pagar.proveedor.focus();
		 return(false);   
     } 
	   
	 //(4) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL VALOR QUE DEBO PAGAR Y VERIFICO QUE SEA NÚMERO.
	 if ( document.form_edit_cuentas_x_pagar.valor_abono.value == "" )  {
		    alert('Por favor introduzca el valor del ABONO que tendrá en su Registro. GRACIAS');
			document.form_edit_cuentas_x_pagar.valor_abono.focus();
			return(false);
	 } else if ( isNaN(document.form_edit_cuentas_x_pagar.valor_abono.value) )  { 
			alert('Por favor introduzca un valor num\xE9rico en el campo Valor de Abono($). GRACIAS');
			document.form_edit_cuentas_x_pagar.valor_abono.focus(); 
			return(false);
	 }
	
	 //(5) VERIFICO QUE EXISTA ALGO EN EL CAMPO DE DETALLE DEL REGISTRO.
	 if ( document.form_edit_cuentas_x_pagar.detalle_registro.value == " " )  {
	     alert('Por favor introduzca el DETALLE para el registro que desea insertar. GRACIAS');
		 document.form_edit_cuentas_x_pagar.detalle_registro.focus();
		 return(false);   
     } 
	
	 //(6) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE VENCIMIENTO.
	 if ( document.form_edit_cuentas_x_pagar.fecha_vencimiento.value == "" )  {
	     alert('Por favor introduzca la Fecha de vencimiento del Registro que desea insertar. GRACIAS');
		 document.form_edit_cuentas_x_pagar.fecha_vencimiento.focus();
		 return(false);   
     }
     
     //(7) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE ACTUALIZACIÓN
     if ( document.form_edit_cuentas_x_pagar.fecha_actualizacion.value == "" )  {
	     alert('Por favor introduzca la Fecha de de Actualizaci\xF3n del Registro que desea actualizar. GRACIAS');
		 document.form_edit_cuentas_x_pagar.fecha_actualizacion.focus();
		 return(false);   
     }
   
     //(8) VERIFICO QUE ESTÉ SELECCIONADO ALGUNO DE LOS 2 RADIOBOTONES.
	 if ( document.getElementById('radio_abonar_parte').checked == 1 )  {
	    
		 if ( document.form_edit_cuentas_x_pagar.valor_act_abono.value == "" )  {
		     alert('Por favor introduzca el valor a abonar en este Pago. GRACIAS');
			 document.form_edit_cuentas_x_pagar.valor_act_abono.focus();
			 return(false);
	     } else if ( isNaN(document.form_edit_cuentas_x_pagar.valor_act_abono.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el valor de Pago a abonar. GRACIAS');
			 document.form_edit_cuentas_x_pagar.valor_act_abono.focus();
			 return(false);
		 }
	
	 } else if ( document.getElementById('radio_abonar_todo').checked == 1 )  {
	
	     // Aquí no pasa nada 
		 
	 } else {
	     // Cuando no seleccione ninguna de las dos opciones de PAGO
	     alert('Por favor seleccione alguna de las dos opciones de abono. GRACIAS');	 
		 return(false);
	 }
     
     //(9) VERIFICO QUE NO ESTÉ SELECCIONADA LA OPCIÓN 'seleccione' EN EL 'ORIGEN DEL PAGO'
     if ( document.form_edit_cuentas_x_pagar.origen_pago.value == "seleccione" )  {
	     alert('Por favor introduzca un Origen de Pago v\xE1lido. GRACIAS');
		 document.form_edit_cuentas_x_pagar.origen_pago.focus();
		 return(false);   
     }
      
     //(10) VERIFICO QUE EXISTA ALGO ESCRITO EN EL DETALLE DE ACTUALIZACIÓN
     if ( document.form_edit_cuentas_x_pagar.detalle_edit.value == "" )  {
	     alert('Por favor introduzca algun detalle para el Registro que desea actualizar. GRACIAS');
		 document.form_edit_cuentas_x_pagar.detalle_edit.focus();
		 return(false);   
     }
        
	 //(11) VERIFICO QUE EL VALOR ABONAR SEA MENOR O IGUAL AL SALDO QUE FALTA POR ABONAR EN ESE REGISTRO	 
	 var saldo = document.form_edit_cuentas_x_pagar.valor_saldo.value;
	 var valor_a_abonar = document.form_edit_cuentas_x_pagar.valor_act_abono.value;
	 var Saldo = parseFloat(saldo);
	 var Valor_a_abonar = parseFloat(valor_a_abonar);
	 	 
	 if ( Valor_a_abonar > Saldo )  {
		 // ESTO SIGNIFICA QUE ES MAYOR LOS QUE DEBO PAGAR QUE LO QUE REALMENTE NECESITO PAGAR
	     alert('Disculpe!' + '\n' + 'Usted va a abonar m\xE1s de lo que realmente debe.' + '\n' + 'Por favor rectifique en el campo "Valor a Abonar($)"' + '\n' + 'GRACIAS');
	     document.form_edit_cuentas_x_pagar.valor_act_abono.focus();
		 return(false);
	 }
	 
	 //(12) ENVÍO MENSAJE DE CONFIRMACIÓN PARA LOS DATOS INTRODUCIDOS POR EL USUARIO
	 //(12.1) Primero preparo el valor que voy a poner en "Valor a Abonar"
	 if ( document.form_edit_cuentas_x_pagar.valor_act_abono.disabled )  {
		 
		 var valor_a_abonar = document.form_edit_cuentas_x_pagar.valor_saldo.value;
	     	 
	 } else {
		 
		 var valor_a_abonar = document.form_edit_cuentas_x_pagar.valor_act_abono.value;
		 
	 }
	 	 
	 if (confirm("Si son correctos los datos de actualizaci\xF3n del Registro, por favor acepte \n\n" + "Fecha de Actualizaci\xF3n: " + document.form_edit_cuentas_x_pagar.fecha_actualizacion.value + "\n" + "Valor a Abonar: " + valor_a_abonar + "\n" + "Origen del Pago: " + document.form_edit_cuentas_x_pagar.origen_pago.options[document.form_edit_cuentas_x_pagar.origen_pago.selectedIndex].text + "\n" + "Detalle de Actualizaci\xF3n: " + document.form_edit_cuentas_x_pagar.detalle_edit.value ))  {
		     document.form_edit_cuentas_x_pagar.action = "includes/mod_cuentas_x_pagar_functions.php?data=edit";
             document.form_edit_cuentas_x_pagar.submit();
	 } else {
			return (false);  
	 }  
	    
   }  // Fin de la function send_edit_mes_cuentas_x_pagar() 
      
//16. 
   function send_mesano_cuentas_x_pagar()   
   {
    //Función que envía el formulario que selecciona el mes y el año del cual quiero ver los registros de las cuentas por pagar.    
	   document.form_mes_cxpagar.action = "index.php?mod=mod_cuentas_x_pagar&optioncxp=consulta&mesanocxp=send#tabs-3";
	   document.form_mes_cxpagar.submit();
	
   }  // Fin de la function send_mesano_cuentas_x_pagar() 
   
//17.
   function inicio_cxp_button()
   {
	   // Función del botón de ir al inicio del Módulo. 
       document.location.href = 'index.php?mod=mod_cuentas_x_pagar#tabs-3';
   
   } // Fin de la función inicio_cxp_button()
                                                                   /*******---- módulo proveedores---*******/   
//18. 
   function send_proveedores()
   {
	  // Función que procesa los datos del proveedor enviado por el usuario 
    
      //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE REGISTRO.
	  if ( document.form_proveedor.fecha_registro_proveedor.value == "" )  {
	      alert('Por favor introduzca la Fecha del Registro. GRACIAS');
		  document.form_proveedor.fecha_registro_proveedor.focus();
		  return(false);   
      } 
      
      //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL NOMBRE DEL PROVEEDOR.
	  if ( document.form_proveedor.nombre_proveedor.value == "" )  {
	      alert('Por favor introduzca el Nombre del Proveedor. GRACIAS');
		  document.form_proveedor.nombre_proveedor.focus();
		  return(false);   
      } 
   
      //(3) La DIRECCIÓN, RUC, TELEFONO, FAX, EMAIL del proveedor NO es necesario que esté llena  
      //    Por tanto verifico la descripción del proveedor.  
      if ( document.form_proveedor.descripcion_proveedor.value == "" )  {
	      alert('Por favor introduzca una breve Descripci\xF3n del Proveedor. GRACIAS');
		  document.form_proveedor.descripcion_proveedor.focus();
		  return(false);   
      }
          
      //(4) Confirmo si desea enviar los datos de la bd al archivo que procesa 
	  if (confirm("Si son correctos los datos del nuevo Proveedor, por favor acepte \n\n" + "Fecha de Registro: " + document.form_proveedor.fecha_proveedor.value + "\n" + "Nombre del Proveedor: " + document.form_proveedor.nombre_proveedor.value + "\n" + "Direcci\xF3n del Proveedor: " + document.form_proveedor.direccion_proveedor.value + "\n" + "RUC del Proveedor: " + document.form_proveedor.ruc_proveedor.value + "\n" + "Tel\xE9fono del Proveedor: " + document.form_proveedor.telefono_proveedor.value + "\n" + "Fax del Proveedor: " + document.form_proveedor.fax_proveedor.value + "\n" + "Email del Proveedor: " + document.form_proveedor.email_proveedor.value + "\n" + "C\xE9dula del Proveedor: " + document.form_proveedor.cedula_proveedor.value + "\n" + "Descripci\xF3n del Proveedor: " + document.form_proveedor.descripcion_proveedor.value 
	   ))  {
		     if ( document.form_proveedor.cliente_select.checked == 1 )  {
			     // Esto significa que el PROVEEDOR es también CLIENTE
			     if ( confirm("Alerta!! Usted ha seleccionado a este Proveedor como su Cliente. \nSi es verdadera esta afirmaci\xF3n, por favor acepte \n\n"))   {  
				 document.form_proveedor.action = "includes/mod_proveedores_functions.php?data=new";
                 document.form_proveedor.submit();
				 } else {
				     return (false);	 
				 }
		     } 
	 
	      document.form_proveedor.action = "includes/mod_proveedores_functions.php?data=new";
          document.form_proveedor.submit();
	 
	 	 
	 } else {
			return (false);  
	 }
   
   }   // Fin a la function send_proveedores()
   
//19. 
   function edit_proveedores() 
   {
	   // función que envía a procesar un proveedor cuando se va a EDITAR.
   
      //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE REGISTRO.
	  if ( document.form_proveedor.fecha_registro_proveedor.value == "" )  {
	      alert('Por favor introduzca la Fecha del Registro. GRACIAS');
		  document.form_proveedor.fecha_registro_proveedor.focus();
		  return(false);   
      } 
      
      //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL NOMBRE DEL PROVEEDOR.
	  if ( document.form_proveedor.nombre_proveedor.value == "" )  {
	      alert('Por favor introduzca el Nombre del Proveedor. GRACIAS');
		  document.form_proveedor.nombre_proveedor.focus();
		  return(false);   
      } 
   
      //(3) La DIRECCIÓN, RUC, TELEFONO, FAX, EMAIL del proveedor NO es necesario que esté llena  
      //    Por tanto verifico la descripción del proveedor.  
      if ( document.form_proveedor.descripcion_proveedor.value == "" )  {
	      alert('Por favor introduzca una breve Descripci\xF3n del Proveedor. GRACIAS');
		  document.form_proveedor.descripcion_proveedor.focus();
		  return(false);   
      }
          
      //(5) Confirmo si desea enviar los datos de la bd al archivo que procesa 
	  if (confirm("Si son correctos los datos de actualizaci\xF3n del Registro, por favor acepte \n\n" + "Fecha de Registro: " + document.form_proveedor.fecha_registro_proveedor.value + "\n" + "Nombre del Proveedor: " + document.form_proveedor.nombre_proveedor.value + "\n" + "Direcci\xF3n del Proveedor: " + document.form_proveedor.direccion_proveedor.value + "\n" + "RUC del Proveedor: " + document.form_proveedor.ruc_proveedor.value + "\n" + "Tel\xE9fono del Proveedor: " + document.form_proveedor.telefono_proveedor.value + "\n" + "Fax del Proveedor: " + document.form_proveedor.fax_proveedor.value + "\n" + "Email del Proveedor: " + document.form_proveedor.email_proveedor.value + "\n" + "C\xE9dula del Proveedor: " + document.form_proveedor.cedula_proveedor.value + "\n" + "Descripci\xF3n del Proveedor: " + document.form_proveedor.descripcion_proveedor.value 
	   ))  {
		     if ( document.form_proveedor.cliente_select.checked == 1 )  {
			     // Esto significa que el PROVEEDOR es también CLIENTE
			     if ( confirm("Alerta!! Usted ha seleccionado a este Proveedor como su Cliente. \nSi es verdadera esta afirmaci\xF3n, por favor acepte \n\n"))   {  
				 document.form_proveedor.action = "includes/mod_proveedores_functions.php?data=edit";
                 document.form_proveedor.submit();
				 } else {
				     return (false);	 
				 }
		     } 
	 
	      document.form_proveedor.action = "includes/mod_proveedores_functions.php?data=edit";
          document.form_proveedor.submit();
	 	 	 
	 } else {
			return (false);  
	 }
        
   } // Fin de la function edit_proveedores() 
     
//20.
   function submitbutton(variable)   
   {
	   // Función que me muesttra una acción diferente de acuerdo al valor del la variable 'variable' (BOTONES SUPERIORES)
       
       //01 Inicializo variables
	   var contador = 0;                       // Contador para cuando el elemnto radio no está checked
	   var contador_elementos_radio = 0;       // Contador para todos los elementos radio
	   var id_value;                           // Valor donde almaceno el valor del id del registro selecionado.
	   
	   //02 Hago un switch de la variable 'variable'
	   switch(variable)
	   {
	   case 'new':
	         if ( confirm("\xBFEst\xE1 seguro que desea agregar un nuevo Proveedor? \n\n" ) )  {
		         location.href = "index.php?mod=mod_proveedores&option=new#tabs-2";
	         } else {
			     return(false);  
	         }
		     break;
	   	   
	   case 'ver':
	         //(1) VERIFICO QUE EXISTA AL MENOS UN RADIO BOTÓN SELECCIONADO 
	           
			  for ( i=0; i < document.proveedores_radios.elements.length; i++ ) 
	          {
	               if ( document.proveedores_radios.elements[i].type == "radio")	 {
			           contador_elementos_radio++;
					   if (document.proveedores_radios.elements[i].checked == 0 )  {
				           contador++;
				           continue;  
			           } else {
			               id_value = document.proveedores_radios.elements[i].value;
						   break;  
			           }
		           }
	          }  // Fin del FOR
		
		      //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
			  if ( contador_elementos_radio == contador )  {
				  // Esto significa que no se seleccionó ningún radio botón.
			      alert('Por favor seleccione el registro que desea VER');
			      return (false);
			  } else {
				  //(3) MUESTRO LA url PARA VER EL PROVEEDOR SELECCIONADO
				  location.href = "index.php?mod=mod_proveedores&option=ver&id=" + id_value + "#tabs-2";
				  
			  }
			 	 
			 break;
	   	   
	   case	'edit':
	         if ( confirm("\xBFEst\xE1 seguro que desea editar el Proveedor seleccionado? \n\n" ) )  {
		                  
			     for ( i=0; i < document.proveedores_radios.elements.length; i++ ) 
	             {
	                  if ( document.proveedores_radios.elements[i].type == "radio")	 {
			              contador_elementos_radio++;
					      if (document.proveedores_radios.elements[i].checked == 0 )  {
				              contador++;
				              continue;  
			              } else {
			                  id_value = document.proveedores_radios.elements[i].value;
						       break;  
			              }
		              }
	             }  // Fin del FOR
		
		         //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
			     if ( contador_elementos_radio == contador )  {
				     // Esto significa que no se seleccionó ningún radio botón.
			         alert('Por favor seleccione el registro que desea EDITAR');
			         return (false);
			     } else {
				      //(3) MUESTRO LA url PARA VER EL PROVEEDOR SELECCIONADO
				     location.href = "index.php?mod=mod_proveedores&option=edit&id=" + id_value + "#tabs-2";
				  			  
			     }
			 			 		 
			 } else {
			     return(false);  
	         }
	         break;
	   
	   case 'delete':
	         if ( confirm("\xBFEst\xE1 seguro que desea borrar el Proveedor seleccionado? \n\n" ) )  {
		         				 
				 for ( i=0; i < document.proveedores_radios.elements.length; i++ ) 
	             {
	                  if ( document.proveedores_radios.elements[i].type == "radio")	 {
			              contador_elementos_radio++;
					      if (document.proveedores_radios.elements[i].checked == 0 )  {
				              contador++;
				              continue;  
			              } else {
			                  id_value = document.proveedores_radios.elements[i].value;
						      break;  
			              }
		              }
	             }  // Fin del FOR
		
		         //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
			     if ( contador_elementos_radio == contador )  {
				     // Esto significa que no se seleccionó ningún radio botón.
			         alert('Por favor seleccione el registro que desea BORRAR');
			         return (false);
			     } else {
				      //(3) MUESTRO LA url PARA VER EL PROVEEDOR SELECCIONADO
				     document.proveedores_radios.action = "includes/mod_proveedores_functions.php?delete=" + id_value;
					 document.proveedores_radios.submit();
					 
					 //location.href = "index.php?mod=mod_proveedores&option=edit&id=" + id_value + "#tabs-2";
				  			  
			     }
	         } else {
			     return(false);  
	         }
	         break;
	     
	   case 'inicio':      
			 location.href = "index.php?mod=mod_proveedores#tabs-2";
			 
			 break;	 	 
	   	   
	   }  // Fin del switch
     
   }   // FIN DE LA function action_prov('var') 
      
//21. 
   function send_contacto() 
   {
	   // Función que envía a procesar una contacto de un proveedor.   
       //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO NOMBRE DE CONTACTO.
	  if ( document.add_contacto.nombre_contacto.value == "" )  {
	      alert('Por favor introduzca el Nombre del Contacto. GRACIAS');
		  document.add_contacto.nombre_contacto.focus();
		  return(false);   
      } 
         
      //(2) Confirmo si desea enviar los datos de la bd al archivo que procesa 
	  if (confirm("Est\xE1 seguro que desea agregar este contacto para el Proveedor " + document.form_proveedor.nombre_proveedor.value + "\n\n" + "Si son correctos los datos del nuevo Contacto, por favor acepte. \n\n" + "Nombre de Contacto: " + document.add_contacto.nombre_contacto.value + "\n" + "Tel\xE9fono del Contacto: " + document.add_contacto.telefono_contacto.value + "\n" + "Celular del Contacto: " + document.add_contacto.cell_contacto.value + "\n" + "Fax del Contacto: " + document.add_contacto.fax_contacto.value + "\n" + "Email del Contacto: " + document.add_contacto.email_contacto.value + "\n" + "C\xE9dula del Contacto: " + document.add_contacto.cedula_contacto.value
	   ))  {
		     
		  document.add_contacto.action = "includes/mod_proveedores_functions.php?contacto=new";
          document.add_contacto.submit();
	 
	 } else {
			return (false);  
	 }
        
   }  // Fin de la  function send_contacto()
    
//22. 
   function eliminar_contactos()
   { 
       //  Función elimina los contactos seleccionados en el checkbos por el usuario   
      var contador_elementos_checkbox = 0;  // Contador de los elementos checkbox de la tabla
	  var contador = 0;                     // Contador de los checkboxes sin marcar                 
	   
	  if (confirm("Est\xE1 seguro que desea eliminar los contactos seleccionados  \n\n" ))  {
		  
		  // Ahora busco si hay seleccionado algún checkbox   
		  for ( i=0; i < document.form_delete_contactos.elements.length; i++ ) 
	      {
	          if ( document.form_delete_contactos.elements[i].type == "checkbox")	 {
			      contador_elementos_checkbox++;
			      if (document.form_delete_contactos.elements[i].checked == 0 )  {
				      contador++;
				      continue;  
			      } else {
			          break;  
			      }
		     }
	      }  // Fin del FOR
		
		  //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
		  if ( contador_elementos_checkbox == contador )  {
		     // Esto significa que no se seleccionó ningún checkbox.
			 alert('Usted no ha selecionado ningun contacto. \nPor favor seleccione algun contacto a eliminar. GRACIAS');
			 return (false);
          } else {
			 // envío el formulario con los checkboxes marcados
			 document.form_delete_contactos.action = "includes/mod_proveedores_functions.php?contacto=delete";
             document.form_delete_contactos.submit();
				  
	      }
	 
	 } else {
		  return (false);  
	 } 
      
   }  // Fin de la function eliminar_contactos()
      
//23.   
   function show_campos(data)
   {
	  // Función que se llama cuando la petición ajax se ha completado correctamente.
	  //01 Con esto se almacena el JSON en una variable Javascript, sin almacenar la propia cadena, sino el objeto que representa, variable, operador punto y luego el nombre de la propiedad a acceder.
	  data = eval(data);  
	  
	  //02 Esto es lo que pongo en el formulario de CONTACTO, de la respuesta en json de la peticion ajax a edit_contact.php
	   document.edit_contacto.id_c.value = data.id; 
	   document.edit_contacto.nombre_contacto.value = data.nombre_contacto;   
	   document.edit_contacto.telefono_contacto.value = data.telefono_contacto;  
       document.edit_contacto.cell_contacto.value = data.cell_contacto;  
       document.edit_contacto.fax_contacto.value = data.fax_contacto;
       document.edit_contacto.email_contacto.value = data.email_contacto;
       document.edit_contacto.cedula_contacto.value = data.cedula_contacto;
   
   }  // Fin de la function show_campos(data)  
      
//24.
   function editar_contacto()
   {
	   // Función que permite un UPDATE en la BD del contacto seleccionado.    
      //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO NOMBRE DE CONTACTO.
	  if ( document.edit_contacto.nombre_contacto.value == "" )  {
	      alert('Por favor introduzca el Nombre del Contacto. GRACIAS');
		  document.edit_contacto.nombre_contacto.focus();
		  return(false);   
      } 
      
      //(2) Confirmo si desea enviar los datos de la bd al archivo que procesa 
	  if (confirm("Est\xE1 seguro que estos son los nuevos datos del contacto del Proveedor " + document.form_proveedor.nombre_proveedor.value + "\n\n" + "Si son correctos los datos de este Contacto, por favor acepte. \n\n" + "Nombre de Contacto: " + document.edit_contacto.nombre_contacto.value + "\n" + "Tel\xE9fono del Contacto: " + document.edit_contacto.telefono_contacto.value + "\n" + "Celular del Contacto: " + document.edit_contacto.cell_contacto.value + "\n" + "Fax del Contacto: " + document.edit_contacto.fax_contacto.value + "\n" + "Email del Contacto: " + document.edit_contacto.email_contacto.value + "\n" + "C\xE9dula del Contacto: " + document.edit_contacto.cedula_contacto.value
	   ))  {
		     
		  document.edit_contacto.action = "includes/mod_proveedores_functions.php?contacto=edit";
          document.edit_contacto.submit();
	 
	 } else {
			return (false);  
	 }
        
   }  // Fin de la function edit_contacto()
   
   /**************************************************************************************************************
                                               MÓDULO CLIENTES
   ****************************************************************************************************************/
 
//25. 
   function send_clientes()
   {
	  // Función que procesa los datos del cliente enviado por el usuario 
      //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE REGISTRO.
	  if ( document.form_cliente.fecha_registro_cliente.value == "" )  {
	      alert('Por favor introduzca la Fecha del Registro del nuevo Cliente. GRACIAS');
		  document.form_cliente.fecha_registro_cliente.focus();
		  return(false);   
      } 
      
      //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL NOMBRE DEL CLIENTE.
	  if ( document.form_cliente.nombre_cliente.value == "" )  {
	      alert('Por favor introduzca el Nombre del Cliente. GRACIAS');
		  document.form_cliente.nombre_cliente.focus();
		  return(false);   
      } 
   
      //(3) La DIRECCIÓN, RUC, TELEFONO, FAX, EMAIL del cliente NO es necesario que esté llena  
      //    Por tanto verifico la descripción del cliente.  
      if ( document.form_cliente.descripcion_cliente.value == "" )  {
	      alert('Por favor introduzca una breve Descripci\xF3n del Cliente. GRACIAS');
		  document.form_cliente.descripcion_cliente.focus();
		  return(false);   
      }
          
      //(5) Confirmo si desea enviar los datos de la bd al archivo que procesa 
	  if (confirm("Si son correctos los datos del nuevo Cliente, por favor acepte \n\n" + "Fecha de Registro: " + document.form_cliente.fecha_registro_cliente.value + "\n" + "Nombre del Cliente: " + document.form_cliente.nombre_cliente.value + "\n" + "Direcci\xF3n del Cliente: " + document.form_cliente.direccion_cliente.value + "\n" + "RUC del Cliente: " + document.form_cliente.ruc_cliente.value + "\n" + "Tel\xE9fono del Cliente: " + document.form_cliente.telefono_cliente.value + "\n" + "Fax del Cliente: " + document.form_cliente.fax_cliente.value + "\n" + "Email del Cliente: " + document.form_cliente.email_cliente.value + "\n" + "C\xE9dula del Cliente: " + document.form_cliente.cedula_cliente.value + "\n" + "Descripci\xF3n del Cliente: " + document.form_cliente.descripcion_cliente.value 
	   ))  {
		     if ( document.form_cliente.proveedor_select.checked == 1 )  {
			     // Esto significa que el CLIENTE es también PROVEEDOR
			     if ( confirm("Alerta!! Usted ha seleccionado a este Cliente como su Proveedor. \nSi es verdadera esta afirmaci\xF3n, por favor acepte \n\n"))   {  
				 document.form_cliente.action = "includes/mod_clientes_functions.php?data=new";
                 document.form_cliente.submit();
				 } else {
				     return (false);	 
				 }
		     } 
	 
	      document.form_cliente.action = "includes/mod_clientes_functions.php?data=new";
          document.form_cliente.submit();
	 	 	 
	 } else {
			return (false);  
	 }
   
   }   // Fin a la function send_clientes()
      
//26.
   function edit_clientes() 
   {
	   // función que envía a procesar un cliente cuando se va a EDITAR.
   
      //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE REGISTRO.
	  if ( document.form_cliente.fecha_registro_cliente.value == "" )  {
	      alert('Por favor introduzca la Fecha del Registro. GRACIAS');
		  document.form_cliente.fecha_registro_cliente.focus();
		  return(false);   
      } 
      
      //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL NOMBRE DEL PROVEEDOR.
	  if ( document.form_cliente.nombre_cliente.value == "" )  {
	      alert('Por favor introduzca el Nombre del Cliente. GRACIAS');
		  document.form_cliente.nombre_cliente.focus();
		  return(false);   
      } 
   
      //(3) La DIRECCIÓN, RUC, TELEFONO, FAX, EMAIL del proveedor NO es necesario que esté llena  
      //    Por tanto verifico la descripción del proveedor.  
      if ( document.form_cliente.descripcion_cliente.value == "" )  {
	      alert('Por favor introduzca una breve Descripci\xF3n del Cliente. GRACIAS');
		  document.form_cliente.descripcion_cliente.focus();
		  return(false);   
      }
          
      //(4) Confirmo si desea enviar los datos de la bd al archivo que procesa 
	  if (confirm("Si son correctos los datos de actualizaci\xF3n del Registro, por favor acepte \n\n" + "Fecha de Registro: " + document.form_cliente.fecha_registro_cliente.value + "\n" + "Nombre del Cliente: " + document.form_cliente.nombre_cliente.value + "\n" + "Direcci\xF3n del Cliente: " + document.form_cliente.direccion_cliente.value + "\n" + "RUC del Cliente: " + document.form_cliente.ruc_cliente.value + "\n" + "Tel\xE9fono del Cliente: " + document.form_cliente.telefono_cliente.value + "\n" + "Fax del Cliente: " + document.form_cliente.fax_cliente.value + "\n" + "Email del Cliente: " + document.form_cliente.email_cliente.value + "\n" + "C\xE9dula del Cliente: " + document.form_cliente.cedula_cliente.value + "\n" + "Descripci\xF3n del Cliente: " + document.form_cliente.descripcion_cliente.value 
	   ))  {
		     if ( document.form_cliente.proveedor_select.checked == 1 )  {
			     // Esto significa que el CLIENTE es también PROVEEDOR
			     if ( confirm("Alerta!! Usted ha seleccionado a este Cliente como su Proveedor. \nSi es verdadera esta afirmaci\xF3n, por favor acepte \n\n"))   {  
				 document.form_cliente.action = "includes/mod_clientes_functions.php?data=editar";
                 document.form_cliente.submit();
				 } else {
				     return (false);	 
				 }
		     } 
	 
	      document.form_cliente.action = "includes/mod_clientes_functions.php?data=editar";
          document.form_cliente.submit();
	 	 	 
	 } else {
			return (false);  
	 }
        
   }  // Fin de la function edit_clientes() 
     
//27.
   function submitboton(variable)   
   {
	   // Función que me muestra una acción diferente de acuerdo al valor del la variable 'variable' (BOTONES SUPERIORES)
       
       //01 Inicializo variables
	   var contador = 0;                       // Contador para cuando el elemnto radio no está checked
	   var contador_elementos_radio = 0;       // Contador para todos los elementos radio
	   var id_value;                           // Valor donde almaceno el valor del id del registro selecionado.
	   
	   //02 Hago un switch de la variable 'variable'
	   switch(variable)
	   {
	   case 'new':
	         if ( confirm("\xBFEst\xE1 seguro que desea agregar un nuevo Cliente? \n\n" ) )  {
		         location.href = "index.php?mod=mod_clientes&opt=new#tabs-1";
	         } else {
			     return(false);  
	         }
		     break;
	   	   
	   case 'ver':
	         //(1) VERIFICO QUE EXISTA AL MENOS UN RADIO BOTÓN SELECCIONADO 
	           
			  for ( i=0; i < document.clientes_radios.elements.length; i++ ) 
	          {
	               if ( document.clientes_radios.elements[i].type == "radio")	 {
			           contador_elementos_radio++;
					   if (document.clientes_radios.elements[i].checked == 0 )  {
				           contador++;
				           continue;  
			           } else {
			               id_value = document.clientes_radios.elements[i].value;
						   break;  
			           }
		           }
	          }  // Fin del FOR
		
		      //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
			  if ( contador_elementos_radio == contador )  {
				  // Esto significa que no se seleccionó ningún radio botón.
			      alert('Por favor seleccione el registro que desea VER');
			      return (false);
			  } else {
				  //(3) MUESTRO LA url PARA VER EL PROVEEDOR SELECCIONADO
				  location.href = "index.php?mod=mod_clientes&opt=ver&id=" + id_value + "#tabs-1";
				  
			  }
			 	 
			 break;
	   	   
	   case	'editar':
	         if ( confirm("\xBFEst\xE1 seguro que desea editar el Cliente seleccionado? \n\n" ) )  {
		                  
			     for ( i=0; i < document.clientes_radios.elements.length; i++ ) 
	             {
	                  if ( document.clientes_radios.elements[i].type == "radio")	 {
			              contador_elementos_radio++;
					      if (document.clientes_radios.elements[i].checked == 0 )  {
				              contador++;
				              continue;  
			              } else {
			                  id_value = document.clientes_radios.elements[i].value;
						       break;  
			              }
		              }
	             }  // Fin del FOR
		
		         //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
			     if ( contador_elementos_radio == contador )  {
				     // Esto significa que no se seleccionó ningún radio botón.
			         alert('Por favor seleccione el registro que desea EDITAR');
			         return (false);
			     } else {
				      //(3) MUESTRO LA url PARA VER EL CLIENTE SELECCIONADO
				     location.href = "index.php?mod=mod_clientes&opt=editar&id=" + id_value + "#tabs-1";
				   			  
			     }
			 		 		 
			 } else {
			     return(false);  
	         }
	         break;
	     
	   case 'delete':
	         if ( confirm("\xBFEst\xE1 seguro que desea borrar el Cliente seleccionado? \n\n" ) )  {
		         				 
				 for ( i=0; i < document.clientes_radios.elements.length; i++ ) 
	             {
	                  if ( document.clientes_radios.elements[i].type == "radio")	 {
			              contador_elementos_radio++;
					      if (document.clientes_radios.elements[i].checked == 0 )  {
				              contador++;
				              continue;  
			              } else {
			                  id_value = document.clientes_radios.elements[i].value;
						      break;  
			              }
		              }
	             }  // Fin del FOR
		
		         //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
			     if ( contador_elementos_radio == contador )  {
				     // Esto significa que no se seleccionó ningún radio botón.
			         alert('Por favor seleccione el registro que desea BORRAR');
			         return (false);
			     } else {
				      //(3) MUESTRO LA url PARA VER EL PROVEEDOR SELECCIONADO
				     document.clientes_radios.action = "includes/mod_clientes_functions.php?delete=" + id_value;
					 document.clientes_radios.submit();
					 
					 //location.href = "index.php?mod=mod_proveedores&option=edit&id=" + id_value + "#tabs-2";
				   			  
			     }
	         } else {
			     return(false);  
	         }
	         break;
	      
	   case 'inicio':      
			 location.href = "index.php?mod=mod_clientes#tabs-1";
			 
			 break;	 	 
	   	   
	   }  // Fin del switch
     
   }   // FIN DE LA function submitboton('var')    
     
//28. 
   function send_contacto_cliente() 
   {
	   // Función que envía a procesar una contacto de un cliente.   
       //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO NOMBRE DE CONTACTO.
	  if ( document.add_contacto_cliente.nombre_contacto.value == "" )  {
	      alert('Por favor introduzca el Nombre del Contacto. GRACIAS');
		  document.add_contacto_cliente.nombre_contacto.focus();
		  return(false);   
      } 
            
      //(2) Confirmo si desea enviar los datos de la bd al archivo que procesa 
	  if (confirm("Est\xE1 seguro que desea agregar este contacto para el Cliente " + document.form_cliente.nombre_cliente.value + "\n\n" + "Si son correctos los datos del nuevo Contacto, por favor acepte. \n\n" + "Nombre de Contacto: " + document.add_contacto_cliente.nombre_contacto.value + "\n" + "Tel\xE9fono del Contacto: " + document.add_contacto_cliente.telefono_contacto.value + "\n" + "Celular del Contacto: " + document.add_contacto_cliente.cell_contacto.value + "\n" + "Fax del Contacto: " + document.add_contacto_cliente.fax_contacto.value + "\n" + "Email del Contacto: " + document.add_contacto_cliente.email_contacto.value + "\n" + "C\xE9dula del Contacto: " + document.add_contacto_cliente.cedula_contacto.value
	   ))  {
		     
		  document.add_contacto_cliente.action = "includes/mod_clientes_functions.php?contacto=new";
          document.add_contacto_cliente.submit();
	 
	 } else {
			return (false);  
	 }
        
   }  // Fin de la  function send_contacto_cliente()
     
//29. 
   function eliminar_contactos_clientes()
   { 
       //  Función elimina los contactos seleccionados en el checkbos por el usuario   
      var contador_elementos_checkbox = 0;  // Contador de los elementos checkbox de la tabla
	  var contador = 0;                     // Contador de los checkboxes sin marcar                 
	   
	  if (confirm("Est\xE1 seguro que desea eliminar los contactos seleccionados  \n\n" ))  {
		  
		  // Ahora busco si hay seleccionado algún checkbox   
		  for ( i=0; i < document.form_delete_contactos_clientes.elements.length; i++ ) 
	      {
	          if ( document.form_delete_contactos_clientes.elements[i].type == "checkbox")	 {
			      contador_elementos_checkbox++;
			      if (document.form_delete_contactos_clientes.elements[i].checked == 0 )  {
				      contador++;
				      continue;  
			      } else {
			          break;  
			      }
		     }
	      }  // Fin del FOR
		
		  //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
		  if ( contador_elementos_checkbox == contador )  {
		     // Esto significa que no se seleccionó ningún checkbox.
			 alert('Usted no ha selecionado ningun contacto. \nPor favor seleccione algun contacto a eliminar. GRACIAS');
			 return (false);
          } else {
			 // envío el formulario con los checkboxes marcados
			 document.form_delete_contactos_clientes.action = "includes/mod_clientes_functions.php?contacto=delete";
             document.form_delete_contactos_clientes.submit();
				  
	      }
	 
	 } else {
		  return (false);  
	 } 
      
   }  // Fin de la function eliminar_contactos_clientes()
     
//30.   
   function show_campos_clientes(data)
   {
	  // Función que se llama cuando la petición ajax se ha completado correctamente.
	  //01 Con esto se almacena el JSON en una variable Javascript, sin almacenar la propia cadena, sino el objeto que representa, variable, operador punto y luego el nombre de la propiedad a acceder.
	  data = eval(data);  
	  
	  //02 Esto es lo que pongo en el formulario de CONTACTO, de la respuesta en json de la peticion ajax a edit_contact.php
	   document.edit_contacto_cliente.id_contacto.value = data.id; 
	   document.edit_contacto_cliente.nombre_contacto.value = data.nombre_contacto;   
	   document.edit_contacto_cliente.telefono_contacto.value = data.telefono_contacto;  
       document.edit_contacto_cliente.cell_contacto.value = data.cell_contacto;  
       document.edit_contacto_cliente.fax_contacto.value = data.fax_contacto;
       document.edit_contacto_cliente.email_contacto.value = data.email_contacto;
       document.edit_contacto_cliente.cedula_contacto.value = data.cedula_contacto;
   
   }  // Fin de la function show_campos(data)  
     
//31.
   function editar_contacto_cliente()
   {
	   // Función que permite un UPDATE en la BD del contacto seleccionado.    
      //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO NOMBRE DE CONTACTO.
	  if ( document.edit_contacto_cliente.nombre_contacto.value == "" )  {
	      alert('Por favor introduzca el Nombre del Contacto. GRACIAS');
		  document.edit_contacto_cliente.nombre_contacto.focus();
		  return(false);   
      } 
      
      //(2) Confirmo si desea enviar los datos de la bd al archivo que procesa 
	  if (confirm("Est\xE1 seguro que estos son los nuevos datos del contacto del Cliente " + document.form_cliente.nombre_cliente.value + "\n\n" + "Si son correctos los datos de este Contacto, por favor acepte. \n\n" + "Nombre de Contacto: " + document.edit_contacto_cliente.nombre_contacto.value + "\n" + "Tel\xE9fono del Contacto: " + document.edit_contacto_cliente.telefono_contacto.value + "\n" + "Celular del Contacto: " + document.edit_contacto_cliente.cell_contacto.value + "\n" + "Fax del Contacto: " + document.edit_contacto_cliente.fax_contacto.value + "\n" + "Email del Contacto: " + document.edit_contacto_cliente.email_contacto.value + "\n" + "C\xE9dula del Contacto: " + document.edit_contacto_cliente.cedula_contacto.value
	   ))  {
		     
		  document.edit_contacto_cliente.action = "includes/mod_clientes_functions.php?contacto=edit";
          document.edit_contacto_cliente.submit();
	 
	 } else {
			return (false);  
	 }
        
   }  // Fin de la function edit_contacto()
 
   /**************************************************************************************************************
                                               MÓDULO CUENTAS X COBRAR
   ****************************************************************************************************************/   
//32.
   function send_mes_cuentas_x_cobrar()
   {
	 // Función que envía el formulario que selecciona mes y año para ver las cuentas x cobrar.  
	 //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE REGISTRO.
	 if ( document.form_cuentas_x_cobrar.fecha_registro_cxc.value == "" )  {
	     alert('Por favor introduzca la Fecha del Registro. GRACIAS');
		 document.form_cuentas_x_cobrar.fecha_registro_cxc.focus();
		 return(false);   
     } 
	 
	 //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DE CLIENTE.
	 if ( document.form_cuentas_x_cobrar.cliente.value == "" || document.form_cuentas_x_cobrar.cliente.value == "No hay resultado para esa entrada" )  {
	     alert('Por favor introduzca el CLIENTE para el registro que desea insertar. GRACIAS');
		 document.form_cuentas_x_cobrar.cliente.focus();
		 return(false);   
     } 
	   
	 //(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL VALOR QUE DEBO COBRAR Y VERIFICO QUE SEA NÚMERO.
	 if ( document.form_cuentas_x_cobrar.valor_cobro.value == "" )  {
		    alert('Por favor introduzca el valor de la DEUDA del cliente que tendrá en su Registro. GRACIAS');
			document.form_cuentas_x_cobrar.valor_abono.focus();
			return(false);
	 } else if ( isNaN(document.form_cuentas_x_cobrar.valor_cobro.value) )  { 
			alert('Por favor introduzca un valor num\xE9rico en el campo Valor de Cobro($). GRACIAS');
			document.form_cuentas_x_cobrar.valor_cobro.focus(); 
			return(false);
	 }
	
	 //(4) VERIFICO QUE EXISTA ALGO EN EL CAMPO DE DETALLE DEL REGISTRO.
	 if ( document.form_cuentas_x_cobrar.detalle_registro.value == " " )  {
	     alert('Por favor introduzca el DETALLE para el registro que desea insertar. GRACIAS');
		 document.form_cuentas_x_cobrar.detalle_registro.focus();
		 return(false);   
     } 
	
	 //(5) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE VENCIMIENTO.
	 if ( document.form_cuentas_x_cobrar.fecha_vencimiento.value == "" )  {
	     alert('Por favor introduzca la Fecha de vencimiento del Registro que desea insertar. GRACIAS');
		 document.form_cuentas_x_cobrar.fecha_vencimiento.focus();
		 return(false);   
     }
	
	 //(6) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	 if (confirm("Si son correctos los datos, por favor acepte \n\n" + "Fecha de Registro: " + document.form_cuentas_x_cobrar.fecha_registro_cxc.value + "\n" + "Cliente: " + document.form_cuentas_x_cobrar.cliente.value + "\n" + "Valor del Cobro: " + document.form_cuentas_x_cobrar.valor_cobro.value + "\n" + "Detalle: " + document.form_cuentas_x_cobrar.detalle_registro.value + "\n" + "Fecha de vencimiento: " + document.form_cuentas_x_cobrar.fecha_vencimiento.value ))  {
		    document.form_cuentas_x_cobrar.action = "includes/mod_cuentas_x_cobrar_functions.php?data=send";
		    document.form_cuentas_x_cobrar.submit();
	 } else {
			return (false);  
	 }  
			
	}   // fin de la function send_mes_cuentas_x_cobrar()
      
//33.
   function able_valor_ingresar()
   {
	   // Función que activa la casilla de valor a abonar de un registro (cuentas x cobrar)
	  
	 var valor_a_ingresar = document.getElementById('valor_act_ingreso');
	 var origen_de_cobro = document.getElementById('origen_cobro_cxc');
	 
	 origen_de_cobro.disabled = "";
	
	 valor_a_ingresar.value = "";
	 valor_a_ingresar.disabled = "";
					
	 document.form_edit_cuentas_x_cobrar.valor_act_ingreso.focus();  
	   
   }  // fin de la function able_valor_ingresar()
   
//34.
   function disable_valor_ingresar()
   {
	   // Función que desactiva la casilla de valor a abonar de un registro (cuentas x cobrar)
	  
	 var valor_a_ingresar = document.getElementById('valor_act_ingreso');
	 var origen_de_cobro = document.getElementById('origen_cobro_cxc');
	 
	 origen_de_cobro.disabled = "";
	 
	 valor_a_ingresar.value = "";
	 valor_a_ingresar.disabled = "disabled";
					
	 return(false);
	    
   }  // fin de la function able_valor_ingresar()
    
//35.
   function send_edit_mes_cuentas_x_cobrar() 
   {
	   // Función que envía el formulario de edición de los datos de un registro (verifica los campos).
	  	  
	    /* Lo mismo de la función send_mes_cuentas_x_cobrar hasta el //(5) */ 
	   //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE REGISTRO.
	 if ( document.form_edit_cuentas_x_cobrar.fecha_registro.value == "" )  {
	     alert('Por favor introduzca la Fecha del Registro. GRACIAS');
		 document.form_edit_cuentas_x_cobrar.fecha_registro.focus();
		 return(false);   
     } 
	 
	 //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DE CLIENTE.
	 if ( document.form_edit_cuentas_x_cobrar.cliente.value == "" || document.form_edit_cuentas_x_cobrar.cliente.value == "No hay resultado para esa entrada" )  {
	     alert('Por favor introduzca el CLIENTE para el registro que desea editar. GRACIAS');
		 document.form_cuentas_x_cobrar.cliente.focus();
		 return(false);   
     } 
	 
	 //(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO cliente_id QUE ME CONFIRMA QUE EL CLIENTE ES DE LA BD.
	 if ( document.form_edit_cuentas_x_cobrar.cliente_id.value == "" )  {
	     alert('Por favor introduzca un CLIENTE que exista en la Base de Datos. GRACIAS');
		 document.form_edit_cuentas_x_cobrar.cliente.focus();
		 return(false);   
     } 
	   
	 //(4) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL VALOR QUE DEBO COBRAR Y VERIFICO QUE SEA NÚMERO.
	 if ( document.form_edit_cuentas_x_cobrar.valor_cobro.value == "" )  {
		    alert('Por favor introduzca el valor del COBRO que tendrá en su Registro. GRACIAS');
			document.form_edit_cuentas_x_cobrar.valor_cobro.focus();
			return(false);
	 } else if ( isNaN(document.form_edit_cuentas_x_cobrar.valor_cobro.value) )  { 
			alert('Por favor introduzca un valor num\xE9rico en el campo Valor Total del Cobro($). GRACIAS');
			document.form_edit_cuentas_x_cobrar.valor_cobro.focus(); 
			return(false);
	 }
	
	 //(5) VERIFICO QUE EXISTA ALGO EN EL CAMPO DE DETALLE DEL REGISTRO.
	 if ( document.form_edit_cuentas_x_cobrar.detalle_registro.value == "" )  {
	     alert('Por favor introduzca el DETALLE para el registro que desea insertar. GRACIAS');
		 document.form_edit_cuentas_x_cobrar.detalle_registro.focus();
		 return(false);   
     } 
	
	 //(6) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE VENCIMIENTO.
	 if ( document.form_edit_cuentas_x_cobrar.fecha_vencimiento.value == "" )  {
	     alert('Por favor introduzca la Fecha de vencimiento del Registro que desea insertar. GRACIAS');
		 document.form_edit_cuentas_x_cobrar.fecha_vencimiento.focus();
		 return(false);   
     }
     
     //(7) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE ACTUALIZACIÓN
     if ( document.form_edit_cuentas_x_cobrar.fecha_actualizacion.value == "" )  {
	     alert('Por favor introduzca la Fecha de de Actualizaci\xF3n del Registro que desea actualizar. GRACIAS');
		 document.form_edit_cuentas_x_cobrar.fecha_actualizacion.focus();
		 return(false);   
     }
   
     //(8) VERIFICO QUE ESTÉ SELECCIONADO ALGUNO DE LOS 2 RADIOBOTONES.
	 if ( document.getElementById('radio_ingresar_parte').checked == 1 )  {
	    
		 if ( document.form_edit_cuentas_x_cobrar.valor_act_ingreso.value == "" )  {
		     alert('Por favor introduzca el valor a ingresar en este Pago. GRACIAS');
			 document.form_edit_cuentas_x_cobrar.valor_act_ingreso.focus();
			 return(false);
	     } else if ( isNaN(document.form_edit_cuentas_x_cobrar.valor_act_ingreso.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el valor del Cobro a ingresar. GRACIAS');
			 document.form_edit_cuentas_x_cobrar.valor_act_ingreso.focus();
			 return(false);
		 }
	
	 } else if ( document.getElementById('radio_ingresar_todo').checked == 1 )  {
	
	     // Aquí no pasa nada 
		 
	 } else {
	     // Cuando no seleccione ninguna de las dos opciones de PAGO
	     alert('Por favor seleccione alguna de las dos opciones de cobro. GRACIAS');	 
		 return(false);
	 }
     
     //(9) VERIFICO QUE NO ESTÉ SELECCIONADA LA OPCIÓN 'seleccione' EN EL 'DESTINO DEL COBRO'
     if ( document.form_edit_cuentas_x_cobrar.origen_cobro_cxc.value == "seleccione" )  {
	     alert('Por favor introduzca un Destino del Cobro v\xE1lido. GRACIAS');
		 document.form_edit_cuentas_x_cobrar.origen_cobro_cxc.focus();
		 return(false);   
     }
   
     //(10) VERIFICO QUE EXISTA ALGO ESCRITO EN EL DETALLE DE ACTUALIZACIÓN
     if ( document.form_edit_cuentas_x_cobrar.detalle_edit.value == "" )  {
	     alert('Por favor introduzca algun detalle para el Registro que desea actualizar. GRACIAS');
		 document.form_edit_cuentas_x_cobrar.detalle_edit.focus();
		 return(false);   
     }
        
	 //(11) VERIFICO QUE EL VALOR ABONAR SEA MENOR O IGUAL AL SALDO QUE FALTA POR ABONAR EN ESE REGISTRO	 
	 var saldo = document.form_edit_cuentas_x_cobrar.valor_saldo.value;
	 var valor_a_ingresar = document.form_edit_cuentas_x_cobrar.valor_act_ingreso.value;
	 var Saldo = parseFloat(saldo);
	 var Valor_a_ingresar = parseFloat(valor_a_ingresar);
	 	 
	 if ( Valor_a_ingresar > Saldo )  {
		 // ESTO SIGNIFICA QUE ES MAYOR LOS QUE DEBO PAGAR QUE LO QUE REALMENTE NECESITO PAGAR
	     alert('Disculpe!' + '\n' + 'Usted va a cobrar m\xE1s de lo que realmente debe.' + '\n' + 'Por favor rectifique en el campo "Valor a Ingresar($)"' + '\n' + 'GRACIAS');
	     document.form_edit_cuentas_x_cobrar.valor_act_ingreso.focus();
		 return(false);
	 }
	 
	 //(12) ENVÍO MENSAJE DE CONFIRMACIÓN PARA LOS DATOS INTRODUCIDOS POR EL USUARIO
	 //(12.1) Primero preparo el valor que voy a poner en "Valor a Ingresar"
	 if ( document.form_edit_cuentas_x_cobrar.valor_act_ingreso.disabled )  {
		 
		 var valor_a_ingresar = document.form_edit_cuentas_x_cobrar.valor_saldo.value;
	     	 
	 } else {
		 
		 var valor_a_ingresar = document.form_edit_cuentas_x_cobrar.valor_act_ingreso.value;
		 
	 }
	 	 
	 if (confirm("Si son correctos los datos de actualizaci\xF3n del Registro, por favor acepte \n\n" + "Fecha de Actualizaci\xF3n: " + document.form_edit_cuentas_x_cobrar.fecha_actualizacion.value + "\n" + "Valor a Ingresar: " + valor_a_ingresar + "\n" + "Destino del Cobro: " + document.form_edit_cuentas_x_cobrar.origen_cobro_cxc.options[document.form_edit_cuentas_x_cobrar.origen_cobro_cxc.selectedIndex].text + "\n" + "Detalle de Actualizaci\xF3n: " + document.form_edit_cuentas_x_cobrar.detalle_edit.value ))  {
		     document.form_edit_cuentas_x_cobrar.action = "includes/mod_cuentas_x_cobrar_functions.php?data=edit";
             document.form_edit_cuentas_x_cobrar.submit();
	 } else {
			return (false);  
	 }  
	   
   }  // Fin de la function send_edit_mes_cuentas_x_cobrar() 
      
//36. 
   function send_mesano_cuentas_x_cobrar()   
   {
       //Función que envía el formulario que selecciona el mes y el año del cual quiero ver los registros de las cuentas por cobrar.    
	   document.form_mes_cxcobrar.action = "index.php?mod=mod_cuentas_x_cobrar&optioncxc=consulta&mesanocxc=send#tabs-4";
	   document.form_mes_cxcobrar.submit();
		
   }  // Fin de la function send_mesano_cuentas_x_cobrar() 
   
//37.
   function inicio_cxc_button()
   {
	   // Función del botón de ir al inicio del Módulo. 
       document.location.href = 'index.php?mod=mod_cuentas_x_cobrar#tabs-4';
   
   } // Fin de la función inicio_cxc_button()
   
   /**************************************************************************************************************
                                               MÓDULO EMPRESA
   ****************************************************************************************************************/
//38.
   function send_empresaform()
   {
	   // Función que envía el formulario con los datos de la empresa (Administrador)
	   //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO NOMBRE DE LA EMPRESA.
	 if ( document.form_empresa.nombre_empresa.value == "" )  {
	     alert('Por favor introduzca el Nombre de la Empresa. GRACIAS');
		 document.form_empresa.nombre_empresa.focus();
		 return(false);   
     }
	   //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO RAZÓN SOCIAL.
	 if ( document.form_empresa.razon_social.value == "" )  {
	     alert('Por favor introduzca la Raz\xF3n Social de su Empresa. GRACIAS');
		 document.form_empresa.razon_social.focus();
		 return(false);   
     }
	    //(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO DIRECCIÓN DE LA EMPRESA.
	 if ( document.form_empresa.direccion_empresa.value == "" )  {
	     alert('Por favor introduzca la Direcci\xF3n de su Empresa. GRACIAS');
		 document.form_empresa.direccion_empresa.focus();
		 return(false);   
     }
	     //(4) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO TELEFONO DE LA EMPRESA.
	 
	     //(5) VERIFICO QUE EXISTA ALGO EN EL CAMPO RUC DE LA EMPRESA.
	 if ( document.form_empresa.ruc_empresa.value == "" )  {
	     alert('Por favor introduzca el RUC de su Empresa. GRACIAS');
		 document.form_empresa.ruc_empresa.focus();
		 return(false);   
     }
	      //(6) VERIFICO QUE EXISTA ALGO EN EL CAMPO MONEDAS INFORMES.
	 if ( document.form_empresa.moneda_informes.value == "" )  {
	     alert('Por favor introduzca el nombre de la moneda que va a utilizar en los informes. GRACIAS');
		 document.form_empresa.moneda_informes.focus();
		 return(false);   
     }
	 
	 //(6) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	 if (confirm("Si son correctos los datos, por favor acepte \n\n" + "Nombre de la Empresa: " + document.form_empresa.nombre_empresa.value + "\n" + "Raz\xF3n Social: " + document.form_empresa.razon_social.value + "\n" + "Direcci\xF3n de la Empresa: " + document.form_empresa.direccion_empresa.value + "\n" + "Tel\xE9fono de la Empresa: " + document.form_empresa.telefono_empresa.value + "\n" + "RUC de la Empresa: " + document.form_empresa.ruc_empresa.value + "\n" + "Moneda de uso: " + document.form_empresa.moneda_informes.value))  {
		    document.form_empresa.action = "includes/mod_empresa_functions.php?data=send";
		    document.form_empresa.submit();
	 } else {
			return (false);  
	 }  
	    
   }   // Fin de la función send_empresaform()
   
   /**************************************************************************************************************
                                               MÓDULO COMPRAS
   ****************************************************************************************************************/
//39.
   function detalle_compra()
   {
	    // Función que pasa a mostrar el SEGUNDO div del detalle de las compras.  
	    //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE COMPRA.
	 if ( document.form_nueva_compra.fecha_compra.value == "" )  {
	     alert('Por favor introduzca la Fecha de la Compra. GRACIAS');
		 document.form_nueva_compra.fecha_compra.focus();
		 return(false);   
     } 
	 
	 //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DE NO. DE FACTURA.
	 if ( document.form_nueva_compra.no_factura_compra.value == "" )  {
	     alert('Por favor introduzca contenido en el campo de No. de Factura. GRACIAS');
		 document.form_nueva_compra.no_factura_compra.focus();
		 return(false);   
     } 
	   
      //(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO PROVEEDOR.
	 if ( document.form_nueva_compra.proveedor_compra.value == "" )  {
	     alert('Por favor introduzca el Proveedor. GRACIAS');
		 document.form_nueva_compra.proveedor_compra.focus();
		 return(false);   
     } 
   
     //(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO HIDDEN DEL id DEL PROVEEDOR.
	 if ( document.form_nueva_compra.id_proveedor_compra.value == "" )  {
	     alert('Por favor introduzca un Proveedor de la Base de Datos. GRACIAS');
		 document.form_nueva_compra.proveedor_compra.focus();
		 return(false);   
     } 
	 
	 //(4) CONFIRMO QUE LOS DATOS SON CORRECTOS.
	 if ( confirm("Si son correctos los datos por favor acepte para pasar a Detalles de la Compra. \n\n" + "Orden de Compra: " + document.form_nueva_compra.orden_compra.value + "\n" + "Fecha de la Compra: " + document.form_nueva_compra.fecha_compra.value + "\n" + "N\xFAmero de Factura: " + document.form_nueva_compra.no_factura_compra.value + "\n" + "Proveedor: " + document.form_nueva_compra.proveedor_compra.value))  {
		    // document.form_nueva_compra.action = "ajax/compras_primer_modulo.php";
            // document.form_nueva_compra.submit();
	        
	    // INTRODUZCO LOS DATOS EN LOS CAMPOS RESPECTIVOS DE LA BD.
	   
	    var oc  = document.form_nueva_compra.orden_compra.value;        // Orden de Compra.
	    var fc  = document.form_nueva_compra.fecha_compra.value;        // Fecha de Compra.
	    var nfc = document.form_nueva_compra.no_factura_compra.value;   // No de Factura de la Compra.
	    var ipc = document.form_nueva_compra.id_proveedor_compra.value; // id del Proveedor de la Compra.
	    
	    //(001) Enviamos el formulario usando AJAX
        $.ajax({
            type:       'POST',
            url:        'ajax/compras_primer_modulo.php?oc=' + oc + '&fc=' + fc + '&nfc=' + nfc + '&ipc=' + ipc,          /* LA URL DEL action DEL FORMULARIO */
            data:       $(this).serialize(),            /* ENVÍA LOS DATOS SERIALIZADOS AL ARCHIVO QUE PROCESA */
            beforeSend: MostrarLoader,
		    complete:   EsconderLoader,
		    error:      show_error_message_clientes, 
			timeout:    4000,   
	            //(002) Mostramos un mensaje con la respuesta de PHP
            success: function(response) {
                    if ( response == "true" ) {   // Esto es que se insertó bien en la BD.
					    //(003) ESCONDO EL LINK DE AÑADIR DETALLE
	                   $('#proveedor_compra').attr({disabled:"disabled"}); // DESABILITO EL PROVEEDOR PARA EVITAR ERRORES
					   $('#anadir_detalle').hide();  
					   $('#detalle_compra').show();
					   $('#anadir_detalle_pago').show();
					} else {                        // Esto es que no se insertó en la BD.  
					 	alert ('No se han insertado correctamente los datos en la BD, intente nuevamente. GRACIAS');
					}
			}
	    }) 	
	 
	   return false;
	 
	 } else {
			return (false);  
	 } 
	 	  
   }  // Fin de la función detalle_compra()
      
//40.
   function MostrarLoader()
   {
      $('#loader_gif').fadeIn("slow"); //muestro el loader de ajax
   }
   
//41
   function EsconderLoader()
   {
      $('#loader_gif').fadeOut("slow"); //escondo el loader de ajax
   }
   
//42.
   function show_error_message_clientes()  // Función que se ejecuta cuando hay un error en la petición.
   {
	  alert('ERROR');
      return(false);
   }
   
//43. 
   function send_new_compra() 
   {
	   // Función que envía la nueva compra a la base de datos ( DEBO CHEQUEAR TODOS LOS DATOS ).
       // CHEQUEO 1. DATOS GENERALES  //////////////////////
	   //(1.1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE LA COMPRA.
	   if ( document.form_nueva_compra.fecha_compra.value == "" )  {
	       alert('Por favor introduzca la Fecha de la Compra. GRACIAS');
		   document.form_nueva_compra.fecha_compra.focus();
		   return(false);   
       }
	   
	   //(1.2) VERIFICO QUE EXISTA ALGO EN EL CAMPO No. DE FACTURA.
	   if ( document.form_nueva_compra.no_factura_compra.value == "" )  {
	       alert('Por favor introduzca el No. de Factura de la Compra. GRACIAS');
		   document.form_nueva_compra.no_factura_compra.focus();
		   return(false);   
       }
	   
	   //(1.3) VERIFICO QUE EXISTA ALGO EN EL CAMPO PROVEEDOR.
	   if ( document.form_nueva_compra.proveedor_compra.value == "" )  {
	       alert('Por favor introduzca el Proveedor de la Compra. GRACIAS');
		   document.form_nueva_compra.proveedor_compra.focus();
		   return(false);   
       }
	   
	   //(1.4) VERIFICO QUE EXISTA ALGO EN EL CAMPO RUC DEL PROVEEDOR.
	   if ( document.form_nueva_compra.id_proveedor_compra.value == "" )  {
	       alert('Por favor introduzca un Proveedor que se encuentre en la Base de Datos.GRACIAS');
		   document.form_nueva_compra.proveedor_compra.focus();
		   return(false);   
       }
	   
	   //(1.5) IGUALO EL VALOR DE LA VARIABLE proveedor_compra al proveedor_compra_hidden para guardarlo en la Bd.
	   document.form_nueva_compra.proveedor_compra_hidden.value = document.form_nueva_compra.proveedor_compra.value;
	    
	   // CHEQUEO 2. DETALLE DE LA COMPRA ////////////////////
   
       //////////////////////*************** AQUÍ NO HAY NADA QUE HACER  **************//////////////////////
     
       // CHEQUEO 3. DETALLE DE PAGO /////////////////////
       
	   //(3.1) VERIFICO QUE EXISTA ALGO EN EL CAMPO VALOR TOTAL A PAGAR.
	   if ( document.form_nueva_compra.monto_total.value == "" )  {
	       alert('Por favor chequee el VALOR TOTAL DE LA COMPRA. GRACIAS');
		   document.form_nueva_compra.monto_total.focus();
		   $("#monto_total_a_pagar").css("background-color","#F9BEBD");
		   return(false);   
       }
	   
	   //(3.2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DESCUENTO GENERAL.
	   if ( document.form_nueva_compra.descuento_general.value == "" )  {
	       alert('Por favor chequee el VALOR EN EL CAMPO DESCUENTO GENERAL. GRACIAS');
		   document.form_nueva_compra.descuento_general.focus();
		   $("#descuento_general").css("background-color","#F9BEBD");
		   return(false);   
       }
             
       //(3.3) VERIFICO LOS CAMPOS A PARTIR DE SI SELECCIONO 'Contado' ó 'Crédito'
	   var swt = document.getElementById('forma_pago_contado').checked;
	      
	   switch(swt)
	   {
		  //(3.3.1) Cuando tengo seleccionado el radio botón de la Compra al 'Contado'. 
		  case true:   
	         
			 //(3.3.1.1) Chequeo que tenga seleccionado alguna de las 3 formas de pago al contado(Banco, Caja o Banco y Caja) 
			 var pay_type1 = document.getElementById('forma_de_pago_banco').checked;
			 var pay_type2 = document.getElementById('forma_de_pago_caja').checked;
			 var pay_type3 = document.getElementById('forma_de_pago_banco_y_caja').checked;
			 
			 if ( pay_type1 == true || pay_type2 == true )  {
			     //(3.3.1.2) Todo está bien: CASO BANCO ó CAJA -> En ese caso que chequee si tiene escrito algo en la 'Descripción'	 
			     if ( document.form_nueva_compra.descripcion_origen_pago.value == "" )  {
	                 alert('Por favor escriba algo en la Descripci\xF3n del Origen del Pago.GRACIAS');
		             document.form_nueva_compra.descripcion_origen_pago.focus();
		             return(false);   
                 }
			 
			     /***************** Primer confirm  *****************/  
			     if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		             document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=contado1";
                     document.form_nueva_compra.submit();
	             } else {
			         return (false);  
	             }  
	 
	 			 
			 
			 } else if ( pay_type3 == true )  {
			     //(3.3.1.3) Todo está bien: CASO BANCO y CAJA -> En ese caso que chequee:
				 // 01 Si tiene escrito algo los 'Montos ' y la 'Descripción'	 
			     if ( document.form_nueva_compra.monto_pago_caja.value == "" || document.form_nueva_compra.monto_pago_caja.value == 0 || isNaN(document.form_nueva_compra.monto_pago_caja.value))  {
	                 alert('Por favor chequee el Monto a Pagar de la Caja Central del Origen del Pago.GRACIAS');
		             document.form_nueva_compra.monto_pago_caja.focus();
		             return(false);   
                 }
			     
				 if ( document.form_nueva_compra.descripcion_pago_caja.value == "" )  {
	                 alert('Por favor escriba algo en la Descripci\xF3n del Origen del Pago para la Caja.GRACIAS'); 
		             document.form_nueva_compra.descripcion_pago_caja.focus();
		             return(false);   
                 }
			     
				 if ( document.form_nueva_compra.monto_pago_banco.value == "" || document.form_nueva_compra.monto_pago_banco.value == 0 || isNaN(document.form_nueva_compra.monto_pago_banco.value) )  {
	                 alert('Por favor chequee el Monto a Pagar del Banco del Origen del Pago.GRACIAS');
		             document.form_nueva_compra.monto_pago_banco.focus();
		             return(false);   
                 }
				 
				 if ( document.form_nueva_compra.descripcion_pago_banco.value == "" )  {
	                 alert('Por favor escriba algo en la Descripci\xF3n del Origen del Pago para el Banco.GRACIAS');
		             document.form_nueva_compra.descripcion_pago_banco.focus();
		             return(false);   
                 }
				 
				 // 02 Si la suma de los Montos a pagar es igual al valor total... 
			 	 var monto_caja = document.getElementById('monto_pago_caja').value;
				 var monto_banco = document.getElementById('monto_pago_banco').value;
				 var monto_real_compras_valor = document.getElementById('valor_real_de_la_compra').value;				 	 
			     monto_caja = parseFloat(monto_caja);
				 monto_banco = parseFloat(monto_banco);
				 monto_real_compras_valor = parseFloat(monto_real_compras_valor);
			 
			     var sumatoria_montos = monto_caja + monto_banco;
				 
				 if ( sumatoria_montos.toFixed(2) != monto_real_compras_valor.toFixed(2) ) {
					alert('Los valores de la suma de los montos a pagar por la Caja y el Banco son diferentes al Valor de la Compra.Por favor chequee los datos.GRACIAS');
				 return(false); 
				 }
			 
			     /***************** Segundo confirm  *****************/  
			     if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		             document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=contado2";
                     document.form_nueva_compra.submit();
	             } else {
			         return (false);  
	             }
				  
			 } else {
				// Esto significa que no se ha seleccionado ningún 'Origen del Pago'.
				alert('Por favor seleccione el Origen del Pago');
				return(false); 
			 }  
		 
		  break;
		  //(3.3.2) Cuando tengo seleccionado el radio botón de la Compra a 'Crédito'. 
		  case false:
		  
		      var dinero_entrada = document.getElementById('input_entrada_forma_pago').value;            // Valor del Anticipo.
			  var saldo_del_credito = document.getElementById('saldo_dinero').value;                     // Saldo del Crédito.
			  var monto_real_compras_valor = document.getElementById('valor_real_de_la_compra').value;   // Valor Real de la Compra.
			  
			  //01 CHEQUEAMOS QUE EL DINERO DE ENTRADA SEA UN NÚMERO Y NO SEA 'VACÍO'.  
			  if ( dinero_entrada == "" || isNaN(dinero_entrada) )  {
				  alert('Por favor chequee el campo "Valor de Entrada".GRACIAS');
				  document.form_nueva_compra.entrada_dinero.focus();
				  return(false);
			  }
			  
			  //02 CHEQUEAMOS QUE EL SALDO DEL CRÉDITO SEA UN NÚMERO Y NO SEA 'VACÍO'.  
			  if ( saldo_del_credito == "" || isNaN(saldo_del_credito) )  {
				  alert('Por favor chequee el campo "Saldo del Cr\xE9dito".GRACIAS');
				  document.form_nueva_compra.saldo_dinero.focus();
				  return(false);
			  }
			  
			  //03 switch QUE PRECISA SI LA COMPRA A CRÉDITO TIENE: UNA ENTRADA Ó LA ENTRADA ES 0.
			  switch(dinero_entrada) 
			  {
				  case "0": // ENTRADA DE DINERO PARA EL CRÉDITO = 0
				  
				      //03.1 VERIFICO QUE EL 'SALDO DEL CRÉDITO' SEA IGUAL AL 'VALOR TOTAL DE LA COMPRA'.
				      				 	 
			          saldo_del_credito = parseFloat(saldo_del_credito);
				      monto_real_compras_valor = parseFloat(monto_real_compras_valor);
			 
			          if ( saldo_del_credito.toFixed(2) != monto_real_compras_valor.toFixed(2) ) {
					     alert('El Valor del "Saldo del Cr\xE9dito" y el Valor de la Compra son diferentes.Por favor chequee este valor.GRACIAS');
				         document.form_nueva_compra.saldo_dinero.focus();
						 return(false); 
				      }
				  
				       // Función que chequea todos los pagos y los envía a procesar al PHP,uso 1 de 3 veces...
					  chequeo_d_pagos('0');  // Se pone 0 pues el Valor de Entrada($) es 0.
							 				  
				  break;
			      default:  // ENTRADA DE DINERO PARA EL CRÉDITO DISTINTO DE 0.
				  
				      saldo_del_credito = parseFloat(saldo_del_credito);
				      monto_real_compras_valor = parseFloat(monto_real_compras_valor);
					  dinero_entrada = parseFloat(dinero_entrada);
					  
					  //03.2 Chequeo que tenga seleccionado alguna de las 3 formas de pago al contado(Banco, Caja o Banco y Caja) 
				      var pay_type1 = document.getElementById('forma_de_pago_banco').checked;
			          var pay_type2 = document.getElementById('forma_de_pago_caja').checked;
			          var pay_type3 = document.getElementById('forma_de_pago_banco_y_caja').checked;
			 
			          if ( pay_type1 == true || pay_type2 == true )  {
			              //(3.2.1) Todo está bien: CASO BANCO ó CAJA -> En ese caso que chequee si tiene escrito algo en la 'Descripción'	 
			              // CHEQUEO QUE TENGA ALGO ESCRITO EN LA DESCRIPCIÓN DEL PAGO.
						  if ( document.form_nueva_compra.descripcion_origen_pago.value == "" )  {
	                          alert('Por favor escriba algo en la Descripci\xF3n del Origen del Pago.GRACIAS');
		                      document.form_nueva_compra.descripcion_origen_pago.focus();
		                      return(false);   
                          }
			              
						  // CHEQUEO QUE LA SUMA DEL Valor de Entrada + Saldo del Crédito = Valor Total de la Compra .
						  var sumatoria = dinero_entrada + saldo_del_credito;
						  
						  if ( sumatoria.toFixed(2) != monto_real_compras_valor.toFixed(2) )  {
	                          alert('Error.Los valores del "Valor de Entrada" y del "Saldo de Cr\xE9dito" no suman el Valor de la Compra.Rectifique.');
		                      document.form_nueva_compra.entrada_dinero.focus();
		                      return(false);   
                          }
			     
					       // Función que chequea todos los pagos y los envía a procesar al PHP,uso 2 de 3 veces...
					       chequeo_d_pagos('1');  // Se pone 1 pues el Valor de Entrada($) es distinto de 0.
					  				   
					  } else if ( pay_type3 == true )  {
			               //(3.2.2) Todo está bien: CASO BANCO y CAJA -> En ese caso que chequee:
				           // 01 Si tiene escrito algo los 'Montos ' y la 'Descripción'	 
			               if ( document.form_nueva_compra.monto_pago_caja.value == "" || document.form_nueva_compra.monto_pago_caja.value == 0 || isNaN(document.form_nueva_compra.monto_pago_caja.value))  {
	                           alert('Por favor chequee el Monto a Pagar de la Caja Central del Origen del Pago.GRACIAS');
		                       document.form_nueva_compra.monto_pago_caja.focus();
		                       return(false);   
                           }
			     
				           if ( document.form_nueva_compra.descripcion_pago_caja.value == "" )  {
	                           alert('Por favor escriba algo en la Descripci\xF3n del Origen del Pago para la Caja.GRACIAS'); 
		                       document.form_nueva_compra.descripcion_pago_caja.focus();
		                       return(false);   
                           }
			     
				           if ( document.form_nueva_compra.monto_pago_banco.value == "" || document.form_nueva_compra.monto_pago_banco.value == 0 || isNaN(document.form_nueva_compra.monto_pago_banco.value) )  {
	                          alert('Por favor chequee el Monto a Pagar del Banco del Origen del Pago.GRACIAS');
		                      document.form_nueva_compra.monto_pago_banco.focus();
		                      return(false);   
                           }
				 
				           if ( document.form_nueva_compra.descripcion_pago_banco.value == "" )  {
	                           alert('Por favor escriba algo en la Descripci\xF3n del Origen del Pago para el Banco.GRACIAS');
		                       document.form_nueva_compra.descripcion_pago_banco.focus();
		                       return(false);   
                           }
				 
				           // 02 Si la suma de los Montos a pagar es igual al valor de la ENTRADA... 
			 	          var monto_caja = document.getElementById('monto_pago_caja').value;
				          var monto_banco = document.getElementById('monto_pago_banco').value;
				          var monto_real_compras_valor = document.getElementById('valor_real_de_la_compra').value;
				 	 
			              monto_caja = parseFloat(monto_caja);
				          monto_banco = parseFloat(monto_banco);
				 			 
			              var sumatoria_montos = monto_caja + monto_banco;
				 
				          if ( sumatoria_montos.toFixed(2) != dinero_entrada.toFixed(2) ) {
					          alert('Los valores de la suma de los montos a pagar por la Caja y el Banco son diferentes al Valor de Entrada.Por favor chequee esos dos valores.GRACIAS');
				              return(false); 
				          }
			 			              
						  // Función que chequea todos los pagos y los envía a procesar al PHP,uso 3 de 3 veces...
					       chequeo_d_pagos('1');  // Se pone 1 pues el Valor de Entrada($) es distinto de 0.
					  
					  } else {
				            // Esto significa que no se ha seleccionado ningún 'Origen del Pago'.
				          alert('Por favor seleccione el Origen del Pago');
				          return(false); 
			          }  
		  
				  break;
			  
			  }  // Fin del switch
		 	  
		  break;
	   
	   }
         
   }   // Fin de la función send_new_compra()
	
//44.(private)
   function chequeo_d_pagos(entrada) 
   { 
        // Función que chequea todos los pagos y los envía a procesar al PHP, se usa 3 veces...
   
        var chequeo_pagos = check_cantidad_de_pagos(entrada); //40. Chequeo todos los campos de acuerdo a la cantidad de pagos de la Nueva Compra.  
		if ( chequeo_pagos == "ok1" )  {
			// CANTIDAD DE PAGOS=1
			// ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			/***************** Tercer confirm  *****************/  
		    if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		        document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pago1";
                document.form_nueva_compra.submit();
	        } else {
			    return (false);  
	        }
											     
		} else if ( chequeo_pagos == "ok2" )  {
			// CANTIDAD DE PAGOS=2
			// ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			/***************** Cuarto confirm  *****************/ 
			if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		        document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pagos2";
                document.form_nueva_compra.submit();
	        } else {
			    return (false);  
	        } 
								     
		} else if ( chequeo_pagos == "ok3" )  {
			// CANTIDAD DE PAGOS=3
			// ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			/***************** Quinto confirm  *****************/
			if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		        document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pagos3";
                document.form_nueva_compra.submit();
	        } else {
			    return (false);  
	        }   
				     
		}  else if ( chequeo_pagos == "ok4" )  {
			// CANTIDAD DE PAGOS=4
			// ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			/***************** Sexto confirm  *****************/ 
			if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		        document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pagos4";
                document.form_nueva_compra.submit();
	        } else {
			    return (false);  
	        }   
								     
		}  else if ( chequeo_pagos == "ok5" )  {
		     // CANTIDAD DE PAGOS=5
			 // ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			 /***************** Séptimo confirm  *****************/  
			 if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		         document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pagos5";
                 document.form_nueva_compra.submit();
	         } else {
			     return (false);  
	         }  
			 		     
		}  else if ( chequeo_pagos == "ok6" )  {
		     // CANTIDAD DE PAGOS=6
			 // ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			 /***************** Octavo confirm  *****************/  
			 if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		         document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pagos6";
                 document.form_nueva_compra.submit();
	         } else {
			     return (false);  
	         }  
			 		     
		}  else if ( chequeo_pagos == "ok7" )  {
		     // CANTIDAD DE PAGOS=7
			 // ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			 /***************** Noveno confirm  *****************/  
			 if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		         document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pagos7";
                 document.form_nueva_compra.submit();
	         } else {
			     return (false);  
	         }  
			 		     
		}  else if ( chequeo_pagos == "ok8" )  {
		     // CANTIDAD DE PAGOS=8
			 // ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			 /***************** Décimo confirm  *****************/  
			 if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		         document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pagos8";
                 document.form_nueva_compra.submit();
	         } else {
			     return (false);  
	         }  
			 		     
		}  else if ( chequeo_pagos == "ok9" )  {
		     // CANTIDAD DE PAGOS=9
			 // ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			 /***************** Onceno confirm  *****************/  
			 if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		         document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pagos9";
                 document.form_nueva_compra.submit();
	         } else {
			     return (false);  
	         }  
			 		     
		}  else if ( chequeo_pagos == "ok10" )  {
		     // CANTIDAD DE PAGOS=10
			 // ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			 /***************** Duodécimo confirm  *****************/  
			 if (confirm("Est\xE1 seguro de guardar los datos de la compra para: \n\n 1. Proveedor: " + document.form_nueva_compra.proveedor_compra.value + "\n 2. Por un valor de: " + document.form_nueva_compra.valor_real_de_la_compra.value + "\n\n Por favor acepte. \n\n" ))  {
		         document.form_nueva_compra.action = "includes/mod_compras_functions.php?data=creditoentrada" + entrada + "pagos10";
                 document.form_nueva_compra.submit();
	         } else {
			     return (false);  
	         }  
			 		     
		}
     
   } // Fin de la función chequeo_d_pagos()
        
//45.(private) 
   function check_cantidad_de_pagos(entrada) 
   {
	   // Función que chequea todos los campos de acuerdo a la cantidad de pagos de la Nueva Compra.  
   
       var valor_cantidad_de_pagos = document.getElementById('cantidad_de_pagos_credito').value;  // CANTIDAD DE PAGOS (1-5)  
       var Total_compras_valor = document.getElementById('valor_real_de_la_compra').value;  // Valor REAL de la compra.
       var Saldo_del_credito = document.getElementById('saldo_dinero').value;   // Valor del Saldo del Crédito.
	   
	   Total_compras_valor = parseFloat(Total_compras_valor);
	   Saldo_del_credito = parseFloat(Saldo_del_credito);
	    
	   // CHEQUEO TODOS LOS CAMPOS DE ACUERDO A LA CANTIDAD DE PAGOS.
	   switch(valor_cantidad_de_pagos)
	   {
	       case "1": // 1 SOLO PAGO
		      
			  //01
			  var pay1 = check_pago1(); // Chequea los campos para 1 SOLO PAGO.
		      if ( pay1 == false )  {
				  return(false);
			  }
			  
			  pago1 = document.form_nueva_compra.monto_total_pago1.value;
			  pago1 = parseFloat(pago1);
			  			  
			  switch(entrada)
			  {
				 case "0":
				    //02 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 = VALOR TOTAL DE LA COMPRA. 
		            if ( pago1.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				        alert('Error. El Monto a Pagar en el Pago 1 es diferente al Valor Total de la Compra.')
			            document.form_nueva_compra.monto_total_pago1.focus();
				        return(false);
			        } else {
				        return "ok1";
			        }
				 break;
				 case "1":
				    //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 = VALOR SALDO DEL CRÉDITO. 
					if ( pago1.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				        alert('Error. El Monto a Pagar en el Pago 1 es diferente al Valor del Pago.')
			            document.form_nueva_compra.monto_total_pago1.focus();
				        return(false);
			        } else {
				        return "ok1";
			        }
				 break;  
			  }
			  		   
		   break;
		   case "2":  // 2 PAGOS
		      //01
		      var pay2 = check_pago2(); // Chequea los campos para 2 PAGOS.
		      if ( pay2 == false )  {
				  return(false);
			  }
			  
			  var primer_pago = document.form_nueva_compra.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_compra.monto_total_pago2.value;
			  
			  primer_pago = parseFloat(primer_pago);
			  segundo_pago = parseFloat(segundo_pago);
			  				  
		      var Pago1_y_2 = primer_pago + segundo_pago;
			  
			  switch(entrada)
			  {
				 case "0":
				    //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 = VALOR TOTAL DE LA COMPRA.
		            if ( Pago1_y_2.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				       alert('Error. El Monto a Pagar en los Pagos 1 y 2 es diferente al Valor Total del Pago.')
			           document.form_nueva_compra.monto_total_pago1.focus();
				       return(false);
			        } else {
				       return "ok2";
			        }
				 break;
				 case "1":
				    //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 + PAGO 2 = VALOR SALDO DEL CRÉDITO. 
					if ( Pago1_y_2.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				       alert('Error. El Monto a Pagar en los Pagos 1 y 2 es diferente al Valor del Pago.')
			           document.form_nueva_compra.monto_total_pago1.focus();
				       return(false);
			        } else {
				       return "ok2";
			        }
				 break;  
			  }
						  	   
		   break;
	       case "3":  // 3 PAGOS
		      //01
		      var pay3 = check_pago3(); // Chequea los campos para 3 PAGOS.
		      if ( pay3 == false )  {
				  return(false);
			  }
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 = VALOR TOTAL DE LA COMPRA. 
		      var primer_pago = document.form_nueva_compra.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_compra.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_compra.monto_total_pago3.value;
			  
			  primer_pago = parseFloat(primer_pago);
			  segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  				  
			  var Pago1_2_y_3 = primer_pago + segundo_pago + tercer_pago;
			      
				  switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 = VALOR TOTAL DE LA COMPRA.
		                if ( Pago1_2_y_3.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1 ,2 y 3 es diferente al Valor Total de la Compra.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok3";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_y_3.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1 ,2 y 3 es diferente al Valor del Pago.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok3";
			            }
				     break;  
			      }
					   	   
		   break;
		   case "4":  // 4 PAGOS
		      //01
		      var pay4 = check_pago4(); // Chequea los campos para 4 PAGOS.
		      if ( pay4 == false )  {
				  return(false);
			  }
			  
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 = VALOR TOTAL DE LA COMPRA. 
		      var primer_pago = document.form_nueva_compra.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_compra.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_compra.monto_total_pago3.value;
			  var cuarto_pago = document.form_nueva_compra.monto_total_pago4.value;
			  
			  primer_pago = parseFloat(primer_pago);
			  segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  cuarto_pago = parseFloat(cuarto_pago);
			  				  
			  var Pago1_2_3_y_4 = primer_pago + segundo_pago + tercer_pago + cuarto_pago;
			  
			      switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 = VALOR TOTAL DE LA COMPRA.
		                if ( Pago1_2_3_y_4.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1 ,2, 3 y 4 es diferente al Valor Total de la Compra.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok4";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_3_y_4.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1 ,2 ,3 y 4 es diferente al Valor del Pago.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok4";
			            }
				     break;  
			      }
				  
		   break;
		   case "5":  // 5 PAGOS
		      //01
		      var pay5 = check_pago5(); // Chequea los campos para 5 PAGOS.
		      if ( pay5 == false )  {
				  return(false);
			  }
			  
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 +PAGO 4 + PAGO 5 = VALOR TOTAL DE LA COMPRA. 
		      
			  var primer_pago = document.form_nueva_compra.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_compra.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_compra.monto_total_pago3.value;
			  var cuarto_pago = document.form_nueva_compra.monto_total_pago4.value;
			  var quinto_pago = document.form_nueva_compra.monto_total_pago5.value;
			  
			  primer_pago = parseFloat(primer_pago);
		      segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  cuarto_pago = parseFloat(cuarto_pago);
			  quinto_pago = parseFloat(quinto_pago);
			  				  
			  var Pago1_2_3_4_y_5 = primer_pago + segundo_pago + tercer_pago + cuarto_pago + quinto_pago;
			  
			      switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 + PAGO 5 = VALOR TOTAL DE LA COMPRA.
						if ( Pago1_2_3_4_y_5.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4 y 5 es diferente al Valor Total de la Compra.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok5";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 + PAGO 5 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_3_4_y_5.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4 Y 5 es diferente al Valor del Pago.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok5";
			            }
				     break;  
			      }
					  
		   break;
		   case "6":  // 6 PAGOS
		      //01
		      var pay6 = check_pago6(); // Chequea los campos para 6 PAGOS.
		      if ( pay6 == false )  {
				  return(false);
			  }
			  
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1 + PAGO2 + PAGO3 +PAGO4 + PAGO5 + PAGO6 = VALOR TOTAL DE LA COMPRA. 
		      
			  var primer_pago = document.form_nueva_compra.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_compra.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_compra.monto_total_pago3.value;
			  var cuarto_pago = document.form_nueva_compra.monto_total_pago4.value;
			  var quinto_pago = document.form_nueva_compra.monto_total_pago5.value;
			  var sexto_pago = document.form_nueva_compra.monto_total_pago6.value;
			  
			  primer_pago = parseFloat(primer_pago);
		      segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  cuarto_pago = parseFloat(cuarto_pago);
			  quinto_pago = parseFloat(quinto_pago);
			  sexto_pago = parseFloat(sexto_pago);
			  				  
			  var Pago1_2_3_4_5_y_6 = primer_pago + segundo_pago + tercer_pago + cuarto_pago + quinto_pago + sexto_pago;
			  
			      switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6=VALOR TOTAL DE LA COMPRA.
						if ( Pago1_2_3_4_5_y_6.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5 y 6 es diferente al Valor Total de la Compra.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok6";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_3_4_5_y_6.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5 y 6 es diferente al Valor del Pago.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok6";
			            }
				     break;  
			      }
					  
		   break;
		   case "7":  // 7 PAGOS
		      //01
		      var pay7 = check_pago7(); // Chequea los campos para 7 PAGOS.
		      if ( pay7 == false )  {
				  return(false);
			  }
			  
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7 = VALOR TOTAL DE LA COMPRA. 
		      
			  var primer_pago = document.form_nueva_compra.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_compra.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_compra.monto_total_pago3.value;
			  var cuarto_pago = document.form_nueva_compra.monto_total_pago4.value;
			  var quinto_pago = document.form_nueva_compra.monto_total_pago5.value;
			  var sexto_pago = document.form_nueva_compra.monto_total_pago6.value;
			  var septimo_pago = document.form_nueva_compra.monto_total_pago7.value;
			  
			  primer_pago = parseFloat(primer_pago);
		      segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  cuarto_pago = parseFloat(cuarto_pago);
			  quinto_pago = parseFloat(quinto_pago);
			  sexto_pago = parseFloat(sexto_pago);
			  septimo_pago = parseFloat(septimo_pago);
			  				  
			  var Pago1_2_3_4_5_6_y_7 = primer_pago + segundo_pago + tercer_pago + cuarto_pago + quinto_pago + sexto_pago + septimo_pago;
			  
			      switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7=VALOR TOTAL DE LA COMPRA.
						if ( Pago1_2_3_4_5_6_y_7.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5, 6 y 7 es diferente al Valor Total de la Compra.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok7";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_3_4_5_6_y_7.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5, 6 y 7 es diferente al Valor del Pago.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok7";
			            }
				     break;  
			      }
					  
		   break;
		   case "8":  // 8 PAGOS
		      //01
		      var pay8 = check_pago8(); // Chequea los campos para 8 PAGOS.
		      if ( pay8 == false )  {
				  return(false);
			  }
			  
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7+PAGO8 = VALOR TOTAL DE LA COMPRA. 
		      
			  var primer_pago = document.form_nueva_compra.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_compra.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_compra.monto_total_pago3.value;
			  var cuarto_pago = document.form_nueva_compra.monto_total_pago4.value;
			  var quinto_pago = document.form_nueva_compra.monto_total_pago5.value;
			  var sexto_pago = document.form_nueva_compra.monto_total_pago6.value;
			  var septimo_pago = document.form_nueva_compra.monto_total_pago7.value;
			  var octavo_pago = document.form_nueva_compra.monto_total_pago8.value;
			  
			  primer_pago = parseFloat(primer_pago);
		      segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  cuarto_pago = parseFloat(cuarto_pago);
			  quinto_pago = parseFloat(quinto_pago);
			  sexto_pago = parseFloat(sexto_pago);
			  septimo_pago = parseFloat(septimo_pago);
			  octavo_pago = parseFloat(octavo_pago);
			  				  
			  var Pago1_2_3_4_5_6_7_y_8 = primer_pago + segundo_pago + tercer_pago + cuarto_pago + quinto_pago + sexto_pago + septimo_pago + octavo_pago;
			  
			      switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7+PAGO8=VALOR TOTAL DE LA COMPRA.
						if ( Pago1_2_3_4_5_6_7_y_8.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5, 6, 7 y 8 es diferente al Valor Total de la Compra.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok8";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7+PAGO8 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_3_4_5_6_7_y_8.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5, 6, 7 y 8 es diferente al Valor del Pago.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok8";
			            }
				     break;  
			      }
					  
		   break;
		   case "9":  // 9 PAGOS
		      //01
		      var pay9 = check_pago9(); // Chequea los campos para 9 PAGOS.
		      if ( pay9 == false )  {
				  return(false);
			  }
			  
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7+PAGO8+PAGO9 = VALOR TOTAL DE LA COMPRA. 
		      
			  var primer_pago = document.form_nueva_compra.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_compra.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_compra.monto_total_pago3.value;
			  var cuarto_pago = document.form_nueva_compra.monto_total_pago4.value;
			  var quinto_pago = document.form_nueva_compra.monto_total_pago5.value;
			  var sexto_pago = document.form_nueva_compra.monto_total_pago6.value;
			  var septimo_pago = document.form_nueva_compra.monto_total_pago7.value;
			  var octavo_pago = document.form_nueva_compra.monto_total_pago8.value;
			  var noveno_pago = document.form_nueva_compra.monto_total_pago9.value;
			  
			  primer_pago = parseFloat(primer_pago);
		      segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  cuarto_pago = parseFloat(cuarto_pago);
			  quinto_pago = parseFloat(quinto_pago);
			  sexto_pago = parseFloat(sexto_pago);
			  septimo_pago = parseFloat(septimo_pago);
			  octavo_pago = parseFloat(octavo_pago);
			  noveno_pago = parseFloat(noveno_pago);
			  				  
			  var Pago1_2_3_4_5_6_7_8_y_9 = primer_pago + segundo_pago + tercer_pago + cuarto_pago + quinto_pago + sexto_pago + septimo_pago + octavo_pago + noveno_pago;
			  
			      switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7+PAGO8=VALOR TOTAL DE LA COMPRA.
						if ( Pago1_2_3_4_5_6_7_8_y_9.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5, 6, 7, 8 y 9 es diferente al Valor Total de la Compra.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok9";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7+PAGO8 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_3_4_5_6_7_8_y_9.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5, 6, 7, 8 y 9 es diferente al Valor del Pago.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok9";
			            }
				     break;  
			      }
					  
		   break;
		   case "10":  // 10 PAGOS
		      //01
		      var pay10 = check_pago10(); // Chequea los campos para 10 PAGOS.
		      if ( pay10 == false )  {
				  return(false);
			  }
			  
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7+PAGO8+PAGO9+PAGO10=VALOR TOTAL DE LA COMPRA. 
		      
			  var primer_pago = document.form_nueva_compra.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_compra.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_compra.monto_total_pago3.value;
			  var cuarto_pago = document.form_nueva_compra.monto_total_pago4.value;
			  var quinto_pago = document.form_nueva_compra.monto_total_pago5.value;
			  var sexto_pago = document.form_nueva_compra.monto_total_pago6.value;
			  var septimo_pago = document.form_nueva_compra.monto_total_pago7.value;
			  var octavo_pago = document.form_nueva_compra.monto_total_pago8.value;
			  var noveno_pago = document.form_nueva_compra.monto_total_pago9.value;
			  var decimo_pago = document.form_nueva_compra.monto_total_pago10.value;
			  
			  primer_pago = parseFloat(primer_pago);
		      segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  cuarto_pago = parseFloat(cuarto_pago);
			  quinto_pago = parseFloat(quinto_pago);
			  sexto_pago = parseFloat(sexto_pago);
			  septimo_pago = parseFloat(septimo_pago);
			  octavo_pago = parseFloat(octavo_pago);
			  noveno_pago = parseFloat(noveno_pago);
			  decimo_pago = parseFloat(decimo_pago);
			  				  
			  var Pago1_2_3_4_5_6_7_8_9_y_10 = primer_pago + segundo_pago + tercer_pago + cuarto_pago + quinto_pago + sexto_pago + septimo_pago + octavo_pago + noveno_pago + decimo_pago;
			  
			      switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7+PAGO8=VALOR TOTAL DE LA COMPRA.
						if ( Pago1_2_3_4_5_6_7_8_9_y_10.toFixed(2) != Total_compras_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5, 6, 7, 8, 9 y 10 es diferente al Valor Total de la Compra.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok10";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO1+PAGO2+PAGO3+PAGO4+PAGO5+PAGO6+PAGO7+PAGO8 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_3_4_5_6_7_8_9_y_10.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4, 5, 6, 7, 8, 9 y 10 es diferente al Valor del Pago.')
			                document.form_nueva_compra.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok10";
			            }
				     break;  
			      }
					  
		   break;
			   
	   }  // Fin del switch(valor_cantidad_de_pagos)
       
   }  // Fin de la función check_cantidad_de_pagos().
   
//46.(private) 
   function check_pago1() 
   {
	   // Función que chequea los valores del PRIMER PAGO de la nueva compra.
       //01 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago1.value == "" || document.form_nueva_compra.monto_total_pago1.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago1.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 1');   
	      document.form_nueva_compra.monto_total_pago1.focus();
		  return(false);
	   }
   
       //02 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago1.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 1');   
	      document.form_nueva_compra.fecha_pago1.focus();
		  return(false);
	   }
   
       //03 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago1.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 1');   
	      document.form_nueva_compra.descripcion_pago1.focus();
		  return(false);
	   }
     
   } // Fin de la función check_pago1()
 
//47.(private) 
   function check_pago2() 
   {
	   // Función que chequea los valores del SEGUNDO PAGO de la nueva compra.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1. 
	   check_pago1(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago2.value == "" || document.form_nueva_compra.monto_total_pago2.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago2.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 2');   
	      document.form_nueva_compra.monto_total_pago2.focus();
		  return(false);
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago2.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 2');   
	      document.form_nueva_compra.fecha_pago2.focus();
		  return(false);
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago2.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 2');   
	      document.form_nueva_compra.descripcion_pago2.focus();
		  return(false);
	   }
     
   } // Fin de la función check_pago2()
 
//48.(private) 
   function check_pago3() 
   {
	   // Función que chequea los valores del TERCER PAGO de la nueva compra.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1 y 2. 
	   check_pago2(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago3.value == "" || document.form_nueva_compra.monto_total_pago3.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago3.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 3');   
	      document.form_nueva_compra.monto_total_pago3.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago3.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 3');   
	      document.form_nueva_compra.fecha_pago3.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago3.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 3');   
	      document.form_nueva_compra.descripcion_pago3.focus();
		  return false;
	   }
     
   } // Fin de la función check_pago3()
 
//49.(private) 
   function check_pago4() 
   {
	   // Función que chequea los valores del CUARTO PAGO de la nueva compra.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1 ,2 y 3. 
	   check_pago3(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago4.value == "" || document.form_nueva_compra.monto_total_pago4.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago4.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 4');   
	      document.form_nueva_compra.monto_total_pago4.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago4.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 4');   
	      document.form_nueva_compra.fecha_pago4.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago4.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 4');   
	      document.form_nueva_compra.descripcion_pago4.focus();
		  return false;
	   }
        
   } // Fin de la función check_pago4()
   
//50.(private) 
   function check_pago5() 
   {
	   // Función que chequea los valores del QUINTO PAGO de la nueva compra.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1, 2, 3 y 4. 
	   check_pago4(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago5.value == "" || document.form_nueva_compra.monto_total_pago5.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago5.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 5');   
	      document.form_nueva_compra.monto_total_pago5.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago5.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 5');   
	      document.form_nueva_compra.fecha_pago5.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago5.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 5');   
	      document.form_nueva_compra.descripcion_pago5.focus();
		  return false;
	   }
        
   } // Fin de la función check_pago5()
   
//51.(private) 
   function check_pago6() 
   {
	   // Función que chequea los valores del SEXTO PAGO de la nueva compra.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1, 2, 3, 4 y 5. 
	   check_pago5(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago6.value == "" || document.form_nueva_compra.monto_total_pago6.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago6.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 6');   
	      document.form_nueva_compra.monto_total_pago6.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago6.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 6');   
	      document.form_nueva_compra.fecha_pago6.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago6.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 6');   
	      document.form_nueva_compra.descripcion_pago6.focus();
		  return false;
	   }
        
   } // Fin de la función check_pago6()

//52.(private) 
   function check_pago7() 
   {
	   // Función que chequea los valores del SÉPTIMO PAGO de la nueva compra.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1, 2, 3, 4, 5 y 6. 
	   check_pago6(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago7.value == "" || document.form_nueva_compra.monto_total_pago7.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago7.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 7');   
	      document.form_nueva_compra.monto_total_pago7.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago7.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 7');   
	      document.form_nueva_compra.fecha_pago7.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago7.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 7');   
	      document.form_nueva_compra.descripcion_pago7.focus();
		  return false;
	   }
        
   } // Fin de la función check_pago7()

//53.(private) 
   function check_pago8() 
   {
	   // Función que chequea los valores del SÉPTIMO PAGO de la nueva compra.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1, 2, 3, 4, 5, 6 y 7. 
	   check_pago7(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago8.value == "" || document.form_nueva_compra.monto_total_pago8.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago8.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 8');   
	      document.form_nueva_compra.monto_total_pago8.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago8.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 8');   
	      document.form_nueva_compra.fecha_pago8.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago8.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 8');   
	      document.form_nueva_compra.descripcion_pago8.focus();
		  return false;
	   }
        
   } // Fin de la función check_pago8()
   
//54.(private) 
   function check_pago9() 
   {
	   // Función que chequea los valores del SÉPTIMO PAGO de la nueva compra.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1, 2, 3, 4, 5, 6, 7 y 8. 
	   check_pago8(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago9.value == "" || document.form_nueva_compra.monto_total_pago9.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago9.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 9');   
	      document.form_nueva_compra.monto_total_pago9.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago9.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 9');   
	      document.form_nueva_compra.fecha_pago9.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago9.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 9');   
	      document.form_nueva_compra.descripcion_pago9.focus();
		  return false;
	   }
        
   } // Fin de la función check_pago9()
   
//55.(private) 
   function check_pago10() 
   {
	   // Función que chequea los valores del SÉPTIMO PAGO de la nueva compra.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1, 2, 3, 4, 5, 6, 7, 8 y 9. 
	   check_pago9(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_compra.monto_total_pago10.value == "" || document.form_nueva_compra.monto_total_pago10.value == "0" || isNaN(document.form_nueva_compra.monto_total_pago10.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 10');   
	      document.form_nueva_compra.monto_total_pago10.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_compra.fecha_pago10.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 10');   
	      document.form_nueva_compra.fecha_pago10.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_compra.descripcion_pago10.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 10');   
	      document.form_nueva_compra.descripcion_pago10.focus();
		  return false;
	   }
        
   } // Fin de la función check_pago10()         

//56. 
   function inicio_compras_button() 
   {
	   // Función que pone al inicio el módulo COMPRAS.  
   
       document.location.href = 'index.php?mod=mod_compras#tabs-4';
   
   }  // Fin de la función inicio_compras_button()
   
//57.
   function  send_reporte_proveedor_compras()
   {
	   // Función que envía el proveedor y muestra los datos del reporte de Compras del mismo.
       //01 Verifico que exista algo escrito en el campo del Nombre del Proveedor.
	   if ( document.form_reporte_proveedor_compra.proveedor_compras_reporte.value == "" )  {
		  alert('Por favor cheque el nombre del Proveedor');   
	      document.form_reporte_proveedor_compra.proveedor_compras_reporte.focus();
		  return false;
	   }
	 
	   //02 Verifico que lo que se escribió en el campo del Nombre del Proveedor tenga su respectiva id en el campo hidden.
	   if ( document.form_reporte_proveedor_compra.id_proveedor_compras_reporte.value == "" )  {
		  alert('Por favor cheque que el nombre del Proveedor est\xE9 en la Base de Datos');   
	      document.form_reporte_proveedor_compra.proveedor_compras_reporte.focus();
		  return false;
	   }
	 	 
	 if ( confirm('Ver reporte de compras realizadas al Proveedor: \n\n' + document.form_reporte_proveedor_compra.proveedor_compras_reporte.value))  {
		    document.form_reporte_proveedor_compra.action = "index.php?mod=mod_compras&optioncomp=comp_x_proveedor#tabs-4";
		    document.form_reporte_proveedor_compra.submit();
	 } else {
			return (false);  
	 }    
     
   }  // Fin de la función send_reporte_proveedor_compras() 
   
//58. 
   function send_rescompras()
   {
	    // Función que envía el formulario de RESUMEN DE COMPRAS entre 2 fechas determinadas. 
	    //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA INICIAL del reporte de Resumen de Compras.
	    if ( document.form_rescompras.fecha_inicial.value == "" )  {
	        alert('Por favor introduzca la Fecha Inicial. GRACIAS');
		    document.form_rescompras.fecha_inicial.focus();
		    return(false);   
        }
		
		//(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA FINAL del reporte de de Resumen de Compras.
	    if ( document.form_rescompras.fecha_final.value == "" )  {
	        alert('Por favor introduzca la Fecha Final. GRACIAS');
		    document.form_rescompras.fecha_final.focus();
		    return(false);   
        }
  
        //(3) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Si son correctos los datos, por favor acepte \n\n" + "Fecha Inicial: " + document.form_rescompras.fecha_inicial.value + "\n" + "Fecha Final: " + document.form_rescompras.fecha_final.value ))  {
		    document.form_rescompras.action = "index.php?mod=mod_compras&optioncomp=res_compras&resc=ver#tabs-4";  
		    document.form_rescompras.submit();
	  
	    } else {
		    return(false);	
		}
	  
	  
	  
	   
   }  // Fin de la función send_rescompras()
   
   /**************************************************************************************************************
                                               MÓDULO INVENTARIO
   ****************************************************************************************************************/   
//59. 
   function submitinv(variable) 
   {
	   // Función que me muesttra una acción diferente de acuerdo al valor del la variable 'var' para insertar nuevos artículos.
       //01 Inicializo variables
	   var contador = 0;                       // Contador para cuando el elemento radio no está checked
	   var contador_elementos_radio = 0;       // Contador para todos los elementos radio
	   var id_value;                           // Valor donde almaceno el valor del id del registro selecionado.
	   
	   //02 Hago un switch de la variable 'variable'
	   switch(variable)
	   {
	   case 'new':
	         if ( confirm("\xBFEst\xE1 seguro que desea agregar un nuevo Art\xEDculo? \n\n" ) )  {
		         location.href = "index.php?mod=mod_inventario&art=new#tabs-3";
	         } else {
			     return(false);  
	         }
		     break;
	   	   
	   case 'detalle':
	         //(1) VERIFICO QUE EXISTA AL MENOS UN RADIO BOTÓN SELECCIONADO 
	        if ( confirm("\xBFEst\xE1 seguro que desea ver los detalles el Art\xEDculo seleccionado? \n\n" ) )  { 
			   
			  for ( i=0; i < document.articulos_radios.elements.length; i++ ) 
	          {
	               if ( document.articulos_radios.elements[i].type == "radio")	 {
			           contador_elementos_radio++;
					   if (document.articulos_radios.elements[i].checked == 0 )  {
				           contador++;
				           continue;  
			           } else {
			               id_value = document.articulos_radios.elements[i].value;
						   break;  
			           }
		           }
	          }  // Fin del FOR
		
		      //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
			  if ( contador_elementos_radio == contador )  {
				  // Esto significa que no se seleccionó ningún radio botón.
			      alert('Por favor seleccione el registro que desea VER los detalles');
			      return (false);
			  } else {
				  //(3) MUESTRO LA url PARA submit Y VER LOS DETALLES DEL ARTÍCULO SELECCIONADO
				  document.articulos_radios.action = "index.php?mod=mod_inventario&art=detalle&id=" + id_value + "#tabs-3";
		          document.articulos_radios.submit();
							  
			  }
			 
			} else {
			    return(false);  
	        }	 
			break;
	      
	   case	'editar':
	         if ( confirm("\xBFEst\xE1 seguro que desea editar el Art\xEDculo seleccionado? \n\n" ) )  {
		                  
			     for ( i=0; i < document.articulos_radios.elements.length; i++ ) 
	             {
	                  if ( document.articulos_radios.elements[i].type == "radio")	 {
			              contador_elementos_radio++;
					      if (document.articulos_radios.elements[i].checked == 0 )  {
				              contador++;
				              continue;  
			              } else {
			                  id_value = document.articulos_radios.elements[i].value;
						       break;  
			              }
		              }
	             }  // Fin del FOR
		
		         //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN RADIO BOTTON
			     if ( contador_elementos_radio == contador )  {
				     // Esto significa que no se seleccionó ningún radio botón.
			         alert('Por favor seleccione el registro que desea EDITAR');
			         return (false);
			     } else {
				      //(3) MUESTRO LA url PARA VER EL CLIENTE SELECCIONADO
				     location.href = "index.php?mod=mod_inventario&art=editar&id=" + id_value + "#tabs-3";
				  			  
			     }
			 		 		 
			 } else {
			     return(false);  
	         }
	         break;
	         
	   case 'inicio':      
			 location.href = "index.php?mod=mod_inventario#tabs-3";
			 
			 break;	 	 
	      
	   }  // Fin del switch
     
   } // Fin de la función submitinv('variable')
     
//60. 
   function send_articulo() 
   {
	   // Función que rectifica los datos introducidos en los campos para ser enviados a insertar los nuevos artículos en la BD.
	   //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL CÓDIGO DEL ARTÍCULO.
	   if ( document.form_nuevo_articulo.codigo_art.value == "" )  {
	       alert('Por favor introduzca un C\xF3digo para el Art\xEDculo. GRACIAS');
		   document.form_nuevo_articulo.codigo_art.focus();
		   return(false);   
       }
	   //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO UNIDAD DE MEDIDA.
	 if ( document.form_nuevo_articulo.unidad_medida.value == "" )  {
	     alert('Por favor introduzca la Unidad de Medida del Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.unidad_medida.focus();
		 return(false);   
     }
	    //(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO REFERENCIA DEL ARTÍCULO.
	 if ( document.form_nuevo_articulo.referencia_art.value == "" )  {
	     alert('Por favor introduzca alguna referencia para el Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.referencia_art.focus();
		 return(false);   
     }
	     //(4) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO DETALLE DEL ARTÍCULO.
	 
	     //(5) VERIFICO QUE EXISTA ALGO EN EL CAMPO PROVEEDOR DEL ARTÍCULO.
	 if ( document.form_nuevo_articulo.proveedor_art.value == "" )  {
	     alert('Por favor introduzca el Proveedor de este Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.proveedor_art.focus();
		 return(false);   
     }
	 
	     //(6) VERIFICO QUE EXISTA ALGO EN EL CAMPO HIDDEN DEL id DEL PROVEEDOR DEL ARTÍCULO.
	 if ( document.form_nuevo_articulo.id_proveedor_art.value == "" )  {
	     alert('Por favor introduzca un Proveedor adecuado para este Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.proveedor_art.focus();
		 return(false);   
     }
	      //(6) VERIFICO QUE EXISTA ALGO EN EL CAMPO STOCK ACTUAL Y QUE ESTO SEA UN NÚMERO.
	 if ( document.form_nuevo_articulo.stock_actual.value == "" )  {
	     alert('Por favor introduzca el Stock Actual de su Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.stock_actual.focus();
		 return(false);   
     }
	 
	 if ( isNaN(document.form_nuevo_articulo.stock_actual.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el Stock Actual. GRACIAS');
			 document.form_nuevo_articulo.stock_actual.focus();
			 return(false);
     }
	 
	 //(7) VERIFICO QUE EXISTA ALGO EN EL CAMPO STOCK MÍNIMO Y QUE ESTO SEA UN NÚMERO.
	 if ( document.form_nuevo_articulo.stock_minimo.value == "" )  {
	     alert('Por favor introduzca el Stock M\xEDnimo que debe tener su Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.stock_minimo.focus();
		 return(false);   
     }
	 
	 if ( isNaN(document.form_nuevo_articulo.stock_minimo.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el Stock M\xEDnimo. GRACIAS');
			 document.form_nuevo_articulo.stock_minimo.focus();
			 return(false);
     }
	  
	 //(8) VERIFICO QUE EXISTA ALGO EN EL CAMPO COSTO UNITARIO Y QUE ESTO SEA UN NÚMERO.
	 if ( document.form_nuevo_articulo.precio_costo_art.value == "" )  {
	     alert('Por favor introduzca el Costo Unitario del Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.precio_costo_art.focus();
		 return(false);   
     }
	 
	 if ( isNaN(document.form_nuevo_articulo.precio_costo_art.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el Costo Unitario. GRACIAS');
			 document.form_nuevo_articulo.precio_costo_art.focus();
			 return(false);
     }  
	   
	 //(9) VERIFICO QUE EXISTA ALGO EN EL CAMPO PRECIO DE VENTA 1 Y QUE ESTO SEA UN NÚMERO.
	 if ( document.form_nuevo_articulo.precio_venta1.value == "" )  {
	     alert('Por favor introduzca el Precio de Venta 1 del Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.precio_venta1.focus();
		 return(false);   
     }
	 
	 if ( isNaN(document.form_nuevo_articulo.precio_venta1.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el Precio de Venta 1. GRACIAS');
			 document.form_nuevo_articulo.precio_venta1.focus();
			 return(false);
     }   
	   
	 //(10) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO PRECIO DE VENTA 2.
	 //(11) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO PRECIO DE VENTA 3.
	   
	  //(12) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	 if (confirm("Si son correctos los datos, por favor acepte \n\n" + "C\xF3digo: " + document.form_nuevo_articulo.codigo_art.value + "\n" + "Unidad de Medida: " + document.form_nuevo_articulo.unidad_medida.value + "\n" + "Referencia: " + document.form_nuevo_articulo.referencia_art.value + "\n" + "Detalles: " + document.form_nuevo_articulo.detalle_art.value + "\n" + "Proveedor: " + document.form_nuevo_articulo.proveedor_art.value + "\n" + "Stock Actual: " + document.form_nuevo_articulo.stock_actual.value + "\n" + "Stock M\xEDnimo: " + document.form_nuevo_articulo.stock_minimo.value + "\n" + "Costo Unitario: " + document.form_nuevo_articulo.precio_costo_art.value + "\n" + "Precio de Venta 1: " + document.form_nuevo_articulo.precio_venta1.value + "\n" + "Precio de Venta 2: " + document.form_nuevo_articulo.precio_venta2.value + "\n" + "Precio de Venta 3: " + document.form_nuevo_articulo.precio_venta3.value))  {
		    document.form_nuevo_articulo.action = "includes/mod_inventario_functions.php?data=send";
		    document.form_nuevo_articulo.submit();
	 } else {
			return (false);  
	 }    
	   
   } // Fin de la function send_articulo()

//61. 
	function edit_articulo()
	{
		// Función que envía el formulario de edición de los datos de un artículo (EDITAR).
        //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL CÓDIGO DEL ARTÍCULO.
	   if ( document.form_nuevo_articulo.codigo_art.value == "" )  {
	       alert('Por favor introduzca un C\xF3digo para el Art\xEDculo. GRACIAS');
		   document.form_nuevo_articulo.codigo_art.focus();
		   return(false);   
       }
	   //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO UNIDAD DE MEDIDA.
	 if ( document.form_nuevo_articulo.unidad_medida.value == "" )  {
	     alert('Por favor introduzca la Unidad de Medida del Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.unidad_medida.focus();
		 return(false);   
     }
	    //(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO REFERENCIA DEL ARTÍCULO.
	 if ( document.form_nuevo_articulo.referencia_art.value == "" )  {
	     alert('Por favor introduzca alguna referencia para el Art\xEDxculo. GRACIAS');
		 document.form_nuevo_articulo.referencia_art.focus();
		 return(false);   
     }
	     //(4) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO DETALLE DEL ARTÍCULO.
	  
	 //(5) VERIFICO QUE EXISTA ALGO EN EL CAMPO STOCK MÍNIMO Y QUE ESTO SEA UN NÚMERO.
	 if ( document.form_nuevo_articulo.stock_minimo.value == "" )  {
	     alert('Por favor introduzca el Stock M\xEDnimo que debe tener su Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.stock_minimo.focus();
		 return(false);   
     }    
	 
	 if ( isNaN(document.form_nuevo_articulo.stock_minimo.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el Stock M\xEDnimo. GRACIAS');
			 document.form_nuevo_articulo.stock_minimo.focus();
			 return(false);
     }
	  
	 //(6) VERIFICO QUE EXISTA ALGO EN EL CAMPO COSTO UNITARIO Y QUE ESTO SEA UN NÚMERO.
	 if ( document.form_nuevo_articulo.precio_costo_art.value == "" )  {
	     alert('Por favor introduzca el Costo Unitario del Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.precio_costo_art.focus();
		 return(false);   
     }
	 
	 if ( isNaN(document.form_nuevo_articulo.precio_costo_art.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el Costo Unitario. GRACIAS');
			 document.form_nuevo_articulo.precio_costo_art.focus();
			 return(false);
     }  
	   
	 //(7) VERIFICO QUE EXISTA ALGO EN EL CAMPO PRECIO DE VENTA 1 Y QUE ESTO SEA UN NÚMERO.
	 if ( document.form_nuevo_articulo.precio_venta1.value == "" )  {
	     alert('Por favor introduzca el Precio de Venta 1 del Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.precio_venta1.focus();
		 return(false);   
     }
	 
	 if ( isNaN(document.form_nuevo_articulo.precio_venta1.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en el Precio de Venta 1. GRACIAS');
			 document.form_nuevo_articulo.precio_venta1.focus();
			 return(false);
     }   
	   
	 //(8) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO PRECIO DE VENTA 2.
	 //(9) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO PRECIO DE VENTA 3.
	   
	 //(10) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	 if (confirm("Si son correctos los datos de actualizaci\xF3n, por favor acepte \n\n" + "C\xF3digo: " + document.form_nuevo_articulo.codigo_art.value + "\n" + "Unidad de Medida: " + document.form_nuevo_articulo.unidad_medida.value + "\n" + "Referencia: " + document.form_nuevo_articulo.referencia_art.value + "\n" + "Detalles: " + document.form_nuevo_articulo.detalle_art.value + "\n" + "Proveedor: " + document.form_nuevo_articulo.proveedor_art.value + "\n" + "Stock M\xEDnimo: " + document.form_nuevo_articulo.stock_minimo.value + "\n" + "Costo Unitario: " + document.form_nuevo_articulo.precio_costo_art.value + "\n" + "Precio de Venta 1: " + document.form_nuevo_articulo.precio_venta1.value + "\n" + "Precio de Venta 2: " + document.form_nuevo_articulo.precio_venta2.value + "\n" + "Precio de Venta 3: " + document.form_nuevo_articulo.precio_venta3.value))  {
		    document.form_nuevo_articulo.action = "includes/mod_inventario_functions.php?data=editar";
		    document.form_nuevo_articulo.submit();
	 } else {
			return (false);  
	 }    
   }  // Fin de la función edit_artículo()
      
//62. 
	function send_local()
	{
		// Función que envia los datos al crear un nuevo local en el inventario 
		//(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL NOMBRE DEL LOCAL.
	    if ( document.form_nuevo_local.nombre_local.value == "" )  {
	        alert('Por favor introduzca el Nombre de su Nuevo Local. GRACIAS');
		    document.form_nuevo_local.nombre_local.focus();
		    return(false);   
        }
	    //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DIRECCIÓN DEL LOCAL.
	    if ( document.form_nuevo_local.direccion_local.value == "" )  {
	       alert('Por favor introduzca la Direcci\xF3n del Nuevo Local. GRACIAS');
		   document.form_nuevo_local.direccion_local.focus();
		   return(false);   
        }
	    //(3) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO TELÉFONO DEL LOCAL.
	  	  
	    //(4) VERIFICO QUE EXISTA ALGO EN EL CAMPO NOMBRE DEL RESPONSABLE.
	    if ( document.form_nuevo_local.nombre_responsable.value == "" )  {
	        alert('Por favor introduzca el Nombre del Responsable del Nuevo Local. GRACIAS');
		    document.form_nuevo_local.nombre_responsable.focus();
		    return(false);   
        }
				
	      //(5) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Si son correctos los datos para el nuevo local, por favor acepte \n\n" + "Nombre del Local: " + document.form_nuevo_local.nombre_local.value + "\n" + "Direcci\xF3n del Local: " + document.form_nuevo_local.direccion_local.value + "\n" + "Tel\xE9fono del Local: " + document.form_nuevo_local.telefono_local.value + "\n" + "Tipo de Local: " + document.form_nuevo_local.tipo_local.value + "\n\n" + "Nombre del Responsable: " + document.form_nuevo_local.nombre_responsable.value + "\n" + "Tel\xE9fono del Responsable: " + document.form_nuevo_local.telefono_responsable.value + "\n" + "Celular del Responsable: " + document.form_nuevo_local.cell_responsable.value + "\n" + "Email del Responsable: " + document.form_nuevo_local.email_responsable.value))  {
		    document.form_nuevo_local.action = "includes/mod_inventario_functions.php?data=send_new_local";
		    document.form_nuevo_local.submit();
	  
	    } else {
		    return(false);	
		}
		
	}    // FIN DE LA FUNCTION send_local()
		
//63. 
	function show_campos_local(data)   
	{
		// Función que se llama cuando la petición ajax para la edición de locales se ha completado. 	
		//01 Con esto se almacena el JSON en una variable Javascript, sin almacenar la propia cadena, sino el objeto que representa, variable, operador punto y luego el nombre de la propiedad a acceder.
	  data = eval(data);  
	  
	  //02 Esto es lo que pongo en el formulario de LOCALES,de la respuesta en json a la peticion ajax a edit_local_inventario.php
	   document.form_nuevo_local.nombre_local.value    = data.nombre_local; 
	   document.form_nuevo_local.direccion_local.value = data.direccion_local;   
	   document.form_nuevo_local.telefono_local.value  = data.telefono_local;  
       
	   //03 VERIFICO QUE EL LOCAL SEA UNA BODEGA O NO.
	   if ( data.tipo_local == "bodega" )  {
	       // Esto significa que el local es una BODEGA.
	       $('#tipo_local_to_edit_bodega').css('display','block');
		   $('#tipo_local_to_edit_almacen').css('display','none');
		   document.form_nuevo_local.tipo_local.value      = data.tipo_local;  
	   } else if ( data.tipo_local == "almacen" )  {
	       // Esto significa que el local es un ALMACÉN.
	       $('#tipo_local_to_edit_bodega').css('display','none');
		   $('#tipo_local_to_edit_almacen').css('display','block');
		   document.form_nuevo_local.tipo_local.value      = data.tipo_local;  
	   }
	   
	   document.form_nuevo_local.nombre_responsable.value   = data.nombre_responsable;
       document.form_nuevo_local.telefono_responsable.value = data.telefono_responsable;
       document.form_nuevo_local.cell_responsable.value     = data.cell_responsable;
	   document.form_nuevo_local.email_responsable.value     = data.email_responsable;
		
     //03 Campo hidden para que la opción no sea 'nuevo'		
	   document.form_nuevo_local.id_local.value = data.id_local;
				
	}  // Fin de la función show_campos_local()
		
//64. 
	function inicio_form_nuevo_local() 
	{
		// Función que inicializa todos los campos de los formularios de administrar de inventario a 0
		
	   //01 Pongo todos los campos del formulario a 0	
	   document.form_nuevo_local.nombre_local.value    = ""; 
	   document.form_nuevo_local.direccion_local.value = "";   
	   document.form_nuevo_local.telefono_local.value  = "";  
       document.form_nuevo_local.tipo_local.value      = 'bodega';  
       
	   document.form_nuevo_local.nombre_responsable.value   = "";
       document.form_nuevo_local.telefono_responsable.value = "";
       document.form_nuevo_local.cell_responsable.value     = "";
	   document.form_nuevo_local.email_responsable.value    = "";
		
       //02 Campo hidden para que la opción sea 'nuevo'		
	   document.form_nuevo_local.id_local.value = 'nuevo';
	   
	   //03 Reset los valores (radios) de la tabla
	   document.numero_locales.reset();
	
	}  // Fin de la función inicio_form_nuevo_local()
		
//65. 
  function able_descripcion()
  {
	  // Función que habilita el campo text para seleccionar el artículo por DESCRIPCIÓN 
	  
	  //01 INICIALIZO TODO.
	  reset_all_camps_in_mov();
	  
	  var valor_descripcion = document.getElementById('valor_descripcion');   // Por descripción.  
	  var valor_codigo = document.getElementById('valor_codigo');             // Por descripción.
	  var valor_descripcion2 = document.getElementById('valor_descripcion2'); // Por código.  
	  var valor_codigo2 = document.getElementById('valor_codigo2');           // Por código.
	  	  
	  valor_descripcion.value = ""; 			// Por descripción. 
	  valor_codigo.value = "";                  // Por descripción.  
	  valor_descripcion2.value = ""; 			// Por código.
	  valor_codigo2.value = "";                 // Por código.
	 
	  document.getElementById('error_message_search_ref_art').innerHTML = "";  // Inicializa si está escrito algún mensaje si anteriormente se escribió un código erróneo.
	  
	  valor_descripcion.disabled = ""; 				
	  valor_codigo.disabled = "disabled";
	  $('.autocomplete_descrip').css('display','block'); // Muestro el <div> con los campos <text> para escribir la descripción del artículo. 
	  
	  valor_codigo2.disabled = "disabled";
	  valor_descripcion2.disabled = "disabled"; 	
	  $('.autocomplete_codigo').css('display','none');   // Escondo el <div> con los campos <text> para escribir el código del artículo. 
	    					
	 document.form_nuevo_mov.descripcion_articulo.focus();
	  
  }   // Fin de la función able_descripcion()
 
//66. 
  function able_codigo()
  {
	  // Función que habilita el campo text para seleccionar el artículo por CÓDIGO.	
  
      //01 INICIALIZO TODO.
	  reset_all_camps_in_mov();
  
      var valor_descripcion2 = document.getElementById('valor_descripcion2'); // Por código.  
	  var valor_codigo2 = document.getElementById('valor_codigo2');           // Por código.
	  var valor_descripcion = document.getElementById('valor_descripcion');   // Por descripción.  
	  var valor_codigo = document.getElementById('valor_codigo');             // Por descripción.
	  
	  valor_descripcion2.value = ""; 			// Por código.
	  valor_codigo2.value = "";                 // Por código.
	  valor_descripcion.value = ""; 			// Por descripción. 
	  valor_codigo.value = "";                  // Por descripción.  
	  
	  document.getElementById('error_message_search_ref_art').innerHTML = "";  // Inicializa si está escrito algún mensaje si anteriormente se escribió un código erróneo.
	 
	  valor_codigo2.disabled = "";
	  valor_descripcion2.disabled = "disabled"; 	
	  $('.autocomplete_codigo').css('display','block');   // Escondo el <div> con los campos <text> para escribir el código del artículo. 
  
      valor_descripcion.disabled = "disabled"; 				
	  valor_codigo.disabled = "disabled";
	  $('.autocomplete_descrip').css('display','none'); // Muestro el <div> con los campos <text> para escribir la descripción del artículo. 
	    
	  document.form_nuevo_mov.codigo_articulo2.focus();
	  
  }  // Fin de la función able_codigo()
  
//67. 	
  function reset_all_camps_in_mov()
  {
	 // Función que inicializa todos los campos del formulario si:
	 /* 1. cambio el valor del artículo que quiero mover.
	    2. Toco cualquiera de los 2 radiobotones para seleccionar el artículo por: 1. Referencia 2. Código
	 */	 
		
	 document.getElementById('concepto_mov').value = 'seleccione';
	 document.getElementById('concepto_mov_letras').value = '';
     document.getElementById('origen_mov').value = 'seleccione';
	 document.getElementById('nombre_local_origen').value = '';
     document.getElementById('destino_mov').value = 'seleccione';
	 document.getElementById('nombre_local_destino').value = '';
	 document.getElementById('cantidad_movimiento_mov').value = '';
	 document.getElementById('stock_origen_mov').value = '';
	 document.getElementById('stock_origen_hidden_mov').value = '';
	 document.getElementById('stock_destino_mov').value = '';
	 document.getElementById('stock_destino_hidden_mov').value = '';
	 document.getElementById('observaciones_mov').value = ''; 
  
  } // Fin de la función reset_all_camps_in_mov()

//68. 
  function able_descripcion_kardex() 
  {
	  // Función que habilita el campo text para seleccionar el artículo por DESCRIPCIÓN  	
  
      var valor_descripcion = document.getElementById('valor_descripcionk');   // Por descripción.
	  var valor_codigo = document.getElementById('valor_codigok');             // Por descripción.
	  var valor_descripcion2 = document.getElementById('valor_descripcionk2'); // Por código.  
	  var valor_codigo2 = document.getElementById('valor_codigok2');           // Por código.
	  
	  valor_descripcion.value = ""; 			// Por descripción.
	  valor_codigo.value = "";                  // Por descripción.
	  valor_descripcion2.value = ""; 			// Por código.
	  valor_codigo2.value = "";                 // Por código.
	 
	  document.getElementById('error_message_search_ref_art_kardex').innerHTML = "";  // Inicializa si está escrito algún mensaje si anteriormente se escribió un código erróneo.
	 
	  valor_descripcion.disabled = ""; 				
	  valor_codigo.disabled = "disabled";
	  $('.autocomplete_kardex').css('display','block'); // Muestro el <div> con los campos <text> para escribir la descripción del artículo. 
	  					
	  valor_codigo2.disabled = "disabled";
	  valor_descripcion2.disabled = "disabled"; 	
	  $('.autocomplete_kardex_codigo').css('display','none');  // Escondo el <div> con los campos <text> para escribir el código del artículo. 
	  
	  document.form_kardex_art.descripcion_articulo.focus();
    
  }   // Fin de la function able_description_kardex()  	
    
//69. 
  function able_codigo_kardex() 
  {
	  // Función que habilita el campo text para seleccionar el artículo por CÓDIGO.  	
  
      var valor_descripcion2 = document.getElementById('valor_descripcionk2'); // Por código.  
	  var valor_codigo2 = document.getElementById('valor_codigok2');           // Por código.
	  var valor_descripcion = document.getElementById('valor_descripcionk');   // Por descripción.
	  var valor_codigo = document.getElementById('valor_codigok');             // Por descripción.
	 
	  valor_descripcion2.value = ""; 			// Por código.
	  valor_codigo2.value = "";                 // Por código.
	  valor_descripcion.value = ""; 			// Por descripción.
	  valor_codigo.value = "";                  // Por descripción.
	  	 
	  document.getElementById('error_message_search_ref_art_kardex').innerHTML = "";  // Inicializa si está escrito algún mensaje si anteriormente se escribió un código erróneo.
	 
	  valor_codigo2.disabled = "";
	  valor_descripcion2.disabled = "disabled"; 	
	  $('.autocomplete_kardex_codigo').css('display','block');  // Muestro el <div> con los campos <text> para escribir el código del artículo. 
	  
	  valor_descripcion.disabled = "disabled"; 				
	  valor_codigo.disabled = "disabled";
	  $('.autocomplete_kardex').css('display','none'); // Escondo el <div> con los campos <text> para escribir la descripción del artículo. 
	    
	  document.form_kardex_art.codigo_articulo2.focus();
    
  }   // Fin de la function able_codigo_kardex()  	
 
//70. 
  function send_mov()
  {
	  // Función que envía el formulario de movimientos de inventarios a la base de datos 
	  
	    //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA del movimiento.
	    if ( document.form_nuevo_mov.fecha_movimiento.value == "" )  {
	        alert('Por favor introduzca la Fecha del Movimiento. GRACIAS');
		    document.form_nuevo_mov.fecha_movimiento.focus();
		    return(false);   
        }
	    
		//(2) VERIFICO QUE ESTÉ SELECCIONADO ALGUNO DE LOS DOS RADIOBOTONES PARA SELECCIONAR EL ARTÍCULO 'Por Descripción' ó 'Por Código'.
		if ( document.getElementById('type_descripcion').checked == 0 && document.getElementById('type_codigo').checked == 0 )  {
		    alert('Por favor seleccione el Art\xEDculo para hacer el Movimiento. Marque alguno de los radiobotones. GRACIAS');
		    return(false);
		}
		
		//(3) CASO 1: SI ESTÁ SELECCIONADO EL RADIOBOTÓN DE ARTÍCULO 'Por Descripción'.
		if ( document.getElementById('type_descripcion').checked == 1 )  { 
		    //(3.1) VERIFICO QUE EXISTA ALGO EN EL CAMPO DESCRIPCIÓN del artículo.
	        if ( document.form_nuevo_mov.descripcion_articulo.value == "" )  {
	           alert('Por favor introduzca la Descripci\xF3n del Art\xEDculo. GRACIAS');
		       document.form_nuevo_mov.descripcion_articulo.focus();
		       return(false);   
            }
			
			//(3.2) VERIFICO QUE EXISTA ALGO EN EL CAMPO CÓDIGO del artículo que depende de la descripción.
	        if ( document.form_nuevo_mov.codigo_articulo.value == "" )  {
	            alert('Por favor introduzca una Descripci\xF3n del Art\xEDculo Correcta para obtener el C\xF3digo. GRACIAS');
		        document.form_nuevo_mov.descripcion_articulo.focus();
		        return(false);   
            }
        
		//(4) CASO 2: SI ESTÁ SELECCIONADO EL RADIOBOTÓN DE ARTÍCULO 'Por Código'.
		} else if ( document.getElementById('type_codigo').checked == 1 )  {
			//(4.1) VERIFICO QUE EXISTA ALGO EN EL CAMPO CÓDIGO del artículo para buscar la descripción.
	        if ( document.form_nuevo_mov.codigo_articulo2.value == "" )  {
	            alert('Por favor introduzca un C\xF3digo de Art\xEDculo V\xE1lido. GRACIAS');
		        document.form_nuevo_mov.codigo_articulo2.focus();
		        return(false);   
            }
		
		    //(4.2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DESCRIPCIÓN del artículo.
	        if ( document.form_nuevo_mov.descripcion_articulo2.value == "" )  {
	           alert('Por favor introduzca un C\xF3digo de Art\xEDculo V\xE1lido para obtener la Descripci\xF3n del mismo. GRACIAS');
		       document.form_nuevo_mov.codigo_articulo2.focus();
		       return(false);   
            }
			
		} //Fin de (3) y (4)
		
		//(5) VERIFICO QUE ESTÉ SELECCIONADO EL CONCEPTO DEL MOVIMIENTO.
	    if ( document.form_nuevo_mov.concepto_mov.value == "seleccione" )  {
	        alert('Por favor seleccione un Concepto de Movimiento V\xE1lido. GRACIAS');
		    document.form_nuevo_mov.concepto_mov.focus();
		    return(false);   
        }
		
		//(6) VERIFICO QUE ESTÉ SELECCIONADO EL ORIGEN.
	    if ( document.form_nuevo_mov.origen_mov.value == "seleccione" )  {
	        alert('Por favor seleccione el Origen del Movimiento. GRACIAS');
		    document.form_nuevo_mov.origen_mov.focus();
		    return(false);   
        }
		
		//(7) VERIFICO QUE ESTÉ SELECCIONADO EL DESTINO.
	    if ( document.form_nuevo_mov.destino_mov.value == "seleccione" )  {
	        alert('Por favor seleccione el Destino del Movimiento. GRACIAS');
		    document.form_nuevo_mov.destino_mov.focus();
		    return(false);   
        }
		
		//(8) VERIFICO QUE EXISTA ALGO EN EL CAMPO CANTIDAD DEL MOVIMIENTO.
	    if ( document.form_nuevo_mov.cantidad_movimiento.value == "" )  {
	        alert('Por favor introduzca la cantidad de unidades del Art\xEDculo que va a Mover. GRACIAS');
		    document.form_nuevo_mov.cantidad_movimiento.focus();
		    return(false);   
        }
		
		//(9) VERIFICO QUE EL VALOR DEL MOVIMIENTO SEA UN VALOR NUMÉRICO
		if ( isNaN(document.form_nuevo_mov.cantidad_movimiento.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en la cantidad de unidades del Art\xEDculo que va a Mover. GRACIAS');
			 document.form_nuevo_mov.cantidad_movimiento.focus();
			 return(false);
        }  
		
		//(10) VERIFICO QUE EL VALOR DE LA CANTIDAD QUE VOY MOVER NO EXCEDA LA CANTIDAD QUE HAY EN EL STOCK ORIGEN
		var StockOrigen    = document.form_nuevo_mov.stock_origen.value;
		var CantMov        = document.form_nuevo_mov.cantidad_movimiento.value;
		    StockOrigen    = parseFloat(StockOrigen);
	        CantMov        = parseFloat(CantMov);
	 	 
	    if ( CantMov > StockOrigen )  {
		     // ESTO SIGNIFICA QUE ES MAYOR LO QUE VOY A MOVER QUE LA CANTIDAD REAL QUE TENGO EN EL ALMACÉN
	         alert('Disculpe!' + '\n' + 'Usted va a hacer un movimiento que excede el valor real de su stock en el origen.' + '\n' + 'Por favor rectifique en el campo "Cantidad ( S\xF3lo N\xFAmero )"' + '\n' + 'GRACIAS');
	         document.form_nuevo_mov.cantidad_movimiento.focus();
		     return(false);
	    }
		
		//(11) VERIFICO QUE EL VALOR DE LA CANTIDAD QUE VOY MOVER NO SEA 0
		if ( CantMov == 0 )   {
		    alert('Disculpe!' + '\n' + 'La cantidad de art\xEDculos es 0' + '\n' + 'Por favor rectifique en el campo "Cantidad ( S\xF3lo N\xFAmero )"' + '\n' + 'GRACIAS');
	         document.form_nuevo_mov.cantidad_movimiento.focus();
		     return(false);	
		}
 		
		//(12) VERIFICO QUE EL STOCK ORIGEN NO SEA 0 (ESTE NUNCA SALE POR EL //(10))
		if ( StockOrigen == 0 )  {
		     alert('Disculpe!' + '\n' + 'La cantidad de art\xEDculos en el Stock Origen es 0' + '\n' + 'Por favor rectifique el Origen' + '\n' + 'GRACIAS')	
		     return(false);
		}
		
		//(13) VERIFICO SI EL CONCEPTO DEL MOVIMIENTO ES AJUSTE DE INVENTARIO y EL ORIGEN ES UN "local" Y EL DESTINO ES "Otros" o VICEVERSA
		if ( document.form_nuevo_mov.concepto_mov.value == "ajuste_inv" )   {
				
			switch( document.form_nuevo_mov.origen_mov.value )
			{
				   case "otros":
				         if ( document.form_nuevo_mov.destino_mov.value == "otros" )  {
							 // CASO 1.  Si el origen es "Otros" EL DESTINO no puede ser "Otros"
				             alert('Disculpe!' + '\n' + 'Para un Ajuste de Inventarios debe de haber un Local Seleccionado' + '\n' + 'Por favor rectifique' + '\n' + 'GRACIAS')	
		                return(false);
				         }
				   break;
				   
				  default:
				         // CASO 2. Si el ORIGEN no es "otros" el DESTINO tiene que ser "otros"  
						 if ( document.form_nuevo_mov.destino_mov.value != "otros" )  {
				             alert('Disculpe!' + '\n' + 'Para un Ajuste de Inventarios el Origen o el Destino NO debe ser un Local' + '\n' + 'Por favor rectifique' + '\n' + 'GRACIAS')	
		                return(false);
				         }
				   break;
			} // fin del switch
		
		}
				
		//(14) VERIFICO QUE EL ORIGEN Y EL DESTINO NO SEAN EL MISMO LOCAL
		if ( document.form_nuevo_mov.origen_mov.value == document.form_nuevo_mov.destino_mov.value )   {
		    alert('Disculpe!' + '\n' + 'Ha seleccionado el mismo Local Origen y Destino' + '\n' + 'Por favor rectifique' + '\n' + 'GRACIAS')	
		    return(false);
		}
		
		//(15) VERIFICO SI ESTÁ SELECCIONADA SELECCIONAR EL ARTÍCULO 1. POR DESCRIPCIÓN 2. POR CÓDIGO 
		if ( document.getElementById('type_descripcion').checked == 1 )  { 
		    // CASO 1. CAMPO HIDDEN CON EL VALOR DEL CÓDIGO DEL ARTÍCULO
		    document.form_nuevo_mov.codigo_articulo_mov.value = document.form_nuevo_mov.codigo_articulo.value;
			document.form_nuevo_mov.referencia_articulo_mov_hidden.value = document.form_nuevo_mov.descripcion_articulo.value;
		
		} else if ( document.getElementById('type_codigo').checked == 1 )  {
			// CASO 2. CAMPO HIDDEN CON EL VALOR DEL CÓDIGO DEL ARTÍCULO
		    document.form_nuevo_mov.codigo_articulo_mov.value = document.form_nuevo_mov.codigo_articulo2.value;
			document.form_nuevo_mov.referencia_articulo_mov_hidden.value = document.form_nuevo_mov.descripcion_articulo2.value;
		}
				
		//(16) CAMPO HIDDEN CON EL VALOR DEL STOCK ORIGEN
		document.form_nuevo_mov.stock_origen_hidden.value = document.form_nuevo_mov.stock_origen.value;
		//(17) CAMPO HIDDEN CON EL VALOR DEL STOCK DESTINO
		document.form_nuevo_mov.stock_destino_hidden.value = document.form_nuevo_mov.stock_destino.value;		
		//(18) CAMPO HIDDEN CON EL VALOR DEL NOMBRE DEL LOCAL ORIGEN
		document.form_nuevo_mov.nombre_local_origen.value = document.form_nuevo_mov.origen_mov.options[document.form_nuevo_mov.origen_mov.selectedIndex].text	
		//(19) CAMPO HIDDEN CON EL VALOR DEL NOMBRE DEL LOCAL DESTINO
		document.form_nuevo_mov.nombre_local_destino.value = document.form_nuevo_mov.destino_mov.options[document.form_nuevo_mov.destino_mov.selectedIndex].text
		//(20) CAMPO HIDDEN CON EL VALOR DEL CONCEPTO DEL MOVIMIENTO
		document.form_nuevo_mov.concepto_mov_letras.value = document.form_nuevo_mov.concepto_mov.options[document.form_nuevo_mov.concepto_mov.selectedIndex].text
		
		//(21) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Si son correctos los datos para el MOVIMIENTO, por favor acepte \n\n" + "Fecha del Movimiento: " + document.form_nuevo_mov.fecha_movimiento.value + "\n" + "Descripci\xF3n del Art\xEDculo: " + document.form_nuevo_mov.referencia_articulo_mov_hidden.value + "\n" + "C\xF3digo del Art\xEDculo: " + document.form_nuevo_mov.codigo_articulo_mov.value + "\n" + "Cantidad de Unidades Stock Origen: " + document.form_nuevo_mov.stock_origen_hidden.value + "\n" + "Cantidad de Unidades Stock Destino: " + document.form_nuevo_mov.stock_destino_hidden.value + "\n\n" + "Concepto del Movimiento: " + document.form_nuevo_mov.concepto_mov.options[document.form_nuevo_mov.concepto_mov.selectedIndex].text + "\n" + "Origen del Movimiento: " + document.form_nuevo_mov.origen_mov.options[document.form_nuevo_mov.origen_mov.selectedIndex].text + "\n" + "Destino del Movimiento: " + document.form_nuevo_mov.destino_mov.options[document.form_nuevo_mov.destino_mov.selectedIndex].text + "\n\n" + "Cantidad: " + document.form_nuevo_mov.cantidad_movimiento.value + "\n" + "Observaciones: " + document.form_nuevo_mov.observaciones_mov.value		))  {
		    document.form_nuevo_mov.action = "includes/mod_inventario_functions.php?data=send_new_mov";  // 
		    document.form_nuevo_mov.submit();
	  
	    } else {
		    return(false);	
		}
	  
  }   // Fin de la función send_mov()
  
//71. 
  function send_art_kardex()
  {     
        // Función que envía el formulario de KARDEX de un artículo y un local a consultar en la base de datos
        //(1) VERIFICO QUE ESTÉ SELECCIONADO ALGUNO DE LOS DOS RADIOBOTONES PARA SELECCIONAR EL ARTÍCULO 'Por Descripción' ó 'Por Código'.
		if ( document.getElementById('type_descripcionk').checked == 0 && document.getElementById('type_codigok').checked == 0 )  {
		    alert('Por favor seleccione el Art\xEDculo para ver el Kardex. Marque alguno de los radiobotones. GRACIAS');
		    return(false);
		}
	    
		//(2) CASO 1: SI ESTÁ SELECCIONADO EL RADIOBOTÓN DE ARTÍCULO 'Por Descripción'.
		if ( document.getElementById('type_descripcionk').checked == 1 )  {
			
			//(2.1) VERIFICO QUE EXISTA ALGO EN EL CAMPO DESCRIPCIÓN del artículo.
	        if ( document.form_kardex_art.descripcion_articulo.value == "" )  {
	            alert('Por favor introduzca la Descripci\xF3n del Art\xEDculo. GRACIAS');
		        document.form_kardex_art.descripcion_articulo.focus();
		        return(false);   
            }
			
			//(2.2) VERIFICO QUE EXISTA ALGO EN EL CAMPO CÓDIGO del artículo que depende de la descripción.
	        if ( document.form_kardex_art.codigo_articulo.value == "" )  {
	            alert('Por favor introduzca una Descripci\xF3n del Art\xEDculo Correcta para obtener el C\xF3digo. GRACIAS');
		        document.form_kardex_art.descripcion_articulo.focus();
		        return(false);   
            }
			
		//(3) CASO 2: SI ESTÁ SELECCIONADO EL RADIOBOTÓN DE ARTÍCULO 'Por Código'.
		} else if ( document.getElementById('type_codigok').checked == 1 )  {
		
		    //(3.1) VERIFICO QUE EXISTA ALGO EN EL CAMPO CÓDIGO del artículo para buscar  la descripción.
	        if ( document.form_kardex_art.codigo_articulo2.value == "" )  {
	            alert('Por favor introduzca un C\xF3digo de Art\xEDculo V\xE1lido. GRACIAS');
		        document.form_kardex_art.codigo_articulo2.focus();
		        return(false);   
            }
			
			//(3.2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DESCRIPCIÓN del artículo.
	        if ( document.form_kardex_art.descripcion_articulo2.value == "" )  {
	            alert('Por favor introduzca un C\xF3digo de Art\xEDculo V\xE1lido para obtener la Descripci\xF3n del mismo. GRACIAS');
		        document.form_kardex_art.codigo_articulo2.focus();
		        return(false);   
            }
			
		} // Fin del (2) y (3)
			
		//(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA INICIAL del reporte de kardex.
	    if ( document.form_kardex_art.fecha_inicial.value == "" )  {
	        alert('Por favor introduzca la Fecha Inicial del Kardex. GRACIAS');
		    document.form_kardex_art.fecha_inicial.focus();
		    return(false);   
        }
		
		//(4) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA FINAL del reporte de kardex.
	    if ( document.form_kardex_art.fecha_final.value == "" )  {
	        alert('Por favor introduzca la Fecha Final del Kardex. GRACIAS');
		    document.form_kardex_art.fecha_final.focus();
		    return(false);   
        }
		
		//(5) VERIFICO QUE ESTÉ SELECCIONADO EL LOCAL.
	    if ( document.form_kardex_art.local_kardex.value == "seleccione" )  {
	        alert('Por favor seleccione el Local para ver el Kardex. GRACIAS');
		    document.form_kardex_art.local_kardex.focus();
		    return(false);   
        }
		
		//(6) VERIFICO SI ESTÁ SELECCIONADA SELECCIONAR EL ARTÍCULO 1. POR DESCRIPCIÓN 2. POR CÓDIGO 
		if ( document.getElementById('type_descripcionk').checked == 1 )  { 
		    // CASO 1. CAMPO HIDDEN CON EL VALOR DEL CÓDIGO DEL ARTÍCULO
		    document.form_kardex_art.codigo_articulo_kardex.value = document.form_kardex_art.codigo_articulo.value;
			document.form_kardex_art.referencia_articulo_kardex_hidden.value = document.form_kardex_art.descripcion_articulo.value;
		
		} else if ( document.getElementById('type_codigok').checked == 1 )  {
			// CASO 2. CAMPO HIDDEN CON EL VALOR DEL CÓDIGO DEL ARTÍCULO
		    document.form_kardex_art.codigo_articulo_kardex.value = document.form_kardex_art.codigo_articulo2.value;
			document.form_kardex_art.referencia_articulo_kardex_hidden.value = document.form_kardex_art.descripcion_articulo2.value;
		}
			
		//(7) CAMPO HIDDEN CON EL VALOR DEL NOMBRE DEL LOCAL
		document.form_kardex_art.nombre_local_kardex.value = document.form_kardex_art.local_kardex.options[document.form_kardex_art.local_kardex.selectedIndex].text	
  
        //(8) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Si son correctos los datos del Kardex, por favor acepte \n\n" + "Descripci\xF3n del Art\xEDculo: " + document.form_kardex_art.referencia_articulo_kardex_hidden.value + "\n" + "C\xF3digo del Art\xEDculo: " + document.form_kardex_art.codigo_articulo_kardex.value + "\n" + "Fecha Inicial: " + document.form_kardex_art.fecha_inicial.value + "\n" + "Fecha Final: " + document.form_kardex_art.fecha_final.value + "\n" + "Local: " + document.form_kardex_art.nombre_local_kardex.value
))  {
		    document.form_kardex_art.action = "index.php?mod=mod_inventario&optioninv=kardex&karart=ver#tabs-3";  // 
		    document.form_kardex_art.submit();
	  
	    } else {
		    return(false);	
		}
	  
  }    // Fin de la función send_art_kardex()
    
//72. 
  function send_resmov()
  {
	    // Función que envía el formulario de RESUMEN MOV. ARTÍCULOS de un local en específico.
        //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA INICIAL del reporte de Resumen de Movimiento de Inventario.
	    if ( document.form_resmov.fecha_inicial.value == "" )  {
	        alert('Por favor introduzca la Fecha Inicial. GRACIAS');
		    document.form_resmov.fecha_inicial.focus();
		    return(false);   
        }
		
		//(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA FINAL del reporte de de Resumen de Movimiento de Inventario.
	    if ( document.form_resmov.fecha_final.value == "" )  {
	        alert('Por favor introduzca la Fecha Final. GRACIAS');
		    document.form_resmov.fecha_final.focus();
		    return(false);   
        }
  
        //(3) VERIFICO QUE ESTÉ SELECCIONADO EL <select> del LOCAL.
	    if ( document.form_resmov.local_resmov.value == 'seleccione' )  {
	        alert('Por favor seleccione el Local. GRACIAS');
		    document.form_resmov.local_resmov.focus();
			return(false);  
		}
  
        //(4) VARIABLE QUE VOY A PONER EN EL confirm PARA SABER LOS QUE DESEA VER EL USUARIO. 
	    if ( document.form_resmov.ver_solo.value == 'seleccione' )  {
	        alert('Por favor seleccione si de desea ver una Entrada, una Salida o Ambos. GRACIAS');
		    document.form_resmov.ver_solo.focus();
			return(false);  
		} else if ( document.form_resmov.ver_solo.value == 'entradas' ) {
		    
			var ver_solo = 'Entradas';	
			
		} else if ( document.form_resmov.ver_solo.value == 'salidas' ) {
		    	
			var ver_solo = 'Salidas';
			
		} else if ( document.form_resmov.ver_solo.value == 'ambos' ) {
		    	
		    var ver_solo = 'Entradas y Salidas';
			
		} 		
		
		//(5) CAMPO HIDDEN CON EL VALOR DEL NOMBRE DEL LOCAL
		document.form_resmov.nombre_local_resmov.value = document.form_resmov.local_resmov.options[document.form_resmov.local_resmov.selectedIndex].text;
		 
		//(6) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Si son correctos los datos, por favor acepte \n\n" + "Fecha Inicial: " + document.form_resmov.fecha_inicial.value + "\n" + "Fecha Final: " + document.form_resmov.fecha_final.value + "\n" + "Local: " + document.form_resmov.nombre_local_resmov.value + "\n" + "Ver Solamente: " + ver_solo
))  {
		    document.form_resmov.action = "index.php?mod=mod_inventario&optioninv=mov_invres&resmov=ver#tabs-3";  
		    document.form_resmov.submit();
	  
	    } else {
		    return(false);	
		}
  
  }  // Fin del función send_resmov()
  
//73. 
  function send_stock()
  {
	    // Función que envía el formulario de STOCK de un local en específico.
	    //(1) VERIFICO QUE ESTÉ SELECCIONADO EL <select> del LOCAL.
	    if ( document.form_stock.local_stock.value == 'seleccione' )  {
	        alert('Por favor seleccione el Local. GRACIAS');
		    document.form_stock.local_stock.focus();
			return(false);  
		}
  
	    //(2) CAMPO HIDDEN CON EL VALOR DEL NOMBRE DEL LOCAL
		document.form_stock.nombre_local_stock.value = document.form_stock.local_stock.options[document.form_stock.local_stock.selectedIndex].text;
		 
		//(3) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Realmente desea ver el Stock del Local: " + document.form_stock.nombre_local_stock.value + "\n\n Por favor acepte."))  {
		    document.form_stock.action = "index.php?mod=mod_inventario&optioninv=stock&stockl=ver#tabs-3";  
		    document.form_stock.submit();
	  
	    } else {
		    return(false);	
		}
    
  }   // Fin de la función send_stock()
    
//74. 
   function add_pendiente()
   {
	   // Función que envía el radio botón seleccionado como artículo PENDIENTE al LOCAL (ENTRADA)
       
	   var contador_elementos_checkbox = 0;
	   var contador = 0;
	   
	   //(1) VERIFICO QUE EXISTA AL MENOS UN RADIO BOTÓN SELECCIONADO 
	           
			  for ( i=0; i < document.pendientes_entrada.elements.length; i++ ) 
	          {
	               if ( document.pendientes_entrada.elements[i].type == "checkbox")	 {
			           contador_elementos_checkbox++;
					   if (document.pendientes_entrada.elements[i].checked == 1 )  {
				           contador++;
				           continue;  
			           } else {
			               continue;  
			           }
		           }
	          }  // Fin del FOR
				     
			  if ( contador == 1 )  {
			      var num_pendientes = 1 + " art\xEDculo seleccionado"; 
			  } else if ( contador > 1 )  {
			  	  var num_pendientes = contador + " art\xEDculos seleccionados"; 
			  }
			  
			  //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN CHECKBOX BOTTON
			  if ( contador == 0 )  {
				  // Esto significa que no se seleccionó ningún radio botón.
			      alert('Por favor seleccione el Art\xEDculo Pendiente que desea a\xF1adir al Inventario');
			      			  	  
				  return (false);
			      
			  } else {
				  //(3) CONFIRMO QUE SE VA A AÑADIR EL ELEMENTO CORRECTO
				  if (confirm("Si est\xE1 seguro que va a a\xF1adir " + num_pendientes + " al Inventario \n Por favor acepte."))  {
		              document.pendientes_entrada.action = "includes/mod_inventario_functions.php?data=send_art_pendientes";  
		              document.pendientes_entrada.submit();
	              
				  // index.php?mod=mod_inventario&optioninv=stock&stockl=ver#tabs-3
				  } else {
		              return(false);	
		          }
						  
			  }
        
   }   // Fin de la función add_pendiente()
  
  /**************************************************************************************************************
                                               MÓDULO USUARIOS
   ****************************************************************************************************************/
//75. 
  function goinicio_users(variable) 
  {
	  // Función que envía al inicio del módulo a los usuarios que están en las vistas internas.
	  
      document.location.href = 'index.php?mod=mod_users#tabs-2';
  }   // Fin de la función goinicio_users('inicio')
  
//76. 
  function accion_users(num, acc)
  {
	  // Función que envía el submit para poder habilitar-inhabilitar usuarios.
      
	  //alert("includes/mod_users_functions.php?acc=" + acc +"&num=" + num +"");
	  document.data_users.action = "includes/mod_users_functions.php?acc=" + acc +"&num=" + num +""; 
	  document.data_users.submit();
    
  }  // Fin de la función accion_users(num) 
 
//77.
  function  send_user()
  {
	  // Función  que precesa la entrada de nuevos usuarios a la BD.
      
	  //(1) VERIFICO QUE EN EL CAMPO <select> NO ESTÉ SELECCIONAO 'Seleccione'
	    if ( document.form_new_user.tipo_usuario.value == "s" )  {
	        alert('Por favor introduzca un Tipo de Usuario V\xE1lido. GRACIAS');
		    document.form_new_user.tipo_usuario.focus();
		    return(false);   
        } 
    
      //(2) VERIFICO QUE SI EN EL  CAMPO <select> ESTÁ SELECCIONAO 'vendedor' no esté seleccionado 'seleccione' en el id_almacen
	    if ( document.form_new_user.tipo_usuario.value == "v" )  {
	        if ( document.form_new_user.id_almacen.value == "s" )  {
			    alert('Por favor introduzca el Almac\xE9n para del usuario Vendedor. GRACIAS');
		        document.form_new_user.id_almacen.focus();
		        return(false);
			}
		}
  
      //(3) TIPO DE USUARIO
	    var usuario = document.form_new_user.tipo_usuario.value;
		if ( usuario == "v" )  {
		    var user = "VENDEDOR";
		    var usuario_vendedor = "Local del usuario Vendedor: " + document.form_new_user.id_almacen.options[document.form_new_user.id_almacen.selectedIndex].text;
		} else if ( usuario == "a" ) {
		    var user = "ADMINISTRADOR";
			var usuario_vendedor = "";
		}
	   
	    //(4) Encripto la contraseña en md5
      var new_md5 = $().crypt({method:"md5", source:$("#contrasena").val()});
	         document.form_new_user.contrasena_hidden.value = new_md5;
			   
	   //(5) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Si son correctos los datos, por favor acepte \n\n" + "Nombre y Apellidos: " + document.form_new_user.nombre_apellidos.value + "\n" + "Nombre de Usuario: " + document.form_new_user.nombre_usuario.value + "\n" + "Tipo de usuario: " + user + "\n" + usuario_vendedor))  {
		    
			document.form_new_user.action = "includes/mod_users_functions.php?data=new_user";  
		    document.form_new_user.submit();
	  
	    } else {
		    return(false);	
		}
   
  }  // Fin de la función process_new_user()
  
//78. 
   function change_userpass() 
   {
	   // Función que procesa el cambio de la contraseña del usuario.
       
	   //(1) Encripto la contraseña en del usuario en md5
       var pass_md5 = $().crypt({method:"md5", source:$("#contrasena_chp").val()});
	         document.form_change_pass.contrasena_chp_hidden.value = pass_md5;  
   
       //(2) Envío el formulario
       document.form_change_pass.action = "includes/mod_users_functions.php?data=change_pass";  
	   document.form_change_pass.submit();
    
   }  // Fin de la función change_userpass() 
   
//79.
   function inicio_caja_button()
   {
	   // Función del botón de ir al inicio del Módulo. 
   
       document.location.href = 'index.php?mod=mod_caja#tabs-2';
   
   } // Fin de la función inicio_caja_button()
    
//80.
   function send_transaccion()
   {
	   // Función que envía el formulario de insertar nueva transacción.
	   //(1) VERIFICO QUE EN EL CAMPO FECHA ESTÉ SELECCIONADO.
	    if ( document.form_transaccion_caja.fecha_transaccion.value == "" )  {
	        alert('Por favor introduzca la Fecha de la Transacci\xF3n. GRACIAS');
		    document.form_transaccion_caja.fecha_transaccion.focus();
		    return(false);   
        } 
	   
	   //(2) VERIFICO QUE ESTÉ SELECCIONADO EL ORIGEN.
	    if ( document.form_transaccion_caja.origen_transaccion.value == "seleccione" )  {
	        alert('Por favor seleccione el Origen de la Transacci\xF3n. GRACIAS');
		    document.form_transaccion_caja.origen_transaccion.focus();
		    return(false);   
        }
	   
	    //(3) VERIFICO QUE ESTÉ SELECCIONADO EL DESTINO.
	    if ( document.form_transaccion_caja.destino_transaccion.value == "seleccione" )  {
	        alert('Por favor seleccione el Destino de la Transacci\xF3n. GRACIAS');
		    document.form_transaccion_caja.destino_transaccion.focus();
		    return(false);   
        }
	   
	    //(4) VERIFICO QUE EXISTA ALGO EN EL CAMPO CANTIDAD DE LA TRANSACCIÓN.
	    if ( document.form_transaccion_caja.cantidad_transaccion.value == "" )  {
	        alert('Por favor introduzca la cantidad de efectivo de la transacci\xF3n. GRACIAS');
		    document.form_transaccion_caja.cantidad_transaccion.focus();
		    return(false);   
        }
	   
	    //(5) VERIFICO QUE EL VALOR DE LA TRANSACCIÓN SEA UN VALOR NUMÉRICO
		if ( isNaN(document.form_transaccion_caja.cantidad_transaccion.value) )  { 
			 alert('Por favor introduzca un valor num\xE9rico en la cantidad de efectivo de la transacci\xF3n. GRACIAS');
			 document.form_transaccion_caja.cantidad_transaccion.focus();
			 return(false);
        }  
	   
	    //(6) VERIFICO QUE EL ORIGEN Y EL DESTINO NO SEAN LA CAJA DEL MISMO LOCAL
		if ( document.form_transaccion_caja.origen_transaccion.value == document.form_transaccion_caja.destino_transaccion.value )   {
		    alert('Disculpe!' + '\n' + 'Ha seleccionado el mismo Local Origen y Destino' + '\n' + 'Por favor rectifique' + '\n' + 'GRACIAS');	
		    return(false);
		}
	
	    //(7) VERIFICO QUE SI EL ORIGEN NO ES LA CAJA CENTRAL, EL DESTINO NO PUEDE SER EL REGISTRO BANCARIO.
	    if (( document.form_transaccion_caja.origen_transaccion.value != '1' ) && ( document.form_transaccion_caja.destino_transaccion.value == 'banco' )) {
		    alert('Disculpe!' + '\n' + 'Debe seleccionar la "Caja Central" en el Origen para poder hacer una transacci\xF3n en el Registro Bancario' + '\n' + 'Por favor rectifique' + '\n' + 'GRACIAS');	
		    return(false);
        }
		
		//(8) VERIFICO QUE EL VALOR DE LA CANTIDAD DE LA TRANSACIÓN NO SEA 0
		if ( CantTransac == 0 )   {
		    alert('Disculpe!' + '\n' + 'La cantidad de la transacci\xF3n es 0' + '\n' + 'Por favor rectifique en el campo "Cantidad ( S\xF3lo N\xFAmero )"' + '\n' + 'GRACIAS');
	         document.form_transaccion_caja.cantidad_transaccion.focus();
		     return(false);	
		}
		
		//(9) SI EL ORIGEN ES DISTINTO DE 'no' ENTONCES VERIFICO QUE SEA UN NUMERO PARA HACER LAS COMPROBACIONES 
	    if ( document.form_transaccion_caja.saldo_en_caja.value == 'no' )  {
			
			// NO PASA NADA
		
		} else {
		   
		   	//(10) VERIFICO QUE EL VALOR DE LA CANTIDAD QUE VOY MOVER NO EXCEDA LA CANTIDAD QUE HAY EN LA CAJA ORIGEN.
		    var SaldoOrigen    = document.form_transaccion_caja.saldo_en_caja.value;
		    var CantTransac    = document.form_transaccion_caja.cantidad_transaccion.value;
		        SaldoOrigen    = parseFloat(SaldoOrigen);
	            CantTransac    = parseFloat(CantTransac);
	
	        if ( CantTransac > SaldoOrigen )  {
		       // ESTO SIGNIFICA QUE ES MAYOR LO QUE VOY A MOVER QUE LA CANTIDAD REAL QUE TENGO EN LA CAJA DE ORIGEN.
	           alert('Disculpe!' + '\n' + 'Usted va a hacer una Transacci\xF3n que excede el valor real de su efectivo en el origen.' + '\n' + 'Por favor rectifique en el campo "Cantidad ( S\xF3lo N\xFAmero )"' + '\n' + 'GRACIAS');
	           document.form_transaccion_caja.cantidad_transaccion.focus();
		       return(false);
	        }
			
	        //(11) VERIFICO QUE EL SALDO EN EL ORIGEN NO SEA 0 (ESTE NUNCA SALE POR EL //(10))
		    if ( SaldoOrigen == 0 )  {
		        alert('Disculpe!' + '\n' + 'La cantidad de Efectivo en la Caja Origen es 0' + '\n' + 'Por favor rectifique el Origen' + '\n' + 'GRACIAS')	
		        return(false);
		    }
					
		}  // Fin del if ( document.form_transaccion_caja.saldo_en_caja.value == 'no' )  {
			
		//(12) VERIFICO QUE ESTÉ ESCRITO ALGO EN LA CAMPO OBSERVACIONES.
	    if ( document.form_transaccion_caja.observaciones_transaccion.value == "" )  {
	        alert('Por favor escriba algo en el campo Observaciones. GRACIAS');
		    document.form_transaccion_caja.observaciones_transaccion.focus();
		    return(false);   
        }
 		
		//(13) CAMPO HIDDEN CON EL VALOR DEL NOMBRE DE LA CAJA EN EL LOCAL ORIGEN
		document.form_transaccion_caja.nombre_caja_local_origen.value = document.form_transaccion_caja.origen_transaccion.options[document.form_transaccion_caja.origen_transaccion.selectedIndex].text	
		//(14) CAMPO HIDDEN CON EL VALOR DEL NOMBRE DE LA CAJA EN EL LOCAL DESTINO
		document.form_transaccion_caja.nombre_caja_local_destino.value = document.form_transaccion_caja.destino_transaccion.options[document.form_transaccion_caja.destino_transaccion.selectedIndex].text
					 
	    //(15) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Si son correctos los datos para la TRANSACCI\xD3N, por favor acepte \n\n" + "Fecha de la Transacci\xF3n : " + document.form_transaccion_caja.fecha_transaccion.value + "\n" + "Cantidad de Efectivo en la Caja Origen: " + document.form_transaccion_caja.saldo_en_caja.value + "\n\n" + 	
		"Origen de la Transacci\xF3n: " + document.form_transaccion_caja.origen_transaccion.options[document.form_transaccion_caja.origen_transaccion.selectedIndex].text + "\n" + 
		"Destino de la Transacci\xF3n: " + document.form_transaccion_caja.destino_transaccion.options[document.form_transaccion_caja.destino_transaccion.selectedIndex].text + "\n\n" + 
		"Cantidad Efectivo de la Transacci\xF3n: " + document.form_transaccion_caja.cantidad_transaccion.value + "\n" + 
		"Observaciones: " + document.form_transaccion_caja.observaciones_transaccion.value		))  {
		    document.form_transaccion_caja.action = "includes/mod_caja_functions.php?data=send_new_transaccion";  
		    document.form_transaccion_caja.submit();
	  
	    } else {
		    return(false);	
		}
	    
   }	// Fin de la función send_transaccion() 
      
//81. 
   function add_efectivo_pendiente()
   {
	   // Función que envía el checkbox seleccionado como efectivo PENDIENTE a la CAJA DEL  LOCAL (ENTRADA)
       var contador_elementos_checkbox = 0;
	   var contador = 0;
	   //(1) VERIFICO QUE EXISTA AL MENOS UN RADIO BOTÓN SELECCIONADO 
	           
			  for ( i=0; i < document.efectivo_pendientes_entrada.elements.length; i++ ) 
	          {
	               if ( document.efectivo_pendientes_entrada.elements[i].type == "checkbox")	 {
			           contador_elementos_checkbox++;
					   if (document.efectivo_pendientes_entrada.elements[i].checked == 1 )  {
				           contador++;
				           continue;  
			           } else {
			               continue;  
			           }
		           }
	          }  // Fin del FOR
				     		  		  
			  //(2) VERIFICO QUE SE HAYA SELECCIONADO ALGUN CHECKBOX BOTTON
			  if ( contador == 0 )  {
				  // Esto significa que no se seleccionó ningún radio botón.
			      alert('Por favor seleccione el Efectivo Pendiente que desea a\xF1adir a la Caja');
			      return (false);
			  } else {
				  //(3) CONFIRMO QUE SE VA A AÑADIR EL ELEMENTO CORRECTO
				  if (confirm("Si est\xE1 seguro que va a a\xF1adir el efectivo seleccionado a la Caja. \n Por favor acepte."))  {
		              document.efectivo_pendientes_entrada.action = "includes/mod_caja_functions.php?data=send_efectivo_pendiente";  
		              document.efectivo_pendientes_entrada.submit();
	              } else {
		              return(false);	
		          }
			  }
   }   // Fin de la función add_efectivo_pendiente()
   
//82. 
  function send_caja_anterior()
  {     
        // Función que envía el formulario de VER CAJA ANTERIOR de un local a consultar en la base de datos
       	//(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA INICIAL del reporte de Caja Anterior.
	    if ( document.form_cajas_anteriores.fecha_inicial.value == "" )  {
	        alert('Por favor introduzca la Fecha Inicial de la consulta. GRACIAS');
		    document.form_cajas_anteriores.fecha_inicial.focus();
		    return(false);   
        }
		
		//(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA FINAL del reporte de Caja Anterior.
	    if ( document.form_cajas_anteriores.fecha_final.value == "" )  {
	        alert('Por favor introduzca la Fecha Final de la consulta. GRACIAS');
		    document.form_cajas_anteriores.fecha_final.focus();
		    return(false);   
        }
		
		//(3) VERIFICO QUE ESTÉ SELECCIONADO EL LOCAL.
	    if ( document.form_cajas_anteriores.local_caja_anterior.value == "seleccione" )  {
	        alert('Por favor seleccione el Local para ver el Reporte de Caja. GRACIAS');
		    document.form_cajas_anteriores.local_caja_anterior.focus();
		    return(false);   
        }
		
		//(7) CAMPO HIDDEN CON EL VALOR DEL NOMBRE DEL LOCAL
		document.form_cajas_anteriores.nombre_local_caja_anterior.value = document.form_cajas_anteriores.local_caja_anterior.options[document.form_cajas_anteriores.local_caja_anterior.selectedIndex].text	
  
        //(8) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Si son correctos los datos del reporte de Caja Anterior, por favor acepte \n\n" + "Fecha Inicial: " + document.form_cajas_anteriores.fecha_inicial.value + "\n" + "Fecha Final: " + document.form_cajas_anteriores.fecha_final.value + "\n" + "Local: " + document.form_cajas_anteriores.nombre_local_caja_anterior.value
))  {
		    document.form_cajas_anteriores.action = "index.php?mod=mod_caja&optioncaja=otras_cajas&cajant=ver#tabs-2";  // 
		    document.form_cajas_anteriores.submit();
	  
	    } else {
		    return(false);	
		}
	  
  }    // Fin de la función send_caja_anterior()
 
//83. 
   function send_reporte_caja_almacen_hoy()
   {
	   // Función que envía el <select> con el almacén para ver si la caja del almacén seleccionado.   
    
       document.location.href = 'index.php?mod=mod_caja&optioncaja=actual#tabs-2';
     
   } // Fin de la función send_reporte_caja_almacen()
   
   /**************************************************************************************************************
                                               MÓDULO VENTAS
   ****************************************************************************************************************/    
//84. 
   function inicio_ventas_button() 
   {
	   // Función que pone al inicio el módulo VENTAS.  
   
       document.location.href = 'index.php?mod=mod_ventas#tabs-1';
   
   }  // Fin de la función inicio_ventas_button()
   
//85. 
   function detalle_venta()
   {
	   // Función que pasa a mostrar el SEGUNDO div de artículos de la venta.
       //(01) VERIFICO QUE ESTÉ LLENO EL CAMPO FECHA.
	   if ( document.form_nueva_venta.fecha_venta.value == ""  )  {
		   alert('Por favor seleccione la fecha de la venta. GRACIAS');
		   document.form_nueva_venta.fecha_venta.focus();
		   return(false);   
	   }
	   
	   //(02) VERIFICO QUE ESTÉ SELECCIONADO ALGUN LOCAL ALMACÉN.
	   if ( document.form_nueva_venta.select_local.value == "seleccione"  )  {
		   alert('Por favor seleccione un almac\xE9n para llevar a cabo esta VENTA. GRACIAS');
		   document.form_nueva_venta.select_local.focus();
		   return(false);   
	   }
	  	   
	   //(03) Guardo en una varible los valores de seleccion de cada radio botón (true or false). 
       var por_nombre     = document.getElementById('c1').checked;    
       var por_num_cedula = document.getElementById('c2').checked; 
       var por_ruc        = document.getElementById('c3').checked;
       var nuevo_cliente  = document.getElementById('c4').checked;
       var sin_determinar = document.getElementById('c5').checked;
   
       //(04) ESCONDO LOS <div> que tienen que ver con cada SELECCIÓN DEL CLIENTE. 
       if ( por_nombre == true )  {
		   // CASO 1: SELECCIONADO EL CLIENTE POR NOMBRE.      
	       $('#cliente_x_nombre').css("display","none");              // <div> para seleccionar el <text> del cliente por nombre.
	       $('#div_search_cliente_by_name').css("display","none");    // <div> del botón de seleccionar cliente por nombre. 
	   
	   } else if ( por_num_cedula == true ) {
		   // CASO 2: SELECCIONO EL CLIENTE POR NÚMERO DE CÉDULA.
		   $('#cliente_x_num_cedula').css("display","none");              // <div> para seleccionar el <text> del cliente por num. de cédula.
	   
	   } else if ( por_ruc == true ) {
		   // CASO 3: SELECCIONO EL CLIENTE POR RUC.
		   $('#cliente_x_ruc').css("display","none");              // <div> para seleccionar el <text> del cliente por RUC.
	   
	   } else if ( nuevo_cliente == true ) {
		   // CASO 4: CREO UN NUEVO CLIENTE.
		   //( 4.1 ) VERIFICO QUE TENGA ALGO ESCRITO EL CAMPO NOMBRE.
		   if ( document.form_nueva_venta.nuevo_cliente_nombre_venta.value == ""  )  {
		       alert('Por favor introduzca un Nombre para el Cliente. GRACIAS');
		       document.form_nueva_venta.nuevo_cliente_nombre_venta.focus();
		       return(false);   
	       }
		   
		   //( 4.2 ) VERIFICO QUE TENGA ALGO ESCRITO EL CAMPO NÚMERO DE CÉDULA Ó RUC.
		   if ( document.form_nueva_venta.nuevo_cliente_num_cedula_venta.value == "" && document.form_nueva_venta.nuevo_cliente_ruc_venta.value == ""  )  {
		       alert('Por favor introduzca un N\xFAmero de C\xE9dula o un RUC v\xE1lido.GRACIAS');
		       document.form_nueva_venta.nuevo_cliente_num_cedula_venta.focus();
		       return(false);   
	       }
		
		   //( 4.3 ) CORRO EL <div> HACIA LA IZQUIRDA.
	       $('#cliente_x_nuevo').css("left","250px");          // <div> con los datos del nuevo cliente.	
	      
	   } else if ( sin_determinar == true ) {
		   // CASO 5: NO TENGO NINGUN CLIENTE.
		   
		   $('#cliente_sin_determinar').css("display","inline");                 // <div> mensaje del cliente sin determinar.
		   $("#contenedor_datos_generales_ventas").css("min-height", "195px");   //  reduzco el contenedor de la SECCIÓN 1.
		 	    
	   }  // Fin del if ( por_nombre == true )  {
    
       //(05) ESCONDO ALGUNOS <div> y <span> COMUNES.
	   $('#ventas_radio').css("display","none");                  // <div> radio botones para escoger al cliente.
	   $('#span_select_cliente').css("display","none");           // <span> del Seleccione Cliente.
	   $("#anadir_articulos").css("display", "none");             //  botón añadir artículos
	   $("#div_fecha_venta").css("margin-bottom", "15px");        //  <text> del campo fecha de venta.
	   $("#detalle_venta").css("display", "block");               //  <div> SECCIÓN 2: DETALLE DE VENTA
       $('#anadir_detalle_pago_ventas').show();                   //  Muestro el botón de la sección 3: DETALLE DE PAGO.
   
   }  // Fin de la función detalle_venta()
   
//86. 
   function send_new_venta()
   {
	   // Función que envía la nueva venta a la base de datos.
	   
	   // CHEQUEO 1. DATOS GENERALES  //////////////////////
	   
	   //(1.1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA DE LA VENTA.
	   if ( document.form_nueva_venta.fecha_venta.value == "" )  {
	       alert('Por favor introduzca la Fecha de la Venta. GRACIAS');
		   document.form_nueva_venta.fecha_venta.focus();
		   return(false);   
       }
	   
       //(1.2) VERIFICO SI ESTÁ SELECCIONADO EL RADIOBOTÓN -POR NOMBRE- QUE ESTÉN LLENOS LOS CAMPOS NECESARIOS.
	   var nuevo_cliente  = document.getElementById('c4').checked;
       if ( nuevo_cliente == true ) {
		   // CASO 4: CREO UN NUEVO CLIENTE.
		   //( 4.1 ) VERIFICO QUE TENGA ALGO ESCRITO EL CAMPO NOMBRE.
		   if ( document.form_nueva_venta.nuevo_cliente_nombre_venta.value == ""  )  {
		       alert('Por favor introduzca un Nombre para el Cliente. GRACIAS');
		       document.form_nueva_venta.nuevo_cliente_nombre_venta.focus();
		       return(false);   
	       }
		   
		   //( 4.2 ) VERIFICO QUE TENGA ALGO ESCRITO EL CAMPO NÚMERO DE CÉDULA Ó RUC.
		   if ( document.form_nueva_venta.nuevo_cliente_num_cedula_venta.value == "" && document.form_nueva_venta.nuevo_cliente_ruc_venta.value == ""  )  {
		       alert('Por favor introduzca un N\xFAmero de C\xE9dula o un RUC v\xE1lido.GRACIAS');
		       document.form_nueva_venta.nuevo_cliente_num_cedula_venta.focus();
		       return(false);   
	       }
				  
	   }  // Fin del if ( nuevo_cliente == true )  {
   
       //(1.3) Pongo el nombre del cliente en el campo hidden para guardarlo en la tabla movalmacen_(idlocal) si el cliente no es Sin Detalle. 
       if ( document.getElementById('c5').checked == 1 )  {
	       // CASO 1: Seleccionado el 'Sin Detalle'.       
	      document.form_nueva_venta.nombre_del_cliente_venta.value = "Cliente Sin Detalle";	 
       } else if ( document.getElementById('c4').checked == 1 )  {
	       // CASO 2: Seleccionado nuevo cliente.
	      document.form_nueva_venta.nombre_del_cliente_venta.value = document.form_nueva_venta.nuevo_cliente_nombre_venta.value;
       } else {
	      // CASO 3: Seleccionado cualquier otro.
	      document.form_nueva_venta.nombre_del_cliente_venta.value = document.getElementById('full_name_cliente').innerHTML;
       }
	       
	   // CHEQUEO 2. DETALLE DE LA VENTA ////////////////////
   
       //////////////////////*************** AQUÍ NO HAY NADA QUE HACER  **************//////////////////////
   
   	   // CHEQUEO 3. DETALLE DE PAGO /////////////////////
       
	   //(3.1) VERIFICO QUE EXISTA ALGO EN EL CAMPO VALOR TOTAL A PAGAR (sup. der.).
	   if ( document.form_nueva_venta.monto_total.value == "" )  {
	       alert('Por favor chequee el VALOR TOTAL DE LA VENTA. GRACIAS');
		   document.form_nueva_venta.monto_total.focus();
		   $("#monto_total_a_pagar_ventas").css("background-color","#F9BEBD");
		   return(false);   
       }
   
       //(3.2) VERIFICO QUE EXISTA ALGO EN EL CAMPO VALOR TOTAL A PAGAR (sup. der.).
	   if ( document.form_nueva_venta.descuento_general_venta.value == "" )  {
	       alert('Por favor chequee el VALOR DEL DESCUENTO DE LA VENTA. GRACIAS');
		   document.form_nueva_venta.descuento_general_venta.focus();
		   $("#descuento_general_venta").css("background-color","#F9BEBD");
		   return(false);   
       }
   
       //(3.3) VERIFICO QUE EXISTA ALGO EN EL CAMPO NO. FACTURA.
	   if ( document.form_nueva_venta.input_no_factura_ventas.value == "" )  {
	       alert('Por favor chequee el campo No. Factura. GRACIAS');
		   document.form_nueva_venta.input_no_factura_ventas.focus();
		   return(false);   
       }   
	   
	   //(3.4) VERIFICO LOS CAMPOS A PARTIR DE SI SELECCIONO 'Contado' ó 'Crédito'
	   var swt = document.getElementById('forma_pago_contado_ventas').checked;
	      
	   switch(swt)
	   {
		  //(3.3.1) Cuando tengo seleccionado el radio botón de la Venta al 'Contado'. 
		  case true:   
	          
		      var monto_total_a_pagar = document.getElementById('valor_real_de_la_venta').value;      // ( valor real de la venta (hidden) )
		      var monto_pago_contado  = document.getElementById('input_monto_a_pagar_ventas').value;  // valor de pago. 
		      var pagado_x_cliente    = document.getElementById('input_pago_cliente_contado').value;  // pagado por el cliente.
				 
	          monto_total_a_pagar = parseFloat(monto_total_a_pagar);
		      monto_pago_contado  = parseFloat(monto_pago_contado);
		      pagado_x_cliente    = parseFloat(pagado_x_cliente);
		  
		      // a) Si el campo del monto de la venta (hidden) != monto a pagar   
		      if ( monto_total_a_pagar.toFixed(2) != monto_pago_contado.toFixed(2) ) {
			      alert('Los valores del monto Total de la Venta y del valor del Pago del Cliente no son iguales. Por favor verifique. GRACIAS');
			      document.form_nueva_venta.monto_a_pagar_ventas.focus();
		          $("#input_monto_a_pagar_ventas").css("background-color","#F9BEBD");
			      return(false); 
		      }
			 
		  	  // b) Si el valor de la venta > lo que pago.  
		      if ( monto_pago_contado > pagado_x_cliente )   {
			      alert('Alerta!! Usted va a cobrar al Cliente un valor menor que el valor real de la Venta. Por favor verifique. GRACIAS');
			      document.form_nueva_venta.pago_cliente_contado.focus();
		          return(false); 
		  	  }     
				 
		     /***************** Primer confirm  *****************/  
			  if (confirm("Si est\xE1 seguro de guardar los datos de la Venta: \n\n " + "Valor Total: " + monto_pago_contado.toFixed(2) + "\n Valor Pagado:  " + pagado_x_cliente.toFixed(2) + "\n Vuelto de la Venta: " + document.getElementById('push_vuelto_valor').innerHTML + "\n\n Por favor acepte. \n\n" ))  {
		             document.form_nueva_venta.action = "includes/mod_ventas_functions.php?data=contado";
                     document.form_nueva_venta.submit();
	          } else {
			         return (false);  
	          }
			     
          break;
		  //(3.3.2) Cuando tengo seleccionado el radio botón de la Venta a 'Crédito'. 
		  case false:
              
			  var dinero_anticipo = document.getElementById('input_anticipo_forma_pago').value;       // Valor del Anticipo.
			  var saldo_del_credito = document.getElementById('saldo_dinero_ventas').value;           // Saldo del Crédito.
			  var monto_total_ventas_valor = document.getElementById('valor_real_de_la_venta').value; // Monto de la Venta.
			  
			  //01 Chequeo que si está e crédito activado tenga que haber algún cliente para asignarle la venta.
			  if ( document.getElementById('c5').checked == 1 )  {
			      // ¿quién le asigno la cuenta por cobrar?
			      alert('Usted no ha seleccionado un Cliente para asignarle la Cuenta por Cobrar. Por favor revise los datos. GRACIAS');
				  document.form_nueva_venta.fecha_venta.focus();
				  return(false);
			  }
			  
			  //02 CHEQUEAMOS QUE EL DINERO DE ENTRADA SEA UN NÚMERO Y NO SEA 'VACÍO'.  
			  if ( dinero_anticipo == "" || isNaN(dinero_anticipo) )  {
				  alert('Por favor chequee el campo "Valor del Anticipo".GRACIAS');
				  document.form_nueva_venta.entrada_dinero.focus();
				  return(false);
			  }
              
			  //03 CHEQUEAMOS QUE EL SALDO DEL CRÉDITO SEA UN NÚMERO Y NO SEA 'VACÍO'.  
			  if ( saldo_del_credito == "" || isNaN(saldo_del_credito) )  {
				  alert('Por favor chequee el campo "Saldo del Cr\xE9dito".GRACIAS');
				  document.form_nueva_venta.saldo_dinero.focus();
				  return(false);
			  }
		  
		      //04 switch QUE PRECISA SI LA VENTA A CRÉDITO TIENE: UNA ENTRADA Ó LA ENTRADA ES 0.
			  switch(dinero_anticipo) 
			  {
				  case "0": // ENTRADA DE DINERO PARA EL CRÉDITO = 0
				  
				      //03.1 VERIFICO QUE EL 'SALDO DEL CRÉDITO' SEA IGUAL AL 'VALOR TOTAL DE LA VENTA'.
				      saldo_del_credito = parseFloat(saldo_del_credito);
				      monto_total_ventas_valor = parseFloat(monto_total_ventas_valor);
			 
			          if ( saldo_del_credito.toFixed(2) != monto_total_ventas_valor.toFixed(2) ) {
					     alert('El Valor del "Saldo del Cr\xE9dito" y el Valor Total de la Venta son diferentes.Por favor chequee este valor.GRACIAS');
				         document.form_nueva_venta.saldo_dinero.focus();
						 return(false); 
				      }
				  
				       // Función que chequea todos los pagos y los envía a procesar al PHP,uso 1 de 2 veces...
					  chequeo_d_pagos_ventas('0');  // Se pone 0 pues el Valor de Entrada($) es 0.
							 				  
				  break;
		          default:  // ENTRADA DE DINERO PARA EL CRÉDITO DISTINTO DE 0.
				  
				      saldo_del_credito = parseFloat(saldo_del_credito);
				      monto_total_ventas_valor = parseFloat(monto_total_ventas_valor);
					  dinero_anticipo = parseFloat(dinero_anticipo);
					  
					  //03.2 VERIFICO QUE LA SUMATORIA DEL 'ANTICIPO' + 'SALDO DEL CRÉDITO' = 'MONTO DE LA VENTA'
			 	      var sumatoria_montos = dinero_anticipo + saldo_del_credito;
				 
				      if ( sumatoria_montos.toFixed(2) != monto_total_ventas_valor.toFixed(2) ) {
					          alert('Los valores de la suma de los montos a pagar en el Anticipo y el Saldo de Cr\xE9dito son diferentes.Por favor chequee esos dos valores.GRACIAS');
				              return(false); 
				      }
			 					  
					  // Función que chequea todos los pagos y los envía a procesar al PHP,uso 2 de 2 veces...
					  chequeo_d_pagos_ventas('1');  // Se pone 1 pues el Valor de Entrada($) es distinto de 0.
		          
		          break;
			  
			  }  // Fin del switch
		  
		  break;
		  
	    } // FIN DEL switch
   
   }  //Fin de la función send_new_venta()
      
//87.(private)
   function chequeo_d_pagos_ventas(entrada) 
   { 
        // Función que chequea todos los pagos y los envía a procesar al PHP, se usa 2 veces...
   
        var chequeo_pagos = check_cantidad_de_pagos_ventas(entrada); //40. Chequeo todos los campos de acuerdo a la cantidad de pagos de la Nueva Venta.  
		if ( chequeo_pagos == "ok1" )  {
			// CANTIDAD DE PAGOS=1
			// ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			/***************** Segundo confirm  *****************/  
			if (confirm("Si est\xE1 seguro de guardar los datos de la Venta: \n\n " + "Valor Total: " + document.form_nueva_venta.valor_real_de_la_venta.value + "\n\n Por favor acepte. \n\n" ))  {
		        document.form_nueva_venta.action = "includes/mod_ventas_functions.php?data=creditoentrada" + entrada + "pago1";
                document.form_nueva_venta.submit();
	        } else {
			    return (false);  
	        }
									     
		} else if ( chequeo_pagos == "ok2" )  {
			// CANTIDAD DE PAGOS=2
			// ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			/***************** Tercer confirm  *****************/ 
			if (confirm("Si est\xE1 seguro de guardar los datos de la Venta: \n\n " + "Valor Total: " + document.form_nueva_venta.valor_real_de_la_venta.value + "\n\n Por favor acepte. \n\n" ))  {
		        document.form_nueva_venta.action = "includes/mod_ventas_functions.php?data=creditoentrada" + entrada + "pagos2";
                document.form_nueva_venta.submit();
	        } else {
			    return (false);  
	        }
						     
		} else if ( chequeo_pagos == "ok3" )  {
			// CANTIDAD DE PAGOS=3
			// ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			/***************** Cuarto confirm  *****************/
			if (confirm("Si est\xE1 seguro de guardar los datos de la Venta: \n\n " + "Valor Total: " + document.form_nueva_venta.valor_real_de_la_venta.value + "\n\n Por favor acepte. \n\n" ))  {
		        document.form_nueva_venta.action = "includes/mod_ventas_functions.php?data=creditoentrada" + entrada + "pagos3";
                document.form_nueva_venta.submit();
	        } else {
			    return (false);  
	        }
						     
		}  else if ( chequeo_pagos == "ok4" )  {
			// CANTIDAD DE PAGOS=4
			// ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			/***************** Quinto confirm  *****************/ 
			if (confirm("Si est\xE1 seguro de guardar los datos de la Venta: \n\n " + "Valor Total: " + document.form_nueva_venta.valor_real_de_la_venta.value + "\n\n Por favor acepte. \n\n" ))  {
		        document.form_nueva_venta.action = "includes/mod_ventas_functions.php?data=creditoentrada" + entrada + "pagos4";
                document.form_nueva_venta.submit();
	        } else {
			    return (false);  
	        }
										     
		}  else if ( chequeo_pagos == "ok5" )  {
		     // CANTIDAD DE PAGOS=5
			 // ESTO SIGNIFICA QUE ESTÁ BIEN TODO Y ESTÁN LISTOS LOS DATOS PARA MANDARSE A LA BASE DE DATOS. 
			 /***************** Sexto confirm  *****************/  
			 if (confirm("Si est\xE1 seguro de guardar los datos de la Venta: \n\n " + "Valor Total: " + document.form_nueva_venta.valor_real_de_la_venta.value + "\n\n Por favor acepte. \n\n" ))  {
		        document.form_nueva_venta.action = "includes/mod_ventas_functions.php?data=creditoentrada" + entrada + "pagos5";
                document.form_nueva_venta.submit();
	        } else {
			    return (false);  
	        }
			 	     
		}
     
   } // Fin de la función chequeo_d_pagos_ventas()
     
//88.(private) 
   function check_cantidad_de_pagos_ventas(entrada) 
   {
	   // Función que chequea todos los campos de acuerdo a la cantidad de pagos de la Nueva VENTA.  
   
       var valor_cantidad_de_pagos = document.getElementById('cantidad_de_pagos_credito_ventas').value;  // CANTIDAD DE PAGOS (1-5)  
       var Total_ventas_valor = document.getElementById('valor_real_de_la_venta').value;  // Valor total de la venta.
       var Saldo_del_credito = document.getElementById('saldo_dinero_ventas').value;   // Valor del Saldo del Crédito.
	   
	   Total_ventas_valor = parseFloat(Total_ventas_valor);
	   Saldo_del_credito = parseFloat(Saldo_del_credito);
	  	  
	   // CHEQUEO TODOS LOS CAMPOS DE ACUERDO A LA CANTIDAD DE PAGOS.
	   switch(valor_cantidad_de_pagos)
	   {
	       case "1": // 1 SOLO PAGO
		      
			  //01
			  var pay1 = check_pago1_ventas(); // Chequea los campos para 1 SOLO PAGO.
		      if ( pay1 == false )  {
				  return(false);
			  }
			  
			  pago1 = document.form_nueva_venta.monto_total_pago1.value;
			  pago1 = parseFloat(pago1);
			  switch(entrada)
			  {
				 case "0":
				    //02 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 = VALOR TOTAL DE LA VENTA. 
		            
					if ( pago1.toFixed(2) != Total_ventas_valor.toFixed(2) )  {
				        alert('Error. El Monto a Pagar en el Pago 1 es diferente al Valor Total de la Venta.')
			            document.form_nueva_venta.monto_total_pago1.focus();
				        return(false);
			        } else {
				        return "ok1";
			        }
				 break;
				 case "1":
				    //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 = VALOR SALDO DEL CRÉDITO. 
					if ( pago1.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				        alert('Error. El Monto a Pagar en el Pago 1 es diferente al Valor del Pago.')
			            document.form_nueva_venta.monto_total_pago1.focus();
				        return(false);
			        } else {
				        return "ok1";
			        }
				 break;  
			  }
			 		   
		   break;
		   case "2":  // 2 PAGOS
		      //01
		      var pay2 = check_pago2_ventas(); // Chequea los campos para 2 PAGOS.
		      if ( pay2 == false )  {
				  return(false);
			  }
			  
			  var primer_pago = document.form_nueva_venta.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_venta.monto_total_pago2.value;
			  
			  primer_pago = parseFloat(primer_pago);
			  segundo_pago = parseFloat(segundo_pago);
			  			  				  
		      var Pago1_y_2 = primer_pago + segundo_pago;
			  		  
			  switch(entrada)
			  {
				 case "0":
				    //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 = VALOR TOTAL DE LA VENTA.
		            if ( Pago1_y_2.toFixed(2) != Total_ventas_valor.toFixed(2) )  {
				       alert('Error. El Monto a Pagar en los Pagos 1 y 2 es diferente al Valor Total del Pago.')
			           document.form_nueva_venta.monto_total_pago1.focus();
				       return(false);
			        } else {
				       return "ok2";
			        }
				 break;
				 case "1":
				    //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 + PAGO 2 = VALOR SALDO DEL CRÉDITO. 
					if ( Pago1_y_2.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				       alert('Error. El Monto a Pagar en los Pagos 1 y 2 es diferente al Valor del Pago.')
			           document.form_nueva_venta.monto_total_pago1.focus();
				       return(false);
			        } else {
				       return "ok2";
			        }
				 break;  
			  }
			 				  	   
		   break;
	       case "3":  // 3 PAGOS
		      //01
		      var pay3 = check_pago3_ventas(); // Chequea los campos para 3 PAGOS.
		      if ( pay3 == false )  {
				  return(false);
			  }
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 = VALOR TOTAL DE LA VENTA. 
		      var primer_pago = document.form_nueva_venta.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_venta.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_venta.monto_total_pago3.value;
			  
			  primer_pago = parseFloat(primer_pago);
			  segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  				  
			  var Pago1_2_y_3 = primer_pago + segundo_pago + tercer_pago;
			      
				  switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 = VALOR TOTAL DE LA VENTA.
		                if ( Pago1_2_y_3.toFixed(2) != Total_ventas_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1 ,2 y 3 es diferente al Valor Total de la Venta.')
			                document.form_nueva_venta.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok3";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_y_3.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1 ,2 y 3 es diferente al Valor del Pago.')
			                document.form_nueva_venta.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok3";
			            }
				     break;  
			      }
					   	   
		   break;
		   case "4":  // 4 PAGOS
		      //01
		      var pay4 = check_pago4_ventas(); // Chequea los campos para 4 PAGOS.
		      if ( pay4 == false )  {
				  return(false);
			  }
			  
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 = VALOR TOTAL DE LA VENTA. 
		      var primer_pago = document.form_nueva_venta.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_venta.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_venta.monto_total_pago3.value;
			  var cuarto_pago = document.form_nueva_venta.monto_total_pago4.value;
			  
			  primer_pago = parseFloat(primer_pago);
			  segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  cuarto_pago = parseFloat(cuarto_pago);
			  				  
			  var Pago1_2_3_y_4 = primer_pago + segundo_pago + tercer_pago + cuarto_pago;
			  
			      switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 = VALOR TOTAL DE LA VENTA.
		                if ( Pago1_2_3_y_4.toFixed(2) != Total_ventas_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1 ,2, 3 y 4 es diferente al Valor Total de la Venta.')
			                document.form_nueva_venta.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok4";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_3_y_4.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1 ,2 ,3 y 4 es diferente al Valor del Pago.')
			                document.form_nueva_venta.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok4";
			            }
				     break;  
			      }
				  
		   break;
		   case "5":  // 5 PAGOS
		      //01
		      var pay5 = check_pago5_ventas(); // Chequea los campos para 5 PAGOS.
		      if ( pay5 == false )  {
				  return(false);
			  }
			  
			  //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 +PAGO 4 + PAGO 5 = VALOR TOTAL DE LA VENTA. 
		      
			  var primer_pago = document.form_nueva_venta.monto_total_pago1.value;
			  var segundo_pago = document.form_nueva_venta.monto_total_pago2.value;
			  var tercer_pago = document.form_nueva_venta.monto_total_pago3.value;
			  var cuarto_pago = document.form_nueva_venta.monto_total_pago4.value;
			  var quinto_pago = document.form_nueva_venta.monto_total_pago5.value;
			  
			  primer_pago = parseFloat(primer_pago);
		      segundo_pago = parseFloat(segundo_pago);
			  tercer_pago = parseFloat(tercer_pago);
			  cuarto_pago = parseFloat(cuarto_pago);
			  quinto_pago = parseFloat(quinto_pago);
			  				  
			  var Pago1_2_3_4_y_5 = primer_pago + segundo_pago + tercer_pago + cuarto_pago + quinto_pago;
			  
			      switch(entrada)
			      {
				     case "0":
				        //02 COMPRUEBO QUE LA SUMA DE LOS VALORES DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 + PAGO 5 = VALOR TOTAL DE LA VENTA.
						if ( Pago1_2_3_4_y_5.toFixed(2) != Total_ventas_valor.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4 y 5 es diferente al Valor Total de la Venta.')
			                document.form_nueva_venta.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok5";
			            }
				     break;
				     case "1":
				        //03 COMPRUEBO QUE EL VALOR DEL MONTO DEL PAGO 1 + PAGO 2 + PAGO 3 + PAGO 4 + PAGO 5 = VALOR SALDO DEL CRÉDITO. 
						if ( Pago1_2_3_4_y_5.toFixed(2) != Saldo_del_credito.toFixed(2) )  {
				            alert('Error. El Monto a Pagar en los Pagos 1, 2, 3, 4 Y 5 es diferente al Valor del Pago.')
			                document.form_nueva_venta.monto_total_pago1.focus();
				            return(false);
			            } else {
				            return "ok5";
			            }
				     break;  
			      }
					  
		   break;
			   
	   }  // Fin del switch(valor_cantidad_de_pagos)
       
   }  // Fin de la función check_cantidad_de_pagos_ventas().
   
//89.(private)  YA
   function check_pago1_ventas() 
   {
	   // Función que chequea los valores del PRIMER PAGO de la nueva venta.
       //01 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_venta.monto_total_pago1.value == "" || document.form_nueva_venta.monto_total_pago1.value == "0" || isNaN(document.form_nueva_venta.monto_total_pago1.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 1');   
	      document.form_nueva_venta.monto_total_pago1.focus();
		  return false;
	   }
   
       //02 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_venta.fecha_pago1.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 1');   
	      document.form_nueva_venta.fecha_pago1.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_venta.descripcion_pago1.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 1');   
	      document.form_nueva_venta.descripcion_pago1.focus();
		  return false;
	   }
     
   } // Fin de la función check_pago1_ventas()
     
//90.(private) 
   function check_pago2_ventas() 
   {
	   // Función que chequea los valores del SEGUNDO PAGO de la nueva venta.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1. 
	   check_pago1_ventas(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_venta.monto_total_pago2.value == "" || document.form_nueva_venta.monto_total_pago2.value == "0" || isNaN(document.form_nueva_venta.monto_total_pago2.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 2');   
	      document.form_nueva_venta.monto_total_pago2.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_venta.fecha_pago2.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 2');   
	      document.form_nueva_venta.fecha_pago2.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_venta.descripcion_pago2.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 2');   
	      document.form_nueva_venta.descripcion_pago2.focus();
		  return false;
	   }
     
   } // Fin de la función check_pago2_ventas()
   
//91.(private) 
   function check_pago3_ventas() 
   {
	   // Función que chequea los valores del TERCER PAGO de la nueva venta.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1 y 2. 
	   check_pago2_ventas(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_venta.monto_total_pago3.value == "" || document.form_nueva_venta.monto_total_pago3.value == "0" || isNaN(document.form_nueva_venta.monto_total_pago3.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 3');   
	      document.form_nueva_venta.monto_total_pago3.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_venta.fecha_pago3.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 3');   
	      document.form_nueva_venta.fecha_pago3.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_venta.descripcion_pago3.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 3');   
	      document.form_nueva_venta.descripcion_pago3.focus();
		  return false;
	   }
     
   } // Fin de la función check_pago3_ventas()
   
//92.(private) 
   function check_pago4_ventas() 
   {
	   // Función que chequea los valores del CUARTO PAGO de la nueva venta.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1 ,2 y 3. 
	   check_pago3_ventas(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_venta.monto_total_pago4.value == "" || document.form_nueva_venta.monto_total_pago4.value == "0" || isNaN(document.form_nueva_venta.monto_total_pago4.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 4');   
	      document.form_nueva_venta.monto_total_pago4.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_venta.fecha_pago4.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 4');   
	      document.form_nueva_venta.fecha_pago4.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_venta.descripcion_pago4.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 4');   
	      document.form_nueva_venta.descripcion_pago4.focus();
		  return false;
	   }
        
   } // Fin de la función check_pago4_ventas()
   
//93.(private) 
   function check_pago5_ventas() 
   {
	   // Función que chequea los valores del QUINTO PAGO de la nueva venta.
       //01 Chequeo que estén llenos los valores de los campos para el PAGO 1, 2, 3 y 4. 
	   check_pago4_ventas(); 
   
       //02 Verifico que el monto sea: Un número, diferente de "" y diferente de 0.
	   if ( document.form_nueva_venta.monto_total_pago5.value == "" || document.form_nueva_venta.monto_total_pago5.value == "0" || isNaN(document.form_nueva_venta.monto_total_pago5.value) )  {
		  alert('Por favor cheque el valor de campo "Monto" del Pago 5');   
	      document.form_nueva_venta.monto_total_pago5.focus();
		  return false;
	   }
   
       //03 Verifico que exista algo escrito en el campo Fecha.
	   if ( document.form_nueva_venta.fecha_pago5.value == "" )  {
		  alert('Por favor cheque el valor de campo "Fecha" del Pago 5');   
	      document.form_nueva_venta.fecha_pago5.focus();
		  return false;
	   }
   
       //04 Verifico que exista algo escrito en el campo Descripción.
	   if ( document.form_nueva_venta.descripcion_pago5.value == "" )  {
		  alert('Por favor cheque el valor de campo "Descripci\xf3n" del Pago 5');   
	      document.form_nueva_venta.descripcion_pago5.focus();
		  return false;
	   }
        
   } // Fin de la función check_pago5_ventas()
   
//94. 
  function send_reporte_cliente_ventas()
  {
	  // Función que envía los datos del cliente y el almacén que quiero ver en el REPORTE. 
      //(1) VERIFICO QUE EXISTA ALGO EN EL <select> DEL CÓDIGO DEL ARTÍCULO.
	  if ( document.form_reporte_venta_cliente.local_stock.value == "seleccione" )  {
	      alert('Por favor introduzca un Almac\xE9n v\xE1lido. GRACIAS');
		  document.form_reporte_venta_cliente.local_stock.focus();
		  return(false);   
      }
   
      //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL NOMBRE DEL CLIENTE.
	  if ( document.form_reporte_venta_cliente.cliente_ventas_reporte.value == "" )  {
	      alert('Por favor introduzca un Nombre para el Cliente que desea buscar en la consulta. GRACIAS');
		  document.form_reporte_venta_cliente.cliente_ventas_reporte.focus();
		  return(false);   
      }
   
      //(3) VERIFICO QUE EL CAMPO DEL NOMBRE DEL CLIENTE SELECCIONADO SEA DE LA BASE DE DATOS.
	  if ( document.form_reporte_venta_cliente.id_cliente_ventas_reporte.value == "" )  {
	      alert('Por favor introduzca un Nombre para el Cliente Real para la consulta. GRACIAS');
		  document.form_reporte_venta_cliente.cliente_ventas_reporte.focus();
		  return(false);   
      }
   
      //(4) IGUALO EL CAMPO hidden AL NOMBRE DEL LOCAL.
	  document.form_reporte_venta_cliente.venta_cliente_local_nombre.value = document.form_reporte_venta_cliente.local_stock.options[document.form_reporte_venta_cliente.local_stock.selectedIndex].text
   
      //(5) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	  if ( confirm("Si son correctos los datos de la consulta, por favor acepte \n\n" + "Local: " + document.form_reporte_venta_cliente.local_stock.options[document.form_reporte_venta_cliente.local_stock.selectedIndex].text + "\n" + "Cliente: " + document.form_reporte_venta_cliente.cliente_ventas_reporte.value ))  {
		    document.form_reporte_venta_cliente.action = "index.php?mod=mod_ventas&optionv=ventas_x_clientes&cl=ver#tabs-1";
		    document.form_reporte_venta_cliente.submit();
	  } else {
			return (false);  
	  }   
      
  } // Fin de la función send_reporte_cliente_ventas()
  
//95. 
  function send_resventas()
  {
	  // Función que envía el formulario de RESUMEN DE VENTAS de un local en específico.
        //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA INICIAL del reporte de Resumen de Ventas.
	    if ( document.form_resventas.fecha_inicial.value == "" )  {
	        alert('Por favor introduzca la Fecha Inicial. GRACIAS');
		    document.form_resventas.fecha_inicial.focus();
		    return(false);   
        }
		
		//(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO FECHA FINAL del reporte de de Resumen de Ventas.
	    if ( document.form_resventas.fecha_final.value == "" )  {
	        alert('Por favor introduzca la Fecha Final. GRACIAS');
		    document.form_resventas.fecha_final.focus();
		    return(false);   
        }
  
        //(3) VERIFICO QUE ESTÉ SELECCIONADO EL <select> del LOCAL.
	    if ( document.form_resventas.local_resventas.value == 'seleccione' )  {
	        alert('Por favor seleccione el Local. GRACIAS');
		    document.form_resventas.local_resventas.focus();
			return(false);  
		}
  
        //(4) CAMPO HIDDEN CON EL VALOR DEL NOMBRE DEL LOCAL
		document.form_resventas.nombre_local_resventas.value = document.form_resventas.local_resventas.options[document.form_resventas.local_resventas.selectedIndex].text;
		 
		//(5) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	    if (confirm("Si son correctos los datos, por favor acepte \n\n" + "Fecha Inicial: " + document.form_resventas.fecha_inicial.value + "\n" + "Fecha Final: " + document.form_resventas.fecha_final.value + "\n" + "Local: " + document.form_resventas.nombre_local_resventas.value ))  {
		    document.form_resventas.action = "index.php?mod=mod_ventas&optionv=res_ventas&resv=ver#tabs-1";  
		    document.form_resventas.submit();
	  
	    } else {
		    return(false);	
		}
  
  }  // Fin del función send_resventas()  
  
   /**************************************************************************************************************
                                               MÓDULO ADD ARTÍCULO
   ****************************************************************************************************************/
//96. 
  function send_articulo_from_compras()
  {
	  // Función que envía el formulario del nuevo artículo desde el módulo Compras.  
      //(1) VERIFICO QUE EXISTA ALGO EN EL CAMPO DEL CÓDIGO DEL ARTÍCULO.
	  if ( document.form_nuevo_articulo.codigo_art.value == "" )  {
	      alert('Por favor introduzca un C\xF3digo para el Art\xEDculo. GRACIAS');
		  document.form_nuevo_articulo.codigo_art.focus();
		  return(false);   
      }
	   
	  //(2) VERIFICO QUE EXISTA ALGO EN EL CAMPO UNIDAD DE MEDIDA.
	  if ( document.form_nuevo_articulo.unidad_medida.value == "" )  {
	     alert('Por favor introduzca la Unidad de Medida del Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.unidad_medida.focus();
		 return(false);   
      }
	    
	  //(3) VERIFICO QUE EXISTA ALGO EN EL CAMPO REFERENCIA DEL ARTÍCULO.
	  if ( document.form_nuevo_articulo.referencia_art.value == "" )  {
	     alert('Por favor introduzca alguna referencia para el Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.referencia_art.focus();
		 return(false);   
      }
	  
	  //(4) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO DETALLE DEL ARTÍCULO.
	 
	  //(5) VERIFICO QUE EXISTA ALGO EN EL CAMPO PROVEEDOR DEL ARTÍCULO.
	  if ( document.form_nuevo_articulo.proveedor_art.value == "" )  {
	     alert('Por favor introduzca el Proveedor de este Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.proveedor_art.focus();
		 return(false);   
      }
	 
	  //(6) VERIFICO QUE EXISTA ALGO EN EL CAMPO HIDDEN DEL id DEL PROVEEDOR DEL ARTÍCULO.
	  if ( document.form_nuevo_articulo.id_proveedor_art.value == "" )  {
	     alert('Por favor introduzca un Proveedor adecuado para este Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.proveedor_art.focus();
		 return(false);   
      }
	      
	  //(7) VERIFICO QUE EXISTA ALGO EN EL CAMPO STOCK MÍNIMO Y QUE ESTO SEA UN NÚMERO.
	  if ( document.form_nuevo_articulo.stock_minimo.value == "" )  {
	     alert('Por favor introduzca el Stock M\xEDnimo que debe tener su Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.stock_minimo.focus();
		 return(false);   
      }
	 
	  if ( isNaN(document.form_nuevo_articulo.stock_minimo.value) )  { 
	     alert('Por favor introduzca un valor num\xE9rico en el Stock M\xEDnimo. GRACIAS');
		 document.form_nuevo_articulo.stock_minimo.focus();
		 return(false);
      }
	  
	  //(8) VERIFICO QUE EXISTA ALGO EN EL CAMPO COSTO UNITARIO Y QUE ESTO SEA UN NÚMERO.
	  if ( document.form_nuevo_articulo.precio_costo_art.value == "" )  {
	     alert('Por favor introduzca el Costo Unitario del Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.precio_costo_art.focus();
		 return(false);   
      }
	 
	  if ( isNaN(document.form_nuevo_articulo.precio_costo_art.value) )  { 
		 alert('Por favor introduzca un valor num\xE9rico en el Costo Unitario. GRACIAS');
		 document.form_nuevo_articulo.precio_costo_art.focus();
		 return(false);
      }  
	   
	  //(9) VERIFICO QUE EXISTA ALGO EN EL CAMPO PRECIO DE VENTA 1 Y QUE ESTO SEA UN NÚMERO.
	  if ( document.form_nuevo_articulo.precio_venta1.value == "" )  {
	     alert('Por favor introduzca el Precio de Venta 1 del Art\xEDculo. GRACIAS');
		 document.form_nuevo_articulo.precio_venta1.focus();
		 return(false);   
      }
	 
	  if ( isNaN(document.form_nuevo_articulo.precio_venta1.value) )  { 
		  alert('Por favor introduzca un valor num\xE9rico en el Precio de Venta 1. GRACIAS');
		  document.form_nuevo_articulo.precio_venta1.focus();
		  return(false);
      }   
	   
	  //(10) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO PRECIO DE VENTA 2.
	  //(11) NO VERIFICO QUE EXISTA ALGO EN EL CAMPO PRECIO DE VENTA 3.
	   
	  //(12) ENVÍO MENSAJE DE CONFIRMACIÓN AL USUARIO PARA VALIDAR LA ENTRADA DE DATOS
	  if (confirm("Si son correctos los datos, por favor acepte \n\n" + "C\xF3digo: " + document.form_nuevo_articulo.codigo_art.value + "\n" + "Unidad de Medida: " + document.form_nuevo_articulo.unidad_medida.value + "\n" + "Referencia: " + document.form_nuevo_articulo.referencia_art.value + "\n" + "Detalles: " + document.form_nuevo_articulo.detalle_art.value + "\n" + "Proveedor: " + document.form_nuevo_articulo.proveedor_art.value + "\n" + "Stock M\xEDnimo: " + document.form_nuevo_articulo.stock_minimo.value + "\n" + "Costo Unitario: " + document.form_nuevo_articulo.precio_costo_art.value + "\n" + "Precio de Venta 1: " + document.form_nuevo_articulo.precio_venta1.value + "\n" + "Precio de Venta 2: " + document.form_nuevo_articulo.precio_venta2.value + "\n" + "Precio de Venta 3: " + document.form_nuevo_articulo.precio_venta3.value))  {
		    document.form_nuevo_articulo.action = "includes/mod_add_article_functions.php?data=send";
		    document.form_nuevo_articulo.submit();
	  } else {
			return (false);  
	  }    
      
  }   // Fin de la función send_articulo_from_compras() 
  
