<?php
function FechaFormateada($FechaStamp) {
	$ano = date('Y', $FechaStamp); //<-- Año
	$mes = date('m', $FechaStamp); //<-- número de mes (01-31)
	$dia = date('d', $FechaStamp); //<-- Día del mes (1-31)
	$dialetra = date('w', $FechaStamp); //Día de la semana(0-7)
	switch ($dialetra) {
		case 0 :
			$dialetra = "domingo";
			break;
		case 1 :
			$dialetra = "lunes";
			break;
		case 2 :
			$dialetra = "martes";
			break;
		case 3 :
			$dialetra = "miércoles";
			break;
		case 4 :
			$dialetra = "jueves";
			break;
		case 5 :
			$dialetra = "viernes";
			break;
		case 6 :
			$dialetra = "sábado";
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
	class PDF extends FPDF {
		//Cabecera de página

		function Header() {
			//tamaño y fuente del titulo
			$this->SetFont('Arial', 'B', 12);
			//corremos el texto a la derecha y la bajamos
			$this->ln(44);
			$this->cell(4);
			//colocamos el texto del titulo (ancho,espacio entre filas, texto,borde,alineacion,fondo)
			$this->MultiCell(0, 5,$this->encabezado, 0, R);
			//Logo escudo(ruta,x,y,ancho,alto)
			$this->Image('../img/banerPDF.jpg', 25, 12, 175);
		}

		//Pie de página
		function Footer() {
			$this->SetY(-19);
			$this->SetFont('Arial','', 10);
			$this->MultiCell(0, 5,$this->pie, 0, C);
		}
	}
	$db = new ConnectionHandler("$ruta_raiz");
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

	$pdf = new PDF('p', 'mm', 'letter');
	$pdf->pie = $pie;
	$pdf->AddPage();
	$pdf->SetTitle("Departamento Nacional de Planeacion");
	$pdf->SetLeftMargin(25);
	$pdf->SetRightMargin(25);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Cell(50, 5, $numradicado, 0, 1, L);
	$pdf->Cell(105, 5,$lugar."., ". $fecha, 0, 1, L);
	$pdf->ln(18);
	$pdf->SetFont('Arial', '', 12);
	$pdf->write(5, $asu);
	$pdf->ln(25);
	$pdf->Cell(60, 5, $mensaje, 0, 1, L);
	$pdf->ln(5);
	$pdf->MultiCell(0, 5, $reseptor, 0, L);
	$primerno = substr($numRadicadoPadre, 0, 4);
	$segundono = substr($numRadicadoPadre, 4, 3);
	$ruta = "/" . $primerno . "/" . $segundono . "/docs/" . $numradicado;
	$adjuntos = BODEGAPATH . $ruta;
	$pdf->Output($adjuntos . '.pdf', 'f');
	$enlace = "../bodega" . $ruta . '.pdf';
	radi_paht($db, $ruta, $numradicado);

	return $numradicado . '.pdf';
}
?>
