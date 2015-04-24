<?php
session_start();
error_reporting(0);
$ruta_raiz = "..";
if (!$dependencia and !$depe_codi_territorial)include "../rec_session.php";
?>
<head>
<link rel="stylesheet" href="../estilos_totales.css">
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
     $fecha_busq = date("Y-m-d",mktime(0,0,0,date("m")  ,date("d")-1,date("Y")));
	 $hora_ini = date("H");
	 $minutos_ini = date("i");
  }
}
?>
<script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script><script language="javascript">
    var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable","new_product","fecha_busq","btnDate1","<?=$fecha_busq?>",scBTNMODE_CUSTOMBLUE);
</script>
<p><CENTER><b><span class="etexto">DEVOLUCION DE DOCUMENTO POR TIEMPO</CENTER><p>
<form name="new_product"  action='dev_corresp.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah"?>' method=post><center>
<TABLE width="550" class="t_bordeGris">
  <TR>
    <TD width="125" height="21"  class='grisCCCCCC'> Fecha<br>
	</TD>
    <TD width="225" align="right" valign="top">
<script language="javascript">
		dateAvailable.dateFormat="yyyy-MM-dd";
		dateAvailable.date ="<?=$fecha_busq?>";
		dateAvailable.writeControl();
</script>
</TD>
  </TR>
  <TR>
    <TD height="26" class='grisCCCCCC'> Desde la Hora</TD>
    <TD valign="top">
	<?php
	   if(!$hora_ini) $hora_ini = 01;
   	   if(!$hora_fin) $hora_fin = date("H");
	   if(!$minutos_ini) $minutos_ini = 01;
   	   if(!$minutos_fin) $minutos_fin = date("i");
	   if(!$segundos_ini) $segundos_ini = 01;
   	   if(!$segundos_fin) $segundos_fin = date("s");
	?>

	<select name=hora_ini class=e_cajas>
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
      </select>:<select name=minutos_ini class=e_cajas>
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
    <TD height="26" class='grisCCCCCC'>Dependencia</TD>
    <TD valign="top">
	<?
	include "$ruta_raiz/config.php";
	ora_commiton($handle);
	error_reporting(7);
	$cursor = ora_open($handle);
	$isql = "select depe_codi,depe_nomb from DEPENDENCIA 
		where DEPE_CODI_TERRITORIAL=$depe_codi_territorial
		ORDER BY DEPE_CODI";
	ora_commiton($handle);	
	$cursor = ora_open($handle);	
	ora_parse($cursor,$isql);
	ora_exec($cursor);
	$numerot = ora_numrows($cursor);
	$row1 = array();
	$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	// Combo en el que se muestran las dependencias, en el caso  de que el usuario escoja reasignar.
	?>
<select name='dep_sel' class='ebuttons2' >
<?
	$dependencianomb=substr($dependencianomb,0,35);
	$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	DO
	{
		$depcod = $row1["DEPE_CODI"];
		$lista_depcod .= " $depcod,";
		$depdes = substr($row1["DEPE_NOMB"],0,35);
		IF ($depcod==$dep_sel){
			$datosdep = " selected ";
		}else {$datosdep="";}
		echo "<option value=$depcod $datosdep>$depcod - $depdes</option>";
		}while($result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
		IF ($dep_sel=='9999'){
			$datosdep = " selected ";
		}else {$datosdep="";}
		$lista_depcod .= " $dependencia ";
		?>
		<option value='9999' '<?=$datosdep?>'> ---  Todas las Dependencias  --- </option>
</select>
  </TR><tr>
   </tr><tr><td height="26" colspan="2" valign="top" class='grisCCCCCC'> <center>		<INPUT TYPE=SUBMIT name=devolver_rad Value=' VISTA PRELIMINAR ' class=ebuttons2>      </center></td>
  </tr>
</TABLE>
<?php
error_reporting(7);
if(($devolver_rad or $devolver_dependencias) and $fecha_busq)
{
	$fecha_busqt = $fecha_busq . " $hora_ini:$hora_fin";
	if ($dep_sel == '9999') $dep_sel = "";
	$isql = "select  count(*) Numero
		from ANEXOS
		where sgd_fech_impres <= TO_DATE('$fecha_busqt','yyyy-mm-dd HH24:MI:ss')
			and  ANEX_ESTADO=3 
			and radi_nume_salida like '2004$dep_sel%'
			and sgd_deve_codigo is null 
			and substr(radi_nume_salida,5,3) in ($lista_depcod)";
	ora_commiton($handle);
	$cursor = ora_open($handle);
	ora_parse($cursor,$isql);
	ora_exec($cursor);
	$empresas_envio = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	$anexos_act = ora_numrows($cursor);
	if ($row["NUMERO"])
	die('echo "<hr>Debe seleccionar Registros para realizar Devolución</hr>
	<script>alert('Debe seleccionar Registros para realizar Devolucion');</script>                          
	"');
	echo "</p> <table border='0' class=timpar width=80%><tr></tr><td class=etexto>Registros Encontrados : ".$row["NUMERO"] . "</td></tr></table>";
	$isql = "select  a.radi_nume_salida
			,a.anex_radi_nume
			,round((sysdate - a.sgd_fech_impres),1) t_espera
		from ANEXOS a
		where
		a.sgd_fech_impres <= TO_DATE('$fecha_busqt','yyyy-mm-dd HH24:MI:ss')
		and a.ANEX_ESTADO=3
		and a.sgd_deve_codigo is null
		and radi_nume_salida like '2004$dep_sel%'
		and substr(radi_nume_salida,5,3) in ($lista_depcod)
	";
	ora_commiton($handle);
	$cursor = ora_open($handle);
	ora_parse($cursor,$isql);
	ora_exec($cursor);
	echo "<p><span class=etexto>RADICADOS ENVIADOS A CORRESPONDENCIA ANTES DE $fecha_busqt </p><table class='celdaGris'> </span>";
	echo "<tr class=tituloListado><th width=100>Numero Radicacion</th><TH width=100>Dependencia</TH><TH width=100>Fecha Devolucion</TH><TH width=100>Usuario que Realiza la Devolucion</TH><TH width=100>Tiempo de Espera (Dias)</TH></tr>";
	while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	{
		echo "<tr class=timpar> <td class=t_bordegris  >
		     " . $row["RADI_NUME_SALIDA"] . "
			 </td><td class=t_bordegris>" . substr($row["RADI_NUME_SALIDA"],4,3) . 
 			 "</td><td class=t_bordegris>" . date("Y-m-d H:i:s") . 
			 "</td><td class=t_bordegris>" . $usua_nomb . 
			 " </td><td class=t_bordegris>" . $row["T_ESPERA"] . " </td>
			 </tr>";
	}
	echo "</table>";
	if(!$devolver_dependencias)
	{
     ?>
	  <span class=etexto></span>
	  <br>
	  <input type=SUBMIT name='devolver_dependencias'  value = 'CONFIRMAR DEVOLUCION' class=ebuttons2>
	  <?php
	 }
     else
	 {
		$isql = "select  a.radi_nume_salida
		, a.anex_radi_nume
		, a.sgd_dir_tipo
		,round((sysdate - a.sgd_fech_impres),1) t_espera
		from ANEXOS a
		where
		a.sgd_fech_impres <= TO_DATE('$fecha_busqt','yyyy-mm-dd HH24:MI:ss')
		and a.ANEX_ESTADO=3  and sgd_deve_codigo is null 
		and substr(radi_nume_salida,5,3) in ($lista_depcod) ";
		ora_commiton($handle);
		$cursor = ora_open($handle);
		ora_parse($cursor,$isql);
		ora_exec($cursor);
		while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
		{
		$radicado_dev = $row["RADI_NUME_SALIDA"];
		$anex_radi_nume = $row["ANEX_RADI_NUME"];
		$sgd_dir_tipo = $row["SGD_DIR_TIPO"];
		$t_espera = $row["T_ESPERA"];
		$msg_copia = "";
		if($sgd_dir_tipo>="7") $msg_copia = "(" . (substr($sgd_dir_tipo,1,2) - 1) . ")";
		$isql = "update ANEXOS
			set anex_estado=2,
			sgd_deve_codigo=99
			where ANEX_ESTADO=3 AND anex_radi_nume=$anex_radi_nume
			 and sgd_deve_codigo is null 
			 and substr(radi_nume_salida,5,3) in ($lista_depcod)";
		ora_commiton($handle);
		$cursor1 = ora_open($handle);
		ora_parse($cursor1,$isql);
		ora_exec($cursor1);
		$anexos_act = ora_numrows($cursor1);
		$observa = "<span class=timpar>Devolucion de rad No $radicado_dev $msg_copia por sobrepasar tiempo de espera para envio ($t_espera Dias).</span>";
		$isql_hl= "insert into hist_eventos(DEPE_CODI   ,HIST_FECH,USUA_CODI  ,RADI_NUME_RADI  ,HIST_OBSE,USUA_CODI_DEST,USUA_DOC)
		values ($dependencia,sysdate  ,$codusuario,$anex_radi_nume ,'$observa','','$usua_doc')";
		ora_commiton($handle);
		$cursor1 = ora_open($handle);
		ora_parse($cursor1,$isql_hl);
		ora_exec($cursor1);
		$anexos_act = ora_numrows($cursor1);
		}
	}
}
?>
</form>
</html>
