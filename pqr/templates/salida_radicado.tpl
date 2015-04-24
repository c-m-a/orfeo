<html>
<head>
	<meta name="generator" content="Dev-PHP 2.4.1">	
	<title>.:: ORFEO, Consultas::.</title>
	<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>

<body valign="center">
	<br>
	<br>
	<table width="530" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr bordercolor="#FFFFFF">
			<td height="9" colspan="2" class="radicado">
			<p>Su solicitud ha sido registrada con el siguiente n&uacute;mero de radicado,
			 con el cual podr&aacute; realizar sus consultas posteriormente.</p>
			</td>
		</tr>
		<tr>
			<td width="36%" class="numeroradicado"><span class=
				"color">N&uacute;mero de Radicado.</span><br>
				<span class="pqrsalida"><!--{$radicado}--></span><br><img src=
				"../../img/barras.PNG" alt="CodigoBarras" width="235" height="38"
				longdesc="Codigo de Barras generado con el No de radicado">
			</td>
		</tr>
		<tr>
			<td colspan="2" class="listado2">
			<center>
			<table width="100%">
				<tr>
					<td>
						<table width="100%" border="0" bordercolor="#000000">
							<tr>
								<td>
									<table width="95%" border="0" align="center" cellspacing="2">
										<tr>
											<td>
												<div align="left">
													<!--{$lugar}-->&nbsp;&nbsp;<!--{$fecha}-->&nbsp;<br>
													&nbsp;&nbsp;&nbsp;</div>
											</td>
										</tr>
										<tr>
											<td>
												<p>Se&ntilde;ores<br />Departamento Nacional de Planeaci&oacute;n<br />
												Calle 26 # 13 &ndash; 19<br />
												Tel: 381 50 00&nbsp;</p>
												<p>&nbsp;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p align="left">Ref: &nbsp;desde la P&aacute;gina
												Web del Departamento Nacional de Planeaci&oacute;n</p>
											</td>
										</tr>
										<tr>
											<td><br>
												<P><!--{$asunto}--></p>
											</td>
										</tr>
										<tr>
											<td><br />
												<p>Atentamente,</p>
												<p><!--{$nombre}--><br />
												Direcci&oacute;n: <!--{$direccion}--><br />
												Tel&eacute;fono: <!--{$telefono}--><br />
												Correo electr&oacute;nico: <!--{$correo}--></p>
												<br />
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<div align="center"><a href=<!--{$enlace}-->>
						<br>
						 Descargar esta informaci&oacute;n en un archivo PDF</a></div>
					</td>
				</tr>
				<tr>
					<td class="vinculoTipifAnex">
						<div align="center"><span><a href="../pqr/index.php"><br>
						 Regresar</a></span></div>
					</td>
				</tr>
				
								<tr>
					<td class="vinculoTipifAnex">
						Archivos Adjuntos :<!--{$archivosAdjuntos}-->
					</td>
				</tr>
			</table>
		</center>
		</td>
	</tr>
</table>
</body>
</html>

