<?php
class Historico {
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
	 * @usDocOrigen    Documento del usuario que realiza la transacci�
	 * @usDocDest      Documento del usuario destino
	 * @tipoTx         Tipo de Transacci�
   * @return void
   *
   */
  function insertarHistorico($radicados,  $depeOrigen , $usCodOrigen, $depeDestino,$usCodDestino, $observacion, $tipoTx) {
		//Arreglo que almacena los nombres de columna

		# Busca el Documento del usuario Origen
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$this->db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$sql = "SELECT
					 USUA_DOC
					,USUA_LOGIN
				FROM
					USUARIO
				WHERE
					DEPE_CODI=$depeOrigen
					AND USUA_CODI=$usCodOrigen";
		# Busca el usuairo Origen para luego traer sus datos.
		$rs = $this->db->conn->Execute($sql);
		$usDocOrigen = $rs->fields["USUA_DOC"];
		$usuAnte  = $rs->fields["USUA_LOGIN"];
		# Busca No Documento Usuario Destino
		$sql = "SELECT
					USUA_DOC
					,USUA_LOGIN
				FROM
					USUARIO
				WHERE
					DEPE_CODI=$depeDestino
					AND USUA_CODI=$usCodDestino";
		$rs = $this->db->conn->Execute($sql);
		$usDocDestino = $rs->fields["USUA_DOC"];
		$usuActu  = $rs->fields["USUA_LOGIN"];

		$record = array(); // Inicializa el arreglo que contiene los datos a insertar
		if ($radicados) {
		foreach($radicados as $noRadicado)
		{	# Asignar el valor de los campos en el registro
			# Observa que el nombre de los campos pueden ser mayusculas o minusculas
			if(!$usDocDestino) $usDocDestino = "0";
			$record["RADI_NUME_RADI"] = $noRadicado;
			$record["DEPE_CODI"] = $depeOrigen;
			$record["USUA_CODI"] = $usCodOrigen;
			$record["USUA_CODI_DEST"] = $usCodDestino;
			$record["DEPE_CODI_DEST"] = $depeDestino;
			$record["USUA_DOC"] = $usDocOrigen;
			$record["HIST_DOC_DEST"] = $usDocDestino;
			$record["SGD_TTR_CODIGO"] = $tipoTx;
			$record["HIST_OBSE"] = "'$observacion'";
			$record["HIST_FECH"] = $this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp);
			# Mandar como parametro el recordset vacio y el arreglo conteniendo los datos a insertar
			# a la funcion GetInsertSQL. Esta procesara los datos y regresara un enunciado SQL
			# para procesar el INSERT.
			$insertSQL = $this->db->insert("HIST_EVENTOS", $record, "true");

		}
		return ($radicados);
	}
  } // end of member function insertarHistorico

function insertarHistoricoArch($id,$radicados,  $depeOrigen , $usCodOrigen, $observacion, $tipoTx)
  {
		//Arreglo que almacena los nombres de columna
		#==========================

		# Busca el Documento del usuario Origen
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$this->db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$sql = "SELECT
					 USUA_DOC
				FROM
					USUARIO
				WHERE
					DEPE_CODI=$depeOrigen
					AND USUA_CODI=$usCodOrigen";
		# Busca el usuairo Origen para luego traer sus datos.
		$rs = $this->db->conn->Execute($sql);
		$usDocOrigen = $rs->fields["USUA_DOC"];
		$record = array(); # Inicializa el arreglo que contiene los datos a insertar
		if ($radicados) {
		foreach($radicados as $noRadicado)
		{	# Asignar el valor de los campos en el registro
			# Observa que el nombre de los campos pueden ser mayusculas o minusculas
			if(!$usDocDestino) $usDocDestino = "0";
			$record["SGD_ARCHIVO_RAD"] = "'$noRadicado'";
			$record["DEPE_CODI"] = $depeOrigen;
			$record["USUA_CODI"] = $usCodOrigen;
			$record["USUA_DOC"] = $usDocOrigen;
			$record["SGD_TTR_CODIGO"] = $tipoTx;
			$record["HIST_OBSE"] = "'$observacion'";
			$record["HIST_FECH"] = $this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp);
			$record["HIST_ID"] = $id;
			# Mandar como parametro el recordset vacio y el arreglo conteniendo los datos a insertar
			# a la funcion GetInsertSQL. Esta procesara los datos y regresara un enunciado SQL
			# para procesar el INSERT.
			$insertSQL = $this->db->insert("SGD_ARCHIVO_HIST", $record, "true");

		}
		return ($radicados);
	}
  } // end of member function insertarHistorico
 /**
   * FUNCION QUE INSERTA HISTORICO DE EXPEDIENTES
   *
   * @radicados   array Arreglo de radicados
   * @dependencia	int   Dependencia que realiza la transaccion
   * @depeDest    int   Dependencia destino
	 * @codUsuario  int   Documento del usuario que realiza la transaccion
	 * @tipoTx      int   Tipo de Transaccion
   * @return void
   *
   */
  function insertarHistoricoExp($numeroExpediente,$radicados, $dependencia,$codUsuario, $observacion, $tipoTx,$codigoFldExp)
  {
		//Arreglo que almacena los nombres de columna
		// Busca el Documento del usuario Origen
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$this->db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$sql = "SELECT USUA_DOC,
                  USUA_LOGIN
              FROM USUARIO
              WHERE DEPE_CODI = $dependencia
                AND USUA_CODI = $codUsuario";
		# Busca el usuairo Origen para luego traer sus datos.
		$rs = $this->db->conn->Execute($sql);
		$usDoc = $rs->fields["USUA_DOC"];
		$usuLogin  = $rs->fields["USUA_LOGIN"];

		$record = array(); # Inicializa el arreglo que contiene los datos a insertar
		if ($radicados) {
		foreach($radicados as $noRadicado) {
			# Asignar el valor de los campos en el registro
			# Observa que el nombre de los campos pueden ser mayusculas o minusculas

			$record["SGD_EXP_NUMERO"] = "'".$numeroExpediente."'";
			$record["SGD_FEXP_CODIGO"] = $codigoFldExp;
			$record["RADI_NUME_RADI"] = $noRadicado;
			$record["DEPE_CODI"] = $dependencia;
			$record["USUA_CODI"] = $codUsuario;
			$record["USUA_DOC"] = $usDoc;
			$record["SGD_TTR_CODIGO"] = $tipoTx;
			$record["SGD_HFLD_OBSERVA"] = "'$observacion'";
			$record["SGD_HFLD_FECH"] = $this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp);
			
      if($codigoArista)
				$record["SGD_FARS_CODIGO"] = $codigoArista;
			
			# Mandar como parametro el recordset vacio y el arreglo conteniendo los datos a insertar
			# a la funcion GetInsertSQL. Esta procesara los datos y regresara un enunciado SQL
			# para procesar el INSERT.
			$insertSQL = $this->db->insert("SGD_HFLD_HISTFLUJODOC", $record, "true");

		}
		return ($radicados);
	}
  } // end of member function insertarHistorico
} // end of Historico
?>
