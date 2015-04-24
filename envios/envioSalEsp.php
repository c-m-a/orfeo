<?php
session_start();
$verrad = "";
$ruta_raiz = "..";
if (!$dependencia)   include "$ruta_raiz/rec_session.php";
if($_SESSION['usua_perm_envios'] !=1 ) die(include "$ruta_raiz/errorAcceso.php");
if (!$dep_sel) $dep_sel = $dependencia;
function microtime_float()
{
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}
$db->conn->debug=true;
//$time_start = microtime_float();
?>
<html>
<head>
<title>Envio de Documentos. Orfeo...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css">
<?
 $ruta_raiz = "..";
 include_once "$ruta_raiz/include/db/ConnectionHandler.php";
 $db = new ConnectionHandler("$ruta_raiz");	 


// INSERT EN LA TABLA REG_REGENVIO
$xarray=$_POST['checkValue'];

if($xarray){	
	foreach($xarray as $numRadAnex=>$str){
		
		// consulto en anexos el número de radicado		
		$query="SELECT ANEX_RADI_NUME, RADI_NUME_SALIDA, SGD_DIR_TIPO FROM ANEXOS WHERE anex_codigo='$numRadAnex' ";			
		$rsAnexos=$db->conn->query($query);
		while (!$rsAnexos->EOF) {	
			$numRad=$rsAnexos->fields['ANEX_RADI_NUME'];
			$sgd_dir=$rsAnexos->fields['SGD_DIR_TIPO'];
			if($rsAnexos->fields['RADI_NUME_SALIDA']!=''){			
				$numRadAnt=$numRad;				
				$numRad=$rsAnexos->fields['RADI_NUME_SALIDA'];				
			}
			$rsAnexos->MoveNext();			
		}
		// con el numero real del radicado consulto sus propiedades
		$usua_doc=$_SESSION['usua_doc'];
		$query="SELECT 
				  R.RADI_FECH_RADI,
				  R.RADI_DESC_ANEX, R.RADI_USUA_ACTU, R.RADI_DEPE_ACTU,
				  d.muni_codi, d.dpto_codi, d.id_pais,
				  d.sgd_dir_codigo,
				  d.sgd_dir_nomremdes,
				  d.sgd_esp_codi
				FROM 
				  RADICADO R 
				  INNER JOIN sgd_dir_drecciones D ON R.radi_nume_radi= d.radi_nume_radi
				WHERE d.sgd_dir_tipo='$sgd_dir' AND r.radi_nume_radi='$numRad'";
		$rsRadicado=$db->conn->query($query);
		while (!$rsRadicado->EOF) {	
			$dir_codi=$rsRadicado->fields['SGD_DIR_CODIGO'];
			$MUNI_CODI=$rsRadicado->fields['MUNI_CODI'];
			$DPTO_CODI=$rsRadicado->fields['DPTO_CODI'];
			$ID_PAIS=$rsRadicado->fields['ID_PAIS'];
			$radi_depe_radi=$rsRadicado->fields['RADI_DEPE_ACTU'];
			$ane=$rsRadicado->fields['RADI_DESC_ANEX'];			
			$nombre_usuario_destino=$rsRadicado->fields['SGD_DIUR_NOMREMDES'];			
			$esp_codi=$rsRadicado->fields['SGD_ESP_CODI'];
			$fecha=$rsRadicado->fields['RADI_FECH_RADI'];			
			$rsRadicado->MoveNext();			
		}				
		// municipio
		$query="SELECT MUNI_NOMB FROM MUNICIPIO WHERE MUNI_CODI=$MUNI_CODI AND DPTO_CODI=$DPTO_CODI";					
		$rsMunicipio=$db->conn->query($query);
		while (!$rsMunicipio->EOF) {	
			$municipio=$rsMunicipio->fields['MUNI_NOMB'];
			$rsMunicipio->MoveNext();			
		}
		
		// Departamento
		$query="SELECT DPTO_NOMB FROM DEPARTAMENTO WHERE DPTO_CODI=$DPTO_CODI AND ID_PAIS=$ID_PAIS";			
		
		$rsDepartamento=$db->conn->query($query);
		while (!$rsDepartamento->EOF) {	
			$departamento=$rsDepartamento->fields['DPTO_NOMB'];
			$rsDepartamento->MoveNext();			
		}		
		// Pais
		$query="SELECT NOMBRE_PAIS FROM SGD_DEF_PAISES WHERE ID_PAIS=$ID_PAIS";		
		$rsPais=$db->conn->query($query);
		while (!$rsPais->EOF) {	
			$pais=$rsPais->fields['NOMBRE_PAIS'];
			$rsPais->MoveNext();			
		}		
		// VERIFICO LA BRIGADA A LA QUE PERTENECE, SI ES UNA DIVISIÓN SE COLOCA DIRECTAMENTE EL CODIGO DE LA DIVISION
		// RECUPERO EL REGISTRO DE BODEGA_EMPRESAS PARA RECUPERAR EL PADRE
		$query="SELECT SIGLA_DE_LA_EMPRESA, BRIGADA FROM BODEGA_EMPRESAS WHERE IDENTIFICADOR_EMPRESA = ".$esp_codi;
		
		$rs=$db->conn->query($query);
		while(!$rs->EOF){
			if($rs->fields['BRIGADA']==0 || $rs->fields['BRIGADA']==1 || $rs->fields['BRIGADA']==2){ // verifico si es una división o una unidad
				$brigada=$esp_codi;
				$nombreBrigada=$rs->fields['SIGLA_DE_LA_EMPRESA'];				
			}else{ // verifico si es una brigada					
				$brigada=$rs->fields['BRIGADA'];// Si es una unidad asigno el id de la brigada padre			
				$nombreBrigada=$rs->fields['SIGLA_DE_LA_EMPRESA'];		
			}
			$rs->MoveNext();						
		}			
		if($radiDepeRadi=='999'){
			$radiDepeRadi='998';
		}

		$query="INSERT INTO SGD_RENV_REGENVIO 
					(	SGD_RENV_CODIGO, SGD_FENV_CODIGO, SGD_RENV_FECH, RADI_NUME_SAL, 
						SGD_RENV_DESTINO, SGD_RENV_PESO, SGD_RENV_VALOR, SGD_RENV_CERTIFICADO, 
						SGD_RENV_ESTADO, USUA_DOC, SGD_RENV_NOMBRE, SGD_REM_DESTINO, 
						SGD_DIR_CODIGO, DEPE_CODI, SGD_DIR_TIPO, RADI_NUME_GRUPO, 
						SGD_RENV_DIR, SGD_RENV_DEPTO, SGD_RENV_MPIO, SGD_RENV_CANTIDAD, 
						SGD_RENV_TIPO, SGD_RENV_VALORTOTAL, SGD_RENV_VALISTAMIENTO, SGD_RENV_VDESCUENTO,
						SGD_RENV_VADICIONAL, SGD_RENV_PAIS, SGD_RENV_OBSERVA
					) 
				VALUES (
						'1', 201, TO_DATE('".$fecha."','YYYY-MM-DD'), ".$numRad.", 
						'".$brigada."', 0, 0, 0, 
						1, ".$usua_doc.", '".$nombreBrigada."', 1, 
						$dir_codi, ".$radi_depe_radi.", 1, ".$numRad.", 
						'".$nombre_usuario_destino."', '$departamento', '$municipio', 	1, 
						0, 0, 0, 0, 
						0, '$pais', '$ane')";
		// INSERTO EL REGISTRO EN LA TABLA RENV_REGENVIO
		$INSERT=$db->conn->query($query);
		// CAMBIO DE ESTADO AL RADICADO		
		if($numRadAnt==''){
			$query="UPDATE ANEXOS SET ANEX_ESTADO = '4' WHERE ANEX_RADI_NUME='$numRad' AND RADI_NUME_SALIDA IS NULL AND SGD_DIR_TIPO=$sgd_dir";
		}else{
			$query="UPDATE ANEXOS SET ANEX_ESTADO = '4' WHERE ANEX_RADI_NUME='$numRadAnt' AND RADI_NUME_SALIDA='$numRad' AND SGD_DIR_TIPO=$sgd_dir";
		}
		$UPDATE=$db->conn->query($query);
		
	}
}

 if(!$carpeta) $carpeta=0;
 if(!$estado_sal)   {$estado_sal=2;}
 if(!$estado_sal_max) $estado_sal_max=3;

 if($estado_sal==3) {
    $accion_sal = "Envio de Documentos";
	$pagina_sig = "cuerpoEnvioNormal.php";
	$nomcarpeta = "Radicados Para Envio";
	if(!$dep_sel) $dep_sel = $dependencia;

	$dependencia_busq1 = " and c.radi_depe_radi = $dep_sel ";
	$dependencia_busq2 = " and c.radi_depe_radi = $dep_sel";
 }
 
  if ($orden_cambio==1)  {
 	if (!$orderTipo)  {
	   $orderTipo="desc";
	}else  {
	   $orderTipo="";
	}
 }
 $encabezado = "".session_name()."=".session_id()."&krd=$krd&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&accion_sal=$accion_sal&dependencia_busq2=$dependencia_busq2&dep_sel=$dep_sel&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
 $linkPagina = "$PHP_SELF?$encabezado&orderNo=$orderNo";
 $swBusqDep = "si";
 $carpeta = "nada";
 include "../envios/paEncabeza.php";
 $pagina_actual = "../envios/cuerpoEnvioNormal.php";
 $varBuscada = "radi_nume_salida";
 $pagina_actual="envioSalEsp.php";
 include "../envios/paBuscar.php";  
 $pagina_sig = "../envios/envia.php"; 
 $pagina_sig = "../envios/envia.php";
 
 include "../envios/paOpciones.php";   
	/*  GENERACION LISTADO DE RADICADOS
	 *  Aqui utilizamos la clase adodb para generar el listado de los radicados
	 *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
	 *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
	 */
?>
  <form name=formEnviar action='../envios/envioSalEsp.php?<?=$encabezado?>' method=post>
 <?
    if ($orderNo==98 or $orderNo==99) {
       $order=1; 
	   if ($orderNo==98)   $orderTipo="desc";
       if ($orderNo==99)   $orderTipo="";
	}  
    else  {
	   if (!$orderNo)  {
	   		$orderNo=3;
			$orderTipo="desc";
		}
	   $order = $orderNo + 1;
    }

 	$radiPath = $db->conn->Concat($db->conn->substr."(a.anex_codigo,1,4) ", "'/'",$db->conn->substr."(a.anex_codigo,5,3) ","'/docs/'","a.anex_nomb_archivo");

	// Restricción para que muestre los documentos que son de salida que van para unidades
	$xWhere=" AND (((SELECT D.SGD_ESP_CODI FROM SGD_DIR_DRECCIONES D WHERE D.RADI_NUME_RADI=a.radi_nume_salida AND D.SGD_DIR_TIPO=a.SGD_DIR_TIPO) IS NOT NULL)
  AND substr(a.RADI_NUME_SALIDA, -1)=1) AND (
    SELECT b.sigla_de_la_empresa 
    FROM SGD_DIR_DRECCIONES D 
      INNER JOIN bodega_empresas b 
      ON b.identificador_empresa=d.sgd_esp_codi
    WHERE 
      D.RADI_NUME_RADI=a.radi_nume_salida 
      AND D.SGD_DIR_TIPO=a.SGD_DIR_TIPO
    ) IS NOT NULL ";
	$xcolumns="(
    SELECT b.sigla_de_la_empresa 
    FROM SGD_DIR_DRECCIONES D 
      INNER JOIN bodega_empresas b 
      ON b.identificador_empresa=d.sgd_esp_codi
    WHERE 
      D.RADI_NUME_RADI=a.radi_nume_salida 
      AND D.SGD_DIR_TIPO=a.SGD_DIR_TIPO
    ) as brigada, ";
	include "$ruta_raiz/include/query/envios/queryCuerpoEnvioNormal.php";
	$rs=$db->conn->Execute($isql);
	
	//$nregis = $rs->recordcount();	
	if (!$rs->fields["IMG_Radicado Salida"])  {
		echo "<table class=borde_tab width='100%'><tr><td class=titulosError><center>NO se encontro nada con el criterio de busqueda</center></td></tr></table>";}
	else  {
		$pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
		$pager->toRefLinks = $linkPagina;
		$pager->toRefVars = $encabezado;
		$pager->checkTitulo = true;
		$pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkEnviar);
	}
 //}//GTS
//  $time_end = microtime_float();
//  $time = $time_end - $time_start;
?>
  </form>
<font size="1" color="White" ><?=$time?></font>
</body>

</html>
