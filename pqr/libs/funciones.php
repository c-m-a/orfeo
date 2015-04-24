<?php

function redireccion_aqui($args= null,$prefijo = null) {
         if (!is_null($args)) {
            $argURL = '?' . http_build_query($args,$prefijo);
         }
         header("Location: http://{$_SERVER['HTTP_HOST']}" . str_replace('\\','/',$_SERVER['PHP_SELF']) . $argURL);
         exit;
}

function redireccion_relativa($relative_URL,$args = null,$prefijo = null) {
         if (!is_null($args)) {
            $relative_URL .= (strpos($relative_URL,'?')?'&':'?') . http_build_query($args,$prefijo);
         }

         header("Location: http://{$_SERVER['HTTP_HOST']}" . str_replace('\\','/',dirname($_SERVER['PHP_SELF']) . '/' . $relative_URL));
         exit;
}


function StrValido($cadena)
{
	$login = strtolower($cadena);
	$b     = array("á","é","í","ó","ú","ä","ë","ï","ö","ü","à","è","ì","ò","ù","ñ",",",";",":","¡","!","\¿","/?",'"',"/","&","\n","#","\$","*","%","+","[","]","=","¬","|","^","`","~","\\","'");
	$c     = array("a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","n","","","","","","","","",'',"","","","","","","","","","","","","","","","","",);
	$login = str_replace($b,$c,$login);
	$login = preg_replace('@^([^\?]+)(\?.*)$@','\1',$login);
		
	return $login;
}

function especial($db, $tipo_doc_especial){
	$sqlE = "SELECT
    		ID,
    	    SGD_PQR_LABEL
		 	FROM
		 	SGD_PQR_MASTER
            WHERE SGD_PQR_TPD = $tipo_doc_especial";
    $result = $db->conn->Execute($sqlE);
    $ID	= $result->fields["ID"];
    $SGD_PQR_LABEL	= $result->fields["SGD_PQR_LABEL"];
	$descrip[$ID] = StrValido($SGD_PQR_LABEL);
    return $descrip;
}

function especial2($db, $tipo_doc_especial){
	$sqlE = "SELECT ID FROM SGD_PQR_MASTER WHERE SGD_PQR_TPD = $tipo_doc_especial";
    $result = $db->conn->Execute($sqlE);
    $id	= $result->fields["ID"];
    return $id;
}


function validar($db,$Radi) {
	$sqlE  =
    	"SELECT
			convert(char(14), RADI_NUME_RADI) AS RADICADO
		FROM
			RADICADO
		WHERE
			(RADI_NUME_RADI = $Radi)";
	return $db->conn->Execute($sqlE);
}

function validar_asun($db,$asun) {
	$sqlE  =
    	"select ra_asun from radicado WHERE ra_asun like '$asun'";
    $salida = $db->conn->Execute($sqlE);
    $salida = $salida->fields["ra_asun"];
	return $salida;
}


function usua_Radi_fec($db,$Radi) {
	$sqlE  =
    	"SELECT
			TDOC_CODI,
    		RADI_FECH_RADI,
    		RA_ASUN
		FROM
		    RADICADO
		WHERE
		(RADI_NUME_RADI = $Radi)";
	return $db->conn->Execute($sqlE);
}

function tipodocumental($db,$TDOC_CODI) {
	$sqlE  =
    	"SELECT
			SGD_TPR_DESCRIP
		FROM
		    SGD_TPR_TPDCUMENTO
		WHERE
		(SGD_TPR_CODIGO = $TDOC_CODI)";
	return $db->conn->Execute($sqlE);
}

function usua_lugar($db,$Radi) {

	$sqlE  =
    	"SELECT
			MUNI_CODI,
			DPTO_CODI
		FROM
			RADICADO
		WHERE
		    (RADI_NUME_RADI = $Radi)";
	return $db->conn->Execute($sqlE);
}

function usua_lugarDept($db,$DPTO_CODI) {
	$sqlE  =
    	"SELECT
    		DPTO_NOMB
		FROM
			DEPARTAMENTO
		WHERE
			(ID_PAIS = 170)
		 AND
		 	(ID_CONT = 1)
		 AND
		 	(DPTO_CODI = $DPTO_CODI)";
	return $db->conn->Execute($sqlE);
}

function usua_lugarMun($db,$DPTO_CODI,$MUNI_CODI) {
	$sqlE  =
    	"SELECT
    		MUNI_NOMB
		FROM
			MUNICIPIO
		WHERE
			(ID_PAIS = 170)
		AND
			(ID_CONT = 1)
		AND
			(DPTO_CODI = $DPTO_CODI)
		AND
			(MUNI_CODI = $MUNI_CODI)";
	return $db->conn->Execute($sqlE);
}


function usua_Radicado($db,$Radi) {
	// params to variables
	$sqlE  =
    	"select
			d.radi_nume_radi,
			o.sgd_oem_oempresa+' : '+
			sgd_oem_rep_legal as destinatario,
			o.sgd_oem_direccion,
			o.email,
			convert(varchar(50), o.sgd_oem_telefono ) AS telefono
		from
			sgd_dir_drecciones d,
			sgd_oem_oempresas o
		where
			d.radi_nume_radi = $Radi and
			d.sgd_oem_codigo <> 0 and
			d.sgd_oem_codigo is not null and
			d.sgd_oem_codigo = o.sgd_oem_codigo
		union
		select
			d.radi_nume_radi,
			c.sgd_ciu_nombre+' '+
			c.sgd_ciu_apell1+' '+
			c.sgd_ciu_apell2 as destinatario,
			c.sgd_ciu_direccion,
			c.sgd_ciu_email,
			convert(varchar(50), c.sgd_ciu_telefono ) AS telefono
		from
			sgd_dir_drecciones d,
			sgd_ciu_ciudadano c
		where
			d.radi_nume_radi = $Radi and
			d.sgd_ciu_codigo <> 0 and
			d.sgd_ciu_codigo is not null and
			c.sgd_ciu_codigo = d.sgd_ciu_codigo

		union
		select
			d.radi_nume_radi,
			b.nombre_de_la_empresa +'--'+
			b.nombre_rep_legal,
			b.direccion,
			b.email,
			convert(varchar(50), b.telefono_1 ) AS telefono

		from
			sgd_dir_drecciones d,
			bodega_empresas b
		where
			d.radi_nume_radi =  $Radi and
			d.sgd_esp_codi <> 0 and
			d.sgd_esp_codi is not null and
			d.sgd_esp_codi = b.identificador_empresa
		union

		select
			d.radi_nume_radi,
			u.usua_nomb,
			u.usua_email,
			u.usua_email,
			convert(varchar(50), u.usua_ext ) AS telefono
		from
			sgd_dir_drecciones d,
			usuario u
		where
			d.radi_nume_radi = $Radi and
			(d.sgd_esp_codi = 0 or d.sgd_esp_codi is  null) and
			(d.sgd_ciu_codigo = 0 or d.sgd_ciu_codigo is  null) and
			(d.sgd_oem_codigo = 0 or d.sgd_oem_codigo is null) and
			d.sgd_doc_fun = u.usua_doc
	";
	return $db->conn->Execute($sqlE);
}

function depen_actual($db,$Radi) {
	$sqlE  =
    	"select
			cast(d.depe_codi as varchar(3))+' -- '+d.depe_nomb as dependencia,
			u.usua_nomb
		from
			radicado r,
			usuario u,
			dependencia d
		where
			u.usua_codi = r.radi_usua_actu and
			u.depe_codi = r.radi_depe_actu and
			u.depe_codi = d.depe_codi and
			r.radi_nume_radi = $Radi";
	return $db->conn->Execute($sqlE);
}


function radi_contes($db,$Radi) {

	$sqlE  =
			"select
      c.RADI_PATH
      ,a.RADI_NUME_SALIDA
      ,a.ANEX_FECH_ENVIO
from
     anexos a
    ,radicado c
where
     a.anex_radi_nume = $Radi
     and a.anex_radi_nume <> a.radi_nume_salida
     and (a.anex_estado >= 3 or a.anex_estado_email = 1)
     and a.radi_nume_salida = c.radi_nume_radi
     and convert(varchar(14), a.RADI_NUME_SALIDA) like '%1'
     and a.anex_borrado= 'N'
     and a.sgd_dir_tipo <> 7
     and ((c.SGD_EANU_CODIGO <> 2
     and c.SGD_EANU_CODIGO <> 1)
     or c.SGD_EANU_CODIGO IS NULL)
     and a.ANEX_SALIDA = 1
		";
	return $db->conn->Execute($sqlE);
}

function histo_regreso($db,$Radi) {
	echo "ya entre";
	echo $sqlE  =
    	"SELECT
        	HIST_FECH
      	FROM
        	HIST_EVENTOS
		WHERE
        	RADI_NUME_RADI = $Radi
        	AND SGD_TTR_CODIGO = 4";
	return $db->conn->Execute($sqlE);
}

function FechaFormateada($FechaStamp) {
	$ano = date('Y', $FechaStamp); //<-- Año
	$mes = date('m', $FechaStamp); //<-- número de mes (01-31)
	$dia = date('d', $FechaStamp); //<-- Día del mes (1-31)
	$dialetra = date('w', $FechaStamp); //Día de la semana(0-7)
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
			$dialetra = "Miércoles";
			break;
		case 4 :
			$dialetra = "Jueves";
			break;
		case 5 :
			$dialetra = "Viernes";
			break;
		case 6 :
			$dialetra = "Sábado";
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

function etiqueta($db,$excluir) {
	
	// Filtrar tipo documental para una dependencia especifica
	if($excluir){
		$filtro =  "WHERE SGD_PQR_TPD NOT IN ($excluir)";
	}else{$filtro = '';};
	
	$sqlE  =
    	"SELECT
    		ID,
    	    SGD_PQR_LABEL
		 	FROM
		 	SGD_PQR_MASTER
			$filtro";
				
	$result = $db->conn->Execute($sqlE);	
	while(!$result->EOF) {
		$SGD_PQR_LABEL 	= $result->fields["SGD_PQR_LABEL"];
		$ID				= $result->fields["ID"];
		$tipos[$ID] = ucwords(StrValido($SGD_PQR_LABEL));		
		$result->MoveNext();
	}
	return $tipos;
}

function descrip($db) {
	// params to variables
	$sqlE  =
    	"SELECT
    		SGD_PQR_DESCRIP
		 	FROM
		 	SGD_PQR_MASTER";
	return $db->conn->Execute($sqlE);
}

function makeList($db) {
	// params to variables
	$sqlE  =
    	"select
    		dpto_codi,
    		dpto_nomb
    		from
    			departamento
    		where
    			id_pais = 170 and
    			id_cont = 1
    		order by
    			dpto_nomb";
	return $db->conn->Execute($sqlE);
}

function makeListMun($db) {
	// params to variables
	$sqlE  =
		"SELECT
			DPTO_CODI,
			MUNI_CODI,
			MUNI_NOMB
			FROM
				MUNICIPIO
			WHERE
				(ID_PAIS = 170)
			AND
				(ID_CONT = 1)";
	return $db->conn->Execute($sqlE);
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

function crearpdf($numradicado, $fecha, $lugar, $remitente, $referencia, $contenido, $asu, $mensaje, $reseptor) {
	class PDF extends FPDF {
		//Cabecera de página
		function Header() {
			//tamaño y fuente del titulo
			$this->SetFont('Arial', 'B', 12);
			//corremos el texto a la derecha y la bajamos
			$this->ln(8);
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
	$pdf->AddPage();
	$pdf->SetTitle("Departamento Nacional de Planeacion");
	$pdf->SetLeftMargin(25);
	$pdf->SetRightMargin(25);
	$pdf->SetFont('Arial','', 12);
	$pdf->ln(20);
	$pdf->Cell(50, 5, $numradicado, 0, 1, L);
	$pdf->Cell(105, 5,$lugar."., ". $fecha, 0, 1, L);
	$pdf->ln(23);
	$pdf->MultiCell(0, 5, $remitente, 0, L);
	$pdf->ln(11);
	$pdf->SetFont('Arial','B', 12);
	$pdf->MultiCell(0, 5, $referencia, 0, C);
	$pdf->SetFont('Arial', '', 12);
	$pdf->ln(8);
	$pdf->MultiCell(0, 5, $contenido, 0, L);
	$pdf->ln(4);
	$pdf->write(5, $asu);
	$pdf->ln(25);
	$pdf->Cell(60, 5, $mensaje, 0, 1, J);
	$pdf->ln(18);
	$pdf->MultiCell(0, 5, $reseptor, 0, L);
	$primerno = substr($numradicado, 0, 4);
	$segundono = substr($numradicado, 4, 3);
	$ruta = "/" . $primerno . "/" . $segundono . "/" . $numradicado;
	$adjuntos = BODEGAPATH . $ruta;
	$pdf->Output($adjuntos . '.pdf', 'f');
	$enlace = "../bodega" . $ruta . '.pdf';
	radi_paht($db, $ruta, $numradicado);

	return $enlace;
}
?>
