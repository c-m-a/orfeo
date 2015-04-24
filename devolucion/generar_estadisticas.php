<?php
	 session_start();
	 error_reporting(7);
	 $ruta_raiz = "..";
         if(!$dependencia) include "../rec_session.php";
         if(!$fecha_busq) $fecha_busq=date("Y-m-d");
	 if(!$fecha_busq2) $fecha_busq2=date("Y-m-d");
	 include_once "$ruta_raiz/include/db/ConnectionHandler.php";
         $db = new ConnectionHandler("$ruta_raiz");	 
?>
<head>
<link rel="stylesheet" href="../estilos_totales.css">
</head>
<BODY>
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript"><!--
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "fecha_busq","btnDate1","<?=$fecha_busq?>",scBTNMODE_CUSTOMBLUE);
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "new_product", "fecha_busq2","btnDate1","<?=$fecha_busq2?>",scBTNMODE_CUSTOMBLUE);
//--></script><P>
<p><CENTER><b><span class="etexto">GENERACION LISTADOS DE DOCUMENTOS DEVUELTOS POR AGENCIA DE CORREO<p></CENTER>
  <form name="new_product"  method=post  action='generar_estadisticas.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah"?>'>
<center>

<TABLE width="450" class="t_bordeGris">
  <!--DWLayoutTable-->
  <TR>
    <TD width="125" height="21"  class='grisCCCCCC'> Fecha desde<br>
	<?
	  echo "($fecha_busq)";
	?>
	</TD>
    <TD width="225" align="right" valign="top">

        <script language="javascript">
		        dateAvailable.date = "2003-08-05";
			    dateAvailable.writeControl();
			    dateAvailable.dateFormat="yyyy-MM-dd";
    	  </script>
</TD>
  </TR>
  <TR>
    <TD width="125" height="21"  class='grisCCCCCC'> Fecha Hasta<br>
	<?
	  echo "($fecha_busq2)";
	?>
	</TD>
    <TD width="225" align="right" valign="top">
        <script language="javascript">
		            dateAvailable2.date = "2003-08-05";
			    dateAvailable2.writeControl();
			    dateAvailable2.dateFormat="yyyy-MM-dd";
    	  </script>
</TD>
  </TR>
   <tr>
    <td height="26" colspan="2" valign="top" class='grisCCCCCC'> <center>
		<INPUT TYPE=SUBMIT name=generar_informe Value=' Generar Informe ' class=ebuttons2>
		</td>
	</tr>
  </TABLE>
</form>	
<HR>
<?php
if(!$fecha_busq) $fecha_busq = date("Y-m-d");
if($generar_informe)
{
	error_reporting(7);
		$fecha_ini = $fecha_busq;
	    $fecha_fin = $fecha_busq2;
		$fecha_ini = mktime(00,00,00,substr($fecha_ini,5,2),substr($fecha_ini,8,2),substr($fecha_ini,0,4));
		$fecha_fin = mktime(23,59,59,substr($fecha_fin,5,2),substr($fecha_fin,8,2),substr($fecha_fin,0,4));
	$guion     = "'-'";
	$query = 'select  
	d.sgd_fenv_descrip as "Forma Envio",
	c.depe_nomb as "Dependencia",
	a.radi_nume_sal as "Radicado",
	a.sgd_renv_nombre as "Destinatario",
	a.sgd_renv_dir as "Direccion",
	a.sgd_renv_mpio as "Municipio",
	a.sgd_renv_depto as "Departamento",
	a.sgd_renv_fech as "Fecha de envio",
	a.sgd_deve_fech as "Fecha Dev",
	b.sgd_deve_desc as "Motivo Devolucion",
	'.$guion.' as "Recibido",
	a.sgd_renv_planilla as "HID_sgd_renv_planilla",
	a.sgd_renv_cantidad as "HID_sgd_renv_cantidad",
	a.sgd_renv_valor as "HID_sgd_renv_valor"
	from SGD_RENV_REGENVIO a, 
			 sgd_deve_dev_envio  b,
			 dependencia c,
			 SGD_FENV_FRMENVIO d ';
	$fecha_mes = substr($fecha_ini,0,7);
	// Si la variable $generar_listado_existente viene entonces este if genera la planilla existente
	$where_isql = ' WHERE a.DEPE_CODI = '.$dependencia.'
	and a.sgd_deve_fech BETWEEN
	'.$db->conn->DBTimeStamp($fecha_ini).' and '.$db->conn->DBTimeStamp($fecha_fin).'
	and a.sgd_deve_codigo=b.sgd_deve_codigo
	and a.sgd_fenv_codigo=d.sgd_fenv_codigo
	and '.$db->conn->substr.'(a.radi_nume_sal, 5, 3)=c.depe_codi
	and a.sgd_deve_codigo is not null
	';
	// and SGD_FENV_CODIGO = $tipo_envio   Se elimino esta line, a peticion de Usuarios.
	if($tipo_envio=="101" or $tipo_envio=="108" )
	{
	 $where_isql .= ' AND a.SGD_RENV_PLANILLA IS NOT NULL
		';
	}
	$order_isql = '  ORDER BY  '.$db->conn->substr.'(a.radi_nume_sal, 5, 3), a.SGD_RENV_FECH DESC,a.SGD_RENV_PLANILLA DESC';
	$query_t = $query . $where_isql . $order_isql ;
	$ruta_raiz = "..";
	error_reporting(7);
	
 ?>
 </center>
</CENTER>
	<span class="etextomenu">
	</CENTER>
	<b>Listado de documentos Devueltos</b><br>
	Fecha Inicial <?=$fecha_busq ?> <br>
	Fecha Final   <?=$fecha_busq2 ?> <br>
	Fecha Generado <? echo date("Ymd - H:i:s"); ?><br>
	<?
	 $query_t = $query . $where_isql . $order_isql ;
	 $ruta_raiz = "..";
         $isql = $query_t;
         $ADODB_COUNTRECS = true;
         $rs = $db->conn->Execute($isql);
	 $nregis = $rs->recordcount();
         $ADODB_COUNTRECS = false;
	 $encabezado = "".session_name()."=".session_id()."&krd=$krd&estado_sal=$estado_sal&dependencia=$dependencia&orderTipo=$orderTipo&orderNo=";
         $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
        ?>
	Numero de Registros  <? echo $nregis ; ?>
	<?
	$db->conn->debug = false;
	$ruta_raiz = "..";
	$pager = new ADODB_Pager($db->conn,$isql,'adodb', true,$orderNo,$orderTipo);
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkEnviar);
}

?>
