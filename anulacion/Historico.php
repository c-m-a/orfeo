<?
class Historico
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/
	 /**
   * Clase que maneja los Historicos de los documentos
   *
   * @param int Dependencia Dependencia de Territorial que Anula 
   * @db Objeto conexion
   * @access public
   */
 var $db;
 function Historico($db)
 {
    /**
  * Constructor de la clase Historico
	* @db variable en la cual se recibe el cursor sobre el cual se esta trabajando.
	* 
	*/
		$this->db = $db;
 }
  function consultaHistoricos( $dependencia )
  {
    
  } // end of member function consultaHistoricos

  /**
   * 
   *
   * @radicados      Arreglo de radicados
   * @depeOrigen int Dependencia que realiza la transaccion
   * @depeDest int   Dependencia destino
	 * @usDocOrigen    Documento del usuario que realiza la transacción
	 * @usDocDest      Documento del usuario destino
	 * @tipoTx         Tipo de Transacción
   * @return void 
   * 
   */
  function insertarHistorico($radicados,  $depeOrigen, $depeDest, $usDocOrigen , $usDocDest, $usCodOrigen, $usCodDest, $observacion, $tipoTx)
  {
		//Arreglo que almacena los nombres de columna
		#==========================
		foreach($radicados as $noRadicado)
		{
			# Codigo para probar un insert
			
			$sql = "SELECT * FROM HIST_EVENTOS WHERE RADI_NUME_RADI = -1"; 
			# Selecciona un registro en blanco de la base de datos
			
			$rs = $this->db->conn->Execute($sql); # Ejecuta la busqueda y obtiene el recordset vacio
			
			$record = array(); # Inicializa el arreglo que contiene los datos a insertar
			
			# Asignar el valor de los campos en el registro
			# Observa que el nombre de los campos pueden ser mayusculas o minusculas
			$record["RADI_NUME_RADI"] = $noRadicado;
			$record["DEPE_CODI"] = $depeOrigen;
			$record["USUA_CODI"] = $usCodOrigen;
			$record["USUA_CODI_DEST"] = $usCodDest;
			$record["DEPE_CODI_DEST"] = $depeDest;
			$record["USUA_DOC"] = $usDocOrigen;
			$record["USUA_DOC_DEST"] = $usDocDest;
			$record["SGD_TTR_CODIGO"] = $tipoTx;
			$record["HIST_OBSE"] = $observacion;
			$record["HIST_FECH"] = $this->db->conn->OffsetDate(0);
			# Mandar como parametro el recordset vacio y el arreglo conteniendo los datos a insertar
			# a la funcion GetInsertSQL. Esta procesara los datos y regresara un enunciado SQL
			# para procesar el INSERT.
			$insertSQL = $this->db->conn->GetInsertSQL($rs, $record, "true");
			$systemDate = $db->conn->sysTimeStamp;
			$insertSQL = str_replace($dateReplace, "$systemDate",$insertSQL);
			$this->db->conn->Execute($insertSQL); # Inserta el registro en la base de datos
			
		}
		$this->db->conn->Close();
		return ($radicados);
  } // end of member function insertarHistorico





} // end of Historico
?>
