<?php
/**
  * Clase para interactuar con los metadatos de la base de datos del Sistema de Gestión Documental Orfeo/GPL.
  * @author Infométrika Ltda.
  * @since 26-Agosto-2009
  */
class MetadataBD {

	private $db;

	/**
	  * Constructor de la clase.
	  * @param conn Objeto de conexión a la base de datos.
	  */
	function MetadataBD( $db ){
		$this->db = $db;
	}
	
	/**
	  * Obtener los metadatos de una tabla específica.
	  * @param nombreTabla Nombre de la tabla de la que se van a obtener los metadatos.
	  * @return array Metadatos de la tabla.
	  */
	function getMetadataTabla( $nombreTabla ){
	
		switch ( $this->db->conn->driver ){
			case 'postgres':
				$sqlMetadata = "SELECT a.attname as column_name, t.typname as data_type,
								CASE
								WHEN cc.contype='p' THEN 'PRI'
								WHEN cc.contype='u' THEN 'UNI'
								WHEN cc.contype='f' THEN 'FK'
								ELSE '' END AS key,
								CASE WHEN a.attnotnull=false THEN 'YES' ELSE 'NO' END AS is_nullable,
								CASE WHEN a.attlen='-1' THEN (a.atttypmod - 4) ELSE a.attlen END as max_length,
								d.adsrc as column_default
								FROM pg_catalog.pg_attribute a
								LEFT JOIN pg_catalog.pg_type t ON t.oid = a.atttypid
								LEFT JOIN pg_catalog.pg_class c ON c.oid = a.attrelid
								LEFT JOIN pg_catalog.pg_constraint cc ON cc.conrelid = c.oid AND cc.conkey[1] = a.attnum
								LEFT JOIN pg_catalog.pg_attrdef d ON d.adrelid = c.oid AND a.attnum = d.adnum
								WHERE c.relname = '".$nombreTabla."'
								AND a.attnum > 0
								AND t.oid = a.atttypid
								";
				break;
		}
	}
	
	/**
	  * Obtener los metadatos de uno o más campos específicos.
	  * @param nombreTabla Nombre de la tabla a la que pertenece(n) el (los) campo(s).
	  * @param nombreCampo Nombre del (de los) campo()s del (de los) que se va(n) a obtener los metadatos.
	  *	Debe ser una cadena de caracteres separada por coma (,);
	  * @return array Metadatos del campo.
	  */
	function getMetadataCampo( $nombreTabla, $nombreCampo ){

		switch ( $this->db->driver ){
			case 'postgres':
				$sqlMetadataCampo = "SELECT a.attname as COLUMN_NAME, t.typname as DATA_TYPE,
								CASE
								WHEN cc.contype='p' THEN 'PRI'
								WHEN cc.contype='u' THEN 'UNI'
								WHEN cc.contype='f' THEN 'FK'
								ELSE '' END AS KEY,
								CASE WHEN a.attnotnull=false THEN 'YES' ELSE 'NO' END AS IS_NULLABLE,
								CASE WHEN a.attlen='-1' THEN (a.atttypmod - 4) ELSE a.attlen END as MAX_LENGTH,
								d.adsrc as COLUMN_DEFAULT
								FROM pg_catalog.pg_attribute a
								LEFT JOIN pg_catalog.pg_type t ON t.oid = a.atttypid
								LEFT JOIN pg_catalog.pg_class c ON c.oid = a.attrelid
								LEFT JOIN pg_catalog.pg_constraint cc ON cc.conrelid = c.oid AND cc.conkey[1] = a.attnum
								LEFT JOIN pg_catalog.pg_attrdef d ON d.adrelid = c.oid AND a.attnum = d.adnum
								WHERE c.relname = '".$nombreTabla."'
								AND a.attname IN ( ".$nombreCampo." )
								AND a.attnum > 0
								AND t.oid = a.atttypid
								";
				break;
		}
		
		$rsMetadataCampo = $this->db->conn->Execute( $sqlMetadataCampo );
		$indice = 0;
		while( !$rsMetadataCampo->EOF ){	
			$arrMetadataCampo[ $indice ][ 'COLUMN_NAME' ] = $rsMetadataCampo->fields[ 'COLUMN_NAME' ];
			$arrMetadataCampo[ $indice ][ 'DATA_TYPE' ] = $rsMetadataCampo->fields[ 'DATA_TYPE' ];
			$arrMetadataCampo[ $indice ][ 'KEY' ] = $rsMetadataCampo->fields[ 'KEY' ];
			$arrMetadataCampo[ $indice ][ 'IS_NULLABLE' ] = $rsMetadataCampo->fields[ 'IS_NULLABLE' ];
			$arrMetadataCampo[ $indice ][ 'MAX_LENGTH' ] = $rsMetadataCampo->fields[ 'MAX_LENGTH' ];
			$arrMetadataCampo[ $indice ][ 'COLUMN_DEFAULT' ] = $rsMetadataCampo->fields[ 'COLUMN_DEFAULT' ];
			
			$indice++;
			$rsMetadataCampo->MoveNext();
		}
		
		return $arrMetadataCampo;
	}
}
?>