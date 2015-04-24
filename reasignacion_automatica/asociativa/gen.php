<?
session_start();

/**
  * Modificacion Variables Globales Fabian losada 2009-07
  * Licencia GNU/GPL 
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;


$ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
	$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&sel=$sel";
	$encabezado = session_name()."=".session_id()."&krd=$krd&tipo_archivo=1&nomcarpeta=$nomcarpeta";

	function fnc_date_calcy($this_date,$num_years){
	$my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   	$timestamp = $my_time + ($num_years * 86400); //calculates # of days passed ($num_days) * # seconds in a day (86400)
    $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format
    return $return_date;//exit function and return string
   }
    function fnc_date_calcm($this_date,$num_month){
	$my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   	$timestamp = $my_time - ($num_month * 2678400 ); //calculates # of days passed ($num_days) * # seconds in a day (86400)
    $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format
    return $return_date;//exit function and return string
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sancionados</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>

<body>

 <?
// print_r($GLOBALS);
 ?>
<form action="gen.php" method="post" name="gen">
<center>

<?
	$sql="select identificador_empresa from bodega_empresa where nit_de_la_empresa=".$nit;
	$rsb=$db->conn->Execute($sql);
	$sqlb="select id from usuarios_certificaciones where upper(usua_login)='".$usua."' and usua_password='".md5($password)."'";
	$rsu=$db->conn->Execute($sqlb);
	if($rsb->EOF and $rsu->EOF){
		$esp=$rsb->fields[0];
		$sq="insert into certificacion_asociativa (id,usua_codi,eesp_codi,dirigido,eesp_nit,eesp_nomb) values(sec_cer_asociativa.nextval,".$rsu->fields[0].",".$esp.",'".$diri."','".$nit."','".$entidad."')";
		$rs=$db->conn->Execute($sq);
		$_SESSION['usua']=$rsu->fields[0];
		$sqla="select r.radi_nume_radi,r.radi_fech_radi,r.ra_asun,b.nit_de_la_empresa, b.nombre_de_la_empresa, m.muni_nomb,dp.dpto_nomb, 
CASE 
WHEN D.SGD_CIU_CODIGO IS NOT NULL OR D.SGD_CIU_CODIGO !=0 THEN (C.SGD_CIU_NOMBRE||' '||C.SGD_CIU_APELL1||' '||C.SGD_CIU_APELL2)
ELSE O.SGD_OEM_OEMPRESA END PETICIONARIO,
CASE WHEN D.SGD_CIU_CODIGO IS NOT NULL OR D.SGD_CIU_CODIGO !=0 THEN C.SGD_CIU_DIRECCION 
ELSE O.SGD_OEM_DIRECCION END  DIRECCION_PETICIONARIO,
CASE WHEN D.SGD_CIU_CODIGO IS NOT NULL OR D.SGD_CIU_CODIGO !=0 THEN C.SGD_CIU_EMAIL 
ELSE O.SGD_OEM_MAIL END CORREO_PETICIONARIO,
CASE WHEN D.SGD_CIU_CODIGO IS NOT NULL OR D.SGD_CIU_CODIGO !=0 THEN DP1.DPTO_NOMB
ELSE DP3.DPTO_NOMB END DEPARTAMENTO_PETICIONARIO,
CASE WHEN D.SGD_CIU_CODIGO IS NOT NULL OR D.SGD_CIU_CODIGO !=0 THEN M1.MUNI_NOMB
ELSE M3.MUNI_NOMB END MUNICIPIO_PETICIONARIO
from bodega_empresas b
,municipio m,departamento dp
,radicado r 
  LEFT JOIN SGD_DIR_DRECCIONES D 
    LEFT JOIN SGD_CIU_CIUDADANO C 
      LEFT JOIN departamento DP1 ON DP1.DPTO_CODI=C.DPTO_CODI
      LEFT JOIN municipio M1 ON M1.DPTO_CODI=C.DPTO_CODI AND M1.MUNI_CODI=C.MUNI_CODI
    ON C.SGD_CIU_CODIGO=D.SGD_CIU_CODIGO
    LEFT JOIN SGD_OEM_OEMPRESAS O 
      LEFT JOIN departamento DP3 ON DP3.DPTO_CODI=O.DPTO_CODI
      LEFT JOIN municipio M3 ON M3.DPTO_CODI=O.DPTO_CODI AND M3.MUNI_CODI=O.MUNI_CODI
    ON O.SGD_OEM_CODIGO=D.SGD_OEM_CODIGO
  ON D.RADI_NUME_RADI=R.RADI_NUME_RADI
where b.identificador_empresa=r.eesp_codi and m.muni_codi=b.codigo_del_municipio and m.dpto_codi=b.codigo_del_departamento and b.codigo_del_departamento=dp.dpto_codi
and (upper(r.ra_asun) like '%CONTROL DE LEGALIDAD ASAMBLEA%' OR upper(r.ra_asun) like '%REFORMA%')
and b.eesp_codi=".$esp." and rownum<=3
order by r.radi_fech_radi desc";
		$rsa=$db->conn->Execute($sqla);
		while(!$rsa->EOF){
			$entidad=$rsa->fields['NOMBRE_DE_LA_EMPRESA'];
			$muni=$rsa->fields['MUNI_NOMB'];
			$dpto=$rsa->fields['DPTO_NOMB'];
			$rsa->MoveNext();
		}

		$sqlbs="select to_char(fechacorte,'YYYY') periodo,to_char(fecharecepcion,'dd-mm-YYYY') fecha_reporte from v_control where to_char(fechacorte,'dd-mm')='31-12' and replace(nit,'-')='".$nit."'";
		$rsbs=$db->conn->Execute($sqlbs);
		if($rsbs->EOF){
			$fech=$rsbs->fields['FECHA_REPORTE'];
			$per=$rsbs->fields['PERIODO'];
			$repor=" La Entidad Solidaria ".$entidad." realizo su ultimo reporte el dia ".$fech." del periodo ".$per;
		}
		else{
			$repor=" La Entidad Solidaria ".$entidad." no ha reportado sus estados financieros a la Superintendencia de Economia Solidaria ni al SICOOP";
		}
		
		$sqlsan="select san_resolucion, to_char(san_fech,'dd-mm-YYYY') fechar from san_sancionados where eesp_codi=".$esp;
		$rssan=$db->conn->Execute($sqlsan);
		if($rssan->EOF){
			$san=" La Entidad Solidaria ".$entidad." posee la siguente(s) sanciones ";
			while(!$rssan->EOF){
				$res=$rssan->fields['SAN_RESOLUCION'];
				$fechr=$rssan->fields['FECHAR'];
				$san.="Resolucion ".$res." del ".$fechr;
				$rssan->MoveNext();
			}
		}
		else{
			$san=" La Entidad Solidaria ".$entidad." no tiene ninguna sancion";
		}
	}
	else{
		if(!$rsb->EOF)echo "El Nit ingresado no corresponde a ninguna entidad solidaria registrada en la Superintendencia de Economia Solidaria";
		if(!$rsu->EOF)echo "El Usuario ingresado no corresponde a ninguna persona registrada en la Superintendencia de Economia Solidaria";
	}
?>
  <table width="300" border="0" class="borde_tab">
    	<tr class="titulo1">
      <td colspan="2" ><div align="center">
        <input name="regresar" type="button" class="botones" id="regresar" value="Regresar" onclick="document.location.href='index.php';" />

        <input type="submit" name="consultar" value="Consultar" class="botones"/>
        <label></label>
      </div></td>
    </tr>
  </table>
</center>
<?
if($consultar){

$isql="select s.id CHK_sancionado,'<a href=historico.php?id='||s.id||'>'||s.id||'</a>' id,b.nombre_de_la_empresa entidad_responsable,b.nit_de_la_empresa nit,s.san_fech fecha_sancion,s.valor_multa valor_sancion,s.san_resolucion resolucion,o.sgd_oem_oempresa entidad_afectada from san_sancionados s, bodega_empresas b, sgd_oem_oempresas o where b.identificador_empresa=s.eesp_codi and o.sgd_oem_codigo=s.esp_codi";
if($entidad!=0)$isql.=" and b.identificador_empresa=".$entidad;
if($sep==1)$isql.=" and san_fech between to_date('".$fechai."','YYYY-mm-dd') and to_date('".$fechaf."','YYYY-mm-dd')";
$rs=$db->conn->Execute($isql);
		$pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
		$pager->checkAll = false;
		$pager->checkTitulo = true;
		$pager->toRefLinks = $linkPagina;
		$pager->toRefVars = $encabezado;
		$pager->descCarpetasGen=$descCarpetasGen;
		$pager->descCarpetasPer=$descCarpetasPer;
		if($_GET["adodb_next_page"]) $pager->curr_page = $_GET["adodb_next_page"];
		$pager->Render($rows_per_page=40,$linkPagina,$checkbox=sancionado);
}
?>
</form>

</body>
</html>