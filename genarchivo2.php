<?php
  session_start();
  if (!$ruta_raiz) $ruta_raiz = ".";   
   include("$ruta_raiz/config.php");
  if (!$dependencia or !$depe_codi_territorial or !$krd or !$dependencianomb or !$depe_municipio)  include "$ruta_raiz/rec_session.php";
  if (!$db)
  $db = new ConnectionHandler("."); 
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $db->conn->StartTrans();
   
  require_once("$ruta_raiz/class_control/anexo.php");

  require_once("$ruta_raiz/class_control/Dependencia.php");
  require_once("$ruta_raiz/class_control/Esp.php");
  require_once("$ruta_raiz/class_control/TipoDocumento.php");
  require_once("$ruta_raiz/class_control/Radicado.php");

  $dep = new Dependencia($db);
  $espObjeto = new Esp($db);
  $radObjeto = new Radicado($db);
  $radObjeto->radicado_codigo($numrad);
  
  //objeto que maneja el tipo de documento del anexos
  $tdoc = new TipoDocumento($db);
  
  //objeto que maneja el tipo de documento del radicado
  $tdoc2 = new TipoDocumento($db);
  $tdoc2->TipoDocumento_codigo($radObjeto->getTdocCodi());
  $fecha_dia_hoy = Date("Y-m-d");
  $sqlFechaHoy=$db->conn->DBDate($fecha_dia_hoy);

  $dep->Dependencia_codigo($dependencia);
  $dependencianomb = $dep->getDepe_nomb();
  $dep_sigla = $dep->getDepeSigla();
  $dep_dir = $dep->getDepeDir();
  $nurad = trim($nurad);
  $numrad = trim($numrad);
  $hora=date("H")."_".date("i")."_".date("s");
  
  $ddate = date('d');
  $mdate=date('m');
  $adate = date('Y');
  $fechaArchivo = $adate."_".$mdate."_".$ddate;
  $archInsumo = "tmp_".$usua_doc."_".$fechaArchivo."_".$hora.".txt";
  $terr_ciu_nomb = $dep->getTerrCiuNomb();
  
  //Var que almacena el nombre corto de la territorial
  $terr_sigla = $dep->getTerrSigla();
  //Var que almacena la direccion de la territorial
  $terr_direccion = $dep->getTerrDireccion();
  //Var que almacena el nombre largo de la territorial
  $terr_nombre = $dep->getTerrNombre();
  //Var que almacena el nombre del recurso
  $nom_recurso =  $tdoc2->get_sgd_tpr_descrip();
?>
  <head>
    <title>Gen  -  ORFEO - <?=DATE ?></TITLE>
    <link rel="stylesheet" href="estilos_totales.css">
  </head>

  <body>
  <?php
  if(!$numrad)
    $numrad=$verrad;
  

  $no_digitos = (strlen(trim($radicar_a))==13 or strlen(trim($radicar_a))==18)?
                  5 : 6;
  
  $linkArchSimple=$linkarchivo;
  $linkArchivoTmpSimple = $linkarchivotmp;

  $linkarchivo = "$ruta_raiz/".$linkarchivo;
  $linkarchivotmp = "$ruta_raiz/".$linkarchivotmp;
  $fechah=date("Ymd") . "_" . time("hms");
  // ABRE EL ARCHIVO
  $a = new Anexo($db);
  $a->anexoRadicado($numrad,$anexo);
  $anex=$a;
  $secuenciaDocto = $a->get_doc_secuencia_formato($dependencia);
  $fechaDocumento = $a->get_sgd_fech_doc();
  $tipoDocumento = $a->get_sgd_tpr_codigo();
  $tdoc->TipoDocumento_codigo($tipoDocumento);
  $tipoDocumentoDesc = $tdoc->get_sgd_tpr_descrip();


  if($radicar_documento) {
   //GENERACION DE LA SECUENCIA PARA DOCUMENTOS ESPECIALES  *******************************
    // Generar el Numero de Radicacion
    if(($ent!=2) and $nurad and $vpppp=="ddd") {
          $sec = $nurad;
          $anoSec = substr($nurad,0,4);
          // @tipoRad define el tipo de radicado el -X
          $tipoRad = substr($radicar_documento,-1);
          
    }
    else
    {
      if($vp=="n" and $radicar_a=="si")
    {
         if($generar_numero=="no")
         {
          $sec = substr($nurad,7,$no_digitos);
          $anoSec = substr($nurad,0,4);
          $tipoRad = substr($radicar_documento,-1);
          }
          else
          {
           $isql = "select * from ANEXOS
               where ANEX_CODIGO=$anexo AND ANEX_RADI_NUME=$numrad";
           $rs=$db->query($isql);
           if  (!$rs->EOF)
            $radicado_salida=$rs->fields['RADI_NUME_SALIDA'];
           else{
            $db->conn->RollbackTrans();
            die ("<span class='etextomenu'>No se ha podido obtener la informacion del radicado");		 
           }
                 
           if (!$radicado_salida)
            { //print ("Genera secuencia antigua");
              $isql_hl= "select sec_$depe_codi_territorial.nextval as SEC from dual";
              //print ("Genera secuencia antigua $isql_hl");
              
            $sec=$db->nextId("secr_tp1_".$dep->getDepSecRadic(1));
            if ($sec==-1){
              $db->conn->RollbackTrans();
               die ("<span class='etextomenu'>No se encontr� la secuencia sec_$depe_codi_territorial ");						   
            }
            //print ("Trata de alcular la secuencia y obtiene ... (sec_$depe_codi_territorial,$sec)".$db->conn->_genIDSQL."---".$db->conn->hasGenID);
            $no_digitos = 6;
            $tipoRad = "1";
           }
           else
           {
             $sec = substr($radicado_salida,7,$no_digitos);
             $tipoRad = substr($radicar_documento,-1);
             $anoSec = substr($radicado_salida,0,4);
             echo "<span class='etextomenu'><br>Ya estaba radicado<br>";
             $radicar_a = $radicado_salida;
           }
        }
    }else
    {
       if($vp=="s")
       {
         $sec = "XXX";
      }else{
       // EN ESTA PARTE ES EN LA CUAL SE ENTRA A ASIGNAR EL NUMERO DE RADICADO
       
       $sec = substr($radicar_a,7,$no_digitos);
       $anoSec = substr($radicar_a,0,4);
       $tipoRad = substr($radicar_a,13,1);

      }
    }
    // * GENRACION DE NUMERO DE RADICADO DE SALIDA
      $sec = str_pad($sec,$no_digitos,"0",STR_PAD_left);
      $plg_comentarios = "";
      $plt_codi = $plt_codi;
      if(!$anoSec)
      {
         $anoSec = date("Y");
      }
      if(!$tipoRad)
      {
         $tipoRad = "1";
      }		
      $rad_salida = $anoSec . $dependencia . $sec .$tipoRad;
      
      if  ($numerar==1){
          //print ("CAMBIA LA SALIDA POR QUE NUMERA");
        $numResol = $a->get_doc_secuencia_formato();
        $rad_salida = date("Y") . $dependencia . str_pad($a->sgd_doc_secuencia(),6,"0",STR_PAD_left) . $a->get_sgd_tpr_codigo();
        }
     //print ("QUEDE  $rad_salida  **********");

  //**********************************************************************************************************************************
  // * FIN GENRACION DE NUMERO DE RADICADO DE SALIDA
    $ext = strtoupper(substr(trim($linkarchivo),-3));
    echo "<font size='3' color='#000000'><span class='etextomenu'>";
    $ext = strtoupper($ext);
    if($ext=="XLS" or $ext=="PPT" or $ext=="PDF")
    {
      echo "<br><font size='3' ><span class='etextomenu'>Sobre formato ($ext) no se puede realizar combinacion de correspondencia</br>";
      die;
    }else
    {
      
       require "$ruta_raiz/jh_class/funciones_sgd.php";
       $verrad = $numrad;
      $radicado_p = $verrad;
      $no_tipo = "true";
      require "$ruta_raiz/ver_datosrad.php";
      include "$ruta_raiz/radicacion/busca_direcciones.php";
         $a = new LOCALIZACION($codep_us1,$muni_us1,$db);
         $dpto_nombre_us1 = $a->departamento;
         $muni_nombre_us1 = $a->municipio;
         $a = new LOCALIZACION($codep_us2,$muni_us2,$db);
         $dpto_nombre_us2 = $a->departamento;
         $muni_nombre_us2 = $a->municipio;
         $a = new LOCALIZACION($codep_us3,$muni_us3,$db);
         $dpto_nombre_us3 = $a->departamento;
         $muni_nombre_us3 = $a->municipio;
         $espObjeto->Esp_nit($cc_documento_us3);
         $nuir_e = $espObjeto->getNuir(); 



         $fecha_hoy_corto = date("d-m-Y");
         include "$ruta_raiz/class_control/class_gen.php";

          $b = new CLASS_GEN();
           $fecha_hoy =  $b->traducefecha($date);
         $fecha_e =  $b->traducefecha($radi_fech_radi);
         $fechaDocumento2 = $b->traducefecha_sinDia($fechaDocumento);
         $fechaDocumento=$b->traducefechaDocto($fechaDocumento);
       //print ("Fecha en letras  $fechaDocumento2 ")  ;
      //$campos = array ("*RAD_S*"    ,"*RAD_E_PADRE*"   ,"*CTA_INT*","*ASUNTO*","*F_RAD_E*"            ,"*NOM_R*"        ,"*DIR_R*"         ,"*DEPTO_R*"     ,"*MPIO_R*"        ,"*TEL_R*"      ,"*MAIL_R*","*DOC_R*"          ,"*NOM_P*"       ,"*DIR_P*"      ,"*DEPTO_P*"         ,"*MPIO_P*"        ,"*TEL_P*"      ,"*MAIL_P*","*DOC_P*"          ,"*NOM_E*"     ,"*DIR_E*"       ,"*MPIO_E*"     ,"*DEPTO_E*"        ,"*TEL_E*"       ,"*MAIL_E*","*NIT_E*"          ,"*NUIR_E*","*F_RAD_S*"       ,"*RAD_E*","*SECTOR*"       ,"*NRO_PAGS*"   ,"*DESC_ANEXOS*","*F_HOY_CORTO*"    ,"*F_HOY*","*NUM_DOCTO*","*F_DOCTO*"        ,"*NOM_REC*"       ,"*F_DOCTO1*"    ,"*FUNCIONARIO*","*LOGIN*","*DEP_NOMB*"    ,"*CUI_TER*"    ,"*DEP_SIGLA*");
      //$datos = array ($rad_salida   ,$radicado_p       ,$cuentai   ,$ra_asun  ,$fecha_e               ,$nombret_us1_u   ,$direccion_us1   , $dpto_nombre_us1,$muni_nombre_us1  ,$telefono_us1  ,$mail_us1 ,$cc_documentous1  ,$nombret_us2_u  ,$direccion_us2 ,$dpto_nombre_us2    ,$muni_nombre_us2  ,$telefono_us1  ,$mail_us2 ,$cc_documento_us2  ,$nombret_us3_u,$direccion_us3 ,$muni_nombre_us3,$dpto_nombre_us3   ,$telefono_us3   ,$mail_us3 ,$cc_documento_us3   ,$nuir_e   ,$fecha_hoy_corto  ,$nurad   ,$sector_nombre   ,$radi_nume_hoja,$radi_desc_anex,$fecha_hoy_corto   ,$fecha_hoy,$secuenciaDocto,$fechaDocumento ,$tipoDocumentoDesc,$fechaDocumento2,$usua_nomb     ,$krd     ,$dependencianomb,$depe_municipio,$dep_sigla);
      $campos = array();
      $datos  = array();
      $anex->obtenerArgumentos($campos,$datos);
      //print("	LA SECUENCIA ES ($secuenciaDocto)($fechaDocumento2)");
      if($vp=="n")
          $archivoFinal=$linkArchSimple;
       else
         $archivoFinal=$linkArchivoTmpSimple;
         //almacena la extension del archivo a procedar
         $extension =  (strrchr ( $archivoFinal, "."));
         $archSinExt = substr($archivoFinal,0, strpos($archivoFinal,$extension));
         //Almacena el path completo hacia el archivo a producirse luego de la combinacion
         $archivoFinal = $archSinExt . ".doc";
         //Almacena el nombre de archivo a producirse luego de la combinacion y que ha de actualizarce en la tabla de anexos
         $archUpdate = substr($archivoFinal,strpos( $archivoFinal,strrchr($archivoFinal, "/")) + 1,strlen ($archivoFinal)- strpos( $archivoFinal,strrchr($archivoFinal, "/"))  +1);
         //Almacena el path de archivo a producirse luego de la combinacion y que ha de actualizarce en la tabla de radicados
         $archUpdateRad  = substr_replace ($archivoFinal,"",0,strpos($archivoFinal,"bodega")+strlen("bodega"));
         
         
         //$a->combinar($campos,$datos);
         $ra_asun =  ereg_replace ( "\n", "-", $ra_asun);
         $ra_asun =  ereg_replace ( "\r", " ", $ra_asun);
         $archInsumo="tmp_".$usua_doc."_".$fechaArchivo."_".$hora.".txt";
         
         $fp=fopen("$ruta_raiz/bodega/masiva/$archInsumo",'w+');
         
         if (!$fp){
          echo "<br><font size='3' ><span class='etextomenu'>ERROR..No se pudo abrir el archivo $ruta_raiz/bodega/masiva/$archInsumo</br>";
          $db->conn->RollbackTrans();
          die;
         }
         fputs ($fp,"archivoInicial=$linkArchSimple"."\n"); 
         fputs ($fp,"archivoFinal=$archivoFinal"."\n"); 
         fputs ($fp,"*RAD_S*=$rad_salida\n");
         fputs ($fp,"*RAD_E_PADRE*=$radicado_p\n");
         fputs ($fp,"*CTA_INT*=$cuentai\n");
         fputs ($fp,"*ASUNTO*=$ra_asun\n");
         fputs ($fp,"*F_RAD_E*=$fecha_e\n");
         fputs ($fp,"*NOM_R*=$nombret_us1_u\n");
         fputs ($fp,"*DIR_R*=$direccion_us1\n");
         fputs ($fp,"*DEPTO_R*=$dpto_nombre_us1\n");
         fputs ($fp,"*MPIO_R*=$muni_nombre_us1\n");
         fputs ($fp,"*TEL_R*=$telefono_us1\n");
         fputs ($fp,"*MAIL_R*=$mail_us1\n");
         fputs ($fp,"*DOC_R*=$cc_documentous1\n");
         fputs ($fp,"*NOM_P*=$nombret_us2_u\n");
         fputs ($fp,"*DIR_P*=$direccion_us2\n");
         fputs ($fp,"*DEPTO_P*=$dpto_nombre_us2\n");
         fputs ($fp,"*MPIO_P*=$muni_nombre_us2\n");
         fputs ($fp,"*TEL_P*=$telefono_us1\n");
         fputs ($fp,"*MAIL_P*=$mail_us2\n");
         fputs ($fp,"*DOC_P*=$cc_documento_us2\n");
         fputs ($fp,"*NOM_E*=$nombret_us3_u\n");
         fputs ($fp,"*DIR_E*=$direccion_us3\n");
         fputs ($fp,"*MPIO_E*=$muni_nombre_us3\n");
         fputs ($fp,"*DEPTO_E*=$dpto_nombre_us3\n");
         fputs ($fp,"*TEL_E*=$telefono_us3\n");
         fputs ($fp,"*MAIL_E*=$mail_us3\n");
         fputs ($fp,"*NIT_E*=$cc_documento_us3\n");
         fputs ($fp,"*NUIR_E*=$nuir_e\n");
         fputs ($fp,"*F_RAD_S*=$fecha_hoy_corto\n");
         fputs ($fp,"*RAD_E*=$nurad\n");
         fputs ($fp,"*SECTOR*=$sector_nombre\n");
         fputs ($fp,"*NRO_PAGS*=$radi_nume_hoja\n");
         fputs ($fp,"*DESC_ANEXOS*=$radi_desc_anex\n");
         fputs ($fp,"*F_HOY_CORTO*=$fecha_hoy_corto\n");
         fputs ($fp,"*F_HOY*=$fecha_hoy\n");
         fputs ($fp,"*NUM_DOCTO*=$secuenciaDocto\n");
         fputs ($fp,"*F_DOCTO*=$fechaDocumento\n");
         //fputs ($fp,"*NOM_REC*=$tipoDocumentoDesc\n");
         fputs ($fp,"*F_DOCTO1*=$fechaDocumento2\n");
         fputs ($fp,"*FUNCIONARIO*=$usua_nomb\n");
         fputs ($fp,"*LOGIN*=$krd\n");
         fputs ($fp,"*DEP_NOMB*=$dependencianomb\n");
         fputs ($fp,"*CIU_TER*=$terr_ciu_nomb\n");
         fputs ($fp,"*DEP_SIGLA*=$dep_sigla\n");
         fputs ($fp,"*TER*=$terr_sigla\n");   
         fputs ($fp,"*DIR_TER*=$terr_direccion\n");  
         fputs ($fp,"*TER_L*=$terr_nombre\n");
         fputs ($fp,"*NOM_REC*=$nom_recurso\n");
         //print ("recurso($nom_recurso)");
        
        
         for ($i_count=0;$i_count<count ($campos);$i_count++){
          fputs ($fp,trim($campos[$i_count])."=".trim($datos[$i_count])."\n");
        //	print ("<BR> a�de".trim($campos[$i_count])."=".trim($datos[$i_count])."\n");
        }
         
         fclose($fp);
         /*
         $dep->conexion->close();
         $espObjeto->conexion->close();
         $radObjeto->conexion->close();
         $tdoc2->conexion->close();
         $anex->conexion->close();
         */
        
         
         //El include del servlet hace que se altere el valor de la variable  $estadoTransaccion como 0 si se pudo procesar el documento, -1 de lo
         // contrario
         $estadoTransaccion=-1;
         // include ("http://$servProcDocs/docgen/servlet/WorkDistributor?accion=1&ambiente=$ambiente&archinsumo=$archInsumo&vp=$vp");
        echo "http://$servProcDocs/docgen/servlet/WorkDistributor?accion=1&ambiente=$ambiente&archinsumo=$archInsumo&vp=$vp";
         if ($estadoTransaccion!=0){
          $db->conn->RollbackTrans();
          echo ("<BR> NO SE PUDO COMPLETAR LA TRANSACCION 	INTENTE MAS TARDE");
          //echo "<BR><input type=button  name=Reintentar value=Reintentar class='ebuttons2' onClick='history.go(0);'>";
          echo "<input type=button  name=Regresar value=Regresar  class='ebuttons2' onClick='history.go(-1);'>";
          die;
         }
         print ("<BR> El estado de la transaccion....$estadoTransaccion");
         session_start();
         //echo "<B><CENTER><a href=$ruta_raiz/bodega/masiva/$archInsumo> Insumo($archivoFinal)($archUpdateRad)(http://172.16.1.200:8080/docgen/servlet/WorkDistributor?accion=1&ambiente=$ambiente&archinsumo=$archInsumo&vp=$vp)</a><br>";
         $linkarchivo_grabar = $linkarchivo;
         
      }
    
    /** echo "<HTML><SCRIPT>document.location='$arpdf';</SCRIPT></HTML>";
      */

      }
    //****************************************************************************************************
    if($sec and $vp=="n")
      {
            if($ent==1 and $nurad ) $rad_salida = $nurad;
        $isql = "update ANEXOS set RADI_NUME_SALIDA=$rad_salida,
                 ANEX_SOLO_LECT='S',ANEX_RADI_FECH=$sqlFechaHoy,ANEX_ESTADO=2,ANEX_NOMB_ARCHIVO = '$archUpdate', ANEX_TIPO='$numextdoc'
                 ,SGD_DEVE_CODIGO = null
                 where ANEX_CODIGO=$anexo AND ANEX_RADI_NUME=$numrad";
         $rs=$db->query($isql);
        if (!$rs){
         $db->conn->RollbackTrans();
         die ("<span class='etextomenu'>No se ha podido actualizar la informacion de anexos");
        }


        //print ("SALEEEE5555555E");
        $isql = "select * from ANEXOS where ANEX_CODIGO=$anexo AND ANEX_RADI_NUME=$numrad";
        $rs=$db->query($isql);
        if  ($rs==false){
          $db->conn->RollbackTrans();
          die ("<span class='etextomenu'>No se ha podido obtener la informacion de anexo");
        }
       $sgd_dir_tipo = $rs->fields["SGD_DIR_TIPO"];
       $anex_desc = $rs->fields["ANEX_DESC"];
           $anex_numero = $rs->fields["ANEX_NUMERO"];
       $pasar_direcciones = true;
         $dep_radicado = substr($rad_salida,4,3);
      //	 echo ("al radicar($dep_radicado)($rad_salida)");
       $carp_codi = substr($dep_radicado,0,2);
       $tipo_docto=$anex->get_sgd_tpr_codigo();
       if (!$tipo_docto)
       $tipo_docto=0;
         $linkarchivo_grabar = str_replace("bodega","",$linkarchivo);
         $linkarchivo_grabar = str_replace("./","",$linkarchivo_grabar);
       if($generar_numero!="no" and $radicar_a=="si")
       {
         //print("RADICANDO.......................................");
         $isql = "INSERT INTO RADICADO(EESP_CODI,TDOC_CODI,RADI_NUME_RADI,RADI_FECH_RADI,RADI_NUME_DERI,RADI_TIPO_DERI,CARP_CODI   ,CARP_PER,RADI_DEPE_RADI ,RADI_DEPE_ACTU,RADI_USUA_ACTU,RA_ASUN  ,RADI_DESC_ANEX         ,RADI_PATH     )
          VALUES( '$espcodi',$tipo_docto     ,'$rad_salida' , $sqlFechaHoy      ,'$verrad'      ,9  ,'$carp_codi',1      ,'$dep_radicado',$dependencia    ,1             ,'$asunto','$desc_anexos','$archUpdateRad')";
         $rs=$db->query($isql);
         if (!$rs){
          $db->conn->RollbackTrans();
          die ("<span class='etextomenu'>No se ha podido Insetar el Radicado"); 
         }
        }else
        {
              $isql = "update RADICADO set RADI_PATH='$linkarchivo_grabar'
             where RADI_NUME_RADI=$rad_salida";
             $rs=$db->query($isql);
             if (!$rs){
              $db->conn->RollbackTrans();
              die ("<span class='etextomenu'>No se ha podido Actualizar el Radicado"); 
             }

        }

        if($sgd_dir_tipo==1)
        {
          }
        if($sgd_dir_tipo==2)
        {
          $dir_tipo_us1 = $dir_tipo_us2;
          $tipo_emp_us1=$tipo_emp_us2;
          $nombre_us1=$nombre_us2;
          $documento_us1 = $documento_us2;
          $cc_documento_us1 = $cc_documento_us2;
          $prim_apel_us1 =$prim_apel_us2 ;
          $seg_apel_us1 = $seg_apel_us2 ;
          $telefono_us1 = $telefono_us2;
          $direccion_us1 = $direccion_us2;
          $mail_us1 = $mail_us2;
          $muni_us1 = $muni_us2;
          $codep_us1 = $codep_us2;
          $tipo_us1 = $tipo_us2;			
        }	
        if($sgd_dir_tipo==3)
        {
          $dir_tipo_us1 = $dir_tipo_us3;
          $tipo_emp_us1=$tipo_emp_us3;
          $nombre_us1=$nombre_us3;
          $documento_us1 = $documento_us3;
          $cc_documento_us1 = $cc_documento_us3;
          $prim_apel_us1 =$prim_apel_us3 ;
          $seg_apel_us1 = $seg_apel_us3 ;
          $telefono_us1 = $telefono_us3;
          $direccion_us1 = $direccion_us3;
          $mail_us1 = $mail_us3;
          $muni_us1 = $muni_us3;
          $codep_us1 = $codep_us3;
          $tipo_us1 = $tipo_us3;	
        }	
        $nurad = $rad_salida;
        $documento_us2 = "";
        $documento_us3 = "";
        $conexion = $db;
        if ($numerar!=1)
         include "$ruta_raiz/radicacion/grb_direcciones.php";
        
        $actualizados = 4;
        $sgd_dir_tipo = 1;

        // Borro todo lo generando anteriormete .....  para el caso de regenerar			
      $isql = "delete 
             from ANEXOS
             where 
           RADI_NUME_SALIDA=$nurad 
           and sgd_dir_tipo like '7%' and sgd_dir_tipo !=7
         ";
      $rs=$db->query($isql);
      if (!$rs){
        $db->conn->RollbackTrans();
        die ("<span class='etextomenu'>No se ha borrar los datos previos del radicado"); 	
      }
        // fIN BORRADO Para reproceso....
      $isql = "select ANEX_NUMERO
             from ANEXOS
             where
           ANEX_RADI_NUME=$nurad
         Order by ANEX_NUMERO desc
         ";
        $rs=$db->query($isql);
      if (!$rs->EOF)
      $i=$rs->fields['ANEX_NUMERO'];	
      $isql = "select a.sgd_dir_codigo,a.sgd_dir_direccion,a.sgd_dir_telefono,a.sgd_dir_mail,b.sgd_ciu_nombre NOMBRE,b.SGD_CIU_APELL1 APELL1,b.SGD_CIU_APELL2 APELL2,b.SGD_CIU_CEDULA,a.SGD_DIR_TIPO
             from sgd_dir_drecciones a,sgd_ciu_ciudadano b
             where
           a.sgd_ciu_codigo (+) = b.sgd_ciu_codigo
            and a.sgd_dir_tipo like '7%' and a.sgd_dir_tipo !=7  and a.sgd_anex_codigo=$anexo
         ";
      $rs=$db->query($isql);
      $k = 0;
      
      while(!$rs->EOF)
         {
          $anexo_new = $rad_salida.substr("00000". ($i+1),-5);
          $sgd_dir_codigo = $rs->fields['SGD_DIR_CODIGO'];
          $radi_nume_radi = $rs->fields['RADI_NUME_RADI'];
          $sgd_dir_tipo = $rs->fields['SGD_DIR_TIPO'];
          $anex_tipo = "20";
          $anex_creador = $krd;
          $anex_borrado = "N";
          $anex_nomb_archivo = " ";
          $anexo_num = $i + 1;
          //$sgd_dir_tipo  = "7$anexo_num";
          $isql = "insert into ANEXOS (ANEX_RADI_NUME,RADI_NUME_SALIDA,ANEX_SOLO_LECT,ANEX_RADI_FECH,ANEX_ESTADO,ANEX_CODIGO  ,anex_tipo   ,ANEX_CREADOR  ,ANEX_NUMERO    ,ANEX_NOMB_ARCHIVO   ,ANEX_BORRADO   ,sgd_dir_tipo) 
          VALUES ($verrad       ,$rad_salida     ,'S'           ,$sqlFechaHoy       ,2          ,'$anexo_new','$anex_tipo','$anex_creador','$anexo_num','$anex_nomb_archivo','$anex_borrado','$sgd_dir_tipo')";
          $rs2=$db->query($isql);
          
          if (!$rs2){
            $db->conn->RollbackTrans();
            die ("<span class='etextomenu'>No se pudo insertar en la tabla de anexos"); 	
          }
          $isql = "UPDATE sgd_dir_drecciones
                   set RADI_NUME_RADI=$rad_salida 
                   where 
                sgd_dir_codigo=$sgd_dir_codigo
               ";   	
          $rs2=$db->query($isql);
          
          if (!$rs2){
            $db->conn->RollbackTrans();
            die ("<span class='etextomenu'>No se pudo actualizar las direcciones");						   
          }
          $sgd_dir_tipo++;	
          $i++;
          $k++;
          $rs->MoveNext();
         }
         echo "<br>Se han generado $k copias<br>";
        ?>

  <p>
    <center>
      <?
    if($actualizados>0)
    { 
    if($ent != 1)
      { 	
          $mensaje="<input type='button' value='cerrar' onclick='opener.history.go(0); window.close()'>";	
      $mensaje = "";
    if ($numerar!=1) { $numerar=$numerar;
    ?>
      <span class='etextomenu'>Ha sido Radicado el Documento con el N&uacute;mero <br><b>
       <?=$rad_salida ?><p><?=$mensaje ?>
    <? } 

       }else
          $mensaje = "";
    }else{
    ?>
    <span class='etextomenu'>No se ha podido radicar el Documento con el N&uacute;mero <b>
    
      </b> 
    <?
    }
    ?>
    </center>
    <?
      }	
  }
  $db->conn->CommitTrans();
  //print ("NO MAS")

?>
</body>

