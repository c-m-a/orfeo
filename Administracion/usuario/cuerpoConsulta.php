<?php
	/*************************************************************************************/
	/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
	/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
	/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
	/* ===========================                                                       */
	/*                                                                                   */
	/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
	/* bajo los terminos de la licencia GNU General Public publicada por                 */
	/* la "Free Software Foundation"; Licencia version 2. 			             */
	/*                                                                                   */
	/* Copyright (c) 2005 por :	  	  	                                     */
	/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
	/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
	/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
	/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
	/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
	/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
	/* D.N.P. "Departamento Nacional de Planeación"                                      */
	/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
	/*                                                                                   */
	/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
	/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
	/*************************************************************************************/
	session_start();
	
  $ruta_raiz = "../..";

	if(!$dependencia) {
		include_once("../../rec_session.php");
	}	
	include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db=new ConnectionHandler("$ruta_raiz");
?>
<html>
<head>
	<link href="<?=$ruta_raiz;?>/estilos/orfeo.css" media="screen" rel="stylesheet" type="text/css" />
	<script language="javascript">
		var i;
		function addOpt(oCntrl,sTxt,sVal,sCnd)
		{
			if (sTxt.substr(0,sCnd.length).toUpperCase()==sCnd.toUpperCase())
			{
				var selOpcion=new Option(sTxt,sVal);
				eval(oCntrl.options[i++]=selOpcion);
			}
		}
		function BuscaNombre(oCntrl)
		{
			document.frmConsultaUsuarios.cedula.value='';
			var txtVal=document.frmConsultaUsuarios.nombre.value;
			while(oCntrl.length>0)oCntrl.options[0]=null;
			i=0;
			oCntrl.clear;
<?php
	$sql="select USUA_DOC,DEPE_CODI,USUA_NOMB from usuario order by USUA_NOMB";
	$rsDep=$db->conn->Execute($sql);
	while(!$rsDep->EOF)
	{
?>
			addOpt(oCntrl,"<?php echo eregi_replace("[\n|\r|\n\r]", '',$rsDep->fields['USUA_NOMB']).' ... '.$rsDep->fields['DEPE_CODI'];?>","<?php echo eregi_replace("[\n|\r|\n\r]", '',$rsDep->fields['USUA_DOC']);?>",txtVal);
<?php
		$rsDep->MoveNext();
	}
?>
		}
		function BuscaCedula(oCntrl)
		{
			document.frmConsultaUsuarios.nombre.value='';
			var txtVal=document.frmConsultaUsuarios.cedula.value;
			while(oCntrl.length>0)oCntrl.options[0]=null;
			i=0;
			oCntrl.clear;
<?php
	$sql="select USUA_DOC,DEPE_CODI,USUA_NOMB from usuario order by USUA_DOC,USUA_NOMB";
	$rsDep=$db->conn->Execute($sql);
	while(!$rsDep->EOF)
	{
?>
			addOpt(oCntrl,"<?php echo eregi_replace("[\n|\r|\n\r]", ' ',$rsDep->fields['USUA_DOC']).' ... '.eregi_replace("[\n|\r|\n\r]", '',$rsDep->fields['USUA_NOMB']);?>","<?php echo eregi_replace("[\n|\r|\n\r]", '',$rsDep->fields['USUA_DOC']);?>",txtVal);
<?php
		$rsDep->MoveNext();
	}
?>
		}
	</script>
</head>
<body bgcolor="#FFFFFF" onLoad="window_onload();">
	<form name="frmConsultaUsuarios" action="cuerpoConsulta.php" method="post">
		<table border="0" cellpadding="2" cellspacing="2" width="90%" class="borde_tab" align="center">
			<tr><th colspan="8" class="titulos4">Busqueda de Usuarios</th></tr>
			<tr>
				<td class="titulos2" width="60">Nombre: </td>
				<td width="60" class="listado2">
					<input type="text" name="nombre" size="16" maxlength="12" onKeyUp="BuscaNombre(document.frmConsultaUsuarios.USUA_DOC)" />
				</td>
				<td class="titulos2" width="60">Cedula: </td>
				<td width="60" class="listado2">
					<input type="text" name="cedula" size="16" maxlength="12" onKeyUp="BuscaCedula(document.frmConsultaUsuarios.USUA_DOC)" />
				</td>
				<td class="listado2"><select name="USUA_DOC"></select></td>
				<td class="listado2" width="80"><input class="botones" name="Submit" type="submit" value="Buscar" /></td>
			</tr>
		</table>
	</form>
<?php
	if($_POST['USUA_DOC'])
	{
		$sql="select USUA_NOMB,USUA_DOC,dependencia.DEPE_CODI,DEPE_NOMB,USUA_ESTA,USUA_LOGIN from usuario,dependencia WHERE 
		dependencia.DEPE_CODI=usuario.DEPE_CODI and USUA_DOC='".$_POST['USUA_DOC']."'";
		$rsDep=$db->conn->Execute($sql);
		if($rsDep->fields['USUA_ESTA']==1)
		{
			$estado="Activo";
		}
		else
		{
			$estado="Inactivo";
		}
?>
	<table border="0" cellpadding="2" cellspacing="2" width="90%" class="borde_tab" align="center">
		<tr>
			<td class="titulos2" width="160">Nombre:</td>
			<td class="listado2"><?php echo $rsDep->fields['USUA_NOMB'];?></td>
		</tr>
		<tr>
			<td class="titulos2" width="160">Cedula:</td>
			<td class="listado2"><?php echo $rsDep->fields['USUA_DOC'];?></td>
		</tr>
		<tr>
			<td class="titulos2" width="160">Usuario:</td>
			<td class="listado2"><?php echo $rsDep->fields['USUA_LOGIN'];?></td>
		</tr>
		<tr>
			<td class="titulos2" width="160">Dependencia:</td>
			<td class="listado2"><?php echo $rsDep->fields['DEPE_CODI']." ... ".$rsDep->fields['DEPE_NOMB'];?></td>
		</tr>
		<tr>
			<td class="titulos2" width="160">Estado:</td>
			<td class="listado2"><?php echo $estado;?></td>
		</tr>
	</table>
<?php
	}
?>
</body>
</html>
