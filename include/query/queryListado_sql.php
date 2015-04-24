<?

switch ($db->driver) { 
	case "oracle" :
	case 'oci8':
		$query1="SELECT d.usua_nomb  USUARIO
	    			,a.RADI_NUME_HOJA as PAGINAS
					,a.RADI_FECH_RADI as FECHA_RADICACION
	               ,to_char(a.RADI_NUME_RADI) as RADICADO
				   ,a.RADI_PATH as IMAGEN
				   ,a.RA_ASUN as ASUNTO
				   ,a.RADI_USU_ANTE as USUARIO_ANTERIOR
				   ,c.NOMBRE_DE_LA_EMPRESA AS NOMBRES
				   ,a.RADI_FECH_RADI AS FECHA
				   ,b.sgd_tpr_descrip as TIPO_DOCUMENTO
				   ,b.sgd_tpr_termino as DIAS_TERMINO
				   ,ROUND(((radi_fech_radi+(b.sgd_tpr_termino * 7/5))- $sqlDia ),10) AS DIAS_FALTANTES
				   ,RADI_LEIDO LEIDO
				   ,RADI_TIPO_DERI TIPO_DERIVADO
				   ,RADI_NUME_DERI RAD_PADRES
				   FROM RADICADO a,SGD_TPR_TPDCUMENTO B,
				     bodega_empresas c, usuario D
					WHERE a.radi_depe_actu=$dependencia_busq
					 AND a.tdoc_codi=b.sgd_tpr_codigo 
					 and a.radi_depe_actu=d.depe_codi  and a.radi_usua_actu=d.usua_codi
				     AND c.IDENTIFICADOR_EMPRESA  =  a.eesp_codi
					 $isql_where	   
			union all
				  SELECT d.usua_nomb 
				  ,a.RADI_NUME_HOJA as Paginas 
				  ,a.RADI_FECH_RADI as Fecha_Rad
	               ,to_char(a.RADI_NUME_RADI) as No_Radicado
				   ,a.RADI_PATH				   
				   ,a.RA_ASUN as Asunto 
				   ,a.RADI_USU_ANTE,'No Tiene ',
				   a.RADI_FECH_RADI AS FECHA
				   ,b.sgd_tpr_descrip
				   ,b.sgd_tpr_termino,ROUND(((radi_fech_radi+(b.sgd_tpr_termino * 7/5))- $sqlDia ),10) AS diasr,
				   RADI_LEIDO,RADI_TIPO_DERI,RADI_NUME_DERI
				   FROM RADICADO a,SGD_TPR_TPDCUMENTO b, usuario d
				     WHERE 
					       a.radi_depe_actu=$dependencia    and a.radi_usua_actu=d.usua_codi
						   and a.radi_depe_actu=d.depe_codi
						   AND a.tdoc_codi=b.sgd_tpr_codigo 
						   and a.eesp_codi = 0 
						   $isql_where"; 
						   
	
	   	$query2="SELECT  $isql_sel_group,count(*) as Registros
				   FROM RADICADO a 
				   JOIN SGD_TPR_TPDCUMENTO b   ON     a.tdoc_codi=b.sgd_tpr_codigo 
				    RIGHT OUTER JOIN  usuario d  ON   a.radi_usua_actu = d.usua_codi
				   	WHERE a.radi_depe_actu=$dependencia_busq
					 and a.radi_depe_actu=d.depe_codi  
				     $isql_where
					 group by $isql_group
					 ";	
	   	
	   break;	
 case   "mssql":
		$query1="SELECT d.usua_nomb  USUARIO
	    			,a.RADI_NUME_HOJA as PAGINAS
					,a.RADI_FECH_RADI as FECHA_RADICACION
	               ,convert(char(14),a.RADI_NUME_RADI) as RADICADO
				   ,a.RADI_PATH as IMAGEN
				   ,a.RA_ASUN as ASUNTO
				   ,a.RADI_USU_ANTE as USUARIO_ANTERIOR
				   ,c.NOMBRE_DE_LA_EMPRESA AS NOMBRES
				   ,a.RADI_FECH_RADI AS FECHA
				   ,b.sgd_tpr_descrip as TIPO_DOCUMENTO
				   ,b.sgd_tpr_termino as DIAS_TERMINO
				   ,radi_fech_radi AS DIAS_FALTANTES
				   ,RADI_LEIDO LEIDO
				   ,RADI_TIPO_DERI TIPO_DERIVADO
				   ,RADI_NUME_DERI RAD_PADRES
				   FROM RADICADO a,SGD_TPR_TPDCUMENTO B,
				     bodega_empresas c, usuario D
					WHERE a.radi_depe_actu=$dependencia_busq
					 AND a.tdoc_codi=b.sgd_tpr_codigo 
					 and a.radi_depe_actu=d.depe_codi  and a.radi_usua_actu=d.usua_codi
				     AND c.IDENTIFICADOR_EMPRESA  =  a.eesp_codi
					 $isql_where	   
			union all
				  SELECT d.usua_nomb 
				  ,a.RADI_NUME_HOJA as Paginas 
				  ,a.RADI_FECH_RADI as Fecha_Rad
	               ,convert(char(14),a.RADI_NUME_RADI) as No_Radicado
				   ,a.RADI_PATH				   
				   ,a.RA_ASUN as Asunto 
				   ,a.RADI_USU_ANTE,'No Tiene ',
				   a.RADI_FECH_RADI AS FECHA
				   ,b.sgd_tpr_descrip
				   ,b.sgd_tpr_termino,radi_fech_radi AS diasr,
				   RADI_LEIDO,RADI_TIPO_DERI,RADI_NUME_DERI
				   FROM RADICADO a,SGD_TPR_TPDCUMENTO b, usuario d
				     WHERE 
					       a.radi_depe_actu=$dependencia    and a.radi_usua_actu=d.usua_codi
						   and a.radi_depe_actu=d.depe_codi
						   AND a.tdoc_codi=b.sgd_tpr_codigo 
						   and a.eesp_codi = 0 
						   $isql_where"; 
						   
	
	   	$query2="SELECT  $isql_sel_group,count(*) as REGISTROS
				   FROM RADICADO a 
				   JOIN SGD_TPR_TPDCUMENTO b   ON     a.tdoc_codi=b.sgd_tpr_codigo 
				    RIGHT OUTER JOIN  usuario d  ON   a.radi_usua_actu = d.usua_codi
				   	WHERE a.radi_depe_actu=$dependencia_busq
					 and a.radi_depe_actu=d.depe_codi  
				     $isql_where
					 group by $isql_group
					 ";	
	   	
	   break;				   			   
	
}

?>