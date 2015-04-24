<?php
   error_reporting(0);
   session_start();
   
   // Modificado Infométrika 14-Julio-2009
   // Se asigna el valor de $_SESSION[ 'krd' ] a la variable $krd
   $krd = $_SESSION[ 'krd' ];
   // Modificado Infométrika 14-Julio-2009
   // Se asigna el valor de $_SESSION[ 'dependencia' ] a la variable $dependencia
   $dependencia = $_SESSION[ 'dependencia' ];
   $krdOld = $krd;
   // Modificado Infométrika 14-Julio-2009
   // Se asigna el valor de $_SESSION[ 'tpDepeRad' ] a la variable $tpDepeRad
   $tpDepeRad = $_SESSION[ 'tpDepeRad' ];
   
   if(!$krd) $krd=$krdOsld;
   $ruta_raiz = "..";
   if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";
   if(!$carpeta) {
      $carpeta = $carpetaOld;
      $tipo_carp = $tipoCarpOld;
   }
   $verrad = "";
   include_once "$ruta_raiz/include/db/ConnectionHandler.php";
   $db = new ConnectionHandler($ruta_raiz);	 
   
/*********************************************************************************
 *       Filename: historico.php
 *       Modificado: 
 *          1/3/2006  IIAC  Presenta el flujo histórico de prestamos de un radicado
 *********************************************************************************/
 
   // historico CustomIncludes begin
   include ("common.php");   
   // Save Page and File Name available into variables
   $sFileName = "historico.php";
   // Inicialización
   $antfldRADICADO=get_param("radicado");   
   // Built SQL
   include $ruta_raiz."/include/query/prestamo/builtSQLHistorico.inc";   
   // HTML Page layout  
?>
   <html>
      <head>
         <title>Hist&oacute;rico Prestamos ORFEO</title>
         <link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css" type="text/css">
      </head>
      <body class="PageBODY">
         <script>
            //Regresa al formulario de búsqueda dejando vacíos los campos
            function limpiar() {               
               document.busqueda.submit();
            } 
         </script>				  
         <table border=0 align='center' cellpadding="0" cellspacing="0" width="100%" >
            <tr> 
               <td bgcolor="" width="100%" height="100"><br>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                     <tr>
                        <td height="25" class="titulos4">FLUJO HISTORICO DEL DOCUMENTO <?=$antfldRADICADO?></td>
                     </tr>
                  </table>
                  <table width="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
                     <tr class="titulos2" align="center"> 
                        <td width=10% height="24">DEPENDENCIA</td>
                        <td width=15% height="24">FECHA</td>
                        <td width=20% height="24">TRANSACCION </td>
                        <td width=20% height="24">USUARIO</td>
                        <td width=35% height="24">COMENTARIO</td>
                     </tr>
<?
   // Execute SQL statement	    
   $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
   $rs=$db->query($sSQLTot);
   $db->conn->SetFetchMode(ADODB_FETCH_NUM); 
   $iCounter=0; //cantidad de transacciones
   while($rs && !$rs->EOF) { 
      $fldDEPENDENCIA=$rs->fields["DEPENDENCIA"];
      $fldFECHA      =$rs->fields["FECHA"];
      $fldTRANSACCION=$rs->fields["TRANSACCION"];
      $fldUSUARIO    =$rs->fields["USUARIO"];
      $fldCOMENTARIO1=$rs->fields["COMENTARIO1"];
      $fldCOMENTARIO2=$rs->fields["COMENTARIO2"];
	  $fldCOMENTARIO =$fldCOMENTARIO1.": ".$fldCOMENTARIO2; 	  			
      if($iCounter%2==0){ $tipoListado="class=\"listado2\""; } //indica el estilo de la fila
      else              { $tipoListado="class=\"listado1\""; }  
?>					 
                     <tr class='tpar'> 
                        <td <? echo $tipoListado; ?>><?=$fldDEPENDENCIA?></td>
                        <td <? echo $tipoListado; ?>><?=$fldFECHA?></td>
                        <td <? echo $tipoListado; ?>>Doc F&iacute;sico - <?=$fldTRANSACCION?></td>
                        <td <? echo $tipoListado; ?>><?=$fldUSUARIO?></td>
                        <td <? echo $tipoListado; ?>><?=$fldCOMENTARIO?></td>
                     </tr>
<?
      $rs->MoveNext();
      $iCounter++;
   }
?>	
                     <tr class="titulos5" align="center">		 
                        <td class="leidos" colspan="5"><center><br>Total de Registros: <?=$iCounter?><br>&nbsp;</center></td>
                     </tr>					 
                     <form method="post" action="menu_prestamo.php" name="busqueda">
                        <input type="hidden"  value='<?=$krd?>' name="krd">					 					 					 		 		 
                        <input type="hidden" value="" name="radicado">  				  					 
                        <input type="hidden" value="0" name="opcionMenu">  				  					 					 
                     <tr class="titulos4" align="center">					 		 
                        <td class="listado1" colspan="5"><center><input type="submit" class='botones' value="Cerrar" onClick="javascript: limpiar();"></center></td>
                     </tr>		  
                     </form>					 
                  </table></td>
            </tr>				  
         </table>
      </body>
   </html>	