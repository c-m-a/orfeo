<?php
$krdOld = $krd;
session_start();

if(!$krd) $krd = $krdOld;
if (!$ruta_raiz) $ruta_raiz = "..";
include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler( "$ruta_raiz" );
//$db->debug = true;
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&cod=$cod&codp=$codp&tipo=2";

?>
<html>
<head>
<title>EDICION TIPOS DE ALMACENAMIENTO</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF">
<form name="relacionTiposAlmac" action="<?=$encabezadol?>" method="POST" >
<?
if($grabar){
$squ="update sgd_eit_items set SGD_EIT_COD_PADRE='$cod_pa',SGD_EIT_NOMBRE='$nombre',SGD_EIT_SIGLA='$sigla' WHERE SGD_EIT_CODIGO LIKE '$cod'";
//$db->conn->debug=true;
$rs=$db->conn->Execute($squ);
if($rs->EOF)echo "Achivo Modificado";
else echo "No se pudo modificar";
}
?>
<table border="0" width="90%" cellpadding="0" class="borde_tab">
<tr>
<?
$sql="select * from sgd_eit_items where sgd_eit_codigo like '$cod'";
$rs=$db->conn->Execute($sql);
if(!$rs->EOF){
$cod_pa=$rs->fields['SGD_EIT_COD_PADRE'];
$sqlp="select SGD_EIT_NOMBRE,sgd_eit_cod_padre from sgd_eit_items where sgd_eit_codigo like '$cod_pa'";
	$rsp=$db->conn->Execute($sqlp);
	if(!$rsp->EOF){
	$cod_p=$rsp->fields['SGD_EIT_COD_PADRE'];
	$nom_pa=$cod_p."-".$cod_pa."-".$rsp->fields['SGD_EIT_NOMBRE'];
	}
?>
  <td class="titulos2">Nombre Padre:<br>
  Cod_pa-Cod-Nombre
  <?
  $i=1;
  	$sqml1="select SGD_EIT_NOMBRE from sgd_eit_items where sgd_eit_codigo like '$codp'";
	$rse=$db->conn->Execute($sqml1);
	if(!$rse->EOF){
	$nom[$i]="0-".$codp."-".$rse->fields['SGD_EIT_NOMBRE'];
	$codi[$i]=$codp;
	$i++;
	}
 	$sqm1="select * from sgd_eit_items where sgd_eit_cod_padre like '$codp'";
	
	$rs1=$db->conn->Execute($sqm1);
	while(!$rs1->EOF){
		$cod_p=$rs1->fields['SGD_EIT_CODIGO'];
		$nom[$i]=$codp."-".$cod_p."-".$rs1->fields['SGD_EIT_NOMBRE'];
		$codi[$i]=$rs1->fields['SGD_EIT_CODIGO'];
		$sqm2="select * from sgd_eit_items where sgd_eit_cod_padre like '".$codi[$i]."'";
		$rs2=$db->conn->Execute($sqm2);
		$i++;
		while(!$rs2->EOF){
			$cod_p=$rs2->fields['SGD_EIT_CODIGO'];
			$cod_p2=$rs2->fields['SGD_EIT_COD_PADRE'];
			$codi[$i]=$rs2->fields['SGD_EIT_CODIGO'];
			$nom[$i]=$cod_p2."-".$cod_p."-".$rs2->fields['SGD_EIT_NOMBRE'];
			$sqm3="select * from sgd_eit_items where sgd_eit_cod_padre like '".$codi[$i]."'";
			$rs3=$db->conn->Execute($sqm3);
			$i++;
			while(!$rs3->EOF){
				$cod_p=$rs3->fields['SGD_EIT_CODIGO'];
				$codi[$i]=$rs3->fields['SGD_EIT_CODIGO'];
				$cod_p2=$rs3->fields['SGD_EIT_COD_PADRE'];
				$nom[$i]=$cod_p2."-".$cod_p."-".$rs3->fields['SGD_EIT_NOMBRE'];
				$sqm4="select * from sgd_eit_items where sgd_eit_cod_padre like '".$codi[$i]."'";
				$rs4=$db->conn->Execute($sqm4);
				$i++;
				while(!$rs4->EOF){
					$cod_p=$rs4->fields['SGD_EIT_CODIGO'];
					$codi[$i]=$rs4->fields['SGD_EIT_CODIGO'];
					$cod_p2=$rs4->fields['SGD_EIT_COD_PADRE'];
					$nom[$i]=$cod_p2."-".$cod_p."-".$rs4->fields['SGD_EIT_NOMBRE'];
					$sqm5="select * from sgd_eit_items where sgd_eit_cod_padre like '".$codi[$i]."'";
					$rs5=$db->conn->Execute($sqm5);
					$i++;
					while(!$rs5->EOF){
						$cod_p=$rs5->fields['SGD_EIT_CODIGO'];
						$codi[$i]=$rs5->fields['SGD_EIT_CODIGO'];
						$cod_p2=$rs5->fields['SGD_EIT_COD_PADRE'];
						$nom[$i]=$cod_p2."-".$cod_p."-".$rs5->fields['SGD_EIT_NOMBRE'];
						$sqm6="select * from sgd_eit_items where sgd_eit_cod_padre like '".$codi[$i]."'";
						$rs6=$db->conn->Execute($sqm6);
						$i++;
						while(!$rs6->EOF){
							$cod_p=$rs6->fields['SGD_EIT_CODIGO'];
							$codi[$i]=$rs6->fields['SGD_EIT_CODIGO'];
							$cod_p2=$rs6->fields['SGD_EIT_COD_PADRE'];
							$nom[$i]=$cod_p2."-".$cod_p."-".$rs6->fields['SGD_EIT_NOMBRE'];
							$i++;
							$rs6->MoveNext();
						}
						$rs5->MoveNext();
					}
					$rs4->MoveNext();
				}
				$rs3->Movenext();
			}
			$rs2->MoveNext();
		}
		$rs1->MoveNext();
	}
	
	$nombre=$rs->fields['SGD_EIT_NOMBRE'];
 	$sigla=$rs->fields['SGD_EIT_SIGLA'];
	?>
	<td height="30" class="titulos5">
    <div align="center">
      <select name="cod_pa" class="select">
	  <option value="<?=$cod_pa?>" >  <?=$nom_pa?> </option>
	 <?php
echo $i;
	for($p=1;$p<$i;$p++)
{    
    if($nom[$p]!=$nom_pa)print "<option value='".$codi[$p]."'>".$nom[$p]." </font></option>";
}
  ?>
  </select>
  </td>
  <td class="titulos5">Hijo:
  <input type="text" name="nombre" value="<?=$nombre?>" class="listado5">
  </td>
  <td class="titulos5">Sigla:
  <input type="text" name="sigla" value="<?=$sigla?>" class="listado5">
  </td>
  <? }?>
</tr>
<tr>
  <td class="titulos5" colspan="4" align="center">
    <input type="submit" name="grabar" class="botones" value="GRABAR">
	<input type="button" name="cerrar" class="botones" value="SALIR" onClick="window.close();opener.regresar();">
  </td>
</tr>
</table>

</form>
</body>
</html>
