<?
  session_start();
/*
 * Lista Subseries documentales
 * @autor Jairo Losada SuperSOlidaria 
 * @fecha 2009/06 Modificacion Variables Globales.
 */
	foreach ($_GET as $key => $valor)   ${$key} = $valor;
	foreach ($_POST as $key => $valor)   ${$key} = $valor;
	$krd = $_SESSION["krd"];
	$dependencia = $_SESSION["dependencia"];
	$usua_doc = $_SESSION["usua_doc"];
	$codusuario = $_SESSION["codusuario"];
  $ruta_raiz = "..";
  if(!$_SESSION['dependencia']) include "$ruta_raiz/rec_session.php";
  if(!$coddepe) $coddepe=0;
  if(!$tsub) $tsub=0;
  if(!$codserie) $codserie=0;
  $fecha_fin = date("Y/m/d") ;
  $where_fecha="";
  
//error_reporting(7);
?>
<html>
<head>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>

<body bgcolor="#FFFFFF" topmargin="0" >
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css">
<?
 $ruta_raiz = "..";
 include_once "$ruta_raiz/include/db/ConnectionHandler.php";
 $db = new ConnectionHandler("$ruta_raiz");	
 //$db->conn->debug = true;
 
 $encabezado = "".session_name()."=".session_id()."&filtroSelect=$filtroSelect&accion_sal=$accion_sal&dependencia=$dependencia&tpAnulacion=$tpAnulacion&orderNo=";
 $linkPagina = "$PHP_SELF?$encabezado&accion_sal=$accion_sal&orderTipo=$orderTipo&orderNo=$orderNo";
  /*  GENERACION LISTADO DE RADICADOS
	 *  Aqui utilizamos la clase adodb para generar el listado de los radicados
	 *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
	 *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
  */
  error_reporting(7);
  if(trim($orderTipo)=="") $orderTipo="ASC";
  if($orden_cambio==1)
	{
	  if(trim($orderTipo)!="DESC")
		{
		   $orderTipo="DESC";
		}else
		{
			$orderTipo="ASC";
		}
	}
		
?>
  <form name=formEnviar action='../trd/cuerpoMatriTRD.php?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>&nomcarpeta=<?=$nomcarpeta?>&orderNo=<?=$orderNo?>' method=post>
 
 <table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>MATRIZ TRD</center></td></tr></table>
 <table><tr><td></td></tr></table>
 <center>

<TABLE width="550" class="borde_tab" cellspacing="5">       
<TR>
    <TD width="125" height="21"  class='titulos2'> DEPENDENCIA</td>
      <td colspan="3"  class="listado5"> 
        <?		
			include_once "$ruta_raiz/include/query/envios/queryPaencabeza.php";			
 			$sqlConcat = $db->conn->Concat($db->conn->substr."($conversion,1,5) ", "'-'",$db->conn->substr."(depe_nomb,1,30) ");
			$sql = "select $sqlConcat ,depe_codi from dependencia 
							order by depe_codi";
			$rsDep = $db->conn->Execute($sql);
			if(!$depeBuscada) $depeBuscada=$dependencia;
			print $rsDep->GetMenu2("coddepe","$coddepe",false, false, 0," onChange='submit();' class='select'");
?>
</td>
    </tr>
  <TR>
    <TD width="125" height="21"  class='titulos2'> SERIE </td>
      <td colspan="3"  class="listado5"> 
  <?php
    include "$ruta_raiz/trd/actu_matritrd.php";  
    if(!$codserie) $codserie = 0;
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = date("d-m-y");
	$sqlFechaHoy="'".$fecha_hoy."'";
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$num_car = 4;
	$nomb_varc = "sgd_srd_codigo";
	$nomb_varde = "sgd_srd_descrip";
   	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySerie = "select distinct ($sqlConcat) as detalle, sgd_srd_codigo 
	   from sgd_srd_seriesrd 
	 order by detalle
	";
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
 ?>
   <TR>
    <TD width="125" height="21"  class='titulos2'> SUBSERIE</td>
      <td colspan="3"  class="listado5"> 
	<?
	$nomb_varc = "sgd_sbrd_codigo";
	$nomb_varde = "sgd_sbrd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php"; 
	//Modificado skina 11-02-09
	//$sqlFechaHoy=$db->conn->SQLDate('Y-m-d',$fecha_hoy);
  $fecha_hoy = date("Y-m-d");
	$sqlFechaHoy="'".$fecha_hoy."'";
   	$querySub = "select distinct ($sqlConcat) as detalle, sgd_sbrd_codigo 
	         from sgd_sbrd_subserierd 
			 where sgd_srd_codigo = '$codserie'
 			       and $sqlFechaHoy between $sgd_sbrd_fechini and $sgd_sbrd_fechfin
			 order by detalle
			  ";
	//$db->conn->debug = true;
	$rsSub=$db->conn->query($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );

?> 
  </td>
  <TR>
    <TD width="125" height="21"  class='titulos2'> SOPORTE</td>
      <td colspan="3"  class="listado5"> 
	  <select  name='med'  class='select'>
	<?php
	if($med==1){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='1' $datosel><font>1. PAPEL</font></option>";
	if($med==2){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='2' $datosel><font>2. ELECTRONICO</font></option>";
		?>
</select>
  </td>
  </tr>
<?
  $isql = "select DEPE_CODI_APLICA
           from sgd_mrd_matrird m
       where m.depe_codi = '$coddepe'
             and m.sgd_srd_codigo = '$codserie'
             and m.sgd_sbrd_codigo = '$tsub'
            ";
           
  $rs = $db->conn->query($isql);
  $dependenciasAsociadas = $rs->fields["DEPE_CODI_APLICA"];
?>
  <TR>
    <TD width="125" height="21"  class='titulos2'> Codigo Areas que aplica. (No propia)</td>
    <td colspan="3"  class="listado5"> 
      <input type=text value="<?=$dependenciasAsociadas?>" name=dependenciasAsociadas > 
        <!-- Deben estar separadas por Coma -->
    </td>
  </tr>
 <tr>
       <td height="26" colspan="4" valign="top" class='titulos2'> 
	   <center>
	  <input type=submit name=actu_mtrd value='Actualizar' class=botones_funcion >
       <input name="aceptar" type="button"  class="botones_funcion" id="envia22"  onClick="window.close();" value="Cancelar"> 
      </td>
    </tr>
  </table>
<br>
<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>DOCUMENTOS ASIGNADOS A ESTOS PARAMETROS</center></td></tr></table>
<table><tr><td></td></tr></table>
<br>
	<?
	if(strlen($orderNo)==0)  
	{
		$orderNo="1";
		$order = 1;
	}else
	{
		$order = $orderNo +1;
	}
  $isql = "select t.sgd_tpr_codigo as CODIGO, t.sgd_tpr_descrip as DETALLE, DEPE_CODI_APLICA
	         from sgd_mrd_matrird m, sgd_tpr_tpdcumento t
			 where m.depe_codi = '$coddepe'
 			       and m.sgd_srd_codigo = '$codserie'
			       and m.sgd_sbrd_codigo = '$tsub'
				   and m.sgd_tpr_codigo = t.sgd_tpr_codigo ";
				   
  $isql  = $isql . "order by ".$order . " " .$orderTipo;
  $encabezado = "".session_name()."=".session_id()."&krd=$krd&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&accion_sal=$accion_sal&coddepe=$coddepe&dep_sel=$dep_sel&med=$med&tsub=$tsub&codserie=$codserie&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
	$linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
	//$db->conn->debug = false;
	$pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
	$pager->checkAll = false;
	$pager->checkTitulo = true; 	
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->Render($rows_per_page=25,$linkPagina,$checkbox=chkEnviar);
	
 ?>
 </table>

<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>DOCUMENTOS SIN ASIGNAR A ESTOS PARAMETROS</center></td></tr></table>
<table><tr><td></td></tr></table>
<br>
	<?
	if(strlen($orderNo)==0)  
	{
		$orderNo="0";
		$order = 0;
	}else
	{
		$order = $orderNo +1;
	}
	// Modificado SGD 10-Septiembre-2007
	$isqlF = "select a.sgd_tpr_codigo as CODIGO
			, a.sgd_tpr_descrip as DETALLLE
			, a.sgd_tpr_codigo AS \"CHK_SGD_TPR_CODIGO\"
	         from sgd_tpr_tpdcumento a
			 where a.sgd_tpr_codigo not in (select t.sgd_tpr_codigo 
	         from sgd_mrd_matrird m, sgd_tpr_tpdcumento t
			 where m.depe_codi = '$coddepe'
 			       and m.sgd_srd_codigo = '$codserie'
			       and m.sgd_sbrd_codigo = '$tsub'
				   and m.sgd_tpr_codigo = t.sgd_tpr_codigo)
			      and a.sgd_tpr_codigo != '0' ";
	$isqlF = $isqlF .  'order by a.sgd_tpr_codigo ';
	 //$isqlF = $isqlF .  'order by '.$order .' ' .$orderTipo;

	$encabezado = "".session_name()."=".session_id()."&krd=$krd&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&accion_sal=$accion_sal&coddepe=$coddepe&dep_sel=$dep_sel&codserie=$codserie&med=$med&tsub=$tsub&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
	$linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";

	//$db->conn->debug = false;
	$pager = new ADODB_Pager($db,$isqlF,'adodb', true,$orderNo,$orderTipo);
	$pager->checkAll = false;
	$pager->checkTitulo = true; 	
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->Render($rows_per_page=1125,$linkPagina,$checkbox=chkEnviar);
	
 ?>
</table>
  </form>
</body>
</html>
