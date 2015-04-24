<?php
	session_start();
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$ruta_raiz= "..";
	include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	$db->conn->debug=true;
	include_once "$ruta_raiz/include/tx/Historico.php";
	include_once ("$ruta_raiz/class_control/TipoDocumental.php");
	include_once "$ruta_raiz/include/tx/Expediente.php";
	$trd = new TipoDocumental($db);
	$numeroExpediente=$_GET['numeroExpediente'];
	$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&opcionExp=$opcionExp&numeroExpediente=$numeroExpediente&dependencia=$dependencia&krd=$krd&nurad=$nurad&coddepe=$coddepe&codusua=$codusua&depende=$depende&ent=$ent&tdoc=$tdoc&codiTRDModi=$codiTRDModi&codiTRDEli=$codiTRDEli&codserie=$codserie&tsub=$tsub&ind_ProcAnex=$ind_ProcAnex";
	$codserie=(isset($_POST['codserie']))?$_POST['codserie']:0;
	$tsub =(isset($_POST['tsub']))?$_POST['tsub']:0;
	$coddepe =$_SESSION['depecodi'];
	$nurad=$_GET['nurad'];
	$codusuario=$_SESSION['codusuario'];
	$usua_doc=$_SESSION['usua_doc'];
									
	function crearProcesoExpediente($numExpediente,$radicado,$depe_codi,$usua_codi,$usua_doc,$usuaDocExp,$codiSRD,$codiSBRD,$fechaExp,$proc){
		global $db;
		$trdExp = substr("00".$codiSRD,-2) . substr("00".$codiSBRD,-2);
		$anoExp = substr($numExpediente,0,4);
		$secExp = substr($numExpediente,11,5);
		$consecutivoExp = substr("00000".$secExp,-5);
		$numeroExpediente = $anoExp . $dependencia . $trdExp . $consecutivoExp;
	$fecha_hoy = Date("Y-m-d");
		
		$consultaEtaInicial="SELECT SGD_FEXP_CODIGO,SGD_PEXP_DESCRIP FROM SGD_FEXP_FLUJOEXPEDIENTES f 
							INNER JOIN SGD_PEXP_PROCEXPEDIENTES p on f.SGD_PEXP_CODIGO=p.SGD_PEXP_CODIGO
							WHERE f.SGD_PEXP_CODIGO={$proc} 
							order by SGD_FEXP_ORDEN";
		$rs= $db->conn->SelectLimit($consultaEtaInicial,1);
		$codEtapa=$rs->fields['SGD_FEXP_CODIGO'];
		$flujo_nombre=$rs->fields['SGD_PEXP_DESCRIP'];
		
		$record["SGD_FEXP_CODIGO"] = $codEtapa;
		$record["SGD_EXP_FECHFLUJOANT"] = $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
		$record["SGD_HFLD_FECH"] = $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
		$record["SGD_EXP_NUMERO"] = "'".$numExpediente."'";
		$record["RADI_NUME_RADI"] = $radicado;
		$record["USUA_DOC"] = "'".$usua_doc."'";
		$record["DEPE_CODI"] = $depe_codi;
		$record["USUA_CODI"] = $usua_doc;
		$record["SGD_TTR_CODIGO"] = 50;
		$record["SGD_HFLD_OBSERVA"] = "'Creacion del Proceso $flujo_nombre'";
		$record["SGD_FARS_CODIGO"] = "0";
		$record["SGD_HFLD_AUTOMATICO"] = 1;
	
	if(!$fechaExp) $fechaExp = $fecha_hoy;
	$sqlFechaHoy=$db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
		$query="insert into SGD_SEXP_SECEXPEDIENTES(SGD_EXP_NUMERO   ,SGD_SEXP_FECH      ,DEPE_CODI   ,USUA_DOC   ,SGD_FEXP_CODIGO,SGD_SRD_CODIGO,SGD_SBRD_CODIGO,SGD_SEXP_SECUENCIA, SGD_SEXP_ANO,USUA_DOC_RESPONSABLE,SGD_PEXP_CODIGO)
	VALUES ('$numExpediente',". $sqlFechaHoy ." ,'$depe_codi','$usua_doc',$codEtapa,$codiSRD,$codiSBRD,$secExp ,$anoExp,$usuaDocExp,$proc)";
	$query = "Update SGD_SEXP_SECEXPEDIENTES set SGD_PEXP_CODIGO=$proc where SGD_EXP_NUMERO='$numExpediente' ";
		if (!$rs = $db->conn->query($query)){
			//echo '<br>Lo siento no pudo agregar el expediente<br>';
		echo "<script type=\"text/javascript\"> alert(\"No se ha podido Adicionar el proceso \");</script>";
			return 0;
		}else{
		//echo "<br>Expediente Grabado Correctamente<br>";
		$insertSQL = $db->insert("SGD_HFLD_HISTFLUJODOC", $record, "true");
		
		return $numExpediente;
		}
	}
	
	foreach ( $_POST as $elementos => $valor )
    {
        if ( strncmp ( $elementos, 'parExp_', 7) == 0 )
        {
            $indice = ( int ) substr ( $elementos, 7 );
            $arrParametro[ $indice ] = $valor;
        }
    }
    if(!$fechaExp) $fechaExp = date("d/m/Y");

?>
<html>
<head>
<title>Adicionar Proceso</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css"><script>
function regresar(){
	document.TipoDocu.submit();
}

function Start(URL, WIDTH, HEIGHT)
{
    windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width="+WIDTH+",height="+HEIGHT;
    preview = window.open(URL , "preview", windowprops);
}
function $(elemento){
	return document.getElementById(elemento);
}
function validar(){
	var error="";
	if($('crearProceso')!=undefined){
		var seleccion=document.getElementsByTagName('SELECT');
		for(i=0;i < seleccion.length;i++){
			if(seleccion[i].value=='0' ){
				error="posee un error Verifique e intente de Nuevo en La TRD o no ingreso el Responsable \n recurde solo se puedenasociar TRD con procesos";
				seleccion[i].focus();
			}	
		}
	}
	if(error=="")
		return true;
	else{
		alert(error);
		return false
	}
}
</script><style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
<form method="post" action="<?=$encabezadol?>" name="TipoDocu" onsubmit="return validar();">
 <table style="width:70%;" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
   <tr align="center" class="titulos2">
      <td height="15" class="titulos2" colspan="2">APLICACION DE LA TRD EL EXPEDIENTE</td>
    </tr>
<tr >
<td width="62%" class="titulos5" >SERIE</td>
<td width="38%" class=listado5 >
<?php
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$num_car = 4;
	$nomb_varc = "s.sgd_srd_codigo";
	$nomb_varde = "s.sgd_srd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySerie = "select distinct ($sqlConcat) as detalle, s.sgd_srd_codigo
		from sgd_mrd_matrird m, sgd_srd_seriesrd s
		where m.depe_codi = '$coddepe'
			and s.sgd_srd_codigo = m.sgd_srd_codigo
			and ".$sqlFechaHoy." between s.sgd_srd_fechini and s.sgd_srd_fechfin
		order by detalle
	";
	$rsD=$db->conn->Execute($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select' id='codserie'" );
 ?>
	</td>
	</tr>
	<tr>
		<td class="titulos5" >SUBSERIE</td>
	<td class=listado5 >
	<?
	$nomb_varc = "su.sgd_sbrd_codigo";
	$nomb_varde = "su.sgd_sbrd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySub = "select distinct ($sqlConcat) as detalle, su.sgd_sbrd_codigo
		from sgd_mrd_matrird m, sgd_sbrd_subserierd su
		where m.depe_codi = '$coddepe'
			and m.sgd_srd_codigo = '$codserie'
			and su.sgd_srd_codigo = '$codserie'
			and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo
			and ".$sqlFechaHoy." between su.sgd_sbrd_fechini and su.sgd_sbrd_fechfin
		order by detalle
		";

	$rsSub=$db->conn->Execute($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,"","onChange='submit()' class='select' id='tsub' " );
	if(!$codiSRD)
	{
		$codiSRD = $codserie;
		$codiSBRD = $tsub;
	}
   	$queryPEXP = "select SGD_PEXP_DESCRIP,SGD_PEXP_CODIGO FROM
			SGD_PEXP_PROCEXPEDIENTES
			WHERE
				SGD_SRD_CODIGO=$codiSRD
				AND SGD_SBRD_CODIGO=$codiSBRD
			";
	$rs=$db->conn->Execute($queryPEXP);
	$texp = $rs->fields["SGD_PEXP_CODIGO"];
?>
		</td>
		</tr>
	<tr>
        <td class="titulos5" >PROCESO</td>
        <td class="listado5" colspan="2" >
          <?
            $comentarioDev = "Muestra los procesos segun la combinacion Serie-Subserie";
            include "$ruta_raiz/include/tx/ComentarioTx.php";

            print $rs->GetMenu2("codProc", $codProc, "0:-- Seleccione --", false,"","onChange='submit()' class='select' id='codProc' " );

            $rs->MoveFirst();
            while ( !$rs->EOF )
            {
                $arrProceso[ $rs->fields["SGD_PEXP_CODIGO"] ] = $rs->fields["SGD_PEXP_DESCRIP"];
                $rs->MoveNext();
            }

            // Si se selecciono Serie-Subserie-Proceso
            if( $codProc != "" && $codProc != 0 && $codserie != "" && $codserie != 0 && $tsub != "" && $tsub != 0 )
            {
                // Termino del proceso seleccionado
                $queryPEXP  = "select SGD_PEXP_TERMINOS";
                $queryPEXP .= " FROM SGD_PEXP_PROCEXPEDIENTES";
                $queryPEXP .= " WHERE SGD_PEXP_CODIGO  = ".$codProc;
                // print $queryPEXP;
                $rs=$db->conn->Execute($queryPEXP);

                $expTerminos = $rs->fields["SGD_PEXP_TERMINOS"];
                if ( $expTerminos != "" )
                {
                    $expDesc = " $expTerminos Dias Calendario de Termino Total";
                }
            }
            print "&nbsp;".$expDesc;
          ?>
        </td>
	</tr>
	<tr>
	<td class="listado2" colspan="2">Se dispone a  Crear un Proceso en el Expediente N&middot;</td>
	</tr>
	<tr>
	<td align="center" class="titulosError"  style="font-size:20px;" colspan="2"><?php echo $numeroExpediente;?></td>
	</tr>
 <tr align="center">
 <tr>
	<TD class=titulos5>
		Fecha de Inicio del Proceso.
	</TD>
	<td class=listado2>
  <script language="javascript">
  <?
	 if(!$fechaExp) $fechaExp = date("d/m/Y");
  ?>
   var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "TipoDocu", "fechaExp","btnDate1","<?=$fechaExp?>",scBTNMODE_CUSTOMBLUE);
  </script>
			<script language="javascript">
				dateAvailable1.date = "<?=date('Y-m-d');?>";
				dateAvailable1.writeControl();
				dateAvailable1.dateFormat="dd-MM-yyyy";
			</script>
  </td>
 </tr>
<TD class=titulos5 nowrap>
		Usuario Responsable del Proceso
	</TD>
	<td class=listado2>
<?
	$queryUs = "select usua_nomb, usua_doc from usuario where depe_codi=$dependencia AND USUA_ESTA=1
							order by usua_nomb";
	$rsUs = $db->conn->Execute($queryUs);
	print $rsUs->GetMenu2("usuaDocExp", "$usuaDocExp", "0:-- Seleccione --", false,""," class='select' onChange='submit()'");

?>
	</td>
</tr>
	<tr align="center">
	<td width="33%" height="25" class="listado2" align="center">
	<center>
	<?php  if($tsub && $codserie && $usuaDocExp) {?>
			<input name="CrearProceso" type="submit" id='crearProceso' class="botones_funcion" value="Crear Proceso" />
	<?php } ?>
	</center></TD>
	<td width="33%" class="listado2" height="25">
	<center><input name="cerrar" type="button" class="botones_funcion" id="envia22" onClick="opener.regresar(); window.close();" value=" Cerrar "></center></TD>
	</tr>
</table>
</form>
</body>
</html>
<?php if(isset($_POST['CrearProceso'])){
	
	$sal=crearProcesoExpediente( $numeroExpediente,$nurad,$coddepe,$codusuario,$usua_doc,$usuaDocExp,$codserie,$tsub,$fechaExp, $_POST['codProc'], $arrParametro );
			$observa = "*TRD*".$codserie."/".$codiSBRD." (Creacion de Expediente.)";
				include_once "$ruta_raiz/include/tx/Historico.php";
				$radicados[] = $nurad;
		
			$tipoTx = 51;
			$Historico = new Historico($db);
			$Historico->insertarHistoricoExp($numeroExpediente,$radicados, $dependencia,$codusuario, $observa, $tipoTx,0);
			if($sal){
			?>
			<script type="text/javascript">
				opener.regresar(); 
				window.close();
			</script>
			<?php
			}
 }
 ?>
