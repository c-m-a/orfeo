<?
	$ruta_raiz = "../..";
	session_start();
	if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";	
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$db = new ConnectionHandler("$ruta_raiz");	
	$db->conn->debug = true;
	error_reporting(0);
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$sqlFechaHoy=$db->conn->DBTimeStamp(time());		
	if ($editar==1)
		{
		$isql = "SELECT SGD_TRAD_DESCR, DEPENDENCIA_NOMBRE_REFERENCIA as nombre FROM SGD_TRAD_TIPORAD ORDER BY SGD_TRAD_CODIGO ASC";
		$rs1 = $db->query($isql);	
		while(!$rs1->EOF)
			{
			$columna = $rs1->fields["SGD_TRAD_DESCR"];
			if ((isset($_POST[$columna])) && ($_POST[$columna]<>0))
				{
				$cadena  = $cadena . ", ". $rs1->fields["nombre"]." = ". $_POST[$columna];
				}
			$rs1->MoveNext();					
			}
		$isql = "UPDATE DEPENDENCIA SET DEPE_CODI = ". $coddependencia . ", DEPE_NOMB = '" . $nombredependencia . "',";
		$isql = $isql . " DEPENDENCIA_ESTADO = " . $estado.", DPTO_CODI = " . $departamento.", MUNI_CODI = " . $municipio;

		if ($direcciondependencia <> "")
		{
			$isql = $isql .", DEP_DIRECCION = '". $direcciondependencia . "'";
		}

		if ($dir_padre <> 0)
		{
			$isql = $isql . ", DEPE_CODI_PADRE = ". $dir_padre;
		}
		if ($territorial <> 0)
		{
			$isql = $isql . ", DEPE_CODI_TERRITORIAL = ".$territorial;
		}
		
		$isql = $isql . $cadena . " WHERE DEPE_CODI = ".$codigo;
		$isql1 = "select * FROM DEPENDENCIA WHERE DEPE_CODI = ".$codigo;
		$rs=$db->query($isql1);
		}
	else
		{
		$isql2 = "INSERT INTO DEPENDENCIA (DEPE_CODI, DEPE_NOMB, DPTO_CODI, MUNI_CODI, DEP_DIRECCION ";
		$valores = " VALUES ($coddependencia, '".$nombredependencia."', $departamento, $municipio, '".$direcciondependencia."'";
		$isql = "SELECT SGD_TRAD_DESCR, DEPENDENCIA_NOMBRE_REFERENCIA as nombre FROM SGD_TRAD_TIPORAD ORDER BY SGD_TRAD_CODIGO ASC";
		$rs1 = $db->query($isql);	
		if ($dir_padre <> 0)
			{
			$isql2 = $isql2 . ", DEPE_CODI_PADRE" . " ";
			$isql2 = $isql2 . ", $dir_padre" . " ";			
			}
		if ($territorial <> 0)
			{
			$isql2 = $isql2 . ", DEPE_CODI_TERRITORIAL" . " ";
			$isql2 = $isql2 . ", $territorial" . " ";			
			}
			
		while(!$rs1->EOF)
			{
			$columna = $rs1->fields["SGD_TRAD_DESCR"];
			if ((isset($_POST[$columna])) && ($_POST[$columna]<>0))
				{
				$isql2 = $isql2 . ", $columna ";
				$valores = $valores . ", " . $_POST[$columna] . " ";
				}
			$rs1->MoveNext();					
			}
		$isql2 = $isql2 . ", DEPENDENCIA_ESTADO)";
		$valores = $valores . ", $estado)";
		$isql = $isql2 . $valores;		
		$isql1 = "select * FROM DEPENDENCIA WHERE DEPE_CODI = ".$coddependencia;
		$rs=$db->query($isql1);		
		}
?>	 
<html>
<head>
<title></title>
</head>
<body>
<?
		if ($db->conn->Execute($isql) === false)
			{
			echo "Existe un error en los datos diligenciados";
			}
		else
			{
			if($editar==1)
				{
				$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 36, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}
			else
				{
				$isql1 = "select * FROM DEPENDENCIA WHERE DEPE_CODI = ".$coddependencia;
				$rs1=$db->query($isql1);			
			
				if ($rs->fields["DEPE_CODI"]<>$rs1->fields["DEPE_CODI"])
					{
					$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 37, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}			

			if ($rs->fields["DEPE_NOMB"]<>$rs1->fields["DEPE_NOM"])
				{
				$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 38, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}			

			if ($rs->fields["DEPENDENCIA_ESTADO"]<>$rs1->fields["DEPENDENCIA_ESTADO"])
				{
				$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 39, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}			
				
			if ($rs->fields["DEP_DIRECCION"]<>$rs1->fields["DEP_DIRECCION"])
				{
				$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 44, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}			

			if ($rs->fields["DPTO_CODI"]<>$rs1->fields["DPTO_CODI"])
				{
				$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 40, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}						
				
			if ($rs->fields["MUNI_CODI"]<>$rs1->fields["MUNI_CODI"])
				{
				$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 40, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}						

			if ($rs->fields["MUNI_CODI"]<>$rs1->fields["MUNI_CODI"])
				{
				$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 41, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}						

			if ($rs->fields["DEPE_CODI_PADRE"]<>$rs1->fields["DEPE_CODI_PADRE"])
				{
				$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 43, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}						

			if ($rs->fields["DEPE_CODI_TERRITORIAL"]<>$rs1->fields["DEPE_CODI_TERRITORIAL"])
				{
				$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", 44, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}						

			$isql = "SELECT SGD_TRAD_DESCR, DEPENDENCIA_NOMBRE_REFERENCIA as nombre FROM SGD_TRAD_TIPORAD ORDER BY SGD_TRAD_CODIGO ASC";
			$rs2 = $db->query($isql);
			$contador=45;
			while(!$rs2->EOF)
				{
					$columna = $rs2->fields["SGD_TRAD_DESCR"];
					if (($rs->fields[$columna] == "") && ($rs1->fields[$columna] > 0))
						{
						$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .", $contador, ".$sqlFechaHoy.")";
						$db->conn->Execute($isql);			
						}						
					else if (($rs->fields[$columna] <> "") && ($rs1->fields[$columna] == ""))
						{
						$isql = "INSERT INTO SGD_ADMIN_DEPE_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, DEPENDENCIA_MODIFICADA, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$coddependencia .",".$contador + 1 .", $sqlFechaHoy)";
						$db->conn->Execute($isql);			
						}
					$contador = $contador + 2;
					$rs2->MoveNext();					
				}
			}
?>			
<table width="30%" border="1" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" align="center">
  <tr>
    <td><div align="center"><strong>Administraci&oacute;n de Dependencias</strong></div></td>
  </tr>
  <form name="login" action="admin_depe_dependencias.php" method="post">  
  <tr>
    <td align="left">La Dependencia <?=$rs1->fields["DEPE_NOMB"]?> ha sido modificado con &Eacute;xito</td>
  </tr>
  <tr>
    <td align="left"><div align="center">
      <input type="submit" name="Submit" value="Aceptar">
      <input name="PHPSESSID" type="hidden" value='<?=session_id()?>'> 		  
      <input name="krd" type="hidden" value='<?=$krd?>'>	  
    </div></td>
  </tr>  
</table>
<?
	}
?>
</body>
</html>
