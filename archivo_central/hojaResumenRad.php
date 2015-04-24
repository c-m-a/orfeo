<?php
error_reporting(7);
$verradicado = $verrad;
$krdOld = $krd;
$menu_ver_tmpOld = $menu_ver_tmp;
$menu_ver_Old = $menu_ver;
session_start();
if(!$krd) $krd = $krdOld;
$ruta_raiz = "..";

if(!$_SESSION['dependencia'])	include "$ruta_raiz/rec_session.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";	
if($verradicado) 
	$verrad= $verradicado; 
if(!$ruta_raiz) 
	$ruta_raiz=".";
$numrad = $verrad;
error_reporting(7);
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(3);
//$db->conn->debug = true;
include "$ruta_raiz/ver_datosrad.php";
?>
<html><head><title>.: ORFEO - DATOS DEL RADICADO GENERADO :.</title>
</head>
<body bgcolor="#FFFFFF" topmargin="0">
<FORM ACTION='hojaResumenRad.php?krd=<?=$krd?>&verrad=<?=$verrad?>&ent=<?=$ent?>&<?=session_name()?>=<?=session_id()?>' METHOD=POST>
<?
$fechah=date("dmy_h_m_s") . " ". time("h_m_s");
$check=1;
$numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
if($krd)
{
	$isql = "select * From usuario where USUA_LOGIN ='$krd' and USUA_SESION='". substr(session_id(),0,29)."' ";
	$rs = $db->query($isql);
if (trim($rs->fields["USUA_LOGIN"])==trim($krd))
{
$nurad = $verrad;
include "$ruta_raiz/include/barcode/index.php";
$inf1= '
<TABLE BORDER="0" >
<TR >
<TD WIDTH="70" rowspan=3>
<img src="./escudoColombia.png" WIDTH=45 HEIGHT=45 >
-
</TD>
<TD WIDTH="380">';
$inf1 .= "<b>".$db->entidad_largo."</b>
</TD>
<TD WIDTH='360'>
<img src='".$file.".png' WIDTH=250 HEIGHT=50 >
</TD>
</TR><TR>
<TD WIDTH=70>-</TD>
<TD WIDTH=640>
<b>RADICADO No $verrad</b>
</TD>
</TR><TR>
<TD WIDTH=70>-</TD>
<TD WIDTH=640>
Dependencia rad. $depe_nomb ($depe_municipio)
</TD>
</TR>
<TR>
<TD WIDTH=70>-</TD>
<TD WIDTH=640>
Fecha de Generacion ".date("Y-m-d h:i:s")." 
</TD>
</TR>
</TABLE>
";
include "$ruta_raiz/ver_datosgeo.php";
if(!trim($nombret_us1)) $nombret_us1 = "-.- ";
if(!trim($nombret_us2)) $nombret_us2 = "-.- ";
if(!trim($nombret_us3)) $nombret_us3 = "-.- ";
if(!trim($direccion_us1)) $direccion_us1 ="-.-";
if(!trim($direccion_us2)) $direccion_us2 ="-.-";
if(!trim($direccion_us3)) $direccion_us3 ="-.-";
	/** $tpdoc_nombreTRD = $rs->fields["SGD_TPR_DESCRIP"];
		$serie_grb    = $rs->fields["SGD_SRD_CODIGO"];
		$serie_nombre = $rs->fields["SGD_SRD_DESCRIP"];
		$subserie_grb = $rs->fields["SGD_SBRD_CODIGO"];
		$subserie_nombre = $rs->fields["SGD_SBRD_DESCRIP"]; **/
$inf .="
<TABLE BORDER=1>
<TR>
	<TD BGCOLOR='#CCCCCC' WIDTH='110'>FECHA DE RAD</TD>
	<TD WIDTH=200>
	$radi_fech_radi
	</TD>
	<TD BGCOLOR='#CCCCCC' WIDTH='80'>ASUNTO 
	</TD>
	<TD WIDTH=360> 
	$ra_asun
</TR>
<TR>
<TD BGCOLOR='#CCCCCC' WIDTH=110> 
".$tip3Nombre[1][$ent].".</TD>
<TD WIDTH=200> 
$nombret_us1
</td>
<td WIDTH=80 bgcolor='#CCCCCC'>DIRECCION</td>
<td  WIDTH=360> 
$direccion_us1
($dpto_nombre_us1 / $muni_nombre_us1)
</td>
</tr>
<TR>
<TD WIDTH='110' bgcolor='#CCCCCC'> 
".$tip3Nombre[2][$ent].".</td>
<TD WIDTH='200'> 
$nombret_us2
</TD>
<TD BGCOLOR='#CCCCCC' width='80' >
DIRECCION
</TD>
<TD WIDTH='360'> 
$direccion_us2
($dpto_nombre_us2 / $muni_nombre_us2)
</TD>
</tr>
<tr><TD WIDTH=110 bgcolor='#CCCCCC'>".$tip3Nombre[3][$ent].".</td>
<TD width='200'>$nombret_us3</td>
<TD bgcolor='#CCCCCC' width='80'>DIRECCION 
</td>
<TD  width='360'>
$direccion_us3 ($dpto_nombre_us3 / $muni_nombre_us3)
</TD>
</TR>
<TR>
<TD WIDTH='375' BGCOLOR='#CCCCCC' colspan=2><CENTER><B>Cta / Contrato</B></CENTER></TD>
<TD WIDTH='375' BGCOLOR='#CCCCCC' colspan=2><CENTER><B>SECTOR</B></CENTER></TD>
</TR>
<TR>
<TD  WIDTH='375' colspan=2>-$cuentai</TD>
<TD  WIDTH='375' colspan=2><CENTER><B>-$sector_nombre</B></CENTER></TD>
</TR>
<TR>
<TD BGCOLOR='#CCCCCC' WIDTH='500' colspan=2><CENTER><B>TRD</B></CENTER>
</TD>
<TD BGCOLOR='#CCCCCC' WIDTH='250' colspan=2><CENTER><B>CAUSAL</B></CENTER>
</TD>
</TD>
</TR>
<TR>
<TD WIDTH='500' colspan=2><CENTER>$serie_nombre / $subserie_nombre / $tpdoc_nombreTRD</CENTER>
</TD>
<TD WIDTH='250' colspan=2><CENTER>$causal_nombre / $dcausal_nombre</CENTER>
</TD>
</TR>
<TR>
<TD WIDTH='500' HEIGHT='150' colspan=3><CENTER>-</CENTER>
</TD>
<TD WIDTH='250' HEIGHT='150' colspan=3><CENTER>-</CENTER>
</TD>
</TR>
<TR><TD WIDTH='500'  colspan=3><CENTER>Firma Usuario</CENTER>
</TD>
<TD WIDTH='250'  colspan=3><CENTER>Firma Funcionario $db->entidad</CENTER>
</TD>
</TR>
</TABLE>";
}
else 
{
	echo "<center><b><span class='eerrores'>NO TIENE AUTORIZACION PARA INGRESAR</span><BR><span class='eerrores'>
	<a href='login.php' target=_parent>Por Favor intente validarse de nuevo. Presione aca!</span></a>";
}

define(FPDF_FONTPATH,'../fpdf/font/');
require("../fpdf/html_table.php");
error_reporting(7);
$espacio = "<table><tr><td>............................................................................................................................................................................................................................................................................................................................................................................</td></tr></table>";
//$pdf = new PDF("L","mm","A4");
$pdf = new PDF("P","mm","A4");
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->WriteHTML($inf1 . $inf.$espacio.$inf1 . $inf);
$arpdf_tmp = "../bodega/pdfs/planillas/envios/$krd"."_lis_IMP.pdf";
$pdf->Output($arpdf_tmp);

echo "<br>";
echo $inf1 . $inf;

?><br>
	<table border=0 width=80%><tr><td>
<?
echo "<center><a class=vinculos href='$arpdf_tmp?fechaf".date("dmYh").time("his")."'>Abrir Archivo Pdf</a></center></td><td>";
	if(!trim($radi_path) and !$subirImagen)
	{
	echo "<center><input type=submit name=subirImagen value='COLOCAR PDF COMO IMAGEN DEL RADICADO'></center>";
	}
  ?>
	</td></tr></table>
	<?
}
if($subirImagen and $verrad)
{
	$rutaNew = "/". substr($verrad,0,4)."/".substr($verrad,4,3)."/".$nurad.".pdf";
	exec ("cp $arpdf_tmp $ruta_raiz/bodega$rutaNew",$output,$returnS);
	$sql = "UPDATE RADICADO SET RADI_PATH='$rutaNew' where radi_nume_radi=$verrad";
	$rs = $db->query($sql);	
}
?>

</FORM>
</body>
</html>
