<?php
/** CONSULTA WEB A CIUDADANOS - VER HISTORICO
  *@autor JAIRO LOSADA - SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIATIOS - COLOMBIA
  *@version 3.2
  *@fecha 21/10/2005
  *@licencia GPL
  */
$ruta_raiz = "..";
$verradicado = $idRadicado;
$dependencia = 990;
$codusuario = 300;
$ent = substr($idRadicado,-1);
error_reporting(7);
$iTpRad = 10;
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);	 
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$llave = date("YmdH") . "$verrad";
$password =md5($llave);
if($cmp==$password)
{
	   require_once("$ruta_raiz/class_control/Transaccion.php");
		 require_once("$ruta_raiz/class_control/Dependencia.php");
		 require_once("$ruta_raiz/class_control/usuario.php");
	   $trans = new Transaccion($db);
	   $objDep = new Dependencia($db);
	   $objUs = new Usuario($db);
?> 
<html>
<head><TITLE>HISTORICO DE RADICADOS - SSPD - ORFEO</TITLE>
<link rel="stylesheet" href="./web.css">
</head>
<body>
<table width="98%" class="borde_tab" align="center">
  <tr>
    <td height="25" class="titulo1">FLUJO HISTORICO DEL DOCUMENTO CON NUMERO DE RADICADO <?=$verrad?></td>
  </tr>
</table>
<table  cellspacing=2 cellpadding=2  width="98%" class="borde_tab" align="center"  >
  <tr  class="titulo1" align="center">
    <td width=10% class="grisCCCCCC" height="24"><font face="Arial, Helvetica, sans-serif">
      DEPENDENCIA </font></td>
    <td  width=5% class="grisCCCCCC" height="24"><font face="Arial, Helvetica, sans-serif">
      FECHA </font></td>
     <td  width=15% class="grisCCCCCC" height="24"><font face="Arial, Helvetica, sans-serif">
      TRANSACCION </font></td>  
  </tr>
  <?
  $sqlFecha = $db->conn->SQLDate("d-m-Y H:i A","a.HIST_FECH");

	$isql = "select $sqlFecha HIST_FECH1
      , a.DEPE_CODI
			, a.USUA_CODI
			,a.RADI_NUME_RADI
			,a.HIST_OBSE 
			,a.USUA_CODI_DEST
			,a.USUA_DOC
			,a.HIST_OBSE
			,a.SGD_TTR_CODIGO
			from hist_eventos a
		 where 
			a.radi_nume_radi =$verrad
			order by hist_fech desc ";  

	$i=1;
	$rs = $db->query($isql);
	IF($rs)
	{
    while(!$rs->EOF)
	 {
		$usua_doc_dest = "";
		$usua_doc_hist = "";
		$usua_nomb_historico = "";
		$usua_destino = "";
		$numdata =  trim($rs->fields["CARP_CODI"]);
		if($data =="") $rs1->fields["USUA_NOMB"];
	   		$data = "NULL";
		$numerot = $rs->fields["NUM"];
		$usua_doc_hist = $rs->fields["USUA_DOC"];
		$usua_codi_dest = $rs->fields["USUA_CODI_DEST"];
		$usua_dest=intval(substr($usua_codi_dest,3,3));
		$depe_dest=intval(substr($usua_codi_dest,0,3));
		$usua_codi = $rs->fields["USUA_CODI"];
		$depe_codi = $rs->fields["DEPE_CODI"];
		$codTransac = $rs->fields["SGD_TTR_CODIGO"];
		$descTransaccion = $rs->fields["SGD_TTR_DESCRIP"];
    if(!$codTransac) $codTransac = "0";
		$trans->Transaccion_codigo($codTransac);
		$objUs->usuarioDocto($usua_doc_hist);
		$objDep->Dependencia_codigo($depe_codi);

		error_reporting(7);
		if($carpeta==$numdata)
			{
			$imagen="usuarios.gif";
			}
		else
			{
			$imagen="usuarios.gif";
			}
		if($i==1)
			{
		?>
  <tr class='listado2'> <?  
		    $i=1;
			}
			 ?>
    <td class="celdaGris" >
	<?=$objDep->getDepe_nomb()?></td>
    <td class="celdaGris">
	<?=$rs->fields["HIST_FECH1"]?>
 </td>
<td class="celdaGris"  >
  <?=$trans->getDescripcion()?>
</td>
  </tr>
  <?
	$rs->MoveNext();
  	}
}
  // Finaliza Historicos

}else
{
  echo "No tiene permisos para ejecutar la opcion requerida...";
}
	?>
</body>
</html>
