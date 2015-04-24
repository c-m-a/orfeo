<?
	error_reporting(7);
        require_once('../include/pdf/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P','A4','fr');
        $pdf->WriteHTML($content, isset($_GET['vuehtml']));
        $pdf->Output();
?>
