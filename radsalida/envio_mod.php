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
<script>
function back1() {
    history.go(-1);
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
        }
 }
 jh =  document.forma.elements['planilla'].value;
 if(jh)
 {
    var1 =  parseInt(jh);
		if(var1 != jh)
		{
			alert('S�o introduzca nmeros en el campo de planilla.' );
			//document.forma.submit();
			return false;
		  }else{
		    document.forma.submit();
        }
 }else{
 	document.forma.submit();
 }
}

function modificar_reg() {
   if (document.forma.envio_peso.value != 0)
     {
	   calcular_precio();
	   solonumeros();
	 }
	 else
	 {
	   alert("Debe Colocar un peso");
	 }
}
<?
if(!$reg_envio)
{
?>
function calcular_precio()
{
   <?
	$ruta_raiz = "..";
	$no_tipo="true";
    include "../config.php";
    $isql = "	SELECT a.SGD_FENV_CODIGO,a.SGD_CLTA_DESCRIP,a.SGD_CLTA_PESDES,a.SGD_CLTA_PESHAST,b.SGD_TAR_VALENV1,b.SGD_TAR_VALENV2
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
						 if(document.getElementById('destino').value=='$depe_municipio')
						 {
						     valor = $valor_local +0;
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
<?
}
?>
</script>
</head>
<body>
<span class=etexto>
<center>
  <a href='cuerpo_envio.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&radicados=$radicados&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&devolucion=3"?>'>Devolver a Listado</a>
</center></span>
<?
if($grb_destino)
{ 
    $dir_codigo = $documento_us1;
}
$documento_grabar = $documento_us1;
?>
<center>
<p><span class=etexto><B>MODIFICACION ENVIO DE DOCUMENTOS</B> </p>
<form name='forma' action='envio_mod.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&no_planilla=$no_planilla"?>' method="post">
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
   		  $isql = "select SGD_FENV_CODIGO,SGD_FENV_DESCRIP FROM SGD_FENV_FRMENVIO
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
  <table border=0></table>
  <table border=0 width=100% class=t_bordeGris>
    <!--DWLayoutTable-->
    <tr bgcolor="#cccccc" >
      <td   valign="top" >Radicado</td>
      <td valign="top" >Destinatario</td>
      <td valign="top" >Direccion</td>
      <td valign="top" >Municipio</td>
      <td valign="top" >Depto</td>
    </tr>
    <?
     if($check_value)
	 {
	// Extrae los datos chequeados en la pagina anteior
				$i=0;
				$radicado_mat = split("-",$check_value,2);
				$radicados = $radicado_mat[0];
				$renv_codigo = $radicado_mat[1];
				$radicados_sel[$i] = $radicado_mat[0];
				$renv_codigo_sel[$i] = $radicado_mat[1];		
	// Fin Extranccion de datos
	echo "<hr>Radicados";
	echo "<input type=hidden name=radicados value='$radicados'>";
	echo "<input type=hidden name=renv_codigo value='".$renv_codigo."'>";		 
	}else
	{
	      echo "<input type=hidden name=radicados value='".$radicados."'>";
	      echo "<input type=hidden name=renv_codigo value='".$renv_codigo."'>";		  
	}
   //$procard = str_replace(",","</td></tr><tr class=t_bordeGris><td ><font size=2><B>",$procradi);
   if (($reg_envio) AND (!$envio_peso or !$valor_unit) ) die ("<p><hr><b><center><span class=etexto>Debe Colocar el Peso para poder Enviar el Radicado  Archivo anexado correctamente<br></br></span><hr>");
   if(!$reg_envio)
   {
    $i = $iii;
   ?>
    <tr class=timparr>
	    <?
		 $verrad_sal = $radicados;
		  $no_digitos = 14;
		 $verrad_sal_t = $radicados;
		 $verrad_sal = $radicados;
		 $sgd_dir_tipo = substr($verrad_sal_t,($no_digitos),3);
     echo "<p>";
	    ?>
        <input type=hidden name=verrad_sal value='<?=$verrad_sal_t?>'>
        <input type=hidden name=nurad value='<?=$verrad_sal?>'>
      <font size=2><B>
        <?
	  /**  Aqui se graban los datos al envio del documento
	    */
  $numrad = $verrad;
  error_reporting(7);
  // lugar en el cual se muestra la Informaci� para grabar en el Radicado
  	//$verrad_sal = trim($radicados_sel[$i]);
	//$nunrad_sal = trim($radicados_sel[$i]);
  $isql = "SELECT a.RADI_NUME_SAL	
  					,a.SGD_RENV_PLANILLA
					,a.SGD_RENV_CODIGO
  					,a.SGD_RENV_MPIO
  					,a.SGD_DIR_TIPO
	   	            ,a.SGD_RENV_DEPTO
                   ,a.SGD_RENV_NOMBRE
                   ,a.SGD_RENV_DIR
                   ,a.SGD_RENV_PESO
                   ,a.SGD_FENV_CODIGO
                   ,a.SGD_RENV_OBSERVA
	             FROM SGD_RENV_REGENVIO a
                  WHERE a.RADI_NUME_SAL=$verrad_sal and a.sgd_renv_codigo='$renv_codigo'
                  ";
									echo $isql;
		ora_commiton($handle);
		$cursor = ora_open($handle);
		ora_parse($cursor,$isql);
		ora_exec($cursor);
		$resultado = ora_fetch_into($cursor,$row2, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
 	    $verrad        = $row2["RADI_NUME_SAL"];
		$planilla       = $row2["SGD_RENV_PLANILLA"];
		$sgd_dir_tipo  = $row2["SGD_DIR_TIPO"];
		$radi_nume_salida=$row2["RADI_NUME_SAL"];
		$rem_destino   = $row2["SGD_DIR_TIPO"];
		$nombre_us   = $row2["SGD_RENV_NOMBRE"];
		$direccion_us   = $row2["SGD_RENV_DIR"];
        $destino   = $row2["SGD_RENV_MPIO"];
		$departamento   = $row2["SGD_RENV_DEPTO"];
		$dir_codigo  = $row2["SGD_DIR_CODIGO"];
		$sgd_renv_codigo  = $row2["SGD_RENV_CODIGO"];
		$planilla   = $row2["SGD_RENV_PLANILLA"];
		$envio_peso =  $row2["SGD_RENV_PESO"];
		$empresa_envio =  $row2["SGD_FENV_CODIGO"];
    $observaciones =  $row2["SGD_RENV_OBSERVA"];
		echo "<script>
			  document.getElementById('empresa_envio').value='$empresa_envio';
		      document.getElementById('envio_peso').value = '$envio_peso';
			  calcular_precio();
			  </script>";
		$dep_radicado  = substr($verrad_sal,4,3);
		$ano_radicado  = substr($verrad_sal,0,4);
		$carp_codi     = substr($dep_radicado,0,2);
		$radi_path_sal = "/$ano_radicado/$dep_radicado/docs/$ref_pdf";
     ?>
     <input type=hidden name=verrad value='<?=$verrad?>'>
     <?
	if($dir_codigo_new) $dir_codigo= $dir_codigo_new;
	?>
    <td height="21" align="center" valign="top"> <font size=2><B>
	 <?=$verrad_sal?>
     </td>
	 <td height="21" align="center" valign="top"> <font size=2><B>
	   <input type=hidden name=renv_codigo value='<?=$sgd_renv_codigo?>'>
	   	   <input type=hidden name=dep_sel value='<?=$dep_sel?>'>
        <input type=text name=nombre_us id=nombre_us value='<?=$nombre_us?>' class=ecajasfecha size=20 > </Td><td>
          <input type=text name=direccion_us id=direccion_us value='<?=$direccion_us?>' class=ecajasfecha size=15> </Td><td>
          <input type=text name=destino id=destino  value='<?=$destino?>' class=ecajasfecha size=15  onChange="calcular_precio();"></Td><td>
        <input type=text name=departamento_us id=departamento_us value='<?=$departamento?>' class=ecajasfecha size=10>
        <input type=hidden name=dir_codigo id=dir_codigo value='<?=$dir_codigo?>'  class=ecajasfecha size=5>
      </td>
    </tr>
    <tr  class=timparr>
      <td height="21" colspan="10">Observaciones o Desc Anexos
        <input type=text name=observaciones value="<?=$observaciones?>" class=ecajasfecha size=120 >
      </td>
		</tr>
		<tr  class=timparr>
      <td height="21" colspan="10">Planilla de envio
        <input name=planilla type=text class=ecajasfecha value='<?=$planilla?>' size=20 maxlength="7" >
      </td>

    </tr>
    <?
 }
 else
 {
  ?>
    <td height="21" align="center" valign="top"> <font size=2><B>
	 <?=$verrad_sal?>
     </td>
    <td>
         <input type=text name=nombre_us id=nombre_us value='<?=$nombre_us?>' class=ecajasfecha size=20 > </Td><td>
           <input type=text name=direccion_us2 id=direccion_us2 value='<?=$direccion_us?>' class=ecajasfecha size=15 > </Td>
        <td>
        <input type=text name=destino id=destino  value='<?=$destino?>' class=ecajasfecha size=15> </Td><td>
        <input type=text name=departamento_us id=departamento_us value='<?=$departamento_us?>' class=ecajasfecha size=10 >
        <input type=hidden name=dir_codigo id=dir_codigo value='<?=$dir_codigo?>' class=ecajasfecha size=5 >
      </td>
	       </tr>
		<tr  class=timparr>
      <td height="21" colspan="10">Planilla de envio
        <input type=text name=planilla value='<?=$planilla?>' class=ecajasfecha size=20 id=planilla maxlength="7" >
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
 <?
  /** INICIO GRABACION DE DATOS 					*
   *											*
   *											*/
if($reg_envio)
 {
	 error_reporting(7);
	 $radicado_grupo = "";
		  $no_digitos = 14;
	  $radi_nume_grupo = substr($radicados_sel[0], 0, $no_digitos);
	  if($i!=0) { $valor_unit=0; }
	  $verrad_sal = $radicados_sel[$i];
	  $verrad_sal = substr($verrad_sal,0,$no_digitos);
	  include_once  "$ruta_raiz/config.php";
		$isql = "select RADI_NUME_RADI FROM RADICADO WHERE RADI_NUME_RADI like '$verrad_sal'";
		  ora_commiton($handle);
		  $cursor = ora_open($handle);
		  ora_parse($cursor,$isql) or $error_db = ora_error();
		  ora_exec($cursor)or $error_db = ora_error();
		  $encontrados =ora_numrows($cursor);
		  $resultado = ora_fetch_into($cursor,$row2, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		  $encontrado_radi = $row2["RADI_NUME_RADI"];
          $dep_radicado = substr($verrad_sal,4,3);
			$carp_codi = substr($dep_radicado,0,2);
			$dir_tipo = 1;
			$nombre_us = substr(trim($nombre_us),0,29);
			$verrad_sal = substr($verrad_sal, 0, $no_digitos);
		if($renv_codigo)
		{
			$isql = "UPDATE SGD_RENV_REGENVIO
					 SET
						USUA_DOC='$usua_doc',
						SGD_FENV_CODIGO='$empresa_envio',
						SGD_RENV_DESTINO= '$destino',
						SGD_RENV_TELEFONO='$telefono',
						SGD_RENV_MAIL='$mail',
						SGD_RENV_PESO='$envio_peso',
						SGD_RENV_VALOR='$valor_unit',
						SGD_RENV_CERTIFICADO='0',
						SGD_RENV_ESTADO='1',
						SGD_RENV_NOMBRE='$nombre_us',
						DEPE_CODI='$dependencia',
						SGD_DIR_TIPO='$dir_tipo',
						RADI_NUME_GRUPO='$radi_nume_grupo',
						SGD_RENV_PLANILLA='$planilla',
						SGD_RENV_DIR='$direccion_us',
						SGD_RENV_DEPTO='$departamento_us',
            			SGD_RENV_OBSERVA='$observaciones',
						SGD_RENV_MPIO='$destino'                          
					where 
					RADI_NUME_SAL=$radicados and sgd_renv_codigo='$renv_codigo'
			";
			Ora_commiton($handle);
			$cursor = ora_open($handle);
			ora_parse($cursor,$isql);
			ora_exec($cursor);
			echo "<span class=etexto>Se actualizo el radicado $verrad_sal en la planilla $planilla </span>";
		}else
		{
		  echo "<center><b>EL RADICADO NO HA PODIDO SER PROCESADO</b></center>";
		}
   }
 if(!$reg_envio)
 {
   if ((!$direccion_us or !$destino))
   {
      echo "<hr><span class=etexto><CENTER>DEBE SELECCIONAR UN DESTINO PARA ESTE RADICADO DE SALIDA<hr>";
	  $envio_salida ="$verrad_sal ";
	  $forma = "false";
	  $nurad = $verrad_sal;
	  $verrad = $verrad_sal;

      //include "../radicacion/buscar_usuario.php";

   }else
   {

		  ?>
		  <input name=reg_envio type=button value='MODIFICAR REGISTRO DE ENVIO ' onClick="modificar_reg();">
		  <input name=reg_envio type=hidden value='MODIFICAR REGISTRO DE ENVIO ' >
		 <?
		 }
   }
 ?>

</form><span class=etexto>
<center>
  <a href='cuerpo_envio.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&radicados=$radicados&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&devolucion=3&nombcarpeta=$nomcarpeta"?>'>Devolver a Listado</a>
</center></span>
</body>
<? 
if(!$reg_envio)
{
  		echo "<script>
			  calcular_precio();
			  </script>";
}
?>
</html>
