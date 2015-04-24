<?
	error_reporting(7);
    session_start();
	$ruta_raiz = "..";
	if (!$dependencia)   include "../rec_session.php";
?>
<html>
<head>
<title>Untitled Document</title>
<link href="../estilos_totales.css" rel="stylesheet" type="text/css">
<?
     if(!$radicados)
	 {
		 if($chk1){$radicados =",".$chk1;}
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
		 if(!$radicados) die ("<center><hr><span class=etexto>$radicados Debe seleccionar un radicado para enviar.
		                        <a href='cuerpopdf.php?".session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&radicados=$radicados&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&nomcarpeta=$nomcarpeta'>Devolver a Listado</a>
								</span><hr></center>");
		 $procradi = $radicados;
         echo "<input type=hidden name=radicados value='$radicados'>";
	}else
	{
         $procradi= $radicados;
	      echo "<input type=hidden name=radicados value='$radicados'>";
	}
	 $radicados_sel = split(",",$radicados);
?>
<script>
function back1() {
    history.go(-1);
}
function generar_envio()
{
   solonumeros();
}
function solonumeros()
{
 jh1 = document.forma.elements['envio_peso'].value;
 if(jh1)
 {
    var1 =  parseInt(jh1);
		if(var1 != jh1)
		{
			alert('Por favor  introduzca el peso correctamente.' );
			//document.forma.submit();
			return false;
		  }else{
		   document.forma.submit();
        }
 }else
 {
 	alert('Debe introducir el peso.' );
 }
}
<?
if(!$reg_envio)
{
	echo "function calcular_precio() 
	{
	";
   	$ruta_raiz = "..";
	$no_tipo="true";
    include "../config.php";
    $isql = "SELECT a.SGD_FENV_CODIGO,a.SGD_CLTA_DESCRIP,a.SGD_CLTA_PESDES,a.SGD_CLTA_PESHAST,b.SGD_TAR_VALENV1,b.SGD_TAR_VALENV2
	            FROM SGD_CLTA_CLSTARIF a,SGD_TAR_TARIFAS b
				 wHERE a.SGD_FENV_CODIGO=b.SGD_FENV_CODIGO
	                 AND a.SGD_TAR_CODIGO=b.SGD_TAR_CODIGO";
    	ora_commiton($handle);
      $cursor = ora_open($handle);
		  ora_parse($cursor,$isql) ;
		  ora_exec($cursor);
  		  $empresas_envio = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		  echo "\n";
	 do
	 {
	   $valor_local = $row["SGD_TAR_VALENV1"];
	   $valor_fuera = $row["SGD_TAR_VALENV2"];
	   $valor_certificado = $row["SGD_TAR_VALENV1"];
	   $rango = $row["SGD_CLTA_DESCRIP"];
	   $fenvio =$row["SGD_FENV_CODIGO"];
       echo "if(document.getElementById('empresa_envio').value==$fenvio)
	            {
				  if(document.getElementById('envio_peso').value>=".$row["SGD_CLTA_PESDES"]." &&  document.getElementById('envio_peso').value<=".$row["SGD_CLTA_PESHAST"].") \n
	                  {
				     document.getElementById('valor_gr').value = '$rango';
						 dp_especial='$dependencia';
             if(document.getElementById('destino').value=='$depe_municipio' || (dp_especial=='840' && (document.getElementById('destino').value=='FLORIDABLANCA' || document.getElementById('destino').value=='GIRON (SAN JUAN DE)' || document.getElementById('destino').value=='PIEDECUESTA'))   )    
						 {
						     valor = $valor_local + 0;
						 }else{
	 						 valor = $valor_fuera +0 ;
						 }
					  }
				}
	   ";
	 }while($empresas_envio = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
   ?>
   peso = document.getElementById('envio_peso').value+0;
   document.getElementById('valor_unit').value = valor ;

}
<? } ?>
</script>
</head>
<body>
<span class=etexto>
<center>
<a href='cuerpopdf.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&radicados=$radicados&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&nomcarpeta=$nomcarpeta"?>'>Devolver a Listado</a>
</center></span>
<?
 /** INICIO GRABACION DE DATOS 					*
   *											*
   *											*/
if($grb_destino)
 {
      //if($nurad and !$verrad) $verrad = $nurad;
		error_reporting(7);
	    if(strlen(trim($verrad_sal))==14 or  strlen(trim($verrad_sal))==16)
		{
		  $no_digitos = 13;
		}
		else
		{
		  $no_digitos = 14;
		}
		$verrad_sal = substr($verrad_sal,0,$no_digitos);
    
		$isql = "select RADI_NUME_RADI FROM RADICADO WHERE RADI_NUME_RADI like '$verrad_sal'";
		  Ora_commiton($handle);
		  $cursor = ora_open($handle) ;
		  ora_parse($cursor,$isql) or $error_db = ora_error();
		  ora_exec($cursor)or $error_db = ora_error();
		  $encontrados =ora_numrows($cursor);
		  $resultado = ora_fetch_into($cursor,$row2, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		  $encontrado_radi = $row2["RADI_NUME_RADI"];
		if($encontrados>=1)
		{
		}else
		{
		  echo "<center><span class=etexto><b>EL RADICADO NO HA PODIDO SER PROCESADO</b></center>";
		}
      }

/* ************************** FIN GRABACION
 * *********************************************************************************/
?>
<?
if($grb_destino)
{
    $dir_codigo = $documento_us1;
}
$documento_grabar = $documento_us1;
?>
<center>
<p><B><span class=etexto>ENVIO DE DOCUMENTOS</span></B> </p>
<form name='forma' action='envio.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&no_planilla=$no_planilla"?>' method="post">
<?
  if(!$reg_envio)
  {
?>
  <table border=0 width=100% class=t_bordeGris>
    <!--DWLayoutTable-->
    <tr bgcolor="#cccccc" >
      <td >Empresa De envio</td>
      <td >Peso(Gr)</td>
      <td >U.Medida</td>
      <td colspan="2" >Valor Total C/U</td>

    </tr>
    <?
   //echo "-->".$valor_unit;
   include "../config.php";
   	$isql = "select SGD_FENV_CODIGO,SGD_FENV_DESCRIP
    FROM SGD_FENV_FRMENVIO
		ORDER BY SGD_FENV_CODIGO ";
    	  ora_commiton($handle);
 	      $cursor = ora_open($handle);
		  ora_parse($cursor,$isql) ;
		  ora_exec($cursor);
  		  $empresas_envio = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
  ?>
    <tr class=timparr>
    <td height="26" align="center"><font size=2><B>
	<select name=empresa_envio id=empresa_envio  onClick='calcular_precio();' >
  <?
 if($empresas_envio)
   {
   do
   {
        $cod_empresa = $row["SGD_FENV_CODIGO"];
		$nomb_empresa = $row["SGD_FENV_DESCRIP"];
		if($cod_empresa==$empresa_envio)  $datoss = " Selected "; else $datoss = " ";
        echo "<option value=$cod_empresa $datoss>$cod_empresa $nomb_empresa</option>";
   }while(ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
   }
   ?>
      </select> </td>
      <td> <input type=text name=envio_peso id=envio_peso value='<?=$envio_peso?>' size=6 onChange="calcular_precio();"></td>
      <TD><input type=text name=valor_gr id=valor_gr  value='<?=$valor_gr?>' size=30 disabled> </td>
      <td align="center"> <input type=text name=valor_unit id=valor_unit  readonly   value='<?=$valor_unit?>'  > </td>
      <td> <input type=button name=Calcular_button id=Calcular_button Value=Calcular onClick='calcular_precio();'>
      </td>
    </tr>
  </table>
  <?
  }
  ?>
  <CENTER>
  <table border=0 width=100% class=t_bordeGris>
    <!--DWLayoutTable-->
    <tr bgcolor="#cccccc" >
      <td   valign="top" >Radicado</td>
   <td   valign="top" >Radicado Padre</td>
      <td valign="top" >Destinatario</td>
      <td valign="top" >Direccion</td>
      <td valign="top" >Municipio</td>
      <td valign="top" >Depto</td>
      </tr>
    <?
	 $radicados_old = $radicados;
	 if($radicados_enviar) $procradi = $radicados_enviar;
	 $radicados_sel = split(",",$procradi);
     //$procard = str_replace(",","</td></tr><tr class=t_bordeGris><td ><font size=2><B>",$procradi);

if(($grb_destino or  $reg_envio) AND $envio_peso and $valor_unit)
 {
  /* AHORA ACTUAIZA EN LOS ANEXOS */
   for($iii=0; $iii<=20; $iii++)
   {
     if($radicados_sel[$iii] )
	 {
    $i = $iii;
	$verrad_sal = $radicados_sel[$i];
    if(strlen(trim($radicados_sel[$i]))==14 or  strlen(trim($radicados_sel[$i]))==16)
	{
	  $no_digitos = 13;
	}
	else
	{
	  $no_digitos = 14;
	}
	include_once "../config.php";
	$verrad_sal = substr($verrad_sal,0,$no_digitos);
	   $isql = "SELECT b.RADI_NUME_RADI,a.ANEX_NOMB_ARCHIVO,a.ANEX_DESC,a.SGD_REM_DESTINO,a.SGD_DIR_TIPO
	   	             ,a.ANEX_RADI_NUME
	             FROM ANEXOS a,RADICADO b
                  WHERE a.anex_radi_nume=b.radi_nume_radi AND a.RADI_NUME_SALIDA=$verrad_sal and anex_estado=3
				   and a.sgd_dir_tipo != 7 ORDER BY a.SGD_DIR_TIPO ";
		Ora_commiton($handle);
		$cursor = ora_open($handle);
		ora_parse($cursor,$isql);
		ora_exec($cursor);
		$resultado = ora_fetch_into($cursor,$row2, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);

		 $rem_destino = $row2["SGD_DIR_TIPO"];
		 if (!trim($rem_destino))  {$isql_w = " sgd_dir_tipo is null ";
		    }else
			   {
			    $isql_w = " sgd_dir_tipo='$rem_destino' ";
			   }
		 $isql = "update ANEXOS set ANEX_ESTADO=4
		           ,ANEX_FECH_ENVIO=SYSDATE
		           where RADI_NUME_SALIDA =$verrad_sal and sgd_dir_tipo !=7 and  $isql_w";
    	  ora_commiton($handle);
 	      $cursor = ora_open($handle);
		  ora_parse($cursor,$isql);
		  ora_exec($cursor);
		  $anexos_act = ora_numrows($cursor);
		  $actualizados =  $anexos_act + $actualizados;
          $k++;
		  if($k<=1) echo "<b><span class=etexto>Registro de Envio Generado</span> </b><br><br>";
      }  // Cierra el If que indica sien el arreglo viene un radicado.
	}
}

   if (($reg_envio) AND (!$envio_peso or !$valor_unit) ) die ("<p><hr><b><center><span class=etexto>Debe Colocar el Peso para poder Enviar el Radicado  Archivo anexado correctamente. <br> 
   <a href='envio.php?".session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&radicados=$radicados&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&nomcarpeta=$nomcarpeta'>Atras</a>
   </br></span><hr>");
   $o = 0;
   if(!$reg_envio)
   {
   $igual_destino = "Si";
	 $comb_salida = "";
   for($iii=0; $iii<=20; $iii++)
   {
   if ($radicados_sel[$iii])
   {
	    	   $email_us = "";
	   $telefono_us = "";
	   $nombre_us = "";
	   $destino = "";
	   $departamento = "";
	   $direccion_us = "";
	   $dir_codigo = "";
	   $dir_tipo = "";
	   $verrad_sal = "";
    $i = $iii;
   ?>
    <tr class=timparr>
      <td height="21" align="center" valign="top"> <font size=2><B>
        <?
		if(strlen(trim($radicados_sel[$i]))==14 or  strlen(trim($radicados_sel[$i]))==16)
			{
			  $no_digitos = 13;
			}
			else
			{
			  $no_digitos = 14;
			}
		  $verrad_sal = $radicados_sel[$i];
		  $verrad_sal = substr($verrad_sal,0,$no_digitos);

		?>
        <input type=hidden name=verrad_sal value='<?=$verrad_sal?>'>
		<input type=hidden name=nurad value='<?=$verrad_sal?>'>
		<input type=hidden name=verrad_sal value='<?=$verrad_sal?>'>
        <?
	  /**  Aqui se graban los0 datos al envio del documento
	    */

  $numrad = $verrad;
  error_reporting(7);
  // lugar en el cual se muestra la Información para grabar en el Radicado
  	//$verrad_sal = trim($radicados_sel[$i]);
	//$nunrad_sal = trim($radicados_sel[$i]);
	$verrad_sal = substr($verrad_sal,0,$no_digitos);
    $isql = "select a.RADI_NUME_RADI,a.PLG_NOMBRE,a.PLG_ARCHIVO_FINAL,a.SGD_REM_DESTINO
	from PL_GENERADO_PLG a where a.RADI_NUME_SAL=$verrad_sal ";
	Ora_commiton($handle);
 	$cursor = ora_open($handle);
	ora_parse($cursor,$isql);
    ora_exec($cursor);
	$resultado = ora_fetch_into($cursor,$row2, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	$encontrados =ora_numrows($cursor);

	
	if($encontrados==0)
	{
	
	   $isql = "SELECT a.ANEX_RADI_NUME,a.ANEX_NOMB_ARCHIVO,a.ANEX_DESC,a.SGD_REM_DESTINO,a.SGD_DIR_TIPO
	               	  ,a.ANEX_RADI_NUME,a.RADI_NUME_SALIDA,b.RADI_NUME_DERI,b.RA_ASUN
	            FROM ANEXOS a,RADICADO b
                  WHERE a.radi_nume_salida=b.radi_nume_radi AND a.RADI_NUME_SALIDA=$verrad_sal
		and a.sgd_dir_tipo !=7 and anex_estado=3
		$comb_salida
			ORDER BY a.SGD_DIR_TIPO ";
	ora_commiton($handle);
	$cursor = ora_open($handle);
	ora_parse($cursor,$isql);
	ora_exec($cursor);
	$row2 = array();
	if(ora_fetch_into($cursor,$row2, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	{
	$verrad= $row2["ANEX_RADI_NUME"];
	$verrad_padre= $row2["RADI_NUME_DERI"];
  $ref_pdf= $row2["ANEX_NOMB_ARCHIVO"];
	$asunto        = $row2["RA_ASUN"];
  $sgd_dir_tipo  = $row2["SGD_DIR_TIPO"];
	$radi_nume_salida=$row2["RADI_NUME_SALIDA"];
		$rem_destino   = $row2["SGD_DIR_TIPO"];
		$comb_salida .= " and concat(a.radi_nume_salida,a.sgd_dir_tipo) != '$radi_nume_salida$rem_destino'";
		$dep_radicado  = substr($verrad_sal,4,3);
		$ano_radicado  = substr($verrad_sal,0,4);
		$carp_codi     = substr($dep_radicado,0,2);
		$radi_path_sal = "/$ano_radicado/$dep_radicado/docs/$ref_pdf";
	 }
  }
     ?>
     <input type=hidden name=verrad value='<?=$verrad_sal?>'>
	 <input type=hidden name=verrad_padre value='<?=$verrad_padre?>'>
	 <input type=hidden name=radicados value='<?=$radicados?>'>
	 <?=$verrad_sal?></td>
	 <td><font size=2><B><?=$verrad_padre?></td>
     <td valign="top">
     <?
  	$ruta_raiz= "..";
	$verrad_tmp = $verrad;
	if(substr($rem_destino,0,1)=="7") $radi_nume_salida = $verrad_sal;
	if(substr($rem_destino,0,1)=="2" or substr($rem_destino,0,1)=="3") $radi_nume_salida = $verrad;
	$nurad = $radi_nume_salida;
	$verrad = $radi_nume_salida;
	     	   $email_us1 = "";$email_us2 = "";$email_us3 = "";$email_us7 = "";
	   $telefono_us1 = "";$telefono_us2 = "";$telefono_us3 = "";
	   $nombre_us1 = "";$nombre_us2 = "";$nombre_us3 = "";
	   $destino1 = "";$destino2 = "";$destino3 = "";
	   $departamento1 = "";$departamento2 = "";$departamento3 = "";$departamento7 = "";
	   $direccion_us2 = "";$direccion_us3 = "";$direccion_us7 = "";
	   $dir_codigo1 = "";$dir_codigo2 = "";$dir_codigo3 = "";$dir_codigo7 = "";
	   $dir_tipo1 = "";$dir_tipo2 = "";$dir_tipo3 = "";$dir_tipo7 = "";
   
    include "../ver_datosrad.php";
	include "../radicacion/busca_direcciones.php";
	$verrad = $verrad_tmp;
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
	$nombre_us = substr($nombre_us,0,29);
	if($dir_codigo_new) $dir_codigo= $dir_codigo_new;
	?>
        <input type=text name=nombre_us id=nombre_us value='<?=$nombre_us?>' |class=e_cajas size=20 class="ecajasfecha"> </Td><td>
          <input type=text name=direccion_us id=direccion_us value='<?=$direccion_us?>' |class=e_cajas size=15 class="ecajasfecha"> </Td>
        <td>
        <input type=text name=destino id=destino  value='<?=$destino?>' size=15 class="ecajasfecha"> </Td><td>
        <input type=text name=departamento_us id=departamento value='<?=$departamento?>' |class=e_cajas size=10 class="ecajasfecha">
		<?
		    $o++;
		if($o>=2)
		{
		  if($destino != $destino_ant)  $igual_destino="No";
		  if($departamento != $departamento_ant)  $igual_destino="No";
		}
		$destino_ant = $destino;
		$departamento_ant = $departamento;
		?>
        <input type=hidden name=dir_codigo id=dir_codigo value='<?=$dir_codigo?>' |class=e_cajas size=2 class="ecajasfecha">
		<input type=hidden name=dir_tipo id=dir_tipo value='<?=$dir_tipo?>' |class=e_cajas size=3 class="ecajasfecha">
      </td>
    </tr>
    <tr  class=timparr>
      <td height="21" colspan="10">Asunto
        <input type=text disabled name=ra_asun value='<?=$ra_asun?>' class='ebuttons2' size=120  >
      </td>
		</tr>
		<tr  class=timparr>
      <td height="21" colspan="10">Observaciones o Desc Anexos
        <input type=text name=observaciones value='<?=$observaciones?>' |class=e_cajas size=50 class="ecajasfecha">
		 </td>

    </tr>
    <?
	}  // Se cierra si el if que indica que si viene un numero de radicado.
  }
 }
 else
 {
  ?>
   <td><?=$verrad_sal?></td>
   <td><?=$verrad_padre?></td>
    <td>
         <input type=text name=nombre_us id=nombre_us value='<?=$nombre_us?>' |class=e_cajas size=20 class="ecajasfecha"> </Td><td>
          <input type=text name=direccion_us id=direccion_us value='<?=$direccion_us?>' |class=e_cajas size=15 class="ecajasfecha"> </Td>
        <td>
        <input type=text name=destino value='<?=$destino?>' |class=e_cajas size=15 class="ecajasfecha">
		</td>
		<td>
        <input type=text name=departamento_us id=departamento_us value='<?=$departamento_us?>' |class=e_cajas size=10 class="ecajasfecha">
        <input type=hidden name=dir_codigo id=dir_codigo value='<?=$dir_codigo?>' |class=e_cajas size=5 class="ecajasfecha">
      </td>
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
 <?
  /** INICIO GRABACION DE DATOS 					*
   *											*
   *											*/
if($reg_envio)
 {
	 error_reporting(7);
	 $radicado_grupo = "";
	 $o = 0;
	for($iii=0; $iii<=20; $iii++)
	{
	if($radicados_sel[$iii])
	{
	$i = $iii;
	$verrad_sal = trim($radicados_sel[$i]);
	if(strlen(trim($verrad_sal))==14 or  strlen(trim($verrad_sal))==16)
	{
		$no_digitos = 13;
	}
	else
	{
		$no_digitos = 14;
	}
	if($o!=0)
	{ 
		$valor_unit=0;
	}
	else
	{
		$radi_nume_grupo = substr($radicados_sel[$iii], 0, $no_digitos);
	}
	     $verrad_sal = substr($verrad_sal,0,$no_digitos);
		 $isql = "select RADI_NUME_RADI FROM RADICADO WHERE RADI_NUME_RADI like '$verrad_sal'";
    	  Ora_commiton($handle);
		  $cursor = ora_open($handle);
		  ora_parse($cursor,$isql) or $error_db = ora_error();
		  ora_exec($cursor)or $error_db = ora_error();
		  $encontrados =ora_numrows($cursor);
		  $resultado = ora_fetch_into($cursor,$row2, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		  $encontrado_radi = $row2["RADI_NUME_RADI"];
		if($encontrado_radi)
		{
	    //$verrad = $row2["RADI_NUME_RADI"];
		if(!$codigo_envio)
		{
		 $isql = "select SGD_RENV_CODIGO FROM SGD_RENV_REGENVIO
		                ORDER BY SGD_RENV_CODIGO DESC";
		 Ora_commiton($handle);
		 $cursor = ora_open($handle);
		 ora_parse($cursor,$isql);
		 ora_exec($cursor);
		 $resultado = ora_fetch_into($cursor,$row2, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
 	     $nextval = $row2["SGD_RENV_CODIGO"];
		 $nextval++;
		 $codigo_envio = $nextval;
		}else
		{
		 $nextval = $codigo_envio;
		}
		$dep_radicado = substr($verrad_sal,4,3);
		$carp_codi = substr($dep_radicado,0,2);
		$nombre_us = substr(trim($nombre_us),0,29);
		$verrad_sal = substr($verrad_sal, 0, $no_digitos);
		$isql = "INSERT INTO SGD_RENV_REGENVIO(USUA_DOC   ,SGD_RENV_CODIGO,SGD_FENV_CODIGO ,SGD_RENV_FECH,RADI_NUME_SAL,SGD_RENV_DESTINO,SGD_RENV_TELEFONO,SGD_RENV_MAIL,SGD_RENV_PESO  ,SGD_RENV_VALOR,SGD_RENV_CERTIFICADO,SGD_RENV_ESTADO,SGD_RENV_NOMBRE,SGD_DIR_CODIGO  ,DEPE_CODI     ,SGD_DIR_TIPO,RADI_NUME_GRUPO   ,SGD_RENV_PLANILLA,SGD_RENV_DIR   ,SGD_RENV_DEPTO     ,SGD_RENV_MPIO,SGD_RENV_OBSERVA,SGD_RENV_CANTIDAD)
                                    VALUES('$usua_doc','$nextval'     ,'$empresa_envio',sysdate      ,'$verrad_sal' ,'$destino'      ,'$telefono'      ,'$mail'      ,'$envio_peso' ,'$valor_unit' ,0                   ,1              ,'$nombre_us'   ,'$dir_codigo' ,'$dependencia','$dir_tipo' ,'$radi_nume_grupo','$no_planilla'   ,'$direccion_us','$departamento_us' ,'$destino'   ,'$observaciones',1 )";
    Ora_commiton($handle);
		$cursor = ora_open($handle);
		ora_parse($cursor,$isql);
		ora_exec($cursor);
		}else
		{
		  echo "<center><b>EL RADICADO NO HA PODIDO SER PROCESADO</b></center>";
		}
		$o++;
		}
	  }  // aqui termina el For de radicados_sel
   }

/* ************************** FIN GRABACION
 * *********************************************************************************/
?>

<?  // Si e Usuario No ha Colocado Remitente.......
 if(!$reg_envio)
 {
   if ((!$direccion_us or !$destino) or $igual_destino=="No")
   {
     if($igual_destino=="Si")
	  {
         echo "<hr><span class=etexto><CENTER>DEBE SELECCIONAR UN DESTINO PARA ESTE RADICADO DE SALIDA<hr>";
	  }else{
	    echo "<hr><b><span class=etexto><CENTER>NO PUEDE SELECCIONAR VARIOS DOCUMENTOS PARA UN MISMO DESTINO CON CIUDAD Y/O DEPARTAMENTO DIFERENTE<hr>";
	  }	 
	  $envio_salida ="$verrad_sal ";
	  $forma = "false";
	  $nurad = $verrad_sal;
	  $verrad = $verrad_sal;
    //include "../radicacion/buscar_usuario.php";
   }else
   {
	 ?>
	 <input name=reg_envio type=button value='GENERAR REGISTRO DE ENVIO DE DOCUMENTO' onClick="generar_envio();">
	 <input name=reg_envio type=hidden value='GENERAR REGISTRO DE ENVIO DE DOCUMENTO' >
	 <?
	}
   }
 ?>
</form><span class=etexto>
<center>
<?
$encabezado = "krd=$krd&fecha_h=$fechah&radicados=$radicados&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max";
?>

<a href='cuerpopdf.php?<?=session_name()."=".session_id()."&$encabezado"?>'>Devolver a Listado</a>
</center></span>

</body>
</html>
<? 
if(!$reg_envio)
{

}
?>