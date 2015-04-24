    <script>
      function solonumeros() {
        jh =  document.getElementById('buscar_por_radicado').value;
        if(jh) {
          var1 =  parseInt(jh);
          
          if(var1 != jh) {
            alert("Atendcion: El numero de Radicado debe ser de solo Numeros.");
            return false;
          } else {
            document.getElementById('buscar_por_radicado').value = var1;
            numCaracteres = document.getElementById('buscar_por_radicado').value.length;
            if(numCaracteres>=13 && numCaracteres<=14) {
              document.formulario.submit();
            } else {
              alert("Atendcion: El numero de Caracteres del radicado es de 14. (Digito :"+numCaracteres+")");
            }	
          }
        } else {
          document.formulario.submit();
        }
      }
    </script>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="borde_tab">
      <tr align="center" >
        <td class="titulos2">
          <center>
            VERIFICAR RADICACION PREVIA <?=$tRadicacionDesc ?>
            <b>
              <font size="1" color="green">(<?=$dependencia ?> -- &gt; <?=$tpDepeRad[$ent]?>) <?=$tipoMed?></font>
            </b>
          </center>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="1" cellpadding="1" class="borde_tab">
      <tr>
        <td width="100%" colspan="5" align="CENTER" class="titulos2" >DATO A BUSCAR </td>
      </tr>
      <tr>
        <td width="15%" align="right" class="titulos2" colspan="1">
          <font size="-1">
            <input type="checkbox" name="and_cuentai" value="1" <?=(isset($and_cuentai))? ' checked ' : ' '?> disabled>
          </font>
        </td>
        <td colspan="2" align="left" class="titulos2"> REFERENCIA (Cuenta I, Oficio) </td>
        <td width="46%" colspan="2" class="listado2">
          <input name="buscar_por_cuentai" type="text" class="ecajasfecha" id="cuentai" size="35" value="<?=(isset($buscar_por_cuentai))? $buscar_por_cuentai : null?>">
        </td>
      </tr>
      <tr>
        <td width="15%" align="right" class="titulos2">
          <font size="-1">
            <input type="checkbox" name="and_radicado" value="1" <?=(isset($and_radicado))? ' checked ' : ' '?> disabled>
          </font>
        </td>
        <td colspan="2" align="left" class="titulos2" >No. Radicado</td>
        <td width="46%"  colspan="2" class="listado2">
          <input name="buscar_por_radicado" type="text" class="ecajasfecha" id="buscar_por_radicado" size="35" value="<?=$buscar_por_radicado?>">
        </td>
      </tr>
      <tr>
        <td width="15%" align="right" class="titulos2">
          <font size="-1">
            <input  type="checkbox" name="and_expediente" value="1" <?=(isset($and_expediente))? ' checked ' : ' '?> disabled>
          </font>
        </td>
        <td height="15" colspan="2" align="left" class="titulos2" >Expediente</td>
        <td width="46%" colspan="2" class="listado2">
          <input name="buscar_por_exp" type="text" class="ecajasfecha" id="buscar_por" size="35" value="<?=(isset($buscar_por_exp))? $buscar_por_exp : null?>">
        </td>
      </tr>
      <tr>
        <td width="15%"  align="right" class="titulos2">
          <font size="-1">
            <input type="checkbox" name="and_doc" value="1" <?=(isset($and_doc))? ' checked ' : ' '?> disabled>
          </font>
        </td>
        <td height="15" colspan="2" align="left" class="titulos2" >Identificacion (T.I.,C.C.,Nit) * </td>
        <td width="46%" colspan="2" class="listado2">
          <input name="buscar_por_doc" type="text" class="ecajasfecha" id="cuentai" size="35" value="<?=(isset($buscar_por_doc))? $buscar_por_doc : null?>">
        </td>
      </tr>
<?php
  if ($ent == 2) {
?>
      <tr>
        <td width="15%" align="right" class="titulos2">
          <font size="-1">
            <input type="checkbox" name="and_nombres" value="1" <?=(isset($and_nombres))? ' checked ' : ' '?> disabled>
          </font>
        </td>
        <td height="15" colspan="2" align="left" class="titulos2">Nombres</td>
        <td width="46%" colspan="2" class="listado2">
          <input name="buscar_por_nombres" type="text" class="ecajasfecha" id="buscar_por_nombres" size="35" value="<?=(isset($buscar_por_nombres))? $buscar_por_nombres : null?>">
        </td>
      </tr>
<?php
  }
?>
      <tr>
        <td width="15%" align="right" class="titulos2">
          <font size="-1">
            <input type="checkbox" name="and_cuentai" value="1" <?=(isset($and_cuentai))? ' checked ' : ' '?> disabled>
          </font>
        </td>
        <td colspan="2" align="left" class="titulos2"> Buscar Por</td>
<?php
  if(empty($tpBusqueda)) $tpBusqueda=1;

  $no_hay_busqueda =  empty($tpBusqueda1) &&
                    empty($tpBusqueda2) &&
                    empty($tpBusqueda3) &&
                    empty($tpBusqueda4);

  if($no_hay_busqueda) {
    $tpBusqueda1 = 1;
    $tpBusqueda2 = 2;
    $tpBusqueda3 = 3;
    $tpBusqueda4 = 4;
  }
?>
        <td width="46%" colspan="2" class="listado2">
          <input type="checkbox" name="tpBusqueda1" value="1" <?=($tpBusqueda1 == 1)? "checked" : ''?>>
          <span class="etextomenu">Ciudadano</span>
          <input type="checkbox" name="tpBusqueda2" value="2" <?=($tpBusqueda2 == 2)? 'checked' : ''?>>
          <span class="etextomenu">Otras Empresas</span>
          <input type="checkbox" name="tpBusqueda3" value="3" <?=($tpBusqueda3 == 3)? 'checked' : ''?>>
          <span class=etextomenu>ESP's</span>
          <input type="checkbox" name="tpBusqueda4" value="4" <?=($tpBusqueda4 == 4)? 'checked' : ''?>>
          <span class=etextomenu>Funcionarios</span>
        </td>
      </tr>
      <tr>
        <td width="15%" align="right" class="titulos2">
          Rango de Fechas de Radicaci&oacute;n
          <strong>
            <font size="-1" face="Arial, Helvetica, sans-serif" class="style4"> </font>
          </strong>
        </td>
        <td width="19%" align="left" class="titulos2">
          <font face="Arial, Helvetica, sans-serif" class="etextomenu">
            <font size="-1">
              <script language="javascript">
                dateAvailable.writeControl();
                dateAvailable.dateFormat="yyyy/MM/dd";
              </script>
            </font>
          </font>
        </td>
        <td colspan="3" align="left" class="titulos2">
          <font face="Arial, Helvetica, sans-serif" class="etextomenu">
            <font size="-1">
              <script language="javascript">
                dateAvailable2.writeControl();
                dateAvailable2.dateFormat="yyyy/MM/dd";
              </script>
            </font>
          </font>
        </td>
      </tr>
<?php
  if(isset($mostrar_dep) && $mostrar_dep == 'ddd') {
?>
      <tr>
        <td colspan="2" align="left" class="titulos2"> Dependencia de Radicacion</td>
        <td colspan="2" class="listado2">
        <input name="buscar_por_dep_rad" type="text" class="ecajasfecha" id="cuentai" size="35" value="<?=(isset($buscar_por_dep_rad))? $buscar_por_dep_rad : null?>">
        </td>
      </tr>
<?php
  }
?>
      <tr align="center">
        <td colspan="5" class="titulos2">
          <input name="Submit" onClick="solonumeros();" type="button" class="botones" value="BUSCAR" onSelect="solonumeros();">
          <input name="Submit" type="hidden" class="ebuttons2" value="BUSCAR">
        </td>
      </tr>
      <input type="hidden" name="pnom" value="<?=$pnomb?>">
<?php 
      $pnom = (isset($pnomb))? $pnomb : null;
?>
    </table>
  </body>
</html>
