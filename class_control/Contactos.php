 <?php
/**
 * Contactos es la clase encargada de gestionar la informacion referente a los contactos de empresas
 * @author      Hollman Ladino Paredes
 * @version     1.0
 */
 class Contactos
 {

	/**
	* Constructor encargado de crear la conexion
	* @param	$db	ConnectionHandler es el objeto conexion
	* @return   void
	*/
	function Contactos($db)
	{
		$this->cursor = $db;
	}


	/**
	* Funcion encargado de crear un recordset con los contactos de una empresa.
	* @param	$tipo	0=Entidad  1=Empresas
	* @param	$id_emp	Id de la empresa a buscar contactos
	* @return   recordset
	*/
	function &SelectContactos($tipo, $id_emp)
	{	//$tipo += 1;
		$sql='SELECT CTT_NOMBRE AS NOMBRE, CTT_ID AS ID, CTT_CARGO AS CARGO, CTT_TELEFONO AS TELEFONO FROM SGD_DEF_CONTACTOS WHERE CTT_ID_TIPO='.$tipo.' AND CTT_ID_EMPRESA='.$id_emp;
		$Rs_ctt = $this->cursor->query($sql);
		unset($sql);
		return $Rs_ctt;
	}

	/**
	* Funcion encargado de crear un vector asocciativo con indice incremental.
	* @param	$tmp_rs	Recordset
	* @return   $tmp_vector	Vector
	*/
	function &GetVector($tmp_rs)
	{	if ($tmp_rs)
		{	$it = 0;
			$vmcposv = array();
			while (!$tmp_rs->EOF)
			{	for ($i=0; $i<$tmp_rs->FieldCount(); $i++)
				{	$tmp = $tmp_rs->FetchField($i);
					$vmcposv[$it][strtoupper($tmp->name)] = $tmp_rs->fields[strtoupper($tmp->name)];
				}
				$it += 1;
				$tmp_rs->MoveNext();
			}
			unset($tmp_rs);
			unset($it);
			unset($i);
			unset($tmp);
			return $vmcposv;
		}
		else return false;
	 }
	 /**
	  * Imprime un Combo con los contactos de una empresa.
	  * @param int $tipo_tb 0= Entidad(Bodega_empresas)    1 = Empresas (SGD_OEM_OEMPRESAS).
	  * @param int $id_emp Id de la empresa a crear el combo de contactos.
	  * @param int $id_defa Id del menu a seleccionar.
	  */
	 function &GetMenuCnt ($tipo_tb,$id_emp,$id_defa)
	 {	// 1er parametro. ===> 0= Entidad(Bodega_empresas)    1 = Empresas (SGD_OEM_OEMPRESAS)
	 	$tmp_rs = $this->SelectContactos($tipo_tb,$id_emp);
	 	$nombre = "slc_ctt[".$id_emp."]";
	 	echo $tmp_rs->Getmenu2($nombre,$id_defa,"0:SIN CONTACTO",false,0,"id='$nombre' class='select' ");
	 	$tmp_rs->Close();
	 }
 }
 ?>
