<?php
    // Se utiliza el combinador por medio del servlet para los .doc
    include ("http://$servProcDocs/docgen/servlet/WorkDistributor?accion=2&ambiente=$ambiente&archinsumo=$archInsumo&definitivo=si");
    // $estadoTransaccion!=0 &&
    echo ("<br>$archInsumo");
    
    if ( !file_exists("$ruta_raiz/bodega/masiva/$archInsumo")) {
      $objError = new CombinaError (NO_DEFINIDO);
      echo ($objError->getMessage());
      die;
    } else {
      $archivoTmp = str_replace('./', '/', $archivoTmp);
      echo ("<BR><span class='info'> Por favor guarde el archivo y verifique que los datos de combinacion  esten correctos <br>");
      echo "<a href='$ruta_raiz/descargar_archivo_masiva.php?ruta_archivo=$archivoTmp&nombre_archivo=$archivoTmp'><span class='$radFileClass'>Guardar Archivo</span></a>";
      echo ("<a class='vinculos' href=javascript:abrirArchivoaux('$ruta_raiz/$archivoTmp')>Guardar Archivo </a></span> ");
      echo ("<br><br>");
      echo( "<br><input name='enviaDef' type='button'  class='botones' id='envia22'  onClick='enviar()' value='Generar Definitivo'>");
      echo( "<input name='cancel' type='button'  class='botones' id='envia22'  onClick='cancelar()' value='Cancelar'>");
    }
?>
