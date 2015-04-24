<?php
session_start();
$krd        = $_SESSION["krd"];
$dependencia= $_SESSION["dependencia"];
$usua_doc   = $_SESSION["usua_doc"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tip3desc   = $_SESSION["tip3desc"];
$tip3img    = $_SESSION["tip3img"];
$codusuario = $_SESSION["codusuario"];

/*
 * Lista Subseries documentales
 * @autor Jairo Losada
 * @fecha 2009/06 Modificacion Variables Globales. Arreglo cambio de los request Gracias a recomendacion de Hollman Ladino
 */
foreach ($_GET as $key => $valor) ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

$ruta_raiz = '..';

include_once ($ruta_raiz . '/include/db/ConnectionHandler.php');
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug = true;

if (!$_SESSION['dependencia'])
  include_once "../rec_session.php";
?>
<html>
<head>
<title>Untitled Document</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
<?php
 if (!$radicados)  {
    if ($checkValue)  {
	   $num = count($checkValue);
	   $i = 0;
	   while ($i < $num)  {
	      $record_id = key($checkValue);
	      $radicadosSel[$i] = $record_id;
		  $setFiltroSelect .= $record_id ;
		  if ($i<=($num-2))  $setFiltroSelect .= ",";
  	      next($checkValue);
	      $i++;
	   }

	   if ($radicadosSel) 	$whereFiltro = " and a.anex_codigo in($setFiltroSelect)";
    } // FIN  if ($checkValue)
 
    if ($setFiltroSelect) $radicados = $setFiltroSelect;
    $procradi = $radicados;
    echo "<input type=hidden name=radicados value='$radicados'>";
 }else  {
    $procradi= $radicados;
    echo "<input type=hidden name=radicados value='$radicados'>";
 }
//$radicados_sel = split(",",$radicados);
?>
<script>
function back1() {
    history.go(-1);
}

function generar_envio() {
   solonumeros();
}

function solonumeros() {
 jh1 = document.forma.elements['envio_peso'].value;
 if(jh1) {
    var1 =  parseInt(jh1);
		if(var1 != jh1) {
			alert('Por favor  introduzca el peso correctamente.' );
			//document.forma.submit();
			return false;
		  } else {
		   document.forma.submit();
      }
 } else {
 	alert('Debe introducir el peso.' );
 }
}
<?php
if(!$reg_envio) {
	echo "function calcular_precio() { \n";
  $ruta_raiz = "..";
	$no_tipo="true";
  include "../config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
  $db = new ConnectionHandler("$ruta_raiz");	 
    
  define('ADODB_FETCH_ASSOC',2);
  $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

  $isql = "SELECT a.SGD_FENV_CODIGO,
                    a.SGD_CLTA_DESCRIP,
                    a.SGD_CLTA_PESDES,
                    a.SGD_CLTA_PESHAST,
                    b.SGD_TAR_VALENV1,
                    b.SGD_TAR_VALENV2
						FROM SGD_CLTA_CLSTARIF a,
                    SGD_TAR_TARIFAS b
            WHERE a.SGD_FENV_CODIGO = b.SGD_FENV_CODIGO AND
                  a.SGD_TAR_CODIGO = b.SGD_TAR_CODIGO";
  	$rsEnvio = $db->conn->query($isql);
//    	ora_commiton($handle);
//      $cursor = ora_open($handle);
//		  ora_parse($cursor,$isql) ;
//		  ora_exec($cursor);
//  		  $empresas_envio = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		  echo "\n";
	 do {
	   $valor_local = $rsEnvio->fields["SGD_TAR_VALENV1"];
	   $valor_fuera = $rsEnvio->fields["SGD_TAR_VALENV2"];
	   $valor_certificado = $rsEnvio->fields["SGD_TAR_VALENV1"];
	   $rango = $rsEnvio->fields["SGD_CLTA_DESCRIP"];
	   $fenvio =$rsEnvio->fields["SGD_FENV_CODIGO"];
	   echo "if(document.forma.elements['empresa_envio'].value==$fenvio)
			{
				if(document.getElementById('envio_peso').value>=".$rsEnvio->fields["SGD_CLTA_PESDES"]." &&  document.getElementById('envio_peso').value<=".$rsEnvio->fields["SGD_CLTA_PESHAST"].") \n
									{
						document.getElementById('valor_gr').value = '$rango';
						
						dp_especial='$dependencia';
						if(document.forma.elements['destino'].value=='$depe_municipio' || (dp_especial=='840' && (document.forma.elements['destino'].value=='FLORIDABLANCA' || document.forma.elements['destino'].value=='GIRON (SAN JUAN DE)' || document.forma.elements['destino'].value=='PIEDECUESTA'))   )    
						{
								valor = $valor_local + 0;
						}else{
							valor = $valor_fuera +0 ;
						}
					}
				}
	   ";
//	 }while($empresas_envio = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
 		  $rsEnvio->MoveNext();
	}while (!$rsEnvio->EOF);
?>
	peso = document.getElementById('envio_peso').value+0;
	document.getElementById('valor_unit').value = valor ;
}
/*
function mostrar_guia() {
	if(document.forma.elements['empresa_envio'].value==105)
//		alert(document.forma.elements['empresa_envio'].value);

		document.getElementById('guia').style.display="block" ;					
}
*/
<? } ?>
</script>
</head>
<body>
<span class=etexto>
<center>
<a class="vinculos" href='../envios/cuerpoEnvioNormal.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&radicados=$radicados&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&nomcarpeta=$nomcarpeta"?>'>Devolver a Listado</a>
</center></span>
<table><tr><td></td></tr></table>
<center>
<table><tr><td></td></tr></table>
<table width="100%" class="borde_tab">
<tr class="titulos2"><td align="center">
ENVIO DE DOCUMENTOS
</td></tr>
</table>
</center>
<form name='forma' action='envia.php?<?=session_name()."=".session_id()."&krd=".$_SESSION['krd']."&fecha_h=$fechah&dep_sel=$dep_sel&whereFiltro=$whereFiltro&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&no_planilla=$no_planilla&codigo_envio=$codigo_envio&verrad_sal=$verrad_sal&nomcarpeta=$nomcarpeta"?>' method="post">
<?php
//print_r($_POST);
  if(!$reg_envio) {
?>
<table><tr><td></td></tr></table>
<table border="0" width="100%" class="borde_tab">
	<!--DWLayoutTable-->
	<tr class="titulos2">
		<td >Empresa De envio</td>
		<td >Peso(Gr)</td>
		<td >U.Medida</td>
		<td colspan="2" >Valor Total C/U</td>
	</tr>
	<tr class=timparr>
	<td height="26" align="center"><font size=2><B>
<?php
		include "$ruta_raiz/include/query/envios/queryEnvia.php";
		$rsEnv = $db->conn->query($sql);
			if(!$empresa_envio) $empresa_envio=101;
			print $rsEnv->GetMenu2("empresa_envio","$empresa_envio",false, false, 0," class='select' onClick='calcular_precio();'");
   ?>
   </td>
   <td> <input type=text name=envio_peso id=envio_peso value='<?=$envio_peso?>' size=6 onChange="calcular_precio();" class="tex_area"></td>
		<TD><input type=text name=valor_gr id=valor_gr  value='<?=$valor_gr?>' size=30 disabled class="tex_area"> </td>
		<td align="center"> <input type=text name=valor_unit id=valor_unit  readonly   value='<?=$valor_unit?>'  class="tex_area"> </td>
		<td> <input type=button name=Calcular_button id=Calcular_button Value=Calcular onClick='calcular_precio();' class="tex_area"> </td>
    </tr>
	<tr  class=titulos2 style="display:none" id="guia">
	<td colspan="10" >No. Guia : 
	<input type="text" name="guia_f" value="" size="15" class="tex_area">

</td>
</tr>

  </table>
<?php
  }
  if($reg_envio) {
    // No hace nada
  }
  ?>
  <table><tr><td></td></tr></table>
<table border="0" width="100%" class="borde_tab">
	<!--DWLayoutTable-->
	<tr class="titulos2">
		<td valign="top">Radicado</td>
		<td valign="top">Radicado Padre</td>
		<td valign="top">Destinatario</td>
		<td valign="top">Direccion</td>
		<td valign="top">Municipio</td>
		<td valign="top">Depto</td>
	</tr>
<?php
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$isql = 'SELECT a.ANEX_RADI_NUME,
                  a.ANEX_NOMB_ARCHIVO,
                  a.ANEX_DESC,
                  a.SGD_REM_DESTINO,
                  a.SGD_DIR_TIPO,
                  a.RADI_NUME_SALIDA,
                  b.RADI_NUME_DERI,
                  b.RA_ASUN
			      FROM ANEXOS a,RADICADO b
            WHERE a.radi_nume_salida = b.radi_nume_radi' .
                  $whereFiltro . ' AND
                  anex_estado = 3 AND
                  a.sgd_dir_tipo <> 7 ' . $comb_salida . '
            ORDER BY a.SGD_DIR_TIPO ';
  if ($reg_envio)
	  $db = new ConnectionHandler("$ruta_raiz");	 
  
	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	$rsEnviar = $db->conn->query($isql);	
	//$no_registros = $rsEnviar->recordcount(); 
	$igual_destino = "si";

	if (!$rsEnviar->fields["ANEX_RADI_NUME"]) {
    // No hace nada!!! QUE MAL PROGRAMADO COMENTARIO HECHO por Cmauricio Parra
	}else {
		$pCodDepAnt = "";
		$pCodMunAnt = "";
		if (!$reg_envio)  { 
			while (!$rsEnviar->EOF) {
			$verrad_sal     = $rsEnviar->fields["RADI_NUME_SALIDA"];   //OK
			$verrad         = $rsEnviar->fields["RADI_NUME_SALIDA"];     //OK
			$verrad_padre   = $rsEnviar->fields["RADI_NUME_DERI"];     
			$sgd_dir_tipo   = $rsEnviar->fields["SGD_DIR_TIPO"];
			$rem_destino    = $rsEnviar->fields["SGD_DIR_TIPO"];
			$anex_radi_nume = $rsEnviar->fields["RADI_NUME_SALIDA"];
			$dep_radicado   = substr($verrad_sal,4,3);
			$ano_radicado   = substr($verrad_sal,0,4);
			$carp_codi      = substr($dep_radicado,0,2);
			$radi_path_sal = "/$ano_radicado/$dep_radicado/docs/$ref_pdf";

			if (substr($rem_destino,0,1)=="7") $anex_radi_nume = $verrad_sal;
			$nurad = $anex_radi_nume;
				$verrad = $anex_radi_nume;
				$ruta_raiz= "..";
				include "../ver_datosrad.php";
			if ($radicadopadre) $radicado = $radicadopadre;
			if ($nurad) 	      $radicado = $nurad;
			include "../clasesComunes/datosDest.php";
			$dat = new DATOSDEST($db,$radicado,$espcodi,$sgd_dir_tipo,$rem_destino);
			$pCodDep = $dat->codep_us;
			$pCodMun = $dat->muni_us;
			$pNombre = $dat->nombre_us;
			$pPriApe = $dat->prim_apel_us;
			$pSegApe = $dat->seg_apel_us;
			$nombre_us    = substr($pNombre . " " . $pPriApe . " " . $pSegApe,0 ,33);
			$direccion_us = $dat->direccion_us;
			if ($pCodDepAnt == "")   $pCodDepAnt = $pCodDep;
			if ($pCodMunAnt == "")   $pCodMunAnt = $pCodMun;
			if ($pCodDepAnt != $pCodDep)  $igual_destino = "no";		  
			
			if(!$rem_destino) $rem_destino =1; 
			$sgd_dir_tipo = 1;
			echo "<input type='hidden' name='$espcodi' value='$espcodi'>";

			$ruta_raiz = "..";
			include "../jh_class/funciones_sgd.php";
			$a = new LOCALIZACION($pCodDep,$pCodMun,$db);
			$dpto_nombre_us = $a->departamento;
			$muni_nombre_us = $a->municipio;
			$destino         = $muni_nombre_us;
			$departamento_us = $dpto_nombre_us;
			$dir_codigo      = $dat->documento_us;
			include "../envios/listaEnvio.php";
			$cantidadDestinos++;
		 $rsEnviar->MoveNext();
     }
	} 	// no reg_envio
if ($igual_destino == "si")  {
	if (!$reg_envio)  {
?>
<center>
<table class="borde_tab" width="100%">	
<tr >
<td height="21" align="center" valign="top"> 
<center><input name=reg_envio type=button value='GENERAR REGISTRO DE ENVIO DE DOCUMENTO' onClick="generar_envio();" class="botones_largo">
<input name=reg_envio type=hidden value='GENERAR REGISTRO DE ENVIO DE DOCUMENTO' ></center>
</td>
</tr>
</table>
</center>	
<?
	} else  {
	if (!$k)  {
		$rsEnviar->MoveFirst();
		while (!$rsEnviar->EOF) {
			$verrad_sal     = $rsEnviar->fields["RADI_NUME_SALIDA"]; 
			$verrad_padre   = $rsEnviar->fields["RADI_NUME_DERI"];     
			$rem_destino    = $rsEnviar->fields["SGD_DIR_TIPO"];
			if(!$rem_destino) $rem_destino =1; 
				if (!trim($rem_destino))  
					{
						$isql_w = " sgd_dir_tipo is null ";
					}
				else  
					{
						$isql_w = " sgd_dir_tipo='$rem_destino' ";
					}
		$isql="update ANEXOS set ANEX_ESTADO=4,ANEX_FECH_ENVIO=" .$db->conn->OffsetDate(0,$db->conn->sysTimeStamp)."
				where RADI_NUME_SALIDA=$verrad_sal and sgd_dir_tipo <>7 and  $isql_w";
		$rsUpdate = $db->query($isql);
		if ($rsUpdate)  $k++;
			if (!$codigo_envio) {
					$isql = "select SGD_RENV_CODIGO FROM SGD_RENV_REGENVIO
					WHERE ROWNUM <=10
					ORDER BY SGD_RENV_CODIGO DESC ";
					$rsRegenvio = $db->query($isql);	
					$nextval = $rsRegenvio->fields["SGD_RENV_CODIGO"];
					$nextval++;
					$codigo_envio = $nextval;
					$radi_nume_grupo =  $verrad_sal ;
					$isql = "update RADICADO 
					set SGD_EANU_CODIGO=9
						where RADI_NUME_RADI =$verrad_sal";
					//echo $isql;
					$rsUpdate = $db->conn->query($isql);
				} else {
				$nextval = $codigo_envio;
				$valor_unit=0;
			}
		$dir_tipo = $rem_destino;
		$isql = "INSERT INTO SGD_RENV_REGENVIO(USUA_DOC,
                                            SGD_RENV_CODIGO,
                                            SGD_FENV_CODIGO,
                                            SGD_RENV_FECH,
                                            RADI_NUME_SAL,
                                            SGD_RENV_DESTINO,
                                            SGD_RENV_TELEFONO,
                                            SGD_RENV_MAIL,
                                            SGD_RENV_PESO,
                                            SGD_RENV_VALOR,
                                            SGD_RENV_CERTIFICADO,
                                            SGD_RENV_ESTADO,
                                            SGD_RENV_NOMBRE,
                                            SGD_DIR_CODIGO,
                                            DEPE_CODI,
                                            SGD_DIR_TIPO,
                                            RADI_NUME_GRUPO,
                                            SGD_RENV_PLANILLA,
                                            SGD_RENV_DIR,
                                            SGD_RENV_DEPTO,
                                            SGD_RENV_MPIO,
                                            SGD_RENV_OBSERVA,
                                            SGD_RENV_CANTIDAD,
                                            USUA_LOGIN)
		                VALUES('$usua_doc',
                            '$nextval',
                            '$empresa_envio',
                            " . $db->conn->OffsetDate(0,$db->conn->sysTimeStamp) .",
                            '$verrad_sal',
                            '$destino',
                            '$telefono',
                            '$mail',
                            '$envio_peso',
                            '$valor_unit',
                            0,
                            1,
                            '$nombre_us',
                            '$dir_codigo',
                            '$dependencia',
                            '$dir_tipo',
                            '$radi_nume_grupo',
                            '$no_planilla',
                            '$direccion_us',
                            '$departamento_us',
                            '$destino',
                            '$observaciones',
                            1,
                            '$krd')";
			
      $rsInsert = $db->conn->query($isql);	
			$rsEnviar->MoveNext();
			
      //crea registro en hiseventos			
			include_once "$ruta_raiz/include/tx/Historico.php";
			$his = new Historico($db);
			$radicados[]=$verrad_sal;
			$his->insertarHistorico($radicados,  $dependencia ,$codusuario, $dependencia,$codusuario, 'MARCADO COMO ENVIADO', 203);
    //aumenta el numero de guia
		$guia_f++;
		}	//while
	}	//$k
		include "../envios/listaEnvio.php";
			echo "<b><span class=listado2>Registro de Envio Generado</span> </b><br><br>";

		}	 //FIN else no reg_envio
	}else  {
		echo "<hr><table class=borde_tab><tr class=titulosError><td>NO PUEDE SELECCIONAR VARIOS DOCUMENTOS PARA UN MISMO DESTINO CON CIUDAD Y/O DEPARTAMENTO DIFERENTE</td></tr></table><hr>";
	}
  
   }
 ?>
</table>		
</form>
<?php
  $encabezado = 'krd=' . $_SESSION['krd'].
                '&fecha_h=' . $fechah .
                '&radicados=' . $radicados .
                '&dep_sel=' . $dep_sel .
                '&estado_sal=' . $estado_sal . 
                '&estado_sal_max=' . $estado_sal_max .
                '&nomcarpeta=' . $nomcarpeta;
?>
<table><tr><td></td></tr></table>
<center>
<a class=vinculos href='cuerpoEnvioNormal.php?<?=session_name()."=".session_id()."&$encabezado"?>'>Devolver a Listado</a>
</center>
</body>
</html>
