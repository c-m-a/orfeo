<?php
session_start();
/**
  * Modificacion Variables Globales Infometrika 2009-05
  * Licencia GNU/GPL 
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];$ruta_raiz = "..";if (!$ruta_raiz)	$ruta_raiz="..";
$ent = (isset($_POST['ent']))? $_POST['ent'] : null;

if(empty($ent))
  $ent = $_GET['ent'];

require_once('../include/db/ConnectionHandler.php');
if (empty($db))
  $db = new ConnectionHandler($ruta_raiz);
include ('./crea_combos_universales.php');	
$db->conn->SetFetchMode(ADODB_FETCH_NUM);	
?>
<!doctype html>
<html>
  <head>
    <title>Busqueda Remitente / Destino</title>
    <base href="<?=ORFEO_URL?>">
    <link rel="stylesheet" href="estilos/orfeo.css" type="text/css">
    <script Language="JavaScript" SRC="js/crea_combos_2.js"></script>
    <script LANGUAGE="JavaScript">
<?php
// Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
echo arrayToJsArray($vpaisesv, 'vp'); 
echo arrayToJsArray($vdptosv, 'vd');
echo arrayToJsArray($vmcposv, 'vm');
?>
function verif_data() {
  if (document.formu1.idcont4.value && document.formu1.idpais4.value && document.formu1.codep_us4.value && document.formu1.muni_us4.value == 0) {
    alert("Seleccione la geograf&iacute;a completa del destinatario");
	  return false;
	}

	if (document.formu1.direccion_nus1.value=='') {
    alert("Debe colocar una Direcci&oacute;n.");
		return false;
	}

	if (document.formu1.nombre_nus1.value=='')
	{	alert("Debe colocar un nombre.");
		return false;
	}
	return true;
}

function pasar_datos(fecha) {
<?php
	$i_registros = 3;
	for($i=1;$i<=$i_registros;$i++) {
	 echo "documento = document.formu1.documento_us$i.value;\n";
	 echo "if(documento) {
    nombre = document.formu1.nombre_us$i.value + ' ';
		apellido1 = document.formu1.prim_apell_us$i.value  + ' ' ;
		apellido2 = document.formu1.seg_apell_us$i.value  + ' ' ;
		opener.document.formulario.documento_us$i.value = documento;
		opener.document.formulario.nombre_us$i.value = nombre ;
		opener.document.formulario.prim_apel_us$i.value = apellido1;
		opener.document.formulario.seg_apel_us$i.value  = apellido2;
		opener.document.formulario.telefono_us$i.value  = document.formu1.telefono_us$i.value;
		opener.document.formulario.mail_us$i.value      = document.formu1.mail_us$i.value;  
		opener.document.formulario.direccion_us$i.value = document.formu1.direccion_us$i.value;
		opener.document.formulario.tipo_emp_us$i.value = document.formu1.tipo_emp_us$i.value;
		opener.document.formulario.cc_documento_us$i.value = document.formu1.cc_documento_us$i.value;";
		if($ent==2) {
		switch ($db->entidad) {
		case 'SES':
		/** Modificado Supersolidaria 01-Nov-2006
			* Pasa al formulario de radicacion los datos del funcionario que tiene a
			* cargo una entidad y la dependencia a la que pertenece.
			*/
		print "if(documento) {
			opener.document.formulario.supervisor_us.value = document.getElementById('supervisor_us1').value;

		}";
			break;
		}
		}
		if (isset($_GET['tipoval']))
		{	echo "	opener.document.formulario.idcont$i.value = document.formu1.idcont$i.value;
			opener.document.formulario.idpais$i.value = document.formu1.idpais$i.value;
			opener.document.formulario.codep_us$i.value = document.formu1.codep_us$i.value;
			opener.document.formulario.muni_us$i.value = document.formu1.muni_us$i.value;
			}";
		}
		else
		{	echo "	opener.document.formulario.idcont$i.value = document.formu1.idcont$i.value;
			opener.cambia(opener.document.formulario,'idpais$i','idcont$i');
			opener.document.formulario.idpais$i.value = document.formu1.idpais$i.value;
			opener.cambia(opener.document.formulario,'codep_us$i','idpais$i');
			opener.document.formulario.codep_us$i.value = document.formu1.codep_us$i.value;
			opener.cambia(opener.document.formulario,'muni_us$i','codep_us$i');
			opener.document.formulario.muni_us$i.value = document.formu1.muni_us$i.value;
			}";
		}
	}
	echo "opener.document.formulario.otro_us1.focus();opener.focus(); window.close();\n";
	?>   
}
</script>
</head>
<body bgcolor="#FFFFFF">
<script LANGUAGE="JavaScript">
tipo_emp=new Array();
nombre=new Array();
documento=new Array();
cc_documento=new Array();      
direccion=new Array();
apell1=new Array();
apell2=new Array();
telefono=new Array();
mail=new Array();
codigo = new Array();
codigo_muni = new Array();   
codigo_dpto = new Array();      
codigo_pais = new Array();
codigo_cont = new Array();

<?php
switch ($db->entidad) {
    case 'SES':
        /** Modificado Supersolidaria 01-Nov-2006
          * Define el arreglo que almacenara los datos del funcionario que tiene a cargo una
          * entidad y la dependencia a la que pertenece.
          */
        echo 'supervisor = new Array();' . "\n";
        break;
}
?>
function pasar(indice,tipo_us)
{ 
<?php
  if (empty($nombre_essp))
    $nombre_essp = null;

	$nombre_essp = strtoupper($nombre_essp);

	$i_registros = (empty($envio_salida) && empty($busq_salida))? 3 : 1;	
  
  $i_registros=3;
	for($i=1;$i<=$i_registros;$i++) {
	echo "if(tipo_us==$i) {
		document.getElementById('documento_us$i').value = documento[indice];
		document.getElementById('no_documento1').value = cc_documento[indice];
		document.getElementById('codigo').value = codigo[indice];			   
		document.getElementById('cc_documento_us$i').value = cc_documento[indice];
		document.getElementById('nombre_nus1').value = nombre[indice]; 
		document.getElementById('nombre_us$i').value = nombre[indice]; 
		document.getElementById('prim_apell_us$i').value = apell1[indice];
		document.getElementById('prim_apell_nus1').value = apell1[indice];
		document.getElementById('seg_apell_us$i').value = apell2[indice];
		document.getElementById('seg_apell_nus1').value = apell2[indice];			   
		document.getElementById('direccion_us$i').value = direccion[indice];
		document.getElementById('direccion_nus1').value = direccion[indice];			   
		document.getElementById('telefono_us$i').value = telefono[indice];
		document.getElementById('telefono_nus1').value = telefono[indice];			   
		document.getElementById('mail_us$i').value = mail[indice];
		document.getElementById('mail_nus1').value = mail[indice];			   
		document.getElementById('tipo_emp_us$i').value = tipo_emp[indice];
		document.getElementById('tagregar').value = tipo_emp[indice];			   
		document.getElementById('muni_us$i').value = codigo_muni[indice];
		document.getElementById('codep_us$i').value = codigo_dpto[indice];
		document.getElementById('idpais$i').value = codigo_pais[indice];
		document.getElementById('idcont$i').value = codigo_cont[indice];
		document.getElementById('idcont4').value = codigo_cont[indice];
		cambia(formu1,'idpais4','idcont4');
		document.getElementById('idpais4').value = codigo_pais[indice];
		cambia(formu1,'codep_us4','idpais4');
		document.getElementById('codep_us4').value = codigo_dpto[indice];
		cambia(formu1,'muni_us4','codep_us4');
		document.getElementById('muni_us4').value = codigo_muni[indice];
		";

	/** Modificado Supersolidaria 01-Nov-2006
		* Pasa al campo oculto los datos del funcionario que tiene a cargo una
		* entidad y la dependencia a la que pertenece.
		*/
	switch( $db->entidad ) {
		case 'SES':
		print "document.getElementById('supervisor_us1').value = supervisor[indice];";
		break;
	}
	echo "	}";
	}
	?>
}

function activa_chk(forma)
{	//alert(forma.tbusqueda.value);
	//var obj = document.getElementById(chk_desact);
	if (forma.tbusqueda.value == 1)
		forma.chk_desact.disabled = false;
	else
		forma.chk_desact.disabled = true;
}
</script>
<?php
if(empty($envio_salida) && empty($busq_salida)) {
	$label_us = $nombreTp1;
	$label_pred = $nombreTp2;
	$label_emp = $nombreTp3;
} else {
	$label_us = "DESTINATARIO";
	$label_pred = "$nombreTp2";	
	$label_emp = "$nombreTp3"; 
}

$tbusqueda = (isset($_POST['tbusqueda']))? $_POST['tbusqueda'] : null;

if (isset($tagregar) && isset($agregar))
  $tbusqueda = $tagregar;

if (isset($no_documento1) && (isset($agregar) || isset($modificar)))
  $no_documento = $no_documento1;

if(empty($no_documento1) && isset($nombre_nus1) && (isset($agregar) || isset($modificar)))
  $nombre_essp = $nombre_nus1;

$enviar_radicado = (isset($verrad))? '&verrad=' . $verrad : null;
$enviar_tipoval  = (isset($_GET['tipoval']))? '&tipoval=' . $_GET['tipoval'] : null;

$enlace_buscar = 'radicacion/buscar_usuario.php?' .
                  'busq_salida=' . $busq_salida .
                  $enviar_radicado .
                  '&nombreTp1=' . $nombreTp1 .
                  '&nombreTp2=' . $nombreTp2 .
                  '&nombreTp3=' . $nombreTp3 .
                  $enviar_tipoval;

if(empty($formulario))
  echo '<form method="post" name="formu1" id="formu1" action="' . $enlace_buscar . '">';
?>
<input type="hidden" name="ent" value="<?=$ent?>" >
<input type="hidden" name="radicados" value="<?=(isset($radicados_old))? $radicados_old : null?>">
<table border=0 width="78%" class="borde_tab" cellpadding="0" cellspacing="1">
<tr> 
	<td width="30%" class="titulos5"><font class="tituloListado">BUSCAR POR </font></td>
	<td width="50%" class="titulos5">
		<select name='tbusqueda' class='select' onchange="activa_chk(this.form)">
				<?
				if($tbusqueda==0){$datos = "selected";$tbusqueda=0;}else{$datos= "";}
				?> 
			<option value=0 <?=$datos ?>>USUARIO</option>
				<?
				if($tbusqueda==1){$datos = "selected";$tbusqueda=1;}else{$datos= "";}
			if (strlen($nombreTp3) > 0) echo "<option value=1 $datos>$nombreTp3</option>";
				
				if($tbusqueda==2){$datos = "selected";$tbusqueda=2;}else{$datos= "";}
				?> 
			//MODIFICADO IDRD	
			<option value=2 <?=$datos ?>>EMPRESAS</option>
				<? if($tbusqueda==6){$datos = " selected ";$tbusqueda=6;}else{$datos= "";}?>
			<option value=6 <?=$datos ?>>FUNCIONARIO</option>
		</select>
	</td>
	<td width="20%" rowspan="2" align="center" class="titulos5" > 
		<input type=submit name=buscar value='BUSCAR' class="botones">
	</td>
</tr>
<tr> 
	<td class="listado5" valign="middle">
		<span class="titulos5">Documento</span> 
		<input type="text" name="no_documento" value="<?=(isset($_POST["no_documento"]))? $_POST["no_documento"] : null?>" class="tex_area">
		</font>
	</td>
	<td class="listado5" valign="middle">
		<span class="titulos5">Nombre</span> 
		<input type="text" name="nombre_essp" value="<?=(isset($_POST["nombre_essp"]))? $_POST["nombre_essp"] : null ?>" class="tex_area">
		<input type="checkbox" name="chk_desact" id="chk_desact" <?=(isset($_POST['tbusqueda']) && $_POST['tbusqueda'] != 1)? "disabled" : null?>>
    Incluir no vigentes  
	</td>
</tr>
</table>
<br>
<table class="borde_tab" width="100%">
  <tr class="listado2">
    <td colspan="10">
    <center>RESULTADO DE BUSQUEDA</center>
    </td>
  </tr>
</table>
<table class=borde_tab width="100%" cellpadding="0" cellspacing="1">
<tr class="grisCCCCCC" align="center"> 
	<td width="10%" CLASS="titulos5" >DOCUMENTO</td>
	<td width="10%" CLASS="titulos5" >NOMBRE</td>
	<td width="10%" CLASS="titulos5" >PRIM.<BR>APELLIDO o SIGLA</td>
	<td width="10%" CLASS="titulos5" >SEG.<BR>APELLIDO o R Legal</td>
	<td width="10%" CLASS="titulos5">DIRECCION</td>
  <td width="5%" CLASS="titulos5" >CIUDAD</td>
	<td width="5%" CLASS="titulos5" >TELEFONO</td>
	<td width="5%" CLASS="titulos5" >EMAIL</td>
	<td colspan="3%" CLASS="titulos5" >COLOCAR COMO </td>
</tr> 
<?php
  $grilla = "timpar";
  $i = 0;

  if (empty($modificar))
    $modificar = null;

  if (empty($agregar))
    $agregar = null;
   
	if ($modificar == 'MODIFICAR' && $agregar == 'AGREGAR') {
		$muni_tmp = explode("-",$muni_us4);
   		$muni_tmp = $muni_tmp[2];
   		$dpto_tmp = explode("-",$codep_us4);
   		$dpto_tmp = $dpto_tmp[1];
   }
   if($modificar=="MODIFICAR" and $tagregar==0)
   {	$isql = "update SGD_CIU_CIUDADANO set SGD_CIU_CEDULA='$no_documento1', SGD_CIU_NOMBRE='$nombre_nus1', 
      			SGD_CIU_DIRECCION='$direccion_nus1', SGD_CIU_APELL1='$prim_apell_nus1', SGD_CIU_APELL2='$seg_apell_nus1',
      			SGD_CIU_TELEFONO='$telefono_nus1', SGD_CIU_EMAIL='$mail_nus1', ID_CONT=$idcont4, ID_PAIS=$idpais4, 
      			DPTO_CODI=$dpto_tmp, MUNI_CODI=$muni_tmp where SGD_CIU_CODIGO=$codigo ";
	   	$rs=$db->query($isql);
			if (!$rs){
				die ("<span class='etextomenu'>No se pudo actualizar SGD_CIU_CIUDADANO ($isql) "); 	
			}
      $isql = "select * from SGD_CIU_CIUDADANO where SGD_CIU_CEDULA='$no_documento1'";
			$rs=$db->query($isql);

	  }

	 $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);		
   if($agregar=="AGREGAR" and $tagregar==0)
   {
		$cedula = 999999;
		if($no_documento)
	{
			$isql = "select SGD_CIU_CEDULA  from SGD_CIU_CIUDADANO WHERE  SGD_CIU_CEDULA='$no_documento'";
			$rs=$db->query($isql);
			
			if  (!$rs->EOF)	$cedula = $rs->fields["SGD_CIU_CEDULA"] ;
	   $flag ==0;
	  }
	   //echo "--->Doc >$no_documento<";
     if($cedula==$no_documento and $no_documento!="" and $no_documento!=0)
	 {
	   echo "<center><b><font color=red><center><< No se ha podido agregar el usuario, El usuario ya se encuentra >> </center></font>";
     }else
	 {
	 	 
 	
   	$nextval=$db->nextId("sec_ciu_ciudadano");
		if ($nextval==-1){
			die ("<span class='etextomenu'>No se encontr� la secuencia sec_ciu_ciudadano ");						   
		}
	   error_reporting(7);
			$isql = "INSERT INTO SGD_CIU_CIUDADANO(SGD_CIU_CEDULA, TDID_CODI, SGD_CIU_CODIGO, SGD_CIU_NOMBRE,
					SGD_CIU_DIRECCION, SGD_CIU_APELL1, SGD_CIU_APELL2, SGD_CIU_TELEFONO, SGD_CIU_EMAIL, ID_CONT, ID_PAIS, 
					DPTO_CODI, MUNI_CODI) values ('$no_documento', 2, $nextval, '$nombre_nus1', '$direccion_nus1', 
					'$prim_apell_nus1', '$seg_apell_nus1','$telefono_nus1', '$mail_nus1', 
					$idcont4, $idpais4, $dpto_tmp, $muni_tmp)";
	   if (!trim($no_documento)) $nombre_essp = "$nombre_nus1 $prim_apell_nus1 $seg_apell_nus1";
		 $rs=$db->query($isql);
		 if (!$rs){
				$db->conn->RollbackTrans();
				die ("<span class='etextomenu'>No se pudo actualizar SGD_CIU_CIUDADANO ($isql) "); 	
		 }
	   }
	   if ($flag==1)
	   {
			echo "<center><b><font color=red><center>No se ha podido agregar el usuario, verifique que los datos sean correctos</center></font>";
	   }
       $isql = "select * from SGD_CIU_CIUDADANO where SGD_CIU_CEDULA='$no_documento1'";
	   	 $rs=$db->query($isql);
   }
   if($agregar=="AGREGAR" and $tagregar==2)
   {
			$nextval=$db->nextId("sec_oem_oempresas");

		if ($nextval==-1)
		{	die ("<span class='etextomenu'>No se encontr&oacute; la secuencia sec_oem_oempresas ");						   
		}
			 
		$isql = "INSERT INTO SGD_OEM_OEMPRESAS( tdid_codi, SGD_OEM_CODIGO, SGD_OEM_NIT, SGD_OEM_OEMPRESA, SGD_OEM_DIRECCION, SGD_OEM_MAIL,
				SGD_OEM_REP_LEGAL, SGD_OEM_SIGLA, SGD_OEM_TELEFONO, ID_CONT, ID_PAIS, DPTO_CODI, MUNI_CODI) 
				values (4, $nextval, '$no_documento'
        , '$nombre_nus1'
        , '$direccion_nus1'
        ,'".trim($mail_nsu1)."'
        , '$seg_apell_nus1', 
						'$prim_apell_nus1', '$telefono_nus1',$idcont4, $idpais4, $dpto_tmp, $muni_tmp)";
		$rs=$db->query($isql);
			 
		if (!$rs)
				die ("<span class='titulosError'>No se pudo insertar en SGD_OEM_OEMPRESAS ($isql) "); 	
		
 }
   if($modificar=="MODIFICAR" and $tagregar==2)
	{	$isql = "UPDATE SGD_OEM_OEMPRESAS 
	SET SGD_OEM_NIT='$no_documento1', SGD_OEM_OEMPRESA='$nombre_nus1', 
	SGD_OEM_DIRECCION='$direccion_nus1',
  SGD_OEM_MAIL='$mail_nus1',
  SGD_OEM_REP_LEGAL='$seg_apell_nus1', SGD_OEM_SIGLA='$prim_apell_nus1',
	SGD_OEM_TELEFONO='$telefono_nus1', ID_CONT=$idcont4, ID_PAIS= $idpais4, DPTO_CODI=$dpto_tmp, 
	MUNI_CODI=$muni_tmp where SGD_OEM_CODIGO='$codigo'";
		$rs=$db->query($isql);
		 
		 if (!$rs){
				$db->conn->RollbackTrans();
		 }
 	 }
 
if(isset($no_documento) || isset($nombre_essp)) {
  if($tbusqueda==0) {
    $array_nombre = preg_split('/\ /', $nombre_essp."    ");
   		$isql = "select * from SGD_CIU_CIUDADANO ";
		
    if ($nombre_essp) {
      if($array_nombre[0]) {
        $where_split = $db->conn->Concat("UPPER(sgd_ciu_nombre)",
                                          "UPPER(sgd_ciu_apell1)",
                                          "UPPER(sgd_ciu_apell2)") .
                                          " LIKE '%". $array_nombre[0] ."%' ";
      }
			
      if ($array_nombre[1]) {
        $where_split .= " and ". $db->conn->Concat("UPPER(sgd_ciu_nombre)",
                                  "UPPER(sgd_ciu_apell1)",
                                  "UPPER(sgd_ciu_apell2)") .
                                  " LIKE '%". $array_nombre[1] ."%' ";
      }
			
      if ($array_nombre[2]) {
        $where_split .= " and " . $db->conn->Concat("UPPER(sgd_ciu_nombre)",
                                  "UPPER(sgd_ciu_apell1)",
                                  "UPPER(sgd_ciu_apell2)") .
                                  " LIKE '%". $array_nombre[2] ."%' ";
      }
			
      if ($array_nombre[3]) {
        $where_split .= " and " . $db->conn->Concat("UPPER(sgd_ciu_nombre)",
                                  "UPPER(sgd_ciu_apell1)",
                                  "UPPER(sgd_ciu_apell2)") .
                                  " LIKE '%". $array_nombre[3] ."%' ";
      }         
			
      $isql .= " where $where_split ";
		}

	  if(isset($no_documento)) {
      $isql .= (isset($nombre_eesp))? ' and ' : ' where ';
			$isql .= " SGD_CIU_CEDULA='$no_documento' ";
	   }
	   $isql .= " order by sgd_ciu_nombre,sgd_ciu_apell1,sgd_ciu_apell2 "; 
	}
	if($tbusqueda==2)
	{	$isql = "select SGD_OEM_NIT AS SGD_CIU_CEDULA
	 ,SGD_OEM_OEMPRESA as 	SGD_CIU_NOMBRE
	 ,SGD_OEM_REP_LEGAL as SGD_CIU_APELL2
	 ,SGD_OEM_CODIGO AS SGD_CIU_CODIGO
	 ,SGD_OEM_DIRECCION as SGD_CIU_DIRECCION
   ,SGD_OEM_MAIL as SGD_CIU_EMAIL
	 ,SGD_OEM_TELEFONO AS SGD_CIU_TELEFONO
	 ,SGD_OEM_SIGLA AS SGD_CIU_APELL1
	 ,MUNI_CODI,DPTO_CODI,ID_PAIS,ID_CONT
	from SGD_OEM_OEMPRESAS	
	where ";
	if($nombre_essp)
	{
	 $isql .= " UPPER(SGD_OEM_OEMPRESA) LIKE '%$nombre_essp%' 
	 OR UPPER(SGD_OEM_SIGLA) LIKE '%$nombre_essp%'";
	}
	
	if($_POST["no_documento"])	
	{
	if($nombre_essp) $isql .= " and ";
	 $isql .= "  SGD_OEM_NIT = '$no_documento'   ";  
	}
	$isql .= " order by sgd_oem_oempresa"; 
	}
	
	if($tbusqueda==1)
	{	
	switch( $db->entidad )
	{
	case 'SES':
		$isql  = "SELECT NIT_DE_LA_EMPRESA AS SGD_CIU_CEDULA";
		$isql .= " ,NOMBRE_DE_LA_EMPRESA AS SGD_CIU_NOMBRE";
		$isql .= " ,SIGLA_DE_LA_EMPRESA AS SGD_CIU_APELL1";
		$isql .= " ,BE.IDENTIFICADOR_EMPRESA AS SGD_CIU_CODIGO";
		$isql .= " ,DIRECCION AS SGD_CIU_DIRECCION";
		$isql .= " ,TELEFONO_1 AS SGD_CIU_TELEFONO";
		$isql .= " ,NOMBRE_REP_LEGAL AS SGD_CIU_APELL2";
		$isql .= " ,SIGLA_DE_LA_EMPRESA AS SGD_CIU_APELL1";
		$isql .= " ,CODIGO_DEL_DEPARTAMENTO AS DPTO_CODI";
             
		$isql .= " ,CODIGO_DEL_MUNICIPIO AS MUNI_CODI";
		$isql .= " ,U.USUA_NOMB, D.DEPE_NOMB,BE.ID_PAIS, BE.ID_CONT";
		$isql .= " FROM BODEGA_EMPRESAS BE";
		$isql .= " LEFT JOIN SGD_EMPUS_EMPUSUARIO EMPUS ON BE.IDENTIFICADOR_EMPRESA = EMPUS.IDENTIFICADOR_EMPRESA";
		$isql .= " LEFT JOIN USUARIO U ON U.USUA_LOGIN = EMPUS.USUA_LOGIN";
		$isql .= " LEFT JOIN DEPENDENCIA D ON D.DEPE_CODI = U.DEPE_CODI";
		$isql .= " WHERE ( SIGLA_DE_LA_EMPRESA LIKE '%$nombre_essp%' OR NOMBRE_DE_LA_EMPRESA LIKE '%$nombre_essp%' )";
		if( strlen( trim( $no_documento ) ) > 0 )
		{
				$isql .= " AND NIT_DE_LA_EMPRESA like '%$no_documento%'"; 
		}
		$isql .= " and ESTADO_EMPRESA=1  ORDER BY NOMBRE_DE_LA_EMPRESA";
		break;
	default:
	$isql = "select NIT_DE_LA_EMPRESA AS SGD_CIU_CEDULA,NOMBRE_DE_LA_EMPRESA as SGD_CIU_NOMBRE
	,SIGLA_DE_LA_EMPRESA as SGD_CIU_APELL1, ".
	"IDENTIFICADOR_EMPRESA AS SGD_CIU_CODIGO
	,DIRECCION as SGD_CIU_DIRECCION
	,TELEFONO_1 AS SGD_CIU_TELEFONO
	,NOMBRE_REP_LEGAL as SGD_CIU_APELL2
	,SIGLA_DE_LA_EMPRESA as SGD_CIU_APELL1
	,CODIGO_DEL_DEPARTAMENTO as DPTO_CODI
	,CODIGO_DEL_MUNICIPIO as MUNI_CODI
	,ID_PAIS, ID_CONT 
	from BODEGA_EMPRESAS 
	WHERE 
	(UPPER(SIGLA_DE_LA_EMPRESA) LIKE '%$nombre_essp%' 
	OR UPPER(NOMBRE_DE_LA_EMPRESA) LIKE '%$nombre_essp%') ";
 	//Si incluye ESP desactivas
		if (!isset($_POST['chk_desact']))	$isql.= " and ACTIVA = 1 ";
		if(strlen(trim($no_documento))>0)
		{	$isql.= " and NIT_DE_LA_EMPRESA like '%$no_documento%'"; 
			$isql .= " order by NOMBRE_DE_LA_EMPRESA ";
	   	}
   break;
	} // Fin del Switch que escoge la entidad
  
 
 } 
	if($tbusqueda==6)
  {	$array_nombre = split(" ",$nombre_essp."    ");
  //Query que busca funcionario
	$isql = "select usua_doc AS SGD_CIU_CEDULA
	,usua_nomb as SGD_CIU_NOMBRE
	,'' as SGD_CIU_APELL1
	,USUA_DOC AS SGD_CIU_CODIGO
	,dependencia.depe_nomb as SGD_CIU_DIRECCION
	,USUARIO.USUA_EXT  AS SGD_CIU_TELEFONO
	,USUARIO.USUA_LOGIN as SGD_CIU_APELL2
	,'' as SGD_CIU_APELL1
	,dependencia.ID_CONT
	, dependencia.ID_PAIS
	, dependencia.DPTO_CODI as DPTO_CODI
	,dependencia.MUNI_CODI as MUNI_CODI
	,USUARIO.usua_email as SGD_CIU_EMAIL 
	from USUARIO,dependencia, municipio m
  where USUA_ESTA='1' AND USUARIO.depe_codi = dependencia.depe_codi 
  and dependencia.muni_codi= m.muni_codi
  and dependencia.dpto_codi = m.dpto_codi";
	if($nombre_essp)
  {	if($array_nombre[0]) {$where_split = "  UPPER(USUA_NOMB) LIKE '%". $array_nombre[0] ."%' ";}
	if($array_nombre[1]) {$where_split .= " AND UPPER(USUA_NOMB) LIKE '%". $array_nombre[1] ."%' ";}
	if($array_nombre[2]) {$where_split .= " AND UPPER(USUA_NOMB) LIKE '%". $array_nombre[2] ."%' ";}
	if($array_nombre[3]) {$where_split .= " AND UPPER(USUA_NOMB) LIKE '%". $array_nombre[3] ."%' ";}     	 
	$isql .= " and $where_split ";
	}
	if($no_documento)
	{	if($nombre_eesp) $isql .= " and "; else 	   $isql .= " and ";
		$isql .= " usua_doc='$no_documento' ";
	}
	$isql .= " order by usua_nomb "; 
	}
	//$db->conn->debug = true;
	$rs=$db->query($isql); 
	
	$tipo_emp = $tbusqueda;
	if($rs && !$rs->EOF)
		{	//echo $isql;
		while(!$rs->EOF)
		{	
			($grilla=="timparr") ? $grilla="timparr" : $grilla="tparr";
?>
	<tr class='<?=$grilla ?>'> 
	<TD class="listado5"> <font size="-3"><?=$rs->fields["SGD_CIU_CEDULA"] ?></font></TD>
	<TD class="listado5"> <font size="-3"> <?=substr($rs->fields["SGD_CIU_NOMBRE"],0,120) ?></font></TD>
	<TD class="listado5"> <font size="-3">
	<?=substr($rs->fields["SGD_CIU_APELL1"],0,70) ?></font></TD>
	<TD class="listado5"> <font size="-3"> <?=$rs->fields["SGD_CIU_APELL2"] ?> </font></TD>
	<TD class="listado5"> <font size="-3"> <?=$rs->fields["SGD_CIU_DIRECCION"] ?></font></TD>
	<TD class="listado5"> <font size="-3">
	<?
	$isql2="select MUNI_NOMB from municipio where
	muni_codi='".$rs->fields["MUNI_CODI"]."' and
	dpto_codi='".$rs->fields["DPTO_CODI"]."'";
	$rs2=$db->query($isql2);
	if  (!$rs2->EOF)
	{
		echo $rs2->fields["MUNI_NOMB"];
	}
	?>
	</font></TD>
	<TD class="listado5"> <font size="-3"> <?=trim($rs->fields["SGD_CIU_TELEFONO"]) ?> </font></TD>
	<TD class="listado5"> <font size="-3"> <?=substr($rs->fields["SGD_CIU_EMAIL"],0,30) ?></font></TD>
	<TD width="6%" align="center" valign="top" class="listado5">
	<font size="-3"><a href="#btnpasar" onClick="pasar('<?=$i ?>',1);" class="titulos5">-<?=$label_us?></a></font>
	</TD>
<? 
			if(empty($envio_salida) || $ent==5) { 
?>
	<td width="6%" align="center" valign="top" class="listado5">
		<font size="-3"><a href="#btnpasar" onClick="pasar('<?=$i ?>',2);" class="titulos5">-<?=$label_pred?></a></font>
	</td>
	<?
	if($tbusqueda==1)
	{
	?>
	<td width="7%" align="center" valign="top" class="listado5"><font size="-3">
		<a href="#btnpasar" onClick="pasar('<?=$i ?>',3);" class="titulos5">-<?=$label_emp?></a></font>
	</td>
    <?
    }
   }
?>
  </tr><script>
<?php
	$cc_documento = trim($rs->fields["SGD_CIU_CODIGO"]) . " ";			
	$email = str_replace('"',' ',$rs->fields["SGD_CIU_EMAIL"]) . " ";
	$telefono = str_replace('"',' ',$rs->fields["SGD_CIU_TELEFONO"]) . " ";
	$direccion = str_replace('"',' ',$rs->fields["SGD_CIU_DIRECCION"]) . " ";
	$apell2 = str_replace('"',' ',$rs->fields["SGD_CIU_APELL2"]) . " ";
	$apell1 = str_replace('"',' ',$rs->fields["SGD_CIU_APELL1"]) . " ";
	$nombre = str_replace('"',' ',$rs->fields["SGD_CIU_NOMBRE"]) . " ";
	$codigo = trim($rs->fields["SGD_CIU_CODIGO"]);
		
	$codigo_cont = (isset($rs->fields["ID_CONT"]))? $rs->fields["ID_CONT"] : null;
	$codigo_pais = (isset($rs->fields["ID_PAIS"]))? $rs->fields["ID_PAIS"] : null;
	$codigo_dpto = $codigo_pais."-".$rs->fields["DPTO_CODI"];
	$codigo_muni = $codigo_dpto."-".$rs->fields["MUNI_CODI"];
	$cc_documento = trim($rs->fields["SGD_CIU_CEDULA"]) ;
  $nombre_dependencia = (isset($rs->fields["DEPE_NOMB"]))? $rs->fields["DEPE_NOMB"] : null;
  $nombre_usuario     = (isset($rs->fields["USUA_NOMB"]))? $rs->fields["USUA_NOMB"] : null;
  
  switch( $db->entidad ) {
	case 'SES':
		/** Modificado Supersolidaria 01-Nov-2006
			* Almacena los datos del supervisor de la entidad y el grupo
			* al que pertenece.
			*/

		$supervisor1 = $nombre_dependencia . ' - ' . $nombre_usuario;
		if($supervisor1) $supervisor = $supervisor1;
		break;
	}
		?>
			tipo_emp[<?=$i?>]= "<?=$tbusqueda?>";
			documento[<?=$i?>]= "<?=$codigo?>";
			cc_documento[<?=$i?>]= "<?=$cc_documento?>";
			nombre[<?=$i?>]= "<?=$nombre?>";
			apell1[<?=$i?>]= "<?=$apell1?>";
			apell2[<?=$i?>]= "<?=$apell2?>";
			direccion[<?=$i?>]= "<?=$direccion?>";
			telefono[<?=$i?>]= "<?=$telefono?>";
			mail[<?=$i?>]= "<?=$email?>";
			codigo[<?=$i?>]= "<?=$codigo?>";			 
			codigo_muni[<?=$i?>]= "<?=$codigo_muni?>";
			codigo_dpto[<?=$i?>]= "<?=$codigo_dpto?>";
			codigo_pais[<?=$i?>]= "<?=$codigo_pais?>";
			codigo_cont[<?=$i?>]= "<?=$codigo_cont?>";
<?php
switch ($db->entidad) {
     case 'SES':
     /** Modificado Supersolidaria 01-Nov-2006
       * Almacena los datos del supervisor de la entidad y el grupo
       * al que pertenece.
       */
		$supervisor = $nombre_dependencia . ' - ' . $nombre_usuario;
  ?>
    supervisor[<?=$i?>]= "<?=$supervisor?>";
  <?
    break;
 } ?>
		</script>
<?php
				$i++;
				$rs->MoveNext();
			}
		echo "<span class='listado2'>Registros Encontrados</span>";
	} else {
			echo "<span class='titulosError'>No se encontraron Registros -- $no_documento</span>";
	}
}
  
  if (empty($tipo_emp_us1))
    $tipo_emp_us1 = null;
  
  if (empty($documento_us1))
    $documento_us1 = null;

  if (empty($muni_us1))
    $muni_us1 = null;

  if (empty($codep_us1))
    $codep_us1 = null;
  
  if (empty($idpais1))
    $idpais1 = null;

  if (empty($idcont1))
    $idcont1 = null;

  if (empty($cc_documento_us1))
    $cc_documento_us1 = null;
  
  if (empty($nombre_us1))
    $nombre_us1 = null;

  if (empty($prim_apell_us1))
    $prim_apell_us1 = null;

  if (empty($seg_apell_us1))
    $seg_apell_us1 = null;

  if (empty($direccion_us1))
    $direccion_us1 = null;
  
  if (empty($telefono_us1))
    $telefono_us1 = null;

  if (empty($mail_us1))
    $mail_us1 = null;

  if (empty($tipo_emp_us2))
    $tipo_emp_us2 = null;

  if (empty($documento_us2))
    $documento_us2 = null;

  if (empty($codep_us2))
    $codep_us2 = null;

  if (empty($muni_us2))
    $muni_us2 = null;

  if (empty($idpais2))
    $idpais2 = null;

  if (empty($idcont2))
    $idcont2 = null;

  if (empty($cc_documento_us2))
    $cc_documento_us2 = null;

  if (empty($nombre_us2))
    $nombre_us2 = null;

  if (empty($prim_apell_us2))
    $prim_apell_us2 = null;

  if (empty($seg_apell_us2))
    $seg_apell_us2 = null;

  if (empty($direccion_us2))
    $direccion_us2 = null;

  if (empty($telefono_us2))
    $telefono_us2 = null;

  if (empty($mail_us2))
    $mail_us2 = null;

  if (empty($tipo_emp_us3))
    $tipo_emp_us3 = null;

  if (empty($documento_us3))
    $documento_us3 = null;

  if (empty($codep_us3))
    $codep_us3 = null;

  if (empty($muni_us3))
    $muni_us3 = null;

  if (empty($idpais3))
    $idpais3 = null;

  if (empty($idcont3))
    $idcont3 = null;

  if (empty($cc_documento_us3))
    $cc_documento_us3 = null;

  if (empty($nombre_us3))
    $nombre_us3 = null;

  if (empty($prim_apell_us3))
    $prim_apell_us3 = null;

  if (empty($seg_apell_us3))
    $seg_apell_us3 = null;

  if (empty($direccion_us3))
    $direccion_us3 = null;

  if (empty($telefono_us3))
    $telefono_us3 = null;

  if (empty($mail_us3))
    $mail_us3 = null;
?>
</table>
<br>
<table class="borde_tab" width="100%" cellpadding="0" cellspacing="1">
<tr class="listado2">
	<td colspan="10">
	<center>DATOS A COLOCAR EN LA RADICACION</center>
	</td>
</tr>
<tr align="center">
	<td class="titulos5">USUARIO</td>
	<td class="titulos5">DOCUMENTO</td>
	<td class="titulos5">NOMBRE</td>
	<td class="titulos5">PRIM.<BR>APELLIDO o SIGLA</td>
	<td class="titulos5">SEG.<BR>APELLIDO o REP LEGAL</td>
	<td class="titulos5">DIRECCION</td>
	<td class="titulos5">TELEFONO</td>
	<td class="titulos5">EMAIL</td>
</tr>
<tr class='<?=$grilla ?>'> 
	<td align="center"  class="listado5"><font face="Arial, Helvetica, sans-serif"><?=$nombreTp1?></font></td>
	<TD align="center" class="listado5">
		<input type="hidden" name="tipo_emp_us1" id="tipo_emp_us1" value="<?=$tipo_emp_us1?>" >
		<input type="hidden" name="documento_us1" id="documento_us1" size="3" value="<?=$documento_us1?>" >
		<input type="hidden" name="muni_us1" id="muni_us1" value="<?=$muni_us1 ?>" >
		<input type="hidden" name="codep_us1" id="codep_us1" value="<?=$codep_us1 ?>" >
		<input type="hidden" name="idpais1" id="idpais1" value="<?=$idpais1 ?>" >
		<input type="hidden" name="idcont1" id="idcont1" value="<?=$idcont1 ?>" >
		<input type="text" name="cc_documento_us1" id="cc_documento_us1" value="<?=$cc_documento_us1 ?>" class="ecajasfecha" size="11">
	</TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="nombre_us1" id="nombre_us1" value="<?=$nombre_us1?>" class="ecajasfecha" size="15"> </TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="prim_apell_us1" id="prim_apell_us1" value="<?=$prim_apell_us1 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="seg_apell_us1" id="seg_apell_us1" value="<?=$seg_apell_us1 ?>" class="ecajasfecha" size="12"> </TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="direccion_us1" id="direccion_us1" value="<?=$direccion_us1 ?>" class="ecajasfecha" size="12"> </TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="telefono_us1" id="telefono_us1" value="<?=$telefono_us1 ?>" class="ecajasfecha" size="8"> </TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="mail_us1" id="mail_us1" value="<?=$mail_us1 ?>" class="ecajasfecha" size="14"> </TD>
	
</tr>

<tr class='<?=$grilla ?>'> 
	<td align="center" class="listado5"> 
	<?=$nombreTp2?><BR> o Seg. Not</TD>
	<TD align="center" class="listado5">
	<input type="hidden" name="tipo_emp_us2" id="tipo_emp_us2" value="<?=$tipo_emp_us2?>" > 
	<input type="hidden" name="documento_us2" id="documento_us2" value="<?=$documento_us2?>" >
	<input type="hidden" name="codep_us2" id="codep_us2" value="<?=$codep_us2 ?>" >
	<input type="hidden" name="muni_us2" id="muni_us2" value="<?=$muni_us2 ?>" >
	<input type="hidden" name="idpais2" id="idpais2" value="<?=$idpais2 ?>" >
	<input type="hidden" name="idcont2" id="idcont2" value="<?=$idcont2 ?>" > 
	<input type="text" name="cc_documento_us2" id="cc_documento_us2" value="<?=$cc_documento_us2?>" class="ecajasfecha" size="11" >
	</TD>
	<TD align="center" class="listado5"> 
		<input type="text" name="nombre_us2" id="nombre_us2" value="<?=$nombre_us2 ?>" class="ecajasfecha" size="15"> 
	</TD>
	<TD align="center" class="listado5"> 
	 <input type="text" name="prim_apell_us2"  id="prim_apell_us2" value="<?=$prim_apell_us2 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="seg_apell_us2" id="seg_apell_us2"  value="<?=$seg_apell_us2 ?>" class="ecajasfecha" size="12"> </TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="direccion_us2" id="direccion_us2" value="<?=$direccion_us2 ?>" class="ecajasfecha" size="12"> </TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="telefono_us2" id="telefono_us2" value="<?=$telefono_us2 ?>" class="ecajasfecha" size="8"> </TD>
	<TD align="center" class="listado5"> 
	<input type="text" name="mail_us2" id="mail_us2" value="<?=$mail_us2 ?>" class="ecajasfecha" size="14"> </TD>
</tr>
<tr class='<?=$grilla ?>'> 
<td align="center" class="listado5"><?=$nombreTp3?></td>
	<TD align="center" class="listado5">
	<input type="hidden" name="tipo_emp_us3" id="tipo_emp_us3" value="<?=$tipo_emp_us3?>" > 
	<input type=hidden name=documento_us3 id=documento_us3 class=e_cajas value='<?=$documento_us3?>' >
	<input type=hidden name=codep_us3 id=codep_us3 value='<?=$codep_us3 ?>' class="ecajasfecha">
	<input type=hidden name=muni_us3 id=muni_us3 value='<?=$muni_us3 ?>'  class="ecajasfecha">
	<input type="hidden" name="idpais3" id="idpais3" value="<?=$idpais3 ?>" >
	<input type="hidden" name="idcont3" id="idcont3" value="<?=$idcont3 ?>" >
	<input type=text name=cc_documento_us3 id=cc_documento_us3 value='<?=$cc_documento_us3?>' size=11 class="ecajasfecha">
	</TD>
	<TD align="center" class="listado5"> 
    <input type="text" name="nombre_us3" id="nombre_us3" value="<?=$nombre_us3 ?>" class="ecajasfecha" size="15"> </TD>
	  <TD align="center" class="listado5"><input type="text" name="prim_apell_us3" id="prim_apell_us3" value="<?=$prim_apell_us3 ?>" class="ecajasfecha" size="14"> </TD>
	<TD align="center" class="listado5"><input type="text" name="seg_apell_us3" id="seg_apell_us3" value="<?=$seg_apell_us3 ?>" class="ecajasfecha" size="12"> </TD>
	<TD align="center" class="listado5"><input type="text" name="direccion_us3" id="direccion_us3" value="<?=$direccion_us3 ?>"class="ecajasfecha" size="12"> </TD> 
	<TD align="center" class="listado5"><input type="text" name="telefono_us3" id="telefono_us3" value="<?=$telefono_us3 ?>" class="ecajasfecha" size="8"> </TD>
	<TD align="center" class="listado5"><input type="text" name="mail_us3" id="mail_us3" value="<?=$mail_us3 ?>" class="ecajasfecha" size="14"> </TD>
</tr>
<?php
	$nombre_tt = str_replace('"',' ',$rs->fields["SGD_CIU_NOMBRE"]);
  
  if(empty($fechah))
    $fechah = null;
  
  if(empty($verrad_sal))
    $verrad_sal = null;
?>
<script>
		 nombre[<?=$i ?>]= "<?=$nombre_tt?>"; 
	</script>
  </table>
  <center>
  <?php
    if(isset($envio_salida)) {
	?>
	<input type=submit name=grb_destino value='Grabar el Destino de Este Radicado' class="botones:largo">
	<input type=hidden name=verrad_sal value='<?=$verrad_sal?>'>
  <? 
	} else {
	?>
		<b>
      <a href="javascript:pasar_datos('<?=$fechah?>');" name="btnpasar">
        <span name=btnpasardatos id="btnpasardatos" class="botones_largo" >PASAR DATOS AL FORMULARIO DE RADICACION</span>
      </a>
    </b>
	  <input type=hidden name=verrad_sal value='<?=$verrad_sal?>' >
<?
	}
	?> 
<BR>
<!--
/** Modificado Supersolidaria 01-Nov-2006
	* Campo oculto para almacenar los datos del supervisor de la entidad y el grupo
	* al que pertenece.
	*/
-->
	<?php
//echo "<hr> akiii llego...". $db->conn->entidad;
	switch ($db->entidad){
		case 'SES':
	?> 
	<input type='hidden' name='supervisor_us1' id='supervisor_us1' value='<?=$supervisor?>' >
	<input type='hidden' name='supervisor_us2' id='supervisor_us1' value='<?=$supervisor?>' >
	<input type='hidden' name='supervisor_us3' id='supervisor_us1' value='<?=$supervisor?>' >
<?php
    break;
}
  
  if (empty($no_documento))
    $no_documento = null;
  
  if (empty($nombre_nus1))
    $nombre_nus1 = null;
  
  if (empty($prim_apell_nus1))
    $prim_apell_nus1 = null;
  
  if (empty($seg_apell_nus1))
    $seg_apell_nus1 = null;
  
  if (empty($direccion_nus1))
    $direccion_nus1 = null;
  
  if (empty($telefono_nus1))
    $telefono_nus1 = null;
  
  if (empty($mail_nus1))
    $mail_nus1 = null;
?>
<table class="borde_tab" width="100%" cellpadding="0" cellspacing="1">
<tr align="center" > 
	<td CLASS=titulos5>DOCUMENTO</td>
	<td CLASS=titulos5>NOMBRE</td>
	<td CLASS=titulos5>PRIMER<BR>APELLIDO o Sigla</td>
	<td CLASS=titulos5>SEG.<BR>APELLIDO o REP LEGAL</td>
	<td CLASS=titulos5>DIRECCION</td>
	<td CLASS=titulos5>TELEFONO</td>
	<td CLASS=titulos5>EMAIL</td>
</tr>
	<tr class='listado5' align="center"> 
	<td>
    <input type="text" name="no_documento1" id="no_documento1" value="<?=$no_documento ?>" size="10" class="ecajasfecha">
	</td>
	<td>
	  <input type="text" name="nombre_nus1" id="nombre_nus1" value="<?=$nombre_nus1?>" class="ecajasfecha" size=15></TD>
	<td>
	<input type="text" name="prim_apell_nus1" id="prim_apell_nus1" value="<?=$prim_apell_nus1?>" class="ecajasfecha" size="12"></TD>
	<td>
	<input type="text" name="seg_apell_nus1" id="seg_apell_nus1" value="<?=$seg_apell_nus1?>" class="ecajasfecha" size="8"></TD>
	<td>
	<input type="text" name="direccion_nus1" id="direccion_nus1" value="<?=$direccion_nus1?>" class="ecajasfecha" size="15"></TD>
	<TD>
	<input type="text" name="telefono_nus1" id="telefono_nus1" value="<?=$telefono_nus1?>" class="ecajasfecha" size="7"></TD>
	<TD>
	<input type="text" name="mail_nus1" id="mail_nus1" value="<?=$mail_nus1?>" class="ecajasfecha" size=16>
</TD>
<td>
<input type="text" name="codigo" id="codigo" class="e_cajas" size="1" value='<?=$codigo?>' >
</td>
</tr>
<tr align="center" > 
	<td CLASS=titulos5>Continente</font></td>
	<td CLASS=titulos5>Pa&iacute;s</font></td>
	<td CLASS=titulos5 colspan="2">Dpto / Estado</font></td>
	<td CLASS=titulos5 colspan="2">Municipio</font></td>
	<td colspan="3" rowspan="2" CLASS=grisCCCCCC>
		<select name="tagregar" id="tagregar" class="select">
			<option value='0'>USUARIO(Ciudadano) </option>
			<option value='2'>EMPRESAS </option>
		</select> 
		<input type='SUBMIT' name='modificar' id='modificar' value='MODIFICAR' class="botones" onclick="return verif_data();">
		<input type='SUBMIT' name='agregar' id='agregar' value='AGREGAR' class="botones" onclick="return verif_data();">
	</td>
</tr>
<tr class='celdaGris' align="center"> 
	<TD>
	<?php
		$i = 4;
		
		echo $Rs_Cont->GetMenu2("idcont4",substr($_SESSION['cod_local'],0,1)*1,"$0:&lt;&lt; seleccione &gt;&gt;",false,0," CLASS=\"select\" id=\"idcont4\" onchange=\"cambia(this.form, 'idpais$i', 'idcont$i')\" ");
		$Rs_Cont->Move(0);
		
	?>
	</TD>
	<TD>
	<?php
		if ($_SESSION['cod_local']) 
			$paiscodi = substr($_SESSION['cod_local'],2,3)*1;
		echo "<SELECT NAME=\"idpais4\" ID=\"idpais4\" CLASS=\"select\" onchange=\"cambia(this.form, 'codep_us4', 'idpais4')\">";
		while (!$Rs_pais->EOF)
		{	if ($_SESSION['cod_local'] and ($Rs_pais->fields['ID0'] == substr($_SESSION['cod_local'],0,1)*1))
				
				//Si hay local Y pais pertenece al continente.
				{	($paiscodi == $Rs_pais->fields['ID1'])? $s = " selected='selected'" : $s = "";
					echo "<option".$s." value='".$Rs_pais->fields['ID1']."'>".$Rs_pais->fields['NOMBRE']."</option>";
				}
			$Rs_pais->MoveNext();
		}
		echo "</SELECT>";
		$Rs_pais->Move(0);
	?>
	</TD>
	<TD  colspan="2">
	<?php
		echo "<SELECT NAME=\"codep_us4\" ID=\"codep_us4\" CLASS=\"select\" onchange=\"cambia(this.form, 'muni_us$i', 'codep_us$i')\">";
		while (!$Rs_dpto->EOF)
		{	if ($_SESSION['cod_local'] and ($Rs_dpto->fields['ID0'] == substr($_SESSION['cod_local'],2,3)*1))	//Si hay local Y dpto pertenece al pais.
			{	((substr($_SESSION['cod_local'],2,3)*1)."-".(substr($_SESSION['cod_local'],6,3)*1) == $Rs_dpto->fields['ID1'])? $s = " selected='selected'" : $s = "";
				echo "<option".$s." value='".$Rs_dpto->fields['ID1']."'>".$Rs_dpto->fields['NOMBRE']."</option>";
			}
			$Rs_dpto->MoveNext();
		}
		echo "</SELECT>";
		$Rs_dpto->Move(0);
	?>
	</td>
	<td colspan="2">
	<?php
		echo '<select name="muni_us4" id="muni_us4" class="select">';
		while (!$Rs_mcpo->EOF) {
      //Si hay local Y mcpio pertenece al pais Y dpto.
      if ($_SESSION['cod_local'] and
            ($Rs_mcpo->fields['ID'] == substr($_SESSION['cod_local'],2,3)*1) and
            ($Rs_mcpo->fields['ID0'] == substr($_SESSION['cod_local'],6,3)*1))
			{	((substr($_SESSION['cod_local'],2,3)*1)."-".(substr($_SESSION['cod_local'],10,3)*1) == $Rs_mcpo->fields['ID1'])? $s = " selected='selected'" : $s = "";
				echo "<option".$s." value='".$Rs_mcpo->fields['ID1']."'>".$Rs_mcpo->fields['NOMBRE']."</option>";
			}
			$Rs_mcpo->MoveNext();
		}
		echo "</select>";
		$Rs_mcpo->Move(0);
?> 
        </td>
      </tr>
    </table>
<?php
  if(empty($formulario)) {
    echo '</form>' . "\n";
  }
?>
    <center>
      <input type='button' value='Cerrar' class="botones_largo" onclick='window.close()'>
    </center>
  </body>
</html>
