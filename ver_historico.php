<html>
<head>
<title>Untitled</title>
<link rel="stylesheet" href="estilos/orfeo.css">
</head>
<body >
<table width="100%" border="0" cellpadding="0" cellspacing="5"bgcolor="#006699" >
  <tr bgcolor="#006699"> 
    <td class="titulos4" colspan="6" >HISTORICO </td>
  </tr>
</table>
<?php
	   require_once($ruta_raiz . '/class_control/Transaccion.php');
		 require_once($ruta_raiz . '/class_control/Dependencia.php');
		 require_once($ruta_raiz . '/class_control/usuario.php');
	   
     $trans = new Transaccion($db);
	   $objDep = new Dependencia($db);
	   $objUs = new Usuario($db);
	   $isql = "select USUA_NOMB
                from usuario
                where depe_codi = $radi_depe_actu and
                      usua_codi = $radi_usua_actu";
	   $rs = $db->conn->query($isql);			      	   
	   
     $usuario_actual = $rs->fields["USUA_NOMB"];
	   $isql = "select DEPE_NOMB
              from dependencia
              where depe_codi = $radi_depe_actu";
	   $rs = $db->conn->query($isql);			      	   
	   
     $dependencia_actual = $rs->fields["DEPE_NOMB"];
	   $isql = "select USUA_NOMB
              from usuario
              where depe_codi = $radi_depe_radicacion and
              usua_codi = $radi_usua_radi";
	   $rs = $db->conn->query($isql);			      	   
	   
     $usuario_rad = $rs->fields["USUA_NOMB"];
	   $isql = "select DEPE_NOMB from dependencia where depe_codi=$radi_depe_radicacion";
	   $rs = $db->conn->query($isql);			      	   
	   $dependencia_rad = $rs->fields["DEPE_NOMB"];
?>
<table width="100%"  align="center"  border="0" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr align="left">
    <td width="10%" class="titulos2" height="24">USUARIO ACTUAL</td>
    <td  width="15%" class="listado2" height="24" align="left"><?=$usuario_actual?></td>
    <td width="10%" class="titulos2" height="24">DEPENDENCIA ACTUAL</td>
    <td  width="15%" class="listado2" height="24"><?=$dependencia_actual?></td>
  </tr>
    <tr  class='etextomenu' align="left">
    <td width=10% class="titulos2" height="24">USUARIO RADICADOR </td>
    <td  width=15% class="listado2" height="24"><?=$usuario_rad?></td>
    <td width=10% class="titulos2" height="24">DEPENDENCIA DE RADICACION </td> 
    <td  width=15% class="listado2" height="24"><?=$dependencia_rad?></td>
  </tr>
 </table>
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="25" class="titulos4">FLUJO HISTORICO DEL DOCUMENTO</td>
  </tr>
</table>
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
  <tr align="center">
    <td width="10%" class="titulos2" height="24">DEPENDENCIA</td>
    <td width="5%" class="titulos2" height="24">FECHA</td>
    <td width="5%" class="titulos2" height="24">Nro. D&iacute;as Entre Transacci&oacute;n</td>
    <td width="15%" class="titulos2" height="24">TRANSACCION</td>  
    <td width="15%" class="titulos2" height="24" >US. ORIGEN</td>
    <td  width=40% height="24" class="titulos2">COMENTARIO</td>
  </tr>
<?php
  $sqlFecha = $db->conn->SQLDate("d-m-Y H:i A","a.HIST_FECH");

	$isql = "select $sqlFecha AS HIST_FECH1,
                  a.DEPE_CODI,
                  a.USUA_CODI,
                  a.RADI_NUME_RADI,
                  a.HIST_OBSE,
                  a.USUA_CODI_DEST,
                  a.USUA_DOC,
                  a.HIST_OBSE,
                  a.SGD_TTR_CODIGO
              from hist_eventos a
              where a.radi_nume_radi = $verrad
              order by hist_fech desc";  
  
	$i = 0;
	$rs = $db->conn->query($isql);

  $fecha_actual = '';
  $fecha_anterior = '';
  $registros = array();
  $numero_dias = 0;
  $total_dias = 0;
	
  if($rs) {
    while(!$rs->EOF) {
      $fecha_actual_arreglo = explode(' ', $rs->fields['HIST_FECH1']);
      $fecha_actual = $fecha_actual_arreglo[0];
      $numero_dias = (strtotime($fecha_anterior) - strtotime($fecha_actual)) / 86400;
      
      if (empty($fecha_anterior))
        $numero_dias = 0;
      
      $total_dias += $numero_dias;
      
      $usua_doc_dest = '';
      $usua_doc_hist = '';
      $usua_nomb_historico = '';
      $usua_destino = '';
      $numdata =  trim($rs->fields["CARP_CODI"]);
      
      if($data =="")
        $rs1->fields["USUA_NOMB"];
      
      $data           = "NULL";
      $numerot        = $rs->fields["NUM"];
      $usua_doc_hist  = $rs->fields["USUA_DOC"];
      $usua_codi_dest = $rs->fields["USUA_CODI_DEST"];
      $usua_dest      = intval(substr($usua_codi_dest,3,3));
      $depe_dest      = intval(substr($usua_codi_dest,0,3));
      $usua_codi      = $rs->fields["USUA_CODI"];
      $depe_codi      = $rs->fields["DEPE_CODI"];
      $codTransac     = $rs->fields["SGD_TTR_CODIGO"];
      $descTransaccion = $rs->fields["SGD_TTR_DESCRIP"];
      
      if(!$codTransac)
        $codTransac = "0";
      
      $trans->Transaccion_codigo($codTransac);
      $objUs->usuarioDocto($usua_doc_hist);
      $objDep->Dependencia_codigo($depe_codi);
      
      $imagen = ($carpeta == $numdata)? 'usuarios.gif' : 'usuarios.gif';
      $fecha_anterior = $fecha_actual;
      $registros[$i]['nombre_dependencia']= $objDep->getDepe_nomb();
      $registros[$i]['fecha_transaccion'] = $rs->fields["HIST_FECH1"];
      
      // Si existe el anterior registro asignar el valor del numero de dias
      if ($i == 0) {
        $registros[$i]['numero_dias']     = $numero_dias;
      } else {
        $registros[$i-1]['numero_dias']   = $numero_dias;
      }
      
      $registros[$i]['descripcion']       = $trans->getDescripcion();
      $registros[$i]['usuario_origen']    = $objUs->get_usua_nomb();
      $registros[$i]['comentario']        = utf8_decode($rs->fields["HIST_OBSE"]);
      $rs->MoveNext();
      $i++;
    }

    echo '<tr class="tpar">' . "\n";
    echo '<td colspan="6" class="listado1"> N&uacute;mero total de d&iacute;as en tramite: (' . $total_dias . ')</td>';
    echo '</tr>' . "\n";

    foreach ($registros as $registro) {
      $nro_dias  = (empty($registro['numero_dias']))? 0 : $registro['numero_dias'];
      $echo_dias = ($nro_dias == 1)? ' d&iacute;a' : ' d&iacute;as';
      echo '<tr class="tpar">';
      echo '<td class="listado2" >'. $registro['nombre_dependencia'] .'</td>' . "\n";
      echo '<td class="listado2" >'. $registro['fecha_transaccion'] .'</td>' . "\n";
      echo '<td class="listado2" ><center>'. $nro_dias . $echo_dias . '</center></td>' . "\n";
      echo '<td class="listado2" >'. $registro['descripcion'] .'</td>' . "\n";
      echo '<td class="listado2" >'. $registro['usuario_origen'] .'</td>' . "\n";
      echo '<td class="listado2" >'. $registro['comentario'] .'</td>' . "\n";
      echo '</tr>';
    }
  } // Finaliza historicos
?>
</table>
<?php
  //empieza datos de envio
  include ($ruta_raiz . '/include/query/queryver_historico.php');

  $isql = "select $numero_salida from anexos a where a.anex_radi_nume=$verrad";
  $rs = $db->conn->query($isql);			      	   	
  $radicado_d= '';
  while(!$rs->EOF) {
      $valor = $rs->fields["RADI_NUME_SALIDA"];
      if(trim($valor))
        $radicado_d .= "'".trim($valor) ."', ";
      $rs->MoveNext();
  }  

  $radicado_d .= $verrad;

  include ($ruta_raiz . '/include/query/queryver_historico.php');
  $sqlFechaEnvio = $db->conn->SQLDate("d-m-Y H:i A","a.SGD_RENV_FECH");
  $isql = "select $sqlFechaEnvio AS SGD_RENV_FECH,
              a.DEPE_CODI,
              a.USUA_DOC,
              a.RADI_NUME_SAL,
              a.SGD_RENV_NOMBRE,
              a.SGD_RENV_DIR,
              a.SGD_RENV_MPIO,
              a.SGD_RENV_DEPTO,
              a.SGD_RENV_PLANILLA,
              b.DEPE_NOMB,
              c.SGD_FENV_DESCRIP,
              $numero_sal,
              a.SGD_RENV_OBSERVA,
              a.SGD_DEVE_CODIGO
            from sgd_renv_regenvio a,
                  dependencia b,
                  sgd_fenv_frmenvio c
            where a.radi_nume_sal in($radicado_d) AND
                  a.depe_codi=b.depe_codi AND
                  a.sgd_fenv_codigo = c.sgd_fenv_codigo
            order by a.SGD_RENV_FECH desc";
  $rs = $db->conn->query($isql);
?>
 <table width="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr>
    <td height="25" class="titulos4">DATOS DE ENVIO</td>
  </tr>
</table>
<table width="100%"  align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
  <tr  align="center">
    <td width="10%" class="titulos2" height="24">RADICADO </td>
    <td width="10%" class="titulos2" height="24">DEPENDENCIA</td>
    <td  width="15%" class="titulos2" height="24">FECHA </td>
    <td  width="15%" class="titulos2" height="24">Destinatario</td>      
    <td  width="15%" class="titulos2" height="24" >DIRECCION </td>
    <td  width="15%" class="titulos2" height="24" >DEPARTAMENTO </td>
    <td  width="15%" class="titulos2" height="24" >MUNICIPIO</td>
    <td  width="15%" class="titulos2" height="24" >TIPO DE ENVIO</td>
    <td  width="5%" height="24" class="titulos2"> No. PLANILLA</td>
    <td  width="15%" height="24" class="titulos2">OBSERVACIONES O DESC DE ANEXOS</td>      
  </tr>
  <?php
$i=1;
while(!$rs->EOF) {
	$radDev = $rs->fields["SGD_DEVE_CODIGO"];
	$radEnviado = $rs->fields["RADI_NUME_SAL"];

  $imgRadDev = ($radDev)?
            "<img src='$ruta_raiz/imagenes/devueltos.gif' alt='Documento Devuelto por empresa de Mensajeria' title='Documento Devuelto por empresa de Mensajeria'>" :
            '';
  
	$numdata = trim($rs->fields["CARP_CODI"]);
	if($data =="") 
		$data = "NULL";
	//$numerot = $rs->RecordCount();

  $imagen = ($carpeta == $numdata)? "usuarios.gif" : "usuarios.gif";
	
  if($i==1) {
?>
  <tr> <?  $i=1;
			}
			 ?>
    <td class="listado2" >
	<?=$imgRadDev?><?=$radEnviado?></td>
    <td class="listado2" >
	<?=$rs->fields["DEPE_NOMB"]?></td>
    <td class="listado2">
<?php
		echo "<a class=vinculos href='./verradicado.php?verrad=$radEnviado&krd=$krd' target='verrad$radEnviado'><span class='timpar'>".$rs->fields["SGD_RENV_FECH"]."</span></a>";
	?> </td>
    <td class="listado2">
	<?=$rs->fields["SGD_RENV_NOMBRE"]
	?> </td>
    <td class="listado2"  >
	<?=$rs->fields["SGD_RENV_DIR"]?> </td>
    <td class="listado2"  >
	 <?=$rs->fields["SGD_RENV_DEPTO"] ?> </td>
    <td class="listado2"  >
	 <?=$rs->fields["SGD_RENV_MPIO"] ?> </td>
    <td class="listado2"  >
	 <?=$rs->fields["SGD_FENV_DESCRIP"] ?> </td>
    <td class="listado2"  >
	 <?=$rs->fields["SGD_RENV_PLANILLA"] ?> </td>
    <td class="listado2"  >
	 <?=$rs->fields["SGD_RENV_OBSERVA"] ?> </td>
  </tr>
  <?
	$rs->MoveNext();  
  } // Finaliza Historicos
	?>
</table>
</body>
</html>
