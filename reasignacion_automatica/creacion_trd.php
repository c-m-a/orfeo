<?
session_start();

$ruta_raiz = "..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
//$db->conn->BeginTrans();

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	

//echo "$krd<br>$dependencia";
if (!$krd or !$dependencia or !$usua_doc)   
	include "$ruta_raiz/rec_session.php";
	
	$sql="select SGD_SRD_CODIGO, SGD_SBRD_CODIGO, SGD_TPR_CODIGO , SOPORTE ,
	to_char(SGD_MRD_FECHINI,'dd/mm/yyyy') AS SGD_MRD_FECHINI , 
	to_char(SGD_MRD_FECHFIN,'dd/mm/yyyy') As SGD_MRD_FECHFIN 
	from sgd_mrd_matrird m where m.DEPE_CODI=361";
	$rs = $db->query($sql);
//	echo  $sql;

		$isqlCount = "select max(sgd_mrd_codigo) as NUMREGT from sgd_mrd_matrird";
		$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$rsC = $db->query($isqlCount);
		$numreg = $rsC->fields["NUMREGT"];
//		$numreg = $numreg+1;
	while(!$rs->EOF)	
	{		
		$record = array(); # Inicializa el arreglo que contiene los datos a insertar
		$record["SGD_MRD_CODIGO"] = ++$numreg;
		$record["DEPE_CODI"]      = 360;
		$record["SGD_SRD_CODIGO"] = $rs->fields["SGD_SRD_CODIGO"];
		$record["SGD_SBRD_CODIGO"]= $rs->fields["SGD_SBRD_CODIGO"];
		$record["SGD_TPR_CODIGO"] = $rs->fields["SGD_TPR_CODIGO"];
		$record["SOPORTE"] = $rs->fields["SOPORTE"];
		$record["SGD_MRD_ESTA"] = '1';
		$record["SGD_MRD_FECHINI"] = $rs->fields["SGD_MRD_FECHINI"];
		$record["SGD_MRD_FECHFIN"] = $rs->fields["SGD_MRD_FECHFIN"];
		$insertSQL = $db->insert("SGD_MRD_MATRIRD", $record, );
		
		if (!$insertSQL)
		{
			 	//$db->conn->RollbackTrans();
		 	 	die ("<span class='alarmas'>ERROR TRATANDO DE ESCRIBIR EL HISTORICO");
		}
		
/*		$isql = "insert into sgd_mrd_matrird 
		(SGD_MRD_CODIGO,DEPE_CODI,SGD_SRD_CODIGO,SGD_SBRD_CODIGO,SGD_TPR_CODIGO,SOPORTE,SGD_MRD_ESTA,SGD_MRD_FECHINI,SGD_MRD_FECHFIN)
		values(".++$numreg.",360,".$rs->fields["SGD_SRD_CODIGO"].",".$rs->fields["SGD_SBRD_CODIGO"].",".$rs->fields["SGD_TPR_CODIGO"].",
		'".$rs->fields["SOPORTE"]."','1',to_date('".$rs->fields["SGD_MRD_FECHINI"]."','dd/mm/yyyy'),to_date('".$rs->fields["SGD_MRD_FECHFIN"]."','dd/mm/yyyy'))";
//		 $db->query($isql);
		echo $isql."<br><br>";
		
		if ($db->Execute($isql) == false) 
		{
			echo "error al insertar:". $db->ErrorMsg()."<BR>$isql mao";
		}
		else
		{
			echo "se registro bien<br>$isql";
		}
		*/
		
/*		if ($db->query($isql) === false) 
		{
			die('error al insertar: '.$db->ErrorMsg().'<BR>');
			
		}
		else
		{
			echo $isql."<br><br>";
		}
*/
//		echo $insertSQL;
//		print_r($record);
//		echo "<br>";
//		if ($db->insert("SGD_MRD_MATRIRD", $record, "true") === false) 
//		{
//			print 'error al insertar: '.$db->ErrorMsg().'<BR>';
//		}
//
		
		$rs->MoveNext();
	}
		 echo $isql."<br><br>";
//$db->conn->CommiTrans();
?>