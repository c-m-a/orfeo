<?

/**
 * Programa que muestra en formato PDF un conjunto de radicados que hacen parte de un grupo de masiva, seleccionado previamente desde cuerpo_masiva_recuperar_listado.php
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */

session_start(); 
$ruta_raiz = "..";
error_reporting (7);
include_once "../class_control/Radicado.php"; 
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/class_control/GrupoMasiva.php"; 
require_once("$ruta_raiz/class_control/Esp.php");
require_once("$ruta_raiz/class_control/usuario.php");
require_once("$ruta_raiz/include/pdf/class.ezpdf.inc");

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
//print ("Entra a larecuperacion.."); 
	
include "../rec_session.php";
//$db->conn->debug=true;	
//referencia un objeto de tipo radicado
$rad = & new Radicado($db);
//referencia un objeto de tipo grupo masiva
$grupoMas = & new GrupoMasiva($db);
//se genera un objeto de tipo usuario
$objUsuario= & new Usuario($db);
$grupo=$radGrupo;
//inicializa el arreglo que contendrá los datos del grupo de radicados
$data = array();
//Trae los datos del radicado que encabeza el grupo
$rad->radicado_codigo($radGrupo);
//Trae los datos del usuario radicador
$objUsuario->usuarioDependecina($dependencia,$rad->getUsuaRad());
//Varible que almacena la fecha en la que se radicó el grupo de masiva
$fechaRadGrupo = $rad->getRadi_fech_radi();


//genera los elementos de sesion
$params=$phpsession."&krd=$krd&"
				."depe_nomb=$depe_nomb&usua_doc=$usua_doc&codusuario=$codusuario";

//si se seleccioné el grupo de radicados
if (trim(strlen($grupo))){
	//obtiene un arreglo con los radicados del grupo de masiva
	$radsGrupo=$grupoMas->obtenerGrupo($dependencia,$grupo,"");
	//almacena el número de radicados pertenecientes al grupo
	$num = count($radsGrupo);
	$i = 0;

	//Recorre el grupo de radicados
	while ($i < $num) {	
		$rad->radicado_codigo($radsGrupo[$i]);
		//obtiene los datos del remitente
		$datosRad=$rad->getDatosRemitente();
		$eliminado="";
	
		//Si el radicado ha sido eliminado lo marca
		if ($grupoMas->radicadoRetirado($grupo,$radsGrupo[$i])){
			$retirados=$retirados.";".$radsGrupo[$i].";";
	  	$eliminado="X";
		}
		$data=  array_merge ($data,array (array('NUMERO RADICADO'=>$radsGrupo[$i],'FECHA RADICADO'=>$rad->getRadi_fech_radi(),'DESTINATARIO'=>$datosRad["nombre"],'DIRECCION'=>$datosRad["direccion"],'DEPARTAMENTO'=>$datosRad["deptoNombre"],'MUNICIPIO'=>$datosRad["muniNombre"],'ELIMINADO'=>$eliminado)));				
		$i++; 
	}
	
}else{
	$data =  array_merge ($data,array (array('RESULTADO'=>"NO SE ESPECIFICÓ EL GRUPO A RECUPERAR")));				
}

$retirados="";
$orientIzq = array("left"=>0); 
$justCentro = array("justification"=>"center");  
$estilo1 = array("justification"=>"left","leading"=>8); 
$estilo2 = array("left"=>0,"leading"=>12); 
$estilo3 = array("left"=>0,"leading"=>15); 
$pdf = new Cezpdf("LETTER","landscape");
$pdf->selectFont("$ruta_raiz/include/pdf/fonts/Times-Roman.afm");
$pdf->ezText("RECUPERACION DE LISTADO \n\n",15,$justCentro);
$pdf->ezText("Dependencia: $dependencia \n" ,12,$estilo1);
$pdf->ezText("Usuario Responsable: ".$objUsuario->get_usua_nomb()." \n" ,12,$estilo1);
$pdf->ezText("Fecha: $fechaRadGrupo \n" ,12,$estilo1);
$pdf->ezText("\n\n\n ",6,$estilo1);
$pdf->ezTable($data,'','',array('fontSize'=>6,'width'=>700));
//Var para almacenar la hora con formato
$hora=date("H")."_".date("i")."_".date("s");
// var que almacena el dia de la fecha
$ddate=date('d');
// var que almacena el mes de la fecha
$mdate=date('m');
// var que almacena el año de la fecha
$adate=date('Y');
// var que almacena  la fecha formateada
$fecha=$adate."_".$mdate."_".$ddate;
//guarda el path del archivo generado
$archivo = "$ruta_raiz/bodega/masiva/tmp_$usua_doc"."_$fecha"."_$hora.pdf";
//Referencia el PDF a generar
$pdfcode = $pdf->ezOutput();
$fp=fopen($archivo,'wb'); 
fwrite($fp,$pdfcode); 
fclose($fp);
?>                	 	
	
<head>
<title>Untitled Document</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<script>
function enviar(argumento) {

	document.formMensaje.action="./masiva/"+argumento+"?"+document.formMensaje.params.value;
	document.formMensaje.submit();

}
</script>
<body>

<form action="menu_masiva.php?<?=$params?>" name="formMensaje">
  <table width="53%" align="center" border=0 border=0 cellpadding=0 cellspacing=5 class='borde_tab' >
    <tr align="center"> 
      <td height="25" colspan="2" class="titulos4"> 
        RESULTADO DE LA CONSULTA 
        <input type="hidden" name="krd" value="<?=$krd ?>">
           <input type="hidden" name="params" value="<?=$params?>">
      </td>
  </tr>
  <tr align="center"> 
    <td height="118" colspan="2" class="listado2_no_identa" align="center">
      
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr align="left"> 
          <td height="84" class="listado2_no_identa" >Se ha generado el archivo con el grupo <?=$grupo?>, recuperado.<br>
            <br>
            Para obtener el archivo guarde del destino del siguiente v&iacute;nculo 
            al archivo: <a href="<?=$archivo?>"> PDF GENERADO</a>.</span></strong></font></td>
        </tr>
      </table>
      </td>
      </tr>
      <tr> <td align="center">
      <input name="cerrar" type="button"  class="botones" id="envia22"  value="Cerrar"  onClick="enviar('menu_masiva.php')" >
      </td>
  </tr>
</table>
</form>
  <blockquote>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </blockquote>
</body>
</html>			
	 
	 
  
