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
 var $cc_documento_us;

  function DATOSDEST($db,$radicado,$espcodi) {

    error_reporting(7);
    $db->conn->debug = false;   
    
	if ($espcodi) {
	   $isql = "select 
	            NIT_DE_LA_EMPRESA     	AS SGD_CIU_CEDULA
		       ,NOMBRE_DE_LA_EMPRESA  	AS SGD_CIU_NOMBRE
			   ,SIGLA_DE_LA_EMPRESA   	AS SGD_CIU_APELL1
			   ,IDENTIFICADOR_EMPRESA 	AS SGD_CIU_CODIGO
			   ,EMAIL
			   ,DIRECCION 			  	AS SGD_CIU_DIRECCION
			   ,TELEFONO_1 			  	AS SGD_CIU_TELEFONO 
               ,CODIGO_DEL_DEPARTAMENTO AS DPTO_CODI
			   ,CODIGO_DEL_MUNICIPIO    AS MUNI_CODI
			   ,NOMBRE_REP_LEGAL
 		       from BODEGA_EMPRESAS 
	           where IDENTIFICADOR_EMPRESA = $espcodi ";
			   
		$rsBod = $db->query($isql);
        if ($rsBod->recordcount() > 0) {// print("*********UNO********");

		   $dir_tipo_us  = 3;
		   $tipo_emp_us  = 1;
		   $nombre_us    = trim($rsBod->fields["SGD_CIU_NOMBRE"]);
		   $documento_us = $rsBod->fields["SGD_CIU_CODIGO"];
		   $prim_apel_us = trim($rsBod->fields["SGD_CIU_APELL1"]);
		   $seg_apel_us  = trim($rsBod->fields["SGD_CIU_APELL2"]);
		   $telefono_us  = trim($rsBod->fields["SGD_CIU_TELEFONO"]);
		   $direccion_us = trim($rsBod->fields["SGD_CIU_DIRECCION"]);
		   $email_us     = trim($rsBod->fields["EMAIL"]);
		   $muni_us      = $rsBod->fields["MUNI_CODI"];
		   $codep_us     = $rsBod->fields["DPTO_CODI"]; 			
		   $cc_documento_us = $rsBod->fields["SGD_CIU_CEDULA"];		

		}   

   }

	if (substr($rem_destino,0,1)==7) {
	   $rem_isql = " and sgd_dir_tipo=$sgd_dir_tipo ";	
	}else {
	   $rem_isql = "";
	}

	$isql = "select * from sgd_dir_drecciones where RADI_NUME_RADI=$radicado $rem_isql "; 

	$rsDir=$db->query($isql);
	
    if ($rsDir->recordcount() > 0) {

	   $ciu  = $rsDir->fields["SGD_CIU_CODIGO"];   
	   $oem  = $rsDir->fields["SGD_OEM_CODIGO"];   
	   $esp  = $rsDir->fields["SGD_ESP_CODI"];
	   $muni_us      = $rsDir->fields["MUNI_CODI"];
	   $codep_us     = $rsDir->fields["DPTO_CODI"]; 			
	   $otro = trim($rsDir->fields["SGD_DIR_NOMBRE"]); 
	   $ik   = $rsDir->fields["SGD_DIR_TIPO"];  
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

       if ($rs1->recordcount() > 0) {

		   $nombre_us    = trim($rs1->fields["SGD_CIU_NOMBRE"]);
		   $documento_us = $rs1->fields["SGD_CIU_CODIGO"];
		   $prim_apel_us = trim($rs1->fields["SGD_CIU_APELL1"]);
		   $seg_apel_us  = trim($rs1->fields["SGD_CIU_APELL2"]);
		   $telefono_us  = trim($rs1->fields["SGD_CIU_TELEFONO"]);
		   $direccion_us = trim($rs1->fields["SGD_CIU_DIRECCION"]);
		   $email_us      = trim($rs1->fields["EMAIL"]);
		   $cc_documento_us = $rs1->fields["SGD_CIU_CEDULA"];		

	    }

    $this->dir_tipo_us     = $dir_tipo_us;
    $this->tipo_emp_us     = $tipo_emp_us;
    $this->nombre_us       = $nombre_us;
    $this->documento_us    = $documento_us;
    $this->prim_apel_us    = $prim_apel_us ;
    $this->seg_apel_us     = $seg_apel_us;
    $this->telefono_us     = $telefono_us;
    $this->direccion_us    = $direccion_us;
    $this->email_us        = $email_us ;
    $this->muni_us         = $muni_us;
    $this->codep_us        = $codep_us;
    $this->cc_documento_us = $cc_documento_us;

   }  //  FIN function DATOSDEST
 }  //  FIN class DATOSDEST
}  //  FIN  if($k_datosdest == 1)
?>
