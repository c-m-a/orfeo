<?php
session_start();
error_reporting(0);
$ruta_raiz = "..";
include "../rec_session.php";
$encabezado_i = "estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&pagina_sig=$pagina_sig&dep_sel=$dep_sel&krd=$krd";
?>
<head>
<link rel="stylesheet" href="../estilos_totales.css">
</head>
<BODY>
<center><span class=etexto> <a href="cuerpo_envio.php?<?=$encabezado_i?>&<?=session_name().'='.session_id()."&devolucion=1"?>"> Devolver al Listado 
 </a></span></CENTER>
<p><CENTER><b><span class="etexto">DEVOLUCION DE DOCUMENTOS<p></CENTER>
<div id="spiffycalendar" class="text"></div>
<form name="new_product"  action='dev_corresp_otras.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&$encabezado_i"?>' method=post><center>
<?
if(!$devolver_rad or !$motivo_devol)
{
?>
<TABLE width="350" class="t_bordeGris">
  <TR>
    <TD width="125" height="21"  class='grisCCCCCC'>Tipo de Devolucion<br>
	</TD>
    <TD width="225" align="right" valign="top">
<select name ="motivo_devol" class="ecajasfecha" >
<option value="">----- Escoja un Motivo -----</option>
<?php
	/*  Este codigo realiza el select de tipo de devolucion
	*/
	error_reporting(7);
	$isql = "select SGD_DEVE_CODIGO,SGD_DEVE_DESC
		from SGD_DEVE_DEV_ENVIO
		WHERE SGD_DEVE_CODIGO < 99
		ORDER BY SGD_DEVE_CODIGO ";
	$sim = 0;
	$cursor = ora_open($handle);
	ora_parse($cursor,$isql) ;
	ora_exec($cursor);
	$numerot = ora_numrows($cursor);
	$row = array();
	ora_fetch($cursor);
	do
	{
		$codigo=trim(ora_getcolumn($cursor, 0));
		$descripcion=trim(ora_getcolumn($cursor, 1));
		if($motivo_devol==$codigo)
		{
		$datos=" selected ";
		}
		else
		{
			$datos = "";
		}
		echo  "<option value='$codigo' $datos>$codigo - $descripcion</option>";
	}while(ora_fetch($cursor));
$municodi="";$muninomb="";$depto="";
?>
</select>
   </TD>
  </TR>
  <TR>
    <TD height="26" class='grisCCCCCC'>Comentarios</TD>
    <TD valign="top">
	<input type=text name=comentarios_dev value='<?=$comentarios_dev?>' clas=e_texto size=70>
    </TD>
  </TR><tr>
   </tr><tr><td height="26" colspan="2" valign="top" class='grisCCCCCC'> <center>
     <input type=SUBMIT name='devolver_rad'  value = 'CONFIRMAR DEVOLUCION' class=ebuttons2></center></td>
  </tr>
</TABLE>
<?php
}else
{
	error_reporting(7);
	$isql = "select SGD_DEVE_DESC
		from SGD_DEVE_DEV_ENVIO
		WHERE SGD_DEVE_CODIGO = $motivo_devol
		";
	$sim = 0;
	$cursor = ora_open($handle);
	ora_parse($cursor,$isql) ;
	ora_exec($cursor);
	ora_fetch($cursor);
	$motivo = ora_getcolumn($cursor, 0);
}
error_reporting(7);
			/* Procediminiento que recorre el array de valores de radicdos a devolver.....
			 */
if(!$radicados_dev and !$check_value)
die("<hr><span class=etexto>Debe seleccionar un Radicado para realizar la devolucion de documentos</span><hr>
     <script>alert('Debe seleccionar un Radicado para realizar la devolucion de documentos');</script>");
if(!$radicados_dev  or !$motivo_devol)
{
	$num = count($check_value);
	$i = 0;
	while ($i < $num)
	{
	 $record_id = key($check_value);
	 if ($check_value[$record_id] == "devolver") 
	 {
		$radicados_dev .= $record_id .",";
	 }
	next($check_value);
	$i++;
	}
	$radicados_dev = str_replace("-","",$radicados_dev);
	$radicados_dev .= "9999";
}
echo "<input type=hidden name=radicados_dev value='$radicados_dev'>";
  for($iii=0; $iii<=20 and $radicados_sel[$iii]; $iii++)
  {
    $radicados_dev .= trim($radicados_sel[$iii]).",";
  }
  $radicados_dev .=  "9999";
  $i = $iii;
if($motivo_devol)
	{
	$isql = "update sgd_renv_regenvio
		set
		sgd_deve_fech=sysdate,
		sgd_deve_codigo = $motivo_devol,
		sgd_renv_observa = substr(concat('$comentarios_dev -',sgd_renv_observa),0,199)
	where concat(radi_nume_sal,sgd_renv_codigo) in($radicados_dev)";
	ora_commiton($handle);
	$cursor1 = ora_open($handle);
	ora_parse($cursor1,$isql);
	ora_exec($cursor1);
	$anexos_act = ora_numrows($cursor1);
	echo "<br><span class=etexto>Se ha realizado la devolución de los siguientes registros enviados
				<br>";
}
$isql = "select a.*,b.radi_nume_deri from sgd_renv_regenvio a, radicado b
	 where concat(radi_nume_sal,sgd_renv_codigo) in($radicados_dev)
	      and a.radi_nume_sal=b.radi_nume_radi ";
require "$ruta_raiz/class_control/class_control.php";
$btt = new CONTROL_ORFEO("..");
echo "<span class=etexto>";
$campos_align = array("L"            ,"L"                 ,"L"                ,"C"             ,"L"           ,"L"             ,"L"            ,"C"                ,"R");
$campos_tabla = array("radi_nume_sal","sgd_dir_codigo"     ,"sgd_renv_planilla","sgd_renv_fech"    ,"sgd_renv_nombre","sgd_renv_dir","sgd_renv_depto","sgd_renv_mpio","sgd_renv_cantidad","sgd_renv_valor");
$campos_vista = array ("Radicado"    ,"Codigo Destinatario","Planilla"         ,"Fecha de envio"   ,"Destinatario"   ,"Direccion"   ,"Departamento"  ,"Municipio"    ,"Documentos"       ,"Valor Unitario");
$btt->campos_align = $campos_align;
$btt->campos_tabla = $campos_tabla;
$btt->campos_vista = $campos_vista;
$btt->tabla_sql($isql);
if($devolver_rad  and $motivo_devol)
{
if($motivo_devol != 0)
{
$btt->cursor->query($isql);
?>
<p><p><p>
<?
while($btt->cursor->next_record()) 
{
	$dir_tipo = $btt->cursor->f("sgd_dir_tipo");
	$radi_nume_salida = $btt->cursor->f("radi_nume_sal");
	$radi_nume_padre = $btt->cursor->f("radi_nume_deri");
	$isql = "update anexos
		set anex_estado=3, 
			sgd_deve_fech=sysdate,
			sgd_deve_codigo = $motivo_devol
		where sgd_dir_tipo=$dir_tipo
			and radi_nume_salida=$radi_nume_salida";
	ora_commiton($handle);
	$cursor1 = ora_open($handle);
	ora_parse($cursor1,$isql);
	ora_exec($cursor1);
	$anexos_act = ora_numrows($cursor1);
	$isql_hl= "insert 
	into hist_eventos(DEPE_CODI   ,HIST_FECH,USUA_CODI  ,RADI_NUME_RADI   ,HIST_OBSE         ,USUA_CODI_DEST,USUA_DOC   ,SGD_TTR_CODIGO)
	values ($dependencia, sysdate ,$codusuario,$radi_nume_salida,'Devolucion ($motivo). $comentarios_dev',''            ,'$usua_doc','9')";
	ora_commiton($handle);
	$cursor1 = ora_open($handle);
	ora_parse($cursor,$isql_hl);
	ora_exec($cursor);
	if($radi_nume_padre != $radi_nume_deri and  $radi_nume_padre)
	{
		$isql_hl= "insert 
		into hist_eventos(DEPE_CODI   ,HIST_FECH,USUA_CODI  ,RADI_NUME_RADI   ,HIST_OBSE         ,USUA_CODI_DEST,USUA_DOC   ,SGD_TTR_CODIGO)
		values ($dependencia, sysdate ,$codusuario,$radi_nume_padre,'Devolucion($radi_nume_salida, $motivo). $comentarios_dev',''            ,'$usua_doc','9')";
		ora_commiton($handle);
		$cursor1 = ora_open($handle);
		ora_parse($cursor,$isql_hl);
		ora_exec($cursor);
	}
}
}
 else {
	echo "<span class=etexto><b>No se actualizaron los registros <br>Debe seleccionar un tipo de devolución<br>";
	echo "<input type=hidden name=devolucion_rad value=si>";
}
}else
{
	echo "<span class=etexto><b> <br>Debe seleccionar un tipo de devolución<br>";
	echo "<input type=hidden name=devolucion_rad value=no>";
}
      ?>
</form>
</html>
