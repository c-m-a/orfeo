<?
/**
 *  @name :   ubicacionArchivo.php
 *  @desc :   Genera la ubicacion  teniendo  en cuenta la  parte  
 *            dinamica con  los  script ../js/Archivo.js y archivo/funtionArchivo.php.
 *  @author  :  Hardy  Deimont Niño Velasquez.
 *  @version 0.1
 */
//print_r($_GET);

require_once ("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$db = new ConnectionHandler ( $ruta_raiz );
$objHistorico = new Historico ( $db );
$db->conn->SetFetchMode ( ADODB_FETCH_ASSOC );
/**
 * @name function generarUbicacion
 * @param unknown_type $db  coneccion
 * @param entero $codigo  
 * @param entero $bandera
 * @return String
 */
function generarUbicacion($db, $codigo, $bandera) {
	$query = "select SGD_EIT_NOMBRE,SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,CODI_DPTO,CODI_MUNI from SGD_EIT_ITEMS where SGD_EIT_CODIGO= '$codigo' order by SGD_EIT_NOMBRE";
	$rs = $db->query ( $query );
	$son = explode ( " ", $rs->fields ["SGD_EIT_NOMBRE"] );
	if ($rs->fields ["SGD_EIT_COD_PADRE"] == 0) {
		$query = "select distinct(m.MUNI_NOMB),m.MUNI_CODI FROM MUNICIPIO m , SGD_EIT_ITEMS i WHERE m.MUNI_CODI=i.CODI_MUNI and DPTO_CODI='" . $rs->fields ['CODI_DPTO'] . "'  and MUNI_CODI='" . $rs->fields ['CODI_MUNI'] . "'  ORDER BY MUNI_NOMB";
		$rs1 = $db->query ( $query );
		$queryDpto = "select distinct(d.DPTO_NOMB),d.DPTO_CODI FROM DEPARTAMENTO d, SGD_EIT_ITEMS i WHERE d.DPTO_CODI=i.CODI_DPTO and i.CODI_DPTO=" . $rs->fields ['CODI_DPTO'] . "ORDER BY DPTO_NOMB";
		$rs2 = $db->query ( $queryDpto );
		$depto = "<TABLE width='100%' border=0><tr><td width='25%' class='titulos2'>DEPARTAMENTO</td> <td width='25%' class='titulos2'>" . $rs2->fields ["DPTO_NOMB"] . "</td>";
		$muni = "<td width='25%' class='titulos2'>MUNICIPIO</td> <td width='25%' class='titulos2'>" . $rs1->fields ["MUNI_NOMB"] . "</td></TR>";
		$edificio = "<tr><td width='25%' class='titulos2'>EDIFICIO</td> <td width='25%' class='titulos2'> <input type=\"hidden\" name=\"exp_edificio2\" id=\"exp_edificio2\" value='" . $rs->fields ["SGD_EIT_CODIGO"] . "'>" . $rs->fields ["SGD_EIT_NOMBRE"] . " 
		
		
		</td>";
		$option [0] = $depto . $muni . $edificio;
		$option [1] = 2;
		return $option;
	
	} else {
		$ban = $bandera + 1;
		$option = generarUbicacion ( $db, $rs->fields ["SGD_EIT_COD_PADRE"], $ban );
		//$son=explode(" ",$rs->fields["SGD_EIT_NOMBRE"]);
		//substr('abcdef', 0, 4);
		if (substr($son [0], 0, 4) == 'PISO' || substr($son [0], 0, 6) == 'SOTANO') {
			$option [0] .= "<td width='25%' class='titulos2'>PISO</td> <td width='25%' class='titulos2'>" . $rs->fields ["SGD_EIT_NOMBRE"] . "<input type=\"hidden\" name=\"exp_piso2\" id=\"exp_piso2\" value='" .$rs->fields ["SGD_EIT_CODIGO"]. "' /></td></tr> \n";
			$option [1] = 1;
			return $option;
		} else {
			if ($option [1] == 1) {
				$option [0] .= "<tr>";
				$opt = 2;
			}
			$option [0] .= "<td width='25%' class='titulos2'>" . $son [0] . "</td> <td width='25%' class='titulos2'> " . $rs->fields ["SGD_EIT_NOMBRE"] . "</td>";
			if ($option [1] == 2) {
				$option [0] .= "</tr>";
				$opt = 1;
			}
			if ($bandera == 0) {
				if ($option [1] == 1)
					$option [0] .= "</tr>";
				
				return $option [0] . "</table>";
			} else {
				$option [1] = $opt;
				return $option;
			}
		}
	}
}

if ($_GET ['item'] == 1) {
	$ubica = $_GET ['codigo'];
}
if ($ubica == NULL) {
  if(!$depe_codi ){
      $depe_codi=$_GET['depeA'];
  }
	?>
<table width="100%" border="0">
	<tr>
		<td width="25%" class='titulos2'>DEPARTAMENTO</td>
		<td width="25%" class='titulos2'><select class='select' id="depto"
			name="depto" onChange="mun()">
			<option>-- Seleccione --</option>
	      <?
 	$queryDpto = "select distinct(d.DPTO_NOMB),d.DPTO_CODI FROM DEPARTAMENTO d, SGD_EIT_ITEMS i,sgd_arch_depe Ar WHERE ar.sgd_arch_edificio= i.sgd_eit_codigo and d.DPTO_CODI=i.CODI_DPTO and sgd_arch_depe = '$depe_codi' ORDER BY DPTO_NOMB";

	$rs = $db->query ( $queryDpto );
	while ( ! $rs->EOF ) {
		echo "<OPTION value=\"" . $rs->fields ["DPTO_CODI"] . "\">" . $rs->fields ["DPTO_NOMB"] . "</OPTION>";
		$rs->MoveNext ();
	}
	?>	
			</select> </td>
		<td width="25%" class='titulos2'>MUNICIPIO</td>
		<td width="25%" class='titulos2'>
		<div id="muni"><select class='select'>
			<option>-- Seleccione --</option>
		</select></div>
		</td>

	</tr>
	<tr>
		<td width="25%" class='titulos2'>EDIFICIO</td>
		<td width="25%" class='titulos2'>
		<div id="edificio"><select class='select' id='exp_edificio2'>
			<option value="0">-- Seleccione --</option>
		</select></div>
		</td>
		<td class='titulos2'>PISO</td>
		<td>
		<div id="piso" class='titulos2'><select class='select'>
			<option>-- Seleccione --</option>
		</select></div>
		</td>
	</tr>
	<tr>
		<td colspan="4">
		<div id="wait"></div>
		</td>
	</tr>
</table>
<?
	if ($_GET ['codigo'] != NULL) {
		?>
<center><input size="100" onClick="ubicacion('ubicacion','<? echo $_GET ['codigo']; ?>',1,'<? echo $_GET['depeA']; ?>','cancelar');" value="cancelar" type="button" class="botones" /><?
	}
} else {
     if(!$depe_codi ){
        $depe_codi=$_GET['depeA'];
     }
	echo generarUbicacion ( $db, $ubica, 0 );
	if($mod != 'not'  and $perm_mod == 2 || $_GET['cambiar']==1){
	?> <center><input size="100" onClick="ubicacion('ubicacion','<? echo $ubica?>',2,'<? echo $depe_codi; ?>','modificar');"	value="Cambiar Ubicacion" type="button" class="botones" /> <input type="hidden"
	name="exp_entre" value="<? echo $ubica?>"> <input type="hidden" name="exp_caja" value="<?
	echo $ubica?>">
     <?
	}
}

?>


