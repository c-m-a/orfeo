<?php
/*
CARLOS BARRERO - carlosabc81@gmail.com
*/
session_start();
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumental.php");
include "$ruta_raiz/include/tx/Tx.php";

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

if($_POST['reasigna'])
	{
	$usuo=split("-",$_POST['usuario']);
	$usud=split("-",$_POST['usuario2']);
	
	if($_POST['todos']!=1)
		$radicados=split(",",trim($_POST['radicado']));
	else
		//funcion para traer los todos los radicados del usuario origen
		$radicados=rad_all($usuo[0],$usuo[1],$db);
	//valida si los radicados pertenecen al usuario origen
	$validacion=valida($radicados,$usuo[1],$usuo[0],$db);
	if($validacion==0)
		{	
			$tx = new Tx($db);
			//$tx->reasignar($radicados, $usuo[2],$usud[1],$usuo[1],$usud[0],$usuo[0],'si','REASIGNACION 	AUTOMATICA',202,0);
			$tx->reasignar($radicados, $usuo[2],$usud[1],$usuo[1],$usud[0],$usuo[0],'si',$_POST['obs'],202,0);
			
		}
	else
		echo "<center><h2><font color='#FF0000'>Error en el radicado no. ".$validacion." este radicado no pertenece al usuario origen. La transacci&oacute;n no se pudo completar.</h2></font></center>";
	}	
function nombre_usuario($codigo,$dependencia,$db)
{
	$sqln="SELECT USUA_NOMB FROM USUARIO WHERE USUA_CODI=".$codigo." AND DEPE_CODI=".$dependencia;
	$rs_n = $db->conn->Execute($sqln);
	$nombre=$rs_n->fields['USUA_NOMB'];
	echo $nombre;
}
function nombre_dependencia($codep,$db)
{
	$sqldep="SELECT DEPE_NOMB FROM DEPENDENCIA WHERE DEPE_CODI=".$codep;
	$rs_dep=$db->conn->Execute($sqldep);
	echo $rs_dep->fields['DEPE_NOMB'];
}
function rad_all($codigo,$dependencia,$db)
{
	//$sql_all="SELECT DISTINCT RADI_NUME_RADI FROM HIST_EVENTOS WHERE DEPE_CODI=".$dependencia." AND USUA_CODI=".$codigo;
	$sql_all="SELECT RADI_NUME_RADI FROM RADICADO WHERE RADI_DEPE_ACTU=".$dependencia." AND RADI_USUA_ACTU=".$codigo;
	$rs_all = $db->conn->Execute($sql_all);
	while(!$rs_all->EOF)
		{
			$rad[]=$rs_all->fields['RADI_NUME_RADI'];
			$rs_all->MoveNext();
		}
	return $rad;
}
function valida($radicados,$dependencia,$codigo,$db)
{
$respuesta=0;
	foreach($radicados as $row)
		{
			$sql_val="SELECT  COUNT(*) CONT 
                  FROM  RADICADO
                  WHERE RADI_NUME_RADI=".$row." AND
                        RADI_DEPE_ACTU=".$dependencia." AND
                        RADI_USUA_ACTU=".$codigo;
//			echo $sql_val;
			$rs_val = $db->conn->query($sql_val);
			$total=$rs_val->fields['CONT'];
			if($total < 1)
				{
					$respuesta=$row;
					break;
				}
		}
return $respuesta;
}
?>
<script>
function deshabilita(opcion)
{
	if(opcion==true)
		document.reasignacion.radicado.disabled=true;
	else
		document.reasignacion.radicado.disabled=false;			
}
</script>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css" type="text/css">
<form method="post" action="<?= $_SERVER['PHP_SELF']?>" name="reasignacion">
<br />
<table width="50%" border="0" cellpadding="0"  class="borde_tab" align="center" cellspacing="5">
<tbody>
	<tr bordercolor="#FFFFFF">    
		<td colspan="2" class="titulos4" align="center">REASIGNACION AUTOMATICA DE RADICADOS</td>
  	</tr>
	<tr bordercolor="#FFFFFF" class="listado2">    
		<td width="42%">USUARIO ORIGEN </td>
    	<td width="58%">
			<select name="usuario" class="select">

					<?php
			$sql_usu = "SELECT USUA_NOMB,
                          USUA_CODI,
                          DEPE_CODI,
                          USUA_LOGIN
                    FROM USUARIO
                    ORDER BY USUA_NOMB";

			$rs_usu = $db->conn->Execute($sql_usu);
			while(!$rs_usu->EOF)
					{
					?>
						<option value="<?= $rs_usu->fields['USUA_CODI']."-".$rs_usu->fields['DEPE_CODI']."-".$rs_usu->fields['USUA_LOGIN'];?>"><?=strtoupper($rs_usu->fields['USUA_NOMB'])?></option>
					<?
						
						$rs_usu->MoveNext();
					}	
			?>
			</select>
		</td>
  	</tr>
	<tr bordercolor="#FFFFFF" class="listado2">    
		<td >USUARIO DESTINO </td>
    	<td>
			<select name="usuario2" class="select">

					<?
			$sql_usu = "SELECT USUA_NOMB, USUA_CODI, DEPE_CODI, USUA_LOGIN FROM USUARIO ORDER BY USUA_NOMB";
			$rs_usu = $db->conn->Execute($sql_usu);
			while(!$rs_usu->EOF)
					{
					?>
						<option value="<?= $rs_usu->fields['USUA_CODI']."-".$rs_usu->fields['DEPE_CODI']."-".$rs_usu->fields['USUA_LOGIN'];?>"><?=strtoupper($rs_usu->fields['USUA_NOMB'])?></option>
					<?
						
						$rs_usu->MoveNext();
					}	
			?>
			</select>

		</td>
  	</tr>
	<tr bordercolor="#FFFFFF" class="listado2">
		<td>TODOS LOS RADICADOS</td>
		<td><input name="todos" type="checkbox" id="todos" value="1" onclick="deshabilita(this.checked);"/></td>
	</tr>
	<tr bordercolor="#FFFFFF" class="listado2">    
		<td  >No RADICADO(S) <br />
		  <strong>Separados por - </strong> </td>
    	<td  ><textarea name="radicado" cols="40" id="radicado"></textarea></td>
  	</tr>
	<tr bordercolor="#FFFFFF" class="listado2">    
		<td  >Observaciones  </td>
    	<td  ><textarea name="obs" cols="40" id="obs"></textarea></td>
  	</tr>
  	<tr bordercolor="#FFFFFF">    
		<td colspan="2" class="titulos4" align="center"><input type="submit" name="Submit" value="Asignar" class="botones" /></td>
 	</tr> 
</tbody>	 
</table>
<input type="hidden" name="reasigna" value="reasigna" />
</form>
<? if(($_POST['reasigna']) && ($validacion==0))	{ ?>
<br />
<table border="0" cellspace="2" cellpad="2" width="50%"  class="t_bordeGris" id="tb_general" align="center">
  <tr>
    <td colspan="2" class="titulos4" align="center">ACCION REQUERIDA
      COMPLETADA
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">ACCION REQUERIDA : </td>
    <td  width="65%" height="25" class="listado2_no_identa">REASIGNACION AUTOMATICA
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">RADICADOS INVOLUCRADOS : </td>
    <td  width="65%" height="25" class="listado2_no_identa">
		<? 
			foreach($radicados as $value)
				{
				echo $value."<br>";
				}
		?>
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO DESTINO : </td>
    <td  width="65%" height="25" class="listado2_no_identa"><? nombre_usuario($usud[0],$usud[1],$db); ?>
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">FECHA Y HORA : </td>
    <td  width="65%" height="25" class="listado2_no_identa"><?=date("m-d-Y  H:i:s")?>
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO ORIGEN: </td>
    <td  width="65%" height="25" class="listado2_no_identa"><? nombre_usuario($usuo[0],$usuo[1],$db); ?>
    </td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">DEPENDENCIA ORIGEN: </td>
    <td  width="65%" height="25" class="listado2_no_identa"><? nombre_dependencia($usuo[1],$db) ?>
    </td>
  </tr>
</table>
<? } ?>
