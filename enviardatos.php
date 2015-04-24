<?
session_start();
if (!$dependencia or !$nivelus)  include "./rec_session.php";
?>
<html>
<head>
<title>Enviar Datos</title>
<link rel="stylesheet" href="estilos_totales.css">
</head>
<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
<body bgcolor="#FFFFFF" topmargin="0">
<?php
IF($enviardoc=="REALIZAR")
{
   if(!$observa)
   {
      $enviardoc = "";
      echo "<script>alert('Por favor escriba un comentario');</script>";
   }
}
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
 include "config.php";
 					 function devolver_rad($chkd,$krd,$cnivel)
							 {
							     include "config.php";
							 	 ora_commiton($handle);
								 $cursor = ora_open($handle);
								 $isql_hl= "select a.RADI_USU_ANTE,b.USUA_CODI,b.USUA_NOMB,b.DEPE_CODI,a.RADI_DEPE_ACTU,a.RADI_USUA_ACTU,b.CODI_NIVEL
								 				 from radicado a,usuario b
											   where b.USUA_LOGIN (+) =a.RADI_USU_ANTE and a.RADI_NUME_RADI=$chkd";
								 ora_parse($cursor,$isql_hl);
								 ora_exec($cursor);
  							 $result3=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
								 $us_anterior = $row["USUA_CODI"];
								 $us_anterior_nombre = $row["USUA_NOMB"];
								 $dep_anterior = $row["DEPE_CODI"];
								 $codi_nivel = $row["CODI_NIVEL"];
								 IF($cnivel==1) 
								 {
								    $cadenanivel = ",codi_nivle=$codi_nivel;";
								 }else
								 {
								   $cadenanivel = "";
								 }
                 IF (!trim($us_anterior))
                 {
                   $us_anterior = $row["RADI_USUA_ACTU"];
                   $dep_anterior = $row["RADI_DEPE_ACTU"];
                 }
								 $isql_hl= "update radicado 
                 set radi_usua_actu=$us_anterior
                      ,radi_depe_actu=$dep_anterior
                      ,carp_codi=12
                      ,carp_per=0
                      ,radi_usu_ante='$krd'
                      ,radi_fech_agend=null
                      ,radi_agend=null 
                        where RADI_NUME_RADI=$chkd";
									echo $isql_hl;
								 ora_parse($cursor,$isql_hl);
								 ora_exec($cursor);
								 $observa = "Dev.". $observa;
								 $proccarp = "Devolución";
								 $mensaje_dev = "<font color=blue> $us_anterior_nombre (Devuelto)</font></b><BR>";
								 return "$us_anterior_nombre";
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
	 $radicados = "(0";
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
	 $procradi= substr($radicados,3,300);
	 $radicados .=",0)";
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
		<form action='enviardatos.php?<?=session_name()."=".session_id()."&krd=$krd"?>' method=post name=formulario>
		<?
			  if (session_id())
			  {
				if($enviardoc=="REALIZAR"){
				  //Borra documentos Informados
				  if ($enviara==20){
				    $iisql = "delete from informados where radi_nume_radi in $radicados and depe_codi=$dependencia and usua_codi=$codusuario ";
					ora_parse($cursor,$iisql);
					ora_exec($cursor);
				    $observa = "inf.(Borrado) $observa ";
				    $proccarp= "Borrado de Informados";
				  }
				  // Fin de Borrado de Documentos
				  //INicio de Reasignacion de Documento
				  if($enviara!=21)
				   {
				    if ($enviara==9){
						//echo "<center><b>Reasignar a Otra dependencia -> $enviara";
						$proccarp= "Reasignar";
						IF($EnviaraV=="VoBo") $proccarp = "Visto Bueno";
						$carp_codi=0;
						$carp_per = 0;
						if($EnviaraV=="VoBo") { $carp_codi=11; $observa = "VoBo. $observa"; }
						$isql = "update radicado set RADI_USU_ANTE='$krd', RADI_DEPE_ACTU=$depsel,
										RADI_USUA_ACTU=$codus,CARP_CODI=$carp_codi $cadenanivel,
										CARP_PER=$carp_per,RADI_LEIDO=0
										, radi_fech_agend=null,radi_agend=null 
										 where radi_depe_actu=$dependencia
										and RADI_NUME_RADI in$radicados";
						}else{
							//echo "<center><b>Enviar a otra carpeta ";
							if($enviara!=20){
							if($enviara!=8){
							if($reasignarnivel){$cadenanivel=",CODI_NIVEL=$nivus,flag_nivel=0";}else{$cadenanivel=""; }
							$proccarp= "Cambio de Carpeta. ";
					    	if($enviara==10){
							           $enviara="$carpper, carp_per=1";
									   $proccarp= "Cambiar a Carpeta (Personal)";
									   $observa="Cambio Carpeta. $observa";
							      }else{
								  	$enviara="$enviara, carp_per=0";
									   If ($enviara==11){$observa="VoBo. $observa";}
								}
								if($reasignarnivel){$cadenanivel=",CODI_NIVEL=$nivelus,flag_nivel=0";}else{$cadenanivel=""; }
									$isql = "update radicado
														set RADI_USU_ANTE='$krd',
															CARP_CODI=$enviara,
															radi_fech_agend=null,
															radi_agend=null
															$cadenanivel
														where radi_depe_actu=$dependencia 
															and RADI_NUME_RADI in$radicados
									";
							  }else{
							   $informar=3;$observa ="Inf. $observa";$proccarp= "Informar (Enviar Copia)";
							  }
							}
						}
						$observa = substr($observa,0,400). " ";
						ora_parse($cursor,$isql);
						ora_exec($cursor);
						$formatfecha = "'". date('d-m-Y H:i:s')."' ,'dd-mm-yyyy hh24:mi:ss'";
					}
					if($reasignarnivel) $cnivel = 1; else $cnivel = 0;
  					if($chk1)
						{
							 if($enviara==21){$us_ant_nombre = "<br>($chk1)" . devolver_rad($chk1,$krd,$cnivel); }
		 				     $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk1,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);
							 if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk1,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);
							 }

						}
  					if($chk2)
						{
							if($enviara==21){$us_ant_nombre .= "<br>($chk2)".devolver_rad($chk2,$krd,$cnivel);}
						     $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk2,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

  		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk2,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}
						}
  					if($chk3)
						{
							if($enviara==21){$us_ant_nombre .= "<br>($chk3)".devolver_rad($chk3,$krd,$cnivel);}
						     $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk3,'$observa',$codusdp,'$usua_doc')";

							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

  		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk3,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}
						}
  					if($chk4)
						{
							if($enviara==21){$us_ant_nombre .= "<br>($chk4)".devolver_rad($chk4,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk4,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

   		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk4,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk5)
						{
						   if($enviara==21){$us_ant_nombre .= "<br>($chk5)".devolver_rad($chk5,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk5,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

  		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk5,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk6)
						{
							if($enviara==21){$us_ant_nombre .= "<br>($chk6)".devolver_rad($chk6,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk6,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

  		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk6,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk7)
						{
						   if($enviara==21){$us_ant_nombre .= "<br>($chk7)".devolver_rad($chk7,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk7,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);
  		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk7,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}


						}
  					if($chk8)
						{
						   if($enviara==21){$us_ant_nombre .= "<br>($chk8)".devolver_rad($chk8,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk8,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);
  		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk8,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}


						}
  					if($chk9)
						{
						   if($enviara==21){$us_ant_nombre .= "<br>($chk9)".devolver_rad($chk9,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk9,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);
  		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk9,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk10)
						{
						if($enviara==21){$us_ant_nombre .= "<br>($chk10)".devolver_rad($chk10,$krd,$cnivel);	}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk10,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

  		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk10,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk11)
						{
						  if($enviara==21){$us_ant_nombre .= "<br>($chk11)".devolver_rad($chk11,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk11,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

							   		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk11,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk12)
						{
						if($enviara==21){$us_ant_nombre .= "<br>($chk12)".devolver_rad($chk12,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk12,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

							   		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk12,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk13)
						{
						 if($enviara==21){$us_ant_nombre .= "<br>($chk13)".devolver_rad($chk13,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk13,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

							   		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk13,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}

  					if($chk14)
						{
						if($enviara==21){$us_ant_nombre .= "<br>($chk14)".devolver_rad($chk14,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk14,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

							   		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk14,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk15)
						{
						  if($enviara==21){$us_ant_nombre .= "<br>($chk15)".devolver_rad($chk15,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk15,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

							   		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk15,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk16)
						{
						  if($enviara==21){$us_ant_nombre .= "<br>($chk16)".devolver_rad($chk16,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk16,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

							   		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk16,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk17)
						{
						  if($enviara==21){$us_ant_nombre .= "<br>($chk17)".devolver_rad($chk17,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date($formatfecha) ,$codusuario,$chk17,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

							 if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk17,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk18)
						{
						  if($enviara==21){ $us_ant_nombre .= "<br>($chk18)".devolver_rad($chk18,$krd,$cnivel); }
						     $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk18,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);

							   		 				     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk18,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk19)
						{
						   if($enviara==21){$us_ant_nombre .= "<br>($chk19)".devolver_rad($chk19,$krd,$cnivel);}
						     $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk19,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);
							 if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk19,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

						}
  					if($chk20)
						{
						  if($enviara==21){$us_ant_nombre .= "<br>($chk20)".devolver_rad($chk20,$krd,$cnivel);}
						   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST,USUA_DOC) values ($dependencia, to_date ($formatfecha) ,$codusuario,$chk20,'$observa',$codusdp,'$usua_doc')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);
						     if($enviara==8){
							 $isql_hl= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) values ($depsel, to_date ($formatfecha) ,$codus,$chk20,'$observa')";
							 ora_parse($cursor,$isql_hl);
							 ora_exec($cursor);}

					  }
				  ?><br>
        <span class="tituloListado">ACCION REQUERIDA COMPLETADA</span> <?
				  $nomostrar = "jhlc";
				}
	//echo "Accion a realizar $enviara " ;
	  $iusuario = " and us_usuario='$krd'";
     $isql = "select a.*,b.trte_desc from radicado a,tipo_remitente b where a.trte_codi  =b.trte_codi (+) and a.RADI_NUME_RADI in$radicados";

	  //echo $isql;
		//$isql ="select * from radicado_rd a , tipo_remitente b where rd_estado=5 $iusuario ";
   // $result1 = ora_do($handle,$isql);
	 	 	 ?>
			 <input type='hidden' name=depsel value='<?=$depsel ?>'>
			 <input type=hidden name=enviara value='<?=$enviara ?>'>
			 <input type=hidden name=EnviaraV value='<?=$EnviaraV ?>'>
        <table BORDER=0 WIDTH=98% cellspace=1 align="center" class="t_bordeGris">
          <TR>
            <TD width=30% class="grisCCCCCC"><span class='etextomenu'>USUARIO</span><br>
              <span class='etextou'><?=$row["USUA_LOGIN"] ?></span> </TD>
            <TD  width='30%' class="grisCCCCCC"><span class='etextomenu'> DEPENDENCIA</span><br>
               <span class=etextou><?=$row["DEPE_NOMB"] ?></span><br></TD>


	        <td class="grisCCCCCC"> <?
	if ($enviara==9 or $enviara==8)
	{
			$isqlusr = "select USUA_NOMB,USUA_CODI,USUA_LOGIN,CODI_NIVEL
									from usuario
									where
										 USUA_ESTA=1 AND depe_codi=$depsel ";
			$msg = "";
		if($EnviaraV) { $isqlusr .= " and usua_codi=1 "; $msg = " PARA $EnviaraV ";}
		//$isqlusr = "select USUA_NOMB,USUA_CODI,USUA_LOGIN,CODI_NIVEL from usuario where depe_codi=$depsel and usua_codi=$codus";
		$isqlusr .= " ORDER BY USUA_NOMB ";
		ora_parse($cursor,$isqlusr);
		ora_exec($cursor);
		$numerot = ora_numrows($cursor);$row1 = array();
		$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	if($nomostrar!="jhlc")
	 {
			?>
			<span class=etextomenu> ENVIAR A USUARIO <?=$msg?></span><BR>
			<select name=codus class=e_buttons> <?
	DO
		{
				$usuanomb = ora_getcolumn($cursor, 0);
				$usuacodif = ora_getcolumn($cursor, 1) ;
				$usuacodi = ora_getcolumn($cursor, 3) . ora_getcolumn($cursor, 1);
				//echo "$dependenci==$depsel==$u";
			if($depsel==$dependencia or $usuacodif==1 or $enviara==8){
				if($depsel==$dependencia and $usuacodif==$codus)
					{$datoss = " Selected ";$procusfin=$usuanomb;}else {$datoss = " ";		}
    				?><option value='<?=$usuacodi ?>' '<?=$datoss ?>'><?=$usuanomb ?></option>
					<?
				}
	  }while($result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
     ?></select><?
	 }else
	 {// si es un devuelto solo busca el usuario anterior
 		  
	 }
		}
		else
		{
			if($enviara!=20 and $enviara!=8 and $enviara!=21)
			{
				echo "Cambio de Carpeta";
			}elseif($enviara==21)
			{
				echo "$devolver";
				echo "Devolver a Usuario Anterior";
			}
		}
		?></td><?
// AKI empieza a realiza el traslado dle doc.
	IF($enviardoc!="REALIZAR"){
  ?>
		<td width='5' class="grisCCCCCC">
			<input type=submit value=REALIZAR name=enviardoc align=bottom class=e_buttons id=REALIZAR>
		</td></TR>

	<tr align="center">
		<td colspan="4" class="celdaGris">
			<span class="etextomenu">
			<input type=checkbox name=reasignarnivel value=si checked=checked  >
			Deseo que los documentos a enviar tomen el nivel automaticamente
			del usuario destino. (De lo contrario el nivel que tiene actualmente
			el documento se conservará) <br>
			<br>
			Se van a Mover estos datos. Desea colocar un
			Comentario? </span><br>
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
			N&uacute;mero Radicado</a> </th>

            <th  width=10% height="30"> <a href='<?=$ref ?>radi_fech_radi' alt=Seleccione una busqueda><img src='iconos/<?=$imagen ?>' border=0 alt='<?=$data ?>'><span class="textoOpcion">
			Fecha Radicado</span></a></th>
            <th  width=30% height="30" > <a href='<?=$ref ?>ra_asun'  alt='eleccione una busqueda'><img src='iconos/<?=$imagen ?>' border=0 alt='<?=$data ?>'><span class="textoOpcion">
			Asunto</span></a>
            </th>
            <th  width=15% height="30"> <a href='<?=$ref ?>trte_codi'  alt='Seleccione una busqueda'><img src='iconos/<?=$imagen ?>' border=0 alt='<?=$data ?>'><span class="textoOpcion">
			Tipo de Remitente</span></a></th>
            <th  width=15% class="textoOpcion" height="30">
			Nombre</th>
            <th  width=5% class="textoOpcion" height="30">
			Marcar</th>
	     </tr>
 <?
   while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	 { $row1 = array();
       //$data = trim(ora_getcolumn($cursor, 1));
		 $data = trim($row["RADI_NUME_RADI"]);
		 $numdata =  trim($row["CARP_CODI"]);
          if($data =="") $data = "NULL";
			 //$numerot = ora_numrows($cursor2);
			 $numerot = $row1["num"];
			 if($carpeta==$numdata){$imagen="usuarios.gif";}else{$imagen="usuarios.gif";}
			 $ref = "datosrad.php?radicado=".$row["RADI_NUME_RADI"]."&carpeta=$carpeta&contra=$drde&usua=".md5($krd)."&drde=$drde&krd=$krd";
			 $fecha_rad =  $row["RADI_FECH_RADI"];
			 $nombre = $row["RADI_PRIM_APEL"] . " ". $row["RADI_SEGU_APEL"]." ". $row["RADI_NOMB"];
         ?>

  <tr class='etexto2'>
    <td class="celdaGris" > <a href='<?=$ref ?>' ><img src='iconos/<?=$imagen ?>' border=0 alt='<?=$data ?>'><font size=1><?=$data ?></font></a>
      <br>
 </td>
    <td class="celdaGris"><?=$fecha_rad ?></td>
    <td class="celdaGris"><?=$row["RA_ASUN"] ?></td>
    <td class="celdaGris"><?=$row["TRTE_DESC"] ?></td>
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
	 {   $procard = str_replace(",","<br>",$procradi);
	    ?>
		<p class=etexto>
        <p class=etexto> <span class="etextomenu">ACCION REQUERIDA :</span> <font color=blue>
          <?
		  if($enviara==21) {echo "Devoluci&oacute;n";} else {echo "$proccarp";}
		  ?> </font></p>
		<p class=etexto><span class="etextomenu"><br>RADICADOS INVOLUCRADOS :</span><br>
           <font color=blue><?=$procard ?></font></p>
		<?
		if ($depsel==999) $codus =1;
		$iisql = "select USUA_NOMB from usuario where depe_codi=$depsel and usua_codi=$codus ORDER BY USUA_NOMB ";
        if($enviara != 20){
  	    ora_parse($cursor,$iisql);
      	ora_exec($cursor);
        $numerot = ora_numrows($cursor);$row1 = array();
		$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
        $usuanomb = ora_getcolumn($cursor, 0);
		//$usuacodif = ora_getcolumn($cursor, 1) ;

	    ?>
        <p class=etexto><span class="etextomenu">USUARIO DESTINO :</span> <font color=blue>
		<?
		   if($enviara==21) echo "$us_ant_nombre "; else echo $usuanomb;
		?></font></p>
        <?
		}
		$fecha = Date("Y-m-d") . "  " .  Date("H:m:s");
		?>
        <p class=etexto><span class="etextomenu">FECHA Y HORA :</span> <font color=blue><?=$fecha ?></font></p>
        <span class="etextomenu">ORIGEN :</span> <?
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
			}Else {
			   ?><center><b>
    <span class=eerrores>NO TIENE AUTORIZACION PARA INGRESAR</span><BR><span class='eerrores'>
    <a href='login.php' target=_parent>Por Favor intente validarse de nuevo. Presione
    aca!</a>
    <? }
		?>
    &nbsp; </body>
</html>
