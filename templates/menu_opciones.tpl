<?
if (!$ruta_raiz)
	$ruta_raiz = "..";
?>
<link rel="stylesheet" type="text/css" href="<?=$ruta_raiz?>/js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="<?=$ruta_raiz?>/js/spiffyCal/spiffyCal_v2_1.js"></script>

<script language="javascript">
		<!-- Funcion que activa el sistema de marcar o desmarcar todos los check  -->
		setRutaRaiz ('<?=$ruta_raiz?>');
		function markAll()

		{
		if(document.form1.elements['checkAll'].checked)
		for(i=1;i<document.form1.elements.length;i++)
		document.form1.elements[i].checked=1;
		else
				for(i=1;i<document.form1.elements.length;i++)
				document.form1.elements[i].checked=0;
		}

		 <!--
			<?
				// print ("El control agenda en tx($controlAgenda");
				$ano_ini = date("Y");
				$mes_ini = substr("00".(date("m")-1),-2);
				if ($mes_ini==0) {$ano_ini==$ano_ini-1; $mes_ini="12";}
				$dia_ini = date("d");
				if(!$fecha_ini) $fecha_ini = "$ano_ini/$mes_ini/$dia_ini";
					$fecha_busq = date("Y/m/d") ;
				if(!$fecha_fin) $fecha_fin = $fecha_busq;
			?>

//--></script>
<?

require_once("$ruta_raiz/pestanas.js");
 /**  TRANSACCIONES DE DOCUMENTOS
   *  @depsel number  contiene el codigo de la dependcia en caso de reasignacion de documentos
   *  @depsel8 number Contiene el Codigo de la dependencia en caso de Informar el documento
   *  @carpper number Indica codigo de la carpeta a la cual se va a mover el documento.
   *  @codTx   number Indica la transaccion a Trabajar. 8->Informat, 9->Reasignar, 21->Devlver
   */
?>
<script language="JavaScript" type="text/JavaScript">
// Variable que guarda la ultima opci�n de la barra de herramientas de funcionalidades seleccionada
seleccionBarra = -1;
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<script>

function vistoBueno()
{
  changedepesel(9);
  document.getElementById('EnviaraV').value = 'VoBo';
  //envioTx();
}

function devolver()
{
  document.getElementById('codTx').value=12;
  changedepesel(12);
  //envioTx();
}
function txAgendar()
{
  if (!validaAgendar('SI'))
    return;
	changedepesel(14);
  envioTx();
}
function txNoAgendar()
{
  changedepesel(15);
  envioTx();
}
function archivar()
{
  changedepesel(13);
  envioTx();
}
function nrr()
{
   changedepesel(16);
   envioTx();
}
function envioTx()
{
   sw=0;
   <?
   if(!$verrad)
   {
   ?>
	for(i=1;i<document.form1.elements.length;i++)
	if (document.form1.elements[i].checked)
      sw=1;
	if (sw==0)
	{
	alert ("Debe seleccionar uno o mas radicados");
	return;
	}
	<?
	}
	?>
  document.form1.submit();
}
function window_onload()
{
   document.getElementById('depsel').style.display = 'none';
  // document.getElementById('Enviara').style.display = '';
   document.getElementById('depsel8').style.display = 'none';
   document.getElementById('carpper').style.display = 'none';
   document.getElementById('Enviar').style.display = 'none';

  // document.getElementById('movera_r').style.display = 'none';
  // document.getElementById('reasignar_r').style.display = 'none';
  // document.getElementById('reasignar_r').style.display = 'none';
  // document.getElementById('informar_r').style.display = 'none';
  // document.getElementById('informar').style.display = '';
   //changedepesel(9);
   <?
   if(!$verrad)
   {
   }
   else
   {
   ?>
	 window_onload2();
   <?
   }
   if($carpeta==11 and $_SESSION['codusuario']==1){
    echo "document.getElementById('salida').style.display = ''; ";
	  echo "document.getElementById('enviara').style.display = ''; ";
		echo "document.getElementById('Enviar').style.display = ''; ";
      }ELSE{
	      echo " ";
	  }
  if($carpeta==11 and $_SESSION['codusuario']!=1){
	 echo "document.getElementById('enviara').style.display = 'none'; ";
	 echo "document.getElementById('Enviar').style.display = 'none'; ";
	}
  ?>
}


  function masivaTRD(){
  sw=0;
  var radicados = new Array();
  var list = new Array();
  for(i=1;i<document.form1.elements.length;i++){
    if (document.form1.elements[i].checked && document.form1.elements[i].name!="checkAll") {
    sw++;
    valor = document.form1.elements[i].name;
    valor = valor.replace("checkValue[", "");
    valor = valor.replace("]", "");
    radicados[sw] = valor;
    list.push(valor);
    };
  };
  window.open("accionesMasivas/masivaAsignarTrd.php?<?=session_name()?>=<?=session_id()?>&krd=<?=$krd?>&radicados=" + list, "Masiva_Asignación_TRD", "height=650,width=750,scrollbars=yes");
};

</script>
<script>
function radicadosSel(){
 sw=0;
 var radicados = new Array();
 for(i=1;i<document.form1.elements.length;i++){
	if (document.form1.elements[i].checked) { 
     sw++;
     valor = document.form1.elements[i].name;
		 valor = valor.replace("checkValue[", "");
     valor = valor.replace("]", "");
     radicados[sw] = valor;
   }
 }
alert("---> " + sw + " -->" + radicados[1]  + " -->" + radicados[2]  );
}
</script>
<body onload="MM_preloadImages('<?=$ruta_raiz?>/imagenes/internas/overVobo.gif','<?=$ruta_raiz?>/imagenes/internas/overNRR.gif','<?=$ruta_raiz?>/imagenes/internas/overMoverA.gif','<?=$ruta_raiz?>/imagenes/internas/overReasignar.gif','<?=$ruta_raiz?>/imagenes/internas/overInformar.gif','<?=$ruta_raiz?>/imagenes/internas/overDevolver.gif','<?=$ruta_raiz?>/imagenes/internas/overArchivar.gif')"><table width="100%" border="1" cellspacing="0" cellpadding="0" align="center">
<!--DWLayoutTable-->
<?php
/* Si esta en la Carpeta de Visto Bueno no muesta las opciones de reenviar
 *
*/
if (($mostrar_opc_envio==0) || ($_SESSION['codusuario'] == $radi_usua_actu && $_SESSION['dependencia'] == $radi_depe_actu)) {
	// Modificado SGD 21-Septiembre-2007
	$sql = "SELECT PERM_ARCHI AS \"PERM_ARCHI\",
			PERM_VOBO AS \"PERM_VOBO\"
		FROM USUARIO WHERE USUA_CODI = " . $_SESSION['codusuario'] . " AND 
					DEPE_CODI = " . $_SESSION['dependencia'];
	$rs = $db->query($sql);

	if(!$rs->EOF) {
		$permArchi = $rs->fields["PERM_ARCHI"];
		$permVobo = $rs->fields["PERM_VOBO"];
	}
?>
<tr>
	
	<table width="100%" height="51"  border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="730" valign="bottom">
<?php
if ($controlAgenda==1)
{	//Si el esta consultando la carpeta de documentos agendados entonces muestra el boton de sacar de la agenda
	if ($agendado)
	{	echo("<img name='principal_r5_c1'  src='$ruta_raiz/imagenes/internas/noAgendar.gif' width='130' height='20' border='0' alt=''>");
     	echo ("<input name='Submit2' type='button' class='botones_2' value='&gt;&gt;' onClick='txNoAgendar();'>");
	}
	else
	{	echo("<img name='principal_r5_c1'  src='$ruta_raiz/imagenes/internas/agendar.gif' width='69' height='20' border='0' alt=''> ");
?>
			<script language="javascript">
				var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "form1","fechaAgenda","btnDate1","",scBTNMODE_CUSTOMBLUE);
		 		dateAvailable.date = "2003-08-05";
				dateAvailable.writeControl();
				dateAvailable.dateFormat="yyyy-MM-dd";
			</script>
			<input name="Submit2" type="button" class="botones_2" value="&gt;&gt;" onClick='txAgendar();'>
<?php
}	}
?>		</td>
<?php
if (!$agendado) {
		
?>

<td width="25" valign="bottom">
	<img name="principal_r4_c3" src="<?=$ruta_raiz?>/imagenes/internas/principal_r4_c3.gif" width="25" height="51" border="0" alt="">		</td>

<td width="63" valign="bottom">
<a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 10;changedepesel(10);" onMouseOver="MM_swapImage('Image8','','<?=$ruta_raiz?>/imagenes/internas/overMoverA.gif',1)">
<img src="<?=$ruta_raiz?>/imagenes/internas/moverA.gif" name="Image8" width="63" height="51" border="0"  ></a>		</td>
<td width="64" valign="bottom">
	<a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 9;changedepesel(9);" onMouseOver="MM_swapImage('Image9','','<?=$ruta_raiz?>/imagenes/internas/overReasignar.gif',1)">
	<img src="<?=$ruta_raiz?>/imagenes/internas/reasignar.gif" name="Image9" width="64" height="51" border="0"  ></a>		</td>
<td width="66" valign="bottom">
	<a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 8;changedepesel(8);" onMouseOver="MM_swapImage('Image10','','<?=$ruta_raiz?>/imagenes/internas/overInformar.gif',1)">
	<img src="<?=$ruta_raiz?>/imagenes/internas/informar.gif" name="Image10" width="66" height="51" border="0"></a>		</td>
<td width="58" valign="bottom">
	<a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 12;changedepesel(12);" onMouseOver="MM_swapImage('Image11','','<?=$ruta_raiz?>/imagenes/internas/overDevolver.gif',1)">
	<img src="<?=$ruta_raiz?>/imagenes/internas/devolver.gif" name="Image11" width="58" height="51" border="0"></a>		</td>
	<?php
	if (($_SESSION['depe_codi_padre'] and $_SESSION['codusuario']==1) or $_SESSION['codusuario']!=1) {
	?>
		<td width="55" valign="bottom"><a href="#" onmouseout="MM_swapImgRestore()" onclick="seleccionBarra = 14;vistoBueno();" onmouseover="MM_swapImage('Image12','','<?=$ruta_raiz?>/imagenes/internas/overVobo.gif',1)"><img src="<?=$ruta_raiz?>/imagenes/internas/vobo.gif" name="Image12" width="55"  border="0"></a></td>
    <?
	}
	?>
		<?php
			if(!empty($permArchi) && $permArchi != 0) {
			?>
		<td width="61" valign="bottom">
			<a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 13;changedepesel(13);" onMouseOver="MM_swapImage('Image13','','<?=$ruta_raiz?>/imagenes/internas/overArchivar.gif',1)">
			<img src="<?=$ruta_raiz?>/imagenes/internas/archivar.gif" name="Image13" width="61" height="51" border="0"></a>		</td>
		<?php
			}
			/*if($codusuario == 1){
			?>
		<td width="61" valign="bottom"><a href="#" onmouseout="MM_swapImgRestore()" onclick="seleccionBarra = 14;changedepesel(16);" onmouseover="MM_swapImage('Image14','','<?=$ruta_raiz?>/imagenes/internas/overNRR.gif',1)"><img src="<?=$ruta_raiz?>/imagenes/internas/NRR.gif" name="Image14" width="61" height="51" border="0" /></a></td>
		<?php
		}*/
	}
?>
<td valign="bottom">
                        		<a href= "#" title="Asignar TRD" src="../orfeo-3.8.0/imagenes/internas/masTRDO.gif" onClick="masivaTRD();"><img name="ejemplo1"  alt="Asignar Trd masiva" src="../orfeo-3.8.0/imagenes/internas/masTRD.gif"  border="0" ></a>
                        	 </td>
	</tr>
	</table>
	</td>
<tr/>
<?
}
/* Final de opcion de enviar para carpetas que no son 11 y 0(VoBo)
*/
?>
<tr>
	<td height="59" colspan="3" >
	<table BORDER=0   WIDTH=100%  align='center' class="borde_tab" bgcolor="a8bac6" >
	<tr>
		<td width='40%'>
		<? if ($controlAgenda==1){ ?>
			<table width="100%"  border="0" cellpadding="0" cellspacing="5" class="titulos2">
			<tr>
				<td width="15%" class="titulos2">LISTAR POR: </td>
				<td width="60%" class="titulos2">
					<a href='<?=$ruta_raiz?>/cuerpo.php?<?=session_name()."=".trim(session_id()).$encabezado."7&orderTipo=DESC&orderNo=10"; ?>' alt='Ordenar Por Leidos'>
					<span class='leidos'>Le&iacute;dos</span></a><?=$img7 ?>&nbsp;
					<a href='<?=$ruta_raiz?>/cuerpo.php?<?=session_name()."=".trim(session_id()).$encabezado."8&orderTipo=ASC&orderNo=10" ?>' alt='Ordenar Por Le&iacute;dos' class="tparr"><span class='no_leidos'>No le&iacute;dos</span></a>
				</td>
        
			</tr>
			</table>
			<?}?>
		</td>

<?php
/* si esta en la Carpeta de Visto Bueno no muesta las opciones de reenviar
*/
if (($mostrar_opc_envio==0) || ($_SESSION['codusuario'] == $radi_usua_actu && $_SESSION['dependencia'] == $radi_depe_actu))
{

?>
		<td width='55%'  align="right" class="titulos2"  >
	<?php
	$row1 = array();
	// Combo en el que se muestran las dependencias, en el caso  de que el usuario escoja reasignar.
	$dependencianomb=substr($dependencianomb,0,35);
	$subDependencia = $db->conn->substr ."(depe_nomb,0,50)";
	if($_SESSION["codusuario"]!=1 && $_SESSION["usuario_reasignacion"] !=1)
	{
	  $whereReasignar = " where depe_codi = $dependencia";
	}
	else
	{
	  $whereReasignar = "";
	}
  // Cambio en supersolidaria....
	// $sql = "select $subDependencia, depe_codi from DEPENDENCIA $whereReasignar ORDER BY DEPE_NOMB";
  $sql = "select $subDependencia, depe_codi from DEPENDENCIA ORDER BY DEPE_NOMB";
	$rs = $db->query($sql);
	print $rs->GetMenu2('depsel',$dependencia,false,false,0," id=depsel class=select ");
	// genera las dependencias para informar
	$row1 = array();

	$dependencianomb=substr($dependencianomb,0,35);
	$subDependencia = $db->conn->substr ."(depe_nomb,0,50)";
	$sql = "select $subDependencia, depe_codi from DEPENDENCIA  where depe_estado=1 ORDER BY DEPE_NOMB";
	$rs = $db->conn->Execute($sql);
	print $rs->GetMenu2('depsel8[]',$dependencia,false,true,5," id='depsel8' class='select' ");
	// Aqui se muestran las carpetas Personales

	$dependencianomb=substr($dependencianomb,0,35);
	$datoPersonal = "(Personal)";
	$nombreCarpeta = $db->conn->Concat("' $datoPersonal'",'nomb_carp');
	$db->conn->debug = false;
	$codigoCarpetaGen = $db->conn->Concat("'10000'","CAST( carp_codi AS VARCHAR(2) )");
	$codigoCarpetaPer = $db->conn->Concat("'11000'","CAST( codi_carp AS VARCHAR(3) )");
	$sql = "select carp_desc  as nomb_carp
			,$codigoCarpetaGen as carp_codi, 0 as orden
			from carpeta
			where carp_codi <> 11
			union
			select $nombreCarpeta as nomb_carp
			,$codigoCarpetaPer as carp_codi
			,1 as orden
			from carpeta_per
			where
			usua_codi = $codusuario
			and depe_codi = $dependencia
			order by orden, carp_codi";
	$rs = $db->conn->Execute($sql);
	print $rs->GetMenu2('carpSel',1,false,false,0," id=carpper class=select ");

	// Fin de Muestra de Carpetas personales
	?>
		<INPUT TYPE=hidden name=enviara value=9>
		<INPUT TYPE=hidden name=EnviaraV id=EnviaraV value='' >
		</td>
		<td width='5%' align="right">
			<input type=button value='>>' name=Enviar id=Enviar valign='middle' class='botones_2' onClick="envioTx();">
			<input type=hidden name=codTx id=codTx value=9>
		</td>
<?
/* Fin no mostrar opc_envio*/
}
?>

</TR>
</TABLE>
<input type=button onClick="radicadosSel();" class="select" value="verRad">
<?
/**  FIN DE VISTA DE TRANSACCIONES
  *
  *
  */
?>
