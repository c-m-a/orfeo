<?

/***************************************************************************
archivo_automatico.php
este documento es un prototipado polimorfico.
creador: MAURICIO ALEJANDRO QUINCHE RAMIREZ
AÑO 2008


POSEE LAS SIGUIENTES VARIABLES QUE SE MODIFICAN SEGUN EL REQUERIMIENTO
	$dependencia="361"; dependencia del usuario para procesar
	$codusuario="1";   codigo del usuario para procesar
	$usua_doc="508474141";  numero de cedula o identificacion para procesar
	$krd="CLRODRIGUEZ";   login del usuario
	$carp_codi="8";       codigo de la carpeta personal para procesar

*****************************************************************************/
set_time_limit(30000);

session_start();

//$verradOld=$verrad;

/*if (!$ruta_raiz)*/ $ruta_raiz = "..";

ini_set ('error_reporting', E_ALL);
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz../include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumental.php");
include_once( "$ruta_raiz/include/tx/Expediente.php" );
include "$ruta_raiz/include/tx/Tx.php";	



if (!$db)
		$db = new ConnectionHandler($ruta_raiz);


$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
//$db->debug=true;
//$db->conn->debug=true;
//echo "$krd<br>$dependencia";
//if (!$krd or !$dependencia or !$usua_doc)   
//	include "$ruta_raiz/rec_session.php";


?>
<html>
<head>
<title>Enviar Datos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos/orfeo.css" type="text/css">
</head>


<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
<body bgcolor="#FFFFFF" topmargin="0">
<table>
	<tr>
		<td>
<?
	echo "sdgfsdf";
			include_once "../include/query/envios/queryPaencabeza.php";			
/* 			$sqlConcat = $db->conn->Concat($db->conn->substr."($conversion,1,5) ", "'-'",$db->conn->substr."(depe_nomb,1,30) ");
			$sql = "select $sqlConcat ,depe_codi from dependencia 
							order by depe_codi";
			$rsDep = $db->conn->Execute($sql);
			if(!$depeBuscada) $depeBuscada=$dependencia;
			print $rsDep->GetMenu2("dep_sel","$dep_sel",false, false, 0," onChange='submit();' class='select'");
*/
?>
		</td>
	</tr>
</table>


<?
$clave="PROCESAR";
if($clave=="PROCESAR")
{
//	$db->BeginTrans();
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
	
	
/*Nuevo agosto 2008 maqr*/
	$dependencia="210";
	$codusuario="1";
	$usua_doc="34990392";
	$krd="BLOPEZ";
	$carp_codi="10";
//trae el rs con los datos de los radicados con los where acondicionados por dep, usuario, carpeta
	$sql="SELECT r.RADI_NUME_RADI, e.NIT_DE_LA_EMPRESA
	FROM RADICADO r
	inner join BODEGA_EMPRESAS e on e.IDENTIFICADOR_EMPRESA = r.EESP_CODI
	WHERE r.CARP_CODI in (".$carp_codi.") AND r.RADI_USUA_ACTU = '$codusuario' AND r.RADI_DEPE_ACTU = '$dependencia' and CARP_PER ='1'
		   order by 1";
	
	$rs1=$db->query($sql);
		echo $sql;
$cont=0;
$Oexpediente = new Expediente( $db );
	while(!$rs1->EOF)
	{	
		$cont++;
		echo "Contador::---------$cont <br>";
		
//se modifico para habilitar la opcion sin tipificar agosto 2008



// para verificar que el radicado este con trd se activa el siguiente codigo para que no deje pasar sin
//tipificacion

/*
		$sql = "SELECT RADI_NUME_RADI
						FROM SGD_RDF_RETDOCF 
						WHERE RADI_NUME_RADI = '".$rs1->fields["RADI_NUME_RADI"]."'
						AND  DEPE_CODI =  '$dependencia'";
	//					echo $sql;
			$rs=$db->query($sql);
			
//			$radiNumero = $rs->fields["RADI_NUME_RADI"];
//PARA ARCHIVAR VERIFICANDO LA TRD
*/

//si se activa la verificacion de la tipificacion se comenta la siguiente  linea
			$radiNumero = $rs1->fields["RADI_NUME_RADI"];
			
			if ($radiNumero !='' && $rs1->fields["NIT_DE_LA_EMPRESA"]!="") 
			{

		//numero del expediente			
				$sql = "SELECT SGD_EXP_NUMERO,SGD_SEXP_PAREXP1,SGD_SEXP_PAREXP2,SGD_SEXP_PAREXP3 FROM SGD_SEXP_SECEXPEDIENTES 
							WHERE SGD_SEXP_PAREXP1 = '".$rs1->fields["NIT_DE_LA_EMPRESA"]."'";
							
				$rsexp=$db->query($sql);			
				$expediente=$rsexp->fields["SGD_EXP_NUMERO"];
				//incluir expediente
				echo $sql;
				if( $expediente > 0 || $expediente!="")
				{   					
					// Consulta si el radicado está incluido en el expediente.
					$arrExpedientes = $Oexpediente->expedientesRadicado( $radiNumero );
					// Si el radicado está incluido en el expediente digitado por el usuario.
					// !== No idéntico
					echo "<br>Expedientes-----------".$expediente."----------";
					print_r($arrExpedientes);
					if( array_search( $expediente, $arrExpedientes ) !== false )
					{
						print "<hr><font color='red'>El radicado $radiNumero ya está incluido en el expediente.</font><hr>";
// proceso para archivar el radicado
						$rstx = new Tx($db);
						$nombTx = "Archivo de Documentos";
						$radicadosSel[] = $radiNumero;
						$txSql = $rstx->archivar( $radicadosSel, $krd,$dependencia,$codusuario,"ARCHIVO AUTOMATICO");	
						$observacion.="$radiNumero - incluido<br>";

					}
					else
					{
					// Si el radicado no está incluido en algún expediente o si está incluido en un
					// expediente diferente al digitado por el usuario.

						$resultadoExp = $Oexpediente->insertar_expediente( $expediente, $radiNumero, $dependencia, $codusuario, $usua_doc );
						if( $resultadoExp == 1 )
						{
// proceso para incluir en el expediente virtual el radicado
							$observa = "Incluir radicado en Expediente";
							//            include_once "$ruta_raiz/include/tx/Historico.php";
							$radicados[] = $radiNumero;
							$tipoTx = 53;
							$Historico = new Historico( $db );
							$radic=$Historico->insertarHistoricoExp( $expediente, $radicados, $dependencia, $codusuario, "EXPEDIENTE AUTOMATICO", $tipoTx, 0 );
//							echo $radic;
//							$observacion.="$radiNumero - incluido<br>";

// proceso para archivar el radicado
						$rsTx1 = new Tx($db);
						$nombTx = "Archivo de Documentos";
						$radicadosSel[] = $radiNumero;
						$txSql = $rsTx1->archivar( $radicadosSel, $krd,$dependencia,$codusuario,"ARCHIVO AUTOMATICO");	
						$observacion.="$radiNumero - incluido<br>";

						}
						else
						{
							$resultadoExp=0;
							print "<hr><font color=red>No se anexo este radicado $radiNumero al expediente. Verifique que el numero del expediente exista e intente de nuevo.</font><hr>";
						}
					}
					
//este codigo era solo de prueba para verificaciones
/*
					if( $resultadoExp != 150 )
					{

						$rs = new Tx($db);
						$nombTx = "Archivo de Documentos";
						$radicadosSel[] = $radiNumero;
						$txSql = $rs->archivar( $radicadosSel, $krd,$dependencia,$codusuario,"ARCHIVO AUTOMATICO");	
						$observacion.="$radiNumero - incluido<br>";
						echo "5645656";
					}					
*/			
				}
				else
				{
					$observacion.="$radiNumero - NO INCLUIDO sin EXPEDIENTE<br>";
				}
			}
			else
			{
				$observacion.="$radiNumero - NO INCLUIDO sin TRD<br>";
			}				
		$rs1->MoveNext();
	}
	echo $observacion;

//$db->conn->debug=true;
//$db->CommitTrans();
}
?>


</body>
</html>
