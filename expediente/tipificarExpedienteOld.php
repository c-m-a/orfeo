<?
session_start();
/**Modulo de Expedientes o Carpetas Virtuales
  * Modificacion Variables
  *@autor Jairo Losada 2009/06
  *Licencia GNU/GPL 
  */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tpDepeRad = $_SESSION["tpDepeRad"];
$usuaPermExpediente = $_SESSION["usuaPermExpediente"];

$ruta_raiz = ".."; 	
 //$db->conn->debug = true;
	if (!$nurad) $nurad= $rad;
	if($nurad)
	{
		$ent = substr($nurad,-1);
	}
    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	include_once "$ruta_raiz/include/tx/Historico.php";
	include_once ("$ruta_raiz/class_control/TipoDocumental.php");
	include_once "$ruta_raiz/include/tx/Expediente.php";
	$trd = new TipoDocumental($db);
	$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&opcionExp=$opcionExp&numeroExpediente=$numeroExpediente&krd=$krd&dependencia=$dependencia&krd=$krd&nurad=$nurad&coddepe=$coddepe&codusua=$codusua&depende=$depende&ent=$ent&tdoc=$tdoc&codiTRDModi=$codiTRDModi&codiTRDEli=$codiTRDEli&codserie=$codserie&tsub=$tsub&ind_ProcAnex=$ind_ProcAnex";
?>
<html>
<head>
<title>Tipificar Documento</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css"><script>

function regresar(){   	
	document.TipoDocu.submit();
}

function Start(URL, WIDTH, HEIGHT)
{
    windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width="+WIDTH+",height="+HEIGHT;
    preview = window.open(URL , "preview", windowprops);
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

<form method="post" action="<?=$encabezadol?>" name="TipoDocu">
  <?
  /*
  * Adicion nuevo Registro
  */
  //if ($tdoc !=0 && $tsub !=0 && $codserie !=0 && $varInser == "Aceptar"  )
  if ($Actualizar && $tsub !=0 && $codserie !=0)
  {
  	if(!$digCheck)
	{
		$digCheck = "E";
	}
  	$codiSRD = $codserie;
	$codiSBRD = $tsub;
	$trdExp = substr("00".$codiSRD,-2) . substr("00".$codiSBRD,-2);
	$consecutivoExp = substr("00000".$consecutivoExp,-5);
	//$numeroExpediente = $anoExp . $dependencia . $trdExp . $consecutivoExp . $digCheck;

	/*
     *  Modificado: 09-Junio-2006 Supersolidaria
     *  Arreglo con los parametros del expediente.
	 */
    foreach ( $_POST as $elementos => $valor )
    {
        if ( strncmp ( $elementos, 'parExp_', 7) == 0 )
        {
            $indice = ( int ) substr ( $elementos, 7 ); 
            $arrParametro[ $indice ] = $valor;
        }
    }
		
		
		//$db->conn->debug = true;
		$expediente = new Expediente($db);
		$anoExp = substr($numExpediente,0,4);
		//$secExp = $expediente->secExpediente($dependencia,$codiSRD,$codiSBRD);
  /**  Procedimiento que Crea el Numero de  Expediente
	  *  @param $numeroExpediente String  Numero Tentativo del expediente, Hya que recordar que en la creacion busca la ultima secuencia creada.
	  *  @param $nurad  Numeric Numero de radicado que se insertara en un expediente.
	  */
		//$db->conn->debug = true;
		//$numeroExpedient = $expediente->crearExpediente( $numeroExpediente,$nurad,$dependencia,$codusuario,$usua_doc,$codiSRD,$codiSBRD,'true',$fechaExp);
		//$numeroExpediente = $expediente->modificarExpediente($numeroExpediente,$nurad,$dependencia,$codusuario,$usua_doc,$codiSRD,$codiSBRD,'true',$fechaExp);
		//$numeroExpediente = $expediente->modificarExpediente($numExpediente,$radicado,$depe_codi,$usua_codi,$usua_doc,$usuaDocExp,$codiSRD,$codiSBRD,$expOld=null,$fechaExp=null, $codiPROC=null, $arrParametro=null )
		//$db->conn->debug = true;
		$numeroExpediente = $expediente->modificarTRDExpediente($radicado,$numeroExpediente,$codiSRD,$codiSBRD,$codProc,$arrParametro,$usuaDocExp);
//echo $codProc;
		if($numeroExpediente==0)
		{
			echo "<CENTER><table class=borde_tab><tr><td class=titulosError>EL EXPEDIENTE HA SIDO MODIFICADO.</td></tr></table>";
		}
			$codiTRDS[$i] = $rsTRD->fields['SGD_MRD_CODIGO'];
			$codiTRD = $rsTRD->fields['SGD_MRD_CODIGO'];
			$codiTRDS = $codiTRD;
			// @param $tipoTx int Valor de Transaccion de Tabla SGD_TTR 51 corresponde a Crear un Expediente.
			$tipoTx = 51;
			$i++;
    $TRD = $codiTRD;
			include "$ruta_raiz/radicacion/detalle_clasificacionTRD.php";
			$sqlH = "SELECT RADI_NUME_RADI
					FROM SGD_RDF_RETDOCF 
					WHERE RADI_NUME_RADI = '$nurad'
				    AND  SGD_MRD_CODIGO =  '$codiTRD'";
			$rsH=$db->conn->query($sqlH);
			$i=0;
	  	$observa = "*TRD*".$deta_serie."/".$deta_subserie." (Insercion de Expediente Antiguo a Flujos.)";
			include_once "$ruta_raiz/include/tx/Historico.php";
			$radicados[] = $nurad;
			$Historico = new Historico($db);
			$Historico->insertarHistoricoExp($numeroExpediente,$radicados, $dependencia,$codusuario, $observa, $tipoTx,0);
  }
	?>
<table border=0 width=70% align="center" class="borde_tab" cellspacing="0">
	<tr align="center" class="titulos2">
		<td height="15" class="titulos2">APLICACION DE LA TRD EL EXPEDIENTE</td>
		</tr>
</table> 
<table width="70%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
<?php
    if( $numeroExpedienteE != 0 )
    {
        $arrTRDExp = $expediente->getTRDExp( $numeroExpediente, $codserie, $tsub, $codProc );   
    ?>
    <tr class="titulos5">
      <td>SERIE</td>
      <td>
        <?php print $arrTRDExp['serie']; ?>
	  </td>
	  </tr>
	<tr class="titulos5">
	  <td>SUBSERIE</td>
	  <td>
        <?php print $arrTRDExp['subserie']; ?>
	  </td>
    </tr>
	<tr class="titulos5">
      <td>PROCESO</td>
      <td>
        <?php print $arrTRDExp['proceso']; ?>
       </td>
	</tr>
    <?php
    }
    ?>
<tr >
<td width="62%" class="titulos5" >SERIE</td>
<td width="38%" class=listado5 >
	<?php
	//if( $numeroExpediente != 0 )
    //{
       // $arrTRDExp = $expediente->getTRDExp( $numeroExpediente, $codiSDR, $codiSBRD, $_POST['codProc'] );
	if(!$tdoc) $tdoc = 0;
	if(!$codserie) $codserie = 0;
	if(!$tsub) $tsub = 0;
	if(!$codProc) $codProc=0; 
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
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
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
	$rsSub=$db->conn->query($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
		    
	if(!$codiSRD)
	{
  		$codiSRD = $codserie;
		$codiSBRD = $tsub;
	}
   	$queryPEXP = "select SGD_PEXP_DESCRIP,SGD_PEXP_CODIGO,SGD_PEXP_TERMINOS FROM 
			SGD_PEXP_PROCEXPEDIENTES
			WHERE 
				SGD_SRD_CODIGO=$codiSRD
				AND SGD_SBRD_CODIGO=$codiSBRD
			";
	$rs=$db->conn->query($queryPEXP);
	//$descTipoExpediente = $rs->fields["SGD_PEXP_DESCRIP"];
	
	
	?>
  <tr class="titulos5">
      <td>PROCESO</td>
      <td>
        <?php //print $arrTRDExp['proceso']; ?>
     
	<?
	
	 $comentarioDev = "Muestra los procesos segun la combinacion Serie-Subserie";
            include "$ruta_raiz/include/tx/ComentarioTx.php";
               
            print $rs->GetMenu2("codProc", $codProc, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
             //  echo "aki va";
            /*
             *  Modificado: 17-Agosto-2006 Supersolidaria
             *  Se crea un arreglo con los procesos asociados a serie-subserie.
             */
            $rs->MoveFirst();
            while ( !$rs->EOF )
            {
                $arrProceso[ $rs->fields["SGD_PEXP_CODIGO"] ] = $rs->fields["SGD_PEXP_DESCRIP"];
                $rs->MoveNext();
            }
         $expTerminos = $rs->fields["SGD_PEXP_TERMINOS"];

//echo $codProc;

  IF($expTerminos != "" and $codProc != "")
  {
    $expDesc = " $expTerminos Dias Calendario de Termino Total";
  
?> 
		</td>
		</tr>
	<tr>
		<td class="titulos5" colspan="2" ><center>&nbsp;<?=$expDesc?></center></td>
	</tr>
	<?
  }
?>
</table>

<br>
<table border=0 width=70% align="center" class="borde_tab">
 <tr align="center">
	<td width="13%" height="25" class="titulos5" align="center">
	Nombre de Expediente</TD>
	<?
	if(!$digCheck)
	{
		$digCheck = "E";
	}
	$expediente = new Expediente($db);
	// $secExp = $expediente->secExpediente($dependencia,$codiSRD,$codiSBRD);
	// $trdExp = substr("00".$codiSRD,-2) . substr("00".$codiSBRD,-2);
	// $consecutivoExp = substr("00000".$secExp,-5);
	?>
	<td width="33%" class="listado2" height="25">
	<p>
	</center> 
	<?=$numeroExpediente?>
	</TD>
 </tr>
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
 

  <?php
    $sqlParExp  = "SELECT SGD_PAREXP_ETIQUETA, SGD_PAREXP_ORDEN";
    $sqlParExp .= " FROM SGD_PAREXP_PARAMEXPEDIENTE PE";
    $sqlParExp .= " WHERE PE.DEPE_CODI = ".$dependencia;
    $sqlParExp .= " ORDER BY SGD_PAREXP_ORDEN";
    // print $sqlParExp;
    $rsParExp = $db->conn->query( $sqlParExp );
    //$db->conn->debug=true;
    while ( !$rsParExp->EOF )
    {
  ?>
    <tr align="center">
      <td width="13%" height="25" class="titulos5" align="left">
  <?php  
        print $rsParExp->fields['SGD_PAREXP_ETIQUETA']; 
  ?>
      </td>
      <td width="13%" height="25" class="titulos5" align="left">
        <input type="text" name="parExp_<?php print $rsParExp->fields['SGD_PAREXP_ORDEN']; ?>" value="<?php print $_POST[ 'parExp_'.$rsParExp->fields['SGD_PAREXP_ORDEN'] ]; ?>" size="60" readonly>
      </td>
    </tr>  
  <?php
$orden=$ParExp_1;
        $rsParExp->MoveNext();
    }
  ?>
  
  <tr align="center">
    <td width="13%" height="25" class="titulos5" align="center" colspan="2">
      <input type="button" name="Button2" value="BUSCAR" class="botones" onClick="Start('buscarParametro.php?busq_salida=<?=$busq_salida?>&krd=<?=$krd?>',1200,420);">
    </td>
  </tr>  
 
 <TD class=titulos5>
		Usuario Responsable del Proceso
	</TD>
	<td class=listado2>
<?
echo $orden;
	$queryUs = "select usua_nomb, usua_doc from usuario where depe_codi=$dependencia AND USUA_ESTA=1
							order by usua_nomb";
	$rsUs = $db->conn->Execute($queryUs);
	print $rsUs->GetMenu2("usuaDocExp", "$usuaDocExp", "0:-- Seleccione --", false,""," class='select' onChange='submit()'");

?>
	</td>

</table>
<br>
<?
if($tipificarExpediente)
{
?>
<table border=0 width=70% align="center" class="borde_tab">
		<tr align="center">
		<td width="33%" height="25" class="listado2" align="center">
		<center class="titulosError2">
		ESTA SEGURO DE TIPIFICAR EL EXPEDIENTE ? <BR>
		EL EXPEDIENTE QUE VA HA TIPIFICAR ES EL : 
		</center><B><center class="style1"><?=$numeroExpediente?></center>
		</B>
		<div align="justify"><br>
		  
		  <strong><b>Recuerde:</b>No podr&aacute; modificar el numero de expediente si hay un error en el expediente, mas adelante tendr&aacute; que excluir este radicado del expediente y si es el caso solicitar la anulaci&oacute;n del mismo. Ademas debe tener en cuenta que apenas coloca un nombre de expediente, en Archivo crean una carpeta f&iacute;sica en el cual empezaran a incluir los documentos pertenecientes al mismo. </strong>
		  </div></TD>
	</tr>
  </table>
<?	
}
?>
<table border=0 width=70% align="center" class="borde_tab">
	<tr align="center">
	<td width="33%" height="25" class="listado2" align="center">
	<center>
	<?
  if($tsub and $codserie and !$Actualizar && $usuaDocExp != "" && $usuaDocExp != 0 )
	{
		if(!$tipificarExpediente)
		{
			?>
			<input name="tipificarExpediente" type=submit class="botones_funcion" value=" Tipificar Expediente ">
			<?
			}
			else
			{
			?>
			<input name="Actualizar" type=submit class="botones_funcion" value=" Confirmacion Tipificacion de Expediente ">
			<?
		}
	}
	?>
	</center></TD>
	<td width="33%" class="listado2" height="25">
	<center><input name="cerrar" type="button" class="botones_funcion" id="envia22" onClick="opener.regresar(); window.close();" value=" Cerrar "></center></TD>
	</tr>
</table><script>
function borrarArchivo(anexo,linkarch){
	if (confirm('Esta seguro de borrar este Registro ?'))
	{
		nombreventana="ventanaBorrarR1";
		url="tipificar_documentos_transacciones.php?borrar=1&usua=<?=$krd?>&codusua=<?=$codusua?>&coddepe=<?=$coddepe?>&nurad=<?=$nurad?>&codiTRDEli="+anexo+"&linkarchivo="+linkarch;
		window.open(url,nombreventana,'height=250,width=300');
	}
return;
}
function procModificar()
{
if (document.TipoDocu.tdoc.value != 0 &&  document.TipoDocu.codserie.value != 0 &&  document.TipoDocu.tsub.value != 0)
  {
  <?php
      $sql = "SELECT RADI_NUME_RADI
					FROM SGD_RDF_RETDOCF 
					WHERE RADI_NUME_RADI = '$nurad'
				    AND  DEPE_CODI =  '$coddepe'";
		$rs=$db->conn->query($sql);
		$radiNumero = $rs->fields["RADI_NUME_RADI"];
		if ($radiNumero !='') {
			?>
			if (confirm('Esta Seguro de Modificar el Registro de su Dependencia ?'))
				{
					nombreventana="ventanaModiR1";
					url="tipificar_documentos_transacciones.php?modificar=1&usua=<?=$krd?>&codusua=<?=$codusua?>&tdoc=<?=$tdoc?>&tsub=<?=$tsub?>&codserie=<?=$codserie?>&coddepe=<?=$coddepe?>&nurad=<?=$nurad?>$codProc<?$codProc?>";
					window.open(url,nombreventana,'height=200,width=300');
				}
			<?php
	 		}else
			{
			?>
			alert("No existe Registro para Modificar ");
			<?php
			}
       ?>
     }
   else
   {
    alert("Campos obligatorios ");
   }
return;
}

</script>
</form>
</span>
<p>
<?=$mensaje_err?>
</p>
</span>
</body>
</html>
