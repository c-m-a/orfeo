<?php
		 session_start();
		 $ruta_raiz = "..";
	     include "../rec_session.php";
		 if(!$fecha_busq) $fecha_busq=date("Y-m-d");
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
//--></script>
  <form name="new_product"  action='generar_envio.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah"?>' method=post>
<center>
<TABLE width="450" class="t_bordeGris">
  <!--DWLayoutTable-->
  <TR>
    <TD width="125" height="21"  class='grisCCCCCC'> Fecha<br>
	<?
	  echo "(".date("Y-m-d").")";
	?>
	</TD>
    <TD width="225" align="right" valign="top">

        <script language="javascript">
		        dateAvailable.date = "2003-08-05";
			    dateAvailable.writeControl();
			    dateAvailable.dateFormat="yyyy-MM-dd";
    	  </script>

		  <script language="javascript">
			    dateAvailable2.writeControl();
			    dateAvailable2.dateFormat="yyyy-MM-dd";
    	  </script>
</TD>
  </TR>
  <TR>
    <TD height="26" class='grisCCCCCC'> Desde la Hora1</TD>
    <TD valign="top">
	<?
	   if(!$hora_ini) $hora_ini = 01;
   	   if(!$hora_fin) $hora_fin = date("H");
	   if(!$minutos_ini) $minutos_ini = 01;
   	   if(!$minutos_fin) $minutos_fin = date("i");
	   if(!$segundos_ini) $segundos_ini = 01;
   	   if(!$segundos_fin) $segundos_fin = date("s");
	?>

	<select name=hora_ini class=e_cajas>
        <?
			for($j=0;$j<=23;$j++)
			{
			if ($hora_ini==$j){ $datoss = " selected "; }else{ $datoss = " "; }
			
			?>
            <option value='<?=$j?>' '<?=$datoss?>'>
              <?=$j?>
            </option>
        <?
			}
			?>
      </select>:<select name=minutos_ini class=e_cajas>
        <?
			for($i=0;$i<=59;$i++)
			{
			if ($minutos_ini==$i){ $datoss = " selected "; }else{ $datoss = " "; }?>
        <option value='<?=$i?>' '<?=$datoss?>'>
        <?=$i?>
        </option
			>
        <?
			}
			?>
      </select>
      </TD>
  </TR>
  <Tr>
    <TD height="26" class='grisCCCCCC'> Hasta1</TD>
    <TD valign="top"><select name=hora_fin class=e_cajas>
        <?
			for($i=0;$i<=23;$i++)
			{
			if ($hora_fin==$i){ $datoss = " selected "; }else{ $datoss = " "; }?>
        <option value='<?=$i?>' '<?=$datoss?>'>
        <?=$i?>
        </option
			>
        <?
			}
			?>
      </select>:<select name=minutos_fin class=e_cajas>
        <?
			for($i=0;$i<=59;$i++)
			{
			if ($minutos_fin==$i){ $datoss = " selected "; }else{ $datoss = " "; }?>
        <option value='<?=$i?>' '<?=$datoss?>'>
        <?=$i?>
        </option
			>
        <?
			}
			?>
      </select>
      </TD>
  </TR>
  <tr>
    <TD height="26" class='grisCCCCCC'>Tipo de Salida</TD>
    <TD valign="top" align="left">
	<select name=tipo_envio class=e_cajas onClick='submit();' >
	<?
	   $codigo_envio="101";
	   $datoss = "";
	   if($tipo_envio==1)
	     {
		  $datoss = " selected ";
		  $codigo_envio = "101";
		 }
	?>
	<option value=1 '<?=$datoss?>'>CERTIFICADO - Planillas</option>
	<?
	   $datoss = "";
	   if($tipo_envio==2)
	     {
		    $datoss = " selected ";
			$codigo_envio = "105";
		 }
	?>
	<option value=2 '<?=$datoss?>'>POSTEXPRESS - Guias</option>
	</select>
 	</TD>
  </tr>
 <tr>
    <TD height="26" class='grisCCCCCC'>Numero de Planilla</TD>
    <TD valign="top" align="left"><input type=text name=no_planilla value='<?=$no_planilla?>' |class=e_cajas size=20 class="ecajasfecha">
    <?
	    $fecha_mes = substr($fecha_busq,0,7);
		// conte de el ultimo numero de planilla generado.
        $isql_count = "select sgd_renv_planilla, sgd_renv_fech from sgd_renv_regenvio
		 		WHERE DEPE_CODI=$dependencia AND
				TO_CHAR(SGD_RENV_FECH , 'YYYY-MM') = '$fecha_mes'
				and sgd_renv_planilla is not null and sgd_fenv_codigo = $codigo_envio
				order by SGD_RENV_PLANILLA desc, sgd_renv_fech desc  ";
	   require "../jh_class/funciones_bd.php";
	   $kk = new BD($isql_count,0,"..") ;
	   $planilla_ant = $kk->campo;
	   $kk = new BD($isql_count,1,"..") ;
	   $fecha_planilla_ant = $kk->campo;
	   if($codigo_envio=="101")
	   {
	      echo "<br><span class=etexto>Ultima planilla generada : <b> $planilla_ant </b> Fec:$fecha_planilla_ant";
		}
		else
		{
		  //echo "<br><span class=etexto>Ultima Guia generada : <b> $planilla_ant </b> Fec:$fecha_planilla_ant";
		}
		// Fin conteo planilla generada

	?>


	</TD>
  <tr>
    <td height="26" colspan="2" valign="top" class='grisCCCCCC'> <center>
		<INPUT TYPE=SUBMIT name=generar_listado_existente Value=' Generar Plantilla existente ' class=ebuttons2>
		</td>
	</tr>
	<tr><td height="26" colspan="2" valign="top" class='grisCCCCCC'> <center>
        <INPUT TYPE=SUBMIT name=generar_listado Value=' Generar Nuevo Envio ' class=ebuttons2>
      </center></td>
  </tr>
</TABLE>
      </form>
<?php
    if(!$fecha_busq) $fecha_busq = date("Y-m-d");
	if($generar_listado or $generar_listado_existente)
	{
		if($tipo_envio==1)
		{
		if($generar_listado_existente)  $generar_listado = "Genzzz";
		include "./listado_planillas.php";
		echo "<p><CENTER><span class=etexto>FECHA DE BUSQUEDA $fecha_busq</span>";
		}
		if($tipo_envio==2)
		{
		include "./listado_guias.php";
		echo "<p><CENTER><span class=etexto>FECHA DE BUSQUEDA $fecha_busq </span>";
		}
    }
?>
