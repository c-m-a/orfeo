<?
error_reporting(0);
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");
$db->conn->SetFetchMode(ADODB_FETCH_NUM);	
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
//$db->conn->debug = true;
error_reporting(7);
define('ADODB_ASSOC_CASE', 1);
//echo "$usuario " . md5($drd);
$krd = strtoupper($krd);
$fechah=date("Ymd") . "_". time("hms");
$check=1;
$numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
$ValidacionKrd = "";
$query = "select 
						a.SGD_TRAD_CODIGO
						,a.SGD_TRAD_DESCR
						,a.SGD_TRAD_ICONO
						from SGD_TRAD_TIPORAD a
						order by a.SGD_TRAD_CODIGO
						";
		error_reporting(7);
		$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$rs = $db->query($query);
		//$numRegs = "! ".$rs->RecordCount();
		$varQuery = $query;
		$comentarioDev = ' Busca todos los tipos de Radicado Existentes ';
		include "$ruta_raiz/include/tx/ComentarioTx.php";
		$iTpRad=0;
		$queryTip3 = "";
		$tpNumRad=array();
		$tpDescRad=array();
		$tpImgRad=array();
		while(!$rs->EOF)
		{
			$numTp = $rs->fields["SGD_TRAD_CODIGO"];
			$descTp = $rs->fields["SGD_TRAD_DESCR"];
			$imgTp = $rs->fields["SGD_TRAD_ICONO"];
			$queryTRad .= ",a.USUA_PRAD_TP$numTp";
			$queryDepeRad .= ",b.DEPE_RAD_TP$numTp";
			$queryTip3 .= ",a.SGD_TPR_TP$numTp";
			$tpNumRad[$iTpRad]=$numTp;
			$tpDescRad[$iTpRad]=$descTp;
			$tpImgRad[$iTpRad]=$imgTp;
			$iTpRad++;
			$rs->MoveNext();
		}
   /**	
		 *	BUSQUEDA DE ICONOS Y NOMBRES PARA LOS TERCEROS (Remitentes/Destinarios) AL RADICAR
		 *	@param	$tip3[][][]  Array  Contiene los tipos de radicacion existentes.  En la primera dimencion indica la posicion dependiendo del tipo de rad. (ej. salida -> 1, ...). En la segunda dimencion almacenara los datos de nombre del tipo de rad. inidicado, Para la tercera dimencion indicara la descripcion del tercero y en la cuarta dim. contiene el nombre del archio imagen del tipo de tercero.
		 */
    $query = "select 
					a.SGD_DIR_TIPO
					,a.SGD_TIP3_CODIGO
					,a.SGD_TIP3_NOMBRE
					,a.SGD_TIP3_DESC
					,a.SGD_TIP3_IMGPESTANA
					$queryTip3
					from SGD_TIP3_TIPOTERCERO a";
    $rs = $db->query($query);
		while(!$rs->EOF)
		{
			$dirTipo = $rs->fields["SGD_DIR_TIPO"];
			$nombTip3 = $rs->fields["SGD_TIP3_NOMBRE"];
			$descTip3 = $rs->fields["SGD_TIP3_DESC"];
			$imgTip3 = $rs->fields["SGD_TIP3_IMGPESTANA"];
			for($iTp=0;$iTp<=$iTpRad;$iTp++)
			{
				$numTp =  $tpNumRad[$iTp];
				$campoTip3 = "SGD_TPR_TP$numTp";
				$numTpExiste = $rs->fields[$campoTip3];
				if($numTpExiste>=1)
				{
					$tip3Nombre[$dirTipo][$numTp] = $nombTip3;
					$tip3desc[$dirTipo][$numTp] = $descTip3;
					$tip3img[$dirTipo][$numTp] = $imgTip3;
					//echo "<hr> $ tip3img[$dirTipo][$numTp] =". $tip3img[$dirTipo][$numTp] ."<hr>";
				}
			}
			$rs->MoveNext();
		} 

		if($recOrfeo!="Seguridad")
		{
		  $queryRec = "AND (USUA_PASW ='". SUBSTR(md5($drd),1,26) ."' or USUA_NUEVO=0)"; 
		}
		else
		{
			$queryRec = "AND USUA_SESION='".str_replace(".","o",$REMOTE_ADDR)."o$krd' ";
		}
    $query = "select a.*
				,b.DEPE_NOMB
				,a.USUA_ESTA
				,a.USUA_CODI
				,a.USUA_LOGIN
				,b.DEPE_CODI_TERRITORIAL
				,b.DEPE_CODI_PADRE
				,a.USUA_PERM_ENVIOS
				,a.USUA_PERM_MODIFICA
				$queryTRad
				$queryDepeRad
					from usuario a
						,DEPENDENCIA b
					where
						USUA_LOGIN ='$krd' and  a.depe_codi=b.depe_codi
						$queryRec";
						
	/** Procedimiento forech que encuentra los numeros de secuencia para las radiciones
	*	 @param tpDepeRad[]	array 	Muestra las dependencias que contienen las secuencias para radicion.
	*/
		$varQuery = $query;
		$comentarioDev = ' Busca Permisos de Usuarios ...';
		include "$ruta_raiz/include/tx/ComentarioTx.php";
		$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$rs = $db->query($query);
		$perm_radi_salida_tp = 0;		

		foreach ($tpNumRad as $key => $valueTp) 
		{
		    $campo  = "DEPE_RAD_TP$valueTp";
		    $campoPer  = "USUA_PRAD_TP$valueTp";		                         
			$tpDepeRad[$valueTp] = $rs->fields[$campo];
			$tpPerRad[$valueTp] = $rs->fields[$campoPer];
			if($tpPerRad[$valueTp]>=1)
			{
				$perm_radi_salida_tp = 1;
			}
			$tpDependencias .= "<".$rs->fields[$campo].">";
		}

if ($usuarioWeb="SSPD")
  {
if ($usuarioWeb="SSPD")
		{
		$fechah = date("dmy") . "_" . time("hms");
		$dependencia=$rs->fields["DEPE_CODI"];
		$dependencianomb=$rs->fields["DEPE_NOMB"];
		$codusuario =$rs->fields["USUA_CODI"];
		$usua_doc =$rs->fields["USUA_DOC"];
		$usua_nomb =$rs->fields["USUA_NOMB"];
		$usua_piso =$rs->fields["USUA_PISO"];
		$usua_nacim =$rs->fields["USUA_NACIMIENTO"];
		$usua_ext =$rs->fields["USUA_EXT"];
		$usua_at =$rs->fields["USUA_AT"];
		$usua_nuevo = $rs->fields["USUA_NUEVO"];
		$usua_email =$rs->fields["USUA_EMAIL"];
		$nombusuario =$rs->fields["USUA_NOMB"];
		$contraxx=$rs->fields["USUA_PASW"];
		$depe_nomb=$rs->fields["DEPE_NOMB"];
		$usua_modifica=$rs->fields["USUA_MODIFICA"];
		$crea_plantilla=$rs->fields["USUA_ADM_PLANTILLA"];
		$usua_admin_archivo = $rs->fields["USUA_ADMIN_ARCHIVO"];
		//$perm_radi_sal = $rs->fields["PERM_RADI_SAL"];  
		// 1 asignar radicado, 2 carpeta Impresion, 3 uno y 2.
		$usua_perm_impresion = $rs->fields["USUA_PERM_IMPRESION"];
		if($usua_perm_impresion==1)
		{
			if($perm_radi_salida_tp>=1) $perm_radi_sal = 3; else $perm_radi_sal = 1;
		}else
		{
			if($perm_radi_salida_tp>=1) $perm_radi_sal = 1;
		}
		$usua_masiva = $rs->fields["USUA_MASIVA"];
		$depe_codi_padre = $rs->fields["DEPE_CODI_PADRE"];
		$usua_perm_numera_res = $rs->fields["USUA_PERM_NUMERA_RES"];
		$depe_codi_territorial = $rs->fields["DEPE_CODI_TERRITORIAL"];
		$usua_perm_dev = $rs->fields["USUA_PERM_DEV"];
		$usua_perm_anu = $rs->fields["SGD_PANU_CODI"];
		$usua_perm_envios= $rs->fields["USUA_PERM_ENVIOS"];
		$usua_perm_modifica = $rs->fields["USUA_PERM_MODIFICA"];
		
		$mostrar_opc_envio=0;
		//if($drd){$drde=md5($drd);}
		/** cerrar session */
		$nivelus=$rs->fields["CODI_NIVEL"];

		$isql = "select b.MUNI_NOMB from dependencia a,municipio b
				where a.muni_codi=b.muni_codi
					and a.dpto_codi=b.dpto_codi
					and a.muni_codi=b.muni_codi
					and a.depe_codi='$dependencia'";
		$rs = $db->query($isql);
		$depe_municipio= $rs->fields["MUNI_NOMB"];
		/**
			*   Consulta que a?ade los nombres y codigos de carpetas del Usuario
			*/

		$isql = "select CARP_CODI, CARP_DESC from carpeta
					";
		$rs = $db->query($isql);
		//$rs = $db->query($query);
		$iC = 0;
		while(!$rs->EOF)
		{
			$iC = $rs->fields["CARP_CODI"];
			$descCarpetasGen[$iC] = $rs->fields["CARP_DESC"];
			$rs->MoveNext();
		}
/**	Eliminado para session Web.	
		$isql = "select CODI_CARP, DESC_CARP from carpeta_per 
						where usua_codi=$codusuario and depe_codi = $dependencia";
		$rs = $db->query($isql);
		//$rs = $db->query($query);
		$iC = 0;
		while(!$rs->EOF)
		{
			$iC = $rs->fields["CODI_CARP"];
			$descCarpetasPer[$iC] = $rs->fields["DESC_CARP"];
			$rs->MoveNext();
		} */

		// Fin Consulta de carpetas
		error_reporting(0);
		$recOrfeoOld = $recOrfeo;
		session_start();
		$recOrfeo = $recOrfeoOld;
		session_id(str_replace(".","o",$REMOTE_ADDR)."o$krd");
		$fechah = date("Ymd"). "_". time("hms");
		$carpeta = 0;
		$dirOrfeo = str_replace("login.php","",$PHP_SELF);
		$_SESSION["dirOrfeo"]=$dirOrfeo;
		$_SESSION["drde"]=$contraxx;
		$_SESSION["usua_doc"]=trim($usua_doc);
		$_SESSION["dependencia"]=$dependencia;
		$_SESSION["codusuario"]=$codusuario;
		$_SESSION["depe_nomb"]=$depe_nomb;
		$_SESSION["depe_municipio"]=$depe_municipio;
		$_SESSION["usua_doc"]=$usua_doc;
		$_SESSION["usua_email"]=$usua_email;
		$_SESSION["usua_at"]=$usua_at;
		$_SESSION["usua_ext"]=$usua_ext;
		$_SESSION["usua_piso"]=$usua_piso;
		$_SESSION["usua_nacim"]=$usua_nacim;
		$_SESSION["usua_nomb"]=$usua_nomb;
		$_SESSION["usua_nuevo"]=$usua_nuevo;
		$_SESSION["usua_admin_archivo"] =$usua_admin_archivo;
		$_SESSION["usua_masiva"] =$usua_masiva;		
		$_SESSION["usua_perm_dev"]=$usua_perm_dev;	
		$_SESSION["usua_perm_anu"] = $usua_perm_anu;	
		$_SESSION["usua_perm_numera_res"]=$usua_perm_numera_res;
		$_SESSION["perm_radi_sal"]=$perm_radi_sal;		
		$_SESSION["depecodi"]=$dependencia;
		$_SESSION["usua_modifica"]=$usua_modifica;
		$_SESSION["fechah"]=$fechah;
		$_SESSION["crea_plantilla"]=$crea_plantilla;
		$_SESSION["verrad"]=0;
		$_SESSION["menu_ver"]=3;
		$_SESSION["depe_codi_padre"] =$depe_codi_padre;
		$_SESSION["depe_codi_territorial"]=$depe_codi_territorial;
		$_SESSION["nivelus"]=$nivelus;
		$_SESSION["tpNumRad"] = $tpNumRad;
		$_SESSION["tpDescRad"] = $tpDescRad;
		$_SESSION["tpImgRad"] = $tpImgRad;
		$_SESSION["tpDepeRad"] = $tpDepeRad;
		$_SESSION["tpPerRad"] = $tpPerRad;
		$_SESSION["tpPerRad"] = $tpPerRad;
		$_SESSION["usua_perm_envios"] = $usua_perm_envios;
		$_SESSION["usua_perm_modifica"] = $usua_perm_modifica;
		$_SESSION["descCarpetasGen"] = $descCarpetasGen;
		$_SESSION["tip3Nombre"] = $tip3Nombre;
		$_SESSION["tip3desc"] = $tip3desc;
		$_SESSION["tip3img"] = $tip3img;
		//$_SESSION["mostrar_opc_envio"]=$mostrar_opc_envio;
		$nomcarpera = "ENTRADA";
	if(!$orno) $orno=0;
	$query = "update usuario set usua_sesion='". substr(session_id(),0,29) ."',usua_fech_sesion=sysdate where  USUA_LOGIN ='$krd'  ";
	$recordSet["USUA_SESION"] = " '".session_id()."' ";
	error_reporting(7);
	$recordSet["USUA_FECH_SESION"] = $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
	$recordWhere["USUA_LOGIN"] = "'$krd'";
	$db->update("USUARIO", $recordSet,$recordWhere);
	$ValidacionKrd="Si";
	
?>
<!--<body bgcolor="#003399" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.form3.submit();" > -->
<? 
}
}
?>
