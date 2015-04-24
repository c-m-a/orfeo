<?
switch($db->driver)
{	case 'mssql':
		{	$isql = 'SELECT convert(varchar(15), r.radi_nume_radi) as "IMG_Radicado", 
					r.RADI_PATH 			as "HID_RADI_PATH",
	  	  			'.$sqlFecha.' 			as "DAT_Fecha_Radicado",
		  			convert(varchar(15),r.RADI_NUME_RADI)		as "HID_RADI_NUME_RADI",
				  	r.ra_asun 				as "Asunto",
				  	td.sgd_tpr_descrip 		as "Tipo de Documento", 
			      	r.radi_nume_hoja		as "Numero de Hojas",
			      	dir.sgd_dir_direccion 	as "Direccion contacto", 
				  	dir.sgd_dir_telefono 	as "Telefono contacto", 
			      	dir.sgd_dir_mail 		as "Mail contacto", 
				  	dir.sgd_dir_nombre 		as "Dignatario" ,
			      	ciu.sgd_ciu_nombre 		as "Nombre Ciudadano", 
					ciu.sgd_ciu_apell1 		as "Apellido 1", 
			      	ciu.sgd_ciu_apell2 		as "Apellido 2",
			      	ciu.sgd_ciu_telefono 	as "Telefono Ciudadano",
				  	ciu.sgd_ciu_direccion 	as "Direccion Ciudadano",
			      	ciu.sgd_ciu_cedula 		as "Cedula ciudadano",
			      	u1.usua_login 			AS "HID_login_actu", 
					u1.usua_nomb 			AS "Usuario Actual", 
					d1.depe_nomb 			AS "Dependencia Actual",
			      	r.radi_usu_ante 		as "Usuario Anterior",
			      	dir.sgd_dir_nombre 		as "Firmante",
			      	r.radi_pais 			as "Pais",
				  	'.$redondeo.' as "dias restantes"
			      FROM sgd_dir_drecciones dir, 
				  	radicado r, 
					sgd_tpr_tpdcumento td, 
					usuario u1, 
					dependencia d1,
			      	sgd_ciu_ciudadano ciu
			      WHERE dir.SGD_DIR_TIPO = 1
				  AND dir.radi_nume_radi=r.radi_nume_radi 
			      AND r.tdoc_codi=td.sgd_tpr_codigo
			      AND r.radi_usua_actu=u1.usua_codi 
				  AND r.radi_depe_actu=u1.depe_codi 
				  AND u1.depe_codi=d1.depe_codi
			    AND (dir.sgd_ciu_codigo=ciu.sgd_ciu_codigo
					AND isnull(dir.sgd_ciu_codigo,0)!=0 
					AND isnull(dir.sgd_oem_codigo,0)=0 
					AND isnull(dir.sgd_esp_codi,0)=0)';
			$isql1 = 'SELECT convert(varchar(15),r.radi_nume_radi) as "IMG_Radicado" ,
					r.RADI_PATH 				as "HID_RADI_PATH",
					'.$sqlFecha.' 				as "DAT_Fecha_Radicado",
				  	convert(varchar(15),r.RADI_NUME_RADI) 			as "HID_Numero Radicado",
				  	r.ra_asun 					as "Asunto",
			      	td.sgd_tpr_descrip 			as "Tipo de Documento",
			      	r.radi_nume_hoja 			as "Numero de Hojas",
			      	dir.sgd_dir_direccion 		as "Direccion contacto", 
					dir.sgd_dir_telefono 		as "Telefono contacto", 
				  	dir.sgd_dir_mail 			as "Mail contacto",
					dir.sgd_dir_nombre 			AS "HID_dir_nombre",
			      	bod.nombre_de_la_empresa 	as "Nombre de la Empresa",
					bod.nombre_rep_legal 		as "Representante Legal",
				  	bod.nit_de_la_empresa 		as "NIT",
					bod.sigla_de_la_empresa 	as "Sigla",
					bod.direccion 				as "Direccion Empresa",
					bod.telefono_1 				as "Telefono",
			      	u1.usua_login 				AS "HID_login_actu", 
					u1.usua_nomb 				AS "Usuario Actual", 
					d1.depe_nomb 				AS "Dependencia Actual",
			      	r.radi_usu_ante 			as "Usuario Anterior",
			      	dir.sgd_dir_nombre 			as "Firmante",
			      	r.radi_pais 				as "Pais", 
					'.$redondeo.' AS "dias restantes"
			       FROM sgd_dir_drecciones dir, 
				   	radicado r, 
					sgd_tpr_tpdcumento td, 
					usuario u1, 
					dependencia d1,
				   	bodega_empresas bod
				   WHERE dir.SGD_DIR_TIPO = 1 
				   AND dir.radi_nume_radi=r.radi_nume_radi 
				   AND r.tdoc_codi=td.sgd_tpr_codigo
				   AND r.radi_usua_actu=u1.usua_codi 
				   AND r.radi_depe_actu=u1.depe_codi 
				   AND u1.depe_codi=d1.depe_codi
				   AND (dir.sgd_esp_codi=bod.identificador_empresa
						AND isnull(dir.sgd_esp_codi,0)!=0 
						AND isnull(dir.sgd_ciu_codigo,0)=0 
						AND isnull(dir.sgd_oem_codigo,0)=0)' ;
			$isql2 = 'SELECT 
					convert(varchar(15),r.radi_nume_radi) 		AS "IMG_Radicado"
					,r.RADI_PATH 			AS "HID_RADI_PATH"
		  				,'.$sqlFecha.' 			AS "DAT_Fecha_Radicado"
			  		,convert(varchar(15),r.RADI_NUME_RADI) 		AS "HID_Numero Radicado"
			  		,r.ra_asun 				AS "Asunto"
					,td.sgd_tpr_descrip 	AS "Tipo de Documento"
					,r.radi_nume_hoja 		AS "Numero de Hojas"
			  		,dir.sgd_dir_direccion 	AS "Direccion contacto"
					,dir.sgd_dir_mail 		AS "Mail contacto"
			  		,u1.usua_login 			AS "HID_login_actu"
			  		,dir.sgd_dir_telefono 	AS "HID_dir_telefono"
			  		,o.sgd_oem_oempresa 	AS "Nombre de la Empresa"
					,o.sgd_oem_rep_legal 	AS "Representante Legal"
					,o.sgd_oem_nit 			AS "NIT"
					,o.sgd_oem_sigla 		AS "Sigla"
					,o.sgd_oem_direccion 	AS "Direccion Empresa"
					,o.sgd_oem_telefono 	AS "Telefono"
					,u1.usua_nomb 			AS "Usuario Actual"
					,d1.depe_nomb 			AS "Dependencia Actual"
					,r.radi_usu_ante 		AS "Usuario Anterior"
			  		,dir.sgd_dir_nombre 	AS "Firmante"
					,r.radi_pais 			AS "Pais"
					,'.$redondeo.' AS "dias restantes"
			  	FROM 
			  		sgd_dir_drecciones 	dir
					,radicado 			r
					,sgd_tpr_tpdcumento td
					,usuario 			u1
					,dependencia 		d1
					,sgd_oem_oempresas 	o
			  	WHERE dir.SGD_DIR_TIPO = 1 
			  		AND dir.radi_nume_radi=r.radi_nume_radi 
			  		AND r.tdoc_codi=td.sgd_tpr_codigo
			  		AND r.radi_usua_actu=u1.usua_codi 
			  		AND r.radi_depe_actu=u1.depe_codi 
			  		AND u1.depe_codi=d1.depe_codi
			  		AND (dir.sgd_oem_codigo=o.sgd_oem_codigo 
						AND isnull(dir.sgd_oem_codigo,0)!=0 
						AND isnull(dir.sgd_ciu_codigo,0)=0 
						AND isnull(dir.sgd_esp_codi,0)=0)' ;
			
			$isql3 = 'SELECT r.radi_nume_radi 		AS "IMG_Radicado"
					 , r.radi_path			 	AS "HID_RADI_PATH"
					 ,'.$sqlFecha.' 			AS "DAT_Fecha_Radicado"
					 ,convert(varchar(15),r.RADI_NUME_RADI) 		AS "HID_Numero Radicado"
					 , r.ra_asun 				AS "Asunto"
					 , td.sgd_tpr_descrip		AS "Tipo de Documento"
					 , r.radi_nume_hoja			AS "Numero de Hojas"
					 , dir.sgd_dir_direccion	AS "Direccion contacto"
					 , dir.sgd_dir_telefono		AS "Telefono contacto"
					 , dir.sgd_dir_mail			AS "Mail contacto"
					 , o.usua_nomb				AS "Nombre"
					 , o.usua_email				AS "Email Interno"
					 , o.usua_doc				AS "Documento"
					 , u1.usua_login 			AS "Login Interno"
					 , o.usua_piso				AS "Email Funcionario"
					 , o.usu_telefono1			AS "Telefono"
					 , o.usua_nomb				AS "Usuario Actual"
					 , d1.depe_nomb 			AS "Dependencia Actual"
					 , r.radi_usu_ante			AS "Usuario Anterior"
					 , dir.sgd_dir_nombre		AS "Firmante"
					 ,r.radi_pais				AS "Pais"
					 , '.$redondeo.' AS "Dias Restantes"
				FROM sgd_dir_drecciones dir, radicado r, sgd_tpr_tpdcumento td, usuario u1, dependencia d1, 
					usuario o
				WHERE dir.SGD_DIR_TIPO = 1 
					AND dir.radi_nume_radi	=r.radi_nume_radi 
					AND r.tdoc_codi			=td.sgd_tpr_codigo
					AND r.radi_usua_actu	=u1.usua_codi 
					AND r.radi_depe_actu	=u1.depe_codi 
					AND u1.depe_codi		=d1.depe_codi
					AND (dir.sgd_doc_fun		=o.usua_doc 
					AND isnull(dir.sgd_doc_fun,0)!=0 
					AND isnull(dir.sgd_ciu_codigo,0)=0 
					AND isnull(dir.sgd_esp_codi,0)=0
					)';
		}break;
	case 'oracle':
		{
			if(!$n_nume_radi or !$palabra)
			{	$whereRow = " and rownum <500";}
			else $whereRow = "";
			$isql = 'SELECT r.radi_nume_radi as "IMG_Radicado", 
					r.RADI_PATH 			as "HID_RADI_PATH",
			  	  	'.$sqlFecha.' 			as "DAT_Fecha_Radicado",
				  	r.RADI_NUME_RADI		as "HID_Numero Radicado",
				  	r.ra_asun 				as "Asunto",
				  	td.sgd_tpr_descrip 		as "Tipo de Documento", 
			      	r.radi_nume_hoja		as "Numero de Hojas",
			      	dir.sgd_dir_direccion 	as "Direccion contacto", 
				  	dir.sgd_dir_telefono 	as "Telefono contacto", 
			      	dir.sgd_dir_mail 		as "Mail contacto", 
				  	dir.sgd_dir_nombre 		as "Dignatario" ,
			      	ciu.sgd_ciu_nombre 		as "Nombre Ciudadano", 
					ciu.sgd_ciu_apell1 		as "Apellido 1", 
			      	ciu.sgd_ciu_apell2 		as "Apellido 2",
			      	ciu.sgd_ciu_telefono 	as "Telefono Ciudadano",
				  	ciu.sgd_ciu_direccion 	as "Direccion Ciudadano", 
			      	ciu.sgd_ciu_cedula 		as "Cedula ciudadano",
			      	u1.usua_login 			AS "HID_login_actu", 
					u1.usua_nomb 			AS "Usuario Actual", 
					d1.depe_nomb 			AS "Dependencia Actual",
			      	r.radi_usu_ante 		as "Usuario Anterior",
			      	dir.sgd_dir_nombre 		as "Firmante",
			      	r.radi_pais 			as "Pais",
				  	round(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-sysdate)) as "dias restantes"
			      FROM sgd_dir_drecciones dir, 
				  	radicado r, 
					sgd_tpr_tpdcumento td, 
					usuario u1, 
					dependencia d1,
			      	sgd_ciu_ciudadano ciu
			      WHERE dir.SGD_DIR_TIPO = 1
				AND dir.radi_nume_radi=r.radi_nume_radi 
				AND r.tdoc_codi=td.sgd_tpr_codigo
				AND r.radi_usua_actu=u1.usua_codi 
				AND r.radi_depe_actu=u1.depe_codi 
				AND u1.depe_codi=d1.depe_codi
				AND (dir.sgd_ciu_codigo=ciu.sgd_ciu_codigo  
				AND NVL(dir.sgd_ciu_codigo,0)!=0 
				AND NVL(dir.sgd_oem_codigo,0)=0 
				AND NVL(dir.sgd_esp_codi,0)=0)' .$whereRow ;

		$isql1 = 'SELECT r.radi_nume_radi as "IMG_Radicado" ,
				r.RADI_PATH 				as "HID_RADI_PATH",
				'.$sqlFecha.' 				as "DAT_Fecha_Radicado",
			  	r.RADI_NUME_RADI 			as "HID_Numero Radicado",
			  	r.ra_asun 					as "Asunto",
		      	td.sgd_tpr_descrip 			as "Tipo de Documento",
		      	r.radi_nume_hoja 			as "Numero de Hojas",
		      	dir.sgd_dir_direccion 		as "Direccion contacto", 
				dir.sgd_dir_telefono 		as "Telefono contacto", 
			  	dir.sgd_dir_mail 			as "Mail contacto",
				dir.sgd_dir_nombre 			AS "HID_dir_nombre",
		      	bod.nombre_de_la_empresa 	as "Nombre de la Empresa",
				bod.nombre_rep_legal 		as "Representante Legal",
			  	bod.nit_de_la_empresa 		as "NIT",
				bod.sigla_de_la_empresa 	as "Sigla",
				bod.direccion 				as "Direccion Empresa",
				bod.telefono_1 				as "Telefono",
		      	u1.usua_login 				AS "HID_login_actu", 
				u1.usua_nomb 				AS "Usuario Actual", 
				d1.depe_nomb 				AS "Dependencia Actual",
		      	r.radi_usu_ante 			as "Usuario Anterior",
		      	dir.sgd_dir_nombre 			as "Firmante",
		      	r.radi_pais 				as "Pais", 
				ROUND(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-SYSDATE)) AS "dias restantes"
		       FROM sgd_dir_drecciones dir, 
			   	radicado r, 
				sgd_tpr_tpdcumento td, 
				usuario u1, 
				dependencia d1,
			   	bodega_empresas bod
			   WHERE dir.SGD_DIR_TIPO = 1 
			   AND dir.radi_nume_radi=r.radi_nume_radi 
			   AND r.tdoc_codi=td.sgd_tpr_codigo
			   AND r.radi_usua_actu=u1.usua_codi 
			   AND r.radi_depe_actu=u1.depe_codi 
			   AND u1.depe_codi=d1.depe_codi
			   AND (dir.sgd_esp_codi=bod.identificador_empresa 
					AND NVL(dir.sgd_esp_codi,0)!=0 
					AND NVL(dir.sgd_ciu_codigo,0)=0 
					AND NVL(dir.sgd_oem_codigo,0)=0)'.$whereRow;

	  	$isql2 = 'SELECT 
				r.radi_nume_radi 		AS "IMG_Radicado"
				,r.RADI_PATH 			AS "HID_RADI_PATH"
	  				,'.$sqlFecha.' 			AS "DAT_Fecha_Radicado"
		  		,r.RADI_NUME_RADI 		AS "HID_Numero Radicado"
		  		,r.ra_asun 				AS "Asunto"
				,td.sgd_tpr_descrip 	AS "Tipo de Documento"
				,r.radi_nume_hoja 		AS "Numero de Hojas"
		  		,dir.sgd_dir_direccion 	AS "Direccion contacto"
				,dir.sgd_dir_mail 		AS "Mail contacto"
		  		,u1.usua_login 			AS "HID_login_actu"
		  		,dir.sgd_dir_telefono 	AS "HID_dir_telefono"
		  		,o.sgd_oem_oempresa 	AS "Nombre de la Empresa"
				,o.sgd_oem_rep_legal 	AS "Representante Legal"
				,o.sgd_oem_nit 			AS "NIT"
				,o.sgd_oem_sigla 		AS "Sigla"
				,o.sgd_oem_direccion 	AS "Direccion Empresa"
				,o.sgd_oem_telefono 	AS "Telefono"
				,u1.usua_nomb 			AS "Usuario Actual"
				,d1.depe_nomb 			AS "Dependencia Actual"
				,r.radi_usu_ante 		AS "Usuario Anterior"
		  		,dir.sgd_dir_nombre 	AS "Firmante"
				,r.radi_pais 			AS "Pais"
				,ROUND(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-SYSDATE)) AS "dias restantes"
		  	FROM 
		  		sgd_dir_drecciones 	dir
				,radicado 			r
				,sgd_tpr_tpdcumento td
				,usuario 			u1
				,dependencia 		d1
				,sgd_oem_oempresas 	o
		  	WHERE dir.SGD_DIR_TIPO = 1 
		  		AND dir.radi_nume_radi=r.radi_nume_radi 
		  		AND r.tdoc_codi=td.sgd_tpr_codigo
		  		AND r.radi_usua_actu=u1.usua_codi 
		  		AND r.radi_depe_actu=u1.depe_codi 
		  		AND u1.depe_codi=d1.depe_codi
		  		AND (dir.sgd_oem_codigo=o.sgd_oem_codigo 
				AND NVL(dir.sgd_oem_codigo,0)!=0 
				AND NVL(dir.sgd_ciu_codigo,0)=0 
				AND NVL(dir.sgd_esp_codi,0)=0)
			' .$whereRow;

		$isql3 = 'SELECT r.radi_nume_radi 		AS "IMG_Radicado"
			 , r.radi_path			 	AS "HID_RADI_PATH"
			 ,'.$sqlFecha.' 			AS "DAT_Fecha_Radicado"
		  		,r.RADI_NUME_RADI 		AS "HID_Numero Radicado"
			 , r.ra_asun 				AS "Asunto"
			 , td.sgd_tpr_descrip		AS "Tipo de Documento"
			 , r.radi_nume_hoja			AS "Numero de Hojas"
			 , dir.sgd_dir_direccion	AS "Direccion contacto"
			 , dir.sgd_dir_telefono		AS "Telefono contacto"
			 , dir.sgd_dir_mail			AS "Mail contacto"
			 , o.usua_nomb				AS "Nombre"
			 , o.usua_email				AS "Email Interno"
			 , o.usua_doc				AS "Documento"
			 , u1.usua_login 			AS "Login Interno"
			 , o.usua_piso				AS "Email Funcionario"
			 , o.usu_telefono1			AS "Telefono"
			 , o.usua_nomb				AS "Usuario Actual"
			 , d1.depe_nomb 			AS "Dependencia Actual"
			 , r.radi_usu_ante			AS "Usuario Anterior"
			 , dir.sgd_dir_nombre		AS "Firmante"
			 ,r.radi_pais				AS "Pais"
			 , ROUND(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-SYSDATE)) AS "Dias Restantes"
		FROM sgd_dir_drecciones dir, radicado r, sgd_tpr_tpdcumento td, usuario u1, dependencia d1, 
			usuario o
		WHERE dir.SGD_DIR_TIPO = 1 
			AND dir.radi_nume_radi	=r.radi_nume_radi 
			AND r.tdoc_codi			=td.sgd_tpr_codigo
			AND r.radi_usua_actu	=u1.usua_codi 
			AND r.radi_depe_actu	=u1.depe_codi 
			AND u1.depe_codi		=d1.depe_codi
			AND (dir.sgd_doc_fun		=o.usua_doc 
			AND NVL(dir.sgd_doc_fun,0)!=0 
			AND NVL(dir.sgd_ciu_codigo,0)=0 
			AND NVL(dir.sgd_esp_codi,0)=0
			)' .$whereRow;
	}break;
}
?>