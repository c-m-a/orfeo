<?php
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
require_once("$ruta_raiz/include/pdf/class.ezpdf.inc");


class Recuperador {
var $conexion,$query;
function armarAQuery($argumento) {
$rangos = explode("-",$argumento);
$num = count($rangos);
$i = 0;
	$this->query="select * from radicado where ";
	while ($i < $num)
				 {

		$rango=explode(",",$rangos[$i]);
		$this->query = $this->query . "(radi_nume_radi between ". $rango[0] . " and " . $rango[1] . ") or ";
		$i++;
	}
$this->query = substr($this->query,0,strlen($query)-3);

}
function Recuperador(){
$this->conexion = new ConnectionHandler;
}
function previo() {

//rint ($query);
$pdf = new Cezpdf("LETTER","portrait");//LETTER = Carta,portrait = vertical
$year = date("Y");
$day = date("d");
$month = date("m");
$a = array("left"=>0);
$b = array("justification"=>"center");
$d = array("justification"=>"left","leading"=>8);
$c = array("left"=>0,"leading"=>12);//leading = espaciado
$e = array("left"=>0,"leading"=>15);//leading = espaciado
$pdf->ezSetCmMargins(4,3,4,2);//top,botton,left,right
/* Se establece la fuente que se utilizara para el texto. */
$pdf->selectFont("../include/pdf/fonts/Times-Roman.afm");
$pdf->ezText("ACTA DE REPARTO \n\n",15,$b);
$pdf->ezText($this->query." :  \n" ,12,$d);
$txtformat = "Radicados a recuperar";
$pdf->ezText($txtformat,12,$c);
$this->conexion->getResult($this->query);
$data = array();
$columna = array();
$contador=0;
while 	($this->conexion->cursor->next_record()!=0)
 		{


			 $radicado= $this->conexion->cursor->f('radi_nume_radi');
			 if ($this->conexion->cursor->f('radi_depe_actu')==999 && $this->conexion->cursor->f('carp_codi')== 0)
			 	 $columna[ $contador++]=$radicado;

			else
				$columna[ $contador++]='***'.$radicado.'***';

			if ($contador==4) {
				$contador=0;
				$data=  array_merge ($data,array (array('-1-'=>$columna[0],'-2-'=>$columna[1],'-3-'=>$columna[2],'-4-'=>$columna[3])));
				array_splice($columna, 0);
			}

			//$data=  array_merge ($data,array (array('Número'=>$rucConsecutivo."-".$rucYear,'Usuario'=>$nombre,'Defensor Público'=>$nombreDefensor)));

}

if ($contador!=0)
	$data=  array_merge ($data,array (array('-1-'=>$columna[0],'-2-'=>$columna[1],'-3-'=>$columna[2],'-4-'=>$columna[3])));


$pdf->ezTable($data);
$pdf->ezStream();



}

function recuperar($cambio) {
	$usua_nomb = $cambio["usua_nomb_c"];
	$depe_nomb = $cambio["depe_nomb_c"];
	$fecha = Date("Y-m-d") . "  " .  Date("H:m:s");
	$vector = array();
	$this->conexion->getResult($this->query);
	$fieldstable[] = "RADI_DEPE_ACTU";
	$fieldstable[] = "RADI_USUA_ACTU";
	$fieldstable[] = "CARP_CODI";
	$fieldstable[] = "CARP_PER";

	$values["CARP_CODI"] = 0;
        $values["CARP_PER"] = 0;

        $values["RADI_DEPE_ACTU"] = $cambio["dependencia"];
        $values["RADI_USUA_ACTU"] = $cambio["usuarioAfectado"];
        $descripcion = $cambio["comentario"]."-" . $cambio["usuario"];
        $nameid[] = "radi_nume_radi";
        $sw=0;
        $sw2=0;
        $fecha_hoy = date("Y-m-d");

		$fieldstable2[] = "depe_codi";
		$fieldstable2[] = "hist_fech";
		$fieldstable2[] = "usua_codi";
		$fieldstable2[] = "radi_nume_radi";
		$fieldstable2[] = "hist_obse";
		$fieldstable2[] = "usua_codi_dest";
		$fieldstable2[] = "usua_doc";
		$fieldstable2[] = "hist_usua_autor";
		$fieldstable2[] = "hist_doc_dest";
		$fieldstable2[] = "sgd_ttr_codigo";
//SGD_TTR_TRANSACCION
		$values2["depe_codi"] = $cambio["dependencia"];
		$values2["hist_fech"] = " TO_DATE ('$fecha_hoy','YY-MM-DD') ";
		$values2["usua_codi"] = $cambio["usuario_c"];
		$values2["usua_codi_dest"] =$cambio["usuarioAfectado"];
		$values2["usua_doc"] = $cambio["usua_doc"];
		$values2["hist_usua_autor"] = $cambio["usuarioAutorizaDocto"];
		$values2["hist_obse"] = "'$descripcion'";
		$values2["hist_doc_dest"] = $cambio["usuarioAutorizaDocto"];
		$values2["sgd_ttr_codigo"] = 1; // TIPO DE TRANSACCION DE RECUPERACION
$conexion = new ConnectionHandler;
// DEL HISTORICO
$afectados="";
while 	($this->conexion->cursor->next_record()!=0)
 		{
			$radicado= $this->conexion->cursor->f('radi_nume_radi');
			$afectados = $afectados . "<br>".$radicado;
			$idvalue["radi_nume_radi"] = $radicado;
			if (!($conexion->update("radicado",$fieldstable,$values,$nameid,$idvalue) ))
				$sw=1;

			$values2["radi_nume_radi"] = $radicado;
			if (!$conexion->insert("hist_eventos",$fieldstable2,$values2))
				$sw2=1;
}

if ($sw==1)
		echo ("<span class=eerrores>ERROR TRATANDO DE RECUPERAR EL RADICADO</span>");
	else {
		echo ("<span class=tituloListado>ACCION REQUERIDA COMPLETADA </span> ");
		echo ("<p class=etexto> <span class='etextomenu'>ACCION REQUERIDA :</span> <font color=blue>RECUPERACION DE RADICADOS </font></p>");
		echo ("<p class=etexto> <span class='etextomenu'>FECHA DE RECUPERACION :</span> <font color=blue>$fecha_doc </font></p>");
		echo ("<p class=etexto> <span class='etextomenu'>USUARIO :</span> <font color=blue>$usua_nomb </font></p>");
		echo ("<p class=etexto> <span class='etextomenu'>DEPENDENCIA :</span> <font color=blue>$depe_nomb </font></p>");
		echo ("<p class=etexto><span class='etextomenu'>FECHA Y HORA :</span> <font color=blue>$fecha </font></p>");
		echo ("<p class=etexto><span class='etextomenu'>RADICADOS INVOLUCRADOS :</span><br> <font color=blue>");
		echo ($afectados);
		}

if ($sw2==1)
		echo ("<span class=eerrores>ERROR TRATANDO DE ESCRIBIR EL HISTORICO</span>");
}

function armarAQueryActa($argumento) {
	$fecha_doc = $argumento["fecha_doc"];
	$dependecia = $argumento["dependencia"];
	$usuarioAutorizaDocto = $argumento["usuarioAutorizaDocto"];

	$this->query="select radicado.* from radicado,hist_eventos where ";
	$this->query = $this->query . " radicado.radi_nume_radi=hist_eventos.radi_nume_radi  and ";
	$this->query = $this->query . " hist_eventos.hist_fech = TO_DATE ($fecha_doc,'YY-MM-DD') and ";
	$this->query = $this->query . " hist_eventos.sgd_ttr_codigo = 1 and ";
	$this->query = $this->query . " hist_eventos.hist_usua_autor = $usuarioAutorizaDocto ";

}

function acta($argumento) {


$fecha_doc = $argumento["fecha_doc"];
$usuarioAutorizaNomb = $argumento["usuarioAutorizaNomb"];

//rint ($query);
$pdf = new Cezpdf("LETTER","portrait");//LETTER = Carta,portrait = vertical
$year = date("Y");
$day = date("d");
$month = date("m");
$a = array("left"=>0);
$b = array("justification"=>"center");
$d = array("justification"=>"left","leading"=>8);
$c = array("left"=>0,"leading"=>12);//leading = espaciado
$e = array("left"=>0,"leading"=>15);//leading = espaciado
$pdf->ezSetCmMargins(4,3,4,2);//top,botton,left,right
/* Se establece la fuente que se utilizara para el texto. */
$pdf->selectFont("../include/pdf/fonts/Times-Roman.afm");
$pdf->ezText("ACTA DE RECUPERACION DE RADICADOS \n\n",15,$b);
//$pdf->ezText($this->query." :  \n" ,12,$d);

$txtformat = "Radicados recuperados a $fecha_doc y autorizados por $usuarioAutorizaNomb \n\n ";
$pdf->ezText($txtformat,12,$c);


$this->conexion->getResult($this->query);
$data = array();
$columna = array();
$contador=0;
while 	($this->conexion->cursor->next_record()!=0)
 		{


			 $radicado= $this->conexion->cursor->f('radi_nume_radi');
			 $columna[ $contador++]=$radicado;

			if ($contador==4) {
				$contador=0;
				$data=  array_merge ($data,array (array('-1-'=>$columna[0],'-2-'=>$columna[1],'-3-'=>$columna[2],'-4-'=>$columna[3])));
				array_splice($columna, 0);
			}

			//$data=  array_merge ($data,array (array('Número'=>$rucConsecutivo."-".$rucYear,'Usuario'=>$nombre,'Defensor Público'=>$nombreDefensor)));

}

if ($contador!=0)
	$data=  array_merge ($data,array (array('-1-'=>$columna[0],'-2-'=>$columna[1],'-3-'=>$columna[2],'-4-'=>$columna[3])));


$pdf->ezTable($data);
$pdf->ezStream();



}




}






?>
