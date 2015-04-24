<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<link href="../estilos_totales.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
	error_reporting(0);
    session_start();
?>
<center>
<p class="tituloListado"><B>ESTOS DOCUMENTOS HAN SIDO MARCADOS COMO IMPRESOS</B> </p>
<table border=0 width=100 class=t_bordeGris>
<?
   include "../config.php";
   
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
	 $procradi= substr($radicados,3,300);
	 $procard = str_replace(",","</td></tr><tr class=timpar><td ><font size=2><B>",$procradi);
	 $radicados .=",9)";
	 		  $isql = "update PL_GENERADO_PLG set PLT_CODI=3
		           ,PLG_IMPRIME_FECH=SYSDATE		   
		           where RADI_NUME_SAL IN $radicados";
    	  ora_commiton($handle); 
 	      $cursor = ora_open($handle); 
		  ora_parse($cursor,$isql) or die ("No se ha podido Marcar el Radicado");
		  ora_exec($cursor) or die ("No se ha podido Marcar el Radicado");
		  $actualizados = ora_numrows($cursor);
		  $isql = "update ANEXOS set ANEX_ESTADO=3
		           ,ANEX_RADI_FECH=SYSDATE		   
		           where RADI_NUME_SALIDA IN $radicados";
    	  ora_commiton($handle); 
 	      $cursor = ora_open($handle); 
		  ora_parse($cursor,$isql) or die ("No se ha podido Marcar el Radicado");
		  ora_exec($cursor) or die ("No se ha podido Marcar el Radicado");		  
		  $actualizadosa = ora_numrows($cursor);
		  
		  $resultado = "Plantillas $actualizados -- Anexos $actualizadosa"
   ?>
   <tr class="timpar"><td align="center" class="timpar" ><font size=2><B>
   <?=$procard ?></td></tr>
</table>
 <Font size=1 class="tituloListado"><b>Detalle : </b><?=$resultado ?></Font>
</body>
</html>
