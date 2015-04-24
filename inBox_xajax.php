<?php
	// Busca si el usuario actual tiene novedades de documentos
	function updateInBox($usua_doc){			
		$xres=new xajaxResponse();
		$ruta_raiz = ".";
		include_once "$ruta_raiz/include/db/ConnectionHandler.php";
		$db = new ConnectionHandler("$ruta_raiz");
		$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		switch($db->driver){
		case 'oci8':
		$query="SELECT * FROM SGD_NOVEDAD_USUARIO WHERE USUA_DOC='$usua_doc'";
		break;
		case 'postgres':
		$campo ='"USUA_DOC"';
		$query="SELECT * FROM SGD_NOVEDAD_USUARIO WHERE $campo='$usua_doc'";
		break;
		}
		$rs=$db->query($query);
		//var_dump($query);
		while(!$rs->EOF){
			$xres->addScript("var lf=screen.width-380; var tp=screen.height-200; window.open('alert.php', 'ORFEO :: Bandeja de Entrada','width=460, height=200, status=0, toolbar=0, resizable=0, scrollbars=1, location=0, left='+lf+',top='+tp);");
			$rs->moveNext();
		}	
		$xres->addAssign("folders","innerHTML", ob_get_clean());	
		return utf8_encode($xres->getXML());
		
	}

	// Refresca el letrero que muestra las cantidades de documentos de cada carpeta.
	function updateFolders($krd){			
		$xres=new xajaxResponse();
		$ruta_raiz = ".";
		include_once "$ruta_raiz/include/db/ConnectionHandler.php";
		$db = new ConnectionHandler("$ruta_raiz");
		$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
				
		//Realiza la consulta del usuarios y de una vez cruza con la tabla dependencia
 		$isql = "select a.*, b.depe_nomb, b.depe_codi from usuario a,dependencia b
		           where a.depe_codi=b.depe_codi
		           AND USUA_LOGIN ='$krd' ";
		    
		$rs = $db->query($isql);
		//var_dump($isql);
		// Valida Longin y contraseÑA encriptada con funcion md5()
 		if(!$rs->EOF){		
			$codusuario =$rs->fields["USUA_CODI"];
			$usua_doc = $rs->fields["USUA_DOC"];
			$dependencianomb=$rs->fields["DEPE_NOMB"];
			$dependencia=$rs->fields["DEPE_CODI"];
			$fechah = date("dmy") . "_" . time("hms");
			$contraxx=$rs->fields["USUA_PASW"];
			$nivel=$rs->fields["CODI_NIVEL"];
			$iusuario = " and us_usuario='$krd'";
			$perrad = $rs->fields["PERM_RADI"];
 		}

	$isql ="select CARP_CODI,CARP_DESC from carpeta order by carp_codi ";
	$rs = $db->query($isql);
	$addadm = "";
	ob_start();
		?>
		<table border="0" cellpadding="0" cellspacing="0" width="160">
		  <tr>
		   	<td><img src="imagenes/spacer.gif" width="10" height="1" border="0" alt=""></td>
		   	<td><img src="imagenes/spacer.gif" width="150" height="1" border="0" alt=""></td>
		  	<td><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""></td>
		  </tr>		
<tr>
<td colspan="2"><img name="menu_r3_c1" src="imagenes/menu_r3_c1.gif" width="148" height="31" border="0" alt='Presione para actualizar las carpetas.' width="148" height="31" border="0" ></td>
<td><img src="imagenes/spacer.gif" width="1" height="25" border="0" alt=""></td>
</tr>
			<tr>
   <td>&nbsp;</td>
   <td valign="top"><table width="150" border="0" cellpadding="0" cellspacing="0" bgcolor="c0ccca">
			<tr>
       <td valign="top"><table width="150"  border="0" cellpadding="0" cellspacing="3" bgcolor="#eaeef9">
			<?
		
			while(!$rs->EOF)
			{				
				if($data=="")
					$data = "NULL";
					$data = trim($rs->fields["CARP_DESC"]);
				$numdata = trim($rs->fields["CARP_CODI"]);
				if($numdata==11)
				{   // Se realiza la cuenta de radicados en Visto Bueno VoBo
					if($codusuario ==1)
					{
						$isql="select count(1) as CONTADOR from radicado
							where carp_per=0 and carp_codi=$numdata
							and  radi_depe_actu=$dependencia
							and radi_usua_actu=$codusuario
							";
						
					}
					else
					{
						$isql="select count(1) as CONTADOR from radicado
							where carp_per=0
								and carp_codi=$numdata
								and radi_depe_actu=$dependencia
								and radi_usu_ante='$krd'
								";
					}
					$addadm = "&adm=1";
					
				}
			else
				{
				$isql="select count(1) as CONTADOR from radicado
							where carp_per=0 and carp_codi=$numdata
								and  radi_depe_actu=$dependencia
								and radi_usua_actu=$codusuario  ";
					$addadm = "&adm=0";
				}
			if($carpeta==$numdata)
			{
			$imagen="folder_open.gif";
			}
			else
			{
			$imagen="folder_cerrado.gif";
			}

			$flag = 0;
		
			$rs1 = $db->query($isql);
			//		ora_parse($cursor1,$isql) or $flag==1;
			$numerot = $rs1->fields["CONTADOR"];
			if ($flag==1)
				//if ($numdata == 0 ){$numdata=800;}
		
			?>
		
		
			<tr  valign="middle">
				<td width="25"><img src="imagenes/menu.gif" width="15" height="18" alt='<?=$data ?> ' title='<?=$data ?>'  name="plus<?=$i?>"></td>
				<td width="125"><a onclick="cambioMenu(<?=$i?>);" href='cuerpo.php?<?=$phpsession?>&krd=<?=$krd?>&adodb_next_page=1&fechah=<?php echo "$fechah&nomcarpeta=$data&carpeta=$numdata&tipo_carpt=0&adodb_next_page=1"; ?>' class="menu_princ" target="mainFrame" alt='Seleccione una Carpeta'>
				<? echo "$data($numerot)";?>
				</a> 
				</td>
			</tr>
		
		
		<?
			$i++;
			$rs->MoveNext();
			}
			?>
		<?
			/**
			  * PARA ARCHIVOS AGENDADOS NO VENCIDOS
			  *  (Por. SIXTO 20040302)
			*/
			$sqlFechaHoy=$db->conn->DBTimeStamp(time());
			$sqlAgendado=" and (agen.SGD_AGEN_FECHPLAZO >= ".$sqlFechaHoy.")";
			$isql="select count(1) as CONTADOR from SGD_AGEN_AGENDADOS agen
							where  usua_doc=$usua_doc
								and agen.SGD_AGEN_ACTIVO=1
								$sqlAgendado
				";
			$rs=$db->query($isql);
		
		$num_exp = $rs->fields["CONTADOR"];
		$data="Agendados no vencidos";
		?>
		
			<tr  valign="middle">
				<td width="25"><img src="imagenes/menu.gif" width="15" height="18" alt='<?=$data ?> ' title='<?=$data ?>'  name="plus<?=$i?>"></td>
				<td width="125"><a onclick="cambioMenu(<?=$i?>);" href='cuerpoAgenda.php?<?=$phpsession?>&agendado=1&krd=<?=$krd?>&fechah=<?php echo "$fechah&nomcarpeta=$data&tipo_carpt=0"; ?>'
							class="menu_princ" target="mainFrame" alt='Seleccione una Carpeta'>
				<? echo "Agendado($num_exp)";?>
				</a> </td>
			</tr>

			<?
		/**
		* PARA ARCHIVOS AGENDADOS  VENCIDOS
		*  (Por. SIXTO 20040302)
		*/
			$sqlAgendado=" and (agen.SGD_AGEN_FECHPLAZO <= ".$sqlFechaHoy.")";
			$isql="select count(1) as CONTADOR from SGD_AGEN_AGENDADOS agen
							where  usua_doc=$usua_doc
								and agen.SGD_AGEN_ACTIVO=1
								$sqlAgendado
				";

			$rs=$db->query($isql);
			$num_exp = $rs->fields["CONTADOR"];
			$data="Agendados vencidos";
			$i++;
		?>
				<tr  valign="middle">
				<td width="25"><img src="imagenes/menu.gif" width="15" height="18" alt='<?=$data ?> ' title='<?=$data ?>' name="plus<?=$i?>"></td>
				<td width="125"><a onclick="cambioMenu(<?=$i?>);" href='cuerpoAgenda.php?<?=$phpsession?>&agendado=2&krd=<?=$krd?>&fechah=<?php echo "$fechah&nomcarpeta=$data&&tipo_carpt=0&adodb_next_page=1"; ?>' class="menu_princ" target="mainFrame" alt='Seleccione una Carpeta'>
				<? echo "Agendado Vencido(<font color='#990000'>$num_exp</font>)";?>
				</a> </td>
				</tr>
			<?
			// Coloca el mensaje de Informados y cuenta cuantos registros hay en informados
			$isql="select count(1) as CONTADOR from informados c, usuario d  where c.depe_codi=$dependencia and c.usua_codi=$codusuario and d.usua_doc = c.info_codi";
			if($carpeta==$numdata and $tipo_carp=0)
			{
			$imagen="folder_open.gif";
			}
			else
			{
				$imagen="folder_cerrado.gif";
			}
			$rs1=$db->query($isql);
			$numerot = $rs1->fields["CONTADOR"];
			$i++;
			$data="Documentos De Informacion";
			?>

			<tr  valign="middle">
				<td width="25"><img src="imagenes/menu.gif" width="15" height="18" alt='<?=$data ?> ' title='<?=$data ?>' name="plus<?=$i?>"></td>
				<td width="125"><a onclick="cambioMenu(<?=$i?>);" href='cuerpoinf.php?<?=$phpsession?>&krd=<?=$krd?>&<?= "mostrar_opc_envio=1&orderNo=2&fechaf=$fechah&carpeta=8&nomcarpeta=Informados&orderTipo=desc&adodb_next_page=1"; ?>' class="menu_princ" target="mainFrame" alt='Documentos De Informacion' title="Documentos De Informacion">
				<? echo "Informados($numerot)";  $i++;?>
				</a> </td>
				</tr>
		<!-- aqui viene transacciones -->
		<? $data = "Ultimas Transacciones del Usuario"; ?>
			<tr  valign="middle">
				<td width="25"><img src="imagenes/menu.gif" width="15" height="18" alt='<?=$data?> ' title='<?=$data?>' name="plus<?=$i?>"></td>
				<td width="125"><a onclick="cambioMenu(<?=$i?>);" href='cuerpoTx.php?<?=$phpsession?>&krd=<?=$krd?>&fechah=<?php echo "$fechah&nomcarpeta=$data&tipo_carpt=0";?>'
							class="menu_princ" target="mainFrame"
							alt="Transaccines del Usuario">
							Transacciones
				</a> </td>
			</tr>
		<!-- -->
		<tr  valign="middle">
		<?  $data="Despliegue de Carpetas Personales";
		?>
			<td width="25"><img src="./imagenes/menu.gif" width="15" height="18" alt='<?=$data ?> ' title='<?=$data ?>' name="plus<?=$i?>">

			</td>
				<td width="125"><a onclick="cambioMenu(<?=$i?>);verPersonales(<?=$i?>);" href='#marcaPersonales";' class="menu_princ"  alt='Despliegue de Carpetas Personales' title="Despliegue de Carpetas Personales" name="marcaPersonales">
				<? echo "PERSONALES";?>
				</a> </td>
			</tr>
       </table>
		
	<?php 		
		$xres->addAssign("folders","innerHTML", ob_get_clean());
		return utf8_encode($xres->getXML());
	}
?>
