<?
session_start();
// Modificado SGD 20-Septiembre-2007
/**
  * Paggina datosSubexpediente.php
	* Modificado en la SES
  * 
	* Se añadio compatibilidad con variables globales en Off
  * @autor Jairo Losada 2009-05
  * @licencia GNU/GPL V 3
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$nomcarpeta=$_GET["nomcarpeta"];
if($_GET["tipo_carp"])  $tipo_carp = $_GET["tipo_carp"];

define('ADODB_ASSOC_CASE', 2);

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$ruta_raiz = "..";
//if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$db = new ConnectionHandler($ruta_raiz);	 
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);  
//$db->conn->debug=true;

if( isset( $_POST['grabar'] ) && $_POST['grabar'] == "GRABAR" )
{
    include_once( "$ruta_raiz/include/tx/Expediente.php" );
    
    $expediente = new Expediente( $db );
    $grabarSubexpediente = $expediente->grabarSubexpediente( $_GET['nurad'], $_GET['num_expediente'], $_POST['exp_subexpediente'] );
    if( $grabarSubexpediente == 1 )
    {
        $observa = "Creaci�n de Subexpediente";
        include_once "$ruta_raiz/include/tx/Historico.php";
        $radicados[] = $_GET['nurad'];
        $tipoTx = 55;
        $Historico = new Historico( $db );
        $Historico->insertarHistoricoExp( $_GET['num_expediente'], $radicados, $dependencia, $codusuario, $observa, $tipoTx, 0 );
    ?>
    <script language="JavaScript">
      opener.regresar();
      window.close();
    </script>
    <?php
    }
    else
    {
        print '<hr><font color=red>No se guard� el Subexpediente. Por favor intente de nuevo.</font><hr>';	    
    }
}
?>
<html>
<head>
  <meta http-equiv="Cache-Control" content="cache">
  <meta http-equiv="Pragma" content="public">
<link rel="stylesheet" href="../estilos/orfeo.css">
<?php
$fechah=date("dmy") . "_". time("h_m_s");
$encabezado = session_name()."=".session_id()."&krd=$krd";
?>
<script language="JavaScript">
// Grabar Subexpediente
function grabarSubexpediente()
{
    if( document.getElementById( 'exp_subexpediente').value == "" || isNaN( document.getElementById( 'exp_subexpediente').value ) )
    {
        alert( "Debe ingresar un n�mero de subexpediente." );
        document.getElementById( 'exp_subexpediente').focus();
    }
    else
    {
        confirmar = confirm( "Recuerde que cualquier cambio que realice en este m�dulo afectar� su \n\r ubicaci�n f�sica dentro del expediente." );
    }
    
    if( confirmar )
    {
        document.getElementById( 'grabar' ).value = "GRABAR";
        document.frmSubexpediente.submit();
    }
}
</script>
</head>

<body bgcolor="#FFFFFF" topmargin="0" >
	 <form name='frmSubexpediente' action='' method="post">
     <input type="hidden" name="grabar" id="grabar" value="">
        <TABLE width="100%" align="center" cellspacing="5" cellpadding="0" class="borde_tab">
          <tr> 
            <TD class='titulos2' height="58"> 
              <table BORDER=0  cellpad=2 cellspacing='2' WIDTH=100% class='t_bordeGris' valign='top' align='center' cellpadding="2" >
                <tr><td class='titulos2' align="center">Radicado No <b><?=$nurad?></b> Perteneciente al expediente No <b><?=$num_expediente?></b></td>
<?php
				require "$ruta_raiz/class_control/class_control.php";
				$btt = new CONTROL_ORFEO($db);				
				if( $Grabar )
				{
				  	// Aqui se accede a la clase class_control para actualizar expedientes.
                    $btt->modificar_expediente($nurad,$num_expediente,$exp_titulo,$exp_asunto,$exp_ufisica,$exp_isla,$exp_caja,$exp_estante,$exp_carpeta,$exp_subexpediente);
				}
				$btt->datos_expediente( $num_expediente,$nurad );
                $num_carpetas = $btt->exp_num_carpetas;
                $exp_titulo = $btt->exp_titulo;
                $exp_asunto = $btt->exp_asunto;
                $exp_ufisica = $btt->exp_ufisica;
                $exp_isla = $btt->exp_isla;
                $exp_caja = $btt->exp_caja;
                $exp_estante = $btt->exp_estante;
                $exp_carpeta = $btt->exp_carpeta;
                $exp_subexpediente = $btt->exp_subexpediente;
				?>
				</tr>
              </TABLE>
            </td>
          </tr>
          <tr> 
            <td class=listado2> 
              <table width="100%" height="99%" cellspacing="5"  align="center" class="borde_tab" >
                <tr valign="bottom" > 
                  <td class='titulos2'>TITULO&nbsp;</td> 
				  <TD class='titulos2'>
                    <input type=text class='tex_area' name=exp_titulo value='<?=$exp_titulo?>' size=30 maxlength="20" readonly>
                  </TD>
                </tr>
				<tr>
                  <td class='titulos2'>ASUNTO</td>
			      <TD class='titulos2'>
                    <input type=text class='tex_area' name=exp_asunto value='<?=$exp_asunto?>' size=50 maxlength="40" readonly><BR>
                  </TD>
				</tr>
                <tr>
                  <td class='titulos2'>SUBEXPEDIENTE</td>
			      <TD class='titulos2'nowrap>
                    <input type="text" class='tex_area' name="exp_subexpediente" id="exp_subexpediente" value='<?=$exp_subexpediente?>' size=3 maxlength="2">
                    &nbsp;
                    <span class="leidos" >Digite el n�mero del subexpediente al cual pertenece el radicado.</span>
                  </TD>
				</tr>
				<TR class='titulos2'>
				<TD colspan="3">
	<? // Subtabla donde se coloca inf. de la carpeta				 ?>
    						  
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="borde_tab"  >
      <TR class='titulos2'><TD>&nbsp;</TD></TR>
        <tr valign="bottom" class='titulos2'> 
          <td class='titulos2' colspan="2">UBICACION FISICA&nbsp;</td> 
          <TD colspan="2">
            <input type=text class='tex_area' name=exp_ufisica value='<?=$exp_ufisica?>' maxlength="3" readonly>&nbsp;
          </TD>
        </tr>
        <tr>
          <td width="14%" colspan="4">&nbsp;</td>
        </tr>
        <tr class='titulos2'>
          <td class='titulos2'>ISLA</td>
          <TD valign="middle" align="left">
            <input type=text class='tex_area' name=exp_isla value='<?=$exp_isla?>' size=10 maxlength="3" readonly>
          </TD>
          <td class='titulos2'>ESTANTE</td>
          <TD valign="midle" align="left">
            <input type=text class='tex_area' name=exp_estante value='<?=$exp_estante?>' size=10 maxlength="3" readonly>
          </TD>
        </tr>
        <tr class='titulos2'>
          <td class='titulos2'>CAJA</td>
          <TD valign="middle" align="left">
            <input type=text class='tex_area' name=exp_caja value='<?=$exp_caja?>' size=10 maxlength="3" readonly>
          </TD>
          <td class='titulos2'>CARPETA</td>
          <TD valign="middle" align="left">
            <input type=text class='tex_area' name=exp_carpeta maxlength="3" value='<?=$exp_carpeta?>' size=10 readonly>
          </TD>
        </tr>
    </table>
  </TD>
				</TR>
				<TR class='titulos2'>
                <td colspan="4" align="center">
                  <input type="button" value="Grabar" name="btnGrabar" class="botones" onClick="grabarSubexpediente();">
                  &nbsp;
                  <input type="button" value="Cerrar" name="btnCerrar" onClick="opener.regresar(); window.close();" class="botones">
                  &nbsp;
                </td>
				</TR>
              </table>
		    </td></tr>
	   </table>
</form>
</body>
</html>
