<?
session_start();
$ruta_raiz = "..";
if (!$dependencia)   include "../rec_session.php";
?>

<html>
<head>
  <meta http-equiv="Cache-Control" content="cache">
  <meta http-equiv="Pragma" content="public">
<?
$fechah=date("dmy") . "_". time("h_m_s");
$encabezado = session_name()."=".session_id()."&krd=$krd&devolucion=$devolucion&busq_radicados=$busq_radicados";
?>
<script>
function back() {
    history.go(-1);
}
   function sel_dependencia()
   {
      document.write("<form name=forma_b_correspondencia action='cuerpo_envio.php?<?=$encabezado?>'  method=post>");
	  depsel = form1.dep_sel.value ;
	  document.write("<input type=hidden name=depsel value="+depsel+">");
	  document.write("<input type=hidden name=estado_sal  value=3>");
	  document.write("<input type=hidden name=estado_sal_max  value=3>");
	  document.write("<input type=hidden name=fechah value='<?=$fechah?>'>");
	  document.write("</form>");
	  forma_b_correspondencia.submit();
   }
   function recuperar_rad(norad_padre,rad_salida)
   {
    document.form1.archivar_radicado.value = norad_padre;
    alert("-->" + norad_padre);
	  form1.submit();
   }
</script>
<?php
   error_reporting(7);
  ?>
<link rel="stylesheet" href="../estilos_totales.css">
<?PHP
 if(!$estado_sal)   {$estado_sal=2;}
 if(!$estado_sal_max) $estado_sal_max=3;
  if($estado_sal==4)
  {
    if($devolucion==1)
	{
		$accion_sal = "Devolución de Documentos";
		$pagina_sig = "dev_corresp_otras.php";
		$dev_documentos = "";
		$nomcarpeta="Devolucion de Documentos";
		$dependencia_busq1 .= " sgd_deve_codigo is null and  ";
	}
	if($devolucion==2)
	{
		$accion_sal = "Cerrar Envio";
		$pagina_sig = "devolucion_otras.php";
		$nomcarpeta="Documentos Devueltos por Agencia de Correo";
    $dev_documentos = "Sip";
		$dependencia_busq1 .= " sgd_deve_codigo is not null and  ";
	}
	if($devolucion==3)
	{
		$accion_sal = "Modificar Envio";
		$pagina_sig = "envio_mod.php";
        $nomcarpeta="Documentos Marcados para envio";
        $dev_documentos = "";
		//$dependencia_busq1 .= " sgd_deve_codigo is not null and  ";
    
	}
	if(!$dep_sel) $dep_sel = $dependencia;
	$dependencia_busq1 .= " radi_nume_sal like '2004$dep_sel%'";
  }
if($busq_radicados)
{
    $busq_radicados = trim($busq_radicados);
    $textElements = split (",", $busq_radicados);
    $newText = "";
    $i = 0;
    foreach ($textElements as $item)
    {
         $item = trim ( $item );
         if ( strlen ( $item ) != 0 )
		 { //$sec = str_pad($item,7,"0",STR_PAD_left);
		   //$item = date("Y") . $dep_sel . $sec;
		   $i++;
		   if ($i != 1) $busq_and = " and "; else $busq_and = " ";
		   $busq_radicados_tmp .= " $busq_and radi_nume_sal like '%$item%' ";
		   
		  }
     }
	 //if(substr($busq_radicados_tmp,-1)==",")   $busq_radicados_tmp = substr($busq_radicados_tmp,0,strlen($busq_radicados_tmp)-1);
	 $dependencia_busq1 = " $busq_radicados_tmp ";
}else
{
   $sql_masiva = " and a.sgd_renv_planilla != '00' ";
   $sql_masiva = "";
}
$tbbordes = "#CEDFC6";
$tbfondo = "#FFFFCC";
if(!$orno){$orno=1;}
$imagen="flechadesc.gif";
?>
<script>
<!-- Esta funcion esconde el combo de las dependencia e inforados Se activan cuando el menu envie una señal de cambio.-->
 
function window_onload()

{

   form1.depsel.style.display = '';
   form1.enviara.style.display = '';
   form1.depsel8.style.display = 'none';
   form1.carpper.style.display = 'none';
   setVariables();
  setupDescriptions();
}
<!-- Cuando existe una señan de cambio el program ejecuta esta funcion mostrando el combo seleccionado -->
function changedepesel()
{
  form1.depsel.style.display = 'none';
  form1.carpper.style.display = 'none';
  form1.depsel8.style.display = 'none';
  if(form1.enviara.value==10)
  {
    form1.depsel.style.display = 'none';
	form1.carpper.style.display = '';
	form1.depsel8.style.display = 'none';
  }
  if(form1.enviara.value==9 )
  {
    form1.depsel.style.display = '';
	form1.carpper.style.display = 'none';
	form1.depsel8.style.display = 'none';
  }  
 if(form1.enviara.value==8 )
  {
  form1.depsel.style.display = 'none';
	form1.depsel8.style.display = '';
	form1.carpper.style.display = 'none';
  }  
}
<!-- Funcion que activa el sistema de marcar o desmarcar todos los check  -->
function markAll()
{
if(document.form1.elements['marcartodos'].checked)
	for(i=4;i<document.form1.elements.length;i++)
	document.form1.elements[i].checked=1;
else
  for(i=4;i<document.form1.elements.length;i++)
  	document.form1.elements[i].checked=0;
}
<?php
   //include "libjs.php";
	 function tohtml($strValue)
{
  return htmlspecialchars($strValue);
}
?>
</script>
<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
</head>

<body bgcolor="#FFFFFF" topmargin="0" >
<div id="object1" style="position:absolute; visibility:show; left:10px; top:-50px; width=80%; z-index:2" >
  <p>Cuadro de Historico</p>
</div>
<?php
 /*
 PARA EL FUNCIONAMIENTO CORRECTO DE ESTA PAGINA SE NECESITAN UNAS VARIABLE QUE DEBEN VENIR
 carpeta  "Codigo de la carpeta a abrir"
 nomcarpeta "Nombre de la Carpeta"
 tipocarpeta "Tipo de Carpeta  (0,1)(Generales,Personales)"
 seleccionar todos los checkboxes
*/
    include "../config.php";
		 $img1="";$img2="";$img3="";$img4="";$img5="";$img6="";$img7="";$img8="";$img9="";
         IF($ordcambio){IF($ascdesc=="" ){$ascdesc="DESC";	$imagen="flechadesc.gif";}else{$ascdesc="";$imagen="flechaasc.gif";}}
		 if($orno==1){$order=" radi_nume_sal $ascdesc";$img1="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 if($orno==2){$order=" sgd_renv_fech $ascdesc";$img2="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 if($orno==3){$order=" sgd_renv_planilla $ascdesc";$img3="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 if($orno==4){$order=" sgd_renv_nombre $ascdesc";$img4="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 if($orno==5){$order=" sgd_renv_dir $ascdesc";$img5="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 if($orno==6){$order=" sgd_renv_depto $ascdesc";$img5="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 if($orno==7){$order=" sgd_renv_mpio $ascdesc";$img5="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 if($orno==8){$order=" sgd_fenv_descrip $ascdesc";$img5="<img src='../iconos/$imagen' border=0 alt='$data'>";}

  $datosaenviar = "fechaf=$fechaf&tipo_carp=$tipo_carp&ascdesc=$ascdesc&orno=$orno";
  $encabezado = session_name()."=".session_id()."&dep_sel=$dep_sel&krd=$krd&estado_sal=$estado_sal&fechah=$fechah&estado_sal_max=$estado_sal_max&ascdesc=$ascdesc&devolucion=$devolucion&busq_radicados=$busq_radicados&orno=";
    $fechah=date("dmy") . "_". time("h_m_s");

	ora_commiton($handle);
	$cursor = ora_open($handle);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
    $numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
    $isql = "select * From usuario where  USUA_LOGIN ='$krd' and USUA_SESION='". substr(session_id(),0,29)."' ";
	$resultado = ora_parse($cursor,$isql);
	$resultado = ora_exec($cursor);
	$row=array();
  ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	// Validacion de Usuario y COntraseña MD5
	//echo "** $krd *** $drde";
  if (trim($row["USUA_LOGIN"])==trim($krd))
		{


		$nombusuario =$row["USUA_NOMB"];
		$contraxx=$row["USUA_PASW"];

		$nivelus=$row["CODI_NIVEL"];
		if($row["USUA_NUEVO"]=="1"){
				?>


<br>
<table border=0 width='100%' class='t_bordeGris' align='center' bgcolor="#CCCCCC">
  <tr >
    <td height="20" >

          <?php
	     /** Instruccion que realiza la consulta de radicados segun criterios
		   * Tambien observamos que se encuentra la varialbe $carpetaenviar que maneja la carpeta 11.
		   */
	$limit = "";
	$isql = "select sgd_renv_planilla
			,a.sgd_renv_fech
			,a.radi_nume_sal
			,a.sgd_dir_tipo
			,a.sgd_renv_nombre
			,a.sgd_renv_dir
			,a.sgd_renv_mpio
			,a.sgd_renv_depto
			,a.sgd_renv_cantidad
			,a.sgd_renv_valor
			,a.sgd_renv_codigo
			,b.sgd_fenv_descrip
			,TO_CHAR(SGD_RENV_FECH,'DD/MM/YY HH:MIam') AS  FECHA_ENVIO
		from sgd_renv_regenvio a,
			sgd_fenv_frmenvio b
		where
			$dependencia_busq1
			$dependencia_busq2
			and a.sgd_fenv_codigo (+) = b.sgd_fenv_codigo
			and a.sgd_renv_estado<8
			and rownum < 550
			$sql_masiva		
      order by $order ";
	?>
      <table BORDER=0  cellpad=2 cellspacing='0' WIDTH=98% class='t_bordeGris' valign='top' align='center' >
          <TR >
            <TD width='35%' >
              <table width='100%' border='0' cellspacing='1' cellpadding='0'>
                <tr> <?
	     IF($nomcarpeta=="")
			 {
			      $nomcarpeta="Documentos Devueltos por Empresa de Envio ";
			 }

  ?>
                  <td height="20" class="celdaGris"><img src="../imagenes/listado.gif" width="85" height="20"></td>
                </tr><tr>
                  <td height="20" class="tituloListado"><span class="etextomenu"><?=$nomcarpeta ?>
                    </span></td>
                </tr>
              </table>
            </td>
            <TD width='32%'  >
              <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td width="10%" class="celdaGris" height="20"><img src="../imagenes/usuario.gif" width="58" height="20"></td>
                </tr><tr>
                  <td width="90%" heiras Devoluciones ght="20"><span class='etextomenu'><?=$nombusuario ?></span></td>
                </tr>
              </table>
            </td>
            <td height="37" width="33%">
              <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td width="16%" class="celdaGris" height="20"><img src="../imagenes/dependencia.gif" width="87" height="20"></td>
                </tr><tr>
                  <td width="84%" height="20"><span class='etextomenu'>
<?
		if($estado_sal>=3)
			{
				ora_commiton($handle);
				$cursor = ora_open($handle);
				ora_parse($cursor,"select depe_codi,depe_nomb from DEPENDENCIA ORDER BY DEPE_CODI");
				ora_exec($cursor);
				$numerot = ora_numrows($cursor);
				$row1 = array();
				$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
				// Combo en el que se muestran las dependencias, en el caso  de que el usuario escoja reasignar.
				?>
			<FORM name=form_busq_dep action='cuerpo_envio.php?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&devolucion=<?=$devolucion?>' method=post>
<select name='dep_sel' class='ebuttons2' onChange='submit();' >
<?
	$dependencianomb=substr($dependencianomb,0,35);
	$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	DO
		{
			$depcod = $row1["DEPE_CODI"];
				$depdes = substr($row1["DEPE_NOMB"],0,35);
				IF ($depcod==$dep_sel){
					$datosdep = " selected ";
				}else {$datosdep="";}
			if($devolucion!=2 or $depcod==$dep_sel)
				{
				echo "<option value=$depcod $datosdep>$depcod - $depdes</option>\n";
				}
				}while($result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
		?>
</select>
</FORM>
<?
		}else {echo "$depe_nomb";}
?>
                    </span></td>
                </tr>
              </table>
            </TD>
          </tr>
        </table>
<TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
          <tr>
			<td>
			</td>
		  </tr>
	 </table>
 <TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
          <tr>
            <TD class="grisCCCCCC" >
<FORM name=form_busq_rad action='cuerpo_envio.php?<?=session_name()."=".session_id()."&krd=$krd"?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>&devolucion=<?=$devolucion?>' method=post>
  Buscar radicado(s) (Separados por coma)<input name="busq_radicados" type="text" size="70" class="ecajasfecha" value="<?=$busq_radicados?>">
  <input type=submit value='Buscar ' name=Buscar valign='middle' class='ebuttons2'>
</form>
			</td>
		  </tr>
</table>
<form name='form1' action='<?=$pagina_sig?>?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max" ?>' method=post>
    <INPUT TYPE=hidden name=encabezado_i value='<?=$encabezado?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>'>
   <input type=hidden name=archivar_radicado value = "">
        <TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
          <tr>
            <TD class="grisCCCCCC" height="58">
              <table BORDER=0  cellpad=2 cellspacing='2' WIDTH=98% class='t_bordeGris' valign='top' align='center' cellpadding="2" >
                <tr bgcolor="#CCCCCC">
                  <td width='30%' align='left' height="40" class="grisCCCCCC"  >Listar por <br>
				  <a href='cuerpo_envio.php?<?=$encabezado?>7&ordcambio=1' alt='Ordenar Por Leidos'><span class='tpar'>Impresos</span></a>
                    <?=$img7 ?> <a href='cuerpo_envio.php?<?=$encabezado?>8&ordcambio=1' class="tparr" alt='Ordenar Por Leidos'><span class='tparr'>
                    Por Imprimir</span></a></td>
					<td width='25%' align='left' height="40" >&nbsp;</td>
                    <td width='5%' align="left">
                    <input type=submit value='<?=$accion_sal ?>' name=Enviar valign='middle' class='ebuttons2'>
			      </td>

                </TR>
              </TABLE>
            </td>
          </tr>
          <tr>
            <td class="grisCCCCCC"> <?
	  ora_parse($cursor,$isql);
	ora_exec($cursor);
	$row = array();
	// Encabezado de la lista de documentos
	// Cada encabezado tiene un href que permite recargar la pagina con otro orden.
 ?>
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr valign="bottom">
	<td><img src="../imagenes/estadoDocInfo.gif" width="340" height="25"></td>
</tr>
</table>
<table border=0 cellspace=2 cellpad=2 WIDTH=98% class='t_bordeGris' align='center' bgcolor="#CCCCCC">
<tr bgcolor="#cccccc" class="textoOpcion"> <?

	?>
<td  align="center"> <a href='cuerpo_envio.php?<?=SID ?>&<?=$encabezado ?>' alt='Seleccione una busqueda' class='textoOpcion'>
</a><img src="../imagenes/estadoDoc.gif" width="80" height="22">
</td>
<td  align="center">
<a href='cuerpo_envio.php?<?=$encabezado ?>1&ordcambio=1' class='textoOpcion' alt='Seleccione una busqueda'>
<?=$img1 ?> Radicado</a> </td>
<td  align="center">
  Radicado Padre</td>
<td width='10%' align="center"> <a href='cuerpo_envio.php?<?=$encabezado ?>2&ordcambio=1' class='textoOpcion' alt='Seleccione una
 busqueda'>
<?=$img2 ?>Fecha Envio</a> </td>
<td  width='2%' align="center"> <a href='cuerpo_envio.php?<?=$encabezado ?>3&ordcambio=1' class='textoOpcion' alt='Seleccione una busqueda'>
<?=$img3 ?>Planilla</a> </td>
<td  width='20%' align="center"> <a href='cuerpo_envio.php?<?=$encabezado ?>4&ordcambio=1' class='textoOpcion'  alt='Seleccione una busqueda'>
<?=$img4 ?>Destinatario</a></td>
<td  width='15%' align="center"><a href='cuerpo_envio.php?<?=$encabezado ?>5&ordcambio=1' class='textoOpcion'  alt='Seleccione una busqueda'>
<?=$img5 ?>Direccion</a></td>
<td  width='8%' align="center"><a href='cuerpo_envio.php?<?=$encabezado?>6&ordcambio=1' class='textoOpcion'  alt='Ordenar por Enviado'>
<?=$img9 ?>Departamento</a> </td>
<td  width='8%' align="center"><a href='cuerpo_envio.php?<?=$encabezado ?>7&ordcambio=1' class='textoOpcion'  alt='Seleccione una busqueda'>
Municipio </a>
</td>
<td  width='8%' align="center"><a href='cuerpo_envio.php?<?=$encabezado ?>8&ordcambio=1' class='textoOpcion'  alt='Seleccione una busqueda'>
Empresa<br> De Envio</a>
</td>
<td  width='8%' align="center">Usuario<br>
Actual
</td>
<td  width='8%' align="center">
Valor<br>
De Envio</td>
<td  width='4%' class="grisCCCCCC" align="center"> <?
if($codusuario==1){
?>
 <?
 if($devolucion==3)
 {}
 else
 {
 ?>
<input type='checkbox' onClick='markAll(form1)' title='Seleccione/deseleccione todos los mensajes' name='marcartodos' id=mt>
<? }
 } ?> </td>
</tr>
<?
 $row = array();
 $i = 1;
 $ki=0;
// Comienza el siclo para mostrar los documentos de la parpeta predeterminada.
     $registro=$pagina*20;
   while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	 {
	 
    if($ki>=$registro and $ki<($registro+20)){
	$valor_envio = $row["SGD_RENV_VALOR"] * $row["SGD_RENV_CANTIDAD"];
    $cursor3 = ora_open($handle);
		$data = trim($row["RADI_NUME_SAL"]);
		$isql3 ="select a.RADI_FECH_RADI FECHA
				,a.RA_ASUN
				,b.USUA_LOGIN
				,b.USUA_NOMB
				,a.RADI_NUME_DERI
        ,a.radi_depe_actu
			from radicado a, usuario b
			where a.radi_nume_radi='$data'
			and a.radi_depe_actu=b.depe_codi
			and a.radi_usua_actu=b.usua_codi  ";
		ora_parse($cursor3,$isql3);
		ora_exec($cursor3);
		$result1=ora_fetch_into($cursor3,$row3, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		$numdata =  trim($row["CARP_CODI"]);
		$plg_codi = $row["ANEX_ESTADO"];
		$plt_codi = $row["ANEX_ESTADO"];
		$rad_salida = $row["RADI_NUME_SAL"];
		$ref_pdf = $row["ANEX_NOMB_ARCHIVO"];
		$creador = $row["USUA_DOC"];
		$usuario_acutal = $row3["USUA_LOGIN"];
		$usuario_acutal_nombre = $row3["USUA_NOMB"];
		$radi_nume_deri = $row3["RADI_NUME_DERI"];
		$radi_depe_actu = $row3["RADI_DEPE_ACTU"];
		$radi_nume_deri = $row3["RADI_NUME_DERI"];
		$observaciones = "--- Usuario = $usuario_acutal_nombre ";
		if ($row3["RADI_PATH"]) $urlimagen = "<a href='../bodega".$row3["RADI_PATH"]."?fechah=$fechah'>$data</a>";
			else $urlimagen = $data;
		if($radi_nume_deri!=$data and $radi_nume_deri)
		{
    
        error_reporting(7);
         $radi_nume_deri = $row3["RADI_NUME_DERI"];
			   $isql3 ="select a.RADI_FECH_RADI FECHA
				,a.RA_ASUN
        ,a.RADI_DEPE_ACTU
				,b.USUA_LOGIN
				,b.USUA_NOMB
				from radicado a, usuario b
				where a.radi_nume_radi='$radi_nume_deri'
				and a.radi_depe_actu=b.depe_codi
				and a.radi_usua_actu=b.usua_codi  ";
			ora_parse($cursor3,$isql3);
			ora_exec($cursor3);
			$result1=ora_fetch_into($cursor3,$row3, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
			$usuario_acutal = $row3["USUA_LOGIN"];
			$usuario_acutal_nombre = $row3["USUA_NOMB"];
      $radi_depe_actu = $row3["RADI_DEPE_ACTU"];
			$observaciones = "--- Radicado Padre $radi_nume_deri: $usuario_acutal_nombre --- Usuario:$usuario_acutal_nombre ";
		}
	if($plt_codi==2){$img_estado = "<img src=../imagenes/docRecibido.gif  border=0 width=80>"; }
	if($plt_codi==2){$img_estado = "<img src=../imagenes/docRadicado.gif  border=0 width=80>"; }
	if($plt_codi==3){$img_estado = "<img src=../imagenes/docImpreso.gif  border=0 width=80>"; }
	if($plt_codi=4){$img_estado = "<img src=../imagenes/docEnviado.gif  border=0 width=80>"; }
	if(trim($ref_pdf)) $ref_pdf = "bodega/$ano_radicado/$dep_radicado/docs/$ref_pdf";
	$tipo_sal = "Archivo";
	//$ref_pdf_salida = "<a href='../bodega/$ano_radicado/$dep_radicado/docs/$ref_pdf' alt='Radicado de Salida $rad_salida'>$img_estado</a>";
$ref_pdf_salida = "$img_estado";
if($data =="") $data = "NULL";
	error_reporting(7);
		$numerot = $row1["num"];
		if($row["RADI_LEIDO"]==0){$leido="r";} else {$leido="";}
if($i==1){
		$leido ="tpar$leido";
		$i=2;
		}else{
		$leido ="timpar$leido";
		$i=1;
		}
		?>
<tr class='<?=$leido?>'>
	<td  class='<?=$leido ?>' width="80"><?=$img_estado?></td>
	<td  class='<?=$leido ?>' width="130">
		<?=$row["RADI_NUME_SAL"]?> 
</td>
<td class='<?=$leido ?>' align="center" width="12%">
		<?=$radi_nume_deri ?>
</td>
<td class='<?=$leido ?>' width="10%">
		<?=$row["FECHA_ENVIO"] ?> </td>
<td class='<?=$leido ?>' width="10%">
		<?=$row["SGD_RENV_PLANILLA"] ?> </td>
		<td class='<?=$leido ?>' width="18%">
		<span class='$leido'><?=$row["SGD_RENV_NOMBRE"]?></span>
		</td>
<td class='<?=$leido ?>' width="20%"><?=$row["SGD_RENV_DIR"]?>
</td>
<td  class='<?=$leido ?>' width="15%"><?=$row["SGD_RENV_DEPTO"]?></td>

<td class='<?=$leido ?>' width="8%"><?=$row["SGD_RENV_MPIO"]?></td>
<td class='<?=$leido ?>' ><?=$row["SGD_FENV_DESCRIP"]?></td>
<td class='<?=$leido ?>' >
<?
$radi_nume_sal = $row["RADI_NUME_SAL"];
$renv_codigo = $row["SGD_RENV_CODIGO"];
$check = "check_value[$radi_nume_sal-$renv_codigo]";
  IF($radi_depe_actu == "999" and $dev_documentos)
  {
    echo "<a href='$pagina_sig?rad_recuperar=$radi_nume_deri&$check=devolver&$encabezado' >";
  }
?>
<?
  IF($radi_depe_actu == "999" and $dev_documentos)
  {
   ?>
   <img border=0 src='../imagenes/archivo/archivar_exp.gif' alt='Recuperar el Radicado'  title='Recuperar Radicado'>
   <?
    echo "</a>";
   }else{
   ?>
   <img border=0 src="../iconos/usuarios.gif" alt="<?=$observaciones?>"  title="<?=$observaciones?>">
   <?
  }
  ?>
<?=$usuario_acutal?>
</td>
<td align='center' class='<?=$leido ?>' width="4%">
<?=number_format($valor_envio,",",1,".")?>
</td>
<?
if($check<=20){
$check = $radi_nume_sal."-".$renv_codigo;
?>
<td align='center' class='<?=$leido ?>' width="4%">
 <?
 if($devolucion==3)
 {
 ?>
  <input type="radio"  name='check_value' value='<?=$check?>' class='ebuttons2'>
  <? 
 }else
 {
 ?>
  <input type='checkbox' name='check_value[<?=$check?>]' value='devolver' class='ebuttons2'>
  <?
  }
  ?>
</td>
<?
$check=$check+1;
}
?> </tr>
<?
}
  $ki=$ki+1;
}
	?>
	</table>
	</TD>
	</tr>
</TABLE>

	 </form>
<table border=0 cellspace=2 cellpad=2 WIDTH=98% class='t_bordeGris' align='center'>
  <tr align="center">
   <td> <?
	$numerot = ora_numrows($cursor);
	// Se calcula el numero de | a mostrar
	$paginas = ($numerot / 20);
	?><span class='etextou'> Paginas</span> <?
	if(intval($paginas)<=$paginas)
	{$paginas=$paginas;}else{$paginas=$paginas-1;}
	// Se imprime el numero de Paginas.
	for($ii=0;$ii<$paginas;$ii++)
	{
	  if($pagina==$ii){$letrapg="<font color=green size=3>";}else{$letrapg="<font color=blue size=2>";}
	  echo " <a href='cuerpo_envio.php?pagina=$ii&$encabezado$orno'>$letrapg".($ii+1)."</font></a>\n";
	}

	 echo "<input type=hidden name=check value=$check>";
   ?> </td>
        </tr></table>
</td></tr></table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="t_bordeGris">
  <tr align="center" bgcolor="#E6E6E6">
    <td  ><font color="#FF0000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>
	<span class="textoComentario">Nota. Los documentos que no poseen el cuadro de seleccion, los tiene otro usuario.<br>
	Debera comunicarse con este para terminar el proceso.
      </span><font color="#000033">
      </strong></font></td>
  </tr>
</table>
							 <?

    	  $row = array();
	  }
	  else
	  {
					   ?> <form name='form1' action='../enviar.php' method=post>
        <?
	echo "<input type=hidden name=depsel>";
	echo "<input type=hidden name=depsel8>";
	echo "<input type=hidden name=carpper>";
	echo "</form>";
echo "<form action='usuarionuevo.php' method=post name=form2>";
// Si es un usuario nuevo pide la nueva contraseña.
	if($row["USUA_NUEVO"]=="0")
	{		
		echo "<center><B>USUARIO NUEVO </CENTER>";
		ECHO "<P><P><center>Por favor introduzca la nueva contraseña<p></p>";
		echo "<CENTER><input type=hidden name='usuarionew' value=$krd><B>USUARIO $krd<br></p>";
		echo "<table border=0>";
		echo "<tr>";
		echo "<td><center>CONTRASEÑA </td><td><input type=password name=contradrd vale=''><br></td>";
		echo "</tr>"				 ;
		echo "<tr><td><center>RE-ESCRIBA LA CONTRASEÑA </td><td><input type=password name=contraver vale=''></td>";
		echo "</tr>";							 
		echo "</table></p></p>";
		echo "";
		echo "";
		ECHO "<center>Seleccione la dependencia a la cual pertenece \n";
		ora_commiton($handle); 
		$cursor = ora_open($handle);
		ora_parse($cursor,"select depe_codi,depe_nomb from DEPENDENCIA ORDER BY DEPE_NOMB");
		ora_exec($cursor);
		$numerot = ora_numrows($cursor);$row1 = array();	
			
		$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		echo "<br><b><center>Dependencia <select name='depsel' class='e_buttons'>\n";
		$dependencianomb=substr($dependencianomb,0,35);
		echo "<option value=$dependencia>$dependencianomb</option>\n";
		DO
		{
			$depcod = $row1["DEPE_CODI"];
			$depdes = substr($row1["DEPE_NOMB"],0,35);
			echo "<option value=$depcod>$depdes</option>\n";
			}while($result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
			echo "</select>";
			echo "<br><input type=submit value=Aceptar>";
			?>
      </form> <?

					}else{echo "<input type=hidden name=depsel>";
					      echo "<input type=hidden name=carpper>";
					}					 					
						
		}
	}Else
		{
		   ?><form name='form1' action='../enviar.php' method=post>
  <div align="center">
    <input type=hidden name=depsel>
    <input type=hidden name=depsel8>
    <input type=hidden name=carpper>
    <span class='etextou'>NO TIENE AUTORIZACION PARA INGRESAR</span><BR>
    <span class='eerrores'><a href='../login.php' target=_parent><span class="textoOpcion">Por 
    Favor intente validarse de nuevo. Presione aca !</span></a></span> </div>
</form>
           <?
		}
	?>
	 <br> 
 <script>
function  prueba(Button)
{
   if (event.button == 2) {
  alert("Botón derecho pulsado");
}

}
 </script>
</body>
</html>
