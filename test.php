<?php

//n
class PDF extends FPDF
{
   
  //01 Cabecera de página
  function Header()
  {
     $datos_informe = receive_titulo();         // En esta variable recibo el TÍTULO, el SUBTÍTULO y el CÓDIGO del documento.
	 $datos_empresa = data_empresa_values();    // En esta variable guardo los datos de la empresa.
	 $fecha = gmdate('Y-m-d', time() - 18000 ); // Fecha de hoy
	 
	 //01. Título y Subtítulo de la TABLA.
	 $titulo = $datos_informe['nombre'];                          /* Título */
	 $titulo = utf8_decode($titulo); 
	 $nombre_subtitulo1 = $datos_informe['nombre_subtitulo1'];    /* Nombre del Subtítulo */
	 $nombre_subtitulo1 = utf8_decode($nombre_subtitulo1); 
	 $subtitulo1 = $datos_informe['subtitulo1'];                  /* Subtítulo */
	 $subtitulo1 = utf8_decode($subtitulo1); 
	 	  
	 /******* SECCIÓN 1: DATOS DE LA EMPRESA. *******/
	 $direccion_empresa = "DIRECCIÓN";  $direccion_empresa = utf8_decode($direccion_empresa); 
     $telefono_empresa = "TELÉFONO";  $telefono_empresa = utf8_decode($telefono_empresa); 
	 $codigo_informe = "CÓDIGO";  $codigo_informe = utf8_decode($codigo_informe); 
	 
	 // CONFIGURACIÓN.
	 $this->SetFont('Times','',8);  //indico el tipo de línea.
     
	    $this->Cell(100,4,'EMPRESA: '.$datos_empresa['nombre_empresa'].' ',0,0,''); 
		$this->Cell(100,4,''.$codigo_informe.': '.$datos_informe['codigo'].'',0,0,'R'); 
        $this->Ln();
        $this->Cell(100,4,''.$direccion_empresa.': '.$datos_empresa['direccion_empresa'].' ',0,0,''); 
        $this->Cell(100,4,'FECHA: '.$fecha.'',0,0,'R'); 
		$this->Ln();
        $this->Cell(100,4,''.$telefono_empresa.': '.$datos_empresa['telefono_empresa'].' ',0,0,''); 
        $this->Ln();
        $this->Cell(100,4,'RUC: '.$datos_empresa['ruc_empresa'].' ',0,0,''); 
        $this->Ln();
        $this->Cell(100,4,'MONEDA: '.$datos_empresa['moneda_informes'].' ',0,0,''); 
        $this->Ln();
     
	 /******* SECCIÓN 2: DATOS DEL INFORME. *******/
        $this->Cell(100,4,'INFORME: '.$titulo,0,0,'');  // Título del documento.
        $this->Ln();
		$this->Cell(100,4,''.$nombre_subtitulo1.': '.$subtitulo1,0,0,'');  // Subtítulo1 del documento.
		 
      $this->Ln(5); // Salto de línea
  
  } // Fin de la function Header()

//02 Tabla coloreada
  function FancyTable($header, $data)
  {
      // Colores, ancho de línea y fuente en negrita
      $this->SetFillColor(221,242,247);
      $this->SetTextColor(0,0,0);
      $this->SetDrawColor(128,128,128);
      $this->SetLineWidth(.2);
      $this->SetFont('','B');
      
	  /*************************************************************************************************************************
	                                                     3. Cabecera de la TABLA. Depende de $_GET
	   *************************************************************************************************************************/												  
      // CASO 1. MÓDULO REGISTRO BANCARIO.
	  if ( isset($_GET['rb']) && ($_GET['rb'] == 2 || $_GET['rb'] == 1) )  {
	      //a) imprimir RB mes actual
		  //b) imprimir RB mes solicitado
 		  $w = array(10,18,110,20,20,20);
	  
	  } 
	  // CASO 2: MÓDULO CUENTAS X COBRAR.
	     else if ( isset($_GET['cxc']) && ($_GET['cxc'] == 2 || $_GET['cxc'] == 1) )  {
	      //c) imprimir CXC mes actual
		  //d) imprimir CXC mes solicitado
 		  $w = array(9,18,18,9,9,40,40,19,20,19);
	  	  
      } 
	  // CASO 3: MÓDULO CUENTAS X PAGAR.
	     else if ( isset($_GET['cxp']) && ($_GET['cxp'] == 2 || $_GET['cxp'] == 1) )  {
	      //e) imprimir CXP mes actual
		  //f) imprimir CXP mes solicitado
 		  $w = array(9,18,18,9,43,43,20,20,20);
	  	  
      } 
	  // CASO 4: MÓDULO PROVEEDORES.
	     else if ( isset($_GET['pro']) && $_GET['pro'] == 1 )  {
	       //g) imprimir todos los Proveedores de la BD.
		   $w = array(9,17,38,38,20,20,20,40);
	  	  
      } 
	  
	  
	  
	  
	  
	  //IMPRESIÓN//
	  for($i=0; $i < count($header); $i++)
          $this->Cell($w[$i],4,$header[$i],1,0,'C',true);   
      $this->Ln();
  
      // Restauración de colores y fuentes
      $this->SetFillColor(255,255,255);
      $this->SetTextColor(0,0,0);
      $this->SetFont('');
  
      /***************************************************************************************************************************
	                                                   4. Datos de la TABLA. Depende de $_GET
	   ***************************************************************************************************************************/														
	  $fill = false;
      $contador = 1;
	  // CASO 1. MÓDULO REGISTRO BANCARIO.
	  if ( isset($_GET['rb']) && ($_GET['rb'] == 2 || $_GET['rb'] == 1) )  {
	      //a) imprimir mes actual
		  //b) imprimir mes solicitado
		  if ( $data == "null" )  {
			  // Esto significa que no hay ningun registro.  
		  } else {
		      // Esto significa que existen registros para el mes solicitado.	  
		      foreach($data as $row)
              {
                 $this->Cell($w[0],4,$contador++,'LR',0,'C',$fill);
                 $this->Cell($w[1],4,$row['fecha'],'LR',0,'C',$fill);
                 $this->Cell($w[2],4,$row['descripcion'],'LR',0,'L',$fill);
                 $this->Cell($w[3],4,$row['debitos'],'LR',0,'C',$fill);
		         $this->Cell($w[4],4,$row['creditos'],'LR',0,'C',$fill);
		         $this->Cell($w[5],4,$row['saldos'],'LR',0,'C',$fill);
          		 			  
		         $this->Ln();       // Salto de línea // Próxima celda.
                 $fill = !$fill;
              		  
			  }  // Fin del foreeach($data as $row)
		   
		  } // Fin del if ( $data == "null" )  {
	  
	  } // CASO 2. MÓDULO CUENTAS X COBRAR.
	    else if ( isset($_GET['cxc']) && $_GET['cxc'] == 2 )  {
	      //c) imprimir mes actual
		  if ( $data[0]['exist'] == "no" )  {
			  // Esto significa que no hay ningun registro.  
		  } else {
		      // Esto significa que existen registros para el mes solicitado.	  
		      		  
			  for($i=1; $i < count($data); $i++)
              {
                 $this->Cell($w[0],4,$contador++,'LR',0,'C',$fill);
                 $this->Cell($w[1],4,$data[$i]['fecha_registro'],'LR',0,'C',$fill);
                 $this->Cell($w[2],4,$data[$i]['fecha_vencimiento'],'LR',0,'C',$fill);
                 $this->Cell($w[3],4,$data[$i]['no_venta'],'LR',0,'C',$fill);
		         $this->Cell($w[4],4,$data[$i]['local_venta'],'LR',0,'C',$fill);
				 $this->Cell($w[5],4,$data[$i]['nombre'],'LR',0,'L',$fill);
		         $this->Cell($w[6],4,$data[$i]['detalle_registro'],'LR',0,'L',$fill);
				 $this->Cell($w[7],4,$data[$i]['valor_deuda'],'LR',0,'C',$fill);
				 $this->Cell($w[8],4,$data[$i]['valor_ingresado'],'LR',0,'C',$fill);
				 $this->Cell($w[9],4,$data[$i]['saldo'],'LR',0,'C',$fill);
				           		 			  
		         $this->Ln();       // Salto de línea // Próxima celda.
                 $fill = !$fill;
              		  
			  }  // Fin del foreeach($data as $row)
		   
		  } // Fin del if ( $data[0]['exist'] == "no" )  {
	  
	  } else if ( isset($_GET['cxc']) && $_GET['cxc'] == 1 )  { 
	     //d) imprimir mes solicitado
	     if ( $data[2] === "ningun_registro" )  {
			  // Esto significa que no hay ningun registro.  
		 } else {
		     // Esto significa que existen registros para el mes solicitado.	  
		      		  
			 for($i=3; $i < count($data); $i++)
             {
                $this->Cell($w[0],4,$contador++,'LR',0,'C',$fill);
                $this->Cell($w[1],4,$data[$i]['fecha_registro'],'LR',0,'C',$fill);
                $this->Cell($w[2],4,$data[$i]['fecha_vencimiento'],'LR',0,'C',$fill);
                $this->Cell($w[3],4,$data[$i]['no_venta'],'LR',0,'C',$fill);
		        $this->Cell($w[4],4,$data[$i]['local_venta'],'LR',0,'C',$fill);
				$this->Cell($w[5],4,$data[$i]['nombre'],'LR',0,'L',$fill);
		        $this->Cell($w[6],4,$data[$i]['detalle_registro'],'LR',0,'L',$fill);
				$this->Cell($w[7],4,$data[$i]['valor_deuda'],'LR',0,'C',$fill);
				$this->Cell($w[8],4,$data[$i]['valor_ingresado'],'LR',0,'C',$fill);
				$this->Cell($w[9],4,$data[$i]['saldo'],'LR',0,'C',$fill);
				           		 			  
		        $this->Ln();       // Salto de línea // Próxima celda.
                $fill = !$fill;
              		  
			 }  // Fin del foreeach($data as $row)
		  
		 } // Fin del if ( $data[2] === "ningun_registro" )  {
	    
	  } // CASO 3. MÓDULO CUENTAS X PAGAR.
	    else if ( isset($_GET['cxp']) && $_GET['cxp'] == 2 )  { 
	      //e) imprimir mes actual
		  if ( $data[0]['exist'] == "no" )  {
			  // Esto significa que no hay ningun registro.  
		  } else {
		      // Esto significa que existen registros para el mes solicitado.	  
		      		  
			  for($i=1; $i < count($data); $i++)
              {
                 $this->Cell($w[0],4,$contador++,'LR',0,'C',$fill);
                 $this->Cell($w[1],4,$data[$i]['fecha_registro'],'LR',0,'C',$fill);
                 $this->Cell($w[2],4,$data[$i]['fecha_vencimiento'],'LR',0,'C',$fill);
                 $this->Cell($w[3],4,$data[$i]['no_orden_de_compra'],'LR',0,'C',$fill);
		         $this->Cell($w[4],4,$data[$i]['nombre'],'LR',0,'L',$fill);
		         $this->Cell($w[5],4,$data[$i]['detalle_registro'],'LR',0,'L',$fill);
				 $this->Cell($w[6],4,$data[$i]['valor_abono'],'LR',0,'C',$fill);
				 $this->Cell($w[7],4,$data[$i]['valor_abonado'],'LR',0,'C',$fill);
				 $this->Cell($w[8],4,$data[$i]['saldo'],'LR',0,'C',$fill);
				           		 			  
		         $this->Ln();       // Salto de línea // Próxima celda.
                 $fill = !$fill;
              		  
			  }  // Fin del foreeach($data as $row)
		   
		  } // Fin del if ( $data[0]['exist'] == "no" )  {
	  
	  } else if ( isset($_GET['cxp']) && $_GET['cxp'] == 1 )  { 
	     //d) imprimir mes solicitado
	     if ( $data[2] === "ningun_registro" )  {
			  // Esto significa que no hay ningun registro.  
		 } else {
		     // Esto significa que existen registros para el mes solicitado.	  
		      		  
			 for($i=3; $i < count($data); $i++)
             {
                $this->Cell($w[0],4,$contador++,'LR',0,'C',$fill);
                $this->Cell($w[1],4,$data[$i]['fecha_registro'],'LR',0,'C',$fill);
                $this->Cell($w[2],4,$data[$i]['fecha_vencimiento'],'LR',0,'C',$fill);
                $this->Cell($w[3],4,$data[$i]['no_orden_de_compra'],'LR',0,'C',$fill);
		        $this->Cell($w[4],4,$data[$i]['nombre'],'LR',0,'L',$fill);
		        $this->Cell($w[5],4,$data[$i]['detalle_registro'],'LR',0,'L',$fill);
				$this->Cell($w[6],4,$data[$i]['valor_abono'],'LR',0,'C',$fill);
				$this->Cell($w[7],4,$data[$i]['valor_abonado'],'LR',0,'C',$fill);
				$this->Cell($w[8],4,$data[$i]['saldo'],'LR',0,'C',$fill);
				           		 			  
		        $this->Ln();       // Salto de línea // Próxima celda.
                $fill = !$fill;
              		  
			 }  // Fin del foreeach($data as $row)
		  
		 } // Fin del if ( $data[2] === "ningun_registro" )  { 
	  
      } // CASO 4. MÓDULO PROVEEDORES.
	    
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
	 
  }  // Fin de la función FancyTable
  
  //03 Pie de página
  function Footer()
  {
      $pagina_no = "Página ";  $pagina_no = utf8_decode($pagina_no); 
	  
	  // Posición: a 1,5 cm del final
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Arial','I',6);
      // Número de página
      $this->Cell(0,10,''.$pagina_no.''.$this->PageNo().'',0,0,'C');
  } // Fin de la función Footer()





















  



  var $widths;
  var $aligns;
  //04 Array con los anchos de las Columnas.
  function SetWidths($w)
  {
      //Set the array of column widths
      $this->widths=$w;
  }

  //05 Array con los alineamientos de las columnas.
  function SetAligns($a)
  {
    //Set the array of column alignments
    $this->aligns=$a;
  }

  //06 Calculando el alto de la FILA.
  function Row($data)
  {
     $data = proveedores_del_sistema();
	 
	 
	 //Calculate the height of the row
     $nb=0;
     for($i=0;$i<count($data);$i++)
         $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
     $h=5*$nb;
     //Issue a page break first if needed
     $this->CheckPageBreak($h);
     //Draw the cells of the row
     for($i=0;$i<count($data);$i++)
     {
         $w=$this->widths[$i];
         $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
         //Save the current position
         $x=$this->GetX();
         $y=$this->GetY();
         //Draw the border
         $this->Rect($x,$y,$w,$h);
         //Print the text
         $this->MultiCell($w,5,$data[$i],0,$a);
         //Put the position to the right of the cell
         $this->SetXY($x+$w,$y);
     }
     //Go to the next line
     $this->Ln($h);
  }

  //07 Insertar un salto de página si la altura de la fila causa un overflow 
  function CheckPageBreak($h)
  {
     //If the height h would cause an overflow, add a new page immediately
     if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
  }

  //08 Archiva el número de lineas que tendrá la Multicelda. 
  function NbLines($w,$txt)
  {
     //Computes the number of lines a MultiCell of width w will take
     $cw=&$this->CurrentFont['cw'];
     if($w==0)
         $w=$this->w-$this->rMargin-$this->x;
     $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
     $s=str_replace("\r",'',$txt);
     $nb=strlen($s);
     if($nb>0 and $s[$nb-1]=="\n")
         $nb--;
     $sep=-1;
     $i=0;
     $j=0;
     $l=0;
     $nl=1;
     while($i<$nb)
     {
         $c=$s[$i];
         if($c=="\n")
         {
             $i++;
             $sep=-1;
             $j=$i;
             $l=0;
             $nl++;
             continue;
         }
         if($c==' ')
             $sep=$i;
         $l+=$cw[$c];
         if($l>$wmax)
         {
             if($sep==-1)
             {
                 if($i==$j)
                     $i++;
             }
             else
                 $i=$sep+1;
             $sep=-1;
             $j=$i;
             $l=0;
             $nl++;
         }
         else
             $i++;
     }
     return $nl;
  }



} // Fin de class PDF extends FPDF


?>