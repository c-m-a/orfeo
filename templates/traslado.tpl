<html>
<head>
	<link rel="stylesheet" href="../../estilos/orfeo.css">
		<script language="javascript">
		var i;
		function addOpt(oCntrl,sTxt,sVal,sCnd) {
			if (sTxt.substr(0,sCnd.length).toUpperCase()==sCnd.toUpperCase()) {
				var selOpcion=new Option(sTxt,sVal);
				eval(oCntrl.options[i++]=selOpcion);
			}
		}

		function busNombre(oCntrl) {
			var txtVal = document.frmConUsuarios.nombre.value;
			
      while(oCntrl.length>0) 
        oCntrl.options[0]=null;
			i = 0;
			oCntrl.clear;
<?php
	// Selecciona los usuarios activos de la dependencia cargada
	$sqlUsu="select d.DEPE_NOMB,
                  u.DEPE_CODI,
                  u.USUA_DOC,
                  u.USUA_NOMB,
                  u.USUA_CODI,
                  u.USUA_LOGIN
            from dependencia d,
                  usuario u
            where d.DEPE_CODI = u.DEPE_CODI and
                  u.USUA_ESTA='1' order by u.USUA_NOMB";
	$resUsu=$db->conn->Execute($sqlUsu);
  
	while(!$resUsu->EOF) {
?>
			addOpt(oCntrl,"<?php echo eregi_replace("[\n|\r|\n\r]", '',$resUsu->fields['USUA_NOMB']).': '.eregi_replace("[\n|\r|\n\r]", '',$resUsu->fields['DEPE_NOMB']);?>","<?php echo $resUsu->fields['USUA_CODI']."--".eregi_replace("[\n|\r|\n\r]", '',$resUsu->fields['DEPE_CODI'])."--".eregi_replace("[\n|\r|\n\r]", '',$resUsu->fields['USUA_NOMB'])."--".eregi_replace("[\n|\r|\n\r]", '',$resUsu->fields['DEPE_NOMB'])."--".eregi_replace("[\n|\r|\n\r]", '',$resUsu->fields['USUA_LOGIN'])."--".eregi_replace("[\n|\r|\n\r]", '',$resUsu->fields['USUA_DOC']);?>",txtVal);
<?php
		$resUsu->MoveNext();
	}
?>
		}
	  function MAY(campo) {
			campo.value=campo.value.toUpperCase();
		}
  	
    function Deptos() {
      document.frmConUsuarios.nombre.value='';
      document.frmConUsuarios.USUA_DOC.value='';
      var ciudades=document.frmConUsuarios.depen;
      i = document.frmConUsuarios.depen.selectedIndex;
      var dropdownObjectPath=document.frmConUsuarios.fundoc;
      var municipio="fundoc";
      var depen=ciudades.options[ciudades.selectedIndex].value;
      Options(municipio,depen);
    }
	
	//función para validar la justificación del traslado
	function valida()
	{
		if(document.traslado.obs.value.length <= 10)
			{
				//alert('Las observaciones deben tener mas de 10 caracteres.');
				//return false;
			}
	}
		
	</script>
</head>

<body class="listado">
<span class="titulos4">TRASLADO DE USUARIOS</span>
<br><br>
<?
if(!isset($_POST['consulta']))
{
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="frmConUsuarios">
			<table align="center" border="0" cellpadding="0" cellspacing="1" class="mitabla" width="100%">
				<tr><td class="titulos4" colspan="3">Consulta de funcionarios para radicaci&oacute;n</td></tr>
				<tr>
					<td class="titulos2" width="150">Funcionario:</td>
					<td class="listado2">
						Nombre: <input class="tex_area" maxlength="20" name="nombre" onKeyUp="busNombre(document.frmConUsuarios.USUA_DOC);" size="20" type="text" />
						<select class="select" name="USUA_DOC"></select>
					</td>
					<td align="center" class="titulos2" rowspan="2" width="150"><input class="botones" name="accrad" type="submit" value="Continuar" /></td>
				</tr>
				
			</table>
			
<input type="hidden" name="consulta" value="consulta">			
		</form>
		<ul>
			<li class="textos">Seleccione el usuario que desea trasladar.</li>
		</ul>	
<?
}
if(($_POST['consulta']=='consulta') and ($_POST['accion']!='1')) {
$datos=split('--',$_POST['USUA_DOC']);
$s_dep=substr($datos[1],0,2);
$sql_dep_des="SELECT depe_codi,
                      depe_nomb
                FROM dependencia
                WHERE depe_estado = 1 ORDER BY 1";
$rs_dep_des=$db->conn->Execute($sql_dep_des);
?>
<span class="mitabla titulos4">
DATOS DEL USUARIO :
</span>
<br>
<span class="titulos2">
<?= strtoupper($datos[2])." : ".strtoupper($datos[3])." : ".$datos[1]?>
</span>
<br><br>
<span class="mitabla titulos4">
AREA DESTINO :
</span>
<form action="<?= $_SERVER['PHP_SELF']?>" method="post" name="traslado">
<select class="select" name="cod_dep_des">
	<?
		while(!$rs_dep_des->EOF) {
	?>
	<option value="<?= $rs_dep_des->fields['DEPE_CODI']?>"
	<?
	if(($_POST['accion']=='1') and ($rs_dep_des->fields['DEPE_CODI']==$_POST['cod_dep_des']))
		echo 'selected="selected"';
	?>
	><?=$rs_dep_des->fields['DEPE_CODI']."-".$rs_dep_des->fields['DEPE_NOMB']?></option>
	<?
		$rs_dep_des->MoveNext();
		}
	?>
</select>

<br><br>
<span class="mitabla titulos4">
OBSERVACIONES :
</span>
<br><br>
<textarea name="obs" cols="70" rows="3" class="tex_area"></textarea>
<br><br>
<input type="submit" value="Continuar" class="botones"
<?php
if($_POST['accion']=='1')
	echo 'disabled="disabled"';
?>
onClick="return valida();"
>
<input type="hidden" name="codusuario" value="<?= $datos[0]?>">
<input type="hidden" name="dependencia" value="<?= $datos[1]?>">
<input type="hidden" name="krd" value="<?= $datos[4]?>">
<input type="hidden" name="usua_doc" value="<?= $datos[5]?>">
<input type="hidden" name="accion" value="1">
<input type="hidden" name="consulta" value="consulta">	
</form>
		<ul>
			<li class="textos">Seleccione el &aacute;rea a la cual desea trasladar al usuario y pulse continuar.</li>
			<li class="textos">Ingrese la justificaci&oacute;n del traslado en el campo observaciones.</li>
			<!--li class="textos">Pulse el bot&oacute;n Continuar. M&iacute;nimo se deben escribir 10 caracteres.</li-->
		</ul>	

<?php
}
if($_POST['accion']=='1') {
//numero aleatorio 
$num = substr(rand(),0,4);
//trae el nuevo usua_codi para la dependencia destino
$sql_ncodi = "SELECT MAX(USUA_CODI) proximo FROM usuario_tmp WHERE depe_codi=".$_POST['cod_dep_des']; 
$rs_ncodi  = $db->conn->Execute($sql_ncodi);
$sql_ncodi2= "SELECT MAX(USUA_CODI) proximo FROM usuario WHERE depe_codi=".$_POST['cod_dep_des']; 
$rs_ncodi2 = $db->conn->Execute($sql_ncodi2);
//echo $sql_ncodi."<br>";
//echo $rs_ncodi->fields['PROXIMO'];
$COD_DEP_DES = $_POST['cod_dep_des']; 
$CODUSUARIO  = $_POST['codusuario'];
$DEPENDENCIA = $_POST['dependencia'];
$rsb = $db->conn->Execute("SELECT USUA_LOGIN,
                                  USUA_DOC
                            FROM USUARIO
                            WHERE usua_codi=".$CODUSUARIO." AND
                                  depe_codi=".$DEPENDENCIA);
$USUA_LOGIN = $rsb->fields['USUA_LOGIN'];
$USUA_DOC   = $rsb->fields['USUA_DOC'];
//crea copia del perfil actual en la tabla usuario_tmp
$sql_perfil_cc="INSERT INTO usuario_tmp
                        SELECT * FROM usuario
                        WHERE usua_codi=".$CODUSUARIO." AND
                              depe_codi=".$DEPENDENCIA;
$rs_perfil_cc = $db->conn->Execute($sql_perfil_cc);
//echo $sql_perfil_cc."<br>";
if($rs_ncodi2->fields['PROXIMO']!="")
  $usua_codi_n = $rs_ncodi2->fields['PROXIMO'] + $rs_ncodi->fields['PROXIMO'] + 1;
else
  $usua_codi_n = $rs_ncodi->fields['PROXIMO'] + 1;

//actualiza perfil con la nueva dependencia
$update_perfil="UPDATE usuario_tmp SET usua_codi=".$usua_codi_n.",depe_codi=".$COD_DEP_DES.", USUA_CODI_ANTE=".$CODUSUARIO.",DEPE_CODI_ANTE=".$DEPENDENCIA."
WHERE usua_codi=".$CODUSUARIO." AND depe_codi=".$DEPENDENCIA;
$rs_update_perfil=$db->conn->Execute($update_perfil);
//echo $update_perfil."<br>";
//inactivar el usuario actual
$sql_inactiva_usu="UPDATE usuario SET USUA_ESTA='0' WHERE usua_codi=".$CODUSUARIO." AND depe_codi=".$DEPENDENCIA;
$rs_inactiva_usu = $db->conn->Execute($sql_inactiva_usu);
//echo $sql_inactiva_usu."<br>";
//cambiar usua_login en anexos por usuario TMP
$update_anexos = "UPDATE anexos SET ANEX_CREADOR='TMP' WHERE ANEX_CREADOR='".$USUA_LOGIN."'";
$rs_update_anexo = $db->conn->Execute($update_anexos);
//actualiza tabla prestamos
$update_prestamos="UPDATE prestamo SET usua_login_actu='TMP' WHERE usua_login_actu='".$USUA_LOGIN."'";
$rs_update_prestamos = $db->conn->Execute($update_prestamos);
//echo $update_anexos."<br>";
//cambio login actual en usuarios
$update_login="UPDATE usuario SET usua_login='".$USUA_LOGIN.$num."' WHERE usua_login='".$USUA_LOGIN."'";
$rs_update_login = $db->conn->Execute($update_login);
//echo $update_login."<br>";
//inserta usuario nuevo
$ins_nuevo_usu="INSERT INTO usuario
SELECT * FROM usuario_tmp";
$rs_nuevo_usu = $db->conn->Execute($ins_nuevo_usu);
//echo $ins_nuevo_usu."<br>";
//cambiar usua_login en anexos por login antiguo + fecha
$update_anexos_old="UPDATE anexos SET ANEX_CREADOR='".$USUA_LOGIN."' WHERE ANEX_CREADOR='TMP'";
$rs_update_anexo_old = $db->conn->Execute($update_anexos_old);

//cambiar usua_login en prestamos por login antiguo
$update_prestamos_old = "UPDATE prestamo SET usua_login_actu='".$USUA_LOGIN."' WHERE usua_login_actu='TMP'";
$rs_update_prestamos_old = $db->conn->Execute($update_prestamos_old);
//echo $update_anexos_old."<br>";
//limpia la tabla temporal
$del_tmp = "DELETE FROM usuario_tmp WHERE 1=1";
$rs_tmp = $db->conn->Execute($del_tmp);
//echo $del_tmp."<br>";
//actualiza fecha de creacion usuario nuevo
$upd_fec="UPDATE usuario SET usua_fech_crea=SYSDATE WHERE depe_codi=".$COD_DEP_DES." AND usua_codi=".($rs_ncodi->fields['PROXIMO']+1);
$rs_fec=$db->conn->Execute($upd_fec);
//actualiza carpetas personales al usuario actual en la tabla carpeta_per
$upd_carpeta="UPDATE carpeta_per SET usua_codi=".($rs_ncodi->fields['PROXIMO']+1).", depe_codi=".$COD_DEP_DES." 
WHERE usua_codi=".$CODUSUARIO." AND depe_codi=".$DEPENDENCIA;
$rs_upd_carpeta = $db->conn->Execute($upd_carpeta);
//actualizacion informados
$upd_informados = "UPDATE informados SET usua_codi=".($rs_ncodi->fields['PROXIMO']+1).",depe_codi=".$COD_DEP_DES." WHERE usua_codi=".$CODUSUARIO." and depe_codi=".$DEPENDENCIA;
$rs_upd_informados = $db->conn->Execute($upd_informados);
//actualizacion agendados
$upd_agendados = "UPDATE sgd_agen_agendados SET depe_codi=".$COD_DEP_DES."
                    WHERE depe_codi=".$DEPENDENCIA." AND usua_doc='".$USUA_DOC."'";
$rs_upd_agendados = $db->conn->Execute($upd_agendados);
//radicados
$upd_radicados = "UPDATE radicado
                    SET radi_depe_actu=".$COD_DEP_DES.",
                    radi_usua_actu=".($rs_ncodi->fields['PROXIMO']+1)."
                    WHERE radi_depe_actu=".$DEPENDENCIA." AND radi_usua_actu=".$CODUSUARIO;

$rs_upd_radicados=$db->conn->Execute($upd_radicados);

//$upd_radicados="UPDATE radicado SET radi_depe_actu=".$COD_DEP_DES." WHERE radi_depe_actu=".$DEPENDENCIA." AND radi_usu_ante='".$USUA_LOGIN."'";
//$rs_upd_radicados=$db->conn->Execute($upd_radicados);

//registra cambio en historico usu_historico
$ins_hist="INSERT INTO sgd_ush_usuhistorico
              VALUES(1,500,'80064018',".$CODUSUARIO.",".$DEPENDENCIA.",'".$USUA_DOC."',3,SYSDATE,'".$USUA_LOGIN."','".$_POST['obs']."')";
$rs_hist=$db->conn->Execute($ins_hist);
?>
<span class="mitabla titulos4">
RESULTADOS DOCUMENTOS TRASLADADOS:
</span>
<br><br>
<?
//visualiza resultados
$sql_resultado="
SELECT DECODE(carp_per,0,'SYSTEMA',1,'PERSONAL') \"TIPO DE CARPETA\",
(CASE
WHEN (carp_per=0 AND carp_codi=0) THEN 'Entradas'
WHEN (carp_per=0 AND carp_codi=1) THEN 'Oficios'
WHEN (carp_per=0 AND carp_codi=3) THEN 'Memorandos'
WHEN (carp_per=0 AND carp_codi=5) THEN 'Resoluciones'
WHEN (carp_per=0 AND carp_codi=11) THEN 'Vistos buenos'
WHEN (carp_per=0 AND carp_codi=12) THEN 'Devueltos'
WHEN (carp_per=0 AND carp_codi=1002) THEN 'Agendados'
WHEN (carp_per=0 AND carp_codi=1001) THEN 'Informados'
ELSE 'Personales'
END
) DESCRIPCION
,count(*) RADICADOS
FROM radicado
WHERE radi_depe_actu=".$_POST['cod_dep_des']." AND radi_usua_actu=".($rs_ncodi->fields['PROXIMO']+1)."
GROUP BY (carp_per,carp_codi)
ORDER BY carp_per
";
		$pager = new ADODB_Pager($db,$sql_resultado,'adodb', true,$orderNo,$orderTipo);
		$pager->toRefLinks = $linkPagina;
		$pager->toRefVars = $encabezado;
		$pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkEnviar);
?>


		<ul>
			<li class="textos">En el cuadro superior se muestran los radicados de cada una de las bandejas que fueron trasladadas.</li>
			<li class="textos">En el cuadro inferior se muestra el resumen de las dependencias Origen y Destino con sus respectivos c&oacute;digos.</li>
		</ul>	

<table class="mitabla" align="center" border="0" cellpadding="0" cellspacing="1" width="100%">
			<tbody>
			<tr class="titulos2">
			<td colspan="5"><font color="#FF0000">TRASLADO EXITOSO</font></td>
			</tr>
			<tr>
				<td class="titulos2" >USUARIO</td>
				<td class="titulos2" >CODIGO ORIGEN</td>
				<td class="titulos2" >DEPENDENCIA ORIGEN</td>
				<td class="titulos2" >CODIGO DESTINO</td>
				<td class="titulos2" >DEPENDENCIA DESTINO</td>
			</tr>
			<tr class="listado">
				<td class="noleido"><?= $_POST['krd']?></td>
				<td class="noleido"><?= $_POST['codusuario']?></td>
				<td class="noleido"><?= $_POST['dependencia']?></td>
				<td class="noleido"><?= $usua_codi_n?></td>
				<td class="noleido"><?= $_POST['cod_dep_des']?></td>
			
			</tr>
			</tbody>
</table>
<?		
}
?>
</body>
</html>
