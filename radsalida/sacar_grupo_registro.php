<?
/**
 * Programa que registra la transacción de edición de grupo de radicados de correspondencia masiva, según lo seleccionado en lista_sacar_grupo.php 
 * Retira o recupera los radicados seleccionados de la lista
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */
session_start();
$ruta_raiz = "..";

//Si no está registrada la dependencia recupera la sesión
include_once "$ruta_raiz/class_control/GrupoMasiva.php";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->StartTrans();
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	 
		
if (!$dependencia || !$nombusuario)   
	include "../rec_session.php";
//$db->conn->debug=true;
$fecha_hoy = Date("Y-m-d");
$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
//número de radicados que fueron seleccionados de la lista
$num = count($check_value);
$i = 0; 
$grupoMas = & new GrupoMasiva($db);
//Esta variable almacenará todos los radicados chequeados en el formulario enviado
$retirTodos="";
//Guardará los radicados nuevos a retirar
$retirNueva="";
$fechaHoy = Date("Y-m-d");
?>
<html>
<head>
<title>Enviar Datos</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<form name="form1" method="post" action="lista_sacar_grupo.php?grupo=<?=$grupo?>&pagina=<?=$pagina?><?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max" ?>">
<?

// Se recorre el arreglo de elementos chequeados que llega
while ($i < $num) {
//Se obtiene la llave de cada elelemento del arreglo  				 
	$record_id = key($check_value); 
	
	if ($check_value[$record_id] == "retirar") { 
		$retirTodos=$retirTodos.";".trim($record_id).";";
		
		//se pregunta si el elemento analizado es de los nuevos a retirar
		if (strpos($retirados, trim($record_id))==false){
		  $retirNueva=$retirNueva.",".$record_id.",";
			// se llena el arreglo de los nuevos a retirar
			$retirNuevaArr[]=$record_id;
		}
		next($check_value); 
		++$i;
	}
}

//Se pone el indice del arreglo en el primer elemento, si este tiene elementos
if (count($check_value)>0)
	reset ($check_value);	
$arrRetirados= explode ( ";", $retirados);
$num = count($arrRetirados);
$i = 0; 

//Se recorre el arreglo de los que ya estaban retirados a la hora de cargar el formulario
while ($i < $num) { 		
	$rad=$arrRetirados[$i];
	
	if (strlen($rad)>0){
	
	  // si el radicado a analizar no estaba en el conjunto inicial de retirados
		if (strpos($retirTodos, trim($rad))==false){
			$incluirArr[]=$rad;
	 	}
			
	}
	$i++;
}

$num = count($retirNuevaArr);
$i = 0; 
$textSacados="";

//Recorre el arreglo de los nuevoas a retirar y efectua el retiro de cada uno de ellos
while ($i < $num) {
  
	if (strlen($retirNuevaArr[$i])>0)
		$grupoMas->sacarDeGrupo($grupo,$retirNuevaArr[$i]);
	$textSacados=$textSacados."<BR>".$retirNuevaArr[$i];
	
	$values2["depe_codi"] = $dependencia;
	$values2["hist_fech"] = " $sqlFechaHoy ";
	$values2["usua_codi"] = $codusuario;
	$values2["radi_nume_radi"]=$retirNuevaArr[$i];
	$values2["hist_obse"] = "'Retirado de grupo de Masiva  ($grupo) '";
	$values2["usua_codi_dest"] = $codusuario;
	$values2["usua_doc"] = $usua_doc;
	
	//Llena el histórico de eventos
	if (!$db->insert("hist_eventos",$values2)) {
		$db->conn->RollbackTrans();
		die ("<span class=eerrores>ERROR TRATANDO DE ESCRIBIR EL HISTORICO</span>");
	}

	array_splice($values2,0);
	$i++;                                   
	
}

$num = count($incluirArr);
$i = 0; 
$textRecuper="";

//Recorre el arreglo de los que se ha de incluir nuevamente
while ($i < $num) {

  if (strlen(trim($incluirArr[$i]))>0)
		$grupoMas->incluirEnGrupo($grupo,$incluirArr[$i]);
	$textRecuper=$textRecuper."<BR>".$incluirArr[$i];
	$values2["depe_codi"] = $dependencia;
	$values2["hist_fech"] = " $sqlFechaHoy ";
	$values2["usua_codi"] = $codusuario;
	$values2["radi_nume_radi"]=$incluirArr[$i];
	$values2["hist_obse"] = "'Recuperado de grupo de Masiva  ($grupo) '";
	$values2["usua_codi_dest"] = $codusuario;
	$values2["usua_doc"] = $usua_doc;
	
	//Llena el histórico
	if (!$db->insert("hist_eventos",$values2)){
		$db->conn->RollbackTrans();
		die ("<span class=eerrores>ERROR TRATANDO DE ESCRIBIR EL HISTORICO</span>");
	}

	array_splice($values2,0);
	$i++;
}

$db->conn->CommitTrans();
//Genera el texto de la opetación efectuada, si es necesario
if (count($retirNuevaArr)>0||count($incluirArr)>0) {
?> 


<table border=0 cellspace=2 cellpad=2 WIDTH=50%  class="t_bordeGris" id=tb_general align="left">
	<tr>
	<td colspan="2" class="titulos4">ACCION REQUERIDA COMPLETADA <?=$causaAccion ?> </td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">ACCION REQUERIDA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	EDICION DE GRUPO DE RADICACION MASIVA 
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">GRUPO :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa"><?=$grupo?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$usua_nomb?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">FECHA Y HORA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=date("m-d-Y  H:i:s")?>
	</td>
	</tr>
	<? if (count($retirNuevaArr)>0){ ?>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">RADICADOS EXCLUIDOS :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$textSacados?>
	</td>
	<?}?>
	</tr>
	<? if (count($incluirArr)>0){ ?>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">RADICADOS RECUPERADOS :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$textRecuper?>
	</td>
	</tr>
	<?}?>
	
	
	
</table>
	<?}?>
<BR> 
<input name="envia" type="submit"  class="botones" id="envia"   value="Aceptar">
</form>    
</body>
</html>

