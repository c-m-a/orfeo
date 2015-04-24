<?
session_start();
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
?>
<html>
<head><title>Cambio de Estado Al Expedidente</title></head>
<? 
if (!$ruta_raiz) $ruta_raiz = "..";
//include "$ruta_raiz/rec_session.php";
  include_once $ruta_raiz."/include/db/ConnectionHandler.php";
  require_once("$ruta_raiz/class_control/Mensaje.php");
  if (!$db) $db = new ConnectionHandler($ruta_raiz);

?>
<link rel="stylesheet" href="../estilos/orfeo.css">

<script>
function verificaModificacion(){
  var modificado = document.modFlujoExp.estadoModificado2.value;
	if( modificado == '1'){
	<?php 
	if ( $grabarFlujo  ) {
	?>
		alert("El cambio se ejecuto con exito." );
		//opener.regresar(); 
		//window.close();
	<?php 
	} 
	?>
	}else{
		<?php 
	if ( $grabarFlujo  ) {
	?>
		alert("No se pudo realizar el cambio de etapa, por favor verifique datos." );
		opener.regresar(); 
		window.close();
	<?php 
	} 
	?>
	}
}
</script>

<body onload="verificaModificacion()">
<CENTER>
<form name=modFlujoExp  method='post' action='modFlujoExp.php?<?=session_name()?>=<?=trim(session_id())?>&numeroExpediente=<?=$numeroExpediente?>&krd=<?=$krd?>&texp=<?=$texp?>&numRad=<?=$numRad?>&<?="&mostrar_opc_envio=$mostrar_opc_envio&nomcarpeta=$nomcarpeta&carpeta=$carpeta&leido=$leido"?>'>
<table border=0 width 100% cellpadding="0" cellspacing="5" class="borde_tab">
  <input type=hidden name=ver_flujo value="Si ver fLUJO">
  <input type=hidden name=nomcarpeta value="<?=$nomcarpeta?>">
  <tr> 
    <td class="titulos2"> Flujo
	 </td>
      <TD width="323"  >
        <?
  $verradEntra=$verrad;
  include_once($ruta_raiz."/include/tx/Historico.php");
	include_once ("$ruta_raiz/include/tx/Flujo.php");
	include_once ("$ruta_raiz/include/tx/Expediente.php");    
  	$objHistorico= new Historico($db);
	$db->conn->debug=true;
	
	$expediente = new Expediente($db);
	$expediente->consultaTipoExpediente($numeroExpediente);
	$procAutomatico = $expediente->pAutomatico;
	$objFlujo = new Flujo($db, $texp, $usua_doc);
	$arrEtapas = split('-', $flujo);
	$expEstadoActual = ($_GET['codigoFldExp'] != null) ? $_GET['codigoFldExp'] : $arrEtapas[0];
	
	$arrayAristas =$objFlujo->aristasSiguiente($expEstadoActual);
	$fldCodigos = "999999, ";
	$arrayNodos = $objFlujo->nodosSig;
	if($procAutomatico)
	{
	$k = 0;
	if($arrayNodos)
	{
	?><select name="flujo"  class="select"><?
	
		foreach ($arrayNodos as $value){
			$fldCodigos .= "$value ,";
			$aristaS = $arrayAristas[$k];
			$whereFlujos = " and SGD_FEXP_CODIGO in ($fldCodigos 999999)";
			if($procAutomatico==1)
			{
			$isql = "select * FROM SGD_FEXP_FLUJOEXPEDIENTES 
					where SGD_PEXP_CODIGO='$texp'  
					 and SGD_FEXP_CODIGO in ($value)
					 ORDER BY 	SGD_FEXP_ORDEN";	
			}else 
			{
			$isql = "select * FROM SGD_FEXP_FLUJOEXPEDIENTES 
					where SGD_PEXP_CODIGO='$texp'  
					 ORDER BY 	SGD_FEXP_ORDEN";		
			}
			
			$rs=$db->query($isql);
			$nombre_flujo = $rs->fields["SGD_FEXP_DESCRIP"];
			$ordenFlujo = $rs->fields["SGD_FEXP_ORDEN"];
			$terminoFlujo = $rs->fields["SGD_FEXP_TERMINOS"];
			if($codigo_flujo==$codigoFldExp) 
			{
				$datoss = " selected ";
			}
			else
			{
				$datoss = " ";
			}
			?>
			<option value=<?=$value?>-<?=$aristaS?>  <?=$datoss?>> <?=$ordenFlujo?> - <?=$nombre_flujo?> -><?=$terminosFlujo?> </option>
			<?
			$k++;
		}
	?>
	</select>

<?
			$grabarDisabled = 'visibility:visible';
	}else { //No hay mas etapas en el proceso
		echo "<SPAN class=leidos>El proceso no tiene m&aacute;s etapas, por lo tanto no se puede hacer ning&uacute;n cambio.</span>";
			$grabarDisabled = 'visibility:hidden';		
	}
	}else 
	{
		$concatCodigoFlujo = $db->conn->Concat("SGD_FEXP_CODIGO","'-000'");
		$isql = "Select SGD_FEXP_DESCRIP, $concatCodigoFlujo
				  FROM SGD_FEXP_FLUJOEXPEDIENTES 
				  Where SGD_PEXP_CODIGO='$texp'  
					 ORDER BY 	SGD_FEXP_ORDEN";
		$rs=$db->query($isql);
		if($rs){
			print $rs->GetMenu2("flujo", "$flujo", "0:-- Seleccione --", false,"","class='select'");
			$grabarDisabled = 'visibility:visible';
		}else {
			echo "<SPAN class=leidos>El proceso no tiene m&aacute;s etapas.</span>";
			$grabarDisabled = 'visibility:hidden';
			
		}
	}
if(!$modificar)
{
}
else 
{
	echo "<SPAN class=leidos>No puede cambiar el Estado del Expediente.</span>";
}
if($grabarFlujo)
{
  /**  INTENTA ACTUALIZAR LA CAUSAL 
    *  Si esta no esta entonces simplemente le inserte
	*/
  if(!$ddca_causal) 
  	$ddca_causal=0;
		
	if(!$deta_causal) 
	
	$objFlujo = new Flujo($db, $texp,$usua_doc);
	list ($estadoNuevo, $aristaActual) = split('-', $flujo);
	$expEstadoActual = $objFlujo->actualNodoExpediente($numeroExpediente);
	$observa .= " ($flujo_nombre)";
	$estadoModificado = $objFlujo->cambioNodoExpediente($numeroExpediente,$numRad,$estadoNuevo,$aristaActual,0,"Cambio Manual. ($flujo_nombre)",$_GET['texp']);
	echo "<input type='hidden' value='$estadoModificado' name='estadoModificado2'>";
   }
   ?>
      </td>
  </tr>
	<TR bgcolor="White"><TD width="100">
				<center>
				<img src="<?=$ruta_raiz?>/iconos/tuxTx.gif" alt="Tux Transaccion" title="Tux Transaccion">
				</center>
		</td><TD align="left">
        <span class="etextomenu">
        </span>
	        <textarea name=observa cols=70 rows=3 class=ecajasfecha></textarea>
			</TD></TR>

  </td></tr>
	<tr><TD>
	<input type=submit name=grabarFlujo value='Grabar Cambio' class='botones' style="<?=$grabarDisabled?>">
	<input name="cerrar" type="button" class="botones_funcion" id="envia22" onClick="opener.regresar(); window.close();" value=" Cerrar ">

	</TD></tr>
</table>
</form>
</CENTER>

</body>
</html>
