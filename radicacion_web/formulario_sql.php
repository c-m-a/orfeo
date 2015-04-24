<?
session_start();
/**
  * Se añadio compatibilidad con variables globales en Off
  * @autor Jairo Losada 2009-05
  * @Fundacion CorreLibre.org
  * @licencia GNU/GPL V 3
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
//funcion que devuelve el usuario de la entidad
function usuxent($codigo,$nit,$db)
{
	$sql_uxe="select u.usua_codi,u.depe_codi,u.usua_doc from usuario u
			inner join sgd_empus_empusuario s on s.usua_login=u.USUA_LOGIN 
			and s.identificador_empresa=".$codigo;
	$rs_uxe=$db->conn->Execute($sql_uxe);
	if(($rs_uxe->RecordCount()) == 0)
		{
			$sql_asociativa="select codentidad from entidades_asociativa where nit='".$nit."'";
			$rs_asociativa=$db->conn->Execute($sql_asociativa);
			if(($rs_asociativa->RecordCount()) != 0)
						$res="<input type='hidden' name='usuario' value='1'><input type='hidden' name='dependencia' value='361'><input type='hidden' name='documento_destino' value='800201721'>";
			else
						$res="<input type='hidden' name='usuario' value='12'><input type='hidden' name='dependencia' value='210'><input type='hidden' name='documento_destino' value='22034243'>";
		}
	else
		{
		$res="<input type='hidden' name='usuario' value='".$rs_uxe->fields['USUA_CODI']."'><input type='hidden' name='dependencia' value='".$rs_uxe->fields['DEPE_CODI']."'><input type='hidden' name='documento_destino' value='".$rs_uxe->fields['USUA_DOC']."'>";
		}
return $res;
}



//departamento
$sql_depto="select distinct * from departamento order by dpto_nomb";
$rs_depto=$db->conn->Execute($sql_depto);
$depto="";
while (!$rs_depto->EOF)
{
	$depto.="<option value='".$rs_depto->fields['DPTO_CODI']."'>".$rs_depto->fields['DPTO_NOMB']."</option>";
	$rs_depto->MoveNext();
}
//municipio
if(isset($_GET['depto']))
{
$sql_muni="select distinct * from municipio where dpto_codi=".$_GET['depto']." order by muni_nomb";
//$db->conn->debug = true;
$rs_muni=$db->conn->Execute($sql_muni);
$muni="<select name='muni' class='field select medium' tabindex='19'>";
while (!$rs_muni->EOF)
{
	$muni.="<option value='".$rs_muni->fields['MUNI_CODI']."'>".$rs_muni->fields['MUNI_NOMB']."</option>";
	$rs_muni->MoveNext();
}
$muni.="</select>&nbsp;<font color='#FF0000'>*</font>";
}
//entidad
if(isset($_GET['nit']))
{
$sql_entidad="select NOMBRE_DE_LA_EMPRESA,SIGLA_DE_LA_EMPRESA,IDENTIFICADOR_EMPRESA,NIT_DE_LA_EMPRESA from bodega_empresas where NIT_DE_LA_EMPRESA LIKE '%".trim($_GET['nit'])."%'";
$rs_entidad=$db->conn->Execute($sql_entidad);
$entidad='<strong>
<font color="#FF0000">
';
if($rs_entidad->RecordCount() != 0)
{
$entidad.=$rs_entidad->fields['NOMBRE_DE_LA_EMPRESA']." - ".$rs_entidad->fields['SIGLA_DE_LA_EMPRESA'];
$entidad.='<input type="hidden" name="codigo_orfeo" value="'.$rs_entidad->fields['IDENTIFICADOR_EMPRESA'].'"></input><input type="hidden" name="sigla" value="'.$rs_entidad->fields['SIGLA_DE_LA_EMPRESA'].'"></input>';
$entidad.=usuxent($rs_entidad->fields['IDENTIFICADOR_EMPRESA'],$rs_entidad->fields['NIT_DE_LA_EMPRESA'],$db);
$valor=0;
}
else
{
$entidad.="EL NIT INGRESADO NO ESTA REGISTRADO EN NUESTRA BASE DE DATOS";
$entidad.='</font>, SI LO DESEA PUEDE HACER UNA <a href="#" onclick="window.open(\'busqueda.php\');">B&Uacute;SQUEDA AVANZADA</a> 
</strong>';
$valor=1;
}

$entidad.='<input type="hidden" name="valor_ent" value="'.$valor.'"></input>';
}
//tipo documental
/*
$sql_tipo="select sgd_tpr_codigo,sgd_tpr_descrip from sgd_tpr_tpdcumento where sgd_tpr_codigo in(43,317,572,318,316,456,42,57,307) order by sgd_tpr_descrip";
*/
//Modificacion 12-05-09
//solo tipo QUEJAS CONTRA SUPERVISADAS (42)
$sql_tipo="select sgd_tpr_codigo,sgd_tpr_descrip from sgd_tpr_tpdcumento where sgd_tpr_web=1 order by sgd_tpr_descrip";
$rs_tipo=$db->conn->Execute($sql_tipo);
$tipo="";
while (!$rs_tipo->EOF)
{
	$tipo.="<option value='".$rs_tipo->fields['SGD_TPR_CODIGO']."'>".$rs_tipo->fields['SGD_TPR_DESCRIP']."</option selected='selected'>";
	$rs_tipo->MoveNext();
}

$sql_tipo2="select sgd_tpr_codigo,sgd_tpr_descrip from sgd_tpr_tpdcumento where sgd_tpr_web>=1 order by sgd_tpr_descrip";
$rs_tipo2=$db->conn->Execute($sql_tipo2);
$tipo2="";
while (!$rs_tipo2->EOF)
{
	$tipo2.="<option value='".$rs_tipo2->fields['SGD_TPR_CODIGO']."'>".$rs_tipo2->fields['SGD_TPR_DESCRIP']."</option selected='selected'>";
	$rs_tipo2->MoveNext();
}
//radicado
if(isset($_GET['radicado']))
{
$sql_rad="select radi_nume_radi,radi_fech_radi,ra_asun from radicado where radi_nume_radi=".$_GET['radicado'];
$rs_rad=$db->conn->Execute($sql_rad);
$radicado='<strong>
<font color="#FF0000">';
if($rs_rad->RecordCount() != 0)
{
$radicado.=$rs_rad->fields['RADI_NUME_RADI']." - ".$rs_rad->fields['RADI_FECH_RADI']." - ".$rs_rad->fields['RA_ASUN'];
$valor=0;
}
else
{
$radicado.=" EL NUMERO DE RADICADO NO EXISTE ";
$valor=1;
}
$radicado.='</font>
</strong>';
$radicado.='<input type="hidden" name="valor_rad" value="'.$valor.'"></input>';
}
//busqueda avanzada
if(isset($_POST['busca']))
{
$sql_bodega="select NOMBRE_DE_LA_EMPRESA,NIT_DE_LA_EMPRESA from BODEGA_EMPRESAS where (NOMBRE_DE_LA_EMPRESA like '%".strtoupper($_POST['entidad'])."%' or SIGLA_DE_LA_EMPRESA like '%".strtoupper($_POST['entidad'])."%' or NIT_DE_LA_EMPRESA like '%".strtoupper($_POST['entidad'])."%') AND ESTADO_EMPRESA=1";
$rs_bodega=$db->conn->Execute($sql_bodega);
}
//funcion que trae el nombre del departamento
function nombre_depto($cod_depto,$db)
{
	$sql_depto2="select DPTO_NOMB from DEPARTAMENTO where DPTO_CODI=".$cod_depto;
	$rs_depto2=$db->conn->Execute($sql_depto2);
	$nom_depto2=$rs_depto2->fields['DPTO_NOMB'];
	return $nom_depto2;
}
//funcion que trae el nombre del municipio
function nombre_muni($cod_depto,$cod_muni,$db)
{
	$sql_muni="select MUNI_NOMB from MUNICIPIO where DPTO_CODI=".$cod_depto." AND MUNI_CODI=".$cod_muni;
	$rs_muni=$db->conn->Execute($sql_muni);
	$nom_muni=$rs_muni->fields['MUNI_NOMB'];
	return $nom_muni;
}
?>
