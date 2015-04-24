<?php
	function add_ticket($var_filename,$number,$dest,$text)
{
		$fax_tmp = "/tmp/fax.png";
		error_reporting(7);
		unset($exec_output);
		unset($exec_return);
		if(file_exists($var_filename))
		{
			exec("/usr/bin/convert  $var_filename $fax_tmp",$exec_output,$exec_return);
		}
		
		if(file_exists($fax_tmp))
		{
			$files .= $fax_tmp." ";
			$image = imagecreatefrompng($fax_tmp);
			$negro = imagecolorallocate($image,0,0,0);
			$x=imagesx($image);
			imagerectangle($image,$x/2-5,90,$x/2+240,170,$negro);
			imagestring($image,5,$x/2,100,"SSPD Rad No. $number",$negro);
			imagestring($image,5,$x/2,120,$text,$negro);
			imagestring($image,5,$x/2,140,"Gestion Documental Orfeo",$negro);
			imagepng($image,$fax_tmp);
			imagedestroy($image);
		}
		else 
		{
			$i = 0;
			while(file_exists($fax_tmp.".$i"))
			{
				$image = imagecreatefrompng($fax_tmp.".$i");
				$negro = imagecolorallocate($image,0,0,0);
				$x=imagesx($image);
				imagerectangle($image,$x/2-5,90,$x/2+240,170,$negro);
				imagestring($image,5,$x/2,100,"SSPD Rad No. $number",$negro);
				imagestring($image,5,$x/2,120,"$text",$negro);
				imagestring($image,5,$x/2,140,"Gestion Documental Orfeo",$negro);
				imagepng($image,$fax_tmp.".$i");	
				$files .= $fax_tmp.".$i ";
				$i++;
				imagedestroy($image);
			}
		}
		
		
		unset($exec_output);
		unset($exec_return);
		
		exec("/usr/bin/convert -adjoin $files $dest",$exec_output,$exec_return);
		
		if(file_exists($fax_tmp))
		{
			exec("rm -rf $fax_tmp");
		}
		else
		{
			$i = 0;
			while(file_exists($fax_tmp.".$i"))
			{
				exec("rm -rf $fax_tmp".".$i");
				$i++;
			}
			
		}
}
	function doneq_list()
	{

		$OUTPUT_REGEXP = "^\|[0-9]";
		unset($exec_output);
		unset($exec_return);
		exec("ssh -l orfeo 172.16.1.168 /usr/bin/faxstat -d | sort -t'|' +1n",$exec_output,$exec_return);
		$no_queue = 0;
		print("<table class=celdaGris  align=\"center\">");
		print("<thead><caption>Faxes Enviados</caption>");
		print("<td class=celdaGris><label>FAX ID</label></td>");
		print("<td class=celdaGris><label>Estado</label></td>");
		print("<td class=celdaGris><label>Remitente</label></td>");
		print("<td class=celdaGris><label>N&uacute;mero</label></td>");
		print("<td><label>Destinatario</label></td>");
		print("<td><label>P&aacute;ginas</label></td>");
		print("<td><label>Marcaciones</label></td>");
		print("<td><label>Hora</label></td>");
		print("<td><label>Estado</label></td>");
		print("<td><label>Acci&oacute;n</label></td>");
		print("</thead><tbody>");
		
	for ($i=0; $i < count($exec_output); $i++) {
    	if ( ereg($OUTPUT_REGEXP,$exec_output[$i]) ) {
        	print "       <tr align=\"center\" bgcolor=\"#ffffff\">\n";
        	$dsp_line = explode("|", $exec_output[$i]);

        	$dsp_jid    = $dsp_line["1"];
        	$dsp_state  = $dsp_line["2"];
        	$dsp_sender = $dsp_line["3"];
        	$dsp_number = $dsp_line["4"];
        	$dsp_destin = $dsp_line["9"];
			$dsp_pages  = $dsp_line["5"];
        	$dsp_dials  = $dsp_line["6"];
        	$dsp_tts    = $dsp_line["7"];
        	if ($dsp_tts == "") {
            	$dsp_tts = "-";
        	}

        	$dsp_status = $dsp_line["8"];
        	if ($dsp_status == "") {
            	$dsp_status = "-";
        	}

        	print "        <td  class=celdaGris>\n";
        	print "         $dsp_jid\n";
        	print "        </td  class=celdaGris>\n";
        	print "        <td>\n";
        	print "         $dsp_state\n";
        	print "        </td>\n";
        	print "        <td>\n";
        	print "         $dsp_sender\n";
        	print "        </td>\n";
        	print "        <td>\n";
        	print "         $dsp_number\n";
        	print "        </td>\n";
        	print "        <td>\n";
			print "         $dsp_destin\n";
        	print "        </td>\n";
        	print "        <td>\n";
        	print "         $dsp_pages\n";
        	print "        </td>\n";
        	print "        <td>\n";
        	print "         $dsp_dials\n";
        	print "        </td>\n";
        	print "        <td>\n";
        	print "         $dsp_tts\n";
        	print "        </td>\n";
        	print "        <td>\n";
        	print "         $dsp_status\n";
        	print "        </td>\n";
        	print "        <td>\n";
        	print "        <a href=\"http://172.16.1.168/fax/viewdq.php?var_jid=" . $dsp_jid . "\">Ver</a>\n";
        	print "        <a href=\"deldq.php?var_jid=" . $dsp_jid . "\">/Borrar</a>\n";
        	print "        </td>\n";
        	print "       </tr>\n";
        	$no_queue++;
    }
}
    print("</tbody></table>");
}
	function sendq_list()
	{
		$OUTPUT_REGEXP = "^\|[0-9]";
		print("<br><table width=\"100%\"  class=celdaGris>");
		print("<thead><caption>Faxes en Proceso de Envio</caption><tr>");
		print("<td><label>FAX ID</label></td>");
		print("<td><label>Estado</label></td>");
		print("<td><label>Destinatario</label></td>");
		print("<td><label>Remitente</label></td>");
		print("<td><label>N&uacute;mero</label></td>");
		print("<td><label>P&aacute;ginas</label></td>");
		print("<td><label>Marcaciones</label></td>");
		print("<td><label>Hora</label></td>");
		print("<td><label>Estados</label></td>");
		print("<td><label>Acci&oacute;n</label></td></tr>");
  		print("<tbody>");
		unset($exec_output);
		unset($exec_return);
		exec("ssh -l orfeo 172.16.1.168 /usr/bin/faxstat -s | sort",$exec_output,$exec_return);
		$no_queue = 0;
	for ($i=0; $i < count($exec_output); $i++) {
    	if ( ereg($OUTPUT_REGEXP,$exec_output[$i]) ) {
        print "       <tr align=\"center\" bgcolor=\"#ffffff\">\n";
        $dsp_line = explode("|", $exec_output[$i]);
		$dsp_jid    = $dsp_line["1"];
        $dsp_state  = $dsp_line["2"];
        $dsp_sender = $dsp_line["3"];
        $dsp_number = $dsp_line["4"];
        $dsp_pages  = $dsp_line["5"];
        $dsp_dials 
+
 = $dsp_line["6"];
        $dsp_tts    = $dsp_line["7"];
        $dsp_destin = $dsp_line["9"];
        if ($dsp_tts == "") {
            $dsp_tts = "-";
        }

        $dsp_status = $dsp_line["8"];
        if ($dsp_status == "") {
            $dsp_status = "-";
        }

        print "        <td>\n";
        print "         $dsp_jid\n";
        print "        </td>\n";
        print "        <td>\n";
        print "         $dsp_state\n";
        print "        </td>\n";
        print "        <td>\n";
        print "         $dsp_destin\n";
        print "        </td>\n";
        print "        <td>\n";
        print "         $dsp_sender\n";
        print "        </td>\n";
        print "        <td>\n";
        print "         $dsp_number\n";
        print "        </td>\n";
        print "        <td>\n";
        print "         $dsp_pages\n";
        print "        </td>\n";
        print "        <td>\n";
        print "         $dsp_dials\n";
        print "        </td>\n";
        print "        <td>\n";
        print "         $dsp_tts\n";
        print "        </td>\n";
        print "        <td>\n";
        print "         $dsp_status\n";
        print "        </td>\n";
        print "        <td>\n";
		print "        &nbsp;<a href=\"killq.php?var_jid=" . $dsp_jid . "\">Eliminar</a>\n";
        print "        </td>\n";        
        print "       </tr>\n";

        $no_queue++;
    }
}
	print("</tbody>");
	print("</table>");
	}
	function inbox_num()
	{
		exec("ssh -l orfeo 172.16.1.168 /usr/bin/faxstat -r | wc -l ",$exec_output,$exec_return);
		if($exec_output[0] > 0)
		{
			return $exec_output[0]-7;
		}
		else
		{
			return 0;
		}
	}
	function recvq_list()
	{
		global $vars;
		$OUTPUT_REGEXP = "^\|fax";
		print("<br><table width=\"100%\"  class=t_bordeGris>");
		print("<thead><caption>Entrada</caption><tr class=t_bordeGris>");
		print("<td  class=grisCCCCCC><span class=etextomenu><label>Archivo:</label></span></td>");
		print("<td  class=grisCCCCCC><span class=etextomenu><label>Fecha:</label></span></td>");
		print("<td  class=grisCCCCCC><span class=etextomenu><label>Duraci&oacute;n:</label></span></td>");
		print("<td  class=grisCCCCCC><span class=etextomenu><label>Remitente:</label></span></td>");
		print("<td class=grisCCCCCC><span class=etextomenu><label>P&aacute;ginas:</label></span></td>");
		print("<td class=grisCCCCCC><span class=etextomenu><label>Acci&oacute;n:</label></span></td></tr>");
  		print("<tbody>");
		exec("ssh -l orfeo 172.16.1.168 /usr/bin/faxstat -r | sort",$exec_output,$exec_return);         
		$iClass = 2;
		for ($i=0; $i < count($exec_output); $i++) {
			if($iClass == 1) $tClass = " class=tparr "; else $tClass = " class=timparr ";
			if($iClass == 1) $iClass =2; else $iClass =1;
			
    	if ( ereg($OUTPUT_REGEXP,$exec_output[$i]) ) {
        $dsp_line = explode("|", $exec_output[$i]);
        $dsp_filename = ereg_replace("\.tif",".$RECVQ_FORMAT",$dsp_line["1"]);
        $dsp_time     = $dsp_line["2"];
        $dsp_duration = $dsp_line["3"];
        $dsp_sender   = $dsp_line["4"];
        if ($dsp_sender == "") { 
            $dsp_sender = "-";
        }
        $dsp_pages    = $dsp_line["5"];
        print "       <tr >\n";
        print "        <td $tClass>\n<span class=tpar>";
        print "$dsp_filename\n";
        print "        </span></td>\n";
        print "        <td $tClass>\n<span class=tpar>";
        print "$dsp_time\n";
        print "        </span></td>\n";
        print "        <td $tClass>\n<span class=tpar>";
        print "$dsp_duration\n";
        print "        </span></td>\n";
        print "        <td $tClass>\n<span class=tpar>";
        print "$dsp_sender\n";
        print "        </span></td>\n";
        print "        <td $tClass>\n<span class=tpar>";
        print "$dsp_pages\n";
        print "        </span></td>\n";
        print "        <td $tClass>\n<span class=tpar>";
        print "<a href=\"../radicacion/chequear.php?faxPath=$dsp_filename"."tif"."&$vars\">Radicar </a>/<a target=\"image\" href=\"image.php?var_filename=" . $dsp_filename . "\">Ver</a>";
        print "        </span></td>\n";
        print "       </tr>\n";

        $no_queue++;
    }
}
		print("</tbody>");
		print("</table>");
	}
?>
