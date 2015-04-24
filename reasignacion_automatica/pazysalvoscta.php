<?
session_start();

$verradOld=$verrad;

/*if (!$ruta_raiz)*/ $ruta_raiz = "..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumental.php");


if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->BeginTrans();

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	

//echo "$krd<br>$dependencia";
if (!$krd or !$dependencia or !$usua_doc)   
include "$ruta_raiz/rec_session.php";
$verrad =$verradOld;

//echo "usuario : $expediente";
//exit;
// echo "22".$_SERVER['PHP_SELF'];

?>
<html>
<head>
<title>Enviar Datos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">

<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
<body bgcolor="#FFFFFF" topmargin="0">

<?
// Programa que actualiza los datos de notificación para un radicado
/*if  (count($recordSet)>0)
	array_splice($recordSet, 0);  		
if  (count($recordWhere)>0)
	array_splice($recordWhere, 0);
*/	
//echo "$fecha_hoy <br>";
//echo "$sqlFechaHoy <br>";
$fecha_hoy = Date("Y-m-d");
$sqlFechaHoy=$db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
$Arrtrimestre = split (",", $trimestre);

for($i=0;$i<count($Arrtrimestre);$i++)
{
	$values["NIT_DE_LA_EMPRESA"] = $nit;
	$values["IDENTIFICADOR_EMPRESA"] = $id;
	$values["PYS_FECHA"] = $sqlFechaHoy;
	$values["RADI_NUME_RADI"] = $verrad;
	$values["PYS_ANO"] = $ano;
	$values["PYS_TRIMESTRE"] = $Arrtrimestre[$i];	
	//$db->conn->debug = true; 
	$rs=$db->insert("SES_PAZYSALVOS_CTA", $values);



	if (!$rs){
			$db->conn->RollbackTrans();
			die ("<span class='alarmas'>No se ha podido actualizar la información de Paz y Salvos"); 	
	}
	else
	{
	//	echo("alarmas Paz Y Salvo");
	}
}
/*
$objTipDec->tipoDecision_codigo($decis);
$tipDecDesc = $objTipDec->get_sgd_tdec_descrip();
*/

$values2["depe_codi"] = $dependencia;
$values2["hist_fech"] = " $sqlFechaHoy ";
$values2["usua_codi"] = $codusuario;
$values2["radi_nume_radi"]=$verrad;
$values2["hist_obse"] = "'Incluir a bases de datos e Paz y Salvos Cta '";
$values2["usua_codi_dest"] = $codusuario;
$values2["usua_doc"] = $usua_doc;
//La  transacción 35 es la tipificación de la transacción
$values2["SGD_TTR_CODIGO"] = 200;
$rs=$db->insert("hist_eventos",$values2);

if (!$rs){
			 	$db->conn->RollbackTrans();
		 	 	die ("<span class='alarmas'>ERROR TRATANDO DE ESCRIBIR EL HISTORICO");
}
else
{
//	echo("historico");
}


$sql = "SELECT RADI_NUME_RADI
					FROM SGD_RDF_RETDOCF 
					WHERE RADI_NUME_RADI = '$verrad'
				    AND  DEPE_CODI =  '$dependencia'";
//					echo $sql;
		$rs=$db->conn->query($sql);
		$radiNumero = $rs->fields["RADI_NUME_RADI"];
		if ($radiNumero !='') {
		   $codserie = 0 ;
  		   $tsub = 0  ;
  		   $tdoc = 0;
		   $mensaje_err = "<HR><center><B><FONT COLOR=RED>No se Tipifico el Radicado, Ya existe una definici&oacute;n de documento </FONT></B></center><HR>";
		  }
		  else
		  {


$trd = new TipoDocumental($db);
$codiTRDS[0]=8063;
//$codiTRDS=548;
$codiTRD=8063;
$tdoc=571;

/*echo "$codiTRDS<br>";
echo "$codiTRD<br>";
echo "$verrad<br>";
echo "$dependencia<br>";
echo "$codusuario<br>";
*/
			$radicados = $trd->insertarTRD($codiTRDS,$codiTRD,$verrad,$dependencia, $codusuario);
//			echo "<b>$radicados</b>";
		    $TRD = $codiTRD;

			include "$ruta_raiz/radicacion/detalle_clasificacionTRD.php";
			$sqlH = "SELECT RADI_NUME_RADI
					FROM SGD_RDF_RETDOCF 
					WHERE RADI_NUME_RADI = '$verrad'
				    AND  SGD_MRD_CODIGO =  '$codiTRD'";
			$rsH=$db->conn->query($sqlH);
			$i=0;
			while(!$rsH->EOF)
			{
	    		$codiRegH[$i] = $rsH->fields['RADI_NUME_RADI'];
	    		$i++;
				$rsH->MoveNext();
			}
		  	$observa = "*TRD*".$deta_serie."/".$deta_subserie."/".$deta_tipodocu;
  		  	$Historico = new Historico($db);		  
  		  	//$radiModi = $Historico->insertarHistorico($codiRegH, $coddepe, $codusua, $coddepe, $codusua, $observa, 32); 
			$radiModi = $Historico->insertarHistorico($codiRegH, "500", $codusuario, "500", $codusuario, $observa, 32); 

/*			echo "codiRegH: $codiRegH <br>";
			echo "dependencia:$dependencia <br>";
			echo "codusuario=$codusuario <br>";
			echo "dependencia=$dependencia<br>";
			echo "codusuario=$codusuario<br>";
			echo "observa=$observa<br>";

			echo "codigoH: $codiRegH<br>";
			echo "tipo doc $tdoc<br>";
*/
		 	$radiUp = $trd->actualizarTRD($codiRegH,$tdoc);

		}
		
		
//incluir expediente
include_once( "$ruta_raiz/include/tx/Expediente.php" );

if( $expediente > 0 ){   
	if( $expediente == 1)
	{	
		$sql_Ent = "SELECT * FROM BODEGA_EMPRESAS
					WHERE NIT_DE_LA_EMPRESA = '$nit'";
					
		$rs_Ent = $db->conn->query($sql_Ent);
		
		$sigla = $rs_Ent->fields['SIGLA_DE_LA_EMPRESA'];
		
		$arrParametro[1] = $nit;
		$arrParametro[2] = $sigla;
		
		$cod_SRD = '22';
		$cod_SUBSRD = '4';
		$trdExp = substr("00".$cod_SRD, -2) . substr("00".$cod_SUBSRD, -2);
		$anoExp = $ano;
		$digCheck = "E";
		
		$exp = new Expediente($db);
		if($exp)
		{
			$secExp = $exp->secExpediente($dependencia, $cod_SRD, $cod_SUBSRD, $anoExp);			
			$consecutivoExp = substr("00000".$secExp, -5);
			$numeroExpediente = $anoExp . $dependencia . $trdExp . $consecutivoExp . $digCheck;
			
			$fechaExp = date("d/m/Y");
			$usuaDocExp = $usua_doc;
			$numeroExpedienteE = $exp->crearExpediente( $numeroExpediente,$verrad,$dependencia,$codusuario,$usua_doc,$usuaDocExp,$cod_SRD,$cod_SUBSRD,'false',$fechaExp,0, $arrParametro);
			$insercionExp = $exp->insertar_expediente( $numeroExpediente,$verrad,$dependencia,$codusuario,$usua_doc);
			if($insercionExp == 1)
			{
				$expediente = $numeroExpediente;
				$observa = "Creacion de Expediente";
				include_once "$ruta_raiz/include/tx/Historico.php";
				$radicados[] = $verrad;
				$tipoTx = 51;
				$Historico = new Historico($db);
				$Historico->insertarHistoricoExp($numeroExpediente,$radicados, $dependencia,$codusuario, $observa, $tipoTx,0);
			}
			else
			{
				$db->conn->RollbackTrans();
				die ("<span class='alarmas'>No se ha podido generar el Expediente</span>");
			}
		}
	}

	$Oexpediente = new Expediente( $db );
	// Consulta si el radicado está incluido en el expediente.
	$arrExpedientes = $Oexpediente->expedientesRadicado( $verrad );

	// Si el radicado está incluido en el expediente digitado por el usuario.
	// !== No idéntico
	if( array_search( $expediente, $arrExpedientes ) !== false ){
		print '<hr><font color="red">El radicado ya está incluido en el expediente.</font><hr>';
		}
	// Si el radicado no está incluido en algún expediente o si está incluido en un
	// expediente diferente al digitado por el usuario.
	else{
		$resultadoExp = $Oexpediente->insertar_expediente( $expediente, $verrad, $dependencia, $codusuario, $usua_doc );
		if( $resultadoExp == 1 ){
			$observa = "Incluir radicado en Expediente";
			//            include_once "$ruta_raiz/include/tx/Historico.php";
			$radicados[] = $verrad;
			$tipoTx = 53;
			$Historico = new Historico( $db );
			$Historico->insertarHistoricoExp( $expediente, $radicados, $dependencia, $codusuario, "EXPEDIENTE AUTOMATICO", $tipoTx, 0 );
			}
		else{
			print '<hr><font color=red>No se anexo este radicado al expediente. Verifique que el numero del expediente exista e intente de nuevo.</font><hr>';	    
			}
		}
	include "$ruta_raiz/include/tx/Tx.php";
	
	$rs = new Tx($db);
	$nombTx = "Archivo de Documentos";
	$radicadosSel[] = $verrad;
	$txSql = $rs->archivar( $radicadosSel, $krd,$dependencia,$codusuario,"ARCHIVO AUTOMATICO");
	
	}



//$db->conn->debug=true;
$db->conn->CommitTrans();

?>
<form action='enviardatos.php?PHPSESSID=172o16o0o154oJH&krd=JH' method=post name=formulario>
<br>
<table border=0 cellspace=2 cellpad=2 WIDTH=50%  class="t_bordeGris" id=tb_general align="left">
	<tr>
	<td colspan="2" class="titulos4">ACCION REQUERIDA </td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">ACCION REQUERIDA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	BASE DE DATOS PAZ Y SALVOS Y TIPIFICACIÓN
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">RADICADOS INVOLUCRADOS :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa"><?=$verrad ?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$usua_nomb?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">FECHA Y HORA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$fecha_hoy?>
	</td>
	</tr>
<tr><td colspan="2" align="center">
<BR>
<input name='cancelar' type='button'  class='botones' id='envia22'  onClick='window.close()' value='Cerrar'>
<br>
<?
echo $mensaje_err;
?>
</td></tr>

	</table>
	<BR>
</form>

</body>
</html>