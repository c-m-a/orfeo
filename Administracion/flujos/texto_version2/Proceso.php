<?php

class Proceso{
	
var $nombreProceso;
var $codigoProceso;
var $serieProceso;
var $subSerieProceso;
var $flujoAutomatico = 0;
var $terminosProceso;
var $tieneFlujo = 0;
var $db;
var $mensajeResultadoHeader = "<center><table class=borde_tab><tr><td ";
var $mensajeResultadoStyle = "";
var $mensajeResultadoFooter = "</td></tr></table></center>";
var $estiloError = "class=titulosError2>";
var $estiloExito = "class=titulos>";

function Proceso( $db, $nombreProceso,$serieProceso = null, $subSerieProceso = null, 
				  $flujoAutomatico = null,  $terminosProceso = null ){
		$this->db = $db;
//			$this->db->conn->debug = true;

		$this->nombreProceso =  $nombreProceso;
		$this->serieProceso = ( $serieProceso !=null ? $serieProceso : 'null' );
		$this->subSerieProceso = ( $subSerieProceso != null ? $subSerieProceso : 0 );
		$this->flujoAutomatico = ( $flujoAutomatico  ? 1 : 1 ); //cambiar el segundo 1 por 0
		$this->terminosProceso = ( $terminosProceso != null ? $terminosProceso : 0 );
		$this->tieneFlujo = 1;
		
}

 	/**
        * Author: Johnny Gonzalez L.
        * Inserta un nuevo Proceso al cual se le va a crear flujo
        **/
        //function insertaProceso ($nombreProceso, $codProceso = null){
        function insertaProceso ( ){
		
		$queryID = "select max(sgd_pexp_codigo) AS IDACTUAL from sgd_pexp_procexpedientes";
		$rs = $this->db->conn->query($queryID);
		$this->codigoProceso = $rs->fields['IDACTUAL'] + 1;
		
                if($this->codigoProceso != null &&  $this->serieProceso != 0 &&  $this->subSerieProceso != 0){
                	
                	
                		$query = "INSERT INTO sgd_pexp_procexpedientes (  sgd_pexp_codigo, sgd_pexp_descrip, ";
                        $query .= " sgd_srd_codigo, sgd_sbrd_codigo, sgd_pexp_automatico, sgd_pexp_terminos, sgd_pexp_tieneflujo )";
                        $query .= " VALUES ( " . $this->codigoProceso . ",  '$this->nombreProceso' , ";
                        $query .= " $this->serieProceso, $this->subSerieProceso, $this->flujoAutomatico, ";
                        $query .= " $this->terminosProceso , $this->tieneFlujo )";
                	
                        
                } else{
                	$mensajeResultadoStyle = "class=titulosError2>";
                        return $mensajeResultadoHeader . $mensajeResultadoStyle . "No se pudo insertar el proceso, debe ingresar TRD para el proceso." . $mensajeResultadoFooter;
                }

                if (!$rs = $this->db->conn->query($query)){
                    return $this->mensajeResultadoHeader . $this->estiloError . "No se Pudo insertar el Proceso, ya existe un proceso con el mismo nombre y/o c&oacute;digo de proceso." . $this->mensajeResultadoFooter;
                }else{
	                return $this->mensajeResultadoHeader . $this->estiloExito . "Se registr&oacute; el Proceso con c&oacute;digo: " . $this->codigoProceso . " de forma exitosa." . $this->mensajeResultadoFooter;
                }


        }
}

class EtapaFlujo{
	var $etapa;
	var $db;
var $mensajeResultadoHeader = "<center><table class=borde_tab><tr><td ";
var $mensajeResultadoStyle = "";
var $mensajeResultadoFooter = "</td></tr></table></center>";
var $estiloError = "class=titulosError2>";
var $estiloExito = "class=titulos>";
	
	function EtapaFlujo( $db ){
			$this->db = $db;
//			$this->db->conn->debug = true;

	}
	
	//Aqui va la clase Etapa.
	function initEtapa( $nombreEtapa, $ordenEtapa, $terminoEtapa, $codigoProceso ){
		include_once "../class.Etapa.php";
		
		$this->etapa = new Etapa(   $ordenEtapa, $nombreEtapa, $terminoEtapa, $codigoProceso);
		
	}	
	
	/**
	 * Funcion que inserta la etapa en la base de datos, dependiendo de los datos que se le insertaron a la variable etapa
	 *
	 * @return nombreEtapa, resultado de la inserci&oacute;n de la etapa en la base de datos
	 */
	function insertaEtapa(){
		
			$queryID = "select max(sgd_fexp_codigo) AS IDACTUAL from sgd_fexp_flujoexpedientes";	
				$rs = $this->db->conn->query($queryID);
				
			$idEtapa = $rs->fields['IDACTUAL'] + 1;
		$orden = $this->etapa->getOrden();
		$codProc = $this->etapa->getCodigoProceso();
		//El procesamiento es un poquito diferente cuanto viene desde la creacion grafica del esquema del flujo
		if($this->etapa->getGrafico() != null){
			
			$query = "INSERT INTO sgd_fexp_flujoexpedientes (  sgd_fexp_codigo, sgd_pexp_codigo, ";
            $query .= " sgd_fexp_orden, sgd_fexp_terminos, sgd_fexp_descrip )";
            $query .= " VALUES ( " . $idEtapa . ", " . $this->etapa->getCodigoProceso() . ", ";
            $query .= $this->etapa->getOrden() . ", ". $this->etapa->getTerminos() . ", " .  "'" . $this->etapa->getDescripcion() . "' )";
            
            if ( !$rs = $this->db->conn->query( $query ) ){
	            return $this->mensajeResultadoHeader . $this->estiloError .'Error: Lo siento no se pudo agregar LA ETAPA '. $this->mensajeResultadoFooter;
	        }else{
	            return  $idEtapa;
	        }
		}
		if($orden != null){	
			$queryOrdenET = "select sgd_fexp_codigo from sgd_fexp_flujoexpedientes where 
							 sgd_pexp_codigo = " . $codProc . " and sgd_fexp_orden = " . $orden;
			$rsOrd = $this->db->conn->query( $queryOrdenET );
			$counter = 0;
			while( !$rsOrd->EOF )
			{
				$counter++;
				$rsOrd->MoveNext();
			}
			if ( $counter > 0 ){
	            return $this->mensajeResultadoHeader . $this->estiloError . ' Lo siento el flujo ya tiene una etapa con el orden: ' . $orden . $this->mensajeResultadoFooter;
	        }
		}
		
		$queryYaExiste = "select sgd_fexp_codigo as EXISTE FROM sgd_fexp_flujoexpedientes where sgd_fexp_descrip = '" . $this->etapa->getDescripcion() . "'";
		$rs = $this->db->conn->query($queryYaExiste);
		$idYaExiste = $rs->fields['EXISTE'];
		if ($idYaExiste != '' ) {
			return $this->mensajeResultadoHeader . $this->estiloError .' El nombre de etapa ya existe '. $this->mensajeResultadoFooter;
		}
	
		$queryOrden = "select max(sgd_fexp_orden) AS ORDENACTUAL from sgd_fexp_flujoexpedientes where sgd_pexp_codigo = $codProc";

		$rs = $this->db->conn->query($queryOrden);
		$ordenEtapa = $rs->fields['ORDENACTUAL'] + 1;
		
		if($this->etapa->getCodigoProceso() != null){
			$desc = $this->etapa->getDescripcion();
			
			$term = ( $this->etapa->getTerminos() != null ? $this->etapa->getTerminos() : 0 );
            $query = "INSERT INTO sgd_fexp_flujoexpedientes (  sgd_fexp_codigo, sgd_pexp_codigo, ";
            $query .= " sgd_fexp_orden, sgd_fexp_terminos, sgd_fexp_descrip )";
            $query .= " VALUES ( " . $idEtapa . ", " . $this->etapa->getCodigoProceso() . ", ";
            $query .= $ordenEtapa. ", $term,  '$desc' )";
        } else{
                return $this->mensajeResultadoHeader . $this->estiloError .' Objeto Etapa NO tiene codigo proceso '. $this->mensajeResultadoFooter;
        }

        if ( !$rs = $this->db->conn->query( $query ) ){
            return $this->mensajeResultadoHeader . $this->estiloError .' Lo siento no se pudo agregar LA ETAPA '. $this->mensajeResultadoFooter;
        }else{
            return  $this->mensajeResultadoHeader . $this->estiloExito .'ETAPA insertada Correctamente: ' . $idEtapa. $this->mensajeResultadoFooter;
        }
	}
	
	function modificaEtapa( $etapaAModificar ){
		$orden = $this->etapa->getOrden();
		$codProc = $this->etapa->getCodigo;
		$terminos = $this->etapa->getTerminos();
		$descripcion = $this->etapa->getDescripcion();
		if( $orden != null ){
			$actualizaOrden = " sgd_fexp_orden = " . $orden . " , ";
		}else {
			$actualizaOrden = " ";
		}
		
		if( $terminos != null ){
			$actualizaTerminos  = "sgd_fexp_terminos = " . $terminos . " , ";
		}else {
			$actualizaTerminos = " ";
		}
		
		if( $descripcion != null ){
			$actualizaDescripcion  = "sgd_fexp_descrip =  '$descripcion'";
		}else {
			$actualizaDescripcion = " ";
		} 
			
			$queryOrdenET = "update sgd_fexp_flujoexpedientes set $actualizaOrden  $actualizaTerminos  $actualizaDescripcion ";
			$queryOrdenET .= " where  sgd_fexp_codigo = " . $etapaAModificar;
	
			if ( !$rsOrd = $this->db->conn->query( $queryOrdenET ) ){
	            return $this->mensajeResultadoHeader . $this->estiloError .' Lo siento no se pudo modificar la etapa '. $this->mensajeResultadoFooter;
	        }else{
	            return  $this->mensajeResultadoHeader . $this->estiloExito .'Etapa modificada correctamente: ' . $etapaAModificar. $this->mensajeResultadoFooter;
	        }
	}
}


class AristaFlujo{
	var $arista;
	var $db;
var $mensajeResultadoHeader = "<center><table class=borde_tab><tr><td ";
var $mensajeResultadoStyle = "";
var $mensajeResultadoFooter = "</td></tr></table></center>";
var $estiloError = "class=titulosError2>";
var $estiloExito = "class=titulos>";
	
	function AristaFlujo( $db ){
			$this->db = $db;
//			$this->db->conn->debug = true;

	}
	
	function initArista( $etapaInicial, $etapaFinal, $descripcionArista, $diasMinimo, $diasMaximo, $trad,$codserie,$tsub, $tipo, $procesoSelected, $automatico, $tipificacion ){			

		include_once "../class.Arista.php";
		$this->arista = new Arista( $etapaInicial, $etapaFinal, $descripcionArista, $diasMinimo, $diasMaximo, $trad,$codserie,$tsub, $tipo, $procesoSelected, $automatico, $tipificacion );

	}	
	
	
	/**
	 * Funcion que modifica la arista, dependiendo de los datos que se le insertaron a la variable arista
	 *
	 * @return mensaje de error o exito con el resultado de la modificaci&oacute;n de la arista en la base de datos
	 */
	function modificaArista( $aristaAModificar ){
		
		$min = ($this->arista->getDiasMin() != null ? $this->arista->getDiasMin() : 0 );
		$max = ($this->arista->getDiasMax() != null ? $this->arista->getDiasMax() : 0 );
		$tpr = ($this->arista->getCodigoTPR() != null ? $this->arista->getCodigoTPR() : 0 );
		$codserie = ($this->arista->getSerie() != null ? $this->arista->getSerie() : 0 );
		$tsub = ($this->arista->getSubSerie() != null ? $this->arista->getSubSerie() : 0 );
		$tipificacion = $this->arista->getTipificacion();
		$automatico = $this->arista->getAuto();
		$inicio = $this->arista->getInicio();
		$fin = $this->arista->getFin();
		$desc = $this->arista->getDescripcion();
		$rol = $this->arista->getRol();
		$trad = ($this->arista->getTRad() != null ? $this->arista->getTRad() : 0 );

		$queryAristMod = "update sgd_fars_faristas set sgd_fexp_codigoini = " . $inicio . ", sgd_fexp_codigofin = " . $fin;
		$queryAristMod .= ", sgd_fars_diasminimo =  " . $min . ", sgd_fars_diasmaximo = " . $max;
		$queryAristMod .= ", sgd_fars_desc =   '$desc' , sgd_trad_codigo = " . $trad;
		$queryAristMod .= ", sgd_srd_codigo =  " . $codserie . ", sgd_sbrd_codigo = " . $tsub;
		$queryAristMod .= ", sgd_tpr_codigo =  " . $tpr . ", sgd_fars_automatico = " . $automatico;
		$queryAristMod .= ", sgd_fars_rolgeneral =  " . $rol . ", sgd_fars_tipificacion = " . $tipificacion;
		$queryAristMod .= "  where  sgd_fars_codigo = " . $aristaAModificar;
		

        if ( !$rs = $this->db->conn->query( $queryAristMod ) ){
            return  $this->mensajeResultadoHeader . $this->estiloError .' Lo siento no se pudo modificar la Arista '. $this->mensajeResultadoFooter;
        }else{
            return  $this->mensajeResultadoHeader . $this->estiloExito .'Conexi&oacute;n modificada Correctamente: ' . $aristaAModificar . $this->mensajeResultadoFooter;
        }
	}
	
	function insertaArista(  ){
		

		$queryID = "select max(sgd_fars_codigo) AS IDACTUAL from sgd_fars_faristas";
		$rs = $this->db->conn->query( $queryID );
		$idArista = $rs->fields[ 'IDACTUAL' ] + 1;

	if( $this->arista->getDescripcion() != null ){
				$desc = $this->arista->getDescripcion();

		$min = ($this->arista->getDiasMin() != null ? $this->arista->getDiasMin() : 0 );
		$max = ($this->arista->getDiasMax() != null ? $this->arista->getDiasMax() : 0 );
		$tpr = ($this->arista->getCodigoTPR() != null ? $this->arista->getCodigoTPR() : 0 );
		$codserie = ($this->arista->getSerie() != null ? $this->arista->getSerie() : 0 );
		$tsub = ($this->arista->getSubSerie() != null ? $this->arista->getSubSerie() : 0 );
		$tipificacion = $this->arista->getTipificacion();
		$automatico = $this->arista->getAuto();
		
		$trad = ($this->arista->getTRad() != null ? $this->arista->getTRad() : 0 );

        $query = "INSERT INTO sgd_fars_faristas (  sgd_fars_codigo, sgd_pexp_codigo, ";
        $query .= " sgd_fexp_codigoini, sgd_fexp_codigofin, sgd_fars_diasminimo, ";
        $query .= " sgd_fars_diasmaximo, sgd_fars_desc, sgd_trad_codigo, ";
        $query .= " sgd_srd_codigo, sgd_sbrd_codigo, ";
        $query .= " sgd_tpr_codigo, sgd_fars_automatico, sgd_fars_rolgeneral, sgd_fars_tipificacion ) ";
        $query .= " VALUES ( " . $idArista . ", " . $this->arista->getCodigoProceso() . ", ";
        $query .= $this->arista->getInicio() . ", " . $this->arista->getFin() . ", " . $min .", ";
        $query .= $max . ", '$desc', " . $trad . ", ";
        $query .= $codserie . ", " . $tsub . ", " ;
        $query .= $tpr . ", " . $automatico . ", " . $this->arista->getRol() . ", " . $tipificacion . " )";
    } else{
                return  $this->mensajeResultadoHeader . $this->estiloError .'Error: Objeto Arista NO tiene codigo proceso '. $this->mensajeResultadoFooter;
        }

        if ( !$rs = $this->db->conn->query( $query ) ){
            return  $this->mensajeResultadoHeader . $this->estiloError .'Error: Lo siento no se pudo agregar la Arista '. $this->mensajeResultadoFooter;
        }else{
            return  $this->mensajeResultadoHeader . $this->estiloExito .'Arista insertada Correctamente: ' . $idArista . $this->mensajeResultadoFooter;
        }
	}
}
?>
