<?
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/class_control/Radicado.php"; 

/**  Esta clase gestiona las operaciones que es posible realizar sobre un grupo de documentos de correspondencia masiva
* @author Sixto Angel Pinzon Lopez
*	@version     1.0
*/  
class GrupoMasiva 
{

  /**
   * Vector que almacena el conjunto de radicados sacados de un grupo de masiva
   * @var array
   * @access public
   */
	var $grupoSacado;
/**
   * Gestor de las transacciones con la base de datos
   * @var ConnectionHandler
   * @access public
   */
  var $cursor;
/**
   * Vector que almacena el conjunto de radicados de un grupo de masiva
   * @var string
   * @access public
   */
	var $vecRads;
/**
   * Guarda el primer radicado local
   * @var string
   * @access public
   */
	var $radPrimLocal;
/**
   * Guarda el primer radicado nacional
   * @var string
   * @access public
   */
	var $radPrimNacional;
/**
   * Guarda el primer radicado internacional Grupo1
   * @var string
   * @access public
   */
	var $radPrimG1;
/**
   * Guarda el primer radicado internacional Grupo2
   * @var string
   * @access public
   */
	var $radPrimG2;
/**
   * Guarda sgd_renv_codigo del query
   * @var string
   * @access public
   */
	var $sgd_renv_codigo;

	
/** 
* Constructor encargado de obtener la conexion
* @param	$db	ConnectionHandler es el objeto conexion
* @return   void
*/
	function GrupoMasiva($db) {
	
		$this->cursor = & $db;
	
	}
	
	
/** 
* Realiza la transacccion de sacar un radicado del grupo de envio de masiva
* @param $grupo	string	es el codigo del radicado del grupo
* @param $codRadicado	string	es el codigo del radicado a sacar
*/
	function sacarDeGrupo($grupo,$codRadicado)  {
		
		//Arreglo que almacena los valores que ha de tomar cada columna
		$values["sgd_rmr_radi"] = $codRadicado;
		$values["sgd_rmr_grupo"] = $grupo;
		$rs=$this->cursor->insert("sgd_rmr_radmasivre",$values);
		if (!$rs){
			$this->cursor->conn->RollbackTrans();
			die ("<span class='etextomenu'>No se ha podido actualizar sgd_rmr_radmasivre "); 
		}
  }
	
	
/** 
* Realiza la transacccion de incluir nuevamente un radicado en su grupo de envio de masiva
* @param	$grupo	string	es el codigo del radicado del grupo
* @param $codRadicado	string	es el codigo del radicado a incluir
*/	
 function incluirEnGrupo($grupo,$codRadicado)  {
		$values["sgd_rmr_radi"] = $codRadicado;
		$values["sgd_rmr_grupo"] = $grupo;
		$rs=$this->cursor->delete("sgd_rmr_radmasivre",$values);
		if (!$rs){
			$this->cursor->conn->RollbackTrans();
			die ("<span class='etextomenu'>No se ha podido borrar de  sgd_rmr_radmasivre "); 
		}
		
  }


/** 
* Obtiene los radicados de un grupo de masiva y pone esta informacion en los atributos  vecRads y sgd_renv_codigo
* @param $dependencia	string	es la dependencia del grupo
* @param $grupo	string	es el codigo del radicado del grupo
* @param $filtro	string	es un subconjunto de radicados, en caso de tratarse de de una busqueda especifica
* @return   array
*/	
 function obtenerGrupo($dependencia,$grupo,$filtro) 
  {
  	if (strlen($filtro)>0){
			$qFiltro="and radi_nume_sal in ($filtro)"; 
		}else{
			$qFiltro="";
		}
		//almacena el query
		$db = &$this->cursor;
		include ($this->cursor->rutaRaiz."/include/query/class_control/queryGrupoMasiva.php");
		//print ("---->".$qeryObtenerGrupo);		
		$rs=$this->cursor->query($qeryObtenerGrupo);
		
		//Recorre el resultado de la busqueda
		while   ($rs && !$rs->EOF){
			$this->vecRads[]=$rs->fields['RADI_NUME_SAL'];
			$this->sgd_renv_codigo=$rs->fields['SGD_RENV_CODIGO'];
			$rs->MoveNext();
		}
		return($this->vecRads);

  }

	
/** 
* Obtiene los radicados de un grupo de masiva que han sido sacados de este y pone esta informacion en el atributo grupoSacado
* @param $grp	string	es el codigo del radicado del grupo
* @return   array
*/		
function setGrupoSacado($grp)
  {
		//almacena el query
  	$q= "select *  from sgd_rmr_radmasivre  where sgd_rmr_grupo=$grp";
		$rs=$this->cursor->query($q);
		
		//Recorre el resultado de la busqueda
		while   ($rs && !$rs->EOF){
			$this->grupoSacado[]=$rs->fields['SGD_RMR_RADI'];
			$rs->MoveNext();
		}
  }

	
/** 
* Obtiene el numero de radicados de un grupo de masiva que han dido sacados de este; antes de invocar esta funcion debe invocarse setGrupoSacado()
* @return	int
*/			
function getNumeroSacados(){     
		return (count($this->grupoSacado));
	
}


/** 
* Limpia el arreglo que contiene los radicados sacados de un grupo de masiva
*/
function limpiarGrupoSacado(){

	if (count($this->grupoSacado)>0)
		array_splice($this->grupoSacado,0);
	
	}

	
/** 
* Retorna verdadero si un radicado ha sido retirado de un grupo de masiva, de lo contrario falso
* @param $grupo	string	es el codigo del radicado del grupo
* @param $radicado	string	es el radicado a analizar
* @return   boolean
*/		
function radicadoRetirado($grupo,$radicado){
		//almacena el query
		$q= "select *  from sgd_rmr_radmasivre  where sgd_rmr_grupo=$grupo and sgd_rmr_radi=$radicado";
		$rs=$this->cursor->query($q);

		//Si fue retirado el radicado
		if   ($rs && !$rs->EOF){
			return true;
		}else{
		 	return false;
		}
	}

	
/** 
* Obtiene los radicados limite de un grupo de masiva en la posicion 0 se encuentra el limite inferior y en la 1 el superior. Antes de invocar esta funcion debe llamarse a obtenerGrupo()
* @return   array
*/	
function getRadsLimite(){
		$limite[0]=$this->vecRads[0];
		$limite[1]=$this->vecRads[count($this->vecRads)-1];
	  return ($limite);
}


/** 
* Obtiene el numero de radicados nacionales y locales que existen en un grupo de masiva
* en los indices 'local' y 'nacional'
* @param $depe_dpto_cod	int	es codigo del departamento de la dependencia actual
* @param $depe_muni_cod	int	es el codigo del municipio de la dependencia actual
* @return   array
*/		
function getNumNacionalesLocales($cont_cod, $pais_cod, $dpto_cod,$muni_cod)
{
	$rad = & new Radicado($this->cursor);
	$num = count($this->vecRads);
	reset($this->vecRads);
	$i = 0;
	$local=0;
	$nacional=0;
	$grupo1=0;
	$grupo2=0;
	// Recorre el vector del grupo de radicados	
	while ($i < $num)
	{	
		$rad->radicado_codigo($this->vecRads[$i]);
		//Si el radicado no ha sido retirado
		if (!$this->radicadoRetirado($this->vecRads[0],$this->vecRads[$i]))
		{
			$datosRad = $rad->getDatosRemitente();
			//Hacemos los calculos de internacional grupo 1/2 y envios local/nacional
			if ($datosRad["contCodi"] == $cont_cod)	//Si va para el mismo continente
			{
				if ($datosRad["paisCodi"] == $pais_cod)	//Si va para el mismo pais
				{	//Hacemos la validacion de si es local, aca hay un codigo metido a machetazo el cual
					//valida unos municipios que actuan como precio local en algunos dptos, hay que 
					//cambiar esta validacion para que tome los datos de homologacion de precios capturados
					//en el administrador de municipios.
					if ( (($datosRad["deptoCodi"] == $dpto_cod) && ($datosRad["muniCodi"] == $muni_cod)) ||
						  ($pais_cod==170 && $dpto_cod==68 && 
						  	($datosRad["muniCodi"]==547||$datosRad["muniCodi"]==276||$datosRad["muniCodi"]==307))
						) //Si va para la misma ciudad
					{
						$local++;
						if	($local==1)	$this->radPrimLocal=$this->vecRads[$i];
					}
					else 
					{
						$nacional++;
						if	($nacional==1)	$this->radPrimNacional=$this->vecRads[$i];
					}
				}
				else 
				{
					$grupo1++;
					if	($grupo1==1)	$this->radPrimG1=$this->vecRads[$i];
				}
			}
			else 
			{
				$grupo2++;
				if	($grupo2==1)	$this->radPrimG2=$this->vecRads[$i];
			}
		}	
		$i++; 
	}
	$resultado["local"] = $local;
	$resultado["nacional"] = $nacional;
	$resultado["grupo1"] = $grupo1;
	$resultado["grupo2"] = $grupo2;
	return ($resultado);
}

	
/** 
* Escribe la funcion de calcular el precio de un grupo de radicados a enviar
* @return   string
*/		
function javascriptCalcularPrecio($l, $n, $g1, $g2)
{
	$isql = "SELECT a.SGD_FENV_CODIGO,a.SGD_TAR_CODIGO,a.SGD_CLTA_CODSER,a.SGD_CLTA_DESCRIP,
  				a.SGD_CLTA_PESDES,a.SGD_CLTA_PESHAST,b.SGD_TAR_VALENV1,b.SGD_TAR_VALENV2,b.SGD_TAR_VALENV1G1,b.SGD_TAR_VALENV2G2 
  			FROM SGD_CLTA_CLSTARIF a,SGD_TAR_TARIFAS b 
  			WHERE a.SGD_FENV_CODIGO=b.SGD_FENV_CODIGO AND a.SGD_TAR_CODIGO=b.SGD_TAR_CODIGO 
  				AND a.SGD_CLTA_CODSER=b.SGD_CLTA_CODSER
			ORDER BY a.SGD_FENV_CODIGO,a.SGD_CLTA_PESDES,a.SGD_CLTA_CODSER";
	$rs=$this->cursor->conn->Execute($isql);
	echo "function calcular_precio(empresa_envio,envio_peso,valor_gr)\n";
  	echo "{\tvar valor_local=0; var valor_fuera=0; var valor_grupo1=0; var valor_grupo2=0;\n";
	echo "\tif (parseFloat(document.getElementById(envio_peso).value)>=0)\n{\n\t";
		
	//Recorre el resultado de la busqueda
	while  ($rs && !$rs->EOF)
	{
		$valor_local = $rs->fields['SGD_TAR_VALENV1']+0;
		$valor_fuera = $rs->fields['SGD_TAR_VALENV2']+0;
		$valor_certificado = $rs->fields['SGD_TAR_VALENV1']+0;
		$valor_g1 = $rs->fields['SGD_TAR_VALENV1G1']+0;
		$valor_g2 = $rs->fields['SGD_TAR_VALENV2G2']+0;
		$rango = $rs->fields['SGD_CLTA_DESCRIP'];
		$fenvio = $rs->fields['SGD_FENV_CODIGO']; 
		
		echo "\nif(document.getElementById(empresa_envio).value==$fenvio)\n\t{\n";
		echo "\tif(parseFloat(document.getElementById(envio_peso).value)>=".$rs->fields['SGD_CLTA_PESDES']." &&  parseFloat(document.getElementById(envio_peso).value)<=".$rs->fields['SGD_CLTA_PESHAST'] .")\n";
		echo  "\t\t{\n\t\tdocument.getElementById(valor_gr).value = '$rango';
			";	
		if ($l >0 || $n>0)
		{	echo	"if (valor_local == 0) valor_local = $valor_local;
					 if (valor_fuera == 0) valor_fuera = $valor_fuera;";
		}
		if ($g1>0 || $g2>0)
		{	echo 	"if (valor_grupo1 == 0) valor_grupo1 = $valor_g1;
					 if (valor_grupo2 == 0) valor_grupo2 = $valor_g2;";
		}
		echo "}\t}\n\t";
		$rs->MoveNext();
	}

	echo "peso = document.getElementById('envio_peso').value+0;\n\t";
	if ($l >0 || $n>0)
	{	echo "document.getElementById('valor_unit_local').value = valor_local;\n\t";
		echo "document.getElementById('valor_unit_nacional').value = valor_fuera;\n\t";
		echo "valor_local = valor_local  * $l;\n\t";
		echo "valor_fuera = valor_fuera  * $n;\n\t";
		echo "document.getElementById('valor_total_local').value = valor_local;\n\t";
		echo "document.getElementById('valor_total_nacional').value = valor_fuera;\n\t";
	}
	if ($g1>0 || $g2>0)
	{	echo "document.getElementById('valor_unit_grupo1').value = valor_grupo1;\n\t";
		echo "document.getElementById('valor_unit_grupo2').value = valor_grupo2;\n\t";
		echo "valor_grupo1 = valor_grupo1* $g1;\n\t";
		echo "valor_grupo2 = valor_grupo2* $g2;\n\t";
		echo "document.getElementById('valor_total_grupo1').value = valor_grupo1;\n\t";
		echo "document.getElementById('valor_total_grupo2').value = valor_grupo2;\n\t";
	}
	echo "document.getElementById('valor_total').value = valor_local + valor_fuera + valor_grupo1 + valor_grupo2;\n";
	echo	"} else { ";
	echo " alert('Debe suminstrar el peso de los documentos'); ";
	echo "}\n}\n";
}

/** 
* Obtiene el primer radicado local de un grupo. Antes de invocar esta funcion debe llamarse a obtenerGrupo()  y a getNumNacionalesLocales()
* @return   string
*/			
	function getPrimerRadicadoLocal(){
		return ($this->radPrimLocal);
	}	


/** 
* Obtiene el primer radicado nacional de un grupo. Antes de invocar esta funcion debe llamarse a obtenerGrupo()  y a getNumNacionalesLocales()
* @return   string
*/		
	function getPrimerRadicadoNacional(){
		return($this->radPrimNacional);
	}	

	/** 
* Obtiene el primer radicado Internacional grupo 1 de un grupo. Antes de invocar esta funcion debe llamarse a obtenerGrupo()  y a getNumNacionalesLocales()
* @return   string
*/			
	function getPrimerRadicadoGrupo1()
	{
		return ($this->radPrimG1);
	}	


/** 
* Obtiene el primer radicado Internacional grupo 2 de un grupo. Antes de invocar esta funcion debe llamarse a obtenerGrupo()  y a getNumNacionalesLocales()
* @return   string
*/		
	function getPrimerRadicadoGrupo2()
	{
		return($this->radPrimG2);
	}

/** 
* Obtiene sgd_renv_codigo() de un grupo. Antes de invocar esta funcion debe llamarse a obtenerGrupo()  
* @return   string
*/	
	function getSgd_renv_codigo(){
		return ($this->sgd_renv_codigo);
	}
} 
?>
