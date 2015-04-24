<?
session_start();
$ruta_raiz="..";
if (!$dependencia)  include "../rec_session.php";
?>
<html>
<head>
<title>Enviar Datos</title>
<link rel="stylesheet" href="../estilos_totales.css">
</head>
<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
<body bgcolor="#FFFFFF" topmargin="0">
<?php
$formatfecha = "'". date('d-m-Y H:i:s')."' ,'dd-mm-yyyy hh24:mi:ss'";
if($EnviaraV=="VoBo" and $codusuario==1)
   {
      $depsel = $depe_codi_padre;
   }
if($EnviaraV=="VoBo" and $codusuario!=1)
   {
      $depsel = $dependencia;
   }
if($carpper==10001 and $enviara ==10 ){$enviara=1;}
if($carpper==10002 and $enviara ==10){$enviara=6;}
 $proc="";

 $procusfin="";
 $procusini="";
 $proccarp= "";
 $procradi= "";
  if($enviara==20 AND !$enviardoc)
  {
    ?>
<center>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="t_bordeGris">
    <tr align="center">
      <td class="tituloListado" height="25">!! CUIDADO !! LOS RADICADOS INFORMADOS
        SELECCIONADOS SE BORRARAN </td>
    </tr>
  </table>
</center>
<?
  }
 if($enviara==8 and $depsel8){
    $depsel=$depsel8;
 }
 IF($enviara==11) $depsel = $depe_codi_padre;
 include "../config.php";
function devolver_rad($chkd,$krd)
{
  include "../config.php";
	ora_commiton($handle);
	$cursor = ora_open($handle);
	$isql_hl= "select a.RADI_USU_ANTE,b.USUA_CODI,b.USUA_NOMB,b.DEPE_CODI from radicado a,usuario b
				where b.USUA_LOGIN=a.RADI_USU_ANTE and a.RADI_NUME_RADI=$chkd";
	ora_parse($cursor,$isql_hl);
	ora_exec($cursor);
	$result3=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	$us_anterior = $row["USUA_CODI"];
	$us_anterior_nombre = $row["USUA_NOMB"];
	$dep_anterior = $row["DEPE_CODI"];
	$isql_hl= "update radicado set radi_usua_actu=$us_anterior
			,radi_depe_actu=$dep_anterior
					,carp_codi=12
					,carp_per=0
					,radi_usu_ante='$krd'
	where RADI_NUME_RADI=$chkd";
	ora_parse($cursor,$isql_hl);
	ora_exec($cursor);
	$observa = "Dev.". $observa;
	$proccarp = "Devolución";
	$mensaje_dev = " (Recuperado el rad $chkd a  $us_anterior_nombre)";
	return "$mensaje_dev";
}
 ora_commiton($handle);

	$nivus="";


	$cursor = ora_open($handle);
	$check=1;
   $numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
   ?>

<table border=0 width=100% cellpadding="0" cellspacing="0">
  <tr ><td width=100%>
	 <br>
      <?
if(!$radicados_dev)
{
	$num = count($check_value);
	$i = 0;
	while ($i < $num)
	{
	   $record_id = key($check_value);
	   if ($check_value[$record_id] == "devolver") {
		$radicados_dev .= $record_id .",";
		$radicado_mat = split("-",$record_id,2);
		$radicados .= $radicado_mat[0].",";
	   }
	next($check_value);
	$i++;
	}
	$radicados_dev = str_replace("-","",$radicados_dev);
	$radicados_dev .= "999999999999999";
	$radicados .= "999999999999999";
}
        echo "<input type=hidden name=radicados_dev value='$radicados_dev'>";
	echo "<input type=hidden name=radicados value='$radicados'>";
	 $isql = "select a.USUA_LOGIN,a.USUA_PASW,a.USUA_CODI,a.DEPE_CODI,b.depe_nomb
	           from usuario a,dependencia b
	           where USUA_LOGIN ='$krd' and a.depe_codi=b.depe_codi ";
	 $resultado = ora_parse($cursor,$isql);
	 $resultado = ora_exec($cursor);
	 $row=array();
   ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
   //echo $row["usuario"].$krd;

	 if (trim($row["USUA_LOGIN"])==trim($krd))
		{

		$dependencia=$row["DEPE_CODI"];
		$codusuario =$row["USUA_CODI"];
		$contraxx=$row["USUA_PASW"];
		$nivelus=$row["CODI_NIVEL"];
	IF($codus)
	{
	  $nivus=substr($codus,0,1);
	  $codus=substr($codus,1,3);

	}else{$codus=$codusuario;}
if($enviara==11)
  {
    $codus=1;
    $carpertasal="Para Salida. ";
  }
   else
  {
    $carpetasal="";
  }
  if($salida)
  {

     $enviara="9";
	 $depsel = "999";
	 $enviardoc=="REALIZAR";
	 $codus="1";
	 $observa = "Salida. ->$observa";
	 ?> <span class='tituloListado'> Los Email seran enviados a Salida</span><br>
	 <?

  }
        if(!$nivus){$nivus=1;}
		if($reasignarnivel){$cadenanivel=",CODI_NIVEL=$nivus,flag_nivel=0";}else{$cadenanivel=""; }
		if ($codus)
    	 {$codusdp = str_pad($depsel, 3, "0", STR_PAD_LEFT).str_pad($codus, 3, "0", STR_PAD_LEFT);}
		 else{$codusdp = str_pad($depsel, 3, "0", STR_PAD_LEFT).str_pad($codusuario, 3, "0", STR_PAD_LEFT);}
		?>
		<form action='devolucion_otras.php?<?=session_name()."=".session_id()."&krd=$krd"?>' method=post>
		<input type=hidden name=radicados_dev value='<?=$radicados_dev?>'>
		<input type=hidden name=radicados value='<?=$radicados?>'>
	<?
		error_reporting(7);
	if (session_id())
	{
	if($enviardoc=="REALIZAR"){
		//Borra documentos Informados
		$isql = "update sgd_renv_regenvio
				set
					sgd_renv_estado=9
			where concat(radi_nume_sal,sgd_renv_codigo) in($radicados_dev)";
		ora_parse($cursor,$isql);
		ora_exec($cursor);
		// Fin de Borrado de Documentos
		//INicio de Reasignacion de Documento
    if($rad_recuperar)
    {
       $observa = devolver_rad($rad_recuperar,$krd) . " - " . $observa;
    }
		$proccarp= "Cerrado el Envio.";
		$observa = $proccarp ." - ". $observa;
    $proccarp = $observa;
if($chk1)
	{
	if($enviara==21){$us_ant_nombre = "<br>($chk1)" . devolver_rad($chk1,$krd); }
	$isql_hl= "insert into
	hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
	values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk1,'$observa',$codusdp,'$usua_doc','8')";
		ora_parse($cursor,$isql_hl);
		ora_exec($cursor);
    if($rad_recuperar)
     {
        $isql_hl= "insert into
        hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
        values ($dependencia, to_date ($formatfecha) ,$codusuario,$rad_recuperar,'$observa',$codusdp,'$usua_doc','8')";
        ora_parse($cursor,$isql_hl);
        ora_exec($cursor);
     }    
	}
if($chk2)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk2)".devolver_rad($chk2,$krd);}
	$isql_hl= "insert into
	hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
	values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk2,'$observa',$codusdp,'$usua_doc','8')";
		ora_parse($cursor,$isql_hl);
		ora_exec($cursor);

	}
if($chk3)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk3)".devolver_rad($chk3,$krd);}
	$isql_hl= "insert into
	hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
	values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk3,'$observa',$codusdp,'$usua_doc','8')";

		ora_parse($cursor,$isql_hl);
		ora_exec($cursor);

	}
if($chk4)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk4)".devolver_rad($chk4,$krd);}
	$isql_hl= "insert into
	hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
	values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk4,'$observa',$codusdp,'$usua_doc','8')";
		ora_parse($cursor,$isql_hl);
		ora_exec($cursor);

	}
if($chk5)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk5)".devolver_rad($chk5,$krd);}
	$isql_hl= "insert into
	hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
	values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk5,'$observa',$codusdp,'$usua_doc','8')";
		ora_parse($cursor,$isql_hl);
		ora_exec($cursor);
	}
if($chk6)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk6)".devolver_rad($chk6,$krd);}
	$isql_hl= "insert into
	hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO) 
	values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk6,'$observa',$codusdp,'$usua_doc','8')";
		ora_parse($cursor,$isql_hl);
		ora_exec($cursor);
	}
if($chk7)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk7)".devolver_rad($chk7,$krd);}
	$isql_hl= "insert into
	hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
	values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk7,'$observa',$codusdp,'$usua_doc','8')";
		ora_parse($cursor,$isql_hl);
		ora_exec($cursor);
	}
if($chk8)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk8)".devolver_rad($chk8,$krd);}
	$isql_hl= "insert into
	hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
	values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk8,'$observa',$codusdp,'$usua_doc','8')";
		ora_parse($cursor,$isql_hl);
		ora_exec($cursor);
	}
if($chk9)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk9)".devolver_rad($chk9,$krd);}
	$isql_hl= "insert into
	hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO) 
	values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk9,'$observa',$codusdp,'$usua_doc','8')";
	ora_parse($cursor,$isql_hl);
	ora_exec($cursor);
	}
if($chk10)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk10)".devolver_rad($chk10,$krd);	}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk10,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
if($chk11)
	{
		if($enviara==21){$us_ant_nombre .= "<br>($chk11)".devolver_rad($chk11,$krd);}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk11,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
if($chk12)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk12)".devolver_rad($chk12,$krd);}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk12,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
if($chk13)
	{
		if($enviara==21){$us_ant_nombre .= "<br>($chk13)".devolver_rad($chk13,$krd);}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk13,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}

if($chk14)
	{
	if($enviara==21){$us_ant_nombre .= "<br>($chk14)".devolver_rad($chk14,$krd);}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk14,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
if($chk15)
	{
		if($enviara==21){$us_ant_nombre .= "<br>($chk15)".devolver_rad($chk15,$krd);}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk15,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
if($chk16)
	{
		if($enviara==21){$us_ant_nombre .= "<br>($chk16)".devolver_rad($chk16,$krd);}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
		 values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk16,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
if($chk17)
	{
		if($enviara==21){$us_ant_nombre .= "<br>($chk17)".devolver_rad($chk17,$krd);}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
		values ($dependencia, to_date($formatfecha) ,$codusuario,$chk17,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
if($chk18)
	{
		if($enviara==21){ $us_ant_nombre .= "<br>($chk18)".devolver_rad($chk18,$krd); }
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk18,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
if($chk19)
	{
		if($enviara==21){$us_ant_nombre .= "<br>($chk19)".devolver_rad($chk19,$krd);}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
		values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk19,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
if($chk20)
	{
		if($enviara==21){$us_ant_nombre .= "<br>($chk20)".devolver_rad($chk20,$krd);}
		$isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC,SGD_TTR_CODIGO)
		values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk20,'$observa',$codusdp,'$usua_doc','8')";
			ora_parse($cursor,$isql_hl);
			ora_exec($cursor);
	}
?><br>
<span class="tituloListado">ACCION REQUERIDA COMPLETADA</span>
<?
	$nomostrar = "jhlc";
	}
	//echo "Accion a realizar $enviara " ;
	  $iusuario = " and us_usuario='$krd'";
     $isql = "select a.* from SGD_RENV_REGENVIO a 
             where 
     		 concat(radi_nume_sal,sgd_renv_codigo) in($radicados_dev)";
?>
<input type='hidden' name=depsel value='<?=$depsel ?>'>
<input type=hidden name=rad_recuperar value='<?=$rad_recuperar?>'>
<input type=hidden name=enviara value='<?=$enviara ?>'>
<input type=hidden name=EnviaraV value='<?=$EnviaraV ?>'>
        <table BORDER=0 WIDTH=98% cellspace=1 align="center" class="t_bordeGris">
          <TR>
            <TD width=30% class="grisCCCCCC"><span class='etextomenu'>USUARIO</span><br>
              <span class='etextou'><?=$row["USUA_LOGIN"] ?></span> </TD>
            <TD  width='30%' class="grisCCCCCC"><span class='etextomenu'> DEPENDENCIA</span><br>
               <span class=etextou><?=$row["DEPE_NOMB"] ?></span><br></TD>


	        <td class="grisCCCCCC">Archivar Envio
  <?
     if($rad_recuperar)
     {
        echo "<br>Se devolvera de la dependencia de Salida el Radicado ($rad_recuperar)";
     }
     ?></td>
     <?
// AKI empieza a realiza el traslado dle doc.
	IF($enviardoc!="REALIZAR"){
  ?>
            <td width='5' class="grisCCCCCC">
              <input type=submit value=REALIZAR name=enviardoc align=bottom class=e_buttons>
            </td></TR>

          <tr align="center">
            <td colspan="4" class="celdaGris">
              <span class="etextomenu">
  <textarea name=observa cols=70 rows=3 class=ecajasfecha></textarea>
  <input type=hidden name=enviar value=enviarsi>
  <input type=hidden name=enviara value='<?=$enviara ?>'>
  <input type=hidden name=depsel value=$depsel>
  <input type=hidden name=EnviaraV value='<?=$EnviaraV?>'>
  <?
	}
	ora_parse($cursor,$isql);
	ora_exec($cursor);
	$numerot = ora_numrows($cursor);
	$imagen="img_flecha_sort.gif";
	$row = array();
     if ($nomostrar!="jhlc"){
		 echo "<input type=hidden name=carpeta value=$carpeta>";
		 echo "<input type=hidden name=carpper value=$carpper>";
		 $ref = "cuerpo.php?carpeta=$carpeta&usua=$krde&order=";
		 ?>

	</td></tr>
	</TABLE>
	<br>
<table border=0 cellspace=1 cellpad=2 WIDTH=98% class="t_bordeGris" align="center">
<tr bgcolor=#6699cc class=grisCCCCCC align=middle>
<th width=10% height="30"> <a href='<?=$ref ?>radi_nume_radi'  alt=Seleccione una busqueda class="textoOpcion">
		Número Radicado</a> </th>
<th  width=10% height="30"> <a href='<?=$ref ?>radi_fech_radi' alt=Seleccione una busqueda><img src='iconos/<?=$imagen ?>' border=0 alt='<?=$data ?>'><span class="textoOpcion">
		Fecha Radicado</span></a></th>
<th  width=30% height="30" > <a href='<?=$ref ?>ra_asun'  alt='eleccione una busqueda'><img src='iconos/<?=$imagen ?>' border=0 alt='<?=$data ?>'><span class="textoOpcion">
		Observaciones</span></a>
</th>
<th  width=15% class="textoOpcion" height="30">
		Nombre</th>
<th  width=5% class="textoOpcion" height="30">
		Marcar</th>
	</tr>
 <?
   while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	 { $row1 = array();
       //$data = trim(ora_getcolumn($cursor, 1));
	$data = trim($row["RADI_NUME_SAL"]);
	$numdata =  trim($row["CARP_CODI"]);
         if($data =="") $data = "NULL";
	//$numerot = ora_numrows($cursor2);
	$numerot = $row1["num"];
	if($carpeta==$numdata){$imagen="usuarios.gif";}else{$imagen="usuarios.gif";}
	$ref = "datosrad.php?radicado=".$row["RADI_NUME_RADI"]."&carpeta=$carpeta&contra=$drde&usua=".md5($krd)."&drde=$drde&krd=$krd";
	$fecha_rad =  $row["SGD_DEVE_FECH"];
	$nombre = $row["SGD_RENV_NOMBRE"];
         ?>

  <tr class='etexto2'>
    <td class="celdaGris" > <a href='<?=$ref ?>' ><font size=1>
    <?=$data ?></font></a>
      </td>
    <td class="celdaGris"><?=$fecha_rad ?></td>
    <td class="celdaGris"><?=$row["SGD_RENV_OBSERVA"] ?></td>
    <td class="celdaGris"><?=$nombre ?> </td>
		<?
			 if($check<=20){
		?>

    <td class="celdaGris">
      <input type=checkbox value='<?=$data ?>' name='chk<?=$check ?>' checked=checked class="ecajasfecha">
    </td>
		<?
			 $check=$check+1;
			 }
		?>
			 </tr>
		<?
     }
    ?></table>
	<input type=hidden name=depsel value='<?=$depsel ?>'>
	      </form>
	<?
   }else
	 {
	     $procard = str_replace("999999999999999","",$radicados);
	     $procard = str_replace(",","<br>",$procard);
	    ?>
		<p class=etexto>
        <p class=etexto> <span class="etextomenu">ACCION REQUERIDA :</span> <br><font color=blue>
          <?
		  if($enviara==21) {echo "Devolución";} else {echo "$proccarp";}
		  ?> </font></p>
		<p class=etexto><span class="etextomenu"><br>RADICADOS INVOLUCRADOS :</span><br>
           <font color=blue><?=$procard ?></font></p>
        <?
		$fecha = Date("Y-m-d") . "  " .  Date("H:m:s");
		?>
        <p class=etexto><span class="etextomenu">FECHA Y HORA :</span> <font color=blue><?=$fecha ?></font></p>
        <span class="etextomenu">ORIGEN :</span> <?
		}
	 }
	 ?>

 <?
	  $row = array();
 		}Else {
?><BR><BR><BR><center><b><span  class=eerrores>
. . . NO TIENE AUTORIZACION PARA INGRESAR!</span><BR><span class=eerrores>
    <a href=login.php target=_parent>Por Favor intente validarse de nuevo. Presione
    aca!</a>
    <?
					   }
?>
    &nbsp; </body>
</html>
