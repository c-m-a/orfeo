<?php
  if (!$ruta_raiz)
    $ruta_raiz = ".";
  require_once("$ruta_raiz/include/db/ConnectionHandler.php");
  
  if (!$db)
    $db = new ConnectionHandler($ruta_raiz);
  
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $db->conn->BeginTrans();
  
  $isql = "select usua_login,usua_pasw,codi_nivel, USUA_NOMB from usuario " . "where usua_login ='$usua'";
  $rs   = $db->query($isql);
  if ($rs && !$rs->EOF) {
    $secur         = $rs->fields['CODI_NIVEL'];
    //Traigo el nombre del usuario para ponerlo en la descripción del histórico
    $nombreUsuario = $rs->fields['USUA_NOMB'];
  }
  if (!$secur) {
    $mensaje = "No tiene permisos para borrar el documento";
  }
  if ($secur) {
    $isql = "select codi_nivel ,anex_solo_lect ,anex_creador ,anex_desc,anex_tipo_ext , anex_numero ,anex_nomb_archivo " . "from anexos, anexos_tipo,radicado " . "where 
		anex_codigo='$anexo' and anex_radi_nume=radi_nume_radi and anex_tipo=anex_tipo_codi";
    
    $rs = $db->query($isql);
    if ($rs && !$rs->EOF) {
      $docunivel     = $rs->fields['CODI_NIVEL'];
      $sololect      = ($rs->fields['ANEX_SOLO_LECT'] == "S");
      $extension     = $rs->fields['ANEX_TIPO_EXT'];
      $usua_creador  = ($rs->fields['ANEX_CREADOR'] == $usua);
      $nombrearchivo = strtoupper($rs->fields['ANEX_NOMB_ARCHIVO']);
      if ($docunivel > $nivel)
        $secur = 0;
    } else {
      $mensaje = "El archivo que desea borrar no existe: Por favor consulte al administrador del sistema";
    }
  }
  
  //$bien=unlink(trim($linkarchivo));
  $bien = true;
  if ($bien) {
    $isql = "update anexos set anex_borrado='S' " . "where anex_codigo='$anexo'";
    $bien = $db->query($isql);
  }
  if ($bien) {
    include "$ruta_raiz/include/tx/Historico.php";
    $hist          = new Historico($db);
    $anexBorrado   = array();
    $anexBorrado[] = $numrad;
    
    $observa = "Se Elimina Anexo Digitalizado con Codigo: $anexo. Eliminado por: $nombreUsuario.";
    $codTx   = 31; //Código correspondiente a la eliminación de anexos
    $hist->insertarHistorico($anexBorrado, $dependencia, $codusuario, $dependencia, $codusuario, $observa, $codTx);
    $mensaje = "<span class='info'>Archivo eliminado<span><br> ";
    $db->conn->CommitTrans();
  } else {
    $mensaje = "<span class='alarmas'>No fue posible eliminar Archivo<span></br>";
    $db->conn->RollbackTrans();
  }
?>
<html>
   <head>
      <title>Informaci&oacute;n de Anexos</title>
      <link rel="stylesheet" href="estilos/orfeo.css">
   </head>
<script language="javascript">
function actualizar(){
   archivo=document.forma.userfile.value;
   if (archivo==""){
      if (document.forma.sololect.checked!=true)
         alert("Por favor escoja un archivo");
	  else	
	     document.forma.submit();
   }
   else if (archivo.toUpperCase().substring(archivo.length-<?= strlen(trim($nombrearchivo)) ?>,archivo.length)!="<?= trim($nombrearchivo) ?>"){
     if (confirm("Al parecer va a modificar un archivo diferente del original. Esta seguro?"))
         document.forma.submit();
   }else{
      document.forma.submit();
   }
}
</script>
<body bgcolor="#FFFFFF" topmargin="0">
<br>
<div align="center">
<p>
<?= $mensaje ?>
</p>
<input type='button' class="botones" value='cerrar' onclick='opener.regresar();window.close();'>
</body>
</html>
