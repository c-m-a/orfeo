<?php
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			             */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                     */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel Pinz�n L�pez --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeaci�n"                                      */
/*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
?>
<?php
	session_start();
	error_reporting(7);
 	$ruta_raiz = "..";
	if(!$fecha_busqH) $fecha_busqH = date("Y-m-d");
	if(!$fecha_busq) $fecha_busq=date("Y-m-d");
	if (!$_SESSION['dependencia'])	include "../rec_session.php";
   	include_once  "../include/db/ConnectionHandler.php";
   	$db = new ConnectionHandler("..");	 
  	define('ADODB_FETCH_ASSOC',2);
   	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	if (!$dep_sel) $dep_sel = $_SESSION['dependencia'];
?>
<head>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body>
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript">
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "gen_listado", "fecha_busq","btnDate1","<?=$fecha_busq?>",scBTNMODE_CUSTOMBLUE);
  var dateAvailableH = new ctlSpiffyCalendarBox("dateAvailableH", "gen_listado", "fecha_busqH","btnDate1","<?=$fecha_busqH?>",scBTNMODE_CUSTOMBLUE);
</script>
<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>DOCUMENTOS LISTOS PARA SER ENTREGADOS EN CORRESPONDENCIA</center></td></tr></table>
<table><tr><td></td></tr></table>
<form name="gen_listado"  action='cuerpoListaImpresos.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_ini=$fecha_ini&indi_generar=indi_generar&dep_sel=$dep_sel&tip_radi=$tip_radi&fecha_h=$fechah&fecha_busq=$fecha_busq&fecha_busq2=$fecha_busq2"?>' method=post>
<center>
<TABLE width="450" class="borde_tab" cellspacing="5">
  <!--DWLayoutTable-->
      <TD width="125" height="21"  class='titulos2'> Fecha Desde <br>
	<?
	  echo "(".date("Y-m-d").")";
	?>
	</TD>
    <TD width="225" align="right" valign="top" class='listado2'>

        <script language="javascript">
		        dateAvailable.date = "2003-08-05";
			    dateAvailable.writeControl();
			    dateAvailable.dateFormat="yyyy-MM-dd";
    	  </script>
</TD>
  </TR>
  <TR>
    <td width="125" height="21"  class='titulos2'> Fecha Hasta <br>
	</td>
   <TD width="225" align="right" valign="top" class='listado2'>
    <script language="javascript">
		dateAvailableH.date = "2003-08-05";
		dateAvailableH.writeControl();
		dateAvailableH.dateFormat="yyyy-MM-dd";
    </script>
	</td>
  </tr>
  <tr>
    <td width="125" height="21"  class='titulos2'> Desde la Hora</td>
     <TD width="225" align="right" valign="top" class='listado2'>
	<?
	   if(!$hora_ini) $hora_ini = 01;
   	   if(!$hora_fin) $hora_fin = date("H");
	   if(!$minutos_ini) $minutos_ini = 01;
   	   if(!$minutos_fin) $minutos_fin = date("i");
	   if(!$segundos_ini) $segundos_ini = 01;
   	   if(!$segundos_fin) $segundos_fin = date("s");
	?>

	<select name=hora_ini class=select>
        <?
			for($i=0;$i<=23;$i++)
			{
			if ($hora_ini==$i){ $datoss = " selected "; }else{ $datoss = " "; }?>
            <option value='<?=$i?>' '<?=$datoss?>'>
              <?=$i?>
            </option>
        <?
			}
			?>
      </select>:<select name=minutos_ini class=select>
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
    </td>
  </tr>
  <tr>
    <TD height="26" class='titulos2'> Hasta</td>
	<TD valign="top" class='listado2'><select name=hora_fin class=select>
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
      </select>:<select name=minutos_fin class=select>
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
    </td>
  </tr>
  <tr>
    <TD height="26" class='titulos2'>Tipo de Radicacion</td>
    <td class="listado5"> 
    <?
	$ss_RADI_DEPE_ACTUDisplayValue = "--- Todos los Tipos ---";
	$valor = 0;
	$sqlD = "select SGD_TRAD_DESCR,sgd_trad_codigo from SGD_TRAD_TIPORAD where SGD_TRAD_CODIGO != '2' order by 1";
	$rsDep = $db->conn->Execute($sqlD);
	 print $rsDep->GetMenu2("tip_radi","$tip_radi",$blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0," class='select'");	
	?>
 </td>
  </tr>
 	</td>
    <tr>
       <td height="26" colspan="2" valign="top" class='titulos2'> 
	   <center>
	    <INPUT TYPE=SUBMIT name=generar_listado Value=' Generar ' class=botones_funcion>
	   <INPUT TYPE=submit name=cancelarAnular value=Cancelar class=botones_funcion>
    </td></tr>
</table>
<?php

if(!$fecha_busq) $fecha_busq = date("Y-m-d");
if(!$fecha_busqH) $fecha_busqH = date("Y-m-d");

?>
</form>
