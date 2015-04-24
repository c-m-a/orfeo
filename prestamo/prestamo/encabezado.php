<?php
//********************************************************************************


//===============================
// Display Menu Form
//-------------------------------
function Form1_show()
{
  global $db;
  global $styles;
  $sFormTitle = "";

//-------------------------------
// Form1 Open Event begin
// Form1 Open Event end
//-------------------------------

//-------------------------------
// Set URLs
//-------------------------------
  $fldpedidos = "pedidos.php";
  $flddevolver = "devolucion.php";
  $fldbusquedas = "busquedas.php";
  $fldsalir = "login.php";
  $fldprestamoMasivo = "usuarioMasivo.php";
  $flddevolucionMasivo = "usuarioDevMasivo.php";
  $fldcancelarAntiguos = "cancelarAntiguos.php";
//-------------------------------
// Form1 Show begin
//-------------------------------


//-------------------------------
// Form1 BeforeShow Event begin
// Form1 BeforeShow Event end
//-------------------------------

//-------------------------------
// Show fields
//-------------------------------

?>
    <table class="FormTABLE">
     <tr>
      <td class="DataTD"><a href="<?= $fldpedidos?>"><font class="DataFONT">Ver Solicitados</font></a></td>
      <td class="DataTD"><a href="<?= $fldprestamoMasivo?>"><font class="DataFONT">Prestamo Masivo</font></a></td>
      <td class="DataTD"><a href="<?= $flddevolver?>"><font class="DataFONT">Ver Prestados</font></a></td>
      <td class="DataTD"><a href="<?= $flddevolucionMasivo?>"><font class="DataFONT">Devolucion Masiva</font></a></td>
      <td class="DataTD"><a href="<?= $fldbusquedas?>"><font class="DataFONT">Búsquedas</font></a></td>
      <td class="DataTD"><a href="<?= $fldcancelarAntiguos?>"><font class="DataFONT">Cancelar Antiguos</font></a></td>
      <td class="DataTD"><a href="<?= $fldsalir?>"><font class="DataFONT">Salida Segura</font></a></td>
     </tr>
    </table>
<?php

//-------------------------------
// Form1 Show end
//-------------------------------
}
//===============================

?>