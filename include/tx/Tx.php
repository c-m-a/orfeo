<?php
include_once($ruta_raiz."/include/tx/Historico.php");
class Tx extends Historico {
  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/
	 /**
   * Clase que maneja los Historicos de los documentos
   *
   * @param int     Dependencia Dependencia de Territorial que Anula
   * @param number  usuaDocB    Documento de Usuario
   * @param number  depeCodiB   Dependencia de Usuario Buscado
   * @param varchar usuaNombB   Nombre de Usuario Buscado
   * @param varcahr usuaLogin   Login de Usuario Buscado
   * @param number	usNivelB	Nivel de un Ususairo Buscado..
   * @db 	Objeto  conexion
   * @access public
   */
 var  $db;
 function Tx($db)
 {
    /**
  * Constructor de la clase Historico
	* @db variable en la cual se recibe el cursor sobre el cual se esta trabajando.
	*
	*/
	$this->db = $db;
 }
 /**
  * Metodo que trae los datos principales de un usuario a partir del codigo y la dependencia
  *
  * @param number $codUsuario
  * @param number $depeCodi
  *
  */
 function datosUs($codUsuario,$depeCodi)
 {
 		$sql = "SELECT
				USUA_DOC
				,USUA_LOGIN
				,CODI_NIVEL
				,USUA_NOMB
			FROM
				USUARIO
			WHERE
				DEPE_CODI=$depeCodi
				AND USUA_CODI=$codUsuario";
	# Busca el usuairo Origen para luego traer sus datos.

	$rs = $this->db->query($sql);
	//$usNivel = $rs->fields["CODI_NIVEL"];
	//$nombreUsuario = $rs->fields["USUA_NOMB"];
	$this->usNivelB = $rs->fields['CODI_NIVEL'];
	$this->usuaNombB = $rs->fields['USUA_NOMB'];
	$this->usuaDocB = $rs->fields['USUA_DOC'];
 }

// MODIFICADO PARA GENERAR ALERTAS
// JUNIO DE 2009
function getRadicados($tipo, $usua_cod){
	 $con=$this->db->driver;
	switch($con){
	case'oci8':
	$query="SELECT $tipo FROM SGD_NOVEDAD_USUARIO WHERE USUA_DOC=$usua_cod";
	break;
	case 'postgres':
	  
	  $campo1 .='"';
	  $campo1 .= $tipo;
	  $campo1 .='"';
	  $campo2 = '"USUA_DOC"';
	 $query= "SELECT $campo1 FROM SGD_NOVEDAD_USUARIO WHERE $campo2='$usua_cod'";
	break;
	}
 	$rs=$this->db->query($query);
 	if($rs){ 		
 		return $rs->fields["$tipo"]; 
 				
 	}
 	
}

// MODIFICADO PARA GENERAR ALERTAS
// JUNIO  DE 2009 
function registrarNovedad($tipo, $docUsuarioDest, $numRad, $ruta_raiz=""){
	// busco la información de radicados informados pendientes de alerta
	// Busco info del campo NOV_INFOR de la tabla SGD_NOVEDAD_USUARIO	
	/**include("$ruta_raiz/class_control/Param_admin.php"); 
	$param=Param_admin::getObject($this->db,'%','ALERT_FUNCTION');

	if($param->PARAM_VALOR=="1"){ 
		
		$rads=$this->getRadicados($tipo, $docUsuarioDest);
		
		if($rads!=""){
			$rads.=",";
		}
		$rads.=$numRad;
		
		$con=$this->db->driver;
		
		switch($con){
		case'oci8':
		$xarray['USUA_DOC']=$docUsuarioDest;
		$xarray["$tipo"]=$rads;
		
		$tipo1=$tipo;
		$valor=$xarray["$tipo"];
			
		$qs="Select count(*) as contador from SGD_NOVEDAD_USUARIO where USUA_DOC=$docUsuarioDest";
		$rs=$this->db->conn->query($qs);
	        
		if($rs->fields['CONTADOR'] == 0){
					$qu="INSERT INTO SGD_NOVEDAD_USUARIO (USUA_DOC,$tipo1) values ($docUsuarioDest,$valor)";
					$this->db->conn->query($qu);
			
			}else{
					$this->db->conn->query("UPDATE SGD_NOVEDAD_USUARIO SET $tipo1 = $valor where USUA_DOC'$docUsuarioDest'");				
				}
		
		break;
		
		case 'postgres':
		
		$xarray['USUA_DOC'].='"';
		$xarray['USUA_DOC'].=$docUsuarioDest;
		$xarray['USUA_DOC'].='"';
		
		$tipo1='"';
		$tipo1.=$tipo;
		$tipo1.='"';
		
		$xarray["$tipo"].="'";
		$xarray["$tipo"].=$rads;
		$xarray["$tipo"].="'";
		
		$valor=$xarray["$tipo"];
			
		$campo = '"USUA_DOC"';
		$qs="Select count(*) as contador from SGD_NOVEDAD_USUARIO where $campo='$docUsuarioDest'";
		$rs=$this->db->conn->query($qs);
	        
		if($rs->fields['CONTADOR'] == 0){ 
					$qu="INSERT INTO SGD_NOVEDAD_USUARIO ($campo,$tipo1) values ('$docUsuarioDest',$valor)";
					$this->db->conn->query($qu);
			
			}else{
					$this->db->conn->query("UPDATE SGD_NOVEDAD_USUARIO SET $tipo1 = $valor where $campo='$docUsuarioDest'");				
				}

		break;
		}
		
		
					
	}**/
}

function informar( $radicados, $loginOrigen,$depDestino,$depOrigen,$codUsDestino, $codUsOrigen,$observa,$idenviador = null, $ruta_raiz="")
{
	$whereNivel = "";

	$this->db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$sql = "SELECT
				USUA_DOC
				,USUA_LOGIN
				,CODI_NIVEL
				,USUA_NOMB
			FROM
				USUARIO
			WHERE
				DEPE_CODI=$depDestino
				AND USUA_CODI=$codUsDestino";
	# Busca el usuairo Origen para luego traer sus datos.
	$rs = $this->db->query($sql); # Ejecuta la busqueda
	$usNivel = $rs->fields["CODI_NIVEL"];
	$usLoginDestino = $rs->fields["USUA_LOGIN"];
	$nombreUsuario = $rs->fields["USUA_NOMB"];
	$docUsuarioDest = $rs->fields["USUA_DOC"];
	$codTx = 8;
	if($tomarNivel=="si")
	{
		$whereNivel = ",CODI_NIVEL=$usNivel";
	}
	$codTx = 8;
	$observa = "A: $usLoginDestino - $observa";
	if(!$observacion) $observacion = $observa;

	$tmp_rad = array();
	$informaSql = true;
	while ((list(,$noRadicado)=each($radicados)) and $informaSql) {
    $tmp = (strstr($noRadicado,'-'))? explode('-',$noRadicado) : $noRadicado;
		$record["RADI_NUME_RADI"] = (is_array($tmp))? $tmp[1] : $noRadicado;
		# Asignar el valor de los campos en el registro
		# Observa que el nombre de los campos pueden ser mayusculas o minusculas
		//insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk3,'$observa')
		//$record["RADI_NUME_RADI"] = $noRadicado;
		$record["DEPE_CODI"] = $depDestino;
		$record["USUA_CODI"] = $codUsDestino;
		$record["INFO_CODI"] = $idenviador;
		$record["INFO_DESC"] = "'$observacion '";
		$record["USUA_DOC"] = "'$docUsuarioDest'";
		$record["INFO_FECH"] = $this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp);

		# Mandar como parametro el recordset vacio y el arreglo conteniendo los datos a insertar
		# a la funcion GetInsertSQL. Esta procesara los datos y regresara un enunciado SQL
		# para procesar el INSERT.
		$informaSql = $this->db->conn->Replace("INFORMADOS",$record,array('RADI_NUME_RADI','INFO_CODI','USUA_DOC'),false);
		
		// MODIFICADO PARA GENERAR ALERTAS
		// JUNIO DE 2009
		$this->registrarNovedad('NOV_INFOR', $docUsuarioDest, $record["RADI_NUME_RADI"], $ruta_raiz);	
		//Modificado idrd 
		if ($informaSql)        $tmp_rad[] = $record["RADI_NUME_RADI"];
        }
                $this->insertarHistorico($tmp_rad,$depOrigen,$codUsOrigen,$depDestino,$codUsDestino, $observa,$codTx);
		return $nombreUsuario;	
}

function borrarInformado( $radicados, $loginOrigen,$depDestino,$depOrigen,$codUsDestino, $codUsOrigen,$observa)
{	$tmp_rad = array();
	$deleteSQL = true;
	while ((list(,$noRadicado)=each($radicados)) and $deleteSQL) {
    //foreach($radicados as $noRadicado)
		// Borrar el informado seleccionado
		$tmp = explode('-',$noRadicado);
		($tmp[0]) ? $wtmp = ' and INFO_CODI = '.$tmp[0] : $wtmp = ' and INFO_CODI IS NULL ';
		$record["RADI_NUME_RADI"] = $tmp[1];
		$record["USUA_CODI"] = $codUsOrigen;
		$record["DEPE_CODI"] = $depOrigen;
		$deleteSQL = $this->db->conn->Execute("DELETE FROM INFORMADOS WHERE RADI_NUME_RADI=".$tmp[1]." and USUA_CODI=".$codUsOrigen." and DEPE_CODI=".$depOrigen.$wtmp);
		if ($deleteSQL)	$tmp_rad[] = $record["RADI_NUME_RADI"];
	}
	$codTx = 7;
	if ($deleteSQL)
	{	$this->insertarHistorico($tmp_rad,$depOrigen,$codUsOrigen,$depOrigen,$codUsOrigen, $observa,$codTx,$observa);
		return $tmp_rad;
	}
	else return $deleteSQL;
}


  function cambioCarpeta( $radicados, $usuaLogin,$carpetaDestino,$carpetaTipo,$tomarNivel,$observa)
  {
 		$whereNivel = "";
		$sql = "SELECT
					b.USUA_DOC
					,b.USUA_LOGIN
					,b.CODI_NIVEL
					,b.DEPE_CODI
					,b.USUA_CODI
					,b.USUA_NOMB
				FROM
					 USUARIO b
				WHERE
					b.USUA_LOGIN = '$usuaLogin'";
		# Busca el usuairo Origen para luego traer sus datos.
		$rs = $this->db->query($sql); # Ejecuta la busqueda
		$usNivel = $rs->fields[2];
		$depOrigen = $rs->fields[3];
		$codUsOrigen = $rs->fields[4];
		$nombOringen = $rs->fields[5];
		if($tomarNivel=="si")
		{
			$whereNivel = ",CODI_NIVEL=$usNivel";
		}
		$codTx = "10";

		$radicadosIn = join(",",$radicados);
		$sql = "update radicado
					set
					  CARP_CODI=$carpetaDestino
					  ,CARP_PER=$carpetaTipo
					  ,radi_fech_agend=null
					  ,radi_agend=null
					  $whereNivel
				 where RADI_NUME_RADI in($radicadosIn)";

		//$this->conn->Execute($isql);
		$rs = $this->db->query($sql); # Ejecuta la busqueda
		$retorna = 1;
		if(!$rs)
		{
			echo "<center><font color=red>Error en el Movimiento ... A ocurrido un error y no se ha podido realizar la Transaccion</font> <!-- $sql -->";
			$retorna = -1;
		}
		if($retorna!=-1)
		{

			$this->insertarHistorico($radicados,$depOrigen,$codUsOrigen,$depOrigen,$codUsOrigen, $observa,$codTx);
		}
		return $retorna;
  }

  function reasignar( $radicados, $loginOrigen,$depDestino,$depOrigen,$codUsDestino, $codUsOrigen,$tomarNivel, $observa,$codTx,$carp_codi) {
	  $whereNivel = "";

    $this->db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

    $sql = "SELECT USUA_DOC,
                    USUA_LOGIN,
                    CODI_NIVEL,
                    USUA_NOMB
              FROM USUARIO
              WHERE DEPE_CODI = $depDestino
                AND USUA_CODI = $codUsDestino";
    // Busca el usuairo Origen para luego traer sus datos.
    $rs = $this->db->conn->query($sql);
    //$usNivel = $rs->fields["CODI_NIVEL"];
    //$nombreUsuario = $rs->fields["USUA_NOMB"];
    $usNivel = $rs->fields['CODI_NIVEL'];
    $nombreUsuario = $rs->fields['USUA_NOMB'];
    $docUsuaDest = $rs->fields['USUA_DOC'];
    
    if ($tomarNivel=="si")
      $wherNivel = ",CODI_NIVEL=$usNivel";

    $radicadosIn = join(",",$radicados);
    $proccarp= 'Reasignar';
    $carp_per = 0;
    $isql = "update radicado
          set
            RADI_USU_ANTE='$loginOrigen'
            ,RADI_DEPE_ACTU=$depDestino
            ,RADI_USUA_ACTU=$codUsDestino
            ,CARP_CODI=$carp_codi
            ,CARP_PER=$carp_per
            ,RADI_LEIDO=0
            , radi_fech_agend=null
            ,radi_agend=null
            $whereNivel
         where radi_depe_actu=$depOrigen
             AND radi_usua_actu=$codUsOrigen
             AND RADI_NUME_RADI in($radicadosIn)";
    
    $res = $this->db->conn->Execute($isql); // Ejecuta la busqueda
    $this->insertarHistorico($radicados,
                              $depOrigen,
                              $codUsOrigen,
                              $depDestino,
                              $codUsDestino,
                              $observa,
                              $codTx);
    return $nombreUsuario;
  }
  
//Modificado por Fabian Mauricio Losada
  function archivar( $radicados, $loginOrigen,$depOrigen,$codUsOrigen,$observa) {
  	$whereNivel = '';
		$radicadosIn = join(",",$radicados);
		$carp_codi=substr($depOrigen,0,2);
		$carp_per = 0;
		$carp_codi = 0;
		$isql = "update radicado
					set
					  RADI_USU_ANTE='$loginOrigen'
					  ,RADI_DEPE_ACTU=999
					  ,RADI_USUA_ACTU=1
					  ,CARP_CODI=$carp_codi
					  ,CARP_PER=$carp_per
					  ,RADI_LEIDO=0
					  ,radi_fech_agend=null
					  ,radi_agend=null
					  ,CODI_NIVEL=1
					  ,SGD_SPUB_CODIGO=0
				 where radi_depe_actu=$depOrigen
				 	   AND radi_usua_actu=$codUsOrigen
					   AND RADI_NUME_RADI in($radicadosIn)";
		//$this->conn->Execute($isql);
		$this->db->conn->Execute($isql); # Ejecuta la busqueda
		$this->insertarHistorico($radicados,  $depOrigen , $codUsOrigen, 999, 1, $observa, 13);
		return $isql;
  }

  // Hecho por Fabian Mauricio Losada
  function nrr( $radicados, $loginOrigen,$depOrigen,$codUsOrigen,$observa) {
  	$whereNivel = "";
		$radicadosIn = join(",",$radicados);
		$carp_codi=substr($depOrigen,0,2);
		$carp_per = 0;
		$carp_codi = 0;
		$isql = "update radicado
					set
					  RADI_USU_ANTE='$loginOrigen'
					  ,RADI_DEPE_ACTU=999
					  ,RADI_USUA_ACTU=1
					  ,CARP_CODI=$carp_codi
					  ,CARP_PER=$carp_per
					  ,RADI_LEIDO=0
					  ,radi_fech_agend=null
					  ,radi_agend=null
					  ,CODI_NIVEL=1
					  ,SGD_SPUB_CODIGO=0
					  ,RADI_NRR=1
				 where radi_depe_actu=$depOrigen
				 	   AND radi_usua_actu=$codUsOrigen
					   AND RADI_NUME_RADI in($radicadosIn)";
		//$this->conn->Execute($isql);
		$this->db->conn->Execute($isql); # Ejecuta la busqueda
				
		$this->insertarHistorico($radicados,  $depOrigen , $codUsOrigen, 999, 1, $observa, 65);
		return $isql;
  }
  /**
   * Nueva Funcion para agendar.
   * Este metodo permite programar un radicado para una fecha especifica, el arreglo con la version anterior
   * , es que no se borra el agendado cuando el radicado sale del usuario actual.
   *
   * @author JAIRO LOSADA JUNIO 2006
   * @version 3.5.1
   *
   * @param array int $radicados
   * @param varchar $loginOrigen
   * @param numeric $depOrigen
   * @param numeric $codUsOrigen
   * @param varchar $observa
   * @param date $fechaAgend
   * @return boolean
   */
  function agendar($radicados, $loginOrigen,$depOrigen,$codUsOrigen,$observa, $fechaAgend)
  {
	$whereNivel = "";
	$radicadosIn = join(",",$radicados);
	$carp_codi=substr($depOrigen,0,2);
	$carp_per = 1;
	$sqlFechaAgenda=$this->db->conn->DBDate($fechaAgend);
	$this->datosUs($codUsOrigen,$depOrigen);
	$usuaDocAgen = $this->usuaDocB;
	foreach($radicados as $noRadicado)
	{
	# Busca el usuairo Origen para luego traer sus datos.
		$rad=array();
		$observa = "Agendado para el $fechaAgend - " . $observa;
		if($usuaDocAgen)
		{
			$record["RADI_NUME_RADI"] = $noRadicado;
			$record["DEPE_CODI"] = $depOrigen;
			$record["SGD_AGEN_OBSERVACION"] = "'$observa '";
			$record["USUA_DOC"] = "'$usuaDocAgen'";
			$record["SGD_AGEN_FECH"] = $this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp);
			$record["SGD_AGEN_FECHPLAZO"] =$sqlFechaAgenda;
			$record["SGD_AGEN_ACTIVO"] =1;
			$insertSQL = $this->db->insert("SGD_AGEN_AGENDADOS", $record, "true");

			$this->insertarHistorico($radicados,$depOrigen,$codUsOrigen,$depOrigen,$codUsOrigen, $observa, 14);
		}
	}



		//$this->conn->Execute($isql);
		return $isql;
  }
  /**
   * Metodo que sirve para sacar uno o varios radicados de agendado
   *
   * @param array $radicados
   * @param unknown_type $loginOrigen
   * @param unknown_type $depOrigen
   * @param unknown_type $codUsOrigen
   * @param unknown_type $observa
   * @return unknown
   */
  function noAgendar( $radicados, $loginOrigen,$depOrigen,$codUsOrigen,$observa)
  {
  		$this->datosUs($codUsOrigen,$depOrigen);
		$usuaDocAgen = $this->usuaDocB;
  		$whereNivel = "";
		$radicadosIn = join(",",$radicados);
		$carp_codi=substr($depOrigen,0,2);
		$isql = "update sgd_agen_agendados
					set
					  SGD_AGEN_ACTIVO=0
				 where
				   RADI_NUME_RADI in($radicadosIn)
				   AND USUA_DOC=".$usuaDocAgen;
		//$this->conn->Execute($isql);
		$this->db->conn->Execute($isql); # Ejecuta la busqueda
		$this->insertarHistorico($radicados,$depOrigen,$codUsOrigen,$depOrigen,$codUsOrigen, $observa, 15);
		return $isql;
  }
  function devolver( $radicados, $loginOrigen,$depOrigen, $codUsOrigen,$tomarNivel, $observa)
  {
  	$whereNivel = "";
  	$retorno="";
  	$this->db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	foreach($radicados as $noRadicado)
	{
		$sql = "SELECT
					b.USUA_DOC
					,b.USUA_LOGIN
					,b.CODI_NIVEL
					,b.DEPE_CODI
					,b.USUA_CODI
					,b.USUA_NOMB
					,b.USUA_DOC
				FROM
					RADICADO a, USUARIO b
				WHERE
					a.RADI_USU_ANTE=b.USUA_LOGIN
					AND a.RADI_NUME_RADI = $noRadicado";
		# Busca el usuairo Origen para luego traer sus datos.
		$rs = $this->db->conn->Execute($sql); # Ejecuta la busqueda
		$usNivel = $rs->fields['CODI_NIVEL'];
		$depDestino = $rs->fields['DEPE_CODI'];
		$codUsDestino = $rs->fields['USUA_CODI'];
		$nombDestino = $rs->fields['USUA_NOMB'];
		$docUsuaDest = $rs->fields['USUA_DOC'];
		$rad=array();
		if($codUsDestino)
		{
			if($tomarNivel=="si")
			{
				$whereNivel = ",CODI_NIVEL=$usNivel";
			}
			$radicadosIn = join(",",$radicados);
			$proccarp= "Dev. ";
			$carp_codi= 12;
			$carp_per = 0;
			$isql = "update radicado
						set
						  RADI_USU_ANTE='$loginOrigen'
						  ,RADI_DEPE_ACTU=$depDestino
						  ,RADI_USUA_ACTU=$codUsDestino
						  ,CARP_CODI=$carp_codi
						  ,CARP_PER=$carp_per
						  ,RADI_LEIDO=0
						  , radi_fech_agend=null
						  ,radi_agend=null
						  $whereNivel
					 where radi_depe_actu=$depOrigen
						   AND radi_usua_actu=$codUsOrigen
						   AND RADI_NUME_RADI = $noRadicado";
			$this->db->conn->Execute($isql); # Ejecuta la busqueda
			$rad[]=$noRadicado;
			$this->insertarHistorico($rad,  $depOrigen , $codUsOrigen, $depDestino, $codUsDestino, $observa, 12);
			array_splice($rad, 0);
			$retorno=$retorno."$noRadicado ------> $nombDestino <br>";
			// MODIFICADO PARA GENERAR ALERTAS
			//JUNIO DE 2009
			$this->registrarNovedad('NOV_DEV', $docUsuaDest, $noRadicado);			
			//////////////////////////////////
		}
		else
		{
		    $retorno = $retorno. "<font color=red>$noRadicado ------> Usuario Anterior no se encuentra o esta inactivo</font><br>";
		}
	}
	 return $retorno;
  }
}
?>
