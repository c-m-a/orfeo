<HEAD>
<TITLE>Gen PDF -  ORFEO - <?=DATE ?></TITLE>
</HEAD>
<?php
session_start();
echo $dependencia;
if(!$numrad){$numrad=$verrad;}
include "plantillas.php";
include "config.php"; 
//require('tag_pdf/WriteTag.php');
// ABRE EL ARCHIVO
include "ver_datosrad.php";
ora_commiton($handle); 
$cursor = ora_open($handle);
$h = fopen($artxt,"r") or $flag=2; 
if (!$h) { 
  echo "No hay una plantilla llamada $filename.txt"; 
}else{
$alltext = "";
$paginas = 0;
while ($line=fgets($h,81))
 {
    $alltext.=$line . "";
    $paginas=$paginas +1;
 }
}
//FINALIZA APERTURA DE ARCHIVO 
$fdia = date("d");
$fdia_nombre = date("D");
$fmes = date("m");
$fmes_nombre = date("M");
$fano = date("Y");
if($fmes_nombre=="Jan"){$fmes_nombre="Enero";}
if($fmes_nombre=="Feb"){$fmes_nombre="Enero";}
if($fmes_nombre=="Mar"){$fmes_nombre="Marzo";}
if($fmes_nombre=="Apr"){$fmes_nombre="Abril";}
if($fmes_nombre=="May"){$fmes_nombre="Mayo";}
if($fmes_nombre=="Jun"){$fmes_nombre="Junio";}
if($fmes_nombre=="Jul"){$fmes_nombre="Julio";}
if($fmes_nombre=="Aug"){$fmes_nombre="Agosto";}
if($fmes_nombre=="Sep"){$fmes_nombre="Septiembre";}
if($fmes_nombre=="Oct"){$fmes_nombre="Octubre";}
if($fmes_nombre=="Nov"){$fmes_nombre="Noviembre";}
if($fmes_nombre=="Dec"){$fmes_nombre="Diciembre";}if($fdia_nombre=="Mon"){$fdia_nombre="Lunes";}
if($fdia_nombre=="Tue"){$fdia_nombre="Martes";}
if($fdia_nombre=="Wed"){$fdia_nombre="Miercoles";}
if($fdia_nombre=="Thu"){$fdia_nombre="Jueves";}
if($fdia_nombre=="Fri"){$fdia_nombre="Viernes";}
if($fdia_nombre=="Sat"){$fdia_nombre="Sabado";}
if($fdia_nombre=="Sun"){$fdia_nombre="Domingo";}
$alltext = str_replace("*RDOCUMENTO*",$rdocumento,$alltext);

$alltext = str_replace("*DOCUMENTO_R*",$documento_us1,$alltext);
$alltext = str_replace("*DOCUMENTO_P*",$documento_us2,$alltext);
$alltext = str_replace("*DOCUMENTO_E*",$documento_us3,$alltext);

$alltext = str_replace("*RCIUDAD*",$ciudad,$alltext);
$alltext = str_replace("*RDIRECCION*",$rdireccion,$alltext);

$alltext = str_replace("*DIRECCION_R*",$direccion_us1,$alltext);
$alltext = str_replace("*DIRECCION_P*",$direccion_us2,$alltext);
$alltext = str_replace("*DIRECCION_E*",$direccion_us3,$alltext);

$alltext = str_replace("*RNOMBRE*",$rnombre,$alltext);

$alltext = str_replace("*NOMBRE_R*",$nombret_us1,$alltext);
$alltext = str_replace("*NOMBRE_P*",$nombret_us2,$alltext);
$alltext = str_replace("*NOMBRE_E*",$nombret_us3,$alltext); 

$alltext = str_replace("*TELEFONO*",$rtelefono,$alltext);

$alltext = str_replace("*TELEFONO_R*",$telefono_us1,$alltext);
$alltext = str_replace("*TELEFONO_P*",$telefono_us2,$alltext);
$alltext = str_replace("*TELEFONO_E*",$telefono_us3,$alltext);

$alltext = str_replace("*NOMBRE*",$nombre,$alltext);
$alltext = str_replace("*RAPELLIDOS*",$rapellidos,$alltext);
$alltext = str_replace("*EMPRESA*",$empresa,$alltext);
$alltext = str_replace("*ASUNTO*",$asunto,$alltext);
$alltext = str_replace("*TIPO DOCUMENTO*",$documento,$alltext);
$alltext = str_replace("*REMITENTE*",$remitente,$alltext);
$alltext = str_replace("*DIA*",$fdia,$alltext);
$alltext = str_replace("*DIA_NOMBRE*",$fdia_nombre,$alltext);
$alltext = str_replace("*MES_NOMBRE*",$fmes_nombre,$alltext);
$alltext = str_replace("*MES*",$fmes,$alltext);
$alltext = str_replace("*AÑO*",$fano,$alltext);
$alltext = str_replace("*RADICADO*",$radicado,$alltext);
$alltext = str_replace("*FECHARAD*",$fecharad,$alltext);
$alltext = str_replace("*CUENTAI*",$cuentai,$alltext);
$fechah=date("dmyhms") . " " ;
$archivotmp = $dirtmp . $numrad."_".$plg_codi.".txt";
if($alltext and $enviar)
{
  $fp=fopen($archivotmp,"w");
  fputs($fp,$alltext);
  fclose($fp);
}
// ****************  FIN TX COMBINACION DE CAMPOS
if($radicar_documento)
{
// Generar el Numero de Radicación
//ECHO "eNTRO A generar la secuencia";
	 if($gen_rad != "false")
	 {
			$isql_hl= "select sec_$dependencia.nextval as SEC from dual";
			//echo "$isql_hl";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
			$row=array();
			ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
			$sec =$row["SEC"];
	}	
}else
{
		$sec = 0;
		if($radicado_sal)
		{
		   $radsal = substr($radicado_sal,1,13);
		}
}

$archivo = "$artxt";
$pdf=new PDF();
$pdf->Open();

if(!$radicado_sal)		
{
		$sec = str_pad($sec, 5, "0", STR_PAD_LEFT);
		$anosal = date("Y");
		$messal = str_pad(date("m"), 2, "0", STR_PAD_LEFT);
		$anos = substr($anosal,1,3);
		$radsal = $anos . $dependencia . $sec . "1";
		$rad_salida = $radsal;
		$archivo_sal = $anos . $dependencia . $sec . "_1";
}	
  	 if($gen_rad == "false")
	 {	
		$rad_definitivo = $numrad; 
		$radsal = substr($numrad,1,13);
		$rad_salida = $radsal;
		
		$radsal = $radsal . EAN13_DV($radsal);
		$archivo_sal = $rad_definitivo . "_1";
	 }else
	 {
		$rad_definitivo = $numrad; 
		$radsal = $numrad . EAN13_DV($radsal);
	 }
	$pdf->AddPage();

  $pdf->Image("escudo.jpg",10,8,23);
  $pdf->EAN13(160,30,$radsal);  
 $pdf->PrintChapter(2,'2',$archivo);
 
   

//$title = "SUPERINTENDENCIA DE SERVICIOS PUBLICOS ";

//$pdf->SetTitle($title); 
$title = "";
if($radicar_documento )
{
    $arpdf = "rad_salida/$fano/$dependencia/$fmes/2$archivo_sal.pdf";
	$pdf->Output($arpdf);
	echo "<B><CENTER><a href=$arpdf?fecha_h=$fechah> Ver Archivo Pdf </a><br>";
	if($sec)
		{
		  $plg_codi = str_pad($numero_pla,4,"0",STR_PAD_left);
		  $plg_comentarios = "";
		  $plt_codi = $plt_codi;
		  $rad_salida = "2" . $rad_salida;
		  $isql = "update PL_GENERADO_PLG set PLT_CODI=2,RADI_NUME_SAL=$rad_salida,
		           PLG_ARCHIVO_FINAL='$arpdf',PLG_CREA_FECH=SYSDATE		   
		           where PLG_CODI=$plantillaper1 and RADI_NUME_RADI=$numrad";
    	  ora_commiton($handle); 
 	      $cursor = ora_open($handle);
		  ora_parse($cursor,$isql) or die ("No se ha podido Grabar el Radicado");
		  ora_exec($cursor) or die ("No se ha podido Grabar el Radicado");
		  $actualizados = ora_numrows($cursor);
		  ora_commit($handle);
 ?>
<p>
  <center>
    <?
	if($actualizados>0)
	{ 
	?>
	
    Ha sido Radicado el Documento con el N&uacute;mero <b>
    2<?=$rad_definitivo ?>
	<?
	}else{
	?>
	No se ha podido radicar el Documento con el N&uacute;mero <b>
	
    </b> 
	<?
	}
	?>
  </center>
  <?
		}	
}
if($ver_tmp_pdf )
{
    $arpdf_tmp = "rad_salida/tmp_pdf/2$archivo_sal.pdf";
	$pdf->Output($arpdf_tmp); 
	echo "<CENTER><B><a href=$arpdf_tmp?fecha_h=$fechah> Ver Archivo Pdf </a><br>";
	echo "<HTML><SCRIPT>document.location='$arpdf_tmp?fecha_h=$fechah';</SCRIPT></HTML>";
}

?>
