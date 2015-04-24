<?php 
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
class argumentoPliego {
var $sgd_arg_codigo,$sgd_arg_desc;
var $conexion;
function argumentoPliego($codigo) {


	if (!$codigo)
		$codigo="null";

	$this->conexion = new ConnectionHandler;

	$q="select * from sgd_arg_pliego where sgd_arg_codigo=$codigo ";
	//print ($q);
	$this->conexion->getResult($q);
	if 	($this->conexion->cursor->next_record()!=0) 
 		{
		  	 $this->sgd_arg_codigo=$this->conexion->cursor->f('sgd_arg_codigo');
			 $this->sgd_arg_desc=$this->conexion->cursor->f('sgd_arg_desc');
						
			//echo ("\n ***** ".  $this->sgd_rem_destino  . "****** ".  $this->anex_radi_nume ." ***");
			 
		}
}

function get_sgd_arg_desc() {
	return  $this->sgd_arg_desc;
}



}


?>
