<?
session_start();
/**
  * Modificacion para aceptar Variables GLobales
  * @autor Jairo Losada 
  * @fecha 2009/05
  */
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];

/*
 * Lista Subseries documentales
 * @autor Jairo Losada
 * @fecha 2009/06 Modificacion Variables Globales. Arreglo cambio de los request Gracias a recomendacion de Hollman Ladino
 */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$ruta_raiz = "..";
?>
<html>
<head>
<title>Untitled Document</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
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
			alert('S�o introduzca numeros en el campo de planilla.' );
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
	echo "function calcular_precio() 
	{
	";
   	$ruta_raiz = "..";
	$no_tipo="true";
    include "../config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler("$ruta_raiz");	 
    if (!defined('ADODB_FETCH_ASSOC'))	define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

    
    //	HLP. Creamos el query que trae los valores para envios nacionales o internacionales.
    //  Buscamos en SGD_DIR_DRECCIONES el radicado seleccionado y lo comparamos con el pais de la variable de sesi�n codlocal
    //  Si son iguales significa que los valores a mostrar son locales sino internacionales.
    $radSelec = $valRadio;
	$radicado_mat = split("-",$radSelec);
	$radSelec = $radicado_mat[0];
    $isql = "SELECT ID_PAIS FROM SGD_DIR_DRECCIONES WHERE RADI_NUME_RADI=$radSelec";
    $rs_tmp = $db->query($isql);
    $tmp_pais = $rs_tmp->fields["ID_PAIS"];
    $rs_tmp->Close();
    unset($rs_tmp);
    
	if ($tmp_pais == (substr($_SESSION["cod_local"],2,3)*1))	// SI es local o nacional
	{	$var_grupo = 1;
		$campos_valores = " b.SGD_TAR_VALENV1 as VALOR1, b.SGD_TAR_VALENV2 as VALOR2 ";
	}
	else	// Si el pa�s pertenece a Am�rica, osea grupo 1 o al grupo 2
	{ 	$var_grupo = 2;
		$campos_valores = " b.SGD_TAR_VALENV1G1 as VALOR1, b.SGD_TAR_VALENV2G2 as VALOR2 ";
	}
	$isql = "SELECT a.SGD_FENV_CODIGO, a.SGD_CLTA_DESCRIP, a.SGD_CLTA_PESDES, a.SGD_CLTA_PESHAST, ".$campos_valores.
				"FROM SGD_CLTA_CLSTARIF a,SGD_TAR_TARIFAS b
				WHERE a.SGD_FENV_CODIGO = b.SGD_FENV_CODIGO
				AND a.SGD_TAR_CODIGO = b.SGD_TAR_CODIGO
				AND a.SGD_CLTA_CODSER = b.SGD_CLTA_CODSER
				AND a.SGD_CLTA_CODSER = ".$var_grupo;
  	$rsEnvio = $db->query($isql);
		  echo "\n";
	 do
	 {
	   $valor_local = $rsEnvio->fields["VALOR1"];
	   $valor_fuera = $rsEnvio->fields["VALOR2"];
	   $valor_certificado = $rsEnvio->fields["VALOR1"];
	   $rango = $rsEnvio->fields["SGD_CLTA_DESCRIP"];
	   $fenvio =$rsEnvio->fields["SGD_FENV_CODIGO"];
	   echo "if(document.forma.elements['empresa_envio'].value==$fenvio)
	            {
				  if(document.getElementById('envio_peso').value>=".$rsEnvio->fields["SGD_CLTA_PESDES"]." &&  document.getElementById('envio_peso').value<=".$rsEnvio->fields["SGD_CLTA_PESHAST"].") \n
	                  {
				     document.getElementById('valor_gr').value = '$rango';
						 dp_especial='$dependencia';
             if(document.forma.elements['destino'].value=='$depe_municipio' || (dp_especial=='840' && (document.getElementById('destino').value=='FLORIDABLANCA' || document.getElementById('destino').value=='GIRON (SAN JUAN DE)' || document.getElementById('destino').value=='PIEDECUESTA'))   )    
						 {
						     valor = $valor_local + 0;
						 }else{
	 						 valor = $valor_fuera +0 ;
						 }
					  }
				}
	   ";
//	 }while($empresas_envio = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
 		  $rsEnvio->MoveNext();
	  }while (!$rsEnvio->EOF);

   ?>
   peso = document.getElementById('envio_peso').value+0;
   document.getElementById('valor_unit').value = valor ;

}<?
}
?>
</script>
</head>
<body>
<span class=etexto>
<center>
  <a href='cuerpoModifEnvio.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&radicados=$radicados&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&devolucion=3"?>' class='vinculos'>Devolver a Listado</a>
</center></span>
<?
if($grb_destino)
{ 
    $dir_codigo = $documento_us1;
}
$documento_grabar = $documento_us1;

?>
<center>
<table class=borde_tab width='100%' cellspacing="5">
<tr><td class=titulos2><center>MODIFICACION ENVIO DE DOCUMENTOS</center></td></tr></table>
<table><tr><td></td></tr></table>
<form name='forma' action='envio_mod.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&no_planilla=$no_planilla"?>' method="post">
<?

  if(!$reg_envio)
  {
?>
  <table border=0 width=100% class=borde_tab cellspacing="5">
    <!--DWLayoutTable-->
    <tr class='titulos2' >
      <td >Empresa De envio</td>
      <td >Peso(Gr)</td>
      <td >U.Medida</td>
      <td colspan="2" >Valor Total C/U</td>
     
    </tr>
    <?
  	 if ($valRadio) 
	 {
			$radSelec = $valRadio;
			$radicado_mat = split("-",$radSelec,4);
			$radicados = $radicado_mat[0];
			$renv_codigo = $radicado_mat[1];
			$empresa_envio = $radicado_mat[2];
			$envio_peso = $radicado_mat[3];
	 }
	 ?>
    <tr class='listado2'>
    <td height="26" align="center"><font size=2><B>
    <?
			include "$ruta_raiz/include/query/envios/queryEnvia.php";
			$rsEnv = $db->conn->Execute($sql);
			if(!$empresa_envio) $empresa_envio=101;
			print $rsEnv->GetMenu2("empresa_envio","$empresa_envio",false, false, 0," class='select' onClick='calcular_precio();'");
   ?>
   </td>

      <td> <input type=text name=envio_peso id=envio_peso value='<?=$envio_peso?>' size=6 onChange="calcular_precio();" class='tex_area'></td>
      <TD><input type=text name=valor_gr id=valor_gr  value='<?=$valor_gr?>' size=30 disabled class='tex_area'> </td>
      <td align="center"> <input type=text name=valor_unit id=valor_unit  readonly   value='<?=$valor_unit?>' class='tex_area' > </td>
      <td> <input type=button name=Calcular_button id=Calcular_button Value=Calcular onClick='calcular_precio();' class='botones_funcion' >
      </td>
    </tr>
  </table>
  <?
  }
  ?>
  <CENTER>
  <table border=0></table>
  <table border=0 width=100% class='borde_tab' cellspacing="5">
    <!--DWLayoutTable-->
    <tr class='titulos2' >
      <td   valign="top" >Radicado</td>
      <td valign="top" >Destinatario</td>
      <td valign="top" >Direccion</td>
      <td valign="top" >Municipio</td>
      <td valign="top" >Depto</td>
      <td valign="top" >Pa&iacute;s</td>
    </tr>
    <?
	 if ($valRadio) 
	 {
	// Extrae los datos chequeados en la pagina anterior
	        $i=0;
			//	$radicado_mat = split("-",$checkValue,2);
		 //  	$record_id = key($checkValue);
	 	//	$radSelec = $record_id;
			$radSelec = $valRadio;
			$radicado_mat = split("-",$radSelec,4);
			$radicados = $radicado_mat[0];
			$renv_codigo = $radicado_mat[1];
			$empresa_envio = $radicado_mat[2];
			$envio_peso = $radicado_mat[3];
			$radicados_sel[$i] = $radicado_mat[0];
			$renv_codigo_sel[$i] = $radicado_mat[1];		
	// Fin Extraccion de datos
//	echo "<hr>Radicados";
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
    <tr class='listado2'>
	    <?
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
  // lugar en el cual se muestra la Informacion para grabar en el Radicado

  $isql = "SELECT a.RADI_NUME_SAL	
  					,a.SGD_RENV_PLANILLA
					,a.SGD_RENV_CODIGO
  					,a.SGD_RENV_MPIO
  					,a.SGD_RENV_PAIS
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

	$rsModEnv = $db->query($isql);								

 	    $verrad          = $rsModEnv->fields["RADI_NUME_SAL"];
		$planilla        = $rsModEnv->fields["SGD_RENV_PLANILLA"];
		$sgd_dir_tipo    = $rsModEnv->fields["SGD_DIR_TIPO"];
		$radi_nume_salida= $rsModEnv->fields["RADI_NUME_SAL"];
		$rem_destino     = $rsModEnv->fields["SGD_DIR_TIPO"];
		$nombre_us       = $rsModEnv->fields["SGD_RENV_NOMBRE"];
		$direccion_us    = $rsModEnv->fields["SGD_RENV_DIR"];
        $destino         = $rsModEnv->fields["SGD_RENV_MPIO"];
		$departamento    = $rsModEnv->fields["SGD_RENV_DEPTO"];
		$pais_dest		 = $rsModEnv->fields["SGD_RENV_PAIS"];
		$dir_codigo      = $rsModEnv->fields["SGD_DIR_CODIGO"];
		$sgd_renv_codigo = $rsModEnv->fields["SGD_RENV_CODIGO"];
		$envio_peso      = $rsModEnv->fields["SGD_RENV_PESO"];
		$empresa_envio   = $rsModEnv->fields["SGD_FENV_CODIGO"];
	    $observaciones   = $rsModEnv->fields["SGD_RENV_OBSERVA"];
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
		<td height="21" align="center" valign="top">
			<font size=2><B><?=$verrad_sal?>
		</td>
		<td height="21" align="center" valign="top">
			<font size=2><B><input type=hidden name=renv_codigo value='<?=$sgd_renv_codigo?>'>
			<input type=hidden name=dep_sel value='<?=$dep_sel?>'>
			<input type=text name=nombre_us id=nombre_us value='<?=$nombre_us?>' class='tex_area' size=25 >
		</td>
		<td>
			<input type=text name=direccion_us id=direccion_us value='<?=$direccion_us?>' class='tex_area' size=25>
		</td>
		<td>
			<input type=text name=destino id=destino  value='<?=$destino?>' class='tex_area' size=15  onChange="calcular_precio();">
		</td>
		<td>
        	<input type=text name=departamento_us id=departamento_us value='<?=$departamento?>' class='tex_area' size=15>
        	<input type=hidden name=dir_codigo id=dir_codigo value='<?=$dir_codigo?>'  class='tex_area'>
        </td>
        <td><input type=text name=pais_us id=pais_us readonly value='<?=$pais_dest?>' class='tex_area' size=15></td>
    </tr>
    <tr  class='listado2'>
      <td height="21" colspan="10">Observaciones o Desc Anexos
        <input type=text name=observaciones value="<?=$observaciones?>" class='tex_area' size=120 >
      </td>
		</tr>
		<tr  class='listado2'>
      <td height="21" colspan="10">Planilla de envio
        <input name=planilla type=text class='tex_area' value='<?=$planilla?>' size=20 maxlength="7" >
      </td>

    </tr>
    <?
 }
 else
 {
  ?>
	<td height="21" align="center" valign="top" class='listado2'>
		<font size=2><B><?=$verrad_sal?>
	</td>
	<td class='listado2'>
		<input type=text name=nombre_us id=nombre_us value='<?=$nombre_us?>' class='tex_area' size=20 >
	</td>
	<td class='listado2'>
		<input type=text name=direccion_us2 id=direccion_us2 value='<?=$direccion_us?>' class='tex_area' size=15 >
	</td>
	<td class='listado2'>
		<input type=text name=destino id=destino  value='<?=$destino?>' class='tex_area' size=15>
	</td>
	<td class='listado2'>
		<input type=text name=departamento_us id=departamento_us value='<?=$departamento_us?>' class='tex_area' size=10 >
		<input type=hidden name=dir_codigo id=dir_codigo value='<?=$dir_codigo?>' class='tex_area' size=5 >
	</td>
	<td><input type=text name=pais_us id=pais_us readonly value='<?=$pais_dest?>' class='tex_area' size=15></td>
</tr>
		<tr  class='listado2'>
      <td height="21" colspan="10">Planilla de envio
        <input type=text name=planilla value='<?=$planilla?>' class='tex_area' size=20 id=planilla maxlength="7" >
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

     $dep_radicado = substr($verrad_sal,4,3);
	 $carp_codi = substr($dep_radicado,0,2);
	 $dir_tipo = 1;
	 $nombre_us = substr(trim($nombre_us),0,29);
	 $verrad_sal = substr($verrad_sal, 0, $no_digitos);
	 if($renv_codigo)
		{

		    include_once "$ruta_raiz/include/db/ConnectionHandler.php";
		    $db = new ConnectionHandler("$ruta_raiz");	 
		    define('ADODB_FETCH_ASSOC',2);
		    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

			$db->conn->debug = false ;
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
						SGD_RENV_PLANILLA='$planilla',
						SGD_RENV_DIR='$direccion_us',
						SGD_RENV_DEPTO='$departamento_us',
            			SGD_RENV_OBSERVA='$observaciones',
						SGD_RENV_MPIO='$destino'                          
					where 
					RADI_NUME_SAL=$radicados and sgd_renv_codigo='$renv_codigo' 
			";
			$rsUpdate = $db->query($isql);	
			echo "<span class=leidos>Se actualizo el radicado $verrad_sal en la planilla $planilla </span>";
		}else
		{
		  echo "<center><b><span class=titulosError>EL RADICADO NO HA PODIDO SER PROCESADO</span></b></center>";
		}
   }
 if(!$reg_envio)
 {
   if ((!$direccion_us or !$destino))
   {
      echo "<hr><span class=titulosError><CENTER>DEBE SELECCIONAR UN DESTINO PARA ESTE RADICADO DE SALIDA<hr>";
	  $envio_salida ="$verrad_sal ";
	  $forma = "false";
	  $nurad = $verrad_sal;
	  $verrad = $verrad_sal;

   }else
   {

		  ?>
		  <input name=reg_envio type=button value='MODIFICAR REGISTRO DE ENVIO ' onClick="modificar_reg();" class='botones_largo'>
		  <input name=reg_envio type=hidden value='MODIFICAR REGISTRO DE ENVIO ' >
		 <?
		 }
   }
 ?>

</form><span class=etexto>
<center>
  <a href='cuerpoModifEnvio.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&radicados=$radicados&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&devolucion=3&nombcarpeta=$nomcarpeta"?>' class="vinculos">Devolver a Listado</a>
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
