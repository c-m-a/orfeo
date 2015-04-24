<?php
$_SESSION["ID_US3"] = "";
$_SESSION["NOMBRE_US3"] = "";
$_SESSION["SIGLA_US3"] = "";
$_SESSION["DOC_US3"] = "";
	
  if(isset($radicadopadre))
	 $buscar_d = $radicadopadre;
	
  if(isset($nurad))
	 $buscar_d = $nurad;

	if(isset($espcodi)) {
		$isql = "select NIT_DE_LA_EMPRESA as SGD_CIU_CEDULA
               ,NOMBRE_DE_LA_EMPRESA
			   ,SIGLA_DE_LA_EMPRESA as SGD_CIU_APELL1
			   ,IDENTIFICADOR_EMPRESA
			   ,EMAIL
			   ,DIRECCION
			   ,TELEFONO_1 AS SGD_CIU_TELEFONO 
               ,CODIGO_DEL_DEPARTAMENTO as DPTO_CODI,CODIGO_DEL_MUNICIPIO as MUNI_CODI,NOMBRE_REP_LEGAL
               ,ID_PAIS
               ,ID_CONT
	    from BODEGA_EMPRESAS 
	    where IDENTIFICADOR_EMPRESA = $espcodi ";
		$rs = $db->query($isql);

	    if($rs)
		{
			$dir_codigo_us3 = $rs->fields["IDENTIFICADOR_EMPRESA"];	   
			$_SESSION["ID_US3"] = $dir_codigo_us3;
			
			$nombre = trim($rs->fields["NOMBRE_DE_LA_EMPRESA"]);
			$_SESSION["NOMBRE_US3"] = $nombre;
			$documento = $rs->fields["IDENTIFICADOR_EMPRESA"];
			$papel = trim($rs->fields["SIGLA_DE_LA_EMPRESA"]);
			$_SESSION["SIGLA_US3"] = $papel;
			$sapel = trim($rs->fields["NOMBRE_REP_LEGAL"]);
			$tel = $rs->fields["SGD_CIU_TELEFONO"];
			$dir = trim($rs->fields["DIRECCION"]);
			$mail = $rs->fields["EMAIL"];
			$cc_documento = $rs->fields["SGD_CIU_CEDULA"];
			$cont = $rs->fields["ID_CONT"];
			$pais = $rs->fields["ID_PAIS"];
		    $dpto = $pais."-".$rs->fields["DPTO_CODI"]; 				
		    $muni = $dpto."-".$rs->fields["MUNI_CODI"];
			$tipo = $rs->fields["SGD_CIU_TIPO"];
			$dir_tipo_us3 = 3;
			$tipo_emp_us3=1;
			$nombre_us3=$nombre;
			$documento_us3 = $documento;
			$cc_documento_us3 = $cc_documento;
			$_SESSION["DOC_US3"] = $cc_documento_us3;
			$prim_apel_us3 =$papel ;
			$seg_apel_us3 = $sapel ;
			$telefono_us3 = $tel;
			$direccion_us3 = $dir;
			$mail_us3 = $mail;
			$muni_us3 = $muni;
			$codep_us3 = $dpto;
	    
			$tipo_us3 = $tipo; 
		} 
   }
	 
  
    if(empty($oem_codigo_us1))
      $oem_codigo_us1 = 0;

    if(empty($document_us1))
      $documento_us1=0;

    $rem_destino = (isset($rem_destino))? $rem_destino : null;

    $rem_isql = (substr($rem_destino,0,1) == 7)?
                  " and sgd_dir_tipo=$sgd_dir_tipo " : 
                  '';
	
  if (empty($radi_nume_radi))
		$radi_nume_radi = "RADI_NUME_RADI";
	if (empty($buscar_d)) $buscar_d = '0';
	$isql = "select a.* from sgd_dir_drecciones a where a.RADI_NUME_RADI=$buscar_d $rem_isql order by a.sgd_dir_tipo "; 
	$rs = $db->conn->query($isql);
	$docDir = $rs->fields["SGD_DIR_DOC"];
    while(!$rs->EOF&&$rs!=false) 
	{
	   $ciu = $rs->fields["SGD_CIU_CODIGO"];   
	   $oem = $rs->fields["SGD_OEM_CODIGO"];   
	   $esp = $rs->fields["SGD_ESP_CODI"];
    if(empty($kTipo)) {
      $ciu1 = $ciu;
      $oem1=$oem;
      $esp1=$esp;
      $kTipo=2;
    }
	   $fun = trim($rs->fields["SGD_DOC_FUN"]);
	   $cont = $rs->fields["ID_CONT"];
	   $pais = $rs->fields["ID_PAIS"];
	   $dpto = $pais."-".$rs->fields["DPTO_CODI"];
	   $muni = $dpto."-".$rs->fields["MUNI_CODI"];	 
	   $otro = trim($rs->fields["SGD_DIR_NOMBRE"]); 
		 $telUsX = trim($rs->fields["SGD_DIR_TELEFONO"]); 
		 $emailUsX = trim($rs->fields["SGD_DIR_MAIL"]); 
	   $ik = $rs->fields["SGD_DIR_TIPO"];  
	   
     if ($ik==1) {
				$dir_codigo_us1 = $rs->fields["SGD_DIR_CODIGO"];
				$telefono_us1 = $telUsX;
				$mail_us1 = $emailUsX;
			}
	   if ($ik==2) {
				$dir_codigo_us2 = $rs->fields["SGD_DIR_CODIGO"];	   
				$telefono_us2 = $telUsX;
				$mail_us2 = $emailUsX;
			}
	   if($rem_isql) $dir_codigo_us7 = $rs->fields["SGD_DIR_CODIGO"];	   
	   if($ciu!=0)
	   {
			$isql = "select * from sgd_ciu_ciudadano where sgd_ciu_codigo=$ciu"; 
			$rs1 = $db->query($isql);	
			$tipo_emp = 0;
			
	   }
	   if($oem!=0) {
			$isql = "select SGD_OEM_NIT as SGD_OEM_CEDULA,SGD_OEM_OEMPRESA as SGD_CIU_NOMBRE
			,SGD_OEM_REP_LEGAL as SGD_CIU_APELL1,SGD_OEM_CODIGO AS SGD_CIU_CODIGO
			,SGD_OEM_DIRECCION as SGD_CIU_DIRECCION,SGD_OEM_TELEFONO AS SGD_CIU_TELEFONO 
					 from SGD_OEM_OEMPRESAS 
			         WHERE  SGD_OEM_CODIGO = $oem";
			$rs1 = $db->query($isql);	
			$tipo_emp = 2;
	   }
	   if($esp!=0) {
            $isql = "select NOMBRE_DE_LA_EMPRESA as SGD_CIU_NOMBRE, NIT_DE_LA_EMPRESA as SGD_CIU_CEDULA
			         ,SIGLA_DE_LA_EMPRESA as SGD_CIU_APELL1,IDENTIFICADOR_EMPRESA AS SGD_CIU_CODIGO
					 ,DIRECCION as SGD_CIU_DIRECCION,TELEFONO_1 AS SGD_CIU_TELEFONO , ID_CONT
					 from BODEGA_EMPRESAS 
					 where IDENTIFICADOR_EMPRESA = $esp";
			$rs1 = $db->query($isql);	

			$tipo_emp = 1;
	   }
	   if($fun!=0)
	   { 
	    $codiATexto = $db->conn->numToString("a.USUA_EXT");
	    $concatTel=$db->conn->Concat("'Ext'","$codiATexto"); 
            $isql = "select a.USUA_NOMB as SGD_CIU_NOMBRE
			         ,b.DEPE_NOMB  as SGD_CIU_APELL1,a.USUA_DOC AS SGD_CIU_CODIGO
					 ,b.DEPE_NOMB as SGD_CIU_DIRECCION,$concatTel AS SGD_CIU_TELEFONO 
					 from USUARIO a, dependencia b
					 where 
					 a.depe_codi=b.depe_codi and 
					 usua_doc = '$fun'";
			$rs1 = $db->query($isql);
			
 			$tipo_emp = 6;
			$dir = trim($rs1->fields["SGD_CIU_DIRECCION"]);
	   }	   	   
	   
        if($rs1)
			{
				$nombre = trim($rs1->fields["SGD_CIU_NOMBRE"]);
				$documento = $rs1->fields["SGD_CIU_CODIGO"];
				$papel  = trim($rs1->fields["SGD_CIU_APELL1"]);
				$sapel  = trim($rs1->fields["SGD_CIU_APELL2"]);
				$tel    = (isset($rs1->fields["SGD_DIR_TELEFONO"]))? trim($rs1->fields["SGD_DIR_TELEFONO"]) : '';
				$dir    = trim($rs->fields["SGD_DIR_DIRECCION"]);
				$mail   = (isset($rs1->fields["SGD_DIR_MAIL"]))? trim($rs1->fields["SGD_DIR_MAIL"]) : '';
				$cc_documento = $rs1->fields["SGD_CIU_CEDULA"];				
	   if($ik==1)
		  {
		  $tipo_emp_us1=$tipo_emp;
			$nombre_us1=$nombre;
			$documento_us1 = $documento;
			$prim_apel_us1 =$papel ;
			$seg_apel_us1 = $sapel ;
			if(!$telefono_us1) $telefono_us1 = $tel;
			$direccion_us1 = trim($dir);
			if(!$mail_us1)$mail_us1 = $mail;
			$muni_us1 = $muni;
			$codep_us1 = $dpto;

			$idpais1 = $pais;
			$idcont1 = $cont;
			$tipo_us1 = $tipo;
			$cc_documento_us1 = $cc_documento;
			$otro_us1 = $otro;
		 }
	   if($ik==2)
		  {
		    $tipo_emp_us2=$tipo_emp;
			$nombre_us2=$nombre;
			$documento_us2 = $documento;
			$prim_apel_us2 =$papel ;
			$seg_apel_us2 = $sapel ;
			if(!$telefono_us2) $telefono_us2 = $tel;
			$direccion_us2 = $dir;
			if(!$mail_us2) $mail_us2 = $mail;
			$muni_us2 = $muni;
			$codep_us2 = $dpto;
			$idpais2 = $pais;
			$idcont2 = $cont;
			$tipo_us2 = $tipo;
  			$cc_documento_us2 = $cc_documento; 
			$otro_us2 = $otro;			
		 }
	   if($rem_isql)
		  {
		    $tipo_emp_us7=$tipo_emp;
			$nombre_us7=$nombre;
			$documento_us7 = $documento;
			$prim_apel_us7 =$papel ;
			$seg_apel_us7 = $sapel ;
			$telefono_us7 = $tel;
			$direccion_us7 = $dir;
			$mail_us7 = $mail;
			$muni_us7 = $muni;
			$idpais7 = $pais;
			$idcont7 = $cont;
			$codep_us7 = $dpto;
			$tipo_us7 = $tipo;
  			$cc_documento_us7 = $cc_documento; 
			$otro_us7 = $otro;			
		 }		 
	}
$rs->MoveNext();	
} 
?>
