<?php
  /*************************************************************************************/
  /* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
  /*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
  /*				COLOMBIA TEL. (57) (1) 6913005  yoapoyo@orfeogpl.org   */
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
  /*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
  /*                                                                                   */
  /* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
  /*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
  /*************************************************************************************/
  
  $enviar_estado_sal = (isset($estado_sal))? '&estado_sal=' . $estado_sal : null;
  $enviar_tpAnulacion = (isset($tpAnulacion))? '&tpAnulacion=' . $tpAnulacion : null;
  $enviar_estado_sal_max = (isset($estado_sal_max))? '&estado_sal_max=' . $estado_sal_max : null;
  $enviar_pagina_sig = (isset($pagina_sig))? '&pagina_sig=' . $pagina_sig : null;
  
  $enlace_actual =  'Administracion/usuario/cuerpoEdicion.php?' .
                    session_name() . '=' . session_id() .
                    '&krd=' . $krd .
                    $enviar_estado_sal .
                    $enviar_tpAnulacion .
                    $enviar_estado_sal_max .
                    $enviar_pagina_sig .
                    '&dep_sel=' . $dep_sel .
                    '&nomcarpeta=' . $nomcarpeta;

  if (empty($busqRadicados))
    $busqRadicados = null;

  if (empty($busq_radicados_tmp))
    $busq_radicados_tmp = null;
?>
<table border="0" cellpad="2" cellspacing="0" width="98%" class="t_bordeGris" valign="top" align="center">
	<tr>
	<tr/>
	<tr>
    <td width="100%">
	  <table width="98%" align="center" cellspacing="0" cellpadding="0">
	  <tr class="tablas">
      <td class="etextomenu" >
        <span class="etextomenu">
          <form name="form_busq_rad" action="<?=$enlace_actual?>" method="POST">
	Buscar usuario(s) (Separados por coma)
	<input name="busqRadicados" type="text" size="60" class="tex_area" value="<?=$busqRadicados?>">
	<input type="submit" value="Buscar" name="Buscar" valign="middle" class="botones">
<?php
  
	if (isset($busqRadicados)) {
		$busqRadicados = trim($busqRadicados);
		$textElements = preg_split ('/\,/', $busqRadicados);
		$newText = "";
		$i = 0;
		foreach ($textElements as $item) {
			$item = trim ( $item );
			if ($item) {
        $busq_and = ($i != 0)? ' or ' : ' ';
				$busq_radicados_tmp .= " $busq_and upper($varBuscada) like upper('%$item%') ";
				$i++;
			}
		} //FIN foreach

	$dependencia_busq2 .= " and ($busq_radicados_tmp) ";
	} //FIN if ($busqRadicados)
?>
	</form>
	 </span>
	</td></tr>
	</table>
	<td/>&nbsp;&nbsp;
  <tr/>
</table>
