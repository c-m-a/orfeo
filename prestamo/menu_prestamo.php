<?php
   $krdOld = $krd;
   error_reporting(0);
   session_start();
   if(!$krd) $krd=$krdOsld;
   $ruta_raiz = "..";
   if(!$_SESSION['dependencia'] or !$_SESSION['tpDepeRad']) include "$ruta_raiz/rec_session.php";
   if(!$carpeta) {
      $carpeta = $carpetaOld;
      $tipo_carp = $tipoCarpOld;
   }
   $verrad = "";
   include_once "$ruta_raiz/include/db/ConnectionHandler.php";
   $db = new ConnectionHandler($ruta_raiz);	 
   
/*********************************************************************************
 *       Filename: menu_prestamo.php
 *       Modificado: 
 *          1/3/2006  IIAC  Menú del módulo de préstamos. Carga e inicializa los
 *                          formularios.  
 *********************************************************************************/

   // prestamo CustomIncludes begin
   include ("common.php");   
   // Save Page and File Name available into variables
   $sFileName = "menu_prestamo.php";
   // Variables de control   
   $opcionMenu=strip(get_param("opcionMenu")); 
?>
<html>
<head>
   <title>Archivo - Manejo de prestamos y devoluciones</title>
   <link rel="stylesheet" href="../estilos/orfeo.css" type="text/css">
</head>
<body class="PageBODY">
   <form method="post" action="prestamo.php" name="menu"> 
      <input type="hidden" name="opcionMenu" value="1">      
      <input type="hidden" name="sFileName" value="<?=$sFileName?>"> 
      <input type="hidden"  value='<?=$krd?>' name="krd">
      <input type="hidden" value=" " name="radicado">  	          
      <script>
         // Inicializa la opción seleccionada
         function seleccionar(i) {
            document.menu.opcionMenu.value=i;
            document.menu.submit();
	     }
  	     var opcionM='<?=$opcionMenu?>';		 		 
	     if(opcionM!=""){ seleccionar(opcionM); }
      </script>	  	  	  
      <table width="31%" border="0" cellpadding="0" cellspacing="5" class="borde_tab" align="center">
         <tr>
            <td class="titulos4" align="center">PRESTAMO Y CONTROL DE DOCUMENTO</td>
         </tr>
         <tr>
            <td class="listado2">1. <a class="vinculos" href="javascript:seleccionar(1);">PRESTAMO DE DOCUMENTOS</a></td>   
         </tr>
         <tr>
            <td class="listado2">2. <a class="vinculos" href="javascript:seleccionar(2);">DEVOLUCION DE DOCUMENTOS</a></td>   	  
         </tr>
         <tr>
            <td class="listado2">3. <a class="vinculos" href="javascript:seleccionar(0);">GENERACION DE REPORTES</a></td>   	  	  
         </tr>
         <tr>
            <td class="listado2">4. <a class="vinculos" href="javascript:seleccionar(3);">CANCELAR SOLICITUDES</a></td>   
         </tr>
      </table>
   </form>  
</body>
</html>