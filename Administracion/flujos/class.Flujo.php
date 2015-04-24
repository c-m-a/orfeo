<?php

class Flujo{
	
	var $etapas  = array();
	var $aristas = array();
	
	function Flujo() {
		$this->etapas = array();
		$this->descripcionEtapa = '';
		$this->terminosEtapa = 0;
    }
    
    function addEtapa( $nuevaEtapa ){
    	$this->etapas = $nuevaEtapa;
    }
    
    function addArista( $nuevaArist ){
    	$this->aristas = $nuevaArist;
    }
    
    function getEtapas ( ){
    	return $this->etapas;
    }
    
    function getAristas ( ){
    	return $this->aristas;
    }
    
       
    
}
?>
