<?php
		 session_start();
		 error_reporting(0);
		 $ruta_raiz = "..";
	     include "$ruta_raiz/rec_session.php";
		 require_once("$ruta_raiz/include/combos.php");
?>
<head>
<link rel="stylesheet" href="../estilos_totales.css">
</head>
<BODY>
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script><script language="javascript">
    var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable","new_product","fecha_busq","btnDate1","<?=$fecha_busq?>",scBTNMODE_CUSTOMBLUE);
</script>
<form name="new_product"  action='dev_corresp.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah"?>' method=post><center>
<TABLE width="350" class="t_bordeGris">
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
        </option
			>
        <?php
			}
			?>
      </select>
      </TD>
  </TR>
    <TR>
    <TD height="26" class='grisCCCCCC'> Dependencia</TD>
    <TD valign="top">
<select name ="dependencia_sel" class="ecajasfecha" id="select" >
      <option value="0">----- Todas -----</option>
      <?php
                        // if($si!=1){include "../include/in_sel.inc";
						error_reporting(7);
						$a = new combo;
                      	$s = "select * from DEPENDENCIA";
                        $r = "depe_codi";
						$t = "depe_nomb";
						$v = $dependencia_sel;
					    $sim = 0;
                       // $v = $p_dpa_cod_depto;
                        $a->conectar($s,$r,$t,$v,$sim);

       ?>
    </select>
	</TD>
  </TR>
    <TR>
    <TD height="26" class='grisCCCCCC'>Motivo Devolución</TD>
    <TD valign="top">
<select name ="motivo_devol" class="ecajasfecha" >
      <option value="0">----- Todas -----</option>
      <?php
                        // if($si!=1){include "../include/in_sel.inc";
						error_reporting(7);
						$a = new combo;

                      	$s = "select * from SGD_DEVE_DEV_ENVIO";
                        $r = "sgd_deve_codigo";
						$t = "sgd_deve_desc";
						$v = $motivo_devol;
					    $sim = 0;
                       // $v = $p_dpa_cod_depto;
                        $a->conectar($s,$r,$t,$v,$sim);

       ?>
    </select>
	</TD>
  </TR>
      <TR>
    <TD height="26" class='grisCCCCCC'>Radicados a Devolver (Separados por Coma)</TD>
    <TD valign="top">
		<input type="text" name="radicados_dev" value='<?=$radicados_dev?>' >
	</TD>
  </TR>
   <tr><td height="26" colspan="2" valign="top" class='grisCCCCCC'> <center>		<INPUT TYPE=SUBMIT name=devolver_rad Value=' DEVOLVER ' class=ebuttons2>      </center></td>
  </tr>

</TABLE>
<?php
error_reporting(7);
if(($devolver_rad or $devolver_dependencias) and $fecha_busq)
{
			$fecha_busqt = $fecha_busq . " $hora_ini:$hora_fin";
			$isql = "select  count(*) AS NUMERO
			     	from ANEXOS
		            where sgd_fech_impres <= TO_DATE('$fecha_busqt','yyyy-mm-dd HH24:MI:ss')
					and  ANEX_ESTADO=3";
			ora_commiton($handle);
			$cursor = ora_open($handle);
			ora_parse($cursor,$isql);
			ora_exec($cursor);
			$empresas_envio = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
			$anexos_act = ora_numrows($cursor);
			echo "</p> <table border='0' class=timpar><tr></tr><td class=t_bordegris>Registros Encontrados : ".$row["NUMERO"] . "</td></tr></table>";
			$isql = "select  b.depe_codi, count(*) AS NUMERO
			 			from ANEXOS a, usuario b
						where
						a.anex_creador=b.usua_login
						and a.sgd_fech_impres <= TO_DATE('$fecha_busqt','yyyy-mm-dd HH24:MI:ss')
						and a.ANEX_ESTADO=3 group by b.depe_codi ";
			ora_commiton($handle);
			$cursor = ora_open($handle);
			ora_parse($cursor,$isql);
			ora_exec($cursor);
			echo "<p><span class=timpar>REGISTRO POR DEPENDENCIA DE DOCUMENTOS EMVIADOS A CORRESPONDENCIA ANTES DE $fecha_busqt </p><table class='celdaGris'> </span>";
			echo "<tr class=tituloListado><th>Dependencia</th><TH>Documentos</TH></tr>";
			while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
			{
			echo "<tr class=timpar> <td class=t_bordegris  >".$row["DEPE_CODI"] . "</td><td class=t_bordegris>" . $row["NUMERO"] . " </td></tr>";
			}
			echo "</table>";
	if(!$devolver_dependencias)
	{
     ?>
	  <span class=etexto>Si esta seguro de devolver estos documentos por favaor haga clik aqui</span>
	  <input type=SUBMIT name='devolver_dependencias'  value = 'Confirmar Devolución' class=ebuttons2>
	  <?php
	 }
     else
	 {
			$isql = "select  a.radi_nume_salida, a.anex_radi_nume
			from ANEXOS a, usuario b
			where
				a.anex_creador=b.usua_login
				and a.sgd_fech_impres <= TO_DATE('$fecha_busqt','yyyy-mm-dd HH24:MI:ss')
				and a.ANEX_ESTADO=3";
			if($dependencia!=0)
			{
				$isql .= " and b.depe_codi=$dependencia_sel";
			}

			ora_commiton($handle);
			$cursor = ora_open($handle);
			ora_parse($cursor,$isql);
			ora_exec($cursor);
			while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
			{
				$radicado_dev = $row["RADI_NUME_SALIDA"];
				$anex_radi_nume = $row["ANEX_RADI_NUME"];
				$isql = "update ANEXOS
					set anex_estado=2
					where ANEX_ESTADO=3 AND anex_radi_nume=$anex_radi_nume";
					ora_commiton($handle);
					$cursor1 = ora_open($handle);
					ora_parse($cursor1,$isql);
					ora_exec($cursor1);
					$anexos_act = ora_numrows($cursor1);
					$observa = "Devolucion de radicado No $radicado_dev Se devolvio por sobrepasar tiempo de espera para envio";
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
