<html>
<head>
<title>.:: ORFEO, Consultas::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="../imagenes/arpa.gif">
<script language="javascript" src="./js/funcion.js"></script>
</head>
<body valign="center">
<br><br>
<form action="respuesta.php" method="post" name="form33" onSubmit="return validar_tipodoc(this);">
<table align="center" width="530" height="500" border="0" background="../imagenes/index_web_login.jpg">
<tr align="center" >
	<td height="15%" align="right"><font color="white" size="3" face="Verdana" class="consulta" >Consulta Web Estado de Documentos</font></td>
</tr>
<tr align="center">
	<td height="65%" valign="top"><br><br><br><br><br><br><br><br>
		<table width="60%" border="0" align="center" cellpadding="0" cellspacing="5">
		<tr>
			<td class="consulta2" align="center">N&uacute;mero de Radicado </td>
			<td width="11%" rowspan="2" align="center"><img src="../imagenes/tickDnp.jpg" alt="ticket" width="179" height="68" longdesc="Imagen del numero de radicado"></td>
		</tr>
		<tr align="left">
			<td width="89%" align="left" valign="top">
				<input name="tpradi" id="tpradi" type="text"  value="<!--{$rad}-->" class="tex_area" size="25" maxlength="14"><br>
				<span class="titulosError2"><!--{$radicado}--></span>
			</td>
		  </tr>
		<tr>
			<td colspan="2" height="35" align="left"> &nbsp;&nbsp;&nbsp;<input name="Submit" type="submit" class="botones" value="Ingresar">			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td height="20%" align="center">
		<font face="Arial Narrow" style="font-weight: bold;color:white;" size="2">Departamento Nacional de Planeaci&oacute;n</font><br>
		<font face="Arial Narrow" style="color:white;" size="2">Rep&uacute;blica de Colombia</font>
	</td>
</tr>
</table>
</form>
</body>
</html>