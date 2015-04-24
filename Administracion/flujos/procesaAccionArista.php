<script language="javascript">
			//alert("Aguacate");	
</script>	
<?
include ( "class.Flujo.php" );
include ( "class.Etapa.php" );
include ( "class.Arista.php" );

$flujo = new Flujo();

		
if( isset( $HTTP_COOKIE_VARS[ "users_resolution" ] ) )
	$screen_res = $HTTP_COOKIE_VARS[ "users_resolution" ];
else
{
?>
<script language="javascript">
alert("Aguacate");
<!--
//writeCookie();

function writeCookie() 
{
 var today = new Date();
 var the_date = new Date( "December 31, 2010" );
 var the_cookie_date = the_date.toGMTString();
 var the_cookie = "users_resolution="+ screen.width +"x"+ screen.height;
 var the_cookie = the_cookie + ";expires=" + the_cookie_date;
 document.cookie=the_cookie
	 
 location = 'cuadriculaBuilder.php';
}



//-->
</script>

<?
/*
<script language="JavaScript">


function getScreenSize(){

	var ancho = screen.width
  	var alto = screen.height
  	alert("Tu monitor tiene las siguientes dimensiones: " + ancho + " X " + alto);
}
</script>
*/
?>

<?
}
?>



<?php
?>
<html>
<head>
<title>Ingreso de Arista Flujo</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<script language="javascript">

function f_close(){
	resultado = cierra();
	if( !resultado )
		return false;
	//window.history.go(0);
	opener.regresar();
	window.close();
}

function regresar(){
	window.location.reload();
	//f_close();
}

function cierra(){
	
	valorDesc = document.getElementById( 'descripcionArista' ).value;
	
	
	if( valorDesc == '' ){
		alert( "Debe ingresar la descripcion." );
		return false;
	}
	opener.document.getElementById("arista_0").value = valorDesc;
	
	//alert ( "alerta 2 " );
		
	alert( valorDesc );
	return true;
}
function actualizar(){
	
		
// alert('Etro act');
  if (!validarGenerico())
  	return;

   <? if ($swIntegraAps!="0") { ?>
  	document.formulario.aplinteg.disabled=false;

  	<?}?>
  	document.formulario.radicado_salida.disabled=false;
  	document.formulario.tpradic.disabled=false;

    document.formulario.submit();
 //alert('Etro act fin');
}
</script>
</head>
<body bgcolor="#FFFFFF" topmargin="0">
<script language="JavaScript" src="js/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript"><!--
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "formulario", "fecha_doc","btnDate1","",scBTNMODE_CUSTOMBLUE);
//--></script>
<form  method="post" name="formulario" id="formulario" action="cuadriculaBuilder.php?descripcionArista=<?=$descripcionArista?>">

<table width="98%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
<?
	$datos_envio= "&otro_us11=$otro_us11&codigo=$codigo&dpto_nombre_us11=$dpto_nombre_us11&direccion_us11=$direccion_us11&muni_nombre_us11=$muni_nombre_us11&nombret_us11=$nombret_us11";
	$datos_envio.="&otro_us2=$otro_us2&dpto_nombre_us2=$dpto_nombre_us2&muni_nombre_us2=$muni_nombre_us2&direccion_us2=$direccion_us2&nombret_us2=$nombret_us2";
	$datos_envio.="&dpto_nombre_us3=$dpto_nombre_us3&muni_nombre_us3=$muni_nombre_us3&direccion_us3=$direccion_us3&nombret_us3=$nombret_us3";
$variables = "ent=$ent&radi=$radi&krd=$krd&".session_name()."=".trim(session_id())."&usua=$krd&contra=$drde&tipo=$tipo&ent=$ent&codigo=$codigo$datos_envio";
	?>
<input type="hidden" name="usua" value="<?=$usua?>">
<input type="hidden" name="contra" value="<?=$contra?>">
<input type="hidden" name="anex_origen" value="<?=$tipo?>">
<input type="hidden" name="tipo" value="<?=$tipo?>">
	<input type="hidden" name="tipoLista" value="<?=$tipoLista?>">
	<input type="hidden" name="krd" value="<?=$krd?>">
		<input type="hidden" name="tipoDocumentoSeleccionado"  value="<?php echo $tipoDocumentoSeleccionado ?>">
<div align="center">
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
		<tr >
			<td  height="25" align="center" class="titulos4" >CREACI&Oacute;N DE ARISTA</td>
		</tr>
		<tr >
			<td class="titulos2" height="25" align="left" colspan="2" >
				Ingrese los datos solicitados
			</td>
		</tr>
		<tr>
		<td  colspan="2">
		<table border=0 width=100% class="borde_tab" >
		<!--DWLayoutTable-->
		<tr>
		<td height="23" align="left" colspan="3" class="listado2" width="25%">
		Descripci&oacute;n:
			</td>
			<td height="23" colspan="3" class="listado2" width="75%">
			<input type="text" name="descripcionArista"  id="descripcionArista" value="<?=$descripcionArista?>"  size=58 lenght=100 >
		</td>
		</tr>


		<tr>
			<td height="23" colspan="3" class="listado2" width="25%">
			D&iacute;as M&iacute;nimo:
			</td>
			<td height="23" colspan="3" class="listado2" width="75%">
			<input type="text" name="diasMinimo" value="<?=$diasMinimo?>" size="15" lenght="5" >				
			</td>
		</tr>
		<tr>
			<td height="23" colspan="3" class="listado2" width="25%">
			D&iacute;as M&aacute;ximo:
			</td>
			<td height="23" colspan="3" class="listado2" width="75%">
			<input type="text" name="diasMaximo" value="<?=$diasMaximo?>" size="15" lenght="5">				
			</td>
		</tr>
		<tr>
			<td height="23" colspan="3" class="listado2" width="25%">
			Serie:
			</td>
			<td height="23" colspan="3" class="listado2" width="75%">
			<input type="text" name="serie" value="<?=$serie?>" size="15" lenght="5">				
			</td>
		</tr>
		<tr>
			<td height="23" colspan="3" class="listado2" width="25%">
			Sub-Serie:
			</td>
			<td height="23" colspan="3" class="listado2" width="75%">
			<input type="text" name="subserie" value="<?=$subserie?>" size="15" lenght="5">				
			</td>
		</tr>
		<tr>
			<td height="23" colspan="3" class="listado2" width="25%">
			Tipificaci&oacute;n:
			</td>
			<td height="23" colspan="3" class="listado2" width="75%">
			<input type="text" name="tipificacion" value="<?=$tipificacion?>" size="15" lenght="5">				
			</td>
		</tr>
		<tr>
			<td height="23" colspan="3" class="listado2" width="25%">
			TPR:
			</td>
			<td height="23" colspan="3" class="listado2" width="75%">
			<input type="text" name="tpr" value="<?=$tpr?>" size="15" lenght="5">				
			</td>
		</tr>
	


	</td>
  </tr>
</table>
<center><span class="etextomenu">
<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center" class="t_bordeGris">
		<tr align="center">
			<td class="celdaGris" height="25"> <span class="etextomenu">
	 			<input type='button' class ='botones' value='crear' onclick='f_close();'> 
			</TD><td class="celdaGris" height="25"> <span class="etextomenu">
	 			<input type='button' class ='botones' value='cerrar' onclick='cierra();submit();window.close();'> 
			</TD>
		</TR>
</TABLE>
</span></center>
</form>
</body>
</html>

