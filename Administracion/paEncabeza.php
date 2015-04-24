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
	$ruta_raiz = '../..';
  
  if (empty($_SESSION['dependencia']))
    header ("Location: $ruta_raiz/cerrar_session.php");
  
  include_once ('../../include/db/ConnectionHandler.php');
	
  $db = new ConnectionHandler($ruta_raiz);	 
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$nomcarpetaOLD = $nomcarpeta;

		if (empty($carpeta)) {
		  $carpeta = "0";
		  $nomcarpeta = "Entrada";
		}
?>
<table border="0" cellpad="2" cellspacing="0" width="98%" class="t_bordeGris" valign="top" align="center">
  <tr>
    <td width="35%">
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="377584"><div align="left" class="titulo1">LISTADO DE: </div></td>
        </tr>
		<tr class="info">
          <td height="20"><?=$nomcarpeta?></td>
        </tr>
      </table>
    </td>
     <td width='35%' >
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="377584"><div align="left" class="titulo1">USUARIO </div></td>
        </tr>
		<tr class="info">
          <td height="20" >
            <?=(isset($usua_nomb))? $usua_nomb : null?>
          </td>
        </tr>
      </table>
    </td>
	<?
    if (empty($swBusqDep))  {
    ?>
 	<td width="33%">
	    <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="377584"><div align="left" class="titulo1">DEPENDENCIA </div></td>
        </tr>
		<tr class="info">
          <td height="20" ><?=$depe_nomb?></td>
        </tr>
      </table>
     </td>
<?php
    } else {
      $enviar_estado_sal = (isset($estado_sal))? '&estado_sal=' . $estado_sal : null;
      $enviar_estado_sal_max = (isset($estado_sal_max))? '&estado_sal_max=' . $estado_sal_max : null;
      $enviar_pagina_sig = (isset($pagina_sig))? '&pagina_sig=' . $pagina_sig : null;

      $enlace_actual = $pagina_actual . '?' .
                        session_name() . '=' . session_id() .
                        '&krd=' . $krd .
                        $enviar_estado_sal .
                        $enviar_estado_sal_max .
                        $enviar_pagina_sig .
                        '&dep_sel=' . $dep_sel .
                        '&nomcarpeta=' . $nomcarpeta;
?>
	<td width="35%">
      <table width="100%" border="0" cellspacing="5" cellpadding="0">
     <tr class="info" height="20">
    	<td bgcolor="377584"  ><div align="left" class="titulo1">DEPENDENCIA</div></td>
        </tr>
		<tr>
			<td height="1">
        <form name="formboton" action="<?=$enlace_actual?>" method="GET">	
	        <input type='hidden' name='<?=session_name()?>' value='<?=session_id()?>'> 
<?php
	include_once ('../../include/query/envios/queryPaencabeza.php');
	$sqlConcat = $db->conn->Concat($conversion, "'-'",$db->conn->substr."(depe_nomb,1,50) ");
	$sql = "select $sqlConcat,
                  depe_codi
            from dependencia
            where depe_estado = 1
            order by depe_codi";
	$rsDep = $db->conn->Execute($sql);
	
  if(empty($depeBuscada))
    $depeBuscada = $dependencia;
	
  print $rsDep->GetMenu2("dep_sel", $dep_sel, false, false, 0," onChange='submit();' class='select'");
?>			
      </form>
		</td>
		</tr>
      </table>
    </td>
<?php
    } 
?>
  </tr>
</table>
