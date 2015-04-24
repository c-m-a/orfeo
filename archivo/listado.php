<?
session_start();
include_once  "../include/db/ConnectionHandler.php";
   	$db = new ConnectionHandler("..");	 
	
if (!$depen or intval($depen) == 0) die ("<table class=borde_tab width='100%'><tr><td class=titulosError><center>Debe seleccionar una dependencia</center></td></tr></table>");
if($generar)
{
   	error_reporting(7);
	$ruta_raiz = "..";
	
   	if (!defined('ADODB_FETCH_NUM'))	define('ADODB_FETCH_NUM',1);
	$ADODB_FETCH_MODE = ADODB_FETCH_NUM; 
	
	$fecha_ini = $fecha_busq;
        $fecha_fin = $fecha_busq;
	$fecha_ini = mktime($hora_ini,$minutos_ini,00,substr($fecha_ini,5,2),substr($fecha_ini,8,2),substr($fecha_ini,0,4));
	$fecha_fin = mktime($hora_fin,$minutos_fin,59,substr($fecha_fin,5,2),substr($fecha_fin,8,2),substr($fecha_fin,0,4));
	//$db->conn->debug = 	true;
	
	$fecha_ini1 = "$fecha_busq $hora_ini:$minutos_ini:00";
	$fecha_mes = "'" . substr($fecha_ini1,0,7) . "'";
	$sqlChar = $db->conn->SQLDate("Y-m","SGD_ARCHIVO_FECH");	

// Si la variable $generar_listado_existente viene entonces este if genera la planilla existente
	$order_isql = " ORDER BY SGD_ARCHIVO_CAJA";
	include "./oracle_pdf.php";
	$pdf = new PDF('L','pt','legal');
	$pdf->lmargin = 0.2;
	$pdf->SetFont('helvetica','',8);
	$pdf->AliasNbPages();

	$head_table = array ("RADICADO","TIPO","DEPENDENCIA","ASUNTO","DOCUMENTO","PERIODO","FOLIOS","CAJA");
	$head_table_size = array (70   ,60           ,200            ,234           ,234      ,80               ,50           ,50        );
	$attr=array('titleFontSize'=>10,'titleText'=>'');
	//$arpdf_tmp = "../bodega/pdfs/planillas/$dependencia_". date("Ymd_hms") . "_jhlc.pdf"; Comentariada Por HLP.
	$arpdf_tmp = "../bodega/pdfs/reportes/".$dependencia."_".date("Ymd_hms")."_arch.pdf";
	$pdf->SetFont('helvetica','',8);
	$pdf->usuario = $usua_nomb;
	$pdf->dependencia = $dependencianomb;
	$pdf->entidad_largo = $db->entidad_largo;
	$total_registros = 0;
	$pdf->lmargin = 0.2;
	$i_total3 = 0;
	/*
	do
	{  // Amplia
		include "$ruta_raiz/include/query/archivo/queryListado.php";	
		$query_t = $query . $where_isql1 . $order_isql;
	$pdf->oracle_report($db,$query_t,false,$attr,$head_table,$head_table_size,$arpdf_tmp,0,31);
	
	if ($i_total3 == 0)  {
		echo $i_total3 = $pdf->numrows;
		echo"n";
		$total_registros += $i_total3;
	}
	$i_total3 = $i_total3 - 32 ;
	}while ($i_total3>0);
	*/
	include "$ruta_raiz/include/query/archivo/queryListado.php";	
		$query_t = $query . $where_isql1 . $order_isql;
		//$db->conn->debug=true;
	$rsc=$db->conn->Execute("SELECT count(*) AS CO FROM ( ".$query_t." )");
	$numf=$rsc->fields[0];
	$pdf->oracle_report($db,$query_t,false,$attr,$head_table,$head_table_size,$arpdf_tmp,0,$numf);
	$total_registros = $pdf->numrows;
	$pdf->Output($arpdf_tmp);
}
?>
		<TABLE BORDER=0 WIDTH=100% class="borde_tab">
		<TR><TD class="listado2"  align="center"><center>
Se han Generado <b><?=$total_registros?> </b> <br>
<a href='<?=$arpdf_tmp?>' target='<?=date("dmYh").time("his")?>'>Abrir Archivo PDF</a></center>
</td>
</TR>
</TABLE>
</body>
