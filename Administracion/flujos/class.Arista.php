<?php

class Arista{
	
	var $codigoArista = 0;
	var $codigoProcesoArista = 0;
	var $diasMinimo = 0;
	var $diasMaximo = 0;
	var $descripcion = '';
	var $tradArista = 0;
	var $serieArista = 0;
	var $subSerieArista = 0;
	var $tipificacion = 0;
	var $codigoTPR = 0;
	var $automatica = 0;
	var $rolGeneral = '';
	var $etapaInicio ;
	var $etapaFin ;
	var $db;

	
	/**
	 * Constructor por defecto sin parametros
	 *
	 * @return Arista
	 */
	/*
	function Arista() {
		$this->etapaInicio = array();
		$this->etapaFin = array();
		$this->codigoArista = 0;
		$this->codigoProcesoArista = 0;
		$this->diasMinimo = 0;
		$this->diasMaximo = 0;
		$this->descripcion = '';
		$this->tradArista = 0;
		$this->serieArista = 0;
		$this->subSerieArista = 0;
		$this->tipificacion = 0;
		$this->codigoTPR = 0;
		$this->automatica = true;
		$this->rolGeneral = '';
    }*/
    
    function Arista(  $etapaInicial, $etapaFinal, $descripcionArista, $diasMinimo, $diasMaximo, $trad,$codserie,$tsub, $tipo, $procesoSelected, $automatico, $tipificacion ) {
		$this->etapaInicio = $etapaInicial;
		$this->etapaFin = $etapaFinal;
		$this->codigoArista = 0;
		$this->codigoProcesoArista = $procesoSelected;
		$this->diasMinimo = $diasMinimo;
		$this->diasMaximo = $diasMaximo;
		$this->descripcion = $descripcionArista;
		$this->tradArista = $trad;
		$this->serieArista = $codserie;
		$this->subSerieArista = $tsub;
		
		$this->codigoTPR = $tipo;
		
		$this->automatica = ( $automatico ? 1 : 0 );
		$this->tipificacion = ( $tipificacion ? 1 : 0 );
		$this->rolGeneral = 0;
    }
    
    function addInicio( $nuevoInicio ){
    	$this->etapaInicio = $nuevoInicio;
    }
    
    
    
    function addFin( $nuevoFin ){
    	$this->etapaFin = $nuevoFin;
    }
    
    //Setters
    function setInicio( $nuevoInicio ){
    	$this->etapaInicio = $nuevoInicio;
    }
    
    
    
    function setFin( $nuevoFin ){
    	$this->etapaFin = $nuevoFin;
    }
    
    
    
    function setCodigo ( $nuevoCodigo ){
    	$this->codigoArista = $nuevoCodigo;
    }
    
    function setCodigoProceso ( $nuevoCodigoProceso ){
    	$this->codigoProcesoArista = $nuevoCodigoProceso;
    }
    
    function setDiasMin ( $nuevoTermino ){
    	$this->diasMinimo = $nuevoTermino;
    }
    
    function setDiasMax ( $nuevoTermino ){
    	$this->diasMaximo = $nuevoTermino;
    }
    
    function setDescripcion ( $nuevaDescripcion ){
    	$this->descripcion = $nuevaDescripcion;
    }
    
    function setTRad ( $nuevaTrad ){
    	$this->tradArista = $nuevaTrad;
    }
    
    function setSerie ( $nuevaSerie ){
    	$this->serieArista = $nuevaSerie;
    }
    
    function setSubSerie ( $nuevaSubSerie ){
    	$this->subSerieArista = $nuevaSubSerie;
    }
    
    function setTipificacion ( $nuevaTipificacion ){
    	$this->tipificacion = $nuevaTipificacion;
    }
    
    function setCodigoTPR ( $nuevoCodigo ){
    	$this->codigoTPR = $nuevoCodigo;
    }
    
    function setAuto ( $auto ){
    	$this->automatica = $auto;
    }
    
    function setRol ( $nuevoRol ){
    	$this->rolGeneral = $nuevoRol;
    }
    
    
    //Getters
     function getCodigo (  ){
    	return $this->codigoArista;
    }
    
    function getCodigoProceso (  ){
    	return $this->codigoProcesoArista;
    }
    
    function getDiasMin (  ){
    	return $this->diasMinimo;
    }
    
    function getDiasMax (  ){
    	return $this->diasMaximo;
    }
    
    function getDescripcion (  ){
    	return $this->descripcion;
    }
    
    function getTRad (  ){
    	return $this->tradArista;
    }
    
    function getSerie (  ){
    	return $this->serieArista;
    }
    
    function getSubSerie (  ){
    	return $this->subSerieArista;
    }
    
    function getTipificacion (  ){
    	return $this->tipificacion;
    }
    
    function getCodigoTPR (  ){
    	return $this->codigoTPR;
    }
    
    function getAuto (  ){
    	return $this->automatica;
    }
    
    function getRol (  ){
    	return $this->rolGeneral;
    }
    
    function getInicio( ){
    	return $this->etapaInicio;
    }
        
    function getFin(  ){
    	return $this->etapaFin;
    }
}
?>
