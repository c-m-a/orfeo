<?
session_start();
require_once("$ruta_raiz/include/db/ConnectionHandler.php");

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug = true; 
 
 if(!$_SESSION['dependencia']) include "$ruta_raiz/rec_session.php";
 
 include_once("$ruta_raiz/include/combos.php");
 
 
?>

<form name=form_resolucion  method='post' action='subtipo_docto/resolucion_registro.php?<?=session_name()?>=<?=trim(session_id())?>&krd=<?=$krd?>&verrad=<?=$verrad?>&<?="&mostrar_opc_envio=$mostrar_opc_envio&nomcarpeta=$nomcarpeta&carpeta=$carpeta&leido=$leido"?>'>
  <table border=0 width 100% cellpadding="0" cellspacing="5" class="borde_tab" >
      <input type=hidden name=nomcarpeta value="<?=$nomcarpeta?>">
    <tr> 
      <td  class="titulos2">Resolucion</td>
      <TD width="323" > 
            <select name="resol" class="select">
      <?php
	//$tipoNotific=3;	 
       // Arma la lista desplegable con los tipos de documento a anexar
       $a = new combo($db); 
       $s =  "select * from sgd_tres_tpresolucion where sgd_tpr_codigo=$tpdoc_rad";
			// print($s);
			$r = "SGD_TRES_CODIGO"; 
			$t = "SGD_TRES_DESCRIP";
			$v = $sgd_tres_codigo;
			$sim = 0; 
      	$a->conectar($s,$r,$t,$v,$sim,$sim);
						
      	 ?>
        </select>
      </td>
    </tr>
    <tr> 
      <td bgcolor='#cccccc' colspan="2"> 
        <input type=submit name=grabar_subtipo value='Grabar Cambio' class='botones'>
      </td>
    </tr>
  </table>
</form>
