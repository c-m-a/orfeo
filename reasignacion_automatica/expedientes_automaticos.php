<?
/************************************************************

expedientes_automaticos.php
creador : MAURICIO ALEJANDRO QUINCHE RAMIREZ
AÑO : 2007 

Recibe un archivo configurado en formato csv

posee los siguientes campo
	$nit=$data[0];
	$usua_login=$data[1];
	$tipo_ent=$data[2];
	
	generara expedientes virtuales automaticos con base a los datos colocado en el archivo
	csv.
*****************************************************************/
session_start();

/*if (!$ruta_raiz)*/ $ruta_raiz = "..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumental.php");


if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->BeginTrans();

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
// $db->conn->debug=true;

include_once( "$ruta_raiz/include/tx/Expediente.php" );

$fp = fopen ( "ENTIDADES4.csv" , "r" ); 
	$i = 0; 	
while (( $data = fgetcsv ( $fp , 1000 , ";" ) ) !== FALSE ) 
{

	$nit=$data[0];
	$usua_login=$data[1];
	$tipo_ent=$data[2];
	$i++;
	echo $i." ";
	//verificar si la entidad tiene expediente
	$sql = "SELECT SGD_EXP_NUMERO FROM SGD_SEXP_SECEXPEDIENTES 
				WHERE SGD_SEXP_PAREXP1 = '$nit'";
			
	$rs = $db->query($sql);

	$nexpedientes=$rs->RecordCount();
	if(!$nexpedientes)
	{
//traia la sigla para completar los parametro del expediente
		$sql = "SELECT SIGLA_DE_LA_EMPRESA FROM BODEGA_EMPRESAS
					WHERE NIT_DE_LA_EMPRESA = '$nit'";
		//echo $sql;
		$rs = $db->query($sql_Ent);
		if ($rs)
		{
		//echo $sql;
			$arrParametro[1] = $nit;
			$arrParametro[2] = $rs->fields["SIGLA_DE_LA_EMPRESA"];
			$cod_SRD = '22';//serie
			$cod_SUBSRD = $tipo_ent;//subserie
			$trdExp = substr("00".$cod_SRD, -2) . substr("00".$cod_SUBSRD, -2);
			$anoExp = date("Y");
			$digCheck = "E";
			
			$verrad="0";
			//se trae los datos del usuario. por medio del login
			$sql = "SELECT USUA_DOC,USUA_CODI,DEPE_CODI FROM Usuario
						WHERE USUA_LOGIN = '$usua_login'";
			//echo $sql;			
			$rs1 = $db->query($sql);
			
			if ($rs1)
			{
				$usua_doc=$rs1->fields['USUA_DOC'];
				$dependencia=$rs1->fields['DEPE_CODI'];
				$codusuario=$rs1->fields['USUA_CODI'];
			
				$exp = new Expediente($db);
				
				if($exp)
				{
					$secExp = $exp->secExpediente($dependencia, $cod_SRD, $cod_SUBSRD, $anoExp);			
					$consecutivoExp = substr("00000".$secExp, -5);
					$numeroExpediente = $anoExp . $dependencia . $trdExp . $consecutivoExp . $digCheck;		
					$fechaExp = date("d/m/Y");
					$usuaDocExp = $usua_doc;
					//creacion del expediente
					$numeroExpedienteE = $exp->crearExpediente( $numeroExpediente,$verrad,$dependencia,$codusuario,$usua_doc,$usua_doc,$cod_SRD,$cod_SUBSRD,'false',$fechaExp,0, $arrParametro);
				}
				else
				{				
					echo "no exp<br>";
				}
			}	
			else
			{
				echo "No existe el usuario $usua_login<br>";
			}	
		}
		else
		{
			echo "No existe el nit = $nit  de la entidad en la bases de datos<br>";
		}
		echo "No tiene expediente<br>numero expediente:=$numeroExpediente<br>";	
	}
	else
	{
		echo "SI tiene expediente la entidad con nit . $data[0]<br>";
		echo $rs->fields['SGD_EXP_NUMERO']; 
	}
$db->conn->CommitTrans();
}
fclose ( $fp ); 
?>