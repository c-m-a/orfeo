<?php
	function add_ticket($var_filename,$number,$dest,$text, $fax_img = null) {
		unset($exec_output);
		unset($exec_return);
		
    $convert_cmd = "/usr/bin/convert  $var_filename " . IMAGEN_FAX;
    
    if(file_exists($var_filename))
		  exec($convert_cmd, $exec_output, $exec_return);

		if(file_exists(IMAGEN_FAX)) {
			$files .= IMAGEN_FAX . " ";
			echo "entro 19";
			if (!function_exists('imagecreatefromjpeg'))
				die ("no existe");
	
			$image    = imagecreatefromjpeg(IMAGEN_FAX);
			$fuente1  = imageloadfont("arialns.gdf");
			$fuente2  = imageloadfont("arial.gdf");
			$fuente3  = imageloadfont("code.gdf");
			
    imagestring ($image,$fuente1,10,10," Al contestar por favor cite estos datos",$negro);
    imagestring ($image,$fuente2,10,30," Fecha de Radicado: ".date('d-m-Y')."",$negro);
    imagestring ($image,$fuente2,10,50," No. de Radicado:20075000000491",$negro);	
    imagestring ($image,$fuente3,10,70," 20075000000491",$negro);
    imagejpeg   ($image, IMAGEN_FAX, 100);
		} else {
			$i = 0;
			while(file_exists(IMAGEN_FAX.".$i")) {
				$image  = imagecreatefrompng(IMAGEN_FAX.".$i");
				$negro  = imagecolorallocate($image,0,0,0);
				$x      = imagesx($image);
				imagerectangle($image,$x/2-5,90,$x/2+240,170,$negro);
				imagestring($image,5,$x/2,100,"SUPERSOLIDARIA Rad No. $number",$negro);
				imagestring($image,5,$x/2,120,"$text",$negro);
				imagestring($image,5,$x/2,140,"Gestion Documental Orfeo",$negro);
				imagepng($image, IMAGEN_FAX . ".$i");	
				$files .= IMAGEN_FAX . ".$i ";
				$i++;
				imagedestroy($image);
			}
			echo "entro else fax_temp";
		}
		
		unset($exec_output);
		unset($exec_return);
    $convert = "/usr/bin/convert -adjoin $files $dest";
		
		exec($convert, $exec_output, $exec_return);
		echo $convert;
		
		if(file_exists(IMAGEN_FAX)) {
			exec("rm -rf " . IMAGEN_FAX);
		} else {
			$i = 0;
			while(file_exists(IMAGEN_FAX.".$i")) {
				exec("rm -rf " . IMAGEN_FAX . ".$i");
				$i++;
			}
		}
}
	function doneq_list($servidor_fax, $usuario_admin_fax) {
		$usuario_fax = $usuario_admin_fax;
		$servfax = $servidor_fax;
		$OUTPUT_REGEXP = "^\|[0-9]";
		unset($exec_output);
		unset($exec_return);
		$sshExec = "ssh '$usuario_fax@$servfax' /usr/bin/faxstat -d | sort -t'|' +1n";
		exec($sshExec, $exec_output, $exec_return);
		//exec("/usr/bin/faxstat -d | sort -t'|' +1n",$exec_output,$exec_return);
		$no_queue = 0;
		print("<table class=borde_tab  align=\"center\" width='100%'>");
		print("<TR class=titulos5><TD><CENTER>FAXES ENVIADOS</TD></TR>");
		print("</table>");
		print("<table class=borde_tab  align=\"center\" width='100%'>");
		print("<td class=titulos5><label>FAX ID</label></td>");
		print("<td class=titulos5><label>Estado</label></td>");
		print("<td class=titulos5><label>Remitente</label></td>");
		print("<td class=titulos5><label>N&uacute;mero</label></td>");
		print("<td class=titulos5><label>Destinatario</label></td>");
		print("<td class=titulos5><label>P&aacute;ginas</label></td>");
		print("<td class=titulos5><label>Marcaciones</label></td>");
		print("<td class=titulos5><label>Hora</label></td>");
		print("<td class=titulos5><label>Estado</label></td>");
		print("<td class=titulos5><label>Acci&oacute;n</label></td>");
		print("</tr>");
		
	for ($i=0; $i < count($exec_output); $i++) {
    	if ( ereg($OUTPUT_REGEXP,$exec_output[$i]) ) {
        	print "       <tr align=\"center\" class=listado2>\n";
        	$dsp_line = explode("|", $exec_output[$i]);

        	$dsp_jid    = $dsp_line["1"];
        	$dsp_state  = $dsp_line["2"];
        	$dsp_sender = $dsp_line["3"];
        	$dsp_number = $dsp_line["4"];
        	$dsp_destin = $dsp_line["9"];
          $dsp_pages  = $dsp_line["5"];
        	$dsp_dials  = $dsp_line["6"];
        	$dsp_tts    = $dsp_lsftp["7"];
        	
          if ($dsp_tts == "")
            	$dsp_tts = "-";

        	$dsp_status = $dsp_line["8"];
        	
          if ($dsp_status == "")
            	$dsp_status = "-";
        	
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
        	print "        <a href=\"http://192.127.28.30/fax/viewdq.php?var_jid=" . $dsp_jid . "\">Ver</a>\n";
        	print "        <a href=\"deldq.php?var_jid=" . $dsp_jid . "\">/Borrar</a>\n";
        	print "        </td>\n";
        	print "       </tr>\n";
        	$no_queue++;
    }
}
    print("</tbody></table>");
}
	function sendq_list($servidor_fax, $usuario_admin_fax = null) {
		$servfax = $servidor_fax;
		$usuario_fax = 'orfeofax';
		$OUTPUT_REGEXP = "^\|[0-9]";
		print("<table class=borde_tab  align=\"center\" width='100%'>");
		print("<TR class=titulos5><TD><CENTER>FAXES ENPROCESO DE ENVIO</TD></TR>");
		print("</table>");
		print("<table class=borde_tab  align=\"center\" width='100%'><TR class=titulos5>");
		print("<td class=titulos5><label>FAX ID</label></td>");
		print("<td class=titulos5><label>Estado</label></td>");
		print("<td class=titulos5><label>Destinatario</label></td>");
		print("<td class=titulos5><label>Remitente</label></td>");
		print("<td class=titulos5><label>N&uacute;mero</label></td>");
		print("<td class=titulos5><label>P&aacute;ginas</label></td>");
		print("<td class=titulos5><label>Marcaciones</label></td>");
		print("<td class=titulos5><label>Hora</label></td>");
		print("<td class=titulos5><label>Estados</label></td>");
		print("<td class=titulos5><label>Acci&oacute;n</label></td></tr>");
  		print("<tbody>");
		unset($exec_output);
		unset($exec_return);
    $sendq_list_cmd = "ssh '$usuario_fax@$servfax' /usr/bin/faxstat -s | sort";
		exec($sendq_list_cmd, $exec_output, $exec_return);
		$no_queue = 0;
	for ($i=0; $i < count($exec_output); $i++) {
    	if ( ereg($OUTPUT_REGEXP,$exec_output[$i]) ) {
        print "       <tr align=\"center\"  class='listado2'>\n";
        $dsp_line   = explode("|", $exec_output[$i]);
        $dsp_jid    = $dsp_line["1"];
        $dsp_state  = $dsp_line["2"];
        $dsp_sender = $dsp_line["3"];
        $dsp_number = $dsp_line["4"];
        $dsp_pages  = $dsp_line["5"];
        $dsp_dials  = $dsp_line["6"];
        $dsp_tts    = $dsp_line["7"];
        $dsp_destin = $dsp_line["9"];
        
        if ($dsp_tts == "")
          $dsp_tts = "-";

        $dsp_status = $dsp_line["8"];
        
        if ($dsp_status == "")
            $dsp_status = "-";

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

	function inbox_num($servidor_fax, $usuario_admin_fax = null) {
		$usuario_fax = 'orfeofax';
		$servfax = $servidor_fax;//nueva maqr 20080417		
		exec("ssh '$usuario_fax@$servfax' /usr/bin/faxstat -r | wc -l ",$exec_output,$exec_return);
		
    return ($exec_output[0] > 0)? $exec_output[0]-7 : 0;
	}
	
	function ls($servidor_fax, $usuario_admin_fax = null) {
		$servfax = $servidor_fax;
		$usuario_fax = 'orfeofax';
    $ls_cmd = "ssh '$usuario_fax@$servfax' ls";
		exec($ls_cmd, $exec_output, $exec_return);
		return count($exec_output);
	}
	
  // Lista todos los Faxes que han llegado y que se encuentran en la bandeja de entrada
	function recvq_list($conexion_basedatos, $usuario, $usuario_admin_fax, $session_vars, $servidor_fax, $password = null) {
		$krd = $usuario;
		$vars = $session_vars;
		$db = $conexion_basedatos;
		global $radSel;
		$servfax = $servidor_fax;
		$acceso = (isset($password))? "-P $password": null;
		$usuario_fax = $usuario_admin_fax;
		$faxes_recibidos = "ssh '$usuario_fax@$servfax' $acceso /usr/bin/faxstat -r | sort -k6b";

		echo "bandeja de entrada fax";
		$OUTPUT_REGEXP = "fax";
		$fechah = date("Ymd_his");
		echo "<script>
		function verPdf(imagen,noTiff) {
			document.getElementById(noTiff).className='tSel';
			parent.image.location.href='image.php?var_filename='+imagen;
			parent.formulario.location.href='form.php?lista=inbox&".session_name()."=".session_id()."&krd=$krd&fechah=$fechah&primera=1&ent=2&radSel='+noTiff+'&pp=99';
			noTiffOld = noTiff;
		}
		</script>";
		
		print("<table width=\"100%\"  class=borde_tab cellpadding=2 cellspacing=2 border=0>");
		print("<tr class=titulos3><td>FAX RECIBIDOS  ($radSel)</td></tr>");
		print("</table>");
		print("<table width=\"100%\"  class=borde_tab cellpadding=2 cellspacing=2 border=0>");
		print("<td  class=titulos5>Archivo:</td>");
		print("<td  class=titulos5>Fecha:</td>");
		print("<td  class=titulos5>Duraci&oacute;n:</td>");
		print("<td  class=titulos5>Remitente:</td>");
		print("<td class=titulos5>P&aacute;ginas:</td>");
		print("<td class=titulos5>Reserva</td></tr>");
  		print("<tbody>");
		exec($faxes_recibidos,$exec_output,$exec_return);
		$iClass = 2;
//		echo "".$exec_return;
		//echo count($exec_output); 
		for ($i=0; $i < count($exec_output); $i++) {
			if($iClass == 1) $tClass = "listado1 ";
			else $tClass = "listado2 ";
			if($iClass == 1) $iClass =2; else $iClass =1;
			
			if ( ereg($OUTPUT_REGEXP,$exec_output[$i]) ) {
        $dsp_line = explode(" ", $exec_output[$i]);
        $pattern = '/fax[0-9]+/';
        preg_match($pattern, $exec_output[$i], $tif_file);
        $dsp_filename = $tif_file[0];
        //$dsp_filename = ereg_replace("\.tif",".$RECVQ_FORMAT",$dsp_line["1"]);
        $dsp_time     = $dsp_line["2"];
        $dsp_duration = $dsp_line["3"];
        $dsp_sender   = $dsp_line["4"];
        $dsp_pages    = $dsp_line["5"];
        $noTiff = substr($dsp_filename,0,12);
        if($radSel == $noTiff) $tClass = "tSel ";
        
        if ($dsp_sender == "")
            $dsp_sender = "-";

                $iSql= " SELECT
                USUA_LOGIN
                ,TO_CHAR(SGD_RFAX_FECH, 'YYYY-MM-DD hh24:mi:ss') SGD_RFAX_FECH
              FROM  SGD_RFAX_RESERVAFAX
              WHERE
              SGD_RFAX_FAX='$dsp_filename".".tif'
              ORDER BY SGD_RFAX_FECH DESC";
          $rs = $db->conn->query($iSql);
          $usuaLogin = $rs->fields("USUA_LOGIN");
          $reservaFech = $rs->fields("SGD_RFAX_FECH");
          $fecha = (substr($dsp_time,0,11)); 
          $hora = (substr($dsp_time,11,2));
          $time = substr($dsp_time,13,9) ;
          $horaAdaptada = "$fecha  ($hora$time)";
          print "       <tr ID='$noTiff' class=$tClass>\n";
          print "        <td class=$tClass>\n<span class=leidos>";
          print "$dsp_filename\n ";
          print "        </span></td>\n";
          print "        <td class=$tClass>\n<span class=leidos>";
          print "$horaAdaptada";
          print "        </span></td>\n";
          print "        <td class=$tClass>\n<span class=leidos>";
          print "$dsp_duration\n";
          print "        </span></td>\n";
          print "        <td class=$tClass>\n<span class=leidos>";
          print "$dsp_sender\n";
          print "        </span></td>\n";
          print "        <td class=$tClass>\n<span class=leidos>";
          print "$dsp_pages\n";
          print "        </span></td>\n";
          print "        <td class=$tClass>\n<span class=leidos>";
          //print "<a  href='#' onClick='verPdf(".chr(34)."$dsp_filename".chr(34).",".chr(34).$noTiff.chr(34).");'>Ver Pdf</a>/";
          print "<a  href='#' onClick='verPdf(".chr(34)."$dsp_filename".chr(34).",".chr(34).$noTiff.chr(34).");'>Ver Pdf</a>/";
          var_dump(file_exists(BODEGA_FAX_TMP . "$dsp_filename".".tif") OR ($radSel == $noTiff));
          if(file_exists(BODEGA_FAX_TMP . "$dsp_filename".".tif") OR ($radSel == $noTiff)) {
            echo "<a href=\"../radicacion/chequear.php?faxPath=$dsp_filename"."tif"."&$vars\">Radicar </a>/";
            echo "<a target='image' href='../descargar_archivo.php?ruta_archivo=/faxtmp/$dsp_filename.tif&nombre_archivo=" . $dsp_filename . ".tif'>Ver tif</a>/";

				} else {
				  print "/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/";
				}
				print "<a target=image href='borrarFax.php?faxBorrar=".$dsp_filename."&krd=$krd'>Borrar</a>/</td>\n";
        print "<td class=$tClass>\n<span class=leidos></span>$usuaLogin - $reservaFech</td>\n";
        print "</tr>\n";

        $no_queue++;
    }
}
		print("</tbody>");
		print("</table>");
	}

function faxStat_list($servidor_fax, $session_vars, $usuario_admin_fax) {
		$vars = $session_vars;
		$servfax = $servidor_fax;
		$usuario_fax = $usuario_admin_fax;
		$OUTPUT_REGEXP = "^\|fax";
		print("<table width=\"100%\"  class=t_bordeGris>");
		print("<thead><caption></caption><tr class=t_bordeGris>");
		print("<td  class=titulos5 align=center><span class=etitulo><label><b>Estado de los Modem (<font color=red>".date("Y-m-d H:i:s")."</font>)</b></td>");
		print("</tr>");
  		print("<tbody>");
    $stats_cmd = "ssh '$usuario_fax@$servfax' /usr/bin/faxstat -d | grep -v '|'";
		exec($stats_cmd, $exec_output, $exec_return);         
		print_r($exec_return);
		$iClass = 2;
		//Answering the phone
		//Receiving facsimile
		foreach ($exec_output as $key => $a) {
		  $a = str_replace("Running and idle","Encendido (<font color=green>Ok</font>) y Esperando Fax. ",$a);
			$a = str_replace("Answering the phone","Respondiendo el telefono . . .",$a);
      $a = str_replace("Receiving facsimile","<font color=green>Recibiendo Fax . . .</font>",$a);
      $a = str_replace("HylaFAX scheduler on","<center><b>SISTEMA DE CONTROL DE FAX-ORFEO EJECUTANDOSE SOBRE </b>",$a);
      $a = str_replace(": Running","<font color=green>:FUNCIONADO OK</font>",$a);

      $tClass = ($iClass == 1)? " class=tparr " : " class=timparr ";
      $iClass = ($iClass == 1)? 2 : 1;
			
      print "       <tr >\n";
      print "        <td $tClass>\n<span class=$tClass>";
      print "$a\n";
      print "        </span></td>\n";
      print "       </tr>\n";
	}
		print("</tbody>");
		print("</table>");
	}

	function recvq_list_historico($conexion_basedatos, $usuario = null, $session_vars = null) {
		$db = $conexion_basedatos;
		$krd = $usuario;
		$vars = $session_vars;
		$OUTPUT_REGEXP = "^\|fax";
		print("<table width=100%  class=borde_tab>");
		print("<tr class=titulos5><td><CENTER>HISTORICO DE ARCHIVOS RECIBIDOS POR FAX</CENTER></td></tr>");
		print("</table>");
		print("<table width=\"100%\"  class=borde_tab>");
		print("<tr class=titulos5><td  class=titulos5>Archivo:</td>");
		print("<td class=titulos5>Acci&oacute;n:</td>");
		print("<td class=titulos5>Reserva</td>");
		print("<td class=titulos5>Radicado</td>");
		print("<td class=titulos5>Observaciones</td></tr>");
		exec("ls -t ../bodega/faxtmp/*tif",$exec_output,$exec_return);         
		$iClass = 2;
		for ($i=0; $i < count($exec_output); $i++) {
			if($iClass == 1) $tClass = " class=listado1 "; else $tClass = " class=listado2 ";
			if($iClass == 1) $iClass =2; else $iClass =1;
			
    	//if ( ereg($OUTPUT_REGEXP,$exec_output[$i]) ) {
			if(!$exec_return){
        $dsp_line = explode(" ", $exec_output[$i]);
        $dsp_filename = substr(ereg_replace("\.tif",".$RECVQ_FORMAT",$dsp_line["0"]),-13);
        $dsp_time     = $dsp_line["2"];
        $dsp_duration = $dsp_line["3"];
        $dsp_sender   = $dsp_line["4"];
        if ($dsp_sender == "") { 
            $dsp_sender = "-";
        }
					$iSql= " SELECT
							USUA_LOGIN
							,TO_CHAR(SGD_RFAX_FECH, 'YYYY-MM-DD hh24:mi:ss') SGD_RFAX_FECH
							,TO_CHAR(SGD_RFAX_FECHRADI, 'YYYY-MM-DD hh24:mi:ss') SGD_RFAX_FECHRADI
							,RADI_NUME_RADI
							,SGD_RFAX_OBSERVA 
						FROM  SGD_RFAX_RESERVAFAX
						WHERE
						SGD_RFAX_FAX='$dsp_filename"."tif'
						ORDER BY SGD_RFAX_FECHRADI DESC, SGD_RFAX_FECH DESC
				";
				$rs = $db->conn->query($iSql);
				$usuaLogin = $rs->fields("USUA_LOGIN");
				$reservaFech = $rs->fields("SGD_RFAX_FECH");
				$radiFech = $rs->fields("SGD_RFAX_FECHRADI");
				$faxObserva = $rs->fields("SGD_RFAX_OBSERVA");
				$radiNumeRadi = $rs->fields("RADI_NUME_RADI");
				$radiPath = "../bodega/".substr($radiNumeRadi,0,4)."/".substr($radiNumeRadi,4,3)."/".$radiNumeRadi . ".tif";
				//$hrefRadicado = "<a href='$radiPath' target=$radiNumeRadi>$radiNumeRadi</a>";
				$hrefRadicado = "<a class='vinculos' href='./descargar_archivo.php?ruta_archivo=$radiPath&nombre_archivo=" . $radiNumeRadi . ".tif'>$radiNumeRadi</a>";
        $dsp_pages    = $dsp_line["5"];
        print "       <tr >\n";
        print "        <td $tClass>\n<span class=tpar>";
        print "$dsp_filename\n";
        print "        </span></td>\n";
        print "        <td $tClass>\n<span class=tpar>";
        print "<a target=image href='../bodega/faxtmp/$dsp_filename"."pdf'>Ver Pdf</a>/";
				if(file_exists("../bodega/faxtmp/$dsp_filename"."tif")) {
				  print "<a class='vinculos' href='./descargar_archivo.php?ruta_archivo=/bodega/faxtmp/$dsp_filename&nombre_archivo=" . $dsp_filename . ".tif'>Ver tif</a>/";
					//print "<a target=image href=../bodega/faxtmp/".$dsp_filename."tif>Ver tif</a>/";
				} else {
					print "/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;//&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/";
				}
				print "</td>\n";
        print "<td $tClass>\n<span class=tpar></span>$usuaLogin - $reservaFech</td>\n";
				print "<td $tClass>\n<span class=tpar></span>$hrefRadicado - $radiFech</td>\n";
				print "<td $tClass>\n<span class=tpar></span>$faxObserva</td>\n";
        print "</tr>\n";
        $no_queue++;
    }
}
		print("</tbody>");
		print("</table>");
	}
?>
