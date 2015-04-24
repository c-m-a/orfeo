<?
 echo "fffff";
error_reporting(7);

if (!$no_planilla or intval($no_planilla) == 0) die ("<p><hr><b><center><span class=etexto>Debe colocar un Numero de Planilla válido");
if($generar_listado) 
{
	   $fecha_ini = "$fecha_busq $hora_ini:$minutos_ini:00 ";
	   $fecha_fin = "$fecha_busq $hora_fin:$minutos_fin:59 ";	   
        include "./oracle_pdf.php";
		echo "Entro";
		$pdf = new PDF('L','pt','A3');
		$pdf->lmargin = 0.3;
		$pdf->SetFont('Arial','',12);
		$pdf->AliasNbPages(); 
		$pdf->connect('localhost','root','','register');
		$head_table = array ("CANTIDAD","CATEGORIA DE CORRESPONDENCIA","NUMERO DE REGISTRO","DESTINATARIO","DESTINO","PESO EN GRAMOS","VALOR PORTE","CERTIFICADO","VALOR ASEGURADO","TASA DE SEGURO","VALOR REEMBOLSABLE","AVISO DE LLEGADA","SERVICIOS ESPECIALES","VALOR TOTAL PORTES Y TASAS");
		$head_table_size = array (57    ,90                           ,60                  ,218           ,120      ,53               ,44           ,74           ,72               ,55              ,88                  ,65                ,75                    ,80);
		$attr=array('titleFontSize'=>10,'titleText'=>'');
		$arpdf_tmp = "../rad_salida/tmp_pdf/$dependencia_". date("Ymd_hms") . "_jhlc.pdf";
		$pdf->SetFont('Arial','',8);
		$pdf->usuario = $usua_nomb;
		$pdf->depe_municipio = $depe_municipio;
		error_reporting(7);
		echo "Entro";
		//do		{
		
		$query = "select  '', 
				  'Certificado',
				  substr(RADI_NUME_SAL,5,8),
				  SGD_RENV_NOMBRE as DESTINATARIO,
				  SGD_RENV_DESTINO as DESTINO,		  
				  TO_NUMBER(SGD_RENV_PESO) as PESO,
				  '' as VALOR_PORTE,
				  TO_NUMBER(SGD_RENV_VALOR) as CERTIFICADO,
				  '' as VALOR_ASEGURADO,
				  '' as TASA_DE_SEGURO,
				  '' as VALOR_REEMBOLSABLE,
				  '' as AVISO_DE_LLEGADA,
				  '' as SERVICIOS_ESPECIALES,
				  TO_NUMBER(SGD_RENV_VALOR) as VALOR_TOTAL,
				  substr(RADI_NUME_GRUPO,5,8) as RADI_NUME_GRUPO
				  from SGD_RENV_REGENVIO ";
				  
			$where_isql = "	  WHERE DEPE_CODI=$dependencia
				  AND sgd_renv_fech BETWEEN 
	              TO_DATE('$fecha_ini','yyyy-mm-dd HH24:MI:ss') AND  
	              TO_DATE('$fecha_fin','yyyy-mm-dd HH24:MI:ss') AND 
				  SGD_FENV_CODIGO = 101 AND ROWNUM<=32 AND SGD_RENV_PLANILLA IS  NULL";
			$order_isql = "  ORDER BY RADI_NUME_GRUPO,RADI_NUME_SAL";
			echo "$query $where_isql $order_isql";
		/*$pdf->oracle_report("$query $where_isql $order_isql",false,$attr,$head_table,$head_table_size,$arpdf_tmp,0,32); 
		$pdf->planilla = $no_planilla;
		$pdf->lmargin = 0.5;
		$i_total = $pdf->numrows;*/
		include "../config.php";
		$cursor3 = ora_open($handle);
		$update_isql = "update sgd_renv_regenvio set sgd_renv_planilla=$no_planilla $where_isql"
        $pdf->planilla = $no_planilla + i;
		ora_parse($cursor3,$update_isql);
		ora_exec($cursor3);
		echo "Paso una";
		//$pdf->AddPage();
		//}while($i_total>=32);
		//$pdf->Output($arpdf_tmp); 
}			
?>
		<TABLE BORDER=0 WIDTH=100%>
		<TR><TD class="etextomenu"  align="center">
<b>Se han Generado <?=$i_total?> Registros para Imprimir en <?=$paginas?> Planillas. <br> 
<a href='<?=$arpdf_tmp?>' target='<?=date("dmYh").time("his")?>'>Abrir Archivo</a>
		</td>
		</TR>
		</TABLE>
</body>