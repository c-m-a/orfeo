<?  
error_reporting(7);
	if (!$muni_us1) $muni_us1 = "NULL";
	if (!$muni_us2) $muni_us2 = "NULL";
	if (!$munii_us3) $muni_us3 = "NULL";
	$isql = "select SGD_DIR_CODIGO from sgd_dir_drecciones order by SGD_DIR_CODIGO desc"; 
    $resultado = ora_parse($cursor, $isql); 
	$resultado = ora_exec($cursor) ;
	ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);			
	$nextval = $row["SGD_DIR_CODIGO"];
	$nextval++;
if($documento_us1)
  {
	$sgd_ciu_codigo=0;
	$sgd_oem_codigo=0;
	$sgd_esp_codigo=0;
    ora_commiton($handle);
    if($tipo_emp_us1==0){$sgd_ciu_codigo=$documento_us1;}
	if($tipo_emp_us1==1){$sgd_esp_codigo=$documento_us1;}
	if($tipo_emp_us1==2){$sgd_oem_codigo=$documento_us1;}	   	   
	$isql = "select * from sgd_dir_drecciones where radi_nume_radi=$nurad and sgd_dir_tipo=1"; 
    $resultado = ora_parse($cursor, $isql); 

	$resultado = ora_exec($cursor) ;
	$row=ora_fetch($cursor);
    if(!$row)
	{     
	  $isql = "insert into SGD_DIR_DRECCIONES(MUNI_CODI         ,DPTO_CODI ,SGD_OEM_CODIGO    ,SGD_CIU_CODIGO ,SGD_ESP_CODI   ,RADI_NUME_RADI,SGD_SEC_CODIGO ,SGD_DIR_DIRECCION  ,SGD_DIR_TELEFONO         ,SGD_DIR_MAIL,SGD_DIR_TIPO,SGD_DIR_CODIGO) ";
	  $isql .= "                       values($muni_us1         ,$codep_us1,$sgd_oem_codigo   ,$sgd_ciu_codigo,$sgd_esp_codigo,$nurad       ,0              ,'$direccion_us1   ','".trim($telefono_us1)."','$mail_us1',1 ,$nextval )";
	  $nextval++;
    }
	 else	  
	{ 
	  $isql = "update SGD_DIR_DRECCIONES set MUNI_CODI=$muni_us1,DPTO_CODI=$codep_us1,SGD_OEM_CODIGO=$sgd_oem_codigo,SGD_CIU_CODIGO=$sgd_ciu_codigo,SGD_ESP_CODI=$sgd_esp_codigo,SGD_SEC_CODIGO=0,SGD_DIR_DIRECCION='$direccion_us1',SGD_DIR_TELEFONO='$telefono_us1',SGD_DIR_MAIL='$mail_us1' where radi_nume_radi=$nurad and SGD_DIR_TIPO=1 ";
	}
	$resultado = ora_parse($cursor, $isql); 
	$resultado = ora_exec($cursor) ;
}
	// ***********************  us2
	if($documento_us2)
	{
	$sgd_ciu_codigo=0;
    $sgd_oem_codigo=0;
    $sgd_esp_codigo=0;
    if($tipo_emp_us2==0){$sgd_ciu_codigo=$documento_us2;}
    if($tipo_emp_us2==1){$sgd_esp_codigo=$documento_us2;}
    if($tipo_emp_us2==2){$sgd_oem_codigo=$documento_us2;}	   	   
	$isql = "select * from sgd_dir_drecciones where radi_nume_radi=$nurad and sgd_dir_tipo=2"; 
    ora_parse($cursor, $isql); 
	ora_exec($cursor) ;
	$row=ora_fetch($cursor);
    if(!$row)
	{   

      $isql = "insert into SGD_DIR_DRECCIONES(DPTO_CODI,MUNI_CODI,SGD_OEM_CODIGO     ,SGD_CIU_CODIGO ,SGD_ESP_CODI   ,RADI_NUME_RADI,SGD_SEC_CODIGO , SGD_DIR_DIRECCION        ,SGD_DIR_TELEFONO         ,SGD_DIR_MAIL,SGD_DIR_TIPO,SGD_DIR_CODIGO) ";
	  $isql .= "                       values($codep_us2   ,$muni_us2    ,$sgd_oem_codigo,$sgd_ciu_codigo,$sgd_esp_codigo,$nurad       ,0              ,'".trim($direccion_us2)."','".trim($telefono_us2)."','$mail_us2',2     ,$nextval)";
    }
	 else	  
	{ 

	  $isql = "update SGD_DIR_DRECCIONES  set MUNI_CODI=$muni_us2,DPTO_CODI=$codep_us2,SGD_OEM_CODIGO=$sgd_oem_codigo,SGD_CIU_CODIGO=$sgd_ciu_codigo,SGD_ESP_CODI=$sgd_esp_codigo,SGD_SEC_CODIGO=0,SGD_DIR_DIRECCION='$direccion_us1',SGD_DIR_TELEFONO='$telefono_us1',SGD_DIR_MAIL='$mail_us1' where radi_nume_radi=$nurad and SGD_DIR_=2 ";
	} 
      ora_parse($cursor, $isql); 
	  ora_exec($cursor) ;
	}

?>
