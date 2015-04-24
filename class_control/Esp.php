<?php
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
require_once("$ruta_raiz/class_control/Departamento.php");
require_once("$ruta_raiz/class_control/Municipio.php");
require_once("$ruta_raiz/include/pdf/class.ezpdf.inc");

/**
 * Esp es la clase encargada de gestionar las operaciones y los datos basicos referentes a una ESP
 * @author	Sixto Angel Pinzon
 * @version	1.0
 */
class Esp {

/**
   * Variables que se corresponde con su par, uno de los campos de la tabla BODEGA_EMPRESAS
   * @var string
   * @access public
   */
	var $identificador;
	var $nombre;
	var $direccion;
	var $paisCodi;
	var $deptoCodi;
	var $muniCodi;
	var $nuir;
	var $cursor;



/**
* Constructor encargado de obtener la conexion
* @param	$db	ConnectionHandler es el objeto conexion
* @return   void
*/
	function Esp($db) {
		$this->cursor = $db;
	}


/**
* Retorna el valor string correspondiente al atributo nombre del la ESP, debe invocarse antes Esp_codigo() o   Esp_nombre()
* @return	string
*/
	function getNombre() {
		return  $this->nombre;
	}


/**
* Retorna el valor entero correspondiente al atributo indentificados de la ESP, debe invocarse antes Esp_codigo() o   Esp_nombre()
* @return	int
*/
	function getIdentificador() {
		return $this->identificador;
	}


 /**
  * Carga los datos de la instacia con con  referencia a un codigo de ESP suministrado retorna falso si no lo encuentra, de lo contrario true
  * @param	$codigo	string es el codigo del departamento
	* @return   boolean
  */
	function Esp_codigo($codigo){
  //almacena el query
		$q= "select *  from bodega_empresas where identificador_empresa =$codigo";
		$rs=$this->cursor->query($q);

		if  (!$rs->EOF){

			//$this->sgd_tpr_codigo=$rs->fields['dpto_codi'];
			//$this->sgd_tpr_descrip=$rs->fields['dpto_nomb'];
			$this->nombre = $rs->fields['NOMBRE_DE_LA_EMPRESA'];
			$this->direccion = $rs->fields['DIRECCION'];
			$this->paisCodi = $rs->fields['ID_PAIS'];
			$this->deptoCodi = $rs->fields['CODIGO_DEL_DEPARTAMENTO'];
			$this->muniCodi = $rs->fields['CODIGO_DEL_MUNICIPIO'];
			$this->nuir  = $rs->fields['NUIR'];
			$this->identificador =  $codigo;
			return true;

		}else
		return false;
	}


 /**
  * Carga los datos de la instacia con  referencia a  un nombre de ESP suministrado retorna falso si no lo encuentra, de lo contrario true
  * @param	$nombre	string	de la ESP
	* @return   boolean
  */
	function Esp_nombre($nombre){
  //almacena el query
		$q= "select *  from BODEGA_EMPRESAS
             where NOMBRE_DE_LA_EMPRESA='$nombre'";
		$rs=$this->cursor->query($q);

		if  (!$rs->EOF){

			//$this->sgd_tpr_codigo=$rs->fields['dpto_codi'];
			//$this->sgd_tpr_descrip=$rs->fields['dpto_nomb'];
			$this->nombre = $rs->fields['NOMBRE_DE_LA_EMPRESA'];
			$this->direccion = $rs->fields['DIRECCION'];
			$this->paisCodi = $rs->fields['ID_PAIS'];
			$this->deptoCodi = $rs->fields['CODIGO_DEL_DEPARTAMENTO'];
			$this->muniCodi = $rs->fields['CODIGO_DEL_MUNICIPIO'];
			$this->nuir  = $rs->fields['NUIR'];
			$this->identificador = $rs->fields['IDENTIFICADOR_EMPRESA'];
			return true;

		}else
			return false;
	}


	 /**
  * Carga los datos de la instacia con  referencia a  un nit de ESP suministrado retorna falso si no lo encuentra, de lo contrario true
  * @param	$nit	string	de la ESP
	* @return   boolean
  */
function Esp_nit($nit){
  //almacena el query

		$q= "select *  from BODEGA_EMPRESAS
             where nit_de_la_empresa ='$nit'";
	  $rs=$this->cursor->query($q);

		if  (!$rs->EOF&&$rs!=false){

			//$this->sgd_tpr_codigo=$rs->fields['dpto_codi'];
			//$this->sgd_tpr_descrip=$rs->fields['dpto_nomb'];
			$this->nombre = $rs->fields['NOMBRE_DE_LA_EMPRESA'];
			$this->direccion = $rs->fields['DIRECCION'];
			$this->paisCodi = $rs->fields['ID_PAIS'];
			$this->deptoCodi = $rs->fields['CODIGO_DEL_DEPARTAMENTO'];
			$this->muniCodi = $rs->fields['CODIGO_DEL_MUNICIPIO'];
			$this->identificador = $rs->fields['IDENTIFICADOR_EMPRESA'];
			$this->nuir  = $rs->fields['NUIR'];
			return true;

		}else
			return false;
	}


/**
* Retorna el valor entero correspondiente al atributo indentificados de la ESP, debe invocarse antes Esp_codigo() o   Esp_nombre()
* @return   int
*/
	function getId(){
		return ($this->identificador);
	}


	/**
* Retorna el valor string correspondiente al atributo nuir de la ESP, debe invocarse antes Esp_codigo() o   Esp_nombre()  o Esp_nit()
* @return   string
*/
	function getNuir(){
		return ($this->nuir);
	}


/**
* Retorna el valor  correspondiente al atributo codigo del departameto de la ESP, debe invocarse antes Esp_codigo() o   Esp_nombre() o Esp_nit()
* @return   string
*/
	function getDeptoCodi(){
		return ($this->deptoCodi);
	}


/**
* Retorna el valor  correspondiente al atributo codigo del municipio de la ESP, debe invocarse antes Esp_codigo() o   Esp_nombre() o Esp_nit()
* @return   string
*/
	function getMuniCodi(){
		return ($this->muniCodi);
	}


/**
 * Genera un archivo CSV con la informacion de las empresas que recibe como parametro
 * @param	$archivo	string	con el archivo a crear
 * @param	$s(0/1/2/)	string	con las (ESP/Empresas/Ciudadanos) seleccionadas
 * @param	$sc(0/1/2)	string	con los contactos de las (ESP/Empresas/Ciudadanos) seleccionados
 * @return   string
*/
function generarCSV($archivo,$s0,$sc0,$s1 = null,$s2 = null,$sc1 = null, $sc2 = null)
{
$depto = new Departamento($this->cursor);
$muni = new Municipio($this->cursor);
$com = chr(34);
$contenido="$com*TIPO*$com,$com*NOMBRE*$com,$com*DIR*$com,$com*MUNI_NOMBRE*$com,$com*DEPTO_NOMBRE*$com,$com*PAIS_NOMBRE*$com,$com*NUIR*$com,$com*NOMBRE_REP*$com,$com*DIGNATARIO*$com,$com*CARGO*$com\n";
for ($i=0; $i<3; $i++)	//Ciclo de 0 a 2 para cubrir los 3 vectores de seleccionados
{ 	if (${'s'.$i})		//Si se envio el vector....
	{
		//arreglo con las empresas seleccionadas
		$arrEmpresas = explode ( ",", ${'s'.$i});
		$arrContacto = explode ( ",", ${'sc'.$i});
		//variable que almacena la cantidad de empresas que llegarom como par�metro
		$num = count($arrEmpresas);
		$x = 0;

		//Se recorre el arreglo de las empresas para armar el IN dentro del where de la b�squeda
		while ($x < $num)
		{
			$nuir=$arrEmpresas[$x];
			//si hay un nuir a analizar
			if (strlen(trim($nuir))>0)
			{	if (strlen($selectedSQL))
					$selectedSQL=$selectedSQL.","."'$nuir'";
				else
	  				$selectedSQL="'$nuir'";
		 	}
			$x++;
		}
		//query final
	  	switch ($i)
	  	{	case 0:
	  			{	$q= "select ID_PAIS AS IDPAIS,CODIGO_DEL_DEPARTAMENTO AS IDDPTO,CODIGO_DEL_MUNICIPIO AS IDMPIO,NUIR AS NUIR,
	  						NOMBRE_DE_LA_EMPRESA AS PPAL,DIRECCION AS DIR,IDENTIFICADOR_EMPRESA AS ID,NOMBRE_REP_LEGAL AS DESCR
	  					from BODEGA_EMPRESAS where IDENTIFICADOR_EMPRESA in ($selectedSQL) ORDER BY CODIGO_DEL_DEPARTAMENTO, CODIGO_DEL_MUNICIPIO, NOMBRE_DE_LA_EMPRESA";
	  			}break;
	  		case 1:
	  			{	$q= "select ID_PAIS AS IDPAIS,DPTO_CODI AS IDDPTO,MUNI_CODI AS IDMPIO,SGD_OEM_OEMPRESA AS PPAL,
	  						SGD_OEM_DIRECCION AS DIR,SGD_OEM_CODIGO AS ID,SGD_OEM_REP_LEGAL AS DESCR
	  					from SGD_OEM_OEMPRESAS where SGD_OEM_CODIGO in ($selectedSQL) ORDER BY IDDPTO, IDMPIO, SGD_OEM_OEMPRESA";
	  			}break;
	  		case 2:
	  			{	$q= "select ID_PAIS AS IDPAIS,DPTO_CODI AS IDDPTO,MUNI_CODI AS IDMPIO,SGD_CIU_NOMBRE AS PPAL,
	  						SGD_CIU_DIRECCION AS DIR,SGD_CIU_CODIGO AS ID,SGD_CIU_APELL2  AS DESCR
	  					from SGD_CIU_CIUDADANO where SGD_CIU_CODIGO in ($selectedSQL) ORDER BY IDDPTO, IDMPIO, SGD_CIU_NOMBRE";
	  			}break;
	  	}
		$selectedSQL = "";
		$rs=$this->cursor->query($q);

		//recorre el grupo de empresas
		while (!$rs->EOF )
		{	$codDepto=$rs->fields['IDPAIS'].'-'.$rs->fields['IDDPTO'];
			if (strlen(trim($codDepto))==0)	$codDepto="<ESPACIO>";

			$codMuni=$codDepto.'-'.$rs->fields['IDMPIO'];

			if (strlen(trim($codMuni))==0)	$codMuni="<ESPACIO>";

			$depto->departamento_codigo($codDepto);
			$muni->municipio_codigo($codDepto,$codMuni);
			$nombDepto=$depto->get_dpto_nomb();
			if (strlen($nombDepto)==0)	$nombDepto="<ESPACIO>";

			$nombMuni=$muni->get_muni_nomb();
			if (strlen($nombMuni)==0)	$nombMuni="<ESPACIO>";

			// Trae nombre del pais
			$tmp_rs = $this->cursor->query("SELECT NOMBRE_PAIS FROM SGD_DEF_PAISES WHERE ID_PAIS=".$rs->fields['IDPAIS']);
			if ($tmp_rs)
			{	(trim($tmp_rs->fields['NOMBRE_PAIS']) == "") ? $nombPais = "<ESPACIO>" : $nombPais = $tmp_rs->fields['NOMBRE_PAIS'];
				$tmp_rs->Close();
				unset($tmp_rs);
			}
			else $nombPais = "<ESPACIO>";

			$nombESP = $rs->fields['PPAL'];
			if (strlen(trim($nombESP))==0)	$nombESP="<ESPACIO>";

			$dirESP = $rs->fields['DIR'];
			if (strlen(trim($dirESP))==0)	$dirESP="<ESPACIO>";

			$nuir =  $rs->fields['ID'];
			if (strlen(trim($nuir))==0)	$nuir="<ESPACIO>";

			$nomRepESP = $rs->fields['DESCR'];
			if (strlen(trim($nomRepESP))==0)	$nomRepESP="<ESPACIO>";

			// Trae nombre del dignatario
			reset($arrEmpresas);
			$tmp_var = array_search($nuir,$arrEmpresas);
			$tmp_vec = explode(",",$contactos);
			$tmp_rs = $this->cursor->query("SELECT CTT_NOMBRE,CTT_CARGO FROM SGD_DEF_CONTACTOS WHERE CTT_ID=".$tmp_vec[$tmp_var]);
			if($tmp_rs)
			{	(trim($tmp_rs->fields['CTT_NOMBRE']) == "") ? $dignatario = "<ESPACIO>" : $dignatario = $tmp_rs->fields['CTT_NOMBRE'];
				(trim($tmp_rs->fields['CTT_CARGO']) == "") ? $cargo = "<ESPACIO>" : $cargo = $tmp_rs->fields['CTT_CARGO'];
				$tmp_rs->Close();
				unset($tmp_rs);
			}
			else
			{	$dignatario = "<ESPACIO>";
				$cargo = "<ESPACIO>";
			}

			$contenido= $contenido ."$i,$com$nombESP$com,$com$dirESP$com,$com$nombMuni$com,$com$nombDepto$com,$com$nombPais$com,$com$nuir$com,$com$nomRepESP$com,$com$dignatario$com,$com$cargo$com\n";
			$rs->MoveNext();
		}
		$rs->Close();
	}
	//referencia al archivo
	$fp=fopen($archivo,"wb");
	fputs($fp,$contenido);
	fclose($fp);
}}

/**
 * Genera un archivo PDF con la informacion de las empresas que recibe como parametro
 * @param	$s(0/1/2/)	string	con las (ESP/Empresas/Ciudadanos) seleccionadas
 * @param	$ruta_raiz	string	con el path a la raiz de ORFEO
 * @param	$archivo	string	con el archivo a crear
 * @param	$sc(0/1/2)	string	con los contactos de las (ESP/Empresas/Ciudadanos) seleccionados
  * @return   string
*/
function generarPDF($s0,$ruta_raiz,$archivo,$sc0,$s1 = null,$s2 = null,$sc1 = null, $sc2 = null)
{
$pdf =  new Cezpdf("LETTER","landscape");
$justCentro = array("justification"=>"center");
$estilo1 = array("justification"=>"left","leading"=>8);
$estilo2 = array("left"=>0,"leading"=>12);
$estilo3 = array("left"=>0,"leading"=>15);
$pdf->ezSetCmMargins(4,3,4,2);//top,botton,left,right
// Se establece la fuente que se utilizara para el texto.
$pdf->selectFont($ruta_raiz."/include/pdf/fonts/Times-Roman.afm");
$pdf->ezText("LISTADO PREVIO REGISTROS SELECCIONADOS\n\n",15,$justCentro);
$txtformat = "Se ha seleccionado:";

$data = array();
$y=0;
//variable que almacena el caracter comilla
$com = chr(34);
//variable que almacena el contenido del archivo
$contenido="$com*TIPO*$com,$com*NOMBRE*$com,$com*DIR*$com,$com*MUNI_NOMBRE*$com,$com*DEPTO_NOMBRE*$com,$com*PAIS_NOMBRE*$com,$com*NUIR*$com,$com*NOMBRE_REP*$com,$com*DIGNATARIO*$com,$com*CARGO*$com\n";
$depto = new Departamento($this->cursor);
$muni = new Municipio($this->cursor);
for ($i=0; $i<3; $i++)	//Ciclo de 0 a 2 para cubrir los 3 vectores de seleccionados
{ 	if (${'s'.$i})		//Si se envio el vector....
	{
		//arreglo con las empresas seleccionadas
		$arrEmpresas = explode ( ",", ${'s'.$i});
		$arrContacto = explode ( ",", ${'sc'.$i});
		//variable que almacena la cantidad de empresas que llegarom como parametro
		$num = count($arrEmpresas);
		$x = 0;

		//Se recorre el arreglo de las empresas para armar el IN dentro del where de la busqueda
		while ($x < $num)
		{ 	$nuir=$arrEmpresas[$x];
			if (strlen(trim($nuir))>0)
			{	if (strlen($selectedSQL))
					$selectedSQL=$selectedSQL.","."'$nuir'";
				else
		  			$selectedSQL="'$nuir'";
	 		}
	 		$x++;
		}

	  	//query final
	  	switch ($i)
	  	{	case 0:
	  			{	$q= "select ID_PAIS AS IDPAIS,CODIGO_DEL_DEPARTAMENTO AS IDDPTO,CODIGO_DEL_MUNICIPIO AS IDMPIO,NUIR AS NUIR,
	  						NOMBRE_DE_LA_EMPRESA AS PPAL,DIRECCION AS DIR,IDENTIFICADOR_EMPRESA AS ID,NOMBRE_REP_LEGAL AS DESCR
	  					from BODEGA_EMPRESAS where IDENTIFICADOR_EMPRESA in ($selectedSQL) ORDER BY CODIGO_DEL_DEPARTAMENTO, CODIGO_DEL_MUNICIPIO, NOMBRE_DE_LA_EMPRESA";
	  			}break;
	  		case 1:
	  			{	$q= "select ID_PAIS AS IDPAIS,DPTO_CODI AS IDDPTO,MUNI_CODI AS IDMPIO,SGD_OEM_OEMPRESA AS PPAL,
	  						SGD_OEM_DIRECCION AS DIR,SGD_OEM_CODIGO AS ID,SGD_OEM_REP_LEGAL AS DESCR
	  					from SGD_OEM_OEMPRESAS where SGD_OEM_CODIGO in ($selectedSQL) ORDER BY IDDPTO, IDMPIO, SGD_OEM_OEMPRESA";
	  			}break;
	  		case 2:
	  			{	$q= "select ID_PAIS AS IDPAIS,DPTO_CODI AS IDDPTO,MUNI_CODI AS IDMPIO,SGD_CIU_NOMBRE AS PPAL,
	  						SGD_CIU_DIRECCION AS DIR,SGD_CIU_CODIGO AS ID,SGD_CIU_APELL2  AS DESCR
	  					from SGD_CIU_CIUDADANO where SGD_CIU_CODIGO in ($selectedSQL) ORDER BY IDDPTO, IDMPIO, SGD_CIU_NOMBRE";
	  			}break;
	  	}
		$selectedSQL = "";
	  	$rs=$this->cursor->query($q);
		while (!$rs->EOF )
		{	$y++;
			$paisCodi=$rs->fields['IDPAIS'];
			$codDepto=$paisCodi.'-'.$rs->fields['IDDPTO'];
			$codMuni=$codDepto.'-'.$rs->fields['IDMPIO'];
			$depto->departamento_codigo($codDepto);
			$muni->municipio_codigo($codDepto,$codMuni);
			$nombDepto=$depto->get_dpto_nomb();
			$nombMuni=$muni->get_muni_nomb();
			// Trae nombre del pais
			$tmp_rs = $this->cursor->query("SELECT NOMBRE_PAIS FROM SGD_DEF_PAISES WHERE ID_PAIS=".$paisCodi);
			if ($tmp_rs)
			{	(trim($tmp_rs->fields['NOMBRE_PAIS']) == "") ? $nombPais = "<ESPACIO>" : $nombPais = $tmp_rs->fields['NOMBRE_PAIS'];
				$tmp_rs->Close();
				unset($tmp_rs);
			}
			else $nombPais = "<ESPACIO>";
			$nombESP = $rs->fields['PPAL'];
			$dirESP = $rs->fields['DIR'];
			$nuir =  $rs->fields['ID'];
			$nomRepESP = $rs->fields['DESCR'];

			// Trae nombre del dignatario
			reset($arrEmpresas);
			$tmp_var = array_search($nuir,$arrEmpresas);
			$tmp_vec = explode(",",${'sc'.$i});
			$tmp_rs = $this->cursor->query("SELECT CTT_NOMBRE,CTT_CARGO FROM SGD_DEF_CONTACTOS WHERE CTT_ID=".$tmp_vec[$tmp_var]);
			if($tmp_rs)
			{	(trim($tmp_rs->fields['CTT_NOMBRE']) == "") ? $dignatario = "<ESPACIO>" : $dignatario = $tmp_rs->fields['CTT_NOMBRE'];
				(trim($tmp_rs->fields['CTT_CARGO']) == "") ? $cargo = "<ESPACIO>" : $cargo = $tmp_rs->fields['CTT_CARGO'];
				$tmp_rs->Close();
				unset($tmp_rs);
			}
			else
			{	$dignatario = "";
				$cargo ="";
			}

			$contenido= $contenido ."$i,$com$nombESP$com,$com$dirESP$com,$com$nombMuni$com,$com$nombDepto$com,$com$nombPais$com,$com$nuir$com,$com$nomRepESP$com,$com$dignatario$com,$com$cargo$com\n";
			$data =  array_merge ($data,array (array('#'=>$y,'Tipo'=>$i,'Nombre'=>$nombESP,'Direcci�n'=>$dirESP,'Pa�s'=>$nombPais,'Departamento'=>$nombDepto,'Municipio'=>$nombMuni,'Nuir'=>$nuir,'Representante'=>$nomRepESP,'Dignatario'=>$dignatario,'Cargo'=>$cargo)));
			$rs->MoveNext();
	}	}	}
$pdf->ezTable($data,'','',array('fontSize'=>6,'width'=>700));
//Referencia el PDF a generar
$pdfcode = $pdf->ezOutput();
$fp=fopen($archivo,'wb');
fwrite($fp,$pdfcode);
fclose($fp);
}
}
?>
