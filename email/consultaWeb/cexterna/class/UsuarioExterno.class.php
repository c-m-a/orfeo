<?php
	// Clase para consulta externa
	class UsuarioExterno {
		var $idEmpresa;
		// Variables privadas
		var $db = "";
		var $empresa = array();
		var $anexos = array();
		var $radicados = array();
		var $expedientes = array();
		
		// Constructor
		function UsuarioExterno ($idEmpresa, & $db) {
			$this->idEmpresa = $idEmpresa;
			$this->db = $db;
		}
		
		function consultarRadicados ($numRadicado){
			$this->numRadicado = $numRadicado;
			$this->idEmpresa = $idEmpresa;
		}
		
		function obtenerEmp () {
			$idEmpresa = $this->idEmpresa;
			// Sentencia SQL para consultar datos de la empresa
			$sql = "SELECT bod.nombre_de_la_empresa, 
					bod.nit_de_la_empresa, 
					bod.direccion, 
					bod.email 
				FROM bodega_empresas bod 
				WHERE bod.identificador_empresa = " . $idEmpresa;
			
			$rs = $this->db->query($sql);
			while (!$rs->EOF) {
				$empresa["NOMBRE_DE_LA_EMPRESA"] = $rs->fields["NOMBRE_DE_LA_EMPRESA"];
				$empresa["NIT_DE_LA_EMPRESA"] = $rs->fields["NIT_DE_LA_EMPRESA"];
				$empresa["DIRECCION"] = $rs->fields["DIRECCION"];
				$empresa["EMAIL"] = $rs->fields["EMAIL"];
				$rs->MoveNext();
			}
			return $empresa;
		}
		
		function consultarExp($dependencia = null, $vigencia = true) {
			$finalFlujo = "";	// Variable que contiene el ID del 
			$idEmpresa = $this->idEmpresa;
			
			$whereDep = (isset($dependencia)) ? "sexp.depe_codi = $dependencia AND" : "" ;
			
			if (isset($dependencia)) {
				/* Consulta para obtener el id que posee la dependencia 
				 * flujo documental 
				 */
				$sql = "SELECT sexp.sgd_pexp_codigo AS idproceso
						FROM sgd_sexp_secexpedientes sexp 
						WHERE depe_codi = '$dependencia' AND 
						sexp.sgd_pexp_codigo IS NOT NULL AND
						ROWNUM = 1";
				$rs = $this->db->query($sql);
				// Captura el codigo del final del flujo
				if (!$rs->EOF) {
					$idProceso = $rs->fields["IDPROCESO"];
					$sql = "SELECT fexp.sgd_fexp_codigo AS finalflujo 
						FROM 	sgd_pexp_procexpedientes pexp,
							sgd_fexp_flujoexpedientes fexp
						WHERE 	pexp.sgd_pexp_codigo = fexp.sgd_pexp_codigo AND
							pexp.sgd_pexp_codigo = '$idProceso' /*AND
							ROWNUM = 1*/
						ORDER BY sgd_fexp_orden DESC";
					$rs = $this->db->query($sql);
					if (!$rs->EOF) {
						$finalFlujo = $rs->fields["FINALFLUJO"];
						$filtro = (isset($vigencia) && $vigencia == true) ? "<>" : "=";
					}
				}
			}
			
			// Sentencia para consultar expedientes y radicados de la Empresa
			$sql = "SELECT DISTINCT exp.sgd_exp_numero,
					sexp.sgd_sexp_fech,
					sexp.sgd_fexp_codigo,
					fexp.sgd_fexp_descrip
				FROM radicado rad,
					sgd_exp_expediente exp,
					sgd_tpr_tpdcumento tpr,
					sgd_sexp_secexpedientes sexp,
					sgd_fexp_flujoexpedientes fexp
				WHERE sexp.sgd_sexp_parexp2 = '" . $idEmpresa . "' AND
					rad.radi_nume_radi = exp.radi_nume_radi AND
					rad.tdoc_codi = tpr.sgd_tpr_codigo AND
					exp.sgd_exp_numero = sexp.sgd_exp_numero(+) AND
					sexp.sgd_fexp_codigo $filtro '$finalFlujo' AND
					$whereDep
					exp.sgd_exp_estado <> 2 AND
					fexp.sgd_fexp_codigo = sexp.sgd_fexp_codigo
				ORDER BY exp.sgd_exp_numero";
			$rs = $this->db->query($sql);
			$cont = 0;
			while(!$rs->EOF) {
				$expAct = $rs->fields["SGD_EXP_NUMERO"];
				if ($expAct != $expAnt) {
					$expedientes[$cont]["SGD_EXP_NUMERO"] = $rs->fields["SGD_EXP_NUMERO"];
					$expedientes[$cont]["SGD_SEXP_FECH"] = $rs->fields["SGD_SEXP_FECH"];
					$expedientes[$cont]["RADI_NUME_RADI"] = $rs->fields["RADI_NUME_RADI"];
					$expedientes[$cont]["SGD_FEXP_DESCRIP"] = $rs->fields["SGD_FEXP_DESCRIP"];
					$cont++;
				}
				$expAnt = $expAct;
				$rs->MoveNext();
			}
			return $expedientes;
		}
		
		function detalleExp($numExp,$numDiaMax = null) {
			$idEmpresa = $this->idEmpresa;
			$cont = 0;
			$nExp = $numExp;
			$whereExp = "exp.sgd_exp_numero = '$nExp' AND";
			
			// Sentencia para consultar expedientes y radicados de la Empresa
			$sql = "SELECT srd.sgd_srd_codigo,
					srd.sgd_srd_descrip,
					SBRD.sgd_sbrd_codigo, 
					SBRD.SGD_SBRD_DESCRIP, 
					PEXP.SGD_PEXP_DESCRIP,
					PEXP.SGD_PEXP_TERMINOS, 
					SEXP.SGD_SEXP_FECH, 
					FEXP.SGD_FEXP_CODIGO,
					FEXP.SGD_FEXP_DESCRIP
				FROM SGD_SRD_SERIESRD SRD, 
					SGD_SBRD_SUBSERIERD SBRD, 
					SGD_PEXP_PROCEXPEDIENTES PEXP 
				RIGHT JOIN SGD_SEXP_SECEXPEDIENTES
					SEXP ON SEXP.SGD_PEXP_CODIGO = PEXP.SGD_PEXP_CODIGO LEFT JOIN 
					SGD_FEXP_FLUJOEXPEDIENTES FEXP ON SEXP.SGD_FEXP_CODIGO = FEXP.SGD_FEXP_CODIGO 
				WHERE SEXP.SGD_SRD_CODIGO = SRD.SGD_SRD_CODIGO AND
					SEXP.SGD_SBRD_CODIGO = SBRD.SGD_SBRD_CODIGO AND 
					SRD.SGD_SRD_CODIGO = SBRD.SGD_SRD_CODIGO AND 
					SEXP.SGD_EXP_NUMERO = '$numExp'";
			$rsExp = $this->db->query($sql);
			if (!$rsExp->EOF) {
				$expediente[$cont]["SGD_SRD_CODIGO"] = $rsExp->fields["SGD_SRD_CODIGO"];
				$expediente[$cont]["SGD_SRD_DESCRIP"] = $rsExp->fields["SGD_SRD_DESCRIP"];
				$expediente[$cont]["SGD_SBRD_CODIGO"] = $rsExp->fields["SGD_SBRD_CODIGO"];
				$expediente[$cont]["SGD_SBRD_DESCRIP"] = $rsExp->fields["SGD_SBRD_DESCRIP"];
				$expediente[$cont]["SGD_PEXP_DESCRIP"] = $rsExp->fields["SGD_PEXP_DESCRIP"];
				$expediente[$cont]["SGD_PEXP_TERMINOS"] = $rsExp->fields["SGD_PEXP_TERMINOS"];
				$expediente[$cont]["SGD_SEXP_FECH"] = $rsExp->fields["SGD_SEXP_FECH"];
				$expediente[$cont]["SGD_FEXP_CODIGO"] = $rsExp->fields["SGD_FEXP_CODIGO"];
				$expediente[$cont]["SGD_FEXP_DESCRIP"] = $rsExp->fields["SGD_FEXP_DESCRIP"];
				$cont++;
				$rsExp->MoveNext();
			}
			
			$sql = "SELECT exp.*,
					tpr.sgd_tpr_descrip,
					TO_CHAR(rad.RADI_FECH_RADI,'DD-MM-YYYY HH24:MI AM') as fecha_rad,
					rad.radi_cuentai,
					rad.ra_asun,
					rad.radi_path,
					rad.*
				FROM	sgd_exp_expediente exp,
					radicado rad,
					sgd_tpr_tpdcumento tpr
				WHERE 	exp.sgd_exp_numero = '$numExp' AND
					exp.radi_nume_radi = rad.radi_nume_radi AND 
					rad.radi_nume_radi not like '%5' AND
					rad.radi_path LIKE '%.tif' AND
					rad.tdoc_codi = tpr.sgd_tpr_codigo AND
					exp.sgd_exp_estado <> 2 
				ORDER BY
					TO_CHAR(rad.RADI_FECH_RADI,'YYYY-MM-DD HH24:MI AM') DESC";
			
			$rsRad = $this->db->query($sql);
			$cont = 0;
			while (!$rsRad->EOF) {
				$radicados[$cont]["RADI_NUME_RADI"] = $rsRad->fields["RADI_NUME_RADI"];
				$radicados[$cont]["SGD_TPR_DESCRIP"] = $rsRad->fields["SGD_TPR_DESCRIP"];
				$radicados[$cont]["FECHA_RAD"]	= $rsRad->fields["FECHA_RAD"];
				$radicados[$cont]["TDOC_CODI"]  = $rsRad->fields["TDOC_CODI"];
				$radicados[$cont]["RAD_SUN"] 	= $rsRad->fields["RAD_SUN"];
				$radicados[$cont]["RADI_PATH"] 	= $rsRad->fields["RADI_PATH"];
				$radicados[$cont]["RA_ASUN"] 	= $rsRad->fields["RA_ASUN"];
				$cont++;
				$rsRad->MoveNext();
			}
			
			// Si hay radicados entonces los asigna
			if (is_array($radicados)) {
				foreach($radicados as $radicado){
					$expediente["radicados"][] = $radicado;
				}
			}
			
			/* Consulta para obtener los radicados que son resoluciones y que no cumplen
			 * el tiempo maximo para mostrar.  
			 * Si exite el numero de dias realiza la consulta y proceso de filtrado
			 */
			if (isset($numDiaMax)) {
				$fechaMax = mktime() + ($numDiaMax * 86400);
				$fechaMax = date ('Y-m-d', $fechaMax);
				$whereFecha = "TO_CHAR(rad.radi_fech_radi,'YYYY-MM-DD') < '$fechaMax' AND";
				
				$sql = "SELECT exp.*,
						tpr.sgd_tpr_descrip,
						TO_CHAR(rad.radi_fech_radi,'DD-MM-YYYY HH24:MI AM') as fecha_rad,
						rad.radi_cuentai,
						rad.ra_asun,
						rad.radi_path,
						rad.*
					FROM	sgd_exp_expediente exp,
						radicado rad,
						sgd_tpr_tpdcumento tpr
					WHERE 	exp.sgd_exp_numero = '$numExp' AND
						exp.radi_nume_radi = rad.radi_nume_radi AND 
						rad.radi_nume_radi LIKE '%5' AND
						rad.radi_path LIKE '%.tif' AND
						$whereFecha
						rad.tdoc_codi = tpr.sgd_tpr_codigo AND
						exp.sgd_exp_estado <> 2 
					ORDER BY
						TO_CHAR(rad.radi_fech_radi,'YYYY-MM-DD HH24:MI AM') DESC";
				
				$rsRes = $this->db->query($sql);
				$cont = 0;
				while (!$rsRes->EOF) {
					$resoluciones[$cont]["RADI_NUME_RADI"]  = $rsRes->fields["RADI_NUME_RADI"];
					$resoluciones[$cont]["SGD_TPR_DESCRIP"] = $rsRes->fields["SGD_TPR_DESCRIP"];
					$resoluciones[$cont]["FECHA_RAD"]	= $rsRes->fields["FECHA_RAD"];
					$resoluciones[$cont]["TDOC_CODI"] 	= $rsRes->fields["TDOC_CODI"];
					$resoluciones[$cont]["RAD_SUN"] 	= $rsRes->fields["RAD_SUN"];
					$resoluciones[$cont]["RADI_PATH"] 	= $rsRes->fields["RADI_PATH"];
					$resoluciones[$cont]["RA_ASUN"] 	= $rsRes->fields["RA_ASUN"];
					$cont++;
					$rsRes->MoveNext();
				}
				
				// Si hay resultados de la consulta de resoluciones entonces las asigna
				if (is_array($resoluciones)) {
					foreach($resoluciones as $resolucion){
						$expediente["radicados"][] = $resolucion;
					}
				}
				unset($radicados);
			}
			
			return $expediente;
		}
		
		function getDependencias (){
			$cont = 0;
			// Sentencia para consultar dependencias
			$sql = "SELECT depe_codi, depe_nomb FROM dependencia ORDER by depe_nomb";
			$rs = $this->db->query($sql);
			while(!$rs->EOF) {
				$dependencias[$cont]["DEPE_CODI"] = $rs->fields["DEPE_CODI"];
				$dependencias[$cont]["DEPE_NOMB"] = $rs->fields["DEPE_NOMB"];
				$cont++;
				$rs->MoveNext();
			}
			return $dependencias;
		}
		
		function expPorDep ($dependencia = null , $vigencia = true) {
			$idEmpresa = $this->idEmpresa;
			$numRows = 0;
			$whereDependencia = (isset($dependencia)) ? "sExp.depe_codi = " . $dependencia . " AND": "";
			
			if (isset($dependencia)) {
				/* Consulta para obtener el id que posee la dependencia 
				 * flujo documental 
				 */
				$sql = "SELECT sexp.sgd_pexp_codigo AS idproceso
						FROM sgd_sexp_secexpedientes sexp 
						WHERE depe_codi = '$dependencia' AND ROWNUM = 1";
				
				$rs = $this->db->query($sql);
				
				// Captura el codigo del final del flujo
				if (!$rs->EOF) {
					$idProceso = $rs->fields["IDPROCESO"];
					$sql = "SELECT fexp.sgd_fexp_codigo AS finalflujo 
						FROM 	sgd_pexp_procexpedientes pexp,
							sgd_fexp_flujoexpedientes fexp
						WHERE 	pexp.sgd_pexp_codigo = fexp.sgd_pexp_codigo AND
							pexp.sgd_pexp_codigo = '$idProceso' /*AND
							ROWNUM = 1*/
						ORDER BY sgd_fexp_orden DESC";
					$rs = $this->db->query($sql);
					if (!$rs->EOF) {
						$finalFlujo = $rs->fields["FINALFLUJO"];
						$filtro = (isset($vigencia) && $vigencia == true) ? "<>" : "=";
						$vigencia = (isset($vigencia) && $vigencia == true) ? "1" : "0";
						$whereFlujo = "sexp.sgd_fexp_codigo $filtro '$finalFlujo' AND";
					}
				}
			}
			
			$sql = "SELECT COUNT(DISTINCT exp.sgd_exp_numero) total_expedientes,
					max(sExp.sgd_sexp_fech) ultima_fecha,
					sexp.depe_codi,
					dep.depe_nomb
				FROM bodega_empresas bod,
					radicado rad,
					sgd_exp_expediente exp,
					sgd_tpr_tpdcumento tpr,
					sgd_sexp_secexpedientes sexp,
					dependencia dep
				WHERE bod.IDENTIFICADOR_EMPRESA = $idEmpresa AND
					bod.IDENTIFICADOR_EMPRESA = rad.EESP_CODI AND
					rad.radi_nume_radi = exp.radi_nume_radi AND
					rad.TDOC_CODI = tpr.sgd_tpr_codigo AND
					exp.sgd_exp_numero = sexp.sgd_exp_numero AND
					exp.sgd_exp_estado <> 2 AND
					$whereFlujo
					$whereDependencia
					dep.depe_codi = sexp.depe_codi
				GROUP BY
					sexp.depe_codi,
					dep.depe_nomb
				ORDER BY dep.depe_nomb";
			
			$rs = $this->db->query($sql);
			$cont = 0;
			while(!$rs->EOF) {
				$expedientes[$cont]["TOTAL_EXPEDIENTES"] = $rs->fields["TOTAL_EXPEDIENTES"];
				$expedientes[$cont]["ULTIMA_FECHA"] 	= $rs->fields["ULTIMA_FECHA"];
				$expedientes[$cont]["TOTAL_RADICADOS"] 	= $rs->fields["TOTAL_RADICADOS"];
				$expedientes[$cont]["DEPE_CODI"] = $rs->fields["DEPE_CODI"];
				$expedientes[$cont]["DEPE_NOMB"] = $rs->fields["DEPE_NOMB"];
				$expedientes[$cont]["VIGENCIA"] = $vigencia;
				$cont++;
				$rs->MoveNext();
			}
			return $expedientes;
		}
	}
?>
