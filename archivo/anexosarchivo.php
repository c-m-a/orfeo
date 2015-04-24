<?php
   $servicio = "bdprueba";
   $dirora = "/oracle1/product/817";
   $usuario = "fldoc";
   $contrasena= "Fldoc";
   putenv("ORACLE_SID=$servicio");
   putenv("ORACLE_HOME=$dirora");
   $handle = ora_logon("$usuario@$servicio", "$contrasena");
   ora_commiton($handle); 
   if ($sololect)
      $auxsololect="S";
   else
      $auxsololect="N";
   $isql= "select max(anex_numero) from anexos ".
          "where anex_radi_nume=$radi";

   $cursor = ora_open($handle);
   ora_parse($cursor,$isql) or die("No se encontro el radicado Buscado");
   ora_exec($cursor);
   $bien=ora_fetch($cursor);
   $auxnumero=ora_getColumn($cursor,0);
   $auxnumero+=1; 
   $codigo=$radi.str_pad($auxnumero,5,"0",STR_PAD_LEFT);

   if ($bien) {
      $isql= "select anex_tipo_ext from anexos_tipo ".
             "where anex_tipo_codi=$tipo";
      $cursor = ora_open($handle);
      ora_parse($cursor,$isql);
      ora_exec($cursor);
      $bien=ora_fetch($cursor);
      $extension=ora_getColumn($cursor,0);
      $archivo=trim($radi."_".$auxnumero.".".$extension);
	  $archivoconversion=trim("1").trim($radi."_".$auxnumero.".".$extension);
   }

   if ($bien) {

      $isql = "insert into anexos ".
              "(anex_radi_nume,anex_codigo,anex_tipo,anex_tamano,anex_solo_lect,anex_creador,anex_desc,anex_numero,anex_nomb_archivo,anex_borrado) ".
              "values ($radi,$codigo,$tipo,null,'$auxsololect','$usua','$descr',$auxnumero,'$archivoconversion','N') ";
      $bien=ora_do($handle,$isql);
      
   }
   if ($bien){   
      $directorio="./bodega/".substr(trim($archivo),0,4)."/".substr(trim($archivo),4,3)."/docs/"; 
      $bien=move_uploaded_file($userfile,$directorio.trim(strtolower($archivoconversion)));
   }
   if ($bien) 
      $resp1="OK";
   else 
      $resp1="ERROR";


   $params="?usua=$usua&contra=$contra&radi=$radi&resp1=$resp1";
   header("Location:nuevo_archivo.php".$params);
?>
