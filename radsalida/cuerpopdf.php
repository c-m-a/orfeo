<?
session_start();
include_once "../include/db/ConnectionHandler.php";
$ruta_raiz = "..";
if (!$dependencia)   include "../rec_session.php";
if (!$dep_sel) $dep_sel = $dependencia;
?>
<html>
<head>
  <meta http-equiv="Cache-Control" content="cache">
  <meta http-equiv="Pragma" content="public">
<?
$fechah=date("dmy") . "_". time("h_m_s");
$encabezado = session_name()."=".session_id()."&krd=$krd&devolucion=$devolucion";
?><script>
function back() {
    history.go(-1);
}
   function sel_dependencia ()
   {
      document.write("<form name=forma_b_correspondencia action='cuerpopdf.php?<?=$encabezado?>'  method=post>");
	  depsel = form1.dep_sel.value ;

	  document.write("<input type=hidden name=depsel value="+depsel+">");
	  document.write("<input type=hidden name=estado_sal  value=3>");
	  document.write("<input type=hidden name=estado_sal_max  value=3>");
	  document.write("<input type=hidden name=fechah value='<?=$fechah?>'>");
	  document.write("</form>");
	  forma_b_correspondencia.submit();
   }

</script>
<?php
   error_reporting(7);
  ?>
<link rel="stylesheet" href="../estilos_totales.css">
<?PHP
 if(!$estado_sal)   {$estado_sal=2;}
 if(!$estado_sal_max) $estado_sal_max=3;
if($estado_sal==3)
  {
    $accion_sal = "Envio de Documentos";
	$pagina_sig = "envio.php";
	if(!$dep_sel) $dep_sel = $dependencia;
	$dependencia_busq1= " and a.radi_nume_sal like '2004$dep_sel%'";
	$dependencia_busq2= " and a.radi_nume_salida like '2004$dep_sel%'";
  }
if($estado_sal==2)
  {

    $accion_sal = "Marcar Documentos Como Impresos";
	$pagina_sig = "envio_imp.php";
	$dependencia_busq1= " and a.radi_nume_sal like '2004$dependencia%'";
	$dependencia_busq2= " and a.radi_nume_salida like '2004$dependencia%'";
  }
  if($estado_sal==4)
  {
    if($devolucion==1)
	{
		$accion_sal = "Devolucion de Documentos";
		$pagina_sig = "dev_corresp_otras.php";
	}else
	{
		$accion_sal = "Modificar Planilla de Envio";
		$pagina_sig = "envio_mod.php";
	}
	if(!$dep_sel) $dep_sel = $dependencia;
	$dependencia_busq1= " and a.radi_nume_sal like '2004$dep_sel%'";
	$dependencia_busq2= " an a.radi_nume_salida like '2004$dep_sel%'";
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
         if ($item)
		 { 
		   
		   if ($i != 0) $busq_and = " or "; else $busq_and = " ";
		   $busq_radicados_tmp .= " $busq_and radi_nume_salida like '%$item%' ";
		   $i++;
		  }
     }
	 //if(substr($busq_radicados_tmp,-1)==",")   $busq_radicados_tmp = substr($busq_radicados_tmp,0,strlen($busq_radicados_tmp)-1);
	 $dependencia_busq2 .= " and ($busq_radicados_tmp) ";
}
$tbbordes = "#CEDFC6";
$tbfondo = "#FFFFCC";
if(!$orno){$orno=1;}
$imagen="flechadesc.gif";
if($estado_sal==2)
  {

	$dependencia_busq1 .= " and a.radi_nume_sal like '2004$dependencia%'";
	$dependencia_busq2 .= " and a.radi_nume_salida like '2004$dependencia%'";
  }
?><script>
<!-- Esta funcion esconde el combo de las dependencia e inforados Se activan cuando el menu envie una se�al de cambio.-->

function window_onload()
{
   form1.depsel.style.display = '';
   form1.enviara.style.display = '';
   form1.depsel8.style.display = 'none';
   form1.carpper.style.display = 'none';
   setVariables();
   setupDescriptions();
}
<!-- Cuando existe una se�an de cambio el program ejecuta esta funcion mostrando el combo seleccionado -->
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
for(i=2;i<document.form1.elements.length;i++)
	document.form1.elements[i].checked=1;
else
  for(i=2;i<document.form1.elements.length;i++)
  	document.form1.elements[i].checked=0;
}
<?php
   //include "libjs.php";
	 function tohtml($strValue)
{
  return htmlspecialchars($strValue);
}
?>
</script><style type="text/css">
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
	$img1="";$img2="";$img3="";$img4="";$img5="";$img6="";$img7="";$img8="";$img9="";
         IF($ordcambio)
				   {IF($ascdesc=="ASC"){$ascdesc="DESC";	$imagen="flechadesc.gif";}else{$ascdesc="ASC";$imagen="flechaasc.gif";}}
					 else
					 {IF($ascdesc==""){$ascdesc="DESC";$imagen="flechadesc.gif";}else{$ascdesc="ASC";	$imagen="flechaasc.gif";}}
	if($orno==1){$order=" a.radi_nume_salida $ascdesc";$img1="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	if($orno==2){$order=" a.ANEX_RADI_NUME $ascdesc";$img2="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	if($orno==3){$order=" a.anex_radi_fech $ascdesc";$img3="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	if($orno==4){$order=" a.anex_desc $ascdesc" ;$img4="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	if($orno==5){$order=" nombres $ascdesc";$img5="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	if($orno==6){$order="  $ascdesc";$img6="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	if($orno==9){$order=" a.anex_creador $ascdesc";$img9="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	if($orno==7){$order=" a.anex_estado desc , a.radi_nume_salida desc";$img7=" <img src='../iconos/flechanoleidos.gif' border=0 alt='$data'> ";}
	if($orno==8){$order=" a.anex_estado  , radi_nume_salida desc";$img7=" <img src='../iconos/flechaleidos.gif' border=0 alt='$data'> ";}
	//if($orno==9){$order=" sgd_deve_fech $ascdesc, radi_nume_salida desc"; $dependencia_busq2 .= " and sgd_deve_codigo is not null "; $img9=" <img src='../iconos/$imagen' border=0 alt='$data'> ";}
  $datosaenviar = "fechaf=$fechaf&tipo_carp=$tipo_carp&ascdesc=$ascdesc&orno=$orno&nomcarpeta=$nomcarpeta";
  $encabezado = session_name()."=".session_id()."&dep_sel=$dep_sel&krd=$krd&estado_sal=$estado_sal&fechah=$fechah&estado_sal_max=$estado_sal_max&ascdesc=$ascdesc&devolucion=$devolucion&busq_radicados=$busq_radicados&nomcarpeta=$nomcarpeta&orno=";
    $fechah=date("dmy") . "_". time("h_m_s");
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
    $numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
	$db = new ConnectionHandler("..");
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
    $isql = "select * from usuario where USUA_LOGIN ='$krd' and USUA_SESION='". substr(session_id(),0,29)."' ";
	//$db->conn->debug=true;
	$rs=$db->query($isql);
	// Validacion de Usuario y COntrase�a MD5
	//echo "** $krd *** $drde";
  if (trim($rs->fields["USUA_LOGIN"])==trim($krd))
		{
		$nombusuario =$rs->fields["USUA_NOMB"];
		$contraxx=$rs->fields["USUA_PASW"];

		$nivelus=$rs->fields["CODI_NIVEL"];
		if($rs->fields["USUA_NUEVO"]=="1"){
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
	?>
	    <table BORDER=0  cellpad=2 cellspacing='0' WIDTH=98% class='t_bordeGris' valign='top' align='center' >
          <TR >
            <TD width='35%' >
              <table width='100%' border='0' cellspacing='1' cellpadding='0'>
                <tr> <?
	     IF($nomcarpeta=="")
			 {
			      $nomcarpeta=" ENTRADA ";
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
                  <td width="90%" height="20"><span class='etextomenu'><?=$nombusuario ?></span></td>
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
	$isql = "select depe_codi,depe_nomb from DEPENDENCIA ORDER BY DEPE_CODI";
	$rs1=$db->query($isql);
	$numerot = $rs1->RecordCount();
		// Combo en el que se muestran las dependencias, en el caso  de que el usuario escoja reasignar.
		?>
	<FORM name=form_busq_dep action='cuerpopdf.php?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&nomcarpeta=<?=$nomcarpeta?>' method=post>
        <select name='dep_sel' class='ebuttons2' onChange='submit();' >
<?
	$dependencianomb=substr($dependencianomb,0,35);
	do
		{
			$depcod = $rs1->fields["DEPE_CODI"];
				$depdes = substr($rs1->fields["DEPE_NOMB"],0,35);
				if ($depcod==$dep_sel){
					$datosdep = " selected ";
				}else {$datosdep="";}
				echo "<option value=$depcod $datosdep>$depcod - $depdes</option>\n";
				$rs1->MoveNext();
		}while(!$rs1->EOF);
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
	  <FORM name=form_busq_rad action='cuerpopdf.php?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>&nomcarpeta=<?=$nomcarpeta?>' method=post>
                Buscar radicado(s) (Separados por coma)<input name="busq_radicados" type="text" size="70" class="ecajasfecha" value="<?=$busq_radicados?>">
				<input type=submit value='Buscar ' name=Buscar valign='middle' class='ebuttons2'></form>
			</td>
		  </tr>
	 </table>
	 <form name='form1' action='<?=$pagina_sig?>?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&nomcarpeta=$nomcarpeta" ?>' method=post>
        <TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
          <tr>
            <TD class="grisCCCCCC" height="58">
              <table BORDER=0  cellpad=2 cellspacing='2' WIDTH=98% class='t_bordeGris' valign='top' align='center' cellpadding="2" >
                <tr bgcolor="#CCCCCC">
                  <td width='30%' align='left' height="40" class="grisCCCCCC"  >Listar por<br>
		<a href='cuerpopdf.php?<?=$encabezado?>7&ordcambio=1' alt='Ordenar Por Leidos'><span class='tpar'>Impresos</span></a>
                    <?=$img7 ?> <a href='cuerpopdf.php?<?=$encabezado?>8&ordcambio=1' class="tparr" alt='Ordenar Por Leidos'><span class='tparr'>
                    Por Imprimir</span></a></td>
	             <td width='25%' align='left' height="40" >
		     </td>
                    <td width='5%' align="left">
                    <input type=submit value='<?=$accion_sal ?>' name=Enviar valign='middle' class='ebuttons2'>
</td>

                </TR>
              </TABLE>
            </td>
          </tr>
          <tr>
            <td class="grisCCCCCC"> 
	<?
	$isql = "select a.anex_estado,a.anex_nomb_archivo  ,a.radi_nume_salida,a.anex_tamano
			,a.anex_radi_fech ,a.anex_radi_nume  ,a.anex_desc ,a.anex_creador
			,a.ANEX_RADI_FECH,'WWW'
			,9999  
			,a.anex_tipo  
			,a.anex_radi_nume
			,a.sgd_dir_tipo
			,a.sgd_deve_codigo
			,a.sgd_deve_fech
		from anexos a,usuario
	where ANEX_ESTADO>=$estado_sal
			$dependencia_busq2
				and  ANEX_ESTADO <= $estado_sal_max
				and anex_creador=usua_login and anex_borrado='N' and sgd_dir_tipo != 7
			order by $order ";
	$rs=$db->query($isql);
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
	<td  align="center"> <a href='cuerpopdf.php?<?=SID ?>&<?=$encabezado ?>' alt='Seleccione una busqueda' class='textoOpcion'>
	</a><img src="../imagenes/estadoDoc.gif" width="130" height="32"> 
	</td>
	<td  align="center"> 
			<a href='cuerpopdf.php?<?=$encabezado ?>1&ordcambio=1' class='textoOpcion' alt='Seleccione una busqueda'>
	<?=$img1 ?> Radicado Salida</a> </td>
	<td width='10%' align="center"> <a href='cuerpopdf.php?<?=$encabezado ?>2&ordcambio=1' class='textoOpcion' alt='Seleccione una busqueda'>
	<?=$img2 ?> Radicado Padre </a> </td>
	<td  width='18%' align="center"> <a href='cuerpopdf.php?<?=$encabezado ?>3&ordcambio=1' class='textoOpcion' alt='Seleccione una busqueda'>
	<?=$img3 ?> Fecha Radicado</a> </td>
	<td  width='20%' align="center"> <a href='cuerpopdf.php?<?=$encabezado ?>4&ordcambio=1' class='textoOpcion'  alt='Seleccione una busqueda'>
	<?=$img4 ?> Descripcion </a></td>
	<td  width='15%' align="center">  
	<?=$img5 ?> Expediente  </td>
	<td  width='8%' align="center"><a href='cuerpopdf.php?<?=$encabezado?>9&ordcambio=1' class='textoOpcion'  alt='Ordenar por Enviado'>
	<?=$img9 ?>
	Generado <br>
	Por</a> </td>
	<td  width='8%' align="center"> 
	Tipo<br>
	</td>					
	<td  width='4%' class="grisCCCCCC" align="center"> <?
	if($codusuario==1){
	?> 
	<input type='checkbox' onClick='markAll(form1)' title='Seleccione/deseleccione todos los mensajes' name='marcartodos' id=mt>
	<? } ?> </td>
</tr>
                <?
		 $i = 1;
		 $ki=0;
	// Comienza el siclo para mostrar los documentos de la parpeta predeterminada.
	     $registro=$pagina*20;
   while(!$rs->EOF)
	 {
	$rad_salida = $rs->fields["RADI_NUME_SALIDA"];
	$isql ="select RADI_FECH_RADI FECHA,RA_ASUN from radicado where radi_nume_radi='".$rad_salida."'";
	$rs1=$db->query($isql);
	$fecha = $rs1->fields["FECHA"];
	if($ki>=$registro and $ki<($registro+20)){
	$data = trim($rs->fields["ANEX_RADI_NUME"]);
	$numdata =  trim($rs->fields["CARP_CODI"]);
	$plg_codi = $rs->fields["ANEX_ESTADO"];
	$plt_codi = $rs->fields["ANEX_ESTADO"];
	$rad_salida = $rs->fields["RADI_NUME_SALIDA"];
	$ref_pdf = $rs->fields["ANEX_NOMB_ARCHIVO"];
	$creador = $rs->fields["ANEX_CREADOR"];
	$fecha_dev = $rs->fields["SGD_DEVE_FECH"];
	$codigo_dev = $rs->fields["SGD_DEVE_CODIGO"];

	if ($rs->fields["RADI_PATH"]) $urlimagen = "<a href='../bodega".$rs->fields["RADI_PATH"]."?fechah=$fechah'>$data</a>";
		else $urlimagen = $data;
	if($plt_codi==2){$img_estado = "<img src=../imagenes/docRecibido.gif  border=0>"; }
	if($plt_codi==2){$img_estado = "<img src=../imagenes/docRadicado.gif  border=0>"; }
	if($plt_codi==3){$img_estado = "<img src=../imagenes/docImpreso.gif  border=0>"; }
	if($plt_codi==4){$img_estado = "<img src=../imagenes/docEnviado.gif  border=0>"; }
	if($codigo_dev){$img_estado = "<img src=../imagenes/docDevuelto.gif  border=0 alt='Fecha Devolucion :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";}
	if($codigo_dev==99){$img_estado = "<img src=../imagenes/docDevuelto_tiempo.gif  border=0 alt='Fecha Devolucion :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";}
		$dep_radicado = substr($rs->fields["ANEX_RADI_NUME"],4,3);
		$ano_radicado = substr($rs->fields["ANEX_RADI_NUME"],0,4);
		if(trim($ref_pdf)) $ref_pdf = "bodega/$ano_radicado/$dep_radicado/docs/$ref_pdf";
		$tipo_sal = "Archivo";
		//$ref_pdf_salida = "<a href='../bodega/$ano_radicado/$dep_radicado/docs/$ref_pdf' alt='Radicado de Salida $rad_salida'>$img_estado</a>";
	$ref_pdf_salida = "$img_estado";
            if($data =="") $data = "NULL";
			error_reporting(7);
			 $numerot = $rs1->fields["num"];
			 if($rs->fields["RADI_LEIDO"]==0){$leido="r";}else {$leido="";}
             if($i==1){
			    $leido ="tpar$leido";
				$i=2;
			 }else{
			    $leido ="timpar$leido";

				$i=1;
			 }
			 ?>
                <tr class='<?=$leido?>'> <?
		 $radi_tipo_deri = $rs->fields["ANEX_TIPO"];
		 $radi_nume_deri = $rs->fields["ANEX_RADI_NUME"];
		 $sgd_dir_tipo = $rs->fields["SGD_DIR_TIPO"];
	if (substr(trim($sgd_dir_tipo),0,1)=="7") $copia_no = "-".(substr(trim($sgd_dir_tipo),1,3)+1); else $copia_no="";
	 ?>
	<td  class='<?=$leido ?>' width="130"> <?=$ref_pdf_salida?>
	</td>
	<td class='<?=$leido ?>' align="center" width="12%">
	<?
	if(trim($ref_pdf))
	{
	?>
	<A href='../<?=$ref_pdf ?>'><span class="tgris"><?=$rad_salida."$copia_no"?></span></a>
	<?
	} else
	{
	echo $rad_salida."$copia_no";
	}
	?>
	</td>
	<td class='<?=$leido ?>' width="10%"><?=$radi_nume_deri?></td>
	<td class='<?=$leido ?>' width="18%">
	<span class='$leido'> <?=$fecha ?> </span>
	</td>
	<td class='<?=$leido ?>' width="20%"> <?=$rs->fields["ANEX_DESC"] ?>
	</td>
	<td  class='<?=$leido ?>' width="15%"></td>

	<td class='<?=$leido ?>' width="8%"> &nbsp;<?=$creador ?> </td>
			<td class='<?=$leido ?>' ></td>
	<?
		if($check<=20){
		?>
	<td align='center' class='<?=$leido ?>' width="4%">
			<?
			$rad_salida_t = $rad_salida . $sgd_dir_tipo;
	if($plt_codi==3 and $codigo_dev and $estado_sal=2)
	{
	?>
	<img src=../imagenes/check_x.jpg alt='Debe Modificar el Documento para poder reenviarlo'  title='Debe Modificar el Documento para poder reenviarlo' >
	<?
	}else
	{
	?>
	<input type='checkbox' value='<?=$rad_salida_t ?>' name='chk<?=$check ?>' class='ebuttons2'>
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
		$rs->MoveNext();			 					 
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
	$numerot = $rs->RecordCount();
	// Se calcula el numero de | a mostrar
	$paginas = ($numerot / 20);
	?><span class='etextou'> Paginas</span> <?
	if(intval($paginas)<=$paginas)
	{$paginas=$paginas;}else{$paginas=$paginas-1;}
	// Se imprime el numero de Paginas.
	for($ii=0;$ii<$paginas;$ii++)
	{
	  if($pagina==$ii){$letrapg="<font color=green size=3>";}else{$letrapg="<font color=blue size=2>";}
	  echo " <a href='cuerpopdf.php?pagina=$ii&$encabezado$orno'>$letrapg".($ii+1)."</font></a>\n";
	}
	 
	 echo "<input type=hidden name=check value=$check>";
   ?> </td>
        </tr></table>
</td></tr></table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="t_bordeGris">
  <tr align="center" bgcolor="#E6E6E6">
    <td height="60" ><font color="#FF0000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><span class="textoComentario">Nota. 
      Los valores que se muestran en el c�lculo del "Tiempo Restante", con el 
      objeto de mantenernos informados para contestar dentro del t�rmino cada 
      uno de los documentos, est�n basados en d�as calendario y seg�n tipo de 
      documento. Estos tiempos fueron establecidos por la Oficina de Planeaci�n 
      (Ext.. 2169) a la cual hay que recurrir en caso de requerirse alguna modificaci�n. 
      Podr� observar la relaci�n correspondiente en el archivo</span><font color="#000033"> 
      <a href='../OP_TiemposTramitesDocumentos.xls'>OP_TiemposTramitesDocumentos.xls</a></font><font color="#000000">.</font> 
      </strong></font></td>
  </tr>
</table>
							 <? 	 
	 
    	  $row = array();
	  }
	  ELSE
	  {
					   ?> <form name='form1' action='../enviar.php' method=post>
        <?
					   echo "<input type=hidden name=depsel>";
					   echo "<input type=hidden name=depsel8>";
					   echo "<input type=hidden name=carpper>";		   		   
					   echo "</form>";
					echo "<form action='usuarionuevo.php' method=post name=form2>";
					// Si es un usuario nuevo pide la nueva contrase�a.
						if($row["USUA_NUEVO"]=="0")
						{		
						 	 echo "<center><B>USUARIO NUEVO </CENTER>";
							 ECHO "<P><P><center>Por favor introduzca la nueva contrase�a<p></p>";
							 echo "<CENTER><input type=hidden name='usuarionew' value=$krd><B>USUARIO $krd<br></p>";
							 echo "<table border=0>";
							 echo "<tr>";
							 echo "<td><center>CONTRASE�A </td><td><input type=password name=contradrd vale=''><br></td>";
							 echo "</tr>"				 ;
							 echo "<tr><td><center>RE-ESCRIBA LA CONTRASE�A </td><td><input type=password name=contraver vale=''></td>";
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
							do
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
	}else
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
	 <br><script>
function  prueba(Button)
{
   if (event.button == 2) {
  alert("Bot�n derecho pulsado");
}

}
 </script>
</body>
</html>
