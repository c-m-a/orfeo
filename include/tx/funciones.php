<?php


function FechaFormateada($FechaStamp) {
	$ano = date('Y', $FechaStamp); //<-- A�o
	$mes = date('m', $FechaStamp); //<-- n�mero de mes (01-31)
	$dia = date('d', $FechaStamp); //<-- D�a del mes (1-31)
	$dialetra = date('w', $FechaStamp); //D�a de la semana(0-7)
	switch ($dialetra) {
		case 0 :
			$dialetra = "Domingo";
			break;
		case 1 :
			$dialetra = "Lunes";
			break;
		case 2 :
			$dialetra = "Martes";
			break;
		case 3 :
			$dialetra = "Miercoles";
			break;
		case 4 :
			$dialetra = "Jueves";
			break;
		case 5 :
			$dialetra = "Viernes";
			break;
		case 6 :
			$dialetra = "Sabado";
			break;
	}
	switch ($mes) {
		case '01' :
			$mesletra = "Enero";
			break;
		case '02' :
			$mesletra = "Febrero";
			break;
		case '03' :
			$mesletra = "Marzo";
			break;
		case '04' :
			$mesletra = "Abril";
			break;
		case '05' :
			$mesletra = "Mayo";
			break;
		case '06' :
			$mesletra = "Junio";
			break;
		case '07' :
			$mesletra = "Julio";
			break;
		case '08' :
			$mesletra = "Agosto";
			break;
		case '09' :
			$mesletra = "Septiembre";
			break;
		case '10' :
			$mesletra = "Octubre";
			break;
		case '11' :
			$mesletra = "Noviembre";
			break;
		case '12' :
			$mesletra = "Diciembre";
			break;
	}
	return "$dialetra, $dia de $mesletra de $ano";
}

function makeLabel($db, $tdoc) {
	// params to variables
	$sqlE = "SELECT
	      		SGD_PQR_LABEL
			FROM
	    		SGD_PQR_MASTER
			WHERE
				ID = $tdoc";
	return $db->conn->Execute($sqlE);
}

function radi_paht($db, $ruta, $numerad) {
	// params to variables
	$ruta .= ".pdf";
	$sqlE = "UPDATE RADICADO
			SET RADI_PATH = ('$ruta')
			where radi_nume_radi = $numerad";
	return $db->conn->Execute($sqlE);
}

function nom_muni_dpto($muni, $dep, $db) {
	// params to variables
	$sqlE = "
			SELECT
	           a.MUNI_NOMB,
	           b.DPTO_NOMB
				FROM MUNICIPIO a, DEPARTAMENTO b
				WHERE (a.ID_PAIS = 170)
				AND	(a.ID_CONT = 1)
				AND (a.DPTO_CODI = $dep)
				AND (a.MUNI_CODI = $muni)
				AND (a.DPTO_CODI=b.DPTO_CODI)
				AND (a.ID_PAIS=b.ID_PAIS)
				AND (a.ID_CONT=b.ID_CONT)";
	return $db->conn->Execute($sqlE);
}

function crearpdf($pie,$numRadicadoPadre, $numradicado, $fecha, $lugar, $asu, $mensaje, $reseptor) {
	class PDF2 extends FPDF {
		//Cabecera de p�gina

		function Header() {
			//tama�o y fuente del titulo
			$this->SetFont('Arial', 'B', 12);
			//corremos el texto a la derecha y la bajamos
			$this->ln(44);
			$this->cell(4);
			//colocamos el texto del titulo (ancho,espacio entre filas, texto,borde,alineacion,fondo)
			$this->MultiCell(0, 5,$this->encabezado, 0, R);
			//Logo escudo(ruta,x,y,ancho,alto)
			//$this->Image('../img/banerPDF.jpg', 23, 12, 175);
		}

		//Pie de p�gina
		function Footer() {
			$this->SetY(-19);
			$this->SetFont('Arial','', 10);
			$this->MultiCell(0, 5,$this->pie, 0, C);
			$this->Write(5,'A continuación mostramos una imagen ');
			$this->Image('http://debian/orfeo-3.8.0/logoEntidad.jpg' , 25 ,12, 160 , 25,'JPG', 'http://www.correlibre.org');
			$this->Image('http://debian/orfeo-3.8.0/logoEntidadPiePagina.jpg' , 25 ,250, 160 , 20,'JPG', 'http://www.correlibre.org');

		}
	}
	$db = new ConnectionHandler("..");
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$ruta_raiz = "..";
	require($ruta_raiz.'/fpdf/html2pdf.php');
	//echo "Paso";
	$pdf=new PDF();
	//$pdf = new PDF('p', 'mm', 'letter');
	$pdf->pie = $pie;
	$pdf->AddPage();
	$pdf->Image('http://debian/orfeo-3.8.0/logoEntidad.jpg' , 25 ,5, 160 , 25,'JPG', 'http://www.correlibre.org');
	$pdf->Image('http://debian/orfeo-3.8.0/logoEntidadPiePagina.jpg' , 25 ,275, 170 , 20,'JPG', 'http://www.correlibre.org');
	$pdf->SetTitle("SuperIntendencia de La Economia Solidaria");
	$pdf->SetLeftMargin(25);
	$pdf->SetRightMargin(25);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->ln(22);
	$pdf->Cell(170, 2, "No. de Radicado:".$numradicado, 0, 1, R);
	//$pdf->SetFont('Free3of9', '', 16);
	$fecha = date("Y/m/d");
	$pdf->Cell(170, 2, " ", 0, 1, R);
	$pdf->Cell(170, 2, "Fecha :  ".$fecha."                         ", 0, 1, R);
	//$pdf->Cell(170, 10,$lugar."., ". $fecha, 0, 1, L);
	$encabezado = "$numradicado <br> $lugar,".  date("Y/M/D");
	$pdf->ln(17);
	$pdf->SetFont('Arial', '', 12);
	$pdf->WriteHtml($asu);
	$pdf->ln(19);
        //$pdf->Image('http://debian/orfeo-3.8.0/logoEntidad.jpg' , 25 ,5, 160 , 25,'JPG', 'http://www.correlibre.org');
	$pdf->Image('http://debian/orfeo-3.8.0/logoEntidadPiePagina.jpg' , 25 ,270, 170 , 20,'JPG', 'http://www.correlibre.org');
	//$pdf->Cell(60, 5, $mensaje, 0, 1, L);
$pdf->WriteHTML("<HTML><BODY>".$mensaje."</BODY></HTML>");
        //echo "<hr>$mensaje<hr> $asu";
	$pdf->ln(5);
	
	$pdf->MultiCell(0, 5, $reseptor, 0, J);
	$primerno = substr($numRadicadoPadre, 0, 4);
	$segundono = substr($numRadicadoPadre, 4, 3);
	$ruta = "/" . $primerno . "/" . $segundono . "/docs/" . $numradicado;
	$adjuntos = "../bodega" . $ruta;
	$pdf->Output($adjuntos . '.pdf', 'f');
	$enlace = "../bodega" . $ruta . '.pdf';
	radi_paht($db, $ruta, $numradicado);

	return $numradicado . '.pdf';
}
?>
