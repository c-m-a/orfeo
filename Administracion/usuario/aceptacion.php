<?
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
?>
<?
	$ruta_raiz = "../..";
	session_start();
	if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";	
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$db = new ConnectionHandler("$ruta_raiz");	
	//$db->conn->debug = true;
	error_reporting(0);
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	if ($login)
		{
		$sqlFechaHoy=$db->conn->DBTimeStamp(time());	
		$isql = "UPDATE USUARIO SET ";
		
		if (($entrada) && !($modificaciones))
			$isql = $isql." USUA_PRAD_TP2 = '1', ";
		if (($entrada) && ($modificaciones))
			$isql = $isql." USUA_PRAD_TP2 = '2', ";
			
		if ($masiva)
			$isql = $isql." USUA_MASIVA = 1, ";
		else
			$isql = $isql." USUA_MASIVA = 0, ";		
			
		if ($memorandos)
			$isql = $isql." USUA_PRAD_TP3 = 1, ";
		else
			$isql = $isql." USUA_PRAD_TP3 = 0, ";		
			
		if ($resoluciones)
			$isql = $isql." USUA_PRAD_TP5 = 1, ";
		else
			$isql = $isql." USUA_PRAD_TP5 = 0, ";		
			
		if (($memorandos) || ($resoluciones) || (($salida) && ($impresion))) 			
			$isql = $isql." USUA_PRAD_TP1 = 3, ";
		else if(($salida) && !($impresion))
			$isql = $isql." USUA_PRAD_TP1 = 1, ";			
		else if(!($salida) && ($impresion))
			$isql = $isql." USUA_PRAD_TP1 = 2, ";			


			
		if (($s_anulaciones) && !($anulaciones))
			$isql = $isql." SGD_PANU_CODI = 1, ";
		if (($anulaciones) && !($s_anulaciones))
			$isql = $isql." SGD_PANU_CODI = 2, ";
		if (($s_anulaciones) && ($anulaciones))
			$isql = $isql." SGD_PANU_CODI = 3, ";
			
		if ($adm_archivo)
			$isql = $isql." USUA_ADMIN_ARCHIVO = '1', ";
		else
			$isql = $isql." USUA_ADMIN_ARCHIVO = '0', ";		
			
		if ($dev_correo)
			$isql = $isql." USUA_PERM_DEV = '1', ";
		else
			$isql = $isql." USUA_PERM_DEV = '0', ";		
			
		if ($adm_sistema)
			$isql = $isql." USUA_ADMIN = '1', ";
		else			
			$isql = $isql." USUA_ADMIN = '0', ";		
			
		if ($usua_nuevo)
			$isql = $isql." USUA_NUEVO = '0', ";
		else
			$isql = $isql." USUA_NUEVO = '1', ";		

		if ($env_correo)
			$isql = $isql." ENVIO_CORREO = 1, ";
		else
			$isql = $isql." ENVIO_CORREO = 0, ";					
			
		if ($usua_activo)
			$isql = $isql." USUA_ESTA = '1', ";
		else
			$isql = $isql." USUA_ESTA = '0', ";		
		//Nivel de Seguridad	
	    $isql = $isql." CODI_NIVEL = $nivel ";
		$isql = $isql . " where USUA_LOGIN = '".$login."'";
		$isql1 = "select USUA_CODI, DEPE_CODI, USUA_ESTA, USUA_PRAD_TP2, USUA_ADMIN, USUA_ADMIN_ARCHIVO, USUA_NUEVO, CODI_NIVEL, USUA_PRAD_TP1, USUA_MASIVA, USUA_PERM_DEV, SGD_PANU_CODI, USUA_PRAD_TP3, USUA_PRAD_TP5 from USUARIO WHERE USUA_LOGIN = '".$login."'";
		$rs=$db->query($isql1);
		}
?>	 
<html>
<head>
<title></title>
</head>
<body style="background-color:#FFFFFF">
<?
		if ($db->conn->Execute($isql) === false)
			{
			echo "Existe un error en los datos diligenciados";
			}
		else
			{
			$isql1 = "select USUA_ESTA, PERM_RADI, USUA_ADMIN, USUA_ADMIN_ARCHIVO, USUA_NUEVO, CODI_NIVEL, PERM_RADI_SAL, USUA_MASIVA, USUA_PERM_DEV, SGD_PANU_CODI, PERM_RADI_INTERNA, PERM_RADI_RESOL from USUARIO WHERE USUA_LOGIN = '".$login."'";
			$rs1=$db->query($isql1);
			
			if ($rs->fields["USUA_ESTA"]<>$rs1->fields["USUA_ESTA"])
				{
				$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", ".$dependencia1 .", '".$cedula."', 9, ".$sqlFechaHoy.")";
				$db->conn->Execute($isql);			
				}
				
			if ($rs->fields["USUA_PRAD_TP2"]<>$rs1->fields["USUA_PRAD_TP2"])
				{
				if ($rs1->fields["USUA_PRAD_TP2"]==1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 10, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_PRAD_TP2"]==2)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 11, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}
				
			if ($rs->fields["USUA_ADMIN"]<>$rs1->fields["USUA_ADMIN"])
				{
				if ($rs1->fields["USUA_ADMIN"]==0)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 12, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_ADMIN"]==1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 13, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}

			if ($rs->fields["USUA_ADMIN_ARCHIVO"]<>$rs1->fields["USUA_ADMIN_ARCHIVO"])
				{
				if ($rs1->fields["USUA_ADMIN_ARCHIVO"]==0)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 14, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_ADMIN_ARCHIVO"]==1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 15, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}
				
			if ($rs->fields["USUA_NUEVO"]<>$rs1->fields["USUA_NUEVO"])
				{
				if ($rs1->fields["USUA_NUEVO"]==0)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 16, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_NUEVO"]==1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 17, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}

			if ($rs->fields["CODIGO_NIVEL"]<>$rs1->fields["CODIGO_NIVEL"])
				{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 18, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
				}

			if ($rs->fields["USUA_PRAD_TP1"]<>$rs1->fields["USUA_PRAD_TP1"])
				{
				if ($rs1->fields["USUA_PRAD_TP1"]== 1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 19, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_PRAD_TP1"]== 2)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 20, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_PRAD_TP1"]== 3)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 35, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}

			if ($rs->fields["USUA_MASIVA"]<>$rs1->fields["USUA_MASIVA"])
				{
				if ($rs1->fields["USUA_MASIVA"]== 0)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 21, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_MASIVA"]== 1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 22, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}
				
			if ($rs->fields["USUA_PERM_DEV"]<>$rs1->fields["USUA_PERM_DEV"])
				{
				if ($rs1->fields["USUA_PERM_DEV"]== 0)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 23, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_PERM_DEV"]== 1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 24, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}				
				
			if ($rs->fields["SGD_PANU_CODI"]<>$rs1->fields["SGD_PANU_CODI"])
				{
				if ($rs1->fields["SGD_PANU_CODI"]== 1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 25, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["SGD_PANU_CODI"]== 2)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 26, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["SGD_PANU_CODI"]== 3)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 27, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}			

			if ($rs->fields["USUA_PRAD_TP3"]<>$rs1->fields["USUA_PRAD_TP3"])
				{
				if ($rs1->fields["USUA_PRAD_TP3"]== 0)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 28, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_PRAD_TP3"]== 1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 29, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}									

			if ($rs->fields["USUA_PRAD_TP5"]<>$rs1->fields["USUA_PRAD_TP5"])
				{
				if ($rs1->fields["USUA_PRAD_TP5"]== 0)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 30, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["USUA_PRAD_TP5"]== 1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 31, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}				
				
			if ($rs->fields["ENVIO_CORREO"]<>$rs1->fields["ENVIO_CORREO"])
				{
				if ($rs1->fields["ENVIO_CORREO"]== 0)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 33, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				elseif ($rs1->fields["ENVIO_CORREO"]== 1)
					{
					$isql = "INSERT INTO SGD_ADMIN_USUA_HISTORICO (USUARIO_CODIGO_ADMINISTRADOR, DEPENDENCIA_CODIGO_ADMINISTRADOR, USUARIO_DOCUMENTO_ADMINISTRADOR, USUARIO_CODIGO_MODIFICADO, DEPENDENCIA_CODIGO_MODIFICADO, USUARIO_DOCUMENTO_MODIFICADO, ADMIN_OBSERVACION_CODIGO, ADMIN_FECHA_EVENTO) VALUES ($codusuario, $dependencia, '". $usua_doc."', ".$rs->fields["USUA_CODI"].", $dependencia, '".$cedula."', 34, ".$sqlFechaHoy.")";
					$db->conn->Execute($isql);			
					}
				}									
?>			
<table width="30%" border="1" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" align="center">
  <tr>
    <td><strong>Administraci&oacute;n de Usuarios y Perfiles</strong></td>
  </tr>
  <form name="login" action="admin_usu_usuarios.php" method="post">  
  <tr>
    <td align="left">El Usuario <?=$login?> ha sido modificado con &Eacute;xitotd>
  </tr>
  <tr>
    <td align="left"><div align="center">
      <input type="submit" name="Submit" value="Aceptar">
      <input name="PHPSESSID" type="hidden" value='<?=session_id()?>'> 		  
      <input name="krd" type="hidden" value='<?=$krd?>'>	  
    </div></td>
  </tr>  
</form>   
</table>
<?
			}
?>
</body>
</html>
