<?php

class Etapa{
	
	var $ordenEtapa;
	var $descripcionEtapa;
	var $terminosEtapa;
	var $codigoProcesoEtapa;
	var $grafico;
	
	/**
	 * Constructor con parámetros
	 *
	 * @param Number $nuevoOrden
	 * @param String $nuevaDescripcion
	 * @param Number $nuevoTermino
	 * @param Number $nuevoCodigoProceso
	 * @return Etapa
	 */
	function Etapa ($nuevoOrden,$nuevaDescripcion, $nuevoTermino, $nuevoCodigoProceso ) {
		
		$this->ordenEtapa = $nuevoOrden;
		$this->descripcionEtapa = $nuevaDescripcion;
		$this->terminosEtapa = $nuevoTermino;
		$this->codigoProcesoEtapa = $nuevoCodigoProceso;
    }
    
    /**
     * Constructor por defecto sin parámetros
     *
     * @return Etapa
     */
    /*
    function Etapa(){
    	
    }
    */
    
    //Setters
    function setOrden( $nuevoOrden ){
    	$this->ordenEtapa = $nuevoOrden;
    }
    
    function setGrafico( $nuevoGrafico ){
    	$this->grafico = $nuevoGrafico;
    }
    
    function setDescripcion( $nuevaDescripcion ){
    	$this->descripcionEtapa = $nuevaDescripcion;
    }
    
    function setTerminos( $nuevoTermino ){
    	$this->terminosEtapa = $nuevoTermino;
    }
    
    function setCodigoProceso( $nuevoCodigoProceso ){
    	$this->codigoProcesoEtapa = $nuevoCodigoProceso;
    }
    
    //Getters
    function getOrden(  ){
    	return $this->ordenEtapa;
    }
    
    function getDescripcion(  ){
    	return $this->descripcionEtapa;
    }
    
    function getTerminos(  ){
    	return $this->terminosEtapa;
    }
    
    function getCodigoProceso(  ){
    	return $this->codigoProcesoEtapa;
    }
    
    function getGrafico(  ){
    	return $this->grafico;
    }
}
?>