<?
class TipoDocumental
{
  /**
   * Clase que maneja la asignacion de Serie, subserie, tipo documento 
   *
   * @param int Dependencia Dependencia de Territorial que Anula 
   * @db Objeto conexion
   * @access public
   */
 var $db;
 function TipoDocumental($db)
 {
    /**
  * Constructor de la clase
	* @db variable en la cual se recibe el cursor sobre el cual se esta trabajando.
	* 
	*/
    $this->db = $db;
 }
  function consultaTipoTRD( $dependencia )
  {
    
  } // end of member function cconsultaTipoTRD

  /**
   * 
   *
   * @db Cursor de la base de datos que estamos trabajando.
   * @param int dependencia Dependencia que olicita la transaccion 
   * @param int usuadoc Documento de identificaci�n del usuario que solicita la transaccion 
   * @return void
   * @access public
   */
function insertarTRD($codiTRDS,$codiTRD,$noRadicado, $coddepe , $codusuario)
{		//Arreglo que almacena los nombres de columna
		#==========================
		# Busca el Documento del usuario 
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$this->db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$sql = "SELECT 
					 USUA_DOC
					,USUA_LOGIN 
				FROM 
					USUARIO 
				WHERE 
					DEPE_CODI=$coddepe
					AND USUA_CODI=$codusuario"; 
		# Busca el usuairo para luego traer sus datos.
		$rs = $this->db->conn->Execute($sql);
		$usDoc = $rs->fields["USUA_DOC"];
		$ADODB_COUNTRECS=true;
		$sql = "SELECT *
					FROM SGD_RDF_RETDOCF 
					WHERE RADI_NUME_RADI = '$noRadicado'
				    AND  SGD_MRD_CODIGO =  '$codiTRD'";
		$rs = $this->db->conn->Execute($sql); # Executa la busqueda y obtiene el registro a actualizar.
		$ADODB_COUNTRECS=false;
		if($rs->RowCount()>=1) 
		{
			 $mensaje_err = "<HR><center><B><FONT COLOR=RED>Esta Tipificacion YA esta incluida. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>";
		}
		else
        {
			$record = array(); # Inicializa el arreglo que contiene los datos a insertar
			# Asignar el valor de los campos en el registro
			# Observa que el nombre de los campos pueden ser mayusculas o minusculas
			foreach($codiTRDS as $codiTRDR)
			{
			$record["RADI_NUME_RADI"] = $noRadicado;
			$record["DEPE_CODI"]      = $coddepe;
			$record["USUA_CODI"]      = $codusuario;
			$record["USUA_DOC"]       = $usDoc;
			$record["SGD_MRD_CODIGO"] = $codiTRD;
			$record["SGD_RDF_FECH"]   = $this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp);
			# Mandar como parametro el recordset vacio y el arreglo conteniendo los datos a insertar
			# a la funcion GetInsertSQL. Esta procesara los datos y regresara un enunciado SQL
			# para procesar el INSERT.
			$insertSQL = $this->db->insert("SGD_RDF_RETDOCF", $record, "true");
			}
			}
		return ($codiTRDS);
	//}
  } // end of member function insertarTRD
  
  function insertarTRDA($codiTRDS,$codiTRD,$noRadicado,$noRadicadoA, $coddepe , $codusuario)
  { 	//Arreglo que almacena los nombres de columna
		#==========================
		# Busca el Documento del usuario 
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$this->db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$sql = "SELECT 
					 USUA_DOC
					,USUA_LOGIN 
				FROM 
					USUARIO 
				WHERE 
					DEPE_CODI=$coddepe
					AND USUA_CODI=$codusuario"; 
		# Busca el usuairo para luego traer sus datos.
		$rs = $this->db->conn->Execute($sql);
		$usDoc = $rs->fields["USUA_DOC"];
		$sql = "SELECT *
					FROM SGD_RDA_RETDOCA 
					WHERE ANEX_RADI_NUME = '$noRadicado'
					AND ANEX_CODIGO = '$noRadicadoA'
				    AND  SGD_MRD_CODIGO =  '$codiTRD'";
		$rs = $this->db->conn->Execute($sql); # Executa la busqueda y obtiene el registro a actualizar.
		if($rs->RowCount()>=1) die ("<HR><center><B><FONT COLOR=RED>Esta Tipificacion YA esta incluida. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>");
		$record = array(); # Inicializa el arreglo que contiene los datos a insertar
			# Asignar el valor de los campos en el registro
			# Observa que el nombre de los campos pueden ser mayusculas o minusculas
			foreach($codiTRDS as $codiTRDR)
		  {
			$record["ANEX_RADI_NUME"] = $noRadicado;
			$record["ANEX_CODIGO"] = $noRadicadoA;
			$record["DEPE_CODI"]      = $coddepe;
			$record["USUA_CODI"]      = $codusuario;
			$record["USUA_DOC"]       = $usDoc;
			$record["SGD_MRD_CODIGO"] = $codiTRD;
			$record["SGD_RDA_FECH"]   = $this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp);
			# Mandar como parametro el recordset vacio y el arreglo conteniendo los datos a insertar
			# a la funcion GetInsertSQL. Esta procesara los datos y regresara un enunciado SQL
			# para procesar el INSERT.
			$insertSQL = $this->db->insert("SGD_RDA_RETDOCA", $record, "true");
			}
		return ($codiTRDS);
	//}
  } // end of member function insertarTRD
 
  /**
   * 
   *
   * funcion que registra en el historico el movimiento de eliminacion
   * y elimina el registro de la tabla sgd_rdf_retdocf (registros de asignacion de tipos
   * documentales para cada Radicado)
   * @return void
   * @access public
   */
  function eliminarTRD($nurad,$coddepe,$usua_doc,$codusuario,$codiTRD)
  {
	/*Elimina la clasificacion TRD*/		 
	 $isqlE = "delete 
	         from SGD_RDF_RETDOCF
	         where 
			   RADI_NUME_RADI=$nurad 
			   and SGD_MRD_CODIGO = $codiTRD
			 ";
	$rsE = $this->db->conn->Execute($isqlE);
	
	/*Tipo Documento del Radicado*/
	$sql = "SELECT  
			  TDOC_CODI
			  FROM radicado 
			  WHERE 
			  radi_nume_radi = '$nurad'" ; 
	$rs = $this->db->conn->Execute($sql);
   	$tip_dcto =  $rs->fields['TDOC_CODI'];

	/*Tipo Documento de la Calsificacion Eliminada*/
   	 $sql = "select SGD_TPR_CODIGO
			   		from SGD_MRD_MATRIRD 
					where SGD_MRD_CODIGO = $codiTRD";
	$rs = $this->db->conn->Execute($sql);
   	$tip_trd =  $rs->fields['SGD_TPR_CODIGO'];

    require ("../include/query/busqueda/busquedaPiloto1.php");
    unset($db);
	
	/*Verifica si la clasificacion Actual del Radicado es la misma que la de la clasificacion eliminada*/
	if ($tip_trd == $tip_dcto)
	    {
		 
		 
		 $isqlM = "select $radi_nume_radi RADI_NUME_RADI,
	                SGD_MRD_CODIGO
	                from SGD_RDF_RETDOCF r
	                where 
			        r.RADI_NUME_RADI=$nurad";
		  $rsM = $this->db->conn->Execute($isqlM);
		  $codiTRDM = $rsM->fields["SGD_MRD_CODIGO"];
          $cod_nvo = 0;
		  if($codiTRDM != '')
		    {
			  while(!$rsM->EOF)
		  		{
			    	$cod_nvo =  $rsM->fields['SGD_MRD_CODIGO'];
					$rsM->MoveNext();		
				 }
	        	 $isqlM = "select SGD_TPR_CODIGO
			    	      		from SGD_MRD_MATRIRD 
						  		where SGD_MRD_CODIGO = '$cod_nvo'";
				 $rsM = $this->db->conn->Execute($isqlM);
	     		 $cod_nvo =  $rsM->fields['SGD_TPR_CODIGO'];
			 }
		   $sql = "SELECT  
				    TDOC_CODI
					FROM radicado 
					WHERE 
					radi_nume_radi = '$nurad'" ; 
			$rs = $this->db->conn->Execute($sql);
			$record = array(); # Inicializa el arreglo que contiene los datos a modificar
			$record['TDOC_CODI'] = $cod_nvo;
			$updateSQL = $this->db->conn->GetUpdateSQL($rs, $record, true);
			$this->db->conn->Execute($updateSQL); # Actualiza el registro en la base de datos
      	}
  } // end of member function eliminarTRD
/*
*Elimina el Registro de la TRD de un Anexo
*/
 function eliminarTRDA($nurad,$coddocu,$coddepe,$usua_doc,$codusuario,$codiTRD)
{	include_once ("../include/query/busqueda/busquedaPiloto1.php");
   $isqlE = "select rownum as NUM, 
			   ANEX_RADI_NUME,
			   ANEX_CODIGO,
			   SGD_MRD_CODIGO
	         from SGD_RDA_RETDOCA
	         where 
			   ANEX_RADI_NUME='$nurad'
			   and ANEX_CODIGO='$coddocu'
			 ";
	    
		$rsE = $this->db->conn->Execute($isqlE);
	    if($rsE->RowCount()>1)
		{
		  while(!$rsE->EOF)
		  {
		    if ($rsE->fields['SGD_MRD_CODIGO'] == $codiTRD )
		  	{
		     $numreg_Eli = $rsE->fields['NUM'];
		  	}
			 $rsE->MoveNext();
			  
		   }
		  	if ($numreg_Eli==$rsE->RowCount())
		  		{
		  		$i = $rsE->RowCount() - 1;
	 			$isqlE = "select  
						ANEX_RADI_NUME,
			   			ANEX_CODIGO,
			   			SGD_MRD_CODIGO
	         			from SGD_RDA_RETDOCA
	         			where 
			   				ANEX_RADI_NUME='$nurad'
			   				and ANEX_CODIGO='$coddocu'
							and rownum = '$i'
			 			";
				
				$rsE = $this->db->conn->Execute($isqlE);
			    $cod_nvo =  $rsE->fields['SGD_MRD_CODIGO'];    
	        	$isqlE = "select SGD_TPR_CODIGO
			    	      from SGD_MRD_MATRIRD 
						  where SGD_MRD_CODIGO = '$cod_nvo'";
				
				$rsE = $this->db->conn->Execute($isqlE);
	     		$cod_nvo =  $rsE->fields['SGD_TPR_CODIGO'];
				$indi_change = "SI";
				}   
		}else
		{
		  $cod_nvo = 0;
		  $indi_change = "SI";
		}
	 if ($indi_change == "SI")
	 	{
		$sql = "SELECT
							SGD_TPR_CODIGO
							FROM anexos 
							WHERE  ANEX_RADI_NUME = '$nurad'
							and ANEX_CODIGO = '$coddocu'
							";
		$rs = $this->db->conn->Execute($sql);
		$record = array(); # Inicializa el arreglo que contiene los datos a modificar
		$record['SGD_TPR_CODIGO'] = $cod_nvo;
		$updateSQL = $this->db->conn->GetUpdateSQL($rs, $record, true);
		
		$this->db->conn->Execute($updateSQL); # Actualiza el registro en la base de datos

      }	 
  
     $isqlEAnex = "delete 
	         from SGD_RDA_RETDOCA
	         where 
			   ANEX_RADI_NUME='$nurad'
			   and ANEX_CODIGO='$coddocu'
			   and SGD_MRD_CODIGO = '$codiTRD'
			 ";
		$rsE = $this->db->conn->Execute($isqlEAnex);
	
  } // end of member function eliminarTRD

  /**
   * Actualiza el tipo documento table Radicados 
   *
   */
 /******* CALCULO DE VENCIMIENTOS */
function diaFinSemana($fechaEval,$kDia)
{	
	$fechaTMP = str_replace("-","/",$fechaEval);
	$dia = substr($fechaTMP,-2);
	$mes = substr($fechaTMP,5,2);
	$ano = substr($fechaTMP,0,4);
	$diaDelMes = date("w",mktime(0, 0, 0, $mes  , $dia+$kDia, $ano));
	if($diaDelMes==0 or $diaDelMes==6) return true; else return false;
}

function calcFechVenc($fldTermino,$fldFechInic)
{	
	$ruta_raiz = "..";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$db2 = new ConnectionHandler("$ruta_raiz");	 
	$db2->conn->SetFetchMode(ADODB_FETCH_ASSOC); 

	$cDiasAdicionL = 0;
	$termino 	= $fldTermino;
	$fechaIni 	= $fldFechInic;
	$cDiasCalen = 1;
	$cDiasHabil = 0;

	while($cDiasHabil < $termino)
  	{
		$isql_busca = "
			select noh_fecha, to_date('" . $fechaIni . "','yyyy/mm/dd hh24:mi:ss') + $cDiasCalen as fvenc 
			from sgd_noh_nohabiles
			where substr(to_char(noh_fecha,'dd/mm/yy hh24:mi:ss'),1,10) = substr(to_char(to_date('" . $fechaIni . "','yyyy/mm/dd hh24:mi:ss') + $cDiasCalen,'dd/mm/yy hh24:mi:ss'),1,10)
		";
        $rs2 = $db2->query($isql_busca);
  		$nregis2 = $rs2->fields["NOH_FECHA"];	
		if ($rs2->EOF)
		{
			if ($this->diaFinSemana($fechaIni,$cDiasCalen)) { 
				$cDiasAdicionL++; 
			} 
			else $cDiasHabil++;
		}
		else  {
			$cDiasAdicionL++;
		}
		$cDiasCalen++;
	}
	$cDiasSumar = $cDiasHabil + $cDiasAdicionL;
	$f11= $this->suma_fechas($fechaIni, $cDiasSumar);
	return $f11;
}


function suma_fechas($fecha,$ndias)
{
//      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
//              list($dia,$mes,$a�o)=split("-", $fecha);
     //if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))

//	list($dia,$mes,$a�o)=split("-",$fecha);
	list($ano,$mes,$dia)=split("-",$fecha);
	if ($mes == 'JAN') $mesn = 1;
	else
	if ($mes == 'FEB') $mesn = 2 ;
	else
	if ($mes == 'MAR') $mesn = 3 ;
	else
	if ($mes == 'APR') $mesn = 4 ;
	else 
	if ($mes == 'MAY') $mesn = 5;
	else
	if ($mes == 'JUN') $mesn = 6 ;
	else
	if ($mes == 'JUL') $mesn = 7 ;
	else
	if ($mes == 'AUG') $mesn = 8 ;
	else
	if ($mes == 'SEP') $mesn = 9 ;
	else
	if ($mes == 'OCT') $mesn = 10 ;
	else
	if ($mes == 'NOV') $mesn = 11 ;
	else
	if ($mes == 'DEC') $mesn = 12 ;
	else $mesn = $mes;

    $nueva = mktime(0,0,0, $mesn,$dia,$ano) + $ndias * 24 * 60 * 60;
    $nuevafecha=date("Y-m-d",$nueva);
    return ($nuevafecha);  
}

 /******* FIN CALCULO DE VENCIMIENTOS */

function actualizarTRD($radicados,$tdoc)
{		require("../include/query/busqueda/busquedaPiloto1.php");
		unset($db);
		// tdoc_codi = 0 and 
		foreach($radicados as $noRadicado)
		{
			$sql = "SELECT  
						TDOC_CODI
					FROM radicado 
					WHERE 
						radi_nume_radi = " . $noRadicado; 
			# Selecciona el registro a actualizar
			$rs = $this->db->conn->Execute($sql); # Executa la busqueda y obtiene el registro a actualizar.
			
			$record = array(); # Inicializa el arreglo que contiene los datos a modificar
			
			# Asignar el valor de los campos en el registro
			# Observa que el nombre de los campos pueden ser mayusculas o minusculas
			
			$record['TDOC_CODI'] = $tdoc;
			
			# Mandar como parametro el recordset y el arreglo conteniendo los datos a actualizar
			# a la funcion GetUpdateSQL. Esta procesara los datos y regresara el enunciado sql del
			# update necesario con clausula WHERE correcta.
			# Si no se modificaron los datos no regresa nada.
			$updateSQL = $this->db->conn->GetUpdateSQL($rs, $record, true);
			$this->db->conn->Execute($updateSQL); # Actualiza el registro en la base de datos
			# Si no se modificaron los datos no regresa nada.

			# Inicio Calculo fecha de vencimiento
			$sql = " 
				select $radi_nume_radi  AS RADICADO,
					td.sgd_termino_real	AS TERMINO,
					r.radi_fech_radi	AS F1
				from radicado r, sgd_tpr_tpdcumento td
				where 
					r.tdoc_codi = td.sgd_tpr_codigo
					AND radi_nume_radi = " . $noRadicado	; 
			$rs = $this->db->conn->Execute($sql); # Executa la busqueda y obtiene el registro a actualizar.		
		    $fldRADI_NUME_RADI 	= $rs->fields["RADICADO"];
			$fldTERMINO        	= $rs->fields["TERMINO"];		
			$fldF1         	   	= $rs->fields["F1"];
			$fecVenEval 		= $this->calcFechVenc($fldTERMINO,$fldF1);
			$ruta_raiz = "..";
			include_once "$ruta_raiz/include/db/ConnectionHandler.php";
			$db3 = new ConnectionHandler("$ruta_raiz");	 
			$db3->conn->SetFetchMode(ADODB_FETCH_ASSOC); 
			$uSQL = "UPDATE RADICADO SET FECH_VCMTO =  ".$db3->conn->DBDate('Y-m-d H:i:s', $fecVenEval)." WHERE radi_nume_radi = $fldRADI_NUME_RADI ";
			$db3->query($uSQL);
			# Fin Calculo fecha de vencimiento
		}
		return ($radicados);
  } // end of member function solicitudAnulacion
  
  /**
   * Actualiza el tipo documento table Anexos
   *
   */
function actualizarTRDA($radicados,$coddocu,$tdoc)
  {
		foreach($radicados as $noRadicado)
		{
			//Modificado el 05092005 SGD_TPR_CODIGO = 0  and
			$sqlUA = "SELECT
							SGD_TPR_CODIGO
							FROM anexos 
							WHERE  ANEX_RADI_NUME = '$noRadicado'
							and ANEX_CODIGO = '$coddocu'"
							; 
			# Selecciona el registro a actualizar
			$rs = $this->db->conn->Execute($sqlUA); # Executa la busqueda y obtiene el registro a actualizar.
			
			$record = array(); # Inicializa el arreglo que contiene los datos a modificar
			
			# Asignar el valor de los campos en el registro
			# Observa que el nombre de los campos pueden ser mayusculas o minusculas
			
			$record['SGD_TPR_CODIGO'] = $tdoc;

			# Mandar como parametro el recordset y el arreglo conteniendo los datos a actualizar
			# a la funcion GetUpdateSQL. Esta procesara los datos y regresara el enunciado sql del
			# update necesario con clausula WHERE correcta.
			# Si no se modificaron los datos no regresa nada.
			
			$updateSQL = $this->db->conn->GetUpdateSQL($rs, $record, true);

			$this->db->conn->Execute($updateSQL); # Actualiza el registro en la base de datos
			# Si no se modificaron los datos no regresa nada.
		}
		return ($radicados);
  } // end of member function solicitudAnulacion

  
  function actualizarTRDAUnitario($noRadicado,$coddocu)
  {
			$sqlUA = "SELECT
							SGD_TPR_CODIGO
							FROM anexos 
							WHERE  ANEX_CODIGO = '$noRadicado'"
							; 
			# Selecciona el registro a actualizar
			$rs = $this->db->conn->Execute($sqlUA); # Executa la busqueda y obtiene el registro a actualizar.
			
			$record = array(); # Inicializa el arreglo que contiene los datos a modificar
			
			# Asignar el valor de los campos en el registro
			# Observa que el nombre de los campos pueden ser mayusculas o minusculas
			
			$record['SGD_TPR_CODIGO'] = $coddocu;

			# Mandar como parametro el recordset y el arreglo conteniendo los datos a actualizar
			# a la funcion GetUpdateSQL. Esta procesara los datos y regresara el enunciado sql del
			# update necesario con clausula WHERE correcta.
			# Si no se modificaron los datos no regresa nada.
			
			$updateSQL = $this->db->conn->GetUpdateSQL($rs, $record, true);

			$this->db->conn->Execute($updateSQL); # Actualiza el registro en la base de datos
			# Si no se modificaron los datos no regresa nada.
		
		return ($updateSQL);
  } // 
} // end of TipoDocumental

?>
