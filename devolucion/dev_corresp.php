<?php
 session_start();
 error_reporting(0);
 $anoActual = date("Y");
 $ruta_raiz = "..";
 if (!$_SESSION['dependencia'] and !$_SESSION['depe_codi_territorial'])	include "../rec_session.php";
 include_once "$ruta_raiz/include/db/ConnectionHandler.php";
 $db = new ConnectionHandler("$ruta_raiz");	

 $db->conn->debug=false;

 define('ADODB_FETCH_ASSOC',2);
 $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
?>
<head>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<BODY>
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<?
if (!$fecha_busq)
{
     $fecha_busq = date("Y-m-d",mktime(0,0,0,date("m")  ,date("d")-1,date("Y")));
 	 $hora_ini = date("H");
	 $minutos_ini = date("i");
}else{
  if(mktime($hora_ini,$minutos_ini,0,substr($fecha_busq,5,2),substr($fecha_busq,8,2),substr($fecha_busq,0,4)) > mktime(date("H"),date("i"),0,date("m")  ,date("d")-1,date("Y")))
  {
     echo "
		 <script>
		 alert('Los datos de Fecha y Hora no pueden ser superiores a 24 Horas.');
		 </script>
		 ";
     $fecha_busq = date("Y-m-d",mktime(0,0,0,date("m")  ,date("d")-1,date("Y")));     $hora_ini = date("H");     $minutos_ini = date("i");
  }
}
?>
<script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script><script language="javascript">
    var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable","new_product","fecha_busq","btnDate1","<?=$fecha_busq?>",scBTNMODE_CUSTOMBLUE);
</script>
<TABLE width="100%" class='borde_tab' cellspacing="5">
  <TR>
    <TD height="30" valign="middle"   class='titulos2' align="center">
DEVOLUCION DE DOCUMENTO POR TIEMPO
</td>
</tr>
</table>
<table><tr><td></td></tr></table>
<form name="new_product"  action='dev_corresp.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&fecha_busq=$fecha_busq"?>' method=post><center>
<TABLE width="550" class='borde_tab' cellspacing="5">
  <TR>
    <TD width="125" height="21"  class='titulos2'> Fecha<br>
	</TD>
    <TD width="415" align="right" valign="top" class='listado2'>
<script language="javascript">
		dateAvailable.dateFormat="yyyy-MM-dd";
		dateAvailable.date ="<?=$fecha_busq?>";
		dateAvailable.writeControl();
</script>
</TD>
  </TR>
  <TR>
    <TD height="26" class='titulos2'> Desde la Hora</TD>
    <TD valign="top" class='listado2'>
	<?php
	   if(!$hora_ini) $hora_ini = 01;
   	   if(!$hora_fin) $hora_fin = date("H");
	   if(!$minutos_ini) $minutos_ini = 01;
   	   if(!$minutos_fin) $minutos_fin = date("i");
	   if(!$segundos_ini) $segundos_ini = 01;
   	   if(!$segundos_fin) $segundos_fin = date("s");
	?>

	<select name=hora_ini class=select>
        <?php
for($i=0;$i<=23;$i++)
{
	if ($hora_ini==$i){ $datoss = " selected "; }else{ $datoss = " "; }?>
            <option value='<?=$i?>' '<?=$datoss?>'>
              <?=$i?>
            </option>
        <?php
}
?>
      </select>:<select name=minutos_ini class=select>
        <?php
for($i=0;$i<=59;$i++)
{
if ($minutos_ini==$i){ $datoss = " selected "; }else{ $datoss = " "; }?>
        <option value='<?=$i?>' '<?=$datoss?>'>
        <?=$i?>
        </option>
        <?php
}
?>
      </select>
      </TD>
   </TR>
  <TR>
    <TD height="26" class='titulos2'>Dependencia</TD>
    <TD valign="top" class='listado2'>
	<?
	$encabezado = "".session_name()."=".session_id()."&krd=$krd&fecha_busq=$fecha_busq&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&dep_sel=$dep_sel&filtroSelect=$filtroSelect&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
        $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo";
    include "$ruta_raiz/include/query/devolucion/querydependencia.php";
	error_reporting(7);
	$ss_RADI_DEPE_ACTUDisplayValue = "--- TODAS LAS DEPENDENCIAS ---";
	$valor = 0;
	$sqlD = "select $sqlConcat ,depe_codi from dependencia 
       	            where depe_codi_territorial = $depe_codi_territorial
					order by depe_codi";
	$rsDep = $db->conn->Execute($sqlD);
	 print $rsDep->GetMenu2("dep_sel","$dep_sel",$blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0," onChange='submit();' class='select'");	
	?>
	
  </TR><tr>
   </tr><tr><td height="26" colspan="2" valign="top" class='titulos2'> <center>		
     <INPUT TYPE=SUBMIT name=devolver_rad Value=' VISTA PRELIMINAR ' class=botones_largo>      </center></td>
  </tr>
</TABLE>
<?php
error_reporting(7);
if(($devolver_rad or $devolver_dependencias) and $fecha_busq)
  {
    if ($dep_sel == 0 ) 
		{
         include "$ruta_raiz/include/query/devolucion/querydependencia.php";
	     $sqlD = "select $sqlConcat ,depe_codi from dependencia 
       	            where depe_codi_territorial = $depe_codi_territorial
					order by depe_codi";
	
		define('ADODB_FETCH_ASSOC',2);
                $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$rsDep = $db->conn->Execute($sqlD);
		
		while(!$rsDep->EOF)
		{
	            $depcod = $rsDep->fields["DEPE_CODI"];
		    $lista_depcod .= " $depcod,";
		    $rsDep->MoveNext();
		}   
		$lista_depcod .= "0"; 	
	    	//$where_depe = "";
		}
	else 
	{ 
	$lista_depcod = $dep_sel;
	//$where_depe = ' and '.$db->conn->substr.'(radi_nume_salida, 5, 3) ='.$dep_sel;
	
	}
    
	$fecha_busqt = $fecha_busq;
	$fecha_fin = mktime($hora_ini,$hora_fin,00,substr($fecha_busqt,5,2),substr($fecha_busqt,8,2),substr($fecha_busqt,0,4));
	//$where_like = " and radi_nume_salida like '$anoActual%'";
	$where_like = "";
	//$where_fecha = "sgd_fech_impres <= TO_DATE('$fecha_busqt','yyyy-mm-dd HH24:MI:ss')";
    include "$ruta_raiz/include/query/devolucion/querydev_corresp.php";
		define('ADODB_FETCH_ASSOC',2);
        $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
        $rsCount = $db->query($isqlC);
	$num_reg = $rsCount->fields["NUMERO"];
    if ($num_reg == 0)
	{
	echo "<script>alert('No existen radicados para devolver de esta Seleccion');</script>";
	}
	echo "</p> <table border='0' class=borde_tab width=100%><tr></tr><td class=titulos2>Registros Encontrados : " .$rsCount->fields["NUMERO"]. "</td></tr></table>";
	$fecha_busqt = $fecha_busq;
	$fecha_fin = mktime($hora_ini,$hora_fin,00,substr($fecha_busqt,5,2),substr($fecha_busqt,8,2),substr($fecha_busqt,0,4));
    $where_like = "";
	$fech_devol = "'".date("Y-m-d H:i:s")."'" ;
	$usua_devol = "'".$usua_nomb."'" ;
	include "$ruta_raiz/include/query/devolucion/querydev_corresp.php";
    $rs = $db->conn->Execute($isql);
	$fech_tot = $fecha_busqt."  ".$hora_ini.":".$minutos_ini;
	echo "<p><table class=borde_tab width='100%'><tr><td class=titulos2>RADICADOS ENVIADOS A CORRESPONDENCIA ANTES DE $fech_tot </p></td></tr></table>";
	/*
	Listado Resultado de la seleccion
	*/
	$encabezado = "".session_name()."=".session_id()."&krd=$krd&fecha_busq=$fecha_busq&devolver_rad=$devolver_rad&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&dep_sel=$dep_sel&filtroSelect=$filtroSelect&nomcarpeta=$nomcarpeta&orderTipo=     $orderTipo&orderNo=";
        $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
	$pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->checkAll = true;
	$pager->checkTitulo = false; 
	$pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkEnviar);

 if(!$devolver_dependencias and $num_reg > 0)
	{
     ?>
 	  <span class=etexto></span>
	  <br>
	  <input type=SUBMIT name='devolver_dependencias'  value = 'CONFIRMAR DEVOLUCION' class=botones_largo>
	  <?php
	 }
     else
	 {
	
	$fecha_busqt = $fecha_busq;
	$fecha_fin = mktime($hora_ini,$hora_fin,00,substr($fecha_busqt,5,2),substr($fecha_busqt,8,2),substr($fecha_busqt,0,4));

	//$where_like = " and radi_nume_salida like '$anoActual%'";

	$where_like = "";
	//$where_fecha = "sgd_fech_impres <= TO_DATE('$fecha_busqt','yyyy-mm-dd HH24:MI:ss')";
	include "$ruta_raiz/include/query/devolucion/querydev_corresp.php";
		define('ADODB_FETCH_ASSOC',2);
        $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
        $rsSel = $db->query($isqlF);
		
	 /*
	 */
		 while (!$rsSel->EOF) {
		    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
			
			$radicado_dev = $rsSel->fields["RADI_NUME_SALIDA"];
			$anex_radi_nume = $rsSel->fields["ANEX_RADI_NUME"];
 		        $sgd_dir_tipo = $rsSel->fields["SGD_DIR_TIPO"];
		        $t_espera = $rsSel->fields["T_ESPERA"];
		        $msg_copia = ""; 
			if($sgd_dir_tipo>="7") $msg_copia = "(" . (substr($sgd_dir_tipo,1,2) - 1) . ")";
			include "$ruta_raiz/include/query/devolucion/querydev_corresp.php";
		     $rsUpdate = $db->query($isqlU);
		//* Para Incluir cambio en el historico
		$observa = "<table class=titulosError ><tr><td>Devolucion de rad No $radicado_dev $msg_copia por sobrepasar tiempo de espera para envio ($t_espera Dias)</td></tr></table>";
		 $systemDate = $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
		$isql_hl= "insert into hist_eventos(DEPE_CODI   ,HIST_FECH,USUA_CODI  ,RADI_NUME_RADI  ,HIST_OBSE,USUA_CODI_DEST,USUA_DOC)
			       values ($dependencia,$systemDate  ,$codusuario,$anex_radi_nume ,'$observa','','$usua_doc')";
		$rsInsert = $db->query($isql_hl);
		$rsSel->MoveNext();
		//$anexos_act = ora_numrows($cursor1);
		}
	}
}
?>
</form>
</html>
