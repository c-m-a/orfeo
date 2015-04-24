<?php

$k_datosdest++;
if($k_datosdest == 1)
{
/*
  Esta clase devuelve los datos del destinatario
*/


class DATOSDEST {

 var $dir_tipo_us;
 var $tipo_emp_us;
 var $nombre_us;
 var $documento_us;
 var $prim_apel_us;
 var $seg_apel_us;
 var $telefono_us;
 var $direccion_us;
 var $email_us;
 var $muni_us;
 var $codep_us;
 var $idpais;
 var $idcont;
 var $cc_documento_us;

  function DATOSDEST($db,$radicado,$espcodi,$sgd_dir_tipo,$rem_destino) {
//echo "datosdest 27 ------   $sgd_dir_tipo   ---  rem_destino ----- $rem_destino";
error_reporting(7);
global $ADODB_COUNTRECS;
if ($espcodi)
{	$ADODB_COUNTRECS = true;
	$isql = "select
			NIT_DE_LA_EMPRESA     	AS SGD_CIU_CEDULA
			,NOMBRE_DE_LA_EMPRESA  	AS SGD_CIU_NOMBRE
			,SIGLA_DE_LA_EMPRESA   	AS SGD_CIU_APELL1
			,IDENTIFICADOR_EMPRESA 	AS SGD_CIU_CODIGO
			,EMAIL
			,DIRECCION 				  	AS SGD_CIU_DIRECCION
			,TELEFONO_1 			  	AS SGD_CIU_TELEFONO
			,CODIGO_DEL_DEPARTAMENTO AS DPTO_CODI
			,CODIGO_DEL_MUNICIPIO    AS MUNI_CODI
			,NOMBRE_REP_LEGAL
			from BODEGA_EMPRESAS
			where IDENTIFICADOR_EMPRESA = $espcodi ";

		$rsBod = $db->query($isql);
		$ADODB_COUNTRECS = false;
				if ($rsBod->recordcount() > 0) {// print("*********UNO********");

			$dir_tipo_us  = 3;
			$tipo_emp_us  = 1;
			$nombre_us    = trim($rsBod->fields["SGD_CIU_NOMBRE"]);
//		   $documento_us = $rsBod->fields["SGD_CIU_CODIGO"];
			$prim_apel_us = trim($rsBod->fields["SGD_CIU_APELL1"]);
			$seg_apel_us  = trim($rsBod->fields["SGD_CIU_APELL2"]);
			$telefono_us  = trim($rsBod->fields["SGD_CIU_TELEFONO"]);
//		   $direccion_us = trim($rsBod->fields["SGD_CIU_DIRECCION"]);
			$email_us     = trim($rsBod->fields["EMAIL"]);
			$muni_us      = $rsBod->fields["MUNI_CODI"];
			$codep_us     = $rsBod->fields["DPTO_CODI"];
		$datos_envio="&otro_us11=$otro_us1&dpto_nombre_us11=$dpto_nombre_us1&muni_nombre_us11=$muni_nombre_us1&direccion_us11=$direccion_us1&nombret_us11=$nombret_us1";
		$datos_envio.="&otro_us2=$otro_us2&dpto_nombre_us2=$dpto_nombre_us2&muni_nombre_us2=$muni_nombre_us2&direccion_us2=$direccion_us2&nombret_us2=$nombret_us2";
		$datos_envio.="&dpto_nombre_us3=$dpto_nombre_us3&muni_nombre_us3=$muni_nombre_us3&direccion_us3=$direccion_us3&nombret_us3=$nombret_us3";
		$cc_documento_us = $rsBod->fields["SGD_CIU_CEDULA"];

		}

   }
	if (substr($rem_destino,0,1)==7) {
	   $rem_isql = " and sgd_dir_tipo=$sgd_dir_tipo ";
	}else {
	   $rem_isql = "and sgd_dir_tipo= 1";
	}
	$isql = "select * from sgd_dir_drecciones where RADI_NUME_RADI=$radicado $rem_isql ";
	$ADODB_COUNTRECS = true;
	$rsDir = $db->query($isql);
	//echo "<hr>$isql<hr>";
	$ADODB_COUNTRECS = false;
	if ($rsDir) {
		$ciu          = $rsDir->fields["SGD_CIU_CODIGO"];
		$oem          = $rsDir->fields["SGD_OEM_CODIGO"];
		$esp          = $rsDir->fields["SGD_ESP_CODI"];
		$fun          = $rsDir->fields["SGD_DOC_FUN"];
		$documento_us = $rsDir->fields["SGD_DIR_CODIGO"];
		$muni_us      = $rsDir->fields["MUNI_CODI"];
		$codep_us     = $rsDir->fields["DPTO_CODI"];
		$idpais       = $rsDir->fields["ID_PAIS"];
		$idcont       = $rsDir->fields["ID_CONT"];
		$otro         = trim($rsDir->fields["SGD_DIR_NOMBRE"]);
		$direccion_us = trim($rsDir->fields["SGD_DIR_DIRECCION"]);
		$ik           = $rsDir->fields["SGD_DIR_TIPO"];
		}
		$dir_codigo_us = $rsDir->fields["SGD_DIR_CODIGO"];
	 if ($ciu!=0) {
		$isql = "select * from sgd_ciu_ciudadano where sgd_ciu_codigo=$ciu";
 		$rs1 = $db->query($isql);
		$tipo_emp = 0;
	 }
	 if ($oem!=0) { // print("*********TRES********");
		$isql = "select
		SGD_OEM_NIT        as SGD_OEM_CEDULA
		 ,SGD_OEM_OEMPRESA  as SGD_CIU_NOMBRE
		 ,SGD_OEM_REP_LEGAL as SGD_CIU_APELL1
		 ,SGD_OEM_CODIGO    AS SGD_CIU_CODIGO
		 ,SGD_OEM_DIRECCION as SGD_CIU_DIRECCION
		 ,SGD_OEM_TELEFONO  AS SGD_CIU_TELEFONO
		 from SGD_OEM_OEMPRESAS
		WHERE  SGD_OEM_CODIGO = $oem";
		$rs1 = $db->query($isql);
		$tipo_emp = 2;
	  }
	  if ($esp!=0) { //print("*********CUATRO********");
		$isql = "select
			NOMBRE_DE_LA_EMPRESA   as SGD_CIU_NOMBRE
			,SIGLA_DE_LA_EMPRESA   as SGD_CIU_APELL1
			,IDENTIFICADOR_EMPRESA AS SGD_CIU_CODIGO
			,DIRECCION             as SGD_CIU_DIRECCION
			,TELEFONO_1            AS SGD_CIU_TELEFONO
			from BODEGA_EMPRESAS
			where IDENTIFICADOR_EMPRESA = $esp";
		$rs1 = $db->query($isql);
		$tipo_emp = 1;
	 }
	 if ($fun!=0) { // print("*********TRES********");
		//echo "<hr>entro aki";
		$isql = "select
						a.USUA_DOC	      as SGD_OEM_CEDULA
					 ,a.USUA_NOMB				as SGD_CIU_NOMBRE
					 ,a.USUA_DOC			  as SGD_CIU_CODIGO
					 ,b.DEPE_NOMB				as SGD_CIU_DIRECCION
					 ,a.USUA_EXT			  as SGD_CIU_TELEFONO
					 from usuario a, dependencia b
						WHERE
							a.DEPE_CODI=b.DEPE_CODI and
							USUA_DOC='$fun'";
		$rs1 = $db->query($isql);
		$tipo_emp = 3;
	  }

		if (!$rs1->EOF) {
		$nombre_us    = trim($rs1->fields["SGD_CIU_NOMBRE"]);
		$prim_apel_us = trim($rs1->fields["SGD_CIU_APELL1"]);
		$seg_apel_us  = trim($rs1->fields["SGD_CIU_APELL2"]);
		$telefono_us  = trim($rs1->fields["SGD_CIU_TELEFONO"]);
		$email_us      = trim($rs1->fields["EMAIL"]);
		$cc_documento_us = $rs1->fields["SGD_CIU_CEDULA"];
	}
	if ($otro)  $nombre_us = $otro . " - " . $nombre_us ;
	$this->dir_tipo_us     = $dir_tipo_us;
	$this->tipo_emp_us     = $tipo_emp_us;
	$this->nombre_us       = $nombre_us;
	$this->documento_us    = $documento_us;
	$this->prim_apel_us    = $prim_apel_us ;
	$this->seg_apel_us     = $seg_apel_us;
	$this->telefono_us     = $telefono_us;
	$this->direccion_us    = $direccion_us;
	$this->email_us        = $email_us ;
	$this->idpais	       = $idpais;
	$this->idcont	       = $idcont;
	$this->codep_us        = $idpais.'-'.$codep_us;
	$this->muni_us         = $this->codep_us.'-'.$muni_us;
	$this->cc_documento_us = $cc_documento_us;

   }  //  FIN function DATOSDEST
 }  //  FIN class DATOSDEST
}  //  FIN  if($k_datosdest == 1)
?>
