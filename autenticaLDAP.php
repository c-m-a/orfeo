<?php
  function checkldapuser($username, $password, $ldap_server) {
    
    if ($connect = @ldap_connect($ldap_server)) {
      
      // enlace a la conexión
      if (($bind = @ldap_bind($connect)) == false) {
        $mensajeError = "Falla la conexi&oacute;n con el servidor LDAP";
        return $mensajeError;
      }
      
      // busca el usuario
      if (($res_id = ldap_search($connect, "ou=People, o=usuarios,o=superservicios.gov.co", "mail=$username")) == false) {
        $mensajeError = "No encontrado el usuario en el árbol LDAP";
        return $mensajeError;
      }
      
      if (ldap_count_entries($connect, $res_id) != 1) {
        $mensajeError = "El usuario $username se encontr&oacute; mas de 1 vez";
        return $mensajeError;
      }
      
      if (($entry_id = ldap_first_entry($connect, $res_id)) == false) {
        $mensajeError = "No se obtuvieron resultados";
        return $mensajeError;
      }
      
      if (($user_dn = ldap_get_dn($connect, $entry_id)) == false) {
        $mensajeError = "No se puede obtener el dn del usuario";
        return $mensajeError;
      }
      /* Autentica el usuario */
      if (($link_id = ldap_bind($connect, $user_dn, $password)) == false) {
        $mensajeError = "USUARIO O CONTRASE&Ntilde;A INCORRECTOS";
        return $mensajeError;
      }
      
      return '';
      @ldap_close($connect);
    } else {
      $mensajeError = "no hay conexión a '$ldap_server'";
      return $mensajeError;
    }
    
    @ldap_close($connect);
    return (false);
  }
?>
