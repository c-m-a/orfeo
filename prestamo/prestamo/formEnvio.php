<?
session_start();
?>
<HTML>
<?

/**
  * Modificacion para aceptar Variables GLobales
  * @autor Jairo Losada 2009/08 
  * @fecha 2009/05
  */
 foreach ($_GET as $key => $valor)  ${$key} = $valor;
 foreach ($_POST as $key => $valor) ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];

$ruta_raiz = "..";
$mensaje_error = false;
   
   $verrad="";
   include_once "$ruta_raiz/include/db/ConnectionHandler.php";
   $db = new ConnectionHandler($ruta_raiz);	 

   // $db->conn->debug=true;
   if(!$tipo_archivo) $tipo_archivo = 0;   //Para la consulta a archivados

/*********************************************************************************
 *       Filename: formEnvio.php
 *       Modificado 1/3/2006 IIAC
 *********************************************************************************/
 

   // formEnvio CustomIncludes begin
   include ("common.php");   
   // Save Page and File Name available into variables
   $sFileName = "formEnvio.php";
   // Variables de control
   $pageAnt=strip($_POST["sFileName"]);    
   $opcionMenu=$_POST["opcionMenu"]; //opci�n: prestar(1), cancelar(3) o devolver(2)                  
   $ordenar=strip($_POST["ordenar"]);//1 si se dio ordenar y 0 de otro modo 
    // Recupera el identificador de los registros seleccionados   
   $cantRegistros=intval($_POST["prestado"]); //cantidad de registros listados en la consulta	
   if($ordenar=="1"){ $setFiltroSelect=strip($_POST["s_PRES_ID"]); } //Recupera todos los registros presentados si se da ordenar	  
   else { //Recupera solo los registros seleccionados
      $j=0;
      $setFiltroSelect=""; //PRES_ID separados por coma
      for($i=0; $i<$cantRegistros; $i++) {
         $x=$_POST["rta_".$i];
         if($x!=""){ 
	  	    if ($j!=0) { $setFiltroSelect.=","; }
		    $setFiltroSelect.=$x;		 
 	        $j++; 
	     }
      }              
   }
   // Inicializa la identificaci�n del usuario solicitante   
   $usua_codi=strip($_POST["usua_codi"]);   
   $query="select USUA_LOGIN_ACTU from PRESTAMO where PRES_ID in ($setFiltroSelect)";  //primer usuario de los registros    		
   $rs = $db->conn->query($query);		 
   if($rs && !$rs->EOF){ $usua_codi_n=$rs->fields("USUA_LOGIN_ACTU"); } //primer usuario de los registros    		
   $cant=0;   //cantidad de registros solicitados por el mismo usuario
   if($pageAnt==$sFileName && $ordenar==0) {
      $query=" select count(PRES_ID) as TOTAL from PRESTAMO where PRES_ID in ($setFiltroSelect) and USUA_LOGIN_ACTU='".$usua_codi."'";
      $rs = $db->conn->query($query);		 
      if ($rs && !$rs->EOF) { $cant=$rs->fields("TOTAL"); }
   }
   if($cant==0){ $usua_codi=$usua_codi_n; }
   // Recupera radicado e identificador de los registros seleccionados
   include("$ruta_raiz/include/query/busqueda/busquedaPiloto1.php");    
   if($pageAnt==$sFileName && $ordenar==0){  
      $query="select PRES_ID,$radi_nume_radi AS RADI_NUME_RADI from PRESTAMO r where PRES_ID in ($setFiltroSelect) and USUA_LOGIN_ACTU='".$usua_codi."'";
   }
   else{
      $query="select PRES_ID,$radi_nume_radi AS RADI_NUME_RADI from PRESTAMO r where PRES_ID in ($setFiltroSelect)"; 
   }
   $rs = $db->conn->query($query);
   $fldRADICADO="";  //RADI_NUME_RADI separados por coma
   $setFiltroSelect=""; //PRES_ID separados por coma
   $j=0;
   while($rs && !$rs->EOF) {
      $x=$rs->fields("RADI_NUME_RADI");
	  $y=$rs->fields("PRES_ID");
	  if ($j!=0) { 
	     $fldRADICADO.=","; 
		 $setFiltroSelect.=",";
	  }
	  $setFiltroSelect.=$y;		 
	  $fldRADICADO.=$x;
      $j++; 
      $rs->MoveNext();
   }  
   
   
   // Procesamiento de los registros seleccionados 
   $encabezado="&krd=".tourl($krd)."&s_PRES_ID=".tourl($setFiltroSelect)."&dependencia=".tourl($dependencia).
               "&radicado=".tourl($fldRADICADO)."&s_PRES_REQUERIMIENTO=&FormAction=";
   $enviar=0;
   if($opcionMenu==3) {  //cancelar
      $encabezado.="delete&";	  
      $enviar=1; 	  
   }			   
   elseif ($opcionMenu==1 || $opcionMenu==2) {  //prestamo y devoluci�n
      // Oculta o hace visible el campo que solicita la contrase�a
      $verClave=0;
      $query="select PARAM_VALOR from SGD_PARAMETRO where PARAM_NOMB='PRESTAMO_PASW'"; 
      $rs = $db->conn->query($query);
      if ($rs && !$rs->EOF) { $verClave = $rs->fields("PARAM_VALOR"); }         
      // Inicializa las variables   
      $flds_PRES_ESTADO=strip($_POST["s_PRES_ESTADO"]);    
      if ($opcionMenu==1) { //Pr�stamo
	     if($flds_PRES_ESTADO==5){ $encabezado.="prestamoIndefinido&"; }
	     else                    { $encabezado.="prestamo&"; }	  
         $titCaj="Prestar Documento"; 	  
         // Inicializaci�n de la fecha de vencimiento     
         if ($fechaVencimiento=="") {	  	  	  
            $query="select PARAM_VALOR,PARAM_NOMB from SGD_PARAMETRO where PARAM_NOMB='PRESTAMO_DIAS_PREST'"; 
            $rs = $db->conn->query($query);
            if(!$rs->EOF) { 
               $x = $rs->fields("PARAM_VALOR");  // d�as por defecto
			   $hastaXDias = strtotime("+".$x." day"); 
	           $fechaVencimiento=date("Y-m-d",$hastaXDias);	
			}
		 }		 
      }
      else { // Devoluci�n		
         $encabezado.="devolucion&";
         $titCaj="Devolver Documento"; 	  
      }	  
      // Procesa la solicitud
      if ($pageAnt==$sFileName) {
   	     $nover=0;	  
	     $observa=strip($_POST["observa"]); 
         $encabezado.="&observa=".tourl($observa)."&";
         // Validaci�n de la fecha de vencimiento para los prestamos
         if ($ordenar==0 && $opcionMenu==1 && $flds_PRES_ESTADO==2) { 
            $x=date("Y-m-d");
	        if ($fechaVencimiento>$x){ 
			   $encabezado.="&fechaVencimiento=".tourl($fechaVencimiento)."&"; 
			   $enviar=1;   			
			}
			else { 
			   echo "<script> alert('La fecha de vencimiento no puede ser menor o igual que la actual'); </script>"; 
			   $nover=1;
			}
  	     }
         // Validaci�n de la contrase�a
	     $flds_CONTRASENA=strip($_POST["s_CONTRASENA"]);
		 if ($ordenar==0 && $verClave==1 && $nover!=1) {
            $query="select USUA_CODI from USUARIO where USUA_LOGIN='".$usua_codi."' and USUA_PASW='".SUBSTR(md5($flds_CONTRASENA),1,26)."'"; 
            $rs = $db->conn->query($query);		 
            if($rs && !$rs->EOF) { $enviar=1; }
	        else { 
			   echo "<script> alert('La contrase�a del usuario solicitante es incorrecta'); </script>"; 
               $enviar=0;
			}			
		 } 
	  }    
   }
   if ($enviar==1) {  // Llama la p�gina que hace el procesamiento
      echo " .. ";
      echo "<form action='".$ruta_raiz."/solicitar/Reservar.php?<?=$encabezado?>' method='post' name='go'> </form><br>";
      echo "<script>document.go.submit();</script>";   	  
   }
   
   
   // Build SQL
   $sSQLsele=" and P.PRES_ID in (".$setFiltroSelect.") ";   
   include $ruta_raiz."/include/query/prestamo/builtSQL1.inc";   
   include $ruta_raiz."/include/query/prestamo/builtSQL3.inc";       
   // Build ORDER statement	  	  
   $iSort=strip($_POST["FormPedidos_Sorting"]);
   $iSorted=strip($_POST["FormPedidos_Sorted"]); 
   $sDirection=strip($_POST["s_Direction"]); 
   if($pageAnt!=$sFileName) {
      if($iSorted==$iSort && $sDirection=" DESC "){ $sDirection=" ASC "; }   
	  else{ $sDirection=" DESC "; }   
   }
   if($iSorted!=$iSort){ $sDirection=" DESC ";}
   else{ 	
	  if (strcasecmp($sDirection," DESC ")==0){ $sDirection=" ASC "; }
	  else { $sDirection=" DESC "; }  
   }  		    
   $sOrder=" order by ".$iSort.$sDirection.",PRESTAMO_ID";   
   $sSQLtot=$sSQL.$sOrder;
   // Inicializa los campos de la tabla que van a ser vistos
   include "inicializarRTA.inc";		    					  					  
   // HTML column prestamo headers		 		 		 
?>
   <head>
      <title>Enviar Datos</title>	  
      <link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css" type="text/css">	  
      <!--Necesario para hacer visible el calendario -->		 
      <script src="<?=$ruta_raiz?>/js/popcalendar.js"></script>
      <div id="spiffycalendar" class="text"></div>		 		 
      <link rel="stylesheet" type="text/css" href="<?=$ruta_raiz?>/js/spiffyCal/spiffyCal_v2_1.css">		 
   </head>
   <script language="JavaScript" src="<?=$ruta_raiz?>/js/spiffyCal/spiffyCal_v2_1.js"></script>
   <script language="javascript">       
	  setRutaRaiz ('<?=$ruta_raiz?>'); // Para el calendario
   </script>
   <body bgcolor="#FFFFFF" topmargin="0">
    <table border=0 width=100% cellpadding="0" cellspacing="0">
	   <tr>
	      <td width=100%><br>
 	         <form action='<?=$ruta_raiz?>/solicitar/Reservar.php?<?=$encabezado?>' method=post name="rta" >
                <!-- par�metros para procesar !-->	  		 		 
                <input type="hidden"  value='<?=$krd?>' name="krd">					 					 					 		 
                <input type="hidden" value=" " name="radicado">  	 
                <input type="hidden" value="<?=$cantRegistros?>" name="prestado">  	 								
                <!-- par�metros de control sobre esta p�gina !-->	  		 		 				
                <input type="hidden" value="<?=$sFileName?>" name="sFileName">  				 								
   	            <input type="hidden" name="opcionMenu" value="<?= $opcionMenu ?>">	  						
                <!-- usuario que solicita el pr�stamo o devoluci�n !-->	  		 		 				
   	            <input type="hidden" name="usua_codi" value="<?=$usua_codi?>">				
                <!-- orden de presentaci�n del resultado en el formulario de envio !-->	  		 		 
       	        <input type="hidden" name="FormPedidos_Sorting" value="<?=$iSort?>">
	            <input type="hidden" name="FormPedidos_Sorted" value="<?=$iSorted?>">
                <input type="hidden" name="s_Direction" value="<?=$sDirection?>">				         
       	        <input type="hidden" name="ordenar" value="0"> <!-- no ordena !-->
                 <!-- Genera la consulta !-->	  		 		 
                <input type="hidden" name="s_PRES_ID" value="<?=$setFiltroSelect?>">				                 	  								

		        <table width="100%" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
 	            <tr>
		           <TD width=30% class="titulos4">USUARIO:<br><br><?=$usua_nomb?><br></TD>
	   	           <TD width='30%' class="titulos4">DEPENDENCIA:<br><br><?=$depe_nomb?><br></TD>
		           <TD width="35%" class="titulos4"><?=$titCaj?><BR></td>
		           <td width='5' class="grisCCCCCC"><input type=button value=REALIZAR onclick="okTx();" name=enviardoc align=bottom class=botones id=REALIZAR></td>
	            </tr>
       	        <tr align="center">
	               <td colspan="4" class="celdaGris" align=center><br><center>
		             <table width="100%"  border=0 align="center" bgcolor="White">
		                 <tr bgcolor="White">
					        <td width="100"><center><img src="<?=$ruta_raiz?>/iconos/tuxTx.gif" alt="Tux Transaccion" title="Tux Transaccion"></center></td>
					   	    <td align="left"><textarea name=observa cols=70 rows=3 class=ecajasfecha><?=$observa?></textarea></TD>
					     </tr>  			             
<? if ($opcionMenu==1) {  // Prestamo?>
                         <tr bgcolor="White">
 	                        <td width="100" align="right" class="titulosError2">Estado:</td>
						    <td align="left"><select class="select" name="s_PRES_ESTADO" onChange="javascript: ver(); ">
<?    $query="select PARAM_CODI, PARAM_VALOR from SGD_PARAMETRO where PARAM_NOMB='PRESTAMO_ESTADO' and PARAM_CODI in (2,5)"; 
      $rs = $db->conn->query($query);
      while($rs && !$rs->EOF) {
         $idEstado =$rs->fields("PARAM_CODI");
         $txtEstado=$rs->fields("PARAM_VALOR");	
	     $x="";	  	  		 
		 if ($flds_PRES_ESTADO==$idEstado) { $x=" selected "; } 
         echo " <option ".$x." value=".$idEstado.">".strtoupper($txtEstado)."</option> ";	   
         $rs->MoveNext();
      } ?>
						                  </select></td>
					     </tr>						  									  					  
                         <tr bgcolor="White" id="fecha">
             	  	        <td width="100" align="right" class="titulosError2" title="(aaaa-mm-dd)">Fecha de Vencimiento:</td>	 
         			        <td align="left"><script language="javascript">
			                var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "rta","fechaVencimiento","btnDate1","<?=$fechaVencimiento?>",scBTNMODE_CUSTOMBLUE);
			                dateAvailable1.writeControl();
			                dateAvailable1.dateFormat="yyyy-MM-dd";
		                    </script></td>
                         </tr>
                      <script>
					     // Oculta o hace visible el campo de la fecha de vencimiento dependiendo del estado seleccionado por el usuario
					     function ver() {
						    var verFecha=document.rta.s_PRES_ESTADO.options[document.rta.s_PRES_ESTADO.selectedIndex].value;
						    if(verFecha==2){ fecha.style.display = ''; }
							else {           fecha.style.display = 'none'; }
						 }
						 ver();
                      </script>					  					  
<? }
   if ($verClave==1) {  ?>					  
                         <tr bgcolor="White">
             	  	        <td width="100" align="right" class="titulosError2">Contrase&ntilde;a<br><?=$usua_codi?>:</td>
         			        <td align="left"><input type="password" name="s_CONTRASENA" value="<?=$flds_CONTRASENA?>"></td>
         	             </tr>
<? } ?>
 				      </table></center></td>
	           </tr>
       	        <tr align="center">
	               <td colspan="4" class="celdaGris" align=center><br><center>
		             <table width="100%"  border=0 align="center" bgcolor="White">
		                 <TR bgcolor="White">
					        <TD width="100%" align="center">					 
                               <table align="center" border=0 cellpadding=0 cellspacing=2 class='borde_tab' width="100%">	   
<?PHP      
   include "inicializarTabla.inc";     
   // Execute SQL statement	
   $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
   $rs=$db->query($sSQLtot);
   $db->conn->SetFetchMode(ADODB_FETCH_NUM);           
   // Display grid based on recordset
   $y=0; // Cantidad de registros presentados 
   include_once "getRtaSQLAntIn.inc"; //Une en un solo campo los expedientes
   while($rs && !$rs->EOF) {
      // Inicializa las variables con los resultados
	  include "getRtaSQL.inc";			
	  if ($antfldPRESTAMO_ID!=$fldPRESTAMO_ID) { //Une en un solo campo los expedientes					 								 									
		 if ($y!=0) { include "cuerpoTabla.inc"; } // Fila de la tabla con los resultados
		 include "getRtaSQLAnt.inc";			   
		 $y++;
	  }
	  else {		 
		 if ($antfldEXP!=""){ 
			$antfldEXP.="<br>"; 
   	        $antfldARCH.="<br>"; 
		 }
		 $antfldEXP.=$fldEXP;
		 if ($fldARCH=='SI') {
  			$encabARCH = session_name()."=".session_id()."&buscar_exp=".tourl($fldEXP)."&krd=$krd&tipo_archivo=&nomcarpeta=";
		    $antfldARCH.="<a href='".$ruta_raiz."/expediente/datos_expediente.php?".$encabARCH."&num_expediente=".tourl($fldEXP)."&nurad=".tourl($antfldRADICADO)."' class='vinculos'>".$fldARCH."</a>";
		 }
	     else { $antfldARCH.=$fldARCH; }		 		 
	  }
      $rs->MoveNext(); 			
   }
   if ($y!=0) {	  		 
      include "cuerpoTabla.inc";  // Fila de la tabla con lso resultados						 
      $y++;	  
   } 
   $iCounter=$y-1;  //cantidad de registros
 ?>
                                  <tr class="titulos5" align="center">		 
                                     <td class="leidos" colspan="<?=($numCol+1);?>"><center><br>P&aacute;gina 1/1<br>Total de Registros: <?=$iCounter?><br>&nbsp;</center></td>
                                  </tr>
                               </table>
						   </TD>
					     </tr>
				      </table></center></td>
	            </tr>			 
            </TABLE><br>
		     </form></td>
	   </tr>
    </table>
 <script>
    // Envia el formulario para que sea ordenado segun el criterio indicado
    function ordenar(i) {
       document.rta.action="formEnvio.php";
       document.rta.FormPedidos_Sorting.value=i;
       document.rta.FormPedidos_Sorted.value=<?=$iSort?>;
	   document.rta.ordenar.value=1;	  	  
	   document.rta.submit();
    } 
    // Marca todas las casillas si la del titulo es marcada
	function seleccionarRta() {
	   valor=document.rta.rta_.checked;
<? for ($j=0; $j<$iCounter; $j++) { ?>
       document.rta.rta_<?=$j?>.checked=valor;			  
<? } ?>
    } 
    // Verifica que el navegador soporte las funciones de Javascript 
    function setSel(start,end){
       document.rta.observa.focus();	
       var t=document.rta.observa;
       if(t.setSelectionRange){
          t.setSelectionRange(start,end);
          t.focus();
       } 
	   else { alert('Su browser no soporta las funciones Javascript de esta p�gina.'); }
    } 	
    // Verifica el m�ximo n�mero de caracteres permitido 
    function valMaxChars(maxchars) {
      document.rta.observa.focus();		
      if(document.rta.observa.value.length > maxchars) {
   	     alert('Demasiados caracteres en el texto, solo se permiten '+ maxchars);
 	     setSel(maxchars,document.rta.observa.value.length);
         return false; 
	  }
      else { return true; }
    } 
	// Valida los campos antes de enviar el formulario 
    function okTx() {
       valCheck = 0;
       for (i=0; i<<?=$iCounter?>; i++) {
          if (eval('document.rta.rta_'+i+'.checked')==true){ 
             valCheck = 1;
             break;
          }
	   }
	   if(valCheck==0) {
     	  alert('Debe seleccionar al menos un radicado');	   	   
	      return 0;
	   }
       verClave=<?=$verClave?>;	   
	   if (verClave==1) {
		  if (document.rta.s_CONTRASENA.value=="") { 
		     alert('Digite la contrase�a del usuario solicitante');
			 return 0;
		  }
	   }	   
	   numCaracteres = document.rta.observa.value.length;
	   if(numCaracteres>=6){
		 if (valMaxChars(550)) {
	      document.rta.prestado.value=<?=$iCounter?>;
        document.rta.action='<?=$sFileName?>?';		
		    document.rta.submit(); 
		 }
	   }
	   else{ 
	      alert("Atencion: El numero de Caracteres minimo en la Observacion es de 6. (Digito :"+numCaracteres+")"); 
		  return 0;
	   }	 	     
    }
	// Marca todas las cajas de seleccion arrancando la p�gina
    document.rta.rta_.checked=true;
 	seleccionarRta();
</script>
   </body>
</html>
