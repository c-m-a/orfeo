<?php
  session_start();
  include('./config.php');
  $plan_rec_finan   = 'Plantillas/RecursosFinancierosSecretariaGeneral/';
  $plan_financiera  = 'Plantillas/financiera/';
  $ruta_plantillas  = 'Plantillas/';
  $enlace_descargar = './descargar_archivo.php?ruta_archivo=' . $ruta_plantillas;
  $enlace_financieros  = './descargar_archivo.php?ruta_archivo=' . $plan_rec_finan;
  $enlace_financiera = './descargar_archivo.php?ruta_archivo=' . $plan_financiera;
?>
<html>
  <head>
    <title>PLANTILLAS GEN&Eacute;RICAS UTILIZADAS EN LA SUPERINTENDENCIA</title>
    <link rel="stylesheet" href="estilos/orfeo.css">
  </head>
  <body>
    <table width="71%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
      <tr bordercolor="#FFFFFF">
        <td colspan="2" class="titulos4">
        <div align="center">
          <strong> PLANTILLAS GEN&Eacute;RICAS UTILIZADAS EN LA SUPERINTENDENCIA</strong>
        </div>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF">
        <td align="center" class="listado2" width="48%">
          <a href='<?=$enlace_descargar?>PlantillaOficiopapelCarta.docx&nombre_archivo=PlantillaOficiopapelCarta.docx' target='mainFrame' class="vinculos">1. OFICIO </a>
        </td>
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>PlantillaOficiopapelFolio.docx&nombre_archivo=PlantillaOficiopapelFolio.docx" class="vinculos" target="mainFrame">2. OFICIO FOLIO</a>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF">
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>PlantillaMemorandoGeneral.docx&nombre_archivo=PlantillaMemorandoGeneral.docx" class="vinculos" target='mainFrame'>3. MEMORANDO GENERAL</a>
        </td>
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>PlantillaMemorandoComisionServicio.docx&nombre_archivo=PlantillaMemorandoComisionServicio.docx" class="vinculos" target='mainFrame'>4. MEMORANDO COMISION SERVICIO</a>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF">
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>Plantilla Circular Interna-12.docx&nombre_archivo=Plantilla Circular Interna-12.docx" class="vinculos" target='mainFrame'>5. CIRCULAR INTERNA</a>
        </td>
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>PlantillaCircular-12.docx&nombre_archivo=PlantillaCircular-12.docx" class="vinculos" target='mainFrame'>6. CIRCULAR GENERAL</a>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF">
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>PlantillaActa.docx&nombre_archivo=PlantillaActa.docx" class="vinculos" target='mainFrame'>7. ACTA</a>
        </td>
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>PlantillaResolucion-12.docx&nombre_archivo=PlantillaResolucion-12.docx" class="vinculos" target='mainFrame'>8.RESOLUCION</a>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF">
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>PlantillaNotificacion.docx&nombre_archivo=PlantillaNotificacion.docx" class="vinculos" target='mainFrame'>9. NOTIFICACIONES</a>
        </td>
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>Acta Terminacion y Liquidacion No. 19 de 2013(3)-1.docx&nombre_archivo=Acta Terminacion y Liquidacion No. 19 de 2013(3)-1.docx" class="vinculos" target='mainFrame'>10. ACTA TERMINACIÓN Y LIQUIDACIÓN</a>
        </td>
      </tr>
    </table>
    <br>
    <table width="71%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
      <tr bordercolor="#FFFFFF">
        <td colspan="2" class="titulos4">
        <div align="center">
          <strong> PLANTILLAS PARA MODULO DE MASIVAS </strong>
        </div>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF">
        <td align="center" class="listado2" width="48%">
          <a href='<?=$enlace_descargar?>plantilla_oficio_masiva.odt&nombre_archivo=plantilla_oficio_masiva.odt' target='mainFrame' class="vinculos">1. PLANTILLA OFICIO MASIVA </a>
        </td>
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_descargar?>archivo_de_combinacion.csv&nombre_archivo=archivo_de_combinacion.csv" class="vinculos" target="mainFrame">2. ARCHIVO DE COMBINACION (CSV). </a>
        </td>
      </tr>
    </table>
    <br>
    <table width="71%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
      <tr bordercolor="#FFFFFF">
        <td colspan="2" class="titulos4">
          <div align="center">
            <strong> PLANTILLAS RECURSOS FINANCIEROS SECRETARIA GENERAL</strong>
          </div>
        </td>
      </tr>
      <tr bordercolor="#FFFFFF">
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_financieros?>F-REFI-004Mandamiento-pago-contribucion-12.docx&nombre_archivo=F-REFI-004Mandamiento-pago-contribucion-12.docx" target='mainFrame' class="vinculos">1. F-REFI-004 MANDAMIENTO PAGO CONTRIBUCION </a>
        </td>
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_financieros?>F-REFI-005Mandamiento-pago-multa-entidades-12.docx&nombre_archivo=F-REFI-005Mandamiento-pago-multa-entidades-12.docx" class="vinculos" target="mainFrame">2. F-REFI-005 MANDAMIENTO PAGO MULTA ENTIDADES</a>
        </td>
      </tr>
        <td align="center" class="listado2" width="48%">
          <a href="<?=$enlace_financieros?>F-REFI-007AcuerdodepagomultasPersJuridica.docx&nombre_archivo=F-REFI-007AcuerdodepagomultasPersJuridica.docx" class="vinculos" target="mainFrame">3. F-REFI-007 ACUERDO PAGO MULTA PERSO. JURIDICA </a>
        </td>
      </td>
      <td align="center" class="listado2" width="48%">
        <a href="<?=$enlace_financieros?>F-REFI-007AcuerdodepagomultasPersNatural.docx&nombre_archivo=F-REFI-007AcuerdodepagomultasPersNatural.docx" class="vinculos" target="mainFrame">4.F-REFI-007 ACUERDO PAGO MULTA PERS. NATURAL </a>
      </td>
    </tr>
    <td align="center" class="listado2" width="48%">
      <a href="<?=$enlace_financieros?>F-REFI-008Devoluciondeexcedentes.docx&nombre_archivo=F-REFI-008Devoluciondeexcedentes.docx" class="vinculos" target="mainFrame">5.F-REFI-008 DEVOL. EXCEDENTES </a>
    </td>
  </td>
  <td align="center" class="listado2" width="48%">
    <a href="<?=$enlace_financieros?>PlantillaCertificacioncontribucioncuota-1-12.docx&nombre_archivo=PlantillaCertificacioncontribucioncuota-1-12.docx" class="vinculos" target="mainFrame">6. CERTIFICACION CONTRIBUCION CUOTA 1 </a>
  </td>
</tr>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaCertificacioncontribucioncuotas1y2-12.docx&nombre_archivo=PlantillaCertificacioncontribucioncuotas1y2-12.docx" class="vinculos" target="mainFrame">7. CERTIFICACION CONTRIBUCION CUOTA 1 y 2  </a>
</td>
</td>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaCitacionpagocontribucion-12.docx&nombre_archivo=PlantillaCitacionpagocontribucion-12.docx" class="vinculos" target="mainFrame">8.CITACION PAGO CONTRIBUCION </a>
</td>
</tr>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaCitacionpagomultasper-juridica.docx&nombre_archivo=PlantillaCitacionpagomultasper-juridica.docx" class="vinculos" target="mainFrame">9. CITACION PAGO MULTA PERSONA JURIDICA</a>
</td>
</td>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaCitacionpagomultasper-natural.docx&nombre_archivo=PlantillaCitacionpagomultasper-natural.docx" class="vinculos" target="mainFrame">10.CITACION PAGO MULTA PERSONA NATURAL CONTRIBUCION </a>
</td>
</tr>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaCobropersuasivocontribuciones-2-12.docx&nombre_archivo=PlantillaCobropersuasivocontribuciones-2-12.docx" class="vinculos" target="mainFrame">11. COBRO PERSUASIVO CONTRIBUCIONES   </a>
</td>
</td>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaCobropersuasivomulta-12.docx&nombre_archivo=PlantillaCobropersuasivomulta-12.docx" class="vinculos" target="mainFrame">12.COBRO PERSUASIVO MULTA </a>
</td>
</tr>
  <td align="center" class="listado2" width="48%">
    <a href="<?=$enlace_financieros?>PlantillaCobropersuasivooriginal.docx&nombre_archivo=PlantillaCobropersuasivooriginal.docx" class="vinculos" target="mainFrame">13. PLANTILLA COBRO PERSUASIVO ORIGINAL   </a>
  </td>
</td>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaConstancia-obligaciones.docx&nombre_archivo=PlantillaConstancia-obligaciones.docx" class="vinculos" target="mainFrame">14.CONSTANCIA OBLIGACIONES </a>
</td>
</tr>
  <td align="center" class="listado2" width="48%">
    <a href="<?=$enlace_financieros?>PlantillaCobropersuasivooriginal.docx&nombre_archivo=PlantillaCobropersuasivooriginal.docx" class="vinculos" target="mainFrame">15. PLANTILLA COBRO PERSUASIVO ORIGINAL   </a>
  </td>
</td>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaConstancia-obligaciones.docx&nombre_archivo=PlantillaConstancia-obligaciones.docx" class="vinculos" target="mainFrame">16. CONSTANCIA OBLIGACIONES </a>
</td>
</tr>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaPazysalvo-entidades-12.docx&nombre_archivo=PlantillaPazysalvo-entidades-12.docx" class="vinculos" target="mainFrame">17. PAZ Y SALVO ENTIDADES  </a>
</td>
</td>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaPazysalvo-personal-12.docx&nombre_archivo=PlantillaPazysalvo-personal-12.docx" class="vinculos" target="mainFrame">18. PAZ Y SALVO PERSONAL </a>
</td>
</tr>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaPazysalvotasacontribucion-12.docx&nombre_archivo=PlantillaPazysalvotasacontribucion-12.docx" class="vinculos" target="mainFrame">19. PAZ Y SALVO TASA CONTRIBUCION </a>
</td>
</td>
<td align="center" class="listado2" width="48%">
  <a href="<?=$enlace_financieros?>PlantillaDevolucionExcedentes.docx&nombre_archivo=PlantillaDevolucionExcedentes.docx" class="vinculos" target="mainFrame">20. DEVOLUCIÓN DE EXCEDENTES </a>
</td>
</tr>
<table width="71%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr bordercolor="#FFFFFF">
	  <td colspan="2" class="titulos4"><div align="center"><strong> PLANTILLAS FINANCIERA</strong></div></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="48%">
      <a href='<?=$enlace_financiera?>plantilla_definitiva_acusede_recibo.docx&nombre_archivo=plantilla_definitiva_acusede_recibo.docx' target='mainFrame' class="vinculos">1. OFICIO ACUSE RECIBO  </a>
    </td>
    <td align="center" class="listado2" width="48%">
      <a href="<?=$enlace_financiera?>2plantilla_traslados.docx&nombre_archivo=2plantilla_traslados.docx" class="vinculos" target="mainFrame">2. OFICIO TRASLADO</a>
    </td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="48%">
      <a href="<?=$enlace_financiera?>habeas_data.docx&nombre_archivo=habeas_data.docx" class="vinculos" target='mainFrame'>3. HABEAS DATA   </a>
    </td>
    <td align="center" class="listado2" width="48%">
      <a href="<?=$enlace_financiera?>sancion_pago_anticipado.docx&nombre_archivo=sancion_pago_anticipado.docx" class="vinculos" target='mainFrame'>4. SANCION PAGO ANTICIPADO</a>
    </td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="48%">
      <a href="<?=$enlace_financiera?>DEVOLUCION_APORTES_PERDIDA_ECONOMICA.docx&nombre_archivo=DEVOLUCION_APORTES_PERDIDA_ECONOMICA.docx" class="vinculos" target='mainFrame'>5. DEVOLUCION APORTES PERDIDA ECONOMICA</a>
    </td>
    <td align="center" class="listado2" width="48%">
      <a href="<?=$enlace_financiera?>autonomia_super.docx&nombre_archivo=autonomia_super.docx" class="vinculos" target='mainFrame'>6. AUTONOMIA SUPERSOLIDARIA</a>
    </td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="48%">
      <a href="<?=$enlace_financiera?>codeudor_solidario.docx&nombre_archivo=codeudor_solidario.docx" class="vinculos" target='mainFrame'>7. CODEUDOR SOLIDARIO</a>
    </td>
<!--<td align="center" class="listado2" width="48%"><a href="bodega/Plantillas/PlantillaResolucion-12.docx" class="vinculos" target='mainFrame'>8.RESOLUCION</a></td>
</tr>
<tr bordercolor="#FFFFFF">
<td align="center" class="listado2" width="48%"><a href="bodega/Plantillas/PlantillaNotificacion-12.docx" class="vinculos" target='mainFrame'>9. NOTIFICACIONES</td>  -->
  </tr>
</table>
<table width="71%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
      <div align="center">
        <strong>PLANTILLAS PRESENTACION DIAPOSITIVAS</strong>
      </div>
    </td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="48%">
      <a href="<?=$enlace_descargar?>Plantilla-presentaciones-2012.ppt&nombre_archivo=Plantilla-presentaciones-2012.ppt" target="mainFrame" class="vinculos">1. PLANTILLA PRESENTACIONES DIAPOSITIVAS  </a>
    </td>
    <td align="center" class="listado2" width="48%">
      <a href="<?=$enlace_descargar?>Plantilla-presentaciones-2012.pdf&nombre_archivo=Plantilla-presentaciones-2012.pdf" class="vinculos" target="mainFrame">2. PLANTILLA PRESENTACION DIAPOSITIVAS (PDF) </a>
    </td>
  </tr>
<!--<tr bordercolor="#FFFFFF">
<td align="center" class="listado2" width="48%"> <a  href="bodega/Plantillas/financiera/habeas_data.doc" class="vinculos" target='mainFrame'>3. HABEAS DATA   </a></td>
<td align="center" class="listado2" width="48%"><a href="bodega/Plantillas/financiera/sancion_pago_anticipado.doc" class="vinculos" target='mainFrame'>4. SANCION PAGO ANTICIPADO</a> </td>
</tr>
<tr bordercolor="#FFFFFF">
<td align="center" class="listado2" width="48%"><a href="bodega/Plantillas/financiera/DEVOLUCION_APORTES_PERDIDA_ECONOMICA.doc" class="vinculos" target='mainFrame'>5. DEVOLUCION APORTES PERDIDA ECONOMICA</a></td>
<td align="center" class="listado2" width="48%"><a href="bodega/Plantillas/financiera/autonomia_super.doc" class="vinculos" target='mainFrame'>6. AUTONOMIA SUPERSOLIDARIA</a></td>
</tr>
<tr bordercolor="#FFFFFF">
<td align="center" class="listado2" width="48%"><a href="bodega/Plantillas/financiera/codeudor_solidario.doc" class="vinculos" target='mainFrame'>7. CODEUDOR SOLIDARIO</a></td>
<td align="center" class="listado2" width="48%"><a href="bodega/Plantillas/PlantillaResolucion-12.docx" class="vinculos" target='mainFrame'>8.RESOLUCION</a></td>
</tr>
<tr bordercolor="#FFFFFF">
<td align="center" class="listado2" width="48%"><a href="bodega/Plantillas/PlantillaNotificacion-12.docx" class="vinculos" target='mainFrame'>9. NOTIFICACIONES</td>  -->
</tr>
</table>
</table>
