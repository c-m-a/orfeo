<?php
  /*************************************************************************************/
  /* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
  /*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
  /*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
  /* ===========================                                                       */
  /*                                                                                   */
  /* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
  /* bajo los terminos de la licencia GNU General Public publicada por                 */
  /* la "Free Software Foundation"; Licencia version 2. 			             */
  /*                                                                                   */
  /* Copyright (c) 2005 por :	  	  	                                     */
  /* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
  /*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
  /*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
  /* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */
  /*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
  /*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
  /* D.N.P. "Departamento Nacional de Planeación"                                      */
  /*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador          */
  /*                                                                                   */
  /* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
  /*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
  /*************************************************************************************/
  include_once('class_control/AplIntegrada.php');
  $objApl     = new AplIntegrada($db);
  $lkGenerico = '&usuario=' . $krd . '&nsesion=' . trim(session_id()) . '&nro=' . $verradicado . $datos_envio;
  
  //funcion que busca el numero de radicado en bd complementaria
  function bd_complementaria($radicado, $db) {
    $sql_pys = "SELECT FUNC_BCOMPLEMENTARIAS(RADI_NUME_RADI) NUM
                FROM SES_PAZYSALVOS_CTA
                WHERE RADI_NUME_RADI=" . $radicado;
    $rs_pys  = $db->conn->query($sql_pys);
    $num     = $rs_pys->fields["NUM"];
    if ($num != "") {
      echo "PAZ Y SALVO " . $num;
    } else {
      $sql_qyd = "SELECT COUNT(RADI_NUME_RADI) NUM
                  FROM SES_QUEJAYDERECHO
                  WHERE RADI_NUME_RADI = " . $radicado;
      $rs_qyd  = $db->conn->query($sql_qyd);
      $num_row = $rs_qyd->fields["NUM"];
      if ($num_row > 0)
        echo "QUEJAS Y DERECHO DE PETICION";
    }
  }
  
?>
<script src="js/popcalendar.js"></script>
<script>
function regresar()
{	//window.history.go(0);
	window.location.reload();
}
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="5"bgcolor="#006699" >
<tr bgcolor="#006699"> 
	<td class="titulos4" colspan="6" >INFORMACION GENERAL </td>
</tr>
</table>
<table border=0 cellspace=2 cellpad=2 WIDTH=100% align="left" class="borde_tab" id=tb_general>
<tr> 
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2" >FECHA DE RADICADO</td>
    <td  width="25%" height="25" class="listado2"><?= $radi_fech_radi ?></td>
    <td bgcolor="#CCCCCC" width="25%" align="right" height="25" class="titulos2" >ASUNTO</td>
    <td class='listado2' colspan="3" width="25%"><?= $ra_asun ?></td>
</tr>
<tr> 
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2"><?= $tip3Nombre[1][$ent] ?></td>
	<td class='listado2' width="25%" height="25"><?= $nombret_us1 ?>-- <?= $cc_documento_us1 ?></td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25" class="titulos2" >DIRECCI&Oacute;N CORRESPONDENCIA</td>
	<td class='listado2' width="25%"><?= $direccion_us1 ?></td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25" class="titulos2" >MUN/DPTO</td>
	<td class='listado2' width="25%"><?= $dpto_nombre_us1 . "/" . $muni_nombre_us1 ?></td>
</tr>
<tr> 
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2"><?= $tip3Nombre[2][$ent] ?></td>
	<td class='listado2' width="25%" height="25"> <?= $nombret_us2 ?></td>
    <td bgcolor="#CCCCCC" width="25%" align="right" height="25" class="titulos2">DIRECCI&Oacute;N CORRESPONDENCIA </td>
    <td class='listado2' width="25%"> <?= $direccion_us2 ?></td>
    <td bgcolor="#CCCCCC" width="25%" align="right" height="25" class="titulos2">MUN/DPTO</td>
    <td class='listado2' width="25%"> <?= $dpto_nombre_us2 . "/" . $muni_nombre_us2 ?></td>
</tr>
<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2"><?= $tip3Nombre[3][$ent] ?>
</td>
	<td class='listado2' width="25%" height="25"> <?= $nombret_us3 ?> -- <?= $cc_documento_us3 ?>
	
	<?php
  //VERIFICA SI LA ENTIDAD ESTA EN CAUSAL DE LIQUIDACION
  $sl = "SELECT count(*) k
        FROM bodega_empresas b,
              cta.indice i
        WHERE b.nit_de_la_empresa=i.nit and
              i.nit='" . $cc_documento_us3 . "' AND
              i.solicitud_minprot = 0 AND
              solicitud_ses = 0 AND
              codigo_camara <> 60";
  $rs = $db->conn->Execute($sl);
  
  if ($rs->fields['K'] == 1)
    echo "<strong><font color=red>INCURSA EN DISOLUCION Y LIQUIDACION</font></strong>";
?>	
	</td>
    <td bgcolor="#CCCCCC" width="25%" align="right" height="25" class="titulos2">DIRECCI&Oacute;N CORRESPONDENCIA </td>
    <td class='listado2' width="25%"> <?= $direccion_us3 ?></td>
    <td bgcolor="#CCCCCC" width="25%" align="right" height="25" class="titulos2">MUN/DPTO</td>
    <td class='listado2' width="25%"> <?= $dpto_nombre_us3 . "/" . $muni_nombre_us3 ?>
</td>
</tr>
<tr>
	<td height="25" bgcolor="#CCCCCC" align="right" class="titulos2"> <p>N&ordm; DE PAGINAS</p></td>
    <td class='listado2' width="25%" height="25"> <?= $radi_nume_hoja ?></td>
    <td bgcolor="#CCCCCC" width="25%" height="25" align="right" class="titulos2"> DESCRIPCION ANEXOS </td>
    <td class='listado2'  width="25%" height="11"> <?= $radi_desc_anex ?></td>
    <td bgcolor="#CCCCCC" width="25%" align="right" height="25" class="titulos2">&nbsp;</td>
    <td class='listado2' width="25%">&nbsp;</td>
</tr>
<tr> 
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">DOCUMENTO<br>Anexo/Asociado</td>
	<td class='listado2' width="25%" height="25">
<?php
  if ($radi_tipo_deri != 1 and $radi_nume_deri) {
    echo $radi_nume_deri;
    echo "<br>(<a class='vinculos' href='$ruta_raiz/verradicado.php?verrad=$radi_nume_deri &" . session_name() . "=" . session_id() . "&krd=$krd' target='VERRAD$radi_nume_deri_" . date("Ymdhi") . "'>Ver Datos</a>)";
  }
  if ($verradPermisos == "Full" or $datoVer == "985") {
?>
		<input type=button name=mostrar_anexo value='...' class=botones_2 onClick="verVinculoDocto();">
	<?
  }
  if ($carpeta == 5 and $_SESSION['usua_perm_sancionad'] == 1)
    $col = 2;
  else
    $col = 3;
  
?>
	</td>
    <td bgcolor="#CCCCCC" width="25%" align="right" height="25" class="titulos2">REF/OFICIO/CUENTA INTERNA </td>
    <td class='listado2' colspan="<?= $col ?>" width="25%"> <?= $cuentai ?>&#160;&#160;&#160;&#160;&#160;
<?php
  $muniCodiFac = '';
  $dptoCodiFac = '';
  if ($sector_grb == 6 and $cuentai and $espcodi) {
    if ($muni_us2 and $codep_us2) {
      $muniCodiFac = $muni_us2;
      $dptoCodiFac = $codep_us2;
    } else {
      if ($muni_us1 and $codep_us1) {
        $muniCodiFac = $muni_us1;
        $dptoCodiFac = $codep_us1;
      }
    }
?>
		<a href="./consultaSUI/facturacionSUI.php?cuentai=<?= $cuentai ?>&muniCodi=<?= $muniCodiFac ?>&deptoCodi=<?= $dptoCodiFac ?>&espCodi=<?= $espcodi ?>" target="FacSUI<?= $cuentai ?>"><span class="vinculos">Ver Facturacion</span></a>
<?php
  }
?>
    </td>
<?php
  if ($carpeta == 5 and $_SESSION['usua_perm_sancionad'] == 1) {
?>
	<td class='listado2'>
	<a href='sancionados/sancionados.php?rad=<?= $verradicado ?>'>Sancionados</a>	
	</td>
<?php
  }
?>
  </tr>
  <tr> 
	<td align="right" height="25" class="titulos2">IMAGEN</td>
	<td class='listado2' colspan="1">
    <span class='vinculos'><?= $imagenv ?></span>
  </td>
	<td align="right" height="25"  class="titulos2">ESTADO ACTUAL</td>
	<td class='listado2' >
		<?= $flujo_nombre ?>
		<?
  if ($verradPermisos == "Full" or $datoVer == "985") {
?>
			<input type=button name=mostrar_causal value='...' class=botones_2 onClick="ver_flujo();">
<?php
  }
?>
	</td>
	<td align="right" height="25"  class="titulos2">Nivel de Seguridad</td>
	<td class='listado2' colspan="3">
<?php
  echo ($nivelRad == 1) ? 'Privado' : 'P&uacute;blico';
  
  if ($verradPermisos == "Full" or $datoVer == "985") {
    $varEnvio = "krd=$krd&numRad=$verrad&nivelRad=$nivelRad";
?>
		<input type=button name=mostrar_causal value='...' class=botones_2 onClick="window.open('<?= $ruta_raiz ?>/seguridad/radicado.php?<?= $varEnvio ?>','Cambio Nivel de Seguridad Radicado', 'height=220, width=300,left=350,top=300,scroll:yes')">
<?php
  }
?>
	</td>
</tr>
<tr> 
	<td align="right" height="25" class="titulos2">TRD</td>
	<td class='listado2' colspan="6">
<?php
  if (!$codserie)
    $codserie = "0";
  if (!$tsub)
    $tsub = "0";
  if (trim($val_tpdoc_grbTRD) == "///")
    $val_tpdoc_grbTRD = "";
?>
		<?= $serie_nombre ?><font color=black>/</font><?= $subserie_nombre ?><font color=black>/</font><?= $tpdoc_nombreTRD ?>
<?php
  if ($verradPermisos == "Full" or $datoVer == "985") {
?>
		<input type=button name=mosrtar_tipo_doc2 value='...' class=botones_2 onClick="ver_tipodocuTRD(<?= $codserie ?>,<?= $tsub ?>);">
	</td>
</tr>
  <tr>
	<td align="right" height="25" class="titulos2">SECTOR</td>
	<td class='listado2' colspan="6"> 
		<?= $sector_nombre ?>
<?php
    $nombreSession = session_name();
    $idSession     = session_id();
    if ($verradPermisos == "Full" or $datoVer == "985") {
      $sector_grb      = (isset($sector_grb)) ? $sector_grb : 0;
      $causal_grb      = (isset($causal_grb) || $causal_grb != '') ? $causal_grb : 0;
      $deta_causal_grb = (isset($deta_causal_grb) || $deta_causal_grb != '') ? $deta_causal_grb : 0;
      
      $datosEnviar = "'$ruta_raiz/causales/mod_causal.php?" . $nombreSession . "=" . $idSession . "&krd=" . $krd . "&verrad=" . $verrad . "&sector=" . $sector_grb . "&sectorCodigoAnt=" . $sector_grb . "&sectorNombreAnt=" . $sector_nombre . "&causal_grb=" . $causal_grb . "&causal_nombre=" . $causal_nombre . "&deta_causal_grb=" . $deta_causal_grb . "&dcausal_nombre=" . $dcausal_nombre . "'";
?>
      <input type=button name="mostrar_causal" value="..." class="botones_2" onClick="window.open(<?= $datosEnviar ?>,'Tipificacion_Documento','height=300,width=750,scrollbars=no')">
      <input type="hidden" name="mostrarCausal" value="N">
<?php
    }
?>
    </td>
  </tr>
  <tr> 
    <td align="right" height="25" class="titulos2">CAUSAL</td>
<?php
    $causal_nombre_grb  = $causal_nombre;
    $dcausal_nombre_grb = $dcausal_nombre;
?>
    <td class='listado2' colspan="6"> 
      <?= $causal_nombre ?>/<?= $dcausal_nombre ?>/<?= $ddcausal_nombre ?>/ 
<?php
    if ($verradPermisos == "Full" or $datoVer == "985") {
?>
      	<input type=button name="mostrar_causal" value="..." class='botones_2' onClick="window.open(<?= $datosEnviar ?>,'Tipificacion_Documento','height=300,width=750,scrollbars=no')">
<?php
    }
?>
    </td>
  </tr>
  <tr> 
    <td align="right" height="25" class="titulos2">TEMA</td>
    <td class='listado2' colspan="6"> 
      <?= $tema_nombre ?>
      <?
    if ($verradPermisos == "Full" or $datoVer == "985") {
?>
      <input type=button name="mostrar_temas" value='...' class=botones_2 onClick="ver_temas();">
<?php
    }
  }
?>
    </td>
  </tr>
  <tr> 
    <td align="right" height="25" class="titulos2">BD COMPLEMENTARIAS</td>
    <td class='listado2' colspan="6">
<?php
  //llamado a la función que consulta el radicado en bd_complementaria 
  bd_complementaria($verrad, $db);
  
  //if($cc_documento_us3 && $verrad){
  if ($verradPermisos == "Full" or $datoVer == "985") {
?>
      <input type=button name=mostrar_bd value='...' class=botones_2 onClick="ver_complementos('mod_bd_comple');">
<?php
  }
?>
	</td>
  </tr>
</table>
</form>
<table align="center" border="0" id="ver_datos" witdth="80%">
<tr><td>
<?php
  $ruta_raiz = '.';
  if ($verradPermisos == "Full" or $datoVer == "985") {
    include('./tipo_documento.php');
  }
?>
</td></tr>
<tr><td align='center'>
<?php
  // <input type=button name=mod_tipo_doc3 value='Ver datos' class=botones_2 onClick="ver_datos();">
?>
</td></tr>
</table>
