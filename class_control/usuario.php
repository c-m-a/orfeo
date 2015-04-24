<?php 
/**
 * Usuario es la clase encargada de gestionar las operaciones y los datos basicos referentes a un usuario
 * @author	Sixto Angel Pinzon
 * @version	1.0
 */
class Usuario {
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var numeric
   * @access public
   */
var $depe_codi;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var numeric
   * @access public
   */
var $usua_codi;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $usua_pasw;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $usua_nomb;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $perm_radi;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $usua_nuevo;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $usua_doc;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $usua_nacim;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $usua_email;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var numeric
   * @access public
   */
var $perm_radi_sal;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $usu_direccion;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $usu_telefono1;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var string
   * @access public
   */
var $usu_telefono2;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla usuario
   * @var numeric
   * @access public
   */
var $usu_cargo;
/**
   * Gestor de las transacciones con la base de datos
   * @var ConnectionHandler
   * @access public
   */
var $cursor;

/**
 * Variable que contiene el permiso de si un usuario puede tipificar un anexo .tiff
 *
 * @var Number
 */

var $perm_tipif_anexo;

/**
 * Variable que contiene el permiso de si un uusairo puede borrar un anexo .tiff
 *
 * @var number
 */

var $perm_borrar_anexo;

  
/** 
* Constructor encargado de obtener la conexion
* @param	$db	ConnectionHandler es el objeto conexion
* @return   void
*/
function Usuario($db) {
	
	$this->cursor = & $db;

}


/** 
  * Carga los datos de la instacia con con  referencia a un login de usuario suministrado retorna falso si no lo encuentra, de lo contrario true
  * @param	$codigo	string es el codigo del departamento
	* @return   boolean
  */
function usuarioLogin($login) {
	$q="select *,usuario.USUA_NOMB
					,usuario.DEPE_CODI
					,usuario.USUA_NUEVO
					,usuario.USUA_DOC
					,usuario.PERM_RADI
					,usuario.USUA_EMAIL
					,usuario.USUA_NACIM from usuario where usua_login='$login' ";
	$rs=$this->cursor->query($q);
	
	if 	 ($rs && !$rs->EOF){
		   $this->depe_codi=$rs->fields['DEPE_CODI'];
			 $this->usua_pasw=$rs->fields['USUA_PASW'];
			 $this->usua_nomb=$rs->fields['USUA_NOMB'];
			 $this->perm_radi=$rs->fields['PERM_RADI'];
			 $this->usua_nuevo=$rs->fields['USUA_NUEVO'];
			 $this->usua_doc=$rs->fields['USUA_DOC'];
			 $this->usua_nacim=$rs->fields['USUA_NACIM'];
			 $this->usua_email=$rs->fields['USUA_EMAIL'];
			 $this->perm_radi_sal=$rs->fields['PERM_RADI_SAL'];
			 $this->usu_direccion=$rs->fields['USU_DIRECCION'];
			 $this->usu_telefono1=$rs->fields['USU_TELEFONO1'];
			 $this->usu_telefono2=$rs->fields['USU_TELEFONO2'];
			 $this->usu_cargo=$rs->fields['USU_CARGO'];
			 $this->perm_tipif_anexo=$rs->fields['PERM_TIPIF_ANEXO'];
			 return true;
		}else
			 return false;
		
}


/** 
  * Carga los datos de la instacia con con  referencia a un codigo de dependencia y un codigo de usuario suministrado retorna falso si no lo encuentra, de lo contrario true
  * @param	$dependencia	string es el codigo de la dependencia
	* @param	$codUsuario	string es el codigo del usuario
	* @return   boolean
  */
function usuarioDependecina($dependencia,$codUsuario) {
	$q="select *
					,usuario.USUA_NOMB
					,usuario.DEPE_CODI
					,usuario.USUA_NUEVO
					,usuario.USUA_DOC
					,usuario.PERM_RADI
					,usuario.USUA_EMAIL
					,usuario.USUA_NACIM
					 from usuario where depe_codi = $dependencia and usua_codi = $codUsuario ";
	$rs=$this->cursor->query($q);
	
	if 	 ($rs && !$rs->EOF){
		   $this->depe_codi=$rs->fields['DEPE_CODI'];
			 $this->usua_pasw=$rs->fields['USUA_PASW'];
			 $this->usua_nomb=$rs->fields['USUA_NOMB'];
			 $this->perm_radi=$rs->fields['PERM_RADI'];
			 $this->usua_nuevo=$rs->fields['USUA_NUEVO'];
			 $this->usua_doc=$rs->fields['USUA_DOC'];
			 $this->usua_nacim=$rs->fields['USUA_NACIM'];
			 $this->usua_email=$rs->fields['USUA_EMAIL'];
			 $this->perm_radi_sal=$rs->fields['PERM_RADI_SAL'];
			 $this->usu_direccion=$rs->fields['USU_DIRECCION'];
			 $this->usu_telefono1=$rs->fields['USU_TELEFONO1'];
			 $this->usu_telefono2=$rs->fields['USU_TELEFONO2'];
			 $this->usu_cargo=$rs->fields['USU_CARGO'];
			 $this->perm_tipif_anexo=$rs->fields['PERM_TIPIF_ANEXO'];
			 return true;		
		}else
			 return false;
}

/** 
* Genera el javascript que ha de permitir llenar un combo con los usuarios de cierta dependencia
* @return   void
*/
function comboUsuarioDependencia() {
 echo " function comboUsuarioDependencia(forma,dependencia,combo)";
        echo "{";
			 //   echo " alert ('entra a nivel educativo']; ";
				echo "o = new Array;";
				echo "i=0;";
			//	 echo " o[i++]=new Option('----- seleccione -----', 'null',true,true); ";


     $dbsql2=" SELECT usuario.*,dependencia.depe_nomb  FROM usuario,dependencia where usuario.depe_codi = dependencia.depe_codi ";
		 $rs=$this->cursor->query($dbsql2);

          while	($rs && !$rs->EOF)
			{

			echo " if (dependencia == ". $rs->fields['DEPE_CODI'] . " )  ";

			$descripcion = chop ($rs->fields['USUA_NOMB']);
			$descripcion=str_replace("'", "", $descripcion);
			echo "o[i++]=new Option('$descripcion','". $rs->fields['USUA_CODI'] ."' );";
			$rs->MoveNext();



          }








        echo " largestwidth=0; ";
        echo " for (i=0; i < o.length; i++) ";
        echo " { ";
	 // echo "  alert( '!!!entra1!!!'];";
        echo "   eval(forma.elements[combo].options[i+1]=o[i]); ";
 	 // echo "  alert( '!!!entra2!!!'];";

        echo "   if (o[i].text.length > largestwidth) ";
			  echo "   { ";
        echo "     largestwidth=o[i].text.length; ";
			  echo " }  ";
        echo " } ";
 echo " eval(forma.elements[combo].length=o.length+1); ";

			echo " } ";




}


/** 
* Genera el javascript que ha de permitir llenar un combo con los usuarios de cierta dependencia de un gupo de dependencias establecidas por el paramentro enviado a la funcion
* @param $dependencias  es el grupo de dependencias establecido
* @return   void
*/
function comboUsDepGrp($dependencias) {
 $stringDeps= implode ( ",", $dependencias );
 echo " function comboUsuarioDependencia(forma,dependencia,combo)";
        echo "{";
			 //   echo " alert ('entra a nivel educativo']; ";
				echo "o = new Array;";
				echo "i=0;";
			//	 echo " o[i++]=new Option('----- seleccione -----', 'null',true,true); ";

     // $this->cursor->conn->debug=true;
     $dbsql2=" SELECT usuario.*,dependencia.depe_nomb  FROM usuario,dependencia where usuario.depe_codi = dependencia.depe_codi and usuario.depe_codi in($stringDeps)";
		 $rs=$this->cursor->query($dbsql2);


          while	($rs && !$rs->EOF)
			{

			echo " if (dependencia == ". $rs->fields['DEPE_CODI'] . " )  ";

			$descripcion = chop ($rs->fields['USUA_NOMB']);
			$descripcion=str_replace("'", "", $descripcion);
			echo "o[i++]=new Option('$descripcion','". $rs->fields['USUA_CODI'] ."' );";
			$rs->MoveNext();

          }

        echo " largestwidth=0; ";
        echo " for (i=0; i < o.length; i++) ";
        echo " { ";
	 // echo "  alert( '!!!entra1!!!'];";
        echo "   eval(forma.elements[combo].options[i+1]=o[i]); ";
 	 // echo "  alert( '!!!entra2!!!'];";

        echo "   if (o[i].text.length > largestwidth) ";
			  echo "   { ";
        echo "     largestwidth=o[i].text.length; ";
			  echo " }  ";
        echo " } ";
 echo " eval(forma.elements[combo].length=o.length+1); ";

			echo " } ";




}


/** 
* Genera el javascript que ha de permitir llenar un combo con los usuarios de cierta dependencia de un gupo de dependencias establecidas por el paramentro enviado a la funcion, haciendo uso del parametro WHERE que llega y que filtra cierta caracteristica del usuario a seleccionar
* @param $dependencias  es el grupo de dependencias establecido
* @param $where	es el criterio de filtro para los usuarios de las dependencias seleccionadas
* @return   void
*/
function comboUsDepsWhr($dependencias, $whereFilt) {
  
$whereDeps = "";
if (count($dependencias) > 0){
 	 $stringDeps= implode ( ",", $dependencias );
 	 $whereDeps = " and usuario.depe_codi in($stringDeps) ";
 }
 echo " function comboUsuarioDependencia(forma,dependencia,combo)";
        echo "{";
			 //  echo " alert ('entra ' +  dependencia + '  ' +  combo); ";
				echo "o = new Array;";
				echo "i=0;";
			//	 echo " o[i++]=new Option('----- seleccione -----', 'null',true,true); ";

     // $this->cursor->conn->debug=true;
     $dbsql2=" SELECT usuario.*,dependencia.depe_nomb  FROM usuario,dependencia where 
                
     			usuario.depe_codi = dependencia.depe_codi  $whereDeps $whereFilt";
		 $rs=$this->cursor->query($dbsql2);


          while	($rs && !$rs->EOF)
			{

			echo " \n if (dependencia == ". $rs->fields['DEPE_CODI'] . " )  ";

			$descripcion = chop ($rs->fields['USUA_NOMB']);
			$descripcion=str_replace("'", "", $descripcion);
			echo "o[i++]=new Option('$descripcion','". trim($rs->fields['USUA_DOC']) ."' );";
			$rs->MoveNext();

          }

        echo " largestwidth=0; ";
        echo " for (i=0; i < o.length; i++) ";
        echo " { ";
	 // echo "  alert( '!!!entra1!!!');";
        echo "   eval(forma.elements[combo].options[i]=o[i]); ";
 	 // echo "  alert( '!!!entra2!!!'];";

        echo "   if (o[i].text.length > largestwidth) ";
			  echo "   { ";
        echo "     largestwidth=o[i].text.length; ";
			  echo " }  ";
        echo " } ";
        echo  (" if (o.length == 0 ) { " );
        echo  (" o[0]=new Option('----- Sin datos -----', 'null'); " );
        echo "  eval(forma.elements[combo].options[i]=o[i]); } ";
 echo " eval(forma.elements[combo].length=o.length); ";
 

			echo " } ";




}




/** 
  * Inserta un nuevo usuario en la tabla usuario
  * @param	$values	array	es el arreglo de valores a insertar, cada el elemento de arreglo esta estructurado de la forma  Array ( [NOMBRE CAMPO] => VALOR )
  * @return   void
	*/

function insertar($values) {
	$rs=$this->cursor->insert("usuario",$values);
	
	if (!$rs){
			$db->conn->RollbackTrans();
			die ("<span class='etextomenu'>No se ha podido insertar usuario usuario "); 
	}
     
}


/** 
* Retorna el valor  correspondiente al atributo numero del documento del usuario, debe invocarse antes usuarioLogin() o usuarioDependecina
* @return   string
*/
function get_usua_doc() {
	return $this->usua_doc;
}


/** 
* Retorna el valor  correspondiente al atributo nombre del usuario, debe invocarse antes usuarioLogin() o usuarioDependecina
* @return   string
*/
function get_usua_nomb() {
	return $this->usua_nomb;

}


/** 
* Carga los datos de la instacia con con  referencia a
* un documento de usuario suministrado
* @param $docto  es el documento del usuario
* @return   void
*/
function usuarioDocto($docto) 
{
	global $ADODB_COUNTRECS;
	$ADODB_COUNTRECS = true;
	$q="select * from usuario where USUA_DOC ='$docto' ";
	$rs=$this->cursor->query($q);
	$ADODB_COUNTRECS = false;
	if 	($rs->RecordCount() >0)
	{	$this->depe_codi=$rs->fields['DEPE_CODI'];
		$this->usua_pasw=$rs->fields['USUA_PASW'];
		$this->usua_nomb=$rs->fields['USUA_NOMB'];
		$this->perm_radi=$rs->fields['PERM_RADI'];
		$this->usua_nuevo=$rs->fields['USUA_NUEVO'];
		$this->usua_doc=$rs->fields['USUA_DOC'];
		$this->usua_nacim=$rs->fields['USUA_NACIM'];
		$this->usua_email=$rs->fields['USUA_EMAIL'];
		$this->perm_radi_sal=$rs->fields['PERM_RADI_SAL'];
		$this->usu_direccion=$rs->fields['USU_DIRECCION'];
		$this->usu_telefono1=$rs->fields['USU_TELEFONO1'];
		$this->usu_telefono2=$rs->fields['USU_TELEFONO2'];
		$this->usu_cargo=$rs->fields['USU_CARGO'];
		$this->usua_codi=$rs->fields['USUA_CODI'];	
		$this->perm_tipif_anexo=$rs->fields['PERM_TIPIF_ANEXO'];
	}
}

/** 
* Limpia los atributos de la instancia referentes a la informacion del usuario
* @return   void
*/
function limpiarAtributos(){

	   $this->depe_codi="";
		 $this->usua_pasw="";
		 $this->usua_nomb="";
		 $this->perm_radi="";
		 $this->usua_nuevo="";
		 $this->usua_doc="";
		 $this->usua_nacim="";
		 $this->usua_email="";
		 $this->perm_radi_sal="";
		 $this->usu_direccion="";
		 $this->usu_telefono1="";
		 $this->usu_telefono2="";
		 $this->usu_cargo="";
		 $this->perm_tipif_anexo="";
}




}


?>

