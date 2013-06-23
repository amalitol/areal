/*    TABLAS DE LA BD PARA EL SISTEMA CONTABLE SSC
*     ---------------------------------------------
*   01 - data_usuarios
*   02 - data_admin
*   03 - registro_bancario
*   04 - proveedores_clientes
*   05 - contactos_proveedores_clientes
*   06 - cuentas_x_pagar
*   07 - cuentas_x_pagar_details
*   08 - cuentas_x_cobrar
*   09 - cuentas_x_cobrar_details
*   10 - data_empresa
*   11 - registro_compras
*   12 - compras_detalles_articulos
*   13 - compras_detalles_pagos
*   14 - cajaefectivos_pendientes_de_entrada
*   15 - cajacentral_1          -> Tengo que hacerlo así para que no me dé errores a la hora de leer de la CAJA 
*   16 - locales_inventarios
*   17 - articulos_inventario
*   18 - articulos_pendientes_de_entrada

*/




DROP DATABASE IF EXISTS ssc_sistema;

CREATE DATABASE ssc_sistema;

USE ssc_sistema;


GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER   
ON ssc_sistema.*
TO ssc_sistema@localhost identified by 'password';

/* 01 */
DROP table IF EXISTS data_usuarios;

CREATE table data_usuarios (
   id_usuario          int unsigned NOT NULL PRIMARY KEY auto_increment,
   usuario             varchar(50),
   contrasena          varchar(50),
   nombre_completo     varchar(100),
   tipo_usuario        varchar(1),    /* a (administrador) Ó v (vendedor) */
   id_local            int,           /* Aquí va el id del local al cual está referido el usuario -- admin=1 vendedores=2..3..4  -- */
   habilitar           bit,
   index (id_local)
   
);
INSERT INTO data_usuarios VALUES
   /* El pass es md5(admin) */
   (NULL,"admin","0cc175b9c0f1b6a831c399e269772661","Administrador","a",1,1);




/* 02 */
DROP table IF EXISTS data_admin;

CREATE table data_admin (
   id_usuario         int unsigned NOT NULL PRIMARY KEY auto_increment,
   usuario            varchar(60),
   contrasena         varchar(100),
   nombre_completo    varchar(100),
   id_rol             int,
   index (id_rol)
   
);

INSERT INTO data_admin VALUES
   /* El pass es md5(admin) */
   (NULL,"admin","21232f297a57a5a743894a0e4a801fc3","Administrador de usuarios", 100);
   

/* 03 */
DROP table IF EXISTS registro_bancario;

CREATE table registro_bancario (
   id                  int unsigned NOT NULL PRIMARY KEY auto_increment,
   fecha               date,
   no_orden_de_compra  int,                 /* caso de que en una compra se dé un cheque para cobrar al momento (sólo REPORTES) */
   id_origen_pago_cxp  int,                 /* caso de que se pague una cuenta_por_pagar con un cheque bancario (sólo REPORTES) */
   no_venta            int,                 /* caso de que en una venta se dé un cheque  para cobrar al momento (sólo REPORTES) */
   id_origen_cobro_cxc int,                 /* caso de que se pague una cuenta_por_cobrar con un cheque bancario (sólo REPORTES) */
   descripcion         varchar(100),
   debitos             float(9,2),
   creditos            float(9,2),
   saldos              float(9,2),
   reajustar_error     bit
  
);

INSERT INTO registro_bancario VALUES
   /* Introduzco el valor 0 en los primeros campos de debitos, credtos y saldos  */
   (NULL,"","0","0","0","0","Inicio","0","0","0",0);
   
   

/* 04 */   
DROP table IF EXISTS proveedores_clientes;

CREATE table proveedores_clientes (
   id                        int unsigned NOT NULL PRIMARY KEY auto_increment,
   fecha_registro            date,
   nombre                    varchar(100),
   direccion                 varchar(200),
   ruc                       varchar(60),
   descripcion               varchar(500),
   
   telefono                  varchar(100),
   fax                       varchar(100),
   email                     varchar(100),
   cedula                    varchar(40),
   
   active_proveedor          bit,            /* Aquí pongo en 1 si es proveedor */
   active_cliente            bit             /* Aquí pongo en 1 si es cliente */
   
);   

/* 05 */
DROP table IF EXISTS proveedores_clientes_contactos;

CREATE table proveedores_clientes_contactos (
   id                        int unsigned NOT NULL PRIMARY KEY auto_increment,
   
   id_proveedor_cliente      int,
   active_proveedor          bit,
   active_cliente            bit,
   
   nombre_contacto           varchar(200),
   telefono_contacto         varchar(100),
   cell_contacto             varchar(100),
   fax_contacto              varchar(100),
   email_contacto            varchar(100),
   cedula_contacto           varchar(40),
   index(id_proveedor_cliente)
   

 );  
   
   
/* 06 */
DROP table IF EXISTS cuentas_x_pagar;

CREATE table cuentas_x_pagar (
   id                 int unsigned NOT NULL PRIMARY KEY auto_increment,
   fecha_registro     date,
   fecha_vencimiento  date,
   no_orden_de_compra int,              /* para el caso de una compra con varios pagos a crédito */
   proveedor          varchar(5),
   detalle_registro   varchar(300),
   valor_abono        float(9,2),       /* Valor de todo lo que se debe abonar */
   valor_abonado      float(9,2),       /* Valor de lo que se va abonando */
   saldo              float(9,2),       /* Valor de lo que queda por abonar */ 
   fin_registro       bit               /* Cuando el REGISTRO se abona completo */
  
);   
   
   
/* 07 */
DROP table IF EXISTS cuentas_x_pagar_details;

CREATE table cuentas_x_pagar_details (
   id                   int unsigned NOT NULL PRIMARY KEY auto_increment,
   id_cxp               int, 
   fecha_actualizacion  date,
   detalle_edit         varchar(300),
   origen_pago          varchar(15), /* ESTO ES 'banco' 'caja' ó 'otros' */
   id_origen_pago       int,
   valor_abono          float(9,2),       /* Valor de todo lo que se debe abonar */
   valor_act_abono      float(9,2),
   saldo                float(9,2),
   
   index (id_cxp)  /* Este es el id de la tabla cuentas_x_pagar único para cada registro */
   
     
);   
      
	  
/* 08 */
DROP table IF EXISTS cuentas_x_cobrar;

CREATE table cuentas_x_cobrar (
   id                 int unsigned NOT NULL PRIMARY KEY auto_increment,
   fecha_registro     date,
   fecha_vencimiento  date,
   no_venta           int,          /* para el caso de una venta con varios pagos a crédito */
   local_venta        int,          /* para el caso dena venta, seleccionar el local de la venta y no se repitan los números*/
   cliente            varchar(5),
   detalle_registro   varchar(200),
   valor_deuda        float(9,2),       /* Valor de todo lo que se debe abonar por el cliente */
   valor_ingresado    float(9,2),       /* Valor de lo que se va abonando por el cliente */
   saldo              float(9,2),       /* Valor de lo que queda por abonar por el cliente */ 
   fin_registro       bit          /* Cuando el REGISTRO se abona completo */
  
);   
   
   
/* 09 */
DROP table IF EXISTS cuentas_x_cobrar_details;

CREATE table cuentas_x_cobrar_details (
   id                   int unsigned NOT NULL PRIMARY KEY auto_increment,
   id_cxc               int, 
   fecha_actualizacion  date,
   detalle_edit         varchar(300),
   destino_cobro        varchar(15),    /* ESTO ES 'banco' 'caja' ó 'otros' */
   id_destino_cobro     int,
   valor_abono          float(9,2),       /* Valor de todo lo que se debe abonar */
   valor_act_abono      float(9,2),
   saldo                float(9,2),
   
   index (id_cxc)  /* Este es el id de la tabla cuentas_x_cobrar único para cada registro */
   
     
);   
      	  
	  
/* 10 */
DROP table IF EXISTS data_empresa;

CREATE table data_empresa (
   id                   int unsigned NOT NULL PRIMARY KEY auto_increment,
   nombre_empresa       varchar(100), 
   razon_social         varchar(500),
   direccion_empresa    varchar(120),
   telefono_empresa     varchar(100),
   ruc_empresa          varchar(100),
   moneda_informes      varchar(30)
        
);   
INSERT INTO data_empresa VALUES
   /* Introduzco el primer valor de registros con el objetivo de poder hacer UPDATES siempre  */
   (NULL,"","","","","","");      	  
   
   
   
/* 11 */
DROP table IF EXISTS registro_compras;

CREATE table registro_compras (
   id                   int unsigned NOT NULL PRIMARY KEY auto_increment, 
   numero_compra        int unsigned NOT NULL,      /* Este es el número (órden) de la compra */
   fecha_compra         date,  
   numero_factura       varchar(20),
   id_proveedor_compra  int,               /* Este es el id del proveedor seleccionado */
   cantidad_articulos   float(9,2),        /* Aqui se pone la cantidad de articulos de la compra*/
   forma_de_pago        varchar(15),       /* Esto puede ser 'credito' ó 'contado' */ 
   monto_de_la_compra   float(9,2),        /* Aquí se pone el monto de la compra */ 
   descuento            float(9,2),        /* Aquí se pone el descuento de la compra */
   valor_pagado_real    float(9,2),        /* Aquí se pone el valor real pagado en la compra*/   
   usuario              varchar(50),       /* Nombre del usuario a través de la variable de $_SESSION */
   test                 varchar(2),        /* Esto es una bandera: '' ó 1 */
   index (numero_compra)                   /* Este es el número de orden de compra quen es único para cada compra */   
          
);  


/* 12 */ 
DROP table IF EXISTS compras_detalles_articulos;

CREATE table compras_detalles_articulos (
   id                   int unsigned NOT NULL PRIMARY KEY auto_increment, 
   numero_compra        int unsigned NOT NULL,          /* Este es el número (órden) de la compra */
   id_referencia_art    varchar(100),
   codigo_art           varchar(20) NOT NULL,
   precio_costo_art     float(9,2),  
   cantidad_articulo    float(9,2),
   valor_total_articulo float(9,2)
   
);  


/* 13 */
DROP table IF EXISTS compras_detalles_pagos;

CREATE table compras_detalles_pagos (
   id                   int unsigned NOT NULL PRIMARY KEY auto_increment, 
   numero_compra        int unsigned NOT NULL,          /* Este es el número (órden) de la compra */
   
        /*1 CASO que se seleccione el origen del pago en Banco ó Caja Central */
   saldo_inicial              float(9,2),          /* Esto para el caso de contado=VALOR TOTAL y en el caso crédito=ANTICIPO */
   origen_del_pago            varchar(20),
   descripcion1               varchar(100),   /* Caso que el origen del pago sea Banco o Caja Central */
       
	   /*2 CASO que se seleccione el origen del pago en Banco y Caja Central */
   monto_caja_central         float(9,2),            
   monto_banco                float(9,2),
   descripcion_caja_central   varchar(100),
   descripcion_banco          varchar(100),
   
   saldo_del_credito          float(9,2),
   cantidad_de_pagos          int,
     
   index(numero_compra)
  
);

/* 14  */ 
DROP table IF EXISTS cajaefectivos_pendientes_de_entrada;

CREATE table cajaefectivos_pendientes_de_entrada (
   id                         int unsigned NOT NULL PRIMARY KEY auto_increment, 
   id_local                   int unsigned NOT NULL,
   fecha_transaccion          date,
   nombre_caja_local_origen   varchar(70),
   cantidad_transaccion       float(9,2),   
   observaciones_transaccion  varchar(500),
   recibido                   bit  /* Se pone 0 cuando está pendiente y en 1 cuando ya se le ha dado entrada en el local correspondiente */


);

/* 15 */
DROP table IF EXISTS cajacentral_1;

CREATE table cajacentral_1 (
   id                          int unsigned NOT NULL PRIMARY KEY auto_increment, 
   fecha_transaccion           date,
   no_orden_de_compra          int,          /* caso de que en una compra se pague en efectivo al momento (sólo REPORTES) */
   id_origen_pago_cxp          int,          /* caso de que se pague una cuenta_por_pagar con un cheque bancario (sólo reporte)*/
   /* no_venta                 int,          ( No pues a la caja central no deben de ir VENTAS ) caso de que en una venta se cobre en efectivo al momento (sólo REPORTES) */ 
   id_origen_cobro_cxc         int,          /* caso de que se cobre una cuenta_por_cobrar con un cheque bancario (sólo reporte)*/
   tipo_transaccion            varchar(20),  /* 'Retiro de Caja' ó 'Ingreso de Caja' */
   origen_transaccion          varchar(70),  /* 'Compras de Artículos' para el Caso de una COMPRA */
   destino_transaccion         varchar(70),
   cantidad_transaccion        float(9,2),
   observaciones               varchar(500),   
   persona_q_hace_transaccion  varchar(100),
   recibido                    bit,
   saldo                       float(9,2) 
  
);


/* 16  */ 
DROP table IF EXISTS locales_inventarios;

CREATE table locales_inventarios (
  id                    int unsigned NOT NULL PRIMARY KEY auto_increment, 
  nombre_local          varchar(80),
  direccion_local       varchar(120),
  telefono_local        varchar(100),
  tipo_local            varchar(10),

  nombre_responsable    varchar(100),
  telefono_responsable  varchar(100),
  cell_responsable      varchar(100),
  email_responsable     varchar(100)  

);

/* 17 */
DROP table IF EXISTS articulos_inventario;

CREATE table articulos_inventario (
   id                   int unsigned NOT NULL PRIMARY KEY auto_increment, 
   codigo_art           varchar(20) NOT NULL,
   referencia_art       varchar(100),
   detalle_art          varchar(200),
   proveedor_art        varchar(100),   
   /* stock_actual         float,      Este valor pasa a las tablas de cada LOCAL  y en un inicio a la BODEGA */ 
   stock_minimo         float(9,2),   
   precio_costo_art     float(9,2),  
   precio_venta1        float(9,2),
   precio_venta2        float(9,2),
   precio_venta3        float(9,2),
   unidad_medida        varchar(50),
   deshabilitar         bit         /* Esto me pudiera funcionar para cuando no quiero que el arículo me dé mas alertas */
   
); 


/* 18 */
DROP table IF EXISTS articulos_pendientes_de_entrada;

CREATE table articulos_pendientes_de_entrada (
   id                       int unsigned NOT NULL PRIMARY KEY auto_increment, 
   id_local                 int unsigned NOT NULL,
   id_codigo_articulo_mov   int unsigned NOT NULL,
   fecha_salida             date,
   concepto_mov             varchar(30),   
   origen_mov_proveedor     varchar(70),
   cantidad_movimiento      float(9,2),   
   observaciones_mov        varchar(500),
   recibido                 bit  /* Se pone 0 cuando está pendiente y en 1 cuando ya se le ha dado entrada en el local correspondiente */
   
); 





     