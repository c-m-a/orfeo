<?php
define('FPDF_FONTPATH','../fpdf/font/');
require_once('pdf_label.php');

/*-------------------------------------------------
To create the object, 2 possibilities:
either pass a custom format via an array
or use a built-in AVERY name
-------------------------------------------------*/

// Example of custom format; we start at the second column
//$pdf = new PDF_Label(array('name'=>'perso1', 'paper-size'=>'A4', 'marginLeft'=>1, 'marginTop'=>1, 'NX'=>2, 'NY'=>7, 'SpaceX'=>0, 'SpaceY'=>0, 'width'=>99.1, 'height'=>38.1, 'metric'=>'mm', 'font-size'=>14), 1, 2);
// Standard format


// Print labels
/*
   $fecha_ini = "$fecha_busq $hora_ini:$minutos_ini:00 ";
   $fecha_fin = "$fecha_busq $hora_fin:$minutos_fin:59 ";
*/
$fecha_ini = $fecha_busq;
$fecha_fin = $fecha_busq;
$fecha_ini = mktime($hora_ini,$minutos_ini,00,substr($fecha_ini,5,2),substr($fecha_ini,8,2),substr($fecha_ini,0,4));
$fecha_fin = mktime($hora_fin,$minutos_fin,59,substr($fecha_fin,5,2),substr($fecha_fin,8,2),substr($fecha_fin,0,4));

$where_fecha =	' a.sgd_renv_fech BETWEEN ' .$db->conn->DBTimeStamp($fecha_ini).
	         	' AND '.$db->conn->DBTimeStamp($fecha_fin).' AND DEPE_CODI= ' . $dependencia ;
switch ($db->driver)
{
	case 'mssql':	$tmp_var= "convert(char(14),a.RADI_NUME_SAL)"; break;
	case 'oracle':	
	case 'oci8':
	// Modificado SGD 18-Septiembre-2007
	case 'postgres':
	$tmp_var = "a.RADI_NUME_SAL"; break;
}

// Modificado SGD 18-Septiembre-2007
$query = "SELECT  
		a.SGD_FENV_CODIGO,
		'', ".
		$db->conn->substr."($tmp_var,5,10) AS REGISTRO,
		a.SGD_RENV_NOMBRE AS DESTINATARIO,
		a.SGD_RENV_DESTINO AS DESTINO,
		a.SGD_RENV_PESO AS PESO,
		a.SGD_RENV_VALOR AS VALOR_PORTE,
		a.SGD_RENV_CERTIFICADO AS CERTIFICADO,
		'' AS VALOR_ASEGURADO,
		'' AS TASA_DE_SEGURO,
		'' AS VALOR_REEMBOLSABLE,
		'' AS AVISO_DE_LLEGADA,
		'' AS SERVICIOS_ESPECIALES,
		a.SGD_RENV_VALOR AS VALOR_TOTAL,
		a.SGD_RENV_DIR AS DIRECCION,
		a.SGD_RENV_TEL AS TELEFONO,
		a.SGD_RENV_MAIL AS MAIL,
		a.SGD_RENV_DEPTO AS DEPARTAMENTO,
		a.SGD_RENV_DESTINO AS MUNICIPIO
		FROM SGD_RENV_REGENVIO a
		WHERE SGD_FENV_CODIGO = 105 AND a.SGD_RENV_VALOR != 0 AND $where_fecha";
				   
	$rs = $db->query($query);
	unset($tmp_var);
    $i = 0;
	//$pdf = new PDF_Label('8600',1,4);
    $pdf = new PDF_Label(array('name'=>'perso1', 'paper-size'=>'letter', 'marginLeft'=>2, 'marginTop'=>0, 'NX'=>1, 'NY'=>4, 'SpaceX'=>0, 'SpaceY'=>0.6, 'width'=>210, 'height'=>70, 'metric'=>'mm', 'font-size'=>10), 1, 1);

	$pdf->Open();
	//$pdf->AddPage();
//    while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	  $fecha_adm = date("Y m d");
	  $oficina_org = "Morato";
	  $cad = '                                                                       ';
	  $nombre_r = str_pad($db->entidad_largo,63,$cad).str_pad($db->entidad_tel,8,'        ',STR_PAD_RIGHT);
      $direccion_r = str_pad($db->entidad_dir,63,$cad)." BOGOTA ";
	
      while(!$rs->EOF)
	{ 
	  $i++;
	  $radicado_sal   = $rs->fields["REGISTRO"];
	  $nombre_d       = $rs->fields["DESTINATARIO"];
	  $telefono_d     = $rs->fields["TELEFONO"];
	  $direccion_d    = $rs->fields["DIRECCION"];
	  $ciudad_d       = $rs->fields["DESTINO"];
	  $departamento_d = $rs->fields["DEPARTAMENTO"];
	  $peso           = $rs->fields["PESO"];
	  $tarifa         = $rs->fields["VALOR_PORTE"];
	  $valor_total    = $rs->fields["VALOR_TOTAL"];	  	  	  	  	  
	  $sec = str_pad($sec, 5, "0", STR_PAD_LEFT);
	  $campo1         =  $rs->fields["DESTINO"]; 
	  $linea0 = "                    $radicado_sal";
	  $linea1 = "$fecha_adm                  $oficina_org";
	  $linea2 = "$nombre_r";
	  $linea3 = "$direccion_r";
	  $linea4 = str_pad($nombre_d, 60, " ", STR_PAD_RIGHT) . $telefono_d;
	  $linea5 = str_pad($direccion_d,48, " ", STR_PAD_RIGHT) . str_pad($ciudad_d,16, " ", STR_PAD_RIGHT) .$departamento_d;
	  $linea6 = str_pad("",  45, " ", STR_PAD_RIGHT) . str_pad($peso, 13, " ", STR_PAD_LEFT).str_pad($tarifa, 10, " ", STR_PAD_LEFT);
	  $linea8 = str_pad("", 60, " ", STR_PAD_RIGHT).str_pad($valor_total, 8, " ", STR_PAD_LEFT);	  	  	  	  	  	  
      $pdf->Add_PDF_Label(sprintf("%s\n%s\n%s\n%s\n%s\n%s\n%s\n%s",$linea0, $linea1, $linea2, $linea3, $linea4, $linea5, $linea6, $linea8));
      $rs->MoveNext();
    } 
	$fecha = date("Ymd");
$archivo_labels = "../bodega/pdfs/guias/guia1$fecha.pdf";
$pdf->Output($archivo_labels);

?>
		<TABLE BORDER=0 WIDTH=100% class="titulos2">
		<TR><TD class="listado2" align="center">
			<center><b>Se han Generado <?=$i?> Guias para Imprimir. <br> 
			<a href='<?=$archivo_labels?>?<?=date("dmYh").time("his")?>' target='<?=date("dmYh").time("his")?>'>Abrir Archivo</a></b></center>
		</td>
		</TR>
		</TABLE>
