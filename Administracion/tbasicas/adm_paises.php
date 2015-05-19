<?php
  session_start();
  $ruta_raiz = '../..';

  if($_SESSION['usua_admin_sistema'] !=1)
    die(include '../../errorAcceso.php');

  include('../../config.php');
  include(SMARTY_TEMPLATE);
  include('../../include/db/ConnectionHandler.php');

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  $error = 0;
  $db = new ConnectionHandler($ruta_raiz);

  if ($db) {
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

    if (isset($_POST['btn_accion']))
    {	$record = array();
      $record['ID_PAIS'] = $_POST['txtIdPais'];
      $record['ID_CONT'] = $_POST['idcont'];
      $record['NOMBRE_PAIS'] = $_POST['txtModelo'];
      switch($_POST['btn_accion']) {
        case 'Agregar':
        case 'Modificar':
          $res = $db->conn->Replace('SGD_DEF_PAISES',
                                    $record,array('ID_PAIS','ID_CONT'),
                                    $autoquote = true);
          ($res) ? ($res == 1 ? $error = 3 : $error = 4 ) : $error = 2;
          break;
        case 'Eliminar':
          $ADODB_COUNTRECS = true;
          $sql = "SELECT * FROM SGD_DIR_DRECCIONES WHERE ID_PAIS = ".$record['ID_PAIS'];
          $rs = $db->conn->Execute($sql);
          $ADODB_COUNTRECS = false;
          
          if ($rs->RecordCount() > 0) {
            $error = 5;
          } else {
            $db->conn->BeginTrans();
            $ok = $db->conn->Execute('DELETE FROM MUNICIPIO WHERE ID_PAIS=?',$record['ID_PAIS']);
            
            if ($ok) {
              $ok = $db->conn->Execute('DELETE FROM DEPARTAMENTO WHERE ID_PAIS=?',$record['ID_PAIS']);
              if ($ok) {
                $record = array_slice($record, 0, 2);
                $ok = $db->conn->Execute('DELETE FROM SGD_DEF_PAISES WHERE ID_PAIS=? AND ID_CONT=?',$record);
              }
            }
            if ($ok)
              $db->conn->CommitTrans();
            else
              $conn->RollbackTrans();
          }
      }
      unset($record);
    }
    
    $sql_cont = "SELECT NOMBRE_CONT,
                        ID_CONT
                  FROM  SGD_DEF_CONTINENTES
                  ORDER BY NOMBRE_CONT";
    
    $Rs_cont = $db->conn->Execute($sql_cont);
    
    if (!($Rs_cont))
      $error = 2;

    if (isset($_POST['idcont']) and $_POST['idcont'] >0) {
      $sql_pais = "SELECT NOMBRE_PAIS,
                          ID_PAIS
                    FROM  SGD_DEF_PAISES
                    WHERE ID_CONT=" . $_POST['idcont'] .
                    " ORDER BY NOMBRE_PAIS";
      $Rs_pais = $db->conn->Execute($sql_pais);
      if (!($Rs_pais)) $error = 2;
    }
  } else {
    $error = 1;
  }

  $continentes = $Rs_cont->GetMenu2('idcont',
                          $_POST['idcont'],
                          "0:&lt;&lt;SELECCIONE&gt;&gt;",
                          false,
                          0,
                          'class="select" onChange="this.form.submit()"');
  $Rs_cont->Close();
  
  $paises = (isset($_POST['idcont']) and $_POST['idcont'] > 0)?
              // Listamos los paises segun continente.
              $Rs_pais->GetMenu2('idpais',
                                        $_POST['idpais'],
                                        "0:&lt;&lt;SELECCIONE&gt;&gt;",
                                        false,
                                        0,
                                        'class="select" id="idpais" onChange="Actual();" ') :
              "<select name='idpais' id='idpais' class='select'>
                <option value='0' selected>&lt;&lt; Seleccione Continente &gt;&gt;</option></select>";
  
  $msg_error = '';
  
  if ($error) {
    $msg_error = '<tr bordercolor="#FFFFFF"> 
        <td width="3%" align="center" class="titulosError" colspan="3" bgcolor="#FFFFFF">';
    switch ($error) {
      case 1:	//No coneccion a bd
          $msg_error .= "Error al conectar a BD, comun&iacute;quese con el Administrador de sistema !!";
          break;
      case 2:	//error ejecuccion sql
          $msg_error .= "Error al gestionar datos, comun&iacute;quese con el Administrador de sistema !!";
          break;
      case 3:	//Acutalizacion realizada
          $msg_error .= "Informaci&oacute;n actualizada!!";
          break;
      case 4:	//Insercion realizada
          $msg_error .= "Pa&iacute;s creado satisfactoriamente!!";
          break;
      case 5:	//Imposibilidad de eliminar pais, est&aACUTE; ligado con direcciones
          $msg_error .= "No se puede eliminar pa&iacute;s, se encuentra ligado a direcciones.";
    }
    $msg_error .= '</td></tr>';
  }

  $enlace_ejecutar = $_SERVER['PHP_SELF'];

  $smarty->assign('ENLACE_EJECUTAR', $enlace_ejecutar);
  $smarty->assign('MSG_ERROR', $msg_error);
  $smarty->assign('PAISES', $paises);
  $smarty->assign('CONTINENTES', $continentes);
  $smarty->assign('ORFEO_URL', ORFEO_URL);
  $smarty->display('paises.tpl');
?>
