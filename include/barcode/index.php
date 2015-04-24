<?php @ob_start();
$height="50";
$bgcolor="#FFFFFF";
$color="#333366";
$type="png";
$encode = "CODE39";
$fechah = date("YmdHms");
$height = "50";
$scale = "1.5";
$bdata = $nurad;
$file = "$ruta_raiz/bodega/tmp/$nurad"."_".$fechah."";
include("barcode.php");
?>
<!--
<table border=1 background="<?="$file".".png"?>" width=360 height=90 class="borde_tab">
<TR height=50>
	<TD>
	</TD>
</TR>
<tr><td class=listado1>Numero de Radicado <?=$nurad?>
</td></tr>
</table>
-->