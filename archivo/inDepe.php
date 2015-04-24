<?
session_start();
error_reporting(0);
$ruta_raiz = "..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$db = new ConnectionHandler($ruta_raiz);
?>
<html>
<head>
  <meta http-equiv="Cache-Control" content="cache">
  <meta http-equiv="Pragma" content="public">
<link rel="stylesheet" href="../estilos/orfeo.css">
<script>
function RegresarV(){
	window.location.assign("adminEdificio.php?<?=$encabezado1?>&fechah=$fechah&$orno&adodb_next_page");
}
</script>
<CENTER>
<form name=inDepe method='post' action='inDepe.php?<?=session_name()?>=<?=trim(session_id())?>&krd=<?=$krd?>&edit=<?=$edit?>&cod=<?=$cod?>'>
 <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" class="borde_tab"  >
<TR  class='titulos2'><TD colspan=4>&nbsp;</TD></TR>
<TR  class='titulos2'><TD class=titulosError colspan=4 align=center>RELACION DEPENDENCIAS CON EDIFICIOS</TD></TR>
<TR  class='titulos2'><TD colspan=4>&nbsp;</TD></TR>
<?
//$db->conn->debug=true;
if($Ingresar or $Modificar){
	if($depe!="" and $exp_edificio!=""){
		if($exp_item=="")$exp_item2=0;
		else $exp_item2=$exp_item;
		if($Ingresar){
			$rp=$db->conn->Execute("select max(sgd_arch_id) AS DEM from sgd_arch_depe");
			$cont=$rp->fields['DEM']+1;
			$sql="insert into sgd_arch_depe (sgd_arch_id,sgd_arch_depe,sgd_arch_edificio,sgd_arch_item) values ($cont,'$depe',$exp_edificio,$exp_item2)";
			//$db->conn->debug=true;
			$rs=$db->conn->Execute($sql);
			if($rs->EOF)echo "El registro fue insertado";
			else echo "El registro no pudo ser ingresado";
		}
		if($Modificar){
			$sqm="update sgd_arch_depe set SGD_ARCH_DEPE='$depe',SGD_ARCH_EDIFICIO=$exp_edificio,SGD_ARCH_ITEM=$exp_item2 where sgd_arch_id=$cod ";
			$rsm=$db->conn->Execute($sqm);
			if($rsm->EOF)echo "El registro fue modificado";
			else echo "El registro no pudo ser modificado";
		}
	}
	elseif($depe=="")echo "Debe seleccionar una Dependencia";
	elseif($exp_edificio=="")echo "Debe seleccionar un Edificio";
	else echo "Debe seleccionar un Edificio y una Dependencia";
}

if($edi==1){
	$sqe="select * from sgd_arch_depe where sgd_arch_id like '$cod'";
	$rse=$db->conn->Execute($sqe);
	if(!$rse->EOF){
		$depe=$rse->fields['SGD_ARCH_DEPE'];
		$exp_edificio=$rse->fields['SGD_ARCH_EDIFICIO'];
		$exp_item=$rse->fields['SGD_ARCH_ITEM'];
		$rsdp=$db->conn->Execute("select codi_dpto,codi_muni from sgd_eit_items where sgd_eit_codigo=$exp_edificio");
		if(!$rsdp->EOF){
			$codDpto=$rsdp->fields['CODI_DPTO'];
			$codMuni=$rsdp->fields['CODI_MUNI'];
		}
	}
	$edit=2;
}
?>
<tr>
<input type="hidden" name="edit" value=<?=$edit?>>
<td class='titulos2'>DEPENDENCIA </td>
<TD class='titulos2' colspan=3>
<? 
	$conD=$db->conn->Concat("D.DEPE_CODI","'-'","D.DEPE_NOMB");
	$sql5="SELECT DISTINCT($conD), D.DEPE_CODI FROM DEPENDENCIA D, USUARIO U WHERE D.DEPE_CODI=U.DEPE_CODI AND U.USUA_ADMIN_ARCHIVO >= 1 ORDER BY D.DEPE_CODI";
	//$sql5="select ($conD) as detalle,DEPE_CODI from DEPENDENCIA order by DEPE_CODI";
	//$db->conn->debug=true;
	$rs=$db->conn->Execute($sql5);
	print $rs->GetMenu2('depe',$depe,true,false,"","class=select");
?>
</td>
</tr>
<tr valign="bottom" class='titulos2'>
<td class="titulos2">DEPARTAMENTO
<td class="titulos2" >
<?
	//$db->conn->debug=true;
	$queryDpto = "select distinct(d.dpto_nomb),d.dpto_codi from departamento d, sgd_eit_items i where d.dpto_codi=i.codi_dpto ORDER BY dpto_nomb";
	$rsD=$db->query($queryDpto);
	print $rsD->GetMenu2("codDpto", $codDpto, "0:-- Seleccione --", false,""," onChange='submit()' class='select'" ); //echo "D.C.";//PARA LA CRA
?>
</td>
<td class="titulos2">MUNICIPIO
<td class="titulos2">
<? 
	if( !isset( $codDpto ) )
	{
		$codDpto = 0;
	}
	$queryMuni = "select distinct(m.MUNI_NOMB),m.MUNI_CODI FROM MUNICIPIO m , SGD_EIT_ITEMS i WHERE m.MUNI_CODI=i.CODI_MUNI and DPTO_CODI='$codDpto' ORDER BY MUNI_NOMB";
	$rsm=$db->query($queryMuni);
	print $rsm->GetMenu2("codMuni", $codMuni, "0:-- Seleccione --", false,""," onChange='submit()' class='select'" );//echo "BOGOTA";//PARA LA CRA
?>
</td>
</tr>
<tr class="titulos2">
<td  class='titulos2'>EDIFICIO </td>
<TD >
<? 
	$sql="select SGD_EIT_SIGLA,SGD_EIT_CODIGO from SGD_EIT_ITEMS where CODI_MUNI like '$codMuni'
	and CODI_DPTO like '$codDpto' order by SGD_EIT_NOMBRE";
	$rs=$db->query($sql);
	print $rs->GetMenu2('exp_edificio',$exp_edificio,true,false,""," onChange='submit()' class=select");
?>
</td>
<?
	$sql="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$exp_edificio' order by SGD_EIT_NOMBRE ";
	$rs=$db->query($sql);
	if (!$rs->EOF)	$item21=$rs->fields["SGD_EIT_NOMBRE"];
	$item2=explode(' ',$item21);
?>
<td class='titulos2'><?=$item2[0]?></td>
<TD >
<? 
	$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$exp_edificio' order by SGD_EIT_NOMBRE";
	$rs=$db->query($sql);
	print $rs->GetMenu2('exp_item',$exp_item,true,false,"","class=select");
?>
</TD>
</tr>
<tr>
<td colspan="4" align="center">
<? if($edit>=1){ ?>
<input type=submit value=Modificar name=Modificar class="botones">
<?}
else{
?>
<input type=submit value=Ingresar name=Ingresar class="botones">
<? }?>
<input name='CERRAR' type="button" class="botones" id="envia22" onClick="opener.regresar();window.close();" value="CERRAR" align="middle" ></td>
</tr>
</table>
</form>
</center>
</html>