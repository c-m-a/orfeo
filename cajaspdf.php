<?
  session_start();
  /** Este se utiliza para anular la plantilla en el 
   * Caso que viniera enviar o enviar_new que son los
   * Utilizados para gabar la plantilla
   */

  if (!$enviar and !enviar_new) {
    $plantilla = "";
  }
?>
<script>
function gen_pdf()
{
   document.pdf.submit();
}
</script>
<?
  
  if (!$numrad) {
    $numrad = $verrad;
  }

  $usuacodi = "1";
  $datos    = "";
  $dir_t    = "plantillas/txt/$dependencia/";
  $dirtmp   = "plantillas/tmp_txt/$dependencia/";
  $dirpdf   = "plantillas/tmp_pdf/$dependencia/";
  if (!$archivo) {
    $archivo = "plantillas/txt/$dependencia/$plantilla.txt";
  }
  $archivotmp = "plantillas/tmp_txt/$dependencia/$plantilla.txt";
  $archivopdf = "plantillas/tmp_pdf/$dependencia/$plantilla.pdf";
  $krd        = strtoupper($krd);
  $fechah     = date("dmy") . " " . time("h_m_s");
  $check      = 1;
  $fechaf     = date("dmy") . "_" . time("hms");
  $numeroa    = 0;
  $numero     = 0;
  $numeros    = 0;
  $numerot    = 0;
  $numerop    = 0;
  $numeroh    = 0;
  $isql       = "select RADI_REM,RADI_NUME_RADI,RADI_NOMB,RADI_NUME_IDEN,RADI_FECH_RADI,RADI_SEGU_APEL,RADI_SEGU_APEL,RADI_DIRE_CORR from  RADICADO where RADI_NUME_RADI = $verrad ";
  $rs         = $db->query($isql);
  $rnombre    = $rs->fields["RADI_NOMB"];
  $radicado   = $rs->fields["RADI_NUME_RADI"];
  $fecharad   = $rs->fields["RADI_FECH_RADI"];
  $rapellidos = $rs->fields["RADI_SEGU_APEL"] . " " . $rs->fields["RADI_PRIM_APEL"];
  $rdocumento = $rs->fields["RADI_NUME_IDEN"];
  $rdireccion = $rs->fields["RADI_DIRE_CORR"];
  $remitente  = $rs->fields["RADI_REM"];
  $asunto     = $rs->fields["RADI_ASU"];
  $cuentai    = $rs->fields["RADI_CUENTAI"];
  
  if ($alltext and $enviar) {
    $fp = fopen($archivo, "w");
    fputs($fp, $alltext);
    fclose($fp);
  }
  
  if ($enviar or $enviar_new) {
    include "ver_datosrad.php";
    if ($enviar_new) {
      $isql_hl  = "select PLG_CODI from PL_GENERADO_PLG order by PLG_CODI desc";
      $rs       = $db->query($isql_hl);
      $plg_codi = $rs->fields["PLG_CODI"] + 1;
      
      //$plg_codi = str_pad($plg_codi,4,"0",STR_PAD_left);
      $plg_comentarios = "";
      $plt_codi        = 0;
      $archivo         = $dir_t . $numrad . "_$plg_codi.txt";
      
      $record["DEPE_CODI"]         = $dependencia;
      $record["RADI_NUME_RADI"]    = $verrad;
      $record["PLT_CODI"]          = $plt_codi;
      $record["PLG_CODI"]          = $plg_codi;
      $record["PLG_COMENTARIOS"]   = '$plg_comentarios';
      $record["PLG_CREA"]          = $codusuario;
      $record["PLG_ANALIZA"]       = 0;
      $record["PLG_FIRMA"]         = 0;
      $record["PLG_AUTORIZA"]      = 0;
      $record["PLG_IMPRIME"]       = 0;
      $record["PLG_ENVIA"]         = 0;
      $record["PLG_ARCHIVO_TMP"]   = '$archivo';
      $record["PLG_ARCHIVO_FINAL"] = '';
      $record["PLG_NOMBRE"]        = '$nombre_pl';
      $record["PLG_CREADOR"]       = '$krd';
      $db->insert("PL_GENERADO_PLG", $record);
    }
    
    if ($enviar) {
      $plg_codi     = str_pad($plg_codi, 4, "0", STR_PAD_left);
      $isql         = "select * from  PL_GENERADO_PLG where plg_codi=$plg_codi and radi_nume_radi=$numrad";
      $rs           = $db->query($isql);
      $plt_codi     = $rs->fields["PLT_CODI"];
      $radicado_sal = $rs->fields["RADI_NUME_SAL"];
      echo "Radicado asignado de Salida " . $radicado_sal;
      if ($plt_codi < 1) {
        $plt_codi = 1;
      }
      $plg_comentarios           = "";
      //	  $isql = "update PL_GENERADO_PLG set plg_nombre='$nombre_pl',plt_codi=$plt_codi where PLG_CODI=$plg_codi AND RADI_NUME_RADI=$verrad";
      $record["plg_nombre"]      = '$nombre_pl';
      $record["plt_codi"]        = $plt_codi;
      $record1["PLG_CODI"]       = $plg_codi;
      $record1["RADI_NUME_RADI"] = $verrad;
      $db->update("PL_GENERADO_PLG", $record, $record1);
    }
    if ($alltext) {
      $fp = fopen($archivo, "w");
      fputs($fp, $alltext);
      fclose($fp);
      
    }
    $fdia        = date("d");
    $fdia_nombre = date("D");
    $fmes        = date("m");
    $fmes_nombre = date("M");
    $fano        = date("Y");
    if ($fmes_nombre == "Jan") {
      $fmes_nombre = "Enero";
    }
    if ($fmes_nombre == "Feb") {
      $fmes_nombre = "Enero";
    }
    if ($fmes_nombre == "Mar") {
      $fmes_nombre = "Marzo";
    }
    if ($fmes_nombre == "Apr") {
      $fmes_nombre = "Abril";
    }
    if ($fmes_nombre == "May") {
      $fmes_nombre = "Mayo";
    }
    if ($fmes_nombre == "Jun") {
      $fmes_nombre = "Junio";
    }
    if ($fmes_nombre == "Jul") {
      $fmes_nombre = "Julio";
    }
    if ($fmes_nombre == "Aug") {
      $fmes_nombre = "Agosto";
    }
    if ($fmes_nombre == "Sep") {
      $fmes_nombre = "Septiembre";
    }
    if ($fmes_nombre == "Oct") {
      $fmes_nombre = "Octubre";
    }
    if ($fmes_nombre == "Nov") {
      $fmes_nombre = "Noviembre";
    }
    if ($fmes_nombre == "Dec") {
      $fmes_nombre = "Diciembre";
    }
    if ($fdia_nombre == "Mon") {
      $fdia_nombre = "Lunes";
    }
    if ($fdia_nombre == "Tue") {
      $fdia_nombre = "Martes";
    }
    if ($fdia_nombre == "Wed") {
      $fdia_nombre = "Miercoles";
    }
    if ($fdia_nombre == "Thu") {
      $fdia_nombre = "Jueves";
    }
    if ($fdia_nombre == "Fri") {
      $fdia_nombre = "Viernes";
    }
    if ($fdia_nombre == "St") {
      $fdia_nombre = "Sabado";
    }
    if ($fdia_nombre == "Sun") {
      $fdia_nombre = "Domingo";
    }
    $alltext_tmp = $alltext;
    $alltext_tmp = str_replace("*RDOCUMENTO*", $rdocumento, $alltext_tmp);
    
    $alltext_tmp = str_replace("*DOCUMENTO_R*", $documento_us1, $alltext_tmp);
    $alltext_tmp = str_replace("*RDOCUMENTO_P*", $documento_us2, $alltext_tmp);
    $alltext_tmp = str_replace("*RDOCUMENTO_E*", $documento_us3, $alltext_tmp);
    
    $alltext_tmp = str_replace("*RCIUDAD*", $ciudad, $alltext_tmp);
    $alltext_tmp = str_replace("*RDIRECCION*", $rdireccion, $alltext_tmp);
    
    $alltext_tmp = str_replace("*DIRECCION_R*", $direccion_us1, $alltext_tmp);
    $alltext_tmp = str_replace("*DIRECCION_P*", $direccion_us2, $alltext_tmp);
    $alltext_tmp = str_replace("*DIRECCION_E*", $direccion_us3, $alltext_tmp);
    
    $alltext_tmp = str_replace("*RNOMBRE*", $rnombre, $alltext_tmp);
    
    $alltext_tmp = str_replace("*NOMBRE_R*", $nombre_us1, $alltext_tmp);
    $alltext_tmp = str_replace("*NOMBRE_P*", $nombret_us2, $alltext_tmp);
    $alltext_tmp = str_replace("*NOMBRE_E*", $nombret_us3, $alltext_tmp);
    
    $alltext_tmp = str_replace("*TELEFONO*", $rtelefono, $alltext_tmp);
    
    $alltext_tmp = str_replace("*TELEFONO_R*", $telefono_us1, $alltext_tmp);
    $alltext_tmp = str_replace("*TELEFONO_P*", $telefono_us2, $alltext_tmp);
    $alltext_tmp = str_replace("*TELEFONO_E*", $telefono_us3, $alltext_tmp);
    
    $alltext_tmp = str_replace("*NOMBRE*", $nombre_pl, $alltext_tmp);
    $alltext_tmp = str_replace("*RAPELLIDOS*", $rapellidos, $alltext_tmp);
    $alltext_tmp = str_replace("*EMPRESA*", $empresa, $alltext_tmp);
    $alltext_tmp = str_replace("*ASUNTO*", $asunto, $alltext_tmp);
    $alltext_tmp = str_replace("*TIPO DOCUMENTO*", $documento, $alltext_tmp);
    $alltext_tmp = str_replace("*REMITENTE*", $remitente, $alltext_tmp);
    $alltext_tmp = str_replace("*DIA*", $fdia, $alltext_tmp);
    $alltext_tmp = str_replace("*DIA_NOMBRE*", $fdia_nombre, $alltext_tmp);
    $alltext_tmp = str_replace("*MES_NOMBRE*", $fmes_nombre, $alltext_tmp);
    $alltext_tmp = str_replace("*MES*", $fmes, $alltext_tmp);
    $alltext_tmp = str_replace("*AÑO*", $fano, $alltext_tmp);
    $alltext_tmp = str_replace("*FECHA_LARGA*", "$fdia_nombre $fdia de $fmes_nombre de $fano ", $alltext_tmp);
    $alltext_tmp = str_replace("*FECHA_CORTA*", " $fdia/$fmes/$fano ", $alltext_tmp);
    $alltext_tmp = str_replace("*RADICADO*", $radicado, $alltext_tmp);
    $alltext_tmp = str_replace("*FECHARAD*", $fecharad, $alltext_tmp);
    $alltext_tmp = str_replace("*CUENTAI*", $cuentai, $alltext_tmp);
    
    $fechah     = date("dmyhms") . " ";
    $archivotmp = $dirtmp . $numrad . "_" . $plg_codi . ".txt";
    if ($alltext and $enviar) {
      $fp = fopen($archivotmp, "w");
      fputs($fp, $alltext_tmp);
      fclose($fp);
    }
    
  }
  // *******************  FIN GRABACION O CREACION DE NUEVO DOC 
  if ($plantilla AND !$ins_plantilla and !$enviar and !$enviar_new) {
    
    $isql      = "select * from  PLANTILLA_PL where depe_codi = $dependencia  and pl_codi=$plantilla";
    //echo "$isql";
    //ECHO $plantillaper;
    $rs        = $db->query($isql);
    $archivo   = $rs->fields["PL_ARCHIVO"];
    //echo "-->>>>".$row["PLG_ARCHIVO_TMP"]. " " .$row["RADI_NUME_RADI"];
    //echo "EL ARCHIVO ES $archivo";
    $nombre_pl = $rs->fields["PL_NOMB"];
  }
  if ($plantillaper1 or $enviar) {
    if ($plantillaper1) {
      $plg_codi = $plantillaper1;
    }
    $isql      = "select * from  PL_GENERADO_PLG where plg_codi=$plg_codi and radi_nume_radi=$numrad";
    $rs        = $db->query($isql);
    $archivo   = $rs->fields["PLG_ARCHIVO_TMP"];
    $nombre_pl = $rs->fields["PLG_NOMBRE"];
    $plt_codi  = $rs->fields["PLT_CODI"];
  }
  if (!$nombre_pl) {
    $archivo   = "pl_txt/plantilla_nueva.txt";
    $nombre_pl = "Descripcion Plantilla";
  }
  if (!$enviar and !$enviar_new) {
    $h = fopen($archivo, "r") or $flag = 2;
    if (!$h) {
      echo "No hay una plantilla llamada $filename.txt";
    } else {
      $alltext = "";
      $paginas = 0;
      while ($line = fgets($h, 81)) {
        $alltext .= $line . "";
        $paginas = $paginas + 1;
      }
    }
    //echo "<b>Archivo $archivo -- Numero de lineas $paginas<br>";
  }
  // ***********  fin grabar o crear nuevo documento
?>
<FORM  action='plantilla.php?<?= session_name() . "=" . session_id() . "&fechah=$fechah" ?>&verrad=$verrad&gen_rad=<?= $gen_rad ?>' method="post"><center>
  Descripcion de La Plantilla<input type=text name=nombre_pl size='24' value='<?= $nombre_pl ?>' class=e_cajas2>
  <br>
<?
  if ($plt_codi <= 3) {
?>
<textarea name='alltext' cols='80' rows='22'  >
<?= $alltext ?>
</textarea><br>

  <table border=0 align="center" class="t_bordegris">
    <!--DWLayoutTable-->
    <tr> 
	 <?php
    $grabar_doc = 0;
    if ($plantillaper1 or $enviar or $enviar_new) {
      $grabar_doc = 1;
?>
      <td  align="center"  valign="top" border=1><input type=submit name=enviar value='Grabar'  class='e_buttons'>
	  <input type=hidden name='pantillaper1' value='<?= $platillaper1 ?>'> 
      </TD>
	  <?
      $grabar_doc = 1;
    }
    if ($grabar_doc == 0) {
?>

      <td valign="top" align="center"> <input type=submit name=enviar_new value='Asociar plantilla a Radicado'  class='e_buttons' alt="Insertar como nuevo Documento del radicado <?= $verrad ?>">
        <br>
        <font size="-2"><strong>El documento se insertaral al radicado 
        <?= $verrad ?>
        </strong> </font> </td>
       <?
    }
    if ($crea_plantilla >= 1) {
?>
      <td  valign="top" align="center"> <font size="-1" face="Arial, Helvetica, sans-serif"> 
        <font size="-2"> 
        <input type=SUBMIT NAME=ins_plantilla value='Insertar Como Plantilla'  class='e_buttons'> <font size="-2"><br>
        <?
      if ($codusuario == 1) {
?>
        <input type="checkbox"  name=plantilla_dep value='<?= $archivo ?>'>
        de la Dependencia </font></font> <font size="-2">
        <?
      }
?>
        </font></td>
    <td width="13">&nbsp;</td>
	<?
    }
?>
    </tr>
  </table>
	
  <?
    
    echo "<input type=hidden name=numrad value=$numrad>";
?>
  <?PHP
    //INICIO DE GRABAR NUEVO DOCUMENTO ****  NEW  ****
    // $plg_codi = str_pad($numero_pla,4,"0",STR_PAD_left);
    $archivotmp = $dirtmp . $numrad . "_" . $plg_codi . ".txt";
    
    
?>
  <INPUT type=hidden name=archivo value='<?= $archivo ?>'>
      <input type=HIDDEN name=plg_codi value='<?= $plg_codi ?>' >
</form>
<?
    if ($enviar) {
      if (!$numrad) {
        $numrad = $verrad;
      }
?> 
<FORM action='genplantilla.php?<?= session_name() . "=" . trim(session_id()) . "&fechah=$fechah" ?>&gen_rad=<?= $gen_rad ?>' method="post" name=pdf target="new_pdf<?= date ?>" >
  <input type=hidden name='numrad' value='<?= $numrad ?>' > 
  <input type=hidden name='verrad' value='<?= $numrad ?>' >
  <input type=hidden name='arpdf' value='<?php
      echo "$archivopdf";
?>' > 
  <input type=hidden name='artxt' value='<?php
      echo "$archivotmp";
?>' >
  <input type=hidden name='dependencia' value='<?= $dependencia ?>' >
  <INPUT type=hidden name=archivo value='<?= $archivo ?>'>
  
  <?
      if ($plg_codi) {
?>
    <INPUT type=hidden name='plantillaper1' value='<?= $plg_codi ?>'>
  <?
      } else {
?>
    <INPUT type=hidden name='plantillaper1' value='<?= $plantillaper1 ?>'>
  <?
      }
?>
  <input type=submit name=ver_tmp_pdf value='Vista Previa'  class='e_buttons' onClick="gen_pdf();">
  <input type=HIDDEN name=fechah value='<?= $fechah ?>' >
  <input type=HIDDEN name=plg_codi value='<?= $plg_codi ?>' >
  <input type=HIDDEN name=radicado_sal value='<?= $radicado_sal ?>' >
  <?
      if ($codusuario == 1) {
        if ($plt_codi <= 1) {
?>
  <input type=submit name=radicar_documento value='Radicar'  class='e_buttons'  onClick="gen_pdf();">
  <?
        }
      }
?>
  <?
      $arpdf = $archivopdf;
      $artxt = $archivotmp;
    }
?>
   <input type='button' value='cerrar' onclick='opener.history.go(0);window.close()'>

</form> 
<?
  }
?>
<FORM  action='genplantilla.php?<?= session_name() . "=" . session_id() ?>&gen_rad=<?= $gen_rad ?>' method="post" target='generar_pdf'>
