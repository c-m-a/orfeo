<?php
session_start();
import_request_variables("gp", "");
if (!$ruta_raiz) $ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once "$ruta_raiz/include/tx/Expediente.php";
$db = new ConnectionHandler( "$ruta_raiz" );
//$db->debug = true;
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&tipo=$tipo&codp=$codp&codig=$codig";
?>
<html>
<head>
<title>RELACI&Oacute;N ENTRE TIPOS DE ALMACENAMIENTO</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF">
<form name="relacionTiposAlmac" action="<?=$encabezadol?>" method="POST" >
<?
if($grabar){
if($cant1=="" and $ver==1)echo "Falta la cantidad para el item 1 "; 
elseif($cant2=="" and $ver2==2)echo "Falta la cantidad para el item 2 "; 
elseif($cant3=="" and $ver3==3)echo "Falta la cantidad para el item 3 "; 
elseif($cant4=="" and $ver4==4)echo "Falta la cantidad para el item 4 "; 
elseif($cant5=="" and $ver5==5)echo "Falta la cantidad para el item 5 "; 
else{
	if($ver==1){
		for($i=1;$i<=$cant1;$i++){
			
			$hijoc=$nomb1." ".$i;
			$Shijoc=$sig1.$i;
			$nomc=strtoupper($hijoc);
			$sigc=strtoupper($Shijoc);
			echo 1;
			$sec=$db->conn->nextId( 'SEC_EDIFICIO' );
			
			$sql="insert into sgd_eit_items (sgd_eit_codigo,sgd_eit_cod_padre,sgd_eit_nombre,sgd_eit_sigla) values ( '$sec','$codig','$nomc','$sigc')";
			//$db->conn->debug=true;
			$rs=$db->conn->Execute($sql);
			if($rs->EOF)$t+=1;
			if($ver2==2){
				for($i2=1;$i2<=$cant2;$i2++){
					$hijoc2=$nomb2." ".$i2;
					$Shijoc2=$sig2.$i2;
					$nomc2=strtoupper($hijoc2);
					$sigc2=strtoupper($Shijoc2);
					$sec2=$db->conn->nextId( 'SEC_EDIFICIO' );
					$sql2="insert into sgd_eit_items (sgd_eit_codigo,sgd_eit_cod_padre,sgd_eit_nombre,sgd_eit_sigla) values ('$sec2','$sec','$nomc2','$sigc2')";
					//$db->conn->debug=true;
					$rs2=$db->conn->Execute($sql2);
					if($rs2->EOF)$t+=1;
					if($ver3==3){
						for($i3=1;$i3<=$cant3;$i3++){
							$hijoc3=$nomb3." ".$i3;
							$Shijoc3=$sig3.$i3;
							$nomc3=strtoupper($hijoc3);
							$sigc3=strtoupper($Shijoc3);
							$sec3=$db->conn->nextId( 'SEC_EDIFICIO' );
							$sql3="insert into sgd_eit_items (sgd_eit_codigo,sgd_eit_cod_padre,sgd_eit_nombre,sgd_eit_sigla) values ( '$sec3','$sec2','$nomc3','$sigc3')";
							//$db->conn->debug=true;
							$rs3=$db->conn->Execute($sql3);
							if($rs3->EOF)$t+=1;
							if($ver4==4){
								for($i4=1;$i4<=$cant4;$i4++){
									$hijoc4=$nomb4." ".$i4;	
									$Shijoc4=$sig4.$i4;
									$nomc4=strtoupper($hijoc4);
									$sigc4=strtoupper($Shijoc4);
									$sec4=$db->conn->nextId( 'SEC_EDIFICIO' );
									$sql4="insert into sgd_eit_items (sgd_eit_codigo,sgd_eit_cod_padre,sgd_eit_nombre,sgd_eit_sigla) values ( '$sec4','$sec3','$nomc4','$sigc4')";
									//$db->conn->debug=true;
									$rs4=$db->conn->Execute($sql4);
									if($rs4->EOF)$t+=1;
									if($ver5==5){
										for($i5=1;$i5<=$cant5;$i5++){
											$hijoc5=$nomb5." ".$i5;	
											$Shijoc5=$sig5.$i5;
											$nomc5=strtoupper($hijoc5);
											$sigc5=strtoupper($Shijoc5);
											$sec5=$db->conn->nextId( 'SEC_EDIFICIO' );
											$sql5="insert into sgd_eit_items (sgd_eit_codigo,sgd_eit_cod_padre,sgd_eit_nombre,sgd_eit_sigla) values ('$sec5','$sec4','$nomc5','$sigc5')";
											//$db->conn->debug=true;
											$rs5=$db->conn->Execute($sql5);
											if($rs5->EOF)$t+=1;
											if($ver6==6){
												for($i6=1;$i6<=$cant6;$i6++){
													$hijoc6=$nomb6." ".$i6;	
													$Shijoc6=$sig6.$i6;
													$nomc6=strtoupper($hijoc6);
													$sigc6=strtoupper($Shijoc6);
													$sec6=$db->conn->nextId( 'SEC_EDIFICIO' );
													$sql6="insert into sgd_eit_items (sgd_eit_codigo,sgd_eit_cod_padre,sgd_eit_nombre,sgd_eit_sigla) values ('$sec6','$sec5','$nomc6','$sigc6')";
													//$db->conn->debug=true;
													$rs6=$db->conn->Execute($sql6);
													if($rs6->EOF)$t+=1;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
if($t==0)echo "No se pudo ingresar el registro";
else echo "Los registros fueron ingresados";
}
?>
<table border="0" width="90%" cellpadding="0" class="borde_tab">
<tr>
  <td height="35" colspan="4" class="titulos2">
  <center>RELACI&Oacute;N ENTRE TIPOS DE ALMACENAMIENTO</center>
  </td>
</tr>
<tr>
<td class="titulos5" colspan="2" >
<div id="codigD">
<?
$sq="select sgd_eit_nombre from sgd_eit_items where sgd_eit_cod_padre='$codp'";
$rt=$db->conn->Execute($sq);
if(!$rt->EOF)$nop=$rt->fields['SGD_EIT_NOMBRE'];
$nod=explode(' ',$nop);
echo $nod[0]."  ";
$c=0;
$cp=0;
$conD=$db->conn->Concat("sgd_eit_codigo","'-'","sgd_eit_nombre");
$sqli="select ($conD) as detalle,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre='$codp' or sgd_eit_codigo= '$codp'";
$rsi=$db->conn->Execute($sqli);
print $rsi->GetMenu2('codigo',$codig,true,false,"","class=select");
?>


</div>
</td >
<td colspan=2 class="titulos5"> Padre<input type="text" name="codig"> </td>
</tr>
<tr>
<td class="titulos2" align="center">&nbsp;</td>
<td class="titulos2" align="center">Hijo</td>
<td class="titulos2" align="center">Sigla</td>
<td class="titulos2" align="center">Cantidad</td>
</tr>
<?
if ($ver=='1')$st="checked";
?>
<tr>
<td class="titulos5" align="center"><input name="ver" type="checkbox" class="select" value="1" <?=$st?>></td>
<td class="titulos5" align="center"><input type="text" name="nomb1" value=<?=$nomb1?>></td>
<td class="titulos5" align="center"><input type="text" name="sig1" value=<?=$sig1?>></td>
<td class="titulos5" align="center"><input type="text" name="cant1" value=<?=$cant1?>></td>
</tr>
<?
if ($ver2=='2')$st2="checked";
?>
<tr>
<td class="titulos5" align="center"><input name="ver2" type="checkbox" class="select" value="2" <?=$st2?>></td>
<td class="titulos5" align="center"><input type="text" name="nomb2" value=<?=$nomb2?>></td>
<td class="titulos5" align="center"><input type="text" name="sig2" value=<?=$sig2?>></td>
<td class="titulos5" align="center"><input type="text" name="cant2" value=<?=$cant2?>></td>
</tr>
<?
if ($ver3=='3')$st3="checked";
?>
<tr>
<td class="titulos5" align="center"><input name="ver3" type="checkbox" class="select" value="3" <?=$st3?>></td>
<td class="titulos5" align="center"><input type="text" name="nomb3" value=<?=$nomb3?>></td>
<td class="titulos5" align="center"><input type="text" name="sig3" value=<?=$sig3?>></td>
<td class="titulos5" align="center"><input type="text" name="cant3" value=<?=$cant3?>></td>
</tr>
<?
if ($ver4=='4')$st4="checked";
?>
<tr>
<td class="titulos5" align="center"><input name="ver4" type="checkbox" class="select" value="4" <?=$st4?>></td>
<td class="titulos5" align="center"><input type="text" name="nomb4" value=<?=$nomb4?>></td>
<td class="titulos5" align="center"><input type="text" name="sig4" value=<?=$sig4?>></td>
<td class="titulos5" align="center"><input type="text" name="cant4" value=<?=$cant4?>></td>
</tr>
<?
if ($ver5=='5')$st5="checked";
?>
<tr>
<td class="titulos5" align="center"><input name="ver5" type="checkbox" class="select" value="5" <?=$st5?>></td>
<td class="titulos5" align="center"><input type="text" name="nomb5" value=<?=$nomb5?>></td>
<td class="titulos5" align="center"><input type="text" name="sig5" value=<?=$sig5?>></td>
<td class="titulos5" align="center"><input type="text" name="cant5" value=<?=$cant5?>></td>
</tr>
<?
if ($ver6=='6')$st6="checked";
?>
<tr>
<td class="titulos5" align="center"><input name="ver6" type="checkbox" class="select" value="6" <?=$st6?>></td>
<td class="titulos5" align="center"><input type="text" name="nomb6" value=<?=$nomb6?>></td>
<td class="titulos5" align="center"><input type="text" name="sig6" value=<?=$sig6?>></td>
<td class="titulos5" align="center"><input type="text" name="cant6" value=<?=$cant6?>></td>
</tr>
<tr><td class="titulos2" align="center" colspan="4"> <input type="submit" name="grabar" class="botones" value="GRABAR" >
    <input type="button" name="cerrar" class="botones" value="SALIR" onClick="window.close();opener.regresar();"></td></tr>
</table>

</form>
</body>
</html>