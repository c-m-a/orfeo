<?
  	error_reporting(0); 
  	$krdOld=$krd;
 	session_start(); 
 	if(!$krd) $krd = $krdOld;
 	$ruta_raiz = ".."; 
 	if(!$dependencia) 
 	{
 		include "$ruta_raiz/rec_session.php";
 		echo $usua_doc;
 	}
 	
	if (!$nurad) $nurad= $rad;
	if($nurad)
	{
		$ent = substr($nurad,-1);
	}
	include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	
	$db = new ConnectionHandler("$ruta_raiz");
	
	if (!defined('ADODB_FETCH_ASSOC')) define('ADODB_FETCH_ASSOC',2);
   	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
   	
    include_once ("$ruta_raiz/class_control/TipoDocumental.php");

    $coddepe = $dependencia;
	$codusua = $codusuario;
	$isqlAnex = "SELECT SGD_TPR_CODIGO from anexos WHERE ANEX_RADI_NUME = $nurad";
	
	$rsDepR = $db->conn->Execute($isqlAnex);
  	$trd = new TipoDocumental( $db );
  	$resultadoActualizacion = "";
  	
	$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&krd=$krd&nurad=$nurad&coddepe=$coddepe&codusuario=$codusua&codusua=$codusua&codusuario=$codusuario&depende=$depende&ent=$ent&tdoc=$tdoc&codiTRDModi=$codiTRDModi&codiTRDEli=$codiTRDEli&codserie=$codserie&tsub=$tsub&ind_ProcAnex=$ind_ProcAnex";

	?>
<html>
<head>
<title>Tipificar Anexo</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
<script>

function regresar(){   	
	document.TipoDocu.submit();
}
</script>
</head>
<body bgcolor="#FFFFFF">
<form method="post" action="<?=$encabezadol?>" name="TipoDocu"> 
  <?
 
  	if ($codserie != 0) {
  		if($codserie > 10000){
  			$codserie = 0;
  		}else {
  			
  			$anexMod = $trd->actualizarTRDAUnitario( $nurad, $codserie );
  			$resultadoActualizacion = "Se actualiz&oacute; el Anexo: " . $nurad . ", con el tipo documental: " . $codserie;
  		}
  		
  	}
  	
	?>  
	<table border=0 width=100% align="center" class="borde_tab" cellspacing="0">
	  <tr align="center" class="titulos2">
	    <td height="15" class="titulos2">TIPIFICACI&Oacute;N ANEXO .TIFF</td>
      </tr>
	 </table> 
 	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
      <tr >
	  <td class="titulos5" >Tipo Documental</td>
	  <td class=listado5 >
        <?php
  
    if(!$tdoc) $tdoc = 0;
    if(!$codserie) $codserie = 0;
	if(!$tsub) $tsub = 0;
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$num_car = 4;
	$nomb_varc = "s.sgd_srd_codigo";
	$nomb_varde = "s.sgd_srd_descrip";
   	include "$ruta_raiz/include/query/trd/querytipodocu.php";
	$querySerie = "select distinct ($sqlConcat) as detalle, t.sgd_tpr_codigo 
	         from sgd_tpr_tpdcumento t
			 order by detalle
			  ";
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra los tipos de documento";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
 ?>   
      </td>
     </tr>
  
   </table>
<br>
	<table border=0 width=100% align="center" class="borde_tab">
	  <tr align="center">
		<td width="100%" height="25" class="titulos5" align="center">
         <center><?=$resultadoActualizacion?></center></TD>
	   </tr>
	</table>
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
	  <tr align="center">
	    <td>
		<?
		if ($ind_ProcAnex=="S")
			{
	      	echo " <br> <input type='button' value='Cerrar' class='botones_largo' onclick='opener.regresar();window.close();'> ";
			}	
		?>
	 	</td>
	   </tr>
	</table>

</form>
</span>
<p>
<?=$mensaje_err?>
</p>
</span>
</body>
</html>