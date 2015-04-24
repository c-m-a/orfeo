<?php
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
require_once("$ruta_raiz/class_control/TipoDocumento.php");

/**
 * Anexo es la clase encargada de gestionar las operaciones y los datos basicos referentes a un anexo que haya sido adicionado a un radicado
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */

class Anexo {
// Bloque de atributos que corresponden a los campos de la tabla anexos

  /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $sgd_rem_destino;
  /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $anex_radi_nume;
  /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var string
   * @access public
   */
var $anex_codigo;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $anex_tipo;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $anex_tamano;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var string
   * @access public
   */
var $anex_solo_lect;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var string
   * @access public
   */
var $anex_creador;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var string
   * @access public
   */
var $anex_desc;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $anex_numero;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var string
   * @access public
   */
var $anex_nomb_archivo;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var string
   * @access public
   */
var $anex_borrado;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $anex_salida;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $sgd_dir_tipo;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $sgd_tpr_codigo;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var string
   * @access public
   */
var $sgd_doc_padre;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $sgd_doc_secuencia;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var string
   * @access public
   */
var $sgd_fech_doc;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $anex_depe_creador;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $sgd_pnufe_codi;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $radi_nume_salida;
/**
  * Variable que se corresponde con su par, uno de los campos de la tabla anexos
  * @var numeric
  * @access public
  */
var $sgd_apli_codi;

var $codi_anexos;
 /**
   * Gestor de las transacciones con la base de datos
   * @var ConnectionHandler
   * @access public
   */
var $cursor;



/**
* Constructor encargado de obtener la conexion
* @param	$db	ConnectionHandler es el objeto conexion
* @return   void
*/
function Anexo($db) {
	$this->cursor = $db;
}

 /**
     * Actualiza los atributos de la clase con los datos
     * del anexo correspondiente al radicado y al codigo de anexo
     * que recibe como parametros
     * @param $radicado   es el codigo del radica que contien el anexo
     * @param $codigo     es el codigo del anexo
     */

function anexoRadicado($radicado,$codigo) {


	$q="select * from anexos where ANEX_CODIGO='$codigo' AND ANEX_RADI_NUME=$radicado ";
	$rs=$this->cursor->query($q);

	if 	(!$rs->EOF)
 		{
		  	 $this->sgd_rem_destino=$rs->fields["SGD_REM_DESTINO"];
			 $this->anex_radi_nume=$rs->fields["ANEX_RADI_NUME"];
			 $this->anex_codigo=$rs->fields["ANEX_CODIGO"];
			 $this->anex_tipo=$rs->fields["ANEX_TIPO"];
			 $this->anex_tamano=$rs->fields["ANEX_TAMANO"];
			 $this->anex_solo_lect=$rs->fields["ANEX_SOLO_LECT"];
			 $this->anex_creador=$rs->fields["ANEX_CREADOR"];
			 $this->anex_desc=$rs->fields["ANEX_DESC"];
			 $this->anex_numero=$rs->fields["ANEX_NUMERO"];
			 $this->anex_nomb_archivo=$rs->fields["ANEX_NOMB_ARCHIVO"];
			 $this->anex_borrado=$rs->fields["ANEX_BORRADO"];
			 $this->anex_salida=$rs->fields["ANEX_SALIDA"];
			 $this->sgd_dir_tipo=$rs->fields["SGD_DIR_TIPO"];
			 $this->sgd_tpr_codigo=$rs->fields["SGD_TPR_CODIGO"];
			 $this->sgd_doc_padre=$rs->fields["SGD_DOC_PADRE"];
			 $this->sgd_doc_secuencia=$rs->fields["SGD_DOC_SECUENCIA"];
			 $this->sgd_fech_doc=$rs->fields["SGD_FECH_DOC"];
			 $this->anex_depe_creador=$rs->fields["ANEX_DEPE_CREADOR"];
			 $this->sgd_pnufe_codi=$rs->fields["SGD_PNUFE_CODI"];
			 $this->radi_nume_salida=$rs->fields["RADI_NUME_SALIDA"];
             $this->sgd_apli_codi=$rs->fields["SGD_APLI_CODI"];


		}

}


/**
     * Retorna el valor string correspondiente al radicado de salida generado al radicar el anexo
     * @return   string
     */

function get_radi_nume_salida(){
	return  $this->radi_nume_salida;
}

/**
     * Retorna el valor string correspondiente al anexo de salida generado al radicar el anexo
     * @return   string
     */

function get_radi_anex_salida(){
	return  $this->anex_salida;
}
/**
     * Retorna el valor string correspondiente al atributo nombre del archivo
     * @return   string
     */

function get_anex_nomb_archivo(){
	return  $this->anex_nomb_archivo;
}
/**
     * Retorna el valor string correspondiente ala descripcion del archivo anexado
     * Descripcion del anexo
     * @return   string
     */

function get_anex_desc(){
	return  $this->anex_desc;
}
/**
     * Retorna el valor entero correspondiente al tributo tipo de destinatario
     * @return   entero
     */
function get_sgd_dir_tipo(){
 return  $this->sgd_dir_tipo;
}

/**
     * Retorna el valor entero correspondiente al atributo codigo del paquete de numeracion y fechado del que hace parte el anexo
     * @return   entero
     */
function get_sgd_pnufe_codi() {
	return  $this->sgd_pnufe_codi;
}

/**
     * Retorna el valor entero correspondiente al tributo codigo del tipo de documento
     * @return   entero
     */
function get_sgd_tpr_codigo() {
	return  $this->sgd_tpr_codigo;
}

/**
     * Retorna el valor string correspondiente al tributo fecha de numeracion del documento
     * @return   entero
     */
function get_sgd_fech_doc() {
		return $this->sgd_fech_doc;
}

/**
  * Retorna el valor string correspondiente al tributo códido del aplicativo con que integra
  * @return   string
  */
function get_sgd_apli_codi() {
		return $this->sgd_apli_codi;
}


/**
     * Retorna el valor string correspondiente al tributo secuencia de numeracion del documento, en caso de no tener valor aun
		 * retorna "XXXXXXXXX"
     * @return   string
     */
function sgd_doc_secuencia() {
	if  ($this->sgd_doc_secuencia)
		return $this->sgd_doc_secuencia;
	else
		return ("XXXXXXXXX");
}

/**
     * Retorna el valor string correspondiente al tributo
     * secuencia de numeracion del documento, en caso de no tener valor aun
		 * retorna "null"
     * @return   string
     */
function sgd_doc_secuencia2() {

	if  ($this->sgd_doc_secuencia)
		return $this->sgd_doc_secuencia;
	else
		return ("null");

}

/**
     * Retorna el valor string correspondiente al tributo
     * secuencia de numeracion del documento, con un prefijo tal y como
		 * queda parametrizado en la tabla sgd_pnun_procenum
		 * @param $dependencia   es el codigo de la dependencia que genera el documento
		 * @return   string
     */
function get_doc_secuencia_formato($dependencia) {

//$dependencia=$this->anex_depe_creador;
//$dependencia="500";
if ($this->sgd_pnufe_codi) {
	$sql="select * from sgd_pnun_procenum where depe_codi=$dependencia and sgd_pnufe_codi=$this->sgd_pnufe_codi ";
	$preposicion="";
$rs = $this->cursor->query($sql);

	if 	(!$rs->EOF)
		$preposicion=$rs->fields['SGD_PNUN_PREPONE'];

	$sec_formato=str_pad($this->sgd_doc_secuencia,6,"0",STR_PAD_left);
	$sec_formato=$preposicion." - ".$sec_formato;
	return ($sec_formato);
}
else
	return ("###########");

}

/**
     * Busca el numero de secuencia de documento generado
     * para un paquete de documentos del proceso de numeraqcion y fechado.
		 * Si el documento aun no ha sido numerado, entonces se genera la secuencia
		 * de acuerdo a la dependencia usando el mombre de secuencia parametrizado en la tabla
		 * "sgd_pnufe_procnumfe" que define los paquetes de numeracion y fechado
		 * @param $dependencia   es el codigo de la dependencia a analizar
		 * @return   string
     */
function get_secuenciaDocto($dependencia) {

	$q="select * from anexos where ANEX_CODIGO='".$this->sgd_doc_padre
    ."' AND ANEX_RADI_NUME=".$this->anex_radi_nume;
	$rs=$this->cursor->query($q);

	if 	(!$rs->EOF)
 		$this->sgd_doc_secuencia=$rs->fields['SGD_DOC_SECUENCIA'];

	if ($this->sgd_doc_secuencia)
		return ($this->sgd_doc_secuencia);
	else
		{
		 // EL DOCUMENTO PADRE NO TIENE LA SECUENCIA
		//OBTIENE EL NOMBRE DE LA SECUENCIA

		$sql="select SGD_SENUF_SEC  as SEC from SGD_SENUF_SECNUMFE where SGD_PNUFE_CODI=".$this->sgd_pnufe_codi
		. " and DEPE_CODI= ".$dependencia;
		$rs2=$this->cursor->query($sql);

		if 	($rs2&&!$rs2->EOF)
			$nombreSecuencia=$this->sgd_doc_secuencia=$rs2->fields["SEC"];
			$this->sgd_doc_secuencia=$this->cursor->nextId($nombreSecuencia);

			if  (!$this->sgd_doc_secuencia)
				$this->sgd_doc_secuencia=0;
		}



	return ($this->sgd_doc_secuencia);
	}

/**
     * Actualiza en campo de secuencia en todos los documentos que hacen parte del paquete
     * de numeracion y fechado, con el numero que haya sido generado
		 */
function guardarSecuencia() {


		$fecha_hoy = date("Y-m-d");
		$sqlFechaHoy=$this->cursor->conn->DBDate($fecha_hoy);
		$record["SGD_FECH_DOC"] = $sqlFechaHoy;
		$record["SGD_DOC_SECUENCIA"] = $this->sgd_doc_secuencia;
		$recordWhere["ANEX_RADI_NUME"] = $this->anex_radi_nume;
		$recordWhere["SGD_DOC_PADRE"] = "'".$this->sgd_doc_padre."'";
		$rs=$this->cursor->update("anexos", $record, $recordWhere);

		if (!$rs)
			 	return false;
		else
			return true;

	}

/**
     * Busca el ultimo numero de secuencia de documento generado
     * para un paquete de documentos del proceso de numeracion y fechado
		 * de acuerdo a la dependencia enviada como parametro.
		 * @param $procesoNumeracionFechado   es el codigo del proceso de numeracion y fechado
		 * @param $dependencia                es el codigo de la dependencia a analizar
		 * @return   string
     */
function obtenerNumeroActualSecuencia($procesoNumeracionFechado,$dependencia){
	$numeroActual=0;
	$nombreSecuencia=$prefijo.$procesoNumeracionFechado.$dependencia;
	$q="select max(sgd_doc_secuencia) as SEC  from anexos where anex_depe_creador=$dependencia and sgd_pnufe_codi = $procesoNumeracionFechado ";
	$rs = $this->cursor->query($q);
	$retorno="";

	if 	(!$rs->EOF) 		{
 		$numeroActual=$rs->fields['SEC'];
		if ($numeroActual>0){
			$q="select SGD_FECH_DOC from anexos where anex_depe_creador=$dependencia and sgd_pnufe_codi = $procesoNumeracionFechado and sgd_doc_secuencia = $numeroActual";
			$rs=$this->cursor->query($q);
			$rs->MoveNext();
			$fechaNumero=$rs->fields["SGD_FECH_DOC"];
			$retorno="$numeroActual de $fechaNumero";
		}else{
			$retorno="Aun no generada";
		}
	}
	else {
		$retorno="Aun no generada";
	}

return ($retorno);

}

/**
     * Busca el maximo numero de anexo adicionado a un radicado, entre los radicados base, no las copias
   	 * @param $radicacion  es el codigo del radicado a analizar
		 * @return   string
     */
function obtenerMaximoNumeroAnexo($radicacion){
	$isql= "select max(anex_codigo) as NUM from anexos
             where anex_radi_nume=$radicacion ";
	$this->cursor->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$sw=0;
	$rs=$this->cursor->query($isql);

	if  (!$rs->EOF)
			$auxnumero=$rs->fields["NUM"];
	else
		$auxnumero=0;
	$auxnumero = substr ($auxnumero, strlen($auxnumero)-4, 4);


	while ($sw==0) {
		$uxnumeroSig = $auxnumero + 1;
		$isql= "select anex_codigo as NUM from anexos
             where anex_radi_nume=$radicacion and
            anex_codigo like '%$uxnumeroSig' ";
		$rs=$this->cursor->query($isql);

		if (!$rs || $rs->EOF )
			$sw=1;
		else
			$auxnumero++;
	}

	//print("SACA.........$auxnumero---");
	return($auxnumero);

}

/**
     * Busca los argumentos de contestacion de un paquete de documentos de numeracion y fechado
		 * parametrizados, y los adiciona a los arreglos que ha de procesar luego la funcion de
		 * combinacion de correspondencia
   	 * @param $campos  arreglo de etiquetas a combinar
		 * @param $datos   arreglo de valores de las etiquetas a combinar
		 */
function obtenerArgumentos(&$campos,&$datos){
if ($this->sgd_pnufe_codi){
	$sql="select a.*,b.SGD_ANAR_ARGCOD from sgd_argd_argdoc a,sgd_anar_anexarg b where a.sgd_argd_codi=b.sgd_argd_codi "
		."and a.sgd_pnufe_codi=$this->sgd_pnufe_codi and b.anex_codigo='$this->sgd_doc_padre'";
	$rs=$this->cursor->query($sql);

	// itera por todo el grupo de argumentos
	while (!$rs->EOF)
		{
 			$tablaArgumento=$rs->fields["SGD_ARGD_TABL"];
			$campoTablaArgumento=$rs->fields["SGD_ARGD_TCODI"];
			$descripcionTablaArgumento=$rs->fields["SGD_ARGD_TDES"];
			$valorLlaveTablaArgumento=$rs->fields["SGD_ANAR_ARGCOD"];
			$sqlArgumento = "select * from $tablaArgumento where $campoTablaArgumento=$valorLlaveTablaArgumento ---- $descripcionTablaArgumento ";
			$rs1 = $this->cursor->query($sqlArgumento);

				if 	(!$rs1->EOF){
				$campos[] = "*".trim($rs1->fields["SGD_ARGD_CAMPO"])."*";
				$datos[] = $rs1->fields[trim($descripcionTablaArgumento)];
			}
			$rs->MoveNext();

	}
}

}

/**
     * Busca los anexos radicables que hacen parte del paquete de numeracion y fechado
		 * al que pertenece el anexo
		* @return  arreglo de string con el codigo de los anexos radicables
		 */
function obtenerAnexosRadicablesPaquete(){
$sql="select * from anexos where sgd_doc_padre='$this->sgd_doc_padre'";
$rs=$this->cursor->query($sql);
$i=0;
$tipoDocumento= & new TipoDocumento($this->cursor);

//itera por todo el grupo de anexos
while  (!$rs->EOF){
$documento=$rs->fields["SGD_TPR_CODIGO"];
$tipoDocumento->TipoDocumento_codigo($documento);

	if ($tipoDocumento->get_sgd_tpr_radica()=="1") {
 		$documentos[$i]=$rs->fields["ANEX_CODIGO"];
		$i++;
}
$rs->MoveNext();
}
return($documentos);
}

/**
     * Busca los anexos no radicables que hacen parte del paquete de numeracion y fechado
		 * al que pertenece el anexo
		* @return  arreglo de string con el codigo de los anexos no radicables
		 */
function obtenerAnexosNoRadicablesPaquete(){
$sql="select * from anexos where sgd_doc_padre='$this->sgd_doc_padre'";
$rs=$this->cursor->query($sql);
$i=0;
$tipoDocumento= & new TipoDocumento($this->cursor);

//itera por todo el grupo de anexos
while  (!$rs->EOF) 	{
$documento=$rs->fields["SGD_TPR_CODIGO"];
$tipoDocumento->TipoDocumento_codigo($documento);

	if ($tipoDocumento->get_sgd_tpr_radica()!="1") {
 		$documentos[$i]=$rs->fields["ANEX_CODIGO"];
		$i++;
}
 $rs->MoveNext();
}
return($documentos);
}


/**
     * Busca si un grupo de anexos que hacen parte de un paquete de numeracion y fechado
		 * ha sido radicado
		* @return  true y se han radicado, false de lo contrario
		 */

function seHaRadicadoUnPaquete($docPadre){
$sql="select max(radi_nume_salida) as SALIDA from anexos where sgd_doc_padre='$docPadre' ";
$rs=$this->cursor->query($sql);

if	(!$rs->EOF)

	if ($rs->fields["SALIDA"])
		return true;
else
		return false;

}
   /**
    * Fecha de modificacion: 28-Junio-2006
    * Modificador: Supersolidaria
    * @param $verBorrados booleano Parametro para mostrar todos los anexos o solo los anexos que no han sido borrados.
    */

function anexosRadicado($radicado, $verBorrados = false) {
	$q = "select * from anexos
			where ANEX_RADI_NUME=$radicado";
    if( $verBorrados === false )
    {
        $q .= " and anex_borrado <> 'S'";
    }
    $q .= " order by anex_numero";
        //$this->cursor->debug = true;
	$rs = $this->cursor->query($q);
	$i = 0;
	while (!$rs->EOF)
 		{
		   $this->codi_anexos[$i] = $this->sgd_rem_destino=$rs->fields["ANEX_CODIGO"];
				//echo "<hr>***** Numero $i --> *** ".$this->codi_anexos[$i];
  		 $i++;
       
			 $rs->MoveNext();
		}
    
		return $i;
}

/**
     * Busca los anexos que hacen parte del paquete de numeraci� y fechado
		 * al que pertenece el anexo
		* @return  arreglo de string con el codigo de los anexos radicables
		 */
function obtenerAnexosPaquete(){
$sql="select * from anexos where sgd_doc_padre='$this->sgd_doc_padre'";
$rs=$this->cursor->query($sql);
$i=0;

//itera por todo el grupo de anexos
while  (!$rs->EOF) 	{
	$documentos[$i]=$rs->fields["ANEX_CODIGO"];
	$i++;
	$rs->MoveNext();
}

return($documentos);
}


/**
     * Retorna el padre de un anexo
		 * @return  arreglo de string con el codigo de los anexos radicables
		 */
function get_sgd_doc_padre() {
return $this->sgd_doc_padre;
}

/**
  * Pregunta si un radicado ha sido generao desde un anexo
  * @param $radicado  es el c�digo del radicado a analizar
  * @return	Booleano con valor de true en caso de que un nradicado hauya sido generado desde un anexo false de lo contrario
*/
function radGeneradoDesdeAnexo($radicacion){
	$sql= "select anex_codigo as NUM from anexos where radi_nume_salida = $radicacion";
	$rs=$this->cursor->query($sql);
	while  ($rs && !$rs->EOF) 	{
		return true;
	}
	return false;
}


/**
  * Pregunta si un anexo existe
  * @param $anex  es el c�digo del anexo a analizar
  * @return	Booleano con valor de true en caso de que el anexo exista, falso de lo contrario
*/
function existeAnexo($cod){
	$sql= "select anex_codigo as NUM from anexos where anex_codigo = '$cod'";
	$rs=$this->cursor->query($sql);
	while  ($rs && !$rs->EOF) 	{
		return true;
	}
	return false;
}

/**
  * Pregunta si un anexo ha sido radicado
  * @param $anex  es el c�digo del anexo a analizar
  * @return	Booleano con valor de true en caso de que el anexo haya sido radicado , falso de lo contrario
*/
function seHaRadicadoAnexo($cod){
	$sql= "select RADI_NUME_SALIDA as NUM from anexos where anex_codigo = '$cod'  ";
	$rs=$this->cursor->query($sql);
	if  ($rs && !$rs->EOF) 	{
		$aux= $rs->fields["NUM"];
		if (strlen (trim ($aux)) > 0 )
			return true;
	}
	return false;
}

    /**
     * Metodo que inserta un radicado Anexos
     * @param $anex_radi_nume Numero al cual le Adjuntara la Fila
     * @return Codigo del anexo Insertado
     * 
     */
    function anexarFilaRadicado($codMax){
        $codMax = $this->obtenerMaximoNumeroAnexo($this->anex_radi_nume);
        if(!$codMax) $codMax = 0;
        $codMax++;

        //echo "<hr><hr> - ". $this->anex_nomb_archivo." <-> $codigoTipoAnexo <hr>";
        $codigoTipoAnexo = $this->obtenerTipoExtension($this->anex_nomb_archivo);
        //$this->anexoExtension = $this->obtenerTipoExtension($this->anex_nomb_archivo);
        echo "Codigo Tipo anexo". $codigoTipoAnexo;
        $this->anex_codigo = trim($this->anex_radi_nume) . trim(str_pad($codMax, 5, "0", STR_PAD_LEFT));
        $anexoNombreArchivo = trim($this->anex_radi_nume) .'_'. trim(str_pad($codMax, 5, "0", STR_PAD_LEFT)). '.'.$this->anexoExtension;
        //$this->anex_nomb_archivo = $anexoNombreArchivo;
        $recordR["ANEX_TIPO"]=$codigoTipoAnexo;
        $recordR["ANEX_NOMB_ARCHIVO"]="'".$anexoNombreArchivo."'";
        $this->anexoRutaArchivo = "/".substr($this->anex_codigo,0,4)."/".substr($this->anex_codigo,4,3)."/docs/".$anexoNombreArchivo;
        $recordR["ANEX_RADI_NUME"] =  $this->anex_radi_nume;
        $recordR["ANEX_CODIGO"]    =  $this->anex_codigo;
        $recordR["ANEX_ESTADO"] = 1;
        if(!$this->anex_tamano) $this->anex_tamano = "0";
        $recordR["ANEX_TAMANO"]= $this->anex_tamano;
        if(!$this->anex_solo_lect) $this->anex_solo_lect="'N'";
        $recordR["ANEX_SOLO_LECT"]=$this->anex_solo_lect;
        $recordR["ANEX_CREADOR"]=$this->anex_creador;
        $recordR["ANEX_DESC"]= "'".$this->anex_desc."'";
        $recordR["ANEX_NUMERO"]= $codMax;
        if(!$this->anex_borrado) $this->anex_borrado = "'N'";
        $recordR["ANEX_BORRADO"] = $this->anex_borrado;
        if(!$this->anex_salida) $this->anex_salida = "0";
        $recordR["ANEX_SALIDA"]  = $this->anex_salida;
        if($this->sgd_dir_tipo) $recordR["SGD_DIR_TIPO"] = $this->sgd_dir_tipo;
        if($this->anex_depe_creador)$recordR["ANEX_DEPE_CREADOR"] = $this->anex_depe_creador;
        if($this->sgd_tpr_codigo) $recordR["SGD_TPR_CODIGO"] = $this->sgd_tpr_codigo;
        $recordR["ANEX_FECH_ANEX"] = $this->cursor->conn->OffsetDate(0,$this->cursor->conn->sysTimeStamp);
        if($this->sgd_trad_codigo) $recordR["SGD_TRAD_CODIGO"] = $this->sgd_trad_codigo;
        if($this->radi_nume_salida) $recordR["RADI_NUME_SALIDA"] = $this->radi_nume_salida;
        if($this->sgd_exp_numero) $recordR["SGD_EXP_NUMERO"]= $this->sgd_exp_numero;
        if($this->anex_estado_mail) $recordR["ANEX_ESTADO_EMAIL"] = $this->anex_estado_mail;
        if($this->usuaDoc) $recordR["USUA_DOC"] = $this->usuaDoc;
        //$this->cursor->conn->debug = true;
        $insert = $this->cursor->insert("ANEXOS", $recordR);
        if($insert==1)
        {
            return $this->anex_codigo;
        }else{
            return "-1";
        }
    }

        /**
     * Metodo que obtiene tipo de extension y codigo en la BD de OrfeoGPL
     * @param $anex_radi_nume Numero al cual le Adjuntara la Fila
     * @return Codigo del anexo Insertado
     * @autor Jairo Losada http://www.correlibre.org - http://www.orfeogpl.org
     */
    function obtenerTipoExtension($archivo)
    {
        $pathImagen = $archivo;
        $tmpExt = explode('.',$pathImagen);
        $filedatatype = $pathImagen;
        $filedatatype = strtolower($filedatatype);
        
        // Si se tiene una extension 
        if(count($tmpExt)>1){
           $filedatatype =  $tmpExt[count($tmpExt)-1];
        }
        $this->anexoExtension = $filedatatype;
        $q= "select *  from anexos_tipo
             where anex_tipo_ext='$filedatatype'";
             //$this->cursor->conn->debug = true;
  $rs = $this->cursor->conn->Execute($q);
  $codigoAnexo = $rs->fields['ANEX_TIPO_CODI'];
  
        return $codigoAnexo;
        
    }


}
?>
