<?
session_start();
$ruta_raiz = "..";
if (!$dependencia)   include "../rec_session.php";
error_reporting(0);
?>
<html>
<head>
<title>Untitled Document</title>
<link href="../estilos_totales.css" rel="stylesheet" type="text/css">
</head>
<body>
<span class=etexto>
<center>
  <?
include "../config.php";
?>
  <center>
</center></span>
<p><span class=etexto><B>ENVIO DE DOCUMENTOS</B> </p>
<form name='forma' action='envio_imp.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&no_planilla=$no_planilla"?>' method="post">
<CENTER>
  <table border=0 width=100% class=t_bordeGris>
    <!--DWLayoutTable-->
    <tr bgcolor="#cccccc" >
      <td   valign="top" >Estado</td>
      <td   valign="top" >Radicado</td>
      <td  valign="top" >Radicado Padre</td>
      <td valign="top" >Destinatario</td>
      <td valign="top" >Direccion</td>
      <td valign="top" >Municipio</td>
      <td valign="top" >Depto</td>
      <td valign="top" ></td>
	  <td valign="top" >Asunto</td>
    </tr>
    <?
     if(!$radicados)
	 {
		 $radicados = "(9";
		 if($chk1){$radicados .=",".$chk1;}
		 if($chk2){$radicados .=",".$chk2;}
		 if($chk3){$radicados .=",".$chk3;}
		 if($chk4){$radicados .=",".$chk4;}
		 if($chk5){$radicados .=",".$chk5;}
		 if($chk6){$radicados .=",".$chk6;}
		 if($chk7){$radicados .=",".$chk7;}
		 if($chk8){$radicados .=",".$chk8;}
		 if($chk9){$radicados .=",".$chk9;}
		 if($chk10){$radicados .=",".$chk10;}
		 if($chk11){$radicados .=",".$chk11;}
		 if($chk12){$radicados .=",".$chk12;}
		 if($chk13){$radicados .=",".$chk13;}
		 if($chk14){$radicados .=",".$chk14;}
		 if($chk15){$radicados .=",".$chk15;}
		 if($chk16){$radicados .=",".$chk16;}
		 if($chk17){$radicados .=",".$chk17;}
		 if($chk18){$radicados .=",".$chk18;}
		 if($chk19){$radicados .=",".$chk19;}
		 if($chk20){$radicados .=",".$chk20;}
		 if($chk21){$radicados .=",".$chk21;}
		 if($chk22){$radicados .=",".$chk22;}
		 if($chk23){$radicados .=",".$chk23;}
		 if($chk24){$radicados .=",".$chk24;}
		 if($chk25){$radicados .=",".$chk25;}
		 if($chk26){$radicados .=",".$chk26;}
		 if($chk27){$radicados .=",".$chk27;}
		 if($chk28){$radicados .=",".$chk28;}
		 if($chk29){$radicados .=",".$chk29;}
		 if($chk30){$radicados .=",".$chk30;}
		 if($chk31){$radicados .=",".$chk31;}
		 if($chk32){$radicados .=",".$chk32;}
		 if($chk33){$radicados .=",".$chk33;}
		 if($chk34){$radicados .=",".$chk34;}
		 if($chk35){$radicados .=",".$chk35;}
		 if($chk36){$radicados .=",".$chk36;}
		 if($chk37){$radicados .=",".$chk37;}
		 $procradi= substr($radicados,3,300);
         echo "<input type=hidden name=radicados value='$radicados'>";

	}else
	{
	      $procradi= substr($radicados,3,300);
	      echo "<input type=hidden name=radicados value='$radicados'>";
	}
	 $radicados_old = $radicados;
	 if($radicados_enviar) $procradi = $radicados_enviar;
	 $radicados_sel = split(",",$procradi);
	 $radicados .=",9)";
  for($iii=0; $iii<=20 and $radicados_sel[$iii]; $iii++)
   {
    $i = $iii;
	if(strlen(trim($radicados_sel[$i]))==14 or  strlen(trim($radicados_sel[$i]))==16)
	{
	  $no_digitos = 13;
	}
	else
	{
	  $no_digitos = 14;
	}
	$verrad_sal = substr($radicados_sel[$i],0, $no_digitos);
	$numrad = $verrad_sal;
	$dep_radicado = substr($verrad_sal,4,3);
	$ano_radicado = substr($verrad_sal,0,4);
	error_reporting(0);
	$carp_codi = substr($dep_radicado,0,2);
	$isql = "SELECT b.RADI_NUME_RADI,a.ANEX_NOMB_ARCHIVO,a.ANEX_DESC,a.SGD_REM_DESTINO,a.SGD_DIR_TIPO
		,a.ANEX_RADI_NUME
		FROM ANEXOS a,RADICADO b
			WHERE a.radi_nume_salida=b.radi_nume_radi
			and a.RADI_NUME_SALIDA=$verrad_sal
			and a.sgd_dir_tipo !=7 and anex_estado=2";
		ora_commiton($handle);
		$cursor = ora_open($handle);
		ora_parse($cursor,$isql);
		ora_exec($cursor);
		if(!$cursor)
		{
		 $estado = "No se encontro";
		 $mensaje = "No hay registro";
		}
		$resultado = ora_fetch_into($cursor,$row2, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		$no_registros =  ora_numrows($cursor) ;
 		$verrad = $row2["RADI_NUME_RADI"];
		$ref_pdf = $row2["ANEX_NOMB_ARCHIVO"];
		$asunto = $row2["ANEX_DESC"];
		$sgd_dir_tipo = $row2["SGD_DIR_TIPO"];
		$rem_destino = $row2["SGD_DIR_TIPO"];
		$anex_radi_nume = $row2["ANEX_RADI_NUME"];
		$dep_radicado = substr($verrad_sal,4,3);
		$ano_radicado = substr($verrad_sal,0,4);
		$carp_codi = substr($dep_radicado,0,2);
		$radi_path_sal = "/$ano_radicado/$dep_radicado/docs/$ref_pdf";
		//$verrad_sal = $radicados_sel[$i];
  	$ruta_raiz= "..";
	if(substr($rem_destino,0,1)=="7") $anex_radi_nume = $verrad_sal;
	$nurad = $anex_radi_nume;
	$verrad = $anex_radi_nume;
    include "../ver_datosrad.php";
	include "../radicacion/busca_direcciones.php";

	$destino = $muni_nombre_us1;
	if(!$rem_destino) $rem_destino =1; $sgd_dir_tipo = 1;
    echo "<input type=hidden name=$espcodi value='$espcodi'>";
	   $ruta_raiz = "..";
	   include "../jh_class/funciones_sgd.php";
	   $a = new LOCALIZACION($codep_us1,$muni_us1,"..");
	   $dpto_nombre_us1 = $a->departamento;
	   $muni_nombre_us1 = $a->municipio;
	   $a = new LOCALIZACION($codep_us2,$muni_us2,"..");
	   $dpto_nombre_us2 = $a->departamento;
	   $muni_nombre_us2 = $a->municipio;
	   $a = new LOCALIZACION($codep_us3,$muni_us3,"..");
	   $dpto_nombre_us3 = $a->departamento;
	   $muni_nombre_us3 = $a->municipio;
	   $a = new LOCALIZACION($codep_us7,$muni_us7,"..");
	   $dpto_nombre_us7 = $a->departamento;
	   $muni_nombre_us7 = $a->municipio;
	if($rem_destino==1)
	{
	   $email_us = $email_us1;
	   $telefono_us = $telefono_us1;
	   $nombre_us = trim($nombre_us1);
	   if($otro_us1) $nombre_us = $otro_us1 . " - " . $nombre_us;
	   if($tipo_emp_us1==0)  $nombre_us .= " " . trim($prim_apel_us1) . " " . trim($seg_apel_us1);
	   $destino = $muni_nombre_us1;
	   $departamento = $dpto_nombre_us1;
	   $direccion_us = $direccion_us1;
	   $dir_codigo = $dir_codigo_us1;
	   $dir_tipo = 1;
	}
	if($rem_destino==2)
	{
	   $email_us = $email_us2;
	   $telefono_us = $telefono_us2;
	   $nombre_us = trim($nombre_us2);
	   if($otro_us2) $nombre_us = $otro_us2 . " - " . $nombre_us;
	   if($tipo_emp_us2==0)  $nombre_us .= " " . trim($prim_apel_us2) . " ". trim($seg_apel_us2);
	   $destino = $muni_nombre_us2;
 	   $departamento = $dpto_nombre_us2;
	   $direccion_us = $direccion_us2;
	   $dir_codigo = $dir_codigo_us2;
	   $dir_tipo = 2;
	}
	if($rem_destino==3)
	{
		$email_us = $email_us3;
		$telefono_us = $telefono_us3;
		$destino = $muni_nombre_us3;
		$departamento = $dpto_nombre_us3;
		$nombre_us = trim($nombre_us3);
		if($tipo_emp_us3==0)  $nombre_us .= " " . trim($prim_apel_us3) . " ".trim($seg_apel_us3);
		$dir_codigo = $dir_codigo_us3;
		$direccion_us = $direccion_us3;
		$dir_tipo = 3;
	}
	if(substr($rem_destino,0,1)==7)
	{
		$email_us = $email_us7;
		$telefono_us = $telefono_us7;
		$destino = $muni_nombre_us7;
		$departamento = $dpto_nombre_us7;
		$nombre_us = trim($nombre_us7);
        if($otro_us7) $nombre_us = $otro_us7 . " - " . $nombre_us;
		if($tipo_emp_us7==0)  $nombre_us .= " " . trim($prim_apel_us7) . " ".trim($seg_apel_us7);
		$dir_codigo = $dir_codigo_us7;
		$direccion_us = $direccion_us7;
		$dir_tipo = $rem_destino;
	}
	$nombre_us = substr(trim($nombre_us),0 ,29);
	if(!$mensaje)
	{
	$mensaje = ""; $error = "no";
	if(!$nombre_us)    {$mensaje = "Nombre,";  $error = "si"; }
	if(!$direccion_us) {$mensaje .= "Direccion,"; $error = "si"; }
    if(!$destino)      {$mensaje .= "Municipio,";  $error = "si"; }
    if(!$departamento) {$mensaje .= "Departamento,";  $error = "si"; }
	$verrad_sal = substr($verrad_sal,0,$no_digitos);

	if($error=="no")
	{
               $isql = "update ANEXOS set ANEX_ESTADO=3
		           ,SGD_FECH_IMPRES=SYSDATE
			   ,ANEX_FECH_ENVIO=SYSDATE
			   , SGD_DEVE_FECH = NULL
			   , SGD_DEVE_CODIGO=NULL
		           where 
			     RADI_NUME_SALIDA =$verrad_sal 
			     and sgd_dir_tipo !=7 
			     and anex_estado=2";
    	  ora_commiton($handle);
 	      $cursor = ora_open($handle);
		  ora_parse($cursor,$isql);
		  ora_exec($cursor);
		  if($cursor) $estado= "Ok"; else $estado= "Mal";
	}else{
	  $estado = "Error " ;
	  if($no_registros<1) $mensaje = "Verifique si ya esta marcado como impreso..."; else $mensaje= "Faltan Datos ($mensaje)";
	  echo "<script>alert('No se puede Marcar el Documento $verrad_sal Como Impreso. $mensaje  ')</script>";
	}
	}
?>
    <tr class=timparr>
      <td height="21" align="center" valign="top"> <font size=2><B>
       <?=$estado?>
      </td>
      <td height="21" align="center" valign="top"> <font size=2><B>
        <?=$verrad_sal?>
        <input type=hidden name=verrad_sal value='<?=$verrad_sal?>'>
		<input type=hidden name=nurad value='<?=$verrad_sal?>'>
		<input type=hidden name=verrad_sal value='<?=$verrad_sal?>'> </td>
      <td align="center" valign="top"> <font size=2><B>
     <?=$verrad?>
     <input type=hidden name=verrad value='<?=$verrad?>'> </td>
     <td valign="top">
        <input type=text name=nombre_us value='<?=$nombre_us?>' |class=e_cajas size=20 class="ecajasfecha"> </Td><td>
          <input type=text name=direccion_us value='<?=$direccion_us?>' |class=e_cajas size=15 class="ecajasfecha"> </Td>
        <td>
        <input type=text name=destino  value='<?=$destino?>' |class=e_cajas size=15 class="ecajasfecha"> </Td><td>
        <input type=text name=departamento_us value='<?=$departamento?>' |class=e_cajas size=10 class="ecajasfecha"></Td><td> 
        <input type=text name=dir_codigo value='<?=$dir_codigo?>' |class=e_cajas size=5 class="ecajasfecha"> 
      </td>
      <td height="21" colspan="10">Asunto 
        <input type=text name=$ra_asun value='<?=$ra_asun?>' |class=e_cajas size=20 class="ecajasfecha"> 
      </td>
	</tr>
    <?
  } 
?>
  </table>
 <table>
 <tr>
      <td> 

  </td>
 </tr>
 </table>

</form><span class=etexto>
<center></center></span>
</body>
</html>
