<?
$ruta_raiz = "../../..";
//if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";
$entrada = 0;
$modificaciones = 0;
$salida = 0;
include_once "$ruta_raiz/include/query/flujos/queryEtapas.php";									
include_once "$ruta_raiz/include/query/flujos/queryAristas.php";									


?>
<html>
<head>
<title>Creación de Proceso</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css">

<script language="JavaScript">
<!--
	
//-->
</script>
</head>
<body>
<?
/*
//	include "$ruta_raiz/debugger.php";

	*/
?>
<table width="90%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr align='middle'><td height="25" class="titulos4" colspan="10">ETAPAS QUE TIENE EL FLUJO ACTUALMENTE </td></tr>
</table>
<table WIDTH="90%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >

<tr bgcolor='#6699cc' class='etextomenu' align='middle'>
    <th width='5%'  class="titulos2">ORDEN</th>
    <th width='5%'  class="titulos2">C&Oacute;DIGO</th>
    <th  width='80%' class="titulos2">DESCRIPCI&Oacute;N</th>
    <th width='10%'  class="titulos2">DURACI&Oacute;N (D&iacute;as)</th>
    <?php
    if ($crear == 0) {
    ?>
    	<th width='15%'  class="titulos2">ELIMINAR</th>
    	<th  width='5%' class="titulos2">MODIFICAR</th> 
    <?php
    }
    ?>
</tr>
<?php

$rs=$db->query($sqlEtapas);

while(!$rs->EOF)
{
	$nombreEtapa = $rs->fields["SGD_FEXP_DESCRIP"];
	$ordenEtapa = $rs->fields["SGD_FEXP_ORDEN"];
	$codigoEtapa  = $rs->fields["SGD_FEXP_CODIGO"];
	$terminos = $rs->fields["SGD_FEXP_TERMINOS"];
?>
<tr>
 <td width="10%" class='listado2' ><font size=1>
 	<center><? echo $ordenEtapa ?></center></font>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<center><? echo $codigoEtapa ?></center></font>
 </td>
 <td width="60%" class='listado2' ><font size=3>
 	<center><? echo $nombreEtapa ?></center></font>

 	
 	<?
		//Aquí viene la sección agregada para mostrar las conexiones que tiene la etapa
 	?>
 	<table WIDTH="90%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
		<tr bgcolor='#6699cc' class='etextomenu' align='middle'>
 			<td width="80%" class='titulos2' ><center><font size=1> CONEXIONES </center></font></td>
 			<td width="20%" class='titulos2' ><center>
			<font size=1> Crear 
 			<a  href='javascript:Start("creaArista.php?<?=session_name().'='.session_id().'&$encabezado'?>&proceso=<?=$procesoSelected?>&etapaCreaArista=<?=$codigoEtapa?>",750,600)'>
			<img src="../../../imagenes/add.png" style="border:0">
			</a>
			</font>
</center>
		</td> 			
		</tr>
		
		<?php
			$sqlListadoAristasEntrada = "select * from sgd_fars_faristas where sgd_pexp_codigo = $procesoSelected  ";
			$sqlListadoAristasEntrada .= " and sgd_fexp_codigofin = $codigoEtapa order by  sgd_fars_codigo";
		
			$rsAristasEntrada=$db->query( $sqlListadoAristasEntrada );
			
			while( !$rsAristasEntrada->EOF )
			{
				$nombreArista = $rsAristasEntrada->fields["SGD_FARS_DESC"];
				$codigoArista  = $rsAristasEntrada->fields["SGD_FARS_CODIGO"];
				$codigoEtapaArista  = $rsAristasEntrada->fields["SGD_FEXP_CODIGOINI"];
				
				$sqlNombreEtapa = "select sgd_fexp_descrip from sgd_fexp_flujoexpedientes where sgd_fexp_codigo = $codigoEtapaArista";
				$rsNombreEtapa=$db->query( $sqlNombreEtapa );
				$nombreEtapaEntrada = $rsNombreEtapa->fields['SGD_FEXP_DESCRIP'];
		?>
	<tr>
			<td width="10%" class='listado2' ><font size=1>
			<img src="../../../imagenes/FlechasEntrada2b.gif">  <? echo $codigoArista ?> - <? echo $nombreArista ?> <font color="Green"> llega desde la etapa <? echo "'" . $nombreEtapaEntrada . "'" ?> </font>
		</font>
			</td>
			<td width="10%" class='listado2' ><font size=1>
			<center>
			<a href='javascript:Start("modificaArista.php?<?=$phpsession ?>&aristaAModificar=<?=$codigoArista?>&proceso=<?=$procesoSelected?>",750,600)'>
			<img src="../../../imagenes/modificar.gif">
			</a>
			</center>
     </font>
		</td>
	</tr>
	<?php
		$rsAristasEntrada->MoveNext();
	}
	?>
	<?php

	$sqlListadoAristasSalida = "select * from sgd_fars_faristas where sgd_pexp_codigo = $procesoSelected  ";
	$sqlListadoAristasSalida .= " and sgd_fexp_codigoini = $codigoEtapa order by  sgd_fars_codigo";
		
		$rsAristasSalida=$db->query( $sqlListadoAristasSalida );
		
		while( !$rsAristasSalida->EOF )
		{
			$nombreArista = $rsAristasSalida->fields["SGD_FARS_DESC"];
			$codigoArista  = $rsAristasSalida->fields["SGD_FARS_CODIGO"];
			$codigoEtapaArista  = $rsAristasSalida->fields["SGD_FEXP_CODIGOFIN"];
			
			$sqlNombreEtapa = "select sgd_fexp_descrip from sgd_fexp_flujoexpedientes where sgd_fexp_codigo = $codigoEtapaArista";
			$rsNombreEtapa=$db->query( $sqlNombreEtapa );
			$nombreEtapaSalida = $rsNombreEtapa->fields['SGD_FEXP_DESCRIP'];
	?>
			<tr>
					<td width="10%" class='listado2' ><font size=1>
					<img src="../../../imagenes/FlechasSalida.gif"><? echo $codigoArista ?> - <? echo $nombreArista ?> <font color="Green"> sale a la etapa <? echo "'" . $nombreEtapaSalida . "'" ?> </font></font>
					</td>
					<td width="10%" class='listado2' ><font size=1>
					<center>
					<af href="modificaArista.php?<?=$phpsession ?>&aristaAModificar=<?=$codigoArista?>&proceso=<?=$procesoSelected?>" target="modificacinAristaInicial">
						<img src="../../../imagenes/modificar.gif" onClick="Start('modificaArista.php?<?=$phpsession ?>&aristaAModificar=<?=$codigoArista?>&proceso=<?=$procesoSelected?>',600,600);" > </af>
					</center></font>
				</td>
			</tr>
		<?php
			$rsAristasSalida->MoveNext();
		}
		?>		
		</table>
		
 </td>
 <td width="10%" class='listado2' >
	<font size=1>
 	<center><? echo $terminos ?></center></font>
 </td>
  <?php
    if ($crear == 0) {
    ?> 
    	<td width="60%" class='listado2' ><font size=1>
 			<center>
 				<? 
 					include  ( "$ruta_raiz/include/query/flujos/queryEtapas.php" ); 

 					$cuentaAristas = 0;	
 					$rsVerificaElim = $db->conn->Execute( $queryVerificaElim );
					$cuentaAristas = $rsVerificaElim -> fields["CUENTA"];
					
					 if($cuentaAristas > 0 ){
					 	$resultadoVerificacion = 1;
					 }else {
					 	$resultadoVerificacion = 0;
					 }
 				
 				?>
				<input type="radio" name="etapaAEliminar" value="<?=$codigoEtapa?>" onchange="verificaEliminacion( <?=$codigoEtapa?>, <?=$resultadoVerificacion?>, this.form );"> 			
			</center>
			</font>
 		</td>
 		 <td width="60%" class='listado2' ><font size=1>
 			<center>
 				<input type="image" name="Button" value="Modificar" src="../../../imagenes/modificar.gif" onClick="Start('modificaEtapa.php?<?=$phpsession ?>&etapaAModificar=<?=$codigoEtapa?>&proceso=<?=$procesoSelected?>',500,300);" >
			</center>
</font> 			
 		</td>

    <?php
    }
    ?>
</tr>
<?php
	$rs->MoveNext();
}
?>
</table>

</body>
</html>