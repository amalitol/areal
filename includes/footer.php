<?php
/**********************************************************************************
 Archivo que me muestra el footer de todo el sistema 

***********************************************************************************/
?> 

<?php 
 if ( empty($_GET['mod']) || ( isset($_GET['mod']) && $_GET['mod'] != "mod_imprimir" ))  {      
     // header del sistema que se muestra cuando no es el MÓDULO IMPRIMIR.
?>
 
 <footer>
       <center style="clear:both;"><span class="texto-peq">&copy; 2012. SSC  </span>   
<br /> 
<span class="texto-peq"> Powered and Design by Solutip Cia. Ltda.</span> <span class="logo_solutip">  </span>  </center> 
     
 </footer>

</body>
</html>

<?php
 } else if ( isset($_GET['mod']) && $_GET['mod'] == "mod_imprimir" )  {
?> 
     
       <center class="footer_print">
          <span style="font-size:0.8em;"> 
              &copy; 2012. SSC  
          </span>  
       </center>
     
</body>
</html>

<?php
 }
?> 