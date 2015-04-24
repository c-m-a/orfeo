<?php
session_start();
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 3. 			             */
/*                                                                                   */
/* Copyleft  2008 por :	  	  	                                     */
/* SSPd "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   */
/*   EMPRESA IYU                                             */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*  Infometrika            info@infometrika.com    2009-05  Eliminacino Variables Globales */
/*************************************************************************************/

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$ruta_raiz = ".."; 
$nurad = $_GET["nurad"];
if($_GET["codserie"]) $codserie = $_GET["codserie"];
if($_GET["tsub"]) $tsub = $_GET["tsub"];
if($_GET["tdoc"]) $tdoc = $_GET["tdoc"];
if($_GET["insertar_registro"]) $insertar_registro = $_GET["insertar_registro"];
if($_GET["actualizar"]) $actualizar = $_GET["actualizar"];
if($_GET["borrar"]) $borrar = $_GET["borrar"];
if($_GET["linkarchivo"]) $linkarchivo = $_GET["linkarchivo"];
if($_GET["codiTRDEli"]) $codiTRDEli = $_GET["codiTRDEli"];

if (!$ruta_raiz) $ruta_raiz= "..";
    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	if (!defined('ADODB_FETCH_ASSOC')) define('ADODB_FETCH_ASSOC',2);
   	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	//$db->conn->debug=true;
	include_once ("../include/query/busqueda/busquedaPiloto1.php");
	include_once "$ruta_raiz/include/tx/Historico.php";
    include_once ("$ruta_raiz/class_control/TipoDocumental.php");
    $trd = new TipoDocumental($db);
if ($borrar)
{		//Modificado skina
		$sqlE = "SELECT $radi_nume_radi as RADI_NUME_RADI
					FROM SGD_RDF_RETDOCF r 
					WHERE RADI_NUME_RADI = '$nurad'
				    	AND  SGD_MRD_CODIGO =  '$codiTRDEli'";
		$rsE=$db->conn->query($sqlE);
		$i=0;
		while(!$rsE->EOF)
		{
	    	$codiRegE[$i] = $rsE->fields['RADI_NUME_RADI'];
	    	$i++;
			$rsE->MoveNext();
		}
		$TRD = $codiTRDEli;
		include "$ruta_raiz/radicacion/detalle_clasificacionTRD.php";
	    	$observa = "*Eliminado TRD*".$deta_serie."/".$deta_subserie."/".$deta_tipodocu;
		
		$Historico = new Historico($db);		  
  		  //$radiModi = $Historico->insertarHistorico($codiRegE, $coddepe, $codusua, $coddepe, $codusua, $observa, 33); 
		$radiModi = $Historico->insertarHistorico($codiRegE, $dependencia, $codusuario, $dependencia, $codusuario, $observa, 33); 
		$radicados = $trd->eliminarTRD($nurad,$coddepe,$usua_doc,$codusua,$codiTRDEli);
		$mensaje="Archivo eliminado<br> ";
 	}
  /*
  * Proceso de modificaci�n de una clasificaci�n TRD
  */
  if ($modificar)
	{
  		if ($tdoc !=0 && $tsub !=0 && $codserie !=0 )
			{	//Modificado skina
				$sqlH = "SELECT $radi_nume_radi as RADI_NUME_RADI,
				        	SGD_MRD_CODIGO 
						FROM SGD_RDF_RETDOCF r
						WHERE RADI_NUME_RADI = '$nurad'
				    		AND  DEPE_CODI       =  '$coddepe'";
				$rsH=$db->conn->query($sqlH);
				$codiActu = $rsH->fields['SGD_MRD_CODIGO'];
				$i=0;
				while(!$rsH->EOF)
				{
	    			$codiRegH[$i] = $rsH->fields['RADI_NUME_RADI'];
	    			$i++;
					$rsH->MoveNext();
				}
				$TRD = $codiActu;
		        	include "$ruta_raiz/radicacion/detalle_clasificacionTRD.php";
				
		  		$observa = "*Modificado TRD* ".$deta_serie."/".$deta_subserie."/".$deta_tipodocu;
  		  		$Historico = new Historico($db);		  
  		  		//$radiModi = $Historico->insertarHistorico($codiRegH, $coddepe, $codusua, $coddepe, $codusua, $observa, 32); 
				$radiModi = $Historico->insertarHistorico($codiRegH, $dependencia, $codusuario, $dependencia, $codusuario, $observa, 32); 
		  		/*
		  		*Actualiza el campo tdoc_codi de la tabla Radicados
		  		*/
		 		$radiUp = $trd->actualizarTRD($codiRegH,$tdoc);
				$mensaje="Registro Modificado";
				$isqlTRD = "select SGD_MRD_CODIGO 
						from SGD_MRD_MATRIRD 
						where DEPE_CODI = '$coddepe'
				 	   	and SGD_SRD_CODIGO = '$codserie'
				       		and SGD_SBRD_CODIGO = '$tsub'
					   	and SGD_TPR_CODIGO = '$tdoc'";
			
				$rsTRD = $db->conn->Execute($isqlTRD);
				$codiTRDU = $rsTRD->fields['SGD_MRD_CODIGO'];
				$sqlUA = "UPDATE SGD_RDF_RETDOCF SET SGD_MRD_CODIGO = '$codiTRDU',
						  USUA_CODI = '$codusua'
						  WHERE RADI_NUME_RADI = '$nurad' AND  DEPE_CODI =  '$coddepe'";
				$rsUp = $db->conn->query($sqlUA); 
		$mensaje="Registro Modificado   <br> ";

		}
		
}
		$tdoc = '';
		$tsub = '';
		$codserie = '';

?>

</script>
<body bgcolor="#FFFFFF" topmargin="0">
<br>
<div align="center">
<p>
<?=$mensaje?>
</p>
<input type='button' value='   Cerrar   ' class='botones_largo' onclick='opener.regresar();window.close();'>
</body>
</html> 
