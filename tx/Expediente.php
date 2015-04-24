<?
/**
  * CLASE EXPEDIENTE
  * @author JAIRO LOSADA
  * @copyLeft SuperIntendencia de Servicios Publicos
  * @Licencia GPL licencia publica General	
  * @version Orfeo 3.5
  * @param $query    String Variable Usada para almacenar consultas SQL
  * @param $expTerminos Int Almacena los terminos o Dias habiles para ejecucion de un proceso.
  */
class Expediente
{
   var $num_expediente;  // Almacena el numero del expediente
   var $estado_expediente; // Almacena el estado 0 para organizacion y 1 para indicar que ya esta clasificado fisicamente en archivo
   var $exp_titulo;
   var $exp_asunto;
   var $exp_ufisica;
   var $exp_isla;
   var $exp_caja;
   var $exp_estante;
   var $exp_carpeta;
   var $exp_num_carpetas;
	 var $expUsuaDoc;
	 var $codiSRD;
	 var $codiSBRD;
   var $db;

/** Variable que ALmacena los dias Habiles de un Proceso
  *	@param $expTerminos int Contiene los dias Habiles de Un Proceso.
  */
	var $expTerminos;

/** Variable que ALmacena los dias Habiles de una Etapa Perteneciente a Un proceso
  *	@param $expTerminosP int Contiene los terminos en dias Habiles de la Etapa Actual del Proceso del expediente.
  */
	var $expTerminosP;

/** Variable 
  *	@param $expFechaCrea int Almacena Fecha de Creacion del expediente
  */
	var $expFechaCrea;

/** CONSTRUTOR
  * Inicializa la Clase.
  *	@param $db variable contenedora del Cursor. Esta tiene que ser  enviada en el construtor
  */

	function Expediente($db)
	{
		ECHO "<hr>**************** prueba......*************<hr>";
		$this->db = $db;
		ECHO "<hr>**************** prueba......*************<hr>";
	}

/** FUNCION CONSULTA EXPEDIENTE
  * Inicializa la Clase.
  * @param $radicado int Contiene el numero de radicado a Buscar
  * @return Numero de Expediente que posee el radicado
  */
	function consulta_exp($radicado)
	{	include("../include/query/queryver_datosrad.php");
		$query="select SGD_EXP_NUMERO,$radi_nume_radi RADI_NUME_RADI 
				from SGD_EXP_EXPEDIENTE a
				where RADI_NUME_RADI = $radicado";		 
		$rs = $this->db->conn->query($query);
		if ($rs->EOF){
		    //echo 'No tiene un Numero de expediente<br>';
			$this->num_expediente = 0;
		 }else{
		   if (!$rs->EOF)
		   {
			 $this->num_expediente = $rs->fields['SGD_EXP_NUMERO'];
			 $this->estado_expediente = $rs->fields['SGD_EXP_ESTADO'];
		   } 
		}
		//$this->num_expediente = $num_expediente;
		return $this->num_expediente;
	 }

	 
/** 
  * Inserta un Numero de radicado en un Expediete
  * Inicializa la Clase.
  * @param  $radicado int Contiene el numero de radicado a Buscar
  * @param  $usua_doc String Documento de identificacion de Usuario que realiza la insercion- 
  * @param  $usua_codi String Codigo en Orfeo del Usuario que realiza la insercion-
  * @param  $depe_codi String Codigo en Orfeo de la dependencia del  Usuario que realiza la insercion.
  * @param  $radicado Numeric Numero de Radicado a Relacionar con el Expediente.
  * @param  $radicado String Numero de Expediente a Relacionar con el Radicado.
  * @param  $expManual String que Contien 1 o 0. "0 es genera secuencia y 1 deja el consecutivo que el usuario ha colocado.
  * @return Numero de Expediente que posee el radicado
  * 
  */
 function insertar_expediente($num_expediente,$radicado,$depe_codi,$usua_codi,$usua_doc)
 {
 	
	$estado_expediente =0;
	$creadoOld = 0;
	$query="select *
			from SGD_SEXP_SECEXPEDIENTES
			WHERE
			SGD_EXP_NUMERO='$num_expediente'
			";
	  $rs = $this->db->conn->query($query);
	  if(!$rs->fields["SGD_EXP_NUMERO"])
	  {
	    $this->db->conn->query($query);
			$query="select 
			SGD_EXP_NUMERO,
			SGD_EXP_FECH
			from SGD_EXP_EXPEDIENTE
			WHERE
			SGD_EXP_NUMERO='$num_expediente'
			order by SGD_EXP_FECH DESC";
			$rs2 = $this->db->conn->query($query);
			if(!$rs2->fields["SGD_EXP_NUMERO"])
			{
					echo "<hr>No hay  Documentos en el expediente $num_expediente<hr>";
					return 0;
				}else{
					$codiSRD = 0;
					$codiSBRD = 0;
					$fechaExp = $rs2->fields["SGD_EXP_FECH"];
					echo "<hr> $num_expediente,$radicado,$depe_codi,$usua_codi,$usua_doc,$usua_doc,$codiSRD,$codiSBRD,"true",$fechaExp <hr>";
					$this->crearExpediente($num_expediente,$radicado,$depe_codi,$usua_codi,$usua_doc,$usua_doc,$codiSRD,$codiSBRD,"true",$fechaExp);
					if($rs2!=-1) $creadoOld = 1;
			}
		  
	  }

	if (!$rs->EOF or $creadoOld==1)
	{
	//echo "<br>Expediente Grabado Correctamente<br>";
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$this->db->conn->DBDate($fecha_hoy);	
	if(!$estado_expediente) $estado_expediente = "0";
	
	$query="insert into SGD_EXP_EXPEDIENTE(SGD_EXP_NUMERO   , RADI_NUME_RADI,SGD_EXP_FECH,DEPE_CODI   ,USUA_CODI   ,USUA_DOC      ,SGD_EXP_ESTADO )
	VALUES ('$num_expediente','$radicado'    ,".$sqlFechaHoy.",'$depe_codi' ,'$usua_codi' ,'$usua_doc','$estado_expediente')";
	if (!$this->db->conn->query($query)){
		//echo '<br>Lo siento no pudo agregar el expediente<br>';
		return 0;
		
	}else
	{
		return 1;
	}
	
 }else{
		return 0;
}
}
/** 
  * Crea un Numero de radicado en un Expediete
  * Crea un expediente y añade un numero de radicado a este. Ademas inserta en el historico 
  * La transcacion realizada, para esto verifica que el digito de Chequeo.
  *
  * @param  $radicado int Contiene el numero de radicado a Buscar
  * @param  $usua_doc String Documento de identificacion de Usuario que realiza la insercion- 
  * @param  $usua_codi String Codigo en Orfeo del Usuario que realiza la insercion-
  * @param  $depe_codi String Codigo en Orfeo de la dependencia del  Usuario que realiza la insercion.
  * @param  $radicado Numeric Numero de Radicado a Relacionar con el Expediente.
  * @param  $expOld   String Si esta en False Indica eque es un expediente Normal, True es del numeracin Antigua.
  * @param  $radicado String Numero de Expediente a Relacionar con el Radicado.
  * @return Numero de Expediente que posee el radicado
  */   
function crearExpediente($numExpediente,$radicado,$depe_codi,$usua_codi,$usua_doc,$usuaDocExp,$codiSRD,$codiSBRD,$expOld,$fechaExp)
{
	//$this->db->conn->debug = true; 200590012345
	$estado_expediente =0;
	$query="select SGD_EXP_NUMERO
			from SGD_SEXP_SECEXPEDIENTES
			WHERE
			SGD_EXP_NUMERO='$numExpediente'
			";
	echo "<hr>-------> Entro a insertar.... ********************<hr>";
	//$this->db->conn->debug = true;	
	if($expOld=="false")
	{
	$rs = $this->db->conn->query($query);
	$trdExp = substr("00".$codiSRD,-2) . substr("00".$codiSBRD,-2);
	$anoExp = substr($numExpediente,0,4);
	if($expManual==1)
	{
		$secExp = $this->secExpediente($dependencia,$codiSRD,$codiSBRD,$anoExp);
	}
	else
	{
		$secExp = substr($numExpediente,11,5);
	}
		$consecutivoExp = substr("00000".$secExp,-5);
		$numeroExpediente = $anoExp . $dependencia . $trdExp . $consecutivoExp;
	}else
	{
	 $secExp = "0";
	 $consecutivoExp = "00000";
	 $anoExp = substr($numExpediente,0,4);
	}
	if ($rs->fields["SGD_EXP_NUMERO"]==$numExpediente)
	{
		return 0;
	}
	else
	{
	$fecha_hoy = Date("Y-m-d");
	if(!$fechaExp) $fechaExp = $fecha_hoy;
	$sqlFechaHoy=$this->db->conn->DBDate($fechaExp);
  if(!$secExp) $secExp =1;
  if(!$usuaDocExp) $usuaDocExp=$usua_doc;
  
	//$queryDel = "DELETE FROM SGD_SEXP_SECEXPEDIENTES WHERE SGD_EXP_NUMERO='$numExpediente'";
	//$this->db->conn->query($queryDel);
	echo "**** <hr>";
	$query="insert into SGD_SEXP_SECEXPEDIENTES(SGD_EXP_NUMERO   ,SGD_SEXP_FECH      ,DEPE_CODI   ,USUA_DOC   ,SGD_FEXP_CODIGO,SGD_SRD_CODIGO,SGD_SBRD_CODIGO,SGD_SEXP_SECUENCIA, SGD_SEXP_ANO,USUA_DOC_RESPONSABLE)
	VALUES ('$numExpediente',". $sqlFechaHoy ." ,'$depe_codi','$usua_doc',1              ,$codiSRD     ,$codiSBRD        ,$secExp ,$anoExp,$usuaDocExp)";
	echo "**** <hr>";
		if (!$rs = $this->db->conn->query($query)){
			//echo '<br>Lo siento no pudo agregar el expediente<br>';
		echo "No se ha podido insertar el Expediente";
			return 0;
		}else{
		//echo "<br>Expediente Grabado Correctamente<br>";
		return $numExpediente;
		}

	}
	}
/** 
  * Modifica un Numero de radicado en un Expediete
  * Modifica un expediente y añade un numero de radicado a este. Ademas inserta en el historico 
  * La transcacion realizada, para esto verifica que el digito de Chequeo.
  *
  * @param  $radicado int Contiene el numero de radicado a Buscar
  * @param  $usua_doc String Documento de identificacion de Usuario que realiza la insercion- 
  * @param  $usua_codi String Codigo en Orfeo del Usuario que realiza la insercion-
  * @param  $depe_codi String Codigo en Orfeo de la dependencia del  Usuario que realiza la insercion.
  * @param  $radicado Numeric Numero de Radicado a Relacionar con el Expediente.
  * @param  $radicado String Numero de Expediente a Relacionar con el Radicado.
  * @return Numero de Expediente que posee el radicado
  */      
	 function modificar_expediente($radicado,$num_expediente,$exp_titulo,$exp_asunto,$exp_ufisica,$exp_isla,$exp_caja,$exp_estante,$exp_carpeta)
	 {
		$fecha_hoy = Date("Y-m-d");
		$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);		 
	    $query="update sgd_exp_expediente set SGD_EXP_NUMERO='$num_expediente'
				,SGD_EXP_TITULO='$exp_titulo'
				,SGD_EXP_ASUNTO='$exp_asunto'
				,SGD_EXP_UFISICA='$exp_ufisica'
				,SGD_EXP_ISLA='$exp_isla'
				,SGD_EXP_CAJA='$exp_caja'
				,SGD_EXP_ESTANTE='$exp_estante'
				,SGD_EXP_CARPETA='$exp_carpeta'
				,SGD_EXP_ESTADO='1'
				,SGD_EXP_FECH_ARCH=".$sqlFechaHoy."
				WHERE RADI_NUME_RADI = $radicado
				";		
		if (!$rs = $this->db->conn->query($query)){
		echo '<br>Lo siento no pudo Actualizar los datos del expediente<br>';
		}else{
		echo "<br>Datos de expediente Grabados Correctamente<br>";
		}
		}	 
	 function datos_expediente($radicado,$num_expediente)
	 {
	    $query="select max(SGD_EXP_CARPETA) tt
				from sgd_exp_expediente
				WHERE
				SGD_EXP_NUMERO='$num_expediente'
				group by SGD_EXP_NUMERO ";
	    $rs = $this->db->conn->query($query);
		if (!$rs){
		    echo 'No tiene un Numero de expediente<br>';
		 }else{
		   if ($rs) $this->exp_num_carpetas = $this->rs->fields['tt'];
		}
	    $query="select
				SGD_EXP_TITULO
				,SGD_EXP_ASUNTO
				,SGD_EXP_UFISICA
				,SGD_EXP_ISLA
				,SGD_EXP_CAJA
				,SGD_EXP_ESTANTE
				,SGD_EXP_CARPETA
				from sgd_exp_expediente
				WHERE
				SGD_EXP_NUMERO='$num_expediente'
				and RADI_NUME_RADI = $radicado
				";
		$rs = $this->db->conn->query($query);
		if ($rs){
	
		  $this->exp_titulo = "'" .$this->rs->fields['sgd_exp_titulo']."'";
		  $this->exp_asunto = "'" . $this->rs->fields['sgd_exp_asunto'] ."'";
		  $this->exp_ufisica = "'" .$this->rs->fields['sgd_exp_ufisica'] ."'";
		  $this->exp_isla = $this->rs->fields['sgd_exp_isla'] ;
		  $this->exp_caja = $this->rs->fields['sgd_exp_caja'] ;
		  $this->exp_estante = $this->rs->fields['sgd_exp_estante'] ;
		  $this->exp_carpeta = $this->rs->fields['sgd_exp_carpeta'] ;
			 return 1;
		}else{
		   echo "<br>No se encontraron datos del expediente<br>";
			 return 0;
		}
	}
	function consultaTipoExpediente($numExpediente)
	{
		$query="select se.SGD_EXP_NUMERO
				, sb.SGD_SRD_CODIGO
				, sr.SGD_SRD_DESCRIP
				, sb.SGD_SBRD_CODIGO
				, sb.SGD_SBRD_DESCRIP
				, se.SGD_FEXP_CODIGO
				, se.SGD_SEXP_FECH
				, se.USUA_DOC_RESPONSABLE
			from SGD_SEXP_SECEXPEDIENTES se
 				, SGD_SBRD_SUBSERIERD sb
				, SGD_SRD_SERIESRD sr
			WHERE
				SGD_EXP_NUMERO='$numExpediente'
				AND se.SGD_SRD_CODIGO=sr.SGD_SRD_CODIGO
				AND se.SGD_SRD_CODIGO=sb.SGD_SRD_CODIGO
				AND se.SGD_SBRD_CODIGO=sb.SGD_SBRD_CODIGO
			";

	  $rs = $this->db->conn->query($query);
		$numExpediente = $rs->fields["SGD_EXP_NUMERO"]; 
	  if($numExpediente)
	  {
	    $this->db->conn->query($query);
			$this->descSerie=$rs->fields["SGD_SRD_DESCRIP"];
			$this->descSubSerie=$rs->fields["SGD_SBRD_DESCRIP"];
			$this->codiSRD=$rs->fields["SGD_SRD_CODIGO"];
			$this->codiSBRD=$rs->fields["SGD_SBRD_CODIGO"];
			$this->codigoFldExp=$rs->fields["SGD_FEXP_CODIGO"];
			$this->expFechaCrea=$rs->fields["SGD_SEXP_FECH"];
			$this->expUsuaDoc=$rs->fields["USUA_DOC_RESPONSABLE"];

			/** EN ESTA CONSULTA TRAEMOS EL TIPO DE PROCESO
				*/
			$query = "SELECT SGD_PEXP_DESCRIP
									,SGD_PEXP_CODIGO 
									,SGD_PEXP_TERMINOS
									FROM SGD_PEXP_PROCEXPEDIENTES
									WHERE SGD_SRD_CODIGO= ".$this->codiSRD."
									AND SGD_SBRD_CODIGO=".$this->codiSBRD;
			
	    $rs = $this->db->conn->query($query);
			$this->codigoTipoExp=$rs->fields["SGD_PEXP_CODIGO"];
			$this->descTipoExp=$rs->fields["SGD_PEXP_DESCRIP"];
			$this->expTerminos = $rs->fields["SGD_PEXP_TERMINOS"];
			/** EN ESTA CONSULTA TRAEMOS EL ESTADO DEL PROCESO
				*/

			$query = "SELECT SGD_FEXP_DESCRIP
									, SGD_FEXP_CODIGO 
									, SGD_FEXP_TERMINOS
									FROM SGD_FEXP_FLUJOEXPEDIENTES
									WHERE SGD_FEXP_CODIGO= ".$this->codigoFldExp.""
								;
		    $rs = $this->db->conn->query($query);
			$this->codigoFldExp=$rs->fields["SGD_FEXP_CODIGO"];
			$this->descFldExp=$rs->fields["SGD_FEXP_DESCRIP"];
			$this->expTerminosP =  $rs->fields["SGD_FEXP_TERMINOS"];

		return $numExpediente;;
	  }
		else
		{
			return 0;
		}
	}
		/**  FUNCION QUE CALCULA SECUENCIA SEGUN PARAMETROS DEPENDENCIA, SERIE, SUBSERIE
			* Esta funcion Devuelve la secuencia manual cogiendo el valor mayor en le campo SGD_SEXP_SECUENCIA 
			* y le incrementa 1.
			*	@param $dependencia int Codigo de la Dependencia.
			* @param $codiSrd int Codigo de la Serie documental que es enviada por el Usuario.
			* @param $codiSBRD int Codigo de la subserie documental enviada por el Usuario.
			* @param $query String Cadena de uso temporal para guardar consultas SQL.
			* @return  Esta funcion Rerna el valor incrementado en Uno del la secuencia correspondiente.
			*/
	function secExpediente($dependencia,$codiSRD,$codiSBRD,$anoExp)
	{
		$query="select se.SGD_EXP_NUMERO
				, se.SGD_FEXP_CODIGO
				, se.SGD_SEXP_SECUENCIA
			from SGD_SEXP_SECEXPEDIENTES se
			WHERE
				SGD_SRD_CODIGO=$codiSRD
				AND SGD_SBRD_CODIGO=$codiSBRD
				AND SGD_SEXP_ANO=$anoExp
				AND SGD_SEXP_SECUENCIA > 0
				AND SGD_SEXP_SECUENCIA IS NOT NULL
			ORDER BY 
				SGD_SEXP_SECUENCIA DESC
			";
	  $rs = $this->db->conn->query($query);
		$numExpediente = $rs->fields["SGD_EXP_NUMERO"];
		$secExp = $rs->fields["SGD_SEXP_SECUENCIA"];
		if(!$secExp)
		{
			$secExp= 1;
		}
		else
		{
 			$secExp= $secExp+1;
		}
		return $secExp;
	}
}
?>
