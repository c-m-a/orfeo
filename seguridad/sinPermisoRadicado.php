<html>
<head>
<title>Tipificar Expediente</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
<script>

function regresar(){   	
	document.TipoDocu.submit();
}
</script><style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<?

?>

<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
<form method="post" action="radicado.php?krd=<?=$krd?>&numRad=<?=$numRad?>" name="TipoDocu">
<P></P>
<table border=0 width=70% align="center" class="borde_tab" cellspacing="0">
	<tr align="center" class="titulos2">
		<td height="15" class="titulos2">!! SEGURIDAD !!</td>
		</tr>
</table> 
<table width="70%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
<tr >
<td width="38%" class=listado5 >
   <center><p>NO TIENE PERMISOS PARA ACCEDER AL RADICADO No. <?=$numRad?>,<br>
   Este Radicado esta marcado como confidencial.<p></p>
</td>
</tr>
<tr>
<td class=listado5 colspan="2" align="center">
</td>
</tr>
	<tr>
		<td class="titulos5" colspan="2" ><center>&nbsp;<?=$descTipoExpediente?> - <?=$expDesc?></center></td>
	</tr>
</table>
<br>
<br>
</form>
</span>
<p>
</p>
</span>
</body>
</html>
