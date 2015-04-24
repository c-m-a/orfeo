<?php
  /*************************************************************************************/
  /* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	               */
  /*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS         */
  /*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com                         */
  /* ===========================                                                       */
  /*                                                                                   */
  /* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
  /* bajo los terminos de la licencia GNU General Public publicada por                 */
  /* la "Free Software Foundation"; Licencia version 2. 			                         */
  /*                                                                                   */
  /* Copyright (c) 2005 por :	  	  	                                                 */
  /* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
  /*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
  /*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
  /* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
  /*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
  /*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
  /* D.N.P. "Departamento Nacional de Planeación"                                      */
  /*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
  /*                                                                                   */
  /* Colocar desde esta linea las Modificaciones Realizadas Luego de la Version 3.5    */
  /*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
  /*************************************************************************************/
  //include ('./temas/mod_tema.php');

  $ADODB_COUNTRECS = true;
  $isql = "SELECT t.SGD_TMA_DESCRIP,
                    t.SGD_TMA_CODIGO 
              FROM SGD_TMA_TEMAS t,
                  SGD_TMD_TEADEPE td
              WHERE td.SGD_TMA_CODIGO = t.SGD_TMA_CODIGO AND
                    td.depe_codi = ".$_SESSION['dependencia'];
  
  $rs = $db->conn->query($isql);

  $vars_mostrar_opc = 'mostrar_opc_envio=' . $mostrar_opc_envio .
                      '&nomcarpeta=' . $nomcarpeta .
                      '&carpeta=' . $carpeta .
                      '&leido=' . $leido;
  
  $enlace_opc_envio = './verradicado.php?' . $vars_mostrar_opc;
  $smarty->assign('ENLACE_OPC_ENVIO', $enlace_opc_envio);
  $smarty->assign('CARPETA', $carpeta);

  $ADODB_COUNTRECS = false;
  
  $mostrar_codigos = '';
  
  if($rs) {
    $smarty->assign('MOSTRAR_OPCIONES', true);
	  do {
      $codigo_tma = $rs->fields["SGD_TMA_CODIGO"];
  		$nombre_tma = $rs->fields["SGD_TMA_DESCRIP"];

      $datoss = ($codigo_tma == $tema)? ' selected ' : '  ';
      $mostrar_codigos .= "<option value='$codigo_tma' $datoss>$nombre_tma</option>\n";
		  $rs->MoveNext();
	  } while(!$rs->EOF);
    $smarty->assign('MOSTRAR_CODIGOS', $mostrar_codigos);
  } else {
    $mostrar_error = "<p class='error'>No se han generado temas en el sistema</p>";
    $smarty->assign('MOSTRAR_ERROR', $mostrar_error);
  }

  if($grabar_tema) {
    //  INTENTA ACTUALIZAR EL TEMA 
	  if(!$tema) $tema = 0;
    $recordSet["SGD_TMA_CODIGO"] = $tema;
    $recordSet["RADI_NUME_RADI"] = $verrad;
    $actualizados = $db->conn->Replace("RADICADO", $recordSet,'RADI_NUME_RADI',false);
    $smarty->assign('ACTUALIZADO', $actualizados);
  }
  // Fin actualizacion de temas
  include ('./bdcompleme/bdcomplemento.php');
?>
