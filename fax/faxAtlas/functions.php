<?php
	function doneq_list()
	{
		
		$OUTPUT_REGEXP = "^\|[0-9]";
		unset($exec_output);
		unset($exec_return);
		exec("rsh -l nobody 172.16.1.168 /usr/bin/faxstat -d | sort -t'|' +1n",$exec_output,$exec_return);
		$no_queue = 0;
		print("<table border=\"1\" align=\"center\">");
		print("<thead><caption>Faxes Enviados</caption>");
		print("<td><label>FAX ID</label></td>");
		print("<td><label>Estado</label></td>");
		print("<td><label>Remitente</label></td>");
		print("<td><label>N&uacute;mero</label></td>");
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

        	print "        <td>\n";
        	print "         $dsp_jid\n";
        	print "        </td>\n";
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
		print("<br><table width=\"100%\" border=\"1\">");
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
		exec("rsh -l nobody 172.16.1.168 /usr/bin/faxstat -s | sort",$exec_output,$exec_return);
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
        $dsp_dials  = $dsp_line["6"];
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
		exec("rsh -l nobody 172.16.1.168 /usr/bin/faxstat -r | wc -l ",$exec_output,$exec_return);
		if($exec_output[0] > 0)
		{
			return $exec_output[0]-4;
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
		print("<br><table width=\"100%\" border=\"1\">");
		print("<thead><caption>Entrada</caption><tr>");
		print("<td><label>Archivo:</label></td>");
		print("<td><label>Fecha:</label></td>");
		print("<td><label>Duraci&oacute;n:</label></td>");
		print("<td><label>Remitente:</label></td>");
		print("<td><label>P&aacute;ginas:</label></td>");
		print("<td><label>Acci&oacute;n:</label></td></tr>");
  		print("<tbody>");
		exec("rsh -l nobody 172.16.1.168 /usr/bin/faxstat -r | sort",$exec_output,$exec_return);
		for ($i=0; $i < count($exec_output); $i++) {
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
        print "       <tr>\n";
        print "        <td>\n";
        print "$dsp_filename\n";
        print "        </td>\n";
        print "        <td>\n";
        print "$dsp_time\n";
        print "        </td>\n";
        print "        <td>\n";
        print "$dsp_duration\n";
        print "        </td>\n";
        print "        <td>\n";
        print "$dsp_sender\n";
        print "        </td>\n";
        print "        <td>\n";
        print "$dsp_pages\n";
        print "        </td>\n";
        print "        <td>\n";
        print "<a href=\"../radicacion/chequear.php?faxPath=$dsp_filename"."tif"."&$vars\">Radicar </a>/<a target=\"image\" href=\"image.php?var_filename=" . $dsp_filename . "\">Ver</a>";
        print "        </td>\n";
        print "       </tr>\n";

        $no_queue++;
    }
}
		print("</tbody>");
		print("</table>");
	}
?>
